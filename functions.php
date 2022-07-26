<?php

function theme_supports()
{
	add_theme_support('title-tag');
	add_theme_support('editor-color-palette');
	add_theme_support('custom-logo');
	add_theme_support('widgets');
	add_theme_support('post-thumbnails');
	add_theme_support('menus');
	register_nav_menu('header', 'En tête du menu');
}

function blank_theme_register_assets()
{
	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_script('script', get_template_directory_uri() . '/js/main.js', array(), false, true);
}

function blank_theme_title_separator()
{
	return '|';
}

function blank_theme_document_title_parts($title)
{
	unset($title['tagline']);
	return $title;
}

function blank_theme_custom_new_menu()
{
	register_nav_menu('blank_theme-custom-menu', __('blank_theme Menu'));
}

function blank_theme_footer_menu()
{
	register_nav_menu('footer-menu', __('Footer Menu'));
}

function blank_theme_custom_post_type()
{

	$labels = array(
		'name'                => _x('Custom Post', 'Post Type General Name'),
		'singular_name'       => _x('Custom Post', 'Post Type Singular Name'),
		'menu_name'           => __('Custom Post'),
		'all_items'           => __('Tous les Custom Post'),
		'view_item'           => __('Voir les Custom Post'),
		'add_new_item'        => __('Ajouter un Custom Post'),
		'add_new'             => __('Ajouter'),
		'edit_item'           => __('Editer le Custom Post'),
		'update_item'         => __('Modifier le Custom Post'),
		'search_items'        => __('Rechercher un Custom Post'),
		'not_found'           => __('Non trouvé'),
		'not_found_in_trash'  => __('Non trouvé dans la corbeille'),
	);

	$args = array(
		'label'               => __('Custom Post'),
		'description'         => __('Tous sur les Custom Post'),
		'labels'              => $labels,
		'taxonomies' 		  => array('category', 'post_tag'),
		'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
		'menu_position' => 4,
		'show_in_rest' => true,
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => true,

	);

	register_post_type('custom_post', $args);
}

$args = array(
	'post_type' => 'custom_post',
	'posts_per_page' => 10,
	'paged' => $paged
);
$loop = new WP_Query($args);


add_action('init', 'blank_theme_custom_new_menu');
add_action('init', 'blank_theme_footer_menu');
add_action('init', 'blank_theme_custom_post_type', 0);
add_action('after_setup_theme', 'theme_supports');
add_action('wp_enqueue_scripts', 'blank_theme_register_assets');
add_filter('document_title_separator', 'blank_theme_title_separator');
add_filter('document_title_parts', 'blank_theme_document_title_parts');
