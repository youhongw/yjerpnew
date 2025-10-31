 <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'ta003' || $key == 'ta012' || $key == 'ta013' || $key == 'ta007'){
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
  $sysma201 = $this->session->userdata('sysma201');
?>
 <div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 製造命令建立作業 - 修改　　　</h1>
    <button style= "cursor:pointer" form="commentForm" onfocus="$('#moci01').focus();" type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('moc/moci02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  <b style="color: #FF0000;"><span>　BOM展開方式　</span></b><a  href="javascript:;"><img id="Showbomc02a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/>
	  <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
	  ?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('moc/moci02/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
	  <?php } ?>
	  <?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
	  ?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('moc/moci02/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
	  <?php } ?>
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/moc/moci02/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	 
	  <?php  $this->session->set_userdata('key1', $ta001);$this->session->set_userdata('key2', $ta002);?>
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="8%"><span class="required">製令單別：</span> </td>
        <td class="normal14a"  width="25%"><input tabIndex="1" id="moci01"    onKeyPress="keyFunction()" ondblclick="search_moci01_window()"  name="ta001"  onchange="check_moci01(this);"  value="<?php echo $ta001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showmoci01disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="moci01disp"> <?php    echo $ta001disp; ?> </span></td>
	    <td class="normal14y" width="8%" >開單日期： </td>
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta003" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta003"  value="<?php echo $ta003; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ta003,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		<td class="normal14y" width="9%"><span class="required">製令單號：</span></td>
        <td class="normal14a" width="25%"><input tabIndex="3" id="ta002" onKeyPress="keyFunction()"  name="ta002" value="<?php echo $ta002; ?>" size="30" type="text" required /><span id="ta002disp" ></span></td>
	  </tr>	
	  <tr>
		 <td class="normal14z">產品品號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="invi02" onKeyPress="keyFunction()"  ondblclick="search_invi02_window()"  onchange="check_invi02(this)" name="ta006" value="<?php echo $ta006; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showinvi02disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="invi02disp"> <?php   echo $ta006disp; ?> </span></td>
        <td class="normal14z" >品名：</td>
        <td class="normal14a" ><input tabIndex="5" id="ta034" onKeyPress="keyFunction()"  name="ta034" value="<?php echo $ta034; ?>" size="30" type="text" style="background-color:#EBEBE4" /></td>	 
         <td class="normal14z" >規格：</td>
        <td class="normal14a" ><input tabIndex="6" id="ta035" onKeyPress="keyFunction()"  name="ta035" value="<?php echo $ta035; ?>" size="30" type="text" style="background-color:#EBEBE4" /></td>	 	
	</tr>
		
	  <tr>
	    <td class="normal14z" >單位：</td>
        <td class="normal14a" ><input tabIndex="7" id="ta007" onKeyPress="keyFunction()"  name="ta007" value="<?php echo $ta007; ?>" size="10" type="text" style="background-color:#EBEBE4" /></td>
	     <td class="normal14z">性質：</td>
       <td  class="normal14"  ><select id="ta030" onKeyPress="keyFunction()" name="ta030"  tabIndex="8">
            <option <?php if($ta030 == '1') echo 'selected="selected"';?> value='1'>1廠內製令</option>                                                                        
		    <option <?php if($ta030 == '2') echo 'selected="selected"';?> value='2'>2託外製令</option>
		  </select></td>
	   <td class="normal14z">狀態碼：</td>
          <td  class="normal14"  ><select id="ta011" onKeyPress="keyFunction()" name="ta011"  tabIndex="9">
            <option <?php if($ta011 == '1') echo 'selected="selected"';?> value='1'>1未生產</option>                                                                        
		    <option <?php if($ta011 == '2') echo 'selected="selected"';?> value='2'>2已發料</option>
			<option <?php if($ta011 == '3') echo 'selected="selected"';?> value='3'>3生產中</option>
		    <option <?php if($ta011 == 'Y') echo 'selected="selected"';?> value='Y'>Y已完工</option>
			<option <?php if($ta011 == 'y') echo 'selected="selected"';?> value='y'>y指定完工</option>
		  </select></td>
	  </tr>
	    <tr>
	     <td class="normal14z">急料：</td>
        <td  class="normal14"  ><input type="hidden" name="ta044" value="N" />
		<input type='checkbox' tabIndex="10" id="ta044" onKeyPress="keyFunction()" name="ta044" <?php if($ta044 == 'Y' ) echo 'checked'; ?>  <?php if($ta044 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
	   <td class="normal14z">確認碼：</td>
          <td  class="normal14"  ><select id="ta013" onKeyPress="keyFunction()" name="ta013" onChange="selappr(this)" tabIndex="6">
            <option <?php if($ta013 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($ta013 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($ta013 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td> 
		<td class="normal14z" >列印：</td>
        <td class="normal14a" ><input tabIndex="12" id="ta031" onKeyPress="keyFunction()"  name="ta031" value="<?php echo $ta031; ?>" size="10" type="text" style="background-color:#EBEBE4" /></td>
		  <td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" /></td>
         <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" /></td>
	  </tr>
		
	</table>
	
	<div class="abgne_tab"> <!-- div-7 -->
		<ul class="tabs">
			<li><a href="#tab1">時程產量</a></li>
		    <li><a href="#tab2">廠內託外</a></li>
		    <li><a href="#tab3">進階資料</a></li>	
		</ul>

    <div class="tab_container"> <!-- div-8 -->
	
	<!--   基本資料 -->	
	<div id="tab1" class="tab_content">
      <table class="form14">     <!-- 表格 -->
	<tr>
	   <td class="normal14y"  width="8%" > 預計產量：</td>
       <td class="normal14a"  width="25%" ><input type="text" tabIndex="13" id="ta015"    onKeyPress="keyFunction()"    name="ta015" value="<?php echo $ta015; ?>"  /></td>
	   <td class="normal14y"  width="8%" > 預計開工：</td>
       <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta009" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta009"  value="<?php echo $ta009; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ta009,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		
		<td class="normal14y"  width="9%" > BOM日期：</td>
       <td class="normal14a"  width="25" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta004" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta004"  value="<?php echo $ta004; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ta004,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	 </tr>	
	 <tr>
	   <td class="normal14z"  > 已領套數：</td>
       <td class="normal14a"  ><input type="text" tabIndex="16" id="ta016"    onKeyPress="keyFunction()"    name="ta016" value="<?php echo $ta016; ?>"  /></td>
	   <td class="normal14z"  > 預計完工：</td>
       <td class="normal14a"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta010" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta010"  value="<?php echo $ta010; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ta010,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		<td class="normal14z"  > 確認日：</td>
       <td class="normal14a"  ><input type="text" tabIndex="18" id="ta040"   onKeyPress="keyFunction()"    name="ta040" value="<?php echo $ta040; ?>"  /></td>
	 </tr>
	  <tr>
	   <td class="normal14z"  > 已生產數：</td>
       <td class="normal14a"  ><input type="text" tabIndex="19" id="ta017"    onKeyPress="keyFunction()"    name="ta017" value="<?php echo $ta017; ?>"  /></td>
	   <td class="normal14z"  > 實際開工：</td>
       <td class="normal14a"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta012" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta012"  value="<?php echo $ta012; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ta012,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	   <td class="normal14z"  > 確認者：</td>
       <td class="normal14a"  ><input type="text" tabIndex="21" id="ta041"   onKeyPress="keyFunction()"    name="ta041" value="<?php echo $ta041; ?>"  /></td>
	 </tr>
	<tr>
	   <td class="normal14z"  > 報廢數量：</td>
       <td class="normal14a"  ><input type="text" tabIndex="22" id="ta018"    onKeyPress="keyFunction()"    name="ta018" value="<?php echo $ta018; ?>"  /></td>
	   <td class="normal14z"  > 實際完工：</td>
       <td class="normal14a"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta014" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta014"  value="<?php echo $ta014; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ta014,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		 <td  class="normal14z" >簽核狀態：</td>
        <td class="normal14"><select id="ta049" tabIndex="24" readonly="value" onKeyPress="keyFunction()" name="ta049"   style="background-color:#EBEBE4" disabled="disabled">
            <option <?php if($ta049 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($ta049 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($ta049 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($ta049 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($ta049 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($ta049 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($ta049 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($ta049 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
	 </tr> 
	</table>
	</div>
	
	<!--  廠內託外 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="10%">生產廠別：</td>
       <td class="normal14a"  width="40%" ><input tabIndex="9" id="cmsi02" ondblclick="search_cmsi02_window()" onKeyPress="keyFunction()" name="ta019" onblur="check_cmsi02(this);check_rate(this);"  value="<?php echo $ta019; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
          <span id="cmsi02disp"> <?php    echo $ta019disp; ?> </span></td>
	   <td class="normal14y"  width="10%" >幣別：</td>
       <td class="normal14a"  width="40%" ><input tabIndex="10" id="cmsi06" ondblclick="search_cmsi06_window()" onKeyPress="keyFunction()" name="ta042" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $ta042; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $ta042disp; ?> </span></td>
	 </tr>	
	   <tr>
	    <td  class="normal14z" >入庫庫別：</td>
        <td  class="normal14"  ><input  type="text"  tabIndex="14" id="cmsi03" class="cmsi03" onKeyPress="keyFunction()" name="ta020"  onchange="check_cmsi03(this)"  value="<?php echo  $ta020; ?>"     size="10"    />
		 <a href="javascript:;"><img id="Showcmsi03disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
         <span id="cmsi03disp"><?php  echo $ta020disp; ?></span></td>	   
	    <td  class="normal14z">匯率：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="28" id="ta043"  onKeyPress="keyFunction()"   name="ta043" value="<?php echo $ta043; ?>"   /></td>
	  </tr>
	   <tr>
	    <td  class="normal14z" >生產線別：</td>
        <td  class="normal14"  ><input type="text" tabIndex="15" id="cmsi04" class="cmsi04" onKeyPress="keyFunction()" name="ta021" onchange="check_cmsi04(this)"  value="<?php echo $ta021; ?>"  size="10"   />
		<a href="javascript:;"><img id="Showcmsi04disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
         <span id="cmsi04disp"><?php  echo $ta021disp; ?></span></td>	   
	    <td  class="normal14z">加工單價：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="30" id="ta022"  onKeyPress="keyFunction()"   name="ta022" value="<?php echo $ta022; ?>"   /></td>
	  </tr>
       <tr>
	    <td  class="normal14z" >加工廠商：</td>
        <td  class="normal14"  ><input tabIndex="4" id="puri01" onKeyPress="keyFunction()" onfocus="check_title_no();" ondblclick="search_puri01_window()"  onchange="check_puri01(this)" name="ta032" value="<?php echo $ta032; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showpuri01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="puri01disp"> <?php   echo $ta032disp; ?> </span></td>   
	    <td  class="normal14z">加工單位：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="32" id="ta023"  onKeyPress="keyFunction()"   name="ta023" value="<?php echo $ta023; ?>"   /></td>
	  </tr>	
	  
	</table>
 
	</div> 	
	<!--  進階資料 -->
	<div id="tab3" class="tab_content"> <!-- div-8 --> 
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="10%">母製令單別：</td>
       <td class="normal14a"  width="24%" ><input type="text" tabIndex="33"   onKeyPress="keyFunction()" id="ta024" name="ta024"   value="<?php echo $ta024; ?>"   /></td>
	   <td class="normal14y"  width="10%" >母製令單號：</td>
       <td class="normal14a"  width="24%" ><input type="text" tabIndex="34"   onKeyPress="keyFunction()" id="ta025" name="ta025"   value="<?php echo $ta025; ?>"   /></td>
       <td  class="normal14a" width="8%"></td>	
       <td  class="normal14a" width="24%"></td>		   
	</tr>
	  <tr>
	   <td class="normal14z" >訂單單別：</td>
       <td class="normal14"  ><input tabIndex="35" id="ta026" onKeyPress="keyFunction()" name="copq06a" onchange="startcopq06a(this)"  value="<?php echo $copq06a; ?>"  type="text"   /><a href="javascript:;"><img id="Showcopq06a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
       <span id="copq06adisp" > <?php    echo $copq06adisp; ?> </span></td>	
	   <td class="normal14z"  >訂單單號：</td>
       <td class="normal14"   ><input type="text" tabIndex="36"   onKeyPress="keyFunction()" id="ta027" name="ta027"   value="<?php echo $ta027; ?>"   /></td>
	   <td class="normal14z"  >訂單序號：</td>
       <td class="normal14"   ><input type="text" tabIndex="37"   onKeyPress="keyFunction()" id="ta028" name="ta028"   value="<?php echo $ta028; ?>"   /></td>
	 </tr>
	   <tr>
	    <td  class="normal14z" >計劃批號：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="38" id="ta033"  onKeyPress="keyFunction()"   name="ta033" value="<?php echo $ta033; ?>"   /></td>	   
	    <td  class="normal14z">備註：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="39" id="ta029"  onKeyPress="keyFunction()"   name="ta029" value="<?php echo $ta029; ?>"   /></td>
	     <td  class="normal14a" ></td>	
       <td  class="normal14a" ></td>		   
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
      
   	<!--   明細0  --> 
		 
		<!--  依照資料庫紀錄的明細先列一遍 原0會由1加  -->
            <?php $current_product_count = 0; ?>
			<?php foreach($body_data as $key => $val){
				$current_product_count++;
				echo "<tbody id='product_row_".$current_product_count."' class='product_row' >";
				echo "<tr>";
				echo "<td class='center'><img src='".base_url()."assets/image/delete.png' title='刪除資料' onclick='del_detail(\"".$val->tb001."\",\"".$val->tb002."\",\"".$val->tb003."\",\"".$current_product_count."\");' /></td>";
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
	 
	 <!-- 合計     -->
		 <!--     <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span>
				
				</span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣未稅總額：</b></td>
				<td ><input type='text' readonly="value" name='ta028' id="ta028" size="8" value="<?php echo $ta028; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta019' id="ta019" size="8" value="<?php echo $ta019; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣合計金額：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot"><?php echo $ta028+$ta019; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣未稅總額：</b></td>
				<td ><input type='text' readonly="value" name='ta031' id="ta031" size="8" value="<?php echo $ta031; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta032' id="ta032" size="8" value="<?php echo $ta032; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣合計金額：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot1"><?php echo $ta031+$ta032; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　合計數量：</b></td>
				<td ><input type='text' readonly="value" name='ta026' id="ta026" size="8" value="<?php echo $ta026; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span> 		<!-- 合計     -->
     
   
	</div> <!-- div-8 -->
	
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('moc/moci02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  <b style="color: #FF0000;"><span>　BOM展開方式　</span></b><a  href="javascript:;"><img id="Showbomc02a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/>
	  <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
	  ?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('moc/moci02/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
	  <?php } ?>
	  <?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
	  ?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('moc/moci02/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
	  <?php } ?>
	  </div> 
	  </div> <!-- div-加 -->
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
 <form action="<?php echo base_url()?>index.php/moc/moci02/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
 <?php  include_once("./application/views/funnew/moci01a_funmjs_v.php"); ?> <!-- 製令單別51 -->
<?php  include_once("./application/views/funnew/invi02e_funmjs_v.php"); ?>  <!-- 品號 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/puri01_funmjs_v.php"); ?>  <!-- 廠商回傳多欄 -->
<?php  include_once("./application/views/funnew/cmsi03_funmjs_v.php"); ?>  <!-- 庫別 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->
<?php  include_once("./application/views/funnew/cmsi04_funmjs_v.php"); ?>  <!-- 線別 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/moci02_fundjs_v.php"); ?>  <!-- 明細開視窗 -->