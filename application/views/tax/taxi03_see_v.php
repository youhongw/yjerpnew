 <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'mc007' ){
		$$key = stringtodate("Y/m/d",$val);   //自訂函數 main_head_v
	}
	if($key == 'mc002' ){
		$$key = stringtodate("Y/m",$val);   //自訂函數 main_head_v
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
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?> 
    </div>

<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 進銷項發票建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('tax/taxi03/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	
	    <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('tax/taxi03/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('tax/taxi03/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>
	  </div>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/tax/taxi03/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="tab-general"> <!-- div-6 -->
      
	<table class="form14"  >     <!-- 頭部表格 -->
	    <tr>
	    <td class="normal14y"  width="9%"><span class="required">申報公司：</span></td>   <!--onchange="startcopi03(this);check_title_no();"    -->
        <td class="normal14a"  width="25%"><input tabIndex="1" id="cmsi11"  readonly="value"  onKeyPress="keyFunction()"   name="mc001"  onchange="check_cmsi11(this);"  value="<?php echo $mc001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showcmsi11disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="cmsi11disp"> <?php    echo $mc001disp; ?> </span></td>
	    <td class="normal14y" width="8%" >申報期別： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" >
	    <input tabIndex="3" id="mc002" class="date-picker" onChange="dateformat_ym(this)" readonly="value" onKeyPress="keyFunction()"    type="text" name="mc002"  value="<?php echo $mc002; ?>"  size="16" style="background-color:#E7EFEF" /><span >  </span>
		<td class="normal14y" width="8%"><span class="required">流水號：</span></td>
        <td class="normal14a" width="25%"><input tabIndex="3" id="mc006" onKeyPress="keyFunction()" readonly="value" name="mc006"  value="<?php echo $mc006; ?>" size="16" type="text" required /></td>
	  </tr>
	  
	  <tr>	    
	    <td class="normal14z"  >開立日期： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"   ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mc007" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="mc007"  value="<?php echo $mc007; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(mc007,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		<td class="normal14z">發票號碼</td>
        <td  class="normal14"  ><input type="text" tabIndex="5"  onchange="check_length(this)" onKeyPress="keyFunction()" id="mc010" name="mc010"   value="<?php echo $mc010; ?>"   /></td>
	    <td class="normal14z">格式代號</td>
		<td  class="normal14"  ><select  tabIndex="3" id="mc004" onchange="check_vformat()" onKeyPress="keyFunction()"  name="mc004" >
             <option <?php if($mc004 == '21') echo 'selected="selected"';?> value='21'>21:進項三聯式.電子計算機統一發票</option>                                                                      
		     <option <?php if($mc004 == '22') echo 'selected="selected"';?> value='22'>22:進載有稅額之其他憑證(含二聯式收銀機發票)</option>
			 <option <?php if($mc004 == '23') echo 'selected="selected"';?> value='23'>23:三聯式進貨退出或折讓證明單</option>
			 <option <?php if($mc004 == '24') echo 'selected="selected"';?> value='24'>24:二聯式進貨退出或折讓證明單</option>
			 <option <?php if($mc004 == '25') echo 'selected="selected"';?> value='25'>25:進項三聯式收銀機統一發票</option>
			 <option <?php if($mc004 == '26') echo 'selected="selected"';?> value='26'>26:彙總登錄每張稅額伍佰元以下之進項格式21者</option>
			 <option <?php if($mc004 == '27') echo 'selected="selected"';?> value='27'>27:彙總登錄每張稅額伍佰元以下之進項格式22者</option>
			 <option <?php if($mc004 == '28') echo 'selected="selected"';?> value='28'>28:進項海關代徵營業稅納證</option>
			 <option <?php if($mc004 == '31') echo 'selected="selected"';?> value='31'>31:銷項三聯式.電子計算機統一發票</option>
			 <option <?php if($mc004 == '32') echo 'selected="selected"';?> value='32'>32:銷項二聯式.收銀機(二聯式)統一發票</option>
			 <option <?php if($mc004 == '33') echo 'selected="selected"';?> value='33'>33:三聯式銷貨退回或折讓證明單</option>
			 <option <?php if($mc004 == '34') echo 'selected="selected"';?> value='34'>34:二聯式銷貨退回或折讓證明單</option>
			 <option <?php if($mc004 == '35') echo 'selected="selected"';?> value='35'>35:銷項三聯式收銀機統一發票</option>
			 <option <?php if($mc004 == '36') echo 'selected="selected"';?> value='36'>36:銷項免用發票</option>
		  </select></td>
	  </tr>
	  <tr>	
         <td class="normal14z">稅籍編號：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7"   onKeyPress="keyFunction()" id="mc005" name="mc005"   value="<?php echo $mc005; ?>"  style="background-color:#F0F0F0"  /></td>	  
		<td class="normal14z"  >備註：</td>
        <td  class="normal14" colspan="2" ><input type="text" tabIndex="5"   onKeyPress="keyFunction()" id="mc018" name="mc018"   value="<?php echo $mc018; ?>"  size="50" /></td>
	    <td class="normal14"></td>
        <td  class="normal14"  ></td>
	  </tr>
	</table>
	
	<div class="abgne_tab"> <!-- div-6 頁標籤 -->
		<ul class="tabs">
		  <li><a href="#tab1"  accesskey="a">發票明細a</a></li>
		  <li><a href="#tab2"  accesskey="b">零稅率出口文件b</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  發票明細 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	  <?php
	   
	  ?>
   
	<table class="form14">     <!-- 表格 -->
	   <tr>
	    <td class="normal14y"  width="10%">買方統一編號：</td>
        <td class="normal14a"  width="24%" ><input type="text" tabIndex="6" onfocus="check_vformat()"  onKeyPress="keyFunction()" id="mc008" name="mc008"   value="<?php echo $mc008; ?>" size="12"  /></td>	
	    <td class="normal14y"  width="10%">賣方統一編號：</td>  <!-- onchange="startcmsi09(this)"     -->
        <td class="normal14a"  width="24%" ><input type="text" tabIndex="6"  onfocus="check_vformat()" onKeyPress="keyFunction()" id="mc009" name="mc009"   value="<?php echo $mc009; ?>" size="12"  /></td>	
	    <td class="normal14y"  width="10%">課稅別：</td>   <!-- onchange="startcmsi02(this)"  onchange="check_cmsi02(this)"   -->
        <td class="normal14a"  width="23%" ><select  tabIndex="3" id="mc012"  onKeyPress="keyFunction()"  name="mc012" >
             <option <?php if($mc012 == '0') echo 'selected="selected"';?> value='0'>0:應稅內含</option>  
             <option <?php if($mc012 == '1') echo 'selected="selected"';?> value='1'>1:應稅外加</option> 			 
		     <option <?php if($mc012 == '2') echo 'selected="selected"';?> value='2'>2:零稅率</option>
			 <option <?php if($mc012 == '3') echo 'selected="selected"';?> value='3'>3:免稅</option>
			 <option <?php if($mc012 == 'D') echo 'selected="selected"';?> value='D'>D:作廢</option>
		  </select></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14z"  >扣抵代號：</td>
        <td class="normal14" ><select  tabIndex="3" id="mc014" onKeyPress="keyFunction()"  name="mc014" >             
             <option <?php if($mc014 == '1') echo 'selected="selected"';?> value='1'>1:可扣抵:應稅電子發票</option> 			 
		     <option <?php if($mc014 == '2') echo 'selected="selected"';?> value='2'>2:可扣抵:三聯式.電子計算機發票</option>
			 <option <?php if($mc014 == '3') echo 'selected="selected"';?> value='3'>3:可扣抵:三收銀.公用事業發票</option>
			 <option <?php if($mc014 == '4') echo 'selected="selected"';?> value='4'>4:可扣抵:二收銀有稅憑證</option>
			 <option <?php if($mc014 == '5') echo 'selected="selected"';?> value='5'>5:可扣抵:二收銀有稅憑證</option>
			 <option <?php if($mc014 == '6') echo 'selected="selected"';?> value='6'>6:可扣抵:進退折</option>
			 <option <?php if($mc014 == '7') echo 'selected="selected"';?> value='7'>7:可扣抵:海關進口代徵</option>
		     <option <?php if($mc014 == '8') echo 'selected="selected"';?> value='8'>8:可扣抵:海關退溢</option>
			 <option <?php if($mc014 == '9') echo 'selected="selected"';?> value='9'>9:可扣抵:銷退折</option>
			 <option <?php if($mc014 == '10') echo 'selected="selected"';?> value='10'>10:可扣抵:進口貨物勞務</option>
		     <option <?php if($mc014 == '11') echo 'selected="selected"';?> value='11'>11:可扣抵:銷退折</option>
			 <option <?php if($mc014 == '12') echo 'selected="selected"';?> value='12'>12:可扣抵:進貨及費用</option>
			 <option <?php if($mc014 == '13') echo 'selected="selected"';?> value='13'>13:可扣抵:固定資產</option>
			 <option <?php if($mc014 == '14') echo 'selected="selected"';?> value='14'>14:不可扣抵:進貨及費用</option>
			 <option <?php if($mc014 == '15') echo 'selected="selected"';?> value='15'>15:不可扣抵:固定資產</option>
			 <option <?php if($mc014 == '16') echo 'selected="selected"';?> value='16'>16:不可扣抵:不可扣抵應稅.零稅.免稅</option>
			 <option <?php if($mc014 == '17') echo 'selected="selected"';?> value='17'>17:不可扣抵:免用統一發票</option>
			 <option <?php if($mc014 == '18') echo 'selected="selected"';?> value='18'>18:不可扣抵:不需扣繳申報收據</option>
		     <option <?php if($mc014 == '19') echo 'selected="selected"';?> value='19'>19:不可扣抵:需扣繳申報收據</option>
		  </select></td>
	    <td class="normal14z" >銷貨金額：</td>		
        <td class="normal14"  ><input type="text"  tabIndex="12"  id="mc011" onKeyPress="keyFunction()"    name="mc011" value="<?php echo $mc011; ?>"  size="12" /></td>
	    <td class="normal14z" >營業稅額：</td>		
        <td class="normal14"  ><input type="text" id="mc013"   tabIndex="13"   onKeyPress="keyFunction()"    name="mc013" value="<?php echo $mc013; ?>"  size="12" /></td>
	  </tr>
	  
	  <tr>
		<td class="normal14z" >來源單別：</td>		
        <td class="normal14"  ><input type="text"  tabIndex="12"   onKeyPress="keyFunction()"    name="mc020" value="<?php echo $mc020; ?>"  size="12" /></td>
	    <td class="normal14z" >來源單號：</td>		
        <td class="normal14"  ><input type="text" id="mc021"   tabIndex="13"   onKeyPress="keyFunction()"    name="mc021" value="<?php echo $mc021; ?>"  size="12" /></td>
	    <td class="normal14" ></td>		
        <td class="normal14"  ></td>
	  </tr>
	   <tr>
		<td class="normal14z" >彚加註記：</td>		
        <td class="normal14"  ><input type="hidden" name="mc016" value="N" />
		<input tabIndex="12" type="checkbox"  id="mc016" onKeyPress="keyFunction()"   name="mc016" <?php if($mc016 == 'Y' ) echo 'checked'; ?>  <?php if($mc016 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	    <td class="normal14z" >洋菸酒註記：</td>		
        <td class="normal14"  ><input type="hidden" name="mc017" value="N" />
		<input tabIndex="12" type="checkbox"  id="mc017" onKeyPress="keyFunction()"   name="mc017" <?php if($mc017 == 'Y' ) echo 'checked'; ?>  <?php if($mc017 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	    <td class="normal14z" >來源方式：</td>		
        <td class="normal14"  >
		<input type="radio" tabIndex="8" name="mc019" <?php if (isset($mc019) && $mc019=="1") echo "checked";?> value="1" />拋轉&nbsp;&nbsp;&nbsp; 
        <input type="radio" tabIndex="9" name="mc019" <?php if (isset($mc019) && $mc019=="2") echo "checked";?> value="2" />人工
        </td>
	  </tr>
	  
	</table>
	</div>
	
	<!--  零稅率出口文件b  -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	  <?php
	   
	  ?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y"  width="11%">買受人代號：</td>
        <td class="normal14a"  width="23%" ><input tabIndex="4" id="copi01" onKeyPress="keyFunction()"  onchange="check_copi01(this)" name="mc022" value="<?php echo $mc022; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="copi01disp"> <?php   echo $mc022disp; ?> </span></td>
	    <td class="normal14y"  width="11%">買受人簡稱：</td>  <!-- onchange="startcmsi09(this)"     -->
        <td class="normal14a"  width="23%" ><input type="text" tabIndex="6"   onKeyPress="keyFunction()" id="mc023" name="mc023"   value="<?php echo $mc023; ?>" size="12"  /></td>	
	    <td class="normal14y"  width="11%">貨物名稱：</td>   <!-- onchange="startcmsi02(this)"  onchange="check_cmsi02(this)"   -->
        <td class="normal14a"  width="22%" ><input tabIndex="4" id="invi02a" onKeyPress="keyFunction()"  onchange="check_invi02a(this)" name="invi02a" value="<?php echo $mc022; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showinvi02adisp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
          <span id="invi02adisp">  </span></td>
	  </tr>			  
	  <tr>
	    <td class="normal14z"  >數量：</td>
        <td class="normal14"  ><input type="text" tabIndex="6"   onKeyPress="keyFunction()" id="mc025" name="mc025"   value="<?php echo $mc025; ?>" size="12"  /></td>	
	    <td class="normal14z"  >外銷方式：</td>  <!-- onchange="startcmsi09(this)"     -->
        <td class="normal14"  ><input type="text" tabIndex="6"   onKeyPress="keyFunction()" id="mc026" name="mc026"   value="<?php echo $mc026; ?>" size="12"  /></td>	
	    <td class="normal14z"  >證明方式：</td>   <!-- onchange="startcmsi02(this)"  onchange="check_cmsi02(this)"   -->
        <td class="normal14"   ><input type="radio" tabIndex="8" name="mc027" <?php if (isset($mc027) && $mc027=="1") echo "checked";?> value="1" />非經海關&nbsp;&nbsp;&nbsp; 
        <input type="radio" tabIndex="9" name="mc027" <?php if (isset($mc027) && $mc027=="2") echo "checked";?> value="2" />經海關
        </td>
	  </tr>	
      <tr>
	    <td class="normal14z"  >證明文件名稱：</td>
        <td class="normal14"  ><input type="text" tabIndex="6"   onKeyPress="keyFunction()" id="mc028" name="mc028"   value="<?php echo $mc028; ?>" size="12"  /></td>	
	    <td class="normal14z"  >出口報單號碼：</td>  <!-- onchange="startcmsi09(this)"     -->
        <td class="normal14"  ><input type="text" tabIndex="6"   onKeyPress="keyFunction()" id="mc030" name="mc030"   value="<?php echo $mc030; ?>" size="12"  /></td>	
	    <td class="normal14z"  >輸出/結匯日期：</td>   <!-- onchange="startcmsi02(this)"  onchange="check_cmsi02(this)"   -->
        <td class="normal14"   ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mc031" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="mc031"  value="<?php echo $mc031; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(mc031,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td></tr>			  
	  <tr>
	    <td class="normal14z">出口報單類別：</td>						
        <td class="normal14" ><input type="text" tabIndex="23"   onKeyPress="keyFunction()" id="mc029" name="mc029"  size="12"   value="<?php echo $mc029; ?>"    /></td>
		<td class="normal14" ></td>						
        <td class="normal14" ></td>
		<td class="normal14" ></td>						
        <td class="normal14" ></td>
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
				echo "<td class='center'><img src='".base_url()."assets/image/delete.png' title='刪除資料' onclick='del_detail(\"".$val->md001."\",\"".$val->md002."\",\"".$val->md003."\",\"".$current_product_count."\");' /></td>";
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
               
					<input id="select_rows" style="display:none;"/>
				<td class="left" valign="top"></td>
              </tr>
		<!-- 合計     -->	
	<!--<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('tax/taxi03/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	
	    <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('tax/taxi03/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('tax/taxi03/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
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