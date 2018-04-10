<{include file='db:wggallery_header.tpl'}>

<{if $albums_list}>
	<div class='panel panel-<{$panel_type}>'>
		<div class='panel-heading'><{$smarty.const._CO_WGGALLERY_ALBUMS_TITLE}></div>
		<div class='panel-body'>
			<{foreach item=album from=$albums_list}>
				<div class='row wgg-album-list'>
					<div class='col-sm-4'><img class='img-responsive wgg-album-img' src='<{$album.image}>' alt='albums' style='max-width:200px'/></div>
					<div class='col-sm-4'>
						<p class='wgg-album-name'><{$album.name}></p>
						<p class='wgg-album-desc'><{$album.desc}></p>
					</div>
					<div class='col-sm-4'>
						<p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/state<{$album.state}>.png' alt='<{$album.state_text}>' /><{$album.state_text}></p>
                        <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/photos.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGES_COUNT}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_COUNT}>' /><span><{$album.nb_images}></span></p>
						<p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/date.png' alt='<{$album.date}>' /><{$album.date}></p>
						<p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/submitter.png' alt='<{$album.submitter}>' /><{$album.submitter}></p>
					</div>
					<div class='col-sm-12 center'>
                        <{if $album.edit}>
                            <a class='btn btn-default' href='albums.php?op=edit&amp;alb_id=<{$album.id}>' title='<{$smarty.const._CO_WGGALLERY_ALBUM_EDIT}>'>
                                <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/edit.png' alt='<{$smarty.const._CO_WGGALLERY_ALBUM_EDIT}>' /><{$smarty.const._CO_WGGALLERY_ALBUM_EDIT}>
                            </a>
                            <a class='btn btn-default' href='albums.php?op=delete&amp;alb_id=<{$album.id}>' title='<{$smarty.const._DELETE}>'>
                                <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/delete.png' alt='<{$smarty.const._DELETE}>' /><{$smarty.const._DELETE}>
                            </a>
                            <a class='btn btn-default' href='upload.php?op=list&amp;alb_id=<{$album.id}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_UPLOAD}>'>
                                <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/upload.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGES_UPLOAD}>' /><{$smarty.const._CO_WGGALLERY_IMAGES_UPLOAD}>
                            </a>
                        <{/if}>
						<{if $album.nb_images}>
							<{if $gallery}>
								<a class='btn btn-default' href='gallery.php?op=show&amp;alb_id=<{$album.id}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>'>
									<img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/show.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>' /><{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>
								</a>
							<{/if}>
							<a class='btn btn-default' href='images.php?op=list&amp;alb_id=<{$album.id}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'>
								<img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/index.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>' /><{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>
							</a>
						<{/if}>
					</div>
				</div>
			<{/foreach}>
		</div>
	</div>
	<div class='clear'>&nbsp;</div>
	<{if $pagenav}>
		<div class='xo-pagenav floatright'><{$pagenav}></div>
		<div class='clear spacer'></div>
	<{/if}>
<{/if}>

<{if $form}>
	<{$form}>
<{/if}>
<{if $error}>
	<div class='errorMsg'><strong><{$error}></strong></div>
<{/if}>
<{if $btn_new}>
	<div class='center'>
		<a class='btn btn-default' href='albums.php?op=new' title='<{$btn_new}>'>
			<img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/add.png' alt='<{$btn_new}>' /><{$btn_new}>
		</a>
	</div>
<{/if}>

<{include file='db:wggallery_footer.tpl'}>
