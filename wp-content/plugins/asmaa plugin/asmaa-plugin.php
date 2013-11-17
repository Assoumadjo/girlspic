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

// rester ds le meme directory
define(PLUGIN_PATH, plugin_dir_path( __FILE__ ));
//
//require_once(''.constant("PLUGIN_PATH").'add_project.php');
add_action( 'init', 'create_post_type' );

//Creation des posts 
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

		//shortcode
		add_shortcode('asmaatest', 'formulaire_projet');
		
}
//Formulaire
/*
function formulaire_projet()
{
	echo "J teste si l titre va passer";
	echo '<form action="wp-content/plugins/asmaa%20plugin/add_project.php" method="post"><input type="text" name="projet_title" id="projet_title" Placeholder="titre" /><br>
	<input type="submit" value="Ajouter" /></form>';
	$post = array(
			'post_title' => "test_asmaaao",
			'post_content' => "hello",
			'post_status' => 'publish',			// Choose: publish, preview, future, etc.
			'post_type' => 'wp_projects',
			  // Use a custom post type if you want to
		);
		$the_post_id=wp_insert_post($post);  // http://codex.wordpress.org/Function_Reference/wp_insert_post
		add_post_meta($the_post_id,'etat','yes');
		
	
	
}
*/

function formulaire_projet()
{
	echo "Formulaire Projet";
	?>
	<form id="projet" name="projetForm" method="post" action="">
 
			<p><label for="title">Titre Projet</label><br />
			 
			<input type="text" id="title" value="" tabindex="1" size="20" name="title" />
			 
			</p>
	 
			<p><label for="description">Description du projet</label><br />
			 
			<textarea id="description" tabindex="3" name="description" cols="50" rows="6"></textarea>
			 
			</p>

			<p><label for="meta">Etat</label><br />
			 
			<input type="text" id="etat" value="" tabindex="1" size="20" name="etat" />
			 
			</p>
	
			<p align="right"><input type="submit" value="Publish" tabindex="6" id="submit" name="submit" /></p>
			 
			<input type="hidden" name="post-type" id="post-type" value="wp_projects" />
			 
			<input type="hidden" name="action" value="wp_projects" />
	 
			<?php wp_nonce_field( 'name_of_my_action','name_of_nonce_field' ); ?>
	 
	</form>
	<?php

		if($_POST){
			ty_save_post_data();
		}
}

function ty_save_post_data() {

	if ( empty($_POST) || !wp_verify_nonce($_POST['name_of_nonce_field'],'name_of_my_action') )
	{
	   print 'Sorry, your nonce did not verify.';
	   exit;

	}else{ 
 
		// Do some minor form validation to make sure there is content
		if (isset ($_POST['title'])) {
			$title =  $_POST['title'];
		} else {
			echo 'Please enter a title';
			exit;
		}
		if (isset ($_POST['description'])) {
			$description = $_POST['description'];
		} else {
			echo 'Please enter the content';
			exit;
		}
		if (isset ($_POST['etat'])) {
			$etat = $_POST['etat'];
		} else {
			echo 'Please enter the etat';
			exit;
		}
		
		
	 
		// Add the content of the form to $post as an array
		$post = array(
			'post_title' => wp_strip_all_tags( $title ),
			'post_content' => $description,
			 'description' => $description,
			
			'post_status' => 'publish',			// Choose: publish, preview, future, etc.
			'post_type' => $_POST['post-type']  // Use a custom post type if you want to
		);

		$the_post_id=wp_insert_post($post);  // http://codex.wordpress.org/Function_Reference/wp_insert_post
		add_post_meta($the_post_id,'etat',$etat);
		
		//$location = home_url(); // redirect location, should be login page 

       // echo "<meta http-equiv='refresh' content='0;url=$location' />"; exit;
	} // end IF
	 
}





/*
function add_project()
{
	echo "hello";
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
*/
?>