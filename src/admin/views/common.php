<div class="wrap">
    <h1><?php echo esc_html($title); ?></h1>

    <form method="post" action="options.php">
    <?php

    settings_fields($section);
    do_settings_fields($section, 'default');
    do_settings_sections($section);

    submit_button();

    ?>
    </form>
</div>
