<?php
namespace Nopticon\Wextend;

class BulletList extends NativeWidget {
    public function __construct() {
        parent::__construct(__CLASS__);
    }

    public function before($args) {
        if (!empty($args['bullet_list'])) {
            $list = explode("\n", $args['bullet_list']);
            $list = array_map('trim', $list);

            $args['bullet_list'] = $list;
        } else {
            $args['bullet_list'] = array();
        }

        return $args;
    }

    public function fields() {
        return array(
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'List Class' ),
                'param_name'  => 'bullet_class',
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Title' ),
                'param_name'  => 'bullet_title',
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'List Icon' ),
                'param_name'  => 'bullet_icon',
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textarea_html',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Bullet List' ),
                'param_name'  => 'bullet_list',
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'List Separator' ),
                'param_name'  => 'bullet_separator',
                'value'       => '*',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Action Url' ),
                'param_name'  => 'bullet_action_url',
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Action Text' ),
                'param_name'  => 'bullet_action_text',
                'value'       => '',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Action Class' ),
                'param_name'  => 'bullet_action_class',
                'value'       => '',
                'description' => ''
            )
        );
    }
}
