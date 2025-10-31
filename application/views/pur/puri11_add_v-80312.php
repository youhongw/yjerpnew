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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 退貨單資料建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pur/puri11/addsave" >	
	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  if(!isset($purq04a35)) { $purq04a35=$this->input->post('ti001'); }
	 
	 if(!isset($purq04a35disp)) { $purq04a35disp=$this->input->post('ti001'); }
	//  $purq04a33disp=$this->input->post('ti001'); 
      $ti002=$this->input->post('ti002');
	  $ti003=date("Y/m/d");
	  $purq01a=$this->input->post('ti004'); 
	  $purq01adisp=$this->input->post('ti004'); 
	
	  if(!isset($ti014)) { $ti014=date("Y/m/d"); }
	  if(!isset($ti003)) { $ti003=date("Y/m/d"); }
       
	  if(!isset($ti013)) { $ti013='Y'; }
	  if(!isset($ti024)) { $ti024='N'; }
	  $ti022=$this->input->post('ti022');
	  $ti011=$this->input->post('ti011');
	  $ti015=$this->input->post('ti015');
	  $ti028=$this->input->post('ti028');
	  $ti029=$this->input->post('ti029');
	 
	?>
	 <?php
	   
	  // if(!isset($ti007)) { $ti007=0.05; }
	   $cmsq06a=$this->session->userdata('sysma003');
	   $ti030=$this->session->userdata('sysma004');
	   
	   $ti012=$this->input->post('ti012');
	  // $ti042=$this->input->post('ti042');
	   if(!isset($ti032)) { $ti032='N'; }
	
	   if(!isset($ti007)) { $ti007=1; }
	   $ti012=$this->input->post('ti012');
	   $ti021=$this->input->post('ti021');
	   $ti010=$this->input->post('ti010');
	   $ti013=$username;
	 
	   $cmsq09a4=$this->input->post('ti011');
	   $cmsq09a4disp=$this->input->post('ti011');
	   
	    $cmsq02a=$this->input->post('ti005');
	    $cmsq02adisp=$this->input->post('ti005');	 
		IF (!isset($cmsq06a)) { $cmsq06a=$this->session->userdata('sysma003');}
	    $cmsq06adisp=$this->input->post('ti006');
		$cmsq21a1=$this->input->post('ti030');
	    $cmsq21a1disp=$this->input->post('ti030');
	  ?>
	   <?php
	   $ti017=$this->input->post('ti017');
	   $ti008=$this->input->post('ti008');
	   $ti023=$this->input->post('ti023');
	   $ti018=$this->input->post('ti018');
	   $ti009=$this->input->post('ti009');
	   $ti019=$this->input->post('ti019');
	   $ti020=$this->input->post('ti020');
	  // $ti030=$this->input->post('ti030');
	    if(!isset($ti027)) { $ti027=$this->session->userdata('sysma004'); }
	   $ti025=$this->input->post('ti025');
	   $ti026=$this->input->post('ti026');
	  ?>
   <?php 
	  if(!isset($sysma200)) { $sysma200=$this->session->userdata('sysma200'); }
	  if(!isset($sysma201)) { $sysma201=$this->session->userdata('sysma201'); }  ?>
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="10%"><span class="required">退貨單別：</span> </td>
        <td class="normal14a"  width="40%"><input tabIndex="1" id="ti001"    onKeyPress="keyFunction()" onfocus="selappr()" onChange="startpurq04a35(this)"  name="purq04a35" value="<?php echo strtoupper($purq04a35); ?>"  type="text" required /><a href="javascript:;"><img id="Showpurq04a35" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="purq04a35disp"> <?php    echo $purq04a35disp; ?> </span></td>
	    <td class="normal14a" width="10%" >單據日期： </td>
        <td class="normal14a"  width="40%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"  onfocus="this.select()" onchange="dataymd1(this)"  id="ti014" onKeyPress="keyFunction()"   name="ti014"  value="<?php echo $ti014; ?>"  size="12" type="text"  style="background-color:#E7EFEF" /><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td>
	  </tr>	
	  <tr>
	    <td class="normal14a" >退貨單號：</td>
        <td class="normal14a" ><input tabIndex="3" id="ti002" onKeyPress="keyFunction()" onfocus="chkno1(this)" name="ti002" value="<?php echo $ti002; ?>" size="30" type="text" required /><span id="ti002disp" ></span></td>
		 <td class="normal14a">供應廠商：</td>
        <td  class="normal14"  ><input tabIndex="4" id="ti004" onKeyPress="keyFunction()" onfocus="chkno1(this)" onchange="startpurq01a(this)" name="purq01a" value="<?php echo $purq01a; ?>" size="10" type="text"  /><a href="javascript:;"><img id="Showpurq01a" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
         <span id="purq01adisp"> <?php echo $purq01adisp; ?> </span><input type="hidden" name="purq01adisp" value=<?php   echo $purq01adisp; ?> /></td>
	  </tr>
		
	  <tr>
	     <td class="normal14">產生分錄：</td>
        <td  class="normal14"  ><input type="hidden" name="ti024" value="N" />
		<input type='checkbox' tabIndex="5" id="ti024" onKeyPress="keyFunction()" readonly="value" name="ti024" <?php if($ti024 == 'Y' ) echo 'checked'; ?>  <?php if($ti024 !== 'Y' ) echo 'check'; ?> value="Y" size="1" style="background-color:#F5F5F5" /></td> 
	    
		<td class="normal14">確認碼：</td>
          <td  class="normal14"  ><select id="ti013" onKeyPress="keyFunction()" name="ti013" onChange="selappr(this)" tabIndex="6">
            <option <?php if($ti013 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($ti013 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($ti013 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td> 
		    <td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" /></td>
         <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" /></td>
	  </tr>
	  
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
		<li><a href="#tab1"  accesskey="a">交易資料a</a></li>
		<li><a href="#tab2"  accesskey="b">發票資料b</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  交易資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	 
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14a"  width="10%">廠別：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="7" onKeyPress="keyFunction()" id="ti005"  onchange="startcmsq02a(this)" name="cmsq02a"   value="<?php echo  $cmsq02a; ?>"     /><a href="javascript:;"><img id="Showcmsq02a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	   <span id="cmsq02adisp"> <?php    echo $cmsq02adisp; ?> </span></td>
	   <td class="normal14a"  width="10%" > 件數：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="8" id="ti021"   tabIndex="11"   onKeyPress="keyFunction()"    name="ti021" value="<?php echo $ti021; ?>"  /></td>
	 </tr>	
		  
	  <tr>
	   <td class="normal14a"  >幣別：</td>
        <td class="normal14" ><input tabIndex="9" id="ti006" onKeyPress="keyFunction()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span></td>
	    <td class="normal14" >匯率：</td>		
        <td class="normal14"  ><input type="text" id="ti007"   tabIndex="10"   onKeyPress="keyFunction()"    name="ti007" value="<?php echo $ti007; ?>"  /></td>
	  </tr>
	  <tr>
	    <td  class="normal14a" >付款條件：</td>
        <td  class="normal14"  ><input tabIndex="11" id="ti030" onKeyPress="keyFunction()" name="cmsq21a1" onchange="startcmsq21a1(this)"   value="<?php echo  $cmsq21a1; ?>"     type="text"  /><a href="javascript:;"><img id="Showcmsq21a1" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="cmsq21a1disp"> <?php    echo $cmsq21a1disp; ?> </span></td>		   
	    <td  class="normal14a">備註：</td>		
        <td  class="start14"  ><input type="text"   tabIndex="12" id="ti012"  onKeyPress="keyFunction()"   name="ti012" value="<?php echo $ti012; ?>"   /></td>
	    
	  </tr>
	  <tr>
	    <td class="normal14">退貨日期：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="13" readonly="value"  onKeyPress="keyFunction()" id="ti003" name="ti003"   value="<?php echo $ti003; ?>" style="background-color:#EBEBE4"  /></td>
		<td class="normal14" >列印次數：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="14"  readonly="value"  onKeyPress="keyFunction()" id="ti010" name="ti010" size="5"  value="<?php echo $ti010; ?>" style="background-color:#EBEBE4" /></td>
	  </tr>	
		
	  <tr>
	    <td  class="normal14" >簽核狀態：</td>
        <td class="normal14"><select id="ti032" tabIndex="15" readonly="value" onKeyPress="keyFunction()" name="ti032"   style="background-color:#EBEBE4" >
            <option <?php if($ti032 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($ti032 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($ti032 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($ti032 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($ti032 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($ti032 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($ti032 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($ti032 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
	    <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="16" readonly="value"   onKeyPress="keyFunction()" id="ti026" name="ti026"   value="<?php echo $ti026; ?>" style="background-color:#EBEBE4" /></td>
	  </tr>
	 
	  
	</table>
	</div>
	
<!--	
	<!--  發票資料 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	  
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14a"  width="10%">統一編號：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="17"   onKeyPress="keyFunction()" id="ti017" name="ti017"   value="<?php echo $ti017; ?>"   /></td>
	   <td class="normal14a"  width="10%" >發票號碼：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="18"   onKeyPress="keyFunction()" id="ti018" name="ti018"   value="<?php echo $ti018; ?>"   /></td>
	 </tr>			  
	 
	  <tr>
	   <td class="normal14a"  >發票聯數：</td>
        <td class="normal14" ><select id="ti008" onKeyPress="keyFunction()" name="ti008"  tabIndex="19">
		    <option <?php if($ti008 == '2') echo 'selected="selected"';?> value='2'>2三聯式</option>
            <option <?php if($ti008 == '1') echo 'selected="selected"';?> value='1'>1二聯式</option> 
            <option <?php if($ti008 == '3') echo 'selected="selected"';?> value='3'>3二聯式收銀機發票</option>
		    <option <?php if($ti008 == '4') echo 'selected="selected"';?> value='4'>4三聯式收銀機發票</option>
            <option <?php if($ti008 == '5') echo 'selected="selected"';?> value='5'>5電子計算機發票</option>
            <option <?php if($ti008 == '6') echo 'selected="selected"';?> value='6'>6免用統一發票</option>	
            <option <?php if($ti008 == 'A') echo 'selected="selected"';?> value='A'>A增值稅專用發票</option>	
            <option <?php if($ti008 == 'B') echo 'selected="selected"';?> value='B'>B普通發票</option>	
            <option <?php if($ti008 == 'C') echo 'selected="selected"';?> value='C'>C免用發票</option>				
		  </select></td>
		<td class="normal14a"  >課稅別：</td>
        <td class="normal14" ><select id="ti009" onKeyPress="keyFunction()" name="ti009" onchange="seltax()" tabIndex="20">
		    <option <?php if($ti009 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php if($ti009 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php if($ti009 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php if($ti009 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php if($ti009 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select><span  id="taxdisp" ></span></td>
	  </tr>	
	  <tr>
	    <td class="normal14">發票日期：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="21"   onKeyPress="keyFunction()"  onclick="scwShow(this,event);" id="ti023" name="ti023"   value="<?php echo $ti023; ?>"    /></td>
		<td class="normal14" >扣底區分：</td>						
        <td  class="normal14"  ><select id="ti019" onKeyPress="keyFunction()" name="ti019"  tabIndex="22">
		    <option <?php if($ti019 == '1') echo 'selected="selected"';?> value='1'>1可扣掋退貨及費用</option>
            <option <?php if($ti019 == '2') echo 'selected="selected"';?> value='2'>2可扣抵固定資產</option> 
            <option <?php if($ti019 == '3') echo 'selected="selected"';?> value='3'>3不可扣抵退貨及費用</option>
		    <option <?php if($ti019 == '4') echo 'selected="selected"';?> value='4'>4不可扣抵固定資產</option>
		  </select></td>
	  </tr>	
	   <tr>
	    <td  class="normal14" >申報年月：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="23" id="ti025" onfocus="setMonth(this);" onKeyPress="keyFunction()"   name="ti025" value="<?php echo $ti025; ?>"   /></td>	   
	    <td  class="normal14">營業稅率：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="24" id="ti027"  onKeyPress="keyFunction()"   name="ti027" value="<?php echo $ti027; ?>"   /></td>
	    
	  </tr>
	   <tr>
	    <td  class="normal14a">菸酒註記：</td>						
        <td  class="normal14"  ><input type="hidden" name="ti024" value="N" />
		<input type='checkbox' tabIndex="25" id="ti020" onKeyPress="keyFunction()" name="ti020" <?php if($ti020 == 'Y' ) echo 'checked'; ?>  <?php if($ti020 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
       
	    <td class="normal14" ></td>
        <td class="normal14"></td>       
	    
	  </tr>
	  
	</table>
 
	</div> 	
		
	
	</div> <!-- </div>div-8 -->
	 </div> <!--</div>  div-7 -->
	 
	 <div style="width:100%; overflow-x: auto;  ">
        <table style="width:100%;"  id="order_product" class="list1">
        <thead>
            <tr>
              <td width="3%"></td>			
		      <td width="11%" class="center">品號</td>
              <td width="6%" class="left">品名</td>
			  <td width="6%" class="left">規格</td>  
			  <td width="6%" class="center">單位</td>
			  <td width="6%" class="center">序號</td>
			  <td width="6%" class="left">退貨庫別</td>
		 	  <td width="6%" class="left">庫別名稱</td> 
			  <td width="6%" class="center">數量</td>
              <td width="6%" class="right">單價</td>
			  <td width="6%" class="right">金額</td>
              <td width="6%" class="right">原幣金額</td>
			  <td width="6%" class="center">原幣稅額</td>
              <td width="6%" class="right">本幣金額</td>
			  <td width="6%" class="center">本幣稅額</td>
			  <td width="6%" class="center">進貨單別</td>
              <td width="6%" class="right">進貨單號</td>
              <td width="6%" class="right">進貨單序號</td>
              <td width="6%" class="right">採購單別</td>
			  <td width="6%" class="right">採購單號</td>
			  <td width="6%" class="right">採購序號</td>
			  <td width="6%" class="right">類型</td>
			  <td width="14%" class="center">備註</td>
			  
            </tr>
        </thead>
	
		
          <tfoot>
		 
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="22"></td>
            </tr>
          </tfoot>
       </table>
	</div> 	
	<!-- 合計     -->
		     <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span>
				</span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　原幣總額：</b></td>
				<td ><input type='text' readonly="value" name='ti011' id="ti011" size="8" value="<?php echo $ti011; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='ti015' id="ti015" size="8" value="<?php echo $ti015; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣合計：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot"><?php echo $ti011+$ti015; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣總額：</b></td>
				<td ><input type='text' readonly="value" name='ti028' id="ti028" size="8" value="<?php echo $ti028; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='ti029' id="ti029" size="8" value="<?php echo $ti029; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣合計：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot1"><?php echo $ti028+$ti029; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　合計數量：</b></td>
				<td ><input type='text' readonly="value" name='ti022' id="ti022" size="8" value="<?php echo $ti022; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	  
	 <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pur/puri11/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	<!-- <b style="color: #FF0000;"><span>&nbsp;&nbsp;複製前置單據&nbsp;</span></b><a  href="javascript:;"><img id="Showpurc09a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/>  -->
	 </div> 
		</div> 	   
    </form>
	   <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位,交貨庫別,可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
	
    </div> <!-- div-6 -->
	
  </div> <!-- div-5 -->
 
</div> <!-- div-4 -->

 
   
	</div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
     <?php include("./application/views/fun/puri11_funjs_v.php"); ?> 
	 

 