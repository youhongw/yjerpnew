
<div id="container">
  <div id="header">
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
		  <img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?=base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>
	    </div>
    </div>


<div id="content"> 
  <div class="box">
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 請購單資料建立作業</h1>
    </div>
	
    <div class="content">
	<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?=base_url()?>index.php/pur/puri05/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數
	  
	  $date=date("Ymd");
	 
	  if ($this->session->userdata('ta001')) { $ta001 = $this->session->userdata('ta001'); } else { $ta001=$this->input->post('ta001'); }
	//   if(!isset($ta001)) { $ta001=$this->input->post('ta001'); }
	   
	  if(!isset($ta004)) { $ta004=$this->input->post('ta004'); }
      $ta002=$this->input->post('ta002');
	  if(!isset($ta013)) { $ta013=date("Ymd"); }
    //  $ta013=$this->input->post('ta013');	  
       
      $ta001disp=$this->input->post('ta001');
      if($this->uri->segment(4) && $this->uri->segment(6)==0) { $ta001=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ta001', $ta001);$ta001 = $this->session->userdata('ta001'); }
	  if($this->uri->segment(5) && $this->uri->segment(6)==0) { $ta001disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ta001disp', $ta001disp); $ta001disp = $this->session->userdata('ta001disp');} 
	  
     
	//  if($this->uri->segment(4) && $this->uri->segment(6)==5) { $ta001=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ta001', $ta001);$ta001 = $this->session->userdata('ta001'); }
    //  if($this->uri->segment(5) && $this->uri->segment(6)==5) { $ta001disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ta001disp', $ta001disp); $ta001disp = $this->session->userdata('ta001disp');} 
	 // if ($this->session->userdata('ta001')) { $ta001= $this->session->userdata('ta001'); }

	?>
   
	<table class="form12"  >     <!-- 頭部表格 -->
	  <tr>
	     <td class="start12a"  width="10%"><span class="required">請購單別：</span> </td>
            <td class="normal12a"  width="50%"><input tabIndex="1" id="ta001"      onKeyPress="keyFunction()"  onBlur="startpurq04a31(this)"  name="ta001" value="<?php echo strtoupper($ta001); ?>"  type="text" required /><a href="javascript:;"><img id="Showpurq04a31" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
		    <span id="ta001disp"> <?php  echo $this->session->userdata('ta001disp');  ?><?php  if (!$this->session->userdata('ta001disp'))  echo $ta001disp; ?> </span></td>
			
	    <td class="normal12a" width="10%" > </td>
            <td class="normal12a"  width="50%" >&nbsp;&nbsp;</td>
	 </tr>	
		  
	  <tr>
	    <td class="start12" >講購單號： </td>
            <td class="normal12" ><input tabIndex="2" id="ta002" onKeyPress="keyFunction()" onBlur="checkspace2(this)" name="ta002" value="<?php echo $ta002; ?>" size="30" type="text" required /><span id="ta002disp" ></span></td>
		   <td class="normal12">&nbsp;&nbsp;</td>
            <td class="normal12"></td>
		
	  </tr>
		
	  <tr>
	    <td  class="normal12" >單據日期：</td>
            <td  class="normal12"  ><input tabIndex="3"  id="datepicker1" onKeyPress="keyFunction()" name="ta013"  value="<?php echo $ta013; ?>"  size="30" type="text"   /></td>
			 <td class="normal12">&nbsp;&nbsp;</td>
            <td class="normal12"></td>
	  </tr>
		
	</table>
	
	
	
	<div class="abgne_tab">
		<ul class="tabs">
			<li><a href="#tab1">基本資料</a></li>
		<!--	<li><a href="#tab2">交易資料</a></li>
			<li><a href="#tab3">地址</a></li>   -->
		</ul>
	
	 
<!--	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?=base_url()?>index.php/pur/puri05/addsave" >	 -->
<!--	<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>    -->
    <div class="tab_container">
			<div id="tab1" class="tab_content">
	<!--  <div id="tab-general">     基本資料 -->
	<?php
	  $date=date("Ymd");
	 // $ta005disp='';$ta006disp='';
	  $ta003=date("Ymd");
	  $ta004=$this->input->post('ta004');
	  $ta005=$this->input->post('ta005');
	  $ta006=$this->input->post('ta006');
	  $ta007=$this->input->post('ta007');
	  $ta008=$this->input->post('ta008');
	  $ta009=$this->input->post('ta009');	
	  $ta010=$this->input->post('ta010');	
	  $ta011=$this->input->post('ta011');
      $ta012=$this->input->post('ta012');
      
      $ta014=$this->input->post('ta014');
	  $ta015=$this->input->post('ta015');	
	  $ta016=$this->input->post('ta016');	
	 

	  //開視窗及不更新網頁直接輸入出現中文
	  $ta004disp=$this->input->post('ta004');
      if($this->uri->segment(4) && $this->uri->segment(6)==1) { $ta004=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ta004', $ta004);$ta004 = $this->session->userdata('ta004'); }
	  if($this->uri->segment(5) && $this->uri->segment(6)==1) { $ta004disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ta004disp', $ta004disp); $ta004disp = $this->session->userdata('ta004disp');} 
	  if ($this->session->userdata('ta004')) { $ta004= $this->session->userdata('ta004'); }
	  
	  $ta010disp=$this->input->post('ta010');
      if($this->uri->segment(4) && $this->uri->segment(6)==2) { $ta010=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ta010', $ta010);$ta010 = $this->session->userdata('ta010'); }
	  if($this->uri->segment(5) && $this->uri->segment(6)==2) { $ta010disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ta010disp', $ta010disp); $ta010disp = $this->session->userdata('ta010disp');} 
	  if ($this->session->userdata('ta010')) { $ta010= $this->session->userdata('ta010'); }
	  
	   $ta012disp=$this->input->post('ta012');
      if($this->uri->segment(4) && $this->uri->segment(6)==3) { $ta012=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ta012', $ta012);$ta012 = $this->session->userdata('ta012'); }
	  if($this->uri->segment(5) && $this->uri->segment(6)==3) { $ta012disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ta012disp', $ta012disp); $ta012disp = $this->session->userdata('ta012disp');} 
	  if ($this->session->userdata('ta012')) { $ta012= $this->session->userdata('ta012'); }
	  
	?>
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	    
		<td class="start14a"  width="10%">請購部門：</td>
        <td class="normal14a"  width="40%" ><input type="text" tabIndex="4" id="ta004" onKeyPress="keyFunction()"   onBlur="startcmsq05a(this)" name="ta004"   value="<?php echo  $ta004; ?>"     /><a href="javascript:;"><img id="Showcmsq05a" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
		<span id="ta004disp"> <?php  echo $this->session->userdata('ta004disp');  ?><?php  if (!$this->session->userdata('ta004disp'))  echo $ta004disp; ?> </span></td>	
			
		<td class="start14a"  width="10%" > 廠別：</td>
        <td class="normal14a"  width="40%" ><input type="text" tabIndex="5" id="ta010" onKeyPress="keyFunction()"   onBlur="startcmsq02a(this)" name="ta010"   value="<?php echo  $ta010; ?>"     /><a href="javascript:;"><img id="Showcmsq02a" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
	    <span id="ta010disp"> <?php  echo $this->session->userdata('ta010disp');  ?><?php  if (!$this->session->userdata('ta010disp'))  echo $ta010disp; ?> </span></td>
       
	</tr>	
		  
	  <tr>
	   <td class="start14a"  >請購人員：</td>
        <td class="normal14" ><input type="text" tabIndex="6" id="ta012" onKeyPress="keyFunction()"   onBlur="startpalq01a(this)" name="ta012"   value="<?php echo  $ta012; ?>"    size="6"  /><a href="javascript:;"><img id="Showpalq01a" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
		<span id="ta012disp"> <?php  echo $this->session->userdata('ta012disp');  ?><?php  if (!$this->session->userdata('ta012disp'))  echo $ta012disp; ?> </span></td>
	    <td class="normal14" >請購日期：</td>
        <td class="normal14"  ><input tabIndex="7" id="ta003" onKeyPress="keyFunction()"   name="ta003" value="<?php echo $ta003; ?>" type="text"  /></td>
				
	  </tr>
		
	  <tr>
	    <td  class="normal14" >備註：</td>
        <td  class="normal14"  ><input tabIndex="8" id="ta008" onKeyPress="keyFunction()"   name="ta008" value="<?php echo $ta008; ?>" type="text"  /></td>		   
	   <td  class="start14a">簽核狀態：</td>		
        <td  class="normal14"  ><input tabIndex="9"   onKeyPress="keyFunction()"   name="ta016" value="<?php echo $ta016; ?>" type="text" disabled="disabled"  /></td>
	    
	  </tr>
	    <tr>
	    
	    <td class="normal14">來源別：</td>						
            <td  class="normal14"  ><input tabIndex="10" id="ta009" onKeyPress="keyFunction()" name="ta009"   value="<?php echo $ta009; ?>"  type="text" disabled="disabled"  /></td>
			 <td class="normal14" >列印：</td>						
            <td  class="normal14"  ><input tabIndex="11" id="ta008" onKeyPress="keyFunction()" name="ta008"   value="<?php echo $ta008; ?>"   type="text" disabled="disabled" /></td>
		
	  </tr>	
		
	  <tr>
	     <td  class="normal14" >來源單別：</td>
             <td class="normal14"><input tabIndex="12" id="ta005" onKeyPress="keyFunction()"   name="ta005" value="<?php echo $ta005; ?>" type="text" disabled="disabled" /></td>
	    <td class="start14a">確認者：</td>
            <td  class="normal14"  ><input tabIndex="13" id="ta014" onKeyPress="keyFunction()" name="ta014"   value="<?php echo $ta014; ?>"   type="text" disabled="disabled" /></td>
	
	  </tr>
	  
	  <tr>
		   <td class="normal14"></td>
            <td class="normal14"></td>
			 <td class="normal14">&nbsp;&nbsp;</td>
            <td class="normal14"></td>
			
	  </tr>
		
	</table>
	
	
	  <div>
          <table id="order_product" class="list">
            <thead>
              <tr>
                <td width="5%"></td>
				<td width="6%" class="center">序號</td>
				<td width="11%" class="center">品號</td>
                <td width="18%" class="left">品名</td>
				<td width="18%" class="left">規格</td>
				<td width="10%" class="left">需求日期</td>
                <td width="6%" class="center">數量</td>
                <td width="6%" class="right">單價</td>
                <td width="6%" class="right">小計</td>
				<td width="14%" class="center">備註</td>				
              </tr>
            </thead>
                        			  <tfoot>
				品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>		 
              <tr>
                <td class="center" valign="top"><img src="<?=base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
				<td class="left" colspan="11"></td>
              </tr>
              </tfoot>
          </table>
        </div>
	
	 </div>
	</div>
	<div class="buttons">
	<button tabIndex="8" type='submit'  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pur/puri05/display'); ?>" class="button" ><span>返 回&nbsp;F9</span></a>
	</div> 
	  
    </form>
    </div> 
	
  </div>
</div>

  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> 
  </div> 
   </div> 
    
	<script type="text/javascript"> 	   //開視窗 一定要寫 31 單別
	$(document).ready(function(){
	$("#Showpurq04a31").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divForm31'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	  
	<div id="divForm31" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/pur/purq04a/display31" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addpurq04a31(sta001,sta002) {	
	form.ta001.value=sta001;
	var oSpan = document.getElementById("ta001disp");
		oSpan.innerHTML = sta002;
	document.form.ta001.focus();    
	return ta001;	
}
//--></script>
	
	
<script type="text/javascript"> 	   //開視窗 一定要寫 10 廠別
	$(document).ready(function(){ 	   
	$("#Showcmsq02a").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divForm10'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divForm10" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/cms/cmsq02a/display" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq02a(sta001,sta002) {
	  	  form.ta010.value=sta001;
	var oSpan = document.getElementById("ta010disp");
		oSpan.innerHTML = sta002;
	document.form.ta010.focus();    
	return ta010;
	
}
//--></script>

<script type="text/javascript"> 	   //開視窗 一定要寫 04 請購部門
	$(document).ready(function(){ 	   
	$("#Showcmsq05a").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divForm4'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divForm4" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/cms/cmsq05a/display" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq05a(sta001,sta002) {
	  	  form.ta004.value=sta001;
	var oSpan = document.getElementById("ta004disp");
		oSpan.innerHTML = sta002;
	document.form.ta004.focus();    
	return ta004;
	
}
//--></script>

<script type="text/javascript"> 	   //開視窗 一定要寫 12 請購人員
	$(document).ready(function(){ 	   
	$("#Showpalq01a").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divForm12'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divForm12" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/pal/palq01a/display" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addpalq01a(sta001,sta002) {
	  form.ta012.value=sta001;
	var oSpan = document.getElementById("ta012disp");
		oSpan.innerHTML = sta002;
	document.form.ta012.focus();    
	return ta012;
	
}
//--></script>

<script type="text/javascript"> 	   //開視窗 一定要寫 cmsq09a4 採購人員
	$(document).ready(function(){ 	   
	$("#Showcmsq09a4").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divFormcmsq09a4'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFormcmsq09a4" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/cms/cmsq09a/display3" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>

<script type="text/javascript"><!--
  function addOrder41(sta001,sta002) {
	form.ta047.value=sta001;	
	var oSpan = document.getElementById("ta047disp");
		oSpan.innerHTML = sta002;	
	document.form.ta047.focus();    
	return ta047;
}
//--></script>



<script type="text/javascript"> 	   //開視窗 一定要寫 18 交易幣別
	$(document).ready(function(){ 	   
	$("#Showcmsq06a").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divForm06'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divForm06" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/cms/cmsq06a/display" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq06a(sta001,sta002) {
	form.ta021.value=sta001;
	var oSpan = document.getElementById("ta021disp");
		oSpan.innerHTML = sta002;	
	document.form.ta021.focus();    
	return ta021;
}
//--></script>




<script language="javascript"   >   //不更新網頁, 帶出資料
 
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁 判斷適用各種流覽器 共用 (全域)
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
}


function showpurq04a(sText){                 //不更新網頁 1 單別    
	var oSpan = document.getElementById("ta001disp");	
	   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}


function startpurq04a(oInput){            //不更新網頁 1  單別
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ta007disp").html("<span style='color:red'>欄位不可空白.</span>");			
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/pur/puri05/datapurq04a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showpurq04a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showcmsq02a(sText){   //不更新網頁 10  廠別
	var oSpan = document.getElementById("ta010disp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}


function startcmsq02a(oInput){         //不更新網頁 10 廠別
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ta006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/pur/puri05/datacmsq02a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq02a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showpalq01a(sText){   //不更新網頁 12  請購人員
	var oSpan = document.getElementById("ta012disp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}


function startpalq01a(oInput){         //不更新網頁 12 請購人員
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ta006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/pur/puri05/datapalq01a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcpalq01a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showcmsq09a4(sText){   //不更新網頁 4  採購人員
	var oSpan = document.getElementById("ta047disp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}


function startcmsq09a4(oInput){         //不更新網頁 4  採購人員
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ta006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/pur/puri05/datacmsq09a4/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq09a4(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showpurq01a(sText){   //不更新網頁 5  廠商 檢查資料重複
	var oSpan = document.getElementById("ta001disp");
		oSpan.innerHTML = sText;		
	 if (!sText) { 
	   $("#ta001disp").html("廠商可使用!");
	   oSpan.style.color = "blank";
	 }	 
	  if (sText) { 
	   $("#ta001disp").html("廠商重複!");
	   oSpan.style.color = "red";
	   document.getElementById("ta001").focus();
	 } 
}

function startpurq01a(oInput){         //不更新網頁 5 廠商
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
 	if(!oInput.value){
		oInput.focus();    //聚焦到用戶名的輸入框
		$("#ta001disp").html("<span style='color:red'>欄位不可空白.</span>");
		return;
	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/pur/puri05/checkdata5/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showpurq01a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}



function showinvq02a4(sText){   //不更新網頁 4 明細 品號 檢查資料重複
      alert('test2');
	var oSpan = document.getElementById("tb005");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

function startinvq02a4(oInput){         //不更新網頁 4 明細 品號
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ta017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    alert('test1');
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/pur/puri05/checkinvq02a4/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showinvq02a4(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}



 <script type="text/javascript"><!--       //檢查欄位空白
 function checkspace2(oInput){         //不更新網頁 2 商品
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	if(!oInput.value){
		oInput.focus();    //聚焦到用戶名的輸入框
		$("#ta002disp").html("<span style='color:red'>不可空白.</span>");	
		return;
	}
	 
}

//--></script> 	
 
<script type="text/javascript"><!-- 	// enterkey 測試   
	$(document).ready(function(){ 	   
//	$('#ta001').focus(); 	   
	Enterkey(); 	   
	}); 	   
//--></script> 	   
		   
<script type="text/javascript"><!-- 	// enterkey 測試    
	function Enterkey() { 	   
	$("input").not( $(":button") ).keypress(function (evt) { 	   
	if (evt.keyCode == 13) { 	   
	if ($(this).attr("type") !== 'submit'){ 	   
	var fields = $(this).parents('form:eq(0),body').find('button, input, textarea'); 	   
	var index = fields.index( this ); 	   
	if ( index > -1 && ( index + 1 ) < fields.length ) { 	   
	fields.eq( index + 1 ).focus(); 	   
	} 	   
	$(this).blur(); 	   
	return false; 	   
	} 	   
	} 	   
	}); 	   
	} 	   
//--></script> 	 
<script type="text/javascript"><!--
$.widget('custom.catcomplete', $.ui.autocomplete, {
	_renderMenu: function(ul, items) {
		var self = this, currentCategory = '';
						
		$.each(items, function(index, item) {
			if (item.category != currentCategory) {
				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');
								
				currentCategory = item.category;
			}
							
			self._renderItem(ul, item);
		});
	}
});	
//--></script>

<script type="text/javascript"><!--    // 明細 新增 
var product_row = 0;
	
function addItem() {
	html  = '<tbody id="product-row' + product_row + '">';
	html += '  <tr>'; 
	html += '    <td class="center"><img src="<?=base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td>';
  	html += '    <input type="hidden" name="order_product[' + product_row + '][tb001]" value="" />';
	html += '    <input type="hidden" name="order_product[' + product_row + '][tb002]" value="" />';	
	html += '    <td class="left"><input type="text" id="tb003" onKeyPress="keyFunction()" class="tb003" name="order_product[' + product_row + '][tb003]" value="" size="6" /></td>';
	html += '    <td class="left"><input  id="tb004" onKeyPress="keyFunction()"  name="order_product[' + product_row + '][tb004]" value="" size="20"  /></td>';	
	html += '    <td class="left"><input type="text" id="tb005" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb005]" value=""  /></td>';
	html += '    <td class="left"><input type="text" id="tb006" onKeyPress="keyFunction()"   name="order_product[' + product_row + '][tb006]" value=""  size="30" /></td>';
	html += '    <td class="left"><input type="text"  id="tb011"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb011]" value="" size="10" class="date" /></td>';
	html += '    <td class="center"><input type="text" id="tb009" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb009]" value="1" size="3" style="text-align:right" /></td>';
    html += '    <td class="center"><input type="text" id="tb017" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb017]" value="0" size="6" style="text-align:right" /></td>';	
    html += '    <td class="right"><input readonly="value" type="text" name="order_product[' + product_row + '][tb018]" value="" size="10" style="text-align:right" /></td>';
	html += '    <td class="left"><input type="text" id="tb012" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb012]" value="" size="20" /></td>';
	html += '  </tr>';	
    html += '</tbody>';
	
	$('#order_product tfoot').before(html);    

	 
	   	   //下拉視窗 網頁不更新  mb001 tb004 品號品名輸入
		  
          $('input[name=\'order_product[' + product_row + '][tb004]\']').catcomplete({
              autoFocus: true,
		delay: 0,
		source: 
		function(req, add){ 
                     var smb001=document.getElementById('tb004').value;
                    $.ajax({  
                        url: '<?php echo base_url(); ?>index.php/pur/puri05/lookup/'+encodeURIComponent(smb001),  
                        dataType: 'json',  
                        type: 'POST',  
                        data: req,  
                        success:      
                        function(data){  
                            if(data.response =="true"){ 
                               
								  add(data.message);
                                 								  
                            }
                         //   else
                         //   { document.getElementById('printable_name').value='11';$("#mess").html("無資料重新輸入"); }							
                        }, 
                      				
                    });  
                },  
            select:   
                function(event, ui) {  
				   var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
                   $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);				   
				   $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value2);
				   $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value3);
			       return false;
                }, 
				
            });  
    
	
	 
      //  明細 小計
	$('input[name=\'order_product[' + product_row + '][tb009]\'],input[name=\'order_product[' + product_row + '][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb017]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb018]\']').val(get_total); 
	});
	
	$('input[name=\'order_product[' + product_row + '][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
			$(this).val('');
	});
            
	$('input[name=\'order_product[' + product_row + '][tb009]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[' + product_row + '][tb017]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
			$(this).val('');
	});
            
	$('input[name=\'order_product[' + product_row + '][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
    $('input[name=\'order_product[' + product_row + '][tb011]\']').focus(function(){
		$('.date').datepicker({dateFormat: 'yymmdd'});
	});
	
	$('input[name=\'order_product[' + product_row + '][tb011]\']').blur(function(){
		$('input[name=\'order_product[' + n + '][tb011]\']').val(); 
	});
	$('.date').datepicker({dateFormat: 'yymmdd'});
	
	product_row++;
}
//-->
</script>

 
 <!-- 明細 品號開視窗   -->  


