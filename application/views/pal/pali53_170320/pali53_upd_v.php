<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	   </div>
    </div>

<div id="content">  <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 加班單建立作業 - 修改</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali53/updsave" method="post" enctype="multipart/form-data" >
	<!-- <div id="htabs" class="htabs14"><span>編輯項目-修改</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $palq01a=$row->tf001;?>
		  <?php   $palq01adisp=$row->tf001disp;?>
          <?php   $tf002=substr($row->tf002,0,4).'/'.substr($row->tf002,4,2).'/'.substr($row->tf002,6,2);?>	    
		  <?php   $tf003=$row->tf003;?>
		  <?php   $tf004=$row->tf004;?>
          <?php   $tf005=$row->tf005;?>
		  <?php   $tf006=$row->tf006;?>
		  <?php   $tf007=$row->tf007;?>
		  <?php   $tf008=$row->tf008;?>
		  <?php   $tf009=$row->tf009;?>
		  <?php   $tf010=$row->tf010;?>
		  <?php   $tf011=$row->tf011;?>
		  <?php   $tf012=$row->tf012;?>
		  <?php   $tf013=$row->tf013;?>
		  <?php   $tf014=$row->tf014;?>
		  <?php   $tf015=$row->tf015;?>
		  <?php   $tf016=$row->tf016;?>
		  
          <?php   $flag=$row->flag;?>	  
	<?php  }?>
       
	<table class="form14">  <!-- 表格 -->
       <tr>
	    <td class="start14a" width="15%"><span class="required">員工代號：</span></td>
        <td class="normal14a" width="35%" ><input   tabIndex="1" id="tf001" onKeyPress="keyFunction()" onchange="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>"  type="text" required /><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="palq01adisp"> <?php    echo $palq01adisp; ?>  </span></td>
	    <td class="start14a" width="15%"><span class="required">加班日期：</span></td>
        <td class="normal14a"  width="35%"><input tabIndex="2"  onclick="scwShow(this,event);"  id="tf002" onKeyPress="keyFunction()"  name="tf002"  value="<?php echo $tf002; ?>"  size="12" type="text"  style="background-color:#E7EFEF" /></td>
       
	  </tr>	
		  
	   <tr>
	    <td class="start14a">星期：</td>
        <td class="normal14"><input tabIndex="3" onKeyPress="keyFunction()" onfocus="timeday(this);"  id="tf003" name="tf003"  value="<?php echo $tf003; ?>"  type="text"  />
		<span id="timedisp"></span></td>
		<td class="normal14"></td>
		<td class="normal14"></td>
	  </tr>
	  <tr>   
	    <td class="normal14">起加班時分1：</td>
		<td class="normal14"><input tabIndex="4" onKeyPress="keyFunction()" onchange="count_time(this)" id="tf004" name="tf004"  value="<?php echo $tf004; ?>"  type="text"  /></td>	
		<td class="normal14">起加班時分2：</td>
        <td class="normal14"><input type="text" tabIndex="7" id="tf007" onKeyPress="keyFunction()"  onchange="count_time(this)"  name="tf007" value="<?php echo $tf007; ?>"  /></td>	  
	   </tr>
	   <tr>
	    <td class="normal14">迄加班時分1：</td>
        <td class="normal14"><input type="text" tabIndex="5" id="tf005" onKeyPress="keyFunction()"  onchange="count_time(this)"  name="tf005" value="<?php echo $tf005; ?>"  /></td>	  
		<td class="normal14">迄加班時分2：</td>		
        <td class="normal14"><input type="text" tabIndex="8" id="tf008" onchange="count_time(this)"  onKeyPress="keyFunction()"    name="tf008" value="<?php echo $tf008; ?>"  /></td>
	   </tr>
	   <tr>
	    <td class="normal14">加班時數1：</td>		
        <td class="normal14"><input type="text" tabIndex="6" id="tf006" onfocus="count_time(this);"  onKeyPress="keyFunction()"    name="tf006" value="<?php echo $tf006; ?>"  /></td>
	    <td class="normal14">加班時數2：</td>
        <td class="normal14"><input type="text" tabIndex="9" id="tf009"  onfocus="count_time(this);"   onKeyPress="keyFunction()"    name="tf009" value="<?php echo $tf009; ?>"  /></td>
	   </tr>
	   <tr>
		<td class="normal14">平時加班2時內：</td>		
        <td class="normal14"><input type="text" tabIndex="10" id="tf010" onKeyPress="keyFunction()" name="tf010" value="<?php echo $tf010; ?>" /></td>
	    <td class="normal14">平時加班2時外：</td>
        <td class="normal14"><input type="text" tabIndex="11" id="tf011" onKeyPress="keyFunction()" name="tf011" value="<?php echo $tf011; ?>" /></td>
	   </tr>
	   <tr>
	    <td class="normal14">六加班2時內：</td>		
        <td class="normal14"><input type="text" tabIndex="12" id="tf012"     onKeyPress="keyFunction()"    name="tf012" value="<?php echo $tf012; ?>"  /></td>
	    <td class="normal14">六加班2時外：</td>
        <td class="normal14"><input type="text" tabIndex="13" id="tf013"     onKeyPress="keyFunction()"    name="tf013" value="<?php echo $tf013; ?>"  /></td>	  
	   </tr>
	   <tr>
	   <td class="normal14">日加班8時內：</td>		
        <td class="normal14"><input type="text" tabIndex="14" id="tf014"     onKeyPress="keyFunction()"    name="tf014" value="<?php echo $tf014; ?>"  /></td>
	    <td class="normal14">日加班8時外：</td>
        <td class="normal14"><input type="text" tabIndex="15" id="tf015"     onKeyPress="keyFunction()"    name="tf015" value="<?php echo $tf015; ?>"  /></td>	  
	   </tr>
	   <tr>
		<td class="normal14">備註：</td>		
        <td class="normal14" colspan="3" ><input type="text" tabIndex="16" id="tf016"     onKeyPress="keyFunction()"    name="tf016" value="<?php echo $tf016; ?>" size="60" /></td>
	   </tr>
     </table>
		
		<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
		
	  <div class="buttons">
	    <button tabIndex="8" type='submit' accesskey="s"  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali53/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
<?php include("./application/views/fun/pali53_funjs_v.php"); ?>
<script>
function count_time(obj){
	$('#tf010').val("");$('#tf011').val("");$('#tf012').val("");$('#tf013').val("");
	$('#tf014').val("");$('#tf015').val("");
	var week = $('#tf003').val();
	var time1_str = $('#tf004').val();
	var time1_end = $('#tf005').val();
	var time2_str = $('#tf007').val();
	var time2_end = $('#tf008').val();
	var time1 = (time1_end.substr(0,2)*1 - time1_str.substr(0,2)*1)+(time1_end.substr(2,2)*1-time1_str.substr(2,2)*1)/60;
	if(time1_str<"1200"&&time1_end>"1300"){time1-=1;}
	var time2 = (time2_end.substr(0,2)*1 - time2_str.substr(0,2)*1)+(time2_end.substr(2,2)*1-time2_str.substr(2,2)*1)/60;
	if(time2_str<"1200"&&time2_end>"1300"){time2-=1;}
	$('#tf006').val(time1);$('#tf009').val(time2);
	var total_time = time1+time2;
	if(week == 0){
		if(total_time>8){
			$('#tf014').val(8);$('#tf015').val(total_time-8);
		}else{
			$('#tf014').val(total_time);
		}
	}else if(week == 6){
		if(total_time>2){
			$('#tf012').val(2);$('#tf013').val(total_time-2);
		}else{
			$('#tf012').val(total_time);
		}
	}else{
		if(total_time>2){
			$('#tf010').val(2);$('#tf011').val(total_time-2);
		}else{
			$('#tf010').val(total_time);
		}
	}
	
	
}
</script>
