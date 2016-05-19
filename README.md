# Preview custom fields WordPress Plugin

## About this plugin

This plugin adds support for a missing piece of WordPress functionality
regarding the previewing of post types with custom meta fields.

By default, the WordPress CMS only stores revisions and preview data for the
primary title (`post_name`) and content (`post_content`) fields. Meta fields are
not included which results in inconsistencies when attempting to view a preview
version of a post type item.

This plugin hooks into the points at which a valid preview revision is made and
enforces the saving of all associated custom fields for the item being
previewed.

## TODO

-   Add setup/installation instructions
-   Add usuage instructions relation to custom field mapper class
