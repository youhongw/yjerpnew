  <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'tc004' || $key == 'tc005' || $key == 'tc007'){
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 應收票據資料建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti04/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	
	    <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('not/noti04/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('not/noti04/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>	
	  </div>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/not/noti04/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="tab-general"> <!-- div-6 -->
      
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
		<td class="normal14y" width="8%">客戶代號：</td>
        <td  class="normal14a" width="25%" >
			<input tabIndex="1" id="copi01" onKeyPress="keyFunction()"  onchange="check_copi01(this)" name="copi01" value="<?php echo $tc013; ?>" size="12" type="text" disabled="disabled" />
			<a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
			<span id="copi01disp"> <?php   echo $tc013disp; ?> </span>
		</td>
		
	    <td class="normal14y" width="8%" >收票日： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" >
			<input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tc004" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="tc004"  value="<?php echo $tc004; ?>"  size="12" type="text" disabled="disabled"  />
		</td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14z">付款銀行：</td>
        <td class="normal14">
			<input tabIndex="3" id="noti01" onKeyPress="keyFunction()"  onchange="check_noti01(this)" name="noti01" value="<?php echo $tc008; ?>" size="12" type="text" disabled="disabled" />
			<a href="javascript:;"><img id="Shownoti01disp" src="<?php echo base_url()?>assets/image/png/bank.png" alt="" align="top"/></a>
		</td>
		
	    <td class="normal14"></td>
	  </tr>
		
	</table>
	
	<div class="abgne_tab"> <!-- div-7 頁標籤-->
		<ul class="tabs">
		  <li><a href="#tab1"  accesskey="a">票據資料a</a></li>
		  <li><a href="#tab2"  accesskey="b">收款資料b</a></li>
		</ul>
		
    <div class="tab_container"> <!-- div-8 -->
	<!--   基本資料1 -->
	<div id="tab1" class="tab_content">
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y"  width="12%"><span class="required">票號：</span></td>
        <td class="normal14a"  width="36%" >
			<input type="text" tabIndex="4" onKeyPress="keyFunction()" id="tc001"  name="tc001"  onblur=""    value="<?php echo  $tc001; ?>"   size="20"  disabled="disabled" />
		</td>
		
	    <td class="normal14y"  width="12%">入帳日數：</td>  <!-- onchange="startcmsi09(this)"     -->
        <td class="normal14a"  width="36%" >
			<input tabIndex="5" id="tc006" onKeyPress="keyFunction()" name="tc006" onblur=""  value="<?php echo $tc006; ?>"  type="text"  size="20"  disabled="disabled"/>
		</td>
	  </tr>
	  
	   <tr>
	    <td class="normal14z"  >幣別：</td>
        <td class="normal14" >
			<input tabIndex="6" id="cmsi06" onKeyPress="keyFunction()" name="cmsi06" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $tc002; ?>"  type="text"   size="20" disabled="disabled" />
			<a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
			<span id="cmsi06disp"> <?php    echo $tc002disp; ?> </span>
		</td>
		
	    <td class="normal14z" >預兌日：</td>		
        <td class="normal14"  >
			<input type="text" id="tc007"   tabIndex="7" ondblclick="scwShow(this,event);" onchange="dateformat_ymd(this);"  onKeyPress="keyFunction()"    name="tc007" value="<?php echo $tc007; ?>"  size="20" style="background-color:#FFFFE4" disabled="disabled" />
		</td>
	  </tr>
	  
	  <tr>
		<td class="normal14z" >匯率：</td>		
        <td class="normal14"  >
			<input type="text" id="exchange_rate"   tabIndex="8"   onKeyPress="keyFunction()"    name="tc027" value="1"  size="20" disabled="disabled"/>
		</td>
	    
		<td  class="normal14z" >票據種類：</td>
        <td  class="normal14"  >
			<input tabIndex="9" id="cmsi16disp2" onKeyPress="keyFunction()" name="cmsi16disp2" onblur=""   value="<?php echo  $tc010; ?>"   size="20"   type="text" disabled="disabled" />
		</td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >票面金額：</td>		
        <td class="normal14"  >
			<input type="text" id="tc003"   tabIndex="10"   onKeyPress="keyFunction()"    name="tc003" value="<?php echo $tc003; ?>"  size="20" disabled="disabled"/>
		</td>

	    <td class="normal14z" >客票：</td>
        <td class="normal14"  >
			<input tabIndex="11" id="tc011" name="tc011" value="Y" onKeyPress="keyFunction()" type="checkbox" disabled="disabled"/>
		</td>
	  </tr>
		
	  <tr>
	    <td class="normal14z" >到期日：</td>		
        <td class="normal14"  >
			<input type="text" id="tc005" ondblclick="scwShow(this,event);" onchange="dateformat_ymd(this);"  tabIndex="12"   onKeyPress="keyFunction()"    name="tc005" value="<?php echo $tc005; ?>"  size="20" style="background-color:#FFFFE4" disabled="disabled" />
		</td>

	    <td class="normal14z" >目前票況：</td>
        <td class="normal14"  >
			<input type="text"  readonly="value" tabIndex="13"   onKeyPress="keyFunction()" id="tc012" name="tc012" value="<?php echo $tc012; ?>" style="background-color:#E7EFEF"  size="20" disabled="disabled"/>
		</td>
		<script>
			$(document).ready(function(){
				$('#tc012').val('1:收票');
			});
		</script>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >付款帳號：</td>		
        <td class="normal14"  >
			<input type="text" id="noti01disp2" readonly="value"  tabIndex="14"   onKeyPress="keyFunction()"    name="noti01disp2" value="<?php echo $tc009 ?>"  size="20" style="background-color:#F0F0F0" disabled="disabled"/>
		</td>

	    <td class="normal14z" >託收碼：</td>
        <td class="normal14"  >
			<input tabIndex="15" id="tc021" name="tc021" value="Y" onKeyPress="keyFunction()" type="checkbox" disabled="disabled" />
		</td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >銀行名稱：</td>		
        <td class="normal14"  >
			<input type="text" id="noti01adisp"  readonly="value"  tabIndex="16"   onKeyPress="keyFunction()"    name="noti01adisp" value="<?php echo $noti01adisp; ?>"  size="20" style="background-color:#F0F0F0" disabled="disabled"/>
		</td>
	  </tr>
	</table>
	</div>    <!--  end 標籤1 -->
	
	<!--  地址 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="12%" >部門代號：</td>		
        <td class="normal14" width="44%" >
			<input type="text" id="cmsi05"   tabIndex="17"   onKeyPress="keyFunction()" onblur="check_cmsi05(this)" name="cmsi05" value="<?php echo $tc015; ?>"  size="12" disabled="disabled" />
			<a href="javascript:;"><img id="Showcmsi05disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
			<span id="cmsi05disp" > <?php    echo $tc015disp; ?> </span></td>
		</td>
		  
		  
	    <td class="normal14y" width="14%"  >業務員代號：</td>
        <td class="normal14" width="28%" >
			<input type="text" tabIndex="18"   onKeyPress="keyFunction()" id="cmsi09"  onblur="check_cmsi09(this)" name="cmsi09" value="<?php echo $tc016; ?>"  size="12" disabled="disabled" />
			<a href="javascript:;"><img id="Showcmsi09disp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
			<span id="cmsi09disp"> <?php    echo $tc016disp; ?> </span></td>
		</td>
	  </tr>			  		  
		  
	  <tr>
	    <td class="normal14z" >收款單號：</td>		
        <td class="normal14"  >
			<input type="text" id="acri03" name="acri03"  tabIndex="19"   onKeyPress="keyFunction()"  onblur="check_acri03(this)"  name="tc017" value="<?php echo $tc017; ?>"  size="12" disabled="disabled" />
			<a href="javascript:;"><img id="Showacri03disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
			<input type="text" id="acri03disp"   tabIndex="20"   onKeyPress="keyFunction()"    name="acri03disp" value="<?php echo $tc018; ?>"  size="12" disabled="disabled"/>
			<input type="text" id="acri03disp2"   tabIndex="21"   onKeyPress="keyFunction()"    name="acri03disp2" value="<?php echo $tc019; ?>"  size="12" disabled="disabled"/>
		</td>
		<td class="normal14"></td>
		<td class="normal14"></td>
		<td></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14z" >票據科目：</td>		
        <td class="normal14"  >
			<input tabIndex="22" id="acti03" onKeyPress="keyFunction()" name="acti03" onblur="check_acti03(this);"  value="<?php echo $tc020; ?>"  type="text"   size="12" disabled="disabled"/>
			<a href="javascript:;"><img id="Showacti03disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
			<span id="acti03disp"> <?php echo $tc020disp; ?> </span>
		</td>
		
		<td class="normal14"></td>
		<td class="normal14"></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >對方科目：</td>
        <td class="normal14"  >
			<input tabIndex="23" id="acti03a" onKeyPress="keyFunction()" name="acti03a" onblur="check_acti03a(this);"  value="<?php echo $tc022; ?>"  type="text"   size="12" disabled="disabled"/>
			<a href="javascript:;"><img id="Showacti03adisp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
			<span id="acti03adisp"> <?php echo $tc022disp; ?> </span>
		</td>
	  
		<td class="normal14"></td>
		<td class="normal14"></td>
	  </tr>	
	  
	  <tr>
		<td class="normal14z" >備註：</td>		
        <td class="normal14"  >
			<input type="text" id="tc024"   tabIndex="24"   onKeyPress="keyFunction()"    name="tc024" value="<?php echo $tc024; ?>"  size="12" disabled="disabled"/>
		</td>
	  
		<td class="normal14"></td>
		<td class="normal14"></td>
	  </tr>
	  
	  <tr>
		<td class="normal14z" >託收銀行：</td>		
        <td class="normal14"  >
			<input type="text" id="tc025"   tabIndex="17"   onKeyPress="keyFunction()" readonly="value"   name="tc025" value="<?php echo $tc025; ?>"  size="12" style="background-color:#F0F0F0" disabled="disabled" />
			<input type="text" id="tc025disp"   tabIndex="17"   onKeyPress="keyFunction()"  readonly="value"  name="tc025disp" value="<?php echo $tc025disp; ?>"  size="12" style="background-color:#F0F0F0" disabled="disabled"/>
			<input type="text" id="tc025disp2"   tabIndex="17"   onKeyPress="keyFunction()"  readonly="value"  name="tc025disp2" value="<?php echo $tc025disp2; ?>"  size="12" style="background-color:#F0F0F0" disabled="disabled"/>
		</td>
      
		<td class="normal14"></td>
		<td class="normal14"></td>
	  </tr>
	  
	  <tr>
		<td class="normal14z" >轉付廠商：</td>		
		<td class="normal14"  >
			<input type="text" id="tc026"   tabIndex="17"   onKeyPress="keyFunction()" readonly="value"   name="tc026" value="<?php echo $tc026; ?>"  size="12" style="background-color:#F0F0F0" />
			<input type="text" id="tc026disp"   tabIndex="17"   onKeyPress="keyFunction()"  readonly="value"  name="tc026disp" value="<?php echo $tc026disp; ?>"  size="12" style="background-color:#F0F0F0" />
		</td>
	  
		<td class="normal14"></td>
		<td class="normal14"></td>
	  </tr>
	</table>
 
	</div> 	<!--  end 標籤2 -->
	
	
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
				echo "<td class='center'><img src='".base_url()."assets/image/delete.png' title='刪除資料' onclick='del_detail(\"".$val->tc001."\",\"".$val->td004."\",\"".$val->td003."\",\"".$current_product_count."\");' /></td>";
				foreach($usecol_array as $k => $v){
					if($k=="td003" ){
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
						if($k == 'td004'){
							switch ($val->$k){
								case "":
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".''."' onKeyPress='keyFunction()' ";
									break;
								case 1:
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".'1:收票'."' onKeyPress='keyFunction()' ";
									break;
								case 2:
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".'2:託收'."' onKeyPress='keyFunction()' ";
									break;
								case 3:
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".'3:融資'."' onKeyPress='keyFunction()' ";
									break;
								case 4:
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".'4:轉付'."' onKeyPress='keyFunction()' ";
									break;
								case 5:
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".'5:退票'."' onKeyPress='keyFunction()' ";
									break;
								case 6:
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".'6:兌現'."' onKeyPress='keyFunction()' ";
									break;
								case 7:
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".'7:還票'."' onKeyPress='keyFunction()' ";
									break;
								case 8:
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".'8:呆帳'."' onKeyPress='keyFunction()' ";
									break;		
								case 9:
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".'9:撤票'."' onKeyPress='keyFunction()' ";
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
		      <!--<tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span></span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　訂單金額：</b></td>
				<td ><input type='text' readonly="value" name='tc029' id="tc029" size="8" value="<?php echo $tc029; ?>"  style="background-color:#F0F0F0" /></td>
			
				<td class="right" valign="top"><b style="color: #003A88;">　　稅額：</b></td>
				<td ><input type='text' readonly="value" name='tc030' id="tc030" size="8" value="<?php echo $tc030; ?>"  style="background-color:#F0F0F0" /></td>
			
				<td class="right" valign="top"><b style="color: #003A88;">　　合計金額：</b></td>
			
				<td ><input type='text' readonly="value" name="tc2930" id="tc2930" size="8" value="<?php echo $tc029+$tc030; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總數量：</b></td>
				<td ><input type='text' readonly="value" name='tc031' id="tc031" size="8" value="<?php echo $tc031; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總毛重：</b></td>
				<td ><input type='text' readonly="value" name='tc043' id="tc043" size="8" value="<?php echo $tc043; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總材積：</b></td>
				<td ><input type='text' readonly="value" name='tc044' id="tc044" size="8" value="<?php echo $tc044; ?>"  style="background-color:#F0F0F0" /></td>
				<td style="display:none;">
				<td class="left" valign="top"></td>
				
              </tr>-->
		<!-- 合計     -->	
	<!--<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti04/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	
	    <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('not/noti04/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('not/noti04/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>	
		</div> 
      </form>-->
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
