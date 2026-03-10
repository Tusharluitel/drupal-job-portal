# Job Portal Application - Drupal 7 Architecture & Documentation

## Overview
This document outlines the architecture and development methodology for the Job Portal application built on Drupal 7. The system is designed to provide a robust platform for job seekers and employers, leveraging Drupal's core strengths, custom module development, entity architecture, and modern front-end integration.

## Understanding the Drupal Methodology
This application is built by adhering to the "Drupal Way", which emphasizes:
- **Separation of Concerns:** Business logic resides in custom modules, while presentation logic is strictly handled by the custom theme.
- **Hook System:** We heavily utilize Drupal's Core Form API and Hook system (`hook_menu`, `hook_theme`, `hook_cron`, `hook_node_view`, etc.) to extend and modify core behavior.
- **Content as Nodes vs Entities:** Standard content (Job Postings, Organization Profiles) are managed as Nodes, gaining the benefit of built-in field APIs and revisions. Specific functional data structures (like user "Saved Jobs") are built as Custom Entities to optimize database performance and maintain a clean data model.


## Custom Modules
The business logic is modularized into feature-specific custom modules located in `sites/all/modules/custom/`:

### 1. Job Portal Core (`jobportal_core`)
The backbone of the application.
- **Routing & Permissions:** Defines custom `hook_menu` paths for applicant and employer dashboards.
- **Pagination:** Utilizes pagination to load certain number of jobs when 
- **Email Notifications:** Implements custom mail sending logic using `drupal_mail()` and cron queues. For example, when a candidate's application status updates to "Hired", the module pushes an email job to a `DrupalQueue` for asynchronous processing via cron, preventing page-load delays.

### 2. Job Portal Rating (`jobportal_rating`)
Handles the review and rating system for Organization profiles.
- **AJAX Interactions:** Utilizes custom JavaScript to handle asynchronous rating submissions, providing a seamless user experience without full page reloads.
- **Validation:** Implements both client and server side validation when user attempts to enter the Pros and Cons.
- **Custom Templates:** Declares module-specific templates utilizing `hook_theme` to render the rating dashboards cleanly.

### 3. Job Portal Saved Jobs (`jobportal_saved_jobs`)
Advanced custom entity implementation.
- **Custom Entity Architecture:** Instead of using heavy nodes, "Saved Jobs" are implemented as lightweight custom entities with their own database schema defined in `hook_schema()`.
- **Entity Controller:** Implements a custom EntityController (`SavedJobController.inc`) that provides CRUD operations (Create, Read, Update, Delete) for the saved job records.
- **AJAX & JavaScript:** Provides an interactive "Save / Unsave" toggle button on job listings that updates the database asynchronously via custom menu callbacks and JS handlers.

## Front-End & Theming
### Custom Theme (`jobportal`)
The presentation layer is built in `sites/all/themes/jobportal`.
- **Template Overrides:** Uses `page--front.tpl.php`, `node--organization-profile.tpl.php`, and other template overrides to create a completely custom, modern layout matching premium aesthetics.
- **Preprocess Functions:** Utilizes `template_preprocess_node` and `template_preprocess_page` in `template.php` to prepare complex variables before they hit the markup, keeping `.tpl.php` files clean and logic-free.
- **CSS Architecture:** Employs modular CSS styling with modern responsive design principles to deliver a visually exceptional UI/UX.

## Utilization of CMS Features (Site Building)
Beyond code, the portal heavily relies on Drupal's robust site-building tools:

- **Views:** Used to query the database visually without writing raw SQL. Views handle complex lists like "Latest Jobs," "Search Results," and "Applicant Lists" with pagination, exposed filters, and precise sorting.
- **Rules:** Used to trigger custom actions based on site events (e.g., welcome message when a user registers, sending mail to admin for job approval) without writing custom code, keeping business rules manageable by administrators.
- **Taxonomy:** Categorization engine used for Job Categories. This allows jobs to be tagged dynamically and creates instant landing pages for category-specific feeds.
- **SMTP Mailing System:** Integrated with the SMTP Authentication Support module (or similar) to ensure high deliverability of system notifications (like the hired candidate emails).

## Conclusion
This Job Portal application demonstrates a deep understanding of Drupal 7's architecture. By carefully balancing custom module development (code), custom theming (presentation), and site building tools (configuration), the platform is performant, maintainable, and highly scalable.
