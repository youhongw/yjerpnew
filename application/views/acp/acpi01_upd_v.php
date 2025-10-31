<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	   </div>-->
	   <?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content">  <!-- div-3 -->
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 應付單據性質建立作業 - 修改　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button tabIndex="27" type='submit' accesskey="s"  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	    <a  accesskey="x" tabIndex="28" id='cancel' name='cancel' href="<?php echo site_url('acp/acpi01/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	   
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/acp/acpi01/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
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
		  
		  <?php   $actq03a=$row->mq021;?>
		  <?php   $cmsq17a1=$row->mq025;?>
		  <?php   $cmsq17a2=$row->mq027;?>
		  <?php   $cmsq11a=$row->mq023;?>
		  <?php   $actq03adisp=$row->mq021disp;?>
		  <?php   $cmsq17a1disp=$row->mq025disp;?>
		  <?php   $cmsq17a2disp=$row->mq027disp;?>
		  <?php   $cmsq11adisp=$row->mq023disp;?>
		
          <?php   $flag=$row->flag;?>	  
	<?php  }?>
       
	<table class="form14">  <!-- 表格 -->
       <tr>
	    <td class="normal14y" width="12%"><span class="required">單別代號：</span></td>
        <td class="normal14a" width="20%" >
         <input  tabIndex="1" id="mq001" onKeyPress="keyFunction()" readonly="value" onchange="startkey(this)" name="mq001"   value="<?php echo  $mq001; ?>"    type="text" required />
		<span id="keydisp" ></span></td>
	    <td class="normal14y" width="12%">單別名稱：</td>
        <td class="normal14a"  width="20%"> <input  tabIndex="2" id="mq002" onKeyPress="keyFunction()"  name="mq002"   value="<?php echo  $mq002; ?>"    type="text"  /></td>
		<td class="normal14y" width="12%">單別全名：</td>
        <td class="normal14a"  width="24%"><input  tabIndex="3" id="mq034" onKeyPress="keyFunction()"  name="mq034"   value="<?php echo  $mq034; ?>"    type="text"  /></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" >單據性質：</td>
        <td class="normal14" > <select tabIndex="4" id="mq003" onKeyPress="keyFunction()" name="mq003" >
           <option <?php if($mq003 == '71') echo 'selected="selected"';?> value='71'>71:應付憑單單據</option>                                                                     
		    <option <?php if($mq003 == '72') echo 'selected="selected"';?> value='72'>72:溢付待掋憑單</option>
            <option <?php if($mq003 == '73') echo 'selected="selected"';?> value='73'>73:付款單據</option>	
            <option <?php if($mq003 == '74') echo 'selected="selected"';?> value='74'>74:預付結帳單</option> 
			<option <?php if($mq003 == '75') echo 'selected="selected"';?> value='75'>75:預付待抵</option> 
		  </select></td>
		<td class="normal14z" >編碼方式：</td>
		<td class="normal14" > <select tabIndex="5" id="mq004" onKeyPress="keyFunction()" name="mq004" >
            <option <?php if($mq004 == '1') echo 'selected="selected"';?> value='1'>1.日編號</option>                                                                        
		    <option <?php if($mq004 == '2') echo 'selected="selected"';?> value='2'>2.月編號 </option>
            <option <?php if($mq004 == '3') echo 'selected="selected"';?> value='3'>3.流水號 </option>
            <option <?php if($mq004 == '4') echo 'selected="selected"';?> value='4'>4.手動編號</option>
		  </select></td>
        <td class="normal14z" >年碼數：</td>
        <td class="normal14a" ><input  tabIndex="6" id="mq005" onKeyPress="keyFunction()"  name="mq005"   value="<?php echo  $mq005; ?>"    type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >流水號碼數： </td>
        <td class="normal14" ><input  tabIndex="7" id="mq006" onKeyPress="keyFunction()"  name="mq006"   value="<?php echo  $mq006; ?>"    type="text"  /></td>
		<td class="normal14z" >品號輸入：</td>
		<td class="normal14">
		<input type="radio" tabIndex="8" name="mq024" <?php if (isset($mq024) && $mq024=="1") echo "checked";?> value="1" />採品號輸入&nbsp;&nbsp;&nbsp; 
        <input type="radio" tabIndex="9" name="mq024" <?php if (isset($mq024) && $mq024=="2") echo "checked";?> value="2" />採條碼輸入
        </td>
		<td class="normal14z" >自動確認：</td>
		<td  class="normal14"  >
		  <input type="hidden" name="mq015" class="mq005"  value="N" />
		  <input tabIndex="10" id="mq015" onKeyPress="keyFunction()"  name="mq015" <?php if($mq015 == 'Y' ) echo 'checked';  ?>  <?php if($mq015 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  />
        </td>
	  </tr>	
	  <tr>
	    <td  class="normal14z" >自動列印：</td>
        <td  class="normal14"  >
		  <input type="hidden" name="mq016" class="mq016"  value="N" />
		  <input tabIndex="11" id="mq016" onKeyPress="keyFunction()"  name="mq016" <?php if($mq016 == 'Y' ) echo 'checked';  ?>  <?php if($mq016 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  />
        </td>	  
	    <td class="normal14z">單別限定使用者：</td>		
        <td  class="normal14"  ><input type="hidden" name="mq029" class="mq029"  value="N" />
		  <input tabIndex="12" id="mq029" onKeyPress="keyFunction()" name="mq029" <?php if($mq029 == 'Y' ) echo 'checked'; ?>  <?php if($mq029 != 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  />
        </td>
		<td class="normal14z">更新核價：</td>		
        <td  class="normal14"  ><input type="hidden" name="mq018" class="mq018"  value="N" />
		  <input tabIndex="13" id="mq018" onKeyPress="keyFunction()" name="mq018" <?php if($mq006 == 'Y' ) echo 'checked'; ?>  <?php if($mq018 != 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  />
        </td>
	  </tr>
	   <tr>
	    <td class="normal14z" >會計科目： </td>
        <td class="normal14" ><input   tabIndex="14" id="mq021" onKeyPress="keyFunction()" onchange="startactq03a(this)" name="actq03a" value="<?php echo $actq03a; ?>"  type="text"  /><img id="Showactq03a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="actq03adisp"> <?php    echo $actq03adisp; ?> </span></td>
		 <td class="normal14z" >註記代號： </td>
        <td class="normal14" ><input   tabIndex="15" id="mq025" onKeyPress="keyFunction()" onchange="startcmsq17a1(this)" name="cmsq17a1" value="<?php echo $cmsq17a1; ?>"  type="text"  /><img id="Showcmsq17a1" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="cmsq17a1disp"> <?php    echo $cmsq17a1disp; ?> </span></td>
		<td  class="normal14z" >每頁列印註記：</td>
        <td  class="normal14"  >
		  <input type="hidden" name="mq030" class="mq030"  value="N" />
		  <input tabIndex="16" id="mq030" onKeyPress="keyFunction()"  name="mq030" <?php if($mq030 == 'Y' ) echo 'checked';  ?>  <?php if($mq030 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  />
        </td>
	  </tr>	
	  <tr>
	    <td class="normal14z" >簽核代號： </td>
        <td class="normal14" ><input   tabIndex="17" id="mq027" onKeyPress="keyFunction()" onchange="startcmsq17a2(this)" name="cmsq17a2" value="<?php echo $cmsq17a2; ?>"  type="text"  /><img id="Showcmsq17a2" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="cmsq17a2disp"> <?php    echo $cmsq17a2disp; ?> </span></td>
		 <td  class="normal14z" >列印修改註記：</td>
        <td  class="normal14"  >
		  <input type="hidden" name="mq026" class="mq026"  value="N" />
		  <input tabIndex="18" id="mq026" onKeyPress="keyFunction()"  name="mq026" <?php if($mq026 == 'Y' ) echo 'checked';  ?>  <?php if($mq026 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  />
        </td>
		<td  class="normal14z" >每頁列印簽核：</td>
        <td  class="normal14"  >
		  <input type="hidden" name="mq031" class="mq031"  value="N" />
		  <input tabIndex="19" id="mq031" onKeyPress="keyFunction()"  name="mq031" <?php if($mq031 == 'Y' ) echo 'checked';  ?>  <?php if($mq031 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  />
        </td>
	  </tr>	
	   <tr>
	    <td class="normal14z" >公司代號： </td>
        <td class="normal14" ><input   tabIndex="20" id="mq023" onKeyPress="keyFunction()" onchange="startcmsq11a(this)" name="cmsq11a" value="<?php echo $cmsq11a; ?>"  type="text"  /><img id="Showcmsq11a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="cmsq11adisp"> <?php    echo $cmsq11adisp; ?> </span></td>
		 <td  class="normal14z" >自動生發票號碼：</td>
        <td  class="normal14"  >
		  <input type="hidden" name="mq017" class="mq017"  value="N" />
		  <input tabIndex="21" id="mq017" onKeyPress="keyFunction()"  name="mq017" <?php if($mq017 == 'Y' ) echo 'checked';  ?>  <?php if($mq017 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  />
        </td>
		<td  class="normal14z" >選憑證格式：</td>
        <td  class="normal14"  >
		  <input type="hidden" name="mq033" class="mq033"  value="N" />
		  <input tabIndex="22" id="mq033" onKeyPress="keyFunction()"  name="mq033" <?php if($mq033 == 'Y' ) echo 'checked';  ?>  <?php if($mq033 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  />
        </td>
	  </tr>	
	  <tr>
	    <td class="normal14z" >使用順序發票碼： </td>
        <td class="normal14" ><input  tabIndex="23" id="mq007" onKeyPress="keyFunction()"  name="mq007"   value="<?php echo  $mq007; ?>"    type="text"  /></td>
	    <td class="normal14z" >憑證格式： </td>
        <td class="normal14" ><input  tabIndex="24" id="mq032" onKeyPress="keyFunction()"  name="mq032"   value="<?php echo  $mq032; ?>"    type="text"  /></td>
		<td class="normal14z" >備註： </td>
        <td class="normal14" ><input  tabIndex="25" id="mq022" onKeyPress="keyFunction()"  name="mq022"   value="<?php echo  $mq022; ?>"    type="text"  /></td>
	  </tr>	
	  <tr>
		<td  class="normal14z" >每頁列印合計：</td>
        <td  class="normal14"  >
		  <input type="hidden" name="mq035" class="mq035"  value="N" />
		  <input tabIndex="26" id="mq035" onKeyPress="keyFunction()"  name="mq035" <?php if($mq035 == 'Y' ) echo 'checked';  ?>  <?php if($mq035 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  />
        </td>	  
	    <td class="normal14z">核對採購</td>
        <td class="normal14"><input type="hidden" name="mq019" class="mq019"  value="N" />
	    <input tabIndex="10" id="mq019" onKeyPress="keyFunction()"  name="mq019" <?php if($mq019 == 'Y' ) echo 'checked';  ?>  <?php if($mq019 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	  <tr>
	    <td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
		 <td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
		 <td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
        </table>
		
		<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
		
	 <!-- <div class="buttons">
	    <button tabIndex="27" type='submit' accesskey="s"  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  accesskey="x" tabIndex="28" id='cancel' name='cancel' href="<?php echo site_url('acp/acpi01/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	   </div>-->
	   
        </form>
		<?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

     </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->

 <?php include("./application/views/fun/acpi01_funjs_v.php"); ?> 