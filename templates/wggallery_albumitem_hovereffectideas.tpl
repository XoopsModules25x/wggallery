<figure class="effect-<{$hovereffect}>">
    <{if $album.nb_images}>
        <{if $gallery}>
            <a class='' href='gallery.php?op=show&amp;alb_id=<{$album.id}>&amp;subm_id=<{$subm_id}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>'>
                <img class='' src='<{$album.image}>' alt='<{$album.name}>' />
            </a>
        <{else}>
            <a class='' href='images.php?op=list&amp;alb_id=<{$album.id}>&amp;alb_for_id=<{$alb_for_id}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'>
                <img class='' src='<{$album.image}>' alt='<{$album.name}>' />
            </a>
        <{/if}>
    <{else}>
        <img class='' src='<{$album.image}>' alt='<{$album.name}>' />
    <{/if}>
    <figcaption>
        <div>
            <h2><{$album.name}></h2>
            <{if $album.desc}><p><{$album.desc}></p><{/if}>
        </div>
        <a href="#">View more</a>
    </figcaption>			
</figure>