<div class="organization-rating-container">
    <div class="rating-summary-header">
        <?php if ($review_count > 0): ?>
            <div class="rating-average">
                <span class="stars"><?php print str_repeat('⭐', round($avg_rating)); ?></span>
                <span class="score"><?php print number_format($avg_rating, 1); ?>/5</span>
                <span class="count">(based on <?php print $review_count; ?> reviews)</span>
            </div>
        <?php else: ?>
            <div class="rating-average no-ratings">
                <strong><?php print t('Rating:'); ?></strong> <?php print t('Not yet rated.'); ?>
            </div>
        <?php endif; ?>

        <?php if ($view_mode == 'full' && in_array('Jobseeker', $GLOBALS['user']->roles)): ?>
            <div class="rate-action">
                <?php if (!$has_rated): ?>
                    <?php print l(t('Rate this Organization'), 'node/' . $node->nid . '/rate', array('attributes' => array('class' => array('button', 'btn-rate-org')))); ?>
                <?php else: ?>
                    <span class="has-rated-msg">✓ <?php print t('You have rated this organization.'); ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php if (!empty($reviews)): ?>
        <div class="reviews-list">
            <h3><?php print t('Recent Reviews'); ?></h3>
            <?php foreach ($reviews as $review): ?>
                <?php
                // Unserialize pros and cons
                $pros = !empty($review->pros) ? unserialize($review->pros) : array();
                $cons = !empty($review->cons) ? unserialize($review->cons) : array();

                // Get reviewer name
                $reviewer = user_load($review->rater_uid);
                $reviewer_name = $reviewer ? format_username($reviewer) : t('Jobseeker');
                ?>
                <div class="review-item">
                    <div class="review-header">
                        <span class="review-stars"><?php print str_repeat('⭐', $review->rating); ?></span>
                        <span class="review-author"><?php print t('By @name on @date', array('@name' => $reviewer_name, '@date' => format_date($review->timestamp, 'custom', 'M j, Y'))); ?></span>
                    </div>

                    <?php if (!empty($review->comment)): ?>
                        <div class="review-comment">
                            <?php print check_plain($review->comment); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($pros) || !empty($cons)): ?>
                        <div class="review-pros-cons">
                            <?php if (!empty($pros)): ?>
                                <div class="pros-list">
                                    <h4><?php print t('Pros'); ?></h4>
                                    <ul>
                                        <?php foreach ($pros as $pro): ?>
                                            <li><?php print check_plain($pro); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($cons)): ?>
                                <div class="cons-list">
                                    <h4><?php print t('Cons'); ?></h4>
                                    <ul>
                                        <?php foreach ($cons as $con): ?>
                                            <li><?php print check_plain($con); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>