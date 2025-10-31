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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 商品包裝建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/eps/epsi03/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值
	  //預設稅率,廠別,幣別
       $stax_rate = $this->session->userdata('sysma004');
       $sysma200 = $this->session->userdata('sysma200');
	 
	  if(!isset($mb001))    { $mb001=$this->input->post('mb001'); }
	  if(!isset($mb001disp)) { $mb001disp=$this->input->post('mb001disp'); }
	  if(!isset($mb001disp1)) { $mb001disp1=$this->input->post('mb001disp1'); }
	  if(!isset($mb002)) { $mb002=$this->input->post('mb002'); } 
	   if(!isset($mb003)) { $mb003=$this->input->post('mb003'); } 
	  if(!isset($mb004)) { $mb004=$this->input->post('mb004'); } 
	  if(!isset($mb005)) { $mb005=$this->input->post('mb005'); }
	 //  $mb025=$this->input->post('mb025');  一筆存檔清空白
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="12%"><span class="required">商品品號：</span></td>   <!--onchange="startinvi02a(this);check_title_no();"    -->
        <td class="normal14a"  width="48%"><input tabIndex="1" id="invi02a"    onKeyPress="keyFunction()"   name="mb001"  onchange="check_invi02a(this);"  value="<?php echo $mb001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showinvi02adisp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="invi02adisp"> <?php    echo $mb001disp; ?> </span></td>
	    
	    <td class="start14a" width="12%">品名：</td>
        <td class="normal14a" width="48%"><input tabIndex="2" id="mb001disp" onKeyPress="keyFunction()" readonly="value" name="mb001disp"  value="<?php echo $mb001disp; ?>" size="30" type="text" required /></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14">單位：</td>
        <td  class="normal14"  ><input type="text" tabIndex="3"   onKeyPress="keyFunction()" id="mb002" name="mb002"   value="<?php echo $mb002; ?>"  size="12" /></td>
		<td class="start14a" >規格：</td>
        <td class="normal14a" ><input tabIndex="4" id="mb001disp1" onKeyPress="keyFunction()" readonly="value" name="mb001disp1"  value="<?php echo $mb001disp1; ?>" size="30" type="text" required /></td>
	  
		</tr>
		<tr>	    
		<td class="normal14">單位淨重：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5"   onKeyPress="keyFunction()" id="mb003" name="mb003"   value="<?php echo $mb003; ?>"  size="12" /></td>
		<td class="start14a" >主包裝方式：</td>
        <td class="normal14a" ><input type="text" tabIndex="6"   onKeyPress="keyFunction()" id="mb004" name="mb004"   value="<?php echo $mb004; ?>"  size="12" /></td>
	  
		</tr>
	  <tr>	   
		<td class="normal14">備註：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7"   onKeyPress="keyFunction()" id="mb005" name="mb005"   value="<?php echo $mb005; ?>" size="30"  /></td>
        <td class="normal14"></td>
        <td  class="normal14"  ></td>
		
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
	  
	 <div class="buttons">
	   <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('eps/epsi03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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


<?php  include_once("./application/views/funnew/invi02_funmjs_v.php"); ?>  <!-- 品號 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/epsi03_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#invi02a').focus();
	});	
</script> 	    	