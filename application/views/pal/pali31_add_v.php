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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 變動津貼建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pal/pali31/addsave" >	
	<!-- <div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $ta001=$this->input->post('ta001');
	  $palq01a=$this->input->post('palq01a');
	  $palq01adisp=$this->input->post('ta001');
	  $ta002=$this->input->post('ta002');
	  $cmsq05a=$this->input->post('cmsq05a');
	  $cmsq05adisp=$this->input->post('ta002');
	  
	   $ta003=$this->input->post('ta003');
	   if ($ta003 > '0') { $ta003=$this->input->post('ta003');} else { $ta003=date("Y/m");}
	   if (!isset($ta004)) { $ta004=0;} else { $ta004=$this->input->post('ta004');}
	   if (!isset($ta005)) { $ta005=0;} else { $ta005=$this->input->post('ta005');}
	   if (!isset($ta006)) { $ta006=0;} else { $ta006=$this->input->post('ta006');}
	   if (!isset($ta007)) { $ta007=0;} else { $ta007=$this->input->post('ta007');}
	   if (!isset($ta008)) { $ta008=0;} else { $ta008=$this->input->post('ta008');}
	   if (!isset($ta009)) { $ta009=0;} else { $ta009=$this->input->post('ta009');}
	   if (!isset($ta010)) { $ta010=0;} else { $ta010=$this->input->post('ta010');}
	   if (!isset($ta011)) { $ta011=0;} else { $ta011=$this->input->post('ta011');}
	   if (!isset($ta012)) { $ta012='';} else { $ta012=$this->input->post('ta012');}
	   if (!isset($ta014)) { $ta014='';} else { $ta014=$this->input->post('ta014');}
	   if (!isset($ta015)) { $ta015='';} else { $ta015=$this->input->post('ta015');}
	   if (!isset($ta016)) { $ta016='';} else { $ta016=$this->input->post('ta016');}
	   if (!isset($ta017)) { $ta017='';} else { $ta017=$this->input->post('ta017');}
	
	//  if (!isset($ta014)) { $ta014=date("Y/m/d");}
	
	  
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="start14a" width="15%"><span class="required">員工代號：</span></td>
        <td class="normal14a" width="35%" ><input   tabIndex="1" id="ta001" onKeyPress="keyFunction()" onchange="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>" type="text" required /><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="palq01adisp"> <?php echo $palq01adisp; ?> </span></td>
	    <td class="start14a" width="15%"><span class="required">部門代號：</span></td>
        <td class="normal14a"  width="35%"> <input   tabIndex="2" id="ta002" onKeyPress="keyFunction()" onchange="startcmsq05a(this)" name="cmsq05a" value="<?php echo $cmsq05a; ?>" type="text" required /><img id="Showcmsq05a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
         <span id="cmsq05adisp"> <?php echo $cmsq05adisp; ?> </span></td>
	  </tr>	
	  <tr>
	    <td class="start14a">發薪年月：</td>
        <td class="normal14"><input tabIndex="3" onKeyPress="keyFunction()"  onfocus="this.select()" onchange="dataym1(this)" id="ta003" name="ta003" value="<?php echo $ta003; ?>" type="text" style="background-color:#E7EFEF" /><span > <?php echo '輸入範例yyyymm'; ?> </span></td>
		<td class="normal14">追補：</td>
		<td class="normal14"><input tabIndex="4" onKeyPress="keyFunction()" id="ta004" onfocus="this.select()" name="ta004" value="<?php echo $ta004; ?>" type="text" /></td>	
	  </tr>
	  <tr>
	    <td class="normal14">仲介服務費：</td>
        <td class="normal14"><input type="text" tabIndex="5" id="ta005" onfocus="this.select()" onKeyPress="keyFunction()" name="ta005" value="<?php echo $ta005; ?>" /></td>	  
	    <td class="normal14">其他加項1：</td>		
        <td class="normal14"><input type="text" tabIndex="11" id="ta006" onfocus="this.select()" onKeyPress="keyFunction()" name="ta006" value="<?php echo $ta006; ?>" /></td>
	  </tr>
	   <tr>
	    <td class="normal14a">食宿費：</td>		
        <td class="normal14"><input type="text" tabIndex="6" id="ta008"  onfocus="this.select()" onKeyPress="keyFunction()" name="ta008" value="<?php echo $ta008; ?>" /></td>
		<td class="normal14">其他加項2：</td>
        <td class="normal14"><input type="text" tabIndex="12" id="ta007"  onfocus="this.select()" onKeyPress="keyFunction()" name="ta007" value="<?php echo $ta007; ?>" /></td>	  
	  </tr>
	   <tr>
	    <td class="normal14">居留證費用：</td>
        <td class="normal14"><input type="text" tabIndex="7" id="ta014"  onfocus="this.select()" onKeyPress="keyFunction()" name="ta014" value="<?php echo $ta014; ?>" /></td>	  
	    <td class="normal14">其他減項2：</td>
        <td class="normal14"><input type="text" tabIndex="13" id="ta009"  onfocus="this.select()" onKeyPress="keyFunction()" name="ta009" value="<?php echo $ta009; ?>" /></td>	  
	  </tr>
	   <tr>
	    <td class="normal14">機票費用：</td>
        <td class="normal14"><input type="text" tabIndex="8" id="ta016"  onfocus="this.select()" onKeyPress="keyFunction()" name="ta016" value="<?php echo $ta016; ?>" /></td>	  
	    <td class="normal14">違規扣款：</td>		
        <td class="normal14"><input type="text" tabIndex="14" id="ta017"  onfocus="this.select()" onKeyPress="keyFunction()" name="ta017" value="<?php echo $ta017; ?>" /></td>
	  </tr>
	   <tr> 
	    <td class="normal14">水電費：</td>		
        <td class="normal14"><input type="text" tabIndex="9" id="ta010"  onfocus="this.select()" onKeyPress="keyFunction()" name="ta010" value="<?php echo $ta010; ?>" /></td>
		<td class="normal14">體檢費用：</td>		
        <td class="normal14"><input type="text" tabIndex="15" id="ta015"  onfocus="this.select()" onKeyPress="keyFunction()" name="ta015" value="<?php echo $ta015; ?>" /></td>
	  </tr>
	   <tr>
	    <td class="normal14a">破月伙食費：</td>
        <td class="normal14"><input type="text" tabIndex="10" id="ta011"  onfocus="this.select()" onKeyPress="keyFunction()" name="ta011" value="<?php echo $ta011; ?>" /></td>	  
	    <td class="normal14"></td>		
        <td class="normal14"></td>
	  </tr>
	   <tr>
	    <td class="normal14">備註：</td>
        <td class="normal14"><input type="text" tabIndex="16" id="ta012"  onfocus="this.select()" onKeyPress="keyFunction()" name="ta012" value="<?php echo $ta012; ?>" size="60"/></td>
	    <td class="normal14"></td>		
        <td class="normal14"></td>
	  </tr>
	</table>
	      
	<div class="buttons">
	<button tabIndex="8" type='submit' accesskey="s"   name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali31/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> 
	  
    </form>
   </div> <!-- div-6 --> 
    </div> <!-- div-5 -->	
</div> <!-- div-4 -->
   
  <?php	if ($message=='資料重複!') { ?>
   <script> alert("資料重複!");  </script> 
  <?php } ?>
  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div>  <!-- div-3 -->
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
 <?php include("./application/views/fun/pali31_funjs_v.php"); ?> 