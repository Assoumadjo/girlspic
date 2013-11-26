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
				'thumbnail',
				'author',
				//'trackbacks',
				//'custom-fields',
				//'comments',
				'revisions',
				//'page-attributes', // (menu order, hierarchical must be true to show Parent option)
				//'post-formats',
			),
			//'taxonomies' => array( 'category', 'post_tag' ), // add default post categories and tags
			'menu_position' => 5,
		//	'register_meta_box_cb' => 'projet_add_post_type_metabox'
		)
	);
/*
//Taxonomy pour les tags et les categories
*/
register_taxonomy( 'project_category', // register custom taxonomy - quote category
			'wp_projects',
			array( 'hierarchical' => true,
				'label' => __( 'Categories des projets' )
			)
		);
		register_taxonomy( 'project_tag', // register custom taxonomy - quote tag
			'wp_projects',
			array( 'hierarchical' => false,
				'label' => __( 'Projects tags' )
			)
		);

		//shortcode
		add_shortcode('asmaatest', 'formulaire_projet');
		
}

function formulaire_projet()
{
	echo "Formulaire Projet";
	?>
	<div class="entry-content">
	<form id="projet" name="projetForm" method="post" action="" enctype="multipart/form-data">
		 <h3 class="atcf-submit-section campaign_heading">Postez votre Projet maintenant </h3>
			<p class="atcf-submit-campaign-title">
			<p><label for="title">Titre Projet</label><br />
			 
			<input type="text" id="title" value="" tabindex="1" size="20" name="title" />
			 
			</p>

			<!--<p><label for="categorie">Categorie</label><br />
			
			<p><?php wp_dropdown_categories('show_option_none=Select categorie&tab_index=4&taxonomy=Categories' ); ?></p> -->
	 
			<p><label for="description">Description du projet</label><br />
			 
			<textarea id="description" tabindex="3" name="description" cols="50" rows="6"></textarea>
			 
			</p>

			<p><label for="meta">Etat</label><br />
			 
			<input type="text" id="etat" value="" tabindex="1" size="20" name="etat" />
			<br>
			
			 

			 <p><label for="thumbnail">Photo</label><br />
			 
			<input type="file" id="thumbnail" value="" tabindex="1" size="20" name="thumbnail" />
			
			<p><label for="video">URL Video</label><br />
			 
			<input type="text" id="video" value="" tabindex="1" size="20" name="video" />

			<p><label for="attach">Pieces jointes</label><br /> 
			 
			<input type="file" id="attach" value="" tabindex="1" size="20" name="attach" /> 
			
			<p><label for="certif">N Certification</label><br />
			 
			<input type="text" id="certif" value="" tabindex="1" size="20" name="certif" />
			
			<p><label for="nbr">Nombre de membres</label><br />
			 
			<input type="text" id="nbr" value="" tabindex="1" size="20" name="nbr" />
			
			<p><label for="noms">Noms des membres</label><br />
			 
			<input type="text" id="noms" value="" tabindex="1" size="20" name="noms" /> 
			 
			</p> 			 
			<p align="right"><input type="submit" value="Envoyer" tabindex="6" id="submit" name="submit" /></p>

			</p>
	
	

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

			echo 'Entrez un titre';
			exit;
		}
		/*if (isset ($_POST['categorie'])) {
			$title =  $_POST['categorie'];
		} else {
			echo 'Choisissez une catégorie';

			

			exit;
		}*/
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
		if (isset ($_FILES['thumbnail'])) {
			$file = $_FILES['thumbnail'];
		} else {
			echo 'Photo manquante';
			exit;
			}
	if (isset ($_POST['video'])) {
			$video = $_POST['video'];
		} else {
			echo 'Donnez un URL de video';
			exit;
		}
		if (isset ($_FILES['attach'])) {
			$attach = $_FILES['attach'];
		} else {
			echo 'fichier manquant';
		exit;
		}
		
		if (isset ($_POST['certif'])) {
			$certif = $_POST['certif'];
		} else {
			echo 'Donnez un numero de certification';
			exit;
		}
		if (isset ($_POST['nbr'])) {
			$nbr = $_POST['nbr'];
		} else {
			echo 'Donnez le nombre de participants';
			exit;
		}
		if (isset ($_POST['noms'])) {
			$noms = $_POST['noms'];
		} else {
			echo 'Donnez les noms de participants';
			exit;
		}
		


		}
	
		
		

	 
		// Add the content of the form to $post as an array
		$post = array(
			'post_title' => wp_strip_all_tags( $title ),
			'post_content' => $description,
			'description' => $description,
			'post_status' => 'publish',			// Choose: publish, preview, future, etc.
			'post_type' => 'wp_projects' // Use a custom post type if you want to
		);
		


		$the_post_id=wp_insert_post($post);  // http://codex.wordpress.org/Function_Reference/wp_insert_post

		if ($_FILES) {
		foreach ($_FILES as $file => $array) {
			
	   $newupload = insert_attachment($file,$the_post_id);
	  }
}

	
            
		
		add_post_meta($the_post_id,'categorie',$categorie);
		add_post_meta($the_post_id,'etat',$etat);
		add_post_meta($the_post_id,'video',$video);
		add_post_meta($the_post_id,'certif',$certif);
		add_post_meta($the_post_id,'nbr',$nbr);
		add_post_meta($the_post_id,'noms',$noms);

	

		
		//$location = home_url(); // redirect location, should be login page 

       // echo "<meta http-equiv='refresh' content='0;url=$location' />"; exit;
	}
	 // end IF
	 



function insert_attachment($file_handler,$post_id,$setthumb='false') {
	    // check to make sure its a successful upload
	    if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();
	 
	    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	    require_once(ABSPATH . "wp-admin" . '/includes/media.php');
	 
	    $attach_id = media_handle_upload( $file_handler, $post_id );
	    echo $file_handler;
	 	if ($setthumb && $file_handler=="thumbnail") update_post_meta($post_id,'_thumbnail_id',$attach_id);
	    return $attach_id;
	}




?>