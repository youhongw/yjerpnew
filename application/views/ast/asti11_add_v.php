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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 資產折舊建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/ast/asti11/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值
	  if(!isset($tc001)) { $tc001=$this->input->post('asti03_asti11'); }
	  if(!isset($tc002)) { $tc002=$this->input->post('tc002'); }
	  if(!isset($tc003)) { $tc003=date("Y/m/d"); }
	  if(!isset($tc004)) { $tc004=$this->input->post('tc004'); }
	  if(!isset($tc005)) { $tc005='0'; }
	  if(!isset($tc006)) { $tc006='0'; }
	  if(!isset($tc007)) { $tc007='0'; }
	  if(!isset($tc008)) { $tc008='0'; }
	  if(!isset($tc010)) { $tc010='0'; }
	  if(!isset($tc016)) { $tc016='0'; }
	  if(!isset($tc025)) { $tc025=$this->input->post('tc025'); }
	  if(!isset($tc031)) { $tc031=$this->input->post('tc031'); }
	  if(!isset($tc013)) { $tc013=$this->input->post('tc013'); }
	  if(!isset($tc001disp)) { $tc001disp=$this->input->post('asti03_asti11disp'); }
	  if(!isset($tc004disp)) { $tc004disp=$this->input->post('tc004disp'); }
	  if(!isset($tc004disp2)) { $tc004disp2=$this->input->post('tc004disp2'); }
	  if(!isset($tc004disp3)) { $tc004disp3=$this->input->post('tc004disp3'); }
	  
	  if(!isset($tc027)) { $tc027=date("Y/m/d"); }
	  
	  if(!isset($tc032)) { $tc032='N'; } else {$tc032=$this->input->post('tc032');}
	  
	  if(!isset($tc028)) { $tc028=$username; }

	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14" width="8%"><span class="required">單別：</span></td>
        <td  class="normal14" width="92%" ><input tabIndex="1" id="asti03_asti11" onKeyPress="keyFunction()" onfocus="check_title_no();"  onchange="check_asti03_asti11(this);check_title_no();" name="asti03_asti11" value="<?php echo $tc001; ?>" size="12" type="text" required />
		<a href="javascript:;"><img id="Showasti03_asti11disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
        <span id="asti03_asti11disp"> <?php   echo $tc001disp; ?> </span></td>
		  
		</tr>
	  
	  <tr>	    
		<td class="normal14"><span class="required">單號：</span></td>
        <td class="normal14a"><input tabIndex="" id="tc002" onKeyPress="keyFunction()" readonly="value" name="tc002" onfocus="check_title_no();" value="<?php echo $tc002; ?>" size="12" type="text" style="background-color:#F0F0F0" required /></td>
	    
	  </tr>
	  
	  <tr>
	    <td class="normal14">單據日期：</td>
        <td class="normal14a"   ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tc027" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="tc027"  value="<?php echo $tc027; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /></td>
        
	  </tr>
	  
	  <tr>
	    <td class="normal14"><span class="required">資產編號：</span></td>
        <td  class="normal14"  ><input tabIndex="3" id="asti02" onKeyPress="keyFunction()"  onchange="check_asti02(this);" onblur="change_asti11_tc005();" name="asti02" value="<?php echo $tc004; ?>" size="12" type="text" required />
		<a href="javascript:;"><img id="Showasti02disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
       </tr>
	  
	  <tr>
	    <td class="normal14">資產名稱：</td>
        <td  class="normal14"><input type="text" tabIndex="" onKeyPress="keyFunction()" id="asti02disp" name="asti02disp"  value="<?php echo $tc004disp; ?>" size="12" readonly="value" style="background-color:#F0F0F0"/></td>
        </tr>
	  
	  <tr>
	    <td class="normal14">規格：</td>
        <td  class="normal14"><input type="text" tabIndex="" onKeyPress="keyFunction()" id="asti02disp2" name="asti02disp2"  value="<?php echo $tc004disp2; ?>" size="12" readonly="value" style="background-color:#F0F0F0"/></td>
        </tr>
	  
	  <tr>
	    <td class="normal14">備註：</td>
        <td class="normal14a"><input tabIndex="11" id="tc013" onKeyPress="keyFunction()"  onchange="abc(this);" name="tc013"  value="<?php echo $tc013; ?>"  size="24" type="text" /></td>
        </tr>
	  
	  <input type="text" style="display:none" value="0" id="asti02temp12" />
	  <input type="text" style="display:none" value="0" id="asti02temp20" />
	  <input type="text" style="display:none" value="0" id="asti02temp21" />
	  <input type="text" style="display:none" value="0" id="asti02temp29" />
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
	   <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ast/asti11/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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

<?php  include_once("./application/views/funnew/asti02_funmjs_v.php"); ?> <!-- 資產資料 -->
<?php  include_once("./application/views/funnew/asti03_funmjs_v.php"); ?> <!-- 單別 -->

<!--單身-->
<?php  include_once("./application/views/funnew/asti02_funmjs_v.php"); ?> <!-- 由資產編號決定部門代號 -->
<?php  include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?> <!-- 保管人 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/asti11_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#asti03').focus();
	}); 	   
</script> 	    

<script>
function change_asti11_tc005(){
	var temp_tc005 = Number($('#tc005').val());
	var asti02_mb012 = Number($('#asti02temp12').val());
	var asti02_mb020 = Number($('#asti02temp20').val());
	var asti02_mb021 = Number($('#asti02temp21').val());
	var asti02_mb029 = Number($('#asti02temp29').val());
	
	var temp_tc006 = Math.round(formatFloat((asti02_mb020 / asti02_mb012 * temp_tc005),2));
	var temp_tc007 = Math.round(formatFloat((asti02_mb021 / asti02_mb012 * temp_tc005),2));
	var temp_tc008 = Math.round(formatFloat((asti02_mb029 / asti02_mb012 * temp_tc005),2));
	
	console.log('temp_tc006='+temp_tc006);
	console.log('temp_tc007='+temp_tc007);
	console.log('temp_tc008='+temp_tc008);
	
	if(isNaN(temp_tc006)){temp_tc006="0"};
	if(isNaN(temp_tc007)){temp_tc007="0"};
	if(isNaN(temp_tc008)){temp_tc008="0"};
	
	console.log('asti02_mb012='+asti02_mb012);
	console.log('asti02_mb020='+asti02_mb020);
	console.log('asti02_mb021='+asti02_mb021);
	console.log('asti02_mb029='+asti02_mb029);
	
	$('#tc006').val(temp_tc006);
	$('#tc007').val(temp_tc007);
	$('#tc008').val(temp_tc008);
}

function formatFloat(num, pos)
{
  var size = Math.pow(10, pos);
  return Math.round(num * size) / size;
}
</script>	
