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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 年度出勤考績作業 - 修改</h1>
    </div>
	
    <div class="content">  <!-- div-5 --> 
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali44/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>--> 
	<div id="tab-general">  <!-- div-6 --> 
	<?php foreach($result as $row) { ?>
          <?php   $ye001=$row->ye001;?>
          <?php   $palq01a=$row->ye002;?>
		  <?php   $palq01adisp=$row->ye002disp;?>
          <?php   $ye003=$row->ye003;?>
		  <?php   $ye004=$row->ye004;?>
		  <?php   $ye005=$row->ye005;?>
		  <?php   $ye006=$row->ye006;?>
		  <?php   $ye007=$row->ye007;?>
		  <?php   $ye008=$row->ye008;?>
		  <?php   $ye009=$row->ye009;?>
		  <?php   $ye010=$row->ye010;?>
		  <?php   $ye011=$row->ye011;?>
		  <?php   $ye012=$row->ye012;?>
		   <?php   $ye013=$row->ye013;?>
          <?php   $flag=$row->flag;?>	  
	<?php  }?>
       
	<table class="form14">  <!-- 表格 -->
        
	 <tr>
	    <td class="start14a"  width="11%" ><span class="required">出勤年度：</span> </td>
        <td class="normal14"  width="39%"><input   tabIndex="1" id="ye001" onKeyPress="keyFunction()" onchange="startkey(this)" name="ye001" value="<?php echo $ye001; ?>"  type="text" required />
	        <span id="keydisp" ></span></td>
		 <td class="normal14" width="11%" >員工代號：</td>
		<td class="normal14" width="39%" ><input   tabIndex="2" id="ye002" onKeyPress="keyFunction()" onchange="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>"  type="text" required /><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="palq01adisp"> <?php    echo $palq01adisp; ?>  </span></td>
	  </tr>
	  <tr>
	    <td class="normal14" >部門代號：</td>
		<td class="normal14"  ><input type="text" tabIndex="3" id="ye003" onKeyPress="keyFunction()" name="ye003"   value="<?php echo  $ye003; ?>"   /></td>
		<td class="normal14" >遲到扣日：</td>
		<td class="normal14"  ><input type="text" tabIndex="4" id="ye004" onKeyPress="keyFunction()" name="ye004"   value="<?php echo  $ye004; ?>"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >病假日：</td>
		<td class="normal14"  ><input type="text" tabIndex="5" id="ye005" onKeyPress="keyFunction()" name="ye005"   value="<?php echo  $ye005; ?>"   /></td>
		<td class="normal14" >事假日：</td>
		<td class="normal14"  ><input type="text" tabIndex="6" id="ye006" onKeyPress="keyFunction()" name="ye006"   value="<?php echo  $ye006; ?>"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >功過日：</td>
		<td class="normal14"  ><input type="text" tabIndex="5" id="ye007" onKeyPress="keyFunction()" name="ye007"   value="<?php echo  $ye007; ?>"   /></td>
		<td class="normal14" >全勤日：</td>
		<td class="normal14"  ><input type="text" tabIndex="6" id="ye008" onKeyPress="keyFunction()" name="ye008"   value="<?php echo  $ye008; ?>"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >年資：</td>
		<td class="normal14"  ><input type="text" tabIndex="5" id="ye009" onKeyPress="keyFunction()" name="ye009"   value="<?php echo  $ye009; ?>"   /></td>
		<td class="normal14" >日薪：</td>
		<td class="normal14"  ><input type="text" tabIndex="6" id="ye010" onKeyPress="keyFunction()" name="ye010"   value="<?php echo  $ye010; ?>"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14" >考績總分：</td>
		<td class="normal14"  ><input type="text" tabIndex="5" id="ye011" onKeyPress="keyFunction()" name="ye011"   value="<?php echo  $ye011; ?>"   /></td>
		<td class="normal14" >年考績：</td>
		<td class="normal14"  ><input type="text" tabIndex="10" id="ye012" onKeyPress="keyFunction()" name="ye012"   value="<?php echo  $ye012; ?>"   /></td>
		<!--<td class="normal14"  ><select id="ye012" onKeyPress="keyFunction()" name="ye012"  tabIndex="12">
		    <option <?php // if($ye012 == '2') echo 'selected="selected"';?> value='2'>2甲</option>
            <option <?php  // if($ye012 == '1') echo 'selected="selected"';?> value='1'>1優</option> 
            <option <?php  // if($ye012 == '3') echo 'selected="selected"';?> value='3'>3乙</option>
		    <option <?php // if($ye012 == '4') echo 'selected="selected"';?> value='4'>4丙</option>
            <option <?php // if($ye012 == '5') echo 'selected="selected"';?> value='5'>5丁</option>				
		  </select></td> -->
	  </tr>
	  <tr>
	    <td class="normal14" >備註：</td>
		<td class="normal14" colspan='2' ><input type="text" tabIndex="9" id="ye013" onKeyPress="keyFunction()" name="ye013"   value="<?php echo  $ye013;  ?>" size="100"  /></td>
		<td class="normal14" ></td>
		<td class="normal14"  ></td>
	  </tr>
    </table>
		
	<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
		
	<div class="buttons">
	   <button  type='submit'  accesskey="s"  name="submit"  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x"  onKeyPress="keyFunction()" id="cancel" name="cancel" href="<?php echo site_url('pal/pali44/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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