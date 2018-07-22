aaaaaa
<{if $images_list}>
bbbbb
    <{if $container}><div class="clear"></div><div class="container wgcontainer-block" style="width:<{$container_width}>px"><div class="row"><{/if}>
    <{foreach item=image from=$images_list}>
			<{if $template == 'hovereffectideas'}>
				<{include file='db:wggallery_imageitem_hovereffectideas.tpl' image=$image}>
			<{elseif $template == 'simple'}>
				<{include file='db:wggallery_imageitem_simple.tpl' image=$image}>
			<{elseif $template == 'bcards'}>
				<{include file='db:wggallery_imageitem_bcards.tpl' image=$image}>
            <{else}>
				<{if $numb_images == 2}><div class='col-xs-12 col-sm-6'>
				<{elseif $numb_images == 3}><div class='col-xs-12 col-sm-4'>
				<{elseif $numb_images == 4}><div class='col-xs-12 col-sm-3'>
				<{elseif $numb_images == 6}><div class='col-xs-12 col-sm-2'>
				<{else}><div class='col-xs-12 col-sm-12'>
				<{/if}>
					<{if $template == 'simple'}>
						
					<{else}>
						<{include file='db:wggallery_imageitem_2.tpl' image=$image}>
					<{/if}>
				</div>
			<{/if}>
        
    <{/foreach}>
    <div class="clear"></div>
    <{if $show_more_images}>
        <div class="wgg-b-album-more center">
            <a class='btn wgfxg-more-btn' href='<{$wggallery_url}>/index.php' title='<{$smarty.const._CO_WGGALLERY_ALBUMS_SHOW}>'><{$smarty.const._CO_WGGALLERY_ALBUMS_SHOW}></a>
        </div>
    <{/if}>
    <{if $container}></div></div><div class="clear"></div><{/if}>
<{/if}>
