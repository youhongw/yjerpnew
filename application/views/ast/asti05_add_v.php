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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 資產盤點資料建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/ast/asti05/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值
	  if(!isset($mf001)) { $mf001=$this->input->post('mf001'); }
	  if(!isset($mf002)) { $mf002=$this->input->post('mf002'); }
	  if(!isset($mf003)) { $mf003=$this->input->post('mf003'); }
	  if(!isset($mf004)) { $mf004=$this->input->post('mf004'); }
	  if(!isset($mf005)) { $mf005=$this->input->post('mf005'); }
	  if(!isset($mf006)) { $mf006=$this->input->post('mf006'); }

	  //$this->session->unset_userdata('docno');
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="10%"><span class="required">盤點編號：</span></td>
        <td class="normal14a" width="40%"><input tabIndex="1" id="mf001" onKeyPress="keyFunction()" name="mf001" onfocus="" value="<?php echo $mf001; ?>" size="12" type="text" required/></td>
				  
	    <td class="normal14a" width="10%" >盤點日期：</td>  
        <td class="normal14a"  width="40%" ><input tabIndex="2" id="mf002" onKeyPress="keyFunction()"  onchange="" name="mf002"  value="<?php echo $mf002; ?>"  size="12" type="text" />
	    <img  onclick="scwShow(mf002,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		 </tr>
	  <tr>
		<td class="normal14">調整單別：</td>
        <td  class="normal14"><input type="text" tabIndex="7" readonly="value"  onKeyPress="keyFunction()" id="mf005" name="mf005"   value="<?php echo $mf005; ?>" size="12"  style="background-color:#F0F0F0"/></td>
        
		<td class="normal14">調整單號：</td>
        <td  class="normal14"  ><input type="text" tabIndex="8" readonly="value"  onKeyPress="keyFunction()" id="mf006" name="mf006"  value="<?php echo $mf006; ?>" style="background-color:#F0F0F0" size="12"/></td>
	   
		</tr>
		<tr>
		<td class="normal14a" >備註：</td>
        <td class="normal14a"  ><input tabIndex="3" id="mf003" onKeyPress="keyFunction()" name="mf003" value="<?php echo $mf003; ?>" size="30" type="text"/></td>
	  	<td class="normal14"></td>
		<td class="normal14"></td>
		</tr>
	</table>
	
	
	
	<!--</div> <!-- </div>div-8 -->
	<!-- </div> <!--</div>  div-7 -->
	 
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
	
	 <div class="buttons">
	   <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ast/asti05/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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

<?php  include_once("./application/views/funnew/asti01_funmjs_v.php"); ?> <!-- 資產類別 -->
<?php  include_once("./application/views/funnew/asti05_funmjs_v.php"); ?> <!-- 主件編號 -->
<?php  include_once("./application/views/funnew/puri01_funmjs_v.php"); ?> <!-- 供應廠商 -->

<!--單身-->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?> <!-- 部門代號 -->
<?php  include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?> <!-- 保管人 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/asti05_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#asti03').focus();
	}); 	   
</script> 	    

<script>
function book_val(){
	var temp_mf020 = Number($('#mf020').val());
	var temp_mf021 = Number($('#mf021').val());
	var temp_mf029 = Number($('#mf029').val());
	
	book_value = temp_mf020 + temp_mf021 - temp_mf029;
	
	$('#book_value').val(book_value);
}
</script>	