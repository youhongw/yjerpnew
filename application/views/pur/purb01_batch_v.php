<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>
	
<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 請購資料更新作業 - 更新　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer;" form="commentForm" onfocus="$('#tb001c').focus();" type='submit' onclick="return doit();"  tabIndex="98" accesskey="c" name='submit'  class="button"   target="_new" value='&nbsp;計 算F8&nbsp;'><span>計 算Alt+c</span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a   accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/103'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a> 
	   
	</div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pur/purb01/batcha"  method="post"  enctype="multipart/form-data" > 
	
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $tb001c=$this->input->post('tb001c');
	  $tb002c=$this->input->post('tb002c');
	  $tb003c=$this->input->post('tb003c');
	  $tb004c=$this->input->post('tb004c');
	  
	  $tb020c=$this->input->post('tb020c');
	  $cmsq02a=$this->input->post('cmsq02a');
	  $cmsq03a=$this->input->post('cmsq03a');
	//  $cmsq06a=$this->input->post('cmsq06a');
	   $cmsq06a=$this->session->userdata('sysma003');
   //  if (!$this->input->post('cmsq06a')) {$cmsq06a=$this->session->userdata('sysma003');}
	//  $cmsq09a4=$this->input->post('cmsq09a4');
	   if (!$this->input->post('cmsq09a4')) {$cmsq09a4=$this->session->userdata('manager');} else {$cmsq09a4=$this->input->post('cmsq09a4');} 
	  $tb201c=$this->input->post('tb201c');
	  $tb010c=$this->input->post('tb010c');
	//  $tb204c=$this->input->post('tb204c');
	    $tb204c=date("Y/m/d");
	//  if (!$this->input->post('tb204c')) {$tb204c=date("Y/m/d");}
	  $purq04a33=$this->input->post('purq04a33');
	  
	  $cmsq02adisp=$this->input->post('cmsq02adisp');
	  $cmsq03adisp=$this->input->post('cmsq03adisp');
	  $cmsq06adisp=$this->input->post('cmsq06adisp');
	  $cmsq09a4disp=$this->input->post('cmsq09a4disp');
	  $purq04a33disp=$this->input->post('purq04a33disp');
	  
	 if (!$this->input->post('tb001c')) {$tb001c='3131';}
	 if (!$this->input->post('tb002c')) {$tb002c='3131';}
	 if (!$this->input->post('tb003c')) {$tb003c='10509004';}
	 if (!$this->input->post('tb004c')) {$tb004c='10509005';}
	?>
       
	<table class="form14">   <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="15%"><span class="required">起請購單別：</span></td>
        <td class="normal14a" width="35%"><input tabIndex="1" id="tb001c" onKeyPress="keyFunction()" type="text" name="tb001c"  value="<?php echo $tb001c; ?>"  size="06" /></td>
	    <td class="normal14y" width="8%">迄 單 別：</td>
        <td class="normal14a" width="42%"><input tabIndex="2" id="tb002c" onKeyPress="keyFunction()" type="text" name="tb002c"  value="<?php echo $tb002c; ?>"  size="06" /></td>
	  </tr>
      <tr>
	    <td class="normal14z"><span class="required">起請購單號：</span></td>
        <td class="normal14" ><input tabIndex="3" id="tb003c" onKeyPress="keyFunction()" type="text" name="tb003c"  value="<?php echo $tb003c; ?>"  size="16" /></td>
	    <td class="normal14z" >迄 單 號：</td>
        <td class="normal14"><input tabIndex="4" id="tb004c" onKeyPress="keyFunction()" type="text" name="tb004c"  value="<?php echo $tb004c; ?>"  size="16" /></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >鎖定選項：</td>
        <td class="normal14" ><select tabIndex="5"  id="tb020c" onKeyPress="keyFunction()" name="tb020c"   >
		      <option <?php if($tb020c == 'N') echo 'selected="selected"';?> value='N'>N:未鎖定 </option>
           	  <option <?php if($tb020c == 'Y') echo 'selected="selected"';?> value='Y'>Y:已鎖定 </option> 
              <option <?php if($tb020c == 'A') echo 'selected="selected"';?> value='A'>A:全部</option>
		  </select></td>
	    <td class="normal14z" >選擇廠別：</td>
        <td class="normal14" ><input type="text" tabIndex="5" onKeyPress="keyFunction()" id="tb202c"  onchange="startcmsq02a(this)" name="cmsq02a"   value="<?php echo  $cmsq02a; ?>"     /><a href="javascript:;"><img id="Showcmsq02a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	     <span id="cmsq02adisp"> <?php    echo $cmsq02adisp; ?> </span></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >選擇庫別：</td>
        <td class="normal14" ><input tabIndex="7" id="tb008c" onKeyPress="keyFunction()" name="cmsq03a" onchange="startcmsq03a(this)"   value="<?php echo  $cmsq03a; ?>"    size="10" type="text"  /><img id="Showcmsq03a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
         <span id="cmsq03adisp"> <?php    echo $cmsq03adisp; ?> </span></td>
	    <td class="normal14z" >選擇幣別：</td>
        <td class="normal14" ><input tabIndex="8" id="tb200c" onKeyPress="keyFunction()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text"   /><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span></td>
	  </tr>	   
	  <tr>
	    <td class="normal14z" >選擇採購人員：</td>
        <td class="normal14" ><input tabIndex="9" id="tb013c" onKeyPress="keyFunction()" onchange="startcmsq09a4(this)" name="cmsq09a4" value="<?php echo $cmsq09a4; ?>" size="10" type="text"  /><img id="Showcmsq09a4" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
	    <span id="cmsq09a4disp"> <?php   echo $cmsq09a4disp; ?> </span></td>
	    <td class="normal14" ></td>
        <td class="normal14" ></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >採購日期：</td>
        <td class="normal14" ><input tabIndex="10" id="tb204c"  ondblclick="scwShow(this,event);" onfocus="this.select()" onchange="dataymd1(this)"  onKeyPress="keyFunction()" type="text" name="tb204c"  value="<?php echo $tb204c; ?>"  size="10" style="background-color:#E7EFEF"/><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td>
		<td class="normal14z" >採購單別：</td>
        <td class="normal14" ><input tabIndex="11" id="tb205c"    onKeyPress="keyFunction()"  onchange="startpurq04a33(this)"  name="purq04a33" value="<?php echo strtoupper($purq04a33); ?>"  type="text" required /><a href="javascript:;"><img id="Showpurq04a33" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="purq04a33disp"> <?php   echo $purq04a33disp; ?> </span></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >相同交貨日彙總產生：</td>
        <td class="normal14" ><input type="hidden" name="tb201c" value="N" />
		<input type="checkbox" tabIndex="12" id="tb201c" onKeyPress="keyFunction()" name="tb201c" <?php if($tb201c == 'Y' ) echo 'checked'; ?>  <?php if($tb201c !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
		<td class="normal14z" >拋轉備註：</td>
        <td class="normal14" ><input type="hidden" name="tb010c" value="Y" />
		<input type="checkbox" tabIndex="13" id="tb010c" onKeyPress="keyFunction()" name="tb010c" <?php if($tb010c == 'Y' ) echo 'checked'; ?>  <?php if($tb010c !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	  </tr>
	 
	    
    </table>
	    <span style="color:#006600;font-weight:bold;">預估計算進度條</span> <br/>
		<div id="progressbar" style="width:420px;height:25px;border:1px solid #0000FF;"></div><br>
		
	<!--	<a onclick="return doit();" class="button"><span>計算&nbsp</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a> -->
	    
		<!--<div class="buttons">
	      <button type='submit' onclick="return doit();"  tabIndex="98" accesskey="c" name='submit'  class="button"   target="_new" value='&nbsp;計 算F8&nbsp;'><span>計 算Alt+c</span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/103'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
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
<?php include("./application/views/fun/purb01_funjs_v.php"); ?>
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