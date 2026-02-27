<div class="jobs-page" style="padding: 40px 20px; max-width: 1200px; margin: 0 auto;">

    <div class="jobs-page-header" style="margin-bottom: 40px; text-align: center;">
        <h1 style="font-size: 2.5rem; color: #1e293b; margin-bottom: 10px;">All Job Listings</h1>
        <p class="jobs-count" style="color: #64748b; font-size: 1.1rem;">
            <?php print $total; ?> <?php print($total == 1 ? 'job' : 'jobs'); ?> available
        </p>
    </div>

    <?php if (!empty($jobs)): ?>

        <div class="job-grid">
            <?php foreach ($jobs as $job): ?>
                <div class="job-card">
                    <div class="job-card-header">
                        <div class="company-logo">🏢</div>
                        <div class="company-info">
                            <h3><a href="<?php print $job['url']; ?>"><?php print $job['title']; ?></a></h3>
                        </div>
                    </div>

                    <div class="job-card-body">
                        <?php if ($job['location']): ?>
                            <span class="job-meta-item">📍 <?php print $job['location']; ?></span>
                        <?php endif; ?>

                        <?php if ($job['job_type']): ?>
                            <span class="job-meta-item">💼 <?php print $job['job_type']; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="job-card-footer">
                        <a href="<?php print $job['url']; ?>" class="btn btn-outline">View Details</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($pager): ?>
            <div class="" style="margin-top: 50px; text-align: center;">
                <?php print $pager; ?>
            </div>
        <?php endif; ?>

    <?php else: ?>

        <div class="jobs-empty" style="text-align: center; padding: 60px 20px; background: #f8fafc; border-radius: 12px; border: 1px dashed #cbd5e1;">
            <p style="color: #64748b; font-size: 1.1rem; margin: 0;">No jobs are available at the moment. Please check back soon!</p>
        </div>

    <?php endif; ?>

</div>