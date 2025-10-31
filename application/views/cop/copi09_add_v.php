<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
   <!--   <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 客戶銷退單資料建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#copi03').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onfocus="chkno1(this)" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;	
	 <a  accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cop/copi09/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/cop/copi09/addsave" >	
	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  if(!isset($ti001)) { $ti001=$this->input->post('ti001'); }
	  if(!isset($ti001disp)) { $ti001disp=$this->input->post('ti001'); }
	 
      $ti002=$this->input->post('ti002');
	  $ti003=date("Y/m/d");
	  $ti004=$this->input->post('ti004'); 
	  $ti004disp=$this->input->post('ti004'); 
	//  $ti013=$this->input->post('ti013');	 
	//  $ti042=$this->input->post('ti042');
	  $ti007=$this->input->post('ti007');
	  if(!isset($ti034)) { $ti034=date("Y/m/d"); }
	  if(!isset($ti003)) { $ti003=date("Y/m/d"); }
       
	  if(!isset($ti019)) { $ti019='Y'; }
	  $ti031=$this->input->post('ti031');
	  $ti032=$this->input->post('ti032');
	  $ti042=$this->input->post('ti042');
	  $ti043=$this->input->post('ti043');
	  
	  $ti010=$this->input->post('ti010');
	  $ti011=$this->input->post('ti011');
	  $ti037=$this->input->post('ti037');
	  $ti038=$this->input->post('ti038');
	  $ti029=$this->input->post('ti029');
	  
	  if(!isset($sysma200)) { $sysma200=$this->session->userdata('sysma200'); }
	  if(!isset($sysma201)) { $sysma201=$this->session->userdata('sysma201'); }
	?>
	 <?php
	 //交易
	   $ti005=$this->input->post('ti005');
	   $ti005disp=$this->input->post('ti005');
	   $ti006=$this->input->post('ti006');
	   $ti006disp=$this->input->post('ti006');
	   $ti007=$this->input->post('ti007');
	   $ti007disp=$this->input->post('ti007');
	   $ti008=$this->input->post('ti008');
	   $ti008disp=$this->input->post('ti008');
	   $ti039=$this->input->post('ti039');
	   $ti039disp=$this->input->post('ti039');
	   $ti030=$this->input->post('ti030');
	   $ti030disp=$this->input->post('ti030');
	   $ti022=$this->input->post('ti022');
	   $ti022disp=$this->input->post('ti022');
	  // if(!isset($ti007)) { $ti007=0.05; } sysma003 ntd sysma004 0.5
	     if(!isset($ti035)) { $ti035=$username; }
	   $cmsq06a=$this->session->userdata('sysma003');
	   $ti044=$this->session->userdata('sysma004');
	   
	   
	  // $ti042=$this->input->post('ti042');
	   if(!isset($ti041)) { $ti041='N'; }
	//   $ti008=$this->input->post('ti008'); 匯率
	   if(!isset($ti009)) { $ti009=1; }
	  
	   $ti028=$this->input->post('ti028');
	   $ti016=$this->input->post('ti016');
	 
	   $ti020=$this->input->post('ti020');
	  
	  ?>
	  
	   <?php
	   //發票
	   $ti014=$this->input->post('ti014');
	   $ti017=$this->input->post('ti017');
	   $ti015=$this->input->post('ti015');
	   $ti021=$this->input->post('ti021');
	   $ti012=$this->input->post('ti012');
	   $ti013=$this->input->post('ti013');
	  //0.05
	   if(!isset($ti036)) { $ti036=$this->session->userdata('sysma004'); }
	   $ti017=$this->input->post('ti017');
	   $ti030=$this->input->post('ti030');
	   $ti026=$this->input->post('ti026');
	   $ti027=$this->input->post('ti027');
	   $ti033=$this->input->post('ti033');
	  ?>
	    <?php
		//其他
	 
	   $cmsq09a31=$this->input->post('ti022');
	   $cmsq09a31disp=$this->input->post('ti022');
	   $ti023=$this->input->post('ti023');
	   $ti024=$this->input->post('ti024');
	   $ti025=$this->input->post('ti025');
	  ?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="9%"><span class="required">銷退單別：</span> </td>
        <td class="normal14a"  width="25%"><input tabIndex="1" id="copi03"    onKeyPress="keyFunction()" ondblclick="search_copi03_window()"  name="ti001" onfocus="check_title_no();" onblur="check_copi03(this);check_title_no();"  value="<?php echo $ti001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showcopi03disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="copi03disp"> <?php    echo $ti001disp; ?> </span></td>
	    <td class="normal14y" width="8%" >單據日期： </td>
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);" onfocus="this.select()"  id="ti034" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="ti034"  value="<?php echo $ti034; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ti034,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
		   <td class="normal14y"  width="8%" ><span class="required">銷退單號：</span></td>
        <td class="normal14a"  width="25%" ><input tabIndex="3" id="ti002" onKeyPress="keyFunction()" onfocus="check_title_no();" name="ti002" value="<?php echo $ti002; ?>" size="30" type="text" required /></td>
	  </tr>	
	  <tr>
		 <td class="normal14z">客戶代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="copi01" onKeyPress="keyFunction()" ondblclick="search_copi01_window()" onfocus="check_title_no();" onblur="check_copi01(this)" name="ti004" value="<?php echo $ti004; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="copi01disp"> <?php   echo $ti004disp; ?> </span></td>
	     <td class="normal14z">確認碼：</td>
          <td  class="normal14"  ><select id="ti019" onKeyPress="keyFunction()" name="ti019" onChange="selappr(this)" tabIndex="5">
            <option <?php if($ti019 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($ti019 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($ti019 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td> 
		<td class="normal14z">銷退日期：</td>
        <td  class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);" onfocus="this.select()"  id="ti003" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="ti003"  value="<?php echo $ti003; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ti003,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
		   </tr>
		
	  <tr>
	    <td  class="normal14z">分錄-收入：</td>						
        <td  class="normal14"  ><input type="hidden" name="ti031" value="N" readonly="value" />
		<input type='checkbox' tabIndex="7" id="ti031" onKeyPress="keyFunction()" name="ti031" <?php if($ti031 == 'Y' ) echo 'checked'; ?>  <?php if($ti031 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
		<td  class="normal14z">分錄成本：</td>						
        <td  class="normal14"  ><input type="hidden" name="ti032" value="N" readonly="value"  />
		<input type='checkbox' tabIndex="8" id="ti032" onKeyPress="keyFunction()" name="ti032" <?php if($ti032 == 'Y' ) echo 'checked'; ?>  <?php if($ti032 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
		 <td class="normal14z">流程代號：</td>
        <td  class="normal14"  ><input type="text" tabIndex="9" readonly="value"  onKeyPress="keyFunction()" id="ti042" name="ti042"   value="<?php echo $ti042; ?>" style="background-color:#EBEBE4"  /></td>
	  </tr>
	  <tr>
        <td class="normal14z">拋轉狀態：</td>
        <td  class="normal14"  ><select id="ti043" tabIndex="10" readonly="value" onKeyPress="keyFunction()" name="ti043"   style="background-color:#EBEBE4" >
            <option <?php if($ti043 == 'N') echo 'selected="selected"';?> value='N'>N.未拋轉</option>                                                                        
		    <option <?php if($ti043 == 'Y') echo 'selected="selected"';?> value='Y'>Y.拋轉成功(來源廠商)</option>
            <option <?php if($ti043 == 'y') echo 'selected="selected"';?> value='y'>y.拋轉成功(下游廠商)</option>
		    <option <?php if($ti043 == 'n') echo 'selected="selected"';?> value='n'>n.訂單變更</option>
            <option <?php if($ti043 == 'U') echo 'selected="selected"';?> value='U'>U.拋轉失敗</option>	
            <option <?php if($ti043 == 'u') echo 'selected="selected"';?> value='u'>u.還原失敗</option>	
		  </select></td>
		  <td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" /></td>
         <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" /></td>
		  <td class="normal14"></td>
		  <td class="normal14"></td>
	  </tr>
	 
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
		<li><a href="#tab1"  accesskey="a">交易資料a</a></li>
		<li><a href="#tab2"  accesskey="b">發票資料b</a></li>
		<li><a href="#tab3"  accesskey="c">其他資料c</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  交易資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	 
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="9%">廠別：</td>
       <td class="normal14a"  width="25%" ><input type="text" tabIndex="10" onKeyPress="keyFunction()" id="cmsi02"  onblur="check_cmsi02(this)" name="ti007"   value="<?php echo  $ti007; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	      <span id="cmsi02disp"> <?php    echo $ti007disp; ?> </span></td>
	   <td class="normal14y"  width="9%" > 件數：</td>
       <td class="normal14a"  width="24%" ><input type="text" tabIndex="12" id="ti028"   tabIndex="11"   onKeyPress="keyFunction()"    name="ti028" value="<?php echo $ti028; ?>"  /></td>	  
       <td class="normal14y" width="9%" >幣別：</td>
	   <td class="normal14a" width="24%" ><input tabIndex="11" id="cmsi06" onKeyPress="keyFunction()" name="ti008" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $ti008; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $ti008disp; ?> </span></td>
	 </tr>
	 
	  <tr>
	    <td  class="normal14z" >付款條件：</td>
        <td  class="normal14"  ><input tabIndex="15" id="cmsi21" ondblclick="search_cmsi21_window()" onKeyPress="keyFunction()" name="ti039" onblur="check_cmsi21(this)"   value="<?php echo  $ti039; ?>"   size="12"   type="text"  />
		  <a href="javascript:;"><img id="Showcmsi21disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
          <span id="cmsi21disp"> <?php    echo $ti039disp; ?> </span></td>		   
	    <td class="normal14z" >部門代號：</td>
       <td class="normal14a"  ><input type="text" tabIndex="10" onKeyPress="keyFunction()" id="cmsi05"  name="ti005"  onblur="check_cmsi05(this)"    value="<?php echo  $ti005; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Showcmsi05disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
	      <span id="cmsi05disp" > <?php    echo $ti005disp; ?> </span></td>
	    <td class="normal14z" >匯率：</td>		
        <td class="normal14"  ><input type="text" id="ti009"   tabIndex="16"   onKeyPress="keyFunction()"    name="ti009" value="<?php echo $ti009; ?>"  /></td>
	  </tr>
	  <tr>	   
	   <td class="normal14z" >業務人員：</td>
        <td class="normal14a"  ><input tabIndex="6" id="cmsi09" onKeyPress="keyFunction()" name="ti006" onblur="check_cmsi09(this)"  value="<?php echo $ti006; ?>"  type="text"  size="12"  />
		  <a href="javascript:;"><img id="Showcmsi09disp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
          <span id="cmsi09disp"> <?php    echo $ti006disp; ?> </span></td>
	    <td class="normal14z">備註：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="18"   onKeyPress="keyFunction()" id="ti020" name="ti020"   value="<?php echo $ti020; ?>"    /></td>
	    <td class="normal14z">員工代號</td>						
        <td  class="normal14"  ><input tabIndex="6" id="cmsi09a" onKeyPress="keyFunction()" name="ti030" onblur="check_cmsi09a(this)"  value="<?php echo $ti030; ?>"  type="text"  size="12"  />
		  <a href="javascript:;"><img id="Showcmsi09adisp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
          <span id="cmsi09adisp"> <?php    echo $ti030disp; ?> </span></td>
	  </tr>
	  
      <tr>
	    <td class="normal14z" >列印：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="20"   onKeyPress="keyFunction()" id="ti016" name="ti016"   value="<?php echo $ti016; ?>" disabled="disabled" /></td>
	    <td class="normal14z">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="21" readonly="value"  onKeyPress="keyFunction()" id="ti035" name="ti035"   value="<?php echo $ti035; ?>" style="background-color:#EBEBE4"  /></td>
	    <td  class="normal14z" >簽核狀態：</td>
        <td class="normal14"><select id="ti041" tabIndex="22" readonly="value" onKeyPress="keyFunction()" name="ti041"   style="background-color:#EBEBE4" disabled="disabled">
            <option <?php if($ti041 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($ti041 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($ti041 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($ti041 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($ti041 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($ti041 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($ti041 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($ti041 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
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
	   <td class="normal14y"  width="9%">統一編號：</td>
       <td class="normal14a"  width="25%" ><input type="text" tabIndex="26"   onKeyPress="keyFunction()" id="ti015" name="ti015"   value="<?php echo $ti015; ?>"   /></td>
	   <td class="normal14y"  width="10%" >發票號碼：</td>
       <td class="normal14a"  width="23%" ><input type="text" tabIndex="27"   onKeyPress="keyFunction()" id="ti014" name="ti014"   value="<?php echo $ti014; ?>"   /></td>
	   <td class="normal14y" width="10%">發票日期：</td>						
        <td  class="normal14a" width="23%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tg021" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="ti017"  value="<?php echo $ti017; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(ti017,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td></tr>			  
	 <tr>
	    <td  class="normal14z" >申報年月：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="29" id="ti026"  class="date-picker" onKeyPress="keyFunction()"  onchange="dateformat_ym(this);"  name="ti026" value="<?php echo $ti026; ?>"   /></td>	   
	    <td  class="normal14z">營業稅率：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="30" id="ti036"  onKeyPress="keyFunction()"   name="ti036" value="<?php echo $ti036; ?>"   /></td>
	    <td  class="normal14z">客戶全名：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="31" id="ti021"  onKeyPress="keyFunction()"   name="ti021" value="<?php echo $ti021; ?>"   /></td>
	  </tr>
	  <tr>
	    <td class="normal14z"  >扣抵區分：</td>
        <td class="normal14" ><select id="ti026" onKeyPress="keyFunction()" name="ti026"  tabIndex="26">
		    <option <?php if($ti026 == '1') echo 'selected="selected"';?> value='1'>1可扣抵進貨及費用</option>
            <option <?php if($ti026 == '2') echo 'selected="selected"';?> value='2'>2可扣抵固定資產</option> 
            <option <?php if($ti026 == '3') echo 'selected="selected"';?> value='3'>3 不可扣抵進貨及費用</option>
		    <option <?php if($ti026 == '4') echo 'selected="selected"';?> value='4'>4不可扣抵固定資產</option>
		  </select></td>
	   <td class="normal14z"  >發票聯數：</td>
        <td class="normal14" ><select id="ti012" onKeyPress="keyFunction()" name="ti012"  tabIndex="35">
		    <option <?php if($ti012 == '2') echo 'selected="selected"';?> value='2'>2三聯式</option>
            <option <?php if($ti012 == '1') echo 'selected="selected"';?> value='1'>1二聯式</option> 
            <option <?php if($ti012 == '3') echo 'selected="selected"';?> value='3'>3二聯式收銀機發票</option>
		    <option <?php if($ti012 == '4') echo 'selected="selected"';?> value='4'>4三聯式收銀機發票</option>
            <option <?php if($ti012 == '5') echo 'selected="selected"';?> value='5'>5電子計算機發票</option>
            <option <?php if($ti012 == '6') echo 'selected="selected"';?> value='6'>6免用統一發票</option>	
            <option <?php if($ti012 == 'A') echo 'selected="selected"';?> value='A'>A增值稅專用發票</option>	
            <option <?php if($ti012 == 'B') echo 'selected="selected"';?> value='B'>B普通發票</option>	
            <option <?php if($ti012 == 'C') echo 'selected="selected"';?> value='C'>C免用發票</option>				
		  </select></td>
		<td class="normal14z"  >課稅別：</td>
        <td class="normal14" ><select id="ti013" onKeyPress="keyFunction()" name="ti013" onchange="seltax()" tabIndex="36">
		    <option <?php if($ti013 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php if($ti013 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php if($ti013 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php if($ti013 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php if($ti013 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select><span  id="taxdisp" ></span></td>
	  
	  </tr>	
	  
	   <tr>
	    <td class="normal14z" >菸酒註記：</td>
        <td class="normal14"><input type="hidden" name="ti027" value="N" />
		<input type='checkbox' tabIndex="37" id="ti027" onKeyPress="keyFunction()" name="ti027" <?php if($ti027 == 'Y' ) echo 'checked'; ?>  <?php if($ti027 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td>  
        <td class="start14b" ></td>						
        <td  class="normal14"  ></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	</table>
 
	</div> 	
	<!--  其他資料 -->
	<div id="tab3" class="tab_content"> <!-- div-8 -->
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   
	   <td class="normal14y"  width="10%" >收款業務員：</td>
       <td class="normal14a"  width="40%" ><input tabIndex="6" id="cmsi09b" onKeyPress="keyFunction()" name="ti022" onblur="check_cmsi09b(this)"  value="<?php echo $ti022; ?>"  type="text"  size="12"  />
		  <a href="javascript:;"><img id="Showcmsi09bdisp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
          <span id="cmsi09bdisp"> <?php    echo $ti022disp; ?> </span></td>
	    <td  class="normal14y" width="8%" >備註一：</td>		
        <td  class="normal14a"  width="42%" ><input type="text"   tabIndex="43" id="ti023"  onKeyPress="keyFunction()"   name="ti023" value="<?php echo $ti023; ?>" size="70"  /></td>	
	 </tr>
	   <tr>
	    <td  class="normal14z">備註二：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="43" id="ti024"  onKeyPress="keyFunction()"   name="ti024" value="<?php echo $ti024; ?>"  size="70"   /></td>
	    <td  class="normal14z">備註三：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="44" id="ti025"  onKeyPress="keyFunction()"   name="ti025" value="<?php echo $ti025; ?>"  size="70"   /></td>
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
          <tfoot>
		 
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="27"></td>
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
				<td ><input type='text' readonly="value" name='ti010' id="ti010" size="8" value="<?php echo $ti010; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='ti011' id="ti011" size="8" value="<?php echo $ti011; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣合計：</b></td>
			<!--	<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="ti1011"><?php echo $ti010+$ti011; ?></span></b></td> -->
				<td ><input type='text' readonly="value" name='ti1011' id="ti1011" size="8" value="<?php echo $ti010+$ti011;?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣未稅額：</b></td>
				<td ><input type='text' readonly="value" name='ti037' id="ti037" size="8" value="<?php echo $ti037; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='ti038' id="ti038" size="8" value="<?php echo $ti038; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣合計：</b></td>
			<!--	<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot1"><?php echo $ti037+$ti038; ?></span></b></td> -->
				<td ><input type='text' readonly="value" name='ti3738' id="ti3738" size="8" value="<?php echo $ti037+$ti038; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　合計數量：</b></td>
				<td ><input type='text' readonly="value" name='ti029' id="ti029" size="8" value="<?php echo $ti029; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	  
	 <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onfocus="chkno1(this)" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	
	 <a  accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cop/copi09/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	 </div> 
		</div> 	   
    </form>
	   <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位,交貨庫別,可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位. ] ' ?> </div>  <?php } ?>
	
    </div> <!-- div-6 -->
	
  </div> <!-- div-5 -->
 
</div> <!-- div-4 -->

 
   
	</div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php  include_once("./application/views/funnew/copi03c_funmjs_v.php"); ?> <!-- 退貨單別 -->
<?php  include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?>  <!-- 業務員 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/copi01a_funmjs_v.php"); ?>  <!-- 客戶回傳多欄 -->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?>  <!-- 部門 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->
<?php  include_once("./application/views/funnew/cmsi21_funmjs_v.php"); ?>  <!-- 付款條件 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/copi09_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#copi03').focus();
	}); 
</script> 