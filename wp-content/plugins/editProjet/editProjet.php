<?php
/**
 * Plugin Name: Edit Projet
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Just an example to test Costum post type
 * Version: The Plugin's Version Number, e.g.: 1.0
 * Author: ghita
 * Author URI: http://URI_Of_The_Plugin_Author
 * License: blbalab
 */
define(PLUGIN_PATH, plugin_dir_path( __FILE__ ));
//shortcode
		add_shortcode('editProjet', 'formulaire_Edit_projet');
	//	add_action('init','formulaire_Edit_projet');
global $current_post ;
global $title;
 

function formulaire_Edit_projet()
{

 $query = new WP_Query( array( 'post_type' => 'wp_projects', 'posts_per_page' => '-1' ) ); 
 
  if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); 
 
    		if ( isset( $_GET['post'] ) ) {
     
			    if ( $_GET['post'] == $post->ID )
			    {

			        $current_post = $post->ID;
			        
			        $title = $current_post->get_the_title();  
			        
			        $content = get_the_content();
			        $etat=  get_field('etat');
			        $categorie=get_field('categorie');
			        $photo= get_the_post_thumbnail('thumbnail');
			        //$video= get_the_field('video');
			        //$num_cert=get_the_field('certif');
			        //$nbr=get_the_field('nbr');
			        //$noms=get_the_field('noms');
			    }
			    else
			    {
			    	$a=0;
			    }
			}

 		endwhile; 
 		endif;
 		//wp_reset_query(); 
 		echo $a;
	echo "Editer Votre Projet";
	$titre=$_GET['post'];
	echo $_GET['post'] ;
	echo "title" .$titre;
	echo get_the_content();

	?>
	<p><label for="title">Titre Projet</label><br />
			 
			<input type="text" id="title" value="<?php echo $title; ?>" tabindex="1" size="20" name="title" />
			 
			</p>

			
			<p><label for="description">Description du projet</label><br />
			 
			<textarea id="description" tabindex="3" name="description" cols="50" rows="6"><?php echo $content; ?></textarea>
			 
			</p>

			<p><label for="meta">Etat</label><br />
			 
			<input type="text" id="etat" value="<?php echo $etat; ?>" tabindex="1" size="20" name="etat" />
			<br>
			
			 

			 <p><label for="thumbnail">Photo</label><br />
			
			<input type="file" id="thumbnail" value="" tabindex="1" size="20" name="thumbnail" />
			
		<!--	<p><label for="video">URL Video</label><br />
			 
			<input type="text" id="video" value="<?php echo $video; ?>" tabindex="1" size="20" name="video" />

			<!--<p><label for="attach">Pieces jointes</label><br />
			 
			<input type="file" id="attach" value="" tabindex="1" size="20" name="attach" />-->
			
		<!--		<p><label for="certif">N Certification</label><br />
			 
			<input type="text" id="certif" value="<?php echo $num; ?>" tabindex="1" size="20" name="certif" />
			
			<p><label for="nbr">Nombre de membres</label><br />
			 
			<input type="text" id="nbr" value="<?php echo $nbr; ?>" tabindex="1" size="20" name="nbr" />
			
			<p><label for="noms">Noms des membres</label><br />
			 
			<input type="text" id="noms" value="<?php echo $noms; ?>" tabindex="1" size="20" name="noms" /> 
			 
			</p> 	-->		 
			<p align="right"><input type="submit" value="Envoyer" tabindex="6" id="submit" name="submit" /></p>


			<input type="hidden" name="post-type" id="post-type" value="wp_projects" />
			 
			<input type="hidden" name="action" value="wp_projects" />
	 
			<?php wp_nonce_field( 'name_of_my_action','name_of_nonce_field' ); ?>
	 </form>
	<?php

		if($_POST){
			ty_update_post_data();
		}
		
		
}
function ty_update_post_data() {

	if ( empty($_POST) || !wp_verify_nonce($_POST['name_of_nonce_field'],'name_of_my_action') )
	{
	   print 'Sorry, your nonce did not verify.';
	   exit;

	}else{ 
 
		// Do some minor form validation to make sure there is content
		if (isset ($_POST['title'])) {
			$title =  $_POST['title'];
		} 
		
		if (isset ($_POST['description'])) {
			$description = $_POST['description'];
		} 
		if (isset ($_POST['etat'])) {
			$etat = $_POST['etat'];
		} 


	}

		$post_information = array(
		    'ID' => $current_post,
		    'post_title' =>  $title,
		    'post_content' => $description,
		    'post_type' => 'wp_projects',
		    'post_status' => 'publish'
			);
			$post_id = wp_update_post( $post_information );
			update_post_meta($post_id,'etat',$etat);
}


?>