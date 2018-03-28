<{include file='db:wggallery_header.tpl'}>

<div class='wggallery-tips'>
<ul>
	<li><{$smarty.const._MA_WGGALLERY_SUBMIT_SUBMITONCE}></li>
<li><{$smarty.const._MA_WGGALLERY_SUBMIT_ALLPENDING}></li>
<li><{$smarty.const._MA_WGGALLERY_SUBMIT_DONTABUSE}></li>
<li><{$smarty.const._MA_WGGALLERY_SUBMIT_TAKEDAYS}></li>

</ul>

</div>

<{if $message_error != ''}>
	<div class='errorMsg'>
<{$message_error}>
</div>


<{/if}>

<div class='wggallery-submitform'>
<{$form}>
</div>

<{include file='db:wggallery_footer.tpl'}>
