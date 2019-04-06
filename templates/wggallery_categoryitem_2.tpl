<{if $category.image}>
    <div class='center'>
        <a class='' href='index.php?op=list&amp;alb_pid=<{$category.id}>' title='<{$smarty.const._CO_WGGALLERY_CATS_ALBUMS}>'>
            <img class='img-responsive wgg-album-img' src='<{$category.image}>' alt='<{$category.name}>' />
        </a>
    </div>
<{/if}>
<div class='center wgg-album-name'><{$category.name}></div>
<div class='center wgg-album-desc'><{$category.desc}></div>
<div class='center wgg-album-footer'>
    <a class='btn btn-default wgg-btn' href='index.php?op=list&amp;alb_pid=<{$category.id}><{if $subm_id}>&amp;subm_id=<{$subm_id}><{/if}>' title='<{$smarty.const._CO_WGGALLERY_CATS_ALBUMS}>'>
        <span class = "wgg-btn-icon"><img class='' src='<{$wggallery_icon_url_16}>/albums.png' alt='<{$smarty.const._CO_WGGALLERY_ALBUMS_COUNT}>' title='<{$smarty.const._CO_WGGALLERY_ALBUMS_COUNT}>' /></span>
        <{$smarty.const._CO_WGGALLERY_CATS_ALBUMS}>
    </a>
    <{if $category.edit}>
        <a class='btn btn-default wgg-btn' href='albums.php?op=edit&amp;alb_id=<{$category.id}>' title='<{$smarty.const._EDIT}>'>
            <span class = "wgg-btn-icon"><img class='' src='<{$wggallery_icon_url_16}>/edit.png' alt='<{$smarty.const._EDIT}>' /></span><{$smarty.const._EDIT}>
        </a>
        <a class='btn btn-default wgg-btn' href='albums.php?op=delete&amp;alb_id=<{$category.id}>' title='<{$smarty.const._DELETE}>'>
            <span class = "wgg-btn-icon"><img class='' src='<{$wggallery_icon_url_16}>/delete.png' alt='<{$smarty.const._DELETE}>' /></span><{$smarty.const._DELETE}>
        </a>
    <{/if}>
    <{if $album_showsubmitter}>
        <a class='btn btn-default wgg-btn' href='index.php?op=list&amp;subm_id=<{$category.alb_submitter}>' title='<{$smarty.const._CO_WGGALLERY_SUBMITTER}>'>
            <span class = "wgg-btn-icon"><img class='' src='<{$wggallery_icon_url_16}>/submitter.png' alt='<{$smarty.const._CO_WGGALLERY_SUBMITTER}>' /></span><{$category.submitter}>
        </a>
    <{/if}>
</div>