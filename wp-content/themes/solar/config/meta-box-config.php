<?php
/************************************************************************************************************************/
/*                                                                                                                      */
/*   Configuration array for post and page metaboxes
        Creating MetaBox:
            array(
                'id' => 'id_of_metabox',
                'name' => __('Name of Field', 'tkingdom'),
                'pages' => array('post', 'page', 'some_custom_post_type'),      // supports multiple post types
                'context' => 'side',                                            // The part of the page where the edit screen section should be shown ('normal', 'advanced', or 'side')
                'priority' => 'high',                                           // The priority within the context where the boxes should show ('high', 'core', 'default' or 'low')
                'fields' => array(
                                                                                // all available fields are explained below
                )
            ),
        Available fields:
        Text field - name, description, id and name, type of field, default value:
            array(
                'name' => __('Name of Field', 'tkingdom'),
                'desc' => __('Short description', 'tkingdom'),
                'id' => $prefix . 'id_of_field',
                'type' => 'text',
                'std' => 'default value for field'
            ),
        Textarea field - name, description, id and name, type of field, default value, number of rows and columns
            array(
                'name' => __('Name of Field', 'tkingdom'),
                'desc' => __('Short description', 'tkingdom'),
                'id' => $prefix . 'id_of_field',
                'type' => 'textarea',
                'std' => 'default value for field'
                'options' => array(
                    'rows' => '3',
                    'cols' => '18'
                )
            ),
        WP Editor field -

        Select field - name, description, id and name, type of field, options array with text and value
            array(
                'name' => __('Name of Field', 'tkingdom'),
                'desc' => __('Short description', 'tkingdom'),
                'id' => $prefix . 'id_of_field',
                'type' => 'select',
                'options' => array(
                    'Text to show in option' => 'value_one',
                    'Some other option text' => 'value_two'
                )
            ),
        Select Category field - name, description, id and name, type of field, taxonomy if empty category is used
            array(
                'name' => __('Name of Field', 'tkingdom'),
                'desc' => __('Short description', 'tkingdom'),
                'id' => $prefix . 'id_of_field',
                'type' => 'category',
                'taxonomy' => 'custom_taxonomy'
            ),
        Radio field - name, description, id and name, type of field, name and text of buttons
            array(
                'name' => __('Name of Field', 'tkingdom'),
                'desc' => __('Short description', 'tkingdom'),
                'id' => $prefix . 'id_of_field',
                'type' => 'radio',
                'options' => array(
                    'Text to show in option' => 'value_one',
                    'Some other option text' => 'value_two'
                )
            ),
        Checkbox field - name, description, id and name, type of field, name and text of buttons
            array(
                'name' => __('Name of Field', 'tkingdom'),
                'desc' => __('Short description', 'tkingdom'),
                'id' => $prefix . 'id_of_field',
                'type' => 'checkbox',
            ),
        Select Sidebar field - name, description, id and name, type of field
            array(
                'name' => __('Name of Field', 'tkingdom'),
                'desc' => __('Short description', 'tkingdom'),
                'id' => $prefix . 'id_of_field',
                'type' => 'select-sidebar',
            ),
        Upload Image field - name, description, id and name, type of field
            array(
                'name' => __('Name of Field', 'tkingdom'),
                'desc' => __('Short description', 'tkingdom'),
                'id' => $prefix . 'id_of_field',
                'type' => 'imageupload',
                'std' => 'default value for field'
            ),
        Select Sidebar Position field - name, description, id and name, type of field
            array(
                'name' => __('Name of Field', 'tkingdom'),
                'desc' => __('Short description', 'tkingdom'),
                'id' => $prefix . 'id_of_field',
                'type' => 'sidebar',
                'templates' => array('templates/template-full-width.php', 'templates/template_blog.php' ),

            ),


/*                                                                                                                      */
/************************************************************************************************************************/


$prefix = 'tk_';
$meta_boxes = array(
    /************************************************************/
    /*                                                          */
    /*   Metaboxes for advertising options                      */
    /*                                                          */
    /************************************************************/
    array(
        'id' => 'advertisement_meta_box_link',
        'title' => __('Advertisement Link', 'tkingdom'),
        'pages' => array('advertisement'),
        'context' => 'side',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Advertisement Link', 'tkingdom'),
                'desc' => 'e.g. http://www.site.com',
                'id' => $prefix . 'advertisement_link',
                'type' => 'text',
                'std' => ''
            ),
            array(
                'name' => __('Custom Banner Code', 'tkingdom'),
                'desc' => 'If code is set it will be shown instead of advert selected above',
                'id' => $prefix . 'custom_banner_code',
                'type' => 'textarea',
                'std' => '',
                'options' => array(
                    'rows' => '3',
                    'cols' => '18'
                )
            )
        )
    ),
    array(
        'id' => 'advertisement_meta_box',
        'title' => __('Advertisement', 'tkingdom'),
        'pages' => array('advertisement'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Banner Stats', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'banner_stats',
                'type' => 'annotated_timeline',
                'std' => ''
            )
        )
    ),
    /***************** end add metabox ***********************/

    /************************************************************/
    /*                                                          */
    /*   Advertising in single post                             */
    /*                                                          */
    /************************************************************/

    /*array(
        'id' => 'sidebar_ad_meta',
        'title' => __('Single Post AD', 'tkingdom'),
        'pages' => array('post'), // multiple post types
        'context' => 'normal',
        'priority' => 'low',
        'fields' => array(
            array(
                'name' => __('Select Ad', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'advertising',
                'type' => 'select-advertising',
                'std' => '',
                'options' => ''
            ),
        )
    ),*/

    /************************************************************/
    /*                                                          */
    /*   Metabox for sidebar position also one can chose        */
    /*   different sidebar for every post/page                  */
    /*                                                          */
    /************************************************************/
    array(
        'id' => 'sidebar_position_meta',
        'title' => __('Sidebar Position', 'tkingdom'),
        'pages' => array('post', 'page'), // multiple post types
        'context' => 'side',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Sidebar Position', 'tkingdom'),
                'desc' => __('Short description', 'tkingdom'),
                'id' => $prefix . 'sidebar_position',
                'type' => 'sidebar',
                'templates' => array(
                    'templates/template-full-width.php' => array('post_meta8'),
                    'templates/template_blog.php' => 'post_meta13'
                ),

            ),
            array(
                'name' => __('Select sidebar', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'sidebar',
                'type' => 'select-sidebar',
                'std' => '',
                'options' => ''
            ),
        )
    ),
    /***************** end add sidebar options ***********************/
    
    /************************************************************/
    /*                                                          */
    /*   Configuration for post formats:                        */
    /*   video, audio, link and quote                           */
    /*                                                          */
    /************************************************************/
    array(
        'id' => 'post_format_gallery',
        'title' => __('Slider Fields', 'tkingdom'),
        'pages' => array('post', 'gallery', 'services', 'events'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'label' => 'Repeatable',
                'name' => 'Slider Fields',
                'desc'  => '',
                'id'    => $prefix.'repeatable',
                'type'  => 'repeatable'
            )
        )
    ),
    array(
        'id' => 'post_format_link',
        'title' => __('Link', 'tkingdom'),
        'pages' => array('post'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Link Text', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'link_text',
                'type' => 'text',
                'std' => ''
            ),
            array(
                'name' => __('Link Url', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'link_url',
                'type' => 'text',
                'std' => ''
            )
        )
    ),
    array(
        'id' => 'post_format_quote',
        'title' => __('Quote Text', 'tkingdom'),
        'pages' => array('post'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Quote Text', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'quote',
                'type' => 'text',
                'std' => ''
            ),
            array(
                'name' => __('Quote Author', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'quote_author',
                'type' => 'text',
                'std' => ''
            )
        )
    ),
    array(
        'id' => 'post_format_video',
        'title' => __('Video Link', 'tkingdom'),
        'pages' => array('post', 'gallery', 'services', 'events'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Video Link', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'video_link',
                'type' => 'text',
                'std' => ''
            )
        )
    ),
    array(
        'id' => 'post_format_audio',
        'title' => __('Audio Options', 'tkingdom'),
        'pages' => array('post'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Audio Link', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'audio_link',
                'type' => 'text',
                'std' => ''
            ),
        )
    ),
    /***************** end post formats ***********************/

);

?>