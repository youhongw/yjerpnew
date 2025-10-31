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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 促銷單建立作業 - 查看</h1>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pos/posi11/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php $ii=0;$i=0; ?>
	<?php foreach($result as $row) { ?>
          <?php   $posq02a=$row->tc001;?>
		  <?php   $posq02adisp=$row->tc001disp;?>
          <?php   $tc002=$row->tc002;?>
          <?php   $tc003=substr($row->tc003,0,4).'/'.substr($row->tc003,4,2).'/'.substr($row->tc003,6,2);?>
          <?php   $tc004=substr($row->tc004,0,4).'/'.substr($row->tc004,4,2).'/'.substr($row->tc004,6,2);?>
		   <?php   $tc005=substr($row->tc005,0,2).':'.substr($row->tc005,2,2);?>
          <?php   $tc006=substr($row->tc006,0,4).'/'.substr($row->tc006,4,2).'/'.substr($row->tc006,6,2);?>
		  <?php   $tc007=substr($row->tc007,0,2).':'.substr($row->tc007,2,2);?>
		  <?php   $tc008=$row->tc008;?>
		
		 <!-- 明細 -->
		   
		   <?php   $td001[]=$row->td001;?>
		   <?php   $td002[]=$row->td002;?>
		   <?php   $td003[]=$row->td003;?>
		   <?php   $td004[]=$row->td004;?>
		   <?php   $td005[]=$row->td005;?>
		   <?php   $td006[]=$row->td006;?>
		   <?php   $td007[]=$row->td007;?>
		   <?php   $td008[]=$row->td008;?>
		   <?php   $td009[]=$row->td009;?>
		   <?php   $td010[]=$row->td010;?>
		   <?php   $td011[]=$row->td011;?>
			  
	       <?php   $flag=$row->flag;?>			  
		  <?php   $mb991=' ';?>
		  <?php   $mb992=' ';?>
		  <?php   $mb999=' ';?>
	<?php $i = $i + 1 ;$ii = $ii + 1 ; }?>
       <?php 
	  if(!isset($sysma200)) { $sysma200=$this->session->userdata('sysma200'); }
	  if(!isset($sysma201)) { $sysma201=$this->session->userdata('sysma201'); }  ?>
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="10%"><span class="required">門市代號：</span> </td>
        <td class="normal14a"  width="22%"><input tabIndex="1" id="tc001"    onKeyPress="keyFunction()" onfocus="selappr()" onchange="startposq02a(this)"  name="posq02a" value="<?php echo strtoupper($posq02a); ?>"  type="text" required disabled="disabled"/><a href="javascript:;"><img id="Showposq02a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="posq02adisp"> <?php    echo $posq02adisp; ?> </span></td>
	    <td class="normal14a" width="10%" >單據日期： </td>
        <td class="normal14a"  width="24%" ><input tabIndex="2"  onclick="scwShow(this,event);"   id="tc003" onKeyPress="keyFunction()"  onchange="chkno1(this)" name="tc003"  value="<?php echo $tc003; ?>"  size="12" type="text" style="background-color:#E7EFEF" disabled="disabled" /></td>
		<td class="normal14a" width="10%" ><span class="required">促銷單號：</span> </td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="tc002" onKeyPress="keyFunction()" onfocus="chkno1(this)" name="tc002" value="<?php echo $tc002; ?>" size="20" type="text" required disabled="disabled"/></td>
	  </tr>		
	  <tr>
		<td class="normal14">開始日期：</td>
        <td  class="normal14"  ><input tabIndex="4" id="tc004" onKeyPress="keyFunction()"  onchange="dataymd1(this)" name="tc004" value="<?php echo $tc004; ?>" size="10" type="text" disabled="disabled"  /></td>	    
	    <td class="normal14" >開始時間：</td>
        <td class="normal14a" ><input tabIndex="5" id="tc005" onKeyPress="keyFunction()"  onchange="datahms1(this)" name="tc005" value="<?php echo $tc005; ?>" size="10" type="text"  disabled="disabled"/></td>
		<td class="normal14" ></td>
        <td class="normal14a" ></td>
	  </tr>
	   <tr>
		<td class="normal14">結束日期：</td>
        <td  class="normal14"  ><input tabIndex="4" id="tc006" onKeyPress="keyFunction()"  onchange="dataymd2(this)" name="tc006" value="<?php echo $tc006; ?>" size="10" type="text"  disabled="disabled"/></td>	    
	    <td class="normal14" >結束時間：</td>
        <td class="normal14a" ><input tabIndex="5" id="tc007" onKeyPress="keyFunction()"  onchange="datahms2(this)" name="tc007" value="<?php echo $tc007; ?>" size="10" type="text"  disabled="disabled"/></td>
		<td class="normal14" ></td>
        <td class="normal14a" ></td>
	  </tr>
	    <tr>
		<td class="normal14">促銷說明：</td>
        <td colspan="3" class="normal14"  ><input tabIndex="4" id="tc008" onKeyPress="keyFunction()"   name="tc008" value="<?php echo $tc008; ?>" size="60" type="text" disabled="disabled" /></td>	    
	    <td class="normal14" ></td>
      		  
		<td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" /></td>
         <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" /></td>
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
			  <td width="6%" class="left">單位</td>
			  <td width="6%" class="center">序號</td>
		      <td width="6%" class="right">原售價</td>
			  <td width="6%" class="right">特價</td>
			  <td width="6%" class="center">會員特價</td>
			  <td width="6%" class="right">條碼</td>
			 
            </tr>
            </thead>
                  <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
              <tr>
                <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
				<td class="left" colspan="11"></td>
              </tr>
			  
		<!--   明細  -->
		 
		<?php $i=0; $mproduct_row=0; $product_row='0'; ?>  
			
		<?php while ($i<$ii) { ?>
		<tbody   <?php echo    "id=product-row".$product_row ?> >		
	    <tr>
	     <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td>
  	     <input type="hidden"  name="order_product[<?php echo $i ?>][td001]" value="<?php echo $td001[$i]; ?>" />
	     <input type="hidden" name="order_product[<?php echo $i ?>][td002]" value="<?php echo $td002[$i]; ?>" />
     
	     <td class="left"><input type="text"  tabIndex="14" <?php echo 'id='.'td004'.$i ?>  onchange="startinvq02a(this,product_row)"  name="order_product[<?php echo $i ?>][td004]" value="<?php echo $td004[$i]; ?>" size="20" style="background-color:#E7EFEF" disabled="disabled" /></td>
	     <td class="left"><input  type="text" tabIndex="15" onKeyPress="keyFunction()"  id="td005"  name="order_product[<?php echo $i ?>][td005]" value="<?php echo $td005[$i]; ?>"  style="background-color:#EBEBE4" disabled="disabled"/></td>
	     <td class="left"><input type="text" tabIndex="16" onKeyPress="keyFunction()"  id="td006"   name="order_product[<?php echo $i ?>][td006]" value="<?php echo $td006[$i]; ?>"  size="30" style="background-color:#EBEBE4" disabled="disabled"/></td>
	     <td class="left"><input  type="text" tabIndex="17" onKeyPress="keyFunction()"    id="td007"   name="order_product[<?php echo $i ?>][td007]" value="<?php echo $td007[$i]; ?>" size="6" style="background-color:#EBEBE4" disabled="disabled"/></td>
	     <td class="left"><input type="text"   readonly="value" tabIndex="18"  name="order_product[$i][td003]" value="<?php echo $td003[$i]; ?>" size="6" style="background-color:#EBEBE4" disabled="disabled"/></td>
		
	    <td class="left"><input type="text"  tabIndex="20"  class="total_qty" id="td008"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][td008]" value="<?php echo $td008[$i]; ?>" size="12" disabled="disabled" /></td>
		<td class="left"><input type="text"  tabIndex="20"  id="td009"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][td009]" value="<?php echo $td009[$i]; ?>" size="12"  /></td>
		<td class="center"><input type="text"  tabIndex="21" class="total_price" id="td010" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][td010]" value="<?php echo $td010[$i]; ?>" size="6" style="text-align:right;" disabled="disabled" /></td>	
        
	    <td class="left"><input type="text"  tabIndex="25" id="td011"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][td011]" value="<?php echo $td011[$i]; ?>" size="20"  disabled="disabled"/></td>
	     </tr>	   
        </tbody>
        <?php $i++; $mproduct_row = (int) $product_row + 1; $product_row=(string)$mproduct_row;?>	
 <?php } ?>		
        </tbody>
            </tfoot>
          </table>
        </div>
	
	  <!-- 合計     -->
		     <tr>
           <!--     <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span>
				</span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　總數量：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;"><span id="sum_tot"><?php echo $tc011; ?></span></b></td>
				
				
				<td class="right" valign="top"><b style="color: #003A88;">　　　　　　　總金額：</b></td>
			<!--	<td ><input type='text' readonly="value" name='tc008' id="tc008" size="8" value="<?php echo $tc012; ?>"  style="background-color:#EBEBE4" /></td>  -->
			<!--	<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;"><span id="sum_tot1"><?php echo $tc012; ?></span></b></td>
				
				<td class="left" valign="top"></td>   -->
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	
	<div class="buttons">
	<!-- <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span></button>&nbsp;&nbsp;&nbsp;&nbsp;  -->
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pos/posi11/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	</div> 
	  <br>
      </form>
	  
	  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>
     </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  
  </div> <!-- div-3 -->
 </div> <!-- div-2 -->
</div> <!-- div-1 -->
