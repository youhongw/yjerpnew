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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 拆解單建立作業 - 修改　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#tf001').focus();" type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('bom/bomi06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/bom/bomi06/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php $ii=0; ?>
	<?php foreach($result as $row) { ?>
	
           <?php   $bomq03a43=$row->tf001;?> 
		   <?php   $bomq03a43disp=$row->tf001disp;?> 
		  <?php    $tf002=$row->tf002;?> 
		  <?php   if ($row->tf003=='') {$tf003=$row->tf003;} else  {$tf003=substr($row->tf003,0,4).'/'.substr($row->tf003,4,2).'/'.substr($row->tf003,6,2);} ?>	
		  <?php    $invq02a1=$row->tf004;?> 
           <?php    $invq02a1disp=$row->tf004;?> 
           <?php    $tf004disp=$row->tf004disp;?> 
           <?php    $tf004disp1=$row->tf004disp1;?> 
            <?php    $tf004disp2='';?> 
	          <?php  $tf004disp3='';?> 
	         <?php   $tf004disp4='';?>  
          <?php    $tf005=$row->tf005;?>
		  <?php    $tf006=$row->tf006;?>   
		  <?php    $tf007=$row->tf007;?>  
           <?php    $tf007a=$row->tf007;?>   		  
		  <?php    $tf008=$row->tf008;?>
		  <?php    $tf009=$row->tf009;?>
		  <?php    $cmsq03a=$row->tf008;?> 
          <?php    $cmsq03adisp=$row->tf008disp;?>	
           <?php    $tf010=$row->tf010;?>		  
         <?php    $tf011=$row->tf011;?>
		  <?php    if ($row->tf012=='') {$tf012=$row->tf012;} else  {$tf012=substr($row->tf012,0,4).'/'.substr($row->tf012,4,2).'/'.substr($row->tf012,6,2);} ?>
          <?php    $tf013=$row->tf013;?>
		  <?php    $tf014=$row->tf014;?>
		  <?php    $tf015=$row->tf015;?>
		   <?php    $tf016=$row->tf016;?>
		  <?php    $tf017=$row->tf017;?>
		  <?php    $tf018=$row->tf018;?>
		   <?php    $flag=$row->flag;?>	
		
		 <!-- 明細 -->
		    <?php    $tg001[]=$row->tg001;?>
			<?php   $tg002[]=$row->tg002;?>
		   <?php    $tg003[]=$row->tg003;?>
		   <?php    $tg004[]=$row->tg004;?> 
		   <?php    $tg004disp[]=$row->tg004disp;?>
		   <?php    $tg004disp1[]=$row->tg004disp1;?>
		  <?php    $tg005[]=$row->tg005;?>
		   <?php    $tg007[]=$row->tg007;?>   
		   <?php    $tg007disp[]=$row->tg007disp;?>
		    <?php    $tg008[]=$row->tg008;?>
			<?php    $tg008a[]=$row->tg008;?>
		   <?php    $tg009[]=$row->tg009;?> 
           <?php    $tg011[]=$row->tg011;?>   
		   <?php    $tg012[]=$row->tg012;?> 
		   
		  <?php    $mb991=' ';?>
		  <?php    $mb992=' ';?>
		  <?php    $mb999=' ';?>
	<?php $ii = $ii + 1 ; }?>
	<?php 
	  if(!isset($sysma200)) { $sysma200=$this->session->userdata('sysma200'); }
	  if(!isset($sysma201)) { $sysma201=$this->session->userdata('sysma201'); }  ?>
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="8%"><span class="required">拆解單別：</span> </td>
        <td class="normal14a"  width="25%"><input tabIndex="1" id="tf001"    onKeyPress="keyFunction()"  onfocus="selappr()" onChange="stbomq03a43(this)"  name="bomq03a43" value="<?php echo strtoupper($bomq03a43); ?>"  type="text" required /><a href="javascript:;"><img id="Showbomq03a43" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="bomq03a43disp"> <?php    echo $bomq03a43disp; ?> </span></td>
	    <td class="normal14y" width="8%" >單據日期： </td>
        <td class="normal14a"  width="25%" ><input tabIndex="2"  onclick="scwShow(this,event);" onfocus="selappr()"  id="tf012" onKeyPress="keyFunction()"  onchange="chkno1(this)" name="tf012"  value="<?php echo $tf012; ?>"  size="12" type="text"  style="background-color:#E7EFEF" /></td>
	    <td class="normal14y" width="9%"><span class="required">拆解單號：</span></td>
        <td class="normal14a" width="25%"><input tabIndex="3" id="tf002" onKeyPress="keyFunction()" onfocus="chkno1(this)" name="tf002" value="<?php echo $tf002; ?>" size="30" type="text" required /><span id="tf002disp" ></span></td>
	  </tr>	
	  <tr>
		 <td class="normal14z">成品品號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="tf004" onKeyPress="keyFunction()" onfocus="chkno1(this)" onchange="startinvq02a1(this)" name="invq02a1" value="<?php echo $kkk=$invq02a1; ?>" size="20" type="text" required /><img id="Showinvq02a1" src="<?php echo base_url()?>assets/image/png/distance.png" alt="" align="top"/></a>
        <span id="invq02a1disp"> <?php   echo $invq02a1disp; ?> </span></td>
        <td class="normal14z" >品名：</td>
        <td class="normal14a" ><input tabIndex="5" id="tf004disp" onKeyPress="keyFunction()"  name="tf004disp" value="<?php echo $tf004disp; ?>" size="30" type="text" style="background-color:#EBEBE4" /></td>	 
         <td class="normal14z" >規格：</td>
        <td class="normal14a" ><input tabIndex="6" id="tf004disp1" onKeyPress="keyFunction()"  name="tf004disp1" value="<?php echo $tf004disp1; ?>" size="30" type="text" style="background-color:#EBEBE4" /></td>	 	
	</tr>
		
	  <tr>
	    <td class="normal14z" >單位：</td>
        <td class="normal14a" ><input tabIndex="7" id="tf005" onKeyPress="keyFunction()"  name="tf005" value="<?php echo $tf005; ?>" size="10" type="text"  /></td>
	    <td class="normal14z">成品數量：</td>
       <td class="normal14a" ><input tabIndex="8" id="tf007" onKeyPress="keyFunction()"  name="tf007" value="<?php echo $tf007; ?>" size="10" type="text"  /></td>
	    <td class="normal14z">出庫庫別：</td>
       <td class="normal14a" ><input tabIndex="9" id="tf008" onKeyPress="keyFunction()" name="cmsq03a" onchange="stcmsq03a1a(this)"  value="<?php echo $cmsq03a; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq03a1" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
        <span id="cmsq03adisp"> <?php    echo $cmsq03adisp; ?> </span></td>
	  
	  </tr>
	    <tr>
	     <td class="normal14z">備註：</td>
       <td class="normal14a" ><input tabIndex="10" id="tf009" onKeyPress="keyFunction()"  name="tf009" value="<?php echo $tf009; ?>" type="text"  /></td>
	   <td class="normal14z">確認碼：</td>
          <td  class="normal14"  ><select id="tf010" onKeyPress="keyFunction()" name="tf010" onChange="selappr(this)" tabIndex="11">
            <option <?php if($tf010 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tf010 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tf010 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td> 
		<td class="normal14z" >列印：</td>
        <td class="normal14a" ><input tabIndex="12" id="tf011" onKeyPress="keyFunction()"  name="tf011" value="<?php echo $tf011; ?>" size="10" type="text" style="background-color:#EBEBE4" /></td>
		  <td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" /></td>
         <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" /></td>
	  </tr>
	  
		
	</table>
	
	<div class="abgne_tab"> <!-- div-7 -->
		<ul class="tabs">
			<li><a href="#tab1">拆解成本</a></li>
		</ul>

    <div class="tab_container"> <!-- div-8 -->
	
	<!--   基本資料 -->	
	<div id="tab1" class="tab_content">
      <table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="9%" >批號：</td>
       <td class="normal14a"  width="24%" ><input type="text" tabIndex="19" id="tf017"    onKeyPress="keyFunction()"    name="tf017" value="<?php echo $tf017; ?>"   /></td>
	   <td class="normal14y"  width="12%" >拆解日期：</td>
       <td class="normal14a"  width="21%" ><input type="text" tabIndex="18" id="tf003"   onKeyPress="keyFunction()"  onclick="scwShow(this,event);"  name="tf003" value="<?php echo $tf003; ?>" style="background-color:#EBEBE4"  /></td>
	   <td class="normal14y"  width="9%" > 簽核狀態：</td>
       <td class="normal14a"  width="25" ><select id="tf014" tabIndex="15" readonly="value" onKeyPress="keyFunction()" name="tf014"   style="background-color:#EBEBE4" >
            <option <?php if($tf014 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tf014 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($tf014 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tf014 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tf014 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tf014 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tf014 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tf014 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
	 </tr>	
	 <tr>
	   <td class="normal14z"  > 調整單別：</td>
       <td class="normal14a"  ><input type="text" tabIndex="16" id="tf016"    onKeyPress="keyFunction()"    name="tf016" value="<?php echo $tf016; ?>" style="background-color:#EBEBE4" /></td>
	   <td class="normal14z"  > 調整單別：</td>
       <td class="normal14a"  ><input type="text" tabIndex="17" id="tf017"      onKeyPress="keyFunction()"    name="tf017" value="<?php echo $tf017; ?>"  style="background-color:#EBEBE4"/></td>
	   <td class="normal14z"  > 調整序號：</td>
       <td class="normal14a"  ><input type="text" tabIndex="18" id="tf018"   onKeyPress="keyFunction()"  onclick="scwShow(this,event);"  name="tf018" value="<?php echo $tf018; ?>" style="background-color:#EBEBE4"  /></td>
	 </tr>
	  <tr>
	   
	   <td class="normal14z"  > 確認者：</td>
       <td class="normal14a"  ><input type="text" tabIndex="21" id="tf015"   onKeyPress="keyFunction()"    name="tf015" value="<?php echo $tf015; ?>" style="background-color:#EBEBE4"  /></td>
	   <td class="normal14z"  > 小單位：</td>
       <td class="normal14a"  ><input type="text" tabIndex="22" id="tf006"    onKeyPress="keyFunction()"    name="tf006" value="<?php echo $tf006; ?>" style="background-color:#EBEBE4" /></td>
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
			  <td width="6%" class="left">入庫庫別</td>
		 	  <td width="6%" class="left">庫別名稱</td> 
              <td width="6%" class="center">元件用量</td>
              <td width="6%" class="right">批號</td>
              <td width="6%" class="right">有效日期</td>
			  <td width="13%" class="center">備註</td>
			  
            </tr>
        </thead>
      
   	<!--   明細0  --> 
		<?php $i=0; $mproduct_row=0; $product_row='0'; ?>  
			 
		<?php while ($i<$ii) { ?>
		<tbody   <?php echo    "id=product-row".$product_row ?> >		  		
	     <tr>
	     <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td>
  	     <input type="hidden"  name="order_product[<?php echo $i ?>][tg001]" value="<?php echo $tg001[$i]; ?>" />
	     <input type="hidden" name="order_product[<?php echo $i ?>][tg002]" value="<?php echo $tg002[$i]; ?>" />
		  <input type="hidden" name="order_product[<?php echo $i ?>][tg010]" value="Y" />
		  <input type="hidden" name="order_product[<?php echo $i ?>][tg008a]" value="<?php echo $tg008a[$i]; ?>" />
	     <td class="left"><input type="text"  <?php echo 'id='.'tg004'.$i ?> onchange="startinvq02a(this,product_row)"   name="order_product[<?php echo $i ?>][tg004]" value="<?php echo $tg004[$i]; ?>" size="20" style="background-color:#E7EFEF"  /></td>
	     <td class="left"><input  type="text"  onKeyPress="keyFunction()"  id="tg004disp"  name="order_product[<?php echo $i ?>][tg004disp]" value="<?php echo $tg004disp[$i]; ?>"  style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text"  onKeyPress="keyFunction()"  id="tg004disp1"   name="order_product[<?php echo $i ?>][tg004disp1]" value="<?php echo $tg004disp1[$i]; ?>"  size="30" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input  type="text"  onKeyPress="keyFunction()"    id="tg005"   name="order_product[<?php echo $i ?>][tg005]" value="<?php echo $tg005[$i]; ?>" size="6"  /></td>
	     <td class="left"><input type="text"   readonly="value"   name="order_product[$i][tg003]" value="<?php echo $tg003[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
		 <td class="left"><input type="text"   <?php echo 'id='.'tg007'.$i ?>  onchange="startcmsq03a(this,product_row)"  name="order_product[<?php echo $i ?>][tg007]" value="<?php echo $tg007[$i]; ?>" size="10" style="background-color:#E7EFEF"  /></td>
		<td class="left"><input  type="text"  onKeyPress="keyFunction()"  id="tg007disp"  name="order_product[<?php echo $i ?>][tg007disp]" value="<?php echo $tg007disp[$i]; ?>"  style="background-color:#EBEBE4" /></td>
		 <td class="center"><input type="text"  id="tg008" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg008]" value="<?php echo $tg008[$i]; ?>" size="10" style="text-align:right;" /></td>
		 <td class="center"><input type="text"  id="tg011" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg011]" value="<?php echo $tg011[$i]; ?>" size="10" style="text-align:right;" /></td>
		 <td class="center"><input type="text"  id="tg012" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg012]" value="<?php echo $tg012[$i]; ?>" size="10" style="text-align:right;" /></td>
		 <td class="left"><input type="text" id="tg009"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg009]" value="<?php echo $tg009[$i]; ?>" size="20"  /></td>
	     </tr>	    
        </tbody>
        <?php $i++; $mproduct_row = (int) $product_row + 1; $product_row=(string)$mproduct_row;?>
 
 <?php } ?>		 
    <!-- javascrit 0 -->
	 
	<?php include("./application/views/fun/bomi06_funjsupdjs_v.php"); ?> 
		 
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
	 
	 <!-- 合計     -->
		  <!--    <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span>
				
				</span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣未稅總額：</b></td>
				<td ><input type='text' readonly="value" name='tf028' id="tf028" size="8" value="<?php echo $tf028; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='tf019' id="tf019" size="8" value="<?php echo $tf019; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣合計金額：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot"><?php echo $tf028+$tf019; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣未稅總額：</b></td>
				<td ><input type='text' readonly="value" name='tf031' id="tf031" size="8" value="<?php echo $tf031; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='tf032' id="tf032" size="8" value="<?php echo $tf032; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣合計金額：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot1"><?php echo $tf031+$tf032; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　合計數量：</b></td>
				<td ><input type='text' readonly="value" name='tf026' id="tf026" size="8" value="<?php echo $tf026; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span> -->
		<!-- 合計     -->	
	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	 <!-- <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('bom/bomi06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div> -->
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
 
 <?php include("./application/views/fun/bomi06_funjsupd_v.php"); ?>