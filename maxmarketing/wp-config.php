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
define('DB_NAME', 'wp_maxmarketing');

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
define('AUTH_KEY',         ',kH]f0^;1Fh@`!IE:p+[h%:b.FHm0pRH^&/qdOW.Z,+C28=?VQ-`[j`a8;G]f#t7');
define('SECURE_AUTH_KEY',  '{9H8,F5Nu(@3h;.B2|^o_L+|Q-6{D@S3VA{7pR>qS).O`mFTo[rYfJN`eI1wO54_');
define('LOGGED_IN_KEY',    'z</f{A3;3o.JT^/SZDKIn|M/OJB!T8xOKP `g=T13raj;+:BP7;cM^7|d;QgU=i ');
define('NONCE_KEY',        'N%E.H y35ifB&9~<NZX*YKV!X*=A+xq6Bf0M}g2ZZNbI,jlB9,[=r7sUE,QI%1Rw');
define('AUTH_SALT',        'qj11(t1mtr.2/=u)Ylbc)$nwv0fU!2TqsP?`au%?-R$WG+Xo.Q5~wN%R@U/7`Jo.');
define('SECURE_AUTH_SALT', ']e}&6Z<h)H|wT-[JVg)EN#b[R3 LHU#1Vq@Ag6Bdle+A|<4wk+QDaTV/*@+84;|B');
define('LOGGED_IN_SALT',   '3pz. zn4qN@:1+ot-HrBd:^L-+]1|&cBQGA{Qm-(2M3AR%|.GK|BEFcY t4nD#oj');
define('NONCE_SALT',       'ZKFv4A?9etZ1D.i}u%8&@l-w+$M6uJSTd2S(qn_}fC62H,i5tVVcrgI{6c2ht6++');

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
