<div class="reldiv">

<div style="width:100%; text-align:left; height:50px">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="23%">
<?php 
$url_str = explode('/',uri_string());

if($INS == 'Y') echo '<button class="gbt1" onclick="showaddiv()">+按此新增</button>'; else echo '<button class="cbt1">+按此新增</button>'; echo '&nbsp;&nbsp;';
if($DEL == 'Y') echo '<button class="rbt1" onclick="delall()">X批次刪除</button>'; else echo '<button class="cbt1">X批次刪除</button>'; echo '&nbsp;&nbsp;';
if($PRN == 'Y') echo '<button class="lbt1" onclick="prt_page()">口列印此頁</button>'; else echo '<button class="cbt1">口列印此頁</button>'; echo '&nbsp;&nbsp;';

echo '<input type="hidden" id="update_url" value="'.base_url().$url_str[0].'/save'.$url_str[1].'"/>';
echo '<input type="hidden" id="base_url" value="'.base_url().'"/>';
?>
</td>

<td width="17%">&nbsp;&nbsp;查詢:<select id="year" style="width:27%">
<option value="0">選年</option>
<?php 
for ($i=date('Y')-1911;$i>=date('Y')-1921;$i--){
   if ($year == $i){ 
	   echo '<option value="'.$i.'" selected>'.($i+1911).'</option>';
   }else{
	   echo '<option value="'.$i.'">'.($i+1911).'</option>';
   }
}
?></select>年
<select id="month" style="width:27%">
<option value="0">選月</option>
<?php 
for ($i=12;$i>=1;$i--){
   if ($month == $i){
	   if ($i<=9) echo '<option value="0'.$i.'" selected>0'.$i.'</option>';
	   else  echo '<option value="'.$i.'" selected>'.$i.'</option>';
   }else{
	   if ($i<=9) echo '<option value="0'.$i.'">0'.$i.'</option>';
	   else echo '<option value="'.$i.'">'.$i.'</option>';
   }
}
?></select>月
</td>

<td width="60%">
&nbsp;&nbsp;關鍵字: <input type="text" style="width:80px" id="kw" value="<?php if($kw!='null') echo $kw;?>"/>
&nbsp;<button class="bbt1" onclick="change_page()">查詢</button>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<?php 
echo '<input type="hidden" id="curr_url" value="'.base_url().$url_str[0].'/'.$url_str[1].'"/>';//取controller與function
?>
      
<button class="bbt3" onclick="window.location='<?php echo base_url().$url_str[0].'/'.$url_str[1].'/1/'.$count.'/'.$year.'/'.$month;?>'">|<</button>
<button class="bbt3" onclick="window.location='<?php echo base_url().$url_str[0].'/'.$url_str[1].'/'.$pre_page.'/'.$count.'/'.$year.'/'.$month;?>'"><</button>
<select onchange="change_page()" id="page">
<?php for ($i=1; $i<=$last_page; $i++){
          if ($i == $curr_page) echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
		  else echo '<option value="'.$i.'">'.$i.'</option>';
      }
?>
</select>
<button class="bbt3" onclick="window.location='<?php echo base_url().$url_str[0].'/'.$url_str[1].'/'.$next_page.'/'.$count.'/'.$year.'/'.$month;?>'">></button>
<button class="bbt3" onclick="window.location='<?php echo base_url().$url_str[0].'/'.$url_str[1].'/'.$last_page.'/'.$count.'/'.$year.'/'.$month;?>'">>|</button>

&nbsp;&nbsp;&nbsp;&nbsp;

顯示<select onchange="change_page()" id="count">
<option value="10">10</option>
<option value="20" <?php if($count == '20') echo 'selected="selected"';?>>20</option>
<option value="30" <?php if($count == '30') echo 'selected="selected"';?>>30</option>
</select>筆
</td>
</tr>
</table>
</div>

<!--用來插入新增資料的Form-->
<div id="addbox" class="addiv"></div>
</div>