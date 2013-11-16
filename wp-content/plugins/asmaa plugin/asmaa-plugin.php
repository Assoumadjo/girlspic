<?php
/**
 * Plugin Name: Asmaa Test
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Just an example to test Costum post type
 * Version: The Plugin's Version Number, e.g.: 1.0
 * Author: Asmaa
 * Author URI: http://URI_Of_The_Plugin_Author
 * License: blbalab
 */
add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'wp_projects',
		array(
			'labels' => array(
				'name' => __( 'Projets' ),
				'singular_name' => __( 'Projet' ),
				'add_new' => __( 'Ajouter un projet' ),
				'all_items' => __( 'Tous les projets' ),
				'add_new_item' => __( 'Ajouter un projet' ),
				'edit_item' => __( 'Modifier projet' ),
				'new_item' => __( 'Nouveau projet' ),
				'view_item' => __( 'Voir projet' ),
				'search_items' => __( 'Recherche projets' ),
				'not_found' => __( 'makayench :D' ),
				'not_found_in_trash' => __( 'No project found in trash' )
				//'menu_name' => default to 'name'
			),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'projets'),
			'publicly_queryable' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				//'author',
				//'trackbacks',
				//'custom-fields',
				//'comments',
				'revisions',
				//'page-attributes', // (menu order, hierarchical must be true to show Parent option)
				//'post-formats',
			),
			'taxonomies' => array( 'category', 'post_tag' ), // add default post categories and tags
			'menu_position' => 5,
			'register_meta_box_cb' => 'projet_add_post_type_metabox'
		)
	);
//Taxonomy pour les tags et les categories
register_taxonomy( 'project_category', // register custom taxonomy - quote category
			'projet',
			array( 'hierarchical' => true,
				'label' => __( 'Categories des projets' )
			)
		);
		register_taxonomy( 'project_tag', // register custom taxonomy - quote tag
			'projet',
			array( 'hierarchical' => false,
				'label' => __( 'Projects tags' )
			)
		);
}
function projet_add_post_type_metabox() { // add the meta box
		add_meta_box( 'projet_metabox', 'Meta', 'projet_metabox', 'projet', 'normal' );
	}
 
 
	function projet_metabox() {
		global $post;
		// Noncename needed to verify where the data originated
		echo '<input type="hidden" name="quote_post_noncename" id="quote_post_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
		// Get the data if its already been entered
		$quote_post_name = get_post_meta($post->ID, '_quote_post_name', true);
		$quote_post_desc = get_post_meta($post->ID, '_quote_post_desc', true);
 
		// Echo out the field
		?>
 
		<div class="width_full p_box">
			<p>
				<label>Name<br>
					<input type="text" name="quote_post_name" class="widefat" value="<?php echo $quote_post_name; ?>">
				</label>
			</p>
			<p><label>Description<br>
					<textarea name="quote_post_desc" class="widefat"><?php echo $quote_post_desc; ?></textarea>
				</label>
			</p>
		</div>
		<?php
	}

?>