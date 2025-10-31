<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
    </div>

<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 庫別庫存資料查詢作業 - 查看</h1>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/inv/invq02/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php $i=0; ?>
	<?php foreach($result as $row) { ?>
          <?php   $mb001=$row->mb001;?>
          <?php   $mb002=$row->mb002;?>
          <?php   $mb003=$row->mb003;?>
          <?php   $mb004=$row->mb004;?>
          <?php   $mb017=$row->mb017;?>
		  <?php   $mb017disp=$row->mb017disp;?>
          <?php   $mb006=$row->mb006;?>
		  <?php   $mb064=$row->mb064;?>
		  <?php   $mb065=$row->mb065;?>
			
		 <!-- 明細 -->
		   <?php   $mc001[]=$row->mc001;?>
		   <?php   $mc002[]=$row->mc002;?>
		   <?php   $mc002disp[]=$row->mc002disp;?>
		   <?php   $mc003[]=$row->mc003;?>
		   <?php   $mc004[]=round($row->mc004,0);?>
		   <?php   $mc007[]=round($row->mc007,0);?>
		   <?php   $mc008[]=round($row->mc008,2);?>
		   <?php   $mc012[]=substr($row->mc012,0,4).'/'.substr($row->mc012,4,2).'/'.substr($row->mc012,6,2);?>	
		   <?php   $mc013[]=substr($row->mc013,0,4).'/'.substr($row->mc013,4,2).'/'.substr($row->mc013,6,2);?>	   
		   <?php   $mb991=' ';?>
		   <?php   $mb992=' ';?>
		   <?php   $mb999=' ';?>
	<?php $i = $i + 1 ; }?>
      
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	     <td class="start14a"  width="10%"><span class="required">品號：</span> </td>
         <td class="normal14a"  width="50%"><input tabIndex="1"   id="mb001" onKeyPress="keyFunction()"   name="mb001"  value="<?php echo $mb001; ?>"   type="text"  disabled /></td>
	     <td class="normal14a" width="10%" >品名： </td>
         <td class="normal14a"  width="50%" ><input tabIndex="2"   id="mb002" onKeyPress="keyFunction()"   name="mb002"  value="<?php echo $mb002; ?>" size="40"  type="text"  disabled /></td>
	   </tr>	
	    <tr>
	     <td class="normal14" >規格： </td>
         <td class="normal14"  ><input tabIndex="3"   id="mb003" onKeyPress="keyFunction()"   name="mb003"  value="<?php echo $mb003; ?>" size="40"  type="text"  disabled /></td>
	     <td class="normal14"  >單位： </td>
         <td class="normal14"   ><input tabIndex="4"   id="mb004" onKeyPress="keyFunction()"   name="mb004"  value="<?php echo $mb004; ?>"   type="text"  disabled /></td>
	   </tr>
        <tr>
	     <td class="normal14"  >主要庫別： </td>
         <td class="normal14"  ><input tabIndex="5"   id="mb017" onKeyPress="keyFunction()"   name="mb017"  value="<?php echo $mb017; ?>"   type="text"  disabled />
	     <span id="mb017disp"> <?php   echo $mb017disp; ?> </span></td>
		 <td class="normal14"  >庫存數量： </td>
         <td class="normal14"   ><input tabIndex="6"   id="mb064" onKeyPress="keyFunction()"   name="mb064"  value="<?php echo $mb064; ?>"   type="text"  disabled /></td>
	   </tr>	
       <tr>
	     <td class="normal14" >庫存金額：</td>
         <td class="normal14"  ><input tabIndex="7"   id="mb065" onKeyPress="keyFunction()"   name="mb065"  value="<?php echo $mb065; ?>"   type="text"  disabled /></td>
	     <td class="normal14"  > </td>
         <td class="normal14"   >&nbsp;&nbsp;</td>
	   </tr>	   
	  
		
	</table>
	
	<div class="abgne_tab"> <!-- div-7 -->
		
		
    <div class="tab_container"> <!-- div-8 -->
	
	<!--   基本資料1 -->
	
          <table id="order_product" class="list1">
            <thead>
              <tr>
                <td width="5%"></td>			
				<td width="11%" class="center">庫別</td>
                <td width="18%" class="center">庫別名稱</td>
				<td width="18%" class="center">儲位</td>
				<td width="6%" class="center">安全存量</td>
				<td width="6%" class="center">庫存數量</td>
				<td width="10%" class="center">庫存金額</td>
                <td width="6%" class="right">最近入庫日</td>
                <td width="6%" class="right">最近出庫日</td>
               		
              </tr>
            </thead>
                  <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
              <tr>
                <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
				<td class="left" colspan="9"></td>
              </tr>
			  
		<!--   明細  -->
		 
		 <tbody id="product-row' + product_row + '">
	     <?php $i=0; ?>
		 <?php foreach($result as $row) { ?>		
	     <tr>
	     <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td>
  	     <input type="hidden"  name="order_product[' + product_row + '][mc001]" value="<?php echo $mc001[$i]; ?>" />	    
	     <td class="left"><input readonly="value"  tabIndex="10" onKeyPress="keyFunction()" type="text" id="mc002"  name="order_product[' + product_row + '][mc002]" value="<?php echo $mc002[$i]; ?>" style="background-color:#EBEBE4" disabled="disabled" /></td>
		 <td class="left"><input readonly="value"  tabIndex="11" onKeyPress="keyFunction()" type="text" id="mc002disp"  name="order_product[' + product_row + '][mc002disp]" value="<?php echo $mc002disp[$i]; ?>" style="background-color:#EBEBE4" disabled="disabled" /></td>	    
	   
		 <td class="left"><input readonly="value"  tabIndex="13" onKeyPress="keyFunction()" type="text" id="mc003"  name="order_product[' + product_row + '][mc003]" value="<?php echo $mc003[$i]; ?>"   style="background-color:#EBEBE4" disabled="disabled" /></td>
		 <td class="left"><input readonly="value"  tabIndex="14" onKeyPress="keyFunction()" type="text" id="mc004"  name="order_product[' + product_row + '][mc004]" value="<?php echo $mc004[$i]; ?>"   style="background-color:#EBEBE4" disabled="disabled" /></td>
	     <td class="center"><input type="text" readonly="value" tabIndex="15" id="mc007" onKeyPress="keyFunction()" name="order_product[' + product_row + '][mc007]" value="<?php echo $mc007[$i]; ?>" size="12" style="text-align:right;background-color:#EBEBE4" disabled="disabled"/></td>
         <td class="center"><input type="text" readonly="value" tabIndex="16" id="mc008" onKeyPress="keyFunction()" name="order_product[' + product_row + '][mc008]" value="<?php echo $mc008[$i]; ?>" size="12" style="text-align:right;background-color:#EBEBE4" disabled="disabled" /></td>	
         <td class="left"><input type="text" readonly="value" id="mc012" tabIndex="17"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][mc012]" value="<?php echo $mc012[$i]; ?>" size="10" style="background-color:#EBEBE4" disabled="disabled"/></td>
	     <td class="left"><input type="text" readonly="value" id="mc013" tabIndex="18"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][mc013]" value="<?php echo $mc013[$i]; ?>" size="10" style="background-color:#EBEBE4" disabled="disabled"/></td>
	     </tr>
	     <?php $i=$i+1;  }?>
        </tbody>
            </tfoot>
          </table>
        </div>
	
	 </div>
	</div>
	<div class="buttons">
	<!-- <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span></button>&nbsp;&nbsp;&nbsp;&nbsp;  -->
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('inv/invq02/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
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
