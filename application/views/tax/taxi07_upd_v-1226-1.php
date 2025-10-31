 <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'mc002' || $key == 'mc003'){
		$$key = stringtodate("Y/m",$val);   //自訂函數 main_head_v
	}
		if($key == 'mc007' ){
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
 // $stax_rate = $this->session->userdata('sysma004');
 // $sysma200 = $this->session->userdata('sysma200');
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 進銷項憑證建立作業 - 修改</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/tax/taxi07/updsave" method="post" enctype="multipart/form-data" >
	<div id="tab-general"> <!-- div-6 -->
	
	<table class="form14"  >     <!-- 頭部表格 -->
	<tr>
	    <td class="start14a"  width="9%"><span class="required">申報公司：</span></td>   <!--onchange="startcopi03(this);check_title_no();"    -->
        <td class="normal14a"  width="25%"><input tabIndex="1" id="cmsi11"    onKeyPress="keyFunction()"   name="cmsi11"  onchange="check_cmsi11(this);check_title_no();"  value="<?php echo $mc001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showcmsi11disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="cmsi11disp"> <?php    echo $mc001disp; ?> </span></td>
	    <td class="normal14a" width="8%" >申報年月： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mc002" onKeyPress="keyFunction()"  onchange="dateformat_ym(this);check_title_no();" name="mc002"  value="<?php echo $mc002; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /></td>
	    <td class="normal14a" width="8%" >迄年月： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mc003" onKeyPress="keyFunction()"  onchange="dateformat_ym(this);check_title_no();" name="mc003"  value="<?php echo $mc003; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /></td>
	    
	  </tr>
	  <tr>	    
		<td class="normal14">進銷項：</td>
        <td  class="normal14"  ><select  tabIndex="3" id="mc005" onKeyPress="keyFunction()"  name="mc005" >
             <option <?php if($mc005 == '1') echo 'selected="selected"';?> value='1'>1:進項</option>                                                                      
		     <option <?php if($mc005 == '2') echo 'selected="selected"';?> value='2'>2:銷項</option>
			
		  </select>
	    <td class="normal14a">流水號：</td>
        <td  class="normal14"  ><input tabIndex="3" id="mc006" onKeyPress="keyFunction()"  name="mc006" onfocus="check_title_no();" value="<?php echo $mc006; ?>" size="16" type="text" required /></td>
		 
	     <td class="normal14">憑證類別：</td>
        <td  class="normal14"  ><select  tabIndex="3" id="mc004" onKeyPress="keyFunction()"  name="mc004" >
            <option <?php if($mc004 == '1') echo 'selected="selected"';?> value='1'>1:三聯式.電子計算機發票(可扣抵)</option>                                                                      
		     <option <?php if($mc004 == '2') echo 'selected="selected"';?> value='2'>2:三收銀.電子發票.公用事業發票(可扣抵)</option>
			 <option <?php if($mc004 == '3') echo 'selected="selected"';?> value='3'>3:二收銀有稅憑證(可扣抵)</option>
			 <option <?php if($mc004 == '4') echo 'selected="selected"';?> value='4'>4:海關代徵(可扣抵)</option>
			 <option <?php if($mc004 == '5') echo 'selected="selected"';?> value='5'>5:海關退溢繳(可扣抵)</option>
			 <option <?php if($mc004 == '6') echo 'selected="selected"';?> value='6'>6:進口貨物勞務(可扣抵)</option>
			 <option <?php if($mc004 == '7') echo 'selected="selected"';?> value='7'>7:進退折(可扣抵)</option>
			 <option <?php if($mc004 == '8') echo 'selected="selected"';?> value='8'>8:銷退折(可扣抵)</option>
			 
			 <option <?php if($mc004 == 'a') echo 'selected="selected"';?> value='a'>a:不可扣抵應.零.免稅發票(不可扣抵)</option>
			 <option <?php if($mc004 == 'b') echo 'selected="selected"';?> value='b'>b:免用統一發票(不可扣抵)</option>
			 <option <?php if($mc004 == 'c') echo 'selected="selected"';?> value='c'>c:需扣繳申報收據(不可扣抵)</option>
			 <option <?php if($mc004 == 'd') echo 'selected="selected"';?> value='d'>d:不需扣繳申報收據(不可扣抵)</option>
			 <option <?php if($mc004 == 'e') echo 'selected="selected"';?> value='e'>e:進口貨物勞務(不可扣抵)</option>
			 <option <?php if($mc004 == 'f') echo 'selected="selected"';?> value='f'>f:進退折(不可扣抵)</option>
		  </select></td>
	  </tr>
	  <tr>	    
		<td class="normal14">開立日期：</td>
        <td  class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mc007" onKeyPress="keyFunction()"  onblur="dateformat_ymd(this);check_vno(this);" name="mc007"  value="<?php echo $mc007; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /></td>
	    <td class="normal14">買方客代：</td>
        <td  class="normal14"  ><input tabIndex="4" id="copi01" onKeyPress="keyFunction()"  onchange="check_copi01(this)" name="copi01" value="<?php echo $mc008; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="copi01disp"> <?php   echo $mc008disp; ?> </span></td>
		<td class="normal14a">賣方廠代：</td>
        <td  class="normal14"  ><input tabIndex="4" id="puri01" onKeyPress="keyFunction()"  onchange="check_puri01(this)" name="puri01" value="<?php echo $mc009; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showpuri01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="puri01disp"> <?php   echo $mc009disp; ?> </span></td>
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
				echo "<td class='center'><img src='".base_url()."assets/image/delete2.png' title='刪除資料' onclick='del_detail(\"".$val->md001."\",\"".$val->md002."\",\"".$current_product_count."\");' /></td>";
				foreach($usecol_array as $k => $v){
				//	if($k=="md013" ){
						//$s = substr($val->$k,0,4)."/".substr($val->$k,4,2)."/".substr($val->$k,6,2);
				//		$s = stringtodate("Y/m/d",$val->$k);
				//	}else{
						$s = $val->$k;
				//	}
					
					if(isset($v['type'])){$type = $v['type'];}else{$type = "text";}
					
					echo "<td nowrap='value'";  //1060728  加nowrap 圖示在同一行
					if(isset($v['data_class'])){echo "class='".$v['data_class']."'";}
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
             <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
            </tr>
			  
            </tfoot>
          </table>
        </div>
	 </div>
	 
	<!-- 合計     -->
		      <tr>
             
				<td style="display:none;"></td> <!-- <input id="select_rows" size="1" /> -->
				<td class="left" valign="top"></td>
				
              </tr>
		<!-- 合計     -->	
	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();totalSum();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('tax/taxi07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
	  ?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('tax/taxi07/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
	  <?php } ?>
	  <?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
	  ?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('tax/taxi07/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
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
<form action="<?php echo base_url()?>index.php/tax/taxi07/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
			<input id="del_md004" name="del_md004" />
		</form>
		
<?php  include_once("./application/views/funnew/cmsi11_funmjs_v.php"); ?> <!-- 申報公司 -->
<?php  include_once("./application/views/funnew/copi01_funmjs_v.php"); ?>  <!--客戶代號 -->
<?php  include_once("./application/views/funnew/puri01_funmjs_v.php"); ?>  <!--廠商代號 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/taxi07_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 