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

## Installing

To install, simply download a `.zip` version of this repository and upload to
your WordPress instance via the Admin screens,
`Plugins -> Add New -> Upload Plugin`. Finally, active the plugin.

## Usage

Every time a post item is previewed, this plugin will loop through an array of
custom field meta keys and ensure they are saved correctly against the revision
or autosave for the current item.

In order to add fields to this process you will need to use the following
class function:

```PHP
PreviewCustomFields::add_meta_keys([
  '_cmb2_page_author_name',
  '_cmb2_page_author_age'
]);
```

The code above adds the two example custom fields `_cmb2_page_author_name` and
`_cmb2_page_author_age` fields. You can call this method as many times as
required or all at once.
