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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 付款單資料建立作業 - 修改　　　</h1>
      <button style= "cursor:pointer" form="commentForm" onfocus="$('#tc001').focus();" type='submit' type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('acp/acpi03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/acp/acpi03/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general"> <!-- div-6  009a 原庫存數量增減 -->
	<?php $ii=0; ?>
	<?php foreach($result as $row) { ?>
           <?php $acpq01a73=$row->tc001;?> 
		  <?php  $tc002=$row->tc002;?>    
          <?php  $tc003=substr($row->tc003,0,4).'/'.substr($row->tc003,4,2).'/'.substr($row->tc003,6,2);?>
		  <?php  $purq01a=$row->tc004;?> 
          <?php  $cmsq06a=$row->tc005;?>
		  <?php  $tc006=$row->tc006;?>    
		  <?php  $tc007=$row->tc007;?> 
		  <?php  $tc008=$row->tc008;?>
          <?php  $tc009=$row->tc009;?>
	      <?php  $cmsq02a=$row->tc010;?>    
		  <?php  $tc011=$row->tc011;?>
          <?php  $tc012=$row->tc012;?>
		  <?php  $tc013=$row->tc013;?>
		  <?php  $tc014=$row->tc014;?>
          <?php  $tc015=$row->tc015;?>  
          <?php  $tc016=substr($row->tc016,0,4).'/'.substr($row->tc016,4,2).'/'.substr($row->tc016,6,2);?> 
		  <?php  $tc017=$row->tc017;?>
		  <?php  $tc018=$row->tc018;?>
		 
		  <?php $acpq01a73disp=$row->tc001disp;?> 
          <?php  $purq01adisp=$row->tc004disp;?>
		  <?php  $cmsq06adisp=$row->tc005disp;?> 
		  <?php  $cmsq02adisp=$row->tc010disp;?>		
	  
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
		   <?php  if($row->td009>'0') {$td009[]=substr($row->td009,0,4).'/'.substr($row->td009,4,2).'/'.substr($row->td009,6,2);}
		         else {$td009[]='';} ?>
		   <?php  $td010[]=$row->td010;?>  
		   <?php  $td011[]=$row->td011;?> 
           <?php  $td012[]=$row->td012;?>
           <?php  $td013[]=$row->td013;?>		   
           <?php  $td014[]=$row->td014;?>   
		   <?php  $td015[]=$row->td015;?> 
           <?php  $td016[]=$row->td016;?> 		   
		   <?php  $td017[]=$row->td017;?> 
		   <?php  $td013a[]=$row->td013;?>
		  
		  <?php  $mb991=' ';?>
		  <?php  $mb992=' ';?>
		  <?php  $mb999=' ';?>
	<?php $ii = $ii + 1 ; }?>
	
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="8%"><span class="required">付款單別：</span> </td>
        <td class="normal14a"  width="24%"><input tabIndex="1" id="tc001"    onKeyPress="keyFunction()" readonly="value" onfocus="selappr()" onChange="startacpq01a73(this)"  name="acpq01a73" value="<?php echo strtoupper($acpq01a73); ?>"  type="text" required /><a href="javascript:;"><img id="Showacpq01a73" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="acpq01a73disp"> <?php    echo $acpq01a73disp; ?> </span></td>
	    <td class="normal14y" width="8%" >單據日期： </td>
        <td class="normal14a"  width="26%" ><input tabIndex="2"  ondblclick="scwShow(this,event);" onchange="dataymd1(this)"   id="tc016" onKeyPress="keyFunction()"   name="tc016"  value="<?php echo $tc016; ?>"  size="12" type="text" style="background-color:#E7EFEF"  /></td>
		<td class="start14a" width="8%" ><span class="required">付款單號：</span> </td>
        <td class="normal14a"  width="26%" ><input tabIndex="3" id="tc002" onKeyPress="keyFunction()" readonly="value" name="tc002" value="<?php echo $tc002; ?>" size="20" type="text" required /><span id="tc002disp" ></span></td>
	  </tr>	
	  <tr>
	    
		 <td class="normal14z">供應廠商：</td>
        <td  class="normal14"  ><input tabIndex="4" id="tc004" onKeyPress="keyFunction()"  onchange="startpurq01a(this)" name="purq01a" value="<?php echo $purq01a; ?>" size="10" type="text"  /><a href="javascript:;"><img id="Showpurq01a" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
         <span id="purq01adisp"> <?php echo $purq01adisp; ?> </span></td>
	     <td class="normal14z" >廠別：</td>
        <td class="normal14a" ><input  tabIndex="5"  id="tc010" onKeyPress="keyFunction()"  onchange="startcmsq02a(this)" name="cmsq02a"   value="<?php echo  $cmsq02a; ?>" type="text"     /><a href="javascript:;"><img id="Showcmsq02a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	   <span id="cmsq02adisp"> <?php    echo $cmsq02adisp; ?> </span></td>
		 <td class="normal14z" >幣別：</td>
        <td class="normal14a" ><input tabIndex="6" id="tc005" onKeyPress="keyFunction()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span></td>
		
	  </tr>
		<tr>
	    <td class="normal14z" >備註：</td>
        <td class="normal14" ><input tabIndex="7" id="tc007"   onKeyPress="keyFunction()"  name="tc007" value="<?php echo $tc007; ?>" size="30" type="text"   /></td>
		<td class="normal14z">確認碼：</td>
        <td  class="normal14"  ><select id="tc008" onKeyPress="keyFunction()" name="tc008"  onchange="selappr(this)" tabIndex="8">
            <option <?php if($tc008 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tc008 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
		  </select><span  id="approved" ></span></td>  
	    <td class="normal14z" >列印次數：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="10"  readonly="value"  onKeyPress="keyFunction()" id="tc006" name="tc006" size="5"  value="<?php echo $tc006; ?>" style="background-color:#EBEBE4" /></td>
	  </tr>
	  <tr>
	     <td class="normal14z">產生分錄：</td>
        <td  class="normal14"  ><input type="hidden" name="tc015" value="N" />
		<input type='checkbox' tabIndex="11" id="tc015"  readonly="value" onKeyPress="keyFunction()" name="tc015" <?php if($tc015 == 'Y' ) echo 'checked'; ?>  <?php if($tc015 !== 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled" /></td> 
	     <td class="normal14z">確認者：</td>
        <td  class="normal14"  ><input tabIndex="12" id="tc017" readonly="value" onKeyPress="keyFunction()"  name="tc017" value="<?php echo $tc017; ?>" size="10" type="text" style="background-color:#EBEBE4"  /></td>
  
		 <td class="normal14z">簽核狀態：</td>
        <td  class="normal14"  ><select id="tc018" tabIndex="12" readonly="value" onKeyPress="keyFunction()" name="tc018"   style="background-color:#EBEBE4" >
            <option <?php if($tc018 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tc018 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($tc018 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tc018 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tc018 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tc018 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tc018 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tc018 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
	  </tr>	
		 <tr>
	    <td class="normal14z" >付款日期：</td>
        <td class="normal14" ><input tabIndex="13" id="tc003" readonly="value"  onKeyPress="keyFunction()"  name="tc003" value="<?php echo $tc003; ?>" size="12" type="text" style="background-color:#EBEBE4"  /></td>
		<td class="normal14"></td>
        <td  class="normal14"  ></td>  
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
			<input id="row_count" name="row_count" value="0" style="display:none;" />
		<?php while ($i<$ii) { ?>
		<tbody   <?php echo    "id=product-row".$product_row ?> >		  		
	     <tr>
    <!--  <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td>   -->
  	<!--    <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td> -->
		<td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="刪除資料" onclick="del_detail('<?php echo $acpq01a73;?>','<?php echo $tc002; ?>','<?php echo $td003[$i]; ?>');" /></td>  
		<input type="hidden"  name="order_product[<?php echo $i ?>][td001]" value="<?php echo $td001[$i]; ?>" />
	     <input type="hidden" name="order_product[<?php echo $i ?>][td002]" value="<?php echo $td002[$i]; ?>" />
	     <input type="hidden"   name="order_product[<?php echo $i ?>][td013a]" value="<?php echo $td013a[$i]; ?>"  />
	     <td class="left"><select  id="td004" class="total_dc"  name="order_product[<?php echo $i ?>][td004]" ><option <?php if($td004[$i] == '1') echo 'selected="selected"'; ?> value='1'>借</option><option <?php if($td004[$i] == '-1') echo 'selected="selected"'; ?> value='-1'>貸</option></select></td> 
		 <td class="left"><select  id="td005"  name="order_product[<?php echo $i ?>][td005]" ><option <?php if($td005[$i] == '1') echo 'selected="selected"'; ?> value='1'>1一般</option><option <?php if($td005[$i] == '2') echo 'selected="selected"'; ?> value='2'>2.票據</option><option <?php if($td005[$i] == '3') echo 'selected="selected"'; ?> value='3'>3.待抵</option><option <?php if($td005[$i] == '4') echo 'selected="selected"'; ?> value='4'>4.沖帳</option><option <?php if($td005[$i] == '5') echo 'selected="selected"'; ?> value='5'>5.溢收</option><option <?php if($td005[$i] == '6') echo 'selected="selected"'; ?> value='6'>6.差額</option><option <?php if($td005[$i] == '7') echo 'selected="selected"'; ?> value='7'>7.折讓</option><option <?php if($td005[$i] == '8') echo 'selected="selected"'; ?> value='8'>8.應收票據轉付</option><option <?php if($td005[$i] == 'd') echo 'selected="selected"'; ?> value='d'>d.刪除</option></select></td>
		 <td class="left"><input type="text"  <?php echo 'id='.'td006'.$i ?>   name="order_product[<?php echo $i ?>][td006]" value="<?php echo $td006[$i]; ?>" size="12" style="text-align:left;background-color:#E7EFEF;"   /></td>
	    
	     <td class="left"><input  type="text"  onKeyPress="keyFunction()"    id="td007"   name="order_product[<?php echo $i ?>][td007]" value="<?php echo $td007[$i]; ?>" size="12"  /></td>
		 <td class="left"><input  type="text"  onKeyPress="keyFunction()"    id="td003"   name="order_product[<?php echo $i ?>][td003]" value="<?php echo $td003[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
	  <!--   <td class="left"><input type="text"   readonly="value"   name="order_product[$i][td003]" value="<?php echo $td003[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>  -->
	     <td class="left"><input type="text"  <?php echo 'id='.'td008'.$i ?>   name="order_product[<?php echo $i ?>][td008]" value="<?php echo $td008[$i]; ?>" size="12"  style="text-align:right;background-color:#E7EFEF;"  /></td>
		 <td class="center"><input type="text"   id="td008disp" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][td008disp]" value="<?php echo $td008disp[$i]; ?>" size="8" style="text-align:right;background-color:#EBEBE4;" /></td>
		 <td class="center"><input type="text"   id="td010" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][td010]" value="<?php echo $td010[$i]; ?>" size="5" style="text-align:right;background-color:#EBEBE4;" /></td>
         <td class="right"><input  type="text"  name="order_product[<?php echo $i ?>][td011]" value="<?php echo $td011[$i]; ?>" size="10" style="text-align:right;" /></td>
		 <td class="right"><input readonly="value" type="text"  name="order_product[<?php echo $i ?>][td012]" value="<?php echo $td012[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" /></td>
		 <td class="right"><input readonly="value" type="text"  name="order_product[<?php echo $i ?>][td013]" value="<?php echo $td013[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" /></td>
		 <td class="right"><input  type="text" class="total_price" name="order_product[<?php echo $i ?>][td014]" value="<?php echo $td014[$i]; ?>" size="10" style="text-align:right;" /></td>
		 <td class="right"><input  type="text" class="total_price1" name="order_product[<?php echo $i ?>][td015]" value="<?php echo $td015[$i]; ?>" size="10" style="text-align:right;" /></td>
		 <td class="right"><input  type="text" onclick="scwShow(this,event);" name="order_product[<?php echo $i ?>][td009]" value="<?php echo $td009[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" /></td>
	    
		<td class="left"><input type="text" id="td016"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][td016]" value="<?php echo $td016[$i]; ?>" size="10"  /></td>
		<td class="left"><input type="text" id="td017"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][td017]" value="<?php echo $td017[$i]; ?>" size="20"  /></td>
		
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
	 
	<?php include_once("./application/views/fun/acpi03_funjsupdjs_v.php"); ?> 
		 
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
	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	 <!-- <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('acp/acpi03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div> -->
	  </div> <!-- div-加 -->
    </form>
	
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 有底色欄位,可輸入部份欄位資料下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

 
    </div> <!-- div-3 --> 
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
<form action="<?php echo base_url()?>index.php/acp/acpi03/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
 <?php include_once("./application/views/fun/acpi03_funjsupd_v.php"); ?>