<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wp_mrssmithmaternity');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'Z7ww75lnqALZJxukzcIuKLo085tnmZHDqK0jlOE2BSYcd7mBVFOioL18wSgndE62');
define('SECURE_AUTH_KEY',  'EOjanIQGba05b8BnDvAGztYGmp0EqRf2tS08uJ3pKYF1RastqznnOR3fnhf9MJ1y');
define('LOGGED_IN_KEY',    'Kj9a8HWCYeIJ5ueFuFzZlFAgTlMBUMFlPkot2WxwkHT6LiBabe9aFRu1xwzqSTyN');
define('NONCE_KEY',        'vZ61e26B2JYWoc7I5snuVAUzythqBUbczp3ohJEjgQbZ4v1jk4wnbtmPKzCBBt1T');
define('AUTH_SALT',        'ZFeJtBhEblmATNJk2oqyumg9deF7OYDzXKgdqqjPBsYrY1NEDO4ivBsxko9zt2TE');
define('SECURE_AUTH_SALT', 'b42RSU8fFov6mF661MwEqv2DRYpEwsyCyUGtpCXMMfC78Z9nI6M7DLMrTw7Zwhe0');
define('LOGGED_IN_SALT',   'nWRAy3bOx2pl9uUsskhGP3VVdHhxUBrhPYR6LRitcOoBigEMeSwI5snxfAntvUoI');
define('NONCE_SALT',       'Yy2Ifxtbf6pANGXzGK9vkaGJeQeUgWTWRnAf5BhHhVA1nim4SE6XgOCyDCDzkWSn');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
