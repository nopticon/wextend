<?php namespace Nopticon\Wextend;

if (is_admin() || isset($_GET['sitemap']) || in_array($GLOBALS['pagenow'], ['wp-login.php', 'wp-register.php'])) {
  return;
}

add_filter('the_content', __NAMESPACE__ . '\\replace_domain_images');
add_filter('vc_domain_images', __NAMESPACE__ . '\\replace_domain_images', 10, 2);

function replace_domain_images($content) {
    $home        = network_home_url();
    $site_url    = parse_url($home);

    $root_domain = explode('.', $site_url['host']);
    $sub_domain  = array_shift($root_domain);
    $root_domain = implode('.', $root_domain);

    $match   = '(http(s)?\:\/\/)(.*?)\.' . $root_domain;
    $content = preg_replace('#' . $match . '\/wp-content#is', $home . CONTENT_DIR, $content);
    $content = preg_replace('#' . $match . '#i', '', $content);

    return $content;
}
