<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'quoo5Xu6aChu');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'hah1aeKei8Ahyo6aomael2uxoom7ulaereil5cie5hai5PheeMeev3baipi6ooqua');
define('SECURE_AUTH_KEY',  'hiu7eiju2thoC9aa6eeBietae0Xei1fi2yaet2quohmeelei5beegeesee3Iul9Na');
define('LOGGED_IN_KEY',    'fee3li0Lahm7OoPhoh0dailobooyeiyui7Aep7vooj8aiF1eegho0eweideil4uor');
define('NONCE_KEY',        'shohc8oph0meib7IeFeeshoo3oosuSah7wiepiaDee3dieyao4IeThiemohFoo6ei');
define('AUTH_SALT',        'aYeich9Aem1aengae0liequan5ohr7oTuoNu4ohpooToi0aib0aer6iRiepaaxoh4');
define('SECURE_AUTH_SALT', 'do7vuuthofooFah4thai5shien7rohVooZoh0eeghiw4oos2oasiesheit1ahr3Su');
define('LOGGED_IN_SALT',   'Ziebai4aeposeejaiFooKai2xo9zahb3beekiezi3ahPh6iNem8foseengieshae0');
define('NONCE_SALT',       'eChah9phuquoloo8Ia8AFaiqua0iesha5HooFieth5esue4Rief5Piulaigiath1u');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Our server is behind a load balancer or reverse proxy, so we need this snippet. */
/* if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
     $_SERVER['HTTPS']='on';*/
    /**for cloundfare */
if (isset($_SERVER['HTTP_CF_VISITOR']) && strpos($_SERVER['HTTP_CF_VISITOR'], 'https') !== false) {
    $_SERVER['HTTPS'] = 'on';
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
$plugins = get_option( 'active_plugins' );
if ( count( $plugins ) === 0 ) {
  require_once(ABSPATH .'/wp-admin/includes/plugin.php');
  $wp_rewrite->set_permalink_structure( '/%postname%/' );
  $pluginsToActivate = array( 'nginx-helper/nginx-helper.php' );
  foreach ( $pluginsToActivate as $plugin ) {
    if ( !in_array( $plugin, $plugins ) ) {
      activate_plugin( '/usr/share/nginx/www/wp-content/plugins/' . $plugin );
    }
  }
}

define("FS_METHOD","direct");


