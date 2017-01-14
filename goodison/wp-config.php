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
define('DB_NAME', 'wp_goodison');

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
define('AUTH_KEY',         'PbgkvudF=kZqT:9N^H&E1&p;D:5t.Ka^p;kBxXosd+ //Rdn-OeLKWXp==AvBw{8');
define('SECURE_AUTH_KEY',  'qDr8W[{d;f|~NE7N-qq,}1#T>H:RSy&pv4L:Lc>cNisy+kzZV~:n-0hM6E$O27F=');
define('LOGGED_IN_KEY',    '{a6bnKc_xp{x><,{Bdf)P|$ 5kzPP`)!FGD[PBuEQtWOp,l$x^H0+_g(|R7~Zv[F');
define('NONCE_KEY',        'DH!VYYH-/<-<]$(tKj;Ws.Q9oVKu?[]P(@ ;5,*I:Mb-$RDpW|c[4ChQkyzbBai?');
define('AUTH_SALT',        '--JCTAdGaR}aq8gic$:zZjU@QEyT%IG2]G)~g*y4NOS|1ye!kq-,V4t`f6+<yvu>');
define('SECURE_AUTH_SALT', ':uR*$)}-ITZ.gw/zCY>yMpbD-1G-Ck}GQ+tQIA3u8(L@3W)$Ay6yBCZ`^}+Zc<CJ');
define('LOGGED_IN_SALT',   'Y;(,|)R=0z%4SL8-)Yk$fX<pv0m9 __2c7tLJSZhj7t^Vp@,T(-]+{$BL!/L4yK&');
define('NONCE_SALT',       '5An{??.KG4RTo= !bqB_Sy#wZuQmTVo#=+NWW%YW#iJ3VO)UZ<c%=23-o7^+_6b{');

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
