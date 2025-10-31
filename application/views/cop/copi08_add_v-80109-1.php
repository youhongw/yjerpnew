<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 客戶銷貨單建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div> -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/cop/copi08/addsave" >	
	
	   
    <!--  // 頭部表格  isset 檢查變數 //基本參數 本幣, 稅率, 庫別碼數, 品號碼數, 半張紙, 主要庫別, 盤點日 -->
	   <?php foreach($results2 as $row ) : ?>		  
		<?php 	 $ma003sys[]=$row->ma003;   ?>  
		<?php 	$ma004sys[]=$row->ma004;  ?> 
		<?php 	$ma200sys[]=$row->ma200;  ?> 
		<?php 	$ma201sys[]=$row->ma201;  ?> 
		<?php 	$ma202sys[]=$row->ma202;  ?> 
		<?php 	$ma203sys[]=$row->ma203;  ?> 
		<?php 	$ma204sys[]=$row->ma204;  ?> 
        <?php endforeach;?>
		<?php    $vsysma003=$ma003sys[0];  ?>
		<?php    $vsysma004=$ma004sys[0];  ?>
		<?php    $vsysma200=$ma200sys[0];  ?>
		<?php    $vsysma201=$ma201sys[0];  ?>
		<?php    $vsysma202=$ma202sys[0];  ?>
		<?php    $vsysma203=$ma203sys[0];  ?>
		<?php    $vsysma204=$ma204sys[0];  ?>
	  <?php  
	  $date=date("Y/m/d");
	  if(!isset($tg001)) { $tg001=$this->input->post('tg001'); }
	  if(!isset($tg001disp)) { $tg001disp=$this->input->post('tg001'); }
	 
      $tg002=$this->input->post('tg002');
	  $tg003=date("Y/m/d");
	  $tg004=$this->input->post('tg004'); 
	  $tg004disp=$this->input->post('tg004'); 
	//  $tg013=$this->input->post('tg013');	 
	//  $tg042=$this->input->post('tg042');
	  $tg007=$this->input->post('tg007');
	  if(!isset($tg042)) { $tg042=date("Y/m/d"); }
	  if(!isset($tg003)) { $tg003=date("Y/m/d"); }
       
	  if(!isset($tg023)) { $tg023='Y'; }
	  
	  $tg034=$this->input->post('tg034');
	  $tg036=$this->input->post('tg036');
	  $tg037=$this->input->post('tg037');
	  $tg059=$this->input->post('tg059');
	  $tg060=$this->input->post('tg060');
	  
	  $tg013=$this->input->post('tg013');
	  $tg025=$this->input->post('tg025');
	  $tg033=$this->input->post('tg033');
	  $tg045=$this->input->post('tg045');
	  $tg046=$this->input->post('tg046');
	  if(!isset($sysma200)) { $sysma200=$vsysma200; }
	  if(!isset($sysma201)) { $sysma201=$vsysma201; }
	?>
	 <?php
	 //交易
	   $tg005=$this->input->post('tg005');
	   $tg005disp=$this->input->post('tg005');
	   $tg006=$this->input->post('tg006');
	   $tg006disp=$this->input->post('tg006');
	   $tg010=$this->input->post('tg010');
	   $tg010disp=$this->input->post('tg010');
	   $tg011=$this->input->post('tg011');
	   $tg011disp=$this->input->post('tg011');
	   $tg047=$this->input->post('tg047');
	   $tg047disp=$this->input->post('tg047');
	  // if(!isset($tg007)) { $tg007=0.05; } sysma003 ntd sysma004 0.5
	     if(!isset($tg043)) { $tg043=$username; }
	   $tg011=$vsysma003;
	 //  $tg044=$this->session->userdata('sysma004');
	   $tg044=$vsysma004;
	   
	  // $tg042=$this->input->post('tg042');
	   if(!isset($tg042)) { $tg042='N'; }
	//   $tg008=$this->input->post('tg008'); 匯率
	   if(!isset($tg012)) { $tg012=1; }
	  
	   $tg008=$this->input->post('tg018');
	   $tg009=$this->input->post('tg009');
	 
	   $tg032=$this->input->post('tg032');
	   $tg020=$this->input->post('tg020');
	   $tg022=$this->input->post('tg022');
	   $tg032=$this->input->post('tg032');
	   $tg020=$this->input->post('tg020');
	   $tg022=$this->input->post('tg022');
	   $tg041=$this->input->post('tg041');
	   $tg055=$this->input->post('tg055');
	  ?>
	  
	   <?php
	   //發票
	   $tg021=$this->input->post('tg021');
	   $tg014=$this->input->post('tg014');
	   $tg015=$this->input->post('tg015');
	   $tg007=$this->input->post('tg007');
	   $tg018=$this->input->post('tg018');
	   $tg019=$this->input->post('tg019');
	   $tg016=$this->input->post('tg016');
	   $tg017=$this->input->post('tg017');
	   $tg030=$this->input->post('tg030');
	   $tg031=$this->input->post('tg031');
	   $tg038=$this->input->post('tg038');
	   $tg061=$this->input->post('tg061');
	  ?>
	    <?php
		//其他
	   $tg035=$this->input->post('tg035');
	   $tg035disp=$this->input->post('tg035');
	   $tg026=$this->input->post('tg026');
	   $tg026disp=$this->input->post('tg026');
	   $tg039=$this->input->post('tg039');
	   $tg040=$this->input->post('tg040');
	   $tg027=$this->input->post('tg027');
	   $tg028=$this->input->post('tg028');
	   $tg029=$this->input->post('tg029');
	   $tg056=$this->input->post('tg056');
	   $tg057=$this->input->post('tg057');
	   $tg058=$this->input->post('tg058');
	  ?>
	    <?php
		//訂金
	   $tg048=$this->input->post('tg048');
	   $tg049=$this->input->post('tg049');
	   $tg050=$this->input->post('tg050');
	   $tg051=$this->input->post('tg051');
	   $tg052=$this->input->post('tg052');
	   $tg053=$this->input->post('tg053');
	   
	  ?>
	  
  <?php IF ($this->uri->segment(3)=='copybefore') {  ?>
   <?php $ii=0;$tg013=0;$tg025=0;$tg033=0;$tg045=0;$tg046=0; ?>
   <?php $data_count = 0; ?>
	<?php foreach($result as $row) { ?>
	       <?php $data_count++; ?>
           <?php if (!@$otg001) {$otg001='';} ?>
		  <?php if (!@$otg002) {$otg002='';} ?>
		  <?php if (!@$otg042) {$otg042='';} ?>
		  <!--   記住單別,單號, 日期         -->
	      <?php $tg001=$otg001; ?>
		   <?php $tg002=$otg002; ?>
		    <?php $tg042=substr($otg042,0,4).'/'.substr($otg042,4,2).'/'.substr($otg042,6,2);?>
			
		  <?php   $tg048=$row->tc001;?>  
          <?php   $tg049=$row->tc002;?>      
          <?php   $tg003=date("Y/m/d");?>
          <?php   $tg004=$row->tc004;?>
	      <?php   $tg004disp=$row->tc004disp;?>
		  <?php   $tg005=$row->tc005;?>
		  <?php   $tg005disp=$row->tc005disp;?>
		  <?php   $tg006=$row->tc006;?>
          <?php   $tg006disp=$row->tc006disp;?> 	
		  <?php   $tg007=$row->tc007;?>
          <?php   $tg007disp=$row->tc007disp;?> 	
		  <?php   $tg008=$row->tc008;?>
          <?php   $tg008disp=$row->tc008disp;?> 
          <?php   $tg012=$row->tc009;?>    		  
		  <?php   $tg008=$row->tc010;?>    
		  <?php   $tg009=$row->tc011;?>
          <?php   $tg014=$row->tc014;?>
		  <?php   $tg014disp=$row->tc014disp;?>
		  <?php   $tg042=date("Y/m/d");?>  
          <?php   $tg020=$row->tc015;?>     
          <?php   $tg017=$row->tc016;?>
		  <?php   $tg039=$row->tc017;?>
		  <?php  // $tg013=$row->tc029;?>
		  <?php  // $tg025=$row->tc030;?>  
		  
		  <?php  // $tg033=$row->tc031;?>
		  <?php   $tg044=$row->tc041;?>
		  <?php  // $tg045=$row->tc029;?>
		  <?php  // $tg046=$row->tc030;?>		  
		 
		   <?php   $flag=$row->flag;?>	
		
		 <!-- 明細 -->
		    <?php   $th001[]='';?>
			<?php  $th002[]='';?>
			<?php   $th003[]=$row->td003;?>
		   <?php   $th014[]=$row->td001;?>
		   <?php   $th015[]=$row->td002;?>
		   <?php   $th016[]=$row->td003;?>
		   <?php   $th004[]=$row->td004;?> 
		   <?php   $th005[]=$row->td005;?>
		   <?php   $th006[]=$row->td006;?>
		   <?php   $th009[]=$row->td010;?> 
		   <?php   $th007[]=$row->td007;?>   
		   <?php   $th007disp[]=$row->td007disp;?>
		   <?php   $th008[]=$row->td008-$row->td009;?> 
           <?php   $th012[]=$row->td011;?> 
           <?php   $th013[]=$row->td012;?> 
         
           <?php   $th017[]=$row->td030;?> 		   
          <?php   $th030[]=$row->td031;?> 
          <?php   $th019[]=$row->td014;?> 
          <?php   $th018[]=$row->td020;?> 
		      <?php   $th035[]=$row->td012;?> 
			<?php    $th036[]=round($row->td012*$row->tc041); ?> 
			 
			 <?php   $th037[]=round($row->td012*$row->tc009); ?>
			 <?php   $th038[]=round($row->td012*$row->tc041*$row->tc009); ?>
		    
		  <?php   $mb991=' ';?>
		  <?php   $mb992=' ';?>
		  <?php   $mb999=' ';?>
	<?php $ii = $ii + 1 ;$tg013=$tg013+$row->td012;$tg025=$tg025+round($row->td012*$row->tc041);$tg045 =$tg045+round($row->td012*$row->tc009);
          $tg046 = $tg046+round($row->td012*$row->tc041*$row->tc009); $tg033=$tg033+$row->td008-$row->td009;}?>
        	
   <?php } ?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="8%"><span class="required">銷貨單別：</span> </td>
        <td class="normal14a"  width="25%"><input tabIndex="1" id="copi03"    onKeyPress="keyFunction()" ondblclick="search_copi03_window()"  name="tg001" onfocus="check_title_no();" onchange="check_copi03(this);check_title_no();"  value="<?php echo $tg001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showcopi03disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="copi03disp"> <?php    echo $tg001disp; ?> </span></td>
	    <td class="normal14a" width="9%" >單據日期： </td>
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);" onfocus="this.select()"  id="tg042" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="tg042"  value="<?php echo $tg042; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(tg042,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td><td class="start14a"  width="9%" ><span class="required">銷貨單號：</span></td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="tg002" onKeyPress="keyFunction()" readonly="value" onfocus="check_title_no();" name="tg002" value="<?php echo $tg002; ?>" size="30" type="text" required /></td>
	  </tr>	
	  <tr>
		 <td class="normal14a">客戶代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="copi01" onKeyPress="keyFunction()" ondblclick="search_copi01_window()"  onchange="check_copi01(this)" name="tg004" value="<?php echo $tg004; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="copi01disp"> <?php   echo $tg004disp; ?> </span></td>
	    <td  class="normal14a">現銷：</td>						
        <td  class="normal14"  ><input type="hidden" name="tg034" value="N" />
		<input type='checkbox' tabIndex="5" id="tg034" onKeyPress="keyFunction()" name="tg034" <?php if($tg034 == 'Y' ) echo 'checked'; ?>  <?php if($tg034 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
	     <td class="normal14">確認碼：</td>
          <td  class="normal14"  ><select id="verify" onKeyPress="keyFunction()" name="tg023" onChange="selappr(this)" tabIndex="6">
            <option <?php if($tg023 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tg023 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tg023 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td> 
	  </tr>
		
	  <tr>
	     <td class="normal14">銷貨日期：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" readonly="value"  onKeyPress="keyFunction()" id="tg003" name="tg003"   value="<?php echo $tg003; ?>"  style="background-color:#EBEBE4" /></td>
	    <td  class="normal14">分錄-收入：</td>						
        <td  class="normal14"  ><input type="hidden" name="tg036" value="N" readonly="value" />
		<input type='checkbox' tabIndex="8" id="tg036" onKeyPress="keyFunction()" name="tg036" <?php if($tg034 == 'Y' ) echo 'checked'; ?>  <?php if($tg036 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
		<td  class="normal14">分錄-成本：</td>						
        <td  class="normal14"  ><input type="hidden" name="tg034" value="N" readonly="value"  />
		<input type='checkbox' tabIndex="9" id="tg037" onKeyPress="keyFunction()" name="tg037" <?php if($tg037 == 'Y' ) echo 'checked'; ?>  <?php if($tg037 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
		
	  </tr>
	  <tr>
	     <td class="normal14">流程代號：</td>
        <td  class="normal14"  ><input type="text" tabIndex="10" readonly="value"  onKeyPress="keyFunction()" id="tg060" name="tg060"   value="<?php echo $tg060; ?>" style="background-color:#EBEBE4"  /></td>
        <td class="normal14">拋轉狀態：</td>
        <td  class="normal14"  ><select id="tg059" tabIndex="11" readonly="value" onKeyPress="keyFunction()" name="tg059"   style="background-color:#EBEBE4" >
            <option <?php if($tg059 == 'N') echo 'selected="selected"';?> value='N'>N.未拋轉</option>                                                                        
		    <option <?php if($tg059 == 'Y') echo 'selected="selected"';?> value='Y'>Y.拋轉成功(來源廠商)</option>
            <option <?php if($tg059 == 'y') echo 'selected="selected"';?> value='y'>y.拋轉成功(下游廠商)</option>
		    <option <?php if($tg059 == 'n') echo 'selected="selected"';?> value='n'>n.訂單變更</option>
            <option <?php if($tg059 == 'U') echo 'selected="selected"';?> value='U'>U.拋轉失敗</option>	
            <option <?php if($tg059 == 'u') echo 'selected="selected"';?> value='u'>u.還原失敗</option>	
		  </select></td>
		  <td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" /></td>
         <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" /></td>
	  </tr>
	 
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
		<li><a href="#tab1"  accesskey="a">交易資料</a></li>
		<li><a href="#tab2"  accesskey="b">發票資料</a></li>
		<li><a href="#tab3"  accesskey="c">其他資料</a></li>
		<li><a href="#tab4"  accesskey="g">訂金資料</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  交易資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	 
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14a"  width="9%">廠別：</td>
       <td class="normal14a"  width="25%" ><input type="text" tabIndex="10" onKeyPress="keyFunction()" id="cmsi02"  onblur="check_cmsi02(this)" name="tg010"   value="<?php echo  $tg010; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	      <span id="cmsi02disp"> <?php    echo $tg010disp; ?> </span></td>
	   <td class="normal14a"  width="9%" > 件數：</td>
       <td class="normal14a"  width="27%" ><input type="text" tabIndex="13" id="tg032"   tabIndex="11"   onKeyPress="keyFunction()"    name="tg032" value="<?php echo $tg032; ?>"  /></td>	  
       <td class="normal14a" width="9%" >幣別：</td>
	   <td class="normal14a" width="26%" ><input tabIndex="11" id="cmsi06" onKeyPress="keyFunction()" name="tg011" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $tg011; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $tg011disp; ?> </span></td>
	 </tr>
	 
	  <tr>
	    <td  class="normal14a" >付款條件：</td>
        <td  class="normal14"  ><input tabIndex="15" id="cmsi21" ondblclick="search_cmsi21_window()" onKeyPress="keyFunction()" name="tg047" onblur="check_cmsi21(this)"   value="<?php echo  $tg047; ?>"   size="12"   type="text"  />
		  <a href="javascript:;"><img id="Showcmsi21disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
          <span id="cmsi21disp"> <?php    echo $tg047disp; ?> </span></td>		   
	    <td class="normal14a" >部門代號：</td>
       <td class="normal14a"  ><input type="text" tabIndex="10" onKeyPress="keyFunction()" id="cmsi05"  name="tg005"  onblur="check_cmsi05(this)"    value="<?php echo  $tg005; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Showcmsi05disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
	      <span id="cmsi05disp" > <?php    echo $tg005disp; ?> </span></td>
	    <td class="normal14" >匯率：</td>		
        <td class="normal14"  ><input type="text" id="tg012"   tabIndex="17"   onKeyPress="keyFunction()"    name="tg012" value="<?php echo $tg012; ?>"  /></td>
	  </tr>
	  <tr>	   
	   <td class="normal14" >業務人員：</td>
        <td class="normal14a"  ><input tabIndex="6" id="cmsi09" onKeyPress="keyFunction()" name="tg006" onblur="check_cmsi09(this)"  value="<?php echo $tg006; ?>"  type="text"  size="12"  />
		  <a href="javascript:;"><img id="Showcmsi09disp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
          <span id="cmsi09disp"> <?php    echo $tg006disp; ?> </span></td>
	    <td class="normal14">備註：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="19"   onKeyPress="keyFunction()" id="tg020" name="tg020"   value="<?php echo $tg020; ?>"    /></td>
	    <td class="normal14">送貨地址1：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="20"   onKeyPress="keyFunction()" id="tg008" name="tg008"   value="<?php echo $tg008; ?>"  size="40px"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14">帳單地址：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="21"   onKeyPress="keyFunction()" id="tg009" name="tg009"   value="<?php echo $tg009; ?>"  size="40px"  /></td>
		<td class="normal14" >列印：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="22"   onKeyPress="keyFunction()" id="tg022" name="tg022"   value="<?php echo $tg022; ?>" disabled="disabled" /></td>
	    <td class="normal14" >發票列印：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="23"   onKeyPress="keyFunction()" id="tg041" name="tg041"   value="<?php echo $tg041; ?>" disabled="disabled" /></td>
	  </tr>
      <tr>
	    <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="24" readonly="value"  onKeyPress="keyFunction()" id="tg043" name="tg043"   value="<?php echo $tg043; ?>" style="background-color:#EBEBE4"  /></td>
	    <td  class="normal14" >簽核狀態：</td>
        <td class="normal14"><select id="tg055" tabIndex="25" readonly="value" onKeyPress="keyFunction()" name="tg055"   style="background-color:#EBEBE4" disabled="disabled">
            <option <?php if($tg055 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tg055 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($tg055 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tg055 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tg055 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tg055 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tg055 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tg055 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
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
	   <td class="normal14a"  width="9%">統一編號：</td>
       <td class="normal14a"  width="26%" ><input type="text" tabIndex="26"   onKeyPress="keyFunction()" id="tg015" name="tg015"   value="<?php echo $tg015; ?>"   /></td>
	   <td class="normal14a"  width="9%" >發票號碼：</td>
       <td class="normal14a"  width="26%" ><input type="text" tabIndex="27"   onKeyPress="keyFunction()" id="tg014" name="tg014"   value="<?php echo $tg014; ?>"   /></td>
	   <td class="normal14a" width="9%">發票日期：</td>						
        <td  class="normal14a" width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tg021" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="tg021"  value="<?php echo $tg021; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tg021,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td></tr>			  
	 <tr>
	    <td  class="normal14" >申報年月：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="29" id="tg038" ondblclick="fPopCalendar(event,this,this)" onfocus="this.select()" onKeyPress="keyFunction()"  onclick="dateym();" class="date-picker" name="tg038" value="<?php echo $tg038; ?>"   /></td>	   
	    <td  class="normal14">營業稅率：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="30" id="tg044"  onKeyPress="keyFunction()"   name="tg044" value="<?php echo $tg044; ?>"   /></td>
	    <td  class="normal14">客戶全名：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="31" id="tg007"  onKeyPress="keyFunction()"   name="tg007" value="<?php echo $tg007; ?>"   /></td>
	  </tr>
	  <tr>
	    <td  class="normal14" >發票地址1：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="32" id="tg018"  onKeyPress="keyFunction()"   name="tg018" value="<?php echo $tg018; ?>" size="40px"  /></td>	   
	    <td  class="normal14">發票地址2：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="33" id="tg019"  onKeyPress="keyFunction()"   name="tg019" value="<?php echo $tg019; ?>"  size="40px" /></td>
	    <td class="normal14" >隨貨附發票：</td>
        <td class="normal14"><input type="hidden" name="tg061" value="N" />
		<input type='checkbox' tabIndex="34" id="tg061" onKeyPress="keyFunction()" name="tg061" <?php if($tg061 == 'Y' ) echo 'checked'; ?>  <?php if($tg061 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
	  </tr>
	  <tr>
	   <td class="normal14"  >發票聯數：</td>
        <td class="normal14" ><select id="tg016" onKeyPress="keyFunction()" name="tg016"  tabIndex="35">
		    <option <?php if($tg016 == '2') echo 'selected="selected"';?> value='2'>2三聯式</option>
            <option <?php if($tg016 == '1') echo 'selected="selected"';?> value='1'>1二聯式</option> 
            <option <?php if($tg016 == '3') echo 'selected="selected"';?> value='3'>3二聯式收銀機發票</option>
		    <option <?php if($tg016 == '4') echo 'selected="selected"';?> value='4'>4三聯式收銀機發票</option>
            <option <?php if($tg016 == '5') echo 'selected="selected"';?> value='5'>5電子計算機發票</option>
            <option <?php if($tg016 == '6') echo 'selected="selected"';?> value='6'>6免用統一發票</option>	
            <option <?php if($tg016 == 'A') echo 'selected="selected"';?> value='A'>A增值稅專用發票</option>	
            <option <?php if($tg016 == 'B') echo 'selected="selected"';?> value='B'>B普通發票</option>	
            <option <?php if($tg016 == 'C') echo 'selected="selected"';?> value='C'>C免用發票</option>				
		  </select></td>
		<td class="normal14"  >課稅別：</td>
        <td class="normal14" ><select id="tg017" onKeyPress="keyFunction()" name="tg017" onchange="seltax()" tabIndex="36">
		    <option <?php if($tg017 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php if($tg017 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php if($tg017 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php if($tg017 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php if($tg017 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select><span  id="taxdisp" ></span></td>
	  <td class="normal14" >菸酒註記：</td>
        <td class="normal14"><input type="hidden" name="tg043" value="N" />
		<input type='checkbox' tabIndex="37" id="tg031" onKeyPress="keyFunction()" name="tg031" <?php if($tg031 == 'Y' ) echo 'checked'; ?>  <?php if($tg031 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
	  </tr>	
	  
	   <tr>
	    <td  class="normal14">發票作廢：</td>						
        <td  class="normal14"  ><input type="hidden" name="tg030" value="N" />
		<input type='checkbox' tabIndex="38" id="tg030" onKeyPress="keyFunction()" name="tg030" <?php if($tg030 == 'Y' ) echo 'checked'; ?>  <?php if($tg030 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
       	<td class="normal14"></td>
        <td class="normal14"></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	</table>
 
	</div> 	
	<!--  其他資料 -->
	<div id="tab3" class="tab_content"> <!-- div-8 -->
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14a"  width="11%">員工代號：</td>
       <td class="normal14a"  width="23%" ><input tabIndex="6" id="cmsi09a" onKeyPress="keyFunction()" name="tg035" onblur="check_cmsi09a(this)"  value="<?php echo $tg035; ?>"  type="text"  size="12"  />
		  <a href="javascript:;"><img id="Showcmsi09adisp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
          <span id="cmsi09adisp"> <?php    echo $tg035disp; ?> </span></td>
	   <td class="normal14a"  width="15" >收款業務員：</td>
       <td class="normal14a"  width="22%" ><input tabIndex="6" id="cmsi09b" onKeyPress="keyFunction()" name="tg026" onblur="check_cmsi09b(this)"  value="<?php echo $tg026; ?>"  type="text"  size="12"  />
		  <a href="javascript:;"><img id="Showcmsi09bdisp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
          <span id="cmsi09bdisp"> <?php    echo $tg026disp; ?> </span></td>
	   <td  class="normal14a"  width="10%" >L/C NO：</td>
        <td  class="normal14a" width="24%" ><input type="text"   tabIndex="41" id="tg039"  onKeyPress="keyFunction()"   name="tg039" value="<?php echo $tg039; ?>"   /></td>	
	 </tr>
	   <tr>
	    <td  class="normal14" >INVOICE NO：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="42" id="tg040"  onKeyPress="keyFunction()"   name="tg040" value="<?php echo $tg040; ?>"   /></td>	   
	    <td  class="normal14">備註一：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="43" id="tg027"  onKeyPress="keyFunction()"   name="tg027" value="<?php echo $tg027; ?>"   /></td>
	    <td  class="normal14">備註二：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="44" id="tg028"  onKeyPress="keyFunction()"   name="tg028" value="<?php echo $tg028; ?>"   /></td>
	  </tr>
	  <tr>
	    <td  class="normal14">備註三：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="45" id="tg029"  onKeyPress="keyFunction()"   name="tg029" value="<?php echo $tg029; ?>"   /></td>
		<td  class="normal14" >更換發票：</td>
        <td  class="normal14"  ><input type="hidden" name="tg056" value="N" />
		<input type='checkbox' tabIndex="46" id="tg056" onKeyPress="keyFunction()" name="tg056" <?php if($tg056 == 'Y' ) echo 'checked'; ?>  <?php if($tg056 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td>   
	    <td  class="normal14">新銷貨單別：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="47" id="tg057"  onKeyPress="keyFunction()"   name="tg057" value="<?php echo $tg057; ?>" disabled="disabled"  /></td>
	  </tr>
	 
	  <tr>
	    <td  class="normal14">新銷貨單號：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="48" id="tg058"  onKeyPress="keyFunction()"   name="tg058" value="<?php echo $tg058; ?>" disabled="disabled"  /></td>
		<td class="normal14"></td>
        <td class="normal14"></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	</table>
 
	</div> 	
	<!--  訂金資料 -->
	<div id="tab4" class="tab_content"> <!-- div-8 -->
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14a"  width="12%">訂單單別：</td>
       <td class="normal14a"  width="38%" ><input type="text" tabIndex="49"   onKeyPress="keyFunction()" id="tg048" name="tg048"   value="<?php echo $tg048; ?>"   /></td>
	   <td class="normal14a"  width="12%" >訂單單號：</td>
       <td class="normal14a"  width="38%" ><input type="text" tabIndex="50"   onKeyPress="keyFunction()" id="tg049" name="tg049"   value="<?php echo $tg049; ?>"   /></td>
	 </tr>
	  <tr>
	    <td  class="normal14" >沖抵金額：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="51" id="tg052"  onKeyPress="keyFunction()"   name="tg052" value="<?php echo $tg052; ?>"   /></td>	   
	    <td  class="normal14">沖抵稅額：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="52" id="tg053"  onKeyPress="keyFunction()"   name="tg053" value="<?php echo $tg053; ?>"   /></td>
	  </tr>
	  <tr>
	    <td  class="normal14" >預付待抵單別：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="53" id="tg050"  onKeyPress="keyFunction()"   name="tg050" value="<?php echo $tg050; ?>" disabled="disabled"  /></td>	   
	    <td  class="normal14">預付待抵單號：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="54" id="tg051"  onKeyPress="keyFunction()"   name="tg051" value="<?php echo $tg051; ?>" disabled="disabled"  /></td>
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
        
	
	<?php IF ($this->uri->segment(3)=='copybefore') {  ?>

        	<!--   明細0  --> 
			<?php $current_product_count = 0; ?>
		<?php $i=0; $mproduct_row=0; $product_row='0'; ?>  
			 <input id="row_count" name="row_count" value="0" style="display:none;" />
		<?php while ($i<$ii) { ?>
		<?php $current_product_count++; ?>
		<tbody  <?php echo 'id='.'product-row'.$product_row ?> >		
	     <tr>
	  <!--   <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td> -->
         <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="刪除資料" onclick="del_detail('<?php echo $tg001;?>','<?php echo $tg002; ?>','<?php echo $th003[$i]; ?>');" /></td>    	    
		<input type="hidden"  name="order_product[<?php echo $i ?>][th001]" value="<?php echo $th001[$i]; ?>" />
	     <input type="hidden" name="order_product[<?php echo $i ?>][th002]" value="<?php echo $th002[$i]; ?>" />
		 <td class="left"><input type="text"   readonly="value"   name="order_product[$i][th003]" value="<?php echo $th003[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text"  <?php echo 'id='.'th004'.$i ?>   name="order_product[<?php echo $i ?>][th004]" value="<?php echo $th004[$i]; ?>" size="12" style="background-color:#E7EFEF"  /></td>
	     <td class="left"><input  type="text"  onKeyPress="keyFunction()"  id="th005"  name="order_product[<?php echo $i ?>][th005]" value="<?php echo $th005[$i]; ?>" size="20" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text"  onKeyPress="keyFunction()"  id="th006"   name="order_product[<?php echo $i ?>][th006]" value="<?php echo $th006[$i]; ?>"  size="20" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input  type="text"  onKeyPress="keyFunction()"    id="th009"   name="order_product[<?php echo $i ?>][th009]" value="<?php echo $th009[$i]; ?>" size="4" style="background-color:#EBEBE4" /></td>
	     
		 <td class="left"><input type="text"   <?php echo 'id='.'th007'.$i ?>   name="order_product[<?php echo $i ?>][th007]" value="<?php echo $th007[$i]; ?>" size="6"  style="background-color:#E7EFEF" /></td>
		<td class="left"><input  type="text"  onKeyPress="keyFunction()"  id="th007disp"  name="order_product[<?php echo $i ?>][th007disp]" value="<?php echo $th007disp[$i]; ?>" size="10"  style="background-color:#EBEBE4" /></td>
		
	     <td class="center"><input type="text"  class="total_qty" id="th008" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th008]" value="<?php echo $th008[$i]; ?>" size="10" style="text-align:right;" /></td>
		 <td class="center"><input type="text"  id="th012" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th012]" value="<?php echo $th012[$i]; ?>" size="10" style="text-align:right;" /></td>
		 <td class="center"><input type="text"  id="th013" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th013]" value="<?php echo $th013[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" /></td>
		 <td class="center"><input type="text"  class="total_price" id="th035" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th035]" value="<?php echo $th035[$i]; ?>" size="10" style="text-align:right;;background-color:#EBEBE4;" /></td>
         <td class="center"><input type="text"   id="th036" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th036]" value="<?php echo $th036[$i]; ?>" size="10" style="text-align:right;;background-color:#EBEBE4;"  /></td>	
         <td class="right"><input readonly="value" type="text" class="total_price1" name="order_product[<?php echo $i ?>][th037]" value="<?php echo $th037[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" /></td>
		 <td class="right"><input readonly="value" type="text"  name="order_product[<?php echo $i ?>][th038]" value="<?php echo $th038[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" /></td>
		
	     <td class="left"><input type="text" id="th014"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th014]" value="<?php echo $th014[$i]; ?>" size="10"  /></td>
		 <td class="left"><input type="text" id="th015"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th015]" value="<?php echo $th015[$i]; ?>" size="10"  /></td>
		 <td class="left"><input type="text" id="th016"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th016]" value="<?php echo $th016[$i]; ?>" size="10"  /></td>
		 <td class="left"><input type="text" id="th017"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th017]" value="<?php echo $th017[$i]; ?>" size="10"  /></td>
		 <td class="left"><input type="text" id="th019"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th019]" value="<?php echo $th019[$i]; ?>" size="10"  /></td>
		 <td class="left"><input type="text" id="th030"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th030]" value="<?php echo $th030[$i]; ?>" size="10"  /></td>
	
		 <td class="left"><input type="text" id="th018"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th018]" value="<?php echo $th018[$i]; ?>" size="20"  /></td>
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
		<?php // include_once("./application/views/fun/copi08_funjsupdjs_v.php"); ?> 
		 <?php   } ?>	
          <tfoot>
		 
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="23"></td>
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
				<td ><input type='text' readonly="value" name='tg013' id="tg013" size="8" value="<?php echo $tg013; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='tg025' id="tg025" size="8" value="<?php echo $tg025; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣合計：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot"><?php echo $tg013+$tg025; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣未稅額：</b></td>
				<td ><input type='text' readonly="value" name='tg045' id="tg045" size="8" value="<?php echo $tg045; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='tg046' id="tg046" size="8" value="<?php echo $tg046; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣合計：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot1"><?php echo $tg045+$tg046; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　合計數量：</b></td>
				<td ><input type='text' readonly="value" name='tg033' id="tg033" size="8" value="<?php echo $tg033; ?>"  style="background-color:#EBEBE4" /></td>
				<input id="select_rows" style="display:none;"/>
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	  
	 <div class="buttons">
<!--	 <button type='hidden' tabIndex="91" accesskey="i"  name="insert" class="button" onclick="addItem();" value=''></button>  -->	 
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cop/copi08/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 <b style="color: #FF0000;"><span>&nbsp;&nbsp;複製客戶訂單&nbsp;</span></b><a  href="javascript:;"><img id="Showcopc08a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/>
	 </div> 
		</div> 	   
    </form>
	   <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位,交貨庫別,可輸入部份品號或品名下拉視窗選擇,欄位顏色不同抉按2下開視窗選擇,單價欄位可歷史單價查詢. ] ' ?> </div>  <?php } ?>
	
    </div> <!-- div-6 -->
	
  </div> <!-- div-5 -->
 
</div> <!-- div-4 -->

 
   
	</div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<form action="<?php echo base_url()?>index.php/cop/copi08/delete_detaila" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
     <?php // include_once("./application/views/fun/copi08_funjs_v.php"); ?> 
<?php  include_once("./application/views/funnew/copi03b_funmjs_v.php"); ?> <!-- 訂單單別 -->
<?php  include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?>  <!-- 業務員 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/copi01a_funmjs_v.php"); ?>  <!-- 客戶回傳多欄 -->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?>  <!-- 部門 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->
<?php  include_once("./application/views/funnew/cmsi21_funmjs_v.php"); ?>  <!-- 付款條件 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/copi08_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#copi03').focus();
	}); 	   
</script>   