 <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'tc003' || $key == 'tc027'){
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 資產出售建立作業 - 查看</h1>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ast/asti09/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="tab-general"> <!-- div-6 -->
      
	<table class="form14"  >     <!-- 頭部表格 -->
	   <?php
			$exchange_tc021 = '';
	   ?>
	   
	   <tr>
	    <td class="normal14" width="8%" ><span class="required">單別：</span></td>
        <td  class="normal14" width="25%" ><input tabIndex="1" id="asti03_asti09" onKeyPress="keyFunction()" onfocus="check_title_no();"  onchange="check_asti03_asti09(this);check_title_no();" name="asti03_asti09" value="<?php echo $tc001; ?>" size="12" type="text" required readonly="value" style="background-color:#F0F0F0"/>
		<a href="javascript:;"><img id="Showasti03_asti09disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
        <span id="asti03_asti09disp"> <?php   echo $tc001disp; ?> </span></td>
		  
		  
	    <td class="normal14a" width="10%" ><span class="required">客戶代號：<span></td>  
        <td  class="normal14" width="23%" ><input tabIndex="1" id="copi01" onKeyPress="keyFunction()" onfocus=""  onchange="check_copi01(this);" name="copi01" value="<?php echo $tc017; ?>" size="12" type="text" required readonly="value" style="background-color:#F0F0F0"/>
		<a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
	    
		<td class="normal14a" width="8%">結帳單別：</td>
        <td class="normal14a"  width="26%" ><input tabIndex="2" id="tc011" onKeyPress="keyFunction()"  onchange="" name="tc011" value="<?php echo $tc011; ?>" size="12" type="text" readonly="value" style="background-color:#F0F0F0"/></td>
	  
	  </tr>
	  
	  <tr>	    
		<td class="normal14"><span class="required">單號：</span></td>
        <td class="normal14a"><input tabIndex="3" id="tc002" onKeyPress="keyFunction()" readonly="value" name="tc002" onfocus="check_title_no();" value="<?php echo $tc002; ?>" size="12" type="text" required readonly="value" style="background-color:#F0F0F0"/></td>
	    
		<td class="normal14a">客戶簡稱：</td>
        <td class="normal14a"><input tabIndex="2" id="copi01disp" onKeyPress="keyFunction()"  onchange="" name="copi01disp"  value="<?php echo $tc017disp; ?>"  size="12" type="text" readonly="value" style="background-color:#F0F0F0"/></td>
		
	     <td class="normal14">結帳單號：</td>
        <td class="normal14"><input tabIndex="2" id="tc012" onKeyPress="keyFunction()"  onchange="" name="tc012" value="<?php echo $tc012; ?>" size="12" type="text" readonly="value" style="background-color:#F0F0F0"/></td>
	 
	  </tr>
	  
	  <tr>
	    <td class="normal14">單據日期：</td>
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tc027" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="tc027"  value="<?php echo $tc027; ?>"  size="12" type="text" readonly="value" style="background-color:#F0F0F0"  /></td>
        
		<td class="normal14"><span class="required">幣別：</span></td>
        <td class="normal14" ><input tabIndex="11" id="cmsi06" onKeyPress="keyFunction()" name="cmsi06" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $tc019; ?>"  type="text"   size="12" required readonly="value" style="background-color:#F0F0F0"/>
		<a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
        <span id="cmsi06disp"> <?php    echo $tc019disp; ?> </span></td>
        
		<td class="normal14">傳票單別：</td>
        <td class="normal14"><input tabIndex="2" id="tc023" onKeyPress="keyFunction()"  onchange="" name="tc023" value="<?php echo $tc024; ?>" size="12" type="text" readonly="value" style="background-color:#F0F0F0"/></td>
	 
	  </tr>
	  
	  <tr>
	    <td class="normal14"><span class="required">資產編號：</span></td>
        <td  class="normal14"  ><input tabIndex="1" id="asti02" onKeyPress="keyFunction()"  onchange="check_asti02(this);" name="asti02" value="<?php echo $tc004; ?>" size="12" type="text" required readonly="value" style="background-color:#F0F0F0"/>
		<a href="javascript:;"><img id="Showasti02disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
        
		<td class="normal14">匯率：</td>
        <td class="normal14"  ><input type="text" id="exchange_rate" name="exchange_rate" tabIndex="12" onKeyPress="keyFunction()" name="tc020" value="<?php echo $tc020; ?>"  size="12" readonly="value" style="background-color:#F0F0F0"/></td>
        
			<td class="normal14">傳票單號：</td>
        <td class="normal14"><input tabIndex="2" id="tc024" onKeyPress="keyFunction()"  onchange="" name="tc024" value="<?php echo $tc024; ?>" size="12" type="text" readonly="value" style="background-color:#F0F0F0"/></td>
	
	  </tr>
	  
	  <tr>
	    <td class="normal14">資產名稱：</td>
        <td  class="normal14"><input type="text" tabIndex="8" onKeyPress="keyFunction()" id="asti02disp" name="asti02disp"  value="<?php echo $tc004disp; ?>" size="12" readonly="value" style="background-color:#F0F0F0"/></td>
        
		<td class="normal14">原幣出售金額：</td>
        <td class="normal14a"><input tabIndex="2" id="tc021" onKeyPress="keyFunction()"  onchange="change_asti09_tc021();" name="tc021" value="<?php echo $tc021; ?>" size="12" type="text" readonly="value" style="background-color:#F0F0F0"/></td>
        
		<td class="normal14">列印次數：</td>
        <td class="normal14a"><input tabIndex="2" id="tc016" onKeyPress="keyFunction()"  onchange="" name="tc016" value="<?php echo $tc016; ?>" size="12" type="text" readonly="value" style="background-color:#F0F0F0"/></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14">資產規格：</td>
        <td  class="normal14"><input type="text" tabIndex="8" onKeyPress="keyFunction()" id="asti02disp2" name="asti02disp2"  value="<?php echo $tc004disp2; ?>" size="12" readonly="value" style="background-color:#F0F0F0"/></td>
        
		<td class="normal14">本幣出售金額：</td>
        <td class="normal14a"><input tabIndex="2" id="exchange_tc021" onKeyPress="keyFunction()"  onchange="" name="exchange_tc021" value="<?php echo $tc021; ?>" size="12" type="text" readonly="value" style="background-color:#F0F0F0"/></td>
        
		<td class="normal14">異動日期：</td>
        <td class="normal14a"><input tabIndex="2"  ondblclick="scwShow(this,event);" id="tc003" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tc003"  value="<?php echo $tc003; ?>"  size="12" type="text" style="background-color:#F0F0F0" readonly="value" /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14">數量：</td>
        <td class="normal14a"><input tabIndex="2" id="tc005" onKeyPress="keyFunction()" onblur="change_asti09_tc005();" name="tc005"  value="<?php echo $tc005; ?>" size="12" type="text" readonly="value" style="background-color:#F0F0F0"/></td>
        
		<td class="normal14">單位：</td>
        <td  class="normal14"><input type="text" tabIndex="8" onKeyPress="keyFunction()" id="asti02disp3" name="asti02disp3"  value="<?php echo $tc004disp3; ?>" size="12" readonly="value" style="background-color:#F0F0F0"/></td>
        
		<td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="8" readonly="value"  onKeyPress="keyFunction()" id="tc028" name="tc028"  value="<?php echo $tc028; ?>" style="background-color:#F0F0F0" size="12"/></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14">取得成本：</td>
        <td class="normal14a"><input tabIndex="2" id="tc006" onKeyPress="keyFunction()"  onchange="" name="tc006" value="<?php echo $tc006; ?>" size="12" type="text" readonly="value" style="background-color:#F0F0F0"/></td>
        
		<td class="normal14">累積折舊：</td>
        <td class="normal14a"><input tabIndex="2" id="tc008" onKeyPress="keyFunction()"  onchange="" name="tc008" value="<?php echo $tc008; ?>" size="12" type="text" readonly="value" style="background-color:#F0F0F0"/></td>
        
		<td class="normal14">處分損益：</td>
        <td class="normal14a"><input tabIndex="2" id="tc022" onKeyPress="keyFunction()"  onchange="" name="tc022" value="<?php echo $tc022; ?>" size="12" type="text" readonly="value" style="background-color:#F0F0F0"/></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14">改良成本：</td>
        <td class="normal14a"><input tabIndex="2" id="tc007" onKeyPress="keyFunction()"  onchange="" name="tc007" value="<?php echo $tc007; ?>" size="12" type="text" readonly="value" style="background-color:#F0F0F0"/></td>
        
		<td class="normal14">增減預留殘值：</td>
        <td class="normal14a"><input tabIndex="2" id="tc010" onKeyPress="keyFunction()"  onchange="" name="tc010" value="<?php echo $tc010; ?>" size="12" type="text" readonly="value" style="background-color:#F0F0F0"/></td>
        
		<td class="normal14">備註：</td>
        <td class="normal14a"><input tabIndex="2" id="tc013" onKeyPress="keyFunction()"  onchange="" name="tc013" value="<?php echo $tc013; ?>" size="24" type="text" readonly="value" style="background-color:#F0F0F0" /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14">自動銷帳：</td>
        <td class="normal14"><input type="hidden" name="tc025" value="N" />
		<input tabIndex="28" id="tc025" onKeyPress="keyFunction()" name="tc025" <?php if($tc025 == 'Y' ) echo 'checked'; ?>  <?php if($tc025 !== 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  disabled="disabled" style="background-color:#F0F0F0"/></td>		
        
		<td class="normal14">產生分錄：</td>
        <td class="normal14"><input type="hidden" name="tc031" value="N" />
		<input tabIndex="28" id="tc031" onKeyPress="keyFunction()" name="tc031" <?php if($tc031 == 'Y' ) echo 'checked'; ?>  <?php if($tc025 !== 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  disabled="disabled" style="background-color:#F0F0F0"/></td>		
        
		<td class="normal14">簽核狀態：</td>
        <td class="normal14"><select id="tc032" tabIndex="21" readonly="value" onKeyPress="keyFunction()" name="tc032"   style="background-color:#F0F0F0" disabled="disabled" >
            <option <?php if($tc032 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tc032 == '0') echo 'selected="selected"';?> value='0'>0.待處理</option>
            <option <?php if($tc032 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tc032 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tc032 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tc032 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tc032 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tc032 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>	
	  </tr>
	  
	  <input type="text" style="display:none" value="0" id="asti02temp12" />
	  <input type="text" style="display:none" value="0" id="asti02temp20" />
	  <input type="text" style="display:none" value="0" id="asti02temp21" />
	  <input type="text" style="display:none" value="0" id="asti02temp29" />
	</table>
	
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
		    <?php $current_product_count = 0; //依照資料庫紀錄的明細先列一遍 ?>
			<?php foreach($body_data as $key => $val){
				$current_product_count++;
				echo "<tbody id='product_row_".$current_product_count."' class='product_row' >";
				echo "<tr>";
				echo "<td class='center'><img src='".base_url()."assets/image/delete.png' title='刪除資料' onclick='del_detail(\"".$tc001."\",\"".$tc002."\",\"".$val->asti02_asti09."\",\"".$val->asti02_asti09_mc003."\",\"".$val->td010."\",\"".$current_product_count."\");' /></td>";
				foreach($usecol_array as $k => $v){
					if(isset($v['type'])){$type = $v['type'];}else{$type = "text";}
					
					echo "<td nowrap='value'";  //1060728  加nowrap 圖示在同一行
					if(isset($v['data_class'])){echo "class='".$v['data_class']."'";}
					echo ">";
					
					if($type == "text"){
						echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".$val->$k."' onKeyPress='keyFunction()' ";
						if(isset($v['size'])){echo "size='".$v['size']."' ";}
						if(isset($v['id'])){echo "id='".$v['id']."' ";}
						if(isset($v['class'])){echo "class='".$v['class']."' ";}
						if(isset($v['onclick'])){echo "onclick=\"".$v['onclick']."\" ";}
						if(isset($v['ondblclick'])){echo "ondblclick=\"".$v['ondblclick']."\" ";}
						if(isset($v['onchange'])){echo "onchange=\"".$v['onchange']."\" ";}
						echo "style=\"".'background-color:#F0F0F0'."\" ";
						if(isset($v['readonly'])){echo "readonly='".$v['readonly']."' ";}
						echo "disabled=disabled";
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
                  <tfoot>
              
		    <tr>
             <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
            </tr>
			  
            </tfoot>
          </table>
        </div>
	 </div>
	
	 </div>
	</div>
	
	<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ast/asti09/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	
	    <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('ast/asti09/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('ast/asti09/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>	
		</div> 
      </form>
     </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  <!--  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>  -->
  </div> <!-- div-3 -->
 </div> <!-- div-2 -->
</div> <!-- div-1 -->


<script>
$(document).ready(function(){
	var temp_tc021 = Number($('#tc021').val());
	var temp_tc020 = Number($('#exchange_rate').val());
	
	
	var exchange_tc021 = Math.round(temp_tc021 * temp_tc020);

	$('#exchange_tc021').val(exchange_tc021);
})
</script>