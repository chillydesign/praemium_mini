<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width)) {
    $content_width = 900;
}

if (function_exists('add_theme_support')) {
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/



function chilly_nav($menu) {

    wp_nav_menu(
        array(
            'theme_location'  => $menu,
            'menu'            => '',
            'container'       => 'div',
            'container_class' => 'menu-{menu slug}-container',
            'container_id'    => '',
            'menu_class'      => 'menu',
            'menu_id'         => '',
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '%3$s',
            'depth'           => 0,
            'walker'          => ''
        )
    );
}


// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts() {
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        // wp_deregister_script('jquery');


        // wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        // wp_enqueue_script('modernizr'); // Enqueue it!




    }
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts() {
    if (is_page('pagenamehere')) {
        // wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        // wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

function wf_version() {
    return '2.0.6';
}

function is_tattes() {
    $s = $_SERVER['SERVER_NAME'];
    return ($s == 'tattes.ch');
}

// Load HTML5 Blank styles
function html5blank_styles() {
    wp_register_style('reset', get_template_directory_uri() . '/css/reset.css', array(), '1.0', 'all');
    wp_enqueue_style('reset'); // Enqueue it!

    wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array(), wf_version(), 'all');
    wp_enqueue_style('html5blank'); // Enqueue it!

    // wp_register_style('unslider', get_template_directory_uri() . '/css/unslider.css', array(), '1.0', 'all');
    // wp_enqueue_style('unslider'); // Enqueue it!

    // wp_register_style('featherlight', get_template_directory_uri() . '/css/featherlight.min.css', array(), '1.0', 'all');
    // wp_enqueue_style('featherlight'); // Enqueue it!


}

// Register HTML5 Blank Navigation
function register_html5_menu() {
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'html5blank') // Main Navigation

    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '') {
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var) {
    return is_array($var) ? array() : '';
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


    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Sidebar', 'html5blank'),
        'description' => __('Sidebar', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
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
function html5wp_pagination() {
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 40;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length) {
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '') {
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more) {
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Page', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar() {
    # return FALSE;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag) {
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions($html) {
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar($avatar_defaults) {
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments() {
    if (!is_admin()) {
        if (is_singular() and comments_open() and (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ('div' == $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">

        <div class="row comment-body">

            <div class="col-sm-2 comment-author vcard">
                <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, 100); ?>
            </div>
            <?php if ($comment->comment_approved == '0') : ?>
                <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
                <br />
            <?php endif; ?>

            <div class="col-sm-10 comment-meta commentmetadata">
                <?php echo get_comment_author_link() ?> on <?php
                                                            printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'), '  ', '');
                                                                                                                                        ?>

                <?php comment_text() ?>

                <div class="reply">
                    <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>
            </div>


        <?php }

    /*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

    // Add Actions
    add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
    add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
    add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
    add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
    add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu

    add_action('init', 'create_post_type_slide'); // Add our Slide Type

    add_action('admin_menu', 'remove_menus');



    add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
    add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

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
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'rel_canonical');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

    // Add Filters
    add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
    add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
    add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
    add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
    add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
    // add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
    // add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
    // add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
    add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
    add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
    add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
    add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
    // add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
    add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
    add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
    add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

    // Remove Filters
    remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether



    /*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

    // Create 1 Custom Post type for a Demo, called HTML5-Blank
    function create_post_type_slide() {

        register_post_type(
            'slide', // Register Custom Post Type
            array(
                'labels' => array(
                    'name' => __('Slide', 'html5blank'), // Rename these to suit
                    'singular_name' => __('Slide', 'html5blank'),
                    'add_new' => __('Add New', 'html5blank'),
                    'add_new_item' => __('Add New Slide', 'html5blank'),
                    'edit' => __('Edit', 'html5blank'),
                    'edit_item' => __('Edit Slide', 'html5blank'),
                    'new_item' => __('New Slide', 'html5blank'),
                    'view' => __('View Slide', 'html5blank'),
                    'view_item' => __('View Slide', 'html5blank'),
                    'search_items' => __('Search Slides', 'html5blank'),
                    'not_found' => __('No Slides found', 'html5blank'),
                    'not_found_in_trash' => __('No Slides found in Trash', 'html5blank')
                ),
                'public' => true,
                'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
                'has_archive' => true,
                'supports' => array(
                    'title',
                    'thumbnail'
                ), // Go to Dashboard Custom HTML5 Blank post for supports
                'can_export' => true, // Allows export in Tools > Export
                'taxonomies' => array() // Add Category and Post Tags support
            )
        );
    }





    function disable_wp_emojicons() {

        // all actions related to emojis
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');

        // filter to remove TinyMCE emojis
        //add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
    }
    add_action('init', 'disable_wp_emojicons');
    function remove_json_api() {

        // Remove the REST API lines from the HTML Header
        remove_action('wp_head', 'rest_output_link_wp_head', 10);
        remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
        // Remove the REST API endpoint.
        remove_action('rest_api_init', 'wp_oembed_register_route');
        // Turn off oEmbed auto discovery.
        add_filter('embed_oembed_discover', '__return_false');
        // Don't filter oEmbed results.
        remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
        // Remove oEmbed discovery links.
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        // Remove oEmbed-specific JavaScript from the front-end and back-end.
        remove_action('wp_head', 'wp_oembed_add_host_js');
        // Remove all embeds rewrite rules.
        // add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );

    }
    //add_action( 'after_setup_theme', 'remove_json_api' );




    function remove_menus() {
        //  remove_menu_page( 'edit.php' );     //Posts
        //  remove_menu_page( 'edit-comments.php' );     //COMMENTS


    }



    // ONLY SHOW PAGE AND POST IN SEARCH RESULTS
    add_filter('pre_get_posts', 'search_filter');
    function search_filter($query) {
        if ($query->is_search) {
            $query->set('post_type', array('page', 'post'));
        }
        return $query;
    }










    function chilly_map($atts, $content = null) {

        $attributes = shortcode_atts(array(
            'location' => "Chemin de Pra 1993, Veysonnaz, Suisse"
        ), $atts);



        $address = $attributes['location'];
        $chilly_map = '<div id="mapcontainer"></div>';
        $chilly_map .= "<script> var address = '"  . $address  .   "';</script>";
        return $chilly_map;
    }
    add_shortcode('chilly_map', 'chilly_map');



    // include_once('functions_upload_news.php');

    include('functions_praemium.php');


    // if (function_exists('acf_add_options_page')) {
    //     acf_add_options_page(array(
    //         'page_title'     => 'Options Page',
    //         'menu_title'    => 'Options Page',
    //         'menu_slug'     => 'options_page',
    //         'capability'    => 'edit_posts',
    //         'redirect'        => false
    //     ));
    // }


        ?>