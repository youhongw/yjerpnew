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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 客戶訂單資料建立作業 - 複製　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#tc001o').focus();" type='submit'  accesskey="s" onKeyPress="keyFunction()" name='submit' class="button"  value='複 製Alt+c'><span>複 製Alt+c</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;
	   <a  accesskey="x" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo base_url()?>index.php/main" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a></div>
	   
	</div>
     </div>
    <div class="content"> <!-- div-5 -->
	<form class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cop/copi06/copysave" method="post" enctype="multipart/form-data" id="form">
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $tc001o=$this->input->post('tc001o');
	  $tc001c=$this->input->post('tc001c');
	  $tc002o=$this->input->post('tc002o');
	  $tc039=$this->input->post('tc039');
	//  $tc002c=$this->input->post('tc002c');
	?>
	
	<table class="form14">    <!-- 表格開始 -->
      <tr>
	    <td class="normal14y" width="11%">原始訂單單別：</td>           
		<td class="normal14a"  width="39%"><input tabIndex="1" id="tc001o" onchange="copya(this);" onKeyPress="keyFunction()"   name="tc001o" value="<?php echo strtoupper($tc001o); ?>" size="10" type="text" required />
		  <span id="tc001dispo" ></span></td>
	    <td class="normal14y" width="11%">複製訂單單別：</td>
	    <td class="normal14a"  width="39%"><input tabIndex="2" id="tc001c"  onKeyPress="keyFunction()"   name="tc001c" value="<?php echo strtoupper($tc001c); ?>" size="10" type="text" required />
		  <span id="tc001dispc" ></span></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >原始訂單單號：</td>           
		<td class="normal14a" ><input tabIndex="3" id="tc002o" onchange="copyb(this);" onKeyPress="keyFunction()"   name="tc002o" value="<?php echo strtoupper($tc002o); ?>" size="20" type="text" required />
		  <span id="tc002dispo" ></span></td>
	<!--    <td class="normal14z" >複製訂單單號：</td>
	    <td class="normal14a"  ><input tabIndex="4" id="tc002c"  onKeyPress="keyFunction()"   name="tc002c" value="<?php echo strtoupper($tc002c); ?>" size="20" type="text" required />
		  <span id="tc002dispc" ></span></td> -->
		<td class="normal14y" width="8%" >單據日期： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tc039" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="tc039"  value="<?php echo $tc039; ?>" type="text" required  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tc039,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
        </td>
		
	  </tr>
    </table>
		
	  <!-- <div class="buttons">
	   <button  type='submit'  accesskey="s" onKeyPress="keyFunction()" name='submit' class="button"  value='複 製Alt+c'><span>複 製Alt+c</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('cop/copi06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a></div>
	   -->
    </form>
	<?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ]' ?> </div> <?php } ?>
   
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

      </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php  include_once("./application/views/funnew/erp_funjs_one_v.php"); ?>      <!-- 共用函數 -->
<script type="text/javascript" >
   function copya(oInput) {
	   form.tc001c.value=oInput.value;
   }
   function copyb(oInput) {
	   $("#tc002c").val(oInput.value);
   }
</script>