<?php

/**
 * Enqueue
 *
 * @return void
 */

// Inclusion de notre customizer
require 'inc/customizer.php';
function ocharity_enqueue()
{
    wp_enqueue_style(
        'main-style',
        get_theme_file_uri('public/css/style.css'),
        [],
        '20200528'
    );
    wp_enqueue_script(
        'app',
        get_theme_file_uri('public/js/app.js'),
        ['jquery', 'json2'],
        '20200528',
        true
    );
}
add_action('wp_enqueue_scripts', 'ocharity_enqueue');
/**
 * Setup
 */
if (!function_exists('ocharity_setup')) {
    function ocharity_setup()
    {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_post_type_support('page', 'excerpt');

        register_nav_menus([
            'main-menu' => 'menu header',
            'footer-menu' => 'menu footer',
            'footer-submenu' => 'menu subfooter',
            'menu-pays' => 'menu pays',
            'menu-theme' => 'menu thème',
            'menu-mobile' => 'menu mobile'
        ]);
    }
}
add_action('after_setup_theme', 'ocharity_setup');

/**
 * Dump
 *
 * @param [type] $var
 * @return void
 */
function dump($var)
{
    echo '<pre style="color:purple;font-size:0.8em;">';
    var_dump($var);
    echo '</pre>';
    //exit();
}
/**
 * Add Role Donator
 */
add_role(
    'donator',
    __('Donateur'),
    array(
        'read'         => true,
        'edit_users'   => true,

    )
);
/**
 * Ajout role Donator à l'inscription
 *
 * @param [type] $user_id
 * @return void
 */
function add_role_donator_to_new_user($user_id)
{
    $newUser = get_userdata($user_id);
    $newRoleName = $newUser->user_login;
    $newUser->add_role(
        $newRoleName,
        __($newRoleName),
        array(
            'read'         => true,
            'edit_users'   => true
        )
    );
}
add_action('user_register', 'add_role_donator_to_new_user', 10, 1);
/**
 * Ajouter colonnes user meta dans Admin
 *
 * @param [type] $column
 * @return void
 */
function user_columns_in_admin($column)
{
    $column['amount'] = 'Montant';
    $column['collectname'] = 'Collecte';
    return $column;
}
add_filter('manage_users_columns', 'user_columns_in_admin');

/**
 * Ajouter données user meta dans Admin
 *
 * @param [type] $val
 * @param [type] $column_name
 * @param [type] $user_id
 * @return void
 */
function user_column_data($val, $column_name, $user_id)
{
    $user = get_userdata($user_id);
    if ('user_id' == $column_name)
        return $user;
}
add_filter('manage_users_custom_column', 'user_column_data', 10, 3);

add_action('init', 'add_gallery_post_type');
function add_gallery_post_type()
{
    register_post_type(
        'galerie',
        array(
            'labels' => array(
                'name' => __('Galerie'),
                'singular_name' => __('Galerie'),
                'all_items' => __('Toutes les images')
            ),
            'public' => true,
            'has_archive' => false,
            'exclude_from_search' => true,
            'rewrite' => array('slug' => 'gallery-item'),
            'supports' => array('title', 'thumbnail'),
            'menu_position' => 4,
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'show_in_menus'         => true,
            'has_archive'           => true,
        )
    );
}

function zm_get_backend_preview_thumb($post_ID)
{
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'thumbnail');
        return $post_thumbnail_img[0];
    }
}

function zm_preview_thumb_column_head($defaults)
{
    $defaults['featured_image'] = 'Image';
    return $defaults;
}
add_filter('manage_posts_columns', 'zm_preview_thumb_column_head');

function zm_preview_thumb_column($column_name, $post_ID)
{
    if ($column_name == 'featured_image') {
        $post_featured_image = zm_get_backend_preview_thumb($post_ID);
        if ($post_featured_image) {
            echo '<img src="' . $post_featured_image . '" />';
        }
    }
}
add_action('manage_posts_custom_column', 'zm_preview_thumb_column', 10, 2);


// Fonction permettant de cacher la barre admin pour tous les utilisateurs 
//qui ne peuvent pas éditer de poste (donc tous sauf admin et editeur)
function customer_hide_admin_bar()
{
    if (!current_user_can('edit_posts')) {
        add_filter('show_admin_bar', '__return_false');
    }
}
add_action('set_current_user', 'customer_hide_admin_bar');

/**
 * Template chooser
 *
 * @param [type] $template
 * @return void
 */
function template_chooser($template)
{
    global $wp_query;
    $post_type = get_query_var('post_type');
    if ($wp_query->is_search && $post_type == 'collecte') {
        return locate_template('collectes-en-cours.php');  //  redirect to archive-search.php
    }
    return $template;
}
add_filter('template_include', 'template_chooser');

/**
 * Taxo dans les pages
 *
 * @return void
 */
function add_taxonomies_to_pages()
{
    register_taxonomy_for_object_type('post_tag', 'page');
    register_taxonomy_for_object_type('category', 'page');
}
add_action('init', 'add_taxonomies_to_pages');
/**
 * Custom Query var
 *
 * @param [type] $vars
 * @return void
 */
function add_custom_query_var($vars)
{
    $vars[] = "statut";
    $vars[] = "page_state";
    $vars[] = "login";
    return $vars;
}
add_filter('query_vars', 'add_custom_query_var');
/**
 * CSS WP Login
 *
 * @return void
 */
function login_css()
{
    wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/style.css');
}
add_action('login_enqueue_scripts', 'login_css');

/**
 * Redirect if password / username are empty
 *
 * @param [type] $login
 * @param [type] $username
 * @param [type] $password
 * @return void
 */
function check_username_password($login, $username, $password)
{

    $userlog = $_SERVER['HTTP_REFERER'];

    if (!empty($userlog) && !strstr($userlog, 'wp-login') && !strstr($userlog, 'wp-admin')) {
        if ($username == "" || $password == "") {

            $urlParam = 'empty';
            $url_redirect = esc_url(add_query_arg('login',  $urlParam, $userlog));
            wp_redirect(htmlspecialchars_decode($url_redirect));
            exit;
        }
    }
}
add_action('authenticate', 'check_username_password', 1, 3);

/**
 * Login fail
 *
 * @return void
 */
function login_failed()
{
    $userlog = $_SERVER['HTTP_REFERER'];
    if (!empty($userlog) && !strstr($userlog, 'wp-login') && !strstr($userlog, 'wp-admin')) {
        $urlParam = 'failed';
        $url_redirect = esc_url(add_query_arg('login',  $urlParam, $userlog));
        wp_redirect(htmlspecialchars_decode($url_redirect));
        exit;
    }
}
add_action('wp_login_failed', 'login_failed');



function login_form_sc()
{
    $args = array(
        'echo'           => true,
        'redirect'       => (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
        'form_id'        => 'loginform',
        'label_username' => __('Username or Email Address'),
        'label_password' => __('Password'),
        'label_remember' => __('Remember Me'),
        'label_log_in'   => __('Log In'),
        'id_username'    => 'user_login',
        'id_password'    => 'user_pass',
        'id_remember'    => 'rememberme',
        'id_submit'      => 'wp-submit',
        'remember'       => true,
        'value_username' => '',
        'value_remember' => false,
    );

    return wp_login_form($args);
}
add_shortcode('wp_login_form_sc', 'login_form_sc');
//add_action('login_failed_action', 'login_form_sc');
