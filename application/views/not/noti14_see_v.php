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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 信貸融資建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti14/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	  </div>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/not/noti14/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>
	<div id="tab-general"> <!-- div-6 -->
	<?php $i=0; ?>
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
	<?php $i = $i + 1 ; }?>
      
	<table class="form14"  >     <!-- 頭部表格 disabled="disabled" -->
	  <tr>
	    <td class="normal14y" width="8%" ><span class="required">信貸銀行：</span> </td>
        <td class="normal14a" width="42%" ><input tabIndex="1" id="me001" onKeyPress="keyFunction()" onchange="startnoti14a(this)" name="me001" value="<?php echo $me001; ?>"  type="text" disabled="disabled" /></td>
		<td class="normal14y" width="8%" >授信生效日</td>
        <td class="normal14a" width="42%" ><input tabIndex="4" id="me004" onKeyPress="keyFunction()" onclick="scwShow(this,event);" name="me004" value="<?php echo $me004; ?>" disabled="disabled" /></td>
	  </tr>
	 <tr>
	    <td class="normal14z" >銀行名稱：</td>
        <td class="normal14" ><input tabIndex="3" id="ma002" onKeyPress="keyFunction()" name="ma002" value="<?php echo $ma002; ?>" disabled="disabled" />
		<td class="normal14z">授信到期日：</td>
        <td class="normal14"><input tabIndex="4" id="me005" onKeyPress="keyFunction()" onclick="scwShow(this,event);"  name="me005" value="<?php echo $me005; ?>" disabled="disabled" />
	  </tr>
	  
      <tr>
	    <td class="normal14z" >幣別：</td>
        <td class="normal14" ><input tabIndex="5" id="me002" onKeyPress="keyFunction()" onchange="startcmsi06a(this)" name="me002" value="<?php echo $me002; ?>" disabled="disabled" /></td>
		<td class="normal14z">綜合額度：</td>
        <td class="normal14"><input type="checkbox" tabIndex="6" onKeyPress="keyFunction()" id="me006" name="me006" onchange="check_enable();" <?php if($me006) {echo "checked";} ?> disabled="disabled" /></td>
	  </tr>
	  <tr>
		<td class="normal14z" >匯率：</td>
        <td class="normal14" ><input tabIndex="7" id="me003" onKeyPress="keyFunction()" name="me003" value="<?php echo $me003; ?>" disabled="disabled" /><!--<span><img src="<?php echo base_url()?>assets/image/png/bank.png" style="position: relative; top: 3px;" /></span>-->
		<td class="normal14z" >額度：</td>
        <td class="normal14" ><input tabIndex="8" id="me007" onKeyPress="keyFunction()" name="me007" value="<?php echo $me007; ?>" disabled="disabled" />
	  </tr>
	  <tr>
		<td class="normal14z" >備註：</td>
        <td class="normal14" colspan="3" ><input size="100" tabIndex="9" id="me008" onKeyPress="keyFunction()"  name="me008" value="<?php echo $me008; ?>" disabled="disabled" />
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
	     <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td>
  	     <input type="hidden"  name="order_product[<?php echo $i ?>][mf001]" value="<?php echo $mf001[$i]; ?>" />
		 <td class="left"><input type="text" tabIndex="17" id="mf003[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf003]" value="<?php echo $mf003[$i]; ?>" size="20" disabled="disabled" /></td>
		 <td class="left"><input type="text"  tabIndex="18" id="mf005[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf005]" value="<?php echo $mf005[$i]; ?>" size="20" style="text-align:left;" disabled="disabled" /></td>
		 <td class="left"><input type="text"  tabIndex="18" id="mf004[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mf004]" value="<?php echo $mf004[$i]; ?>" size="20" style="text-align:right;" disabled="disabled" /></td>
	     </tr>
	     <?php $i=$i+1;  }?>
        </tbody>
            </tfoot>
          </table>
        </div>
	
	 </div>
	</div>
	<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti14/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	</div> 
	  
      </form>
     </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  <!--  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>  -->
  </div> <!-- div-3 -->
 </div> <!-- div-2 -->
</div> <!-- div-1 -->
