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
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 信貸融資建立作業 - 修改　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#me001').focus();" type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti14/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/not/noti14/updsave" method="post" enctype="multipart/form-data" >
	
	<div id="tab-general"> <!-- div-6 -->
	<?php $ii=0; ?>
	<?php foreach($result as $row) { ?>
          <?php   $me001=$row->me001;?>
          <?php   $me002=$row->me002;?>
		  <?php   $me003=$row->me003;?>
          <?php   $me004=$row->me004;?>
          <?php   $me005=$row->me005;?>
          <?php   $me006=$row->me006;?>
		  <?php   $me007=$row->me007;?>
		  <?php   $me008=$row->me008;?>
		  <?php   $ma002=$row->ma002;?>
		 <!-- 明細 -->
		   <?php   $mf001[]=$row->mf001;?>
		   <?php   $mf002[]=$row->mf002;?>
		   <?php   $mf003[]=$row->mf003;?>
		   <?php   $mf004[]=$row->mf004;?>
		   <?php   $mf005[]=$row->mf005;?>
		
		   <?php   $mf991=' ';?>
		   <?php   $mf992=' ';?>
		   <?php   $mf999=' ';?>
		    <?php   $flag=$row->flag;?>
	<?php $ii = $ii + 1 ; }?>
	
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y" width="8%" ><span class="required">信貸銀行：</span> </td>
        <td class="normal14a" width="42%" ><input tabIndex="1" id="me001" onKeyPress="keyFunction()" onchange="startnoti14a(this)" name="me001" value="<?php echo $me001; ?>"  type="text" readonly="readonly" style="background-color:#F0F0F0"  /></td>
		<td class="normal14y" width="10%" >授信生效日</td>
        <td class="normal14a" width="40%" ><input tabIndex="4" id="me004" onKeyPress="keyFunction()" onclick="scwShow(this,event);" name="me004" value="<?php echo $me004; ?>" /></td>
	  </tr>
	 <tr>
	    <td class="normal14z" >銀行名稱：</td>
        <td class="normal14" ><input tabIndex="3" id="ma002" onKeyPress="keyFunction()" name="ma002" value="<?php echo $ma002; ?>" style="background-color:#F0F0F0" />
		<td class="normal14z">授信到期日：</td>
        <td class="normal14"><input tabIndex="4" id="me005" onKeyPress="keyFunction()" onclick="scwShow(this,event);"  name="me005" value="<?php echo $me005; ?>" /></td>
	  </tr>
	  
      <tr>
	    <td class="normal14z" >幣別：</td>
        <td class="normal14" ><input tabIndex="5" id="me002" onKeyPress="keyFunction()" onchange="startcmsi06a(this)" name="me002" value="<?php echo $me002; ?>" readonly="readonly" style="background-color:#F0F0F0"  /></td>
		<td class="normal14z">綜合額度：</td>
        <td class="normal14"><input type="checkbox" tabIndex="6" onKeyPress="keyFunction()" id="me006" name="me006" onchange="check_enable();" <?php if($me006){echo "checked";}?>/></td>
	  </tr>
	  <tr>
		<td class="normal14z" >匯率：</td>
        <td class="normal14" ><input tabIndex="7" id="me003" onKeyPress="keyFunction()" name="me003" value="<?php echo $me003; ?>" /><!--<span><img src="<?php echo base_url()?>assets/image/png/bank.png" style="position: relative; top: 3px;" /></span>-->
		<td class="normal14z" >額度：</td>
        <td class="normal14" ><input tabIndex="8" id="me007" onKeyPress="keyFunction()" name="me007" value="<?php echo $me007; ?>" style="background-color:#F0F0F0"  />
	  </tr>
	  <tr>
		<td class="normal14z" >備註：</td>
        <td class="normal14" colspan="3" ><input size="100" tabIndex="9" id="me008" onKeyPress="keyFunction()" value="<?php echo $me008; ?>"  name="me008" />
	  </tr>
		
	</table>
	
	
	  <div>
          <table id="order_product" class="list1">
            <thead>
            <tr>
              <td width="5%"></td>			
		      <td width="11%" class="left">融資種類</td>
              <td width="15%" class="left">融資名稱</td>
              <td width="15%" class="left">額度</td>	  		
			</tr>
            </thead>
      
    <!--   明細0  --> 
		<?php  // $i=0; $product_row='0'; ?>  
			<?php $i=0; $mproduct_row=0; $product_row='0'; ?>  
			 	<input id="row_count" name="row_count" value="0" style="display:none;" /> 
		<?php while ($i<$ii) { ?>
		<tbody  <?php echo 'id='.'product-row'.$product_row ?> >		
	     <tr>
	     <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td>
  	     <input type="hidden"  name="order_product[<?php echo $i ?>][mf001]" value="<?php echo $mf001[$i]; ?>" />
		 <input type="hidden"  name="order_product[<?php echo $i ?>][mf002]" value="<?php echo $mf002[$i]; ?>" />
		 <td class="left"><input type="text" tabIndex="17" id="mf003[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf003]" value="<?php echo $mf003[$i]; ?>" size="20" onchange="startnoti13a(this)" ondblclick="noti13a(this,'<?php echo $i;?>');" /><span id="shownoti13a"></span></td>
		 <td class="left"><input type="text"  tabIndex="18" id="mf005<?php echo $i ?>" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf005]" value="<?php echo $mf005[$i]; ?>" size="20" style="text-align:left;background-color:#F0F0F0"   /></td>
		 <td class="left"><input type="text" class="mf004" tabIndex="18" id="mf004[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf004]" value="<?php echo $mf004[$i]; ?>" size="20" style="text-align:right;" /></td>
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
	 
	<?php include("./application/views/fun/noti14_funjsupdjs_v.php"); ?> 
		 
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
	 </div>
	 
	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	 <!-- <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti14/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div> -->
	  
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
<form action="<?php echo base_url()?>index.php/not/noti14/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
 <?php include("./application/views/fun/noti14_funjsupd_v.php"); ?>