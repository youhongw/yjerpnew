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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 刷卡資料維護作業 - 修改</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali52/updsave" method="post" enctype="multipart/form-data" >
	<!-- <div id="htabs" class="htabs14"><span>編輯項目-修改</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $palq01a=$row->te001;?>
		  <?php   $palq01adisp=$row->te001disp;?>
          <?php   $te002=substr($row->te002,0,4).'/'.substr($row->te002,4,2).'/'.substr($row->te002,6,2);?>
	      <?php //   $te003=substr($row->te003,0,2).':'.substr($row->te003,2,2);?>
		  <?php   $te003=$row->te003;?>
		  <?php   $te004=$row->te004;?>
          <?php   $te005=$row->te005;?>
		  <?php   $te006=substr($row->te006,0,4).'/'.substr($row->te006,4,2).'/'.substr($row->te006,6,2);?>
		  <?php   $te007=$row->te007;?>
		 
          <?php   $flag=$row->flag;?>	  
	<?php  }?>
       
	<table class="form14">  <!-- 表格 -->
       <tr>
	    <td class="start14a" width="15%"><span class="required">員工代號：</span></td>
        <td class="normal14a" width="35%" ><input   tabIndex="1" id="te001" onKeyPress="keyFunction()" onchange="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>"  type="text" required /><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="palq01adisp"> <?php    echo $palq01adisp; ?> </span></td>
	    <td class="start14a" width="15%"><span class="required">刷卡日期：</span></td>
        <td class="normal14a"  width="35%"><input tabIndex="2"  onclick="scwShow(this,event);"  id="te002" onKeyPress="keyFunction()" onchange="dateformat_ymd(this)" name="te002"  value="<?php echo $te002; ?>"  size="12" type="text"  style="background-color:#E7EFEF" /></td>
       
	  </tr>	
		  
	  <tr>
	    <td class="start14a" >刷卡時間： </td>
        <td class="normal14" ><input  tabIndex="3" onKeyPress="keyFunction()"  onchange="checktime(this)"   id="te003" name="te003"  value="<?php echo $te003; ?>"  type="text" style="background-color:#E7EFEF" /><input id="te003_origin" name="te003_origin"  value="<?php echo $te003; ?>"  type="text" style="display:none;" />
		<span id="timedisp"> </span></td>
		<td class="normal14" >臨時卡號：</td>
		<td class="normal14"><input  tabIndex="4" onKeyPress="keyFunction()"  id="te004" name="te004"  value="<?php echo $te004; ?>"  type="text"  /></td>	
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
		
		<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
		
	  <div class="buttons">
	    <button tabIndex="8" type='submit' accesskey="s"  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali52/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	   </div>
	   
        </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
    <?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->

 <?php include("./application/views/fun/pali52_funjs_v.php"); ?> 
