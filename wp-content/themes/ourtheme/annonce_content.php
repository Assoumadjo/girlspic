<?php
/**
 * Template Name:annonce 
 */
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
					<?php get_template_part( 'content', 'single' );?>
					<div class="image">
					<?php get_the_post_thumbnail( $_GET['post_id'] ); ?>
					</div> 

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() )
							comments_template( '', true );
					?>
				<?php endwhile; ?>
			</div>
			<?php get_sidebar(); ?>
		</div>
		<!-- / container -->
	</div>
	<!-- / content -->

<?php get_footer();

?>