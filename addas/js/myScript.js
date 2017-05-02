/* --------------------------------------------------
  ページトップに戻る
-------------------------------------------------- */
	jQuery(document).ready(function($){
		var pageTop = $('#toPageTop');
		pageTop.hide();
		$(window).scroll(function () {
			if ($(this).scrollTop() > 600) {
				pageTop.fadeIn();
			} else {
				pageTop.fadeOut();
			}
		});
		pageTop.click(function () {
			$('body, html').animate({scrollTop:0}, 500, 'swing');
			return false;
		});
	});
	jQuery(document).ready(function($){
		var offset = 100;
		// $('a[href^*="#"]').click(function() {
		$('a[class="pagelink"]').click(function() {
			var speed = 800;
			var href= jQuery(this).attr("href");
			var target = jQuery(href == "#" || href == "" ? 'html' : href);
			var position = target.offset().top-offset;
			jQuery('body,html').animate({scrollTop:position}, speed, 'swing');
			return false;
		});
	});
/* --------------------------------------------------
  郵便番号自動入力
-------------------------------------------------- */
	jQuery(document).ready(function(){
		jQuery("input[name='郵便番号[data][0]'], input[name='郵便番号[data][1]']").on('change',function( e ) {
			AjaxZip3.zip2addr( '郵便番号[data][0]', '郵便番号[data][1]','pref', 'city' );
		});
		jQuery('input[type=text]').autotab();
	});
/* --------------------------------------------------
  高さを揃える
-------------------------------------------------- */
	jQuery(document).ready(function($){
		$('.height-some').matchHeight();
		$('.height-some h4').matchHeight();
	});
/* --------------------------------------------------
  tel
-------------------------------------------------- */
    jQuery(document).ready(function($) {
        var device = navigator.userAgent;
        if ((device.indexOf('iPhone') > 0 && device.indexOf('iPad') == -1) || device.indexOf('iPod') > 0 || device.indexOf('Android') > 0) {
            $('.tel-link').each(function() {
                var str = $(this).text();
                $(this).html($('<a>').attr('href', 'tel:' + str.replace(/-/g, '')).append(str + '</a>'));
            });
        }
    });
