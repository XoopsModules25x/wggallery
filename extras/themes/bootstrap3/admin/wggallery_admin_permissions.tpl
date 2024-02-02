<{include file='db:wggallery_admin_header.tpl'}>

<{if !empty($error)}>
	<div class='errorMsg'><strong><{$error}></strong></div>
<{/if}>

<div class="spacer"><{$form|default:''}></div>

<br>

<{include file='db:wggallery_admin_footer.tpl'}>
