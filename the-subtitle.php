<?php
/**
	Plugin Name: The Subtitle
	Version: 1.4
	Plugin URI: http://www.to-wonder.com/the-subtitle
	Description: Allows a very simple and elegant subtitle in your posts, pages and custom post types
	Author: Luc Princen
	Author URI: http://www.to-wonder.com
	Contributors: Kathy Darling, Joel Berghoff

    Copyright 2012 Luc Princen (email: Luc@to-wonder.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



//
//	Public functions:
//


//register the shortcode:
add_shortcode( 'the-subtitle', 'the_sub_shortcode' );

function the_subtitle(){
	global $post;
	$post_id = $post->ID;
	
	$sub = get_post_meta($post_id, 'the_sub_subtitle', true);
	if($sub != 'Subtitle'){
		echo $sub;
	}
}

function get_the_subtitle($post_id = null){
	if($post_id == null){
		global $post;
		$post_id = $post->ID;
	}
	$sub = get_post_meta($post_id, 'the_sub_subtitle', true);
	
	if($sub != 'Subtitle'){
		return $sub;
	}
}


function the_sub_shortcode(){
	the_subtitle();
}


//
//	Backend functions:
//


add_action( 'admin_enqueue_scripts', 'the_sub_style_register' );
add_action( 'edit_form_advanced', 'the_sub_form_register' );
add_action( 'edit_page_form', 'the_sub_form_register' );
add_action( 'save_post', 'the_sub_meta_save' );



function the_sub_style_register($hook) {
 
	if( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' ) 
		return;
		
	//add the styles and scripts:
	add_action('admin_head','the_sub_inline_style');
	wp_enqueue_script('the_sub_script', the_sub_url().'/script.js', array('jquery'), '1.2', true);
}

function the_sub_inline_style(){ ?>
	<style type="text/css">
		#the_subtitle {
			margin: 5px 0px 15px;
			width: 100%;
			padding: 3px 8px;
			font-size: 1.3em;
		}
	</style>
<?php }


function the_sub_form_register(){
	
	//create the meta field (don't use a metabox, we have our own styling):
	wp_nonce_field( plugin_basename( __FILE__ ), 'the_sub_nonce');
	
	//get the post ID
	if(isset($_GET['post'])){		
		$post_id = $_GET['post'];
	}else{
		global $post;
		$post_id = $post->ID;
	}
	
	//get the subtitle value (if set)
	$sub = get_post_meta($post_id, 'the_sub_subtitle', true);
	if($sub == null){
		$sub = __('Subtitle');
	}
	// echo the inputfield with the value.
	echo '<input type="text" class="subtitle" name="subtitle" value="'.$sub.'" id="the_subtitle"/>';
	
}

function the_sub_meta_save($post_id){
	
	//check to see if this is an autosafe and if the nonce is verified:
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
 		return;

	if (!isset($_POST['the_sub_nonce']) || !wp_verify_nonce( $_POST['the_sub_nonce'], plugin_basename( __FILE__ ) ) )
 		return;
	
	//update the postmeta accordingly:
	update_post_meta($post_id, 'the_sub_subtitle', $_POST['subtitle']);
	return;
}


function the_sub_url(){
	
	//simple return function to get the URL of this plugin:
	$full_path = plugin_dir_url(__FILE__);
	return substr( $full_path , 0 , -1 ); //strip the trailing slash
}



?>
