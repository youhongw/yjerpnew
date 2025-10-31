 <div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
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
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 品號類別資料建立作業 - 修改　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#ma001').focus();"  type='submit'  accesskey="s"  name="submit"  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	    <a  accesskey="x"  onKeyPress="keyFunction()" id="cancel" name="cancel" href="<?php echo site_url('inv/invi01/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/inv/invi01/updsave" method="post" enctype="multipart/form-data" >
	<!-- <div id="htabs" class="htabs14"><span>編輯項目-修改</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $ma001=$row->ma001;?>
          <?php   $ma002=$row->ma002;?>
          <?php   $ma003=$row->ma003;?>
          <?php   $actq03a=$row->ma004;?>
		  <?php   $actq03adisp=$row->ma004disp;?>
          <?php   $actq03a1=$row->ma005;?>
		  <?php   $actq03a1disp=$row->ma005disp;?>
          <?php   $actq03a2=$row->ma006;?>
		   <?php   $actq03a2disp=$row->ma006disp;?>
          <?php   $flag=$row->flag;?>	  
	<?php  }?>
       
	<table class="form14">  <!-- 表格 -->
	 <tr>
	    <td class="normal14y" width="8%"><span class="required">類別代號：</span> </td>
        <td class="normal14a" width="42%"><input readonly="value"  tabIndex="1" id="ma002" onKeyPress="keyFunction()" onchange="startkey(this)" name="ma002" value="<?php echo $ma002; ?>" size="6" type="text" required />
	     <span id="keydisp" ></span></td>
		  <td class="normal14y" width="8%" ><span class="required">分類方式：</span></td>
        <td class="normal14a" width="42%" >
		  <select  tabIndex="2" readonly="value" id="ma001" onKeyPress="keyFunction()"  name="ma001" >
             <option <?php if($ma001 == '1') echo 'selected="selected"';?> value='1'>1:會計</option>                                                                        
		     <option <?php if($ma001 == '2') echo 'selected="selected"';?> value='2'>2:商品</option>
             <option <?php if($ma001 == '3') echo 'selected="selected"';?> value='3'>3:類別</option>
             <option <?php if($ma001 == '4') echo 'selected="selected"';?> value='4'>4:生管</option>
		  </select>
		  <span id="ma001disp" ></span>
	    </td>
	  </tr>
	  <tr>
	    <td class="normal14z" >類別名稱：</td>
        <td class="normal14" ><input  tabIndex="3" id="ma003" onKeyPress="keyFunction()" name="ma003"   value="<?php echo  $ma003; ?>"    size="12" type="text"  /></td>
	    <td  class="normal14z" >存貨科目：</td>
        <td  class="normal14"  ><input   tabIndex="4" id="ma004" onKeyPress="keyFunction()" onchange="startactq03a(this)" name="actq03a" value="<?php echo $actq03a; ?>"  type="text"  /><img id="Showactq03a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="actq03adisp"> <?php    echo $actq03adisp; ?> </span></td>
	  </tr>	
	  <tr>
	    <td class="normal14z">銷貨收入：</td>						
        <td  class="normal14"  ><input   tabIndex="5" id="ma005" onKeyPress="keyFunction()" onchange="startactq03a1(this)" name="actq03a1" value="<?php echo $actq03a1; ?>"  type="text"  /><img id="Showactq03a1" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="actq03a1disp"> <?php    echo $actq03a1disp; ?> </span></td>
	    <td class="normal14z"> 銷貨退回：</td>
        <td class="normal14" ><input   tabIndex="6" id="ma006" onKeyPress="keyFunction()" onchange="startactq03a2(this)" name="actq03a2" value="<?php echo $actq03a2; ?>"  type="text"  /><img id="Showactq03a2" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="actq03a2disp"> <?php    echo $actq03a2disp; ?> </span></td>
	  </tr>
    </table>
		
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
		
	 <!-- <div class="buttons">
	    <button  type='submit'  accesskey="s"  name="submit"  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  accesskey="x"  onKeyPress="keyFunction()" id="cancel" name="cancel" href="<?php echo site_url('inv/invi01/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>-->
	   
    </form>
	<?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[  欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料.  ] ' ?> </div>  <?php } ?>
   
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php include("./application/views/fun/invi01_funjs_v.php"); ?>