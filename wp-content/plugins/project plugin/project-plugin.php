<?php
/**
 * Plugin Name: Project plugin
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Just an example to test Costum post type
 * Version: The Plugin's Version Number, e.g.: 1.0
 
 * 
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
				'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true,
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
		add_shortcode('projectform', 'formulaire_projet');
		
}

function formulaire_projet()
{
	
	?>
	<html>
	<head>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  
		 <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
		<script>
$(document).ready(function() {
	  
	   tinymce.init({selector:'textarea',
        	  menubar:false,
  			  statusbar: false,
    	 mode : "specific_textareas",
        /*plugins : "autolink, lists, spellchecker, style, layer, table, advhr, advimage, advlink, emotions, iespell, inlinepopups, insertdatetime, preview, media, searchreplace, print, contextmenu, paste, directionality, fullscreen, noneditable, visualchars, nonbreaking, xhtmlxtras, template",*/
        editor_selector :"tinymce-enabled"
    }
        	);
  });
		</script>
		<script type="text/javascript">

		function ajouter(x)
		{
			$('#membre').html('');
			for(var i=0;i<x;i++)
			{
				$('#membre').append('<p class="atcf-submit-campaign-membre"><input type="text" value="" name="nom'+i+'" /></p><br>');
			}
		}
		</script>

	</head>
	<body>
	<div class="entry-content">
	<form id="projet" name="projetForm" method="post" class="atcf-submit-campaign" action="" enctype="multipart/form-data">
		 <h3 class="atcf-submit-section campaign_heading">Postez votre Projet maintenant </h3>
			
			<p class="atcf-submit-campaign-title">
			<label for="title">Titre du Projet</label><br />
			<input type="text" id="title"  value="" placeholder="" name="title" />
			 </p>

			
		<div class="atcf-submit-campaign-description">
		<label for="description">Description du projet</label>
		<div id="wp-description-wrap" class="wp-core-ui wp-editor-wrap html-active">
		<div id="wp-description-editor-container" class="wp-editor-container">
		<textarea rows="8" cols="40" name="description" id="editor" class="tinymce-enabled required"></textarea>
		</div>
	</div>
</div>
			
			<div class="atcf-submit-campaign-category">
		<label for="category">Categories</label>

		<ul class="atcf-multi-select">			
			<?php
				$genres = get_terms('project_category', 'orderby=id&hide_empty=0');
				$counter = 0;
				foreach ($genres as $genre) {
				$counter++;
			
				$option='<li id="download_category-'.$counter.'" class="popular-category">
				<label class="selectit" >
				<input value="'.$genre->term_taxonomy_id.'" type="checkbox" name="category[]" id="'.$genre->name.'">'.$genre->name.'</label></li>';
				echo $option;
				}
			?>

	</ul>
	</div>
			
			
			<p class="atcf-submit-campaign-excerpt">
			<label for="etat">Etat</label><br />
			 
			<select id="etat" value="" name="etat" >
				<option>Pas encore financé</option>
				<option>En cours de financement</option>
				<option>Financé</option>
			</select>
			</p>
			
			 
			 <p class="atcf-submit-campaign-image">
			 <label for="thumbnail">Photo</label> 
			<input type="file" id="thumbnail"  name="thumbnail" />
			</p>

			<p class="atcf-submit-campaign-video">
			<label for="video">URL Video</label><br />
			<input type="text" id="video"   name="video" placeholder="" />
			</p>

			
			

			 <p class="atcf-submit-campaign-image">
			<label for="attach">Pieces jointes</label><br /> 
			 <input type="file" id="attach" value="" placeholder="" name="attach" /> 
			</p>


			<p class="atcf-submit-campaign-video">
			<label for="certif">N Certification</label><br />
			 <input type="text" id="certif" value="" placeholder="" name="certif" />
			</p>

			<p class="atcf-submit-campaign-length">
			<label for="nbr">Nombre de membres</label>
			<input type="number" min="0" max="5" step="1" name="nbr" id="nbr" value="0" placeholder="" onchange="ajouter(this.value)">

			</p>

			

		
			<label for="noms">Noms des membres</label>
			 <div id="membre">

			
			 </div>
			</p> 	


			<p class="atcf-submit-campaign-submit">
			<button type="submit" name="poster" value="Poster" class="button">
				Poster le projet		</button>

				<input type="hidden" name="post-type" id="post-type" value="wp_projects" />
				<input type="hidden" name="action" value="wp_projects" />
	 
					</p>
	
	

			<input type="hidden" name="post-type" id="post-type" value="wp_projects" />
			 
			<input type="hidden" name="action" value="wp_projects" />
	 
			<?php wp_nonce_field( 'name_of_my_action','name_of_nonce_field' ); ?>
	 
	</form>
</div>
</body>
</html>
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
		$nom0="";
		$nom1="";
		$nom2="";
		$nom3="";
		$nom4="";
 
		// Do some minor form validation to make sure there is content
		if (isset ($_POST['title'])) {
			$title =  $_POST['title'];
		} else {

			echo 'Entrez un titre';
			exit;
		}
		if (isset($_POST['category']) && is_array($_POST['category'])) {
		foreach($_POST['category'] as $category) 
			{
		
		$tableau=array($_POST['category']);}
	}
	else
	{
		echo "check a category";
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
		if (isset ($_POST['nom0'])) {
			$nom0 = $_POST['nom0'];
		} 
		if (isset ($_POST['nom1'])) {
			$nom1 = $_POST['nom1'];
		} 
		if (isset ($_POST['nom2'])) {
			$nom2 = $_POST['nom2'];
		} 
		if (isset ($_POST['nom3'])) {
			$nom3 = $_POST['nom3'];
		} 
		if (isset ($_POST['nom4'])) {
			$nom4 = $_POST['nom4'];
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
            
		
		wp_set_post_terms( $the_post_id, $_POST['category'],'project_category' );
		add_post_meta($the_post_id,'etat',$etat);
		add_post_meta($the_post_id,'video',$video);
		add_post_meta($the_post_id,'certif',$certif);
		add_post_meta($the_post_id,'nbr',$nbr);
		add_post_meta($the_post_id,'nom1',$nom0);
		add_post_meta($the_post_id,'nom2',$nom1);
		add_post_meta($the_post_id,'nom3',$nom2);
		add_post_meta($the_post_id,'nom4',$nom3);
		add_post_meta($the_post_id,'nom5',$nom4);
	

		
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
	 	if ($setthumb && $file_handler=="thumbnail") update_post_meta($post_id,'_thumbnail_id',$attach_id);
	    return $attach_id;
	}




?>