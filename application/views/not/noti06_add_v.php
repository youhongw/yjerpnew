<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 票據性質建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#mq001').focus();" tabIndex="8" type='submit'  name='submit' class="button" accesskey="s" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a  tabIndex="9" id='cancel' name='cancel' accesskey="x" href="<?php echo site_url('not/noti06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/not/noti06/addsave" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $mq001=$this->input->post('mq001');
	  $mq002=$this->input->post('mq002');
	  $mq003=$this->input->post('mq003');
	  $mq004=$this->input->post('mq004');
	  $mq005=$this->input->post('mq005');
	  $mq006=$this->input->post('mq006');
      $mq007=$this->input->post('mq007');
      $mq008=$this->input->post('mq008');
	  $mq009=$this->input->post('mq009');
	  $mq010=$this->input->post('mq010');
      $mq011=$this->input->post('mq011');
	  $mq012=$this->input->post('mq012');
	  $mq013=$this->input->post('mq013');
	  $mq014=$this->input->post('mq014');
	  $mq015=$this->input->post('mq015');
	  $mq016=$this->input->post('mq016');
      $mq017=$this->input->post('mq017');
      $mq018=$this->input->post('mq018');
	  $mq019=$this->input->post('mq019');
	  $mq020=$this->input->post('mq020');
      $mq021=$this->input->post('mq021');
	  $mq022=$this->input->post('mq022');
	  $mq023=$this->input->post('mq023');
	  $mq024=$this->input->post('mq024');
	  $mq025=$this->input->post('mq025');
	  $mq026=$this->input->post('mq026');
      $mq027=$this->input->post('mq027');
      $mq028=$this->input->post('mq028');
	  $mq029=$this->input->post('mq029');
	  $mq030=$this->input->post('mq030');
	  $mq031=$this->input->post('mq031');
	  $mq032=$this->input->post('mq032');
	  $mq033=$this->input->post('mq033');
	  $mq034=$this->input->post('mq034');
	  $mq035=$this->input->post('mq035');
	  
	  $actq03a=$this->input->post('mq021');
	  $actq03adisp=$this->input->post('mq021');
	  $cmsq17a1=$this->input->post('mq025');
	  $cmsq17a1disp=$this->input->post('mq025');
	  $cmsq17a2=$this->input->post('mq027');
	  $cmsq17a2disp=$this->input->post('mq027');
	  $taxq02a=$this->input->post('mq023');
	  $taxq02adisp=$this->input->post('mq023');	  
	  
	  if (($mq024!="1") && ($mq024!="2") ) { $mq024="1" ;}
	  if (($mq015!="Y") && ($mq015!="N") ) { $mq015="Y" ;}
	  if (($mq016!="Y") && ($mq016!="N") ) { $mq016="N" ;}
	  if (($mq029!="Y") && ($mq029!="N") ) { $mq029="N" ;}
	  if (($mq018!="Y") && ($mq018!="N") ) { $mq018="N" ;}
	  if (($mq030!="Y") && ($mq030!="N") ) { $mq030="N" ;}
	
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="12%"><span class="required">單別代號：</span></td>
        <td class="normal14a" width="20%" >
         <input  tabIndex="1" id="mq001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mq001"   value="<?php echo  $mq001; ?>"    type="text" required />
		<span id="keydisp" ></span></td>
	    <td class="normal14y" width="12%">單別名稱：</td>
        <td class="normal14a"  width="20%"> <input  tabIndex="2" id="mq002" onKeyPress="keyFunction()"  name="mq002"   value="<?php echo  $mq002; ?>"    type="text"  /></td>
		<td class="normal14y" width="12%">單別全名：</td>
        <td class="normal14a"  width="24%"><input  tabIndex="3" id="mq034" onKeyPress="keyFunction()"  name="mq034"   value="<?php echo  $mq034; ?>"    type="text"  /></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" >單據性質：</td>
        <td class="normal14" > <select tabIndex="4" id="mq003" onKeyPress="keyFunction()" name="mq003" >
            <option <?php if($mq003 == '81') echo 'selected="selected"';?> value='81'>81:存款單據</option>                                                                 
		    <option <?php if($mq003 == '82') echo 'selected="selected"';?> value='82'>82:提款單據</option>
            <option <?php if($mq003 == '83') echo 'selected="selected"';?> value='83'>83:融資託票</option>
            <option <?php if($mq003 == '84') echo 'selected="selected"';?> value='84'>84:融資借款</option>  
			<option <?php if($mq003 == '85') echo 'selected="selected"';?> value='85'>85:融資還款</option>  
            <option <?php if($mq003 == '86') echo 'selected="selected"';?> value='86'>86:抵押借款</option> 
			<option <?php if($mq003 == '87') echo 'selected="selected"';?> value='87'>87:抵押還款</option> 			
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
	<!--	<td class="normal14" >品號輸入：</td>
		<td class="normal14">
		<input type="radio" tabIndex="8" name="mq024" <?php if (isset($mq024) && $mq024=="1") echo "checked";?> value="1" />採品號輸入&nbsp;&nbsp;&nbsp; 
        <input type="radio" tabIndex="9" name="mq024" <?php if (isset($mq024) && $mq024=="2") echo "checked";?> value="2" />採條碼輸入
        </td>  -->
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
	<!--	<td class="normal14">更新核價：</td>		
        <td  class="normal14"  ><input type="hidden" name="mq018" class="mq018"  value="N" />
		  <input tabIndex="13" id="mq018" onKeyPress="keyFunction()" name="mq018" <?php if($mq006 == 'Y' ) echo 'checked'; ?>  <?php if($mq018 != 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  />
        </td> -->
	  </tr>
	   <tr>
	<!--    <td class="normal14" >會計科目： </td>
        <td class="normal14" ><input   tabIndex="14" id="mq021" onKeyPress="keyFunction()" onchange="startactq03a(this)" name="actq03a" value="<?php echo $actq03a; ?>"  type="text"  /><img id="Showactq03a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="actq03adisp"> <?php    echo $actq03adisp; ?> </span></td> -->
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
	 <!--    <td class="normal14" >公司代號： </td>
        <td class="normal14" ><input   tabIndex="20" id="mq023" onKeyPress="keyFunction()" onchange="starttaxq02a(this)" name="taxq02a" value="<?php echo $taxq02a; ?>"  type="text" /><img id="Showtaxq02a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="taxq02adisp"> <?php    echo $taxq02adisp; ?> </span></td>
		 <td  class="normal14" >自動生發票號碼：</td>
        <td  class="normal14"  >
		  <input type="hidden" name="mq017" class="mq017"  value="N" />
		  <input tabIndex="21" id="mq017" onKeyPress="keyFunction()"  name="mq017" <?php if($mq017 == 'Y' ) echo 'checked';  ?>  <?php if($mq017 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  />
        </td> -->
		<td  class="normal14z" >選憑證格式：</td>
        <td  class="normal14"  >
		  <input type="hidden" name="mq033" class="mq033"  value="N" />
		  <input tabIndex="22" id="mq033" onKeyPress="keyFunction()"  name="mq033" <?php if($mq033 == 'Y' ) echo 'checked';  ?>  <?php if($mq033 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  />
        </td>
	  </tr>	
	  <tr>
	 <!--    <td class="normal14" >使用順序發票碼： </td>
        <td class="normal14" ><input  tabIndex="23" id="mq007" onKeyPress="keyFunction()"  name="mq007"   value="<?php echo  $taxq02adisp; ?>"    type="text"  /></td>-->
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
	 <!--    <td class="normal14">核對採購</td>
        <td class="normal14"><input type="hidden" name="mq019" class="mq019"  value="N" />
		  <input tabIndex="10" id="mq019" onKeyPress="keyFunction()"  name="mq019" <?php if($mq019 == 'Y' ) echo 'checked';  ?>  <?php if($mq019 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  /></td> -->
		<td class="normal14">&nbsp;&nbsp;</td> 
        <td class="normal14"></td>
	  </tr>
		<input type="hidden" name="mq008" class="mq008"  value="" />
        <input type="hidden" name="mq009" class="mq009"  value="" />
	</table>
	   		  
	<!--<div class="buttons">
	<button tabIndex="8" type='submit'  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('not/noti06/display'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> -->
	  
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

   </div>  <!-- div-3 -->
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
 <?php include("./application/views/fun/noti06_funjs_v.php"); ?> 
	 
 