<i id='images'></i>
<{if $images_list|default:''}>
    <{foreach item=image from=$images_list}>
        <{if $bi_nbImagesRow|default:0 == 2}><div class='col-xs-12 col-sm-6'>
        <{elseif $bi_nbImagesRow|default:0 == 3}><div class='col-xs-12 col-sm-4'>
        <{elseif $bi_nbImagesRow|default:0 == 4}><div class='col-xs-12 col-sm-3'>
        <{elseif $bi_nbImagesRow|default:0 == 6}><div class='col-xs-12 col-sm-2'>
        <{else}><div class='col-xs-12 col-sm-12'>
        <{/if}>
            <a class='' href='<{$wggallery_url}>/images.php?op=show&amp;img_id=<{$image.id}>&amp;alb_id=<{$image.albid}>&alb_pid=<{$image.albpid}>' title='<{$smarty.const._CO_WGGALLERY_IMAGE_SHOW}>' target='<{$image_target}>'>
                <img class='img-responsive wgg-album-img center' src='<{$image.thumb}>' alt='<{$image.title}>'>
                <{if $bi_showTitle|default:'' || $bi_showDesc|default:''}>
                    <{if $bi_showTitle|default:''}>
                        <{if $image.title_limited|default:''}>
                            <p class='wgg-block-ititle center'><{$image.title_limited}><p>
                        <{else}>
                            <p class='wgg-block-ititle center'><{$image.title}><p>
                        <{/if}>
                    <{/if}>
                    <{if $bi_showDesc|default:''}>
                        <{if $image.desc_limited|default:''}>
                            <p class='wgg-block-idesc center'><{$image.desc_limited}><p>
                        <{else}>
                            <p class='wgg-block-idesc center'><{$image.desc}><p>
                        <{/if}>
                    <{/if}>
                <{/if}>
            </a>
        </div>
    <{/foreach}>
    <div class="clear"></div>
    <{if $show_more_images|default:''}>
        <div class="wgg-b-album-more center">
            <a class='btn wgfxg-more-btn' href='<{$wggallery_url}>/index.php' title='<{$smarty.const._CO_WGGALLERY_ALBUMS_SHOW}>'><{$smarty.const._CO_WGGALLERY_ALBUMS_SHOW}></a>
        </div>
    <{/if}>
<{/if}>
