<{include file='db:wggallery_header.tpl'}>

<div class='panel panel-<{$panel_type}>'>
<div class='panel-heading'>
<{$smarty.const._MA_WGGALLERY_IMAGES_TITLE}></div>

<{foreach item=image from=$images}>
	<div class='panel panel-body'>
<{include file='db:wggallery_images_list.tpl' image=$image}>
<{if $image.count is div by $numb_col}>
	<br>

<{/if}>

</div>


<{/foreach}>

</div>

<{include file='db:wggallery_footer.tpl'}>
