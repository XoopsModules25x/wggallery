<!-- Header -->
<{include file='db:wggallery_admin_header.tpl'}>
<{if $form|default:''}>
	<{$form}>
<{/if}>
<{if $errors|default:''}>
    <div class='wgsa-batch-checkerr'>
        <{foreach item=error from=$errors}>
            <p><{$error}></p>
        <{/foreach}>
    </div>
<{/if}>
<{if $filesCount|default:0 > 0}>
    <h3><{$smarty.const._AM_WGGALLERY_BATCH_LIST}></h3>
    <table class='table table-bordered'>
        <thead>
            <tr class='head'>
                <th class='center'>&nbsp;</th>
                <th class='center'><{$smarty.const._PREVIEW}></th>
                <th class='center'><{$smarty.const._CO_WGGALLERY_IMAGE_NAME}></th>
                <th class='center'><{$smarty.const._CO_WGGALLERY_IMAGE_MIMETYPE}></th>
                <th class='center'><{$smarty.const._CO_WGGALLERY_IMAGE_SIZE}></th>
                <th class='center'><{$smarty.const._CO_WGGALLERY_IMAGE_RES}></th>
                <th class='center'><{$smarty.const._CO_WGGALLERY_DATE}></th>
                <th class='center'><{$smarty.const._CO_WGGALLERY_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $files|default:''}>
            <tbody>
                <{foreach item=file from=$files}>
                    <tr class='<{cycle values='odd, even'}>'>
                        <td class='center'><{$file.nb}></td>
                        <td class='center'><img style="height:50px;" src="<{$wggallery_upload_batch_url}><{$file.name}>"></td>
                        <td class='center'><{$file.name}></td>
                        <td class='center'>
                            <{$file.mimetype}>
                            <{if $file.check_mimetype|default:''}>
                                <br><span class="wgsa-batch-checkerr"><{$file.check_mimetype}></span>
                            <{else}>
                                <img src="<{$wggallery_icon_url_16}>on.png" alt="" title="">
                            <{/if}>
                        </td>
                        <td class='center'>
                            <{$file.size}>
                            <{if $file.check_size|default:''}>
                                <br><span class="wgsa-batch-checkerr"><{$file.check_size}></span>
                            <{else}>
                                <img src="<{$wggallery_icon_url_16}>on.png" alt="" title="">
                            <{/if}>
                        </td>
                        <td class='center'>
                            <{$file.width}>/<{$file.height}>
                            <{if $file.check_size|default:'' && $file.check_height|default:''}>
                                <{if $file.check_width|default:''}><br><span class="wgsa-batch-checkerr"><{$file.check_width}></span><{/if}>
                                <{if $file.check_height|default:''}><br><span class="wgsa-batch-checkerr"><{$file.check_height}></span><{/if}>
                            <{else}>
                                    <img src="<{$wggallery_icon_url_16}>on.png" alt="" title="">
                            <{/if}>
                        </td>
                        <td class='center'><{$file.date}></td>
                        <td class='center'>
                            <a href='batch.php?op=delete&amp;file=<{$file.name}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._DELETE}>'>
                                <img src='<{xoModuleIcons16 delete.png}>' alt='<{$smarty.const._DELETE}>'></a>
                        </td>
                    </tr>
                <{/foreach}>
            </tbody>
        <{/if}>
    </table>

	<div class='clear'>&nbsp;</div>
	<{if $pagenav|default:''}>
		<div class='xo-pagenav floatright'><{$pagenav}></div>
		<div class='clear spacer'></div>
	<{/if}>
<{else}>
    <div><{$noData|default:''}></div>
<{/if}>

<!-- Footer -->
<{include file='db:wggallery_admin_footer.tpl'}>
