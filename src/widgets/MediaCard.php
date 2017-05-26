<?php
namespace Nopticon\Wextend;

class MediaCard extends NativeWidget {
    public function __construct() {
        parent::__construct(__CLASS__);
    }

    public function fields() {
        return array(
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Container Class' ),
                'param_name'  => 'card_class',
                'group'       => __( 'Design Options', 'js_composer' ),
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Image Class' ),
                'param_name'  => 'card_image',
                'group'       => __( 'Design Options', 'js_composer' ),
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Title' ),
                'param_name'  => 'card_title',
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textarea_html',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Content' ),
                'param_name'  => 'card_content',
                'value'       => '',
                'description' => ''
            )
        );
    }
}
