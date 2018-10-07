<!-- Header -->
<{include file='db:wggallery_admin_header.tpl'}>
<style>
 .btn {
	margin:0;
	padding: 4px 10px;
	border:1px solid #ccc;
	border-radius:5px;
 }
</style>
<table class='table table-bordered'>
	<thead>
		<tr class='head'>
			<th class='center'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_TYP}></th>
			<th class='center'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_DESC}></th>
            <th class='center'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_RESULTS}></th>
			<th class='center width15'><{$smarty.const._CO_WGGALLERY_FORM_ACTION}></th>
		</tr>
	</thead>
	<tbody>
		<tr class="<{cycle values='odd, even'}>">
			<td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_GT}></td>
			<td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_GT_DESC}></td>
			<td class='left'><{$result1}></td>
            <td class='center'>
				<p><a class='btn' href='maintenance.php?op=delete_reset_gt' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_DR}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_DR}></a></p>
				<p><a class='btn' href='maintenance.php?op=reset_gt' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_R}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_R}></a></p>
			</td>
		</tr>
        <tr class="<{cycle values='odd, even'}>">
			<td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_AT}></td>
			<td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_AT_DESC}></td>
			<td class='left'><{$result2}></td>
            <td class='center'>
				<p><a class='btn' href='maintenance.php?op=delete_reset_at' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_DR}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_DR}></a></p>
				<p><a class='btn' href='maintenance.php?op=reset_at' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_R}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_R}></a></p>
			</td>
		</tr>
		<tr class="<{cycle values='odd, even'}>">
			<td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_RESIZE}></td>
			<td class='left'><{$maintainance_resize_desc}></td>
			<td class='left'><{$result3}></td>
            <td class='center'>
				<p><a class='btn' href='maintenance.php?op=resize_medium' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_RIM}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_RIM}></a></p>
				<p><a class='btn' href='maintenance.php?op=resize_thumb' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_RIT}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_RIT}></a></p>
			</td>
		</tr>
		<tr class="<{cycle values='odd, even'}>">
			<td class='left'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED}></td>
			<td class='left'><{$maintainance_dui_desc}></td>
			<td class='left'><{$result4}></td>
            <td class='center'>
				<p><a class='btn' href='maintenance.php?op=delete_unused_images_show' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_DUI_SHOW}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_DUI_SHOW}></a></p>
				<p><a class='btn' href='maintenance.php?op=delete_unused_images' title='<{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_DUI}>'><{$smarty.const._AM_WGGALLERY_MAINTENANCE_EXECUTE_DUI}></a></p>
			</td>
		</tr>
	</tbody>
</table>

<{if $form}>
	<{$form}>
<{/if}>
<{if $error}>
	<div class='errorMsg'><strong><{$error}></strong></div>
<{/if}>
<br>
<!-- Footer --><{include file='db:wggallery_admin_footer.tpl'}>
