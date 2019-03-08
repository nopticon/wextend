<?php namespace Nopticon\Wextend;

class AdminSettings {
    private $view;
    private $title;
    private $section;
    private $capability;
    private $fields;

    public function __construct () {
        return;
    }

    public function init () {
        add_action('admin_menu', array($this, 'admin_menu'));
        add_action('admin_init', array($this, 'admin_init'));

        add_action('init', array($this, 'register_shortcodes'));
    }

    public function set_options ($view, $title, $section, $capability) {
        $this->view       = $view;
        $this->title      = $title;
        $this->section    = $section;
        $this->capability = $capability;
    }

    public function set_fields ($list) {
        $this->fields = $list;
    }

    public function sanitize($input) {
        return $input;
    }

    public function admin_fields ($append = false) {
        $this->fields = is_array($this->fields) ? $this->fields : array();
        $fields       = $this->fields;

        if ($append !== false) {
            $fields = array_merge_recursive($fields, $append);
        }

        return $fields;
    }

    public function get_shortcodes () {
        $fields = self::admin_fields();

        $shortcodes = array();
        foreach ($fields as $section) {
            foreach ($section['fields'] as $field) {
                if (isset($field['shortcode']) && $field['shortcode']) continue;

                $alias = isset($field['alias']) ? $field['alias'] : $field['id'];
                $shortcodes[] = $alias;
            }
        }

        return $shortcodes;
    }

    public function register_shortcodes () {
        $fields = $this->admin_fields();

        foreach ($fields as $section) {
            foreach ($section['fields'] as $field) {
                if (isset($field['shortcode']) && $field['shortcode']) continue;

                $alias = isset($field['alias']) ? $field['alias'] : $field['id'];
                add_shortcode($alias, array($this, 'do_shortcode'));
            }
        }
    }

    public function do_shortcode ($atts, $ignore_html = false, $tag = '') {
        extract(shortcode_atts(array(
            //
        ), $atts));

        $fields = $this->admin_fields();
        $option = $callback = '';
        $args   = array();

        foreach ($fields as $section) {
            foreach ($section['fields'] as $field) {
                $compare = isset($field['alias']) ? $field['alias'] : $field['id'];
                if ($compare !== $tag) continue;

                if (isset($field['callback'])) {
                    $callback = $field['callback'];
                    $args     = $field['args'];
                } else {
                    $option = $field['id'];
                }
            }
        }

        if ($callback) {
            $response = call_user_func_array($callback, $args);
        } else {
            $response = get_option($option, false);
        }

        return $response;
    }

    public function admin_menu () {
        add_options_page(
            $this->title,
            $this->title,
            $this->capability,
            $this->section,
            array($this, 'settings_page')
        );
    }

    public function admin_init () {
        $fields = $this->admin_fields();

        foreach ($fields as $section) {
            add_settings_section(
                $section['id'],          // Section ID
                $section['title'],       // Section title
                $section['description'], // Section callback function
                $this->section           // Settings page slug
            );

            foreach ($section['fields'] as $field) {
                if (isset($field['dynamic']) && $field['dynamic']) continue;

                register_setting(
                    $this->section,          // Options group
                    $field['id'],            // Option name/database
                    array($this, 'sanitize') // sanitize callback function
                );

                add_settings_field(
                    $field['id'],                   // Field ID
                    $field['name'],                 // Field title
                    array($this, 'field_callback'), // Field callback function
                    $this->section,                 // Settings page slug
                    $section['id'],                 // Section ID
                    $field
                );
            }
        }

        return;
    }

    public function settings_page () {
        if (!current_user_can($this->capability))
            wp_die(__('You do not have sufficient permissions to manage options for this site.'));

        $render_vars = method_exists($this, 'render') ? $this->render() : array();

        $render_vars = array_merge($render_vars, array(
            'title'   => $this->title,
            'section' => $this->section
        ));

        echo Core::ob_read_file($this->view, $render_vars);
    }

    public function show_input ($args) {
        $format = '<label for="%1$s"><input id="%1$s" type="text" value="%2$s" name="%1$s" /> [%3$s]</label>';

        return sprintf($format, $args['id'], get_option($args['id'], $args['value']), $args['alias']);
    }

    public function show_textarea ($args) {
        $format = '<label for="%1$s"><textarea id="%1$s" name="%1$s" />%2$s</textarea> [%3$s]</label>';

        return sprintf($format, $args['id'], get_option($args['id'], $args['value']), $args['alias']);
    }

    public function field_callback ($args) {
        $args['alias'] = isset($args['alias']) ? $args['alias'] : (isset($args['shortcode']) ? $args['shortcode'] : $args['id']);
        $args['value'] = isset($args['value']) ? $args['value'] : '';
        $args['input'] = isset($args['input']) ? $args['input'] : 'input';

        $method = 'show_' . $args['input'];
        echo $this->$method($args);
    }
}
