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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 電子發票建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/tax/taxi06/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值
	  //預設稅率,廠別,幣別
       $stax_rate = $this->session->userdata('sysma004');
       $sysma200 = $this->session->userdata('sysma200');
	  if(!isset($mc226)) { $mc226=$stax_rate; }
	  if(!isset($mc200)) { $mc200=$this->input->post('cmsi11'); }
	  if(!isset($cmsi11disp)) { $cmsi11disp=$this->input->post('cmsi11disp'); }
	  if(!isset($mc200disp)) { $mc200disp=$this->input->post('mc200disp'); }
	  if(!isset($mc201disp)) { $mc201disp=$this->input->post('mc201disp'); }
	  
	  if(!isset($mc028)) { $mc028=$this->input->post('mc028'); }  //發票號碼起 
	  
	  if(!isset($mc201)) { $mc201=$this->input->post('copi01'); }
	  if(!isset($mc202)) { $mc202=$this->input->post('mc202'); } 
	  if(!isset($mc203)) { $mc203=$this->input->post('mc203'); }
      if(!isset($mc204)) { $mc204=$this->input->post('mc204'); } 
	  if(!isset($mc205)) { $mc205=$this->input->post('mc205'); } 
      if(!isset($mc206)) { $mc206=$this->input->post('mc206'); } 
	  if(!isset($mc207)) { $mc207=$this->input->post('mc207'); } 
      if(!isset($mc208)) { $mc208=$this->input->post('mc208'); } 
	  if(!isset($mc209)) { $mc209=$this->input->post('mc209'); } 
      if(!isset($mc210)) { $mc210=$this->input->post('mc210'); } 
	  if(!isset($mc211)) { $mc211=$this->input->post('mc211'); } 
      if(!isset($mc212)) { $mc212=$this->input->post('mc212'); } 
	  if(!isset($mc213)) { $mc213=$this->input->post('mc213'); } 
      if(!isset($mc214)) { $mc214=$this->input->post('mc214'); } 
	  if(!isset($mc215)) { $mc215=$this->input->post('mc215'); } 
      if(!isset($mc216)) { $mc216=$this->input->post('mc216'); } 
	  if(!isset($mc217)) { $mc217=$this->input->post('mc217'); } 
      if(!isset($mc218)) { $mc218=$this->input->post('mc218'); } 
	  if(!isset($mc219)) { $mc219=$this->input->post('mc219'); } 
     
     
      if(!isset($mc224)) { $mc224=$this->input->post('mc224'); } 
      if(!isset($mc225)) { $mc225=$this->input->post('mc225'); }  
	 
	 //  $mc225=$this->input->post('mc225');  一筆存檔清空白
	  if(!isset($mc221)) { $mc221=date_create('now')->format('Y-m-d H:i:s'); }   
	  if(!isset($mc220)) { $mc220=$username; }
	  if(!isset($mc222)) { $mc222=0; }
	  if(!isset($mc223)) { $mc223="1"; }
	  $mc217=0;$mc218=0;$mc219=0;
	  //$this->session->unset_userdata('docno');
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="9%"><span class="required">申報公司：</span></td>   <!--onchange="startcopi03(this);check_title_no();"    -->
        <td class="normal14a"  width="25%"><input tabIndex="1" id="cmsi11"    onKeyPress="keyFunction()"   name="cmsi11"  onchange="check_cmsi11(this);check_title_no();"  value="<?php echo $mc200; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showcmsi11disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="cmsi11disp"> <?php    echo $cmsi11disp; ?> </span></td>
	    <td class="normal14a" width="8%" >申報期別： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mc216" onKeyPress="keyFunction()"  onchange="dateformat_ym(this);check_title_no();" name="mc216"  value="<?php echo $mc216; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /></td>
	    <td class="start14a" width="8%"><span class="required">流水號：</span></td>
        <td class="normal14a" width="25%"><input tabIndex="3" id="mc211" onKeyPress="keyFunction()"  name="mc211" onfocus="check_title_no();" value="<?php echo $mc211; ?>" size="16" type="text" required /></td>
	  </tr>
	  
	  <tr>	    
	    <td class="normal14a"  >發票日期： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"   ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mc213" onKeyPress="keyFunction()"  onblur="dateformat_ymd(this);check_vno(this);" name="mc213"  value="<?php echo $mc213; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /></td>
		<td class="normal14a">客戶代號：</td>   <!-- onfocus="check_vnosave(this);" -->
        <td  class="normal14"  ><input tabIndex="4" id="copi01" onKeyPress="keyFunction()"  onchange="check_copi01(this)" name="copi01" value="<?php echo $mc201; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="copi01disp"> <?php   echo $mc201disp; ?> </span></td>
	    <td class="normal14">客戶簡稱：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" readonly="value"  onKeyPress="keyFunction()" id="mc202" name="mc202"   value="<?php echo $mc202; ?>"  size="12" /></td>
	    
	  </tr>
	  <tr>	
         <td class="normal14">統一編號：</td>
        <td  class="normal14"  ><input type="text" tabIndex="6" readonly="value"  onKeyPress="keyFunction()" id="mc204" name="mc204"   value="<?php echo $mc204; ?>" size="12"  /></td>	  
		<td class="normal14a">客戶名稱：</td>
        <td  class="normal14" colspan="1" ><input type="text" tabIndex="5" readonly="value"  onKeyPress="keyFunction()" id="mc203" name="mc203"   value="<?php echo $mc203; ?>"  size="50" /></td>
	    <td class="normal14">發票號碼</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" readonly="value"  onKeyPress="keyFunction()" id="mc214" name="mc214"   value="<?php echo $mc214; ?>" style="background-color:#F0F0F0" size="12" /></td>
	  </tr>
	  <tr>	    
		<td class="normal14a">發票地址：</td>
        <td  class="normal14" colspan="1" ><input type="text" tabIndex="5" readonly="value"  onKeyPress="keyFunction()" id="mc215" name="mc215"   value="<?php echo $mc215; ?>"  size="72" /></td>
	    <td class="normal14"></td>
        <td  class="normal14"  ></td>
	    <td class="normal14">發票號碼起</td>
        <td  class="normal14"  ><input type="text" tabIndex="6" readonly="value"  onKeyPress="keyFunction()" id="mc028" name="mc028"   value="<?php echo $mc028; ?>" size="12"  /></td>	
	  </tr>
	  <tr>	    
		<td class="normal14a">營業稅別：</td>
        <td  class="normal14"  ><select  tabIndex="3" id="mc210" onKeyPress="keyFunction()"  name="mc210" >
             <option <?php if($mc210 == '2') echo 'selected="selected"';?> value='2'>2:應稅</option>                                                                      
		     <option <?php if($mc210 == '3') echo 'selected="selected"';?> value='3'>3:零稅</option>
			 <option <?php if($mc210 == '4') echo 'selected="selected"';?> value='4'>4:免稅</option>
		  </select>
	    <td class="normal14">信用卡後4碼：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" readonly="value"  onKeyPress="keyFunction()" id="mc208" name="mc208"   value="<?php echo $mc208; ?>"  size="12" /></td>
	    <td class="normal14">發票狀態：</td>
        <td  class="normal14"  ><select  tabIndex="3" id="mc223" onKeyPress="keyFunction()"  name="mc223" >
             <option <?php if($mc223 == '1') echo 'selected="selected"';?> value='1'>1:未開立</option>                                                                      
		     <option <?php if($mc223 == '2') echo 'selected="selected"';?> value='2'>2:已開立</option>
		  </select>
	  </tr>
	   <tr>	    
		<td class="normal14a">發票類別：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" readonly="value"  onKeyPress="keyFunction()" id="mc224" name="mc224"   value="<?php echo $mc224; ?>" style="background-color:#F0F0F0" size="12" /></td>
	    <td class="normal14">發票聯數：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" readonly="value"  onKeyPress="keyFunction()" id="mc225" name="mc225"   value="<?php echo $mc225; ?>" style="background-color:#F0F0F0" size="12" /></td>
	    
		<td class="normal14" >營業稅率：</td>		
        <td class="normal14"  ><input type="text" id="taxrate"   tabIndex="16"   onKeyPress="keyFunction()"    name="mc226" value="<?php echo $mc226; ?>"  size="12" /></td>
	  </tr>
	  <tr>	    
		<td class="normal14a">異動人員：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" readonly="value"  onKeyPress="keyFunction()" id="mc220" name="mc220"   value="<?php echo $mc220; ?>" style="background-color:#F0F0F0" size="12" /></td>
	    <td class="normal14">異動時間：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" readonly="value"  onKeyPress="keyFunction()" id="mc221" name="mc221"   value="<?php echo $mc221; ?>" style="background-color:#F0F0F0" size="22" /></td>
	    <td class="normal14">列印次數：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" readonly="value"  onKeyPress="keyFunction()" id="mc222" name="mc222"   value="<?php echo $mc222; ?>" style="background-color:#F0F0F0" size="12" /></td>
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
				
				<td class="right" valign="top"><b style="color: #003A88;">　未稅金額：</b></td>
				<td ><input type='text' readonly="value" name='mc217' id="mc217" size="8" value="<?php echo $mc217; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　稅額：</b></td>
				<td ><input type='text' readonly="value" name='mc218' id="mc218" size="8" value="<?php echo $mc218; ?>"  style="background-color:#F0F0F0" /></td>
			
				<td class="right" valign="top"><b style="color: #003A88;">　　合計金額：</b></td>
				<td ><input type='text' readonly="value" name="mc219" id="mc219" size="8" value="<?php echo $mc217+$mc218; ?>"  style="background-color:#F0F0F0" /></td>
	
					<input id="select_rows" style="display:none;"/>
				<td class="left" valign="top"></td>
              </tr>
		<!-- 合計     -->	  
	 <div class="buttons">                           <!-- check_vno();     -->	
	   <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('tax/taxi06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div> 
   </div> 	<!-- end 頁標籤 -->   
   </form>
	   <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位,交貨庫別,可輸入部份品號或品名下拉視窗選擇,欄位淡黃色按2下開視窗查詢,按Enter鍵或Tab鍵跳下一個欄位,Alt+y跳到明細資料, Alt+w新增一筆明細. ] ' ?> </div>  <?php } ?>
	
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
   
	</div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->

<?php  include_once("./application/views/funnew/cmsi11_funmjs_v.php"); ?> <!-- 申報公司 -->
<?php  include_once("./application/views/funnew/copi01b_funmjs_v.php"); ?>  <!--客戶代號 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/taxi06_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#cmsi11').focus();
	}); 	   
</script> 	    	