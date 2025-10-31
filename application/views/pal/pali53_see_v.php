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

<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 加班單建立作業 - 查看</h1>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali53/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
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
      
	<table class="form14">
      <tr>
	    <td class="start14a" width="15%"><span class="required">員工代號：</span></td>
        <td class="normal14a" width="35%" ><input   tabIndex="1" id="tf001" onKeyPress="keyFunction()" onchange="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>"  type="text" required disabled="disabled" /><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="palq01adisp"> <?php    echo $palq01adisp; ?>  </span></td>
	    <td class="start14a" width="15%"><span class="required">加班日期：</span></td>
        <td class="normal14a"  width="35%"><input tabIndex="2"  onclick="scwShow(this,event);"  id="tf002" onKeyPress="keyFunction()"  name="tf002"  value="<?php echo $tf002; ?>"  size="12" type="text"  style="background-color:#E7EFEF" disabled="disabled"/></td>
       
	  </tr>	
		  
	  <tr>
	    <td class="start14a" >星期： </td>
        <td class="normal14" ><input  tabIndex="3" onKeyPress="keyFunction()"   onfocus="timeday(this);"  id="tf003" name="tf003"  value="<?php echo $tf003; ?>"  type="text" disabled="disabled" />
		<span id="timedisp"> </span></td>
		<td class="normal14" >起加班時分1：</td>
		<td class="normal14"><input  tabIndex="4" onKeyPress="keyFunction()" onchange="checktime(this)" id="tf004" name="tf004"  value="<?php echo $tf004; ?>"  type="text" disabled="disabled" /></td>	
	  </tr>
		
	  <tr>
	    <td  class="normal14" >迄加班時分1：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" id="tf005"     onKeyPress="keyFunction()"  onchange="checktime(this)"  name="tf005" value="<?php echo $tf005; ?>" disabled="disabled" /></td>	  
	    <td class="normal14">加班時數1：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="6" id="tf006"     onfocus="timecal(this);"  onKeyPress="keyFunction()"    name="tf006" value="<?php echo $tf006; ?>" disabled="disabled" /></td>
	  
	   </tr>
	   <tr>
	    <td  class="normal14" >起加班時分2：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" id="tf007"     onKeyPress="keyFunction()"  onchange="checktime(this)"  name="tf007" value="<?php echo $tf007; ?>" disabled="disabled" /></td>	  
	    <td class="normal14">迄加班時分2：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="8" id="tf008"   onchange="checktime(this)"  onKeyPress="keyFunction()"    name="tf008" value="<?php echo $tf008; ?>"  disabled="disabled"/></td>
	  
	   </tr>
	   <tr>
	    <td  class="normal14" >加班時數2：</td>
        <td  class="normal14"  ><input type="text" tabIndex="9" id="tf009"  onfocus="timecal2(this);"   onKeyPress="keyFunction()"    name="tf009" value="<?php echo $tf009; ?>" disabled="disabled" /></td>	  
	    <td class="normal14">平時加班2時內：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="tf010"    onKeyPress="keyFunction()"    name="tf010" value="<?php echo $tf010; ?>" disabled="disabled" /></td>
	  
	   </tr>
	   <tr>
	    <td  class="normal14" >平時加班2時外：</td>
        <td  class="normal14"  ><input type="text" tabIndex="11" id="tf011"     onKeyPress="keyFunction()"    name="tf011" value="<?php echo $tf011; ?>" disabled="disabled" /></td>	  
	    <td class="normal14">六加班8時內：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="12" id="tf012"     onKeyPress="keyFunction()"    name="tf012" value="<?php echo $tf012; ?>" disabled="disabled" /></td>
	  
	   </tr>
	   <tr>
	    <td  class="normal14" >六加班8時外：</td>
        <td  class="normal14"  ><input type="text" tabIndex="13" id="tf013"     onKeyPress="keyFunction()"    name="tf013" value="<?php echo $tf013; ?>" disabled="disabled" /></td>	  
	    <td class="normal14">國日加班8時內：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="14" id="tf014"     onKeyPress="keyFunction()"    name="tf014" value="<?php echo $tf014; ?>" disabled="disabled" /></td>
	  
	   </tr>
	   <tr>
	    <td  class="normal14" >國日加班8時外：</td>
        <td  class="normal14"  ><input type="text" tabIndex="15" id="tf015"     onKeyPress="keyFunction()"    name="tf015" value="<?php echo $tf015; ?>" disabled="disabled" /></td>	  
	    <td class="normal14">備註：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="16" id="tf016"     onKeyPress="keyFunction()"    name="tf016" value="<?php echo $tf016; ?>" size="60" disabled="disabled" /></td>
	  	</tr>   
    </table>
		
	  <div class="buttons">
	    <a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali53/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>
        </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
    <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>
  </div> <!-- div-3 -->
 </div> <!-- div-2 -->
</div> <!-- div-1 -->
