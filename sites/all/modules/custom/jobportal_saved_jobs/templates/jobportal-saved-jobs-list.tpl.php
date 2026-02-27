<div class="saved-jobs-page">
    <div class="saved-jobs-header">
        <h1 class="saved-jobs-title">My Saved Jobs</h1>
        <p class="saved-jobs-subtitle">Jobs you've bookmarked for later</p>
    </div>

    <?php if (!empty($jobs)): ?>
        <div class="saved-jobs-grid">
            <?php foreach ($jobs as $job): ?>
                <?php
                $company = isset($job->field_company_name[LANGUAGE_NONE][0]['value'])
                    ? check_plain($job->field_company_name[LANGUAGE_NONE][0]['value'])
                    : '';
                $location = isset($job->field_job_location[LANGUAGE_NONE][0]['value'])
                    ? check_plain($job->field_job_location[LANGUAGE_NONE][0]['value'])
                    : '';
                $job_type = isset($job->field_job_type[LANGUAGE_NONE][0]['value'])
                    ? check_plain($job->field_job_type[LANGUAGE_NONE][0]['value'])
                    : '';
                ?>
                <div class="saved-job-card" data-nid="<?php print $job->nid; ?>">
                    <div class="saved-job-card-body">
                        <h2 class="saved-job-card-title">
                            <a href="<?php print url('node/' . $job->nid); ?>"><?php print check_plain($job->title); ?></a>
                        </h2>
                        <div class="saved-job-card-meta">
                            <?php if ($company): ?>
                                <span class="meta-company">&#127970; <?php print $company; ?></span>
                            <?php endif; ?>
                            <?php if ($location): ?>
                                <span class="meta-location">&#128205; <?php print $location; ?></span>
                            <?php endif; ?>
                            <?php if ($job_type): ?>
                                <span class="meta-type"><?php print $job_type; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="saved-job-card-actions">
                        <a href="<?php print url('node/' . $job->nid); ?>" class="btn-view-job">View Job</a>
                        <button class="saved-job-btn is-saved btn-unsave" data-nid="<?php print $job->nid; ?>">
                            &#10005; Unsave
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else: ?>
        <div class="saved-jobs-empty">
            <h3>No saved jobs yet</h3>
            <p>Browse job postings and click <strong>Save Job</strong> to bookmark them here.</p>
            <a href="<?php print url('jobs'); ?>" class="btn-browse-jobs">Browse Jobs</a>
        </div>
    <?php endif; ?>
</div>