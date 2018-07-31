<?php

/** Absolutna ścieżka do katalogu WordPressa. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Enable Local Updates via WP Admin */
define( 'FS_METHOD', 'direct' );

/** Ustawienia serwera MySQL */
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

/** Prefiks  */
$table_prefix  = 'wp_';

/**#@+
 * Unikatowe klucze uwierzytelniania i sole.
 *
 * Możesz wygenerować klucze przy pomocy {@link https://api.wordpress.org/secret-key/1.1/salt/ serwisu generującego tajne klucze witryny WordPress.org}
 */
define('AUTH_KEY',         'Hl2R(4.5Wt)*MN_HtxF0giuv3M}j%390%)+t<Yu3!L|n;u1^$)02J$h`Oee[s6Pz');
define('SECURE_AUTH_KEY',  't(+n7RPpm+m9(S?lYyFp%CRaSO~s},0ma:([+g_SDu/l(a_I,3+~5 =(Q3*mr2!F');
define('LOGGED_IN_KEY',    'N/[Iq!yd(PC=R$;mG$K-<953Q64|yA-:6S+Tb2#?ryEkF2IIW(6?OY|kT<UxKaWm');
define('NONCE_KEY',        '?NicZ(,A`RaS1=8{Q`p^[s9|9*)c=zQp+|+@CQ8n2({2+:IvBVx23S2(SHy[Is&j');
define('AUTH_SALT',        '2:AYU.|D]};+IB.H,4AWkf[!]x5FB08]8pv{VKGfpt;1D8oga?:|A[-:8,(Tg&:v');
define('SECURE_AUTH_SALT', '^xs}Z#Be{|Jk|,:L@1K%f$b s:]{y<X%(g_YuM)Dfb fm73JUE@zi_SsMnAD}K+K');
define('LOGGED_IN_SALT',   'wMT0%5[*be#s;%HPGJs?MRHghQIrC=^S:W1(d,q2h9 p.,-KdE^|kaYh1*|v`9|Y');
define('NONCE_SALT',       'kv-2}yK^7OAa:yQz`W2dKh!(B4+Z70U/@<AjFw?nb|NvhE}#7k?tNxFf0x>m6Tz]');
/**#@-*/

/* Auto update i blokady */
define('DISALLOW_FILE_EDIT', true );

// DEBUG LOGI
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true );

// Ustaw odpowiednie środowisko na podst. linku - master || local
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
if (strpos($url,'.testowe') !== false){
	define(ENVIRONMENT, 'master');
} else {
	define(ENVIRONMENT, 'local');
}

switch (ENVIRONMENT){
	case 'master': 
		define('DB_NAME', 'leela-clone');
		define('DB_USER', 'leela-clone');
		define('DB_PASSWORD', 'VFLMuRNljU660tur');

		define('AUTOMATIC_UPDATER_DISABLED', true );
		define('DISALLOW_FILE_MODS', true ); 

	    define('WP_DEBUG_DISPLAY', false );
		break;

	case 'local':
		define('DB_NAME', 'leela-clone');
		define('DB_USER', 'leela-clone');
		define('DB_PASSWORD', 'VFLMuRNljU660tur');

		define('AUTOMATIC_UPDATER_DISABLED', false );
		define('DISALLOW_FILE_MODS', false ); 
		define('WP_AUTO_UPDATE_CORE', 'minor' );

		define('WP_DEBUG_DISPLAY', true );
		break;
}

/** Ustawia zmienne WordPressa i dołączane pliki. */
require_once(ABSPATH . 'wp-settings.php');