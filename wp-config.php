<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Kp=<mrh!D?973;,V*g1vz]G:*Bxa[bE,xl@hWlsVTLbtG-WJ5B+6@L8dyC^d7Xc]' );
define( 'SECURE_AUTH_KEY',  'sa0ZtwY57*[jru<DbvZwYL,/XDnOI58t%AgxEOz}L&2tQBT` .l?dKP<^5}k+-7n' );
define( 'LOGGED_IN_KEY',    ';R^l2=oC++k(]_({#s^T(y,%E&OOHZ,#Q&<zJ0d%g=X:Z1m2P1u_v`VB/3$.}5u~' );
define( 'NONCE_KEY',        'dQSD[)HI.ZCZKk~Mx36A]_6})d[({DC4ZI3Nay2)|7+/MZ/OtSQ$n~(81bf_tS^e' );
define( 'AUTH_SALT',        ',f::D:Oi-N.!:6i*6XN6:}LZN)d,?iHutyOY2Vk^+{iWp_JA-drzF(pk&#<As;d)' );
define( 'SECURE_AUTH_SALT', 'Y<Rw[2J!-/Cdk* w0;WP>Z#H5uoZ@?):&e_xcx(jwpX qXz:rRx&VWec@@5y02Y<' );
define( 'LOGGED_IN_SALT',   '&38,}3Lg{CGt%RMjv@QCb>$_vnz})pOq]i TxOA;`IZ@SZ,sIWEsm)H;Qw>v!doW' );
define( 'NONCE_SALT',       'GSd+Q9V+nhVnd-|nlV2$-C.?eZ2tB#CC80L^vf0nkH6~fI2hCLh=S:|%DBm1_-C,' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
