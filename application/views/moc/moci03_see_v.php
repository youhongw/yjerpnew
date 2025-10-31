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
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>
  </div>

  <div id="content"> <!-- div-3 --> 
	<div class="box"> <!-- div-4 --><span>　　　　　　</span>
		<div class="heading">
		  <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 領料單建立作業 - 查看　　　</h1>
		  <div style="float:left;padding-top: 5px; ">
		  <a accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('moc/moci03/'.$this->session->userdata('moci03_search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
		  </div>
		  <div style="float:right;margin:6px 0px;"><a id='set_detail_view' name='set_detail_view' href="<?php echo site_url('moc/moci03/set_detail_view'); ?>" class="button" ><span>變更明細檢視設定</span></a></div>
		</div>
		
		<div class="content"> <!-- div-5 -->
		<form class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data" action="<?php echo base_url()?>index.php/moc/moci03/updsave" >
		<div id="tab-general"> <!-- div-6 -->
		<table class="form14" > <!-- 頭部表格 -->
			<tr style='display:none;'><td><input name="flag" value="<?php echo $flag;?>" /></td></tr>
		  <tr>
			<td class="normal14y" width="10%"><span class="required">領料單別：</span></td>
			<td class="normal14" width="40%">
				<input tabIndex="1" id="tc001" name="tc001" value="<?php echo strtoupper($tc001); ?>" size="12" onKeyPress="keyFunction()" onChange="startpurq04a33(this)" type="text" readonly="readonly" required />
				<!--<a href="javascript:;"><img id="Showtc001disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>-->
				<span id="tc001disp"><?php echo $tc001disp; ?></span>
			</td>
			<td class="normal14y" width="10%" >廠別代號：</td>
			<td class="normal14" width="40%" >
				<input tabIndex="7" id="tc004" name="tc004" value="<?php echo $tc004;?>" size="12" onfocus="" onchange="check_tc004(this)" onKeyPress="keyFunction()" type="text" />
				<!--<a href="javascript:;"><img id="Showtc004disp" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>-->
				<span id="tc004disp"><?php echo $tc004disp; ?></span>
			</td>
		  </tr>	
		  <tr>
			<td class="normal14z" ><span class="required">領料單號：</span></td>
			<td class="normal14a" >
				<input tabIndex="2" id="tc002" name="tc002" value="<?php echo $tc002;?>" size="12" onKeyPress="keyFunction()" type="text" readonly="readonly" required />
			</td>
			<td class="normal14z" >生產線別：</td>
			<td class="normal14" >
				<input tabIndex="8" id="tc005" name="tc005" value="<?php echo $tc005; ?>" size="10" onKeyPress="keyFunction()" onchange="check_tc005(this)" type="text" />
				<!--<a href="javascript:;"><img id="Showtc005disp" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>-->
				<span id="tc005disp"><?php echo $tc005disp;?></span>
			</td>
		  </tr>
		  <tr>
			<td class="normal14z" >單據日期：</td>
			<td class="normal14" >
				<input tabIndex="3" id="tc014" name="tc014" value="<?php echo $tc014; ?>" size="10" onKeyPress="keyFunction()" type="text" readonly="readonly" />
			</td> 
			<td class="normal14z" >加工廠商：</td>
			<td class="normal14" >
				<input tabIndex="9" id="tc006" name="tc006" value="<?php echo $tc006; ?>" size="10" onKeyPress="keyFunction()" onchange="check_tc006(this)" type="text" />
				<!--<a href="javascript:;"><img id="Showtc006disp" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>-->
				<span id="tc006disp"><?php echo $tc006disp;?></span>
			</td>
		  </tr>
		  <tr>
			<td class="normal14z" >領料日期：</td>
			<td class="normal14" >
				<input tabIndex="3" id="tc003" name="tc003" value="<?php echo $tc003; ?>" size="10" onKeyPress="keyFunction()" onchange="dateformat_ymd(this)" type="text" />
			</td> 
			<td class="normal14z" >單據性質：</td>
			<td class="normal14" >
				<select tabIndex="9" id="tc008" name="tc008" onKeyPress="keyFunction()">
					<option <?php if($tc008 == '54') echo 'selected="selected"';?> value='54'>54.廠內領料</option>                                                                        
					<option <?php if($tc008 == '55') echo 'selected="selected"';?> value='55'>55.託外領料</option>
					<option <?php if($tc008 == '56') echo 'selected="selected"';?> value='56'>56.廠內退料</option>
					<option <?php if($tc008 == '57') echo 'selected="selected"';?> value='57'>57.託外退料</option>
				</select>
			</td>
		  </tr>
		  <tr>
			<td class="normal14z" >備註：</td>
			<td class="normal14" >
				<input tabIndex="4" id="tc007" name="tc007" value="<?php echo $tc007; ?>" size="50" onKeyPress="keyFunction()" type="text" />
			</td>
			<td class="normal14z" >產生分錄：
				<input tabIndex="10" id="tc011" name="tc011" value="Y" onKeyPress="keyFunction()" type="checkbox" <?php if($tc011 == 'Y') echo 'checked';?> />
			</td>
			<td class="normal14z" >庫存不足照領：
				<input tabIndex="11" id="tc013" name="tc013" value="Y" onKeyPress="keyFunction()" type="checkbox" <?php if($tc013 == 'Y') echo 'checked';?> />
			</td>
		  </tr>
		  <tr>
			<td class="normal14a" ></td>
			<td class="normal14" ></td> 
			<td class="normal14z" >產生依序：</td>
			<td class="normal14" >
				<select tabIndex="12" id="tc012" name="tc012" onKeyPress="keyFunction()">
					<option <?php if($tc012 == '1') echo 'selected="selected"';?> value='1'>1:依製令單號</option>                                                                        
					<option <?php if($tc012 == '2') echo 'selected="selected"';?> value='2'>2:依材料品號</option>
				</select>
			</td>
		  </tr>
		  <tr>
			<td class="normal14z" >確認者：</td>
			<td class="normal14a" >
				<input tabIndex="6" id="tc015" name="tc015" value="<?php echo $tc015;?>" size="10" onKeyPress="keyFunction()" type="text" readonly="readonly" />
			</td>
			<td class="normal14z" >確認碼：</td>
			<td class="normal14" >
				<select tabIndex="13" id="tc009" name="tc009" onKeyPress="keyFunction()">
					<option <?php if($tc009 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
					<option <?php if($tc009 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
					<option <?php if($tc009 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
				</select><span id="approved" ></span>
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
				echo "<tbody id='product_row_".$current_product_count."' class='product_row' >";
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
						if(isset($v['style'])){echo "style='".$v['style']."' ";}
						if(isset($v['readonly'])){echo "readonly='".$v['readonly']."' ";}
						if(isset($v['disable'])){echo "disable='".$v['disable']."' ";}
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
					echo "</td>";
				}
				
				
				
				
				echo "</tr>";
				echo "</tbody>";
			}?>
			   <tfoot>
				<tr>
				 <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="" /></td>
				 <td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
				</tr>
				  
				</tfoot>
			  </table>
			</div>
		</div>
		</div> <!-- div-8 -->
		
			<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
		<!--<div class="buttons">
		
			<a accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('moc/moci03/'.$this->session->userdata('moci03_search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>　　　　　　　　　　
		</div> -->
		
		</form>
		<?php if ($message!=' ') { ?>
		<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
			'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
		</div> <!-- div-6 -->
	</div> <!-- div-5 -->
</div> <!-- div-4 -->
<?php //include_once("./application/views/fun/moci03_funjsupd_v.php"); ?>