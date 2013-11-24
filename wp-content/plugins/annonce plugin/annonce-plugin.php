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
				'thumbnail',
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
			'wp_annonce',
			array(
            'labels' => array(
                'name' => 'Categories des annonces',
                'add_new_item' => 'Add New announce category'
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
		
			
		);
		register_taxonomy( 'annonce_tag', // register custom taxonomy - quote tag
			'wp_annonce',
			array( 'hierarchical' => false,
				'label' => __( 'Tags des annonces' )
			)
		);

		//shortcode
		add_shortcode('annonceform', 'annonce_form');
		
}
function annonce_form()
{
	//echo " Formulaire Annonce";
	?>
	<html>
	<head>

		<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>


   <script>
   jQuery(function($){
		$.datepicker.regional['fr'] = {
			prevText: 'Précédent',
			nextText: 'Suivant',
			monthNames: ['janvier', 'février', 'mars', 'avril', 'mai', 'juin',
				'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],
			dayNamesMin: ['D','L','M','M','J','V','S'],
			dateFormat: 'dd/mm/yy',
			firstDay: 1,
			isRTL: false,
			showMonthAfterYear: false,
			yearSuffix: ''};
		$.datepicker.setDefaults($.datepicker.regional['fr']);
	});
  $(document).ready(function() {
	  $("#goal").datepicker();
	   tinymce.init({selector:'textarea',
        	  menubar:false,
  			  statusbar: false,
    	 mode : "specific_textareas",
        /*plugins : "autolink, lists, spellchecker, style, layer, table, advhr, advimage, advlink, emotions, iespell, inlinepopups, insertdatetime, preview, media, searchreplace, print, contextmenu, paste, directionality, fullscreen, noneditable, visualchars, nonbreaking, xhtmlxtras, template",*/
        editor_selector :"tinymce-enabled"
    }
        	);
  });
  </script></head>
  <body>
	<div class="entry-content">
				
			
	<form action="" method="post" class="atcf-submit-campaign" enctype="multipart/form-data">
		
			<h3 class="atcf-submit-section campaign_heading">Postez votre annonce maintenant </h3>
	<p class="atcf-submit-campaign-title">
		<label for="title">Titre</label>
		<input type="text" name="title" id="title" value="" placeholder="">
	</p>

	<div class="atcf-submit-campaign-category">
		<label for="category">Categories</label>

		<ul class="atcf-multi-select">			
			<?php
				$genres = get_terms('annonce_category', 'orderby=id&hide_empty=0');
				$counter = 0;
				foreach ($genres as $genre) {
				$counter++;
				//$option = '<input type="checkbox" name="genre[]" id="'.$genre->name.'" value="'.$genre->name.'">';
				//$option .= '<label for="genre">'.$genre->name.'</label>';
				$option='<li id="download_category-'.$counter.'" class="popular-category">
				<label class="selectit" >
				<input value="'.$genre->term_taxonomy_id.'" type="checkbox" name="category[]" id="'.$genre->name.'">'.$genre->name.'</label></li>';
				echo $option;
				}
			?>

	</ul>
	</div>
	<div class="atcf-submit-campaign-description">
		<label for="description">Description</label>
		<div id="wp-description-wrap" class="wp-core-ui wp-editor-wrap html-active">

<div id="wp-description-editor-container" class="wp-editor-container">
	<textarea rows="8" cols="40" name="description" id="editor" class="tinymce-enabled required"></textarea>
</div>


	</div>
	<p class="atcf-submit-campaign-excerpt">
		<label for="goal">Dernier delai</label>
		<input type="text" name="goal" id="goal" value="" placeholder="DD/MM/YY">
	</p>
	<p class="atcf-submit-campaign-image">
		<label for="thumbnail">Image de l'annonce</label>
		<input type="file" name="thumbnail" id="thumbnail">

			</p>
	<p class="atcf-submit-campaign-video">
		<label for="video"> Video URL</label>
		<input type="text" name="video" id="video" value="" placeholder="">
	</p>
	

		<p class="atcf-submit-campaign-submit">
			<button type="submit" name="submit" value="submit" class="button">
				Publiez votre annonce 		</button>

				<input type="hidden" name="post-type" id="post-type" value="wp_annonce" />
				<input type="hidden" name="action" value="wp_annonce" />
	 
					</p>
	</form>

	


											</div></body></html>

	
			<?php wp_nonce_field( 'name_of_my_action','name_of_nonce_field' ); ?>
	
	<?php

		if($_POST){
			save_annonce_data();
}		
}
function save_annonce_data()
{
	if(isset($_POST['title']))
	{
		$title=$_POST['title'];
	}
	else
	{
		echo 'Please enter a title';
			exit;
	}
	if (isset($_POST['description'])) {
		$description=$_POST['description'];
	}
	else
	{
		echo "Please enter a description";
		exit;
	}
	if (isset($_POST['category']) && is_array($_POST['category'])) {
		foreach($_POST['category'] as $category) 
			{
		echo $category;
		$tableau=array($_POST['category']);}
	}
	else
	{
		echo "check a category";
		exit;
	}
	if(isset($_POST['goal']))
	{
		$deadline=$_POST['goal'];
	}
	else
	{
		echo "Choose a deadline";
		exit;
	}
	if (isset ($_FILES['thumbnail'])) {
			$file = $_FILES['thumbnail'];
		} else {
			echo 'Photo manquante';
			exit;
			}
	if(isset($_POST['video']))
	{
		$video=$_POST['video'];
	}
	else
	{
		echo "Choose a deadline";
		exit;
	}

$category='annonce_category'; // category name for the post
$cat_ID = get_cat_ID( $category );

	$post = array(
			'post_title' => wp_strip_all_tags( $title ),
			'post_content' => $description,
			 'description' => $description,
			'post_category'=>array('8','10'),
			'post_status' => 'publish',			// Choose: publish, preview, future, etc.
			'post_type' => $_POST['post-type'] , 
		//	'tax_input' => array( 'category' => $cat_ID ),
			//'tax_input'   =>  array( 'category' => array($_POST['category']) ) 
			// Use a custom post type if you want to
			//'post_category'  =>  array( 'genre' => array($_POST['category']) )  // support for custom taxonomies.   

		);

		$the_post_id=wp_insert_post($post);  // http://codex.wordpress.org/Function_Reference/wp_insert_post
		if ($_FILES) {
	    foreach ($_FILES as $file => $array) {
	    $newupload = insert_image($file,$the_post_id);
}
}
print_r($tableau);
		add_post_meta($the_post_id,'url-video',$video);
		add_post_meta($the_post_id,'deadline',$deadline);
		//add_post_meta($the_post_id,'deadline',$tableau);
		wp_set_post_terms( $the_post_id,$_POST['category'], 'taxonomy_slug');
		wp_set_post_categories( $the_post_id, $_POST['category'] );
		//wp_set_post_terms($the_post_id,(array)$_POST['category'],'annonce_category',true);
		//$the_post_id=wp_insert_post($post);
	//	wp_set_post_terms($the_post_id,$tableau,'annonce_category',true);
		//wp_set_post_terms( $the_post_id, (array)$_POST['category'], 'annonce_category', true );
		// wp_set_post_terms($pid,(array)$_POST['genre'],'gen re',true);
		//wp_set_post_terms( $post_id, $tag, $taxonomy );
		
}
function insert_image($file_handler,$post_id,$setthumb='false') {
	    // check to make sure its a successful upload
	    if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();
	 
	    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	    require_once(ABSPATH . "wp-admin" . '/includes/media.php');
	 
	    $attach_id = media_handle_upload( $file_handler, $post_id );
	 	if ($setthumb) update_post_meta($post_id,'_thumbnail_id',$attach_id);
	    return $attach_id;
	}
?>