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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'contact' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'n<||k.{0IwA$0{5am~.e}Y3wYH;y[3$K5AsG>fb*J/%UUd9#wA(F{,cj:6Gj<T8J' );
define( 'SECURE_AUTH_KEY',  '{^giWQ!rgJ4!zA,qvRMj:<QP[_e_vw0$}@y4i/;@GJH|>:+o&rm$0kgX {ZwDXWF' );
define( 'LOGGED_IN_KEY',    '/,Y8N?+jr-8{0>(8+6%b,rP{)mXW!9q=K2[YB86V6x<=SD]ScYRy7sQfg6_LADN,' );
define( 'NONCE_KEY',        '+o7Z^SKR2<v-4]HyM/kI!Pe0M?rw#Ukua6kNq,##RABmG8*s>M^X;3 {4O/Jh<g0' );
define( 'AUTH_SALT',        'U*$c-jlj8@$%jIM:m)sW=(KQN6],Ebd,5=}>`6=FjDGk]hl;nO?t[iF+U| PO`{#' );
define( 'SECURE_AUTH_SALT', 'CC>^`H9b)yUrzO`.-pd@QO!red%X*YHE_oz;&4VOVXPY^jY_FL8<c[I$se|.t~I&' );
define( 'LOGGED_IN_SALT',   'WE-lWMs~q7s45fThT#+l3^OyF:IJk*!n_Gb2so2dPVUj4d1p-sZzmXXkghiEbJs8' );
define( 'NONCE_SALT',       'kArn%y/O1v8`p[GKEO3Y>U)Y@Do6K*6y:~}Jcx@DSk;-p{s&E5xDh0,6~^?wpBfT' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
