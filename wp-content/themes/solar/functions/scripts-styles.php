<?php

function tk_add_stylesheet() {
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
    wp_enqueue_style('bootstrap');

    wp_register_style('main_style', get_stylesheet_uri());
    wp_enqueue_style('main_style');

    wp_register_style('isotope', get_template_directory_uri().'/script/isotope/css/style.css');
    wp_enqueue_style('isotope');

    wp_register_style('shortcodes', get_template_directory_uri().'/css/shortcodes.css');
    wp_enqueue_style('shortcodes');

    wp_register_style('fontawesome', 'http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css');
    wp_enqueue_style('fontawesome'); 

    /***************************/
    /**** LOAD GOOGLE FONTS ****/
    /***************************/
    //Oxygen
    wp_register_style('Oxygen', '//fonts.googleapis.com/css?family=Oxygen:400,300,700');
    wp_enqueue_style('Oxygen');

    //PTSerif
    wp_register_style('PTSerif', '//fonts.googleapis.com/css?family=PT+Serif:400,700,400italic,700italic');
    wp_enqueue_style('PTSerif');


    /***************************************/
    /******LOAD CSS FOR BROWSERS************/
    /***************************************/

}
add_action( 'wp_enqueue_scripts', 'tk_add_stylesheet' );


/*************************************************************/
/************LOAD SCRIPTS***********************************/
/*************************************************************/

function tk_add_scripts() {

    $browser = $_SERVER['HTTP_USER_AGENT'];
    global $variable_array;
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui', get_template_directory_uri().'/script/jquery/jquery-ui-1.10.3.js', false, false, true );
    wp_enqueue_script('easing', get_template_directory_uri().'/script/jquery/jquery.easing-1.3.min.js', false, false, true );
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/script/bootstrap/bootstrap.min.js', false, false, true );
    wp_enqueue_script('modernizr', get_template_directory_uri().'/script/modernizr/modernizr.js', false, false, true );
    wp_enqueue_script('isotope', get_template_directory_uri().'/script/isotope/jquery.isotope.js', false, false, true );
    wp_enqueue_script('isotope-masonry', get_template_directory_uri().'/script/isotope/jquery.isotope.sloppy-masonry.min.js', false, false, true );
    wp_enqueue_script('infinite-scroll', get_template_directory_uri().'/script/infinite-scroll/infinite-scroll.min.js', false, false, true );
    wp_enqueue_script('infinite-scroll-call', get_template_directory_uri().'/script/infinite-scroll/infinite-scroll-call.js', false, false, true );
    wp_enqueue_script('placeholders', get_template_directory_uri().'/script/placeholders/placeholders.js', false, false, true );
    wp_enqueue_script('retina_js', get_template_directory_uri() . '/script/retina/retina.js', false, false, true );
    wp_enqueue_script('call-scripts', get_template_directory_uri().'/script/common.js', false, false, true );
    if(is_singular()) wp_enqueue_script( 'comment-reply' );

    wp_localize_script('infinite-scroll-call', 'ajax_var', array( 'url' => get_template_directory_uri() ));

    require(get_template_directory().'/config/localize-script-config.php');
    wp_localize_script('call-scripts', 'js_variables', $variable_array);
    wp_localize_script('admin', 'js_variables', $variable_array);

    if (strpos($browser, 'MSIE 8.0')) {
        wp_enqueue_script('respond', get_template_directory_uri() . '/script/respond/respond.src.js', false, false, true);
    }
}

add_action('wp_enqueue_scripts', 'tk_add_scripts');

//Remove Shortcodes plugin bootstrap css
add_action('wp_print_styles', 'tk_de_bootstrap_style', 100);
function tk_de_bootstrap_style() {
    wp_dequeue_style('bootstrap-shortcodes');
    wp_deregister_style('bootstrap-shortcodes');
}

?>