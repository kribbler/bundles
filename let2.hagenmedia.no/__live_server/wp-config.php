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
define('AUTH_KEY',         '@Q]qUO4TvXunDGMcI7w2CwhQu3>i^kIl,nT=T-Hy;fqjbo/^F;{>Fx7k*i7X5X;2');
define('SECURE_AUTH_KEY',  'R}%z=CY5WULj555uJmUVfw-h3g8&nIi7kl[[m%ZRh`[R@pkCx73[EiN^P0|[!o:8');
define('LOGGED_IN_KEY',    'Ts{3N&0o9.J;#|HCsj@.?P%hKF@>/TE8624O@k<OwmWOs_`4@[1QH,_iMV2jy((|');
define('NONCE_KEY',        '9F6l#KW]^d;{@+W^!<(~2Xcbr9|+4^8E$&V3C&]JtFW:^]m>9FRekn1EQ@j.4&%y');
define('AUTH_SALT',        'Ay ; Z?:1X.o(;p}ExfmXku3wZa.SJ0fKjN8^V4X^z/PZK1)JukWjW:;bHF?u-t@');
define('SECURE_AUTH_SALT', ']9eI[x-tuzb^RkO~|DA`t|YO!$OMiMl%w|/8sJF --Z2:Ppm6+yH9K^SQOki1&<%');
define('LOGGED_IN_SALT',   'a_{}-@PwR6cIpIhFj0@,Gb0/el[O~gyVtD#vz;rxRb$80FJvn~*#=8|LV_CM%Yp1');
define('NONCE_SALT',       'm(N*vL+o~R#A1D]9AF>)7k@80L9{z>?x)T5`HbZlPdaB>r;|wv,r!:?HU_(&H1c,');

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
//if ($_SERVER['REMOTE_ADDR'] == '83.103.200.163')
 //define('WPLANG', 'en_US');
//else 
define('WPLANG', 'nb_NO');

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

define( 'FTP_USER', 'daniel' );
define( 'FTP_PASS', 'Le!nad14' );
define( 'FTP_HOST', 'bil.hagenmedia.no' );
define('FTP_SSL', false);

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
