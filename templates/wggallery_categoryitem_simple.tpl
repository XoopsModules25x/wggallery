<a class='' href='index.php?op=list&amp;alb_pid=<{$category.id}>' title='<{$smarty.const._CO_WGGALLERY_CATS_ALBUMS}>'>
<{if $category.image}>
    <div class="simpleContainer center">
            <img class="img-responsive" src="<{$category.image}>" alt="<{$category.name}>" title="<{$category.name}>">
            <div class="simpleContent">
                <{if $showTitle}><p><{$category.name}></p><{/if}>
                <{if $showDesc}><p><{$category.desc}></p><{/if}>
                <p class="center"><a class='btn btn-primary' href='index.php?op=list&amp;alb_pid=<{$category.id}>' title='<{$smarty.const._CO_WGGALLERY_CATS_ALBUMS}>'><{$smarty.const._CO_WGGALLERY_CATS_ALBUMS}></a></p>
            </div>
    </div>
<{/if}>
</a>