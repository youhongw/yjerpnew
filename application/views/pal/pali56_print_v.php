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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 出勤資料管理作業 - 列印明細表</h1>
    </div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali56/printa"  method="post"  enctype="multipart/form-data" > 
	<div id="tab-general"> <!-- div-6 -->
	<?php
	//處理載入資料
	if(!isset($dateo)){$dateo="";}else{$dateo=substr($dateo,0,4)."/".substr($dateo,4,2)."/".substr($dateo,6,2);}
	if(!isset($datec)){$datec="";}else{$datec=substr($datec,0,4)."/".substr($datec,4,2)."/".substr($datec,6,2);}
	if(!isset($epyo)){$epyo="";}
	if(!isset($epyc)){$epyc="";}
	if(!isset($type)){$type="";}
	if(!isset($te009p)){$te009p=1;}
	
	?>
	<table class="form14">   <!-- 表格 -->
       <tr>
	    <td class="start14a" width="12%">起始員工代號：</td>
        <td class="normal14a" width="38%">
			<input tabIndex="1" id="epyo" name="epyo" value="<?php echo $epyo; ?>" onKeyPress="keyFunction()" type="text" />
		</td>
	    <td class="normal14a" width="12%">結束員工代號：</td>
        <td class="normal14a" width="38%">
			<input tabIndex="2" id="epyc" name="epyc" value="<?php echo $epyc; ?>" onKeyPress="keyFunction()" type="text" />
		</td> 
	  <tr>
	    <td class="start14" >起始日期：</td>
	    <td class="normal14" >
			<input tabIndex="3" id="dateo" onfocus="this.select();" onchange="dateformat_ymd(this)" onKeyPress="keyFunction()" type="text" name="dateo"  value="<?php echo $dateo; ?>"  size="20" style="background-color:#E7EFEF" minlength="8" required /><span > <?php echo '輸入範例yyyymm'; ?> </span>
		</td>
	    <td class="start14" >結束日期：</td>
	    <td class="normal14" >
			<input tabIndex="4" id="datec" onfocus="this.select();" onchange="dateformat_ymd(this)" onKeyPress="keyFunction()" type="text" name="datec"  value="<?php echo $datec; ?>"  size="20" style="background-color:#E7EFEF" minlength="8" required /><span > <?php echo '輸入範例yyyymm'; ?> </span>
		</td>
	  </tr>
	  <tr><td class="normal14" colspan="2">
	   日常<input id="type" name="type" type="radio" style="height:9px;" value="A" <?if(@$type=="A"){echo "checked";}?> />
	    異常(包含已請)<input id="type" name="type" type="radio" style="height:9px;" value="B" <?if(@$type=="B"){echo "checked";}?> />
		 異常(未請假)<input id="type" name="type" type="radio" style="height:9px;" value="C" <?if(@$type=="C"){echo "checked";}?> />
	   </td>
        <td class="normal14" >切資料方式：</td>		  
		<td class="normal14" > 
		 依照日期(預設)<input id="slice_func" name="slice_func" type="radio" style="height:12px;" value="1" checked />
			依照員工<input id="slice_func" name="slice_func" type="radio" style="height:12px;" value="2" />
		 </td>
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
	      <button  type='submit' tabIndex="98" accesskey="p" name='action' class="button"   target="_new" value='print'><span>列 印 Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
		  <button  type='submit' tabIndex="99" accesskey="p" name='action' class="button"   target="_new" value='excel'><span>產 生Excel Alt+p</span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
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