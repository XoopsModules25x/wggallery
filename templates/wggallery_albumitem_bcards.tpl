<{if $number_cols_album|default:0 == 6}>
	<div class='col-xs-12 col-sm-2'>
<{elseif $number_cols_album|default:0 == 4}>
	<div class='col-xs-12 col-sm-3'>
<{elseif $number_cols_album|default:0 == 3}>
	<div class='col-xs-12 col-sm-4'>
<{elseif $number_cols_album|default:0 == 2}>
	<div class='col-xs-12 col-sm-6'>
<{else}>
	<div class='col-xs-12 col-sm-6'>
<{/if}>           
	<div class="card">
        <{if $album.image|default:''}>
            <{if $album.nb_images|default:''}>
                <{if $gallery|default:''}>
                    <a class='' href='<{$wggallery_url}>/gallery.php?op=show&amp;alb_id=<{$album.id}><{if $subm_id|default:''}>&amp;subm_id=<{$subm_id}><{/if}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>' target='<{$gallery_target}>' >
                <{else}>
                    <a class='' href='<{$wggallery_url}>/images.php?op=list&amp;alb_id=<{$album.id}>&amp;alb_pid=<{$album.pid}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'>
                <{/if}>
            <{/if}>
            <img class="card-img-top img-responsive" src="<{$album.image}>" alt="<{$album.name}>" title="<{$album.name}>">
            <{if $album.nb_images|default:''}></a><{/if}>
        <{/if}>
		<div class="card-body">
            <{if $showTitle|default:false}><h5 class="center"><{$album.name}></h5><{/if}>
            <{if $showDesc|default:''}><p><{$album.desc}></p><{/if}>
            <p class="center">
                <{if $gallery}>
                    <a class='btn btn-primary wg-color1' href='<{$wggallery_url}>/gallery.php?op=show&amp;alb_id=<{$album.id}><{if $subm_id|default:''}>&amp;subm_id=<{$subm_id}><{/if}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>' target='<{$gallery_target}>' ><{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}></a>
                <{else}>
                    <a class='btn btn-primary wg-color1' href='<{$wggallery_url}>/images.php?op=list&amp;alb_id=<{$album.id}>&amp;alb_pid=<{$album.pid}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'><{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}></a>
                <{/if}>
            </p>
        </div>
	</div>
</div>
<{if $album.linebreak|default:''}>
	<div class='clear'>&nbsp;</div>
<{/if}>