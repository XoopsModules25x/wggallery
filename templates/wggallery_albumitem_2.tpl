<{if $album.image}>
    <div class='center'>
        <{if $album.nb_images}>
            <{if $gallery}>
                <a class='' href='<{$wggallery_url}>/gallery.php?op=show&amp;alb_id=<{$album.id}><{if $subm_id}>&amp;subm_id=<{$subm_id}><{/if}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>' target='<{$gallery_target}>' >
                    <img class='img-responsive wgg-album-img' src='<{$album.image}>' alt='<{$album.name}>' />
                </a>
            <{else}>
                <a class='' href='<{$wggallery_url}>/images.php?op=list&amp;alb_id=<{$album.id}>&amp;alb_pid=<{$alb_pid}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'>
                    <img class='img-responsive wgg-album-img' src='<{$album.image}>' alt='<{$album.name}>' />
                </a>
            <{/if}>
        <{else}>
            <img class='img-responsive wgg-album-img' src='<{$album.image}>' alt='<{$album.name}>' />
        <{/if}>
    </div>
<{/if}>
<div class='center wgg-album-name'><{$album.name}></div>
<div class='center wgg-album-desc'><{$album.desc}></div>
<div class='center wgg-album-footer'>
    <{if $album.nb_images}>
        <{if $gallery}>
            <a class='btn btn-default wgg-btn' href='<{$wggallery_url}>/gallery.php?op=show&amp;alb_id=<{$album.id}><{if $subm_id}>&amp;subm_id=<{$subm_id}><{/if}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>' target='<{$gallery_target}>'>
                <span class = "wgg-btn-icon"><img class='' src='<{$wggallery_icon_url_16}>/show.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>' /></span><{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>
            </a>
        <{/if}>
        <a class='btn btn-default wgg-btn' href='<{$wggallery_url}>/images.php?op=list&amp;alb_id=<{$album.id}>&amp;alb_pid=<{$alb_pid}><{if $subm_id}>&amp;subm_id=<{$subm_id}><{/if}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'>
            <span class = "wgg-btn-icon"><img class='' src='<{$wggallery_icon_url_16}>/photos.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGES_COUNT}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_COUNT}>' /></span><{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>
        </a>
    <{else}>
        <span class='btn btn-default wgg-btn'><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>/photos.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGES_COUNT}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_COUNT}>' /><{$album.nb_images}></span>
    <{/if}>
    <{if $album.edit}>
        <a class='btn btn-default wgg-btn' href='albums.php?op=edit&amp;alb_id=<{$album.id}>' title='<{$smarty.const._EDIT}>'>
            <span class = "wgg-btn-icon"><img class='' src='<{$wggallery_icon_url_16}>/edit.png' alt='<{$smarty.const._EDIT}>' /></span><{$smarty.const._EDIT}>
        </a>
        <a class='btn btn-default wgg-btn' href='albums.php?op=delete&amp;alb_id=<{$album.id}>' title='<{$smarty.const._DELETE}>'>
            <span class = "wgg-btn-icon"><img class='' src='<{$wggallery_icon_url_16}>/delete.png' alt='<{$smarty.const._DELETE}>' /></span><{$smarty.const._DELETE}>
        </a>
    <{/if}>
    <{if $album_showsubmitter}>
        <a class='btn btn-default wgg-btn' href='index.php?op=list&amp;subm_id=<{$album.alb_submitter}>' title='<{$smarty.const._CO_WGGALLERY_SUBMITTER}>'>
            <span class = "wgg-btn-icon"><img class='' src='<{$wggallery_icon_url_16}>/submitter.png' alt='<{$smarty.const._CO_WGGALLERY_SUBMITTER}>' /></span><{$album.submitter}>
        </a>
    <{/if}>
</div>