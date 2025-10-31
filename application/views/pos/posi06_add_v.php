<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
    </div>

<div id="content">  <!-- div-3 -->
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 公佈欄資料建立 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pos/posi06/addsave" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $md001=date("Y/m/d");
	  $md002=$this->input->post('md002');
	  $md003=$this->input->post('md003');
	  $md004=$this->input->post('md004');
	  $md005=$this->input->post('md005');
	  $md006=$this->input->post('md006');
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="start14a" width="11%"><span class="required">公告日期：</span></td>
        <td class="normal14a" width="39%" ><input type="text" tabIndex="1"  ondblclick="scwShow(this,event);" onchange="chkno1(this)" id="md001" onKeyPress="keyFunction()"   name="md001" value="<?php echo $md001; ?>"  style="background-color:#E7EFEF" /><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td>         
	    <td class="normal14a" width="11%">公告單號：</td>
        <td class="normal14a"  width="39%"> <input  tabIndex="2" id="md002" onKeyPress="keyFunction()" onfocus="chkno1(this)" name="md002"   value="<?php echo  $md002; ?>"    type="text"  /></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14" >公告單位：</td>
		<td class="normal14"> <input type="text" tabIndex="3"  id="md003" onKeyPress="keyFunction()"   name="md003" value="<?php echo $md003; ?>"   /></td>
       <td class="normal14"> 收件單位：</td>
        <td class="normal14" ><input  tabIndex="4" onKeyPress="keyFunction()" id="md004" name="md004"  value="<?php echo $md004; ?>"  type="text"  /></td>	
	  </tr>
	   <tr>
	      <td colspan="1" class="normal14"> 主旨：</td>
        <td colspan="3" class="normal14" ><input  tabIndex="13" onKeyPress="keyFunction()" id="md005" name="md005"  value="<?php echo $md005; ?>" size="80" type="text"  /></td>	
       </tr>
	 <tr>		
	   <tr>
	    <td colspan="1" class="normal14" >內容描述：</td>
        <td colspan="3"  class="normal14"><textarea  tabIndex="6" rows="9" cols="60" name="md006" id="md006" Wrap="Physical" ><?php echo $md006; ?></textarea></td>	  
	   <td class="normal14"></td>
         <td  class="normal14"  ></td>
	  </tr>		
	</table>
	   		  
	<div class="buttons">
	<button tabIndex="8" type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pos/posi06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> 
	  
    </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div>  <!-- div-3 -->
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
 <?php include_once("./application/views/fun/posi06_funjs_v.php"); ?> 
	 
 