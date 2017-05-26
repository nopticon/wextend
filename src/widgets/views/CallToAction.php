<?php if ($card_orientation === 'horizontal') { ?>

<section class="content-cta row">
    <div class="container">
        <h2 class="entry-title text-center"></h2><?php echo $card_title; ?></h2>

        <section class="col-lg-8 col-lg-offset-2 widget-cta">
            <h3 class="text-center"><?php echo $card_description; ?></h3>
            <div class="col-lg-5">
                <p class="text-center"><?php echo $content_left; ?></p>
                <a href="tel:<?php echo site_phone(); ?>" class="text-center"><?php echo site_phone(); ?></a>
            </div>
            <div class="col-lg-2 col-divider divider-horizontal">
                <section class="divider">OR</section>
            </div>
            <div class="col-lg-5">
                <?php echo $content_right; ?>
                <?php if (!empty($widget_name)) dynamic_sidebar($widget_name); ?>
            </div>
        </section>
    </div>
</section>

<?php } elseif ($card_orientation === 'vertical') { ?>

<section class="content-cta row">
    <div class="container">
        <h2 class="entry-title text-center"></h2><?php echo $card_title; ?></h2>

        <section class="col-lg-8 col-lg-offset-2 widget-cta">
            <h3 class="text-center"><?php echo $card_description; ?></h3>
            <div class="col-lg-5">
                <p class="text-center"><?php echo $content_left; ?></p>
                <a href="tel:<?php echo site_phone(); ?>" class="text-center"><?php echo site_phone(); ?></a>
            </div>
            <div class="col-lg-2 col-divider divider-vertical">
                <section class="divider">OR</section>
            </div>
            <div class="col-lg-5">
                <?php echo $content_right; ?>
                <?php if (!empty($widget_name)) dynamic_sidebar($widget_name); ?>
            </div>
        </section>
    </div>
</section>

<?php } ?>
