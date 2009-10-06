<?php
/*
Template Name: Heftarchiv
*/
?>

<?php get_header(); ?>
			
			<div id="main">
				
				<h1 class="pagetitle"><?php the_title(); ?></h1>
				
				<?php $my_query = new WP_Query('category_name=Heftarchiv&showpost=100');
					  while ($my_query->have_posts()) : $my_query->the_post();
					  $do_not_duplicate[] = $post->ID ?>
					  
					  	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				
							<h2><?php the_title(); ?></h2>
									
								<?php the_content(); ?>
							
						</div>
					  
					  <?php endwhile; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>