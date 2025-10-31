<div id="container">   <!-- div-1 -->
  <div id="header">    <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
    </div>

<div id="content">    <!-- div-3 -->
  <div class="box">   <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 效率獎金建立作業 - 新增</h1>
    </div>
	
    <div class="content">  <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pal/pali46/addsave" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general">  <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $yg001=$this->input->post('yg001');
	  $palq01a=$this->input->post('palq01a');
	  $palq01adisp=$this->input->post('palq01a');
	  $yg003=$this->input->post('yg003');
	  $yg004=0;
	  $yg005=0;
	  $yg006=0;
	  $yg007=0;
	  $yg008=0;
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="start14a"  width="11%" ><span class="required">效率年度：</span> </td>
        <td class="normal14"  width="39%"><input   tabIndex="1" id="yg001" onKeyPress="keyFunction()"  onchange="startkey(this)" name="yg001" value="<?php echo $yg001; ?>"  type="text" required />
	        <span id="keydisp" ></span></td>
		<td class="normal14" width="11%" ></td>
        <td class="normal14" width="39%" ></td>
	  </tr>
	  <tr>
	    <td class="normal14" >員工代號：</td>
		<td class="normal14"  ><input   tabIndex="1" id="yg002" onKeyPress="keyFunction()" onchange="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>"  type="text" required /><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="palq01adisp"> <?php    echo $palq01adisp; ?>  </span></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14" >部門代號：</td>
		<td class="normal14"  ><input type="text" tabIndex="3" id="yg003" onKeyPress="keyFunction()" name="yg003"   value="<?php echo  $yg003; ?>"   /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	  <tr>
	    <td class="normal14" >應稅獎金：</td>
		<td class="normal14"  ><input type="text" tabIndex="4" id="yg004" onfocus="this.select()" onchange="amt1()" onKeyPress="keyFunction()" name="yg004"   value="<?php echo  $yg004; ?>"   /></td>
		<td class="normal14" >-遲-事+功-過+全：</td>
		<td class="normal14"  ><input type="text" tabIndex="5" id="yg005" onfocus="this.select()" onchange="amt1()" onKeyPress="keyFunction()" name="yg005"   value="<?php echo  $yg005; ?>"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >金額小計：</td>
		<td class="normal14"  ><input type="text" readonly="value" onfocus="amt1()" onchange="amt2()" tabIndex="6" id="yg006" onKeyPress="keyFunction()" name="yg006"   value="<?php echo  $yg006; ?>"   /></td>
		<td class="normal14" >免稅獎金：</td>
		<td class="normal14"  ><input type="text" tabIndex="7" id="yg007" onchange="amt2()" onfocus="this.select()" onKeyPress="keyFunction()" name="yg007"   value="<?php echo  $yg007; ?>"   /></td>
	  </tr> 
	  <tr>
	    <td class="normal14" >總獎金合計：</td>
		<td class="normal14"  ><input type="text" readonly="value" onfocus="amt2()" tabIndex="8" id="yg008" onKeyPress="keyFunction()" name="yg008"   value="<?php echo  $yg008; ?>"   /></td>
		<td class="normal14" ></td>
		<td class="normal14"  ></td>
	  </tr> 
	  
	</table>
	   		  
	<div class="buttons">
	  <button  type='submit' accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x"   id='cancel' name='cancel' href="<?php echo site_url('pal/pali46/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> 
    </form>
	
    </div>  <!-- div-6 -->
  </div>  <!-- div-5 -->
</div>   <!-- div-4 -->

  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-3 -->
  </div>   <!-- div-2 -->
</div>    <!-- div-1 -->

<?php include("./application/views/fun/pali46_funjs_v.php"); ?> 