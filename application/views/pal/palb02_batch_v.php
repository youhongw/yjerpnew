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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 特休與年資計算作業 - 計算</h1>
    </div>
	
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/palb02/batcha"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-應付憑單自動結帳</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	
	  if (!isset($dateym)) { $dateym=date("Y/m");}
	
	?>
       
	<table class="form14">   <!-- 表格 -->
	  <tr>
	    <td class="start14a"  >計算截止年月：</td>
        <td class="normal14a"  ><input tabIndex="1" id="dateym" name="dateym" onKeyPress="keyFunction()" onchange="dateformat_ym(this);" type="text"  value="<?php echo $dateym; ?>"  size="10"  /></td>
	  </tr>
    </table>
	    <span style="color:#006600;font-weight:bold;">預估計算進度條</span> <br/>
		<div id="progressbar" style="width:420px;height:25px;border:1px solid #0000FF;"></div><br>
		
	<!--	<a onclick="return doit();" class="button"><span>計算&nbsp</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a> -->
	    
		<div class="buttons">
	      <a onclick="submit_ajax();"  tabIndex="98" accesskey="c" class="button"  value='&nbsp;計 算F8&nbsp;'><span>轉 入Alt+c</span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></a>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/111'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
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
<iframe id="ifm_batch" name="ifm_batch" src="" width="100px" height="100px" frameborder="0" scrolling="no" ></iframe>
<?php include("./application/views/fun/report_funjs_v.php"); ?> 
<script>
$.ajaxPrefilter(function( options, originalOptions, jqXHR ) {
	//options.async = true;
});
var batching = 0;
var check_times = 0;
  $(function() {
    $( "#progressbar" ).progressbar({
      value: 0
    });
  });
  
$(document).ready(function(){
	/*clear_progress();
	start_check_progress();
	check_progress();*/
});

</script>
<script language="javascript">
function submit_ajax(){
	var dateym = $('#dateym').val();
	//$('#ifm_batch').attr("src","<?php echo base_url()?>index.php/pal/palb02/batch_ajax?dateym="+dateym);
	//window.open("<?php echo base_url()?>index.php/pal/palb02/batch_ajax?ajax=1&dateym="+dateym, "年資特休計算中...", config='toolbar=no,scrollbars=no,resizeable=no,location=no,menubar=no,height=50,width=300');
	if(batching==0){
		//clear_progress();
		//start_check_progress();
		batching = 1;
		block();
		$.ajax({
			method: "POST",
			dataType:"json",
			url: "<?php echo base_url()?>index.php/pal/palb02/batch_ajax",
			data: {
			  dateym : dateym
			}
		})
		.done(function( msg ) {
			batching = 0;
			alert("計算完成");
			unblock();
			$( "#progressbar" ).progressbar( "value", 100 );
			if(typeof(msg) === "object"){
				console.log(msg);
			}else{
				console.log(msg);
			}
		});
	}else{
		alert("計算中，請稍候。");
	}
	/*setTimeout(clear_progress,5000);
	setTimeout(start_check_progress,5000);
	setTimeout(check_progress,5000);*/
}
/*
function check_progress(){
	check_times++;
	//console.log(check_times);
	$.ajax({
		method: "POST",
		dataType:"json",
		url: "<?php echo base_url()?>index.php/pal/palb02/check_batch_ajax?times="+check_times,
		data: {
			check_times : check_times
		}
	})
	.success(function( percent ) {
		console.log(percent);
		percent = percent*100;
		$( "#progressbar" ).progressbar( "value", percent );
		if(percent == 100){
			//stop_check_progress();
		}
	});
}

function start_check_progress(){
	interval = setInterval(check_progress, "1000");
}

function stop_check_progress(){
	console.log("停");
	check_times = 0;
	clearTimeout(interval);
}

function clear_progress(){
	$( "#progressbar" ).progressbar( "value", 0 );
}
*/
function block(msg){
	if(!msg){msg = "資料計算中，請稍後......";}
	$.blockUI({ 
		message: msg,
		css: {
			border: 'none',
			padding: '15px',
			backgroundColor: '#000',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			opacity: .5,
			color: '#fff'
		} 
	});
}
function unblock(){
	$.unblockUI();
}

//function show_process
</script>
