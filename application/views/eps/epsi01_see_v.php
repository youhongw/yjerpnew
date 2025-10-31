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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 單據性質建立作業 - 查看</h1>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/eps/epsi01/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
           <?php   $mq001=$row->mq001;?>
          <?php   $mq002=$row->mq002;?>
          <?php   $mq003=$row->mq003;?>
          <?php   $mq004=$row->mq004;?>
          <?php   $mq005=$row->mq005;?>
          <?php   $mq006=$row->mq006;?>
		  <?php   $mq007=$row->mq007;?>
		  <?php   $mq008=$row->mq008;?>
          <?php   $mq009=$row->mq009;?>
          <?php   $mq010=$row->mq010;?>
		  <?php   $mq011=$row->mq011;?>
		  <?php   $mq012=$row->mq012;?>
          <?php   $mq013=$row->mq013;?>
		  <?php   $mq014=$row->mq014;?>
          <?php   $mq015=$row->mq015;?>
          <?php   $mq016=$row->mq016;?>
		  <?php   $mq017=$row->mq017;?>
		  <?php   $mq018=$row->mq018;?>
          <?php   $mq019=$row->mq019;?>
          <?php   $mq020=$row->mq020;?>
		  <?php   $mq021=$row->mq021;?>
		  <?php   $mq022=$row->mq022;?>
          <?php   $mq023=$row->mq023;?>
		  <?php   $mq024=$row->mq024;?>
          <?php   $mq025=$row->mq025;?>
          <?php   $mq026=$row->mq026;?>
		  <?php   $mq027=$row->mq027;?>
		  <?php   $mq028=$row->mq028;?>
          <?php   $mq029=$row->mq029;?>
          <?php   $mq030=$row->mq030;?>
		  <?php   $mq031=$row->mq031;?>
		  <?php   $mq032=$row->mq032;?>
          <?php   $mq033=$row->mq033;?>
		  <?php   $mq034=$row->mq034;?>
          <?php   $mq035=$row->mq035;?>
		  
		  <?php   $copq03a61=$row->mq021;?>
		  <?php   $cmsq17a1=$row->mq025;?>
		  <?php   $cmsq17a2=$row->mq027;?>
		  <?php   $taxq02a=$row->mq023;?>
		  <?php   $copq03a61disp='';?>
		  <?php   $cmsq17a1disp=$row->mq025disp;?>
		  <?php   $cmsq17a2disp=$row->mq027disp;?>
		  <?php   $taxq02adisp=$row->mq023disp;?>
	<?php  }?>
      
	<table class="form14">
       <tr>
	    <td class="start14a" width="12%"><span class="required">單別代號：</span></td>
        <td class="normal14a" width="20%" >
         <input  tabIndex="1" id="mq001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mq001"   value="<?php echo  $mq001; ?>"    type="text" required />
		<span id="keydisp" ></span></td>
	    <td class="normal14a" width="12%">單別名稱：</td>
        <td class="normal14a"  width="20%"> <input  tabIndex="2" id="mq002" onKeyPress="keyFunction()"  name="mq002"   value="<?php echo  $mq002; ?>"    type="text"  /></td>
		<td class="normal14a" width="12%">單別全名：</td>
        <td class="normal14a"  width="24%"><input  tabIndex="3" id="mq034" onKeyPress="keyFunction()"  name="mq034"   value="<?php echo  $mq034; ?>"    type="text"  /></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14a" >單據性質：</td>
        <td class="normal14" > <select tabIndex="4" id="mq003" onKeyPress="keyFunction()" name="mq003" >
           <option <?php if($mq003 == 'B1') echo 'selected="selected"';?> value='B1'>B1:出口通知單</option>                                                                        
		    <option <?php if($mq003 == 'B2') echo 'selected="selected"';?> value='B2'>B2:貨運通知單 </option>
            <option <?php if($mq003 == 'B3') echo 'selected="selected"';?> value='B3'>B3:出口費用單 </option>
            <option <?php if($mq003 == 'B4') echo 'selected="selected"';?> value='B4'>B4:多角貿易出貨通知單 </option>
		  </select></td>
		<td class="normal14" >編碼方式：</td>
		<td class="normal14" > <select tabIndex="5" id="mq004" onKeyPress="keyFunction()" name="mq004" >
            <option <?php if($mq004 == '1') echo 'selected="selected"';?> value='1'>1.日編號</option>                                                                        
		    <option <?php if($mq004 == '2') echo 'selected="selected"';?> value='2'>2.月編號 </option>
            <option <?php if($mq004 == '3') echo 'selected="selected"';?> value='3'>3.流水號 </option>
            <option <?php if($mq004 == '4') echo 'selected="selected"';?> value='4'>4.手動編號</option>
		  </select></td>
        <td class="normal14a" >年碼數：</td>
        <td class="normal14a" ><input  tabIndex="6" id="mq005" onKeyPress="keyFunction()"  name="mq005"   value="<?php echo  $mq005; ?>"    type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14" >流水號碼數： </td>
        <td class="normal14" ><input  tabIndex="7" id="mq006" onKeyPress="keyFunction()"  name="mq006"   value="<?php echo  $mq006; ?>"    type="text"  /></td>
		<td class="normal14" >品號輸入：</td>
		<td class="normal14">
		<input type="radio" tabIndex="8" name="mq024" <?php if (isset($mq024) && $mq024=="1") echo "checked";?> value="1" />採品號輸入&nbsp;&nbsp;&nbsp; 
        <input type="radio" tabIndex="9" name="mq024" <?php if (isset($mq024) && $mq024=="2") echo "checked";?> value="2" />採條碼輸入
        </td>
		<td class="normal14" >自動確認：</td>
		<td  class="normal14"  ><input type="hidden"  name="mq015" value="N" />		 
	     <input type='checkbox' tabIndex="10" id="mq015" onKeyPress="keyFunction()"   name="mq015" <?php if($mq015 == 'Y' ) echo 'checked';  ?>  <?php if($mq015 != 'N' ) echo 'check'; ?>  value="Y" size="1"  /></td>
      
	  </tr>	
	  <tr>
	    <td  class="normal14" >自動列印：</td>
        <td  class="normal14"  ><input type="hidden" name="mq016" value="N" />		  
		  <input  type='checkbox' tabIndex="11" id="mq016" onKeyPress="keyFunction()"   name="mq016" <?php if($mq016 == 'Y' ) echo 'checked';  ?>  <?php if($mq016 != 'N' ) echo 'check'; ?>  value="Y" size="1"   />
        </td>	  
	    <td class="normal14">單別限定使用者：</td>	<input type="hidden" name="mq029" value="N" />		
        <td  class="normal14"  ><input type="hidden" name="mq029" value="N" />	
		  <input  type='checkbox' tabIndex="12" id="mq029" onKeyPress="keyFunction()" name="mq029" <?php if($mq029 == 'Y' ) echo 'checked'; ?>  <?php if($mq029 != 'Y' ) echo 'check'; ?> value="Y" size="1"   />
        </td>
		<td class="normal14">更新核價：</td>		
        <td  class="normal14"  ><input type="hidden" name="mq018" value="N" />	
		  <input  type='checkbox' tabIndex="13" id="mq018" onKeyPress="keyFunction()" name="mq018" <?php if($mq018 == 'Y' ) echo 'checked'; ?>  <?php if($mq018 != 'Y' ) echo 'check'; ?> value="Y" size="1"   />
        </td>
	  </tr>
	   <tr>
	    <td  class="normal14" >核對託工：</td>
        <td  class="normal14"  ><input type="hidden" name="mq019" value="N" />		  
		  <input  type='checkbox' tabIndex="11" id="mq019" onKeyPress="keyFunction()"   name="mq019" <?php if($mq019 == 'Y' ) echo 'checked';  ?>  <?php if($mq019 != 'N' ) echo 'check'; ?>  value="Y" size="1"   />
        </td>	
		<td class="normal14">直接結帳：</td>		
        <td  class="normal14"  ><input type="hidden" name="mq020" value="N" />	
		  <input  type='checkbox' tabIndex="13" id="mq020" onKeyPress="keyFunction()" name="mq020" <?php if($mq020 == 'Y' ) echo 'checked'; ?>  <?php if($mq020 != 'Y' ) echo 'check'; ?> value="Y" size="1"   />
        </td>
		<td class="normal14"></td>
        <td  class="normal14"  ></td>
	  </tr>
	   <tr>
	    <td class="normal14" style="background-color:#F5F5F5" >結帳單別： </td>
        <td class="normal14" ><input   tabIndex="14" id="mq021" onKeyPress="keyFunction()" onchange="startcopq03a61(this)" name="copq03a61" value="<?php echo $copq03a61; ?>"  type="text" style="background-color:#F5F5F5" /><img id="Showcopq03a61test" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="copq03a61disp"> <?php    echo $copq03a61disp; ?> </span></td>
		 <td class="normal14" >註記代號： </td>
        <td class="normal14" ><input   tabIndex="15" id="mq025" onKeyPress="keyFunction()" onchange="startcmsq17a1(this)" name="cmsq17a1" value="<?php echo $cmsq17a1; ?>"  type="text"  /><img id="Showcmsq17a1" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="cmsq17a1disp"> <?php    echo $cmsq17a1disp; ?> </span></td>
		<td  class="normal14" >每頁列印註記：</td>
        <td  class="normal14"  ><input type="hidden" name="mq030" value="N" />	
		  <input type='checkbox' tabIndex="16" id="mq030" onKeyPress="keyFunction()"  name="mq030" <?php if($mq030 == 'Y' ) echo 'checked';  ?>  <?php if($mq030 != 'Y' ) echo 'check'; ?>  value="Y" size="1"   />
        </td>
	  </tr>	
	  <tr>
	    <td class="normal14" >簽核代號： </td>
        <td class="normal14" ><input   tabIndex="17" id="mq027" onKeyPress="keyFunction()" onchange="startcmsq17a2(this)" name="cmsq17a2" value="<?php echo $cmsq17a2; ?>"  type="text"  /><img id="Showcmsq17a2" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="cmsq17a2disp"> <?php    echo $cmsq17a2disp; ?> </span></td>
		 <td  class="normal14" >列印修改註記：</td>
        <td  class="normal14"  ><input type="hidden" name="mq026" value="N" />	
		 
		  <input type='checkbox' tabIndex="18" id="mq026" onKeyPress="keyFunction()"  name="mq026" <?php if($mq026 == 'Y' ) echo 'checked';  ?>  <?php if($mq026 != 'Y' ) echo 'check'; ?>  value="Y" size="1"   />
        </td>
		<td  class="normal14" >每頁列印簽核：</td>
        <td  class="normal14"  ><input type="hidden" name="mq031" value="N" />	
		  
		  <input type='checkbox' tabIndex="19" id="mq031" onKeyPress="keyFunction()"  name="mq031" <?php if($mq031 == 'Y' ) echo 'checked';  ?>  <?php if($mq031 !== 'Y' ) echo 'check'; ?>  value="Y" size="1"  />
        </td>
	  </tr>	
	   <tr>
	    <td class="normal14" style="background-color:#F5F5F5">公司代號： </td>
        <td class="normal14" ><input   tabIndex="20" id="mq023" onKeyPress="keyFunction()" onchange="starttaxq02a(this)" name="taxq02a" value="<?php echo $taxq02a; ?>"  type="text" style="background-color:#F5F5F5" /><img id="Showtaxq02atest" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="taxq02adisp"> <?php    echo $taxq02adisp; ?> </span></td>
		 <td  class="normal14" >自動生發票號碼：</td>
        <td  class="normal14"  ><input type="hidden" name="mq017" value="N" />	
		 
		  <input type="checkbox" tabIndex="21" id="mq017" onKeyPress="keyFunction()"  name="mq017" <?php if($mq017 == 'Y' ) echo 'checked';  ?>  <?php if($mq017 != 'Y' ) echo 'check'; ?>  value="Y" size="1"  />
        </td>
		<td  class="normal14" >選憑證格式：</td>
        <td  class="normal14"  ><input type="hidden" name="mq033" value="N" />
	
		  <input type="checkbox" tabIndex="22" id="mq033" onKeyPress="keyFunction()"  name="mq033" <?php if($mq033 == 'Y' ) echo 'checked';  ?>  <?php if($mq033 != 'Y' ) echo 'check'; ?>  value="Y" size="1"   />
        </td>
	  </tr>	
	  <tr>
	    <td class="normal14" style="background-color:#F5F5F5">使用順序發票碼： </td>
        <td class="normal14" ><input type="text" tabIndex="23" id="mq007" onKeyPress="keyFunction()"  name="mq007"   value="<?php echo  $taxq02adisp; ?>"    style="background-color:#F5F5F5" /></td>
	    <td class="normal14" >憑證格式： </td>
        <td class="normal14" ><input type="text" tabIndex="24" id="mq032" onKeyPress="keyFunction()"  name="mq032"   value="<?php echo  $mq032; ?>"    /></td>
		<td class="normal14" >備註： </td>
        <td class="normal14" ><input type="text" tabIndex="25" id="mq022" onKeyPress="keyFunction()"  name="mq022"   value="<?php echo  $mq022; ?>"      /></td>
	  </tr>	
	  <tr>
		<td  class="normal14" >每頁列印合計：</td>
        <td  class="normal14"  ><input type="hidden" name="mq035" value="N" />		  
		  <input type="checkbox" tabIndex="26" id="mq035" onKeyPress="keyFunction()"  name="mq035" <?php if($mq035 == 'Y' ) echo 'checked';  ?>  <?php if($mq035 != 'Y' ) echo 'check'; ?> value="Y" size="1"   />
        </td>	  
	    <td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	  
    </table>
		
	  <div class="buttons">
	    <a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('eps/epsi01/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>
        </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
    <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>
  </div> <!-- div-3 -->
 </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php  include_once("./application/views/funnew/fun_disabled_v.php"); ?>      <!-- see js -->
