 <div id="container">  <!-- div-1 -->
  <div id="header">    <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
    </div>

<div id="content">  <!-- div-3 -->
 <div class="box">  <!-- div-4 --> 
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 考績分數建立作業 - 修改</h1>
    </div>
	
    <div class="content">  <!-- div-5 --> 
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali45/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>--> 
	<div id="tab-general">  <!-- div-6 --> 
	<?php foreach($result as $row) { ?>
          <?php   $yf001=$row->yf001;?>
          <?php   $palq01a=$row->yf002;?>
		  <?php   $palq01adisp=$row->yf002disp;?>
          <?php   $yf003=$row->yf003;?>
		  <?php   $yf004=$row->yf004;?>
		  <?php   $yf005=$row->yf005;?>
          <?php   $flag=$row->flag;?>	  
	<?php  }?>
       
	<table class="form14">  <!-- 表格 -->
        
	  <tr>
	    <td class="start14a"  width="11%" ><span class="required">考績年度：</span> </td>
        <td class="normal14"  width="39%"><input   tabIndex="1" id="yf001" onKeyPress="keyFunction()" onfocus="circle()" onchange="startkey(this)" name="yf001" value="<?php echo $yf001; ?>"  type="text" required />
	        <span id="keydisp" ></span></td>
		<td class="normal14" ></td>
        <td class="normal14"  ></td>
	  </tr>
	  <tr>
	    <td class="normal14" >員工代號：</td>
		<td class="normal14"  ><input   tabIndex="1" id="yf002" onKeyPress="keyFunction()" onchange="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>"  type="text" required /><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="palq01adisp"> <?php    echo $palq01adisp; ?>  </span></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14" >部門代號：</td>
		<td class="normal14"  ><input type="text" tabIndex="3" id="yf003" onKeyPress="keyFunction()" name="yf003"   value="<?php echo  $yf003; ?>"   /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	 <tr>
	    <td class="normal14" >考績分數：</td>
		<td class="normal14"  ><input type="text" tabIndex="4" id="yf004" onKeyPress="keyFunction()" name="yf004" onchange="circle()"  value="<?php echo  $yf004; ?>"   /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	   <tr>
	    <td class="normal14" >考績：</td>
		<td class="normal14"  ><select id="yf005" onKeyPress="keyFunction()" name="yf005"  tabIndex="12">
		    <option <?php if($yf005 == '2') echo 'selected="selected"';?> value='2'>2甲</option>
            <option <?php if($yf005 == '1') echo 'selected="selected"';?> value='1'>1優</option> 
            <option <?php if($yf005 == '3') echo 'selected="selected"';?> value='3'>3乙</option>
		    <option <?php if($yf005 == '4') echo 'selected="selected"';?> value='4'>4丙</option>
            <option <?php if($yf005 == '5') echo 'selected="selected"';?> value='5'>5丁</option>				
		  </select></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"><div id="circle"></div></td>
	  </tr>
	 
    </table>
		
	<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
		
	<div class="buttons">
	   <button  type='submit'  accesskey="s"  name="submit"  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x"  onKeyPress="keyFunction()" id="cancel" name="cancel" href="<?php echo site_url('pal/pali45/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div>
	   
    </form>
    </div>  <!-- div-6 -->
  </div>   <!-- div-5 -->
</div>     <!-- div-4 -->
    <?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div>  <!-- div-3 -->
  </div>   <!-- div-2 -->
</div>   <!-- div-1 -->
<script>
 function circle()
 {
 var num1=$('input[name=\'yf004\']').val();
 var num=num1*0.01;
  $('#circle').circleProgress({
    value: num,
    size: 80,
    fill: {
      gradient: ["red", "orange"]
    }
  });
 }
</script>