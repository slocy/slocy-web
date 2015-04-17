=== Nginx Helper ===
Contributors: rtcamp, rahul286, saurabhshukla, manishsongirkar36, faishal, desaiuditd, Darren Slatten, jk3us, daankortenbach, telofy, pjv, llonchj, jinnko,weskoop
Tags: nginx, cache, purge, nginx map, nginx cache, maps, fastcgi, proxy, rewrite, permalinks
Requires at least: 3.0
Tested up to: 4.0
Stable tag: 1.8.7
License: GPLv2 or later (of-course)
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Donate Link: http://rtcamp.com/donate/

Cleans nginx's fastcgi/proxy cache whenever a post is edited/published. Also does few more things.

== Description ==

1. Removes `index.php` from permalinks when using WordPress with nginx.
1. Adds support for nginx fastcgi_cache_purge & proxy_cache_purge directive from [module](https://github.com/FRiCKLE/ngx_cache_purge "ngx_cache_purge module"). Provides settings so you can customize purging rules.
1. Adds support for nginx `map{..}` on a WordPress-multisite network installation. Using it Nginx can serve PHP file uploads even if PHP/MySQL crashes. Please check tutorials list below for related Nginx config.

= Tutorials =

You will need to follow one ore more tutorials below to get desired functionality:

* [Nginx Map + WordPress-Multisite + Static Files Handling](http://rtcamp.com/tutorials/nginx-maps-wordpress-multisite-static-files-handling/)
* [Nginx + WordPress + fastcgi_purge_cache](http://rtcamp.com/tutorials/wordpress-nginx-fastcgi-cache-purge-conditional/)
* [Nginx + WordPress-Multisite (Subdirectories) + fastcgi_purge_cache](http://rtcamp.com/tutorials/wordpress-multisite-subdirectories-nginx-fastcgi-cache-purge/)
* [Nginx + WordPress-Multisite (Subdomains/domain-mapping) + fastcgi_purge_cache](http://rtcamp.com/tutorials/wordpress-multisite-subdomains-domain-mapping-nginx-fastcgi-cache-purge/)
* [Other WordPress-Nginx Tutorials](http://rtcamp.com/wordpress-nginx/tutorials/)


== Installation ==

Automatic Installation

1. Log in to your WordPress admin panel, navigate to the Plugins menu and click Add New.
1. In the search field type “Nginx Helper” and click Search Plugins. From the search results, pick Nginx Helper and click Install Now. Wordpress will ask you to confirm to complete the installation.

Manual Installation

1. Extract the zip file.
1. Upload them to `/wp-content/plugins/` directory on your WordPress installation.
1. Then activate the Plugin from Plugins page.

For proper configuration, check **tutorial list** of [Description tab](http://wordpress.org/extend/plugins/nginx-helper/)

== Frequently Asked Questions ==

**Important** - Please refer to [http://rtcamp.com/nginx-helper/faq](http://rtcamp.com/nginx-helper/faq) for uptodate FAQ's.

= FAQ - Installation/Comptability =

**Q. Will this work out of the box?**

No. You need to make some changes at the Nginx end. Please check [tutorial list](http://rtcamp.com/wordpress-nginx/tutorials)

= FAQ - Nginx Fastcgi Cache Purge =

**Q. There's a 'purge all' button? Does it purge the whole site?**

Yes, it does. It physically empties the cache directory. It is set by default to `/var/run/nginx-cache/`.

If your cache directory is different, you can override this in your wp-config.php by adding
`define('RT_WP_NGINX_HELPER_CACHE_PATH','/var/run/nginx-cache/');`

Replace the path with your own.

**Q. Does it work for custom posts and taxonomies?**

Yes. It handles all post-types same way.

**Q. How do I know my Nginx config is correct for fastcgi purging?**

Manually purging any page from the cache, by following instructions in the previous answer.

Version 1.3.4 onwards, Nginx Helper adds a comment at the end of the html source ('view source' in your favourite browser):
&lt;!--Cached using Nginx-Helper on 2012-10-08 07:01:45. It took 42 queries executed in 0.280 seconds.--&gt;
This shows the time when the page was last cached. This date/time will be reset whenever this page is purged and refreshed in the cache.

Just check this comment before and after a manual purge.
As long as you don't purge the page (or make changes that purge it from the cache), the timestamp will remain as it is, even if you keep refreshing the page. This means the page was served from the cache and it's working!

The rest shows you the database queries and time saved on loading this page. (This would have been the additional resource load, if you weren't using fast-cgi-cache.)


**Q. I need to flush a cached page immediately! How do I do that?**

Nginx helper plugin handles usual scenarios, when a page in the cache will need purging. For example, when a post is edited or a comment is approved on a post.

To purge a page immediately, follow these instructions:
(eg. http://yoursite.com/about/)
Between the domain name and the rest of the url, insert '/purge/'.
So, in the above eg, the purge url will be http://yoursite.com/purge/about/
Just open this in a browser and the page will be purged instantly.
Needless to say, this won't work, if you have a page or taxonomy called 'purge'.


= FAQ - Nginx Map =

**Q. My multisite already uses `WPMU_ACCEL_REDIRECT`. Do I still need Nginx Map?**

Definitely. `WPMU_ACCEL_REDIRECT` reduces the load on PHP, but it still ask WordPress i.e. PHP/MySQL to do some work for static files e.g. images in your post. Nginx map lets nginx handle files on its own bypassing wordpress which gives you much better performance without using a CDN.

**Q. I am using X plugin. Will it work on Nginx?**

Most likely yes. A wordpress plugin, if not using explicitly any Apache-only mod, should work on Nginx. Some plugin may need some extra work.


= Still need help! =

Please post your problem in [our free support forum](http://community.rtcamp.com/c/wordpress-nginx).

== Screenshots ==
1. Nginx plugin settings
2. Remaining settings

== Changelog ==

= 1.8.7 =
* Added action `rt_nginx_helper_purge_all` to purge cache from other plugins - by [gungeekatx](https://profiles.wordpress.org/gungeekatx/)

= 1.8.6 =
* Removed wercker.yml from plugin zip/svn.
* Updated readme

= 1.8.5 =
* Added WP_CLI support - by [Udit Desai](https://profiles.wordpress.org/desaiuditd/)

= 1.8.4 =
* Fix undefined index issue and correct "purge_archive_on_del" key

= 1.8.3 =
* Tested with WordPress 4.0
* Fix issue #69

= 1.8.1 =
* Tested with wordpress 3.9.1
* Fix confilct with Mailchimp's Social plugin

= 1.8 =
* New admin UI
* Fix missing wp_sanitize_redirect function call

= 1.7.6 =
* Update Backend UI
* Added Language Support

= 1.7.5 =
* Fixed option name mismatch issue to purge homepage on delete.

= 1.7.4 =
* Disable purge and stamp by default.

= 1.7.3 =
* Suppressed `unlink` related error-messages which can be safely ignored.
* Fixed a bug in purge-all option.

= 1.7.2 =
* [pjv](http://profiles.wordpress.org/pjv/) fixed bug in logging file.

= 1.7.1 =
* Fixes bug in true purge and admin screen.

= 1.7 =
* True full cache purge added.
* Map file location changed to uploads' directory to fix http://rtcamp.com/support/topic/plugin-update-removes-map-file/
* Log file location also changed to uploads' directory.

= 1.6.13 =
* [pjv](http://profiles.wordpress.org/pjv/) changed the way home url is accessed. Instead of site option, the plugin now uses home_url() function.

= 1.6.12 =
* [telofy](http://wordpress.org/support/profile/telofy) added purging of atom and RDF feeds.

= 1.6.11 =
* Removed comments from Admin screens since, it was interfering with media uploads in 3.5 up.

= 1.6.10 =
* Cleaned up code.
* Added credits for code.
* Improved attachment purging.

= 1.6.9 =
* Added Faux to Purge all buttons, to avoid misleading users.

= 1.6.8 =
* [daankortenbach](http://profiles.wordpress.org/daankortenbach) added Purge Cache link to wp-admin bar

= 1.6.7 =
* [jk3us](http://profiles.wordpress.org/jk3us) added better content-type detection for cache verification comments

= 1.6.6 =
* [darren-slatten](http://profiles.wordpress.org/darren-slatten/) added Manual 'Purge all URLs' functionality

= 1.6.5 =
* Fixed typo that interfered with archive purge settings. Thanks to [Daan Kortenbach](http://profiles.wordpress.org/daankortenbach/) for pointing this out.

= 1.6.4 =
* Improved code for map generation to better conventions since the nesting confused some servers.
* Added map update process to admin_init for frequent refreshes.

= 1.6.3 =
* Fixed duplicate entries.

= 1.6.2 =
* Another bug fix in the revised code for improved multisite and multidomain mapping.

= 1.6.1 =
* Fixed bug in the revised code for improved multisite and multidomain mapping.

= 1.6 =
* Revised code for improved multisite and multidomain mapping.

= 1.5 =
* Timestamp now only gets added to content-type text/html
* Added option to toggle timestamp creation

= 1.4 =
* Fixed bug related to nomenclature of comment status that caused purge to fail.

= 1.3.9 =
* Removed extraneous headers.

= 1.3.8 =

* Fixed bug in single post/page/post-type purging code. Thanks to Greg for pointing this out here: http://rtcamp.com/support/topic/updating-post-nginx-helper-purge-cache-post/.

= 1.3.7 =

* Changed the action hook, back to 'shutdown' from 'wp_footer' to add verification comments.
* Added a check to prevent adding comments to ajax requests,

= 1.3.6 =

* Changed the action hook, from 'shutdown' to 'wp_footer' to add verification comments. This was interfering with other plugins.

= 1.3.5 =

* Improved Readme.
* Improved cache verification comments.

= 1.3.4 =

* Fixed duplicate entries generated for maps (Harmless, but doesn't look good!)
* Added timestamp html comments for cache verification, as described here: http://rtcamp.com/wordpress-nginx/tutorials/checklist/

= 1.3.3 =

* Fixed map generation for multi domain installs using domain mapping plugin, where blog ids were not displayed.

= 1.3.2 =

* Fixed map generation for multi domain installs with domain mapping plugin.

= 1.3.1 =

* Minor fixes for directory structure and file names.

= 1.3 =

* Improved Readme.

= 1.2 =

* Fixed map generation error.
* Fixed purging logic.
* Fixed UI where purge settings were lost on disabling and re-enabling purge.
* Minor Ui rearrangement.

= 1.1 =

* Improved readme.txt. Added Screenshots.

= 1.0 =

* First release


== Upgrade Notice ==

= 1.8.4 =
Fix undefined index issue and correct "purge_archive_on_del" key
