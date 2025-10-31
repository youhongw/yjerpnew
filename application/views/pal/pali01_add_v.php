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

<div id="content"> <!-- div-3 -->
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 員工基本資料建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#mv001').focus();" style= "cursor:pointer" form="commentForm" onfocus="$('#mv001').focus();"  type='submit'  accesskey="s"  name="submit"  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	    <a  accesskey="x"  onKeyPress="keyFunction()" id="cancel" name="cancel" href="<?php echo site_url('pal/pali01/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
		<a   accesskey="z" tabIndex="9" target="_blank" id='add_bau' name='add_bau' href="<?php echo site_url('pal/pali27/addform'); ?>" class="button" ><span>員工加保建立Alt+z</span><img src="<?php echo base_url()?>assets/image/png/eye.png" /></a>
	    
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pal/pali01/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Ymd");
	  if(!isset($mv001)) { $mv001=$this->input->post('mv001'); }
      $mv002=$this->input->post('mv002');
      $mv003=$this->input->post('mv003');	  
      $cmsq05a=$this->input->post('cmsq05a');
      $mv004=$this->input->post('mv004');
	  $mv004disp=$this->input->post('mv004');
	  $cmsq05adisp=$this->input->post('mv004');
	  $mv005=$this->input->post('mv005');
      $cmsq09b=$this->input->post('cmsq09b');
      $cmsq09bdisp=$this->input->post('mv006');	 	  
      $mv047=$this->input->post('mv047'); 
	  $mv010=$this->input->post('mv010'); 
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="8%"><span class="required">員工代號：</span> </td>
        <td class="normal14a"  width="24%"><input tabIndex="1" id="mv001"    type="text"   onKeyPress="keyFunction()" onchange="startkey(this)"  name="mv001" value="<?php echo strtoupper($mv001); ?>"   required />
		  <span id="keydisp" ></span></td>
	    <td class="normal14y" width="11%" >員工姓名： </td>
        <td class="normal14a"  width="24%" ><input tabIndex="2" id="mv002" onKeyPress="keyFunction()" name="mv002"   value="<?php echo  $mv002; ?>"    type="text"  /></td>
		<td class="normal14y" width="9%" >英文名字： </td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="mv047" onKeyPress="keyFunction()" name="mv047"  value="<?php echo  $mv047; ?>"    type="text"  /></td>
	 </tr>	
		  
	  <tr>
	       <td class="normal14z" >科目種類： </td>
        <td class="normal14" ><?php echo '<select id="mv010" name="mv010"  " >'; ?>
		                      <?php foreach($results1 as $row ) : ?>      <!-- 裡面也可以下 html   -->
		                      <?php echo '<option ';
							  if($mv010 == $row->op1no) echo 'selected="selected"';
							  echo 'value='.$row->op1no.'>'.$row->op1name.'</option>'; ?>
							  <?php endforeach;?></select>  
							  <a href="javascript:;"   ><img id="Showpali08add" src="<?php echo base_url()?>assets/image/png/add.png" alt="" align="top"/></a></td>	 
	<!--    <td class="normal14" >科目種類： </td>
        <td class="normal14" ><select id="mv010" onKeyPress="keyFunction()" name="mv010"  tabIndex="4">
            <option <?php if($mv010 == '1') echo 'selected="selected"';?> value='1'>1.直接費用</option>                                                                        
		    <option <?php if($mv010 == '2') echo 'selected="selected"';?> value='2'>2.間接費用</option>
            <option <?php if($mv010 == '3') echo 'selected="selected"';?> value='3'>3.管理費用</option>
		    <option <?php if($mv010 == '4') echo 'selected="selected"';?> value='4'>4.銷售費用</option>
		    <option <?php if($mv010 == '5') echo 'selected="selected"';?> value='5'>5.研發費用</option>
		   </select></td> -->
		<td class="normal14z">申報公司代號：</td>
        <td class="normal14"><input tabIndex="5" id="mv003" onKeyPress="keyFunction()" name="mv003"  value="<?php echo $mv003; ?>"  size="10" type="text"   /></td>
		<td class="normal14z">部門別：</td>
        <td class="normal14"><input type="text" tabIndex="6" onKeyPress="keyFunction()" id="mv004"  name="cmsq05a"  onchange="startcmsq05a(this)"    value="<?php echo  $cmsq05a; ?>"     /><a href="javascript:;"><img id="Showcmsq05a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
	   <span id="cmsq05adisp" > <?php    echo $cmsq05adisp; ?> </span></td>
	  </tr>
		
	  <tr>
	    <td  class="normal14z" >職等：</td>
        <td  class="normal14"  ><input tabIndex="7" id="mv005" onKeyPress="keyFunction()" name="mv005"  value="<?php echo $mv005; ?>"  size="10" type="text"   /></td>
		<td class="normal14z">職稱類別：</td>
        <td class="normal14"><input type="text" tabIndex="6" onKeyPress="keyFunction()" id="mv006"  name="cmsq09b"  onchange="startcmsq09b(this)"    value="<?php echo  $cmsq09b; ?>"     /><a href="javascript:;"><img id="Showcmsq09b" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
	   <span id="cmsq09bdisp" > <?php    echo $cmsq09bdisp; ?> </span></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
			<li><a href="#tab1" accesskey="a"  >基本資料(一)a</a></li>
			<li><a href="#tab2"  accesskey="b" >基本資料(二)b</a></li>
			<li><a href="#tab3"  accesskey="c" >計薪條件c</a></li>
			<li><a href="#tab4"  accesskey="g" >其他資料g</a></li>
			<li><a href="#tab5"  accesskey="i" >評語考績i</a></li>
		</ul>
	

    <div class="tab_container">
	
	<!--  基本資料 -->
	<div id="tab1" class="tab_content">
	<?php
	  $date=date("Ymd");
	  if (!isset($mv007)) {$mv007='1';} else {$mv007=$this->input->post('mv007');}
	  $mv008=$this->input->post('mv008');
	  $mv009=$this->input->post('mv009');
	  $palq09a=$this->input->post('palq09a');
	  $palq09adisp=$this->input->post('mv012');
	  $mv013=$this->input->post('mv013');
	  $mv031=$this->input->post('mv031');	
	   if (!isset($mv014)) {$mv014='1';} else {$mv014=$this->input->post('mv014');}
	//  $mv014=$this->input->post('mv014');	
	  $mv021=$this->input->post('mv021');
      $mv052=$this->input->post('mv052');
	  $mv022=$this->input->post('mv022');	
	  $mv053=$this->input->post('mv053');	
	  $mv023=$this->input->post('mv023');
      $mv029=$this->input->post('mv029');
	  $mv024=$this->input->post('mv024');	
	  $mv011=$this->input->post('mv011');	
	  $mv025=$this->input->post('mv025');
      $mv030=$this->input->post('mv030');
	  $mv218=$this->input->post('mv218');
	  $mv219=$this->input->post('mv219');
	 // if (($mv053!="1") && ($mv053!="2") ) { $mv053="1" ;}
	  //開視窗及不更新網頁直接輸入出現中文
	//  $copq01adisp=$this->input->post('mv065');   //員工
	//  $cmsq06adisp=$this->input->post('mv014');   //交易幣別
	//  $cmsq05adisp=$this->input->post('mv015');   //部門別
	 
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="10%" >性別：</td>
		<td class="normal14a" width="23%"><input type="radio" tabIndex="10" name="mv007" <?php if (isset($mv007) && $mv007=="1") echo "checked";?> value="1" />男　&nbsp;
               <input type="radio" tabIndex="11" name="mv007" <?php if (isset($mv007) && $mv007=="2") echo "checked";?> value="2" />女
        </td>
		<td class="normal14y" width="11%">出生日期：</td>
        <td class="normal14a"  width="22%" ><input type="text" tabIndex="12"  onfocus="this.select()" onKeyPress="keyFunction()"  ondblclick="scwShow(this,event);" onchange="dataymd1(this);check_len(this);"  id="mv008" name="mv008"   value="<?php echo $mv008; ?>"   style="background-color:#E7EFEF"   /></td>
		<td class="normal14y"  width="11%" >身分證號：</td>
        <td class="normal14a"  width="23%" ><input tabIndex="13" id="mv009" onKeyPress="keyFunction()"   name="mv009" value="<?php echo $mv009; ?>" type="text"  /></td>
	 </tr>	
		  
	  <tr>
	   <td class="normal14z"  >學歷：</td>
        <td class="normal14" ><input type="text" tabIndex="6" onKeyPress="keyFunction()" id="mv012"  name="palq09a"  onchange="startpalq09a(this)"    value="<?php echo  $palq09a; ?>"     /><a href="javascript:;"><img id="Showpalq09a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
	   <span id="palq09adisp" > <?php    echo $palq09adisp; ?> </span></td>
	    <td class="normal14z" >專長：</td>
        <td class="normal14"  ><input tabIndex="15" id="mv013" onKeyPress="keyFunction()"   name="mv013" value="<?php echo $mv013; ?>" type="text"  /></td>
		<td class="normal14z" >年資：</td>
        <td class="normal14"  ><input tabIndex="16" id="mv031" onKeyPress="keyFunction()"   name="mv031" value="<?php echo $mv031; ?>" type="text"  /></td>
	  </tr>
		<tr>
	    <td class="normal14z"  >婚姻：</td>
		<td class="normal14a" ><input type="radio" tabIndex="17" name="mv014" <?php if (isset($mv014) && $mv014=="1") echo "checked";?> value="1" />已婚　&nbsp;
               <input type="radio" tabIndex="18" name="mv014" <?php if (isset($mv014) && $mv014=="2") echo "checked";?> value="2" />未婚
        </td>
		<td class="normal14z" >到職日期：</td>
        <td class="normal14a"   ><input type="text" tabIndex="18"   onKeyPress="keyFunction()" onfocus="this.select()" ondblclick="scwShow(this,event);" onchange="dataymd2(this);check_len(this);"  id="mv021" name="mv021"   value="<?php echo $mv021; ?>"   style="background-color:#E7EFEF"   /></td>
		<td class="normal14z"   >試用期滿：</td>
        <td class="normal14a"   ><input tabIndex="19" id="mv052"  onKeyPress="keyFunction()" onfocus="this.select()" ondblclick="scwShow(this,event);" onchange="dataymd3(this);check_len(this);"  name="mv052" value="<?php echo $mv052; ?>" type="text"  style="background-color:#E7EFEF"  /></td>
	 </tr>	
	 <tr>
	    <td class="normal14z" >離職日期：</td>
        <td class="normal14a"   ><input type="text" tabIndex="20"   onKeyPress="keyFunction()" onfocus="this.select()" ondblclick="scwShow(this,event);"  onchange="dataymd4(this);check_len(this);" id="mv022" name="mv022"   value="<?php echo $mv022; ?>"   style="background-color:#E7EFEF"   /></td>
		<td class="normal14z" >預計退休日：</td>
        <td class="normal14a"   ><input type="text" tabIndex="21"   onKeyPress="keyFunction()" onfocus="this.select()" ondblclick="scwShow(this,event);" onchange="dataymd5(this);check_len(this);" id="mv053" name="mv053"   value="<?php echo $mv053; ?>"   style="background-color:#E7EFEF"   /></td>
		<td class="normal14z"   >退休日期：</td>
        <td class="normal14a"   ><input tabIndex="22" id="mv023"  onKeyPress="keyFunction()" onfocus="this.select()" ondblclick="scwShow(this,event);"  onchange="dataymd6(this);check_len(this);" name="mv023" value="<?php echo $mv023; ?>" type="text"  style="background-color:#E7EFEF"  /></td>
	 </tr>	
	  <tr>
	    <!--<td  class="normal14" >文管代號：</td>
        <td  class="normal14"  ><input tabIndex="23" id="mv011" onKeyPress="keyFunction()"   name="mv029" value="<?php echo $mv029; ?>" type="text"  /></td>
	    <td  class="normal14" >補助等級：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="24"  id="mv024" onKeyPress="keyFunction()"   name="mv024" value="<?php echo $mv024; ?>"   /></td>-->
	    <td  class="normal14z" >投保身份：</td>
        <td class="normal14"><input tabIndex="25" id="mv011" onKeyPress="keyFunction()"   name="mv011" value="<?php echo $mv011; ?>" type="text"  /></td>
	   
	  </tr>
	   <tr>
	    <!--<td  class="normal14" >勞保卡號：</td>
        <td  class="normal14"  ><input tabIndex="26" id="mv025" onKeyPress="keyFunction()"   name="mv025" value="<?php echo $mv025; ?>" type="text"  /></td>		   -->
	    <td  class="normal14z" >健保保號：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="27"  id="mv030" onKeyPress="keyFunction()"   name="mv030" value="<?php echo $mv030; ?>"   /></td>
	    <td  class="normal14" ></td>
        <td class="normal14"></td>
	   
	  </tr>
			<tr>
		<td  class="normal14z" >國籍別：</td>
        <td class="normal14"><input tabIndex="25" id="mv218" onKeyPress="keyFunction()"   name="mv218" value="<?php echo $mv218; ?>" type="text"  /></td>
        <td  class="normal14z" >護照號碼：</td>
        <td class="normal14"><input tabIndex="25" id="mv219" onKeyPress="keyFunction()"   name="mv219" value="<?php echo $mv219; ?>" type="text"  /></td>	 
	 </tr>
	</table>
	</div>
	<!--  基本資料2 -->
     <div id="tab2" class="tab_content">
	<?php
	  $date=date("Ymd");
	  $mv015=$this->input->post('mv015');
	  $mv026=$this->input->post('mv026');
	  $mv016=$this->input->post('mv016');
	  $mv020=$this->input->post('mv020');
	//  $mv027=$this->input->post('mv027');
	  $palq16a=$this->input->post('palq16a');
	  $palq16adisp=$this->input->post('palq16adisp');
	  $mv028=$this->input->post('mv028');
	  $mv017=$this->input->post('mv017');
	  $mv018=$this->input->post('mv018');
	  $mv019=$this->input->post('mv019');
	  $mv046=$this->input->post('mv046');
	   $mv209=$this->input->post('mv209');
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y"  width="11%"> 聯絡電話1：</td>
        <td class="normal14a"  width="39%"><input tabIndex="28" id="mv015" onKeyPress="keyFunction()" name="mv015" value="<?php echo $mv015; ?>" size="40" type="text"  /></td>
	    <td class="normal14y"  width="12%"> 須刷卡：</td>
        <td class="normal14a"  width="38%"><input type="hidden" name="mv026" class="mv026"  value="N" />
		  <input tabIndex="29" id="mv026" onKeyPress="keyFunction()" name="mv026" <?php if($mv026 == 'Y' ) echo 'checked'; ?>  <?php if($mv026 != 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td>
	  </tr>
	  <tr>
	    <td class="normal14z" > 電話2：</td>
        <td class="normal14" ><input tabIndex="30" id="mv016" onKeyPress="keyFunction()" name="mv016" value="<?php echo $mv016; ?>" size="40" type="text"  /></td>
	    <td class="normal14z" > 主要班別：</td>
        <td class="normal14" ><input type="text" tabIndex="31" onKeyPress="keyFunction()" id="mv027"  name="palq16a"  onchange="startpalq16a(this)"    value="<?php echo  $palq16a; ?>"     /><a href="javascript:;"><img id="Showpalq16a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
	   <span id="palq16adisp" > <?php    echo $palq16adisp; ?> </span></td>
	  </tr>
	  <tr>
	    <td class="normal14z" > E-MAIL：</td>
        <td class="normal14" ><input tabIndex="32" id="mv020" onKeyPress="keyFunction()" name="mv020" value="<?php echo $mv020; ?>" size="40" type="text"  /></td>
		<td class="normal14z" >刷卡卡號：</td>
        <td class="normal14" ><input tabIndex="33" id="mv028" onKeyPress="keyFunction()" name="mv028" value="<?php echo $mv028; ?>" size="10" type="text"  /></td>
	  </tr>
	  <tr>
        <td class="normal14z" > 戶籍地址：</td>
        <td class="normal14" ><select onchange=Buildkey1(this.options[this.options.selectedIndex].value); size="1" name="mew1" class="sel_city1 " > 
 <OPTION value=0 selected>請選擇縣市</OPTION> <OPTION 
value=1>臺北市</OPTION> <OPTION value=2>基隆市</OPTION> <OPTION 
value=3>新北市</OPTION> <OPTION value=4>宜蘭縣</OPTION> <OPTION 
value=5>新竹縣市</OPTION> <OPTION value=6>桃園縣</OPTION> <OPTION 
value=7>苗栗縣</OPTION> <OPTION value=8>臺中市</OPTION>  <OPTION value=10>彰化縣</OPTION> <OPTION 
value=11>南投縣</OPTION> <OPTION value=12>嘉義縣市</OPTION> <OPTION 
value=13>雲林縣</OPTION> <OPTION value=14>臺南市</OPTION> <OPTION 
value=15>臺南縣</OPTION> <OPTION value=16>高雄市</OPTION>  <OPTION value=18>澎湖縣</OPTION> <OPTION 
value=19>屏東縣</OPTION> <OPTION value=20>臺東縣</OPTION> <OPTION 
value=21>花蓮縣</OPTION> <OPTION value=22>金門縣</OPTION> <OPTION 
value=23>連江縣</OPTION> <OPTION value=24>南海諸島</OPTION> <OPTION 
value=25>釣魚台列嶼</OPTION></select> 
<SELECT onchange=document.form.code1.value=this.options[this.options.selectedIndex].value;address_operate1(); size="1" name="address1" class="sel_country1 "> 
<OPTION value="" selected>請選擇區域..</OPTION></SELECT> 
郵遞區號
<input name="code1" size="5" type="text">
		<input tabIndex="34" id="mv017" onKeyPress="keyFunction()" name="mv017" value="<?php echo $mv017; ?>" size="40" type="text"  /></td>	   
	   <td class="normal14z" > 郵遞區號：</td>
        <td class="normal14" ><input tabIndex="35" id="mv018" onKeyPress="keyFunction()" name="mv018" value="<?php echo $mv018; ?>"  type="text"  /></td>
	  </tr>	
	  <tr>
	    <td class="normal14z" > 通信地址：</td>
        <td class="normal14" ><select onchange=Buildkey(this.options[this.options.selectedIndex].value); size="1" name="mew" class="sel_city" > 
 <OPTION value=0 selected>請選擇縣市</OPTION> <OPTION 
value=1>臺北市</OPTION> <OPTION  value=2>基隆市</OPTION> <OPTION 
 value=3>新北市</OPTION> <OPTION  value=4>宜蘭縣</OPTION> <OPTION 
 value=5>新竹縣市</OPTION> <OPTION  value=6>桃園縣</OPTION> <OPTION 
 value=7>苗栗縣</OPTION> <OPTION  value=8>臺中市</OPTION>  
 <OPTION  value=10>彰化縣</OPTION> <OPTION 
 value=11>南投縣</OPTION> <OPTION  value=12>嘉義縣市</OPTION> <OPTION 
 value=13>雲林縣</OPTION> <OPTION  value=14>臺南市</OPTION> <OPTION 
 value=15>臺南縣</OPTION> <OPTION  value=16>高雄市</OPTION> 
 <OPTION   value=18>澎湖縣</OPTION> <OPTION 
 value=19>屏東縣</OPTION> <OPTION  value=20>臺東縣</OPTION> <OPTION 
 value=21>花蓮縣</OPTION> <OPTION  value=22>金門縣</OPTION> <OPTION 
 value=23>連江縣</OPTION> <OPTION  value=24>南海諸島</OPTION> <OPTION 
 value=25>釣魚台列嶼</OPTION></select> 
<SELECT onchange=document.form.code.value=this.options[this.options.selectedIndex].value;address_operate(); size="1" name="address" class="sel_country"> 
<OPTION value="" selected>請選擇區域..</OPTION></SELECT> 
郵遞區號
<input name="code" size="5" type="text">
		<input tabIndex="36" id="mv019" onKeyPress="keyFunction()" name="mv019" value="<?php echo $mv019; ?>" size="40" type="text"  /></td>
	    <td class="normal14z" > 備註：</td>
        <td class="normal14" ><input tabIndex="37" id="mv046" onKeyPress="keyFunction()" name="mv046" value="<?php echo $mv046; ?>" size="40" type="text"  /></td>
	  </tr>
	  
		
	</table>	 
    </div>
	
	<!--  計薪條件資料1 -->
	<div id="tab3" class="tab_content">
	<?php
	  $date=date("Ymd");
	  $mv032=$this->input->post('mv032');
	  $mv033=$this->input->post('mv033');
	  $mv034=$this->input->post('mv034');
	  $mv035=$this->input->post('mv035');
	  $mv036=$this->input->post('mv036');
	  $mv038=$this->input->post('mv038');
	  $mv037=$this->input->post('mv037');	
	  $mv039=$this->input->post('mv039');	
	  $mv040=$this->input->post('mv040');
      $mv042=$this->input->post('mv042');
      $mv043=$this->input->post('mv043');	
      $mv044=$this->input->post('mv044');	  
      $mv045=$this->input->post('mv045');	  
      $mv041=$this->input->post('mv041');	
      $palq40a=$this->input->post('palq40a');
      $palq40adisp=$this->input->post('mv212');	  
      $mv213=$this->input->post('mv213');
	  $mv214=$this->input->post('mv214');
	   $palq41a=$this->input->post('palq41a');
      $palq41adisp=$this->input->post('mv214');	  
	//  $cmsq21a1disp=$this->input->post('mv031');
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="9%" >薪資別：</td>
		<td class="normal14a" width="24%">
		  <select id="mv032" onKeyPress="keyFunction()" name="mv032" " tabIndex="38">
            <option <?php if($mv032 == '1') echo 'selected="selected"';?> value='1'>1.月薪</option>                                                                        
		    <option <?php if($mv032 == '2') echo 'selected="selected"';?> value='2'>2.日薪</option>	
            <option <?php if($mv032 == '3') echo 'selected="selected"';?> value='3'>3.外勞(菲)</option>	
            <option <?php if($mv032 == '4') echo 'selected="selected"';?> value='4'>4.外勞(越)</option>	
            <option <?php if($mv032 == '5') echo 'selected="selected"';?> value='5'>5.外勞(印)</option>				
		  </select></td>   
		<td class="normal14y"  width="10%">底薪：</td>
        <td class="normal14a"  width="24%" >
		  <input tabIndex="39" id="mv033" onKeyPress="keyFunction()"   name="mv033" value="<?php echo $mv033; ?>" type="text" size="10" /></td>
		<td class="normal14y"  width="9%" >轉存方式：</td>
        <td class="normal14a"  width="24%" ><select id="mv034" onKeyPress="keyFunction()" name="mv034" " tabIndex="40">
            <option <?php if($mv034 == 'B') echo 'selected="selected"';?> value='B'>B.銀行</option>                                                                        
		    <option <?php if($mv034 == 'P') echo 'selected="selected"';?> value='P'>P.郵局</option>
            <option <?php if($mv034 == 'C') echo 'selected="selected"';?> value='C'>C.現金</option>			
		  </select></td> 
	  </tr>	
		  
	  <tr>
	    <!--<td class="normal14a"  >行(局)號：</td>
        <td class="normal14" ><input tabIndex="41" id="mv035" onKeyPress="keyFunction()"   name="mv035" value="<?php echo $mv035; ?>" type="text" /></td>-->
	    <td class="normal14z" >帳號：</td>
        <td class="normal14" ><input tabIndex="42" id="mv036" onKeyPress="keyFunction()"   name="mv036" value="<?php echo $mv036; ?>" type="text"  /></td>
		<td class="normal14z" >課稅方式：</td>
        <td class="normal14" ><select id="mv038" onKeyPress="keyFunction()" name="mv038" " tabIndex="43">
            <option <?php if($mv038 == '0') echo 'selected="selected"';?> value='0'>0.不代扣繳</option>                                                                        
		    <option <?php if($mv038 == '1') echo 'selected="selected"';?> value='1'>1.依法扣繳</option>
            <option <?php if($mv038 == '2') echo 'selected="selected"';?> value='2'>2.依固定金額扣繳</option>			
		  </select></td> 
	  </tr>
	  
	   <tr>
	   <td class="normal14z"  >扶養人數：</td>
         <td class="normal14" ><input tabIndex="44" id="mv037" onKeyPress="keyFunction()"   name="mv037" value="<?php echo $mv037; ?>" type="text"  /></td>
	    <td class="normal14z" >固定稅額：</td>
        <td class="normal14" ><input tabIndex="45" id="mv039" onKeyPress="keyFunction()"   name="mv039" value="<?php echo $mv039; ?>" type="text"  /></td>
		<td class="normal14z" >固定稅率：</td>
        <td class="normal14" ><input tabIndex="46" id="mv040" onKeyPress="keyFunction()"   name="mv040" value="<?php echo $mv040; ?>" type="text"  /></td>
	  </tr>
	  <tr>
	   <td class="normal14z"  >計全勤：</td>
         <td class="normal14" ><input type="hidden" name="mv042" class="mv042"  value="N" />
		  <input tabIndex="47" id="mv042" onKeyPress="keyFunction()" name="mv042" <?php if($mv042 == 'Y' ) echo 'checked'; ?>  <?php if($mv042 != 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td>
	    <td class="normal14z" >全勤獎金：</td>
        <td class="normal14" ><input tabIndex="48" id="mv043" onKeyPress="keyFunction()"   name="mv043" value="<?php echo $mv043; ?>" type="text"  /></td>
		<td class="normal14z" >計加班：</td>
        <td class="normal14" ><input type="hidden" name="mv044" class="mv044"  value="N" />
		  <input tabIndex="49" id="mv044" onKeyPress="keyFunction()" name="mv044" <?php if($mv044 == 'Y' ) echo 'checked'; ?>  <?php if($mv044 != 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td>
	  </tr>
	  <tr>
	    <td  class="normal14z" >加班費：</td>
        <td class="normal14" ><input tabIndex="50" id="mv045" onKeyPress="keyFunction()"   name="mv045" value="<?php echo $mv045; ?>" type="text"  /> </td> 
	   <td  class="normal14z" >發薪方式：</td>		
       <td  class="normal14"  ><select id="mv041" onKeyPress="keyFunction()" name="mv041"  tabIndex="51">
            <option <?php if($mv041 == '1') echo 'selected="selected"';?> value='1'>1.每月發一次</option>                                                                        
		    <option <?php if($mv041 == '2') echo 'selected="selected"';?> value='2'>2.每月發二次</option>
		  </select></td>       	
	   <td  class="normal14z" >加班單自動產生：</td>
        <td class="normal14" ><input type="hidden" name="mv209" class="mv209"  value="N" />
		  <input tabIndex="47" id="mv209" onKeyPress="keyFunction()" name="mv209" <?php if($mv209 == 'Y' ) echo 'checked'; ?>  <?php if($mv209 != 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td> 
	  </tr>
	   <tr>
	    <td  class="normal14z" >職稱代號：</td>
        <td class="normal14" ><input type="text" tabIndex="31" onKeyPress="keyFunction()" id="mv212"  name="palq40a"  onchange="startpalq40a(this)"    value="<?php echo  $palq40a; ?>"     /><a href="javascript:;"><img id="Showpalq40a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
	   <span id="palq40adisp" > <?php    echo $palq40adisp; ?> </span></td> 
	   <td  class="normal14z" >年終發薪方式：</td>		
       <td  class="normal14"  ><select id="mv213" onKeyPress="keyFunction()" name="mv213"  tabIndex="51">
            <option <?php if($mv213 == '1') echo 'selected="selected"';?> value='1'>1.考績</option>                                                                        
		    <option <?php if($mv213 == '2') echo 'selected="selected"';?> value='2'>2.效率</option>
		  </select></td>       	
	   <td  class="normal14z" >年終列印類別：</td>
        <td class="normal14" ><input type="text" tabIndex="31" onKeyPress="keyFunction()" id="mv214"  name="palq41a"  onchange="startpalq41a(this)"    value="<?php echo  $palq41a; ?>"     /><a href="javascript:;"><img id="Showpalq41a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
	   <span id="palq41adisp" > <?php    echo $palq41adisp; ?> </span></td>  
	  </tr>
		
	</table>
	</div>	
   
	<!--  其他資料 -->
     <div id="tab4" class="tab_content">
	<?php
	  $date=date("Ymd");
	  $mv048=$this->input->post('mv048');
	  $mv049=$this->input->post('mv049');
	  $mv050=$this->input->post('mv050');
	  $mv051=$this->input->post('mv051');
	  $mv200=$this->input->post('mv200');
	  $mv201=$this->input->post('mv201');
	  $mv202=$this->input->post('mv202');
	  $mv203=$this->input->post('mv203');
	  $mv204=$this->input->post('mv204');
	  $mv205=$this->input->post('mv205');
	  $mv206=$this->input->post('mv206');
	  $mv207=$this->input->post('mv207');
	  $palq20a=$this->input->post('palq20a'); 
	  $palq20adisp=$this->input->post('mv205');
	  $palq21a=$this->input->post('palq21a'); 
	  $palq21adisp=$this->input->post('mv206');
	   $palq22a=$this->input->post('palq22a'); 
	  $palq22adisp=$this->input->post('mv202');
	    if(!isset($userfile)) { $userfile=$this->input->post('userfile'); }
	  //$userfile=$this->input->post('userfile');
	  $imgdisp='';
	  $userfile='image.jpg';
	  $uploadfile='image.jpg';
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
        <td class="normal14y"  width="9%"> 體檢日期：</td>
        <td class="normal14a"  width="24%"><input tabIndex="52" id="mv048" onKeyPress="keyFunction()"  ondblclick="scwShow(this,event);"  onchange="dataymd7(this);check_len(this);" name="mv048" value="<?php echo $mv048; ?>"  type="text"  style="background-color:#E7EFEF"  /></td>		  
	    <td class="normal14y"  width="9%"> 入境日期：</td>
        <td class="normal14a"  width="24%"><input tabIndex="53" id="mv049" onKeyPress="keyFunction()"  ondblclick="scwShow(this,event);"  onchange="dataymd8(this);check_len(this);" name="mv049" value="<?php echo $mv049; ?>"  type="text"  style="background-color:#E7EFEF"  /></td>
	    <td class="normal14y" width="10%" > 到期日期：</td>
        <td class="normal14a" width="24%"><input tabIndex="54" id="mv050" onKeyPress="keyFunction()"  ondblclick="scwShow(this,event);"  onchange="dataymd9(this);check_len(this);" name="mv050" value="<?php echo $mv050; ?>"  type="text"  style="background-color:#E7EFEF"  /></td>
	  </tr>
	  <tr>	  
	    <td class="normal14z"  > 核准文號：</td>
        <td class="normal14a"  ><input tabIndex="55" id="mv051" onKeyPress="keyFunction()"   name="mv051" value="<?php echo $mv051; ?>"  type="text"  /></td>
		<td class="normal14z"  > 個人代扣健保率：</td>
        <td class="normal14a"  ><input tabIndex="56" id="mv200" onKeyPress="keyFunction()"   name="mv200" value="<?php echo $mv200; ?>"  type="text"  /></td>
	    <td class="normal14z"  > 搭伙類別：</td>
          <td  class="normal14"  ><select id="mv201" onKeyPress="keyFunction()" name="mv201"  tabIndex="57">
            <option <?php if($mv201 == '1') echo 'selected="selected"';?> value='1'>1.搭伙</option>                                                                        
		    <option <?php if($mv201 == '2') echo 'selected="selected"';?> value='2'>2.不搭伙</option>
		  </select></td> 
	  </tr>
	   <tr>	  
	    <td class="normal14z"  > 列印類別：</td>
        <td class="normal14a"  ><input type="text" tabIndex="55" onKeyPress="keyFunction()" id="mv202"  name="palq22a"  onchange="startpalq22a(this)"    value="<?php echo  $palq22a; ?>"     /><a href="javascript:;"><img id="Showpalq22a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
	   <span id="palq22adisp" > <?php    echo $palq22adisp; ?> </span></td>
		<td class="normal14z"  > 切傳票部門：</td>
        <td class="normal14a"  ><input type="text" tabIndex="56" onKeyPress="keyFunction()" id="mv205"  name="palq20a"  onchange="startpalq20a(this)"    value="<?php echo  $palq20a; ?>"     /><a href="javascript:;"><img id="Showpalq20a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
	   <span id="palq20adisp" > <?php    echo $palq20adisp; ?> </span></td>
	    <td class="normal14z"  > 切傳票公司別：</td>
        <td class="normal14a"  ><input type="text" tabIndex="57" onKeyPress="keyFunction()" id="mv206"  name="palq21a"  onchange="startpalq21a(this)"    value="<?php echo  $palq21a; ?>"     /><a href="javascript:;"><img id="Showpalq21a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
	   <span id="palq21adisp" > <?php    echo $palq21adisp; ?> </span></td>
	  </tr>
	   <tr>	  
	    <td class="normal14z"  > 固定減項額：</td>
        <td class="normal14a"  ><input tabIndex="58" id="mv203" onKeyPress="keyFunction()"   name="mv203" value="<?php echo $mv203; ?>"  type="text"  /></td>
		<td class="normal14z"  > 固支領現金：</td>
        <td class="normal14a"  ><input tabIndex="59" id="mv204" onKeyPress="keyFunction()"   name="mv204" value="<?php echo $mv204; ?>"  type="text"  /></td>
	    <td class="normal14z">選擇個人圖片.jpg：</td>
        <td class="normal14"><input type="file" name="userfile"  tabIndex="60" id="mv207"  onKeyPress="keyFunction()"  value="<?php echo $userfile; ?>"  size="30" onchange="pre_pic(this);" /></td>
		<td class="normal14"><input type="hidden" name="MAX_FILE_SIZE" value="2000000"></td>
        <td class="normal14"></td>
	  </tr>
		<tr>
	     <td colspan="1" class="normal14z">個人圖片:</td>						
         <td colspan="3" class="normal14"  ><img  src="<?php echo base_url();?>assets/image/jpg/<?php echo $userfile;?>" alt="jpg" style="padding-top:5px"  id="ad" width="60" height="60" border="0" style="padding:5px"/></td>
	 <!--    <td colspan="3" class="normal14"  ><img src="<?php echo base_url();?>assets/image/jpg/<?php echo $uploadfile;?>" style="padding-top:5px"  id="ad" width="60" height="60" border="0" style="padding:5px"/></td> -->
		<td class="normal14"></td>
        <td class="normal14"></td>
	  </tr>
	</table>	 
    </div>
	 <!--  評語i -->
	<div id="tab5" class="tab_content">
	<?php
	  
      $mv211=$this->input->post('mv211');	
	?>
	<table class="form14">     <!-- 表格 -->
	  <tr>	
		<td colspan="1" class="normal14z" width="6%" >評語：</td>
        <td colspan="3"  class="normal14a" width="94%" ><textarea  tabIndex="25" rows="12" cols="40"  name="mv211" id="mv211" Wrap="Physical" ><?php echo $mv211; ?></textarea></td>
        <script>CKEDITOR.replace( 'mv211' );</script>  
	 </tr>	
	</table>
	</div>
	</div>
	 <!--   <div class="buttons">
	    <button  type='submit'  accesskey="s"  name="submit"  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  accesskey="x"  onKeyPress="keyFunction()" id="cancel" name="cancel" href="<?php echo site_url('pal/pali01/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
		<a   accesskey="z" tabIndex="9" target="_blank" id='add_bau' name='add_bau' href="<?php echo site_url('pal/pali27/addform'); ?>" class="button" ><span>員工加保建立Alt+z</span><img src="<?php echo base_url()?>assets/image/png/eye.png" /></a>
	    </div> -->
	  
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    
    </div> <!-- div-5 -->
  </div> <!-- div-4 -->
</div> <!-- div-3 -->

   </div> <!-- div-2 -->
  </div>  <!-- div-1 -->
 </div>  <!-- div-0 -->
    <?php include_once("./application/views/fun/pali01_funjs_v.php"); ?>