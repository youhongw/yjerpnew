<?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'ta003' || $key == 'ta014'){
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
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 轉撥單建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('inv/invi08/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	<?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('inv/invi08/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('inv/invi08/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>
	  </div>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/inv/invi08/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	
       <?php 
	  if(!isset($sysma200)) { $sysma200=$this->session->userdata('sysma200'); }
	  if(!isset($sysma201)) { $sysma201=$this->session->userdata('sysma201'); }  ?>
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="normal14y"  width="10%"><span class="required">轉撥單別：</span> </td>
        <td class="normal14a"  width="22%"><input tabIndex="1" id="invi04"    onKeyPress="keyFunction()" ondblclick="search_invi04_window()"  name="ta001"  onchange="check_invi04(this);"  value="<?php echo $ta001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showinvi04disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="invi04disp"> <?php    echo $ta001disp; ?> </span></td>
	    <td class="normal14y" width="10%" >單據日期： </td>
        <td class="normal14a"  width="24%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta014" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta014"  value="<?php echo $ta014; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ta014,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		 <td class="normal14y" width="10%" ><span class="required">轉撥單號：</span> </td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="ta002" onKeyPress="keyFunction()"  name="ta002" value="<?php echo $ta002; ?>" size="20" type="text" required /><span id="ta002disp" ></span></td>
	  </tr>		
	  <tr>
		<td class="normal14z">部門代號：</td>
        <td  class="normal14"  ><input tabIndex="9" id="cmsi05" ondblclick="search_cmsi05_window()" onKeyPress="keyFunction()" name="ta004" onblur="check_cmsi05(this);check_rate(this);"  value="<?php echo $ta004; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi05disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
          <span id="cmsi05disp"> <?php    echo $ta004disp; ?> </span></td>	    
	    <td class="normal14z" >廠別：</td>
        <td class="normal14a" ><input tabIndex="9" id="cmsi02" ondblclick="search_cmsi02_window()" onKeyPress="keyFunction()" name="ta008" onblur="check_cmsi02(this);check_rate(this);"  value="<?php echo $ta008; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
          <span id="cmsi02disp"> <?php    echo $ta008disp; ?> </span></td>
		<td class="normal14z" >備註：</td>
        <td class="normal14a" ><input type="text" tabIndex="6"  onKeyPress="keyFunction()" id="ta005" name="ta005"   value="<?php echo $ta005; ?>"  /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >件數：</td>
        <td class="normal14" ><input type="text" tabIndex="7"  onKeyPress="keyFunction()" id="ta010" name="ta010"   value="<?php echo $ta010; ?>"  /></td>
		<td class="normal14z">確認碼：</td>
        <td  class="normal14"  ><select id="ta006" onKeyPress="keyFunction()" name="ta006"  onchange="selappr(this)" tabIndex="8">
            <option <?php if($ta006 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($ta006 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($ta006 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>  
	    <td class="normal14" ></td>						
        <td  class="normal14"  ></td>
	  </tr>
	   
	   <tr>
	    <td class="normal14z" >轉撥日期：</td>
        <td class="normal14"  ><input type="text"   tabIndex="10"  readonly="value" onKeyPress="keyFunction()"   name="ta003" value="<?php echo $ta003; ?>" style="background-color:#EBEBE4"  /></td>
	     <td class="normal14z">確認者：</td>
        <td  class="normal14"  ><input tabIndex="11" id="ta015" readonly="value" onKeyPress="keyFunction()"  name="ta015" value="<?php echo $ta015; ?>" size="10" type="text" style="background-color:#EBEBE4"  /></td>
  
		 <td class="normal14z">簽核狀態：</td>
        <td  class="normal14"  ><select id="ta017" tabIndex="12" readonly="value" onKeyPress="keyFunction()" name="ta017"   style="background-color:#EBEBE4" >
            <option <?php if($ta017 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($ta017 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($ta017 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($ta017 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($ta017 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($ta017 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($ta017 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($ta017 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
		  
		<td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" /></td>
         <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" /></td>
	  </tr>
	</table>
	 <div>
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
                  <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
                  <tr>
             <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			 <td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
            </tr>
			  
			
        </tbody>
            </tfoot>
          </table>
        </div>
	
	  <!-- 合計     -->
		     <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span>
				</span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;"> 　總數量：</b></td>
				<td ><input type='text' readonly="value" name='ta011' id="ta011"  value="<?php echo $ta011; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　　　　　　　總金額：</b></td>
				<td ><input type='text' readonly="value" name='ta012' id="ta012"  value="<?php echo $ta012; ?>"  style="background-color:#EBEBE4" /></td>
				<!-- enter 鍵不會跳下一列       -->
				<input id="select_rows" style="display:none;"/>	
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	
	<!--<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('inv/invi08/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	<?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('inv/invi08/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('inv/invi08/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>	
	</div> -->
	  <br>
      </form>
	  
	  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>
     </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  
  </div> <!-- div-3 -->
 </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php  include_once("./application/views/funnew/fun_disabled_v.php"); ?>