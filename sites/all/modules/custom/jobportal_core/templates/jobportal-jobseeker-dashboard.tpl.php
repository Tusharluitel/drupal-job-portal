
<div class="emp-dashboard">

    <!-- Header bar -->
    <div class="emp-dashboard__header">
        <div class="emp-dashboard__heading">
            <h1 class="emp-dashboard__title">Welcome, <?php print $username; ?>!</h1>
            <p class="emp-dashboard__subtitle">Track your job applications and manage your profile</p>
        </div>
        <div class="emp-dashboard__actions">
            <a href="<?php print url('jobs'); ?>" class="emp-btn emp-btn--primary emp-btn--large">
                <span class="emp-btn__icon">💼</span> Find Jobs
            </a>
        </div>
    </div>

    <!-- Stats row -->
    <div class="emp-stats">
        <div class="emp-stat-card emp-stat-card--blue">
            <div class="emp-stat-card__icon">📬</div>
            <div class="emp-stat-card__body">
                <span class="emp-stat-card__number"><?php print $total_apps; ?></span>
                <span class="emp-stat-card__label">Total Applications</span>
            </div>
        </div>
        <div class="emp-stat-card emp-stat-card--gray">
            <div class="emp-stat-card__icon">⭐️</div>
            <div class="emp-stat-card__body">
                <span class="emp-stat-card__number"><?php print $shortlisted; ?></span>
                <span class="emp-stat-card__label">Shortlisted</span>
            </div>
        </div>
        <div class="emp-stat-card emp-stat-card--green">
            <div class="emp-stat-card__icon">🎉</div>
            <div class="emp-stat-card__body">
                <span class="emp-stat-card__number"><?php print $hired; ?></span>
                <span class="emp-stat-card__label">Hired</span>
            </div>
        </div>
    </div>

    <?php if (empty($applications)): ?>
        <div class="emp-empty">
            <div class="emp-empty__icon">🚀</div>
            <h2 class="emp-empty__title">Ready to find your dream job?</h2>
            <p class="emp-empty__text">You haven't applied to any jobs yet. Start browsing now.</p>
            <a href="<?php print url('jobs'); ?>" class="emp-btn emp-btn--primary">
                <span class="emp-btn__icon">💼</span> Find Jobs
            </a>
        </div>
    <?php else: ?>
        <div class="emp-table-wrap">
            <table class="emp-table">
                <thead>
                    <tr>
                        <th class="emp-table__th">Applied Position</th>
                        <th class="emp-table__th">Applied On</th>
                        <th class="emp-table__th emp-table__th--center">Status</th>
                        <th class="emp-table__th emp-table__th--center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($applications as $app): ?>
                        <tr class="emp-table__row">
                            <td class="emp-table__td emp-table__td--title">
                                <a href="<?php print $app['url']; ?>" class="emp-table__job-link">
                                    <?php print $app['title']; ?>
                                </a>
                            </td>
                            <td class="emp-table__td emp-table__td--date">
                                <span class="emp-date-icon">🗓</span>
                                <?php print $app['date']; ?>
                            </td>
                            <td class="emp-table__td emp-table__td--center">
                                <?php
                                $status_lower = strtolower($app['status']);
                                $badge_class = 'emp-badge--inactive'; 

                                if ($status_lower === 'hired') {
                                    $badge_class = 'emp-badge--active'; 
                                } elseif ($status_lower === 'shortlisted') {
                                    $badge_class = 'emp-badge--info'; 
                                } elseif ($status_lower === 'rejected') {
                                    $badge_class = 'emp-badge--danger'; 
                                } elseif ($status_lower === 'applied') {
                                    $badge_class = 'emp-badge--accent'; 
                                }
                                ?>
                                <span class="emp-badge <?php print $badge_class; ?>"><?php print check_plain($app['status']); ?></span>
                            </td>
                            <td class="emp-table__td emp-table__td--center">
                                <a href="<?php print $app['url']; ?>" class="emp-btn emp-btn--outline emp-btn--sm">
                                    👀 View Job
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>