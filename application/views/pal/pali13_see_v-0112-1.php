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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 獎懲紀錄維護作業 - 查看</h1>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali13/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
         <?php   $palq01a=$row->mv001;?>
		  <?php   $palq01adisp=$row->mv001disp;?>
          <?php   $cmsq05a=$row->mv002;?>
		  <?php   $cmsq05adisp=$row->mv002disp;?>
		   <?php   $palq12a=$row->mv006;?>
		  <?php   $palq12adisp=$row->mv006disp;?>
          <?php   $mv003=$row->mv003;?>
	      <?php   $mv004=$row->mv004;?>
          <?php   $mv005=$row->mv005;?>
		  <?php   $mv006=$row->mv006;?>
		  <?php   $mv007=$row->mv007;?>
		  <?php   $mv003=substr($row->mv003,0,4).'/'.substr($row->mv003,4,2).'/'.substr($row->mv003,6,2);?>
          <?php   $flag=$row->flag;?>	  
	<?php  }?>
      
	<table class="form14">
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
        <td class="normal14" ><input  tabIndex="3" onKeyPress="keyFunction()" onclick="scwShow(this,event);"  id="mv003" name="mv003"  value="<?php echo $mv003; ?>"  type="text" style="background-color:#E7EFEF" /></td>
		<td class="normal14" >說明：</td>
		<td class="normal14"><input  tabIndex="4" onKeyPress="keyFunction()"  id="mv007" name="mv007"  value="<?php echo $mv007; ?>"  type="text" size="60" /></td>	
	  </tr>
	  <tr>
	    <td class="start14a" >獎懲： </td>
        <td class="normal14" ><input  tabIndex="3" onKeyPress="keyFunction()"   id="mv004" name="mv004"  value="<?php echo $mv004; ?>"  type="text"  /></td>
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
	    <a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali13/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
