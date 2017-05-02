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
				<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<?php the_content(); ?>
				</article>
			<?php endwhile; endif; ?>
			<div class="area-pager">
				<ul class="pager">
					<li class="previous"><?php previous_post_link('%link', '<i class="fa fa-chevron-left fa-fw"></i>',true); ?></li>
					<li class="next"><?php next_post_link('%link', '<i class="fa fa-chevron-right fa-fw"></i>',true); ?></li>
				</ul>
			</div>
		</div>
		<div class="col-sm-4 col-md-3" id="l-side">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div><!-- end of .container -->



<?php get_footer(); ?>