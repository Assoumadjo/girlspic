<?php
/**
 * Template Name: Projets
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
			
			
			
			<?php $projets = new WP_Query(array(
						'post_type' => 'wp_projects'
				));?>
				<?php while($projets->have_posts()) : $projets->the_post(); ?>
				<?php the_post_thumbnail('thumbnail'); ?>
					<h5>
						<?php the_title(); ?>
						
					</h5>
					<span>
					<p>
					   <?php the_content();?>
					</p>
					<p>
					  Etat: <?php the_field('etat'); ?>
					</p>
					</span>
					<hr>
				<?php endwhile;?>
			
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
