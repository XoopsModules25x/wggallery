<i id='gallery'></i>
<{if $balbums_list|default:''}>
    <{foreach name=album item=album from=$balbums_list}>
        <{if $album.newrow|default:''}><div class="row wgg-row-block"><{/if}>
        <{if $bnbAlbumsRow|default:0 == 2}><div class='col-xs-12 col-sm-6'>
        <{elseif $bnbAlbumsRow|default:0 == 3}><div class='col-xs-12 col-sm-4'>
        <{elseif $bnbAlbumsRow|default:0 == 4}><div class='col-xs-12 col-sm-3'>
        <{elseif $bnbAlbumsRow|default:0 == 6}><div class='col-xs-12 col-sm-2'>
        <{else}><div class='col-xs-12 col-sm-12'>
        <{/if}>
            <{if $ba_template|default:'' == 'hovereffectideas'}>
                <{if $album.newrow|default:''}><div class="grid"><{/if}>
                <figure class="effect-<{$hovereffect}> figure<{$number_cols_album}><{$inblock}>">
                    <img class='img-responsive' src='<{$album.image}>' alt='<{$album.name}>'>
                    <figcaption>
                        <div class="text_figure<{$number_cols_album}><{$inblock}>">
                            <{if $ba_showTitle|default:'' || $ba_showDesc|default:''}>
                                <{if $ba_gallery|default:''}>
                                    <a class='' href='<{$wggallery_url}>/gallery.php?op=show&amp;alb_id=<{$album.id}><{if $subm_id|default:''}>&amp;subm_id=<{$subm_id}><{/if}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>' target='<{$ba_gallery_target}>'>
                                <{else}>
                                    <a class='' href='<{$wggallery_url}>/images.php?op=list&amp;alb_id=<{$album.id}>&amp;alb_pid=<{$album.pid}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'>
                                <{/if}>
                                <{if $ba_showTitle|default:''}>
                                    <{if $album.name_limited|default:''}>
                                        <p class='wgg-block-atitle'><{$album.name_limited}><p>
                                    <{else}>
                                        <p class='wgg-block-atitle'><{$album.name}><p>
                                    <{/if}>
                                <{/if}>
                                <{if $ba_showDesc|default:''}>
                                    <{if $album.desc_limited|default:''}>
                                        <p class='wgg-block-adesc'><{$album.desc_limited}><p>
                                    <{else}>
                                        <p class='wgg-block-adesc'><{$album.desc}><p>
                                    <{/if}>
                                <{/if}>
                                </a>
                            <{/if}>
                        </div>
                        <{if $album.nb_images|default:''}>
                            <{if $ba_gallery|default:''}>
                                <a class='' href='<{$wggallery_url}>/gallery.php?op=show&amp;alb_id=<{$album.id}><{if $subm_id|default:''}>&amp;subm_id=<{$subm_id}><{/if}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>' target='<{$ba_gallery_target}>'></a>
                            <{else}>
                                <a class='' href='<{$wggallery_url}>/images.php?op=list&amp;alb_id=<{$album.id}>&amp;alb_pid=<{$album.pid}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'></a>
                            <{/if}>
                        <{/if}>
                    </figcaption>			
                </figure>
            <{elseif $ba_template|default:'' == 'bcards'}>
                <div class="card">
                    <{if $album.image|default:''}>
                        <{if $album.nb_images|default:''}>
                            <{if $ba_gallery|default:''}>
                                <a class='' href='<{$wggallery_url}>/gallery.php?op=show&amp;alb_id=<{$album.id}><{if $subm_id|default:''}>&amp;subm_id=<{$subm_id}><{/if}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>' target='<{$ba_gallery_target}>' >
                            <{else}>
                                <a class='' href='<{$wggallery_url}>/images.php?op=list&amp;alb_id=<{$album.id}>&amp;alb_pid=<{$album.pid}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'>
                            <{/if}>
                        <{/if}>
                        <img class="card-img-top img-responsive" src="<{$album.image}>" alt="<{$album.name}>" title="<{$album.name}>">
                        <{if $album.nb_images|default:''}></a><{/if}>
                    <{/if}>
                    <div class="card-body">
                        <{if $ba_showTitle|default:'' || $ba_showDesc|default:''}>
                            <{if $ba_gallery|default:''}>
                                <a class='' href='<{$wggallery_url}>/gallery.php?op=show&amp;alb_id=<{$album.id}><{if $subm_id|default:''}>&amp;subm_id=<{$subm_id}><{/if}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>' target='<{$ba_gallery_target}>'>
                            <{else}>
                                <a class='' href='<{$wggallery_url}>/images.php?op=list&amp;alb_id=<{$album.id}>&amp;alb_pid=<{$album.pid}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'>
                            <{/if}>
                            <{if $ba_showTitle|default:''}>
                                <{if $album.name_limited|default:''}>
                                    <p class='wgg-block-atitle center'><{$album.name_limited}><p>
                                <{else}>
                                    <p class='wgg-block-atitle center'><{$album.name}><p>
                                <{/if}>
                            <{/if}>
                            <{if $ba_showDesc|default:''}>
                                <{if $album.desc_limited|default:''}>
                                    <p class='wgg-block-adesc center'><{$album.desc_limited}><p>
                                <{else}>
                                    <p class='wgg-block-adesc center'><{$album.desc}><p>
                                <{/if}>
                            <{/if}>
                            </a>
                        <{/if}>
                        <p class="center">
                            <{if $ba_gallery|default:''}>
                                <a class='btn btn-primary wg-color1' href='<{$wggallery_url}>/gallery.php?op=show&amp;alb_id=<{$album.id}><{if $subm_id|default:''}>&amp;subm_id=<{$subm_id}><{/if}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>' target='<{$ba_gallery_target}>' ><{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}></a>
                            <{else}>
                                <a class='btn btn-primary wg-color1' href='<{$wggallery_url}>/images.php?op=list&amp;alb_id=<{$album.id}>&amp;alb_pid=<{$album.pid}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'><{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}></a>
                            <{/if}>
                        </p>
                    </div>
                </div>           
            <{elseif $ba_template|default:'' == 'simple'}>
                <div class='center'>
                    <{if $album.nb_images|default:''}>
                        <{if $gallery|default:''}>
                            <a class='' href='<{$wggallery_url}>/gallery.php?op=show&amp;alb_id=<{$album.id}><{if $subm_id|default:''}>&amp;subm_id=<{$subm_id}><{/if}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>' target='<{$ba_gallery_target}>' >
                        <{else}>
                            <a class='' href='<{$wggallery_url}>/images.php?op=list&amp;alb_id=<{$album.id}>&amp;alb_pid=<{$album.pid}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'>
                        <{/if}>
                    <{/if}>
                    
                    <div class="simpleContainer">
                        <{if $album.image|default:''}><img class="img-responsive center" src="<{$album.image}>" alt="<{$album.name}>" title="<{$album.name}>"><{/if}>
                        <div class="simpleContent">
                            <{if $ba_showTitle|default:'' || $ba_showDesc|default:''}>
                                <{if $ba_gallery|default:''}>
                                    <a class='' href='<{$wggallery_url}>/gallery.php?op=show&amp;alb_id=<{$album.id}><{if $subm_id|default:''}>&amp;subm_id=<{$subm_id}><{/if}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>' target='<{$ba_gallery_target}>'>
                                <{else}>
                                    <a class='' href='<{$wggallery_url}>/images.php?op=list&amp;alb_id=<{$album.id}>&amp;alb_pid=<{$album.pid}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'>
                                <{/if}>
                                <{if $ba_showTitle|default:''}>
                                    <{if $album.name_limited|default:''}>
                                        <p class='wgg-block-atitle'><{$album.name_limited}><p>
                                    <{else}>
                                        <p class='wgg-block-atitle'><{$album.name}><p>
                                    <{/if}>
                                <{/if}>
                                <{if $ba_showDesc|default:''}>
                                    <{if $album.desc_limited|default:''}>
                                        <p class='wgg-block-adesc'><{$album.desc_limited}><p>
                                    <{else}>
                                        <p class='wgg-block-adesc'><{$album.desc}><p>
                                    <{/if}>
                                <{/if}>
                                </a>
                            <{/if}>
                        </div>
                    </div>
                    <{if $album.nb_images|default:''}></a><{/if}>
                </div>
            <{else}>
                <{if $album.image|default:''}>
                    <div class='center'>
                        <{if $album.nb_images|default:''}>
                            <{if $ba_gallery|default:''}>
                                <a class='' href='<{$wggallery_url}>/gallery.php?op=show&amp;alb_id=<{$album.id}><{if $subm_id|default:''}>&amp;subm_id=<{$subm_id}><{/if}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>' target='<{$ba_gallery_target}>'>
                                    <img class='img-responsive wgg-album-img center' src='<{$album.image}>' alt='<{$album.name}>'></a>
                            <{else}>
                                <a class='' href='<{$wggallery_url}>/images.php?op=list&amp;alb_id=<{$album.id}>&amp;alb_pid=<{$album.pid}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'>
                                    <img class='img-responsive wgg-album-img center' src='<{$album.image}>' alt='<{$album.name}>'></a>
                            <{/if}>
                        <{else}>
                            <img class='img-responsive wgg-album-img center' src='<{$album.image}>' alt='<{$album.name}>'>
                        <{/if}>
                        <{if $ba_showTitle|default:'' || $ba_showDesc|default:''}>
                            <{if $ba_gallery|default:''}>
                                <a class='' href='<{$wggallery_url}>/gallery.php?op=show&amp;alb_id=<{$album.id}><{if $subm_id|default:''}>&amp;subm_id=<{$subm_id}><{/if}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>' target='<{$ba_gallery_target}>'>
                            <{else}>
                                <a class='' href='<{$wggallery_url}>/images.php?op=list&amp;alb_id=<{$album.id}>&amp;alb_pid=<{$album.pid}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'>
                            <{/if}>
                            <{if $ba_showTitle|default:''}>
                                <{if $album.name_limited|default:''}>
                                    <p class='wgg-block-atitle'><{$album.name_limited}><p>
                                <{else}>
                                    <p class='wgg-block-atitle'><{$album.name}><p>
                                <{/if}>
                            <{/if}>
                            <{if $ba_showDesc|default:''}>
                                <{if $album.desc_limited|default:''}>
                                    <p class='wgg-block-adesc'><{$album.desc_limited}><p>
                                <{else}>
                                    <p class='wgg-block-adesc'><{$album.desc}><p>
                                <{/if}>
                            <{/if}>
                            </a>
                        <{/if}>
                    </div>
                <{/if}>
            <{/if}>
        </div>
        <{if $album.linebreak|default:''}>
            <div class='clear'>&nbsp;</div>
        <{/if}>
        <{if $album.linebreak|default:''}></div><{/if}>
    <{/foreach}>
    <div class="clear"></div>
    <{if $show_more_albums|default:''}>
        <div class="wgg-b-album-more center">
            <a class='btn btn-primary wg-color1' href='<{$wggallery_url}>/index.php' title='<{$smarty.const._CO_WGGALLERY_ALBUMS_SHOW}>'><{$smarty.const._CO_WGGALLERY_ALBUMS_SHOW}></a>
        </div>
    <{/if}>
<{/if}>
