<?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'tg042' || $key == 'tg042'){
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
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 客戶銷貨單資料建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cop/copi08/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	 <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('cop/copi08/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('cop/copi08/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>
	  </div>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cop/copi08/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
<!--	<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	
     <?php 
	  if(!isset($sysma200)) { $sysma200=$this->session->userdata('sysma200'); }
	  if(!isset($sysma201)) { $sysma201=$this->session->userdata('sysma201'); }  ?>
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="normal14y"  width="8%"><span class="required">銷貨單別：</span> </td>
        <td class="normal14a"  width="25%"><input tabIndex="1" id="copi03"  readonly="value"   onKeyPress="keyFunction()" ondblclick="search_copi03_window()"  name="tg001"  onchange="check_copi03(this);"  value="<?php echo $tg001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showcopi03disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="copi03disp"> <?php    echo $tg001disp; ?> </span></td>
	    <td class="normal14y" width="9%" >單據日期： </td>
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);" onfocus="this.select()"  id="tg042" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tg042"  value="<?php echo $tg042; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(tg042,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td><td class="normal14y"  width="9%" ><span class="required">銷貨單號：</span></td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="tg002" onKeyPress="keyFunction()" readonly="value"  name="tg002" value="<?php echo $tg002; ?>" size="30" type="text" required /></td>
	  </tr>	
	  <tr>
		 <td class="normal14z">客戶代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="copi01" onKeyPress="keyFunction()" ondblclick="search_copi01_window()"  onchange="check_copi01(this)" name="tg004" value="<?php echo $tg004; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="copi01disp"> <?php   echo $tg004disp; ?> </span></td>
	    <td  class="normal14z">現銷：</td>						
        <td  class="normal14"  ><input type="hidden" name="tg034" value="N" />
		<input type='checkbox' tabIndex="5" id="tg034" onKeyPress="keyFunction()" name="tg034" <?php if($tg034 == 'Y' ) echo 'checked'; ?>  <?php if($tg034 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
	     <td class="normal14z">確認碼：</td>
          <td  class="normal14"  ><select id="verify" onKeyPress="keyFunction()" name="tg023" onChange="selappr(this)" tabIndex="6">
            <option <?php if($tg023 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tg023 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tg023 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td> 
	  </tr>
		
	  <tr>
	     <td class="normal14z">銷貨日期：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" readonly="value"  onKeyPress="keyFunction()" id="tg003" name="tg003"   value="<?php echo date("Y/m/d"); ?>"  style="background-color:#EBEBE4" /></td>
	    <td  class="normal14z">分錄-收入：</td>						
        <td  class="normal14"  ><input type="hidden" name="tg036" value="N" readonly="value" />
		<input type='checkbox' tabIndex="8" id="tg036" onKeyPress="keyFunction()" name="tg036" <?php if($tg034 == 'Y' ) echo 'checked'; ?>  <?php if($tg036 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
		<td  class="normal14z">分錄-成本：</td>						
        <td  class="normal14"  ><input type="hidden" name="tg034" value="N" readonly="value"  />
		<input type='checkbox' tabIndex="9" id="tg037" onKeyPress="keyFunction()" name="tg037" <?php if($tg037 == 'Y' ) echo 'checked'; ?>  <?php if($tg037 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
		
	  </tr>
	  <tr>
	     <td class="normal14z">流程代號：</td>
        <td  class="normal14"  ><input type="text" tabIndex="10" readonly="value"  onKeyPress="keyFunction()" id="tg060" name="tg060"   value="<?php echo $tg060; ?>" style="background-color:#EBEBE4"  /></td>
        <td class="normal14z">拋轉狀態：</td>
        <td  class="normal14"  ><select id="tg059" tabIndex="11" readonly="value" onKeyPress="keyFunction()" name="tg059"   style="background-color:#EBEBE4" >
            <option <?php if($tg059 == 'N') echo 'selected="selected"';?> value='N'>N.未拋轉</option>                                                                        
		    <option <?php if($tg059 == 'Y') echo 'selected="selected"';?> value='Y'>Y.拋轉成功(來源廠商)</option>
            <option <?php if($tg059 == 'y') echo 'selected="selected"';?> value='y'>y.拋轉成功(下游廠商)</option>
		    <option <?php if($tg059 == 'n') echo 'selected="selected"';?> value='n'>n.訂單變更</option>
            <option <?php if($tg059 == 'U') echo 'selected="selected"';?> value='U'>U.拋轉失敗</option>	
            <option <?php if($tg059 == 'u') echo 'selected="selected"';?> value='u'>u.還原失敗</option>	
		  </select></td>
		  <td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" /></td>
         <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" /></td>
	  </tr>
	 
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
		<li><a href="#tab1"  accesskey="a">交易資料</a></li>
		<li><a href="#tab2"  accesskey="b">發票資料</a></li>
		<li><a href="#tab3"  accesskey="c">其他資料</a></li>
		<li><a href="#tab4"  accesskey="g">訂金資料</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  交易資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	 
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="9%">廠別：</td>
       <td class="normal14a"  width="25%" ><input type="text" tabIndex="10" onKeyPress="keyFunction()" id="cmsi02"  onblur="check_cmsi02(this)" name="tg010"   value="<?php echo  $tg010; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	      <span id="cmsi02disp"> <?php    echo $tg010disp; ?> </span></td>
	   <td class="normal14y"  width="9%" > 件數：</td>
       <td class="normal14a"  width="27%" ><input type="text" tabIndex="13" id="tg032"   tabIndex="11"   onKeyPress="keyFunction()"    name="tg032" value="<?php echo $tg032; ?>"  /></td>	  
       <td class="normal14y" width="9%" >幣別：</td>
	   <td class="normal14a" width="26%" ><input tabIndex="11" id="cmsi06" onKeyPress="keyFunction()" name="tg011" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $tg011; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $tg011disp; ?> </span></td>
	 </tr>
	 
	  <tr>
	    <td  class="normal14z" >付款條件：</td>
        <td  class="normal14"  ><input tabIndex="15" id="cmsi21" ondblclick="search_cmsi21_window()" onKeyPress="keyFunction()" name="tg047" onblur="check_cmsi21(this)"   value="<?php echo  $tg047; ?>"   size="12"   type="text"  />
		  <a href="javascript:;"><img id="Showcmsi21disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
          <span id="cmsi21disp"> <?php    echo $tg047disp; ?> </span></td>		   
	    <td class="normal14z" >部門代號：</td>
       <td class="normal14a"  ><input type="text" tabIndex="10" onKeyPress="keyFunction()" id="cmsi05"  name="tg005"  onblur="check_cmsi05(this)"    value="<?php echo  $tg005; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Showcmsi05disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
	      <span id="cmsi05disp" > <?php    echo $tg005disp; ?> </span></td>
	    <td class="normal14z" >匯率：</td>		
        <td class="normal14"  ><input type="text" id="tg012"   tabIndex="17"   onKeyPress="keyFunction()"    name="tg012" value="<?php echo $tg012; ?>"  /></td>
	  </tr>
	  <tr>	   
	   <td class="normal14z" >業務人員：</td>
        <td class="normal14a"  ><input tabIndex="6" id="cmsi09" onKeyPress="keyFunction()" name="tg006" onblur="check_cmsi09(this)"  value="<?php echo $tg006; ?>"  type="text"  size="12"  />
		  <a href="javascript:;"><img id="Showcmsi09disp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
          <span id="cmsi09disp"> <?php    echo $tg006disp; ?> </span></td>
	    <td class="normal14z">備註：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="19"   onKeyPress="keyFunction()" id="tg020" name="tg020"   value="<?php echo $tg020; ?>"    /></td>
	    <td class="normal14z">送貨地址1：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="20"   onKeyPress="keyFunction()" id="tg008" name="tg008"   value="<?php echo $tg008; ?>"  size="40px"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14z">帳單地址：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="21"   onKeyPress="keyFunction()" id="tg009" name="tg009"   value="<?php echo $tg009; ?>"  size="40px"  /></td>
		<td class="normal14z" >列印：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="22"   onKeyPress="keyFunction()" id="tg022" name="tg022"   value="<?php echo $tg022; ?>" disabled="disabled" /></td>
	    <td class="normal14z" >發票列印：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="23"   onKeyPress="keyFunction()" id="tg041" name="tg041"   value="<?php echo $tg041; ?>" disabled="disabled" /></td>
	  </tr>
      <tr>
	    <td class="normal14z">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="24" readonly="value"  onKeyPress="keyFunction()" id="tg043" name="tg043"   value="<?php echo $tg043; ?>" style="background-color:#EBEBE4"  /></td>
	    <td  class="normal14z" >簽核狀態：</td>
        <td class="normal14"><select id="tg055" tabIndex="25" readonly="value" onKeyPress="keyFunction()" name="tg055"   style="background-color:#EBEBE4" disabled="disabled">
            <option <?php if($tg055 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tg055 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($tg055 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tg055 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tg055 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tg055 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tg055 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tg055 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
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
       <td class="normal14a"  width="26%" ><input type="text" tabIndex="26"   onKeyPress="keyFunction()" id="tg015" name="tg015"   value="<?php echo $tg015; ?>"   /></td>
	   <td class="normal14y"  width="9%" >發票號碼：</td>
       <td class="normal14a"  width="26%" ><input type="text" tabIndex="27"   onKeyPress="keyFunction()" id="tg014" name="tg014"   value="<?php echo $tg014; ?>"   /></td>
	   <td class="normal14y" width="9%">發票日期：</td>						
        <td  class="normal14a" width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tg021" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="tg021"  value="<?php echo $tg021; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tg021,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td></tr>			  
	 <tr>
	    <td  class="normal14z" >申報年月：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="29" id="tg038" ondblclick="fPopCalendar(event,this,this)" onfocus="this.select()" onKeyPress="keyFunction()"  onclick="dateym();" class="date-picker" name="tg038" value="<?php echo $tg038; ?>"   /></td>	   
	    <td  class="normal14z">營業稅率：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="30" id="tg044"  onKeyPress="keyFunction()"   name="tg044" value="<?php echo $tg044; ?>"   /></td>
	    <td  class="normal14z">客戶全名：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="31" id="tg007"  onKeyPress="keyFunction()"   name="tg007" value="<?php echo $tg007; ?>"   /></td>
	  </tr>
	  <tr>
	    <td  class="normal14z" >發票地址1：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="32" id="tg018"  onKeyPress="keyFunction()"   name="tg018" value="<?php echo $tg018; ?>" size="40px"  /></td>	   
	    <td  class="normal14z">發票地址2：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="33" id="tg019"  onKeyPress="keyFunction()"   name="tg019" value="<?php echo $tg019; ?>"  size="40px" /></td>
	    <td class="normal14z" >隨貨附發票：</td>
        <td class="normal14"><input type="hidden" name="tg061" value="N" />
		<input type='checkbox' tabIndex="34" id="tg061" onKeyPress="keyFunction()" name="tg061" <?php if($tg061 == 'Y' ) echo 'checked'; ?>  <?php if($tg061 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
	  </tr>
	  <tr>
	   <td class="normal14z"  >發票聯數：</td>
        <td class="normal14" ><select id="tg016" onKeyPress="keyFunction()" name="tg016"  tabIndex="35">
		    <option <?php if($tg016 == '2') echo 'selected="selected"';?> value='2'>2三聯式</option>
            <option <?php if($tg016 == '1') echo 'selected="selected"';?> value='1'>1二聯式</option> 
            <option <?php if($tg016 == '3') echo 'selected="selected"';?> value='3'>3二聯式收銀機發票</option>
		    <option <?php if($tg016 == '4') echo 'selected="selected"';?> value='4'>4三聯式收銀機發票</option>
            <option <?php if($tg016 == '5') echo 'selected="selected"';?> value='5'>5電子計算機發票</option>
            <option <?php if($tg016 == '6') echo 'selected="selected"';?> value='6'>6免用統一發票</option>	
            <option <?php if($tg016 == 'A') echo 'selected="selected"';?> value='A'>A增值稅專用發票</option>	
            <option <?php if($tg016 == 'B') echo 'selected="selected"';?> value='B'>B普通發票</option>	
            <option <?php if($tg016 == 'C') echo 'selected="selected"';?> value='C'>C免用發票</option>				
		  </select></td>
		<td class="normal14z"  >課稅別：</td>
        <td class="normal14" ><select id="tg017" onKeyPress="keyFunction()" name="tg017" onchange="seltax()" tabIndex="36">
		    <option <?php if($tg017 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php if($tg017 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php if($tg017 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php if($tg017 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php if($tg017 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select><span  id="taxdisp" ></span></td>
	  <td class="normal14z" >菸酒註記：</td>
        <td class="normal14"><input type="hidden" name="tg043" value="N" />
		<input type='checkbox' tabIndex="37" id="tg031" onKeyPress="keyFunction()" name="tg031" <?php if($tg031 == 'Y' ) echo 'checked'; ?>  <?php if($tg031 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
	  </tr>	
	  
	   <tr>
	    <td  class="normal14z">發票作廢：</td>						
        <td  class="normal14"  ><input type="hidden" name="tg030" value="N" />
		<input type='checkbox' tabIndex="38" id="tg030" onKeyPress="keyFunction()" name="tg030" <?php if($tg030 == 'Y' ) echo 'checked'; ?>  <?php if($tg030 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
       	<td class="normal14"></td>
        <td class="normal14"></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	</table>
 
	</div> 	
	<!--  其他資料 -->
	<div id="tab3" class="tab_content"> <!-- div-8 -->
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="11%">員工代號：</td>
       <td class="normal14a"  width="23%" ><input tabIndex="6" id="cmsi09a" onKeyPress="keyFunction()" name="tg035" onblur="check_cmsi09a(this)"  value="<?php echo $tg035; ?>"  type="text"  size="12"  />
		  <a href="javascript:;"><img id="Showcmsi09adisp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
          <span id="cmsi09adisp"> <?php    echo $tg035disp; ?> </span></td>
	   <td class="normal14y"  width="15" >收款業務員：</td>
       <td class="normal14a"  width="22%" ><input tabIndex="6" id="cmsi09b" onKeyPress="keyFunction()" name="tg026" onblur="check_cmsi09b(this)"  value="<?php echo $tg026; ?>"  type="text"  size="12"  />
		  <a href="javascript:;"><img id="Showcmsi09bdisp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
          <span id="cmsi09bdisp"> <?php    echo $tg026disp; ?> </span></td>
	   <td  class="normal14y"  width="10%" >L/C NO：</td>
        <td  class="normal14a" width="24%" ><input type="text"   tabIndex="41" id="tg039"  onKeyPress="keyFunction()"   name="tg039" value="<?php echo $tg039; ?>"   /></td>	
	 </tr>
	   <tr>
	    <td  class="normal14z" >INVOICE NO：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="42" id="tg040"  onKeyPress="keyFunction()"   name="tg040" value="<?php echo $tg040; ?>"   /></td>	   
	    <td  class="normal14z">備註一：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="43" id="tg027"  onKeyPress="keyFunction()"   name="tg027" value="<?php echo $tg027; ?>"   /></td>
	    <td  class="normal14z">備註二：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="44" id="tg028"  onKeyPress="keyFunction()"   name="tg028" value="<?php echo $tg028; ?>"   /></td>
	  </tr>
	  <tr>
	    <td  class="normal14z">備註三：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="45" id="tg029"  onKeyPress="keyFunction()"   name="tg029" value="<?php echo $tg029; ?>"   /></td>
		<td  class="normal14z" >更換發票：</td>
        <td  class="normal14"  ><input type="hidden" name="tg056" value="N" />
		<input type='checkbox' tabIndex="46" id="tg056" onKeyPress="keyFunction()" name="tg056" <?php if($tg056 == 'Y' ) echo 'checked'; ?>  <?php if($tg056 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td>   
	    <td  class="normal14z">新銷貨單別：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="47" id="tg057"  onKeyPress="keyFunction()"   name="tg057" value="<?php echo $tg057; ?>" disabled="disabled"  /></td>
	  </tr>
	 
	  <tr>
	    <td  class="normal14z">新銷貨單號：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="48" id="tg058"  onKeyPress="keyFunction()"   name="tg058" value="<?php echo $tg058; ?>" disabled="disabled"  /></td>
		<td class="normal14"></td>
        <td class="normal14"></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	</table>
 
	</div> 	
	<!--  訂金資料 -->
	<div id="tab4" class="tab_content"> <!-- div-8 -->
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="12%">訂單單別：</td>
       <td class="normal14a"  width="38%" ><input type="text" tabIndex="49"   onKeyPress="keyFunction()" id="tg048" name="tg048"   value="<?php echo $tg048; ?>"   /></td>
	   <td class="normal14y"  width="12%" >訂單單號：</td>
       <td class="normal14a"  width="38%" ><input type="text" tabIndex="50"   onKeyPress="keyFunction()" id="tg049" name="tg049"   value="<?php echo $tg049; ?>"   /></td>
	 </tr>
	  <tr>
	    <td  class="normal14" >沖抵金額：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="51" id="tg052"  onKeyPress="keyFunction()"   name="tg052" value="<?php echo $tg052; ?>"   /></td>	   
	    <td  class="normal14">沖抵稅額：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="52" id="tg053"  onKeyPress="keyFunction()"   name="tg053" value="<?php echo $tg053; ?>"   /></td>
	  </tr>
	  <tr>
	    <td  class="normal14" >預付待抵單別：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="53" id="tg050"  onKeyPress="keyFunction()"   name="tg050" value="<?php echo $tg050; ?>" disabled="disabled"  /></td>	   
	    <td  class="normal14">預付待抵單號：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="54" id="tg051"  onKeyPress="keyFunction()"   name="tg051" value="<?php echo $tg051; ?>" disabled="disabled"  /></td>
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
				echo "<td class='center'><img src='".base_url()."assets/image/delete.png' title='刪除資料' onclick='del_detail(\"".$val->th001."\",\"".$val->th002."\",\"".$val->th003."\",\"".$current_product_count."\");' /></td>";
				foreach($usecol_array as $k => $v){
					if($k=="tb016" ){
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
	</div>
	<!-- 合計     -->
		     <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span>
				</span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　原幣未稅額：</b></td>
				<td ><input type='text' readonly="value" name='tg013' id="tg013" size="8" value="<?php echo $tg013; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='tg025' id="tg025" size="8" value="<?php echo $tg025; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣合計：</b></td>
			<!--	<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot"><?php echo $tg013+$tg025; ?></span></b></td> -->
				<td ><input type='text' readonly="value" name='tg1325' id="tg1325" size="8" value="<?php echo $tg013+$tg025; ?>"  style="background-color:#EBEBE4" /></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣未稅額：</b></td>
				<td ><input type='text' readonly="value" name='tg045' id="tg045" size="8" value="<?php echo $tg045; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='tg046' id="tg046" size="8" value="<?php echo $tg046; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣合計：</b></td>
			<!--	<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot1"><?php echo $tg045+$tg046; ?></span></b></td> -->
				<td ><input type='text' readonly="value" name='tg4546' id="tg4546" size="8" value="<?php echo $tg045+$tg046; ?>"  style="background-color:#EBEBE4" /></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　合計數量：</b></td>
				<td ><input type='text' readonly="value" name='tg033' id="tg033" size="8" value="<?php echo $tg033; ?>"  style="background-color:#EBEBE4" /></td>
				<td style="display:none;"><input id="select_rows" />
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->		
	<!--<div class="buttons">
	
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cop/copi08/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	 <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('cop/copi08/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('cop/copi08/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
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
<?php  include_once("./application/views/funnew/fun_disabled_v.php"); ?> 