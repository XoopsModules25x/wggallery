<{if $show_breadcrumbs|default:''}>
    <{include file='db:wggallery_breadcrumbs.tpl'}>
<{/if}>

<{if $ads|default:'' != ''}>
	<div class='center'><{$ads}></div>
<{/if}>

<{if $albumlist|default:''}>
    <div class='wgg-alblist'><{$albumlist}></div>
<{/if}>
