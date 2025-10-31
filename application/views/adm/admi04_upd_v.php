<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
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
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 群組資料建立作業 - 修改　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button  type='submit'  accesskey="s"  name="submit"  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?=base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	    <a  accesskey="x"  onKeyPress="keyFunction()" id="cancel" name="cancel" href="<?php echo site_url('adm/admi04/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
	  
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/adm/admi04/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $me001=$row->me001;?>
          <?php   $me002=$row->me002;?>
          <?php   $me003=$row->me003;?>
		  <?php   $me004=$row->me004;?>
          <?php   $flag=$row->flag;?>	  
	<?php  }?>
       
	<table class="form14">  <!-- 表格 -->
	   <tr>
	    <td class="normal14y" width="11%"><span class="required">群組代號：</span> </td>
        <td class="normal14a" width="39%"><input   tabIndex="1" id="me001" readonly="value" onKeyPress="keyFunction()" onchange="checkspace2()" name="me001" value="<?php echo $me001; ?>"  type="text" required /></td>
		<td class="start14a" width="11%" ></td>
       <td class="normal14a" width="39%"></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >群組名稱：</td>
		<td class="normal14"  ><input type="text" tabIndex="2" id="me002" onKeyPress="keyFunction()" name="me002"   value="<?php echo  $me002; ?>"   /></td>
		<td class="normal14"></td>
        <td class="normal14"></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >群組權限代號：</td>
		<td class="normal14"  ><input type="text" tabIndex="3" id="me003" onKeyPress="keyFunction()" name="me003"   value="<?php echo  $me003; ?>"   /></td>
		<td class="normal14"></td>
        <td class="normal14"></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >備  註：</td>
		<td class="normal14"  ><input type="text" tabIndex="4" id="me004" onKeyPress="keyFunction()" name="me004"   value="<?php echo  $me004; ?>"   /></td>
		<td class="normal14"></td>
        <td class="normal14"></td>
	  </tr>
	 
    </table>
		<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
		
	 <!-- <div class="buttons">
	    <button  type='submit'  accesskey="s"  name="submit"  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?=base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  accesskey="x"  onKeyPress="keyFunction()" id="cancel" name="cancel" href="<?php echo site_url('adm/admi04/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
	  </div>-->
	   
    </form>
	<?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->