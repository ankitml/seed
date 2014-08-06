<?php
/*

Template Name: Contact Us

*/
session_start();
get_header();
$prefix = 'tk_';
$sidebar_selected = get_post_meta($post->ID, $prefix.'sidebar', true);
$sidebar_position = get_post_meta($post->ID, $prefix.'sidebar_position', true);
$disable_banner   = get_post_meta($wp_query->post->ID, 'tk_disable_title', true);
$slider_type      = get_post_meta($wp_query->post->ID, 'tk_slider_type', true);

$sidebar          = 'full';
$position_content = '';
$cols_main        = 'col-md-12';

if($sidebar_position != 'fullwidth'){
  $sidebar = 'sidebar';
  $cols_main = 'col-md-8';
  if($sidebar_position == 'left'){ $position_content = 'pull-right'; }
}

$show_map = get_theme_option(wp_get_theme()->name.'_contact_show_map');

$x_coord       = get_option(wp_get_theme()->name.'_contact_googlemap_x');
$y_coord       = get_option(wp_get_theme()->name.'_contact_googlemap_y');
$zoom_factor   = get_option(wp_get_theme()->name.'_contact_googlemap_zoom');
$map_type      = get_option(wp_get_theme()->name.'_contact_google_map_type');
$marker_title  = get_option(wp_get_theme()->name.'_contact_marker_title');
$map_color     = get_theme_option(wp_get_theme()->name.'_contact_map_color');
$default_color = get_theme_option(wp_get_theme()->name.'_contact_default_map');

if($default_color) {
    if(empty($map_color)) {
        $map_color ='';
    }
} else {
    $map_color='';
}

if(empty($x_coord)) {$x_coord = 45.256024;}
if(empty($y_coord)) {$y_coord = 19.853861;}
if(empty($zoom_factor)) {$zoom_factor = 15;}
if(empty($map_type)) {$map_type = 'ROADMAP';}
?>

<div id="main-wrapper" class="container">
  <div class="single-post">
      <div class="row">
        <div class="<?php echo $cols_main; ?> <?php echo $position_content; ?> main-content">
          <article class="post <?php if(is_single()){ ?> featured <?php } ?>">
            <section>
                <div class="post-content">
                
                <?php if(empty($show_map)) { ?>
                <div class="contact-map">
                    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                    <div id="map_canvas" style="width: 100%; height: 100%; min-height: 0px;" class="contact-img"></div>

                    <?php if($map_color){ ?>

                            <script type="text/javascript">

                                var styles = [
                                    {
                                        "stylers": [
                                            { "hue": "<?php echo $map_color; ?>" }
                                        ]
                                    }
                                ];

                                var styledMap = new google.maps.StyledMapType(styles,
                                    {name: "Styled Map"});

                                var latlng = new google.maps.LatLng(<?php echo $x_coord?>, <?php echo $y_coord?>);

                                var myOptions = {
                                    zoom: <?php echo $zoom_factor ?>,
                                    center: latlng,
                                    mapTypeControl: false,
                                    streetViewControl: false,
                                    overviewMapControl: false,
                                    mapTypeId: google.maps.MapTypeId.<?php echo $map_type?>,
                                    scrollwheel: false
                                };

                                var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                                map.mapTypes.set('map_style', styledMap);
                                map.setMapTypeId('map_style');

                                <?php if(!empty($marker_title)) { ?>
                                var marker = new google.maps.Marker({
                                    position: latlng,
                                    map: map,
                                    title:"<?php echo $marker_title?>"
                                });
                                <?php }?>

                            </script>

                        <?php } else { ?>

                            <script type="text/javascript">
                                var latlng = new google.maps.LatLng(<?php echo $x_coord?>, <?php echo $y_coord?>);
                                var myOptions = {
                                    zoom: <?php echo $zoom_factor ?>,
                                    center: latlng,
                                    mapTypeControl: false,
                                    streetViewControl: false,
                                    overviewMapControl: false,
                                    mapTypeId: google.maps.MapTypeId.<?php echo $map_type?>,
                                    scrollwheel: false
                                };

                                var mapa = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                                <?php if(!empty($marker_title)) { ?>
                                var marker = new google.maps.Marker({
                                    position: latlng,
                                    map: mapa,
                                    title:"<?php echo $marker_title?>"
                                });
                                <?php }?>
                            </script>

                        <?php } ?>
                </div>

                <?php } ?>
                
                <div class="contact-content">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <div class="shortcodes">
                            <?php the_content(); ?>
                        </div>
                    <?php endwhile; ?>
                    <?php endif;?>
                </div>

                <h1 class="page-title"><?php the_title(); ?></h1>
                
                <div class="contact-page">
                    
                        <?php
                            $mail_success_msg = get_option(wp_get_theme()->name.'_contact_message_successful');
                            $mail_error_msg = get_option(wp_get_theme()->name.'_contact_message_unsuccessful');
                            $captcha_option = get_theme_option(wp_get_theme()->name.'_contact_disable_captcha');
                        ?>

                    <div class="contact-form">
                        <form method="GET" id="contact" class="comment-form" onsubmit="return checkForm(this)" action="<?php echo get_template_directory_uri().'/sendcontact.php'?>" >
                            <div class="row contact-name">
                                <div class="col-xs-12">
                                    <label for="name"><?php _e('Name (Required)' ,'tkingdom'); ?></label>
                                    <input type="text" value="<?php if(isset($_GET['captcha']) && $_GET['captcha'] == 'error'){echo $_SESSION['contactname'];} ?>"name="contactname" id="contactname" tabindex="1" />
                                </div>
                            </div>
                            <div class="row contact-name">
                                <div class="col-xs-12">
                                    <label for="email"><?php _e('Email (Required)' ,'tkingdom'); ?></label>
                                    <input type="text" value="<?php if(isset($_GET['captcha']) && $_GET['captcha'] == 'error'){echo $_SESSION['contactemail'];} ?>" name="email" id="contactemail" tabindex="2" />
                                </div>
                            </div>
                            <div class="row contact-message">
                                <div class="col-xs-12">
                                    <label for="message"><?php _e('Message (Required)' ,'tkingdom'); ?></label>
                                    <textarea name="message" id="contactmessage" tabindex="3" rows="10"><?php if(isset($_GET['captcha']) && $_GET['captcha'] == 'error'){echo $_SESSION['contactmessage'];} ?></textarea>
                                </div>
                            </div>

                            <?php if ($captcha_option !==  'yes') { //Disable captcha ?>
                                <div class="contact-captcha">
                                    <img src="<?php echo get_template_directory_uri()?>/script/captcha/captcha.php" id="captcha" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
                                    <div class="bg-input captcha-holder">
                                        <div class="control-group">
                                            <div class="input-prepend">
                                                <input type="text" name="captcha" id="captcha-form" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="refresh-text">
                                            <?php _e('Cant read? Refresh Image: ', 'tkingdom'); ?>
                                            <a onclick="document.getElementById('captcha').src='<?php echo get_template_directory_uri()?>/script/captcha/captcha.php?'+Math.random(); document.getElementById('captcha-form').focus();"
                                               id="change-image" class="captcha-refresh"><div class="fa-repeat"></div></a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            <?php } //Disable captcha?>

                            <div class="control-group">
                                <button type="submit" class="btn"><?php _e('Send Message', 'tkingdom'); ?></button>
                            </div>

                            <input type="hidden" name="returnurl" value="<?php echo get_permalink();  ?>">

                            <div id="contact-success">
                                <?php
                                if(isset($_GET['sent'])) {
                                    $what = $_GET['sent'];
                                    if($what == 'success') {
                                        echo $mail_success_msg;
                                    }
                                }
                                ?>
                            </div><!-- contact-success -->

                            <div id="contact-error">
                                <?php
                                if(isset($_GET['captcha']) && $_GET['captcha'] == 'error'){
                                    _e('Invalid Captcha!', 'tkingdom');
                                };
                                ?>
                                <?php
                                if(isset($_GET['sent'])) {
                                    $what = $_GET['sent'];
                                    if($what == 'error') {
                                        echo $mail_error_msg;
                                    }
                                }
                                ?>
                            </div><!-- contact-error -->

                        </form>
                    </div>
                
                </div>
                </div>
                </section>
               </article>
            </div><!-- shortcodes-->

            <?php if($sidebar_position != 'fullwidth'): ?>
                      <?php
                          $position = 'Right';
                          if($sidebar_position == 'left'){ $position = 'Left'; }
                              tk_get_sidebar($position, $sidebar_selected);
                      ?>
            <?php endif; ?>

        </div><!--/row-fluid-->
    </div>
</div><!--/container-->

<?php get_footer(); ?>