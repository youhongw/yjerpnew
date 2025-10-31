<div id="container">
  <div id="header">
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?=base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>
	</div>
    </div>

<div id="content">
 <div class="box">
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 廠商資料建立作業</h1>
	<form  class="cmxform" id="commentForm"  name="form" action="<?=base_url()?>index.php/pur/puri01/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content">
	<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>
	<div id="tab-general">
	<?php foreach($result as $row) { ?>
          <?  $ma001=$row->ma001;?>
          <?  $ma002=$row->ma002;?>
          <?  $ma003=$row->ma003;?>
          <?  $ma004=$row->ma004;?>
          <?  $ma005=$row->ma005;?>
          <?  $ma006=$row->ma006;?>
		  <?  $ma007=$row->ma007;?>
		  <?  $ma008=$row->ma008;?>
		  <?  $ma009=$row->ma009;?>
		  <?  $ma010=$row->ma010;?>
		  <?  $ma011=$row->ma011;?>
          <?  $ma012=$row->ma012;?>
          <?  $ma013=$row->ma013;?>
          <?  $ma014=$row->ma014;?>
          <?  $ma015=$row->ma015;?>
          <?  $ma016=$row->ma016;?>
		  <?  $ma017=$row->ma017;?>
		  <?  $ma018=$row->ma018;?>
		  <?  $ma019=$row->ma019;?>
		  <?  $ma020=$row->ma020;?>		
		  <?  $ma021=$row->ma021;?>
          <?  $ma022=$row->ma022;?>
          <?  $ma023=$row->ma023;?>
          <?  $ma024=$row->ma024;?>
          <?  $ma025=$row->ma025;?>
          <?  $ma026=$row->ma026;?>
		  <?  $ma027=$row->ma027;?>
		  <?  $ma028=$row->ma028;?>
		  <?  $ma029=$row->ma029;?>
		  <?  $ma030=$row->ma030;?>
		  <?  $ma031=$row->ma031;?>
          <?  $ma032=$row->ma032;?>
          <?  $ma033=$row->ma033;?>
          <?  $ma034=$row->ma034;?>
          <?  $ma035=$row->ma035;?>
          <?  $ma036=$row->ma036;?>
		  <?  $ma037=$row->ma037;?>
		  <?  $ma038=$row->ma038;?>
		  <?  $ma039=$row->ma039;?>
		  <?  $ma040=$row->ma040;?>
		  <?  $ma041=$row->ma041;?>
          <?  $ma042=$row->ma042;?>
          <?  $ma043=$row->ma043;?>
          <?  $ma044=$row->ma044;?>
          <?  $ma045=$row->ma045;?>
          <?  $ma046=$row->ma046;?>
		  <?  $ma047=$row->ma047;?>
		  <?  $ma048=$row->ma048;?>
		  <?  $ma049=$row->ma049;?>
		  <?  $ma050=$row->ma050;?>
		  <?  $ma051=$row->ma051;?>
          <?  $ma052=$row->ma052;?>
          <?  $ma053=$row->ma053;?>
          <?  $ma054=$row->ma054;?>
          <?  $ma055=$row->ma055;?>
          <?  $ma056=$row->ma056;?>
		  
		  <?  $ma047disp=$row->ma047disp;?>
		  <?  $ma021disp=$row->ma021disp;?>
		  <?  $ma007disp=$row->ma007disp;?>	
		  <?  $ma006disp=$row->ma006disp;?>		
		  <?  $ma004disp=$row->ma004disp;?>	
		  <?  $ma042disp=$row->ma042disp;?>
		  <?  $ma041disp=$row->ma041disp;?>
		  <?  $ma043disp=$row->ma043disp;?>
		  <?  $ma025disp=$row->ma025disp;?>	  
		  
		 
		  <?  $mb991=' ';?>
		  <?  $mb992=' ';?>
		  <?  $mb999=' ';?>
		 
	<?php  }?>
      
	<table class="form12"  >     <!-- 頭部表格 -->
	  <tr>
	     <td class="start12a"  width="10%"><span class="required">廠商代號：</span> </td>
            <td class="normal12a"  width="50%"><input tabIndex="1" id="ma001"      onKeyPress="keyFunction()" onBlur="startpurq01a(this)"  name="ma001" value="<?php echo strtoupper($ma001); ?>"  type="text" required disabled="disabled" />
			<span id="ma001disp" ></span><span><?php  { $this->session->set_userdata('ma001', $ma001);$ma001 = $this->session->userdata('ma001'); }  ?></span></td>
	    <td class="normal12a" width="10%" >統一編號： </td>
            <td class="normal12a"  width="50%" ><input tabIndex="2" id="ma005" onKeyPress="keyFunction()" name="ma005"  onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase()" value="<?php echo  strtoupper($ma005); ?>"    type="text" disabled="disabled" /></td>
	 </tr>	
		  
	  <tr>
	    <td class="start12" >廠商簡稱： </td>
            <td class="normal12" ><input tabIndex="3" id="ma002" onKeyPress="keyFunction()" onBlur="checkspace2(this)" name="ma002" value="<?php echo $ma002; ?>" size="30" type="text" required disabled="disabled" /><span id="ma002disp" ></span></td>
		   <td class="normal12">&nbsp;&nbsp;</td>
            <td class="normal12"></td>
		
	  </tr>
		
	  <tr>
	    <td  class="normal12" >廠商全名：</td>
            <td  class="normal12"  ><input tabIndex="4" id="ma003" onKeyPress="keyFunction()" name="ma003"  value="<?php echo $ma003; ?>"  size="30" type="text" disabled="disabled"  /></td>
			 <td class="normal12">&nbsp;&nbsp;</td>
            <td class="normal12"></td>
	  </tr>
		
	</table>
	
	<div class="abgne_tab">
		<ul class="tabs">
			<li><a href="#tab1">基本資料</a></li>
			<li><a href="#tab2">交易資料</a></li>
			<li><a href="#tab3">地址</a></li>
		</ul>
	
	 
<!--	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?=base_url()?>index.php/pur/puri01/addsave" >	 -->
<!--	<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>    -->
    <div class="tab_container">
			<div id="tab1" class="tab_content">
	<!--  <div id="tab-general">     基本資料1 -->
	
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    
	    <td class="start14a" width="10%" ><span class="required">核准狀況：</span>&nbsp;</td>
		<td class="normal14a" width="23%">
		  <select id="ma016" onKeyPress="keyFunction()" name="ma016" " tabIndex="5" disabled="disabled" >
            <option <?php if($ma016 == '1') echo 'selected="selected"';?> value='1'>已核准</option>                                                                        
		    <option <?php if($ma016 == '2') echo 'selected="selected"';?> value='2'>尚待核准</option>
            <option <?php if($ma016 == '3') echo 'selected="selected"';?> value='3'>不准交易</option>
		  </select></td>
		<td class="start14a"  width="10%">地區別：</td>
        <td class="normal14a"  width="23%" ><input type="text" tabIndex="6" id="ma007" onKeyPress="keyFunction()"   onBlur="startcmsq15a3(this)" name="ma007"   value="<?php echo  $ma007; ?>"   disabled="disabled"  /><a href="javascript:;"><img id="Showcmsq15a3" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
		<span id="ma007disp"> <?php  echo $this->session->userdata('ma007disp');  ?><?php  if (!$this->session->userdata('ma007disp'))  echo $ma007disp; ?> </span></td>	
			
		<td class="normal14a"  width="10%" > TEL(一)：</td>
        <td class="normal14a"  width="24%" ><input tabIndex="7" id="ma008" onKeyPress="keyFunction()"   name="ma008" value="<?php echo $ma008; ?>" type="text" disabled="disabled" /></td>
	
       
	</tr>	
		  
	  <tr>
	   <td class="start14a"  >國家別：</td>
        <td class="normal14" ><input type="text" tabIndex="8" id="ma006" onKeyPress="keyFunction()"   onBlur="startcmsq15a4(this)" name="ma006"   value="<?php echo  $ma006; ?>"    size="6" disabled="disabled" /><a href="javascript:;"><img id="Showcmsq15a4" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
		<span id="ma006disp"> <?php  echo $this->session->userdata('ma006disp');  ?><?php  if (!$this->session->userdata('ma006disp'))  echo $ma006disp; ?> </span></td>
	    <td class="normal14" >TEL(二)：</td>
        <td class="normal14"  ><input tabIndex="9" id="ma009" onKeyPress="keyFunction()"   name="ma009" value="<?php echo $ma009; ?>" type="text" disabled="disabled" /></td>
	
		<td class="start14a" >廠商分類：</td>
        <td class="normal14"  ><input tabIndex="10" id="ma004" onKeyPress="keyFunction()" name="ma004" onBlur="startcmsq15a9(this)"   value="<?php echo  $ma004; ?>"     type="text" disabled="disabled" /><img id="Showcmsq15a9" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
        <span id="ma004disp"> <?php  echo $this->session->userdata('ma004disp');  ?><?php  if (!$this->session->userdata('ma004disp'))  echo $ma004disp; ?> </span></td>		    
				
	  </tr>
		
	  <tr>
	    <td  class="normal14" >傳真號碼：</td>
        <td  class="normal14"  ><input tabIndex="11" id="ma010" onKeyPress="keyFunction()"   name="ma010" value="<?php echo $ma010; ?>" type="text" disabled="disabled" /></td>		   
	   <td  class="start14a">開業日期：</td>		
        <td  class="normal14"  ><input tabIndex="12"  id="datepicker3" onKeyPress="keyFunction()"   name="ma017" value="<?php echo $ma017; ?>" type="text" disabled="disabled" /></td>
	     <td  class="normal14" >E-MAIL：</td>
             <td class="normal14"><input tabIndex="13" id="ma011" onKeyPress="keyFunction()"   name="ma011" value="<?php echo $ma011; ?>" type="text" disabled="disabled" /></td>
	    
	  </tr>
	    <tr>
	    
	    <td class="normal14">資本額：</td>						
            <td  class="normal14"  ><input tabIndex="14" id="ma018" onKeyPress="keyFunction()" name="ma018"   value="<?php echo $ma018; ?>"  type="text" disabled="disabled"  /></td>
			 <td class="normal14" >負責人：</td>						
            <td  class="normal14"  ><input tabIndex="15" id="ma012" onKeyPress="keyFunction()" name="ma012"   value="<?php echo $ma012; ?>"   type="text" disabled="disabled" /></td>
		<td  class="normal14">員工人數：</td>						
        <td  class="normal14"  ><input tabIndex="16" id="ma019" onKeyPress="keyFunction()" name="ma019"   value="<?php echo $ma019; ?>"    type="text" disabled="disabled" /></td>
	  </tr>	
		
	  <tr>
	     <td  class="normal14" >聯絡人(一)：</td>
             <td class="normal14"><input tabIndex="17" id="ma013" onKeyPress="keyFunction()"   name="ma013" value="<?php echo $ma013; ?>" type="text" disabled="disabled" /></td>
	    <td class="start14a">交易幣別：</td>						
            <td  class="normal14"  ><input tabIndex="18" id="ma021" onKeyPress="keyFunction()" name="ma021" onBlur="startcmsq06a(this)"  value="<?php echo $ma021; ?>"  type="text" disabled="disabled"  /><img id="Showcmsq06a" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
              <span id="ma021disp"> <?php  echo $this->session->userdata('ma021disp');  ?><?php  if (!$this->session->userdata('ma021disp'))  echo $ma021disp; ?> </span></td>			
			<td class="normal14" >聯絡人(二)：</td>						
            <td  class="normal14"  ><input tabIndex="19" id="ma012" onKeyPress="keyFunction()" name="ma012"   value="<?php echo $ma012; ?>"   type="text" disabled="disabled" /></td>
	
	  </tr>
	  
	  <tr>
	    <td  class="start14a">稅額方式：</td>						
        <td  class="normal14"  ><input tabIndex="20" type="radio" name="ma053" <?php if (isset($ma053) && $ma053=="1") echo "checked";?> value="1" />整張計算  &nbsp;&nbsp;&nbsp; 
               <input type="radio" tabIndex="21" name="ma053" <?php if (isset($ma053) && $ma004=="2") echo "checked";?> value="2" />單身單筆計算</td>
	    <td class="normal14" >聯絡人(三)：</td>
        <td class="normal14"><input tabIndex="22" id="ma015" onKeyPress="keyFunction()" name="ma015"   value="<?php echo $ma015; ?>"   type="text" /></td>       
		   <td class="start14a">採購人員</td>
            <td class="normal14"><input tabIndex="23" id="ma047" onKeyPress="keyFunction()" name="ma047" onBlur="startcmsq09a4(this)"   value="<?php echo  $ma047; ?>"     type="text" disabled="disabled" /><img id="Showcmsq09a4" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
        <span id="ma047disp"> <?php  echo $this->session->userdata('ma047disp');  ?><?php  if (!$this->session->userdata('ma047disp'))  echo $ma047disp; ?> </span></td>
			
	  </tr>
	  <tr>
	    <td class="normal14" >備註：</td>
        <td class="normal14"><input tabIndex="24" id="ma040" onKeyPress="keyFunction()" name="ma040"   value="<?php echo $ma040; ?>"   type="text" disabled="disabled" /></td>       
		   <td class="normal14"></td>
            <td class="normal14"></td>
			 <td class="normal14">&nbsp;&nbsp;</td>
            <td class="normal14"></td>
			
	  </tr>
		
	</table>
	</div>
	<div id="tab2" class="tab_content">
	<!--  <div id="tab-contact">   基本資料2 -->
	
   
	<table class="form12">     <!-- 表格 -->
	  <tr>
	    <td class="start14a" width="10%" ><span class="required">採購單方式：</span>&nbsp;</td>
		<td class="normal14a" width="23%">
		  <select id="ma020" onKeyPress="keyFunction()" name="ma020" " tabIndex="25" disabled="disabled">
		    <option <?php if($ma016 == '2') echo 'selected="selected"';?> value='2'>FAX</option>
            <option <?php if($ma016 == '1') echo 'selected="selected"';?> value='1'>郵寄</option>
            <option <?php if($ma016 == '3') echo 'selected="selected"';?> value='3'>EDI</option>
			<option <?php if($ma016 == '4') echo 'selected="selected"';?> value='4'>E-MAIL</option>
		  </select></td>
		<td class="start14a"  width="10%">票據寄領：</td>
        <td class="normal14a"  width="23%" >
		  <select id="ma029" onKeyPress="keyFunction()" name="ma025" " tabIndex="26" disabled="disabled">
            <option <?php if($ma029 == '1') echo 'selected="selected"';?> value='1'>郵寄</option>                                                                        
		    <option <?php if($ma029 == '2') echo 'selected="selected"';?> value='2'>自領</option>
            <option <?php if($ma029 == '3') echo 'selected="selected"';?> value='3'>其它</option>			
		  </select>
		</td>
		<td class="normal14a"  width="12%" >可分批交貨：</td>
        <td class="normal14a"  width="22%" > <input tabIndex="27" id="ma045" onKeyPress="keyFunction()"  name="ma045" <?php if($ma045 == 'Y' ) echo 'checked';  ?>  <?php if($ma045 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox' disabled="disabled" /></td>
		    <?php if($ma045 == '0')  $ma045="N";?><?php if($ma045 == '1')  $ma045="Y";?>
	
	</tr>	
		  
	  <tr>
	   <td class="start14a"  >隨貨附發票：</td>
        <td class="normal14" ><input tabIndex="28" id="ma056" onKeyPress="keyFunction()"  name="ma056" <?php if($ma056 == 'Y' ) echo 'checked';  ?>  <?php if($ma056 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox' disabled="disabled" /></td>
		    <?php if($ma056 == '0')  $ma056="N";?> <?php if($ma056 == '1')  $ma056="Y";?>
	    <td class="normal14" >發票聯數：</td>
        <td class="normal14"  > <select id="ma028" onKeyPress="keyFunction()" name="ma030" " tabIndex="29">
            <option <?php if($ma030 == '1') echo 'selected="selected"';?> value='1'>二聯式發票</option>                                                                        
		    <option <?php if($ma030 == '2') echo 'selected="selected"';?> value='2'>三聯式發票</option>
            <option <?php if($ma030 == '3') echo 'selected="selected"';?> value='3'>二聯式收銀機發票</option>
            <option <?php if($ma030 == '4') echo 'selected="selected"';?> value='4'>三聯式收銀機發票</option>
            <option <?php if($ma030 == '5') echo 'selected="selected"';?> value='5'>電子計算機發票</option>
            <option <?php if($ma030 == '6') echo 'selected="selected"';?> value='6'>免用統一發票</option>
		  </select>
	
		<td class="start14a" >初次交易：</td>
        <td class="normal14"  ><input tabIndex="30" id="datepicker1" onKeyPress="keyFunction()" type="text" name="ma022"    value="<?php echo $ma022; ?>"  disabled="disabled" /></td>	    
				
	  </tr>
		
	  <tr>
	    <td  class="normal14" >課稅別：</td>
        <td  class="normal14"  > <select id="ma044" onKeyPress="keyFunction()" name="ma044" " tabIndex="31">
            <option <?php if($ma044 == '1') echo 'selected="selected"';?> value='1'>應稅內含</option>                                                                        
		    <option <?php if($ma044 == '2') echo 'selected="selected"';?> value='2'>應稅外加</option>
            <option <?php if($ma044 == '3') echo 'selected="selected"';?> value='3'>零稅率</option>
		    <option <?php if($ma044 == '4') echo 'selected="selected"';?> value='4'>免稅</option>
            <option <?php if($ma044 == '9') echo 'selected="selected"';?> value='9'>不計稅</option>				
		  </select>
	   <td  class="start14a">最近交易：</td>		
        <td  class="normal14"  ><input tabIndex="32"  id="datepicker2" onKeyPress="keyFunction()" type="text" name="ma023"    value="<?php echo $ma023; ?>"  disabled="disabled" /></td>	
	     <td  class="normal14" >加工費用科目：</td>
             <td class="normal14"><input tabIndex="33" id="ma042" onKeyPress="keyFunction()" name="ma042" onBlur="startactq03a1(this)"   value="<?php echo  $ma042; ?>"     type="text" disabled="disabled" /><img id="Showactq03a1" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
        <span id="ma042disp"> <?php  echo $this->session->userdata('ma042disp');  ?><?php  if (!$this->session->userdata('ma042disp'))  echo $ma042disp; ?> </span></td>
	    
	  </tr>
	    <tr>
	    
	    <td class="normal14">付款方式：</td>						
            <td  class="normal14"  ><select id="ma024" onKeyPress="keyFunction()" name="ma024" " tabIndex="34" disabled="disabled">
            <option <?php if($ma024 == '1') echo 'selected="selected"';?> value='1'>現金</option>                                                                        
		    <option <?php if($ma024 == '2') echo 'selected="selected"';?> value='2'>電匯</option>
            <option <?php if($ma024 == '3') echo 'selected="selected"';?> value='3'>支票</option>
		    <option <?php if($ma024 == '4') echo 'selected="selected"';?> value='4'>其他</option>
		  </select>
			 <td class="normal14" >付款條件：</td>						
            <td  class="normal14"  ><input tabIndex="35" id="ma025" onKeyPress="keyFunction()" name="ma025" onBlur="startcmsq21a1(this)"   value="<?php echo  $ma025; ?>"     type="text" disabled="disabled" /><img id="Showcmsq21a1" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
        <span id="ma025disp"> <?php  echo $this->session->userdata('ma025disp');  ?><?php  if (!$this->session->userdata('ma025disp'))  echo $ma025disp; ?> </span></td>
		<td  class="normal14">應付帳款科目：</td>						
        <td  class="normal14"  ><input tabIndex="36" id="ma041" onKeyPress="keyFunction()" name="ma041" onBlur="startactq03a2(this)"   value="<?php echo  $ma041; ?>"     type="text" disabled="disabled" /><img id="Showactq03a2" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
        <span id="ma041disp"> <?php  echo $this->session->userdata('ma041disp');  ?><?php  if (!$this->session->userdata('ma041disp'))  echo $ma041disp; ?> </span></td>
	  </tr>	
		
	  <tr>
	     <td  class="normal14" >價格條件：</td>
             <td class="normal14"><input tabIndex="37" id="ma026" onKeyPress="keyFunction()"   name="ma026" value="<?php echo $ma026; ?>" type="text"  /></td>
	    <td class="normal14">應付票據科目：</td>						
            <td  class="normal14"  ><input tabIndex="38" id="ma043" onKeyPress="keyFunction()" name="ma043" onBlur="startactq03a3(this)"   value="<?php echo  $ma043; ?>"     type="text" disabled="disabled" /><img id="Showactq03a3" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
        <span id="ma043disp"> <?php  echo $this->session->userdata('ma043disp');  ?><?php  if (!$this->session->userdata('ma043disp'))  echo $ma043disp; ?> </span></td>
			 <td class="normal14" >匯款銀行：</td>						
            <td  class="normal14"  ><input tabIndex="39" id="ma027" onKeyPress="keyFunction()" name="ma027"   value="<?php echo $ma027; ?>"   type="text" disabled="disabled" /></td>
	
	  </tr>
	  
	  <tr>
	    <td  class="start14a">匯款帳號：</td>						
        <td  class="normal14"  ><input tabIndex="40" id="ma029" onKeyPress="keyFunction()" name="ma028"   value="<?php echo $ma028; ?>"   type="text" disabled="disabled" /></td>
	    <td class="normal14" >結帳日驗收後：</td>
        <td class="normal14"><input tabIndex="41" id="ma034" onKeyPress="keyFunction()" name="ma034"   value="<?php echo $ma034; ?>"   type="text" disabled="disabled" /></td>       
		   <td class="start14a">個月逢</td>
            <td class="normal14"><input tabIndex="42" id="ma035" onKeyPress="keyFunction()" name="ma035"   value="<?php echo $ma035; ?>"   type="text" disabled="disabled" /></td> 
			
	  </tr>
	  <tr>
	    <td class="normal14" >ABC等級：</td>
        <td class="normal14"><input tabIndex="43" id="ma031" onKeyPress="keyFunction()" name="ma031"   value="<?php echo $ma031; ?>"   type="text" disabled="disabled" /></td>       
		   <td class="normal14">交貨評等：</td>
            <td class="normal14"><input tabIndex="44" id="ma032" onKeyPress="keyFunction()" name="ma032"   value="<?php echo $ma032; ?>"   type="text" disabled="disabled" /></td>
			 <td class="normal14">品質評等：</td>
            <td class="normal14"><input tabIndex="45" id="ma033" onKeyPress="keyFunction()" name="ma033"   value="<?php echo $ma033; ?>"   type="text" disabled="disabled" /></td>
			
	  </tr>
		
	</table>
	</div>		  
     <div id="tab3" class="tab_content">
     <!--  <div id="tab-contact">   採購生管 3 -->
	
   
	<table class="form12">     <!-- 表格 -->
	   <tr>
	    <td class="normal12a"  width="10%"> 郵遞區號(一)：</td>
        <td class="normal12a"  width="90%"><input tabIndex="46" id="ma046" onKeyPress="keyFunction()" name="ma046" value="<?php echo $ma046; ?>"  type="text" disabled="disabled" /></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal12" > 聯絡地址(一)：</td>
        <td class="normal12" ><input tabIndex="47" id="ma048" onKeyPress="keyFunction()" name="ma048" value="<?php echo $ma048; ?>" size="80" type="text" disabled="disabled" /></td>
	  </tr>
	  <tr>
	    <td class="normal12" > 聯絡地址(二)：</td>
        <td class="normal12" ><input tabIndex="48" id="ma049" onKeyPress="keyFunction()" name="ma049" value="<?php echo $ma049; ?>" size="80" type="text" disabled="disabled" /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal12" > 郵遞區號(二)：</td>
        <td class="normal12" ><input tabIndex="49" id="ma050" onKeyPress="keyFunction()" name="ma050" value="<?php echo $ma050; ?>"  type="text" disabled="disabled" /></td>
	  </tr>	
	  <tr>
	    <td class="normal12" > 帳單地址(一)：</td>
        <td class="normal12" ><input tabIndex="50" id="ma051" onKeyPress="keyFunction()" name="ma051" value="<?php echo $ma051; ?>" size="80" type="text" disabled="disabled" /></td>
	  </tr>
	  <tr>
	    <td class="normal12" > 帳單地址(二)：</td>
        <td class="normal12" ><input tabIndex="51" id="ma052" onKeyPress="keyFunction()" name="ma052" value="<?php echo $ma052; ?>" size="80" type="text" disabled="disabled" /></td>
	  </tr>	
	  
	    
	  <tr>
	    
		<td class="normal12">&nbsp;&nbsp;</td>
        <td class="normal12"></td>
	  </tr>
		
	</table>	 
     </div>	
	  
        </form>
	    </div>
  </div>
  <div class="buttons">
	    <a tabIndex="100" id='cancel' name='cancel' href="<?php echo site_url('pur/puri01/'.$this->session->userdata('search')); ?>" class="button" ><span>返回</span></a>
	  </div>
</div>
  <!--  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>  -->
  </div>
 </div>
</div>
