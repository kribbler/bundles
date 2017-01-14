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
define('DB_NAME', 'wp_global_survey');

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
define('AUTH_KEY',         'l5@gdUW%@d8vP|PTcI.zh|9]!z^BlLV@&Irr&AM5w0{l4!O)>A+/c[[y}Zv4U$.s');
define('SECURE_AUTH_KEY',  '|VemNwJgBqWbUJ!-JR$T@|/xQ+(mX,&TP,L(x]4w39-%Hba>J8Vo5!;MPl7MZVL1');
define('LOGGED_IN_KEY',    'oxT-Z7T;ndwv@X6}h7QlsSmI?8Z--~ex*I3<Oaqf.-;jN||55j~MyU#I[A8S/$35');
define('NONCE_KEY',        '7SEf^*uU]8*4y!Q$$Cc|S@XiLP]s1Ac?9-gQD,J=q=2KLI6B:ZqsGlYN-UO&g9*z');
define('AUTH_SALT',        '9BBkp-H*ctm`1BXmY2+~%48(ld(heS3Z`I+veS=eCwG8:H}|T!#_N*5R}~Q[;j+0');
define('SECURE_AUTH_SALT', '-.{XZ01||ia-.%szZ#p/4nU9~?n|Tf(@KMLAf.9_*K)kB@0.~qbPnk|Vy1pZR4*J');
define('LOGGED_IN_SALT',   '-y1PG=kt<^E$:JoA!+luybm8bvgUOHd)y,H+zD-P?vL*U.3PJf7vN|kIRFFn~fgc');
define('NONCE_SALT',       'j|G;s@rav+tL=oxssHM3F(DCi8oyXWLc&-g^Ck3p-@EqGj5YZNi 9^2j[}P&S* K');

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
