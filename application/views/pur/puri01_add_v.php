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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 廠商基本資料建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#ma001').focus();"  type='submit'  accesskey="s"  name="submit"  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	    <a  accesskey="x"  onKeyPress="keyFunction()" id="cancel" name="cancel" href="<?php echo site_url('pur/puri01/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pur/puri01/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Ymd");
	  if(!isset($ma001)) { $ma001=$this->input->post('ma001'); }
	  if(!isset($ma004)) { $ma004=$this->input->post('ma004'); }
      $ma002=$this->input->post('ma002');
      $ma003=$this->input->post('ma003');	  
      $ma005=$this->input->post('ma005'); 
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="8%"><span class="required">廠商代號：</span> </td>
        <td class="normal14a"  width="42%"><input tabIndex="1" id="ma001"      onKeyPress="keyFunction()" onchange="startkey(this)"  name="ma001" value="<?php echo strtoupper($ma001); ?>"  type="text" required />
		  <span id="keydisp" ></span></td>
	    <td class="normal14y" width="8%" >統一編號： </td>
        <td class="normal14a"  width="42%" ><input tabIndex="2" id="ma005" onKeyPress="keyFunction()" name="ma005"  onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase()" value="<?php echo  strtoupper($ma005); ?>"    type="text"  /></td>
	 </tr>	
		  
	  <tr>
	    <td class="normal14z" >廠商簡稱： </td>
        <td class="normal14" ><input tabIndex="3" id="ma002" onKeyPress="keyFunction()" onchange="checkspace2(this)" name="ma002" value="<?php echo $ma002; ?>" size="30" type="text" required /><span id="ma002disp" ></span></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	  <tr>
	    <td  class="normal14z" >廠商全名：</td>
        <td  class="normal14"  ><input tabIndex="4" id="ma003" onKeyPress="keyFunction()" name="ma003"  value="<?php echo $ma003; ?>"  size="30" type="text"   /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
			<li><a href="#tab1" accesskey="a" >基本資料a</a></li>
			<li><a href="#tab2" accesskey="b" >交易資料b</a></li>
			<li><a href="#tab3" accesskey="c" >地址c</a></li>
		</ul>
	

    <div class="tab_container">
	
	<!--  基本資料 -->
	<div id="tab1" class="tab_content">
	<?php
	  $date=date("Ymd");
	  // $ma005disp='';$ma006disp='';
	  $ma016=$this->input->post('ma016');
	  $ma008=$this->input->post('ma008');
	  $ma009=$this->input->post('ma009');
	  $ma010=$this->input->post('ma010');
	  $ma011=$this->input->post('ma011');
	  $ma012=$this->input->post('ma012');	
	  $ma013=$this->input->post('ma013');	
	  $ma014=$this->input->post('ma014');
      $ma015=$this->input->post('ma015');
      $ma047=$this->input->post('cmsq09a4');		  
      $ma040=$this->input->post('ma040');
	  $cmsq15a3=$this->input->post('ma007');	
	  $cmsq15a4=$this->input->post('ma006');	
	  $cmsq15a9=$this->input->post('ma004');
      $ma017=$this->input->post('ma017');
      $ma018=$this->input->post('ma018');		  
      $ma019=$this->input->post('ma019');
	//  $cmsq06a=$this->input->post('ma021');	交易幣別
       if(!isset($cmsq06a)) { $cmsq06a=$this->session->userdata('sysma003'); } 	  
      $ma053=$this->input->post('ma053');

	  if (($ma053!="1") && ($ma053!="2") ) { $ma053="1" ;}
	  //開視窗及不更新網頁直接輸入出現中文
	  $cmsq15a3disp=$this->input->post('ma007');   //地區別
	  $cmsq15a4disp=$this->input->post('ma006');   //國家別
	  $cmsq15a9disp=$this->input->post('ma004');   //廠商分類
	  $cmsq06adisp=$this->input->post('ma021');    //交易幣別
	  $cmsq09a4disp=$this->input->post('ma047');   //採購人員
	 // $ma008[]=array();
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="10%" >核准狀況：</td>
		<td class="normal14a" width="23%">
		  <select id="ma016" onKeyPress="keyFunction()" name="ma016" " tabIndex="5">
            <option <?php if($ma016 == '1') echo 'selected="selected"';?> value='1'>已核准</option>                                                                        
		    <option <?php if($ma016 == '2') echo 'selected="selected"';?> value='2'>尚待核准</option>
            <option <?php if($ma016 == '3') echo 'selected="selected"';?> value='3'>不准交易</option>
		  </select></td>
		<td class="normal14y"  width="10%">地區別：</td>
        <td class="normal14a"  width="23%" ><input type="text" tabIndex="6" id="ma007" onKeyPress="keyFunction()"   onchange="startcmsq15a3(this)" name="cmsq15a3"   value="<?php echo  $cmsq15a3; ?>"     /><a href="javascript:;"><img id="Showcmsq15a3" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		<span id="cmsq15a3disp"> <?php  echo $cmsq15a3disp; ?></span></td>
		<td class="normal14a"  width="10%" ></td>
        <td class="normal14a"  width="24%" ></td>
	 </tr>	
	  <tr>
	     <td class="normal14z"  > TEL(一)：</td>
         <td class="normal14a"   ><input tabIndex="7" id="ma008" onKeyPress="keyFunction()"   name="ma008" value="<?php echo $ma008; ?>" type="text"  />
	      </td>
		 <!-- <INPUT type="button" value="新增電話" onClick="addtextbox('ma008[]','ma008')"/><br> -->
		  
	  </tr> 
	  <tr>
	   <td class="normal14z"  >國家別：</td>
        <td class="normal14" ><input type="text" tabIndex="8" id="ma006" onKeyPress="keyFunction()"   onchange="startcmsq15a4(this)" name="cmsq15a4"   value="<?php echo  $cmsq15a4; ?>"    size="6"  /><a href="javascript:;"><img id="Showcmsq15a4" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		<span id="cmsq15a4disp"> <?php    echo $cmsq15a4disp; ?> </span></td>
	    <td class="normal14z" >TEL(二)：</td>
        <td class="normal14"  ><input tabIndex="9" id="ma009" onKeyPress="keyFunction()"   name="ma009" value="<?php echo $ma009; ?>" type="text"  /></td>
		<td class="normal14z" >廠商分類：</td>
        <td class="normal14"  ><input tabIndex="10" id="ma004" onKeyPress="keyFunction()" name="cmsq15a9" onchange="startcmsq15a9(this)"   value="<?php echo  $cmsq15a9; ?>"     type="text"  /><img id="Showcmsq15a9" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="cmsq15a9disp"> <?php    echo $cmsq15a9disp; ?> </span></td>
	  </tr>
		
	  <tr>
	    <td  class="normal14z" >傳真號碼：</td>
        <td  class="normal14"  ><input tabIndex="11" id="ma010" onKeyPress="keyFunction()"   name="ma010" value="<?php echo $ma010; ?>" type="text"  /></td>		   
	    <td  class="normal14z">開業日期：</td>		
        <td  class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ma017" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="ma017"  value="<?php echo $ma017; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ma017,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	    <td  class="normal14z" >E-MAIL：</td>
        <td class="normal14"><input tabIndex="13" id="ma011" onKeyPress="keyFunction()"   name="ma011" value="<?php echo $ma011; ?>" type="text"  /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z">資本額：</td>						
        <td  class="normal14"  ><input tabIndex="14" id="ma018" onKeyPress="keyFunction()" name="ma018"   value="<?php echo $ma018; ?>"  type="text"   /></td>
		<td class="normal14z" >負責人：</td>						
        <td  class="normal14"  ><input tabIndex="15" id="ma012" onKeyPress="keyFunction()" name="ma012"   value="<?php echo $ma012; ?>"   type="text" /></td>
		<td  class="normal14z">員工人數：</td>						
        <td  class="normal14"  ><input tabIndex="16" id="ma019" onKeyPress="keyFunction()" name="ma019"   value="<?php echo $ma019; ?>"    type="text"  /></td>
	  </tr>	
		
	  <tr>
	    <td  class="normal14z" >聯絡人(一)：</td>
        <td class="normal14"><input tabIndex="17" id="ma013" onKeyPress="keyFunction()"   name="ma013" value="<?php echo $ma013; ?>" type="text"  /></td>
	    <td class="normal14z">交易幣別：</td>						
        <td  class="normal14"  ><input tabIndex="18" id="ma021" onKeyPress="keyFunction()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text"  required /><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span></td>			
		<td class="normal14z" >聯絡人(二)：</td>						
        <td  class="normal14"  ><input tabIndex="19" id="ma012" onKeyPress="keyFunction()" name="ma012"   value="<?php echo $ma012; ?>"   type="text" /></td>
	 </tr>
	  
	  <tr>
	    <td  class="normal14z">稅額方式：</td>						
        <td  class="normal14"  ><input tabIndex="20" type="radio" name="ma053" <?php if (isset($ma053) && $ma053=="1") echo "checked";?> value="1" />整張計算  &nbsp;&nbsp;&nbsp; 
          <input type="radio" tabIndex="21" name="ma053" <?php if (isset($ma053) && $ma053=="2") echo "checked";?> value="2" />單身單筆計算</td>
	    <td class="normal14z" >聯絡人(三)：</td>
        <td class="normal14"><input tabIndex="22" id="ma015" onKeyPress="keyFunction()" name="ma015"   value="<?php echo $ma015; ?>"   type="text" /></td>       
	    <td class="normal14z">採購人員</td>
        <td class="normal14"><input tabIndex="23" id="ma047" onKeyPress="keyFunction()" name="cmsq09a4" onchange="startcmsq09a4(this)"   value="<?php echo  $ma047; ?>"     type="text"  /><img id="Showcmsq09a4" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="cmsq09a4disp"> <?php    echo $cmsq09a4disp; ?> </span></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >備註：</td>
        <td class="normal14"><input tabIndex="24" id="ma040" onKeyPress="keyFunction()" name="ma040"   value="<?php echo $ma040; ?>"   type="text" /></td>       
		<td class="normal14"></td>
        <td class="normal14"></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	</table>
	</div>
	
	<!--  交易資料2 -->
	<div id="tab2" class="tab_content">
	<?php
	  $date=date("Ymd");
	  $ma020=$this->input->post('ma020');
	  $ma029=$this->input->post('ma029');
	  $ma045=$this->input->post('ma045');
	  $ma056=$this->input->post('ma056');
	  $ma030=$this->input->post('ma030');
	  $ma022=$this->input->post('ma022');
	  $ma044=$this->input->post('ma044');	
	  $ma023=$this->input->post('ma023');	
	  $actq03a1=$this->input->post('ma042');
      $ma024=$this->input->post('ma024');	
      $cmsq21a1=$this->input->post('ma025');
      $actq03a2=$this->input->post('ma041');
      $ma026=$this->input->post('ma026');
      $actq03a3=$this->input->post('ma043');
      $ma027=$this->input->post('ma027');
      $ma028=$this->input->post('ma028');
      $ma034=$this->input->post('ma034');	
      $ma035=$this->input->post('ma035');	  
      $ma031=$this->input->post('ma031');	  
      $ma032=$this->input->post('ma032');	  
      $ma033=$this->input->post('ma033');
      
	  $cmsq21a1disp=$this->input->post('ma025');   //付款條件
	  $ma026disp=$this->input->post('ma026');
	  $actq03a1disp=$this->input->post('ma042');  //加工費用科目
	  $actq03a2disp=$this->input->post('ma041');  //應付帳款科目
	  $actq03a3disp=$this->input->post('ma043');  //應付票據科目
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="10%" >採購單方式：</td>
		<td class="normal14a" width="23%">
		  <select id="ma020" onKeyPress="keyFunction()" name="ma020" " tabIndex="25">
		    <option <?php if($ma020 == '2') echo 'selected="selected"';?> value='2'>FAX</option>
            <option <?php if($ma020 == '1') echo 'selected="selected"';?> value='1'>郵寄</option>
            <option <?php if($ma020 == '3') echo 'selected="selected"';?> value='3'>EDI</option>
			<option <?php if($ma020 == '4') echo 'selected="selected"';?> value='4'>E-MAIL</option>
		  </select></td>
		<td class="normal14y"  width="10%">票據寄領：</td>
        <td class="normal14a"  width="23%" >
		  <select id="ma029" onKeyPress="keyFunction()" name="ma029" " tabIndex="26">
            <option <?php if($ma029 == '1') echo 'selected="selected"';?> value='1'>郵寄</option>                                                                        
		    <option <?php if($ma029 == '2') echo 'selected="selected"';?> value='2'>自領</option>
            <option <?php if($ma029 == '3') echo 'selected="selected"';?> value='3'>其它</option>			
		  </select>
		</td>
		<td class="normal14z"  width="12%" >可分批交貨：</td>
        <td class="normal14a"  width="22%" ><input type="hidden" name="ma045" value="N" />
		<input tabIndex="27" id="ma045" onKeyPress="keyFunction()"  name="ma045" <?php if($ma045 == 'Y' ) echo 'checked';  ?>  <?php if($ma045 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  /></td>
	    <?php if($ma045 == '0')  $ma045="N";?><?php if($ma045 == '1')  $ma045="Y";?>
	  </tr>	
		  
	  <tr>
	   <td class="normal14z"  >隨貨附發票：</td>
        <td class="normal14" ><input type="hidden" name="ma056" value="N" />
		<input tabIndex="28" id="ma056" onKeyPress="keyFunction()"  name="ma056" <?php if($ma056 == 'Y' ) echo 'checked';  ?>  <?php if($ma056 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  /></td>
		<?php if($ma056 == '0')  $ma056="N";?> <?php if($ma056 == '1')  $ma056="Y";?>
	    <td class="normal14z" >發票聯數：</td>
        <td class="normal14"  > <select id="ma029" onKeyPress="keyFunction()" name="ma030" " tabIndex="29">
           <option <?php if($ma030 == '2') echo 'selected="selected"';?> value='2'>三聯式發票</option>
            <option <?php if($ma030 == '1') echo 'selected="selected"';?> value='1'>二聯式發票</option> 
            <option <?php if($ma030 == '3') echo 'selected="selected"';?> value='3'>二聯式收銀機發票</option>
            <option <?php if($ma030 == '4') echo 'selected="selected"';?> value='4'>三聯式收銀機發票</option>
            <option <?php if($ma030 == '5') echo 'selected="selected"';?> value='5'>電子計算機發票</option>
            <option <?php if($ma030 == '6') echo 'selected="selected"';?> value='6'>免用統一發票</option>
		</select>
		<td class="normal14z" >初次交易：</td>
        <td class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ma022" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="ma022"  value="<?php echo $ma022; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ma022,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
		
	  <tr>
	    <td  class="normal14z" >課稅別：</td>
        <td  class="normal14"  > <select id="ma044" onKeyPress="keyFunction()" name="ma044"  tabIndex="31">
		     <option <?php if($ma044 == '2') echo 'selected="selected"';?> value='2'>應稅外加</option>
            <option <?php if($ma044 == '1') echo 'selected="selected"';?> value='1'>應稅內含</option> 
            <option <?php if($ma044 == '3') echo 'selected="selected"';?> value='3'>零稅率</option>
		    <option <?php if($ma044 == '4') echo 'selected="selected"';?> value='4'>免稅</option>
            <option <?php if($ma044 == '9') echo 'selected="selected"';?> value='9'>不計稅</option>				
		  </select>
	   <td  class="normal14z">最近交易：</td>		
       <td  class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="ma023" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="ma023"  value="<?php echo $ma023; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ma023,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	   <td  class="normal14z" >加工費用科目：</td>
       <td class="normal14"><input tabIndex="33" id="ma042" onKeyPress="keyFunction()" name="actq03a1" onchange="startactq03a1(this)"   value="<?php echo  $actq03a1; ?>"     type="text"  /><img id="Showactq03a1" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="actq03a1disp"> <?php   echo $actq03a1disp; ?> </span></td>
	  </tr>
	  <tr>
	    <td class="normal14z">付款方式：</td>						
            <td  class="normal14"  ><select id="ma024" onKeyPress="keyFunction()" name="ma024" " tabIndex="34">
            <option <?php if($ma024 == '1') echo 'selected="selected"';?> value='1'>現金</option>                                                                        
		    <option <?php if($ma024 == '2') echo 'selected="selected"';?> value='2'>電匯</option>
            <option <?php if($ma024 == '3') echo 'selected="selected"';?> value='3'>支票</option>
		    <option <?php if($ma024 == '4') echo 'selected="selected"';?> value='4'>其他</option>
		   </select>
		   <td class="normal14z" >付款條件：</td>						
           <td  class="normal14"  ><input tabIndex="35" id="ma025" onKeyPress="keyFunction()" name="cmsq21a1" onchange="startcmsq21a1(this)"   value="<?php echo  $cmsq21a1; ?>"     type="text"  /><img id="Showcmsq21a1" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="cmsq21a1disp"> <?php    echo $cmsq21a1disp; ?> </span></td>
		<td  class="normal14z">應付帳款科目：</td>						
        <td  class="normal14"  ><input tabIndex="36" id="ma041" onKeyPress="keyFunction()" name="actq03a2" onchange="startactq03a2(this)"   value="<?php echo  $actq03a2; ?>"     type="text"  /><img id="Showactq03a2" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="actq03a2disp"> <?php    echo $actq03a2disp; ?> </span></td>
	  </tr>	
		
	  <tr>
	    <td  class="normal14z" >價格條件：</td>
        <td class="normal14"><input tabIndex="37" id="ma026" onKeyPress="keyFunction()"   name="ma026" value="<?php echo $ma026; ?>" type="text"  /></td>
	    <td class="normal14z">應付票據科目：</td>						
        <td  class="normal14"  ><input tabIndex="38" id="ma043" onKeyPress="keyFunction()" name="actq03a3" onchange="startactq03a3(this)"   value="<?php echo  $actq03a3; ?>"     type="text"  /><img id="Showactq03a3" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="actq03a3disp"> <?php  echo $this->session->userdata('ma043disp');  ?><?php  if (!$this->session->userdata('ma043disp'))  echo $actq03a3disp; ?> </span></td>
		<td class="normal14z" >匯款銀行：</td>						
        <td  class="normal14"  ><input tabIndex="39" id="ma027" onKeyPress="keyFunction()" name="ma027"   value="<?php echo $ma027; ?>"   type="text" /></td>
	  </tr>
	  
	  <tr>
	    <td  class="normal14z">匯款帳號：</td>						
        <td  class="normal14"  ><input tabIndex="40" id="ma028" onKeyPress="keyFunction()" name="ma028"   value="<?php echo $ma028; ?>"   type="text" /></td>
	    <td class="normal14z" >結帳日驗收後：</td>
        <td class="normal14"><input tabIndex="41" id="ma034" onKeyPress="keyFunction()" name="ma034"   value="<?php echo $ma034; ?>"   type="text" /></td>       
		<td class="normal14z">個月逢</td>
        <td class="normal14"><input tabIndex="42" id="ma035" onKeyPress="keyFunction()" name="ma035"   value="<?php echo $ma035; ?>"   type="text" /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >ABC等級：</td>
        <td class="normal14"><input tabIndex="43" id="ma031" onKeyPress="keyFunction()" name="ma031"   value="<?php echo $ma031; ?>"   type="text" /></td>       
		<td class="normal14z">交貨評等：</td>
        <td class="normal14"><input tabIndex="44" id="ma032" onKeyPress="keyFunction()" name="ma032"   value="<?php echo $ma032; ?>"   type="text" /></td>
		<td class="normal14z">品質評等：</td>
        <td class="normal14"><input tabIndex="45" id="ma033" onKeyPress="keyFunction()" name="ma033"   value="<?php echo $ma033; ?>"   type="text" /></td>
	  </tr>
		
	</table>
	</div>	

	<!--  地址 3 -->
     <div id="tab3" class="tab_content">
	<?php
	  $date=date("Ymd");
	  $ma046=$this->input->post('ma046');
	  $ma048=$this->input->post('ma048');
	  $ma049=$this->input->post('ma049');
	  $ma050=$this->input->post('ma050');
	  $ma051=$this->input->post('ma051');
	  $ma052=$this->input->post('ma052');
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y"  width="11%"> 郵遞區號(一)：</td>
        <td class="normal14a"  width="89%"><input tabIndex="46" id="ma046" onKeyPress="keyFunction()" name="ma046" value="<?php echo $ma046; ?>"  type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14z" > 聯絡地址(一)：</td>
        <td class="normal14" ><input tabIndex="47" id="ma048" onKeyPress="keyFunction()" name="ma048" value="<?php echo $ma048; ?>" size="80" type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14z" > 聯絡地址(二)：</td>
        <td class="normal14" ><input tabIndex="48" id="ma049" onKeyPress="keyFunction()" name="ma049" value="<?php echo $ma049; ?>" size="80" type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14z" > 郵遞區號(二)：</td>
        <td class="normal14" ><input tabIndex="49" id="ma050" onKeyPress="keyFunction()" name="ma050" value="<?php echo $ma050; ?>"  type="text"  /></td>
	  </tr>	
	  <tr>
	    <td class="normal14z" > 帳單地址(一)：</td>
        <td class="normal14" ><input tabIndex="50" id="ma051" onKeyPress="keyFunction()" name="ma051" value="<?php echo $ma051; ?>" size="80" type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14z" > 帳單地址(二)：</td>
        <td class="normal14" ><input tabIndex="51" id="ma052" onKeyPress="keyFunction()" name="ma052" value="<?php echo $ma052; ?>" size="80" type="text"  /></td>
	  </tr>	
	 
		
	</table>	 
    </div>
	 
	</div>
	  <!--  <div class="buttons">
	    <button  type='submit'  accesskey="s"  name="submit"  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  accesskey="x"  onKeyPress="keyFunction()" id="cancel" name="cancel" href="<?php echo site_url('pur/puri01/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div> -->
	  
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,日期欄位快按2下可開視窗查詢萬年曆,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div> <!-- div-5 -->
  </div> <!-- div-4 -->
</div> <!-- div-3 -->

   </div> <!-- div-2 -->
  </div>  <!-- div-1 -->
 </div>  <!-- div-0 -->
 <SCRIPT language="javascript">
function addtextbox(name,id) {
 
    //Create an input type dynamically.
    var element = document.createElement("input");
 
    //Assign different attributes to the element.
    element.setAttribute("type", "text");
    element.setAttribute("name", name);
	element.setAttribute("value","");
	element.setAttribute("size", 16);
	element.setAttribute("maxlength", 20);
	
	var lf=document.createElement('br')
 
    var foo = document.getElementById(id);
 	
    //Append the element in page (in span).
    foo.appendChild(lf);
	foo.appendChild(element);
 	
}
</SCRIPT>
    <?php include_once("./application/views/fun/puri01_funjs_v.php"); ?>
	
