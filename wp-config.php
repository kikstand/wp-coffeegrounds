<?php
/** Detect if SSL is used. This is required since we are
 * terminating SSL either on CloudFront or on ELB */
if (($_SERVER['HTTP_CLOUDFRONT_FORWARDED_PROTO'] == 'https') OR ($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) {
    $_SERVER['HTTPS'] = 'on';
}

/**    Local Dev **/
if (file_exists(dirname(__FILE__) . '/local-config.php')) {
    define('WP_LOCAL_DEV', true);
    include(dirname(__FILE__) . '/local-config.php');
} else {
    define('WP_LOCAL_DEV', false);
}

/** Cache  */
define('WP_REDIS_HOST', '');

/** The name of the database for WordPress */
define('DB_NAME', $_SERVER["RDS_DB_NAME"]);

/** MySQL database username */
define('DB_USER', $_SERVER["RDS_USERNAME"]);

/** MySQL database password */
define('DB_PASSWORD', $_SERVER["RDS_PASSWORD"]);

/** MySQL hostname */
define('DB_HOST', $_SERVER["RDS_HOSTNAME"]);

if (!defined('DB_HOST') || strpos(DB_HOST, '%%') !== false) {
    header('X-WP-Error: dbconf', true, 500);
    echo '<h1>RDS Not Configured Correctly</h1>';
    die(1);
}
//
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
define('AUTH_KEY', $_SERVER["AUTH_KEY"]);
define('SECURE_AUTH_KEY', $_SERVER["SECURE_AUTH_KEY"]);
define('LOGGED_IN_KEY', $_SERVER["LOGGED_IN_KEY"]);
define('NONCE_KEY', $_SERVER["NONCE_KEY"]);
define('AUTH_SALT', $_SERVER["AUTH_SALT"]);
define('SECURE_AUTH_SALT', $_SERVER["SECURE_AUTH_SALT"]);
define('LOGGED_IN_SALT', $_SERVER["LOGGED_IN_SALT"]);
define('NONCE_SALT', $_SERVER["NONCE_SALT"]);

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'kn_';

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
if (!defined('ABSPATH'))
    define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
