<?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'ta004' || $key == 'ta005'){
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
  //預設稅率,廠別
  $stax_rate = $this->session->userdata('sysma004');
  $sysma200 = $this->session->userdata('sysma200');
?>
 <div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
       <!--<div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 應付票據資料建立作業 - 修改　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#puri01').focus();" type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();totalSum();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
	  ?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('not/noti03/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
	  <?php } ?>
	  <?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
	  ?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('not/noti03/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
	  <?php } ?>
	  </div>
	  <div style="float:left;padding-top: 5px; "> 
	       <a id="Shownoti03adisp" onclick=""  style="float:left"  class="button"><span id="Shownoti03adisp2">退票</span><img/></a>	
	       <a id="Shownoti03bdisp" onclick=""  style="float:left"  class="button"><span id="Shownoti03bdisp2">兌現</span><img/></a>	
	       <!--<a id="Shownoti04cdisp" onclick=""  style="float:left"  class="button"><span id="Shownoti04cdisp2">還票</span><img/></a>	-->
	       <!--<a id="Shownoti04ddisp" onclick=""  style="float:left"  class=""><span id="Shownoti04ddisp2" style="display:none">退票</span><img/></a>	-->
      </div>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/not/noti03/updsave" method="post" enctype="multipart/form-data" >
	<div id="tab-general"> <!-- div-6 -->
	
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
		<td class="normal14y" width="8%">廠商代號：</td>
        <td  class="normal14a" width="25%" >
			<input tabIndex="1" id="puri01" onKeyPress="keyFunction()"  onchange="check_puri01(this);" name="puri01" value="<?php echo $ta009; ?>" size="12" type="text"/>
			<a href="javascript:;"><img id="Showpuri01disp" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
			<input type="text" name="puri01disp2" id="puri01disp2" style="display:none" value="" />
		</td>
		
	    <td class="normal14y" width="8%" >開票日： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" >
			<input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta004" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="ta004"  value="<?php echo $ta004; ?>"  size="12" type="text" style="background-color:#FFFFE4"/>
		<img  onclick="scwShow(ta004,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>

	  <tr>	
		<td class="normal14z" >廠商簡稱：</td>		
        <td class="normal14"  >
			<input type="text" id="puri01disp"  readonly="value"  tabIndex="16"   onKeyPress="keyFunction()"    name="puri01disp" value="<?php echo $puri01disp; ?>" style="background-color:#F0F0F0" size="20"/>
		</td>
		
		<td class="normal14z">付款銀行：</td>
        <td class="normal14">
			<input tabIndex="3" id="noti01a" onKeyPress="keyFunction()"  onchange="check_noti01a(this)" name="noti01a" value="<?php echo $ta006; ?>" size="12" type="text"  />
			<a href="javascript:;"><img id="Shownoti01adisp" src="<?php echo base_url()?>assets/image/png/bank.png" alt="" align="top"/></a>
		</td>
	  </tr>
	</table>
	
	<div class="abgne_tab"> <!-- div-7 頁標簽-->
		<ul class="tabs">
		  <li><a href="#tab1"  accesskey="a">票據資料a</a></li>
		  <li><a href="#tab2"  accesskey="b">付款資料b</a></li>		
		</ul>

    <div class="tab_container"> <!-- div-8 -->
	
	<!--   交易資料 -->	
	<div id="tab1" class="tab_content">
      <table class="form14">     <!-- 表格 -->
	    <tr>
	    <td class="normal14y"  width="12%"><span class="required">票號：</span></td>
        <td class="normal14a"  width="36%" >
			<input type="text" tabIndex="4" onKeyPress="keyFunction()" id="ta001"  name="ta001"  onblur=""  value="<?php echo  $ta001; ?>"   size="20" required="requierd" readonly="value" style="background-color:#F0F0F0"/>
		</td>
		
	    <td class="normal14y"  width="12%">票據種類：</td>  <!-- onchange="startcmsi09(this)"     -->
        <td  class="normal14"  >
			<input tabIndex="9" id="ta007" onKeyPress="keyFunction()" name="ta007" onblur=""   value="<?php echo  $ta007; ?>"   size="20"   type="text"/>
		</td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14z"  >幣別：</td>
        <td class="normal14" >
			<input tabIndex="6" id="cmsi06" onKeyPress="keyFunction()" name="cmsi06" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $ta002; ?>"  type="text"   size="20"/>
			<a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
			<span id="cmsi06disp"> <?php    echo $cmsi06disp; ?> </span>
		</td>
		
	    <td class="normal14z" >目前票況：</td>		
        <td class="normal14"  >
			<input type="text"  readonly="value" tabIndex="13"   onKeyPress="keyFunction()" id="ta008" name="ta008" value="<?php echo $ta008; ?>" style="background-color:#E7EFEF"  size="20"/>
		</td>
		<script>
			$(document).ready(function(){
				switch ($('#ta008').val()){
					case "1":
						$('#ta008').val('1:開票');
						break;
					case "5":
						$('#ta008').val('5:退票');
						break;
					case "6":
						$('#ta008').val('6:兌現');
						break;
					case "7":
						$('#ta008').val('7:註銷');
						break;
				}
			});
		</script>
	  </tr>
	  
	  <tr>
		<td class="normal14z" >匯率：</td>		
        <td class="normal14"  >
			<input type="text" id="exchange_rate"   tabIndex="8"   onKeyPress="keyFunction()"    name="exchange_rate" value="<?php echo $ta019; ?>"  size="20"/>
		</td>
	    
		<td  class="normal14z" >票面金額：</td>
        <td class="normal14"  >
			<input type="text" id="ta003"   tabIndex="10"   onKeyPress="keyFunction()"    name="ta003" value="<?php echo $ta003; ?>"  size="20" />
		</td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >到期日：</td>		
        <td class="normal14"  >
			<input type="text" id="ta005" ondblclick="scwShow(this,event);" onchange="dateformat_ymd(this);"  tabIndex="12"   onKeyPress="keyFunction()"    name="ta005" value="<?php echo $ta005; ?>"  size="20" style="background-color:#FFFFE4" />
		<img  onclick="scwShow(ta005,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
		
	   <tr>
	    <td class="normal14z" >銀行帳號：</td>		
        <td class="normal14"  >
			<input type="text" id="noti01adisp2" readonly="value"  tabIndex="14"   onKeyPress="keyFunction()"    name="noti01adisp2" value="<?php echo $noti01adisp2 ?>"  size="20" style="background-color:#F0F0F0" />
		</td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >銀行簡稱：</td>		
        <td class="normal14"  >
			<input type="text" id="noti01adisp"  readonly="value"  tabIndex="16"   onKeyPress="keyFunction()"    name="noti01adisp" value="<?php echo $noti01adisp; ?>"  size="20" style="background-color:#F0F0F0" />
		</td>
	  </tr>
	  </table>
	</div>
	
	<!--  地址 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	  <table class="form14">     <!-- 表格 -->
	    <tr>
	    <td class="normal14y" >付款單號：</td>		
        <td class="normal14"  >
			<input type="text" id="acpi03" name="acpi03"  tabIndex="19"   onKeyPress="keyFunction()"  onblur="check_acpi03(this)"  name="acpi03" value="<?php echo $ta011; ?>"  size="12"/>
			<a href="javascript:;"><img id="Showacpi03disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
			<input type="text" id="acpi03disp2"   tabIndex="20"   onKeyPress="keyFunction()"    name="acpi03disp2" value="<?php echo $ta012; ?>"  size="12" />
			<input type="text" id="acpi03disp3"   tabIndex="21"   onKeyPress="keyFunction()"    name="acpi03disp3" value="<?php echo $ta013; ?>"  size="12" />
		</td>
		<td class="normal14"></td>
		<td class="normal14"></td>
		<td></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14z" >票據科目：</td>		
        <td class="normal14"  >
			<input tabIndex="22" id="acti03" onKeyPress="keyFunction()" name="acti03" onblur="check_acti03(this);"  value="<?php echo $ta014; ?>"  type="text"   size="12" />
			<a href="javascript:;"><img id="Showacti03disp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
			<span id="acti03disp"> <?php echo $acti03disp; ?> </span>
		</td>
		
		<td class="normal14"></td>
		<td class="normal14"></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >對方科目：</td>
        <td class="normal14"  >
			<input tabIndex="23" id="acti03a" onKeyPress="keyFunction()" name="acti03a" onblur="check_acti03a(this);"  value="<?php echo $ta016; ?>"  type="text"   size="12"/>
			<a href="javascript:;"><img id="Showacti03adisp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
			<span id="acti03adisp"> <?php echo $acti03adisp; ?> </span>
		</td>
	  
		<td class="normal14"></td>
		<td class="normal14"></td>
	  </tr>	
	  
	  <tr>
		<td class="normal14z" >備註：</td>		
        <td class="normal14"  >
			<input type="text" id="ta018"   tabIndex="24"   onKeyPress="keyFunction()"    name="ta018" value="<?php echo $ta018; ?>"  size="12"/>
		</td>
	  
		<td class="normal14"></td>
		<td class="normal14"></td>
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
				
				$temp = "";
				Switch ($val->tb004){
					case "1":
						$temp = "";
						$temp1 = "1:開票";
						break;
					case "5":
						$temp = "2";
						$temp1 = "5:退票";
						break;
					case "6":
						$temp = "3";
						$temp1 = "6:兌現";
						break;
				}
				
				$current_product_count++;
				echo "<tbody id='product_row_".$current_product_count."' class='product_row' >";
				echo "<tr>";
				echo "<td class='center'><img src='".base_url()."assets/image/delete.png' title='刪除資料' onclick='del_detail".$temp."(\"".$temp1."\",\"".$current_product_count."\");' /></td>";
				//  \"".$val->tc001."\",\"".$val->td004."\",\"".$val->td003."\",\"".$current_product_count."\"
				foreach($usecol_array as $k => $v){
					if($k=="tb003" ){
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
						if($k == 'tb004'){
							switch ($val->$k){
								case "":
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".''."' onKeyPress='keyFunction()' ";
									break;
								case 1:
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".'1:開票'."' onKeyPress='keyFunction()' ";
									break;
								case 5:
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".'5:退票'."' onKeyPress='keyFunction()' ";
									break;
								case 6:
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".'6:兌現'."' onKeyPress='keyFunction()' ";
									break;
								case 7:
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".'7:註銷'."' onKeyPress='keyFunction()' ";
									break;
							}
						}else{
							echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".$s."' onKeyPress='keyFunction()' ";
						}
						
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
             <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="" /></td>
			  <td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
            </tr>
			  
            </tfoot>
          </table>
        </div>
	 </div>
	 
	<!-- 合計     -->
		      <!--<tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span></span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　訂單金額：</b></td>
				<td ><input type='text' readonly="value" name='tc029' id="tc029" size="8" value="<?php echo $tc029; ?>"  style="background-color:#F0F0F0" /></td>
			
				<td class="right" valign="top"><b style="color: #003A88;">　　稅額：</b></td>
				<td ><input type='text' readonly="value" name='tc030' id="tc030" size="8" value="<?php echo $tc030; ?>"  style="background-color:#F0F0F0" /></td>
			
				<td class="right" valign="top"><b style="color: #003A88;">　　合計金額：</b></td-->
			<!--	<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot"></span></b></td>value="<?php // echo $tc029+$tc030; ?>" -->
			<!--	<td ><input type='text' readonly="value" name="tc2930" id="tc2930" size="8" value="<?php echo $tc029+$tc030; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總數量：</b></td>
				<td ><input type='text' readonly="value" name='tc031' id="tc031" size="8" value="<?php echo $tc031; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總毛重：</b></td>
				<td ><input type='text' readonly="value" name='tc043' id="tc043" size="8" value="<?php echo $tc043; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總材積：</b></td>
				<td ><input type='text' readonly="value" name='tc044' id="tc044" size="8" value="<?php echo $tc044; ?>"  style="background-color:#F0F0F0" /></td>
				<td style="display:none;"></td> <!-- <input id="select_rows" size="1" /> -->
			<!--	<td class="left" valign="top"></td>
				
              </tr>-->
		<!-- 合計     -->	
	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	<!--  <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();totalSum();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
	  ?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('not/noti03/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
	  <?php } ?>
	  <?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
	  ?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('not/noti03/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
	  <?php } ?>	
	  </div> -->
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
<form action="<?php echo base_url()?>index.php/not/noti03/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
		
<script>
$(document).ready(function(){
	var temp = $('.list1>tbody').length;
	console.log(temp);
	
	switch ($('#order_product\\['+temp+'\\]\\[tb004\\]').val()){
		case '5:退票':
			$('#Shownoti03adisp').attr('class','');
			$('#Shownoti03adisp2').css('display','none');	
			
			$('#Shownoti03bdisp').attr('class','');
			$('#Shownoti03bdisp2').css('display','none');
			break;
		case '6:兌現':
			$('#Shownoti03adisp').attr('class','');
			$('#Shownoti03adisp2').css('display','none');	
			
			$('#Shownoti03bdisp').attr('class','');
			$('#Shownoti03bdisp2').css('display','none');
			break;
	}
});

function clean_noti01a(){
	$('#noti01a').val('');
	$('#noti01adisp').val('');
	$('#noti01adisp2').val('');
}

</script>
		
<?php  include_once("./application/views/funnew/puri01_funmjs_v.php"); ?>  <!-- 客戶回傳多欄 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->
<?php  include_once("./application/views/funnew/noti01a_funmjs_v.php"); ?>  <!-- 銀行帳戶(應收、應付票據用) -->
<?php  include_once("./application/views/funnew/acti03_funmjs_v.php"); ?>  <!-- 票據科目 -->
<?php  include_once("./application/views/funnew/acti03a_funmjs_v.php"); ?>  <!-- 票據科目 -->
<?php  include_once("./application/views/funnew/acpi03_funmjs_v.php"); ?>  <!--付款單-->
<?php // include_once("./application/views/funnew/puri01a_funmjs_v.php"); ?>  <!--廠商-->

<?php  include_once("./application/views/funnew/noti03a_funmjs_v.php"); ?>  <!-- 退票 -->
<?php  include_once("./application/views/funnew/noti03b_funmjs_v.php"); ?>  <!-- 兌現 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/noti03_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 