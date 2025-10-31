<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
   <!--   <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 成本調整單建立作業 - 新增　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#invi04').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('inv/invi07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/inv/invi07/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  $tj001=$this->input->post('tj001'); 
	  $tj001disp=$this->input->post('tj001'); 
      $tj002=$this->input->post('tj002');
	
	if(!isset($tj003)) { $tj003=date("Y/m/d"); }
	  $tj004=$this->input->post('tj004');	  
	  $tj004disp=$this->input->post('tj004');
	  $tj005=$this->input->post('tj005');
	  $tj005disp=$this->input->post('tj005');
	  $tj006=$this->input->post('tj006');
	//  $tj007=$this->input->post('tj007');
	//   $tj008=$this->input->post('tj008');
	   if(!isset($tj007)) { $tj007=0; }
	   if(!isset($tj008)) { $tj008=0; }
	   if(!isset($tj009)) { $tj009=1; }
	   
	//  $tj008=$this->input->post('tj008');
	   if(!isset($tj010)) { $tj010='Y'; }
	    if(!isset($tj011)) { $tj011='N'; }
	
	   if(!isset($tj012)) { $tj012=date("Y/m/d"); }
	   
	   if(!isset($tj013)) { $tj013=$username; }
	       $tj014=$this->input->post('tj014');
	     if(!isset($tj015)) { $tj015='N'; }
	   
	?>
     <?php 
	  if(!isset($sysma200)) { $sysma200=$this->session->userdata('sysma200'); }
	  if(!isset($sysma201)) { $sysma201=$this->session->userdata('sysma201'); }  ?>
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="10%"><span class="required">調整單別：</span> </td>
        <td class="normal14a"  width="22%"><input tabIndex="1" id="invi04"    onKeyPress="keyFunction()" ondblclick="search_invi04_window()"  name="tj001"  onchange="check_invi04(this);check_title_no();"  value="<?php echo $tj001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showinvi04disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="invi04disp"> <?php    echo $tj001disp; ?> </span></td>
	    <td class="normal14y" width="10%" >單據日期： </td>
        <td class="normal14a"  width="24%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tj012" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="tj012"  value="<?php echo $tj012; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(tj012,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		<td class="normal14y" width="10%" ><span class="required">調整單號：</span> </td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="tj002" onKeyPress="keyFunction()" onfocus="check_title_no();" name="tj002" value="<?php echo $tj002; ?>" size="20" type="text" required /><span id="tj002disp" ></span></td>
	  </tr>		
	  <tr>
		<td class="normal14z">部門代號：</td>
        <td  class="normal14"  ><input tabIndex="9" id="cmsi05" ondblclick="search_cmsi05_window()" onfocus="check_title_no();" onKeyPress="keyFunction()" name="tj004" onblur="check_cmsi05(this);check_rate(this);"  value="<?php echo $tj004; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi05disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
          <span id="cmsi05disp"> <?php    echo $tj004disp; ?> </span></td>		    
	    <td class="normal14z" >廠別代號：</td>
        <td class="normal14a" ><input tabIndex="9" id="cmsi02" ondblclick="search_cmsi02_window()" onKeyPress="keyFunction()" name="tj005" onblur="check_cmsi02(this);check_rate(this);"  value="<?php echo $tj005; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
          <span id="cmsi02disp"> <?php    echo $tj005disp; ?> </span></td>
		<td class="normal14z" >備註：</td>
        <td class="normal14a" ><input type="text" tabIndex="6"  onKeyPress="keyFunction()" id="tj006" name="tj006"   value="<?php echo $tj006; ?>"  /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >產品分錄碼：</td>
        <td class="normal14" ><input type="hidden" name="tj011" value="N" />
		<input type='checkbox' tabIndex="7" id="tj011" onKeyPress="keyFunction()" name="tj011" <?php if($tj011 == 'Y' ) echo 'checked'; ?>  <?php if($tj011 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
		<td class="normal14z">確認碼：</td>
        <td  class="normal14"  ><select id="tj010" onKeyPress="keyFunction()" name="tj010"  onchange="selappr(this)" tabIndex="8">
            <option <?php if($tj010 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tj010 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
		  </select><span  id="approved" ></span></td>  
	    <td class="normal14z" >列印次數：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="9"  readonly="value"  onKeyPress="keyFunction()" id="tj009" name="tj009" size="5"  value="<?php echo $tj009; ?>" style="background-color:#EBEBE4" /></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >調整日期：</td>
        <td class="normal14"  ><input type="text"   tabIndex="10"  readonly="value" onKeyPress="keyFunction()"   name="tj003" value="<?php echo $tj003; ?>" style="background-color:#EBEBE4"  /></td>
	     <td class="normal14z">確認者：</td>
        <td  class="normal14"  ><input tabIndex="11" id="tj013" readonly="value" onKeyPress="keyFunction()"  name="tj013" value="<?php echo $tj013; ?>" size="10" type="text" style="background-color:#EBEBE4"  /></td>
  
		 <td class="normal14z">簽核狀態：</td>
        <td  class="normal14"  ><select id="tj015" tabIndex="12" readonly="value" onKeyPress="keyFunction()" name="tj015"   style="background-color:#EBEBE4" >
            <option <?php if($tj015 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tj015 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($tj015 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tj015 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tj015 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tj015 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tj015 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tj015 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
		<td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" /></td>
         <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" /></td>
	  </tr>
	</table>
		

	<div>
        <table id="order_product" class="list1">
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
				<td colspan="2" class="right"><span>
				</span></td>
				
				
				<td class="right" valign="top"><b style="color: #003A88;"> 　總數量：</b></td>
				<td ><input type='text' readonly="value" name='tj007' id="tj007"  value="<?php echo $tj007; ?>"  style="background-color:#EBEBE4" /></td>
				
				
				<td class="right" valign="top"><b style="color: #003A88;">　　　　　　　　　總金額：</b></td>
			
				<td ><input type='text' readonly="value" name='tj008' id="tj008"  value="<?php echo $tj008; ?>"  style="background-color:#EBEBE4" /></td>
				<!-- enter 鍵不會跳下一列       -->
               <input id="select_rows" style="display:none;"/>	

				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	
	
	<!-- <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('inv/invi07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div> -->
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
    <?php  include_once("./application/views/funnew/invi04c_funmjs_v.php"); ?> <!-- 異動單別11 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?>  <!-- 部門 -->
<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/invi07_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#invi04').focus();
	}); 	   
</script> 	
 