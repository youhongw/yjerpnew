 <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'te003' || $key == 'te008'){
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 資產外送建立作業 - 查看</h1>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ast/asti14/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="tab-general"> <!-- div-6 -->
      
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="normal14a" width="9%"><span class="required">單別：</span></td>
        <td  class="normal14a"  width="25%"  ><input tabIndex="1" id="asti03_asti14" onKeyPress="keyFunction()" onfocus="check_title_no();"  onchange="check_asti03_asti14(this);check_title_no();" name="asti03_asti14" value="<?php echo $te001; ?>" size="12" type="text" readonly="value" style="background-color:#F0F0F0" required  />
		<a href="javascript:;"><img id="Showasti03_asti14disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="asti03_asti14disp"> <?php   echo $te001disp; ?> </span></td>
		  
		  
	    <td class="normal14a" width="8%" >異動日期：</td>  
        <td class="normal14a"  width="25%"><input tabIndex="5" id="te003" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="te003"  value="<?php echo $te003; ?>"  size="12" type="text" readonly="value" style="background-color:#F0F0F0"/></td>
	
	  </tr>
	  
	  <tr>	    
		<td class="normal14"><span class="required">單號：</span></td>
        <td class="normal14a"><input tabIndex="2" id="te002" onKeyPress="keyFunction()" readonly="value" name="te002" onfocus="check_title_no();" value="<?php echo $te002; ?>" size="12" type="text" style="background-color:#F0F0F0" required /></td>
	    
		<td class="normal14">確認者：</td>
        <td class="normal14"><input type="text" tabIndex="6" readonly="value"  onKeyPress="keyFunction()" id="te009" name="tce009"  value="<?php echo $te009; ?>" style="background-color:#F0F0F0" size="12"/></td>
		
	  </tr>
	  
	  <tr>
	    <td class="normal14">單據日期：</td>
        <td class="normal14a"  width="25%" ><input tabIndex="3" id="te008" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="te008"  value="<?php echo $te008; ?>"  size="12" type="text" readonly="value" style="background-color:#F0F0F0"  /></td>
        
		<td class="normal14">列印次數：</td>
        <td  class="normal14"><input tabIndex="7" id="te007" onKeyPress="keyFunction()"  onchange="" name="te007"  value="<?php echo $te007; ?>"  size="12" type="text" readonly="value" style="background-color:#F0F0F0" /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14">備註：</td>
        <td class="normal14a"><input tabIndex="4" id="te004" onKeyPress="keyFunction()"  onchange="" name="te004"  value="<?php echo $te004; ?>"  size="24" type="text" readonly="value" style="background-color:#F0F0F0" /></td>
        
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
				echo "<td class='center'><img src='".base_url()."assets/image/delete.png' title='刪除資料' onclick='del_detail(\"".$te001."\",\"".$te002."\",\"".$val->th003."\",\"".$val->th005."\",\"".$val->th006."\",\"".$val->th007."\",\"".$current_product_count."\");' /></td>";
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
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ast/asti14/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	
	    <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('ast/asti14/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('ast/asti14/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
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
	$('#book_value').val("<?php echo ($mb020 + $mb021 - $mb029); ?>");
})
</script>