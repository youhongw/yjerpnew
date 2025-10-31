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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 報價單資料建立作業 -修改</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cop/copi05/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php $ii=0; ?>
	<?php foreach($result as $row) { ?>
	  
          <?php   $copq03a21=$row->ta001;?>
		  <?php   $copq03a21disp=$row->ta001disp;?>
          <?php   $ta002=$row->ta002;?>
          <?php   $ta003=substr($row->ta003,0,4).'/'.substr($row->ta003,4,2).'/'.substr($row->ta003,6,2);?>
          <?php   $copq01a=$row->ta004;?>
		  <?php   $copq01adisp=$row->ta004disp;?>
          <?php   $cmsq09a3=$row->ta005;?>
		   <?php   $cmsq09a3disp=$row->ta005disp;?>
          <?php   $ta006=$row->ta006;?>
		  <?php   $cmsq06a=$row->ta007;?>
		   <?php   $cmsq06adisp=$row->ta007disp;?>
		  <?php   $ta008=$row->ta008;?>
		  <?php   $ta009=$row->ta009;?>
		  <?php   $ta010=$row->ta010;?>
		  <?php   $cmsq21a2=$row->ta011;?>
		  <?php   $cmsq21a2disp=$row->ta011disp;?>
          <?php   $ta012=$row->ta012;?>
		  <?php   $ta013=substr($row->ta013,0,4).'/'.substr($row->ta013,4,2).'/'.substr($row->ta013,6,2);?>
		  <?php   $ta014=$row->ta014;?>
		  <?php   $ta015=$row->ta015;?>
		  <?php   $ta016=$row->ta016;?>
		  <?php   $ta017=$row->ta017;?>
		  <?php   $ta018=$row->ta018;?>
		  <?php   $ta019=$row->ta019;?>
		  <?php   $ta020=$row->ta020;?>
		  <?php   $ta021=$row->ta021;?>
		  <?php   $ta022=$row->ta022;?>
		  <?php   $ta023=$row->ta023;?>
		  <?php   $ta024=$row->ta024;?>
		  <?php   $ta025=$row->ta025;?>
		  <?php   $ta026=$row->ta026;?>
		  <?php   $ta027=$row->ta027;?>
		  <?php   $ta028=$row->ta028;?>
		  <?php   $ta029=$row->ta029;?>
		  <?php   $ta030=$row->ta030;?>
        
		 <!-- 明細 -->
		   
		   <?php   $tb001[]=$row->tb001;?>
		   <?php   $tb002[]=$row->tb002;?>
		   <?php   $tb003[]=$row->tb003;?>
		   <?php   $tb004[]=$row->tb004;?>
		   <?php   $tb005[]=$row->tb005;?>
		   <?php   $tb006[]=$row->tb006;?>
		   <?php   $tb007[]=$row->tb007;?>
		   <?php   $tb008[]=$row->tb008;?>
		   <?php   $tb009[]=round($row->tb009,2);?>
		   <?php   $tb010[]=round($row->tb010,0);?>
		   <?php   $tb012[]=$row->tb012;?>
		  
		   <?php   $tb018[]=$row->tb018;?>
		   <?php   $tb020[]=$row->tb020;?>
		   <?php   $tb021[]=$row->tb021;?>
		   <?php  if ($row->tb016>'0') {$tb016[]=substr($row->tb016,0,4).'/'.substr($row->tb016,4,2).'/'.substr($row->tb016,6,2);}
              else {$tb016[]='';} ?>
			  
	       <?php   $flag=$row->flag;?>			  
		  <?php   $mb991=' ';?>
		  <?php   $mb992=' ';?>
		  <?php   $mb999=' ';?>
	<?php $ii = $ii + 1 ; }?>
	<?php 
	  if(!isset($sysma200)) { $sysma200=$this->session->userdata('sysma200'); }
	  if(!isset($sysma201)) { $sysma201=$this->session->userdata('sysma201'); }  ?>
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="10%"><span class="required">報價單別：</span> </td>
        <td class="normal14a"  width="22%"><input tabIndex="1" id="ta001"    onKeyPress="keyFunction()" readonly="value" onfocus="selappr()" onchange="startcopq03a21(this)"  name="copq03a21" value="<?php echo strtoupper($copq03a21); ?>"  type="text" required /><a href="javascript:;"><img id="Showcopq03a21" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="copq03a21disp"> <?php    echo $copq03a21disp; ?> </span></td>
	    <td class="normal14a" width="10%" >單據日期：</td>
        <td class="normal14a"  width="24%" ><input tabIndex="2"  onclick="scwShow(this,event);"   id="ta013" onKeyPress="keyFunction()"  onchange="chkno1(this)" name="ta013"  value="<?php echo $ta013; ?>"  size="12" type="text" style="background-color:#E7EFEF"  /></td>
		<td class="normal14a" width="10%" ><span class="required">報價單號：</span> </td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="ta002" onKeyPress="keyFunction()" readonly="value" name="ta002" value="<?php echo $ta002; ?>" size="20" type="text" required /><span id="ta002disp" ></span></td>
	  </tr>		
	  <tr>
		<td class="normal14">客戶代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="ta004" onKeyPress="keyFunction()"  onchange="startcopq01a(this)" name="copq01a" value="<?php echo $copq01a; ?>" size="10" type="text"  /><a href="javascript:;"><img id="Showcopq01a" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
        <span id="copq01adisp"> <?php echo $copq01adisp; ?> </span></td>	    
	    <td class="normal14" >幣別：</td>
        <td class="normal14a" ><input tabIndex="5" id="ta007" onKeyPress="keyFunction()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
        <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span></td>
		<td class="normal14" >業務人員：</td>
        <td class="normal14a" ><input tabIndex="6" id="ta005" onKeyPress="keyFunction()" name="cmsq09a3" onchange="startcmsq09a3(this)"  value="<?php echo $cmsq09a3; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq09a3" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
        <span id="cmsq09a3disp"> <?php    echo $cmsq09a3disp; ?> </span></td>
	  </tr>
	  <tr>
	<!--	<td class="start14">付款條件：</td>
        <td  class="normal14"  ><input tabIndex="7" id="ta011" onKeyPress="keyFunction()"  name="cmsq21a2" onfocus="startcmsq21a2(this)"  value="<?php echo $cmsq21a2; ?>"  type="text"  /><a href="javascript:;"><img id="Showcmsq21a2" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="cmsq21a2disp"> <?php echo $cmsq21a2disp; ?> </span></td>	  -->   
	    <td class="normal14" >付款條件：</td>
        <td class="normal14a" ><input tabIndex="6" id="ta011" onKeyPress="keyFunction()" name="cmsq21a2" onchange="startcmsq21a2(this)"  value="<?php echo $cmsq21a2; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq21a2" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="cmsq21a2disp"> <?php    echo $cmsq21a2disp; ?> </span></td>
		<td class="normal14" >價格條件：</td>
        <td class="normal14a" ><input type="text" tabIndex="8"  onKeyPress="keyFunction()" id="ta010" name="ta010"   value="<?php echo $ta010; ?>"  /></td>
		<td class="normal14" >訂貨日內交：</td>
        <td class="normal14a" ><input type="text" tabIndex="9"  onKeyPress="keyFunction()" id="ta014" name="ta014" size="5"  value="<?php echo $ta014; ?>"  /></td>
	   
	  </tr> 
	  <tr>
		<td class="normal14">匯率：</td>
        <td  class="normal14"  ><input type="text" tabIndex="10"  onKeyPress="keyFunction()" id="ta008" name="ta008"   value="<?php echo $ta008; ?>"  /></td>
	    <td class="normal14" >營業稅率：</td>
        <td class="normal14a" ><input type="text" tabIndex="11"  onKeyPress="keyFunction()" id="ta024" name="ta024"   value="<?php echo $ta024; ?>"  /></td>
		<td class="normal14" >列印格式：</td>
        <td class="normal14a" ><select id="ta017" onKeyPress="keyFunction()" name="ta017"   tabIndex="12">
            <option <?php if($ta017 == '1') echo 'selected="selected"';?> value='1'>1中式</option>                                                                        
		    <option <?php if($ta017 == '2') echo 'selected="selected"';?> value='2'>2英式</option>
		  </select></td> 
	  
	  </tr>
	   <tr>
		<td class="normal14">客戶全名：</td>
        <td  class="normal14"  ><input type="text" tabIndex="13"  onKeyPress="keyFunction()" id="ta006" name="ta006"   value="<?php echo $ta006; ?>"  /></td>
	    <td class="normal14" >備註一：</td>
        <td class="normal14a" ><input type="text" tabIndex="14"  onKeyPress="keyFunction()" id="ta020" name="ta020"   value="<?php echo $ta020; ?>"  /></td>
		<td class="normal14" >客戶確認：</td>
        <td class="normal14a" ><input type="hidden" name="ta016" value="N" />
		<input type='checkbox' tabIndex="15" id="ta016" onKeyPress="keyFunction()" name="ta016" <?php if($ta016 == 'Y' ) echo 'checked'; ?>  <?php if($ta016 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
	  
	  </tr>
	  <tr>
	    <td class="normal14" >課稅別：</td>
        <td class="normal14" ><select id="ta022" onKeyPress="keyFunction()" name="ta022" onchange="taxa()" tabIndex="16">
		    <option <?php if($ta022 == '2') echo 'selected="selected"';?> value='2'>2應稅外加</option>
            <option <?php if($ta022 == '1') echo 'selected="selected"';?> value='1'>1應稅內含</option> 
            <option <?php if($ta022 == '3') echo 'selected="selected"';?> value='3'>3零稅率</option>
		    <option <?php if($ta022 == '4') echo 'selected="selected"';?> value='4'>4免稅</option>
            <option <?php if($ta022 == '9') echo 'selected="selected"';?> value='9'>9不計稅</option>				
		  </select></td>
		<td class="normal14">確認碼：</td>
        <td  class="normal14"  ><select id="ta019" onKeyPress="keyFunction()" name="ta019"  onchange="selappr(this)" tabIndex="17">
            <option <?php if($ta019 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($ta019 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
		  </select><span  id="approved" ></span></td>  
	    <td class="normal14" >列印次數：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="18"  readonly="value"  onKeyPress="keyFunction()" id="ta018" name="ta018" size="5"  value="<?php echo $ta018; ?>" style="background-color:#F5F5F5" /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >報價日期：</td>
        <td class="normal14b"  ><input type="text"   tabIndex="19"  readonly="value" onKeyPress="keyFunction()"   name="ta003" value="<?php echo $ta003; ?>" style="background-color:#F5F5F5"  /></td>
	     <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input tabIndex="20" id="ta015" readonly="value" onKeyPress="keyFunction()"  name="ta015" value="<?php echo $ta015; ?>" size="10" type="text" style="background-color:#F5F5F5"  /></td>
  
		 <td class="normal14">簽核狀態：</td>
        <td  class="normal14"  ><select id="ta029" tabIndex="21" readonly="value" onKeyPress="keyFunction()" name="ta029"   style="background-color:#F5F5F5" >
            <option <?php if($ta029 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($ta029 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($ta029 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($ta029 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($ta029 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($ta029 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($ta029 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($ta029 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
		 <td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" /></td>
         <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" /></td>
	  </tr>
	</table>
	
	  <div>
          <table id="order_product" class="list1">
            <thead>
              <tr>
                <td width="5%"></td>			
				<td width="11%" class="left">品號</td>
              <td width="15%" class="left">品名</td>
			  <td width="15%" class="left">規格</td>
			  <td width="6%" class="left">單位</td>
			  <td width="6%" class="center">序號</td>
			  <td width="10%" class="left">生效日期</td>
              <td width="6%" class="right">數量</td>
		      <td width="6%" class="right">單價</td>
			  <td width="6%" class="right">金額</td>
			  <td width="6%" class="center">毛重</td>
			  <td width="6%" class="center">材積</td>
			  <td width="6%" class="center">客戶品號</td>
			  <td width="14%" class="center">備註</td>						
              </tr>
            </thead>
      
    <!--   明細0  --> 
		<?php $i=0; $mproduct_row=0; $product_row='0'; ?>  
				<input id="row_count" name="row_count" value="0" style="display:none;" />
		<?php while ($i<$ii) { ?>
		<tbody   <?php echo    "id=product-row".$product_row ?> >		
	     <tr>
	 <!--    <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td> -->
           <td class="center"><img src="<?php echo base_url()?>assets/image/delete2.png" title="刪除資料" onclick="del_detail('<?php echo $copq03a21;?>','<?php echo $ta002; ?>','<?php echo $tb003[$i]; ?>');" /></td>  	  	    
		<input type="hidden"  name="order_product[<?php echo $i ?>][tb001]" value="<?php echo $tb001[$i]; ?>" />
	     <input type="hidden" name="order_product[<?php echo $i ?>][tb002]" value="<?php echo $tb002[$i]; ?>" />		 
	     <td class="left"><input type="text" onchange="startinvq02a(this,product_row)" tabIndex="14" <?php echo 'id='.'tb004'.$i ?>   name="order_product[<?php echo $i ?>][tb004]" value="<?php echo $tb004[$i]; ?>" size="20"  style="background-color:#E7EFEF" /></td>
	     <td class="left"><input  type="text" tabIndex="15" onKeyPress="keyFunction()"  id="tb005"  name="order_product[<?php echo $i ?>][tb005]" value="<?php echo $tb005[$i]; ?>"  style="background-color:#F5F5F5" /></td>
	     <td class="left"><input type="text" tabIndex="16" onKeyPress="keyFunction()"  id="tb006"   name="order_product[<?php echo $i ?>][tb006]" value="<?php echo $tb006[$i]; ?>"  size="30" style="background-color:#F5F5F5" /></td>
	     <td class="left"><input  type="text" tabIndex="17" onKeyPress="keyFunction()"    id="tb008"   name="order_product[<?php echo $i ?>][tb008]" value="<?php echo $tb008[$i]; ?>" size="6" style="background-color:#F5F5F5" /></td>
	     <td class="left"><input type="text"   readonly="value" tabIndex="18"  name="order_product[$i][tb003]" value="<?php echo $tb003[$i]; ?>" size="6" style="background-color:#F5F5F5" /></td>
		 <td class="left"><input type="text" tabIndex="19"  ondblclick="scwShow(this,event);"  id="tb016[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb016]" value="<?php echo  $tb016[$i]; ?>" size="10"   style="background-color:#E7EFEF" /></td>
	    <td class="left"><input type="text"  tabIndex="20" onchange="startcopq02a(this,product_row)"  class="total_qty" id="tb007"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb007]" value="<?php echo $tb007[$i]; ?>" size="10" style="text-align:right;"  /></td>
        <td class="left"><input type="text"  tabIndex="20" id="tb009"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb009]" value="<?php echo $tb009[$i]; ?>" size="10" style="text-align:right;"  /></td>        
		<td class="center"><input type="text"  tabIndex="21" class="total_price" id="tb010" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb010]" value="<?php echo $tb010[$i]; ?>" size="10" style="text-align:right;"  /></td>	
        <td class="left"><input type="text"  tabIndex="22" class="total_qty1" id="tb020"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb020]" value="<?php echo $tb020[$i]; ?>" size="10"  /></td>
		<td class="left"><input type="text"  tabIndex="23" class="total_qty2" id="tb021"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb021]" value="<?php echo $tb021[$i]; ?>" size="10"  /></td>
	    <td class="left"><input type="text"  tabIndex="24" id="tb018"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb018]" value="<?php echo $tb018[$i]; ?>" size="10"  /></td>
	    <td class="left"><input type="text"  tabIndex="25" id="tb012"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb012]" value="<?php echo $tb012[$i]; ?>" size="20"  /></td>
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
        echo "<script>$('#row_count').val(".$product_row.")</script>";	?>	
 <?php } ?>		
    <!-- javascrit 0 -->
	 
	<?php include("./application/views/fun/copi05_funjsupdjs_v.php"); ?> 
		 
		   <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
             <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			 <td class="left" colspan="15"></td>
            </tr>
			  
            </tfoot>
          </table>
        </div>
	
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  
	  <!-- 合計     -->
		     <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span>
				</span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　報價金額：</b></td>
				<td ><input type='text' readonly="value" name='ta009' id="ta009" size="8" value="<?php echo $ta009; ?>"  style="background-color:#F5F5F5" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta023' id="ta023" size="8" value="<?php echo $ta023; ?>"  style="background-color:#F5F5F5" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　合計金額：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot"><?php echo $ta009+$ta023; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　　總數量：</b></td>
				<td ><input type='text' readonly="value" name='ta025' id="ta025" size="8" value="<?php echo $ta025; ?>"  style="background-color:#F5F5F5" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　總毛重：</b></td>
				<td ><input type='text' readonly="value" name='ta027' id="ta027" size="8" value="<?php echo $ta027; ?>"  style="background-color:#F5F5F5" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　總材積：</b></td>
				<td ><input type='text' readonly="value" name='ta028' id="ta028" size="8" value="<?php echo $ta028; ?>"  style="background-color:#F5F5F5" /></td>
				
				
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	
	  <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cop/copi05/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div> 
	  <br>
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
<form action="<?php echo base_url()?>index.php/cop/copi05/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
 <?php include("./application/views/fun/copi05_funjsupd_v.php"); ?>