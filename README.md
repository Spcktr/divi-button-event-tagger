# Link and Button Tagger for Divi

This is a simple WordPress plugin that inserts missing Google Analytics data-vars attributes for divi buttons

---

## Description

Once this plugin in installed and activated it will find any Divi theme builder inserted button and insert missing Google Analytics tracking tags.

Buttons that are added using Divi are missing any id field and as such can make it difficult to track automatically.

Some theme builders, such as Divi, don't provide a way for users to insert these attributes easily (or at all in some cases). 

This plugin automatically finds the button css class and inserts the missing attributes (found below) so as to make the buttons trackable in Google Analytics.

The results in Google Analytics appear as behavior events as `Page title - button name`.

### Inserted Tags

```
data-vars-ga-action
data-vars-ga-label
data-vars-ga-category
```


## Installation and Usage

1. Options to install the plugin
   1. Install through the WordPress plugins page (recommended)
   2. Manually upload contents of the plugin zip and uploading to /wp-content/plugins/divi-button-event-tagger/ folder
2. Activate the plugin in the 'Plugins' page.
3. Once installed and activated, the plugin runs automatically for all pages on your WordPress site.
4. A `button_event_selector` filter is available if you need to use this with other theme/page builders.

### Example button_event_selector Filter

```JS
function my_custom_button_event_selector($query_selector) {
    return '.some_other_class';
}
add_filter( 'button_event_selector', 'my_custom_button_event_selector' );
```

---

## Example Divi Source

This plugin is orginally intended to work with Divi. It can, however, be adapted with any theme/page builder as it is looking for a specific class attribute which can be adjusted.

### Default

No attributes set.

```html
<a class="et_pb_button et_pb_more_button et_pb_button_one" href="https://URL.com/contact-form">Get Started Now</a>
```

### After the Tagger is Activated

Google Analytics attributes set.

```html
<a class="et_pb_button et_pb_more_button et_pb_button_one" href="https://URL.com/contact-form" data-vars-ga-category="cta" data-vars-ga-action="click" data-vars-ga-label="Get Started Now">Get Started Now</a>
```
