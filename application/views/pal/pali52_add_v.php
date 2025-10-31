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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 刷卡資料維護作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pal/pali52/addsave" >	
	<!-- <div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $te001=$this->input->post('te001');
	  $te099=$this->input->post('te099');
	  $palq01a=$this->input->post('palq01a');
	  $palq01adisp=$this->input->post('te001');	  
	   $te002=$this->input->post('te002');
	   if ($te002 > '0') { $te002=$this->input->post('te002');} else { $te002=date("Y/m/d");}
	   $te003=$this->input->post('te003');
	   if ($te003 > '0') { $te003=$this->input->post('te003');} else { $te003=date("Hi");}
	//   $te003=$this->input->post('te003');
	 
	   if (!isset($te004)) { $te004='';} else { $te004=$this->input->post('te004');}
	   if (!isset($te005)) { $te005='N';} else { $te005=$this->input->post('te005');}
	   if (!isset($te006)) { $te006='';} else { $te006=$this->input->post('te006');}
	   if (!isset($te007)) { $te007='';} else { $te007=$this->input->post('te007');}
	  
	
	//  if (!isset($te014)) { $te014=date("Y/m/d");}
	
	  
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="start14a" width="15%"><span class="required">員工代號：</span></td>
        <td class="normal14a" width="35%" ><input   tabIndex="1" id="te001" onKeyPress="keyFunction()" onchange="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>"  type="text" required /><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="palq01adisp"> <?php    echo $palq01adisp; ?> </span>
		 <input  tabIndex="4"   id="te099" name="te099"  value="<?php echo $te099; ?>" readonly="readonly" type="text"  /></td>
	    <td class="start14a" width="15%"><span class="required">刷卡日期：</span></td>
        <td class="normal14a"  width="35%"><input tabIndex="2"  onclick="scwShow(this,event);" onchange="dateformat_ymd(this)" id="te002" onKeyPress="keyFunction()"  name="te002"  value="<?php echo $te002; ?>"  size="12" type="text"  style="background-color:#E7EFEF" /></td>
       
	  </tr>	
		  
	  <tr>
	    <td class="start14a" >刷卡時間： </td>
        <td class="normal14" ><input  tabIndex="3" onKeyPress="keyFunction()" id="te003" name="te003"  value="<?php echo $te003; ?>"  type="text" style="background-color:#E7EFEF" />
		<span id="timedisp"> </span></td>
		<td class="normal14" >臨時卡號：</td>
		<td class="normal14"><input  tabIndex="4" onKeyPress="keyFunction()"  id="te004" name="te004"  value="<?php echo $te004; ?>" onchange="date_formatymd" type="text"  /></td>	
	  </tr>
		
	  <tr>
	    <td  class="normal14" >產生明細：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" id="te005"     onKeyPress="keyFunction()"    name="te005" value="<?php echo $te005; ?>"  /></td>	  
	    <td class="normal14">歸屬日期：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="6" id="te006"   onclick="scwShow(this,event);"  onKeyPress="keyFunction()"    name="te006" value="<?php echo $te006; ?>" style="background-color:#E7EFEF" /></td>
	  
	   <tr>
	    <td  class="normal14a" >功能碼：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" id="te007"    onKeyPress="keyFunction()"    name="te007" value="<?php echo $te007; ?>"  /></td>	  
	    <td class="normal14"></td>		
        <td  class="normal14"  ></td>
	  </tr>
	   
	</table>
	      
	<div class="buttons">
	<button tabIndex="8" type='submit' accesskey="s"   name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali52/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
 <?php include("./application/views/fun/pali52_funjs_v.php"); ?> 