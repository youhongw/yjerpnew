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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 資產盤點產生作業 - 產生</h1>
    </div>
	
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ast/astb01/batcha"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-應付憑單自動結帳</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $td001c=$this->input->post('td001c');
	  $td002c=$this->input->post('td002c');
	  if(!isset($td002c)) { $td002c=date("Y/m/d"); } else {$td002c=$this->input->post('td002c');}
	  $td003c=$this->input->post('td003c');
	  $td004c=$this->input->post('td004c');
	  $td005c=$this->input->post('td005c');
	  $td006c=$this->input->post('td006c');
	  
	   if(!isset($dateo)) { $dateo=''; }
	  if(!isset($datec)) { $datec=''; }
  	 $cmsq05a=$this->input->post('cmsq05a');
	   $cmsq05adisp=$this->input->post('cmsq05a');
	  $invq02a=$this->input->post('invq02a');
	  $invq02adisp=$this->input->post('invq02a');
	  $invq02a1=$this->input->post('invq02a1');
	   $invq02a1disp=$this->input->post('invq02a1');
	
	?>
       
	<table class="form14">   <!-- 表格 -->
	  <tr>
	    <td class="start14a"  width="14%">盤點底稿編號：</td>
        <td class="normal14a" width="86%"><input tabIndex="1" id="td001c"   onKeyPress="keyFunction()"    type="text" name="td001c"  value="<?php echo $td001c; ?>"    /></td>
	  </tr>
	   <tr>
	    <td class="start14a"  >盤點日期：</td>
        <td class="normal14a" ><input tabIndex="2" id="td002c"  ondblclick="scwShow(this,event);" onchange="dataymd6(this)" onKeyPress="keyFunction()"    name="td002c"  value="<?php echo $td002c; ?>"  style="background-color:#EBEBE4"  /><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td>
	  </tr>  
	    <tr>
	    <td class="start14a"  >盤點部門：</td>
        <td class="normal14a" ><input type="text" tabIndex="4" onKeyPress="keyFunction()"  id="td003c" onchange="startcmsq05a(this);" name="cmsq05a"   value="<?php echo  $cmsq05a; ?>"     /><a href="javascript:;"><img id="Showcmsq05a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
	   <span id="cmsq05adisp"> <?php    echo $cmsq05adisp; ?> </span></td>
	  </tr>  
	    <tr>
	    <td class="start14a"  >起始資產編號：</td>
        <td class="normal14a" ><input tabIndex="1" id="td004c"   onKeyPress="keyFunction()"    type="text" name="td004c"  value="<?php echo $td004c; ?>"    /></td>
	  </tr> 
	    <tr>
	    <td class="start14a"  >截止資產編號：</td>
        <td class="normal14a" ><input tabIndex="1" id="td005c"   onKeyPress="keyFunction()"    type="text" name="td005c"  value="<?php echo $td005c; ?>"    /></td>
	  </tr> 
	  <tr>
	    <td class="start14a" >起取得日期：</td>
	    <td class="normal14a" ><input tabIndex="1" id="dateo" ondblclick="scwShow(this,event);" onChange="dateformat_ymd(this);" onKeyPress="keyFunction()" type="text" name="dateo"  value="<?php echo $dateo; ?>"  size="20" style="background-color:#E7EFEF" />
         <img  onclick="scwShow(dateo,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
	  <tr>
	    <td class="start14a" >迄取得日期：</td>
	    <td class="normal14a"><input tabIndex="1" id="datec" ondblclick="scwShow(this,event);" onChange="dateformat_ymd(this);" onKeyPress="keyFunction()" type="text" name="datec"  value="<?php echo $datec; ?>"  size="20" style="background-color:#E7EFEF" />
        <img  onclick="scwShow(datec,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
    </table>
	    <span style="color:#006600;font-weight:bold;">預估計算進度條</span> <br/>
		<div id="progressbar" style="width:420px;height:25px;border:1px solid #0000FF;"></div><br>
		
	<!--	<a onclick="return doit();" class="button"><span>計算&nbsp</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a> -->
	    
		<div class="buttons">
	      <button type='submit' onclick="return doit();"  tabIndex="98" accesskey="c" name='submit'  class="button"   target="_new" value='&nbsp;計 算F8&nbsp;'><span>計 算Alt+c</span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/141'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
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
<?php include("./application/views/fun/astb01_funjs_v.php"); ?>
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
