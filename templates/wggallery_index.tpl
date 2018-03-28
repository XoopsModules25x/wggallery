<{include file='db:wggallery_header.tpl'}>

<{if count($images) == 0}>
<table class="table table-<{$table_type}>">
    <thead>
        <tr class="center">
            <th><{$smarty.const._MA_WGGALLERY_TITLE}>  -  <{$smarty.const._MA_WGGALLERY_DESC}></th>
        </tr>
    </thead>
    <tbody>
        <tr class="center">
            <td class="bold pad5">
                <ul class="menu text-center">
                    <li><a href="<{$wggallery_url}>"><{$smarty.const._MA_WGGALLERY_INDEX}></a></li>
                    <li><a href="<{$wggallery_url}>/albums.php"><{$smarty.const._MA_WGGALLERY_ALBUMS}></a></li>
                    <li><a href="<{$wggallery_url}>/images.php"><{$smarty.const._MA_WGGALLERY_IMAGES}></a></li>
                </ul>
				<div class="justify pad5"><{$smarty.const._MA_WGGALLERY_INDEX_DESC}></div>
            </td>
        </tr>
    </tbody>
    <tfoot>
    <{if $adv != ''}>
        <tr class="center"><td class="center bold pad5"><{$adv}></td></tr>
    <{else}>
        <tr class="center"><td class="center bold pad5">&nbsp;</td></tr>
    <{/if}>
    </tfoot>
</table>
<{/if}>
<{if count($albums) > 0}>
<div class="table-responsive">
    <table class="table table-<{$table_type}>">
		<thead>
			<tr>
				<th colspan="<{$numb_col}>"><{$smarty.const._MA_WGGALLERY_ALBUMS}></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<{foreach item=album from=$albums}>
				<td>
					<{include file="db:wggallery_albums_list.tpl" album=$album}>
				</td>
			<{if $album.count is div by $numb_col}>
			</tr><tr>
			<{/if}>
				<{/foreach}>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="<{$numb_col}>" class="album-thereare"><{$lang_thereare}></td>
			</tr>
		</tfoot>
	</table>
</div>
<{/if}>

<{if count($images) > 0}>
<div class="table-responsive">
    <table class="table table-<{$table_type}>">
		<thead>
			<tr>
				<th colspan="<{$numb_col}>"><{$smarty.const._MA_WGGALLERY_IMAGES}></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<{foreach item=image from=$images}>
				<td>
					<{include file="db:wggallery_images_list.tpl" image=$image}>
				</td>
			<{if $image.count is div by $numb_col}>
			</tr><tr>
			<{/if}>
				<{/foreach}>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="<{$numb_col}>" class="image-thereare"><{$lang_thereare}></td>
			</tr>
		</tfoot>
	</table>
</div>
<{/if}>

<{if count($images) > 0}>
	<!-- Start Show new images in index -->
	<div class="wggallery-linetitle"><{$smarty.const._MA_WGGALLERY_INDEX_LATEST_LIST}></div>
	<table class="table table-<{$table_type}>">
		<tr>
			<!-- Start new link loop -->
			<{section name=i loop=$images}>
				<td class="col_width<{$numb_col}> top center">
					<{include file="db:wggallery_images_list.tpl" image=$images[i]}>
				</td>
	<{if $images[i].count is div by $divideby}>
		</tr><tr>
	<{/if}>
			<{/section}>
	<!-- End new link loop -->
		</tr>
	</table>
<!-- End Show new files in index -->
<{/if}>
<{include file='db:wggallery_footer.tpl'}>
