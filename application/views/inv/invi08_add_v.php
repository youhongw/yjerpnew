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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 轉撥單資料建立作業 - 新增　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#invi04').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('inv/invi08/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/inv/invi08/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  $ta001=$this->input->post('ta001'); 
	  $ta001disp=$this->input->post('ta001'); 
      $ta002=$this->input->post('ta002');
	
	if(!isset($ta003)) { $ta003=date("Y/m/d"); }
	  $ta004=$this->input->post('ta004');	  
	  $ta004disp=$this->input->post('ta004');
	  $ta008=$this->input->post('ta008');
	  $ta008disp=$this->input->post('ta008');
	  $ta005=$this->input->post('ta005');
	  $ta006=$this->input->post('ta006');
	  $ta009='12';
	   $ta010=$this->input->post('ta010');
	    
		  
	     if(!isset($ta007)) { $ta007=0; }
	   if(!isset($ta011)) { $ta011=0; }
	   if(!isset($ta012)) { $ta012=0; }
	  // if(!isset($ta009)) { $ta009=1; }
	     $ta009=11;
	  
	    if(!isset($ta011)) { $ta011='N'; }
	
	   if(!isset($ta014)) { $ta014=date("Y/m/d"); }
	   
	   if(!isset($ta015)) { $ta015=$username; }
	     
	     if(!isset($ta013)) { $ta013='N'; }
	      if(!isset($ta017)) { $ta017='N'; }
	?>
     <?php 
	  if(!isset($sysma200)) { $sysma200=$this->session->userdata('sysma200'); }
	  if(!isset($sysma201)) { $sysma201=$this->session->userdata('sysma201'); }  ?>
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="10%"><span class="required">轉撥單別：</span> </td>
        <td class="normal14a"  width="22%"><input tabIndex="1" id="invi04"    onKeyPress="keyFunction()" ondblclick="search_invi04_window()"  name="ta001"  onchange="check_invi04(this);check_title_no();"  value="<?php echo $ta001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showinvi04disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="invi04disp"> <?php    echo $ta001disp; ?> </span></td>
	    <td class="normal14y" width="10%" >單據日期： </td>
        <td class="normal14a"  width="24%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta014" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="ta014"  value="<?php echo $ta014; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ta014,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		 <td class="normal14y" width="10%" ><span class="required">轉撥單號：</span> </td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="ta002" onKeyPress="keyFunction()" onfocus="check_title_no();" name="ta002" value="<?php echo $ta002; ?>" size="20" type="text" required /><span id="ta002disp" ></span></td>
	  </tr>		
	  <tr>
		<td class="normal14z">部門代號：</td>
        <td  class="normal14"  ><input tabIndex="9" id="cmsi05" ondblclick="search_cmsi05_window()" onKeyPress="keyFunction()" name="ta004" onblur="check_cmsi05(this);check_rate(this);check_title_no();"  value="<?php echo $ta004; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi05disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
          <span id="cmsi05disp"> <?php    echo $ta004disp; ?> </span></td>	    
	    <td class="normal14z" >廠別：</td>
        <td class="normal14a" ><input tabIndex="9" id="cmsi02" ondblclick="search_cmsi02_window()" onKeyPress="keyFunction()" name="ta008" onblur="check_cmsi02(this);check_rate(this);"  value="<?php echo $ta008; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
          <span id="cmsi02disp"> <?php    echo $ta008disp; ?> </span></td>
		<td class="normal14z" >備註：</td>
        <td class="normal14a" ><input type="text" tabIndex="6"  onKeyPress="keyFunction()" id="ta005" name="ta005"   value="<?php echo $ta005; ?>"  /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >件數：</td>
        <td class="normal14" ><input type="text" tabIndex="7"  onKeyPress="keyFunction()" id="ta010" name="ta010"   value="<?php echo $ta010; ?>"  /></td>
		<td class="normal14z">確認碼：</td>
        <td  class="normal14"  ><select id="ta006" onKeyPress="keyFunction()" name="ta006"  onchange="selappr(this)" tabIndex="8">
            <option <?php if($ta006 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($ta006 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($ta006 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>  
	    <td class="normal14" ></td>						
        <td  class="normal14"  ></td>
	  </tr>
	   
	   <tr>
	    <td class="normal14z" >轉撥日期：</td>
        <td class="normal14"  ><input type="text"   tabIndex="10"  readonly="value" onKeyPress="keyFunction()"   name="ta003" value="<?php echo $ta003; ?>" style="background-color:#EBEBE4"  /></td>
	     <td class="normal14z">確認者：</td>
        <td  class="normal14"  ><input tabIndex="11" id="ta015" readonly="value" onKeyPress="keyFunction()"  name="ta015" value="<?php echo $ta015; ?>" size="10" type="text" style="background-color:#EBEBE4"  /></td>
  
		 <td class="normal14z">簽核狀態：</td>
        <td  class="normal14"  ><select id="ta017" tabIndex="12" readonly="value" onKeyPress="keyFunction()" name="ta017"   style="background-color:#EBEBE4" >
            <option <?php if($ta017 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($ta017 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($ta017 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($ta017 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($ta017 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($ta017 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($ta017 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($ta017 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
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
				<td ><input type='text' readonly="value" name='ta011' id="ta011"  value="<?php echo $ta011; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　　　　　　　總金額：</b></td>
				<td ><input type='text' readonly="value" name='ta012' id="ta012"  value="<?php echo $ta012; ?>"  style="background-color:#EBEBE4" /></td>
				<!-- enter 鍵不會跳下一列       -->
				<input id="select_rows" style="display:none;"/>	
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	
	
	<!-- <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('inv/invi08/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
     <?php  include_once("./application/views/funnew/invi04b_funmjs_v.php"); ?> <!-- 異動單別11 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?>  <!-- 部門 -->
<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/invi08_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#invi04').focus();
	}); 	   
</script> 	
 