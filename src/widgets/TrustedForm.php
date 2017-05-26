<?php
namespace Nopticon\Wextend;

class TrustedForm extends NativeWidget {
    public function __construct() {
        parent::__construct(__CLASS__);
    }

    public function fields() {
        return array(
            array(
                'type'        => 'textfield',
                'holder'      => 'div',
                'class'       => '',
                'heading'     => __( 'Field Name' ),
                'param_name'  => 'field_name',
                'group'       => __( 'Design Options', 'js_composer' ),
                'value'       => 'xxTrustedFormCertUrl',
                'description' => ''
            )
        );
    }
}
