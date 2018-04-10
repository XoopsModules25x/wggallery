<!-- Header -->
<{include file='db:wggallery_admin_header.tpl'}>
	
<{if $imagesCount > 0}>
	<{foreach item=image from=$images name=images}>
		<div id="gallery-<{$smarty.foreach.images.iteration}>"></div>
	<{/foreach}>
<{/if}> 	

<script>

	// Change default cells count from 5 to 6
	$.fn.imagesGrid.defaults.cells = 6;

	var images = [
		<{$container}>
	];

	for (var i = 0; i < <{$imagesCount}> + 1; ++i) {
		$('#gallery-' + (i + 1)).imagesGrid({
			images: images.slice(0, (i + 1)),
			align: true
		});
	}

</script>	
			
<div class="clear spacer"></div>

<{if $error}>
	<div class="errorMsg"><strong><{$error}></strong></div>
<{/if}> 

<!-- Footer -->
<{include file='db:wggallery_admin_footer.tpl'}>