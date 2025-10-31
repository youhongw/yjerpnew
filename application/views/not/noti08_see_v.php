 <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'tj002' || $key == 'tj004'){
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
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 抵押資料建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti08/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	
	    <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('not/noti08/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('not/noti08/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>
	  </div>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/not/noti08/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="tab-general"> <!-- div-6 -->
      
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y" width="12%"><span class="required">借款批號：</span></td>
        <td class="normal14a" width="38%"><input tabIndex="1" id="tj001" onKeyPress="keyFunction()"  name="tj001"  value="<?php echo $tj001; ?>" size="12" type="text" required disabled /></td>
	    <td class="normal14y" width="12%" >合約日期： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="38%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tj002" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tj002"  value="<?php echo $tj002; ?>"  size="12" type="text" style="background-color:#FFFFE4" disabled />
	                                       <a href="javascript:;"><img src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top" onclick="scwShow(tj002,event);"></a></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14z">借款銀行：</td>
        <td  class="normal14"  ><input tabIndex="3" id="noti01" onKeyPress="keyFunction()"  onchange="check_noti01(this)" name="noti01" value="<?php echo $tj003; ?>" size="12" type="text" disabled />
		  <a href="javascript:;"><img id="Shownoti01disp" src="<?php echo base_url()?>assets/image/png/bank.png" alt="" align="top"/></a>
          <span id="noti01disp"> <?php   echo $tj003disp.''.$tj003disp1; ?> </span></td>
	    <td class="normal14z">幣別：</td>
        <td  class="normal14"  ><input tabIndex="4" id="cmsi06" onKeyPress="keyFunction()"  onchange="check_cmsi06(this)" name="cmsi06" value="<?php echo $tj005; ?>" size="12" type="text" disabled />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php   echo $tj005disp; ?> </span></td>
	  </tr>
	  <tr>	    
		<td class="normal14z">年利率：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5"   onKeyPress="keyFunction()" id="tj007" name="tj007"   value="<?php echo $tj007; ?>"  size="12" disabled />%</td>
	    <td class="normal14z">融資種類：</td>
        <td  class="normal14"  ><input tabIndex="6" id="noti13" onKeyPress="keyFunction()"  onchange="check_noti13(this)" name="noti13" value="<?php echo $tj016; ?>" size="12" type="text" disabled />
		  <a href="javascript:;"><img id="Shownoti13disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
          <span id="noti13disp"> <?php   echo $tj016disp; ?> </span></td>
	  </tr>
	  <tr>	    
		<td class="normal14z">到期日：</td>
        <td  class="normal14"  ><input tabIndex="7"  ondblclick="scwShow(this,event);"   id="tj004" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tj004"  value="<?php echo $tj004; ?>"  size="12" type="text" style="background-color:#FFFFE4" disabled />
		      <a href="javascript:;"><img src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top" onclick="scwShow(tj004,event);"></a></td>
	    <td class="normal14z">月還款日：</td>
        <td  class="normal14"  ><input type="text" tabIndex="8"   onKeyPress="keyFunction()" id="tj013" name="tj013"   value="<?php echo $tj013; ?>"  size="12" disabled />
		      </td>
	  </tr>
	  <tr>
        <td class="normal14z">還款方式：</td>
        <td  class="normal14"  ><select id="tj010" tabIndex="9"  onKeyPress="keyFunction()" name="tj010"  disabled >
            <option <?php if($tj010 == '1') echo 'selected="selected"';?> value='1'>1.每月平均償還</option>                                                                        
		    <option <?php if($tj010 == '2') echo 'selected="selected"';?> value='2'>2.到期全部償還</option>
            <option <?php if($tj010 == '9') echo 'selected="selected"';?> value='9'>9.其他</option>
		  </select></td>
       <td class="normal14z">還息方式：</td>
        <td  class="normal14"  ><select id="tj011" tabIndex="10"  onKeyPress="keyFunction()" name="tj011" disabled >
            <option <?php if($tj011 == '1') echo 'selected="selected"';?> value='1'>1.每月計息</option>                                                                        
		    <option <?php if($tj011 == '2') echo 'selected="selected"';?> value='2'>2.到期計息</option>
            <option <?php if($tj011 == '9') echo 'selected="selected"';?> value='9'>9.其他</option>
		  </select></td>
	  </tr>
	   <tr>	    
		<td class="normal14z">借款科目：</td>
        <td  class="normal14"  ><input tabIndex="11" id="acti03" onKeyPress="keyFunction()"  onchange="check_acti03(this)" name="acti03" value="<?php echo $tj012; ?>" size="12" type="text" disabled />
		  <a href="javascript:;"><img id="Showacti03disp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
          <span id="acti03disp"> <?php   echo $tj012disp; ?> </span></td>
	    <td class="normal14z">利息科目：</td>
        <td  class="normal14"  ><input tabIndex="12" id="acti03a" onKeyPress="keyFunction()"  onchange="check_acti03a(this)" name="acti03a" value="<?php echo $tj018; ?>" size="12" type="text" disabled />
		  <a href="javascript:;"><img id="Showacti03adisp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
          <span id="acti03adisp"> <?php   echo $tj018disp; ?> </span></td>
		
	  </tr>
	   <tr>
	    <td class="normal14z" >借款金額：</td>
        <td class="normal14"  ><input type="text"  readonly="value" tabIndex="13"   onKeyPress="keyFunction()"   name="tj014" value="<?php echo $tj014; ?>" style="background-color:#F0F0F0"  size="12" disabled /></td>
	    <td class="normal14z" >結案：</td>
		<td class="normal14a"  ><input type="hidden" name="tj017" value="N" />
		<input tabIndex="14" type="checkbox"  id="tj017" onKeyPress="keyFunction()"   name="tj017" <?php if($tj017 == 'Y' ) echo 'checked'; ?>  <?php if($tj017 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  disabled /></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >已還款金額：</td>
        <td class="normal14"  ><input type="text"  readonly="value" tabIndex="15"   onKeyPress="keyFunction()"   name="tj015" value="<?php echo $tj014; ?>" style="background-color:#F0F0F0"  size="12" disabled /></td>
	    <td class="normal14z" >未還款金額：</td>
		<td class="normal14"  ><input type="text"  readonly="value" tabIndex="16"   onKeyPress="keyFunction()"   name="tj01415" value="<?php echo $tj014-$tj015; ?>" style="background-color:#F0F0F0"  size="12" disabled /></td>
	  </tr>
	  <tr>
	    <td class="normal14z">備註：</td>						
        <td class="normal14" colspan="3" ><input type="text" tabIndex="17"   onKeyPress="keyFunction()" id="tj009" name="tj009"  size="120"   value="<?php echo $tj009; ?>"  disabled  /></td>
		<td class="normal14" ></td>						
        <td class="normal14" ></td>
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
				echo "<td class='center'><img src='".base_url()."assets/image/delete.png' title='刪除資料' onclick='del_detail(\"".$val->to001."\",\"".$val->to002."\",\"".$current_product_count."\");' /></td>";
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
               <td style="display:none;">
				<td class="left" valign="top"></td>
				
              </tr>
		<!-- 合計     -->	
	<!--<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti08/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	
	    <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('not/noti08/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('not/noti08/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
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
