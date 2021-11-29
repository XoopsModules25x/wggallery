<{if $show_breadcrumbs|default:false}>
    <{include file='db:wggallery_breadcrumbs.tpl'}>
<{/if}>

<{if !empty($ads)}>
	<div class='center'>
<{$ads}></div>
<{/if}>
