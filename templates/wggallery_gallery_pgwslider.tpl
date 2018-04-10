<!-- Header -->
<script>
	$(document).ready(function() {
		var pgwSlideshow = $(".pgwSlider").pgwSlider({
			transitionEffect : "<{$transitionEffect}>",
			autoSlide : <{$autoSlide}>,
			transitionDuration : <{$transitionDuration}>,
			intervalDuration : <{$intervalDuration}>,
			displayControls : <{$displayControls}>,
			displayList : <{$displayList}>,
			listPosition : "<{$listPosition}>",
			verticalCentering : <{$verticalCentering}>,
			adaptiveHeight : <{$adaptiveHeight}>,
			adaptiveDuration : <{$adaptiveDuration}>
		});
		pgwSlider.displaySlide(1);
		});
</script>
<{include file='db:wggallery_admin_header.tpl'}>

<{if $images_nb > 0}>
	<div class='clear'></div>
	<div class="row wgg-pgwSlider col-xs-12 col-sm-12">
		<ul class='pgwSlider'>
			<{foreach item=image from=$images}>
				<li><img src='<{$wggallery_upload_url}>/images/<{$source}>/<{$image.name}>' alt='<{$image.title}>' title='<{$image.title}>' <{if $image.desc}>data-description='<{$image.desc}>'<{/if}> ></li>
			<{/foreach}>
		</ul>
	</div>
<{/if}> 		
			
<div class="clear spacer"></div>

<{if $error}>
	<div class="errorMsg"><strong><{$error}></strong></div>
<{/if}> 

<!-- Footer -->
<{include file='db:wggallery_admin_footer.tpl'}>