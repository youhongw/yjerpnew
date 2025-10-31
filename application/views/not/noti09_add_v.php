<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>-->

<div id="content"> <!-- div-3 --> 
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 借/還款建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#noti06').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti09/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/not/noti09/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值
	  //預設稅率,廠別,幣別

	  if(!isset($tk008)) { $tk008=$this->session->userdata('sysma003'); } else  {$tk008=$this->input->post('cmsi06');}
	  if(!isset($tk001)) { $tk001=$this->input->post('noti06'); }
	  if(!isset($tk001disp)) { $tk001disp=$this->input->post('noti06disp'); }
	  if(!isset($tk008disp)) { $tk008disp=$this->input->post('tk008disp'); }
	  if(!isset($tk003)) { $tk003=date("Y/m/d"); }
	  if(!isset($tk002)) { $tk002=$this->input->post('tk002'); }
	  if(!isset($tk010)) { $tk010=0; } else {$tk010=$this->input->post('tk010');}
	  if(!isset($tk005)) { $tk005=date("Y/m/d"); }
	  if(!isset($tk011)) { $tk011=$this->input->post('tk011'); }
	  if(!isset($tk009)) { $tk009=1; }  else {$tk009=$this->input->post('tk009');}
	  if(!isset($tk004)) { $tk004=$this->input->post('tk004'); }
	  if(!isset($tk007)) { $tk007=$this->input->post('tk007'); }
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="12%"><span class="required">借/還款單別：</span></td>   <!--onchange="startnoti06(this);check_title_no();"    -->
        <td class="normal14a"  width="38%"><input tabIndex="1" id="noti06"    onKeyPress="keyFunction()"   name="noti06" onfocus="check_title_no();" onblur="turn_tl008(this);" onchange="check_noti06(this);check_title_no();"  value="<?php echo $tk001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Shownoti06disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="noti06disp"> <?php    echo $tk001disp; ?> </span></td>
		
		<td class="normal14y" width="10%" >借/還款日期： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="40%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tk003" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="tk003"  value="<?php echo $tk003; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /></td>
	    
	  </tr>
	  
	  <tr>	    
		<td class="normal14z" ><span class="required">借/還款單號：</span></td>
        <td class="normal14a" ><input tabIndex="3" id="tk002" onKeyPress="keyFunction()"  name="tk002" onfocus="check_title_no();" value="<?php echo $tk002; ?>" size="12" type="text"  /></td>
		
	    <td class="normal14z">列印：</td>
		<td class="normal14"  ><input type="text"  readonly="value" tabIndex="19"   onKeyPress="keyFunction()"   name="tk010" value="<?php echo $tk010; ?>" style="background-color:#F0F0F0"  size="12" /></td>	  
	  </tr>
	  
	  <tr>
	    <td class="normal14z">單據日期：</td>
        <td class="normal14a"><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tk005" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="tk005"  value="<?php echo $tk005; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /></td>
		
        <td class="normal14z">簽核狀態：</td>
        <td class="normal14"  ><select id="tk011" tabIndex="21" readonly="value" onKeyPress="keyFunction()" name="tk011"   style="background-color:#F0F0F0" >
            <option <?php if($tk011 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tk011 == '0') echo 'selected="selected"';?> value='0'>0.待處理</option>
            <option <?php if($tk011 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tk011 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tk011 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tk011 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tk011 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tk011 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select>
		</td>
	  </tr>
	  
	  <tr>
		<td class="normal14z">幣別：</td>
        <td class="normal14" ><input tabIndex="11" id="cmsi06" onKeyPress="keyFunction()" name="cmsi06" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $tk008; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $tk008disp; ?> </span>
		</td>
	    <td class="normal14z" >匯率：</td>  <!-- onchange="startcmsi09(this)"     -->
        <td class="normal14"  ><input type="text" id="exchange_rate"   tabIndex="12"   onKeyPress="keyFunction()"    name="exchange_rate" value="<?php echo $tk009; ?>"  size="12" /></td>
	  </tr>
		  
	  <tr>
	    <td class="normal14z">備註：</td>
        <td class="normal14" colspan="1" ><input type="text" tabIndex="24"   onKeyPress="keyFunction()" id="tk004" name="tk004"  size="60"   value="<?php echo $tk004; ?>"    /></td>
		
		<td class="normal14z" >確認者：</td>   <!-- onchange="startcmsi02(this)"  onchange="check_cmsi02(this)"   -->
        <td  class="normal14"  ><input type="text" tabIndex="5" readonly="value"  onKeyPress="keyFunction()" id="tk007" name="tk007"   value="<?php echo $tk007; ?>" style="background-color:#F0F0F0" size="12" /></td>
	  </tr>
	
	</table>
	
	 
	 <!-- 明細表頭  -->
	 <div style="width:100%; overflow-x: auto;  ">
        <table style="width:100%;"  id="order_product" class="list1">
        <thead>
           <tr>
              <td width="1%"></td>			
		      <?php foreach($usecol_array as $key => $val){
					echo "<td ";
					if(isset($val['width'])){
					echo "width='".$val['width']."' ";}  
					if(isset($val['title_class'])){
						echo "class='".$val['title_class']."' ";}
					if(isset($val['size'])){
						echo "size='".$val['size']."' ";}
					
					echo " >";
					echo $val['name'];
					echo "</td>";
				}?>
            </tr>
        </thead>
		     <?php $current_product_count = 0;//依照資料庫紀錄的明細先列一遍 新增只給初值 ?>
          <tfoot>
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem2();" /></td>
			  <td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
            </tr>
          </tfoot>
       </table>
	</div> 	
	<!-- 合計     -->
		    <!-- <tr>
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
              </tr> -->
		<!-- 合計     -->	  
	<!-- <div class="buttons">
	   <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti09/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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

<?php  include_once("./application/views/funnew/noti06_funmjs_v.php"); ?> <!-- 票據單別 -->
<?php  include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?>  <!-- 人員 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/copi01a_funmjs_v.php"); ?>  <!-- 客戶回傳多欄 -->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?>  <!-- 部門 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->
<?php  include_once("./application/views/funnew/cmsi21_funmjs_v.php"); ?>  <!-- 付款條件 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/noti09_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#noti06').focus();
	}); 	   
</script> 	    	