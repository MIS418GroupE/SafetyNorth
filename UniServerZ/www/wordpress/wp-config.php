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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'wordpress');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'ww3I{HBW^ds+z~YXHzZdCF!VWs}p }<<xzB#a+Nj)RT(OfL.2sB_s|%|j<l8*}1w');
define('SECURE_AUTH_KEY',  '9A4;N{ehjHLtf ~H[$vs+P5F ?|@KR(@z7eNZy:,`zCLgR#,LjuFmB2uYoI!6CBH');
define('LOGGED_IN_KEY',    '1|})K{4eE,,LIfvnsE*OJQ]Y%Z6 kf}`y~h5HTkx<3U 6UC+$Wc$#b&A#-{}Ziko');
define('NONCE_KEY',        'H!j.K?|_+V4tfYWD([ilLP` g(]E38{zqFhs~*F~#y}6!Noyhg[FB{,;.S}gM;{b');
define('AUTH_SALT',        'KvYwJsf;,^YH=b%EVGo#$@_~Q)$H~%,[4of0Qu3j<3Q}^jW,8k$>Tqmz`cp8C/M^');
define('SECURE_AUTH_SALT', 'uuY8rT^>u!fGy7PP{Ng?ZyDcNltm1~&7f2(`$|.NX?qY8zp6;w,v005]Dshp!#-=');
define('LOGGED_IN_SALT',   'uu{$l&&XPa.-;Hr6C_$JZ+=3XU3`of_IL?_a+F s 7JEGhs%S`$qWf{1b:$/:Nls');
define('NONCE_SALT',       '@-Sz{)D29-smqn8o#|l,=htDMT4NK`_+t<1A}=ig`u2$$YzupmT%]$19<Nx;d /w');

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
