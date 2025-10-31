 <div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
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
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 會計期間設定作業 - 修改　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#mg001').focus();" type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?=base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('act/acti07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
	  
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?=base_url()?>index.php/act/acti07/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php $ii=0; ?>
	<?php foreach($result as $row) { ?>
          <?php   $mg001=$row->mg001;?>
          <?php   $mg002=substr($row->mg002,0,4).'/'.substr($row->mg002,4,2).'/'.substr($row->mg002,6,2);?>
		  <?php   $mg003=$row->mg003;?>
          
		  		
		 <!-- 明細 -->
		   <?php   $mh001[]=$row->mh001;?>
		   <?php   $mh002[]=$row->mh002;?>
		  
		    <?php  if ($row->mh003=='') {$mh003[]=$row->mh003;} else  {$mh003[]=substr($row->mh003,0,4).'/'.substr($row->mh003,4,2).'/'.substr($row->mh003,6,2);} ?>
             <?php  if ($row->mh004=='') {$mh004[]=$row->mh004;} else  {$mh004[]=substr($row->mh004,0,4).'/'.substr($row->mh004,4,2).'/'.substr($row->mh004,6,2);} ?>		  
		 
		  
		   
		    <?php   $flag=$row->flag;?>
		  <?php   $mb991=' ';?>
		  <?php   $mb992=' ';?>
		  <?php   $mb999=' ';?>
	<?php $ii = $ii + 1 ; }?>
	
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="normal14y" width="6%" ><span class="required">年度：</span> </td>
        <td class="normal14a" width="44%" ><input   tabIndex="1" id="mg001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mg001" value="<?php echo $mg001; ?>" type="text" size="10" required />
	        <span id="keydisp" ></span></td>
		<td class="normal14y" width="11%" >年度起始日期：</td>
        <td class="normal14a" width="39%" ><input tabIndex="2"  onclick="scwShow(this,event);"  class="date" id="mg002" onKeyPress="keyFunction()"  name="mg002"  value="<?php echo $mg002; ?>"  size="12" type="text"  style="background-color:#E7EFEF"  /></td>
	
	  </tr>
	 
	 <tr>
		<td class="normal14z">備註：</td>
        <td class="normal14"><input type="text" tabIndex="3"  onKeyPress="keyFunction()" size="50"  id="mg003" name="mg003" value="<?php echo $mg003; ?>"   /></td>
		<td class="normal14"></td>
        <td class="normal14"></td>
	  </tr>
		
	</table>	
	
	
	  <div>
          <table id="order_product" class="list1">
            <thead>
               <tr>
              <td width="5%"></td>			
		      <td width="11%" class="left">期別</td>
              <td width="15%" class="left">起始日期</td>
			  <td width="15%" class="left">截止日期</td>
            </tr>
            </thead>
      
    <!--   明細0  --> 
		<?php $i=0; $product_row='0'; ?>  
			 
		<?php while ($i<$ii) { ?>
		<tbody  <?php echo 'id='.'product-row'.$product_row ?> >		
	     <tr>
	     <td class="center"><img src="<?=base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td>
  	     <input type="hidden"  name="order_product[<?php echo $i ?>][mh001]" value="<?php echo $mh001[$i]; ?>" />
		
		 <td class="left"><input type="text"  tabIndex="51" <?php echo 'id='.'mh002'.$i ?>   name="order_product[<?php echo $i ?>][mh002]" value="<?php echo $mh002[$i]; ?>" size="6"  /></td>
		
	     <td class="left"><input type="text"  tabIndex="52" id="mh003" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mh003]" value="<?php echo $mh003[$i]; ?>" size="10" style="background-color:#E7EFEF" /></td>
		 <td class="left"><input type="text"  tabIndex="53" id="mh004" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][mh004]" value="<?php echo $mh004[$i]; ?>" size="10" style="background-color:#E7EFEF" /></td>
		 
	     </tr>	    
        </tbody>
        <?php $i++; ?>		
 <?php } ?>		
    <!-- javascrit 0 -->
	 
	<?php include("./application/views/fun/acti07_funjsupdjs_v.php"); ?> 
		 
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
	 
	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	 <!-- <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?=base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('act/acti07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
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

 <?php include("./application/views/fun/acti07_funjsupd_v.php"); ?>