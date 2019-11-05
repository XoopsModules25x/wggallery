<!-- Header -->
<{include file='db:wggallery_admin_header.tpl'}>
<{if $form}>
	<{$form}>
<{/if}>
<{if $error}>
	<div class='errorMsg'><strong><{$error}></strong></div>
<{/if}>
<{if $categories_list}>

        <table class='table table-bordered' >
            <thead>
                <tr class='head'>
                    <th class='center'>&nbsp;</th>
                    <th class='center'><{$smarty.const._AM_WGGALLERY_CAT_ID}></th>
                    <th class='center'><{$smarty.const._AM_WGGALLERY_CAT_TEXT}></th>
                    <th class='center'><{$smarty.const._AM_WGGALLERY_CAT_ALBUM}></th>
                    <th class='center'><{$smarty.const._AM_WGGALLERY_CAT_IMAGE}></th>
                    <th class='center'><{$smarty.const._AM_WGGALLERY_CAT_SEARCH}></th>
                    <th class='center'><{$smarty.const._CO_WGGALLERY_DATE}></th>
                    <th class='center'><{$smarty.const._CO_WGGALLERY_SUBMITTER}></th>
                    <th class='center width5'><{$smarty.const._CO_WGGALLERY_FORM_ACTION}></th>
                </tr>
            </thead>
            <{if $categories_count}>
                <tbody id="categories-list">
                    <{foreach item=category from=$categories_list}>
                        <tr class="<{cycle values='odd, even'}>" id="corder_<{$category.id}>">
                            <td class="center"><img src="<{$wggallery_icon_url_16}>up_down.png" alt="drag&drop" class="icon-sortable"></td>
                            <td class='center'><{$category.id}></td>
                            <td class='center'><{$category.text}></td>
                            <td class='center'>
                                <{if $category.album == 1}>
                                    <a href='<{$wggallery_url}>/admin/categories.php?op=change&amp;field=album&amp;state=0&amp;cat_id=<{$category.id}>' title='<{$smarty.const._EDIT}>'>
                                        <img src="<{$wggallery_icon_url_16}>on.png" alt="<{$smarty.const._YES}>">
                                    </a>
                                <{else}>
                                    <a href='<{$wggallery_url}>/admin/categories.php?op=change&amp;field=album&amp;state=1&amp;cat_id=<{$category.id}>' title='<{$smarty.const._EDIT}>'>
                                        <img src="<{$wggallery_icon_url_16}>off.png" alt="<{$smarty.const._NO}>">
                                    </a>
                                <{/if}>
                            </td>
                            <td class='center'>
                                <{if $category.image == 1}>
                                    <a href='<{$wggallery_url}>/admin/categories.php?op=change&amp;field=image&amp;state=0&amp;cat_id=<{$category.id}>' title='<{$smarty.const._EDIT}>'>
                                        <img src="<{$wggallery_icon_url_16}>on.png" alt="<{$smarty.const._YES}>">
                                    </a>
                                <{else}>
                                    <a href='<{$wggallery_url}>/admin/categories.php?op=change&amp;field=image&amp;state=1&amp;cat_id=<{$category.id}>' title='<{$smarty.const._EDIT}>'>
                                        <img src="<{$wggallery_icon_url_16}>off.png" alt="<{$smarty.const._NO}>">
                                    </a>
                                <{/if}>
                            </td>
                            <td class='center'>
                                <{if $category.search == 1}>
                                    <a href='<{$wggallery_url}>/admin/categories.php?op=change&amp;field=search&amp;state=0&amp;cat_id=<{$category.id}>' title='<{$smarty.const._EDIT}>'>
                                        <img src="<{$wggallery_icon_url_16}>on.png" alt="<{$smarty.const._YES}>">
                                    </a>
                                <{else}>
                                    <a href='<{$wggallery_url}>/admin/categories.php?op=change&amp;field=search&amp;state=1&amp;cat_id=<{$category.id}>' title='<{$smarty.const._EDIT}>'>
                                        <img src="<{$wggallery_icon_url_16}>off.png" alt="<{$smarty.const._NO}>">
                                    </a>
                                <{/if}>
                            </td>
                            <td class='center'><{$category.date}></td>
                            <td class='center'><{$category.submitter}></td>
                            <td class='center  width10'>
                                <a href='<{$wggallery_url}>/admin/categories.php?op=edit&amp;cat_id=<{$category.id}>' title='<{$smarty.const._EDIT}>'>
                                    <img src='<{xoModuleIcons16 edit.png}>' alt='categories'>
                                </a>
                                <a href='<{$wggallery_url}>/admin/categories.php?op=delete&amp;cat_id=<{$category.id}>' title='<{$smarty.const._DELETE}>'>
                                    <img src='<{xoModuleIcons16 delete.png}>' alt='categories'>
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
<br>
<!-- Footer --><{include file='db:wggallery_admin_footer.tpl'}>
