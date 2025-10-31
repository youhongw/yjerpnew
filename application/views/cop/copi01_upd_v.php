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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 客戶基本資料建立作業 - 修改　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#ma001').focus();" tabIndex="8" type='submit' accesskey="s" name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	    <a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cop/copi01/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	   
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cop/copi01/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $ma001=$row->ma001;?>
          <?php   $ma002=$row->ma002;?>
          <?php   $ma003=$row->ma003;?>
		  <?php   $ma004=$row->ma004;?>
          <?php   $ma005=$row->ma005;?>
		  <?php   $ma006=$row->ma006;?>
		  <?php   $ma007=$row->ma007;?>
		  <?php   $ma008=$row->ma008;?>
		  <?php   $ma009=$row->ma009;?>
		  <?php   $ma010=$row->ma010;?>
		  <?php   $ma011=$row->ma011;?>
          <?php   $ma012=$row->ma012;?>
          <?php   $ma013=$row->ma013;?>
          <?php   $cmsq06a=$row->ma014;?>
          <?php   $cmsq05a=$row->ma015;?>
          <?php   $cmsq09a3=$row->ma016;?>
		  <?php   $cmsq15a1=$row->ma017;?>
		  <?php   $cmsq15a3=$row->ma018;?>
		  <?php   $cmsq15a4=$row->ma019;?>
		  <?php   if ($row->ma020>'0' ) {$ma020=substr($row->ma020,0,4).'/'.substr($row->ma020,4,2).'/'.substr($row->ma020,6,2);} else {$ma020='';} ?>	
		  <?php   if ($row->ma021>'0' ) {$ma020=substr($row->ma021,0,4).'/'.substr($row->ma021,4,2).'/'.substr($row->ma021,6,2);} else {$ma021='';} ?>	
		  <?php   if ($row->ma022>'0' ) {$ma022=substr($row->ma022,0,4).'/'.substr($row->ma022,4,2).'/'.substr($row->ma022,6,2);} else {$ma022='';} ?>	
		  
          <?php   $ma023=$row->ma023;?>
          <?php   $ma024=$row->ma024;?>
          <?php   $ma025=$row->ma025;?>
          <?php   $ma026=$row->ma026;?>
		  <?php   $ma027=$row->ma027;?>
		  <?php   $ma028=$row->ma028;?>
		  <?php   $ma029=$row->ma029;?>
		  <?php   $ma030=$row->ma030;?>
		  <?php   $cmsq21a1=$row->ma031;?>
          <?php   $ma032=$row->ma032;?>
          <?php   $ma033=$row->ma033;?>
          <?php   $ma034=$row->ma034;?>
          <?php   $ma035=$row->ma035;?>
          <?php   $ma036=$row->ma036;?>
		  <?php   $ma037=$row->ma037;?>
		  <?php   $ma038=$row->ma038;?>
		  <?php   $ma039=$row->ma039;?>
		  <?php   $ma040=$row->ma040;?>
		  <?php   $ma041=$row->ma041;?>
          <?php   $ma042=$row->ma042;?>
          <?php   $ma043=$row->ma043;?>
          <?php   $ma044=$row->ma044;?>
          <?php   $ma045=$row->ma045;?>
          <?php   $cmsq16a=$row->ma046;?>
		  <?php   $actq03a1=$row->ma047;?>
		  <?php   $ma048=$row->ma048;?>
		  <?php   $ma049=$row->ma049;?>
		  <?php   $ma050=$row->ma050;?>
		  <?php   $ma051=$row->ma051;?>
          <?php   $ma052=$row->ma052;?>
          <?php   $ma053=$row->ma053;?>
          <?php   $purq01a1=$row->ma054;?>
          <?php   $purq01a2=$row->ma055;?>
          <?php   $copq01a1=$row->ma056;?>
		  <?php   $purq01a3=$row->ma057;?>
		  <?php   $purq01a4=$row->ma058;?>
		  <?php   $ma059=$row->ma059;?>
		  <?php   $ma060=$row->ma060;?>
		  <?php   $ma061=$row->ma061;?>
          <?php   $ma062=$row->ma062;?>
          <?php   $ma063=$row->ma063;?>
          <?php   $ma064=$row->ma064;?>
          <?php   $copq01a=$row->ma065;?>
          <?php   $ma066=$row->ma066;?>
		  <?php   $ma067=$row->ma067;?>
		   <?php   if ($row->ma068>'0' ) {$ma068=substr($row->ma068,0,4).'/'.substr($row->ma068,4,2).'/'.substr($row->ma068,6,2);} else {$ma068='';} ?>	
		 
		  <?php   $cmsq16a1=$row->ma069;?>
		  <?php   $cmsq16a2=$row->ma070;?>
		  <?php   $ma071=$row->ma071;?>
          <?php   $ma072=$row->ma072;?>
          <?php   $ma073=$row->ma073;?>
          <?php   $actq03a2=$row->ma074;?>
          <?php   $ma075=$row->ma075;?>
          <?php   $cmsq15a2=$row->ma076;?>
		  <?php   $cmsq15a5=$row->ma077;?>
		  <?php   $cmsq15a6=$row->ma078;?>
		  <?php   $ma079=$row->ma079;?>
		  <?php   $ma080=$row->ma080;?>
		  <?php   $ma081=$row->ma081;?>
          <?php   $ma082=$row->ma082;?>
          <?php   $ma083=$row->ma083;?>
          <?php   $ma084=$row->ma084;?>
          <?php   $cmsq09a31=$row->ma085;?>
          <?php   $ma086=$row->ma086;?>
		  <?php   $ma087=$row->ma087;?>
		  <?php   $ma088=$row->ma088;?>
		  <?php   $ma089=$row->ma089;?>
		  <?php   $ma090=$row->ma090;?>
		  <?php   $ma091=$row->ma091;?>
          <?php   $ma092=$row->ma092;?>
          <?php   $ma093=$row->ma093;?>
          <?php   $ma094=$row->ma094;?>
          <?php   $ma200=$row->ma200;?>
		   <?php   $ma201=$row->ma201;?>
		  <?php   $copq04a=$row->ma202;?>
		  <?php   $copq04adisp=$row->ma202disp;?>
		  
		   <?php   $cmsq16adisp=$row->ma046disp;?>
		    <?php   $cmsq16a1disp=$row->ma069disp;?>
			 <?php   $cmsq16a2disp=$row->ma070disp;?>
		  
		  <?php   $cmsq06adisp=$row->ma014disp;?>
          <?php   $cmsq05adisp=$row->ma015disp;?>
          <?php   $cmsq09a3disp=$row->ma016disp;?>
		  <?php   $cmsq15a1disp=$row->ma017disp;?>
		  <?php   $cmsq15a3disp=$row->ma018disp;?>
		  <?php   $cmsq15a4disp=$row->ma019disp;?>
		  <?php   $cmsq21a1disp=$row->ma031disp;?>
		  <?php   $actq03a1disp=$row->ma047disp;?>
		  <?php   $purq01a1disp=$row->ma054disp;?>
          <?php   $purq01a2disp=$row->ma055disp;?>
          <?php   $copq01a1disp=$row->ma056disp;?>
		  <?php   $purq01a3disp=$row->ma057disp;?>
		  <?php   $purq01a4disp=$row->ma058disp;?>
		  <?php   $copq01adisp=$row->ma065disp;?>
		  <?php   $actq03a2disp=$row->ma074disp;?>
		  <?php   $cmsq15a2disp=$row->ma076disp;?>
		  <?php   $cmsq15a5disp=$row->ma077disp;?>
		  <?php   $cmsq15a6disp=$row->ma078disp;?>
		  <?php   $cmsq09a31disp=$row->ma085disp;?>
		  
		  <?php   $mb991=' ';?>
		  <?php   $mb992=' ';?>
		  <?php   $mb999=' ';?>
		  <?php   $flag=$row->flag;?>
	<?php  }?> 

	<table class="form14"  >     <!-- 頭部表格 -->
	 <tr>
	    <td class="start14a"  width="10%"><span class="required">客戶代號：</span> </td>
        <td class="normal14a"  width="50%"><input tabIndex="1" id="ma001"    type="text"   onKeyPress="keyFunction()" onchange="startkey(this)"  name="ma001" value="<?php echo strtoupper($ma001); ?>"   required />
		  <span id="keydisp" ></span></td>
	    <td class="normal14a" width="10%" >統一編號： </td>
        <td class="normal14a"  width="50%" ><input tabIndex="2" id="ma010" onKeyPress="keyFunction()" name="ma010"  onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase()" value="<?php echo  strtoupper($ma010); ?>"    type="text"  /></td>
	 </tr>	
		  
	  <tr>
	    <td class="normal14" >客戶簡稱： </td>
        <td class="normal14" ><input tabIndex="3" id="ma002" onKeyPress="keyFunction()" onchange="checkspace(this)" name="ma002" value="<?php echo $ma002; ?>" size="30" type="text" required /><span id="spacedisp" ></span></td>
		<td class="normal14">客戶級別</td>
        <td class="normal14"> <select id="ma201" onKeyPress="keyFunction()" name="ma201" " tabIndex="4">
		     <option <?php if($ma201 == 'A') echo 'selected="selected"';?> value='A'>A級</option>                                                                        
		    <option <?php if($ma201 == 'B') echo 'selected="selected"';?> value='B'>B級</option>
            <option <?php if($ma201 == 'C') echo 'selected="selected"';?> value='C'>C級 </option>
            <option <?php if($ma201 == 'D') echo 'selected="selected"';?> value='D'>D級 </option>
		    <option <?php if($ma201 == 'H') echo 'selected="selected"';?> value='H'>H級 </option>
		    <option <?php if($ma201 == 'S') echo 'selected="selected"';?> value='S'>S級 </option>
		    <option <?php if($ma201 == 'SA') echo 'selected="selected"';?> value='SA'>SA級</option>
            <option <?php if($ma201 == 'SB') echo 'selected="selected"';?> value='SB'>SB級</option>   
            <option <?php if($ma201 == 'SC') echo 'selected="selected"';?> value='SC'>SC級</option>   
            <option <?php if($ma201 == 'SD') echo 'selected="selected"';?> value='SD'>SD級</option> 
            <option <?php if($ma201 == 'SH') echo 'selected="selected"';?> value='SH'>SH級</option> 
             <option <?php if($ma201 == 'SS') echo 'selected="selected"';?> value='SS'>SS級</option>  			
            <option <?php if($ma201 == 'Z') echo 'selected="selected"';?> value='Z'>Z其他 </option>		
		  </select></td>
	  </tr>
		
	  <tr>
	    <td  class="normal14" >客戶全名：</td>
        <td  class="normal14"  ><input tabIndex="4" id="ma003" onKeyPress="keyFunction()" name="ma003"  value="<?php echo $ma003; ?>"  size="30" type="text"   /></td>
		<td class="normal14">客戶類別</td>
        <td class="normal14"><input type="text" tabIndex="6" id="ma202" onKeyPress="keyFunction()"   onchange="startcopq04a(this)" name="copq04a"   value="<?php echo  $copq04a; ?>"     /><a href="javascript:;"><img id="Showcopq04a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		<span id="copq04adisp"> <?php  echo $copq04adisp; ?></span></td>
	  </tr>
		
	</table>
	
	<div class="abgne_tab"> <!-- div-7 -->
		<ul class="tabs">
		    <li><a href="#tab1" accesskey="a">基本資料a</a></li>
			<li><a href="#tab2" accesskey="b">地址資料b</a></li>
			<li><a href="#tab3" accesskey="c">交易資料(一)c</a></li>
			<li><a href="#tab4" accesskey="g">交易資料(二)g</a></li>
			<li><a href="#tab5" accesskey="h">國外資料h</a></li>
	    </ul>

    <div class="tab_container"> <!-- div-8 -->
	
	 <!--  基本資料 -->
	<div id="tab1" class="tab_content">
	
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a" width="10%" >負責人：</td>
		<td class="normal14a" width="23%"><input tabIndex="5" id="ma004" onKeyPress="keyFunction()"   name="ma004" value="<?php echo $ma004; ?>" type="text"  /></td>
		<td class="normal14a" width="11%">連絡人：</td>
        <td class="normal14a"  width="22%" ><input tabIndex="6" id="ma005" onKeyPress="keyFunction()"   name="ma005" value="<?php echo $ma005; ?>" type="text"  /></td>
		<td class="normal14a"  width="11%" > TEL(一)：</td>
        <td class="normal14a"  width="23%" ><input tabIndex="7" id="ma006" onKeyPress="keyFunction()"   name="ma006" value="<?php echo $ma006; ?>" type="text"  /></td>
	 </tr>	
		  
	  <tr>
	   <td class="normal14"  >TEL(二)：</td>
        <td class="normal14" ><input tabIndex="8" id="ma007" onKeyPress="keyFunction()"   name="ma007" value="<?php echo $ma007; ?>" type="text"  /></td>
	    <td class="normal14" >傳真號碼：</td>
        <td class="normal14"  ><input tabIndex="9" id="ma008" onKeyPress="keyFunction()"   name="ma008" value="<?php echo $ma008; ?>" type="text"  /></td>
		<td class="normal14" >E-MAIL：</td>
        <td class="normal14"  ><input tabIndex="10" id="ma009" onKeyPress="keyFunction()"   name="ma009" value="<?php echo $ma009; ?>" type="text"  /></td>
	  </tr>
		
	  <tr>
	    <td  class="normal14" >資本額(萬)：</td>
        <td  class="normal14"  ><input tabIndex="11" id="ma011" onKeyPress="keyFunction()"   name="ma011" value="<?php echo $ma011; ?>" type="text"  /></td>		   
	    <td  class="normal14" >年營業額(萬)：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="12"  id="ma012" onKeyPress="keyFunction()"   name="ma012" value="<?php echo $ma012; ?>"   /></td>
	    <td  class="normal14" >員工人數：</td>
        <td class="normal14"><input tabIndex="13" id="ma013" onKeyPress="keyFunction()"   name="ma013" value="<?php echo $ma013; ?>" type="text"  /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14a">總店號：</td>						
        <td  class="normal14"  ><input tabIndex="14" id="ma065" onKeyPress="keyFunction()" name="copq01a" onchange="startcopq01a(this)"  value="<?php echo $copq01a; ?>"  type="text"   /><img id="Showcopq01a" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
		 <span id="copq01adisp"> <?php    echo $copq01adisp; ?> </span></td>
		<td class="normal14" >總公司請款：</td>						
        <td  class="normal14"  ><input type="hidden" name="ma066" value="N" />
		<input type='checkbox' tabIndex="15" id="ma066" onKeyPress="keyFunction()" name="ma066" <?php if($ma066 == 'Y' ) echo 'checked'; ?>  <?php if($ma066 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td>
		<td  class="normal14">發票公司控管：</td>						
        <td  class="normal14"  ><input type="hidden" name="ma084" value="N" />
		<input type='checkbox' tabIndex="16" id="ma084" onKeyPress="keyFunction()" name="ma084" <?php if($ma084 == 'Y' ) echo 'checked'; ?>  <?php if($ma084 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td>
	  </tr>	
		
	  <tr>
	    <td  class="normal14" >分店數：</td>
        <td class="normal14"><input tabIndex="17" id="ma067" onKeyPress="keyFunction()"   name="ma067" value="<?php echo $ma067; ?>" type="text"  /></td>
	    <td class="normal14a">交易幣別：</td>						
        <td  class="normal14"  ><input tabIndex="18" id="ma014" onKeyPress="keyFunction()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text"   /><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span></td>			
		<td class="normal14a" >部門別：</td>						
        <td  class="normal14"  ><input tabIndex="19" id="ma014" onKeyPress="keyFunction()" name="cmsq05a" onchange="startcmsq05a(this)"  value="<?php echo $cmsq05a; ?>"  type="text"   /><img id="Showcmsq05a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
          <span id="cmsq05adisp"> <?php    echo $cmsq05adisp; ?> </span></td>
	 </tr>
	  
	  <tr>
	    <td  class="normal14a">業務人員：</td>						
        <td  class="normal14"  ><input tabIndex="20" id="ma016" onKeyPress="keyFunction()" name="cmsq09a3" onchange="startcmsq09a3(this)"   value="<?php echo  $cmsq09a3; ?>"     type="text"  /><img id="Showcmsq09a3" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="cmsq09a3disp"> <?php    echo $cmsq09a3disp; ?> </span></td>
	    <td class="normal14a" >收款業務員：</td>
        <td class="normal14"><input tabIndex="21" id="ma085" onKeyPress="keyFunction()" name="cmsq09a31" onchange="startcmsq09a31(this)"   value="<?php echo  $cmsq09a31; ?>"     type="text"  /><img id="Showcmsq09a31" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="cmsq09a31disp"> <?php    echo $cmsq09a31disp; ?> </span></td>       
	     <td class="normal14a">開業日期</td>
       <td class="normal14"><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ma020" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="ma020"  value="<?php echo $ma020; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ma020,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
	  <tr>
	    <td class="normal14a" >歇業日期：</td>
        <td class="normal14"><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ma068" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="ma068"  value="<?php echo $ma068; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ma068,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td> <td class="normal14"></td>
        <td class="normal14"></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	</table>
	</div>
	<!--  地址資料 -->
     <div id="tab2" class="tab_content">
	<?php
	  $date=date("Ymd");
	  
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="11%"> 郵遞區號(一)：</td>
        <td class="normal14a"  width="89%"><input tabIndex="24" id="ma079" onKeyPress="keyFunction()" name="ma079" value="<?php echo $ma079; ?>"  type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14" > 登記地址(一)：</td>
        <td class="normal14" ><input tabIndex="25" id="ma023" onKeyPress="keyFunction()" name="ma023" value="<?php echo $ma023; ?>" size="80" type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14" > 登記地址(二)：</td>
        <td class="normal14" ><input tabIndex="26" id="ma024" onKeyPress="keyFunction()" name="ma024" value="<?php echo $ma024; ?>" size="80" type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14" > 郵遞區號(二)：</td>
        <td class="normal14" ><input tabIndex="27" id="ma080" onKeyPress="keyFunction()" name="ma080" value="<?php echo $ma080; ?>"  type="text"  /></td>
	  </tr>	
	  <tr>
	    <td class="normal14" > 發票地址(一)：</td>
        <td class="normal14" ><input tabIndex="28" id="ma025" onKeyPress="keyFunction()" name="ma025" value="<?php echo $ma025; ?>" size="80" type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14" > 發票地址(二)：</td>
        <td class="normal14" ><input tabIndex="29" id="ma026" onKeyPress="keyFunction()" name="ma026" value="<?php echo $ma026; ?>" size="80" type="text"  /></td>
	  </tr>	
	  <tr>
	    <td class="normal14" > 郵遞區號(三)：</td>
        <td class="normal14" ><input tabIndex="30" id="ma081" onKeyPress="keyFunction()" name="ma081" value="<?php echo $ma081; ?>"  type="text"  /></td>
	  </tr>	
	  <tr>
	    <td class="normal14" > 送貨地址(一)：</td>
        <td class="normal14" ><input tabIndex="31" id="ma027" onKeyPress="keyFunction()" name="ma027" value="<?php echo $ma027; ?>" size="80" type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14" > 帳單地址(一)：</td>
        <td class="normal14" ><input tabIndex="32" id="ma064" onKeyPress="keyFunction()" name="ma064" value="<?php echo $ma064; ?>" size="80" type="text"  /></td>
	  </tr>
	  <tr>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	</table>	 
    </div>
	
	<!--  交易資料1 -->
	<div id="tab3" class="tab_content">
	<?php
	  $date=date("Ymd");
	 
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a" width="14%" >信用額度管制：</td>
		<td class="normal14a" width="19%">
		  <select id="ma032" onKeyPress="keyFunction()" name="ma032" " tabIndex="33">
		    <option <?php if($ma032 == 'Y') echo 'selected="selected"';?> value='Y'>Y.依公司參數管制</option>                                                                        
		    <option <?php if($ma032 == 'N') echo 'selected="selected"';?> value='N'>N.信用額度不管制</option>
            <option <?php if($ma032 == 'y') echo 'selected="selected"';?> value='y'>y.依客戶資料管制 </option>	
		  </select></td>
		<td class="normal14a"  width="13%">稅額計算：</td>
        <td class="normal14a"  width="20%" >
		  <input tabIndex="34" type="radio" name="ma087" <?php if (isset($ma087) && $ma087=="1") echo "checked";?> value="1" />整張計算&nbsp;&nbsp; 
          <input type="radio" tabIndex="34" name="ma087" <?php if (isset($ma087) && $ma087=="2") echo "checked";?> value="2" />單筆計算</td>
		</td>
		<td class="normal14a"  width="14%" >信用額度總控管：</td>
        <td class="normal14a"  width="20%" ><input type="hidden" name="ma082" value="N" />
		<input tabIndex="35" id="ma082" onKeyPress="keyFunction()"  name="ma082" <?php if($ma082== 'Y' ) echo 'checked';  ?>  <?php if($ma082 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  /></td>
	    <?php if($ma082 == '0')  $ma082="N";?><?php if($ma082 == '1')  $ma082="Y";?>
	  </tr>	
		  
	  <tr>
	    <td class="normal14"  >隨貨附發票：</td>
        <td class="normal14" ><input type="hidden" name="ma086" value="N" />
		<input tabIndex="36" id="ma086" onKeyPress="keyFunction()"  name="ma086" <?php if($ma086 == 'Y' ) echo 'checked';  ?>  <?php if($ma086 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  /></td>
		<?php if($ma086 == '0')  $ma086="N";?> <?php if($ma086 == '1')  $ma086="Y";?></td>
	    <td class="normal14" >銷售評等：</td>
        <td class="normal14" ><input tabIndex="37" id="ma028" onKeyPress="keyFunction()"   name="ma028" value="<?php echo $ma028; ?>" type="text" size="1" /></td>
		<td class="normal14" >信用評等：</td>
        <td class="normal14" ><input tabIndex="38" id="ma029" onKeyPress="keyFunction()"   name="ma029" value="<?php echo $ma029; ?>" type="text" size="1" /></td>
	  </tr>
	  
	   <tr>
	   <td class="normal14"  >信用額度：</td>
         <td class="normal14" ><input tabIndex="39"  id="ma033" onKeyPress="keyFunction()"   name="ma033" value="<?php echo $ma033; ?>" type="text"  /></td>
	    <td class="normal14" >可超出率：</td>
        <td class="normal14" ><input tabIndex="40"  id="ma034" onKeyPress="keyFunction()"   name="ma034" value="<?php echo $ma034; ?>" type="text"  /></td>
		<td class="normal14" >價格條件：</td>
        <td class="normal14" ><input tabIndex="41" id="ma030" onKeyPress="keyFunction()"   name="ma030" value="<?php echo $ma030; ?>" type="text"  /></td>
	  </tr>
	  
	  <tr>
	    <td  class="normal14" >訂單信用方式：</td>
        <td  class="normal14"  > <select id="ma088" onKeyPress="keyFunction()" name="ma088" " tabIndex="42">
            <option <?php if($ma088 == '1') echo 'selected="selected"';?> value='1'>1.不檢查</option>                                                                        
		    <option <?php if($ma088 == '2') echo 'selected="selected"';?> value='2'>2.警告</option>
            <option <?php if($ma088 == '3') echo 'selected="selected"';?> value='3'>3.拒絕</option>			
		  </select></td>       
	   <td  class="normal14" >銷貨單信用方式：</td>		
       <td  class="normal14"  ><select id="ma089" onKeyPress="keyFunction()" name="ma089" " tabIndex="43">
            <option <?php if($ma089 == '1') echo 'selected="selected"';?> value='1'>1.不檢查</option>                                                                        
		    <option <?php if($ma089 == '2') echo 'selected="selected"';?> value='2'>2.警告</option>
            <option <?php if($ma089 == '3') echo 'selected="selected"';?> value='3'>3.拒絕</option>			
		  </select></td>       	
	   <td  class="normal14" >付款條件：</td>
       <td class="normal14"><input tabIndex="44" id="ma031" onKeyPress="keyFunction()" name="cmsq21a1" onchange="startcmsq21a1(this)"   value="<?php echo  $cmsq21a1; ?>"     type="text"  /><img id="Showcmsq21a1" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="cmsq21a1disp"> <?php    echo $cmsq21a1disp; ?> </span></td>
	  </tr>
	  <tr>
	    <td  class="normal14" >未兌現票據比率：</td>
        <td class="normal14"><input tabIndex="45" id="ma091" onKeyPress="keyFunction()"   name="ma091" value="<?php echo $ma091; ?>" type="text"  /></td>
	    <td class="normal14" >應收帳款比率：</td>						
        <td  class="normal14"  ><input tabIndex="46" id="ma092" onKeyPress="keyFunction()"   name="ma092" value="<?php echo $ma092; ?>" type="text"  /></td>
		<td class="normal14" >未結帳銷售比率：</td>						
        <td  class="normal14"  ><input tabIndex="47" id="ma093" onKeyPress="keyFunction()" name="ma093"   value="<?php echo $ma093; ?>"   type="text" /></td>
	  </tr>
	  
	  <tr>
	    <td  class="normal14">未出貨訂單比率：</td>						
        <td  class="normal14"  ><input tabIndex="48" id="ma094" onKeyPress="keyFunction()" name="ma094"   value="<?php echo $ma094; ?>"   type="text" /></td>
	    <td class="normal14" >單據發送方式：</td>
        <td class="normal14"><select id="ma039" onKeyPress="keyFunction()" name="ma039" " tabIndex="49">
		    <option <?php if($ma039 == '2') echo 'selected="selected"';?> value='2'>FAX</option>
            <option <?php if($ma039 == '1') echo 'selected="selected"';?> value='1'>郵寄</option>
            <option <?php if($ma039 == '3') echo 'selected="selected"';?> value='3'>EDI</option>
			<option <?php if($ma039 == '4') echo 'selected="selected"';?> value='4'>E-MAIL</option>
		  </select></td>       
		<td class="normal14" >收款方式</td>
        <td class="normal14"><select id="ma024" onKeyPress="keyFunction()" name="ma041" " tabIndex="50">
            <option <?php if($ma041 == '1') echo 'selected="selected"';?> value='1'>現金</option>                                                                        
		    <option <?php if($ma041 == '2') echo 'selected="selected"';?> value='2'>電匯</option>
            <option <?php if($ma041 == '3') echo 'selected="selected"';?> value='3'>支票</option>
		    <option <?php if($ma041 == '4') echo 'selected="selected"';?> value='4'>其他</option>
		   </select></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14" >票據寄領：</td>
        <td class="normal14"><select id="ma042" onKeyPress="keyFunction()" name="ma042" " tabIndex="51">
            <option <?php if($ma042 == '1') echo 'selected="selected"';?> value='1'>郵寄</option>                                                                        
		    <option <?php if($ma042 == '2') echo 'selected="selected"';?> value='2'>自領</option>
            <option <?php if($ma042 == '3') echo 'selected="selected"';?> value='3'>其它</option>			
		  </select></td>       
		<td class="normal14" >發票聯數：</td>
        <td class="normal14"><select id="ma037" onKeyPress="keyFunction()" name="ma037" " tabIndex="52">
            <option <?php if($ma037 == '2') echo 'selected="selected"';?> value='2'>三聯式發票</option>
            <option <?php if($ma037 == '1') echo 'selected="selected"';?> value='1'>二聯式發票</option> 
            <option <?php if($ma037 == '3') echo 'selected="selected"';?> value='3'>二聯式收銀機發票</option>
            <option <?php if($ma037 == '4') echo 'selected="selected"';?> value='4'>三聯式收銀機發票</option>
            <option <?php if($ma037 == '5') echo 'selected="selected"';?> value='5'>電子計算機發票</option>
            <option <?php if($ma037 == '6') echo 'selected="selected"';?> value='6'>免用統一發票</option>
		</select></td>
		<td class="normal14" >課稅別：</td>
        <td class="normal14"><select id="ma038" onKeyPress="keyFunction()" name="ma038" " tabIndex="53">
		    <option <?php if($ma038 == '2') echo 'selected="selected"';?> value='2'>應稅外加</option>
            <option <?php if($ma038 == '1') echo 'selected="selected"';?> value='1'>應稅內含</option> 
            <option <?php if($ma038 == '3') echo 'selected="selected"';?> value='3'>零稅率</option>
		    <option <?php if($ma038 == '4') echo 'selected="selected"';?> value='4'>免稅</option>
            <option <?php if($ma038 == '9') echo 'selected="selected"';?> value='9'>不計稅</option>				
		  </select></td>
	  </tr>
		
	</table>
	</div>	
    <!--  交易資料2 -->
	<div id="tab4" class="tab_content">
	<?php
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="10%">通路別：</td>
        <td class="normal14a"  width="23%" ><input type="text" tabIndex="54" id="ma017" onKeyPress="keyFunction()"   onchange="startcmsq15a1(this)" name="cmsq15a1"   value="<?php echo  $cmsq15a1; ?>"     /><a href="javascript:;"><img id="Showcmsq15a1" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		<span id="cmsq15a1disp"> <?php  echo $cmsq15a1disp; ?></span></td>
	    <td class="normal14a" width="10%" >型態別：</td>
		<td class="normal14a"  width="23%" ><input type="text" tabIndex="55" id="ma076" onKeyPress="keyFunction()"   onchange="startcmsq15a2(this)" name="cmsq15a2"   value="<?php echo  $cmsq15a2; ?>"     /><a href="javascript:;"><img id="Showcmsq15a2" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		<span id="cmsq15a2disp"> <?php  echo $cmsq15a2disp; ?></span></td>
		<td class="normal14a"  width="10%">地區別：</td>
        <td class="normal14a"  width="23%" ><input type="text" tabIndex="56" id="ma018" onKeyPress="keyFunction()"   onchange="startcmsq15a3(this)" name="cmsq15a3"   value="<?php echo  $cmsq15a3; ?>"     /><a href="javascript:;"><img id="Showcmsq15a3" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
  		<span id="cmsq15a3disp"> <?php  echo $cmsq15a3disp; ?></span></td>
	  </tr>	
	   <tr>
	    <td class="normal14a"  width="10%">國家別：</td>
        <td class="normal14a"  width="23%" ><input type="text" tabIndex="57" id="ma019" onKeyPress="keyFunction()"   onchange="startcmsq15a4(this)" name="cmsq15a4"   value="<?php echo  $cmsq15a4; ?>"     /><a href="javascript:;"><img id="Showcmsq15a4" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		<span id="cmsq15a4disp"> <?php  echo $cmsq15a4disp; ?></span></td>
	    <td class="normal14a" width="10%" >路線別：</td>
		<td class="normal14a"  width="23%" ><input type="text" tabIndex="58" id="ma077" onKeyPress="keyFunction()"   onchange="startcmsq15a5(this)" name="cmsq15a5"   value="<?php echo  $cmsq15a5; ?>"     /><a href="javascript:;"><img id="Showcmsq15a5" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		<span id="cmsq15a5disp"> <?php  echo $cmsq15a5disp; ?></span></td>
		<td class="normal14a"  width="10%">其他別：</td>
        <td class="normal14a"  width="23%" ><input type="text" tabIndex="59" id="ma078" onKeyPress="keyFunction()"   onchange="startcmsq15a6(this)" name="cmsq15a6"   value="<?php echo  $cmsq15a6; ?>"     /><a href="javascript:;"><img id="Showcmsq15a6" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
  		<span id="cmsq15a6disp"> <?php  echo $cmsq15a6disp; ?></span></td>
	  </tr>	
	  
	  <tr>
	   <td class="normal14a" >初次交易：</td>
        <td class="normal14" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ma021" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="ma021"  value="<?php echo $ma021; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ma021,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	    <td class="normal14a" >最近交易：</td>
        <td class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ma022" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="ma022"  value="<?php echo $ma022; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ma022,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		<td class="normal14" >取價順序：</td>
        <td class="normal14"  ><input tabIndex="62" id="ma075" onKeyPress="keyFunction()"   name="ma075" value="<?php echo $ma075; ?>" type="text"  /></td>	
	  </tr>
	  
	  <tr>
	   <td class="normal14a"  >付款銀行1：</td>
        <td class="normal14" ><input type="text" tabIndex="63" id="ma046" onKeyPress="keyFunction()"   onchange="startcmsq16a(this)" name="cmsq16a"   value="<?php echo  $cmsq16a; ?>"     /><a href="javascript:;"><img id="Showcmsq16a" src="<?php echo base_url()?>assets/image/png/bank.png" alt="" align="top"/></a>
		<span id="cmsq16adisp"> <?php  echo $cmsq16adisp; ?></span></td>	
	    <td class="normal14" >銀行帳號1：</td>
        <td class="normal14"  ><input tabIndex="64" id="ma071" onKeyPress="keyFunction()"   name="ma071" value="<?php echo $ma071; ?>" type="text"  /></td>	
		<td class="normal14a" >付款銀行2：</td>
        <td class="normal14"  ><input type="text" tabIndex="65" id="ma069" onKeyPress="keyFunction()"   onchange="startcmsq16a1(this)" name="cmsq16a1"   value="<?php echo  $cmsq16a1; ?>"     /><a href="javascript:;"><img id="Showcmsq16a1" src="<?php echo base_url()?>assets/image/png/bank.png" alt="" align="top"/></a>
		<span id="cmsq16a1disp"> <?php  echo $cmsq16a1disp; ?></span></td>	
	  </tr>	
	  
	  <tr>
	   <td class="normal14"  >銀行帳號2：</td>
        <td class="normal14" ><input tabIndex="66" id="ma072" onKeyPress="keyFunction()"   name="ma072" value="<?php echo $ma072; ?>" type="text"  /></td>	
	    <td class="normal14a" >付款銀行3：</td>
        <td class="normal14"  ><input type="text" tabIndex="67" id="ma070" onKeyPress="keyFunction()"   onchange="startcmsq16a2(this)" name="cmsq16a2"   value="<?php echo  $cmsq16a2; ?>"     /><a href="javascript:;"><img id="Showcmsq16a2" src="<?php echo base_url()?>assets/image/png/bank.png" alt="" align="top"/></a>
		<span id="cmsq16a2disp"> <?php  echo $cmsq16a2disp; ?></span></td>	
		<td class="normal14" >銀行帳號3：</td>
        <td class="normal14"  ><input tabIndex="68" id="ma073" onKeyPress="keyFunction()"   name="ma073" value="<?php echo $ma073; ?>" type="text"  /></td>	
	  </tr>	
	  
	  <tr>
	    <td  class="normal14a" >帳款科目：</td>
       <td  class="normal14"><input tabIndex="33" id="ma047" onKeyPress="keyFunction()" name="actq03a1" onchange="startactq03a1(this)"   value="<?php echo  $actq03a1; ?>"     type="text"  /><img id="Showactq03a1" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="actq03a1disp"> <?php   echo $actq03a1disp; ?> </span></td>
	   <td  class="normal14a">票據科目：</td>		
       <td  class="normal14"  ><input tabIndex="70" id="ma074" onKeyPress="keyFunction()" name="actq03a2" onchange="startactq03a2(this)"   value="<?php echo  $actq03a2; ?>"     type="text"  /><img id="Showactq03a2" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="actq03a2disp"> <?php   echo $actq03a2disp; ?> </span></td>
	   <td  class="normal14" >結帳日每月日：</td>
       <td class="normal14" ><input tabIndex="71" id="ma043" onKeyPress="keyFunction()"   name="ma073" value="<?php echo $ma073; ?>" type="text"  /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14" >備註：</td>
        <td class="normal14"><input tabIndex="72" id="ma049" onKeyPress="keyFunction()" name="ma049"   value="<?php echo $ma049; ?>"   type="text" /></td>       
		<td class="normal14"></td>
        <td class="normal14"></td>
		<td class="normal14"></td>
        <td class="normal14"></td>
	  </tr>
		
	</table>
	</div>	
	<!--  國外資料 -->
     <div id="tab5" class="tab_content">
	<?php
	  
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="10%"> 運輸方式：</td>
        <td class="normal14a"  width="23%"><select id="ma048" onKeyPress="keyFunction()" name="ma048" " tabIndex="73">
            <option <?php if($ma048 == '1') echo 'selected="selected"';?> value='1'>1.空運</option>                                                                        
		    <option <?php if($ma048 == '2') echo 'selected="selected"';?> value='2'>2.海運</option>
            <option <?php if($ma048 == '3') echo 'selected="selected"';?> value='3'>3.海空聯運</option>	
            <option <?php if($ma048 == '4') echo 'selected="selected"';?> value='4'>4.郵寄</option>                                                                        
		    <option <?php if($ma048 == '5') echo 'selected="selected"';?> value='5'>5.陸運</option>
            <option <?php if($ma048 == '6') echo 'selected="selected"';?> value='6'>6.自取</option>
            <option <?php if($ma048 == '7') echo 'selected="selected"';?> value='7'>7.自送</option>                                                                        
		    <option <?php if($ma048 == '8') echo 'selected="selected"';?> value='8'>8.快遞</option>
		   </select></td>
        <td class="normal14a"  width="10%"> 品牌：</td>
        <td class="normal14a"  width="23%"><input tabIndex="74" id="ma050" onKeyPress="keyFunction()" name="ma050" value="<?php echo $ma050; ?>"  type="text"  /></td>		  
	    <td class="normal14a"  width="10%"> 目的地：</td>
        <td class="normal14a"  width="23%"><input tabIndex="75" id="ma051" onKeyPress="keyFunction()" name="ma051" value="<?php echo $ma051; ?>"  type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14"  >海運港口：</td>
        <td class="normal14"   ><input tabIndex="76" id="ma052" onKeyPress="keyFunction()" name="ma052" value="<?php echo $ma052; ?>"  type="text"  /></td>
	    <td class="normal14"  >空運機場：</td>
		<td class="normal14"   ><input tabIndex="77" id="ma053" onKeyPress="keyFunction()" name="ma053" value="<?php echo $ma053; ?>"  type="text"  /></td>
		<td class="normal14"  >海運公司：</td>
        <td class="normal14"   ><input type="text" tabIndex="78" id="ma054" onKeyPress="keyFunction()"   onchange="startpurq01a1(this)" name="purq01a1"   value="<?php echo  $purq01a1; ?>"     /><a href="javascript:;"><img id="Showpurq01a1" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
  		<span id="purq01a1disp"> <?php  echo $purq01a1disp; ?></span></td>
	  </tr>	
	  
	   <tr>
	    <td  class="normal14"  >空運公司：</td>
        <td class="normal14"   ><input type="text" tabIndex="79" id="ma055" onKeyPress="keyFunction()"   onchange="startpurq01a2(this)" name="purq01a2"   value="<?php echo  $purq01a2; ?>"     /><a href="javascript:;"><img id="Showpurq01a2" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
  		<span id="purq01a2disp"> <?php  echo $purq01a2disp; ?></span></td>
	    
		<td  class="normal14"  >代理商：</td>
	<!--	<td class="normal14"   ><input type="text" tabIndex="80" id="ma056" onKeyPress="keyFunction()"   onchange="startcopq01a(this)" name="copq01a"   value="<?php echo  $copq01a; ?>"     /><a href="javascript:;"><img id="Showcopq01a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
  		<span id="copq01adisp"> <?php  echo $copq01adisp; ?></span></td> -->
		<td class="normal14"   ><input type="text" tabIndex="81" id="ma056" onKeyPress="keyFunction()"   onchange="startcopq01a1(this)" name="copq01a1"   value="<?php echo  $copq01a1; ?>"     /><a href="javascript:;"><img id="Showcopq01a1" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
  		<span id="copq01a1disp"> <?php  echo $copq01a1disp; ?></span></td>
		
		<td  class="normal14"  >報關行：</td>
        <td class="normal14"   ><input type="text" tabIndex="81" id="ma057" onKeyPress="keyFunction()"   onchange="startpurq01a3(this)" name="purq01a3"   value="<?php echo  $purq01a3; ?>"     /><a href="javascript:;"><img id="Showpurq01a3" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
  		<span id="purq01a3disp"> <?php  echo $purq01a3disp; ?></span></td>
	  </tr>	
	  
	  <tr>
	    <td  class="normal14"  >驗貨公司：</td>
        <td class="normal14"   ><input type="text" tabIndex="78" id="ma058" onKeyPress="keyFunction()"   onchange="startpurq01a4(this)" name="purq01a4"   value="<?php echo  $purq01a4; ?>"     /><a href="javascript:;"><img id="Showpurq01a4" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
  		<span id="purq01a4disp"> <?php  echo $purq01a4disp; ?></span></td>
	    <td class="normal14"  >佣金比率：</td>
        <td class="normal14"   ><input tabIndex="76" id="ma059" onKeyPress="keyFunction()" name="ma059" value="<?php echo $ma059; ?>"  type="text"  /></td>
	    <td class="normal14" >保險比率：</td>
		<td class="normal14"  ><input tabIndex="77" id="ma060" onKeyPress="keyFunction()" name="ma060" value="<?php echo $ma060; ?>"  type="text"  /></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14"  >保險費率：</td>
        <td class="normal14"   ><input tabIndex="76" id="ma061" onKeyPress="keyFunction()" name="ma061" value="<?php echo $ma061; ?>"  type="text"  /></td>
	    <td class="normal14"  >郵遞區號：</td>
		<td class="normal14"  ><input tabIndex="77" id="ma040" onKeyPress="keyFunction()" name="ma040" value="<?php echo $ma040; ?>"  type="text"  /></td>
	    <td class="normal14" ></td>
		<td class="normal14"  ></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14" > 文件地址1：</td>
        <td colspan="5" class="normal14" ><input tabIndex="78" id="ma062" onKeyPress="keyFunction()" name="ma062" value="<?php echo $ma062; ?>" size="80" type="text"  /></td>
	     <td class="normal14"  ></td>
		<td class="normal14"  ></td>
		<td class="normal14"  ></td>
		<td class="normal14"  ></td>
	  </tr>
	  <tr>
	    <td class="normal14"> 文件地址2：</td>
        <td colspan="5" class="normal14" ><input tabIndex="79" id="ma063" onKeyPress="keyFunction()" name="ma063" value="<?php echo $ma063; ?>" size="80" type="text"  /></td>
	    <td class="normal14"  ></td>
		<td class="normal14"  ></td>
		<td class="normal14"  ></td>
		<td class="normal14"  ></td>
	  </tr>	
	  
	  <tr>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	</table>	 
    </div>
		
		<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
        </form>
		
    </div>  <!-- div-5 -->
  </div> <!-- div-4 -->
  
      <!-- <div class="buttons">
	    <button tabIndex="8" type='submit' accesskey="s" name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cop/copi01/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	   </div>-->
</div> <!-- div-3 -->
<?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[  欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料.  ] ' ?> </div>  <?php } ?>
   
    </div> <!-- div-2 -->
  </div> <!-- div-1 -->
</div> <!-- div-0 -->
 <?php include_once("./application/views/fun/copi01_funjs_v.php"); ?>