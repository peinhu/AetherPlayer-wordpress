<?php
/*
Plugin Name: AetherPlayer
Plugin URI: https://github.com/peinhu/AetherPlayer-wordpress
Description: The WordPress plugin version for AetherPlayer project. AetherPlayer is a CD-like simple HTML5 audio player which is very suitable for blogs and personal websites.
Version: 1.0
Author: Payne
Author URI: http://2ndrenais.com
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2015-2025 Payne, Inc.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

define( 'AETHERPLAYER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'AETHERPLAYER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

register_activation_hook( __FILE__, array('AetherPlayer','AetherPlayer_active'));

register_deactivation_hook( __FILE__, array('AetherPlayer','AetherPlayer_deactive'));

require_once( AETHERPLAYER_PLUGIN_DIR . 'class.aetherplayer.php' );

if( is_admin() ) {
	require_once( AETHERPLAYER_PLUGIN_DIR . 'class.aetherplayer-admin.php' );
	add_action('admin_menu',array('AetherPlayer_Admin','init'));
}

add_action( 'wp_enqueue_scripts', array('AetherPlayer','init'));


