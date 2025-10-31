<div id="container">  <!-- div-1 -->
  <div id="header">   <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>
	
<div id="content">   <!-- div-3 -->
 <div class="box">   <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 註記簽核資料建立作業 - 明細表　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#ms003c').focus();" type='submit'  accesskey="p" name='submit'  class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;
	    <a  accesskey="x"  onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi17/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    
	</div>
	</div>
	<div class="content">  <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cms/cmsi17/printa"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div>-->
	<div id="tab-general">  <!-- div-6 -->
	<?php
  	  $ms001c=$this->input->post('ms001c');
	  $ms002c=$this->input->post('ms002c');
	  $ms003c=$this->input->post('ms003c');
	  $ms004c=$this->input->post('ms004c');
	   $tg009p='1';
	?>
       
	<table class="form14">   <!-- 表格 -->
      <tr>
	    <td class="normal14y" width="11%">起始代號：</td>
        <td class="normal14a" width="39%"><input tabIndex="1" id="ms003c" onKeyPress="keyFunction()" type="text" name="ms003c"  value="<?php echo $ms003c; ?>"   /></td>
	    <td class="normal14y" width="11%">結束代號：</td>
        <td class="normal14a" width="39%"><input tabIndex="2" id="ms004c" onKeyPress="keyFunction()" type="text" name="ms004c"  value="<?php echo $ms004c; ?>"   /></td>
	  </tr>
      <tr>
	    <td class="normal14z" >起始類別：</td>
        <td class="normal14a" >
	      <select id="ms001c" onKeyPress="keyFunction()" name="ms001c" tabIndex="3">
             <option <?php if($ms001c == '1') echo 'selected="selected"';?> value='1'>註記</option>                                                                        
		     <option <?php if($ms001c == '2') echo 'selected="selected"';?> value='2'>簽核</option>
		  </select>
	    </td>
        <td class="normal14z" >結束分類方式：</td>
        <td class="normal14a" >
		  <select id="ms002c" onKeyPress="keyFunction()" name="ms002c" tabIndex="4">
             <option <?php if($ms002c == '1') echo 'selected="selected"';?> value='1'>註記</option>                                                                        
		     <option <?php if($ms002c == '2') echo 'selected="selected"';?> value='2'>簽核</option>
		 </select>
	    </td>
	  </tr>
	 <tr>
	    <td class="normal14z" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="tg009p" onKeyPress="keyFunction()" name="tg009p"  tabIndex="12">
            <option <?php if($tg009p == '1') echo 'selected="selected"';?> value='1'>1.A4(橫式)</option>                                                                        
		    <option <?php if($tg009p == '2') echo 'selected="selected"';?> value='2'>2.Letter(橫式)</option>
		  </select></td>     
          <td class="start14" ></td>
	    <td class="normal14" ></td>	
		</tr>
    </table>
	
	   <!-- <div class="buttons">
	    <button type='submit'  accesskey="p" name='submit'  class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	    <a  accesskey="x"  onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi17/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div>-->
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div> <!-- div-6 -->
  </div>   <!-- div-5 -->
</div>     <!-- div-4 -->

   </div>  <!-- div-3 -->
  </div>   <!-- div-2 -->
</div>    <!-- div-1 -->