<!DOCTYPE html>
<!--[if IE 8]>    <html class="ie8"> <![endif]-->
<!--[if IE 9]>    <html class="ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html <?php language_attributes(); ?> class=""> <!--<![endif]-->
<head>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
  <title>
        <?php
        global $page, $paged;

        wp_title('|', true, 'right');

        bloginfo('name');

        $site_description = get_bloginfo('description', 'display');
        if ($site_description && ( is_home() || is_front_page() ))
            echo " | $site_description";

        if ($paged >= 2 || $page >= 2)
            echo ' | ' . sprintf(__('Page %s', 'tkingdom'), max($paged, $page));
        ?>
  </title>
  <link rel="profile" href="http://gmpg.org/xfn/11"/>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">

 <?php
      // *** get custom favicon
      $favicon = get_option(wp_get_theme()->name . '_general_favicon'); 
      if(empty($favicon)){
          $favicon = get_template_directory_uri() . "/theme-images/favicon.ico";
      } ?>
      <link rel="shortcut icon" href="<?php echo $favicon; ?>"/>

      <?php
      // get google analitics code
      $g_analitics = get_option(wp_get_theme()->name . '_general_google_analytics');
      if (isset ($g_analitics) && $g_analitics != '') {
          echo stripslashes($g_analitics);
      } ?>

  <!-- HEADER BACKGROUND -->
  <?php

      $header_bg = get_header_image();
      $header_text_color = get_header_textcolor();

  ?>

<style type="text/css">
  .main-header {
    background: url("<?php echo $header_bg; ?>") no-repeat scroll center center / cover #2A2C2F;
  }

  .main-header a{
    color:<?php echo '#'.$header_text_color; ?>;
  }

  <?php if(is_single()){ ?>
    .single-format-quote .post section blockquote {
      background: url("img/jobs.jpg") no-repeat scroll 0 0 / cover #273035;
      border: medium none;
      margin: 0;
      padding: 30px 40px;
            }
  <?php } ?>

  <?php
    
    if(is_search()){ ?>
      h4 {
        margin-bottom: 0;
      }
    <?php } ?>

  ?>

</style>

<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
  <?php if ( ! isset( $content_width ) ) $content_width = 1170; ?>
  <!-- NAVIGATION -->
  <?php get_template_part('/templates/parts/navigation'); ?>

  <div class="body-content">

    <div id="preloader">
      <div id="status">
        <div class="spinner"></div>
      </div>
    </div>

    <header class="main-header verticalize-container">
      <div class="container verticalize">

          <!-- HEADER LOGO -->
          <?php
              $header_logo = get_option(wp_get_theme()->name . '_general_header_logo');
          ?>

          <div class="header-left clearfix">
            <?php if(empty($header_logo)){ ?>
                    <a class="navbar-brand site-title" href="<?php echo home_url(); ?>"><?php echo get_bloginfo('title'); ?></a>
            <?php }else{ ?>
                    <a class="navbar-brand site-title" href="<?php echo home_url(); ?>"><img src='<?php echo $header_logo; ?>' /></a>
            <?php } ?>
            <aside class="site-description"><?php echo get_bloginfo('description'); ?></aside>
          </div>

          <div class="header-right">
            <form method="get" id="searchform" class="submit-search-form" action="">
              <input type="text" name="s" id="search-main" class="form-control" placeholder="<?php _e('Type here and press enter.', 'tkingdom'); ?>">
            </form>
            <a href="#" class="search-trigger"><?php _e('Search', 'tkingdom'); ?></a>
            <a href="#" class="navbar-trigger">
              <?php _e('Menu', 'tkingdom'); ?>
              <i><span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span></i>
            </a>
          </div>
      </div>
    </header>
<!-- 
    <header class="main-header fixed">
      <div class="container">
          <div class="header-right pull-right">
            <form class="navbar-form search-form" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
              <input type="text" name="s" id="search" class="form-control" placeholder="Type here and press enter.">
            </form>
            <a href="#" class="search-trigger"><?php _e('Search', 'tkingdom'); ?></a>
            <a href="#" class="navbar-trigger">
              <span class="menu-text"><?php _e('Menu', 'tkingdom'); ?></span>
              <i><span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span></i>
            </a>
          </div>
      </div>
    </header>
     -->