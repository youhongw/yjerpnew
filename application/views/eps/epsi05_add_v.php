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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 出貨通知單建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/eps/epsi05/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值
	  //預設稅率,廠別,幣別
       $stax_rate = $this->session->userdata('sysma004');
       $sysma200 = $this->session->userdata('sysma200');
	   
	  if(!isset($ta041)) { $ta041=$sysma200; } else {$ta041=$this->input->post('ta041');}
	  if(!isset($ta022)) { $ta022=$this->session->userdata('sysma003'); } else  {$ta022=$this->input->post('ta022');}
	  if(!isset($ta071)) { $ta071=$username; }
	  if(!isset($ta073)) { $ta073=$username; }
	  
	  if(!isset($ta001)) { $ta001=$this->input->post('ta001'); }
	  if(!isset($ta001disp)) { $ta001disp=$this->input->post('ta001disp'); }
	  if(!isset($ta002)) { $ta002=$this->input->post('ta002'); } 
	  if(!isset($ta003)) { $ta003=date("Y/m/d"); } 
	  if(!isset($ta004)) { $ta004=$this->input->post('ta004'); }
	  if(!isset($ta004disp)) { $ta004disp=$this->input->post('ta004disp'); }
	  if(!isset($ta005)) { $ta005=$this->input->post('ta005'); }
	  if(!isset($ta006)) { $ta006=$this->input->post('ta006'); }
	  if(!isset($ta006disp)) { $ta006disp=$this->input->post('ta006disp'); }
	  if(!isset($ta007)) { $ta007=$this->input->post('ta007'); }
	  if(!isset($ta007disp)) { $ta007disp=$this->input->post('ta007disp'); }
	  if(!isset($ta008)) { $ta008=$this->input->post('ta008'); }
	  if(!isset($ta008disp)) { $ta008disp=$this->input->post('ta008disp'); }
	  if(!isset($ta009)) { $ta009=$this->input->post('ta009'); }
	  if(!isset($ta010)) { $ta010=$this->input->post('ta010'); }
	  if(!isset($ta011)) { $ta011=$this->input->post('ta011'); }
	  if(!isset($ta012)) { $ta012=$this->input->post('ta012'); }
	  if(!isset($ta013)) { $ta013=$this->input->post('ta013'); }
	  if(!isset($ta014)) { $ta014=$this->input->post('ta014'); }
	  if(!isset($ta015)) { $ta015=$this->input->post('ta015'); }
	  if(!isset($ta016)) { $ta016=$this->input->post('ta016'); }
	  if(!isset($ta017)) { $ta017=$this->input->post('ta017'); }
	  if(!isset($ta018)) { $ta018=$this->input->post('ta018'); }
	  if(!isset($ta019)) { $ta019=$this->input->post('ta019'); }
	//  if(!isset($ta020)) { $ta020=$this->input->post('ta020'); }
	  if(!isset($ta021)) { $ta021=$this->input->post('ta021'); }
	//  if(!isset($ta022)) { $ta022=$this->input->post('ta022'); }
	  if(!isset($ta023)) { $ta023=$this->input->post('ta023'); }
	  if(!isset($ta024)) { $ta024=$this->input->post('ta024'); }
	  if(!isset($ta025)) { $ta025=$this->input->post('ta025'); }
	  if(!isset($ta025disp)) { $ta025disp=$this->input->post('ta025disp'); }
	  if(!isset($ta026)) { $ta026=$this->input->post('ta026'); }
	  if(!isset($ta027)) { $ta027=$this->input->post('ta027'); }
	  if(!isset($ta028)) { $ta028=$this->input->post('ta028'); }
	  if(!isset($ta028disp)) { $ta028disp=$this->input->post('ta028disp'); }
	  if(!isset($ta029)) { $ta029=$this->input->post('ta029'); }
	  if(!isset($ta030)) { $ta030=$this->input->post('ta030'); }
	 // if(!isset($ta031)) { $ta031=$this->input->post('ta031'); }
	 // if(!isset($ta032)) { $ta032=$this->input->post('ta032'); }
	  if(!isset($ta033)) { $ta033=$this->input->post('ta033'); }
	//  if(!isset($ta034)) { $ta034=$this->input->post('ta034'); }
	  if(!isset($ta035)) { $ta035=$this->input->post('ta035'); }
	  if(!isset($ta036)) { $ta036=$this->input->post('ta036'); }
	  if(!isset($ta037)) { $ta037=$this->input->post('ta037'); }
	  if(!isset($ta038)) { $ta038=$this->input->post('ta038'); }
	  if(!isset($ta039)) { $ta039=$this->input->post('ta039'); }
	  if(!isset($ta040)) { $ta040=$this->input->post('ta040'); }
	  if(!isset($ta041disp)) { $ta041disp=$this->input->post('ta041disp'); }
	  if(!isset($ta042)) { $ta042=$this->input->post('ta042'); }
	  if(!isset($ta043)) { $ta043=$this->input->post('ta043'); }
	  if(!isset($ta044)) { $ta044=$this->input->post('ta044'); }
	  if(!isset($ta045)) { $ta045=$this->input->post('ta045'); }
	  if(!isset($ta046)) { $ta046=$this->input->post('ta046'); }
	  if(!isset($ta047)) { $ta047=$this->input->post('ta047'); }
	  if(!isset($ta048)) { $ta048=$this->input->post('ta048'); }
	  if(!isset($ta049)) { $ta049=$this->input->post('ta049'); }
	  if(!isset($ta050)) { $ta050=$this->input->post('ta050'); }
	  if(!isset($ta051)) { $ta051=$this->input->post('ta051'); }
	  if(!isset($ta052)) { $ta052=$this->input->post('ta052'); }
	  if(!isset($ta053)) { $ta053=$this->input->post('ta053'); }
	  if(!isset($ta054)) { $ta054=$this->input->post('ta054'); }
	  if(!isset($ta055)) { $ta055=$this->input->post('ta055'); }
	  if(!isset($ta056)) { $ta056=$this->input->post('ta056'); }
	  if(!isset($ta057)) { $ta057=$this->input->post('ta057'); }
	  if(!isset($ta058)) { $ta058=$this->input->post('ta058'); }
	  if(!isset($ta059)) { $ta059=$this->input->post('ta059'); }
	  if(!isset($ta060)) { $ta060=$this->input->post('ta060'); } 
	  if(!isset($ta061)) { $ta061=$this->input->post('ta061'); }
	  if(!isset($ta062)) { $ta062=$this->input->post('ta062'); }
	  if(!isset($ta063)) { $ta063=$this->input->post('ta063'); }
	  if(!isset($ta064)) { $ta064=$this->input->post('ta064'); }
	  if(!isset($ta065)) { $ta065=$this->input->post('ta065'); }
	  if(!isset($ta066)) { $ta066=$this->input->post('ta066'); }
	  if(!isset($ta067)) { $ta067=$this->input->post('ta067'); }
	  if(!isset($ta068)) { $ta068=$this->input->post('ta068'); }
	//  if(!isset($ta069)) { $ta069=$this->input->post('ta069'); }
	//  if(!isset($ta070)) { $ta070=$this->input->post('ta070'); }
	//  if(!isset($ta071)) { $ta071=$this->input->post('ta071'); }
	  if(!isset($ta072)) { $ta072=$this->input->post('ta072'); }
	//  if(!isset($ta073)) { $ta073=$this->input->post('ta073'); }
	  if(!isset($ta074)) { $ta074=$this->input->post('ta074'); }
	  if(!isset($ta074disp)) { $ta074disp=$this->input->post('ta074disp'); }
	//  if(!isset($ta075)) { $ta075=$this->input->post('ta075'); }
	  if(!isset($ta076)) { $ta076=$this->input->post('ta076'); } 	  
	 //  $ta025=$this->input->post('ta025');  一筆存檔清空白
	  if(!isset($ta070)) { $ta070=date("Y/m/d"); }
	  if(!isset($ta020)) { $ta020="2"; }
	  if(!isset($ta031)) { $ta031="2"; }
	  if(!isset($ta032)) { $ta032="N"; }
	  if(!isset($ta034)) { $ta034="Y"; }
	  if(!isset($ta069)) { $ta069=0; }
	  if(!isset($ta075)) { $ta075="N"; }
	  $ta029=0;$ta068=0;
	  //$this->session->unset_userdata('docno');
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="9%"><span class="required">通知單別：</span></td>   <!--onchange="startepsi01(this);check_title_no();"    -->
        <td class="normal14a"  width="25%"><input tabIndex="1" id="epsi01"  ondblclick="search_epsi01_window()"  onKeyPress="keyFunction()"   name="ta001" onfocus="check_title_no();selverify();" onchange="check_epsi01(this);check_title_no();"  value="<?php echo $ta001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showepsi01disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="epsi01disp"> <?php    echo $ta001disp; ?> </span></td>
	    <td class="normal14a" width="8%" >單據日期： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ta070" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="ta070"  value="<?php echo $ta070; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(ta070,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	    <td class="start14a" width="8%"><span class="required">通知單號：</span></td>
        <td class="normal14a" width="25%"><input tabIndex="3" id="ta002" onKeyPress="keyFunction()"  name="ta002" onfocus="check_title_no();" value="<?php echo $ta002; ?>" size="12" type="text" required /></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a">客戶代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="copi01" onKeyPress="keyFunction()" ondblclick="search_copi01_window()"  onchange="check_copi01(this)" name="ta004" value="<?php echo $ta004; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="copi01disp"> <?php   echo $ta004disp; ?> </span></td>
	    <td class="normal14">LC/NO.：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5"   onKeyPress="keyFunction()" id="ta021" name="ta021"   value="<?php echo $ta021; ?>"  size="12" /></td>
	    <td class="normal14">通知日期：</td>
        <td  class="normal14"  ><input type="text" tabIndex="6" readonly="value"  onKeyPress="keyFunction()" id="ta003" name="ta003"   value="<?php echo $ta003; ?>" size="12"  style="background-color:#F0F0F0"/></td>
	    
	  </tr>
	  
	  <tr>
	    <td class="normal14">簽核狀態：</td>
        <td class="normal14"  ><select id="ta075" tabIndex="7" readonly="value" onKeyPress="keyFunction()" name="ta075"   style="background-color:#F0F0F0" >
            <option <?php if($ta075 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($ta075 == '0') echo 'selected="selected"';?> value='0'>0.待處理</option>
            <option <?php if($ta075 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($ta075 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($ta075 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($ta075 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($ta075 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($ta075 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
        <td class="normal14">確認碼：</td>
        <td  class="normal14"  ><select id="verify" onKeyPress="keyFunction()" name="ta034" onChange="selverify(this)" tabIndex="8">
            <option <?php if($ta034 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($ta034 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($ta034 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>
	     <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" readonly="value"  onKeyPress="keyFunction()" id="ta071" name="ta071"   value="<?php echo $ta071; ?>" style="background-color:#F0F0F0" size="12" /></td>
	    
	</table>
	
	<div class="abgne_tab"> <!-- div-6 頁標籤 -->
		<ul class="tabs">
		  <li><a href="#tab1"  accesskey="a">交易資料a</a></li>
		  <li><a href="#tab2"  accesskey="b">發票資料b</a></li>
		  <li><a href="#tab3"  accesskey="i">麥頭資料i</a></li>
		  <li><a href="#tab4"  accesskey="j">訂單備註j</a></li>
		  <li><a href="#tab5"  accesskey="k">船務(一)k</a></li>
		  <li><a href="#tab6"  accesskey="l">船務(二)l</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  交易資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	  
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="9%">部門代號：</td>
        <td class="normal14a"  width="25%" ><input type="text" tabIndex="10" ondblclick="search_cmsi05_window()" onKeyPress="keyFunction()" id="cmsi05"  name="ta006"  onblur="check_cmsi05(this)"    value="<?php echo  $ta006; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Showcmsi05disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
	      <span id="cmsi05disp" > <?php    echo $ta006disp; ?> </span></td>
	    <td class="normal14a"  width="9%">業務人員：</td>  <!-- onchange="startcmsi09(this)"     -->
        <td class="normal14a"  width="25%" ><input tabIndex="11" id="cmsi09" ondblclick="search_cmsi09_window()" onKeyPress="keyFunction()" name="ta007" onblur="check_cmsi09(this)"  value="<?php echo $ta007; ?>"  type="text"  size="12"  />
		  <a href="javascript:;"><img id="Showcmsi09disp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
          <span id="cmsi09disp"> <?php    echo $ta007disp; ?> </span></td>
	    <td class="normal14a"  width="8%">出貨廠別：</td>   <!-- onchange="startcmsi02(this)"  onchange="check_cmsi02(this)"   -->
        <td class="normal14a"  width="24%" ><input type="text" tabIndex="12" ondblclick="search_cmsi02_window()" onKeyPress="keyFunction()" id="cmsi02"  onblur="check_cmsi02(this)" name="ta041"   value="<?php echo  $ta041; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	      <span id="cmsi02disp"> <?php    echo $ta041disp; ?> </span></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14a"  >幣別：</td>
        <td class="normal14" ><input tabIndex="13" id="cmsi06" ondblclick="search_cmsi06_window()" onKeyPress="keyFunction()" name="ta022" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $ta022; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $ta008disp; ?> </span></td>
	    <td class="normal14" >匯率：</td>		
        <td class="normal14"  ><input type="text" id="exchange_rate"   tabIndex="14"   onKeyPress="keyFunction()"    name="ta023" value="<?php echo $ta023; ?>"  size="12" /></td>
	    <td class="normal14" >送貨客戶：</td>		
        <td class="normal14"  ><input type="text" id="ta008"   tabIndex="15"   onKeyPress="keyFunction()"    name="ta008" value="<?php echo $ta008; ?>"  size="12" /></td>
	  </tr>
	  
	  <tr>
		<td class="normal14" >價格條件：</td>		
        <td class="normal14"  ><input type="text" id="pricec"   tabIndex="16"   onKeyPress="keyFunction()"    name="ta024" value="<?php echo $ta024; ?>"  size="12" /></td>
	    <td  class="normal14a" >付款條件：</td>
        <td  class="normal14"  ><input tabIndex="17" id="cmsi21" ondblclick="search_cmsi21_window()" onKeyPress="keyFunction()" name="ta074" onblur="check_cmsi21(this)"   value="<?php echo  $ta074; ?>"   size="12"   type="text"  />
		  <a href="javascript:;"><img id="Showcmsi21disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
          <span id="cmsi21disp"> <?php    echo $ta074disp; ?> </span></td>
	    <td class="normal14" ></td>		
        <td class="normal14"  ></td>	
	  </tr>
	  
	  <tr>
	    <td class="normal14" >列印次數：</td>		
        <td class="normal14"  ><input type="text" id="ta069"   tabIndex="19"   onKeyPress="keyFunction()"    name="ta069" value="<?php echo $ta069; ?>"  size="12" /></td>
	    <td class="normal14"  >運輸方式：</td>
        <td class="normal14" ><select id="taxes" onKeyPress="keyFunction()" name="ta031" onchange="seltaxes(this)" tabIndex="20">
		    <option <?php if($ta031 == '2') echo 'selected="selected"';?> value='2'>2海運</option>
            <option <?php if($ta031 == '1') echo 'selected="selected"';?> value='1'>1空運</option> 
            <option <?php if($ta031 == '3') echo 'selected="selected"';?> value='3'>3海運聯空</option>
		    <option <?php if($ta031 == '4') echo 'selected="selected"';?> value='4'>4郵寄</option>
            <option <?php if($ta031 == '5') echo 'selected="selected"';?> value='5'>5陸運</option>
            <option <?php if($ta031 == '6') echo 'selected="selected"';?> value='6'>6自取</option>
            <option <?php if($ta031 == '7') echo 'selected="selected"';?> value='7'>7自送</option>
            <option <?php if($ta031 == '8') echo 'selected="selected"';?> value='8'>8快遞</option>			
		  </select></td>
	    <td class="normal14" >連絡人：</td>
        <td class="normal14"  ><input type="text"  readonly="value" tabIndex="21"   onKeyPress="keyFunction()"   name="ta005" value="<?php echo $ta005; ?>" style="background-color:#F0F0F0"  size="12" /></td>
	  </tr>
		
	  <tr>	   
	    <td class="normal14" >送貨地址1：</td>
        <td class="normal14" colspan="1" ><input type="text"  readonly="value" tabIndex="22"   onKeyPress="keyFunction()"   name="ta009" value="<?php echo $ta009; ?>" style="background-color:#F0F0F0"  size="40" /></td>
	    <td class="normal14" >送貨地址2：</td>
        <td class="normal14" colspan="1" ><input type="text"  readonly="value" tabIndex="23"   onKeyPress="keyFunction()"   name="ta010" value="<?php echo $ta010; ?>" style="background-color:#F0F0F0"  size="40" /></td>
	    <td class="start14a"></td>		
        <td class="start14"  ></td>
	  </tr>
	  <tr>	   
	    <td class="normal14" >文件地址1：</td>
        <td class="normal14" colspan="1" ><input type="text"  readonly="value" tabIndex="24"   onKeyPress="keyFunction()"   name="ta011" value="<?php echo $ta011; ?>" style="background-color:#F0F0F0"  size="40" /></td>
	    <td class="normal14" >文件地址2：</td>
        <td class="normal14" colspan="1" ><input type="text"  readonly="value" tabIndex="25"   onKeyPress="keyFunction()"   name="ta012" value="<?php echo $ta012; ?>" style="background-color:#F0F0F0"  size="40" /></td>
	    <td class="start14a"></td>		
        <td class="start14"  ></td>
	  </tr>
	</table>
	</div>
	
	<!--  發票 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="9%">發票客戶：</td>
        <td class="normal14a"  width="41%" ><input type="text" tabIndex="26"   onKeyPress="keyFunction()" id="ta013" name="ta013"   value="<?php echo $ta013; ?>"   />
	    <td class="normal14a"  width="8%" >統一編號：</td>
        <td class="normal14a"  width="42%" ><input type="text" tabIndex="27"   onKeyPress="keyFunction()" id="ta018" name="ta018"     value="<?php echo $ta018; ?>"    /></td>
	  </tr>			  
	 
	  <tr>
	    <td class="normal14">發票日期：</td>						
        <td class="normal14" ><input type="text" tabIndex="28"   onKeyPress="keyFunction()" id="ta016" name="ta016"     value="<?php echo $ta016; ?>"    />
		   <img  onclick="scwShow(ta016,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		<td class="normal14" >發票聯數：</td>						
        <td class="normal14" ><input type="text" tabIndex="29"   onKeyPress="keyFunction()" id="ta019" name="ta019"     value="<?php echo $ta019; ?>"    /></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14">發票號碼：</td>						
        <td class="normal14" ><input type="text" tabIndex="30"   onKeyPress="keyFunction()" id="ta017" name="ta017"     value="<?php echo $ta017; ?>"    /></td>
		<td class="normal14"  >課稅別：</td>
          <td class="normal14" ><select id="taxes" onKeyPress="keyFunction()" name="ta020" onchange="seltaxes(this)" tabIndex="31">
		    <option <?php  if($ta020 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php  if($ta020 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php  if($ta020 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php  if($ta020 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php  if($ta020 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select></td>
	  </tr>	
	    <tr>
	    <td class="normal14">發票地址1：</td>						
        <td class="normal14" colspan='3' ><input type="text" tabIndex="32"   onKeyPress="keyFunction()" id="ta014" name="ta014"  size="100"   value="<?php echo $ta014; ?>"    /></td>
		<td class="normal14" ></td>						
        <td class="normal14" ></td>
	  </tr>	
	   <tr>
	    <td class="normal14">發票地址2：</td>						
        <td class="normal14" colspan='3' ><input type="text" tabIndex="33"   onKeyPress="keyFunction()" id="ta015" name="ta015"  size="100"   value="<?php echo $ta015; ?>"    /></td>
		<td class="normal14" ></td>						
        <td class="normal14" ></td>
	  </tr>	
	</table>
 
	</div> 	
	<!--  麥頭 -->
	<div id="tab3" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="8%">麥頭代號：</td>
        <td class="normal14a"  width="42%" ><input type="text" tabIndex="34"   onKeyPress="keyFunction()" id="ta028" name="ta028"   value="<?php echo $ta028; ?>"   />
	    <td class="normal14a"  width="8%" >麥頭名稱：</td>
        <td class="normal14a"  width="42%" ><input type="text" tabIndex="35"   onKeyPress="keyFunction()" id="ta028disp" name="ta028disp"     value="<?php echo $ta028disp; ?>"    /></td>
	  </tr>			  
	 
	  <tr>
	    <td class="normal14">正麥：</td>						
        <td class="normal14" ><textarea  tabIndex="36" rows="6" cols="40" name="ta063" id="ta063" Wrap="Physical" ></textarea></td>	
		<td class="normal14" >側麥：</td>						
        <td class="normal14" ><textarea  tabIndex="37" rows="6" cols="40" name="ta064" id="ta064" Wrap="Physical" ></textarea></td>
	  </tr>	
	</table>
	</div> 	
	<!--  訂單備註 -->
	<div id="tab4" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="10%">銷貨單別：</td>
        <td class="normal14a"  width="40%" ><input type="text" tabIndex="38"   onKeyPress="keyFunction()" id="ta026" name="ta026"   value="<?php echo $ta026; ?>"   />
	    <td class="normal14a"  width="10%" >銷貨單號：</td>
        <td class="normal14a"  width="40%" ><input type="text" tabIndex="39"   onKeyPress="keyFunction()" id="ta027" name="ta027"     value="<?php echo $ta027; ?>"    /></td>
	  </tr>			  
	 
	  <tr>
	    <td class="normal14">INVOICE備註：</td>						
        <td class="normal14" ><textarea  tabIndex="40" rows="6" cols="40" name="ta066" id="ta066" Wrap="Physical" ></textarea></td>	
		<td class="normal14" >PACKING備註：</td>						
        <td class="normal14" ><textarea  tabIndex="41" rows="6" cols="40" name="ta065" id="ta065" Wrap="Physical" ></textarea></td>
	  </tr>	
	</table>
	</div> 	
	<!--  船務1 -->
	<div id="tab5" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="11%">輸出許可證：</td>
        <td class="normal14a"  width="39%" ><input type="text" tabIndex="42"   onKeyPress="keyFunction()" id="ta035" name="ta035"   value="<?php echo $ta035; ?>"   />
	    <td class="normal14a"  width="10%" >驗貨公司：</td>
        <td class="normal14a"  width="40%" ><input type="text" tabIndex="43"   onKeyPress="keyFunction()" id="ta043" name="ta043"     value="<?php echo $ta043; ?>"    /></td>
	  </tr>			  
	 
	  <tr>
	    <td class="normal14">大提單號：</td>						
        <td class="normal14" ><input type="text" tabIndex="44"   onKeyPress="keyFunction()" id="ta036" name="ta036"     value="<?php echo $ta036; ?>"    /></td>
		<td class="normal14" >報關行：</td>						
        <td class="normal14" ><input type="text" tabIndex="45"   onKeyPress="keyFunction()" id="ta044" name="ta044"     value="<?php echo $ta044; ?>"    /></td>
	  </tr>	
	   <tr>
	    <td class="normal14">小提單號：</td>						
        <td class="normal14" ><input type="text" tabIndex="46"   onKeyPress="keyFunction()" id="ta037" name="ta037"     value="<?php echo $ta037; ?>"    /></td>
		<td class="normal14" >FORWARDER：</td>						
        <td class="normal14" ><input type="text" tabIndex="47"   onKeyPress="keyFunction()" id="ta045" name="ta045"     value="<?php echo $ta045; ?>"    /></td>
	  </tr>	
	   <tr>
	    <td class="normal14">NOTIFY：</td>						
        <td class="normal14" ><input type="text" tabIndex="48"   onKeyPress="keyFunction()" id="ta038" name="ta038"     value="<?php echo $ta038; ?>"    /></td>
		<td class="normal14" >海關封簽：</td>						
        <td class="normal14" ><input type="text" tabIndex="49"   onKeyPress="keyFunction()" id="ta059" name="ta059"     value="<?php echo $ta059; ?>"    /></td>
	  </tr>	
	   <tr>
	    <td class="normal14">報單號碼：</td>						
        <td class="normal14" ><input type="text" tabIndex="50"   onKeyPress="keyFunction()" id="ta051" name="ta051"     value="<?php echo $ta051; ?>"    /></td>
		<td class="normal14" >E.T.A：</td>						
        <td class="normal14" ><input type="text" tabIndex="51"   onKeyPress="keyFunction()" id="ta039" name="ta039"     value="<?php echo $ta039; ?>"    />
	    <img  onclick="scwShow(ta039,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>	
	   <tr>
	    <td class="normal14">INVOICE NO：</td>						
        <td class="normal14" ><input type="text" tabIndex="52"   onKeyPress="keyFunction()" id="ta042" name="ta042"     value="<?php echo $ta042; ?>"    /></td>
		<td class="normal14" >E.T.D：</td>						
        <td class="normal14" ><input type="text" tabIndex="53"   onKeyPress="keyFunction()" id="ta040" name="ta040"     value="<?php echo $ta040; ?>"    />
	    <img  onclick="scwShow(ta040,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>	
	</table>
 
	</div> 	
	<!--  船務2 -->
	<div id="tab6" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="8%">貨櫃號碼：</td>
        <td class="normal14a"  width="42%" ><input type="text" tabIndex="54"   onKeyPress="keyFunction()" id="ta040" name="ta040"   value="<?php echo $ta040; ?>"   />
	    <td class="normal14a"  width="8%" >船名：</td>
        <td class="normal14a"  width="42%" ><input type="text" tabIndex="55"   onKeyPress="keyFunction()" id="ta049" name="ta049"     value="<?php echo $ta049; ?>"    /></td>
	  </tr>			  
	 
	  <tr>
	    <td class="normal14">貨櫃尺寸：</td>						
        <td class="normal14" ><input type="text" tabIndex="56"   onKeyPress="keyFunction()" id="ta047" name="ta047"     value="<?php echo $ta047; ?>"    /></td>
		<td class="normal14" >船次：</td>						
        <td class="normal14" ><input type="text" tabIndex="57"   onKeyPress="keyFunction()" id="ta050" name="ta050"     value="<?php echo $ta050; ?>"    /></td>
	  </tr>	
	   <tr>
	    <td class="normal14">貨櫃場：</td>						
        <td class="normal14" ><input type="text" tabIndex="58"   onKeyPress="keyFunction()" id="ta048" name="ta048"     value="<?php echo $ta048; ?>"    /></td>
		<td class="normal14" >S/I NO：</td>						
        <td class="normal14" ><input type="text" tabIndex="59"   onKeyPress="keyFunction()" id="ta055" name="ta055"     value="<?php echo $ta055; ?>"    /></td>
	  </tr>	
	   <tr>
	    <td class="normal14">提單內容：</td>						
        <td class="normal14" ><input type="text" tabIndex="60"   onKeyPress="keyFunction()" id="ta060" name="ta060"     value="<?php echo $ta060; ?>"    /></td>
		<td class="normal14" >裝船日：</td>						
        <td class="normal14" ><input type="text" tabIndex="61"   onKeyPress="keyFunction()" id="ta054" name="ta054"     value="<?php echo $ta054; ?>"    />
	     <img  onclick="scwShow(ta054,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>	
	   <tr>
	    <td class="normal14">起始港口：</td>						
        <td class="normal14" ><input type="text" tabIndex="62"   onKeyPress="keyFunction()" id="ta056" name="ta056"     value="<?php echo $ta056; ?>"    /></td>
		<td class="normal14" >裝貨日：</td>						
        <td class="normal14" ><input type="text" tabIndex="63"   onKeyPress="keyFunction()" id="ta053" name="ta053"     value="<?php echo $ta053; ?>"    />
	    <img  onclick="scwShow(ta053,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>	
	   <tr>
	    <td class="normal14">目的港口：</td>						
        <td class="normal14" ><input type="text" tabIndex="64"   onKeyPress="keyFunction()" id="ta057" name="ta057"     value="<?php echo $ta057; ?>"    /></td>
		<td class="normal14" >結關日：</td>						
        <td class="normal14" ><input type="text" tabIndex="65"   onKeyPress="keyFunction()" id="ta052" name="ta052"     value="<?php echo $ta052; ?>"    />
	     <img  onclick="scwShow(ta052,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>	
	   <tr>
	    <td class="normal14">目的地：</td>						
        <td class="normal14" ><input type="text" tabIndex="66"   onKeyPress="keyFunction()" id="ta058" name="ta058"     value="<?php echo $ta058; ?>"    /></td>
		<td class="normal14" >貨盤單位：</td>						
        <td class="normal14" ><input type="text" tabIndex="67"   onKeyPress="keyFunction()" id="ta067" name="ta067"     value="<?php echo $ta067; ?>"    /></td>
	  </tr>	
	</table>
 
	</div> 	
	</div> <!-- </div>div-8 -->
	 </div> <!--</div>  div-7 -->
	 
	 <!-- 明細表頭  -->
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
				<td colspan="2" class="right"><span></span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　訂單金額：</b></td>
				<td ><input type='text' readonly="value" name='ta029' id="ta029" size="8" value="<?php echo $ta029; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta030' id="ta068" size="8" value="<?php echo $ta068; ?>"  style="background-color:#F0F0F0" /></td>
			
				<td class="right" valign="top"><b style="color: #003A88;">　　合計金額：</b></td>
				<td ><input type='text' readonly="value" name="tc2968" id="tc2968" size="8" value="<?php echo $ta029+$ta068; ?>"  style="background-color:#F0F0F0" /></td>
				
					<input id="select_rows" style="display:none;"/>
				<td class="left" valign="top"></td>
              </tr>
		<!-- 合計     -->	  
	 <div class="buttons">
	   <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('eps/epsi05/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div> 
   </div> 	<!-- end 頁標籤 -->   
   </form>
	   <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位,交貨庫別,可輸入部份品號或品名下拉視窗選擇,圖示1客戶商品計價查詢,欄位淡黃色按2下開視窗查詢,按Enter鍵或Tab鍵跳下一個欄位,Alt+y跳到明細資料, Alt+w新增一筆明細. ] ' ?> </div>  <?php } ?>
	
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
   
	</div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->

<?php  include_once("./application/views/funnew/epsi01_funmjs_v.php"); ?> <!-- 單別 -->
<?php  include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?>  <!-- 人員 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/copi01a_funmjs_v.php"); ?>  <!-- 客戶回傳多欄 -->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?>  <!-- 部門 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->
<?php  include_once("./application/views/funnew/cmsi21_funmjs_v.php"); ?>  <!-- 付款條件 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/epsi05_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#epsi01').focus();
	}); 	   
</script> 	    	