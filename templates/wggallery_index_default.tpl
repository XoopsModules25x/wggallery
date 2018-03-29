<{include file='db:wggallery_header.tpl'}>

<div class='panel panel-<{$panel_type}>'>
	<div class='panel-heading'><{$smarty.const._MA_WGGALLERY_ALBUMS_TITLE}></div>
	<div class='panel-body'>
		<{if $albums}>
			<{foreach item=album from=$albums}>
				<div class='col-sm-6 wgg-album-panel'>
					<{if $album.image}>
						<div class='center'><img class='img-responsive wgg-album-img' src='<{$album.image}>' alt='<{$album.name}>' /></div>
					<{/if}>
					<div class='center wgg-album-name'><{$album.name}></div>
					<div class='center wgg-album-desc'><{$album.desc}></div>
					<div class='center wgg-album-footer'>
						<div class='wgg-album-btntray'>
							<img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/photos.png' alt='<{$smarty.const._AM_WGGALLERY_IMAGE_COUNT}>' title='<{$smarty.const._AM_WGGALLERY_IMAGE_COUNT}>' /><span><{$album.nb_images}></span>
						</div>
						<div class='wgg-album-btntray'>
							<a class='' href='images.php?op=list&amp;alb_id=<{$album.id}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'>
								<img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/index.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>' /><{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>
							</a>
						</div>		
						<{if $album.edit}>
							<div class='wgg-album-btntray'>
								<a class='' href='albums.php?op=edit&amp;alb_id=<{$album.id}>' title='<{$smarty.const._EDIT}>'>
									<img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/edit.png' alt='<{$smarty.const._EDIT}>' /><{$smarty.const._EDIT}>
								</a>
							</div>
							<div class='wgg-album-btntray'>
								<a class='' href='albums.php?op=delete&amp;alb_id=<{$album.id}>' title='<{$smarty.const._DELETE}>'>
									<img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/delete.png' alt='<{$smarty.const._DELETE}>' /><{$smarty.const._DELETE}>
								</a>
							</div>
						<{/if}>
						<{if $album_showsubmitter}>
							<div class='wgg-album-btntray'>
								<a class='' href='submitter.php?op=list&amp;submitter_id=<{$album.alb_submitter}>' title='<{$smarty.const._CO_WGGALLERY_ALBUM_SUBMITTER}>'>
									<img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/submitter.png' alt='<{$smarty.const._CO_WGGALLERY_ALBUM_SUBMITTER}>' /><{$album.submitter}>
								</a>
							</div>
						<{/if}>
					</div>

					
				</div>
			<{/foreach}>
			<div class='clear'>&nbsp;</div>
			<{if $pagenav_albums}>
				<div class='xo-pagenav floatright'><{$pagenav_albums}></div>
				<div class='clear spacer'></div>
			<{/if}>
		<{/if}>
		<{if $categories}>
			<{foreach item=category from=$categories}>
				<div class='col-sm-6 wgg-album-panel'>
					<{if $category.image}>
						<div class='center'><img class='img-responsive wgg-album-img' src='<{$category.image}>' alt='<{$category.name}>' /></div>
					<{/if}>
					<div class='center wgg-album-name'><{$category.name}></div>
					<div class='center wgg-album-desc'><{$category.desc}></div>
					<div class='center wgg-album-footer'>
						<div class='wgg-album-btntray'>
							<img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/photos.png' alt='<{$smarty.const._AM_WGGALLERY_IMAGE_COUNT}>' title='<{$smarty.const._AM_WGGALLERY_IMAGE_COUNT}>' /><span><{$category.nb_images}></span>
						</div>
						<{if $gallery}>
						<div class='wgg-album-btntray'>
							<a class='' href='gallery.php?op=show&amp;alb_id=<{$category.id}>&amp;type=<{$gallery_type}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>'>
								<img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/show.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>' /><{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>
							</a>
						</div>
						<{/if}>
						<div class='wgg-album-btntray'>
							<a class='' href='images.php?op=list&amp;alb_id=<{$category.id}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'>
								<img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/index.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>' /><{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>
							</a>
						</div>		
						<{if $category.edit}>
							<div class='wgg-album-btntray'>
								<a class='' href='albums.php?op=edit&amp;alb_id=<{$category.id}>' title='<{$smarty.const._EDIT}>'>
									<img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/edit.png' alt='<{$smarty.const._EDIT}>' /><{$smarty.const._EDIT}>
								</a>
							</div>
							<div class='wgg-album-btntray'>
								<a class='' href='albums.php?op=delete&amp;alb_id=<{$category.id}>' title='<{$smarty.const._DELETE}>'>
									<img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/delete.png' alt='<{$smarty.const._DELETE}>' /><{$smarty.const._DELETE}>
								</a>
							</div>
						<{/if}>
						<{if $album_showsubmitter}>
							<div class='wgg-album-btntray'>
								<a class='' href='submitter.php?op=list&amp;submitter_id=<{$category.alb_submitter}>' title='<{$smarty.const._CO_WGGALLERY_ALBUM_SUBMITTER}>'>
									<img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/submitter.png' alt='<{$smarty.const._CO_WGGALLERY_ALBUM_SUBMITTER}>' /><{$category.submitter}>
								</a>
							</div>
						<{/if}>
					</div>

					
				</div>
			<{/foreach}>
			<div class='clear'>&nbsp;</div>
			<{if $pagenav_cats}>
				<div class='xo-pagenav floatright'><{$pagenav_cats}></div>
				<div class='clear spacer'></div>
			<{/if}>
		<{/if}>		
		
	</div>
</div>

<{include file='db:wggallery_footer.tpl'}>
