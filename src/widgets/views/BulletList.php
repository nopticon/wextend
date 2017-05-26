<div class="<?php echo $bullet_class; ?>">
    <article>
        <?php if (!empty($bullet_title)) { ?>
        <div class="bullet_title"><?php echo $bullet_title; ?></div>
        <?php } ?>

        <p class="bullet_content">
            <ul>
                <?php foreach ($bullet_list as $row) { ?>
                <li><i class="<?php echo $bullet_icon; ?>"></i> <?php echo $row; ?></li>
                <?php } ?>
            </ul>
        </p>

        <?php if (!empty($bullet_action_text)) { ?>
        <a href="<?php echo $bullet_action_url; ?>" class="<?php echo $bullet_action_class; ?>">
            <?php echo $bullet_action_text; ?>
        </a>
        <?php } ?>
    </article>
</div>
