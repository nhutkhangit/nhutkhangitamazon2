<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'nhutkhangit_web' );

/** MySQL database username */
define( 'DB_USER', 'nhutkhangitweb' );

/** MySQL database password */
define( 'DB_PASSWORD', '5lDFj9u7oE3SCt7iA8VM' );

/** MySQL hostname */
define( 'DB_HOST', 'database-2.cx3zh21e5jvo.ap-southeast-1.rds.amazonaws.com' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '.v|Nr}<,3,w,`X/%uCJZVR+?k$2Y?)RC+PC+uO<Z+BRPm!ta9Iy1[@L]>}yUK4rO' );
define( 'SECURE_AUTH_KEY',  '{=pV7Msv`kVu%(A,Ys|viCs8Wn@7Mm1;T^pj %5r,ptbz`fpZH];3mcMdOJ x>eF' );
define( 'LOGGED_IN_KEY',    'BE-Cw<`E&d)PN}qG}v(M6OI3PEAP _`M#t=B3f6<|ufO3B>>P S%~2la9$Uw^js ' );
define( 'NONCE_KEY',        'yK<Oz~+LaZu|I}Ly}qDOB`W!oO</hLy?xn`]I?i4yy^*<.}%8.IC2K5}%s5DI 6=' );
define( 'AUTH_SALT',        'p2g#t<38SqB~sgJN%,M@`U]-SfQ.|%+0Z]W3bIhfI<2cn],)T`S1WBg^O ,b^E>(' );
define( 'SECURE_AUTH_SALT', '{ :K&2Hv8=ks>aMOf@0H]?1 ENCC6s@0UgP{k|LGgEV3Sj%97pX`&i,GlDcSam>l' );
define( 'LOGGED_IN_SALT',   '3H}g`?~_li[;{%Hf**q)i{(K`f% :#iVb`~mvUT?/^A/@*RdWLTU!F2niV@/pQYb' );
define( 'NONCE_SALT',       'x, n.BGDbd1Cs,&b@LaYeYG`rwn|jpBiVrl) H!qx/hQuSxrxTMaX<(6a67M1(JH' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
