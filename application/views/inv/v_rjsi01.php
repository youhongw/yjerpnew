<?php
// defined('BASEPATH') OR exit('No direct script access allowed');
#部門基本資料頁
		
//echo $this->xajax->printJavascript();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">

<head>
 <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 

<table width="100%" cellpadding="0" cellspacing="0" style="text-align:center">
<tr><td height="40">&nbsp;</td></tr>
<tr><td height="50"><h1>人事薪資系統</h1><h2 style="color:#666">-- <?php echo $sub_title?> --</h2></td></tr>
<tr><td height="20">&nbsp;</td></tr>
<tr>
<td align="center">
  <?php include('v_bread.php'); //顯示麵包屑?>
  <br/>
   
  <?php include('prg_access.php'); //顯示使用者的此功能權限?>
  
  <br/>
  <?php include('button.php'); //定義 新增 修改 刪除 列印 轉EXCEL 分頁等按鈕?>
  
  <!--新增的form會被插入至新增按鈕下方-->
  <div id="unadddiv">
  <form method="post" name="addform">
  <div style="width:100%; text-align:right"><a href="javascript:hideaddiv()" class="cls">X CLOSE</a></div>
  <button class="bbt2">1</button> <span style="color:#F03">*</span> 部門代號 : <input type="text" style="width:120px" name="id" tabindex="1"/>
  <br/><br/>
  <button class="bbt2">2</button> <span style="color:#F03">*</span> 部門名稱 : <input type="text" style="width:300px" name="na" tabindex="2"/>
  <input type="hidden" value="1" name="add" /> <!--判斷是否新增資料-->
  <br/><br/>
  <div style="width:100%; text-align:center"><button type="submit" class="fbt1">確定新增</button></div>
  </form>
  </div>
  
  <?php 
  //設定width
  $wd = array('','80','50','150','400','50');
  ?>
  <!-- 浮動DIV，畫面在上方時class=abodiv; 當頁面較長，畫面向下滾動時，此DIV會固定在上方class=fiexdiv -->
  <!-- 呼叫 main.js 中的 window.onscroll 滾動時事件-->
  <div class="reldiv">
  <div class="abodiv" id="maindiv">
  <table width="auto" style="text-align:center" >
  <tr>
    <td class="btd" width="<?php echo $wd[1];?>"><input type="checkbox" onclick="allck()" id="sltall"/> 全 選</td>
    <td class="btd" width="<?php echo $wd[2];?>">項 次</td>
    <td class="btd" width="<?php echo $wd[3];?>">部 門 代 號</td>
    <td class="btd" width="<?php echo $wd[4];?>">部 門 名 稱</td>
    <td class="btd" width="<?php echo $wd[5];?>">刪 除</td>
  </tr>  
  </table>
  </div>
  <!--補空位，並固定各資料欄寬與上方DIV一致-->
  <form name="list_form" id="list_form" onsubmit="return false;">
  <table width="auto" style="text-align:center" class="list_table">
  <tr>
    <td width="<?php echo $wd[1];?>" height="40">&nbsp;</td>
    <td width="<?php echo $wd[2];?>">&nbsp;</td>
    <td width="<?php echo $wd[3];?>">&nbsp;</td>
    <td width="<?php echo $wd[4];?>">&nbsp;</td>
    <td width="<?php echo $wd[5];?>">&nbsp;</td>
  </tr>  
  <?php
  $i = 0;
  $p1 = ($curr_page-1)*$count; //(頁數-1)*顯示筆數 = 第一筆  
  foreach($data2 as $row)
  {
	  $i++;
	  $p1++;
	  
	  if ($i%2 == 1) echo '<tr>';
	  else echo '<tr class="trbg">';
	  
	  echo '<td height="25" width="'.$wd[1].'"><input type="checkbox" id="ckbt'.$i.'" name="ckbt'.$i.'" value="'.$row['MA001'].'"/></td>';
	  
	  echo '<td width="'.$wd[2].'">'.$p1.'</td>';
	  
	  echo '<td width="'.$wd[3].'"><input type="text" value="'.$row['MA001'].'" style="width:90%" id="dep_id'.$i.'" onkeyup="chgit('.$i.')" ';
	  if ($UPD != 'Y') echo 'disabled="disabled"';
	  echo '/>
	  <input type="hidden" value="'.$row['MA001'].'" id="dep_oid'.$i.'"/></td>'; //oid --> 當ID重複時可回復至原本的ID
		   
	  echo '<td width="'.$wd[4].'"><input type="text" value="'.$row['MA002'].'" style="width:90%" id="dep_na'.$i.'" onkeyup="chgit('.$i.')" ';
	  if ($UPD != 'Y') echo 'disabled="disabled"';
	  echo '/></td>';
	  
	  echo '<td width="'.$wd[5].'">';
	  if ($DEL == 'Y'){
	    echo '<button class="bbt2" onclick="delone('.$i.')">X</button>';
	  }else{
		echo '<button class="cbt2">X</button>';
	  }
	  echo '</td>';
	  
	  echo '</tr>';
	  
	  
  }
  echo '<input type="hidden" id="total" name="total" value="'.$i.'"/>';
  ?>
  </table>
  </form>
  </div>
</td>
</tr>
<tr><td height="200">&nbsp;</td></tr>
</table>


<script>
function chgit(k){
  $.ajax({
    type: "POST",
    url: $('#update_url').val(),
    data: {dep_id:$('#dep_id'+k).val(),
           dep_oid:$('#dep_oid'+k).val(),
           dep_na:$('#dep_na'+k).val(), 
    },
    success: function(res){
      if (res == 1){
		  $('#tip_text').html('<button class="bbt2">!</button> 更新成功');
		  $('#dep_oid'+k).val($('#dep_id'+k).val());
	  }else if (res == 2){
		  $('#tip_text').html('<button class="rbt2">!</button> <span style="color:#F03">ID重複，更新失敗</span>');
	  }else if (res == 3){
		  $('#tip_text').html('<button class="rbt2">!</button> <span style="color:#F03">ID空白，更新失敗</span>');
	  }else if (res == 0){
		  $('#tip_text').html('<button class="rbt2">!</button> <span style="color:#F03">更新失敗</span>');
	  }
	  
	  showtip();
    }
  });
}
</script>

