 <div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></a></div>
        <div class="div3">
	     <img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?=base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content"> <!-- div-3 --> 
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 職務類別資料建立作業 - 修改　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#mj001').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi09/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?=base_url()?>index.php/cms/cmsi09/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php $ii=0; ?>
	<?php foreach($result as $row) { ?>
          <?php   $mj001=$row->mj001;?>
          <?php   $mj002=$row->mj002;?>
		  <?php   $mj003=$row->mj003;?>
          <?php   $mj004=$row->mj004;?>
		  		
		 <!-- 明細 -->
		   <?php   $mk001[]=$row->mk001;?>
		   <?php   $mk002[]=$row->mk002;?>
		   <?php   $mk003[]=$row->mk003;?>
		   <?php   $mk004[]=$row->mk004;?>
		   <?php   $mk005[]=$row->mk005;?>
		   
		    <?php   $flag=$row->flag;?>
		  <?php   $mb991=' ';?>
		  <?php   $mb992=' ';?>
		  <?php   $mb999=' ';?>
	<?php $ii = $ii + 1 ; }?>
	
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="normal14y" width="8%" ><span class="required">職務代號：</span> </td>
        <td class="normal14a" width="42%" ><input   tabIndex="1" id="mj001" readonly="value"  onKeyPress="keyFunction()" onchange="startkey(this)" name="mj001" value="<?php echo $mj001; ?>" type="text" required />
	        <span id="keydisp" ></span></td>
		<td class="normal14y" width="8%" >職務名稱：</td>
        <td class="normal14a" width="42%" ><input type="text" tabIndex="2"  onKeyPress="keyFunction()" size="16"  id="mj003" name="mj003" value="<?php echo $mj003; ?>"   /></td>
	  </tr>
	 
	 <tr>
	    <td class="normal14z" >職務分類： </td>
        <td class="normal14" ><select  tabIndex="3" id="mj002" onKeyPress="keyFunction()"  name="mj002" >
             <option <?php if($mj002 == '1') echo 'selected="selected"';?> value='1'>1:物管</option>                                                                      
		     <option <?php if($mj002 == '2') echo 'selected="selected"';?> value='2'>2:生管</option>
			 <option <?php if($mj002 == '3') echo 'selected="selected"';?> value='3'>3:業務</option>                                                                        
		     <option <?php if($mj002 == '4') echo 'selected="selected"';?> value='4'>4:採購</option>
			 <option <?php if($mj002 == '5') echo 'selected="selected"';?> value='5'>5:會計</option>
			 <option <?php if($mj002 == '6') echo 'selected="selected"';?> value='6'>6:出納</option>
			 <option <?php if($mj002 == '7') echo 'selected="selected"';?> value='7'>7:倉庫</option>
			 <option <?php if($mj002 == '8') echo 'selected="selected"';?> value='8'>8:研發</option>
			 <option <?php if($mj002 == '9') echo 'selected="selected"';?> value="9">9:製造</option>
			 <option <?php if($mj002 == 'A') echo 'selected="selected"';?> value="A">A:品管</option>
			 <option <?php if($mj002 == 'B') echo 'selected="selected"';?> value="B">B:管理</option>
			 <option <?php if($mj002 == 'C') echo 'selected="selected"';?> value="C">C:工程</option>
			 <option <?php if($mj002 == 'D') echo 'selected="selected"';?> value="D">D:生技</option>	
			 <option <?php if($mj002 == 'E') echo 'selected="selected"';?> value="E">E:船務</option>
             <option <?php if($mj002 == 'F') echo 'selected="selected"';?> value="F">F:廠務</option>
			 <option <?php if($mj002 == 'G') echo 'selected="selected"';?> value="G">G:貿易</option>
			 <option <?php if($mj002 == 'H') echo 'selected="selected"';?> value="H">H:總務</option>	
			 <option <?php if($mj002 == 'I') echo 'selected="selected"';?> value="I">I:人事</option>
			 <option <?php if($mj002 == 'Z') echo 'selected="selected"';?> value="Z">Z:其他</option>

			 
		  </select>
		<td class="normal14z">備註：</td>
        <td class="normal14"><input type="text" tabIndex="4"  onKeyPress="keyFunction()" size="50"  id="mj004" name="mj004" value="<?php echo $mj004; ?>"   /></td>
	  </tr>
		
	</table>	
	
	
	  <div>
          <table id="order_product" class="list1">
            <thead>
              <tr>
              <td width="5%"></td>			
		      <td width="11%" class="left">人員代號</td>
              <td width="15%" class="left">人員姓名</td>
			  <td width="15%" class="left">備註</td>
            </tr>
            </thead>
      
    <!--   明細0  --> 
		<?php $i=0; $mproduct_row=0; $product_row='0'; ?>  
		    <input id="row_count" name="row_count" value="0" style="display:none;" />
			 
		<?php while ($i<$ii) { ?>
		<tbody  <?php echo 'id='.'product-row'.$product_row ?> >		
	     <tr>
	  <!--    <td class="center"><img src="<?=base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td> -->
           <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="刪除資料" onclick="del_detail('<?php echo $mj001;?>','<?php echo $mk002[$i]; ?>');" /></td>  	  	    
		<input type="hidden"  name="order_product[<?php echo $i ?>][mk001]" value="<?php echo $mk001[$i]; ?>" />
		 <input type="hidden"  name="order_product[<?php echo $i ?>][mk003]" value="<?php echo $mk003[$i]; ?>" />
		 <td class="left"><input type="text"  tabIndex="5" <?php echo 'id='.'mk002'.$i ?>   name="order_product[<?php echo $i ?>][mk002]" value="<?php echo $mk002[$i]; ?>" size="20" style="background-color:#E7EFEF"  /></td>
		
	     <td class="left"><input type="text"  tabIndex="6" id="mk004" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mk004]" value="<?php echo $mk004[$i]; ?>" size="20" style="text-align:left;"  /></td>
		 <td class="left"><input type="text"  tabIndex="7" id="mk005" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mk005]" value="<?php echo $mk005[$i]; ?>" size="60" style="text-align:left;"  /></td>
		 
	     </tr>	    
        </tbody>
        	<script>
		function del_detail(del_md001,del_md002){
			if(confirm('是否刪除此筆資料，單別:'+del_md001+'單號:'+del_md002))
			{
				$('#del_md001').val(del_md001);
				$('#del_md002').val(del_md002);
			
				$('#del_form').submit();
			}
		}
		</script>
        <?php $i++; $mproduct_row = (int) $product_row + 1; $product_row=(string)$mproduct_row;
		echo "<script>$('#row_count').val(".$product_row.")</script>";
		?>		
 <?php } ?>		
    <!-- javascrit 0 -->
	 
	<?php include("./application/views/fun/cmsi09_funjsupdjs_v.php"); ?> 
		 
		   <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
             <td class="center" valign="top"><img src="<?=base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			 <td class="left" colspan="11"></td>
            </tr>
			  
            </tfoot>
          </table>
        </div>
	 </div>
	 <!-- 合計     -->
		 
	 <td style="display:none;"><input id="select_rows" size="1" /></td>
	   
		
	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  <div class="buttons">
	<!--  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?=base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi09/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
	  <a  accesskey="a" onKeyPress="keyFunction()" onclick="addItem();" </a>
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
<form action="<?php echo base_url()?>index.php/cms/cmsi09/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
		</form>
 <?php include("./application/views/fun/cmsi09_funjsupd_v.php"); ?>