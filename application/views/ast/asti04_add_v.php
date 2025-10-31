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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 保險資料建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/ast/asti04/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值
	
	  if(!isset($ta001)) { $ta001=$this->input->post('ta001'); }
	  if(!isset($ta002)) { $ta002=$this->input->post('ta002'); }
	  if(!isset($ta003)) { $ta003=$this->input->post('ta003'); }
	  if(!isset($ta006)) { $ta006=$this->input->post('ta006'); }
	  if(!isset($ta007)) { $ta007=$this->input->post('ta007'); }
	  if(!isset($ta008)) { $ta008=$this->input->post('ta008'); }
	  
	  if(!isset($ta002disp)) { $ta002disp=$this->input->post('ta002disp'); }
	  
	  if(!isset($ta004)) { $ta004=date("Y/m/d"); }
	  if(!isset($ta005)) { $ta005=date("Y/m/d"); }
	  
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="9%"><span class="required">保單號碼：</span></td>   <!--onchange="startasti03(this);check_title_no();"    -->
        <td class="normal14a"  width="24%"><input type="text" tabIndex="1" onKeyPress="keyFunction()" id="ta001" name="ta001"   value="<?php echo $ta001; ?>"  size="12" required/></td>
	    
		<td class="normal14a" width="9%">保險公司：</td>
        <td  class="normal14a" width="24%" ><input tabIndex="2" id="puri01" onKeyPress="keyFunction()"  onchange="check_puri01(this)" name="puri01" value="<?php echo $ta002; ?>" size="12" type="text" style="background-color:#FFFFE4"  />
		  <a href="javascript:;"><img id="Showpuri01disp" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a></td>
		
		<td class="normal14a" width="10%" >保險公司簡稱：</td>  <!-- dateformat_ymd(this); -->
        <td  class="normal14a" width="24%" ><input type="text" tabIndex="3" readonly="value"  onKeyPress="keyFunction()" id="puri01disp" name="puri01disp"   value="<?php echo $ta003; ?>"  size="12" style="background-color:#F0F0F0"  /></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a">投保金額：</td>
        <td  class="normal14"  ><input type="text" tabIndex="3" readonly="value"  onKeyPress="keyFunction()" id="ta006" name="ta006"   value="<?php echo $ta006; ?>"  size="12" style="background-color:#F0F0F0"  /></td>
	   
	   <td class="normal14"></td>
        <td  class="normal14"  ></td>
	   
	    <td class="normal14">保險費：</td>
        <td  class="normal14"  ><input type="text" tabIndex="4" readonly="value"  onKeyPress="keyFunction()" id="ta007" name="ta007"   value="<?php echo $ta007; ?>"  size="12" style="background-color:#F0F0F0"  /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14">保險生效日：</td>
        <td class="normal14a"><input tabIndex="5"  ondblclick="scwShow(this,event);"   id="ta004" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta004"  value="<?php echo $ta004; ?>"  size="12" type="text" style="background-color:#FFFFE4"  />
		<img  onclick="scwShow(ta004,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/></td>
        <td class="normal14">保險到期日：</td>
        <td class="normal14a"><input tabIndex="6"  ondblclick="scwShow(this,event);"   id="ta005" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta005"  value="<?php echo $ta005; ?>"  size="12" type="text" style="background-color:#FFFFE4"  />
		<img  onclick="scwShow(ta005,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/></td>
        <td class="normal14">備註：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" onKeyPress="keyFunction()" id="ta008" name="ta008"   value="<?php echo $ta008; ?>"  size="20"/></td>
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
              </tr>-->
		<!-- 合計     -->	  
	 <div class="buttons">
	   <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ast/asti04/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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

<?php  include_once("./application/views/funnew/asti02_funmjs_v.php"); ?>  <!-- 資產編號 -->
<?php  include_once("./application/views/funnew/puri01_funmjs_v.php"); ?>  <!-- 資產編號 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/asti04_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#ta001').focus();
	}); 	   
</script> 	    	

