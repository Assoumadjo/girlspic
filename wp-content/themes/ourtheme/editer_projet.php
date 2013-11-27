<?php
/**
 * Template Name: Edit_Projet
 * 
 * 
 * 
 */
global $test; 
get_header(); ?>

	<div class="title pattern-<?php echo rand(1,4); ?>">
		<div class="container">
			<?php while ( have_posts() ) : the_post(); ?>
			<h1><?php the_title() ;?></h1>
			<?php endwhile; ?>
		</div>
		<!-- / container -->
	</div>
	<div id="content">
		<div class="container">
			<div id="main-content">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'single' ); ?>
					<?php endwhile; ?>
			<?php
	 $query = new WP_Query( array( 'post_type' => 'wp_projects', 'posts_per_page' => '-1' ) ); ?>
 
<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
 
<?php
 
    if ( isset( $_GET['post'] ) ) {
     
    if ( $_GET['post'] == $post->ID )
    {
        $current_post = $post->ID;
        $title = get_the_title();
        $content = get_the_content();
        $etat=  get_field('etat');
        $categorie=get_field('categorie');
        the_post_thumbnail('thumbnail');
        //$video=  ('video');
        //$num_cert=get_the_field('certif');
        //$nbr=get_the_field('nbr');
        //$noms=get_the_field('noms');
    }
}
 
?>
 
<?php endwhile; endif; ?>
<?php wp_reset_query(); ?>
			<form id="projet" name="projetForm" method="post" action="" enctype="multipart/form-data">
 			
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
			</p>

			<p><label for="video">URL Video</label><br />
			 
			<input type="text" id="video" value="" tabindex="1" size="20" name="video" />
			</p>
			<p><label for="certif">N Certification</label><br />
			 
			<input type="text" id="certif" value="" tabindex="1" size="20" name="certif" />
			</p>
			<p><label for="nbr">Nombre de membres</label><br />
			 
			<input type="text" id="nbr" value="" tabindex="1" size="20" name="nbr" />
			</p>

			 
			<p align="right"><input type="submit" value="Envoyer" tabindex="6" id="submit" name="submit" /></p>


			<input type="hidden" name="post-type" id="post-type" value="wp_projects" />
			 
			<input type="hidden" name="action" value="wp_projects" />
	 
			<?php wp_nonce_field( 'name_of_my_action','name_of_nonce_field' ); ?>
	 
	</form>
<?php

	if($_POST){


		if (isset ($_POST['title'])) {
			$title =  $_POST['title'];
		}else{
			$title =$title ;
		}
		if (isset ($_POST['description'])) {
			$description = $_POST['description'];
		} 
		if (isset ($_POST['etat'])) {
			$etat = $_POST['etat'];
		} 
		if (isset ($_FILES['thumbnail'])) {
			$file = $_FILES['thumbnail'];
			
		}else{
			
		}
		if (isset ($_POST['video'])) {
			$video = $_POST['video'];
		}
		if (isset ($_POST['certif'])) {
			$certif = $_POST['certif'];
		} 
		if (isset ($_POST['nbr'])) {
			$nbr = $_POST['nbr'];
		} 
		if (isset ($_POST['noms'])) {
			$noms = $_POST['noms'];
		}
		 //update_post_meta($post_id,'file',$_POST['file']);
			$post_information = array(
		    'ID' => $current_post,
		    'post_title' =>  $title,
		    'post_content' => $description,
		    'post_type' => 'wp_projects',
		    'post_status' => 'publish'
			);
			$post_id = wp_update_post( $post_information );
			
			if ($_FILES && $imgisempty) {
			    foreach ($_FILES as $file => $array) {
			  
			     	$newupload = update_attachment($file,$post_id); 
				
			}
			}
			update_post_meta($post_id,'etat',$etat);
			update_post_meta($the_post_id,'video',$video);
		
			update_post_meta($the_post_id,'certif',$certif);
			update_post_meta($the_post_id,'nbr',$nbr);
			update_post_meta($the_post_id,'noms',$noms);
        	echo"<META HTTP-EQUIV='Refresh' CONTENT='0.001'>";

		}

	     

	
					?>

			</div>
			<?php get_sidebar(); ?>
		</div>
		<!-- / container -->
	</div>

	<!-- / content -->

<?php 
function update_attachment($file_handler,$post_id,$setthumb='false') {
	    // check to make sure its a successful upload
	    if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();
	    if($_FILES[$file_handler]['name']){
	    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	    require_once(ABSPATH . "wp-admin" . '/includes/media.php');
	   
	    $attach_id = media_handle_upload( $file_handler, $post_id );
	    
	 	if ($setthumb) update_post_meta($post_id,'_thumbnail_id',$attach_id);
	   	}
	}

get_footer(); ?>