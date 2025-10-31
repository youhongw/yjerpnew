<?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'tc003' || $key == 'tc014'){
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
			<!--<div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
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
				<h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 退料單建立作業 - 新增　　　</h1>
				<div style="float:left;padding-top: 5px; ">
				<a accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('moc/moci04/'.$this->session->userdata('moci03_search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>&nbsp;&nbsp;
				</div>
				<div style="float:right;margin:6px 0px;"><a id='set_detail_view' name='set_detail_view' href="<?php echo site_url('moc/moci04/set_detail_view'); ?>" class="button" ><span>變更明細檢視設定</span></a></div>
			</div>
	
		<div class="content"> <!-- div-5 -->
			<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/moc/moci04/addsave" >	
			<div id="tab-general"> <!-- div-6 -->
				<table class="form14"  >     <!-- 頭部表格 -->
					<tr style='display:none;'><td><input name="flag" value="<?php echo $flag;?>" /></td></tr>
					<tr>
						<td class="normal14y"  width="10%"><span class="required">退料單別：</span> </td>
						<td class="normal14a"  width="22%">
							<input tabIndex="1" id="tc001" name="tc001" onKeyPress="keyFunction()"  value="<?php echo strtoupper($tc001)?> " onChange="check_tc001(this);check_title_no();" type="text" required />
							<a href="javascript:;"><img id="Showtc001disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
							<span id="tc001disp"></span>
						</td>
			
						<td class="normal14y" width="10%" >單據日期： </td>
						<td class="normal14a"  width="24%" >
							<input tabIndex="2" ondblclick="scwShow(this,event);" onchange="dateformat_ymd(this);check_title_no();" id="tc014" onKeyPress="keyFunction()"  name="tc014"  value="<?php echo $tc014; ?>"  size="12" type="text" style="background-color:#E7EFEF"  />
						</td>
			
						<td class="normal14y" width="10%" >
							<span class="required">退料單號：</span> 
						</td>
        
						<td class="normal14a"  width="24%" >
							<input tabIndex="3" id="tc002" onKeyPress="keyFunction()" name="tc002" value="<?php echo $tc002; ?>" size="20" type="text" required />
						</td>
					</tr>		
		  
					<tr>
						<td class="normal14z" >廠別代號：
						</td>
			  
						<td class="normal14" >
							<input   tabIndex="4" id="tc004" onKeyPress="keyFunction()" onchange="check_tc004(this)" name="tc004" value="<?php echo $tc004 ?>"  type="text" required />
							<a href="javascript:;"><img id="Showtc004disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
							<span id="tc004disp"></span>
						</td>
		
						<td class="normal14z""normal14z" >生產線別：</td>
						<td class="normal14a" >
							<input tabIndex="5" id="tc005" onKeyPress="keyFunction()"  name="tc005" onchange="check_tc005(this)"  value="<?php echo $tc005 ?>"  type="text" />
							<a href="javascript:;"><img id="Showtc005disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
							<span id="tc005disp"></span>
						</td>
		
						<td class="normal14z">加工廠商：</td>
						<td  class="normal14"  >
							<input tabIndex="9" id="tc006" name="tc006" value="<?php echo $tc006; ?>" size="10" onKeyPress="keyFunction()" onchange="check_tc006(this)" type="text" />
							<a href="javascript:;"><img id="Showtc006disp" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
							<span id="tc006disp"></span>
						</td>
					</tr>
			
					<tr>
						<td class="normal14z" >退料日期：</td>
						<td class="normal14"  >
							<input type="text"  ondblclick="scwShow(this,event);"  tabIndex="7" onKeyPress="keyFunction()"   name="tc003" value="<?php echo $tc003?>" style="background-color:#E7EFEF"/>
						</td>
		
						<td class="normal14z">簽核狀態：</td>
						<td  class="normal14"  >
							<select id="tc016" tabIndex="8" readonly="value" onKeyPress="keyFunction()" name="tc016"   style="background-color:#EBEBE4" >
								<option value='N'>N.不執行電子簽核</option>                                                                        
								<option value='0'>0.待處理</option>
								<option value='1'>1.簽核中</option>
								<option value='2'>2.退件</option>
								<option value='3'>3.已核准</option>	
								<option value='4'>4.取消確認中</option>	
								<option value='5'>5.作廢中</option>	
								<option value='6'>6.取消作廢中</option>				
							</select>
							<script>
								$('#tc016').val(<?php echo $tc016; ?>);
							</script>
						</td>
			  
						<td class="normal14z" >列印次數：</td>						
						<td  class="normal14"  >
							<input type="text" tabIndex="9"  readonly="value"  onKeyPress="keyFunction()" id="tc010" name="tc010" size="5"  value="<?php echo $tc010; ?>" style="background-color:#EBEBE4" />
						</td>
					</tr>
			
					<tr>
						<td class="normal14z">確認者：</td>
						<td  class="normal14"  >
							<input tabIndex="10" id="tc015" readonly="value" onKeyPress="keyFunction()"  name="tc015" value="<?php echo $tc015 ?>" size="10" type="text" style="background-color:#EBEBE4"  />
						</td>
		
						<td class="normal14z">產生依序：</td>
						<td  class="normal14"  >
							<select id="tc012" tabIndex="11" onKeyPress="keyFunction()" name="tc012" style="background-color:#EBEBE4" value="<?php echo $tc012; ?>">
								<option  value='1'>1.依製令單號</option>                                                                        
								<option  value='2'>2.依材料品號</option>			
							</select>
							<script>
								$('#tc012').val(<?php echo $tc012; ?>);
							</script>
						</td>
		 
						<td class="normal14z" >備註：</td>
						<td class="normal14a" >
							<input  tabIndex="12"  id="tc007" onKeyPress="keyFunction()"   name="tc007" value="<?php echo $tc007; ?>" type="text"     />
						</td> 
					</tr>
	   
					<tr>
						<td class="normal14z">產生分錄：</td>
						<td  class="normal14"  >
							<input tabIndex="10" id="tc011" name="tc011" value="Y" onKeyPress="keyFunction()" type="checkbox" />
						</td>
						
						<td class="normal14z" >確認碼：</td>
						<td class="normal14" >
							<select tabIndex="13" id="tc009" name="tc009" onKeyPress="keyFunction()" style="background-color:#EBEBE4">
							<option value='Y'>Y確認</option>                                                                        
							<option value='N'>N取消確認</option>
							<option value='V'>V作廢</option>
							</select>
							<span id="approved" ></span>
							<script>
								$('#tc009').val(<?php echo $tc009; ?>);
							</script>
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
								if(isset($val['style'])){
									echo "style='".$val['style']."' ";}
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
							echo "<td class='center'><img src='".base_url()."assets/image/delete2.png' title='刪除資料' onclick='del_detail(\"".$val->te001."\",\"".$val->te002."\",\"".$val->te003."\",\"".$current_product_count."\");' /></td>";
							foreach($usecol_array as $k => $v){
								if(isset($v['type'])){$type = $v['type'];}else{$type = "text";}
								
								echo "<td ";
								if(isset($v['data_class'])){echo "class='".$v['data_class']."'";}
								echo ">";
								
								if($type == "text"){
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".$val->$k."' onKeyPress='keyFunction()' ";
									if(isset($v['size'])){echo "size='".$v['size']."' ";}
									if(isset($v['onclick'])){echo "onclick=\"".$v['onclick']."\" ";}
									if(isset($v['ondblclick'])){echo "ondblclick=\"".$v['ondblclick']."\" ";}
									if(isset($v['onchange'])){echo "onchange=\"".$v['onchange']."\" ";}
									if(isset($v['style'])){echo "onchange=\"".$v['onchange']."\" ";}
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
		
			<a accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('moc/moci04/'.$this->session->userdata('moci03_search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>&nbsp;&nbsp;&nbsp;&nbsp;　　　　　　　　　　
		</div> -->
		
		</form>
		<?php if ($message!=' ') { ?>
		<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
			'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
	
		</div> <!-- div-6 -->
	</div> <!-- div-5 -->
</div> <!-- div-4 -->