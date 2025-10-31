<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 請購資料維護作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pur/puri06/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pur/puri06/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	 <!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $tb001=$row->tb001;?>
          <?php   $tb002=$row->tb002;?>
          <?php   $tb003=$row->tb003;?>
          <?php   $tb004=$row->tb004;?>
          <?php   $tb005=$row->tb005;?>
          <?php   $tb006=$row->tb006;?>
		  <?php   $tb007=$row->tb007;?>
		  <?php   $tb008=$row->tb008;?>
		  <?php   $tb009=$row->tb009;?>
		  <?php   $tb010=$row->tb010;?>
		  <?php   $tb011=$row->tb011;?>
          <?php   $tb012=$row->tb012;?>
          <?php   $tb013=$row->tb013;?>
          <?php   $tb014=$row->tb014;?>
          <?php   $tb015=$row->tb015;?>
          <?php   $tb016=$row->tb016;?>
		  <?php   $tb017=$row->tb017;?>
		  <?php   $tb018=$row->tb018;?>
		  <?php   $tb019=substr($row->tb019,0,4).'/'.substr($row->tb019,4,2).'/'.substr($row->tb019,6,2);?>
		  <?php   $tb020=$row->tb020;?>
		  <?php   $tb021=$row->tb021;?>
          <?php   $tb022=$row->tb022;?>
          <?php   $tb023=$row->tb023;?>
          <?php   $tb024=$row->tb024;?>
          <?php   $tb025=$row->tb025;?>
          <?php   $tb026=$row->tb026;?>
		  <?php   $tb027=$row->tb027;?>
		  <?php   $tb028=$row->tb028;?>
		  <?php   $tb029=$row->tb029;?>
		  <?php   $tb030=$row->tb030;?>
		  <?php   $tb031=$row->tb031;?>
          <?php   $tb032=$row->tb032;?>
          <?php   $tb033=$row->tb033;?>
          <?php   $tb034=$row->tb034;?>
          <?php   $tb035=$row->tb035;?>
          <?php   $tb036=$row->tb036;?>
		  <?php   $tb037=$row->tb037;?>
		  <?php   $tb038=$row->tb038;?>
		  <?php   $tb039=$row->tb039;?>
          <?php   $flag=$row->flag;?>	
		  
          <?php   $tb999=$row->tb001."-".$row->tb002."-".$row->tb003;?>		
          
		  <?php   $cmsq03a=$row->tb008;?> 
		  <?php   $cmsq03adisp=$row->tb008disp;?>   <!-- 交貨庫別 --> 
          <?php   $purq01a=$row->tb010;?> 
		  <?php   $purq01adisp=$row->tb010disp;?>   <!-- 供應商名稱 --> 
		  <?php   $cmsq09a4=$row->tb013;?> 
		  <?php   $cmsq09a4disp=$row->tb013disp;?>   <!-- 採購人員 --> 
		  <?php   $cmsq06a=$row->tb016;?> 
		  <?php   $cmsq06adisp=$row->tb016disp;?>   <!-- 採購幣別 --> 
		  
		  <?php   $ta013=substr($row->ta013,0,4).'/'.substr($row->ta013,4,2).'/'.substr($row->ta013,6,2);?>
		  <?php   $ta003=substr($row->ta003,0,4).'/'.substr($row->ta003,4,2).'/'.substr($row->ta003,6,2);?>
		  <?php   $mb039=$row->mb039;?>
	<?php  }?>
      
	<table class="form14">
	    <tr>
	    <td align="left" class="normal14y" width="8%"><span class="required">請購單號： </span> </td>
        <td align="left" class="normal14a" width="42%"><input tabIndex="1" id="tb999" onKeyPress="keyFunction()" type="text" name="tb999"  value="<?php echo $tb999; ?>"  size="30"   disabled="disabled" /></td>
	    <td align="left"  class="normal14y" width="8%">採購人員：</td>
        <td align="left" class="normal14a" width="42%"><input tabIndex="48" id="tb013" onKeyPress="keyFunction()" onchange="startcmsq09a4(this)" name="cmsq09a4" value="<?php echo $cmsq09a4; ?>" size="10" type="text" disabled="disabled" /><img id="Showcmsq09a4" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
	    <span id="cmsq09a4disp"> <?php   echo $cmsq09a4disp; ?> </span></td>
	  </tr>
	  <tr>
	    <td align="left" class="normal14z">品號：</td>
        <td align="left" class="normal14"><input tabIndex="3" id="tb004" onKeyPress="keyFunction()"  type="text" name="tb004"  size="30"   value="<?php echo $tb004; ?>"  disabled="disabled" /></td>
	    <td align="left" class="normal14z">供應廠商：</td>
        <td align="left" class="normal14"><input tabIndex="14" id="tb010" onKeyPress="keyFunction()" name="purq01a" onchange="startpurq01a(this)"   value="<?php echo  $purq01a; ?>"    size="10" type="text" disabled="disabled" /><img id="Showpurq01a" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
         <span id="purq01adisp"> <?php    echo $purq01adisp; ?> </span></td>
	  </tr>
	  <tr>
	    <td align="left" class="normal14z">品名：</td>
        <td align="left" class="normal14"><input tabIndex="5" id="tb005" onKeyPress="keyFunction()"  type="text" name="tb005"  size="30"   value="<?php echo $tb005; ?>"  disabled="disabled" /></td>
	    <td align="left" class="normal14z">交貨庫別：</td>
        <td align="left" class="normal14"><input tabIndex="14" id="tb008" onKeyPress="keyFunction()" name="cmsq03a" onchange="startcmsq03a(this)"   value="<?php echo  $cmsq03a; ?>"    size="10" type="text" disabled="disabled" /><img id="Showcmsq03a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
         <span id="cmsq03adisp"> <?php    echo $cmsq03adisp; ?> </span></td>
	  </tr>
	   <tr>
	    <td align="left" class="normal14z">規格：</td>
        <td align="left" class="normal14"><input tabIndex="7" id="tb006" onKeyPress="keyFunction()"  type="text" name="tb006"  size="30"   value="<?php echo $tb006; ?>" disabled="disabled"  /></td>
	    <td align="left" class="normal14z">採購數量：</td>
        <td align="left" class="normal14"><input tabIndex="8" id="tb014" onKeyPress="keyFunction()"  type="text" name="tb014"   value="<?php echo $tb014; ?>"  disabled="disabled" /></td>
	  </tr>
	    <tr>
	    <td align="left" class="normal14z">單據日期：</td>
        <td align="left" class="normal14"><input tabIndex="9" id="ta013" onKeyPress="keyFunction()"  type="text" name="ta013"    value="<?php echo $ta013; ?>" disabled="disabled"  /></td>
	    <td align="left" class="normal14z">採購單位：</td>
        <td align="left" class="normal14"><input tabIndex="10" id="tb015" onKeyPress="keyFunction()"  type="text" name="tb015"   value="<?php echo $tb015; ?>"  disabled="disabled" /></td>
	  </tr>
	     <tr>
	    <td align="left" class="normal14z">請購日期：</td>
        <td align="left" class="normal14"><input tabIndex="11" id="ta003" onKeyPress="keyFunction()"  type="text" name="ta003"    value="<?php echo $ta003; ?>" disabled="disabled"  /></td>
	    <td align="left" class="normal14z">小單位：</td>
        <td align="left" class="normal14"><input tabIndex="12" id="tb028" onKeyPress="keyFunction()"  type="text" name="tb028"   value="<?php echo $tb028; ?>"  disabled="disabled" /></td>
	  </tr>
	     <tr>
	    <td align="left" class="normal14z">請購數量：</td>
        <td align="left" class="normal14"><input tabIndex="13" id="tb009" onKeyPress="keyFunction()"  type="text" name="tb009"    value="<?php echo $tb009; ?>" disabled="disabled"  /></td>
	    <td align="left" class="normal14z">課稅別：</td>
        <td align="left" class="normal14"><select tabIndex="14"  id="tb026" onKeyPress="keyFunction()" name="tb026" readonly="readonly" disabled="disabled" >
           	  <option <?php if($tb026 == '1') echo 'selected="selected"';?> value='1'>1.應稅內含</option>                                                                        
		      <option <?php if($tb026 == '2') echo 'selected="selected"';?> value='2'>2.應稅外加</option>
              <option <?php if($tb026 == '3') echo 'selected="selected"';?> value='3'>3.零稅率</option>
              <option <?php if($tb026 == '4') echo 'selected="selected"';?> value='4'>4.免稅</option>
			  <option <?php if($tb026 == '9') echo 'selected="selected"';?> value='9'>9.不計稅</option>
		  </select></td>
	  </tr>
	     <tr>
	    <td align="left" class="normal14z">請購單位：</td>
        <td align="left" class="normal14"><input tabIndex="15" id="tb007" onKeyPress="keyFunction()"  type="text" name="tb007"    value="<?php echo $tb007; ?>" disabled="disabled"  /></td>
	    <td align="left" class="normal14z">採購幣別：</td>
        <td align="left" class="normal14"><input tabIndex="16" id="tb016" onKeyPress="keyFunction()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text" disabled="disabled"  /><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
           <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span></td>
	  </tr>
	  <tr>
	    <td align="left" class="normal14z">小單位：</td>
        <td align="left" class="normal14"><input tabIndex="17" id="tb011" onKeyPress="keyFunction()"  type="text" name="tb011"    value="<?php echo $tb011; ?>"  disabled="disabled" /></td>
	    <td align="left" class="normal14z">採購單價：</td>
        <td align="left" class="normal14"><input tabIndex="18" id="tb017" onKeyPress="keyFunction()"  type="text" name="tb017"   value="<?php echo $tb017; ?>"  disabled="disabled" /></td>
	  </tr>
	   <tr>
	    <td align="left" class="normal14z">需求日期：</td>
        <td align="left" class="normal14"><input tabIndex="19" id="tb027" onKeyPress="keyFunction()"  type="text" name="tb027"    value="<?php echo $tb027; ?>" disabled="disabled"  /></td>
	    <td align="left" class="normal14z">採購金額：</td>
        <td align="left" class="normal14"><input tabIndex="20" id="tb018" onKeyPress="keyFunction()"  type="text" name="tb018"   value="<?php echo $tb018; ?>" disabled="disabled"  /></td>
	  </tr>
	   <tr>
	    <td align="left" class="normal14z">請購備註：</td>
        <td align="left" class="normal14"><input tabIndex="21" id="tb012" onKeyPress="keyFunction()"  type="text" name="tb012" size="30"    value="<?php echo $tb012; ?>"  disabled="disabled" /></td>
	    <td align="left" class="normal14z">交貨日：</td>
        <td align="left" class="normal14"><input tabIndex="22" id="tb019" onfocus="scwShow(this,event);" onclick="scwShow(this,event);" onKeyPress="keyFunction()"  type="text" name="tb019"   value="<?php echo $tb019; ?>" disabled="disabled"  /></td>
	  </tr>
	   <tr>
	    <td align="left" class="normal14z">最低補量：</td>
        <td align="left" class="normal14"><input tabIndex="23" id="mb039" onKeyPress="keyFunction()"  type="text" name="mb039"  size="30"   value="<?php echo $mb039; ?>" disabled="disabled"  /></td>
	    <td align="left" class="normal14z">急料：</td>
        <td align="left" class="normal14"><input type="hidden" name="tb032" value="N" disabled="disabled" />
		<input type="checkbox" tabIndex="24" id="tb032" onKeyPress="keyFunction()" name="tb032" <?php if($tb032 == 'Y' ) echo 'checked'; ?>  <?php if($tb032 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	  </tr>
	  <tr>
	    <td align="left" class="normal14z">採購備註：</td>
        <td align="left" class="normal14"><input tabIndex="25" id="tb024" onKeyPress="keyFunction()"  type="text" name="tb024"  size="30"   value="<?php echo $tb024; ?>" disabled="disabled"  /></td>
	    <td align="left" class="normal14z">鎖定碼：</td>
        <td align="left" class="normal14"><input type="hidden" name="tb020" value="N" disabled="disabled" />
		<input type="checkbox" tabIndex="26" id="tb020" onKeyPress="keyFunction()" name="tb020" <?php if($tb020 == 'Y' ) echo 'checked'; ?>  <?php if($tb020 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	  </tr>
	  <tr>
	    <td align="left" class="normal14z">採購碼：</td>
        <td align="left" class="normal14"><input type="hidden" name="tb021" value="N" disabled="disabled" />
		<input type="checkbox" tabIndex="27" id="tb021" onKeyPress="keyFunction()" name="tb021" <?php if($tb021 == 'Y' ) echo 'checked'; ?>  <?php if($tb021 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	    <td align="left" class="normal14z">結案碼：</td>
        <td align="left" class="normal14"><select tabIndex="28"  id="tb039" onKeyPress="keyFunction()" name="tb039" readonly="readonly" disabled="disabled" >
           	  <option <?php if($tb039 == 'Y') echo 'selected="selected"';?> value='Y'>Y:自動結案 </option>                                                                        
		      <option <?php if($tb039 == 'y') echo 'selected="selected"';?> value='y'>y:指定結案 </option>
              <option <?php if($tb039 == 'N') echo 'selected="selected"';?> value='N'>N:未結案</option>
		  </select></td>
	  </tr>
	  <tr>
	    <td align="left" class="normal14z">採購單號：</td>
        <td align="left" class="normal14"><input tabIndex="29" id="tb022" onKeyPress="keyFunction()"  type="text" name="tb022"    value="<?php echo $tb022; ?>"  disabled="disabled" /></td>
	    <td align="left" class="normal14z">製造商：</td>
        <td align="left" class="normal14"><input tabIndex="30" id="tb023" onKeyPress="keyFunction()"  type="text" name="tb023"   value="<?php echo $tb023; ?>" disabled="disabled" /></td>
	  </tr>
	  <tr>
	    <td align="left" class="normal14z">承認型號：</td>
        <td align="left" class="normal14"><input tabIndex="31" id="tb033" onKeyPress="keyFunction()"  type="text" name="tb033"    value="<?php echo $tb033; ?>" disabled="disabled"  /></td>
	    <td align="left" class="normal14"></td>
        <td align="left" class="normal14"></td>
	  </tr>
	 
    </table>
		
	  <input type='hidden' name='tb001' id='tb001' value="<?php echo $tb001; ?>" />
	  <input type='hidden' name='tb002' id='tb002' value="<?php echo $tb002; ?>" />
	  <input type='hidden' name='tb003' id='tb003' value="<?php echo $tb003; ?>" />
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
		
	<!--  <div class="buttons">
	    <a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pur/puri06/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>-->
        </form>
		<?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>
 
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

     </div> <!-- div-3 -->
 </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php  include_once("./application/views/funnew/fun_disabled_v.php"); ?> 