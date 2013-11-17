<?php

/**
 * Plugin Name: Annonce Plugin
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Create Annonce
 * Version: The Plugin's Version Number, e.g.: 1.0
 * Author: Asmaa
 * Author URI: http://URI_Of_The_Plugin_Author
 * License: blbalab
 */
// rester ds le meme directory
define(PLUGIN_PATH, plugin_dir_path( __FILE__ ));
//
//require_once(''.constant("PLUGIN_PATH").'add_project.php');
add_action( 'init', 'create_annonce' );
function create_annonce()
{
	register_post_type( 'wp_annonce',
		array(
			'labels' => array(
				'name' => __( 'Annonces' ),
				'singular_name' => __( 'Annonce' ),
				'add_new' => __( 'Ajouter une annonce' ),
				'all_items' => __( 'Tous les annonces' ),
				'add_new_item' => __( 'Ajouter une annonce' ),
				'edit_item' => __( 'Modifier annonce' ),
				'new_item' => __( 'Nouvelle annonce' ),
				'view_item' => __( 'Voir annonce' ),
				'search_items' => __( 'Recherche annonces' ),
				'not_found' => __( 'makayench :D' ),
				'not_found_in_trash' => __( 'No announce found in trash' )
				//'menu_name' => default to 'name'
			),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'annonces'),
			'publicly_queryable' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array(
				'title',
				'editor',
				//'excerpt',
				//'thumbnail',
				'author',
				//'trackbacks',
				//'custom-fields',
				//'comments',
				'revisions',
				//'page-attributes', // (menu order, hierarchical must be true to show Parent option)
				//'post-formats',
			),
			'taxonomies' => array( 'category', 'post_tag' ), // add default post categories and tags
			'menu_position' => 5,
		//	'register_meta_box_cb' => 'projet_add_post_type_metabox'
		)
	);
/*
//Taxonomy pour les tags et les categories
*/
register_taxonomy( 'annonce_category', // register custom taxonomy - quote category
			'projet',
			array( 'hierarchical' => true,
				'label' => __( 'Categories des annonces' )
			)
		);
		register_taxonomy( 'annonce_tag', // register custom taxonomy - quote tag
			'projet',
			array( 'hierarchical' => false,
				'label' => __( 'Annonces tags' )
			)
		);

		//shortcode
		//add_shortcode('asmaatest', 'formulaire_projet');
		
}

?>