<figure class="effect-<{$hovereffect}> figure<{$number_cols_cat}>">
    <img class='' src='<{$category.image}>' alt='<{$category.name}>' />
    <figcaption>
        <div class="text_figure<{$number_cols_cat}>">
            <h2><{$category.name}></h2>
            <{if $category.desc}><p><{$category.desc}></p><{/if}>
        </div>
        <a class='' href='index.php?op=list&amp;alb_for_id=<{$category.id}>&amp;subm_id=<{$subm_id}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'></a>
    </figcaption>			
</figure>