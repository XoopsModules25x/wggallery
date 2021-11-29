
<div class='row wgg-album-panel'>
    <div class='col'>
        <{if $album.image}>
            <div class='center'>
                <{if $album.nb_images|default:0 > 0}>
                    <{if $gallery|default:false}>
                        <a class='' href='<{$wggallery_url}>/gallery.php?op=show&amp;alb_id=<{$album.id}><{if $subm_id|default:false}>&amp;subm_id=<{$subm_id}><{/if}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>' target='<{$gallery_target}>'>
                            <img class='img-fluid wgg-album-img' src='<{$album.image}>' alt='<{$album.name}>'></a>
                    <{else}>
                        <a class='' href='<{$wggallery_url}>/images.php?op=list&amp;alb_id=<{$album.id}>&amp;alb_pid=<{$alb_pid}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'>
                            <img class='img-fluid wgg-album-img' src='<{$album.image}>' alt='<{$album.name}>'></a>
                    <{/if}>
                <{else}>
                    <img class='img-fluid wgg-album-img' src='<{$album.image}>' alt='<{$album.name}>'>
                <{/if}>
            </div>
        <{/if}>
    </div>
    <div class='col'>
        <div class='center wgg-album-name'><{$album.name}></div>
        <div class='center wgg-album-desc'><{$album.desc|default:''}></div>
        <div class='center wgg-album-footer'>
            <{if $album.nb_images|default:0 > 0}>
                <{if $gallery|default:false}>
                    <a class='btn btn-secondary wgg-btn' href='<{$wggallery_url}>/gallery.php?op=show&amp;alb_id=<{$album.id}>&amp;alb_pid=<{$album.pid}><{if $subm_id|default:false}>&amp;subm_id=<{$subm_id}><{/if}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>' target='<{$gallery_target}>'>
                        <span class = "wgg-btn-icon"><img class='' src='<{$wggallery_icon_url_16}>show.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>'></span><{if $displayButtonText|default:false}><{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}><{/if}></a>
                <{/if}>
                <a class='btn btn-secondary wgg-btn' href='<{$wggallery_url}>/images.php?op=list&amp;alb_id=<{$album.id}>&amp;alb_pid=<{$alb_pid}><{if $subm_id|default:false}>&amp;subm_id=<{$subm_id}><{/if}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'>
                    <span class = "wgg-btn-icon"><img class='' src='<{$wggallery_icon_url_16}>photos.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGES_COUNT}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_COUNT}>'></span><{if $displayButtonText|default:false}><{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}><{/if}></a>
            <{else}>
                <a disabled class='disabled btn btn-secondary wgg-btn' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'>
                    <span class='wgg-btn'><img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>photos.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGES_COUNT}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_COUNT}>'><{$smarty.const._CO_WGGALLERY_ALBUM_NO_IMAGES}></span></a>
            <{/if}>
            <{if $album.edit|default:false}>
                <a class='btn btn-secondary wgg-btn' href='albums.php?op=edit&amp;alb_id=<{$album.id}>' title='<{$smarty.const._EDIT}>'>
                    <span class = "wgg-btn-icon"><img class='' src='<{$wggallery_icon_url_16}>edit.png' alt='<{$smarty.const._EDIT}>'></span><{if $displayButtonText|default:false}><{$smarty.const._EDIT}><{/if}></a>
                <a class='btn btn-secondary wgg-btn' href='albums.php?op=delete&amp;alb_id=<{$album.id}>' title='<{$smarty.const._DELETE}>'>
                    <span class = "wgg-btn-icon"><img class='' src='<{$wggallery_icon_url_16}>delete.png' alt='<{$smarty.const._DELETE}>'></span><{if $displayButtonText|default:false}><{$smarty.const._DELETE}><{/if}></a>
            <{/if}>
            <{if $album_showsubmitter|default:false}>
                <a class='btn btn-secondary wgg-btn' href='index.php?op=list&amp;subm_id=<{$album.alb_submitter}>' title='<{$smarty.const._CO_WGGALLERY_SUBMITTER}>'>
                    <span class = "wgg-btn-icon"><img class='' src='<{$wggallery_icon_url_16}>submitter.png' alt='<{$smarty.const._CO_WGGALLERY_SUBMITTER}>'></span><{if $displayButtonText|default:false}><{$album.submitter}><{/if}></a>
            <{/if}>
            <{if $album.download}>
                <a class='btn btn-secondary wgg-btn' href='<{$wggallery_url}>/download.php?op=album&amp;alb_id=<{$album.id}>' title='<{$smarty.const._CO_WGGALLERY_DOWNLOAD_ALB}>'>
                    <img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>download.png' alt='<{$smarty.const._CO_WGGALLERY_DOWNLOAD_ALB}>'><{if $displayButtonText|default:false}><{$smarty.const._CO_WGGALLERY_DOWNLOAD_ALB}><{/if}></a>
            <{/if}>
        </div>
    </div>
</div>