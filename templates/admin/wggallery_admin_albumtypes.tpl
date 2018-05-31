<!-- Header -->
<{include file='db:wggallery_admin_header.tpl'}>
<{if $albumtypes_list}>
	<table class='table table-bordered'>
		<thead>
			<tr class="head">
				<th class="center"><{$smarty.const._AM_WGGALLERY_GALLERYTYPE_ID}></th>
				<th class="center"><{$smarty.const._AM_WGGALLERY_GALLERYTYPE_NAME}></th>
				<th class="center"><{$smarty.const._AM_WGGALLERY_GALLERYTYPE_DESC}></th>
				<th class="center"><{$smarty.const._AM_WGGALLERY_GALLERYTYPE_CREDITS}></th>
				<th class="center"><{$smarty.const._AM_WGGALLERY_GALLERYTYPE_TEMPLATE}></th>
				<th class="center"><{$smarty.const._AM_WGGALLERY_GALLERYTYPE_OPTION}></th>
				<th class="center"><{$smarty.const._AM_WGGALLERY_GALLERYTYPE_DATE}></th>
				<th class="center"><{$smarty.const._AM_WGGALLERY_GALLERYTYPE_PRIMARY_SET}></th>
				<th class="center width5"><{$smarty.const._CO_WGGALLERY_FORM_ACTION}></th>
			</tr>
		</thead>
		<{if $albumtypes_count}>
			<tbody>
				<{foreach item=albumtype from=$albumtypes_list}>
					<tr class="<{cycle values='odd, even'}>">
						<td class='center'><{$albumtype.id}></td>
						<td class="center"><{$albumtype.name}></td>
						<td class="left"><{$albumtype.desc}></td>
						<td class="center"><{$albumtype.credits}></td>
						<td class="center"><{$albumtype.template}></td>
						<td class="left"><{$albumtype.options_text}></td>
						<td class="center"><{$albumtype.date}></td>
						<td class="center">
							<{if 0 == $albumtype.primary}>
								<a href="albumtypes.php?op=set_primary&amp;at_id=<{$albumtype.id}>" title="<{$smarty.const._AM_WGGALLERY_GALLERYTYPE_PRIMARY_SET}>">
									<img src="<{$wggallery_icon_url_16}>/0.png" alt="_AM_WGGALLERY_GALLERYTYPE_PRIMARY_SET" />
								</a>
							<{else}>
                                <img src="<{$wggallery_icon_url_16}>/on.png" alt="_AM_WGGALLERY_GALLERYTYPE_PRIMARY" />
                            <{/if}>
						</td>
						<td class="center  width5">
							<a href="albumtypes.php?op=options&amp;at_id=<{$albumtype.id}>" title="<{$smarty.const._OPTIONS}>">
                                <img src="<{$wggallery_icon_url_16}>/options.png" alt="<{$smarty.const._OPTIONS}>" />
                            </a>
							<a href="albumtypes.php?op=edit&amp;at_id=<{$albumtype.id}>" title="<{$smarty.const._EDIT}>">
								<img src="<{xoModuleIcons16 edit.png}>" alt="albumtypes" />
							</a>
							<a href="albumtypes.php?op=delete&amp;at_id=<{$albumtype.id}>" title="<{$smarty.const._DELETE}>">
								<img src="<{xoModuleIcons16 delete.png}>" alt="albumtypes" />
							</a>
						</td>
					</tr>
				<{/foreach}>
			</tbody>
		<{/if}>
	</table>
	<div class="clear">&nbsp;</div>
	<{if $pagenav}>
		<div class="xo-pagenav floatright"><{$pagenav}></div>
		<div class="clear spacer"></div>
	<{/if}>
<{/if}>
<{if $form}>
	<{$form}>
<{/if}>
<{if $error}>
	<div class="errorMsg"><strong><{$error}></strong>
</div>

<{/if}>
<br>
<!-- Footer --><{include file='db:wggallery_admin_footer.tpl'}>
