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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 進貨單資料建立作業 - 新增　　　</h1>
     <div style="float:left;padding-top: 5px; ">
	 <button  style= "cursor:pointer" form="commentForm" onfocus="$('#puri04').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pur/puri09/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 <a  href="javascript:;"><span class="button">　複製採購單據　</span><img id="Showpurc09a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
	 
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pur/puri09/addsave" >	
	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  if(!isset($tg001)) { $tg001=$this->input->post('tg001'); }
	 if(!isset($tg001disp)) { $tg001disp=$this->input->post('tg001disp'); }
	//  $purq04a33disp=$this->input->post('tg001'); 
      $tg002=$this->input->post('tg002');
	  $tg003=date("Y/m/d");
	  $tg005=$this->input->post('tg005'); 
	  $tg005disp=$this->input->post('tg005disp'); 
	//  $tg013=$this->input->post('tg013');	 
	//  $tg014=$this->input->post('tg014');
	  $tg007=$this->input->post('tg007');
	  if(!isset($tg014)) { $tg014=date("Y/m/d"); }
	  if(!isset($tg003)) { $tg003=date("Y/m/d"); }
       
	  if(!isset($tg013)) { $tg013='Y'; }
	
	  $tg020=$this->input->post('tg020');
	  $tg028=$this->input->post('tg028');
	  $tg019=$this->input->post('tg019');
	  $tg026=$this->input->post('tg026');
	  
	  $tg031=$this->input->post('tg031');
	  $tg032=$this->input->post('tg032');
	?>
	 <?php
	   $tg025=$this->input->post('tg025');
	   $tg006=$this->input->post('tg006');
	  // if(!isset($tg007)) { $tg007=0.05; }
	   $tg007=$this->session->userdata('sysma003');
	   $tg030=$this->session->userdata('sysma004');
	   
	  // $tg012=$this->input->post('tg012');
	    if(!isset($tg012)) { $tg012=0; }
	  // $tg042=$this->input->post('tg042');
	   if(!isset($tg042)) { $tg042='N'; }
	//   $tg008=$this->input->post('tg008');
	   if(!isset($tg008)) { $tg008=1; }
	   $tg016=$this->input->post('tg016');
	 
	   $tg011=$this->input->post('tg011');
	   $tg011disp=$this->input->post('tg011disp');
	   
	    $tg004=$this->input->post('tg004');
	    $tg004disp=$this->input->post('tg004disp');
	  //  $cmsq06a=$this->input->post('tg007');
		IF (!isset($tg007)) { $tg007=$this->session->userdata('sysma003');}
	    $tg007disp=$this->input->post('tg007');
		$tg033=$this->input->post('tg033');
	    $tg033disp=$this->input->post('tg033disp');
	  ?>
	   <?php
	   $tg022=$this->input->post('tg022');
	   $tg011=$this->input->post('tg011');
	   $tg009=$this->input->post('tg009');
	   $tg010=$this->input->post('tg010');
	   $tg027=$this->input->post('tg027');
	   $tg023=$this->input->post('tg023');
	   $tg029=$this->input->post('tg029');
	  // $tg030=$this->input->post('tg030'); 稅率
	    if(!isset($tg030)) { $tg030=$this->session->userdata('sysma004'); }
	   $tg024=$this->input->post('tg024');
	   $tg043=$this->input->post('tg043');
	  ?>
	    <?php
	   $tg034=$this->input->post('tg034');
	   $tg035=$this->input->post('tg035');
	   $tg036=$this->input->post('tg036');
	   $tg037=$this->input->post('tg037');
	   $tg038=$this->input->post('tg038');
	   $tg039=$this->input->post('tg039');
	   
	  ?>
	  
  <?php IF ($this->uri->segment(3)=='copybefore') {  ?>
         <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'tg014' || $key == 'tg014'){
		$$key = stringtodate("Y/m/d",$val);   //自訂函數 main_head_v
	}
}
$body_data = $result['body_data'];
$data_count = count($body_data);
  //預設稅率,廠別
//  echo "<pre>";var_dump($body_data);exit;
  
  $stax_rate = $this->session->userdata('sysma004');
  $sysma200 = $this->session->userdata('sysma200');
?>
  
  <?php  } ?> 
   
   <?php 
	  if(!isset($sysma200)) { $sysma200=$this->session->userdata('sysma200'); }
	  if(!isset($sysma201)) { $sysma201=$this->session->userdata('sysma201'); }  ?>
 
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="10%"><span class="required">進貨單別：</span> </td>
        <td class="normal14a"  width="40%"><input tabIndex="1" id="puri04"    onKeyPress="keyFunction()" ondblclick="search_puri04_window()"  name="tg001"  onchange="check_puri04(this);check_title_no();"  value="<?php echo $tg001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showpuri04disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="puri04disp"> <?php    echo $tg001disp; ?> </span></td>
	    <td class="normal14y" width="10%" >單據日期： </td>
          <td class="normal14a"  width="40%"> <input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tg014" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="tg014"  value="<?php echo $tg014; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(tg014,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>	
	  <tr>
	    <td class="normal14z" ><span class="required">進貨單號：</span></td>
        <td class="normal14a" ><input tabIndex="3" id="tg002" onKeyPress="keyFunction()" onfocus="check_title_no();" name="tg002" value="<?php echo $tg002; ?>" size="30" type="text" required /></td>
		 <td class="normal14z">供應廠商：</td>
        <td  class="normal14"  ><input tabIndex="4" id="puri01" onKeyPress="keyFunction()" onfocus="check_title_no();" ondblclick="search_puri01_window()"  onchange="check_puri01(this)" name="tg005" value="<?php echo $tg005; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showpuri01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="puri01disp"> <?php   echo $tg005disp; ?> </span></td>
	  </tr>
		
	  <tr>
	     <td class="normal14z">進貨日期：</td>
        <td  class="normal14"  ><input tabIndex="5"  ondblclick="scwShow(this,event);"   id="tg003" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tg003"  value="<?php echo $tg003; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(tg003,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td></tr>
		   <td class="normal14z">確認碼：</td>
          <td  class="normal14"  ><select id="tg013" onKeyPress="keyFunction()" name="tg013" onChange="selappr(this)" tabIndex="6">
            <option <?php if($tg013 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tg013 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tg013 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td> 
		  <td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" /></td>
         <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" /></td>
	  </tr>
	  
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
		<li><a href="#tab1" accesskey="a">交易資料a</a></li>
		<li><a href="#tab2" accesskey="b">發票資料b</a></li>
		<li><a href="#tab3" accesskey="c">訂金資料c</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  交易資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	 
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="10%">廠別：</td>
       <td class="normal14a"  width="40%" ><input tabIndex="9" id="cmsi02" ondblclick="search_cmsi02_window()" onKeyPress="keyFunction()" name="tg004" onblur="check_cmsi02(this);check_rate(this);"  value="<?php echo $tg004; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
          <span id="cmsi02disp"> <?php    echo $tg004disp; ?> </span></td>
	   <td class="normal14y"  width="10%" > 件數：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="8" id="tg025"   tabIndex="11"   onKeyPress="keyFunction()"    name="tg025" value="<?php echo $tg025; ?>"  /></td>
	 </tr>	
		  
	  <tr>
	   <td class="normal14z"  >幣別：</td>
        <td class="normal14" ><input tabIndex="10" id="cmsi06" ondblclick="search_cmsi06_window()" onKeyPress="keyFunction()" name="tg007" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $tg007; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $tg007disp; ?> </span></td>
	    <td class="normal14z" >匯率：</td>		
        <td class="normal14"  ><input type="text" id="tg008"   tabIndex="10"   onKeyPress="keyFunction()"    name="tg008" value="<?php echo $tg008; ?>"  /></td>
	  </tr>
	  <tr>
	    <td  class="normal14z" >付款條件：</td>
        <td  class="normal14"  ><input tabIndex="14" id="cmsi21" ondblclick="search_cmsi21_window()" onKeyPress="keyFunction()" name="tg033" onblur="check_cmsi21(this);check_rate(this);"  value="<?php echo $tg033; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi21disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
          <span id="cmsi21disp"> <?php    echo $tg033disp; ?> </span></td>		   
	    <td  class="normal14z">廠商單號：</td>		
        <td  class="start14"  ><input type="text"   tabIndex="12" id="tg006"  onKeyPress="keyFunction()"   name="tg006" value="<?php echo $tg006; ?>"   /></td>
	    
	  </tr>
	  <tr>
	    <td class="normal14z">備註：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="13"   onKeyPress="keyFunction()" id="tg016" name="tg016"   value="<?php echo $tg016; ?>"    /></td>
		<td class="normal14z" >列印：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="14" readonly="value"  onKeyPress="keyFunction()" id="tg012" name="tg012"   value="<?php echo $tg012; ?>"  style="background-color:#EBEBE4" /></td>
	  </tr>	
		
	  <tr>
	    <td  class="normal14z" >簽核狀態：</td>
        <td class="normal14"><select id="tg042" tabIndex="15" readonly="value" onKeyPress="keyFunction()" name="tg042"   style="background-color:#EBEBE4" >
            <option <?php if($tg042 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tg042 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($tg042 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tg042 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tg042 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tg042 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tg042 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tg042 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
	    <td class="normal14"></td>
        <td  class="normal14"  ></td>
	  </tr>
	 
	  
	</table>
	</div>
	
<!--	
	<!--  發票資料 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	  
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="10%">統一編號：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="16"   onKeyPress="keyFunction()" id="tg022" name="tg022"   value="<?php echo $tg022; ?>"   /></td>
	   <td class="normal14y"  width="10%" >發票號碼：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="17"   onKeyPress="keyFunction()" id="tg011" name="tg011"   value="<?php echo $tg011; ?>"   /></td>
	 </tr>			  
	 
	  <tr>
	   <td class="normal14z"  >發票聯數：</td>
        <td class="normal14" ><select id="tg009" onKeyPress="keyFunction()" name="tg009"  tabIndex="18">
		    <option <?php if($tg009 == '2') echo 'selected="selected"';?> value='2'>2三聯式</option>
            <option <?php if($tg009 == '1') echo 'selected="selected"';?> value='1'>1二聯式</option> 
            <option <?php if($tg009 == '3') echo 'selected="selected"';?> value='3'>3二聯式收銀機發票</option>
		    <option <?php if($tg009 == '4') echo 'selected="selected"';?> value='4'>4三聯式收銀機發票</option>
            <option <?php if($tg009 == '5') echo 'selected="selected"';?> value='5'>5電子計算機發票</option>
            <option <?php if($tg009 == '6') echo 'selected="selected"';?> value='6'>6免用統一發票</option>	
            <option <?php if($tg009 == 'A') echo 'selected="selected"';?> value='A'>A增值稅專用發票</option>	
            <option <?php if($tg009 == 'B') echo 'selected="selected"';?> value='B'>B普通發票</option>	
            <option <?php if($tg009 == 'C') echo 'selected="selected"';?> value='C'>C免用發票</option>				
		  </select></td>
		<td class="normal14z"  >課稅別：</td>
        <td class="normal14" ><select id="tg010" onKeyPress="keyFunction()" name="tg010" onchange="taxa()" tabIndex="19">
		    <option <?php if($tg010 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php if($tg010 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php if($tg010 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php if($tg010 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php if($tg010 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select></td>
	  </tr>	
	  <tr>
	    <td class="normal14z">發票日期：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="20"   onKeyPress="keyFunction()"  onclick="scwShow(this,event);" id="tg027" name="tg027"   value="<?php echo $tg027; ?>"    /></td>
		<td class="normal14z" >扣底區分：</td>						
        <td  class="normal14"  ><select id="tg023" onKeyPress="keyFunction()" name="tg023"  tabIndex="21">
		    <option <?php if($tg023 == '1') echo 'selected="selected"';?> value='1'>1可扣掋進貨及費用</option>
            <option <?php if($tg023 == '2') echo 'selected="selected"';?> value='2'>2可扣抵固定資產</option> 
            <option <?php if($tg023 == '3') echo 'selected="selected"';?> value='3'>3不可扣抵進貨及費用</option>
		    <option <?php if($tg023 == '4') echo 'selected="selected"';?> value='4'>4不可扣抵固定資產</option>
		  </select></td>
	  </tr>	
	   <tr>
	    <td  class="normal14z" >申報年月：</td>
        <td  class="normal14"  ><input tabIndex="22"  ondblclick="scwShow(this,event);"   id="tg029" onKeyPress="keyFunction()"  onchange="dateformat_ym(this);" name="tg029"  value="<?php echo $tg029; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(tg029,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td></tr>	<td  class="normal14z">營業稅率：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="23" id="tg030"  onKeyPress="keyFunction()"   name="tg030" value="<?php echo $tg030; ?>"   /></td>
	    
	  </tr>
	   <tr>
	    <td  class="normal14z">菸酒註記：</td>						
        <td  class="normal14"  ><input type="hidden" name="tg024" value="N" />
		<input type='checkbox' tabIndex="24" id="tg024" onKeyPress="keyFunction()" name="tg024" <?php if($tg024 == 'Y' ) echo 'checked'; ?>  <?php if($tg024 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
       
	    <td class="normal14z" >隨貨附發票：</td>
        <td class="normal14"><input type="hidden" name="tg043" value="N" />
		<input type='checkbox' tabIndex="25" id="tg043" onKeyPress="keyFunction()" name="tg043" <?php if($tg043 == 'Y' ) echo 'checked'; ?>  <?php if($tg043 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td>       
	    
	  </tr>
	  
	</table>
 
	</div> 	
	<!--  訂金資料 -->
	<div id="tab3" class="tab_content"> <!-- div-8 -->
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="10%">採購單別：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="26"   onKeyPress="keyFunction()" id="tg034" name="tg034"   value="<?php echo $tg034; ?>"   /></td>
	   <td class="normal14y"  width="10%" >採購單號：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="27"   onKeyPress="keyFunction()" id="tg035" name="tg035"   value="<?php echo $tg035; ?>"   /></td>
	 </tr>
	   <tr>
	    <td  class="normal14z" >沖抵金額：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="28" id="tg038"  onKeyPress="keyFunction()"   name="tg038" value="<?php echo $tg038; ?>"   /></td>	   
	    <td  class="normal14z">沖抵稅額：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="29" id="tg039"  onKeyPress="keyFunction()"   name="tg039" value="<?php echo $tg039; ?>"   /></td>
	  </tr>
	  <tr>
	    <td  class="normal14z" >預付待抵單別：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="30" id="tg036" readonly="value" onKeyPress="keyFunction()"   name="tg036" value="<?php echo $tg036; ?>" style="background-color:#EBEBE4"  /></td>	   
	    <td  class="normal14z">預付待抵單號：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="31" id="tg037" readonly="value" onKeyPress="keyFunction()"   name="tg037" value="<?php echo $tg037; ?>" style="background-color:#EBEBE4" /></td>
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
	
	<?php  $current_product_count = 0;//依照資料庫紀錄的明細先列一遍 新增只給初值 ?>
        
	
	<?php IF ($this->uri->segment(3)=='copybefore') {  ?>
	    
	 <!--  依照資料庫紀錄的明細先列一遍 原0會由1加  -->
            <?php $current_product_count = 0; ?>
			<?php foreach($body_data as $key => $val){
				$current_product_count++;
				echo "<tbody id='product_row_".$current_product_count."' class='product_row' >";
				echo "<tr>";
				echo "<td class='center'><img src='".base_url()."assets/image/delete.png' title='刪除資料' onclick='del_detail(\"".$val->th001."\",\"".$val->th002."\",\"".$val->th003."\",\"".$current_product_count."\");' /></td>";
				foreach($usecol_array as $k => $v){
					
						$s = $val->$k;
				
					
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
			<?php   } ?>		
    
		
          <tfoot>
		 
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="23"></td>
            </tr>
          </tfoot>
       </table>
	</div> 	
	<!-- 合計     -->
		     <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span>
				
				</span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　原幣未稅額：</b></td>
				<td ><input type='text' readonly="value" name='tg028' id="tg028" size="8" value="<?php echo $tg028; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　原幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='tg019' id="tg019" size="8" value="<?php echo $tg019; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　原幣合計：</b></td>
				
				<td ><input type='text' readonly="value" name='tg2819' id="tg2819" size="8" value="<?php echo $tg028+$tg019; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　本幣未稅額：</b></td>
				<td ><input type='text' readonly="value" name='tg031' id="tg031" size="8" value="<?php echo $tg031; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　本幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='tg032' id="tg032" size="8" value="<?php echo $tg032; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　本幣合計：</b></td>
				
				<td ><input type='text' readonly="value" name='tg3132' id="tg3132" size="8" value="<?php echo $tg031+$tg032; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　合計數量：</b></td>
				<td ><input type='text' readonly="value" name='tg026' id="tg026" size="8" value="<?php echo $tg026; ?>"  style="background-color:#EBEBE4" /></td>
					<input id="select_rows" style="display:none;"/>
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	  
	<!-- <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pur/puri09/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 <b style="color: #FF0000;"><span>　複製採購單據　</span></b><a  href="javascript:;"><img id="Showpurc09a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/>
	 </div> -->
		</div> 	   
    </form>
	   <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位,交貨庫別,可輸入部份品號或品名下拉視窗選擇,Alt+y跳明細欄位, Alt+w 新增一筆明細,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
	
    </div> <!-- div-6 -->
	
  </div> <!-- div-5 -->
 
</div> <!-- div-4 -->

 
   
	</div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<form action="<?php echo base_url()?>index.php/pur/puri09/delete_detaila" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
<?php  include_once("./application/views/funnew/puri04c_funmjs_v.php"); ?> <!-- 進貨單別34 -->
<?php  include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?>  <!-- 人員 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/puri01_funmjs_v.php"); ?>  <!-- 廠商回傳多欄 -->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?>  <!-- 部門 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->
<?php  include_once("./application/views/funnew/cmsi21_funmjs_v.php"); ?>  <!-- 付款條件 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/puri09_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#puri04').focus();
	}); 	   
</script> 