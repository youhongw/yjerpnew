 <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下模組***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'tc003' || $key == 'tc039'){
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
  //預設稅率,廠別
  $stax_rate = $this->session->userdata('sysma004');
  $sysma200 = $this->session->userdata('sysma200');
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 使用者權限模組建立作業 - 修改</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/adm/admi06/updsave" method="post" enctype="multipart/form-data" >
	<div id="tab-general"> <!-- div-6 -->
	
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a" width="12%"><span class="required">使用者代號：</span> </td>
        <td class="normal14a"  width="38%"><input tabIndex="1" id="admi10"    onKeyPress="keyFunction()" name="admi10" onfocus="" onchange="check_admi10(this);"  value="<?php echo $mg001; ?>" size="12" type="text" required style="background-color:#F0F0F0" readonly="readonly"/>
		<a href="javascript:;"><img id="Showadmi10disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		<span id="admi10disp"> <?php echo $mg001disp; ?> </span></td>
		  
		<td class="normal14a" width="11%">模組管制(Y/N)：</td>
        <td class="normal14a" width="39%"><input type="text" tabIndex="2" id="mg005" onKeyPress="keyFunction()" name="mg005" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase()"  value="<?php echo  strtoupper($mg005); ?>"   /></td>
	  </tr>
	  
	  <tr>
		<td class="normal14">執行權限(Y/N)：</td>
        <td class="normal14"><input type="text" tabIndex="3" id="mg004" onKeyPress="keyFunction()" name="mg004" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase()"  value="<?php echo  strtoupper($mg004); ?>"   /></td>
		
		<td class="normal14" >頁次權限(0/1/2)：</td>
		<td class="normal14">
		   <input type="text" tabIndex="4" id="mg003" onKeyPress="keyFunction()" name="mg003" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase()"  value="<?php echo  strtoupper($mg003); ?>"   /><span>(0可見可改,1可見不可改,2不可見)</span>
		</td>
	  </tr>
	</table>
	
	<table class="form14"  >
		<tr>
			<td  class="normal14a" width="6%">管理維護系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_adm' name='import_adm' href="javascript:import_adm()" class="button" ><span>匯入管理維護系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">基本模組管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_cms' name='import_cms' href="javascript:import_cms()" class="button" ><span>匯入基本模組系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">庫存管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_inv' name='import_inv' href="javascript:import_inv()" class="button" ><span>匯入庫存系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">產品結構管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_bom' name='import_bom' href="javascript:import_bom()" class="button" ><span>匯入產品結構系統</span></a>
			</td>
		</tr>

		<tr>
			<td  class="normal14a" width="6%">訂單管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_cop' name='import_cop' href="javascript:import_cop()" class="button" ><span>匯入訂單系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">出口作業管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_eps' name='import_eps' href="javascript:import_eps()" class="button" ><span>匯入出口作業系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">銷售分析管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_sas' name='import_sas' href="javascript:import_sas()" class="button" ><span>匯入銷售分析系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">採購管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_pur' name='import_pur' href="javascript:import_pur()" class="button" ><span>匯入採購系統</span></a>
			</td>
		</tr>
		
		<tr>
			<td  class="normal14a" width="6%">進口作業管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_ips' name='import_ips' href="javascript:import_ips()" class="button" ><span>匯入進口作業系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">製令/託外管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_moc' name='import_moc' href="javascript:import_moc()" class="button" ><span>匯入製令/託外系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">製程管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_sfc' name='import_sfc' href="javascript:import_sfc()" class="button" ><span>匯入製程系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">人事薪資管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_pal' name='import_pal' href="javascript:import_pal()" class="button" ><span>匯入人事薪資系統</span></a>
			</td>
		</tr>
		
		<tr>
			<td  class="normal14a" width="6%">刷卡管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_ams' name='import_ams' href="javascript:import_ams()" class="button" ><span>匯入刷卡系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">應收管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_acr' name='import_acr' href="javascript:import_acr()" class="button" ><span>匯入應收系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">應付管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_acp' name='import_acp' href="javascript:import_acp()" class="button" ><span>匯入應付系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">票據資金管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_not' name='import_not' href="javascript:import_not()" class="button" ><span>匯入票據資金系統</span></a>
			</td>
		</tr>
		
		<tr>
			<td  class="normal14a" width="6%">會計總帳管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_act' name='import_act' href="javascript:import_act()" class="button" ><span>匯入會計總帳系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">自動分錄系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_ajs' name='import_ajs' href="javascript:import_ajs()" class="button" ><span>匯入自動分錄系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">批次需求計劃系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_lrp' name='import_lrp' href="javascript:import_lrp()" class="button" ><span>匯入批次需求計劃系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">主生產排程系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_mps' name='import_mps' href="javascript:import_mps()" class="button" ><span>匯入主生產排程系統</span></a>
			</td>
		</tr>
		
		<tr>
			<td  class="normal14a" width="6%">物料需求計劃系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_mrp' name='import_mrp' href="javascript:import_mrp()" class="button" ><span>匯入物料需求計劃系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">成本計算管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_cst' name='import_cst' href="javascript:import_cst()" class="button" ><span>匯入成本計算系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">固定資產管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_ast' name='import_ast' href="javascript:import_ast()" class="button" ><span>匯入固定資產系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">營業稅申報系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_tax' name='import_tax' href="javascript:import_tax()" class="button" ><span>匯入營業稅申報系統</span></a>
			</td>
		</tr>
		
		<tr>
			<td  class="normal14a" width="6%">品質管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_qms' name='import_qms' href="javascript:import_qms()" class="button" ><span>匯入品質管理系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">專櫃管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_wsc' name='import_wsc' href="javascript:import_wsc()" class="button" ><span>匯入專櫃系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">保稅管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_bcs' name='import_bcs' href="javascript:import_bcs()" class="button" ><span>匯入保稅系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">維修服務系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_rma' name='import_rma' href="javascript:import_rma()" class="button" ><span>匯入維修服務系統</span></a>
			</td>
		</tr>
		
		<tr>
			<td  class="normal14a" width="6%">B2B轉鑰系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_ect' name='import_ect' href="javascript:import_ect()" class="button" ><span>匯入B2B轉鑰系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">金流整合管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_ifb' name='import_ifb' href="javascript:import_ifb()" class="button" ><span>匯入金流整合系統</span></a>
			</td>
			
			<td  class="normal14a" width="6%">交易市集管理系統</td>
			<td  class="normal14a" valign="top" width="19%">
				<a accesskey="" onKeyPress="keyFunction()" id='import_ifg' name='import_ifg' href="javascript:import_ifg()" class="button" ><span>匯入交易市集系統</span></a>
			</td>
			
			<td></td>
		</tr>
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
					
					if(isset($val['box_id'])){
						echo "<input type='checkbox' id=".$val['box_id']." name=".$val['box_id']." onclick=".$val['onclick']." checked>";
					}
					echo "</td>";
				}?>
            </tr>
        </thead>
        <!--  依照模組庫紀錄的明細先列一遍 原0會由1加  -->
            <?php $current_product_count = 0; ?>
			<?php foreach($body_data as $key => $val){
				$current_product_count++;
				echo "<tbody id='product_row_".$current_product_count."' class='product_row' >";
				echo "<tr>";
				echo "<td class='center'><img src='".base_url()."assets/image/delete2.png' title='刪除模組' onclick='del_detail(\"".$mg001."\",\"".$val->admi02."\",\"".$current_product_count."\");'/></td>";
				foreach($usecol_array as $k => $v){
					if(isset($v['type'])){$type = $v['type'];}else{$type = "text";}
					
					echo "<td nowrap='value'";  //1060728  加nowrap 圖示在同一行
					if(isset($v['data_class'])){echo "class='".$v['data_class']."'";}
					if(isset($v['align'])){echo "align='".$v['align']."'";}
					echo ">";
					
					if($type == "text"){
						echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".$val->$k."' onKeyPress='keyFunction()' ";
						if(isset($v['size'])){echo "size='".$v['size']."' ";}
						if(isset($v['id'])){echo "id='".$v['id']."' ";}
						if(isset($v['class'])){echo "class='".$v['class']."' ";}
						if(isset($v['onclick'])){echo "onclick=\"".$v['onclick']."\" ";}
						if(isset($v['ondblclick'])){echo "ondblclick=\"".$v['ondblclick']."\" ";}
						if(isset($v['onchange'])){echo "onchange=\"".$v['onchange']."\" ";}
						if(isset($v['style'])){echo "style='".$v['style']."' ";}
						if(isset($v['readonly'])){echo "readonly='".$v['readonly']."' ";}
						if(isset($v['align'])){echo "align='".$v['align']."' ";}
						if(isset($v['disabled'])){echo "disabled='".$v['disabled']."' ";}
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
						if(isset($v['disabled'])){echo "disabled='".$v['disabled']."' ";}
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
					
					$string_mg006 = $val->mg006;
					
					$array_mg006 = preg_split('//', $string_mg006, -1, PREG_SPLIT_NO_EMPTY);
					
					//$abc = $v['number'];
					
					
					if($type == "checkbox"){
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='Y' onKeyPress='keyFunction() '";
									
									if(($array_mg006[$v['number']] == "Y")){
										echo "checked";
									}else{
										echo "check";
									}
										
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
             <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
            </tr>
			  
            </tfoot>
          </table>
        </div>
	 </div>

	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('adm/admi06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
	  ?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('adm/admi06/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
	  <?php } ?>
	  <?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
	  ?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('adm/admi06/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
	  <?php } ?>	
	  </div> 
	  </div> <!-- div-加 -->
    </form>  <!-- end 表單 -->
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,欄位淡黃色按2下開視窗查詢,圖示1客戶商品計價查詢,Alt+y跳到明細模組, Alt+w新增一筆明細. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

 
    </div> <!-- div-3 --> 
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
<form action="<?php echo base_url()?>index.php/adm/admi06/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
		
<?php  include_once("./application/views/funnew/admi02_funmjs_v.php"); ?> <!-- 程式代號 -->


<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/admi06_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 

<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#admi03').focus();
	}); 	   
	
	function set_catcomplete2(){
		
	}
	
	function set_catcomplete3(){
		
	}
</script> 	    

<script>
function import_adm(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_adm"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(check_repeat);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_cms(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_cms"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_inv(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_inv"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_bom(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_bom"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_cop(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_cop"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_eps(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_eps"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_sas(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_sas"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_pur(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_pur"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_ips(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_ips"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_moc(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_moc"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_sfc(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_sfc"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_pal(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_pal"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_ams(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_ams"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_acr(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_acr"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_acp(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_acp"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_not(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_not"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_act(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_act"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_ajs(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_ajs"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_lrp(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_lrp"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_mps(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_mps"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_mrp(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_mrp"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_cst(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_cst"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_ast(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_ast"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_tax(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_tax"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_qms(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_qms"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_wsc(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_wsc"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_bcs(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_bcs"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_rma(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_rma"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_ect(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_ect"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_ifb(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_ifb"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function import_ifg(){
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/adm/admi02/import_ifg"
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無模組可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					var check_repeat = check_addsystem_repeat(val['mb001']);
					console.log(val);
					if(check_repeat != "repeat"){
						addItem();
						$('#order_product\\['+current_count+'\\]\\[admi02\\]').val(val['mb001']);
						$('#order_product\\['+current_count+'\\]\\[admi02_mb002\\]').val(val['mb002']);
					}
				}
				
			}
		}
		
	});
}

function check_check_all_admi06_temp1(){
   if($("#chkbx_temp1").prop("checked")) {
     $(".order_product_admi06_temp1").each(function() {
         $(this).prop("checked", true);
     });
   } else {
     $(".order_product_admi06_temp1").each(function() {
         $(this).prop("checked", false);
     });
   }	
}

function check_check_all_admi06_temp2(){
   if($("#chkbx_temp2").prop("checked")) {
     $(".order_product_admi06_temp2").each(function() {
         $(this).prop("checked", true);
     });
   } else {
     $(".order_product_admi06_temp2").each(function() {
         $(this).prop("checked", false);
     });
   }	
}

function check_check_all_admi06_temp3(){
   if($("#chkbx_temp3").prop("checked")) {
     $(".order_product_admi06_temp3").each(function() {
         $(this).prop("checked", true);
     });
   } else {
     $(".order_product_admi06_temp3").each(function() {
         $(this).prop("checked", false);
     });
   }	
}

function check_check_all_admi06_temp4(){
   if($("#chkbx_temp4").prop("checked")) {
     $(".order_product_admi06_temp4").each(function() {
         $(this).prop("checked", true);
     });
   } else {
     $(".order_product_admi06_temp4").each(function() {
         $(this).prop("checked", false);
     });
   }	
}

function check_check_all_admi06_temp5(){
   if($("#chkbx_temp5").prop("checked")) {
     $(".order_product_admi06_temp5").each(function() {
         $(this).prop("checked", true);
     });
   } else {
     $(".order_product_admi06_temp5").each(function() {
         $(this).prop("checked", false);
     });
   }	
}

function check_check_all_admi06_temp6(){
   if($("#chkbx_temp6").prop("checked")) {
     $(".order_product_admi06_temp6").each(function() {
         $(this).prop("checked", true);
     });
   } else {
     $(".order_product_admi06_temp6").each(function() {
         $(this).prop("checked", false);
     });
   }	
}

function check_check_all_admi06_temp7(){
   if($("#chkbx_temp7").prop("checked")) {
     $(".order_product_admi06_temp7").each(function() {
         $(this).prop("checked", true);
     });
   } else {
     $(".order_product_admi06_temp7").each(function() {
         $(this).prop("checked", false);
     });
   }	
}

function check_check_all_admi06_temp8(){
   if($("#chkbx_temp8").prop("checked")) {
     $(".order_product_admi06_temp8").each(function() {
         $(this).prop("checked", true);
     });
   } else {
     $(".order_product_admi06_temp8").each(function() {
         $(this).prop("checked", false);
     });
   }	
}

function check_check_all_admi06_temp9(){
   if($("#chkbx_temp9").prop("checked")) {
     $(".order_product_admi06_temp9").each(function() {
         $(this).prop("checked", true);
     });
   } else {
     $(".order_product_admi06_temp9").each(function() {
         $(this).prop("checked", false);
     });
   }	
}

function check_check_all_admi06_temp10(){
   if($("#chkbx_temp10").prop("checked")) {
     $(".order_product_admi06_temp10").each(function() {
         $(this).prop("checked", true);
     });
   } else {
     $(".order_product_admi06_temp10").each(function() {
         $(this).prop("checked", false);
     });
   }	
}

function check_check_all_admi06_temp11(){
   if($("#chkbx_temp11").prop("checked")) {
     $(".order_product_admi06_temp11").each(function() {
         $(this).prop("checked", true);
     });
   } else {
     $(".order_product_admi06_temp11").each(function() {
         $(this).prop("checked", false);
     });
   }	
}

function check_check_all_admi06_temp12(){
   if($("#chkbx_temp12").prop("checked")) {
     $(".order_product_admi06_temp12").each(function() {
         $(this).prop("checked", true);
     });
   } else {
     $(".order_product_admi06_temp12").each(function() {
         $(this).prop("checked", false);
     });
   }	
}

function check_check_all_admi06_temp13(){
   if($("#chkbx_temp13").prop("checked")) {
     $(".order_product_admi06_temp13").each(function() {
         $(this).prop("checked", true);
     });
   } else {
     $(".order_product_admi06_temp13").each(function() {
         $(this).prop("checked", false);
     });
   }	
}
</script>