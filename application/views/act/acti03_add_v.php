<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 科目資料建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#ma001').focus();" tabIndex="8" type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	<a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('act/acti03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/act/acti03/addsave" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $ma001=$this->input->post('ma001');
	  $ma002=$this->input->post('ma002');
	  $ma002disp=$this->input->post('ma002disp');
	  $ma003=$this->input->post('ma003');
	  $ma004=$this->input->post('ma004');
	  $ma017=$this->input->post('ma017');
	//  $ma018=$this->input->post('ma018');
	  	 $cmsq06a=$this->session->userdata('sysma003');  
	 // $cmsq06a=$this->input->post('ma018');
	  $cmsq06adisp=$this->input->post('cmsq06a');
	  if (!isset($ma005)) {$ma005="1";} else {$ma005=$this->input->post('ma005');} 
	  if (!isset($ma006)) {$ma006="1";} else {$ma006=$this->input->post('ma006');} 
	  if (!isset($ma007)) {$ma007="1";} else {$ma007=$this->input->post('ma007');} 
	  if (!isset($ma008)) {$ma008="1";} else {$ma008=$this->input->post('ma008');} 
	  if (!isset($ma009)) {$ma009="N";} else {$ma009=$this->input->post('ma009');} 
	  if (!isset($ma010)) {$ma010="Y";} else {$ma010=$this->input->post('ma010');} 
	  //  $ma006="1";
		// $ma007="1";
      //   $ma008="1";		 
	 //     $ma009="N";	
	 //   $ma010="Y";	
		if (!isset($ma011)) {$ma011="27";} else {$ma011=$this->input->post('ma011');} 
	 //  $ma011="27";		 
	   if (!isset($ma012)) {$ma012="9";} else {$ma012=$this->input->post('ma012');} 
	  //  $ma012='9';
	     $ma013=$this->input->post('ma013');
		  if (!isset($ma014)) {$ma014="9";} else {$ma014=$this->input->post('ma014');} 
	  //   $ma014='9'; 
		  $ma015=$this->input->post('ma015');
		  if (!isset($ma016)) {$ma016="Y";} else {$ma016=$this->input->post('ma016');}  
		  if (!isset($ma019)) {$ma019="1";} else {$ma019=$this->input->post('ma019');} 
	  //   $ma016='Y'; 
	  //   $ma019='1';
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="11%"><span class="required">科目代號：</span></td>
        <td class="normal14a" width="39%" >
         <input  tabIndex="1" id="ma001" onKeyPress="keyFunction()" onchange="startkey(this)" name="ma001"   value="<?php echo  $ma001; ?>"    type="text" required />
		<span id="keydisp" ></span></td>
	    <td class="normal14y" width="12%">科目名稱：</td>
        <td class="normal14a"  width="38%"> <input  tabIndex="2" id="ma003" onKeyPress="keyFunction()"  name="ma003"   value="<?php echo  $ma003; ?>"  size="30"   type="text"  />
		<td class="normal14a">&nbsp;&nbsp;</td>
        <td class="normal14a"></td>
	  </tr>	
	   <tr>
	    <td class="normal14z"> 上層科目：</td>
        <td class="normal14" ><input tabIndex="22" id="acti03" onKeyPress="keyFunction()" name="ma002" onblur="check_acti03(this);"  value="<?php echo $ma002; ?>"  type="text"   size="12" />
			<a href="javascript:;"><img id="Showacti03disp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
			<span id="acti03disp"> <?php echo $ma002disp; ?> </span>
		</td><td class="normal14"></td>
        <td class="normal14"></td>
	  </tr>	  
	  <tr>
	    <td class="normal14z"> 科目英文：</td>
        <td class="normal14" ><input  tabIndex="3" onKeyPress="keyFunction()" id="ma004" name="ma004"  value="<?php echo $ma004; ?>"  size="50" type="text"  /></td>	
	    <td class="normal14z">科目性質：</td>
        <td class="normal14"> <input tabIndex="4" type="radio" name="ma005" <?php if (isset($ma005) && $ma005=="1") echo "checked";?> value="1" />帳戶&nbsp;
          <input type="radio" tabIndex="5" name="ma005" <?php if (isset($ma005) && $ma005=="2") echo "checked";?> value="2" />結轉</td>
		</td>
	  </tr>	  
	  <tr>
	    <td class="normal14z">資產損益別：</td>
        <td class="normal14"> <input tabIndex="5" type="radio" name="ma006" <?php if (isset($ma006) && $ma006=="1") echo "checked";?> value="1" />資產負債&nbsp;
          <input type="radio" tabIndex="6" name="ma006" <?php if (isset($ma006) && $ma006=="2") echo "checked";?> value="2" />損益</td>
		</td>
	    <td class="normal14z">餘額借貸別：</td>
        <td class="normal14"> <input tabIndex="7" type="radio" name="ma007" <?php if (isset($ma007) && $ma007=="1") echo "checked";?> value="1" />借餘&nbsp;
          <input type="radio" tabIndex="8" name="ma007" <?php if (isset($ma007) && $ma007=="-1") echo "checked";?> value="1" />貸額</td>
		</td>
	  </tr>
      <tr>
	    <td class="normal14z">報表借貸別：</td>
        <td class="normal14"> <input tabIndex="9" type="radio" name="ma019" <?php if (isset($ma019) && $ma019=="1") echo "checked";?> value="1" />借方&nbsp;
          <input type="radio" tabIndex="10" name="ma019" <?php if (isset($ma019) && $ma019=="-1") echo "checked";?> value="-1" />貸方</td>
		</td>
	    <td class="normal14z">科目類別：</td>
        <td class="normal14" >
		     <select id="ma008" onKeyPress="keyFunction()" name="ma008" " tabIndex="50">
            <option <?php if($ma008 == '1') echo 'selected="selected"';?> value='1'>1.統制帳戶</option>                                                                        
		    <option <?php if($ma008 == '2') echo 'selected="selected"';?> value='2'>2.明細帳戶</option>
            <option <?php if($ma008== '3') echo 'selected="selected"';?> value='3'>3.獨立帳戶</option>
		    <option <?php if($ma008 == '4') echo 'selected="selected"';?> value='4'>4.分類</option>
		   </select></td> 
			
        </td>
	  </tr>	
      <tr>
	     <td class="normal14z">立沖帳來源1：</td>
        <td class="normal14" >
		       <select id="ma012" onKeyPress="keyFunction()" name="ma012" " tabIndex="50">
            <option <?php if($ma012 == '1') echo 'selected="selected"';?> value='1'>1.客戶</option>                                                                        
		    <option <?php if($ma012 == '2') echo 'selected="selected"';?> value='2'>2.廠商</option>
            <option <?php if($ma012== '3') echo 'selected="selected"';?> value='3'>3.人員</option>
		    <option <?php if($ma012 == '4') echo 'selected="selected"';?> value='4'>4.部門</option>
			<option <?php if($ma012 == '9') echo 'selected="selected"';?> value='9'>9.其他</option>
		   </select></td> 
			  
        </td>
	    <td class="normal14z" >立沖帳管制1：</td>
        <td class="normal14">
		       <select id="ma013" onKeyPress="keyFunction()" name="ma013" " tabIndex="50">
            <option <?php if($ma013 == '1') echo 'selected="selected"';?> value='1'>1.不輸入</option>                                                                        
		    <option <?php if($ma013 == '2') echo 'selected="selected"';?> value='2'>2.可空白,須檢查</option>
            <option <?php if($ma013== '3') echo 'selected="selected"';?> value='3'>3.須輸入,不檢查</option>
		    <option <?php if($ma013 == '4') echo 'selected="selected"';?> value='4'>4.須輸入,須檢查</option>
			<option <?php if($ma013 == '5') echo 'selected="selected"';?> value='5'>>5.可空白,不檢查</option>
		   </select></td> 
			  
        </td>
	  </tr>	
      <tr>
	     <td class="normal14z">立沖帳來源2：</td>
        <td class="normal14" >
		        <select id="ma014" onKeyPress="keyFunction()" name="ma014" " tabIndex="50">
            <option <?php if($ma014 == '1') echo 'selected="selected"';?> value='1'>1.客戶</option>                                                                        
		    <option <?php if($ma014 == '2') echo 'selected="selected"';?> value='2'>2.廠商</option>
            <option <?php if($ma014== '3') echo 'selected="selected"';?> value='3'>3.人員</option>
		    <option <?php if($ma014 == '4') echo 'selected="selected"';?> value='4'>4.部門</option>
			<option <?php if($ma014 == '9') echo 'selected="selected"';?> value='9'>9.其他</option>
		   </select></td> 
			 
        </td>
	    <td class="normal14z">立沖帳管制2：</td>
        <td class="normal14" >
		        <select id="ma015" onKeyPress="keyFunction()" name="ma015" " tabIndex="50">
            <option <?php if($ma015 == '1') echo 'selected="selected"';?> value='1'>1.不輸入</option>                                                                        
		    <option <?php if($ma015 == '2') echo 'selected="selected"';?> value='2'>2.可空白,須檢查</option>
            <option <?php if($ma015== '3') echo 'selected="selected"';?> value='3'>3.須輸入,不檢查</option>
		    <option <?php if($ma015 == '4') echo 'selected="selected"';?> value='4'>4.須輸入,須檢查</option>
			<option <?php if($ma015 == '5') echo 'selected="selected"';?> value='5'>>5.可空白,不檢查</option>
		   </select></td> 
			  
        </td>
	  </tr>		  
	   <tr>
	    <td  class="normal14z" >部門管理：</td>
        <td  class="normal14"  >
		  <input type="hidden" name="ma009" class="ma009"  value="N" />
		  <input tabIndex="16" id="ma009" onKeyPress="keyFunction()"  name="ma009" <?php if($ma009 == 'Y' ) echo 'checked';  ?>  <?php if($ma009 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  />
        </td>	  
	    <td class="normal14z">貨幣性科目：</td>		
        <td  class="normal14"  ><input type="hidden" name="ma010" class="ma010"  value="N" />
		  <input tabIndex="17" id="ma010" onKeyPress="keyFunction()" name="ma010" <?php if($ma010 == 'Y' ) echo 'checked'; ?>  <?php if($ma010 != 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  />
        </td>
	  </tr>
	  <tr>
	    <td class="normal14z">科目有效：</td>		
        <td  class="normal14"  ><input type="hidden" name="ma016" class="ma016"  value="N" />
		  <input tabIndex="18" id="ma018" onKeyPress="keyFunction()" name="ma016" <?php if($ma016 == 'Y' ) echo 'checked'; ?>  <?php if($ma016 != 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  />
        </td>
	    <td class="normal14z" >慣用幣別： </td>
        <td  class="normal14"  ><input tabIndex="19" id="ma018" onKeyPress="keyFunction()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text"   /><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span></td>	
		
	  </tr>
		
	  <tr>
	    <td class="normal14z"> 財務比率類別：</td>
        <td class="normal14" >
		       <select id="ma011" onKeyPress="keyFunction()" name="ma011" " tabIndex="50">
            <option <?php if($ma011 == '01') echo 'selected="selected"';?> value='01'>01:流動資產-現金</option>                                                                        
		    <option <?php if($ma011 == '02') echo 'selected="selected"';?> value='02'>02:流動資產-短期投資</option>
            <option <?php if($ma011== '03') echo 'selected="selected"';?> value='03'>03:流動資產-應收帳款</option>
		    <option <?php if($ma011 == '04') echo 'selected="selected"';?> value='04'>04:流動資產-存貨</option>
			<option <?php if($ma011 == '05') echo 'selected="selected"';?> value='05'>05:流動資產-預付款項</option>
			<option <?php if($ma011 == '06') echo 'selected="selected"';?> value='06'>06:流動資產-其他</option>                                                                        
		    <option <?php if($ma011 == '07') echo 'selected="selected"';?> value='07'>07:基金及長期投資-基金</option>
            <option <?php if($ma011== '08') echo 'selected="selected"';?> value='08'>08:基金及長期投資-長期投資</option>
		    <option <?php if($ma011 == '09') echo 'selected="selected"';?> value='09'>09:基金及長期投資-長期應收</option>
			<option <?php if($ma011 == '10') echo 'selected="selected"';?> value='10'>10:固定資產</option>
			<option <?php if($ma011 == '11') echo 'selected="selected"';?> value='11'>11:其他資產</option>                                                                        
		    <option <?php if($ma011 == '12') echo 'selected="selected"';?> value='12'>12:流動負債-短期借款</option>
            <option <?php if($ma011== '13') echo 'selected="selected"';?> value='13'>13:流動負債-應付帳款</option>
		    <option <?php if($ma011 == '14') echo 'selected="selected"';?> value='14'>14:流動負債-預收款項</option>
			<option <?php if($ma011 == '28') echo 'selected="selected"';?> value='28'>28:流動負債-其他</option>
			<option <?php if($ma011 == '15') echo 'selected="selected"';?> value='15'>15:長期負倩</option>
			<option <?php if($ma011 == '16') echo 'selected="selected"';?> value='16'>16:其他負債</option>                                                                        
		    <option <?php if($ma011 == '17') echo 'selected="selected"';?> value='17'>17:投入股本</option>
            <option <?php if($ma011== '18') echo 'selected="selected"';?> value='18'>18:保留盈餘</option>
		    <option <?php if($ma011 == '19') echo 'selected="selected"';?> value='19'>19:資產增值公積</option>
			<option <?php if($ma011 == '20') echo 'selected="selected"';?> value='20'>20:銷貨收入</option>
			<option <?php if($ma011 == '21') echo 'selected="selected"';?> value='21'>21:其他收入</option>
			<option <?php if($ma011 == '29') echo 'selected="selected"';?> value='29'>29:銷貨折讓</option>                                                                        
		    <option <?php if($ma011 == '30') echo 'selected="selected"';?> value='30'>30:銷貨退回</option>
            <option <?php if($ma011== '22') echo 'selected="selected"';?> value='22'>22:銷貨成本</option>
		    <option <?php if($ma011 == '23') echo 'selected="selected"';?> value='23'>23:其他成本</option>
			<option <?php if($ma011 == '24') echo 'selected="selected"';?> value='24'>24:營業費用</option>
			 <option <?php if($ma011== '25') echo 'selected="selected"';?> value='25'>25:營業外收益</option>
		    <option <?php if($ma011 == '31') echo 'selected="selected"';?> value='31'>31:營業外費用</option>
			<option <?php if($ma011 == '26') echo 'selected="selected"';?> value='26'>26:所得稅</option>
			<option <?php if($ma011 == '27') echo 'selected="selected"';?> value='27'>27:其他</option>
		   </select></td> 
			   
	    <td class="normal14z"> 備註：</td>
        <td class="normal14" ><input  tabIndex="21" onKeyPress="keyFunction()" id="ma017" name="ma017"  value="<?php echo $ma017; ?>" size="50" type="text"  /></td>
	  </tr>
		
	</table>
	   		  
	<!--<div class="buttons">
	<button tabIndex="8" type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('act/acti03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> -->
	  
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  </div>  <!-- div-3 -->
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
 <?php include("./application/views/fun/acti03_funjs_v.php"); ?> 
 <?php  include_once("./application/views/funnew/acti03_funmjs_v.php"); ?>  <!-- 存貨科目 -->
	 
 