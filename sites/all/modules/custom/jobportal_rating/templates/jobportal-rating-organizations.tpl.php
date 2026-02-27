<div class="rating-organizations-container">
    <div class="organizations-grid">
        <?php foreach ($organizations as $node): ?>
            <div class="organization-card">
                <?php
                if (!empty($node->field_logo['und'][0]['uri'])) {
                    $image = array(
                        'style_name' => 'thumbnail',
                        'path' => $node->field_logo['und'][0]['uri'],
                        'alt' => $node->title . ' Logo',
                        'title' => $node->title,
                    );
                    print '<div class="org-card-logo">' . theme('image_style', $image) . '</div>';
                } else {
                    $default_image = array(
                        'path' => 'sites/default/files/default_images/images.png',
                        'alt' => $node->title . ' Default Logo',
                        'title' => $node->title,
                        'attributes' => array('style' => 'width: 100px; height: auto; display: block; margin: 0 auto;'), // Roughly thumbnail size
                    );
                    print '<div class="org-card-logo">' . theme('image', $default_image) . '</div>';
                }
                ?>
                <h3>
                    <?php print l($node->title, 'node/' . $node->nid); ?>
                </h3>

                <div class="org-card-body">
                    <?php
                    if (!empty($node->body['und'][0]['summary'])) {
                        print check_markup($node->body['und'][0]['summary'], $node->body['und'][0]['format']);
                    } elseif (!empty($node->body['und'][0]['value'])) {
                        print text_summary($node->body['und'][0]['value'], $node->body['und'][0]['format'], 150);
                    } else {
                        print t('No description provided.');
                    }
                    ?>
                </div>

                <div class="org-card-footer">
                    <?php print l(t('View & Rate'), 'node/' . $node->nid, array('attributes' => array('class' => array('btn-rate')))); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>