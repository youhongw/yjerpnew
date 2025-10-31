<div id="container"> <!-- div-1 -->
<div id="header"> <!-- div-2 -->
  <div class="div1">
  <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
    <div class="div3">
	<img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	<img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	<img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>　
    </div> -->
	<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
  </div>
  
<div id="content"> <!-- div-3 -->
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 異動單建立作業 - 複製　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	 <button  style= "cursor:pointer" form="commentForm" onfocus="$('#ta001o').focus();" type='submit'  accesskey="c"  onKeyPress="keyFunction()" name='submit' class="button"  value='&nbsp;儲存F8&nbsp;'><span>複 製Alt+c</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;
	   <a  accesskey="x"  onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('inv/invi05/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a></div>
	   
	</div>
    </div>
    <div class="content"> <!-- div-5 -->
	<form class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/inv/invi05/copysave" method="post" enctype="multipart/form-data" id="form">
	<!-- <div id="htabs" class="htabs14"><span>編輯項目-複製</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $ta001o=$this->input->post('ta001o');
	  $ta001c=$this->input->post('ta001c');
	  $ta002o=$this->input->post('ta002o');
	  $ta002c=$this->input->post('ta002c');
	?>
	
	<table class="form14">    <!-- 表格開始 -->
      <tr>
	    <td class="normal14y" width="13%">原始異動單單別：</td>           
		<td class="normal14a"  width="37%"><input tabIndex="1" id="ta001o" onchange="copya(this);" onKeyPress="keyFunction()"   name="ta001o" value="<?php echo strtoupper($ta001o); ?>" size="20" type="text" required />
		 <span id="ta001dispo" ></span></td>
	    <td class="normal14y" width="13%">複製異動單單別：</td>
	    <td class="normal14a"  width="37%"><input tabIndex="2" id="ta001c"  onKeyPress="keyFunction()"   name="ta001c" value="<?php echo strtoupper($ta001c); ?>" size="20" type="text" required />
		 <span id="ta001dispc" ></span></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >原始異動單單號：</td>           
		<td class="normal14a"  ><input tabIndex="3" id="ta002o" onchange="copyb(this);" onKeyPress="keyFunction()"   name="ta002o" value="<?php echo strtoupper($ta002o); ?>" size="20" type="text" required />
		 <span id="ta002dispo" ></span></td>
	    <td class="normal14z" >複製異動單單號：</td>
	    <td class="normal14a"  ><input tabIndex="4" id="ta002c"  onKeyPress="keyFunction()"   name="ta002c" value="<?php echo strtoupper($ta002c); ?>" size="20" type="text" required />
		 <span id="ta002dispc" ></span></td>
	  </tr>
	 
    </table>
		
	  <!-- <div class="buttons">
	   <button  type='submit'  accesskey="c"  onKeyPress="keyFunction()" name='submit' class="button"  value='&nbsp;儲存F8&nbsp;'><span>複 製Alt+c</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x"  onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('inv/invi05/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a></div>
	   -->
        </form>
		<?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ]' ?> </div> <?php } ?>
   
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

       </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php  include_once("./application/views/funnew/erp_funjs_one_v.php"); ?>      <!-- 共用函數 -->
<script type="text/javascript" >
   function copya(oInput) {
	   form.ta001c.value=oInput.value;
   }
   function copyb(oInput) {
	   $("#ta002c").val(oInput.value);
   }
</script>