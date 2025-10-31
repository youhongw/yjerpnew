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

<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 組合單建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('bom/bomi05/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	  </div>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/bom/bomi05/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php $i=0; ?>
		<?php $ii=0; ?>
	<?php foreach($result as $row) { ?>
           <?php   $bomq03a42=$row->td001;?> 
		   <?php   $bomq03a42disp=$row->td001disp;?> 
		  <?php    $td002=$row->td002;?> 
		  <?php   if ($row->td003=='') {$td003=$row->td003;} else  {$td003=substr($row->td003,0,4).'/'.substr($row->td003,4,2).'/'.substr($row->td003,6,2);} ?>	
		  <?php    $invq02a1=$row->td004;?> 
           <?php    $invq02a1disp=$row->td004;?> 
           <?php    $td004disp=$row->td004disp;?> 
           <?php    $td004disp1=$row->td004disp1;?> 			 
          <?php    $td005=$row->td005;?>
		  <?php    $td006=$row->td006;?>   
		  <?php    $td007=$row->td007;?>  
           <?php    $td007a=$row->td007;?>   		  
		  <?php    $td008=$row->td008;?>
		  <?php    $td009=$row->td009;?>
		  <?php    $td009disp=0;?>
		  <?php    $td009disp1=0;?>
		  <?php    $cmsq03a=$row->td010;?> 
          <?php    $cmsq03adisp=$row->td010disp;?>		  
         <?php    $td011=$row->td011;?>
		 <?php    $td012=$row->td012;?>
		  <?php    $td013=$row->td013;?>
		  <?php    if ($row->td014=='') {$td014=$row->td014;} else  {$td014=substr($row->td014,0,4).'/'.substr($row->td014,4,2).'/'.substr($row->td014,6,2);} ?>
          <?php    $td015=$row->td015;?>
		   <?php    $td016=$row->td016;?>
		  <?php    $td017=$row->td017;?>
		  <?php    $td018=$row->td018;?>
		  <?php    $td019=$row->td019;?>  
		   <?php    $flag=$row->flag;?>	
		
		 <!-- 明細 -->
		    <?php    $te001[]=$row->te001;?>
			<?php   $te002[]=$row->te002;?>
		   <?php    $te003[]=$row->te003;?>
		   <?php    $te004[]=$row->te004;?> 
		   <?php    $te004disp[]=$row->te004disp;?>
		   <?php    $te004disp1[]=$row->te004disp1;?>
		  <?php    $te005[]=$row->te005;?>
		   <?php    $te007[]=$row->te007;?>   
		   <?php    $te007disp[]=$row->te007disp;?>
		    <?php    $te008[]=$row->te008;?>
			<?php    $te008a[]=$row->te008;?>
		   <?php    $te009[]=$row->te009;?> 
           <?php    $te011[]=$row->te011;?>   
		   <?php    $te012[]=$row->te012;?> 
		   
		  <?php    $mb991=' ';?>
		  <?php    $mb992=' ';?>
		  <?php    $mb999=' ';?>
	<?php $ii = $ii + 1 ; }?>
      <?php 
	  if(!isset($sysma200)) { $sysma200=$this->session->userdata('sysma200'); }
	  if(!isset($sysma201)) { $sysma201=$this->session->userdata('sysma201'); }  ?>
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="normal14y"  width="8%"><span class="required">組合單別：</span> </td>
        <td class="normal14a"  width="25%"><input tabIndex="1" id="td001"    onKeyPress="keyFunction()"  onfocus="selappr()" onChange="stbomq03a42(this)"  name="bomq03a42" value="<?php echo strtoupper($bomq03a42); ?>"  type="text" required disabled="disabled"  /><a href="javascript:;"><img id="Showbomq03a42" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="bomq03a42disp"> <?php    echo $bomq03a42disp; ?> </span></td>
	    <td class="normal14y" width="8%" >單據日期： </td>
        <td class="normal14a"  width="25%" ><input tabIndex="2"  onclick="scwShow(this,event);" onfocus="selappr()"  id="td003" onKeyPress="keyFunction()"  onchange="chkno1(this)" name="td003"  value="<?php echo $td003; ?>"  size="12" type="text"  style="background-color:#E7EFEF" disabled="disabled" /></td>
	    <td class="normal14y" width="9%"><span class="required">組合單號：</span></td>
        <td class="normal14a" width="25%"><input tabIndex="3" id="td002" onKeyPress="keyFunction()" onfocus="chkno1(this)" name="td002" value="<?php echo $td002; ?>" size="30" type="text" required /><span id="td002disp"disabled="disabled"  ></span></td>
	  </tr>	
	  <tr>
		 <td class="normal14a">成品品號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="td004" onKeyPress="keyFunction()" onfocus="chkno1(this)" onchange="startinvq02a1(this)" name="invq02a1" value="<?php echo $invq02a1; ?>" size="20" type="text" disabled="disabled"  /><img id="Showinvq02a1" src="<?php echo base_url()?>assets/image/png/distance.png" alt="" align="top"/></a>
        <span id="invq02a1disp"> <?php   echo $invq02a1disp; ?> </span></td>
        <td class="normal14a" >品名：</td>
        <td class="normal14a" ><input tabIndex="5" id="td004disp" onKeyPress="keyFunction()"  name="td004disp" value="<?php echo $td004disp; ?>" size="30" type="text" style="background-color:#EBEBE4" disabled="disabled"  /></td>	 
         <td class="normal14a" >規格：</td>
        <td class="normal14a" ><input tabIndex="6" id="td004disp1" onKeyPress="keyFunction()"  name="td004disp1" value="<?php echo $td004disp1; ?>" size="30" type="text" style="background-color:#EBEBE4" disabled="disabled" /></td>	 	
	</tr>
		
	  <tr>
	    <td class="normal14a" >單位：</td>
        <td class="normal14a" ><input tabIndex="7" id="td005" onKeyPress="keyFunction()"  name="td005" value="<?php echo $td005; ?>" size="10" type="text" disabled="disabled"  /></td>
	    <td class="normal14">成品數量：</td>
       <td class="normal14a" ><input tabIndex="8" id="td007" onKeyPress="keyFunction()"  name="td007" value="<?php echo $td007; ?>" size="10" type="text" disabled="disabled"  /></td>
	    <td class="normal14">入庫庫別：</td>
       <td class="normal14a" ><input tabIndex="5" id="td010" onKeyPress="keyFunction()" name="cmsq03a" onchange="stcmsq03a(this)"  value="<?php echo $cmsq03a; ?>"  type="text" disabled="disabled"   /><a href="javascript:;"><img id="Showcmsq03a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
        <span id="cmsq03adisp"> <?php    echo $cmsq03adisp; ?> </span></td>
	  
	  </tr>
	    <tr>
	     <td class="normal14">備註：</td>
       <td class="normal14a" ><input tabIndex="10" id="td011" onKeyPress="keyFunction()"  name="td011" value="<?php echo $td011; ?>" type="text" disabled="disabled"  /></td>
	   <td class="normal14">確認碼：</td>
          <td  class="normal14"  ><select id="td012" onKeyPress="keyFunction()" name="td012" onChange="selappr(this)" tabIndex="11" disabled="disabled" >
            <option <?php if($td012 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($td012 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($td012 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td> 
		<td class="normal14a" >列印：</td>
        <td class="normal14a" ><input tabIndex="12" id="td013" onKeyPress="keyFunction()"  name="td013" value="<?php echo $td013; ?>" size="10" type="text" style="background-color:#EBEBE4" disabled="disabled" /></td>
		  <td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" disabled="disabled" /></td>
         <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" disabled="disabled" /></td>
		   <td  class="normal14"  ><input type='hidden' name='td007a' id='td007a' value="<?php echo $td007a; ?>" disabled="disabled" /></td>
	  </tr>
	  
		
	</table>
	
	<div class="abgne_tab"> <!-- div-7 -->
		<ul class="tabs">
			<li><a href="#tab1">組合成本</a></li>
		</ul>

    <div class="tab_container"> <!-- div-8 -->
	
	<!--   基本資料 -->	
	<div id="tab1" class="tab_content">
      <table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="9%" > 計成本人工：</td>
       <td class="normal14a"  width="24%" ><input type="text" tabIndex="13" id="td008"    onKeyPress="keyFunction()"    name="td008" value="<?php echo $td008; ?>"  disabled="disabled" /></td>
	   <td class="normal14y"  width="12%" > 不計成本人工：</td>
       <td class="normal14a"  width="21%" ><input type="text" tabIndex="14" id="td009"     onKeyPress="keyFunction()"    name="td009" value="<?php echo $td009; ?>"  disabled="disabled" /></td>
	   <td class="normal14y"  width="9%" > 簽核狀態：</td>
       <td class="normal14a"  width="25" ><select id="td016" tabIndex="15" readonly="value" onKeyPress="keyFunction()" name="td016"   style="background-color:#EBEBE4" disabled="disabled"  >
            <option <?php if($td016 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($td016 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($td016 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($td016 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($td016 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($td016 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($td016 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($td016 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
	 </tr>	
	 <tr>
	   <td class="normal14z"  > 組合成本：</td>
       <td class="normal14a"  ><input type="text" tabIndex="16" id="td009disp"    onKeyPress="keyFunction()"    name="td009disp" value="<?php echo $td009disp; ?>" style="background-color:#E7EFEF" disabled="disabled" /></td>
	   <td class="normal14z"  > 單位成本：</td>
       <td class="normal14a"  ><input type="text" tabIndex="17" id="td009disp1"   onclick="scwShow(this,event);"   onKeyPress="keyFunction()"    name="td009disp1" value="<?php echo $td009disp1; ?>"  style="background-color:#E7EFEF" disabled="disabled" /></td>
	   <td class="normal14z"  > 組合日期：</td>
       <td class="normal14a"  ><input type="text" tabIndex="18" id="td003"   onKeyPress="keyFunction()"  onclick="scwShow(this,event);"  name="td003" value="<?php echo $td003; ?>" style="background-color:#E7EFEF" disabled="disabled"  /></td>
	 </tr>
	  <tr>
	   <td class="normal14z"  > 批號：</td>
       <td class="normal14a"  ><input type="text" tabIndex="19" id="td017"    onKeyPress="keyFunction()"    name="td017" value="<?php echo $td017; ?>" style="background-color:#E7EFEF" disabled="disabled"  /></td>
	   <td class="normal14z"  > 有效日期：</td>
       <td class="normal14a"  ><input type="text" tabIndex="20" id="td018"      onKeyPress="keyFunction()"    name="td018" value="<?php echo $td018; ?>" style="background-color:#E7EFEF" disabled="disabled"  /></td>
	   <td class="normal14z"  > 確認者：</td>
       <td class="normal14a"  ><input type="text" tabIndex="21" id="td015"   onKeyPress="keyFunction()"    name="td015" value="<?php echo $td015; ?>" disabled="disabled"  /></td>
	 </tr>
	<tr>
	   <td class="normal14z"  > 小單位：</td>
       <td class="normal14a"  ><input type="text" tabIndex="22" id="td006"    onKeyPress="keyFunction()"    name="td006" value="<?php echo $td006; ?>" disabled="disabled"  /></td>
	   <td class="normal14z"  > 複檢日期：</td>
       <td class="normal14a"  ><input type="text" tabIndex="23" id="td019"    onKeyPress="keyFunction()"    name="td019" value="<?php echo $td014; ?>" style="background-color:#E7EFEF" disabled="disabled"  /></td>
	    <td  class="normal14" ></td>
        <td class="normal14"></td>
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
		      <td width="8%" class="center">元件品號</td>
              <td width="8%" class="left">品名</td>
			  <td width="8%" class="left">規格</td>  
			  <td width="6%" class="center">單位</td>
			  <td width="6%" class="center">序號</td>
			  <td width="6%" class="left">出庫庫別</td>
		 	  <td width="6%" class="left">庫別名稱</td> 
              <td width="6%" class="center">元件用量</td>
              <td width="6%" class="right">損耗率</td>
              <td width="6%" class="right">損耗量</td>
			  <td width="13%" class="center">備註</td>
			  
            </tr>
        </thead>
      
   	<!--   明細0  --> 
		<?php $i=0; $mproduct_row=0; $product_row='0'; ?>  
			 
		<?php while ($i<$ii) { ?>
		<tbody   <?php echo    "id=product-row".$product_row ?> >		  		
	     <tr>
	     <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td>
  	     <input type="hidden"  name="order_product[<?php echo $i ?>][te001]" value="<?php echo $te001[$i]; ?>" />
	     <input type="hidden" name="order_product[<?php echo $i ?>][te002]" value="<?php echo $te002[$i]; ?>" />
		  <input type="hidden" name="order_product[<?php echo $i ?>][te010]" value="Y" />
		  <input type="hidden" name="order_product[<?php echo $i ?>][te008a]" value="<?php echo $te008a[$i]; ?>" />
	       <td class="left"><input type="text"  <?php echo 'id='.'te004'.$i ?> onchange="startinvq02a(this,product_row)"   name="order_product[<?php echo $i ?>][te004]" value="<?php echo $te004[$i]; ?>" size="20" style="background-color:#E7EFEF"  /></td>
	     <td class="left"><input  type="text"  onKeyPress="keyFunction()"  id="te004disp"  name="order_product[<?php echo $i ?>][te004disp]" value="<?php echo $te004disp[$i]; ?>"  style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text"  onKeyPress="keyFunction()"  id="te004disp1"   name="order_product[<?php echo $i ?>][te004disp1]" value="<?php echo $te004disp1[$i]; ?>"  size="30" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input  type="text"  onKeyPress="keyFunction()"    id="te005"   name="order_product[<?php echo $i ?>][te005]" value="<?php echo $te005[$i]; ?>" size="6"  /></td>
	     <td class="left"><input type="text"   readonly="value"   name="order_product[$i][te003]" value="<?php echo $te003[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
		 <td class="left"><input type="text"   <?php echo 'id='.'te007'.$i ?>  onchange="startcmsq03a(this,product_row)"  name="order_product[<?php echo $i ?>][te007]" value="<?php echo $te007[$i]; ?>" size="10" style="background-color:#E7EFEF"  /></td>
		<td class="left"><input  type="text"  onKeyPress="keyFunction()"  id="te007disp"  name="order_product[<?php echo $i ?>][te007disp]" value="<?php echo $te007disp[$i]; ?>"  style="background-color:#EBEBE4" /></td>
		 <td class="center"><input type="text"  id="te008" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][te008]" value="<?php echo $te008[$i]; ?>" size="10" style="text-align:right;" /></td>
		 <td class="center"><input type="text"  id="te011" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][te011]" value="<?php echo $te011[$i]; ?>" size="10" style="text-align:right;" /></td>
		 <td class="center"><input type="text"  id="te012" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][te012]" value="<?php echo $te012[$i]; ?>" size="10" style="text-align:right;" /></td>
		 <td class="left"><input type="text" id="te009"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][te009]" value="<?php echo $te009[$i]; ?>" size="20"  /></td>
	     </tr>	    
        </tbody>
        <?php $i++; $mproduct_row = (int) $product_row + 1; $product_row=(string)$mproduct_row;?>
 
 <?php } ?>		 
    <!-- javascrit 0 -->
	 
	<?php include("./application/views/fun/bomi05_funjsupdjs_v.php"); ?> 
		
                  <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
              <tr>
                <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
				<td class="left" colspan="12"></td>
              </tr>
			  
		
            </tfoot>
          </table>
        </div>
	
	 </div>
	</div>
	<!-- 合計     -->
		<!--     <tr>
               <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">原幣未稅總額：</b></td>
				<td ><input type='text' readonly="value" name='tg028' id="tg028" size="8" value="<?php echo $tg028; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;原幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='tg019' id="tg019" size="8" value="<?php echo $tg019; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;原幣合計金額：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot"><?php echo $tg028+$tg019; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">本幣未稅總額：</b></td>
				<td ><input type='text' readonly="value" name='tg031' id="tg031" size="8" value="<?php echo $tg031; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;本幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='tg032' id="tg032" size="8" value="<?php echo $tg032; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;本幣合計金額：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot1"><?php echo $tg031+$tg032; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;合計數量：</b></td>
				<td ><input type='text' readonly="value" name='tg026' id="tg026" size="8" value="<?php echo $tg026; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>  -->	
		<!-- 合計     -->	
	<!--<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('bom/bomi05/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	</div> -->
	  
      </form>
	  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>  -->
  
     </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  <!--  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>  -->
  </div> <!-- div-3 -->
 </div> <!-- div-2 -->
</div> <!-- div-1 -->
