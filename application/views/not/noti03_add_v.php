<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>
	
	<div id="divFacri03" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 
	<iframe id="acri03frame" src="" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>

<div id="content"> <!-- div-3 --> 
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 應付票據建立作業 - 新增　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#puri01').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	  </div>
	  <!--<div style="float:right; "> 
	       <a id="Shownoti04adisp" onclick=""  style="float:left"  class="button"><span>託收</span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
	       <a id="Shownoti04bdisp" onclick=""  style="float:left"  class="button"><span>轉付</span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
	       <a id="Shownoti04cdisp" onclick=""  style="float:left"  class="button"><span>退票</span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
	       <a id="Shownoti04ddisp" onclick=""  style="float:left"  class="button"><span>還票</span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      </div>-->
	</div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/not/noti03/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值
	  //預設稅率,廠別,幣別
		$stax_rate = $this->session->userdata('sysma004');
		$sysma200 = $this->session->userdata('sysma200');
		if(!isset($ta009)) {$ta009 = $this->input->post('puri01'); }
		if(!isset($ta013disp)) {$ta013disp = $this->input->post('copi01disp'); }
		if(!isset($ta004)) { $ta004=date("Y/m/d"); }
		if(!isset($ta006)) {$ta006 = $this->input->post('cmsi16'); }
		if(!isset($puri01disp)) {$puri01disp = $this->input->post('puri01disp'); }
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
		<td class="normal14y" width="8%">廠商代號：</td>
        <td  class="normal14a" width="25%" >
			<input tabIndex="1" id="puri01" onKeyPress="keyFunction()"  onchange="check_puri01(this);clean_puri01();" name="puri01" value="<?php echo $ta009; ?>" size="12" type="text"  />
			<a href="javascript:;"><img id="Showpuri01disp" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
			<input type="text" name="puri01disp2" id="puri01disp2" style="display:none" value="" />
		</td>
		
	    <td class="normal14y" width="8%" >開票日： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" >
			<input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta004" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="ta004"  value="<?php echo $ta004; ?>"  size="12" type="text" style="background-color:#FFFFE4"  />
		<img  onclick="scwShow(ta004,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>

	  <tr>	
		<td class="normal14z" >廠商簡稱：</td>		
        <td class="normal14"  >
			<input type="text" id="puri01disp"  readonly="value"  tabIndex="16"   onKeyPress="keyFunction()"    name="puri01disp" value="<?php echo $puri01disp; ?>"  size="20" style="background-color:#F0F0F0"/>
		</td>
		
		<td class="normal14z">付款銀行：</td>
        <td class="normal14">
			<input tabIndex="3" id="noti01a" onKeyPress="keyFunction()"  onchange="check_noti01a(this)" name="noti01a" value="<?php echo $ta006; ?>" size="12" type="text"  />
			<a href="javascript:;"><img id="Shownoti01adisp" src="<?php echo base_url()?>assets/image/png/bank.png" alt="" align="top"/></a>
		</td>
	  </tr>
	  
	</table>
	
	<div class="abgne_tab"> <!-- div-6 頁標籤 -->
		<ul class="tabs">
		  <li><a href="#tab1"  accesskey="a">票據資料a</a></li>
		  <li><a href="#tab2"  accesskey="b">付款資料b</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  交易資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	  <?php
		if(!isset($ta001)){$ta001 = $this->input->post('ta001');}
		if(!isset($ta007)){$ta007 = $this->input->post('ta007');}
		if(!isset($cmsi06disp)){$cmsi06disp = $this->input->post('cmsi06disp');}
		if(!isset($ta002)){$ta002 = $this->input->post('ta002');}
		if(!isset($ta008)){$ta008 = $this->input->post('ta008');}
		if(!isset($ta019)){$ta019 = $this->input->post('ta019');}
		if(!isset($ta003)){$ta003 = $this->input->post('ta003');}
		if(!isset($noti01adisp)){$noti01adisp = $this->input->post('noti01adisp');}
		if(!isset($noti01adisp2)){$noti01adisp2 = $this->input->post('noti01adisp2');}
		if(!isset($noti01disp2)){$noti01disp2 = $this->input->post('noti01disp2');}
		if(!isset($noti01disp3)){$noti01disp3 = $this->input->post('noti01disp3');}
		if(!isset($ta005)) { $ta005=date("Y/m/d"); }
		
	  ?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y"  width="12%"><span class="required">票號：</span></td>
        <td class="normal14a"  width="36%" >
			<input type="text" tabIndex="4" onKeyPress="keyFunction()" id="ta001"  name="ta001"  onblur=""  value="<?php echo  $ta001; ?>"   size="20" required="requierd"  />
		</td>
		
	    <td class="normal14y"  width="12%">票據種類：</td>  <!-- onchange="startcmsi09(this)"     -->
        <td  class="normal14"  >
			<input tabIndex="9" id="ta007" onKeyPress="keyFunction()" name="ta007" onblur=""   value="<?php echo  $ta007; ?>"   size="20"   type="text"  />
		</td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14z"  >幣別：</td>
        <td class="normal14" >
			<input tabIndex="6" id="cmsi06" onKeyPress="keyFunction()" name="cmsi06" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo 'NTD'; ?>"  type="text"   size="20" />
			<a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
			<span id="cmsi06disp"> <?php    echo $cmsi06disp; ?> </span>
		</td>
		
	    <td class="normal14z" >目前票況：</td>		
        <td class="normal14"  >
			<input type="text"  readonly="value" tabIndex="13"   onKeyPress="keyFunction()" id="ta008" name="ta008" value="<?php echo $ta008; ?>" style="background-color:#E7EFEF"  size="20" />
		</td>
		<script>
			$(document).ready(function(){
				$('#ta008').val('1:開票');
			});
		</script>
	  </tr>
	  
	  <tr>
		<td class="normal14z" >匯率：</td>		
        <td class="normal14"  >
			<input type="text" id="exchange_rate"   tabIndex="8"   onKeyPress="keyFunction()"    name="exchange_rate" value="1"  size="20" />
		</td>
	    
		<td  class="normal14z" >票面金額：</td>
        <td class="normal14"  >
			<input type="text" id="ta003"   tabIndex="10"   onKeyPress="keyFunction()"    name="ta003" value="<?php echo $ta003; ?>"  size="20" />
		</td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >到期日：</td>		
        <td class="normal14"  >
			<input type="text" id="ta005" ondblclick="scwShow(this,event);" onchange="dateformat_ymd(this);"  tabIndex="12"   onKeyPress="keyFunction()"    name="ta005" value="<?php echo $ta005; ?>"  size="20" style="background-color:#FFFFE4" />
		<img  onclick="scwShow(ta005,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
		
	  <tr>
	    <td class="normal14z" >銀行帳號：</td>		
        <td class="normal14"  >
			<input type="text" id="noti01adisp2" readonly="value"  tabIndex="14"   onKeyPress="keyFunction()"    name="noti01adisp2" value="<?php echo $noti01adisp2 ?>"  size="20" style="background-color:#F0F0F0" />
		</td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >銀行簡稱：</td>		
        <td class="normal14"  >
			<input type="text" id="noti01adisp"  readonly="value"  tabIndex="16"   onKeyPress="keyFunction()"    name="noti01adisp" value="<?php echo $noti01adisp; ?>"  size="20" style="background-color:#F0F0F0" />
		</td>
	  </tr>
	</table>
	</div>
	
	<!--  地址 標籤 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	  <?php
	   $ta011=$this->input->post('ta011');
	   $ta012=$this->input->post('ta012');
	   $ta013=$this->input->post('ta013');
	   $ta014=$this->input->post('ta014');
	   $acti03disp=$this->input->post('acti03disp');
	   $ta016=$this->input->post('ta016');
	   $acti03adisp=$this->input->post('acti03adisp');
	   $ta018=$this->input->post('ta018');

	  ?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" >付款單號：</td>		
        <td class="normal14"  >
			<input type="text" id="acpi03" name="acpi03"  tabIndex="19"   onKeyPress="keyFunction()"  onblur="check_acpi03(this)"  name="acpi03" value="<?php echo $ta011; ?>"  size="12" />
			<a href="javascript:;"><img id="Showacpi03disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
			<input type="text" id="acpi03disp2"   tabIndex="20"   onKeyPress="keyFunction()"    name="acpi03disp2" value="<?php echo $ta012; ?>"  size="12" />
			<input type="text" id="acpi03disp3"   tabIndex="21"   onKeyPress="keyFunction()"    name="acpi03disp3" value="<?php echo $ta013; ?>"  size="12" />
		</td>
		<td class="normal14"></td>
		<td class="normal14"></td>
		<td></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14z" >票據科目：</td>		
        <td class="normal14"  >
			<input tabIndex="22" id="acti03" onKeyPress="keyFunction()" name="acti03" onblur="check_acti03(this);"  value="<?php echo $ta014; ?>"  type="text"   size="12" />
			<a href="javascript:;"><img id="Showacti03disp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
			<span id="acti03disp"> <?php echo $acti03disp; ?> </span>
		</td>
		
		<td class="normal14"></td>
		<td class="normal14"></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >對方科目：</td>
        <td class="normal14"  >
			<input tabIndex="23" id="acti03a" onKeyPress="keyFunction()" name="acti03a" onblur="check_acti03a(this);"  value="<?php echo $ta016; ?>"  type="text"   size="12" />
			<a href="javascript:;"><img id="Showacti03adisp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
			<span id="acti03adisp"> <?php echo $acti03adisp; ?> </span>
		</td>
	  
		<td class="normal14"></td>
		<td class="normal14"></td>
	  </tr>	
	  
	  <tr>
		<td class="normal14z" >備註：</td>		
        <td class="normal14"  >
			<input type="text" id="ta018"   tabIndex="24"   onKeyPress="keyFunction()"    name="ta018" value="<?php echo $ta018; ?>"  size="12" />
		</td>
	  
		<td class="normal14"></td>
		<td class="normal14"></td>
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
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="" /></td>
			  <td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
            </tr>
          </tfoot>
       </table>
	</div> 	
	<!-- 合計     -->
	<!--	     <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span></span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　訂單金額：</b></td>
				<td ><input type='text' readonly="value" name='tc029' id="tc029" size="8" value="<?php echo $tc029; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　稅額：</b></td>
				<td ><input type='text' readonly="value" name='tc030' id="tc030" size="8" value="<?php echo $tc030; ?>"  style="background-color:#F0F0F0" /></td>
			
				<td class="right" valign="top"><b style="color: #003A88;">　　合計金額：</b></td>
				<td ><input type='text' readonly="value" name="tc2930" id="tc2930" size="8" value="<?php echo $tc029+$tc030; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總數量：</b></td>
				<td ><input type='text' readonly="value" name='tc031' id="tc031" size="8" value="<?php echo $tc031; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總毛重：</b></td>
				<td ><input type='text' readonly="value" name='tc043' id="tc043" size="8" value="<?php echo $tc043; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總材積：</b></td>
				<td ><input type='text' readonly="value" name='tc044' id="tc044" size="8" value="<?php echo $tc044; ?>"  style="background-color:#F0F0F0" /></td>
			
					<input id="select_rows" style="display:none;"/>
				<td class="left" valign="top"></td>
              </tr>
	-->
		<!-- 合計     -->	  
	<!-- <div class="buttons">
	   <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div> --> 
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

<?php  include_once("./application/views/funnew/puri01_funmjs_v.php"); ?>  <!-- 廠商回傳多欄 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->
<?php  include_once("./application/views/funnew/noti01a_funmjs_v.php"); ?>  <!-- 銀行帳戶(應收、應付票據用) -->
<?php  include_once("./application/views/funnew/acti03_funmjs_v.php"); ?>  <!-- 票據科目 -->
<?php  include_once("./application/views/funnew/acti03a_funmjs_v.php"); ?>  <!-- 票據科目 -->
<?php  include_once("./application/views/funnew/acpi03_funmjs_v.php"); ?>  <!--付款單-->
<?php // include_once("./application/views/funnew/puri01a_funmjs_v.php"); ?>  <!--廠商-->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/noti03_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	//$(document).ready(function(){ 	   
	//$('#copi03').focus();
	//}); 
	
function clean_noti01a(){
	$('#noti01a').val('');
	$('#noti01adisp').val('');
	$('#noti01adisp2').val('');
}
</script> 	 
	
