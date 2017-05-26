<?php
namespace Nopticon\Wextend;

class CallToAction extends NativeWidget {
    public function __construct() {
        parent::__construct(__CLASS__);
    }

    public function fields() {
        return array(
            array(
                'type'        => 'dropdown',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Orientation' ),
                'param_name'  => 'card_orientation',
                'group'       => __( 'Design Options', 'js_composer' ),
                'description' => '',
                'value'       => array(
                    'Horizontal' => 'horizontal',
                    'Vertical'   => 'vertical'
                ),
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Title' ),
                'param_name'  => 'card_title',
                'group'       => __( 'Design Options', 'js_composer' ),
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Description' ),
                'param_name'  => 'card_description',
                'group'       => __( 'Design Options', 'js_composer' ),
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Content Left' ),
                'param_name'  => 'content_left',
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textarea_html',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Content Right' ),
                'param_name'  => 'content_right',
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textarea_html',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Widget Name' ),
                'param_name'  => 'widget_name',
                'value'       => '',
                'description' => ''
            )
        );
    }
}
