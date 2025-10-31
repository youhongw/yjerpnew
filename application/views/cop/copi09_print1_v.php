<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 客戶銷退單資料建立作業 - 列印銷退單</h1>
    　<div style="float:left;padding-top: 5px; ">
	　<button style= "cursor:pointer" form="commentForm" onfocus="$('#ti001o').focus();" type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('cop/copi09/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	   
	</div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cop/copi09/printc"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-銷退單</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $ti001o=$this->input->post('ti001o');
	  $ti002o=$this->input->post('ti002o');
	  $ti002c=$this->input->post('ti002c');
	  $ti001o='2401';
	  $ti002o='20190122001';
	  $ti009p='1';
	  $tprint='Y';
	?>
	<table class="form14">   <!-- 表格 -->
      <tr>
	    <td class="normal14y" width="11%">銷退單別：</td>
	    <td class="normal14a" width="89%"><input tabIndex="1" id="ti001o" onKeyPress="keyFunction()" type="text" name="ti001o"  value="<?php echo $ti001o; ?>"  size="20" /></td>
      </tr>	
	   <tr>  
		<td class="normal14z" >起銷退單號：</td>
	    <td class="normal14a" ><input tabIndex="2" id="ti002o" onchange="copyb(this);" onKeyPress="keyFunction()" type="text" name="ti002o"  value="<?php echo $ti002o; ?>"  size="20" /></td>
	  </tr>	
	  <tr>  
		<td class="normal14z" >迄銷退單號：</td>
	    <td class="normal14a" ><input tabIndex="2" id="ti002c" onKeyPress="keyFunction()" type="text" name="ti002c"  value="<?php echo $ti002c; ?>"  size="20" /></td>
	  </tr>	
	   <tr>
	    <td class="normal14z" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="ti009p" onKeyPress="keyFunction()" name="ti009p"  tabIndex="5">
            <option <?php if($ti009p == '1') echo 'selected="selected"';?> value='1'>1.A4(橫式)</option>                                                                        
		    <option <?php if($ti009p == '2') echo 'selected="selected"';?> value='2'>2.Letter(橫式)</option>
		  </select></td>
        <td class="start14" ></td>
	    <td class="normal14" ></td>
	  </tr>		
	  <tr>
        <td class="normal14z" >列印單價：</td>
	    <td class="normal14" ><select id="tprint" onKeyPress="keyFunction()" name="tprint"  tabIndex="4">
            <option <?php if($tprint == 'Y') echo 'selected="selected"';?> value='Y'>Y.印單價</option>                                                                        
		    <option <?php if($tprint == 'N') echo 'selected="selected"';?> value='N'>N.不印單價</option>
		  </select></td>
	  </tr>		
    </table>
	
	   <!-- <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('cop/copi09/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div>-->
        </form>
		<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

   </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php  include_once("./application/views/funnew/erp_funjs_one_v.php"); ?>      <!-- 共用函數 -->
<script type="text/javascript" >
   function copyb(oInput) {
	   $("#ti002c").val(oInput.value);
   }
</script>