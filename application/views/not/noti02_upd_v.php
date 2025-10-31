 <div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!--<div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 銀行存提款建立作業 - 修改　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#tf001').focus();" type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	  <a accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/not/noti02/updsave" method="post" enctype="multipart/form-data" >
	
	<div id="tab-general"> <!-- div-6 -->
	<?php $ii=0; ?>
	<?php foreach($result as $row) { ?>
          <?php   $tf001=$row->tf001;?>
          <?php   $tf002=$row->tf002;?>
		  <?php   $tf003=substr($row->tf003,0,4).'/'.substr($row->tf003,4,2).'/'.substr($row->tf003,6,2);?>
          <?php   $tf004=$row->tf004;?>
          <?php   $tf005=$row->tf005;?>
          <?php   $tf006=$row->tf006;?>
		  <?php   $tf007=$row->tf007;?>
		  <?php   $tf008=$row->tf008;?>
		  <?php   $tf009=$row->tf009;?>
		  <?php   $tf010=$row->tf010;?>
		  <?php   $tf011=substr($row->tf011,0,4).'/'.substr($row->tf011,4,2).'/'.substr($row->tf011,6,2);?>
		  <?php   $tf012=$row->tf012;?>
		  <?php   $tf013=$row->tf013;?>
		  <?php   $tf014=$row->tf014;?>
		  <?php   $tf015=$row->tf015;?>
		  <?php   $tf016=$row->tf016;?>
		  <?php   $tf017=$row->tf017;?>
		  <?php   $tf018=$row->tf018;?>
		  <?php   $ma002=$row->ma002;?>
		  <?php   $ma003=$row->ma003;?>
		  <?php   $ma004=$row->ma004;?>
		  <?php   $ma005=$row->ma005;?>
		  <?php   $ma011=$row->ma011;?>
		 <!-- 明細 -->
		   <?php   $tg002[]=$row->tg002;?>
		   <?php   $tg003[]=$row->tg003;?>
		   <?php   $tg004[]=$row->tg004;?>
		   <?php   $tg005[]=$row->tg005;?>
		   <?php   $tg006[]=$row->tg006;?>
		   <?php   $tg007[]=$row->tg007;?>
		   <?php   $tg008[]=$row->tg008;?>
		   <?php   $tg009[]=$row->tg009;?>
		   <?php   $tg011[]=$row->tg011;?>
		   <?php   $tg012[]=$row->tg012;?>
		   <?php   $tg013[]=$row->tg013;?>
		   <?php   $tg014[]=$row->tg014;?>
		   <?php   $tg015[]=$row->tg015;?>
		
		   <?php   $mf991=' ';?>
		   <?php   $mf992=' ';?>
		   <?php   $mf999=' ';?>
		    <?php   $flag=$row->flag;?>
	<?php $ii = $ii + 1 ; }?>
	
	<table class="form14"  >     <!-- 頭部表格 -->
	 <tr>
	    <td class="normal14y" width="10%" ><span class="required">存款單別：</span></td>
		<td class="start14a" width="23%" ><input tabIndex="1" id="tf001" onchange="startnoti06a(this)" onKeyPress="keyFunction()"  name="tf001" value="<?php echo $tf001; ?>" type="text" />
		<a href="javascript:;"><img id="Shownoti06a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		<span id="Shownoti06a_str" ></span></td>
		<td class="normal14a" width="10%" ><input type="checkbox" onKeyPress="keyFunction()" id="tf018" name="tf018" onchange="check_enable();" style="background-color:#EBEBE4"  />轉出碼</td>
		<td class="normal14a" width="23%"></td>
        <td class="normal14a" width="10%" ><input type="checkbox" onKeyPress="keyFunction()" id="ma011" name="ma011" onchange="check_enable();" style="background-color:#EBEBE4" />備償帳戶</td>
	    <td class="normal14a" width="24%"></td>
	  </tr>
	 <tr>
	    <td class="normal14z" >單據日期：</td>
        <td class="normal14" ><input tabIndex="3" id="tf011" onKeyPress="keyFunction()" name="tf011" onclick="scwShow(this,event);" value="<?php echo $tf011; ?>" />
		<img  onclick="scwShow(tf011,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		<td class="normal14z" >科目名稱：</td>
        <td class="normal14" ><input tabIndex="4" id="ma003" onKeyPress="keyFunction()" name="ma003" value="<?php echo $ma003; ?>" style="background-color:#EBEBE4" /></td>
	     <td class="normal14" ></td>
		<td class="normal14" ></td>
	  </tr>
	 <tr>
	    <td class="normal14z" >存提單號：</td>
        <td class="normal14" ><input tabIndex="1" id="tf002" onKeyPress="keyFunction()"  name="tf002" value="<?php echo $tf002; ?>" readonly="readonly" /></td>
		<td class="normal14z" >銀行存款科目：</td>
        <td class="normal14" ><input tabIndex="2" id="ma005" onKeyPress="keyFunction()" name="ma005" value="<?php echo $ma005; ?>"style="background-color:#EBEBE4" /></td>
	    <td class="normal14" ></td>
		<td class="normal14" ></td>
	  </tr>
	  
      
	  <tr>
		<td class="normal14z" >銀行代號：</td>
		<td class="normal14" ><input tabIndex="7" id="tf004" onchange="startnoti01a(this)" onKeyPress="keyFunction()" name="tf004" value="<?php echo $tf004; ?>"  />
		<a href="javascript:;"><img id="Shownoti01a" src="<?php echo base_url()?>assets/image/png/bank.png" alt="" align="top" /></span>
		<span id="Shownoti01a_str"></span></td>
        <td class="normal14z" >傳票單別：</td>
		<td class="normal14" ><input tabIndex="8" id="tf008" onKeyPress="keyFunction()" name="tf008" value="<?php echo $tf008; ?>" style="background-color:#EBEBE4"  /></td>
         <td class="normal14" ></td>
		<td class="normal14" ></td>
	  </tr>
	  <tr>
		<td class="normal14z" >銀行簡稱：</td>
        <td class="normal14" ><input tabIndex="9" id="ma002" onKeyPress="keyFunction()" name="ma002" value="<?php echo $ma002; ?>" style="background-color:#EBEBE4" /></td>
		<td class="normal14z" >傳票單號：</td>
        <td class="normal14" ><input tabIndex="10" id="tf009" onKeyPress="keyFunction()" name="tf009" value="<?php echo $tf009; ?>" style="background-color:#EBEBE4"  /></td>
	     <td class="normal14" ></td>
		<td class="normal14" ></td>
	  </tr>
	  <tr>
		<td class="normal14z" >帳　　號：</td>
        <td class="normal14" ><input tabIndex="11" id="ma004" onKeyPress="keyFunction()" name="ma004" value="<?php echo $ma004; ?>" style="background-color:#EBEBE4" /></td>
		<td class="normal14z" >存提日期：</td>
		<td class="normal14" ><input tabIndex="12" id="tf003" onKeyPress="keyFunction()" name="tf003" value="<?php echo $tf003; ?>" onclick="scwShow(this,event);" style="background-color:#EBEBE4"  /></td>
        
		<td class="normal14" ><input type="checkbox" onKeyPress="keyFunction()" id="tf016" name="tf016" onchange="check_enable();" <?php if($tf016) {echo "checked";} ?> style="background-color:#EBEBE4"  />產生分錄碼</td>
	    <td class="normal14" ></td>
	  </tr>
	  <tr>
		<td class="normal14z" ><span>幣　　別：</span></td>
		<td class="normal14" ><input tabIndex="13" id="tf005" onKeyPress="keyFunction()" name="tf005" value="<?php echo $tf005; ?>" />
		<a href="javascript:;"><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
		<span id="Showcmsq06a_str"></span></td>
		<td class="normal14z" >匯　　率：</td>
		<td class="normal14" ><input tabIndex="14" id="tf006" onKeyPress="keyFunction()" name="tf006" value="<?php echo $tf006; ?>" /></td>
		<td class="normal14z" >確  認  者：</td>
		<td class="normal14" ><input tabIndex="15" id="tf012" onKeyPress="keyFunction()" name="tf012" value="<?php echo $tf012; ?>" style="background-color:#EBEBE4"  /></td>
	  </tr>
	  <tr>
		<td class="normal14z" >備　　註：</td>
		<td class="normal14" colspan="3"><input tabIndex="16" id="tf007" onKeyPress="keyFunction()" name="tf007" value="<?php echo $tf007; ?>" size="80px" /></td>
		<td class="normal14z" >簽核狀態：</td>
		<td class="normal14" ><input tabIndex="17" id="tf017" onKeyPress="keyFunction()" name="tf017" value="<?php echo $tf017; ?>" style="background-color:#EBEBE4"  /></td>
        
	  </tr>
	</table>
	
	
	  <div>
          <table id="order_product" class="list1">
            <thead>
            <tr>
              <td width="5%"></td>			
		      <td width="10%" class="left">序號</td>
              <td width="10%" class="left">類別碼</td>
              <td width="10%" class="left">金額</td>
			  <td width="15%" class="left">轉帳對象</td>
			  <td width="10%" class="left">對象代號</td>
			  <td width="15%" class="left">對象簡稱</td>
			  <td width="15%" class="left">銀行行號</td>
			  <td width="15%" class="left">銀行帳號</td>
			  <td width="15%" class="left">對方科目</td>
			  <td width="15%" class="left">手續費</td>
			  <td width="15%" class="left">手續費負擔</td>
			  <td width="15%" class="left">備註</td> 		
			</tr>
            </thead>
      
    <!--   明細0  --> 
		<?php $i=0; $mproduct_row=0; $product_row='0'; ?>  
			 	<input id="row_count" name="row_count" value="0" style="display:none;" /> 
			 
		<?php while ($i<$ii) { ?>
		<tbody  <?php echo 'id='.'product-row'.$product_row ?> >		
	     <tr>
	     <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td>
  	     <input type="hidden"  name="order_product[<?php echo $i ?>][tg002]" value="<?php echo $tg002[$i]; ?>" />
		 <td class="left"><input type="text" tabIndex="17" id="tg003[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg003]" value="<?php if($tg003[$i]) echo $tg003[$i]; else echo"1000";?>" size="10" /></td>
		 <td class="left"><select tabIndex="18" id="tg004[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg004]" onchange="check_cash(this,<?php echo $i ?>,this.value);" ><option value="1" <?if($tg004[$i]==1) echo "selected='selected':";?> >1:現金</option><option value="2" <?if($tg004[$i]==2) echo "selected='selected':";?> >2:轉帳</option></select></td>
		 <td class="left"><input class="money" type="text"  tabIndex="18" id="tg008[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg008]" value="<?php echo $tg008[$i]; ?>" size="10" style="text-align:right;" /></td>
		 <td class="left"><select tabIndex="18" id="tg011[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg011]" ><option value="1">1:公司</option><option value="2" <?if($tg011[$i]==2) echo "selected='selected':";?> >2:廠商</option><option value="3" <?if($tg011[$i]==3) echo "selected='selected':";?> >3:人員</option><option value="9" <?if($tg011[$i]==9) echo "selected='selected':";?> >9:其他</option></select></td>
		 <td class="left"><input type="text"  tabIndex="18" id="tg005[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg005]" value="<?php echo $tg005[$i]; ?>" size="15" style="text-align:right;" <? if($tg004[$i]==2){echo 'ondblclick="noti01a(this, '.$i.' );"';}?> /></td>
		 <td class="left"><input type="text"  tabIndex="18" id="tg007[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg007]" value="<?php echo $tg007[$i]; ?>" size="15" style="text-align:right;" /></td>
		 <td class="left"><input type="text"  tabIndex="18" id="tg012[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg012]" value="<?php echo $tg012[$i]; ?>" size="15" style="text-align:right;" /></td>
		 <td class="left"><input type="text"  tabIndex="18" id="tg013[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg013]" value="<?php echo $tg013[$i]; ?>" size="20" style="text-align:right;" /></td>
		 <td class="left"><input type="text"  tabIndex="18" id="tg006[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg006]" value="<?php echo $tg006[$i]; ?>" size="20" style="text-align:right;" /></td>
		 <td class="left"><input type="text"  tabIndex="18" id="tg014[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg014]" value="<?php echo $tg014[$i]; ?>" size="10" style="text-align:right;" /></td>
		 <td class="left"><select tabIndex="18" id="tg015[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg015]" ><option value="1" <?if($tg015[$i]==1) echo "selected='selected':";?> >1:收款人負擔</option><option value="2" <?if($tg015[$i]==2) echo "selected='selected':";?> >2:付款人負擔</option></select></td>
		 <td class="left"><input type="text"  tabIndex="18" id="tg009[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg009]" value="<?php echo $tg009[$i]; ?>" size="20" style="text-align:right;" /></td>
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
	 
	<?php include("./application/views/fun/noti02_funjsupdjs_v.php"); ?> 
		 
		   <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
             <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			 <td class="left" colspan="12"></td>
            </tr>
			<input id="select_rows" style="display:none;"/>
            </tfoot>
          </table>
        </div>
	 </div>
		<!-- 合計     -->
		 <tr>
			<td class="center" valign="top"></td>
			<td colspan="2" class="right"><span></span></td>
			
			<td class="right" valign="top"><b style="color: #003A88;">　原幣合計：</b></td>
			<td ><input type='text' readonly="value" name='tf013' id="tf013" size="8" value="<?php echo $tf013; ?>"  style="background-color:#EBEBE4" /></td>
			<td class="right" valign="top"><b style="color: #003A88;">　　本國幣合計：</b></td>
			<td ><input type='text' readonly="value" name='tf014' id="tf014" size="8" value="<?php echo $tf014; ?>"  style="background-color:#EBEBE4" /></td>
			<td class="left" valign="top"></td>
		  </tr>
	<!-- 合計     -->
	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	<!--  <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>-->
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

 <?php include("./application/views/fun/noti02_funjsupd_v.php"); ?>