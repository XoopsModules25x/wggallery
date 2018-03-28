<table class='table table-<{$table_type}>'>
		<thead>
			<tr class='head'>
		<th class='center'><{$smarty.const._MB_WGGALLERY_IMG_ID}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_IMG_TITLE}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_IMG_DESC}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_IMG_NAME}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_IMG_ORIGNAME}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_IMG_MIMETYPE}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_IMG_SIZE}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_IMG_RESX}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_IMG_RESY}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_IMG_DOWNLOADS}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_IMG_RATINGLIKES}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_IMG_VOTES}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_IMG_WEIGHT}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_IMG_ALBID}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_IMG_STATE}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_IMG_DATE}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_IMG_SUBMITTER}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_IMG_IP}></th>

	</tr>


	</thead>

<{if $images_count}>
	<tbody><{foreach item=image from=$images_list}>
	<tr class="<{cycle values="odd, even"}>"><td class="center"><{$image.id}></td>

<td class="center"><{$image.title}></td>

<td class="center"><{$image.desc}></td>

<td class="center"><{$image.name}></td>

<td class="center"><{$image.origname}></td>

<td class="center"><{$image.mimetype}></td>

<td class="center"><{$image.size}></td>

<td class="center"><{$image.resx}></td>

<td class="center"><{$image.resy}></td>

<td class="center"><{$image.downloads}></td>

<td class="center"><{$image.ratinglikes}></td>

<td class="center"><{$image.votes}></td>

<td class="center"><{$image.weight}></td>

<td class="center"><{$image.albid}></td>

<td class="center"><{$image.state}></td>

<td class="center"><{$image.date}></td>

<td class="center"><{$image.submitter}></td>

<td class="center"><{$image.ip}></td>

<td class="center">
<a href="images.php?op=edit&amp;img_id=<{$image.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons32 edit.png}>" alt="images" />
</a>

<a href="images.php?op=delete&amp;img_id=<{$image.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons32 delete.png}><{$image.id}>" alt="images" />
</a>

</td>

</tr>


<{/foreach}>

</tbody>


<{/if}>

<tfoot><tr><td>&nbsp;</td>

</tr>

</tfoot>


</table>

