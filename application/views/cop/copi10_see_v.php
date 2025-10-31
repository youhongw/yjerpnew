<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?> 
    </div>

<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> pos客戶銷貨單建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cop/copi10/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	 
	  </div>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cop/copi10/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
<!--	<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php $i=0; ?>
		<?php $ii=0; ?>
	<?php foreach($result as $row) { ?>
            <?php  $copq03a23=$row->tg001;?> 
		  <?php  $copq03a23disp=$row->tg001disp;?> 
		  <?php   $tg002=$row->tg002;?>    
          <?php   $tg003=substr($row->tg003,0,4).'/'.substr($row->tg003,4,2).'/'.substr($row->tg003,6,2);?>
		  <?php   $copq01a=$row->tg004;?> 
		  <?php   $copq01adisp=$row->tg004disp;?> 
          <?php   $cmsq05a=$row->tg005;?>
		  <?php   $cmsq05adisp=$row->tg005disp;?>
		  <?php   $cmsq09a3=$row->tg006;?>    
		  <?php   $cmsq09a3disp=$row->tg006disp;?>    
		  <?php   $tg007=$row->tg007;?>    
		  <?php   $tg008=$row->tg008;?>
          <?php   $tg009=$row->tg009;?>
	      <?php   $cmsq02a=$row->tg010;?>   
          <?php   $cmsq02adisp=$row->tg010disp;?>   		  
		  <?php   $cmsq06a=$row->tg011;?>
		   <?php   $cmsq06adisp=$row->tg011disp;?>
          <?php   $tg012=$row->tg012;?>
		  <?php   $tg013=$row->tg013;?>
		  <?php   $tg014=$row->tg014;?>
          <?php   $tg015=$row->tg015;?>     
          <?php   $tg016=$row->tg016;?>
		  <?php   $tg017=$row->tg017;?>
		  <?php   $tg018=$row->tg018;?>
		  <?php   $tg019=$row->tg019;?>     
		  <?php   $tg020=$row->tg020;?>
		  <?php   $tg021=$row->tg021;?>
		  <?php   $tg022=$row->tg022;?>
		  <?php   $tg023=$row->tg023;?>
		  <?php   $tg024=$row->tg024;?>
		  <?php   $tg025=$row->tg025;?>
	      <?php   $cmsq09a31=$row->tg026;?>
		  <?php   $cmsq09a31disp=$row->tg026disp;?>
		  <?php   $tg027=$row->tg027;?>
		  <?php   $tg028=$row->tg028;?>
		  <?php   $tg029=$row->tg029;?>
		  <?php   $tg030=$row->tg030;?>
		  <?php   $tg031=$row->tg031;?>
		  <?php   $tg032=$row->tg032;?>
		  <?php   $tg033=$row->tg033;?>
		  <?php   $tg034=$row->tg034;?>
		  <?php   $cmsq09a32=$row->tg035;?>
		  <?php   $cmsq09a32disp=$row->tg035disp;?>
		  <?php   $tg036=$row->tg036;?>
		  <?php   $tg037=$row->tg037;?>
		
		 <?php   $tg038=substr($row->tg038,0,4).substr($row->tg038,5,2);?>
		  <?php   $tg039=$row->tg039;?>
		  <?php   $tg040=$row->tg040;?>
		  <?php   $tg041=$row->tg041;?>
		  <?php   $tg042=substr($row->tg042,0,4).'/'.substr($row->tg042,4,2).'/'.substr($row->tg042,6,2);?>
		  <?php   $tg043=$username;?>		
		  <?php   $tg044=$row->tg044;?>
		  <?php   $tg045=$row->tg045;?>
		  <?php   $tg046=$row->tg046;?>
		  <?php   $cmsq21a2=$row->tg047;?>
	      <?php   $cmsq21a2disp=$row->tg047disp;?>
	      <?php   $tg048=$row->tg048;?>
		  <?php   $tg049=$row->tg049;?>
		  <?php   $tg050=$row->tg050;?>
		  <?php   $tg051=$row->tg051;?>	
		  <?php   $tg052=$row->tg052;?>	
		  <?php   $tg053=$row->tg053;?>	
		  <?php   $tg054=$row->tg054;?>	
		  <?php   $tg055=$row->tg055;?>	
		  <?php   $tg056=$row->tg056;?>	
		  <?php   $tg057=$row->tg057;?>	
		  <?php   $tg058=$row->tg058;?>	
		  <?php   $tg059=$row->tg059;?>	
		  <?php   $tg060=$row->tg060;?>	
		  <?php   $tg061=$row->tg061;?>	
	  
		   <?php   $flag=$row->flag;?>	
		
		 <!-- 明細 -->
		 		 
		   <?php   $th001[]=$row->th001;?>
		   <?php  $th002[]=$row->th002;?>
		   <?php   $th003[]=$row->th003;?>
		   <?php   $th004[]=$row->th004;?> 
		   <?php   $th005[]=$row->th005;?>
		   <?php   $th006[]=$row->th006;?>
		   <?php   $th007[]=$row->th007;?>   
		   <?php   $th007disp[]=$row->th007disp;?>
		   <?php   $th008[]=$row->th008;?>
		   <?php   $th009[]=$row->th009;?>
		   <?php   $th012[]=$row->th012;?>  
		   <?php   $th013[]=$row->th013;?>  
		   <?php   $th014[]=$row->th014;?>  
		   <?php   $th015[]=$row->th015;?>  
		   <?php   $th016[]=$row->th016;?>  
		   <?php   $th017[]=$row->th017;?>  
		   <?php   $th018[]=$row->th018;?> 
           <?php   $th019[]=$row->th019;?>
           <?php   $th030[]=$row->th030;?>   		   
		   <?php   $th035[]=$row->th035;?>   
		   <?php   $th036[]=$row->th036;?>   
		   <?php   $th037[]=$row->th037;?> 
		   <?php   $th038[]=$row->th038;?> 
		   
		   <?php   $th008a[]=$row->th008;?>
		  <?php   $mb991=' ';?>
		  <?php   $mb992=' ';?>
		  <?php   $mb999=' ';?>
	<?php $ii = $ii + 1 ; }?>
     <?php 
	  if(!isset($sysma200)) { $sysma200=$this->session->userdata('sysma200'); }
	  if(!isset($sysma201)) { $sysma201=$this->session->userdata('sysma201'); }  ?>
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="normal14y"  width="8%"><span class="required">銷貨單別：</span> </td>
        <td class="normal14a"  width="25%"><input tabIndex="1" id="tg001"    onKeyPress="keyFunction()"  onChange="startcopq03a23(this)"  name="copq03a23" value="<?php echo strtoupper($copq03a23); ?>"  type="text" required disabled="disabled"/><a href="javascript:;"><img id="Showcopq03a23" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="copq03a23disp"> <?php    echo $copq03a23disp; ?> </span></td>
	    <td class="normal14y" width="9%" >單據日期： </td>
        <td class="normal14a"  width="25%" ><input tabIndex="2"  onclick="scwShow(this,event);" onfocus="selappr()" class="date" id="tg042" onKeyPress="keyFunction()"  onchange="chkno1(this)" name="tg042"  value="<?php echo $tg042; ?>"  size="12" type="text" disabled="disabled"  /></td>
	    <td class="normal14y"  width="8%" ><span class="required">銷貨單號：</span></td>
        <td class="normal14a"  width="25%" ><input tabIndex="3" id="tg002" onKeyPress="keyFunction()" onfocus="chkno1(this)" name="tg002" value="<?php echo $tg002; ?>" size="30" type="text" required disabled="disabled" /><span id="tg002disp" ></span></td>
	  </tr>	
	  <tr>
		 <td class=""normal14z"">客戶代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="tg004" onKeyPress="keyFunction()" onfocus="chkno1(this)" onchange="startcopq01a(this)" name="copq01a" value="<?php echo $copq01a; ?>" size="10" type="text" disabled="disabled" /><img id="Showcopq01a" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
        <span id="copq01adisp"> <?php   echo $copq01adisp; ?> </span></td>
	    <td  class="normal14z">現銷：</td>						
        <td  class="normal14"  ><input type="hidden" name="tg034" value="N" />
		<input type='checkbox' tabIndex="5" id="tg034" onKeyPress="keyFunction()" name="tg034" <?php if($tg034 == 'Y' ) echo 'checked'; ?>  <?php if($tg034 !== 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled" /></td> 
	     <td class="normal14z">確認碼：</td>
          <td  class="normal14"  ><select id="tg023" onKeyPress="keyFunction()" name="tg023" onChange="selappr(this)" tabIndex="6" disabled="disabled">
            <option <?php if($tg023 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tg023 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tg023 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td> 
	  </tr>
		
	  <tr>
	     <td class="normal14z">銷貨日期：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" readonly="value"  onKeyPress="keyFunction()" id="tg003" name="tg003"   value="<?php echo $tg003; ?>"  style="background-color:#EBEBE4" disabled="disabled" /></td>
	    <td  class="normal14z">分錄-收入：</td>						
        <td  class="normal14"  ><input type="hidden" name="tg036" value="N" readonly="value" />
		<input type='checkbox' tabIndex="8" id="tg036" onKeyPress="keyFunction()" name="tg036" <?php if($tg034 == 'Y' ) echo 'checked'; ?>  <?php if($tg036 !== 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled" /></td> 
		<td  class="normal14z">分錄-成本：</td>						
        <td  class="normal14"  ><input type="hidden" name="tg034" value="N" readonly="value"  />
		<input type='checkbox' tabIndex="9" id="tg037" onKeyPress="keyFunction()" name="tg037" <?php if($tg037 == 'Y' ) echo 'checked'; ?>  <?php if($tg037 !== 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled" /></td> 
		
	  </tr>
	  <tr>
	     <td class="normal14z">流程代號：</td>
        <td  class="normal14"  ><input type="text" tabIndex="10" readonly="value"  onKeyPress="keyFunction()" id="tg060" name="tg060"   value="<?php echo $tg060; ?>" style="background-color:#EBEBE4" disabled="disabled" /></td>
        <td class="normal14z">拋轉狀態：</td>
        <td  class="normal14"  ><select id="tg059" tabIndex="11" readonly="value" onKeyPress="keyFunction()" name="tg059"   style="background-color:#EBEBE4" disabled="disabled">
            <option <?php if($tg059 == 'N') echo 'selected="selected"';?> value='N'>N.未拋轉</option>                                                                        
		    <option <?php if($tg059 == 'Y') echo 'selected="selected"';?> value='Y'>Y.拋轉成功(來源廠商)</option>
            <option <?php if($tg059 == 'y') echo 'selected="selected"';?> value='y'>y.拋轉成功(下游廠商)</option>
		    <option <?php if($tg059 == 'n') echo 'selected="selected"';?> value='n'>n.訂單變更</option>
            <option <?php if($tg059 == 'U') echo 'selected="selected"';?> value='U'>U.拋轉失敗</option>	
            <option <?php if($tg059 == 'u') echo 'selected="selected"';?> value='u'>u.還原失敗</option>	
		  </select></td>
		  <td class="normal14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" /></td>
         <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" /></td>
	  </tr>
	 
		
	</table>
	
	<div class="abgne_tab"> <!-- div-7 -->
		<ul class="tabs">
		<li><a href="#tab1"  accesskey="a">交易資料a</a></li>
		<li><a href="#tab2"  accesskey="b">發票資料b</a></li>
		<li><a href="#tab3"  accesskey="c">其他資料c</a></li>
		<li><a href="#tab4"  accesskey="g">訂金資料g</a></li>
		</ul>

    <div class="tab_container"> <!-- div-8 -->
	
	<!--   基本資料 -->	
	<div id="tab1" class="tab_content">
      <table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="9%">廠別：</td>
       <td class="normal14a"  width="25%" ><input type="text" tabIndex="12" onKeyPress="keyFunction()" id="tg010"  onchange="startcmsq02a(this)" name="cmsq02a"   value="<?php echo  $cmsq02a; ?>"   disabled="disabled"  /><a href="javascript:;"><img id="Showcmsq02a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	   <span id="cmsq02adisp"> <?php    echo $cmsq02adisp; ?> </span></td>
	   <td class="normal14y"  width="9%" > 件數：</td>
       <td class="normal14a"  width="27%" ><input type="text" tabIndex="13" id="tg032"   tabIndex="11"   onKeyPress="keyFunction()"    name="tg032" value="<?php echo $tg032; ?>" disabled="disabled" /></td>	  
       <td class="normal14y" width="9%" >幣別：</td>
	   <td class="normal14a" width="26%" ><input tabIndex="14" id="tg011" onKeyPress="keyFunction()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text" disabled="disabled"  /><a href="javascript:;"><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
       <span id="cmsq06adisp" > <?php    echo $cmsq06adisp; ?> </span></td>
	 </tr>
	 
	  <tr>
	    <td  class="normal14z" >付款條件：</td>
        <td  class="normal14"  ><input tabIndex="15" id="tg047" onKeyPress="keyFunction()" name="cmsq21a2" onchange="startcmsq21a2(this)"   value="<?php echo  $cmsq21a2; ?>"     type="text" disabled="disabled" /><a href="javascript:;"><img id="Showcmsq21a2" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="cmsq21a2disp"> <?php    echo $cmsq21a2disp; ?> </span></td>		   
	    <td class="normal14z" >部門代號：</td>
       <td class="normal14a"  ><input type="text" tabIndex="16" onKeyPress="keyFunction()" id="tg005"  name="cmsq05a"  onchange="startcmsq05a(this)"    value="<?php echo  $cmsq05a; ?>"  disabled="disabled"   /><a href="javascript:;"><img id="Showcmsq05a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
	   <span id="cmsq05adisp" > <?php    echo $cmsq05adisp; ?> </span></td>
	    <td class="normal14z" >匯率：</td>		
        <td class="normal14"  ><input type="text" id="tg012"   tabIndex="17"   onKeyPress="keyFunction()"    name="tg012" value="<?php echo $tg012; ?>" disabled="disabled" /></td>
	  </tr>
	  <tr>	   
	   <td class="normal14z" >業務人員：</td>
        <td class="normal14a"  ><input tabIndex="18" id="tg006" onKeyPress="keyFunction()" name="cmsq09a3" onchange="startcmsq09a3(this)"  value="<?php echo $cmsq09a3; ?>"  type="text" disabled="disabled"  /><a href="javascript:;"><img id="Showcmsq09a3" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
        <span id="cmsq09a3disp"> <?php    echo $cmsq09a3disp; ?> </span></td>
	    <td class="normal14z">備註：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="19"   onKeyPress="keyFunction()" id="tg020" name="tg020"   value="<?php echo $tg020; ?>"  disabled="disabled"  /></td>
	    <td class="normal14z">送貨地址1</td>						
        <td  class="normal14"  ><input type="text" tabIndex="20"   onKeyPress="keyFunction()" id="tg008" name="tg008"   value="<?php echo $tg008; ?>"  size="40px" disabled="disabled" /></td>
	  </tr>
	  <tr>
	    <td class="normal14z">帳單地址：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="21"   onKeyPress="keyFunction()" id="tg009" name="tg009"   value="<?php echo $tg009; ?>"  size="40px" disabled="disabled" /></td>
		<td class="normal14z" >列印：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="22"   onKeyPress="keyFunction()" id="tg022" name="tg022"   value="<?php echo $tg022; ?>" disabled="disabled" /></td>
	    <td class="normal14z" >發票列印：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="23"   onKeyPress="keyFunction()" id="tg041" name="tg041"   value="<?php echo $tg041; ?>" disabled="disabled" /></td>
	  </tr>
      <tr>
	    <td class="normal14z">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="24" readonly="value"  onKeyPress="keyFunction()" id="tg043" name="tg043"   value="<?php echo $tg043; ?>" style="background-color:#EBEBE4" disabled="disabled" /></td>
	    <td  class="normal14z" >簽核狀態：</td>
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
	
	<!--  發票資料 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	  
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="9%">統一編號：</td>
       <td class="normal14a"  width="26%" ><input type="text" tabIndex="26"   onKeyPress="keyFunction()" id="tg015" name="tg015"   value="<?php echo $tg015; ?>"  disabled="disabled" /></td>
	   <td class="normal14y"  width="9%" >發票號碼：</td>
       <td class="normal14a"  width="26%" ><input type="text" tabIndex="27"   onKeyPress="keyFunction()" id="tg014" name="tg014"   value="<?php echo $tg014; ?>"  disabled="disabled" /></td>
	   <td class="normal14y" width="9%">發票日期：</td>						
        <td  class="normal14a" width="25%" ><input type="text" tabIndex="28"   onKeyPress="keyFunction()"  onclick="scwShow(this,event);" id="tg021" name="tg021"   value="<?php echo $tg021; ?>" disabled="disabled"   /></td>
	</tr>			  
	 <tr>
	    <td  class="normal14z" >申報年月：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="29" id="tg038"  onKeyPress="keyFunction()"  onclick="dateym();" class="date-picker" name="tg038" value="<?php echo $tg038; ?>" disabled="disabled"  /></td>	   
	    <td  class="normal14z">營業稅率：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="30" id="tg044"  onKeyPress="keyFunction()"   name="tg044" value="<?php echo $tg044; ?>"  disabled="disabled" /></td>
	    <td  class="normal14z">客戶全名：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="31" id="tg007"  onKeyPress="keyFunction()"   name="tg007" value="<?php echo $tg007; ?>" disabled="disabled"  /></td>
	  </tr>
	  <tr>
	    <td  class="normal14z" >發票地址1：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="32" id="tg018"  onKeyPress="keyFunction()"   name="tg018" value="<?php echo $tg018; ?>" size="40px" disabled="disabled" /></td>	   
	    <td  class="normal14z">發票地址2：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="33" id="tg019"  onKeyPress="keyFunction()"   name="tg019" value="<?php echo $tg019; ?>"  size="40px" disabled="disabled"/></td>
	    <td class="normal14z" >隨貨附發票：</td>
        <td class="normal14"><input type="hidden" name="tg061" value="N" />
		<input type='checkbox' tabIndex="34" id="tg061" onKeyPress="keyFunction()" name="tg061" <?php if($tg061 == 'Y' ) echo 'checked'; ?>  <?php if($tg061 !== 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled" /></td> 
	  </tr>
	  <tr>
	   <td class="normal14z"  >發票聯數：</td>
        <td class="normal14" ><select id="tg016" onKeyPress="keyFunction()" name="tg016"  tabIndex="35" disabled="disabled">
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
		<td class="normal14z"  >課稅別：</td>
        <td class="normal14" ><select id="tg017" onKeyPress="keyFunction()" name="tg017" onchange="seltax()" tabIndex="36" disabled="disabled">
		    <option <?php if($tg017 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php if($tg017 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php if($tg017 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php if($tg017 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php if($tg017 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select><span  id="taxdisp" ></span></td>
	  <td class="normal14z" >菸酒註記：</td>
        <td class="normal14"><input type="hidden" name="tg043" value="N" />
		<input type='checkbox' tabIndex="37" id="tg031" onKeyPress="keyFunction()" name="tg031" <?php if($tg031 == 'Y' ) echo 'checked'; ?>  <?php if($tg031 !== 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled" /></td> 
	  </tr>	
	  
	   <tr>
	    <td  class="normal14z">發票作廢：</td>						
        <td  class="normal14"  ><input type="hidden" name="tg030" value="N" />
		<input type='checkbox' tabIndex="38" id="tg030" onKeyPress="keyFunction()" name="tg030" <?php if($tg030 == 'Y' ) echo 'checked'; ?>  <?php if($tg030 !== 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled" /></td> 
       	<td class="normal14"></td>
        <td class="normal14"></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	</table>
 
	</div> 	
	<!--  訂金資料 -->
	<div id="tab3" class="tab_content"> <!-- div-8 -->
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="11%">員工代號：</td>
       <td class="normal14a"  width="23%" ><input tabIndex="39" id="tg035" onKeyPress="keyFunction()" name="cmsq09a32" onchange="startcmsq09a32(this)"  value="<?php echo $cmsq09a32; ?>"  type="text" disabled="disabled"  /><a href="javascript:;"><img id="Showcmsq09a32" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
        <span id="cmsq09a32disp"> <?php    echo $cmsq09a32disp; ?> </span></td>
	   <td class="normal14y"  width="15" >收款業務員：</td>
       <td class="normal14a"  width="22%" ><input tabIndex="40" id="tg026" onKeyPress="keyFunction()" name="cmsq09a31" onchange="startcmsq09a31(this)"  value="<?php echo $cmsq09a31; ?>"  type="text" disabled="disabled"  /><a href="javascript:;"><img id="Showcmsq09a31" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
        <span id="cmsq09a31disp"> <?php    echo $cmsq09a31disp; ?> </span></td>
	   <td  class="normal14y" width="10%" >L/C NO：</td>
        <td  class="normal14a" width="24%" ><input type="text"   tabIndex="41" id="tg039"  onKeyPress="keyFunction()"   name="tg039" value="<?php echo $tg039; ?>"  disabled="disabled" /></td>	
	 </tr>
	   <tr>
	    <td  class="normal14z" >INVOICE NO：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="42" id="tg040"  onKeyPress="keyFunction()"   name="tg040" value="<?php echo $tg040; ?>"  disabled="disabled" /></td>	   
	    <td  class="normal14z">備註一：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="43" id="tg027"  onKeyPress="keyFunction()"   name="tg027" value="<?php echo $tg027; ?>"  disabled="disabled" /></td>
	    <td  class="normal14z">備註二：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="44" id="tg028"  onKeyPress="keyFunction()"   name="tg028" value="<?php echo $tg028; ?>" disabled="disabled"  /></td>
	  </tr>
	  <tr>
	    <td  class="normal14z">備註三：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="45" id="tg029"  onKeyPress="keyFunction()"   name="tg029" value="<?php echo $tg029; ?>" disabled="disabled"  /></td>
		<td  class="normal14z" >更換發票：</td>
        <td  class="normal14"  ><input type="hidden" name="tg056" value="N" />
		<input type='checkbox' tabIndex="46" id="tg056" onKeyPress="keyFunction()" name="tg056" <?php if($tg056 == 'Y' ) echo 'checked'; ?>  <?php if($tg056 !== 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled" /></td>   
	    <td  class="normal14z">新銷貨單別：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="47" id="tg057"  onKeyPress="keyFunction()"   name="tg057" value="<?php echo $tg057; ?>" disabled="disabled"  /></td>
	  </tr>
	 
	  <tr>
	    <td  class="normal14z">新銷貨單號：</td>		
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
	   <td class="normal14y"  width="12%">訂單單別：</td>
       <td class="normal14a"  width="38%" ><input type="text" tabIndex="49"   onKeyPress="keyFunction()" id="tg048" name="tg048"   value="<?php echo $tg048; ?>"  disabled="disabled" /></td>
	   <td class="normal14y"  width="12%" >訂單單號：</td>
       <td class="normal14a"  width="38%" ><input type="text" tabIndex="50"   onKeyPress="keyFunction()" id="tg049" name="tg049"   value="<?php echo $tg049; ?>" disabled="disabled"  /></td>
	 </tr>
	  <tr>
	    <td  class="normal14z" >沖抵金額：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="51" id="tg052"  onKeyPress="keyFunction()"   name="tg052" value="<?php echo $tg052; ?>" disabled="disabled"  /></td>	   
	    <td  class="normal14z">沖抵稅額：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="52" id="tg053"  onKeyPress="keyFunction()"   name="tg053" value="<?php echo $tg053; ?>" disabled="disabled"  /></td>
	  </tr>
	  <tr>
	    <td  class="normal14z" >預付待抵單別：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="53" id="tg050"  onKeyPress="keyFunction()"   name="tg050" value="<?php echo $tg050; ?>" disabled="disabled"  /></td>	   
	    <td  class="normal14z">預付待抵單號：</td>		
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
		      <td width="11%" class="center">品號</td>
              <td width="6%" class="left">品名</td>
			  <td width="6%" class="left">規格</td>  
			  <td width="6%" class="center">單位</td>
			  <td width="6%" class="center">序號</td>
			  <td width="6%" class="left">出貨庫別</td>
		 	  <td width="6%" class="left">庫別名稱</td> 
              <td width="6%" class="center">數量</td>
              <td width="6%" class="right">單價</td>
              <td width="6%" class="right">金額</td>
			   <td width="6%" class="right">原幣金額</td>
			  <td width="6%" class="center">原幣稅額</td>
              <td width="6%" class="right">本幣金額</td>
			  <td width="6%" class="center">本幣稅額</td>
              <td width="6%" class="right">訂單單別</td>
			  <td width="6%" class="right">訂單單號</td>
			  <td width="6%" class="right">訂單序號</td>
			  <td width="6%" class="right">批號</td>
			  <td width="6%" class="right">客戶品號</td>
			  <td width="6%" class="right">專案代號</td>
			  <td width="14%" class="center">備註</td>
			  
            </tr>
        </thead>
      
   	<!--   明細0  --> 
		<?php $i=0; $mproduct_row=0; $product_row='0'; ?>  
			 
		<?php while ($i<$ii) { ?>
		<tbody   <?php echo    "id=product-row".$product_row ?> >		  		
	     <tr>
	     <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td>
  	       <input type="hidden"  name="order_product[<?php echo $i ?>][th001]" value="<?php echo $th001[$i]; ?>" />
	     <input type="hidden" name="order_product[<?php echo $i ?>][th002]" value="<?php echo $th002[$i]; ?>" />
		 <input type="hidden" name="order_product[<?php echo $i ?>][th008a]" value="<?php echo $th008a[$i]; ?>" />
	     <td class="left"><input type="text"  <?php echo 'id='.'th004'.$i ?>   name="order_product[<?php echo $i ?>][th004]" value="<?php echo $th004[$i]; ?>" size="20"  disabled="disabled" /></td>
	     <td class="left"><input  type="text"  onKeyPress="keyFunction()"  id="th005"  name="order_product[<?php echo $i ?>][th005]" value="<?php echo $th005[$i]; ?>"  style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text"  onKeyPress="keyFunction()"  id="th006"   name="order_product[<?php echo $i ?>][th006]" value="<?php echo $th006[$i]; ?>"  size="30" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input  type="text"  onKeyPress="keyFunction()"    id="th009"   name="order_product[<?php echo $i ?>][th009]" value="<?php echo $th009[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text"   readonly="value"   name="order_product[$i][th003]" value="<?php echo $th003[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
		 <td class="left"><input type="text"   <?php echo 'id='.'th007'.$i ?>   name="order_product[<?php echo $i ?>][th007]" value="<?php echo $th007[$i]; ?>" size="10"  disabled="disabled" /></td>
		<td class="left"><input  type="text"  onKeyPress="keyFunction()"  id="th007disp"  name="order_product[<?php echo $i ?>][th007disp]" value="<?php echo $th007disp[$i]; ?>"  style="background-color:#EBEBE4" /></td>
		
	     <td class="center"><input type="text"  class="total_qty" id="th008" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th008]" value="<?php echo $th008[$i]; ?>" size="10" style="text-align:right;" disabled="disabled"/></td>
		 <td class="center"><input type="text"  id="th012" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th012]" value="<?php echo $th012[$i]; ?>" size="10" style="text-align:right;"  disabled="disabled"/></td>
		 <td class="center"><input type="text"  id="th013" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th013]" value="<?php echo $th013[$i]; ?>" size="10" style="text-align:right;;background-color:#EBEBE4;" disabled="disabled"/></td>
		 <td class="center"><input type="text"  class="total_price" id="th035" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th035]" value="<?php echo $th035[$i]; ?>" size="10" style="text-align:right;;background-color:#EBEBE4;" /></td>
         <td class="center"><input type="text"   id="th036" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th036]" value="<?php echo $th036[$i]; ?>" size="10" style="text-align:right;;background-color:#EBEBE4;"  /></td>	
         <td class="right"><input readonly="value" type="text" class="total_price1" name="order_product[<?php echo $i ?>][th037]" value="<?php echo $th037[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" /></td>
		 <td class="right"><input readonly="value" type="text"  name="order_product[<?php echo $i ?>][th038]" value="<?php echo $th038[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" /></td>
		
	     <td class="left"><input type="text" id="th014"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th014]" value="<?php echo $th014[$i]; ?>" size="10" disabled="disabled"  /></td>
		 <td class="left"><input type="text" id="th015"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th015]" value="<?php echo $th015[$i]; ?>" size="10" disabled="disabled" /></td>
		 <td class="left"><input type="text" id="th016"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th016]" value="<?php echo $th016[$i]; ?>" size="10" disabled="disabled" /></td>
		 <td class="left"><input type="text" id="th017"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th017]" value="<?php echo $th017[$i]; ?>" size="10" disabled="disabled" /></td>
		 <td class="left"><input type="text" id="th019"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th019]" value="<?php echo $th019[$i]; ?>" size="10" disabled="disabled" /></td>
		 <td class="left"><input type="text" id="th030"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th030]" value="<?php echo $th030[$i]; ?>" size="10" disabled="disabled" /></td>
	
		 <td class="left"><input type="text" id="th018"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th018]" value="<?php echo $th018[$i]; ?>" size="20" disabled="disabled" /></td>
	     </tr>	   
        </tbody>
        <?php $i++; $mproduct_row = (int) $product_row + 1; $product_row=(string)$mproduct_row;?>
 
 <?php } ?>		 
    <!-- javascrit 0 -->
	 
	<?php include("./application/views/fun/copi10_funjsupdjs_v.php"); ?> 
		
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
	
	 </div>
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
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->		
	<!--<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cop/copi10/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	</div> -->
	  
      </form>
	  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>  -->
  
     </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  <!--  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>  -->
  </div> <!-- div-3 -->
 </div> <!-- div-2 -->
</div> <!-- div-1 -->
