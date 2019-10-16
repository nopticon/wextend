<?php use Nopticon\Wextend\Core;

function site_phone($force_number = false, $one = false) {
    if ( Core::get_phone_one() ) {
        return Core::current_phone_one($force_number);
    }

    return Core::current_phone($force_number, $one);
}

function site_phone_one($force_number = false) {
    return Core::current_phone_one($force_number);
}

function dd($a = '', $d = false) {
    echo '<pre>'; print_r($a); echo '</pre>';
    if ($d === true) exit;
}
