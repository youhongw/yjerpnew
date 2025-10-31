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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 資產收回建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/ast/asti14/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值
	  if(!isset($te001)) { $te001=$this->input->post('asti03_asti14'); }
	  if(!isset($te002)) { $te002=$this->input->post('te002'); }
	  if(!isset($te003)) { $te003=date("Y/m/d"); }	 
	  if(!isset($te004)) { $te004=$this->input->post('te004'); }
	  if(!isset($te007)) { $te007='0'; }	  
	  if(!isset($te008)) { $te008=date("Y/m/d"); }
	  if(!isset($te009)) { $te009=$username; }
	  if(!isset($te010)) { $te010='N'; } else {$te010=$this->input->post('te010');}
	  if(!isset($te001disp)) { $te001disp=$this->input->post('asti03_asti14disp'); }

	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14a" width="9%"><span class="required">單別：</span></td>
        <td  class="normal14a"  width="25%"  ><input tabIndex="1" id="asti03_asti14" onKeyPress="keyFunction()" onfocus="check_title_no();"  onchange="check_asti03_asti14(this);check_title_no();" name="asti03_asti14" value="<?php echo $te001; ?>" size="12" type="text" required />
		<a href="javascript:;"><img id="Showasti03_asti14disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="asti03_asti14disp"> <?php   echo $te001disp; ?> </span></td>
		  
		  
	    <td class="normal14a" width="8%" >異動日期：</td>  
        <td class="normal14a"  width="25%"><input tabIndex="5"  ondblclick="scwShow(this,event);" id="te003" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="te003"  value="<?php echo $te003; ?>"  size="12" type="text" readonly="value" style="background-color:#F0F0F0"/></td>
	
	  </tr>
	  
	  <tr>	    
		<td class="normal14"><span class="required">單號：</span></td>
        <td class="normal14a"><input tabIndex="2" id="te002" onKeyPress="keyFunction()" readonly="value" name="te002" onfocus="check_title_no();" value="<?php echo $te002; ?>" size="12" type="text" required /></td>
	    
		<td class="normal14">確認者：</td>
        <td class="normal14"><input type="text" tabIndex="6" readonly="value"  onKeyPress="keyFunction()" id="te009" name="te009"  value="<?php echo $te009; ?>" style="background-color:#F0F0F0" size="12"/></td>
		
	  </tr>
	  
	  <tr>
	    <td class="normal14">單據日期：</td>
        <td class="normal14a"  width="25%" ><input tabIndex="3"  ondblclick="scwShow(this,event);"  id="te008" name="te008" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();"   value="<?php echo $te008; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /></td>
        
		<td class="normal14">列印次數：</td>
        <td  class="normal14"><input tabIndex="7" id="te007" onKeyPress="keyFunction()"  onchange="" name="te007"  value="<?php echo $te007; ?>"  size="12" type="text" readonly="value" style="background-color:#F0F0F0" /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14">備註：</td>
        <td class="normal14a"><input tabIndex="4" id="te004" onKeyPress="keyFunction()"  onchange="" name="te004"  value="<?php echo $te004; ?>"  size="24" type="text" /></td>
        
		<td class="normal14">簽核狀態：</td>
        <td class="normal14"><select id="te010" tabIndex="8" readonly="value" onKeyPress="keyFunction()" name="te010"   style="background-color:#F0F0F0" disabled="disabled" >
            <option <?php if($te010 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($te010 == '0') echo 'selected="selected"';?> value='0'>0.待處理</option>
            <option <?php if($te010 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($te010 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($te010 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($te010 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($te010 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($te010 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
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
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ast/asti14/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/asti13_funmjs_v.php"); ?>  <!-- 外送單別 --> 
<?php  include_once("./application/views/funnew/asti14_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#asti03').focus();
	}); 	   
</script> 	    

<script>
/*  function change_tc005(){
	var temp_tc005 = Number($('#tc005').val());
	var asti02_mb012 = Number($('#asti02temp12').val());
	var asti02_mb020 = Number($('#asti02temp20').val());
	var asti02_mb021 = Number($('#asti02temp21').val());
	var asti02_mb029 = Number($('#asti02temp29').val());
	
	var temp_tc006 = formatFloat((asti02_mb020 / asti02_mb012 * temp_tc005),2);
	var temp_tc007 = formatFloat((asti02_mb021 / asti02_mb012 * temp_tc005),2);
	var temp_tc008 = formatFloat((asti02_mb029 / asti02_mb012 * temp_tc005),2);
	
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
}*/
	
function check_tg006(row_obj){	
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}	
	var tg006 = $('#order_product\\['+row+'\\]\\[tg006\\]').val();

	if (tg006 <= 0){
		alert("外送數量需大於零！");
		$('#order_product\\['+row+'\\]\\[tg006\\]').val('');
	}
}	
</script>
<script>
function set_catcomplete3(){
}
</script>