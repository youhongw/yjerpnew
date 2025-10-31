<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 付款條件資料建立作業 - 查看　　　</h1>
	   <div style="float:left;padding-top: 5px; ">
	   <a  accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi21/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cms/cmsi21/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
         <?php   $na001=$row->na001;?>
          <?php   $na002=$row->na002;?>
          <?php   $na003=$row->na003;?>
          <?php   $na004=$row->na004;?>
          <?php   $na005=$row->na005;?>
          <?php   $na006=$row->na006;?>
		  <?php   $na007=$row->na007;?>
          <?php   $na008=$row->na008;?>
          <?php   $na009=$row->na009;?>
          <?php   $na010=$row->na010;?>
		  <?php   $na011=$row->na011;?>
          <?php   $na012=$row->na012;?>
          <?php   $na013=$row->na013;?>
          <?php   $na014=$row->na014;?>
          <?php   $na015=$row->na015;?>
          <?php   $na016=$row->na016;?>
		  <?php   $na017=$row->na017;?>
          <?php   $na018=$row->na018;?>
          <?php   $na019=$row->na019;?>
	<?php  }?>
      
	<table class="form14">
	   <tr>
	    <td class="normal14y" width="12%"><span class="required">代號：</span> </td>
        <td class="normal14a" width="38%" ><input   tabIndex="1" id="na002" onKeyPress="keyFunction()" onchange="startkey(this)" name="na002" value="<?php echo $na002; ?>"  type="text" disabled="disabled" />
	     <span id="keydisp" ></span></td>
		<td class="normal14y" width="11%"><span class="required">類別：</span></td>
        <td class="normal14a" width="39%" >
		  <select  tabIndex="2" id="na001" onKeyPress="keyFunction()"  name="na001" disabled="disabled"  >
             <option <?php if($na001 == '1') echo 'selected="selected"';?> value='1'>1:採購/託外</option>                                                                        
		     <option <?php if($na001 == '2') echo 'selected="selected"';?> value='2'>2:銷售</option>
		  </select>
		  <span id="na001disp" ></span>
	    </td>
	  </tr>
	  <tr>
	    <td class="normal14z" >名稱：</td>
        <td class="normal14"  ><input  tabIndex="3" id="na003" onKeyPress="keyFunction()" name="na003"   value="<?php echo  $na003; ?>"    size="32" type="text" disabled="disabled" /></td>
	    <td  class="normal14z">預計收付款日：</td>						
        <td  class="normal14"  ><input tabIndex="4" type="radio" name="na004" <?php if (isset($na004) && $na004=="1") echo "checked";?> value="1" />加日數  &nbsp;&nbsp;&nbsp; 
          <input type="radio" tabIndex="4" name="na004" <?php if (isset($na004) && $na004=="2") echo "checked";?> value="2" />加月數</td>
	  </tr>	
	  <tr>
	    <td  class="normal14z" >結帳後：</td>
        <td  class="normal14"  ><input   tabIndex="5" id="na005" onKeyPress="keyFunction()" name="na005"  value="<?php echo $na005; ?>"    type="text" disabled="disabled" /></td>
	    <td class="normal14z">起算日：</td>						
        <td  class="normal14"  ><select  tabIndex="6" id="na019" onKeyPress="keyFunction()"  name="na019" disabled="disabled" >
             <option <?php if($na019 == '1') echo 'selected="selected"';?> value='1'>1:結帳日</option>                                                                        
		     <option <?php if($na019 == '2') echo 'selected="selected"';?> value='2'>2:次月初</option>
		  </select>
	  </tr>
	   <tr>
	    <td  class="normal14z" >結帳加：</td>
        <td  class="normal14"  ><input   tabIndex="5" id="na006" onKeyPress="keyFunction()" name="na006"  value="<?php echo $na006; ?>"     type="text" disabled="disabled" /></td>
	    <td class="normal14z">個月後逢日：</td>						
        <td  class="normal14"  ><input  tabIndex="6" id="na007" onKeyPress="keyFunction()" name="na007"   value="<?php echo $na007; ?>"   type="text" disabled="disabled" /></td>
	  </tr>
	  <tr>
	    <td class="normal14z"> 備註：</td>
        <td class="normal14" ><input  type="text" tabIndex="7" onKeyPress="keyFunction()" id="na017" name="na017" size="40" value="<?php echo $na017; ?>"  disabled="disabled" /></td>	
		<?php if($na016 == '0')  $na016="N";?> <?php if($na016 == '1')  $na016="Y";?></td>
	    <td  class="normal14z">資金實現日：</td>						
        <td  class="normal14"  ><input  type="radio" tabIndex="8" name="na008" <?php if (isset($na008) && $na008=="1") echo "checked";?> value="1" disabled="disabled" />加日數  &nbsp;&nbsp;&nbsp; 
          <input type="radio" tabIndex="9" name="na008" <?php if (isset($na008) && $na008=="2") echo "checked";?> value="2" disabled="disabled" />加月數</td>
	  </tr>	
	  <tr>
	    <td  class="normal14z" >付款後：</td>
        <td  class="normal14"  ><input  type="text"  tabIndex="10" id="na009" onKeyPress="keyFunction()" name="na009"  value="<?php echo $na009; ?>"   disabled="disabled"  /></td>
	    <td class="normal14z">起算日：</td>						
        <td  class="normal14"  ><select  tabIndex="11" id="na018" onKeyPress="keyFunction()"  name="na018" disabled="disabled" >
             <option <?php if($na018 == '1') echo 'selected="selected"';?> value='1'>1:付款日</option>                                                                        
		     <option <?php if($na018 == '2') echo 'selected="selected"';?> value='2'>2:次月初</option>
		  </select>
	  </tr>
	   <tr>
	    <td  class="normal14z" >付款加：</td>
        <td  class="normal14"  ><input   type="text"  tabIndex="12" id="na010" onKeyPress="keyFunction()" name="na010"  value="<?php echo $na010; ?>"  disabled="disabled"   /></td>
	    <td class="normal14z">個月後逢日：</td>						
        <td  class="normal14"  ><input  type="text"  tabIndex="13" id="na011" onKeyPress="keyFunction()" name="na011"   value="<?php echo $na011; ?>"   disabled="disabled"  /></td>
	  </tr>
	  <tr>
	    <td  class="normal14z">取得折扣方式：</td>						
        <td  class="normal14"  ><input  type="radio"  tabIndex="14" name="na013" <?php if (isset($na013) && $na013=="1") echo "checked";?> value="1" />提前付款  &nbsp;&nbsp;&nbsp; 
          <input type="radio" tabIndex="15" name="na013" <?php if (isset($na013) && $na013=="2") echo "checked";?> value="2" />縮短票期</td>
	     <td class="normal14z"> 提早天數：</td>
        <td class="normal14" ><input type="text"  tabIndex="15" onKeyPress="keyFunction()" id="na014" name="na014"  value="<?php echo $na014; ?>" disabled="disabled"  /></td>	
	  </tr>
       <tr>
	    <td  class="normal14z" >票期提早天兌現：</td>
        <td  class="normal14"  ><input  type="text" tabIndex="16" id="na015" onKeyPress="keyFunction()" name="na015"  value="<?php echo $na015; ?>"   disabled="disabled"   /></td>
	    <td class="normal14z">折扣％：</td>						
        <td  class="normal14"  ><input type="text" tabIndex="17" id="na016" onKeyPress="keyFunction()" name="na016"   value="<?php echo $na016; ?>"  disabled="disabled" /></td>
	  </tr>	  
	  <tr>
	    <td class="normal14z" >取得折扣：</td>
        <td class="normal14"  ><input type="hidden" name="na012" value="N" />
		<input type='checkbox' tabIndex="18" id="na012" onKeyPress="keyFunction()"  name="na012" <?php if($na012 == 'Y' ) echo 'checked';  ?>  <?php if($na012 != 'Y' ) echo 'check'; ?>  value="Y" size="1" disabled="disabled" /></td>
		<?php if($na012 == '0')  $na012="N";?> <?php if($na012 == '1')  $na012="Y";?></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
    </table>
		
	 <!-- <div class="buttons">
	    <a  accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi21/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div> -->
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