<?php
/************************************************************/
/*                                                          */
/*   Adds support for sidebars and registers new ones       */
/*                                                          */
/************************************************************/
if (function_exists('register_sidebar')) {
    register_sidebar(array(
            'name' => 'Archive/Default',
            'before_widget' => '<div class="widget %2$s">',
            'after_widget'  => '</div>',            
            'before_title' => '<h3>',
            'after_title' => '</h3>')
    );
}

if (function_exists('register_sidebar')) {
    register_sidebar(array(
            'name' => 'Search',
            'before_widget' => '<div class="widget %2$s">',
            'after_widget'  => '</div>',            
            'before_title' => '<h3>',
            'after_title' => '</h3>')
    );
}

if (function_exists('register_sidebar')) {
    register_sidebar(array(
            'name' => 'Footer Widget 1',
            'before_widget' => '<div class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>')
    );
}

if (function_exists('register_sidebar')) {
    register_sidebar(array(
            'name' => 'Footer Widget 2',
            'before_widget' => '<div class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>')
    );
}

if (function_exists('register_sidebar')) {
    register_sidebar(array(
            'name' => 'Footer Widget 3',
            'before_widget' => '<div class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>')
    );
}

global $wpdb;
$results = $wpdb->get_results("SELECT post_title FROM  ".$wpdb->prefix."posts WHERE post_type = 'sidebars' AND post_status = 'publish'");
foreach ($results as $one_col) {

    if (function_exists('register_sidebar')) {
        register_sidebar(array(
                'name' => $one_col->post_title,
                'before_widget' => '<div class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3>',
                'after_title' => '</h3>')
        );
    }
}

?>