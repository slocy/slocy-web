<?php
/*
Plugin Name: Force SSL URL Scheme
Plugin URI: https://gist.github.com/webaware/4688802
Description: Force the protocol scheme to be HTTPS when is_ssl() doesn't work
Version: 1.0.0
Author: WebAware
Author URI: http://www.webaware.com.au/

@ref: http://wordpress.org/support/topic/ssl-insecure-needs-35-compatibility
*/

/*
copyright (c) 2013 WebAware Pty Ltd (email : rmckay@webaware.com.au)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// if site is set to run on SSL, then force-enable SSL detection!
if (stripos(get_option('siteurl'), 'https://') === 0) {
    $_SERVER['HTTPS'] = 'on';

    // add JavaScript detection of page protocol, and pray!
    add_action('wp_print_scripts', 'force_ssl_url_scheme_script');
}

function force_ssl_url_scheme_script() {
?>
<script>
if (document.location.protocol != "https:") {
    document.location = document.URL.replace(/^http:/i, "https:");
}
</script>
<?php
}