 <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'tb003' || $key == 'tb015'){
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 移轉單建立作業 - 查看</h1>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/sfc/sfci05/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="tab-general"> <!-- div-6 -->
      
	<table class="form14"  >     <!-- 頭部表格 -->
	 <tr>
	    <td class="start14a"  width="9%"><span class="required">移轉單別：</span></td>   <!--onchange="startsfci01(this);check_title_no();"    -->
        <td class="normal14a"  width="25%"><input tabIndex="1" id="sfci01"    onKeyPress="keyFunction()"   name="tb001"  onchange="check_sfci01(this);check_title_no();"  value="<?php echo $tb001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showsfci01disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="sfci01disp"> <?php    echo $tb001disp; ?> </span></td>
	    <td class="normal14a" width="8%" >單據日期： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tb015" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="tb015"  value="<?php echo $tb015; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tb015,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	    <td class="start14a" width="8%"><span class="required">移轉單號：</span></td>
        <td class="normal14a" width="25%"><input tabIndex="3" id="tb002" onKeyPress="keyFunction()" readonly="value" name="tb002" onfocus="check_title_no();" value="<?php echo $tb002; ?>" size="12" type="text" required /></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a">廠別代號：</td>
        <td  class="normal14"  ><input type="text" tabIndex="4" onKeyPress="keyFunction()" id="cmsi02"  onblur="check_cmsi02(this)" name="tb010"   value="<?php echo  $tb010; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	      <span id="cmsi02disp"> <?php    echo $tb010disp; ?> </span></td>
	    <td class="normal14">更新碼：</td>
        <td  class="normal14"  > <input type="hidden" name="tb012" class="tb012"  value="N" />
		  <input tabIndex="5" id="tb012" onKeyPress="keyFunction()"  name="tb012" <?php if($tb012 == 'Y' ) echo 'checked';  ?>  <?php if($tb012 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  />
        </td><td class="normal14">備註：</td>
        <td  class="normal14"  ><input type="text" tabIndex="6"   onKeyPress="keyFunction()" id="tb014" name="tb014"   value="<?php echo $tb014; ?>"  size="30" /></td>
		</tr>
	  <tr>	    
		<td class="normal14">移出類別：</td>
        <td  class="normal14"  ><select id="tb004" onKeyPress="keyFunction()" name="tb004"  tabIndex="7">
            <option <?php if($tb004 == '1') echo 'selected="selected"';?> value='1'>1生產線別</option>                                                                        
		    <option <?php if($tb004 == '2') echo 'selected="selected"';?> value='2'>2加工廠商</option>
			<option <?php if($tb004 == '3') echo 'selected="selected"';?> value='3'>3庫別</option>
		  </select></td>
	    <td class="normal14">移出部門：</td>
        <td  class="normal14"  ><input type="text" tabIndex="8" onKeyPress="keyFunction()" id="cmsi05"  name="tb005"  onblur="check_cmsi05(this);"    value="<?php echo  $tb005; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Showcmsi05disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
	      <span id="cmsi05disp" > <?php    echo $tb005disp; ?> </span></td>
		  <td class="normal14">移出部門名稱：</td>
        <td  class="normal14"  ><input type="text" tabIndex="9" readonly="value"  onKeyPress="keyFunction()" id="tb006" name="tb006"   value="<?php echo $tb006; ?>" size="12"  style="background-color:#F0F0F0"/></td>
	  </tr>
	  <tr>	    
		<td class="normal14">移入類別：</td>
        <td  class="normal14"  ><select id="tb007" onKeyPress="keyFunction()" name="tb007"  tabIndex="10">
            <option <?php if($tb007 == '1') echo 'selected="selected"';?> value='1'>1生產線別</option>                                                                        
		    <option <?php if($tb007 == '2') echo 'selected="selected"';?> value='2'>2加工廠商</option>
			<option <?php if($tb007 == '3') echo 'selected="selected"';?> value='3'>3庫別</option>
		  </select></td>
	    <td class="normal14">移入部門：</td>
        <td  class="normal14"  ><input type="text" tabIndex="11" onKeyPress="keyFunction()" id="cmsi05a"  name="tb008"  onblur="check_cmsi05a(this);"    value="<?php echo  $tb008; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Showcmsi05adisp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
	      <span id="cmsi05adisp" > <?php    echo $tb008disp; ?> </span></td>
		  <td class="normal14">移入部門名稱：</td>
        <td  class="normal14"  ><input type="text" tabIndex="12" readonly="value"  onKeyPress="keyFunction()" id="tb009" name="tb009"   value="<?php echo $tb009; ?>" size="12"  style="background-color:#F0F0F0"/></td>
	  </tr>
	  <tr>	    
		<td class="normal14">簽核狀態：</td>
        <td class="normal14"  ><select id="tb017" tabIndex="13" readonly="value" onKeyPress="keyFunction()" name="tb017"   style="background-color:#F0F0F0" >
            <option <?php if($tb017 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tb017 == '0') echo 'selected="selected"';?> value='0'>0.待處理</option>
            <option <?php if($tb017 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tb017 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tb017 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tb017 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tb017 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tb017 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>	
	    <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="14" readonly="value"  onKeyPress="keyFunction()" id="tb016" name="tb016"   value="<?php echo $tb016; ?>" style="background-color:#F0F0F0" size="12" /></td>
	    <td class="normal14">移轉日期：</td>
        <td  class="normal14"  ><input tabIndex="15" readonly="value" ondblclick="scwShow(this,event);"   id="tb003" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tb003"  value="<?php echo $tb003; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
           </td></tr>
	  <tr>	    
	  
	  <tr>
	    <td class="normal14">列印次數：</td>
        <td  class="normal14"  ><input type="text" tabIndex="16" readonly="value"  onKeyPress="keyFunction()" id="tb011" name="tb011"   value="<?php echo $tb011; ?>"  size="12" style="background-color:#F0F0F0"  /></td>
        <td class="normal14">確認碼：</td>
        <td  class="normal14"  ><select id="verify" onKeyPress="keyFunction()" name="tb013" onChange="selverify(this)" tabIndex="9">
            <option <?php if($tb013 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tb013 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tb013 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>
        <td class="normal14"></td>
        <td  class="normal14"  ></td>
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
				echo "<td class='center'><img src='".base_url()."assets/image/delete.png' title='刪除資料' onclick='del_detail(\"".$val->tc001."\",\"".$val->tc002."\",\"".$val->tc003."\",\"".$current_product_count."\");' /></td>";
				foreach($usecol_array as $k => $v){
					if($k=="tc024"  ){
						//$s = substr($val->$k,0,4)."/".substr($val->$k,4,2)."/".substr($val->$k,6,2);
						$s = stringtodate("Y/m/d",$val->$k);
					}else{
						if($k!="tc007disp"&&$k!="tc007disp1"&&$k!="tc009disp"&&$k!="tc009disp1"){//主鍵不用更改以及其他外來鍵庫別名稱
						$s = $val->$k;}
					}
					if(isset($v['type'])){$type = $v['type'];}else{$type = "text";}
					
					echo "<td nowrap='value'";  //1060728  加nowrap 圖示在同一行
					if(isset($v['data_class'])){echo "class='".$v['data_class']."'";}
					echo ">";
					
					if($type == "text"){
						echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".$s."' onKeyPress='keyFunction()' ";
						if(isset($v['size'])){echo "size='".$v['size']."' ";}
						if(isset($v['id'])){echo "id='".$v['id']."' ";}
						if(isset($v['class'])){echo "class='".$v['class']."' ";}
						if(isset($v['onclick'])){echo "onclick=\"".$v['onclick']."\" ";}
						if(isset($v['ondblclick'])){echo "ondblclick=\"".$v['ondblclick']."\" ";}
						if(isset($v['onchange'])){echo "onchange=\"".$v['onchange']."\" ";}
						if(isset($v['style'])){echo "style='".$v['style']."' ";}
						if(isset($v['readonly'])){echo "readonly='".$v['readonly']."' ";}
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
	<!-- 合計     -->
		   
		<!-- 合計     -->	
	<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('sfc/sfci05/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	
	    <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('sfc/sfci05/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('sfc/sfci05/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
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

<?php  include_once("./application/views/funnew/sfci01_funmjs_v.php"); ?> <!-- 訂單單別 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?>  <!-- 部門 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/sfci05_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<?php  include_once("./application/views/funnew/fun_disabled_v.php"); ?>      <!-- see js -->