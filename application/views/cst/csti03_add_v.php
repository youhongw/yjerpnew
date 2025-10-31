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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 線別成本建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/cst/csti03/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值

	/*  if(!isset($mc001) { $mc001=$this->input->post('mc001'); }*/
	  if(!isset($mc001disp)) { $mc001disp=$this->input->post('mc001disp'); }
	  if(!isset($mc001disp1)) { $mc001disp1=$this->input->post('mc001disp1'); }
	  if(!isset($mc001disp2)) { $mc001disp2=$this->input->post('mc001disp2'); }
	  if(!isset($mc001)) { $mc001=$this->input->post('mc001'); }
	  if(!isset($mc002)) { $mc002=$this->input->post('mc002'); }
	  if(!isset($mc003)) { $mc003=$this->input->post('mc003'); }
	  if(!isset($mc004)) { $mc004=$this->input->post('mc004'); }
	  if(!isset($mc005)) { $mc005=$this->input->post('mc005'); }
      if(!isset($mc006)) { $mc006=$this->input->post('mc006'); }
	  if(!isset($mc007)) { $mc007=$this->input->post('mc007'); }
	  if(!isset($mc008)) { $mc008=$this->input->post('mc008'); } 
	  
	  //$this->session->unset_userdata('docno');
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="12%"><span class="required">生產線別：</span></td>   
        <td class="normal14a"  width="38%"><input tabIndex="1" id="mc001"    onKeyPress="keyFunction()"   name="mc001" onfocus="" onchange=""  value="<?php echo $mc001; ?>"  type="text" required />

	    <td class="normal14a" width="12%" >線別名稱： </td>  
        <td class="normal14a"  width="38%" ><input tabIndex="2"  ondblclick="" id="mc001disp" onKeyPress="keyFunction()"  onchange="" name="mc001disp"  value="<?php echo $mc001disp; ?>"   type="text" style="background-color:#F0F0F0"/></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a">年月：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mc002" onKeyPress="keyFunction()" name="mc002"   value="<?php echo $mc002; ?>"     />		
		</td>
		<td class="normal14a"></td>
        <td class="normal14"  >
				
		</td>
		
	  </tr>
	  <tr>	    
		<td class="normal14a">人工成本：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mc003" onKeyPress="keyFunction()" name="mc003"   value="<?php echo $mc003; ?>"      />		
		</td>
		<td class="normal14a">單位人工：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mc001disp1" onKeyPress="keyFunction()" name="mc001disp1"   value="<?php echo $mc001disp1; ?>"  readonly="readonly" style="background-color:#F0F0F0"   />		
		</td>
		
	  </tr>
	  <tr>	    
		<td class="normal14a">製造費用：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mc004" onKeyPress="keyFunction()" name="mc004"   value="<?php echo $mc004; ?>"      />		
		</td>
		<td class="normal14a">單位製費：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mc001disp2" onKeyPress="keyFunction()" name="mc001disp2"   value="<?php echo $mc001disp2; ?>"  readonly="readonly" style="background-color:#F0F0F0"   />		
		</td>
		
	  </tr>
	  <tr>	    
		<td class="normal14a">人工小時：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mc005" onKeyPress="keyFunction()" name="mc005"   value="<?php echo $mc005; ?>"      />		
		</td>
		<td class="normal14a">標準單位人工：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mc007" onKeyPress="keyFunction()" name="mc007"   value="<?php echo $mc007; ?>"   />		
		</td>
	  </tr>
	  <tr>	    
		<td class="normal14a">機器小時：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mc006" onKeyPress="keyFunction()" name="mc006"   value="<?php echo $mc006; ?>"      />		
		</td>
		<td class="normal14a">標準單位製費：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mc008" onKeyPress="keyFunction()" name="mc008"   value="<?php echo $mc008; ?>"     />		
		</td>
	  </tr>
	   <tr>	    
		<td class="normal14a">使用機時：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mc006" onKeyPress="keyFunction()" name="mc006"   value="<?php echo $mc006; ?>"      />		
		</td>
		<td class="normal14a"></td>
        <td class="normal14"  >
					
		</td>
	  </tr>
	  
	</table>
	 
	 
	  
	 <div class="buttons">
	   <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cst/csti03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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

<?php // include_once("./application/views/funnew/acti03b_funmjs_v.php"); ?>  <!-- 生產線別 -->
<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->

<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#mc001').focus();
	}); 	   
</script> 	    	

<script>
function turn_mc009(mc008){
	if(mc008.checked){
		$('#mc009').removeAttr('readonly','');
		$('#mc009').removeAttr('style','');
	}else{
		$('#mc009').attr('readonly','readonly');
		$('#mc009').attr('style','background-color:#F0F0F0');
		$('#mc009').val('0');
	}
}
</script>