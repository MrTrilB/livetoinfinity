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
define('REVISR_GIT_PATH', 'C:\Program Files\Git\\'); // Added by Revisr
// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

define( 'DB_NAME', 'dev1' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'password' );

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
define( 'AUTH_KEY',         'CCX m(/V~g`R/o~@s$`rP+gcHy#)|ilo{S]d9TKGM6nZHn#c28Avah0wa,L<%3BT' );
define( 'SECURE_AUTH_KEY',  'o}5*76fc@&DqL$)>]6QV_.938M3#PUSV;K<Y=}j:ONP-EM,y*ne)Q;j(lDYW{p5c' );
define( 'LOGGED_IN_KEY',    'tE86=-%*){@X5uehN`iWmzb/.R#%qw8enhXu99DDFceK_,o%+<jH&BU?A]VAQJ:-' );
define( 'NONCE_KEY',        'pJx >F5)fXbHxO^)RaEerA}NDB>[}p{Jn<&4dS=BM$o!$)nCRCC(/@0l?Dh/h1/J' );
define( 'AUTH_SALT',        'xZD2A]6rlHN{]jq&*0/MyMr.piD75Wb0E=6TI2[# M~S?pX` NxdisR4Mp:[8m/W' );
define( 'SECURE_AUTH_SALT', '<n;5^tNfieV#KN9aRr?HP$J#cEXJ[&C|?2QYD |NZIN]+#*EyB#47%M>?J|XCYU0' );
define( 'LOGGED_IN_SALT',   'n#?DCXdg#ZjeT?sk39g&0`yGS8d%Bc~liu0z}yk6{zL!?N[M`3-w~zSY!LouNr+6' );
define( 'NONCE_SALT',       ' UPkfbuytP!/iyS@M5SBk(a5F2A@`DKa,5z)!|8a4PY>z?qlk5H>ZCwKCnach-@3' );

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
