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

<div id="content">  <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 品號基本資料建立作業 - 修改</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	 <?php   $uploadfile='';?>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/inv/invi02/updsave/<?php echo $uploadfile;?>" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $mb001=$row->mb001;?>
          <?php   $mb002=$row->mb002;?>
          <?php   $mb003=$row->mb003;?>
          <?php   $mb004=$row->mb004;?>
          <?php   $invq01a=$row->mb005;?>    <!--品號分類- 會計 -->
          <?php   $invq01a2=$row->mb006;?>    <!--品號分類- 會計 -->
		  <?php   $invq01a3=$row->mb007;?>    <!--品號分類- 產品 -->
		  <?php   $invq01a4=$row->mb008;?>    <!--品號分類- 類別 --> 
		  <?php   $mb009=$row->mb009;?>
		  <?php   $bomq07a=$row->mb010;?>    <!--品號分類- 途程品號 -->
		  <?php   $mb011=$row->mb011;?>
          <?php   $mb012=$row->mb012;?>
          <?php   $mb013=$row->mb013;?>
          <?php   $mb014=$row->mb014;?>
          <?php   $mb015=$row->mb015;?>
          <?php   $mb016=$row->mb016;?>
		  <?php   $cmsq03a=$row->mb017;?>     <!--品號分類- 生管 -->
		   <?php   $cmsi03=$row->mb017;?>     <!--品號分類- 生管 -->
		  <?php   $cmsq09a2=$row->mb018;?>    <!--品號分類- 計劃人員 -->
		  <?php   $mb019=$row->mb019;?>
		  <?php   $mb020=$row->mb020;?>		
		  <?php   $mb021=$row->mb021;?>
          <?php   $mb022=$row->mb022;?>
          <?php   $mb023=$row->mb023;?>
          <?php   $mb024=$row->mb024;?>
          <?php   $mb025=$row->mb025;?>
          <?php   $mb026=$row->mb026;?>
		  <?php   $mb027=$row->mb027;?>
		  <?php   $mb028=$row->mb028;?>
		  <?php   $mb029=$row->mb029;?>
		  <?php   $mb030=$row->mb030;?>
		  <?php   $mb031=$row->mb031;?>
          <?php   $purq01a=$row->mb032;?>  <!--品號分類- 供應商 -->
          <?php   $mb033=$row->mb033;?>
          <?php   $mb034=$row->mb034;?>
          <?php   $mb035=$row->mb035;?>
          <?php   $mb036=$row->mb036;?>
		  <?php   $mb037=$row->mb037;?>
		  <?php   $mb038=$row->mb038;?>
		  <?php   $mb039=$row->mb039;?>
		  <?php   $mb040=$row->mb040;?>
		  <?php   $mb041=$row->mb041;?>
          <?php   $mb042=$row->mb042;?>
          <?php   $mb043=$row->mb043;?>
          <?php   $mb044=$row->mb044;?>
          <?php   $mb045=$row->mb045;?>
          <?php   $mb046=$row->mb046;?>
		  <?php   $mb047=$row->mb047;?>
		  <?php   $mb048=$row->mb048;?>
		  <?php   $mb049=$row->mb049;?>
		  <?php   $mb050=$row->mb050;?>
		  <?php   $mb051=$row->mb051;?>
          <?php   $mb052=$row->mb052;?>
          <?php   $mb053=$row->mb053;?>
          <?php   $mb054=$row->mb054;?>
          <?php   $mb055=$row->mb055;?>
          <?php   $mb056=$row->mb056;?>
		  <?php   $mb057=$row->mb057;?>
		  <?php   $mb058=$row->mb058;?>
		  <?php   $mb059=$row->mb059;?>
		  <?php   $mb060=$row->mb060;?>
		  <?php   $mb061=$row->mb061;?>
          <?php   $mb062=$row->mb062;?>
          <?php   $mb063=$row->mb063;?>
          <?php   $mb064=$row->mb064;?>
          <?php   $mb065=$row->mb065;?>
          <?php   $mb066=$row->mb066;?>
		  <?php   $cmsq09a4=$row->mb067;?>  <!--品號分類- 採購人員 -->
		  <?php   $cmsq04a=$row->mb068;?>  <!--品號分類- 生產線別 -->
		  <?php   $mb069=$row->mb069;?>
		  <?php   $mb070=$row->mb070;?>
		  <?php   $mb071=$row->mb071;?>
          <?php   $mb072=$row->mb072;?>
          <?php   $mb073=$row->mb073;?>
          <?php   $mb074=$row->mb074;?>
          <?php   $mb075=$row->mb075;?>
          <?php   $mb076=$row->mb076;?>
		  <?php   $mb077=$row->mb077;?>
		  <?php   $mb078=$row->mb078;?>
		  <?php   $mb079=$row->mb079;?>
		  <?php   $mb080=$row->mb080;?>
		  <?php   $mb081=$row->mb081;?>
          <?php   $mb082=$row->mb082;?>
          <?php   $mb083=$row->mb083;?>
          <?php   $mb084=$row->mb084;?>
          <?php   $mb085=$row->mb085;?>
          <?php   $mb086=$row->mb086;?>
		  <?php   $mb087=$row->mb087;?>
		  <?php   $mb088=$row->mb088;?>
		  <?php   $mb089=$row->mb089;?>
		  <?php   $mb090=$row->mb090;?>
		  <?php   $mb091=$row->mb091;?>
          <?php   $mb092=$row->mb092;?>
          <?php   $mb093=$row->mb093;?>
          <?php   $mb094=$row->mb094;?>
          <?php   $mb095=$row->mb095;?>
          <?php   $mb096=$row->mb096;?>
		  <?php   $mb200=$row->mb200;?>
		  <?php   $uploadfile=$row->mb200;?>
		  <?php   $userfile=$row->mb200;?>
		 <?php $_FILES['userfile']['name']=$row->mb200;?>
		 <?php   $mb201=$row->mb201;?>
		 <?php   $mb202=$row->mb202;?>
		  <?php   $invq01adisp=$row->mb005disp;?>
		  <?php   $invq01a2disp=$row->mb006disp;?>
		  <?php   $invq01a3disp=$row->mb007disp;?>
		  <?php   $invq01a4disp=$row->mb008disp;?>
		  <?php   $cmsq03adisp=$row->mb017disp;?>
		  <?php   $cmsq04adisp=$row->mb068disp;?>
		  <?php   $cmsq09a2disp=$row->mb018disp;?>
		  <?php   $bomq07adisp=$row->mb010disp;?>
		  <?php   $cmsq09a4disp=$row->mb067disp;?>   <!--品號分類- 採購人員名稱 -->
		  <?php   $purq01adisp=$row->mb032disp;?>    <!--品號分類- 主供應商名稱 -->
		  <?php   $mb991=' ';?>
		  <?php   $mb992=' ';?>
		  <?php   $mb999=' ';?>
		  <?php   $flag=$row->flag;?>
       	  
	<?php  }?>
	
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="8%"><span class="required">品號：</span> </td>
        <td class="normal14a"  width="18%"><input tabIndex="1" id="mb001"   readonly="value"   onKeyPress="keyFunction()" onchange="startCheck5(this)"  name="mb001" value="<?php echo $mb001; ?>" size="20" type="text" readonly="readonly" />
		 <span id="mb001disp" ></span></td>
	    <td class="normal14a" width="7%" >單位： </td>
        <td class="normal14a"  width="12%" ><input tabIndex="2" id="mb004" onKeyPress="keyFunction()" name="mb004"   value="<?php echo  $mb004; ?>"    size="4" type="text" required /><a href="javascript:;"><img id="Showinvi81a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a></td>
	    <td class="normal14a"  width="8%">庫存數量：</td>
        <td class="normal14a"  width="10%" ><input  id="mb064" readonly="value" onKeyPress="keyFunction()" name="mb064"   value="<?php echo  $mb064; ?>"    size="8" type="text"  style="background-color:#F5F5F5"  /></td>
		<td class="normal14a" width="8%">庫存金額：</td>
        <td class="normal14a" width="10%" ><input  id="mb065" readonly="value" onKeyPress="keyFunction()" name="mb065"   value="<?php echo  $mb065; ?>"    size="8" type="text" style="background-color:#F5F5F5" /></td>	
        <td class="normal14a" width="8%">單位成本：</td>						
        <td  class="normal14a"  width="11%"  ><input  id="mb999" readonly="value" onKeyPress="keyFunction()" name="mb999"   value="<?php echo $mb999; ?>"  size="8"  type="text" style="background-color:#F5F5F5"  /></td>	 
	  </tr>	
		  
	  <tr>
	    <td class="normal14" >品名： </td>
        <td class="normal14" ><input tabIndex="3" id="mb002" onKeyPress="keyFunction()" onchange="checkspace2(this)" name="mb002" value="<?php echo $mb002; ?>" size="30" type="text" required /><span id="mb002disp" ></span></td>
		<td  class="normal14" >條碼編號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="mb013" onKeyPress="keyFunction()" name="mb013"  value="<?php echo $mb013; ?>"  size="20" type="text"   /></td>
		<td class="normal14" >包裝單位：</td>						
        <td  class="normal14"  ><input  id="mb090" readonly="value" onKeyPress="keyFunction()" name="mb090"   value="<?php echo $mb090; ?>"  size="4"  type="text" style="background-color:#F5F5F5"  /></td>
	    <td class="normal14"  >包裝數量：</td>
        <td class="normal14" ><input  onKeyPress="keyFunction()" readonly="value" id="mb089" name="mb089"  value="<?php echo $mb089; ?>" size="8" type="text" style="background-color:#F5F5F5"  /></td>	
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	  <tr>
	    <td  class="normal14" >規格：</td>
        <td  class="normal14"  ><input tabIndex="5" id="mb003" onKeyPress="keyFunction()" name="mb003"  value="<?php echo $mb003; ?>"  size="30" type="text"   /></td>
	    <td class="normal14" >小單位：</td>
        <td class="normal14"  ><input tabIndex="6" readonly="value" id="mb072" onKeyPress="keyFunction()" name="mb072"   value="<?php echo  $mb072; ?>"    size="4" type="text" style="background-color:#F5F5F5"  /></td>
		<td class="normal14">定重：</td>						
        <td  class="normal14"  ><input id="mb091" readonly="value" onKeyPress="keyFunction()" name="mb091"   value="<?php echo $mb091; ?>"  size="1" type="text"   style="background-color:#F5F5F5"  /></td>
        <td class="normal14">ZIZE：</td>						
        <td  class="normal14"  ><input tabIndex="8" id="mb081" onKeyPress="keyFunction()" name="mb081"   value="<?php echo $mb081; ?>"  size="4" type="text"   /></td>			
		<td class="normal14">顏色</td>
        <td class="normal14"><input type="text" tabIndex="13" id="mb201" onKeyPress="keyFunction()" name="mb201"   value="<?php echo $mb201; ?>"  size="8"  /></td>	
	  </tr>
		<tr>
	    <td  class="normal14" >使用門市：</td>
        <td rowspan="4"  colspan="8" class="normal14"  ><input type="text" tabIndex="10" id="mb202" onKeyPress="keyFunction()" name="mb202"  value="<?php echo $mb202; ?>"  size="100"   /><span > <?php echo '輸入範例:不同門市代號用逗號,隔開'; ?> </span></td>
		<td  class="normal14" ></td>
        <td rowspan="4"  colspan="1" class="normal14"  ></td>
	  </tr>
	</table>
	
	<div class="abgne_tab"> <!-- div-7 -->
		<ul class="tabs">
			<li><a href="#tab1"  accesskey="a" >基本資料a</a></li>
			<li><a href="#tab2"  accesskey="b">基本資料b</a></li>
			<li><a href="#tab3"  accesskey="c">採購生管c</a></li>
			<li><a href="#tab4"  accesskey="g">售價Alt+g</a></li>
			<li><a href="#tab5"  accesskey="h">成本Alt+h</a></li>
			<li><a href="#tab6"  accesskey="i">標準包裝i</a></li>
		</ul>
    <div class="tab_container"> <!-- div-8 -->
	
	<!-- 基本資料1 -->	
	<div id="tab1" class="tab_content">
    <table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a" width="9%" >會計：</td>
        <td class="normal14a"  width="15%" ><input type="text" tabIndex="9" id="mb005" onKeyPress="keyFunction()"   onchange="startinvq01a(this)" name="invq01a"   value="<?php echo  trim($invq01a); ?>"    size="6"  required /><a href="javascript:;"><img id="Showinvq01a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="invq01adisp"> <?php  echo $invq01adisp; ?> </span></td>	
		<td class="normal14a"  width="9%">商品：</td>
        <td class="normal14a"  width="16%" ><input type="text" tabIndex="10" id="mb006" onKeyPress="keyFunction()"   onchange="startinvq01a2(this)" name="invq01a2"   value="<?php echo  $invq01a2; ?>"    size="6"  /><a href="javascript:;"><img id="Showinvq01a2" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
	     <span id="invq01a2disp"><?php  echo $invq01a2disp; ?> </span></td>
		<td class="normal14a"  width="9%" > 類別：</td>
        <td class="normal14a"  width="16%" ><input tabIndex="11" id="mb007" onKeyPress="keyFunction()"  onchange="startinvq01a3(this)" name="invq01a3" value="<?php echo $invq01a3; ?>" size="6" type="text"  /><a href="javascript:;"><img id="Showinvq01a3" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="invq01a3disp"><?php   echo $invq01a3disp; ?> </span></td>	
		<td class="normal14a"  width="9%">改品規：</td>	
        <td class="normal14a"  width="17%"><input type="hidden" name="mb066" value="N" />
		<input tabIndex="12" type="checkbox"  id="mb066" onKeyPress="keyFunction()"   name="mb066" <?php if($mb066 == 'Y' ) echo 'checked'; ?>  <?php if($mb066 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14a" >生管：</td>
        <td class="normal14"  ><input tabIndex="13" id="mb008" onKeyPress="keyFunction()" name="invq01a4"   onchange="startinvq01a4(this)"  value="<?php echo  $invq01a4; ?>"    size="6" type="text"  /><a href="javascript:;"><img id="Showinvq01a4" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="invq01a4disp"> <?php  echo  $invq01a4disp; ?> </span></td>	
		<td class="normal14a" >主要庫別：</td>             <!--   onchange="check_cmsi03(this)"   onchange="startcmsq03a(this)"        -->
		 <td class="normal14"  ><input  type="text"  tabIndex="14" id="cmsi03" class="cmsi03" onKeyPress="keyFunction()" name="cmsi03"   onfocus="click_cmsi03()" value="<?php echo  $cmsi03; ?>"     size="10"    />
		 <a href="javascript:;"><img id="Showcmsi03disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
         <span id="cmsi03disp"></span></td> 
	<!--	 <input tabIndex="7" id="tc004" name="tc004" value="" size="12" onfocus="" onchange="check_tc004(this)" onKeyPress="keyFunction()" type="text" />
				<a href="javascript:;"><img id="Showtc004disp" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
				<span id="tc004disp"></span>
       <td class="normal14"  ><input tabIndex="14" id="mb017" onKeyPress="keyFunction()" name="cmsq03a" onchange="startcmsq03a(this)"   value="<?php echo  $cmsq03a; ?>"    size="10" type="text"  required /><img id="Showcmsq03a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
         <span id="cmsq03adisp"> <?php    echo $cmsq03adisp; ?> </span></td>  -->		    
		<td  class="normal14a" >生產線別：</td>
        <td  class="normal14"  ><input tabIndex="15" id="mb068" onKeyPress="keyFunction()" name="cmsq04a" onchange="startcmsq04a(this)"  value="<?php echo $cmsq04a; ?>"  size="10" type="text"   /><img id="Showcmsq04a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
         <span id="cmsq04adisp"> <?php   echo $cmsq04adisp; ?> </span></td>		   
	    <td  class="normal14a">計劃人員：</td>		
        <td  class="normal14"  ><input tabIndex="16" id="mb018" onKeyPress="keyFunction()" name="cmsq09a2" onchange="startcmsq09a2(this)" value="<?php echo $cmsq09a2; ?>"  size="10" type="text"   /><img id="Showcmsq09a2" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>		
	     <span id="cmsq09a2disp"> <?php   echo $cmsq09a2disp; ?> </span></td>	
	  </tr>
		
	   <tr>
	     <td  class="normal14">文管代號：</td>						
         <td  class="normal14"  ><input tabIndex="24" id="mb012" onKeyPress="keyFunction()" name="mb012"   value="<?php echo $mb012; ?>"  size="10"  type="text"  /></td>
	    <td colspan="1" class="normal14" >商品描述：</td>
        <td colspan="3"  class="normal14"><textarea  tabIndex="25" rows="6" cols="40" name="mb009" id="mb009" Wrap="Physical" ></textarea>
		 <!--     <script>              
                CKEDITOR.replace( 'mb009' );
            </script>  -->
</td>	
		<td class="normal14">選擇產品圖片.jpg：</td>
        <td class="normal14"><input type="file" name="userfile"  tabIndex="26" id="mb200"  onKeyPress="keyFunction()"  value="<?php echo $userfile; ?>"  size="30" onchange="pre_pic(this);"		/></td>
		<td class="normal14"><input type="hidden" name="MAX_FILE_SIZE" value="2000000"></td>
        <td class="normal14"></td>
	  </tr>

	   <tr>
	     <td colspan="1" class="normal14">產品圖片:</td>						
         <td colspan="3" class="normal14"  ><img src="<?php echo base_url();?>assets/image/jpg/<?php echo $uploadfile;?>" style="padding-top:5px"  id="ad" width="60" height="60" border="0" style="padding:5px"/></td>
	   
		<td class="normal14"></td>
        <td class="normal14"></td>
	  </tr>
		
	</table>
	</div>
	
	<!--  基本資料2 -->
	<div id="tab2" class="tab_content">
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"   width="10%"> 貨號：</td>
        <td class="normal14a"  width="16%"><input tabIndex="26" id="mb080" onKeyPress="keyFunction()" name="mb080" value="<?php echo $mb080; ?>" size="20" type="text"  /></td>
	    <td class="normal14a" width="8%" >品號屬性：</td>
        <td class="normal14a"  width="23%" >
			<select id="mb025" onKeyPress="keyFunction()" name="mb025" " tabIndex="27" >
               <option <?php if($mb025 == 'P') echo 'selected="selected"';?> value='P'>採購件</option>                                                                        
		       <option <?php if($mb025 == 'M') echo 'selected="selected"';?> value='M'>自製件</option>
               <option <?php if($mb025 == 'S') echo 'selected="selected"';?> value='S'>託外加工件</option>
               <option <?php if($mb025 == 'Y') echo 'selected="selected"';?> value='Y'>虛設品號</option>
		    </select>
		</td>
	    <td class="normal14a"  width="8%">庫存管理：</td>
        <td class="normal14a"  width="13%" ><input type="hidden" name="mb0196" value="N" />
		<input tabIndex="28" id="mb019" onKeyPress="keyFunction()" name="mb019" <?php if($mb019 == 'Y' ) echo 'checked'; ?>  <?php if($mb019 !== 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td>		
		<td class="normal14a" width="8%">保稅品：</td>
        <td class="normal14a" width="14%" ><input type="hidden" name="mb020" value="N" />
		<input tabIndex="29" id="mb020" onKeyPress="keyFunction()" name="mb020" <?php if($mb020 == 'Y' ) echo 'checked'; ?>  <?php if($mb020 !== 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14" > 循環盤點碼：</td>
        <td class="normal14" ><input tabIndex="30" id="mb021" onKeyPress="keyFunction()" name="mb021" value="<?php echo $mb021; ?>" size="4" type="text"  /></td>
		<td class="normal14a">批號管理：</td>						
        <td  class="normal14a"  >
		    <select id="mb022" onKeyPress="keyFunction()" name="mb022" " tabIndex="31">
                 <option <?php if($mb022 == 'N') echo 'selected="selected"';?> value='N'>不需要</option>                                                                        
		         <option <?php if($mb022 == 'Y') echo 'selected="selected"';?> value='Y'>需要不檢查庫存量</option>
                 <option <?php if($mb022 == 'W') echo 'selected="selected"';?> value='W'>僅需警告</option>
                 <option <?php if($mb022 == 'T') echo 'selected="selected"';?> value='T'>需要且檢查庫存量</option>
		    </select>
		</td>
		<td  class="normal14" >ABC等級：</td>
        <td  class="normal14"  ><input tabIndex="32" id="mb027" onKeyPress="keyFunction()" name="mb027"  value="<?php echo strtoupper($mb027); ?>"  size="1" type="text"   /></td>
	    <td class="normal14" >備註：</td>
        <td class="normal14" ><input tabIndex="33"  id="mb028" onKeyPress="keyFunction()"  name="mb028"  value="<?php echo $mb028; ?>" type="text" /></td>
	  </tr>
		
	  <tr>
	    <td class="normal14">有效天數</td>
        <td class="normal14"><input tabIndex="34" id="mb023"  onKeyPress="keyFunction()"  name="mb023"  value="<?php echo $mb023; ?>"  type="text"  /></td>	
	    <td class="normal14" > 複檢天數：</td>
        <td class="normal14" ><input tabIndex="35" id="mb024" onKeyPress="keyFunction()" name="mb024" value="<?php echo $mb024; ?>" size="4" type="text"  /></td>
	    <td  class="normal14" >產品圖號：</td>
        <td  class="normal14"  ><input tabIndex="36" id="mb029" onKeyPress="keyFunction()" name="mb029"  value="<?php echo $mb029; ?>"  size="20" type="text"   /></td>
		<td class="normal14">進價管制：</td>
		<td class="normal14" width="6%" ><input type="hidden" name="mb083" value="N" />
		<input tabIndex="37" id="mb083" onKeyPress="keyFunction()" name="mb083" <?php if($mb083 == 'Y' ) echo 'checked'; ?>  <?php if($mb083 !== 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14" >單價上限率：</td>
        <td class="normal14" ><input tabIndex="38"  id="mb084" onKeyPress="keyFunction()"  name="mb084"  value="<?php echo $mb084; ?>" size="9" type="text" /></td>	
		<td class="normal14">生效日期</td>
        <td class="normal14"><input tabIndex="39" id="mb030" readonly="value"  onKeyPress="keyFunction()"  name="mb030"  value="<?php echo $mb030; ?>" size="8" type="text"  style="background-color:#E7EFEF"  /></td>
	    <td class="normal14" >失效日期：</td>
        <td class="normal14" ><input tabIndex="40" id="mb031" readonly="value" onKeyPress="keyFunction()" name="mb031" value="<?php echo $mb031; ?>" size="8" type="text"   style="background-color:#E7EFEF"  /></td>
	    <td  class="normal14" >售價管制：</td>
        <td class="normal14" width="6%" ><input type="hidden" name="mb085" value="N" />
		<input tabIndex="41" id="mb085" onKeyPress="keyFunction()" name="mb085" <?php if($mb085 == 'Y' ) echo 'checked'; ?>  <?php if($mb085 !== 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14">單價下限率：</td>						
        <td class="normal14" ><input tabIndex="42"  id="mb086" onKeyPress="keyFunction()"  name="mb086"  value="<?php echo $mb086; ?>" size="9" type="text" /></td>	
	    <td class="normal14a" >途程品號</td>
        <td class="normal14" ><input tabIndex="43"  id="mb010" onKeyPress="keyFunction()"  name="bomq07a" onchange="startbomq07a(this)"  value="<?php echo $bomq07a; ?>"  size="20" type="text" /><img id="Showbomq07a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
	    <span id="bomq07adisp"> <?php   echo $bomq07adisp; ?> </span></td>
		<td class="normal14">超交管理</td>
        <td class="normal14" width="6%" ><input type="hidden" name="mb044" value="N" />
		<input tabIndex="44" id="mb044" onKeyPress="keyFunction()" name="mb044" <?php if($mb044 == 'Y' ) echo 'checked'; ?>  <?php if($mb044 !== 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td>
		<td class="normal14" >超交率：</td>
        <td class="normal14" ><input tabIndex="45" id="mb045" onKeyPress="keyFunction()" name="mb045" value="<?php echo $mb045; ?>" size="9" type="text"  /></td>
	  </tr>
	    
	  <tr>
	    <td class="normal14a" >途程代號</td>
        <td class="normal14" ><input tabIndex="46"  id="mb011" onKeyPress="keyFunction()"  name="bomq07adisp"  value="<?php echo $bomq07adisp; ?>"  size="4" type="text" /></td>	
		<td class="normal14a" >低階碼：</td>						
        <td  class="normal14a"    ><input tabIndex="47" id="mb026" onKeyPress="keyFunction()" name="mb026"   value="<?php echo $mb026; ?>"  size="2"  type="text"  /></td>	 
	    <td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	</table>
	</div>

	<!--  採購生管 3 -->
     <div id="tab3" class="tab_content">
	
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="12%"> 採購人員：</td>
        <td class="normal14a"  width="14%"><input tabIndex="48" id="mb067" onKeyPress="keyFunction()" onchange="startcmsq09a4(this)" name="cmsq09a4" value="<?php echo $cmsq09a4; ?>" size="10" type="text"  /><img id="Showcmsq09a4" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
	    <span id="cmsq09a4disp"> <?php   echo $cmsq09a4disp; ?> </span></td>
		<td class="normal14a" width="12%" >最低補量：</td>
		<td class="normal14a"  width="14%"><input tabIndex="49" id="mb039" onKeyPress="keyFunction()" name="mb039" value="<?php echo $mb039; ?>" size="15" type="text"  /></td>
        <td class="normal14a"  width="8%">領料碼：</td>
		<td class="normal14a"  width="15%" >
			<select id="mb042" onKeyPress="keyFunction()" name="mb042" " tabIndex="50">
               <option <?php if($mb042 == '1') echo 'selected="selected"';?> value='1'>逐批領料</option>                                                                        
		       <option <?php if($mb042 == '2') echo 'selected="selected"';?> value='2'>自動扣料</option>
               <option <?php if($mb042 == '3') echo 'selected="selected"';?> value='3'>單獨領料</option>
		    </select>
		</td>
		<td class="normal14a" width="10%">主供應商：</td>
        <td class="normal14a" width="15%" ><input tabIndex="51" id="mb032" onKeyPress="keyFunction()" onchange="startpurq01a(this)" name="purq01a" value="<?php echo $purq01a; ?>" size="10" type="text"  /><img id="Showpurq01a" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
        <span id="purq01adisp"> <?php   echo $purq01adisp; ?> </span></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14" > 補貨倍量：</td>
        <td class="normal14" ><input tabIndex="52" id="mb040" onKeyPress="keyFunction()" name="mb040" value="<?php echo $mb040; ?>" size="15" type="text"  /></td>
		<td class="normal14">補貨政策：</td>						
        <td  class="normal14a"  >
		    <select id="mb034" onKeyPress="keyFunction()" name="mb034" " tabIndex="53">
                 <option <?php if($mb034 == 'R') echo 'selected="selected"';?> value='R'>依補貨點</option>                                                                        
		         <option <?php if($mb022 == 'M') echo 'selected="selected"';?> value='M'>依MRP需求</option>
                 <option <?php if($mb022 == 'L') echo 'selected="selected"';?> value='L'>依LRP需求</option>
                 <option <?php if($mb022 == 'N') echo 'selected="selected"';?> value='N'>不需</option>
				  <option <?php if($mb022 == 'H') echo 'selected="selected"';?> value='H'>依歷史銷售</option>
		    </select>
		</td>
		<td  class="normal14" >超收管理：</td>
        <td class="normal14"  ><input type="hidden" name="mb044" value="N" />
	    <input tabIndex="54" id="mb044" onKeyPress="keyFunction()" name="mb044" <?php if($mb044 == 'Y' ) echo 'checked'; ?>  <?php if($mb044 !== 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td>
	    <td class="normal14" >超收率：</td>
        <td class="normal14" ><input tabIndex="55"  id="mb045" onKeyPress="keyFunction()"  name="mb045"  value="<?php echo $mb045; ?>" size="9" type="text" /></td>
	  </tr>
		
	  <tr>
	    <td class="normal14">領用倍量</td>
        <td class="normal14"><input tabIndex="56" id="mb040"  onKeyPress="keyFunction()"  name="mb040"  value="<?php echo $mb040; ?>"  type="text"  /></td>	
	    <td class="normal14" > 固定前置天數：</td>
        <td class="normal14" ><input tabIndex="57" id="mb036" onKeyPress="keyFunction()" name="mb036" value="<?php echo $mb036; ?>" size="3" type="text"  /></td>
	    <td  class="normal14" >品管類別：</td>
        <td  class="normal14"  ><input tabIndex="58" id="mb077" onKeyPress="keyFunction()" name="mb077"  value="<?php echo $mb077; ?>"  size="6" type="text"   /></td>
		<td class="normal14">變動前置天數：</td>
		<td class="normal14" ><input tabIndex="59" id="mb037" onKeyPress="keyFunction()" name="mb037" value="<?php echo $mb037; ?>" size="3" type="text"  /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14" >批量：</td>
        <td class="normal14" ><input tabIndex="60"  id="mb038" onKeyPress="keyFunction()"  name="mb038"  value="<?php echo $mb038; ?>" size="15" type="text" /></td>	
		<td class="normal14">檢驗方式</td>
		<td  class="normal14a"  >
		    <select id="mb043" onKeyPress="keyFunction()" name="mb043" " tabIndex="61">
                 <option <?php if($mb043 == '0') echo 'selected="selected"';?> value='0'>免檢</option>                                                                        
		         <option <?php if($mb043 == '1') echo 'selected="selected"';?> value='1'>抽檢(減量)</option>
                 <option <?php if($mb043 == '2') echo 'selected="selected"';?> value='2'>抽檢(正常)</option>
                 <option <?php if($mb043 == '3') echo 'selected="selected"';?> value='3'>抽檢(加嚴)</option>
				  <option <?php if($mb043 == '4') echo 'selected="selected"';?> value='4'>全檢</option>
		    </select>
		</td>
	    <td class="normal14" >檢驗天數：</td>
        <td class="normal14" ><input tabIndex="62" id="mb076" onKeyPress="keyFunction()" name="mb076" value="<?php echo $mb076; ?>" size="3" type="text"   /></td>
	    <td  class="normal14" >序號管理：</td>
        <td class="normal14" width="6%" ><input type="hidden" name="mb092" value="N" />
		<input tabIndex="63" id="mb092" onKeyPress="keyFunction()" name="mb092" <?php if($mb092 == 'Y' ) echo 'checked'; ?>  <?php if($mb085 !== 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td>
	  </tr>
	    
	  <tr>
	    <td class="normal14" >MRP生產交貨提前天數</td>
        <td class="normal14" ><input tabIndex="64"  id="mb078" onKeyPress="keyFunction()"  name="mb078"  value="<?php echo $mb078; ?>"  size="3" type="text" /></td>	
		<td class="normal14a" >MRP採購交貨提前天數</td>						
        <td  class="normal14a"    ><input tabIndex="65" id="mb079" onKeyPress="keyFunction()" name="mb079"   value="<?php echo $mb079; ?>"  size="3"  type="text"  /></td>	 
	    <td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	</table>	 
    </div>
	
	<!--  售價 4-->
	 <div id="tab4" class="tab_content">
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="12%"> 標準進價：</td>
        <td class="normal14a"  width="14%"><input tabIndex="66" id="mb046" onKeyPress="keyFunction()" name="mb046" value="<?php echo $mb046; ?>" size="18" type="text"  /></td>
	    <td class="normal14a" width="12%" >關稅率：</td>
		<td class="normal14a"  width="14%"><input tabIndex="67" id="mb082" onKeyPress="keyFunction()" name="mb082" value="<?php echo $mb082; ?>" size="12" type="text"  /></td>
        <td class="normal14a"  width="10%">標準售價：</td>
		<td class="normal14a" width="16%" ><input tabIndex="68" id="mb047" onKeyPress="keyFunction()" name="mb047" value="<?php echo $mb047; ?>" size="18" type="text"  /></td>
		<td class="normal14a" width="12%">最近進價幣別：</td>
        <td class="normal14a" width="12%" ><input tabIndex="69" id="mb048" onKeyPress="keyFunction()" name="mb048" value="<?php echo $mb048; ?>" size="4" type="text"  /></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14" > 最近進價原幣：</td>
        <td class="normal14" ><input tabIndex="70" id="mb049" onKeyPress="keyFunction()" name="mb049" value="<?php echo $mb049; ?>" size="18" type="text"  /></td>
		<td class="normal14">最近進價本幣：</td>
        <td class="normal14" ><input tabIndex="71" id="mb050" onKeyPress="keyFunction()" name="mb050" value="<?php echo $mb050; ?>" size="18" type="text"  /></td>
		<td  class="normal14" >零售價含稅：</td>
        <td class="normal14"  ><input type="hidden" name="mb052" value="N" />
	    <input tabIndex="72" id="mb052" onKeyPress="keyFunction()" name="mb052" <?php if($mb052 == 'Y' ) echo 'checked'; ?>  <?php if($mb052 !== 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td>
	    <td class="normal14" >零售價：</td>
        <td class="normal14" ><input tabIndex="73"  id="mb051" onKeyPress="keyFunction()"  name="mb051"  value="<?php echo $mb051; ?>" size="18" type="text" /></td>
	  </tr>
		
	  <tr>
	    <td class="normal14">售價一</td>
        <td class="normal14"><input tabIndex="74" id="mb053"  onKeyPress="keyFunction()"  name="mb053"  value="<?php echo $mb053; ?>"  type="text"  /></td>	
	    <td class="normal14" > 售價二：</td>
        <td class="normal14" ><input tabIndex="75" id="mb054" onKeyPress="keyFunction()" name="mb054" value="<?php echo $mb054; ?>"  type="text"  /></td>
	    <td  class="normal14" >售價三：</td>
        <td  class="normal14"  ><input tabIndex="76" id="mb055" onKeyPress="keyFunction()" name="mb055"  value="<?php echo $mb055; ?>"  type="text"   /></td>
		<td class="normal14">售價四：</td>
		<td class="normal14" ><input tabIndex="77" id="mb056" onKeyPress="keyFunction()" name="mb056" value="<?php echo $mb056; ?>"  type="text"  /></td>
	  </tr>
	    
	  <tr>
	    <td class="normal14" >售價五:</td>
        <td class="normal14" ><input tabIndex="78"  id="mb069" onKeyPress="keyFunction()"  name="mb069"  value="<?php echo $mb069; ?>"   type="text" /></td>	
		<td class="normal14" >售價六:</td>						
        <td  class="normal14"    ><input tabIndex="79" id="mb070" onKeyPress="keyFunction()" name="mb070"   value="<?php echo $mb070; ?>"   type="text"  /></td>	 
	    <td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	</table>		 
    </div>
	
	 <!--  成本 5-->
	<div id="tab5" class="tab_content">
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="15%"> 單位標準材料成本：</td>
        <td class="normal14a"  width="18%"><input tabIndex="80" id="mb057" onKeyPress="keyFunction()" name="mb057" value="<?php echo $mb057; ?>" size="18" type="text"  /></td>
	    <td class="normal14a" width="15%" >單位標準人工成本：</td>
		<td class="normal14a"  width="18%"><input tabIndex="81" id="mb058" onKeyPress="keyFunction()" name="mb058" value="<?php echo $mb058; ?>" size="12" type="text"  /></td>
        <td class="normal14a"  width="15%">單位標準製造費用：</td>
		<td class="normal14a" width="19%" ><input tabIndex="82" id="mb059" onKeyPress="keyFunction()" name="mb059" value="<?php echo $mb059; ?>" size="18" type="text"  /></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14" > 單位標準加工費用：</td>
        <td class="normal14" ><input tabIndex="83" id="mb060" onKeyPress="keyFunction()" name="mb060" value="<?php echo $mb060; ?>" size="18" type="text"  /></td>
		<td class="normal14" > 標準成本合計：</td>
        <td class="normal14" ><input tabIndex="84" id="mb991"readonly="value"  onKeyPress="keyFunction()" name="mb991" value="<?php echo $mb057+$mb058+$mb059+$mb060; ?>" size="18" type="text" style="background-color:#F5F5F5"  /></td>
		<td  class="normal14" >本階人工：</td>
        <td class="normal14" ><input tabIndex="85" id="mb061" onKeyPress="keyFunction()" name="mb061" value="<?php echo $mb061; ?>" size="18" type="text"  /></td>
	  </tr>
		
	  <tr>
	    <td class="normal14">本階製費</td>
        <td class="normal14"><input tabIndex="86" id="mb062"  onKeyPress="keyFunction()"  name="mb062"  value="<?php echo $mb062; ?>"  type="text"  /></td>	
	    <td class="normal14" > 本階加工：</td>
        <td class="normal14" ><input tabIndex="87" id="mb063" onKeyPress="keyFunction()" name="mb063" value="<?php echo $mb063; ?>"  type="text"  /></td>
	    <td  class="normal14"  >本階成本合計：</td>
        <td  class="normal14"  ><input tabIndex="88" id="mb992" readonly="value"  onKeyPress="keyFunction()" name="mb992"  value="<?php echo $mb061+$mb062+$mb063; ?>"  type="text"  style="background-color:#F5F5F5"  /></td>
	  </tr>
	    
	  <tr>
	    <td class="normal14" >工時底數:</td>
        <td class="normal14" ><input tabIndex="89"  id="mb096" onKeyPress="keyFunction()"  name="mb096"  value="<?php echo $mb096; ?>"   type="text" /></td>
	    <td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	</table>	 
    </div>
	
	<!--  標準包裝 6-->
	 <div id="tab6" class="tab_content">
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="10%"> 外包裝單位：</td>
        <td class="normal14a"  width="23%"><input tabIndex="90" id="mb090" onKeyPress="keyFunction()" name="mb090" value="<?php echo $mb090; ?>" size="4" type="text"  /></td>
	    <td class="normal14a" width="13%" >外包裝含商品數：</td>
		<td class="normal14a"  width="20%"><input tabIndex="91" id="mb073" onKeyPress="keyFunction()" name="mb073" value="<?php echo $mb073; ?>" size="12" type="text"  /></td>
        <td class="normal14a"  width="13%">單位淨重：</td>
		<td class="normal14a" width="21%" ><input tabIndex="92" id="mb014" onKeyPress="keyFunction()" name="mb014" value="<?php echo $mb014; ?>" size="18" type="text"  /></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14" > 外包裝長：</td>
        <td class="normal14" ><input tabIndex="93" id="mb093" onKeyPress="keyFunction()" name="mb093" value="<?php echo $mb093; ?>" size="8" type="text"  /></td>
		<td class="normal14">外包裝寬：</td>
        <td class="normal14" ><input tabIndex="94" id="mb094" onKeyPress="keyFunction()" name="mb094" value="<?php echo $mb094; ?>" size="8" type="text"  /></td>
		<td  class="normal14" >外包裝高：</td>
        <td class="normal14" ><input tabIndex="95" id="mb095" onKeyPress="keyFunction()" name="mb095" value="<?php echo $mb095; ?>" size="8" type="text"  /></td>
	  </tr>
		
	  <tr>
	    <td class="normal14">重量單位</td>
        <td class="normal14"><input tabIndex="96" id="mb015"  onKeyPress="keyFunction()"  name="mb015"  value="<?php echo $mb015; ?>"  type="text"  /></td>	
	    <td class="normal14" > 外包裝淨重N.W.：</td>
        <td class="normal14" ><input tabIndex="97" id="mb074" onKeyPress="keyFunction()" name="mb074" value="<?php echo $mb074; ?>"  type="text"  /></td>
	    <td  class="normal14" >外包裝毛重G.W.：</td>
        <td  class="normal14"  ><input tabIndex="98" id="mb075" onKeyPress="keyFunction()" name="mb075"  value="<?php echo $mb075; ?>"  type="text"   /></td>
	  </tr>
	    
	  <tr>
	    <td class="normal14" >外包裝材積:</td>
        <td class="normal14" ><input tabIndex="99"  id="mb071" onKeyPress="keyFunction()"  name="mb071"  value="<?php echo $mb071; ?>"   type="text" /></td>
	    <td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	</table>		 
    </div>
		
		<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  
        </form>
    </div> <!-- div-5 -->
  </div> <!-- div-4 -->
        <div class="buttons">
	    <button  type='submit'  accesskey="s"  name="submit"  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a accesskey="x" onKeyPress="keyFunction()" id="cancel" name="cancel" href="<?php echo site_url('inv/invi02/'.$this->session->userdata('invi02_search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
         <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('inv/invi02/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('inv/invi02/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>	  
	  </div>
</div> <!-- div-3 -->
    <?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-2 -->
  </div> <!-- div-1 -->
</div> <!-- div-0 -->

 <?php // include("./application/views/fun/invi02_funjs_v.php"); ?>
 <?php  include_once("./application/views/funnew/inv_funmjs_v.php"); ?>