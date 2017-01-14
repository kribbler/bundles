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
define('DB_NAME', 'wp_freshtogo');

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
define('AUTH_KEY',         ')yyT3#m:@nSFLt3q3u5U(AKC&i(3=DfTNV4WtOJw]:*[^ti Du5Sr-5b+;>Xpp~ ');
define('SECURE_AUTH_KEY',  '8&QH4 .b~U7N_Kb0I0vV2RHb*MF8J-vF&/85A{|EUZlpSv[X3[`ImIP}%<en$`xg');
define('LOGGED_IN_KEY',    'N]!i+!,[Jt0B*d5$)+Xjiuv8}5 Ge(_2?8J;|*QU/DV`S*izWGl0W%?m |C;Be,v');
define('NONCE_KEY',        '(sDdW-DT=G=AD({uEK22v<3}ijZD?@F.g%jZ)b<.@M!~}VFl(R}=Hp!Y?F|ad[8_');
define('AUTH_SALT',        'E)h2^_>EfT[k(:rI++8uAGcg%zI^-J7Cwl4(.`}8LHUA.(B9Zf[rK&yhSPR8[4u)');
define('SECURE_AUTH_SALT', 'pfY5u+LvG Tl2V6|+]|H@ECPG}9mU[r%zO70Zxp*4Z:W-DX#|j:Oy0sWJd(``znU');
define('LOGGED_IN_SALT',   'UWbqE0(V/`G`>e&DFvnZk4%:8@@+6X3} c$`3eT%2 #!35 `3bW9G|l,T/v71z)J');
define('NONCE_SALT',       '0VqS#)zo-k&J2GOe ~UF|!7%T&V<O 0Y?HQ2>y8-$/~JTfXdltkyoWz+QPbKDqKl');
define('WP_MEMORY_LIMIT', '64M');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'o9i_';

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
