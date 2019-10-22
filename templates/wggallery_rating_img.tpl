<small>
	<{if $image.rating.voted == 0}>
		<div class="wggallery_ratingblock">
			<div id="unit_long<{$image.id}>">
				<div id="unit_ul<{$image.id}>" class="wggallery_unit-rating">
					<div class="wgwggallery_current-rating" style="width:<{$image.rating.size}>;"><{$image.rating.text}></div>
					<div>
						<a class="wggallery_r1-unit rater" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=1&amp;source=1" title="<{$smarty.const._MA_WGGALLERY_RATING1}>" rel="nofollow">1</a>
					</div>
					<div>
						<a class="wggallery_r2-unit rater" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=2&amp;source=1" title="<{$smarty.const._MA_WGGALLERY_RATING2}>" rel="nofollow">2</a>
					</div>
					<div>
						<a class="wggallery_r3-unit rater" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=3&amp;source=1" title="<{$smarty.const._MA_WGGALLERY_RATING3}>" rel="nofollow">3</a>
					</div>
					<div>
						<a class="wggallery_r4-unit rater" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=4&amp;source=1" title="<{$smarty.const._MA_WGTIMELINES_RATING4}>" rel="nofollow">4</a>
					</div>
					<div>
						<a class="wggallery_r5-unit rater" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=5&amp;source=1" title="<{$smarty.const._MA_WGGALLERY_RATING5}>" rel="nofollow">5</a>
					</div>
				</div>
				<div>
					<{$image.rating.text}>
				</div>
			</div>
		</div>
	<{else}>
		<div class="wggallery_ratingblock">
			<div id="unit_long<{$image.id}>">
				<div id="unit_ul<{$image.id}>" class="wggallery_unit-rating" style="width:<{$image.rating.maxsize}>;">
					<div class="wgwggallery_current-rating" style="width:<{$image.rating.size}>;"><{$image.rating.text}></div>
				</div>
				<div class="wgwggallery_voted">
					<{$image.rating.text}>
				</div>
			</div>
		</div>
	<{/if}>
</small>