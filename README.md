UC Berkeley Website
===================

Sign-up form for new managed Open Berkeley site

## Installation Instructions

(I've taken care of this.)

* Enable the module
* Install the auth credentials
* vset demo mode (see below)
* Setup CAS redirection for specific pages
```
web-hosting/launch-your-pantheon-site
web-hosting/get-open-berkeley
web-hosting/my-sites
```

## Demo Instructions

### Spin up a site using istdrupal-new-site.php
```
[bwood@mbp pantheon]$ php istdrupal-new-site.php -T --site=start-building \
--site-friendly="Start Building with Open Berkeley" \
--site-mail=bwood@berkeley.edu --builders=212372,212373 --editors=212374,212375 \
--contributors=212376 --parent-org="IST - API" -y
```

### Install Form Save and Restore plugin on Chrome
[Form Save and Restore](https://chrome.google.com/webstore/detail/form-save-and-restore/jknhanfpdjpnkfjjkpofcpegcbhpigcd?hl=en-US)

### Ensure that "demo mode" is enabled.
```
[bwood@mbp ~]$ drush @ob7 vget ucberkeley_website_demo
ucberkeley_website_demo: '1'
```
1 means "enabled." Any other value means "disabled."

### If desired, remove past website request submissions
```
bwood@mbp ~]$ drush @ob7 vdel ucberkeley_website_submissions -y
```
We fake website submissions by stashing them all in an array that is stored in
this drupal site variable. (Later we'll create actual db tables.)

Deleting this variable will clear the sites listed on your [My Websites page](http://test-websolutions-ob.pantheon.berkeley.edu/web-hosting/my-sites).

### Fill out the Start Building Your Website form
Fill out the [Start Building Your Website form](http://test-websolutions-ob.pantheon.berkeley.edu/web-hosting/get-open-berkeley) using the same values that you used in the `istdrupal-new-site.php` command.

**Before you click submit:** Click on the Form Save and Restore icon in your Chrome Toolbar and choose "Save form as it is" so you can refill the form easily at demo time.

Note: Before you use the plugin to fill your form, make sure you have added the same number of builders/editors/contributors that existed when you saved the form data.  (If you don't the data will still be filled, but you'll only have one person in each role.)

Submit the form and dazzle your audience!

The confirmation email is sent to the requestor's email address.

#### Demo Details

Before the demo do `terminus site wake --site=$site_name --env=test` on any sites that you might visit from your My Websites page.

If you link to test-example and the browser spins for more than 5 seconds hit X and it will probably load.  Pantheon caching thing...

## Known Issues

### User input is not yet sanitized
Malicious submissions are possible.

### The order of multiple builders/editors/contributors needs improvement
This applies to both the "Original Request" data on the My Websites page and to the email text.  Currently you see this:
```
...
Site Builder Name: Builder One
Site Builder Name 1: Builder 2
Site Builder Uid: 212372
Site Builder Uid 1: 212373
Editor Name: Editor One
Editor Name 1: Editor Two
Editor Uid: 212374
Editor Uid 1: 212375
...
```

### Add Another doesn't allow removing a row
If you add another Builder, the only way to remove that row is by reloading the page.

### Empty fields for builders/editors/contributors not filtered out
If you submit the form with empty fields, they will appear as empty fields in your confirmation email and in the "Original Request" data.




