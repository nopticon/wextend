<?php
namespace Nopticon\Wextend;

class Core {
    private static $cookie     = array();
    private static $query      = array();
    private static $tfn_list   = array();
    private static $url_params = array();
    private static $shortcodes = array();
    private static $tfn_method = '';
    private static $tfn_one    = false;

    public function __construct() {
        return;
    }

    public static function init() {
        self::$cookie = array_change_key_case($_COOKIE);
        self::$query  = array_change_key_case(array_merge(self::$cookie, $_GET, $_POST));
    }

    public static function get_hidden_fields($extra = false, $get_from_request = false) {
        $fields = array();
        $format = '<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />';
        $qs = self::req(true);

        if ($extra !== false) {
            $qs = array_merge($qs, $extra);

            if ($get_from_request) {
                foreach ($extra as $name => $value) {
                    if (empty($value)) $qs[$name] = self::req($name);
                }
            }
        }

        $pt = array();
        foreach (self::$cookie as $name => $value) {
            if (strpos($name, 'pt_') !== false) {
                $name = str_replace('pt_', '', $name);
                $pt[$name] = $value;
            }
        }

        if ($pt) {
            $qs = array_merge($qs, $pt);
        }

        foreach ($qs as $qs_name => $qs_value) {
            switch ($qs_name) {
                case 'zip':
                    continue 2;
            }

            $fields[] = sprintf($format, $qs_name, $qs_value);
        }

        return implode("\n", $fields);
    }

    public static function phone_one($flag = true) {
        self::$tfn_one = $flag;
    }

    public static function get_phone_one() {
        return self::$tfn_one;
    }

    public static function extract_vc_column($content, $name) {
        $response = '';

        $vc = 'vc_column_text';
        $format = '/\[' . $vc . ' el_class\=\"' . $name . '\"\](.*?)\[\/' . $vc . '\]/is';
        preg_match_all($format, $content, $content);

        if (isset($content[1][0])) {
            $response = str_replace(
                array('“', '”', '[phone]'),
                array('', '', site_phone()),
                strip_tags( trim($content[1][0]) )
            );
        }

        return $response;
    }

    public static function extract_vc_tag($content, $name) {
        $response = '';

        $format = '/\[' . $name . '.*?\](.*?)\[\/' . $name . '\]/is';
        preg_match_all($format, $content, $content);

        if (isset($content[1][0])) {
            $response = str_replace(
                array('“', '”', '[phone]'),
                array('', '', site_phone()),
                strip_tags( trim($content[1][0]) )
            );
        }

        return $response;
    }

    public static function paths() {
        return array(
            'theme'  => get_template_directory() . '/lib',
            'module' => dirname(__FILE__)
        );
    }

    public static function search_path($path) {
        $paths = self::paths();

        foreach ($paths as $row) {
            $row .= '/' . $path;

            if (@file_exists($row)) {
                return $row;
            }
        }

        return false;
    }

    public static function get_widget($name) {
        ob_start();
        dynamic_sidebar($name);
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    public static function Disclaimer($content) {
        $change = array(
            'original' => array("\n", '"', '“', '”', "'", "’"),
            'replace' => array(' ', '', '', '', '', '')
        );

        $content = trim(strip_tags($content));
        $content = str_replace($change['original'], $change['replace'], $content);
        $content = preg_replace('/\s+/', ' ', $content);

        return $content;
    }

    public static function ob_read_file($path, $defined = false) {
        if ($defined !== false) {
            extract($defined);
        }

        if (strpos($path, '.php') === false) {
            $path .= '.php';
        }

        $path = self::search_path($path);

        ob_start();

        if ($path !== false) {
            require $path;
        }

        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }

    public static function merge_comma($list) {
        return implode(', ', array_filter($list));
    }

    public static function merge_none($list) {
        if (!is_array($list)) {
            return $list;
        }
        return implode('', array_filter($list));
    }

    public static function w($list = '', $default = false, $filter = 'trim') {
        if (empty($list) || !is_string($list)) return array();

        $e = explode(' ', $filter($list));
        if ($default !== false) {
            foreach ($e as $i => $v) {
                $e[$v] = $default;
                unset($e[$i]);
            }
        }

        return $e;
    }

    public static function get_referrer() {
        return self::server_var('HTTP_REFERER');
    }

    public static function server_var($name) {
        return isset($_SERVER[$name]) ? $_SERVER[$name] : '';
    }

    public static function req_one_empty($list) {
        $one_empty = false;

        foreach ($list as $row) {
            $value = Core::req($row);

            if (empty($value)) {
                $one_empty = true;
                break;
            }
        }

        return $one_empty;
    }

    public static function req_filter($fields, $callback = false) {
        $params = array(
            'name'    => false,
            'exclude' => false,
            'default' => ''
        );

        $list = array();
        foreach ($fields as $i => $field) {
            if (!is_array($field)) {
                $name  = $field;
                $field = $params;

                $field['name'] = $name;
            }

            $list[$field['name']] = call_user_func_array('self::req', $field);
        }

        if ($list !== false && @is_callable($callback)) {
            $list = call_user_func_array($callback, array($list));
        }

        return $list;
    }

    public static function req_rm($name) {
        unset(self::$query[$name]);
    }

    public static function req($name = false, $exclude = false, $default = '') {
        if (!$name) {
            return self::$query;
        }

        if ($name === 'get:cookies') {
            return self::$cookie;
        }

        if ($name === true) {
            $tmp = self::$query;

            foreach (self::$cookie as $row => $value) {
                unset($tmp[$row]);
            }

            return $tmp;
        }

        if (strpos($name, '|') !== false) {
            $part = explode('|', $name);

            foreach ($part as $row) {
                if ($value = self::req($row, $exclude)) break;
            }

            if (!$value) $value = $default;

            return $value;
        }

        if (strpos($name, 'cp:') !== false) {
            $name = str_replace('cp:', '', $name);
            $part = explode('>', $name);

            if ($name = self::req($part[0], $exclude, $default)) {
                foreach ($part as $row) {
                    self::$query[$row] = $name;
                }
            } else {
                foreach ($part as $row) {
                    self::req($row, $exclude, $default);
                }
            }

            return $name;
        }

        if ($exclude && strpos($exclude, '@') === 0) {
            $exclude = str_replace('@', '', $exclude);

            if (@function_exists($exclude)) {
                if ($value = $exclude(self::req($name))) {
                    self::$query[$name] = $value;
                }
            } else {
                if ($value = self::req($name)) {
                    self::$query[$name] = $value;
                }
            }

            return $value;
        }

        if (strpos($name, '>') !== false && ($exclude || $exclude === NULL)) {
            $name = str_replace('>', '', $name);
            self::$query[$name] = $exclude;
            $exclude = false;
        }

        $response = $default;
        if (isset(self::$query[$name]) && !empty(self::$query[$name])) {
            $response = self::$query[$name];
        }

        if ($exclude && isset(self::$query[$name])) {
            unset(self::$query[$name]);
        }

        return $response;
    }

    public static function tfn($list, $method = 'base64') {
        self::$tfn_list = array_flip($list);
        self::$tfn_method = $method;
    }

    public static function current_phone($force_number = false, $one = false) {
        if ($one !== false) {
            return self::current_phone_one($force_number);
        }

        $name  = 'site_phone';
        $phone = ($force_number !== false) ? $force_number : '';
        $tfn   = self::req('tfn');

        if (empty($phone) && empty($tfn) && isset($_COOKIE[$name])) {
            return $_COOKIE[$name];
        }

        if (empty($phone) && self::$tfn_list) {
            if ($tfn && isset(self::$tfn_list[$tfn])) {
                $phone = base64_decode($tfn);
            }
        }

        if (empty($phone)) {
            $src = self::req('src');
            switch ($src) {
                default:
                    $phone = get_option('default-tfn');
                    break;
            }
        }

        if ($force_number === false || empty($force_number)) {
            $_COOKIE[$name] = $phone;
            @self::_setcookie($name, $phone);
        }

        return $phone;
    }

    public static function current_phone_one($force_number = false) {
        $phone  = self::current_phone($force_number);
        $prefix = (strpos($phone, '1-') !== 0) ? '1-' : '';

        return $prefix . $phone;
    }

    public static function year_shortcode() {
        return date('Y');
    }

    public static function default_shortcodes() {
        $list = array(
            'phone'          => 'Core::sc_phone',
            'format_phone'   => 'Core::sc_format_phone',
            'link_phone'     => 'Core::sc_link_phone',
            'referer_string' => 'Core::sc_referer_contact',
            'current_year'   => 'Core::year_shortcode',
        );

        self::set_shortcodes($list);
    }

    public static function set_shortcodes($list) {
        self::$shortcodes = $list;
    }

    public static function register_shortcodes() {
        if (empty(self::$shortcodes)) {
            self::default_shortcodes();
        }

        foreach (self::$shortcodes as $name => $callback) {
            add_shortcode($name, __NAMESPACE__ . "\\$callback");
        }

        return;
    }

    public static function _setcookie($name, $value, $expire = 0, $httponly = false) {
        static $secure;

        if (!$secure) {
            $secure = isset($_SERVER['SERVER_PORT']) ? ($_SERVER['SERVER_PORT'] == 443) : false;
        }

        if (is_string($value) || $expire == -1) {
            setcookie($name, $value, $expire, '/', '', $secure, $httponly);
        }
    }

    public static function default_url_whitelist() {
        $list = array(
            'gclid',
            'q_publisher',
            'q_network',
            'q_creative',
            'q_matchtype',
            'q_adposition',
            'q_criteria',
            'q_campaign',
            'q_adgroup',
            'q_target',
            'q_feeditem',
            'q_keyword',
            'q_placement',
            'q_device',
            'q_devicemodel',
            'afid',
            'cid',
            'src',
            'sub_id',
            'pub_id',
            'landing_product',
            'exp_landing',
            'exp_form'
        );

        $list = apply_filters('wextend_url_whitelist', $list);

        self::url_whitelist($list);
    }

    public static function url_whitelist($list, $single = false) {
        if ($single !== false) {
            $params = array_keys(self::$url_params);
            $params[] = $list;

            self::$url_params = $params;
            return;
        }

        self::$url_params = array_flip($list);
    }

    public static function read_url_parameters() {
        $qs = self::req(true);

        if (empty(self::$url_params)) {
            self::default_url_whitelist();
        }

        foreach ($qs as $qs_name => $qs_value) {
            if ( !isset(self::$url_params[ $qs_name ]) ) continue;

            self::_setcookie('pt_' . $qs_name, $qs_value);
        }

        return true;
    }

    public static function convert_query($query) {
        $queryParts = explode('&', $query);

        $params = array();
        foreach ($queryParts as $param) {
            $item = explode('=', $param);

            if (!empty($item[0])) {
                $params[$item[0]] = isset($item[1]) ? $item[1] : '';
            }
        }

        return $params;
    }

    public static function get_search_keyword() {
        if ( $content = self::req('skw') ) {
            return $content;
        }

        $referrer = self::get_referrer();
        $referrer = parse_url($referrer);
        $keyword  = ' ';

        if (isset($referrer['host']) &&  isset($referrer['query'])) {
            $parts = self::convert_query($referrer['query']);
            $param = 'q';

            $hosts = array(
                'google' => 'q',
                'yahoo'  => 'p',
                'msn'    => 'q',
                'bing'   => 'q'
            );

            foreach ($hosts as $name => $value) {
                if (strpos($referrer['host'], $name) !== false) {
                    $param = $value;
                }
            }

            if ( isset($parts[$param]) ) {
                $keyword = urldecode($parts[$param]);
            }
        }

        self::req('>skw', $keyword);

        return $keyword;
    }

    public static function read_referer() {
        $http_set = 'site_ref';

        if (self::req($http_set)) {
            return;
        }

        $http_key = 'HTTP_REFERER';
        $val = isset($_SERVER[$http_key]) ? $_SERVER[$http_key] : '';
        self::req('>' . $http_set, $val);

        self::_setcookie($http_set, $val);
        return $val;
    }

    public static function get_entry_point() {
        $http_key = 'site_ep';

        if (self::req($http_key)) {
            return;
        }

        $val = self::protocol(true, true) . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        self::req('>' . $http_key, $val);

        self::_setcookie($http_key, $val);
        return $val;
    }

    public static function protocol($str = true, $slash = false) {
        $port = isset($_SERVER['SERVER_PORT']) ? (int) $_SERVER['SERVER_PORT'] : 80;
        $slash = $slash ? '://' : '';

        switch ($port) {
            case 443:
                return $str ? 'https' . $slash : 443;
            default:
                return $str ? 'http' . $slash : $port;
        }
    }

    public static function parse_url_req($name, $attr, $create = false, $default = '') {
        if ($value = self::req($name)) {
            $part = parse_url($value);

            if (isset($part[$attr])) {
                $default = $part[$attr];
            }
        }

        if ($create !== false) {
            $name = $create;
        }

        self::req('>' . $name, $default);
        return $default;
    }

    public static function sc_phone($atts) {
        extract(shortcode_atts(array(
            'one'   => false,
            'force' => false
        ), $atts));

        return self::current_phone($force, $one);
    }

    public static function sc_format_phone($atts) {
        extract(shortcode_atts(array(
            'one'       => false,
            'force'     => false,
            'class'     => '',
            'prev_text' => '',
            'next_text' => ''
        ), $atts));

        $phone = self::current_phone($force, $one);
        $format = '<span class="phone-number %s">%s</span>';

        return sprintf($format, $class, $prev_text . $phone . $next_text);
    }

    public static function sc_link_phone($atts) {
        extract(shortcode_atts(array(
            'one'       => false,
            'one_tel'   => true,
            'force'     => false,
            'class'     => '',
            'text'      => '',
            'icon'      => 'glyphicon glyphicon-earphone',
            'show_icon' => true,
            'prev_text' => '',
            'next_text' => ''
        ), $atts));

        $phone   = self::current_phone($force, $one);
        $one_tel = $one_tel ? self::current_phone($force, true) : $phone;
        $text    = $text ?: $phone;

        if ($show_icon) {
            $next_text .= ' <i class="' . $icon . '"></i>';
        }

        $format = '<a href="tel:+%s" class="link-phone %s">%s</a>';

        return sprintf($format, $one_tel, $class, $prev_text . $text . $next_text);
    }

    public static function sc_referer_contact(){
        return (strpos(wp_get_referer(), 'calling') !== false) ? 'calling' : 'email';
    }

    public static function snake_normal($str) {
        return ucwords(str_replace(array('_', '-'), ' ', $str));
    }

    public static function camel_normal($str) {
        $matches = preg_split('/(?<=[a-z])(?=[A-Z])/x', $str);
        return implode($matches, ' ');
    }

    public static function strip_phone($str) {
        return str_replace(array('(', ')', ' ', '+', '-'), '', $str);
    }

    public static function text_normal($str) {
        return self::camel_normal( self::snake_normal( $str ) );
    }

    public static function format_get_age($str) {
        $e = explode(', ', $str);

        return self::get_age((int) $e[2], (int) $e[0], (int) $e[1]);
    }

    public static function get_age($year, $month, $day) {
        $then = mktime(1, 1, 1, $month, $day, $year);
        return (sprintf("%.2f", ((time() - $then) / 31556926)) * 100) / 100;
    }

    public static function is_desktop() {
        if (!@function_exists('is_mobile') || !@function_exists('is_tablet')) {
            return true;
        }

        return !is_mobile() && !is_tablet();
    }
}
