<{if $albums_list}>
    <{if $container == 1}><div class='container'><div class='row'><{/if}>
    <{foreach item=album from=$albums_list}>
        <{if $numb_albums == 3}><div class='col-sm-4'>
        <{elseif $numb_albums == 4}><div class='col-sm-3'>
        <{elseif $numb_albums == 6}><div class='col-sm-2'>
        <{else}><div class='col-sm-6'>
        <{/if}>
            <{if $gallery == 1}>
                <a class='wgg-b-album-link' href='<{$wggallery_url}>/gallery.php?op=show&amp;alb_id=<{$album.id}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>'>
            <{else}>
                <a class='wgg-b-album-link' href='<{$wggallery_url}>/images.php?op=list&amp;alb_id=<{$album.id}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'>
            <{/if}>
            <p><img class='img-responsive wgg-b-album-img' src='<{$album.image}>' alt='albums'/></p>
            <p class='wgg-b-album-name'><{if $album.name_limited}><{$album.name_limited}><{else}><{$album.name}><{/if}></p>
            <{if $album.desc}><p class='wgg-b-album-desc'><{$album.desc}></p><{/if}>
            </a>
        </div>
    <{/foreach}>
    <div class="clear"></div>
    <{if $show_more_albums}>
        <div class="wgg-b-album-more center">
            <a class='btn wgfxg-more-btn' href='<{$wggallery_url}>/albums.php' title='<{$smarty.const._CO_WGGALLERY_ALBUMS_SHOW}>'><{$smarty.const._CO_WGGALLERY_ALBUMS_SHOW}></a>
        </div>
    <{/if}>
    <{if $container == 1}></div></div><{/if}>
<{/if}>
