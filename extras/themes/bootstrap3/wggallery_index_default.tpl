<{include file='db:wggallery_header.tpl'}>

<{if $albums|default:''}>
	<div class='panel panel-<{$panel_type|default:''}>'>
		<div class='panel-heading wgg-cats-header'><{$index_alb_title}></div>
		<div class='panel-body'>
			<{foreach item=album from=$albums}>
                <{if $number_cols_album|default:0 == 4}>
                    <div class='col-xs-12 col-sm-3 wgg-album-panel'>
                        <{include file='db:wggallery_albumitem_2.tpl' album=$album}>
                    </div>
                    <{if $album.linebreak|default:''}>
                        <div class='clear'>&nbsp;</div>
                    <{/if}>
                <{elseif $number_cols_album|default:0 == 3}>
                    <div class='col-xs-12 col-sm-4 wgg-album-panel'>
                        <{include file='db:wggallery_albumitem_2.tpl' album=$album}>
                    </div>
                    <{if $album.linebreak|default:''}>
                        <div class='clear'>&nbsp;</div>
                    <{/if}>
                <{elseif $number_cols_album|default:0 == 2}>
                    <div class='col-xs-12 col-sm-6 wgg-album-panel'>
                        <{include file='db:wggallery_albumitem_2.tpl' album=$album}>
                    </div>
                    <{if $album.linebreak|default:''}>
                        <div class='clear'>&nbsp;</div>
                    <{/if}>
                <{else}>
                    <{include file='db:wggallery_albumitem_1.tpl' album=$album}>
                <{/if}>
			<{/foreach}>
			<div class='clear'>&nbsp;</div>
			<{if $pagenav_albums|default:''}>
				<div class='xo-pagenav floatright'><{$pagenav_albums}></div>
				<div class='clear spacer'></div>
			<{/if}>
		</div>
	</div>
<{/if}>
<{if $categories|default:''}>
	<div class='panel panel-<{$panel_type|default:''}>'>
		<div class='panel-heading wgg-cats-header'><{$index_cats_title}></div>
		<div class='panel-body'>
			<{foreach item=category from=$categories}>
                <{if $number_cols_cat|default:0 == 4}>
                    <div class='col-xs-12 col-sm-3 wgg-album-panel'>
                        <{include file='db:wggallery_categoryitem_2.tpl' category=$category}>
                    </div>
                    <{if $album.linebreak|default:''}>
                        <div class='clear'>&nbsp;</div>
                    <{/if}>
                <{elseif $number_cols_cat|default:0 == 3}>
                    <div class='col-xs-12 col-sm-4 wgg-album-panel'>
                        <{include file='db:wggallery_categoryitem_2.tpl' category=$category}>
                    </div>
                    <{if $album.linebreak|default:''}>
                        <div class='clear'>&nbsp;</div>
                    <{/if}>
                <{elseif $number_cols_cat|default:0 == 2}>
                    <div class='col-xs-12 col-sm-6 wgg-album-panel'>
                        <{include file='db:wggallery_categoryitem_2.tpl' category=$category}>
                    </div>
                    <{if $album.linebreak|default:''}>
                        <div class='clear'>&nbsp;</div>
                    <{/if}>
                <{else}>
                    <{include file='db:wggallery_categoryitem_1.tpl' category=$category}>
                <{/if}>
			<{/foreach}>
			<div class='clear'>&nbsp;</div>
			<{if $pagenav_cats|default:''}>
				<div class='xo-pagenav floatright'><{$pagenav_cats}></div>
				<div class='clear spacer'></div>
			<{/if}>
		</div>
	</div>
<{/if}>

<{if $alb_pid|default:''}>
	<div class='clear'>&nbsp;</div>
	<div class='wgg-goback'>
		<a class='btn btn-default wgg-btn' href='index.php?op=list<{if $subm_id|default:''}>&amp;subm_id=<{$subm_id}><{/if}>' title='<{$smarty.const._CO_WGGALLERY_BACK}>'>
			<img class='wgg-btn-icon' src='<{$wggallery_icon_url_16}>back.png' alt='<{$smarty.const._CO_WGGALLERY_BACK}>'>
			<{if $displayButtonText|default:false}><{$smarty.const._CO_WGGALLERY_BACK}><{/if}>
		</a>
	</div>
<{/if}>	
<div class='clear'>&nbsp;</div>

<{include file='db:wggallery_footer.tpl'}>
