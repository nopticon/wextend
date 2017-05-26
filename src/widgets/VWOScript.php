<?php
namespace Nopticon\Wextend;

class VWOScript extends NativeWidget {
    public function __construct() {
        parent::__construct(__CLASS__);
    }

    public function load() {
        add_action('wp_head', function() {
            echo do_shortcode( '[vwoscript]' );
        });
    }

    public function fields() {
        return array(
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'VWO Account ID' ),
                'param_name'  => 'vwo_id',
                'value'       => '',
                'description' => ''
            )
        );
    }
}
