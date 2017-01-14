<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wp_hang-music');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'j,CQ_s9h01N~07razgQ@tJ{wLYT05:U_{s7AbwI;B)1%<2d{XV]#]LO0=gq%(ezn');
define('SECURE_AUTH_KEY',  ')JWSl&zpH*djd)]9g%6W-12!|A7XI^A{CS,D5~ f%;eq_{0Z?CS1>b$!ip:xHk0:');
define('LOGGED_IN_KEY',    '<KF:qeACzT+uKK,M>cGg3^B:UqeJScpeC*xz[z#:!/o^TM6;*Mo8i=++ZnUJ~-#q');
define('NONCE_KEY',        'ZYm#lJn/*^?bRclDGaN+m#2WvRMN_,T2%B7a+w7B4A+9,?n0:VgS fA#)mp2qzQ ');
define('AUTH_SALT',        '-EG|%=-U XVfIPjc:p4~?@x@-:+5SU=6FqLvP.FU8P&=pjuB3A6=|}`+ZO,Nsb_Q');
define('SECURE_AUTH_SALT', '@DVhrKIfqZK%}YI00}oyi-mRFo-h-{xnZSY`i_0z4f-ns(f og|xAnVVR)21E<m0');
define('LOGGED_IN_SALT',   'L-U+]}ng`jA<XDv{p<2}3_c|x8ueN.hbdJ7q aLpAUTQ]m{I<9p*A~_7duL~/0o6');
define('NONCE_SALT',       'CJk)$/6@cvjrW|gN[NUfNA0-g[(dk-];>c1QlEV%b|KgL25x4|t6AHY33hHcTK p');

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
