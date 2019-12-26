<?php
/*
 *  Author: Grant Imbo
 *  URL: grantimbo.com
 *  Site functions for grantimbo.com
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/






if (function_exists('add_theme_support')) {
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('portfolio-thumb', 300, 188, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

}



/*------------------------------------*\
	Functions
\*------------------------------------*/


// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function custom_wp_nav_menu($args) {
    return is_array($args) ? array_intersect($args, array(
        // List of useful classes to keep
        'current_page_item',
        'current_page_parent',
        'current_page_ancestor',
        'typebg',
        'motionbg',
        'webbg',
        'visualbg',
        'expbg'
        )
    ) : '';
}

function my_async_scripts( $tag, $handle, $src ) {
    // the handles of the enqueued scripts we want to async
    $async_scripts = array( 'hammer', 'ajax-load-more');
    $defer_scripts = array( 'grantimboscripts' );

    if ( in_array( $handle, $async_scripts ) ) {
        return '<script type="text/javascript" src="' . $src . '" async ></script>' . "\n";
    } else if ( in_array( $handle, $defer_scripts ) ) {
       return '<script type="text/javascript" src="' . $src . '" defer ></script>' . "\n";
    }

    return $tag;
}
add_filter( 'script_loader_tag', 'my_async_scripts', 10, 3 );


// Load HTML5 Blank scripts (header.php)
function grantimbo_header_scripts() {
    if (!is_admin()) {

    	wp_deregister_script('jquery'); // Deregister WordPress jQuery
    	wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), '3.3.1'); // Google CDN jQuery
    	wp_enqueue_script('jquery'); // Enqueue it!

        wp_register_script('conditionizr', '//cdnjs.cloudflare.com/ajax/libs/conditionizr.js/4.0.0/conditionizr.js', array(), '4.0.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('modernizr', '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('grantimboscripts', get_template_directory_uri() . '/scripts.js', array(), '1.1'); // Site Functionalities
        wp_enqueue_script('grantimboscripts'); // Enqueue it!

    }


}


// Load HTML5 Blank conditional scripts
function grantimbo_conditional_scripts() {
    // if (is_page('pagenamehere')) {
    //     wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
    //     wp_enqueue_script('scriptname'); // Enqueue it!
    // }
}

// Load HTML5 Blank styles
function grantimbo_styles() {
    wp_register_style('normalize', '//cdnjs.cloudflare.com/ajax/libs/normalize/2.1.3/normalize.min.css', array(), '2.1.3', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('grantimbo', get_template_directory_uri() . '/style.css', array(), '1.3', 'all');
    wp_enqueue_style('grantimbo'); // Enqueue it!

}

// Register HTML5 Blank Navigation
function register_menus() {
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'grantimbo'), // Sidebar Navigation
        'footer-menu' => __('Footer Menu', 'grantimbo'), // Sidebar Navigation
        'terms-privacy-menu' => __('Terms & Privacy Menu', 'grantimbo'), // Sidebar Navigation
    ));
}

// HTML5 Blank navigation
function head_nav() {
    wp_nav_menu( 
        array(
           'items_wrap' => '<nav class="nav clear active"><ul>%3$s</ul></nav>',
           'theme_location' => 'header-menu',
           )
        );
}

function footer_nav() {
    wp_nav_menu( 
        array(
           // 'items_wrap' => '<nav class="nav clear">%3$s</nav>',
           'theme_location' => 'footer-menu',
           )
        );
}

function terms_privacy_nav() {
    wp_nav_menu( 
        array(
           // 'items_wrap' => '<nav class="nav clear">%3$s</nav>',
           'theme_location' => 'terms-privacy-menu',
           )
        );
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '') {
    $args['container'] = false;
    return $args;
}


// REPLACE "current_page_" WITH CLASS "active"
function current_to_active($text) {
    $replace = array(
        // List of classes to replace with "active"
        'current_page_item' => 'active',
        'current_page_parent' => 'active',
        'current_page_ancestor' => 'active',
    );
    $text = str_replace(array_keys($replace), $replace, $text);
        return $text;
}


// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist) {
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes) {
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar')) {

    // Sidebar Widgets
    register_sidebar(array(
        'name' => __('Sidebar', 'grantimbo'),
        'description' => __('Contents for the Sidebar', 'grantimbo'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="sidebar-men" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function grantimbo_pagination() {
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}



function wpse_allowedtags() {
    // Add custom tags to this string
        return '<script>,<style>,<br>,<em>,<i>,<ul>,<ol>,<li>,<a>,<p>,<img>,<video>,<audio>'; 
    }

if ( ! function_exists( 'wpse_custom_wp_trim_excerpt' ) ) : 

    function wpse_custom_wp_trim_excerpt($wpse_excerpt) {
    global $post;
    $raw_excerpt = $wpse_excerpt;
        if ( '' == $wpse_excerpt ) {

            $wpse_excerpt = get_the_content('');
            $wpse_excerpt = strip_shortcodes( $wpse_excerpt );
            $wpse_excerpt = apply_filters('the_content', $wpse_excerpt);
            $wpse_excerpt = str_replace(']]>', ']]&gt;', $wpse_excerpt);
            $wpse_excerpt = strip_tags($wpse_excerpt, wpse_allowedtags()); /*IF you need to allow just certain tags. Delete if all tags are allowed */

            //Set the excerpt word count and only break after sentence is complete.
                $excerpt_word_count = 75;
                $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count); 
                $tokens = array();
                $excerptOutput = '';
                $count = 0;

                // Divide the string into tokens; HTML tags, or words, followed by any whitespace
                preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $wpse_excerpt, $tokens);

                foreach ($tokens[0] as $token) { 

                    if ($count >= $excerpt_word_count && preg_match('/[\,\;\?\.\!]\s*$/uS', $token)) { 
                    // Limit reached, continue until , ; ? . or ! occur at the end
                        $excerptOutput .= trim($token);
                        break;
                    }

                    // Add words to complete sentence
                    $count++;

                    // Append what's left of the token
                    $excerptOutput .= $token;
                }

            $wpse_excerpt = trim(force_balance_tags($excerptOutput));

                $excerpt_end = ' <a class="view-article" href="'. esc_url( get_permalink() ) . '">' . sprintf(__( 'Read More', 'grantimbo' ), get_the_title()) . '</a>'; 
                $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end); 

                //$pos = strrpos($wpse_excerpt, '</');
                //if ($pos !== false)
                // Inside last HTML tag
                //$wpse_excerpt = substr_replace($wpse_excerpt, $excerpt_end, $pos, 0); /* Add read more next to last word */
                //else
                // After the content
                $wpse_excerpt .= $excerpt_end; /*Add read more in new paragraph */

            return $wpse_excerpt;   

        }
        return apply_filters('wpse_custom_wp_trim_excerpt', $wpse_excerpt, $raw_excerpt);
    }

endif; 


// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag) {
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}


// suppress_filters for custom post types
function namespace_add_custom_types( $query ) {
  if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'portfolio', 'nav_menu_item'
        ));
      return $query;
    }
}


// change the login form
function custom_login_css() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/login/login-styles.css" />';
}


// change logo link on login form
function custom_login_header_url($url) {
    return 'http://northwoodsauna.com/';
}


// remove wp-admin menus
function remove_menus() {
    if ( current_user_can('administrator') ) {
        remove_menu_page( 'tools.php' );                                //Tools
		remove_menu_page( 'edit-comments.php' );                        //Comments
		remove_menu_page( 'edit.php' );                        //Comments
    }
}



// remove wordpress logo
function activated_adminbar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('customize');
	$wp_admin_bar->remove_menu('customize-background');
	$wp_admin_bar->remove_menu('customize-header');
}


// add the menu in dashboard
function activated_dashboard_widget() {
    wp_add_dashboard_widget(
             'activated_dashboard_widget',              // Widget slug.
             'Quick Shortcuts',                         // Title.
             'activated_get_menu'                       // Callback function.
        );  
}


// callback function for menu
function activated_get_menu() {
    
    ?> <!-- html start -->

    <style>
        .btn-custom-setting {
            background: #4d853c;
            color: #FFFFFF;
            font-size: 16px;
            padding: 12px 20px;
            border-radius: 3px;
            display: block;
            text-decoration: none;
        }
        .btn-custom-setting:hover {
            background: #6a9c5a;
            color: #c9e2c1;
        }
            
    </style>

    <div class="grntx-wrap clear">
        <a href="edit.php?post_type=products" class="btn-custom-setting">Products</a>
    </div>

    <?php //-- html end -->

}


/*------------------------------------*\
    Custom Post Types
\*------------------------------------*/
// Products Post Type
add_action('init', 'products_posttype');
function products_posttype() {
    register_post_type('products', 
        array(
        'labels' => array(
            'name' => __('Products', 'products'),
            'singular_name' => __('Product', 'products'),
            'add_new' => __('Add New', 'products'),
            'add_new_item' => __('Add New Product', 'products'),
            'edit' => __('Edit Product', 'products'),
            'edit_item' => __('Edit Product', 'products'),
            'new_item' => __('New Product', 'products'),
            'view' => __('View Product', 'products'),
            'view_item' => __('View Product', 'products'),
            'search_items' => __('Search Products', 'products'),
            'not_found' => __('No Products found', 'products'),
            'not_found_in_trash' => __('No Products found in Trash', 'products')
        ),
        'public' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'has_archive' => true,
        "rewrite" => array( "slug" => "products", "with_front" => false ),
        'menu_icon' => 'dashicons-format-chat',
        'show_in_rest' => true,
        'supports' => array(
            'title',
        ),
        'can_export' => false
    ));
}

/*------------------------------------*\
    Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'grantimbo_header_scripts'); // Add Custom Scripts to wp_head
add_action('init', 'register_menus'); // Add HTML5 Blank Menu
add_action('init', 'grantimbo_pagination'); // Add our HTML5 Pagination
add_action('wp_print_scripts', 'grantimbo_conditional_scripts'); // Add Conditional Page Scripts
add_action('wp_enqueue_scripts', 'grantimbo_styles'); // Add Theme Stylesheet
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('login_head', 'custom_login_css');
add_action( 'admin_init', 'remove_menus' );
add_action( 'wp_before_admin_bar_render', 'activated_adminbar' );
add_action( 'wp_dashboard_setup', 'activated_dashboard_widget' );

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);


// Remove Filters
remove_filter('get_the_excerpt', 'wp_trim_excerpt');


// Add Filters
add_filter('get_the_excerpt', 'wpse_custom_wp_trim_excerpt'); 
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
add_filter ('wp_nav_menu','current_to_active');
add_filter('nav_menu_css_class', 'custom_wp_nav_menu'); // Remove Navigation <li> injected classes (Commented out by default)
add_filter('nav_menu_item_id', 'custom_wp_nav_menu'); // Remove Navigation <li> injected ID (Commented out by default)
add_filter('page_css_class', 'custom_wp_nav_menu'); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
add_filter( 'login_headerurl', 'custom_login_header_url' );
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );

// Remove Filters
// remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [fullwidth] Here's the page title! [/fullwidth] [/html5_shortcode_demo]


