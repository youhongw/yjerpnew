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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 收款單資料建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('acr/acri03/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	  </div>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/acr/acri03/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php $i=0; ?>
		<?php $ii=0; ?>
	<?php foreach($result as $row) { ?>
         <?php $acrq01a63=$row->tc001;?> 
		  <?php $acrq01a63disp=$row->tc001disp;?> 
		  <?php  $tc002=$row->tc002;?>    
          <?php  $tc003=substr($row->tc003,0,4).'/'.substr($row->tc003,4,2).'/'.substr($row->tc003,6,2);?>
		  <?php  $copq01a=$row->tc004;?> 
		  <?php  $copq01adisp=$row->tc004disp;?>
          <?php  $cmsq06a=$row->tc005;?>
		  <?php  $cmsq06adisp=$row->tc005disp;?>
		  <?php  $tc006=$row->tc006;?>    
		  <?php  $tc007=$row->tc007;?> 
		  <?php  $tc008=$row->tc008;?>
          <?php  $tc009=$row->tc009;?>
	      <?php  $cmsq02a=$row->tc010;?>    
		  <?php  $cmsq02adisp=$row->tc010disp;?>  
		  <?php  $tc011=$row->tc011;?>
          <?php  $tc012=$row->tc012;?>
		  <?php  $tc013=$row->tc013;?>
		  <?php  $tc014=$row->tc014;?>
          <?php  $cmsq09a31=$row->tc015;?>  
	      <?php  $cmsq09a31disp=$row->tc015disp;?>  
          <?php  $tc016=$row->tc016;?>  
		  <?php  $tc017=substr($row->tc017,0,4).'/'.substr($row->tc017,4,2).'/'.substr($row->tc017,6,2);?> 
		  <?php  $tc018=$row->tc018;?>
		  <?php  $tc019=$row->tc019;?>	
	  
		   <?php  $flag=$row->flag;?>	
		
		 <!-- 明細 -->
		    <?php  $td001[]=$row->td001;?>
		   <?php $td002[]=$row->td002;?>
		   <?php  $td003[]=$row->td003;?>
		   <?php  $td004[]=$row->td004;?> 
		   <?php  $td005[]=$row->td005;?>
		   <?php  $td006[]=$row->td006;?>
		   <?php  $td007[]=$row->td007;?>  
		   <?php  $td008[]=$row->td008;?>
		   <?php  $td008disp[]=$row->td008disp;?>
		   <?php  $td009[]=substr($row->td009,0,4).'/'.substr($row->td009,4,2).'/'.substr($row->td009,6,2);?>
		   <?php  $td010[]=$row->td010;?> 
           <?php  $td010disp[]=$row->td010disp;?>		   
		   <?php  $td011[]=$row->td011;?> 
           <?php  $td012[]=$row->td012;?>
           <?php  $td013[]=$row->td013;?>		   
           <?php  $td014[]=$row->td014;?>   
		   <?php  $td015[]=$row->td015;?> 
           <?php  $td016[]=$row->td016;?> 		   
		   <?php  $td017[]=$row->td017;?> 
		   <?php  $td013a[]=$row->td013;?>
		   <?php  $td018[]=$row->td018;?> 		   
		   <?php  $td019[]=$row->td019;?> 
		    <?php  $td020[]=$row->td020;?> 		   
		   <?php  $td021[]=$row->td021;?> 
		  
		  <?php  $mb991=' ';?>
		  <?php  $mb992=' ';?>
		  <?php  $mb999=' ';?>
		
	<?php $ii = $ii + 1 ; }?>
      
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="normal14y"  width="10%"><span class="required">收款單別：</span> </td>
        <td class="normal14a"  width="22%"><input tabIndex="1" id="tc001"    onKeyPress="keyFunction()"   name="acrq01a63" value="<?php echo strtoupper($acrq01a63); ?>"  type="text" required disabled="disabled"/><a href="javascript:;"><img id="Showacrq01a63test" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="acrq01a63disp"> <?php    echo $acrq01a63disp; ?> </span></td>
	    <td class="normal14y" width="10%" >單據日期： </td>
        <td class="normal14a"  width="24%" ><input tabIndex="2"  onclick="scwShow(this,event);"  class="date" id="tc017" onKeyPress="keyFunction()"  onchange="chkno1(this)" name="tc017"  value="<?php echo $tc017; ?>"  size="12" type="text"  disabled="disabled" /></td>
		<td class="normal14y" width="10%" ><span class="required">收款單號：</span> </td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="tc002" onKeyPress="keyFunction()" name="tc002" value="<?php echo $tc002; ?>" size="20" type="text" required disabled="disabled"/><span id="tc002disp" ></span></td>
	  </tr>	
	  <tr>
	    
		 <td class="normal14z">客戶代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="tc004" onKeyPress="keyFunction()"  onchange="startcopq01a(this)" name="copq01a" value="<?php echo $copq01a; ?>" size="10" type="text" disabled="disabled" /><a href="javascript:;"><img id="Showcopq01a" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
         <span id="copq01adisp"> <?php echo $copq01adisp; ?> </span></td>
	     <td class="normal14z" >廠別：</td>
        <td class="normal14a" ><input  tabIndex="5"  id="tc010" onKeyPress="keyFunction()"  onchange="startcmsq02a(this)" name="cmsq02a"   value="<?php echo  $cmsq02a; ?>" type="text"   disabled="disabled"  /><a href="javascript:;"><img id="Showcmsq02a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	   <span id="cmsq02adisp"> <?php    echo $cmsq02adisp; ?> </span></td>
		 <td class="normal14z" >幣別：</td>
        <td class="normal14a" ><input tabIndex="6" id="tc005" onKeyPress="keyFunction()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text"  disabled="disabled" /><a href="javascript:;"><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span></td>
		
	  </tr>
		<tr>
	    <td class="normal14z" >備註：</td>
        <td class="normal14" ><input tabIndex="7" id="tc007"   onKeyPress="keyFunction()"  name="tc007" value="<?php echo $tc007; ?>" size="30" type="text" disabled="disabled"  /></td>
		<td class="normal14z" >收款業務員：</td>
        <td class="normal14" ><input tabIndex="8" id="tc015" onKeyPress="keyFunction()" name="cmsq09a31" onchange="startcmsq09a31(this)"  value="<?php echo $cmsq09a31; ?>"  type="text" disabled="disabled"  /><a href="javascript:;"><img id="Showcmsq09a31" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
        <span id="cmsq09a31disp"> <?php    echo $cmsq09a31disp; ?> </span></td>
		<td class="normal14z">確認碼：</td>
        <td  class="normal14"  ><select id="tc008" onKeyPress="keyFunction()" name="tc008" onChange="selappr(this)" tabIndex="9" disabled="disabled">
            <option <?php if($tc008 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tc008 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tc008 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>
	    
	  </tr>
	  <tr>
	     <td class="normal14z">產生分錄：</td>
        <td  class="normal14"  ><input type="hidden" name="tc016" value="N" />
		<input type='checkbox' tabIndex="11" id="tc016"  readonly="value" onKeyPress="keyFunction()" name="tc016" <?php if($tc016 == 'Y' ) echo 'checked'; ?>  <?php if($tc016 !== 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled" /></td> 
	     <td class="normal14z">確認者：</td>
        <td  class="normal14"  ><input tabIndex="12" id="tc018" readonly="value" onKeyPress="keyFunction()"  name="tc018" value="<?php echo $tc018; ?>" size="10" type="text" style="background-color:#EBEBE4" disabled="disabled" /></td>
  
		 <td class="normal14z">簽核狀態：</td>
        <td  class="normal14"  ><select id="tc019" tabIndex="13" readonly="value" onKeyPress="keyFunction()" name="tc019"   style="background-color:#EBEBE4" disabled="disabled" >
            <option <?php if($tc019 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tc019 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($tc019 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tc019 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tc019 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tc019 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tc019 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tc019 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
	  </tr>	
	 <tr>
	    <td class="normal14z" >收款日期：</td>
        <td class="normal14" ><input tabIndex="14" id="tc003" readonly="value"  onKeyPress="keyFunction()"  name="tc003" value="<?php echo $tc003; ?>" size="12" type="text" style="background-color:#EBEBE4" disabled="disabled" /></td>
		<td class="normal14z" >列印次數：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="15"  readonly="value"  onKeyPress="keyFunction()" id="tc006" name="tc006" size="5"  value="<?php echo $tc006; ?>" style="background-color:#EBEBE4" disabled="disabled"/></td> 
	    <td class="normal14" ></td>						
        <td  class="normal14"  ></td>
	  </tr>
		
	</table>
	
	<div class="abgne_tab"> <!-- div-7 -->
		
	
	  <div style="width:100%; overflow-x: auto;  ">
        <table style="width:100%;"  id="order_product" class="list1">
        <thead>
            <tr>
              <td width="3%"></td>			
		      <td width="11%" class="center">借貸</td>
              <td width="6%" class="left">類別</td>
			  <td width="6%" class="left">來源單別</td>  
			  <td width="6%" class="center">來源單號</td>
			  <td width="6%" class="center">序號</td>
			  <td width="6%" class="right">會計科目</td>
              <td width="6%" class="right">科目名稱</td>
			  <td width="6%" class="center">幣別</td>
              <td width="6%" class="right">匯率</td>
			  <td width="6%" class="center">立帳金額</td>
			  <td width="6%" class="right">立帳餘額</td>
			  <td width="6%" class="center">原幣金額</td>
			  <td width="6%" class="center">本幣金額</td>
			  <td width="6%" class="right">到期日期</td>
			  <td width="6%" class="center">參考單號</td>
			  <td width="14%" class="center">備註</td>
            </tr>
        </thead>
      
   	<!--   明細0  --> 
		<?php $i=0; $mproduct_row=0; $product_row='0'; ?>  
			 
		<?php while ($i<$ii) { ?>
		<tbody   <?php echo    "id=product-row".$product_row ?> >		  		
	     <tr>
	     <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td>
  	     <input type="hidden"  name="order_product[<?php echo $i ?>][td001]" value="<?php echo $td001[$i]; ?>" />
	     <input type="hidden" name="order_product[<?php echo $i ?>][td002]" value="<?php echo $td002[$i]; ?>" />
	     <input type="hidden"   name="order_product[<?php echo $i ?>][td013a]" value="<?php echo $td013a[$i]; ?>"  />
	     <td class="left"><select  id="td004" disabled="disabled" name="order_product[<?php echo $i ?>][td004]" ><option <?php if($td004[$i] == '1') echo 'selected="selected"'; ?> value='1'>借</option><option <?php if($td004[$i] == '-1') echo 'selected="selected"'; ?> value='-1'>貸</option></select></td> 
		 <td class="left"><select  id="td005" disabled="disabled" name="order_product[<?php echo $i ?>][td005]" ><option <?php if($td005[$i] == '1') echo 'selected="selected"'; ?> value='1'>1一般</option><option <?php if($td005[$i] == '2') echo 'selected="selected"'; ?> value='2'>2.票據</option><option <?php if($td005[$i] == '3') echo 'selected="selected"'; ?> value='3'>3.待抵</option><option <?php if($td005[$i] == '4') echo 'selected="selected"'; ?> value='4'>4.沖帳</option><option <?php if($td005[$i] == '5') echo 'selected="selected"'; ?> value='5'>5.溢收</option><option <?php if($td005[$i] == '6') echo 'selected="selected"'; ?> value='6'>6.差額</option><option <?php if($td005[$i] == '7') echo 'selected="selected"'; ?> value='7'>7.折讓</option><option <?php if($td005[$i] == '8') echo 'selected="selected"'; ?> value='8'>8.應收票據轉付</option></select></td>
		 <td class="left"><input type="text" disabled="disabled" <?php echo 'id='.'td006'.$i ?>   name="order_product[<?php echo $i ?>][td006]" value="<?php echo $td006[$i]; ?>" size="12" style="text-align:right;background-color:#E7EFEF;"  disabled="disabled" /></td>
	    
	     <td class="left"><input  type="text"  onKeyPress="keyFunction()"    id="td007"   name="order_product[<?php echo $i ?>][td007]" value="<?php echo $td007[$i]; ?>" size="12" disabled="disabled" /></td>
		 <td class="left"><input  type="text"  onKeyPress="keyFunction()"    id="td003"   name="order_product[<?php echo $i ?>][td003]" value="<?php echo $td003[$i]; ?>" size="6" style="background-color:#EBEBE4" disabled="disabled" /></td>
	  <!--   <td class="left"><input type="text"   readonly="value"   name="order_product[$i][td003]" value="<?php echo $td003[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>  -->
	     <td class="left"><input type="text"  <?php echo 'id='.'td008'.$i ?>   name="order_product[<?php echo $i ?>][td008]" value="<?php echo $td008[$i]; ?>" size="12"  style="text-align:right;background-color:#E7EFEF;" disabled="disabled" /></td>
		 <td class="center"><input type="text"   id="td008disp" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][td008disp]" value="<?php echo $td008disp[$i]; ?>" size="8" style="text-align:right;;background-color:#EBEBE4;"  disabled="disabled"/></td>
		 <td class="center"><input type="text"   id="td010" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][td010]" value="<?php echo $td010[$i]; ?>" size="5" style="text-align:right;background-color:#EBEBE4;" disabled="disabled" /></td>
         <td class="right"><input readonly="value" type="text"  name="order_product[<?php echo $i ?>][td011]" value="<?php echo $td011[$i]; ?>" size="6" style="text-align:right;" disabled="disabled"/></td>
		 <td class="right"><input readonly="value" type="text"  name="order_product[<?php echo $i ?>][td012]" value="<?php echo $td012[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" disabled="disabled"/></td>
		 <td class="right"><input readonly="value" type="text"  name="order_product[<?php echo $i ?>][td013]" value="<?php echo $td013[$i]; ?>" size="6" style="text-align:right;background-color:#EBEBE4;" disabled="disabled" /></td>
		 <td class="right"><input  type="text" class="total_price" name="order_product[<?php echo $i ?>][td014]" value="<?php echo $td014[$i]; ?>" size="10" style="text-align:right;" disabled="disabled"/></td>
		 <td class="right"><input  type="text" class="total_price1" name="order_product[<?php echo $i ?>][td015]" value="<?php echo $td015[$i]; ?>" size="10" style="text-align:right;" disabled="disabled"/></td>
		 <td class="right"><input readonly="value" type="text"  name="order_product[<?php echo $i ?>][td009]" value="<?php echo $td009[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;"  disabled="disabled"/></td>
	    
		<td class="left"><input type="text" id="td016"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][td016]" value="<?php echo $td016[$i]; ?>" size="10" disabled="disabled" /></td>
		<td class="left"><input type="text" id="td017"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][td017]" value="<?php echo $td017[$i]; ?>" size="20" disabled="disabled" /></td>
		
	     </tr>	      
        </tbody>
        <?php $i++; $mproduct_row = (int) $product_row + 1; $product_row=(string)$mproduct_row;?>
 
 <?php } ?>		 
    <!-- javascrit 0 -->
	 
	<?php include("./application/views/fun/acri03_funjsupdjs_v.php"); ?> 
		
                  <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
              <tr>
                <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
				<td class="left" colspan="16"></td>
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
				</span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">原幣借方金額：</b></td>
				<td ><input type='text' readonly="value" name='tc011' id="tc011" size="8" value="<?php echo $tc011; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　原幣貸方金額：</b></td>
				<td ><input type='text' readonly="value" name='tc012' id="tc012" size="8" value="<?php echo $tc012; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　差額：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot"><?php echo $tc011-$tc012; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　本幣借方金額：</b></td>
				<td ><input type='text' readonly="value" name='tc013' id="tc013" size="8" value="<?php echo $tc013; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　本幣貸方金額：</b></td>
				<td ><input type='text' readonly="value" name='tc014' id="tc014" size="8" value="<?php echo $tc014; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　差額：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot1"><?php echo $tc013-$tc014; ?></span></b></td>
				
				
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->
	<!--<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('acr/acri03/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
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
