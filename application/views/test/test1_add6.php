<div id="content"> 
  
 <div class="box">
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 品號類別資料建立作業</h1>
 <!-- 	  <form class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?=base_url()?>index.php/inv/invi01/addsave" > -->
	  <div class="buttons">
	
	  <!--   <button type='submit'  name='submit' class="button" value='儲存'><span>儲存</span></button>
	    <a href="<?php echo site_url('inv/invi01/display'); ?>" class="button" ><span>取消</span></a> -->
	   <!--   <a onclick="$('#form').submit();" class="button"><span>儲存</span></a>  -->
		  
	  </div>
    </div>
    <div class="content">
	<!-- 	 <form class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?=base_url()?>index.php/inv/invi01/addsave" >	 -->
	<form class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?=base_url()?>index.php/inv/invi01/addsave" >	
	<div id="htabs" class="htabs"><span>編輯項目-新增</span></div>
	
	<div id="tab-general">
	<?php
	$date=date("Ymd");
	$ma001=$this->input->post('ma001');
	$ma002=$this->input->post('ma002');
	$ma003=$this->input->post('ma003');
	$ma004=$this->input->post('ma004');
	$ma005=$this->input->post('ma005');
	$ma006=$this->input->post('ma006');	
		
	?>
    <!--  <form action="<?=base_url()?>index.php/inv/invi01/addsave" method="post" enctype="multipart/form-data" id="form">  -->
    <!--     <div id="tab-general">  -->
<!-- <form class="cmx1form" id="commentForm" method="post" action="">  -->
<!--  <form class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?=base_url()?>index.php/inv/invi01/addsave" >	 -->
	
		 
		<table class="form" >
		<tr>
			<td width="10%">&nbsp;&nbsp;分類方式：</td>
            <td width="40%" >
				<select id="ma001" name="ma001" ">
                	<option <?php if($ma001 == '1') echo 'selected="selected"';?> value='1'>會計</option>                                                                        
				    <option <?php if($ma001 == '2') echo 'selected="selected"';?> value='2'>商品</option>
                    <option <?php if($ma001 == '3') echo 'selected="selected"';?> value='3'>類別</option>
                    <option <?php if($ma001 == '4') echo 'selected="selected"';?> value='4'>生管</option>
				</select>
			</td>
			
			<td width="10%">&nbsp;&nbsp;狀　　態：</td>
            <td width="40%"><select id="status" name="status">
                            <option value="1" selected="selected">確認</option>
                            <option value="0">待處理</option>
				            <option value="2">作廢</option>
                            </select></td>
		  </tr>		  
		  <tr>
			<td ><span class="required">*</span> 品號類別代號：</td>
            <td ><input  id="ma002" name="ma002"  value="<?php echo $ma002; ?>"   size="10" type="text" required /></td>
			
			<td >&nbsp;&nbsp;品號類別名稱：</td>
            <td ><input  id="ma003" name="ma003"   value="<?php echo $ma003; ?>"    size="5" type="text" required /></td>
		  </tr>
		  <tr>
			<td >&nbsp;&nbsp;存貨會計科目：</td>
            <td ><input  id="ma004" name="ma004"  value="<?php echo $ma004; ?>"  size="20"  minlength="2" type="text" required /></td>
			
						<td >&nbsp;&nbsp;銷貨收入科目：</td>						
            <td ><input id="ma005" name="ma005"   value="<?php echo $ma005; ?>"  minlength="2" type="text" required /></td>
					  </tr>
		  <tr>
			<td ><span class="required">*</span> 銷貨退回科目：</td>
            <td ><input  id="ma006" name="ma006"  value="<?php echo $ma006; ?>" size="20" type="text" required  />		  
				</td>
			
			<td>&nbsp;&nbsp;</td>
            <td></td>
			
		  </tr>
		
		
	   </table>
	   <input type='hidden' name='company' id='company' value='DERSHENG' />
		<input type='hidden' name='creator' id='creator' value='89044' />
		<input type='hidden' name='usr_group' id='usr_group' value='test' />
		<input type='hidden' name='create_date' id='create_date' value="<?php $date; ?>" />
		<input type='hidden' name='modifier' id='modifier' value='' />
		<input type='hidden' name='modi_date' id='modi_date' value='' />
		<input type='hidden' name='flag' id='flag' value=0 />
		<div class="buttons">
		<button type='submit'  name='submit' class="button" value='儲存'><span>儲存</span></button>
	    <a href="<?php echo site_url('inv/invi01/display'); ?>" class="button" ><span>取消</span></a>
		</div> 
</form>
</div> 
  </div>
  </div>
  
 </div>