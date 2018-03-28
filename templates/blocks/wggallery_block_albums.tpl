<table class='table table-<{$table_type}>'>
		<thead>
			<tr class='head'>
		<th class='center'><{$smarty.const._MB_WGGALLERY_ALB_ID}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_ALB_PID}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_ALB_NAME}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_ALB_DESC}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_ALB_WEIGHT}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_ALB_IMAGE}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_ALB_IMGID}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_ALB_STATE}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_ALB_DATE}></th>
<th class='center'><{$smarty.const._MB_WGGALLERY_ALB_SUBMITTER}></th>

	</tr>


	</thead>

<{if $albums_count}>
	<tbody><{foreach item=album from=$albums_list}>
	<tr class="<{cycle values="odd, even"}>"><td class="center"><{$album.id}></td>

<td class="center"><{$album.pid}></td>

<td class="center"><{$album.name}></td>

<td class="center"><{$album.desc}></td>

<td class="center"><{$album.weight}></td>

<td class="center"><img src="<{$wggallery_upload_url}>/images/albums/<{$album.image}>" alt="albums" />
</td>

<td class="center"><{$album.imgid}></td>

<td class="center"><{$album.state}></td>

<td class="center"><{$album.date}></td>

<td class="center"><{$album.submitter}></td>

<td class="center">
<a href="albums.php?op=edit&amp;alb_id=<{$album.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons32 edit.png}>" alt="albums" />
</a>

<a href="albums.php?op=delete&amp;alb_id=<{$album.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons32 delete.png}><{$album.id}>" alt="albums" />
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

