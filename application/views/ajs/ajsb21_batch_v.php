<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 還原分錄底稿作業 - 產生　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#td001c').focus();" type='submit' onclick="return doit();"  tabIndex="98" accesskey="c" name='submit'  class="button"   target="_new" value='&nbsp;計 算F8&nbsp;'><span>計 算Alt+c</span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></button>&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/161'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
	    
	</div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ajs/ajsb21/batcha"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-應付憑單自動結帳</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $td001c=$this->input->post('td001c');
	  $td002c=$this->input->post('td002c');
	//  if(!isset($td002c)) { $td002c=date("Y/m/d"); } else {$td002c=$this->input->post('td002c');}
	  $td003c=$this->input->post('td003c');
	  $td004c=$this->input->post('td004c');
	  $td005c=$this->input->post('td005c');
	  $td006c=$this->input->post('td006c');
	  
	   if(!isset($dateo)) { $dateo=''; }
	  if(!isset($datec)) { $datec=''; }
  	 $cmsi09disp=$this->input->post('cmsi09disp');
	   $cmsi09=$this->input->post('cmsi09');
	   
	  $invq02a=$this->input->post('invq02a');
	  $invq02adisp=$this->input->post('invq02a');
	  $invq02a1=$this->input->post('invq02a1');
	   $invq02a1disp=$this->input->post('invq02a1');
	   $tc001=$this->input->post('tc001');
	   $tc001disp=$this->input->post('tc001disp');
	
	?>
       
	<table class="form14">   <!-- 表格 -->
	     <tr>
	    <td class="start14a" width="10%" >單據性質：</td>
        <td class="normal14a" width="90%"><input type="radio" name="td004c" <?php if (isset($td004c) && $td004c=="1") echo "checked";?> value="1" />付款單 &nbsp;&nbsp;&nbsp; 
               <input type="radio" name="td004c" <?php if (isset($td004c) && $td004c=="2") echo "checked";?> value="2" />收款單
        </td>
		</tr> 
		<tr>
	    <td class="start14a"  >底稿批號：</td>
        <td class="normal14a" ><input tabIndex="3" id="td001c"    onKeyPress="keyFunction()"    type="text" name="td001c"  value="<?php echo $td001c; ?>"  size="16"  />
		</td></tr> 
       <tr>
	    <td class="start14a"  >底稿序號：</td>
        <td class="normal14a" ><input tabIndex="1" id="td002c"   onKeyPress="keyFunction()"    type="text" name="td002c"  value="<?php echo $td002c; ?>"    /></td>
	  </tr> 
	<!--  <tr>
	    <td class="start14a" width="10%" >底稿批號：</td>
        <td class="normal14a" width="90%"><input tabIndex="3" id="td001c"    onKeyPress="keyFunction()"    type="text" name="td001c"  value="<?php echo $td001c; ?>"  size="16"  />
		</td></tr> 
       <tr>
	    <td class="start14a"  >起底稿序號：</td>
        <td class="normal14a" ><input tabIndex="1" id="td002c"   onKeyPress="keyFunction()"    type="text" name="td002c"  value="<?php echo $td002c; ?>"    /></td>
	  </tr> 
	    <tr>
	    <td class="start14a"  >迄底稿序號：</td>
        <td class="normal14a" ><input tabIndex="1" id="td003c"   onKeyPress="keyFunction()"    type="text" name="td003c"  value="<?php echo $td003c; ?>"    /></td>
	  </tr> 	  
	  <tr>
	    <td class="start14a" >起產生日期：</td>
	    <td class="normal14a" ><input tabIndex="1" id="dateo" ondblclick="scwShow(this,event);" onChange="dateformat_ymd(this);" onKeyPress="keyFunction()" type="text" name="dateo"  value="<?php echo $dateo; ?>"  size="20" style="background-color:#E7EFEF" />
         <img  onclick="scwShow(dateo,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
	  <tr>
	    <td class="start14a" >迄產生日期：</td>
	    <td class="normal14a"><input tabIndex="1" id="datec" ondblclick="scwShow(this,event);" onChange="dateformat_ymd(this);" onKeyPress="keyFunction()" type="text" name="datec"  value="<?php echo $datec; ?>"  size="20" style="background-color:#E7EFEF" />
        <img  onclick="scwShow(datec,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
	    <tr>
	    <td class="start14a"  >產生人員：</td>
        <td class="normal14a" ><input type="text" tabIndex="16" id="cmsi09" class="cmsi09" onKeyPress="keyFunction()" name="cmsi09" onchange="check_cmsi09(this)" value="<?php echo $cmsi09; ?>"  size="10"    />
		<img id="Showcmsi09disp" src="<?php echo base_url()?>assets/image/png/plan.png" alt="" align="top"/></a>		
	     <span id="cmsi09disp"> <?php   echo $cmsi09disp; ?> </span></td>
	  </tr>  -->
	   
    </table>
	    <span style="color:#006600;font-weight:bold;">預估計算進度條</span> <br/>
		<div id="progressbar" style="width:420px;height:25px;border:1px solid #0000FF;"></div><br>
		
	
	    
		<!--<div class="buttons">
	      <button type='submit' onclick="return doit();"  tabIndex="98" accesskey="c" name='submit'  class="button"   target="_new" value='&nbsp;計 算F8&nbsp;'><span>計 算Alt+c</span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/161'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
	    </div>-->
        </form>
		<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php // include_once("./application/views/funnew/asti03_funmjs_v.php"); ?> <!-- 單別 -->
<?php // include_once("./application/views/fun/ajsb21_funjs_v.php"); ?>
<script>
  $(function() {
    $( "#progressbar" ).progressbar({
      value: 1
    });
  });
  </script>
<script language="javascript">
var i=0,t=50;  // 时长
function doit(){
   i = i + 0.01;
   document.getElementById('progressbar').firstChild.style.width = (parseInt(document.getElementById('progressbar').style.width) * i).toFixed(0) + 'px';
   if(i<1) setTimeout(doit, t);
}
doit();
</script>

<script type="text/javascript"> 	
//查詢業務人員開視窗cmsi09 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcmsi09disp").click(function() {
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '75%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFcmsi09'),
		onOverlayClick: clear_cmsi09disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#cmsi09').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#cmsi09').val();
			$('#cmsi09').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup1_cmsi09/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,
                success:      
				function(data){  
					if(data.response =="true"){
						add(data.message);
					}
				}
			});
		},  
		select: function(event, ui) {
			if(ui.item.value!="查無資料"){
				$('#cmsi09').val(ui.item.value1);
				$('#cmsi09disp').text(ui.item.value2);
				//console.log($('#cmsi09a').val());  debug
				return false;
			}else{
				$('#cmsi09disp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#cmsi09').attr('onchange','check_cmsi09(this)');
			check_cmsi09($('#cmsi09').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});
</script>
<script type="text/javascript"> 	
//查詢計劃人員開視窗cmsi09a //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcmsi09adisp").click(function() {
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '75%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFcmsi09a'),
		onOverlayClick: clear_cmsi09disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#cmsi09a').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#cmsi09a').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup1_cmsi09/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,
                success:      
				function(data){  
					if(data.response =="true"){
						add(data.message);
					}
				}
			});
		},  
		select: function(event, ui) {
			if(ui.item.value!="查無資料"){
				$('#cmsi09a').val(ui.item.value1);
				$('#cmsi09adisp').text(ui.item.value2);
				//console.log($('#cmsi09a').val());
				return false;
			}else{
				$('#cmsi09adisp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
//查詢採購人員開視窗cmsi09b //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcmsi09bdisp").click(function() {
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '75%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFcmsi09b'),
		onOverlayClick: clear_cmsi09disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#cmsi09b').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#cmsi09b').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup1_cmsi09/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,
                success:      
				function(data){  
					if(data.response =="true"){
						add(data.message);
					}
				}
			});
		},  
		select: function(event, ui) {
			if(ui.item.value!="查無資料"){
				$('#cmsi09b').val(ui.item.value1);
				$('#cmsi09bdisp').text(ui.item.value2);
				//console.log($('#cmsi09a').val());
				return false;
			}else{
				$('#cmsi09bdisp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});

function addcmsi09disp(smb001,smb002){
	
	$('#cmsi09').val(smb001);
	$('#cmsi09disp').text(smb002);
	$('#cmsi09').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_sql"
	});
}
function addcmsi09adisp(smb001,smb002){
	
	$('#cmsi09a').val(smb001);
	$('#cmsi09adisp').text(smb002);
	$('#cmsi09a').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_sql"
	});
}
function addcmsi09bdisp(smb001,smb002){
	
	$('#cmsi09b').val(smb001);
	$('#cmsi09bdisp').text(smb002);
	$('#cmsi09b').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_sql"
	});
}
function clear_cmsi09disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_cmsi09(row_obj){
	var smb001= $('#cmsi09').val();
	if(!smb001){$('#cmsi09disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup2_cmsi09/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#cmsi09').val("");
					$('#cmsi09disp').text("查無資料");
				}
				$('#cmsi09').val(smb001);
				$('#cmsi09disp').text(data.message[0].value2);
			}else{
				$('#cmsi09').val(smb001);
				$('#cmsi09disp').text("查無資料");
			}
		}
	});
}
//不更新網頁 輸入直接跳出中文
function check_cmsi09a(row_obj){
	var smb001= $('#cmsi09a').val();
	if(!smb001){$('#cmsi09adisp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup2_cmsi09/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#cmsi09a').val("");
					$('#cmsi09adisp').text("查無資料");
				}
				$('#cmsi09a').val(smb001);
				$('#cmsi09adisp').text(data.message[0].value2);
			}else{
				$('#cmsi09a').val(smb001);
				$('#cmsi09adisp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFcmsi09" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi09/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<div id="divFcmsi09a" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi09/displaya_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<div id="divFcmsi09b" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi09/displayb_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>


