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

<div id="content"> <!-- div-3 --> 
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 進貨單資料建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pur/puri09/addsave" >	
	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  if(!isset($purq04a34)) { $purq04a34=$this->input->post('tg001'); }
	//  $purq04a33=$this->input->post('tg001'); 
	 if(!isset($purq04a34disp)) { $purq04a34disp=$this->input->post('tg001'); }
	//  $purq04a33disp=$this->input->post('tg001'); 
      $tg002=$this->input->post('tg002');
	  $tg003=date("Y/m/d");
	  $purq01a=$this->input->post('tg005'); 
	  $purq01adisp=$this->input->post('tg005'); 
	//  $tg013=$this->input->post('tg013');	 
	//  $tg014=$this->input->post('tg014');
	  $tg007=$this->input->post('tg007');
	  if(!isset($tg014)) { $tg014=date("Y/m/d"); }
	  if(!isset($tg003)) { $tg003=date("Y/m/d"); }
       
	  if(!isset($tg013)) { $tg013='Y'; }
	
	  $tg020=$this->input->post('tg020');
	  $tg028=$this->input->post('tg028');
	  $tg019=$this->input->post('tg019');
	  $tg026=$this->input->post('tg026');
	  
	  $tg031=$this->input->post('tg031');
	  $tg032=$this->input->post('tg032');
	?>
	 <?php
	   $tg025=$this->input->post('tg025');
	   $tg006=$this->input->post('tg006');
	  // if(!isset($tg007)) { $tg007=0.05; }
	   $cmsq06a=$this->session->userdata('sysma003');
	   $tg030=$this->session->userdata('sysma004');
	   
	  // $tg012=$this->input->post('tg012');
	    if(!isset($tg012)) { $tg012=0; }
	  // $tg042=$this->input->post('tg042');
	   if(!isset($tg042)) { $tg042='N'; }
	//   $tg008=$this->input->post('tg008');
	   if(!isset($tg008)) { $tg008=1; }
	   $tg016=$this->input->post('tg016');
	 
	   $cmsq09a4=$this->input->post('tg011');
	   $cmsq09a4disp=$this->input->post('tg011');
	   
	    $cmsq02a=$this->input->post('tg004');
	    $cmsq02adisp=$this->input->post('tg004');
	  //  $cmsq06a=$this->input->post('tg007');
		IF (!isset($cmsq06a)) { $cmsq06a=$this->session->userdata('sysma003');}
	    $cmsq06adisp=$this->input->post('tg007');
		$cmsq21a1=$this->input->post('tg033');
	    $cmsq21a1disp=$this->input->post('tg033');
	  ?>
	   <?php
	   $tg022=$this->input->post('tg022');
	   $tg011=$this->input->post('tg011');
	   $tg009=$this->input->post('tg009');
	   $tg010=$this->input->post('tg010');
	   $tg027=$this->input->post('tg027');
	   $tg023=$this->input->post('tg023');
	   $tg029=$this->input->post('tg029');
	  // $tg030=$this->input->post('tg030'); 稅率
	    if(!isset($tg030)) { $tg030=$this->session->userdata('sysma004'); }
	   $tg024=$this->input->post('tg024');
	   $tg043=$this->input->post('tg043');
	  ?>
	    <?php
	   $tg034=$this->input->post('tg034');
	   $tg035=$this->input->post('tg035');
	   $tg036=$this->input->post('tg036');
	   $tg037=$this->input->post('tg037');
	   $tg038=$this->input->post('tg038');
	   $tg039=$this->input->post('tg039');
	   
	  ?>
	  
  <?php IF ($this->uri->segment(3)=='copybefore') {  ?>
   <?php $ii=0;$tg028=0;$tg019=0;$tg031=0;$tg032=0;$tg026=0; ?>
	<?php foreach($result as $row) { ?>
      
	      <?php if (!@$otg001) {$otg001='';} ?>
		  <?php if (!@$otg002) {$otg002='';} ?>
		  <?php if (!@$otg014) {$otg014='';} ?>
		  <!--   記住單別,單號, 日期         -->
	      <?php $purq04a34=$otg001; ?>
		   <?php $tg002=$otg002; ?>
		    <?php $tg014=substr($otg014,0,4).'/'.substr($otg014,4,2).'/'.substr($otg014,6,2);?>
			
		  <?  $tg034=$row->tc001;?>  
          <?  $tg035=$row->tc002;?>      
          <?  $tc003=substr($row->tc003,0,4).'/'.substr($row->tc003,4,2).'/'.substr($row->tc003,6,2);?>
          <?  $purq01a=$row->tc004;?>
		  <?  $tg008=$row->tc006;?>    
		  <?  $tg010=$row->tc018;?>    
		  <?  $tc025=$row->tc025;?>
          <?  $tc030=$row->tc030;?>
		  <?  $tc024=substr($row->tc024,0,4).'/'.substr($row->tc024,4,2).'/'.substr($row->tc024,6,2);?>
          <?  $tg030=$row->tc026;?>     
          <?  $tc012=$row->tc012;?>
		  <?  $tc007=$row->tc007;?>
		  <?  $tc017=$row->tc017;?>
		  <?  $tg016=$row->tc009;?>     
		  <?  $tc028=$row->tc028;?>
		  <?  $tc021=$row->tc021;?>
		  <?  $tc022=$row->tc022;?>
		  
		  <?  $tc019=$row->tc019;?>
		  <?  $tc020=$row->tc020;?>
		  <?  $tc023=$row->tc023;?>
		  
		  <?  $purq01a=$row->tc004;?>
		  <?  $cmsq21a1=$row->tc027;?>   
		  <?  $cmsq02a=$row->tc010;?>
		  <?  $cmsq09a4=$row->tc011;?>
		  <?  $cmsq06a=$row->tc005;?>
		   <?  $purq04a33disp=$row->tc001disp;?>
		  <?  $purq01adisp=$row->tc004disp;?>
		  <? $cmsq21a1disp=$row->tc027disp;?>
		  <?  $cmsq02adisp=$row->tc010disp;?>
		  <?  $cmsq09a4disp=$row->tc011disp;?>
		  <?  $cmsq06adisp=$row->tc005disp;?>
	  
		   <?  $flag=$row->flag;?>	
		
		 <!-- 明細 -->
		    <?  $th001[]='';?>
			<? $th002[]='';?>
			<?  $th003[]=$row->td003;?>
		   <?  $th011[]=$row->td001;?>
		   <?  $th012[]=$row->td002;?>
		   <?  $th013[]=$row->td003;?>
		   <?  $th004[]=$row->td004;?> 
		   <?  $th005[]=$row->td005;?>
		   <?  $th006[]=$row->td006;?>
		   <?  $th009[]=$row->td007;?>   
		   <?  $th009disp[]=$row->td007disp;?>
		   <?  $th007[]=round($row->td008,0);?>   
		   <?  $th015[]=round($row->td008,0);?>   
		   <?  $th017[]=0;?>   
		   <?  $th016[]=round($row->td008,0);?>   
		   <?  $th008[]=$row->td009;?>  
		   <?  $th018[]=round($row->td010,2);?>   
		   <?  $th045[]=round($row->td011,0);?>   
		    <?  $th046[]=round(($row->td011)*$tg030,0);?>   
			<?php  if ($tg010=='1') { ?>  
			<?   $th045[]=(round($row->td011,0)-round(($row->td011)*$tg030,0)); ?> 
			 <?php } ?>			 
			 <?  $th047[]=round($row->td011,0)*$tg008; ?>
			 <?  $th048[]=round(($row->td011)*$tg030,0)*$tg008; ?>
		   <?  $td012[]=$row->td012;?>
		   <?  $th028[]='0';?>
		   <?  $th033[]=$row->td014;?>      
		  <?  $mb991=' ';?>
		  <?  $mb992=' ';?>
		  <?  $mb999=' ';?>
	<?php $ii = $ii + 1 ;$tg028=$tg028+round($row->td011,0);$tg019=$tg019+round(($row->td011)*$tg030,0);$tg031 = $tg031+round($row->td011,0)*$tg008;
          $tg032 = $tg032+round(($row->td011)*$tg030,0)*$tg008; $tg026=$tg026+round($row->td008,0);	}?>
        	
   <?php } ?>
   <?php 
	  if(!isset($sysma200)) { $sysma200=$this->session->userdata('sysma200'); }
	  if(!isset($sysma201)) { $sysma201=$this->session->userdata('sysma201'); }  ?>
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="10%"><span class="required">進貨單別：</span> </td>
        <td class="normal14a"  width="40%"><input tabIndex="1" id="tg001"    onKeyPress="keyFunction()"  onfocus="selappr()" onChange="startpurq04a34(this)"  name="purq04a34" value="<?php echo strtoupper($purq04a34); ?>"  type="text" required /><a href="javascript:;"><img id="Showpurq04a34" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="purq04a34disp"> <?php    echo $purq04a34disp; ?> </span></td>
	    <td class="normal14a" width="10%" >單據日期： </td>
        <td class="normal14a"  width="40%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"  onfocus="this.select()" onchange="dataymd1(this)"  id="tg014" onKeyPress="keyFunction()"   name="tg014"  value="<?php echo $tg014; ?>"  size="12" type="text"  style="background-color:#E7EFEF" /><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td>
	  </tr>	
	  <tr>
	    <td class="start14a" ><span class="required">進貨單號：</span></td>
        <td class="normal14a" ><input tabIndex="3" id="tg002" onKeyPress="keyFunction()" onfocus="chkno1(this)" name="tg002" value="<?php echo $tg002; ?>" size="30" type="text" required /><span id="tg002disp" ></span></td>
		 <td class="normal14a">供應廠商：</td>
        <td  class="normal14"  ><input tabIndex="4" id="tg005" onKeyPress="keyFunction()" onfocus="chkno1(this)" onchange="startpurq01a(this)" name="purq01a" value="<?php echo $purq01a; ?>" size="10" type="text"  />
		<img id="Showpurq01a" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
        <span id="purq01adisp"> <?php   echo $purq01adisp; ?> </span></td>
	  </tr>
		
	  <tr>
	     <td class="normal14">進貨日期：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" readonly="value"  onKeyPress="keyFunction()" id="tg003" name="tg003"   value="<?php echo $tg003; ?>"  style="background-color:#EBEBE4" /></td>
	   <td class="normal14">確認碼：</td>
          <td  class="normal14"  ><select id="tg013" onKeyPress="keyFunction()" name="tg013" onChange="selappr(this)" tabIndex="6">
            <option <?php if($tg013 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tg013 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tg013 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td> 
		  <td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" /></td>
         <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" /></td>
	  </tr>
	  
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
		<li><a href="#tab1" accesskey="a">交易資料a</a></li>
		<li><a href="#tab2" accesskey="b">發票資料b</a></li>
		<li><a href="#tab3" accesskey="c">訂金資料c</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  交易資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	 
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14a"  width="10%">廠別：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="7" onKeyPress="keyFunction()" id="tg004"  onchange="startcmsq02a(this)" name="cmsq02a"   value="<?php echo  $cmsq02a; ?>"     /><a href="javascript:;"><img id="Showcmsq02a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	   <span id="cmsq02adisp"> <?php    echo $cmsq02adisp; ?> </span></td>
	   <td class="normal14a"  width="10%" > 件數：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="8" id="tg025"   tabIndex="11"   onKeyPress="keyFunction()"    name="tg025" value="<?php echo $tg025; ?>"  /></td>
	 </tr>	
		  
	  <tr>
	   <td class="normal14a"  >幣別：</td>
        <td class="normal14" ><input tabIndex="9" id="tg007" onKeyPress="keyFunction()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span></td>
	    <td class="normal14" >匯率：</td>		
        <td class="normal14"  ><input type="text" id="tg008"   tabIndex="10"   onKeyPress="keyFunction()"    name="tg008" value="<?php echo $tg008; ?>"  /></td>
	  </tr>
	  <tr>
	    <td  class="normal14a" >付款條件：</td>
        <td  class="normal14"  ><input tabIndex="11" id="tg033" onKeyPress="keyFunction()" name="cmsq21a1" onchange="startcmsq21a1(this)"   value="<?php echo  $cmsq21a1; ?>"     type="text"  /><a href="javascript:;"><img id="Showcmsq21a1" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="cmsq21a1disp"> <?php    echo $cmsq21a1disp; ?> </span></td>		   
	    <td  class="normal14a">廠商單號：</td>		
        <td  class="start14"  ><input type="text"   tabIndex="12" id="tg006"  onKeyPress="keyFunction()"   name="tg006" value="<?php echo $tg006; ?>"   /></td>
	    
	  </tr>
	  <tr>
	    <td class="normal14">備註：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="13"   onKeyPress="keyFunction()" id="tg016" name="tg016"   value="<?php echo $tg016; ?>"    /></td>
		<td class="normal14" >列印：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="14" readonly="value"  onKeyPress="keyFunction()" id="tg012" name="tg012"   value="<?php echo $tg012; ?>"  style="background-color:#EBEBE4" /></td>
	  </tr>	
		
	  <tr>
	    <td  class="normal14" >簽核狀態：</td>
        <td class="normal14"><select id="tg042" tabIndex="15" readonly="value" onKeyPress="keyFunction()" name="tg042"   style="background-color:#EBEBE4" >
            <option <?php if($tg042 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tg042 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($tg042 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tg042 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tg042 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tg042 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tg042 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tg042 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
	    <td class="normal14"></td>
        <td  class="normal14"  ></td>
	  </tr>
	 
	  
	</table>
	</div>
	
<!--	
	<!--  發票資料 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	  
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14a"  width="10%">統一編號：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="16"   onKeyPress="keyFunction()" id="tg022" name="tg022"   value="<?php echo $tg022; ?>"   /></td>
	   <td class="normal14a"  width="10%" >發票號碼：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="17"   onKeyPress="keyFunction()" id="tg011" name="tg011"   value="<?php echo $tg011; ?>"   /></td>
	 </tr>			  
	 
	  <tr>
	   <td class="normal14a"  >發票聯數：</td>
        <td class="normal14" ><select id="tg009" onKeyPress="keyFunction()" name="tg009"  tabIndex="18">
		    <option <?php if($tg009 == '2') echo 'selected="selected"';?> value='2'>2三聯式</option>
            <option <?php if($tg009 == '1') echo 'selected="selected"';?> value='1'>1二聯式</option> 
            <option <?php if($tg009 == '3') echo 'selected="selected"';?> value='3'>3二聯式收銀機發票</option>
		    <option <?php if($tg009 == '4') echo 'selected="selected"';?> value='4'>4三聯式收銀機發票</option>
            <option <?php if($tg009 == '5') echo 'selected="selected"';?> value='5'>5電子計算機發票</option>
            <option <?php if($tg009 == '6') echo 'selected="selected"';?> value='6'>6免用統一發票</option>	
            <option <?php if($tg009 == 'A') echo 'selected="selected"';?> value='A'>A增值稅專用發票</option>	
            <option <?php if($tg009 == 'B') echo 'selected="selected"';?> value='B'>B普通發票</option>	
            <option <?php if($tg009 == 'C') echo 'selected="selected"';?> value='C'>C免用發票</option>				
		  </select></td>
		<td class="normal14a"  >課稅別：</td>
        <td class="normal14" ><select id="tg010" onKeyPress="keyFunction()" name="tg010" onchange="taxa()" tabIndex="19">
		    <option <?php if($tg010 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php if($tg010 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php if($tg010 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php if($tg010 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php if($tg010 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select></td>
	  </tr>	
	  <tr>
	    <td class="normal14">發票日期：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="20"   onKeyPress="keyFunction()"  onclick="scwShow(this,event);" id="tg027" name="tg027"   value="<?php echo $tg027; ?>"    /></td>
		<td class="normal14" >扣底區分：</td>						
        <td  class="normal14"  ><select id="tg023" onKeyPress="keyFunction()" name="tg023"  tabIndex="21">
		    <option <?php if($tg023 == '1') echo 'selected="selected"';?> value='1'>1可扣掋進貨及費用</option>
            <option <?php if($tg023 == '2') echo 'selected="selected"';?> value='2'>2可扣抵固定資產</option> 
            <option <?php if($tg023 == '3') echo 'selected="selected"';?> value='3'>3不可扣抵進貨及費用</option>
		    <option <?php if($tg023 == '4') echo 'selected="selected"';?> value='4'>4不可扣抵固定資產</option>
		  </select></td>
	  </tr>	
	   <tr>
	    <td  class="normal14" >申報年月：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="22" id="tg029"  onKeyPress="keyFunction()"  onclick="dateym();" class="date-picker" name="tg029" value="<?php echo $tg029; ?>"   /></td>	   
	    <td  class="normal14">營業稅率：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="23" id="tg030"  onKeyPress="keyFunction()"   name="tg030" value="<?php echo $tg030; ?>"   /></td>
	    
	  </tr>
	   <tr>
	    <td  class="normal14a">菸酒註記：</td>						
        <td  class="normal14"  ><input type="hidden" name="tg024" value="N" />
		<input type='checkbox' tabIndex="24" id="tg024" onKeyPress="keyFunction()" name="tg024" <?php if($tg024 == 'Y' ) echo 'checked'; ?>  <?php if($tg024 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
       
	    <td class="normal14" >隨貨附發票：</td>
        <td class="normal14"><input type="hidden" name="tg043" value="N" />
		<input type='checkbox' tabIndex="25" id="tg043" onKeyPress="keyFunction()" name="tg043" <?php if($tg043 == 'Y' ) echo 'checked'; ?>  <?php if($tg043 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td>       
	    
	  </tr>
	  
	</table>
 
	</div> 	
	<!--  訂金資料 -->
	<div id="tab3" class="tab_content"> <!-- div-8 -->
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14a"  width="10%">採購單別：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="26"   onKeyPress="keyFunction()" id="tg034" name="tg034"   value="<?php echo $tg034; ?>"   /></td>
	   <td class="normal14a"  width="10%" >採購單號：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="27"   onKeyPress="keyFunction()" id="tg035" name="tg035"   value="<?php echo $tg035; ?>"   /></td>
	 </tr>
	   <tr>
	    <td  class="normal14" >沖抵金額：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="28" id="tg038"  onKeyPress="keyFunction()"   name="tg038" value="<?php echo $tg038; ?>"   /></td>	   
	    <td  class="normal14">沖抵稅額：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="29" id="tg039"  onKeyPress="keyFunction()"   name="tg039" value="<?php echo $tg039; ?>"   /></td>
	  </tr>
	  <tr>
	    <td  class="normal14" >預付待抵單別：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="30" id="tg036" readonly="value" onKeyPress="keyFunction()"   name="tg036" value="<?php echo $tg036; ?>" style="background-color:#EBEBE4"  /></td>	   
	    <td  class="normal14">預付待抵單號：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="31" id="tg037" readonly="value" onKeyPress="keyFunction()"   name="tg037" value="<?php echo $tg037; ?>" style="background-color:#EBEBE4" /></td>
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
		      <td width="11%" class="center">品號</td>
              <td width="6%" class="left">品名</td>
			  <td width="6%" class="left">規格</td>  
			  <td width="6%" class="center">單位</td>
			  <td width="6%" class="center">序號</td>
			  <td width="6%" class="left">交貨庫別</td>
		 	  <td width="6%" class="left">庫別名稱</td> 
			  <td width="6%" class="left">驗收日期</td>
              <td width="6%" class="center">進貨數量</td>
              <td width="6%" class="right">驗收數量</td>
              <td width="6%" class="right">驗退數量</td>
			  <td width="6%" class="center">計價數量</td>
              <td width="6%" class="right">單位進價</td>
              <td width="6%" class="right">原幣金額</td>
			  <td width="6%" class="center">原幣稅額</td>
              <td width="6%" class="right">本幣金額</td>
			  <td width="6%" class="center">本幣稅額</td>
              <td width="6%" class="right">採購單別</td>
			  <td width="6%" class="right">採購單號</td>
			  <td width="6%" class="right">採購序號</td>
			  <td width="6%" class="right">檢驗狀態</td>
			  <td width="14%" class="center">備註</td>
			  
            </tr>
        </thead>
	
	<?php IF ($this->uri->segment(3)=='copybefore') {  ?>

        	<!--   明細0  --> 
		<?php $i=0; $mproduct_row=0; $product_row='0'; ?>  
			 <input id="row_count" name="row_count" value="0" style="display:none;" /> 
		<?php while ($i<$ii) { ?>
		<tbody  <?php echo 'id='.'product-row'.$product_row ?> >		
	     <tr>
	  <!--   <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td>  -->
         <td class="center"><img src="<?php echo base_url()?>assets/image/delete2.png" title="刪除資料" onclick="del_detail('<?php echo $purq04a34;?>','<?php echo $tg002; ?>','<?php echo $th003[$i]; ?>');" /></td>     	    
		<input type="hidden"  name="order_product[<?php echo $i ?>][th001]" value="<?php echo $th001[$i]; ?>" />
	     <input type="hidden" name="order_product[<?php echo $i ?>][th002]" value="<?php echo $th002[$i]; ?>" />
	     <td class="left"><input type="text"  <?php echo 'id='.'th004'.$i ?>   name="order_product[<?php echo $i ?>][th004]" value="<?php echo $th004[$i]; ?>" size="20" style="background-color:#E7EFEF"  /></td>
	     <td class="left"><input  type="text"  onKeyPress="keyFunction()"  id="th005"  name="order_product[<?php echo $i ?>][th005]" value="<?php echo $th005[$i]; ?>"  style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text"  onKeyPress="keyFunction()"  id="th006"   name="order_product[<?php echo $i ?>][th006]" value="<?php echo $th006[$i]; ?>"  size="30" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input  type="text"  onKeyPress="keyFunction()"    id="th008"   name="order_product[<?php echo $i ?>][th008]" value="<?php echo $th008[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text"   readonly="value"   name="order_product[$i][th003]" value="<?php echo $th003[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
		 <td class="left"><input type="text"   <?php echo 'id='.'th009'.$i ?>   name="order_product[<?php echo $i ?>][th009]" value="<?php echo $th009[$i]; ?>" size="10" style="background-color:#E7EFEF"  /></td>
		<td class="left"><input  type="text"  onKeyPress="keyFunction()"  id="th009disp"  name="order_product[<?php echo $i ?>][th009disp]" value="<?php echo $th009disp[$i]; ?>"  style="background-color:#EBEBE4" /></td>
		<td class="left"><input type="text"   onclick="scwShow(this,event);"  id="th014[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th014]" value="<?php echo  substr($td012[$i],0,4).'/'.substr($td012[$i],4,2).'/'.substr($td012[$i],6,2); ?>" size="10"  class="date"  /></td>
	     <td class="center"><input type="text"  class="total_qty" id="th007" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th007]" value="<?php echo $th007[$i]; ?>" size="3" style="text-align:right;" /></td>
		 <td class="center"><input type="text"  id="th015" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th015]" value="<?php echo $th015[$i]; ?>" size="3" style="text-align:right;" /></td>
		 <td class="center"><input type="text"  id="th017" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th017]" value="<?php echo $th017[$i]; ?>" size="3" style="text-align:right;" /></td>
		 <td class="center"><input type="text"  id="th016" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th016]" value="<?php echo $th016[$i]; ?>" size="3" style="text-align:right;" /></td>
         <td class="center"><input type="text"   id="th018" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th018]" value="<?php echo $th018[$i]; ?>" size="6" style="text-align:right;"  /></td>	
         <td class="right"><input readonly="value" type="text" class="total_price" name="order_product[<?php echo $i ?>][th045]" value="<?php echo $th045[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" /></td>
		 <td class="right"><input readonly="value" type="text"  name="order_product[<?php echo $i ?>][th046]" value="<?php echo $th046[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" /></td>
		 <td class="right"><input readonly="value" type="text"  name="order_product[<?php echo $i ?>][th047]" value="<?php echo $th047[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" /></td>
		 <td class="right"><input readonly="value" type="text"  name="order_product[<?php echo $i ?>][th048]" value="<?php echo $th048[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" /></td>
	     <td class="left"><input type="text" id="th011"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th011]" value="<?php echo $th011[$i]; ?>" size="5"  /></td>
		 <td class="left"><input type="text" id="th012"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th012]" value="<?php echo $th012[$i]; ?>" size="10"  /></td>
		 <td class="left"><input type="text" id="th013"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th013]" value="<?php echo $th013[$i]; ?>" size="10"  /></td>
		 <td class="left"><input type="text" id="th028"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th028]" value="<?php echo $th028[$i]; ?>" size="6"  /></td>
		 <td class="left"><input type="text" id="th033"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th033]" value="<?php echo $th033[$i]; ?>" size="20"  /></td>
	     </tr>	    
        </tbody>
			<script>
		function del_detail(del_md001,del_md002,del_md003){
			if(confirm('是否刪除此筆資料，單別:'+del_md001+'單號:'+del_md002+'序號:'+del_md003))
			{
				$('#del_md001').val(del_md001);
				$('#del_md002').val(del_md002);
				$('#del_md003').val(del_md003);
				$('#del_form').submit();
			}
		}
		</script>
        <?php $i++; $mproduct_row = (int) $product_row + 1; $product_row=(string)$mproduct_row;
          echo "<script>$('#row_count').val(".$product_row.")</script>";?>		
 <?php } ?>		 
    <!-- javascrit 0 -->	
	
	<?php   } ?>	
    
	<?php IF ($this->uri->segment(3)=='copybefore') {  ?>
		<?php include("./application/views/fun/puri09_funjsupdjs_v.php"); ?> 
		 <?php   } ?>	
          <tfoot>
		 
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="22"></td>
            </tr>
          </tfoot>
       </table>
	</div> 	
	<!-- 合計     -->
		     <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span>
				
				</span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　原幣未稅額：</b></td>
				<td ><input type='text' readonly="value" name='tg028' id="tg028" size="8" value="<?php echo $tg028; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　原幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='tg019' id="tg019" size="8" value="<?php echo $tg019; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　原幣合計：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot"><?php echo $tg028+$tg019; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　本幣未稅額：</b></td>
				<td ><input type='text' readonly="value" name='tg031' id="tg031" size="8" value="<?php echo $tg031; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　本幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='tg032' id="tg032" size="8" value="<?php echo $tg032; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　本幣合計：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot1"><?php echo $tg031+$tg032; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　合計數量：</b></td>
				<td ><input type='text' readonly="value" name='tg026' id="tg026" size="8" value="<?php echo $tg026; ?>"  style="background-color:#EBEBE4" /></td>
					<input id="select_rows" style="display:none;"/>
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	  
	 <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pur/puri09/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 <b style="color: #FF0000;"><span>　複製採購單據　</span></b><a  href="javascript:;"><img id="Showpurc09a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/>
	 </div> 
		</div> 	   
    </form>
	   <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位,交貨庫別,可輸入部份品號或品名下拉視窗選擇,Alt+y跳明細欄位, Alt+w 新增一筆明細,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
	
    </div> <!-- div-6 -->
	
  </div> <!-- div-5 -->
 
</div> <!-- div-4 -->

 
   
	</div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<form action="<?php echo base_url()?>index.php/pur/puri09/delete_detaila" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
     <?php include("./application/views/fun/puri09_funjs_v.php"); ?> 