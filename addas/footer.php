	<footer id="l-footer">
		<div class="area-copy">
			<div class="container">
				<p class="copy text-center">
					<small>
						<i class="fa fa-copyright" aria-hidden="true"></i> 2017
						<?php
							$thisYear = date('Y');
							if( 2017 != $thisYear ) {
								echo '-' . $thisYear;
							}
						?>アドダス
					</small>
				</p>
			</div>
		</div>
	</footer>
<?php
	// end of wrapper
	// ==========
?>
</div>
<p id="toPageTop"><a href="#l-wrapper">ページトップへ戻る</a></p>



<?php wp_footer(); ?>



</body>
</html>