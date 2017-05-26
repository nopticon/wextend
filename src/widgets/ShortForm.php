<?php
namespace Nopticon\Wextend;

class ShortForm extends NativeWidget {
    public function __construct() {
        parent::__construct(__CLASS__);
    }

    public function fields() {
        return array(
            array(
                'type'        => 'dropdown',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Form type' ),
                'param_name'  => 'form_type',
                'description' => '',
                'value'       => array(
                    'Normal' => 'form_type_normal',
                    'Term'   => 'form_type_term',
                    'Whole'  => 'form_type_whole',
                ),
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Form name' ),
                'param_name'  => 'form_name',
                'value'       => 'Form',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Form Class' ),
                'param_name'  => 'form_class',
                'group'       => __( 'Design Options', 'js_composer' ),
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Form action' ),
                'param_name'  => 'form_action',
                'value'       => 'post',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Form method' ),
                'param_name'  => 'form_method',
                'value'       => 'post',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Show quotes' ),
                'param_name'  => 'show_quotes',
                'group'       => __( 'Form Control', 'js_composer' ),
                'value'       => false,
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
                'heading'     => __( 'Form submit ID' ),
                'param_name'  => 'form_submit_id',
                'value'       => 'btn-submit',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Form submit class' ),
                'param_name'  => 'form_submit_class',
                'value'       => 'btn-lg btn-danger btn-submit',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Form submit text' ),
                'param_name'  => 'form_submit_text',
                'value'       => 'Get Your Free Quotes',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Form submit icon' ),
                'param_name'  => 'form_submit_icon',
                'value'       => 'glyphicon glyphicon-ok',
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
                'heading'     => __( 'Form Disclaimer Widget' ),
                'param_name'  => 'form_disclaimer_widget',
                'group'       => __( 'Design Options', 'js_composer' ),
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
                'description' => __( 'Enter your content.', 'my-text-domain' )
            )
        );
    }
}
