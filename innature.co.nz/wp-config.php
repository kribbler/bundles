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
define('DB_NAME', 'wp_innature');

/** MySQL database username */
define('DB_USER', 'root');

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
define('AUTH_KEY',         '.#(^IY]3]xb7`<d_?RP?StAUy,x53RZHePWB I# nD!$5|1t1fi4EGYtq/;?,jHx');
define('SECURE_AUTH_KEY',  'bMnj*y#13+5rR_i9oCy[TTK|mt`E?JAXW:T[myL.*prRbJvcBqiQ6N)|zfaKA9L4');
define('LOGGED_IN_KEY',    'Ch:U9j|n~ya5#*?)|=9TZP^c=T>z}E7a!9m7LBMpJi<nDhHF;GL[^??-lQN-*(iN');
define('NONCE_KEY',        'wDO7Ba3 d!67M=.34+~7U86J%y0eFnM2``YA_B4|fbH%9)t)l2xUZ;Qf.4=_u|uu');
define('AUTH_SALT',        's83lp=4nJO)h=0nm[X8$1){vf<3Hbmqpr&f%}VeA-lJGa7_|vfO= $IR5G-UBNw6');
define('SECURE_AUTH_SALT', '1O2p0p$nCo5,z(QQpV^!-Rr7+|DxJ0&bh{dFt*Q4@$%kdPW?OlGS&(^%~ZJH.8.a');
define('LOGGED_IN_SALT',   'RXbfC1g3q%1h9GiOH4sE>d95SS(?)i9j+1|z5e}7i._}~I,sC:-|r*7;1 :&B4lv');
define('NONCE_SALT',       'x<upF]CE*A-]V*Z2(G]bAZN4-<a^P`DuIk#u2)ZC=I}kx-cBA*r)/? $1$Y)+w|2');

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
