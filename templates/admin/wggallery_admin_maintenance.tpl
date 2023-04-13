<!-- Header -->
<{include file='db:wggallery_admin_header.tpl'}>
<style>
    .btn {
        margin:0;
        padding: 4px 10px;
        border:1px solid #ccc;
        border-radius:5px;
        line-height:26px;
    }
</style>

<{if $system_check|default:''}>
	<table class='table table-bordered'>
		<thead>
			<tr class='head'>
				<th class='center' style='width:50%'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_CHECK_SYSTEM}></th>
				<th class='center' style='width:50%' colspan='2'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_CHECK_RESULTS}></th>
			</tr>
		</thead>
		<tbody>
			<{foreach item=check from=$system_check}>
				<tr class="<{cycle values='odd, even'}>">
					<td class='left'><div style="font-size:100%;margin:10px 0 5px 0;"><{$check.type}></div><div style="font-size:80%;margin:0 0 10px 0;"><{$check.info1}></div></td>
					<td class='left'><{$check.result1}><{if $check.result2|default:''}><br><{$check.result2}><{/if}></td>
					<td class='left'>
						<{if $check.change|default:''}>
							<img src="<{$wggallery_icon_url_16}>off.png" alt="_AM_WGGALLERY_MAINTENANCE_CHECKOK"> <{$check.solve}> <{if $check.info2|default:''}><br><{/if}>
						<{else}>
							<img src="<{$wggallery_icon_url_16}>on.png" alt="_AM_WGGALLERY_MAINTENANCE_CHECKOK"> 
						<{/if}>
						<{$check.info2|default:''}>
					</td>
				</tr>
			<{/foreach}>
		</tbody>
	</table>
	<p><a class='btn pull-right' href='maintenance.php?op=list' title='<{$smarty.const._CO_WGGALLERY_BACK}>'><{$smarty.const._CO_WGGALLERY_BACK}></a></p>
	<br><br>
<{else}>
    <table class='table table-bordered'>
        <thead>
            <tr class='head'>
                <th class='center' style='width:10%'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_TYP}></th>
                <th class='center' style='width:30%'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_DESC}></th>
                <{if $show_result|default:''}><th class='center' style='width:35%'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_RESULTS}></th><{/if}>
                <th class='center' style='width:25%'><{$smarty.const._CO_WGGALLERY_FORM_ACTION}></th>
            </tr>
        </thead>
        <tbody>
            <{if $show_check|default:''}>
                <tr class="<{cycle values='odd, even'}>">
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_CHECK_SYSTEM}></td>
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_CHECK_SYSTEMDESC}></td>
                    <td class='center '>
                        <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=system_check' title='<{$smarty.const._CO_WGGALLERY_EXEC}>'><{$smarty.const._CO_WGGALLERY_EXEC}></a></p>
                    </td>
                </tr>
            <{/if}>
            <{if $show_gt|default:''}>
                <tr class="<{cycle values='odd, even'}>">
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_GT}></td>
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_GT_DESC}></td>
                    <{if $show_result|default:''}>
                        <td class='left'>
                            <{if $result_success|default:''}><span><{$result_success}></span><{/if}>
                            <{if $result_error|default:''}><span class='maintenance-error'><{$result_error}></span><{/if}>
                        </td>
                    <{/if}>
                    <td class='center '>
                        <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=delete_reset_gt' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_DR}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_DR}></a></p>
                        <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=reset_gt' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_R}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_R}></a></p>
                    </td>
                </tr>
            <{/if}>
            <{if $show_at|default:''}>
                <tr class="<{cycle values='odd, even'}>">
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_AT}></td>
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_AT_DESC}></td>
                    <{if $show_result|default:''}>
                        <td class='left'>
                            <{if $result_success|default:''}><span><{$result_success}></span><{/if}>
                            <{if $result_error|default:''}><span class='maintenance-error'><{$result_error}></span><{/if}>
                        </td>
                    <{/if}>
                    <td class='center'>
                        <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=delete_reset_at' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_DR}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_DR}></a></p>
                        <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=reset_at' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_R}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_R}></a></p>
                    </td>
                </tr>
            <{/if}>
            <{if $show_resize|default:''}>
                <tr class="<{cycle values='odd, even'}>">
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_RESIZE}></td>
                    <td class='left'><{$maintainance_resize_desc}></td>
                    <{if $show_result|default:''}>
                        <td class='left'>
                            <{if $result_success|default:''}><span><{$result_success}></span><{/if}>
                            <{if $result_error|default:''}><span class='maintenance-error'><{$result_error}></span><{/if}>
                        </td>
                    <{/if}>
                    <td class='center'>
                        <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=resize_large' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_RIL}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_RIL}></a></p>
                        <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=resize_medium' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_RIM}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_RIM}></a></p>
                        <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=resize_thumb' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_RIT}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_RIT}></a></p>
                        <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=resize_album_select' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_ALBUM_SELECT}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_ALBUM_SELECT}></a></p>
                    </td>
                </tr>
            <{/if}>
            <{if $show_unnused|default:''}>
                <tr class="<{cycle values='odd, even'}>">
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED}></td>
                    <td class='left'><{$maintainance_dui_desc}></td>
                    <{if $show_result|default:''}>
                        <td class='left'>
                            <{if $result_success|default:''}><span><{$result_success}></span><{/if}>
                            <{if $result_error|default:''}><span class='maintenance-error'><{$result_error}></span><{/if}>
                        </td>
                    <{/if}>
                    <td class='center'>
                        <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=delete_unused_images_show' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_DUI_SHOW}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_DUI_SHOW}></a></p>
                        <{if $show_result|default:''}>
                            <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=delete_unused_images' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_DUI}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_DUI}></a></p>
                        <{/if}>
                    </td>
                </tr>
            <{/if}>
            <{if $show_invalid|default:''}>
                <tr class="<{cycle values='odd, even'}>">
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_DELETE_INVALID}></td>
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_DELETE_INVALID_DESC}></td>
                    <{if $show_result|default:''}>
                        <td class='left'>
                            <{if $result_success|default:''}><span><{$result_success}></span><{/if}>
                            <{if $result_error|default:''}><span class='maintenance-error'><{$result_error}></span><{/if}>
                        </td>
                    <{/if}>
                    <td class='center'>
                        <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=invalid_images_search' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_ITEM_SEARCH}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_ITEM_SEARCH}></a></p>
                        <{if $show_result|default:''}>
                            <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=invalid_images_clean' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_IMG_CLEAN}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_IMG_CLEAN}></a></p>
                        <{/if}>
                    </td>
                </tr>
            <{/if}>
            <{if $show_imgdir|default:''}>
                <tr class="<{cycle values='odd, even'}>">
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_IMGDIR}></td>
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_IMGDIR_DESC}></td>
                    <{if $show_result|default:''}>
                        <td class='left'>
                            <{if $result_success|default:''}><span><{$result_success}></span><{/if}>
                            <{if $result_error|default:''}><span class='maintenance-error'><{$result_error}></span><{/if}>
                        </td>
                    <{/if}>
                    <td class='center'>
                        <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=broken_imgdir_search' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_ITEM_SEARCH}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_ITEM_SEARCH}></a></p>
                        <{if $show_result|default:''}>
                            <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=broken_imgdir_clean' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_IMG_CLEAN}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_IMG_CLEAN}></a></p>
                        <{/if}>
                    </td>
                </tr>
            <{/if}>
            <{if $show_imgalb|default:''}>
                <tr class="<{cycle values='odd, even'}>">
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_IMGALB}></td>
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_IMGALB_DESC}></td>
                    <{if $show_result|default:''}>
                        <td class='left'>
                            <{if $result_success|default:''}><span><{$result_success}></span><{/if}>
                            <{if $result_error|default:''}><span class='maintenance-error'><{$result_error}></span><{/if}>
                        </td>
                    <{/if}>
                    <td class='center'>
                        <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=broken_imgalb_search' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_ITEM_SEARCH}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_ITEM_SEARCH}></a></p>
                        <{if $show_result|default:''}>
                            <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=broken_imgalb_clean' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_IMG_CLEAN}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_IMG_CLEAN}></a></p>
                        <{/if}>
                    </td>
                </tr>
            <{/if}>
            <{if $show_wm|default:''}>
                <tr class="<{cycle values='odd, even'}>">
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_WATERMARK}></td>
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_WATERMARK_DESC}></td>
                    <{if $show_result|default:''}>
                        <td class='left'>
                            <{if $result_success|default:''}><span><{$result_success}></span><{/if}>
                            <{if $result_error|default:''}><span class='maintenance-error'><{$result_error}></span><{/if}>
                        </td>
                    <{/if}>
                    <td class='center'>
                        <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=watermark_select' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_ALBUM_SELECT}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_ALBUM_SELECT}></a></p>
                    </td>
                </tr>
            <{/if}>
            <{if $show_exif|default:''}>
                <tr class="<{cycle values='odd, even'}>">
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_READ_EXIF}></td>
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_READ_EXIF_DESC}><br><{$exif_current}></td>
                    <{if $show_result|default:''}>
                        <td class='left'>
                            <{if $result_success|default:''}><span><{$result_success}></span><{/if}>
                            <{if $result_error|default:''}><span class='maintenance-error'><{$result_error}></span><{/if}>
                        </td>
                    <{/if}>
                    <td class='center'>
                        <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=read_exif' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_READ_EXIF_READ}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_READ_EXIF_READ}></a></p>
                        <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=read_exifall' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_READ_EXIF_READALL}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_READ_EXIF_READALL}></a></p>
                        <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=delete_exif' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_DELETE_EXIF}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_DELETE_EXIF}></a></p>
                    </td>
                </tr>
            <{/if}>
            <{if $show_mimetypes|default:''}>
                <tr class="<{cycle values='odd, even'}>">
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_CHECK_MT}></td>
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_CHECK_MT_DESC}></td>
                    <{if $show_result|default:''}>
                        <td class='left'>
                            <{if $result_success|default:''}><span><{$result_success}></span><{/if}>
                            <{if $result_error|default:''}><span class='maintenance-error'><{$result_error}></span><{/if}>
                        </td>
                    <{/if}>
                    <td class='center'>
                        <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=mimetypes_search' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_CHECK_MT_SEARCH}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_CHECK_MT_SEARCH}></a></p>
                        <{if $show_result|default:''}>
                            <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=mimetypes_clean' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_CHECK_MT_CLEAN}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_CHECK_MT_CLEAN}></a></p>
                        <{/if}>
                    </td>
                </tr>
            <{/if}>
            <{if $show_checkspace|default:''}>
                <tr class="<{cycle values='odd, even'}>">
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_CHECK_SPACE}></td>
                    <td class='left'><{$maintainance_cs_desc}></td>
                    <{if $show_result|default:''}>
                        <td class='left'>
                            <{if $result_success|default:''}><span><{$result_success}></span><{/if}>
                            <{if $result_error|default:''}><span class='maintenance-error'><{$result_error}></span><{/if}>
                        </td>
                    <{/if}>
                    <td class='center'>
                        <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=check_space' title='<{$smarty.const._CO_WGGALLERY_EXEC}>'><{$smarty.const._CO_WGGALLERY_EXEC}></a></p>
                    </td>
                </tr>
            <{/if}>
            <{if $show_invalidrate|default:''}>
                <tr class="<{cycle values='odd, even'}>">
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_INVALIDRATE}></td>
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_INVALIDRATE_DESC}></td>
                    <{if $show_result|default:''}>
                        <td class='left'>
                            <{if $result_success|default:''}><span><{$result_success}></span><{/if}>
                        </td>
                    <{/if}>
                    <td class='center'>
                        <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=invalid_ratings_search' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_ITEM_SEARCH}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_ITEM_SEARCH}></a></p>
                        <{if $show_result|default:''}>
                            <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=invalid_ratings_clean' title='<{$smarty.const._CO_WGGALLERY_EXEC}>'><{$smarty.const._CO_WGGALLERY_EXEC}></a></p>
                        <{/if}>
                    </td>
                </tr>
            <{/if}>
            <{if $show_invalidcats|default:''}>
                <tr class="<{cycle values='odd, even'}>">
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_INVALIDCATS}></td>
                    <td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_INVALIDCATS_DESC}></td>
                    <{if $show_result|default:''}>
                        <td class='left'>
                            <{if $result_success|default:''}><span><{$result_success}></span><{/if}>
                        </td>
                    <{/if}>
                    <td class='center'>
                        <p class='maintenance-btn left'><a class='btn' href='maintenance.php?op=invalid_cats_clean' title='<{$smarty.const._CO_WGGALLERY_EXEC}>'><{$smarty.const._CO_WGGALLERY_EXEC}></a></p>
                    </td>
                </tr>
            <{/if}>
        </tbody>
    </table>
<{/if}>
<{if $show_result|default:''}>
	<p><a class='btn pull-right' href='maintenance.php?op=list' title='<{$smarty.const._CO_WGGALLERY_BACK}>'><{$smarty.const._CO_WGGALLERY_BACK}></a></p>
<{/if}>

<{if isset($form)}>
	<{$form}>
<{/if}>
<{if isset($error)}>
	<div class='errorMsg'><strong><{$error}></strong></div>
<{/if}>
<br>
<!-- Footer --><{include file='db:wggallery_admin_footer.tpl'}>
