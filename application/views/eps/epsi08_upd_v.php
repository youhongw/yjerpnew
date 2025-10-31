 <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'tc003' || $key == 'tc039'){
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 信用狀資料建立作業 - 修改</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/eps/epsi08/updsave" method="post" enctype="multipart/form-data" >
	<div id="tab-general"> <!-- div-6 -->
	
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="10"><span class="required">信用狀號：</span></td>   <!--onchange="startcopi03(this);check_title_no();"    -->
        <td class="normal14a"  width="40%"><input type="text" tabIndex="1"   onKeyPress="keyFunction()" id="tf001" name="tf001"   value="<?php echo $tf001; ?>"  size="30" required /></td>
	    
	    <td class="start14a" width="10%"><span class="required">類別：</span></td>
        <td class="normal14a" width="40%"><input tabIndex="2" id="tf002" onKeyPress="keyFunction()"  name="tf002"  value="<?php echo $tf002; ?>" size="12" type="text"  /></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a">客戶代號：</td>
        <td  class="normal14"  ><input tabIndex="3" id="copi01" onKeyPress="keyFunction()"  onchange="check_copi01(this)" name="tf003" value="<?php echo $tf003; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="copi01disp"> <?php   echo $tf003disp; ?> </span></td>
	    <td class="normal14">廠別代號：</td>
        <td  class="normal14"  ><input type="text" tabIndex="4" onKeyPress="keyFunction()" id="cmsi02"  onblur="check_cmsi02(this)" name="cmsi02"   value="<?php echo  $tf004; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	      <span id="cmsi02disp"> <?php    echo $tf004disp; ?> </span></td>
		  
	  </tr>
	  <tr>
	    <td  class="normal14" >可否分批：</td>
        <td  class="normal14"  ><input type="hidden" name="tf013" class="tf013"  value="N" />
		  <input tabIndex="5" id="tf013" onKeyPress="keyFunction()"  name="tf013" <?php if($tf013 == 'Y' ) echo 'checked';  ?>  <?php if($tf013 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  />
        </td>	  
	    <td class="normal14">可否轉運：</td>		
        <td  class="normal14"  ><input type="hidden" name="tf014" class="tf014"  value="N" />
		  <input tabIndex="6" id="tf014" onKeyPress="keyFunction()" name="tf014" <?php if($tf014 == 'Y' ) echo 'checked'; ?>  <?php if($tf014 != 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  />
        </td>
	  </tr>
	  <tr>	    
		<td class="normal14">確認日期：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" readonly="value"  onKeyPress="keyFunction()" id="tf025" name="tf025"   value="<?php echo $tf025; ?>" size="12"  style="background-color:#F0F0F0"/></td>
	    <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="8" readonly="value"  onKeyPress="keyFunction()" id="tf026" name="tf026"   value="<?php echo $tf026; ?>" style="background-color:#F0F0F0" size="12" /></td>
	     </tr>
	  <tr>	
	     <td class="normal14">確認碼：</td>
        <td  class="normal14"  ><select id="verify" onKeyPress="keyFunction()" name="tf022" onChange="selverify(this)" tabIndex="9">
            <option <?php if($tf022 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tf022 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tf022 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>
		 <td class="normal14">拋轉狀態：</td>
        <td  class="normal14"  ><select id="tf027" tabIndex="10" readonly="value" onKeyPress="keyFunction()" name="tf027"   style="background-color:#F0F0F0" >
            <option <?php if($tf027 == 'N') echo 'selected="selected"';?> value='N'>N.未拋轉</option>                                                                        
		    <option <?php if($tf027 == 'Y') echo 'selected="selected"';?> value='Y'>Y.拋轉成功(來源廠商)</option>
            <option <?php if($tf027 == 'y') echo 'selected="selected"';?> value='y'>y.拋轉成功(下游廠商)</option>
		    <option <?php if($tf027 == 'n') echo 'selected="selected"';?> value='n'>n.訂單變更</option>
            <option <?php if($tf027 == 'U') echo 'selected="selected"';?> value='U'>U.拋轉失敗</option>	
            <option <?php if($tf027 == 'u') echo 'selected="selected"';?> value='u'>u.還原失敗</option>	
		  </select></td>
	  </tr>
	 
	</table>
	
	<div class="abgne_tab"> <!-- div-6 頁標籤 -->
		<ul class="tabs">
		  <li><a href="#tab1"  accesskey="a">開狀資料a</a></li>
		  <li><a href="#tab2"  accesskey="b">金額資料b</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  交易資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="10">許可證號：</td>
        <td class="normal14a"  width="40%" ><input type="text" id="tf015"   tabIndex="11"   onKeyPress="keyFunction()"    name="tf015" value="<?php echo $tf015; ?>"  size="12" /></td>
	    <td class="normal14a"  width="8%">開狀日：</td>  
        <td class="normal14a"  width="42%" ><input tabIndex="12"  ondblclick="scwShow(this,event);"   id="tf008" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tf008"  value="<?php echo $tf008; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tf008,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>	
	 
	  <tr>
	    <td class="normal14a"  >開狀銀行代號：</td>
        <td class="normal14" ><input tabIndex="15" id="cmsi16" onKeyPress="keyFunction()" name="tf005" onblur="check_cmsi16(this);"  value="<?php echo $tf005; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi16disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi16disp"> <?php    echo $tf005disp; ?> </span></td>
	    <td class="normal14a"  >收到日：</td>  
        <td class="normal14a"   ><input tabIndex="16"  ondblclick="scwShow(this,event);"   id="tf009" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tf009"  value="<?php echo $tf008; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tf009,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>	  
       <tr>
	    <td class="normal14a"  >通知銀行代號：</td>
        <td class="normal14" ><input tabIndex="17" id="cmsi16a" onKeyPress="keyFunction()" name="tf006" onblur="check_cmsi16a(this);"  value="<?php echo $tf006; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi16adisp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi16adisp"> <?php    echo $tf006disp; ?> </span></td>
	    <td class="normal14a"  >裝船日：</td>  
        <td class="normal14a"   ><input tabIndex="18"  ondblclick="scwShow(this,event);"   id="tf010" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tf010"  value="<?php echo $tf010; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tf010,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>	  
	   <tr>
	    <td class="normal14a"  >押匯銀行代號：</td>
        <td class="normal14" ><input tabIndex="19" id="cmsi16b" onKeyPress="keyFunction()" name="tf007" onblur="check_cmsi16b(this);"  value="<?php echo $tf007; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi16bdisp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi16bdisp"> <?php    echo $tf007disp; ?> </span></td>
	    <td class="normal14a"  >押匯日：</td>  
        <td class="normal14a"   ><input tabIndex="20"  ondblclick="scwShow(this,event);"   id="tf011" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tf011"  value="<?php echo $tf011; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tf011,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>	  
	   <tr>
	    <td class="normal14a"  >備註：</td>
        <td class="normal14" ><input type="text" id="tf023"   tabIndex="21"   onKeyPress="keyFunction()"    name="tf023" value="<?php echo $tf023; ?>"  size="30" /></td>
	    <td class="normal14a"  >到期日：</td>  
        <td class="normal14a"   ><input tabIndex="22"  ondblclick="scwShow(this,event);"   id="tf012" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tf012"  value="<?php echo $tf012; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tf012,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>	  
	 
	  
	</table>
	</div>
	
	<!--  地址 標籤 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	   <tr>
	    <td class="normal14a" width="10%">幣別：</td>
        <td class="normal14a"  width="40%" ><input tabIndex="23" id="cmsi06" onKeyPress="keyFunction()" name="tf016" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $tf016; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $tf016disp; ?> </span></td>
		  
		  <td class="normal14a"  width="10%">匯率：</td>  
        <td class="normal14a"  width="40%" ><input type="text" id="exchange_rate"   tabIndex="24"   onKeyPress="keyFunction()"    name="tf017" value="<?php echo $tf017; ?>"  size="12" /></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14a"  >總金額：</td>
        <td class="normal14a"   ><input type="text" id="tf018"   tabIndex="25"   onKeyPress="keyFunction()" onchange="check_tf018();"   name="tf018" value="<?php echo $tf018; ?>"  size="12" /></td>
	    <td class="normal14a"  >通知費用：</td>  
        <td class="normal14a"   ><input type="text" id="tf020"   tabIndex="26"   onKeyPress="keyFunction()"    name="tf020" value="<?php echo $tf020; ?>"  size="12" /></td>
	  </tr>	
	  <tr>
	    <td class="normal14a"  >結案碼：</td>
        <td class="normal14a"   ><input type="hidden" name="tf021" class="tf021"  value="N" />
		  <input tabIndex="27" id="tf021" onKeyPress="keyFunction()" name="tf021" <?php if($tf021 == 'Y' ) echo 'checked'; ?>  <?php if($tf021 != 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  />
        </td><td class="normal14a"  ></td>  
          <td class="normal14a"   ></td>
	  </tr>	
	  <tr>
	    <td class="normal14a"  >押匯金額：</td>  
        <td class="normal14a"   ><input type="text" id="tf019" readonly="readonly"  tabIndex="28"   onKeyPress="keyFunction()"    name="tf019" value="<?php echo $tf019; ?>"  size="12" style="background-color:#F0F0F0" /></td>
	  	<td class="normal14a"   >訂單金額：</td>   
        <td class="normal14a"   ><input type="text" id="tf024" readonly="readonly"  tabIndex="29"   onKeyPress="keyFunction()"    name="tf024" value="<?php echo $tf024; ?>"  size="12"  style="background-color:#F0F0F0" /></td>
	  </tr>	
	  <tr>
	    <td class="normal14a"  >訂單餘額：</td>
        <td class="normal14" ><input type="text" id="tf018disp"  readonly="readonly" tabIndex="30"   onKeyPress="keyFunction()"    name="tf018disp" value="<?php echo $tf018disp; ?>"  size="12" style="background-color:#F0F0F0" /></td>
	    <td class="normal14a"  >L/C餘額：</td>  
        <td class="normal14a"   ><input type="text" id="tf018disp1" readonly="readonly"  tabIndex="31"   onKeyPress="keyFunction()"    name="tf018disp1" value="<?php echo $tf018disp1; ?>"  size="12" style="background-color:#F0F0F0" /></td>
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
				echo "<td class='center'><img src='".base_url()."assets/image/delete.png' title='刪除資料' onclick='del_detail(\"".$val->tg001."\",\"".$val->tg002."\",\"".$current_product_count."\");' /></td>";
				foreach($usecol_array as $k => $v){
				//	if($k=="td013" ){
						//$s = substr($val->$k,0,4)."/".substr($val->$k,4,2)."/".substr($val->$k,6,2);
				//		$s = stringtodate("Y/m/d",$val->$k);
				//	}else{
						$s = $val->$k;
				//	}
					
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
	 
	
	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('eps/epsi08/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
	  ?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('eps/epsi08/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
	  <?php } ?>
	  <?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
	  ?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('eps/epsi08/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
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
<form action="<?php echo base_url()?>index.php/eps/epsi08/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
		
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/copi01a_funmjs_v.php"); ?>  <!-- 客戶 -->
<?php  include_once("./application/views/funnew/cmsi16_funmjs_v.php"); ?>  <!-- 銀行代號 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/epsi08_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 

<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#copi03').focus();
	}); 	
   function check_tf018() {
	   var tf018=$('#tf018').val();
	   console.log(tf018);
	   $('#tf018disp').val(tf018);
	   $('#tf018disp1').val(tf018);
   }
	
</script> 	    	