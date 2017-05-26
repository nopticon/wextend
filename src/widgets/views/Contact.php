<form name="<?php echo $form_name; ?>" method="<?php echo $form_method; ?>" action="<?php echo $form_action; ?>" class="widget-contact inline-control col-sm-12 col-md-12 col-lg-12 <?php echo $form_class; ?>">
    <div>
        <h3><?php echo isset($form_text_title) ? $form_text_title : '' ?></h3>
        <p><?php echo isset($form_text_subtitle) ? $form_text_subtitle : '' ?></p>
    </div>
    <div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="form-group">
                <label class="control-label" for="your-name">Your Name:*</label>
                <input id="your-name" name="your-name" type="text" class="form-control" tabindex="1" title="Please enter your Name">
            </div>
        </div>
    </div>

    <div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="form-group">
                <label class="control-label" for="your-email">Your email:*</label>
                <input id="your-email" name="your-email" type="text" class="form-control" tabindex="2" title="Please enter a valid email address">
            </div>
        </div>
    </div>

    <div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="form-group">
                <label class="control-label" for="your-phone">Your Phone:</label>
                <input id="your-phone" name="your-phone" type="text" class="form-control mask-phone" tabindex="3" placeholder="(   )    -    ">
            </div>
        </div>
    </div>

    <div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="form-group">
                <label class="control-label" for="your-message">Your Message:*</label>
                <textarea id="your-message" name="your-message" class="form-control" tabindex="4" title="Please enter your message"></textarea>
            </div>
        </div>
    </div>

    <div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="form-group">
                <div class="g-recaptcha" data-sitekey="<?php echo $form_recaptcha; ?>" data-callback="do_recaptcha"></div>
            </div>
        </div>
    </div>

    <div>
        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 mobile-centered">
            <div class="form-group">
                <button type="submit" id="btn-submit" class="btn btn-lg all-t btn-contact-sm no-margin-left" tabindex="5"><?php echo $form_submit_text; ?></button>
            </div>
        </div>
    </div>
    <div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item-form">
            <p>By clicking "Send Message", I agree to the terms of this website's <a href="privacy-policy/">Privacy Policy</a></p>
        </div>
    </div>
</form>
<script src='https://www.google.com/recaptcha/api.js'></script>
