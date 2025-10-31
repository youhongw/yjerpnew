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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" />申報公司建立作業 - 新增　　　</h1>
       <div style="float:left;padding-top: 5px; ">
	   <button tabIndex="8" type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	<a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi11/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	</div>
	</div>　　　
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/cms/cmsi11/addsave" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $ma001=$this->input->post('ma001');
	  $ma002=$this->input->post('ma002');
	  $ma003=$this->input->post('ma003');
	  $ma004=$this->input->post('ma004');
	  $ma005=$this->input->post('ma005');
	  $ma006=$this->input->post('ma006');
	  $ma007=$this->input->post('ma007');
	  $ma008=$this->input->post('ma008');
	   $ma009=$this->input->post('ma009');
	  $ma010=$this->input->post('ma010');
	  $ma011=$this->input->post('ma011');
	  $ma012=$this->input->post('ma012');
	   $ma013=$this->input->post('ma013');
	  $ma014=$this->input->post('ma014');
	  $ma015=$this->input->post('ma015');
	  $ma016=$this->input->post('ma016');
	  $ma017=$this->input->post('ma017');
	  
      
	
	//  if (($ma006!="Y") && ($ma006!="N") ) { $ma006="Y" ;}
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="11%"><span class="required">申報公司：</span></td>
        <td class="normal14a" width="27%" >
         <input  tabIndex="1" id="ma001" onKeyPress="keyFunction()" onchange="startkey(this)" name="ma001"   value="<?php echo  $ma001; ?>"    type="text" required />
		<span id="keydisp" ></span></td>
	    <td class="normal14y" width="10%">簡稱：</td>
        <td class="normal14a"  width="26%"> <input  tabIndex="2" id="ma002" onKeyPress="keyFunction()"  name="ma002"   value="<?php echo  $ma002; ?>"    type="text"  />
		<td class="normal14y" width="9%">統一編號：</td>
        <td class="normal14a"  width="27%"> <input  tabIndex="3" id="ma003" onKeyPress="keyFunction()"  name="ma003"   value="<?php echo  $ma003; ?>"    type="text"  />
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" >稅籍編號： </td>
        <td class="normal14" ><input  tabIndex="4" id="ma004" onKeyPress="keyFunction()"  name="ma004"   value="<?php echo  $ma004; ?>"    type="text"  /></td>
		<td class="normal14z" >營業人名稱：</td>
		<td class="normal14"><input  tabIndex="5" id="ma005" onKeyPress="keyFunction()"  name="ma005"   value="<?php echo  $ma005; ?>"    type="text"  /></td>
        <td class="normal14z" >負責人：</td>
        <td class="normal14a"  > <input  tabIndex="6" id="ma006" onKeyPress="keyFunction()"  name="ma006"   value="<?php echo  $ma006; ?>"    type="text"  />
	  </tr>
	  <tr>
	    <td class="normal14z"  >營業地址1： </td>
        <td class="normal14" colspan='3'><input  tabIndex="7" id="ma007" onKeyPress="keyFunction()"  name="ma007"   value="<?php echo  $ma007; ?>"  size="100"  type="text"  /></td>
		
        <td class="normal14z" >電話號碼：</td>
        <td class="normal14a"  > <input  tabIndex="8" id="ma010" onKeyPress="keyFunction()"  name="ma010"   value="<?php echo  $ma010; ?>"    type="text"  />
	  </tr>
	  <tr>
	    <td class="normal14z"  >營業地址2： </td>
        <td class="normal14" colspan='3'><input  tabIndex="9" id="ma008" onKeyPress="keyFunction()"  name="ma008"   value="<?php echo  $ma008; ?>"  size="100"  type="text"  /></td>
		
        <td class="normal14z" >稅捐縣市：</td>
        <td class="normal14a"  > <input  tabIndex="10" id="ma011" onKeyPress="keyFunction()"  name="ma011"   value="<?php echo  $ma011; ?>"    type="text"  />
	  </tr>
	  <tr>
	    <td class="normal14z"  >備註： </td>
        <td class="normal14" colspan='3'><input  tabIndex="11" id="ma007" onKeyPress="keyFunction()"  name="ma007"   value="<?php echo  $ma007; ?>"  size="100"  type="text"  /></td>
		
        <td class="normal14z" >稅捐分處：</td>
        <td class="normal14a"  > <input  tabIndex="12" id="ma012" onKeyPress="keyFunction()"  name="ma012"   value="<?php echo  $ma012; ?>"    type="text"  />
	  
	  </tr>
	   <tr>
	    <td class="normal14z" >房屋稅籍： </td>
        <td class="normal14" ><input  tabIndex="13" id="ma004" onKeyPress="keyFunction()"  name="ma004"   value="<?php echo  $ma004; ?>"    type="text"  /></td>
		<td class="normal14z" >上市上櫃：</td>
		<td class="normal14"> <select id="ma014" onKeyPress="keyFunction()" name="ma014"  onchange="selappr(this)" tabIndex="14">
            <option <?php if($ma014 == 'N') echo 'selected="selected"';?> value='N'>N未上市上櫃</option>                                                                        
		    <option <?php if($ma014 == 'Y') echo 'selected="selected"';?> value='Y'>Y已上市上櫃</option></select></td>
        <td class="normal14z" >事務所代理：</td>
        <td class="normal14a"  > <input  tabIndex="15" id="ma006" onKeyPress="keyFunction()"  name="ma006"   value="<?php echo  $ma006; ?>"    type="text"  />
	  </tr>
	  <tr>
	    <td class="normal14z" >事務所代號： </td>
        <td class="normal14" ><input  tabIndex="16" id="ma004" onKeyPress="keyFunction()"  name="ma004"   value="<?php echo  $ma004; ?>"    type="text"  /></td>
		
        <td class="normal14z" >E-MAIL：</td>
        <td class="normal14a" colspan='3' ><input  tabIndex="17" id="ma004" onKeyPress="keyFunction()"  name="ma004"   value="<?php echo  $ma004; ?>"  size="90"  type="text"  /></td>
	  </tr>
	</table>
	   		  
	<!--<div class="buttons">
	<button tabIndex="8" type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi11/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> -->
	  
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

   </div>  <!-- div-3 -->
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
 
	 
 