<?php
namespace Nopticon\Wextend;

class GoogleTagManager extends NativeWidget {
    public function __construct() {
        parent::__construct(__CLASS__);
    }

    public function load() {
        add_action('after_body', function() {
            echo do_shortcode( '[googletagmanager]' );
        });
    }

    public function fields() {
        return array(
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Tag Manager ID' ),
                'param_name'  => 'tag_manager_id',
                'value'       => '',
                'description' => ''
            )
        );
    }
}
