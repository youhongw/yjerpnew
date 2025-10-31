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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 請假單資料建立作業 - 查看</h1>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali54/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
         <?php   $palq01a=$row->tg001;?>
		  <?php   $palq01adisp=$row->tg001disp;?>
          <?php   $cmsq05a=$row->tg002;?>
		  <?php   $cmsq05adisp=$row->tg002disp;?>
		  
          <?php   $tg003=substr($row->tg003,0,4).'/'.substr($row->tg003,4,2).'/'.substr($row->tg003,6,2);?>
	      <?php   $tg004=$row->tg004;?>
          <?php   $tg005=$row->tg005;?>
		  <?php   $tg006=$row->tg006;?>
		  <?php   $tg007=$row->tg007;?>
		  <?php   $tg008=$row->tg008;?>
		  <?php   $tg009=$row->tg009;?>
		  <?php   $tg010=$row->tg010;?>	
          <?php   $tg011=$row->tg011;?>
          <?php   $tg012=$row->tg012;?>
          <?php   $tg013=$row->tg013;?>
		  <?php   $tg014=$row->tg014;?>
		  <?php   $tg015=$row->tg015;?>
		  <?php   $tg016=$row->tg016;?>
		  <?php   $tg017=$row->tg017;?>
		  <?php   $tg018=$row->tg018;?>	
          <?php   $tg019=$row->tg019;?>	
          <?php   $tg020=$row->tg020;?>	
          <?php   $tg021=$row->tg021;?>	
          <?php   $tg022=$row->tg022;?>			  
		  <?php   $tg023=$row->tg023;?>
		  <?php   $tg201=$row->tg201;?>
		  <?php   $tg202=$row->tg202;?>
		  <?php   $tg203=$row->tg203;?>
          <?php   $flag=$row->flag;?>	  
	<?php  }?>
      
	<table class="form14">
       <tr>
	    <td class="start14a" width="11%"><span class="required">員工代號：</span></td>
        <td class="normal14a" width="22%" ><input   tabIndex="1" id="tg001" onKeyPress="keyFunction()" onchange="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>"  type="text" required disabled="disabled"/><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="palq01adisp"> <?php    echo $palq01adisp; ?> </span></td>
	    <td class="start14a" width="11%"><span class="required">部門代號：</span></td>
        <td class="normal14a"  width="22%"> <input   tabIndex="2" id="tg002" onKeyPress="keyFunction()" onchange="startcmsq05a(this)" name="cmsq05a" value="<?php echo $cmsq05a; ?>"  type="text" required disabled="disabled"/><img id="Showcmsq05a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
         <span id="cmsq05adisp"> <?php    echo $cmsq05adisp; ?> </span></td>
       <td class="normal14a" width="11%">請假日期： </td>
        <td class="normal14" width="23%"><input  tabIndex="3" onKeyPress="keyFunction()"    id="tg003" name="tg003"  value="<?php echo $tg003; ?>"  type="text" style="background-color:#E7EFEF" disabled="disabled"/></td>
	  </tr>	
		
	  <tr>
        <td class="normal14" >遲到早退次：</td>
		<td class="normal14"><input  tabIndex="4" onKeyPress="keyFunction()"  id="tg004" name="tg004"  value="<?php echo $tg004; ?>"  type="text" disabled="disabled" /></td>	   
	   <td  class="normal14" >未刷卡補正次：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" id="tg005"     onKeyPress="keyFunction()"    name="tg005" value="<?php echo $tg005; ?>"  disabled="disabled"/></td>	  
	    <td class="normal14">事假小時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="6" id="tg006"     onKeyPress="keyFunction()"    name="tg006" value="<?php echo $tg006; ?>"  disabled="disabled"/></td>
	  </tr>
	   <tr>
	    <td  class="normal14" >病假小時：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" id="tg007"      onKeyPress="keyFunction()"    name="tg007" value="<?php echo $tg007; ?>" disabled="disabled" /></td>	  
	    <td class="normal14a">特休小時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="8" id="tg008"      onKeyPress="keyFunction()"    name="tg008" value="<?php echo $tg008; ?>"  disabled="disabled"/></td>
	    <td  class="normal14" >喪假天：</td>
        <td  class="normal14"  ><input type="text" tabIndex="9" id="tg009"     onKeyPress="keyFunction()"    name="tg009" value="<?php echo $tg009; ?>" disabled="disabled"/></td>	
	  </tr>
	   
	  <tr>
	    <td class="normal14">無薪假小時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="tg010"     onKeyPress="keyFunction()"    name="tg010" value="<?php echo $tg010; ?>"  disabled="disabled"/></td>
		<td  class="normal14" >產假天：</td>
        <td  class="normal14"  ><input type="text" tabIndex="11" id="tg011"     onKeyPress="keyFunction()"    name="tg011" value="<?php echo $tg011; ?>" disabled="disabled"/></td>	  
	    <td class="normal14" >陪產假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="12" id="tg012"     onKeyPress="keyFunction()"    name="tg012" value="<?php echo $tg012; ?>"  disabled="disabled"/></td>
	  </tr>
	   <tr>
	    <td class="normal14">產檢假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="tg201"     onKeyPress="keyFunction()"    name="tg201" value="<?php echo $tg201; ?>"  /></td>
		<td class="normal14">生理假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="tg202"     onKeyPress="keyFunction()"    name="tg202" value="<?php echo $tg202; ?>"  /></td>  
	    <td class="normal14">補休假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="tg203"     onKeyPress="keyFunction()"    name="tg203" value="<?php echo $tg203; ?>"  /></td> 
	  </tr>
	  <tr>
	    <td  class="normal14" >婚假天：</td>
        <td  class="normal14"  ><input type="text" tabIndex="13" id="tg013"     onKeyPress="keyFunction()"    name="tg013" value="<?php echo $tg013; ?>" disabled="disabled"/></td>	  
	    <td class="normal14">公偒假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="14" id="tg014"     onKeyPress="keyFunction()"    name="tg014" value="<?php echo $tg014; ?>"  disabled="disabled"/></td>
	    <td  class="normal14" >曠職天：</td>
        <td  class="normal14"  ><input type="text" tabIndex="15" id="tg015"     onKeyPress="keyFunction()"    name="tg015" value="<?php echo $tg015; ?>" disabled="disabled"/></td>	
	  </tr>	  
	   <tr>
        <td class="normal14">公假天：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="16" id="tg016"     onKeyPress="keyFunction()"    name="tg016" value="<?php echo $tg016; ?>"  disabled="disabled"/></td>	   
	    <td  class="normal14a" >平常加班時：</td>
        <td  class="normal14"  ><input type="text" tabIndex="17" id="tg017"    onKeyPress="keyFunction()"    name="tg017" value="<?php echo $tg017; ?>" disabled="disabled" /></td>	  
	    <td class="normal14">平常加班2小時上：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="18" id="tg018"    onKeyPress="keyFunction()"    name="tg018" value="<?php echo $tg018; ?>"  disabled="disabled"/></td>
	  </tr>
	  <tr>
        <td class="normal14">六加班時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="19" id="tg019"     onKeyPress="keyFunction()"    name="tg019" value="<?php echo $tg019; ?>"  disabled="disabled"/></td>	   
	    <td  class="normal14a" >六加班8小時上：</td>
        <td  class="normal14"  ><input type="text" tabIndex="20" id="tg020"    onKeyPress="keyFunction()"    name="tg020" value="<?php echo $tg020; ?>"  disabled="disabled"/></td>	  
	    <td class="normal14">假日加班時：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="21" id="tg021"    onKeyPress="keyFunction()"    name="tg021" value="<?php echo $tg021; ?>"  disabled="disabled"/></td>
	  </tr>
	   <tr>
	    <td class="normal14">假日加班8小時上：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="22" id="tg022"    onKeyPress="keyFunction()"    name="tg022" value="<?php echo $tg022; ?>"  disabled="disabled"/></td>
		<td  class="normal14" >備註：</td>
        <td  class="normal14" colspan="2" ><input type="text" tabIndex="23" id="tg023"     onKeyPress="keyFunction()"    name="tg023" value="<?php echo $tg023; ?>"  size="60" disabled="disabled"/></td>
        <td class="normal14"></td>		
        <td  class="normal14"  ></td>
	  </tr>
    </table>
		
	  <div class="buttons">
	    <a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali54/'.$this->session->userdata('pali54_search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
