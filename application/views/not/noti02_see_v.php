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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 銀行存提款建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti02/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	  </div>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/not/noti02/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>
	<div id="tab-general"> <!-- div-6 -->
	<?php $i=0; ?>
	<?php foreach($result as $row) { ?>
          <?php   $tf001=$row->tf001;?>
          <?php   $tf002=$row->tf002;?>
		  <?php   $tf003=$row->tf003;?>
          <?php   $tf004=$row->tf004;?>
          <?php   $tf005=$row->tf005;?>
          <?php   $tf006=$row->tf006;?>
		  <?php   $tf007=$row->tf007;?>
		  <?php   $tf008=$row->tf008;?>
		  <?php   $tf009=$row->tf009;?>
		  <?php   $tf010=$row->tf010;?>
		  <?php   $tf011=$row->tf011;?>
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
	<?php $i = $i + 1 ; }?>
      
	<table class="form14"  >     <!-- 頭部表格 disabled="disabled" -->
	  <tr>
	    <td class="normal14y" width="10%" ><span class="required">存款單別：</span> </td>
        <td class="normal14a" width="23%"><input tabIndex="1" id="tf001" onKeyPress="keyFunction()" onchange="startnoti02a(this)" name="tf001" value="<?php echo $tf001; ?>"  type="text" disabled="disabled" /></td>
        <td class="normal14a" width="10%" ><input type="checkbox" tabIndex="6" onKeyPress="keyFunction()" id="tf018" name="tf018" onchange="check_enable();" <?php if($tf018) {echo "checked";} ?> disabled="disabled" />轉出碼</td>
        <td class="normal14a" width="23%" ><input type="checkbox" tabIndex="6" onKeyPress="keyFunction()" id="ma011" name="ma011" onchange="check_enable();" <?php if($ma011) {echo "checked";} ?> disabled="disabled" />備償帳戶</td>
	     <td class="start14a" width="10%" ></td>
		 <td class="normal14a" width="24%" ></td>
	  </tr>
	 <tr>
	    <td class="normal14z" >存提單號：</td>
        <td class="normal14" ><input tabIndex="3" id="tf002" onKeyPress="keyFunction()" name="tf002" value="<?php echo $tf002; ?>" disabled="disabled" /></td>
		<td class="normal14z" >銀行存款科目：</td>
        <td class="normal14" ><input tabIndex="4" id="ma005" onKeyPress="keyFunction()" name="ma005" value="<?php echo $ma005; ?>" disabled="disabled" /></td>
	  </tr>
	  
      <tr>
	    <td class="normal14z" >單據日期：</td>
        <td class="normal14" ><input tabIndex="5" id="tf011" onKeyPress="keyFunction()" name="tf011" value="<?php echo $tf011; ?>" disabled="disabled" /></td>
		<td class="normal14z" >科目名稱：</td>
        <td class="normal14" ><input tabIndex="4" id="ma003" onKeyPress="keyFunction()" name="ma003" value="<?php echo $ma003; ?>" disabled="disabled" /></td>
	  </tr>
	  <tr>
		<td class="normal14z" >銀行代號：</td>
        <td class="normal14" ><input tabIndex="7" id="tf004" onKeyPress="keyFunction()" name="tf004" value="<?php echo $tf004; ?>" disabled="disabled" /></td>
		<td class="normal14z" >傳票單別：</td>
        <td class="normal14" ><input tabIndex="8" id="tf008" onKeyPress="keyFunction()" name="tf008" value="<?php echo $tf008; ?>" disabled="disabled" /></td>
	  </tr>
	  <tr>
		<td class="normal14z" >銀行簡稱：</td>
        <td class="normal14" ><input tabIndex="9" id="ma002" onKeyPress="keyFunction()" name="ma002" value="<?php echo $ma002; ?>" disabled="disabled" /></td>
		<td class="normal14z" >傳票單號：</td>
        <td class="normal14" ><input tabIndex="10" id="tf009" onKeyPress="keyFunction()" name="tf009" value="<?php echo $tf009; ?>" disabled="disabled" /></td>
	  </tr>
	  <tr>
		<td class="normal14z" >帳號：</td>
        <td class="normal14" ><input tabIndex="11" id="ma004" onKeyPress="keyFunction()" name="ma004" value="<?php echo $ma004; ?>" disabled="disabled" /><!--<span><img src="<?php echo base_url()?>assets/image/png/bank.png" style="position: relative; top: 3px;" /></span>-->
		<td class="normal14z" >存提日期：</td>
		<td class="normal14" ><input tabIndex="12" id="tf003" onKeyPress="keyFunction()" name="tf003" value="<?php echo $tf003; ?>" disabled="disabled" onclick="scwShow(this,event);" /></td>
        <td class="normal14" ><input type="checkbox" tabIndex="6" onKeyPress="keyFunction()"  id="tf016" name="tf016" onchange="check_enable();" <?php if($tf016) {echo "checked";} ?> disabled="disabled" />產生分錄碼</td>
	  </tr>
	  <tr>
	    <td class="normal14z" >幣別：</td>
		<td class="normal14" ><input tabIndex="13" id="tf005" onKeyPress="keyFunction()" name="tf005" value="<?php echo $tf005; ?>" disabled="disabled" /></td>
		<td class="normal14z" >匯率：</td>
		<td class="normal14" ><input tabIndex="14" id="tf006" onKeyPress="keyFunction()" name="tf006" value="<?php echo $tf006; ?>" disabled="disabled" /></td>
		<td class="normal14z" >確認者：</td>
		<td class="normal14" ><input tabIndex="15" id="tf012" onKeyPress="keyFunction()" name="tf012" value="<?php echo $tf012; ?>" disabled="disabled" /></td>
	  </tr>
	  <tr>
		<td class="normal14z" >備註：</td>
        <td class="normal14" ><input tabIndex="16" id="tf007" onKeyPress="keyFunction()" name="tf007" value="<?php echo $tf007; ?>" disabled="disabled" style="width:80%" /><!--<span><img src="<?php echo base_url()?>assets/image/png/bank.png" style="position: relative; top: 3px;" /></span>-->
		<td class="normal14z" >簽核狀態：</td>
        <td class="normal14" ><input tabIndex="17" id="tf017" onKeyPress="keyFunction()" name="tf017" value="<?php echo $tf017; ?>" disabled="disabled" />
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
			  <td width="10%" class="left">轉帳對象</td>
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
                  <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
              <tr>
                <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
				<td class="left" colspan="12"></td>
              </tr>
			  
		<!--   明細  -->
		 
		 <tbody id="product-row' + product_row + '">
	     <?php $i=0; ?>
		 <?php foreach($result as $row) { ?>
  	     <tr>
	     <td class="center"><img src="<?php echo base_url();?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td>
  	     <td style="display:none;"><input type="hidden"  name="order_product[<?php echo $i; ?>][tg002]" value="<?php echo $tf002[$i]; ?>" /></td>
		 <td class="left"><input type="text" tabIndex="17" id="tg003[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg003]" value="<?php echo $tg003[$i]; ?>" size="10" disabled="disabled" /></td>
		 <td class="left"><input type="text"  tabIndex="18" id="tg004[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg004]" value="<?php if($tg004[$i]==1){echo "1:現金";}else{echo "2:轉帳";} ?>" size="10" style="text-align:left;" disabled="disabled" /></td>
		 <td class="left"><input type="text"  tabIndex="18" id="tg008[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg008]" value="<?php echo $tg008[$i]; ?>" size="10" style="text-align:right;" disabled="disabled" /></td>
		 <td class="left"><input type="text"  tabIndex="18" id="tg011[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg011]" value="<?php if($tg011[$i]==1){echo "1:公司";}else if($tg011[$i]==2){echo "2:廠商";}else if($tg011[$i]==3){echo "3:人員";}else if($tg011[$i]==9){echo "9:其他";} ?>" size="10" style="text-align:right;" disabled="disabled" /></td>
		 <td class="left"><input type="text"  tabIndex="18" id="tg005[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg005]" value="<?php echo $tg005[$i]; ?>" size="15" style="text-align:right;" disabled="disabled" /></td>
		 <td class="left"><input type="text"  tabIndex="18" id="tg007[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg007]" value="<?php echo $tg007[$i]; ?>" size="15" style="text-align:right;" disabled="disabled" /></td>
		 <td class="left"><input type="text"  tabIndex="18" id="tg012[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg012]" value="<?php echo $tg012[$i]; ?>" size="20" style="text-align:right;" disabled="disabled" /></td>
		 <td class="left"><input type="text"  tabIndex="18" id="tg013[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg013]" value="<?php echo $tg013[$i]; ?>" size="20" style="text-align:right;" disabled="disabled" /></td>
		 <td class="left"><input type="text"  tabIndex="18" id="tg006[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg006]" value="<?php echo $tg006[$i]; ?>" size="10" style="text-align:right;" disabled="disabled" /></td>
		 <td class="left"><input type="text"  tabIndex="18" id="tg014[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg014]" value="<?php echo $tg014[$i]; ?>" size="10" style="text-align:right;" disabled="disabled" /></td>
		 <td class="left"><input type="text"  tabIndex="18" id="tg015[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg015]" value="<?php if($tg015[$i]==1){echo "1:收款人負擔";}else{echo "2:付款人負擔";} ?>" size="10" style="text-align:right;" disabled="disabled" /></td>
		 <td class="left"><input type="text"  tabIndex="18" id="tg009[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tg009]" value="<?php echo $tg009[$i]; ?>" size="20" style="text-align:right;" disabled="disabled" /></td>
	     </tr>
	     <?php $i=$i+1;  }?>
        </tbody>
            </tfoot>
          </table>
        </div>
	
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
	<!--<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti02/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	</div>  -->
	  
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
