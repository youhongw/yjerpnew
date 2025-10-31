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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 資產類別建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/ast/asti01/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值

	  if(!isset($ma001)) { $ma001=$this->input->post('ma001'); }
	  if(!isset($ma002)) { $ma002=$this->input->post('ma002'); }
	  if(!isset($ma003)) { $ma003=$this->input->post('asti02'); }
	  if(!isset($acti03disp)) { $acti03disp=$this->input->post('acti03disp'); }
	  if(!isset($ma004)) { $ma004=$this->input->post('acti03a'); }
	  if(!isset($acti03adisp)) { $acti03adisp=$this->input->post('acti03adisp'); }
	  if(!isset($ma005)) { $ma005=$this->input->post('acti03b'); }
	  if(!isset($ma006)) { $ma006=$this->input->post('ma006'); }
	  if(!isset($acti03bdisp)) { $acti03bdisp=$this->input->post('acti03bdisp'); }
	  if(!isset($ma007)) { $ma007=$this->input->post('ma007'); }
	  if(!isset($ma009)) { $ma009='0'; }

	  if(!isset($ma008)) { $ma008="N"; }
	  //$this->session->unset_userdata('docno');
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="12%"><span class="required">資產類別代號：</span></td>   <!--onchange="startcopi03(this);check_title_no();"    -->
        <td class="normal14a"  width="38%"><input tabIndex="1" id="ma001"    onKeyPress="keyFunction()"   name="ma001" onfocus="" onchange=""  value="<?php echo $ma001; ?>"  type="text" required />

	    <td class="normal14a" width="12%" >資產類別名稱： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="38%" ><input tabIndex="2"  ondblclick="" id="ma002" onKeyPress="keyFunction()"  onchange="" name="ma002"  value="<?php echo $ma002; ?>"   type="text" /></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a">資產科目代號：</td>
        <td class="normal14"  >
			<input tabIndex="3" id="acti03" onKeyPress="keyFunction()" name="acti03" onblur="check_acti03(this);"  value="<?php echo $ma003; ?>"  type="text"    />
			<a href="javascript:;"><img id="Showacti03disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
			<span id="acti03disp"> <?php echo $acti03disp; ?> </span>
		</td>
		
		<td class="normal14">累計折舊科目代號：</td>
        <td class="normal14"  >
			<input tabIndex="4" id="acti03a" onKeyPress="keyFunction()" name="acti03a" onblur="check_acti03a(this);"  value="<?php echo $ma004; ?>"  type="text"    />
			<a href="javascript:;"><img id="Showacti03adisp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
			<span id="acti03adisp"> <?php echo $acti03adisp; ?> </span>
		</td>
	  </tr>
	  
	  <tr>
	   	<td class="normal14">折舊科目代號：</td>
        <td class="normal14"  >
			<input tabIndex="5" id="acti03b" onKeyPress="keyFunction()" name="acti03b" onblur="check_acti03b(this);"  value="<?php echo $ma005; ?>"  type="text"    />
			<a href="javascript:;"><img id="Showacti03bdisp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
			<span id="acti03bdisp"> <?php echo $acti03bdisp; ?> </span>
		</td>
        
		<td class="normal14">耐用月數：</td>
        <td  class="normal14"  ><input type="text" tabIndex="6" onKeyPress="keyFunction()" id="ma007" name="ma007"   value="<?php echo $ma007; ?>"   /></td>
	  </tr>
	  
	  <tr>
	   	<td class="normal14">折舊續提：</td>
        <td class="normal14a">
			<input tabIndex="7" id="ma008" name="ma008" value="Y" onKeyPress="keyFunction()" onclick='turn_ma009(this);' type="checkbox"/>
		</td>
		
		<td class="normal14">折舊方法：</td>
        <td class="normal14"  ><select id="ma006" tabIndex="8" onKeyPress="keyFunction()" name="ma006"  >                                                                     
		    <option <?php if($ma006 == '0') echo 'selected="selected"';?> value='0'>0.不提折舊</option>
            <option <?php if($ma006 == '1') echo 'selected="selected"';?> value='1'>1.平均法</option>
		    <option <?php if($ma006 == '2') echo 'selected="selected"';?> value='2'>2.定率遞減法</option>			
		  </select></td>		
	  </tr>
	  
	   <tr>
	   	<td class="normal14">折畢續提耐用月數：</td>
        <td  class="normal14"  ><input type="text" tabIndex="9" onKeyPress="keyFunction()" id="ma009" name="ma009"   value="<?php echo $ma009; ?>"   readonly="readonly" style="background-color:#F0F0F0" /></td>
	    <td class="normal14"></td>
		<td class="normal14"></td>
	  </tr>
	</table>
	 
	 <!-- 明細表頭  -->
	 <!--<div style="width:100%; overflow-x: auto;  ">
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
	</div> -->
	<!-- 合計     -->
		     <!--<tr>
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
              </tr>-->
		<!-- 合計     -->	  
	 <div class="buttons">
	   <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ast/asti01/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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

<?php  include_once("./application/views/funnew/acti03_funmjs_v.php"); ?>  <!-- 票據科目 -->
<?php  include_once("./application/views/funnew/acti03a_funmjs_v.php"); ?>  <!-- 票據科目 -->
<?php  include_once("./application/views/funnew/acti03b_funmjs_v.php"); ?>  <!-- 票據科目 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/asti01_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#ma001').focus();
	}); 	   
</script> 	    	

<script>
function turn_ma009(ma008){
	if(ma008.checked){
		$('#ma009').removeAttr('readonly','');
		$('#ma009').removeAttr('style','');
	}else{
		$('#ma009').attr('readonly','readonly');
		$('#ma009').attr('style','background-color:#F0F0F0');
		$('#ma009').val('0');
	}
}
</script>