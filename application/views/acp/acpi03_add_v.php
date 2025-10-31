<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div> -->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content"> <!-- div-3 --> 
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 付款單資料建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#tc001').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('acp/acpi03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div>
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/acp/acpi03/addsave" >	
	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  if(!isset($tc001)) { $tc001=$this->input->post('tc001'); }
	 
	 if(!isset($tc001disp)) { $tc001disp=$this->input->post('tc001'); }
	//  $purq04a33disp=$this->input->post('tc001'); 
      $tc002=$this->input->post('tc002');
	  if(!isset($tc016)) { $tc016=date("Y/m/d"); }
	  if(!isset($tc003)) { $tc003=date("Y/m/d"); }
	  $tc004=$this->input->post('tc004'); 
	  $tc004disp=$this->input->post('tc004'); 
       
	  if(!isset($tc031)) { $tc031='N'; }
	  if(!isset($tc033)) { $tc033='N'; }
	  if(!isset($tc044)) { $tc044='N'; }
	  if(!isset($tc024)) { $tc024='Y'; }
	  if(!isset($tc017)) { $tc017=$username; }
	  
	  $tc028=$this->input->post('tc028');
	  $tc029=$this->input->post('tc029');
	  $tc037=$this->input->post('tc037');
	  $tc038=$this->input->post('tc038');
	  $tc030=$this->input->post('tc030');
	 
	?>
	 <?php
	   
	  // if(!isset($tc007)) { $tc007=0.05; } 幣別 稅率
	   $cmsq06a=$this->session->userdata('sysma003');
	   $tc036=$this->session->userdata('sysma004');
	   
	   
	   if(!isset($tc009)) { $tc009=1; }
	  
	   $tc021=$this->input->post('tc021');
	   $tc018=$this->input->post('tc018');
	   $tc019=$this->input->post('tc019');
	   $tc020=$this->input->post('tc020');
	   $tc040=$this->input->post('tc040');
	   $tc041=$this->input->post('tc041');
       $tc042=$this->input->post('tc042');	
       $tc027=$this->input->post('tc027');
       $tc026=$this->input->post('tc026');	
       $tc022=$this->input->post('tc022');
       $tc023=$this->input->post('tc023');	
	   
	    $tc005=$this->input->post('tc005');
	    $tc005disp=$this->input->post('tc005');	 
		IF (!isset($tc006)) { $tc006=$this->session->userdata('sysma003');}
	    $tc006disp=$this->input->post('tc006');
		IF (!isset($tc007)) { $tc007=$this->session->userdata('tc007');}
		
		IF (!isset($tc008)) { $tc008=$this->session->userdata('tc008');}
	    $tc008disp=$this->input->post('tc008');
		IF (!isset($tc010)) { $tc008=$this->session->userdata('tc010');}
	    $tc010disp=$this->input->post('tc010');
		$tc039=$this->input->post('tc039');
	    $tc039disp=$this->input->post('tc039');
	  ?>
	   <?php
	   $tc006=$this->input->post('tc006');
	   $tc010=$this->input->post('tc010');
	   $tc015=$this->input->post('tc015');
	   $tc014=$this->input->post('tc014');
	   $tc011=$this->input->post('tc011');
	   $tc012=$this->input->post('tc012');
	    if(!isset($tc032)) { $tc032=date("Y/m"); }
	 //  $tc032=$this->input->post('tc032');
	//   $tc036=$this->input->post('tc036');
	   $tc013=$this->input->post('tc013');
	  // $tc016=$this->input->post('tc016');
	 //  $tc017=$this->input->post('tc017');
	 
	  ?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="9%"><span class="required">付款單別：</span> </td>
        <td class="normal14a"  width="28%"><input tabIndex="1" id="acpi01"    onKeyPress="keyFunction()"   name="tc001" onfocus="check_title_no();" onchange="check_acpi01(this);check_title_no();"  value="<?php echo $tc001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showacpi01disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="acpi01disp"> <?php    echo $tc001disp; ?> </span></td>
	    <td class="normal14y" width="8%" >單據日期： </td>
        <td class="normal14a"  width="28%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tc016" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="tc016"  value="<?php echo $tc016; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tc016,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	     <td class="normal14y" width="9%"  ><span class="required">付款單號：</span></td>
        <td class="normal14a" width="28%" ><input tabIndex="3" id="tc002" onKeyPress="keyFunction()" onfocus="check_title_no();" name="tc002" value="<?php echo $tc002; ?>"  type="text" required /><span id="tc002disp" ></span></td>
	 </tr>	
	  <tr>
	      <td class="normal14z">供應廠商：</td>
          <td  class="normal14"  ><input tabIndex="4" id="puri01a" onKeyPress="keyFunction()" ondblclick="search_puri01a_window()"  onchange="check_puri01a(this);check_title_no();" name="tc004" value="<?php echo $tc004; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showpuri01adisp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="puri01adisp"> <?php   echo $tc004disp; ?> </span></td>
        
	     <td class="normal14y"  >廠別：</td>
       <td class="normal14a"   ><input type="text" tabIndex="10" ondblclick="search_cmsi02_window()" onKeyPress="keyFunction()" id="cmsi02"  onblur="check_cmsi02(this)" name="tc010"   value="<?php echo  $tc010; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	      <span id="cmsi02disp"> <?php    echo $tc010disp; ?> </span></td>
		  
		<td class="normal14y"  >幣別：</td>
        <td class="normal14" ><input tabIndex="11" id="cmsi06" ondblclick="search_cmsi06_window()" onKeyPress="keyFunction()" name="tc008" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $tc005; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $tc005disp; ?> </span></td>	
	 
	  </tr>
	  <tr>
	    <td class="normal14z" >備註：</td>
        <td class="normal14" ><input tabIndex="7" id="tc007"   onKeyPress="keyFunction()"  name="tc007" value="<?php echo $tc007; ?>" size="30" type="text"   /></td>
		<td class="normal14z">確認碼：</td>
        <td  class="normal14"  ><select id="tc008" onKeyPress="keyFunction()" name="tc008"  onchange="selappr(this)" tabIndex="8">
            <option <?php if($tc008 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tc008 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
		  </select><span  id="approved" ></span></td>  
	    <td class="normal14z" >列印次數：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="10"  readonly="value"  onKeyPress="keyFunction()" id="tc006" name="tc006" size="5"  value="<?php echo $tc006; ?>" style="background-color:#EBEBE4" /></td>
	  </tr>
	  <tr>
	     <td class="normal14z">產生分錄：</td>
        <td  class="normal14"  ><input type="hidden" name="tc015" value="N" />
		<input type='checkbox' tabIndex="11" id="tc015"  readonly="value" onKeyPress="keyFunction()" name="tc015" <?php if($tc015 == 'Y' ) echo 'checked'; ?>  <?php if($tc015 !== 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled" /></td> 
	     <td class="normal14z">確認者：</td>
        <td  class="normal14"  ><input tabIndex="12" id="tc017" readonly="value" onKeyPress="keyFunction()"  name="tc017" value="<?php echo $tc017; ?>" size="10" type="text" style="background-color:#EBEBE4"  /></td>
  
		 <td class="normal14z">簽核狀態：</td>
        <td  class="normal14"  ><select id="tc018" tabIndex="12" readonly="value" onKeyPress="keyFunction()" name="tc018"   style="background-color:#EBEBE4" >
            <option <?php if($tc018 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tc018 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($tc018 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tc018 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tc018 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tc018 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tc018 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tc018 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
	  </tr>	
	  <tr>
	    <td class="normal14z" >付款日期：</td>
        <td class="normal14" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tc003" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tc003"  value="<?php echo $tc003; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tc003,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		 <td class="normal14"></td>
        <td  class="normal14"  ></td>  
	    <td class="normal14" ></td>						
        <td  class="normal14"  ></td>
	  </tr>
	  
	</table>
	
	 
	 <div style="width:100%; overflow-x: auto;  ">
        <table style="width:100%;"  id="order_product" class="list1">
        <thead>
            <tr>
              <td width="3%"></td>			
		      <?php foreach($usecol_array as $key => $val){
					echo "<td ";
					if(isset($val['width'])){
						echo "width='".$val['width']."' ";}
					if(isset($val['title_class'])){
						echo "class='".$val['title_class']."' ";}
					echo " >";
					echo $val['name'];
					echo "</td>";
				}?>
            </tr>
        </thead>
	
		
          <?php $current_product_count = 0;//依照資料庫紀錄的明細先列一遍 新增只給初值 ?>
          <tfoot>
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
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
				<input type='text' readonly="value" name="tc1112" id="ta1112" size="8" value="<?php echo $tc011-$tc012; ?>"  style="background-color:#F0F0F0" /></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　本幣借方金額：</b></td>
				<td ><input type='text' readonly="value" name='tc013' id="tc013" size="8" value="<?php echo $tc013; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　本幣貸方金額：</b></td>
				<td ><input type='text' readonly="value" name='tc014' id="tc014" size="8" value="<?php echo $tc014; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　差額：</b></td>
				<input type='text' readonly="value" name="tc1314" id="ta1314" size="8" value="<?php echo $tc013-$tc014; ?>"  style="background-color:#F0F0F0" /></td>
				<input id="select_rows" style="display:none;"/>
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	  
	<!-- <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('acp/acpi03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	 </div> -->
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
  <?php  include_once("./application/views/funnew/acpi01b_funmjs_v.php"); ?> <!-- 付款單別 -->
<?php  include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?>  <!-- 人員 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/puri01a_funmjs_v.php"); ?>  <!-- 廠商回傳多欄 -->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?>  <!-- 部門 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->
<?php  include_once("./application/views/funnew/cmsi21_funmjs_v.php"); ?>  <!-- 付款條件 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/acpi03_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#acpi01').focus();
	}); 	   
</script> 	
 