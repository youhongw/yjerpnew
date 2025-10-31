 <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'tc003' || $key == 'tc039'){
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
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 客戶訂單資料建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cop/copi06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	    <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('cop/copi06/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('cop/copi06/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>
	  </div>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cop/copi06/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="tab-general"> <!-- div-6 -->
      
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="normal14y"  width="9%"><span class="required">客戶訂單別：</span></td>
        <td class="normal14a"  width="25%"><input tabIndex="1" id="copi03"    onKeyPress="keyFunction()"  onfocus="selappr()" name="copi03" onchange="startcopi03(this)"  value="<?php echo $tc001; ?>" size="12" type="text" required disabled="disabled"/>
		  <a href="javascript:;"><img id="Showcopi03disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="copi03disp"> <?php    echo $tc001disp; ?> </span></td>
	    <td class="normal14y" width="8%" >單據日期： </td>
        <td class="normal14a"  width="25%" ><input tabIndex="2"  onclick="scwShow(this,event);" onfocus="selappr()"  id="tc039" onKeyPress="keyFunction()"  onchange="chkno1(this)" name="tc039"  value="<?php echo $tc039; ?>"  size="12" type="text" style="background-color:#FFFFE4" disabled="disabled" /></td>
	    <td class="normal14y" width="8%"><span class="required">訂單單號：</span></td>
        <td class="normal14a" width="25%"><input tabIndex="3" id="tc002" onKeyPress="keyFunction()" readonly="value" name="tc002" value="<?php echo $tc002; ?>" size="12" type="text" required disabled="disabled" /><span id="tc002disp" ></span></td>
	  </tr>	
	  
	  <tr>	    
		<td class="normal14z">客戶代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="copi01" onKeyPress="keyFunction()"  onchange="check_copi01(this)" name="copi01" value="<?php echo $tc004; ?>" size="12" type="text" disabled="disabled" />
		  <a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="copi01disp"> <?php   echo $tc004disp; ?> </span></td>
	    <td class="normal14z">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" readonly="value"  onKeyPress="keyFunction()" id="tc040" name="tc040"   value="<?php echo $tc040; ?>" style="background-color:#F0F0F0" size="12" disabled="disabled"/></td>
		<td class="normal14z">訂單日期：</td>
        <td  class="normal14"  ><input type="text" tabIndex="6" readonly="value"  onKeyPress="keyFunction()" id="tc003" name="tc003"   value="<?php echo $tc003; ?>" size="12" disabled="disabled" style="background-color:#F0F0F0"/></td>
	  </tr>
	  <tr>
	    <td class="normal14z">流程代號：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" readonly="value"  onKeyPress="keyFunction()" id="tc049" name="tc049"   value="<?php echo $tc049; ?>"  size="12" style="background-color:#F0F0F0" disabled="disabled" /></td>
        <td class="normal14z">拋轉狀態：</td>
        <td  class="normal14"  ><select id="tc050" tabIndex="8" readonly="value" onKeyPress="keyFunction()" name="tc050"   style="background-color:#F0F0F0" disabled="disabled" >
            <option <?php if($tc050 == 'N') echo 'selected="selected"';?> value='N'>N.未拋轉</option>                                                                        
		    <option <?php if($tc050 == 'Y') echo 'selected="selected"';?> value='Y'>Y.拋轉成功(來源廠商)</option>
            <option <?php if($tc050 == 'y') echo 'selected="selected"';?> value='y'>y.拋轉成功(下游廠商)</option>
		    <option <?php if($tc050 == 'n') echo 'selected="selected"';?> value='n'>n.訂單變更</option>
            <option <?php if($tc050 == 'U') echo 'selected="selected"';?> value='U'>U.拋轉失敗</option>	
            <option <?php if($tc050 == 'u') echo 'selected="selected"';?> value='u'>u.還原失敗</option>	
		  </select></td>
        <td class="normal14z">確認碼：</td>
        <td  class="normal14"  ><select id="tc027" onKeyPress="keyFunction()" name="tc027" onChange="selappr(this)" tabIndex="9">
            <option <?php if($tc027 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tc027 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tc027 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>
	  </tr>
		
	</table>
	
	<div class="abgne_tab"> <!-- div-7 頁標籤-->
		<ul class="tabs">
		  <li><a href="#tab1"  accesskey="a">交易資料a</a></li>
		  <li><a href="#tab2"  accesskey="b">地址b</a></li>	
		</ul>
		
    <div class="tab_container"> <!-- div-8 -->
	<!--   基本資料1 -->
	<div id="tab1" class="tab_content">
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y"  width="8%">部門代號：</td>
        <td class="normal14a"  width="24%" ><input type="text" tabIndex="10" onKeyPress="keyFunction()" id="cmsi05"  name="cmsi05"  onchange="startcmsi05(this)"    value="<?php echo  $tc005; ?>"   size="12"  disabled="disabled" />
	      <a href="javascript:;"><img id="Showcmsi05disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
	      <span id="cmsi05disp" > <?php    echo $tc005disp; ?> </span></td>
	    <td class="normal14y"  width="8%">業務人員：</td>  <!-- onchange="startcmsi09(this)"     -->
        <td class="normal14a"  width="26%" ><input tabIndex="6" id="cmsi09" onKeyPress="keyFunction()" name="cmsi09" onchange="check_cmsi09(this)"  value="<?php echo $tc006; ?>"  type="text"  size="12" disabled="disabled" />
		  <a href="javascript:;"><img id="Showcmsi09disp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
          <span id="cmsi09disp"> <?php    echo $tc006disp; ?> </span></td>
	    <td class="normal14y"  width="8%">廠別：</td>   <!-- onchange="startcmsi02(this)"  onchange="check_cmsi02(this)"   -->
        <td class="normal14a"  width="26%" ><input type="text" tabIndex="10" onKeyPress="keyFunction()" id="cmsi02"  onchange="check_cmsi02(this)" name="cmsi02"   value="<?php echo  $tc007; ?>"   size="12" disabled="disabled"  />
	      <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	      <span id="cmsi02disp"> <?php    echo $tc007disp; ?> </span></td>
	 </tr>	
	  
	  <tr>
	    <td class="normal14z"  >幣別：</td>
        <td class="normal14" ><input tabIndex="11" id="cmsi06" onKeyPress="keyFunction()" name="cmsi06" onchange="check_cmsi02(this)"  value="<?php echo $tc008; ?>"  type="text"   size="12"disabled="disabled" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $tc008disp; ?> </span></td>
	    <td class="normal14z" >匯率：</td>		
        <td class="normal14"  ><input type="text" id="tc009"   tabIndex="12"   onKeyPress="keyFunction()"    name="tc009" value="<?php echo $tc009; ?>"  size="12" disabled="disabled"/></td>
	    <td class="normal14z" >客戶單號：</td>		
        <td class="normal14"  ><input type="text" id="tc012"   tabIndex="13"   onKeyPress="keyFunction()"    name="tc012" value="<?php echo $tc012; ?>"  size="12" disabled="disabled" /></td>
	  </tr>
	  
	  <tr>
		<td class="normal14z" >價格條件：</td>		
        <td class="normal14"  ><input type="text" id="tc013"   tabIndex="14"   onKeyPress="keyFunction()"    name="tc013" value="<?php echo $tc013; ?>"  size="12" disabled="disabled" /></td>
	    <td  class="normal14z" >付款條件：</td>
        <td  class="normal14"  ><input tabIndex="15" id="cmsi21" onKeyPress="keyFunction()" name="cmsi21" onchange="check_cmsi02(this)"   value="<?php echo  $tc014; ?>"   size="12"   type="text" disabled="disabled" />
		  <a href="javascript:;"><img id="Showcmsi21disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
          <span id="cmsi21disp"> <?php    echo $tc014disp; ?> </span></td>
	    <td class="normal14z" >營業稅率：</td>		
        <td class="normal14"  ><input type="text" id="tc041"   tabIndex="16"   onKeyPress="keyFunction()"    name="tc041" value="<?php echo $tc041; ?>"  size="12" disabled="disabled" /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >訂金比率：</td>		
        <td class="normal14"  ><input type="text" id="tc045"   tabIndex="17"   onKeyPress="keyFunction()"    name="tc045" value="<?php echo $tc045; ?>"  size="12" disabled="disabled" /></td>
	    <td class="normal14z"  >課稅別：</td>
        <td class="normal14" ><select id="tc016" onKeyPress="keyFunction()" name="tc016" onChange="seltax(this)" tabIndex="18">
		    <option <?php if($tc016 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php if($tc016 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php if($tc016 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php if($tc016 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php if($tc016 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select></td>
	    <td class="normal14z" >列印：</td>
        <td class="normal14"  ><input type="text"  readonly="value" tabIndex="19"   onKeyPress="keyFunction()"   name="tc028" value="<?php echo $tc028; ?>" style="background-color:#F0F0F0"  size="12" /></td>
	  </tr>
		
	  <tr>
	    <td class="normal14z">簽核狀態：</td>
        <td class="normal14"  ><select id="tc048" tabIndex="21" readonly="value" onKeyPress="keyFunction()" name="tc048"   style="background-color:#F0F0F0" >
            <option <?php if($tc048 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tc048 == '0') echo 'selected="selected"';?> value='0'>0.待處理</option>
            <option <?php if($tc048 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tc048 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tc048 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tc048 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tc048 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tc048 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>		   
	    <td class="start14a"></td>		
        <td class="start14"  ></td>
		<td class="start14a"></td>		
        <td class="start14"  ></td>
	  </tr>
	</table>
	</div>    <!--  end 標籤1 -->
	
	<!--  地址 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y"  width="10%">送貨地址(1)：</td>
        <td class="normal14a"  width="70%" ><input type="text" tabIndex="22"   onKeyPress="keyFunction()" id="tc010" name="tc010" size="120"  value="<?php echo $tc010; ?>" disabled="disabled"  />
	    <td class="normal14a"  width="10%" ></td>
        <td class="normal14a"  width="10%" ></td>
	  </tr>			  
	 
	  <tr>
	    <td class="normal14z">送貨地址(2)：</td>						
        <td class="normal14"  ><input type="text" tabIndex="23"   onKeyPress="keyFunction()" id="tc011" name="tc011"  size="120"   value="<?php echo $tc011; ?>"  disabled="disabled"  /></td>
		<td class="normal14" ></td>						
        <td class="normal14"  ></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14z">備註：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="24"   onKeyPress="keyFunction()" id="tc015" name="tc015"  size="120"   value="<?php echo $tc015; ?>" disabled="disabled"   /></td>
		<td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" /></td>
        <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" /></td>
	  </tr>	
	  
	</table>
 
	</div> 	<!--  end 標籤2 -->
	
	
	</div> <!-- </div>div-8 -->
	 </div> <!--</div>  div-7 -->
	
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
				echo "<td class='center'><img src='".base_url()."assets/image/delete.png' title='刪除資料' onclick='del_detail(\"".$val->td001."\",\"".$val->td002."\",\"".$val->td003."\",\"".$current_product_count."\");' /></td>";
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
				
				<td class="right" valign="top"><b style="color: #003A88;">　訂單金額：</b></td>
				<td ><input type='text' readonly="value" name='tc029' id="tc029" size="8" value="<?php echo $tc029; ?>"  style="background-color:#F0F0F0" /></td>
			
				<td class="right" valign="top"><b style="color: #003A88;">　　稅額：</b></td>
				<td ><input type='text' readonly="value" name='tc030' id="tc030" size="8" value="<?php echo $tc030; ?>"  style="background-color:#F0F0F0" /></td>
			
				<td class="right" valign="top"><b style="color: #003A88;">　　合計金額：</b></td>
			
				<td ><input type='text' readonly="value" name="tc2930" id="tc2930" size="8" value="<?php echo $tc029+$tc030; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總數量：</b></td>
				<td ><input type='text' readonly="value" name='tc031' id="tc031" size="8" value="<?php echo $tc031; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總毛重：</b></td>
				<td ><input type='text' readonly="value" name='tc043' id="tc043" size="8" value="<?php echo $tc043; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總材積：</b></td>
				<td ><input type='text' readonly="value" name='tc044' id="tc044" size="8" value="<?php echo $tc044; ?>"  style="background-color:#F0F0F0" /></td>
				<td style="display:none;">
				<td class="left" valign="top"></td>
				
              </tr>
		<!-- 合計     -->	
	<!--<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cop/copi06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	    <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('cop/copi06/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('cop/copi06/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>	
		</div> -->
      </form>
	    <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>  
 
     </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  <!--  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>  -->
  </div> <!-- div-3 -->
 </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php  include_once("./application/views/funnew/fun_disabled_v.php"); ?>