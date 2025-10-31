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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 生產線別資料建立作業　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi04/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	  </div>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cms/cmsi04/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="tab-general"> <!-- div-6 -->
	<?php $i=0; ?>
	<?php foreach($result as $row) { ?>
          <?php   $md001=$row->md001;?>
          <?php   $md002=$row->md002;?>
		  <?php   $cmsq02a=$row->md003;?>
		  <?php   $cmsq02adisp=$row->md003disp;?>
          <?php   $md004=$row->md004;?>
          <?php   $md005=$row->md005;?>
          <?php   $md006=$row->md006;?>
		  <?php   $md007=$row->md007;?>
		  <?php   $md008=$row->md008;?>
          <?php   $md009=$row->md009;?>
          <?php   $md010=$row->md010;?>
		  <?php   $md011=$row->md011;?>
		  
		  		
		 <!-- 明細 -->
		   <?php   $mx001[]=$row->mx001;?>
		   <?php   $mx002[]=$row->mx002;?>
		   <?php   $mx003[]=$row->mx003;?>
		   <?php   $mx004[]=$row->mx004;?>
		   <?php   $mx005[]=$row->mx005;?>
		   <?php   $mx006[]=$row->mx006;?>
		   
		    <?php   $flag=$row->flag;?>
		
		   <?php   $mb991=' ';?>
		   <?php   $mb992=' ';?>
		   <?php   $mb999=' ';?>
	<?php $i = $i + 1 ; }?>
      
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="normal14y" width="14%" ><span class="required">生產線別：</span> </td>
        <td class="normal14a" width="36%" ><input   tabIndex="1" id="md001" onKeyPress="keyFunction()" onchange="startkey(this)" name="md001" value="<?php echo $md001; ?>"  type="text" required disabled="disabled"/>
	        <span id="keydisp" ></span></td>
		<td class="normal14y" width="14%" >生產線別名稱：</td>
        <td class="normal14a" width="36%" ><input type="text" tabIndex="2"  onKeyPress="keyFunction()"  id="md002" name="md002" value="<?php echo $md002; ?>"  disabled="disabled" /></td>
	  </tr>
	  <tr>
		 <td class="normal14z" >廠別：</td>						
         <td  class="normal14"  ><input type="text" tabIndex="3" onKeyPress="keyFunction()" id="md003"  onchange="startcmsq02a(this)" name="cmsq02a"   value="<?php echo  $cmsq02a; ?>"   disabled="disabled"  /><a href="javascript:;"><img id="Showcmsq02a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	     <span id="cmsq02adisp"> <?php    echo $cmsq02adisp; ?> </span></td>
		 <td  class="normal14z">日人工產能(人時)：</td>						
         <td  class="normal14"  ><input tabIndex="4" id="md004" onKeyPress="keyFunction()" name="md004"   value="<?php echo $md004; ?>"  size="10"  type="text" disabled="disabled" /></td>
	  </tr>
	   <tr>
		 <td  class="normal14z">日機器產能(機時)：</td>						
         <td  class="normal14"  ><input tabIndex="5" id="md005" onKeyPress="keyFunction()" name="md005"   value="<?php echo $md005; ?>"  size="10"  type="text" disabled="disabled" /></td>
		 <td  class="normal14z">標準人工效率%：</td>						
         <td  class="normal14"  ><input tabIndex="6" id="md006" onKeyPress="keyFunction()" name="md006"   value="<?php echo $md006; ?>"  size="10"  type="text" disabled="disabled" /></td>
	  </tr>
	  <tr>
		 <td  class="normal14z">標準機器負荷%：</td>						
         <td  class="normal14"  ><input tabIndex="7" id="md007" onKeyPress="keyFunction()" name="md007"   value="<?php echo $md007; ?>"  size="10"  type="text" disabled="disabled" /></td>
		 <td  class="normal14z">製費分攤：</td>						
         <td  class="normal14"  ><select  tabIndex="8" id="md008" onKeyPress="keyFunction()"  name="md008" disabled="disabled">
		     <option <?php if($md008 == '1') echo 'selected="selected"';?> value='1'>1:人時</option>
			 <option <?php if($md008 == '2') echo 'selected="selected"';?> value='2'>2:機時</option>                                                                        
		     <option <?php if($md008 == '3') echo 'selected="selected"';?> value='3'>3:人工</option>
		  </select>
	  </tr>
	  <tr>
		 <td  class="normal14z">標準人工成本(人時)：</td>						
         <td  class="normal14"  ><input tabIndex="9" id="md009" onKeyPress="keyFunction()" name="md009"   value="<?php echo $md009; ?>"  size="10"  type="text"  /></td>
		 <td  class="normal14z">標準製造費用(人時)：</td>						
         <td  class="normal14"  ><input tabIndex="10" id="md010" onKeyPress="keyFunction()" name="md010"   value="<?php echo $md010; ?>"  size="10"  type="text"  /></td>
	  </tr>
	 
	  <tr>
	    <td  class="normal14z" >備註：</td>
        <td  class="normal14"  ><input type="text" tabIndex="11"  onKeyPress="keyFunction()" size="60"  id="md011" name="md011" value="<?php echo $md011; ?>"   /></td>
		<td class="normal14z">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	</table>
	
	
	 <div>
          <table id="order_product" class="list1">
            <thead>
              <tr>
              <td width="5%"></td>			
		      <td width="11%" class="left">機台代號</td>
              <td width="15%" class="left">機台名稱</td>
			  <td width="15%" class="left">機器產能</td>
			  <td width="15%" class="left">負荷率</td>
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
	     <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td>
  	     <input type="hidden"  name="order_product[<?php echo $i ?>][mx001]" value="<?php echo $mx001[$i]; ?>" />
		  <td class="left"><input type="text"  tabIndex="15" id="mx001" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mx001]" value="<?php echo $mx001[$i]; ?>" size="10" style="text-align:right;"  disabled="disabled" /></td>
		 <td class="left"><input type="text"  tabIndex="16" id="mx003" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mx003]" value="<?php echo $mx003[$i]; ?>" size="20" style="text-align:right;"  disabled="disabled" /></td>	
	     <td class="left"><input type="text"  tabIndex="17" id="mx004" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mx004]" value="<?php echo $mx004[$i]; ?>" size="20" style="text-align:right;" disabled="disabled" /></td>
		 <td class="left"><input type="text"  tabIndex="18" id="mx005" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mx005]" value="<?php echo $mx005[$i]; ?>" size="10" style="text-align:right;" disabled="disabled" /></td>
		 <td class="left"><input type="text"  tabIndex="19" id="mx006" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mx006]" value="<?php echo $mx006[$i]; ?>" size="20" style="text-align:right;" disabled="disabled" /></td>
	     </tr>
	     <?php $i=$i+1;  }?>
        </tbody>
            </tfoot>
          </table>
        </div>
	
	 </div>
	</div>
	<!--<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi04/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	</div> -->
	  
      </form>
	  <br>
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
<?php  include_once("./application/views/funnew/fun_disabled_v.php"); ?>