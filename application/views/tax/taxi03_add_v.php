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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 進銷項發票建立作業 - 新增　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#cmsi11').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('tax/taxi03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/tax/taxi03/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值
	  //預設稅率,廠別,幣別
       $stax_rate = $this->session->userdata('sysma004');
       $sysma200 = $this->session->userdata('sysma200');
	  if(!isset($mc226)) { $mc226=$stax_rate; }
	  if(!isset($mc001)) { $mc001=$this->input->post('mc001'); }
	 // if(!isset($cmsi11disp)) { $cmsi11disp=$this->input->post('cmsi11disp'); }
	  
	  
	  	  
	  if(!isset($mc001disp)) { $mc001disp=$this->input->post('mc001disp'); }
	  if(!isset($mc201disp)) { $mc201disp=$this->input->post('mc201disp'); }
	  
	  if(!isset($mc028)) { $mc028=$this->input->post('mc028'); }  //發票號碼起 
	  
	  if(!isset($mc201)) { $mc201=$this->input->post('copi01'); }
	  if(!isset($mc202)) { $mc202=$this->input->post('mc202'); } 
	  if(!isset($mc018)) { $mc018=$this->input->post('mc018'); }
	  if(!isset($mc205)) { $mc205=$this->input->post('mc205'); } 
      if(!isset($mc206)) { $mc206=$this->input->post('mc206'); } 
	  if(!isset($mc207)) { $mc207=$this->input->post('mc207'); } 
      if(!isset($mc208)) { $mc208=$this->input->post('mc208'); } 
	  if(!isset($mc209)) { $mc209=$this->input->post('mc209'); }
	  
	  if(!isset($mc002)) { $mc002=$this->input->post('mc002'); } 
      if(!isset($mc004)) { $mc004=$this->input->post('mc004'); }
      if(!isset($mc005)) { $mc005=$this->input->post('mc005'); }	  
	  if(!isset($mc006)) { $mc006=$this->input->post('mc006'); }
	  if(!isset($mc007)) { $mc007=date("Y/m/d"); } else { $mc007=$this->input->post('mc007'); } 
	   $mc008=$this->input->post('mc008');
	   $mc009=$this->input->post('mc009');
      if(!isset($mc010)) { $mc010=$this->input->post('mc010'); } 
	   $mc011=$this->input->post('mc011');
	   if(!isset($mc012)) { $mc012=1; }  else {$mc012=$this->input->post('mc012');}
	   $mc013=$this->input->post('mc013');
	   if(!isset($mc014)) { $mc014=2; }  else {$mc014=$this->input->post('mc014');}
	   $mc016=$this->input->post('mc016');
	   $mc017=$this->input->post('mc017');
	  if(!isset($mc018)) { $mc018=$this->input->post('mc018'); }
	  if(!isset($mc019)) { $mc019=2; } else {$mc019=$this->input->post('mc019');}
	   $mc020=$this->input->post('mc020');
	   $mc021=$this->input->post('mc021');
	   $mc022=$this->input->post('mc022');
	   $mc022disp=$this->input->post('mc022disp');
	   $mc023=$this->input->post('mc023');
	   $mc024=$this->input->post('mc024');
	   $mc025=$this->input->post('mc025');
	   $mc026=$this->input->post('mc026');
	   $mc027=$this->input->post('mc027');
	  if(!isset($mc028)) { $mc028=$this->input->post('mc028'); }  //發票號碼起 
	   $mc029=$this->input->post('mc029');
	   $mc030=$this->input->post('mc030');
	   $mc031=$this->input->post('mc031');
	   
	  if(!isset($mc212)) { $mc212=$this->input->post('mc212'); } 
	  if(!isset($mc215)) { $mc215=$this->input->post('mc215'); } 
	  if(!isset($mc217)) { $mc217=$this->input->post('mc217'); } 
      if(!isset($mc218)) { $mc218=$this->input->post('mc218'); } 
	  if(!isset($mc219)) { $mc219=$this->input->post('mc219'); } 
     
     
      if(!isset($mc224)) { $mc224=$this->input->post('mc224'); } 
      if(!isset($mc225)) { $mc225=$this->input->post('mc225'); }  
	 
	 //  $mc225=$this->input->post('mc225');  一筆存檔清空白
	  if(!isset($mc221)) { $mc221=date_create('now')->format('Y-m-d H:i:s'); }   
	  if(!isset($mc220)) { $mc220=$username; }
	  if(!isset($mc222)) { $mc222=0; }
	  if(!isset($mc223)) { $mc223="1"; }
	  $mc217=0;$mc218=0;$mc219=0;
	  //$this->session->unset_userdata('docno');
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="9%"><span class="required">申報公司：</span></td>   <!--onchange="startcopi03(this);check_title_no();"    -->
        <td class="normal14a"  width="25%"><input tabIndex="1" id="cmsi11"    onKeyPress="keyFunction()" ondblclick="search_cmsi11_window()"  name="mc001"  onchange="check_cmsi11(this);check_title_no();"  value="<?php echo $mc001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showcmsi11disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="cmsi11disp"> <?php    echo $mc001disp; ?> </span></td>
	    <td class="normal14y" width="8%" >申報期別： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" >
	<!--	<input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mc002" onKeyPress="keyFunction()"  onchange="dateformat_ym(this);check_title_no();" name="mc002"  value="<?php echo $mc002; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /></td> -->
	    <input tabIndex="3" id="mc002" class="date-picker" onChange="dateformat_ym(this)"  onKeyPress="keyFunction()"    type="text" name="mc002"  value="<?php echo $mc002; ?>"  size="16" style="background-color:#E7EFEF" /><span >  </span>
		<td class="normal14y" width="8%"><span class="required">流水號：</span></td>
        <td class="normal14a" width="25%"><input tabIndex="3" id="mc006" onKeyPress="keyFunction()"  name="mc006" onfocus="check_title_no();" value="<?php echo $mc006; ?>" size="16" type="text" required /></td>
	  </tr>
	  
	  <tr>	    
	    <td class="normal14z"  >開立日期： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"   ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mc007" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="mc007"  value="<?php echo $mc007; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(mc007,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		<td class="normal14z">發票號碼</td>
        <td  class="normal14"  ><input type="text" tabIndex="5"  onchange="check_length(this);check_vno(this)" onKeyPress="keyFunction()" id="mc010" name="mc010"   value="<?php echo $mc010; ?>"   /></td>
	    <td class="normal14z">格式代號</td>
		<td  class="normal14"  ><select  tabIndex="3" id="mc004" onchange="check_vformat()" onKeyPress="keyFunction()"  name="mc004" >
             <option <?php if($mc004 == '21') echo 'selected="selected"';?> value='21'>21:進項三聯式.電子計算機統一發票</option>                                                                      
		     <option <?php if($mc004 == '22') echo 'selected="selected"';?> value='22'>22:進載有稅額之其他憑證(含二聯式收銀機發票)</option>
			 <option <?php if($mc004 == '23') echo 'selected="selected"';?> value='23'>23:三聯式進貨退出或折讓證明單</option>
			 <option <?php if($mc004 == '24') echo 'selected="selected"';?> value='24'>24:二聯式進貨退出或折讓證明單</option>
			 <option <?php if($mc004 == '25') echo 'selected="selected"';?> value='25'>25:進項三聯式收銀機統一發票</option>
			 <option <?php if($mc004 == '26') echo 'selected="selected"';?> value='26'>26:彙總登錄每張稅額伍佰元以下之進項格式21者</option>
			 <option <?php if($mc004 == '27') echo 'selected="selected"';?> value='27'>27:彙總登錄每張稅額伍佰元以下之進項格式22者</option>
			 <option <?php if($mc004 == '28') echo 'selected="selected"';?> value='28'>28:進項海關代徵營業稅納證</option>
			 <option <?php if($mc004 == '31') echo 'selected="selected"';?> value='31'>31:銷項三聯式.電子計算機統一發票</option>
			 <option <?php if($mc004 == '32') echo 'selected="selected"';?> value='32'>32:銷項二聯式.收銀機(二聯式)統一發票</option>
			 <option <?php if($mc004 == '33') echo 'selected="selected"';?> value='33'>33:三聯式銷貨退回或折讓證明單</option>
			 <option <?php if($mc004 == '34') echo 'selected="selected"';?> value='34'>34:二聯式銷貨退回或折讓證明單</option>
			 <option <?php if($mc004 == '35') echo 'selected="selected"';?> value='35'>35:銷項三聯式收銀機統一發票</option>
			 <option <?php if($mc004 == '36') echo 'selected="selected"';?> value='36'>36:銷項免用發票</option>
		  </select></td>
	  </tr>
	  <tr>	
         <td class="normal14z">稅籍編號：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7"   onKeyPress="keyFunction()" id="mc005" name="mc005"   value="<?php echo $mc005; ?>"  style="background-color:#F0F0F0"  /></td>	  
		<td class="normal14z"  >備註：</td>
        <td  class="normal14" colspan="2" ><input type="text" tabIndex="5"   onKeyPress="keyFunction()" id="mc018" name="mc018"   value="<?php echo $mc018; ?>"  size="50" /></td>
	    <td class="normal14"></td>
        <td  class="normal14"  ></td>
	  </tr>
	  
	</table>
	
	<div class="abgne_tab"> <!-- div-6 頁標籤 -->
		<ul class="tabs">
		  <li><a href="#tab1"  accesskey="a">發票明細a</a></li>
		  <li><a href="#tab2"  accesskey="b">零稅率出口文件b</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  發票明細 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	  
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y"  width="10%">買方統一編號：</td>
        <td class="normal14a"  width="24%" ><input type="text" tabIndex="6" onfocus="check_vformat()"  onKeyPress="keyFunction()" id="mc008" name="mc008"   value="<?php echo $mc008; ?>" size="12"  /></td>	
	    <td class="normal14y"  width="10%">賣方統一編號：</td>  <!-- onchange="startcmsi09(this)"     -->
        <td class="normal14a"  width="24%" ><input type="text" tabIndex="6"  onfocus="check_vformat()" onKeyPress="keyFunction()" id="mc009" name="mc009"   value="<?php echo $mc009; ?>" size="12"  /></td>	
	    <td class="normal14y"  width="10%">課稅別：</td>   <!-- onchange="startcmsi02(this)"  onchange="check_cmsi02(this)"   -->
        <td class="normal14a"  width="23%" ><select  tabIndex="3" id="mc012"  onKeyPress="keyFunction()"  name="mc012" >
             <option <?php if($mc012 == '0') echo 'selected="selected"';?> value='0'>0:應稅內含</option>  
             <option <?php if($mc012 == '1') echo 'selected="selected"';?> value='1'>1:應稅外加</option> 			 
		     <option <?php if($mc012 == '2') echo 'selected="selected"';?> value='2'>2:零稅率</option>
			 <option <?php if($mc012 == '3') echo 'selected="selected"';?> value='3'>3:免稅</option>
			 <option <?php if($mc012 == 'D') echo 'selected="selected"';?> value='D'>D:作廢</option>
		  </select></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14z"  >扣抵代號：</td>
        <td class="normal14" ><select  tabIndex="3" id="mc014" onKeyPress="keyFunction()"  name="mc014" >             
             <option <?php if($mc014 == '1') echo 'selected="selected"';?> value='1'>1:可扣抵:應稅電子發票</option> 			 
		     <option <?php if($mc014 == '2') echo 'selected="selected"';?> value='2'>2:可扣抵:三聯式.電子計算機發票</option>
			 <option <?php if($mc014 == '3') echo 'selected="selected"';?> value='3'>3:可扣抵:三收銀.公用事業發票</option>
			 <option <?php if($mc014 == '4') echo 'selected="selected"';?> value='4'>4:可扣抵:二收銀有稅憑證</option>
			 <option <?php if($mc014 == '5') echo 'selected="selected"';?> value='5'>5:可扣抵:二收銀有稅憑證</option>
			 <option <?php if($mc014 == '6') echo 'selected="selected"';?> value='6'>6:可扣抵:進退折</option>
			 <option <?php if($mc014 == '7') echo 'selected="selected"';?> value='7'>7:可扣抵:海關進口代徵</option>
		     <option <?php if($mc014 == '8') echo 'selected="selected"';?> value='8'>8:可扣抵:海關退溢</option>
			 <option <?php if($mc014 == '9') echo 'selected="selected"';?> value='9'>9:可扣抵:銷退折</option>
			 <option <?php if($mc014 == '10') echo 'selected="selected"';?> value='10'>10:可扣抵:進口貨物勞務</option>
		     <option <?php if($mc014 == '11') echo 'selected="selected"';?> value='11'>11:可扣抵:銷退折</option>
			 <option <?php if($mc014 == '12') echo 'selected="selected"';?> value='12'>12:可扣抵:進貨及費用</option>
			 <option <?php if($mc014 == '13') echo 'selected="selected"';?> value='13'>13:可扣抵:固定資產</option>
			 <option <?php if($mc014 == '14') echo 'selected="selected"';?> value='14'>14:不可扣抵:進貨及費用</option>
			 <option <?php if($mc014 == '15') echo 'selected="selected"';?> value='15'>15:不可扣抵:固定資產</option>
			 <option <?php if($mc014 == '16') echo 'selected="selected"';?> value='16'>16:不可扣抵:不可扣抵應稅.零稅.免稅</option>
			 <option <?php if($mc014 == '17') echo 'selected="selected"';?> value='17'>17:不可扣抵:免用統一發票</option>
			 <option <?php if($mc014 == '18') echo 'selected="selected"';?> value='18'>18:不可扣抵:不需扣繳申報收據</option>
		     <option <?php if($mc014 == '19') echo 'selected="selected"';?> value='19'>19:不可扣抵:需扣繳申報收據</option>
		  </select></td>
	    <td class="normal14z" >銷貨金額：</td>		
        <td class="normal14"  ><input type="text"  tabIndex="12"  id="mc011" onKeyPress="keyFunction()"    name="mc011" value="<?php echo $mc011; ?>"  size="12" /></td>
	    <td class="normal14z" >營業稅額：</td>		
        <td class="normal14"  ><input type="text" id="mc013"   tabIndex="13"   onKeyPress="keyFunction()"    name="mc013" value="<?php echo $mc013; ?>"  size="12" /></td>
	  </tr>
	  
	  <tr>
		<td class="normal14z" >來源單別：</td>		
        <td class="normal14"  ><input type="text"  tabIndex="12"   onKeyPress="keyFunction()"    name="mc020" value="<?php echo $mc020; ?>"  size="12" /></td>
	    <td class="normal14z" >來源單號：</td>		
        <td class="normal14"  ><input type="text" id="mc021"   tabIndex="13"   onKeyPress="keyFunction()"    name="mc021" value="<?php echo $mc021; ?>"  size="12" /></td>
	    <td class="normal14" ></td>		
        <td class="normal14"  ></td>
	  </tr>
	   <tr>
		<td class="normal14z" >彚加註記：</td>		
        <td class="normal14"  ><input type="hidden" name="mc016" value="N" />
		<input tabIndex="12" type="checkbox"  id="mc016" onKeyPress="keyFunction()"   name="mc016" <?php if($mc016 == 'Y' ) echo 'checked'; ?>  <?php if($mc016 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	    <td class="normal14z" >洋菸酒註記：</td>		
        <td class="normal14"  ><input type="hidden" name="mc017" value="N" />
		<input tabIndex="12" type="checkbox"  id="mc017" onKeyPress="keyFunction()"   name="mc017" <?php if($mc017 == 'Y' ) echo 'checked'; ?>  <?php if($mc017 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	    <td class="normal14z" >來源方式：</td>		
        <td class="normal14"  >
		<input type="radio" tabIndex="8" name="mc019" <?php if (isset($mc019) && $mc019=="1") echo "checked";?> value="1" />拋轉&nbsp;&nbsp;&nbsp; 
        <input type="radio" tabIndex="9" name="mc019" <?php if (isset($mc019) && $mc019=="2") echo "checked";?> value="2" />人工
        </td>
	  </tr>
	  
	</table>
	</div>
	
	<!--  零稅率出口文件b  -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	  
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y"  width="11%">買受人代號：</td>
        <td class="normal14a"  width="23%" ><input tabIndex="4" id="copi01" onKeyPress="keyFunction()"  onchange="check_copi01(this)" name="mc022" value="<?php echo $mc022; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="copi01disp"> <?php   echo $mc022disp; ?> </span></td>
	    <td class="normal14y"  width="11%">買受人簡稱：</td>  <!-- onchange="startcmsi09(this)"     -->
        <td class="normal14a"  width="23%" ><input type="text" tabIndex="6"   onKeyPress="keyFunction()" id="mc023" name="mc023"   value="<?php echo $mc023; ?>" size="12"  /></td>	
	    <td class="normal14y"  width="11%">貨物名稱：</td>   <!-- onchange="startcmsi02(this)"  onchange="check_cmsi02(this)"   -->
        <td class="normal14a"  width="22%" ><input tabIndex="4" id="invi02a" onKeyPress="keyFunction()"  onchange="check_invi02a(this)" name="invi02a" value="<?php echo $mc022; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showinvi02adisp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
          <span id="invi02adisp">  </span></td>
	  </tr>			  
	  <tr>
	    <td class="normal14z"  >數量：</td>
        <td class="normal14"  ><input type="text" tabIndex="6"   onKeyPress="keyFunction()" id="mc025" name="mc025"   value="<?php echo $mc025; ?>" size="12"  /></td>	
	    <td class="normal14z"  >外銷方式：</td>  <!-- onchange="startcmsi09(this)"     -->
        <td class="normal14"  ><input type="text" tabIndex="6"   onKeyPress="keyFunction()" id="mc026" name="mc026"   value="<?php echo $mc026; ?>" size="12"  /></td>	
	    <td class="normal14z"  >證明方式：</td>   <!-- onchange="startcmsi02(this)"  onchange="check_cmsi02(this)"   -->
        <td class="normal14"   ><input type="radio" tabIndex="8" name="mc027" <?php if (isset($mc027) && $mc027=="1") echo "checked";?> value="1" />非經海關&nbsp;&nbsp;&nbsp; 
        <input type="radio" tabIndex="9" name="mc027" <?php if (isset($mc027) && $mc027=="2") echo "checked";?> value="2" />經海關
        </td>
	  </tr>	
      <tr>
	    <td class="normal14z"  >證明文件名稱：</td>
        <td class="normal14"  ><input type="text" tabIndex="6"   onKeyPress="keyFunction()" id="mc028" name="mc028"   value="<?php echo $mc028; ?>" size="12"  /></td>	
	    <td class="normal14z"  >出口報單號碼：</td>  <!-- onchange="startcmsi09(this)"     -->
        <td class="normal14"  ><input type="text" tabIndex="6"   onKeyPress="keyFunction()" id="mc030" name="mc030"   value="<?php echo $mc030; ?>" size="12"  /></td>	
	    <td class="normal14z"  >輸出/結匯日期：</td>   <!-- onchange="startcmsi02(this)"  onchange="check_cmsi02(this)"   -->
        <td class="normal14"   ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mc031" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="mc031"  value="<?php echo $mc031; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(mc031,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td></tr>			  
	  <tr>
	    <td class="normal14z">出口報單類別：</td>						
        <td class="normal14" ><input type="text" tabIndex="23"   onKeyPress="keyFunction()" id="mc029" name="mc029"  size="12"   value="<?php echo $mc029; ?>"    /></td>
		<td class="normal14" ></td>						
        <td class="normal14" ></td>
		<td class="normal14" ></td>						
        <td class="normal14" ></td>
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
               
					<input id="select_rows" style="display:none;"/>
				<td class="left" valign="top"></td>
              </tr>
		<!-- 合計     -->	  
	<!-- <div class="buttons">                           <!-- check_vno();     -->	
	 <!--  <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('tax/taxi03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	<!-- </div>  -->   
   </div> 	<!-- end 頁標籤 -->   
   </form>
	   <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位,交貨庫別,可輸入部份品號或品名下拉視窗選擇,欄位淡黃色按2下開視窗查詢,按Enter鍵或Tab鍵跳下一個欄位,Alt+y跳到明細資料, Alt+w新增一筆明細. ] ' ?> </div>  <?php } ?>
	
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
   
	</div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->

<?php  include_once("./application/views/funnew/cmsi11_funmjs_v.php"); ?> <!-- 申報公司 -->
<?php  include_once("./application/views/funnew/copi01b_funmjs_v.php"); ?>  <!--客戶代號 -->
<?php  include_once("./application/views/funnew/invi02_funmjs_v.php"); ?>  <!--貨品名稱 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/taxi03_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#cmsi11').focus();
	}); 	   
</script> 	    	