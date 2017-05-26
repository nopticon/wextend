<?php
namespace Nopticon\Wextend;

class Start {
    private static $vc_enabled = false;

    public static $widgets    = array();
    public static $plugins    = array();
    public static $vc         = array();
    public static $spec_build = array();
    public static $spec_cb    = false;

    public static $spec        = '';
    public static $category    = '';

    public function __construct() {
        return;
    }

    public static function init($category, $load = false) {
        Core::init();

        self::$category = $category;

        if ($load !== false) {
            if ($load === 'all') {
                $load = array('tfnAdmin', 'load', 'actions', 'filters');
            }

            foreach ($load as $name) {
                self::$name();
            }
        }

        return;
    }

    public static function Enable_VC() {
        self::$vc_enabled = true;
    }

    public static function Widgets($list) {
        self::$widgets = array_flip($list);
    }

    public static function Plugins($list) {
        self::$plugins = array_flip($list);
    }

    public static function load($path_override = false) {
        $list  = array();
        $paths = array(
            'admin'          => 'admin',
            'native-widgets' => 'widgets',
            'extend-plugins' => 'plugins'
        );

        if (empty(self::$widgets)) {
            unset($paths['native-widgets']);
        }

        if (empty(self::$widgets)) {
            unset($paths['native-widgets']);
        }

        if ($path_override !== false) {
            $paths = array_merge($paths, $path_override);
        }

        foreach (Core::paths() as $search) {
            foreach ($paths as $name => $path) {
                $folder = $search . '/' . $path . '/';
                $files  = @is_dir($folder) ? @scandir($folder) : array();

                foreach ($files as $row) {
                    if (pathinfo($row, PATHINFO_EXTENSION) !== 'php') continue;

                    $filename = str_replace('.php', '', $row);
                    if ( isset(self::${$path}) && !isset(self::${$path}[ $filename ])) {
                        continue;
                    }

                    $list[$name][] = $tz_name = $filename;
                    require $folder . $row;
                }
            }
        }

        if (isset($list['admin'])) {
            foreach ($list['admin'] as $name) {
                $class = __NAMESPACE__ . "\\$name";
                new $class;
            }
        }

        if (isset($list['native-widgets'])) {
            foreach ($list['native-widgets'] as $name) {
                add_action('widgets_init', function() use ($name) {
                    register_widget(__NAMESPACE__ . "\\$name");
                });

                $class = __NAMESPACE__ . '\\' . $name;
                $class = new $class;
                $class->shortcode();

                if (method_exists($class, 'load')) {
                    $class->load();
                }

                if (self::$vc_enabled && method_exists($class, 'fields')) {
                    self::$vc[$name] = array(
                        'name'     => Core::text_normal($name),
                        'base'     => strtolower($name),
                        'params'   => $class->fields(),
                        'category' => __(self::$category, 'wp-extend')
                    );
                }

                unset($class);
            }
        }
    }

    public static function setup_vc() {
        foreach (self::$vc as $row) {
            vc_map($row);
        }
    }

    public static function tfnAdmin() {
        $tfn = trim(get_option('tfn-list'));

        if (empty($tfn)) {
            return;
        }

        $tfn = array_map('trim', explode("\n", $tfn));

        Core::tfn($tfn);
        return;
    }

    public static function actions($list = false) {
        if ($list === false) {
            $list = array(
                'init' => array(
                    'Core::register_shortcodes',
                    'Core::current_phone',
                    'Core::get_search_keyword',
                    'Core::read_url_parameters',
                    'Core::read_referer',
                    'Core::get_entry_point'
                ),
                'vc_before_init' => array(
                    'Start::setup_vc'
                )
            );
        }

        if ( !self::$vc_enabled ) {
            unset($list['vc_before_init']);
        }

        foreach ($list as $action => $do) {
            foreach ($do as $call) {
                add_action($action, __NAMESPACE__ . '\\' . $call);
            }
        }

        return;
    }

    public static function filters($list = false) {
        if ($list === false) {
            $list = array(
                'widget_text' => 'do_shortcode'
            );
        }

        foreach ($list as $name => $call) {
            add_filter($name, $call);
        }

        return;
    }
}
