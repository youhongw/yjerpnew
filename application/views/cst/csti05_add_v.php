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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 產品成本建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/cst/csti05/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值

	/*  if(!isset($mv001) { $mv001=$this->input->post('mv001'); }*/
	  if(!isset($mv001disp)) { $mv001disp=$this->input->post('mv001disp'); }
	  if(!isset($mv001disp1)) { $mv001disp1=$this->input->post('mv001disp1'); }
	  if(!isset($mv001disp2)) { $mv001disp2=$this->input->post('mv001disp2'); }
	  if(!isset($mv001)) { $mv001=$this->input->post('mv001'); }
	  if(!isset($mv002)) { $mv002=$this->input->post('mv002'); }
	  if(!isset($mv003)) { $mv003=$this->input->post('mv003'); }
	  if(!isset($mv004)) { $mv004=$this->input->post('mv004'); }
	  if(!isset($mv005)) { $mv005=$this->input->post('mv005'); }
      if(!isset($mv006)) { $mv006=$this->input->post('mv006'); }
	  if(!isset($mv007)) { $mv007=$this->input->post('mv007'); }
	  if(!isset($mv008)) { $mv008=$this->input->post('mv008'); } 
	  if(!isset($mv009)) { $mv009=$this->input->post('mv009'); }
	  if(!isset($mv010)) { $mv010=$this->input->post('mv010'); }
	  if(!isset($mv011)) { $mv011=$this->input->post('mv011'); }
	  if(!isset($mv012)) { $mv012=$this->input->post('mv012'); }
	  if(!isset($mv013)) { $mv013=$this->input->post('mv013'); }
      if(!isset($mv014)) { $mv014=$this->input->post('mv014'); }
	  if(!isset($mv015)) { $mv015=$this->input->post('mv015'); }
	  if(!isset($mv016)) { $mv016=$this->input->post('mv016'); } 
	  if(!isset($mv017)) { $mv017=$this->input->post('mv017'); }
      if(!isset($mv018)) { $mv018=$this->input->post('mv018'); }
	  if(!isset($mv019)) { $mv019=$this->input->post('mv019'); }
	  if(!isset($mv020)) { $mv020=$this->input->post('mv020'); }
	  
	  //$this->session->unset_userdata('docno');
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="11%"><span class="required">產品品號：</span></td>   
        <td class="normal14a"  width="39%"><input tabIndex="1" id="mv001"    onKeyPress="keyFunction()"   name="mv001" onfocus="" onchange=""  value="<?php echo $mv001; ?>"  type="text" required />

	    <td class="normal14a" width="11%" >品名： </td>  
        <td class="normal14a"  width="39%" ><input tabIndex="2"  ondblclick="" id="mv001disp" onKeyPress="keyFunction()"  onchange="" name="mv001disp"  value="<?php echo $mv001disp; ?>"   type="text" style="background-color:#F0F0F0"/></td>
	  </tr>
	  <tr>	    
		<td class="normal14a">規格：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv001disp1" onKeyPress="keyFunction()" name="mv001disp1"   value="<?php echo $mv001disp1; ?>"  readonly="readonly" style="background-color:#F0F0F0"    />		
		</td>
		<td class="normal14a">單位：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv001disp2" onKeyPress="keyFunction()" name="mv001disp2"   value="<?php echo $mv001disp2; ?>"  readonly="readonly" style="background-color:#F0F0F0"   />		
		</td>
		
	  </tr>
	  <tr>	    
		<td class="normal14a">年月：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv002" onKeyPress="keyFunction()" name="mv002"   value="<?php echo $mv002; ?>"     />		
		</td>
		<td class="normal14a"></td>
        <td class="normal14"  >
				
		</td>
		
	  </tr>
	  <tr>	    
		<td class="normal14a">生產入庫：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv003" onKeyPress="keyFunction()" name="mv003"   value="<?php echo $mv003; ?>"      />		
		</td>
		<td class="normal14a">下階人工成本：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv011" onKeyPress="keyFunction()" name="mv011"   value="<?php echo $mv011; ?>"   />		
		</td>
	  </tr>
	   <tr>	    
		<td class="normal14a">託外進貨：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv004" onKeyPress="keyFunction()" name="mv004"   value="<?php echo $mv004; ?>"      />		
		</td>
		<td class="normal14a">下階製造費用：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv012" onKeyPress="keyFunction()" name="mv012"   value="<?php echo $mv012; ?>"   />		
		</td>
	  </tr>
	  <tr>	    
		<td class="normal14a">材料在製約量：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv005" onKeyPress="keyFunction()" name="mv005"   value="<?php echo $mv005; ?>"      />		
		</td>
		<td class="normal14a">下階加工費用：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv013" onKeyPress="keyFunction()" name="mv013"   value="<?php echo $mv013; ?>"   />		
		</td>
	  </tr>
	   <tr>	    
		<td class="normal14a">人工製費在製約量：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv006" onKeyPress="keyFunction()" name="mv006"   value="<?php echo $mv006; ?>"      />		
		</td>
		<td class="normal14a"></td>
        <td class="normal14"  >
				
		</td>
	  </tr>
	   <tr>	    
		<td class="normal14a">加工費用在製約量：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv006" onKeyPress="keyFunction()" name="mv006"   value="<?php echo $mv006; ?>"      />		
		</td>
		<td class="normal14a"></td>
        <td class="normal14"  >
				
		</td>
	  </tr>
	   <tr>	    
		<td class="normal14a">材料成本：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv007" onKeyPress="keyFunction()" name="mv007"   value="<?php echo $mv007; ?>"      />		
		</td>
		<td class="normal14a">單位材料成本：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv015" onKeyPress="keyFunction()" name="mv015"   value="<?php echo $mv015; ?>" readonly="readonly" style="background-color:#F0F0F0"   />		
		</td>
	  </tr>
	  <tr>	    
		<td class="normal14a">人工成本：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv008" onKeyPress="keyFunction()" name="mv008"   value="<?php echo $mv008; ?>"      />		
		</td>
		<td class="normal14a">單位人工成本：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv016" onKeyPress="keyFunction()" name="mv016"   value="<?php echo $mv016; ?>"  readonly="readonly" style="background-color:#F0F0F0"   />		
		</td>
		
	  </tr>
	  <tr>	    
		<td class="normal14a">製造費用：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv009" onKeyPress="keyFunction()" name="mv009"   value="<?php echo $mv009; ?>"      />		
		</td>
		<td class="normal14a">單位製造費用：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv017" onKeyPress="keyFunction()" name="mv017"   value="<?php echo $mv017; ?>"  readonly="readonly" style="background-color:#F0F0F0"   />		
		</td>
		
	  </tr>
	   <tr>	    
		<td class="normal14a">加工費用：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv010" onKeyPress="keyFunction()" name="mv010"   value="<?php echo $mv010; ?>"      />		
		</td>
		<td class="normal14a">單位加工費用：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv018" onKeyPress="keyFunction()" name="mv018"   value="<?php echo $mv018; ?>"   readonly="readonly" style="background-color:#F0F0F0"  />		
		</td>
		
	  </tr>
	    <tr>	    
		<td class="normal14a">生產成本：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv020" onKeyPress="keyFunction()" name="mv020"   value="<?php echo $mv020; ?>"   readonly="readonly" style="background-color:#F0F0F0"    />		
		</td>
		<td class="normal14a">單位生產成本：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mv019" onKeyPress="keyFunction()" name="mv019"   value="<?php echo $mv019; ?>"  readonly="readonly" style="background-color:#F0F0F0"   />		
		</td>
		
	  </tr>
	  
	  
	  
	</table>
	 
	 
	  
	 <div class="buttons">
	   <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cst/csti05/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
	$('#mv001').focus();
	}); 	   
</script> 	    	

<script>
function turn_mv009(mv008){
	if(mv008.checked){
		$('#mv009').removeAttr('readonly','');
		$('#mv009').removeAttr('style','');
	}else{
		$('#mv009').attr('readonly','readonly');
		$('#mv009').attr('style','background-color:#F0F0F0');
		$('#mv009').val('0');
	}
}
</script>