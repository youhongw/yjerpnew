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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 信用狀資料建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/eps/epsi08/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值
	  //預設稅率,廠別,幣別
       $stax_rate = $this->session->userdata('sysma004');
       $sysma200 = $this->session->userdata('sysma200');
	   if(!isset($tf001)) { $tf001=$this->input->post('tf001'); }
	   if(!isset($tf002)) { $tf002=$this->input->post('tf002'); }
	   if(!isset($tf003)) { $tf003=$this->input->post('tf003'); }
	   if(!isset($tf003disp)) { $tf003disp=$this->input->post('tf003disp'); }
	   if(!isset($tf004)) { $tf004=$this->input->post('tf004'); }
	   if(!isset($tf004disp)) { $tf004disp=$this->input->post('tf004disp'); }
	   if(!isset($tf005)) { $tf005=$this->input->post('tf005'); }
	    if(!isset($tf005disp)) { $tf005disp=$this->input->post('tf005disp'); }
	   if(!isset($tf006)) { $tf006=$this->input->post('tf006'); }
	    if(!isset($tf006disp)) { $tf006disp=$this->input->post('tf006disp'); }
	   if(!isset($tf007)) { $tf007=$this->input->post('tf007'); }
	    if(!isset($tf007disp)) { $tf007disp=$this->input->post('tf007disp'); }
	   if(!isset($tf008)) { $tf008=$this->input->post('tf008'); }
	   if(!isset($tf009)) { $tf009=$this->input->post('tf009'); }
	   if(!isset($tf010)) { $tf010=$this->input->post('tf010'); }
	   if(!isset($tf011)) { $tf011=$this->input->post('tf011'); }
	   if(!isset($tf012)) { $tf012=$this->input->post('tf012'); }
	   if(!isset($tf013)) { $tf013=$this->input->post('tf013'); }
	   if(!isset($tf014)) { $tf014=$this->input->post('tf014'); }
	   if(!isset($tf015)) { $tf015=$this->input->post('tf015'); }
	   if(!isset($tf016disp)) { $tf016disp=$this->input->post('tf016disp'); }
	//   if(!isset($tf017)) { $tf017=$this->input->post('tf017'); }
	   if(!isset($tf018disp)) { $tf018disp=$this->input->post('tf018disp'); }
	   if(!isset($tf018disp1)) { $tf018disp1=$this->input->post('tf018disp1'); }
	 //  if(!isset($tf019)) { $tf019=$this->input->post('tf019'); }
	 //  if(!isset($tf020)) { $tf020=$this->input->post('tf020'); }
	   if(!isset($tf021)) { $tf021=$this->input->post('tf021'); }
	   if(!isset($tf022)) { $tf022=$this->input->post('tf022'); }
	   if(!isset($tf023)) { $tf023=$this->input->post('tf023'); }
	   if(!isset($tf024)) { $tf024=$this->input->post('tf024'); }
	//   if(!isset($tf025)) { $tf025=$this->input->post('tf025'); }
	 //  if(!isset($tf026)) { $tf026=$this->input->post('tf026'); }
	 //  if(!isset($tf027)) { $tf027=$this->input->post('tf027'); }
	
	
	 //  $tf025=$this->input->post('tf025');  一筆存檔清空白
	  if(!isset($tf016)) { $tf016="NTD"; }
	  if(!isset($tf017)) { $tf017=1; }
	  if(!isset($tf018)) { $tf018=0; }
	  if(!isset($tf019)) { $tf019=0; }
	  if(!isset($tf020)) { $tf020=0; }
	  if(!isset($tf025)) { $tf025=date("Y/m/d"); }
	  if(!isset($tf026)) { $tf026=$username; }
	  if(!isset($tf027)) { $tf027="N"; }
	  //$this->session->unset_userdata('docno');
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="10"><span class="required">信用狀號：</span></td>   <!--onchange="startcopi03(this);check_title_no();"    -->
        <td class="normal14a"  width="40%"><input type="text" tabIndex="1"   onKeyPress="keyFunction()" id="tf001" name="tf001"   value="<?php echo $tf001; ?>"  size="30" required /></td>
	    
	    <td class="start14a" width="10%"><span class="required">類別：</span></td>
        <td class="normal14a" width="40%"><input tabIndex="2" id="tf002" onKeyPress="keyFunction()"  name="tf002"  value="<?php echo $tf002; ?>" size="12" type="text"  /></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a">客戶代號：</td>
        <td  class="normal14"  ><input tabIndex="3" id="copi01" onKeyPress="keyFunction()"  onchange="check_copi01(this)" name="tf003" value="<?php echo $tf003; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="copi01disp"> <?php   echo $tf003disp; ?> </span></td>
	    <td class="normal14">廠別代號：</td>
        <td  class="normal14"  ><input type="text" tabIndex="4" onKeyPress="keyFunction()" id="cmsi02"  onblur="check_cmsi02(this)" name="cmsi02"   value="<?php echo  $tf004; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	      <span id="cmsi02disp"> <?php    echo $tf004disp; ?> </span></td>
		  
	  </tr>
	  <tr>
	    <td  class="normal14" >可否分批：</td>
        <td  class="normal14"  ><input type="hidden" name="tf013" class="tf013"  value="N" />
		  <input tabIndex="5" id="tf013" onKeyPress="keyFunction()"  name="tf013" <?php if($tf013 == 'Y' ) echo 'checked';  ?>  <?php if($tf013 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  />
        </td>	  
	    <td class="normal14">可否轉運：</td>		
        <td  class="normal14"  ><input type="hidden" name="tf014" class="tf014"  value="N" />
		  <input tabIndex="6" id="tf014" onKeyPress="keyFunction()" name="tf014" <?php if($tf014 == 'Y' ) echo 'checked'; ?>  <?php if($tf014 != 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  />
        </td>
	  </tr>
	  <tr>	    
		<td class="normal14">確認日期：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" readonly="value"  onKeyPress="keyFunction()" id="tf025" name="tf025"   value="<?php echo $tf025; ?>" size="12"  style="background-color:#F0F0F0"/></td>
	    <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="8" readonly="value"  onKeyPress="keyFunction()" id="tf026" name="tf026"   value="<?php echo $tf026; ?>" style="background-color:#F0F0F0" size="12" /></td>
	     </tr>
	  <tr>	
	     <td class="normal14">確認碼：</td>
        <td  class="normal14"  ><select id="verify" onKeyPress="keyFunction()" name="tf022" onChange="selverify(this)" tabIndex="9">
            <option <?php if($tf022 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tf022 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tf022 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>
		 <td class="normal14">拋轉狀態：</td>
        <td  class="normal14"  ><select id="tf027" tabIndex="10" readonly="value" onKeyPress="keyFunction()" name="tf027"   style="background-color:#F0F0F0" >
            <option <?php if($tf027 == 'N') echo 'selected="selected"';?> value='N'>N.未拋轉</option>                                                                        
		    <option <?php if($tf027 == 'Y') echo 'selected="selected"';?> value='Y'>Y.拋轉成功(來源廠商)</option>
            <option <?php if($tf027 == 'y') echo 'selected="selected"';?> value='y'>y.拋轉成功(下游廠商)</option>
		    <option <?php if($tf027 == 'n') echo 'selected="selected"';?> value='n'>n.訂單變更</option>
            <option <?php if($tf027 == 'U') echo 'selected="selected"';?> value='U'>U.拋轉失敗</option>	
            <option <?php if($tf027 == 'u') echo 'selected="selected"';?> value='u'>u.還原失敗</option>	
		  </select></td>
	  </tr>
	 
	</table>
	
	<div class="abgne_tab"> <!-- div-6 頁標籤 -->
		<ul class="tabs">
		  <li><a href="#tab1"  accesskey="a">開狀資料a</a></li>
		  <li><a href="#tab2"  accesskey="b">金額資料b</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  交易資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="10">許可證號：</td>
        <td class="normal14a"  width="40%" ><input type="text" id="tf015"   tabIndex="11"   onKeyPress="keyFunction()"    name="tf015" value="<?php echo $tf015; ?>"  size="12" /></td>
	    <td class="normal14a"  width="8%">開狀日：</td>  
        <td class="normal14a"  width="42%" ><input tabIndex="12"  ondblclick="scwShow(this,event);"   id="tf008" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tf008"  value="<?php echo $tf008; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tf008,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>	
	 
	  <tr>
	    <td class="normal14a"  >開狀銀行代號：</td>
        <td class="normal14" ><input tabIndex="15" id="cmsi16" onKeyPress="keyFunction()" name="tf005" onblur="check_cmsi16(this);"  value="<?php echo $tf005; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi16disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi16disp"> <?php    echo $tf005disp; ?> </span></td>
	    <td class="normal14a"  >收到日：</td>  
        <td class="normal14a"   ><input tabIndex="16"  ondblclick="scwShow(this,event);"   id="tf009" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tf009"  value="<?php echo $tf008; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tf009,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>	  
       <tr>
	    <td class="normal14a"  >通知銀行代號：</td>
        <td class="normal14" ><input tabIndex="17" id="cmsi16a" onKeyPress="keyFunction()" name="tf006" onblur="check_cmsi16a(this);"  value="<?php echo $tf006; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi16adisp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi16adisp"> <?php    echo $tf006disp; ?> </span></td>
	    <td class="normal14a"  >裝船日：</td>  
        <td class="normal14a"   ><input tabIndex="18"  ondblclick="scwShow(this,event);"   id="tf010" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tf010"  value="<?php echo $tf010; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tf010,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>	  
	   <tr>
	    <td class="normal14a"  >押匯銀行代號：</td>
        <td class="normal14" ><input tabIndex="19" id="cmsi16b" onKeyPress="keyFunction()" name="tf007" onblur="check_cmsi16b(this);"  value="<?php echo $tf007; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi16bdisp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi16bdisp"> <?php    echo $tf007disp; ?> </span></td>
	    <td class="normal14a"  >押匯日：</td>  
        <td class="normal14a"   ><input tabIndex="20"  ondblclick="scwShow(this,event);"   id="tf011" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tf011"  value="<?php echo $tf011; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tf011,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>	  
	   <tr>
	    <td class="normal14a"  >備註：</td>
        <td class="normal14" ><input type="text" id="tf023"   tabIndex="21"   onKeyPress="keyFunction()"    name="tf023" value="<?php echo $tf023; ?>"  size="30" /></td>
	    <td class="normal14a"  >到期日：</td>  
        <td class="normal14a"   ><input tabIndex="22"  ondblclick="scwShow(this,event);"   id="tf012" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tf012"  value="<?php echo $tf012; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tf012,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>	  
	 
	  
	</table>
	</div>
	
	<!--  地址 標籤 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	   <tr>
	    <td class="normal14a" width="10%">幣別：</td>
        <td class="normal14a"  width="40%" ><input tabIndex="23" id="cmsi06" onKeyPress="keyFunction()" name="tf016" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $tf016; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $tf016disp; ?> </span></td>
		  
		  <td class="normal14a"  width="10%">匯率：</td>  
        <td class="normal14a"  width="40%" ><input type="text" id="exchange_rate"   tabIndex="24"   onKeyPress="keyFunction()"    name="tf017" value="<?php echo $tf017; ?>"  size="12" /></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14a"  >總金額：</td>
        <td class="normal14a"   ><input type="text" id="tf018"   tabIndex="25"   onKeyPress="keyFunction()" onchange="check_tf018();"   name="tf018" value="<?php echo $tf018; ?>"  size="12" /></td>
	    <td class="normal14a"  >通知費用：</td>  
        <td class="normal14a"   ><input type="text" id="tf020"   tabIndex="26"   onKeyPress="keyFunction()"    name="tf020" value="<?php echo $tf020; ?>"  size="12" /></td>
	  </tr>	
	  <tr>
	    <td class="normal14a"  >結案碼：</td>
        <td class="normal14a"   ><input type="hidden" name="tf021" class="tf021"  value="N" />
		  <input tabIndex="27" id="tf021" onKeyPress="keyFunction()" name="tf021" <?php if($tf021 == 'Y' ) echo 'checked'; ?>  <?php if($tf021 != 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  />
        </td><td class="normal14a"  ></td>  
          <td class="normal14a"   ></td>
	  </tr>	
	  <tr>
	    <td class="normal14a"  >押匯金額：</td>  
        <td class="normal14a"   ><input type="text" id="tf019" readonly="readonly"  tabIndex="28"   onKeyPress="keyFunction()"    name="tf019" value="<?php echo $tf019; ?>"  size="12" style="background-color:#F0F0F0" /></td>
	  	<td class="normal14a"   >訂單金額：</td>   
        <td class="normal14a"   ><input type="text" id="tf024" readonly="readonly"  tabIndex="29"   onKeyPress="keyFunction()"    name="tf024" value="<?php echo $tf024; ?>"  size="12"  style="background-color:#F0F0F0" /></td>
	  </tr>	
	  <tr>
	    <td class="normal14a"  >訂單餘額：</td>
        <td class="normal14" ><input type="text" id="tf018disp"  readonly="readonly" tabIndex="30"   onKeyPress="keyFunction()"    name="tf018disp" value="<?php echo $tf018disp; ?>"  size="12" style="background-color:#F0F0F0" /></td>
	    <td class="normal14a"  >L/C餘額：</td>  
        <td class="normal14a"   ><input type="text" id="tf018disp1" readonly="readonly"  tabIndex="31"   onKeyPress="keyFunction()"    name="tf018disp1" value="<?php echo $tf018disp1; ?>"  size="12" style="background-color:#F0F0F0" /></td>
	  </tr>	  
	</table>
 
	</div> 	
	
	</div> <!-- </div>div-8 -->
	 </div> <!--</div>  div-7 -->
	 
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
		    
		<!-- 合計     -->	  
	 <div class="buttons">
	   <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('eps/epsi08/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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


<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/copi01a_funmjs_v.php"); ?>  <!-- 客戶 -->
<?php  include_once("./application/views/funnew/cmsi16_funmjs_v.php"); ?>  <!-- 銀行代號 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/epsi08_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#copi03').focus();
	}); 	
   function check_tf018() {
	   var tf018=$('#tf018').val();
	   console.log(tf018);
	   $('#tf018disp').val(tf018);
	   $('#tf018disp1').val(tf018);
   }
	
</script> 	    	