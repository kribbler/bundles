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
define('DB_NAME', 'wp_helpinghandsorillia');

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
define('AUTH_KEY',         'LDE=d&wRf-/en` <2MLH}GmMK[sK$uBI_xl9:ojc[A+nG85 |d+Ebt<(ul}o0+c9');
define('SECURE_AUTH_KEY',  '/r/:D(5+fz;Od}D*ohoq*=|MGsR4R21XP<7Cw+[+,o^y`sPgcK=F[w_@}|ic 6k;');
define('LOGGED_IN_KEY',    '4<B-L;jiZ=-c@u;I%apd<XG<1qzqVW( ,9lwn<u=9+RXw:)F*a%~fdR21-+upkiW');
define('NONCE_KEY',        ')wMJC%hBG,n>(vgB?:K9h~r`#:T^0c|9m!+%,&sw|M8Jy+3z37#t%05%|hxo7f(G');
define('AUTH_SALT',        ',5|]D-Y%e+FU`BrT9wIsil^eDz#wE>n9g>!$0D|R,wV?mMBKh er}V^z5VUBd7u ');
define('SECURE_AUTH_SALT', 'BRlg +*R{Yyam~LSGaT9*|wta!r#PCq[`R.zr1BeK3<^_<{9q>?t,IJT1Q/yh_3;');
define('LOGGED_IN_SALT',   '.]jFu_bp-(8,z`hf+qsjyR81jeD}5MFJQ!F<2K4||A:GCb}<4R?C#R+0PFSC>h,;');
define('NONCE_SALT',       'HC)uMSXeE6/w.-Q,+Ag`!4XMD{)7-R6n)3 NMazn/{GdTw)2+nFc;W;1Jr S@/+U');

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

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
