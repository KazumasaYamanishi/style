<?php
	get_header();
	// パンくず
	// --------------------------------------------------
		get_template_part( 'breadcrumb' );
?>



<div class="container">
	<div class="row">
		<div class="col-sm-8 col-md-9" id="l-main">
			<?php if(have_posts()): while(have_posts()): the_post(); ?>
				<article <?php post_class('l-section'); ?> id="post-<?php the_ID(); ?>">
					<h2 class="ttl-l-section"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="meta-article">
						<p class="date-article"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php the_time('Y年n月j日'); ?></p>
					</div>
					<?php the_content(); ?>
				</article>
			<?php endwhile; endif; ?>
			<div class="area-pagenation">
				<?php nofx_wp_pagenavi(); ?>
			</div>
		</div>
		<div class="col-sm-4 col-md-3" id="l-side">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div><!-- end of .container -->



<?php get_footer(); ?>