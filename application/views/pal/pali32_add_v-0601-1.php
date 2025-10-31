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

<div id="content">  <!-- div-3 -->
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 員工借支建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pal/pali32/addsave" >	
	<!-- <div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $tb001=$this->input->post('tb001');
	  $palq01a=$this->input->post('palq01a');
	  $palq01adisp=$this->input->post('tb001');
	  $tb002=$this->input->post('tb002');
	  $cmsq05a=$this->input->post('cmsq05a');
	  $cmsq05adisp=$this->input->post('tb002');
	  
	   $tb003=$this->input->post('tb003');
	   if ($tb003 > '0') { $tb003=$this->input->post('tb003');} else { $tb003=date("Y/m");}
	   if (!isset($tb004)) { $tb004=0;} else { $tb004=$this->input->post('tb004');}
	  
	   if (!isset($tb005)) { $tb005='';} else { $tb005=$this->input->post('tb005');}
	
	//  if (!isset($tb014)) { $tb014=date("Y/m/d");}
	
	  
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="start14a" width="15%"><span class="required">員工代號：</span></td>
        <td class="normal14a" width="35%"><input tabIndex="1" id="tb001" onKeyPress="keyFunction()" onchange="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>"  type="text" required /><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="palq01adisp"> <?php echo $palq01adisp; ?> </span></td>
	    <td class="start14a" width="15%"><span class="required">部門代號：</span></td>
        <td class="normal14a" width="35%"> <input tabIndex="2" id="tb002" onKeyPress="keyFunction()" onchange="startcmsq05a(this)" name="cmsq05a" value="<?php echo $cmsq05a; ?>"  type="text" required /><img id="Showcmsq05a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
         <span id="cmsq05adisp"> <?php echo $cmsq05adisp; ?> </span></td>
       
	  </tr>	
		  
	  <tr>
	    <td class="start14a" >借支年月： </td>
        <td class="normal14" ><input  tabIndex="3" onKeyPress="keyFunction()"  onchange="dateformat_ym(this)"    id="tb003" name="tb003"  value="<?php echo $tb003; ?>"  type="text" style="background-color:#E7EFEF" /><span > <?php echo '輸入範例yyyymm'; ?> </span></td>
		<td class="normal14" >借支金額：</td>
		<td class="normal14"><input  tabIndex="4" onKeyPress="keyFunction()"  id="tb004" name="tb004"  value="<?php echo $tb004; ?>"  type="text"  /></td>	
	  </tr>
		
	  
	   <tr>
	    <td  class="normal14" >備註：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" id="tb005"     onKeyPress="keyFunction()"    name="tb005" value="<?php echo $tb005; ?>"  size="60"/></td>
       
	    <td class="normal14"></td>		
        <td  class="normal14"  ></td>
	  </tr>
	</table>
	      
	<div class="buttons">
	<button tabIndex="8" type='submit' accesskey="s"   name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali32/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> 
	  
    </form>
   </div> <!-- div-6 --> 
    </div> <!-- div-5 -->	
</div> <!-- div-4 -->

  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div>  <!-- div-3 -->
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
 <?php include("./application/views/fun/pali32_funjs_v.php"); ?> 