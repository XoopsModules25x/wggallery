<{if $error|default:''}>
	<div class='errorMsg'><strong><{$error}></strong></div>
<{/if}>
<div class='clear spacer'></div>
<{if $copyright|default:''}>
    <div class="pull-right"><{$copyright}></div>
<{/if}>
<{if $xoops_isadmin|default:''}>
    <div class='clear spacer'></div>
    <div class="text-center bold"><a href="<{$admin}>"><{$smarty.const._MA_WGGALLERY_ADMIN}></a></div><br>
<{/if}>
<div class="pad2 marg2">
    <{if $comment_mode|default:'' == "flat"}>
        <{include file="db:system_comments_flat.tpl"}>
    <{elseif $comment_mode|default:'' == "thread"}>
        <{include file="db:system_comments_thread.tpl"}>
    <{elseif $comment_mode|default:'' == "nest"}>
        <{include file="db:system_comments_nest.tpl"}>
    <{/if}>
</div>
<div class='clear spacer'></div>
<{include file='db:system_notification_select.tpl'}>