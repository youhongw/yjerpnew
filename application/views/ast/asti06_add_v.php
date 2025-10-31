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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 資產改良建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/ast/asti06/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值

	  if(!isset($tc001)) { $tc001=$this->input->post('asti03_asti06'); }
	  if(!isset($tc001disp)) { $tc001disp=$this->input->post('asti03_asti06disp'); }
	  if(!isset($tc002)) { $tc002=$this->input->post('tc002'); }
	  if(!isset($tc004)) { $tc004=$this->input->post('asti01'); }
	  if(!isset($tc004disp)) { $tc004disp=$this->input->post('asti01disp'); }
	  if(!isset($tc004disp2)) { $tc004disp2=$this->input->post('asti01disp2'); }
	  if(!isset($tc007)) { $tc007=$this->input->post('tc007'); }
	  if(!isset($tc009)) { $tc009=$this->input->post('tc009'); }
	  if(!isset($tc010)) { $tc010=$this->input->post('tc010'); }
	  if(!isset($tc028)) { $tc028=$this->input->post('tc028'); }
	  if(!isset($tc013)) { $tc013=$this->input->post('tc013'); }
	  
	  if(!isset($tc003)) { $tc003=date("Y/m/d"); }
	  if(!isset($tc027)) { $tc027=date("Y/m/d"); }
	  
	  $tc016 = "0";
	  
	  if(!isset($tc032)) { $tc032="N"; }
	  if(!isset($tc031)) { $tc031="N"; }
	  //$this->session->unset_userdata('docno');
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="9%"><span class="required">單別：</span></td>   <!--onchange="startcopi03(this);check_title_no();"    -->
        <td class="normal14a"  width="24%"><input tabIndex="1" id="asti03_asti06"    onKeyPress="keyFunction()"   name="asti03_asti06"  onchange="check_asti03_asti06(this);check_title_no();"  value="<?php echo $tc001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showasti03_asti06disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="asti03_asti06disp"> <?php    echo $tc001disp; ?> </span></td>
	    <td class="normal14a" width="10%" >單據日期： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="23%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tc027" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="tc027"  value="<?php echo $tc027; ?>"  size="12" type="text" style="background-color:#FFFFE4"  />
		  <img  onclick="scwShow(tc027,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/></td>
	    <td class="start14a" width="10%"><span class="required">單號：</span></td>
        <td class="normal14a" width="23%"><input tabIndex="3" id="tc002" onKeyPress="keyFunction()" readonly="value" name="tc002" onfocus="check_title_no();" value="<?php echo $tc002; ?>" size="12" type="text" required /></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a"><span class="required">資產編號：</span></td>
        <td  class="normal14"  ><input tabIndex="4" id="asti02" onKeyPress="keyFunction()"  onchange="check_asti02(this)" name="asti02" value="<?php echo $tc004; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showasti02disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
          <span id="asti02disp"> <?php   echo $tc004disp; ?> </span></td>
	    <td class="normal14">資產規格：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" readonly="value"  onKeyPress="keyFunction()" id="asti02disp2" name="asti02disp2"   value="<?php echo $tc004disp2; ?>" style="background-color:#F0F0F0" size="12" /></td>
	    <td class="normal14"></td>
		<td class="normal14"></td>
	  </tr>
	  
	  <tr>
	   	<td class="normal14">改良成本：</td>
        <td  class="normal14"  ><input type="text" tabIndex="6" onKeyPress="keyFunction()" id="tc007" name="tc007"   value="<?php echo "0"; ?>"  size="12" /></td>
        <td class="normal14">增減未攤月數：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" onKeyPress="keyFunction()" id="tc009" name="tc009"   value="<?php echo "0"; ?>"  size="12" /></td>
        <td class="normal14">增減預留殘值：</td>
        <td  class="normal14"  ><input type="text" tabIndex="8" onKeyPress="keyFunction()" id="tc010" name="tc010"   value="<?php echo "0"; ?>"  size="12" /></td>
	  </tr>
	  
	  <tr>
	   	<td class="normal14">異動日期：</td>
        <td  class="normal14"  ><input type="text" tabIndex="9" readonly="value"  onKeyPress="keyFunction()" id="tc003" name="tc003"   value="<?php echo $tc003; ?>" style="background-color:#F0F0F0" size="12" /></td>
        <td class="normal14">列印次數：</td>
        <td  class="normal14"  ><input type="text" tabIndex="10" readonly="value"  onKeyPress="keyFunction()" id="tc016" name="tc016"   value="<?php echo $tc016; ?>" style="background-color:#F0F0F0" size="12" /></td>
        <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="11" readonly="value"  onKeyPress="keyFunction()" id="tc028" name="tc028"   value="<?php echo $tc028; ?>" style="background-color:#F0F0F0" size="12" /></td>
	  </tr>
	  
	   <tr>
	   	<td class="normal14">產生分錄：</td>
        <td  class="normal14"  ><input type="hidden" name="tc031" value="N" />	
		  <input  type='checkbox' tabIndex="12" id="tc031" onKeyPress="keyFunction()" name="tc031" <?php if($tc031 == 'Y' ) echo 'checked'; ?>  <?php if($tc031 != 'Y' ) echo 'check'; ?> value="Y" size="1"/>
        </td>
        <td class="normal14">簽核狀態：</td>
         <td class="normal14"  ><select id="tc032" tabIndex="13" readonly="value" onKeyPress="keyFunction()" name="tc032"   style="background-color:#F0F0F0" >
            <option <?php if($tc032 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tc032 == '0') echo 'selected="selected"';?> value='0'>0.待處理</option>
            <option <?php if($tc032 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tc032 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tc032 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tc032 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tc032 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tc032 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>		
        <td class="normal14">備註：</td>
        <td  class="normal14"  ><input type="text" tabIndex="14" onKeyPress="keyFunction()" id="tc013" name="tc013"   value="<?php echo $tc013; ?>" size="12" /></td>
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
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ast/asti06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/asti03_funmjs_v.php"); ?> <!-- 單別 -->
<?php  include_once("./application/views/funnew/asti02_funmjs_v.php"); ?>  <!-- 資產編號 -->

<?php  include_once("./application/views/funnew/asti06_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#asti03_asti06').focus();
	}); 	   
</script> 	    	