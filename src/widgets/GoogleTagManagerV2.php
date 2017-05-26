<?php
namespace Nopticon\Wextend;

class GoogleTagManagerV2 extends NativeWidget {
    public function __construct() {
        parent::__construct(__CLASS__);
    }

    public function load() {
        add_action('wp_head', function() {
            echo do_shortcode( '[googletagmanagerv2 block_one="1"]' );
        });

        add_action('after_body', function() {
            echo do_shortcode( '[googletagmanagerv2 block_two="1"]' );
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
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Block One' ),
                'param_name'  => 'block_one',
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Block Two' ),
                'param_name'  => 'block_two',
                'value'       => '',
                'description' => ''
            )
        );
    }
}
