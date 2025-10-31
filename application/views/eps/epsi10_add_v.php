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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 出口費用建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/eps/epsi10/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值
	  //預設稅率,廠別,幣別
       $stax_rate = $this->session->userdata('sysma004');
       $sysma200 = $this->session->userdata('sysma200');
	   
	  if(!isset($th007)) { $th007=$sysma200; } else {$th007=$this->input->post('th007');}
	  if(!isset($th008)) { $th008=$this->session->userdata('sysma003'); } else  {$th008=$this->input->post('th008');}
	  if(!isset($th018)) { $th018=$username; }
	  
	  if(!isset($th001)) { $th001=$this->input->post('th001'); }
	  if(!isset($th001disp)) { $th001disp=$this->input->post('th001disp'); }
	  if(!isset($th002)) { $th002=$this->input->post('th002'); } 
	  if(!isset($th003)) { $th003=date("Y/m/d"); } 
	  if(!isset($th004)) { $th004=$this->input->post('th004'); }
	  if(!isset($th004disp)) { $th004disp=$this->input->post('th004disp'); }
	  if(!isset($th005)) { $th005=$this->input->post('th005'); }
	  if(!isset($th006)) { $th006=$this->input->post('th006'); }
	//  if(!isset($th007)) { $th007=$this->input->post('th007'); }
	  if(!isset($th007disp)) { $th007disp=$this->input->post('th007disp'); }
	//  if(!isset($th008)) { $th008=$this->input->post('th008'); }
	  if(!isset($th008disp)) { $th008disp=$this->input->post('th008disp'); }
	  if(!isset($th009)) { $th009=$this->input->post('th009'); }
	  if(!isset($th010)) { $th010=$this->input->post('th010'); }
	//  if(!isset($th011)) { $th011=$this->input->post('th011'); }
	//  if(!isset($th012)) { $th012=$this->input->post('th012'); }
	//  if(!isset($th013)) { $th013=$this->input->post('th013'); }
	//  if(!isset($th014)) { $th014=$this->input->post('th014'); }
	  if(!isset($th015)) { $th015=$this->input->post('th015'); }
	//  if(!isset($th016)) { $th016=$this->input->post('th016'); }
	//  if(!isset($th017)) { $th017=$this->input->post('th017'); }
	//  if(!isset($th018)) { $th018=$this->input->post('th018'); }
	//  if(!isset($th019)) { $th019=$this->input->post('th019'); }
	//  if(!isset($th020)) { $th020=$this->input->post('th020'); }
	//  if(!isset($th021)) { $th021=$this->input->post('th021'); }
	  if(!isset($th022)) { $th022=$this->input->post('th022'); }
	  if(!isset($th022disp)) { $th022disp=$this->input->post('th022disp'); }
	  if(!isset($th023)) { $th023=$this->input->post('th023'); }
	  
	 //  $th025=$this->input->post('th025');  一筆存檔清空白
	  if(!isset($th011)) { $th011="2"; }
	  if(!isset($th014)) { $th014="Y"; }
	  if(!isset($th016)) { $th016=0; }
	  if(!isset($th017)) { $th017=date("Y/m/d"); }
	  if(!isset($th019)) { $th019=0.05; }
	  $th012=0;$th013=0;$th020=0;$th021=0;
	  //$this->session->unset_userdata('docno');
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="start14a"  width="9%"><span class="required">費用單別：</span></td>   <!--onchange="startepsi01(this);check_title_no();"    -->
        <td class="normal14a"  width="25%"><input tabIndex="1" id="epsi01"   ondblclick="search_epsi01_window()" onKeyPress="keyFunction()"   name="th001" onfocus="selverify();" onchange="check_epsi01(this);check_title_no();"  value="<?php echo $th001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showepsi01disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="epsi01disp"> <?php    echo $th001disp; ?> </span></td>
	    <td class="normal14a" width="8%" >單據日期： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="th017" onKeyPress="keyFunction()"  onblur="dateformat_ymd(this);check_title_no();" name="th017"  value="<?php echo $th017; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(th017,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	    <td class="start14a" width="9%"><span class="required">費用單號：</span></td>
        <td class="normal14a" width="24%"><input tabIndex="3" id="th002" onKeyPress="keyFunction()" onfocus="check_title_no();" name="th002"  value="<?php echo $th002; ?>" size="12" type="text" required /></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a">廠商代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="puri01" ondblclick="search_puri01_window()" onKeyPress="keyFunction()"  onchange="check_puri01(this)" name="th004" value="<?php echo $th004; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showpuri01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="puri01disp"> <?php   echo $th004disp; ?> </span></td>
	    <td class="normal14">發票號碼.：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5"   onKeyPress="keyFunction()" id="th006" name="th006"   value="<?php echo $th006; ?>"  size="12" /></td>
	    <td class="normal14">發票日期：</td>
        <td  class="normal14"  ><input type="text" tabIndex="6" readonly="value"  onKeyPress="keyFunction()" id="th005" name="th005"   value="<?php echo $th005; ?>" size="12"  style="background-color:#F0F0F0"/>
	    <img  onclick="scwShow(th005,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
	  
		 <tr>
	    <td class="normal14a"  >幣別：</td>
        <td class="normal14" ><input tabIndex="10" id="cmsi06" ondblclick="search_cmsi06_window()" onKeyPress="keyFunction()" name="th008" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $th008; ?>"  type="text"    />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $th008disp; ?> </span></td>
	    <td class="normal14" >匯率：</td>		
        <td class="normal14"  ><input type="text" id="exchange_rate"   tabIndex="11"   onKeyPress="keyFunction()"    name="th009" value="<?php echo $th009; ?>"   /></td>
	    <td class="normal14" >發票聯數：</td>		
        <td class="normal14"  ><select id="th010" tabIndex="7" readonly="value" onKeyPress="keyFunction()" name="th010"   style="background-color:#F0F0F0" >
            <option <?php if($th010 == '5') echo 'selected="selected"';?> value='5'>5.電子計算機發票</option>                                                                        
		    <option <?php if($th010 == '1') echo 'selected="selected"';?> value='1'>1.二聯式</option>
            <option <?php if($th010 == '2') echo 'selected="selected"';?> value='2'>2.三聯式</option>
		    <option <?php if($th010 == '3') echo 'selected="selected"';?> value='3'>3.二聯式收銀機發票</option>
            <option <?php if($th010 == '4') echo 'selected="selected"';?> value='4'>4.三聯式收銀機發票</option>	
            <option <?php if($th010 == '6') echo 'selected="selected"';?> value='6'>6.免用統一發票</option>	
            <option <?php if($th010 == 'A') echo 'selected="selected"';?> value='A'>A.增值稅專用發票</option>	
            <option <?php if($th010 == 'B') echo 'selected="selected"';?> value='B'>B.普通發票</option>
            <option <?php if($th010 == 'C') echo 'selected="selected"';?> value='C'>C.免用發票</option>			
		  </select></td></tr>
	   <tr>
	    <td class="normal14a"  >出貨廠別：</td>
        <td class="normal14" ><input tabIndex="13" id="cmsi02" ondblclick="search_cmsi02_window()" onKeyPress="keyFunction()" name="th007" onblur="check_cmsi02(this);check_rate(this);"  value="<?php echo $th007; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
          <span id="cmsi02disp"> <?php    echo $th007disp; ?> </span></td>
	    <td class="normal14" >課稅別：</td>		
        <td class="normal14"  ><select id="taxes" onKeyPress="keyFunction()" name="th011" onchange="seltaxes(this)" tabIndex="14">
		    <option <?php  if($th011 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php  if($th011 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php  if($th011 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php  if($th011 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php  if($th011 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select></td><td class="normal14" >營業稅率：</td>		
        <td class="normal14"  ><input type="text" id="th019"   tabIndex="15"   onKeyPress="keyFunction()"    name="th019" value="<?php echo $th019; ?>"   /></td>
	  </tr>
	  <tr>
	    <td class="normal14" >備註：</td>		
        <td class="normal14" colspan="3" ><input type="text" id="th016"  tabIndex="16"   onKeyPress="keyFunction()"    name="th015" value="<?php echo $th015; ?>" size="100"  /></td>
	    <td class="normal14" ></td>		
        <td class="normal14"  ></td>
	  	<td class="normal14a"  ></td>
        <td class="normal14" ></td>
	    </tr>
	   <tr>
	    <td class="normal14" >付款條件：</td>		
        <td class="normal14"  ><input tabIndex="17" id="cmsi21" ondblclick="search_cmsi21_window()" onKeyPress="keyFunction()" name="th022" onblur="check_cmsi21(this)"   value="<?php echo  $th022; ?>"   size="12"   type="text"  />
		  <a href="javascript:;"><img id="Showcmsi21disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
          <span id="cmsi21disp"> <?php    echo $th022disp; ?> </span></td><td class="normal14" >列印次數：</td>		
        <td class="normal14"  ><input type="text" id="th016"   tabIndex="17"   onKeyPress="keyFunction()"    name="th016" value="<?php echo $th016; ?>"   /></td>
	  	<td class="normal14a"  >費用日期：</td>
        <td class="normal14" ><input type="text" tabIndex="18" readonly="value"  onKeyPress="keyFunction()" id="th003" name="th003"   value="<?php echo $th003; ?>" size="12"  style="background-color:#F0F0F0"/></td>
	    </tr>
		 <tr>
	    <td class="normal14">簽核狀態：</td>
        <td class="normal14"  ><select id="th023" tabIndex="19" readonly="value" onKeyPress="keyFunction()" name="th023"   style="background-color:#F0F0F0" >
            <option <?php if($th023 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($th023 == '0') echo 'selected="selected"';?> value='0'>0.待處理</option>
            <option <?php if($th023 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($th023 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($th023 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($th023 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($th023 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($th023 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
        <td class="normal14">確認碼：</td>
        <td  class="normal14"  ><select id="verify" onKeyPress="keyFunction()" name="th014" onChange="selverify(this)" tabIndex="20">
            <option <?php if($th014 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($th014 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($th014 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>
	     <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="21" readonly="value"  onKeyPress="keyFunction()" id="th018" name="th018"   value="<?php echo $th018; ?>" style="background-color:#F0F0F0" size="12" /></td>
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
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('eps/epsi10/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
<?php  include_once("./application/views/funnew/epsi10_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#epsi01').focus();
	}); 	   
</script> 	    	