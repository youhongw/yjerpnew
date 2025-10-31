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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 進貨單資料建立作業 - 查看</h1>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pur/puri09/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php $i=0; ?>
		<?php $ii=0; ?>
	<?php foreach($result as $row) { ?>
           <?php  $purq04a34=$row->tg001;?> 
		  <?php   $tg002=$row->tg002;?>    
          <?php   $tg003=substr($row->tg003,0,4).'/'.substr($row->tg003,4,2).'/'.substr($row->tg003,6,2);?>
		  <?php   $tg004=$row->tg004;?> 
          <?php   $purq01a=$row->tg005;?>
		  <?php   $tg006=$row->tg006;?>    
		  <?php   $tg007=$row->tg007;?>    
		  <?php   $tg008=$row->tg008;?>
          <?php   $tg009=$row->tg009;?>
	      <?php   $tg010=$row->tg010;?>    
		  <?php   $tg011=$row->tg011;?>
          <?php   $tg012=$row->tg012;?>
		  <?php   $tg013=$row->tg013;?>
		  <?php   $tg014=substr($row->tg014,0,4).'/'.substr($row->tg014,4,2).'/'.substr($row->tg014,6,2);?>
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
	      <?php   $tg026=$row->tg026;?>
		  <?php   $tg027=$row->tg027;?>
		  <?php   $tg028=$row->tg028;?>
		  <?php   $tg029=$row->tg029;?>
		  <?php   $tg030=$row->tg030;?>
		  <?php   $tg031=$row->tg031;?>
		  <?php   $tg032=$row->tg032;?>
		  <?php   $tg033=$row->tg033;?>
		  <?php   $tg034=$row->tg034;?>
		  <?php   $tg035=$row->tg035;?>
		  <?php   $tg036=$row->tg036;?>
		  <?php   $tg037=$row->tg037;?>
		  <?php   $tg038=$row->tg038;?>
		  <?php   $tg039=$row->tg039;?>
		  <?php   $tg040=$row->tg040;?>
		  <?php   $tg041=$row->tg041;?>
		  <?php   $tg042=$row->tg042;?>
		  <?php   $tg043=$row->tg043;?>
		 
		  
		  <?php   $purq01a=$row->tg005;?>
		  <?php   $cmsq06a=$row->tg007;?>   
		 
		  <?php   $cmsq02a=$row->tg004;?>
		  <?php   $cmsq21a1=$row->tg033;?>
		 
		  <?php  $purq04a34disp=$row->tg001disp;?> 
          <?php   $purq01adisp=$row->tg005disp;?>
		  <?php   $cmsq06adisp=$row->tg007disp;?> 
		  <?php   $cmsq02adisp=$row->tg004disp;?>
		  <?php   $cmsq21a1disp=$row->tg033disp;?>
		
		 
	  
		   <?php   $flag=$row->flag;?>	
		
		 <!-- 明細 -->
		    <?php   $th001[]=$row->th001;?>
			<?php  $th002[]=$row->th002;?>
		   <?php   $th003[]=$row->th003;?>
		   <?php   $th004[]=$row->th004;?> 
		   <?php   $th005[]=$row->th005;?>
		   <?php   $th006[]=$row->th006;?>
		   <?php   $th008[]=$row->th008;?>
		   <?php   $th009[]=$row->th009;?>   
		   <?php   $th009disp[]=$row->th009disp;?>
		   <?php   $th014[]=$row->th014;?>  
		   <?php   $th007[]=$row->th007;?>  
		   <?php   $th015[]=$row->th015;?>   
		   <?php   $th017[]=$row->th017;?>   
		   <?php   $th016[]=$row->th016;?> 
		   <?php   $th018[]=$row->th018;?> 
		   <?php   $th045[]=$row->th045;?> 
		   <?php   $th046[]=$row->th046;?> 
		   <?php   $th047[]=$row->th047;?> 
		   <?php   $th048[]=$row->th048;?> 
		   <?php   $th011[]=$row->th011;?>   
		   <?php   $th012[]=$row->th012;?>   
		   <?php   $th013[]=$row->th013;?> 
		   <?php   $th028[]=$row->th028;?> 
		   <?php   $th033[]=$row->th033;?> 
		   
		  <?php   $mb991=' ';?>
		  <?php   $mb992=' ';?>
		  <?php   $mb999=' ';?>
	<?php $ii = $ii + 1 ; }?>
      
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="start14a"  width="10%"><span class="required">進貨單別：</span> </td>
        <td class="normal14a"  width="40%"><input tabIndex="1" id="tg001"    onKeyPress="keyFunction()"  onChange="startpurq04a34(this)"  name="purq04a34" value="<?php echo strtoupper($purq04a34); ?>"  type="text" required  disabled="disabled"/><a href="javascript:;"><img id="Showpurq04a34" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="purq04a34disp"> <?php    echo $purq04a34disp; ?> </span></td>
	    <td class="normal14a" width="10%" >單據日期： </td>
        <td class="normal14a"  width="40%" ><input tabIndex="2"  onclick="scwShow(this,event);"  class="date" id="tg014" onKeyPress="keyFunction()"  onchange="chkno1(this)" name="tg014"  value="<?php echo $tg014; ?>"  size="12" type="text"  disabled="disabled" /></td>
	  </tr>	
	  <tr>
	    <td class="start14a" ><span class="required">進貨單號：</span></td>
        <td class="normal14a" ><input tabIndex="3" id="tg002" onKeyPress="keyFunction()" onfocus="chkno1(this)" name="tg002" value="<?php echo $tg002; ?>" size="30" type="text" required disabled="disabled"/><span id="tg002disp" ></span></td>
		 <td class="normal14a">供應廠商：</td>
        <td  class="normal14"  ><input tabIndex="4" id="tg005" onKeyPress="keyFunction()" onfocus="chkno1(this)" onchange="startpurq01a(this)" name="purq01a" value="<?php echo $purq01a; ?>" size="10" type="text" disabled="disabled" /><img id="Showpurq01a" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
        <span id="purq01adisp"> <?php   echo $purq01adisp; ?> </span></td>
	  </tr>
		
	  <tr>
	     <td class="normal14">進貨日期：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" readonly="value"  onKeyPress="keyFunction()" id="tg003" name="tg003"   value="<?php echo $tg003; ?>"  style="background-color:#EBEBE4" disabled="disabled"/></td>
	   
        <td class="normal14">確認碼：</td>
          <td  class="normal14"  ><select id="tg013" onKeyPress="keyFunction()" name="tg013" onChange="selappr(this)" tabIndex="6" disabled="disabled">
            <option <?php if($tg013 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tg013 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tg013 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td> 
		
	  </tr>
		
	</table>
	
	<div class="abgne_tab"> <!-- div-7 -->
		<ul class="tabs">
			<li><a href="#tab1">交易資料</a></li>
		    <li><a href="#tab2">發票資料</a></li>
		    <li><a href="#tab3">訂金資料</a></li>		
		</ul>

    <div class="tab_container"> <!-- div-8 -->
	
	<!--   基本資料 -->	
	<div id="tab1" class="tab_content">
      <table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14a"  width="10%">廠別：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="7" onKeyPress="keyFunction()" id="tg004"  onchange="startcmsq02a(this)" name="cmsq02a"   value="<?php echo  $cmsq02a; ?>"   disabled="disabled"  /><a href="javascript:;"><img id="Showcmsq02a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	   <span id="cmsq02adisp"> <?php    echo $cmsq02adisp; ?> </span></td>
	   <td class="normal14a"  width="10%" > 件數：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="8" id="tg025"   tabIndex="11"   onKeyPress="keyFunction()"    name="tg025" value="<?php echo $tg025; ?>" disabled="disabled" /></td>
	 </tr>	
		  
	  <tr>
	   <td class="normal14a"  >幣別：</td>
        <td class="normal14" ><input tabIndex="9" id="tg007" onKeyPress="keyFunction()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text"  disabled="disabled" /><a href="javascript:;"><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span></td>
	    <td class="normal14" >匯率：</td>		
        <td class="normal14"  ><input type="text" id="tg008"   tabIndex="10"   onKeyPress="keyFunction()"    name="tg008" value="<?php echo $tg008; ?>" disabled="disabled" /></td>
	  </tr>
	  <tr>
	    <td  class="normal14a" >付款條件：</td>
        <td  class="normal14"  ><input tabIndex="11" id="tg033" onKeyPress="keyFunction()" name="cmsq21a1" onchange="startcmsq21a1(this)"   value="<?php echo  $cmsq21a1; ?>"     type="text" disabled="disabled"  /><a href="javascript:;"><img id="Showcmsq21a1" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="cmsq21a1disp"> <?php    echo $cmsq21a1disp; ?> </span></td>		   
	    <td  class="normal14a">廠商單號：</td>		
        <td  class="start14"  ><input type="text"   tabIndex="12" id="tg006"  onKeyPress="keyFunction()"   name="tg006" value="<?php echo $tg006; ?>" disabled="disabled"  /></td>
	    
	  </tr>
	  <tr>
	    <td class="normal14">備註：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="13"   onKeyPress="keyFunction()" id="tg016" name="tg016"   value="<?php echo $tg016; ?>" disabled="disabled"   /></td>
		<td class="normal14" >列印：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="14"   onKeyPress="keyFunction()" id="tg012" name="tg012"   value="<?php echo $tg012; ?>" disabled="disabled" /></td>
	  </tr>	
		
	  <tr>
	    <td  class="normal14" >簽核狀態：</td>
        <td class="normal14"><select id="tg042" tabIndex="15" readonly="value" onKeyPress="keyFunction()" name="tg042"   style="background-color:#EBEBE4" disabled="disabled">
            <option <?php if($tg042 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tg042 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($tg042 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tg042 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tg042 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tg042 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tg042 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tg042 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
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
	   <td class="normal14a"  width="10%">統一編號：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="16"   onKeyPress="keyFunction()" id="tg022" name="tg022"   value="<?php echo $tg022; ?>"  disabled="disabled" /></td>
	   <td class="normal14a"  width="10%" >發票號碼：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="17"   onKeyPress="keyFunction()" id="tg011" name="tg011"   value="<?php echo $tg011; ?>"  disabled="disabled" /></td>
	 </tr>			  
	 
	  <tr>
	   <td class="normal14a"  >發票聯數：</td>
        <td class="normal14" ><select id="tg009" onKeyPress="keyFunction()" name="tg009"  tabIndex="18" disabled="disabled">
		    <option <?php if($tg009 == '2') echo 'selected="selected"';?> value='2'>2三聯式</option>
            <option <?php if($tg009 == '1') echo 'selected="selected"';?> value='1'>1二聯式</option> 
            <option <?php if($tg009 == '3') echo 'selected="selected"';?> value='3'>3二聯式收銀機發票</option>
		    <option <?php if($tg009 == '4') echo 'selected="selected"';?> value='4'>4三聯式收銀機發票</option>
            <option <?php if($tg009 == '5') echo 'selected="selected"';?> value='5'>5電子計算機發票</option>
            <option <?php if($tg009 == '6') echo 'selected="selected"';?> value='6'>6免用統一發票</option>	
            <option <?php if($tg009 == 'A') echo 'selected="selected"';?> value='A'>A增值稅專用發票</option>	
            <option <?php if($tg009 == 'B') echo 'selected="selected"';?> value='B'>B普通發票</option>	
            <option <?php if($tg009 == 'C') echo 'selected="selected"';?> value='C'>C免用發票</option>				
		  </select></td>
		<td class="normal14a"  >課稅別：</td>
        <td class="normal14" ><select id="tg010" onKeyPress="keyFunction()" name="tg010" onchange="taxa()" tabIndex="19" disabled="disabled">
		    <option <?php if($tg010 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php if($tg010 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php if($tg010 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php if($tg010 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php if($tg010 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select></td>
	  </tr>	
	  <tr>
	    <td class="normal14">發票日期：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="20"   onKeyPress="keyFunction()"  onclick="scwShow(this,event);" id="tg027" name="tg027"   value="<?php echo $tg027; ?>"  disabled="disabled"  /></td>
		<td class="normal14" >扣底區分：</td>						
        <td  class="normal14"  ><select id="tg023" onKeyPress="keyFunction()" name="tg023"  tabIndex="21" disabled="disabled">
		    <option <?php if($tg023 == '1') echo 'selected="selected"';?> value='1'>1可扣掋進貨及費用</option>
            <option <?php if($tg023 == '2') echo 'selected="selected"';?> value='2'>2可扣抵固定資產</option> 
            <option <?php if($tg023 == '3') echo 'selected="selected"';?> value='3'>3不可扣抵進貨及費用</option>
		    <option <?php if($tg023 == '4') echo 'selected="selected"';?> value='4'>4不可扣抵固定資產</option>
		  </select></td>
	  </tr>	
	   <tr>
	    <td  class="normal14" >申報年月：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="22" id="tg029"  onKeyPress="keyFunction()"   name="tg029" value="<?php echo $tg029; ?>" disabled="disabled"  /></td>	   
	    <td  class="normal14">營業稅率：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="23" id="tg030"  onKeyPress="keyFunction()"   name="tg030" value="<?php echo $tg030; ?>"  disabled="disabled" /></td>
	    
	  </tr>
	   <tr>
	    <td  class="normal14a">菸酒註記：</td>						
        <td  class="normal14"  ><input type="hidden" name="tg024" value="N" />
		<input type='checkbox' tabIndex="24" id="tg024" onKeyPress="keyFunction()" name="tg024" <?php if($tg024 == 'Y' ) echo 'checked'; ?>  <?php if($tg024 !== 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled" /></td> 
       
	    <td class="normal14" >隨貨附發票：</td>
        <td class="normal14"><input type="hidden" name="tg043" value="N" />
		<input type='checkbox' tabIndex="25" id="tg043" onKeyPress="keyFunction()" name="tg043" <?php if($tg043 == 'Y' ) echo 'checked'; ?>  <?php if($tg043 !== 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled"  /></td>       
	    
	  </tr>
	
	</table>
 
	</div> 	
	<!--  訂金資料 -->
	<div id="tab3" class="tab_content"> <!-- div-8 -->
	 
	  ?>
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14a"  width="10%">採購單別：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="26"   onKeyPress="keyFunction()" id="tg034" name="tg034"   value="<?php echo $tg034; ?>"  disabled="disabled" /></td>
	   <td class="normal14a"  width="10%" >採購單號：</td>
       <td class="normal14a"  width="40%" ><input type="text" tabIndex="27"   onKeyPress="keyFunction()" id="tg035" name="tg035"   value="<?php echo $tg035; ?>"  disabled="disabled" /></td>
	 </tr>
	   <tr>
	    <td  class="normal14" >沖抵金額：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="28" id="tg038"  onKeyPress="keyFunction()"   name="tg038" value="<?php echo $tg038; ?>"  disabled="disabled" /></td>	   
	    <td  class="normal14">沖抵稅額：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="29" id="tg039"  onKeyPress="keyFunction()"   name="tg039" value="<?php echo $tg039; ?>"  disabled="disabled" /></td>
	  </tr>
	  <tr>
	    <td  class="normal14" >預付待抵單別：</td>
        <td  class="normal14"  ><input type="text"   tabIndex="30" id="tg036"  onKeyPress="keyFunction()"   name="tg036" value="<?php echo $tg036; ?>" disabled="disabled"  /></td>	   
	    <td  class="normal14">預付待抵單號：</td>		
        <td  class="normal14"  ><input type="text"   tabIndex="31" id="tg037"  onKeyPress="keyFunction()"   name="tg037" value="<?php echo $tg037; ?>" disabled="disabled"  /></td>
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
			  <td width="6%" class="left">交貨庫別</td>
		 	  <td width="6%" class="left">庫別名稱</td> 
			  <td width="6%" class="left">驗收日期</td>
              <td width="6%" class="center">進貨數量</td>
              <td width="6%" class="right">驗收數量</td>
              <td width="6%" class="right">驗退數量</td>
			  <td width="6%" class="center">計價數量</td>
              <td width="6%" class="right">單位進價</td>
              <td width="6%" class="right">原幣進貨金額</td>
			  <td width="6%" class="center">原幣稅額</td>
              <td width="6%" class="right">本幣進貨金額</td>
			  <td width="6%" class="center">本幣稅額</td>
              <td width="6%" class="right">採購單別</td>
			  <td width="6%" class="right">採購單號</td>
			  <td width="6%" class="right">採購序號</td>
			  <td width="6%" class="right">檢驗狀態</td>
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
	     <td class="left"><input type="text"  <?php echo 'id='.'th004'.$i ?>   name="order_product[<?php echo $i ?>][th004]" value="<?php echo $th004[$i]; ?>" size="20"  disabled="disabled" /></td>
	     <td class="left"><input  type="text"  onKeyPress="keyFunction()"  id="th005"  name="order_product[<?php echo $i ?>][th005]" value="<?php echo $th005[$i]; ?>"  style="background-color:#EBEBE4" disabled="disabled"/></td>
	     <td class="left"><input type="text"  onKeyPress="keyFunction()"  id="th006"   name="order_product[<?php echo $i ?>][th006]" value="<?php echo $th006[$i]; ?>"  size="30" style="background-color:#EBEBE4" disabled="disabled"/></td>
	     <td class="left"><input  type="text"  onKeyPress="keyFunction()"    id="th008"   name="order_product[<?php echo $i ?>][th008]" value="<?php echo $th008[$i]; ?>" size="6" style="background-color:#EBEBE4" disabled="disabled" /></td>
	     <td class="left"><input type="text"   readonly="value"   name="order_product[$i][th003]" value="<?php echo $th003[$i]; ?>" size="6" style="background-color:#EBEBE4" disabled="disabled"/></td>
		 <td class="left"><input type="text"   <?php echo 'id='.'th009'.$i ?>   name="order_product[<?php echo $i ?>][th009]" value="<?php echo $th009[$i]; ?>" size="10"  disabled="disabled" /></td>
		<td class="left"><input  type="text"  onKeyPress="keyFunction()"  id="th009disp"  name="order_product[<?php echo $i ?>][th009disp]" value="<?php echo $th009disp[$i]; ?>"  style="background-color:#EBEBE4" disabled="disabled" /></td>
		<td class="left"><input type="text"   onclick="scwShow(this,event);"  id="th014[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th014]" value="<?php echo  substr($th014[$i],0,4).'/'.substr($th014[$i],4,2).'/'.substr($th014[$i],6,2); ?>" size="10"  class="date"  /></td>
	     <td class="center"><input type="text"  class="total_qty" id="th007" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th007]" value="<?php echo $th007[$i]; ?>" size="10" style="text-align:right;" disabled="disabled" /></td>
		 <td class="center"><input type="text"  id="th015" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th015]" value="<?php echo $th015[$i]; ?>" size="10" style="text-align:right;" disabled="disabled" /></td>
		 <td class="center"><input type="text"  id="th017" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th017]" value="<?php echo $th017[$i]; ?>" size="10" style="text-align:right;" disabled="disabled" /></td>
		 <td class="center"><input type="text"  id="th016" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th016]" value="<?php echo $th016[$i]; ?>" size="10" style="text-align:right;" disabled="disabled"  /></td>
         <td class="center"><input type="text"   id="th018" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th018]" value="<?php echo $th018[$i]; ?>" size="10" style="text-align:right;"  disabled="disabled" /></td>	
         <td class="right"><input readonly="value" type="text" class="total_price" name="order_product[<?php echo $i ?>][th045]" value="<?php echo $th045[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" disabled="disabled" /></td>
		 <td class="right"><input readonly="value" type="text"  name="order_product[<?php echo $i ?>][th046]" value="<?php echo $th046[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" disabled="disabled" /></td>
		 <td class="right"><input readonly="value" type="text" class="total_price1" name="order_product[<?php echo $i ?>][th047]" value="<?php echo $th047[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" disabled="disabled" /></td>
		 <td class="right"><input readonly="value" type="text"  name="order_product[<?php echo $i ?>][th048]" value="<?php echo $th048[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" disabled="disabled" /></td>
	     <td class="left"><input type="text" id="th011"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th011]" value="<?php echo $th011[$i]; ?>" size="10" disabled="disabled" /></td>
		 <td class="left"><input type="text" id="th012"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th012]" value="<?php echo $th012[$i]; ?>" size="10" disabled="disabled" /></td>
		 <td class="left"><input type="text" id="th013"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th013]" value="<?php echo $th013[$i]; ?>" size="10" disabled="disabled" /></td>
		 <td class="left"><input type="text" id="th028"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th028]" value="<?php echo $th028[$i]; ?>" size="10" disabled="disabled" /></td>
		 <td class="left"><input type="text" id="th033"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][th033]" value="<?php echo $th033[$i]; ?>" size="20" disabled="disabled" /></td>
	     </tr>	    
        </tbody>
        <?php $i++; $mproduct_row = (int) $product_row + 1; $product_row=(string)$mproduct_row;?>
 
 <?php } ?>		 
    <!-- javascrit 0 -->
	 
	<?php include("./application/views/fun/puri09_funjsupdjs_v.php"); ?> 
		
                  <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
              <tr>
                <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
				<td class="left" colspan="22"></td>
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
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣未稅額：</b></td>
				<td ><input type='text' readonly="value" name='tg028' id="tg028" size="8" value="<?php echo $tg028; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='tg019' id="tg019" size="8" value="<?php echo $tg019; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣合計：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot"><?php echo $tg028+$tg019; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣未稅額：</b></td>
				<td ><input type='text' readonly="value" name='tg031' id="tg031" size="8" value="<?php echo $tg031; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='tg032' id="tg032" size="8" value="<?php echo $tg032; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣合計：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot1"><?php echo $tg031+$tg032; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　合計數量：</b></td>
				<td ><input type='text' readonly="value" name='tg026' id="tg026" size="8" value="<?php echo $tg026; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	
	<div class="buttons">
	<!-- <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span></button>&nbsp;&nbsp;&nbsp;&nbsp;  -->
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pur/puri09/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	</div> 
	  
      </form>
     </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  <!--  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>  -->
  </div> <!-- div-3 -->
 </div> <!-- div-2 -->
</div> <!-- div-1 -->
