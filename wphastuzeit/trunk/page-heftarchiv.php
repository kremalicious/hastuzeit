<?php
/*
Template Name: Heftarchiv
*/
?>

<?php get_header(); ?>
			
			<div id="main">
				
				<h1 class="pagetitle"><?php the_title(); ?></h1>
				
				<?php query_posts('category_name=Heftarchiv'); ?>
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					  
					  	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				
							<h2><?php the_title(); ?></h2>
									
								<?php the_content(); ?>
							
						</div>
					  
					  <?php endwhile; else: ?>

						<?php endif; 
						wp_reset_query(); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>