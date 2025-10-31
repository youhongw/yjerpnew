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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 加班單自動產生作業 - 轉入</h1>
    </div>
	
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/palb52/batcha"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-應付憑單自動結帳</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	
	  if (!isset($dateyymm)) { $dateyymm=date("Y/m");}
	
	  if (!isset($dateo1)) { $dateo1=date("Y/m/").'01';}
	  if (!isset($datec1)) { $datec1=date("Y/m/").'31';}
	  if (!isset($date2o)) { $date2o=date("Y/m/").'01';}
	  if (!isset($date2c)) { $date2c=date("Y/m/").'31';}
	
	// if (!$this->input->post('dateyy')) {$dateyy=date("Y");}	
   //  if (!$this->input->post('datemm'))  {$datemm=date("m");}	
	// $dateyy=date("Y");
	// $datemm=date("m");
	
	?>
       
	<table class="form14">   <!-- 表格 -->
	 
	  <tr>
	    <td class="start14a" width="12%">起始刷卡日期：</td>
        <td class="normal14a" width="38%">
		 <input tabIndex="1" id="dateo1" onKeyPress="keyFunction()" type="text" onfocus="this.select();" ondblclick="scwShow(this,event);" onchange="dataymd2(this)" name="dateo1"  value="<?php echo $dateo1; ?>"  style="background-color:#E7EFEF" /><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td>
	    <td class="normal14a" width="12%" >結束刷卡日期：</td>
        <td class="normal14a" width="38%">
	     <input tabIndex="1" id="datec1" onKeyPress="keyFunction()" type="text" onfocus="this.select();" ondblclick="scwShow(this,event);" onchange="dataymd3(this)" name="datec1"  value="<?php echo $datec1; ?>"    style="background-color:#E7EFEF"/><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td>
	  </tr>
	 
	  <tr>
	    <td class="start14a"  >轉入加班年月：</td>
        <td class="normal14a"  ><input tabIndex="1" id="dateyymm"   onKeyPress="keyFunction()"   onfocus="this.select();" ondblclick="scwShow(this,event);" onchange="dataym4(this)"   type="text" name="dateyymm"  value="<?php echo $dateyymm; ?>"  size="10"  /></td>
	  </tr>
    </table>
	    <span style="color:#006600;font-weight:bold;">預估計算進度條</span> <br/>
		<div id="progressbar" style="width:420px;height:25px;border:1px solid #0000FF;"></div><br>
		
	<!--	<a onclick="return doit();" class="button"><span>計算&nbsp</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a> -->
	    
		<div class="buttons">
	      <button type='submit' onclick="return doit();"  tabIndex="98" accesskey="c" name='submit'  class="button"   target="_new" value='&nbsp;計 算F8&nbsp;'><span>轉 入Alt+c</span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/111'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
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
