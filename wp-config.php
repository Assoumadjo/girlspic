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
define('DB_NAME', 'pic_girls');

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
define('AUTH_KEY',         'zAQ:Ef^M ~Lgff)/F]lfxL`eKt+$?Ajx-N4=bTpZ5p&k9 ]_%&mPk.(K].{##n|_');
define('SECURE_AUTH_KEY',  'GqAWM_;HgJPa-e=Tdwg-A}&)KI|P~`l!{=m G1K~=*WI{b9;1:V-{UrDFC-uXLm>');
define('LOGGED_IN_KEY',    'ebgzc9?-$C=+u/G>c3V)g`do?68UJ~|}l_;owyN+jw(:}Z[WXFb25<koYt)|l,&Q');
define('NONCE_KEY',        '=yWwX:V*j?YIh]PmI0~*zs{Mq2B$rW`W^JFl8>+jI(GW{:rE3p<Z-[H;+~Q4d@s6');
define('AUTH_SALT',        '-mnv{f!g|1x~.>Qm!DBX7j)q_emp>DQnMdgl4?6F5xA8|9X_cd)a:|V@j !^6>q6');
define('SECURE_AUTH_SALT', 'h+-~#oR5oG?|.#7CFe]k4IJuxL2hy$MGC7gm&fkL)jcS=-Yl^`##GYlYlv9@Myu#');
define('LOGGED_IN_SALT',   'c<k`mhCIqQxeLr?Y/2|Q{e<jNvEi+y(;GJG~$Y9]HC-59=lX*j~bos8hDIL!1uN(');
define('NONCE_SALT',       'S7}^/ay!EwZhIx#3G}Diw~#PNfEI}[o:Nk(,z]I@Pl+LC u-(*Q4C(*RW-iBpjKo');

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
