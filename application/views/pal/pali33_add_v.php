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

<div id="content">  <!-- div-3 -->
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 出勤資料建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pal/pali33/addsave" >	
	<!-- <div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $tc001=$this->input->post('tc001');
	  $palq01a=$this->input->post('palq01a');
	  $palq01adisp=$this->input->post('tc001');
	  $tc002=$this->input->post('tc002');
	  $cmsq05a=$this->input->post('cmsq05a');
	  $cmsq05adisp=$this->input->post('tc002');
	  
	   $tc003=$this->input->post('tc003');
	   if ($tc003 > '0') { $tc003=$this->input->post('tc003');} else { $tc003=date("Y/m");}
	   if (!isset($tc004)) { $tc004=0;} else { $tc004=$this->input->post('tc004');}
	   if (!isset($tc005)) { $tc005=0;} else { $tc005=$this->input->post('tc005');}
	   if (!isset($tc006)) { $tc006=0;} else { $tc006=$this->input->post('tc006');}
	   if (!isset($tc007)) { $tc007=0;} else { $tc007=$this->input->post('tc007');}
	   if (!isset($tc008)) { $tc008=0;} else { $tc008=$this->input->post('tc008');}
	   if (!isset($tc009)) { $tc009=0;} else { $tc009=$this->input->post('tc009');}
	   if (!isset($tc010)) { $tc010=0;} else { $tc010=$this->input->post('tc010');}
	   if (!isset($tc011)) { $tc011=0;} else { $tc011=$this->input->post('tc011');}
	   if (!isset($tc012)) { $tc012=0;} else { $tc012=$this->input->post('tc012');}
	   if (!isset($tc013)) { $tc013=0;} else { $tc013=$this->input->post('tc013');}
	   if (!isset($tc014)) { $tc014=0;} else { $tc014=$this->input->post('tc014');}
	   if (!isset($tc015)) { $tc015=0;} else { $tc015=$this->input->post('tc015');}
	   if (!isset($tc016)) { $tc016=0;} else { $tc016=$this->input->post('tc016');}
	   if (!isset($tc017)) { $tc017=0;} else { $tc017=$this->input->post('tc017');}
	   if (!isset($tc018)) { $tc018=0;} else { $tc018=$this->input->post('tc018');}
	   if (!isset($tc019)) { $tc019=0;} else { $tc019=$this->input->post('tc019');}
	   if (!isset($tc020)) { $tc020=0;} else { $tc020=$this->input->post('tc020');}
	   if (!isset($tc021)) { $tc021=0;} else { $tc021=$this->input->post('tc021');}
	   if (!isset($tc022)) { $tc022=0;} else { $tc022=$this->input->post('tc022');}
	   if (!isset($tc023)) { $tc023='';} else { $tc023=$this->input->post('tc023');}
	    if (!isset($tc201)) { $tc201='';} else { $tc201=$this->input->post('tc201');}
		if (!isset($tc202)) { $tc202='';} else { $tc202=$this->input->post('tc202');}
		if (!isset($tc203)) { $tc203='';} else { $tc203=$this->input->post('tc203');}
	//  if (!isset($tc014)) { $tc014=date("Y/m/d");}
	
	  
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="start14a" width="11%"><span class="required">員工代號：</span></td>
        <td class="normal14a" width="22%" ><input   tabIndex="1" id="tc001" onKeyPress="keyFunction()" onchange="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>"  type="text" required /><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="palq01adisp"> <?php    echo $palq01adisp; ?> </span></td>
	    <td class="start14a" width="11%"><span class="required">部門代號：</span></td>
        <td class="normal14a"  width="22%"> <input   tabIndex="2" id="tc002" onKeyPress="keyFunction()" onchange="startcmsq05a(this)" name="cmsq05a" value="<?php echo $cmsq05a; ?>"  type="text" required /><img id="Showcmsq05a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
         <span id="cmsq05adisp"> <?php    echo $cmsq05adisp; ?> </span></td>
       <td class="normal14a" width="11%">發薪年月： </td>
        <td class="normal14" width="23%"><input  tabIndex="3" onKeyPress="keyFunction()"   onchange="dataym1(this)"  id="tc003" name="tc003"  value="<?php echo $tc003; ?>"  type="text" style="background-color:#E7EFEF" /><span > <?php echo '輸入範例yyyymm'; ?> </span></td>
	  </tr>	
		
	  <tr>
        <td class="normal14" >遲到早退次：</td>
		<td class="normal14"><input  tabIndex="4" onKeyPress="keyFunction()" onfocus="this.select();"  id="tc004" name="tc004"  value="<?php echo $tc004; ?>"  type="text"  /></td>	   
	   <td  class="normal14" >未刷卡補正次：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" id="tc005"     onKeyPress="keyFunction()"    name="tc005" value="<?php echo $tc005; ?>"  /></td>	  
	    <td class="normal14">事假小時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="6" id="tc006"     onKeyPress="keyFunction()"    name="tc006" value="<?php echo $tc006; ?>"  /></td>
	  </tr>
	   <tr>
	    <td  class="normal14" >病假小時：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" id="tc007"      onKeyPress="keyFunction()"    name="tc007" value="<?php echo $tc007; ?>"  /></td>	  
	    <td class="normal14a">特休小時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="8" id="tc008"      onKeyPress="keyFunction()"    name="tc008" value="<?php echo $tc008; ?>"  /></td>
	    <td  class="normal14" >喪假天：</td>
        <td  class="normal14"  ><input type="text" tabIndex="9" id="tc009"     onKeyPress="keyFunction()"    name="tc009" value="<?php echo $tc009; ?>" /></td>	
	  </tr>
	   
	  <tr>
	    <td class="normal14">無薪假小時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="tc010"     onKeyPress="keyFunction()"    name="tc010" value="<?php echo $tc010; ?>"  /></td>
		<td  class="normal14" >產假天：</td>
        <td  class="normal14"  ><input type="text" tabIndex="11" id="tc011"     onKeyPress="keyFunction()"    name="tc011" value="<?php echo $tc011; ?>" /></td>	  
	    <td class="normal14" >陪產假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="12" id="tc012"     onKeyPress="keyFunction()"    name="tc012" value="<?php echo $tc012; ?>"  /></td>
	  </tr>
	   <tr>
	    <td class="normal14">產檢假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="tc201"     onKeyPress="keyFunction()"    name="tc201" value="<?php echo $tc201; ?>"  /></td>
		<td class="normal14">生理假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="tc202"     onKeyPress="keyFunction()"    name="tc202" value="<?php echo $tc202; ?>"  /></td>  
	    <td class="normal14">補休假時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="tc203"     onKeyPress="keyFunction()"    name="tc203" value="<?php echo $tc203; ?>"  /></td> 
	 </tr>
	  <tr>
	    <td  class="normal14" >婚假天：</td>
        <td  class="normal14"  ><input type="text" tabIndex="13" id="tc013"     onKeyPress="keyFunction()"    name="tc013" value="<?php echo $tc013; ?>" /></td>	  
	    <td class="normal14">公偒假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="14" id="tc014"     onKeyPress="keyFunction()"    name="tc014" value="<?php echo $tc014; ?>"  /></td>
	    <td  class="normal14" >曠職天：</td>
        <td  class="normal14"  ><input type="text" tabIndex="15" id="tc015"     onKeyPress="keyFunction()"    name="tc015" value="<?php echo $tc015; ?>" /></td>	
	  </tr>	  
	   <tr>
        <td class="normal14">公假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="16" id="tc016"     onKeyPress="keyFunction()"    name="tc016" value="<?php echo $tc016; ?>"  /></td>	   
	    <td  class="normal14a" >平常加班時：</td>
        <td  class="normal14"  ><input type="text" tabIndex="17" id="tc017"    onKeyPress="keyFunction()"    name="tc017" value="<?php echo $tc017; ?>"  /></td>	  
	    <td class="normal14">平常加班2小時上：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="18" id="tc018"    onKeyPress="keyFunction()"    name="tc018" value="<?php echo $tc018; ?>"  /></td>
	  </tr>
	  <tr>
        <td class="normal14">六加班時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="19" id="tc019"     onKeyPress="keyFunction()"    name="tc019" value="<?php echo $tc019; ?>"  /></td>	   
	    <td  class="normal14a" >六加班2~8小時：</td>
        <td  class="normal14"  ><input type="text" tabIndex="20" id="tc020"    onKeyPress="keyFunction()"    name="tc020" value="<?php echo $tc020; ?>"  /></td>	  
	    <td class="normal14">國日加班時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="21" id="tc021"    onKeyPress="keyFunction()"    name="tc021" value="<?php echo $tc021; ?>"  /></td>
	  </tr>
	   <tr>
	    <td class="normal14">國日加班8小時上：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="22" id="tc022"    onKeyPress="keyFunction()"    name="tc022" value="<?php echo $tc022; ?>"  /></td>
		<td  class="normal14" >備註：</td>
        <td  class="normal14" colspan="2" ><input type="text" tabIndex="23" id="tc023"     onKeyPress="keyFunction()"    name="tc023" value="<?php echo $tc023; ?>"  size="60"/></td>
        <td class="normal14"></td>		
        <td  class="normal14"  ></td>
	  </tr>
	</table>
	      
	<div class="buttons">
	<button tabIndex="8" type='submit' accesskey="s"   name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali33/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
 <?php include("./application/views/fun/pali33_funjs_v.php"); ?> 