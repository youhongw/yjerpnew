<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 員工資料建立作業 - 明細表　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	   <button style= "cursor:pointer" form="commentForm" onfocus="$('#mv001o').focus();" tabIndex="5" type='submit'  accesskey="p"  name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="6" id='cancel' name='cancel' href="<?php echo site_url('pal/pali01/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    
	</div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali01/printa"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $mv001o=$this->input->post('mv001o');
	  $mv001c=$this->input->post('mv001c');
	   $dateo=$this->input->post('dateo');
	  $datec=$this->input->post('datec');
	   $dateo1=$this->input->post('dateo1');
	  $datec1=$this->input->post('datec1');
	     $tg009p='2';
	?>
       
	<table class="form14">   <!-- 表格 -->
       <tr>
	    <td class="normal14y" width="11%">起始員工代號：</td>
	    <td class="normal14a" width="39%"><input tabIndex="1" id="mv001o" onKeyPress="keyFunction()" type="text" name="mv001o"  value="<?php echo $mv001o; ?>"  size="20" /></td>
        <td class="normal14y" width="11%">結束員工代號：</td>
		<td class="normal14a" width="39%"><input tabIndex="2" id="mv001c" onKeyPress="keyFunction()" type="text" name="mv001c"  value="<?php echo $mv001c; ?>"  size="20" /></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >起始到職日期：</td>
	    <td class="normal14a" ><input tabIndex="3" id="dateo"  onfocus="this.select();" onKeyPress="keyFunction()" ondblclick="scwShow(this,event);" onchange="dataymd(this)" type="text" name="dateo"  value="<?php echo $dateo; ?>"  size="20" style="background-color:#E7EFEF"/><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td>
        <td class="normal14z" >結束到職日期：</td>
		<td class="normal14a" ><input tabIndex="4" id="datec"  onfocus="this.select();" onKeyPress="keyFunction()" ondblclick="scwShow(this,event);" onchange="dataymd1(this)" type="text" name="datec"  value="<?php echo $datec; ?>"  size="20" style="background-color:#E7EFEF" /><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td>
	  </tr>
	    <tr>
	    <td class="normal14z" >起始離職日期：</td>
	    <td class="normal14a" ><input tabIndex="3" id="dateo1"  onfocus="this.select();" onKeyPress="keyFunction()" ondblclick="scwShow(this,event);" onchange="dataymd2(this)" type="text" name="dateo1"  value="<?php echo $dateo1; ?>"  size="20" style="background-color:#E7EFEF"/><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td>
        <td class="normal14z" >結束離職日期：</td>
		<td class="normal14a" ><input tabIndex="4" id="datec1"  onfocus="this.select();" onKeyPress="keyFunction()" ondblclick="scwShow(this,event);" onchange="dataymd3(this)" type="text" name="datec1"  value="<?php echo $datec1; ?>"  size="20" style="background-color:#E7EFEF" /><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td>
	  </tr>
	    <tr>
	    <td class="normal14z" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="tg009p" onKeyPress="keyFunction()" name="tg009p"  tabIndex="12">
            <option <?php if($tg009p == '2') echo 'selected="selected"';?> value='2'>2.A4(橫式)</option>                                                                        
		    <option <?php if($tg009p == '1') echo 'selected="selected"';?> value='1'>1.Letter(橫式)</option>
		  </select></td>     
          <td class="start14" ></td>
	    <td class="normal14" ></td>	
		</tr>
	 
    </table>
	
	  <!--  <div class="buttons">
	      <button tabIndex="5" type='submit'  accesskey="p"  name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="6" id='cancel' name='cancel' href="<?php echo site_url('pal/pali01/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div>-->
        </form>
		<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php include_once("./application/views/fun/report_funjs_v.php"); ?> 