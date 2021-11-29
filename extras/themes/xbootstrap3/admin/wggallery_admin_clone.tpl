<!-- Header -->
<{include file='db:wggallery_admin_header.tpl'}>

<{if $form|default:''}>
	<{$form}>
<{/if}>
<{if $result|default:''}>
    <div><{$result}></div>
<{/if}>

<!-- Footer -->
<{include file='db:wggallery_admin_footer.tpl'}>
