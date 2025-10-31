<div id="container"> <!-- div-1 -->
<div id="header"> <!-- div-2 -->
  <div class="div1">
   <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
    <div class="div3">
	<img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	<img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	<img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>　
    </div>-->
	<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
  </div>
  
<div id="content"> <!-- div-3 -->
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 退貨單資料建立作業 - 複製　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button  style= "cursor:pointer" form="commentForm" onfocus="$('#ti001o').focus();"  type='submit'  accesskey="c" onKeyPress="keyFunction()" name='submit' class="button"  value='&nbsp;儲存F8&nbsp;'><span>複 製Alt+c</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;
	   <a  accesskey="x" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('pur/puri11/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a></div>
	  
	</div>
    </div>
    <div class="content"> <!-- div-5 -->
	<form class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pur/puri11/copysave" method="post" enctype="multipart/form-data" id="form">
	<!--<div id="htabs" class="htabs14"><span>編輯項目-複製</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $ti001o=$this->input->post('ti001o');
	  $ti001c=$this->input->post('ti001c');
	  $ti002o=$this->input->post('ti002o');
	  $ti002c=$this->input->post('ti002c');
	?>
	
	<table class="form14">    <!-- 表格開始 -->
      <tr>
	    <td class="normal14y" width="11%">原始退貨單別：</td>           
		<td class="normal14a"  width="39%"><input tabIndex="1" id="ti001o" onchange="copya(this);" onKeyPress="keyFunction()"   name="ti001o" value="<?php echo strtoupper($ti001o); ?>" size="20" type="text" required />
		 <span id="ti001dispo" ></span></td>
	    <td class="normal14y" width="11%">複製退貨單別：</td>
	    <td class="normal14a"  width="39%"><input tabIndex="2" id="ti001c"  onKeyPress="keyFunction()"   name="ti001c" value="<?php echo strtoupper($ti001c); ?>" size="20" type="text" required />
		 <span id="ti001dispc" ></span></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >原始退貨單號：</td>           
		<td class="normal14a"  ><input tabIndex="3" id="ti002o" onchange="copyb(this);" onKeyPress="keyFunction()"   name="ti002o" value="<?php echo strtoupper($ti002o); ?>" size="20" type="text" required />
		 <span id="ti002dispo" ></span></td>
	    <td class="normal14z" >複製退貨單號：</td>
	    <td class="normal14a"  ><input tabIndex="4" id="ti002c"  onKeyPress="keyFunction()"   name="ti002c" value="<?php echo strtoupper($ti002c); ?>" size="20" type="text" required />
		 <span id="ti002dispc" ></span></td>
	  </tr>
	  
    </table>
		
	  <!-- <div class="buttons">
	   <button  type='submit'  accesskey="c" onKeyPress="keyFunction()" name='submit' class="button"  value='&nbsp;儲存F8&nbsp;'><span>複 製Alt+c</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('pur/puri11/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a></div>
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
	   form.ti001c.value=oInput.value;
   }
   function copyb(oInput) {
	   $("#ti002c").val(oInput.value);
   }
</script>