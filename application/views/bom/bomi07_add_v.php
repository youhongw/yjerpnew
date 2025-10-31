<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<div style="float:left;padding-top: 5px; ">
    </div>

<div id="content"> <!-- div-3 --> 
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 產品途程資料建立作業 - 新增　　　</h1>
      <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('bom/bomi07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div> -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/bom/bomi07/addsave" >	
	<div id="tab-general">  <!-- div-6 -->
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  
      $invq02a=$this->input->post('invq02a');
	  $invq02adisp=$this->input->post('invq02a');
	  $me001disp=$this->input->post('me001disp');
	  $me001disp1=$this->input->post('me001disp1');
	  $me001disp2=$this->input->post('me001disp2');
	  $me002=$this->input->post('me002');
	  $me003=$this->input->post('me003');
	  $me004=$this->input->post('me004');
	
	//  if(!isset($me013)) { $me013=date("Y/m/d"); }
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y" width="8%" ><span class="required">途程品號：</span> </td>
        <td class="normal14a" width="42%" ><input tabIndex="1" id="me001" onKeyPress="keyFunction()"  onchange="startinvq02a(this)" name="invq02a" value="<?php echo $invq02a; ?>"  type="text"  /><img id="Showinvq02a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
        <span id="invq02adisp"> <?php   echo $invq02adisp; ?> </span></td>
		<td class="normal14y" width="8%" >品名：</td>
        <td class="normal14a" width="42%" ><input type="text" tabIndex="2" readonly="value"  onKeyPress="keyFunction()"  id="me001disp" name="me001disp" value="<?php echo $me001disp; ?>"  style="background-color:#EBEBE4"  /></td>
	  </tr>
	 
	 <tr>
	    <td class="normal14z" >規格： </td>
        <td class="normal14" ><input type="text" tabIndex="3" readonly="value" onKeyPress="keyFunction()"   id="me001disp1" name="me001disp1" value="<?php echo $me001disp1; ?>"  style="background-color:#EBEBE4"  /></td>
		<td class="normal14z">單位：</td>
        <td class="normal14"><input type="text" tabIndex="4" readonly="value" onKeyPress="keyFunction()"   id="me001disp2" name="me001disp2" value="<?php echo $me001disp2; ?>"  style="background-color:#EBEBE4"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >途程代號： </td>
        <td class="normal14" ><input   tabIndex="5" id="me002" onKeyPress="keyFunction()" onchange="startkey(this)" name="me002" value="<?php echo $me002; ?>" size="10" type="text" required />
	     <span id="keydisp" ></span></td>
		<td class="normal14z">途程名稱：</td>
        <td class="normal14"><input type="text" tabIndex="6"  onKeyPress="keyFunction()"   size="50" id="me003" name="me003" value="<?php echo $me003; ?>"   /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z">備註：</td>
        <td class="normal14"><input type="text" tabIndex="7"  onKeyPress="keyFunction()" size="50"  id="me004" name="me004" value="<?php echo $me004; ?>"   /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	</table>
	
	<div>
        <table id="order_product" class="list1">
        <thead>
            <tr>
              <td width="5%"></td>			
		      <td width="5%" class="left">製程代號</td>
              <td width="5%" class="left">製程名稱</td>
			  <td width="5%" class="left">加工順序</td>
			  <td width="5%" class="left">性質</td>
              <td width="5%" class="left">線別/廠商代號</td>
			  <td width="5%" class="left">線別/廠商名稱</td>
			   <td width="5%" class="left">製程敘述</td>
              <td width="5%" class="right">工時批量</td>
			  <td width="5%" class="right">固定人時</td>
			   <td width="5%" class="right">變動人時</td>
			   <td width="5%" class="right">固定機時</td>
              <td width="5%" class="right">變動機時</td>
			  <td width="5%" class="right">移轉批量</td>
			   <td width="5%" class="right">固定天數</td>
			   <td width="5%" class="right">變動天數</td>
			   <td width="5%" class="left">幣別</td>
			    <td width="5%" class="left">加工單位</td>
              <td width="5%" class="right">加工單價</td>
			  <td width="5%" class="left">檢驗方式</td>
			  <td width="5%" class="right">檢驗天數</td>
			  <td width="5%" class="left">備註</td>
            </tr>
        </thead>
          <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="21"></td>
            </tr>
          </tfoot>
       </table>
    </div>
	
	
	<!-- <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('bom/bomi07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div> -->
	  
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份製程代號或名稱下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
  </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

   </div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
 <?php include("./application/views/fun/bomi07_funjs_v.php"); ?>
 