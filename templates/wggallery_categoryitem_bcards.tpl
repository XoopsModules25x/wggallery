<div class="card">
    <{if $category.image|default:''}>
        <a class='' href='index.php?op=list&amp;alb_pid=<{$category.id}>' title='<{$smarty.const._CO_WGGALLERY_COLL_ALBUMS}>'>
            <img class="card-img-top img-fluid" src="<{$category.image}>" alt="<{$category.name}>" title="<{$category.name}>"></a>
    <{/if}>
    <div class="card-body">
        <{if $showTitle|default:false}><h5 class="center"><{$category.name}></h5><{/if}>
        <{if $showDesc|default:''}><p class="center"><{$category.desc}></p><{/if}>
        <p class="center"><a class='btn btn-primary wg-color1' href='index.php?op=list&amp;alb_pid=<{$category.id}>' title='<{$smarty.const._CO_WGGALLERY_COLL_ALBUMS}>'><{$smarty.const._CO_WGGALLERY_COLL_ALBUMS}></a></p>
    </div>
</div>
<{if $category.linebreak|default:''}>
	<div class='clear'>&nbsp;</div>
<{/if}>