<?php 
$origin_num = 0;
if(!@$result){
	echo "<script>alert('當日無刷卡資料，如需直接新增一筆請轉至單筆加班功能或補上刷卡資料');history.go(-1);</script>";
}
//echo "<pre>";var_dump($result);exit;
$what_ever = array_rand($result,1);
$arrDate=explode("/",$tf002);$tf003=date("w",mktime(0,0,0,$arrDate[1],$arrDate[2],$arrDate[0]));//判斷平日六日假日
foreach($result as $key => $val){
	if(@$val->add_time){
		$temp = 0;
		foreach($val->add_time as $k => $v){
			$hr = substr($v,0,2);$mn = substr($v,2,2);
			if($mn>30) $mn = '30';if($mn<30) $mn = '00';  //寧少勿多
			if(@$val->mo003 && $hr<substr($val->mo003,0,2)){
				$result[$key]->overtime1o = $hr.$mn;$result[$key]->overtime1c = $val->mo003;//記得加入時數計算
				$result[$key]->overtime1 = substr($val->mo003,0,2)-$hr+((substr($val->mo003,2,2))-$mn)/60;
			}
			if(@$val->mo004 && $hr>substr($val->mo004,0,2)){
				$result[$key]->overtime2o = $val->mo004;$result[$key]->overtime2c = $hr.$mn;
				$result[$key]->overtime2 = $hr-substr($val->mo004,0,2)+($mn-substr($val->mo004,2,2))/60;
			}
		}
	}else{
		$result[$key]->overtime1o = "";$result[$key]->overtime1c = "";
		$result[$key]->overtime2o = "";$result[$key]->overtime2c = "";
	}
	$result[$key]->overtime_tol = 0;
	if(!@$result[$key]->overtime1o){$result[$key]->overtime1o = "";$result[$key]->overtime1c = "";$result[$key]->overtime1=0;}else{$result[$key]->overtime_tol+=$result[$key]->overtime1;}
	if(!@$result[$key]->overtime2o){$result[$key]->overtime2o = "";$result[$key]->overtime2c = "";$result[$key]->overtime2=0;}else{$result[$key]->overtime_tol+=$result[$key]->overtime2;}
	if($tf003!=6 && $tf003!=0 && !$holiday){
		if($result[$key]->overtime_tol>2){
			$result[$key]->two_hr1 = 2;$result[$key]->two_hr2 = $result[$key]->overtime_tol-2;
		}else{
			$result[$key]->two_hr1 = $result[$key]->overtime_tol;$result[$key]->two_hr2 = 0;
		}
	}
	else{
		if($result[$key]->overtime_tol>2){
			$result[$key]->eight_hr1 = 2;$result[$key]->eight_hr2 = $result[$key]->overtime_tol-2;
		}else{
			$result[$key]->eight_hr1 = $result[$key]->overtime_tol;$result[$key]->eight_hr2 = 0;
		}
	}
}
//echo "<pre>";var_dump($result);exit; ?>
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

<div id="content">  <!-- div-3 -->
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 加班單建立作業 - 新增　　部門:<?php echo $result[$what_ever]->me002?>　日期:<?php echo $tf002?>　星期 <?php echo $tf003;?></h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pal/pali55/addsave" >	
	<!-- <div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Y/m/d");	  
	?>
<!--hidden data--><input id="tf002" name="tf002" value="<?php echo $tf002?>" style="display:none;" /><input id="tf003" name="tf003" value="<?php echo date("w",mktime(0,0,0,$arrDate[1],$arrDate[2],$arrDate[0]));?>" style="display:none;" />
	
	<table class="form14 overlist">   <!-- 表格 -->
	<tr>
		<td class='start14' style="width:6%">員工編號</td>
		<td class='start14' style="width:6%">員工姓名</td>
		<td class='start14' style="width:12%">加班時分1　　 加班時數1</td>
		<td class='start14' style="width:12%">加班時分2　　 加班時數2</td>
		<td class='start14' style="width:6%">總時數</td>
		<td class='start14' style="width:15%">備註(刷卡時間)</td><td class='start14' style="width:12%">
		<?php 
		if($tf003 == 6){?>六加班2小時內　六加班2小時外<?php }else if($tf003 == 0 || $holiday){?>日加班2小時內　日加班2小時外<?php }else{?>平時加班2小時內　平時加班2小時外<?php }
		?></td>
		<td class='start14' style="width:6%">確認</td>
	</tr>
	<?php foreach($result as $key => $val){ $origin_num++; ?>
		<tr id='overtime_line_<?php echo $origin_num;?>' class='overtime_line' >
<!--員工編號--><td class='start14'><input tabIndex='3' id='tf001_<?php echo $origin_num;?>' class='ipt_tf001' onKeyPress='keyFunction()' type='text' name='tf001[]' value='<?php echo $val->tf001?>' size='7' readonly='readonly' /></td>
<!--員工姓名--><td class='start14'><input tabIndex='3' id='tf001_disp_<?php echo $origin_num;?>' class='ipt_tf001_disp' onKeyPress='keyFunction()' type='text' name='tf001_disp[]' value='<?php echo $val->mv002?>' size='10' readonly='readonly' /></td>
<!--加班1起訖--><td class='start14'><input tabIndex='3' id='tf004_<?php echo $origin_num;?>' class='ipt_add1' onKeyPress='keyFunction()' type='text' name='tf004[]' value='<?php echo $val->tf004?>' size='4' maxlength="4" readonly='readonly' />~
					<input tabIndex='3' id='tf005_<?php echo $origin_num;?>' class='ipt_add1' onKeyPress='keyFunction()' type='text' name='tf005[]' value='<?php echo $val->tf005?>' size='4' maxlength="4" readonly='readonly' />　
					<input tabIndex='3' id='tf006_<?php echo $origin_num;?>' class='ipt_total1' onKeyPress='keyFunction()' type='text' name='tf006[]' value='<?php echo $val->tf006?>' size='4' readonly='readonly' />小時</td>
<!--加班2起訖--><td class='start14'><input tabIndex='3' id='tf007_<?php echo $origin_num;?>' class='ipt_add2' onKeyPress='keyFunction()' type='text' name='tf007[]' value='<?php echo $val->tf007?>' size='4' maxlength="4" readonly='readonly' />~
					<input tabIndex='3' id='tf008_<?php echo $origin_num;?>' class='ipt_add2' onKeyPress='keyFunction()' type='text' name='tf008[]' value='<?php echo $val->tf008?>' size='4' maxlength="4" readonly='readonly' />　
					<input tabIndex='3' id='tf009_<?php echo $origin_num;?>' class='ipt_total2' onKeyPress='keyFunction()' type='text' name='tf009[]' value='<?php echo $val->tf009?>' size='4' readonly='readonly' />小時</td>
<!--總時數--><td class='start14'><input tabIndex='3' id='tf069_<?php echo $origin_num;?>' class='ipt_total' onKeyPress='keyFunction()' type='text' name='tf069[]' value='<?php echo $val->tf006+$val->tf009?>' size='4' readonly='readonly' />小時</td>
<!--備註--><td class='start14'><?php echo $val->tf016;?> </td>
		<input id="str_time_<?php echo $origin_num;?>" value="<?php echo $val->mo003 ?>" style="display:none;" /><input id="end_time_<?php echo $origin_num;?>" value="<?php echo $val->mo004 ?>" style="display:none;" />
		<td class='start14'><?php 
		if($tf003 == 6){?><input id='tf012_<?php echo $origin_num;?>' name="tf012[<?php echo $origin_num-1;?>]" value="<?php echo $val->tf012 ?>" size='4' readonly='readonly' />小時　　　　　<input id='tf013_<?php echo $origin_num;?>' name="tf013[<?php echo $origin_num-1;?>]" value="<?php echo $val->tf013 ?>" size='4' readonly='readonly' />小時
		<?php }else if($tf003 == 7 || $holiday){?><input id='tf014_<?php echo $origin_num;?>' name="tf014[<?php echo $origin_num-1;?>]" value="<?php echo $val->tf014 ?>" size='4' />小時　　　　　<input id='tf015_<?php echo $origin_num;?>' name="tf015[<?php echo $origin_num-1;?>]" value="<?php echo $val->tf015 ?>" size='4' readonly='readonly' />小時
		<?php }else{?><input id='tf010_<?php echo $origin_num;?>' name="tf010[<?php echo $origin_num-1;?>]" value="<?php echo $val->tf010 ?>" size='4' readonly='readonly' />小時　　　　　<input id='tf011_<?php echo $origin_num;?>' name="tf011[<?php echo $origin_num-1;?>]" value="<?php echo $val->tf011 ?>" size='4' readonly='readonly' />小時<?php }
		?></td>
<!--確認--><td class='normal14'>
		<input type="checkbox" name="tf017[<?php echo $origin_num-1;?>]" value="Y" disabled='disabled' <?php if($val->tf017=="Y") echo "checked=checked"?>></td>
		</tr>
	<?php }?><!---->
    </table>
	      
	<div class="buttons">
	<!--<button tabIndex="8" type='submit' accesskey="s"   name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;-->
	<a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali55/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> 
	  
    </form>
   </div> <!-- div-6 --> 
    </div> <!-- div-5 -->	
</div> <!-- div-4 -->

  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div>  <!-- div-3 -->
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
 <?php //include("./application/views/fun/pali55_funjs_v.php"); ?> 