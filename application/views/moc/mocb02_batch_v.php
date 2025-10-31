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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 自動領料作業 - 產生　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#td001c').focus();" type='submit' onclick="return doit();"  tabIndex="98" accesskey="c" name='submit'  class="button"   target="_new" value='&nbsp;計 算F8&nbsp;'><span>計 算Alt+c</span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></button>&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/108'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
	    
	</div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/moc/mocb02/batcha"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-應付憑單自動結帳</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $td001c=$this->input->post('td001c');
	  $td002c=$this->input->post('td002c');
	  $td003c=$this->input->post('td003c');
	  if(!isset($td004c)) { $td004c=date("Y/m/d"); } else {$td004c=$this->input->post('td004c');}
	  if(!isset($td005c)) { $td005c=date("Y/m/d"); } else {$td005c=$this->input->post('td005c');}
	  $td006c=$this->input->post('td006c');
	  $td007c=$this->input->post('td007c');
	  $td008c=$this->input->post('td008c');
	  $td009c=$this->input->post('td009c');
	  
	   $tc005disp=$this->input->post('tc005disp');
	  $cmsq03a=$this->input->post('cmsq03a');
	   $cmsq03adisp=$this->input->post('cmsq03a');
	   $cmsq05a=$this->input->post('cmsq05a');
	   $cmsq05adisp=$this->input->post('cmsq05a');
	  $invq02a=$this->input->post('invq02a');
	  $invq02adisp=$this->input->post('invq02a');
	  $invq02a1=$this->input->post('invq02a1');
	   $invq02a1disp=$this->input->post('invq02a1');
	$purq04a31=$this->input->post('purq04a31');
	   $purq04a31disp=$this->input->post('purq04a31');
	   $tc001=$this->input->post('tc001');
	   $tc001disp=$this->input->post('tc001disp');
	?>
       
	<table class="form14">   <!-- 表格 -->
	   <tr>
	    <td class="normal14y"  width="10%">起始單號：</td>
        <td class="normal14a" width="90%"><input tabIndex="3" id="td001c"    onKeyPress="keyFunction()"   name="td001c" value="<?php echo $td001c; ?>"  type="text" />
		 </td>
	  </tr> 
	   <tr>
	    <td class="normal14z"  >截止單號：</td>
        <td class="normal14a" ><input tabIndex="3" id="td002c"    onKeyPress="keyFunction()"   name="td002c" value="<?php echo $td002c; ?>"  type="text" />
		 </td>
	  </tr> 
	  <tr>
	    <td class="normal14z"  >領/退料單別：</td>
        <td class="normal14a" ><input tabIndex="1" id="tc001" name="tc001" value="" size="12" onKeyPress="keyFunction()" onChange="check_tc001(this);check_title_no();" type="text" required />
				<a href="javascript:;"><img id="Showtc001disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
				<span id="tc001disp"></span>
			</td>
	  </tr> 
	   <tr>
	    <td class="normal14z"  >起始日期：</td>
        <td class="normal14a" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="td004c" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tc039"  value="<?php echo $td004c; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(td004c,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>  
	   <tr>
	    <td class="normal14z"  >截止日期：</td>
        <td class="normal14a" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="td005c" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tc039"  value="<?php echo $td005c; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(td005c,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr> 	  
	    <tr>
	    <td class="normal14z" >庫別：</td>
        <td class="normal14a" ><input tabIndex="3" id="td006c"    onKeyPress="keyFunction()"  onchange="startcmsq03a(this)"  name="cmsq03a" value="<?php echo $cmsq03a; ?>"  type="text" required /><a href="javascript:;"><img id="Showcmsq03a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="cmsq03adisp"> <?php    echo $cmsq03adisp; ?> </span></td>
	  </tr>  
	   
	    <tr>
	    <td class="normal14z"  >選擇自動領料：</td>
        <td class="normal14a"   >
		  <select tabIndex="27" id="td008c" onKeyPress="keyFunction()" name="td008c" >                                                                      
		    <option <?php if($td008c == '1') echo 'selected="selected"';?> value='1'>生產入庫單 </option>
            <option <?php if($td008c == '2') echo 'selected="selected"';?> value='2'>託外進貨單 </option>
            <option <?php if($td008c == '3') echo 'selected="selected"';?> value='3'>託外退貨單</option>
		  </select>
		</td>
	  </tr> 
	   <tr>
	    <td class="normal14z"  >領料碼：</td>
        <td class="normal14a"   >
		  <select tabIndex="27" id="td009c" onKeyPress="keyFunction()" name="td009c" >
		    <option <?php if($td009c == '1') echo 'selected="selected"';?> value='1'>自動扣料 </option>
            <option <?php if($td009c == '2') echo 'selected="selected"';?> value='2'>單獨領料 </option>
		  </select>
		</td>
	  </tr> 
    </table>
	    <span style="color:#006600;font-weight:bold;">預估計算進度條</span> <br/>
		<div id="progressbar" style="width:420px;height:25px;border:1px solid #0000FF;"></div><br>
		
	<!--	<a onclick="return doit();" class="button"><span>計算&nbsp</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a> -->
	    
		<!--<div class="buttons">
	      <button type='submit' onclick="return doit();"  tabIndex="98" accesskey="c" name='submit'  class="button"   target="_new" value='&nbsp;計 算F8&nbsp;'><span>計 算Alt+c</span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/108'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
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
<?php include_once("./application/views/fun/mocb02_funjs_v.php"); ?>
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
<script>
//查詢單別視窗
$(document).ready(function(){
	$("#Showtc001disp").click(function() {
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '70%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFpuri04'),
		onOverlayClick: clear_tc001disp_sql
	});
	});
    $('#tc001').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#tc001').val();
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/moc/moci03/lookup_puri04/'+encodeURIComponent(smb001), 
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
				$('#tc001').val(ui.item.value1);
				$('#tc001disp').text(ui.item.value2);
				return false;
			}else{
				$('#tc001disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addtc001disp(mb001,mb002){
	$('#tc001').val(mb001);
	$('#tc001disp').text(mb002);
	check_title_no();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri04/clear_sql"
	});
}
function clear_tc001disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri04/clear_sql"
	});
}
function check_tc001(row_obj){
	var smb001= $('#tc001').val();
	if(!smb001){$('#tc001disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/moc/moci03/lookup_puri04/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#tc001').val("");
					$('#tc001disp').text("查無資料");
				}
				$('#tc001').val(data.message[0].value1);
				$('#tc001disp').text(data.message[0].value2);
				check_title_no();
			}else{
				$('#tc001').val("");
				$('#tc001disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFpuri04" style="display:none;width:100%;height:100%;">
<iframe src="<?php echo base_url()?>index.php/pur/puri04/display_child/0/or_where?key=mq001,mq001&val=54,55" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>
