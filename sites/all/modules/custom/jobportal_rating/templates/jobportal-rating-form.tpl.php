<div class="rating-form-wrapper">
    <div class="rating-form-header">
        <h2><?php print t('Submit Your Review'); ?></h2>
        <p><?php print t('Your feedback helps other jobseekers learn more about this organization. Please be honest and respectful.'); ?></p>
    </div>

    <div class="rating-form-content">
        <?php
        print drupal_render_children($form);
        ?>
    </div>
</div>