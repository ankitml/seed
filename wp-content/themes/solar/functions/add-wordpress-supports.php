<?php
function tk_wordpress_supports() {

    /************************************************************/
    /*                                                          */
    /*   Enables search form                                    */
    /*                                                          */
    /************************************************************/
    add_theme_support( 'html5', array( 'search-form' ) );

    /************************************************************/
    /*                                                          */
    /*   Enables translation support                            */
    /*                                                          */
    /************************************************************/
    load_theme_textdomain( 'tkingdom', get_template_directory() . '/languages' );

    /************************************************************/
    /*                                                          */
    /*   Enables theme styles the visual                        */
    /*   editor with editor-style.css                           */
    /*                                                          */
    /************************************************************/
    add_editor_style();

    /************************************************************/
    /*                                                          */
    /*   Adds RSS feed links to <head>                          */
    /*   for posts and comments                                 */
    /*                                                          */
    /************************************************************/
    add_theme_support( 'automatic-feed-links' );

    /************************************************************/
    /*                                                          */
    /*   Adds support for post formats                          */
    /*   available formats: aside, gallery, link,               */
    /*   image, quote, status, video, audio, chat               */
    /*                                                          */
    /************************************************************/
    $post_formats = array(
        'link',
        'quote',
        'video');
    add_theme_support( 'post-formats', $post_formats );
    add_post_type_support('post', 'post-formats' );


    /************************************************************/
    /*                                                          */
    /*   Adds wp_nav_menu() support                             */
    /*   you can register as much menus as you want             */
    /*                                                          */
    /************************************************************/
    register_nav_menu( 'primary', __( 'Primary Menu', 'tkingdom' ) );

    /************************************************************/
    /*                                                          */
    /*   Adds Featured Image                                    */
    /*                                                          */
    /************************************************************/
    add_theme_support('post-thumbnails');

    /************************************************************/
    /*                                                          */
    /*   Adds support for WordPress header  background change   */
    /*                                                          */
    /************************************************************/
    // add_theme_support( 'custom-background', array('default-color' => 'fff',));
    $args = array(
        'flex-width'    => true,
        'width'         => 1920,
        'flex-height'    => true,
        'height'        => 210,
        'default-image' => get_template_directory_uri().'/theme-images/header-bg.jpg',
        'uploads' => true
    );
    add_theme_support( 'custom-header', $args );

    //Add custom background option
    $defaults = array(
        'default-color'          => '#EBECED',
        'default-image'          => '',
        'default-repeat'         => '',
        'default-position-x'     => '',
        'wp-head-callback'       => '_custom_background_cb',
        'admin-head-callback'    => '',
        'admin-preview-callback' => ''
    );
    add_theme_support( 'custom-background', $defaults );


    /************************************************************/
    /*                                                          */
    /*   Add support for Featured Image option                  */
    /*                                                          */
    /*                                                          */
    /*                                                          */
    /************************************************************/
    function tk_admin_style_script(){
        global $typenow;

        // STYLES
        wp_enqueue_style('thickbox');
        wp_enqueue_style('jquery-ui-datepicker');
        wp_register_style('timepicker', get_template_directory_uri().'/script/timepicker/jquery.ui.timepicker.css');
        wp_enqueue_style('timepicker');
        if(isset($_GET['page']) && $_GET['page'] == 'aq-page-builder'){}else{
            wp_register_style('admin-style', get_template_directory_uri() . '/functions/admin/admin.css');
            wp_enqueue_style('admin-style');
        }

        // SCRIPTS
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('my-upload');
        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_script('timepicker', get_template_directory_uri().'/script/timepicker/jquery.ui.timepicker.js', false, false, true );
        wp_enqueue_script('tkadminscripts', get_template_directory_uri().'/functions/admin/admin.js', false, false, true  );

        //add scripts and functions for adds
        if ($typenow == 'advertisement' and isset($_GET['post'])) {

            wp_register_script('flot', get_template_directory_uri() . '/script/flot/jquery.flot.js', 'jquery');
            wp_enqueue_script('flot');

            wp_register_script('flot_resize', get_template_directory_uri() . '/script/flot/jquery.flot.resize.js', 'jquery');
            wp_enqueue_script('flot_resize');

            wp_register_script('flot_tooltip', get_template_directory_uri() . '/script/flot/jquery.flot.tooltip_0.4.4.js', 'jquery');
            wp_enqueue_script('flot_tooltip');

            wp_register_script('flot_time', get_template_directory_uri() . '/script/flot/jquery.flot.time.js', 'jquery');
            wp_enqueue_script('flot_time');
            ?>

            <?php
            global $wpdb;
            $todays_date = date('Y-m-d');
            $date = strtotime(date("Y", strtotime($todays_date)) . " -7 days");
            $date = date('Y-m-d', $date);

            $pageposts = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "banner_stats WHERE banner_id = %d AND date BETWEEN '" . $date . "' AND '" . $todays_date . "' ORDER BY date ASC", $_GET['post']), OBJECT);

            $views = '';
            $clicks = '';
            foreach ($pageposts as $post) {
                $views .= "[(new Date(\"" . $post->date . "\")).getTime()," . $post->views . "],";
                $clicks .= "[(new Date(\"" . $post->date . "\")).getTime()," . $post->clicks . "],";
            }
            ?>
            <script>
                var views = [<?php echo $views; ?>];
                var clicks = [<?php echo $clicks; ?>];
            </script>


        <?php
        }

    }
    add_action('admin_enqueue_scripts', 'tk_admin_style_script');

}
add_action( 'after_setup_theme', 'tk_wordpress_supports' );
?>