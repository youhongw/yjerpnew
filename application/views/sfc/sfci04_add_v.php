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

<div id="content"> <!-- div-3 --> 
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 製造命令建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/moc/moci02/addsave" >	
	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  if(!isset($mocq01a51)) { $mocq01a51=$this->input->post('ta001'); }
	 
	  if(!isset($mocq01a51disp)) { $mocq01a51disp=$this->input->post('ta001'); }

      $ta002=$this->input->post('ta002');
	   if(!isset($ta003)) { $ta003=date("Y/m/d"); }
	//  $ta003=date("Y/m/d");
	//   $ta004=$this->input->post('ta004');
	  if(!isset($ta004)) { $ta004=date("Y/m/d"); }
	   $ta005=$this->input->post('ta005');
	  $invq02a1=$this->input->post('ta006'); 
	  $invq02a1disp=$this->input->post('ta006'); 
	
	  $ta007=$this->input->post('ta007');
	//  if(!isset($ta014)) { $ta014=date("Y/m/d"); }
	  if(!isset($ta031)) { $ta031=0; }
       
	  if(!isset($ta013)) { $ta013='Y'; }
	  if(!isset($ta030)) { $ta030='1'; }
	  if(!isset($ta011)) { $ta011='1'; }
	   if(!isset($ta013)) { $ta013='Y'; }
	   
	   $ta034=$this->input->post('ta034');
	   $ta035=$this->input->post('ta035');
	   if(!isset($ta044)) { $ta044='N'; }
	/*  $ta020=$this->input->post('ta020');
	  $ta028=$this->input->post('ta028');
	  $ta019=$this->input->post('ta019');
	  $ta026=$this->input->post('ta026');
	  
	  $ta031=$this->input->post('ta031');
	  $ta032=$this->input->post('ta032'); */
	?>
	 <?php
	 
	  // if(!isset($ta007)) { $ta007=0.05; }sysma003 幣別 sysma004 匯率
	 //  $cmsq06a=$this->session->userdata('sysma003');
	 //  $ta030=$this->session->userdata('sysma004');
	   $ta015=$this->input->post('ta015');
	   $ta016=$this->input->post('ta016');
	   $ta017=$this->input->post('ta017');
	   $ta018=$this->input->post('ta018');
	   
	   $ta009=$this->input->post('ta009');
	   $ta010=$this->input->post('ta010');
	   $ta012=$this->input->post('ta012');
	   $ta014=$this->input->post('ta014');
	   	   
	   if(!isset($ta004)) { $ta004=date("Y/m/d"); }
	   if(!isset($ta013)) { $ta013='Y'; }
	   if(!isset($ta040)) { $ta040=date("Y/m/d"); }
	   $ta041=$this->session->userdata('manager');
	    if(!isset($ta049)) { $ta049='N'; }
	  // $ta049=$this->input->post('ta049');
	    if(!isset($ta013)) { $ta013='Y'; }
	 
	  ?>
	   <?php
	   $cmsq02a=$this->input->post('ta019');
	   $cmsq02adisp=$this->input->post('ta019');
	   $cmsq03a=$this->input->post('ta020');
	    $cmsq03adisp=$this->input->post('ta020');
	   $cmsq04a=$this->input->post('ta021');
	    $cmsq04adisp=$this->input->post('ta021');
	   $purq01a=$this->input->post('ta032');
	   $purq01adisp=$this->input->post('ta032');
	   $cmsq06a=$this->session->userdata('sysma003');
	   $cmsq06adisp=$this->session->userdata('sysma003');
	   $ta043=$this->session->userdata('sysma004');
	   
	   $ta022=$this->input->post('ta022');
	   $ta023=$this->input->post('ta023');
	  ?>
	    <?php
	   $ta033=$this->input->post('ta033');
	   $ta024=$this->input->post('ta024');
	   $ta025=$this->input->post('ta025');
	   $copq06a=$this->input->post('ta026');
	   $copq06adisp=$this->input->post('ta026');
	   $ta027=$this->input->post('ta027');
	   $ta028=$this->input->post('ta028');
	   $ta029=$this->input->post('ta029');
	   
	  ?>
	  
  <?php IF ($this->uri->segment(3)=='copybefore') {  ?>
   <?php $ii=0;$ta028=0;$ta019=0;$ta031=0;$ta032=0;$ta026=0; ?>
	<?php foreach($result as $row) { ?>
		  <?php   $invq02a1=$row->mc001;?>  
		  <?php   $ta015=$this->session->userdata('vta015');?> 
		   <?php   $mocq01a51=$this->session->userdata('vta001');?> 
		    <?php   $ta002=$this->session->userdata('vta002');?> 
		   <?php     $ta004=date("Y/m/d");  ?> 
		   <?php   $cmsq03a=$this->session->userdata('sysma203');?> 
		  <?php     $cmsq06a=$this->session->userdata('sysma003');?>
	     <?php     $ta043=1 ;?>
		   <?php   $ta024=$this->session->userdata('vta001');?> 
		    <?php   $ta025=$this->session->userdata('vta002');?> 
			
			 <?php   $ta034=$row->md001disp;?>  
			  <?php  $ta035=$row->md001disp1;?> 
               <?php  $ta007=$row->md001disp2;?> 			  
			<?php  // $ta034=urldecode(urldecode($this->session->userdata('vta034')));?> 
		    <?php //  $ta035=urldecode(urldecode($this->session->userdata('vta035')));?> 
			<?php //  $ta007=urldecode(urldecode($this->session->userdata('vta007')));?> 
		   <?php   $flag=$row->flag;?>	
		
		 <!-- 明細 -->
		    <?php   $tb001[]='';?>
			<?php  $tb002[]='';?>
			<?php  $tb003[]=$row->md003;?>
		   <?php   $tb012[]=$row->md003disp;?>
		   <?php   $tb013[]=$row->md003disp1;?>
		   <?php   $tb007[]=$row->md003disp2;?>
		   <?php   $tb008[]=$row->md002;?> 
		   <?php   $tb004[]=round($row->md006*$this->session->userdata('vta015'),0);?>
		   <?php   $tb015[]=date("Ymd");?> 
		   <?php  $tb009[]=$this->session->userdata('vta009');?>
		   <?php  $tb009disp[]='';?>
		    <?php  $tb005[]='0';?>
			<?php  $tb016[]=round($row->md006*$this->session->userdata('vta015'),0);?>
		   <?php   $tb011[]=$row->md017;?> 
		   <?php   $tb017[]=$row->md016;?>   
            <?php  $tb010[]='';?>		   
		  <?php   $mb991=' ';?>
		  <?php   $mb992=' ';?>
		  <?php   $mb999=' ';?>
	<?php $ii = $ii + 1 ; 	}?>
        	
   <?php } ?>
   <?php 
	  if(!isset($sysma200)) { $sysma200=$this->session->userdata('sysma200'); }
	  if(!isset($sysma201)) { $sysma201=$this->session->userdata('sysma201'); }  ?>
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="8%"><span class="required">製令單別：</span> </td>
        <td class="normal14a"  width="25%"><input tabIndex="1" id="ta001"    onKeyPress="keyFunction()"  onfocus="selappr()" onChange="startmocq01a51(this)"  name="mocq01a51" value="<?php echo strtoupper($mocq01a51); ?>"  type="text" required /><a href="javascript:;"><img id="Showmocq01a51" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="mocq01a51disp"> <?php    echo $mocq01a51disp; ?> </span></td>
	    <td class="normal14a" width="8%" >開單日期： </td>
        <td class="normal14a"  width="25%" ><input tabIndex="2"  onclick="scwShow(this,event);" onfocus="selappr()"  id="ta003" onKeyPress="keyFunction()"  onchange="chkno1(this)" name="ta003"  value="<?php echo $ta003; ?>"  size="12" type="text"  style="background-color:#E7EFEF" /></td>
	    <td class="start14a" width="9%"><span class="required">製令單號：</span></td>
        <td class="normal14a" width="25%"><input tabIndex="3" id="ta002" onKeyPress="keyFunction()" onfocus="chkno1(this)" name="ta002" value="<?php echo $ta002; ?>" size="30" type="text" required /><span id="ta002disp" ></span></td>
	  </tr>	
	  <tr>
		 <td class="normal14a">產品品號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="ta006" onKeyPress="keyFunction()" onfocus="chkno1(this)" onchange="startinvq02a1(this)" name="invq02a1" value="<?php echo $invq02a1; ?>" size="20" type="text"  /><img id="Showinvq02a1" src="<?php echo base_url()?>assets/image/png/distance.png" alt="" align="top"/></a>
        <span id="invq02a1disp"> <?php   echo $invq02a1disp; ?> </span></td>
        <td class="normal14a" >品名：</td>
        <td class="normal14a" ><input tabIndex="5" id="ta034" onKeyPress="keyFunction()"  name="ta034" value="<?php echo $ta034; ?>" size="30" type="text" style="background-color:#EBEBE4" /></td>	 
         <td class="normal14a" >規格：</td>
        <td class="normal14a" ><input tabIndex="6" id="ta035" onKeyPress="keyFunction()"  name="ta035" value="<?php echo $ta035; ?>" size="30" type="text" style="background-color:#EBEBE4" /></td>	 	
	</tr>
		
	  <tr>
	    <td class="normal14a" >單位：</td>
        <td class="normal14a" ><input tabIndex="7" id="ta007" onKeyPress="keyFunction()"  name="ta007" value="<?php echo $ta007; ?>" size="10" type="text" style="background-color:#EBEBE4" /></td>
	     <td class="normal14">性質：</td>
       <td  class="normal14"  ><select id="ta030" onKeyPress="keyFunction()" name="ta030"  tabIndex="8">
            <option <?php if($ta030 == '1') echo 'selected="selected"';?> value='1'>1廠內製令</option>                                                                        
		    <option <?php if($ta030 == '2') echo 'selected="selected"';?> value='2'>2託外製令</option>
		  </select></td>
	   <td class="normal14">狀態碼：</td>
          <td  class="normal14"  ><select id="ta011" onKeyPress="keyFunction()" name="ta011"  tabIndex="9">
            <option <?php if($ta011 == '1') echo 'selected="selected"';?> value='1'>1未生產</option>                                                                        
		    <option <?php if($ta011 == '2') echo 'selected="selected"';?> value='2'>2已發料</option>
			<option <?php if($ta011 == '3') echo 'selected="selected"';?> value='3'>3生產中</option>
		    <option <?php if($ta011 == 'Y') echo 'selected="selected"';?> value='Y'>Y已完工</option>
			<option <?php if($ta011 == 'y') echo 'selected="selected"';?> value='y'>y指定完工</option>
		  </select></td>
	  </tr>
	    <tr>
	     <td class="normal14">急料：</td>
        <td  class="normal14"  ><input type="hidden" name="ta044" value="N" />
		<input type='checkbox' tabIndex="10" id="ta044" onKeyPress="keyFunction()" name="ta044" <?php if($ta044 == 'Y' ) echo 'checked'; ?>  <?php if($ta044 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
	   <td class="normal14">確認碼：</td>
          <td  class="normal14"  ><select id="ta013" onKeyPress="keyFunction()" name="ta013" onChange="selappr(this)" tabIndex="6">
            <option <?php if($ta013 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($ta013 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($ta013 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td> 
		<td class="normal14a" >列印：</td>
        <td class="normal14a" ><input tabIndex="12" id="ta031" onKeyPress="keyFunction()"  name="ta031" value="<?php echo $ta031; ?>" size="10" type="text" style="background-color:#EBEBE4" /></td>
		  <td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" /></td>
         <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" /></td>
	  </tr>
	  
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
		<li><a href="#tab1">時程產量</a></li>
		<li><a href="#tab2">廠內託外</a></li>
		<li><a href="#tab3">進階資料</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  時程資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	 
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14a"  width="8%" > 預計產量：</td>
       <td class="normal14a"  width="25%" ><input type="text" tabIndex="13" id="ta015"    onKeyPress="keyFunction()"    name="ta015" value="<?php echo $ta015; ?>"  /></td>
	   <td class="normal14a"  width="8%" > 預計開工：</td>
       <td class="normal14a"  width="25%" ><input type="text" tabIndex="14" id="ta009"   onclick="scwShow(this,event);"   onKeyPress="keyFunction()"    name="ta009" value="<?php echo $ta009; ?>"  style="background-color:#E7EFEF"/></td>
	   <td class="normal14a"  width="9%" > BOM日期：</td>
       <td class="normal14a"  width="25" ><input type="text" tabIndex="15" id="ta004"  onclick="scwShow(this,event);" onKeyPress="keyFunction()"    name="ta004" value="<?php echo $ta004; ?>" style="background-color:#E7EFEF" /></td>
	 </tr>	
	 <tr>
	   <td class="normal14a"  > 已領套數：</td>
       <td class="normal14a"  ><input type="text" tabIndex="16" id="ta016"    onKeyPress="keyFunction()"    name="ta016" value="<?php echo $ta016; ?>"  /></td>
	   <td class="normal14a"  > 預計完工：</td>
       <td class="normal14a"  ><input type="text" tabIndex="17" id="ta010"   onclick="scwShow(this,event);"   onKeyPress="keyFunction()"    name="ta010" value="<?php echo $ta010; ?>"  style="background-color:#E7EFEF"/></td>
	   <td class="normal14a"  > 確認日：</td>
       <td class="normal14a"  ><input type="text" tabIndex="18" id="ta040"   onKeyPress="keyFunction()"    name="ta040" value="<?php echo $ta040; ?>"  /></td>
	 </tr>
	  <tr>
	   <td class="normal14a"  > 已生產數：</td>
       <td class="normal14a"  ><input type="text" tabIndex="19" id="ta017"    onKeyPress="keyFunction()"    name="ta017" value="<?php echo $ta017; ?>"  /></td>
	   <td class="normal14a"  > 實際開工：</td>
       <td class="normal14a"  ><input type="text" tabIndex="20" id="ta012"   onclick="scwShow(this,event);"   onKeyPress="keyFunction()"    name="ta012" value="<?php echo $ta012; ?>" style="background-color:#E7EFEF" /></td>
	   <td class="normal14a"  > 確認者：</td>
       <td class="normal14a"  ><input type="text" tabIndex="21" id="ta041"   onKeyPress="keyFunction()"    name="ta041" value="<?php echo $ta041; ?>"  /></td>
	 </tr>
	<tr>
	   <td class="normal14a"  > 報廢數量：</td>
       <td class="normal14a"  ><input type="text" tabIndex="22" id="ta018"    onKeyPress="keyFunction()"    name="ta018" value="<?php echo $ta018; ?>"  /></td>
	   <td class="normal14a"  > 實際完工：</td>
       <td class="normal14a"  ><input type="text" tabIndex="23" id="ta014"   onclick="scwShow(this,event);"   onKeyPress="keyFunction()"    name="ta014" value="<?php echo $ta014; ?>" style="background-color:#E7EFEF" /></td>
	    <td  class="normal14" >簽核狀態：</td>
        <td class="normal14"><select id="ta049" tabIndex="24" readonly="value" onKeyPress="keyFunction()" name="ta049"   style="background-color:#EBEBE4" disabled="disabled">
            <option <?php if($ta049 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($ta049 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($ta049 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($ta049 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($ta049 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($ta049 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($ta049 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($ta049 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
	 </tr> 
	</table>
	</div>
	
<!--	
	<!--  廠內託外 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14a"  width="10%">生產廠別：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="25" onKeyPress="keyFunction()" id="ta019"  onchange="startcmsq02a(this)" name="cmsq02a"   value="<?php echo  $cmsq02a; ?>"     /><a href="javascript:;"><img id="Showcmsq02a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	   <span id="cmsq02adisp"> <?php    echo $cmsq02adisp; ?> </span></td>
	   <td class="normal14a"  width="10%" >幣別：</td>
       <td class="normal14a"  width="40%" ><input tabIndex="26" id="ta042" onKeyPress="keyFunction()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
       <span id="cmsq06adisp" > <?php    echo $cmsq06adisp; ?> </span></td>
	 </tr>	
	   <tr>
	    <td  class="normal14" >入庫庫別：</td>
        <td  class="normal14"  ><input tabIndex="27" id="ta020" onKeyPress="keyFunction()" name="cmsq03a" onchange="startcmsq03a(this)"  value="<?php echo $cmsq03a; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq03a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
       <span id="cmsq03adisp" > <?php    echo $cmsq03adisp; ?> </span></td>	   
	    <td  class="normal14">匯率：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="28" id="ta043"  onKeyPress="keyFunction()"   name="ta043" value="<?php echo $ta043; ?>"   /></td>
	  </tr>
	   <tr>
	    <td  class="normal14" >生產線別：</td>
        <td  class="normal14"  ><input tabIndex="29" id="ta021" onKeyPress="keyFunction()" name="cmsq04a" onchange="startcmsq04a(this)"  value="<?php echo $cmsq04a; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq04a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
       <span id="cmsq04adisp" > <?php    echo $cmsq04adisp; ?> </span></td>	   
	    <td  class="normal14">加工單價：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="30" id="ta022"  onKeyPress="keyFunction()"   name="ta022" value="<?php echo $ta022; ?>"   /></td>
	  </tr>
       <tr>
	    <td  class="normal14" >加工廠商：</td>
        <td  class="normal14"  ><input tabIndex="31" id="tg032" onKeyPress="keyFunction()" name="purq01a" onchange="startpurq01a(this)"  value="<?php echo $purq01a; ?>"  type="text"   /><a href="javascript:;"><img id="Showpurq01a" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
       <span id="purq01adisp" > <?php    echo $purq01adisp; ?> </span></td>	   
	    <td  class="normal14">加工單位：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="32" id="ta023"  onKeyPress="keyFunction()"   name="ta023" value="<?php echo $ta023; ?>"   /></td>
	  </tr>	  
	  
	</table>
 
	</div> 	
	<!--  進階資料 -->
	<div id="tab3" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14a"  width="10%">母製令單別：</td>
       <td class="normal14a"  width="24%" ><input type="text" tabIndex="33"   onKeyPress="keyFunction()" id="ta024" name="ta024"   value="<?php echo $ta024; ?>"   /></td>
	   <td class="normal14a"  width="10%" >母製令單號：</td>
       <td class="normal14a"  width="24%" ><input type="text" tabIndex="34"   onKeyPress="keyFunction()" id="ta025" name="ta025"   value="<?php echo $ta025; ?>"   /></td>
       <td  class="normal14a" width="8%"></td>	
       <td  class="normal14a" width="24%"></td>		   
	</tr>
	  <tr>
	   <td class="normal14" >訂單單別：</td>
       <td class="normal14"  ><input tabIndex="35" id="ta026" onKeyPress="keyFunction()" name="copq06a" onchange="startcopq06a(this)"  value="<?php echo $copq06a; ?>"  type="text"   /><a href="javascript:;"><img id="Showcopq06a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
       <span id="copq06adisp" > <?php    echo $copq06adisp; ?> </span></td>	
	   <td class="normal14"  >訂單單號：</td>
       <td class="normal14"   ><input type="text" tabIndex="36"   onKeyPress="keyFunction()" id="ta027" name="ta027"   value="<?php echo $ta027; ?>"   /></td>
	   <td class="normal14"  >訂單序號：</td>
       <td class="normal14"   ><input type="text" tabIndex="37"   onKeyPress="keyFunction()" id="ta028" name="ta028"   value="<?php echo $ta028; ?>"   /></td>
	 </tr>
	   <tr>
	    <td  class="normal14" >計劃批號：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="38" id="ta033"  onKeyPress="keyFunction()"   name="ta033" value="<?php echo $ta033; ?>"   /></td>	   
	    <td  class="normal14">備註：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="39" id="ta029"  onKeyPress="keyFunction()"   name="ta029" value="<?php echo $ta029; ?>"   /></td>
	     <td  class="normal14a" ></td>	
       <td  class="normal14a" ></td>		   
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
		      <td width="8%" class="center">材料品號</td>
              <td width="8%" class="left">品名</td>
			  <td width="8%" class="left">規格</td>  
			  <td width="6%" class="center">單位</td>
			  <td width="6%" class="center">序號</td>
			  <td width="6%" class="left">交貨庫別</td>
		 	  <td width="6%" class="left">庫別名稱</td> 
              <td width="6%" class="center">需領用量</td>
              <td width="6%" class="right">已領用量</td>
              <td width="6%" class="right">未領用量</td>
			  <td width="6%" class="center">材料型態</td>
              <td width="6%" class="right">取替代件</td>
              <td width="6%" class="right">預計領料</td>
			  <td width="13%" class="center">備註</td>
			  
            </tr>
        </thead>
	
	<?php IF ($this->uri->segment(3)=='copybefore') {  ?>

        	<!--   明細0  --> 
		<?php $i=0; $mproduct_row=0; $product_row='0'; ?>  
			 
		<?php while ($i<$ii) { ?>
		<tbody  <?php echo 'id='.'product-row'.$product_row ?> >		
	     <tr>
	     <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td>
  	     <input type="hidden"  name="order_product[<?php echo $i ?>][tb001]" value="<?php echo $tb001[$i]; ?>" />
	     <input type="hidden" name="order_product[<?php echo $i ?>][tb002]" value="<?php echo $tb002[$i]; ?>" />
	     <td class="left"><input type="text"  <?php echo 'id='.'tb003'.$i ?>   name="order_product[<?php echo $i ?>][tb003]" value="<?php echo $tb003[$i]; ?>" size="20" style="background-color:#E7EFEF"  /></td>
	     <td class="left"><input  type="text"  onKeyPress="keyFunction()"  id="tb012"  name="order_product[<?php echo $i ?>][tb012]" value="<?php echo $tb012[$i]; ?>"  style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text"  onKeyPress="keyFunction()"  id="tb013"   name="order_product[<?php echo $i ?>][tb013]" value="<?php echo $tb013[$i]; ?>"  size="30" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input  type="text"  onKeyPress="keyFunction()"    id="tb007"   name="order_product[<?php echo $i ?>][tb007]" value="<?php echo $tb007[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text"   readonly="value"   name="order_product[$i][tb008]" value="<?php echo $tb008[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>  
		 <td class="left"><input type="text"   <?php echo 'id='.'tb009'.$i ?>   name="order_product[<?php echo $i ?>][tb009]" value="<?php echo $tb009[$i]; ?>" size="10" style="background-color:#E7EFEF"  /></td>
		<td class="left"><input  type="text"  onKeyPress="keyFunction()"  id="tb009disp"  name="order_product[<?php echo $i ?>][tb009disp]" value="<?php echo $tb009disp[$i]; ?>"  style="background-color:#EBEBE4" /></td>
	<!--	<td class="left"><input type="text"   onclick="scwShow(this,event);"  id="tb014[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb014]" value="<?php echo  substr($td012[$i],0,4).'/'.substr($td012[$i],4,2).'/'.substr($td012[$i],6,2); ?>" size="10"  class="date"  /></td> --> 
	     <td class="center"><input type="text"  class="total_qty" id="tb004" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb004]" value="<?php echo $tb004[$i]; ?>" size="3" style="text-align:right;" /></td>
		 <td class="center"><input type="text"  class="total_price" id="tb005" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb005]" value="<?php echo $tb005[$i]; ?>" size="3" style="text-align:right;" /></td>
		 
		 <td class="center"><input type="text"  id="tb016" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb016]" value="<?php echo $tb016[$i]; ?>" size="3" style="text-align:right;" /></td>
      <!-- <td class="center"><input type="text"   id="tb011" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb011]"  value="<?php echo $tb011[$i]; ?>" size="6" style="text-align:right;"  /></td> -->	
		    <td class="left"><select id="tb011" tabIndex="52" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb011]"  ><option  value="1">1.直接材料</option><option value="2">2.間接材料</option><option  value="3">3.廠商供應</option><option  value="4">4.不發料</option><option  value="5">5.客戶供料</option></select></td>
         <td class="right"><input readonly="value" type="text"  name="order_product[<?php echo $i ?>][tb010]" value="<?php echo $tb010[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" /></td>
		<td class="left"><input type="text"   onclick="scwShow(this,event);"  id="tb015[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb015]" value="<?php echo  substr($tb015[$i],0,4).'/'.substr($tb015[$i],4,2).'/'.substr($tb015[$i],6,2); ?>" size="10"  class="date"  /></td>
		 <td class="left"><input type="text" id="tb017"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb017]" value="<?php echo $tb017[$i]; ?>" size="20"  /></td>
	     </tr>	    
        </tbody>
        <?php $i++; $mproduct_row = (int) $product_row + 1; $product_row=(string)$mproduct_row;?>		
 <?php } ?>		 
    <!-- javascrit 0 -->	
	
	<?php   } ?>	
    
	<?php IF ($this->uri->segment(3)=='copybefore') {  ?>
		<?php include("./application/views/fun/moci02_funjsupdjs_v.php"); ?> 
		 <?php   } ?>	
          <tfoot>
		 
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="15"></td>
            </tr>
          </tfoot>
       </table>
	</div> 	
	<!-- 合計     -->
		 <!--    <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span>
				
				</span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣未稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta028' id="ta028" size="8" value="<?php echo $ta028; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta019' id="ta019" size="8" value="<?php echo $ta019; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣合計：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot"><?php echo $ta028+$ta019; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣未稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta031' id="ta031" size="8" value="<?php echo $ta031; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta032' id="ta032" size="8" value="<?php echo $ta032; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣合計：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot1"><?php echo $ta031+$ta032; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　合計數量：</b></td>
				<td ><input type='text' readonly="value" name='ta026' id="ta026" size="8" value="<?php echo $ta026; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>  -->
		<!-- 合計     -->	  
	 <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('moc/moci02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 <b style="color: #FF0000;"><span>　BOM展開方式　</span></b><a  href="javascript:;"><img id="Showbomc02a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/>
	 </div> 
		</div> 	   
    </form>
	   <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位,交貨庫別,可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
	
    </div> <!-- div-6 -->
	
  </div> <!-- div-5 -->
 
</div> <!-- div-4 -->

 
   
	</div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
     <?php include("./application/views/fun/moci02_funjs_v.php"); ?> 