 <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'td004' || $key == 'td016' ){
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 貨運通知單建立作業 - 查看</h1>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/eps/epsi07/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="tab-general"> <!-- div-6 -->
      
	<table class="form14"  >     <!-- 頭部表格 -->
	<tr>
	    <td class="start14a"  width="9%"><span class="required">S/INO單別：</span></td>   <!--onchange="startepsi01(this);check_title_no();"    -->
        <td class="normal14a"  width="25%"><input tabIndex="1" id="epsi01"   ondblclick="search_epsi01_window()" onKeyPress="keyFunction()"   name="td001" onfocus="selverify();" onchange="check_epsi01(this);check_title_no();"  value="<?php echo $td001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showepsi01disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="epsi01disp"> <?php    echo $td001disp; ?> </span></td>
	    <td class="normal14a" width="8%" >單據日期： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="td016" onKeyPress="keyFunction()"  onblur="dateformat_ymd(this);check_title_no();" name="td017"  value="<?php echo $td016; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(td016,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	    <td class="start14a" width="9%"><span class="required">S/INO單號：</span></td>
        <td class="normal14a" width="24%"><input tabIndex="3" id="td002" onKeyPress="keyFunction()" onfocus="check_title_no();" name="td002"  value="<?php echo $td002; ?>" size="12" type="text" required /></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a"  >出貨廠別：</td>
        <td class="normal14" ><input tabIndex="13" id="cmsi02" ondblclick="search_cmsi02_window()" onKeyPress="keyFunction()" name="td003" onblur="check_cmsi02(this);"  value="<?php echo $td003; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
          <span id="cmsi02disp"> <?php    echo $td003disp; ?> </span></td>
	    <td class="normal14">運輸公司.：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5"   onKeyPress="keyFunction()" id="td005" name="td005"   value="<?php echo $td005; ?>"  size="12" /></td>
	    <td class="normal14">船名：</td>
        <td  class="normal14"  ><input type="text" tabIndex="6" readonly="value"  onKeyPress="keyFunction()" id="td006" name="td006"   value="<?php echo $td006; ?>" size="12" />
	       </td>
	  </tr>
	  
		 <tr>
	    <td class="normal14" >SIZE：</td>		
        <td class="normal14"  ><input type="text"   tabIndex="11"   onKeyPress="keyFunction()"    name="td007" value="<?php echo $td007; ?>"   /></td>
	    <td class="normal14" >航次：</td>		
        <td class="normal14"  ><input type="text"    tabIndex="11"   onKeyPress="keyFunction()"    name="td008" value="<?php echo $td008; ?>"   /></td>
	    <td class="normal14" >業務人員：</td>		
        <td class="normal14"  ><input tabIndex="6" id="cmsi09" ondblclick="search_cmsi09_window()" onKeyPress="keyFunction()" name="td009" onblur="check_cmsi09(this)"  value="<?php echo $td009; ?>"  type="text"  size="12"  />
		  <a href="javascript:;"><img id="Showcmsi09disp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
          <span id="cmsi09disp"> <?php    echo $td009disp; ?> </span></td>
		  </tr>
		<tr>
	    <td class="normal14" >貨櫃場：</td>		
        <td class="normal14"  ><input type="text"   tabIndex="11"   onKeyPress="keyFunction()"    name="td007" value="<?php echo $td007; ?>"   /></td>
	    <td class="normal14" >備註：</td>		
        <td class="normal14" colspan="2" ><input type="text"    tabIndex="11"   onKeyPress="keyFunction()"    name="td008" value="<?php echo $td008; ?>" size="60"  /></td>
	    <td class="normal14" ></td>		
        <td class="normal14"  ></td>
	    </tr>
	   <tr>
        <td class="normal14" >列印次數：</td>		
        <td class="normal14"  ><input type="text" id="td016"   tabIndex="17"   onKeyPress="keyFunction()"    name="td016" value="<?php echo $td016; ?>"   /></td>
	  	<td class="normal14a"  >運貨日期：</td>
        <td class="normal14" ><input type="text" tabIndex="18" readonly="value"  onKeyPress="keyFunction()" id="td004" name="td004"   value="<?php echo $td004; ?>" size="12"  style="background-color:#F0F0F0"/></td>
	    <td class="normal14a"  ></td>
        <td class="normal14" ></td>
		</tr>
		 <tr>
	    <td class="normal14">簽核狀態：</td>
        <td class="normal14"  ><select id="td018" tabIndex="19" readonly="value" onKeyPress="keyFunction()" name="td018"   style="background-color:#F0F0F0" >
            <option <?php if($td018 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($td018 == '0') echo 'selected="selected"';?> value='0'>0.待處理</option>
            <option <?php if($td018 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($td018 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($td018 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($td018 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($td018 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($td018 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
        <td class="normal14">確認碼：</td>
        <td  class="normal14"  ><select id="verify" onKeyPress="keyFunction()" name="td013" onChange="selverify(this)" tabIndex="20">
            <option <?php if($td013 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($td013 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($td013 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>
	     <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="21" readonly="value"  onKeyPress="keyFunction()" id="td017" name="td017"   value="<?php echo $td017; ?>" style="background-color:#F0F0F0" size="12" /></td>
	    </tr>
	</table>
	
	
	
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
				echo "<td class='center'><img src='".base_url()."assets/image/delete.png' title='刪除資料' onclick='del_detail(\"".$val->te001."\",\"".$val->te002."\",\"".$val->te003."\",\"".$current_product_count."\");' /></td>";
				foreach($usecol_array as $k => $v){
					if($k=="te010disp"  ){
						//$s = substr($val->$k,0,4)."/".substr($val->$k,4,2)."/".substr($val->$k,6,2);
					//	$s = stringtodate("Y/m/d",$val->$k);
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
		     <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span></span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　總重：</b></td>
				<td ><input type='text' readonly="value" name='td010' id="td010" size="8" value="<?php echo $td010; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　材積：</b></td>
				<td ><input type='text' readonly="value" name='td011' id="td011" size="8" value="<?php echo $td011; ?>"  style="background-color:#F0F0F0" /></td>
			
				<td class="right" valign="top"><b style="color: #003A88;">　　件數：</b></td>
				<td ><input type='text' readonly="value" name="td012" id="td012" size="8" value="<?php echo $td012; ?>"  style="background-color:#F0F0F0" /></td>
				
					<input id="select_rows" style="display:none;"/>
				<td class="left" valign="top"></td>
              </tr>
		<!-- 合計     -->	
	<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('eps/epsi07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	    <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('eps/epsi07/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('eps/epsi07/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
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