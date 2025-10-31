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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 獎懲紀錄維護作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pal/pali13/addsave" >	
	<!-- <div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $mv001=$this->input->post('mv001');
	  $palq01a=$this->input->post('palq01a');
	  $palq01adisp=$this->input->post('mv001');
	  $mv002=$this->input->post('mv002');
	  $cmsq05a=$this->input->post('cmsq05a');
	  $cmsq05adisp=$this->input->post('mv002');
	  
	  $palq12a=$this->input->post('palq12a');
	  $palq12adisp=$this->input->post('mv006');
	  $palq17a=$this->input->post('palq17a');
	  $palq17adisp=$this->input->post('mv004');
	   if (!isset($mv003)) { $mv003='';} else { $mv003=$this->input->post('mv003');}
	   if (!isset($mv004)) { $mv004='';} else { $mv004=$this->input->post('mv004');}
	   if (!isset($mv005)) { $mv005='';} else { $mv005=$this->input->post('mv005');}
	   if (!isset($mv006)) { $mv006='';} else { $mv006=$this->input->post('mv006');}
	   if (!isset($mv007)) { $mv007='';} else { $mv007=$this->input->post('mv007');}
	
	   if (!isset($mv003)) { $mv003=date("Y/m/d");}
	   
	  
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="start14a" width="8%"><span class="required">員工代號：</span></td>
        <td class="normal14a" width="42%" ><input   tabIndex="1" id="mv001" onKeyPress="keyFunction()" onchange="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>"  type="text" required /><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="palq01adisp"> <?php    echo $palq01adisp; ?> </span></td>
	    <td class="start14a" width="10%"><span class="required">部門代號：</span></td>
        <td class="normal14a"  width="40%"> <input   tabIndex="2" id="mv002" onKeyPress="keyFunction()" onchange="startcmsq05a(this)" name="cmsq05a" value="<?php echo $cmsq05a; ?>"  type="text" required /><img id="Showcmsq05a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
         <span id="cmsq05adisp"> <?php    echo $cmsq05adisp; ?> </span></td>
       
	  </tr>	
		  
	  <tr>
	    <td class="start14a" >異動日期： </td>
        <td class="normal14" ><input  tabIndex="3" onKeyPress="keyFunction()" onclick="scwShow(this,event);"  onchange="dateformat_ymd(this);" id="mv003" name="mv003"  value="<?php echo $mv003; ?>"  type="text" style="background-color:#E7EFEF" /></td>
		<td class="normal14" >說明：</td>
		<td class="normal14"><input  tabIndex="4" onKeyPress="keyFunction()"  id="mv007" name="mv007"  value="<?php echo $mv007; ?>"  type="text" size="60" /></td>	
	  </tr>
	    <tr>
	    <td class="start14a" >獎懲： </td>
        <td class="normal14" ><input   tabIndex="2" id="mv004" onKeyPress="keyFunction()" onchange="startpalq17a(this)" name="palq17a" value="<?php echo $palq17a; ?>"  type="text"  /><img id="Showpalq17a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="palq17adisp"> <?php    echo $palq17adisp; ?> </span></td>
		<td class="normal14" >次數：</td>
		<td class="normal14"><input  tabIndex="4" onKeyPress="keyFunction()"  id="mv005" name="mv005"  value="<?php echo $mv005; ?>"  type="text"  /></td>	
	  </tr>
	  <tr>
	    <td  class="normal14" >條例代號：</td>
        <td  class="normal14"  ><input   tabIndex="2" id="mv006" onKeyPress="keyFunction()" onchange="startpalq12a(this)" name="palq12a" value="<?php echo $palq12a; ?>"  type="text"  /><img id="Showpalq12a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="palq12adisp"> <?php    echo $palq12adisp; ?> </span></td>	  
	    <td class="normal14"></td>		
        <td  class="normal14"  ></td>
	  </tr>
	   
	</table>
	      
	<div class="buttons">
	<button tabIndex="8" type='submit' accesskey="s"   name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali13/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
 <?php include("./application/views/fun/pali13_funjs_v.php"); ?> 
<script>

/*
$('#mv001').change(function(){
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/pal/pali13/get_pali23?mv001='+$('#mv001').val(),
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: req,
		success:      
		function(data){  
			if(data.response =="true"){
				console.log(data);
			}
		}
	});

});*/
 
</script>