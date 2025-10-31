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

<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 固定津貼建立作業 - 查看</h1>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali23/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
         <?php   $palq01a=$row->md001;?>
		  <?php   $palq01adisp=$row->md001disp;?>
          <?php   $cmsq05a=$row->md002;?>
		  <?php   $cmsq05adisp=$row->md002disp;?>
		  
          <?php   $md003=$row->md003;?>
	      <?php   $md004=$row->md004;?>
          <?php   $md005=$row->md005;?>
		  <?php   $md006=$row->md006;?>
		  <?php   $md007=$row->md007;?>
		  <?php   $md008=$row->md008;?>
		  <?php   $md009=$row->md009;?>
		  <?php   $md010=$row->md010;?>	
          <?php   $md011=$row->md011;?>			  
		  <?php   $md012=$row->md012;?>
		  <?php   $md013=$row->md013;?>
		  <?php   $md014=$row->md014;?>
		 
          <?php   $flag=$row->flag;?>	  
	<?php  }?>
      
	<table class="form14">
        <tr>
	    <td class="start14a" width="8%"><span class="required">員工代號：</span></td>
        <td class="normal14a" width="42%" ><input   tabIndex="1" id="md001" onKeyPress="keyFunction()" onchange="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>"  type="text" required disabled="disabled" /><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="palq01adisp"> <?php    echo $palq01adisp; ?> </span></td>
	    <td class="start14a" width="10%"><span class="required">部門代號：</span></td>
        <td class="normal14a"  width="40%"> <input   tabIndex="2" id="md002" onKeyPress="keyFunction()" onchange="startcmsq05a(this)" name="cmsq05a" value="<?php echo $cmsq05a; ?>"  type="text" required disabled="disabled" /><img id="Showcmsq05a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
         <span id="cmsq05adisp"> <?php    echo $cmsq05adisp; ?> </span></td>
       
	  </tr>	
		  
	  <tr>
	    <td class="start14a" >日薪： </td>
        <td class="normal14" ><input  tabIndex="3" onKeyPress="keyFunction()" onchange="addsel(this)"  id="md003" name="md003"  value="<?php echo $md003; ?>"  type="text" disabled="disabled" /></td>
		<td class="normal14" >本薪：</td>
		<td class="normal14"><input  tabIndex="4" onKeyPress="keyFunction()" onchange="addsel(this)" id="md004" name="md004"  value="<?php echo $md004; ?>"  type="text" disabled="disabled" /></td>	
	  </tr>
		
	  <tr>
	    <td  class="normal14" >職務加級：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" id="md005"  onchange="addsel(this)"   onKeyPress="keyFunction()"    name="md005" value="<?php echo $md005; ?>"  disabled="disabled"/></td>	  
	    <td class="normal14">主管加級：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="6" id="md006"   onchange="addsel(this)"  onKeyPress="keyFunction()"    name="md006" value="<?php echo $md006; ?>" disabled="disabled" /></td>
	  </tr>
	   <tr>
	    <td  class="normal14" >伙食津貼：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" id="md007"  onchange="addsel(this)"    onKeyPress="keyFunction()"    name="md007" value="<?php echo $md007; ?>" disabled="disabled" /></td>	  
	    <td class="normal14a">全勤獎金：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="8" id="md008"  onchange="addsel(this)"    onKeyPress="keyFunction()"    name="md008" value="<?php echo $md008; ?>"  disabled="disabled"/></td>
	  </tr>
	   <tr>
	    <td  class="normal14" >特別津貼：</td>
        <td  class="normal14"  ><input type="text" tabIndex="9" id="md009"   onchange="addsel(this)"   onKeyPress="keyFunction()"    name="md009" value="<?php echo $md009; ?>" disabled="disabled" /></td>	  
	    <td class="normal14">業務津貼：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="md010"  onchange="addsel(this)"    onKeyPress="keyFunction()"    name="md010" value="<?php echo $md010; ?>" disabled="disabled" /></td>
	  </tr>
	   <tr>
	    <td  class="normal14a" >執照津貼：</td>
        <td  class="normal14"  ><input type="text" tabIndex="11" id="md011"   onchange="addsel(this)"   onKeyPress="keyFunction()"    name="md011" value="<?php echo $md011; ?>"  disabled="disabled"/></td>	  
	    <td class="normal14">資歷津貼：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="12" id="md012"   onchange="addsel(this)"   onKeyPress="keyFunction()"    name="md012" value="<?php echo $md012; ?>" disabled="disabled" /></td>
	  </tr>
	   <tr>
	    <td class="normal14">合計全薪：</td>
        <td class="normal14"><input type="text" tabIndex="13" id="md013" onfocus="addsel(this)" onKeyPress="keyFunction()" name="md013" value="<?php echo $md013; ?>" disabled="disabled" /></td>
	    <td class="normal14">備註：</td>		
        <td class="normal14"><?php echo $md014; ?></td>
	  </tr>
    </table>
		
	  <div class="buttons">
	    <a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali23/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
