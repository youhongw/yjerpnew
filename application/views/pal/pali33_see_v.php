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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 出勤資料建立作業 - 查看</h1>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali33/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
         <?php   $palq01a=$row->tc001;?>
		  <?php   $palq01adisp=$row->tc001disp;?>
          <?php   $cmsq05a=$row->tc002;?>
		  <?php   $cmsq05adisp=$row->tc002disp;?>
		  
          <?php   $tc003=substr($row->tc003,0,4).'/'.substr($row->tc003,4,2);?>
	      <?php   $tc004=$row->tc004;?>
          <?php   $tc005=$row->tc005;?>
		  <?php   $tc006=$row->tc006;?>
		  <?php   $tc007=$row->tc007;?>
		  <?php   $tc008=$row->tc008;?>
		  <?php   $tc009=$row->tc009;?>
		  <?php   $tc010=$row->tc010;?>	
          <?php   $tc011=$row->tc011;?>
          <?php   $tc012=$row->tc012;?>
          <?php   $tc013=$row->tc013;?>
		  <?php   $tc014=$row->tc014;?>
		  <?php   $tc015=$row->tc015;?>
		  <?php   $tc016=$row->tc016;?>
		  <?php   $tc017=$row->tc017;?>
		  <?php   $tc018=$row->tc018;?>	
          <?php   $tc019=$row->tc019;?>	
          <?php   $tc020=$row->tc020;?>	
          <?php   $tc021=$row->tc021;?>	
          <?php   $tc022=$row->tc022;?>			  
		  <?php   $tc023=$row->tc023;?>
		 <?php   $tc201=$row->tc201;?>
		 <?php   $tc202=$row->tc202;?>
		  <?php   $tc203=$row->tc203;?>
          <?php   $flag=$row->flag;?>	  
	<?php  }?>
      
	<table class="form14">
       <tr>
	    <td class="start14a" width="11%"><span class="required">員工代號：</span></td>
        <td class="normal14a" width="22%" ><input   tabIndex="1" id="tc001" onKeyPress="keyFunction()" onchange="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>"  type="text" required disabled="disabled"/><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="palq01adisp"> <?php    echo $palq01adisp; ?> </span></td>
	    <td class="start14a" width="11%"><span class="required">部門代號：</span></td>
        <td class="normal14a"  width="22%"> <input   tabIndex="2" id="tc002" onKeyPress="keyFunction()" onchange="startcmsq05a(this)" name="cmsq05a" value="<?php echo $cmsq05a; ?>"  type="text" required disabled="disabled"/><img id="Showcmsq05a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
         <span id="cmsq05adisp"> <?php    echo $cmsq05adisp; ?> </span></td>
       <td class="normal14a" width="11%">發薪年月： </td>
        <td class="normal14" width="23%"><input  tabIndex="3" onKeyPress="keyFunction()"    id="tc003" name="tc003"  value="<?php echo $tc003; ?>"  type="text" style="background-color:#E7EFEF" disabled="disabled"/></td>
	  </tr>	
		
	  <tr>
        <td class="normal14" >遲到早退次：</td>
		<td class="normal14"><input  tabIndex="4" onKeyPress="keyFunction()"  id="tc004" name="tc004"  value="<?php echo $tc004; ?>"  type="text" disabled="disabled" /></td>	   
	   <td  class="normal14" >未刷卡補正次：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" id="tc005"     onKeyPress="keyFunction()"    name="tc005" value="<?php echo $tc005; ?>"  disabled="disabled"/></td>	  
	    <td class="normal14">事假小時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="6" id="tc006"     onKeyPress="keyFunction()"    name="tc006" value="<?php echo $tc006; ?>"  disabled="disabled"/></td>
	  </tr>
	   <tr>
	    <td  class="normal14" >病假小時：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" id="tc007"      onKeyPress="keyFunction()"    name="tc007" value="<?php echo $tc007; ?>" disabled="disabled" /></td>	  
	    <td class="normal14a">特休小時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="8" id="tc008"      onKeyPress="keyFunction()"    name="tc008" value="<?php echo $tc008; ?>"  disabled="disabled"/></td>
	    <td  class="normal14" >喪假天：</td>
        <td  class="normal14"  ><input type="text" tabIndex="9" id="tc009"     onKeyPress="keyFunction()"    name="tc009" value="<?php echo $tc009; ?>" disabled="disabled"/></td>	
	  </tr>
	   
	  <tr>
	    <td class="normal14">無薪假小時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="tc010"     onKeyPress="keyFunction()"    name="tc010" value="<?php echo $tc010; ?>"  disabled="disabled"/></td>
		<td  class="normal14" >產假天：</td>
        <td  class="normal14"  ><input type="text" tabIndex="11" id="tc011"     onKeyPress="keyFunction()"    name="tc011" value="<?php echo $tc011; ?>" disabled="disabled"/></td>	  
	    <td class="normal14" >陪產假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="12" id="tc012"     onKeyPress="keyFunction()"    name="tc012" value="<?php echo $tc012; ?>"  disabled="disabled"/></td>
	  </tr>
	  <tr>
	    <td class="normal14">產檢假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="tc201"     onKeyPress="keyFunction()"    name="tc201" value="<?php echo $tc201; ?>"  /></td>
		<td class="normal14">生理假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="tc202"     onKeyPress="keyFunction()"    name="tc202" value="<?php echo $tc202; ?>"  /></td>  
	    <td class="normal14">補休假時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="tc203"     onKeyPress="keyFunction()"    name="tc203" value="<?php echo $tc203; ?>"  /></td> 
	  </tr>
	  <tr>
	    <td  class="normal14" >婚假天：</td>
        <td  class="normal14"  ><input type="text" tabIndex="13" id="tc013"     onKeyPress="keyFunction()"    name="tc013" value="<?php echo $tc013; ?>" disabled="disabled"/></td>	  
	    <td class="normal14">公偒假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="14" id="tc014"     onKeyPress="keyFunction()"    name="tc014" value="<?php echo $tc014; ?>"  disabled="disabled"/></td>
	    <td  class="normal14" >曠職天：</td>
        <td  class="normal14"  ><input type="text" tabIndex="15" id="tc015"     onKeyPress="keyFunction()"    name="tc015" value="<?php echo $tc015; ?>" disabled="disabled"/></td>	
	  </tr>	  
	   <tr>
        <td class="normal14">公假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="16" id="tc016"     onKeyPress="keyFunction()"    name="tc016" value="<?php echo $tc016; ?>"  disabled="disabled"/></td>	   
	    <td  class="normal14a" >平常加班時：</td>
        <td  class="normal14"  ><input type="text" tabIndex="17" id="tc017"    onKeyPress="keyFunction()"    name="tc017" value="<?php echo $tc017; ?>" disabled="disabled" /></td>	  
	    <td class="normal14">平常加班2小時上：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="18" id="tc018"    onKeyPress="keyFunction()"    name="tc018" value="<?php echo $tc018; ?>"  disabled="disabled"/></td>
	  </tr>
	  <tr>
        <td class="normal14">六加班時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="19" id="tc019"     onKeyPress="keyFunction()"    name="tc019" value="<?php echo $tc019; ?>"  disabled="disabled"/></td>	   
	    <td  class="normal14a" >六加班8小時上：</td>
        <td  class="normal14"  ><input type="text" tabIndex="20" id="tc020"    onKeyPress="keyFunction()"    name="tc020" value="<?php echo $tc020; ?>"  disabled="disabled"/></td>	  
	    <td class="normal14">國日加班時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="21" id="tc021"    onKeyPress="keyFunction()"    name="tc021" value="<?php echo $tc021; ?>"  disabled="disabled"/></td>
	  </tr>
	   <tr>
	    <td class="normal14">國日加班8小時上：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="22" id="tc022"    onKeyPress="keyFunction()"    name="tc022" value="<?php echo $tc022; ?>"  disabled="disabled"/></td>
		<td  class="normal14" >備註：</td>
        <td  class="normal14" colspan="2" ><input type="text" tabIndex="23" id="tc023"     onKeyPress="keyFunction()"    name="tc023" value="<?php echo $tc023; ?>"  size="60" disabled="disabled"/></td>
        <td class="normal14"></td>		
        <td  class="normal14"  ></td>
	  </tr>
    </table>
		
	  <div class="buttons">
	    <a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali33/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
