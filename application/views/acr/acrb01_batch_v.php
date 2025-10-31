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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 結帳單自動結帳作業 - 結帳　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button type='submit' onclick="return doit();"  tabIndex="98" accesskey="c" name='submit'  class="button"   target="_new" value='&nbsp;計 算F8&nbsp;'><span>計 算Alt+c</span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></button>&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/106'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
	    
	</div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/acr/acrb01/batcha"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-結帳單自動結帳</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	//  $ta004c=$this->input->post('ta004c');
	//  $ta004o=$this->input->post('ta004o');
	  $copq01ac=$this->input->post('copq01ac');
	  $copq01ao=$this->input->post('copq01ao');
	  $copq01acdisp=$this->input->post('copq01acdisp');
	  $copq01aodisp=$this->input->post('copq01aodisp');

   	  $datec=$this->input->post('datec');
	  $dateo=$this->input->post('dateo');
	//  $tb008c=$this->input->post('tb008c');
	  $ta032c=$this->input->post('ta032c');
	  $tb004c=$this->input->post('tb004c');
	  
	  $cmsq02a=$this->input->post('cmsq02a');
	  $cmsq02adisp=$this->input->post('cmsq02adisp');
	  
	  $cmsq06a=$this->session->userdata('sysma003');
	  $cmsq06adisp=$this->input->post('cmsq06adisp');
	  $copq03a34=$this->input->post('copq03a34');
	   $copq03a34disp=$this->input->post('copq03a34disp');
	   $acrq01a61=$this->input->post('acrq01a61');
	   $acrq01a61disp=$this->input->post('acrq01a61disp');
	
	  $ta011c=$this->input->post('ta011c');
	  $ta012c=$this->input->post('ta012c');
	  $ta003c=$this->input->post('ta003c');
	  $tb012c=$this->input->post('tb012c');
	   $tb012c1=$this->input->post('tb012c1');
	 if (!$this->input->post('ta003c')) {$ta003c=date("Y/m/d");}	
     if (!$this->input->post('tb008c')) {$tb008c='1';}	 
	 if (!$this->input->post('copq01ac')) {$copq01ac='1101';}
	 if (!$this->input->post('copq01ao')) {$copq01ao='1101';}
	 if (!$this->input->post('dateo')) {$dateo='2016/08/26';}
	 if (!$this->input->post('datec')) {$datec='2016/09/25';}
	
	?>
       
	<table class="form14">   <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="12%">起客戶代號：</td>
        <td class="normal14a" width="38%"><input type="text" tabIndex="1" onKeyPress="keyFunction()" id="ta004c"  onchange="startcopq01ac(this)" name="copq01ac"   value="<?php echo  $copq01ac; ?>"     /><a href="javascript:;"><img id="Showcopq01ac" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
	     <span id="copq01acdisp"> <?php    echo $copq01acdisp; ?> </span></td>
	    <td class="normal14y" width="12%">迄客戶代號：</td>
        <td class="normal14a" width="38%"><input type="text" tabIndex="2" onKeyPress="keyFunction()" id="ta004o"  onchange="startcopq01ao(this)" name="copq01ao"   value="<?php echo  $copq01ao; ?>"     /><a href="javascript:;"><img id="Showcopq01ao" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
	     <span id="copq01aodisp"> <?php    echo $copq01aodisp; ?> </span></td>
	  </tr>
      <tr>
	    <td class="normal14z">起結帳日期：</td>
        <td class="normal14" ><input tabIndex="3" id="dateo" onKeyPress="keyFunction()" onclick="scwShow(this,event);" onfocus="this.select()" onchange="dataymd(this)" type="text" name="dateo"  value="<?php echo $dateo; ?>"  size="16" style="background-color:#E7EFEF" /></td>
	    <td class="normal14z" >迄結帳日期：</td>
        <td class="normal14"><input tabIndex="4" id="datec" onKeyPress="keyFunction()" onclick="scwShow(this,event);" onfocus="this.select()" onchange="dataymd1(this)"　 type="text" name="datec"  value="<?php echo $datec; ?>"  size="16" sstyle="background-color:#E7EFEF" /></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >選結帳期間：</td>
        <td class="normal14" > <input tabIndex="5" type="radio" name="tb008c" <?php if (isset($tb008c) && $tb008c=="1") echo "checked";?> value="1" />統一結帳日&nbsp;&nbsp; 
          <input type="radio" tabIndex="6" name="tb008c" <?php if (isset($tb008c) && $tb008c=="2") echo "checked";?> value="2" />依客戶結帳日</td>
		<td class="normal14z" >結帳年月：</td>
        <td class="normal14" ><input tabIndex="7" id="ta032c" readonly="value" onKeyPress="keyFunction()" type="text" name="ta032c"  value="<?php echo $ta032c; ?>"  size="10" /></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >選銷/退貨：</td>
        <td class="normal14" ><select tabIndex="8"  id="tb004c" onKeyPress="keyFunction()" name="tb004c"   >
		      <option <?php if($tb004c == '0') echo 'selected="selected"';?> value='0'>0:全部 </option>
           	  <option <?php if($tb004c == '1') echo 'selected="selected"';?> value='1'>1:銷貨 </option> 
              <option <?php if($tb004c == '2') echo 'selected="selected"';?> value='2'>2:退貨</option>
		  </select></td>
	    <td class="normal14z" >來源單別：</td>
        <td class="normal14" ><input tabIndex="9" id="tb005c"  readonly="value"  onKeyPress="keyFunction()"  onchange="startcopq03a34(this)"  name="copq03a34" value="<?php echo strtoupper($copq03a34); ?>"  type="text"  /><a href="javascript:;"><img id="Showcopq03a34" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="copq03a34disp"> <?php   echo $copq03a34disp; ?> </span></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >選擇幣別：</td>
        <td class="normal14" ><input tabIndex="8" id="ta008c" onKeyPress="keyFunction()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text"   /><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span></td>
	    <td class="normal14z" >選擇廠別：</td>
        <td class="normal14" ><input type="text" tabIndex="9" onKeyPress="keyFunction()" id="ta005c"  onchange="startcmsq02a(this)" name="cmsq02a"   value="<?php echo  $cmsq02a; ?>"     /><a href="javascript:;"><img id="Showcmsq02a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	     <span id="cmsq02adisp"> <?php    echo $cmsq02adisp; ?> </span></td>
	  </tr>	
       <tr>
	    <td class="normal14z" >發票聯數：</td>
        <td class="normal14" ><select tabIndex="8"  id="ta011c" onKeyPress="keyFunction()" name="ta011c"   >
		      <option <?php if($ta011c == '0') echo 'selected="selected"';?> value='0'>0:全部 </option>
           	  <option <?php if($ta011c == '1') echo 'selected="selected"';?> value='1'>1:二聯式 </option> 
              <option <?php if($ta011c == '2') echo 'selected="selected"';?> value='2'>2:三聯式</option>
			  <option <?php if($ta011c == '3') echo 'selected="selected"';?> value='3'>3:二聯式收銀機發票</option> 
              <option <?php if($ta011c == '4') echo 'selected="selected"';?> value='4'>4:三聯式收銀機發票</option>
			  <option <?php if($ta011c == '5') echo 'selected="selected"';?> value='5'>5:電子計算機發票</option>
			  <option <?php if($ta011c == '6') echo 'selected="selected"';?> value='6'>6:免用統一發票</option>
		  </select></td>
	    <td class="normal14z" >課 稅 別：</td>
        <td class="normal14" ><select tabIndex="8"  id="ta012c" onKeyPress="keyFunction()" name="ta012c"   >
		      <option <?php if($ta012c == '0') echo 'selected="selected"';?> value='0'>0:全部 </option>
           	  <option <?php if($ta012c == '1') echo 'selected="selected"';?> value='1'>1:應稅內含 </option> 
              <option <?php if($ta012c == '2') echo 'selected="selected"';?> value='2'>2:應稅外加</option>
			  <option <?php if($ta012c == '3') echo 'selected="selected"';?> value='3'>3:零稅率</option> 
              <option <?php if($ta012c == '4') echo 'selected="selected"';?> value='4'>4:免稅</option>
			  <option <?php if($ta012c == '9') echo 'selected="selected"';?> value='9'>9:不計稅</option>
		  </select></td>
	  </tr>		  
	  <tr>
	    <td class="normal14z" >結帳單單別：</td>
        <td class="normal14" ><input tabIndex="1" id="ta001c"    onKeyPress="keyFunction()"  onChange="startacrq01a61(this)"  name="acrq01a61" value="<?php echo strtoupper($acrq01a61); ?>"  type="text" required /><a href="javascript:;"><img id="Showacrq01a61" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="acrq01a61disp"> <?php    echo $acrq01a61disp; ?> </span></td>
	    <td class="normal14z" >結帳單日期：</td>
        <td class="normal14" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta003c" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta003c"  value="<?php echo $ta003c; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(ta003c,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td></tr>
	 
	   <tr>
	    <td class="normal14z" >同客戶不同廠別是否分開結帳：</td>
        <td class="normal14" ><input type="hidden" name="tb012c" value="N" />
		<input type="checkbox" tabIndex="12" id="tb012c" onKeyPress="keyFunction()" name="tb012c" <?php if($tb012c == 'Y' ) echo 'checked'; ?>  <?php if($tb012c !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
		<td class="normal14z" >同客戶不同收款業務員分開結帳：</td>
        <td class="normal14" ><input type="hidden" name="tb012c1" value="N" />
		<input type="checkbox" tabIndex="12" id="tb012c1" onKeyPress="keyFunction()" name="tb012c1" <?php if($tb012c1 == 'Y' ) echo 'checked'; ?>  <?php if($tb012c1 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	  </tr>
	  
	    
    </table>
	    <span style="color:#006600;font-weight:bold;">預估計算進度條</span> <br/>
		<div id="progressbar" style="width:420px;height:25px;border:1px solid #0000FF;"></div><br>
		
	<!--	<a onclick="return doit();" class="button"><span>計算&nbsp</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a> -->
	    
		<!--<div class="buttons">
	      <button type='submit' onclick="return doit();"  tabIndex="98" accesskey="c" name='submit'  class="button"   target="_new" value='&nbsp;計 算F8&nbsp;'><span>計 算Alt+c</span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/106'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
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
<?php include("./application/views/fun/acrb01_funjs_v.php"); ?>
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