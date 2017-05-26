<form action="<?php echo $form_action; ?>" name="<?php echo $form_name; ?>" method="<?php echo $form_method; ?>" class="widget-zipcode-box form-inline form-centered form-contact-us <?php echo $form_class; ?>">
    <?php

    echo Core::get_hidden_fields(array(
        'show_quotes' => $show_quotes
    ));

    ?>

    <?php if (isset($form_title) && $form_title) { ?>
    <h1 class="<?php echo $form_title_class; ?>"><?php echo $form_title; ?></h1>
    <?php } ?>

    <?php if (isset($form_label_text) && $form_label_text) { ?>
    <label for="<?php echo $form_input_id; ?>" class="form-label <?php echo $form_label_class; ?>"><?php echo $form_label_text; ?></label>
    <?php } ?>
    <div class="row">
        <div class="form-group">
            <input type="tel" id="<?php echo $form_input_id; ?>" name="<?php echo $form_input_id; ?>" class="form-control mask-zip" value="" maxlength="5" placeholder="<?php echo $form_input_placeholder; ?>" />
            <button type="submit" id="<?php echo $form_submit_id; ?>" name="<?php echo $form_submit_id; ?>" class="btn all-t <?php echo $form_submit_class; ?> btn-contact-sm">
                <span class="<?php echo $form_submit_icon; ?>"></span>
            <?php echo $form_submit_text; ?>
            </button>
        </div>
    </div>

    <?php if (isset($form_text) && $form_text) { ?>
    <div class="<?php echo $form_text_class; ?>"><?php echo $form_text; ?></div>
    <?php } ?>
</form>
