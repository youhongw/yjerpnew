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
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 核價單資料建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#tl001').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pur/puri03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	</div>
	 </div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pur/puri03/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  $tl001=$this->input->post('tl001'); 
	  $tl001disp=$this->input->post('tl001'); 
      $tl002=$this->input->post('tl002');
	
	  if(!isset($tl003)) { $tl003=date("Y/m/d"); }
	  $tl004=$this->input->post('tl004');
	  $tl004disp=$this->input->post('tl004');
	 // $cmsq06a=$this->input->post('tl005');
	   if(!isset($tl005)) { $tl005=$this->session->userdata('sysma003'); }
	
	  $tl005disp=$this->input->post('tl005');
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
	    <td class="normal14y"  width="10%"><span class="required">核價單別：</span> </td>
        <td class="normal14a"  width="22%"><input tabIndex="1" id="puri04"    onKeyPress="keyFunction()" ondblclick="search_puri04_window()"  name="tl001"  onchange="check_puri04(this);check_title_no();"  value="<?php echo $tl001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showpuri04disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="puri04disp"> <?php    echo $tl001disp; ?> </span></td>
	    <td class="normal14y" width="10%" >單據日期： </td>
        <td class="normal14a"  width="24%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tl010" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="tl010"  value="<?php echo $tl010; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(tl010,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		 <td class="normal14y" width="10%" ><span class="required">核價單號：</span> </td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="tl002" onKeyPress="keyFunction()" onfocus="check_title_no();" name="tl002" value="<?php echo $tl002; ?>" size="20" type="text" required /><span id="tl002disp" ></span></td>
	  </tr>		
		  
	  <tr>
		<td class="normal14z">供應廠商：</td>
        <td  class="normal14"  ><input tabIndex="4" id="puri01" onKeyPress="keyFunction()" onfocus="check_title_no();" ondblclick="search_puri01_window()"  onchange="check_puri01(this)" name="tl004" value="<?php echo $tl004; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showpuri01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="puri01disp"> <?php   echo $tl004disp; ?> </span></td>	    
	    <td class="normal14z" >幣別：</td>
        <td class="normal14a" ><input tabIndex="11" id="cmsi06" ondblclick="search_cmsi06_window()" onKeyPress="keyFunction()" name="tl005" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $tl005; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $tl005disp; ?> </span></td>
		<td class="normal14z" >備註：</td>
        <td class="normal14a" ><input  tabIndex="6"  id="tl007" onKeyPress="keyFunction()"   name="tl007"   value="<?php echo  $tl007; ?>" type="text"     /></td>
	  
	  </tr>
		<tr>
	    <td class="normal14z" >含稅：</td>
        <td class="normal14" ><input type="hidden" name="tl008" value="N" />
		<input type='checkbox' tabIndex="7" id="tl008"  readonly="value" onKeyPress="keyFunction()" name="tl008" <?php if($tl008 == 'Y' ) echo 'checked'; ?>  <?php if($tl008 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
		<td class="normal14z">確認碼：</td>
        <td  class="normal14"  ><select id="tl006" onKeyPress="keyFunction()" name="tl006"  onchange="selappr(this)" tabIndex="8">
            <option <?php if($tl006 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tl006 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tl006 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>  
	    <td class="normal14z" >列印次數：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="9"  readonly="value"  onKeyPress="keyFunction()" id="tl009" name="tl009" size="5"  value="<?php echo $tl009; ?>" style="background-color:#EBEBE4" /></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >核價日期：</td>
        <td class="normal14"  ><input type="text"   tabIndex="10"  readonly="value" onKeyPress="keyFunction()"   name="tl003" value="<?php echo $tl003; ?>" style="background-color:#EBEBE4"  /></td>
	     <td class="normal14z">確認者：</td>
        <td  class="normal14"  ><input tabIndex="11" id="tl011" readonly="value" onKeyPress="keyFunction()"  name="tl011" value="<?php echo $tl011; ?>" size="10" type="text" style="background-color:#EBEBE4"  /></td>
  
		 <td class="normal14z">簽核狀態：</td>
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
			  <td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
            </tr>
          </tfoot>
       </table>
    </div>
	
	
	 <!--<div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pur/puri03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
 <?php  include_once("./application/views/funnew/puri04a_funmjs_v.php"); ?> <!-- 核價單別32 -->
<?php  include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?>  <!-- 人員 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/puri01_funmjs_v.php"); ?>  <!-- 廠商回傳多欄 -->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?>  <!-- 部門 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->
<?php  include_once("./application/views/funnew/cmsi21_funmjs_v.php"); ?>  <!-- 付款條件 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/puri03_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#puri04').focus();
	}); 	   
</script> 
	  