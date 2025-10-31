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
	
<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 商品包裝建立作業 - 列印客戶訂單</h1>
    </div>
	
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cop/copi06/printc"  method="post"  enctype="multipart/form-data" > 
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $te001o=$this->input->post('te001o');
	  $te002o=$this->input->post('te002o');
	  $te002c=$this->input->post('te002c');
	  $te009p='1';
	?>
	<table class="form14">   <!-- 表格 -->
      <tr>
	    <td class="start14a" width="11%">訂單單別：</td>
	    <td class="normal14a" width="89%"><input tabIndex="1" id="te001o" onKeyPress="keyFunction()" type="text" name="te001o"  value="<?php echo $te001o; ?>"  size="20" /></td>
      </tr>	
	   <tr>
		<td class="start14a" width="11%">起始訂單單號：</td>
	    <td class="normal14a" width="89%"><input tabIndex="2" id="te002o" onKeyPress="keyFunction()" type="text" name="te002o"  value="<?php echo $te002o; ?>"  size="20" /></td>
	  </tr>	
	    <tr>
		<td class="start14a" width="11%">結束訂單單號：</td>
	    <td class="normal14a" width="89%"><input tabIndex="3" id="te002c" onKeyPress="keyFunction()" type="text" name="te002c"  value="<?php echo $te002c; ?>"  size="20" /></td>
	  </tr>	
	   <tr>
	    <td class="normal14" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="te009p" onKeyPress="keyFunction()" name="te009p"  tabIndex="4">
            <option <?php if($te009p == '1') echo 'selected="selected"';?> value='1'>1.Letter(半張)</option>                                                                        
		    <option <?php if($te009p == '2') echo 'selected="selected"';?> value='2'>2.Letter(直式)</option>
		  </select></td>
        <td class="start14" ></td>
	    <td class="normal14" ></td>
	  </tr>	
	  
    </table>
	
	    <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="s" name='submit' class="button"   target="_new" value='列 印Alt+p'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('cop/copi06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div>
        </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->