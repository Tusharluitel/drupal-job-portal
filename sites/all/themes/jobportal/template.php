<?php

/**
 * 
 * preprocessing functions .
 */

/**
 * hook_preprocess_html().
 */
function jobportal_preprocess_html(&$variables)
{
  global $user;
  foreach ($user->roles as $role) {
    $variables['classes_array'][] = 'role-' . drupal_html_class($role);
  }
}

/**
 * hook_preprocess_page().
 */
function jobportal_preprocess_page(&$variables)
{
  global $user;
  $variables['is_employer'] = in_array('Employer', $user->roles);
  $variables['is_jobseeker'] = in_array('Jobseeker', $user->roles);
  $variables['user'] = $user;
  $variables['logged_in'] = user_is_logged_in();
}

/**
 */
function jobportal_preprocess_node(&$variables)
{
  if ($variables['type'] == 'job_posting') {
    $variables['theme_hook_suggestions'][] = 'node__job_posting__' . $variables['view_mode'];

    global $user;
    if (user_is_logged_in() && function_exists('jobportal_core_has_applied')) {
      $variables['has_applied'] = jobportal_core_has_applied($user->uid, $variables['node']->nid);
    } else {
      $variables['has_applied'] = FALSE;
    }
  }
}
