<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content"> <!-- div-3 --> 
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> E-BOM變更單建立作業 - 新增　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#ti001').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ebo/eboi04/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/ebo/eboi04/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  $bomq03a44=$this->input->post('ti001'); 
	  $bomq03a44disp=$this->input->post('ti001'); 
	  
	  if(!isset($create_date)) { $create_date=date("Y/m/d"); }
	  $ti002=$this->input->post('ti002');
	  $ti003=$this->input->post('ti003');
	 
	  $bomq03a44=$this->input->post('bomq03a44');
	  $bomq03a44disp=$this->input->post('bomq03a44');
	  
	  $ti004=$this->input->post('ti004');
	  $ti005=$this->input->post('ti005');
	  $ti006=$this->input->post('ti006');
	  $ti007=$this->input->post('ti007');
	 // $ti008=$this->input->post('ti008');
	  $ti009=$this->input->post('ti009');
	 // $ti010=$this->input->post('ti010');
	  $ti011=$this->input->post('ti011');
	  $modi_date=$date;
	//   if(!isset($mocq01a51)) { $mocq01a51=$this->session->userdata('sysma003'); }
	  if(!isset($ti010)) { $ti010=$this->session->userdata('manager'); }
	   if(!isset($ti008)) { $ti008=0; }
	   $ti003=date("Y/m/d");
	  $ti004='N';
	  $ti007='Y';
	//  if(!isset($ti011)) { $ti011=$username; }
	?>
   
	<table class="form14"  >     <!-- 頭部表格 check_title_no();-->
	  <tr>
	    <td class="normal14y"  width="10%"><span class="required">變更單別：</span> </td>
        <td class="normal14a"  width="22%"><input type="text" tabIndex="1" id="ti001"    onKeyPress="keyFunction()"   onchange="startbomq03a44(this)"  name="bomq03a44" value="<?php echo $bomq03a44; ?>"   required />
		<a href="javascript:;"><img id="Showbomq03a44disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="bomq03a44disp"></span></td>
		 
	    <td class="normal14y" width="10%" >單據日期： </td>
        <td class="normal14a"  width="24%" ><input tabIndex="2"  onclick="scwShow(this,event);"   id="ti009" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);chkno1(this);" name="ti009"  value="<?php echo $ti009; ?>"  size="12" type="text"  style="background-color:#E7EFEF" />
          <img  onclick="scwShow(ti009,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>	   
	   <td class="normal14y" width="10%" >變更單號：</td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="ti002" onKeyPress="keyFunction()" onfocus="chkno1(this);" name="ti002" value="<?php echo $ti002; ?>" size="30" type="text" required /></td>
	  </tr>	
		  
	  <tr>
		<td class="normal14z">緊急：</td>
        <td  class="normal14"  ><input tabIndex="4" id="ti004" onKeyPress="keyFunction()"  name="ti004" value="<?php echo $ti004; ?>"  type="text"    /></td>    
	    <td class="normal14z" >變更原因：</td>
        <td class="normal14a" ><input tabIndex="5" id="ti005" onKeyPress="keyFunction()"  name="ti005" value="<?php echo $ti005; ?>"  type="text"   /></td>
		<td class="normal14z" >備註：</td>
        <td class="normal14a" ><input tabIndex="6" id="ti006" onKeyPress="keyFunction()"  name="ti006" value="<?php echo $ti006; ?>"  type="text"   /></td>
	  
	  </tr>
	 
	  <tr>
		<td class="normal14z">變更日期：</td>
        <td  class="normal14"  ><input tabIndex="10" id="ti003" onKeyPress="keyFunction()"  name="ti003" value="<?php echo $ti003; ?>"  type="text"  style="background-color:#F5F5F5"  /></td>    
	    <td class="normal14z" >確認者：</td>
        <td class="normal14a" ><input tabIndex="11" id="ti010" onKeyPress="keyFunction()"  name="ti010" value="<?php echo $ti010; ?>"  type="text"  style="background-color:#F5F5F5"  /></td>
		<td class="normal14z" >列印次數：</td>
        <td class="normal14a" ><input tabIndex="12" id="ti008" onKeyPress="keyFunction()"  name="ti008" value="<?php echo $ti008; ?>"  type="text"  style="background-color:#F5F5F5" /></td>
	  
	  </tr>
	  <tr>
		<td class="normal14z">簽核狀態：</td>
        <td  class="normal14"  ><select id="ti011" tabIndex="25" readonly="value" onKeyPress="keyFunction()" name="ti011"   style="background-color:#EBEBE4" disabled="disabled">
            <option <?php if($ti011 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($ti011 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($ti011 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($ti011 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($ti011 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($ti011 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($ti011 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($ti011 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td><td class="normal14" ></td>
        <td class="normal14z" >確認碼</td>
		<td class="normal14a" ><input tabIndex="11" id="ti007" onKeyPress="keyFunction()"  name="ti007" value="<?php echo $ti007; ?>"  type="text"  style="background-color:#F5F5F5"  /></td>
        <td class="normal14a" ></td>
	  
	  </tr>
		
	</table>
		

	<div>
        <table id="order_product" class="list1">
        <thead>
            <tr>
              <td width="5%"></td>			
		      <td width="8%" class="center">主件品號</td>
              <td width="13%" class="left">品名</td>
			  <td width="13%" class="left">規格</td>
			  <td width="6%" class="left">單位</td>
			  <td width="6%" class="center">序號</td>
		<!--	  <td width="6%" class="left">生效日期</td>
              <td width="6%" class="center">失效日期</td> -->
              <td width="6%" class="right">標準批量</td>
			<!--  <td width="6%" class="right">確認狀態</td>
			  <td width="6%" class="right">確認碼</td>-->
			  <td width="6%" class="center">確認碼</td>
			  <td width="6%" class="right">確認狀態</td>
			  <td width="10%" class="center">變更原因</td>				
            </tr>
        </thead>
          <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="10"></td>
            </tr>
          </tfoot>
       </table>
    </div>
	
	
	<!-- <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ebo/eboi04/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div> -->
	 <br> 
    </form>
	  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
	
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

 
    </div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<script language="javascript"  >   

var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁 判斷適用各種流覽器 共用 (全域)
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
}

<!-- 不更新網頁帶出資料  組合單號 -->


<!-- 不更新網頁 計算單號 組合單號 -->	 
function chkno1(oInput){         
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#td006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
	console.log('test');
	 var zno=$('input[name=\'bomq03a44\']').val();
	 var zstr=$('input[name=\'ti009\']').val();
	 console.log(zstr);
	 var zymd1 = zstr.substring(0,4);
	 var zymd2 = zstr.substring(5,7);
	 var zymd3 = zstr.substring(8,10);
	 var zymd = zymd1+zymd2+zymd3;
	 console.log(zymd);
    //  alert(zstr);
	  
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/ebo/eboi04/datachkno1/" + encodeURIComponent(zno)+ "/" + encodeURIComponent(zymd)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(zymd);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showchkno1(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}
function showchkno1(sText){   
    
       if  (!sText) { sText=$('input[name=\'ti009\']').val();   
	          zymd1 = sText.substring(0,4); zymd2 = sText.substring(5,7); zymd3 = sText.substring(8,10); sText = zymd1+zymd2+zymd3+'000';  }	
       var zno1=sText.substring(0,8);
	   var zno2=sText.substring(8,11);
	   
	   var zno=zno1+zno2;
	  // alert(zno1);
	   var zno3=parseInt(zno)+1;
	   document.getElementById("ti002").value=zno3;
	 
	 }	
</script> 
     <?php  include_once("./application/views/fun/eboi04_funjs_v.php"); ?> 
	  