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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 應付憑單資料建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#ta001').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('acp/acpi02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div>
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/acp/acpi02/addsave" >	
	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  if(!isset($ta001)) { $ta001=$this->input->post('ta001'); }
	 
	 if(!isset($ta001disp)) { $ta001disp=$this->input->post('ta001'); }
	//  $purq04a33disp=$this->input->post('ta001'); 
      $ta002=$this->input->post('ta002');
	  if(!isset($ta034)) { $ta034=date("Y/m/d"); }
	  if(!isset($ta003)) { $ta003=date("Y/m/d"); }
	  $ta004=$this->input->post('ta004'); 
	  $ta004disp=$this->input->post('ta004'); 
       
	  if(!isset($ta031)) { $ta031='N'; }
	  if(!isset($ta033)) { $ta033='N'; }
	  if(!isset($ta044)) { $ta044='N'; }
	  if(!isset($ta024)) { $ta024='Y'; }
	  if(!isset($ta035)) { $ta035=$username; }
	  
	  $ta028=$this->input->post('ta028');
	  $ta029=$this->input->post('ta029');
	  $ta037=$this->input->post('ta037');
	  $ta038=$this->input->post('ta038');
	  $ta030=$this->input->post('ta030');
	 
	?>
	 <?php
	   
	  // if(!isset($ta007)) { $ta007=0.05; } 幣別 稅率
	   $cmsq06a=$this->session->userdata('sysma003');
	   $ta036=$this->session->userdata('sysma004');
	   
	   
	   if(!isset($ta009)) { $ta009=1; }
	  
	   $ta021=$this->input->post('ta021');
	   $ta019=$this->input->post('ta019');
	   $ta020=$this->input->post('ta020');
	   $ta040=$this->input->post('ta040');
	   $ta041=$this->input->post('ta041');
       $ta042=$this->input->post('ta042');	
       $ta027=$this->input->post('ta027');
       $ta026=$this->input->post('ta026');	
       $ta022=$this->input->post('ta022');
       $ta023=$this->input->post('ta023');	
	   
	    $ta005=$this->input->post('ta005');
	    $ta005disp=$this->input->post('ta005');	 
		IF (!isset($ta006)) { $ta006=$this->session->userdata('sysma003');}
	    $ta006disp=$this->input->post('ta006');
		IF (!isset($ta008)) { $ta008=$this->session->userdata('ta008');}
	    $ta008disp=$this->input->post('ta008');
		
		$ta039=$this->input->post('ta039');
	    $ta039disp=$this->input->post('ta039');
	  ?>
	   <?php
	   $ta006=$this->input->post('ta006');
	   $ta010=$this->input->post('ta010');
	   $ta015=$this->input->post('ta015');
	   $ta014=$this->input->post('ta014');
	   $ta011=$this->input->post('ta011');
	   $ta012=$this->input->post('ta012');
	    if(!isset($ta032)) { $ta032=date("Y/m"); }
	 //  $ta032=$this->input->post('ta032');
	//   $ta036=$this->input->post('ta036');
	   $ta013=$this->input->post('ta013');
	   $ta016=$this->input->post('ta016');
	   $ta017=$this->input->post('ta017');
	 
	  ?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="9%"><span class="required">應付憑單別：</span> </td>
        <td class="normal14a"  width="28%"><input tabIndex="1" id="acpi01"    onKeyPress="keyFunction()"   name="ta001" onfocus="check_title_no();" onchange="check_acpi01(this);check_title_no();"  value="<?php echo $ta001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showacpi01disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="acpi01disp"> <?php    echo $ta001disp; ?> </span></td>
	    <td class="normal14y" width="8%" >單據日期： </td>
        <td class="normal14a"  width="28%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta034" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="ta034"  value="<?php echo $ta034; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(ta034,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	     <td class="normal14y" width="9%"  ><span class="required">應付憑單號：</span></td>
        <td class="normal14a" width="28%" ><input tabIndex="3" id="ta002" onKeyPress="keyFunction()" onfocus="check_title_no();" name="ta002" value="<?php echo $ta002; ?>"  type="text" required /><span id="ta002disp" ></span></td>
	 </tr>	
	  <tr>
	      <td class="normal14z">供應廠商：</td>
        <td  class="normal14"  ><input tabIndex="4" id="puri01a" onKeyPress="keyFunction()" ondblclick="search_puri01a_window()"  onchange="check_puri01a(this);check_title_no();" name="ta004" value="<?php echo $ta004; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showpuri01adisp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="puri01adisp"> <?php   echo $ta004disp; ?> </span></td>
        
	     <td class="normal14z">產生分錄：</td>
        <td  class="normal14"  ><input type="hidden" name="ta031" value="N" />
		<input type='checkbox' readonly="value" tabIndex="5" id="ta031" onKeyPress="keyFunction()" name="ta031" <?php if($ta031 == 'Y' ) echo 'checked'; ?>  <?php if($ta024 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
	    
		<td class="normal14z">確認碼：</td>
          <td  class="normal14"  ><select id="ta024" onKeyPress="keyFunction()" name="ta024" onChange="selappr(this)" tabIndex="6">
            <option <?php if($ta024 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($ta024 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($ta024 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td> 
	  </tr>
	  <tr>
	     <td class="normal14z">涷結付款碼：</td>
        <td  class="normal14"  ><input type="hidden" name="ta033" value="N" />
		<input type='checkbox' tabIndex="7" id="ta033" onKeyPress="keyFunction()" name="ta033" <?php if($ta033 == 'Y' ) echo 'checked'; ?>  <?php if($ta033 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
	    <td class="normal14z">簽核狀態：</td>
        <td  class="normal14"  ><select id="ta044" tabIndex="8" readonly="value" onKeyPress="keyFunction()" name="ta044"   style="background-color:#EBEBE4" >
            <option <?php if($ta044 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($ta044 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($ta044 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($ta044 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($ta044 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($ta044 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($ta044 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($ta044 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
		 <td class="normal14z" >憑單日期：</td>
        <td class="normal14" ><input tabIndex="9" id="ta003" readonly="value" onKeyPress="keyFunction()"  name="ta003" value="<?php echo $ta003; ?>" size="10" type="text"  style="background-color:#EBEBE4" /></td>
	  </tr>
	   <tr>
		 <td class="normal14z">確認者：</td>
        <td  class="normal14"  ><input tabIndex="10" id="ta035" readonly="value" onKeyPress="keyFunction()"  name="ta035" value="<?php echo $ta035; ?>" size="10" type="text" style="background-color:#EBEBE4"  /></td>
	    <td class="start14b"></td>
		 <td class="start14b"></td>
		  <td class="start14b"></td>
		 <td class="start14b"></td>
	  </tr>
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
		<li><a href="#tab1"  accesskey="a">憑單資料a</a></li>
		<li><a href="#tab2"  accesskey="b">發票資料b</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  憑單資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	 
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="10%">廠別：</td>
       <td class="normal14a"  width="27%" ><input type="text" tabIndex="10" ondblclick="search_cmsi02_window()" onKeyPress="keyFunction()" id="cmsi02"  onblur="check_cmsi02(this)" name="ta005"   value="<?php echo  $ta005; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	      <span id="cmsi02disp"> <?php    echo $ta005disp; ?> </span></td>
	   <td class="normal14y" width="10%" > 預計付款日：</td>
       <td class="normal14a"  width="26%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta019" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta019"  value="<?php echo $ta019; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(ta019,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
        <td class="normal14y" width="10%" >幣別：</td>
        <td class="normal14" width="27%"><input tabIndex="11" id="cmsi06" ondblclick="search_cmsi06_window()" onKeyPress="keyFunction()" name="ta008" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $ta008; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $ta008disp; ?> </span></td>	
	</tr>
	  
	  <tr>
         <td class="normal14z" >匯率：</td>		
        <td class="normal14"  ><input type="text" id="ta009"   tabIndex="14"   onKeyPress="keyFunction()"    name="ta009" value="<?php echo $ta009; ?>"  /></td>	   
	   <td  class="normal14z" >付款條件：</td>
        <td  class="normal14"  ><input tabIndex="15" id="cmsi21" ondblclick="search_cmsi21_window()" onKeyPress="keyFunction()" name="ta039" onblur="check_cmsi21(this)"   value="<?php echo  $ta039; ?>"   size="12"   type="text"  />
		  <a href="javascript:;"><img id="Showcmsi21adisp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
          <span id="cmsi21disp"> <?php    echo $ta039disp; ?> </span></td>		   
	    <td  class="normal14z">備註：</td>		
        <td  class="start14"  ><input type="text"   tabIndex="16" id="ta021"  onKeyPress="keyFunction()"   name="ta021" value="<?php echo $ta021; ?>"   /></td>
	    
	  </tr>
	  <tr>
	    <td class="normal14z">預計兌現日：</td>						
        <td  class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta020" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta020"  value="<?php echo $ta020; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(ta020,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		<td class="normal14z" >折扣付款日：</td>						
        <td  class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta040" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta040"  value="<?php echo $ta040; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(ta040,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	     <td class="normal14z">折扣兌現日：</td>						
        <td  class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta041" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta041"  value="<?php echo $ta041; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(ta041,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>	
	 
	  <tr>
        <td class="normal14z" >折扣率：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="20"    onKeyPress="keyFunction()" id="ta042" name="ta042" size="5"  value="<?php echo $ta042; ?>"  /></td>	   
	   <td class="normal14z">結案：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="21" readonly="value"  onKeyPress="keyFunction()" id="ta026" name="ta026"   value="<?php echo $ta026; ?>" style="background-color:#EBEBE4"  /></td>
		<td class="normal14" >列印次數：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="22"  readonly="value"  onKeyPress="keyFunction()" id="ta027" name="ta027" size="5"  value="<?php echo $ta027; ?>" style="background-color:#EBEBE4" /></td>
	  </tr>	
	  <tr>
	    <td class="normal14z">採購單別：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="23" readonly="value"  onKeyPress="keyFunction()" id="ta022" name="ta022"   value="<?php echo $ta022; ?>" style="background-color:#EBEBE4"  /></td>
		<td class="normal14z" >採購單號：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="24"  readonly="value"  onKeyPress="keyFunction()" id="ta023" name="ta023"   value="<?php echo $ta023; ?>" style="background-color:#EBEBE4" /></td>
	    <td class="normal14"></td>	
		<td class="normal14"></td>	
	 </tr>	
	  
	</table>
	</div>
	
<!--	
	<!--  發票資料 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	  
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="8%">統一編號：</td>
       <td class="normal14a"  width="42%" ><input type="text" tabIndex="25"   onKeyPress="keyFunction()" id="ta006" name="ta006"   value="<?php echo $ta006; ?>"   /></td>
	   <td class="normal14y"  width="8%" >發票號碼：</td>
       <td class="normal14a"  width="42%" ><input type="text" tabIndex="26"   onKeyPress="keyFunction()" id="ta014" name="ta014"   value="<?php echo $ta014; ?>"   /></td>
	 </tr>			  
	 
	  <tr>
	   <td class="normal14z"  >發票聯數：</td>
        <td class="normal14" ><select id="ta010" onKeyPress="keyFunction()" name="ta010"  tabIndex="27">
		    <option <?php if($ta010 == '2') echo 'selected="selected"';?> value='2'>2三聯式</option>
            <option <?php if($ta010 == '1') echo 'selected="selected"';?> value='1'>1二聯式</option> 
            <option <?php if($ta010 == '3') echo 'selected="selected"';?> value='3'>3二聯式收銀機發票</option>
		    <option <?php if($ta010 == '4') echo 'selected="selected"';?> value='4'>4三聯式收銀機發票</option>
            <option <?php if($ta010 == '5') echo 'selected="selected"';?> value='5'>5電子計算機發票</option>
            <option <?php if($ta010 == '6') echo 'selected="selected"';?> value='6'>6免用統一發票</option>	
            <option <?php if($ta010 == 'A') echo 'selected="selected"';?> value='A'>A增值稅專用發票</option>	
            <option <?php if($ta010 == 'B') echo 'selected="selected"';?> value='B'>B普通發票</option>	
            <option <?php if($ta010 == 'C') echo 'selected="selected"';?> value='C'>C免用發票</option>				
		  </select></td>
		<td class="normal14z"  >課稅別：</td>
        <td class="normal14" ><select id="ta011" onKeyPress="keyFunction()" name="ta011" onchange="taxa()" tabIndex="28">
		    <option <?php if($ta011 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php if($ta011 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php if($ta011 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php if($ta011 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php if($ta011 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select></td>
	  </tr>	
	  <tr>
	    <td class="normal14z">發票日期：</td>						
        <td  class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta015" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta015"  value="<?php echo $ta015; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(ta015,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		<td class="normal14z" >扣底區分：</td>						
        <td  class="normal14"  ><select id="ta012" onKeyPress="keyFunction()" name="ta012"  tabIndex="30">
		    <option <?php if($ta012 == '1') echo 'selected="selected"';?> value='1'>1可扣掋退貨及費用</option>
            <option <?php if($ta012 == '2') echo 'selected="selected"';?> value='2'>2可扣抵固定資產</option> 
            <option <?php if($ta012 == '3') echo 'selected="selected"';?> value='3'>3不可扣抵退貨及費用</option>
		    <option <?php if($ta012 == '4') echo 'selected="selected"';?> value='4'>4不可扣抵固定資產</option>
		  </select></td>
	  </tr>	
	   <tr>
	    <td  class="normal14z" >申報年月：</td>
        <td  class="normal14"  ><input tabIndex="3" id="ta032" dobonclick="fPopCalendar(event,ta032,ta032);" class="date-picker" onChange="dateformat_ym(this)"  onKeyPress="keyFunction()"    type="text" name="ta032"  value="<?php echo $ta032; ?>"  size="16" style="background-color:#E7EFEF" /><span > <?php   echo ''; ?> </span>	   
	    <td  class="normal14z">營業稅率：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="32" id="ta036"  onKeyPress="keyFunction()"   name="ta036" value="<?php echo $ta036; ?>"   /></td>
	    
	  </tr>
	  <tr>
	    <td  class="normal14z" >發票貨款：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="33" id="ta016"  onKeyPress="keyFunction()"   name="ta016" value="<?php echo $ta016; ?>"   /></td>	   
	    <td  class="normal14z">發票稅額：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="34" id="ta017"  onKeyPress="keyFunction()"   name="ta017" value="<?php echo $ta017; ?>"   /></td>
	  </tr>
	   <tr>
	    <td  class="normal14z">菸酒註記：</td>						
        <td  class="normal14"  ><input type="hidden" name="ta013" value="N" />
		<input type='checkbox' tabIndex="25" id="ta013" onKeyPress="keyFunction()" readonly="value" name="ta013" <?php if($ta013 == 'Y' ) echo 'checked'; ?>  <?php if($ta013 !== 'Y' ) echo 'check'; ?> value="Y" size="1" style="background-color:#EBEBE4" /></td> 
       
	    <td class="normal14z" >發票金額：</td>
        <td class="normal14"><input type="text"   tabIndex="36" id="ta999" readonly="value" onKeyPress="keyFunction()"   name="ta999" value="<?php echo $ta016+$ta017; ?>" style="background-color:#EBEBE4"  /></td>       
	    
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
	
		
          <?php $current_product_count = 0;//依照資料庫紀錄的明細先列一遍 新增只給初值 ?>
          <tfoot>
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
				
				<td class="right" valign="top"><b style="color: #003A88;">原幣未稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta028' id="ta028" size="8" value="<?php echo $ta028; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　原幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta029' id="ta029" size="8" value="<?php echo $ta029; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　原幣合計：</b></td>
				<td ><input type='text' readonly="value" name="tc2829" id="ta2829" size="8" value="<?php echo $ta028+$ta029; ?>"  style="background-color:#F0F0F0" /></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　本幣未稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta037' id="ta037" size="8" value="<?php echo $ta037; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　本幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta038' id="ta038" size="8" value="<?php echo $ta038; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　本幣合計：</b></td>
				<td ><input type='text' readonly="value" name="ta3738" id="ta3738" size="8" value="<?php echo $ta037+$ta038; ?>"  style="background-color:#F0F0F0" /></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　已付金額：</b></td>
				<td ><input type='text' readonly="value" name='ta030' id="ta030" size="8" value="<?php echo $ta030; ?>"  style="background-color:#EBEBE4" /></td>
				<input id="select_rows" style="display:none;"/>
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	  
	<!-- <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('acp/acpi02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	 </div> -->
		</div> 	   
    </form>
	   <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位,交貨庫別,可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
	
    </div> <!-- div-6 -->
	
  </div> <!-- div-5 -->
 
</div> <!-- div-4 -->

 
   
	</div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
  <?php  include_once("./application/views/funnew/acpi01a_funmjs_v.php"); ?> <!-- 應付單別 -->
<?php  include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?>  <!-- 人員 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/puri01a_funmjs_v.php"); ?>  <!-- 客戶回傳多欄 -->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?>  <!-- 部門 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->
<?php  include_once("./application/views/funnew/cmsi21_funmjs_v.php"); ?>  <!-- 付款條件 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/acpi02_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#acpi01').focus();
	}); 	   
</script> 	
 