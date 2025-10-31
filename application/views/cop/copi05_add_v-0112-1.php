<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
		  <img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?=base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>
	    </div>
    </div>

<div id="content"> <!-- div-3 --> 
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 報價單資料建立作業</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?=base_url()?>index.php/cop/copi05/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  $copq03a21=$this->input->post('ta001'); 
	  $copq03a21disp=$this->input->post('ta001'); 
      $ta002=$this->input->post('ta002');
	
	  if(!isset($ta003)) { $ta003=date("Y/m/d"); }
	  $copq01a=$this->input->post('ta004');	  
	  $copq01adisp=$this->input->post('ta004');
	  $cmsq09a3=$this->input->post('ta005');
	  $cmsq09a3disp=$this->input->post('ta005');
	  $ta006=$this->input->post('ta006');
	  $cmsq06a=$this->input->post('ta007');
	  $cmsq06adisp=$this->input->post('ta007');
	  $ta008=$this->input->post('ta008');
	  $ta009=$this->input->post('ta009');
	  $ta010=$this->input->post('ta010');
	  $cmsq21a2=$this->input->post('ta011');
	  $cmsq21a2disp=$this->input->post('ta011');
	   if(!isset($ta013)) { $ta013=date("Y/m/d"); }
	    $ta014=$this->input->post('ta014');
	   if(!isset($ta015)) { $ta015=$username; }
	     if(!isset($ta016)) { $ta016='N'; }
	  if(!isset($ta017)) { $ta017='1'; }
	  
	   $ta018=$this->input->post('ta018');
	   
	   if(!isset($ta019)) { $ta019='Y'; }
	    if(!isset($ta022)) { $ta022='2'; }
		
	  $ta020=$this->input->post('ta020');
	   $ta021=$this->input->post('ta021');
	//    $ta023=$this->input->post('ta023');
	//    $ta024=$this->input->post('ta024');
	//    $ta025=$this->input->post('ta025');
	//	 $ta027=$this->input->post('ta027');
	//	  $ta028=$this->input->post('ta028');
	//	  $ta030=$this->input->post('ta030');
      if(!isset($ta029)) { $ta029='N'; }
	   
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="10%"><span class="required">報價單別：</span> </td>
        <td class="normal14a"  width="22%"><input tabIndex="1" id="ta001"    onKeyPress="keyFunction()" onfocus="selappr()" onChange="startcopq03a21(this)"  name="copq03a21" value="<?php echo strtoupper($copq03a21); ?>"  type="text" required /><a href="javascript:;"><img id="Showcopq03a21" src="<?=base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="copq03a21disp"> <?php    echo $copq03a21disp; ?> </span></td>
	    <td class="normal14a" width="10%" ><span class="required">單據日期：</span> </td>
        <td class="normal14a"  width="24%" ><input tabIndex="2"  onclick="scwShow(this,event);"  class="date" id="ta013" onKeyPress="keyFunction()"  onchange="chkno1(this)" name="ta013"  value="<?php echo $ta013; ?>"  size="12" type="text"   /></td>
		<td class="normal14a" width="10%" ><span class="required">報價單號：</span> </td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="ta002" onKeyPress="keyFunction()" onfocus="chkno1(this)" name="ta002" value="<?php echo $ta002; ?>" size="20" type="text" required /><span id="ta002disp" ></span></td>
	  </tr>		
		  
	  <tr>
		<td class="start14">客戶代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="ta004" onKeyPress="keyFunction()" onfocus="chkno1(this)" onchange="startcopq01a(this)" name="purq01a" value="<?php echo $copq01a; ?>" size="10" type="text"  /><a href="javascript:;"><img id="Showcopq01a" src="<?=base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
        <span id="copq01adisp"> <?php echo $copq01adisp; ?> </span></td>	    
	    <td class="start14" >幣別：</td>
        <td class="normal14a" ><input tabIndex="5" id="ta007" onKeyPress="keyFunction()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq06a" src="<?=base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
        <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span></td>
		<td class="start14" >業務人員：</td>
        <td class="normal14a" ><input tabIndex="6" id="ta005" onKeyPress="keyFunction()" onfocus="chkno1(this)" onchange="startcmsq09a3(this)" name="purq01a" value="<?php echo $cmsq09a3; ?>" size="10" type="text"  /><a href="javascript:;"><img id="Showcmsq09a3" src="<?=base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
        <span id="cmsq09a3disp"> <?php echo $ cmsq09a3disp; ?> </span></td>
	  
	  </tr>
	   <tr>
		<td class="start14">付款條件：</td>
        <td  class="normal14"  ><input tabIndex="7" id="ta011" onKeyPress="keyFunction()" onfocus="chkno1(this)" onchange="startcmsq21a2(this)" name="cmsq21a2" value="<?php echo $cmsq21a2; ?>" size="10" type="text"  /><a href="javascript:;"><img id="Showcmsq21a2" src="<?=base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
        <span id="cmsq21a2disp"> <?php echo $cmsq21a2disp; ?> </span></td>	    
	    <td class="start14" >價格條件：</td>
        <td class="normal14a" ><input type="text" tabIndex="8"  onKeyPress="keyFunction()" id="ta014" name="ta014"   value="<?php echo $ta014; ?>"  /></td>
		<td class="start14" >訂貨日起日：</td>
        <td class="normal14a" ><input type="text" tabIndex="9"  onKeyPress="keyFunction()" id="ta014" name="ta014" size="5"  value="<?php echo $ta014; ?>"  /></td>
	  
	  </tr>
	   <tr>
		<td class="start14">匯率：</td>
        <td  class="normal14"  ><input type="text" tabIndex="10"  onKeyPress="keyFunction()" id="ta008" name="ta008"   value="<?php echo $ta008; ?>"  /></td>
	    <td class="start14" >營業稅率：</td>
        <td class="normal14a" ><input type="text" tabIndex="11"  onKeyPress="keyFunction()" id="ta024" name="ta024"   value="<?php echo $ta024; ?>"  /></td>
		<td class="start14" >列印格式：</td>
        <td class="normal14a" ><input type="text" tabIndex="12"  onKeyPress="keyFunction()" id="ta017" name="ta017" size="5"  value="<?php echo $ta017; ?>"  /></td>
	  
	  </tr>
	   <tr>
		<td class="start14">客戶全名：</td>
        <td  class="normal14"  ><input type="text" tabIndex="13"  onKeyPress="keyFunction()" id="ta006" name="ta006"   value="<?php echo $ta006; ?>"  /></td>
	    <td class="start14" >備註一：</td>
        <td class="normal14a" ><input type="text" tabIndex="14"  onKeyPress="keyFunction()" id="ta020" name="ta020"   value="<?php echo $ta020; ?>"  /></td>
		<td class="start14" >客戶確認：</td>
        <td class="normal14a" ><input type="hidden" name="ta021" value="N" />
		<input type='checkbox' tabIndex="21" id="ta021" onKeyPress="keyFunction()" name="ta021" <?php if($ta021 == 'Y' ) echo 'checked'; ?>  <?php if($ta021 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
	  
	  </tr>
		<tr>
	    <td class="normal14" >課稅別：</td>
        <td class="normal14" ><select id="ta022" onKeyPress="keyFunction()" name="ta022" onchange="taxa()" tabIndex="19">
		    <option <?php if($ta022 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php if($ta022 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php if($ta022 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php if($ta022 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php if($ta022 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select></td>
		<td class="normal14">確認碼：</td>
        <td  class="normal14"  ><select id="ta019" onKeyPress="keyFunction()" name="ta019"  onchange="selappr(this)" tabIndex="8">
            <option <?php if($ta019 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($ta019 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
		  </select><span  id="approved" ></span></td>  
	    <td class="normal14" >列印次數：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="9"  readonly="value"  onKeyPress="keyFunction()" id="ta018" name="ta018" size="5"  value="<?php echo $ta018; ?>" style="background-color:#EBEBE4" /></td>
	  </tr>
	   <tr>
	    <td class="normal14b" >報價日期：</td>
        <td class="normal14b"  ><input type="text"   tabIndex="10"  readonly="value" onKeyPress="keyFunction()"   name="ta003" value="<?php echo $ta003; ?>" style="background-color:#EBEBE4"  /></td>
	     <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input tabIndex="11" id="ta015" readonly="value" onKeyPress="keyFunction()"  name="ta015" value="<?php echo $ta015; ?>" size="10" type="text" style="background-color:#EBEBE4"  /></td>
  
		 <td class="normal14">簽核狀態：</td>
        <td  class="normal14"  ><select id="ta029" tabIndex="12" readonly="value" onKeyPress="keyFunction()" name="ta029"   style="background-color:#EBEBE4" >
            <option <?php if($ta029 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($ta029 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($ta029 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($ta029 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($ta029 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($ta029 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($ta029 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($ta029 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
		
	  </tr>
	</table>
		

	<div>
        <table id="order_product" class="list">
        <thead>
            <tr>
              <td width="5%"></td>			
		      <td width="11%" class="center">品號</td>
              <td width="15%" class="left">品名</td>
			  <td width="15%" class="left">規格</td>
			  <td width="6%" class="left">單位</td>
			  <td width="6%" class="center">序號</td>
			  <td width="10%" class="left">生效日期</td>
              <td width="6%" class="right">數量</td>
		      <td width="6%" class="right">單價</td>
			  <td width="6%" class="right">金額</td>
			  <td width="6%" class="center">毛重</td>
			  <td width="6%" class="center">材積</td>
			  <td width="6%" class="center">客戶品號</td>
			  <td width="14%" class="center">備註</td>				
            </tr>
        </thead>
          <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?=base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="15"></td>
            </tr>
          </tfoot>
       </table>
    </div>
	<!-- 合計     -->
		     <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">報價金額：</b></td>
				<td ><input type='text' readonly="value" name='ta009' id="ta009" size="8" value="<?php echo $ta009; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta023' id="ta023" size="8" value="<?php echo $ta023; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;合計金額：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot"><?php echo $ta009+$ta023; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">總數量：</b></td>
				<td ><input type='text' readonly="value" name='ta025' id="ta031" size="8" value="<?php echo $ta025; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;總毛重：</b></td>
				<td ><input type='text' readonly="value" name='ta027' id="ta027" size="8" value="<?php echo $ta027; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;總材積：</b></td>
				<td <input type='text' readonly="value" name='ta028' id="ta028" size="8" value=<?php echo $ta028; ?>  style="background-color:#EBEBE4" /></td>
				
				
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	
	
	 <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?=base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cop/copi05/display'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
	 </div> 
	 <br> 
    </form>
	  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
	
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

 
    </div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
   