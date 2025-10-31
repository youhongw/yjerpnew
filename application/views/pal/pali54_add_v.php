<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
    </div>

<div id="content">  <!-- div-3 -->
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 請假單資料建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pal/pali54/addsave" >	
	<!-- <div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  if(!isset($tg001)){$tg001=$this->input->post('tg001');}
	  if(!isset($tg002)){$tg002=$this->input->post('tg002');}
	  if(!isset($palq01a)){$palq01a=$tg001;}
	  if(!isset($cmsq05a)){$cmsq05a=$tg002;}
	  $palq01adisp=$this->input->post('tg001');
	  $cmsq05adisp=$this->input->post('tg002');

	   if (!isset($tg003)) { $tg003=date("Y/m/d");}
	   if (!isset($tg004)) { $tg004=0;} else { $tg004=$this->input->post('tg004');}
	   if (!isset($tg005)) { $tg005=0;} else { $tg005=$this->input->post('tg005');}
	   if (!isset($tg006)) { $tg006=0;} else { $tg006=$this->input->post('tg006');}
	   if (!isset($tg007)) { $tg007=0;} else { $tg007=$this->input->post('tg007');}
	   if (!isset($tg008)) { $tg008=0;} else { $tg008=$this->input->post('tg008');}
	   if (!isset($tg009)) { $tg009=0;} else { $tg009=$this->input->post('tg009');}
	   if (!isset($tg010)) { $tg010=0;} else { $tg010=$this->input->post('tg010');}
	   if (!isset($tg011)) { $tg011=0;} else { $tg011=$this->input->post('tg011');}
	   if (!isset($tg012)) { $tg012=0;} else { $tg012=$this->input->post('tg012');}
	   if (!isset($tg013)) { $tg013=0;} else { $tg013=$this->input->post('tg013');}
	   if (!isset($tg014)) { $tg014=0;} else { $tg014=$this->input->post('tg014');}
	   if (!isset($tg015)) { $tg015=0;} else { $tg015=$this->input->post('tg015');}
	   if (!isset($tg016)) { $tg016=0;} else { $tg016=$this->input->post('tg016');}
	   if (!isset($tg017)) { $tg017=0;} else { $tg017=$this->input->post('tg017');}
	   if (!isset($tg018)) { $tg018=0;} else { $tg018=$this->input->post('tg018');}
	   if (!isset($tg019)) { $tg019=0;} else { $tg019=$this->input->post('tg019');}
	   if (!isset($tg020)) { $tg020=0;} else { $tg020=$this->input->post('tg020');}
	   if (!isset($tg021)) { $tg021=0;} else { $tg021=$this->input->post('tg021');}
	   if (!isset($tg022)) { $tg022=0;} else { $tg022=$this->input->post('tg022');}
	   if (!isset($tg023)) { $tg023='';} else { $tg023=$this->input->post('tg023');}
	   if (!isset($tg201)) { $tg201='';} else { $tg201=$this->input->post('tg201');}
	    if (!isset($tg202)) { $tg202='';} else { $tg202=$this->input->post('tg202');}
		if (!isset($tg203)) { $tg203='';} else { $tg203=$this->input->post('tg203');}
	//  if (!isset($tg014)) { $tg014=date("Y/m/d");}
	  $tg301='';
	  $tg304='';
	  $tg305=0;
	  $tg306=0;
	  $tg307='';
	  $tg309='';
	  $tg310=0;
	  $tg311=0;
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="start14a" width="11%"><span class="required">員工代號：</span></td>
        <td class="normal14a" width="22%" ><input   tabIndex="1" id="tg001" onKeyPress="keyFunction()" onchange="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>"  type="text" required /><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="palq01adisp"> <?php    echo $palq01adisp; ?> </span></td>
	    <td class="start14a" width="11%"><span class="required">部門代號：</span></td>
        <td class="normal14a"  width="22%"> <input   tabIndex="2" id="tg002" onKeyPress="keyFunction()" onchange="startcmsq05a(this)" name="cmsq05a" value="<?php echo $cmsq05a; ?>"  type="text" required /><img id="Showcmsq05a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
         <span id="cmsq05adisp"> <?php    echo $cmsq05adisp; ?> </span></td>
       <td class="normal14a" width="11%">請假日期： </td>
        <td class="normal14" width="23%"><input  tabIndex="3" onKeyPress="keyFunction()"  onclick="scwShow(this,event);"  onchange="dateformat_ymd(this);" id="tg003" name="tg003"  value="<?php echo $tg003; ?>"  type="text" style="background-color:#E7EFEF" /></td>
	  </tr>	
		
	  <tr>
        <td class="normal14" >遲到早退次：</td>
		<td class="normal14"><input  tabIndex="4" onKeyPress="keyFunction()"  id="tg004" name="tg004"  value="<?php echo $tg004; ?>"  type="text"  /></td>	   
	   <td  class="normal14" >未刷卡補正次：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" id="tg005"     onKeyPress="keyFunction()"    name="tg005" value="<?php echo $tg005; ?>"  /></td>	  
	    <td class="normal14">事假小時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="6" id="tg006"     onKeyPress="keyFunction()"    name="tg006" value="<?php echo $tg006; ?>"  /></td>
	  </tr>
	   <tr>
	    <td  class="normal14" >病假小時：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" id="tg007"      onKeyPress="keyFunction()"    name="tg007" value="<?php echo $tg007; ?>"  /></td>	  
	    <td class="normal14a">特休小時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="8" id="tg008" onKeyPress="keyFunction()" onchange="addsel9(this);"    name="tg008" value="<?php echo $tg008; ?>"  /></td>	
	    <td  class="normal14" >喪假天：</td>
        <td  class="normal14"  ><input type="text" tabIndex="9" id="tg009"     onKeyPress="keyFunction()"    name="tg009" value="<?php echo $tg009; ?>" /></td>	
	  </tr>
	   
	  <tr>
	    <td class="normal14">無薪假小時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="tg010"     onKeyPress="keyFunction()"    name="tg010" value="<?php echo $tg010; ?>"  /></td>
		<td  class="normal14" >產假天：</td>
        <td  class="normal14"  ><input type="text" tabIndex="11" id="tg011"     onKeyPress="keyFunction()"    name="tg011" value="<?php echo $tg011; ?>" /></td>	  
	    <td class="normal14" >陪產假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="12" id="tg012"     onKeyPress="keyFunction()"    name="tg012" value="<?php echo $tg012; ?>"  /></td>
	  </tr>
	   <tr>
	    <td class="normal14">產檢假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="tg201"     onKeyPress="keyFunction()"    name="tg201" value="<?php echo $tg201; ?>"  /></td>
		<td class="normal14">生理假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="tg202"     onKeyPress="keyFunction()"    name="tg202" value="<?php echo $tg202; ?>"  /></td>  
	    <td class="normal14">補休假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="tg203"     onKeyPress="keyFunction()"    name="tg203" value="<?php echo $tg203; ?>"  /></td> 
	  </tr>
	  <tr>
	    <td  class="normal14" >婚假天：</td>
        <td  class="normal14"  ><input type="text" tabIndex="13" id="tg013"     onKeyPress="keyFunction()"    name="tg013" value="<?php echo $tg013; ?>" /></td>	  
	    <td class="normal14">公偒假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="14" id="tg014"     onKeyPress="keyFunction()"    name="tg014" value="<?php echo $tg014; ?>"  /></td>
	    <td  class="normal14" >曠職天：</td>
        <td  class="normal14"  ><input type="text" tabIndex="15" id="tg015"     onKeyPress="keyFunction()"    name="tg015" value="<?php echo $tg015; ?>" /></td>	
	  </tr>	  
	   <tr>
        <td class="normal14">公假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="16" id="tg016"     onKeyPress="keyFunction()"    name="tg016" value="<?php echo $tg016; ?>"  /></td>	   
	    <td  class="normal14a" >平常加班時：</td>
        <td  class="normal14"  ><input type="text" tabIndex="17" id="tg017"    onKeyPress="keyFunction()"    name="tg017" value="<?php echo $tg017; ?>"  /></td>	  
	    <td class="normal14">平常加班2小時上：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="18" id="tg018"    onKeyPress="keyFunction()"    name="tg018" value="<?php echo $tg018; ?>"  /></td>
	  </tr>
	  <tr>
        <td class="normal14">六加班時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="19" id="tg019"     onKeyPress="keyFunction()"    name="tg019" value="<?php echo $tg019; ?>"  /></td>	   
	    <td  class="normal14a" >六加班8小時上：</td>
        <td  class="normal14"  ><input type="text" tabIndex="20" id="tg020"    onKeyPress="keyFunction()"    name="tg020" value="<?php echo $tg020; ?>"  /></td>	  
	    <td class="normal14">假日加班時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="21" id="tg021"    onKeyPress="keyFunction()"    name="tg021" value="<?php echo $tg021; ?>"  /></td>
	  </tr>
	   <tr>
	    <td class="normal14">假日加班8小時上：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="22" id="tg022"    onKeyPress="keyFunction()"    name="tg022" value="<?php echo $tg022; ?>"  /></td>
		<td  class="normal14" >備註：</td>
        <td  class="normal14" colspan="2" ><input type="text" tabIndex="23" id="tg023"     onKeyPress="keyFunction()"    name="tg023" value="<?php echo $tg023; ?>"  size="60"/></td>
        <td class="normal14"></td>		
        <td  class="normal14"  ></td>
	  </tr>
	   <tr>
        <td class="normal14">起始特休日期1：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="19" id="tg301"     onKeyPress="keyFunction()"    name="tg301" value="<?php echo $tg301; ?>"  /></td>	   
	    <td  class="normal14a" >截止特休日期1：</td>
        <td  class="normal14"  ><input type="text" tabIndex="20" id="tg304"    onKeyPress="keyFunction()"    name="tg304" value="<?php echo $tg304; ?>"  /></td>	  
	    <td class="normal14">特休天數1：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="21" id="tg305"    onKeyPress="keyFunction()"    name="tg305" value="<?php echo $tg305; ?>"  /></td>
	  </tr>
	   <tr>
        <td class="normal14">已休天數1：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="21" id="tg306"    onKeyPress="keyFunction()"    name="tg306" value="<?php echo $tg306; ?>"  /></td>
	  </tr>
	    <tr>
        <td class="normal14">起始特休日期2：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="19" id="tg307"     onKeyPress="keyFunction()"    name="tg307" value="<?php echo $tg307; ?>"  /></td>	   
	    <td  class="normal14a" >截止特休日期2：</td>
        <td  class="normal14"  ><input type="text" tabIndex="20" id="tg309"    onKeyPress="keyFunction()"    name="tg309" value="<?php echo $tg309; ?>"  /></td>	  
	    <td class="normal14">特休天數2：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="21" id="tg310"    onKeyPress="keyFunction()"    name="tg310" value="<?php echo $tg310; ?>"  /></td>
	  </tr>
	   <tr>
        <td class="normal14">已休天數2：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="21" id="tg311"    onKeyPress="keyFunction()"    name="tg311" value="<?php echo $tg311; ?>"  /></td>
	  </tr>
	</table>
	      
	<div class="buttons">
	<button tabIndex="8" type='submit' accesskey="s"   name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali54/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> 
	  
    </form>
   </div> <!-- div-6 --> 
    </div> <!-- div-5 -->	
</div> <!-- div-4 -->

  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div>  <!-- div-3 -->
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
 <?php // include("./application/views/fun/pali54_funjs_v.php"); ?> 
 <!-- 不更新網頁 檢查 select 欄位 確認碼  -->	
<script type="text/javascript"><!-- 
   function addsel9(oInput){ 
     console.log(oInput.value);
    //特休       
    var vhour=Math.round(parseInt(oInput.value)/8); 
	var vdate=$('input[name=\'tg003\']').val();
	var vtg3061=0;
	var vtg3111=0;
	var vft=0;
    var vtg301=$('input[name=\'tg301\']').val();
	var vtg304=$('input[name=\'tg304\']').val();
	var vtg305=$('input[name=\'tg305\']').val();
	var vtg306=$('input[name=\'tg306\']').val();
	
	var vtg307=$('input[name=\'tg307\']').val();
	var vtg309=$('input[name=\'tg309\']').val();
	var vtg310=$('input[name=\'tg310\']').val();
	var vtg311=$('input[name=\'tg311\']').val();
		
	
	if (vdate >= vtg301 && vdate <= vtg304) {vtg3061=parseFloat(vtg306)+parseFloat(vhour);}
	if ((vdate >= vtg301 && vdate <= vtg304) && (vtg3061>vtg305) && (vft==0) ) {alert('特休超過已請時數1');form.tg008.focus;}
	    else {form.tg306.value=vtg3061;}	
		
	if (vdate >= vtg307 && vdate <= vtg309) {vtg3111=parseFloat(vtg310)+parseFloat(vhour);vft=1;}
	 if ((vdate >= vtg307 && vdate <= vtg309) && (vtg3111>vtg310)) {alert('特休超過已請時數2');form.tg008.focus;}     
		  else {form.tg311.value=vtg3111;vft=1;}
		  
	return vtg306; 
 }
//--></script>
 <?php include("./application/views/fun/pali54_funjs_v.php"); ?> 