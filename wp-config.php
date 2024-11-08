<?php



/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', "jvj445033239622");

/** Database username */
define('DB_USER', "jvj445033239622");

/** Database password */
define('DB_PASSWORD', "y6!p6O+G9E{u=");

/** Database hostname */
define('DB_HOST', "160.153.157.174:3312");

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'H=TRd-_-(ZKy)M$arL6s');
define('SECURE_AUTH_KEY',  's)LI8/D#5rN5qNwJhsVE');
define('LOGGED_IN_KEY',    '-N07rh95v9!NRKB_wNb_');
define('NONCE_KEY',        'Iqm/KO#dy@cM1O5hTKr/');
define('AUTH_SALT',        'qv4!2E2a%qP#)WjU65Pq');
define('SECURE_AUTH_SALT', 'q3%BXA7X  OBca1/fOA1');
define('LOGGED_IN_SALT',   'M#BZqFqQN1ZU0L&*C(pQ');
define('NONCE_SALT',       '1QXd+&@I +US_TCps%OW');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_qaaxqznvxk_';

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
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
//
require_once(dirname(__FILE__) . '/gd-config.php');
define('FS_METHOD', 'direct');
define('FS_CHMOD_DIR', (0705 & ~umask()));
define('FS_CHMOD_FILE', (0604 & ~umask()));


/* Add any custom values between this line and the "stop editing" line. */



define('FORCE_SSL_ADMIN', true);
/* That's all, stop editing! Happy publishing. */

define('WP_MEMORY_LIMIT', '512M');

/** Absolute path to the WordPress directory. */
if (! defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
