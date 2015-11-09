<?php
class AetherPlayer_Admin{

function init() {

    add_options_page('AetherPlayer', 'AetherPlayer', 'administrator','aetherplayer', array('AetherPlayer_Admin','aetherplayer_admin_page'));
	
}

//display the configuration page of AetherPlayer
function aetherplayer_admin_page() {

    global $wpdb;
	
    $rows = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type='attachment' order by ID desc", ARRAY_A);
	
    AetherPlayer::view('main', compact('rows'));
	
	AetherPlayer::view('script', array());
	
}


}

