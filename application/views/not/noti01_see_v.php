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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 銀行帳號建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti01/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	  </div>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/not/noti01/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>
	<div id="tab-general"> <!-- div-6 -->
	<?php $i=0; ?>
	<?php foreach($result as $row) { ?>
          <?php   $ma001=$row->ma001;?>
          <?php   $ma002=$row->ma002;?>
		  <?php   $ma003=$row->ma003;?>
          <?php   $ma004=$row->ma004;?>
          <?php   $ma005=$row->ma005;?>
          <?php   $ma006=$row->ma006;?>
		  <?php   $ma007=$row->ma007;?>
		  <?php   $ma008=$row->ma008;?>
		  <?php   $ma009=$row->ma009;?>
		  <?php   $ma010=$row->ma010;?>
		  <?php   $ma011=$row->ma011;?>
		  <?php   $ma012=$row->ma012;?>
		  <?php   $ma013=$row->ma013;?>
		  <?php   $ma014=$row->ma014;?>
		  <?php   $ma015=$row->ma015;?>
		  <?php   $ma016=$row->ma016;?>
		  <?php   $ma003_n=$row->ma003_n;?>
		 <!-- 明細 -->
		   <?php   $mb001[]=$row->mb001;?>
		   <?php   $mb002[]=$row->mb002;?>
		   <?php   $mb003[]=$row->mb003;?>
		   
		    <?php   $flag=$row->flag;?>	
		
		   <?php   $mb991=' ';?>
		   <?php   $mb992=' ';?>
		   <?php   $mb999=' ';?>
	<?php $i = $i + 1 ; }?>
      
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y" width="8%" ><span class="required">銀行代號：</span> </td>
        <td class="normal14a" width="42%" ><input   tabIndex="1" id="ma001" onKeyPress="keyFunction()" onchange="startkey(this)" name="ma001" value="<?php echo $ma001;?>"  type="text" disabled="disabled" />
	        <span id="keydisp" ></span></td>
		<td class="normal14y" width="8%" >備償帳戶</td>
        <td class="normal14a" width="42%" ><input type="checkbox" tabIndex="2" onKeyPress="keyFunction()"  id="ma011" name="ma011" value="1" <?php if($ma011) echo 'checked';?> disabled="disabled" /></td>
	  </tr>
	 
	 <tr>
	    <td class="normal14z" >銀行行號：</td>
        <td class="normal14" ><input  tabIndex="3" id="ma006" onKeyPress="keyFunction()"  name="ma006" value="<?php echo $ma006;?>" disabled="disabled" />
		<td class="normal14z">銀行帳號：</td>
        <td class="normal14"><input  tabIndex="4" id="ma004" onKeyPress="keyFunction()"  name="ma004" value="<?php echo $ma004;?>" disabled="disabled" />
	  </tr>
	  
      <tr>
	    <td class="normal14z" >銀行簡稱：</td>
        <td class="normal14" ><input  tabIndex="5" id="ma002" onKeyPress="keyFunction()"  name="ma002" value="<?php echo $ma002;?>" disabled="disabled" />
		<td class="normal14z">存款種類：</td>
        <td class="normal14">
		<select  tabIndex="6" id="ma012" onKeyPress="keyFunction()"  name="ma012" disabled="disabled" >
             <option <?php if($ma012 == '1') echo 'selected="selected"';?> value='1'>1:活存</option>                                                                        
		     <option <?php if($ma012 == '2') echo 'selected="selected"';?> value='2'>2:支存</option>
			 <option <?php if($ma012 == '3') echo 'selected="selected"';?> value='3'>3:其他</option> 
		  </select>
	  </tr>
	  <tr>
		<td class="normal14z" >銀行全名：</td>
        <td class="normal14" ><input  tabIndex="7" id="ma003" onKeyPress="keyFunction()"  name="ma003" value="<?php echo $ma003;?>" disabled="disabled" />
		<td class="normal14" ></td>
        <td class="normal14" ></td>
	  </tr>
	  <tr>
		<td class="normal14z" >銀行存款科目：</td>
        <td class="normal14" ><input  tabIndex="8" id="ma005" onKeyPress="keyFunction()"  name="ma005" value="<?php echo $ma005;?>" disabled="disabled" /><span><?php echo $ma003_n;?></span>
		<td class="normal14" ></td>
        <td class="normal14" ></td>
	  </tr>
	  <tr>
		<td class="normal14z" >聯絡人：</td>
        <td class="normal14" ><input  tabIndex="9" id="ma007" onKeyPress="keyFunction()"  name="ma007" value="<?php echo $ma007;?>" disabled="disabled" />
		<td class="normal14z">戶名：</td>
        <td class="normal14"><input  tabIndex="10" id="ma015" onKeyPress="keyFunction()"  name="ma015" value="<?php echo $ma015;?>" disabled="disabled" />
	  </tr>
	  <tr>
		<td class="normal14z" >電話：</td>
        <td class="normal14" ><input  tabIndex="11" id="ma008" onKeyPress="keyFunction()"  name="ma008" value="<?php echo $ma008;?>" disabled="disabled" />
		<td class="normal14z" >統編/身分證號：</td>
        <td class="normal14" ><input  tabIndex="12" id="ma016" onKeyPress="keyFunction()"  name="ma016" value="<?php echo $ma016;?>" disabled="disabled" />
	  </tr>
	  <tr>
		<td class="normal14z" >FAX NO：</td>
        <td class="normal14" ><input  tabIndex="13" id="ma014" onKeyPress="keyFunction()"  name="ma014" value="<?php echo $ma014;?>" disabled="disabled" />
		<td class="normal14z" >備註：</td>
        <td class="normal14" ><input  tabIndex="14" id="ma013" onKeyPress="keyFunction()"  name="ma013" value="<?php echo $ma013;?>" disabled="disabled" />
	  </tr>
	  <tr>
	    <td class="normal14z" >地址：</td>
        <td class="normal14" ><input type="text" tabIndex="15"  onKeyPress="keyFunction()" size="60"  id="ma009" name="ma009" value="<?php echo $ma009;?>" disabled="disabled" /></td>
		<td class="normal14" ></td>
        <td class="normal14" ></td>
	  </tr>
	  <tr>
	    <td class="normal14" > </td>
        <td class="normal14"  ><input type="text" tabIndex="16"  onKeyPress="keyFunction()" size="60"  id="ma010" name="ma010" value="<?php echo $ma010;?>" disabled="disabled" /></td>
		<td class="normal14" ></td>
        <td class="normal14" ></td>
	  </tr>
	  
		
	</table>
	
	
	 <div>
          <table id="order_product" class="list1">
            <thead>
              <tr>
              <td width="5%"></td>			
		      <td width="11%" class="left">幣別</td>
              <td width="15%" class="left">存款餘額</td>
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
  	     <input type="hidden"  name="order_product[<?php echo $i ?>][mb001]" value="<?php echo $mb001[$i]; ?>" />
		 <td class="left"><input type="text" tabIndex="17" id="mb002[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mb002]" value="<?php echo $mb002[$i]; ?>" size="10" disabled="disabled" /></td>
		 <td class="left"><input type="text"  tabIndex="18" id="mb003[<?php echo $i ?>]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mb003]" value="<?php echo $mb003[$i]; ?>" size="6" style="text-align:right;" disabled="disabled" /></td>
	     </tr>
	     <?php $i=$i+1;  }?>
        </tbody>
            </tfoot>
          </table>
        </div>
	
	 </div>
	</div>
	<!--<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti01/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
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
