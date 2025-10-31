<!-- 程式展合+- tree_mneu.js-->
<script type="text/javascript"><!-- 
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
				roootElement.src="<?php echo base_url()?>assets/tree/tree/ofolder.gif";
				//roootElement.src=sImagePathPrefix+"assets/tree/tree/tree/ofolder.gif";
			}
			else
			{
				targetElement.style.display="none";
				roootElement.src="<?php echo base_url()?>assets/tree/tree/folder.gif";
				                  
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
page_img[123] = 'SASFrame.png';
page_img[107] = 'BOMFrame.png';
page_img[129] = 'EBOMFrame.png';
page_img[108] = 'MOCFrame.png';
page_img[109] = 'ACTFrame.png';
page_img[126] = 'POSFrame.png';
page_img[110] = 'NOTFrame.png';
page_img[161] = 'AJSFrame.png';
page_img[117] = 'EIVFrame.png';
page_img[146] = 'TAXFrame.png';
page_img[141] = 'ASTFrame.png';
page_img[134] = 'CSTFrame.png';
page_img[111] = 'PALFrame.png';
page_img[113] = 'AMSFrame.png';
page_img[151] = 'EPSFrame.png';
page_img[181] = 'IPSFrame.png';
page_img[125] = 'QMSFrame.png';
page_img[171] = 'SFCFrame.png';
page_img[121] = 'LRPFrame.png';
page_img[131] = 'MRPFrame.png';
page_img[124] = 'MPSFrame.png';
page_img[128] = 'BCSFrame.png';
page_img[191] = 'RMAFrame.png';
//OnClickOutline('',146);
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
       
	if (page_img[page] && page_ac != 1) //page_ac != 1 表示為使用者點選，非系統 500 520
	{		
		document.getElementById('abgne_fade_pic').innerHTML = '<img src="<?php echo base_url()?>assets/tree/flowpng2/'+page_img[page]+'" style="padding:5px" id="ad" width="577" height="545" usemap="#Map'+page+'" style="padding-top:5px"/>'; //顯示主圖
		$('html,body').animate({scrollTop:$('#left').offset().top}, 500); //滑動至left
	}
	//return page_ac;
}


function tree_menu_setNow(url,id){
	var obj=$('#'+id).find('a[href="'+url+'"]');
	obj.css('color','#ff6600');
	obj=obj.parent();
	// obj.css('background','#0069D2');
	if(obj.html()){
		while(obj.parent().attr('id') !=id){
			obj=obj.parent();
			obj.prevAll('div:first').find('img:last').attr('src','<?php echo base_url()?>'+'assets/tree/tree/ofolder.gif');
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
</script>

<!-- 檢查權限設定 不更新網頁 -->  
<script type="text/javascript"><!-- 
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁  共用 
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
	//	alert(xmlHttp);
}
      
   function showadmq05a(sText,oInput){   //不更新網頁 mg004  判斷程式代號權限 
	
	//  alert(oInput);
	 if (!sText || sText != 'Y') { 
	     alert('無此權限!');
	 }
    
	 //應付帳款系統
	 if (sText == 'Y' && oInput == 'ACPB01'){ 
	     window.location="<?php echo base_url()?>index.php/acp/acpb01/batch";
	 }
	  if (sText == 'Y' && oInput == 'ACPI01'){ 
	     window.location="<?php echo base_url()?>index.php/acp/acpi01/display";
	 }
	   if (sText == 'Y' && oInput == 'ACPI02'){ 
	     window.location="<?php echo base_url()?>index.php/acp/acpi02/display";
	 }
	  if (sText == 'Y' && oInput == 'ACPI03'){ 
	     window.location="<?php echo base_url()?>index.php/acp/acpi03/display";
	 }
	  if (sText == 'Y' && oInput == 'ACPR05'){ 
	     window.location="<?php echo base_url()?>index.php/acp/acpr05/printdetail";
	 }
	   if (sText == 'Y' && oInput == 'ACPR12'){ 
	     window.location="<?php echo base_url()?>index.php/acp/acpr12/printdetail";
	 }
	 
	  //應收帳款系統
	 if (sText == 'Y' && oInput == 'ACRB01'){ 
	     window.location="<?php echo base_url()?>index.php/acr/acrb01/batch";
	 }
	  if (sText == 'Y' && oInput == 'ACRI01'){ 
	     window.location="<?php echo base_url()?>index.php/acr/acri01/display";
	 }
	 if (sText == 'Y' && oInput == 'ACRI02'){ 
	     window.location="<?php echo base_url()?>index.php/acr/acri02/display";
	 }
	  if (sText == 'Y' && oInput == 'ACRI03'){ 
	     window.location="<?php echo base_url()?>index.php/acr/acri03/display";
	 }
	 if (sText == 'Y' && oInput == 'ACRR01'){ 
	     window.location="<?php echo base_url()?>index.php/acr/acrr01/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'ACRR03'){ 
	     window.location="<?php echo base_url()?>index.php/acr/acrr03/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ACRR05'){ 
	     window.location="<?php echo base_url()?>index.php/acr/acrr05/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ACRR06'){ 
	     window.location="<?php echo base_url()?>index.php/acr/acrr06/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ACRR17'){ 
	     window.location="<?php echo base_url()?>index.php/acr/acrr17/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'ACRR13'){ 
	     window.location="<?php echo base_url()?>index.php/acr/acrr13/printdetail";
	 }  
	 
     //會計系統
	  if (sText == 'Y' && oInput == 'ACTI01'){ 
	     window.location="<?php echo base_url()?>index.php/act/acti01/updform";
	 } 
      if (sText == 'Y' && oInput == 'ACTI02'){ 
	     window.location="<?php echo base_url()?>index.php/act/acti02/display";
	 } 	 
      if (sText == 'Y' && oInput == 'ACTI03'){ 
	     window.location="<?php echo base_url()?>index.php/act/acti03/display";
	 } 	 
     if (sText == 'Y' && oInput == 'ACTI07'){ 
	     window.location="<?php echo base_url()?>index.php/act/acti07/display";
	 } 
	   if (sText == 'Y' && oInput == 'ACTI10'){ 
	     window.location="<?php echo base_url()?>index.php/act/acti10/display";
	 } 
      if (sText == 'Y' && oInput == 'ACTI13'){ 
	     window.location="<?php echo base_url()?>index.php/act/acti13/display";
	 } 
     if (sText == 'Y' && oInput == 'ACTI14'){ 
	     window.location="<?php echo base_url()?>index.php/act/acti14/updform";
	 } 	
	 
	  if (sText == 'Y' && oInput == 'ACTB01'){ 
	     window.location="<?php echo base_url()?>index.php/act/actb01/batch";
	 } 	
	 if (sText == 'Y' && oInput == 'ACTB02'){ 
	     window.location="<?php echo base_url()?>index.php/act/actb02/batch";
	 } 	
	   if (sText == 'Y' && oInput == 'ACTB04'){ 
	     window.location="<?php echo base_url()?>index.php/act/actb04/batch";
	 } 	
	  if (sText == 'Y' && oInput == 'ACTB06'){ 
	     window.location="<?php echo base_url()?>index.php/act/actb06/batch";
	 } 	
	  if (sText == 'Y' && oInput == 'ACTB09'){ 
	     window.location="<?php echo base_url()?>index.php/act/actb09/batch";
	 } 	
	 
	  if (sText == 'Y' && oInput == 'ACTR08'){ 
	     window.location="<?php echo base_url()?>index.php/act/actr08/printdetail";
	 } 
      if (sText == 'Y' && oInput == 'ACTR09'){ 
	     window.location="<?php echo base_url()?>index.php/act/actr09/printdetail";
	 } 
      if (sText == 'Y' && oInput == 'ACTR12'){ 
	     window.location="<?php echo base_url()?>index.php/act/actr12/printdetail";
	 } 
      if (sText == 'Y' && oInput == 'ACTR20'){ 
	     window.location="<?php echo base_url()?>index.php/act/actr20/printdetail";
	 } 
      if (sText == 'Y' && oInput == 'ACTR21'){ 
	     window.location="<?php echo base_url()?>index.php/act/actr21/printdetail";
	 } 
     if (sText == 'Y' && oInput == 'ACTR22'){ 
	     window.location="<?php echo base_url()?>index.php/act/actr22/printdetail";
	 } 	 
	 
	 //管理系統
	 if (sText == 'Y' && oInput == 'ADMI01'){ 
	     window.location="<?php echo base_url()?>index.php/adm/admi01/display";
	 } 
     if (sText == 'Y' && oInput == 'ADMI02'){ 
	     window.location.href="<?php echo base_url()?>index.php/adm/admi02/display";
	 } 	
	  if (sText == 'Y' && oInput == 'ADMI03'){ 
	     window.location.href="<?php echo base_url()?>index.php/adm/admi03/display";
	 } 
     if (sText == 'Y' && oInput == 'ADMI04'){ 
	     window.location="<?php echo base_url()?>index.php/adm/admi04/display";
	 } 	
     if (sText == 'Y' && oInput == 'ADMI10'){ 
	     window.location="<?php echo base_url()?>index.php/adm/admi10/display";
	 } 	
     if (sText == 'Y' && oInput == 'ADMI05'){ 
	     window.location="<?php echo base_url()?>index.php/adm/admi05/display";
	 } 
     if (sText == 'Y' && oInput == 'ADMI06'){ 
	     window.location="<?php echo base_url()?>index.php/adm/admi06/display";
	 } 		 
	 
	
	 //產品結構系統
	 if (sText == 'Y' && oInput == 'BOMI01'){ 
	     window.location="<?php echo base_url()?>index.php/bom/bomi01/display";
	 } 	 
	 if (sText == 'Y' && oInput == 'BOMI02'){ 
	     window.location="<?php echo base_url()?>index.php/bom/bomi02/display";
	 } 	 
	 if (sText == 'Y' && oInput == 'BOMI03'){ 
	     window.location="<?php echo base_url()?>index.php/bom/bomi03/display";
	 } 
	 if (sText == 'Y' && oInput == 'BOMI04'){ 
	     window.location="<?php echo base_url()?>index.php/bom/bomi04/display";
	 }
	 if (sText == 'Y' && oInput == 'BOMI05'){ 
	     window.location="<?php echo base_url()?>index.php/bom/bomi05/display";
	 }
	  if (sText == 'Y' && oInput == 'BOMI06'){ 
	     window.location="<?php echo base_url()?>index.php/bom/bomi06/display";
	 }
	  if (sText == 'Y' && oInput == 'BOMI07'){ 
	     window.location="<?php echo base_url()?>index.php/bom/bomi07/display";
	 }
 	 
	 if (sText == 'Y' && oInput == 'BOMB05'){ 
	     window.location="<?php echo base_url()?>index.php/bom/bomb05/batch";
	 } 	 
	 if (sText == 'Y' && oInput == 'BOMB06'){ 
	     window.location="<?php echo base_url()?>index.php/bom/bomb06/batch";
	 }
	 if (sText == 'Y' && oInput == 'BOMB07'){ 
	     window.location="<?php echo base_url()?>index.php/bom/bomb07/batch";
	 }
	 
    if (sText == 'Y' && oInput == 'BOMR01'){ 
	     window.location="<?php echo base_url()?>index.php/bom/bomr01/printdetail";
	 } 	
    if (sText == 'Y' && oInput == 'BOMR02'){ 
	     window.location="<?php echo base_url()?>index.php/bom/bomr02/printdetail";
	 } 	
    if (sText == 'Y' && oInput == 'BOMR03'){ 
	     window.location="<?php echo base_url()?>index.php/bom/bomr03/printdetail";
	 } 		 
	  if (sText == 'Y' && oInput == 'BOMR04'){ 
	     window.location="<?php echo base_url()?>index.php/bom/bomr04/printdetail";
	 } 		
	  if (sText == 'Y' && oInput == 'BOMR05'){ 
	     window.location="<?php echo base_url()?>index.php/bom/bomr05/printdetail";
	 } 		
	  if (sText == 'Y' && oInput == 'BOMR06'){ 
	     window.location="<?php echo base_url()?>index.php/bom/bomr06/printdetail";
	 } 		
     if (sText == 'Y' && oInput == 'BOMR07'){ 
	     window.location="<?php echo base_url()?>index.php/bom/bomr07/printdetail";
	 } 	
    if (sText == 'Y' && oInput == 'BOMR08'){ 
	     window.location="<?php echo base_url()?>index.php/bom/bomr08/printdetail";
	 } 
	 
	 
	 
	 //基本資料
	  if (sText == 'Y' && oInput == 'CMSI01'){ 
	     window.location="<?php echo base_url()?>index.php/cms/cmsi01/updform";
	 }
	 
	  if (sText == 'Y' && oInput == 'CMSI02'){ 
	     window.location="<?php echo base_url()?>index.php/cms/cmsi02/display";
	 } 	 
    if (sText == 'Y' && oInput == 'CMSI03'){ 
	     window.location="<?php echo base_url()?>index.php/cms/cmsi03/display";
	 } 	
	   if (sText == 'Y' && oInput == 'CMSI04'){ 
	     window.location="<?php echo base_url()?>index.php/cms/cmsi04/display";
	 } 	
    if (sText == 'Y' && oInput == 'CMSI05'){ 
	     window.location="<?php echo base_url()?>index.php/cms/cmsi05/display";
	 }
	 if (sText == 'Y' && oInput == 'CMSI06'){ 
	     window.location="<?php echo base_url()?>index.php/cms/cmsi06/display";
	 }
	 if (sText == 'Y' && oInput == 'CMSI09'){ 
	     window.location="<?php echo base_url()?>index.php/cms/cmsi09/display";
	 }
      if (sText == 'Y' && oInput == 'CMSI10'){ 
	     window.location="<?php echo base_url()?>index.php/cms/cmsi10/display";
	 } 		
      if (sText == 'Y' && oInput == 'CMSI11'){ 
	     window.location="<?php echo base_url()?>index.php/cms/cmsi11/display";
	 } 		 	 
	   if (sText == 'Y' && oInput == 'CMSI12'){ 
	     window.location="<?php echo base_url()?>index.php/cms/cmsi12/display";
	 } 		
	  if (sText == 'Y' && oInput == 'CMSI14'){ 
	     window.location="<?php echo base_url()?>index.php/cms/cmsi14/updform";
	 }
     if (sText == 'Y' && oInput == 'CMSI15'){ 
	     window.location="<?php echo base_url()?>index.php/cms/cmsi15/display";
	 } 	
	   if (sText == 'Y' && oInput == 'CMSI16'){ 
	     window.location="<?php echo base_url()?>index.php/cms/cmsi16/display";
	 } 	
      if (sText == 'Y' && oInput == 'CMSI17'){ 
	     window.location="<?php echo base_url()?>index.php/cms/cmsi17/display";
	 } 			 
	   if (sText == 'Y' && oInput == 'CMSI19'){ 
	     window.location="<?php echo base_url()?>index.php/cms/cmsi19/display";
	 } 		
	 if (sText == 'Y' && oInput == 'CMSI21'){ 
	     window.location="<?php echo base_url()?>index.php/cms/cmsi21/display";
	 } 	
	 
	 
	 //訂單系統
	 if (sText == 'Y' && oInput == 'COPI01'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copi01/display";
	 } 	 
	 if (sText == 'Y' && oInput == 'COPI02'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copi02/display";
	 } 	 
	  if (sText == 'Y' && oInput == 'COPB02'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copb02/display";
	 } 	 
	   if (sText == 'Y' && oInput == 'COPB03'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copb03/batch";
	 } 	 
	  if (sText == 'Y' && oInput == 'COPB07'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copb07/batch";
	 } 	 
	 if (sText == 'Y' && oInput == 'COPI03'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copi03/display";
	 } 	 
	  if (sText == 'Y' && oInput == 'COPI04'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copi04/display";
	 } 	 
	 if (sText == 'Y' && oInput == 'COPI05'){ 
	      window.location="<?php echo base_url()?>index.php/cop/copi05/display"; target="_newblank";
		//  window.open="<?php echo base_url()?>index.php/cop/copi05/display";
	 }
	 if (sText == 'Y' && oInput == 'COPI06'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copi06/display";
	 } 	
	 if (sText == 'Y' && oInput == 'COPI07'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copi07/display";
	 } 	
	 if (sText == 'Y' && oInput == 'COPI08'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copi08/display";
	 } 	
	 if (sText == 'Y' && oInput == 'COPI09'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copi09/display";
	 } 		 
	 if (sText == 'Y' && oInput == 'COPI10'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copi10/display";
	 } 	
	  if (sText == 'Y' && oInput == 'COPI81'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copi81/display";
	 } 	
	  if (sText == 'Y' && oInput == 'COPI82'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copi82/display";
	 } 	
	   if (sText == 'Y' && oInput == 'COPI83'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copi83/display";
	 } 
	   if (sText == 'Y' && oInput == 'COPI84'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copi84/display";
	 } 
    	 
	 
    //訂單報表	
	
	 if (sText == 'Y' && oInput == 'COPQ02'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copq02/printdetail";
	 }
	 
	 if (sText == 'Y' && oInput == 'COPR20'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copr20/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'COPR21'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copr21/printdetail";
	 } 		
	  if (sText == 'Y' && oInput == 'COPR22'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copr22/printdetail";
	 } 		
	  if (sText == 'Y' && oInput == 'COPR23'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copr23/printdetail";
	 } 	
     if (sText == 'Y' && oInput == 'COPR24'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copr24/printdetail";
	 } 
      if (sText == 'Y' && oInput == 'COPR25'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copr25/printdetail";
	 } 	
      if (sText == 'Y' && oInput == 'COPR26'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copr26/printdetail";
	 } 	
      if (sText == 'Y' && oInput == 'COPR27'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copr27/printdetail";
	 } 		
     if (sText == 'Y' && oInput == 'COPR28'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copr28/printdetail";
	 } 		 
	 if (sText == 'Y' && oInput == 'COPR05'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copr05/printdetail";
	 } 
	  if (sText == 'Y' && oInput == 'COPE05'){ 
	     window.location="<?php echo base_url()?>index.php/cop/cope05/exceldetail";
	 } 
      if (sText == 'Y' && oInput == 'COPR06'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copr06/printdetail";
	 } 
      if (sText == 'Y' && oInput == 'COPR07'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copr07/printdetail";
	 } 
      if (sText == 'Y' && oInput == 'COPR08'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copr08/printdetail";
	 } 	 
	  if (sText == 'Y' && oInput == 'COPE08'){ 
	     window.location="<?php echo base_url()?>index.php/cop/cope08/exceldetail";
	 } 	 
	 if (sText == 'Y' && oInput == 'COPR03'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copr03/printdetail";
	 } 		
	 if (sText == 'Y' && oInput == 'COPR31'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copr31/printdetail";
	 } 			 
	 
	  //POS門市系統
	 if (sText == 'Y' && oInput == 'POSI01'){ 
	     window.location="<?php echo base_url()?>index.php/pos/posi01/updform";
	 } 	 
	  if (sText == 'Y' && oInput == 'POSI02'){ 
	     window.location="<?php echo base_url()?>index.php/pos/posi02/display";
	 } 	 
	  if (sText == 'Y' && oInput == 'POSI03'){ 
	     window.location="<?php echo base_url()?>index.php/pos/posi03/display";
	 } 	 
	  if (sText == 'Y' && oInput == 'POSI04'){ 
	     window.location="<?php echo base_url()?>index.php/pos/posi04/display";
	 } 	 
	  if (sText == 'Y' && oInput == 'POSI05'){ 
	     window.location="<?php echo base_url()?>index.php/pos/posi05/display";
	 } 	
	   if (sText == 'Y' && oInput == 'POSI06'){ 
	     window.location="<?php echo base_url()?>index.php/pos/posi06/display";
	 } 	
      if (sText == 'Y' && oInput == 'POSI11'){ 
	     window.location="<?php echo base_url()?>index.php/pos/posi11/display";
	 } 	 
      if (sText == 'Y' && oInput == 'POSQ01'){ 
	     window.location="<?php echo base_url()?>index.php/pos/posq01/display";
	 } 	 	
        if (sText == 'Y' && oInput == 'POSR01'){ 
	     window.location="<?php echo base_url()?>index.php/pos/posr01/display";
	 } 	 	
       if (sText == 'Y' && oInput == 'POSR02'){ 
	     window.location="<?php echo base_url()?>index.php/pos/posr02/exceldetail";
	 } 	 		
       if (sText == 'Y' && oInput == 'POSR03'){ 
	     window.location="<?php echo base_url()?>index.php/pos/posr03/printdetail";
	 } 	 		
       if (sText == 'Y' && oInput == 'POSR04'){ 
	     window.location="<?php echo base_url()?>index.php/pos/posr04/printdetail";
	 } 	 		 
	   if (sText == 'Y' && oInput == 'POSR05'){ 
	     window.location="<?php echo base_url()?>index.php/pos/posr05/printdetail";
	 } 	 	
	 //庫存系統 
	  if (sText == 'Y' && oInput == 'INVB01'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invb01/batch";
	 } 	 
	 if (sText == 'Y' && oInput == 'INVB02'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invb02/batch";
	 } 	 
	 if (sText == 'Y' && oInput == 'INVB03'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invb03/batch";
	 } 	 
	 if (sText == 'Y' && oInput == 'INVB06'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invb06/batch";
	 } 	 
	  if (sText == 'Y' && oInput == 'INVB07'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invb07/batch";
	 } 	 
	  if (sText == 'Y' && oInput == 'INVB08'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invb08/batch";
	 } 	 
	 if (sText == 'Y' && oInput == 'INVB09'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invb09/batch";
	 } 	 
	  if (sText == 'Y' && oInput == 'INVB13'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invb13/batch";
	 } 	 
	  if (sText == 'Y' && oInput == 'INVB14'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invb14/batch";
	 } 	
	 if (sText == 'Y' && oInput == 'INVI01'){
		 window.location="<?php echo base_url()?>index.php/inv/invi01/display";
	 } 	 
	  if (sText == 'Y' && oInput == 'INVI02'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invi02/display";
	 } 
	  if (sText == 'Y' && oInput == 'INVI03'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invi03/display";
	 }  
	 
      if (sText == 'Y' && oInput == 'INVI04'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invi04/display";
	 }
	  if (sText == 'Y' && oInput == 'INVI05'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invi05/display";
	 }
	 if (sText == 'Y' && oInput == 'INVI06'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invi06/display";
	 }
	 if (sText == 'Y' && oInput == 'INVI07'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invi07/display";
	 }
      if (sText == 'Y' && oInput == 'INVI08'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invi08/display";
	 }
	   if (sText == 'Y' && oInput == 'INVI09'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invi09/display";
	 }
	   if (sText == 'Y' && oInput == 'INVI14'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invi14/display";
	 }
	   if (sText == 'Y' && oInput == 'INVI15'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invi15/display";
	 }
	   if (sText == 'Y' && oInput == 'INVI16'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invi16/display";
	 }
	    if (sText == 'Y' && oInput == 'INVI81'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invi81/display";
	 }
	  if (sText == 'Y' && oInput == 'INVQ02'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invq02/display";
	 }
	  if (sText == 'Y' && oInput == 'INVQ03'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invq03/display";
	 }
	 
    //庫存報表 
	 if (sText == 'Y' && oInput == 'INVR13'){
		 window.location="<?php echo base_url()?>index.php/inv/invr13/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'INVR18'){
		 window.location="<?php echo base_url()?>index.php/inv/invr18/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'INVR19'){
		 window.location="<?php echo base_url()?>index.php/inv/invr19/printdetail";
	 } 
	  if (sText == 'Y' && oInput == 'INVR20'){
		 window.location="<?php echo base_url()?>index.php/inv/invr20/printdetail";
	 }
	  if (sText == 'Y' && oInput == 'INVR21'){
		 window.location="<?php echo base_url()?>index.php/inv/invr21/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'INVR22'){
		 window.location="<?php echo base_url()?>index.php/inv/invr22/printdetail";
	 } 	 
     
	 //製令系統
     if (sText == 'Y' && oInput == 'MOCI10'){ 
	     window.location="<?php echo base_url()?>index.php/moc/moci10/display";
	 } 
     if (sText == 'Y' && oInput == 'MOCI01'){ 
	     window.location="<?php echo base_url()?>index.php/moc/moci01/display";
	 }
     if (sText == 'Y' && oInput == 'MOCI02'){ 
	     window.location="<?php echo base_url()?>index.php/moc/moci02/display";
	 }
     if (sText == 'Y' && oInput == 'MOCI03'){ 
	     window.location="<?php echo base_url()?>index.php/moc/moci03/display";
	 } 
     if (sText == 'Y' && oInput == 'MOCI04'){ 
	     window.location="<?php echo base_url()?>index.php/moc/moci04/display";
	 } 
     if (sText == 'Y' && oInput == 'MOCI06'){ 
	     window.location="<?php echo base_url()?>index.php/moc/moci06/display";
	 } 
     if (sText == 'Y' && oInput == 'MOCI07'){ 
	     window.location="<?php echo base_url()?>index.php/moc/moci07/display";
	 } 
	  if (sText == 'Y' && oInput == 'MOCI09'){ 
	     window.location="<?php echo base_url()?>index.php/moc/moci09/display";
	 } 
     if (sText == 'Y' && oInput == 'MOCI05'){ 
	     window.location="<?php echo base_url()?>index.php/moc/moci05/display";
	 }
     if (sText == 'Y' && oInput == 'MOCI12'){ 
	     window.location="<?php echo base_url()?>index.php/moc/moci12/display";
	 }  	 
	 
	  //票據資金系統
     if (sText == 'Y' && oInput == 'NOTI01'){ 
	     window.location="<?php echo base_url()?>index.php/not/noti01/display";
	 } 
	  if (sText == 'Y' && oInput == 'NOTI02'){ 
	     window.location="<?php echo base_url()?>index.php/not/noti02/display";
	 } 
	   if (sText == 'Y' && oInput == 'NOTI03'){ 
	     window.location="<?php echo base_url()?>index.php/not/noti03/display";
	 } 
	   if (sText == 'Y' && oInput == 'NOTI04'){ 
	     window.location="<?php echo base_url()?>index.php/not/noti04/display";
	 } 
	   if (sText == 'Y' && oInput == 'NOTI08'){ 
	     window.location="<?php echo base_url()?>index.php/not/noti08/display";
	 } 
	   if (sText == 'Y' && oInput == 'NOTI09'){ 
	     window.location="<?php echo base_url()?>index.php/not/noti09/display";
	 } 
	 if (sText == 'Y' && oInput == 'NOTI11'){ 
	     window.location="<?php echo base_url()?>index.php/not/noti11/updform";
	 } 
	 if (sText == 'Y' && oInput == 'NOTI06'){ 
	     window.location="<?php echo base_url()?>index.php/not/noti06/display";
	 } 
	 if (sText == 'Y' && oInput == 'NOTI13'){ 
	     window.location="<?php echo base_url()?>index.php/not/noti13/display";
	 } 
	  if (sText == 'Y' && oInput == 'NOTI14'){ 
	     window.location="<?php echo base_url()?>index.php/not/noti14/display";
	 } 
	 //自動分錄系統
	 if (sText == 'Y' && oInput == 'AJSB01'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsb01/batch";
	 } 	
	 if (sText == 'Y' && oInput == 'AJSB02'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsb02/batch";
	 } 
	 if (sText == 'Y' && oInput == 'AJSB03'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsb03/batch";
	 } 
	 if (sText == 'Y' && oInput == 'AJSB04'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsb04/batch";
	 } 
	 
     if (sText == 'Y' && oInput == 'AJSI01'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi01/updform";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI02'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi02/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI03'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi03/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI04'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi04/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI05'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi05/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI06'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi06/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI07'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi07/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI08'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi08/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI09'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi09/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI10'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi10/display";
	 } 
	  if (sText == 'Y' && oInput == 'AJSI20'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi20/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI31'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi31/display";
	 } 
	 //電子發票系統
	 if (sText == 'Y' && oInput == 'EIVI11'){ 
	     window.location="<?php echo base_url()?>index.php/eiv/eivi11/display";
	 } 
	 //人事系統
     if (sText == 'Y' && oInput == 'PALI01'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali01/display";
	 } 
	 if (sText == 'Y' && oInput == 'PALI02'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali02/display";
	 } 
	 if (sText == 'Y' && oInput == 'PALI03'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali03/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI04'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali04/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI05'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali05/updform";
	 } 
	 if (sText == 'Y' && oInput == 'PALI08'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali08/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI09'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali09/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI10'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali10/display";
	 } 
	 if (sText == 'Y' && oInput == 'PALI11'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali11/display";
	 } 
	 if (sText == 'Y' && oInput == 'PALI12'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali12/display";
	 } 
	 if (sText == 'Y' && oInput == 'PALI13'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali13/display";
	 } 
	 
	 if (sText == 'Y' && oInput == 'PALI16'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali16/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI17'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali17/display";
	 } 
	 if (sText == 'Y' && oInput == 'PALI18'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali18/display";
	 } 
	 	  if (sText == 'Y' && oInput == 'PALI20'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali20/display";
	 } 
	 	  if (sText == 'Y' && oInput == 'PALI21'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali21/display";
	 } 
	 	  if (sText == 'Y' && oInput == 'PALI22'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali22/display";
	 } 
	 	  if (sText == 'Y' && oInput == 'PALI23'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali23/display";
	 } 
	 	  if (sText == 'Y' && oInput == 'PALI24'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali24/display";
		  } 
		   if (sText == 'Y' && oInput == 'PALI25'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali25/display";
	      } 
		   if (sText == 'Y' && oInput == 'PALI26'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali26/display";
	      } 
		    if (sText == 'Y' && oInput == 'PALI27'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali27/display";
	      } 
	  if (sText == 'Y' && oInput == 'PALI29'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali29/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI31'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali31/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI32'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali32/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI33'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali33/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI35'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali35/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI40'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali40/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI41'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali41/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI42'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali42/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI43'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali43/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI44'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali44/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI45'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali45/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI46'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali46/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI47'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali47/display";
	 } 
	   if (sText == 'Y' && oInput == 'PALI48'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali48/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI49'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali49/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI51'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali51/updform";
	 } 
	  if (sText == 'Y' && oInput == 'PALR30'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr30/printdetail";
	 } 	
	   if (sText == 'Y' && oInput == 'PALR31'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr31/printdetail";
	 } 	
	   if (sText == 'Y' && oInput == 'PALR32'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr32/printdetail";
	 } 	
	   if (sText == 'Y' && oInput == 'PALR33'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr33/printdetail";
	 } 	
	   if (sText == 'Y' && oInput == 'PALR34'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr34/printdetail";
	 } 	
	  if (sText == 'Y' && oInput == 'PALR35'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr35/printdetail";
	 } 	
	   if (sText == 'Y' && oInput == 'PALR36'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr36/printdetail";
	 } 	
	 if (sText == 'Y' && oInput == 'PALR41'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr41/printdetail";
	 } 	
	 if (sText == 'Y' && oInput == 'PALR42'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr42/printdetail";
	 } 	
	 if (sText == 'Y' && oInput == 'PALR43'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr43/printdetail";
	 } 	
	 if (sText == 'Y' && oInput == 'PALR44'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr44/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'PALR45'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr45/printdetail";
	 } 
	  if (sText == 'Y' && oInput == 'PALR46'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr46/printdetail";
	 } 
      if (sText == 'Y' && oInput == 'PALR47'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr47/printdetail";
	 } 	 
      if (sText == 'Y' && oInput == 'PALR48'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr48/printdetail";
	 } 	 	 
	 if (sText == 'Y' && oInput == 'PALR49'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr49/printdetail";
	 } 	 
	 if (sText == 'Y' && oInput == 'PALR50'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr50/printdetail";
	 } 	 
	 if (sText == 'Y' && oInput == 'PALR51'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr51/printdetail";
	 } 	 
	 if (sText == 'Y' && oInput == 'PALR52'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr52/printdetail";
	 } 	 
	  if (sText == 'Y' && oInput == 'PALR53'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr53/printdetail";
	 } 	 
	 if (sText == 'Y' && oInput == 'PALR54'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr54/printdetail";
	 } 	 
	 if (sText == 'Y' && oInput == 'PALR55'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr55/printdetail";
	 } 	 
	 if (sText == 'Y' && oInput == 'PALR56'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr56/printdetail";
	 } 	 
	  if (sText == 'Y' && oInput == 'PALR57'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr57/printdetail";
	 } 	 
	   if (sText == 'Y' && oInput == 'PALR58'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr58/printdetail";
	 } 	 
	   if (sText == 'Y' && oInput == 'PALR59'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr59/printdetail";
	 } 	 
	  if (sText == 'Y' && oInput == 'PALR61'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr61/printdetail";
	 } 	 
	  if (sText == 'Y' && oInput == 'PALB01'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palb01/batch";
	 } 	 
	   if (sText == 'Y' && oInput == 'PALB02'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palb02/batch";
	 } 	 
	  if (sText == 'Y' && oInput == 'PALB03'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palb03/batch";
	 } 	 
	  if (sText == 'Y' && oInput == 'PALB35'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palb35/batch";
	 } 
	 if (sText == 'Y' && oInput == 'PALB40'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palb40/batch";
	 } 
	  if (sText == 'Y' && oInput == 'PALB41'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palb41/batch";
	 } 
	  if (sText == 'Y' && oInput == 'PALB42'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palb42/batch";
	 } 
	   if (sText == 'Y' && oInput == 'PALB51'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palb51/index";
	 } 	
      if (sText == 'Y' && oInput == 'PALB52'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palb52/batch";
	 } 	 	 
	  if (sText == 'Y' && oInput == 'PALB53'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palb53/batch";
	 } 	 
	   if (sText == 'Y' && oInput == 'PALB56'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palb56/batch";
	 } 	 
	  if (sText == 'Y' && oInput == 'PALB61'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palb61/batch";
	 } 	 
	  if (sText == 'Y' && oInput == 'PALB62'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palb62/batch";
	 } 	 
	   if (sText == 'Y' && oInput == 'PALQ41'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palq41/display";
	 } 	
	  if (sText == 'Y' && oInput == 'PALI52'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali52/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI53'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali53/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI54'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali54/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI55'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali55/display";
	 } 
	   if (sText == 'Y' && oInput == 'PALI56'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali56/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI57'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali57/display";
	 } 
	 //採購系統
     if (sText == 'Y' && oInput == 'PURB01'){ 
	     window.location="<?php echo base_url()?>index.php/pur/purb01/batch";
	 } 
	  if (sText == 'Y' && oInput == 'PURB05'){ 
	     window.location="<?php echo base_url()?>index.php/pur/purb05/display";
	 } 
	   if (sText == 'Y' && oInput == 'PURB07'){ 
	     window.location="<?php echo base_url()?>index.php/pur/purb07/display";
	 } 
	   if (sText == 'Y' && oInput == 'PURB09'){ 
	     window.location="<?php echo base_url()?>index.php/pur/purb09/display";
	 } 
	   if (sText == 'Y' && oInput == 'PURB11'){ 
	     window.location="<?php echo base_url()?>index.php/pur/purb11/display";
	 } 
	    if (sText == 'Y' && oInput == 'PURB13'){ 
	     window.location="<?php echo base_url()?>index.php/pur/purb13/batch";
	 } 
	 if (sText == 'Y' && oInput == 'PURI01'){ 
	     window.location="<?php echo base_url()?>index.php/pur/puri01/display";
	 } 
	  if (sText == 'Y' && oInput == 'PURI02'){ 
	     window.location="<?php echo base_url()?>index.php/pur/puri02/display";
	 } 
	 if (sText == 'Y' && oInput == 'PURI03'){ 
	     window.location="<?php echo base_url()?>index.php/pur/puri03/display";
	 } 
	 if (sText == 'Y' && oInput == 'PURI04'){ 
	     window.location="<?php echo base_url()?>index.php/pur/puri04/display";
	 } 
     if (sText == 'Y' && oInput == 'PURI05'){ 
	     window.location="<?php echo base_url()?>index.php/pur/puri05/display";
	 } 	 	 	
     if (sText == 'Y' && oInput == 'PURI06'){ 
	     window.location="<?php echo base_url()?>index.php/pur/puri06/display";
	 }
    if (sText == 'Y' && oInput == 'PURI07'){ 
	     window.location="<?php echo base_url()?>index.php/pur/puri07/display";
	 } 	 	 
    if (sText == 'Y' && oInput == 'PURI09'){ 
	     window.location="<?php echo base_url()?>index.php/pur/puri09/display";
	 } 	 	 
    if (sText == 'Y' && oInput == 'PURI11'){ 
	     window.location="<?php echo base_url()?>index.php/pur/puri11/display";
	 } 	 	 	 
	//固定資產系統
     if (sText == 'Y' && oInput == 'ASTI01'){ 
	     window.location="<?php echo base_url()?>index.php/ast/asti01/display";
	 } 
	 if (sText == 'Y' && oInput == 'ASTI02'){ 
	     window.location="<?php echo base_url()?>index.php/ast/asti02/display";
	 } 
	 if (sText == 'Y' && oInput == 'ASTI03'){ 
	     window.location="<?php echo base_url()?>index.php/ast/asti03/display";
	 } 
	 if (sText == 'Y' && oInput == 'ASTI04'){ 
	     window.location="<?php echo base_url()?>index.php/ast/asti04/display";
	 } 
	 if (sText == 'Y' && oInput == 'ASTI05'){ 
	     window.location="<?php echo base_url()?>index.php/ast/asti05/display";
	 } 
	 if (sText == 'Y' && oInput == 'ASTI06'){ 
	     window.location="<?php echo base_url()?>index.php/ast/asti06/display";
	 } 
	 if (sText == 'Y' && oInput == 'ASTI07'){ 
	     window.location="<?php echo base_url()?>index.php/ast/asti07/display";
	 } 
	 if (sText == 'Y' && oInput == 'ASTI08'){ 
	     window.location="<?php echo base_url()?>index.php/ast/asti08/display";
	 } 
	 if (sText == 'Y' && oInput == 'ASTI09'){ 
	     window.location="<?php echo base_url()?>index.php/ast/asti09/display";
	 } 
	 if (sText == 'Y' && oInput == 'ASTI10'){ 
	     window.location="<?php echo base_url()?>index.php/ast/asti10/display";
	 } 
	 if (sText == 'Y' && oInput == 'ASTI13'){ 
	     window.location="<?php echo base_url()?>index.php/ast/asti13/display";
	 } 
	 if (sText == 'Y' && oInput == 'ASTI14'){ 
	     window.location="<?php echo base_url()?>index.php/ast/asti14/display";
	 } 
	  if (sText == 'Y' && oInput == 'ASTI15'){ 
	     window.location="<?php echo base_url()?>index.php/ast/asti15/updform";
	 } 
	 if (sText == 'Y' && oInput == 'ASTR01'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astr01/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ASTR02'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astr02/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ASTR03'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astr03/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ASTR04'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astr04/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ASTR05'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astr05/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ASTR06'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astr06/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ASTR06'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astr06/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ASTR07'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astr07/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ASTR08'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astr08/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ASTR09'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astr09/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ASTR10'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astr10/printdetail";
	 } 
	  //成本計算系統
     if (sText == 'Y' && oInput == 'CSTI01'){ 
	     window.location="<?php echo base_url()?>index.php/cst/csti01/updform";
	 } 
	  if (sText == 'Y' && oInput == 'CSTI02'){ 
	     window.location="<?php echo base_url()?>index.php/cst/csti02/display";
	 } 
	  if (sText == 'Y' && oInput == 'CSTI03'){ 
	     window.location="<?php echo base_url()?>index.php/cst/csti03/display";
	 } 
	  if (sText == 'Y' && oInput == 'CSTI04'){ 
	     window.location="<?php echo base_url()?>index.php/cst/csti04/display";
	 } 
	  if (sText == 'Y' && oInput == 'CSTI05'){ 
	     window.location="<?php echo base_url()?>index.php/cst/csti05/display";
	 } 
	  if (sText == 'Y' && oInput == 'CSTI06'){ 
	     window.location="<?php echo base_url()?>index.php/cst/csti06/display";
	 } 
	  if (sText == 'Y' && oInput == 'CSTR01'){ 
	     window.location="<?php echo base_url()?>index.php/cst/cstr01/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'CSTR02'){ 
	     window.location="<?php echo base_url()?>index.php/cst/cstr02/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'CSTR03'){ 
	     window.location="<?php echo base_url()?>index.php/cst/cstr03/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'CSTR04'){ 
	     window.location="<?php echo base_url()?>index.php/cst/cstr04/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'CSTR05'){ 
	     window.location="<?php echo base_url()?>index.php/cst/cstr05/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'CSTR06'){ 
	     window.location="<?php echo base_url()?>index.php/cst/cstr06/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'CSTR07'){ 
	     window.location="<?php echo base_url()?>index.php/cst/cstr07/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'CSTR08'){ 
	     window.location="<?php echo base_url()?>index.php/cst/cstr08/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'CSTR09'){ 
	     window.location="<?php echo base_url()?>index.php/cst/cstr09/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'CSTR10'){ 
	     window.location="<?php echo base_url()?>index.php/cst/cstr10/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'CSTR11'){ 
	     window.location="<?php echo base_url()?>index.php/cst/cstr11/printdetail";
	 } 
	 //發票系統
     if (sText == 'Y' && oInput == 'TAXI01'){ 
	     window.location="<?php echo base_url()?>index.php/tax/taxi01/display";
	 } 
	 if (sText == 'Y' && oInput == 'TAXI02'){ 
	     window.location="<?php echo base_url()?>index.php/tax/taxi02/display";
	 } 
	 if (sText == 'Y' && oInput == 'TAXI03'){ 
	     window.location="<?php echo base_url()?>index.php/tax/taxi03/display";
	 } 
	 if (sText == 'Y' && oInput == 'TAXI04'){ 
	     window.location="<?php echo base_url()?>index.php/tax/taxi04/display";
	 } 
	 if (sText == 'Y' && oInput == 'TAXI05'){ 
	     window.location="<?php echo base_url()?>index.php/tax/taxi05/display";
	 } 
	 if (sText == 'Y' && oInput == 'TAXI06'){ 
	     window.location="<?php echo base_url()?>index.php/tax/taxi06/display";
	 } 
	  if (sText == 'Y' && oInput == 'TAXI07'){ 
	     window.location="<?php echo base_url()?>index.php/tax/taxi07/display";
	 } 
	  if (sText == 'Y' && oInput == 'TAXR01'){ 
	     window.location="<?php echo base_url()?>index.php/tax/taxr01/printdetail";
	 } 	 
	 if (sText == 'Y' && oInput == 'TAXR02'){ 
	     window.location="<?php echo base_url()?>index.php/tax/taxr02/printdetail";
	 } 	
	 if (sText == 'Y' && oInput == 'TAXR03'){ 
	     window.location="<?php echo base_url()?>index.php/tax/taxr03/printdetail";
	 } 	
	 if (sText == 'Y' && oInput == 'TAXR04'){ 
	     window.location="<?php echo base_url()?>index.php/tax/taxr04/printdetail";
	 } 	
	 if (sText == 'Y' && oInput == 'TAXR05'){ 
	     window.location="<?php echo base_url()?>index.php/tax/taxr05/printdetail";
	 } 	
	 if (sText == 'Y' && oInput == 'TAXR06'){ 
	     window.location="<?php echo base_url()?>index.php/tax/taxr06/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'TAXR07'){ 
	     window.location="<?php echo base_url()?>index.php/tax/taxr07/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'TAXR08'){ 
	     window.location="<?php echo base_url()?>index.php/tax/taxr08/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'TAXR09'){ 
	     window.location="<?php echo base_url()?>index.php/tax/taxr09/printdetail";
	 } 
	  if (sText == 'Y' && oInput == 'TAXB01'){ 
	     window.location="<?php echo base_url()?>index.php/tax/taxb01/batch";
	 } 	 
	 if (sText == 'Y' && oInput == 'TAXB02'){ 
	     window.location="<?php echo base_url()?>index.php/tax/taxb02/batch";
	 } 	 
	 if (sText == 'Y' && oInput == 'TAXB03'){ 
	     window.location="<?php echo base_url()?>index.php/tax/taxb03/batch";
	 } 	 
	 //my電子商務系統
     if (sText == 'Y' && oInput == 'MYMB01'){ 
	     window.location="<?php echo base_url()?>index.php/mym/mymb01/index";
	 } 
	 if (sText == 'Y' && oInput == 'MYMB11'){ 
	     window.location="<?php echo base_url()?>index.php/mym/mymb11/index";
	 } 
	  if (sText == 'Y' && oInput == 'MYMB02'){ 
	     window.location="<?php echo base_url()?>index.php/mym/mymb02/index";
	 } 
	  if (sText == 'Y' && oInput == 'MYMR01'){ 
	     window.location="<?php echo base_url()?>index.php/mym/mymr01/display";
	 } 
	 if (sText == 'Y' && oInput == 'tomysql'){ 
	     window.open("<?php echo base_url()?>index.php/tomysql/shellnember")
	 } 
	 
}

//不更新網頁 mg002 檢查程式代號 datacmsq05a modi dataadmq05a
function startadmq05a(oInput){         
	
	//首先判斷是否有輸入，沒有輸入直接返回，並提示 
 //	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mg002disp").html("欄位不可空白.");      		
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/main/datacmsq05a/"+ oInput + "/0"  + "/" + new Date().getTime();   
	var QueryString = "0";
	 
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)		  
		  showadmq05a(xmlHttp.responseText,oInput); 	//顯示服務器結果
		  
	}
	
	xmlHttp.send(null);
	 
}

</script>


<script>
//應付帳款系統 - 程式碼 (首先寫入程式代號, 再呼叫函數)
function open_acpb01()
  { 
    var prg='ACPB01';
    startadmq05a(prg);    
  }
function open_acpi01()
  { 
    var prg='ACPI01';
    startadmq05a(prg);    
  }
function open_acpi02()
  { 
    var prg='ACPI02';
    startadmq05a(prg);    
  }
function open_acpi03()
  { 
    var prg='ACPI03';
    startadmq05a(prg);    
  }
function open_acpr05()
  { 
    var prg='ACPR05';
    startadmq05a(prg);    
  }  
 function open_acpr12()
  { 
    var prg='ACPR12';
    startadmq05a(prg);    
  }  
  //應收帳款系統
function open_acrb01()
  { 
    var prg='ACRB01';
    startadmq05a(prg);    
  }
function open_acri01()
  { 
    var prg='ACRI01';
    startadmq05a(prg);    
  }
function open_acri02()
  { 
    var prg='ACRI02';
    startadmq05a(prg);    
  }
function open_acri03()
  { 
    var prg='ACRI03';
    startadmq05a(prg);    
  }
  
  function open_acrr01()
  { 
    var prg='ACRR01';
    startadmq05a(prg);    
  }
  function open_acrr03()
  { 
    var prg='ACRR03';
    startadmq05a(prg);    
  }
  function open_acrr17()
  { 
    var prg='ACRR17';
    startadmq05a(prg);    
  }
  function open_acrr13()
  { 
    var prg='ACRR13';
    startadmq05a(prg);    
  }
  function open_acrr06()
  { 
    var prg='ACRR06';
    startadmq05a(prg);    
  }
  function open_acrr05()
  { 
    var prg='ACRR05';
    startadmq05a(prg);    
  }
  
  //管理系統
function open_admi01()
  { 
    var prg='ADMI01';
    startadmq05a(prg);    
  }
  function open_admi02()
  { 
    var prg='ADMI02';
    startadmq05a(prg);    
  }
   function open_admi03()
  { 
    var prg='ADMI03';
    startadmq05a(prg);    
  }
  function open_admi04()
  { 
    var prg='ADMI04';
    startadmq05a(prg);    
  }
  function open_admi10()
  { 
    var prg='ADMI10';
    startadmq05a(prg);    
  }
  function open_admi05()
  { 
    var prg='ADMI05';
    startadmq05a(prg);    
  }
  function open_admi06()
  { 
    var prg='ADMI06';
    startadmq05a(prg);    
  }
  //會計系統
   function open_actb01()
  { 
    var prg='ACTB01';
    startadmq05a(prg);    
  }
   function open_actb02()
  { 
    var prg='ACTB02';
    startadmq05a(prg);    
  }
   function open_actb04()
  { 
    var prg='ACTB04';
    startadmq05a(prg);    
  }
    function open_actb06()
  { 
    var prg='ACTB06';
    startadmq05a(prg);    
  }
   function open_actb09()
  { 
    var prg='ACTB09';
    startadmq05a(prg);    
  }
    function open_acti01()
  { 
    var prg='ACTI01';
    startadmq05a(prg);    
  }
    function open_acti02()
  { 
    var prg='ACTI02';
    startadmq05a(prg);    
  }
    function open_acti03()
  { 
    var prg='ACTI03';
    startadmq05a(prg);    
  }
    function open_acti07()
  { 
    var prg='ACTI07';
    startadmq05a(prg);    
  }
    function open_acti10()
  { 
    var prg='ACTI10';
    startadmq05a(prg);    
  }
    function open_acti13()
  { 
    var prg='ACTI13';
    startadmq05a(prg);    
  }
     function open_acti14()
  { 
    var prg='ACTI14';
    startadmq05a(prg);    
  }
      function open_actr08()
  { 
    var prg='ACTR08';
    startadmq05a(prg);    
  }
      function open_actr09()
  { 
    var prg='ACTR09';
    startadmq05a(prg);    
  }
      function open_actr12()
  { 
    var prg='ACTR12';
    startadmq05a(prg);    
  }
      function open_actr20()
  { 
    var prg='ACTR20';
    startadmq05a(prg);    
  }
      function open_actr21()
  { 
    var prg='ACTR21';
    startadmq05a(prg);    
  }
      function open_actr22()
  { 
    var prg='ACTR22';
    startadmq05a(prg);    
  }
  //產品結構系統
  function open_bomi01()
  {
    var prg='BOMI01';
    startadmq05a(prg); 
  } 
  function open_bomi02()
  {
    var prg='BOMI02';
    startadmq05a(prg); 
  } 
  function open_bomi03()
  {
    var prg='BOMI03';
    startadmq05a(prg); 
  } 
  function open_bomi04()
  {
    var prg='BOMI04';
    startadmq05a(prg); 
  } 
   function open_bomi05()
  {
    var prg='BOMI05';
    startadmq05a(prg); 
  } 
   function open_bomi06()
  {
    var prg='BOMI06';
    startadmq05a(prg); 
  } 
  function open_bomi07()
  {
    var prg='BOMI07';
    startadmq05a(prg); 
  } 
  function open_bomb05()
  {
    var prg='BOMB05';
    startadmq05a(prg); 
  } 
  function open_bomb06()
  {
    var prg='BOMB06';
    startadmq05a(prg); 
  } 
   function open_bomb07()
  {
    var prg='BOMB07';
    startadmq05a(prg); 
  } 
  function open_bomr03()
  {
    var prg='BOMR03';
    startadmq05a(prg); 
  }
  function open_bomr04()
  {
    var prg='BOMR04';
    startadmq05a(prg); 
  }
  function open_bomr05()
  {
    var prg='BOMR05';
    startadmq05a(prg); 
  }
  function open_bomr06()
  {
    var prg='BOMR06';
    startadmq05a(prg); 
  }
  function open_bomr07()
  {
    var prg='BOMR07';
    startadmq05a(prg); 
  }
  function open_bomr08()
  {
    var prg='BOMR08';
    startadmq05a(prg); 
  } 
  function open_bomr01()
  {
    var prg='BOMR01';
    startadmq05a(prg); 
  } 
  function open_bomr02()
  {
    var prg='BOMR02';
    startadmq05a(prg); 
  }   


  
  //基本資料
  function open_cmsi01()
  { 
    var prg='CMSI01';
    startadmq05a(prg);    
  }
  function open_cmsi02()
  {
    var prg='CMSI02';
    startadmq05a(prg); 
  }  
function open_cmsi03()
  {
    var prg='CMSI03';
    startadmq05a(prg); 
  } 
  function open_cmsi04()
  {
    var prg='CMSI04';
    startadmq05a(prg); 
  } 
 function open_cmsi05()
  {
    var prg='CMSI05';
    startadmq05a(prg); 
  } 
 function open_cmsi06()
  {
    var prg='CMSI06';
    startadmq05a(prg); 
  } 
 function open_cmsi09()
  {
    var prg='CMSI09';
    startadmq05a(prg); 
  } 
  function open_cmsi10()
  { 
    var prg='CMSI10';
    startadmq05a(prg);    
  }
  function open_cmsi11()
  { 
    var prg='CMSI11';
    startadmq05a(prg);    
  }
   function open_cmsi12()
  { 
    var prg='CMSI12';
    startadmq05a(prg);    
  }
  function open_cmsi14()
  { 
    var prg='CMSI14';
    startadmq05a(prg);    
  }
  function open_cmsi15()
  { 
    var prg='CMSI15';
    startadmq05a(prg);    
  }
   function open_cmsi16()
  { 
    var prg='CMSI16';
    startadmq05a(prg);    
  }
   function open_cmsi17()
  { 
    var prg='CMSI17';
    startadmq05a(prg);    
  }
  function open_cmsi19()
  { 
    var prg='CMSI19';
    startadmq05a(prg);    
  }
  function open_cmsi21()
  { 
    var prg='CMSI21';
    startadmq05a(prg);    
  }
  
  
  //訂單報表
 function open_copr20()
  {
    var prg='COPR20';
    startadmq05a(prg); 
  } 
   function open_copr21()
  {
    var prg='COPR21';
    startadmq05a(prg); 
  } 
   function open_copr22()
  {
    var prg='COPR22';
    startadmq05a(prg); 
  } 
   function open_copr23()
  {
    var prg='COPR23';
    startadmq05a(prg); 
  } 
    function open_copr24()
  {
    var prg='COPR24';
    startadmq05a(prg); 
  } 
    function open_copr25()
  {
    var prg='COPR25';
    startadmq05a(prg); 
  } 
    function open_copr26()
  {
    var prg='COPR26';
    startadmq05a(prg); 
  } 
    function open_copr27()
  {
    var prg='COPR27';
    startadmq05a(prg); 
  } 
  function open_copr28()
  {
    var prg='COPR28';
    startadmq05a(prg); 
  } 
   function open_copr05()
  {
    var prg='COPR05';
    startadmq05a(prg); 
  } 
   function open_cope05()
  {
    var prg='COPE05';
    startadmq05a(prg); 
  } 
   function open_copr06()
  {
    var prg='COPR06';
    startadmq05a(prg); 
  } 
   function open_copr07()
  {
    var prg='COPR07';
    startadmq05a(prg); 
  } 
    function open_copr08()
  {
    var prg='COPR08';
    startadmq05a(prg); 
  } 
    function open_cope08()
  {
    var prg='COPE08';
    startadmq05a(prg); 
  } 
   function open_copr03()
  {
    var prg='COPR03';
    startadmq05a(prg); 
  } 
    function open_copr31()
  {
    var prg='COPR31';
    startadmq05a(prg); 
  } 
  
   //訂單系統
 function open_copi01()
  {
    var prg='COPI01';
    startadmq05a(prg); 
  } 
   function open_copi02()
  {
    var prg='COPI02';
    startadmq05a(prg); 
  } 
  function open_copb02()
  {
    var prg='COPB02';
    startadmq05a(prg); 
  } 
   function open_copb03()
  {
    var prg='COPB03';
    startadmq05a(prg); 
  } 
  function open_copb07()
  {
    var prg='COPB07';
    startadmq05a(prg); 
  } 
 function open_copi03()
  {
    var prg='COPI03';
    startadmq05a(prg); 
  } 
  function open_copi04()
  {
    var prg='COPI04';
    startadmq05a(prg); 
  } 
 function open_copi05()
  {
    var prg='COPI05';
    startadmq05a(prg); 
  } 
  function open_copi06()
  {
    var prg='COPI06';
    startadmq05a(prg); 
  } 
  function open_copi07()
  {
    var prg='COPI07';
    startadmq05a(prg); 
  } 
  function open_copi08()
  {
    var prg='COPI08';
    startadmq05a(prg); 
  } 
  function open_copi09()
  {
    var prg='COPI09';
    startadmq05a(prg); 
  } 
   function open_copi10()
  {
    var prg='COPI10';
    startadmq05a(prg); 
  } 
    function open_copi81()
  {
    var prg='COPI81';
    startadmq05a(prg); 
  } 
    function open_copi82()
  {
    var prg='COPI82';
    startadmq05a(prg); 
  } 
     function open_copi83()
  {
    var prg='COPI83';
    startadmq05a(prg); 
  } 
     function open_copi84()
  {
    var prg='COPI84';
    startadmq05a(prg); 
  } 
    function open_copq02()
  {
    var prg='COPQ02';
    startadmq05a(prg); 
  } 

    //POS門市系統
 function open_posi01()
  {
    var prg='POSI01';
    startadmq05a(prg); 
  } 
  function open_posi02()
  {
    var prg='POSI02';
    startadmq05a(prg); 
  } 
  function open_posi03()
  {
    var prg='POSI03';
    startadmq05a(prg); 
  } 
  function open_posi04()
  {
    var prg='POSI04';
    startadmq05a(prg); 
  } 
   function open_posi05()
  {
    var prg='POSI05';
    startadmq05a(prg); 
  } 
   function open_posi06()
  {
    var prg='POSI06';
    startadmq05a(prg); 
  } 
   function open_posi11()
  {
    var prg='POSI11';
    startadmq05a(prg); 
  } 
    function open_posq01()
  {
    var prg='POSQ01';
    startadmq05a(prg); 
  } 
    function open_posr01()
  {
    var prg='POSR01';
    startadmq05a(prg); 
  } 
     function open_posr02()
  {
    var prg='POSR02';
    startadmq05a(prg); 
  }
     function open_posr03()
  {
    var prg='POSR03';
    startadmq05a(prg); 
  }   
     function open_posr04()
  {
    var prg='POSR04';
    startadmq05a(prg); 
  } 
     function open_posr05()
  {
    var prg='POSR05';
    startadmq05a(prg); 
  } 
  //庫存系統
 function open_invb01()
  { 
    var prg='INVB01';
    startadmq05a(prg);    
  }
  function open_invb02()
  { 
    var prg='INVB02';
    startadmq05a(prg);    
  }
  function open_invb03()
  { 
    var prg='INVB03';
    startadmq05a(prg);    
  }
  function open_invb06()
  { 
    var prg='INVB06';
    startadmq05a(prg);    
  }
   function open_invb07()
  { 
    var prg='INVB07';
    startadmq05a(prg);    
  }
   function open_invb08()
  { 
    var prg='INVB08';
    startadmq05a(prg);    
  }
  function open_invb09()
  { 
    var prg='INVB09';
    startadmq05a(prg);    
  }
   function open_invb13()
  { 
    var prg='INVB13';
    startadmq05a(prg);    
  }
   function open_invb14()
  { 
    var prg='INVB14';
    startadmq05a(prg);    
  }
  function open_invi01()
  { 
    var prg='INVI01';
    startadmq05a(prg);    
  }
 
function open_invi02()
  {
    var prg='INVI02';
    startadmq05a(prg); 
  }
 
function open_invi03()
  {
    window.open("/index.php/inv/invi03/display")
  }
function open_invi04()
  {
     var prg='INVI04';
    startadmq05a(prg); 
  }
  function open_invi05()
  {
     var prg='INVI05';
    startadmq05a(prg); 
  }
 function open_invi06()
  {
     var prg='INVI06';
    startadmq05a(prg); 
  }    
  function open_invi07()
  {
     var prg='INVI07';
    startadmq05a(prg); 
  }    
function open_invi08()
  {
     var prg='INVI08';
    startadmq05a(prg); 
  }    
  function open_invi09()
  {
     var prg='INVI09';
    startadmq05a(prg); 
  }    
  function open_invi14()
  {
     var prg='INVI14';
    startadmq05a(prg); 
  }    
   function open_invi15()
  {
     var prg='INVI15';
    startadmq05a(prg); 
  }    
   function open_invi16()
  {
     var prg='INVI16';
    startadmq05a(prg); 
  }    
   function open_invi81()
  {
     var prg='INVI81';
    startadmq05a(prg); 
  }    
  function open_invq02()
  {
    var prg='INVQ02';
    startadmq05a(prg); 
  }
  function open_invq03()
  {
    var prg='INVQ03';
    startadmq05a(prg); 
  }
  //庫存報表
 function open_invr13()
  { 
    var prg='INVR13';
    startadmq05a(prg);    
  } 
   function open_invr18()
  { 
    var prg='INVR18';
    startadmq05a(prg);    
  } 
   function open_invr19()
  { 
    var prg='INVR19';
    startadmq05a(prg);    
  } 
   function open_invr20()
  { 
    var prg='INVR20';
    startadmq05a(prg);    
  } 
    function open_invr21()
  { 
    var prg='INVR21';
    startadmq05a(prg);    
  } 
  function open_invr22()
  { 
    var prg='INVR22';
    startadmq05a(prg);    
  } 

//製令系統
function open_moci01()
  {
     var prg='MOCI01';
     startadmq05a(prg); 
  } 
function open_moci02()
  {
     var prg='MOCI02';
     startadmq05a(prg); 
  } 
function open_moci03()
  {
     var prg='MOCI03';
     startadmq05a(prg); 
  }  
function open_moci04()
  {
     var prg='MOCI04';
     startadmq05a(prg); 
  }  
function open_moci05()
  {
     var prg='MOCI05';
     startadmq05a(prg); 
  }  
function open_moci06()
  {
     var prg='MOCI06';
     startadmq05a(prg); 
  }  
function open_moci07()
  {
     var prg='MOCI07';
     startadmq05a(prg); 
  }    
  function open_moci09()
  {
     var prg='MOCI09';
     startadmq05a(prg); 
  }    
function open_moci10()
  {
     var prg='MOCI10';
     startadmq05a(prg); 
  }    
function open_moci12()
  {
     var prg='MOCI12';
     startadmq05a(prg); 
  }    
  
 //票據資金系統
function open_noti01()
  {
     var prg='NOTI01';
     startadmq05a(prg); 
  }   
function open_noti02()
   { 
     var prg='NOTI02';
     startadmq05a(prg); 
  }   
  function open_noti03()
   {
     var prg='NOTI03';
     startadmq05a(prg); 
  }   
  function open_noti04()
   {
     var prg='NOTI04';
     startadmq05a(prg); 
  }   
  function open_noti08()
   {
     var prg='NOTI08';
     startadmq05a(prg); 
  }
  function open_noti09()
 {
     var prg='NOTI09';
     startadmq05a(prg); 
  }     
  function open_noti11()
  {
     var prg='NOTI11';
     startadmq05a(prg); 
  }   
  function open_noti06()
  {
     var prg='NOTI06';
     startadmq05a(prg); 
  }   
  function open_noti13()
  {
     var prg='NOTI13';
     startadmq05a(prg); 
  }   
   function open_noti14()
  {
     var prg='NOTI14';
     startadmq05a(prg); 
  }   
  //自動分錄系統
 function open_ajsb01()  
  {
     var prg='AJSB01';
     startadmq05a(prg); 
  }  
  function open_ajsb02()  
  {
     var prg='AJSB02';
     startadmq05a(prg); 
  }  
  function open_ajsb03()  
  {
     var prg='AJSB03';
     startadmq05a(prg); 
  }  
  function open_ajsb04()  
  {
     var prg='AJSB04';
     startadmq05a(prg); 
  }  
function open_ajsi01()
  {
     var prg='AJSI01';
     startadmq05a(prg); 
  }  
 function open_ajsi02()
  {
     var prg='AJSI02';
     startadmq05a(prg); 
  }  
function open_ajsi03()
  {
     var prg='AJSI03';
     startadmq05a(prg); 
  }  
function open_ajsi04()
  {
     var prg='AJSI04';
     startadmq05a(prg); 
  }  
function open_ajsi05()
  {
     var prg='AJSI05';
     startadmq05a(prg); 
  }  
function open_ajsi06()
  {
     var prg='AJSI06';
     startadmq05a(prg); 
  }  
function open_ajsi07()
  {
     var prg='AJSI07';
     startadmq05a(prg); 
  }  
function open_ajsi08()
  {
     var prg='AJSI08';
     startadmq05a(prg); 
  }  
function open_ajsi09()
  {
     var prg='AJSI09';
     startadmq05a(prg); 
  }  
function open_ajsi10()
  {
     var prg='AJSI10';
     startadmq05a(prg); 
  }  
  function open_ajsi20()
  {
     var prg='AJSI20';
     startadmq05a(prg); 
  }  
 function open_ajsi31()
  {
     var prg='AJSI31';
     startadmq05a(prg); 
  }   
  //電子發票系統
  function open_eivi11()
  {
     var prg='EIVI11';
     startadmq05a(prg); 
  }   
  //人事系統
function open_pali01()
  {
     var prg='PALI01';
     startadmq05a(prg); 
  }  
 function open_pali02()
  {
     var prg='PALI02';
     startadmq05a(prg); 
  }  
 function open_pali03()
  {
     var prg='PALI03';
     startadmq05a(prg); 
  } 
   function open_pali04()
  {
     var prg='PALI04';
     startadmq05a(prg); 
  }    
  function open_pali05()
  {
     var prg='PALI05';
     startadmq05a(prg); 
  }    
 function open_pali08()
  {
     var prg='PALI08';
     startadmq05a(prg); 
  } 
  function open_pali09()
  {
     var prg='PALI09';
     startadmq05a(prg); 
  } 
function open_pali10()  
  {
     var prg='PALI10';
     startadmq05a(prg); 
  }  
  function open_pali11()  
  {
     var prg='PALI11';
     startadmq05a(prg); 
  }  
  function open_pali12()  
  {
     var prg='PALI12';
     startadmq05a(prg); 
  }  
  function open_pali13()  
  {
     var prg='PALI13';
     startadmq05a(prg); 
  }  
 function open_pali16()  
  {
     var prg='PALI16';
     startadmq05a(prg); 
  }  
  function open_pali17()  
  {
     var prg='PALI17';
     startadmq05a(prg); 
  }  
  function open_pali18()  
  {
     var prg='PALI18';
     startadmq05a(prg); 
  }  
 function open_pali20()  
  {
     var prg='PALI20';
     startadmq05a(prg); 
  }  
  function open_pali21()  
  {
     var prg='PALI21';
     startadmq05a(prg); 
  }  
 function open_pali22()  
  {
     var prg='PALI22';
     startadmq05a(prg); 
  }  
 function open_pali23()  
  {
     var prg='PALI23';
     startadmq05a(prg); 
  }  
 function open_pali24()  
  {
     var prg='PALI24';
     startadmq05a(prg); 
  } 
function open_pali25()  
  {
     var prg='PALI25';
     startadmq05a(prg); 
  } 
function open_pali26()  
  {
     var prg='PALI26';
     startadmq05a(prg); 
  }   
  function open_pali27()  
  {
     var prg='PALI27';
     startadmq05a(prg); 
  }  
  function open_pali29()  
  {
     var prg='PALI29';
     startadmq05a(prg); 
  }  
  function open_pali31()  
  {
     var prg='PALI31';
     startadmq05a(prg); 
  }  
  function open_pali32()  
  {
     var prg='PALI32';
     startadmq05a(prg); 
  }  
  function open_pali33()  
  {
     var prg='PALI33';
     startadmq05a(prg); 
  }  
  function open_pali35()  
  {
     var prg='PALI35';
     startadmq05a(prg); 
  }  
   function open_pali40()  
  {
     var prg='PALI40';
     startadmq05a(prg); 
  }  
   function open_pali41()  
  {
     var prg='PALI41';
     startadmq05a(prg); 
  }  
   function open_pali42()  
  {
     var prg='PALI42';
     startadmq05a(prg); 
  }  
   function open_pali43()  
  {
     var prg='PALI43';
     startadmq05a(prg); 
  }  
   function open_pali44()  
  {
     var prg='PALI44';
     startadmq05a(prg); 
  }  
   function open_pali45()  
  {
     var prg='PALI45';
     startadmq05a(prg); 
  }  
   function open_pali46()  
  {
     var prg='PALI46';
     startadmq05a(prg); 
  }  
  function open_pali47()  
  {
     var prg='PALI47';
     startadmq05a(prg); 
  }  
   function open_pali48()  
  {
     var prg='PALI48';
     startadmq05a(prg); 
  }  
  function open_pali49()  
  {
     var prg='PALI49';
     startadmq05a(prg); 
  }  
  function open_pali51()  
  {
     var prg='PALI51';
     startadmq05a(prg); 
  }  
   function open_palb01()  
  {
     var prg='PALB01';
     startadmq05a(prg); 
  }  
    function open_palb02()  
  {
     var prg='PALB02';
     startadmq05a(prg); 
  }  
   function open_palb03()  
  {
     var prg='PALB03';
     startadmq05a(prg); 
  }  
   function open_palb35()  
  {
     var prg='PALB35';
     startadmq05a(prg); 
  }  
   function open_palb40()  
  {
     var prg='PALB40';
     startadmq05a(prg); 
  }  
    function open_palb41()  
  {
     var prg='PALB41';
     startadmq05a(prg); 
  }  
    function open_palb42()  
  {
     var prg='PALB42';
     startadmq05a(prg); 
  }  
  function open_palb51()  
  {
     var prg='PALB51';
     startadmq05a(prg); 
  }  
  function open_palb52()  
  {
     var prg='PALB52';
     startadmq05a(prg); 
  }
   function open_palb53()  
  {
     var prg='PALB53';
     startadmq05a(prg); 
  }
   function open_palb56()  
  {
     var prg='PALB56';
     startadmq05a(prg); 
  }
   function open_palb61()  
  {
     var prg='PALB61';
     startadmq05a(prg); 
  }
   function open_palb62()  
  {
     var prg='PALB62';
     startadmq05a(prg); 
  }
  function open_palq41()  
  {
     var prg='PALQ41';
     startadmq05a(prg); 
  }
   function open_palr30()  
  {
     var prg='PALR30';
     startadmq05a(prg); 
  }  
  function open_palr31()  
  {
     var prg='PALR31';
     startadmq05a(prg); 
  }  
  function open_palr32()  
  {
     var prg='PALR32';
     startadmq05a(prg); 
  }  
  function open_palr33()  
  {
     var prg='PALR33';
     startadmq05a(prg); 
  }  
  function open_palr34()  
  {
     var prg='PALR34';
     startadmq05a(prg); 
  }  
   function open_palr35()  
  {
     var prg='PALR35';
     startadmq05a(prg); 
  }  
    function open_palr36()  
  {
     var prg='PALR36';
     startadmq05a(prg); 
  }  
  function open_palr41()  
  {
     var prg='PALR41';
     startadmq05a(prg); 
  }  
   function open_palr42()  
  {
     var prg='PALR42';
     startadmq05a(prg); 
  }  
   function open_palr43()  
  {
     var prg='PALR43';
     startadmq05a(prg); 
  }  
   function open_palr44()  
  {
     var prg='PALR44';
     startadmq05a(prg); 
  }   
   function open_palr45()  
  {
     var prg='PALR45';
     startadmq05a(prg); 
  }   
    function open_palr46()  
  {
     var prg='PALR46';
     startadmq05a(prg); 
  }   
  function open_palr47()  
  {
     var prg='PALR47';
     startadmq05a(prg); 
  }    
  function open_palr48()  
  {
     var prg='PALR48';
     startadmq05a(prg); 
  }      
  function open_palr49()  
  {
     var prg='PALR49';
     startadmq05a(prg); 
  }    
  function open_palr50()  
  {
     var prg='PALR50';
     startadmq05a(prg); 
  }  
  function open_palr51()  
  {
     var prg='PALR51';
     startadmq05a(prg); 
  }  
   function open_palr52()  
  {
     var prg='PALR52';
     startadmq05a(prg); 
  }  
   function open_palr53()  
  {
     var prg='PALR53';
     startadmq05a(prg); 
  }  
   function open_palr54()  
  {
     var prg='PALR54';
     startadmq05a(prg); 
  }  
   function open_palr55()  
  {
     var prg='PALR55';
     startadmq05a(prg); 
  }  
    function open_palr56()  
  {
     var prg='PALR56';
     startadmq05a(prg); 
  }  
    function open_palr57()  
  {
     var prg='PALR57';
     startadmq05a(prg); 
  }  
     function open_palr58()  
  {
     var prg='PALR58';
     startadmq05a(prg); 
  }  
  function open_palr59()  
  {
     var prg='PALR59';
     startadmq05a(prg); 
  }  
   function open_palr61()  
  {
     var prg='PALR61';
     startadmq05a(prg); 
  }  
  function open_pali52()  
  {
     var prg='PALI52';
     startadmq05a(prg); 
  }  
   function open_pali53()  
  {
     var prg='PALI53';
     startadmq05a(prg); 
  }  
    function open_pali54()  
  {
     var prg='PALI54';
     startadmq05a(prg); 
  }  
   function open_pali55()  
  {
     var prg='PALI55';
     startadmq05a(prg); 
  }  
   function open_pali56()  
  {
     var prg='PALI56';
     startadmq05a(prg); 
  }  
   function open_pali57()  
  {
     var prg='PALI57';
     startadmq05a(prg); 
  }  
 //採購系統
function open_purb01()
  {
     var prg='PURB01';
     startadmq05a(prg); 
  }  
 function open_purb05()
  {
     var prg='PURB05';
     startadmq05a(prg); 
  }  
   function open_purb07()
  {
     var prg='PURB07';
     startadmq05a(prg); 
  }  
   function open_purb09()
  {
     var prg='PURB09';
     startadmq05a(prg); 
  }  
   function open_purb11()
  {
     var prg='PURB11';
     startadmq05a(prg); 
  }  
   function open_purb13()
  {
     var prg='PURB13';
     startadmq05a(prg); 
  }  
function open_puri01()
  {
     var prg='PURI01';
     startadmq05a(prg); 
  }  
function open_puri02()
  {
   var prg='PURI02';
    startadmq05a(prg); 
  }  
 function open_puri03()
  {
   var prg='PURI03';
    startadmq05a(prg); 
  }  
 function open_puri04()
  {
   var prg='PURI04';
    startadmq05a(prg); 
  }  
 function open_puri05()
  {
   var prg='PURI05';
    startadmq05a(prg); 
  }  
  function open_puri06()
  {
   var prg='PURI06';
    startadmq05a(prg); 
  }
  function open_puri07()
  {
   var prg='PURI07';
    startadmq05a(prg); 
  }  
  function open_puri09()
  {
   var prg='PURI09';
    startadmq05a(prg); 
  }  
  function open_puri11()
  {
   var prg='PURI11';
    startadmq05a(prg); 
  }    
  //固定資產系統
  function open_asti01()
  {
    var prg='ASTI01';
    startadmq05a(prg); 
  }  
  function open_asti02()
  {
    var prg='ASTI02';
    startadmq05a(prg); 
  }  
  function open_asti03()
  {
    var prg='ASTI03';
    startadmq05a(prg); 
  }  
  function open_asti04()
  {
    var prg='ASTI04';
    startadmq05a(prg); 
  }  
  function open_asti05()
  {
    var prg='ASTI05';
    startadmq05a(prg); 
  }  
  function open_asti06()
  {
    var prg='ASTI06';
    startadmq05a(prg); 
  }  
  function open_asti07()
  {
    var prg='ASTI07';
    startadmq05a(prg); 
  }  
  function open_asti08()
  {
    var prg='ASTI08';
    startadmq05a(prg); 
  }  
  function open_asti09()
  {
    var prg='ASTI09';
    startadmq05a(prg); 
  }  
  function open_asti10()
  {
    var prg='ASTI10';
    startadmq05a(prg); 
  }  
   function open_asti13()
  {
    var prg='ASTI13';
    startadmq05a(prg); 
  }  
   function open_asti14()
  {
    var prg='ASTI14';
    startadmq05a(prg); 
  }  
  function open_asti15()
  {
    var prg='ASTI15';
    startadmq05a(prg); 
  }  
  function open_astr01()
  {
    var prg='ASTR01';
    startadmq05a(prg); 
  } 
  function open_astr02()
  {
    var prg='ASTR02';
    startadmq05a(prg); 
  }  
  function open_astr03()
  {
    var prg='ASTR03';
    startadmq05a(prg); 
  }  
  function open_astr04()
  {
    var prg='ASTR04';
    startadmq05a(prg); 
  }  
  function open_astr05()
  {
    var prg='ASTR05';
    startadmq05a(prg); 
  }  
  function open_astr06()
  {
    var prg='ASTR06';
    startadmq05a(prg); 
  }  
  function open_astr07()
  {
    var prg='ASTR07';
    startadmq05a(prg); 
  }  
  function open_astr08()
  {
    var prg='ASTR08';
    startadmq05a(prg); 
  }
  function open_astr09()
  {
    var prg='ASTR09';
    startadmq05a(prg); 
  }
  function open_astr10()
  {
    var prg='ASTR10';
    startadmq05a(prg); 
  }  
  //成本計算系統
   function open_csti01()
  {
    var prg='CSTI01';
    startadmq05a(prg); 
  }  
   function open_csti02()
  {
    var prg='CSTI02';
    startadmq05a(prg); 
  }  
   function open_csti03()
  {
    var prg='CSTI03';
    startadmq05a(prg); 
  }  
   function open_csti04()
  {
    var prg='CSTI04';
    startadmq05a(prg); 
  }  
   function open_csti05()
  {
    var prg='CSTI05';
    startadmq05a(prg); 
  }  
   function open_csti06()
  {
    var prg='CSTI06';
    startadmq05a(prg); 
  }  
  function open_cstr01()
  {
    var prg='CSTR01';
    startadmq05a(prg); 
  }  
   function open_cstr02()
  {
    var prg='CSTR02';
    startadmq05a(prg); 
  }  
   function open_cstr03()
  {
    var prg='CSTR03';
    startadmq05a(prg); 
  }  
   function open_cstr04()
  {
    var prg='CSTR04;
    startadmq05a(prg); 
  }  
   function open_cstr05()
  {
    var prg='CSTR05';
    startadmq05a(prg); 
  }  
   function open_cstr06()
  {
    var prg='CSTR06';
    startadmq05a(prg); 
  }  
   function open_cstr07()
  {
    var prg='CSTR07';
    startadmq05a(prg); 
  }  
   function open_cstr08()
  {
    var prg='CSTR08';
    startadmq05a(prg); 
  }  
   function open_cstr09()
  {
    var prg='CSTR09';
    startadmq05a(prg); 
  }  
   function open_cstr10()
  {
    var prg='CSTR10';
    startadmq05a(prg); 
  }  
   function open_cstr11()
  {
    var prg='CSTR11';
    startadmq05a(prg); 
  }  
  //發票系統
  function open_taxi01()
  {
    var prg='TAXI01';
    startadmq05a(prg); 
  }  
  function open_taxi02()
  {
    var prg='TAXI02';
    startadmq05a(prg); 
  }  
  function open_taxi03()
  {
    var prg='TAXI03';
    startadmq05a(prg); 
  }  
  function open_taxi04()
  {
    var prg='TAXI04';
    startadmq05a(prg); 
  }  
  function open_taxi05()
  {
    var prg='TAXI05';
    startadmq05a(prg); 
  }  
  function open_taxi06()
  {
    var prg='TAXI06';
    startadmq05a(prg); 
  }  
  function open_taxi07()
  {
    var prg='TAXI07';
    startadmq05a(prg); 
  }  
   function open_taxr01()
  {
    var prg='TAXR01';
    startadmq05a(prg); 
  }  
  function open_taxr02()
  {
    var prg='TAXR02';
    startadmq05a(prg); 
  }  
  function open_taxr03()
  {
    var prg='TAXR03';
    startadmq05a(prg); 
  }  
  function open_taxr04()
  {
    var prg='TAXR04';
    startadmq05a(prg); 
  }  
  function open_taxr05()
  {
    var prg='TAXR05';
    startadmq05a(prg); 
  }  
  function open_taxr06()
  {
    var prg='TAXR06';
    startadmq05a(prg); 
  }  
  function open_taxr07()
  {
    var prg='TAXR07';
    startadmq05a(prg); 
  }  
  function open_taxr08()
  {
    var prg='TAXR08';
    startadmq05a(prg); 
  }  
  function open_taxr09()
  {
    var prg='TAXR09';
    startadmq05a(prg); 
  }  
  function open_taxb01()  
  {
     var prg='TAXB01';
     startadmq05a(prg); 
  }  
   function open_taxb02()  
  {
     var prg='TAXB02';
     startadmq05a(prg); 
  }  
   function open_taxb03()  
  {
     var prg='TAXB03';
     startadmq05a(prg); 
  }  
   //電子商務
  function open_mymb01()
  {
    var prg='MYMB01';
    startadmq05a(prg); 
  }  
  function open_mymb11()
  {
    var prg='MYMB11';
    startadmq05a(prg); 
  }  
   function open_mymb02()
  {
    var prg='MYMB02';
    startadmq05a(prg); 
  }  
    function open_mymr01()
  {
    var prg='MYMR01';
    startadmq05a(prg); 
  }  
function open_tomysql()
  {
    var prg='TOMYSQL';
    startadmq05a(prg); 
    window.open("/index.php/tomysql/shellnember")
  }  
</script>