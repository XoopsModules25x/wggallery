<{include file='db:wggallery_header.tpl'}>

<{if $form1|default:''}>
	<{$form1}>
<{/if}>
<{if $form2|default:''}>
	<{$form2}>
<{/if}>
<{if $error|default:''}>
	<div class='errorMsg'><strong><{$error}></strong></div>
<{/if}>

<{if $showlist|default:''}>
    <div class='panel panel-<{$panel_type|default:''}>'>
        <div class='panel-heading wgg-imgindex-header'><h3><{$smarty.const._MA_WGGALLERY_SEARCH_RESULT}></h3></div>
        <div class=' panel-body'>
            <{if $pagenav|default:''}>
                <div class='xo-pagenav floatright'><{$pagenav}></div>
                <div class='clear spacer'></div>
            <{/if}>

            <{if $images|default:''}>
                <{foreach item=image from=$images}>
                    <div class='row wgg-img-panel wgg-image-list'>
                        <div class='wgg-img-panel-row col-sm-8'>
                            <{if $image.medium|default:''}>
                                <div class='center'><img id='image_<{$image.id}>' class='img-responsive wgg-img' src='<{$image.medium}>#<{$random}>' alt='<{$image.title}>'></div>
                            <{/if}>
                        </div>
                        <div class='wgg-img-panel-row col-sm-4'>
                            <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>photos.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_TITLE}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_TITLE}>'><{$image.title}></p>
                            <{if $image.desc|default:''}>
                                <p class='justify'><{$image.desc}></p>
                            <{/if}>
                            <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>size.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_SIZE}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_SIZE}>'><{$image.size}> kb</p>
                            <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>dimension.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_SIZE}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_SIZE}>'><{$image.resx}>px / <{$image.resy}>px</p>
                            <{if $img_allowdownload|default:''}>
                                <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>download.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_DOWNLOADS}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_DOWNLOADS}>'><{$image.downloads}></p>
                            <{/if}>
							<{if $permAlbumEdit|default:''}>
								<p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>state<{$image.state}>.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_STATE}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_STATE}>'><{$image.state_text}></p>
                            <{/if}>
							<p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>date.png' alt='<{$smarty.const._CO_WGGALLERY_DATE}>' title='<{$smarty.const._CO_WGGALLERY_DATE}>'><{$image.date}></p>
                            <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>views.png' alt='<{$smarty.const._CO_WGGALLERY_VIEWS}>' title='<{$smarty.const._CO_WGGALLERY_VIEWS}>'><{$image.views}></p>
                            <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>submitter.png' alt='<{$smarty.const._CO_WGGALLERY_SUBMITTER}>' title='<{$smarty.const._CO_WGGALLERY_SUBMITTER}>'><{$image.submitter}></p>
                            <{if $use_categories|default:'' && $image.cats_list|default:''}>
								<p class='wgg-cats'><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>categories.png' alt='<{$smarty.const._CO_WGGALLERY_CATS}>' title='<{$smarty.const._CO_WGGALLERY_CATS}>'><{$image.cats_list}></p>
                            <{/if}>
                            <{if $use_tags|default:'' && $image.tags|default:''}>
								<p class='wgg-tags'><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>tags.png' alt='<{$smarty.const._CO_WGGALLERY_TAGS}>' title='<{$smarty.const._CO_WGGALLERY_TAGS}>'><{$image.tags}></p>
                            <{/if}>
                            <{if $rating|default:0 > 0}>
                                <{if $rating_5stars|default:'' || $rating_10stars|default:''}>
                                    <p><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>rate.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_RATINGLIKES}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_RATINGLIKES}>'><{$image.ratinglikes}> (<{$image.votes}> <{$smarty.const._CO_WGGALLERY_IMAGE_VOTES}>)</p>
                                <{/if}>
                                <{if $rating_likes|default:''}>
                                    <p>
                                        <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>like.png' alt='<{$smarty.const._MA_WGGALLERY_RATING_LIKE}>' title='<{$smarty.const._MA_WGGALLERY_RATING_LIKE}>'>(<{$image.rating.likes}>)
                                        <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>dislike.png' alt='<{$smarty.const._MA_WGGALLERY_RATING_DISLIKE}>' title='<{$smarty.const._MA_WGGALLERY_RATING_DISLIKE}>'> (<{$image.rating.dislikes}>)    
                                    </p>
                                <{/if}>
							<{/if}>
                            <{if $show_exif|default:''}>
								<p class='wgg-comcount'>
                                    <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>exif.png' alt='<{$smarty.const._CO_WGGALLERY_EXIF}>' title='<{$smarty.const._CO_WGGALLERY_EXIF}>'>
                                    <{if $image.exif|default:''}><img src="<{$wggallery_icon_url_16}>on.png" alt="_YES"><{else}><img src="<{$wggallery_icon_url_16}>0.png" alt="_NO"><{/if}>
                                </p>
                            <{/if}>
                            <{if $image.com_show|default:''}>
								<p class='wgg-comcount'><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>comments.png' alt='<{$smarty.const._CO_WGGALLERY_COMMENTS}>' title='<{$smarty.const._CO_WGGALLERY_COMMENTS}>'><{$image.com_count_text}></p>
                            <{/if}>
                        </div>
                        <div class='wgg-img-panel-row col-sm-12 center'>
                            <a class='btn btn-default wgg-btn' href='<{$wggallery_url}>/images.php?op=show&amp;img_id=<{$image.id}>&amp;alb_id=<{$image.albid}>&amp;start=<{$start}>&amp;limit=<{$limit}>&amp;img_submitter=<{$img_submitter}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_SHOW}>' target='<{$image_target}>'>
                                <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>show.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_SHOW}>'><{if $displayButtonText|default:false}><{$smarty.const._CO_WGGALLERY_IMAGE_SHOW}><{/if}></a>
                            <{if $permAlbumEdit|default:''}>
                                <a class='btn btn-default wgg-btn' href='<{$wggallery_url}>/images.php?op=edit&amp;img_id=<{$image.id}>' title='<{$smarty.const._EDIT}>'>
                                    <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>edit.png' alt='<{$smarty.const._EDIT}>'><{if $displayButtonText|default:false}><{$smarty.const._EDIT}><{/if}></a>
                                <a class='btn btn-default wgg-btn' href='<{$wggallery_url}>/images.php?op=delete&amp;img_id=<{$image.id}>&amp;alb_id=<{$image.albid}>&amp;alb_pid=<{$alb_pid}>' title='<{$smarty.const._DELETE}>'>
                                    <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>delete.png' alt='<{$smarty.const._DELETE}>'><{if $displayButtonText|default:false}><{$smarty.const._DELETE}><{/if}></a>
                                <a class='btn btn-default wgg-btn' href='images.php?op=rotate&amp;dir=left&amp;img_id=<{$image.id}>&amp;alb_id=<{$alb_id}>&amp;start=<{$start}>&amp;limit=<{$limit}>&amp;img_submitter=<{$img_submitter}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_ROTATE_LEFT}>'>
                                    <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>rotate_left.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_ROTATE_LEFT}>'><{if $displayButtonText|default:false}><{$smarty.const._CO_WGGALLERY_IMAGE_ROTATE_LEFT}><{/if}></a>
                                <a class='btn btn-default wgg-btn' href='images.php?op=rotate&amp;dir=right&amp;img_id=<{$image.id}>&amp;alb_id=<{$alb_id}>&amp;start=<{$start}>&amp;limit=<{$limit}>&amp;img_submitter=<{$img_submitter}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_ROTATE_RIGHT}>'>
                                    <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>rotate_right.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGE_ROTATE_RIGHT}>'><{if $displayButtonText|default:false}><{$smarty.const._CO_WGGALLERY_IMAGE_ROTATE_RIGHT}><{/if}></a>
                            <{/if}>
                            <{if $img_allowdownload|default:''}>
                                <a class='btn btn-default wgg-btn' href='<{$wggallery_url}>/download.php?op=default&amp;img_id=<{$image.id}>' title='<{$smarty.const._CO_WGGALLERY_DOWNLOAD}>'>
                                    <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>download.png' alt='<{$smarty.const._CO_WGGALLERY_DOWNLOAD}>'><{if $displayButtonText|default:false}><{$smarty.const._CO_WGGALLERY_DOWNLOAD}><{/if}></a>
                            <{/if}>
                        </div>
                    </div>
                <{/foreach}>
            <{else}>
                <div class=''>
                    <div class='errorMsg'><strong><{$smarty.const._MA_WGGALLERY_SEARCH_NO_RESULT}></strong></div>
                </div>
            <{/if}>
        </div>
        <div class='clear'>&nbsp;</div>
        <{if $pagenav|default:''}>
            <div class='xo-pagenav floatright'><{$pagenav}></div>
            <div class='clear spacer'></div>
        <{/if}>
    </div>
<{/if}>


<{include file='db:wggallery_footer.tpl'}>
