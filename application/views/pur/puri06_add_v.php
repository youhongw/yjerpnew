<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
    </div>

<div id="content"> <!-- div-3 -->
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 品號類別資料建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/inv/invi01/addsave" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $ma001=$this->input->post('ma001');
	  $ma002=$this->input->post('ma002');
	  $ma003=$this->input->post('ma003');
	  $ma004=$this->input->post('ma004');
	  $ma005=$this->input->post('ma005');
	  $ma006=$this->input->post('ma006');
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="start14" ><span class="required">類別代號：</span> </td>
        <td class="normal14" ><input   tabIndex="1" id="ma002" onKeyPress="keyFunction()" onchange="startkey(this)" name="ma002" value="<?php echo $ma002; ?>" size="6" type="text" required />
	     <span id="keydisp" ></span></td>
		<td class="normal14" >類別名稱：</td>
        <td class="normal14"  ><input  tabIndex="2" id="ma003" onKeyPress="keyFunction()" name="ma003"   value="<?php echo  $ma003; ?>"    size="12" type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="start14a" width="12%"><span class="required">分類方式：</span></td>
        <td class="normal14a" width="38%" >
		  <select  tabIndex="3" id="ma001" onKeyPress="keyFunction()"  name="ma001" >
             <option <?php if($ma001 == '1') echo 'selected="selected"';?> value='1'>1:會計</option>                                                                        
		     <option <?php if($ma001 == '2') echo 'selected="selected"';?> value='2'>2:商品</option>
             <option <?php if($ma001 == '3') echo 'selected="selected"';?> value='3'>3:類別</option>
             <option <?php if($ma001 == '4') echo 'selected="selected"';?> value='4'>4:生管</option>
		  </select>
		  <span id="ma001disp" ></span>
	    </td>
	    <td class="start14a" width="12%">&nbsp;&nbsp;</td>
            <td class="normal14a"  width="38%"></td>
		    <td class="normal14a">&nbsp;&nbsp;</td>
            <td class="normal14a"></td>
	     </td>
	  </tr>	
		
	  <tr>
	    <td  class="normal14" >存貨科目：</td>
        <td  class="normal14"  ><input   tabIndex="5" id="ma004" onKeyPress="keyFunction()" name="ma004"  value="<?php echo $ma004; ?>"  size="20"   type="text"  /></td>
	    <td class="normal14">銷貨收入：</td>						
        <td  class="normal14"  ><input  tabIndex="6" id="ma005" onKeyPress="keyFunction()" name="ma005"   value="<?php echo $ma005; ?>" size="20"  type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14"> 銷貨退回：</td>
        <td class="normal14" ><input  tabIndex="7" onKeyPress="keyFunction()" id="ma006" name="ma006"  value="<?php echo $ma006; ?>" size="20" type="text"  /></td>	
	    <td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	</table>
	   		  
	<div class="buttons">
	<button  type='submit' accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a  accesskey="x"   id='cancel' name='cancel' href="<?php echo site_url('inv/invi01/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> 
	  
    </form>
    </div>  <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div>  <!-- div-1 --> 
   <?php include("./application/views/fun/invi01_funjs_v.php"); ?>