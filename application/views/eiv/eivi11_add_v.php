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

<div id="content" >  <!-- div-3 -->
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 手開發票建立作業 - 新增</h1>
    </div>
	
    <div class="content" style="background-image:url('<?php echo base_url()?>assets/image/seti02/voc.png'); margin:0px; border:0px;height:414px; width:624px; background-size:auto;"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/eiv/eivi11/addsave" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $mv001=$this->input->post('mv001');
	  $mv002=$this->input->post('mv002');
	  $mv003=$this->input->post('mv003');
	  $mv004=$this->input->post('mv004');
	  $mv005=$this->input->post('mv005');
	  $mv006=$this->input->post('mv006');
      $mv007=$this->input->post('mv007');
      $mv008=$this->input->post('mv008');
	  $mv009=$this->input->post('mv009');
	  $mv010=$this->input->post('mv010');
      $mv011=$this->input->post('mv011');

      $mv026=$this->input->post('mv026');
	  $mv027=$this->input->post('mv027');
      $mv028=$this->input->post('mv028');
	  $mv007=0;
	  $mv008=0;
      $mv009=0;
	  $mv026=0;
	  $mv027=0;
      $mv028=0;
	  $mv053=$this->input->post('mv053');  //key
	  $mv055=$this->input->post('mv055'); //日期
	  $mv056=$this->input->post('mv056'); //數字大寫
	  $date=date("Y/m/d");
	  $date1=substr($date,0,4);
	  $date1=$date1-1911;
	  $date2=substr($date,5,2);
	  $date3=substr($date,8,2);
	  if (!isset($mv054)) {$mv054=$date1;$mv004=$date2;$mv005=$date3;} 
	  else {$mv054=$this->input->post('mv054');$mv004=$this->input->post('mv004');$mv005=$this->input->post('mv005');}
	//  $mv004="07";
	//  $mv005="08";
	?>
   
	<table style="width: 624; cellpadding=10 border=0 " >     <!-- 表格 -->
	     <tr>
         <td><input  tabIndex="1" id="mv001"  name="mv001"   value="<?php echo  $mv001; ?>"  size="20"  type="text" style="margin-top: 10px;margin-left: 75px" /></td>		   
	  </tr>	
	  <tr>
         <td><input  tabIndex="2" id="mv002"  name="mv002"   value="<?php echo  $mv002; ?>"  size="12"  type="text" style="margin-top: -2px;margin-left: 75px" />		   
	     <span><?php echo "　　" ?></span>
		 <input  tabIndex="3" id="mv054"  name="mv054"   value="<?php echo  $mv054; ?>"  size="2"  type="text" style="margin-left: 140px" />
		 <input  tabIndex="4" id="mv004"  name="mv004" onfocus="startkey();"   value="<?php echo  $mv004; ?>"  size="2"  type="text" style="margin-left: 10px" />
	     <input  tabIndex="5" id="mv005" onblur="check_title_no(this)" name="mv005"   value="<?php echo  $mv005; ?>"  size="2"  type="text" style="margin-left: 10px" /></td>
	     
	  </tr>	
	   <tr>
         <td><input  tabIndex="6" id="mv003"  name="mv003"  onfocus="check_title_no(this)"  value="<?php echo  $mv003; ?>"  size="56"  type="text" style="margin-top: -4px;margin-left: 75px" />   
	     <input type="text"  tabIndex="1" id="mv053"  name="mv053"   value="<?php echo  $mv053; ?>"  size="10"   style="margin-left: 10px;background-color:#F0F0F0;" readonly="readonly" />
		 <input type="text"  tabIndex="1" id="mv055"  name="mv055"   value="<?php echo  $mv055; ?>"  size="6"   style="margin-left: 10px;background-color:#F0F0F0;" readonly="readonly"/></td>
	  </tr>	
	  <tr>
         <td><input  tabIndex="7" id="mv006"  name="mv006"   value="<?php echo  $mv006; ?>"  size="20"  type="text" style="margin-top: 20x;margin-left: 15px" />
		 <input  tabIndex="8" id="mv007"  name="mv007"  onchange="calamt(this)" value="<?php echo  $mv007; ?>"  size="8"  type="text" style="margin-left: 18px" />
		 <input  tabIndex="9" id="mv008"  name="mv008" onchange="calamt(this)"  value="<?php echo  $mv008; ?>"  size="8"  type="text" style="margin-left: 6px" />
		 <input  tabIndex="10" id="mv009"  name="mv009" onfocus="calamt(this)"  onblur="calamt1(this)" value="<?php echo  $mv009; ?>"  size="14"  type="text" style="margin-left: 6px" /></td>		   
	  </tr>	
	     <tr>
         <td><input  tabIndex="11" id="mv026"  name="mv026" onfocus="calamt1(this);NumToCh()"  value="<?php echo  $mv026; ?>"  size="14"  type="text" style="margin-top: 117px;margin-left: 305px" />
		 </td>		   
	  </tr>	
	   <tr>
         <td><input  tabIndex="12" id="mv027"  name="mv027"   value="<?php echo  $mv027; ?>"  size="14"  type="text" style="margin-top: 2px;margin-left: 305px" />
		 </td>		   
	  </tr>	
	  <tr>
         <td><input  tabIndex="13" id="mv028"  name="mv028" onfocus="NumToCh(this)"  value="<?php echo  $mv028; ?>"  size="14"  type="text" style="margin-top: 2px;margin-left: 305px" />
		 </td>		   
	  </tr>	
	   <tr>
         <td><input  tabIndex="14" id="mv056"  name="mv056"   value="<?php echo  $mv056; ?>"  size="47"  type="text" style="text-align:right; margin-top: 1px;margin-left: 110px;background-color:#F0F0F0" readonly="readonly" />
		 </td>		   
	  </tr>	
	<!--	<div id="canvas" style="background-image:url('<?php echo base_url()?>assets/image/seti02/voc.png');
			background-size: 100%;background-repeat: no-repeat;width: 850px;
			border-width: 1px;border-style: solid;"
			ondrop='set_position(event);'
			ondragover='print_position(event);17'
			>
			<img src="<?php echo base_url()?>assets/image/seti02/voc.png" style="visibility: hidden;width:100%;" />
		</div> -->
	  
	
	<br/><br/>
	</table>
	   		  
	<div class="buttons">
	<button tabIndex="8" type='submit' style="margin-top: 29px;margin-left: 4px" accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a  accesskey="x"  tabIndex="9"  style="margin-top: 33px;margin-left: 8px" id='cancel' name='cancel' href="<?php echo site_url('eiv/eivi11/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> 
	  
    </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
  
</div> <!-- div-4 -->

  
    </div>  <!-- div-3 -->
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->

 <?php include_once("./application/views/fun/eivi11_funjs_v.php"); ?> 
	 
 