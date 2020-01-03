<?php
/**
 * Plugin Name: AMP URL Gutenberg Dynamic Block
 * Description: A dynamic block, block displays in the block editor and the front-end:The total number of URLs validated and the total number of AMP validation errors. These are in a custom taxonomy.
 * Version: 1.0.0
 * Author: Freelancer Martin
 * Author URI: https://github.com/Freelancer-Martin/AMP-gutenberg-dynamic-block
 * Text Domain: block-scaffolding
 *
 * @package BlockScaffolding
 */

namespace XWP\BlockScaffolding;

// Support for site-level autoloading.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

require_once __DIR__ . '\src\block\AMP-block\block-init.php';


$router = new Router( new Plugin( __FILE__ ) );
add_action( 'plugins_loaded', [ $router, 'init' ] );


// Init AMP block class
$new_AMP_Block_Validated_URL_Post_Type = new AMP_Block_Validated_URL_Post_Type( new Plugin( __FILE__ ) );
$new_AMP_Block_Validated_URL_Post_Type->run();


