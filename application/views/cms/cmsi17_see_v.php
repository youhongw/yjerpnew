<div id="container">  <!-- div-1 -->
  <div id="header">   <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	  </div>-->
	  <?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content">  <!-- div-3 -->
 <div class="box">  <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 註記簽核資料建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a  accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi17/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cms/cmsi17/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content">  <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general">  <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $ms001=$row->ms001;?>
          <?php   $ms002=$row->ms002;?>
          <?php   $ms003=$row->ms003;?>
		  <?php   $ms004=$row->ms004;?>
		  <?php   $ms005=$row->ms005;?>
		  <?php   $ms006=$row->ms006;?>
          <?php   $flag=$row->flag;?>	  
        
	<?php  }?>
      
	<table class="form14">
         
	   <tr>
	    <td class="normal14y" width="11%"><span class="required">代號：</span> </td>
        <td class="normal14a"  width="89%"><input  tabIndex="1" id="ms002" readonly="value" onKeyPress="keyFunction()" onchange="startkey(this)" name="ms002" value="<?php echo $ms002; ?>" type="text" required disabled="disabled"/>
	        <span id="keydisp" ></span></td>
		
	  </tr>
	  <tr>
	    <td class="normal14z" >註記簽核類別：</td>
		<td class="normal14"  ><select  tabIndex="2" id="ms001" onKeyPress="keyFunction()" readonly="value"  name="ms001" disabled="disabled" >
             <option <?php if($ms001 == '1') echo 'selected="selected"';?> value='1'>1:註記</option>                                                                        
		     <option <?php if($ms001 == '2') echo 'selected="selected"';?> value='2'>2:簽核</option>
		  </select></td>
		
	  </tr>
	   <tr>
	    <td class="normal14z" >名稱：</td>
		<td class="normal14"  ><input type="text" tabIndex="3" id="ms003" onKeyPress="keyFunction()" name="ms003"   value="<?php echo  $ms003; ?>"  disabled="disabled" /></td>
		
	  </tr>
	  <tr>
	    <td class="normal14z" >註記簽核1：</td>
		<td class="normal14"  ><input type="text" tabIndex="4" id="ms004" onKeyPress="keyFunction()" name="ms004" size="130"  value="<?php echo  $ms004; ?>"  disabled="disabled" /></td>
		
	  </tr>
	  <tr>
	    <td class="normal14z" >註記簽核2：</td>
		<td class="normal14"  ><input type="text" tabIndex="5" id="ms005" onKeyPress="keyFunction()" name="ms005"  size="130" value="<?php echo  $ms005; ?>"  disabled="disabled" /></td>
		
	  </tr>
	  <tr>
	    <td class="normal14z" >註記簽核3：</td>
		<td class="normal14"  ><input type="text" tabIndex="6" id="ms006" onKeyPress="keyFunction()" name="ms006"  size="130" value="<?php echo  $ms006; ?>" disabled="disabled"  /></td>
		
	  </tr>
		 
    </table>
		
	 <!-- <div class="buttons">
	    <a  accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi17/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>-->
    </form>
	<?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>
  	
    </div> <!-- div-6 -->
  </div>   <!-- div-5 -->
</div>    <!-- div-4 -->

    </div>  <!-- div-3 -->
 </div>   <!-- div-2 -->
</div>    <!-- div-1 -->
<?php  include_once("./application/views/funnew/fun_disabled_v.php"); ?> 