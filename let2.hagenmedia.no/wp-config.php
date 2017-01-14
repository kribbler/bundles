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
define('DB_NAME', 'wp_let2.hagenmedia.no');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '-*|++yp1NuIsqWm$%O HSI0grO4h-jis.L:Hvm]-d5Ph;$+*G5eXvvJK0r{G-^6]');
define('SECURE_AUTH_KEY',  'l{<bI]02.(%2?>L7ysDniwwj??ca_elid }|GM3AdxMe9D(1gnBD_-|@l9Y+7 1d');
define('LOGGED_IN_KEY',    'nz|j3>XT2y!LI-1}!F$Ndl>W-h5;z.+QgK%)jre*gJrM$`^o~A7?<<]YwB2)3,^8');
define('NONCE_KEY',        'R,S;QQGF {F#hqemP/&vB1fE6mVahPV].$DXBRm20t03,k*3!B|bk8fW5gH9 F+V');
define('AUTH_SALT',        '<-q RT(+$v8-gr;;pW_(-i;23>lX/>2=}m#e-|%u-P/Gp@F>bfNn-/wtio+?<^61');
define('SECURE_AUTH_SALT', 'W$tncLz-xmE(2t=Y;wY7uBr@wD3(U5Aq`h!G0{)C24cDWxsH6L<WRHH>2}^Kxyr7');
define('LOGGED_IN_SALT',   'bPNm:TE7JAzQi7WgcGaKK@!,Z#tj>|{_oR-S<efhNH#-+QS_&Bc*}|oMU|LI(d?c');
define('NONCE_SALT',       'zu=qShuA*4vMn%R4k.Lyc@n-3?LK*-/=meBElNZMu0[Qo5U`$SC(=J75Fi*+--SG');

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
