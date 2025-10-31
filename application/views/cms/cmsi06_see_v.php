<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 幣別匯率資料建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi06/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	  </div>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cms/cmsi06/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="tab-general"> <!-- div-6 -->
	<?php $i=0; ?>
	<?php foreach($result as $row) { ?>
            <?php   $mf001=$row->mf001;?>
          <?php   $mf002=$row->mf002;?>
		  <?php   $mf003=$row->mf003;?>
          <?php   $mf004=$row->mf004;?>
          <?php   $mf005=$row->mf005;?>
          <?php   $mf006=$row->mf006;?>
		  <?php   $mf007=$row->mf007;?>
		  		
		 <!-- 明細 -->
		   <?php   $mg001[]=$row->mg001;?>
		   <?php   $mg002[]=$row->mg002;?>
		   <?php   $mg003[]=$row->mg003;?>
		   <?php   $mg004[]=$row->mg004;?>
		   <?php   $mg005[]=$row->mg005;?>
		   <?php   $mg006[]=$row->mg006;?>
		   
		    <?php   $flag=$row->flag;?>	
		
		   <?php   $mb991=' ';?>
		   <?php   $mb992=' ';?>
		   <?php   $mb999=' ';?>
	<?php $i = $i + 1 ; }?>
      
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="normal14y" width="8%" ><span class="required">幣別：</span> </td>
        <td class="normal14a" width="42%" ><input   tabIndex="1" id="mf001" onKeyPress="keyFunction()" readonly="value" onchange="startkey(this)" name="mf001" value="<?php echo $mf001; ?>" size="6" type="text" disabled="disabled" />
	        <span id="keydisp" ></span></td>
		<td class="normal14y" width="8%" >幣別名稱：</td>
        <td class="normal14a" width="42%" ><input type="text" tabIndex="2"  onKeyPress="keyFunction()" size="10"  id="mf002" name="mf002" value="<?php echo $mf002; ?>"  disabled="disabled" /></td>
	  </tr>
	 
	 <tr>
	    <td class="normal14z" >單價取位： </td>
        <td class="normal14" ><select  tabIndex="3" id="mf003" onKeyPress="keyFunction()"  name="mf003" disabled="disabled" >
             <option <?php if($mf003 == '0') echo 'selected="selected"';?> value='0'>0:整數</option>                                                                        
		     <option <?php if($mf003 == '1') echo 'selected="selected"';?> value='1'>1:小數一位</option>
			 <option <?php if($mf003 == '2') echo 'selected="selected"';?> value='2'>2:小數二位</option>                                                                        
		     <option <?php if($mf003 == '3') echo 'selected="selected"';?> value='3'>3:小數三位</option>
			 <option <?php if($mf003 == '4') echo 'selected="selected"';?> value='4'>4:小數四位</option>
		  </select>
		<td class="normal14z">金額取位：</td>
        <td class="normal14"><select  tabIndex="4" id="mf004" onKeyPress="keyFunction()"  name="mf004" disabled="disabled">
             <option <?php if($mf004 == '0') echo 'selected="selected"';?> value='0'>0:整數</option>                                                                        
		     <option <?php if($mf004 == '1') echo 'selected="selected"';?> value='1'>1:小數一位</option>
			 <option <?php if($mf004 == '2') echo 'selected="selected"';?> value='2'>2:小數二位</option> 
		  </select>
	  </tr>
	  
      <tr>
	    <td class="normal14z" >單位成本： </td>
        <td class="normal14" ><select  tabIndex="5" id="mf005" onKeyPress="keyFunction()"  name="mf005" disabled="disabled">
             <option <?php if($mf005 == '0') echo 'selected="selected"';?> value='0'>0:整數</option>                                                                        
		     <option <?php if($mf005 == '1') echo 'selected="selected"';?> value='1'>1:小數一位</option>
			 <option <?php if($mf005 == '2') echo 'selected="selected"';?> value='2'>2:小數二位</option>                                                                        
		     <option <?php if($mf005 == '3') echo 'selected="selected"';?> value='3'>3:小數三位</option>
			 <option <?php if($mf005 == '4') echo 'selected="selected"';?> value='4'>4:小數四位</option>
		  </select>
		<td class="normal14z">成本金額：</td>
        <td class="normal14"><select  tabIndex="6" id="mf006" onKeyPress="keyFunction()"  name="mf006" disabled="disabled" >
             <option <?php if($mf006 == '0') echo 'selected="selected"';?> value='0'>0:整數</option>                                                                        
		     <option <?php if($mf006 == '1') echo 'selected="selected"';?> value='1'>1:小數一位</option>
			 <option <?php if($mf006 == '2') echo 'selected="selected"';?> value='2'>2:小數二位</option> 
		  </select>
	  </tr>	 
	  <tr>
	    <td  class="normal14z" >備註：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7"  onKeyPress="keyFunction()" size="60"  id="mf007" name="mf007" value="<?php echo $mf007; ?>" disabled="disabled"  /></td>
		<td class="normal14z">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	  
		
	</table>
	
	
	 <div>
          <table id="order_product" class="list1">
            <thead>
              <tr>
              <td width="5%"></td>			
		      <td width="11%" class="left">生效日期</td>
              <td width="15%" class="left">銀行買進匯率</td>
			  <td width="15%" class="left">銀行賣出匯率</td>
			  <td width="15%" class="left">報關買進匯率</td>
			  <td width="15%" class="left">報閞賣出匯率</td>
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
  	     <input type="hidden"  name="order_product[<?php echo $i ?>][mg001]" value="<?php echo $mg001[$i]; ?>" />
		 <td class="left"><input type="text" tabIndex="8"  onfocus="scwShow(this,event);" onclick="scwShow(this,event);"  id="mg002[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mg002]" value="<?php echo  substr($mg002[$i],0,4).'/'.substr($mg002[$i],4,2).'/'.substr($mg002[$i],6,2); ?>" size="10"  class="date" disabled="disabled" /></td>
		 <td class="left"><input type="text"  tabIndex="9" id="mg003" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mg003]" value="<?php echo $mg003[$i]; ?>" size="6" style="text-align:right;"  disabled="disabled" /></td>	
	     <td class="left"><input type="text"  tabIndex="10" id="mg004" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mg004]" value="<?php echo $mg004[$i]; ?>" size="6" style="text-align:right;" disabled="disabled" /></td>
		 <td class="left"><input type="text"  tabIndex="11" id="mg005" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mg005]" value="<?php echo $mg005[$i]; ?>" size="6" style="text-align:right;" disabled="disabled" /></td>
		 <td class="left"><input type="text"  tabIndex="12" id="mg006" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mg006]" value="<?php echo $mg006[$i]; ?>" size="6" style="text-align:right;" disabled="disabled" /></td>
	     </tr>
	     <?php $i=$i+1;  }?>
        </tbody>
            </tfoot>
          </table>
        </div>
	
	 </div>
	</div>
	<!--<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi06/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	</div> -->
	  
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
<?php  include_once("./application/views/funnew/fun_disabled_v.php"); ?> 