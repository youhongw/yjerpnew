function myFunOfMouseOver(iId)
{
	var iIdNow="ID"+iId+"a";
	var nodeObject=document.getElementById(iIdNow);
	if(nodeObject) 
	{
		var infoNow=nodeObject.getAttribute("myDemo");
		var infodisplay=document.getElementById("infodisplay"); 
		infodisplay.innerHTML="<font color='#999999'>"+infoNow+"<font>";   
	}
	return false;
}
function expandRoot(sImagePathPrefix,rootID)
{
	var roootElement=document.getElementById(rootID);
	if(roootElement) 
	{
		if(roootElement.className=="Outline")
		{
			var targetId=roootElement.id+"d";
			var targetElement=document.getElementById(targetId);
			if(targetElement.style.display=="none")
			{
				targetElement.style.display="";
				roootElement.src="<?php echo base_url()?>/assets/tree/tree/ofolder.gif";
				//roootElement.src=sImagePathPrefix+"assets/tree/tree/tree/ofolder.gif";
			}
			else
			{
				targetElement.style.display="none";
				roootElement.src="<?php echo base_url()?>/assets/tree/tree/folder.gif";
				                  
				//roootElement.src=sImagePathPrefix+"assets/tree/tree/tree/folder.gif";
			}
		}
	}
}

var page = 0; //目前點選的頁碼，EX:管理維護系統=>10..
var page_img = new Array(); //每個系統的主圖
page_img[0] = 'ERPFrame.png';
page_img[10] = 'ADMFrame.png';
page_img[101] = 'CMSFrame.png';
page_img[102] = 'INVFrame.png';
page_img[103] = 'PURFrame.png';
page_img[104] = 'COPFrame.png';
page_img[105] = 'ACPFrame.png';
page_img[106] = 'ACRFrame.png';
page_img[107] = 'BOMFrame.png';
page_img[108] = 'MOCFrame.png';
page_img[109] = 'ACTFrame.png';

function OnClickOutline(imgRootPath,iId,page_ac)
{
	if (page_img[iId] && page_img[page] && page >= 1 && page != iId) //收合前一個系統
	{
		var srcElement2=document.getElementById("ID"+page);
		var targetId2=srcElement2.id+"d";
		var targetElement2=document.getElementById(targetId2);
		targetElement2.style.display="none";
		srcElement2.src="<?php echo base_url()?>assets/tree/tree/folder.gif";
	}
 
	var targetId,srcElement,targetElement;
	srcElement=document.getElementById("ID"+iId);
	if(srcElement.className=="Outline"){
		targetId=srcElement.id+"d";
		targetElement=document.getElementById(targetId);
		if(targetElement.style.display =="none"){
			targetElement.style.display="";
			srcElement.src="<?php echo base_url()?>assets/tree/tree/ofolder.gif";
			//srcElement.src=imgRootPath+"assets/tree/tree/tree/ofolder.gif";
			
			if (page_img[iId]) page = iId;
			
		}else{
			targetElement.style.display="none";
			srcElement.src="<?php echo base_url()?>assets/tree/tree/folder.gif";
			//srcElement.src=imgRootPath+"assets/tree/tree/tree/folder.gif";
			if (page_img[iId]) page = 0;
		}
		
	}
       
	if (page_img[page] && page_ac != 1) //page_ac != 1 表示為使用者點選，非系統
	{		
		document.getElementById('abgne_fade_pic').innerHTML = '<img src="<?php echo base_url()?>assets/tree/flowpng2/'+page_img[page]+'" style="padding:5px" id="ad" width="495" height="500" usemap="#Map'+page+'" style="padding-top:5px"/>'; //顯示主圖
		$('html,body').animate({scrollTop:$('#left').offset().top}, 500); //滑動至left
	}
}


function tree_menu_setNow(url,id){
	var obj=$('#'+id).find('a[href="'+url+'"]');
	obj.css('color','#ff6600');
	obj=obj.parent();
	// obj.css('background','#0069D2');
	if(obj.html()){
		while(obj.parent().attr('id') !=id){
			obj=obj.parent();
			obj.prevAll('div:first').find('img:last').attr('src','<?=base_url()?>'+'assets/tree/tree/ofolder.gif');
			obj.show();
		}
	}
}

function delete_menu(id){
	if(confirm('確定要刪除嗎?')){
		$.ajax({
		   type: "POST",
		   url: "delete.php",
		   data: "id="+id,
		   success: function(msg){
			window.location.href=window.location.href;
		   }
		}); 
	}
}