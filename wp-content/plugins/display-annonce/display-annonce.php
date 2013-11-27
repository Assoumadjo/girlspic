<?php
/**
 * Plugin Name: Display annonce
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Display an announce in page
 * Version: The Plugin's Version Number, e.g.: 1.0
 * Author: Asmaa
 * Author URI: http://URI_Of_The_Plugin_Author
 * License: blbalab
 */

?>
<html>

	<?php
define(PLUGIN_PATH, plugin_dir_path( __FILE__ ));
add_shortcode('afficher_annonce', 'display_annonce');

function display_annonce()
{
	$query = new WP_Query( array( 'post_type' => 'wp_annonce' ) ); 
 
  if ( $query->have_posts() ) : 
  	while ( $query->have_posts() ) : 
  		$query->the_post(); 
 
    		if ( isset( $_GET['annonce_id'] ) ) {

     
			    if ( $_GET['annonce_id'] == $post->ID )
			    {
			    	echo $_GET['annonce_id'];
			        $current_post = $post->ID;
			        $title = $current_post->get_the_title();  
			        $content = get_the_content();
			        $photo= the_post_thumbnail('blog');
			        
			    }
			    else
			    {
			    	$a=0;
			    }
			}

 		endwhile; 
 		endif;
 		wp_reset_query(); 

	?>
	<div class="image">
	<?php echo $photo;
	echo get_the_post_thumbnail($_GET['annonce_id']);	
	echo $a ; ?>
	</div> 
	<div class="post-meta">
			<div class="date"><i class="icon-calendar"></i> <?php printf( __( 'Date Posted: %s', 'fundify' ), get_the_date() ); ?></div>
			<div class="comments"><span class="comments-link"><i class="icon-comment"></i><?php comments_popup_link( __( ' 0 Comments', 'fundify' ), __( '1 Comment', 'fundify' ), __( '% Comments', 'fundify' ) ); ?></span></div>
		<div class="date"><i class="icon-calendar"></i> <?php printf( __( 'Date Posted: %s', 'fundify' ), get_the_date() ); ?></div>
		</div>
	<div class="entry-content">
		<?php echo $content; ?>
	</div>
	<?php
	
		}

?>