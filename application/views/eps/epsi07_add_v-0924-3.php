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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 貨運通知單建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/eps/epsi07/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值
	  //預設稅率,廠別,幣別
       $stax_rate = $this->session->userdata('sysma004');
       $sysma200 = $this->session->userdata('sysma200');
	   
	 if(!isset($td003)) { $td003=$this->session->userdata('sysma003'); } else  {$td003=$this->input->post('td003');}
	  if(!isset($td017)) { $td017=$username; }
	  
	  if(!isset($td001)) { $td001=$this->input->post('td001'); }
	  if(!isset($td001disp)) { $td001disp=$this->input->post('td001disp'); }
	  if(!isset($td002)) { $td002=$this->input->post('td002'); } 
	  if(!isset($td003disp)) { $td003disp=$this->input->post('td003disp'); }
	  if(!isset($td004)) { $td004=date("Y/m/d"); } 
	  if(!isset($td005)) { $td005=$this->input->post('td005'); }
	  if(!isset($td006)) { $td006=$this->input->post('td006'); }
	  if(!isset($td007)) { $td007=$this->input->post('td007'); }
	  if(!isset($td008)) { $td008=$this->input->post('td008'); }
	  if(!isset($td009)) { $td009=$this->input->post('td009'); }
	  if(!isset($td010)) { $td010=$this->input->post('td010'); }
	  if(!isset($td011)) { $td011=$this->input->post('td011'); }
	  if(!isset($td012)) { $td012=$this->input->post('td012'); }
	  if(!isset($td013)) { $td013="Y"; }
	  if(!isset($td014)) { $td014=$this->input->post('td014'); }
	  if(!isset($td015)) { $td015=$this->input->post('td015'); }
	   if(!isset($td016)) { $td016=date("Y/m/d"); }
	 //  $td025=$this->input->post('td025');  一筆存檔清空白
	  if(!isset($td018)) { $td018="N"; }
	   if(!isset($td019)) { $td019=$this->input->post('td019'); }
	  //$this->session->unset_userdata('docno');
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="start14a"  width="9%"><span class="required">S/INO單別：</span></td>   <!--onchange="startepsi01(this);check_title_no();"    -->
        <td class="normal14a"  width="25%"><input tabIndex="1" id="epsi01"   ondblclick="search_epsi01_window()" onKeyPress="keyFunction()"   name="td001" onfocus="selverify();" onchange="check_epsi01(this);check_title_no();"  value="<?php echo $td001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showepsi01disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="epsi01disp"> <?php    echo $td001disp; ?> </span></td>
	    <td class="normal14a" width="8%" >單據日期： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="td016" onKeyPress="keyFunction()"  onblur="dateformat_ymd(this);check_title_no();" name="td017"  value="<?php echo $td016; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(td016,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	    <td class="start14a" width="9%"><span class="required">S/INO單號：</span></td>
        <td class="normal14a" width="24%"><input tabIndex="3" id="td002" onKeyPress="keyFunction()" onfocus="check_title_no();" name="td002"  value="<?php echo $td002; ?>" size="12" type="text" required /></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a"  >出貨廠別：</td>
        <td class="normal14" ><input tabIndex="13" id="cmsi02" ondblclick="search_cmsi02_window()" onKeyPress="keyFunction()" name="td003" onblur="check_cmsi02(this);"  value="<?php echo $td003; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
          <span id="cmsi02disp"> <?php    echo $td003disp; ?> </span></td>
	    <td class="normal14">運輸公司.：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5"   onKeyPress="keyFunction()" id="td005" name="td005"   value="<?php echo $td005; ?>"  size="12" /></td>
	    <td class="normal14">船名：</td>
        <td  class="normal14"  ><input type="text" tabIndex="6" readonly="value"  onKeyPress="keyFunction()" id="td006" name="td006"   value="<?php echo $td006; ?>" size="12" />
	       </td>
	  </tr>
	  
		 <tr>
	    <td class="normal14" >SIZE：</td>		
        <td class="normal14"  ><input type="text"   tabIndex="11"   onKeyPress="keyFunction()"    name="td007" value="<?php echo $td007; ?>"   /></td>
	    <td class="normal14" >航次：</td>		
        <td class="normal14"  ><input type="text"    tabIndex="11"   onKeyPress="keyFunction()"    name="td008" value="<?php echo $td008; ?>"   /></td>
	    <td class="normal14" >業務人員：</td>		
        <td class="normal14"  ><input tabIndex="6" id="cmsi09" ondblclick="search_cmsi09_window()" onKeyPress="keyFunction()" name="td009" onblur="check_cmsi09(this)"  value="<?php echo $td009; ?>"  type="text"  size="12"  />
		  <a href="javascript:;"><img id="Showcmsi09disp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
          <span id="cmsi09disp"> <?php    echo $td009disp; ?> </span></td>
		  </tr>
		<tr>
	    <td class="normal14" >貨櫃場：</td>		
        <td class="normal14"  ><input type="text"   tabIndex="11"   onKeyPress="keyFunction()"    name="td007" value="<?php echo $td007; ?>"   /></td>
	    <td class="normal14" >備註：</td>		
        <td class="normal14" colspan="2" ><input type="text"    tabIndex="11"   onKeyPress="keyFunction()"    name="td008" value="<?php echo $td008; ?>" size="60"  /></td>
	    <td class="normal14" ></td>		
        <td class="normal14"  ></td>
	    </tr>
	   <tr>
        <td class="normal14" >列印次數：</td>		
        <td class="normal14"  ><input type="text" id="td016"   tabIndex="17"   onKeyPress="keyFunction()"    name="td016" value="<?php echo $td016; ?>"   /></td>
	  	<td class="normal14a"  >運貨日期：</td>
        <td class="normal14" ><input type="text" tabIndex="18" readonly="value"  onKeyPress="keyFunction()" id="td003" name="td003"   value="<?php echo $td003; ?>" size="12"  style="background-color:#F0F0F0"/></td>
	    <td class="normal14a"  ></td>
        <td class="normal14" ></td>
		</tr>
		 <tr>
	    <td class="normal14">簽核狀態：</td>
        <td class="normal14"  ><select id="td018" tabIndex="19" readonly="value" onKeyPress="keyFunction()" name="td018"   style="background-color:#F0F0F0" >
            <option <?php if($td018 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($td018 == '0') echo 'selected="selected"';?> value='0'>0.待處理</option>
            <option <?php if($td018 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($td018 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($td018 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($td018 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($td018 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($td018 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
        <td class="normal14">確認碼：</td>
        <td  class="normal14"  ><select id="verify" onKeyPress="keyFunction()" name="td013" onChange="selverify(this)" tabIndex="20">
            <option <?php if($td013 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($td013 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($td013 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>
	     <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="21" readonly="value"  onKeyPress="keyFunction()" id="td017" name="td017"   value="<?php echo $td017; ?>" style="background-color:#F0F0F0" size="12" /></td>
	    </tr>
	</table>
	 
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
				
				<td class="right" valign="top"><b style="color: #003A88;">　原幣應付金額：</b></td>
				<td ><input type='text' readonly="value" name='th012' id="th012" size="8" value="<?php echo $th012; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='th013' id="th013" size="8" value="<?php echo $th013; ?>"  style="background-color:#F0F0F0" /></td>
			
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣應付總額：</b></td>
				<td ><input type='text' readonly="value" name="th1213" id="th1213" size="8" value="<?php echo $th012+$th013; ?>"  style="background-color:#F0F0F0" /></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　本幣應付金額：</b></td>
				<td ><input type='text' readonly="value" name='th020' id="th020" size="8" value="<?php echo $th020; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='th021' id="th021" size="8" value="<?php echo $th021; ?>"  style="background-color:#F0F0F0" /></td>
			
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣應付總額：</b></td>
				<td ><input type='text' readonly="value" name="th2021" id="th2021" size="8" value="<?php echo $th020+$th021; ?>"  style="background-color:#F0F0F0" /></td>
				
					<input id="select_rows" style="display:none;"/>
				<td class="left" valign="top"></td>
              </tr>
		<!-- 合計     -->	  
	 <div class="buttons">
	   <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('eps/epsi07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div> 
   </div> 	<!-- end 頁標籤 -->   
   </form>
	   <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位,交貨庫別,可輸入部份品號或品名下拉視窗選擇,圖示1客戶商品計價查詢,欄位淡黃色按2下開視窗查詢,按Enter鍵或Tab鍵跳下一個欄位,Alt+y跳到明細資料, Alt+w新增一筆明細. ] ' ?> </div>  <?php } ?>
	
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
   
	</div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->

<?php  include_once("./application/views/funnew/epsi01_funmjs_v.php"); ?> <!-- 單別 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/puri01_funmjs_v.php"); ?>  <!-- 廠商傳多欄 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->
<?php  include_once("./application/views/funnew/cmsi21_funmjs_v.php"); ?>  <!-- 付款條件 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/epsi07_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#epsi01').focus();
	}); 	   
</script> 	    	