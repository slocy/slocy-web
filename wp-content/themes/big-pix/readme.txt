================
BIGPIX THEME
================

BIGPIX THEME WordPress Theme, Copyright 2014 http://wpdevshed.com/themes/big-pix/
BIGPIX THEME is distributed under the terms of the GNU GPL

===========
ABOUT Theme
=========== 
Big Pix is a pretty standard blogging theme, albeit with a real focus on large format images on the home page and archive pages. The post pages also use a full sized featured image, not unlike the style popularised by Medium. You can easily upload your own logo and favicon, or change the default colour scheme to anything you like. It is also has dedicated widget areas for pages, posts, archive pages and the home page so you have a great deal of flexibility over the content on these page types. And of course it is fully responsive.

This theme is compatible with WordPress Version 3.8 and above and it supports the new theme customization API (https://codex.wordpress.org/Theme_Customization_API).

Supported browsers: Firefox, Opera, Chrome, Safari and IE9+ (Some css3 styles like shadows and rounder corners are not supported by IE8 and below).


============================================
This theme uses Toolbox as a theme framework
============================================
 * Toolbox (http://wordpress.org/extend/themes/toolbox)
 * Copyright (c) Automattic (http://automattic.com)
 * Available under the terms of GNU GPL.
 
======================================
This theme uses Bones as a design tool
======================================
 * Bones (http://themble.com/bones)
 * Copyright (c) Eddie Machado (http://eddiemachado.com/)
 * This is totally free and under WTFPL license (Please read http://themble.com/bones/ for more information)

======================================
This theme uses jQuery custom content scroller
======================================
* http://manos.malihu.gr/jquery-custom-content-scroller/
* jQuery custom content scroller by malihu
* licensed under a MIT License (MIT).

=====================================
This theme is bundled with Modernizr 
=====================================
 * Modernizr v2.6.2 (www.modernizr.com)
 * Modernizr is a JavaScript library that detects HTML5 and CSS3 features in the user’s browser.
 * Copyright (c) Faruk Ates, Paul Irish, Alex Sexton
 * Available under the BSD and MIT licenses: www.modernizr.com/license/
 
 
=================================
This theme is bundled with Cycle2
=================================
 * Cycle2 v20130202 (http://jquery.malsup.com/cycle2/)
 * Cycle2 is a versatile slideshow plugin for jQuery built around ease-of-use. It supports a declarative initialization style that allows full customization without any scripting.
 * Copyright © 2012 M. Alsup (https://github.com/malsup)
 * The Cycle2 plugin is dual licensed under the MIT (http://malsup.github.com/mit-license.txt) and GPL (http://malsup.github.com/gpl-license-v2.txt) licenses.


=================================
This theme is bundled with ImagesLoaded
=================================
 * imagesLoaded PACKAGED v3.1.2
 * current incarnation was developed by Tomas Sardyha @Darsain and David DeSandro @desandro.
 * imagesLoaded is released under the MIT License

=================================
This theme is bundled with Raleway Font
=================================
* Raleway Font, Copyright (c) 2010 - 2012, Matt McInerney
* This Font Software is licensed under the SIL Open Font License, Version 1.1.
* This license can also be found at this permalink: http://www.fontsquirrel.com/license/Raleway
 
=================================
This theme is bundled with Fontawesome Icons
=================================
* Source: http://fortawesome.github.io/Font-Awesome/
* created by Dave Gandy
* Font Awesome is fully open source and is GPL friendly

================================================
This theme is bundled with TGM-Plugin-Activation
================================================
 * TGM-Plugin-Activation v2.4.0 (https://github.com/thomasgriffin/TGM-Plugin-Activation)
 * Plugin installation and activation for WordPress themes.
 * Copyright (c) 2012, Thomas Griffin (thomas@thomasgriffinmedia.com)
 * http://opensource.org/licenses/gpl-2.0.php GPL v2 or later

============================
Images Copyright/License Info
============================
* All the graphics bundled with this theme are created by the theme author and licensed under the GNU GPL.

The photos used in the screenshot.png was downloaded from pixabay.com and is bound to Creative Commons Deed CC0 as stated in their Terms of Service and Privacy Policy (http://pixabay.com/en/service/terms/)
-> http://pixabay.com/en/trekking-hiking-group-alpine-line-299000/
-> http://pixabay.com/en/mercedes-one-thousand-miles-auto-406290/
License URI: http://creativecommons.org/publicdomain/zero/1.0/deed.en

=================================
CHANGELOG
=================================
Version 2.9
* removed the rtl-language-support tag
* escaped your get_theme_mod values on output
* translated "Read more" in BIGPIX_author_excerpt()
* translated previous and next post
* updated footer.php file
* translated labels on acf options
* removed BIGPIX_mgzc_media_gallery_zero_columns_script()

Version 2.8
* removed the jquery-effects-core and jquery-effects-slide

Version 2.7
* removed admin.php and login.css file
* Prefixed all options, custom functions, custom global variables and custom constants with the theme-slug. 
* used the array handle/dependency to enqueue bundleded scripts
* updated the screenshot size

Version 2.6
* removed jquery files, functions that are not being use
* included un-minified versions of all the minified versions used
* Used esc_url for home_url
* Used after_setup_theme hook for registering new image sizes.
* removed wp_print_styles and used wp_enqueue_style
* removed BIGPIX_paginate function
* All untrusted data escaped before output
* updated bigpix.php file
* fixed css bugs
* removed is_plugin_active function and changed it to class_exists
* Used get_stylesheet_uri() to load the main stylesheet,

Version 2.5
* updated video repsonsive in video format single layout

Version 2.4
* fixed word break in IE

Version 2.3
* fixed the email address mailto link in social media icons function

Version 2.2
* fixed css issues on safari

Version 2.1
* removed all sass files and removed unminified version of font awesome

Version 2.0
* child theme is now supported

Version 1.0.9
* fixed minor css bugs
* updated layout for comments allowed html tags
* updated some html structure
* created social icons callback function

Version 1.0.8
* Remove css that are added directly to the header.php
* Provided unminified version of Modernizr

Version 1.0.7
* used get_template_directory instead of dirname( FILE )
* removed all mention of Google Analytics
* removed loading of fonts in style.css and enqued it in function.php
* updated function.php and simplyread.php file

Version 1.0.6
* all image sizes are now prefixed with theme slug
* updated functions.php
* removed the codes that is removing default dashboard widgets
* removed the codes that is removing core features
* changed the file names of translation files, from default to BIGPIX
* added the text domain to style.css header
* updated .po file

Version 1.0.5
* updated bigpix.php file
* updated function.php file
* updated readme.txt file
* removed post type templates
* tags is now displayed associated with the current post
* edited the screenshot dimension

Version 1.0.4
* fixed some issues in bigpix.php
* edited the title tag in the header
* updated header.php
* edited the unprefix functions and added the prefix with theme slug
* added required wordpress classes in the stylesheet
* removed variables that are never used
* removed screen_icon function
* added the editor-style.css

Version 1.0.3
* Remove theme suport custom header and custom background
* updated the comments layout
* Fixed Undefined Function/ variable errors 
* removed rtl-language-support from the tag

Version 1.0.2
* Updated the readme.txt
* removed all scripts in the header.php
* updated the header.php and bigpx.php

Version 1.0.1
 * new post format layout design and functionality

Version 1.0
 * First public release
