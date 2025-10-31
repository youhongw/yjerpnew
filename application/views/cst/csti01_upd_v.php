 <div id="container">   <!-- div-1 -->
  <div id="header">     <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	   </div>
    </div>

<div id="content">   <!-- div-3 -->
 <div class="box">   <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 成本參數設定作業 - 修改</h1>
    </div>
	
    <div class="content">  <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cst/csti01/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general">   <!-- div-tab -->
	<?php
    date_default_timezone_set("Asia/Taipei");
	?>
	
	<?php foreach($results as $row ) : ?>
          <?php  $ma001c[]=$row->ma001;?>
          <?php  $ma002c[]=$row->ma002;?>
          <?php  $ma003c[]=$row->ma003;?>
          <?php  $ma004c[]=$row->ma004;?>
          <?php  $ma005c[]=$row->ma005;?>
          <?php  $ma006c[]=$row->ma006;?>
		  <?php  $ma007c[]=$row->ma007;?>
		  <?php  $ma008c[]=$row->ma008;?>
		  <?php  $ma009c[]=$row->ma009;?>
		  <?php  $companyc[]=$row->company;?>
		  <?php  $creatorc[]=$row->creator;?>
		  <?php  $usr_groupc[]=$row->usr_group;?>
		  <?php  $create_datec[]=$row->create_date;?>
		  <?php  $modifierc[]=$row->modifier;?>
		  <?php  $modi_datec[]=$row->modi_date;?>
          <?php  $flagc[]=$row->flag;?>	  
	 <?php endforeach;?>
	 
	 <?php $ma001=$ma001c[0];?>
	 <?php $ma002=$ma002c[0];?>
	 <?php $ma003=$ma003c[0];?>
	 <?php $ma004=$ma004c[0];?>
	 <?php $ma005=$ma005c[0];?>
	 <?php $ma006=$ma006c[0];?>
	 <?php $ma007=$ma007c[0];?>
	 <?php $ma008=$ma008c[0];?>
	 <?php $ma009=$ma009c[0];?>
	 <?php $company=$companyc[0];?>
	 <?php $usr_group=$usr_groupc[0];?>
	 <?php $create_date=substr($create_datec[0],0,4).'/'.substr($create_datec[0],4,2).'/'.substr($create_datec[0],6,2);?>
	 <?php $modifier=$modifierc[0];?>
	 <?php $modi_date=substr($modi_datec[0],0,4).'/'.substr($modi_datec[0],4,2).'/'.substr($modi_datec[0],6,2);?>
	 <?php $flagc=$flagc[0];?>
       
	<table class="form14">  <!-- 表格 -->
	  <tr>
	    <td align="left" class="start14a"  width="18%"><span class="required">成本分類方式：</span></td>
        <td align="left" class="normal14a"  width="82%"><input tabIndex="1" id="ma001" onKeyPress="keyFunction()" type="text" name="ma001"  value="<?php echo $ma001; ?>"  disabled="disabled" />會計</td>
	   		
	  </tr>
		 
	  <tr>
	    <td align="left" class="normal14" >材料在製約量計算方式：</td>
        <td align="left" class="normal14" ><select id="ma002" onKeyPress="keyFunction()" name="ma002"  tabIndex="9">
            <option <?php if($ma002 == '1') echo 'selected="selected"';?> value='1'>1依實際投入材料成本計算</option>                                                                        
		    <option <?php if($ma002 == '2') echo 'selected="selected"';?> value='2'>2依投入套數計算</option>
			<option <?php if($ma002 == '3') echo 'selected="selected"';?> value='3'>3無在製約當產量</option>
		    <option <?php if($ma002 == '4') echo 'selected="selected"';?> value='4'>4依實際投入工時計算</option>
		  </td>
	   
	  </tr>
	   <tr>
	    <td align="left" class="normal14" >人工製費在製約量計算方式：</td>
        <td align="left" class="normal14" ><select id="ma003" onKeyPress="keyFunction()" name="ma003"  tabIndex="9">
            <option <?php if($ma003 == '1') echo 'selected="selected"';?> value='1'>1依實際投入材料成本計算</option>                                                                        
		    <option <?php if($ma003 == '2') echo 'selected="selected"';?> value='2'>2依投入套數計算</option>
			<option <?php if($ma003 == '3') echo 'selected="selected"';?> value='3'>3無在製約當產量</option>
		    <option <?php if($ma003 == '4') echo 'selected="selected"';?> value='4'>4依實際投入工時計算</option>
		  </td>
	   
	  </tr>
		<tr>
	    <td align="left" class="normal14" >加工費用在製約量計算方式：</td>
        <td align="left" class="normal14" ><select id="ma006" onKeyPress="keyFunction()" name="ma006"  tabIndex="9">
            <option <?php if($ma006 == '1') echo 'selected="selected"';?> value='1'>1依實際投入材料成本計算</option>                                                                        
		    <option <?php if($ma006 == '2') echo 'selected="selected"';?> value='2'>2依投入套數計算(領料)</option>
			<option <?php if($ma006 == '3') echo 'selected="selected"';?> value='3'>3無在製約當產量</option>
		    <option <?php if($ma006 == '4') echo 'selected="selected"';?> value='4'>4依標準加工費用計算</option>
		  </td>
	   
	  </tr>
	  <tr>
	    <td align="left" class="normal14" >工資率及製費分攤率採：</td>
        <td align="left" class="normal14" ><input type="radio" tabIndex="4" name="ma004" <?php if (isset($ma004) && $ma004=="Y") echo "checked";?> value="Y" />標準&nbsp;&nbsp;&nbsp; 
        <input type="radio" tabIndex="5" name="ma004" <?php if (isset($ma004) && $ma004=="2") echo "checked";?> value="N" />實際
        </td>
	    
	  </tr>
	  <tr>
	    <td align="left" class="normal14" >聯產品成本分攤方式：</td>
        <td align="left" class="normal14" ><input type="radio" tabIndex="4" name="ma007" <?php if (isset($ma007) && $ma007=="Y") echo "checked";?> value="Y" />依數量&nbsp;&nbsp;&nbsp; 
        <input type="radio" tabIndex="5" name="ma007" <?php if (isset($ma007) && $ma007=="2") echo "checked";?> value="N" />依比率
        </td>
	    
	  </tr>
	  <tr>
	  <td align="left" class="normal14" >半成品投入歸成上階材料成本：</td>
	  <td align="left" class="normal14"   ><input type="hidden" name="ma005" value="N" />
		  <input tabIndex="28" id="ma005" onKeyPress="keyFunction()" name="ma005" <?php if($ma005 == 'Y' ) echo 'checked'; ?>  <?php if($ma005 !== 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td>		
	  </tr>
	  <tr>
	   <td align="left" class="normal14" >分攤生產線別：</td>
        <td align="left" class="normal14" ><input tabIndex="9" id="ma009" onKeyPress="keyFunction()"  type="text" name="modifier"   value="<?php echo $modifier; ?>"  /></td>
        
	  </tr>
	    <td align="left" class="normal14" ><input  type="hidden" tabIndex="10" onfocus="scwShow(this,event);" onclick="scwShow(this,event);" id="datepicker2"  class="modi_date"    name="modi_date"   value="<?php echo $modi_date; ?>" style="background-color:#E7EFEF" /></td>
    </table>
		
	  <div class="buttons">
	    <button tabIndex="8" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('main/index/134'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>
	   
    </form>
    </div>    <!-- div-tab -->
  </div>      <!-- div-5 -->
</div>        <!-- div-4 -->
    <?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div>   <!-- div-3 -->
  </div>     <!-- div-2 -->
</div>       <!-- div-1 -->
  <?php include("./application/views/fun/csti01_funjs_v.php"); ?>