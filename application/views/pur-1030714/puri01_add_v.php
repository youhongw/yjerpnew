
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
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 廠商基本資料建立作業</h1>
    </div>
	
    <div class="content">
	<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?=base_url()?>index.php/pur/puri01/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數
	  
	  $date=date("Ymd");
	 
	  if ($this->session->userdata('ma001')) { $ma001 = $this->session->userdata('ma001'); } else { $ma001=$this->input->post('ma001'); }
	//   if(!isset($ma001)) { $ma001=$this->input->post('ma001'); }
	   
	  if(!isset($ma004)) { $ma004=$this->input->post('ma004'); }
      $ma002=$this->input->post('ma002');
      $ma003=$this->input->post('ma003');	  
      $ma005=$this->input->post('ma005');      	
     
	//  if($this->uri->segment(4) && $this->uri->segment(6)==5) { $ma001=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ma001', $ma001);$ma001 = $this->session->userdata('ma001'); }
    //  if($this->uri->segment(5) && $this->uri->segment(6)==5) { $ma001disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ma001disp', $ma001disp); $ma001disp = $this->session->userdata('ma001disp');} 
	 // if ($this->session->userdata('ma001')) { $ma001= $this->session->userdata('ma001'); }

	?>
   
	<table class="form12"  >     <!-- 頭部表格 -->
	  <tr>
	     <td class="start12a"  width="10%"><span class="required">廠商代號：</span> </td>
            <td class="normal12a"  width="50%"><input tabIndex="1" id="ma001"      onKeyPress="keyFunction()" onBlur="startpurq01a(this)"  name="ma001" value="<?php echo strtoupper($ma001); ?>"  type="text" required />
			<span id="ma001disp" ></span><span><?php  { $this->session->set_userdata('ma001', $ma001);$ma001 = $this->session->userdata('ma001'); }  ?></span></td>
	    <td class="normal12a" width="10%" >統一編號： </td>
            <td class="normal12a"  width="50%" ><input tabIndex="2" id="ma005" onKeyPress="keyFunction()" name="ma005"  onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase()" value="<?php echo  strtoupper($ma005); ?>"    type="text"  /></td>
	 </tr>	
		  
	  <tr>
	    <td class="start12" >廠商簡稱： </td>
            <td class="normal12" ><input tabIndex="3" id="ma002" onKeyPress="keyFunction()" onBlur="checkspace2(this)" name="ma002" value="<?php echo $ma002; ?>" size="30" type="text" required /><span id="ma002disp" ></span></td>
		   <td class="normal12">&nbsp;&nbsp;</td>
            <td class="normal12"></td>
		
	  </tr>
		
	  <tr>
	    <td  class="normal12" >廠商全名：</td>
            <td  class="normal12"  ><input tabIndex="4" id="ma003" onKeyPress="keyFunction()" name="ma003"  value="<?php echo $ma003; ?>"  size="30" type="text"   /></td>
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
	<!--  <div id="tab-general">     基本資料 -->
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
      $ma047=$this->input->post('ma047');		  
      $ma040=$this->input->post('ma040');
	  $ma007=$this->input->post('ma007');	
	  $ma006=$this->input->post('ma006');	
	  $ma004=$this->input->post('ma004');
      $ma017=$this->input->post('ma017');
      $ma018=$this->input->post('ma018');		  
      $ma019=$this->input->post('ma019');
	  $ma021=$this->input->post('ma021');		  
      $ma053=$this->input->post('ma053');

	  //開視窗及不更新網頁直接輸入出現中文
	  $ma047disp=$this->input->post('ma047');
      if($this->uri->segment(4) && $this->uri->segment(6)==21) { $ma047=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ma047', $ma047);$ma047 = $this->session->userdata('ma047'); }
	  if($this->uri->segment(5) && $this->uri->segment(6)==21) { $ma047disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ma047disp', $ma047disp); $ma047disp = $this->session->userdata('ma047disp');} 
	  if ($this->session->userdata('ma047')) { $ma047= $this->session->userdata('ma047'); }
	  
	  $ma007disp=$this->input->post('ma007');
      if($this->uri->segment(4) && $this->uri->segment(6)==21) { $ma007=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ma007', $ma007);$ma007 = $this->session->userdata('ma007'); }
	  if($this->uri->segment(5) && $this->uri->segment(6)==21) { $ma007disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ma007disp', $ma007disp); $ma007disp = $this->session->userdata('ma007disp');} 
	  if ($this->session->userdata('ma007')) { $ma007= $this->session->userdata('ma007'); }
	  
	  $ma006disp=$this->input->post('ma006');
      if($this->uri->segment(4) && $this->uri->segment(6)==21) { $ma006=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ma006', $ma006);$ma006 = $this->session->userdata('ma006'); }
	  if($this->uri->segment(5) && $this->uri->segment(6)==21) { $ma006disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ma006disp', $ma006disp); $ma006disp = $this->session->userdata('ma006disp');} 
	  if ($this->session->userdata('ma006')) { $ma006= $this->session->userdata('ma006'); }
	  
	   $ma004disp=$this->input->post('ma004');
      if($this->uri->segment(4) && $this->uri->segment(6)==21) { $ma004=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ma004', $ma004);$ma004 = $this->session->userdata('ma004'); }
	  if($this->uri->segment(5) && $this->uri->segment(6)==21) { $ma004disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ma004disp', $ma004disp); $ma004disp = $this->session->userdata('ma004disp');} 
	  if ($this->session->userdata('ma004')) { $ma004= $this->session->userdata('ma004'); }
	  
	  $ma021disp=$this->input->post('ma021');
      if($this->uri->segment(4) && $this->uri->segment(6)==21) { $ma021=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ma021', $ma021);$ma021 = $this->session->userdata('ma021'); }
	  if($this->uri->segment(5) && $this->uri->segment(6)==21) { $ma021disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ma021disp', $ma021disp); $ma021disp = $this->session->userdata('ma021disp');} 
	  if ($this->session->userdata('ma021')) { $ma021= $this->session->userdata('ma021'); }
	
	  
	?>
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	    
	    <td class="start14a" width="10%" ><span class="required">核准狀況：</span>&nbsp;</td>
		<td class="normal14a" width="23%">
		  <select id="ma016" onKeyPress="keyFunction()" name="ma016" " tabIndex="5">
            <option <?php if($ma016 == '1') echo 'selected="selected"';?> value='1'>已核准</option>                                                                        
		    <option <?php if($ma016 == '2') echo 'selected="selected"';?> value='2'>尚待核准</option>
            <option <?php if($ma016 == '3') echo 'selected="selected"';?> value='3'>不准交易</option>
		  </select></td>
		<td class="start14a"  width="10%">地區別：</td>
        <td class="normal14a"  width="23%" ><input type="text" tabIndex="6" id="ma007" onKeyPress="keyFunction()"   onBlur="startcmsq15a3(this)" name="ma007"   value="<?php echo  $ma007; ?>"     /><a href="javascript:;"><img id="Showcmsq15a3" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
		<span id="ma007disp"> <?php  echo $this->session->userdata('ma007disp');  ?><?php  if (!$this->session->userdata('ma007disp'))  echo $ma007disp; ?> </span></td>	
			
		<td class="normal14a"  width="10%" > TEL(一)：</td>
        <td class="normal14a"  width="24%" ><input tabIndex="7" id="ma008" onKeyPress="keyFunction()"   name="ma008" value="<?php echo $ma008; ?>" type="text"  /></td>
	
       
	</tr>	
		  
	  <tr>
	   <td class="start14a"  >國家別：</td>
        <td class="normal14" ><input type="text" tabIndex="8" id="ma006" onKeyPress="keyFunction()"   onBlur="startcmsq15a4(this)" name="ma006"   value="<?php echo  $ma006; ?>"    size="6"  /><a href="javascript:;"><img id="Showcmsq15a4" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
		<span id="ma006disp"> <?php  echo $this->session->userdata('ma006disp');  ?><?php  if (!$this->session->userdata('ma006disp'))  echo $ma006disp; ?> </span></td>
	    <td class="normal14" >TEL(二)：</td>
        <td class="normal14"  ><input tabIndex="9" id="ma009" onKeyPress="keyFunction()"   name="ma009" value="<?php echo $ma009; ?>" type="text"  /></td>
	
		<td class="start14a" >廠商分類：</td>
        <td class="normal14"  ><input tabIndex="10" id="ma004" onKeyPress="keyFunction()" name="ma004" onBlur="startcmsq15a9(this)"   value="<?php echo  $ma004; ?>"     type="text"  /><img id="Showcmsq15a9" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
        <span id="ma004disp"> <?php  echo $this->session->userdata('ma004disp');  ?><?php  if (!$this->session->userdata('ma004disp'))  echo $ma004disp; ?> </span></td>		    
				
	  </tr>
		
	  <tr>
	    <td  class="normal14" >傳真號碼：</td>
        <td  class="normal14"  ><input tabIndex="11" id="ma010" onKeyPress="keyFunction()"   name="ma010" value="<?php echo $ma010; ?>" type="text"  /></td>		   
	   <td  class="start14a">開業日期：</td>		
        <td  class="normal14"  ><input tabIndex="12"  id="datepicker3" onKeyPress="keyFunction()"   name="ma017" value="<?php echo $ma017; ?>" type="text"  /></td>
	     <td  class="normal14" >E-MAIL：</td>
             <td class="normal14"><input tabIndex="13" id="ma011" onKeyPress="keyFunction()"   name="ma011" value="<?php echo $ma011; ?>" type="text"  /></td>
	    
	  </tr>
	    <tr>
	    
	    <td class="normal14">資本額：</td>						
            <td  class="normal14"  ><input tabIndex="14" id="ma018" onKeyPress="keyFunction()" name="ma018"   value="<?php echo $ma018; ?>"  type="text"   /></td>
			 <td class="normal14" >負責人：</td>						
            <td  class="normal14"  ><input tabIndex="15" id="ma012" onKeyPress="keyFunction()" name="ma012"   value="<?php echo $ma012; ?>"   type="text" /></td>
		<td  class="normal14">員工人數：</td>						
        <td  class="normal14"  ><input tabIndex="16" id="ma019" onKeyPress="keyFunction()" name="ma019"   value="<?php echo $ma019; ?>"    type="text"  /></td>
	  </tr>	
		
	  <tr>
	     <td  class="normal14" >聯絡人(一)：</td>
             <td class="normal14"><input tabIndex="17" id="ma013" onKeyPress="keyFunction()"   name="ma013" value="<?php echo $ma013; ?>" type="text"  /></td>
	    <td class="start14a">交易幣別：</td>						
            <td  class="normal14"  ><input tabIndex="18" id="ma021" onKeyPress="keyFunction()" name="ma021" onBlur="startcmsq06a(this)"  value="<?php echo $ma021; ?>"  type="text"   /><img id="Showcmsq06a" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
              <span id="ma021disp"> <?php  echo $this->session->userdata('ma021disp');  ?><?php  if (!$this->session->userdata('ma021disp'))  echo $ma021disp; ?> </span></td>			
			<td class="normal14" >聯絡人(二)：</td>						
            <td  class="normal14"  ><input tabIndex="19" id="ma012" onKeyPress="keyFunction()" name="ma012"   value="<?php echo $ma012; ?>"   type="text" /></td>
	
	  </tr>
	  
	  <tr>
	    <td  class="start14a">稅額方式：</td>						
        <td  class="normal14"  ><input tabIndex="20" type="radio" name="ma053" <?php if (isset($ma053) && $ma053=="1") echo "checked";?> value="1" />整張計算  &nbsp;&nbsp;&nbsp; 
               <input type="radio" tabIndex="21" name="ma053" <?php if (isset($ma053) && $ma004=="2") echo "checked";?> value="2" />單身單筆計算</td>
	    <td class="normal14" >聯絡人(三)：</td>
        <td class="normal14"><input tabIndex="22" id="ma015" onKeyPress="keyFunction()" name="ma015"   value="<?php echo $ma015; ?>"   type="text" /></td>       
		   <td class="start14a">採購人員</td>
            <td class="normal14"><input tabIndex="23" id="ma047" onKeyPress="keyFunction()" name="ma047" onBlur="startcmsq09a4(this)"   value="<?php echo  $ma047; ?>"     type="text"  /><img id="Showcmsq09a4" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
        <span id="ma047disp"> <?php  echo $this->session->userdata('ma047disp');  ?><?php  if (!$this->session->userdata('ma047disp'))  echo $ma047disp; ?> </span></td>
			
	  </tr>
	  <tr>
	    <td class="normal14" >備註：</td>
        <td class="normal14"><input tabIndex="24" id="ma040" onKeyPress="keyFunction()" name="ma040"   value="<?php echo $ma040; ?>"   type="text" /></td>       
		   <td class="normal14"></td>
            <td class="normal14"></td>
			 <td class="normal14">&nbsp;&nbsp;</td>
            <td class="normal14"></td>
			
	  </tr>
		
	</table>
	</div>
	<div id="tab2" class="tab_content">
	<!--  <div id="tab-contact">   交易資料2 -->
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
	  $ma042=$this->input->post('ma042');
      $ma024=$this->input->post('ma024');	
      $ma025=$this->input->post('ma025');
      $ma041=$this->input->post('ma041');
      $ma026=$this->input->post('ma026');
      $ma043=$this->input->post('ma043');
      $ma027=$this->input->post('ma027');
      $ma028=$this->input->post('ma028');
      $ma034=$this->input->post('ma034');	
      $ma035=$this->input->post('ma035');	  
      $ma031=$this->input->post('ma031');	  
      $ma032=$this->input->post('ma032');	  
      $ma033=$this->input->post('ma033');	  
     
      
	  $ma025disp=$this->input->post('ma025');
      if($this->uri->segment(4) && $this->uri->segment(6)==8) { $ma025=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ma025', $ma025);$ma025 = $this->session->userdata('ma025'); }
      if($this->uri->segment(5) && $this->uri->segment(6)==8) { $ma025=urldecode(urldecode($this->uri->segment(5)));$ma025disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ma025disp', $ma025disp); $ma025disp = $this->session->userdata('ma025disp');} 
	  if ($this->session->userdata('ma025')) { $ma010= $this->session->userdata('ma025'); }	 

      $ma026disp=$this->input->post('ma026');
      if($this->uri->segment(4) && $this->uri->segment(6)==8) { $ma026=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ma026', $ma026);$ma026 = $this->session->userdata('ma026'); }
      if($this->uri->segment(5) && $this->uri->segment(6)==8) { $ma026=urldecode(urldecode($this->uri->segment(5)));$ma026disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ma026disp', $ma026disp); $ma026disp = $this->session->userdata('ma026disp');} 
	  if ($this->session->userdata('ma026')) { $ma026= $this->session->userdata('ma026'); }	 
      
	  $ma042disp=$this->input->post('ma042');
      if($this->uri->segment(4) && $this->uri->segment(6)==8) { $ma042=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ma042', $ma042);$ma042 = $this->session->userdata('ma042'); }
      if($this->uri->segment(5) && $this->uri->segment(6)==8) { $ma042=urldecode(urldecode($this->uri->segment(5)));$ma042disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ma042disp', $ma042disp); $ma042disp = $this->session->userdata('ma042disp');} 
	  if ($this->session->userdata('ma042')) { $ma026= $this->session->userdata('ma042'); }	 
      
	  $ma041disp=$this->input->post('ma041');
      if($this->uri->segment(4) && $this->uri->segment(6)==8) { $ma041=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ma041', $ma041);$ma041 = $this->session->userdata('ma041'); }
      if($this->uri->segment(5) && $this->uri->segment(6)==8) { $ma041=urldecode(urldecode($this->uri->segment(5)));$ma041disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ma041disp', $ma041disp); $ma041disp = $this->session->userdata('ma041disp');} 
	  if ($this->session->userdata('ma041')) { $ma041= $this->session->userdata('ma041'); }	 

      $ma043disp=$this->input->post('ma043');
      if($this->uri->segment(4) && $this->uri->segment(6)==8) { $ma043=urldecode(urldecode($this->uri->segment(4)));  $this->session->set_userdata('ma043', $ma041);$ma041 = $this->session->userdata('ma043'); }
      if($this->uri->segment(5) && $this->uri->segment(6)==8) { $ma043=urldecode(urldecode($this->uri->segment(5)));$ma043disp=urldecode(urldecode($this->uri->segment(5))); $this->session->set_userdata('ma043disp', $ma043disp); $ma043disp = $this->session->userdata('ma043disp');} 
	  if ($this->session->userdata('ma043')) { $ma041= $this->session->userdata('ma043'); }		  
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="start14a" width="10%" ><span class="required">採購單方式：</span>&nbsp;</td>
		<td class="normal14a" width="23%">
		  <select id="ma020" onKeyPress="keyFunction()" name="ma020" " tabIndex="25">
		    <option <?php if($ma016 == '2') echo 'selected="selected"';?> value='2'>FAX</option>
            <option <?php if($ma016 == '1') echo 'selected="selected"';?> value='1'>郵寄</option>
            <option <?php if($ma016 == '3') echo 'selected="selected"';?> value='3'>EDI</option>
			<option <?php if($ma016 == '4') echo 'selected="selected"';?> value='4'>E-MAIL</option>
		  </select></td>
		<td class="start14a"  width="10%">票據寄領：</td>
        <td class="normal14a"  width="23%" >
		  <select id="ma029" onKeyPress="keyFunction()" name="ma029" " tabIndex="26">
            <option <?php if($ma029 == '1') echo 'selected="selected"';?> value='1'>郵寄</option>                                                                        
		    <option <?php if($ma029 == '2') echo 'selected="selected"';?> value='2'>自領</option>
            <option <?php if($ma029 == '3') echo 'selected="selected"';?> value='3'>其它</option>			
		  </select>
		</td>
		<td class="normal14a"  width="12%" >可分批交貨：</td>
        <td class="normal14a"  width="22%" > <input tabIndex="27" id="ma045" onKeyPress="keyFunction()"  name="ma045" <?php if($ma045 == 'Y' ) echo 'checked';  ?>  <?php if($ma045 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  /></td>
		    <?php if($ma045 == '0')  $ma045="N";?><?php if($ma045 == '1')  $ma045="Y";?>
	
	</tr>	
		  
	  <tr>
	   <td class="start14a"  >隨貨附發票：</td>
        <td class="normal14" ><input tabIndex="28" id="ma056" onKeyPress="keyFunction()"  name="ma056" <?php if($ma056 == 'Y' ) echo 'checked';  ?>  <?php if($ma056 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  /></td>
		    <?php if($ma056 == '0')  $ma056="N";?> <?php if($ma056 == '1')  $ma056="Y";?>
	    <td class="normal14" >發票聯數：</td>
        <td class="normal14"  > <select id="ma029" onKeyPress="keyFunction()" name="ma030" " tabIndex="29">
            <option <?php if($ma030 == '1') echo 'selected="selected"';?> value='1'>二聯式發票</option>                                                                        
		    <option <?php if($ma030 == '2') echo 'selected="selected"';?> value='2'>三聯式發票</option>
            <option <?php if($ma030 == '3') echo 'selected="selected"';?> value='3'>二聯式收銀機發票</option>
            <option <?php if($ma030 == '4') echo 'selected="selected"';?> value='4'>三聯式收銀機發票</option>
            <option <?php if($ma030 == '5') echo 'selected="selected"';?> value='5'>電子計算機發票</option>
            <option <?php if($ma030 == '6') echo 'selected="selected"';?> value='6'>免用統一發票</option>
		  </select>
	
		<td class="start14a" >初次交易：</td>
        <td class="normal14"  ><input tabIndex="30" id="datepicker1" onKeyPress="keyFunction()" type="text" name="ma022"    value="<?php echo $ma022; ?>"   /></td>	    
				
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
        <td  class="normal14"  ><input tabIndex="32"  id="datepicker2" onKeyPress="keyFunction()" type="text" name="ma023"    value="<?php echo $ma023; ?>"   /></td>	
	     <td  class="normal14" >加工費用科目：</td>
             <td class="normal14"><input tabIndex="33" id="ma042" onKeyPress="keyFunction()" name="ma042" onBlur="startactq03a1(this)"   value="<?php echo  $ma042; ?>"     type="text"  /><img id="Showactq03a1" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
        <span id="ma042disp"> <?php  echo $this->session->userdata('ma042disp');  ?><?php  if (!$this->session->userdata('ma042disp'))  echo $ma042disp; ?> </span></td>
	    
	  </tr>
	    <tr>
	    
	    <td class="normal14">付款方式：</td>						
            <td  class="normal14"  ><select id="ma024" onKeyPress="keyFunction()" name="ma024" " tabIndex="34">
            <option <?php if($ma024 == '1') echo 'selected="selected"';?> value='1'>現金</option>                                                                        
		    <option <?php if($ma024 == '2') echo 'selected="selected"';?> value='2'>電匯</option>
            <option <?php if($ma024 == '3') echo 'selected="selected"';?> value='3'>支票</option>
		    <option <?php if($ma024 == '4') echo 'selected="selected"';?> value='4'>其他</option>
		  </select>
			 <td class="normal14" >付款條件：</td>						
            <td  class="normal14"  ><input tabIndex="35" id="ma025" onKeyPress="keyFunction()" name="ma025" onBlur="startcmsq21a1(this)"   value="<?php echo  $ma025; ?>"     type="text"  /><img id="Showcmsq21a1" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
        <span id="ma025disp"> <?php  echo $this->session->userdata('ma025disp');  ?><?php  if (!$this->session->userdata('ma025disp'))  echo $ma025disp; ?> </span></td>
		<td  class="normal14">應付帳款科目：</td>						
        <td  class="normal14"  ><input tabIndex="36" id="ma041" onKeyPress="keyFunction()" name="ma041" onBlur="startactq03a2(this)"   value="<?php echo  $ma041; ?>"     type="text"  /><img id="Showactq03a2" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
        <span id="ma041disp"> <?php  echo $this->session->userdata('ma041disp');  ?><?php  if (!$this->session->userdata('ma041disp'))  echo $ma041disp; ?> </span></td>
	  </tr>	
		
	  <tr>
	     <td  class="normal14" >價格條件：</td>
             <td class="normal14"><input tabIndex="37" id="ma026" onKeyPress="keyFunction()"   name="ma026" value="<?php echo $ma026; ?>" type="text"  /></td>
	    <td class="normal14">應付票據科目：</td>						
            <td  class="normal14"  ><input tabIndex="38" id="ma043" onKeyPress="keyFunction()" name="ma043" onBlur="startactq03a3(this)"   value="<?php echo  $ma043; ?>"     type="text"  /><img id="Showactq03a3" src="<?=base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
        <span id="ma043disp"> <?php  echo $this->session->userdata('ma043disp');  ?><?php  if (!$this->session->userdata('ma043disp'))  echo $ma043disp; ?> </span></td>
			 <td class="normal14" >匯款銀行：</td>						
            <td  class="normal14"  ><input tabIndex="39" id="ma027" onKeyPress="keyFunction()" name="ma027"   value="<?php echo $ma027; ?>"   type="text" /></td>
	
	  </tr>
	  
	  <tr>
	    <td  class="start14a">匯款帳號：</td>						
        <td  class="normal14"  ><input tabIndex="40" id="ma028" onKeyPress="keyFunction()" name="ma028"   value="<?php echo $ma028; ?>"   type="text" /></td>
	    <td class="normal14" >結帳日驗收後：</td>
        <td class="normal14"><input tabIndex="41" id="ma034" onKeyPress="keyFunction()" name="ma034"   value="<?php echo $ma034; ?>"   type="text" /></td>       
		   <td class="start14a">個月逢</td>
            <td class="normal14"><input tabIndex="42" id="ma035" onKeyPress="keyFunction()" name="ma035"   value="<?php echo $ma035; ?>"   type="text" /></td> 
			
	  </tr>
	  <tr>
	    <td class="normal14" >ABC等級：</td>
        <td class="normal14"><input tabIndex="43" id="ma031" onKeyPress="keyFunction()" name="ma031"   value="<?php echo $ma031; ?>"   type="text" /></td>       
		   <td class="normal14">交貨評等：</td>
            <td class="normal14"><input tabIndex="44" id="ma032" onKeyPress="keyFunction()" name="ma032"   value="<?php echo $ma032; ?>"   type="text" /></td>
			 <td class="normal14">品質評等：</td>
            <td class="normal14"><input tabIndex="45" id="ma033" onKeyPress="keyFunction()" name="ma033"   value="<?php echo $ma033; ?>"   type="text" /></td>
			
	  </tr>
		
	</table>
	</div>		  
     <div id="tab3" class="tab_content">
     <!--  <div id="tab-contact">   地址 3 -->
	<?php
	  $date=date("Ymd");
	  $ma046=$this->input->post('ma046');
	  $ma048=$this->input->post('ma048');
	  $ma049=$this->input->post('ma049');
	  $ma050=$this->input->post('ma050');
	  $ma051=$this->input->post('ma051');
	  $ma052=$this->input->post('ma052');	
	    
    
	?>
   
	<table class="form12">     <!-- 表格 -->
	  <tr>
	    <td class="normal12a"  width="10%"> 郵遞區號(一)：</td>
        <td class="normal12a"  width="90%"><input tabIndex="46" id="ma046" onKeyPress="keyFunction()" name="ma046" value="<?php echo $ma046; ?>"  type="text"  /></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal12" > 聯絡地址(一)：</td>
        <td class="normal12" ><input tabIndex="47" id="ma048" onKeyPress="keyFunction()" name="ma048" value="<?php echo $ma048; ?>" size="80" type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal12" > 聯絡地址(二)：</td>
        <td class="normal12" ><input tabIndex="48" id="ma049" onKeyPress="keyFunction()" name="ma049" value="<?php echo $ma049; ?>" size="80" type="text"  /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal12" > 郵遞區號(二)：</td>
        <td class="normal12" ><input tabIndex="49" id="ma050" onKeyPress="keyFunction()" name="ma050" value="<?php echo $ma050; ?>"  type="text"  /></td>
	  </tr>	
	  <tr>
	    <td class="normal12" > 帳單地址(一)：</td>
        <td class="normal12" ><input tabIndex="50" id="ma051" onKeyPress="keyFunction()" name="ma051" value="<?php echo $ma051; ?>" size="80" type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal12" > 帳單地址(二)：</td>
        <td class="normal12" ><input tabIndex="51" id="ma052" onKeyPress="keyFunction()" name="ma052" value="<?php echo $ma052; ?>" size="80" type="text"  /></td>
	  </tr>	
	  
	    
	  <tr>
	    
		<td class="normal12">&nbsp;&nbsp;</td>
        <td class="normal12"></td>
	  </tr>
		
	</table>	 
     </div>
	 
	
	 
	</div>
	<div class="buttons">
	<button tabIndex="8" type='submit'  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pur/puri01/display'); ?>" class="button" ><span>取 消&nbsp;F9</span></a>
	</div> 
	  
    </form>
    </div> 
	
  </div>
</div>

  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> 
  </div> 
   </div> 
    
	<script type="text/javascript"> 	   //開視窗 一定要寫 3 地區
	$(document).ready(function(){
	$("#Showcmsq15a3").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divForm3'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	  
	<div id="divForm3" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/cms/cmsq15a/display3" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addcmsq15a3(sma001,sma002) {	
	form.ma007.value=sma001;
	var oSpan = document.getElementById("ma007disp");
		oSpan.innerHTML = sma002;
	document.form.ma007.focus();    
	return ma007;	
}
//--></script>
	
	
<script type="text/javascript"> 	   //開視窗 一定要寫 4 國家
	$(document).ready(function(){ 	   
	$("#Showcmsq15a4").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divForm4'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divForm4" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/cms/cmsq15a/display4" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq15a4(sma001,sma002) {
	    form.ma006.value=sma001;
	var oSpan = document.getElementById("ma006disp");
		oSpan.innerHTML = sma002;
	document.form.ma006.focus();    
	return ma006;
	
}
//--></script>

<script type="text/javascript"> 	   //開視窗 一定要寫 9 廠商分類
	$(document).ready(function(){ 	   
	$("#Showcmsq15a9").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divForm9'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divForm9" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/cms/cmsq15a/display9" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq15a9(sma001,sma002) {
	  form.ma004.value=sma001;
	var oSpan = document.getElementById("ma004disp");
		oSpan.innerHTML = sma002;
	document.form.ma004.focus();    
	return ma004;
	
}
//--></script>

<script type="text/javascript"> 	   //開視窗 一定要寫 cmsq09a4 採購人員
	$(document).ready(function(){ 	   
	$("#Showcmsq09a4").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divFormcmsq09a4'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFormcmsq09a4" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/cms/cmsq09a/display3" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>

<script type="text/javascript"><!--
  function addOrder41(sma001,sma002) {
	form.ma047.value=sma001;	
	var oSpan = document.getElementById("ma047disp");
		oSpan.innerHTML = sma002;	
	document.form.ma047.focus();    
	return ma047;
}
//--></script>

<script type="text/javascript"> 	   //開視窗 一定要寫 42 加工科目
	$(document).ready(function(){ 	   
	$("#Showactq03a1").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divForm6'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divForm6" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/act/actq03a/display1" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addactq03a1(sma001,sma002) {
	form.ma042.value=sma001;
	var oSpan = document.getElementById("ma042disp");
		oSpan.innerHTML = sma002;	
	document.form.ma042.focus();    
	return ma042;
}
//--></script>

<script type="text/javascript"> 	   //開視窗 一定要寫 41 應付帳款別
    
	$(document).ready(function(){ 	   
	$("#Showactq03a2").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divForm7'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 
    
</script> 	    	
		   
	<div id="divForm7" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/act/actq03a/display2" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addactq03a2(sma001,sma002) {
	form.ma041.value=sma001;
	var oSpan = document.getElementById("ma041disp");
		oSpan.innerHTML = sma002;	
	document.form.ma041.focus();    
	return ma041;
}
//--></script>

<script type="text/javascript"> 	   //開視窗 一定要寫 43 應付票據
	$(document).ready(function(){ 	   
	$("#Showactq03a3").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divForm8'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
</script> 	    	
		   
	<div id="divForm8" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/act/actq03a/display3" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addactq03a3(sma001,sma002) {
	form.ma043.value=sma001;
	
	var oSpan = document.getElementById("ma043");
		oSpan.innerHTML = sma002;	
	document.form.ma043.focus();    
	return ma043;
	
}
//--></script>
<script type="text/javascript"> 	   //開視窗 一定要寫 25 付款條件
	$(document).ready(function(){ 	   
	$("#Showcmsq21a1").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divForm21'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divForm21" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/cms/cmsq21a/display1" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq21a1(sma001,sma002) {
	form.ma025.value=sma001;
	var oSpan = document.getElementById("ma025disp");
		oSpan.innerHTML = sma002;	
	document.form.ma025.focus();    
	return ma025;
}
//--></script>

<script type="text/javascript"> 	   //開視窗 一定要寫 18 交易幣別
	$(document).ready(function(){ 	   
	$("#Showcmsq06a").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divForm06'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divForm06" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/cms/cmsq06a/display" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq06a(sma001,sma002) {
	form.ma021.value=sma001;
	var oSpan = document.getElementById("ma021disp");
		oSpan.innerHTML = sma002;	
	document.form.ma021.focus();    
	return ma021;
}
//--></script>
<script language="javascript"   >   //不更新網頁, 帶出資料
 
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁 判斷適用各種流覽器 共用 (全域)
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
}


function showcmsq15a3(sText){                 //不更新網頁 3 地區    
	var oSpan = document.getElementById("ma007disp");	
	   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}


function startcmsq15a3(oInput){            //不更新網頁 3  地區
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma007disp").html("<span style='color:red'>欄位不可空白.</span>");			
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/pur/puri01/datacmsq15a3/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq15a3(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showcmsq15a4(sText){   //不更新網頁 4  國家
	var oSpan = document.getElementById("ma006disp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}


function startcmsq15a4(oInput){         //不更新網頁 4 國家
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/pur/puri01/datacmsq15a4/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq15a4(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showcmsq15a9(sText){   //不更新網頁 9  廠商分類
	var oSpan = document.getElementById("ma004disp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}


function startcmsq15a9(oInput){         //不更新網頁 9 廠商分類
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/pur/puri01/datacmsq15a9/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq15a9(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showcmsq09a4(sText){   //不更新網頁 4  採購人員
	var oSpan = document.getElementById("ma047disp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}


function startcmsq09a4(oInput){         //不更新網頁 4  採購人員
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/pur/puri01/datacmsq09a4/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq09a4(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showpurq01a(sText){   //不更新網頁 5  廠商 檢查資料重複
	var oSpan = document.getElementById("ma001disp");
		oSpan.innerHTML = sText;		
	 if (!sText) { 
	   $("#ma001disp").html("廠商可使用!");
	   oSpan.style.color = "blank";
	 }	 
	  if (sText) { 
	   $("#ma001disp").html("廠商重複!");
	   oSpan.style.color = "red";
	   document.getElementById("ma001").focus();
	 } 
}

function startpurq01a(oInput){         //不更新網頁 5 廠商
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
 	if(!oInput.value){
		oInput.focus();    //聚焦到用戶名的輸入框
		$("#ma001disp").html("<span style='color:red'>欄位不可空白.</span>");
		return;
	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/pur/puri01/checkdata5/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showpurq01a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showcmsq21a1(sText){   //不更新網頁 6  付款條件 檢查資料重複
	var oSpan = document.getElementById("ma025disp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

function startcmsq21a1(oInput){         //不更新網頁 6 付款條件
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/pur/puri01/checkcmsq21a1/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq21a1(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showcmsq06a(sText){   //不更新網頁 18  交易幣別 檢查資料重複
	var oSpan = document.getElementById("ma018disp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

function startcms06a(oInput){         //不更新網頁 18 交易幣別
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/pur/puri01/checkcms06a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcms06a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showResult8(sText){   //不更新網頁 8  途程廠商 檢查資料重複
	var oSpan = document.getElementById("ma010disp");
		oSpan.innerHTML = sText;
      document.getElementById("ma011").value = sText;
      $('input[name=\'ma011\']').attr('value') = sText;
	  
	  oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

function startCheck8(oInput){         //不更新網頁  8  途程廠商
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/pur/puri01/checkdata8/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showResult8(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showResult21(sText){   //不更新網頁 21  計劃人員 檢查資料重複
	var oSpan = document.getElementById("ma018disp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

function startCheck21(oInput){         //不更新網頁 21  計劃人員
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/pur/puri01/checkdata21/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showResult21(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}


</script>

 <script type="text/javascript"><!--       //檢查欄位空白
 function checkspace2(oInput){         //不更新網頁 2 商品
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	if(!oInput.value){
		oInput.focus();    //聚焦到用戶名的輸入框
		$("#ma002disp").html("<span style='color:red'>不可空白.</span>");	
		return;
	}
	 
}

//--></script> 	
 
<script type="text/javascript"><!-- 	// enterkey 測試   
	$(document).ready(function(){ 	   
//	$('#ma001').focus(); 	   
	Enterkey(); 	   
	}); 	   
//--></script> 	   
		   
<script type="text/javascript"><!-- 	// enterkey 測試    
	function Enterkey() { 	   
	$("input").not( $(":button") ).keypress(function (evt) { 	   
	if (evt.keyCode == 13) { 	   
	if ($(this).attr("type") !== 'submit'){ 	   
	var fields = $(this).parents('form:eq(0),body').find('button, input, textarea'); 	   
	var index = fields.index( this ); 	   
	if ( index > -1 && ( index + 1 ) < fields.length ) { 	   
	fields.eq( index + 1 ).focus(); 	   
	} 	   
	$(this).blur(); 	   
	return false; 	   
	} 	   
	} 	   
	}); 	   
	} 	   
//--></script> 	 
