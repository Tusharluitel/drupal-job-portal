<header class="site-header">
    <div class="header-container">
        <a href="<?php print url('<front>'); ?>" class="site-logo">
            <span class="logo-icon"></span>
            <span class="logo-text">JobPortal</span>
        </a>

        <nav class="site-nav">
            <a href="<?php print url('jobs'); ?>" class="nav-link">Browse Jobs</a>
            <?php if (module_exists('jobportal_rating')): ?>
             <a href="<?php print url('organizations'); ?>" class="nav-link">Featured Organizations</a>   
    <?php endif; ?>
    <?php if (module_exists('jobportal_rating') && $is_jobseeker): ?>
             <a href="<?php print url('saved-jobs'); ?>" class="nav-link">My Saved Jobs</a>   
    <?php endif; ?>
            <?php if ($logged_in): ?>
                <div class="user-menu">
                    <a href="<?php
                                if ($is_employer) {
                                    print url('employer/dashboard');
                                } elseif ($is_jobseeker) {
                                    print url('jobseeker-dashboard');
                                } else {
                                    print url('admin/dashboard');
                                }
                                ?>" class="user-avatar-link" title="Go to Dashboard">
                        <div class="user-avatar">
                            <?php print strtoupper(substr($user->name, 0, 1)); ?>
                        </div>
                        <span class="user-name"><?php print check_plain($user->name); ?></span>
                    </a>
                    <a href="<?php print url('user/logout'); ?>" class="nav-link nav-link-logout">Logout</a>
                </div>
            <?php else: ?>
                <!-- Guest User -->
                <a href="<?php print url('user/login'); ?>" class="nav-link">Login</a>
                <a href="<?php print url('user/register'); ?>" class="btn btn-primary btn-nav">Register</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<div class="main-content">
    <?php if ($title): ?>
        <h1 class="page-title"><?php print $title; ?></h1>
    <?php endif; ?>

    <?php if ($messages): ?>
        <?php print $messages; ?>
    <?php endif; ?>

    <?php if ($tabs): ?>
        <div class="tabs"><?php print render($tabs); ?></div>
    <?php endif; ?>

    <?php print render($page['content']); ?>
</div>

<!-- Footer -->
<footer class="site-footer">
    <div class="footer-container">
        <p>&copy; <?php print date('Y'); ?> JobPortal. All rights reserved.</p>
    </div>
</footer>