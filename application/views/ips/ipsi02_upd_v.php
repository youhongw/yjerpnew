 <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'ta003' || $key == 'ta070'){
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
  $stax_rate = $this->session->userdata('sysma004');
  $sysma200 = $this->session->userdata('sysma200');
?>
 <div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 預付購料建立作業 - 修改</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ips/ipsi02/updsave" method="post" enctype="multipart/form-data" >
	<div id="tab-general"> <!-- div-6 -->
	
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="10%"><span class="required">預付購料單別：</span></td>   <!--onchange="startipsi06(this);check_title_no();"    -->
        <td class="normal14a"  width="24%"><input tabIndex="1" id="ipsi06"  ondblclick="search_ipsi06_window()"  onKeyPress="keyFunction()"   name="ta001" onfocus="selverify();" onchange="check_ipsi06(this);"  value="<?php echo $ta001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showipsi06disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="ipsi06disp"> <?php    echo $ta001disp; ?> </span></td>
	    <td class="normal14a" width="8%" >開狀日期： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta008" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta008"  value="<?php echo $ta008; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(ta008,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	    <td class="start14a" width="10%"><span class="required">預付購料單號：</span></td>
        <td class="normal14a" width="23%"><input tabIndex="3" id="ta002" onKeyPress="keyFunction()"  name="ta002" onfocus="" value="<?php echo $ta002; ?>" size="12" type="text" required /></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a">廠商代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="puri01" onKeyPress="keyFunction()" ondblclick="search_puri01_window()"  onchange="check_puri01(this)" name="ta005" value="<?php echo $ta005; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showpuri01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="puri01disp"> <?php   echo $ta005disp; ?> </span></td>
	    <td class="normal14">L/C單號：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5"   onKeyPress="keyFunction()" id="ta021" name="ta021"   value="<?php echo $ta021; ?>"  size="12" /></td>
	    <td class="normal14">單據日期：</td>
        <td  class="normal14"  ><input type="text" tabIndex="6" readonly="value"  onKeyPress="keyFunction()" id="ta045" name="ta045"   value="<?php echo $ta045; ?>" size="12"  style="background-color:#F0F0F0"/></td>
	    
	  </tr>
	  
	  <tr>
	    <td class="normal14">簽核狀態：</td>
        <td class="normal14"  ><select id="ta044" tabIndex="7" readonly="value" onKeyPress="keyFunction()" name="ta044"   style="background-color:#F0F0F0" >
            <option <?php if($ta044 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($ta044 == '0') echo 'selected="selected"';?> value='0'>0.待處理</option>
            <option <?php if($ta044 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($ta044 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($ta044 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($ta044 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($ta044 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($ta044 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
        <td class="normal14">確認碼：</td>
        <td  class="normal14"  ><select id="verify" onKeyPress="keyFunction()" name="ta034" onChange="selverify(this)" tabIndex="8">
            <option <?php if($ta034 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($ta034 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($ta034 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>
	     <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="9" readonly="value"  onKeyPress="keyFunction()" id="ta043" name="ta043"   value="<?php echo $ta043; ?>" style="background-color:#F0F0F0" size="12" /></td>
	    
	</table>
	
	<div class="abgne_tab"> <!-- div-6 頁標籤 -->
		<ul class="tabs">
		  <li><a href="#tab1"  accesskey="a">銀行資料a</a></li>
		  <li><a href="#tab2"  accesskey="b">金額資料b</a></li>
		  <li><a href="#tab3"  accesskey="i">費用資料i</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  交易資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	  
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="9%">開狀銀行：</td>
        <td class="normal14a"  width="25%" ><input type="text" tabIndex="10" ondblclick="search_noti01_window()" onKeyPress="keyFunction()" id="noti01"  name="ta006"  onblur="check_noti01(this)"    value="<?php echo  $ta006; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Shownoti01disp" src="<?php echo base_url()?>assets/image/png/bank.png" alt="" align="top"/></a>
	      <span id="noti01disp" > <?php    echo $ta006disp; ?> </span></td>
	    <td class="normal14a"  width="9%">廠別：</td>  <!-- onchange="startcmsi09(this)"     -->
        <td class="normal14a"  width="25%" ><input type="text" tabIndex="11" ondblclick="search_cmsi02_window()" onKeyPress="keyFunction()" id="cmsi02"  onblur="check_cmsi02(this)" name="ta041"   value="<?php echo  $ta036; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	      <span id="cmsi02disp"> <?php    echo $ta036disp; ?> </span></td>
	    <td class="normal14a"  width="8%">額度別：</td>   <!-- onchange="startcmsi02(this)"  onchange="check_cmsi02(this)"   -->
        <td class="normal14a"  width="24%" ><input type="text" tabIndex="12"  onKeyPress="keyFunction()" id="ta007"   name="ta007"   value="<?php echo  $ta007; ?>"   size="12"   />
	      </td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14a"  >遠期天數：</td>
        <td class="normal14" ><input type="text" id="ta010"   tabIndex="13"   onKeyPress="keyFunction()"    name="ta010" value="<?php echo $ta010; ?>"  size="12" /></td>
	    <td class="normal14" >裝船期限：</td>		
        <td class="normal14"  ><input tabIndex="14"  ondblclick="scwShow(this,event);"   id="ta012" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta012"  value="<?php echo $ta012; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(ta012,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td><td class="normal14" >運送方式：</td>		
        <td class="normal14"  ><input type="text" id="ta013"   tabIndex="15"   onKeyPress="keyFunction()"    name="ta013" value="<?php echo $ta013; ?>"  size="12" /></td>
	  </tr>
	  <tr>
	    <td class="normal14a"  >有效日期：</td>
        <td class="normal14" ><input tabIndex="16"  ondblclick="scwShow(this,event);"   id="ta009" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta009"  value="<?php echo $ta009; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(ta009,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		 <td class="normal14" >E.T.D：</td>		
        <td class="normal14"  ><input tabIndex="17"  ondblclick="scwShow(this,event);"   id="ta014" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta014"  value="<?php echo $ta014; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(ta014,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td><td class="normal14" >E.T.A：</td>		
        <td class="normal14"  ><input tabIndex="18"  ondblclick="scwShow(this,event);"   id="ta015" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta015"  value="<?php echo $ta015; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(ta015,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		</tr>
	  
	  <tr>	   
	    <td class="normal14" >許可證號：</td>
        <td class="normal14" colspan="1" ><input type="text"   tabIndex="19"   onKeyPress="keyFunction()"   name="ta011" value="<?php echo $ta011; ?>"   size="40" /></td>
	    <td class="normal14" ></td>
        <td class="normal14" colspan="1" ></td>
	    <td class="start14a"></td>		
        <td class="start14"  ></td>
	  </tr>
	</table>
	</div>
	
	<!--  發票 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	    
	 <tr>
	    <td class="normal14a" width="9%" >幣別：</td>
        <td class="normal14a" width="41%" ><input tabIndex="20" id="cmsi06" ondblclick="search_cmsi06_window()" onKeyPress="keyFunction()" name="ta016" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $ta016; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $ta016disp; ?> </span></td>
	    <td class="normal14a" width="9%">匯率：</td>		
        <td class="normal14a" width="41%" ><input type="text" id="exchange_rate"   tabIndex="21"   onKeyPress="keyFunction()"    name="ta017" value="<?php echo $ta017; ?>"  size="12" /></td>
	      </tr>
	  <tr>
	    <td class="normal14">開狀金額：</td>						
        <td class="normal14" ><input type="text" tabIndex="22"   onKeyPress="keyFunction()" id="ta018" name="ta018"     value="<?php echo $ta018; ?>"    />
           </td>
		<td class="normal14" >自籌比率：</td>						
        <td class="normal14" ><input type="text" tabIndex="23"   onKeyPress="keyFunction()" id="ta021" name="ta021"     value="<?php echo $ta021; ?>"    /></td>
	  </tr>	
	  <tr>
	    <td class="normal14">修改金額：</td>						
        <td class="normal14" ><input type="text" tabIndex="24" readonly="readonly"  onKeyPress="keyFunction()" id="ta019" name="ta019"     value="<?php echo $ta019; ?>"  style="background-color:#F0F0F0"  />
           </td>
		<td class="normal14" >總金額：</td>						
        <td class="normal14" ><input type="text" tabIndex="25" readonly="readonly"  onKeyPress="keyFunction()" id="ta01819" name="ta01819"     value="<?php echo $ta018+$ta019; ?>"  style="background-color:#F0F0F0"  /></td>
	  </tr>	
	   <tr>
	    <td class="normal14">原幣自籌額：</td>						
        <td class="normal14" ><input type="text" tabIndex="26" readonly="readonly"  onKeyPress="keyFunction()" id="ta022" name="ta022"     value="<?php echo $ta022; ?>"  style="background-color:#F0F0F0"  />
           </td>
		<td class="normal14" >NT$自籌額：</td>						
        <td class="normal14" ><input type="text" tabIndex="27" readonly="readonly"  onKeyPress="keyFunction()" id="ta023" name="ta023"     value="<?php echo $ta023; ?>"  style="background-color:#F0F0F0"  /></td>
	  </tr>	
	    <tr>
	    <td class="normal14">已攤自籌額：</td>						
        <td class="normal14" ><input type="text" tabIndex="28" readonly="readonly"  onKeyPress="keyFunction()" id="ta035" name="ta035"     value="<?php echo $ta035; ?>"  style="background-color:#F0F0F0"  />
           </td>
		<td class="normal14" >已到貨額：</td>						
        <td class="normal14" ><input type="text" tabIndex="29" readonly="readonly"  onKeyPress="keyFunction()" id="ta020" name="ta020"     value="<?php echo $ta020; ?>"  style="background-color:#F0F0F0"  /></td>
	  </tr>	
	   
	</table>
 
	</div> 	
	<!--  費用 -->
	<div id="tab3" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="8%">手續費：</td>
        <td class="normal14a"  width="42%" ><input type="text" tabIndex="30"   onKeyPress="keyFunction()" id="ta024" name="ta024"   value="<?php echo $ta024; ?>"   />
	    <td class="normal14a"  width="8%" >保險費：</td>
        <td class="normal14a"  width="42%" ><input type="text" tabIndex="31"   onKeyPress="keyFunction()" id="ta025" name="ta025"     value="<?php echo $ta025; ?>"    /></td>
	  </tr>			  
	 <tr>
	    <td class="normal14">簽證費：</td>						
        <td class="normal14" ><input type="text" tabIndex="32"   onKeyPress="keyFunction()" id="ta026" name="ta026"     value="<?php echo $ta026; ?>"    />
           </td>
		<td class="normal14" >郵電費：</td>						
        <td class="normal14" ><input type="text" tabIndex="33"   onKeyPress="keyFunction()" id="ta027" name="ta027"     value="<?php echo $ta027; ?>"    /></td>
	  </tr>	
	  <tr>
	    <td class="normal14">費用合計：</td>						
        <td class="normal14" ><input type="text" tabIndex="34"   onKeyPress="keyFunction()" id="ta033" name="ta033"     value="<?php echo $ta033; ?>"    />
           </td>
		<td class="normal14" >備註：</td>						
        <td class="normal14" ><input type="text" tabIndex="35"   onKeyPress="keyFunction()" id="ta037" name="ta037"     value="<?php echo $ta037; ?>"    /></td>
	  </tr>	
	  <tr>
	    <td class="normal14">已攤費用：</td>						
        <td class="normal14" ><input type="text" tabIndex="36"   onKeyPress="keyFunction()" id="ta034" name="ta034"     value="<?php echo $ta034; ?>"    />
           </td>
		<td class="normal14" >列印：</td>						
        <td class="normal14" ><input type="text" tabIndex="37"   onKeyPress="keyFunction()" id="ta041" name="ta041"     value="<?php echo $ta041; ?>"    /></td>
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
				echo "<td class='center'><img src='".base_url()."assets/image/delete.png' title='刪除資料' onclick='del_detail(\"".$val->tb001."\",\"".$val->tb002."\",\"".$val->tb003."\",\"".$current_product_count."\");' /></td>";
				foreach($usecol_array as $k => $v){
					if($k=="tb013" ){
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
		     
		<!-- 合計     -->	
	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();totalSum();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ips/ipsi02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
	  ?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('ips/ipsi02/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
	  <?php } ?>
	  <?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
	  ?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('ips/ipsi02/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
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
<form action="<?php echo base_url()?>index.php/ips/ipsi02/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
		
<?php  include_once("./application/views/funnew/ipsi06_funmjs_v.php"); ?> <!-- 單別 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/puri01_funmjs_v.php"); ?>  <!-- 廠商 -->
<?php  include_once("./application/views/funnew/noti01_funmjs_v.php"); ?>  <!-- 銀行 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/ipsi02_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 