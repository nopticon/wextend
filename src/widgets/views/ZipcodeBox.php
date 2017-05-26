<?php use Nopticon\Wextend\Core; ?>

<form action="<?php echo $form_action; ?>" name="<?php echo $form_name; ?>" method="<?php echo $form_method; ?>" class="widget-zipcode-box form-inline form-centered <?php echo $form_class; ?>">
    <?php

    echo Core::get_hidden_fields(array(
        'show_quotes' => $show_quotes,
        'city'        => '',
        'state'       => '',
    ));

    ?>

    <?php if (isset($form_title) && $form_title) { ?>
    <h1 class="<?php echo $form_title_class; ?>"><?php echo $form_title; ?></h1>
    <?php } ?>

    <?php if (isset($form_label_text) && $form_label_text) { ?>
    <label for="<?php echo $form_input_id; ?>" class="form-label <?php echo $form_label_class; ?>"><?php echo $form_label_text; ?></label>
    <?php } ?>
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-lg-6">
            <input type="tel" id="<?php echo $form_input_id; ?>" name="<?php echo $form_input_id; ?>" class="form-control mask-zip" value="" maxlength="5" placeholder="<?php echo $form_input_placeholder; ?>" title="Enter Your Zip Code"/>
        </div>

        <div class="form-group col-xs-12 col-sm-6 col-lg-6">
            <button type="submit" id="<?php echo $form_submit_id; ?>" name="<?php echo $form_submit_id; ?>" class="btn all-t <?php echo $form_submit_class; ?> btn-contact-sm">
                <?php echo $form_submit_text; ?>
                <i class="<?php echo $form_submit_icon; ?>" aria-hidden="true"></i>
            </button>
        </div>
    </div>
    <?php if (isset($form_text) && $form_text) { ?>
    <div class="<?php echo $form_text_class; ?>"><?php echo $form_text; ?></div>
    <?php } ?>
</form>
