<?php namespace Nopticon\Wextend;

class Format {
    private static $list   = array();
    private static $parsed = array();

    public static function url($url) {
        $list = array(
            'scheme'   => '',
            'host'     => '',
            'port'     => '',
            'user'     => '',
            'pass'     => '',
            'path'     => '',
            'query'    => '',
            'fragment' => '',
        );
        $result = parse_url($url);

        return array_merge($list, $result);
    }

    public static function tfn($value) {
        $base = base64_decode($value, true);
        return $base ?: $value;
    }

    public static function parsed() {
        foreach (self::$list as $name => $row) {
            self::$parsed[$name] = $row['value'];
        }
        return self::$parsed;
    }

    public static function predefine() {
        $phone = [
            'get'      => [
                ['phone'],
                ['phone-num1', 'phone-num2', 'phone-num3']
            ],
            'callback' => ['Core::merge_none', 'Core::strip_phone']
        ];

        return array(
            'Browser'             => ['server' => 'HTTP_USER_AGENT'],
            'IP_Address'          => ['server' => 'REMOTE_ADDR'],
            'Zip'                 => [],
            'City'                => [],
            'State'               => [],

            'Gender'              => [],
            'Age'                 => ['get' => [['dmonth', 'dday', 'dyear']], 'callback' => ['Core::merge_comma', 'Core::format_get_age']],
            'First_Name'          => ['get' => 'firstname'],
            'Last_Name'           => ['get' => 'lastname'],
            'Address'             => ['get' => [['frm-street'], ['address']], 'default' => '123 default', 'callback' => ['Core::merge_none']],
            'Phone'               => $phone,
            'Email'               => ['use' => 'Phone', 'usefix' => true, 'suffix' => '@noemail.com'],

            'Date_Of_Birth_Month' => ['get' => 'dmonth', 'default' => 1],
            'Date_Of_Birth_Day'   => ['get' => 'dday', 'default' => 1],
            'Date_Of_Birth_Year'  => ['get' => 'dyear', 'default' => 1],

            'Referrer_URL'        => ['get' => 'site_ref'],
            'Referrer_Root_URL'   => ['get' => 'site_ref', 'callback' => 'Format::url', 'extract' => 'host'],
            'Full_URL'            => ['get' => 'site_ep'],
            'Final_URL'           => ['callback' => 'Format::url', 'extract' => 'path'],
            'Landing_Page'        => ['get' => 'site_ep', 'callback' => 'Format::url', 'extract' => 'path', 'default' => 'get-quotes'],

            'Publisher'           => ['get' => 'q_publisher'],
            'Network'             => ['get' => 'q_network'],
            'Creative_ID'         => ['get' => 'q_creative'],
            'Match_Type'          => ['get' => 'q_matchtype'],
            'Ad_Position'         => ['get' => 'q_adposition'],
            'Device'              => ['get' => 'q_device'],
            'Device_Model'        => ['get' => 'q_devicemodel'],
            'Campaign_ID'         => ['get' => 'q_campaignid'],
            'Account_ID'          => ['get' => 'q_accountid'],
            'Adgroup_ID'          => ['get' => 'q_adgroupid'],
            'Target_ID'           => ['get' => 'q_targetid'],
            'Feeditem_ID'         => ['get' => 'q_feeditemid'],
            'Criteria_ID'         => ['get' => 'q_criteria'],
            'Keyword'             => ['get' => 'q_keyword'],
            'Placement'           => ['get' => 'q_placement'],
            'TFN'                 => ['get' => 'tfn', 'callback' => 'Format::tfn'],
            'Query'               => ['get' => [['q_query'], ['skw']], 'callback' => ['Core::merge_none']],

            'Disclaimer'          => [],
            'Landing_Product'     => [],
            'Term_Length'         => [],
            'Height_Feet'         => [],
            'Height_Inches'       => [],
            'Weight'              => [],
            'Nicotine_Use'        => [],
            'Health_Class'        => [],
            'Exp_Landing'         => [],
            'Exp_Form'            => [],
            'Sub_ID'              => [],
            'Pub_ID'              => [],
            'GCLID'               => [],
            'SRC'                 => [],
            'afid'                => [],
            'cid'                 => [],

            'Website'             => ['get' => false],
            'Tobacco'             => ['get' => false]
        );
    }

    public static function parse($list) {
        $properties = [
            'get'      => '',
            'default'  => '',
            'callback' => '',
            'extract'  => '',
            'use'      => '',
            'prefix'   => '',
            'suffix'   => '',
            'server'   => '',
            'value'    => '',
            'usefix'   => false
        ];

        $do = [
            'get', 'server', 'use', 'callback', 'extract', 'prefix', 'suffix', 'default'
        ];

        self::$list = array_merge_recursive( $list, self::predefine() );

        foreach (self::$list as $name => $attr) {
            $attr = array_merge($properties, $attr);

            foreach ($do as $action) {
                $action = 'do_' . $action;
                $attr   = self::$action($name, $attr);
            }

            self::$list[$name] = $attr;
        }

        foreach (self::$list as $name => $row) {
            self::$parsed[$name] = $row['value'];
        }
        return self::$parsed;
    }

    private static function do_get_value($list, $merge = false) {
        $value = Core::req_filter($list);

        if ($merge) {
            $value = Core::merge_none($value);
        }

        return $value;
    }

    private static function do_get($name, $attr) {
        if ($attr['get'] === false || !empty( $attr['server'] )) {
            return $attr;
        }

        if ( !is_array($attr['get']) ) {
            if (empty( $attr['get'] )) {
                $attr['get'] = $name;
            }

            $attr['get'] = strtolower($attr['get']);
            $attr['get'] = [ $attr['get'] ];
        }

        $one_of_many = false;
        foreach ($attr['get'] as $i => $row) {
            if (is_array($row)) {
                $one_of_many = true;
                break;
            }
        }

        if ($one_of_many) {
            foreach ($attr['get'] as $i => $row) {
                $value = self::do_get_value($row);
                $value_check = Core::merge_none($value);

                if (!empty($value_check)) {
                    $attr['value'] = $value;
                    break;
                }
            }
        } else {
            $merge_value = count($attr['get']) <= 1;
            $attr['value'] = self::do_get_value($attr['get'], $merge_value);
        }

        return $attr;
    }

    private static function do_server($name, $attr) {
        if (!empty( $attr['server'] )) {
            $attr['value'] = isset($_SERVER[ $attr['server'] ]) ? $_SERVER[ $attr['server'] ] : '';
        }
        return $attr;
    }

    private static function do_use($name, $attr) {
        $attr['oldvalue'] = $attr['value'];
        if (empty($attr['value']) && !empty($attr['use'])) {
            $attr['value'] = self::$list[ $attr['use'] ]['value'];
        }
        return $attr;
    }

    private static function do_prefix($name, $attr) {
        if ( (!empty($attr['use']) && $attr['usefix']) || empty($attr['use']) ) {
            $attr['value'] = $attr['prefix'] . $attr['value'];
        }
        return $attr;
    }

    private static function do_suffix($name, $attr) {
        if ( (empty($attr['oldvalue']) && !empty($attr['use']) && $attr['usefix']) || empty($attr['use']) ) {
            $attr['value'] .= $attr['suffix'];
        }
        return $attr;
    }

    private static function do_callback($name, $attr) {
        if (empty($attr['callback'])) {
            return $attr;
        }

        if (!is_array($attr['callback'])) {
            $attr['callback'] = [ $attr['callback'] ];
        }

        foreach ($attr['callback'] as $callback) {
            $callback = __NAMESPACE__ . '\\' . $callback;
            $attr['value'] = call_user_func_array($callback, [ $attr['value'] ]);
        }

        return $attr;
    }

    private static function do_extract($name, $attr) {
        if (empty($attr['extract'])) {
            return $attr;
        }

        if (is_array($attr['value']) && isset($attr['value'][ $attr['extract'] ])) {
            $attr['value'] = $attr['value'][ $attr['extract'] ];
        }
        return $attr;
    }

    private static function do_default($name, $attr) {
        if ( empty($attr['value']) && !empty($attr['default']) ) {
            $attr['value'] = $attr['default'];
        }
        return $attr;
    }
}
