<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content">  <!-- div-3 -->
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 品號基本資料建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#mb001').focus();" type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	<a accesskey="x" id='cancel' name='cancel' href="<?php echo site_url('inv/invi02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
	
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/inv/invi02/addsave" >	
	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Ymd");
	  if(!isset($mb001)) { $mb001=$this->input->post('mb001'); }
	  if(!isset($mb004)) { $mb004=$this->input->post('mb004'); }
	  $mb013=$this->input->post('mb013');
      $mb064=$this->input->post('mb064');
	  $mb002=$this->input->post('mb002');
      $mb072=$this->input->post('mb072');	  
      $mb065=$this->input->post('mb065');
      $mb003=$this->input->post('mb003');		
      $mb091=$this->input->post('mb091');
	  $mb999=$this->input->post('mb999');
      $mb080=$this->input->post('mb080');
      $mb081=$this->input->post('mb081');	
      $mb090=$this->input->post('mb090'); 
      $mb089=$this->input->post('mb089'); 
	  $mb201=$this->input->post('mb201'); 
	  $mb202=$this->input->post('mb202'); 
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="8%"><span class="required">品號：</span> </td>
        <td class="normal14a"  width="18%"><input type="text" tabIndex="1" id="mb001"  onKeyPress="keyFunction()"  onchange="startkey(this)"  name="mb001" value="<?php echo $mb001; ?>" size="20"  required />
		 <span id="keydisp" ></span></td>
	    <td class="normal14y" width="7%" >單位： </td>
        <td class="normal14a"  width="12%" ><input type="text" tabIndex="2" id="mb004" onKeyPress="keyFunction()" name="mb004"  value="<?php echo  $mb004; ?>"    size="4"  required />
		 <a href="javascript:;"><img id="Showinvi81a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="invi81adisp"> <?php //echo $invi81adisp; ?> </span></td>
	    <td class="normal14y"  width="8%">庫存數量：</td>
        <td class="normal14a"  width="10%" ><input type="text" tabIndex="3" readonly="value" id="mb064"  onKeyPress="keyFunction()" name="mb064"   value="<?php echo  $mb064; ?>"    size="8"  style="background-color:#F5F5F5"  /></td>
		<td class="normal14y" width="8%">庫存金額：</td>
        <td class="normal14a" width="10%" ><input type="text" tabIndex="4" readonly="value" id="mb065" onKeyPress="keyFunction()" name="mb065"   value="<?php echo  $mb065; ?>"    size="8"  style="background-color:#F5F5F5"  /></td>	
        <td class="normal14y" width="8%">單位成本：</td>						
        <td  class="normal14a"  width="11%"  ><input type="text" tabIndex="5" readonly="value" id="mb999" onKeyPress="keyFunction()" name="mb999"   value="<?php echo $mb999; ?>"  size="8" style="background-color:#F5F5F5"  /></td>	 
	 </tr>	
		  
	  <tr>
	    <td class="normal14z" >品名： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="mb002" onKeyPress="keyFunction()" onchange="checkspace(this)" name="mb002" value="<?php echo $mb002; ?>" size="30"  required /><span id="spacedisp" ></span></td>
		<td  class="normal14z" >條碼編號：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="mb013" onKeyPress="keyFunction()" name="mb013"  value="<?php echo $mb013; ?>"  size="20"   /></td>
		<td class="normal14z" >包裝單位：</td>						
        <td  class="normal14"  ><input  type="text" tabIndex="8" readonly="value" id="mb090" onKeyPress="keyFunction()" name="mb090"   value="<?php echo $mb090; ?>"  size="4"  style="background-color:#F5F5F5"  /></td>
	    <td class="normal14z"  >包裝數量：</td>
        <td class="normal14" ><input type="text" tabIndex="9" readonly="value" onKeyPress="keyFunction()" id="mb089" name="mb089"  value="<?php echo $mb089; ?>" size="8" style="background-color:#F5F5F5"  /></td>	
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	  <tr>
	    <td  class="normal14z" >規格：</td>
        <td  class="normal14"  ><input type="text" tabIndex="10" id="mb003" onKeyPress="keyFunction()" name="mb003"  value="<?php echo $mb003; ?>"  size="30"   /></td>
	    <td class="normal14z" >小單位：</td>
        <td class="normal14"  ><input type="text" readonly="value" tabIndex="11" id="mb072" onKeyPress="keyFunction()" name="mb072"   value="<?php echo  $mb072; ?>"    size="4" style="background-color:#F5F5F5"  /></td>
		<td class="normal14z">定重：</td>						
        <td  class="normal14"  ><input type="text" readonly="value" tabIndex="12" id="mb091" onKeyPress="keyFunction()" name="mb091"   value="<?php echo $mb091; ?>"  size="1" type="text"  style="background-color:#F5F5F5"  /></td>
        <td class="normal14z">ZIZE：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="13" id="mb081" onKeyPress="keyFunction()" name="mb081"   value="<?php echo $mb081; ?>"  size="4"  /></td>			
		<td class="normal14z">顏色</td>
        <td class="normal14"><input type="text" tabIndex="13" id="mb201" onKeyPress="keyFunction()" name="mb201"   value="<?php echo $mb201; ?>"  size="8"  /></td>	
	  </tr>
	  
	  <tr>
	    <td  class="normal14z" >使用門市：</td>
        <td rowspan="4"  colspan="8" class="normal14"  ><input type="text" tabIndex="10" id="mb202" onKeyPress="keyFunction()" name="mb202"  value="<?php echo $mb202; ?>"  size="100"   /><span > <?php echo '輸入範例:不同門市代號用逗號,隔開'; ?> </span></td>
		<td  class="normal14" ></td>
        <td rowspan="4"  colspan="1" class="normal14"  ></td>
	  </tr>
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
			<li><a href="#tab1"  accesskey="a" >基本資料a</a></li>
			<li><a href="#tab2"  accesskey="b">基本資料b</a></li>
			<li><a href="#tab3"  accesskey="c">採購生管c</a></li>
			<li><a href="#tab4"  accesskey="g">售價Alt+g</a></li>
			<li><a href="#tab5"  accesskey="h">成本Alt+h</a></li>
			<li><a href="#tab6"  accesskey="i">標準包裝i</a></li>
		</ul>
		
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  基本資料1 -->
	<div id="tab1" class="tab_content">
	<?php
	  $date=date("Ymd");
	  $mb066=$this->input->post('mb066');
	  $mb005=$this->input->post('invi01a');
	  $mb006=$this->input->post('invi01b');
	  $mb007=$this->input->post('invi01c');
	  $mb008=$this->input->post('invi01d');
	  $invi01a=$this->input->post('invi01a');
	  $invi01b=$this->input->post('invi01b');
	  $invi01c=$this->input->post('invi01c');
	  $invi01d=$this->input->post('invi01d');
	//  $mb017=$this->input->post('cmsq03a');	
	  $mb068=$this->input->post('cmsi04');	
	  $mb018=$this->input->post('cmsi09a');
	  $cmsi09a=$this->input->post('cmsi09a');
      $mb012=$this->input->post('mb012');
      $mb013=$this->input->post('mb013');		  
      $mb009=$this->input->post('mb009');
	   if(!isset($mb017)) { $mb017=$this->session->userdata('sysma203'); }
	  $invi01adisp=$this->input->post('invi01a');  //類別1會計
      $invi01bdisp=$this->input->post('invi01b'); //類別1商品
	  $invi01cdisp=$this->input->post('invi01c'); //類別1類別
	  $invi01ddisp=$this->input->post('invi01d'); //類別1生管
	  $cmsi03=$this->input->post('cmsi03');   //主要庫別
	  $cmsi04=$this->input->post('cmsi04');   //生產線別
	  $cmsi03disp=$this->input->post('cmsi03');   //主要庫別
	  $cmsi04disp=$this->input->post('cmsi04');   //生產線別
	  $cmsi09bdisp=$this->input->post('cmsi09bdisp');  //計劃人員
	  $cmsi09adisp=$this->input->post('cmsi09adisp');
	  $mb200=$this->input->post('mb200');            //產品圖片路徑檔名
	   if(!isset($userfile)) { $userfile=$this->input->post('userfile'); }
	  //$userfile=$this->input->post('userfile');
	  $imgdisp='';
	  if(!isset($userfile)) { $userfile='image.jpg'; }
	  $uploadfile='image.jpg';
	?>
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	    <td class="normal14y" width="9%" >會計：</td>
        <td class="normal14a"  width="15%" ><input type="text" tabIndex="9" id="invi01a" class="invi01a" onKeyPress="keyFunction()"   onchange="startinvi01a(this)" name="invi01a"   value="<?php echo  trim($invi01a); ?>"    size="6"  required />
		<a href="javascript:;"><img id="Showinvi01adisp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="invi01adisp"> <?php  echo $invi01adisp; ?> </span></td>	
		<td class="normal14y"  width="9%">商品：</td>
        <td class="normal14a"  width="16%" ><input type="text" tabIndex="10" id="invi01b" class="invi01b" onKeyPress="keyFunction()"   onchange="startinvi01b(this)" name="invi01b"   value="<?php echo  $invi01b; ?>"    size="6"  />
		<a href="javascript:;"><img id="Showinvi01bdisp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
	     <span id="invi01bdisp"><?php  echo $invi01bdisp; ?> </span></td>
		<td class="normal14y"  width="9%" > 類別：</td>
        <td class="normal14a"  width="16%" ><input type="text" tabIndex="11" id="invi01c" class="invi01c" onKeyPress="keyFunction()"  onchange="startinvi01c(this)" name="invi01c" value="<?php echo $invi01c; ?>" size="6"   />
		<a href="javascript:;"><img id="Showinvi01cdisp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="invi01cdisp"><?php   echo $invi01cdisp; ?> </span></td>	
		<td class="normal14y"  width="9%">改品規：</td>	
        <td class="normal14a"  width="17%"><input type="hidden" name="mb066" value="N" />
		<input tabIndex="12" type="checkbox"  id="mb066" onKeyPress="keyFunction()"   name="mb066" <?php if($mb066 == 'Y' ) echo 'checked'; ?>  <?php if($mb066 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	  </tr>	
		  
	   <tr>
	    <td class="normal14z" >生管：</td>
        <td class="normal14"  ><input type="text" tabIndex="13" id="invi01d" class="invi01d" onKeyPress="keyFunction()" onchange="startinvi01d(this)" name="invi01d"  value="<?php echo  $invi01d; ?>"    size="6"   />
		<a href="javascript:;"><img id="Showinvi01ddisp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="invi01ddisp"> <?php  echo  $invi01ddisp; ?> </span></td>	
		<td class="normal14z" >主要庫別：</td>             <!--   onchange="check_cmsi03(this)"   onchange="startcmsq03a(this)"   -->
		 <td class="normal14"  ><input  type="text"  tabIndex="14" id="cmsi03" class="cmsi03" onKeyPress="keyFunction()" name="cmsi03"  onchange="check_cmsi03(this)"  value="<?php echo  $cmsi03; ?>"     size="10"    />
		 <a href="javascript:;"><img id="Showcmsi03disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
         <span id="cmsi03disp"><?php  echo $cmsi03disp; ?></span></td> 	    
		<td  class="normal14z" >生產線別：</td>    
        <td  class="normal14"  ><input type="text" tabIndex="15" id="cmsi04" class="cmsi04" onKeyPress="keyFunction()" name="cmsi04" onchange="check_cmsi04(this)"  value="<?php echo $cmsi04; ?>"  size="10"   />
		<a href="javascript:;"><img id="Showcmsi04disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
         <span id="cmsi04disp"><?php  echo $cmsi04disp; ?></span></td>		   
	    <td  class="normal14z">計劃人員：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="16" id="cmsi09a" class="cmsi09a" onKeyPress="keyFunction()" name="cmsi09a" onchange="check_cmsi09a(this)" value="<?php echo $cmsi09a; ?>"  size="10"    />
		<img id="Showcmsi09adisp" src="<?php echo base_url()?>assets/image/png/plan.png" alt="" align="top"/></a>		
	     <span id="cmsi09adisp"> <?php   echo $cmsi09adisp; ?> </span></td>	
	  </tr>
		
	  <tr>
	     <td  class="normal14z">文管代號：</td>						
         <td  class="normal14"  ><input tabIndex="24" id="mb012" onKeyPress="keyFunction()" name="mb012"   value="<?php echo $mb012; ?>"  size="10"  type="text"  /></td>
	    <td colspan="1" class="normal14z" >商品描述：</td>
        <td colspan="3"  class="normal14"><textarea  tabIndex="25" rows="6" cols="40" name="mb009" id="mb009" Wrap="Physical" ></textarea></td>	
		<td class="normal14z">選擇產品圖片.jpg：</td>
        <td class="normal14"><input type="file" name="userfile"  tabIndex="26" id="mb200"  onKeyPress="keyFunction()"  value="<?php echo $userfile; ?>"  size="30" onchange="pre_pic(this);" /></td>
		<td class="normal14"><input type="hidden" name="MAX_FILE_SIZE" value="2000000"></td>
        <td class="normal14"></td>
	  </tr>
	   <tr>
	     <td colspan="1" class="normal14z">產品圖片:</td>						
         <td colspan="3" class="normal14"  ><img src="<?php echo base_url();?>assets/image/jpg/<?php echo $uploadfile;?>" style="padding-top:5px"  id="ad" width="60" height="60" border="0" style="padding:5px"/></td>
			
		<td class="normal14"></td>
        <td class="normal14"></td>
	  </tr>
	</table>
	</div>
	
	<!-- 基本資料2 -->
	<div id="tab2" class="tab_content">
	<?php
	  $date=date("Ymd");
	  $mb080=$this->input->post('mb080');
	  $mb025=$this->input->post('mb025');
	  $mb019=$this->input->post('mb019');
	  $mb020=$this->input->post('mb020');
	  $mb026=$this->input->post('mb026');
	  $mb021=$this->input->post('mb021');	
	  $mb027=$this->input->post('mb027');	
	  $mb022=$this->input->post('mb022');
      $mb028=$this->input->post('mb028');	
      $mb023=$this->input->post('mb023');
      $mb024=$this->input->post('mb024');
      $mb029=$this->input->post('mb029');
      $mb083=$this->input->post('mb083');
      $mb084=$this->input->post('mb084');
      $mb030=$this->input->post('mb030');
      $mb031=$this->input->post('mb031');	
      $mb085=$this->input->post('mb085');	  
      $mb086=$this->input->post('mb086');	  
      $mb011=$this->input->post('bomi07');	  //途程品號
	  $bomi07=$this->input->post('bomi07');	  //途程品號
      $mb044=$this->input->post('mb044');	  
      $mb045=$this->input->post('mb045');	   
      $bomi07disp=$this->input->post('bomi07disp');
	  $bomi07adisp=$this->input->post('bomi07');
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y"   width="10%"> 貨號：</td>
        <td class="normal14a"  width="16%"><input tabIndex="26" id="mb080" onKeyPress="keyFunction()" name="mb080" value="<?php echo $mb080; ?>" size="20" type="text"  /></td>
	    <td class="normal14y" width="8%" >品號屬性：</td>
        <td class="normal14a"  width="23%" >
		  <select tabIndex="27" id="mb025" onKeyPress="keyFunction()" name="mb025" >
            <option <?php if($mb025 == 'P') echo 'selected="selected"';?> value='P'>採購件 </option>                                                                        
		    <option <?php if($mb025 == 'M') echo 'selected="selected"';?> value='M'>自製件 </option>
            <option <?php if($mb025 == 'S') echo 'selected="selected"';?> value='S'>託外加工件 </option>
            <option <?php if($mb025 == 'Y') echo 'selected="selected"';?> value='Y'>虛設品號 </option>
		  </select>
		</td>
	    <td class="normal14y" width="8%" >庫存管理：</td>
        <td class="normal14a"  width="13%" ><input type="hidden" name="mb019" value="N" />
		  <input tabIndex="28" id="mb019" onKeyPress="keyFunction()" name="mb019" <?php if($mb019 == 'Y' ) echo 'checked'; ?>  <?php if($mb019 !== 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td>		
		<td class="normal14y" width="8%">保稅品：</td>
        <td class="normal14a" width="14%" ><input type="hidden" name="mb020" value="N" />
		  <input tabIndex="29" id="mb020" onKeyPress="keyFunction()" name="mb020" <?php if($mb020 == 'Y' ) echo 'checked'; ?>  <?php if($mb020 !== 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" > 循環盤點碼：</td>
        <td class="normal14" ><input tabIndex="30" id="mb021" onKeyPress="keyFunction()" name="mb021" value="<?php echo $mb021; ?>" size="4" type="text"  /></td>
		<td class="normal14z">批號管理：</td>						
        <td  class="normal14"  >
		  <select id="mb022" onKeyPress="keyFunction()" name="mb022" " tabIndex="31">
            <option <?php if($mb022 == 'N') echo 'selected="selected"';?> value='N'>不需要</option>                                                                        
		    <option <?php if($mb022 == 'Y') echo 'selected="selected"';?> value='Y'>需要不檢查庫存量</option>
            <option <?php if($mb022 == 'W') echo 'selected="selected"';?> value='W'>僅需警告</option>
            <option <?php if($mb022 == 'T') echo 'selected="selected"';?> value='T'>需要且檢查庫存量</option>
		  </select>
		</td>
		<td  class="normal14z" >ABC等級：</td>
        <td  class="normal14"  ><input tabIndex="32" id="mb027" onKeyPress="keyFunction()" name="mb027"  value="<?php echo strtoupper($mb027); ?>"  size="1" type="text"   /></td>
	    <td class="normal14z" >備註：</td>
        <td class="normal14" ><input tabIndex="33"  id="mb028" onKeyPress="keyFunction()"  name="mb028"  value="<?php echo $mb028; ?>" type="text" /></td>
	  </tr>
		
	  <tr>
	    <td class="normal14z">有效天數：</td>
        <td class="normal14"><input tabIndex="34" id="mb023"  onKeyPress="keyFunction()"  name="mb023"  value="<?php echo $mb023; ?>"  type="text"  /></td>	
	    <td class="normal14z" > 複檢天數：</td>
        <td class="normal14" ><input tabIndex="35" id="mb024" onKeyPress="keyFunction()" name="mb024" value="<?php echo $mb024; ?>" size="4" type="text"  /></td>
	    <td  class="normal14z" >產品圖號：</td>
        <td  class="normal14"  ><input tabIndex="36" id="mb029" onKeyPress="keyFunction()" name="mb029"  value="<?php echo $mb029; ?>"  size="20" type="text"   /></td>
		<td class="normal14z">進價管制：</td>
		<td class="normal14"  ><input type="hidden" name="mb083" value="N" />
		<input tabIndex="37" id="mb083" onKeyPress="keyFunction()" name="mb083" <?php if($mb083 == 'Y' ) echo 'checked'; ?>  <?php if($mb083 !== 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >單價上限率：</td>
        <td class="normal14" ><input tabIndex="38"  id="mb084" onKeyPress="keyFunction()"  name="mb084"  value="<?php echo $mb084; ?>" size="9" type="text" /></td>	
		<td class="normal14z">生效日期：</td>
        <td class="normal14"><input tabIndex="39" id="mb030" readonly="value" onKeyPress="keyFunction()" onfocus="this.select()" ondblclick="scwShow(this,event);" name="mb030"  value="<?php echo $mb030; ?>" size="8" type="text"   style="background-color:#E7EFEF"  /></td>
	    <td class="normal14z" >失效日期：</td>
        <td class="normal14" ><input tabIndex="40" id="mb031" readonly="value" onKeyPress="keyFunction()" onfocus="this.select()" ondblclick="scwShow(this,event);" name="mb031" value="<?php echo $mb031; ?>" size="8" type="text"    style="background-color:#E7EFEF"   /></td>
	    <td  class="normal14z" >售價管制：</td>
        <td class="normal14"  ><input type="hidden" name="mb085" value="N" />
		<input type='checkbox' tabIndex="41" id="mb085" onKeyPress="keyFunction()" name="mb085" <?php if($mb085 == 'Y' ) echo 'checked'; ?>  <?php if($mb085 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z">單價下限率：</td>						
        <td class="normal14" ><input tabIndex="42"  id="mb086" onKeyPress="keyFunction()"  name="mb086"  value="<?php echo $mb086; ?>" size="9" type="text" /></td>	
	    <td class="normal14z" >途程品號</td>
        <td class="normal14" ><input type="text" tabIndex="16" id="bomi07" class="bomi07" onKeyPress="keyFunction()" name="bomi07" onchange="check_bomi07(this)" value="<?php echo $bomi07; ?>"  size="10"    />
		<img id="Showbomi07disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>		
	     <span id="bomi07disp"> <?php   echo $bomi07disp; ?> </span></td>
		<td class="normal14z">超交管理</td>
        <td class="normal14" width="6%" ><input type="hidden" name="mb044" value="N" />
		<input tabIndex="44" id="mb044" onKeyPress="keyFunction()" name="mb044" <?php if($mb044 == 'Y' ) echo 'checked'; ?>  <?php if($mb044 !== 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td>
		<td class="normal14z" >超交率：</td>
        <td class="normal14" ><input tabIndex="45" id="mb045" onKeyPress="keyFunction()" name="mb045" value="<?php echo $mb045; ?>" size="9" type="text"  /></td>
	  </tr>
	    
	  <tr>
	    <td class="normal14z" >途程代號</td>
        <td class="normal14" ><input tabIndex="46"  id="mb011"  class="mb011" onKeyPress="keyFunction()"  name="mb011"  value="<?php echo $mb011; ?>"  size="4" type="text" />
		  <span id="bomi07adisp"> <?php   echo $bomi07adisp; ?> </span></td></td>	
		<td class="normal14z" >低階碼：</td>						
        <td  class="normal14a"    ><input tabIndex="47" id="mb026" onKeyPress="keyFunction()" name="mb026"   value="<?php echo $mb026; ?>"  size="2"  type="text"  /></td>	 
	    <td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	</table>
	</div>
	
	<!-- 採購生管 3 --> 
    <div id="tab3" class="tab_content">
	<?php
	  $date=date("Ymd");
	//  $mb067=$this->input->post('cmsi09b');
	  $cmsi09=$this->input->post('cmsi09');
	  $cmsi09disp=$this->input->post('cmsi09');
	  $cmsi09b=$this->input->post('cmsi09b');
	  $cmsi09bdisp=$this->input->post('cmsi09b');
	  $mb039=$this->input->post('mb039');
	  $mb042=$this->input->post('mb042');
	  $mb032=$this->input->post('puri01');
	  $puri01=$this->input->post('puri01');
	  $puri01disp=$this->input->post('puri01');
	  $mb040=$this->input->post('mb040');
	  $mb044=$this->input->post('mb044');	
	  $mb045=$this->input->post('mb045');	
	  $mb034=$this->input->post('mb034');
      $mb040=$this->input->post('mb040');	
      $mb036=$this->input->post('mb036');
      $mb077=$this->input->post('mb077');
      $mb037=$this->input->post('mb037');
      $mb043=$this->input->post('mb043');
      $mb076=$this->input->post('mb076');
      $mb038=$this->input->post('mb038');
      $mb043=$this->input->post('mb043');	
      $mb076=$this->input->post('mb076');	  
      $mb038=$this->input->post('mb038');	  
      $mb078=$this->input->post('mb078');	  
      $mb079=$this->input->post('mb079');	  
      $mb092=$this->input->post('mb092');
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y"  width="12%"> 採購人員：</td>
        <td class="normal14a"  width="14%"><input type="text" tabIndex="48" id="cmsi09" class="cmsi09" onKeyPress="keyFunction()" name="cmsi09" onchange="check_cmsi09(this)" value="<?php echo $cmsi09; ?>"  size="10"    />
		<img id="Showcmsi09disp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>		
	     <span id="cmsi09disp"> <?php   echo $cmsi09disp; ?> </span></td>
		
		<td class="normal14y" width="12%" >最低補量：</td>
		<td class="normal14a"  width="14%"><input tabIndex="49" id="mb039" onKeyPress="keyFunction()" name="mb039" value="<?php echo $mb039; ?>" size="15" type="text"  /></td>
        <td class="normal14y"  width="8%">領料碼：</td>
		<td class="normal14a"  width="15%" >
			<select id="mb042" onKeyPress="keyFunction()" name="mb042" " tabIndex="50">
               <option <?php if($mb042 == '1') echo 'selected="selected"';?> value='1'>逐批領料</option>                                                                        
		       <option <?php if($mb042 == '2') echo 'selected="selected"';?> value='2'>自動扣料</option>
               <option <?php if($mb042 == '3') echo 'selected="selected"';?> value='3'>單獨領料</option>
		    </select>
		</td>
		<td class="normal14y" width="10%">主供應商：</td>
        <td class="normal14a" width="15%" ><input type="text" tabIndex="48" id="puri01" class="puri01" onKeyPress="keyFunction()" name="puri01" onchange="check_puri01(this)" value="<?php echo $puri01; ?>"  size="10"    />
		<img id="Showpuri01disp" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>		
	     <span id="puri01disp"> <?php   echo $puri01disp; ?> </span></td>
		
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" > 補貨倍量：</td>
        <td class="normal14" ><input tabIndex="52" id="mb040" onKeyPress="keyFunction()" name="mb040" value="<?php echo $mb040; ?>" size="15" type="text"  /></td>
		<td class="normal14z">補貨政策：</td>						
        <td  class="normal14"  >
		    <select id="mb034" onKeyPress="keyFunction()" name="mb034" " tabIndex="53">
                 <option <?php if($mb034 == 'R') echo 'selected="selected"';?> value='R'>依補貨點</option>                                                                        
		         <option <?php if($mb034 == 'M') echo 'selected="selected"';?> value='M'>依MRP需求</option>
                 <option <?php if($mb034 == 'L') echo 'selected="selected"';?> value='L'>依LRP需求</option>
                 <option <?php if($mb034 == 'N') echo 'selected="selected"';?> value='N'>不需</option>
				  <option <?php if($mb034 == 'H') echo 'selected="selected"';?> value='H'>依歷史銷售</option>
		    </select>
		</td>
	    <td  class="normal14z" >超收管理：</td>
        <td class="normal14"  ><input type="hidden" name="mb044" value="N" />
	    <input tabIndex="54" id="mb044" onKeyPress="keyFunction()" name="mb044" <?php if($mb044 == 'Y' ) echo 'checked'; ?>  <?php if($mb044 !== 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td>
	    <td class="normal14z" >超收率：</td>
        <td class="normal14" ><input tabIndex="55"  id="mb045" onKeyPress="keyFunction()"  name="mb045"  value="<?php echo $mb045; ?>" size="9" type="text" /></td>	
	  </tr>
		
	  <tr>
	    <td class="normal14z">領用倍量</td>
        <td class="normal14"><input tabIndex="56" id="mb040"  onKeyPress="keyFunction()"  name="mb040"  value="<?php echo $mb040; ?>"  type="text"  /></td>	
	    <td class="normal14z" > 固定前置天數：</td>
        <td class="normal14" ><input tabIndex="57" id="mb036" onKeyPress="keyFunction()" name="mb036" value="<?php echo $mb036; ?>" size="3" type="text"  /></td>
	    <td  class="normal14z" >品管類別：</td>
        <td  class="normal14"  ><input tabIndex="58" id="mb077" onKeyPress="keyFunction()" name="mb077"  value="<?php echo $mb077; ?>"  size="6" type="text"   /></td>
		<td class="normal14z">變動前置天：</td>
		<td class="normal14" ><input tabIndex="59" id="mb037" onKeyPress="keyFunction()" name="mb037" value="<?php echo $mb037; ?>" size="3" type="text"  /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >批量：</td>
        <td class="normal14" ><input tabIndex="60"  id="mb038" onKeyPress="keyFunction()"  name="mb038"  value="<?php echo $mb038; ?>" size="15" type="text" /></td>	
		<td class="normal14z">檢驗方式</td>
		<td  class="start14a"  >
		    <select id="mb043" onKeyPress="keyFunction()" name="mb043" " tabIndex="61">
                 <option <?php if($mb043 == '0') echo 'selected="selected"';?> value='0'>免檢</option>                                                                        
		         <option <?php if($mb043 == '1') echo 'selected="selected"';?> value='1'>抽檢(減量)</option>
                 <option <?php if($mb043 == '2') echo 'selected="selected"';?> value='2'>抽檢(正常)</option>
                 <option <?php if($mb043 == '3') echo 'selected="selected"';?> value='3'>抽檢(加嚴)</option>
		         <option <?php if($mb043 == '4') echo 'selected="selected"';?> value='4'>全檢</option>
		    </select>
		</td>
	    <td class="normal14z" >檢驗天數：</td>
        <td class="normal14" ><input tabIndex="62" id="mb076" onKeyPress="keyFunction()" name="mb076" value="<?php echo $mb076; ?>" size="3" type="text"   /></td>
	    <td  class="normal14z" >序號管理：</td>
        <td class="normal14" width="6%" ><input type="hidden" name="mb092" value="N" />
		<input tabIndex="63" id="mb092" onKeyPress="keyFunction()" name="mb092" <?php if($mb092 == 'Y' ) echo 'checked'; ?>  <?php if($mb085 !== 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td>
	  </tr>
	    
	  <tr>
	    <td class="normal14z" >MRP生產交貨提前天數</td>
        <td class="normal14" ><input tabIndex="64"  id="mb078" onKeyPress="keyFunction()"  name="mb078"  value="<?php echo $mb078; ?>"  size="3" type="text" /></td>	
		<td class="normal14z" >MRP採購交貨提前天數</td>						
        <td  class="normal14a"    ><input tabIndex="65" id="mb079" onKeyPress="keyFunction()" name="mb079"   value="<?php echo $mb079; ?>"  size="3"  type="text"  /></td>	 
	    <td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	</table>	 
    </div>
	<!-- 售價 4-->
	<div id="tab4" class="tab_content">
	<?php
	  $date=date("Ymd");
	  $mb046=$this->input->post('mb046');
	  $mb082=$this->input->post('mb039');
	  $mb047=$this->input->post('mb042');
	  $mb048=$this->input->post('mb032');
	  $mb049=$this->input->post('mb040');
	  $mb050=$this->input->post('mb044');	
	  $mb052=$this->input->post('mb045');	
	  $mb051=$this->input->post('mb034');
      $mb053=$this->input->post('mb040');	
      $mb054=$this->input->post('mb036');
      $mb055=$this->input->post('mb077');
      $mb056=$this->input->post('mb037');
      $mb069=$this->input->post('mb043');
      $mb070=$this->input->post('mb076');
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y"  width="12%"> 標準進價：</td>
        <td class="normal14a"  width="14%"><input tabIndex="66" id="mb046" onKeyPress="keyFunction()" name="mb046" value="<?php echo $mb046; ?>" size="18" type="text"  /></td>
	    <td class="normal14y" width="12%" >關稅率：</td>
		<td class="normal14a"  width="14%"><input tabIndex="67" id="mb082" onKeyPress="keyFunction()" name="mb082" value="<?php echo $mb082; ?>" size="12" type="text"  /></td>
        <td class="normal14y"  width="10%">標準售價：</td>
		<td class="normal14a" width="16%" ><input tabIndex="68" id="mb047" onKeyPress="keyFunction()" name="mb047" value="<?php echo $mb047; ?>" size="18" type="text"  /></td>
		<td class="normal14y" width="12%">最近進價幣別：</td>
        <td class="normal14a" width="12%" ><input tabIndex="69" id="mb048" onKeyPress="keyFunction()" name="mb048" value="<?php echo $mb048; ?>" size="4" type="text"  /></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" > 最近進價原幣：</td>
        <td class="normal14" ><input tabIndex="70" id="mb049" onKeyPress="keyFunction()" name="mb049" value="<?php echo $mb049; ?>" size="18" type="text"  /></td>
		<td class="normal14z">最近進價本幣：</td>
        <td class="normal14" ><input tabIndex="71" id="mb050" onKeyPress="keyFunction()" name="mb050" value="<?php echo $mb050; ?>" size="18" type="text"  /></td>
		<td  class="normal14z" >零售價含稅：</td>
        <td class="normal14"  ><input type="hidden" name="mb052" value="N" />
	    <input tabIndex="72" id="mb052" onKeyPress="keyFunction()" name="mb052" <?php if($mb052 == 'Y' ) echo 'checked'; ?>  <?php if($mb052 !== 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td>
	    <td class="normal14z" >零售價：</td>
        <td class="normal14" ><input tabIndex="73"  id="mb051" onKeyPress="keyFunction()"  name="mb051"  value="<?php echo $mb051; ?>" size="18" type="text" /></td>
	  </tr>
		
	  <tr>
	    <td class="normal14z">售價一</td>
        <td class="normal14"><input tabIndex="74" id="mb053"  onKeyPress="keyFunction()"  name="mb053"  value="<?php echo $mb053; ?>"  type="text"  /></td>	
	    <td class="normal14z" > 售價二：</td>
        <td class="normal14" ><input tabIndex="75" id="mb054" onKeyPress="keyFunction()" name="mb054" value="<?php echo $mb054; ?>"  type="text"  /></td>
	    <td  class="normal14z" >售價三：</td>
        <td  class="normal14"  ><input tabIndex="76" id="mb055" onKeyPress="keyFunction()" name="mb055"  value="<?php echo $mb055; ?>"  type="text"   /></td>
		<td class="normal14z">售價四：</td>
		<td class="normal14" ><input tabIndex="77" id="mb056" onKeyPress="keyFunction()" name="mb056" value="<?php echo $mb056; ?>"  type="text"  /></td>
	  </tr>
	    
	  <tr>
	    <td class="normal14z" >售價五:</td>
        <td class="normal14" ><input tabIndex="78"  id="mb069" onKeyPress="keyFunction()"  name="mb069"  value="<?php echo $mb069; ?>"   type="text" /></td>	
		<td class="normal14z" >售價六:</td>						
        <td  class="normal14"    ><input tabIndex="79" id="mb070" onKeyPress="keyFunction()" name="mb070"   value="<?php echo $mb070; ?>"   type="text"  /></td>	 
	    <td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	</table>		 
    </div>
	
	<!-- 成本 5-->
	<div id="tab5" class="tab_content">
	<?php
	  $date=date("Ymd");
	  $mb057=$this->input->post('mb057');
	  $mb058=$this->input->post('mb058');
	  $mb059=$this->input->post('mb059');
	  $mb060=$this->input->post('mb060');
	  $mb061=$this->input->post('mb061');
	  $mb062=$this->input->post('mb062');	
	  $mb063=$this->input->post('mb063');	
	  $mb096=$this->input->post('mb096');
      $mb991=$this->input->post('mb991');	
      $mb992=$this->input->post('mb992');
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y"  width="15%"> 單位標準材料成本：</td>
        <td class="normal14a"  width="18%"><input type="text"   tabIndex="80" id="mb057" onKeyPress="keyFunction()" name="mb057" value="<?php echo $mb057; ?>" size="18"   /></td>
	    <td class="normal14y" width="15%" >單位標準人工成本：</td>
		<td class="normal14a"  width="18%"><input type="text"   tabIndex="81" id="mb058" onKeyPress="keyFunction()" name="mb058" value="<?php echo $mb058; ?>" size="12"   /></td>
        <td class="normal14y"  width="15%">單位標準製造費用：</td>
		<td class="normal14a" width="19%" ><input type="text"   tabIndex="82" id="mb059" onKeyPress="keyFunction()" name="mb059" value="<?php echo $mb059; ?>" size="18"   /></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" > 單位標準加工費用：</td>
        <td class="normal14" ><input tabIndex="83" type="text"   id="mb060" onKeyPress="keyFunction()" name="mb060" value="<?php echo $mb060; ?>" size="18"   /></td>
		<td class="normal14z" > 標準成本合計：</td>
        <td class="normal14" ><input tabIndex="84" type="text" readonly="value" id="mb991" onKeyPress="keyFunction()" name="mb991" value="<?php echo $mb991; ?>" size="18"  style="background-color:#F5F5F5" /></td>
		<td  class="normal14z" >本階人工：</td>
        <td class="normal14" ><input tabIndex="85" type="text"  id="mb061" onKeyPress="keyFunction()" name="mb061" value="<?php echo $mb061; ?>" size="18"   /></td>
	  </tr>
		
	  <tr>
	    <td class="normal14z">本階製費</td>
        <td class="normal14"><input tabIndex="86" type="text"   id="mb062"  onKeyPress="keyFunction()"  name="mb062"  value="<?php echo $mb062; ?>"    /></td>	
	    <td class="normal14z" > 本階加工：</td>
        <td class="normal14" ><input tabIndex="87" type="text"   id="mb063" onKeyPress="keyFunction()" name="mb063" value="<?php echo $mb063; ?>"    /></td>
	    <td  class="normal14z"  >本階成本合計：</td>
        <td  class="normal14"  ><input tabIndex="88" type="text" readonly="value" id="mb992" onKeyPress="keyFunction()" name="mb992"  value="<?php echo $mb992; ?>"   style="background-color:#F5F5F5" /></td>
	  </tr>
	    
	  <tr>
	    <td class="normal14z" >工時底數:</td>
        <td class="normal14" ><input type="text" tabIndex="89"  id="mb096" onKeyPress="keyFunction()"  name="mb096"  value="<?php echo $mb096; ?>"   /></td>
	    <td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	</table>	 
    </div>
	
	<!-- 標準包裝 6-->
	 <div id="tab6" class="tab_content">
	<?php
	  $date=date("Ymd");
	  $mb090=$this->input->post('mb090');
	  $mb073=$this->input->post('mb073');
	  $mb014=$this->input->post('mb014');
	  $mb093=$this->input->post('mb093');
	  $mb015=$this->input->post('mb015');
	  $mb094=$this->input->post('mb094');	
	  $mb074=$this->input->post('mb074');	
	  $mb095=$this->input->post('mb095');
      $mb075=$this->input->post('mb075');	
      $mb071=$this->input->post('mb071');
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y"  width="10%"> 外包裝單位：</td>
        <td class="normal14a"  width="23%"><input tabIndex="90" id="mb090" onKeyPress="keyFunction()" name="mb090" value="<?php echo $mb090; ?>" size="4" type="text"  /></td>
	    <td class="normal14y" width="13%" >外包裝含商品數：</td>
		<td class="normal14a"  width="20%"><input tabIndex="91" id="mb073" onKeyPress="keyFunction()" name="mb073" value="<?php echo $mb073; ?>" size="12" type="text"  /></td>
        <td class="normal14y"  width="13%">單位淨重：</td>
		<td class="normal14a" width="21%" ><input tabIndex="92" id="mb014" onKeyPress="keyFunction()" name="mb014" value="<?php echo $mb014; ?>" size="18" type="text"  /></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" > 外包裝長：</td>
        <td class="normal14" ><input tabIndex="93" id="mb093" onKeyPress="keyFunction()" name="mb093" value="<?php echo $mb093; ?>" size="8" type="text"  /></td>
		<td class="normal14z">外包裝寬：</td>
        <td class="normal14" ><input tabIndex="94" id="mb094" onKeyPress="keyFunction()" name="mb094" value="<?php echo $mb094; ?>" size="8" type="text"  /></td>
		<td  class="normal14z" >外包裝高：</td>
        <td class="normal14" ><input tabIndex="95" id="mb095" onKeyPress="keyFunction()" name="mb095" value="<?php echo $mb095; ?>" size="8" type="text"  /></td>
	  </tr>
		
	  <tr>
	    <td class="normal14z">重量單位</td>
        <td class="normal14"><input tabIndex="96" id="mb015"  onKeyPress="keyFunction()"  name="mb015"  value="<?php echo $mb015; ?>"  type="text"  /></td>	
	    <td class="normal14z" > 外包裝淨重N.W.：</td>
        <td class="normal14" ><input tabIndex="97" id="mb074" onKeyPress="keyFunction()" name="mb074" value="<?php echo $mb074; ?>"  type="text"  /></td>
	    <td  class="normal14z" >外包裝毛重G.W.：</td>
        <td  class="normal14"  ><input tabIndex="98" id="mb075" onKeyPress="keyFunction()" name="mb075"  value="<?php echo $mb075; ?>"  type="text"   /></td>
	  </tr>
	    
	  <tr>
	    <td class="normal14z" >外包裝材積:</td>
        <td class="normal14" ><input tabIndex="99"  id="mb071" onKeyPress="keyFunction()"  name="mb071"  value="<?php echo $mb071; ?>"   type="text" /></td>
	    <td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	</table>		 
    </div>
	 
	</div> <!-- div-7 -->
	
	<!--<div class="buttons">
	<button  type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a accesskey="x" id='cancel' name='cancel' href="<?php echo site_url('inv/invi02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
	</div> -->
	  
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
  
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

   </div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div>  <!-- div-1 -->

<script language="javascript"   >   //不更新網頁, 帶出資料
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁 判斷適用各種流覽器 共用 (全域)
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
}
    function showkey(sText){   //不更新網頁 5 key  品號代號 檢查資料重複 invi02-add
	var oSpan = document.getElementById("keydisp");
		oSpan.innerHTML = sText;		
	 if (!sText) { 
	   $("#keydisp").html("資料可使用!");
	   oSpan.style.color = "#000000";
	 }	 
	  if (sText) { 
	   $("#keydisp").html("資料重複!");
	   oSpan.style.color = "#ff0000";
	 //  document.getElementById("ma002").focus();
	 } 
}

function startkey(oInput){         //不更新網頁 key 品號代號函數 檢查資料重複 invi02-add
	
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
 	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
		$("#keydisp").html("欄位不可空白.");      		
		return;
	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/inv/invi02/checkkey/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showkey(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}
</script>
   
 <?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 共用函數 -->
 <?php  include_once("./application/views/funnew/cmsi03_funmjs_v.php"); ?> <!-- 庫別 -->
 <?php  include_once("./application/views/funnew/cmsi04_funmjs_v.php"); ?>  <!-- 線別 -->
 <?php  include_once("./application/views/funnew/invi01_funmjs_v.php"); ?>  <!-- 品號類別 -->
 <?php  include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?>  <!-- 人員 -->
 <?php  include_once("./application/views/funnew/bomi07_funmjs_v.php"); ?>  <!-- 途程品號 -->
 <?php  include_once("./application/views/funnew/puri01_funmjs_v.php"); ?>  <!-- 主供應商 -->
 <?php  include_once("./application/views/funnew/invi02_funmaddjs_v.php"); ?>  <!-- 新增單位 -->
				 