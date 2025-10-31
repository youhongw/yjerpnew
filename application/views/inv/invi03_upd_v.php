<div id="container">
  <div id="header">
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
    </div>

<div id="content">
 <div class="box">
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 品號類別資料建立作業</h1>
    </div>
	
    <div class="content">
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/inv/invi03/updsave" method="post" enctype="multipart/form-data" >
	<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>
	<div id="tab-general">
	<?php foreach($result as $row) { ?>
      <?php   $ma001=$row->ma001;?>
      <?php   $ma002=$row->ma002;?>
      <?php   $ma003=$row->ma003;?>
      <?php   $ma004=$row->ma004;?>
      <?php   $ma005=$row->ma005;?>
      <?php   $ma006=$row->ma006;?>	  
	<?php  }?>
       
		<table class="form14">  <!-- 表格 -->
          <tr>
			<td class="start14a" width="20%">&nbsp;&nbsp;分類方式：</td>
            <td class="normal14a" width="30%">
				<select id="ma001" onKeyPress="keyFunction()" name="ma001" " tabIndex="1" >
               		<option <?php if($ma001 == '1') echo 'selected="selected"';?> value='1'>會計</option>                                                                        
					<option <?php if($ma001 == '2') echo 'selected="selected"';?> value='2'>商品</option>
                    <option <?php if($ma001 == '3') echo 'selected="selected"';?> value='3'>類別</option>
                    <option <?php if($ma001 == '4') echo 'selected="selected"';?> value='4'>生管</option>
				</select>
			</td>
			
			<td class="start14a" width="20%">&nbsp;&nbsp;狀　　態：</td>
            <td class="normal14a" width="30%">
			    <select id="status" onKeyPress="keyFunction()" name="status" tabIndex="2">
                    <option value="1" selected="selected">確認</option>
                    <option value="0">待處理</option>
				    <option value="2">作廢</option>
                </select>
			</td>
		 </tr>
		 
		 <tr>
		   <td class="start14"><span class="required">*</span> 品號類別代號：</td>
           <td class="normal14"><input tabIndex="3" id="ma002" onKeyPress="keyFunction()" type="text" name="ma002"  value="<?php echo $ma002; ?>"  size="06" /></td>
		   <td class="normal14">&nbsp;&nbsp;品號類別名稱：</td>
           <td class="normal14"><input  tabIndex="4" id="ma003" onKeyPress="keyFunction()" type="text" name="ma003"   value="<?php echo $ma003; ?>"  size="12" /></td>
		 </tr>
		 
		 <tr>
		   <td class="normal14">&nbsp;&nbsp;存貨會計科目：</td>
           <td class="normal14"><input tabIndex="5" id="ma004" onKeyPress="keyFunction()" type="text" name="ma004"    value="<?php echo $ma004; ?>"  size="20" /></td>
		   <td class="normal14">&nbsp;&nbsp;銷貨收入科目：</td>
           <td class="normal14"><input tabIndex="6" id="ma005" onKeyPress="keyFunction()"  type="text" name="ma005"   value="<?php echo $ma005; ?>"  size="20"/></td>
		 </tr>
		 
		 <tr>
		   <td class="start14"><span class="required">*</span> 銷貨退回科目：</td>
           <td class="normal14"><input  tabIndex="7" onKeyPress="keyFunction()" id="ma006" type="text" name="ma006"  value="<?php echo $ma006; ?>" size="20"/></td>
		   <td class="normal14">&nbsp;&nbsp;</td>
           <td class="normal14"></td>
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
	    <button tabIndex="8" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('inv/invi03/display'); ?>" class="button" ><span>取 消&nbsp;F9</span></a>
	   </div>
	   
      </form>
	  </div> 
  </div>
</div>
<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   </div>
 </div>
</div>