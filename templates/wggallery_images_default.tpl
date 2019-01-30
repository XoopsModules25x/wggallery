<{include file='db:wggallery_header.tpl'}>

<div class='panel panel-<{$panel_type}>'>
	<{if $showlist}>
        <div class='panel-heading wgg-imgindex-header'><{$smarty.const._CO_WGGALLERY_IMAGES_TITLE}> <{$alb_name}></div>
        <div class=' panel-body'>
            <{if $images}>
                <{foreach item=image from=$images}>
                    <div class='row wgg-img-panel wgg-image-list'>
                        <div class='wgg-img-panel-row col-sm-8'>
                            <{if $image.medium}>
                                <div class='center'><img class='img-responsive wgg-img' src='<{$image.medium}>' alt='<{$image.title}>'></div>
                            <{/if}>
                        </div>
                        <div class='wgg-img-panel-row col-sm-4'>
                            <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/photos.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_TITLE}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_TITLE}>'><{$image.title}></p>
                            <{if $image.desc}>
                                <p class='justify'><{$image.desc}></p>
                            <{/if}>
                            <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/size.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_SIZE}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_SIZE}>'><{$image.size}> kb</p>
                            <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/dimension.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_SIZE}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_SIZE}>'><{$image.resx}>px / <{$image.resy}>px</p>
                            <{if $img_allowdownload}>
                                <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/download.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_DOWNLOADS}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_DOWNLOADS}>'><{$image.downloads}></p>
                            <{/if}>
                            <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/rate.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_RATINGLIKES}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_RATINGLIKES}>'><{$image.ratinglikes}> (<{$image.votes}> <{$smarty.const._CO_WGGALLERY_IMAGE_VOTES}>)</p>
                            <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/state<{$image.state}>.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_STATE}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_STATE}>'><{$image.state_text}></p>
                            <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/date.png' alt='<{$smarty.const._CO_WGGALLERY_DATE}>' title='<{$smarty.const._CO_WGGALLERY_DATE}>'><{$image.date}></p>
                            <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/submitter.png' alt='<{$smarty.const._CO_WGGALLERY_SUBMITTER}>' title='<{$smarty.const._CO_WGGALLERY_SUBMITTER}>'><{$image.submitter}></p>
                        </div>
                        <div class='wgg-img-panel-row col-sm-12 center'>
                            <a class='btn btn-default wgg-btn' href='<{$wggallery_url}>/images.php?op=show&amp;img_id=<{$image.id}>&amp;alb_id=<{$image.albid}>&amp;start=<{$start}>&amp;limit=<{$limit}>&amp;img_submitter=<{$img_submitter}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_SHOW}>'>
                                <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/show.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_SHOW}>'><{$smarty.const._CO_WGGALLERY_IMAGE_SHOW}>
                            </a>
                            <{if $permAlbumEdit}>
                                <a class='btn btn-default wgg-btn' href='<{$wggallery_url}>/images.php?op=edit&amp;img_id=<{$image.id}>' title='<{$smarty.const._EDIT}>'>
                                    <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/edit.png' alt='<{$smarty.const._EDIT}>'><{$smarty.const._EDIT}>
                                </a>
                                <a class='btn btn-default wgg-btn' href='<{$wggallery_url}>/images.php?op=delete&amp;img_id=<{$image.id}>&amp;alb_id=<{$image.albid}>' title='<{$smarty.const._DELETE}>'>
                                    <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/delete.png' alt='<{$smarty.const._DELETE}>'><{$smarty.const._DELETE}>
                                </a>
                            <{/if}>
                            <{if $img_allowdownload}>
                                <a class='btn btn-default wgg-btn' href='<{$wggallery_url}>/download.php?op=default&amp;img_id=<{$image.id}>' title='<{$smarty.const._CO_WGGALLERY_DOWNLOAD}>'>
                                    <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/download.png' alt='<{$smarty.const._CO_WGGALLERY_DOWNLOAD}>'><{$smarty.const._CO_WGGALLERY_DOWNLOAD}>
                                </a>
                            <{/if}>
                        </div>
                    </div>
                <{/foreach}>
            <{else if $showlist}>
                <div class=''>
                    <div class='errorMsg'><strong><{$smarty.const._CO_WGGALLERY_THEREARENT_IMAGES}></strong></div>
                </div>
            <{/if}>
            <div class='clear'>&nbsp;</div>
            <div class='wgg-goback'>
                <a class='btn btn-default wgg-btn' href='<{if $ref}><{$ref}><{else}>index<{/if}>.php?op=list&amp;alb_id=<{$alb_id}>&amp;alb_pid=<{$alb_pid}>' title='<{$smarty.const._CO_WGGALLERY_BACK}>'>
                    <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/back.png' alt='<{$smarty.const._CO_WGGALLERY_BACK}>'><{$smarty.const._CO_WGGALLERY_BACK}>
                </a>
                <{if $permAlbumEdit}>
                    <a class='btn btn-default wgg-btn' href='albums.php?op=edit&amp;alb_id=<{$alb_id}>' title='<{$smarty.const._CO_WGGALLERY_ALBUM_EDIT}>'>
                        <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/edit.png' alt='<{$smarty.const._CO_WGGALLERY_ALBUM_EDIT}>'><{$smarty.const._CO_WGGALLERY_ALBUM_EDIT}>
                    </a>
                    <a class='btn btn-default wgg-btn' href='images.php?op=manage&amp;alb_id=<{$alb_id}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_MANAGE}>'>
                        <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/images.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_MANAGE}>'><{$smarty.const._CO_WGGALLERY_IMAGE_MANAGE}>
                    </a>
                    <a class='btn btn-default wgg-btn' href='upload.php?op=list&amp;alb_id=<{$alb_id}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_UPLOAD}>'>
                        <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/upload.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGES_UPLOAD}>'><{$smarty.const._CO_WGGALLERY_IMAGES_UPLOAD}>
                    </a>
                <{/if}>
            </div>
        </div>
        <div class='clear'>&nbsp;</div>
            <{if $pagenav}>
                <div class='xo-pagenav floatright'><{$pagenav}></div>
                <div class='clear spacer'></div>
            <{/if}>
        </div>
    <{/if}>
    <{if $showimage}>
        <div class='wgg-img-panel-row col-xs-12 col-sm-12 col-md-12 col-lg-12 center'><img class='img-responsive wgg-img' src='<{$file}>' alt='<{$image.title}>'></div>
        <div class='wgg-img-panel-row col-xs-12 col-sm-6 col-md-6 col-lg6'>
            <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/photos.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_TITLE}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_TITLE}>'><{$image.title}></p>
            <{if $image.desc}>
                <p class='justify'><{$image.desc}></p>
            <{/if}>
        </div>
        <div class='wgg-img-panel-row col-xs-12 col-sm-6 col-md-6 col-lg6'>          
            <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/photos.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_TITLE}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_TITLE}>'><{$image.title}></p>
            <{if $image.desc}>
                <p class='justify'><{$image.desc}></p>
            <{/if}>
            <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/size.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_SIZE}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_SIZE}>'><{$image.size}> kb</p>
            <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/dimension.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_SIZE}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_SIZE}>'><{$image.resx}>px / <{$image.resy}>px</p>
            <{if $img_allowdownload}>
                <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/download.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_DOWNLOADS}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_DOWNLOADS}>'><{$image.downloads}></p>
            <{/if}>
            <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/rate.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_RATINGLIKES}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_RATINGLIKES}>'><{$image.ratinglikes}> (<{$image.votes}> <{$smarty.const._CO_WGGALLERY_IMAGE_VOTES}>)</p>
            <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/state<{$image.state}>.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_STATE}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_STATE}>'><{$image.state_text}></p>
            <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/date.png' alt='<{$smarty.const._CO_WGGALLERY_DATE}>' title='<{$smarty.const._CO_WGGALLERY_DATE}>'><{$image.date}></p>
            <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/submitter.png' alt='<{$smarty.const._CO_WGGALLERY_SUBMITTER}>' title='<{$smarty.const._CO_WGGALLERY_SUBMITTER}>'><{$image.submitter}></p>
        </div>
        <div class='wgg-goback'>
            <a class='btn btn-default wgg-btn' href='images.php?op=list&amp;alb_id=<{$alb_id}>&amp;alb_pid=<{$alb_pid}>&amp;start=<{$start}>&amp;limit=<{$limit}>&amp;img_submitter=<{$img_submitter}>' title='<{$smarty.const._CO_WGGALLERY_BACK}>'>
                <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/back.png' alt='<{$smarty.const._CO_WGGALLERY_BACK}>'><{$smarty.const._CO_WGGALLERY_BACK}>
            </a>
        </div>
    <{/if}>
</div>

<{if $form}>
	<{$form}>
<{/if}>
<{if $error}>
	<div class='errorMsg'><strong><{$error}></strong></div>
<{/if}>

<{include file='db:wggallery_footer.tpl'}>
