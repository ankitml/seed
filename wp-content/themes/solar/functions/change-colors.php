<?php

/*************************************************************/
/********************   COLOR SCHEME    **********************/
/*************************************************************/
$theme_name = 'solar_';
$theme_color = get_option($theme_name.'theme_color', '');

if(!empty($theme_color)) {
?>
    <style type="text/css">

        .btn, 
        .widget form #s input[type="submit"], 
        .tagcloud a, 
        .widget_calendar tbody td#today,
        .post .meta .featured-banner,
        .newsletter input[type=submit] {
            background-color: <?php echo $theme_color; ?>;
        }

        .tagcloud a,
        .post .meta .featured-banner{
            border-color: <?php echo $theme_color; ?>;
        }

        .post h2 a:hover,
        .post-nav.block a i {
            color: <?php echo $theme_color; ?>;
        }

        .post-content blockquote {
            border-left: 5px solid <?php echo $theme_color; ?>;
        }

    </style>
<?php  } ?>