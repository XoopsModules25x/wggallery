<{include file='db:wggallery_header.tpl'}>

<{if !empty($form)}>
	<{$form}>
<{/if}>

<{if $formSingleUpload|default:''}>
    <div class="clear">&nbsp;</div>
    <{$formSingleUpload}>
<{/if}>


<{include file='db:wggallery_footer.tpl'}>
