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
				roootElement.src="<?=base_url() ?>/assets/tree/tree/ofolder.gif";
				//roootElement.src=sImagePathPrefix+"assets/tree/tree/tree/ofolder.gif";
			}
			else
			{
				targetElement.style.display="none";
				roootElement.src="<?=base_url() ?>/assets/tree/tree/folder.gif";
				                  
				//roootElement.src=sImagePathPrefix+"assets/tree/tree/tree/folder.gif";
			}
		}
	}
}

function OnClickOutline(imgRootPath,iId)
{
	var targetId,srcElement,targetElement;
	srcElement=document.getElementById("ID"+iId);
	if(srcElement.className=="Outline"){
		targetId=srcElement.id+"d";
		targetElement=document.getElementById(targetId);
		if(targetElement.style.display =="none"){
			targetElement.style.display="";
			srcElement.src="<?=base_url() ?>/assets/tree/tree/ofolder.gif";
			//srcElement.src=imgRootPath+"assets/tree/tree/tree/ofolder.gif";
		}else{
			targetElement.style.display="none";
			srcElement.src="<?=base_url() ?>/assets/tree/tree/folder.gif";
			//srcElement.src=imgRootPath+"assets/tree/tree/tree/folder.gif";
		}
		
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
			obj.prevAll('div:first').find('img:last').attr('src','<?=base_url() ?>/assets/tree/tree/ofolder.gif');
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
	 
	
	 //產品結構系統
	 if (sText == 'Y' && oInput == 'BOMI01'){ 
	     window.location="<?php echo base_url()?>index.php/bom/bomi01/display";
	 } 	 
	 if (sText == 'Y' && oInput == 'BOMI02'){ 
	     window.location="<?php echo base_url()?>index.php/bom/bomi02/display";
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
	 if (sText == 'Y' && oInput == 'COPI03'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copi03/display";
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
	 if (sText == 'Y' && oInput == 'COPR05'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copr05/printdetail";
	 } 		
	 if (sText == 'Y' && oInput == 'COPR03'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copr03/printdetail";
	 } 		
	 if (sText == 'Y' && oInput == 'COPR31'){ 
	     window.location="<?php echo base_url()?>index.php/cop/copr31/printdetail";
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
	   if (sText == 'Y' && oInput == 'INVI14'){ 
	     window.location="<?php echo base_url()?>index.php/inv/invi14/display";
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
     if (sText == 'Y' && oInput == 'MOCI05'){ 
	     window.location="<?php echo base_url()?>index.php/moc/moci05/display";
	 }
     if (sText == 'Y' && oInput == 'MOCI12'){ 
	     window.location="<?php echo base_url()?>index.php/moc/moci12/display";
	 }  	 
	 
	  //票據資金系統
     if (sText == 'Y' && oInput == 'NOTI06'){ 
	     window.location="<?php echo base_url()?>index.php/not/noti06/display";
	 } 
	 //人事系統
     if (sText == 'Y' && oInput == 'PALI01'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali01/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI09'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali09/display";
	 } 
	  if (sText == 'Y' && oInput == 'PALI10'){ 
	     window.location="<?php echo base_url()?>index.php/pal/pali10/display";
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
	//my電子商務系統
     if (sText == 'Y' && oInput == 'MYMB01'){ 
	     window.location="<?php echo base_url()?>index.php/mym/mymb01/index";
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

//不更新網頁 mg002 檢查程式代號 
function startadmq05a(oInput){         
	
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
 //	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mg002disp").html("欄位不可空白.");      		
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/main/datacmsq05a/"+ oInput + "/11111"  + "/" + new Date().getTime();   
	var QueryString = "11111";
	 
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
  //會計系統
   function open_actb01()
  { 
    var prg='ACTB01';
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
   function open_copr05()
  {
    var prg='COPR05';
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
 function open_copi03()
  {
    var prg='COPI03';
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
    function open_copq02()
  {
    var prg='COPQ02';
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
  function open_invi14()
  {
     var prg='INVI14';
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
function open_noti06()
  {
     var prg='NOTI06';
     startadmq05a(prg); 
  }   
  //人事系統
function open_pali01()
  {
     var prg='PALI01';
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
  //電子商務
  function open_mymb01()
  {
    var prg='MYMB01';
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