<?php if(!is_front_page() && is_page()): ?>



	<div class="">
		<?php $anc = apt_page_ancestor(); ?>
		<?php
			$children = wp_list_pages('title_li=&child_of='.$anc->ID.'&echo=0');
			if($children):
		?>
			<h4 class="first parent-title"><a href="<?php echo get_page_link($post->post_parent); ?>">
				<?php echo esc_html($anc->post_title); ?>
			</a></h4>
			<ul class="list-group">
				<?php // wp_list_pages(array('include' => $anc->ID, 'title_li' => 0)); ?>
				<?php wp_list_pages(array('child_of' => $anc->ID, 'title_li' => 0, 'depth' => 1)); ?>
			</ul>
		<?php endif; ?>
	</div>



<?php else: ?>



	<div class="side-box">
		<h4><i class="fa fa-circle fa-fw" aria-hidden="true"></i>最近の記事</h4>
		<ul class="list-unstyled list-news">
			<?php
				$cat_id = apt_category_id();
				query_posts(array('post_type' => 'post', 'posts_per_page' => 5));
				while (have_posts()) : the_post();
					$pLink    = get_the_permalink();
					$time     = get_the_time('Y年n月j日');
					$cat_info = apt_category_info();
					$cat_slug = esc_attr($cat_info->slug);
					$cat_name = esc_html($cat_info->name);
					$title    = get_the_title();
					echo '<li><a href="' . $pLink . '"><span class="date-news">' . $time . '</span><span class="label label-' . $cat_slug . '">' . $cat_name . '</span><span class="ttl-news">' . $title . '</span></a></li>';
				endwhile;
				wp_reset_query();
			?>
		</ul>
	</div>
	<div class="side-box">
		<h4><i class="fa fa-circle fa-fw" aria-hidden="true"></i>カテゴリー</h4>
		<ul class="list-unstyled side-list">
			<?php wp_list_categories(array('title_li' => false, 'hide_empty' => true, 'current_category' => $cat_id, 'show_count' => 1, 'include' => 1)); ?>
		</ul>
	</div>
	<div class="side-box">
		<h4><i class="fa fa-circle fa-fw" aria-hidden="true"></i>過去の記事</h4>
		<ul class="list-unstyled side-list">
			<?php
				wp_get_archives('type=monthly&limit=12&show_post_count=true');
			?>
		</ul>
	</div>



<?php endif; ?>
<div class="l-widget">
	<ul>
		<?php dynamic_sidebar( 'side-widget' ); ?>
	</ul>
</div>