<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?=base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>
	    </div>
    </div>

<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> mymy訂單列印&導出 - 查看</h1>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?=base_url()?>index.php/mym/mymr01/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>
	<div id="tab-general"> <!-- div-6 -->
	<?php $i=0; ?>
		<?php $ii=0; ?>
	<?php foreach($result as $row) { ?>
	       <?php //  $uid = $row->uid; ?>
          <?php  $ta001 = $row->ta001; ?>
			  <?php  $ta002 = $row->ta002; ?>
              <?php  $ta003 = $row->ta003; ?>
              <?php  $ta004 = $row->ta004; ?>
			  <?php  $ta005 = $row->ta005; ?>
			  <?php  $ta006 = $row->ta006; ?>
              <?php  $ta007 = $row->ta007; ?>
              <?php  $ta008 = $row->ta008; ?>
			  <?php  $ta009 = $row->ta009; ?>
			  <?php  $ta010 = $row->ta010; ?>
			  <?php  $ta011 = $row->ta011; ?>
			  <?php  $ta012 = $row->ta012; ?>
			  <?php  $ta013 = $row->ta013; ?>
			  <?php  $ta014 = $row->ta014; ?>
			  <?php  $ta015 = $row->ta015; ?>
			  <?php  $ta016 = $row->ta016; ?>
			  <?php  $ta017 = $row->ta017; ?>
			  <?php  $ta018 = $row->ta018; ?>
			  <?php  $ta019 = $row->ta019; ?>
			  <?php  $ta020 = $row->ta020; ?>
			  <?php  $ta021 = $row->ta021; ?>
			  <?php  $ta022 = $row->ta022; ?>
			  <?php  $ta023 = $row->ta023; ?>
			  <?php  $ta024 = $row->ta024; ?>
			  <?php  $ta025 = $row->ta025; ?>
			  <?php  $ta026 = $row->ta026; ?>
			  <?php  $ta027 = $row->ta027; ?>
			  <?php  $ta028 = $row->ta028; ?>
			  <?php  $ta029 = $row->ta029; ?>
			  
			  <?php  $ta030 = $row->ta030; ?>
			  <?php  $ta031 = $row->ta031; ?>
			  <?php  $ta032 = $row->ta032; ?>
			  <?php  $ta033 = $row->ta033; ?>
			  <?php  $ta034 = $row->ta034; ?>
			  <?php  $ta035 = $row->ta035; ?>
		
		
		  
		  <?  $mb991=' ';?>
		  <?  $mb992=' ';?>
		  <?  $mb999=' ';?>
		
	<?php $ii = $ii + 1 ; }?>
      
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="10%"><span class="required">訂單時間：</span> </td>
        <td class="normal14a"  width="22%"><input tabIndex="1" id="ta001"   onKeyPress="keyFunction()"  name="ta001" value="<?php echo $ta001; ?>"  type="text"  disabled="disabled" /></td>
	    <td class="start14a" width="10%" ><span class="required">訂單編號：</span> </td>
        <td class="normal14a"  width="24%" ><input tabIndex="2" id="ta002"   onKeyPress="keyFunction()"  name="ta002" value="<?php echo $ta002; ?>"  type="text"  disabled="disabled" /></td>
		<td class="normal14a" width="10%" >購買人： </td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="ta003"   onKeyPress="keyFunction()"  name="ta003" value="<?php echo $ta003; ?>"  type="text"  disabled="disabled" /></td>
	  </tr>	
	  <tr>
		 <td class="normal14">購買人市話：</td>
        <td  class="normal14"  ><input tabIndex="4" id="ta004"   onKeyPress="keyFunction()"  name="ta004" value="<?php echo $ta004; ?>"  type="text"  disabled="disabled" /></td>
	     <td class="normal14" >購買人手機：</td>
        <td class="normal14a" ><input tabIndex="5" id="ta005"   onKeyPress="keyFunction()"  name="ta005" value="<?php echo $ta005; ?>"  type="text"  disabled="disabled" /></td>
		 <td class="normal14" >購買人地址：</td>
        <td class="normal14a" ><input tabIndex="6" id="ta006"   onKeyPress="keyFunction()"  name="ta006" value="<?php echo $ta006; ?>"  type="text" size="40" disabled="disabled" /></td>
		
	  </tr>
		<tr>
	    <td class="normal14" >購買人EMAIL：</td>
        <td class="normal14" ><input tabIndex="7" id="ta007"   onKeyPress="keyFunction()"  name="ta007" value="<?php echo $ta007; ?>"  type="text"  disabled="disabled" /></td>
		<td class="normal14">收件人：</td>
        <td  class="normal14"  ><input tabIndex="8" id="ta008"   onKeyPress="keyFunction()"  name="ta008" value="<?php echo $ta008; ?>"  type="text"  disabled="disabled" /></td>  
	    <td class="normal14" >收件人市話：</td>						
        <td  class="normal14"  ><input tabIndex="9" id="ta009"   onKeyPress="keyFunction()"  name="ta009" value="<?php echo $ta009; ?>"  type="text"  disabled="disabled" /></td>
	  </tr>
	  <tr>
	    <td class="normal14" >收件人手機：</td>
        <td class="normal14" ><input tabIndex="10" id="ta010"   onKeyPress="keyFunction()"  name="ta010" value="<?php echo $ta010; ?>"  type="text"  disabled="disabled" /></td>
		<td class="normal14">收件人地址：</td>
        <td  class="normal14"  ><input tabIndex="11" id="ta011"   onKeyPress="keyFunction()"  name="ta011" value="<?php echo $ta011; ?>"  type="text" size="40"  disabled="disabled" /></td>  
	    <td class="normal14" >發票號碼：</td>						
        <td  class="normal14"  ><input tabIndex="12" id="ta012"   onKeyPress="keyFunction()"  name="ta012" value="<?php echo $ta012; ?>"  type="text"  disabled="disabled" /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >發票抬頭：</td>
        <td class="normal14" ><input tabIndex="13" id="ta013"   onKeyPress="keyFunction()"  name="ta013" value="<?php echo $ta013; ?>"  type="text"  disabled="disabled" /></td>
		<td class="normal14">統一編號：</td>
        <td  class="normal14"  ><input tabIndex="14" id="ta014"   onKeyPress="keyFunction()"  name="ta014" value="<?php echo $ta014; ?>"  type="text"  disabled="disabled" /></td>  
	    <td class="normal14" >付款方式：</td>						
        <td  class="normal14"  ><input tabIndex="15" id="ta015"   onKeyPress="keyFunction()"  name="ta015" value="<?php echo $ta015; ?>"  type="text"  disabled="disabled" /></td>
	  </tr>
	  <tr>
	    <td class="normal14" >配送方式：</td>
        <td class="normal14" ><input tabIndex="16" id="ta016"   onKeyPress="keyFunction()"  name="ta016" value="<?php echo $ta016; ?>"  type="text"  disabled="disabled" /></td>
		<td class="normal14">商品價格：</td>
        <td  class="normal14"  ><input tabIndex="17" id="ta017"   onKeyPress="keyFunction()"  name="ta017" value="<?php echo $ta017; ?>"  type="text"  disabled="disabled" /></td>  
	    <td class="normal14" >運費總額：</td>						
        <td  class="normal14"  ><input tabIndex="18" id="ta018"   onKeyPress="keyFunction()"  name="ta018" value="<?php echo $ta018; ?>"  type="text"  disabled="disabled" /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >附加服務：</td>
        <td class="normal14" ><input tabIndex="19" id="ta019"   onKeyPress="keyFunction()"  name="ta019" value="<?php echo $ta019; ?>"  type="text"  disabled="disabled" /></td>
		<td class="normal14">訂單總額：</td>
        <td  class="normal14"  ><input tabIndex="20" id="ta020"   onKeyPress="keyFunction()"  name="ta020" value="<?php echo $ta020; ?>"  type="text"  disabled="disabled" /></td>  
	    <td class="normal14" >應收金額：</td>						
        <td  class="normal14"  ><input tabIndex="21" id="ta021"   onKeyPress="keyFunction()"  name="ta021" value="<?php echo $ta021; ?>"  type="text"  disabled="disabled" /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >實收金額：</td>
        <td class="normal14" ><input tabIndex="22" id="ta022"   onKeyPress="keyFunction()"  name="ta022" value="<?php echo $ta022; ?>"  type="text"  disabled="disabled" /></td>
		<td class="normal14">訂單狀態：</td>
        <td  class="normal14"  ><input tabIndex="23" id="ta023"   onKeyPress="keyFunction()"  name="ta023" value="<?php echo $ta023; ?>"  type="text"  disabled="disabled" /></td>  
	    <td class="normal14" >發貨狀態：</td>						
        <td  class="normal14"  ><input tabIndex="24" id="ta024"   onKeyPress="keyFunction()"  name="ta024" value="<?php echo $ta024; ?>"  type="text"  disabled="disabled" /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >宅配公司：</td>
        <td class="normal14" ><input tabIndex="25" id="ta025"   onKeyPress="keyFunction()"  name="ta025" value="<?php echo $ta025; ?>"  type="text"  disabled="disabled" /></td>
		<td class="normal14">貨運單號：</td>
        <td  class="normal14"  ><input tabIndex="26" id="ta026"   onKeyPress="keyFunction()"  name="ta026" value="<?php echo $ta026; ?>"  type="text"  disabled="disabled" /></td>  
	    <td class="normal14" >出貨時間：</td>						
        <td  class="normal14"  ><input tabIndex="27" id="ta027"   onKeyPress="keyFunction()"  name="ta027" value="<?php echo $ta027; ?>"  type="text"  disabled="disabled" /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >購買備註：</td>
        <td class="normal14" ><input tabIndex="28" id="ta028"   onKeyPress="keyFunction()"  name="ta028" value="<?php echo $ta028; ?>"  type="text"  disabled="disabled" /></td>
		<td class="normal14">店長訂單備註：</td>
        <td  class="normal14"  ><input tabIndex="29" id="ta029"   onKeyPress="keyFunction()"  name="ta029" value="<?php echo $ta029; ?>"  type="text"  disabled="disabled" /></td>  
	    <td class="normal14" >訂單商品：</td>						
        <td  class="normal14"  ><input tabIndex="30" id="ta030"   onKeyPress="keyFunction()"  name="ta030" value="<?php echo $ta030; ?>"  type="text"  disabled="disabled" /></td>
	  </tr>
	  <tr>
	    <td class="normal14" >購買備註：</td>
        <td class="normal14" ><input tabIndex="31" id="ta031"   onKeyPress="keyFunction()"  name="ta031" value="<?php echo $ta031; ?>"  type="text"  disabled="disabled" /></td>
		<td class="normal14">店長訂單備註：</td>
        <td  class="normal14"  ><input tabIndex="32" id="ta032"   onKeyPress="keyFunction()"  name="ta032" value="<?php echo $ta032; ?>"  type="text"  disabled="disabled" /></td>  
	    <td class="normal14" >訂單商品：</td>						
        <td  class="normal14"  ><input tabIndex="33" id="ta033"   onKeyPress="keyFunction()"  name="ta033" value="<?php echo $ta033; ?>"  type="text"  disabled="disabled" /></td>
	  </tr>
	  <tr>
	    <td class="normal14" >商品單價：</td>
        <td class="normal14" ><input tabIndex="34" id="ta034"   onKeyPress="keyFunction()"  name="ta034" value="<?php echo $ta034; ?>"  type="text"  disabled="disabled" /></td>
		<td class="normal14">商品小計：</td>
        <td  class="normal14"  ><input tabIndex="35" id="ta035"   onKeyPress="keyFunction()"  name="ta035" value="<?php echo $ta035; ?>"  type="text"  disabled="disabled" /></td>  
	<!--    <td class="normal14" >流水號：</td>						
        <td  class="normal14"  ><input tabIndex="36" id="uid"   onKeyPress="keyFunction()"  name="uid" value="<?php echo $uid; ?>"  type="text"  disabled="disabled" /></td>  -->
	  </tr>
		
		
	</table>
	
	<div class="abgne_tab"> <!-- div-7 -->
	  
		<!-- 合計     -->	
	<div class="buttons">
	<!-- <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span></button>&nbsp;&nbsp;&nbsp;&nbsp;  -->
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('mym/mymr01/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
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
