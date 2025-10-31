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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> E-BOM變更單建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ebo/eboi04/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	  </div>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ebo/eboi04/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php $ii=0;$i=0; ?>
	<?php foreach($result as $row) { ?>
         <?php   $bomq03a44=$row->ti001;?>
		  <?php   $bomq03a44disp=$row->ti001disp;?>
          <?php   $ti002=$row->ti002;?>
          <?php   $ti003=$row->ti003;?>
		  <?php   $ti004=$row->ti004;?>
          <?php   $ti005=$row->ti005;?>
          <?php   $ti006=$row->ti006;?>
		  <?php   $ti007=$row->ti007;?>
		  <?php   $ti008=$row->ti008;?>
		  <?php   $ti009=$row->ti009;?>
          <?php   $ti010=$row->ti010;?>
		  <?php   $ti011=$row->ti011;?>
		  <?php   $create_date=$row->create_date;?>
		  <?php   $modi_date=$row->modi_date;?>
         <?php   $flag=$row->flag;?>	
		 <!-- 明細 -->
		   
		   <?php   $tj001[]=$row->tj001;?>
		   <?php   $tj002[]=$row->tj002;?>
		   <?php   $tj003[]=$row->tj003;?>
		   <?php   $tj004[]=$row->tj004;?>
		   <?php   $tj003disp[]=$row->tj003disp;?>
		   <?php   $tj003disp1[]=$row->tj003disp1;?>
		   <?php   $tj003disp2[]=$row->tj003disp2;?>
		   <?php   $tj008[]=round($row->tj008,2);?>
		   <?php   $tj010[]=$row->tj010;?>
		  
		  <?php   $tj011[]=$row->tj011;?>
		  <?php   $tj012[]=$row->tj012;?>
		  <?php   $mb991=' ';?>
		  <?php   $mb992=' ';?>
		  <?php   $mb999=' ';?>
	<?php $i = $i + 1 ;$ii = $ii + 1 ; }?>
      
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="10%"><span class="required">變更單別：</span> </td>
        <td class="normal14a"  width="22%"><input type="text" tabIndex="1" id="ti001"    onKeyPress="keyFunction()"   onchange="startbomq03a44(this)"  name="bomq03a44" value="<?php echo $bomq03a44; ?>"   required />
		<a href="javascript:;"><img id="Showbomq03a44disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="bomq03a44disp"></span></td>
		 
	    <td class="normal14y" width="10%" >單據日期： </td>
        <td class="normal14a"  width="24%" ><input tabIndex="2"  onclick="scwShow(this,event);"   id="ti009" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);chkno1(this);" name="ti009"  value="<?php echo $ti009; ?>"  size="12" type="text"  style="background-color:#E7EFEF" />
          <img  onclick="scwShow(ti009,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>	   
	   <td class="normal14y" width="10%" >變更單號：</td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="ti002" onKeyPress="keyFunction()" onfocus="chkno1(this);" name="ti002" value="<?php echo $ti002; ?>" size="30" type="text" required /></td>
	  </tr>	
		  
	  <tr>
		<td class="normal14z">緊急：</td>
        <td  class="normal14"  ><input tabIndex="4" id="ti004" onKeyPress="keyFunction()"  name="ti004" value="<?php echo $ti004; ?>"  type="text"    /></td>    
	    <td class="normal14z" >變更原因：</td>
        <td class="normal14a" ><input tabIndex="5" id="ti005" onKeyPress="keyFunction()"  name="ti005" value="<?php echo $ti005; ?>"  type="text"   /></td>
		<td class="normal14z" >備註：</td>
        <td class="normal14a" ><input tabIndex="6" id="ti006" onKeyPress="keyFunction()"  name="ti006" value="<?php echo $ti006; ?>"  type="text"   /></td>
	  
	  </tr>
	 
	  <tr>
		<td class="normal14z">變更日期：</td>
        <td  class="normal14"  ><input tabIndex="10" id="ti003" onKeyPress="keyFunction()"  name="ti003" value="<?php echo $ti003; ?>"  type="text"  style="background-color:#F5F5F5"  /></td>    
	    <td class="normal14z" >確認者：</td>
        <td class="normal14a" ><input tabIndex="11" id="ti010" onKeyPress="keyFunction()"  name="ti010" value="<?php echo $ti010; ?>"  type="text"  style="background-color:#F5F5F5"  /></td>
		<td class="normal14z" >列印次數：</td>
        <td class="normal14a" ><input tabIndex="12" id="ti008" onKeyPress="keyFunction()"  name="ti008" value="<?php echo $ti008; ?>"  type="text"  style="background-color:#F5F5F5" /></td>
	  
	  </tr>
	  <tr>
		<td class="normal14z">簽核狀態：</td>
        <td  class="normal14"  ><select id="ti011" tabIndex="25" readonly="value" onKeyPress="keyFunction()" name="ti011"   style="background-color:#EBEBE4" disabled="disabled">
            <option <?php if($ti011 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($ti011 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($ti011 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($ti011 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($ti011 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($ti011 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($ti011 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($ti011 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td><td class="normal14" ></td>
        <td class="normal14z" >確認碼</td>
		<td class="normal14a" ><input tabIndex="11" id="ti007" onKeyPress="keyFunction()"  name="ti007" value="<?php echo $ti007; ?>"  type="text"  style="background-color:#F5F5F5"  /></td>
        <td class="normal14a" ></td>
	  
	  </tr>
	</table>
	 <div>
          <table id="order_product" class="list1">
            <thead>
                <tr>
              <td width="5%"></td>			
		      <td width="8%" class="center">主件品號</td>
              <td width="13%" class="left">品名</td>
			  <td width="13%" class="left">規格</td>
			  <td width="6%" class="left">單位</td>
			  <td width="6%" class="center">序號</td>
		<!--	  <td width="6%" class="left">生效日期</td>
              <td width="6%" class="center">失效日期</td> -->
              <td width="6%" class="right">標準批量</td>
			<!--  <td width="6%" class="right">確認狀態</td>
			  <td width="6%" class="right">確認碼</td>-->
			  <td width="6%" class="center">確認碼</td>
			  <td width="6%" class="right">確認狀態</td>
			  <td width="10%" class="center">變更原因</td>				
            </tr>
            </thead>
                  <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
              <tr>
                <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
				<td class="left" colspan="14"></td>
              </tr>
			  
		<!--   明細  -->
		 
		<?php $i=0; $mproduct_row=0; $product_row='0'; ?>  
			
		<?php while ($i<$ii) { ?>
		<tbody   <?php echo    "id=product-row".$product_row ?> >		
	      <tr>
	     <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="刪除資料" onclick="del_detail('<?php echo $tj001[$i];?>','<?php echo $tj002[$i]; ?>','<?php echo $tj003[$i]; ?>');" /></td><!--$(\'#product-row0\').remove();原始方法-->
          	    
		<input type="hidden"  name="order_product[<?php echo $i ?>][tj001]" value="<?php echo $tj001[$i]; ?>" />
	     <input type="hidden" name="order_product[<?php echo $i ?>][tj002]" value="<?php echo $tj002[$i]; ?>" />		 
	     <td class="left"><input type="text"  tabIndex="14" <?php echo 'id='.'tj004'.$i ?>   name="order_product[<?php echo $i ?>][tj004]" value="<?php echo $tj004[$i]; ?>" size="20" style="background-color:#E7EFEF"  /></td>
	     <td class="left"><input  type="text" tabIndex="15" onKeyPress="keyFunction()"  id="tj003disp"  name="order_product[<?php echo $i ?>][tj003disp]" value="<?php echo $tj003disp[$i]; ?>"  style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text" tabIndex="16" onKeyPress="keyFunction()"  id="tj003disp1"   name="order_product[<?php echo $i ?>][tj003disp1]" value="<?php echo $tj003disp1[$i]; ?>"  size="30" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input  type="text" tabIndex="17" onKeyPress="keyFunction()"    id="tj003disp2"   name="order_product[<?php echo $i ?>][tj003disp2]" value="<?php echo $tj003disp2[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
	     <td class="left"><input type="text"   readonly="value" tabIndex="18" id="order_product[<?php echo $i?>][tj003]" name="order_product[<?php echo $i?>][tj003]" value="<?php echo $tj003[$i]; ?>" size="6" style="background-color:#EBEBE4" /></td>
	<!--	 <td class="left"><input type="text" tabIndex="19"  onfocus="scwShow(this,event);" onclick="scwShow(this,event);"  id="tj011[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tj011]" value="<?php echo  $tj011[$i]; ?>" size="10"  class="date" style="background-color:#E7EFEF" /></td>
		 <td class="left"><input type="text" tabIndex="20"  onfocus="scwShow(this,event);" onclick="scwShow(this,event);"  id="tj012[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tj012]" value="<?php echo  $tj012[$i]; ?>" size="10"  class="date" style="background-color:#E7EFEF" /></td> -->
	     <td class="right"><input type="text"  tabIndex="21"id="tj008"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tj008]" value="<?php echo $tj008[$i]; ?>" size="10" style="text-align:right;"  /></td>
      <!--   <td class="right"><input type="text"  tabIndex="22" id="tj007" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tj007]" value="<?php echo $tj007[$i]; ?>" size="10" style="text-align:right;"  /></td>	
         <td class="right"><input type="text"  tabIndex="23" id="tj008" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tj008]" value="<?php echo $tj008[$i]; ?>" size="10" style="text-align:right;"  /></td>	  -->       
		 <td class="left"><input type="text"  tabIndex="24"id="tj011"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tj011]" value="<?php echo $tj011[$i]; ?>" size="10"  /></td>
         <td class="left"><input type="text"  tabIndex="25"id="tj012"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tj012]" value="<?php echo $tj012[$i]; ?>" size="10"  /></td>
         <td class="left"><input type="text"  tabIndex="26"id="tj010"  onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tj010]" value="<?php echo $tj010[$i]; ?>" size="20"  /></td>	    
		</tr>	   
        </tbody>
        <?php $i++; $mproduct_row = (int) $product_row + 1; $product_row=(string)$mproduct_row;?>	
 <?php } ?>		
        </tbody>
            </tfoot>
          </table>
        </div>
	
	 
	<!--<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ebo/eboi04/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	</div> -->
	  <br>
      </form>
	  
	  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>
     </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  <!--  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>  -->
  </div> <!-- div-3 -->
 </div> <!-- div-2 -->
</div> <!-- div-1 -->
