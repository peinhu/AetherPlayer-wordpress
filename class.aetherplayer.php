<?php

class AetherPlayer{

function init() {

    if( is_home() ){
		//assign the variable of playlist
		echo '<script>var aetherplayer_playList_database = '.get_option("aetherplayer_playlist").';</script>';
		//load the bootstrap script of AetherPlayer
        wp_enqueue_script('AetherPlayer_bootstrap', plugins_url('aetherplayer/js/AetherPlayer_bootstrap.js', __FILE__),array(),false,true);
    }
	
}

function AetherPlayer_active() {
    add_option('aetherplayer_playlist', '[]', '', 'yes');
}

function AetherPlayer_deactive() {
    delete_option('aetherplayer_playlist');	
}

//assign variables and display the view
function view( $name, array $args = array() ) {
	
	foreach ( $args AS $key => $val ) {
		$$key = $val;
	}

	$file = AETHERPLAYER_PLUGIN_DIR . 'views/'. $name . '.php';

	include( $file );
}

}
