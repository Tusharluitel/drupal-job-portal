CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Installation
 * Recommended Modules
 * Configuration
 * Credits / contact


Introduction
--------------------------------------------------------------------------------
The Drafty module facilitates handling of draft revisions, aka forward
revisions.

This is an API module for handling drafts of revisions.

This module doesn't provide any workflow handling, but it should provide robust
mechanisms for creating new revisions as drafts, publishing revisions, and
deletion of old drafts.

The goal of drafty is to be a dependency for workflow modules such as Workbench
Moderation, CPS (and others). Currently, each of the workflow modules has their
own implementation for saving draft revisions.

 * For a full description of the module visit:
   https://www.drupal.org/project/drafty

 * To submit bug reports and feature suggestions, or to track changes visit:
   https://www.drupal.org/project/issues/drafty


Requirements
--------------------------------------------------------------------------------
This module requires the following module outside of Drupal core:

 * Entity - https://www.drupal.org/project/entity


Recommended Modules
--------------------------------------------------------------------------------
Drafty provides integrations with the following modules:

 * Entity Translation - https://www.drupal.org/project/entity_translation
 * Field Collection - https://www.drupal.org/project/field_collection
 * Title - https://www.drupal.org/project/title
 * Workbench Moderation - https://www.drupal.org/project/workbench_moderation

Reverts of Entity Translation are broken in core, so if using drafty and
entity_translation modules together please apply the following patch:

 * https://www.drupal.org/project/drupal/issues/1992010#comment-9396483


Installation
--------------------------------------------------------------------------------
Install the Drafty module as you would normally install a contributed Drupal
module. Visit https://www.drupal.org/node/895232 for further information.


Configuration
--------------------------------------------------------------------------------
General Settings:
1. Navigate to Administration > Modules and enable the Drafty module.
2. Navigate to Administration > Configuration > System > Drafty to manage
   Drafty settings.
3. Check the "Enable deleting redundant revisions" box for redundant older
   revisions (those that are marked published->published but are not
   current) to be deleted when a new revision is saved.


Credits / contact
--------------------------------------------------------------------------------
Originally written by Nathaniel Catchpole [1]. Additional contributions by
Fabian Franz [2] and others in the community. Currently maintained by Damien
McKenna [3]. Original development sponsored by Tag1 Consulting [4]. Ongoing
maintenance sponsored by Mediacurrent [5].

The best way to contact the authors is to submit an issue, be it a support
request, a feature request or a bug report, in the project issue queue:
  https://www.drupal.org/project/issues/drafty


References
--------------------------------------------------------------------------------
1: https://www.drupal.org/u/catch
2: https://www.drupal.org/u/fabianx
3: https://www.drupal.org/u/damienmckenna
4: https://www.drupal.org/tag1-consulting
5: https://www.drupal.org/mediacurrent
