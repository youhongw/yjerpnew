<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
   <!--   <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div> -->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?> 
    </div>

<div id="content">  <!-- div-3 -->
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 發票號碼設定作業 - 新增　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#cmsi11').focus();" type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	<a accesskey="x" id='cancel' name='cancel' href="<?php echo site_url('tax/taxi02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
	
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/tax/taxi02/addsave" >	
	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Ymd");
	  if(!isset($mb001)) { $mb001=$this->input->post('cmsi11'); }
	  if(!isset($cmsi11disp)) { $cmsi11disp=$this->input->post('cmsi11disp'); }
	  if(!isset($mb200)) { $mb200=$this->input->post('mb200'); }
	  if(!isset($mb201)) { $mb201=$this->input->post('mb201'); }
	  if(!isset($mb202)) { $mb202=$this->input->post('mb202'); } 
	  if(!isset($mb203)) { $mb203=$this->input->post('mb203'); }
      if(!isset($mb204)) { $mb204=$this->input->post('mb204'); } 
	  if(!isset($mb205)) { $mb205=$this->input->post('mb205'); } 
      if(!isset($mb206)) { $mb206=$this->input->post('mb206'); } 
	  if(!isset($mb207)) { $mb207=$this->input->post('mb207'); } 
      if(!isset($mb208)) { $mb208=$this->input->post('mb208'); } 
	  if(!isset($mb209)) { $mb209=50; } 
      if(!isset($mb210)) { $mb210=$this->input->post('mb210'); } 
	  if(!isset($mb211)) { $mb211=$this->input->post('mb211'); } 
      if(!isset($mb212)) { $mb212=$this->input->post('mb212'); } 
	  if(!isset($mb213)) { $mb213=$this->input->post('mb213'); } 
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	    <tr>
	   <td class="normal14y"  width="11%"><span class="required">申報公司：</span></td>   <!--onchange="startcopi03(this);check_title_no();"    -->
        <td class="normal14a"  width="39%"><input tabIndex="1" id="cmsi11"    onKeyPress="keyFunction()"   name="cmsi11"  onchange="check_cmsi11(this);check_title_no();"  value="<?php echo $mb001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showcmsi11disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="cmsi11disp"> <?php    echo $cmsi11disp; ?> </span></td>
	    <td class="normal14y" width="11%" >申報期別： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="39%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mb200" onKeyPress="keyFunction()"  onchange="dateformat_ym(this);check_title_no();" name="mb200"  value="<?php echo $mb200; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /></td>
	  </tr>
		  
	  <tr>
	    <td class="normal14z">發票類別：</td>
        <td  class="normal14"  ><select  tabIndex="3" id="mb201" onKeyPress="keyFunction()"  name="mb201" >
             <option <?php if($mb201 == '手開發票') echo 'selected="selected"';?> value='手開發票'>手開發票</option>                                                                      
		     <option <?php if($mb201 == '收銀機') echo 'selected="selected"';?> value='收銀機'>收銀機</option>
			 <option <?php if($mb201 == '其他') echo 'selected="selected"';?> value='其他'>其他</option>
		  </select></td>
		 <td class="normal14z">發票型態：</td>
        <td  class="normal14"  ><select  tabIndex="3" id="mb202" onKeyPress="keyFunction()"  name="mb202" >
             <option <?php if($mb202 == '電子發票') echo 'selected="selected"';?> value='電子發票'>電子發票</option>                                                                      
		     <option <?php if($mb202 == '其他') echo 'selected="selected"';?> value='其他'>其他</option>
		  </select></td>
	   
	  </tr>
	   <tr>
	    <td class="normal14z">聯數：</td>
        <td  class="normal14"  ><select  tabIndex="3" id="mb201" onKeyPress="keyFunction()"  name="mb201" >
             <option <?php if($mb201 == '二聯式') echo 'selected="selected"';?> value='二聯式'>二聯式</option>                                                                      
		     <option <?php if($mb201 == '三聯式') echo 'selected="selected"';?> value='三聯式'>三聯式</option>
		     <option <?php if($mb201 == '二聯式收銀機發票') echo 'selected="selected"';?> value='二聯式收銀機發票'>二聯式收銀機發票</option>
		     <option <?php if($mb201 == '三聯式收銀機發票') echo 'selected="selected"';?> value='三聯式收銀機發票'>三聯式</option>
		     <option <?php if($mb201 == '電子計算機發票') echo 'selected="selected"';?> value='電子計算機發票'>電子計算機發票</option>
		  </select></td>
		 <td class="normal14z">字軌：</td>
         <td class="normal14"><input type="text" tabIndex="13" id="mb206" onKeyPress="keyFunction()" name="mb206"   value="<?php echo strtoupper($mb206); ?>"  size="8"  /></td>	
	   
	  </tr>
	  <tr>
		 <td class="normal14z">發票號碼起：</td>
         <td class="normal14"><input type="text" tabIndex="13" id="mb207" onchange="check_addno(this);" onKeyPress="keyFunction()" name="mb207"   value="<?php echo $mb207; ?>"  size="12"  /></td>	
	     <td class="normal14z">發票號碼迄：</td>
         <td class="normal14"><input type="text" tabIndex="13" id="mb208" onKeyPress="keyFunction()" name="mb208"   value="<?php echo $mb208; ?>"  size="12"  /></td>
	  </tr>
	  <tr>
		 <td class="normal14z">發票起日：</td>
         <td class="normal14"><input type="text" tabIndex="13" id="mb204"  ondblclick="scwShow(this,event);" onchange="dateformat_ymd(this);" onKeyPress="keyFunction()" name="mb204"   value="<?php echo $mb204; ?>"  size="12"  /></td>	
	     <td class="normal14z">發票迄日：</td>
         <td class="normal14"><input type="text" tabIndex="13" id="mb205" ondblclick="scwShow(this,event);" onchange="dateformat_ymd(this);" onKeyPress="keyFunction()" name="mb205"   value="<?php echo $mb205; ?>"  size="12"  /></td>
	  </tr>	
	  <tr>
		 <td class="normal14z">張數：</td>
         <td class="normal14"><input type="text" tabIndex="13" id="mb209" onKeyPress="keyFunction()" name="mb209"   value="<?php echo $mb209; ?>"  size="12"  /></td>	
	     <td class="normal14z">已開立號碼：</td>
         <td class="normal14"><input type="text" tabIndex="13" id="mb210" onKeyPress="keyFunction()" name="mb210"   value="<?php echo $mb210; ?>"  size="12"  /></td>
	  </tr>	
	  <tr>
		 <td class="normal14z">作廢張數：</td>
         <td class="normal14"><input type="text" tabIndex="13" id="mb211" onKeyPress="keyFunction()" name="mb211"   value="<?php echo $mb211; ?>"  size="12" style="background-color:#F0F0F0" size="22" /></td>	
	     <td class="normal14z">上傳類別：</td>
         <td  class="normal14"  ><select  tabIndex="3" id="mb213" onKeyPress="keyFunction()"  name="mb213" >
             <option <?php if($mb213 == '1') echo 'selected="selected"';?> value='1'>1:自動上傳</option>                                                                      
		     <option <?php if($mb213 == '2') echo 'selected="selected"';?> value='2'>2:手動上傳</option>
		  </select>
	  </tr>	
	 
	</table>
	
	<!--<div class="buttons">
	<button  type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a accesskey="x" id='cancel' name='cancel' href="<?php echo site_url('tax/taxi02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
	</div>  -->
	  
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
  <!--  </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

    </div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div>  <!-- div-1 -->

<script language="javascript"   >   //不更新網頁, 帶出資料
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁 判斷適用各種流覽器 共用 (全域)
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
}
    function showkey(sText){   //不更新網頁 5 key  品號代號 檢查資料重複 invi02-add
	var oSpan = document.getElementById("keydisp");
		oSpan.innerHTML = sText;		
	 if (!sText) { 
	   $("#keydisp").html("資料可使用!");
	   oSpan.style.color = "#000000";
	 }	 
	  if (sText) { 
	   $("#keydisp").html("資料重複!");
	   oSpan.style.color = "#ff0000";
	 //  document.getElementById("ma002").focus();
	 } 
}
function check_addno(sText){ 
    
    var vmb207=$("#mb207").val();
	var vmb209=$("#mb209").val();
	var vmb208=parseInt(vmb207)+parseInt(vmb209);
	console.log(vmb208);
	$("#mb208").val(vmb208);
	$("#mb210").val(vmb207);
     document.getElementById("mb208").focus();
	 return;
}
function startkey(oInput){         //不更新網頁 key 品號代號函數 檢查資料重複 invi02-add
	
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
 	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
		$("#keydisp").html("欄位不可空白.");      		
		return;
	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/tax/taxi02/checkkey/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showkey(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}
</script>
   
 <?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 共用函數 -->
 <?php  include_once("./application/views/funnew/cmsi11_funmjs_v.php"); ?> <!-- 申報公司 -->
				 