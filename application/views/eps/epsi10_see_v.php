 <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'th003' || $key == 'th017' || $key == 'th005'){
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 出口費用建立作業 - 查看</h1>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/eps/epsi06/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="tab-general"> <!-- div-6 -->
      
	<table class="form14"  >     <!-- 頭部表格 -->
	 <tr>
	    <td class="start14a"  width="9%"><span class="required">費用單別：</span></td>   <!--onchange="startepsi01(this);check_title_no();"    -->
        <td class="normal14a"  width="25%"><input tabIndex="1" id="epsi01"   ondblclick="search_epsi01_window()" onKeyPress="keyFunction()"  readonly="readonly" name="th001" onfocus="selverify();" onchange="check_epsi01(this);check_title_no();"  value="<?php echo $th001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showepsi01disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="epsi01disp"> <?php    echo $th001disp; ?> </span></td>
	    <td class="normal14a" width="8%" >單據日期： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="th017" onKeyPress="keyFunction()"  onblur="dateformat_ymd(this);" name="th017"  value="<?php echo $th017; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(th017,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	    <td class="start14a" width="9%"><span class="required">費用單號：</span></td>
        <td class="normal14a" width="24%"><input tabIndex="3" id="th002" onKeyPress="keyFunction()" onfocus="" name="th002"  readonly="readonly" value="<?php echo $th002; ?>" size="12" type="text" required /></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a">廠商代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="puri01" ondblclick="search_puri01_window()" onKeyPress="keyFunction()"  onchange="check_puri01(this)" name="th004" value="<?php echo $th004; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showpuri01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="puri01disp"> <?php   echo $th004disp; ?> </span></td>
	    <td class="normal14">發票號碼.：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5"   onKeyPress="keyFunction()" id="th006" name="th006"   value="<?php echo $th006; ?>"  size="12" /></td>
	    <td class="normal14">發票日期：</td>
        <td  class="normal14"  ><input type="text" tabIndex="6" readonly="value"  onKeyPress="keyFunction()" id="th005" name="th005"   value="<?php echo $th005; ?>" size="12"  style="background-color:#F0F0F0"/>
	    <img  onclick="scwShow(th005,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
	  
		 <tr>
	    <td class="normal14a"  >幣別：</td>
        <td class="normal14" ><input tabIndex="10" id="cmsi06" ondblclick="search_cmsi06_window()" onKeyPress="keyFunction()" name="th008" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $th008; ?>"  type="text"    />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $th008disp; ?> </span></td>
	    <td class="normal14" >匯率：</td>		
        <td class="normal14"  ><input type="text" id="exchange_rate"   tabIndex="11"   onKeyPress="keyFunction()"    name="th009" value="<?php echo $th009; ?>"   /></td>
	    <td class="normal14" >發票聯數：</td>		
        <td class="normal14"  ><select id="th010" tabIndex="7" readonly="value" onKeyPress="keyFunction()" name="th010"   style="background-color:#F0F0F0" >
            <option <?php if($th010 == '5') echo 'selected="selected"';?> value='5'>5.電子計算機發票</option>                                                                        
		    <option <?php if($th010 == '1') echo 'selected="selected"';?> value='1'>1.二聯式</option>
            <option <?php if($th010 == '2') echo 'selected="selected"';?> value='2'>2.三聯式</option>
		    <option <?php if($th010 == '3') echo 'selected="selected"';?> value='3'>3.二聯式收銀機發票</option>
            <option <?php if($th010 == '4') echo 'selected="selected"';?> value='4'>4.三聯式收銀機發票</option>	
            <option <?php if($th010 == '6') echo 'selected="selected"';?> value='6'>6.免用統一發票</option>	
            <option <?php if($th010 == 'A') echo 'selected="selected"';?> value='A'>A.增值稅專用發票</option>	
            <option <?php if($th010 == 'B') echo 'selected="selected"';?> value='B'>B.普通發票</option>
            <option <?php if($th010 == 'C') echo 'selected="selected"';?> value='C'>C.免用發票</option>			
		  </select></td></tr>
	   <tr>
	    <td class="normal14a"  >出貨廠別：</td>
        <td class="normal14" ><input tabIndex="13" id="cmsi02" ondblclick="search_cmsi02_window()" onKeyPress="keyFunction()" name="th007" onblur="check_cmsi02(this);check_rate(this);"  value="<?php echo $th007; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
          <span id="cmsi02disp"> <?php    echo $th007disp; ?> </span></td>
	    <td class="normal14" >課稅別：</td>		
        <td class="normal14"  ><select id="taxes" onKeyPress="keyFunction()" name="th011" onchange="seltaxes(this)" tabIndex="14">
		    <option <?php  if($th011 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php  if($th011 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php  if($th011 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php  if($th011 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php  if($th011 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select></td><td class="normal14" >營業稅率：</td>		
        <td class="normal14"  ><input type="text" id="th019"   tabIndex="15"   onKeyPress="keyFunction()"    name="th019" value="<?php echo $th019; ?>"   /></td>
	  </tr>
	  <tr>
	    <td class="normal14" >備註：</td>		
        <td class="normal14" colspan="3" ><input type="text" id="th016"  tabIndex="16"   onKeyPress="keyFunction()"    name="th015" value="<?php echo $th015; ?>" size="100"  /></td>
	    <td class="normal14" ></td>		
        <td class="normal14"  ></td>
	  	<td class="normal14a"  ></td>
        <td class="normal14" ></td>
	    </tr>
	   <tr>
	    <td class="normal14" >付款條件：</td>		
        <td class="normal14"  ><input tabIndex="17" id="cmsi21" ondblclick="search_cmsi21_window()" onKeyPress="keyFunction()" name="th022" onblur="check_cmsi21(this)"   value="<?php echo  $th022; ?>"   size="12"   type="text"  />
		  <a href="javascript:;"><img id="Showcmsi21disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
          <span id="cmsi21disp"> <?php    echo $th022disp; ?> </span></td><td class="normal14" >列印次數：</td>		
        <td class="normal14"  ><input type="text" id="th016"   tabIndex="17"   onKeyPress="keyFunction()"    name="th016" value="<?php echo $th016; ?>"   /></td>
	  	<td class="normal14a"  >費用日期：</td>
        <td class="normal14" ><input type="text" tabIndex="18" readonly="value"  onKeyPress="keyFunction()" id="th003" name="th003"   value="<?php echo $th003; ?>" size="12"  style="background-color:#F0F0F0"/></td>
	    </tr>
		 <tr>
	    <td class="normal14">簽核狀態：</td>
        <td class="normal14"  ><select id="th023" tabIndex="19" readonly="value" onKeyPress="keyFunction()" name="th023"   style="background-color:#F0F0F0" >
            <option <?php if($th023 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($th023 == '0') echo 'selected="selected"';?> value='0'>0.待處理</option>
            <option <?php if($th023 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($th023 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($th023 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($th023 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($th023 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($th023 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
        <td class="normal14">確認碼：</td>
        <td  class="normal14"  ><select id="verify" onKeyPress="keyFunction()" name="th014" onChange="selverify(this)" tabIndex="20">
            <option <?php if($th014 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($th014 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($th014 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>
	     <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="21" readonly="value"  onKeyPress="keyFunction()" id="th018" name="th018"   value="<?php echo $th018; ?>" style="background-color:#F0F0F0" size="12" /></td>
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
				echo "<td class='center'><img src='".base_url()."assets/image/delete.png' title='刪除資料' onclick='del_detail(\"".$val->ti001."\",\"".$val->ti002."\",\"".$val->ti003."\",\"".$current_product_count."\");' /></td>";
				foreach($usecol_array as $k => $v){
					if($k=="ti005disp" || $k=="ti007disp" ){
						//$s = substr($val->$k,0,4)."/".substr($val->$k,4,2)."/".substr($val->$k,6,2);
					//	$s = stringtodate("Y/m/d",$val->$k);
					}else{
						$s = $val->$k;
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
		     <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span></span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　原幣應付金額：</b></td>
				<td ><input type='text' readonly="value" name='th012' id="th012" size="8" value="<?php echo $th012; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='th013' id="th013" size="8" value="<?php echo $th013; ?>"  style="background-color:#F0F0F0" /></td>
			
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣應付總額：</b></td>
				<td ><input type='text' readonly="value" name="th1213" id="th1213" size="8" value="<?php echo $th012+$th013; ?>"  style="background-color:#F0F0F0" /></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　本幣應付金額：</b></td>
				<td ><input type='text' readonly="value" name='th020' id="th020" size="8" value="<?php echo $th020; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='th021' id="th021" size="8" value="<?php echo $th021; ?>"  style="background-color:#F0F0F0" /></td>
			
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣應付總額：</b></td>
				<td ><input type='text' readonly="value" name="th2021" id="th2021" size="8" value="<?php echo $th020+$th021; ?>"  style="background-color:#F0F0F0" /></td>
				
					<input id="select_rows" style="display:none;"/>
				<td class="left" valign="top"></td>
              </tr>
		<!-- 合計     -->	
	<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('eps/epsi06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	    <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('eps/epsi06/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('eps/epsi06/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
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
<?php  include_once("./application/views/funnew/fun_disabled_v.php"); ?>      <!-- 全域變數 -->