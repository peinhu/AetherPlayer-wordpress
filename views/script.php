<script>

(function(){

'use strict';

var playList = <?php echo get_option("aetherplayer_playlist")?>,tempItem={};

playlistShow();

document.querySelector("#playlist-add").onclick = function(){
	itemsAdd();
} 

document.querySelector("#savePlaylistBtn").onmousedown = function(){
	playlistSave();
}

//add items to playlist
function itemsAdd(){
	var medias=document.querySelectorAll(".media-checkbox"),itemCheckedIndex_arr = new Array();
	for(var i in medias){
		if(medias[i].checked){
			itemCheckedIndex_arr.push(medias[i].value);
		}
	}
	if(itemsCheck(itemCheckedIndex_arr)){
		showTip(null);
		tempItemCreate("media"+itemCheckedIndex_arr[0],"media"+itemCheckedIndex_arr[1]);
		playlistUpdate("insert",null);
	}else{
		showTip("Please make sure to choose 1 song and 1 cover !");
	}
	itemsClear(medias);
}

//cancel the selection of items
function itemsClear(medias){
	for(var i in medias){
		medias[i].checked = false;
	}
}

//check if the selected items are valid
function itemsCheck(itemIndex){
	if(itemIndex.length!=2)return false;
	var mediatype1 = getMediaItemById("media"+itemIndex[0]).getAttribute("data-mediatype");
	var mediatype2 = getMediaItemById("media"+itemIndex[1]).getAttribute("data-mediatype");
	if(mediatype1==mediatype2)return false;
	return true;
}


function tempItemCreate(id1,id2){
	tempItem = {};
	tempItemSetAttribute(id1);
	tempItemSetAttribute(id2);
}

//save data of temporary item by using attributes
function tempItemSetAttribute(id){
	var node = getMediaItemById(id);
	var mediaType = node.getAttribute("data-mediatype");
	if(mediaType=="audio"){
		tempItem.songName = node.getAttribute("data-filename");
		tempItem.artist = node.getAttribute("data-artist");
		tempItem.songURL = node.getAttribute("data-link");
	}else if(mediaType=="image"){
		tempItem.songCover = node.getAttribute("data-link");
	}
}


function getMediaItemById(id){
	return document.querySelector("#"+id);
}

//display the playlist after it has been changed
function playlistUpdate(action,index){
	if(action=="insert"){
		playList.push(tempItem);
	}else if(action=="delete"){
		playList.splice(index,1);
	}else if(action=="up"){
		playlistItemUp(index);
	}else if(action=="down"){
		playlistItemDown(index);
	}
	playlistShow();
}

function playlistItemUp(index){
	if(index!=0){
		index = parseInt(index);
		var temp = playList[index-1];
		playList[index-1] = playList[index];
		playList[index] = temp;
	}	
}

function playlistItemDown(index){
	if(index!=playList.length-1){
		index = parseInt(index);
		var temp = playList[index+1];
		playList[index+1] = playList[index];
		playList[index] = temp;		
	}	
}

//display the playlist form on the right side of the page
function playlistShow(){
	var html="",arrowUp,arrowDown;
	for(var i in playList){
		i==0?arrowUp="":arrowUp="↑";
		i==playList.length-1?arrowDown="":arrowDown="↓";
		html += "<tr class=\"playlistItem\">";
		html += "<td style=\"text-align:center;\"><a href=\"javascript:void(0)\" style=\"text-decoration:none;\" class=\"itemUp\" data-index="+i+">"+arrowUp+"</a> <a href=\"javascript:void(0)\" style=\"text-decoration:none;\" class=\"itemDown\" data-index="+i+">"+arrowDown+"</a></td>";
		html += "<td style=\"overflow:hidden;text-overflow:ellipsis;white-space: nowrap;\">"+playList[i].songName+"</td>";
		html += "<td style=\"overflow:hidden;text-overflow:ellipsis;white-space: nowrap;\">"+playList[i].artist+"</td>";
		html += "<td style=\"text-align:center;height:30px;overflow:hidden;\"><img src="+playList[i].songCover+" style=\"max-width:100%;max-height:30px;\"></td>";
		html += "<td style=\"text-align:center;\"><a href=\"#\" class=\"itemDelete\" data-index="+i+">delete</a></td>";
		html += "</tr>";
	}
	document.querySelector("#aetherplayer-playlist tbody").innerHTML = html;
	eventRegister();
}

//register the events of the dom node
function eventRegister(){
	var doms = document.querySelectorAll(".playlistItem"),itemDelete,itemUp,itemDown,data_index;
	for(var i=0;i<doms.length;i++){
		itemDelete = doms[i].querySelector('.itemDelete');
		itemDelete.onclick = function(){
			data_index = this.getAttribute('data-index');
			playlistUpdate('delete',data_index);
		}
		itemUp = doms[i].querySelector('.itemUp');
		itemUp.onclick = function(){
			data_index = this.getAttribute('data-index');
			playlistUpdate('up',data_index);
		}
		itemDown = doms[i].querySelector('.itemDown');
		itemDown.onclick = function(){
			data_index = this.getAttribute('data-index');
			playlistUpdate('down',data_index);
		}
	}
	
}

//display or clear the notice tip
function showTip(msg){
	if(msg!=null){
		document.querySelector("#tip").innerHTML = "Notice : "+msg;
	}else{
		document.querySelector("#tip").innerHTML = "";
	}
}

//save the playlist as text
function playlistSave(){
	var playListText = JSON.stringify(playList);
	document.querySelector("#aetherplayer_playlist").value = playListText;
}

})()

</script>