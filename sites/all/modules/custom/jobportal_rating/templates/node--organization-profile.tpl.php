<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix organization-profile-premium" <?php print $attributes; ?>>

    <?php print render($title_prefix); ?>
    <?php if (!$page): ?>
        <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
        <?php endif; ?>
        <?php print render($title_suffix); ?>

        <div class="content org-profile-content-wrapper" <?php print $content_attributes; ?>>
            <?php
            hide($content['comments']);
            hide($content['links']);
            hide($content['jobportal_rating']);
            hide($content['field_logo']);
            ?>

            <div class="org-profile-hero">
                <?php if (!empty($content['field_logo'])): ?>
                    <div class="org-profile-hero-logo">
                        <?php print render($content['field_logo']); ?>
                    </div>
                <?php endif; ?>

                <div class="org-profile-hero-details">
                    <?php if ($page): ?>
                        <h1 class="org-hero-title"><?php print $title; ?></h1>
                    <?php endif; ?>
                    <div class="org-hero-description">
                        <?php
                        print render($content);
                        ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="org-profile-ratings-wrapper">
            <?php print render($content['jobportal_rating']); ?>
        </div>

        <?php print render($content['links']); ?>
        <?php print render($content['comments']); ?>

</div>