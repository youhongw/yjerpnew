<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--   <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div> -->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>  
    </div>

<div id="content"> <!-- div-3 --> 
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 報價單資料建立作業 -新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div> -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/cop/copi05/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  
	  if(!isset($ta001)) { $ta001=$this->input->post('ta001'); }
	  if(!isset($ta001disp)) { $ta001disp=$this->input->post('ta001disp'); }
	  if(!isset($ta002)) { $ta002=$this->input->post('ta002'); } 
	  if(!isset($ta003)) { $ta003=date("Y/m/d"); }
	  if(!isset($ta004)) { $ta004=$this->input->post('ta004'); }
	  if(!isset($ta004disp)) { $ta004disp=$this->input->post('ta004disp'); }
	  if(!isset($ta003)) { $ta003=date("Y/m/d"); }
	  
	  if(!isset($ta005)) { $ta005=$this->input->post('ta005'); }
	  if(!isset($ta005disp)) { $ta005disp=$this->input->post('ta005disp'); }
	  if(!isset($ta006)) { $ta006=$this->input->post('ta006'); }
	  $ta007=$this->session->userdata('sysma003');  //幣別
	  if(!isset($ta007disp)) {$ta007disp=$this->input->post('ta007disp');}
	 
	   if(!isset($ta008)) { $ta008=1; }
	//  $ta008=$this->input->post('ta008'); 一筆存檔清空白
	  if(!isset($ta009)) {$ta009=$this->input->post('ta009');}
	  if(!isset($ta010)) {$ta010=$this->input->post('ta010'); }
	  if(!isset($ta011)) {$ta011=$this->input->post('ta011');}
	  if(!isset($ta011disp)) {$ta011disp=$this->input->post('ta011disp');}
	  if(!isset($ta012)) { $ta012='2'; }
	  if(!isset($ta013)) { $ta013=date("Y/m/d"); }
	  if(!isset($ta014)) { $ta014=$this->input->post('ta014');}
	  if(!isset($ta015)) { $ta015=$username; }
	  if(!isset($ta016)) { $ta016='N'; }
	  if(!isset($ta017)) { $ta017='1'; }
	  if(!isset($ta018)) {$ta018=$this->input->post('ta018');}
	   
	  if(!isset($ta019)) { $ta019='Y'; }
	  if(!isset($ta022)) { $ta022='2'; }
		
	  if(!isset($ta020)) {$ta020=$this->input->post('ta020');}
	  if(!isset($ta021)) {$ta021=$this->input->post('ta021');}
	  if(!isset($ta023)) { $ta023=$this->input->post('ta023');}
	  //  $ta024=$this->input->post('ta024');
	  if(!isset($ta024)) { $ta024=$this->session->userdata('sysma004'); }
	  if(!isset($ta025)) { $ta025=$this->input->post('ta025');}
	  if(!isset($ta027)) { $ta027=$this->input->post('ta027');}
	  if(!isset($ta028)) { $ta028=$this->input->post('ta028');}
	  if(!isset($ta030)) { $ta030=$this->input->post('ta030');}
      if(!isset($ta029)) { $ta029='N'; }
	  if(!isset($sysma200)) { $sysma200=$this->session->userdata('sysma200'); }
	  if(!isset($sysma201)) { $sysma201=$this->session->userdata('sysma201'); }
	   
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="8%"><span class="required">報價單別：</span> </td>
        <td class="normal14a"  width="20%"><input tabIndex="1" id="copi03"    onKeyPress="keyFunction()"   name="ta001" onfocus="check_title_no();selverify();" onchange="check_copi03(this);check_title_no();"  value="<?php echo $ta001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showcopi03disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="copi03disp"> <?php    echo $ta001disp; ?> </span></td>
	    <td class="normal14a" width="8%" >單據日期： </td>
        <td class="normal14a"  width="22%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta013" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="ta013"  value="<?php echo $ta013; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ta013,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		<td class="start14a" width="10%" ><span class="required">報價單號：</span> </td>
        <td class="normal14a"  width="20%" ><input tabIndex="3" id="ta002" onKeyPress="keyFunction()" readonly="value" name="ta002" onfocus="check_title_no();" value="<?php echo $ta002; ?>" size="12" type="text" required /></td>
	  </tr>		
	  <tr>
		<td class="normal14">客戶代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="copi01" onKeyPress="keyFunction()" ondblclick="search_copi01_window()"  onchange="check_copi01(this)" name="ta004" value="<?php echo $ta004; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="copi01disp"> <?php   echo $ta004disp; ?> </span></td>	    
	    <td class="normal14" >幣別：</td>
        <td class="normal14a" ><input tabIndex="11" id="cmsi06" ondblclick="search_cmsi06_window()" onKeyPress="keyFunction()" name="ta007" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $ta007; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $ta007disp; ?> </span></td>
		<td class="normal14" >業務人員：</td>
        <td class="normal14a" ><input tabIndex="6" id="cmsi09" ondblclick="search_cmsi09_window()" onKeyPress="keyFunction()" name="ta005" onblur="check_cmsi09(this)"  value="<?php echo $ta005; ?>"  type="text"  size="12"  />
		  <a href="javascript:;"><img id="Showcmsi09disp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
          <span id="cmsi09disp"> <?php    echo $ta005disp; ?> </span></td>
	  </tr>
	  <tr>
	    <td class="normal14" >付款條件：</td>
        <td class="normal14a" ><input tabIndex="15" id="cmsi21" ondblclick="search_cmsi21_window()" onKeyPress="keyFunction()" name="ta011" onblur="check_cmsi21(this)"   value="<?php echo  $ta011; ?>"   size="12"   type="text"  />
		  <a href="javascript:;"><img id="Showcmsi21disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
          <span id="cmsi21disp"> <?php    echo $ta011disp; ?> </span></td>
		<td class="normal14" >價格條件：</td>
        <td class="normal14a" ><input type="text" tabIndex="8"  onKeyPress="keyFunction()" id="ta010" name="ta010"   value="<?php echo $ta010; ?>"  /></td>
		<td class="normal14" >訂貨起幾日交：</td>
        <td class="normal14a" ><input type="text" tabIndex="9"  onKeyPress="keyFunction()" id="ta014" name="ta014" size="5"  value="<?php echo $ta014; ?>"  /></td>
	   
	  </tr> 
	  <tr>
		<td class="normal14">匯率：</td>
        <td  class="normal14"  ><input type="text" tabIndex="10"  onKeyPress="keyFunction()" id="ta008" name="ta008"   value="<?php echo $ta008; ?>"  /></td>
	    <td class="normal14" >營業稅率：</td>
        <td class="normal14a" ><input type="text" tabIndex="11"  onKeyPress="keyFunction()" id="ta024" name="ta024"   value="<?php echo $ta024; ?>"  /></td>
		<td class="normal14" >列印格式：</td>
        <td class="normal14a" ><select id="ta017" onKeyPress="keyFunction()" name="ta017"   tabIndex="12">
            <option <?php if($ta017 == '1') echo 'selected="selected"';?> value='1'>1中式</option>                                                                        
		    <option <?php if($ta017 == '2') echo 'selected="selected"';?> value='2'>2英式</option>
		  </select></td> 
	  
	  </tr>
	   <tr>
		<td class="normal14">客戶全名：</td>
        <td  class="normal14"  ><input type="text" tabIndex="13"  onKeyPress="keyFunction()" id="ta006" name="ta006"   value="<?php echo $ta006; ?>"  /></td>
	    <td class="normal14" >備註一：</td>
        <td class="normal14a" ><input type="text" tabIndex="14"  onKeyPress="keyFunction()" id="ta020" name="ta020"   value="<?php echo $ta020; ?>"  /></td>
		<td class="normal14" >客戶確認：</td>
        <td class="normal14a" ><input type="hidden" name="ta016" value="N" />
		<input type='checkbox' tabIndex="15" id="ta016" onKeyPress="keyFunction()" name="ta016" <?php if($ta016 == 'Y' ) echo 'checked'; ?>  <?php if($ta016 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
	  
	  </tr>
	  <tr>
	    <td class="normal14" >課稅別：</td>
        <td class="normal14" ><select id="ta022" onKeyPress="keyFunction()" name="ta022" onchange="taxa()" tabIndex="16">
		    <option <?php if($ta022 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php if($ta022 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php if($ta022 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php if($ta022 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php if($ta022 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select></td>
		<td class="normal14">確認碼：</td>
        <td  class="normal14"  ><select id="ta019" onKeyPress="keyFunction()" name="ta019"  onchange="selappr(this)" tabIndex="17">
            <option <?php if($ta019 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($ta019 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
		  </select><span  id="approved" ></span></td>  
	    <td class="normal14" >列印次數：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="18"  readonly="value"  onKeyPress="keyFunction()" id="ta018" name="ta018" size="5"  value="<?php echo $ta018; ?>" style="background-color:#F5F5F5" /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >報價日期：</td>
        <td class="normal14"  ><input type="text"   tabIndex="19"  readonly="value" onKeyPress="keyFunction()"   name="ta003" value="<?php echo $ta003; ?>" style="background-color:#F5F5F5"  /></td>
	     <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input tabIndex="20" id="ta015" readonly="value" onKeyPress="keyFunction()"  name="ta015" value="<?php echo $ta015; ?>" size="10" type="text" style="background-color:#F5F5F5"  /></td>
  
		 <td class="normal14">簽核狀態：</td>
        <td  class="normal14"  ><select id="ta029" tabIndex="21" readonly="value" onKeyPress="keyFunction()" name="ta029"   style="background-color:#F5F5F5" >
            <option <?php if($ta029 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($ta029 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($ta029 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($ta029 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($ta029 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($ta029 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($ta029 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($ta029 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
		  <td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" /></td>
         <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" /></td>
	  </tr>
	</table>
		

	<div>
	 
	 <!-- 明細表頭  -->
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
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="15"></td>
            </tr>
          </tfoot>
       </table>
    </div>
	<!-- 合計     -->
		     <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span>
				</span></td>
			<!--	<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</span>  -->
				<td class="right" valign="top"><b style="color: #003A88;">　報價金額：</b></td>
				<td ><input type='text' readonly="value" name='ta009' id="ta009" size="8" value="<?php echo $ta009; ?>"  style="background-color:#F5F5F5" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta023' id="ta023" size="8" value="<?php echo $ta023; ?>"  style="background-color:#F5F5F5" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　合計金額：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;"><span id="sum_tot"><?php echo $ta009+$ta023; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　　總數量：</b></td>
				<td ><input type='text' readonly="value" name='ta025' id="ta025" size="8" value="<?php echo $ta025; ?>"  style="background-color:#F5F5F5" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　總毛重：</b></td>
				<td ><input type='text' readonly="value" name='ta027' id="ta027" size="8" value="<?php echo $ta027; ?>"  style="background-color:#F5F5F5" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　總材積：</b></td>
				<td ><input type='text' readonly="value" name='ta028' id="ta028" size="8" value="<?php echo $ta028; ?>"  style="background-color:#F5F5F5" /></td>
				
				
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	
	
	 <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cop/copi05/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
 <?php  include_once("./application/views/funnew/copi03_funmjs_v.php"); ?> <!-- 訂單單別 -->
<?php  include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?>  <!-- 人員 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/copi01a_funmjs_v.php"); ?>  <!-- 客戶回傳多欄 -->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?>  <!-- 部門 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->
<?php  include_once("./application/views/funnew/cmsi21_funmjs_v.php"); ?>  <!-- 付款條件 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/copi06_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#copi03').focus();
	}); 	   
</script> 