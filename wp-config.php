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
define('DB_NAME', 'seed');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'motorola!@#');

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
define('AUTH_KEY',         'lX3EFYCCb+oW@$R xK?N%JN-c3KcBoS%T;^rlH?D5f4yZaiPcJW~@MlG&^e{80W^');
define('SECURE_AUTH_KEY',  '==>=J1|6>)}xm)[}e4VYi0u*,c1Jprpv1 vL!0iDMB0s{4I)h?{|&oR)m`z5yh%z');
define('LOGGED_IN_KEY',    'wyad2H3:[J|Y{2GH`|FS7]<QYfj#qX]~D{_cv`gQFmS#9r#P+rCujE2=|S5^)C-<');
define('NONCE_KEY',        ';/3lx kYl;p0b2HU6IuDHA/Ot%dveeg%[t/9?tgY_}n(+VO. +:_0JzwH7|-6K#;');
define('AUTH_SALT',        'dv=.L%is!|--Lf8i)8z?=?`1avran,Z*??]86gi%|mn?$Xm-V_VrD&+@X{9MJ(4+');
define('SECURE_AUTH_SALT', 'cNxp:#sMC|R7!OFcxf*CNgnmVE}s+$w42sV~c<r(|AG+?u+P7O=^roN>ChdP#bGg');
define('LOGGED_IN_SALT',   'BE]er2_A1ORM`LJyJ}aK.zjg8/&$s&bthpjtjJwoI7ec, &?1oC` (`<q %Xi7Wf');
define('NONCE_SALT',       '}:S-p4!N+lAhFu`DgMiFA|M*CMqR-nVsp+=/R-C?m+g|X m:b`H]|$MbX-hkWoNH');

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
