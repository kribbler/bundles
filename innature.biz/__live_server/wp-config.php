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
define('DB_NAME', '');

/** MySQL database username */
define('DB_USER', '');

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
define('AUTH_KEY',         '>quw8bWyL;g*%{?3:&h>v}^gko)B06,#yt?g8$Z:rTyux=vCo>xo-<<AV3NL$M&P');
define('SECURE_AUTH_KEY',  ']g#RkLDu[} [1*5lKF2e .S)F@ qJv:gOh63+S[xYn-lyJ+lv(bSy6VVDZf [T-%');
define('LOGGED_IN_KEY',    'YJ:]x?)O7t9v{T|G?q||oX YAoE~]+lp<^5nz0vy=2^?Pg~bhjAl``:CEF6A<=oN');
define('NONCE_KEY',        'A#}l2V6+%:x-F_O9_bz$^|{!q 3zOIkAk~JF|Y,t;{P1M=`RZ.6+r /D-P.)N1I@');
define('AUTH_SALT',        'us7nxAY&Sdw!!*8.:<QnxwO1xn|+br9w%8g/tH%kP3 M5$pbP0v~,!B~Gr]Xyn/Y');
define('SECURE_AUTH_SALT', 'KUoe(.gdf[ZOTdIu!!d1kM1.ZMoQ2kFR=,zS`8KNN5dI.K [84s:@X~U5vJEb8Qc');
define('LOGGED_IN_SALT',   '[D?}&if`&rc.n_FT(Z-e-F]&7W4gv@NesOZY9R%.tr<a@MQU(nYC|XuI33#Ghv_!');
define('NONCE_SALT',       'nziAr6_k&@1ry0@mCDU|eL(C$RwL$VgwN#Oe|u,33r)caE!N-SR7Af$p.s|34DWg');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'qjo_';

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
 
if ($_SERVER['REMOTE_ADDR'] == '83.103.200.163'){
	define('WP_DEBUG', false);
} else {
	define('WP_DEBUG', false);
}
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
