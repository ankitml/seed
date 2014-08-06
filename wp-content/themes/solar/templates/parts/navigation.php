<nav class="navbar navbar-default" role="navigation">
  <a href="#" class="close-navbar"><i class="icon-close"></i></a>
    <div class="navbar-collapse" id="bs-example-navbar-collapse-1">
    <!-- Collect the nav links, forms, and other content for toggling -->
    
      <!-- Primary navigation -->
        
        <?php if (has_nav_menu('primary')){
            wp_nav_menu( array(
                    'theme_location'  => 'primary',
                    'menu'            => '',
                    'menu_id'         => 'navigation',
                    'depth'           => 0,
                    'container'       => '',
                    'container_class' => 'navbar-collapse',
                    'menu_class'      => 'nav navbar-nav',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'walker'          => new replace_submenu_class()
                )
            );

        }else {
            wp_page_menu(array(
                    'depth'       => 0,
                    'sort_column' => 'menu_order, post_title',
                    'menu_class'  => '',
                    'include'     => '',
                    'exclude'     => '',
                    'echo'        => true,
                    'show_home'   => false,
                    'link_before' => '',
                    'link_after'  => ''
                )
            );
        } ?>

      <!-- Primary navigation end -->

    </div><!-- /.navbar-collapse -->
</nav>