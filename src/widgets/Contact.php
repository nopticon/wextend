<?php
namespace Nopticon\Wextend;

class Contact extends NativeWidget {
    public function __construct() {
        parent::__construct(__CLASS__);
    }

    public function fields() {
        return array(
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Form action' ),
                'param_name'  => 'form_action',
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Form name' ),
                'param_name'  => 'form_name',
                'value'       => 'Contact',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Form text title' ),
                'param_name'  => 'form_text_title',
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Form text subtitle' ),
                'param_name'  => 'form_text_subtitle',
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Form class' ),
                'param_name'  => 'form_class',
                'group'       => __( 'Design Options', 'js_composer' ),
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Form method' ),
                'param_name'  => 'form_method',
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Show quotes' ),
                'param_name'  => 'show_quotes',
                'group'       => __( 'Form Control', 'js_composer' ),
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Form title' ),
                'param_name'  => 'form_title',
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Form submit text' ),
                'param_name'  => 'form_submit_text',
                'value'       => 'Send Message',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Form title class' ),
                'param_name'  => 'form_title_class',
                'group'       => __( 'Design Options', 'js_composer' ),
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Form text class' ),
                'param_name'  => 'form_text_class',
                'group'       => __( 'Design Options', 'js_composer' ),
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Form Recaptcha' ),
                'param_name'  => 'form_recaptcha',
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textarea_html',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Content', 'my-text-domain' ),
                'param_name'  => 'form_text',
                'value'       => '',
                'description' => ''
            )
        );
    }
}
