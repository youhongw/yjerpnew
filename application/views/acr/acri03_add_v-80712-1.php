<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?=base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content"> <!-- div-3 --> 
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 收款單資料建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#acrq01a63').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?=base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('acr/acri03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
	
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/acr/acri03/addsave" >	
	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  if(!isset($acrq01a63)) { $acrq01a63=$this->input->post('tc001'); }
	 
	 if(!isset($acrq01a63disp)) { $acrq01a63disp=$this->input->post('tc001'); }
	//  $purq04a33disp=$this->input->post('tc001'); 
      $tc002=$this->input->post('tc002');
	  if(!isset($tc003)) { $tc003=date("Y/m/d"); }
	  if(!isset($tc017)) { $tc017=date("Y/m/d"); }
	  $copq01a=$this->input->post('tc004'); 
	  $copq01adisp=$this->input->post('tc004'); 
      IF (!isset($cmsq06a)) { $cmsq06a=$this->session->userdata('sysma003');}
	  $cmsq06adisp=$this->input->post('tc005');
	   if(!isset($tc006)) { $tc006=0; }
	 // $tc006=$this->input->post('tc006');
	  $tc007=$this->input->post('tc007');
	  $cmsq02a=$this->input->post('tc010');
	  $cmsq02adisp=$this->input->post('tc010');	
	  
	  $tc011=$this->input->post('tc011');
	  $tc012=$this->input->post('tc012');
	  $tc013=$this->input->post('tc013');
	  $tc014=$this->input->post('tc014');
	  $cmsq09a31=$this->input->post('tc015');
	  $cmsq09a31disp=$this->input->post('tc015');
	   
	  if(!isset($tc009)) { $tc009='N'; }
	  if(!isset($tc008)) { $tc008='Y'; }
	  if(!isset($tc019)) { $tc019='N'; }	
	  if(!isset($tc018)) { $tc018=$username; }
	   if(!isset($tc016)) { $tc016='N'; }
	 
	?>
	
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="10%"><span class="required">收款單別：</span> </td>
        <td class="normal14a"  width="22%"><input tabIndex="1" id="tc001"    onKeyPress="keyFunction()" onfocus="selappr()" onChange="startacrq01a63(this)"  name="acrq01a63" value="<?php echo strtoupper($acrq01a63); ?>"  type="text" required /><a href="javascript:;"><img id="Showacrq01a63" src="<?=base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="acrq01a63disp"> <?php    echo $acrq01a63disp; ?> </span></td>
	    <td class="normal14y" width="10%" >單據日期：</td>
        <td class="normal14a"  width="24%" ><input tabIndex="2"  ondblclick="scwShow(this,event);" onfocus="this.select()" onchange="dataymd1(this)"   id="tc017" onKeyPress="keyFunction()"   name="tc017"  value="<?php echo $tc017; ?>"  size="12" type="text" style="background-color:#E7EFEF"  /></td>
		<td class="normal14y" width="10%" ><span class="required">收款單號：</span> </td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="tc002" onKeyPress="keyFunction()" onfocus="chkno1(this)" name="tc002" value="<?php echo $tc002; ?>" size="20" type="text" required /><span id="tc002disp" ></span></td>
	  </tr>	
	  <tr>
	    
		 <td class="normal14z">客戶代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="tc004" onKeyPress="keyFunction()" onfocus="chkno1(this)" onchange="startcopq01a(this)" name="copq01a" value="<?php echo $copq01a; ?>" size="10" type="text"  /><a href="javascript:;"><img id="Showcopq01a" src="<?=base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
         <span id="copq01adisp"> <?php echo $copq01adisp; ?> </span></td>
	     <td class="normal14z" >廠別：</td>
        <td class="normal14a" ><input  tabIndex="5"  id="tc010" onKeyPress="keyFunction()"  onchange="startcmsq02a(this)" name="cmsq02a"   value="<?php echo  $cmsq02a; ?>" type="text"     /><a href="javascript:;"><img id="Showcmsq02a" src="<?=base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	   <span id="cmsq02adisp"> <?php    echo $cmsq02adisp; ?> </span></td>
		 <td class="normal14z" >幣別：</td>
        <td class="normal14a" ><input tabIndex="6" id="tc005" onKeyPress="keyFunction()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq06a" src="<?=base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span></td>
		
	  </tr>
		<tr>
	    <td class="normal14z" >備註：</td>
        <td class="normal14" ><input tabIndex="7" id="tc007"   onKeyPress="keyFunction()"  name="tc007" value="<?php echo $tc007; ?>" size="30" type="text"   /></td>
		<td class="normal14z" >收款業務員：</td>
        <td class="normal14" ><input tabIndex="8" id="tc015" onKeyPress="keyFunction()" name="cmsq09a31" onchange="startcmsq09a31(this)"  value="<?php echo $cmsq09a31; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq09a31" src="<?=base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
        <span id="cmsq09a31disp"> <?php    echo $cmsq09a31disp; ?> </span></td>
		<td class="normal14z">確認碼：</td>
        <td  class="normal14"  ><select id="tc008" onKeyPress="keyFunction()" name="tc008" onChange="selappr(this)" tabIndex="9">
            <option <?php if($tc008 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tc008 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tc008 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>
	    
	  </tr>
	  <tr>
	     <td class="normal14z">產生分錄：</td>
        <td  class="normal14"  ><input type="hidden" name="tc016" value="N" />
		<input type='checkbox' tabIndex="11" id="tc016"  readonly="value" onKeyPress="keyFunction()" name="tc016" <?php if($tc016 == 'Y' ) echo 'checked'; ?>  <?php if($tc016 !== 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled" /></td> 
	     <td class="normal14z">確認者：</td>
        <td  class="normal14"  ><input tabIndex="12" id="tc018" readonly="value" onKeyPress="keyFunction()"  name="tc018" value="<?php echo $tc018; ?>" size="10" type="text" style="background-color:#EBEBE4"  /></td>
  
		 <td class="normal14z">簽核狀態：</td>
        <td  class="normal14"  ><select id="tc019" tabIndex="13" readonly="value" onKeyPress="keyFunction()" name="tc019"   style="background-color:#EBEBE4" >
            <option <?php if($tc019 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tc019 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($tc019 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tc019 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tc019 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tc019 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tc019 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tc019 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
	  </tr>	
	 <tr>
	    <td class="normal14z" >收款日期：</td>
        <td class="normal14" ><input tabIndex="14" id="tc003" readonly="value"  onKeyPress="keyFunction()"  name="tc003" value="<?php echo $tc003; ?>" size="12" type="text" style="background-color:#EBEBE4"  /></td>
		<td class="normal14z" >列印次數：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="15"  readonly="value"  onKeyPress="keyFunction()" id="tc006" name="tc006" size="5"  value="<?php echo $tc006; ?>" style="background-color:#EBEBE4" /></td> 
	    <td class="normal14" ><input type="hidden" name="tc009" value="<?php echo $tc009; ?>" /></td>						
        <td  class="normal14"  ></td>
	  </tr>
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
	
	
	<!--  憑單資料 -->
	 
	 
	 <div style="width:100%; overflow-x: auto;  ">
        <table style="width:100%;"  id="order_product" class="list1">
        <thead>
            <tr>
              <td width="3%"></td>			
		      <td width="11%" class="center">借貸</td>
              <td width="6%" class="left">類別</td>
			  <td width="6%" class="left">來源單別</td>  
			  <td width="6%" class="center">來源單號</td>
			  <td width="6%" class="center">序號</td>
			  <td width="6%" class="right">會計科目</td>
              <td width="6%" class="right">科目名稱</td>
			  <td width="6%" class="center">幣別</td>
              <td width="6%" class="right">匯率</td>
			  <td width="6%" class="center">立帳金額</td>
			  <td width="6%" class="right">立帳餘額</td>
			  <td width="6%" class="center">原幣金額</td>
			  <td width="6%" class="center">本幣金額</td>
			  <td width="6%" class="right">到期日期</td>
			  <td width="6%" class="center">參考單號</td>
			  <td width="14%" class="center">備註</td>
			  
            </tr>
        </thead>
	
		
          <tfoot>
		 
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?=base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="16"></td>
            </tr>
          </tfoot>
       </table>
	</div> 	
	<!-- 合計     -->
		     <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span>
				</span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">原幣借方金額：</b></td>
				<td ><input type='text' readonly="value" name='tc011' id="tc011" size="8" value="<?php echo $tc011; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　原幣貸方金額：</b></td>
				<td ><input type='text' readonly="value" name='tc012' id="tc012" size="8" value="<?php echo $tc012; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　差額：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot"><?php echo $tc011-$tc012; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　本幣借方金額：</b></td>
				<td ><input type='text' readonly="value" name='tc013' id="tc013" size="8" value="<?php echo $tc013; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　本幣貸方金額：</b></td>
				<td ><input type='text' readonly="value" name='tc014' id="tc014" size="8" value="<?php echo $tc014; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　差額：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot1"><?php echo $tc013-$tc014; ?></span></b></td>
				
				
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	  
	<!-- <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?=base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('acr/acri03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
	
	 </div> -->
		</div> 	   
    </form>
	   <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 有底色欄位,可輸入部份欄位資料下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
	
    </div> <!-- div-6 -->
	
  </div> <!-- div-5 -->
 
</div> <!-- div-4 -->

 
   
	</div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
     <?php include("./application/views/fun/acri03_funjs_v.php"); ?> 
	