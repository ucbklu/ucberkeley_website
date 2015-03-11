UC Berkeley Website
===================

Sign-up form for new managed Open Berkeley site

## Demo Instructions

1. Ensure that "demo mode" is enabled. (ucberkeley_website_demo == 1)
```
[bwood@mbp ~]$ drush @ob7 vget ucberkeley_website_demo
ucberkeley_website_demo: '1'
```
2. If desired, remove past website request submissions
```
bwood@mbp ~]$ drush @ob7 vdel ucberkeley_website_submissions -y
```
