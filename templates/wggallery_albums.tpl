<{include file='db:wggallery_header.tpl'}>

<div class='panel panel-<{$panel_type}>'>
<div class='panel-heading'>
<{$smarty.const._MA_WGGALLERY_ALBUMS_TITLE}></div>

<{foreach item=album from=$albums}>
	<div class='panel panel-body'>
<{include file='db:wggallery_albums_list.tpl' album=$album}>
<{if $album.count is div by $numb_col}>
	<br>

<{/if}>

</div>


<{/foreach}>

</div>

<{include file='db:wggallery_footer.tpl'}>
