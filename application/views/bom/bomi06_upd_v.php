   <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'tf003' || $key == 'tf012'){
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
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 拆解單資料建立作業 - 修改　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	   <button style= "cursor:pointer" form="commentForm" onfocus="$('#puri04').focus();" type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('bom/bomi06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	   <a  href="javascript:;"><span class="button"  >BOM展開方式</span><img id="Showbomc02a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="BOM展開方式" title="BOM展開方式"  align="top"/></a>
	   <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
	  ?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('bom/bomi06/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
	  <?php } ?>
	  <?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
	  ?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('bom/bomi06/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
	  <?php } ?>
	</div>
	 </div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/bom/bomi06/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php 
	  if(!isset($sysma200)) { $sysma200=$this->session->userdata('sysma200'); }
	  if(!isset($sysma201)) { $sysma201=$this->session->userdata('sysma201'); }  ?>
	
	<table class="form14"  >     <!-- 頭部表格 -->
	 <tr>
	    <td class="normal14y"  width="10%"><span class="required">拆解單別：</span> </td>
        <td class="normal14a"  width="22%"><input tabIndex="1" id="bomi03"    onKeyPress="keyFunction()" ondblclick="search_bomi03_window()"  name="tf001"  onchange="check_bomi03(this);"  value="<?php echo $tf001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showbomi03disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="bomi03disp"> <?php    echo $tf001disp; ?> </span></td>
	    <td class="normal14y" width="10%" >單據日期： </td>
        <td class="normal14a"  width="24%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tf012" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tf012"  value="<?php echo $tf012; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(tf012,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		 <td class="normal14y" width="10%" ><span class="required">拆解單號：</span> </td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="tf002" onKeyPress="keyFunction()"  name="tf002" value="<?php echo $tf002; ?>" size="20" type="text" required /></td>
	  </tr>		
		  
	  <tr>
		 <td class="normal14z">成品品號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="invi02" onKeyPress="keyFunction()"  ondblclick="search_invi02_window();" name="tf004" value="<?php echo $tf004; ?>" size="20" type="text" required />
		<a href="javascript:;"><img id="Showinvi02disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="invi02disp"><?php    echo $tf004disp; ?> </span></td>
        <td class="normal14z" >品名：</td>
        <td class="normal14a" ><input tabIndex="5" id="tf004disp" onKeyPress="keyFunction()"  name="tf004disp" value="<?php echo $tf004disp; ?>" size="30" type="text" style="background-color:#EBEBE4" /></td>	 
         <td class="normal14z" >規格：</td>
        <td class="normal14a" ><input tabIndex="6" id="tf004disp1" onKeyPress="keyFunction()"  name="tf004disp1" value="<?php echo $tf004disp1; ?>" size="30" type="text" style="background-color:#EBEBE4" /></td>	 	
	</tr>
		<tr>
	    <td class="normal14z" >單位：</td>
        <td class="normal14a" ><input tabIndex="7" id="tf005" onKeyPress="keyFunction()"  name="tf005" value="<?php echo $tf005; ?>" size="10" type="text"  /></td>
	    <td class="normal14z">成品數量：</td>
       <td class="normal14a" ><input tabIndex="8" id="tf007" onKeyPress="keyFunction()"  name="tf007" value="<?php echo $tf007; ?>" size="10" type="text"  /></td>
	    <td class="normal14z">出庫庫別：</td>
       <td class="normal14a" ><input tabIndex="1" id="cmsi03"    onKeyPress="keyFunction()" ondblclick="search_cmsi03_window()"  name="tf008"  onchange="check_cmsi03(this);"  value="<?php echo $tf008; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcmsi03disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="cmsi03disp"> <?php    echo $tf008disp; ?> </span></td>
	  
	  </tr>
	    <tr>
	     <td class="normal14z">備註：</td>
       <td class="normal14a" ><input tabIndex="10" id="tf009" onKeyPress="keyFunction()"  name="tf009" value="<?php echo $tf009; ?>" type="text"  /></td>
	   <td class="normal14z">確認碼：</td>
          <td  class="normal14"  ><select id="tf010" onKeyPress="keyFunction()" name="tf010" onChange="selappr(this)" tabIndex="11">
            <option <?php if($tf010 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tf010 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tf010 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td> 
		<td class="normal14z" >列印：</td>
        <td class="normal14a" ><input tabIndex="12" id="tf011" onKeyPress="keyFunction()"  name="tf011" value="<?php echo $tf011; ?>" size="10" type="text" style="background-color:#EBEBE4" /></td>
		 </tr>
	</table>
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
		<li><a href="#tab1">拆解成本</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  組合成本 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	 
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="9%" >批號：</td>
       <td class="normal14a"  width="24%" ><input type="text" tabIndex="19" id="tf017"    onKeyPress="keyFunction()"    name="tf017" value="<?php echo $tf017; ?>" style="background-color:#EBEBE4"  /></td>
	   <td class="normal14y"  width="12%" >拆解日期：</td>
       <td class="normal14a"  width="21%" ><input type="text" tabIndex="18" id="tf003"   onKeyPress="keyFunction()"  onclick="scwShow(this,event);"  name="tf003" value="<?php echo $tf003; ?>" style="background-color:#EBEBE4"  /></td>
	   <td class="normal14y"  width="9%" > 簽核狀態：</td>
       <td class="normal14a"  width="25" ><select id="tf014" tabIndex="15" readonly="value" onKeyPress="keyFunction()" name="tf014"   style="background-color:#EBEBE4" >
            <option <?php if($tf014 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tf014 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($tf014 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tf014 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tf014 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tf014 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tf014 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tf014 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
	 </tr>	
	 <tr>
	   <td class="normal14z"  > 拆解成本：</td>
       <td class="normal14a"  ><input type="text" tabIndex="16" id="tf201"    onKeyPress="keyFunction()"    name="tf201" value="<?php echo $tf201; ?>" style="background-color:#EBEBE4" /></td>
	   <td class="normal14z"  > 單位成本：</td>
       <td class="normal14a"  ><input type="text" tabIndex="17" id="tf200"     onKeyPress="keyFunction()"    name="tf200" value="<?php echo $tf200; ?>"  style="background-color:#EBEBE4"/></td>
	   <td class="normal14"  ></td>
       <td class="normal14a"  ></td>
	 </tr>
	  <tr>
	   <td class="normal14z"  > 小單位：</td>
       <td class="normal14a"  ><input type="text" tabIndex="20" id="tf006"    onKeyPress="keyFunction()"    name="tf006" value="<?php echo $tf006; ?>" style="background-color:#EBEBE4" /></td>
	   <td class="normal14z"  > 確認者：</td>
       <td class="normal14a"  ><input type="text" tabIndex="21" id="tf013"   onKeyPress="keyFunction()"    name="tf013" value="<?php echo $tf013; ?>" style="background-color:#EBEBE4"  /></td>
	   <td class="normal14"  ></td>
       <td class="normal14a"  ></td>
	 </tr>
	<tr>
	   <td class="normal14z" > 調整單別：</td>
       <td class="normal14a"  ><input type="text" tabIndex="16" id="tf016"    onKeyPress="keyFunction()"    name="tf016" value="<?php echo $tf016; ?>" style="background-color:#EBEBE4" /></td>
	   <td class="normal14z"  > 調整單別：</td>
       <td class="normal14a"  ><input type="text" tabIndex="17" id="tf017"      onKeyPress="keyFunction()"    name="tf017" value="<?php echo $tf017; ?>"  style="background-color:#EBEBE4"/></td>
	   <td class="normal14z"  > 調整序號：</td>
       <td class="normal14a"  ><input type="text" tabIndex="18" id="tf018"   onKeyPress="keyFunction()"  onclick="scwShow(this,event);"  name="tf018" value="<?php echo $tf018; ?>" style="background-color:#EBEBE4"  /></td>
	 </tr>
	</table>
	</div>
	
	</div> <!-- </div>div-8 -->
	 </div> <!--</div>  div-7 -->	

	<!-- 明細表頭  -->
	 <div style="width:100%; overflow-x: auto;  ">
          <table id="order_product" class="list1">
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
      
     <!--   明細0  --> 
	 <!--  依照資料庫紀錄的明細先列一遍 原0會由1加  -->
            <?php $current_product_count = 0; ?>
			<?php foreach($body_data as $key => $val){
				$current_product_count++;
				echo "<tbody id='product_row_".$current_product_count."' class='product_row' >";
				echo "<tr>";
				echo "<td class='center'><img src='".base_url()."assets/image/delete.png' title='刪除資料' onclick='del_detail(\"".$val->tg001."\",\"".$val->tg002."\",\"".$val->tg003."\",\"".$current_product_count."\");' /></td>";
				foreach($usecol_array as $k => $v){
					//if($k=="tg014" ){
						// $s = substr($val->$k,0,4)."/".substr($val->$k,4,2)."/".substr($val->$k,6,2);
						//$s = stringtodate("Y/m/d",$val->$k);
					//}else{
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
	
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	<!--  <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('bom/bomi06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	   <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
	  ?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('bom/bomi06/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
	  <?php } ?>
	  <?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
	  ?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('bom/bomi06/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
	  <?php } ?>
	  </div> -->
	  <br>
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
<form action="<?php echo base_url()?>index.php/bom/bomi06/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
 <?php  include_once("./application/views/funnew/bomi03b_funmjs_v.php"); ?> <!-- 拆解單別43 -->
 <?php  include_once("./application/views/funnew/invi02e_funmjs_v.php"); ?> <!-- 成品品號 -->
<?php  include_once("./application/views/funnew/cmsi03_funmjs_v.php"); ?>  <!-- 庫別 -->
<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/bomi06_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 