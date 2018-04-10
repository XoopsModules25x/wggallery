<{include file='db:wggallery_header.tpl'}>

<div class='panel panel-<{$panel_type}>'>
	<div class='panel-heading wgg-imgindex-header'><{$smarty.const._MA_WGGALLERY_IMAGES_TITLE}> <{$alb_name}></div>
	<div class=' panel-body'>
		<{if $images}>
			<{foreach item=image from=$images}>
				<div class='row wgg-img-panel wgg-image-list'>
					<div class='wgg-img-panel-row col-sm-8'>
						<{if $image.medium}>
							<div class='center'><img class='img-responsive wgg-img' src='<{$image.large}>' alt='<{$image.large}>' /></div>
						<{/if}>
					</div>
					<div class='wgg-img-panel-row col-sm-4'>
						<p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/photos.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_TITLE}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_TITLE}>' /><{$image.title}></p>
						<{if $image.desc}>
							<p class='justify'><{$image.desc}></p>
						<{/if}>
						<p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/size.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_SIZE}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_SIZE}>' /><{$image.size}> kb</p>
						<p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/dimension.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_SIZE}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_SIZE}>' /><{$image.resx}>px / <{$image.resy}>px</p>
						<{if $alb_allowdownload}>
							<p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/download.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_DOWNLOADS}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_DOWNLOADS}>' /><{$image.downloads}></p>
						<{/if}>
						<p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/rate.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_RATINGLIKES}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_RATINGLIKES}>' /><{$image.ratinglikes}> (<{$image.votes}> <{$smarty.const._CO_WGGALLERY_IMAGE_VOTES}>)</p>
						<p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/state<{$image.state}>.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_STATE}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_STATE}>' /><{$image.state_text}></p>
						<p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/date.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_DATE}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_DATE}>' /><{$image.date}></p>
						<p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/submitter.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_SUBMITTER}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_SUBMITTER}>' /><{$image.submitter}></p>
					</div>
					<{if $image.edit || $alb_allowdownload}>
						<div class='wgg-img-panel-row col-sm-12 center'>
							<{if $image.edit}>
								<div class='wgg-album-btntray'>
									<a class='' href='images.php?op=edit&amp;img_id=<{$image.id}>' title='<{$smarty.const._EDIT}>'>
										<img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/edit.png' alt='<{$smarty.const._EDIT}>' /><{$smarty.const._EDIT}>
									</a>
								</div>
								<div class='wgg-album-btntray'>
									<a class='' href='images.php?op=delete&amp;img_id=<{$image.id}>' title='<{$smarty.const._DELETE}>'>
										<img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/delete.png' alt='<{$smarty.const._DELETE}>' /><{$smarty.const._DELETE}>
									</a>
								</div>
							<{/if}>
							<{if $alb_allowdownload}>
								<div class='wgg-album-btntray'>
									<a class='' href='images.php?op=download&amp;img_id=<{$image.id}>' title='<{$smarty.const._CO_WGGALLERY_DOWNLOAD}>'>
										<img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/download.png' alt='<{$smarty.const._CO_WGGALLERY_DOWNLOAD}>' /><{$smarty.const._CO_WGGALLERY_DOWNLOAD}>
									</a>
								</div>
							<{/if}>
						</div>
					<{/if}>
				</div>
			<{/foreach}>
		<{else}>
			<div class=''>
				<div class='errorMsg'><strong><{$smarty.const._CO_WGGALLERY_THEREARENT_IMAGES}></strong></div>
			</div>
		<{/if}>
		<div class='clear'>&nbsp;</div>
		<div class='wgg-album-btntray'>
			<a class='' href='index.php?op=list&amp;alb_for_id=<{$alb_for_id}>' title='<{$smarty.const._CO_WGGALLERY_BACK}>'>
				<img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/back.png' alt='<{$smarty.const._CO_WGGALLERY_BACK}>' /><{$smarty.const._CO_WGGALLERY_BACK}>
			</a>
		</div>
	</div>
</div>

<{if $form}>
	<{$form}>
<{/if}>
<{if $error}>
	<div class='errorMsg'><strong><{$error}></strong></div>
<{/if}>

<{include file='db:wggallery_footer.tpl'}>
