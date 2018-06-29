<{if $albums_list}>
    <{if $container}><div class="clear"></div><div class="container wgcontainer-block" style="width:<{$container_width}>px"><div class="row"><{/if}>
    <{foreach item=album from=$albums_list}>
			<{if $template == 'hovereffectideas'}>
				<{include file='db:wggallery_albumitem_hovereffectideas.tpl' album=$album}>
			<{elseif $template == 'simple'}>
				<{include file='db:wggallery_albumitem_simple.tpl' album=$album}>
			<{elseif $template == 'bcards'}>
				<{include file='db:wggallery_albumitem_bcards.tpl' album=$album}>
            <{else}>
				<{if $numb_albums == 2}><div class='col-xs-12 col-sm-6'>
				<{elseif $numb_albums == 3}><div class='col-xs-12 col-sm-4'>
				<{elseif $numb_albums == 4}><div class='col-xs-12 col-sm-3'>
				<{elseif $numb_albums == 6}><div class='col-xs-12 col-sm-2'>
				<{else}><div class='col-xs-12 col-sm-12'>
				<{/if}>
					<{if $template == 'simple'}>
						
					<{else}>
						<{include file='db:wggallery_albumitem_2.tpl' album=$album}>
					<{/if}>
				</div>
			<{/if}>
        
    <{/foreach}>
    <div class="clear"></div>
    <{if $show_more_albums}>
        <div class="wgg-b-album-more center">
            <a class='btn wgfxg-more-btn' href='<{$wggallery_url}>/index.php' title='<{$smarty.const._CO_WGGALLERY_ALBUMS_SHOW}>'><{$smarty.const._CO_WGGALLERY_ALBUMS_SHOW}></a>
        </div>
    <{/if}>
    <{if $container}></div></div><div class="clear"></div><{/if}>
<{/if}>
