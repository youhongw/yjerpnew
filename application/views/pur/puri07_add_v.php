<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 採購單資料建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#puri04').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pur/puri07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pur/puri07/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  if(!isset($tc001)) { $tc001=$this->input->post('tc001'); }
	//  $purq04a33=$this->input->post('tc001'); 
	 if(!isset($tc001disp)) { $tc001disp=$this->input->post('tc001'); }
	//  $purq04a33disp=$this->input->post('tc001'); 
      $tc002=$this->input->post('tc002');
	  $tc003=date("Y/m/d");
	  $tc004=$this->input->post('tc004'); 
	  $tc004disp=$this->input->post('tc004');
      $tc005=$this->input->post('tc005'); 
	  $tc005disp=$this->input->post('tc005');
       $tc010=$this->input->post('tc010'); 
	  $tc010disp=$this->input->post('tc010'); 
      $tc011=$this->input->post('tc011'); 
	  $tc011disp=$this->input->post('tc011');
      $tc021=$this->input->post('tc021'); 
	  $tc021disp=$this->input->post('tc021');  	  
	  // $tc025=$this->input->post('tc025');
	    $tc025=$this->session->userdata('manager');
		 if(!isset($tc014)) { $tc014='Y'; }
	    $tc030=$this->input->post('tc030');
	  if(!isset($tc024)) { $tc024=date("Y/m/d"); }
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="10%"><span class="required">採購單別：</span> </td>
        <td class="normal14a"  width="40%"><input tabIndex="1" id="puri04"    onKeyPress="keyFunction()" ondblclick="search_puri04_window()"  name="tc001"  onchange="check_puri04(this);check_title_no();"  value="<?php echo $tc001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showpuri04disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="puri04disp"> <?php    echo $tc001disp; ?> </span></td>
	    <td class="normal14a" width="10%" >單據日期： </td>
        <td class="normal14a"  width="40%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tc024" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="tc024"  value="<?php echo $tc024; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(tc024,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td></tr>	
	  <tr>
	    <td class="start14a" ><span class="required">採購單號：</span></td>
        <td class="normal14a" ><input tabIndex="3" id="tc002" onKeyPress="keyFunction()" onfocus="check_title_no();" name="tc002" value="<?php echo $tc002; ?>" size="30" type="text" required /><span id="tc002disp" ></span></td>
		 <td class="normal14a">供應廠商：</td>
        <td  class="normal14"  ><input tabIndex="4" id="puri01" onKeyPress="keyFunction()" onfocus="check_title_no();" ondblclick="search_puri01_window()"  onchange="check_puri01(this)" name="tc004" value="<?php echo $tc004; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showpuri01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="puri01disp"> <?php   echo $tc004disp; ?> </span></td>
	  </tr>
		
	  <tr>
	   <td class="normal14">確認碼：</td>
          <td  class="normal14"  ><select id="tc014" onKeyPress="keyFunction()" name="tc014" onChange="selappr(this)" tabIndex="5">
            <option <?php if($tc014 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tc014 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tc014 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td> 
		 <td class="normal14">採購日期：</td>
        <td  class="normal14"  ><input type="text" tabIndex="6" readonly="value"  onKeyPress="keyFunction()" id="tc003" name="tc003"   value="<?php echo $tc003; ?>"  style="background-color:#EBEBE4" /></td>
	  </tr>
	   <tr>
        <td  class="normal14" >簽核狀態：</td>
		<td class="normal14"><select id="tc030" tabIndex="7" readonly="value" onKeyPress="keyFunction()" name="tc030"   style="background-color:#EBEBE4">
            <option <?php if($tc030 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tc030 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($tc030 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tc030 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tc030 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tc030 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tc030 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tc030 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
		 <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="8" readonly="value"  onKeyPress="keyFunction()" id="tc025" name="tc025"   value="<?php echo $tc025; ?>" style="background-color:#EBEBE4"  /></td>
	  </tr>
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
		<li><a href="#tab1"  accesskey="a">基本資料a</a></li>
		<li><a href="#tab2"  accesskey="b">地址b</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  基本資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	  <?php
	   $tc003=date("Y/m/d");
	  
	//   $tc006=$this->input->post('tc006');  
	        //匯率
	   if(!isset($tc006)) { $tc006=1; }
	  
	   $tc018=$this->input->post('tc018');
	  // $tc026=$this->input->post('tc026');
	
	    if(!isset($tc026)) { $tc026=0.05; }
	   $tc012=$this->input->post('tc012');
	   $tc007=$this->input->post('tc007');
	   $tc017=$this->input->post('tc017');
	   $tc009=$this->input->post('tc009');
	   $tc028=$this->input->post('tc028');
	   
	   $tc027=$this->input->post('tc027');
	   $tc027disp=$this->input->post('tc027');
	  // $cmsq09a4=$this->input->post('tc011');
	   $cmsq09a4=$this->session->userdata('manager');
	   $cmsq06a=$this->session->userdata('sysma003');
	   
	   $tc019=$this->input->post('tc019');
	   $tc020=$this->input->post('tc020');
	   $tc023=$this->input->post('tc023');
	   
	  ?>
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14a"  width="10%">廠別：</td>
       <td class="normal14a"  width="40%" >
	   <input tabIndex="9" id="cmsi02" ondblclick="search_cmsi02_window()" onKeyPress="keyFunction()" name="tc010" onblur="check_cmsi02(this);check_rate(this);"  value="<?php echo $tc010; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
          <span id="cmsi02disp"> <?php    echo $tc010disp; ?> </span></td>
	   <td class="normal14a"  width="10%" > 採購人員：</td>
       <td class="normal14a"  width="40%" >
	    <input tabIndex="9" id="cmsi09" ondblclick="search_cmsi09_window()" onKeyPress="keyFunction()" name="tc011" onblur="check_cmsi09(this);check_rate(this);"  value="<?php echo $tc011; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi09disp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
          <span id="cmsi09disp"> <?php    echo $tc011disp; ?> </span></td>
	 </tr>	
		  
	  <tr>
	   <td class="normal14a"  >幣別：</td>
        <td class="normal14" >
		  <input tabIndex="10" id="cmsi06" ondblclick="search_cmsi06_window()" onKeyPress="keyFunction()" name="tc005" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $tc005; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $tc005disp; ?> </span></td>
	    <td class="normal14" >匯率：</td>		
        <td class="normal14"  ><input type="text" id="tc006"   tabIndex="11"   onKeyPress="keyFunction()"    name="tc006" value="<?php echo $tc006; ?>"  /></td>
	  </tr>
	   <tr>
	   <td class="normal14a"  >課稅別：</td>
        <td class="normal14" ><select id="tc018" onKeyPress="keyFunction()" name="tc018"  tabIndex="12">
		    <option <?php if($tc018 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php if($tc018 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php if($tc018 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php if($tc018 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php if($tc018 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select></td>
		
		
	    <td class="normal14" >營業稅率：</td>
        <td class="normal14"  ><input type="text"   tabIndex="13"   onKeyPress="keyFunction()"   name="tc026" value="<?php echo $tc026; ?>"   /></td>
	  </tr>
		
	  <tr>
	    <td  class="normal14a" >付款條件：</td>
        <td  class="normal14"  >	   
	    <input tabIndex="14" id="cmsi21" ondblclick="search_cmsi21_window()" onKeyPress="keyFunction()" name="tc027" onblur="check_cmsi21(this);check_rate(this);"  value="<?php echo $tc027; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi21disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
          <span id="cmsi21disp"> <?php    echo $tc027disp; ?> </span></td>
		<td  class="normal14a">列印格式：</td>		
        <td  class="start14"  ><select id="tc012" onKeyPress="keyFunction()" name="tc012"  tabIndex="15">
            <option <?php if($tc012 == '1') echo 'selected="selected"';?> value='1'>中文</option>                                                                        
		    <option <?php if($tc012 == '2') echo 'selected="selected"';?> value='2'>英文</option>
		  </select></td>
	    
	  </tr>
	  <tr>
	    <td class="normal14">價格條件：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="16"   onKeyPress="keyFunction()" id="tc007" name="tc007"   value="<?php echo $tc007; ?>"    /></td>
		<td class="normal14" >運輸方式：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="17"   onKeyPress="keyFunction()" id="tc017" name="tc017"   value="<?php echo $tc017; ?>"  /></td>
	  </tr>	
		
	  <tr>
	    <td  class="normal14" >備註：</td>
        <td class="normal14"><input type="text" tabIndex="18"   onKeyPress="keyFunction()"  id="tc009" name="tc009" size="60" value="<?php echo $tc009; ?>"   /></td>
	    <td class="normal14">訂金比率：</td>
        <td  class="normal14"  ><input type="text" tabIndex="19" readonly="value"  onKeyPress="keyFunction()" id="tc028" name="tc028"   value="<?php echo $tc028; ?>"    /></td>
	  </tr>
	 
	 
	</table>
	</div>
	
<!--	
	<!--  地址 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	  <?php
	   $tc021=$this->input->post('tc021');
	   $tc022=$this->input->post('tc022');
	  ?>
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14a"  width="20%">送貨地址(1)：</td>
       <td class="normal14a"  width="30%" ><input type="text" tabIndex="17"   onKeyPress="keyFunction()" id="tc021" name="tc021" size="120"  value="<?php echo $tc021; ?>"   />
	   <td class="start14a"  width="20%" ></td>
       <td class="normal14a"  width="30%" ></td>
	 </tr>			  
	 
	  <tr>
	    <td class="normal14">送貨地址(2)：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="18"   onKeyPress="keyFunction()" id="tc022" name="tc022"  size="120"   value="<?php echo $tc022; ?>"    /></td>
		<td class="normal14" ></td>						
        <td  class="normal14"  ></td>
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
          <tfoot>
		 <?php $current_product_count = 0;//依照資料庫紀錄的明細先列一遍 新增只給初值 ?>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
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
				<td colspan="2" class="right"><span></span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　未稅總額：</b></td>
				<td ><input type='text'  name='tc019' id="tc019" size="8" value="<?php echo $tc019; ?>"  style="background-color:#EBEBE4" /></td>
			<!--	<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_total"></span></b></td>  -->
				<td class="right" valign="top"><b style="color: #003A88;">　　稅額：</b></td>
				<td ><input type='text'  name='tc020' id="tc020" size="8" value="<?php echo $tc020; ?>"  style="background-color:#EBEBE4" /></td>
			<!--	<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tax"></span></b></td> -->
				<td class="right" valign="top"><b style="color: #003A88;">　　合計金額：</b></td>
				<td ><input type='text' readonly="value" name='tc1920' id="tc1920" size="8" value="<?php echo $tc019+$tc020; ?>"  style="background-color:#EBEBE4" /></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　合計數量：</b></td>
				<td ><input type='text' readonly="value" name='tc023' id="tc023" size="8" value="<?php echo $tc023; ?>"  style="background-color:#EBEBE4" /></td>
				<input id="select_rows" style="display:none;"/>
				<td class="left" valign="top"></td>
              </tr>
		<!-- 合計     -->	  
	<!-- <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pur/puri07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
<?php  include_once("./application/views/funnew/puri04b_funmjs_v.php"); ?> <!-- 採購單別33 -->
<?php  include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?>  <!-- 人員 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/puri01_funmjs_v.php"); ?>  <!-- 廠商回傳多欄 -->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?>  <!-- 部門 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->
<?php  include_once("./application/views/funnew/cmsi21_funmjs_v.php"); ?>  <!-- 付款條件 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/puri07_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#puri04').focus();
	}); 	   
</script> 	 
<script type="text/javascript">
    $("#tc018").change(function(){
       $('#tc018 :selected').text();
	   $(this).val();
	 //  alert($('select[name=\'tc018\']').val());	  
	   return $(this).val();
});
	
</script>
 