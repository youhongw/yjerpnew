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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 製令工時建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/cst/csti02/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值

	  if(!isset($mb001)) { $mb001=$this->input->post('mb001'); }
	  if(!isset($mb001disp)) { $mb001disp=$this->input->post('mb001disp'); }
	  if(!isset($mb002)) { $mb002=$this->input->post('mb002'); }
	  if(!isset($mb003)) { $mb003=$this->input->post('mb003'); }
	  if(!isset($mb004)) { $mb004=$this->input->post('mb004'); }
	  if(!isset($mb004disp)) { $mb004disp=$this->input->post('mb004'); }
	  if(!isset($mb004disp1)) { $mb004disp1=$this->input->post('mb004'); }
	  if(!isset($mb005)) { $mb005=$this->input->post('mb005'); }
      if(!isset($mb006)) { $mb006=$this->input->post('mb006'); }
	  if(!isset($mb007)) { $mb007=$this->input->post('mb007'); }
	  if(!isset($mb007disp)) { $mb007disp=$this->input->post('mb007'); }
	  if(!isset($mb007disp1)) { $mb007disp1=$this->input->post('mb007'); }
	  if(!isset($mb007disp2)) { $mb007disp2=$this->input->post('mb007'); }
	  
	  if(!isset($mb008)) { $mb008="N"; }
	  //$this->session->unset_userdata('docno');
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="12%"><span class="required">生產線別：</span></td>   
        <td class="normal14a"  width="38%"><input tabIndex="1" id="mb001"    onKeyPress="keyFunction()"   name="mb001" onfocus="" onchange=""  value="<?php echo $mb001; ?>"  type="text" required />

	    <td class="normal14a" width="12%" >產品品號： </td>  
        <td class="normal14a"  width="38%" ><input tabIndex="2"  ondblclick="" id="mb002" onKeyPress="keyFunction()"  onchange="" name="mb002"  value="<?php echo $mb002; ?>"   type="text" style="background-color:#F0F0F0"/></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a">線別名稱：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb001disp" onKeyPress="keyFunction()" name="mb001disp"   value="<?php echo $mb001disp; ?>"  readonly="readonly" style="background-color:#F0F0F0"   />		
		</td>
		<td class="normal14a">品名：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb007disp" onKeyPress="keyFunction()" name="mb007disp"   value="<?php echo $mb007disp; ?>"  readonly="readonly" style="background-color:#F0F0F0"    />		
		</td>
		
	  </tr>
	  <tr>	    
		<td class="normal14a">日期：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb002" onKeyPress="keyFunction()" name="mb002"   value="<?php echo $mb002; ?>"      />		
		</td>
		<td class="normal14a">規格：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb007disp1" onKeyPress="keyFunction()" name="mb007disp1"   value="<?php echo $mb007disp1; ?>"  readonly="readonly" style="background-color:#F0F0F0"   />		
		</td>
		
	  </tr>
	  <tr>	    
		<td class="normal14a">製令單別：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb003" onKeyPress="keyFunction()" name="mb003"   value="<?php echo $mb003; ?>"      />		
		</td>
		<td class="normal14a">單位：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb007disp2" onKeyPress="keyFunction()" name="mb007disp2"   value="<?php echo $mb007disp2; ?>"  readonly="readonly" style="background-color:#F0F0F0"   />		
		</td>
		
	  </tr>
	  <tr>	    
		<td class="normal14a">製令單號：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb004" onKeyPress="keyFunction()" name="mb004"   value="<?php echo $mb004; ?>"      />		
		</td>
		<td class="normal14a">預計產量：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb004disp" onKeyPress="keyFunction()" name="mb004disp"   value="<?php echo $mb004disp; ?>"  readonly="readonly"  style="background-color:#F0F0F0"  />		
		</td>
	  </tr>
	  <tr>	    
		<td class="normal14a">使用人時：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb005" onKeyPress="keyFunction()" name="mb005"   value="<?php echo $mb005; ?>"      />		
		</td>
		<td class="normal14a">已計產量：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb004disp1" onKeyPress="keyFunction()" name="mb004disp1"   value="<?php echo $mb004disp1; ?>"  readonly="readonly" style="background-color:#F0F0F0"   />		
		</td>
	  </tr>
	   <tr>	    
		<td class="normal14a">使用機時：</td>
        <td class="normal14"  >
			<input type="text" tabIndex="3" id="mb006" onKeyPress="keyFunction()" name="mb006"   value="<?php echo $mb006; ?>"      />		
		</td>
		<td class="normal14a"></td>
        <td class="normal14"  >
					
		</td>
	  </tr>
	  
	</table>
	 
	 <!-- 明細表頭  -->
	 		
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
          
	  
	 <div class="buttons">
	   <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cst/csti02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
	$('#mb001').focus();
	}); 	   
</script> 	    	

<script>
function turn_mb009(mb008){
	if(mb008.checked){
		$('#mb009').removeAttr('readonly','');
		$('#mb009').removeAttr('style','');
	}else{
		$('#mb009').attr('readonly','readonly');
		$('#mb009').attr('style','background-color:#F0F0F0');
		$('#mb009').val('0');
	}
}
</script>