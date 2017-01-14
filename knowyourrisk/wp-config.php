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
define('DB_NAME', 'wp_knowyourrisk');

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
define('AUTH_KEY',         'hPB;_g1OjT5P](DK!R|Ge29_2P)4P;CmIZ|M*jYE5-p3|hh:;W#)8N`U=OLY.<uQ');
define('SECURE_AUTH_KEY',  ')fppn)Zv!s+yMR/iE>=n@oLO6;,2,j7^+W?9uYSXeeS0[gQD)MC/Ih,u9Lu+%(<_');
define('LOGGED_IN_KEY',    '?A-3SR6~qbSx&+iU9s33wP,8*L6k=vq!ESn$98p~eb++;v>;?q`4B,U9RkxE@-:^');
define('NONCE_KEY',        '-zX?rt)4`2y|/h+Me>@<|2}R1M%].FpYyIltS!-2o8W;-jTtVf?Ux8<Y?RhGRGnY');
define('AUTH_SALT',        '0G(6|-P_5vy,OVWuLsIW06h.aQ}(4T=J+[RtGf~15~`D0wB-BY2]l s9676_~ZM0');
define('SECURE_AUTH_SALT', '&c_SUSqVtc+u`hHC,V.edR!R,/gh$xvsC%o~-4-AnT?-p^Q6g teS]L.yf.88a,Y');
define('LOGGED_IN_SALT',   ':4OTim<@l[666f|PH=NVg/&b-j`%b=2{/w_/Il#TSOe]mZbAu:11J!|nP{Re%,-W');
define('NONCE_SALT',       '0zVBbau|l9B~su{cN-]m)|-J$9P8jazNeB%.fV?-OUj-!#&Wl?w`[ ?*kx|-0+yV');

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
