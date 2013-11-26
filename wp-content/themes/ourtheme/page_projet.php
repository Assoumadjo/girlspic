<?php
/**
 * Template Name: Projets
 *
 * 
 * 
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
			<?php
			$query = new WP_Query( array(
			    'post_type' => 'wp_projects',
			    'posts_per_page' => '-1',
			    'post_status' => array(
			        'publish'
			        
			    )
			) );
			?>
			<table border="2">
 
			    <tr>
			    	<th width="70" >Image</th>
			        <th width="70" >Post Title</th>
			        <th width="70" >Post Content</th>
			        <th width="70" >Post Etat</th>
			        
			        <th width="70" >Post Status</th>
			        <th width="70" >Actions</th>
			    </tr>
	<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
 
			    <tr>
			    	<td><?php the_post_thumbnail('thumbnail');?></td>
			        <td><?php echo get_the_title(); ?></td>
			        <td><?php echo get_the_content(); ?></td>
			        <td><?php the_field('etat'); ?></td>
				    
				    <td><?php echo get_post_status( get_the_ID() ) ?></td>
				    <?php
						$edit_post = add_query_arg( 'post', get_the_ID(), get_permalink( 685 + $_POST['_wp_http_referer'] ) );
					?>
				    <td><a href="<?php echo $edit_post; ?>">Edit</a>
				   <?php if( !(get_post_status() == 'trash') ) : ?>
				     <a onclick="return confirm('Are you sure you wish to delete post: <?php echo get_the_title() ?>?')" href="<?php echo get_delete_post_link( get_the_ID() ); ?>">Delete</a></td>
			    	<?php endif; ?>
			    </tr>
	<?php endwhile; endif; ?>		 
			</table>
			
			
			
			
			</div><!-- #content -->
		</div><!-- #container -->


<?php get_footer(); ?>
