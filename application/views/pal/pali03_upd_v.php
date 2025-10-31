<?php
$origin_num = 0;
if(!@$result[0]->ms001){
	echo "<script>alert('無資料');history.go(-1);</script>";
}
?>
<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
    </div>

<div id="content"> <!-- div-3 --> 
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 國定假日建立作業 - 修改  年份：<?php echo $result[0]->ms001?>年</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali03/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<table class="form14 holilist">   <!-- 表格 -->
	<?php foreach($result as $key => $val){ $origin_num++; ?>
		<tr id='holiday_line_<?php echo $origin_num;?>' class='holiday_line' >
		<td class='start14' style="width:120px;">年份：</td>
		<td class='normal14'><input tabIndex='3' id='ms001_<?php echo $origin_num;?>' type='text' class='ipt_ms001' onKeyPress='keyFunction()' type='text' name='ms001[]' value='<?php echo $result[0]->ms001?>' size='20' readonly='readonly' /></td>
		<td class='start14' style="width:120px;">國定假日名稱：</td>
		<td class='normal14' style="width:150px;"><input tabIndex='3' id='ms003_<?php echo $origin_num;?>' type='text' class='ipt_ms003' onKeyPress='keyFunction()' name='ms003[]' value='<?php echo $val->ms003?>' size='20' /></td>
		<td class='start14' style="width:120px;">日期：</td>
		<td class='normal14' style="width:150px;"><input style="display:none;" id='ms002_<?php echo $origin_num;?>' type='text' class='ipt_ms002' name='ms002[]' value='<?php echo $val->ms002?>' /><?php if(strlen($val->ms002)==4){echo substr($val->ms002,0,2)."/".substr($val->ms002,2,2);} ?></td>
		<td class='normal14' style="width:150px;"><input type="button" onclick="del_holiday(<?php echo $origin_num;?>);" value="刪除"/></td>
		<td class='normal14'></td>
		</tr>
	<?php }?> 
    </table>
	<table class="form14">   <!-- 表格 -->
	  <tr>
	    <td class="normal14"><a accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='add' name='add' href="javascript:add_holiday();" class="button" ><span>新增假日</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a></td>
	    <td class="normal14"></td>
	    <td class="normal14"></td>
	  </tr>
    </table>
	    <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="s" name='submit' class="button"   target="_new" value='&nbsp;儲存Alt&nbsp;'><span>儲存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	      <a accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('pal/pali03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div>
</div> <!-- div-3 -->
    <?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-2 -->
  </div> <!-- div-1 -->
</div> <!-- div-0 -->
 <?php //include("./application/views/fun/pali03_funjs_v.php"); ?>
 
<script>
$(document).ready(function(){
});

var current_line = <?php echo $origin_num+1;?>;
function add_holiday(){
	var line = 
	"<tr id='holiday_line_"+current_line+"' class='holiday_line' >"+
	"<td class='start14'>年份：</td>"+
	"<td class='normal14'><input tabIndex='3' id='ms001_"+current_line+"' type='text' class='ipt_ms001' onKeyPress='keyFunction()' type='text' name='ms001[]' value='<?php echo $result[0]->ms001?>' size='20' readonly='readonly' /></td>"+
	"<td class='start14'>國定假日名稱：</td>"+
	"<td class='normal14'><input tabIndex='3' id='ms003_"+current_line+"' type='text' class='ipt_ms003' onKeyPress='keyFunction()' type='text' name='ms003[]' value='' size='20' /></td>"+
	"<td class='start14'>日期：</td>"+
	"<td class='normal14'><input tabIndex='3' id='ms002_"+current_line+"' type='text' class='ipt_ms002' onKeyPress='keyFunction()' type='text' name='ms002[]' value='' size='20' onchange='dateformat_md(this);' /></td>"+
	"<td class='normal14' style='width:150px;'><input type='button' onclick='del_holiday("+current_line+");' value='刪除'/></td>"+
	"</tr>";
	$('.form14.holilist').append(line);
	current_line ++;
}
function del_holiday(no){
	if(confirm('確定是否刪除?')){
		$.ajax({
		  method: "POST",
		  url: "<?php echo base_url()?>index.php/pal/pali03/del_ajax",
		  data: {
			  ms001 : <?php echo $result[0]->ms001;?>,
			  ms002 : $('#ms002_'+no).val()
		  }
		})
		  .done(function( msg ) {
			alert( $('#ms003_'+no).val()+" "+$('#ms002_'+no).val() + msg );
			$('#holiday_line_'+no).remove();
		});
	}
}
function dateformat_md(oInput){
	temp = oInput.value.replace(/[^0-9]/g,"");
	if(temp.length==2){
		first = "0"+temp.substring(0,1);
		mid = "0"+temp.substring(1,2);
	}else if(temp.length==3){
		if(temp.substring(0,2)<=12){
			first = temp.substring(0,2);
			mid = "0"+temp.substring(2,3);
		}else{
			first = "0"+temp.substring(0,1);
			mid = temp.substring(1,3);
		}
	}else{
		if(temp.substring(0,2)){first = temp.substring(0,2);}
		if(temp.substring(2,4)){mid = temp.substring(2,4);}
	}
	oInput.value=first+'/'+mid;
}
</script>