<!-- Header -->
<{include file='db:wggallery_admin_header.tpl'}>

<{if $albums_list|default:''}>
	<table class='table table-bordered'>
		<thead>
			<tr class='head'>
				<th class='center'>
                    <{$smarty.const._CO_WGGALLERY_ALBUM_ID}>
                    <a href='albums.php?op=list&amp;sort=alb_id&amp;orderby=DESC&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._DESCENDING}>'>
                        <img src='<{$wggallery_icon_url_16}>desc.png' alt='<{$smarty.const._DESCENDING}>'></a>
                    <a href='albums.php?op=list&amp;sort=alb_id&amp;orderby=ASC&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._ASCENDING}>'>
                        <img src='<{$wggallery_icon_url_16}>asc.png' alt='<{$smarty.const._ASCENDING}>'></a>
                </th>
				<th class='center'><{$smarty.const._CO_WGGALLERY_ALBUM_PID}></th>
				<th class='center'><{$smarty.const._CO_WGGALLERY_ALBUM_ISCOLL}></th>
				<th class='center'>
                    <{$smarty.const._CO_WGGALLERY_ALBUM_NAME}>
                    <a href='albums.php?op=list&amp;sort=alb_name&amp;orderby=DESC&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._DESCENDING}>'>
                        <img src='<{$wggallery_icon_url_16}>desc.png' alt='<{$smarty.const._DESCENDING}>'></a>
                    <a href='albums.php?op=list&amp;sort=alb_name&amp;orderby=ASC&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._ASCENDING}>'>
                        <img src='<{$wggallery_icon_url_16}>asc.png' alt='<{$smarty.const._ASCENDING}>'></a>
                </th>
				<th class='center'><{$smarty.const._CO_WGGALLERY_ALBUM_DESC}></th>
				<th class='center'>
                    <{$smarty.const._CO_WGGALLERY_WEIGHT}>
                    <a href='albums.php?op=list&amp;sort=alb_weight&amp;orderby=DESC&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._DESCENDING}>'>
                        <img src='<{$wggallery_icon_url_16}>desc.png' alt='<{$smarty.const._DESCENDING}>'></a>
                    <a href='albums.php?op=list&amp;sort=alb_weight&amp;orderby=ASC&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._ASCENDING}>'>
                        <img src='<{$wggallery_icon_url_16}>asc.png' alt='<{$smarty.const._ASCENDING}>'></a>
                </th>
				<th class='center'><{$smarty.const._CO_WGGALLERY_ALBUM_IMAGE}></th>
				<th class='center'><{$smarty.const._CO_WGGALLERY_ALBUM_STATE}></th>
                <th class='center'><{$smarty.const._CO_WGGALLERY_WATERMARKS}></th>
                <th class='center'><{$smarty.const._CO_WGGALLERY_ALBUM_NB_IMAGES}></th>
                <th class='center'><{$smarty.const._CO_WGGALLERY_ALBUM_NB_COLL}></th>
                <{if $use_categories|default:''}><th class='center'><{$smarty.const._CO_WGGALLERY_CATS}></th><{/if}>
                <{if $use_tags|default:''}><th class='center'><{$smarty.const._CO_WGGALLERY_TAGS}></th><{/if}>
				<th class='center'><{$smarty.const._CO_WGGALLERY_DATE}></th>
				<th class='center'><{$smarty.const._CO_WGGALLERY_SUBMITTER}></th>
				<th class='center width5'><{$smarty.const._CO_WGGALLERY_FORM_ACTION}></th>
			</tr>
		</thead>
		<{if $albums_count|default:''}>
			<tbody>
				<{foreach item=album from=$albums_list}>
					<tr class="<{cycle values='odd, even'}>">
						<td class='center'><{$album.id}></td>
						<td class='center'><{$album.pid}></td>
						<td class='center'><{$album.iscoll}></td>
						<td class='center'><{$album.name}></td>
						<td class='center'><{$album.desc}></td>
						<td class='center'><{$album.weight}></td>
						<td class='center'>
							<{if $album.image_err|default:''}>
								<span style='color:#ff0000'><strong><{$album.image_errtext}></strong></span>
							<{else}>
								<img src='<{$album.image}>' alt='<{$album.name}>' style='max-width:50px'>
							<{/if}>
						</td>
						<td class='center'>
                            <{if $album.state|default:'' == 0}>
                                <img class='state active' src='<{$wggallery_icon_url_16}>state0.png' alt='<{$smarty.const._CO_WGGALLERY_STATE_OFFLINE}>'>
                            <{/if}>
                            <{if $album.state|default:'' == 1}>
                                <img class='state active' src='<{$wggallery_icon_url_16}>state1.png' alt='<{$smarty.const._CO_WGGALLERY_STATE_ONLINE}>'>
                            <{/if}>
                            <{if $album.state|default:'' == 2}>
                                <img class='state active' src='<{$wggallery_icon_url_16}>state2.png' alt='<{$smarty.const._CO_WGGALLERY_STATE_APPROVAL}>'>
                            <{/if}>
                        </td>
                        <td class='center'>
                            <a href='watermarks.php?op=edit&amp;wm_id=<{$album.wmid}>' title='<{$album.wmname|default:''}>'>
								<{$album.wmname|default:''}>
							</a>
                        </td>
                        <td class='center'><{if $album.iscoll|default:''}>-<{else}><{$album.nb_images}><{/if}></td>
                        <td class='center'><{if $album.iscoll|default:''}><{$album.nb_subalbums}><{else}>-<{/if}></td>
                        <{if $use_categories|default:''}><td class='center'><{$album.cats_list}></td><{/if}>
                        <{if $use_tags|default:''}><td class='center'><{$album.tags}></td><{/if}>
						<td class='center'><{$album.date}></td>
						<td class='center'><{$album.submitter}></td>
						<td class='center  width10'>
                            <{if $album.state|default:'' == 0}>
                                <a href='albums.php?op=change_state&amp;alb_state=1&amp;alb_id=<{$album.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._CO_WGGALLERY_STATE_OFFLINE}>'>
                                    <img src='<{$wggallery_icon_url_16}>state0.png' alt='<{$smarty.const._CO_WGGALLERY_STATE_OFFLINE}>'></a>
                            <{/if}>
                            <{if $album.state|default:'' == 1}>
                                <a href='albums.php?op=change_state&amp;alb_state=0&amp;alb_id=<{$album.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._CO_WGGALLERY_STATE_ONLINE}>'>
                                    <img src='<{$wggallery_icon_url_16}>state1.png' alt='<{$smarty.const._CO_WGGALLERY_STATE_ONLINE}>'></a>
                            <{/if}>
                            <{if $album.state|default:'' == 2}>
                                <a href='albums.php?op=change_state&amp;alb_state=1&amp;alb_id=<{$album.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._CO_WGGALLERY_STATE_ONLINE}>'>
                                    <img src='<{$wggallery_icon_url_16}>state1.png' alt='<{$smarty.const._CO_WGGALLERY_STATE_ONLINE}>'></a>
                                <a href='albums.php?op=change_state&amp;alb_state=0&amp;alb_id=<{$album.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._CO_WGGALLERY_STATE_OFFLINE}>'>
                                    <img src='<{$wggallery_icon_url_16}>state0.png' alt='<{$smarty.const._CO_WGGALLERY_STATE_OFFLINE}>'></a>
                            <{/if}>
                            <a href='albums.php?op=edit&amp;alb_id=<{$album.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._EDIT}>'>
								<img src='<{xoModuleIcons16 'edit.png'}>' alt='<{$smarty.const._EDIT}>'></a>
							<a href='albums.php?op=delete&amp;alb_id=<{$album.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._DELETE}>'>
								<img src='<{xoModuleIcons16 'delete.png'}>' alt='<{$smarty.const._DELETE}>'></a>
                            <{if $album.nb_images|default:0 > 0}>
                                <a href='images.php?op=list&amp;alb_id=<{$album.id}>' title='<{$smarty.const._CO_WGGALLERY_IMAGES}>'>
                                    <img src='<{$wggallery_icon_url_16}>photos.png' alt='<{$smarty.const._CO_WGGALLERY_IMAGES}>'></a>
                            <{/if}>
						</td>
					</tr>
				<{/foreach}>
			</tbody>
		<{/if}>
	</table>
	<div class='clear'>&nbsp;</div>
	<{if !empty($pagenav)}>
		<div class='xo-pagenav floatright'><{$pagenav}></div>
		<div class='clear spacer'></div>
	<{/if}>
<{/if}>
<{if !empty($form)}>
	<{$form}>
    <!-- Modal for selection album image -->
    <div class="modal fade" id="myModalImagePicker" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button id="close-btn" type="button" class="close" data-dismiss="modal"
                            aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Image Gallery</h4>
                </div>
                <div class="modal-body">
                    <{if $images|default:''}>
                        <{foreach item=image from=$images}>
                            <input class="img <{if $image.selected|default:''}>wgg-modal-selected<{/if}>" type="image" src="<{$image.thumb}>" alt="<{$image.title}>"
                                   height="100" width="130" value="<{$image.name}>"
                                   style="padding:3px;">
                        <{/foreach}>
                    <{/if}>
                </div>
            </div>
        </div>
    </div>
    <script type="application/javascript">       
        var modal = document.getElementById('myModalImagePicker');
        $("#myModalImagePicker-btn").click(function(){
            modal.style.display = "block";
        });
        
        $("#close-btn").click(function(){
            modal.style.display = "none";
        });
        $(".img").click(function () {
            modal.style.display = "none";
            $('#alb_imgid').val($(this).attr('value')); 
            var elements = document.getElementsByClassName('wgg-modal-selected');
            while(elements.length > 0){
                elements[0].classList.remove('wgg-modal-selected');
            }
            $(this).addClass("wgg-modal-selected");
            $('#alb_imgid').change();
            
            return false;
        })
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>   
    <style> 
     /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    } 
    .wgg-modal-selected {
        border:2px solid #ff0000;
    }
    </style>
    <!-- End of modal for selection album image -->
<{/if}>

<{if !empty($error)}>
	<div class='errorMsg'><strong><{$error}></strong></div>
<{/if}>
<br>
<!-- Footer --><{include file='db:wggallery_admin_footer.tpl'}>
