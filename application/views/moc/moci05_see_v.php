<?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'tf003' || $key == 'tf012'){
		$$key = stringtodate("Y/m/d",$val);
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
<script>
$(document).ready(function(){
	$('input').attr('disabled', 'disabled');
	$('select').attr('disabled', 'disabled');
});
</script>
<div id="container"> <!-- div-1 -->
	<div id="header"> <!-- div-2 -->
		<div class="div1">
		<!--	<div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
				<div class="div3">
				<img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
				<img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
				<img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
				</div>
		</div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
	</div>
  
	<div id="content"> <!-- div-3 --> 
		<div class="box"> <!-- div-4 --><span>　　　　　　</span>
			<div class="heading">
				<h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 生產入庫單建立作業 - 新增　　　</h1>
				<div style="float:left;padding-top: 5px; ">
				<a accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('moc/moci05/'.$this->session->userdata('moci03_search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>&nbsp;&nbsp;
				</div>
				<div style="float:right;margin:6px 0px;"><a id='set_detail_view' name='set_detail_view' href="<?php echo site_url('moc/moci05/set_detail_view'); ?>" class="button" ><span>變更明細檢視設定</span></a></div>
			</div>
	
		<div class="content"> <!-- div-5 -->
			<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/moc/moci05/addsave" >	
			<div id="tab-general"> <!-- div-6 -->
				<table class="form14"  >     <!-- 頭部表格 -->
					<tr style='display:none;'><td><input name="flag" value="<?php echo $flag;?>" /></td></tr>
					<tr>
						<td class="normal14y"  width="10%"><span class="required">入庫單別：</span> </td>
						<td class="normal14a"  width="22%">
							<input tabIndex="1" id="puri04" name="puri04" onKeyPress="keyFunction()"  value="<?php echo strtoupper($tf001);?>" onChange="check_puri04(this);check_title_no();" type="text" required />
							<a href="javascript:;"><img id="Showpuri04disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
							<span id="puri04disp"><?php echo $tf001disp; ?></span>
						</td>
			
						<td class="normal14y" width="10%" >單據日期： </td>
						<td class="normal14a"  width="24%" >
							<input tabIndex="2" ondblclick="scwShow(this,event);" onchange="dateformat_ymd(this);check_title_no();" id="Ddate" onKeyPress="keyFunction()"  name="Ddate"  value="<?php echo $tf012; ?>"  size="12" type="text" style="background-color:#E7EFEF"  />
						</td>
			
						<td class="normal14y" width="10%" >入庫單號：</td>
						        
						<td class="normal14a"  width="24%" >
							<input tabIndex="3" id="tf002" onKeyPress="keyFunction()" name="tf002" value="<?php echo $tf002; ?>?" size="20" type="text" required />
						</td>
					</tr>		
		  
					<tr>
						<td class="normal14z" >
							廠別代號：
						</td>
			  
						<td class="normal14" >
							<input   tabIndex="4" id="cmsi02" onKeyPress="keyFunction()" onchange="check_cmsi02(this)" name="cmsi02" value="<?php echo $tf004; ?>"  type="text" required />
							<a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
							<span id="cmsi02disp"><?php echo $tf004disp; ?></span>
						</td>
		
						<td class="normal14z" >生產線別：</td>
						<td class="normal14a" >
							<input tabIndex="5" id="cmsi04" onKeyPress="keyFunction()"  name="cmsi04" onchange="check_cmsi04(this)"  value="<?php echo $tf011; ?>"  type="text" />
							<a href="javascript:;"><img id="Showcmsi04disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
							<span id="cmsi04disp"><?php echo $tf011disp; ?></span>
						</td>
		
						<td class="normal14z">簽核狀態：</td>
						<td  class="normal14"  >
							<select id="tf014" tabIndex="8" readonly="value" onKeyPress="keyFunction()" name="tf014"   style="background-color:#EBEBE4" >
								<option value='N'>N.不執行電子簽核</option>                                                                        
								<option value='0'>0.待處理</option>
								<option value='1'>1.簽核中</option>
								<option value='2'>2.退件</option>
								<option value='3'>3.已核准</option>	
								<option value='4'>4.取消確認中</option>	
								<option value='5'>5.作廢中</option>	
								<option value='6'>6.取消作廢中</option>				
							</select>
						</td>
					</tr>
			
					<tr>
						<td class="normal14z" >入庫日期：</td>
						<td class="normal14"  >
							<input type="text" tabIndex="7" onKeyPress="keyFunction()"   name="tf003" value="<?php echo $tf003;?>" style="background-color:#E7EFEF" readonly="readonly"/>
						</td>
		
						
			  
						<td class="normal14z" >列印次數：</td>						
						<td  class="normal14"  >
							<input type="text" tabIndex="9"  readonly="value"  onKeyPress="keyFunction()" id="tf008" name="tf008" size="5"  value="<?php echo $tf008; ?>" style="background-color:#EBEBE4" />
						</td>
						
						<td class="normal14z" >備註：</td>
						<td class="normal14a" >
							<input  tabIndex="12"  id="tf005" onKeyPress="keyFunction()"   name="tf005" value="<?php echo $tf005;?>" type="text"     />
						</td> 
					</tr>
			
					<tr>
						<td class="normal14z">確認者：</td>
						<td  class="normal14"  >
							<input tabIndex="10" id="tf013" readonly="value" onKeyPress="keyFunction()"  name="tf013" value="<?php echo $tf013; ?>" size="10" type="text" style="background-color:#EBEBE4"  />
						</td>
		
						<td class="normal14z" >確認碼：</td>
						<td class="normal14" >
							<select tabIndex="13" id="tf006" name="tf006" onKeyPress="keyFunction()">
							<option value='Y'>Y確認</option>                                                                        
							<option value='N'>N取消確認</option>
							<option value='V'>V作廢</option>
							</select>
							<span id="approved" ></span>
						</td>
		 
						
					</tr>
	   
					<tr>
						<td class="normal14z">產生分錄：</td>
						<td  class="normal14"  >
							<input tabIndex="10" id="tf010" name="tf010" value="Y" onKeyPress="keyFunction()" type="checkbox" />
						</td>
						
						<td class="normal14z">自動扣料：</td>
						<td  class="normal14"  >
							<input tabIndex="10" id="tf009" name="tf009" value="Y" onKeyPress="keyFunction()" type="checkbox" />
						</td>
						
					</tr>
				</table>
		

				<div style="width:100%; overflow-x: auto;  ">
					<table style="width:100%;" id="order_product" class="list1">
						<thead>
						<tr>
							<td width="3%"></td>
								<?php foreach($usecol_array as $key => $val){
									echo "<td ";
								if(isset($val['width'])){
									echo "width='".$val['width']."' ";}
								if(isset($val['title_class'])){
									echo "class='".$val['title_class']."' ";}
								//if(isset($val['style'])){
									//echo "style='".$val['style']."' ";}
									echo " >";
									echo $val['name'];
									echo "</td>";
								}?>
						</tr>
						</thead>
						
						<?php $current_product_count = 0;//依照資料庫紀錄的明細先列一遍 ?>
						<?php foreach($body_data as $key => $val){
							$current_product_count++;
							echo "<tbody id='product_row_".$current_product_count."' class='product_row'>";
							echo "<tr>";
							echo "<td class='center'><img src='".base_url()."assets/image/delete2.png' title='刪除資料' onclick='del_detail(\"".$val->tg001."\",\"".$val->tg002."\",\"".$val->tg003."\",\"".$current_product_count."\");' /></td>";
							foreach($usecol_array as $k => $v){
								if($k=="tg018" || $k=="tg019"){
									$s = substr($val->$k,0,4)."/".substr($val->$k,4,2)."/".substr($val->$k,6,2);
								}else{
									$s = $val->$k;
								}
								if(isset($v['type'])){$type = $v['type'];}else{$type = "text";}
								
								echo "<td ";
								if(isset($v['data_class'])){echo "class='".$v['data_class']."'";}
								echo ">";
								
								if($type == "text"){
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".$s."' onKeyPress='keyFunction()' ";
									if(isset($v['size'])){echo "size='".$v['size']."' ";}
									if(isset($v['onclick'])){echo "onclick=\"".$v['onclick']."\" ";}
									if(isset($v['ondblclick'])){echo "ondblclick=\"".$v['ondblclick']."\" ";}
									if(isset($v['onchange'])){echo "onchange=\"".$v['onchange']."\" ";}
									if(isset($v['style'])){echo "style=\"".$v['style']."\" ";}
									if(isset($v['readonly'])){echo "readonly='".$v['readonly']."' ";}
									if(isset($v['disable'])){echo "disable='".$v['disable']."' ";}
									echo "/>";
								}
								
								if($type == "select" && isset($v['option'])){
									echo "<select id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_'>";
									if(isset($v['size'])){echo "size='".$v['size']."' ";}
									if(isset($v['onclick'])){echo "onclick=\"".$v['onclick']."\" ";}
									if(isset($v['ondbclick'])){echo "ondbclick=\"".$v['ondbclick']."\" ";}
									if(isset($v['onchange'])){echo "onchange=\"".$v['onchange']."\" ";}
									if(isset($v['style'])){echo "style='".$v['style']."' ";}
									if(isset($v['readonly'])){echo "readonly='".$v['readonly']."' ";}
									if(isset($v['disable'])){echo "disable='".$v['disable']." '";}
									echo " >";
									foreach($v['option'] as $op_k => $op_v){
										echo "<option ";
										if($val->$k == $op_k){echo "selected='selected' ";}
										echo "value='".$op_k."'>";
										echo $op_k.".".$op_v;
										echo "</option>";
									}
									echo "</select>";
								}
								echo "</td>";
							}
							
							echo "</tr>";
							echo "</tbody>";
						} ?>
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
		<!--<div class="buttons">
			<a accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('moc/moci05/'.$this->session->userdata('moci03_search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>&nbsp;&nbsp;　　　　　　　　　　
		
		</div> -->
		
		</form>
		<?php if ($message!=' ') { ?>
		<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
			'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
	
		</div> <!-- div-6 -->
	</div> <!-- div-5 -->
</div> <!-- div-4 -->