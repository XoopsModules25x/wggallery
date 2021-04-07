<{include file='db:wggallery_header.tpl'}>

<{if $albums|default:''}>
	<div class='panel panel-<{$panel_type|default:''}>'>
		<div class='panel-heading wgg-cats-header'><{$index_alb_title}></div>
		<div class='panel-body'>
			<{foreach item=album from=$albums}>
                <{include file='db:wggallery_albumitem_simple.tpl' album=$album}>
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
                <{if $number_cols_cat|default:0 == 6}>
                    <div class='col-xs-12 col-sm-2'>
                <{elseif $number_cols_cat|default:0 == 4}>
                    <div class='col-xs-12 col-sm-3'>
                <{elseif $number_cols_cat|default:0 == 3}>
                    <div class='col-xs-12 col-sm-4'>
                <{elseif $number_cols_cat|default:0 == 2}>
                    <div class='col-xs-12 col-sm-6'>
                <{else}>
                    <div class='col-xs-12 col-sm-12'>
                <{/if}>
                    <{include file='db:wggallery_categoryitem_simple.tpl' category=$category}>
                </div>
                <{if $category.linebreak|default:''}>
                    <div class='clear linebreak'>&nbsp;</div>
                <{/if}>
			<{/foreach}>
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
