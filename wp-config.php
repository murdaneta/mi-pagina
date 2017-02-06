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
define('DB_NAME', 'page-moises');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '123');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
/** ftp directo */
define( 'FS_METHOD', 'direct' );

define( 'WP_MAX_MEMORY_LIMIT', '2256M' );

define('WP_MEMORY_LIMIT', '32M');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'll$ y7i,SxTVX>;=L?2>*SkZ7VVj7^APvD1r9g>yu{akd3C3z0aqZhvvjx*2VHWN');
define('SECURE_AUTH_KEY',  'bPzg8dO5^pFmMWF+Q^dzW6gSo}a%>Dd3%9DDW>8s:RyT5)wWmnFv?6|O<TE<7Pr,');
define('LOGGED_IN_KEY',    'PwwlzWdc,/m)b?3ekKB{y0/y|J?/M9U?[:s&&t?uD@E1owiqg)T0BaWA[.E:{f83');
define('NONCE_KEY',        'CZY-?ncGg4))P)+6y3OCtro`>g].6>t(01{oEIpD>b( `Ou(~1:0{: @I{Z.?@@7');
define('AUTH_SALT',        'Hy2A,ApDskE4)a4[LxY@Q(5A`a1|@i2$;t]bq~xF)eSU3@qxcj_4U.p_g)FWnOlq');
define('SECURE_AUTH_SALT', '`a$k;B?x7a.$iQ|YsQEUwYqqjVgNsqmGeD3>B3aYx|Xe;<`KGJ;Nj*)OiMG$}C6a');
define('LOGGED_IN_SALT',   '<Bf98S]iMlQ;}VaMNBy=/5a:(62eG4gPV/M7:&3b|]+)!z&&Xd6B]PcQ,:@#|Lh}');
define('NONCE_SALT',       '@Oa%$HQV@_-93Sr2-5}o0<6Eg^G6G.4XZ??^&$a+@fPWPCrEKQx}[e7HKhm7-a0 ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

