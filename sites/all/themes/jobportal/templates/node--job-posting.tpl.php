<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> job-detail">
    <div class="job-detail-header">
        <h1 class="job-title"><?php print $title; ?></h1>
        <div class="job-meta">
            <?php if (!empty($content['field_company_name'])): ?>
                <span class="company">
                    <?php print render($content['field_company_name']); ?>
                </span>
            <?php endif; ?>
            <?php if (!empty($content['field_job_location'])): ?>
                <span class="location">
                    <?php print render($content['field_job_location']); ?>
                </span>
            <?php endif; ?>
            <?php if (!empty($content['field_job_type'])): ?>
                <span class="job-type">
                    <?php print render($content['field_job_type']); ?>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <div class="job-detail-body">
        <div class="job-main">
            <?php if (!empty($content['field_job_category'])): ?>
                <div class="job-categories">
                    <h3>Categories</h3>
                    <?php print render($content['field_job_category']); ?>
                </div>
            <?php endif; ?>

            <div class="job-description">
                <h3>Job Description</h3>
                <?php print render($content['body']); ?>
            </div>

            <?php if (!empty($content['field_required_skills'])): ?>
                <div class="job-skills">
                    <h3>Required Skills</h3>
                    <?php print render($content['field_required_skills']); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($content['field_education_required'])): ?>
                <div class="job-education">
                    <h3>Education</h3>
                    <?php print render($content['field_education_required']); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="job-sidebar">
            <div class="job-info-card">
                <h3>Job Details</h3>
                <ul>
                    <?php if (!empty($content['field_experience_level'])): ?>
                        <li><strong>Experience:</strong> <?php print render($content['field_experience_level']); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($content['field_salary_range'])): ?>
                        <li><strong>Salary:</strong> <?php print render($content['field_salary_range']); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($content['field_vacancies'])): ?>
                        <li><strong>Vacancies:</strong> <?php print render($content['field_vacancies']); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($content['field_application_deadline'])): ?>
                        <li><strong>Deadline:</strong> <?php print render($content['field_application_deadline']); ?></li>
                    <?php endif; ?>
                </ul>

                <?php
                global $user;
                if (user_is_logged_in() && in_array('Jobseeker', $user->roles)):
                ?>
                    <?php if (isset($has_applied) && $has_applied): ?>
                        <button class="btn btn-secondary btn-block" disabled style="background-color: #10b981; color: white; cursor: not-allowed; opacity: 0.8;">
                            Applied
                        </button>
                    <?php else: ?>
                        <a href="<?php print url('apply', array('query' => array('nid' => $node->nid, 'job' => $title))); ?>" class="btn btn-primary btn-block">
                            Apply Now
                        </a>
                    <?php endif; ?>
                <?php elseif (!user_is_logged_in()): ?>
                    <a href="<?php print url('user/login', array('query' => array('destination' => 'apply?nid=' . $node->nid . '&job=' . urlencode($title)))); ?>" class="btn btn-outline btn-block">
                        Login to Apply
                    </a>
                <?php endif; ?>

                <?php if (!empty($content['saved_job_toggle'])): ?>
                    <?php print render($content['saved_job_toggle']); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</article>