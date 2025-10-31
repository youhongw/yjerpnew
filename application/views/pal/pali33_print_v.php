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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 月出勤資料建立作業 - 列印明細表</h1>
    </div>
	
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali33/printa"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $tc001o=$this->input->post('tc001o');
	  $tc001c=$this->input->post('tc001c');
	  $cmsq09a32disp=$this->input->post('tc001c');
	  $tc002o=$this->input->post('tc002o');
	  $tc002c=$this->input->post('tc002c');
	  $tl009p='1';
	?>
       
	<table class="form14">   <!-- 表格 -->
       <tr>
	    <td class="start14a" width="11%">起始員工代號：</td>
        <td class="normal14a" width="39%">
		 <input tabIndex="1" id="tc001" onKeyPress="keyFunction()" type="text" name="tc001o"  value="<?php echo $tc001o; ?>"   /></td>
	    <td class="normal14a" width="11%">結束員工代號：</td>
        <td class="normal14a" width="39%">
	     <input tabIndex="1" id="tc002" onKeyPress="keyFunction()" type="text" name="tc001c"  value="<?php echo $tc001c; ?>" /></td> 
	 <!--     <input   tabIndex="1" id="tc001c" onKeyPress="keyFunction()"  name="cmsq09a32" value="<?php echo $tc001c; ?>"  type="text" required /><img id="Showcmsq09a32" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="cmsq09a32disp"> <?php    echo $cmsq09a32disp; ?> </span></td>  -->
	  </tr>
	  <tr>
	    <td class="start14a" >起始發薪年月：</td>
        <td class="normal14a" >
		 <input tabIndex="1" id="tc002o" onKeyPress="keyFunction()" type="text" name="tc002o" onfocus="this.select();" onChange="dateformat_ym(this)"   value="<?php echo $tc002o; ?>"  style="background-color:#E7EFEF"  minlength="6" required /><span > <?php   echo '輸入範例格式YYYYMM'; ?> </span></td>
	    <td class="normal14a" >結束發薪年月：</td>
        <td class="normal14a" >
	     <input tabIndex="1" id="tc002c" onKeyPress="keyFunction()" type="text" name="tc002c" onfocus="this.select();" onChange="dateformat_ym(this)"   value="<?php echo $tc002c; ?>"   style="background-color:#E7EFEF"/><span > <?php   echo '輸入範例格式YYYYMM'; ?> </span></td>
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
	    <td class="normal14" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="tl009p" onKeyPress="keyFunction()" name="tl009p"  tabIndex="5">
            <option <?php if($tl009p == '1') echo 'selected="selected"';?> value='1'>1.A4(橫式)</option>                                                                        
		    <option <?php if($tl009p == '2') echo 'selected="selected"';?> value='2'>2.Letter(橫式)</option>
		  </select></td>
        <td class="start14" ></td>
	    <td class="normal14" ></td>
	  </tr>	
        </table>
	
	    <div class="buttons">
	      <button tabIndex="5" type='submit' accesskey="p"   name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a accesskey="x" tabIndex="6" id='cancel' name='cancel' href="<?php echo site_url('pal/pali33/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
	
}
$(".mv202").click(function() {
   if($(".mv202_all").prop("checked")) {
	   $(".mv202_all").prop("checked", false);
   }
});
</script>