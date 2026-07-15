<?php
define( 'DB_NAME', 'u816503718_x' );
define( 'DB_USER', 'u816503718_hasan13063282' );
define( 'DB_PASSWORD', 'Bangladesh123#@21' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

define('AUTH_KEY',         'f0G|Evn+{C?tfU-x%iZvu|]hK{ugvA[r45+Qe`81J{l<OQDwF8Xn*g0l0a5mWX|_');
define('SECURE_AUTH_KEY',  '!QD1EFzJI|-T_03AQXz{t_|A6Hr#m6S~PY-hal{IGU>}DXc fvlcVLCL}P1{NS_@');
define('LOGGED_IN_KEY',    '4qyV5Id&~?.x|5*Gt&LV*o,/IX,bvhrs@^|d%aNm*)U)9UW?h*ltfqRWS!VOAkC~');
define('NONCE_KEY',        '{P87%-Gsrp_gzY0uWvtC[H|A|/j#^ca-]=}&jwaOypzo[ft|ZmP5uAzNYTkzhG1c');
define('AUTH_SALT',        'k}S:KY1 RY1J |4{gRu^WJT=vV4qJeX/tMMgwswff609&y-.L-On`2]3vi.g-L.v');
define('SECURE_AUTH_SALT', '70ZSb4wYk;/F+:$ .Gg2i0hszEygcHh)N+/Fn-TaNKFgfyA/>G%D)TL^Pv3|ol6D');
define('LOGGED_IN_SALT',   'temR;c|R_1=*)&blx*PrVgLCJM.|e+(9/Mp{T@6{9?.6ZJp| hT1@n^mvm-YGIQ*');
define('NONCE_SALT',       'W`.tV|?0/-{W=u|bQq^Od#q4*+oXX9=H8|%Z}<SbhPb,6+Vt;j8V;C! IwtFbDhI');

$table_prefix = 'wp_';

define( 'WP_DEBUG', false );
define( 'FS_METHOD', 'direct' );

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';
