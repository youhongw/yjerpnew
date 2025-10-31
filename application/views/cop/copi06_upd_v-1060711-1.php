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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 客戶訂單資料建立作業 - 修改</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cop/copi06/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	
	<table class="form14"  >     <!-- 頭部表格 -->
	 <tr>
	    <td class="start14a"  width="9%"><span class="required">客戶訂單別：</span></td>
        <td class="normal14a"  width="25%"><input tabIndex="1" id="copi03"    onKeyPress="keyFunction()"  onfocus="selappr()" name="copi03" onchange="startcopi03(this)"  value="<?php echo $tc001; ?>" size="12" type="text" required />
		<a href="javascript:;"><img id="Showcopi03disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="copi03disp"> <?php    echo $tc001disp; ?> </span></td>
	    <td class="normal14a" width="8%" >單據日期： </td>
        <td class="normal14a"  width="25%" ><input tabIndex="2"  onclick="scwShow(this,event);" onfocus="selappr()"  id="tc039" onKeyPress="keyFunction()"  onchange="chkno1(this)" name="tc039"  value="<?php echo $tc039; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /></td>
	     <td class="start14a" width="8%"><span class="required">訂單單號：</span></td>
        <td class="normal14a" width="25%"><input tabIndex="3" id="tc002" onKeyPress="keyFunction()" readonly="value" name="tc002" value="<?php echo $tc002; ?>" size="12" type="text" required /><span id="tc002disp" ></span></td>
	  </tr>	
	  <tr>	    
		 <td class="normal14a">客戶代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="copi01" onKeyPress="keyFunction()"  onchange="check_copi01(this)" name="copi01" value="<?php echo $tc004; ?>" size="12" type="text"  />
		<a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
        <span id="copi01disp"> <?php   echo $tc004disp; ?> </span></td>
	    <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" readonly="value"  onKeyPress="keyFunction()" id="tc040" name="tc040"   value="<?php echo $tc040; ?>" style="background-color:#F0F0F0" size="12" /></td>
		 <td class="normal14">訂單日期：</td>
        <td  class="normal14"  ><input type="text" tabIndex="6" readonly="value"  onKeyPress="keyFunction()" id="tc003" name="tc003"   value="<?php echo $tc003; ?>" size="12"  style="background-color:#F0F0F0"/></td>
	  </tr>
	   <tr>
	   <td class="normal14">流程代號：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" readonly="value"  onKeyPress="keyFunction()" id="tc049" name="tc049"   value="<?php echo $tc049; ?>"  size="12" style="background-color:#F0F0F0"  /></td>
        <td class="normal14">拋轉狀態：</td>
        <td  class="normal14"  ><select id="tc050" tabIndex="8" readonly="value" onKeyPress="keyFunction()" name="tc050"   style="background-color:#F0F0F0" >
            <option <?php if($tc050 == 'N') echo 'selected="selected"';?> value='N'>N.未拋轉</option>                                                                        
		    <option <?php if($tc050 == 'Y') echo 'selected="selected"';?> value='Y'>Y.拋轉成功(來源廠商)</option>
            <option <?php if($tc050 == 'y') echo 'selected="selected"';?> value='y'>y.拋轉成功(下游廠商)</option>
		    <option <?php if($tc050 == 'n') echo 'selected="selected"';?> value='n'>n.訂單變更</option>
            <option <?php if($tc050 == 'U') echo 'selected="selected"';?> value='U'>U.拋轉失敗</option>	
            <option <?php if($tc050 == 'u') echo 'selected="selected"';?> value='u'>u.還原失敗</option>	
		  </select></td>
           <td class="normal14">確認碼：</td>
          <td  class="normal14"  ><select id="tc027" onKeyPress="keyFunction()" name="tc027" onChange="selappr(this)" tabIndex="9">
            <option <?php if($tc027 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tc027 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tc027 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>  		
	<!--	<tr>
		 <td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" /></td>
         <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" /></td>
		 
	  </tr>  -->
		
	</table>
	
	<div class="abgne_tab"> <!-- div-7 -->
		<ul class="tabs">
			<li><a href="#tab1"  accesskey="a">交易資料a</a></li>
		<li><a href="#tab2"  accesskey="b">地址b</a></li>			
		</ul>

    <div class="tab_container"> <!-- div-8 -->
	
	<!--   交易資料 -->	
	<div id="tab1" class="tab_content">
      <table class="form14">     <!-- 表格 -->
	  <tr>
	   <td class="normal14a"  width="8%">部門代號：</td>
       <td class="normal14a"  width="24%" ><input type="text" tabIndex="10" onKeyPress="keyFunction()" id="cmsi05"  name="cmsi05"  onchange="startcmsi05(this)"    value="<?php echo  $tc005; ?>"   size="12"   />
	   <a href="javascript:;"><img id="Showcmsi05disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
	   <span id="cmsi05disp" > <?php    echo $tc005disp; ?> </span></td>
	   <td class="normal14a"  width="8%">業務人員：</td>  <!-- onchange="startcmsi09(this)"     -->
        <td class="normal14a"  width="26%" ><input tabIndex="6" id="cmsi09" onKeyPress="keyFunction()" name="cmsi09" onchange="check_cmsi09(this)"  value="<?php echo $tc006; ?>"  type="text"  size="12"  />
		<a href="javascript:;"><img id="Showcmsi09disp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
        <span id="cmsi09disp"> <?php    echo $tc006disp; ?> </span></td>
	   <td class="normal14a"  width="8%">廠別：</td>   <!-- onchange="startcmsi02(this)"  onchange="check_cmsi02(this)"   -->
       <td class="normal14a"  width="26%" ><input type="text" tabIndex="10" onKeyPress="keyFunction()" id="cmsi02"  onchange="check_cmsi02(this)" name="cmsi02"   value="<?php echo  $tc007; ?>"   size="12"   />
	   <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	   <span id="cmsi02disp"> <?php    echo $tc007disp; ?> </span></td>
	 </tr>	
	  
	  <tr>
	  <td class="normal14a"  >幣別：</td>
        <td class="normal14" ><input tabIndex="11" id="cmsi06" onKeyPress="keyFunction()" name="cmsi06" onchange="check_cmsi02(this)"  value="<?php echo $tc008; ?>"  type="text"   size="12" />
		<a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $tc008disp; ?> </span></td>
	   <td class="normal14" >匯率：</td>		
        <td class="normal14"  ><input type="text" id="tc009"   tabIndex="12"   onKeyPress="keyFunction()"    name="tc009" value="<?php echo $tc009; ?>"  size="12" /></td>
	    <td class="normal14" >客戶單號：</td>		
        <td class="normal14"  ><input type="text" id="tc012"   tabIndex="13"   onKeyPress="keyFunction()"    name="tc012" value="<?php echo $tc012; ?>"  size="12" /></td>
	  </tr>
	    <tr>
		<td class="normal14" >價格條件：</td>		
        <td class="normal14"  ><input type="text" id="tc013"   tabIndex="14"   onKeyPress="keyFunction()"    name="tc013" value="<?php echo $tc013; ?>"  size="12" /></td>
	   <td  class="normal14a" >付款條件：</td>
        <td  class="normal14"  ><input tabIndex="15" id="cmsi21" onKeyPress="keyFunction()" name="cmsi21" onchange="check_cmsi02(this)"   value="<?php echo  $tc014; ?>"   size="12"   type="text"  />
		<a href="javascript:;"><img id="Showcmsi21disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="cmsi21disp"> <?php    echo $tc014disp; ?> </span></td>
	    <td class="normal14" >營業稅率：</td>		
        <td class="normal14"  ><input type="text" id="tc041"   tabIndex="16"   onKeyPress="keyFunction()"    name="tc041" value="<?php echo $tc041; ?>"  size="12" /></td>
	  </tr>
	  
	   <tr>
	    <td class="normal14" >訂金比率：</td>		
        <td class="normal14"  ><input type="text" id="tc045"   tabIndex="17"   onKeyPress="keyFunction()"    name="tc045" value="<?php echo $tc045; ?>"  size="12" /></td>
	   <td class="normal14"  >課稅別：</td>
        <td class="normal14" ><select id="tc016" onKeyPress="keyFunction()" name="tc016" onChange="seltax(this)" tabIndex="18">
		    <option <?php if($tc016 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php if($tc016 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php if($tc016 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php if($tc016 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php if($tc016 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select></td>
	    <td class="normal14" >列印：</td>
        <td class="normal14"  ><input type="text"  readonly="value" tabIndex="19"   onKeyPress="keyFunction()"   name="tc028" value="<?php echo $tc028; ?>" style="background-color:#F0F0F0"  size="12" /></td>
	  </tr>
		
	  <tr>
	     <td class="normal14">簽核狀態：</td>
        <td  class="normal14"  ><select id="tc048" tabIndex="21" readonly="value" onKeyPress="keyFunction()" name="tc048"   style="background-color:#F0F0F0" >
            <option <?php if($tc048 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tc048 == '0') echo 'selected="selected"';?> value='0'>0.待處理</option>
            <option <?php if($tc048 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tc048 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tc048 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tc048 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tc048 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tc048 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>		   
	    <td  class="start14a"></td>		
        <td  class="start14"  ></td>
		 <td  class="start14a"></td>		
        <td  class="start14"  ></td>
	  </tr>
	</table>
	</div>
	
	<!--  地址 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	  <?php
	  
	  ?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	   <td class="normal14a"  width="10%">送貨地址(1)：</td>
       <td class="normal14a"  width="70%" ><input type="text" tabIndex="22"   onKeyPress="keyFunction()" id="tc010" name="tc010" size="120"  value="<?php echo $tc010; ?>"   />
	   <td class="normal14a"  width="10%" ></td>
       <td class="normal14a"  width="10%" ></td>
	 </tr>			  
	 
	  <tr>
	    <td class="normal14">送貨地址(2)：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="23"   onKeyPress="keyFunction()" id="tc011" name="tc011"  size="120"   value="<?php echo $tc011; ?>"    /></td>
		<td class="normal14" ></td>						
        <td  class="normal14"  ></td>
	  </tr>	
	   <tr>
	    <td class="normal14">備註：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="24"   onKeyPress="keyFunction()" id="tc015" name="tc015"  size="120"   value="<?php echo $tc015; ?>"    /></td>
	    <td class="normal14" ></td>						
        <td  class="normal14"  ></td>
	  </tr>	
	 
	</table>
 
	</div> 	
	
	
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
					//if(isset($val['style'])){
					//	echo "style='".$val['style']."' ";}
					echo " >";
					echo $val['name'];
					echo "</td>";
				}?>
            </tr>
        </thead>
      
    <!--   明細0  --> <?php $current_product_count = 0; //依照資料庫紀錄的明細先列一遍 ?>
			<?php foreach($body_data as $key => $val){
				$current_product_count++;
				echo "<tbody id='product_row_".$current_product_count."' class='product_row' >";
				echo "<tr>";
				echo "<td class='center'><img src='".base_url()."assets/image/delete2.png' title='刪除資料' onclick='del_detail(\"".$val->td001."\",\"".$val->td002."\",\"".$val->td003."\",\"".$current_product_count."\");' /></td>";
				foreach($usecol_array as $k => $v){
					if(isset($v['type'])){$type = $v['type'];}else{$type = "text";}
					
					echo "<td ";
					if(isset($v['data_class'])){echo "class='".$v['data_class']."'";}
					echo ">";
					
					if($type == "text"){
						echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".$val->$k."' onKeyPress='keyFunction()' ";
						if(isset($v['size'])){echo "size='".$v['size']."' ";}
						if(isset($v['id'])){echo "id='".$v['id']."' ";}
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
					if($type == "checkbox"){
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".$val->$k."' onKeyPress='keyFunction()' ";
									echo " />";
								}
					echo "</td>";
				}
				
				
				
				
				echo "</tr>";
				echo "</tbody>";
			}?>
			   <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
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
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span></span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　訂單金額：</b></td>
				<td ><input type='text' readonly="value" name='tc029' id="tc019" size="8" value="<?php echo $tc029; ?>"  style="background-color:#F0F0F0" /></td>
			
				<td class="right" valign="top"><b style="color: #003A88;">　　稅額：</b></td>
				<td ><input type='text' readonly="value" name='tc030' id="tc030" size="8" value="<?php echo $tc030; ?>"  style="background-color:#F0F0F0" /></td>
			
				<td class="right" valign="top"><b style="color: #003A88;">　　合計金額：</b></td>
			<!--	<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot"></span></b></td> -->
				<td ><input type='text' readonly="value"  size="8" value="<?php echo $tc029+$tc030; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總數量：</b></td>
				<td ><input type='text' readonly="value" name='tc031' id="tc031" size="8" value="<?php echo $tc031; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總毛重：</b></td>
				<td ><input type='text' readonly="value" name='tc043' id="tc043" size="8" value="<?php echo $tc043; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總材積：</b></td>
				<td ><input type='text' readonly="value" name='tc044' id="tc044" size="8" value="<?php echo $tc044; ?>"  style="background-color:#F0F0F0" /></td>
				<td style="display:none;"><input id="select_rows" />
				<td class="left" valign="top"></td>
				
              </tr>
		<!-- 合計     -->	
	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cop/copi06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  <a  accesskey="a" onKeyPress="keyFunction()" onclick="addItem();" </a>
	  </div> 
	  </div> <!-- div-加 -->
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

 
    </div> <!-- div-3 --> 
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
<form action="<?php echo base_url()?>index.php/cop/copi06/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
<?php // include_once("./application/views/fun/copi06_funjsupd_v.php"); ?> 
<?php //  include_once("./application/views/funnew/erp_funjs_v.php"); ?>
<?php  include_once("./application/views/funnew/copi03_funmjs_v.php"); ?> <!-- 訂單單別 -->
<?php  include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?>  <!-- 人員 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/copi01_funmjs_v.php"); ?>  <!-- 客戶 -->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?>  <!-- 部門 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->
<?php  include_once("./application/views/funnew/cmsi21_funmjs_v.php"); ?>  <!-- 付款條件 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/copi06_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 