 <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'tg003' || $key == 'tg008' || $key == 'tg009' || $key == 'tg011' || $key == 'tg012' || $key == 'tg015' || $key == 'tg016' || $key == 'tg027'){
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
   <!--   <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div> -->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?> 
    </div>

<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 報關/贖單資料建立作業 - 查看</h1>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ips/ipsi05/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="tab-general"> <!-- div-6 -->
      
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="10%"><span class="required">報關單別：</span></td>   <!--onchange="startipsi06(this);check_title_no();"    -->
        <td class="normal14a"  width="24%"><input tabIndex="1" id="ipsi06"  ondblclick="search_ipsi06_window()"  onKeyPress="keyFunction()"   name="tg001" onfocus="check_title_no();selverify();" onchange="check_ipsi06(this);check_title_no();"  value="<?php echo $tg001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showipsi06disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="ipsi06disp"> <?php    echo $tg001disp; ?> </span></td>
	    <td class="normal14a" width="8%" >報關日期： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tg003" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tg003"  value="<?php echo $tg003; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tg003,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	    <td class="start14a" width="10%"><span class="required">報關單號：</span></td>
        <td class="normal14a" width="23%"><input tabIndex="3" id="tg002" onKeyPress="keyFunction()"  name="tg002" onfocus="check_title_no();" value="<?php echo $tg002; ?>" size="12" type="text" required /></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a">廠商代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="puri01" onKeyPress="keyFunction()" ondblclick="search_puri01_window()"  onchange="check_puri01(this)" name="tg006" value="<?php echo $tg006; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showpuri01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="puri01disp"> <?php   echo $tg006disp; ?> </span></td>
	    <td class="normal14">報單單號：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5"   onKeyPress="keyFunction()" id="tg004" name="tg004"   value="<?php echo $tg004; ?>"  size="12" /></td>
	    <td class="normal14">廠別代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="cmsi02" onKeyPress="keyFunction()" ondblclick="search_cmsi02_window()"  onchange="check_cmsi02(this)" name="tg005" value="<?php echo $tg005; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="cmsi02disp"> <?php   echo $tg005disp; ?> </span></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14">確認日期：</td>
        <td class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tg041" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tg041"  value="<?php echo $tg041; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tg041,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
        <td class="normal14">確認碼：</td>
        <td  class="normal14"  ><select id="verify" onKeyPress="keyFunction()" name="tg037" onChange="selverify(this)" tabIndex="8">
            <option <?php if($tg037 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tg037 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tg037 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>
	     <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="9" readonly="value"  onKeyPress="keyFunction()" id="tg042" name="tg042"   value="<?php echo $tg042; ?>" style="background-color:#F0F0F0" size="12" /></td>
	    
	</table>
	
	<div class="abgne_tab"> <!-- div-6 頁標籤 -->
		<ul class="tabs">
		  <li><a href="#tab1"  accesskey="a">提單資料a</a></li>
		  <li><a href="#tab2"  accesskey="b">贖單資料b</a></li>
		  <li><a href="#tab3"  accesskey="i">費用資料i</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  交易資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	  
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="10%">提單單號：</td>
        <td class="normal14a"  width="40%" ><input type="text" tabIndex="12"  onKeyPress="keyFunction()" id="tg007"   name="tg007"   value="<?php echo  $tg007; ?>"   size="20"   />
	    </td>
	    <td class="normal14a"  width="10%">INVOICE NO：</td>   <!-- onchange="startcmsi02(this)"  onchange="check_cmsi02(this)"   -->
        <td class="normal14a"  width="40%" ><input type="text" tabIndex="12"  onKeyPress="keyFunction()" id="tg008"   name="tg008"   value="<?php echo  $tg008; ?>"   size="20"   />
	      </td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14a"  >提單日期：</td>
        <td class="normal14" ><input tabIndex="14"  ondblclick="scwShow(this,event);"   id="tg008" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tg008"  value="<?php echo $tg008; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tg008,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td><td class="normal14" >到港日期：</td>		
        <td class="normal14"  ><input tabIndex="14"  ondblclick="scwShow(this,event);"   id="tg009" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tg009"  value="<?php echo $tg009; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tg009,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>	
	  </tr>
	  <tr>
	    <td class="normal14a"  >E.T.D：</td>
        <td class="normal14" ><input tabIndex="14"  ondblclick="scwShow(this,event);"   id="tg011" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tg011"  value="<?php echo $tg011; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tg011,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td><td class="normal14" >T.T.A：</td>		
        <td class="normal14"  ><input tabIndex="14"  ondblclick="scwShow(this,event);"   id="tg012" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tg012"  value="<?php echo $tg012; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tg012,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>	
	  </tr>
	   <tr>
	    <td class="normal14a"  >船公司：</td>
        <td class="normal14a"   ><input type="text" tabIndex="12"  onKeyPress="keyFunction()" id="tg013"   name="tg013"   value="<?php echo  $tg013; ?>"   size="12"   /></td>
	    
	    <td class="normal14a" >貨櫃場：</td>   <!-- onchange="startcmsi02(this)"  onchange="check_cmsi02(this)"   -->
        <td class="normal14a"  ><input type="text" tabIndex="12"  onKeyPress="keyFunction()" id="tg014"   name="tg014"   value="<?php echo  $tg014; ?>"   size="12"   />
	      </td>
	  </tr>	
	   <tr>
	    <td class="normal14a"  >倉租日期：</td>
        <td class="normal14a"   ><input tabIndex="16"  ondblclick="scwShow(this,event);"   id="tg015" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tg015"  value="<?php echo $tg015; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tg015,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	    <td class="normal14a" >備註：</td>   <!-- onchange="startcmsi02(this)"  onchange="check_cmsi02(this)"   -->
        <td class="normal14a"  ><input type="text" tabIndex="12"  onKeyPress="keyFunction()" id="tg038"   name="tg038"   value="<?php echo  $tg038; ?>"   size="12"   />
	      </td>
	  </tr>	
	  <tr>	   
	    <td class="normal14" >更新碼：</td>
        <td class="normal14"  ><input type="hidden" name="tg036" value="N" />
		<input tabIndex="12" type="checkbox"  id="tg036" onKeyPress="keyFunction()"   name="tg036" <?php if($tg036 == 'Y' ) echo 'checked'; ?>  <?php if($tg036 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
		<td class="normal14" >列印次數：</td>
        <td class="normal14"  ><input type="text"   tabIndex="19"   onKeyPress="keyFunction()"   name="tg039" value="<?php echo $tg039; ?>" style="background-color:#F0F0F0" size="12"   /></td>
	    
	  </tr>
	</table>
	</div>
	
	<!--  贖單 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	    
	 <tr>
	    <td class="normal14a" width="9%" >幣別：</td>
        <td class="normal14a" width="41%" ><input tabIndex="20" id="cmsi06" ondblclick="search_cmsi06_window()" onKeyPress="keyFunction()" name="tg017" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $tg017; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $tg017disp; ?> </span></td>
	    <td class="normal14a" width="9%">匯率：</td>		
        <td class="normal14a" width="41%" ><input type="text" id="exchange_rate"   tabIndex="21"   onKeyPress="keyFunction()"    name="tg018" value="<?php echo $tg018; ?>"  size="12" /></td>
	      </tr>
	  <tr>
	    <td class="normal14">押匯日期：</td>						
        <td class="normal14" ><input tabIndex="16"  ondblclick="scwShow(this,event);"   id="tg016" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tg016"  value="<?php echo $tg016; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tg016,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		<td class="normal14" >遠期天數：</td>						
        <td class="normal14" ><input type="text" tabIndex="23"   onKeyPress="keyFunction()" id="tg025" name="tg025"     value="<?php echo $tg025; ?>"    /></td>
	  </tr>	
	  <tr>
	    <td class="normal14" >年利率：</td>						
        <td class="normal14" ><input type="text" tabIndex="23"   onKeyPress="keyFunction()" id="tg026" name="tg026"     value="<?php echo $tg026; ?>"    /></td>
	 
	    <td class="normal14">應還款日：</td>						
        <td class="normal14" ><input tabIndex="16"  ondblclick="scwShow(this,event);"   id="tg027" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tg027"  value="<?php echo $tg027; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tg027,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		 </tr>	
	  <tr>
	    <td class="normal14">原幣贖單額：</td>						
        <td class="normal14" ><input type="text" tabIndex="22"   onKeyPress="keyFunction()" id="tg019" name="tg019"     value="<?php echo $tg019; ?>"    />
           </td>
		<td class="normal14" >本幣贖單額：</td>						
        <td class="normal14" ><input type="text" tabIndex="23"   onKeyPress="keyFunction()" id="tg020" name="tg020"     value="<?php echo $tg020; ?>"    /></td>
	  </tr>	
	  <tr>
	    <td class="normal14">原幣沖自籌額：</td>						
        <td class="normal14" ><input type="text" tabIndex="24" readonly="readonly"  onKeyPress="keyFunction()" id="tg021" name="tg021"     value="<?php echo $tg021; ?>"  style="background-color:#F0F0F0"  />
           </td>
		<td class="normal14" >本幣沖自籌額：</td>						
        <td class="normal14" ><input type="text" tabIndex="25" readonly="readonly"  onKeyPress="keyFunction()" id="tg022" name="tg022"     value="<?php echo $tg022; ?>"  style="background-color:#F0F0F0"  /></td>
	  </tr>	
	   <tr>
	    <td class="normal14">原幣應還款額：</td>						
        <td class="normal14" ><input type="text" tabIndex="26" readonly="readonly"  onKeyPress="keyFunction()" id="tg023" name="tg023"     value="<?php echo $tg023; ?>"  style="background-color:#F0F0F0"  />
           </td>
		<td class="normal14" >本幣應還款額：</td>						
        <td class="normal14" ><input type="text" tabIndex="27" readonly="readonly"  onKeyPress="keyFunction()" id="tg024" name="tg024"     value="<?php echo $tg024; ?>"  style="background-color:#F0F0F0"  /></td>
	  </tr>	
	    
	   
	</table>
 
	</div> 	
	<!--  費用 -->
	<div id="tab3" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="8%">S/I單號：</td>
        <td class="normal14a"  width="42%" ><input type="text" tabIndex="30"   onKeyPress="keyFunction()" id="tg028" name="tg028"   value="<?php echo $tg028; ?>"   />
	    <td class="normal14a"  width="8%" >L/C費用合計：</td>
        <td class="normal14a"  width="42%" ><input type="text" tabIndex="31"   onKeyPress="keyFunction()" id="tg029" name="tg029"     value="<?php echo $tg029; ?>"  style="background-color:#F0F0F0"   /></td>
	  </tr>			  
	 <tr>
	    <td class="normal14">B/L費用總額：</td>						
        <td class="normal14" ><input type="text" tabIndex="32"   onKeyPress="keyFunction()" id="tg030" name="tg030"     value="<?php echo $tg030; ?>" style="background-color:#F0F0F0"    />
           </td>
		<td class="normal14" >B/L成本合計：</td>						
        <td class="normal14" ><input type="text" tabIndex="33"   onKeyPress="keyFunction()" id="tg032" name="tg032"     value="<?php echo $tg032; ?>"  style="background-color:#F0F0F0"   /></td>
	  </tr>	
	  <tr>
	    <td class="normal14">關稅合計：</td>						
        <td class="normal14" ><input type="text" tabIndex="34"   onKeyPress="keyFunction()" id="tg040" name="tg040"     value="<?php echo $tg040; ?>" style="background-color:#F0F0F0"   />
           </td>
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
				echo "<td class='center'><img src='".base_url()."assets/image/delete.png' title='刪除資料' onclick='del_detail(\"".$val->ti001."\",\"".$val->ti002."\",\"".$val->ti003."\",\"".$current_product_count."\");' /></td>";
				foreach($usecol_array as $k => $v){
					if($k=="ti013" ){
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
		     
		<!-- 合計     -->	
	<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ips/ipsi05/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	    <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('ips/ipsi05/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('ips/ipsi05/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
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