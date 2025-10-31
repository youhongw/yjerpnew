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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 薪資明細查詢作業 - 查看</h1>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/palq41/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
         <?php   $palq01a=$row->td001;?>
		  <?php   $palq01adisp=$row->td001disp;?>
          <?php   $cmsq05a=$row->td003;?>
		  <?php   $cmsq05adisp=$row->td002disp;?>
		  
          <?php   $td005=substr($row->td005,0,4).'/'.substr($row->td005,4,2);?>
	      <?php   $td004=$row->td004;?>
          <?php  // $td005=$row->td005;?>
		  <?php   $td006=$row->td006;?>
		  <?php   $td007=$row->td007;?>
		  <?php   $td008=$row->td008;?>
		  <?php   $td009=$row->td009;?>
		  <?php   $td010=$row->td010;?>	
          <?php   $td011=$row->td011;?>
          <?php   $td012=$row->td012;?>
          <?php   $td013=$row->td013;?>
		  <?php   $td014=$row->td014;?>
		  <?php   $td015=$row->td015;?>
		  <?php   $td016=$row->td016;?>
		  <?php   $td017=$row->td017;?>
		  <?php   $td018=$row->td018;?>	
          <?php   $td019=$row->td019;?>	
          <?php   $td020=$row->td020;?>	
          <?php   $td021=$row->td021;?>	
          <?php   $td022=$row->td022;?>			  
		  <?php   $td023=$row->td023;?>
		  <?php   $td024=$row->td024;?>
		  <?php   $td025=$row->td025;?>
		  <?php   $td026=$row->td026;?>
		  <?php   $td027=$row->td027;?>
		  <?php   $td028=$row->td028;?>	
          <?php   $td029=$row->td029;?>	
          <?php   $td030=$row->td030;?>	
          <?php   $td031=$row->td031;?>	
          <?php   $td032=$row->td032;?>			  
		  <?php   $td033=$row->td033;?>
		   <?php   $td034=$row->td034;?>
		  <?php   $td035=$row->td035;?>
		  <?php   $td036=$row->td036;?>
		  <?php   $td037=$row->td037;?>
		  <?php   $td038=$row->td038;?>	
          <?php   $td039=$row->td039;?>	
          <?php   $td040=$row->td040;?>	
          <?php   $td041=$row->td041;?>	
          <?php   $td042=$row->td042;?>			  
		  <?php   $td043=$row->td043;?>
		  <?php   $td044=$row->td044;?>
		  <?php   $td045=$row->td045;?>
		  <?php   $td046=$row->td046;?>
		  <?php   $td047=$row->td047;?>
		  <?php   $td048=$row->td048;?>	
          <?php   $td049=$row->td049;?>	
          <?php   $td050=$row->td050;?>	
          <?php   $td051=$row->td051;?>	
          <?php   $td052=$row->td052;?>			  
		  <?php   $td053=$row->td053;?>
		 
          <?php   $flag=$row->flag;?>	  
	<?php  }?>
      
	<table class="form14">
       <tr>
	    <td class="start14a" width="11%"><span class="required">員工代號：</span></td>
        <td class="normal14a" width="22%" ><input   tabIndex="1" id="td001" onKeyPress="keyFunction()" onchange="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>"  type="text" required disabled="disabled"/><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="palq01adisp"> <?php    echo $palq01adisp; ?> </span></td>
	    <td class="start14a" width="11%"><span class="required">部門代號：</span></td>
        <td class="normal14a"  width="22%"> <input   tabIndex="2" id="td003" onKeyPress="keyFunction()" onchange="startcmsq05a(this)" name="cmsq05a" value="<?php echo $cmsq05a; ?>"  type="text" required disabled="disabled"/><img id="Showcmsq05a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
         <span id="cmsq05adisp"> <?php    echo $cmsq05adisp; ?> </span></td>
       <td class="normal14a" width="11%">發薪年月： </td>
        <td class="normal14" width="23%"><input  tabIndex="3" onKeyPress="keyFunction()"    id="td005" name="td005"  value="<?php echo $td005; ?>"  type="text" style="background-color:#E7EFEF" disabled="disabled"/></td>
	  </tr>	
		
	  <tr>
        <td class="normal14" >天數：</td>
		<td class="normal14"><input  tabIndex="4" onKeyPress="keyFunction()"  id="td006" name="td006"  value="<?php echo $td006 ?>"  type="text" disabled="disabled" /></td>	   
	   <td  class="normal14" >日薪：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" id="td007"     onKeyPress="keyFunction()"    name="td007" value="<?php echo $td007; ?>"  disabled="disabled"/></td>	  
	    <td class="normal14">本薪：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="6" id="td008"     onKeyPress="keyFunction()"    name="td008" value="<?php echo $td008; ?>"  disabled="disabled"/></td>
	  </tr>
	   <tr>
	    <td  class="normal14" >職務津貼：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" id="td009"      onKeyPress="keyFunction()"    name="td009" value="<?php echo $td009; ?>" disabled="disabled" /></td>	  
	    <td class="normal14a">主管津貼：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="8" id="td010"      onKeyPress="keyFunction()"    name="td010" value="<?php echo $td010; ?>"  disabled="disabled"/></td>
	    <td  class="normal14" >伙食津貼：</td>
        <td  class="normal14"  ><input type="text" tabIndex="9" id="td011"     onKeyPress="keyFunction()"    name="td011" value="<?php echo $td011; ?>" disabled="disabled"/></td>	
	  </tr>
	   
	  <tr>
	    <td class="normal14">全勤獎金：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="td012"     onKeyPress="keyFunction()"    name="td012" value="<?php echo $td012; ?>"  disabled="disabled"/></td>
		<td  class="normal14" >特別津貼：</td>
        <td  class="normal14"  ><input type="text" tabIndex="11" id="td013"     onKeyPress="keyFunction()"    name="td013" value="<?php echo $td013; ?>" disabled="disabled"/></td>	  
	    <td class="normal14" >業務津貼：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="12" id="td014"     onKeyPress="keyFunction()"    name="td014" value="<?php echo $td014; ?>"  disabled="disabled"/></td>
	  </tr>
	  <tr>
	    <td  class="normal14" >執照津貼：</td>
        <td  class="normal14"  ><input type="text" tabIndex="13" id="td015"     onKeyPress="keyFunction()"    name="td015" value="<?php echo $td015; ?>" disabled="disabled"/></td>	  
	    <td class="normal14">資歷津貼：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="14" id="td016"     onKeyPress="keyFunction()"    name="td016" value="<?php echo $td016; ?>"  disabled="disabled"/></td>
	    <td  class="normal14" >平時加班2內：</td>
        <td  class="normal14"  ><input type="text" tabIndex="15" id="td017"     onKeyPress="keyFunction()"    name="td017" value="<?php echo $td017; ?>" disabled="disabled"/></td>	
	  </tr>	  
	   <tr>
        <td class="normal14">平時加班2內費：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="16" id="td018"     onKeyPress="keyFunction()"    name="td018" value="<?php echo $td018; ?>"  disabled="disabled"/></td>	   
	    <td  class="normal14a" >平時加班2外：</td>
        <td  class="normal14"  ><input type="text" tabIndex="17" id="td019"    onKeyPress="keyFunction()"    name="td019" value="<?php echo $td019; ?>" disabled="disabled" /></td>	  
	    <td class="normal14">平時加班2外費：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="18" id="td020"    onKeyPress="keyFunction()"    name="td020" value="<?php echo $td020; ?>"  disabled="disabled"/></td>
	  </tr>
	  <tr>
        <td class="normal14">六加班時8內：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="19" id="td021"     onKeyPress="keyFunction()"    name="td021" value="<?php echo $td021; ?>"  disabled="disabled"/></td>	   
	    <td  class="normal14a" >六加班時8內費：</td>
        <td  class="normal14"  ><input type="text" tabIndex="20" id="td022"    onKeyPress="keyFunction()"    name="td022" value="<?php echo $td022; ?>"  disabled="disabled"/></td>	  
	    <td class="normal14">六加班時8外：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="21" id="td023"    onKeyPress="keyFunction()"    name="td023" value="<?php echo $td023; ?>"  disabled="disabled"/></td>
	  </tr>
	  <tr>
        <td class="normal14">六加班時8外費：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="19" id="td024"     onKeyPress="keyFunction()"    name="td024" value="<?php echo $td024; ?>"  disabled="disabled"/></td>	   
	    <td  class="normal14a" >國日加班時8內：</td>
        <td  class="normal14"  ><input type="text" tabIndex="20" id="td025"    onKeyPress="keyFunction()"    name="td025" value="<?php echo $td025; ?>"  disabled="disabled"/></td>	  
	    <td class="normal14">國日加班時8內費：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="21" id="td026"    onKeyPress="keyFunction()"    name="td026" value="<?php echo $td026; ?>"  disabled="disabled"/></td>
	  </tr>
	  <tr>
        <td class="normal14">國日加班時8外：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="19" id="td027"     onKeyPress="keyFunction()"    name="td027" value="<?php echo $td027; ?>"  disabled="disabled"/></td>	   
	    <td  class="normal14a" >國日加班時8外費：</td>
        <td  class="normal14"  ><input type="text" tabIndex="20" id="td028"    onKeyPress="keyFunction()"    name="td028" value="<?php echo $td028; ?>"  disabled="disabled"/></td>	  
	    <td class="normal14">其他加項：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="21" id="td029"    onKeyPress="keyFunction()"    name="td029" value="<?php echo $td029; ?>"  disabled="disabled"/></td>
	  </tr>
	  <tr>
        <td class="normal14">應領薪資：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="19" id="td030"     onKeyPress="keyFunction()"    name="td030" value="<?php echo $td030; ?>"  disabled="disabled"/></td>	   
	    <td  class="normal14a" >借支：</td>
        <td  class="normal14"  ><input type="text" tabIndex="20" id="td031"    onKeyPress="keyFunction()"    name="td031" value="<?php echo $td031; ?>"  disabled="disabled"/></td>	  
	    <td class="normal14">請假扣款：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="21" id="td032"    onKeyPress="keyFunction()"    name="td032" value="<?php echo $td032; ?>"  disabled="disabled"/></td>
	  </tr>
	  <tr>
        <td class="normal14">勞保費：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="19" id="td033"     onKeyPress="keyFunction()"    name="td033" value="<?php echo $td033; ?>"  disabled="disabled"/></td>	   
	    <td  class="normal14a" >健保費：</td>
        <td  class="normal14"  ><input type="text" tabIndex="20" id="td034"    onKeyPress="keyFunction()"    name="td034" value="<?php echo $td034; ?>"  disabled="disabled"/></td>	  
	    <td class="normal14">個人代扣：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="21" id="td035"    onKeyPress="keyFunction()"    name="td035" value="<?php echo $td035; ?>"  disabled="disabled"/></td>
	  </tr>
	  <tr>
        <td class="normal14">伙食費：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="19" id="td036"     onKeyPress="keyFunction()"    name="td036" value="<?php echo $td036; ?>"  disabled="disabled"/></td>	   
	    <td  class="normal14a" >所得稅：</td>
        <td  class="normal14"  ><input type="text" tabIndex="20" id="td037"    onKeyPress="keyFunction()"    name="td037" value="<?php echo $td037; ?>"  disabled="disabled"/></td>	  
	    <td class="normal14">其他減項：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="21" id="td038"    onKeyPress="keyFunction()"    name="td038" value="<?php echo $td038; ?>"  disabled="disabled"/></td>
	  </tr>
	  <tr>
        <td class="normal14">實領薪資：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="19" id="td039"     onKeyPress="keyFunction()"    name="td039" value="<?php echo $td039; ?>"  disabled="disabled"/></td>	   
	    <td  class="normal14a" >轉帳金額：</td>
        <td  class="normal14"  ><input type="text" tabIndex="20" id="td040"    onKeyPress="keyFunction()"    name="td040" value="<?php echo $td040; ?>"  disabled="disabled"/></td>	  
	    <td class="normal14">支領現金：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="21" id="td041"    onKeyPress="keyFunction()"    name="td041" value="<?php echo $td041; ?>"  disabled="disabled"/></td>
	  </tr>
	  <tr>
        <td class="normal14">免稅加班時數：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="19" id="td043"     onKeyPress="keyFunction()"    name="td043" value="<?php echo $td043; ?>"  disabled="disabled"/></td>	   
	    <td  class="normal14a" >免稅加班費：</td>
        <td  class="normal14"  ><input type="text" tabIndex="20" id="td044"    onKeyPress="keyFunction()"    name="td044" value="<?php echo $td044; ?>"  disabled="disabled"/></td>	  
	    <td class="normal14">應稅加班時數：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="21" id="td045"    onKeyPress="keyFunction()"    name="td045" value="<?php echo $td045; ?>"  disabled="disabled"/></td>
	  </tr>
	  <tr>
        <td class="normal14">應稅加班費：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="19" id="td046"     onKeyPress="keyFunction()"    name="td046" value="<?php echo $td046; ?>"  disabled="disabled"/></td>	   
	    <td  class="normal14a" >應稅所得：</td>
        <td  class="normal14"  ><input type="text" tabIndex="20" id="td047"    onKeyPress="keyFunction()"    name="td047" value="<?php echo $td047; ?>"  disabled="disabled"/></td>	  
	    <td class="normal14">到職日：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="21" id="td051"    onKeyPress="keyFunction()"    name="td051" value="<?php echo $td051; ?>"  disabled="disabled"/></td>
	  </tr>
	   <tr>
	    <td class="normal14">離職日：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="22" id="td052"    onKeyPress="keyFunction()"    name="td052" value="<?php echo $td052; ?>"  disabled="disabled"/></td>
		<td  class="normal14" >備註：</td>
        <td  class="normal14" colspan="2" ><input type="text" tabIndex="23" id="td042"     onKeyPress="keyFunction()"    name="td042" value="<?php echo $td042; ?>"  size="60" disabled="disabled"/></td>
        <td class="normal14"></td>		
        <td  class="normal14"  ></td>
	  </tr>
    </table>
		
	  <div class="buttons">
	    <a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/palq41/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
