 <div id="container">   <!-- div-1 -->
  <div id="header">     <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	   </div>
    </div>

<div id="content">   <!-- div-3 -->
 <div class="box">   <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 保費費率設定檔 - -修改</h1>
    </div>
	
    <div class="content">  <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali05/updsave" method="post" enctype="multipart/form-data" >
	 <!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general">   <!-- div-tab -->
	<?php
    date_default_timezone_set("Asia/Taipei");
	?>
	
	<?php foreach($results as $row ) : ?>
          <?php   $mr001c[]=$row->mr001;?>
          <?php   $mr002c[]=$row->mr002;?>
          <?php   $mr003c[]=$row->mr003;?>
          <?php   $mr004c[]=$row->mr004;?>
          <?php   $mr005c[]=$row->mr005;?>
          <?php   $mr006c[]=$row->mr006;?>

		  <?php   $mr011c[]=$row->mr011;?>
		  <?php   $mr012c[]=$row->mr012;?>
		  <?php   $mr013c[]=$row->mr013;?>
		  <?php   $mr014c[]=$row->mr014;?>
		  <?php   $mr015c[]=$row->mr015;?>
		  <?php   $mr016c[]=$row->mr016;?>

		  <?php   $mr021c[]=$row->mr021;?>

		  <?php   $companyc[]=$row->company;?>
		  <?php   $creatorc[]=$row->creator;?>
		  <?php   $usr_groupc[]=$row->usr_group;?>
		  <?php   $create_datec[]=$row->create_date;?>
		  <?php   $modifierc[]=$row->modifier;?>
		  <?php   $modi_datec[]=$row->modi_date;?>
          <?php   $flagc[]=$row->flag;?>	  
	 <?php endforeach;?>
	 
	 <?php $mr001=$mr001c[0];?>
	 <?php $mr002=$mr002c[0];?>
	 <?php $mr003=$mr003c[0];?>
	 <?php $mr004=$mr004c[0];?>
	 <?php $mr005=$mr005c[0];?>
	 <?php $mr006=$mr006c[0];?>

	 <?php $mr011=$mr011c[0];?>
	 <?php $mr012=$mr012c[0];?>
	 <?php $mr013=$mr013c[0];?>
	 <?php $mr014=$mr014c[0];?>
	 <?php $mr015=$mr015c[0];?>
	 
	 <?php $mr021=$mr021c[0];?>
	 <?php $modifier=$modifierc[0];?>
	 <?php $modi_date=substr($modi_datec[0],0,4).'/'.substr($modi_datec[0],4,2).'/'.substr($modi_datec[0],6,2);?>
       
	<div class="abgne_tab"> <!-- div-7 -->
		<ul class="tabs">
		    <li><a href="#tab1">勞保設定</a></li>
			<li><a href="#tab2">健保設定</a></li>
			<li><a href="#tab3">勞退設定</a></li>
	    </ul>

    <div class="tab_container"> <!-- div-8 -->
	<!--  基本參數 -->
	<div id="tab1" class="tab_content">
	<table class="form14">     <!-- 表格 -->
	<tr>
	    <td class="normal14a" width="15%">勞保費率：</td>
		<td class="normal14a" width="8%">
			<input id="mr001" name="mr001" value="<?php echo $mr001; ?>" tabIndex="1" onKeyPress="keyFunction();" type="text" size ="4" />%
		</td>
		<td class="normal14a" width="15%">就業保費：</td>
        <td class="normal14a" width="8%">
			<input id="mr002" name="mr002" value="<?php echo $mr002; ?>" tabIndex="2" onKeyPress="keyFunction();" type="text" size ="4" />%
		</td>
		<td class="normal14a" width="15%">公司負擔職災：</td>
        <td class="normal14a" width="8%">
			<input id="mr003" name="mr003" value="<?php echo $mr003; ?>" tabIndex="3" onKeyPress="keyFunction();" type="text" size ="4" />%
		</td>
        <td class="normal14a"></td>
	</tr>
	<tr>
	    <td class="normal14a" width="15%">墊　　償：</td>
		<td class="normal14a" width="8%">
			<input id="mr004" name="mr004" value="<?php echo $mr004; ?>" tabIndex="4" onKeyPress="keyFunction();" type="text" size ="4" />%
		</td>
		<td class="normal14a" width="15%">雇主負擔：</td>
        <td class="normal14a" width="8%">
			<input id="mr005" name="mr005" value="<?php echo $mr005; ?>" tabIndex="5" onKeyPress="keyFunction();" type="text" size ="4" />%
		</td>
		<td class="normal14a" width="15%">勞工自負：</td>
        <td class="normal14a" width="8%">
			<input id="mr006" name="mr006" value="<?php echo $mr006; ?>" tabIndex="6" onKeyPress="keyFunction();" type="text" size ="4" />%
		</td>
        <td class="normal14a"></td>
	</tr>
	</table>
	</div>
	<!--  進銷存參數 -->
    <div id="tab2" class="tab_content">
	<table class="form14">     <!-- 表格 -->
	<tr>
	    <td class="normal14a" width="15%">健保費率：</td>
		<td class="normal14a" width="8%">
			<input id="mr011" name="mr011" value="<?php echo $mr011; ?>" tabIndex="11" onKeyPress="keyFunction();" type="text" size ="4" />%
		</td>
	    <td class="normal14a" width="15%">平均眷口數：</td>
		<td class="normal14a" width="8%">
			<input id="mr012" name="mr012" value="<?php echo $mr012; ?>" tabIndex="12" onKeyPress="keyFunction();" type="text" size ="4" />
		</td>
        <td class="normal14a"></td>
	</tr>
	<tr>
	    <td class="normal14a" width="15%">負擔比率(自)：</td>
		<td class="normal14a" width="8%">
			<input id="mr013" name="mr013" value="<?php echo $mr013; ?>" tabIndex="13" onKeyPress="keyFunction();" type="text" size ="4" />%
		</td>
	    <td class="normal14a" width="15%">投保單位：</td>
		<td class="normal14a" width="8%">
			<input id="mr014" name="mr014" value="<?php echo $mr014; ?>" tabIndex="14" onKeyPress="keyFunction();" type="text" size ="4" />%
		</td>
		<td class="normal14a" width="15%">政府輔助：</td>
        <td class="normal14a" width="8%">
			<input id="mr015" name="mr015" value="<?php echo $mr015; ?>" tabIndex="15" onKeyPress="keyFunction();" type="text" size ="4" />%
		</td>
        <td class="normal14a"></td>
	</tr>	
	</table>
	</div>
	<!-- 財務參數 -->
     <div id="tab3" class="tab_content">
	 <table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a" width="15%">退休金費率：</td>
		<td class="normal14a" width="8%">
			<input id="mr021" name="mr021" value="<?php echo $mr021; ?>" tabIndex="21" onKeyPress="keyFunction();" type="text" size ="4" />%
		</td>
        <td class="normal14a"></td>
	 </tr>
	</table>
	</div>
	</div><!-- div- 可儲存顯示 -->
		<input type="hidden" class="commpany" name="company" value="" />
	<div class="buttons">
	    <button tabIndex="88" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a tabIndex="89" id='cancel' name='cancel' href="<?php echo site_url('main/index/101'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
		<a tabIndex="90" id='auto_update' name='auto_update' onclick="if(confirm('確定進行計算?')){auto_update_ajax();}" class="button" ><span>自動更新保費&nbsp;F9&nbsp;</span><img height="12px" src="<?php echo base_url()?>assets/image/png/cal.png" /></a>
	</div>
	   
    </form>
    </div>    <!-- div-tab -->
  </div>      <!-- div-5 -->
 </div>        <!-- div-4 -->
 
 
    <?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>

</div>   <!-- div-3 -->
  </div>     <!-- div-2 -->
</div>       <!-- div-1 -->
<script>
$.ajaxPrefilter(function( options, originalOptions, jqXHR ) {
	//options.async = true;
});
var batching = 0;
var check_times = 0;
</script>
<script language="javascript">
function auto_update_ajax(){
	var dateym = <?php echo date("Ymd")?>;
	if(batching==0){
		batching = 1;
		block();
		$.ajax({
			method: "POST",
			dataType:"json",
			url: "<?php echo base_url()?>index.php/pal/pali05/auto_update_ajax"
		})
		.done(function( msg ) {
			batching = 0;
			unblock();
			if(typeof(msg) === "object"){
				alert("計算成功!加保主檔更動:"+msg['palti_count']+"筆 加保紀錄新增/修改:"+msg['palml_count']+"筆"+" 原始主檔筆數:"+msg['total_count']);
				console.log(msg);
			}else{
				alert("計算有問題，請聯絡工程師。");
				console.log(msg);
			}
		});
	}else{
		alert("計算中，請稍候。");
	}
}
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
<?php include("./application/views/fun/cmsi01_funjs_v.php"); ?>