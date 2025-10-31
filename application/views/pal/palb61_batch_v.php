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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 扣繳憑單媒體申報 - 作業</h1>
    </div>
	
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/palb61/batcha"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-應付憑單自動結帳</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	//  $ta004c=$this->input->post('ta004c');
	  $ta034c=$this->input->post('ta034c');
	  if(!isset($dateo)) { $dateo=date("Y/m"); }
	  if(!isset($datec)) { $datec=date("Y/m"); }
	  
//	 if (!$this->input->post('ta003c')) {$ta003c=date("Y/m/d");}	
  //   if (!$this->input->post('tb008c')) {$tb008c='1';}	 
	
	// if !isset($this->input->post('ta034c')) {$ta034c=date("Y/m");}
	 if(!isset($ta034c)) { $ta034c=date("Y"); } else { $ta034c=$this->input->post('ta034c');} 
	// if (!$this->input->post('start_date')) {$start_date=date("Y/m");}
//	 if (!$this->input->post('ta034o')) {$ta034o=date("Y/m/d");}
	
	?>
       
	<table class="form14">   <!-- 表格 -->
	  <tr>
	    <td class="start14"  width="12%">起始扣繳年月：</td>
	    <td class="normal14" width="38%"><input tabIndex="3" id="dateo" onfocus="this.select();" onchange="dateformat_ym(this)"  onKeyPress="keyFunction()" type="text" name="dateo"  value="<?php echo $dateo; ?>" size="20" style="background-color:#E7EFEF" minlength="6" required  /><span > <?php echo '輸入範例yyyymm'; ?> </span></td>
        <td class="normal14" width="12%">結束扣繳年月：</td>
	    <td class="normal14" width="38%"><input tabIndex="3" id="datec" onfocus="this.select();" onchange="dateformat_ym(this)"  onKeyPress="keyFunction()" type="text" name="datec"  value="<?php echo $dateo; ?>" size="20" style="background-color:#E7EFEF" minlength="6" required  /><span > <?php echo '輸入範例yyyymm'; ?> </span></td>
	  </tr>
	  <tr>
	    <td class="start14a"  >申報年度：</td>
        <td class="normal14a"  ><input tabIndex="3" id="ta034c"      onKeyPress="keyFunction()"    type="text" name="ta034c"  value="<?php echo $ta034c; ?>"  size="16" style="background-color:#E7EFEF" /></td>
	     <td class="normal14" ></td>		  
		 <td class="normal14" ></td>	
	  </tr>
	    
    </table>
	    <span style="color:#006600;font-weight:bold;">預估計算進度條</span> <br/>
		<div id="progressbar" style="width:420px;height:25px;border:1px solid #0000FF;"></div><br>
		
	<!--	<a onclick="return doit();" class="button"><span>計算&nbsp</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a> -->
	    
		<div class="buttons">
	      <button type='submit' onclick="return doit();"  tabIndex="98" accesskey="c" name='submit'  class="button"   target="_new" value='&nbsp;計 算F8&nbsp;'><span>計 算Alt+c</span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/104'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
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
