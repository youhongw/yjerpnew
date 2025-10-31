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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 核價單資料建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pur/puri03/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  $purq04a32=$this->input->post('tl001'); 
	  $purq04a32disp=$this->input->post('tl001'); 
      $tl002=$this->input->post('tl002');
	
	  if(!isset($tl003)) { $tl003=date("Y/m/d"); }
	  $purq01a=$this->input->post('tl004');
	  $purq01adisp=$this->input->post('tl004');
	 // $cmsq06a=$this->input->post('tl005');
	   if(!isset($cmsq06a)) { $cmsq06a=$this->session->userdata('sysma003'); }
	
	  $cmsq06adisp=$this->input->post('tl005');
	  if(!isset($tl006)) { $tl006='Y'; }
	  $tl007=$this->input->post('tl007');
	   if(!isset($tl008)) { $tl008='N'; }
	  $tl009=$this->input->post('tl009');
        if(!isset($tl010)) { $tl010=date("Y/m/d"); }
	  if(!isset($tl011)) { $tl011=$username; }
	   if(!isset($tl012)) { $tl012='N'; }
	  
	   
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="10%"><span class="required">核價單別：</span> </td>
        <td class="normal14a"  width="22%"><input tabIndex="1" id="tl001"    onKeyPress="keyFunction()" onfocus="selappr()" onChange="startpurq04a32(this)"  name="purq04a32" value="<?php echo strtoupper($purq04a32); ?>"  type="text" required /><a href="javascript:;"><img id="Showpurq04a32" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="purq04a32disp"> <?php    echo $purq04a32disp; ?> </span></td>
	    <td class="normal14a" width="10%" >單據日期： </td>
        <td class="normal14a"  width="24%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"  onfocus="this.select()" onchange="dataymd1(this)" id="tl010" onKeyPress="keyFunction()"  name="tl010"  value="<?php echo $tl010; ?>"  size="12" type="text" style="background-color:#E7EFEF"  /></td>
		<td class="normal14a" width="10%" ><span class="required">核價單號：</span> </td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="tl002" onKeyPress="keyFunction()" onfocus="chkno1(this)" name="tl002" value="<?php echo $tl002; ?>" size="20" type="text" required /><span id="tl002disp" ></span></td>
	  </tr>		
		  
	  <tr>
		<td class="normal14">供應廠商：</td>
        <td  class="normal14"  ><input tabIndex="4" id="tl004" onKeyPress="keyFunction()" onfocus="chkno1(this)" onchange="startpurq01a(this)" name="purq01a" value="<?php echo $purq01a; ?>" size="10" type="text"  /><a href="javascript:;"><img id="Showpurq01a" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
        <span id="purq01adisp"> <?php echo $purq01adisp; ?> </span></td>	    
	    <td class="normal14" >幣別：</td>
        <td class="normal14a" ><input tabIndex="5" id="tl005" onKeyPress="keyFunction()"  onfocus="this.select()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
        <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span></td>
		<td class="normal14a" >備註：</td>
        <td class="normal14a" ><input  tabIndex="6"  id="tl007" onKeyPress="keyFunction()"   name="tl007"   value="<?php echo  $tl007; ?>" type="text"     /></td>
	  
	  </tr>
		<tr>
	    <td class="normal14" >含稅：</td>
        <td class="normal14" ><input type="hidden" name="tl008" value="N" />
		<input type='checkbox' tabIndex="7" id="tl008"  readonly="value" onKeyPress="keyFunction()" name="tl008" <?php if($tl008 == 'Y' ) echo 'checked'; ?>  <?php if($tl008 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
		<td class="normal14">確認碼：</td>
        <td  class="normal14"  ><select id="tl006" onKeyPress="keyFunction()" name="tl006"  onchange="selappr(this)" tabIndex="8">
            <option <?php if($tl006 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tl006 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tl006 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>  
	    <td class="normal14" >列印次數：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="9"  readonly="value"  onKeyPress="keyFunction()" id="tl009" name="tl009" size="5"  value="<?php echo $tl009; ?>" style="background-color:#EBEBE4" /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >核價日期：</td>
        <td class="normal14"  ><input type="text"   tabIndex="10"  readonly="value" onKeyPress="keyFunction()"   name="tl003" value="<?php echo $tl003; ?>" style="background-color:#EBEBE4"  /></td>
	     <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input tabIndex="11" id="tl011" readonly="value" onKeyPress="keyFunction()"  name="tl011" value="<?php echo $tl011; ?>" size="10" type="text" style="background-color:#EBEBE4"  /></td>
  
		 <td class="normal14">簽核狀態：</td>
        <td  class="normal14"  ><select id="tl012" tabIndex="12" readonly="value" onKeyPress="keyFunction()" name="tl012"   style="background-color:#EBEBE4" >
            <option <?php if($tl012 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tl012 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($tl012 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tl012 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tl012 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tl012 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tl012 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tl012 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
		
	  </tr>
	</table>
		

	<div>
        <table id="order_product" class="list1">
        <thead>
            <tr>
              <td width="5%"></td>			
		      <td width="11%" class="center">品號</td>
              <td width="15%" class="left">品名</td>
			  <td width="15%" class="left">規格</td>
			  <td width="6%" class="left">單位</td>
			  <td width="6%" class="center">序號</td>
			  <td width="10%" class="left">生效日期</td>
              <td width="6%" class="center">廠商品號</td>
              <td width="6%" class="right">單價</td>
			  <td width="14%" class="center">備註</td>				
            </tr>
        </thead>
          <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="11"></td>
            </tr>
          </tfoot>
       </table>
    </div>
	
	
	 <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pur/puri03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div> 
	 <br> 
    </form>
	  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
	
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

 
    </div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
     <?php include("./application/views/fun/puri03_funjs_v.php"); ?> 
	  