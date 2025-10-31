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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 薪資冊 - 列印明細表</h1>
    </div>
	
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/palr54/printa"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  
	  if(!isset($palq01a)) { $palq01a=''; } else {  $palq01a=$this->input->post('palq01a'); }
	  if(!isset($palq01adisp)) { $palq01adisp=''; } else {  $palq01adisp=$this->input->post('palq01adisp'); }
	  if(!isset($palq01a1)) { $palq01a1='zzzzz'; } else {  $palq01a1=$this->input->post('palq01a1'); }
	  if(!isset($palq01a1disp)) { $palq01a1disp=''; } else {  $palq01a1disp=$this->input->post('palq01a1disp'); }
	  
	  if(!isset($dateo)) { $dateo=date("Y/m"); }
	  if(!isset($datec)) { $datec=date("Y/m/d"); }
	  if(!isset($dateo1)) { $dateo1=''; }
	  if(!isset($datec1)) { $datec1=date("Y/m/d"); }
	  $ta001o=$this->input->post('ta001o');
	  $ta001c=$this->input->post('ta001c');
	  $ta002o=$this->input->post('ta002o');
	  $ta002c=$this->input->post('ta002c');
	  if(!isset($td016)) { $td016='N'; }  else {  $td016=$this->input->post('td016'); }
	  $te009p='1';
	?>
       
	<table class="form14">   <!-- 表格 -->
	  <tr>
	    <td class="start14" >發薪年月：</td>
	    <td class="normal14" ><input tabIndex="3" id="dateo" onfocus="this.select();" onchange="dateformat_ym(this)" onKeyPress="keyFunction()" type="text" name="dateo"  value="<?php echo $dateo; ?>"  size="20" style="background-color:#E7EFEF"/><span > <?php echo '輸入範例yyyymm'; ?> </span></td>
        <td class="normal14" ></td>
	    <td class="normal14" ></td>
	  </tr>
	  <tr>
	    <td class="start14" >起迄列印別：</td>
	    <td class="normal14" >
		<?php 
		foreach($data_col['rows'] as $key => $val){
		?>
		<input type="checkbox" id="" name="mv202[]" class="mv202" value="<?=$val->mm001?>" /><?=$val->mm001.":"?><?=$val->mm002?>
		<?php 
		}
		?>
		<input type="checkbox" class="mv202_all" />全選
		</td>
        <td class="normal14" align="right"></td>
	  </tr>
	  <tr>
	    <td class="start14">是否只列印外勞：</td>
	    <td class="normal14">
		<input type="checkbox" id="y_lou" name="y_lou" class="y_lou" value="Y" />只列印外勞
		</td>
        <td class="normal14" align="right"></td>
	  </tr>
	  <tr>
	    <td class="start14">是否增加其他減項明細：</td>
	    <td class="normal14">
		<input type="checkbox" id="cost_detail" name="cost_detail" class="cost_detail" value="Y" />增加其他減項明細(僅對Excel有效)
		</td>
        <td class="normal14" align="right"></td>
	  </tr>
	   <tr>
	    <td class="normal14" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="te009p" onKeyPress="keyFunction()" name="te009p"  tabIndex="12">
            <option <?php if($te009p == '1') echo 'selected="selected"';?> value='1'>1.A4 (橫式)</option>                                                                        
		    <option <?php if($te009p == '2') echo 'selected="selected"';?> value='2'>2.Letter (橫式)</option>
		  </select></td> 
        <td class="normal14" ></td>		  
		<td class="normal14" ></td>		 
	  </tr>
    </table>
	
	    <div class="buttons">
	      <button type='submit' tabIndex="98" accesskey="p" name='action' class="button" target="_new" value='print'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
		  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
		  <button type='submit' accesskey="l" class="button" name='action' value='excel'>轉EXCEL檔Alt+l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></button>
		  <?PHP } ?>
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/111'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
<?php include("./application/views/fun/report_funjs_v.php"); ?> 
<script>
$(document).ready(function(){
	check_check_all();
});
$(".mv202_all").click(function() {
   if($(".y_lou").prop("checked")) {
	   $(".y_lou").prop("checked", false);
   }
	check_check_all();
});
$(".y_lou").click(function() {
   if($(".mv202_all").prop("checked")) {
	   $(".mv202_all").prop("checked", false);
   }
	check_check_all();
});
function check_check_all(){
   if($(".mv202_all").prop("checked")) {
     $("input[name='mv202[]']").each(function() {
         $(this).prop("checked", true);
     });
   } else {
     $("input[name='mv202[]']").each(function() {
         $(this).prop("checked", false);
     });           
   }
   if($(".y_lou").prop("checked")) {
     $("input[name='mv202[]']").each(function() {
         $(this).prop("checked", false);
     });
	$(".mv202_all").prop("checked", false);
   }
	
}
$(".mv202").click(function() {
   if($(".mv202_all").prop("checked")) {
	   $(".mv202_all").prop("checked", false);
   }
   if($(".y_lou").prop("checked")) {
	   $(".y_lou").prop("checked", false);
   }
});
</script>