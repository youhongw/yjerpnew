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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 異動勞健保退休金維護 - 查看</h1>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali25/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
         <?php   $palq01a=$row->ml001;?>
		  <?php   $palq01adisp=$row->ml001disp;?>
          <?php   $cmsq05a=$row->ml002;?>
		  <?php   $cmsq05adisp=$row->ml002disp;?>
		  
		  <?php   $palq21a=$row->ml008;?>
		  <?php   $palq21adisp=$row->ml008disp;?>
          <?php   $ml003=$row->ml003;?>
	      <?php   $ml004=$row->ml004;?>
          <?php   $ml005=$row->ml005;?>
		  <?php   $ml006=$row->ml006;?>
		  <?php   $ml007=$row->ml007;?>
		 
		  <?php   $palq02a=$row->ml010;?>
		  <?php   $palq02adisp=$row->ml010disp;?>
		  <?php   $ml009=$row->ml009;?>
		  <?php   $palq04a=$row->ml011;?>
		  <?php   $palq04adisp=$row->ml011disp;?>
		    <?php   $ml012=$row->ml012;?>
		  <?php   $ml013=substr($row->ml013,0,4).'/'.substr($row->ml013,4,2).'/'.substr($row->ml013,6,2);?>
		 
		 
          <?php   $flag=$row->flag;?>	  
	<?php  }?>
      
	<table class="form14">
        <tr>
	    <td class="start14a" width="8%"><span class="required">員工代號：</span></td>
        <td class="normal14a" width="42%" ><input   tabIndex="1" id="ml001" onKeyPress="keyFunction()" onchange="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>"  type="text" required disabled="disabled" /><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="palq01adisp"> <?php    echo $palq01adisp; ?> </span></td>
	    <td class="start14a" width="10%"><span class="required">部門代號：</span></td>
        <td class="normal14a"  width="40%"> <input   tabIndex="2" id="ml002" onKeyPress="keyFunction()" onchange="startcmsq05a(this)" name="cmsq05a" value="<?php echo $palq01a; ?>"  type="text" required disabled="disabled" /><img id="Showcmsq05a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
         <span id="cmsq05adisp"> <?php    echo $cmsq05adisp; ?> </span></td>
       
	  </tr>	
		 <tr>
	    <td  class="normal14" >異動日期：</td>
        <td  class="normal14"  ><input type="text" tabIndex="12" id="ml013"  onclick="scwShow(this,event);"    onKeyPress="keyFunction()"    name="ml013" value="<?php echo $ml013; ?>"   style="background-color:#E7EFEF" disabled="disabled" /></td>
       
	    <td class="normal14"></td>		
        <td  class="normal14"  ></td>
	  </tr>    
	   <tr>
	    <td class="normal14" >勞保等級： </td>
        <td class="normal14" ><input   tabIndex="3" id="ml010" onKeyPress="keyFunction()" onchange="startpalq02a(this)" name="palq02a" value="<?php echo $palq02a; ?>"  type="text" required disabled="disabled" /><img id="Showpalq02a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="palq02adisp"> <?php    echo $palq02adisp; ?> </span></td>
		<td class="normal14">勞保投保金額：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="4" id="ml006"     onKeyPress="keyFunction()"    name="ml006" value="<?php echo $ml006; ?>" disabled="disabled" /></td>	
	  </tr>
	  <tr>
	    <td class="normal14" >勞保費： </td>
        <td class="normal14" ><input  tabIndex="5" onKeyPress="keyFunction()"   id="ml003" name="ml003"  value="<?php echo $ml003; ?>"  type="text" disabled="disabled" /></td>
		
	    <td class="normal14" >眷口人數：</td>
		<td class="normal14"><input  tabIndex="6" onKeyPress="keyFunction()"  id="ml012" name="ml012"  value="<?php echo $ml012; ?>"  type="text" disabled="disabled" /></td>
	 </tr>
	  <tr>
	    <td class="normal14" >健保等級：</td>
        <td class="normal14" ><input   tabIndex="7" id="ml011" onKeyPress="keyFunction()" onchange="startpalq04a(this)" name="palq04a" value="<?php echo $palq04a; ?>"  type="text" required disabled="disabled"/><img id="Showpalq04a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="palq04adisp"> <?php    echo $palq04adisp; ?> </span></td>	   
	   <td  class="normal14" >健保投保金額：</td>
        <td  class="normal14"  ><input type="text" tabIndex="8" id="ml007"      onKeyPress="keyFunction()"    name="ml007" value="<?php echo $ml007; ?>" disabled="disabled" /></td>
	  </tr>
	   <tr>
		<td class="normal14" >健保費：</td>
		<td class="normal14"><input  tabIndex="9" onKeyPress="keyFunction()"  id="ml004" name="ml004"  value="<?php echo $ml004; ?>"  type="text" disabled="disabled" /></td>	
	    <td  class="normal14" >退休金：</td>
        <td  class="normal14"  ><input type="text" tabIndex="10" id="ml005"     onKeyPress="keyFunction()"    name="ml005" value="<?php echo $ml005; ?>" disabled="disabled" /></td>
	  </tr>
	   <tr>
	    <td class="normal14a">投保公司：</td>		
        <td  class="normal14"  ><input   tabIndex="11" id="ml008" onKeyPress="keyFunction()" onchange="startpalq21a(this)" name="palq21a" value="<?php echo $palq21a; ?>"  type="text" disabled="disabled" /><img id="Showpalq21a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="palq21adisp"> <?php  echo $palq21adisp; ?> </span></td>
	     <td  class="normal14" >備註：</td>
        <td  class="normal14"  ><input type="text" tabIndex="12" id="ml009"     onKeyPress="keyFunction()"    name="ml009" value="<?php echo $ml009; ?>" size="80" disabled="disabled"/></td>	  
	    
	  </tr>
    </table>
		
	  <div class="buttons">
	    <a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali25/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
