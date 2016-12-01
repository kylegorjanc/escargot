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
define('DB_NAME', 'sr');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'QmOo&yJmHQ~<F{&(#N-V+YljGk#44q)}X ,$XiralbW:s>nCY+0<P9z>}hIBE3>5');
define('SECURE_AUTH_KEY',  ',!h37ZB:8m.&-W=x$=:TJ2sBuJ9nv0: KhCuHuixM! 7D^LT-+_lolX4R[V>`&0(');
define('LOGGED_IN_KEY',    '}Mcj?Rj ;J-9v+gC??Bl#U@V>AdjenS.-8U^ u+{9}NUWt:^R$#+s2:OO8C<.6_/');
define('NONCE_KEY',        'T{ZeXi{n>[ti1wG#3c50_D>Z{65+vL|7br3Cv4`O~xlMlMJEb~{*GUn^%fAwE O|');
define('AUTH_SALT',        '487$} `f;ciNxXWv+md%Js!o(mX:oIA]6d3<W&_*x4%@iuj K`Y-GyJEHh>!dCU`');
define('SECURE_AUTH_SALT', '8R)9)PFg)YDR4cZ1D/tqViP^dYcff#lwXL3E:osJ0qY2AlJ2/++FGwXBq^igYzMw');
define('LOGGED_IN_SALT',   'BYMut&r$?m3_$OB EZgi}i%d*9,e_lFyg~bS)y^TxBBGRdC/Q%R&I_?6l8Ph0|0j');
define('NONCE_SALT',       '.kgAa8PP#5gLqUG)1thr[ZMaHzXS@9-87L|Tl98dv]1OUc@GsG 5Njf?4<uqk~v^');

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
