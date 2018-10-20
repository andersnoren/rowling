=== Rowling ===
Contributors: Anlino
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=anders%40andersnoren%2ese&lc=US&item_name=Free%20WordPress%20Themes%20from%20Anders%20Noren&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Requires at least: 4.4
Tested up to: 4.8
Stable tag: trunk
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html


== Installation ==

1. Upload the theme
2. Activate the theme

All theme specific options are handled through the WordPress Customizer.


== Frequently Asked Questions ==

== Use the gallery post format 

1. Go to Admin > Posts > Add New.
2. Select the "Gallery" post format in the Post Attributes box.
3. Click "Add Media" and upload the images you wish to display in the gallery.
4. Close the Media window and publish/update the post.
5. The images you uploaded should now be displayed in the post gallery.


== Use the social menu in the header

1. Go to Admin > Appearance > Menus.
2. Create a new menu.
3. Click the "Links" dropdown in the left sidebar, and add the URL and title of the social link you wish to include. 
4. Click "Add to Menu" to add it to the menu. Repeat for each link you wish to include.
5. Scroll down to "Menu Settings", and next to "Theme locations", select "Social Menu". Click save.
6. The menu should now be displayed on the site.



== Licenses ==

Lato
License: SIL Open Font License, 1.1 
Source: https://fonts.google.com/specimen/Lato

Merriweather
License: SIL Open Font License, 1.1 
Source: https://fonts.google.com/specimen/Merriweather

FontAwesome font 
License: SIL Open Font License, 1.1 
Source: http://www.fontawesome.io

Included header image
License: CC0 Public Domain 
Source: http://www.unsplash.com

screenshot.png images
License: CC0 Public Domain 
Source: http://www.unsplash.com

Doubletaptogo.js
License: MIT License
Source: https://github.com/dachcom-digital/jquery-doubletaptogo

Flexslider.js
License: GNU GPL v2.0 
Source: http://flexslider.woothemes.com



== Changelog ==

Version 1.13 (2018-10-20)
-------------------------
- Updated with Gutenberg support
	- Gutenberg editor styles
	- Styling of Gutenberg blocks
	- Custom Rowling Gutenberg palette
	- Custom Rowling Gutenberg typography styles
- Added option to disable Google Fonts with a translateable string
- Updated theme description
- Removed the languages sub folder, since that is handled by WordPress.org

Version 1.12 (2018-05-24)
-------------------------
- Fixed output of cookie checkbox in comments

Version 1.11 (2017-12-12)
-------------------------
- Fixed recent posts issue with the current post

Version 1.10 (2017-12-03)
-------------------------
- Fixed the author description output being broken on single.php due to 4.9 wrapping the description field in a paragraph
- Removed link wrapper around title and post thumbnail on singular

Version 1.09 (2017-12-03)
-------------------------
- Fixed post-content intro paragraph (.intro) not being targeted by the customizer accent color setting

Version 1.08 (2017-12-03)
-------------------------
- Updated to the new readme.txt format, with changelog.txt incorporated into it
- Added a demo link to the stylesheet theme description
- Added a deliberate dependency order to the stylesheet enqueueing
- Same for scripts enqueues
- Made all functions in functions.php pluggable
- Replaced a new WP_Query in widgets/recent-posts.php with a get_posts()
- Fixed genericons path
- Fixed notice in comments.php
- Changed closing element comment structure
- General code cleanup, improvements in readability
- Fixed potential overflow issue on mobile for the blog title and logo
- Restructured the related posts query to be more lean

Version 1.07 (2017-11-30)
-------------------------
- Fixed warnings in comments.php

Version 1.06 (2017-11-24)
-------------------------
- Fixed notices in comments.php
- Made theme strings translateable in index.php and comments.php

Version 1.05 (2016-06-18)
-------------------------
- Added the new theme directory tags
– Tweaked footer style and structure

Version 1.04 (2015-08-11)
------------------------- 
- Added clearing divs after the post content on single posts/pages
- Changed the titles on single posts/pages to H1 elements for SEO benefits
- Fixed so that Jetpack Tiled Galleries plays nice with the related posts field
- Fixed so that img#wpstats is hidden
- Changed post title on 404 from h2 to h1 for SEO reasons
- Fixed so that widgets use __construct() in prep for WP 4.3

Version 1.03 (2015-04-07)
------------------------- 
- Added some missing PHP functions to the footer

Version 1.02 (2015-02-28)
------------------------- 
- Renamed lovecraft.pot to rowling.pot. This is why you don't do two themes at once, kids.

Version 1.01 (2015-02-23)
------------------------- 
- Replaced doubletaptogo.min.js with doubletaptogo.js (non-minified version)
- Replaced flexslider.min.js with flexslider.js (non-minified version)
- Replaced fontawesome.min.css with fontawesome.css (non-minified version)
- Renamed xx_XX.pot to rowling.pot
- Added theme text-domain to style.css
- Removed wp_is_mobile() from functions.php
- Added theme function prefix to html_js_class() in functions.php
- Changed home_url() to home_url('/') in header.php

Version 1.00 (2015-02-03)
------------------------- 