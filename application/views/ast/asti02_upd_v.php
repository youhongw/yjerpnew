 <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'mb016' || $key == 'mb017' || $key == 'mb028' || $key == 'mb036' || $key == 'mb038' || $key == 'mb047'){
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 資產資料建立作業 - 修改</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ast/asti02/updsave" method="post" enctype="multipart/form-data" >
	<div id="tab-general"> <!-- div-6 -->
	
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="start14a"  width="9%"><span class="required">資產編號：</span></td>
        <td class="normal14a" width="25%"><input tabIndex="1" id="mb001" onKeyPress="keyFunction()" name="mb001" onfocus="" value="<?php echo $mb001; ?>" size="12" type="text" required readonly="value" /></td>
		  
		  
	    <td class="normal14a" width="8%" >資產名稱：</td>  
        <td class="normal14a"  width="25%" ><input tabIndex="2" id="mb002" onKeyPress="keyFunction()"  onchange="" name="mb002"  value="<?php echo $mb002; ?>"  size="12" type="text" /></td>
	    
		<td class="normal14a" width="8%">資產規格：</td>
        <td class="normal14a" width="25%"><input tabIndex="3" id="mb003" onKeyPress="keyFunction()" name="mb003" value="<?php echo $mb003; ?>" size="12" type="text" /></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14">主件編號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="asti02" onKeyPress="keyFunction()"  onchange="check_asti02(this)" name="asti02" value="<?php echo $mb005; ?>" size="12" type="text" />
		<a href="javascript:;"><img id="Showasti02disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="asti02disp"> <?php   echo $mb005disp; ?> </span></td>
	    
		<td class="normal14"></td>
        <td  class="normal14"></td>
		
	    <td class="normal14">資產類別：</td>
        <td  class="normal14"  ><input tabIndex="5" id="asti01" onKeyPress="keyFunction()"  onchange="check_asti01(this)" name="asti01" value="<?php echo $mb006; ?>" size="12" type="text" style="background-color:#FFFFE4" required  />
		<a href="javascript:;"><img id="Showasti01disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="asti01disp"> <?php   echo $mb006disp; ?> </span></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14">型態：</td>
        <td class="normal14" ><select id="mb004" onKeyPress="keyFunction()" name="mb004" onchange="" tabIndex="6">
		    <option <?php if($mb004 == '2') echo 'selected="selected"';?> value='1'>1：主件</option>
            <option <?php if($mb004 == '1') echo 'selected="selected"';?> value='2'>2：附件</option> 			
			</select></td>
        
		<td class="normal14">確認日：</td>
        <td  class="normal14"><input type="text" tabIndex="7" readonly="value"  onKeyPress="keyFunction()" id="mb047" name="mb047"   value="<?php echo $mb047; ?>" size="12"  style="background-color:#F0F0F0"/></td>
        
		<td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="8" readonly="value"  onKeyPress="keyFunction()" id="mb048" name="mb048"  value="<?php echo $mb048; ?>" style="background-color:#F0F0F0" size="12"/></td>
	</table>
	
	
		<div class="abgne_tab"> <!-- div-7 頁標籤-->
		<ul class="tabs">
		  <li><a href="#tab1"  accesskey="a">基本資料a</a></li>
		  <li><a href="#tab2"  accesskey="b">折舊資料b</a></li>
		  <li><a href="#tab3"  accesskey="c">投資抵減c</a></li>
		</ul>
		
    <div class="tab_container"> <!-- div-8 -->
	<!--   基本資料1 -->
	<div id="tab1" class="tab_content">
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="10%">供應廠商：</td>
        <td class="normal14a"  width="24%" ><input type="text" tabIndex="9" onKeyPress="keyFunction()" id="puri01" name="puri01" onchange="check_puri01(this)" value="<?php echo  $mb007; ?>" style="background-color:#FFFFE4" size="12" />
	    <a href="javascript:;"><img id="Showpuri01disp" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
	    
		<td class="normal14a"  width="10%">管理區分：</td>
        <td class="normal14a" width="24%"  ><input type="text" tabIndex="15" id="mb013" onKeyPress="keyFunction()" name="mb013" value="<?php echo $mb013; ?>" size="12" /></td>
	    
		<td class="normal14a" width="10%" ><span >原幣幣別：</span></td>
        <td  class="normal14a" width="23%"  ><input tabIndex="20" id="cmsi06" onKeyPress="keyFunction()"  onchange="check_cmsi06(this)" name="cmsi06" value="<?php echo $mb018; ?>" size="12" type="text" style="background-color:#FFFFE4" required  />
		<a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
        <span id="cmsi06disp"> <?php   echo $mb018disp; ?> </span></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14"><span >供應商簡稱：</span></td>
        <td class="normal14"><input tabIndex="10" id="puri01disp" onKeyPress="keyFunction()" name="puri01disp" value="<?php echo $mb008; ?>" size="12" type="text" /></td>
	    
		<td class="normal14" >耐用月數：</td>		
        <td class="normal14"  ><input type="text" tabIndex="16" onKeyPress="keyFunction()" id="mb014" name="mb014" value="<?php echo $mb014; ?>" size="12"/></td>
	    
		<td class="normal14" >原幣取得成本：</td>		
        <td class="normal14"  ><input type="text" id="mb019" tabIndex="21" onKeyPress="keyFunction()" name="mb019" value="<?php echo $mb019; ?>" size="12"/></td>
	  </tr>
	  
	  <tr>
		<td class="normal14" >製造廠商：</td>		
        <td class="normal14"><input type="text" tabIndex="11" onKeyPress="keyFunction()" id="puri01a"  name="puri01a"  onchange="check_puri01a(this)" value="<?php echo $mb009; ?>" size="12"/>
	    <a href="javascript:;"><img id="Showpuri01adisp" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
		
	    <td class="normal14" >未攤月數：</td>
        <td class="normal14"  ><input type="text" tabIndex="17" onKeyPress="keyFunction()" id="mb015" name="mb015" value="<?php echo $mb015; ?>" size="12"/></td>
		
	    <td class="normal14" ></td>		
        <td class="normal14"  ></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14" >製造商簡稱：</td>		
        <td class="normal14"><input tabIndex="12" id="puri01adisp" onKeyPress="keyFunction()" name="puri01adisp" value="<?php echo $mb010; ?>" size="12" type="text"/></td>
		
	    <td class="normal14"><span >取得日期：</span></td>
        <td class="normal14"><input tabIndex="18"  ondblclick="scwShow(this,event);" id="mb016" onKeyPress="keyFunction()" onchange="dateformat_ymd(this);" name="mb016"  value="<?php echo $mb016; ?>"  size="12" type="text" required style="background-color:#FFFFE4"/>
		<img  onclick="scwShow(mb016,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> </td>
		
	    <td class="normal14" >本幣取得成本：</td>
        <td class="normal14"  ><input type="text" id="mb020" tabIndex="22" onKeyPress="keyFunction()" onchange="book_val();" name="mb020" value="<?php echo $mb020; ?>" size="12"/></td>
	  </tr>
		
	  <tr>
	    <td class="normal14" >單位：</td>
        <td  class="normal14"><input type="text" tabIndex="13" onKeyPress="keyFunction()" id="mb011" name="mb011" value="<?php echo $mb011; ?>" size="12"/></td>
		
		<td class="normal14" >銷帳日期：</td>
        <td class="normal14"><input tabIndex="19"  ondblclick="scwShow(this,event);" id="mb017" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="mb017"  value="<?php echo $mb017; ?>"  size="12" type="text" />
		<img  onclick="scwShow(mb017,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> </td>
		
		<td class="normal14" >本幣改良成本：</td>
        <td class="normal14"  ><input type="text" id="mb021" tabIndex="23" onKeyPress="keyFunction()" onchange="book_val();" name="mb021" value="<?php echo $mb021; ?>" size="12"/></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14" >數量：</td>
        <td class="normal14"  ><input type="text" id="mb012" tabIndex="14" onKeyPress="keyFunction()" name="mb012" value="<?php echo $mb012; ?>" size="12"/></td>
		
		<td class="normal14" >備註：</td>
        <td class="normal14"  ><input type="text" id="mb032" tabIndex="19"   onKeyPress="keyFunction()" name="mb032" value="<?php echo $mb032; ?>" size="48"/></td>
	 
		<td class="normal14" ></td>		
        <td class="normal14"  ></td>
	 </tr>
	</table>
	</div>    <!--  end 標籤1 -->
	
	<!--  地址 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="11%">折舊方法：</td>
        <td class="normal14a" width="22%"><select id="mb023" onKeyPress="keyFunction()" name="mb023" onchange="" tabIndex="24">
		    <option <?php if($mb023 == '0') echo 'selected="selected"';?> value='0'>0：不提折舊</option>
            <option <?php if($mb023 == '1') echo 'selected="selected"';?> value='1'>1：平均法</option> 			
            <option <?php if($mb023 == '2') echo 'selected="selected"';?> value='2'>2：定率遞減法</option> 			
			</select></td>
			
	    <td class="normal14a"  width="11%">累積折舊：</td>
        <td class="normal14a" width="22%"><input type="text" id="mb029" tabIndex="29" onchange="book_val();" onKeyPress="keyFunction()" name="mb029" value="<?php echo $mb029; ?>" size="12"/></td>
	    
		<td class="normal14a"  width="14%">定率遞減法年折舊額：</td>  
        <td class="normal14a" width="20%"><input type="text" id="mb049" tabIndex="34"   onKeyPress="keyFunction()" name="mb049" value="<?php echo $mb049; ?>" size="12"/></td>
	  </tr>		  
	 
	  <tr>
	    <td class="normal14">折舊分攤方式：</td>						
        <td class="normal14" width="25%"><select id="mb024" onKeyPress="keyFunction()" name="mb024" onchange="" tabIndex="24">
		    <option <?php if($mb024 == '0') echo 'selected="selected"';?> value='0'>0：不分攤</option>
            <option <?php if($mb024 == '1') echo 'selected="selected"';?> value='1'>1：依保管部門</option> 			
            <option <?php if($mb024 == '2') echo 'selected="selected"';?> value='2'>2：依固定比率</option> 			
			</select></td>
			
		<td class="normal14">帳面價值：</td>						
        <td class="normal14"><input type="text" id="book_value" tabIndex="30" onKeyPress="keyFunction()" name="book_value" value="" size="12" /></td>
		
		<td class="normal14"></td>						
        <td class="normal14" ></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14">折畢續提：</td>
		<td class="normal14a"><input type="hidden" name="mb025" value="N" />		
        <input tabIndex="25" type="checkbox"  id="mb025" onKeyPress="keyFunction()"   name="mb025" <?php if($mb025 == 'Y' ) echo 'checked'; ?>  <?php if($mb025 !== 'Y' ) echo 'check'; ?> value="Y" size="1"/></td>
		
		<td class="normal14">預留殘值：</td>						
        <td class="normal14"><input type="text" id="mb022" tabIndex="31" onKeyPress="keyFunction()" name="mb022" value="<?php echo $mb022; ?>" size="12"/></td>
		
		<td class="normal14"></td>						
        <td class="normal14" ></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14">續提耐用月數：</td>						
        <td class="normal14"  ><input type="text" id="mb026" tabIndex="26"   onKeyPress="keyFunction()" name="mb026" value="<?php echo $mb026; ?>" size="12"/></td>
		
		<td class="normal14">資產科目：</td>
        <td  class="normal14"><input tabIndex="32" id="acti03" onKeyPress="keyFunction()"  onchange="check_acti03(this)" name="acti03" value="<?php echo $mb030; ?>" size="12" type="text" />
		<a href="javascript:;"><img id="Showacti03disp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
        <span id="acti03disp"><?php echo $mb030disp;?></span></td>
		
		<td class="normal14"></td>						
        <td class="normal14" ></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14">續提未攤月數：</td>						
        <td class="normal14"  ><input type="text" id="mb041" tabIndex="27"   onKeyPress="keyFunction()" name="mb041" value="<?php echo $mb041; ?>" size="12"/></td>
		
		<td class="normal14"></td>						
        <td class="normal14" ></td>		
		
		<td class="normal14"></td>						
        <td class="normal14" ></td>
	  </tr>
	  
	  
	  <tr>
	    <td class="normal14">殘值：</td>						
        <td class="normal14"><input type="text" id="mb027" tabIndex="28"   onKeyPress="keyFunction()" name="mb027" value="<?php echo $mb027; ?>" size="12"/></td>
		
		<td class="normal14">累計折舊科目：</td>						
        <td  class="normal14"><input tabIndex="33" id="acti03a" onKeyPress="keyFunction()"  onchange="check_acti03a(this)" name="acti03a" value="<?php echo $mb031; ?>" size="12" type="text"/>
		<a href="javascript:;"><img id="Showacti03adisp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
        <span id="acti03adisp"><?php echo $mb031disp;?></span></td>
		
		<td class="normal14">開始提列</td>						
        <td class="normal14"><input tabIndex="35"  ondblclick="scwShow(this,event);" id="mb028" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="mb028"  value="<?php echo $mb028; ?>"  size="12" type="text" />
		<img  onclick="scwShow(mb028,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> </td>
	  </tr>
	</table>
	</div> 	<!--  end 標籤2 -->
	
		<!--  投資抵減 標籤 -->
	<div id="tab3" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a" width="15%">投資抵減：</td>						
        <td class="normal14a" width="85%"><select id="mb033" tabIndex="36" onKeyPress="keyFunction()" name="mb033" onchange="" tabIndex="24">
		    <option <?php if($mb033 == '1') echo 'selected="selected"';?> value='1'>1：未投抵</option>
            <option <?php if($mb033 == '2') echo 'selected="selected"';?> value='2'>2：已投抵</option> 			
            <option <?php if($mb033 == '3') echo 'selected="selected"';?> value='3'>3：不能投抵</option> 			
			</select></td>
	  </tr>		  
	 
	  <tr>
	    <td class="normal14" >抵減率：</td>						
        <td class="normal14"><input type="text" id="mb034" tabIndex="37"   onKeyPress="keyFunction()" name="mb034" value="<?php echo $mb034; ?>" size="12"/></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14">主管機關核准文號：</td>						
        <td class="normal14"><input type="text" id="mb035" tabIndex="38"   onKeyPress="keyFunction()" name="mb035" value="<?php echo $mb035; ?>" size="30"/></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14">主管機關核准日期：</td>						
        <td class="normal14"><input tabIndex="39"  ondblclick="scwShow(this,event);" id="mb036" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="mb036"  value="<?php echo $mb036; ?>"  size="12" type="text" style="background-color:#FFFFE4"/>
		<img  onclick="scwShow(mb036,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> </td>
	  </tr>
	  
	  <tr>
	    <td class="normal14">國稅局核准文號：</td>						
        <td class="normal14"><input type="text" id="mb037" tabIndex="40"   onKeyPress="keyFunction()" name="mb037" value="<?php echo $mb037; ?>" size="30"/></td>
	  </tr>
	  
	  
	  <tr>
	    <td class="normal14">國稅局核准日期：</td>						
        <td class="normal14"><input tabIndex="41"  ondblclick="scwShow(this,event);" id="mb038" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="mb038"  value="<?php echo $mb038; ?>"  size="12" type="text" style="background-color:#FFFFE4"/>
		<img  onclick="scwShow(mb038,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> </td>
	  </tr>
	  
	  <tr>
	    <td class="normal14">投抵備註：</td>						
        <td class="normal14"><input type="text" id="mb040" tabIndex="42"   onKeyPress="keyFunction()" name="mb040" value="<?php echo $mb040; ?>" size="24"/></td>
	  </tr>
	</table>
	</div> 
	</div> <!-- </div>div-8 -->
	</div> <!--</div>  div-7 -->
	
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
				echo "<td class='center'><img src='".base_url()."assets/image/delete2.png' title='刪除資料' onclick='del_detail(\"".$val->cmsi05."\",\"".$val->cmsi05_me002."\",\"".$val->cmsi09_asti02."\",\"".$current_product_count."\");' /></td>";
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
					if(isset($v['align'])){echo "align='".$v['align']."'";}
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
             <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem()" /></td>
			  <td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
            </tr>
			  
            </tfoot>
          </table>
        </div>
	 </div>

	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="totalSum();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ast/asti02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
	  ?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('ast/asti02/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
	  <?php } ?>
	  <?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
	  ?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('ast/asti02/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
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
<form action="<?php echo base_url()?>index.php/ast/asti02/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
		
<?php  include_once("./application/views/funnew/asti01_funmjs_v.php"); ?> <!-- 資產類別 -->
<?php  include_once("./application/views/funnew/asti02_funmjs_v.php"); ?> <!-- 主件編號 -->
<?php  include_once("./application/views/funnew/puri01_funmjs_v.php"); ?> <!-- 供應廠商 -->
<?php  include_once("./application/views/funnew/puri01a_funmjs_v.php"); ?> <!-- 製造廠商 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?> <!-- 幣別 -->
<?php  include_once("./application/views/funnew/acti03_funmjs_v.php"); ?> <!-- 資產科目 -->
<?php  include_once("./application/views/funnew/acti03a_funmjs_v.php"); ?> <!-- 累計折舊科目 -->

<!--單身-->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?> <!-- 部門代號 -->
<?php  include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?> <!-- 保管人 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/asti02_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 

<script>
$(document).ready(function(){
	$('#book_value').val("<?php echo ($mb020 + $mb021 - $mb029); ?>");
})

function book_val(){
	var temp_mb020 = Number($('#mb020').val());
	var temp_mb021 = Number($('#mb021').val());
	var temp_mb029 = Number($('#mb029').val());
	
	book_value = temp_mb020 + temp_mb021 - temp_mb029;
	
	$('#book_value').val(book_value);
}
</script>
