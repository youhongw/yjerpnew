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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 總 分 類 帳 - 列印</h1>
    </div>
	
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/act/actr08/printa"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	//  if (!$this->input->post('bdate')) {$bdate=date("Y/m");}
	  if (!$this->input->post('edate')) {$edate=date("Y/m/d");}
	  $bdate='';
	   if (!$this->input->post('bactno')) {$bactno='1101';}
	   if (!$this->input->post('eactno')) {$eactno='1101';}
	   $actq03a4disp=$this->input->post('bactno');
	    $actq03a2disp=$this->input->post('eactno');
	  $tg009p='1';
	?>
       
	<table class="form14">   <!-- 表格 -->
      <tr>
	    <td class="start14a" width="12%">總分類帳年月：</td>
	    <td class="normal14a" width="38%"><input  type="text"  tabIndex="1" id="bdate"  onclick="fPopCalendar(event,this,this)"  class="date-picker" onChange="dateformat_ym(this)"  onKeyPress="keyFunction()"    name="bdate"  value="<?php echo $bdate; ?>"  size="16" style="background-color:#E7EFEF" /></td>
        <td class="normal14a" width="14%">截止列印傳票日期：</td>
	    <td class="normal14a" width="36%"><input tabIndex="2" id="edate" onclick="scwShow(this,event);" onfocus="selappr()"   onKeyPress="keyFunction()"    type="text" name="edate"  value="<?php echo $edate; ?>"  size="16" style="background-color:#E7EFEF" /></td>
	  </tr>
	   <tr>
	    <td class="start14a" >科目代號：</td>
	    <td class="normal14" ><input tabIndex="3" id="bactno" onKeyPress="keyFunction()" name="bactno" onchange="startactq03a4(this)"   value="<?php echo  $bactno; ?>"     type="text"  /><img id="Showactq03a4" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="actq03a4disp"> <?php   echo $actq03a4disp; ?> </span></td>
	    <td class="start14a" ></td>
		<td class="normal14" ></td>
	 <!--   <td class="normal14a" >截止科目代號：</td>
	    <td class="normal14" ><input tabIndex="4" id="eactno" onKeyPress="keyFunction()" name="eactno" onchange="startactq03a2(this)"   value="<?php echo  $eactno; ?>"     type="text"  /><img id="Showactq03a2" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="actq03a2disp"> <?php   echo $actq03a2disp; ?> </span></td> -->
	  </tr>
	
	   <tr>
	    <td class="normal14" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="tg009p" onKeyPress="keyFunction()" name="tg009p"  tabIndex="12">
            <option <?php if($tg009p == '1') echo 'selected="selected"';?> value='1'>1.A4(橫式)</option>                                                                        
		    <option <?php if($tg009p == '2') echo 'selected="selected"';?> value='2'>2.Letter(橫式)</option>
		  </select></td> 
        <td class="normal14" ></td>		  
		 <td class="normal14" ></td>		 
	  </tr>	
	 
    </table>
	
	    <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/109'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
<?php //include("./application/views/fun/actb04_funjs_v.php"); ?>
<?php include("./application/views/fun/report_funjs_v.php"); ?> 
