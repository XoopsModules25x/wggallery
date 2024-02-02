<a class='' href='index.php?op=list&amp;alb_pid=<{$category.id}>' title='<{$smarty.const._CO_WGGALLERY_COLL_ALBUMS}>'>
<{if $category.image|default:''}>
    <div class="simpleContainer center">
            <img class="img-fluid" src="<{$category.image}>" alt="<{$category.name}>" title="<{$category.name}>">
            <div class="simpleContent">
                <{if $showTitle|default:false}><p><{$category.name}></p><{/if}>
                <{if $showDesc|default:''}><p><{$category.desc}></p><{/if}>
                <p class="center"><a class='btn btn-primary wg-color1' href='index.php?op=list&amp;alb_pid=<{$category.id}>' title='<{$smarty.const._CO_WGGALLERY_COLL_ALBUMS}>'><{$smarty.const._CO_WGGALLERY_COLL_ALBUMS}></a></p>
            </div>
    </div>
<{/if}>
</a>