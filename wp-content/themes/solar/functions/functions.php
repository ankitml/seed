<?php

	/* Add Infinite Scroll JS class to pagination links */
	add_filter('next_posts_link_attributes', 'posts_link_attributes');
	add_filter('previous_posts_link_attributes', 'posts_link_prev_attributes');
	function posts_link_attributes() {
		return 'class="next"';
	}

	function posts_link_prev_attributes() {
		return 'class="previous"';
	}

	/********************************************************************************************************/
	/*                                                                                                      */
	/*   Submenu replace default class                                                                      */
	/*                                                                                                      */
	/********************************************************************************************************/
	class replace_submenu_class extends Walker_Nav_Menu {
	  function start_lvl(&$output, $depth = 0, $args = array()) {
	    $indent = str_repeat("\t", $depth);
	    $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
	  }
	}

	/********************************************************************************************************/
	/*                                                                                                      */
	/*   VIDEO PLAYER                                                                                       */
	/*                                                                                                      */
	/********************************************************************************************************/
	function tk_video_player($url) {
	    if (!empty($url)) {
	        $key_str1 = 'youtube';
	        $key_str2 = 'vimeo';

	        $pos_youtube = strpos($url, $key_str1);
	        $pos_vimeo = strpos($url, $key_str2);
	        if (!empty($pos_youtube)) {
	            $url = str_replace('watch?v=', '', $url);
	            $url = explode('&', $url);
	            $url = $url[0];
	            $protocol = substr($url, 0, 5);

	            if($protocol == "http:"){
	                $url = str_replace('http://www.youtube.com/', '', $url);
	            }
	            if($protocol == "https"){
	                $url = str_replace('https://www.youtube.com/', '', $url);
	            }

	        ?>
            <figure class="featured-video scalable-wrapper">
	            <div class="scalable-element">
	                <div class="tk-video-holder">
	                    <iframe id="youtube-player" src="http://www.youtube.com/embed/<?php echo $url; ?>?enablejsapi=1&rel=0" frameborder="0" allowfullscreen></iframe>
	                </div>
	            </div>
            </figure>
	        <?php
	        }
	        if (!empty($pos_vimeo)) {
	            $url = explode('.com/', $url);
	        ?>

	            <figure class="featured-video scalable-wrapper">
		            <div class="scalable-element">
		                <div class="tk-video-holder">
	                        <iframe class="vimeo-video" src="http://player.vimeo.com/video/<?php echo $url[1]; ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
	                    </div>
	                </div>
	            </figure>
	        <?php
	        }
	        if (empty($pos_vimeo) && empty($pos_youtube)) {
	            echo "Video only allowes vimeo and youtube!";
	        }
	    }
	}

	/********************************************************************************************************/
	/*                                                                                                      */
	/*   GET SIDEBAR                                                                                        */
	/*                                                                                                      */
	/********************************************************************************************************/
	function tk_get_sidebar($sidebar_position, $sidebar_name) {
		$cols_sidebar = '';

		if($sidebar_name == ''){ $sidebar_name = 'Archive/Default'; }

	    if($sidebar_position == 'Left') { $cols_sidebar = 'pull-left'; } ?>
            <div id="sidebar" class="col-md-4 <?php echo $cols_sidebar; ?>">
				<div class="widgets-wrapper">
					<div class="sidebar-content">
                		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar_name)) : ?>
                		<?php endif; ?>
            		</div><!--/#sidebar-->
            	</div>
            </div>
<?php 

	}

	/********************************************************************************************************/
	/*                                                                                                      */
	/*   SOCIAL SHARE COUNTERS                                                                              */
	/*                                                                                                      */
	/********************************************************************************************************/

	// Facebook Share Counter
	function get_likes($url) {
	    $get_link = wp_remote_get('http://graph.facebook.com/' . $url, array('timeout' => 60));
	    if (is_wp_error($get_link)) {
	        return "0";
	    } else {
	        $facebook_count = json_decode($get_link['body'], true);
	        if (!isset($facebook_count['shares']) or $facebook_count['shares'] == '') {
	            return 0;
	        } else {
	            return $facebook_count['shares'];
	        }
	    }
	}

	// Twitter Share Counter
	function get_tweets($url) {
	    $get_link = wp_remote_get('http://urls.api.twitter.com/1/urls/count.json?url=' . $url);
	    if (is_wp_error($get_link)) {
	        return "0";
	    } else {
	        $twitter_count = json_decode($get_link['body'], true);
	        return intval($twitter_count['count']);
	    }
	}

	// Google plus Share Counter
	function get_plusones($url) {
	    $args = array(
	        'method' => 'POST',
	        'headers' => array(
	            'Content-Type' => 'application/json'
	        ),
	        'timeout' => 30,
	        'redirection' => 1,
	        'body' => json_encode(array(
	            'method' => 'pos.plusones.get',
	            'id' => 'p',
	            'method' => 'pos.plusones.get',
	            'jsonrpc' => '2.0',
	            'key' => 'p',
	            'apiVersion' => 'v1',
	            'params' => array(
	                'nolog' => true,
	                'id' => $url,
	                'source' => 'widget',
	                'userId' => '@viewer',
	                'groupId' => '@self'
	            )
	        )),
	        'sslverify' => false
	    );

	    $json_string = wp_remote_post("https://clients6.google.com/rpc", $args);

	    if (is_wp_error($json_string)) {
	        return "0";
	    } else {
	        $json = json_decode($json_string['body'], true);
	        return intval($json['result']['metadata']['globalCounts']['count']);
	    }
	}

	// Stumbleupon Share Counter
	function get_stumbleupon($url) {

	    $get_link = wp_remote_get('http://www.stumbleupon.com/services/1.01/badge.getinfo?url=' . $url);
	    if (is_wp_error($get_link)) {
	        return "0";
	    } else {
	        $stumbleupon_count = json_decode($get_link['body'], true);

	        if(isset($stumbleupon_count['result']['views'])){
	            if ($stumbleupon_count['result']['views'] == '') {
	                return 0;
	            } else {
	                return intval($stumbleupon_count['result']['views']);
	            }
	        } else {
	            return 0;
	        }
	    }
	}

	// Linkedin Share Counter
	function get_linkedin($url) {
	    $get_link = wp_remote_get('http://www.linkedin.com/countserv/count/share?url=' . $url . '&format=json');
	    if (is_wp_error($get_link)) {
	        return "0";
	    } else {
	        $linkedin_count = json_decode($get_link['body'], true);
	        if ($linkedin_count['count'] == '') {
	            return 0;
	        } else {
	            return intval($linkedin_count['count']);
	        }
	    }
	}

	// Pinterest Share Counter
	function get_pinit($url) {
	    $get_link = wp_remote_get('http://api.pinterest.com/v1/urls/count.json?callback=receiveCount&url=' . $url);

	    $temp_json = str_replace("receiveCount(", "", $get_link['body']);
	    $temp_json = substr($temp_json, 0, -1);

	    if (is_wp_error($get_link)) {
	        return "0";
	    } else {
	        $pinit_count = json_decode($temp_json, true);
	        if ($pinit_count['count'] == '') {
	            return 0;
	        } else {
	            return intval($pinit_count['count']);
	        }
	    }
	}

	/* get twitter followers on home page */

	function tk_get_twitter_followers() {

	    $twitter_user = get_theme_option(tk_theme_name . '_social_twitter');

	    $json = wp_remote_get('https://api.twitter.com/1/users/show.json?screen_name=' . $twitter_user . '&include_entities=true', array('timeout' => 60));

	    if (is_wp_error($json)) {
	        return "0.";
	    } else {
	        if (is_wp_error($json))
	            return "0";
	        $twitter_date = json_decode($json['body'], true);
	        return intval($twitter_date['followers_count']);
	    }
	}

	/* get facebook page likes on home page */

	function tk_get_facebook_likes() {

	    $facebook_user = get_theme_option(tk_theme_name . '_social_facebook');
	    $json = wp_remote_get("http://graph.facebook.com/" . $facebook_user, array('timeout' => 30));

	    if (is_wp_error($json)) {
	        return "0.";
	    } else {
	        $json = wp_remote_get("http://graph.facebook.com/" . $facebook_user, array('timeout' => 30));
	        if (is_wp_error($json))
	            return "0";
	        $fbData = json_decode($json['body'], true);
	        return intval($fbData['likes']);
	    }
	}

	/* get googe plus circled count */

	function gplus_count() {
	    $google_plus_count = '';

	    $gplus_username = get_theme_option(tk_theme_name() . '_social_google_plus');
	    $gplus_api = get_theme_option(tk_theme_name() . '_social_google_plus_api');

	    $get_link = wp_remote_get("https://www.googleapis.com/plus/v1/people/" . $gplus_username . "?key=" . $gplus_api, array('timeout' => 30));

	    if (is_wp_error($get_link)) {
	        return "0.";
	    } else {
	        $google_plus_count = json_decode($get_link['body'], true);
	        return intval($google_plus_count['plusOneCount']);
	    }
	}

	/********************************************************************************************************/
	/*                                                                                                      */
	/*   Advertising Functions And Database                                                                 */
	/*                                                                                                      */
	/********************************************************************************************************/

	add_action("init", "tk_create_tables"); //theme switch action
	function tk_create_tables() {
	    global $wpdb;

	    /*
	     * Create first table: user_rating
	     */
	    $table_name1 = $wpdb->prefix . "banner_stats";

	    if ($wpdb->get_var("show tables like '$table_name1'") !== $table_name1) {
	        $sql = "CREATE TABLE " . $table_name1 . " (
	                stat_id bigint(20) NOT NULL AUTO_INCREMENT,
	                banner_id bigint(20) NOT NULL,
	                date date NOT NULL,
	                clicks bigint(20) NOT NULL,
	                views bigint(20) NOT NULL,
	                PRIMARY KEY (stat_id),
	                KEY banner_id (banner_id));";
	        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	        dbDelta($sql);
	    }
	}

	function catch_that_image() {
	    global $post, $posts;
	    $first_img = '';
	    ob_start();
	    ob_end_clean();
	    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	    $first_img = $matches [1] [0];
	    if (empty($first_img)) { //Defines a default image
	        $first_img = "/images/default.jpg";
	    }
	    return $first_img;
	}

	add_action('init', 'tk_check_for_banner_redirection', 0); //Awaiting for banner click redirections
	add_action('init', 'tk_check_for_banner_stats', 0);

	function tk_check_for_banner_stats() {
	    global $wpdb;

	    if (isset($_GET['banner_stat_id'])) {
	        $banner_id = $_GET['banner_stat_id'];
	        $period = $_GET['period'];
	        $today = date("Y-m-d");
	        $date = '';
	        if ($period == 0) {
	            $date = '2011-01-01';
	        }

	        if ($period == 7) {

	            $date = strtotime(date("Y", strtotime($today)) . " -7 days");
	            $date = date('Y-m-d', $date);
	        }
	        if ($period == 30) {
	            $date = strtotime(date("Y", strtotime($today)) . " -30 days");
	            $date = date('Y-m-d', $date);
	        }
	        if ($period == 365) {
	            $date = strtotime(date("Y", strtotime($today)) . " -365 days");
	            $date = date('Y-m-d', $date);
	        }

	        $pageposts = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "banner_stats WHERE banner_id = %d AND date BETWEEN '" . $date . "' AND '" . $today . "' ORDER BY date ASC", $banner_id), OBJECT);
	        $views = '';
	        $clicks = '';

	        if (isset($_GET['data_type']) and $_GET['data_type'] == 'views') {
	            foreach ($pageposts as $post) {
	                $views .= "[" . (strtotime($post->date) * 1000) . "," . $post->views . "],";
	            }
	            $views = str_replace('],]', ']]', '[' . $views . ']');
	            echo $views;
	        }

	        if (isset($_GET['data_type']) and $_GET['data_type'] == 'clicks') {
	            foreach ($pageposts as $post) {
	                $clicks .= "[" . (strtotime($post->date) * 1000) . "," . $post->clicks . "],";
	            }
	            $clicks = str_replace('],]', ']]', '[' . $clicks . ']');
	            echo $clicks;
	        }

	        exit;
	    }
	}

	function tk_check_for_banner_redirection() {//Save click for the banner and redirect to the banner URL
	    if (isset($_GET['banner_id'])) {
	        global $wpdb;
	        tk_add_banner_click($_GET['banner_id']);
	    }
	}

	function tk_add_banner_view($banner_id) {
	    global $wpdb;
	    global $post;
	    if (!is_admin()) {
	        $todays_date = date('Y-m-d');
	        $insert_query = $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "banner_stats SET views = (views + 1) WHERE banner_id = %d AND date = '" . $todays_date . "'", $banner_id));
	        if (!$insert_query) {
	            $wpdb->query($wpdb->prepare("INSERT INTO " . $wpdb->prefix . "banner_stats (banner_id, date, clicks, views) VALUES(%d, '" . $todays_date . "', 0, 1)", $banner_id));
	        }
	    }
	}

	function tk_add_banner_click($banner_id) {
	    global $wpdb;
	    $todays_date = date('Y-m-d');
	    $insert_query = $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "banner_stats SET clicks = (clicks + 1) WHERE banner_id = %d AND date = '" . $todays_date . "'", $banner_id));
	    if (!$insert_query) {
	        $wpdb->query($wpdb->prepare("INSERT INTO " . $wpdb->prefix . "banner_stats (banner_id, date, clicks, views) VALUES(%d, '" . $todays_date . "', 1, 0)", $banner_id));
	    }
	    wp_redirect(get_post_meta($banner_id, 'tk_advertisement_link', true));
	    exit;
	}

/********************************************************************************************************/
/*                                                                                                      */
/*   TGM Plugin activation for some plugins                                                             */
/*                                                                                                      */
/********************************************************************************************************/
require_once get_template_directory() . '/functions/class-tgm-plugin-activation.php';

if ( ! function_exists( 'register_slider_plugin' ) ) {
    add_action( 'tgmpa_register', 'register_slider_plugin' );
    function register_slider_plugin() {

        $plugins = array(
            array(
                'name'     				=> __('ThemesKingdom Shortcodes', 'tkingdom'), // The plugin name
                'slug'     				=> 'shortcodes', // The plugin slug (typically the folder name)
                'source'   				=> get_template_directory() . '/functions/plugins/shortcodes.zip', // The plugin source
                'required' 				=> false, // If false, the plugin is onl    y 'recommended' instead of required
                'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
            )
        );
        $config = array(
            'domain'       		=> 'tkingdom',         	        // Text domain - likely want to be the same as your theme.
            'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
            'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
            'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
            'menu'         		=> 'install-required-plugins', 	// Menu slug
            'has_notices'      	=> true,                       	// Show admin notices or not
            'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
            'message' 			=> '',							// Message to output right before the plugins table
            'strings'      		=> array(
            'page_title'                      => __( 'Install Required Plugins', 'tkingdom' ),
            'menu_title'                      => __( 'Install Plugins', 'tkingdom' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tkingdom' ), // %1$s = plugin name
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tkingdom' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tkingdom' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tkingdom' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tkingdom' ), // %1$s = dashboard link
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
            )
        );
        tgmpa( $plugins, $config );
    } // function
} // if


/*************************************************************/
/************     TWITTER SCRIPT   ***************************/
/*************************************************************/

//gets twitter relative time
function twitter_time($get_twitter_time) {

    $base = strtotime("now"); 
    //get timestamp when tweet created 
    $tweet_time = strtotime($get_twitter_time); 
    //get difference 
    $time_result = $base - $tweet_time; 
    //calculate different time values 
    $minute = 60;
    $hour = $minute * 60; 
    $day = $hour * 24; 
    $week = $day * 7; 
    if(is_numeric($time_result) && $time_result > 0) { 
    //if less then 3 seconds 
    if($time_result < 3) return "right now"; 
    //if less then minute 
    if($time_result < $minute) return floor($time_result) . " seconds ago"; 
    //if less then 2 minutes 
    if($time_result < $minute * 2) return "about 1 minute ago"; 
    //if less then hour 
    if($time_result < $hour) return floor($time_result / $minute) . " minutes ago"; 
    //if less then 2 hours 
    if($time_result < $hour * 2) return "about 1 hour ago"; 
    //if less then day
    if($time_result < $day) return floor($time_result / $hour) . " hours ago"; 
    //if more then day, but less then 2 days 
    if($time_result > $day && $time_result < $day * 2) return "yesterday"; 
    //if less then year 
    if($time_result < $day * 365) return floor($time_result / $day) . " days ago"; 
    //else return more than a year 
    return "over a year ago"; }      
} 


function twitter_script($unique_id, $limit) {
    
require_once(get_template_directory().'/script/twitter/TwitterAPIExchange.php');

/*GET TWITTER KEYS FROM ADMINISTRATION*/
$twitter_consumer_key = get_theme_option(wp_get_theme()->name . '_social_twitter_consumer_key');
$twitter_consumer_secret = get_theme_option(wp_get_theme()->name . '_social_twitter_consumer_secret');
$twitter_access_token = get_theme_option(wp_get_theme()->name . '_social_twitter_access_token');
$twitter_token_secret = get_theme_option(wp_get_theme()->name . '_social_twitter_token_secret');
$twitter_username = get_theme_option(wp_get_theme()->name . '_social_twitter');


/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => $twitter_access_token,
    'oauth_access_token_secret' => $twitter_token_secret,
    'consumer_key' => $twitter_consumer_key,
    'consumer_secret' => $twitter_consumer_secret
);

/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name='.$twitter_username;

if(!empty($unique_id)) {
    $getfield .= "&count=".$limit;
} else {
    $getfield .= "&count=1";
}

$requestMethod = 'GET';

/** Perform the request and echo the response **/
$twitter = new TwitterAPIExchange($settings);
$twitter_results = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();

if($unique_id !== 'home') { ?>
    <ul class="twitter_ul">
<?php } 

    foreach($twitter_results as $single_tweet) {        
 
        if(!empty($single_tweet->text)){
        //gets twitter content, time and name
        $twitter_status = $single_tweet->text;
        $twitter_time = $single_tweet->created_at;
        $twitter_name = $single_tweet->user->screen_name;
                
        $twitter_status = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\">\\2</a>", $twitter_status);
        $twitter_status = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\">\\2</a>", $twitter_status);
        $twitter_status = preg_replace("/@(\w+)/", "<a href=\"http://twitter.com/\\1\">@\\1</a>", $twitter_status);
        $twitter_status = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\">#\\1</a>", $twitter_status);
        
        //checks if it's single tweet on home or twitter widget
        if($unique_id == 'home'){    
    ?>
                        

        <div class="container twit-box">
                <figure>
                    <img src="<?php echo get_template_directory_uri(); ?>/theme-images/twitter.png" />
                </figure>
                <p><?php echo $twitter_status; ?></p>
                <div class="twit-author"><a href="https://twitter.com/<?php echo $twitter_name; ?>" target="_blank"><?php echo '@' . $twitter_name; ?></a></div>
        </div>    

            
    <?php //use this if it's twitter widget

        } else { ?> 
           
            <li>
                <div class="box-twitter-center left">
                    <span><?php echo $twitter_status; ?></span>
                </div>
                <span class="twitter-links"><?php echo twitter_time($twitter_time); ?></span>
                <div class="clear"></div>
            </li>  

        <?php } //$unique_id == 'home' ?>  
    <?php } //$single_tweet->text ?>
<?php } ?>
    
<?php if($unique_id !== 'home') { ?>
    </ul>
<?php } ?>    
                        
<?php
}

/********************************************************************************************************/
/*                                                                                                      */
/*                                  CHANGE THEME COLOR                                                  */
/*                                                                                                      */
/********************************************************************************************************/

function tk_change_color() {
    get_template_part('/functions/change-colors');
}
add_action('wp_head', 'tk_change_color', '99');


/********************************************************************************************************/
/*                                                                                                      */
/*                                  RETINA READY SUPPORT                                                */
/*                                                                                                      */
/********************************************************************************************************/
add_filter( 'wp_generate_attachment_metadata', 'retina_support_attachment_meta', 10, 2 );
/**
 * Retina images
 *
 * This function is attached to the 'wp_generate_attachment_metadata' filter hook.
 */
function retina_support_attachment_meta( $metadata, $attachment_id ) {
    foreach ( $metadata as $key => $value ) {
        if ( is_array( $value ) ) {
            foreach ( $value as $image => $attr ) {
                if ( is_array( $attr ) )
                    retina_support_create_images( get_attached_file( $attachment_id ), $attr['width'], $attr['height'], true );
            }
        }
    }
 
    return $metadata;
}

/**
 * Create retina-ready images
 *
 * Referenced via retina_support_attachment_meta().
 */
function retina_support_create_images( $file, $width, $height, $crop = false ) {
    if ( $width || $height ) {
        $resized_file = wp_get_image_editor( $file );
        if ( ! is_wp_error( $resized_file ) ) {
            $filename = $resized_file->generate_filename( $width . 'x' . $height . '@2x' );
 
            $resized_file->resize( $width * 2, $height * 2, $crop );
            $resized_file->save( $filename );
 
            $info = $resized_file->get_size();
 
            return array(
                'file' => wp_basename( $filename ),
                'width' => $info['width'],
                'height' => $info['height'],
            );
        }
    }
    return false;
}


?>