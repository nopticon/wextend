<?php
namespace Nopticon\Wextend;

class ZipcodeBox extends NativeWidget {
    public function __construct() {
        parent::__construct(__CLASS__);
    }

    public function fields() {
        return array(
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Form name' ),
                'param_name'  => 'form_name',
                'value'       => 'Zipcode Box',
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
                'heading'     => __( 'Form action' ),
                'param_name'  => 'form_action',
                'group'       => __( 'Form Control', 'js_composer' ),
                'value'       => '/form/',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Form method' ),
                'param_name'  => 'form_method',
                'group'       => __( 'Form Control', 'js_composer' ),
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
                'heading'     => __( 'Input ID' ),
                'param_name'  => 'form_input_id',
                'group'       => __( 'Form Control', 'js_composer' ),
                'value'       => 'zip',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Input Placeholder' ),
                'param_name'  => 'form_input_placeholder',
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
                'heading'     => __( 'Text' ),
                'param_name'  => 'form_label_text',
                'group'       => __( 'Form Label', 'js_composer' ),
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Class' ),
                'param_name'  => 'form_label_class',
                'group'       => __( 'Form Label', 'js_composer' ),
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'ID' ),
                'param_name'  => 'form_submit_id',
                'group'       => __( 'Form Submit', 'js_composer' ),
                'value'       => 'submit',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Class' ),
                'param_name'  => 'form_submit_class',
                'group'       => __( 'Form Submit', 'js_composer' ),
                'value'       => 'zip-submit btn-lg btn-danger',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Text' ),
                'param_name'  => 'form_submit_text',
                'group'       => __( 'Form Submit', 'js_composer' ),
                'value'       => 'Request Quotes',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Icon' ),
                'param_name'  => 'form_submit_icon',
                'group'       => __( 'Form Submit', 'js_composer' ),
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
