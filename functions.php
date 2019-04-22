<?php

    // Include Bootstrap Class NavWalker
    require_once('wp-bootstrap-navwalker.php');

    // Add Featured Image Support
    add_theme_support('post-thumbnails');



    /*
        *** function to add my custom style
        *** wp_enqueue_style();
        *** get_template_directory_uri();
    */
    function mocca_styles_files() {
 
        wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css');
        wp_enqueue_style('fontawesome-css', get_template_directory_uri() . '/css/fontawesome-all.min.css');
        wp_enqueue_style('normalize-css', get_template_directory_uri() . '/css/normalize.css');
        wp_enqueue_style('main-css', get_template_directory_uri() . '/css/main.css');
    }

    /*
        *** function to add my custom js script
        *** wp_enqueue_script();
        *** get_template_directory_uri();
    */
    function mocca_script_files() {

        wp_deregister_script('jquery'); // Remove Registeration Old JQuery
        wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), false, '', true); // Register a New JQuery in Footer
        wp_enqueue_script('jquery'); // Enqueue New JQuery
        wp_enqueue_script('popper-js', get_template_directory_uri() . '/js/popper.min.js', array(), false, true);
        wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), false, true);
    }

    /*
        *** function to add my custom Menu
        *** register_nav_menut();
    */
    function mocca_custom_menu() {

        register_nav_menus(array(
            'bootstrap-menu'   => 'Navigtion Bar',
            'footer-menu'      => 'footer Bar',
        ));
    }

    /*
        *** function to add Bootstrap Menu
        *** wp_nav_menu();
    */
    function mocca_bootstrap_menu() {

        wp_nav_menu(array(
            'theme_location'    => 'bootstrap-menu',
            'menu_class'        => 'navbar-nav ml-auto',
            'container'         => false,
            'depth'             => 2,
            'walker'            => new wp_bootstrap_navwalker(),
        ));
    }

     /*
        *** function Excerpt Langht
    */
    function mocca_post_langht($length) {
        if(is_author()) {
            return 30;
        } elseif(is_category()){
            return 10;
        } else {
            return 15;
        }
    }

    /*
        *** function To Change [...]
    */
    function mocca_post_langht_more($more) {
        return ' ........';
    }

    /*
        *** function To Number Pagination
    */
    function mocca_Pagination_number() {
        global $wp_query; // Make [$wp_query] Globale
        $all_pages = $wp_query->max_num_pages; // Get All Posts
        $current_pages = max(1, get_query_var('paged')); //Get Current Page

        if($all_pages > 1) { // Check If Total Page >1
            return paginate_links(array(
                'base'      => get_pagenum_link() . '%_%',
                'format'    => 'page/%#%',
                'current'   => $current_pages,

            ));
        }
    }
    /*
        *** function To Register Sidebar
    */
    function mocca_main_sidebar() {
        register_sidebar(array(
            'name'          => 'Mocca Sidebar',
            'id'            => 'mocca-sidebar', 
            'description'   => 'Wordpress Apper SideBar',
            'class'         => 'sidebar-wordpress',
            'before_widget' => '<div class="widget-content">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>'
        ));
    }
    function mocca_main_sidebar2() {
        register_sidebar(array(
            'name'          => 'Mocca Sidebar2',
            'id'            => 'mocca-sidebar2', 
            'description'   => 'Wordpress Apper SideBar IN Category HTML Test Default SideBar',
            'class'         => 'sidebar-wordpress',
            'before_widget' => '<div class="widget-content">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>'
        ));
    }




    /*
        *** Add MY All Action
        *** add_action();
    */
    // Add Css Style
    add_action('wp_enqueue_scripts', 'mocca_styles_files');
    // Add JS Script
    add_action('wp_enqueue_scripts', 'mocca_script_files');
    // Add custom Menu
    add_action('init', 'mocca_custom_menu'); 
    // Register Sidebar
    add_action('widgets_init', 'mocca_main_sidebar');
    // Register Sidebar
    add_action('widgets_init', 'mocca_main_sidebar2');
    /*
        *** Add MY All Filter
        *** add_filter();
    */
    // Add Excerpt Langht
    add_filter('excerpt_length', 'mocca_post_langht');
    // Add To moore [...]
    add_filter('excerpt_more', 'mocca_post_langht_more');

    /*
        *** function To Count Comment In Category Post
    */
    function mocca_count_comment($cat_name_posts_count) {
        $comment_arg = array(
            'status' => 'approve'
        );
        $comment_count = 0;

        $all_comment = get_comments($comment_arg);

        foreach ($all_comment as $comment) {
            $post_id = $comment->comment_post_ID;
            if(! in_category($cat_name_posts_count, $post_id)) {
                continue;
            }
            $comment_count++;
        }
        echo $comment_count;
    }
    

?>