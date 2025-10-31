 <div id="container">   <!-- div-1 -->
  <div id="header">     <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 共用參數建立作業 - 修改　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#ma001').focus();" tabIndex="88" accesskey="s" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	    <a  tabIndex="89" id='cancel' accesskey="x" name='cancel' href="<?php echo site_url('main/index/101'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  
	</div>
	</div>
    <div class="content">  <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cms/cmsi01/updsave" method="post" enctype="multipart/form-data" >
	 <!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general">   <!-- div-tab -->
	<?php
    date_default_timezone_set("Asia/Taipei");
	?>
	
	<?php foreach($results as $row ) : ?>
          <?php   $ma001c[]=$row->ma001;?>
          <?php   $ma002c[]=$row->ma002;?>
          <?php   $ma003c[]=$row->ma003;?>
          <?php   $ma004c[]=$row->ma004;?>
          <?php   $ma005c[]=$row->ma005;?>
          <?php   $ma006c[]=$row->ma006;?>
		  <?php   $ma007c[]=$row->ma007;?>
		  <?php   $ma008c[]=$row->ma008;?>
		  <?php   $ma009c[]=$row->ma009;?>
		  <?php   $ma010c[]=$row->ma010;?>
		  <?php   $ma011c[]=$row->ma011;?>
		  <?php   $ma012c[]=$row->ma012;?>
		  <?php   $ma013c[]=$row->ma013;?>
		  <?php   $ma014c[]=$row->ma014;?>
		  <?php   $ma015c[]=$row->ma015;?>
		  <?php   $ma016c[]=$row->ma016;?>
		  <?php   $ma017c[]=$row->ma017;?>
		  <?php   $ma018c[]=$row->ma018;?>
		  <?php   $ma019c[]=$row->ma019;?>
		  <?php   $ma020c[]=$row->ma020;?>
		  <?php   $ma021c[]=$row->ma021;?>
		  <?php   $ma022c[]=$row->ma022;?>
		  <?php   $ma023c[]=$row->ma023;?>
		  <?php   $ma024c[]=$row->ma024;?>
		  <?php   $ma025c[]=$row->ma025;?>
		  <?php   $ma026c[]=$row->ma026;?>
		  <?php   $ma027c[]=$row->ma027;?>
		  <?php   $ma028c[]=$row->ma028;?>
		  <?php   $ma029c[]=$row->ma029;?>
		  <?php   $ma030c[]=$row->ma030;?>
		   <?php   $ma200c[]=$row->ma200;?>
		    <?php   $ma201c[]=$row->ma201;?>
		    <?php   $ma202c[]=$row->ma202;?>
			<?php   $ma203c[]=$row->ma203;?>
			<?php   $ma204c[]=$row->ma204;?>
			<?php   $ma205c[]=$row->ma205;?>
			<?php   $ma206c[]=$row->ma206;?>
			<?php   $ma207c[]=$row->ma207;?>
		  <?php   $cmsq06ac[]=$row->ma003;?>
		  <?php   $cmsq06acdisp[]=$row->ma003;?>
		  
		  <?php   $companyc[]=$row->company;?>
		  <?php   $creatorc[]=$row->creator;?>
		  <?php   $usr_groupc[]=$row->usr_group;?>
		  <?php   $create_datec[]=$row->create_date;?>
		  <?php   $modifierc[]=$row->modifier;?>
		  <?php   $modi_datec[]=$row->modi_date;?>
          <?php   $flagc[]=$row->flag;?>	  
	 <?php endforeach;?>
	 
	 <?php $ma001=$ma001c[0];?>
	 <?php $ma002=$ma002c[0];?>
	 <?php $ma003=$ma003c[0];?>
	 <?php $ma004=$ma004c[0];?>
	 <?php $ma005=$ma005c[0];?>
	 <?php $ma006=$ma006c[0];?>
	 <?php $ma007=$ma007c[0];?>
	 <?php $ma008=$ma008c[0];?>
	 <?php $ma009=$ma009c[0];?>
	 <?php $ma010=$ma010c[0];?>
	 <?php $ma011=$ma011c[0];?>
	 <?php $ma012=$ma012c[0];?>
	 <?php $ma013=$ma013c[0];?>
	 <?php $ma014=$ma014c[0];?>
	 <?php $ma015=$ma015c[0];?>
	 <?php $ma016=$ma016c[0];?>
	 <?php $ma017=$ma017c[0];?>
	 <?php $ma018=$ma018c[0];?>
	 <?php $ma019=$ma019c[0];?>
	 <?php $ma020=$ma020c[0];?>
	 <?php $ma021=$ma021c[0];?>
	 <?php $ma022=$ma022c[0];?>
	 <?php $ma023=$ma023c[0];?>
	 <?php $ma024=$ma024c[0];?>
	 <?php $ma025=$ma025c[0];?>
	 <?php $ma026=$ma026c[0];?>
	 <?php $ma027=$ma027c[0];?>
	 <?php $ma028=$ma028c[0];?>
	 <?php $ma029=$ma029c[0];?>
	 <?php $ma030=$ma030c[0];?>
	  <?php $ma200=$ma200c[0];?>
	   <?php $ma201=$ma201c[0];?>
	    <?php $ma202=$ma202c[0];?>
		<?php $ma203=$ma203c[0];?>
		<?php $ma204=$ma204c[0];?>
	 <?php $ma205=$ma205c[0];?>
	 <?php $ma206=$ma206c[0];?>
	 <?php $ma207=$ma207c[0];?>
	 <?php $ma022=substr($ma022c[0],0,4).'/'.substr($ma022c[0],4,2);?>
	 <?php $ma021=substr($ma021c[0],0,4).'/'.substr($ma021c[0],4,2);?>
	 <?php $ma027=substr($ma027c[0],0,4).'/'.substr($ma027c[0],4,2);?>
	 <?php $ma028=substr($ma028c[0],0,4).'/'.substr($ma028c[0],4,2);?>
	 <?php $ma029=substr($ma029c[0],0,4).'/'.substr($ma029c[0],4,2);?>
	 <?php $ma030=substr($ma030c[0],0,4).'/'.substr($ma030c[0],4,2);?>
	 <?php $ma011=substr($ma011c[0],0,4).'/'.substr($ma011c[0],4,2);?>
	 <?php $ma012=substr($ma012c[0],0,4).'/'.substr($ma012c[0],4,2);?>
	 <?php $ma013=substr($ma013c[0],0,4).'/'.substr($ma013c[0],4,2).'/'.substr($ma013c[0],6,2);?>
	 <?php $ma204=substr($ma204c[0],0,4).'/'.substr($ma204c[0],4,2).'/'.substr($ma204c[0],6,2);?>
	 <?php $cmsq06a=$cmsq06ac[0];?>
	 <?php $cmsq06adisp=$cmsq06acdisp[0];?>
	 
	 <?php $company=$companyc[0];?>
	 <?php $usr_group=$usr_groupc[0];?>
	 <?php $create_date=substr($create_datec[0],0,4).'/'.substr($create_datec[0],4,2).'/'.substr($create_datec[0],6,2);?>
	 <?php $modifier=$modifierc[0];?>
	 <?php $modi_date=substr($modi_datec[0],0,4).'/'.substr($modi_datec[0],4,2).'/'.substr($modi_datec[0],6,2);?>
	 <?php $flagc=$flagc[0];?>
       
	
	
	<div class="abgne_tab"> <!-- div-7 -->
		<ul class="tabs">
		     <li><a href="#tab1" accesskey="a" >基本參數a</a></li>
			<li><a href="#tab2" accesskey="b" >進銷存參數b</a></li>
			<li><a href="#tab3" accesskey="c" >財務參數c</a></li>
			<li><a href="#tab4" accesskey="g" >人事參數g</a></li>	
	    </ul>

    <div class="tab_container"> <!-- div-8 -->
	
	 <!--  基本參數 -->
	<div id="tab1" class="tab_content">
	<table class="form14">     <!-- 表格 -->
	<tr>
	    <td class="normal14y" width="11%" >日期格式：</td>
		<td class="normal14a" width="39%"><select  tabIndex="1" id="ma001" onKeyPress="keyFunction()"  name="ma001" >
             <option <?php if($ma001 == '1') echo 'selected="selected"';?> value='1'>1.西元年 YYYYMMDD</option>                                                                      
		     <option <?php if($ma001 == '2') echo 'selected="selected"';?> value='2'>2.西元年 MMDDYYYY</option>
			 <option <?php if($ma001 == '3') echo 'selected="selected"';?> value='3'>3.西元年 DDMMYYYY</option>                                                                        
		     <option <?php if($ma001 == '4') echo 'selected="selected"';?> value='4'>4.民國年 YYMMDD</option>
			 <option <?php if($ma001 == '5') echo 'selected="selected"';?> value='5'>5.民國年 YYYMMDD</option>
			 
		  </select>
		<td class="normal14y" width="12%">日期區隔符號：</td>
        <td class="normal14a"  width="38%" > <input tabIndex="2" type="radio" name="ma001" <?php if (isset($ma001) && $ma001=="1") echo "checked";?> value="1" />-&nbsp;&nbsp; 
          <input type="radio" tabIndex="3" name="ma001" <?php if (isset($ma001) && $ma001=="2") echo "checked";?> value="2" />/</td>
		
	 </tr>	
		
	  <tr>
	    <td class="normal14z">本國幣別：</td>						
        <td  class="normal14"  ><input tabIndex="4" id="ma003" onKeyPress="keyFunction()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text"   /><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span></td>
	    <td  class="normal14z" >營業稅率：</td>
        <td class="normal14"><input tabIndex="5" id="ma004" onKeyPress="keyFunction()"   name="ma004" value="<?php echo $ma004; ?>" type="text"  /></td>
	  </tr>
	  
	   <tr>
	    <td class="normal14z"  >數量表達：</td>
		<td class="normal14a" ><select  tabIndex="6" id="ma024" onKeyPress="keyFunction()"  name="ma024" >
             <option <?php if($ma024 == '1') echo 'selected="selected"';?> value='1'>1.單一單位</option>                                                                      
		     <option <?php if($ma024 == '2') echo 'selected="selected"';?> value='2'>2.雙單位</option>
			 <option <?php if($ma024 == '3') echo 'selected="selected"';?> value='3'>3.製造雙單位</option>
			 
		  </select>
		<td class="normal14z" >確認日依據：</td>
        <td class="normal14a"   > <input tabIndex="7" type="radio" name="ma025" <?php if (isset($ma025) && $ma025=="1") echo "checked";?> value="1" />系統日&nbsp;&nbsp; 
          <input type="radio" tabIndex="8" name="ma025" <?php if (isset($ma025) && $ma025=="2") echo "checked";?> value="2" />單據日</td>
		
	 </tr>	
	  
	  <tr>
	   <td class="normal14z" >稅額計算方式:</td>
        <td class="normal14a"   > <input tabIndex="9" type="radio" name="ma006" <?php if (isset($ma006) && $ma006=="1") echo "checked";?> value="1" />系統日&nbsp;&nbsp; 
          <input type="radio" tabIndex="8" name="ma006" <?php if (isset($ma006) && $ma006=="2") echo "checked";?> value="2" />單據日</td>
		
		<td  class="normal14z">一品號對多條碼：</td>						
        <td  class="normal14"  ><input type="hidden" name="ma023" value="N" />
		<input type='checkbox' tabIndex="10" id="ma023" onKeyPress="keyFunction()" name="ma023" <?php if($ma023 == 'Y' ) echo 'checked'; ?>  <?php if($ma023 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td>
	  </tr>
	  
	  <tr>
		<td class="normal14z">預設廠別:</td>
        <td class="normal14"><input tabIndex="11" id="ma200" onKeyPress="keyFunction()"   name="ma200" value="<?php echo $ma200; ?>" type="text"  /></td>
		<td class="normal14z">保留:</td>
        <td class="normal14"><input tabIndex="12" id="ma201" onKeyPress="keyFunction()"   name="ma201" value="<?php echo $ma201; ?>" type="text"  /></td>
	  </tr>
	    <tr>
	    <td class="normal14z"  >表單紙張設定：</td>
		<td class="normal14a" ><select  tabIndex="13" id="ma202" onKeyPress="keyFunction()"  name="ma202" >
             <option <?php if($ma202 == '1') echo 'selected="selected"';?> value='1'>1.letter1/2</option>                                                                      
		     <option <?php if($ma202 == '2') echo 'selected="selected"';?> value='2'>2.A5(14.8cm,21cm 橫式)</option>
			
		  </select>
		<td class="normal14z">主要庫別:</td>
        <td class="normal14"><input tabIndex="14" id="ma203" onKeyPress="keyFunction()"   name="ma203" value="<?php echo $ma203; ?>" type="text"  /></td>
		
	 </tr>	
	  <tr>
		<td class="normal14z">預設簽核(直式):</td>
        <td class="normal14" colspan="3" ><input tabIndex="11" id="ma206" onKeyPress="keyFunction()"   name="ma206" value="<?php echo $ma206; ?>" type="text" size="120" /></td>
		<td class="normal14a"></td>
        <td class="normal14"></td>
	  </tr>
	   <tr>
		<td class="normal14z">預設簽核(橫式):</td>
        <td class="normal14" colspan="3" ><input tabIndex="11" id="ma207" onKeyPress="keyFunction()"   name="ma207" value="<?php echo $ma207; ?>" type="text" size="120" /></td>
		<td class="normal14a"></td>
        <td class="normal14"></td>
	  </tr>
	</table>
	</div>
	<!--  進銷存參數 -->
     <div id="tab2" class="tab_content">
	 <table class="form14">     <!-- 表格 -->
	 <tr>
	    <td class="normal14y" width="11%" >商品分類一：</td>
		<td class="normal14a" width="39%"><input tabIndex="11" id="ma007" onKeyPress="keyFunction()"   name="ma007" value="<?php echo $ma007; ?>" type="text"  /></td>
		<td class="normal14y" width="11%">商品分類二：</td>
        <td class="normal14a"  width="39%" > <input tabIndex="12" id="ma008" onKeyPress="keyFunction()"   name="ma008" value="<?php echo $ma008; ?>" type="text"  /></td>
		
	 </tr>
	   <tr>
	    <td class="normal14z"  >商品分類三：</td>
		<td class="normal14a" ><input tabIndex="13" id="ma009" onKeyPress="keyFunction()"   name="ma009" value="<?php echo $ma009; ?>" type="text"  /></td>
		<td class="normal14z">商品分類四：</td>
        <td class="normal14a"  > <input tabIndex="14" id="ma010" onKeyPress="keyFunction()"   name="ma010" value="<?php echo $ma010; ?>" type="text"  /></td>
	 </tr>	
	  </tr>
	   <tr>
	    <td class="normal14z"  >庫存現行年月：</td>
		<td class="normal14a" ><input tabIndex="15" id="ma011" onKeyPress="keyFunction()" onfocus="this.select();"  onchange="dataym2(this)"  name="ma011" value="<?php echo $ma011; ?>" type="text"  style="background-color:#E7EFEF"/><span > <?php echo '輸入範例yyyymm'; ?> </span></td>
		<td class="normal14z">庫存關帳年月：</td>
        <td class="normal14a"  > <input tabIndex="16" id="ma012" onKeyPress="keyFunction()"  onfocus="this.select();"  onchange="dataym3(this)" name="ma012" value="<?php echo $ma012; ?>" type="text" style="background-color:#E7EFEF" /><span > <?php echo '輸入範例yyyymm'; ?> </span></td>
	 </tr>	
	 
	   <tr>	    
		<td class="normal14z" >成本計價方式：</td>
        <td class="normal14a" > <input tabIndex="17" type="radio" name="ma014" <?php if (isset($ma014) && $ma014=="1") echo "checked";?> value="1" />標準成本&nbsp;&nbsp; 
          <input type="radio" tabIndex="8" name="ma014" <?php if (isset($ma014) && $ma014=="2") echo "checked";?> value="2" />月加權平均成本</td>
		<td class="normal14z"> 帳務凍結日期：</td>
        <td class="normal14a"  > <input tabIndex="18" id="ma013" onKeyPress="keyFunction()" onfocus="this.select();" onclick="scwShow(this,event);" onchange="dataymd1(this)" name="ma013" value="<?php echo $ma013; ?>" type="text" style="background-color:#E7EFEF" /><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td>
	 </tr>	
	 <tr>	    
		<td class="normal14z" >庫存盤點日期：</td>
        <td class="normal14a" > <input tabIndex="19" id="ma204" onKeyPress="keyFunction()" onfocus="this.select();" onclick="scwShow(this,event);" onchange="dataymd2(this)" name="ma204" value="<?php echo $ma204; ?>" type="text" style="background-color:#E7EFEF" /><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td>
		<td class="normal14a"> </td>
        <td class="normal14a"  > </td>
	 </tr>	
	
	</table>
	</div>
	<!-- 財務參數 -->
     <div id="tab3" class="tab_content">
	 <table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="12%" >會計期制：</td>
		<td class="normal14a" width="38%"> <input tabIndex="19" type="radio" name="ma016" <?php if (isset($ma016) && $ma016=="1") echo "checked";?> value="1" />12期&nbsp;&nbsp; 
          <input type="radio" tabIndex="20" name="ma016" <?php if (isset($ma016) && $ma016=="2") echo "checked";?> value="2" />13期</td>
		<td class="normal14y" width="15%">會計現行年度：</td>
        <td class="normal14a"  width="35%" > <input tabIndex="20" id="ma019" onKeyPress="keyFunction()"   name="ma019" value="<?php echo $ma019; ?>" type="text"  /></td>
		
	 </tr>
	   <tr>
	    <td class="normal14z"  >會計現行期別：</td>
		<td class="normal14a" ><input tabIndex="21" id="ma015" onKeyPress="keyFunction()"   name="ma015" value="<?php echo $ma015; ?>" type="text"  /></td>
		<td class="normal14z">會計關帳年度：</td>
        <td class="normal14a"  > <input tabIndex="22" id="ma020" onKeyPress="keyFunction()"   name="ma020" value="<?php echo $ma020; ?>" type="text"  /></td>
	 </tr>	
	  </tr>
	   <tr>
	    <td class="normal14z"  >會計關帳期別：</td>
		<td class="normal14a" ><input tabIndex="23" id="ma018" onKeyPress="keyFunction()"   name="ma018" value="<?php echo $ma018; ?>" type="text"  /></td>
		<td class="normal14z">銀行存款現行年月：</td>
        <td class="normal14a"  > <input tabIndex="24" id="ma021" onKeyPress="keyFunction()"  onfocus="this.select();"  onchange="dataym5(this)" name="ma021" value="<?php echo $ma021; ?>" type="text"  /><span > <?php echo '輸入範例yyyymm'; ?> </span></td>
	 </tr>	
	  <tr>
	    <td class="normal14z"  >應收現行年月：</td>
		<td class="normal14a" ><input tabIndex="25" id="ma027" onKeyPress="keyFunction()"  onfocus="this.select();"  onchange="dataym6(this)" name="ma027" value="<?php echo $ma027; ?>" type="text"  /><span > <?php echo '輸入範例yyyymm'; ?> </span></td>
		<td class="normal14z">應收關帳年月：</td>
        <td class="normal14a"  > <input tabIndex="26" id="ma028" onKeyPress="keyFunction()"  onfocus="this.select();"  onchange="dataym7(this)" name="ma028" value="<?php echo $ma028; ?>" type="text"  /><span > <?php echo '輸入範例yyyymm'; ?> </span></td>
	 </tr>	
	  <tr>
	    <td class="normal14z" >應付現行年月：</td>
		<td class="normal14a" ><input tabIndex="27" id="ma029" onKeyPress="keyFunction()"  onfocus="this.select();"  onchange="dataym8(this)" name="ma029" value="<?php echo $ma029; ?>" type="text"  /><span > <?php echo '輸入範例yyyymm'; ?> </span></td>
		<td class="normal14z">應付關帳年月：</td>
        <td class="normal14a" > <input tabIndex="28" id="ma030" onKeyPress="keyFunction()" onfocus="this.select();"  onchange="dataym9(this)"  name="ma030" value="<?php echo $ma030; ?>" type="text"  /><span > <?php echo '輸入範例yyyymm'; ?> </span></td>
	 </tr>	
	 
	</table>
	</div>
	<!-- 人事參數 -->
     <div id="tab4" class="tab_content">
	 <table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y"  width="12%" >薪資關帳年月：</td>
		<td class="normal14a"  width="38%"><input tabIndex="29" id="ma022" onKeyPress="keyFunction()"  onfocus="this.select();" onchange="dataym1(this)"  name="ma022" value="<?php echo $ma022; ?>" type="text" style="background-color:#E7EFEF"  /><span > <?php echo '輸入範例yyyymm'; ?> </span></td>
		<td class="normal14y" width="12">月伙食費</td>
        <td class="normal14a" width="38%" ><input tabIndex="30" id="ma205" onKeyPress="keyFunction()"    name="ma205" value="<?php echo $ma205; ?>" type="text"   /></td>
	 </tr>	
	 
	</table>
	</div> 
		</div>        <!-- div- 可儲存顯示 -->
		 <input type="hidden" class="commpany" name="company" value="" />
	  <!--<div class="buttons">
	    <button tabIndex="88" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  tabIndex="89" id='cancel' name='cancel' href="<?php echo site_url('main/index/101'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
<?php include("./application/views/fun/cmsi01_funjs_v.php"); ?>