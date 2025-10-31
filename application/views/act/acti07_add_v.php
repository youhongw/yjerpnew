<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 會計期間設定作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#mg001').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('act/acti07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/act/acti07/addsave" >	
	<div id="tab-general">  <!-- div-6 -->
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  
      $mg001=$this->input->post('mg001');
	  $mg002=$this->input->post('mg002');
	  $mg003=$this->input->post('mg003');
	
	
	//  if(!isset($mg013)) { $mg013=date("Y/m/d"); }
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y" width="6%" ><span class="required">年度：</span> </td>
        <td class="normal14a" width="44%" ><input   tabIndex="1" id="mg001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mg001" value="<?php echo $mg001; ?>" type="text" size="10" required />
	        <span id="keydisp" ></span></td>
		<td class="normal14y" width="11%" >年度起始日期：</td>
        <td class="normal14a" width="39%" ><input tabIndex="2"  onclick="scwShow(this,event);"  class="date" id="mg002" onKeyPress="keyFunction()"  name="mg002"  value="<?php echo $mg002; ?>"  size="12" type="text"  style="background-color:#E7EFEF"  /></td>
	<!--     <td class="normal14a" width="39%" ><input tabIndex="2"  onclick="scwShow(this,event);"  class="date" id="mg002" onKeyPress="keyFunction()"  name="mg002"  value="<?php echo $mg002; ?>"  size="12" type="text"  style="background-color:#E7EFEF"  /><a  href="javascript:;"><img  src="<?php echo base_url()?>assets/image/png/invoice.png" onclick="addItem(); alt="展開明細" align="top"></a></td> -->
	  </tr>
	 
	 <tr>
		<td class="normal14z">備註：</td>
        <td class="normal14"><input type="text" tabIndex="3"  onKeyPress="keyFunction()" size="50"  id="mg003" name="mg003" value="<?php echo $mg003; ?>"   /></td>
		<td class="normal14"></td>
        <td class="normal14"></td>
	  </tr>
		
	</table>
	
	<div>
        <table id="order_product" class="list1">
        <thead>
            <tr>
              <td width="5%"></td>			
		      <td width="11%" class="left">期別</td>
              <td width="15%" class="left">起始日期</td>
			  <td width="15%" class="left">截止日期</td>
            </tr>
        </thead>
          <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="4"></td>
            </tr>
          </tfoot>
       </table>
    </div>
	
	
	<!-- <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('act/acti07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div> -->
	  
    </form>
	 <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 期別輸入01-12, 起始日期當月第一天,截止日期當月最後一天,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位. ] ' ?> </div>  <?php } ?>
    
  </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

   </div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
 <?php include("./application/views/fun/acti07_funjs_v.php"); ?>
  