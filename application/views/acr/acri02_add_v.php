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
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 結帳單資料建立作業 - 新增　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#acri01').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('acr/acri02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/acr/acri02/addsave" >	
	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  if(!isset($ta001)) { $ta001=$this->input->post('ta001'); }
	 
	 if(!isset($ta001disp)) { $ta001disp=$this->input->post('ta001'); }
	//  $purq04a33disp=$this->input->post('ta001'); 
      $ta002=$this->input->post('ta002');
	  if(!isset($ta038)) { $ta038=date("Y/m/d"); }
	  if(!isset($ta003)) { $ta003=date("Y/m/d"); }
	  $ta004=$this->input->post('ta004'); 
	  $ta004disp=$this->input->post('ta004'); 
       
	  if(!isset($ta013)) { $ta013='N'; }
	  if(!isset($ta048)) { $ta048='N'; }
	  if(!isset($ta053)) { $ta053='N'; }
	  if(!isset($ta025)) { $ta025='Y'; }
	  if(!isset($ta039)) { $ta039=$username; }
	  
	  $ta052=$this->input->post('ta052');
	  $ta029=$this->input->post('ta029');
	  $ta030=$this->input->post('ta030');
	  $ta041=$this->input->post('ta041');
	  $ta042=$this->input->post('ta042');
	  $ta031=$this->input->post('ta031');
	 
	?>
	 <?php
	  //結帳 
	  // if(!isset($ta007)) { $ta007=0.05; } 幣別 稅率	  
	   IF (!isset($cmsq06a)) { $cmsq06a=$this->session->userdata('sysma003');}
	   $ta040=$this->session->userdata('sysma004');
	   
	   //匯率
	   if(!isset($ta010)) { $ta010=1; }
	   
	    $ta005=$this->input->post('ta005');
	    $ta005disp=$this->input->post('ta005');
		$ta006=$this->input->post('ta006');
	    $ta006disp=$this->input->post('ta006');
		$ta009=$this->input->post('ta009');
	    $ta009disp=$this->input->post('ta009');
		$ta043=$this->input->post('ta043');
	    $ta043disp=$this->input->post('ta043');
		
	   $ta022=$this->input->post('ta022');
	   $ta023=$this->input->post('ta023');
	//   $ta020=$this->input->post('ta020');
	 //  $ta021=$this->input->post('ta021');
	   if(!isset($ta020)) { $ta020=date("Y/m/d"); }
	   if(!isset($ta021)) { $ta021=date("Y/m/d"); }
	   if(!isset($ta044)) { $ta044=date("Y/m/d"); }
	   if(!isset($ta045)) { $ta045=date("Y/m/d"); }
	 //  $ta044=$this->input->post('ta044');
    //   $ta045=$this->input->post('ta045');	
       $ta046=$this->input->post('ta046');
       $ta037=$this->input->post('ta037');	
       $ta028=$this->input->post('ta028');
       $ta027=$this->input->post('ta027');
	   $ta033=$this->input->post('ta033');
       $ta036=$this->input->post('ta036');	   
	  
	  ?>
	   <?php
	    //發票 
	   $ta016=$this->input->post('ta016');
	   $ta015=$this->input->post('ta015');
	   $ta007=$this->input->post('ta007');
	   $ta008=$this->input->post('ta008');
	   $ta011=$this->input->post('ta011');
	   $ta012=$this->input->post('ta012');
	   $ta032=$this->input->post('ta032');
	   $ta014=$this->input->post('ta014');
	   $ta019=$this->input->post('ta019');
	 //  $ta040=$this->input->post('ta040');
	   $ta017=$this->input->post('ta017');
	   $ta018=$this->input->post('ta018');
	   $ta049=$this->input->post('ta049');
	   $ta050=$this->input->post('ta050');
	   $ta051=$this->input->post('ta051');
	 
	  ?>
	    <?php
	    //其他 
	   $ta034=$this->input->post('ta034');
	   $ta035=$this->input->post('ta035');
	   $ta023=$this->input->post('ta023');
	   $ta024=$this->input->post('ta024');
	  ?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="9%"><span class="required">結帳單別：</span> </td>
        <td class="normal14a"  width="25%"><input tabIndex="1" id="acri01"    onKeyPress="keyFunction()"   name="ta001" onfocus="check_title_no();" onchange="check_acri01(this);check_title_no();"  value="<?php echo $ta001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showacri01disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="acri01disp"> <?php    echo $ta001disp; ?> </span></td>
	    <td class="normal14y" width="8%" >單據日期： </td>
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta038" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="ta038"  value="<?php echo $ta038; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(ta038,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		   <td class="normal14y" width="8%"><span class="required">結帳單號：</span></td>
        <td class="normal14a"  width="25%"  ><input tabIndex="3" id="ta002" onKeyPress="keyFunction()" onfocus="chkno1(this)" name="ta002" value="<?php echo $ta002; ?>" size="30" type="text" required /><span id="ta002disp" ></span></td>
	  </tr>
	  <tr>
	  <td class="normal14z">客戶代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="copi01" onKeyPress="keyFunction()" ondblclick="search_copi01_window()"  onchange="check_copi01(this)" name="ta004" value="<?php echo $ta004; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="copi01disp"> <?php   echo $ta004disp; ?> </span></td>
		  <td class="normal14z">產生分錄：</td>
        <td  class="normal14"  ><input type="hidden" name="ta013" value="N" />
		<input type='checkbox' tabIndex="5" id="ta013" onKeyPress="keyFunction()" name="ta013" <?php if($ta013 == 'Y' ) echo 'checked'; ?>  <?php if($ta013 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
	    <td class="normal14z">確認碼：</td>
        <td  class="normal14"  ><select id="ta025" onKeyPress="keyFunction()" name="ta025" onChange="selappr(this)" tabIndex="6">
            <option <?php if($ta025 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($ta025 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($ta025 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>
		
	  </tr>
	  <tr>
	     <td class="normal14z">流程代號：</td>
        <td  class="normal14"  ><input type="text" id="ta052"   tabIndex="7"   onKeyPress="keyFunction()"    name="ta052" value="<?php echo $ta052; ?>" style="background-color:#EBEBE4" /></td> 
	    <td class="normal14z">簽核狀態：</td>
        <td  class="normal14"  ><select id="ta048" tabIndex="8" readonly="value" onKeyPress="keyFunction()" name="ta048"   style="background-color:#EBEBE4" >
            <option <?php if($ta048 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($ta048 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($ta048 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($ta048 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($ta048 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($ta048 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($ta048 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($ta048 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
		<td class="normal14z" >結帳日期：</td>
        <td class="normal14" ><input tabIndex="9" id="ta003" readonly="value" onKeyPress="keyFunction()"  name="ta003" value="<?php echo $ta003; ?>" size="10" type="text"  style="background-color:#EBEBE4" /></td>
	  </tr>
	   <tr>
		 <td class="normal14z">確認者：</td>
        <td  class="normal14"  ><input tabIndex="10" id="ta039" readonly="value" onKeyPress="keyFunction()"  name="ta039" value="<?php echo $ta039; ?>" size="10" type="text" style="background-color:#EBEBE4"  /></td>
	     <td class="normal14z">拋轉狀態：</td>
        <td  class="normal14"  ><select id="ta053" tabIndex="11" readonly="value" onKeyPress="keyFunction()" name="ta053"   style="background-color:#EBEBE4" >
            <option <?php if($ta053 == 'N') echo 'selected="selected"';?> value='N'>N.未拋轉</option>                                                                        
		    <option <?php if($ta053 == 'Y') echo 'selected="selected"';?> value='Y'>Y.拋轉成功(來源廠商)</option>
            <option <?php if($ta053 == 'y') echo 'selected="selected"';?> value='y'>y.拋轉成功(下游廠商)</option>
		    <option <?php if($ta053 == 'n') echo 'selected="selected"';?> value='n'>n.訂單變更</option>
            <option <?php if($ta053 == 'U') echo 'selected="selected"';?> value='U'>U.拋轉失敗</option>	
            <option <?php if($ta053 == 'u') echo 'selected="selected"';?> value='u'>u.還原失敗</option>	
		  </select></td></td>
		 <td class="start14b"></td>
        <td  class="normal14"  ></td>
	 </tr>
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
		<li><a href="#tab1"  accesskey="a">結帳資料a</a></li>
		<li><a href="#tab2" accesskey="b">發票資料b</a></li>
		<li><a href="#tab3" accesskey="c">其他資料c</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  結帳資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	 
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="9%">廠別：</td>
       <td class="normal14a"  width="25%" ><input type="text" tabIndex="10" ondblclick="search_cmsi02_window()" onKeyPress="keyFunction()" id="cmsi02"  onblur="check_cmsi02(this)" name="ta006"   value="<?php echo  $ta006; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	      <span id="cmsi02disp"> <?php    echo $ta006disp; ?> </span></td>
	   <td class="normal14y"  width="9%" > 預計收款日：</td>
       <td class="normal14a"  width="24%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta020" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta020"  value="<?php echo $ta020; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(ta020,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	   <td class="normal14y" width="9%" >幣別：</td>
        <td class="normal14"  width="24%" ><input tabIndex="11" id="cmsi06" ondblclick="search_cmsi06_window()" onKeyPress="keyFunction()" name="ta009" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $ta009; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $ta009disp; ?> </span></td>
	 </tr>
	  
	  <tr>
       <td class="normal14z" >匯率：</td>		
        <td class="normal14"  ><input type="text" id="ta010"   tabIndex="15"   onKeyPress="keyFunction()"    name="ta010" value="<?php echo $ta010; ?>"  /></td>	   
	   <td  class="normal14z" >付款條件：</td>
        <td  class="normal14"  ><input tabIndex="15" id="cmsi21" ondblclick="search_cmsi21_window()" onKeyPress="keyFunction()" name="ta043" onblur="check_cmsi21(this)"   value="<?php echo  $ta043; ?>"   size="12"   type="text"  />
		  <a href="javascript:;"><img id="Showcmsi21disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
          <span id="cmsi21disp"> <?php    echo $ta043disp; ?> </span></td>		   
	    <td  class="normal14z">備註：</td>		
        <td  class="start14"  ><input type="text"   tabIndex="17" id="ta022"  onKeyPress="keyFunction()"   name="ta022" value="<?php echo $ta022; ?>"   /></td>
	    
	  </tr>
	  <tr>
	    <td class="normal14z">預計兌現日</td>						
        <td  class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta021" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta021"  value="<?php echo $ta021; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(ta021,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		<td class="normal14z" >折扣收款日：</td>						
        <td  class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta044" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta044"  value="<?php echo $ta044; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(ta044,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	    <td class="normal14z">折扣兌現日</td>						
        <td  class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta045" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta045"  value="<?php echo $ta045; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(ta045,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>	
	  	<tr>
	    <td class="normal14z">L/CNO：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="21" readonly="value"  onKeyPress="keyFunction()" id="ta033" name="ta033"   value="<?php echo $ta033; ?>" style="background-color:#EBEBE4"  /></td>
		<td class="normal14z" >INVOICE_NO：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="22"  readonly="value"  onKeyPress="keyFunction()" id="ta036" name="ta036"   value="<?php echo $ta036; ?>" style="background-color:#EBEBE4" /></td>
	    <td class="normal14z">發票列印：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="23" readonly="value"  onKeyPress="keyFunction()" id="ta037" name="ta037"   value="<?php echo $ta037; ?>" style="background-color:#EBEBE4"  /></td>
	  </tr>	
	  <tr>
	    <td class="normal14z" >折扣率：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="24"    onKeyPress="keyFunction()" id="ta046" name="ta046" size="5"  value="<?php echo $ta046; ?>"  /></td>
		<td class="normal14z">結案：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="25" readonly="value"  onKeyPress="keyFunction()" id="ta027" name="ta027"   value="<?php echo $ta027; ?>" style="background-color:#EBEBE4"  /></td>
		<td class="normal14z" >列印次數：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="26"  readonly="value"  onKeyPress="keyFunction()" id="ta028" name="ta028" size="5"  value="<?php echo $ta028; ?>" style="background-color:#EBEBE4" /></td>
	  </tr>
	 
	</table>
	</div>
	
<!--  發票資料 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="9%">統一編號：</td>
       <td class="normal14a"  width="25%" ><input type="text" tabIndex="27"   onKeyPress="keyFunction()" id="ta007" name="ta007"   value="<?php echo $ta007; ?>"   /></td>
	   <td class="normal14y"  width="8%" >發票號碼：</td>
       <td class="normal14a"  width="25%" ><input type="text" tabIndex="28"   onKeyPress="keyFunction()" id="ta015" name="ta015"   value="<?php echo $ta015; ?>"   /></td>
	    <td class="normal14y"  width="8%" >發票聯數：</td>
        <td class="normal14" width="25%"><select id="ta011" onKeyPress="keyFunction()" name="ta011"  tabIndex="29">
		    <option <?php if($ta011 == '2') echo 'selected="selected"';?> value='2'>2三聯式</option>
            <option <?php if($ta011 == '1') echo 'selected="selected"';?> value='1'>1二聯式</option> 
            <option <?php if($ta011 == '3') echo 'selected="selected"';?> value='3'>3二聯式收銀機發票</option>
		    <option <?php if($ta011 == '4') echo 'selected="selected"';?> value='4'>4三聯式收銀機發票</option>
            <option <?php if($ta011 == '5') echo 'selected="selected"';?> value='5'>5電子計算機發票</option>
            <option <?php if($ta011 == '6') echo 'selected="selected"';?> value='6'>6免用統一發票</option>	
            <option <?php if($ta011 == 'A') echo 'selected="selected"';?> value='A'>A增值稅專用發票</option>	
            <option <?php if($ta011 == 'B') echo 'selected="selected"';?> value='B'>B普通發票</option>	
            <option <?php if($ta011 == 'C') echo 'selected="selected"';?> value='C'>C免用發票</option>				
		  </select></td>
	 </tr>	
	
	  <tr>
	    <td class="normal14z"  >課稅別：</td>
        <td class="normal14" ><select id="ta011" onKeyPress="keyFunction()" name="ta012" onchange="taxa()" tabIndex="30">
		    <option <?php if($ta012 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php if($ta012 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php if($ta012 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php if($ta012 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php if($ta012 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select></td>
		<td class="normal14z">發票日期：</td>						
        <td  class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta016" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ta016"  value="<?php echo $ta016; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(ta016,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		<td  class="normal14z">營業稅率：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="32" id="ta040"  onKeyPress="keyFunction()"   name="ta040" value="<?php echo $ta040; ?>"   /></td>
	  </tr>	
	   <tr>
	    <td  class="normal14z" >申報年月：</td>
        <td  class="normal14"  ><input tabIndex="3" id="ta032" dobonclick="fPopCalendar(event,ta032,ta032);" class="date-picker" onChange="dateformat_ym(this)"  onKeyPress="keyFunction()"    type="text" name="ta032"  value="<?php echo $ta032; ?>"  size="16" style="background-color:#E7EFEF" /><span > <?php   echo ''; ?> </span>	   
	    <td  class="normal14z" >客戶全名：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="35" id="ta008"  onKeyPress="keyFunction()"   name="ta008" value="<?php echo $ta008; ?>"   /></td>
		<td  class="normal14z">發票貨款：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="34" id="ta017"  onKeyPress="keyFunction()"   name="ta017" value="<?php echo $ta017; ?>"   /></td>
	    
	  </tr>
	  
	   <tr>
	    <td  class="normal14z">發票稅額：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="36" id="ta018"  onKeyPress="keyFunction()"   name="ta018" value="<?php echo $ta018; ?>"   /></td>
		<td  class="normal14z">菸酒註記：</td>						
        <td  class="normal14"  ><input type="hidden" name="ta014" value="N" />
		<input type='checkbox' tabIndex="37" id="ta014" onKeyPress="keyFunction()" readonly="value" name="ta014" <?php if($ta014 == 'Y' ) echo 'checked'; ?>  <?php if($ta014 !== 'Y' ) echo 'check'; ?> value="Y" size="1" style="background-color:#EBEBE4" /></td> 
	    <td class="normal14z" >發票金額：</td>
        <td class="normal14"><input type="text"   tabIndex="38" id="ta999" readonly="value" onKeyPress="keyFunction()"   name="ta999" value="<?php echo $ta017+$ta018; ?>" style="background-color:#EBEBE4"  /></td>       
	    
	  </tr>
	   <tr>
	    <td  class="normal14z">更換發票：</td>						
        <td  class="normal14"  ><input type="hidden" name="ta049" value="N" />
		<input type='checkbox' tabIndex="39" id="ta049" onKeyPress="keyFunction()" readonly="value" name="ta049" <?php if($ta049 == 'Y' ) echo 'checked'; ?>  <?php if($ta049 !== 'Y' ) echo 'check'; ?> value="Y" size="1" style="background-color:#EBEBE4" /></td> 
	    <td  class="normal14z">新結帳單別</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="40" id="ta050" readonly="value" onKeyPress="keyFunction()"   name="ta050" value="<?php echo $ta050; ?>" style="background-color:#EBEBE4"  /></td>
	    <td class="normal14z" >新結帳單號</td>
        <td class="normal14"><input type="text"   tabIndex="41" id="ta051" readonly="value" onKeyPress="keyFunction()"   name="ta051" value="<?php echo $ta051; ?>" style="background-color:#EBEBE4"  /></td> 
	   </tr>
	</table>
 
	</div> 	
	<!--  其他資料 -->
	<div id="tab3" class="tab_content"> <!-- div-9 -->
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="10%">其他金額：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="52"   onKeyPress="keyFunction()" id="ta034" name="ta034"   value="<?php echo $ta034; ?>"   /></td>
	   <td class="normal14y"  width="10%" >專櫃代號：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="53"   onKeyPress="keyFunction()" id="ta035" name="ta035"   value="<?php echo $ta035; ?>"   /></td>
	 </tr>	
	  
	  <tr>
	    <td  class="normal14z" >訂單單別：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="54" id="ta023" readonly="value" onKeyPress="keyFunction()"   name="ta023" value="<?php echo $ta023; ?>"   style="background-color:#EBEBE4"  /></td>	   
	    <td  class="normal14z">訂單單號：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="55" id="ta024" readonly="value" onKeyPress="keyFunction()"   name="ta024" value="<?php echo $ta024; ?>"   style="background-color:#EBEBE4"  /></td>
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
				<td ><input type='text' readonly="value" name='ta029' id="ta029" size="8" value="<?php echo $ta029; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　原幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta030' id="ta030" size="8" value="<?php echo $ta030; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　原幣合計：</b></td>
				<td ><input type='text' readonly="value" name="tc2930" id="ta2930" size="8" value="<?php echo $ta029+$ta030; ?>"  style="background-color:#F0F0F0" /></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　本幣未稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta041' id="ta041" size="8" value="<?php echo $ta041; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　本幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta042' id="ta042" size="8" value="<?php echo $ta042; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　本幣合計：</b></td>
				<td ><input type='text' readonly="value" name="ta4142" id="ta4142" size="8" value="<?php echo $ta041+$ta042; ?>"  style="background-color:#F0F0F0" /></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　已收金額：</b></td>
				<td ><input type='text' readonly="value" name='ta031' id="ta031" size="8" value="<?php echo $ta031; ?>"  style="background-color:#EBEBE4" /></td>
				
				<input id="select_rows" style="display:none;"/>
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	  
	<!-- <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('acr/acri02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
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
 <?php  include_once("./application/views/funnew/acri01a_funmjs_v.php"); ?> <!-- 結帳單別 -->
<?php  include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?>  <!-- 人員 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/copi01a_funmjs_v.php"); ?>  <!-- 客戶回傳多欄 -->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?>  <!-- 部門 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->
<?php  include_once("./application/views/funnew/cmsi21_funmjs_v.php"); ?>  <!-- 付款條件 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/acri02_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#acri01').focus();
	}); 	   
</script> 	
