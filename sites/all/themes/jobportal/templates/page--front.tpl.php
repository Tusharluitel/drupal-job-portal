
<!-- Site Navigation -->
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
            <?php if (module_exists('jobportal_saved_jobs') && $is_jobseeker): ?>
                <a href="<?php print url('saved-jobs'); ?>" class="nav-link">My Saved Jobs</a>
            <?php endif; ?>
            <?php if ($logged_in): ?>
                <div class="user-menu">
                    <a href="<?php
                                if ($is_employer) {
                                    print url('employer-dashboard');
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
                <a href="<?php print url('user/login'); ?>" class="nav-link">Login</a>
                <a href="<?php print url('user/register'); ?>" class="btn btn-primary btn-nav">Register</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<?php if ($messages): ?>
    <div class="container" style="padding-top: 20px;">
        <?php print $messages; ?>
    </div>
<?php endif; ?>

<?php
drupal_add_js(array('jobportalSearch' => array('searchUrl' => url('api/jobs/search'))), 'setting'); //Drupal.settings.jobportalSearch.searchUrl
?>

<!-- Hero Section -->
<div class="homepage-hero">
    <div class="hero-content">
        <h1>Find Your Dream Job</h1>
        <p>Browse thousands of job opportunities from top companies</p>

        <!-- AJAX Search Bar -->
        <div class="hero-search-wrapper">
            <div class="hero-search-form" role="search">
                <input
                    type="text"
                    id="jobportal-search-input"
                    autocomplete="off"
                    placeholder="Search for a job title, skill, or company…"
                    aria-label="Search jobs" />
                <button class="hero-search-btn" aria-label="Search">🔍</button>
            </div>
            <div id="jobportal-search-results" role="listbox" aria-live="polite"></div>
        </div>

        <div class="hero-buttons">
            <a href="<?php print url('jobs'); ?>" class="btn btn-hero-primary btn-large">Browse All Jobs</a>
            <?php if (!$logged_in): ?>
                <a href="<?php print url('user/register'); ?>" class="btn btn-hero-outline btn-large">Create Account</a>
            <?php endif; ?>
        </div>
    </div>
</div>


<!-- Recent Jobs Section -->
<div class="homepage-jobs">
    <div class="container">
        <h2>Recent Job Openings</h2>

        <?php
        $query = new EntityFieldQuery();
        $query->entityCondition('entity_type', 'node')
            ->entityCondition('bundle', 'job_posting')
            ->propertyCondition('status', 1)
            ->propertyOrderBy('created', 'DESC')
            ->range(0, 6);

        $result = $query->execute();

        if (isset($result['node'])) {
            $job_nids = array_keys($result['node']);
            $jobs = node_load_multiple($job_nids);

            echo '<div class="job-grid">';

            foreach ($jobs as $job) {
                $location = isset($job->field_job_location[LANGUAGE_NONE][0]['value']) ? $job->field_job_location[LANGUAGE_NONE][0]['value'] : '';
                $job_type = isset($job->field_job_type[LANGUAGE_NONE][0]['value']) ? $job->field_job_type[LANGUAGE_NONE][0]['value'] : '';

                echo '<div class="job-card">';
                echo '  <div class="job-card-header">';
                echo '    <div class="company-logo">🏢</div>';
                echo '    <div class="company-info">';
                echo '      <h3><a href="' . url('node/' . $job->nid) . '">' . check_plain($job->title) . '</a></h3>';
                echo '    </div>';
                echo '  </div>';
                echo '  <div class="job-card-body">';
                if ($location) {
                    echo '    <span class="job-meta-item">📍 ' . check_plain($location) . '</span>';
                }
                if ($job_type) {
                    echo '    <span class="job-meta-item">💼 ' . check_plain($job_type) . '</span>';
                }
                echo '  </div>';
                echo '  <div class="job-card-footer">';
                echo '    <a href="' . url('node/' . $job->nid) . '" class="btn btn-outline">View Details</a>';
                echo '  </div>';
                echo '</div>';
            }

            echo '</div>';
        } else {
            echo '<p class="no-jobs">No jobs available at the moment. Check back soon!</p>';
        }
        ?>

        <div class="view-all-jobs">
            <a href="<?php print url('jobs'); ?>" class="btn btn-primary">View All Jobs →</a>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-grid">
            <div class="footer-col">
                <h4>💼 JobPortal</h4>
                <p>Find your dream job or the perfect candidate. Connecting talent with opportunity.</p>
            </div>
            <div class="footer-col">
                <h4>For Jobseekers</h4>
                <ul>
                    <li><a href="<?php print url('jobs'); ?>">Browse Jobs</a></li>
                    <li><a href="<?php print url('user/register'); ?>">Create Account</a></li>
                    <li><a href="<?php print url('user/login'); ?>">Login</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>For Employers</h4>
                <ul>
                    <li><a href="<?php print url('node/add/job-posting'); ?>">Post a Job</a></li>
                    <li><a href="<?php print url('user/register'); ?>">Register</a></li>
                    <li><a href="<?php print url('employer-dashboard'); ?>">Dashboard</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php print date('Y'); ?> JobPortal. All rights reserved.</p>
        </div>
    </div>
</footer>