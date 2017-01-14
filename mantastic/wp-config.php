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
define('DB_NAME', 'wp_mantastic');

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
define('AUTH_KEY',         '8tN9.eV+a9</+S/j*}1Oc=-5gZ@r,|z[f<;r0p3&|l+2%HDc|+^+eQGDh7s#8+v*');
define('SECURE_AUTH_KEY',  'Bw;-{gy3RU^DbfNRTgXRweDgTn.PoXnlvY7 7Kdk5N6 ))s|*2<,#QDz1CfVg+E{');
define('LOGGED_IN_KEY',    'x-qf.81zb`_2zQMFLQP+fO9cwP!YtZCZo=f!3W2c7xiZ=b#O~S|(|%op}+*;Le!K');
define('NONCE_KEY',        ' I_Pr=qzsMu>V0g1s8h=~*eB?]2hTk?C`>bjmN<Vj!`sz:2q6-O|Act)%WerP~])');
define('AUTH_SALT',        '{~X6&c,6,DO@&MhL>}*;J*qt*cc]4.ll)|Yr).hx|k`X>v16{)rR9|7u]U;8IopB');
define('SECURE_AUTH_SALT', ')R7HO(C*bxS-<vT*qMsg/Gn$7.DW5x~b;Q+sYgA--TFE-,^B#_4|<Fh/+#urx~~O');
define('LOGGED_IN_SALT',   '2ah9-|e|t-Q$vqeqi3GhKwTZbqHuO<d$`7j`n5ckAjaS.,+M#J8N+v:+gmwf[t]v');
define('NONCE_SALT',       'PsR><v$[Gq_GrGl=K.k$j_`U`0L`8oN,OQWsNb-`CAd6o|`B^]$}`6ahvFz#5q$6');

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
