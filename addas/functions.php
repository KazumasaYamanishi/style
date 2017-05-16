<?php

// ==================================================
//	管理者以外、メニューを隠す
// ==================================================
	function remove_menus(){
		if( !current_user_can('level_10') ) {
			// remove_menu_page( 'edit.php?post_type=hospital←カスタム投稿タイプスラッグ' );
			// remove_menu_page('wpcf7'); // Contact Form 7プラグイン
			global $menu;
			//unset($menu[2]); // ダッシュボード
			unset($menu[4]); // メニューの線1
			// unset($menu[5]); // 投稿
			// unset($menu[10]); // メディア
			unset($menu[15]); // リンク
			unset($menu[20]); // ページ
			unset($menu[25]); // コメント
			unset($menu[59]); // メニューの線2
			unset($menu[60]); // テーマ
			unset($menu[65]); // プラグイン
			unset($menu[70]); // プロフィール
			unset($menu[75]); // ツール
			unset($menu[80]); // 設定
			unset($menu[90]); // メニューの線3
		}
	}
	add_action( 'admin_menu', 'remove_menus' );
// ==================================================
//	ダッシュボードトップ画面のウィジェットを非表示にする
// ==================================================
	function example_remove_dashboard_widgets() {
		global $wp_meta_boxes;
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); 		// 現在の状況（概要）
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); 	// 最近のコメント
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); 	// 被リンク
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); 			// プラグイン
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); 		// クイック投稿
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); 		// 最近の下書き
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); 			// WordPressブログ
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); 			// WordPressフォーラム
	}
	add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets');
// ==================================================
//	管理画面上部のメニューを非表示にする
// ==================================================
	function my_wp_before_admin_bar_render() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu('wp-logo');		// wordpressロゴ
		$wp_admin_bar->remove_menu('updates');		// 更新
		$wp_admin_bar->remove_menu('comments');		// コメント
		$wp_admin_bar->remove_menu('new-content');	// 新規
		$wp_admin_bar->remove_menu('user-info');	// マイアカウント内「プロフィール」
		$wp_admin_bar->remove_menu('edit-profile');	// マイアカウント内「プロフィールを編集」
	}
	add_action( 'wp_before_admin_bar_render', 'my_wp_before_admin_bar_render' );
// ==================================================
//	CSSを読み込む
// ==================================================
	function add_files() {
		$dir = get_stylesheet_directory_uri();
		wp_enqueue_style( 'jqueryui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css', "", "" );
		wp_enqueue_style( 'fontawesome', $dir . '/css/font-awesome.min.css', "", "" );
		wp_enqueue_style( 'bootstrap', $dir . '/css/bootstrap.min.css', "", "" );
		wp_enqueue_style( 'swiper', $dir . '/css/swiper.min.css', "", "" );
		wp_enqueue_style( 'animate', $dir . '/css/animate.min.css', "", "" );
		wp_enqueue_style( 'base', $dir . '/css/base.css', "", "" );
	}
	add_action( 'wp_enqueue_scripts', 'add_files' );
// ==================================================
//	JSを読み込む
// ==================================================
	function load_cdn() {
		if ( !is_admin() ) {
			wp_deregister_script('jquery');
			wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', array(), '1.12.4', true);
			wp_deregister_script('jquery-ui-core');
			wp_enqueue_script('jquery-ui-core','//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', array(), '1.12.1', true);
			wp_deregister_script('bootstrap');
			wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '', true);
			wp_deregister_script('matchheight');
			wp_enqueue_script('matchheight', get_template_directory_uri() . '/js/jquery.matchHeight-min.js', array(), '', true);
			wp_deregister_script('ajaxzip3');
			wp_enqueue_script('ajaxzip3', '//ajaxzip3.github.io/ajaxzip3.js', array(), '', true);
			wp_deregister_script('autotab');
			wp_enqueue_script('autotab', get_template_directory_uri() . '/js/jquery.autotab.min.js', array(), '', true);
			wp_deregister_script('swiper');
			wp_enqueue_script('swiper', get_template_directory_uri() . '/js/swiper.min.js', array(), '', true);
			wp_deregister_script('wow');
			wp_enqueue_script('wow', get_template_directory_uri() . '/js/wow.min.js', array(), '', true);
			wp_deregister_script('myScript');
			wp_enqueue_script('myScript', get_template_directory_uri() . '/js/myScript.js', array(), '', true);
			wp_deregister_script('googlemap');
			wp_enqueue_script('googlemap', '//maps.googleapis.com/maps/api/js?key=', array(), '', true);
			wp_deregister_script('map');
			wp_enqueue_script('map', get_template_directory_uri() . '/js/map.js', array(), '', true);
		}
	}
	add_action('init', 'load_cdn');
// ==================================================
//	カスタムメニュー
// ==================================================
	register_nav_menu( 'g_menu_sp', 'SP' );
	register_nav_menu( 'g_menu_pc', 'PC' );
	register_nav_menu( 'f_menu', 'フッターメニュー' );
	add_theme_support( 'menus' );
// ==================================================
//	wp_nav_menuで 説明 を表示する
// ==================================================
	class My_Walker extends Walker_Nav_Menu {
		function start_el(&$output, $item, $depth, $args) {
			global $wp_query;
			$indent 		= ( $depth ) ? str_repeat( "\t", $depth ) : '';
			$classes     	= empty ( $item->classes ) ? array () : (array) $item->classes;
			$classes 		= empty( $item->classes ) ? array() : (array) $item->classes;
			$class_names 	= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			$output 		.= $indent . '<li id="menu-item-'. $item->ID . '"' . ' class="' . $class_names .'">';
			$attributes  	= ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes 	.= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes 	.= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes 	.= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
			$item_output 	= $args->before;
			$item_output 	.= '<a'. $attributes .'>';
			$item_output 	.= $args->link_before . '<span class="menu_title">' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>' . $args->link_after;
			if ( $item->description ) {
				$item_output .= '<span class="menu_description">' . $item->description . '</span>';
			}
			$item_output 	.= '</a>';
			$item_output 	.= $args->after;
			$output 		.= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
// ==================================================
//	アイキャッチ画像を使えるようにする
// ==================================================
	add_theme_support( 'post-thumbnails' );
// ==================================================
//	メディアライブラリで他人がアップロードした画像を非表示にする
// ==================================================
	function display_only_self_uploaded_medias( $query ) {
		if (!current_user_can('administrator')) {
			if ( $user = wp_get_current_user() ) {
				$query['author'] = $user->ID;
			}
			return $query;
		} else {
			return $query;
		}
	}
	add_action( 'ajax_query_attachments_args', 'display_only_self_uploaded_medias' );
// ==================================================
//	管理画面の記事/固定ページ一覧のテーブルにIDの列を加える
// ==================================================
	add_filter('manage_posts_columns', 'posts_columns_id', 5);
	add_action('manage_posts_custom_column', 'posts_custom_id_columns', 5, 2);
	add_filter('manage_pages_columns', 'posts_columns_id', 5);
	add_action('manage_pages_custom_column', 'posts_custom_id_columns', 5, 2);
	function posts_columns_id($defaults){
		$defaults['wps_post_id'] = __('ID');
		return $defaults;
	}
	function posts_custom_id_columns($column_name, $id){
		if($column_name === 'wps_post_id'){
			echo $id;
		}
	}
// ==================================================
//	ウィジェット
// ==================================================
	if (function_exists('register_sidebar')) {
		register_sidebar( array(
			'name' 			=> __( 'Side Widget' ),
			'id' 			=> 'side-widget',
			'before_widget' => '<li class="widget-container">',
			'after_widget' 	=> '</li>',
			'before_title' 	=> '<h3>',
			'after_title' 	=> '</h3>',
		));
	}
// ==================================================
//	bodyとpost classにカテゴリー名ポストクラス名をclass名として追加する
// ==================================================
	function category_id_class($classes) {
		global $post;
		foreach((get_the_category($post->ID)) as $category)
			$classes[] = $category->category_nicename;
		return $classes;
	}
	add_filter('post_class', 'category_id_class');
	add_filter('body_class', 'category_id_class');
// ==================================================
//	投稿数をaタグ内に表記
// ==================================================
	add_filter( 'wp_list_categories', 'my_list_categories', 10, 2 );
	function my_list_categories( $output, $args ) {
		$output = preg_replace('/<\/a>\s*\((\d+)\)/',' ($1)</a>',$output);
		return $output;
	}
	add_filter( 'get_archives_link', 'my_archives_link' );
	function my_archives_link( $output ) {
		$output = preg_replace('/<\/a>\s*(&nbsp;)\((\d+)\)/',' ($2)</a>',$output);
		return $output;
	}
// ==================================================
//	the_except() にて表示される文字数を制限する
// ==================================================
	function change_excerpt_mblength($length) {
		return 30;
	}
	add_filter('excerpt_mblength', 'change_excerpt_mblength');
	function new_excerpt_more($more) {
		return ' ...';
	}
	add_filter('excerpt_more', 'new_excerpt_more');
// ==================================================
//	タイトルの文字数制限 !!! これはテンプレートファイルに書くこと
// ==================================================
	// if( mb_strlen( $post->post_title ) > 20 ) {
	// 	$title = mb_substr( $post->post_title, 0, 20 );
	// 	echo $title. ･･･ ;
	// } else {
	// 	echo $post->post_title;
	// }
// ==================================================
// 記事内の最初の画像を取得する　→　echo catch_that_image(); でソースを出力する
// ==================================================
	function catch_that_image() {
		global $post, $posts;
		$first_img 	= '';
		ob_start();
		ob_end_clean();
		$output 	= preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$first_img 	= $matches [1] [0];
		// if( empty( $first_img ) ) { //Defines a default image
		// 	$first_img = "./img/dammy-thumb.gif";
		// }
		return $first_img;
	}
// ==================================================
//	PCとスマフォ向けの出し分け
// ==================================================
	function is_mobile(){
		$useragents = array(
			'iPhone',          // iPhone
			'iPod',            // iPod touch
			'Android',         // 1.5+ Android
			'dream',           // Pre 1.5 Android
			'CUPCAKE',         // 1.5+ Android
			'blackberry9500',  // Storm
			'blackberry9530',  // Storm
			'blackberry9520',  // Storm v2
			'blackberry9550',  // Storm v2
			'blackberry9800',  // Torch
			'webOS',           // Palm Pre Experimental
			'incognito',       // Other iPhone browser
			'webmate'          // Other iPhone browser
		);
		$pattern = '/'.implode('|', $useragents).'/i';
		return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
	}
// ==================================================
//	wp-bootstrap-navwalker を読み込む　・・・　Bootstrap3のドロップダウンメニューを実装するためのファイル
// ==================================================
	require_once('wp_bootstrap_navwalker.php');
// ==================================================
//	wp_list_pagesで取得したリストのクラスにスラッグを追加
// ==================================================
	function my_page_css_class( $css_class, $page ) {
		$css_class[] = 'list-group-item';
		return $css_class;
	}
	add_filter( 'page_css_class', 'my_page_css_class', 10, 2 );
// ==================================================
//	wp-pagenavi
// ==================================================
	function nofx_wp_pagenavi($size = null, $position = null, $post = false, $queryArgs = null) {
		if (!function_exists('wp_pagenavi')) {
			return null;
		}
		// $class[] = "pagination"; // Set Main Class
		// Pagination Size Class
		// if (!$size) {
		// 	$size = '';
		// }
		// $class[] = (!$size) ? '' : "pagination-" . $size;
		// Pagination Position, default LEFT
		// if (!$position) {
		// 	$position = 'left';
		// }
		// $class[] = "pagination-" . $position;
		// Set Before & After Output
		// $before = "<div class=\"" . implode(" ", $class) . "\"><ul class='pagination'>";
        $before = "<div class=\"navigation\"><ul class='pagination'>";
		$after = "</ul></div>";
		// Build Args
		$args = array(
			'before' => $before,
			'after' => $after
		);
		// Cloning untuk wp_link_pages()
		if ($post) {
			$args['type'] = 'multipart';
		}
		if ($queryArgs) {
			$args['query'] = $queryArgs;
		}
		return wp_pagenavi($args);
	}
	/**
	 * This is filter that help above template tags
	 */
	function nofx_pagenavi_filter($html) {
		$out = str_replace('<div class=\'wp-pagenavi\'>', '', $html);
		$out = str_replace('</div></ul></div>', '</ul></div>', $out);
		$out = str_replace('<a ', '<li><a ', $out);
		$out = str_replace('</a>', '</a></li>', $out);
		$out = str_replace('<span', '<li><a href="#"><span', $out);
		$out = str_replace('</span>', '</span></a></li>', $out);
		$out = preg_replace('/<li><a href="#"><span class=[\'|"]pages[\'|"]>([0-9]+) of ([0-9]+)<\/span><\/a><\/li>/', '', $out);
		$out = preg_replace('/<li><a href="#"><span class=[\'|"]extend[\'|"]>([^\n\r<]+)<\/span><\/a><\/li>/', '<li class="disabled"><a href="#">&hellip;</a></li>', $out);
		$out = str_replace('<li><a href="#"><span class=\'current\'', '<li class="active disabled"><a href="#"><span class="current"', $out);
		return $out;
	}
	add_filter('wp_pagenavi', 'nofx_pagenavi_filter', 10, 2);
// ==================================================
//	アーカイブページで現在のカテゴリー・タグ・タームを取得する
// ==================================================
	function get_current_term(){
		$id;
		$tax_slug;
		if(is_category()){
			$tax_slug = "category";
			$id = get_query_var('cat');
		}else if(is_tag()){
			$tax_slug = "post_tag";
			$id = get_query_var('tag_id');
		}else if(is_tax()){
			$tax_slug = get_query_var('taxonomy');
			$term_slug = get_query_var('term');
			$term = get_term_by("slug",$term_slug,$tax_slug);
			$id = $term->term_id;
		}
		return get_term($id,$tax_slug);
	}
	/*
		<?php $cat_info = get_current_term(); ?>
		<span class="news_category <?php echo esc_attr($cat_info->slug); ?>"><?php echo esc_html($cat_info->name); ?></span>
	*/
// ==================================================
//	最上位の固定ページ情報を取得する
// ==================================================
	function apt_page_ancestor() {
		global $post;
		$anc = array_pop(get_post_ancestors($post));
		$obj = new stdClass;
		if ($anc) {
			$obj->ID = $anc;
			$obj->post_title = get_post($anc)->post_title;
		} else {
			$obj->ID = $post->ID;
			$obj->post_title = $post->post_title;
		}
		return $obj;
	}
// ==================================================
//	カテゴリIDを取得する
// ==================================================
	function apt_category_id($tax='category') {
		global $post;
		$cat_id = 0;
		if (is_single()) {
			$cat_info = get_the_terms($post->ID, $tax);
			if ($cat_info) {
				$cat_id = array_shift($cat_info)->term_id;
			}
		}
		return $cat_id;
	}
// ==================================================
//	カテゴリ情報を取得する
// ==================================================
	function apt_category_info($tax='category') {
		global $post;
		$cat = get_the_terms($post->ID, $tax);
		$obj = new stdClass;
		if ($cat) {
			$cat = array_shift($cat);
			$obj->name = $cat->name;
			$obj->slug = $cat->slug;
		} else {
			$obj->name = '';
			$obj->slug = '';
		}
		return $obj;
	}
// ==================================================
//	editor style
// ==================================================
	add_editor_style();
// ==================================================
//	ビジュアルとテキストエディタの往復でもソースが変わらないようにする
// ==================================================
	// add_filter('tiny_mce_before_init', 'tinymce_init');
	// function tinymce_init( $init ) {
	// 	$init['verify_html'] = false;
	// 	return $init;
	// }
// ==================================================
//	固定ページのみ自動整形機能を無効化します。
// ==================================================
	function disable_page_wpautop() {
		if ( is_page() ) remove_filter( 'the_content', 'wpautop' );
	}
	add_action( 'wp', 'disable_page_wpautop' );
// ==================================================
//	最新記事リスト [news cat="2,3,5" num="5"]などで出力
// ==================================================
	function getNewItems($atts) {
		extract(shortcode_atts(array(
			"num" => '',	// 最新記事リストの取得数
			"cat" => ''	    // 表示する記事のカテゴリー指定
		), $atts));
		global $post;
		$oldpost = $post;
		$myposts = get_posts('numberposts=' . $num . '&order=DESC&orderby=post_date&category=' . $cat);
		$retHtml = '<ul class="news-list">';
		foreach($myposts as $post) :
			$cat 		= get_the_category();
			$catname 	= $cat[0]->cat_name;
			$catslug 	= $cat[0]->slug;
			setup_postdata($post);
			$retHtml .= '<li>';
			$retHtml .= '<span class="news-date">' . get_post_time( get_option( 'date_format' )) . '</span>';
			$retHtml .= '<span class="cat ' . $catslug . '">' . $catname . '</span>';
			$retHtml .= '<span class="news-title"><a href="' . get_permalink() . '">' . the_title("", "", false) . '</a></span>';
			$retHtml .= '</li>';
		endforeach;
		$retHtml .= '</ul>';
		$post = $oldpost;
		wp_reset_postdata();
		return $retHtml;
	}
	add_shortcode("news", "getNewItems");
// ==================================================
//	ショートコード
// ==================================================
	/* サイトURLを取得 投稿内で [url] */
	function shortcode_url() {
		return  esc_url( home_url( '/' ) );
	}
	add_shortcode('url', 'shortcode_url');
	/* WordssURLを取得 投稿内で [wpurl] */
	function shortcode_wpurl() {
		return  esc_url( site_url() );
	}
	add_shortcode('wpurl', 'shortcode_wpurl');
	/* テーマフォルダのパス取得 投稿内で [template_url] */
	function shortcode_templateurl() {
		return  get_template_directory_uri();
	}
	add_shortcode('template_url', 'shortcode_templateurl');
// ==================================================
//	変数 ajaxurl に WordPress の Ajax のリンクを代入
// ==================================================
	function add_my_ajaxurl() {
	?>
		<script>
			var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
		</script>
	<?php
		}
		add_action( 'wp_head', 'add_my_ajaxurl', 1 );
// ==================================================
// img srcset 無効化
// ==================================================
	add_filter( 'wp_calculate_image_srcset', '__return_false' );
// ==================================================
//	固定ページの子ページかどうか判定 判定させたい場所で「is_subpage()」
// ==================================================
	function is_subpage() {
		global $post;
		if (is_page() && $post->post_parent){
			$parentID = $post->post_parent;
			return $parentID;
		} else {
			return false;
		};
	};