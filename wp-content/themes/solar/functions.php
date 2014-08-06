<?php
/************************************************************/
/*                                                          */
/*   INCLUDE ALL IMPORTANT FUNCTIONS                        */
/*                                                          */
/************************************************************/
function tk_register_functions() {
	require(get_template_directory().'/functions/add-wordpress-supports.php');              // WordPress Supports
	require(get_template_directory().'/functions/register-sidebars.php');                   // Register Sidebars
	require(get_template_directory().'/functions/post-types-and-taxonomies.php');           // Register Post Types and Taxonomies
	require(get_template_directory().'/functions/scripts-styles.php');                      // Enqueue Scripts and Styles
	require(get_template_directory().'/functions/widgets.php');                             // Widgets
	require(get_template_directory().'/functions/functions.php');                           // Load all custom functions
	require(get_template_directory().'/functions/meta-boxes.php');                          // Load Meta Boxes
	require(get_template_directory().'/functions/theme-settings.php');                      // Create custom admin panel
	require(get_template_directory().'/functions/thumbnail-sizes.php');                     // Load WP Thumbnail Sizes
	require(get_template_directory().'/functions/theme-style.php');
}
add_action( 'after_setup_theme', 'tk_register_functions',1 );
?>