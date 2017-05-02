<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
	<!--[if lt IE 9]>
		<script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> id="<?php echo esc_attr( $post->post_name ); ?>" <?php if(is_page('access')): ?>onload="initialize();"<?php endif; ?>>
<div id="l-wrapper">
	<header id="l-header">
		<div class="hero">
			<?php
				// グローバルナビ
				// ==============================
			?>
			<nav class="navbar">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#gnav" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="<?php echo home_url(); ?>"><?php echo bloginfo('name'); ?></a>
					</div>
					<?php
						wp_nav_menu(array(
							'theme_location' 	=> 'g_menu_sp',
							'container_id'    	=> 'gnav',
							'container_class' 	=> 'collapse navbar-collapse',
							'menu' 				=> 'menu-global',
							'menu_class' 		=> 'nav navbar-nav navbar-right',
							'walker' 			=> new wp_bootstrap_navwalker()
						));
					?>
				</div>
			</nav>
		</div>
	</header>