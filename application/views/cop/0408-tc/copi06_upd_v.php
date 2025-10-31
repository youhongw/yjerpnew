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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 客戶訂單資料建立作業 - 修改</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cop/copi06/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php $ii=0; ?>
	<?php foreach($result as $row) { ?>	 
          <?php   $copq03a22=$row->tc001;?>
		  <?php   $copq03a22disp=$row->tc001disp;?>
          <?php   $tc002=$row->tc002;?>
          <?php   $tc003=substr($row->tc003,0,4).'/'.substr($row->tc003,4,2).'/'.substr($row->tc003,6,2);?>
          <?php   $copq01a=$row->tc004;?>
		  <?php   $copq01adisp=$row->tc004disp;?>
		  <?php   $tc025=$row->tc025;?>
	      <?php   $tc049=$row->tc049;?>
		  <?php   $tc039=$row->tc039;?>
		  <?php   $tc040=$row->tc040;?>
		  <?php   $tc050=$row->tc050;?>
	      <?php   $tc027=$row->tc027;?>
		  <?php   $tc006=$row->tc006;?>
	      <?php   $cmsq05a=$row->tc005;?>
		  <?php   $cmsq05adisp=$row->tc005disp;?>
		  <?php   $cmsq09a3=$row->tc006;?>
		  <?php   $cmsq09a3disp=$row->tc006disp;?>
		   <?php   $cmsq02a=$row->tc007;?>
		  <?php   $cmsq02adisp=$row->tc007disp;?>
		  <?php   $cmsq06a=$row->tc008;?>
		   <?php   $cmsq06adisp=$row->tc008disp;?>
		  <?php   $tc009=$row->tc009;?>
		  <?php   $tc010=$row->tc010;?>
	      <?php   $tc011=$row->tc011;?>
	      <?php   $tc012=$row->tc012;?>
		  <?php   $tc013=$row->tc013;?>
		  <?php   $cmsq21a2=$row->tc014;?>
		   <?php   $cmsq21a2disp=$row->tc014disp;?>
		   <?php   $tc015=$row->tc015;?>
          <?php   $tc045=$row->tc045;?>
          <?php   $tc041=$row->tc041;?>
          <?php   $tc012=$row->tc012;?>
		  <?php   $tc016=$row->tc016;?>
		  <?php   $tc017=$row->tc017;?>
		  <?php   $tc028=$row->tc028;?>
		
		  <?php   $tc029=$row->tc029;?>
		  <?php   $tc030=$row->tc030;?>		  
		  <?php   $tc031=$row->tc031;?>
		  <?php   $tc043=$row->tc043;?>
		  <?php   $tc044=$row->tc044;?>
		  <?php   $tc048=$row->tc048;?>
		  <?php   $tc039=substr($row->tc039,0,4).'/'.substr($row->tc039,4,2).'/'.substr($row->tc039,6,2);?>
		  
	      <?php   $sysma200=$this->session->userdata('sysma200'); ?>
		  <?php   $sysma201=$this->session->userdata('sysma201'); ?>
		   <?php   $flag=$row->flag;?>	
		
		 <!-- 明細 -->
		   <?php   $td001[]=$row->td001;?>
		   <?php   $td002[]=$row->td002;?>
		   <?php   $td003[]=$row->td003;?>
		   <?php   $td004[]=$row->td004;?>
		   <?php   $td005[]=$row->td005;?>
		   <?php   $td006[]=$row->td006;?>
		   <?php   $td007[]=$row->td007;?>
		   <?php   $td007disp[]=$row->td007disp;?>
		   <?php   $td008[]=round($row->td008,0);?>
		   <?php   $td009[]=$row->td009;?>
		   <?php   $td010[]=$row->td010;?>
		   <?php   $td011[]=round($row->td011,2);?>
		   <?php   $td012[]=round($row->td012,0);?>
		    <?php //  $td013[]=$row->td013;?>
		   <?php if ($row->td013>'')  {$td013[]=substr($row->td013,0,4).'/'.substr($row->td013,4,2).'/'.substr($row->td013,6,2);} else {$td013[]='';} ?>
	                
		   <?php   $td014[]=$row->td014;?>
		   <?php   $td016[]=$row->td016;?>
		   <?php   $td020[]=$row->td020;?>
		   <?php   $td030[]=$row->td030;?>
		   <?php   $td031[]=$row->td031;?>
		  <?php   $mb991=' ';?>
		  <?php   $mb992=' ';?>
		  <?php   $mb999=' ';?>
	<?php $ii = $ii + 1 ; }?>
	<?php 
	  if(!isset($sysma200)) { $sysma200=$this->session->userdata('sysma200'); }
	  if(!isset($sysma201)) { $sysma201=$this->session->userdata('sysma201'); }  ?>
	<table class="form14"  >     <!-- 頭部表格 -->
	 <tr>
	    <td class="start14a"  width="9%"><span class="required">客戶訂單別：</span> </td>
        <td class="normal14a"  width="25%"><input tabIndex="1" id="tc001"    onKeyPress="keyFunction()" readonly="value" onfocus="selappr()" name="copq03a22" onchange="startcopq03a22(this)"  value="<?php echo strtoupper($copq03a22); ?>"  type="text" required /><a href="javascript:;"><img id="Showcopq03a22" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="copq03a22disp"> <?php    echo $copq03a22disp; ?> </span></td>
	    <td class="normal14a" width="8%" >單據日期： </td>
        <td class="normal14a"  width="25%" ><input tabIndex="2"  onclick="scwShow(this,event);" onfocus="selappr()"  id="tc039" onKeyPress="keyFunction()"  onchange="chkno1(this)" name="tc039"  value="<?php echo $tc039; ?>"  size="12" type="text" style="background-color:#E7EFEF"  /></td>
	     <td class="start14a" width="8%"><span class="required">訂單單號：</span></td>
        <td class="normal14a" width="25%"><input tabIndex="3" id="tc002" onKeyPress="keyFunction()" readonly="value" name="tc002" value="<?php echo $tc002; ?>" size="30" type="text" required /><span id="tc002disp" ></span></td>
	  </tr>	
	  <tr>	    
		 <td class="normal14a">客戶代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="tc004" onKeyPress="keyFunction()"  onchange="startcopq01a(this)" name="copq01a" value="<?php echo $copq01a; ?>" size="10" type="text"  /><img id="Showcopq01a" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
        <span id="copq01adisp"> <?php   echo $copq01adisp; ?> </span></td>
	    <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" readonly="value"  onKeyPress="keyFunction()" id="tc040" name="tc040"   value="<?php echo $tc040; ?>" style="background-color:#EBEBE4"  /></td>
		 <td class="normal14">訂單日期：</td>
        <td  class="normal14"  ><input type="text" tabIndex="6" readonly="value"  onKeyPress="keyFunction()" id="tc003" name="tc003"   value="<?php echo $tc003; ?>"  style="background-color:#EBEBE4" style="background-color:#E7EFEF"/></td>
	  </tr>
	   <tr>
	   <td class="normal14">流程代號：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" readonly="value"  onKeyPress="keyFunction()" id="tc049" name="tc049"   value="<?php echo $tc049; ?>" style="background-color:#EBEBE4"  /></td>
        <td class="normal14">拋轉狀態：</td>
        <td  class="normal14"  ><select id="tc050" tabIndex="8" readonly="value" onKeyPress="keyFunction()" name="tc050"   style="background-color:#EBEBE4" >
            <option <?php if($tc050 == 'N') echo 'selected="selected"';?> value='N'>N.未拋轉</option>                                                                        
		    <option <?php if($tc050 == 'Y') echo 'selected="selected"';?> value='Y'>Y.拋轉成功(來源廠商)</option>
            <option <?php if($tc050 == 'y') echo 'selected="selected"';?> value='y'>y.拋轉成功(下游廠商)</option>
		    <option <?php if($tc050 == 'n') echo 'selected="selected"';?> value='n'>n.訂單變更</option>
            <option <?php if($tc050 == 'U') echo 'selected="selected"';?> value='U'>U.拋轉失敗</option>	
            <option <?php if($tc050 == 'u') echo 'selected="selected"';?> value='u'>u.還原失敗</option>	
		  </select></td>
           <td class="normal14">確認碼：</td>
          <td  class="normal14"  ><select id="tc027" onKeyPress="keyFunction()" name="tc027" onChange="selappr(this)" tabIndex="9">
            <option <?php if($tc027 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tc027 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tc027 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>  		
	<!--	<tr>
		 <td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" /></td>
         <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" /></td>
		 
	  </tr>  -->
		
	</table>
	
	<div class="abgne_tab"> <!-- div-7 -->
		<ul class="tabs">
			<li><a href="#tab1"  accesskey="a">交易資料a</a></li>
		<li><a href="#tab2"  accesskey="b">地址b</a></li>			
		</ul>

    <div class="tab_container"> <!-- div-8 -->
	
	<!--   交易資料 -->	
	<div id="tab1" class="tab_content">
      <table class="form14">     <!-- 表格 -->
	  <tr>
	   <td class="normal14a"  width="8%">部門代號：</td>
       <td class="normal14a"  width="24%" ><input type="text" tabIndex="10" onKeyPress="keyFunction()" id="tc005"  name="cmsq05a"  onchange="startcmsq05a(this)"    value="<?php echo  $cmsq05a; ?>"     /><a href="javascript:;"><img id="Showcmsq05a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
	   <span id="cmsq05adisp" > <?php    echo $cmsq05adisp; ?> </span></td>
	   <td class="normal14a"  width="8%">業務人員：</td>
        <td class="normal14a"  width="26%" ><input tabIndex="6" id="tc006" onKeyPress="keyFunction()" name="cmsq09a3" onchange="startcmsq09a3(this)"  value="<?php echo $cmsq09a3; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq09a3" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
        <span id="cmsq09a3disp"> <?php    echo $cmsq09a3disp; ?> </span></td>
	   <td class="normal14a"  width="8%">廠別：</td>
       <td class="normal14a"  width="26%" ><input type="text" tabIndex="10" onKeyPress="keyFunction()" id="tc007"  onchange="startcmsq02a(this)" name="cmsq02a"   value="<?php echo  $cmsq02a; ?>"     /><a href="javascript:;"><img id="Showcmsq02a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	   <span id="cmsq02adisp"> <?php    echo $cmsq02adisp; ?> </span></td>
	 </tr>	
	  
	  <tr>
	  <td class="normal14a"  >幣別：</td>
        <td class="normal14" ><input tabIndex="11" id="tc008" onKeyPress="keyFunction()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span></td>
	   <td class="normal14" >匯率：</td>		
        <td class="normal14"  ><input type="text" id="tc009"   tabIndex="12"   onKeyPress="keyFunction()"    name="tc009" value="<?php echo $tc009; ?>"  /></td>
	    <td class="normal14" >客戶單號：</td>		
        <td class="normal14"  ><input type="text" id="tc012"   tabIndex="13"   onKeyPress="keyFunction()"    name="tc012" value="<?php echo $tc012; ?>"  /></td>
	  </tr>
	    <tr>
		<td class="normal14" >價格條件：</td>		
        <td class="normal14"  ><input type="text" id="tc013"   tabIndex="14"   onKeyPress="keyFunction()"    name="tc013" value="<?php echo $tc013; ?>"  /></td>
	   <td  class="normal14a" >付款條件：</td>
        <td  class="normal14"  ><input tabIndex="15" id="tc014" onKeyPress="keyFunction()" name="cmsq21a2" onchange="startcmsq21a2(this)"   value="<?php echo  $cmsq21a2; ?>"     type="text"  /><a href="javascript:;"><img id="Showcmsq21a2" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="cmsq21a2disp"> <?php    echo $cmsq21a2disp; ?> </span></td>
	    <td class="normal14" >營業稅率：</td>		
        <td class="normal14"  ><input type="text" id="tc041"   tabIndex="16"   onKeyPress="keyFunction()"    name="tc041" value="<?php echo $tc041; ?>"  /></td>
	  </tr>
	  
	   <tr>
	    <td class="normal14" >訂金比率：</td>		
        <td class="normal14"  ><input type="text" id="tc045"   tabIndex="17"   onKeyPress="keyFunction()"    name="tc045" value="<?php echo $tc045; ?>"  /></td>
	   <td class="normal14"  >課稅別：</td>
        <td class="normal14" ><select id="tc016" onKeyPress="keyFunction()" name="tc016" onChange="seltax(this)" tabIndex="18">
		    <option <?php if($tc016 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php if($tc016 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php if($tc016 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php if($tc016 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php if($tc016 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select></td>
	    <td class="normal14" >列印：</td>
        <td class="normal14"  ><input type="text"  readonly="value" tabIndex="19"   onKeyPress="keyFunction()"   name="tc028" value="<?php echo $tc028; ?>" style="background-color:#EBEBE4"  /></td>
	  </tr>
		
	  <tr>
	     <td class="normal14">簽核狀態：</td>
        <td  class="normal14"  ><select id="tc048" tabIndex="21" readonly="value" onKeyPress="keyFunction()" name="tc048"   style="background-color:#EBEBE4" >
            <option <?php if($tc048 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tc048 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($tc048 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tc048 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tc048 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tc048 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tc048 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tc048 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>		   
	    <td  class="start14a"></td>		
        <td  class="start14"  ></td>
		 <td  class="start14a"></td>		
        <td  class="start14"  ></td>
	  </tr>
	</table>
	</div>
	
	<!--  地址 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	  <?php
	  
	  ?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	   <td class="normal14a"  width="10%">送貨地址(1)：</td>
       <td class="normal14a"  width="70%" ><input type="text" tabIndex="22"   onKeyPress="keyFunction()" id="tc010" name="tc010" size="120"  value="<?php echo $tc010; ?>"   />
	   <td class="normal14a"  width="10%" ></td>
       <td class="normal14a"  width="10%" ></td>
	 </tr>			  
	 
	  <tr>
	    <td class="normal14">送貨地址(2)：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="23"   onKeyPress="keyFunction()" id="tc011" name="tc011"  size="120"   value="<?php echo $tc011; ?>"    /></td>
		<td class="normal14" ></td>						
        <td  class="normal14"  ></td>
	  </tr>	
	   <tr>
	    <td class="normal14">備註：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="24"   onKeyPress="keyFunction()" id="tc015" name="tc015"  size="120"   value="<?php echo $tc015; ?>"    /></td>
		 <td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" /></td>
         <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" /></td>
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
		      <td width="11%" colspan="2" class="left">品號</td>
              <td width="15%" class="left">品名</td>
			  <td width="15%" class="left">規格</td>  
			  <td width="6%" class="center">單位</td>
			  <td width="6%" class="center">序號</td>
			  <td width="6%" class="left">交貨庫別</td>
		 	  <td width="6%" class="left">庫別名稱</td> 
			  <td width="6%" class="left">預交日期</td>
              <td width="6%" class="center">訂單數量</td>
              <td width="6%" class="right">訂單單價</td>
              <td width="6%" class="right">訂單金額</td>
			  <td width="6%" class="center">己交數量</td>
			  <td width="6%" class="center">毛重</td>
			  <td width="6%" class="center">材積</td>
			  <td width="6%" class="center">客戶品號</td>
			  <td width="14%" class="center">備註</td>
			  <td width="6%" class="center">結案碼</td>
            </tr>
        </thead>
      
    <!--   明細0  --> 
		<?php $i=0; $mproduct_row=0; $product_row='0'; ?>  
		<input id="row_count" name="row_count" value="0" style="display:none;" />
		<?php while ($i<$ii) { ?>
		<tbody  <?php echo 'id='.'product-row'.$product_row ?> >		
	     <tr>
	<!--     <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td> --> 
        <td class="center"><img src="<?php echo base_url()?>assets/image/delete2.png" title="刪除資料" onclick="del_detail('<?php echo $copq03a22;?>','<?php echo $tc002; ?>','<?php echo $td003[$i]; ?>');" /></td>  	    
		<input type="hidden"  name="order_product[<?php echo $i ?>][td001]" value="<?php echo $td001[$i]; ?>" />
	     <input type="hidden" name="order_product[<?php echo $i ?>][td002]" value="<?php echo $td002[$i]; ?>" />
	     <td class="left"><input type="text" onchange="startinvq02a(this,<?php echo $i+1 ?>)" <?php echo 'id='.'td004'.$i ?>  ondblclick="copi02a(this,<?php echo $i ?>);"  name="order_product[<?php echo $i ?>][td004]" value="<?php echo $td004[$i]; ?>" size="20" style="background-color:#E7EFEF"  /></td>
	      <td class="left" ><input width="5px" type="button" value="..." style="float:left;" onclick="invq02a(this,<?php echo $i ?>);" /></td>
		 <td class="left"><input  type="text"  onKeyPress="keyFunction()"  id="td005"  name="order_product[<?php echo $i ?>][td005]" value="<?php echo $td005[$i]; ?>"  style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text"  onKeyPress="keyFunction()"  id="td006"   name="order_product[<?php echo $i ?>][td006]" value="<?php echo $td006[$i]; ?>"  size="30" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input  type="text"  onKeyPress="keyFunction()"    id="td010"   name="order_product[<?php echo $i ?>][td010]" value="<?php echo $td010[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text"   readonly="value"   name="order_product[$i][td003]" value="<?php echo $td003[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
		 <td class="left"><input type="text" onchange="startcmsq03a(this,<?php echo $i+1 ?>)"  <?php echo 'id='.'td007'.$i ?> ondblclick="cmsq03a(this,<?php echo $i ?>)"  name="order_product[<?php echo $i ?>][td007]" value="<?php echo $td007[$i]; ?>" size="10"  style="background-color:#E7EFEF" /></td>
		<td class="left"><input  type="text"  onKeyPress="keyFunction()"  id="td007disp" ondblclick="cmsq03a(this,<?php echo $i ?>)" name="order_product[<?php echo $i ?>][td007disp]" value="<?php echo $td007disp[$i]; ?>"  style="background-color:#EBEBE4" /></td>
		<td class="left"><input type="text"   onfocus="scwShow(this,event);" onclick="scwShow(this,event);"  id="td013[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][td013]" value="<?php echo $td013[$i]; ?>" size="10"  class="date" style="background-color:#E7EFEF" /></td>
	     <td class="center"><input type="text" onchange="startcopq02a(this,product_row)"  class="total_qty" id="td008" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][td008]" value="<?php echo $td008[$i]; ?>" size="10" style="text-align:right;" /></td>
		 <td class="center"><input type="text"  id="td011" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][td011]" value="<?php echo $td011[$i]; ?>" size="10" style="text-align:right;" /></td>
         <td class="center"><input type="text"   class="total_price" id="td012" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][td012]" value="<?php echo $td012[$i]; ?>" style="text-align:right;"  /></td>
          <td class="center"><input type="text" readonly="value"  id="td009" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][td009]" value="<?php echo $td009[$i]; ?>" size="10" style="text-align:right;" /></td>
          <td class="center"><input type="text" class="total_qty1"  id="td030" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][td030]" value="<?php echo $td030[$i]; ?>" size="10" style="text-align:right;" /></td>
          <td class="center"><input type="text" class="total_qty2"  id="td031" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][td031]" value="<?php echo $td031[$i]; ?>" size="10" style="text-align:right;" /></td>		  
         <td class="right"><input type="text" name="order_product[<?php echo $i ?>][td014]" value="<?php echo $td014[$i]; ?>" size="10" style="text-align:right;" /></td>
	     <td class="left"><input type="text" id="td020"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][td020]" value="<?php echo $td020[$i]; ?>" size="20"  /></td>
		  <td class="left"><select id="td016"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][td016]" ><option <?php if($td016[$i] == 'N') echo 'selected="selected"'; ?> value='N'>N.未結案</option><option <?php if($td016[$i] == 'y') echo 'selected="selected"'; ?> value="y">y.指定結案</option><option <?php if($td016[$i] == 'Y') echo 'selected="selected"'; ?> value="Y">Y.自動結案</option></select></td>
	     </tr>
        </tbody>
		<script>
		function del_detail(del_md001,del_md002,del_md003){
			if(confirm('是否刪除此筆資料，單別:'+del_md001+'單號:'+del_md002+'序號:'+del_md003))
			{
				$('#del_md001').val(del_md001);
				$('#del_md002').val(del_md002);
				$('#del_md003').val(del_md003);
				$('#del_form').submit();
			}
		}
		</script>
        <?php $i++; $mproduct_row = (int) $product_row + 1; $product_row=(string)$mproduct_row;
		echo "<script>$('#row_count').val(".$product_row.")</script>";
		?>		
 <?php } ?>		
    <!-- javascrit 0 -->
	 
	<?php include_once("./application/views/fun/copi06_funjsupdjs_v.php"); ?> 
		 
		   <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
             <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			 <td class="left" colspan="19"></td>
            </tr>
			  
            </tfoot>
          </table>
        </div>
	 </div>
	 
	<!-- 合計     -->
		     <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span></span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　訂單金額：</b></td>
				<td ><input type='text' readonly="value" name='tc029' id="tc019" size="8" value="<?php echo $tc029; ?>"  style="background-color:#EBEBE4" /></td>
			<!--	<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_total"></span></b></td>  -->
				<td class="right" valign="top"><b style="color: #003A88;">　　稅額：</b></td>
				<td ><input type='text' readonly="value" name='tc030' id="tc030" size="8" value="<?php echo $tc030; ?>"  style="background-color:#EBEBE4" /></td>
			<!--	<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tax"></span></b></td> -->
				<td class="right" valign="top"><b style="color: #003A88;">　　合計金額：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot"></span></b></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總數量：</b></td>
				<td ><input type='text' readonly="value" name='tc031' id="tc031" size="8" value="<?php echo $tc031; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總毛重：</b></td>
				<td ><input type='text' readonly="value" name='tc043' id="tc043" size="8" value="<?php echo $tc043; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總材積：</b></td>
				<td ><input type='text' readonly="value" name='tc044' id="tc044" size="8" value="<?php echo $tc044; ?>"  style="background-color:#EBEBE4" /></td>
				<td style="display:none;"><input id="select_rows" />
				<td class="left" valign="top"></td>
				
              </tr>
		<!-- 合計     -->	
	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cop/copi06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div> 
	  </div> <!-- div-加 -->
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

 
    </div> <!-- div-3 --> 
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
<form action="<?php echo base_url()?>index.php/cop/copi06/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
<?php include_once("./application/views/fun/copi06_funjsupd_v.php"); ?> 