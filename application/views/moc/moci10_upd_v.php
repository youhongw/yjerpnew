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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 加工核價單建立作業 - 修改　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#tm001').focus();" type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('moc/moci10/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/moc/moci10/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php $ii=0; ?>
	<?php foreach($result as $row) { ?>
	  
          <?php   $purq04a36=$row->tm001;?>
		  <?php   $purq04a36disp=$row->tm001disp;?>
          <?php   $tm002=$row->tm002;?>
          <?php   $tm003=substr($row->tm003,0,4).'/'.substr($row->tm003,4,2).'/'.substr($row->tm003,6,2);?>
          <?php   $purq01a=$row->tm004;?>
		  <?php   $purq01adisp=$row->tm004disp;?>
          <?php   $cmsq06a=$row->tm005;?>
		  <?php   $cmsq06adisp=$row->tm005disp;?>
          <?php   $tm006=$row->tm006;?>
		  <?php   $tm007=$row->tm007;?>
		  <?php   $tm008=$row->tm008;?>
		  <?php   $tm009=$row->tm009;?>
		  <?php   $tm010=substr($row->tm010,0,4).'/'.substr($row->tm010,4,2).'/'.substr($row->tm010,6,2);?>
		  <?php   $tm011=$username;?>
          <?php   $tm012=$row->tm012;?>
         <?php   $flag=$row->flag;?>
         <?php   $ma025=$row->ma025;?>
         <?php   $ma026=$row->ma026;?>
		 
		 <!-- 明細 -->
		   
		   <?php   $tn001[]=$row->tn001;?>
		   <?php   $tn002[]=$row->tn002;?>
		   <?php   $tn003[]=$row->tn003;?>
		   <?php   $tn004[]=$row->tn004;?>
		   <?php   $tn005[]=$row->tn005;?>
		   <?php   $tn006[]=$row->tn006;?>
		   <?php   $tn007[]=$row->tn007;?>
		   <?php   $tn008[]=$row->tn008;?>
		   <?php   $tn009[]=$row->tn009;?>
		   <?php   $tn010[]=$row->tn010;?>
		   <?php  if ($row->tn011>'0') {$tn011[]=substr($row->tn011,0,4).'/'.substr($row->tn011,4,2).'/'.substr($row->tn011,6,2);}
              else {$tn011[]='';} ?>
		   <?php  if ($row->tn012>'0') {$tn012[]=substr($row->tn012,0,4).'/'.substr($row->tn012,4,2).'/'.substr($row->tn012,6,2);}
              else {$tn012[]='';} ?>
		   <?php   $tn013[]=$row->tn013;?>
			  
		  <?php   $mb991=' ';?>
		  <?php   $mb992=' ';?>
		  <?php   $mb999=' ';?>
	<?php $ii = $ii + 1 ; }?>
	
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="10%"><span class="required">加工核價單別：</span> </td>
        <td class="normal14a"  width="22%"><input tabIndex="1" id="tm001"    onKeyPress="keyFunction()" onfocus="selappr()" onChange="startpurq04a36(this)"  name="purq04a36" value="<?php echo strtoupper($purq04a36); ?>"  type="text" required /><a href="javascript:;"><img id="Showpurq04a36" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="purq04a36disp"> <?php    echo $purq04a36disp; ?> </span></td>
	    <td class="normal14y" width="10%" >單據日期： </td>
        <td class="normal14a"  width="24%" ><input tabIndex="2"  onclick="scwShow(this,event);"   id="tm010" onKeyPress="keyFunction()"  onchange="chkno1(this)" name="tm010"  value="<?php echo $tm010; ?>"  size="12" type="text" style="background-color:#E7EFEF"  /></td>
		<td class="normal14y" width="10%" ><span class="required">加工核價單號：</span> </td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="tm002" onKeyPress="keyFunction()" readonly="value" name="tm002" value="<?php echo $tm002; ?>" size="20" type="text" required /></td>
	  </tr>		
		  
	  <tr>
		<td class="normal14z">加工廠商：</td>
        <td  class="normal14"  ><input tabIndex="4" id="tm004" onKeyPress="keyFunction()"  onchange="startpurq01a(this)" name="purq01a" value="<?php echo $purq01a; ?>" size="10" type="text"  /><a href="javascript:;"><img id="Showpurq01a" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
        <span id="purq01adisp"> <?php echo $purq01adisp; ?> </span></td>	    
	    <td class="normal14z" >幣別：</td>
        <td class="normal14a" ><input tabIndex="5" id="tm005" onKeyPress="keyFunction()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
        <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span></td>
		<td class="normal14z" >備註：</td>
        <td class="normal14a" ><input  tabIndex="6"  id="tm007" onKeyPress="keyFunction()"   name="tm007"   value="<?php echo  $tm007; ?>" type="text"     /></td>
	  
	  </tr>
		<tr>
	    <td class="normal14z" >含稅：</td>
        <td class="normal14" ><input type="hidden" name="tm006" value="N" />
		<input type='checkbox' tabIndex="7" id="tm006"  readonly="value" onKeyPress="keyFunction()" name="tm006" <?php if($tm006 == 'Y' ) echo 'checked'; ?>  <?php if($tm006 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  /></td> 
		<td class="normal14z">確認碼：</td>
        <td  class="normal14"  ><select id="tm009" onKeyPress="keyFunction()" name="tm009"  onchange="selappr(this)" tabIndex="8">
            <option <?php if($tm009 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tm009 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tm009 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>  
	    <td class="normal14z" >列印次數：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="9"  readonly="value"  onKeyPress="keyFunction()" id="tm008" name="tm008" size="5"  value="<?php echo $tm008; ?>" style="background-color:#EBEBE4" /></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >核價日期：</td>
        <td class="normal14"  ><input type="text"   tabIndex="10"  readonly="value" onKeyPress="keyFunction()"   name="tm003" value="<?php echo $tm003; ?>" style="background-color:#EBEBE4"  /></td>
	     <td class="normal14z">確認者：</td>
        <td  class="normal14"  ><input tabIndex="11" id="tm011" readonly="value" onKeyPress="keyFunction()"  name="tm011" value="<?php echo $tm011; ?>" size="10" type="text" style="background-color:#EBEBE4"  /></td>
  
		 <td class="normal14z">簽核狀態：</td>
        <td  class="normal14"  ><select id="tm012" tabIndex="12" readonly="value" onKeyPress="keyFunction()" name="tm012"   style="background-color:#EBEBE4" >
            <option <?php if($tm012 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tm012 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($tm012 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tm012 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tm012 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tm012 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tm012 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tm012 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
		
	  </tr>
	  
	  <tr>
			<td class="normal14z" >價格條件：</td>
			<td class="normal14a" ><input  tabIndex="12"  id="ma026" readonly="value" onKeyPress="keyFunction()"   name="ma026"   value="<?php echo  $ma026; ?>" type="text"  style="background-color:#EBEBE4"   /></td>
	   
			<td class="normal14z" >付款條件：</td>
			<td class="normal14a" ><input  tabIndex="13"  id="ma025" readonly="value" onKeyPress="keyFunction()"   name="ma025"   value="<?php echo  $ma025; ?>" type="text"  style="background-color:#EBEBE4"   /></td>
	   </tr>
	</table>
	
	  <div>
          <table id="order_product" class="list1">
            <thead>
              <tr>
              <td width="5%"></td>			
		      <td width="11%" class="center">品號</td>
              <td width="15%" class="left">品名</td>
			  <td width="15%" class="left">規格</td>
			  <td width="6%" class="left">製程代號</td>
			  <td width="6%" class="center">單位</td>
			  <td width="6%" class="left">加工單價</td>
			  <td width="6%" class="left">損壞扣款</td>
              <td width="6%" class="center">生效日</td>
              <td width="6%" class="center">失效日</td>
			  <td width="14%" class="center">備註</td>				
            </tr>
            </thead>
      
    <!--   明細0  --> 
			<?php $i=0; $mproduct_row=0; $product_row='0'; ?>  
		    <input id="row_count" name="row_count" value="0" style="display:none;" />
			
		<?php while ($i<$ii) { ?>
		<tbody   <?php echo    "id=product-row".$product_row ?> >		
	     <tr>
	 <!--    <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td>   -->
         <td class="center"><img src="<?php echo base_url()?>assets/image/delete2.png" title="刪除資料" onclick="del_detail('<?php echo $purq04a36;?>','<?php echo $tm002; ?>','<?php echo $tn003[$i]; ?>');" /></td>  	      	    
		<input type="hidden"  name="order_product[<?php echo $i ?>][tn001]" value="<?php echo $tn001[$i]; ?>" />
	     <input type="hidden" name="order_product[<?php echo $i ?>][tn002]" value="<?php echo $tn002[$i]; ?>" />		 
	     <td class="left"><input type="text"  tabIndex="14" <?php echo 'id='.'tn004'.$i ?>   name="order_product[<?php echo $i ?>][tn004]" value="<?php echo $tn004[$i]; ?>" size="20" style="background-color:#E7EFEF"  /></td>
	     <td class="left"><input  type="text" tabIndex="15" onKeyPress="keyFunction()"  id="tn005"  name="order_product[<?php echo $i ?>][tn005]" readonly="value" value="<?php echo $tn005[$i]; ?>"  style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text" tabIndex="16" onKeyPress="keyFunction()"  id="tn006"   name="order_product[<?php echo $i ?>][tn006]" readonly="value" value="<?php echo $tn006[$i]; ?>"  size="30" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text" tabIndex="17" onKeyPress="keyFunction()"  id="tn007"   name="order_product[<?php echo $i ?>][tn007]" value="<?php echo $tn007[$i]; ?>"  size="6" /></td>
	     <td class="left"><input type="text" tabIndex="18" onKeyPress="keyFunction()"  id="tn008"   name="order_product[<?php echo $i ?>][tn008]" readonly="value" value="<?php echo $tn008[$i]; ?>"  size="6" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input  type="text" tabIndex="19" onKeyPress="keyFunction()"    id="tn009"   name="order_product[<?php echo $i ?>][tn009]" value="<?php echo $tn009[$i]; ?>" size="6"  /></td>
	     <td class="left"><input type="text"  tabIndex="20"  name="order_product[$i][tn010]" value="<?php echo $tn010[$i]; ?>"   /></td>
		 <td class="left"><input type="text" tabIndex="21"   ondblclick="scwShow(this,event);"  id="tn011[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tn011]" value="<?php echo  $tn011[$i]; ?>"  size="10"  style="background-color:#E7EFEF" /></td>
		 <td class="left"><input type="text" tabIndex="22"   ondblclick="scwShow(this,event);"  id="tn012[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tn012]" value="<?php echo  $tn012[$i]; ?>"  size="10"  style="background-color:#E7EFEF" /></td>
	    <td class="left"><input type="text"  tabIndex="23" id="tn013"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tn013]" value="<?php echo $tn013[$i]; ?>" size="25"  /></td>
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
	 
	<?php include_once("./application/views/fun/moci10_funjsupdjs_v.php"); ?> 
		 
		   <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
             <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			 <td class="left" colspan="11"></td>
            </tr>
			  
            </tfoot>
          </table>
        </div>
	
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	<!--  <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('moc/moci10/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div> -->
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
<form action="<?php echo base_url()?>index.php/moc/moci10/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
 <?php include_once("./application/views/fun/moci10_funjsupd_v.php"); ?>