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
	//console.log(srcElement.className);	
	if(srcElement!=null){
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
var xmlhttp;
function createXMLHttpRequest(){          //不更新網頁  共用 
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
	//	alert(xmlHttp);
}
  //创建ajax引擎
        function getXMLHttpRequest() {
                var xmlhttp;
                try {
                        //Firefox,Opera 8.0+, Safari
                        xmlhttp = new XMLHttpRequest();
                }catch (e) {
                        //Internet Explorer
                        try {
                                xmlhttp = new ActiveXObject("Msxml12.XMLHTTP");
                        }catch (e) {
                                try {
                                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                }catch (e) {
                                        alert("您的浏览器不支持AJAX！");
                                        return false;
                                }
                        }
                }
				// alert(xmlhttp);
                return xmlhttp;
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
	  //銷售分析系統
	 if (sText == 'Y' && oInput == 'SASR01'){ 
	     window.location="<?php echo base_url()?>index.php/sas/sasr01/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'SASR02'){ 
	     window.location="<?php echo base_url()?>index.php/sas/sasr02/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'SASR03'){ 
	     window.location="<?php echo base_url()?>index.php/sas/sasr03/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'SASR04'){ 
	     window.location="<?php echo base_url()?>index.php/sas/sasr04/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'SASR05'){ 
	     window.location="<?php echo base_url()?>index.php/sas/sasr05/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'SASR06'){ 
	     window.location="<?php echo base_url()?>index.php/sas/sasr06/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'SASR07'){ 
	     window.location="<?php echo base_url()?>index.php/sas/sasr07/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'SASR08'){ 
	     window.location="<?php echo base_url()?>index.php/sas/sasr08/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'SASR09'){ 
	     window.location="<?php echo base_url()?>index.php/sas/sasr09/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'SASR10'){ 
	     window.location="<?php echo base_url()?>index.php/sas/sasr10/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'SASR11'){ 
	     window.location="<?php echo base_url()?>index.php/sas/sasr11/printdetail";
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
	 if (sText == 'Y' && oInput == 'ACTR13'){ 
	     window.location="<?php echo base_url()?>index.php/act/actr13/printdetail";
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
	 if (sText == 'Y' && oInput == 'admi01'){ 
	     window.location="<?php echo base_url()?>index.php/adm/admi01/display";
	 } 
     if (sText == 'Y' && oInput == 'admi02'){ 
	     window.location.href="<?php echo base_url()?>index.php/adm/admi02/display";
	 } 	
	  if (sText == 'Y' && oInput == 'admi03'){ 
	     window.location.href="<?php echo base_url()?>index.php/adm/admi03/display";
	 } 
     if (sText == 'Y' && oInput == 'admi04'){ 
	     window.location="<?php echo base_url()?>index.php/adm/admi04/display";
	 } 	
     if (sText == 'Y' && oInput == 'admi10'){ 
	     window.location="<?php echo base_url()?>index.php/adm/admi10/display";
	 } 	
     if (sText == 'Y' && oInput == 'admi05'){ 
	     window.location="<?php echo base_url()?>index.php/adm/admi05/display";
	 } 
     if (sText == 'Y' && oInput == 'admi06'){ 
	     window.location="<?php echo base_url()?>index.php/adm/admi06/display";
	 } 		 
	  //開發產品系統
	 if (sText == 'Y' && oInput == 'EBOB01'){ 
	     window.location="<?php echo base_url()?>index.php/ebo/ebob01/batch";
	 } 
	 if (sText == 'Y' && oInput == 'EBOI01'){ 
	     window.location="<?php echo base_url()?>index.php/ebo/eboi01/updform";
	 } 
     if (sText == 'Y' && oInput == 'EBOI02'){ 
	     window.location="<?php echo base_url()?>index.php/ebo/eboi02/display";
	 } 
     if (sText == 'Y' && oInput == 'EBOI03'){ 
	     window.location="<?php echo base_url()?>index.php/ebo/eboi03/display";
	 } 
     if (sText == 'Y' && oInput == 'EBOI04'){ 
	     window.location="<?php echo base_url()?>index.php/ebo/eboi04/display";
	 } 
     if (sText == 'Y' && oInput == 'EBOI05'){ 
	     window.location="<?php echo base_url()?>index.php/ebo/eboi05/display";
	 } 
     if (sText == 'Y' && oInput == 'EBOI06'){ 
	     window.location="<?php echo base_url()?>index.php/ebo/eboi06/display";
	 } 	
     if (sText == 'Y' && oInput == 'EBOR01'){ 
	     window.location="<?php echo base_url()?>index.php/ebo/ebor01/printdetail";
	 } 	
      if (sText == 'Y' && oInput == 'EBOR02'){ 
	     window.location="<?php echo base_url()?>index.php/ebo/ebor02/printdetail";
	 } 
      if (sText == 'Y' && oInput == 'EBOR03'){ 
	     window.location="<?php echo base_url()?>index.php/ebo/ebor03/printdetail";
	 } 
      if (sText == 'Y' && oInput == 'EBOR04'){ 
	     window.location="<?php echo base_url()?>index.php/ebo/ebor04/printdetail";
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
	 if (sText == 'Y' && oInput == 'CMSI26'){ 
	     window.location="<?php echo base_url()?>index.php/cms/cmsi26/display";
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
	 if (sText == 'Y' && oInput == 'INVI10'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invi10/display";
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
     if (sText == 'Y' && oInput == 'INVR23'){
		 window.location="<?php echo base_url()?>index.php/inv/invr23/printdetail";
	 } 
	 //製令系統
     if (sText == 'Y' && oInput == 'MOCB02'){ 
	     window.location="<?php echo base_url()?>index.php/moc/mocb02/batch";
	 } 
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
         if (sText == 'Y' && oInput == 'MOCR19'){ 
	     window.location="<?php echo base_url()?>index.php/moc/mocr19/printdetail";
	 } 	 	 
         if (sText == 'Y' && oInput == 'MOCR20'){ 
	     window.location="<?php echo base_url()?>index.php/moc/mocr20/printdetail";
	 }  	
         if (sText == 'Y' && oInput == 'MOCR21'){ 
	     window.location="<?php echo base_url()?>index.php/moc/mocr21/printdetail";
	 } 
      
	 
	  //票據資金系統
     if (sText == 'Y' && oInput == 'NOTB03'){ 
	     window.location="<?php echo base_url()?>index.php/not/notb03/batch";
	 } 
	 if (sText == 'Y' && oInput == 'NOTB04'){ 
	     window.location="<?php echo base_url()?>index.php/not/notb04/batch";
	 } 
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
	  if (sText == 'Y' && oInput == 'NOTI05'){ 
	     window.location="<?php echo base_url()?>index.php/not/noti05/display";
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
	 if (sText == 'Y' && oInput == 'NOTR01'){ 
	     window.location="<?php echo base_url()?>index.php/not/notr01/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'NOTR02'){ 
	     window.location="<?php echo base_url()?>index.php/not/notr02/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'NOTR03'){ 
	     window.location="<?php echo base_url()?>index.php/not/notr03/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'NOTR04'){ 
	     window.location="<?php echo base_url()?>index.php/not/notr04/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'NOTR05'){ 
	     window.location="<?php echo base_url()?>index.php/not/notr05/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'NOTR06'){ 
	     window.location="<?php echo base_url()?>index.php/not/notr06/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'NOTR07'){ 
	     window.location="<?php echo base_url()?>index.php/not/notr07/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'NOTR08'){ 
	     window.location="<?php echo base_url()?>index.php/not/notr08/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'NOTR09'){ 
	     window.location="<?php echo base_url()?>index.php/not/notr09/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'NOTR10'){ 
	     window.location="<?php echo base_url()?>index.php/not/notr10/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'NOTR13'){ 
	     window.location="<?php echo base_url()?>index.php/not/notr13/printdetail";
	 }
	  if (sText == 'Y' && oInput == 'NOTR18'){ 
	     window.location="<?php echo base_url()?>index.php/not/notr18/printdetail";
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
	 if (sText == 'Y' && oInput == 'AJSB20'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsb20/batch";
	 } 
	 if (sText == 'Y' && oInput == 'AJSB21'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsb21/batch";
	 } 
	 if (sText == 'Y' && oInput == 'AJSB22'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsb22/batch";
	 } 
	 if (sText == 'Y' && oInput == 'AJSB23'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsb23/batch";
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
	  if (sText == 'Y' && oInput == 'AJSI11'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi11/display";
	 } 
	  if (sText == 'Y' && oInput == 'AJSI12'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi12/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI13'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi13/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI14'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi14/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI15'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi15/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI16'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi16/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI17'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi17/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI18'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi18/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI19'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi19/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI20'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi20/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI21'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi21/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI22'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi22/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI23'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi23/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSI24'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi24/display";
	 } 
	  
	 if (sText == 'Y' && oInput == 'AJSI31'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsi31/display";
	 } 
	 if (sText == 'Y' && oInput == 'AJSR01'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsr01/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'AJSR02'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsr02/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'AJSR03'){ 
	     window.location="<?php echo base_url()?>index.php/ajs/ajsr03/printdetail";
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
	  if (sText == 'Y' && oInput == 'BIZI03'){ 
	     window.location="<?php echo base_url()?>index.php/biz/bizi03/display";
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
	 if (sText == 'Y' && oInput == 'PALI36'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali36/display";
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
      if (sText == 'Y' && oInput == 'PALR62'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr62/printdetail";
	 } 
      if (sText == 'Y' && oInput == 'PALR63'){ 
	     window.location="<?php echo base_url()?>index.php/pal/palr63/printdetail";
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
	 //出口系統
     if (sText == 'Y' && oInput == 'EPSB01'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsb01/batch";
	 } 
	 if (sText == 'Y' && oInput == 'EPSB02'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsb02/batch";
	 } 
	 if (sText == 'Y' && oInput == 'EPSB03'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsb03/batch";
	 } 
	  if (sText == 'Y' && oInput == 'EPSI01'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsi01/display";
	 } 
	  if (sText == 'Y' && oInput == 'EPSI02'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsi02/display";
	 } 
	  if (sText == 'Y' && oInput == 'EPSI03'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsi03/display";
	 } 
	  if (sText == 'Y' && oInput == 'EPSI04'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsi04/display";
	 } 
	  if (sText == 'Y' && oInput == 'EPSI05'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsi05/display";
	 } 
	  if (sText == 'Y' && oInput == 'EPSI06'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsi06/display";
	 } 
	  if (sText == 'Y' && oInput == 'EPSI07'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsi07/display";
	 } 
	  if (sText == 'Y' && oInput == 'EPSI08'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsi08/display";
	 } 
	  if (sText == 'Y' && oInput == 'EPSI10'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsi10/display";
	 } 
	  if (sText == 'Y' && oInput == 'EPSR01'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsr01/printdetail";
	 } 
	  if (sText == 'Y' && oInput == 'EPSR02'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsr02/printdetail";
	 } 
	  if (sText == 'Y' && oInput == 'EPSR03'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsr03/printdetail";
	 } 
	  if (sText == 'Y' && oInput == 'EPSR04'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsr04/printdetail";
	 } 
	  if (sText == 'Y' && oInput == 'EPSR05'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsr05/printdetail";
	 } 
	  if (sText == 'Y' && oInput == 'EPSR06'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsr06/printdetail";
	 } 
	  if (sText == 'Y' && oInput == 'EPSR07'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsr07/printdetail";
	 } 
	  if (sText == 'Y' && oInput == 'EPSR08'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsr08/printdetail";
	 } 
	  if (sText == 'Y' && oInput == 'EPSR09'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsr09/printdetail";
	 } 
	  if (sText == 'Y' && oInput == 'EPSR10'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsr10/printdetail";
	 } 
	  if (sText == 'Y' && oInput == 'EPSR11'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsr11/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'EPSR12'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsr12/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'EPSR13'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsr13/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'EPSR14'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsr14/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'EPSR15'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsr15/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'EPSR16'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsr16/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'EPSR17'){ 
	     window.location="<?php echo base_url()?>index.php/eps/epsr17/printdetail";
	 } 
	  //進口系統
     if (sText == 'Y' && oInput == 'IPSB01'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsb01/batch";
	 } 
	 if (sText == 'Y' && oInput == 'IPSB02'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsb02/batch";
	 } 
	 if (sText == 'Y' && oInput == 'IPSB03'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsb03/batch";
	 } 
	  if (sText == 'Y' && oInput == 'IPSI01'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsi01/display";
	 } 
	  if (sText == 'Y' && oInput == 'IPSI02'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsi02/display";
	 } 
	  if (sText == 'Y' && oInput == 'IPSI03'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsi03/display";
	 } 
	  if (sText == 'Y' && oInput == 'IPSI04'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsi04/display";
	 } 
	  if (sText == 'Y' && oInput == 'IPSI05'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsi05/display";
	 } 
	  if (sText == 'Y' && oInput == 'IPSI06'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsi06/display";
	 } 
	  if (sText == 'Y' && oInput == 'IPSR01'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsr01/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'IPSR02'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsr02/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'IPSR03'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsr03/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'IPSR04'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsr04/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'IPSR05'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsr05/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'IPSR06'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsr06/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'IPSR07'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsr07/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'IPSR08'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsr08/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'IPSR09'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsr09/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'IPSR10'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsr10/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'IPSR11'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsr11/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'IPSR12'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsr12/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'IPSR13'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsr13/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'IPSR14'){ 
	     window.location="<?php echo base_url()?>index.php/ips/ipsr14/printdetail";
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
     if (sText == 'Y' && oInput == 'ASTB01'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astb01/batch";
	 } 
	 if (sText == 'Y' && oInput == 'ASTB02'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astb02/batch";
	 } 
	 if (sText == 'Y' && oInput == 'ASTB03'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astb03/batch";
	 } 
	 if (sText == 'Y' && oInput == 'ASTB06'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astb06/batch";
	 } 
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
	 if (sText == 'Y' && oInput == 'ASTI11'){ 
	     window.location="<?php echo base_url()?>index.php/ast/asti11/display";
	 } 
	 if (sText == 'Y' && oInput == 'ASTI12'){ 
	     window.location="<?php echo base_url()?>index.php/ast/asti12/display";
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
	 if (sText == 'Y' && oInput == 'ASTR11'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astr11/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ASTR12'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astr12/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ASTR13'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astr13/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ASTR14'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astr14/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ASTR15'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astr15/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ASTR25'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astr25/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ASTR37'){ 
	     window.location="<?php echo base_url()?>index.php/ast/astr37/printdetail";
	 }
	  //成本系統
	  if (sText == 'Y' && oInput == 'CSTB01'){ 
	     window.location="<?php echo base_url()?>index.php/cst/cstb01/batch";
	 } 	 
	  if (sText == 'Y' && oInput == 'CSTB02'){ 
	     window.location="<?php echo base_url()?>index.php/cst/cstb02/batch";
	 } 	 
	  if (sText == 'Y' && oInput == 'CSTB03'){ 
	     window.location="<?php echo base_url()?>index.php/cst/cstb03/batch";
	 } 	 
	  if (sText == 'Y' && oInput == 'CSTB04'){ 
	     window.location="<?php echo base_url()?>index.php/cst/cstb04/batch";
	 } 	 
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
	  if (sText == 'Y' && oInput == 'TAXR11'){ 
	     window.location="<?php echo base_url()?>index.php/tax/taxr11/printdetail";
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
	 //sfc製程管理系統
     if (sText == 'Y' && oInput == 'SFCB01'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfcb01/batch";
	 } 
	 if (sText == 'Y' && oInput == 'SFCB02'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfcb02/batch";
	 }
	 if (sText == 'Y' && oInput == 'SFCB03'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfcb03/batch";
	 }
	 if (sText == 'Y' && oInput == 'SFCB04'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfcb04/batch";
	 }
     if (sText == 'Y' && oInput == 'SFCI01'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfci01/display";
	 } 
     if (sText == 'Y' && oInput == 'SFCI02'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfci02/updform";
	 } 
     if (sText == 'Y' && oInput == 'SFCI03'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfci03/display";
	 } 
     if (sText == 'Y' && oInput == 'SFCI04'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfci04/display";
	 } 
     if (sText == 'Y' && oInput == 'SFCI05'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfci05/display";
	 } 
     if (sText == 'Y' && oInput == 'SFCR01'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfcr01/printdetail";
	 } 	
    if (sText == 'Y' && oInput == 'SFCR02'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfcr02/printdetail";
	 } 
    if (sText == 'Y' && oInput == 'SFCR03'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfcr03/printdetail";
	 } 
    if (sText == 'Y' && oInput == 'SFCR04'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfcr04/printdetail";
	 } 
    if (sText == 'Y' && oInput == 'SFCR05'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfcr05/printdetail";
	 } 
    if (sText == 'Y' && oInput == 'SFCR06'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfcr06/printdetail";
	 } 
    if (sText == 'Y' && oInput == 'SFCR07'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfcr07/printdetail";
	 } 
    if (sText == 'Y' && oInput == 'SFCR08'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfcr08/printdetail";
	 } 
    if (sText == 'Y' && oInput == 'SFCR09'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfcr09/printdetail";
	 } 
    if (sText == 'Y' && oInput == 'SFCR10'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfcr10/printdetail";
	 } 
    if (sText == 'Y' && oInput == 'SFCR11'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfcr11/printdetail";
	 } 	
	 if (sText == 'Y' && oInput == 'SFCR12'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfcr12/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'SFCR13'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfcr13/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'SFCR14'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfcr14/printdetail";
	 } 
    if (sText == 'Y' && oInput == 'SFCR15'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfcr15/printdetail";
	 } 	
    if (sText == 'Y' && oInput == 'SFCR16'){ 
	     window.location="<?php echo base_url()?>index.php/sfc/sfcr16/printdetail";
	 } 	 
}

//不更新網頁 mg002 檢查程式代號 datacmsq05a modi dataadmq05a
function startadmq05a_old(oInput){         
	
	//首先判斷是否有輸入，沒有輸入直接返回，並提示 
 //	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mg002disp").html("欄位不可空白.");      		
//		return;
//	}
	//建立非同步請求
	//var xmlHttp = new XMLHttpRequest();
    console.log(oInput);
	//createXMLHttpRequest();
	var xmlhttp = getXMLHttpRequest();
  // 	var sUrl = "<?php echo base_url()?>index.php/main/datacmsq05a/"+ oInput + "/0"  + "/" + new Date().getTime();   
	var sUrl = "<?php echo base_url()?>index.php/main/dataadmq05a/"+ oInput + "/0"  + "/" + new Date().getTime();
	var QueryString = "0";
	console.log(xmlhttp);
	// var QueryString = encodeURIComponent(oInput);
	//xmlHttp.open("GET",sUrl,true);	
	xmlhttp.open("POST",sUrl,true);	
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlhttp.send(QueryString);
			
	xmlhttp.onreadystatechange = function(){	    
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200)		  
		  showadmq05a(xmlhttp.responseText,oInput); 	//顯示服務器結果
		  
	}
	
   // xmlHttp.send("0");
	xmlhttp.send(QueryString);
	 
}
//檢查最新不更新網頁
function startadmq05a(oInput){
	
	//alert(acri01);
	var msg='Y';
	//showadmq05a(msg,oInput);
	//var oInput='Admi10';
	console.log(msg);
	console.log(oInput);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/main/dataadmq05a/"+ oInput,
		data: {
			oInput: oInput
		}
	})
	.done(function( msg ) {
		//if($('#acri01disp').text()!=""&&$('#acri01disp').text()!="查無資料")
		//$('#ta002').val(msg);
	     console.log(msg);
	     showadmq05a(msg,oInput);  
	}); 
}
</script>
<?php // include_once("./application/views/fun/main_funtree_funjs_v.php"); ?>  <!-- call 程式 -->