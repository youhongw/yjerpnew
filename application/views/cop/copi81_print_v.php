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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 潛在客戶建立作業 - 列印明細表</h1>
    </div>
	
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cop/copi81/printa"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $ma001o=$this->input->post('ma001o');
	  $ma001c=$this->input->post('ma001c');
	  $ma002o=$this->input->post('ma002o');
	  $ma002c=$this->input->post('ma002c');
	  $ma003o=$this->input->post('ma003o');
	  $ma003c=$this->input->post('ma003c');
	  $ma004o=$this->input->post('ma004o');
	  $ma004c=$this->input->post('ma004c');
	     $tg009p='1';
	?>
       
	<table class="form14">   <!-- 表格 -->
       <tr>
	    <td class="start14a" width="12%">起始客戶代號：</td>
	    <td class="normal14a" width="38%"><input tabIndex="1" id="ma001o" onKeyPress="keyFunction()" type="text" name="ma001o"  value="<?php echo $ma001o; ?>"  size="20" /></td>
        <td class="normal14a" width="12%">結束客戶代號：</td>
		<td class="normal14a" width="38%"><input tabIndex="2" id="ma001c" onKeyPress="keyFunction()" type="text" name="ma001c"  value="<?php echo $ma001c; ?>"  size="20" /></td>
	  </tr>
	  <tr>
	    <td class="start14a" width="12%">起始業務代號：</td>
	    <td class="normal14a" width="38%"><input tabIndex="1" id="ma002o" onKeyPress="keyFunction()" type="text" name="ma002o"  value="<?php echo $ma002o; ?>"  size="20" /></td>
        <td class="normal14a" width="12%">結束業務代號：</td>
		<td class="normal14a" width="38%"><input tabIndex="2" id="ma002c" onKeyPress="keyFunction()" type="text" name="ma002c"  value="<?php echo $ma002c; ?>"  size="20" /></td>
	  </tr>
	  <tr>
	    <td class="start14a" width="12%">起始級別區分：</td>
	    <td class="normal14a" width="38%"><input tabIndex="1" id="ma003o" onKeyPress="keyFunction()" type="text" name="ma003o"  value="<?php echo $ma003o; ?>"  size="20" /></td>
        <td class="normal14a" width="12%">結束級別區分：</td>
		<td class="normal14a" width="38%"><input tabIndex="2" id="ma003c" onKeyPress="keyFunction()" type="text" name="ma003c"  value="<?php echo $ma003c; ?>"  size="20" /></td>
	  </tr>
	    <tr>
	    <td class="start14a" width="12%">起始客戶類別：</td>
	    <td class="normal14a" width="38%"><input tabIndex="1" id="ma004o" onKeyPress="keyFunction()" type="text" name="ma004o"  value="<?php echo $ma004o; ?>"  size="20" /></td>
        <td class="normal14a" width="12%">結束客戶類別：</td>
		<td class="normal14a" width="38%"><input tabIndex="2" id="ma004c" onKeyPress="keyFunction()" type="text" name="ma004c"  value="<?php echo $ma004c; ?>"  size="20" /></td>
	  </tr>
	    <tr>
	    <td class="normal14" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="tg009p" onKeyPress="keyFunction()" name="tg009p"  tabIndex="12">
            <option <?php if($tg009p == '1') echo 'selected="selected"';?> value='1'>1.A4(橫式)</option>                                                                        
		    <option <?php if($tg009p == '2') echo 'selected="selected"';?> value='2'>2.Letter(橫式)</option>
		  </select></td>     
          <td class="start14" ></td>
	    <td class="normal14" ></td>	
		</tr>
	  
    </table>
	
	    <div class="buttons">
	      <button tabIndex="5" type='submit' accesskey="p"  name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a accesskey="x" tabIndex="6" id='cancel' name='cancel' href="<?php echo site_url('cop/copi81/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div>
        </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->