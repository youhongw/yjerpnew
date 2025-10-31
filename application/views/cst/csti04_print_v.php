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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 製令成本建立作業 - 列印明細表</h1>
    </div>
	
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cst/csti04/printa"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $me001o=$this->input->post('me001o');
	  $me001c=$this->input->post('me001c');
	   $tg009p='1';  
	?>
       
	<table class="form14">   <!-- 表格 -->
      <tr>
	    <td class="start14a" width="11%">起始品號：</td>
	    <td class="normal14a" width="39%"><input tabIndex="1" id="me001o" onKeyPress="keyFunction()" type="text" name="me001o"  value="<?php echo $me001o; ?>"  size="20" /></td>
	    </td>
        <td class="normal14a" width="8%">結束品號：</td>
	    <td class="normal14a" width="42%"><input tabIndex="2" id="me001c" onKeyPress="keyFunction()" type="text" name="me001c"  value="<?php echo $me001c; ?>"  size="20" /></td>
	    </td>
	  </tr>
		  <tr>
	    <td class="normal14" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="tg009p" onKeyPress="keyFunction()" name="tg009p"  tabIndex="12">
            <option <?php if($tg009p == '1') echo 'selected="selected"';?> value='1'>1.A4(直式)</option>                                                                        
		    <option <?php if($tg009p == '2') echo 'selected="selected"';?> value='2'>2.Letter(直式)</option>
		  </select></td>     
          <td class="start14" ></td>
	    <td class="normal14" ></td>	
		</tr>
	  
    </table>
	
	    <div class="buttons">
	      <button accesskey="p" tabIndex="5" type='submit'  name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+k</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
		  <button type='submit' accesskey="l" class="button" name='action' value='excel'>轉EXCEL檔Alt+l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></button>
		  <?PHP } ?>
		  <a accesskey="x" tabIndex="6" id='cancel' name='cancel' href="<?php echo site_url('cst/csti04/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div>
        </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->