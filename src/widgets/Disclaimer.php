<?php
namespace Nopticon\Wextend;

class Disclaimer extends NativeWidget {
    public function __construct() {
        parent::__construct(__CLASS__);
    }

    public function fields() {
        return array(
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Disclaimer Class' ),
                'param_name'  => 'disclaimer_class',
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textarea_html',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Content', 'my-text-domain' ),
                'param_name'  => 'content',
                'value'       => '',
                'description' => ''
            )
        );
    }
}
