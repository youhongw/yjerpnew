<?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'tc003' || $key == 'tc027'){
		$$key = stringtodate("Y/m/d",$val);   //自訂函數 main_head_v
	}
	
}
$body_data = $result['body_data'];
$data_count = count($body_data);
/*echo "<pre>";
//var_dump($col_array);
//var_dump($body_data);
var_dump($usecol_array);
echo "</pre>";*/
?>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 資產報廢建立作業 - 修改</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ast/asti08/updsave" method="post" enctype="multipart/form-data" >
	<div id="tab-general"> <!-- div-6 -->
	
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="start14a" width="8%"><span class="required">單別：</span></td>
        <td  class="normal14a" width="25%" ><input tabIndex="" id="asti03_asti08" onKeyPress="keyFunction()" onfocus=""  onchange="check_asti03_asti08(this);" name="asti03_asti08" value="<?php echo $tc001; ?>" size="12" type="text"  required />
		<a href="javascript:;"><img id="" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="asti03_asti08disp"> <?php   echo $tc001disp; ?> </span></td>
		  
		  
	    <td class="normal14a" width="10%" >數量：</td>  
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="tc005" onKeyPress="keyFunction()"  onblur="change_asti08_tc005();" name="tc005" value="<?php echo $tc005; ?>" size="12" type="text" /></td>
	    
		<td class="normal14a" width="8%">單位：</td>
        <td class="normal14a"  width="25%" ><input type="text" tabIndex="" onKeyPress="keyFunction()" id="asti02disp3" name="asti02disp3"  value="<?php echo $tc004disp3; ?>" size="12" readonly="value" style="background-color:#F0F0F0"/></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14">單據日期：</td>
        <td class="normal14a"  width="25%" ><input tabIndex="1" onfocus="this.select" ondblclick="scwShow(this,event);"   id="tc027" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="tc027"  value="<?php echo $tc027; ?>"  size="12" type="text" style="background-color:#FFFFE4"  />
		<img  onclick="scwShow(tc027,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/></td>
        
		<td class="normal14a">轉銷取得成本：</td>
        <td class="normal14a"><input tabIndex="4" id="tc006" onKeyPress="keyFunction()"  onchange="" name="tc006"  value="<?php echo $tc006; ?>"  size="12" type="text" /></td>
		
	    <td class="normal14"></td>
        <td  class="normal14"></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14"><span class="required">單號：</span></td>
        <td class="normal14a"><input tabIndex="" id="tc002" onKeyPress="keyFunction()" readonly="value" name="tc002" onfocus="" value="<?php echo $tc002; ?>" size="12" type="text" required  /></td>
	    
		<td class="normal14">轉銷改良成本：</td>
        <td  class="normal14"><input tabIndex="5" id="tc007" onKeyPress="keyFunction()"  onchange="" name="tc007"  value="<?php echo $tc007; ?>"  size="12" type="text" /></td>
        
		<td class="normal14"></td>
        <td  class="normal14"></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14"><span class="required">資產編號：</span></td>
        <td  class="normal14"  ><input tabIndex="2" id="asti02" onKeyPress="keyFunction()"  onchange="check_asti02(this)" name="asti02" value="<?php echo $tc004; ?>" size="12" type="text"  required/>
		<a href="javascript:;"><img id="Showasti02disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		
		<td class="normal14">轉銷累積折舊：</td>
        <td  class="normal14"><input tabIndex="6" id="tc008" onKeyPress="keyFunction()"  onchange="" name="tc008"  value="<?php echo $tc008; ?>"  size="12" type="text" /></td>
        
		<td class="normal14">列印次數：</td>
        <td  class="normal14"><input tabIndex="" id="tc016" onKeyPress="keyFunction()"  onchange="" name="tc016"  value="<?php echo $tc016; ?>"  size="12" type="text" readonly="value" style="background-color:#F0F0F0" /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14">資產名稱：</td>
        <td  class="normal14"><input type="text" tabIndex="" onKeyPress="keyFunction()" id="asti02disp" name="asti02disp"  value="<?php echo $tc004disp; ?>" size="12" readonly="value" style="background-color:#F0F0F0"/></td>
        
		<td class="normal14">增減預留殘值：</td>
        <td  class="normal14"><input tabIndex="7" id="tc010" onKeyPress="keyFunction()"  onchange="" name="tc010"  value="<?php echo $tc010; ?>"  size="12" type="text" /></td>
        
		<td class="normal14">異動日期：</td>
        <td  class="normal14"><input tabIndex=""  ondblclick="scwShow(this,event);" id="tc003" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="tc003"  value="<?php echo $tc003; ?>"  size="12" type="text" readonly="value" style="background-color:#F0F0F0"/></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14">規格：</td>
        <td  class="normal14"><input type="text" tabIndex="" onKeyPress="keyFunction()" id="asti02disp2" name="asti02disp2"  value="<?php echo $tc004disp2; ?>" size="12" readonly="value" style="background-color:#F0F0F0"/></td>
        
		<td class="normal14">自動銷帳：</td>
        <td class="normal14"><input type="hidden" name="tc025" value="N" />
		<input tabIndex="8" id="tc025" onKeyPress="keyFunction()" name="tc025" <?php if($tc025 == 'Y' ) echo 'checked'; ?>  <?php if($tc025 !== 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td>		
        
		<td class="normal14">產生分錄：</td>
        <td class="normal14"><input type="hidden" name="tc031" value="N" />
		<input tabIndex="9" id="tc031" onKeyPress="keyFunction()" name="tc031" <?php if($tc031 == 'Y' ) echo 'checked'; ?>  <?php if($tc025 !== 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td>		
	  </tr>
	  
	  <tr>
	    <td class="normal14">備註：</td>
        <td class="normal14a"><input tabIndex="10" id="tc013" onKeyPress="keyFunction()"  onchange="" name="tc013"  value="<?php echo $tc013; ?>"  size="24" type="text" /></td>
        
		<td class="normal14">簽核狀態：</td>
        <td class="normal14"><select id="tc032" tabIndex="" readonly="value" onKeyPress="keyFunction()" name="tc032"   style="background-color:#F0F0F0" disabled="disabled" >
            <option <?php if($tc032 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tc032 == '0') echo 'selected="selected"';?> value='0'>0.待處理</option>
            <option <?php if($tc032 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tc032 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tc032 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tc032 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tc032 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tc032 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
        
		<td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="" readonly="value"  onKeyPress="keyFunction()" id="tc028" name="tc028"  value="<?php echo $tc028; ?>" style="background-color:#F0F0F0" size="12"/></td>
	  </tr>
	  
	  <input type="text" style="display:none" value="0" id="asti02temp12" />
	  <input type="text" style="display:none" value="0" id="asti02temp20" />
	  <input type="text" style="display:none" value="0" id="asti02temp21" />
	  <input type="text" style="display:none" value="0" id="asti02temp29" />
	</table>
	
	  <div style="width:100%; overflow-x: auto;  ">
        <table style="width:100%;"  id="order_product" class="list1">
        <thead>     <!--  明細表頭群組 -->
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
        <!--  依照資料庫紀錄的明細先列一遍 原0會由1加  -->
            <?php $current_product_count = 0; ?>
			<?php foreach($body_data as $key => $val){
				$current_product_count++;
				echo "<tbody id='product_row_".$current_product_count."' class='product_row' >";
				echo "<tr>";
				echo "<td class='center'><img src='".base_url()."assets/image/delete.png' title='刪除資料' onclick='del_detail(\"".$tc001."\",\"".$tc002."\",\"".$val->asti02_asti08."\",\"".$val->asti02_asti08_mc003."\",\"".$current_product_count."\");' /></td>";
				foreach($usecol_array as $k => $v){
					if($k=="td013" ){
						//$s = substr($val->$k,0,4)."/".substr($val->$k,4,2)."/".substr($val->$k,6,2);
						$s = stringtodate("Y/m/d",$val->$k);
					}else{
						$s = $val->$k;
					}
					
					if(isset($v['type'])){$type = $v['type'];}else{$type = "text";}
					
					echo "<td nowrap='value'";  //1060728  加nowrap 圖示在同一行
					if(isset($v['data_class'])){echo "class='".$v['data_class']."'";}
					if(isset($v['align'])){echo "align='".$v['align']."'";}
					echo ">";
					
					if($type == "text"){
						echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".$s."'  onKeyPress='keyFunction()' ";
					//	if(isset($v['value'])){echo value='".$val->$k."';} value='".$val->$k."'
						if(isset($v['size'])){echo "size='".$v['size']."' ";}
						if(isset($v['id'])){echo "id='".$v['id']."' ";}
						if(isset($v['onclick'])){echo "onclick=\"".$v['onclick']."\" ";}
						if(isset($v['onfocus'])){echo "onfocus=\"".$v['onfocus']."\" ";}
						if(isset($v['ondblclick'])){echo "ondblclick=\"".$v['ondblclick']."\" ";}
						if(isset($v['onchange'])){echo "onchange=\"".$v['onchange']."\" ";}
						if(isset($v['style'])){echo "style='".$v['style']."' ";}
						if(isset($v['readonly'])){echo "readonly='".$v['readonly']."' ";}
						if(isset($v['disable'])){echo "disable='".$v['disable']."' ";}    //see 加disabled
						echo " />";
					}
					
					if($type == "select" && isset($v['option'])){
						echo "<select id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".$val->$k."' onKeyPress='keyFunction()' ";
						if(isset($v['size'])){echo "size='".$v['size']."' ";}
						if(isset($v['onclick'])){echo "onclick=\"".$v['onclick']."\" ";}
						if(isset($v['ondblclick'])){echo "ondblclick=\"".$v['ondblclick']."\" ";}
						if(isset($v['onchange'])){echo "onchange=\"".$v['onchange']."\" ";}
						if(isset($v['style'])){echo "style='".$v['style']."' ";}
						if(isset($v['readonly'])){echo "readonly='".$v['readonly']."' ";}
						if(isset($v['disable'])){echo "disable='".$v['disable']."' ";}
						echo " >";
						foreach($v['option'] as $op_k => $op_v){
							echo "<option ";
							if($val->$k == $op_k){echo "selected='selected' ";}
							echo "value='".$op_k ."'>";
							echo $op_k.".".$op_v;
							echo "</option>";
						}
						echo "</select>";
					}
					
					if($type == "checkbox"){
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".$val->$k."' onKeyPress='keyFunction()' ";
									echo " />";
								}
								
					if($v['name'] == '品號圖示1'){
									echo "<a href=javascript:";
									echo "/>";
									
									echo "<img name='order".$current_product_count."' id='order".$current_product_count."' alt='' align='top' src=";
									echo base_url()."assets/image/png/seek.png";
									echo " />";
								}
								
					if($v['name'] == '折扣率%'){echo "<span  name='orderd".$current_product_count."' id='orderd".$current_product_count."'  align='top' >%</span>";}
								
					echo "</td>";
				}
				
				echo "</tr>";
				echo "</tbody>";
			}?>
			<!-- 頁尾群組  -->
			<tfoot>
		
            <tr>
             <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem()" /></td>
			  <td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
            </tr>
			  
            </tfoot>
          </table>
        </div>
	 </div>

	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="totalSum();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ast/asti08/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
	  ?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('ast/asti08/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
	  <?php } ?>
	  <?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
	  ?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('ast/asti08/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
	  <?php } ?>	
	  </div> 
	  </div> <!-- div-加 -->
    </form>  <!-- end 表單 -->
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,欄位淡黃色按2下開視窗查詢,圖示1客戶商品計價查詢,Alt+y跳到明細資料, Alt+w新增一筆明細. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

 
    </div> <!-- div-3 --> 
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
<form action="<?php echo base_url()?>index.php/ast/asti08/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
		
<?php  include_once("./application/views/funnew/asti02_funmjs_v.php"); ?> <!-- 資產資料 -->
<?php  include_once("./application/views/funnew/asti03_funmjs_v.php"); ?> <!-- 單別 -->

<!--單身-->
<?php  include_once("./application/views/funnew/asti02_funmjs_v.php"); ?> <!-- 由資產編號決定部門代號 -->
<?php  include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?> <!-- 保管人 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/asti08_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 


<script>
function set_catcomplete3(){
	
}
$(document).ready(function(){
	check_asti02($('#asti02'));
})
function change_asti08_tc005(){
	var temp_tc005 = Number($('#tc005').val());
	var asti02_mb012 = Number($('#asti02temp12').val());
	var asti02_mb020 = Number($('#asti02temp20').val());
	var asti02_mb021 = Number($('#asti02temp21').val());
	var asti02_mb029 = Number($('#asti02temp29').val());
	
	var temp_tc006 = Math.round(formatFloat((asti02_mb020 / asti02_mb012 * temp_tc005),2));
	var temp_tc007 = Math.round(formatFloat((asti02_mb021 / asti02_mb012 * temp_tc005),2));
	var temp_tc008 = Math.round(formatFloat((asti02_mb029 / asti02_mb012 * temp_tc005),2));
	
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
