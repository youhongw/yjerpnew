<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>
	
<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 盤盈虧轉入調整單作業 - 轉入　　　</h1>
   <div style="float:left;padding-top: 5px; ">
   <button style= "cursor:pointer" form="commentForm" onfocus="$('#td001c').focus();" type='submit' onclick="return doit();"  tabIndex="98" accesskey="c" name='submit'  class="button"   target="_new" value='&nbsp;計 算F8&nbsp;'><span>計 算Alt+c</span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></button>&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/102'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
	   
   </div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/inv/invb01/batcha"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-應付憑單自動結帳</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $td001c=$this->input->post('td001c');
	  $td002c=$this->input->post('td002c');
	  $td003c=$this->input->post('td003c');
	  $td004c=$this->input->post('td004c');
	  $invq04a11=$this->input->post('invq04a11'); 
	  $invq04a11disp=$this->input->post('td003c'); 
	
	if(!isset($td004c)) { $td004c=date("Y/m/d"); }
	
	?>
       
	<table class="form14">   <!-- 表格 -->
	  <tr>
	    <td class="normal14y"  width="12%">盤點底稿編號：</td>
        <td class="normal14a" width="38%"><input tabIndex="1" id="td001c"   onKeyPress="keyFunction()"    type="text" name="td001c"  value="<?php echo $td001c; ?>"    /></td>
	  
	    <td class="normal14y"  width="10%">單據備註：</td>
        <td class="normal14a" width="40%"><input tabIndex="2" id="td002c"   onKeyPress="keyFunction()"    type="text" name="td002c"  value="<?php echo $td002c; ?>"  size="50"  /></td>
	  </tr>  
	   <tr>
	    <td class="normal14z"  >盤點調整單別：</td>
        <td class="normal14a"  ><input tabIndex="3" id="td003c"    onKeyPress="keyFunction()"  onchange="startinvq04a11(this)"  name="invq04a11" value="<?php echo strtoupper($invq04a11); ?>"  type="text" required /><a href="javascript:;"><img id="Showinvq04a11" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="invq04a11disp"> <?php    echo $invq04a11disp; ?> </span></td>
	    <td class="normal14z"  >盤點調整日期： </td>
        <td class="normal14a"  ><input tabIndex="4"  onclick="scwShow(this,event);"   id="td004c" onKeyPress="keyFunction()"   name="td004c"  value="<?php echo $td004c; ?>"  size="12" type="text" style="background-color:#E7EFEF"  /></td>
		
	  </tr>	
    </table>
	    <span style="color:#006600;font-weight:bold;">預估計算進度條</span> <br/>
		<div id="progressbar" style="width:420px;height:25px;border:1px solid #0000FF;"></div><br>
		
	<!--	<a onclick="return doit();" class="button"><span>計算&nbsp</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a> -->
	    
		<!--<div class="buttons">
	      <button type='submit' onclick="return doit();"  tabIndex="98" accesskey="c" name='submit'  class="button"   target="_new" value='&nbsp;計 算F8&nbsp;'><span>計 算Alt+c</span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/102'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
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
<?php include("./application/views/fun/invb01_funjs_v.php"); ?>
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
