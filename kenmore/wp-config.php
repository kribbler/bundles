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
define('DB_NAME', 'wp_kenmore');

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
define('AUTH_KEY',         '3ZVGwsK3-elRZ+odY2szl-$D/5HFhV5TdJo QwC.b%[~5tc<|cnI[A&!B,3W2&3L');
define('SECURE_AUTH_KEY',  'ZoB}p]{};{,X$hHSAun WBook}u%&}CBYN]-BQwGPByz7k4|JM[%=%r8XE{$a9LP');
define('LOGGED_IN_KEY',    'xoRt3L}+VxZ0+HrI|877Aj];F;@/C!FRP4.:|A%t.01FnlJVy^KNmLz`K8Tt=R]9');
define('NONCE_KEY',        '*5DTINvpcBD~}bp9!-EYD9-5o$`_.ApfBP^F?]r}Ff$WH|[>yEP>P!a>tT+csuO,');
define('AUTH_SALT',        'F`v;-(>E[tJ|~+`6$<v{n5,,bEX|x|LL`DPw::~xt-z%#!<*ap/b/&$L`|c>tg9(');
define('SECURE_AUTH_SALT', 'b56OC8IOz.ru9 `@56Du8sGzCz NuO{mQ8i(|iCrkhcEs{>Us3{)4;m{vn!^5-^[');
define('LOGGED_IN_SALT',   '{g}N8$p2h;X5|W-gm+&elG :RS3]Yh?hEPs[rlt4Bx1PtGM%I!9a ?|=o.:QtBgw');
define('NONCE_SALT',       'oTz8Md=Dj*@.?`YWe<0wafdsq;?47x;(Rcp32WaYC~?-+m!pS}VR?YKJpFwd}W^b');

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
