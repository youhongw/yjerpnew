 <div id="container">   <!-- div-1 -->
  <div id="header">     <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	   </div>-->
	   <?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content">   <!-- div-3 -->
 <div class="box">   <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 票據科目建立作業 - -修改　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#md024').focus();" tabIndex="88" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  tabIndex="89" id='cancel' name='cancel' href="<?php echo site_url('main/index/110'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  
	</div>
	
    <div class="content">  <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/not/noti11/updsave" method="post" enctype="multipart/form-data" >
	 <!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general">   <!-- div-tab -->
	<?php
    date_default_timezone_set("Asia/Taipei");
	?>
	
	<?php foreach($results as $row ) : ?>
          <?php   $md001c[]=$row->md001;?>
          <?php   $md002c[]=$row->md002;?>
          <?php   $md003c[]=$row->md003;?>
          <?php   $md004c[]=$row->md004;?>
          <?php   $md005c[]=$row->md005;?>
          <?php   $md006c[]=$row->md006;?>
		  <?php   $md007c[]=$row->md007;?>
		  <?php   $md008c[]=$row->md008;?>
		  <?php   $md009c[]=$row->md009;?>
		  <?php   $md010c[]=$row->md010;?>
		  <?php   $md011c[]=$row->md011;?>
		  <?php   $md012c[]=$row->md012;?>
		  <?php   $md013c[]=$row->md013;?>
		  <?php   $md014c[]=$row->md014;?>
		  <?php   $md015c[]=$row->md015;?>
		  <?php   $md016c[]=$row->md016;?>
		  <?php   $md017c[]=$row->md017;?>
		  <?php   $md018c[]=$row->md018;?>
		  <?php   $md019c[]=$row->md019;?>
		  <?php   $md020c[]=$row->md020;?>
		  <?php   $md021c[]=$row->md021;?>
		  <?php   $md022c[]=$row->md022;?>
		  <?php   $md023c[]=$row->md023;?>
		  <?php   $md024c[]=$row->md024;?>
		  <?php   $md025c[]=$row->md025;?>
		  <?php   $md026c[]=$row->md026;?>
		  <?php   $md027c[]=$row->md027;?>
		  <?php   $md028c[]=$row->md028;?>
		  <?php   $md029c[]=$row->md029;?>
		  <?php   $md030c[]=$row->md030;?>
		  <?php   $md031c[]=$row->md031;?>
		  <?php   $md032c[]=$row->md032;?>
		  <?php   $md033c[]=$row->md033;?>
		  <?php   $md034c[]=$row->md034;?>
		  <?php   $md035c[]=$row->md035;?>
		  <?php   $md036c[]=$row->md036;?>
		  <?php   $md037c[]=$row->md037;?>
		  <?php   $md038c[]=$row->md038;?>
		  <?php   $md039c[]=$row->md039;?>
		  <?php   $md040c[]=$row->md040;?>
		  <?php   $md041c[]=$row->md041;?>
		  <?php   $md042c[]=$row->md042;?>
		  <?php   $md043c[]=$row->md043;?>
		  <?php   $md044c[]=$row->md044;?>
		  <?php   $md045c[]=$row->md045;?>
		  <?php   $md046c[]=$row->md046;?>
		  <?php   $md047c[]=$row->md047;?>
		  <?php   $md048c[]=$row->md048;?>
		  <?php   $md049c[]=$row->md049;?>
		  <?php   $md050c[]=$row->md050;?>
		  <?php   $md051c[]=$row->md051;?>
		  <?php   $md052c[]=$row->md052;?>
		  <?php   $md053c[]=$row->md053;?>
		  <?php   $md054c[]=$row->md054;?>
		  <?php   $md055c[]=$row->md055;?>
		  <?php   $md056c[]=$row->md056;?>
		  <?php   $md057c[]=$row->md057;?>
		  <?php   $md058c[]=$row->md058;?>
		  <?php   $md059c[]=$row->md059;?>
		  <?php   $md060c[]=$row->md060;?>
		  <?php   $md061c[]=$row->md061;?>
		  <?php   $md062c[]=$row->md062;?>
		  <?php   $md063c[]=$row->md063;?>
		  <?php   $md064c[]=$row->md064;?>
		  <?php   $md065c[]=$row->md065;?>
		  <?php   $md066c[]=$row->md066;?>
		  <?php   $md067c[]=$row->md067;?>
		  <?php   $md068c[]=$row->md068;?>
		  <?php   $md069c[]=$row->md069;?>
		  
		  <?php   $companyc[]=$row->company;?>
		  <?php   $creatorc[]=$row->creator;?>
		  <?php   $usr_groupc[]=$row->usr_group;?>
		  <?php   $create_datec[]=$row->create_date;?>
		  <?php   $modifierc[]=$row->modifier;?>
		  <?php   $modi_datec[]=$row->modi_date;?>
          <?php   $flagc[]=$row->flag;?>	  
	 <?php endforeach;?>
	 
	 <?php $md001=$md001c[0];?>
	 <?php $md002=$md002c[0];?>
	 <?php if (!isset($md003c[0])) {$md003='';} else {$md003=$md003c[0];}?>
	 <?php if (!isset($md004c[0])) {$md004='';} else {$md004=$md004c[0];}?>
	
	 <?php $md005=$md005c[0];?>
	 <?php $md006=$md006c[0];?>
	 <?php $md007=$md007c[0];?>
	 <?php $md008=$md008c[0];?>
	 <?php $md009=$md009c[0];?>
	 <?php $md010=$md010c[0];?>
	 <?php $md011=$md011c[0];?>
	 <?php $md012=$md012c[0];?>
	 <?php $md013=$md013c[0];?>
	 <?php $md014=$md014c[0];?>
	 <?php $md015=$md015c[0];?>
	 <?php $md016=$md016c[0];?>
	 <?php $md017=$md017c[0];?>
	 <?php $md018=$md018c[0];?>
	 <?php $md019=$md019c[0];?>
	 <?php $md020=$md020c[0];?>
	 <?php $md021=$md021c[0];?>
	 <?php $md022=$md022c[0];?>
	 <?php $md023=$md023c[0];?>
	 <?php $md024=$md024c[0];?>
	 <?php $md025=$md025c[0];?>
	 <?php $md026=$md026c[0];?>
	 <?php $md027=$md027c[0];?>
	 <?php $md028=$md028c[0];?>
	 <?php $md029=$md029c[0];?>
	 <?php $md030=$md030c[0];?>
	 <?php $md031=$md031c[0];?>
	 <?php $md032=$md032c[0];?>
	 <?php $md033=$md033c[0];?>
	 <?php $md034=$md034c[0];?>
	 <?php $md035=$md035c[0];?>
	 <?php $md036=$md036c[0];?>
	 <?php $md037=$md037c[0];?>
	 <?php $md038=$md038c[0];?>
	 <?php $md039=$md039c[0];?>
	 <?php $md040=$md040c[0];?>
	 <?php $md041=$md041c[0];?>
	 <?php $md042=$md042c[0];?>
	 <?php $md043=$md043c[0];?>
	 <?php $md044=$md044c[0];?>
	 <?php $md045=$md045c[0];?>
	 <?php $md046=$md046c[0];?>
	 <?php $md047=$md047c[0];?>
	 <?php $md048=$md048c[0];?>
	 <?php $md049=$md049c[0];?>
	 <?php $md050=$md050c[0];?>
	 <?php $md051=$md051c[0];?>
	 <?php $md052=$md052c[0];?>
	 <?php $md053=$md053c[0];?>
	 <?php $md054=$md054c[0];?>
	 <?php $md055=$md055c[0];?>
	 <?php $md056=$md056c[0];?>
	 <?php $md057=$md057c[0];?>
	 <?php $md058=$md058c[0];?>
	 <?php $md059=$md059c[0];?>
	 <?php $md060=$md060c[0];?>
	 <?php $md061=$md061c[0];?>
	 <?php $md062=$md062c[0];?>
	 <?php $md063=$md063c[0];?>
	 <?php $md064=$md064c[0];?>
	 <?php $md065=$md065c[0];?>
	 <?php $md066=$md066c[0];?>
	 <?php $md067=$md067c[0];?>
	 <?php $md068=$md068c[0];?>
	 <?php $md069=$md069c[0];?>
	 
	 <?php //$md022=substr($md022c[0],0,4).'/'.substr($md022c[0],4,2);?>
	 <?php //$md021=substr($md021c[0],0,4).'/'.substr($md021c[0],4,2);?>
	 <?php //$md027=substr($md027c[0],0,4).'/'.substr($md027c[0],4,2);?>
	 <?php //$md028=substr($md028c[0],0,4).'/'.substr($md028c[0],4,2);?>
	 <?php //$md029=substr($md029c[0],0,4).'/'.substr($md029c[0],4,2);?>
	 <?php //$md030=substr($md030c[0],0,4).'/'.substr($md030c[0],4,2);?>
	 <?php //$md011=substr($md011c[0],0,4).'/'.substr($md011c[0],4,2);?>
	 <?php //$md012=substr($md012c[0],0,4).'/'.substr($md012c[0],4,2);?>
	 <?php //$md013=substr($md013c[0],0,4).'/'.substr($md013c[0],4,2).'/'.substr($md013c[0],6,2);?>
	 <?php //$ma204=substr($ma204c[0],0,4).'/'.substr($ma204c[0],4,2).'/'.substr($ma204c[0],6,2);?>
	 <?php //$cmsq06a=$cmsq06ac[0];?>
	 <?php //$cmsq06adisp=$cmsq06acdisp[0];?> 
	 
	 <?php $company=$companyc[0];?>
	 <?php $usr_group=$usr_groupc[0];?>
	 <?php $create_date=substr($create_datec[0],0,4).'/'.substr($create_datec[0],4,2).'/'.substr($create_datec[0],6,2);?>
	 <?php $modifier=$modifierc[0];?>
	 <?php $modi_date=substr($modi_datec[0],0,4).'/'.substr($modi_datec[0],4,2).'/'.substr($modi_datec[0],6,2);?>
	 <?php $flagc=$flagc[0];?>
       
	
	
	<div class="abgne_tab"> <!-- div-7 -->
		<ul class="tabs">
		     <li><a href="#tab1" accesskey="a" >自動分錄a</a></li>
			<li><a href="#tab2" accesskey="b" >應收票據b</a></li>
			<li><a href="#tab3" accesskey="c" >應付票據c</a></li>
			<li><a href="#tab4" accesskey="g" >銀行存提款g</a></li>	
			<li><a href="#tab5" accesskey="h" >借還款/匯差h</a></li>	
	    </ul>

    <div class="tab_container"> <!-- div-8 -->
	
	 <!--  基本參數 -->
	<div id="tab1" class="tab_content">
	<table class="form14">     <!-- 表格 -->
	<tr>
	   
		<td class="normal14y" width="12%">拋轉方式：</td>
        <td class="normal14a"  width="88%" > <input tabIndex="1" type="radio" name="md024" <?php if (isset($md024) && $md024=="1") echo "checked";?> value="1" />拋轉自動分錄分錄底稿&nbsp;&nbsp; 
          <input type="radio" tabIndex="2" name="md024" <?php if (isset($md024) && $md024=="2") echo "checked";?> value="2" />拋轉自動分錄分錄底稿及會計傳票</td>
		
	 </tr>	
	
	</table>
	</div>
	<!--  應收票據參數 -->
     <div id="tab2" class="tab_content">
	 <table class="form14">     <!-- 表格 -->
	 <tr>
	    <td class="normal14y" width="13%" >應收票據科目：</td>
		<td class="normal14a" width="37%"><input tabIndex="3" id="md003" onKeyPress="keyFunction()"   name="md003" value="<?php echo $md003; ?>" type="text"  /></td>
		<td class="normal14y" width="13%">收票產生傳票：</td>
        <td class="normal14a"  width="37%" ><input type="hidden" name="md002" value="N" />
		<input type='checkbox' tabIndex="4" id="md002" onKeyPress="keyFunction()" name="md002" <?php if($md002 == 'Y' ) echo 'checked'; ?>  <?php if($md002 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td>
	  </tr>
	   <tr>
	    <td class="normal14z"  >應收票據對方科目：</td>
		<td class="normal14a" ><input tabIndex="5" id="md007" onKeyPress="keyFunction()"   name="md007" value="<?php echo $md007; ?>" type="text"  /></td>
		<td class="normal14a"></td>
        <td class="normal14a"  > </td>
	 </tr>	
	  </tr>
	   <tr>
	    <td class="normal14z"  >收票傳票單別：</td>
		<td class="normal14a" ><input tabIndex="6" id="md027" onKeyPress="keyFunction()"    name="md027" value="<?php echo $md027; ?>" type="text"  /></td>
		<td class="normal14z">收票底稿開立方式：</td>
        <td class="normal14a"  > <input tabIndex="1" type="radio" name="md035" <?php if (isset($md035) && $md035=="1") echo "checked";?> value="1" />逐張&nbsp;&nbsp; 
          <input type="radio" tabIndex="7" name="md035" <?php if (isset($md035) && $md035=="2") echo "checked";?> value="2" />彙總</td>
	   </tr>	
	   <tr>	    
		<td class="normal14z" >收票借方來源：</td>
        <td class="normal14a" > <input tabIndex="8" id="md043" onKeyPress="keyFunction()"    name="md043" value="<?php echo $md043; ?>" type="text"  /></td>
		<td class="normal14z"> 收票貸方來源：</td>
        <td class="normal14a"  > <input tabIndex="9" id="md060" onKeyPress="keyFunction()"    name="md060" value="<?php echo $md060; ?>" type="text"  /></td>
	 </tr>	
	 <tr>
	    <td class="normal14z"  >兌現產生傳票：</td>
        <td class="normal14a"   ><input type="hidden" name="md002" value="N" />
		<input type='checkbox' tabIndex="4" id="md002" onKeyPress="keyFunction()" name="md002" <?php if($md002 == 'Y' ) echo 'checked'; ?>  <?php if($md002 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td>
	    <td class="normal14a"></td>
        <td class="normal14a"  > </td>
	 </tr>	
	  <tr>
	    <td class="normal14z"  >兌現傳票單別：</td>
		<td class="normal14a" ><input tabIndex="6" id="md028" onKeyPress="keyFunction()"    name="md028" value="<?php echo $md028; ?>" type="text"  /></td>
		<td class="normal14z">兌現底稿開立方式：</td>
        <td class="normal14a"  > <input tabIndex="1" type="radio" name="md036" <?php if (isset($md036) && $md036=="1") echo "checked";?> value="1" />逐張&nbsp;&nbsp; 
          <input type="radio" tabIndex="7" name="md036" <?php if (isset($md036) && $md036=="2") echo "checked";?> value="2" />彙總</td>
	  </tr>	
	  <tr>	    
		<td class="normal14z" >兌現借方來源：</td>
        <td class="normal14a" > <input tabIndex="8" id="md044" onKeyPress="keyFunction()"    name="md044" value="<?php echo $md044; ?>" type="text"  /></td>
		<td class="normal14z"> 兌現貸方來源：</td>
        <td class="normal14a"  > <input tabIndex="9" id="md061" onKeyPress="keyFunction()"    name="md061" value="<?php echo $md061; ?>" type="text"  /></td>
	 </tr>	
	  <tr>
	    <td class="normal14z"  >還原產生傳票：</td>
        <td class="normal14a"   ><input type="hidden" name="md006" value="N" />
		<input type='checkbox' tabIndex="4" id="md006" onKeyPress="keyFunction()" name="md006" <?php if($md006 == 'Y' ) echo 'checked'; ?>  <?php if($md006 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td>
	    <td class="normal14z"  >應收票據還原科目：</td>
		<td class="normal14a" ><input tabIndex="5" id="md010" onKeyPress="keyFunction()"   name="md010" value="<?php echo $md010; ?>" type="text"  /></td>
		
	 </tr>	
	  <tr>
	    <td class="normal14z"  >還原傳票單別：</td>
		<td class="normal14a" ><input tabIndex="6" id="md029" onKeyPress="keyFunction()"    name="md029" value="<?php echo $md029; ?>" type="text"  /></td>
		<td class="normal14z">還原底稿開立方式：</td>
        <td class="normal14a"  > <input tabIndex="1" type="radio" name="md037" <?php if (isset($md037) && $md037=="1") echo "checked";?> value="1" />逐張&nbsp;&nbsp; 
          <input type="radio" tabIndex="7" name="md037" <?php if (isset($md037) && $md037=="2") echo "checked";?> value="2" />彙總</td>
	  </tr>	
	  <tr>	    
		<td class="normal14z" >還原借方來源：</td>
        <td class="normal14a" > <input tabIndex="8" id="md045" onKeyPress="keyFunction()"    name="md045" value="<?php echo $md045; ?>" type="text"  /></td>
		<td class="normal14z"> 還原貸方來源：</td>
        <td class="normal14a"  > <input tabIndex="9" id="md062" onKeyPress="keyFunction()"    name="md062" value="<?php echo $md062; ?>" type="text"  /></td>
	 </tr>	
	  <tr>
	    <td class="normal14z"  >呆帳產生傳票：</td>
        <td class="normal14a"   ><input type="hidden" name="md008" value="N" />
		<input type='checkbox' tabIndex="4" id="md008" onKeyPress="keyFunction()" name="md008" <?php if($md008 == 'Y' ) echo 'checked'; ?>  <?php if($md008 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td>
	    <td class="normal14z"  >應收票據呆帳科目：</td>
		<td class="normal14a" ><input tabIndex="5" id="md012" onKeyPress="keyFunction()"   name="md012" value="<?php echo $md012; ?>" type="text"  /></td>
		
	 </tr>	
	  <tr>
	    <td class="normal14z"  >呆帳傳票單別：</td>
		<td class="normal14a" ><input tabIndex="6" id="md030" onKeyPress="keyFunction()"    name="md030" value="<?php echo $md030; ?>" type="text"  /></td>
		<td class="normal14z">呆帳底稿開立方式：</td>
        <td class="normal14a"  > <input tabIndex="1" type="radio" name="md038" <?php if (isset($md038) && $md038=="1") echo "checked";?> value="1" />逐張&nbsp;&nbsp; 
          <input type="radio" tabIndex="7" name="md038" <?php if (isset($md038) && $md038=="2") echo "checked";?> value="2" />彙總</td>
	  </tr>	
	  <tr>	    
		<td class="normal14z" >呆帳借方來源：</td>
        <td class="normal14a" > <input tabIndex="8" id="md046" onKeyPress="keyFunction()"    name="md046" value="<?php echo $md046; ?>" type="text"  /></td>
		<td class="normal14z"> 呆帳貸方來源：</td>
        <td class="normal14a"  > <input tabIndex="9" id="md063" onKeyPress="keyFunction()"    name="md063" value="<?php echo $md063; ?>" type="text"  /></td>
	 </tr>	
	</table>
	</div>
	<!-- 應付票據參數 -->
     <div id="tab3" class="tab_content">
	 <table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="13%" >應付票據科目：</td>
		<td class="normal14a" width="37%"><input tabIndex="3" id="md005" onKeyPress="keyFunction()"   name="md005" value="<?php echo $md005; ?>" type="text"  /></td>
		<td class="normal14y" width="13%">開票產生傳票：</td>
        <td class="normal14a"  width="37%" ><input type="hidden" name="md002" value="N" />
		<input type='checkbox' tabIndex="4" id="md002" onKeyPress="keyFunction()" name="md002" <?php if($md002 == 'Y' ) echo 'checked'; ?>  <?php if($md002 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td>
	  </tr>
	   <tr>
	    <td class="normal14z"  >應付票據對方科目：</td>
		<td class="normal14a" ><input tabIndex="5" id="md009" onKeyPress="keyFunction()"   name="md009" value="<?php echo $md009; ?>" type="text"  /></td>
		<td class="normal14a"></td>
        <td class="normal14a"  > </td>
	 </tr>	
	  </tr>
	   <tr>
	    <td class="normal14z"  >開票傳票單別：</td>
		<td class="normal14a" ><input tabIndex="6" id="md031" onKeyPress="keyFunction()"    name="md031" value="<?php echo $md031; ?>" type="text"  /></td>
		<td class="normal14z">開票底稿開立方式：</td>
        <td class="normal14a"  > <input tabIndex="1" type="radio" name="md039" <?php if (isset($md039) && $md039=="1") echo "checked";?> value="1" />逐張&nbsp;&nbsp; 
          <input type="radio" tabIndex="7" name="md039" <?php if (isset($md039) && $md039=="2") echo "checked";?> value="2" />彙總</td>
	   </tr>	
	   <tr>	    
		<td class="normal14z" >開票借方來源：</td>
        <td class="normal14a" > <input tabIndex="8" id="md047" onKeyPress="keyFunction()"    name="md047" value="<?php echo $md047; ?>" type="text"  /></td>
		<td class="normal14z"> 開票貸方來源：</td>
        <td class="normal14a"  > <input tabIndex="9" id="md064" onKeyPress="keyFunction()"    name="md064" value="<?php echo $md064; ?>" type="text"  /></td>
	 </tr>	
	 <tr>
	    <td class="normal14z"  >兌現產生傳票：</td>
        <td class="normal14a"   ><input type="hidden" name="md016" value="N" />
		<input type='checkbox' tabIndex="4" id="md016" onKeyPress="keyFunction()" name="md016" <?php if($md016 == 'Y' ) echo 'checked'; ?>  <?php if($md016 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td>
	    <td class="normal14a"></td>
        <td class="normal14a"  > </td>
	 </tr>	
	  <tr>
	    <td class="normal14z"  >兌現傳票單別：</td>
		<td class="normal14a" ><input tabIndex="6" id="md032" onKeyPress="keyFunction()"    name="md032" value="<?php echo $md032; ?>" type="text"  /></td>
		<td class="normal14z">兌現底稿開立方式：</td>
        <td class="normal14a"  > <input tabIndex="1" type="radio" name="md040" <?php if (isset($md040) && $md040=="1") echo "checked";?> value="1" />逐張&nbsp;&nbsp; 
          <input type="radio" tabIndex="7" name="md040" <?php if (isset($md040) && $md040=="2") echo "checked";?> value="2" />彙總</td>
	  </tr>	
	  <tr>	    
		<td class="normal14z" >兌現借方來源：</td>
        <td class="normal14a" > <input tabIndex="8" id="md048" onKeyPress="keyFunction()"    name="md048" value="<?php echo $md048; ?>" type="text"  /></td>
		<td class="normal14z"> 兌現貸方來源：</td>
        <td class="normal14a"  > <input tabIndex="9" id="md065" onKeyPress="keyFunction()"    name="md065" value="<?php echo $md065; ?>" type="text"  /></td>
	 </tr>	
	  <tr>
	    <td class="normal14z"  >退票產生傳票：</td>
        <td class="normal14a"   ><input type="hidden" name="md018" value="N" />
		<input type='checkbox' tabIndex="4" id="md018" onKeyPress="keyFunction()" name="md018" <?php if($md018 == 'Y' ) echo 'checked'; ?>  <?php if($md018 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td>
	    <td class="normal14z"  >應收票據退票科目：</td>
		<td class="normal14a" ><input tabIndex="5" id="md022" onKeyPress="keyFunction()"   name="md022" value="<?php echo $md022; ?>" type="text"  /></td>
		
	 </tr>	
	  <tr>
	    <td class="normal14z"  >退票傳票單別：</td>
		<td class="normal14a" ><input tabIndex="6" id="md033" onKeyPress="keyFunction()"    name="md033" value="<?php echo $md033; ?>" type="text"  /></td>
		<td class="normal14z">退票底稿開立方式：</td>
        <td class="normal14a"  > <input tabIndex="1" type="radio" name="md004" <?php if (isset($md004) && $md004=="1") echo "checked";?> value="1" />逐張&nbsp;&nbsp; 
          <input type="radio" tabIndex="7" name="md004" <?php if (isset($md004) && $md004=="2") echo "checked";?> value="2" />彙總</td>
	  </tr>	
	  <tr>	    
		<td class="normal14z" >退票借方來源：</td>
        <td class="normal14a" > <input tabIndex="8" id="md049" onKeyPress="keyFunction()"    name="md049" value="<?php echo $md049; ?>" type="text"  /></td>
		<td class="normal14z"> 退票貸方來源：</td>
        <td class="normal14a"  > <input tabIndex="9" id="md066" onKeyPress="keyFunction()"    name="md066" value="<?php echo $md066; ?>" type="text"  /></td>
	 </tr>	
	  <tr>
	    <td class="normal14z"  >註銷產生傳票：</td>
        <td class="normal14a"   ><input type="hidden" name="md020" value="N" />
		<input type='checkbox' tabIndex="4" id="md020" onKeyPress="keyFunction()" name="md020" <?php if($md020 == 'Y' ) echo 'checked'; ?>  <?php if($md020 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td>
	    <td class="normal14z"  >應付票據註銷科目：</td>
		<td class="normal14a" ><input tabIndex="5" id="md023" onKeyPress="keyFunction()"   name="md023" value="<?php echo $md023; ?>" type="text"  /></td>
		
	 </tr>	
	  <tr>
	    <td class="normal14z"  >註銷傳票單別：</td>
		<td class="normal14a" ><input tabIndex="6" id="md034" onKeyPress="keyFunction()"    name="md034" value="<?php echo $md034; ?>" type="text"  /></td>
		<td class="normal14z">註銷底稿開立方式：</td>
        <td class="normal14a"  > <input tabIndex="1" type="radio" name="md038" <?php if (isset($md038) && $md038=="1") echo "checked";?> value="1" />逐張&nbsp;&nbsp; 
          <input type="radio" tabIndex="7" name="md042" <?php if (isset($md042) && $md042=="2") echo "checked";?> value="2" />彙總</td>
	  </tr>	
	  <tr>	    
		<td class="normal14z" >註銷借方來源：</td>
        <td class="normal14a" > <input tabIndex="8" id="md050" onKeyPress="keyFunction()"    name="md050" value="<?php echo $md050; ?>" type="text"  /></td>
		<td class="normal14z"> 註銷貸方來源：</td>
        <td class="normal14a"  > <input tabIndex="9" id="md067" onKeyPress="keyFunction()"    name="md067" value="<?php echo $md067; ?>" type="text"  /></td>
	 </tr>	
	 
	</table>
	</div>
	<!-- 銀行存提款參數 -->
     <div id="tab4" class="tab_content">
	 <table class="form14">     <!-- 表格 -->
	   <tr>
	    <td class="normal14y" width="16%" >現金科目：</td>
		<td class="normal14a" width="34%"><input tabIndex="3" id="md005" onKeyPress="keyFunction()"   name="md005" value="<?php echo $md005; ?>" type="text"  /></td>
		<td class="normal14y" width="16%">手續費科目：</td>
        <td class="normal14a"  width="34%" ><input tabIndex="3" id="md005" onKeyPress="keyFunction()"   name="md005" value="<?php echo $md005; ?>" type="text"  /></td>
	  </tr>
	  
	  </tr>
	   <tr>
	    <td class="normal14z"  >銀行存提款傳票單別：</td>
		<td class="normal14a" ><input tabIndex="6" id="md031" onKeyPress="keyFunction()"    name="md031" value="<?php echo $md031; ?>" type="text"  /></td>
		<td class="normal14z">存提款底稿開立方式：</td>
        <td class="normal14a"  > <input tabIndex="1" type="radio" name="md039" <?php if (isset($md039) && $md039=="1") echo "checked";?> value="1" />逐張&nbsp;&nbsp; 
          <input type="radio" tabIndex="7" name="md039" <?php if (isset($md039) && $md039=="2") echo "checked";?> value="2" />彙總</td>
	   </tr>	
	     <tr>
	    <td class="normal14z"  >同單號科目匯總：</td>
		<td class="normal14a" ><input type="hidden" name="md054" value="N" />
		<input type='checkbox' tabIndex="10" id="md054" onKeyPress="keyFunction()" name="md054" <?php if($md054 == 'Y' ) echo 'checked'; ?>  <?php if($md054 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td>
	  
		<td class="normal14a"></td>
        <td class="normal14a"  > </td>
	 </tr>	
	   <tr>	    
		<td class="normal14z" >存提款借方摘要來源：</td>
        <td class="normal14a" > <input tabIndex="8" id="md053" onKeyPress="keyFunction()"    name="md053" value="<?php echo $md053; ?>" type="text"  /></td>
		<td class="normal14z">存提款貸方摘要來源：</td>
        <td class="normal14a"  > <input tabIndex="9" id="md068" onKeyPress="keyFunction()"    name="md068" value="<?php echo $md068; ?>" type="text"  /></td>
	 </tr>	
	 </table>
	</div>
	 <!-- 借還款/匯差參數 -->
     <div id="tab5" class="tab_content">
	 <table class="form14">     <!-- 表格 -->
	   <tr>
	    <td class="normal14y" width="13%" >抵押借款科目：</td>
		<td class="normal14a" width="37%"><input tabIndex="3" id="md011" onKeyPress="keyFunction()"   name="md011" value="<?php echo $md011; ?>" type="text"  /></td>
		<td class="normal14y" width="13%">抵押還息科目：</td>
        <td class="normal14a"  width="37%" ><input tabIndex="3" id="md015" onKeyPress="keyFunction()"   name="md015" value="<?php echo $md015; ?>" type="text"  /></td>
	  </tr>
	   <tr>
	    <td class="normal14z"  >融資借款科目：</td>
		<td class="normal14a" ><input tabIndex="3" id="md013" onKeyPress="keyFunction()"   name="md013" value="<?php echo $md013; ?>" type="text"  /></td>
		<td class="normal14z">融資還息科目：</td>
        <td class="normal14a"   ><input tabIndex="3" id="md017" onKeyPress="keyFunction()"   name="md017" value="<?php echo $md017; ?>" type="text"  /></td>
	  </tr>
	  </tr>
	   <tr>
	    <td class="normal14z"  >傳票單別：</td>
		<td class="normal14a" ><input tabIndex="6" id="md055" onKeyPress="keyFunction()"    name="md055" value="<?php echo $md055; ?>" type="text"  /></td>
		<td class="normal14z">底稿開立方式：</td>
        <td class="normal14a"  > <input tabIndex="1" type="radio" name="md056" <?php if (isset($md056) && $md056=="1") echo "checked";?> value="1" />逐張&nbsp;&nbsp; 
          <input type="radio" tabIndex="7" name="md056" <?php if (isset($md056) && $md056=="2") echo "checked";?> value="2" />彙總</td>
	   </tr>	
	     <tr>
	    <td class="normal14z"  >同單號科目匯總：</td>
		<td class="normal14a" ><input type="hidden" name="md058" value="N" />
		<input type='checkbox' tabIndex="10" id="md058" onKeyPress="keyFunction()" name="md058" <?php if($md058 == 'Y' ) echo 'checked'; ?>  <?php if($md058 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td>
	 
		<td class="normal14a"></td>
        <td class="normal14a"  > </td>
	 </tr>	
	   <tr>	    
		<td class="normal14z" >借方摘要來源：</td>
        <td class="normal14a" > <input tabIndex="8" id="md057" onKeyPress="keyFunction()"    name="md057" value="<?php echo $md057; ?>" type="text"  /></td>
		<td class="normal14z"> 貸方摘要來源：</td>
        <td class="normal14a"  > <input tabIndex="9" id="md069" onKeyPress="keyFunction()"    name="md069" value="<?php echo $md069; ?>" type="text"  /></td>
	 </tr>	
	 <tr>	    
		<td class="normal14z" >匯兌損失科目：</td>
        <td class="normal14a" > <input tabIndex="8" id="md019" onKeyPress="keyFunction()"    name="md019" value="<?php echo $md019; ?>" type="text"  /></td>		<td class="normal14a"> 匯兌收益科目：</td>
        <td class="normal14a"  > <input tabIndex="9" id="md068" onKeyPress="keyFunction()"    name="md068" value="<?php echo $md068; ?>" type="text"  /></td>
	 </tr>	
	</table>
	</div> 
		</div>        <!-- div- 可儲存顯示 -->
		 <input type="hidden" class="commpany" name="company" value="" />
	<!--  <div class="buttons">
	    <button tabIndex="88" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  tabIndex="89" id='cancel' name='cancel' href="<?php echo site_url('main/index/110'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>-->
	   
    </form>
	<?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>

    </div>    <!-- div-tab -->
  </div>      <!-- div-5 -->
 </div>        <!-- div-4 -->
    
</div>   <!-- div-3 -->
  </div>     <!-- div-2 -->
</div>       <!-- div-1 -->
<?php include("./application/views/fun/noti11_funjs_v.php"); ?>