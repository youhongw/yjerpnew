  <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'ta003' || $key == 'ta013'){
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
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div> --> 
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
		
    </div>

<div id="content"> <!-- div-3 --> 
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 報價單資料建立作業 -修改　　　</h1>
    　<div style="float:left;padding-top: 5px; ">
	　<button style= "cursor:pointer" form="commentForm" onfocus="$('#copi03').focus();"　type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cop/copi05/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
	  ?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('cop/copi05/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
	  <?php } ?>
	  <?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
	  ?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('cop/copi05/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
	  <?php } ?>
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cop/copi05/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	
	<?php 
	  if(!isset($sysma200)) { $sysma200=$this->session->userdata('sysma200'); }
	  if(!isset($sysma201)) { $sysma201=$this->session->userdata('sysma201'); }  ?>
	<table class="form14"  >     <!-- 頭部表格 -->
	 <tr>
	    <td class="normal14y"  width="11%"><span class="required">報價單別：</span> </td>
        <td class="normal14a"  width="22%"><input tabIndex="1" id="copi03" readonly="readonly"   onKeyPress="keyFunction()"   name="ta001"    value="<?php echo $ta001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showcopi03disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="copi03disp"> <?php    echo $ta001disp; ?> </span></td>
	    <td class="normal14y" width="11%" >單據日期： </td>
        <td class="normal14a"  width="22%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta013" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="ta013"  value="<?php echo $ta013; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ta013,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		<td class="normal14y" width="12%" ><span class="required">報價單號：</span> </td>
        <td class="normal14a"  width="22%" ><input tabIndex="3" id="ta002" onKeyPress="keyFunction()" readonly="value" name="ta002"  value="<?php echo $ta002; ?>" size="12" type="text" required /></td>
	  </tr>		
	  <tr>
		<td class="normal14z">客戶代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="copi01" onKeyPress="keyFunction()" ondblclick="search_copi01_window()"  onchange="check_copi01(this)" name="ta004" value="<?php echo $ta004; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="copi01disp"> <?php   echo $ta004disp; ?> </span></td>	    
	    <td class="normal14z" >幣別：</td>
        <td class="normal14a" ><input tabIndex="11" id="cmsi06" ondblclick="search_cmsi06_window()" onKeyPress="keyFunction()" name="ta007" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $ta007; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $ta007disp; ?> </span></td>
		<td class="normal14z" >業務人員：</td>
        <td class="normal14a" ><input tabIndex="6" id="cmsi09" ondblclick="search_cmsi09_window()" onKeyPress="keyFunction()" name="ta005" onblur="check_cmsi09(this)"  value="<?php echo $ta005; ?>"  type="text"  size="12"  />
		  <a href="javascript:;"><img id="Showcmsi09disp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
          <span id="cmsi09disp"> <?php    echo $ta005disp; ?> </span></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >付款條件：</td>
        <td class="normal14a" ><input tabIndex="15" id="cmsi21" ondblclick="search_cmsi21_window()" onKeyPress="keyFunction()" name="ta011" onblur="check_cmsi21(this)"   value="<?php echo  $ta011; ?>"   size="12"   type="text"  />
		  <a href="javascript:;"><img id="Showcmsi21disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
          <span id="cmsi21disp"> <?php    echo $ta011disp; ?> </span></td>
		<td class="normal14z" >價格條件：</td>
        <td class="normal14a" ><input type="text" tabIndex="8"  onKeyPress="keyFunction()" id="ta010" name="ta010"   value="<?php echo $ta010; ?>"  /></td>
		<td class="normal14z" >訂貨起幾日交：</td>
        <td class="normal14a" ><input type="text" tabIndex="9"  onKeyPress="keyFunction()" id="ta014" name="ta014" size="5"  value="<?php echo $ta014; ?>"  /></td>
	   
	  </tr> 
	  <tr>
		<td class="normal14z">匯率：</td>
        <td  class="normal14"  ><input type="text" tabIndex="10"  onKeyPress="keyFunction()" id="ta008" name="ta008"   value="<?php echo $ta008; ?>"  /></td>
	    <td class="normal14z" >營業稅率：</td>
        <td class="normal14a" ><input type="text" tabIndex="11"  onKeyPress="keyFunction()" id="ta024" name="ta024"   value="<?php echo $ta024; ?>"  /></td>
		<td class="normal14z" >列印格式：</td>
        <td class="normal14a" ><select id="ta017" onKeyPress="keyFunction()" name="ta017"   tabIndex="12">
            <option <?php if($ta017 == '1') echo 'selected="selected"';?> value='1'>1中式</option>                                                                        
		    <option <?php if($ta017 == '2') echo 'selected="selected"';?> value='2'>2英式</option>
		  </select></td> 
	  
	  </tr>
	   <tr>
		<td class="normal14z">客戶全名：</td>
        <td  class="normal14"  ><input type="text" tabIndex="13"  onKeyPress="keyFunction()" id="ta006" name="ta006"   value="<?php echo $ta006; ?>"  /></td>
	    <td class="normal14z" >備註一：</td>
        <td class="normal14a" ><input type="text" tabIndex="14"  onKeyPress="keyFunction()" id="ta020" name="ta020"   value="<?php echo $ta020; ?>"  /></td>
		<td class="normal14z" >客戶確認：</td>
        <td class="normal14a" ><input type="hidden" name="ta016" value="N" />
		<input type='checkbox' tabIndex="15" id="ta016" onKeyPress="keyFunction()" name="ta016" <?php if($ta016 == 'Y' ) echo 'checked'; ?>  <?php if($ta016 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
	  
	  </tr>
	  <tr>
	    <td class="normal14z" >課稅別：</td>
        <td class="normal14" ><select id="ta022" onKeyPress="keyFunction()" name="ta022" onchange="taxa()" tabIndex="16">
		    <option <?php if($ta022 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php if($ta022 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php if($ta022 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php if($ta022 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php if($ta022 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select></td>
		<td class="normal14z">確認碼：</td>
        <td  class="normal14"  ><select id="verify" onKeyPress="keyFunction()" name="ta019"  onchange="selappr(this)" tabIndex="17">
            <option <?php if($ta019 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($ta019 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
		  </select><span  id="approved" ></span></td>  
	    <td class="normal14z" >列印次數：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="18"  readonly="value"  onKeyPress="keyFunction()" id="ta018" name="ta018" size="5"  value="<?php echo $ta018; ?>" style="background-color:#F5F5F5" /></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >報價日期：</td>
        <td class="normal14"  ><input type="text"   tabIndex="19"  readonly="value" onKeyPress="keyFunction()"   name="ta003" value="<?php echo $ta003; ?>" style="background-color:#F5F5F5"  /></td>
	     <td class="normal14z">確認者：</td>
        <td  class="normal14"  ><input tabIndex="20" id="ta015" readonly="value" onKeyPress="keyFunction()"  name="ta015" value="<?php echo $ta015; ?>" size="10" type="text" style="background-color:#F5F5F5"  /></td>
  
		 <td class="normal14z">簽核狀態：</td>
        <td  class="normal14"  ><select id="ta029" tabIndex="21" readonly="value" onKeyPress="keyFunction()" name="ta029"   style="background-color:#F5F5F5" >
            <option <?php if($ta029 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($ta029 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($ta029 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($ta029 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($ta029 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($ta029 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($ta029 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($ta029 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
		  <td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" /></td>
         <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" /></td>
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
      
    <!--   明細0  --> 
	 <!--  依照資料庫紀錄的明細先列一遍 原0會由1加  -->
            <?php $current_product_count = 0; ?>
			<?php foreach($body_data as $key => $val){
				$current_product_count++;
				echo "<tbody id='product_row_".$current_product_count."' class='product_row' >";
				echo "<tr>";
				echo "<td class='center'><img src='".base_url()."assets/image/delete.png' title='刪除資料' onclick='del_detail(\"".$val->tb001."\",\"".$val->tb002."\",\"".$val->tb003."\",\"".$current_product_count."\");' /></td>";
				foreach($usecol_array as $k => $v){
					if($k=="tb016" ){
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
									
									echo "<img name='order".$current_product_count."' id='order".$current_product_count."' alt='客戶計價查詢' align='top' src=";
									echo base_url()."assets/image/png/seek.png";
									echo " />";
								}
					if($v['name'] == '品號圖示2'){
									echo "<a href=javascript:";
									echo "/>";
									
									echo "<img name='order".$current_product_count."' id='order".$current_product_count."' alt='客戶計價查詢' align='top' src=";
									echo base_url()."assets/image/png/seek.png";
									echo " />";
								}
					if($v['name'] == '品號圖示2'){
									echo "<a href=javascript:";
									echo "/>";
									
									echo "<img name='ordera".$current_product_count."' id='ordera".$current_product_count."' alt='客戶計價查詢' align='top' src=";
									echo base_url()."assets/image/png/seek1.png";
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
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
             <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
            </tr>
			  
            </tfoot>
          </table>
        </div>
	  <!-- 合計     -->
		     <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span>
				</span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　報價金額：</b></td>
				<td ><input type='text' readonly="value" name='ta009' id="ta009" size="8" value="<?php echo $ta009; ?>"  style="background-color:#F5F5F5" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta023' id="ta023" size="8" value="<?php echo $ta023; ?>"  style="background-color:#F5F5F5" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　合計金額：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot"><?php echo $ta009+$ta023; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　　總數量：</b></td>
				<td ><input type='text' readonly="value" name='ta025' id="ta025" size="8" value="<?php echo $ta025; ?>"  style="background-color:#F5F5F5" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　總毛重：</b></td>
				<td ><input type='text' readonly="value" name='ta027' id="ta027" size="8" value="<?php echo $ta027; ?>"  style="background-color:#F5F5F5" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　總材積：</b></td>
				<td ><input type='text' readonly="value" name='ta028' id="ta028" size="8" value="<?php echo $ta028; ?>"  style="background-color:#F5F5F5" /></td>
				
				
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	
		 <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  
	 <!-- <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cop/copi05/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
	  ?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('cop/copi05/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
	  <?php } ?>
	  <?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
	  ?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('cop/copi05/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
	  <?php } ?>
	  </div> -->
	  
	  <br>
    </form>
	 <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,品號開視窗(1)按2下品號查詢(2)圖示1客戶計價(3)整套展開,Alt+y直接跳明細資料,Alt+w新增明細,有選項欄位按上下鍵選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  
    </div> <!-- div-3 --> 
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
<form action="<?php echo base_url()?>index.php/cop/copi05/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
 <?php  include_once("./application/views/funnew/copi03a_funmjs_v.php"); ?> <!-- 訂單單別 -->
<?php  include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?>  <!-- 人員 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/copi01a_funmjs_v.php"); ?>  <!-- 客戶回傳多欄 -->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?>  <!-- 部門 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->
<?php  include_once("./application/views/funnew/cmsi21_funmjs_v.php"); ?>  <!-- 付款條件 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/copi05_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 