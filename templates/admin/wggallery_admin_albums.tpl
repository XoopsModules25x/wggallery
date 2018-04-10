<!-- Header -->
<{include file='db:wggallery_admin_header.tpl'}>
<{if $albums_list}>
	<table class='table table-bordered'>
		<thead>
			<tr class='head'>
				<th class='center'><{$smarty.const._CO_WGGALLERY_ALBUM_ID}></th>
				<th class='center'><{$smarty.const._CO_WGGALLERY_ALBUM_PID}></th>
				<th class='center'><{$smarty.const._CO_WGGALLERY_ALBUM_ISCAT}></th>
				<th class='center'><{$smarty.const._CO_WGGALLERY_ALBUM_NAME}></th>
				<th class='center'><{$smarty.const._CO_WGGALLERY_ALBUM_DESC}></th>
				<th class='center'><{$smarty.const._CO_WGGALLERY_ALBUM_WEIGHT}></th>
				<th class='center'><{$smarty.const._CO_WGGALLERY_ALBUM_IMAGE}></th>
				<th class='center'><{$smarty.const._CO_WGGALLERY_ALBUM_STATE}></th>
				<th class='center'><{$smarty.const._CO_WGGALLERY_ALBUM_ALLOWDOWNLOAD}></th>
				<th class='center'><{$smarty.const._CO_WGGALLERY_ALBUM_DATE}></th>
				<th class='center'><{$smarty.const._CO_WGGALLERY_ALBUM_SUBMITTER}></th>
				<th class='center width5'><{$smarty.const._CO_WGGALLERY_FORM_ACTION}></th>
			</tr>
		</thead>
		<{if $albums_count}>
			<tbody>
				<{foreach item=album from=$albums_list}>
					<tr class="<{cycle values='odd, even'}>">
						<td class='center'><{$album.id}></td>
						<td class='center'><{$album.pid}></td>
						<td class='center'><{$album.iscat}></td>
						<td class='center'><{$album.name}></td>
						<td class='center'><{$album.desc}></td>
						<td class='center'><{$album.weight}></td>
						<td class='center'>
							<{if $album.image_err}>
								<span style='color:#ff0000'><strong><{$album.image}></strong></span>
							<{else}>
								<img src='<{$album.image}>' alt='<{$album.name}>' style='max-width:50px' />
							<{/if}>
						</td>
						<td class='center'><{$album.state_text}></td>
						<td class='center'><{$album.allowdownload}></td>
						<td class='center'><{$album.date}></td>
						<td class='center'><{$album.submitter}></td>
						<td class='center  width5'>
							<a href='albums.php?op=edit&amp;alb_id=<{$album.id}>' title='<{$smarty.const._EDIT}>'>
								<img src='<{xoModuleIcons16 edit.png}>' alt='<{$smarty.const._EDIT}>' />
							</a>
							<a href='albums.php?op=delete&amp;alb_id=<{$album.id}>' title='<{$smarty.const._DELETE}>'>
								<img src='<{xoModuleIcons16 delete.png}>' alt='<{$smarty.const._DELETE}>' />
							</a>
						</td>
					</tr>
				<{/foreach}>
			</tbody>
		<{/if}>
	</table>
	<div class='clear'>&nbsp;</div>
	<{if $pagenav}>
		<div class='xo-pagenav floatright'><{$pagenav}></div>
		<div class='clear spacer'></div>
	<{/if}>
<{/if}>
<{if $form}>
	<{$form}>
<{/if}>
<{if $error}>
	<div class='errorMsg'><strong><{$error}></strong></div>
<{/if}>
<br>
<!-- Footer --><{include file='db:wggallery_admin_footer.tpl'}>
