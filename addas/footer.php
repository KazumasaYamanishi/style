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
						?>学校法人国分教育学園 認定こども園 あおば幼稚園・あかつきこども園
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