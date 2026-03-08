<div class="emp-dashboard">
    <div class="emp-dashboard__header">
        <div class="emp-dashboard__heading">
            <h1 class="emp-dashboard__title">Employer Dashboard</h1>
            <p class="emp-dashboard__subtitle">Manage your job listings and track applications</p>
        </div>
        <div class="emp-dashboard__actions">
            <?php if ($has_org_profile): ?>
                <a href="<?php print $org_url; ?>" class="emp-btn emp-btn--outline emp-btn--large" style="margin-right: 12px;">
                    <span class="emp-btn__icon">🏢</span> Edit Org Profile
                </a>
            <?php else: ?>
                <a href="<?php print $org_url; ?>" class="emp-btn emp-btn--outline emp-btn--large" style="margin-right: 12px; border-color: #2563eb; color: #2563eb;">
                    <span class="emp-btn__icon">🏢</span> Add Org Profile
                </a>
            <?php endif; ?>
            <a href="<?php print url('node/add/job-posting'); ?>" class="emp-btn emp-btn--primary emp-btn--large">
                <span class="emp-btn__icon">＋</span> Post a Job
            </a>
        </div>
    </div>
    <div class="emp-stats">
        <div class="emp-stat-card emp-stat-card--blue">
            <div class="emp-stat-card__icon">📋</div>
            <div class="emp-stat-card__body">
                <span class="emp-stat-card__number"><?php print $total_jobs; ?></span>
                <span class="emp-stat-card__label">Total Postings</span>
            </div>
        </div>
        <div class="emp-stat-card emp-stat-card--green">
            <div class="emp-stat-card__icon">✅</div>
            <div class="emp-stat-card__body">
                <span class="emp-stat-card__number"><?php print $active_jobs; ?></span>
                <span class="emp-stat-card__label">Active Listings</span>
            </div>
        </div>
        <div class="emp-stat-card emp-stat-card--gray">
            <div class="emp-stat-card__icon">⏸</div>
            <div class="emp-stat-card__body">
                <span class="emp-stat-card__number"><?php print $inactive_jobs; ?></span>
                <span class="emp-stat-card__label">Inactive / Draft</span>
            </div>
        </div>
    </div>

    <?php if (empty($jobs)): ?>
        <div class="emp-empty">
            <div class="emp-empty__icon">📂</div>
            <h2 class="emp-empty__title">No job postings yet</h2>
            <p class="emp-empty__text">You haven't posted any jobs. Create your first listing now!</p>
            <a href="<?php print url('node/add/job-posting'); ?>" class="emp-btn emp-btn--primary">
                <span class="emp-btn__icon">＋</span> Post a Job
            </a>
        </div>
    <?php else: ?>
        <div class="emp-table-wrap">
            <table class="emp-table">
                <thead>
                    <tr>
                        <th class="emp-table__th">Job Title</th>
                        <th class="emp-table__th">Category</th>
                        <th class="emp-table__th">Posted</th>
                        <th class="emp-table__th emp-table__th--center">Status</th>
                        <th class="emp-table__th emp-table__th--center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jobs as $job): ?>
                        <tr class="emp-table__row">
                            <td class="emp-table__td emp-table__td--title">
                                <a href="<?php print $job['url']; ?>" class="emp-table__job-link">
                                    <?php print $job['title']; ?>
                                </a>
                            </td>
                            <td class="emp-table__td">
                                <?php if ($job['category']): ?>
                                    <span class="emp-category-pill"><?php print $job['category']; ?></span>
                                <?php else: ?>
                                    <span class="emp-table__no-data">—</span>
                                <?php endif; ?>
                            </td>
                            <td class="emp-table__td emp-table__td--date">
                                <span class="emp-date-icon">🗓</span>
                                <?php print $job['created']; ?>
                            </td>
                            <td class="emp-table__td emp-table__td--center">
                                <?php if ($job['status']): ?>
                                    <span class="emp-badge emp-badge--active">Active</span>
                                <?php else: ?>
                                    <span class="emp-badge emp-badge--inactive">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td class="emp-table__td emp-table__td--center">
                                <a href="<?php print $job['edit_url']; ?>" class="emp-btn emp-btn--outline emp-btn--sm" title="Edit Job Posting">
                                    ✏ Edit
                                </a>
                                <?php if ($job['applicant_count'] > 0): ?>
                                    <a href="<?php print $job['applicants_url']; ?>" class="emp-btn emp-btn--primary emp-btn--sm" style="margin-left: 8px;" title="View <?php print $job['applicant_count']; ?> Applicant(s)">
                                        👥 Applicants
                                        <span style="background: rgba(255,255,255,0.25); border-radius: 12px; padding: 2px 6px; font-size: 0.8em; margin-left: 6px;"><?php print $job['applicant_count']; ?></span>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>