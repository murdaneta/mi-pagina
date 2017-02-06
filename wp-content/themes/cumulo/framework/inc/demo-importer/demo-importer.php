<?php

/* Demo Importer works only in admin */
if( is_admin() ) {
	define( 'DEMO_IMPORTER_NONCE', 'f82b4275587b3783' );
	
	require_once ( 'demo-importer-admin.php' );
	require_once ( 'demo-importer-ajax.php' );
}
