<{if $show_breadcrumbs}>
    <{include file='db:wggallery_breadcrumbs.tpl'}>
<{/if}>

<{if $ads != ''}>
	<div class='center'>
<{$ads}></div>
<{/if}>
<{if $albumlist}>
    <div class='wgg-alblist'><{$albumlist}></div>
<{/if}>
