 <div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div> -->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content"> <!-- div-3 --> 
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 分錄底稿維護作業 - 修改　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#mb001').focus();" type='submit' onclick="return checkbalance();" accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ajs/ajsi20/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ajs/ajsi20/updsave" method="post" enctype="multipart/form-data" >
	
	<div id="tab-general"> <!-- div-6  009a 原庫存數量增減 -->
	<?php $ii=0; ?>
	<?php foreach($result as $row) { ?>
          <?php  $actq02a=$row->ta001;?> 
		  <?php  $actq02adisp=$row->ta001disp;?> 
		  <?php   $ta002=$row->ta002;?>    
          <?php   $ta003=substr($row->ta003,0,4).'/'.substr($row->ta003,4,2).'/'.substr($row->ta003,6,2);?>
		  <?php   $actq03a=$row->ta004;?> 
		  <?php   $actq03adisp=$row->ta004;?>
          <?php   $ta005=$row->ta005;?>
		 
		  <?php   $ta006=$row->ta006;?>    
		  <?php   $ta007=$row->ta007;?> 
		  <?php   $ta008=$row->ta008;?>
          <?php   $ta009=$row->ta009;?>
	      <?php   $ta010=$row->ta010;?>
		  <?php   $ta011=$row->ta011;?>
          <?php   $ta012=$row->ta012;?>
		  <?php   $ta013=$row->ta013;?>
		  <?php   $ta014=$row->ta014;?>
          <?php   $ta015=$row->ta015;?>
          <?php   $ta016=$row->ta016;?>
          <?php   $ta201=$row->ta201;?>
		  <?php   $uploadfile=$row->ta201;?>
		  <?php   $userfile=$row->ta201;?>
		  <?php $_FILES['userfile']['name']=$row->ta201;?>		  
		
	       <?php   $creator=$row->creator;?>
		   <?php   $create_date=$row->create_date;?>
		   <?php   $flag=$row->flag;?>	
		
		 <!-- 明細 -->
		   <?php   $tb001[]=$row->tb001;?>
		   <?php  $tb002[]=$row->tb002;?>
		   <?php   $tb003[]=$row->tb003;?>
		   <?php   $tb004[]=$row->tb004;?> 
		   <?php   $tb005[]=$row->tb005;?>
		   <?php   $tb005disp[]=$row->tb005disp;?>
		   <?php   $tb006[]=$row->tb006;?>
		   <?php   $tb006disp[]=$row->tb006disp;?>
		   <?php  // $tb007[]=number_format($row->tb007, 2, '.' ,',');?> 
           <?php   $tb007[]=$row->tb007;?>		   
		   <?php   $tb008[]=$row->tb008;?>
		
		   <?php   $tb010[]=$row->tb010;?> 
		   <?php   $tb011[]=$row->tb011;?> 
           <?php   $tb012[]=$row->tb012;?>
           <?php   $tb013[]=$row->tb013;?>		   
           <?php //  $tb014[]=number_format($row->tb014, 2, '.' ,',');?>  
		   <?php //  $tb015[]=number_format($row->tb015, 2, '.' ,',');?>  
		   <?php   $tb014[]=$row->tb014;?> 
           <?php   $tb015[]=$row->tb015;?> 				
           <?php   $tb016[]=$row->tb016;?> 		   
		   <?php   $tb017[]=$row->tb017;?> 
		   <?php   $tb018[]=$row->tb018;?> 
		   <?php   IF ($row->tb004=='1') {$tb0071[]=$row->tb007;$tb0072[]=0;} else  {$tb0072[]=$row->tb007;$tb0071[]=0;} ?> 
           <?php //  $tb0071[]=0;?> 	
           <?php //  $tb0072[]=0;?> 			   
		 
		  <?php   $mb991=' ';?>
		  <?php   $mb992=' ';?>
		  <?php   $mb999=' ';?>
	<?php $ii = $ii + 1 ; }?>
	
	<table class="form14"  >     <!-- 頭部表格 -->
	 <tr>
	    <td class="start14a"  width="10%"><span class="required">傳票單別：</span> </td>
        <td class="normal14a"  width="22%"><input tabIndex="1" id="ta001"    onKeyPress="keyFunction()" readonly="value" onfocus="selappr()" onChange="startactq02a(this)"  name="actq02a" value="<?php echo strtoupper($actq02a); ?>"  type="text" required /><a href="javascript:;"><img id="Showactq02a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="actq02adisp"> <?php    echo $actq02adisp; ?> </span></td>
	    <td class="normal14a" width="10%" >單據日期：</td>
        <td class="normal14a"  width="24%" ><input tabIndex="2"  onclick="scwShow(this,event);"   id="ta003" onKeyPress="keyFunction()"   name="ta003"  value="<?php echo $ta003; ?>"  size="12" type="text" style="background-color:#E7EFEF"  /></td>
		<td class="start14a" width="10%" ><span class="required">傳票單號：</span> </td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="ta002" onKeyPress="keyFunction()" readonly="value" name="ta002" value="<?php echo $ta002; ?>" size="20" type="text" required /><span id="ta002disp" ></span></td>
	  </tr>	
	  <tr>
		 <td class="normal14">收支科目：</td>
        <td  class="normal14"  ><input tabIndex="4" id="ta004" readonly="value" onKeyPress="keyFunction()" onfocus="chkno1(this)" onchange="startactq03a(this)" name="actq03a" value="<?php echo $actq03a; ?>" size="10" type="text"  style="background-color:#EBEBE4" /><a href="javascript:;"><img id="Showactq03a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="actq03adisp"> <?php echo $actq03adisp; ?> </span></td>
	     <td class="normal14" >總號：</td>
        <td class="normal14a" ><input tabIndex="5" id="ta005"   onKeyPress="keyFunction()"  name="ta005" value="<?php echo $ta005; ?>" size="10" type="text"   /></td>
		 <td class="normal14" >複製分類：</td>
        <td class="normal14a" ><input tabIndex="6" id="ta013"   onKeyPress="keyFunction()"  name="ta013" value="<?php echo $ta013; ?>" size="10" type="text"   /></td>
		
	  </tr>
	  <tr>
		 <td class="normal14">備註：</td>
        <td  class="normal14"  ><input tabIndex="7" id="ta009"   onKeyPress="keyFunction()"  name="ta009" value="<?php echo $ta009; ?>" size="20" type="text"   /></td>
	     <td class="normal14" >登入人員：</td>
        <td class="normal14a" ><input tabIndex="8" id="creator"  readonly="value" onKeyPress="keyFunction()"  name="creator" value="<?php echo $creator; ?>" size="10" type="text"   style="background-color:#EBEBE4" /></td>
		 <td class="normal14" >登入日期：</td>
        <td class="normal14a" ><input tabIndex="9" id="create_date"  readonly="value" onKeyPress="keyFunction()"  name="create_date" value="<?php echo $create_date; ?>" size="10" type="text"   style="background-color:#EBEBE4" /></td>
		
	  </tr>
	   <tr>
		 <td class="normal14">來源碼：</td>
        <td  class="normal14"  ><input tabIndex="10" id="ta006"  readonly="value" onKeyPress="keyFunction()"  name="ta006" value="<?php echo $ta006; ?>" size="10" type="text"  style="background-color:#EBEBE4" /></td>
	     <td class="normal14" >過帳碼：</td>
        <td class="normal14a" ><input type="hidden" name="ta011" value="N" />
		<input type='checkbox' tabIndex="11" id="ta011"  readonly="value" onKeyPress="keyFunction()" name="ta011" <?php if($ta011 == 'Y' ) echo 'checked'; ?>  <?php if($ta011 !== 'Y' ) echo 'check'; ?> value="Y" size="1" style="background-color:#EBEBE4" /></td> 
		 <td class="normal14" >列印次數：</td>
        <td class="normal14a" ><input tabIndex="12" id="ta012"  readonly="value" onKeyPress="keyFunction()"  name="ta012" value="<?php echo $ta012; ?>" size="10" type="text"   style="background-color:#EBEBE4" /></td>
		
	  </tr>
		
	  <tr>
	     <td class="normal14">確認碼：</td>
        <td  class="normal14"  ><select id="ta010" onKeyPress="keyFunction()" name="ta010" onChange="selappr(this)" tabIndex="13">
            <option <?php if($ta010 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($ta010 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($ta010 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>
	     <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input tabIndex="14" id="ta015" readonly="value" onKeyPress="keyFunction()"  name="ta015" value="<?php echo $ta015; ?>" size="10" type="text" style="background-color:#EBEBE4"  /></td>
  
		 <td class="normal14">簽核狀態：</td>
        <td  class="normal14"  ><select id="ta016" tabIndex="15" readonly="value" onKeyPress="keyFunction()" name="ta016"   style="background-color:#EBEBE4" >
            <option <?php if($ta016 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($ta016 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($ta016 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($ta016 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($ta016 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($ta016 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($ta016 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($ta016 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
	  </tr>	
	 <tr>
	    <td class="normal14" >確認日期：</td>
        <td class="normal14" ><input tabIndex="16" id="ta014" readonly="value"  onKeyPress="keyFunction()"  name="ta014" value="<?php echo $ta014; ?>" size="12" type="text" style="background-color:#EBEBE4"  /></td>
		<td class="normal14" ></td>						
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
			  <td width="6%" class="left">科目編號</td>  
			  <td width="6%" class="center">科目名稱</td>
			  <td width="6%" class="center">序號</td>
			  <td width="6%" class="center">部門代號</td>
              <td width="6%" class="right">部門名稱</td>
			   <td width="6%" class="center">幣別</td>
              <td width="6%" class="right">匯率</td>
			  <td width="6%" class="center">原幣金額</td>
			  <td width="6%" class="center">本幣金額</td>
			  <td width="6%" class="right">摘要</td>
			  <td width="6%" class="center">專案代號</td>
			  <td width="14%" class="center">備註</td>
			  
            </tr>
        </thead>
      
   	<!--   明細0  --> 
		<?php $i=0; $mproduct_row=0; $product_row='0'; ?>  
		<input id="row_count" name="row_count" value="0" style="display:none;" />	
		<?php while ($i<$ii) { ?>
		<tbody   <?php echo    "id=product-row".$product_row ?> >		  		
	     <tr>
    <!--  <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td>   
  	    <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td> -->
		 <td class="center"><img src="<?php echo base_url()?>assets/image/delete2.png" title="刪除資料" onclick="del_detail('<?php echo $actq02a;?>','<?php echo $ta002; ?>','<?php echo $tb003[$i]; ?>');" /></td>  	  
		<input type="hidden"  name="order_product[<?php echo $i ?>][tb001]" value="<?php echo $tb001[$i]; ?>" />
	     <input type="hidden" name="order_product[<?php echo $i ?>][tb002]" value="<?php echo $tb002[$i]; ?>" />
	     <input type="hidden"   name="order_product[<?php echo $i ?>][tb016]" value="<?php echo $tb016[$i]; ?>"  />
		 <input type="hidden"   name="order_product[<?php echo $i ?>][tb0071]" value="<?php echo $tb0071[$i]; ?>"  />
		 <input type="hidden"   name="order_product[<?php echo $i ?>][tb0072]" value="<?php echo $tb0072[$i]; ?>"  />
	     <td class="left"><select  id="tb004"  class="total_dc" name="order_product[<?php echo $i ?>][tb004]" ><option <?php if($tb004[$i] == '1') echo 'selected="selected"'; ?> value='1'>借</option><option <?php if($tb004[$i] == '-1') echo 'selected="selected"'; ?> value='-1'>貸</option></select></td> 
		 
		 <td class="left"><input type="text"  <?php echo 'id='.'tb005'.$i ?>   name="order_product[<?php echo $i ?>][tb005]" value="<?php echo $tb005[$i]; ?>" size="12" style="text-align:left;background-color:#E7EFEF;"   /></td>
	     <td class="left"><input  type="text"  onKeyPress="keyFunction()"    id="tb005disp"   name="order_product[<?php echo $i ?>][tb005disp]" value="<?php echo $tb005disp[$i]; ?>" size="12" style="background-color:#EBEBE4" /></td>
		 <td class="left"><input  type="text"  onKeyPress="keyFunction()"    id="tb003"   name="order_product[<?php echo $i ?>][tb003]" value="<?php echo $tb003[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
	 
	     <td class="left"><input type="text"  <?php echo 'id='.'tb006'.$i ?>   name="order_product[<?php echo $i ?>][tb006]" value="<?php echo $tb006[$i]; ?>" size="12"  style="text-align:right;background-color:#E7EFEF;"  /></td>
		 <td class="center"><input type="text"   id="tb006disp" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb006disp]" value="<?php echo $tb006disp[$i]; ?>" size="8" style="text-align:right;;background-color:#EBEBE4;" /></td>
        
		 <td class="right"><input readonly="value" type="text"  name="order_product[<?php echo $i ?>][tb013]" value="<?php echo $tb013[$i]; ?>" size="10" style="text-align:left;" /></td>
		 <td class="right"><input readonly="value" type="text"  name="order_product[<?php echo $i ?>][tb014]" value="<?php echo $tb014[$i]; ?>" size="10" style="text-align:right;" /></td>
		 <td class="right"><input  type="text" class="total_price" name="order_product[<?php echo $i ?>][tb015]" value="<?php echo $tb015[$i]; ?>" size="10" style="text-align:right;" /></td>
		 <td class="right"><input  type="text"  class="total_price1" name="order_product[<?php echo $i ?>][tb007]" value="<?php echo $tb007[$i]; ?>" size="10" style="text-align:right;" /></td>
	<!--	 <?php if($tb004[$i] == '1') echo '<input type="hidden"  class="total_price11"  name="order_product[<?php echo $i ?>][tb0071]" value="'.$tb007[$i].' "  />'; ?>
		 <?php if($tb004[$i] == '-1') echo '<input type="hidden"  class="total_price12"  name="order_product[<?php echo $i ?>][tb0072]" value="'.$tb007[$i].' "  />'; ?> -->
	     <input type="hidden"  class="total_price11" name="order_product[<?php echo $i ?>][tb0071]" value="<?php echo $tb0071[$i]; ?>"  />
		 <input type="hidden"  class="total_price12"   name="order_product[<?php echo $i ?>][tb0072]" value="<?php echo $tb0072[$i]; ?>"  />
		
		<td class="left"><input type="text" id="tb010"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb010]" value="<?php echo $tb010[$i]; ?>" size="30"  /></td>
		<td class="left"><input type="text" id="tb011"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb011]" value="<?php echo $tb011[$i]; ?>" size="10"  /></td>
		<td class="left"><input type="text" id="tb012"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tb012]" value="<?php echo $tb012[$i]; ?>" size="20"  /></td>
		
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
             echo "<script>$('#row_count').val(".$product_row.")</script>";?>
 <?php } ?>		 
    <!-- javascrit 0 -->
	 
	<?php include_once("./application/views/fun/ajsi20_funjsupdjs_v.php"); ?> 
		 
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
				
				<td class="right" valign="top"><b style="color: #003A88;">　　　　　總經理：</b></td>
				<td ><input type='text' readonly="value" name='ta015' id="ta015" size="12" value="<?php echo $ta015; ?>"   /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　　　主管：</b></td>
				<td ><input type='text' readonly="value" name='ta015' id="ta015" size="12" value="<?php echo $ta015; ?>"   /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　　　製表：</b></td>
				<td ><input type='text' readonly="value" name='ta015' id="ta015" size="12" value="<?php echo $ta015; ?>"   /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　　　請款人：</b></td>
				<td ><img src="<?php echo base_url();?>assets/image/jpg/<?php echo $uploadfile;?>" style="padding-top:5px"  id="ad" width="60" height="60" border="0" style="padding:5px"/></td>
				<td class="normal14">選擇印章：</td>
                <td class="normal14"><input type="file" name="userfile"  tabIndex="26" id="ta201"  onKeyPress="keyFunction()"  value="<?php echo $userfile; ?>"  size="30" onchange="pre_pic(this);" /></td>
		        <td class="normal14"><input type="hidden" name="MAX_FILE_SIZE" value="2000000"></td>
                <td class="normal14"></td>
				<br><br>
				
				
				<td class="right" valign="top"><b style="color: #003A88;">　　　　　本幣借方金額：</b></td>
				<td ><input type='text' readonly="value" name='ta007' id="ta007" size="8" value="<?php echo $ta007; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　　　本幣貸方金額：</b></td>
				<td ><input type='text' readonly="value" name='ta008' id="ta008" size="8" value="<?php echo $ta008; ?>"  style="background-color:#EBEBE4" /></td>
				<td style="display:none;"><input id="select_rows" />
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	
	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	 <!-- <div class="buttons">
	  <button type='submit' onclick="return checkbalance();" accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ajs/ajsi20/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
<form action="<?php echo base_url()?>index.php/ajs/ajsi20/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
 <?php include_once("./application/views/fun/ajsi20_funjsupd_v.php"); ?>