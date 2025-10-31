 <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'tc003' || $key == 'tc024'){
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
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 採購單資料建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pur/puri07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	    <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('pur/puri07/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('pur/puri07/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>
	 </div>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pur/puri07/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	
      
	<table class="form14"  >     <!-- 頭部表格 -->
	    <tr>
	    <td class="start14a"  width="10%"><span class="required">採購單別：</span> </td>
        <td class="normal14a"  width="40%"><input tabIndex="1" id="puri04"    onKeyPress="keyFunction()" ondblclick="search_puri04_window()"  name="tc001"  onchange="check_puri04(this);"  value="<?php echo $tc001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showpuri04disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="puri04disp"> <?php    echo $tc001disp; ?> </span></td>
	    <td class="normal14a" width="10%" >單據日期： </td>
        <td class="normal14a"  width="40%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tc024" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tc024"  value="<?php echo $tc024; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(tc024,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td></tr>	
	  <tr>
	    <td class="start14a" ><span class="required">採購單號：</span></td>
        <td class="normal14a" ><input tabIndex="3" id="tc002" onKeyPress="keyFunction()" onfocus="" name="tc002" value="<?php echo $tc002; ?>" size="30" type="text" required /><span id="tc002disp" ></span></td>
		 <td class="normal14a">供應廠商：</td>
        <td  class="normal14"  ><input tabIndex="4" id="puri01" onKeyPress="keyFunction()" onfocus="check_title_no();" ondblclick="search_puri01_window()"  onchange="check_puri01(this)" name="tc004" value="<?php echo $tc004; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showpuri01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="puri01disp"> <?php   echo $tc004disp; ?> </span></td>
	  </tr>
		
	  <tr>
	   <td class="normal14">確認碼：</td>
          <td  class="normal14"  ><select id="tc014" onKeyPress="keyFunction()" name="tc014" onChange="selappr(this)" tabIndex="5">
            <option <?php if($tc014 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tc014 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tc014 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td> 
		 <td class="normal14">採購日期：</td>
        <td  class="normal14"  ><input type="text" tabIndex="6" readonly="value"  onKeyPress="keyFunction()" id="tc003" name="tc003"   value="<?php echo $tc003; ?>"  style="background-color:#EBEBE4" /></td>
	  </tr>
	   <tr>
        <td  class="normal14" >簽核狀態：</td>
		<td class="normal14"><select id="tc030" tabIndex="7" readonly="value" onKeyPress="keyFunction()" name="tc030"   style="background-color:#EBEBE4">
            <option <?php if($tc030 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tc030 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($tc030 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tc030 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tc030 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tc030 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tc030 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tc030 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
		 <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="8" readonly="value"  onKeyPress="keyFunction()" id="tc025" name="tc025"   value="<?php echo $tc025; ?>" style="background-color:#EBEBE4"  /></td>
	  </tr>
		
	</table>
	
	<div class="abgne_tab"> <!-- div-7 -->
		<ul class="tabs">
		  <li><a href="#tab1"><img src="<?php echo base_url()?>assets/image/png/label-2.png" title="" align="center" />&nbsp;基本資料</a></li>
		<li><a href="#tab2"><img src="<?php echo base_url()?>assets/image/png/label-3.png" title="" align="center" />&nbsp;地址</a></li>
		</ul>
		
    <div class="tab_container"> <!-- div-8 -->
	
	<!--   基本資料1 -->
	<div id="tab1" class="tab_content">
   
	<table class="form14">     <!-- 表格 -->
	   <tr>
	   <td class="normal14a"  width="10%">廠別：</td>
       <td class="normal14a"  width="40%" >
	   <input tabIndex="9" id="cmsi02" ondblclick="search_cmsi02_window()" onKeyPress="keyFunction()" name="tc010" onblur="check_cmsi02(this);check_rate(this);"  value="<?php echo $tc010; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
          <span id="cmsi02disp"> <?php    echo $tc010disp; ?> </span></td>
	   <td class="normal14a"  width="10%" > 採購人員：</td>
       <td class="normal14a"  width="40%" >
	    <input tabIndex="9" id="cmsi09" ondblclick="search_cmsi09_window()" onKeyPress="keyFunction()" name="tc011" onblur="check_cmsi09(this);check_rate(this);"  value="<?php echo $tc011; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi09disp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
          <span id="cmsi09disp"> <?php    echo $tc011disp; ?> </span></td>
	 </tr>	
		  
	  <tr>
	   <td class="normal14a"  >幣別：</td>
        <td class="normal14" >
		  <input tabIndex="10" id="cmsi06" ondblclick="search_cmsi06_window()" onKeyPress="keyFunction()" name="tc005" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $tc005; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $tc005disp; ?> </span></td>
	    <td class="normal14" >匯率：</td>		
        <td class="normal14"  ><input type="text" id="tc006"   tabIndex="11"   onKeyPress="keyFunction()"    name="tc006" value="<?php echo $tc006; ?>"  /></td>
	  </tr>
	   <tr>
	   <td class="normal14a"  >課稅別：</td>
        <td class="normal14" ><select id="tc018" onKeyPress="keyFunction()" name="tc018"  tabIndex="12">
		    <option <?php if($tc018 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php if($tc018 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php if($tc018 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php if($tc018 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php if($tc018 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select></td>
		
		
	    <td class="normal14" >營業稅率：</td>
        <td class="normal14"  ><input type="text"   tabIndex="13"   onKeyPress="keyFunction()"   name="tc026" value="<?php echo $tc026; ?>"   /></td>
	  </tr>
		
	  <tr>
	    <td  class="normal14a" >付款條件：</td>
        <td  class="normal14"  >	   
	    <input tabIndex="14" id="cmsi21" ondblclick="search_cmsi21_window()" onKeyPress="keyFunction()" name="tc027" onblur="check_cmsi21(this);check_rate(this);"  value="<?php echo $tc027; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi21disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
          <span id="cmsi21disp"> <?php    echo $tc027disp; ?> </span></td>
		<td  class="normal14a">列印格式：</td>		
        <td  class="start14"  ><select id="tc012" onKeyPress="keyFunction()" name="tc012"  tabIndex="15">
            <option <?php if($tc012 == '1') echo 'selected="selected"';?> value='1'>中文</option>                                                                        
		    <option <?php if($tc012 == '2') echo 'selected="selected"';?> value='2'>英文</option>
		  </select></td>
	    
	  </tr>
	  <tr>
	    <td class="normal14">價格條件：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="16"   onKeyPress="keyFunction()" id="tc007" name="tc007"   value="<?php echo $tc007; ?>"    /></td>
		<td class="normal14" >運輸方式：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="17"   onKeyPress="keyFunction()" id="tc017" name="tc017"   value="<?php echo $tc017; ?>"  /></td>
	  </tr>	
		
	  <tr>
	    <td  class="normal14" >備註：</td>
        <td class="normal14"><input type="text" tabIndex="18"   onKeyPress="keyFunction()"  id="tc009" name="tc009" size="60" value="<?php echo $tc009; ?>"   /></td>
	    <td class="normal14">訂金比率：</td>
        <td  class="normal14"  ><input type="text" tabIndex="19" readonly="value"  onKeyPress="keyFunction()" id="tc028" name="tc028"   value="<?php echo $tc028; ?>"    /></td>
	  </tr>
	 
	</table>
	</div>
	<!--  地址 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	  <?php
	 //  $tc021=$this->input->post('tc021');
	 //  $tc022=$this->input->post('tc022');
	  ?>
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14a"  width="20%">送貨地址(1)：</td>
       <td class="normal14a"  width="30%" ><input type="text" tabIndex="17"   onKeyPress="keyFunction()" id="tc021" name="tc021" size="120"  value="<?php echo $tc021; ?>"   />
	   <td class="start14a"  width="20%" ></td>
       <td class="normal14a"  width="30%" ></td>
	 </tr>			  
	 
	  <tr>
	    <td class="normal14">送貨地址(2)：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="18"   onKeyPress="keyFunction()" id="tc022" name="tc022"  size="120"   value="<?php echo $tc022; ?>"    /></td>
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
	
	 </div>
	</div>
	<!-- 合計     -->
		     <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span></span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　未稅總額：</b></td>
				<td ><input type='text' readonly="value" name='tc019' id="tc019" size="8" value="<?php echo $tc019; ?>"  style="background-color:#EBEBE4" /></td>
			<!--	<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_total"></span></b></td>  -->
				<td class="right" valign="top"><b style="color: #003A88;">　　稅額：</b></td>
				<td ><input type='text' readonly="value" name='tc020' id="tc020" size="8" value="<?php echo $tc020; ?>"  style="background-color:#EBEBE4" /></td>
			<!--	<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tax"></span></b></td> -->
				<td class="right" valign="top"><b style="color: #003A88;">　　合計金額：</b></td>
				<td ><input type='text' readonly="value" name='tc1920' id="tc1920" size="8" value="<?php echo $tc019+$tc020; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　合計數量：</b></td>
				<td ><input type='text' readonly="value" name='tc023' id="tc023" size="8" value="<?php echo $tc023; ?>"  style="background-color:#EBEBE4" /></td>
				<td style="display:none;">
				<td class="left" valign="top"></td>
              </tr>
		<!-- 合計     -->	
	<!--<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pur/puri07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	    <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('pur/puri07/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('pur/puri07/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>	
		</div> -->
	  
      </form>
	  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>  -->
 
     </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  <!--  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>  -->
  </div> <!-- div-3 -->
 </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php  include_once("./application/views/funnew/fun_disabled_v.php"); ?>