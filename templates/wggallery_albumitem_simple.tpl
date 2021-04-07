
<{if $number_cols_album|default:0 == 6}>
	<div class='col-xs-12 col-sm-2'>
<{elseif $number_cols_album|default:0 == 4}>
	<div class='col-xs-12 col-sm-3'>
<{elseif $number_cols_album|default:0 == 3}>
	<div class='col-xs-12 col-sm-4'>
<{elseif $number_cols_album|default:0 == 2}>
	<div class='col-xs-12 col-sm-6'>
<{else}>
	<div class='col-xs-12 col-sm-12'>
<{/if}>           
	<div class='center'>
		<{if $album.nb_images|default:''}>
			<{if $gallery|default:''}>
				<a class='' href='<{$wggallery_url}>/gallery.php?op=show&amp;alb_id=<{$album.id}><{if $subm_id|default:''}>&amp;subm_id=<{$subm_id}><{/if}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_ALBUMSHOW}>' target='<{$gallery_target}>' >
			<{else}>
				<a class='' href='<{$wggallery_url}>/images.php?op=list&amp;alb_id=<{$album.id}>&amp;alb_pid=<{$album.pid}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES_INDEX}>'>
			<{/if}>
		<{/if}>
		
		<div class="simpleContainer">
			<{if $album.image|default:''}><img class="img-responsive" src="<{$album.image}>" alt="<{$album.name}>" title="<{$album.name}>"><{/if}>
			<div class="simpleContent">
				<{if $showTitle|default:false}><p><{$album.name}></p><{/if}>
				<{if $showDesc|default:''}><p><{$album.desc}></p><{/if}>
			</div>
		</div>
		<{if $album.nb_images|default:''}></a><{/if}>
	</div>
</div>
<{if $album.linebreak|default:''}>
	<div class='clear linebreak'>&nbsp;</div>
<{/if}>
