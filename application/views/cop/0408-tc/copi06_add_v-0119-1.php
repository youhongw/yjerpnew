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
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 客戶訂單資料建立作業</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?=base_url()?>index.php/cop/copi06/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  if(!isset($copq03a22)) { $copq03a22=$this->input->post('tc001'); }
	 if(!isset($copq03a22disp)) { $copq03a22disp=$this->input->post('tc001'); }
      $tc002=$this->input->post('tc002');
	  $tc003=date("Y/m/d");
	  $copq01a=$this->input->post('tc004'); 
	  $copq01adisp=$this->input->post('tc004'); 
	 //  $tc040=$this->input->post('tc040');
	   $tc025=$this->input->post('tc025');
	   $tc049=$this->input->post('tc049');
	   if(!isset($tc039)) { $tc039=date("Y/m/d"); }
	    if(!isset($tc040)) { $tc040=$username; }
	   if(!isset($tc050)) { $tc050="N"; }
	   if(!isset($tc027)) { $tc027="Y"; }
	   $tc029=0;$tc030=0;$tc031=0;$tc043=0;$tc044=0; 
	?>
   
	<table class="form12"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start12a"  width="10%"><span class="required">客戶訂單別：</span> </td>
        <td class="normal12a"  width="40%"><input tabIndex="1" id="tc001"    onKeyPress="keyFunction()"  name="copq03a22" onchange="startcopq03a22(this)"  value="<?php echo strtoupper($copq03a22); ?>"  type="text" required /><a href="javascript:;"><img id="Showcopq03a22" src="<?=base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="copq03a22disp"> <?php    echo $copq03a22disp; ?> </span></td>
	    <td class="normal12a" width="10%" ><span class="required">單據日期：</span> </td>
        <td class="normal12a"  width="40%" ><input tabIndex="2"  onclick="scwShow(this,event);" onfocus="selappr()" class="date" id="tc039" onKeyPress="keyFunction()"  onchange="chkno1(this)" name="tc039"  value="<?php echo $tc039; ?>"  size="12" type="text"   /></td>
	  </tr>	
	  <tr>
	    <td class="start12a" >訂單單號：</td>
        <td class="normal12a" ><input tabIndex="3" id="tc002" onKeyPress="keyFunction()" onfocus="chkno1(this)" name="tc002" value="<?php echo $tc002; ?>" size="30" type="text" required /><span id="tc002disp" ></span></td>
		 <td class="start12a">客戶代號：</td>
        <td  class="normal12"  ><input tabIndex="4" id="tc004" onKeyPress="keyFunction()" onfocus="chkno1(this)" onchange="startcopq01a(this)" name="copq01a" value="<?php echo $copq01a; ?>" size="10" type="text"  /><img id="Showcopq01a" src="<?=base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
        <span id="copq01adisp"> <?php   echo $copq01adisp; ?> </span></td>
	  </tr>
		
	  <tr>
	    <td class="start12b">確認者：</td>
        <td  class="normal12"  ><input type="text" tabIndex="5" readonly="value"  onKeyPress="keyFunction()" id="tc040" name="tc040"   value="<?php echo $tc040; ?>" style="background-color:#EBEBE4"  /></td>
		 <td class="start12b">訂單日期：</td>
        <td  class="normal12"  ><input type="text" tabIndex="6" readonly="value"  onKeyPress="keyFunction()" id="tc003" name="tc003"   value="<?php echo $tc003; ?>"  style="background-color:#EBEBE4" /></td>
	  </tr>
	   <tr>
	   <td class="start12b">流程代號：</td>
        <td  class="normal12"  ><input type="text" tabIndex="7" readonly="value"  onKeyPress="keyFunction()" id="tc049" name="tc049"   value="<?php echo $tc049; ?>" style="background-color:#EBEBE4"  /></td>
        <td class="normal12b">拋轉狀態：</td>
        <td  class="normal12"  ><select id="tc050" tabIndex="8" readonly="value" onKeyPress="keyFunction()" name="tc050"   style="background-color:#EBEBE4" >
            <option <?php if($tc050 == 'N') echo 'selected="selected"';?> value='N'>N.未拋轉</option>                                                                        
		    <option <?php if($tc050 == 'Y') echo 'selected="selected"';?> value='Y'>Y.拋轉成功(來源廠商)</option>
            <option <?php if($tc050 == 'y') echo 'selected="selected"';?> value='y'>y.拋轉成功(下游廠商)</option>
		    <option <?php if($tc050 == 'n') echo 'selected="selected"';?> value='n'>n.訂單變更</option>
            <option <?php if($tc050 == 'U') echo 'selected="selected"';?> value='U'>U.拋轉失敗</option>	
            <option <?php if($tc050 == 'u') echo 'selected="selected"';?> value='u'>u.還原失敗</option>	
		  </select></td>
		  <tr>
		  <td class="start14b">確認碼：</td>
          <td  class="normal14"  ><select id="tc027" onKeyPress="keyFunction()" name="tc027" onChange="selappr(this)" tabIndex="9">
            <option <?php if($tc027 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tc027 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tc027 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>  
		 <td class="start14"></td>
        <td  class="normal14"  ></td>
		
	  </tr>
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
		<li><a href="#tab1"><img src="<?=base_url()?>assets/image/png/label-2.png" title="" align="center" />&nbsp;交易資料</a></li>
		<li><a href="#tab2"><img src="<?=base_url()?>assets/image/png/label-3.png" title="" align="center" />&nbsp;地址</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  交易資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	  <?php
	   $tc003=date("Y/m/d");
        	  
	   $cmsq05a=$this->input->post('tc005');
	   $cmsq05adisp=$this->input->post('tc005');
	   
	   $cmsq09a3=$this->input->post('tc006');	
	   $cmsq09a3disp=$this->input->post('tc006');
        $cmsq02a=$this->input->post('tc007');	
	   $cmsq02adisp=$this->input->post('tc007');		   
	      $cmsq06a=$this->input->post('tc008');	
	   $cmsq06adisp=$this->input->post('tc008');
	   
	   $tc009=$this->input->post('tc009');
	   $tc012=$this->input->post('tc012');
	    $tc013=$this->input->post('tc013');
		 $cmsq21a2=$this->input->post('tc014');
	     $cmsq21a2disp=$this->input->post('tc014');
		 $tc041=$this->input->post('tc041');
		 $tc045=$this->input->post('tc045');
	  // $tc026=$this->input->post('tc026');
	
	   // if(!isset($tc026)) { $tc026=0.05; }
		if(!isset($ta026)) { $ta026=$this->session->userdata('sysma004'); }
	   $tc012=$this->input->post('tc012');
	//   $cmsq02a=$this->input->post('tc007');
	//   $cmsq02adisp=$this->input->post('tc007');
	   $tc016=$this->input->post('tc016');
	    $tc017=$this->input->post('tc017');
	   $tc009=$this->input->post('tc009');
	   $tc028=$this->input->post('tc028');
	   
	   $cmsq21a1=$this->input->post('tc027');
       $cmsq02a=$this->input->post('tc010');	
	   $cmsq09a4=$this->input->post('tc011');
	   $cmsq05a=$this->input->post('tc005');
	   
	   $cmsq02adisp=$this->input->post('tc010');	
	   $cmsq09a4disp=$this->input->post('tc011');
	   $cmsq05adisp=$this->input->post('tc005');
	   $cmsq21a1disp=$this->input->post('tc027');
	   
	   $tc019=$this->input->post('tc019');
	   $tc020=$this->input->post('tc020');
	   $tc023=$this->input->post('tc023');
	   $tc048=$this->input->post('tc048');
	  ?>
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="start14a"  width="10%">部門代號：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="10" onKeyPress="keyFunction()" id="tc005"  name="cmsq05a"  onchange="startcmsq05a(this)"    value="<?php echo  $cmsq05a; ?>"     /><a href="javascript:;"><img id="Showcmsq05a" src="<?=base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
	   <span id="cmsq05adisp" > <?php    echo $cmsq05adisp; ?> </span></td>
	   <td class="start14"  width="10%">業務人員：</td>
        <td class="normal14a"  width="40%" ><input tabIndex="6" id="tc006" onKeyPress="keyFunction()" name="cmsq09a3" onchange="startcmsq09a3(this)"  value="<?php echo $cmsq09a3; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq09a3" src="<?=base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
        <span id="cmsq09a3disp"> <?php    echo $cmsq09a3disp; ?> </span></td>
	 </tr>	
		<tr>
	   <td class="start14a"  width="10%">廠別：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="10" onKeyPress="keyFunction()" id="tc007"  onchange="startcmsq02a(this)" name="cmsq02a"   value="<?php echo  $cmsq02a; ?>"     /><a href="javascript:;"><img id="Showcmsq02a" src="<?=base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	   <span id="cmsq02adisp"> <?php    echo $cmsq02adisp; ?> </span></td>
	   <td class="start14a"  >幣別：</td>
        <td class="normal14" ><input tabIndex="11" id="tc008" onKeyPress="keyFunction()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq06a" src="<?=base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span></td>
	 </tr>	  
	  <tr>
	   <td class="normal14" >匯率：</td>		
        <td class="normal14"  ><input type="text" id="tc009"   tabIndex="12"   onKeyPress="keyFunction()"    name="tc009" value="<?php echo $tc009; ?>"  /></td>
	    <td class="normal14" >客戶單號：</td>		
        <td class="normal14"  ><input type="text" id="tc012"   tabIndex="13"   onKeyPress="keyFunction()"    name="tc012" value="<?php echo $tc012; ?>"  /></td>
	  </tr>
	    <tr>
		<td class="normal14" >價格條件：</td>		
        <td class="normal14"  ><input type="text" id="tc013"   tabIndex="14"   onKeyPress="keyFunction()"    name="tc013" value="<?php echo $tc013; ?>"  /></td>
	   <td  class="start14a" >付款條件：</td>
        <td  class="normal14"  ><input tabIndex="15" id="tc014" onKeyPress="keyFunction()" name="cmsq21a2" onchange="startcmsq21a2(this)"   value="<?php echo  $cmsq21a2; ?>"     type="text"  /><a href="javascript:;"><img id="Showcmsq21a2" src="<?=base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="cmsq21a2disp"> <?php    echo $cmsq21a2disp; ?> </span></td>
	    
	  </tr>
	  <tr>
	   <td class="normal14" >營業稅率：</td>		
        <td class="normal14"  ><input type="text" id="tc041"   tabIndex="16"   onKeyPress="keyFunction()"    name="tc041" value="<?php echo $tc041; ?>"  /></td>
	    <td class="normal14" >訂金比率：</td>		
        <td class="normal14"  ><input type="text" id="tc045"   tabIndex="17"   onKeyPress="keyFunction()"    name="tc045" value="<?php echo $tc045; ?>"  /></td>
	  </tr>
	 
	   <tr>
	   <td class="start14a"  >課稅別：</td>
        <td class="normal14" ><select id="tc016" onKeyPress="keyFunction()" name="tc016"  tabIndex="18">
		    <option <?php if($tc016 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php if($tc016 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php if($tc016 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php if($tc016 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php if($tc016 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select></td>
	    <td class="normal14b" >列印：</td>
        <td class="normal14"  ><input type="text"  readonly="value" tabIndex="19"   onKeyPress="keyFunction()"   name="tc028" value="<?php echo $tc028; ?>" style="background-color:#EBEBE4"  /></td>
	  </tr>
		
	  <tr>
	     <td class="normal14b">簽核狀態：</td>
        <td  class="normal14"  ><select id="tc048" tabIndex="21" readonly="value" onKeyPress="keyFunction()" name="tc048"   style="background-color:#EBEBE4" >
            <option <?php if($tc048 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tc048 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($tc048 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tc048 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tc048 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tc048 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tc048 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tc048 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>		   
	    <td  class="start14a"></td>		
        <td  class="start14"  ></td>
	  </tr>
	</table>
	</div>
	
<!--	
	<!--  地址 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	  <?php
	   $tc010=$this->input->post('tc010');
	   $tc011=$this->input->post('tc011');
	   $tc015=$this->input->post('tc015');
	  ?>
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="start14a"  width="20%">送貨地址(1)：</td>
       <td class="normal14a"  width="30%" ><input type="text" tabIndex="22"   onKeyPress="keyFunction()" id="tc010" name="tc010" size="120"  value="<?php echo $tc010; ?>"   />
	   <td class="start14a"  width="20%" ></td>
       <td class="normal14a"  width="30%" ></td>
	 </tr>			  
	 
	  <tr>
	    <td class="normal14">送貨地址(2)：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="23"   onKeyPress="keyFunction()" id="tc011" name="tc011"  size="120"   value="<?php echo $tc011; ?>"    /></td>
		<td class="normal14" ></td>						
        <td  class="normal14"  ></td>
	  </tr>	
	   <tr>
	    <td class="normal14">備註：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="24"   onKeyPress="keyFunction()" id="tc015" name="tc015"  size="120"   value="<?php echo $tc015; ?>"    /></td>
		<td class="normal14" ></td>						
        <td  class="normal14"  ></td>
	  </tr>	
	  <tr>
		<td class="normal14"></td>
        <td class="normal14"></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	</table>
 
	</div> 	
	
	
	</div> <!-- </div>div-8 -->
	 </div> <!--</div>  div-7 -->
	 
	 <div style="width:100%; overflow-x: auto;  ">
        <table style="width:100%;"  id="order_product" class="list">
        <thead>
            <tr>
              <td width="3%"></td>			
		      <td width="11%" class="center">品號</td>
              <td width="15%" class="left">品名</td>
			  <td width="15%" class="left">規格</td>  
			  <td width="6%" class="center">單位</td>
			  <td width="6%" class="center">序號</td>
			  <td width="6%" class="left">交貨庫別</td>
		 	  <td width="6%" class="left">庫別名稱</td> 
			  <td width="6%" class="left">預交日期</td>
              <td width="6%" class="center">訂單數量</td>
              <td width="6%" class="right">訂單單價</td>
              <td width="6%" class="right">訂單金額</td>
			  <td width="6%" class="center">己交數量</td>
			  <td width="6%" class="center">毛重</td>
			  <td width="6%" class="center">材積</td>
			  <td width="6%" class="center">客戶品號</td>
			  <td width="14%" class="center">備註</td>
			  <td width="6%" class="center">結案碼</td>
            </tr>
        </thead>
          <tfoot>
		 
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?=base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="19"></td>
            </tr>
          </tfoot>
       </table>
	</div> 	
	<!-- 合計     -->
		     <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">訂單金額：</b></td>
				<td ><input type='text' readonly="value" name='tc029' id="tc019" size="8" value="<?php echo $tc029; ?>"  style="background-color:#EBEBE4" /></td>
			<!--	<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_total"></span></b></td>  -->
				<td class="right" valign="top"><b style="color: #003A88;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;稅額：</b></td>
				<td ><input type='text' readonly="value" name='tc030' id="tc030" size="8" value="<?php echo $tc030; ?>"  style="background-color:#EBEBE4" /></td>
			<!--	<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tax"></span></b></td> -->
				<td class="right" valign="top"><b style="color: #003A88;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;合計金額：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot"></span></b></td>
				<td class="right" valign="top"><b style="color: #003A88;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;總數量：</b></td>
				<td ><input type='text' readonly="value" name='tc031' id="tc031" size="8" value="<?php echo $tc031; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;總毛重：</b></td>
				<td ><input type='text' readonly="value" name='tc043' id="tc043" size="8" value="<?php echo $tc043; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;總材積：</b></td>
				<td ><input type='text' readonly="value" name='tc044' id="tc044" size="8" value="<?php echo $tc044; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="left" valign="top"></td>
              </tr>
		<!-- 合計     -->	  
	 <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?=base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cop/copi06/display'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
	 </div> 
		</div> 	   
    </form>
	   <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 品號欄位,交貨庫別,可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
	
    </div> <!-- div-6 -->
	
  </div> <!-- div-5 -->
 
</div> <!-- div-4 -->

 
   
	</div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
     <?php include("./application/views/fun/copi06_funjs_v.php"); ?>