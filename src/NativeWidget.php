<?php
namespace Nopticon\Wextend;

class NativeWidget extends \WP_Widget {
    protected $module;
    protected $fields;

    function __construct($name) {
        $this->module = str_replace(__NAMESPACE__ . '\\', '', $name);
        $this->fields = $this->df(@static::fields());

        parent::__construct($this->module, Start::$category . ' ' . $this->module);
    }

    public function df($ary) {
        $defaults = [
            'type'        => 'textfield',
            'holder'      => 'div',
            'class'       => '',
            'heading'     => '',
            'param_name'  => '',
            'value'       => '',
            'description' => ''
        ];

        $list = [];
        foreach ($ary as $field) {
            $list[] = array_merge($defaults, $field);
        }

        return $list;
    }

    public function shortcode() {
        $name = strtolower($this->module);
        add_shortcode($name, array($this, 'vc'));
    }

    public function vc($atts, $content = null) {
        $fields = $this->df(static::fields());
        $widget = array();

        foreach ($fields as $row) {
            $widget[ $row['param_name'] ] = $row['value'];
        }
        $info = shortcode_atts($widget, $atts);

        if (isset($info['content']) && !is_null($content)) {
            $info['content'] = $content;
        }

        // Run custom code for this widget
        if (is_callable( array($this, 'before') )) {
            $callback = $this::before($info);

            if (is_array($callback)) {
                $info = $callback;
            }
        }

        return Core::ob_read_file('widgets/views/' . $this->module, $info);
    }

    // Widget form creation
    public function form($instance) {
        $tag_open  = '<p>';
        $tag_close = '</p>';
        $label     = '<label for="%s">%s</label>';
        $option    = '<option value="%s"%s>%s</option>';

        $tags = array(
            'textfield'     => '<input class="widefat" id="%s" name="%s" type="text" value="%s" />',
            'textarea_html' => '<textarea class="widefat" id="%s" name="%s">%s</textarea>',
            'dropdown'      => '<br /><select id="%s" name="%s">%s</select>'
        );

        $fields = array();
        foreach ($this->fields as $row) {
            $type    = $row['type'];
            $field   = $row['param_name'];
            $heading = $row['heading'] . ' ( $' . $field . ' )';
            $value   = isset($instance[$field]) ? $instance[$field] : '';

            if ($type !== 'dropdown') {
                $value = $value ?: $row['value'];
            }

            switch ($type) {
                case 'textfield':
                    $value = esc_attr($value);
                    break;
                case 'textarea_html':
                    $value = esc_textarea($value);
                    break;
                case 'dropdown':
                    $select = '';
                    foreach ($row['value'] as $name => $val) {
                        $select .= sprintf($option, $val, selected($val, $value, false), $name);
                    }
                    $value = $select;
                    break;
            }

            $field_id   = $this->get_field_id($field);
            $field_name = $this->get_field_name($field);

            echo $tag_open;
            echo sprintf($label, $field_id, $heading);
            echo sprintf($tags[$type], $field_id, $field_name, $value);
            echo $tag_close;
        }
    }

    // Widget update
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        foreach ($this->fields as $row) {
            $field = $row['param_name'];
            $instance[$field] = $new_instance[$field];
        }

        return $instance;
    }

    // Widget display
    public function widget($args, $instance) {
        foreach ($this->fields as $row) {
            $field = $row['param_name'];
            $args[$field] = $instance[$field];
        }

        // Run custom code for this widget
        if (is_callable( array($this, 'before') )) {
            $callback = $this::before($args);

            if (is_array($callback)) {
                $args = $callback;
            }
        }

        // Show widget
        $format = '%s<div class="widget-text wp_widget_plugin_box %s">%s</div>%s';
        $content = Core::ob_read_file('widgets/views/' . $this->module, $args);
        $widget = 'widget-' . strtolower($this->module);

        echo sprintf($format, $args['before_widget'], $widget, $content, $args['after_widget']);
    }
}
