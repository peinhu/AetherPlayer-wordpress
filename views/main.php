<h1 style="  padding: 30px;background: #00A0D2;height: 33px;line-height: 33px;color:#fff;">AetherPlayer</h1>
<b style="font-size:18px;">Edit Playlist</b>
<div style="margin-top:10px;"><a href="upload.php"><button class="button button-primary">+ Upload Resource</button></a></div>
<div id="tip" style="color:#f00;height:30px;line-height:30px;"></div>
<table class="wp-list-table widefat fixed striped media" style="width:50%;float:left;">
	<thead>
		<tr>
			<th scope="col" id="cb" class="manage-column column-cb check-column" style="width:10%;" ></th>
			<th scope="col" id="icon" class="manage-column column-icon" style="width:20%;"></th>
			<th scope="col" id="title" class="manage-column column-title sortable desc" style="width:40%;"><a href="#"><span>Filename</span></a></th>
			<th scope="col" id="author" class="manage-column column-author sortable desc" style="width:30%;"><a href="#"><span>Artist</span></a></th>
		</tr>
	</thead>
	<tbody id="the-list">
	<?php foreach($rows as $row){ 
		$mediaType = substr($row["post_mime_type"],0,5);
		if($mediaType!="image"&&$mediaType!="audio")continue;
		switch($mediaType){
			case 'image':$mediaIcon = $row['guid'];break;
			case 'audio':$mediaIcon = includes_url('/images/media/audio.png');break;
			default:$mediaIcon = '';break;
		}?>
		<tr class="author-self status-inherit" style="overflow:hidden;">
			<th scope="row" class="check-column"><input type="checkbox" class="media-checkbox" id="media<?php echo $row["ID"]?>" name="media" value="<?php echo $row["ID"]?>"  data-mediatype="<?php echo $mediaType?>" data-filename="<?php echo $row["post_title"]?>" data-artist="<?php echo $row["post_excerpt"]?>" data-link="<?php echo $row["guid"]?>" /></th>
			<td class="column-icon media-icon audio-icon" style="vertical-align:middle;overflow:hidden;"><img src="<?php echo $mediaIcon?>" style="max-height:64px;max-width:100%;"></td>
			<td class="title column-title" style="overflow:hidden;"><?php echo $mediaType=="audio"?$row["post_title"]:""?></td>
			<td class="author column-author" style="overflow:hidden;"><?php echo $row["post_excerpt"]?></td>
		</tr>
	<?php }?>
	</tbody>
</table>  
<div style="float:left;width:4%;text-align:center;margin-left:1%;"><button class="button" id="playlist-add">=></button></div>
<table class="wp-list-table fixed striped media" id="aetherplayer-playlist" style="width:40%;float:left;margin-left:1%;border:#e5e5e5 solid 1px;background:#fff;border-spacing:0;">
	<thead >
		<tr style="padding:0;height:35px;">
			<td style="border-bottom:#e5e5e5 solid 1px;width:10%;" ><b style="margin-left:10px;">Playlist</b></td>
			<td style="border-bottom:#e5e5e5 solid 1px;width:45%;"></td>
			<td style="border-bottom:#e5e5e5 solid 1px;width:20%;" ></td>
			<td style="border-bottom:#e5e5e5 solid 1px;width:10%;" ></td>
			<td style="border-bottom:#e5e5e5 solid 1px;width:15%;" ></td>
		</tr>
	</thead>
	<tbody ></tbody>
	<tfoot>
		<tr>
			<td style="text-align:left;height:50px;border-top:#e5e5e5 solid 1px;" colspan="5">
				<form method="post" action="options.php" >
					<?php wp_nonce_field("update-options");?>
					<input type="hidden" name="aetherplayer_playlist" value="" id="aetherplayer_playlist">
					<input type="hidden" name="action" value="update" >
					<input type="hidden" name="page_options" value="aetherplayer_playlist">
					<input type="submit" class="button button-primary"  style="margin-left:10px;" value="Save" id="savePlaylistBtn">
				</form>
			</td>
		</tr>
	</tfoot>
</table>