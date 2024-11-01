<?php
/**
 * Plugin Name: Viasocial | Facebook Recents Comments
 * Plugin URI: http://viaprestige.github.io/Viasocial/
 * Description: Add facebook's recents comments Widget, "Make WordPress a better place".
 * Version: 1.0.0
 * Author: JIHAD SINNAOUR
 * Author URI: http://info.jihadsinnaour.com/
 * License: GPL2
 */

defined( 'ABSPATH' ) or die( 'Oups ! truc bizarrd ?' );

function v_requirements() {

	?>
	<div class="error">
		<p><strong><?php _e( 'Viasocial is not working :' ); ?></strong> <?php _e( 'Curl extension required, please read <a href="http://viaprestige.github.io/Viasocial/" target="_blanc">documentation</a>' ); ?></p>
	</div>
	<?php

}

if ( ! function_exists( 'curl_init' ) ) {
	add_action( 'admin_notices', 'v_requirements' );
	return false;
}

include('includes/widget.php');

function v_load_style() {
wp_enqueue_style( 'Viasocial', plugins_url('/css/style.css', __FILE__) );
}
add_action( 'wp_enqueue_scripts', 'v_load_style' );