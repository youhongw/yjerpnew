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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 出貨通知單更新作業 - 產生</h1>
    </div>
	
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/eps/epsb01/batcha"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-應付憑單自動結帳</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $td001o=$this->input->post('td001o');
	  $td001c=$this->input->post('td001c');
	  $td002o=$this->input->post('td002o');
	  $td002c=$this->input->post('td002c');
	  $td003o=$this->input->post('td003o');
	  $td003c=$this->input->post('td003c');
	  $td004o=$this->input->post('td004o');
	  $td004c=$this->input->post('td004c');
	 // if(!isset($td002c)) { $td002c=date("Y/m/d"); } else {$td002c=$this->input->post('td002c');}
	 
	   if(!isset($dateo)) { $dateo=''; }
	   if(!isset($datec)) { $datec=''; }
	   if(!isset($dateo1)) { $dateo1=''; }
	   if(!isset($datec1)) { $datec1=''; }
  	 $cmsq05a=$this->input->post('cmsq05a');
	   $cmsq05adisp=$this->input->post('cmsq05a');
	  $invq02a=$this->input->post('invq02a');
	  $invq02adisp=$this->input->post('invq02a');
	  $invq02a1=$this->input->post('invq02a1');
	   $invq02a1disp=$this->input->post('invq02a1');
	
	?>
       
	<table class="form14">   <!-- 表格 -->
	  <tr>
	    <td class="start14a"  width="14%">起出貨通知單：</td>
        <td class="normal14a" width="86%"><input tabIndex="1" id="td001o"   onKeyPress="keyFunction()"    type="text" name="td001o"  value="<?php echo $td001o; ?>"    /></td>
	  </tr>
	   <tr>
	    <td class="start14a"  >迄出貨通知單：</td>
        <td class="normal14a" ><input tabIndex="2" id="td001c"   onKeyPress="keyFunction()"    name="td001c"  value="<?php echo $td001c; ?>"   /></td>
	  </tr>  
	  <tr>
	    <td class="start14a"  >起客戶代號：</td>
        <td class="normal14a" ><input tabIndex="1" id="td002o"   onKeyPress="keyFunction()"    type="text" name="td002o"  value="<?php echo $td002o; ?>"    /></td>
	  </tr>
	   <tr>
	    <td class="start14a"  >迄客戶代號：</td>
        <td class="normal14a" ><input tabIndex="2" id="td002c"   onKeyPress="keyFunction()"    name="td002c"  value="<?php echo $td002c; ?>"   /></td>
	  </tr>  
	  
	  <tr>
	    <td class="start14a" >起出貨日期：</td>
	    <td class="normal14a" ><input tabIndex="1" id="dateo" ondblclick="scwShow(this,event);" onChange="dateformat_ymd(this);" onKeyPress="keyFunction()" type="text" name="dateo"  value="<?php echo $dateo; ?>"  size="20" style="background-color:#E7EFEF" />
         <img  onclick="scwShow(dateo,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
	  <tr>
	    <td class="start14a" >迄出貨日期：</td>
	    <td class="normal14a"><input tabIndex="1" id="datec" ondblclick="scwShow(this,event);" onChange="dateformat_ymd(this);" onKeyPress="keyFunction()" type="text" name="datec"  value="<?php echo $datec; ?>"  size="20" style="background-color:#E7EFEF" />
        <img  onclick="scwShow(datec,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
	  <tr>
	    <td class="start14a"  >輸入銷貨單別：</td>
        <td class="normal14a" ><input tabIndex="1" id="td003o"   onKeyPress="keyFunction()"    type="text" name="td003o"  value="<?php echo $td003o; ?>"    /></td>
	  </tr>
	  <tr>
	    <td class="start14a" >輸入銷貨日期：</td>
	    <td class="normal14a" ><input tabIndex="1" id="dateo1" ondblclick="scwShow(this,event);" onChange="dateformat_ymd(this);" onKeyPress="keyFunction()" type="text" name="dateo1"  value="<?php echo $dateo1; ?>"  size="20" style="background-color:#E7EFEF" />
         <img  onclick="scwShow(dateo1,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
    </table>
	    <span style="color:#006600;font-weight:bold;">預估計算進度條</span> <br/>
		<div id="progressbar" style="width:420px;height:25px;border:1px solid #0000FF;"></div><br>
		
	<!--	<a onclick="return doit();" class="button"><span>計算&nbsp</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a> -->
	    
		<div class="buttons">
	      <button type='submit' onclick="return doit();"  tabIndex="98" accesskey="c" name='submit'  class="button"   target="_new" value='&nbsp;計 算F8&nbsp;'><span>計 算Alt+c</span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/151'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
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
<?php include("./application/views/fun/epsb01_funjs_v.php"); ?>
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
