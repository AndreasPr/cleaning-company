<?php
define('WP_CACHE', true); // WP-Optimize Cache
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bitnami_wordpress' );
/** MySQL database username */
define( 'DB_USER', 'bn_wordpress' );
/** MySQL database password */
define( 'DB_PASSWORD', '107ab79020' );
/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1:3307' );
/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );
/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '5b9bcf76f646dde8342e227eeee59a26fc269ccd628a0ec38a56fe29abd86a5d');
define('SECURE_AUTH_KEY',  'a8c7c1632ca600ad5ef4bce15fe0a06717aa9aa987318e6d22807b8f6c179215');
define('LOGGED_IN_KEY',    'be25c1f3ed769708c7cefd69b4dece4b37f5ae4b0e0810f85bd732a4c8b2e057');
define('NONCE_KEY',        '1e2bc7966ad21d6b8fcce45ba50c68a107bc5c7f4d033b50ab721b46ee1a3fe4');
define('AUTH_SALT',        '5bb778925a3c2160ef8e95e109d33d5d329092e9abcc1d61264e738a84d8daae');
define('SECURE_AUTH_SALT', '293407ef458fb29bee08d5228f732304effea8cc48046bad21aa1243e11f4462');
define('LOGGED_IN_SALT',   '4d536bc7cf976d3ace215a5aba695b9a159ce78d945c9437be8572df41af7dc8');
define('NONCE_SALT',       'f5f61a8e5bde0b955df6f03fd55dcc0adca1ea153c57702dc344739ba8a21e32');
/**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
/* That's all, stop editing! Happy publishing. */
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
*/
if ( defined( 'WP_CLI' ) ) {
    $_SERVER['HTTP_HOST'] = 'localhost';
}
define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress');
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress');
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
define('WP_TEMP_DIR', 'C:\Bitnami\wordpress-5.7.2-0/apps/wordpress/tmp');
//  Disable pingback.ping xmlrpc method to prevent Wordpress from participating in DDoS attacks
//  More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
if ( !defined( 'WP_CLI' ) ) {
    // remove x-pingback HTTP header
    add_filter('wp_headers', function($headers) {
        unset($headers['X-Pingback']);
        return $headers;
    });
    // disable pingbacks
    add_filter( 'xmlrpc_methods', function( $methods ) {
            unset( $methods['pingback.ping'] );
            return $methods;
    });
    add_filter( 'auto_update_translation', '__return_false' );
}