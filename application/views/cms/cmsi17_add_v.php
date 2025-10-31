<div id="container">   <!-- div-1 -->
  <div id="header">    <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content">    <!-- div-3 -->
  <div class="box">   <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 註記簽核資料建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#ms002').focus();"  type='submit' accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	  <a  accesskey="x"   id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi17/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	</div>
	</div>
    <div class="content">  <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/cms/cmsi17/addsave" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general">  <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $ms001=$this->input->post('ms001');
	  $ms002=$this->input->post('ms002');
	  $ms003=$this->input->post('ms003');
	  $ms004=$this->input->post('ms004');
	  $ms005=$this->input->post('ms005');
	  $ms006=$this->input->post('ms006');
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="11%"><span class="required">代號：</span> </td>
        <td class="normal14a"  width="89%"><input  tabIndex="1" id="ms002" onKeyPress="keyFunction()" onchange="startkey(this)" name="ms002" value="<?php echo $ms002; ?>" size="6" type="text" required />
	        <span id="keydisp" ></span></td>
		
	  </tr>
	  <tr>
	    <td class="normal14z" >註記簽核類別：</td>
		<td class="normal14"  ><select  tabIndex="2" id="ms001" onKeyPress="keyFunction()"  name="ms001" >
             <option <?php if($ms001 == '1') echo 'selected="selected"';?> value='1'>1:註記</option>                                                                        
		     <option <?php if($ms001 == '2') echo 'selected="selected"';?> value='2'>2:簽核</option>
		  </select></td>
		
	  </tr>
	   <tr>
	    <td class="normal14z" >名稱：</td>
		<td class="normal14"  ><input type="text" tabIndex="3" id="ms003" onKeyPress="keyFunction()" name="ms003"   value="<?php echo  $ms003; ?>"   /></td>
		
	  </tr>
	  <tr>
	    <td class="normal14z" >註記簽核1：</td>
		<td class="normal14"  ><input type="text" tabIndex="4" id="ms004" onKeyPress="keyFunction()" name="ms004" size="130"  value="<?php echo  $ms004; ?>"   /></td>
		
	  </tr>
	  <tr>
	    <td class="normal14z" >註記簽核2：</td>
		<td class="normal14"  ><input type="text" tabIndex="5" id="ms005" onKeyPress="keyFunction()" name="ms005"  size="130" value="<?php echo  $ms005; ?>"   /></td>
		
	  </tr>
	  <tr>
	    <td class="normal14z" >註記簽核3：</td>
		<td class="normal14"  ><input type="text" tabIndex="6" id="ms006" onKeyPress="keyFunction()" name="ms006"  size="130" value="<?php echo  $ms006; ?>"   /></td>
		
	  </tr>
	 
	</table>
	   		  
	<!--<div class="buttons">
	  <button  type='submit' accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x"   id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi17/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div>  -->
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div>  <!-- div-6 -->
  </div>  <!-- div-5 -->
</div>   <!-- div-4 -->

   </div> <!-- div-3 -->
  </div>   <!-- div-2 -->
</div>    <!-- div-1 -->
<?php include("./application/views/fun/cmsi17_funjs_v.php"); ?> 