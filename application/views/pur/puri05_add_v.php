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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 請購單資料建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button  style= "cursor:pointer" form="commentForm" onfocus="$('#puri04').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pur/puri05/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pur/puri05/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  $ta001=$this->input->post('ta001'); 
	  $ta001disp=$this->input->post('ta001'); 
      $ta002=$this->input->post('ta002');
	  if(!isset($ta013)) { $ta013=date("Y/m/d"); }
	 //  $ta007=$this->input->post('ta007');
	   if(!isset($ta007)) { $ta007='Y'; }
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="8%"><span class="required">請購單別：</span> </td>
        <td class="normal14a"  width="42%"><input tabIndex="1" id="puri04"    onKeyPress="keyFunction()" ondblclick="search_puri04_window()"  name="ta001"  onchange="check_puri04(this);check_title_no();"  value="<?php echo $ta001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showpuri04disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="puri04disp"> <?php    echo $ta001disp; ?> </span></td>
	      <td  class="normal14y" width="8%" >單據日期：</td>
        <td  class="normal14a" width="42%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta013" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="ta013"  value="<?php echo $ta013; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ta013,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		   </tr>	
		  
	  <tr>
	    <td class="start14a" ><span class="required">講購單號：</span> </td>
        <td class="normal14a" ><input tabIndex="3" id="ta002" onKeyPress="keyFunction()" onfocus="check_title_no();" name="ta002" value="<?php echo $ta002; ?>" size="30" type="text" required /></td>
		<td class="normal14">確認碼：</td>
        <td  class="normal14"  ><select id="ta007" onKeyPress="keyFunction()" name="ta007"  onchange="selappr(this)" tabIndex="8">
            <option <?php if($ta007 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($ta007 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($ta007 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td> 
	  </tr>
		
	  
		
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
		<li><a href="#tab1">基本資料</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  基本資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	  <?php
	  $ta003=date("Y/m/d");
	  $ta004=$this->input->post('ta004');
	  $ta005=$this->input->post('ta005');
	  $ta006=$this->input->post('ta006');
	  $ta007=$this->input->post('ta007');
	  $ta008=$this->input->post('ta008');
	  $ta009=$this->input->post('ta009');	
	  $ta010=$this->input->post('ta010');	
	  $ta011=$this->input->post('ta011');
   //   $palq01a=$this->input->post('ta012');
	  if (!isset($ta012)) {$ta012=$this->session->userdata('manager');}
    //  $ta014=$this->input->post('ta014');
	    if(!isset($ta014)) { $ta014=$username; } else {$ta014=$this->input->post('ta014');}
	  $ta015=$this->input->post('ta015');	
	  $ta016=$this->input->post('ta016');	
	  
	  $ta004disp=$this->input->post('ta004disp');
	  $ta010disp=$this->input->post('ta010');
	  $ta012disp=$this->input->post('ta012');
	  ?>
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="8%">請購部門：</td>
       <td class="normal14a"  width="38%" ><input type="text" tabIndex="10" ondblclick="search_cmsi05_window()" onKeyPress="keyFunction()" id="cmsi05"  name="cmsi05"  onblur="check_cmsi05(this)"    value="<?php echo  $ta004; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Showcmsi05disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
	      <span id="cmsi05disp" > <?php    echo $ta004disp; ?> </span></td>
	   <td class="normal14y"  width="8%" > 廠別：</td>
       <td class="normal14a"  width="38%" ><input type="text" tabIndex="10" ondblclick="search_cmsi02_window()" onKeyPress="keyFunction()" id="cmsi02"  onblur="check_cmsi02(this)" name="cmsi02"   value="<?php echo  $ta010; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	      <span id="cmsi02disp"> <?php    echo $ta010disp; ?> </span></td>
	 </tr>	
		  
	  <tr>
	   <td class="normal14z"  >請購人員：</td>
        <td class="normal14" ><input tabIndex="6" id="cmsi09" ondblclick="search_cmsi09_window()" onKeyPress="keyFunction()" name="cmsi09" onblur="check_cmsi09(this)"  value="<?php echo $ta012; ?>"  type="text"  size="12"  />
		  <a href="javascript:;"><img id="Showcmsi09disp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
          <span id="cmsi09disp"> <?php    echo $ta012disp; ?> </span></td>
	    <td class="normal14z" >請購日期：</td>
        <td class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta003" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta003"  value="<?php echo $ta003; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ta003,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		   </tr>
		
	  <tr>
	    <td  class="normal14z" >備註：</td>
        <td  class="normal14"  ><input type="text" tabIndex="8"  onKeyPress="keyFunction()"   id="ta006" name="ta006" value="<?php echo $ta006; ?>"   /></td>		   
	    <td  class="normal14z">簽核狀態：</td>		
        <td  class="normal14"  ><select id="ta016" tabIndex="12" readonly="value" onKeyPress="keyFunction()" name="ta016"   style="background-color:#EBEBE4" >
            <option <?php if($ta016 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($ta016 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($ta016 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($ta016 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($ta016 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($ta016 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($ta016 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($ta016 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
	  </tr>
	  <tr>
	    <td class="normal14z">來源別：</td>						
        <td  class="normal14b"  ><input type="text" tabIndex="10" readonly="value"  onKeyPress="keyFunction()" id="ta009" name="ta009"   value="<?php echo $ta009; ?>"  style="background-color:#EBEBE4"  /></td>
		<td class="normal14" >列印：</td>						
        <td  class="normal14b"  ><input type="text" tabIndex="11" readonly="value"  onKeyPress="keyFunction()" id="ta008" name="ta008"   value="<?php echo $ta008; ?>"  style="background-color:#EBEBE4"  /></td>
	  </tr>	
		
	  <tr>
	    <td  class="normal14z" >來源單別：</td>
        <td class="normal14b"><input type="text" tabIndex="12" readonly="value"  onKeyPress="keyFunction()"  id="ta005" name="ta005" value="<?php echo $ta005; ?>" style="background-color:#EBEBE4"  /></td>
	    <td class="normal14z">確認者：</td>
        <td  class="normal14b"  ><input type="text" tabIndex="13" readonly="value"  onKeyPress="keyFunction()" id="ta014" name="ta014"   value="<?php echo $ta014; ?>"  style="background-color:#EBEBE4"  /></td>
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
		
			<tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
            </tr>
          </tfoot>
       </table>
    </div>
	
	</div> <!-- div-8 -->
	</div> <!-- div-7 -->
	<!-- <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pur/puri05/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div> -->
	  
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
 <?php  include_once("./application/views/funnew/puri04e_funmjs_v.php"); ?> <!-- 請購單別31 -->
<?php  include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?>  <!-- 人員 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?>  <!-- 部門 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/puri05_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#puri04').focus();
	}); 	   
</script> 
	