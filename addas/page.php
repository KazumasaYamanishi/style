<?php
	get_header();
	// 	タイトル
	// --------------------------------------------------
		get_template_part( 'page-name' );
	// 	パンくず
	// --------------------------------------------------
		get_template_part( 'breadcrumb' );
?>



<div class="" id="l-main">
	<?php if(have_posts()): while(have_posts()): the_post(); ?>
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<?php the_content(); ?>
		</article>
	<?php endwhile; endif; ?>
</div>



<?php get_footer(); ?>