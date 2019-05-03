<?php
define('WP_CACHE', true);
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
define('DB_NAME', 'noahblit_noahbli');

/** MySQL database username */
define('DB_USER', 'noahblit_noahbli');

/** MySQL database password */
define('DB_PASSWORD', 'SbUOzAT0unLMFM8');

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
define('AUTH_KEY',         '+Gyz./kuKVGdc1MZ(cgv=v@F9EgDRmibN$TQbK@$k@- Pb&#pZIQ&kMg=+#t4l_c');
define('SECURE_AUTH_KEY',  '7U!+>[Q(4}rJ{@;oZ9&_~&/_h$0,3yger=uEgQBIk;?C{^G;:B?F_mm83M.-NvOC');
define('LOGGED_IN_KEY',    'SW0JJ[a!Uy|UXMh+?>i(.6z:Z6H5|u^b?c+u)s9HC+4*R^`=nw*5d-rTaRAO@eel');
define('NONCE_KEY',        'Za;O8hOGHL.ZyM2p2H~@8g9yS&&IC#.e`dke(2we+2?qB=%qP8vQ[bPLVVq [Om1');
define('AUTH_SALT',        ' Ecm|?S*|sPvlqI&Xp2GYUxP15SxZGoPMk:; qZJ$-Rm{(j,15Z]phZ:X>sjMqc ');
define('SECURE_AUTH_SALT', 'IF-H>[|3DC%#XL,zEDTjT$.H9v_e?g)&Pr@f$ *}>p_-zmaFe1q.0$OSC~DsjeyJ');
define('LOGGED_IN_SALT',   'NfDCL_M^N)Q+>C7F2(163J-#7mFI nMA ud5IOVGzk1e&:)3!J[NU&8<#l+&c6[o');
define('NONCE_SALT',       'hM|YIG7XHI2O%W;TQv57kw(OJuyA7[wLC F<]ck-!Xw~r/M*T+`J87&PZ+Ifr{m3');

define( 'WP_AUTO_UPDATE_CORE', true );

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
