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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 異動薪資維護作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pal/pali26/addsave" >	
	<!-- <div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $md001=$this->input->post('md001');
	  $palq01a=$this->input->post('palq01a');
	  $palq01adisp=$this->input->post('md001');
	  $md002=$this->input->post('md002');
	  $cmsq05a=$this->input->post('cmsq05a');
	  $cmsq05adisp=$this->input->post('md002');
	  $cmsq09bdisp=$this->input->post('md018');
	  
	   if (!isset($md003)) { $md003=0;} else { $md003=$this->input->post('md003');}
	   if (!isset($md004)) { $md004=0;} else { $md004=$this->input->post('md004');}
	   if (!isset($md005)) { $md005=0;} else { $md005=$this->input->post('md005');}
	   if (!isset($md006)) { $md006=0;} else { $md006=$this->input->post('md006');}
	   if (!isset($md007)) { $md007=0;} else { $md007=$this->input->post('md007');}
	   if (!isset($md008)) { $md008=0;} else { $md008=$this->input->post('md008');}
	   if (!isset($md009)) { $md009=0;} else { $md009=$this->input->post('md009');}
	   if (!isset($md010)) { $md010=0;} else { $md010=$this->input->post('md010');}
	   if (!isset($md011)) { $md011=0;} else { $md011=$this->input->post('md011');}
	   if (!isset($md012)) { $md012=0;} else { $md012=$this->input->post('md012');}
	   if (!isset($md013)) { $md013=0;} else { $md013=$this->input->post('md013');}
	
	   if (!isset($md014)) { $md014=date("Y/m/d");}
	   $md015=$this->input->post('md015');
	   if (!isset($md016)) { $md016='';} else { $md016=$this->input->post('md016');}
	   if (!isset($md017)) { $md017='';} else { $md017=$this->input->post('md017');}
	   if (!isset($md018)) { $md018='';} else { $md018=$this->input->post('md018');}
	   if (!isset($md019)) { $md019='';} else { $md019=$this->input->post('md019');}
	   if (!isset($md020)) { $md020='5';} else { $md020=$this->input->post('md020');}
	  
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="start14a" width="8%"><span class="required">員工代號：</span></td>
        <td class="normal14a" width="42%" ><input   tabIndex="1" id="md001" onKeyPress="keyFunction()" onchange="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>"  type="text" required /><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="palq01adisp"> <?php    echo $palq01adisp; ?> </span></td>
	    <td class="start14a" width="8%"><span class="required">部門代號：</span></td>
        <td class="normal14a"  width="42%"> <input   tabIndex="2" id="md002" onKeyPress="keyFunction()" onchange="startcmsq05a(this)" name="cmsq05a" value="<?php echo $cmsq05a; ?>"  type="text" required /><img id="Showcmsq05a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
         <span id="cmsq05adisp"> <?php    echo $cmsq05adisp; ?> </span></td>
       
	  </tr>	
		  
	  <tr>
	    <td class="start14a" >異動日期： </td>
        <td class="normal14" ><input  tabIndex="3" onchange="dateformat_ymd(this);" onKeyPress="keyFunction()" onclick="scwShow(this,event);"  id="md014" name="md014"  value="<?php echo $md014; ?>"  type="text" style="background-color:#E7EFEF" /></td>
		<td class="normal14" >異動原因：</td>
		<td class="normal14"><input  tabIndex="4" onKeyPress="keyFunction()"  id="md015" name="md015"  value="<?php echo $md015; ?>"  type="text" size="60" /></td>	
	  </tr>
	  <tr>
	    <td class="start14a" >日薪： </td>
        <td class="normal14" ><input  tabIndex="3" onKeyPress="keyFunction()" onchange="addsel(this)"  id="md003" name="md003"  value="<?php echo $md003; ?>"  type="text"  /></td>
		<td class="normal14" >本薪：</td>
		<td class="normal14"><input  tabIndex="4" onKeyPress="keyFunction()" onchange="addsel(this)" id="md004" name="md004"  value="<?php echo $md004; ?>"  type="text"  /></td>	
	  </tr>
	  <tr>
	    <td  class="normal14" >職務加級：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" id="md005"  onchange="addsel(this)"   onKeyPress="keyFunction()"    name="md005" value="<?php echo $md005; ?>"  /></td>	  
	    <td class="normal14">主管加級：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="6" id="md006"   onchange="addsel(this)"  onKeyPress="keyFunction()"    name="md006" value="<?php echo $md006; ?>"  /></td>
	  </tr>
	   <tr>
	    <td  class="normal14" >伙食津貼：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" id="md007"  onchange="addsel(this)"    onKeyPress="keyFunction()"    name="md007" value="<?php echo $md007; ?>"  /></td>	  
	    <td class="normal14a">全勤獎金：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="8" id="md008"  onchange="addsel(this)"    onKeyPress="keyFunction()"    name="md008" value="<?php echo $md008; ?>"  /></td>
	  </tr>
	   <tr>
	    <td  class="normal14" >特別津貼：</td>
        <td  class="normal14"  ><input type="text" tabIndex="9" id="md009"   onchange="addsel(this)"   onKeyPress="keyFunction()"    name="md009" value="<?php echo $md009; ?>" /></td>	  
	    <td class="normal14">業務津貼：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="md010"  onchange="addsel(this)"    onKeyPress="keyFunction()"    name="md010" value="<?php echo $md010; ?>"  /></td>
	  </tr>
	   <tr>
	    <td  class="normal14a" >執照津貼：</td>
        <td  class="normal14"  ><input type="text" tabIndex="11" id="md011"   onchange="addsel(this)"   onKeyPress="keyFunction()"    name="md011" value="<?php echo $md011; ?>"  /></td>	  
	    <td class="normal14">資歷津貼：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="12" id="md012"   onchange="addsel(this)"   onKeyPress="keyFunction()"    name="md012" value="<?php echo $md012; ?>"  /></td>
	  </tr>
	   <tr>
	    <td  class="normal14" >合計全薪：</td>
        <td  class="normal14"  ><input type="text" tabIndex="12" id="md013"  onfocus="addsel(this)"    onKeyPress="keyFunction()"    name="md013" value="<?php echo $md013; ?>" readonly="readonly" /></td>
       
	    <td class="normal14"></td>		
        <td  class="normal14"  ></td>
	  </tr>
	   <tr>
	    <td  class="normal14a" >職等：</td>
        <td  class="normal14"  ><input type="text" tabIndex="11" id="md016"   size="40"   onKeyPress="keyFunction()"    name="md016" value="<?php echo $md016; ?>"  /></td>	  
	    <td class="normal14">職級：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="12" id="md017"   size="40"   onKeyPress="keyFunction()"    name="md017" value="<?php echo $md017; ?>"  /></td>
	  </tr>
	  <tr>
	    <td  class="normal14a" >職稱：</td>
        <td  class="normal14"  ><input type="text" tabIndex="8" onKeyPress="keyFunction()" id="md018"  name="md018"  onchange="startcmsq09b(this)"    value="<?php echo  $md018; ?>"     /><a href="javascript:;"><img id="Showcmsq09b" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
	   <span id="cmsq09bdisp" > <?php    echo $cmsq09bdisp; ?> </span></td>  
	    <td class="normal14">職務：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="12" id="md019" size="40"     onKeyPress="keyFunction()"    name="md019" value="<?php echo $md019; ?>"  /></td>
	  </tr>
	  <tr>
	    <td  class="normal14" >異動類別：</td>
        <td  class="normal14"  > <select id="md020" onKeyPress="keyFunction()" name="md020"  tabIndex="38">
            <option <?php if($md020 == '1') echo 'selected="selected"';?> value='1'>1.新進</option>                                                                        
		    <option <?php if($md020 == '2') echo 'selected="selected"';?> value='2'>2.晉升</option>		
			<option <?php if($md020 == '3') echo 'selected="selected"';?> value='3'>3.調任</option>	
            <option <?php if($md020 == '4') echo 'selected="selected"';?> value='4'>4.兼任</option>	
            <option <?php if($md020 == '5') echo 'selected="selected"';?> value='5'>5.其他</option>			
		  </select></td>   
	    <td class="normal14"></td>		
        <td  class="normal14"  ></td>
	  </tr>
	</table>
	      
	<div class="buttons">
	<button tabIndex="8" type='submit' accesskey="s"   name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali26/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
 <?php include("./application/views/fun/pali26_funjs_v.php"); ?> 
<script>

/*
$('#md001').change(function(){
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/pal/pali26/get_pali23?md001='+$('#md001').val(),
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