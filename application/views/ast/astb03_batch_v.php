<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
    </div>
	
<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 自動攤提折舊作業 - 產生</h1>
    </div>
	
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ast/astb03/batcha"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-應付憑單自動結帳</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $td001c=$this->input->post('td001c');
	  $td002c=$this->input->post('td002c');
	  if(!isset($td002c)) { $td002c=date("Y/m/d"); } else {$td002c=$this->input->post('td002c');}
	  $td003c=$this->input->post('td003c');
	  $td004c=$this->input->post('td004c');
	  $td005c=$this->input->post('td005c');
	  $td006c=$this->input->post('td006c');
	  
	   if(!isset($dateo)) { $dateo=''; }
	  if(!isset($datec)) { $datec=''; }
  	 $cmsq05a=$this->input->post('cmsq05a');
	   $cmsq05adisp=$this->input->post('cmsq05a');
	  $invq02a=$this->input->post('invq02a');
	  $invq02adisp=$this->input->post('invq02a');
	  $invq02a1=$this->input->post('invq02a1');
	   $invq02a1disp=$this->input->post('invq02a1');
	   $tc001=$this->input->post('tc001');
	   $tc001disp=$this->input->post('tc001disp');
	
	?>
       
	<table class="form14">   <!-- 表格 -->
	  <tr>
	    <td class="start14a" width="10%" >折舊年月：</td>
        <td class="normal14a" width="90%"><input tabIndex="3" id="td001c" onchange="dateformat_ym(this)"   onKeyPress="keyFunction()"    type="text" name="td001c"  value="<?php echo $td001c; ?>"  size="16" style="background-color:#E7EFEF" />
		</td></tr> 
       <tr>
	    <td class="start14a"  >起始資產編號：</td>
        <td class="normal14a" ><input tabIndex="1" id="td002c"   onKeyPress="keyFunction()"    type="text" name="td002c"  value="<?php echo $td002c; ?>"    /></td>
	  </tr> 
	    <tr>
	    <td class="start14a"  >截止資產編號：</td>
        <td class="normal14a" ><input tabIndex="1" id="td003c"   onKeyPress="keyFunction()"    type="text" name="td003c"  value="<?php echo $td003c; ?>"    /></td>
	  </tr> 	  
	  
	    <tr>
	    <td class="start14a"  >折舊單別：</td>
        <td class="normal14a" ><input tabIndex="1" id="asti03_asti11" onKeyPress="keyFunction()" onfocus="check_title_no();"  onchange="check_asti03_asti11(this);" name="asti03_asti11" value="<?php echo $tc001; ?>" size="12" type="text" required />
		<a href="javascript:;"><img id="Showasti03_asti11disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
        <span id="asti03_asti11disp"> <?php   echo $tc001disp; ?> </span></td>
	  </tr>  
	   
    </table>
	    <span style="color:#006600;font-weight:bold;">預估計算進度條</span> <br/>
		<div id="progressbar" style="width:420px;height:25px;border:1px solid #0000FF;"></div><br>
		
	<!--	<a onclick="return doit();" class="button"><span>計算&nbsp</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a> -->
	    
		<div class="buttons">
	      <button type='submit' onclick="return doit();"  tabIndex="98" accesskey="c" name='submit'  class="button"   target="_new" value='&nbsp;計 算F8&nbsp;'><span>計 算Alt+c</span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/141'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
	    </div>
        </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php // include_once("./application/views/funnew/asti03_funmjs_v.php"); ?> <!-- 單別 -->
<?php // include_once("./application/views/fun/astb03_funjs_v.php"); ?>
<script type="text/javascript"> 	
//查詢訂單性質開視窗asti03 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showasti03_asti11disp").click(function() {
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
		message: $('#divFasti03_asti11'),
		onOverlayClick: clear_asti03_asti11disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#asti03_asti11').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#asti03_asti11').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/ast/asti03/lookup_catcomplete_asti11/'+encodeURIComponent(smb001), 
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
				$('#asti03_asti11').val(ui.item.value1);
				$('#asti03_asti11disp').text(ui.item.value2);
				//console.log($('#asti03').val(ui.item.value1));
				return false;
			}else{
				$('#asti03_asti11').val("");
				$('#asti03_asti11disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addasti03_asti11disp(smb001,smb002){
	$('#asti03_asti11').val(smb001);
	$('#asti03_asti11disp').text(smb002);
	$('#asti03_asti11').focus();
	//check_asti03(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti03/clear_sql_asti11"
	}); 
}
function clear_asti03_asti11disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti03/clear_sql_asti11"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_asti03_asti11(row_obj){
	var smb001= $('#asti03_asti11').val();
	if(!smb001){$('#asti03_asti11disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti03/lookup_check_asti11/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#asti03_asti11').val("");
					$('#asti03_asti11disp').text("查無資料");
				}else{
					$('#asti03_asti11').val(smb001);
					$('#asti03_asti11disp').text(data.message[0].value2);
				}
			}else{
				$('#asti03_asti11').val("");
				$('#asti03_asti11disp').text("查無資料");
			}
		}
	});
}
   
</script>	   
<div id="divFasti03_asti11" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/ast/asti03/display_child_asti11" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>
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
