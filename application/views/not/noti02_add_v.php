<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 銀行存提款建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#tf001').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/not/noti02/addsave" >	
	<div id="tab-general">  <!-- div-6 -->
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
        $tf001=$this->input->post('tf001');
		$tf002=$this->input->post('tf002');
		//$tf003=$this->input->post('tf003');
		$tf004=$this->input->post('tf004');
		$tf005=$this->input->post('tf005');
		$tf006=$this->input->post('tf006');
		$tf007=$this->input->post('tf007');
		$tf008=$this->input->post('tf008');
		$tf009=$this->input->post('tf009');
		$tf010=$this->input->post('tf010');
	//	$tf011=$this->input->post('tf011');
	//	$tf012=$this->input->post('tf012');
		$tf013=$this->input->post('tf013');
		$tf014=$this->input->post('tf014');
		$tf015=$this->input->post('tf015');
		$tf016=$this->input->post('tf016');
		$tf017=$this->input->post('tf017');
		$tf018=$this->input->post('tf018');
		if(!isset($tf012)) { $tf012=$this->session->userdata('manager'); } else {$tf012=$this->input->post('tf012');}
	  if(!isset($tf003)) { $tf003=date("Y/m/d"); } else {$tf003=$this->input->post('tf003');}
	   if(!isset($tf011)) { $tf011=date("Y/m/d"); } else {$tf003=$this->input->post('tf011');}
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y" width="10%" ><span class="required">存款單別：</span></td>
		<td class="start14a" width="23%" ><input tabIndex="1" id="tf001" onchange="startnoti06a(this)" onKeyPress="keyFunction()"  name="tf001" value="<?php echo $tf001; ?>" type="text" />
		<a href="javascript:;"><img id="Shownoti06a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		<span id="Shownoti06a_str" ></span></td>
		<td class="normal14a" width="10%" ><input type="checkbox" onKeyPress="keyFunction()" id="tf018" name="tf018" onchange="check_enable();" style="background-color:#EBEBE4"  />轉出碼</td>
		<td class="normal14a" width="23%"></td>
        <td class="normal14a" width="10%" ><input type="checkbox" onKeyPress="keyFunction()" id="ma011" name="ma011" onchange="check_enable();" style="background-color:#EBEBE4" />備償帳戶</td>
	    <td class="normal14a" width="24%"></td>
	  </tr>
	 <tr>
	    <td class="normal14z" >單據日期：</td>
        <td class="normal14" ><input tabIndex="3" id="tf011" onKeyPress="keyFunction()" name="tf011" onclick="scwShow(this,event);" value="<?php echo $tf011; ?>" />
		<img  onclick="scwShow(tf011,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		<td class="normal14z" >科目名稱：</td>
        <td class="normal14" ><input tabIndex="4" id="ma003" onKeyPress="keyFunction()" name="ma003" value="" style="background-color:#EBEBE4" /></td>
	     <td class="normal14" ></td>
		<td class="normal14" ></td>
	  </tr>
	 <tr>
	    <td class="normal14z" >存提單號：</td>
        <td class="normal14" ><input tabIndex="1" id="tf002" onKeyPress="keyFunction()" onfocus="chkno1(this)" name="tf002" value="" readonly="readonly" /></td>
		<td class="normal14z" >銀行存款科目：</td>
        <td class="normal14" ><input tabIndex="2" id="ma005" onKeyPress="keyFunction()" name="ma005" value="" style="background-color:#EBEBE4" /></td>
	    <td class="normal14" ></td>
		<td class="normal14" ></td>
	  </tr>
	  
      
	  <tr>
		<td class="normal14z" >銀行代號：</td>
		<td class="normal14" ><input tabIndex="7" id="tf004" onchange="startnoti01a(this)" onKeyPress="keyFunction()" name="tf004" value="<?php echo $tf004; ?>"  />
		<a href="javascript:;"><img id="Shownoti01a" src="<?php echo base_url()?>assets/image/png/bank.png" alt="" align="top" /></span>
		<span id="Shownoti01a_str"></span></td>
        <td class="normal14z" >傳票單別：</td>
		<td class="normal14" ><input tabIndex="8" id="tf008" onKeyPress="keyFunction()" name="tf008" value="<?php echo $tf008; ?>" style="background-color:#EBEBE4"  /></td>
         <td class="normal14" ></td>
		<td class="normal14" ></td>
	  </tr>
	  <tr>
		<td class="normal14z" >銀行簡稱：</td>
        <td class="normal14" ><input tabIndex="9" id="ma002" onKeyPress="keyFunction()" name="ma002" value="" style="background-color:#EBEBE4" /></td>
		<td class="normal14z" >傳票單號：</td>
        <td class="normal14" ><input tabIndex="10" id="tf009" onKeyPress="keyFunction()" name="tf009" value="<?php echo $tf009; ?>" style="background-color:#EBEBE4"  /></td>
	     <td class="normal14" ></td>
		<td class="normal14" ></td>
	  </tr>
	  <tr>
		<td class="normal14z" >帳　　號：</td>
        <td class="normal14" ><input tabIndex="11" id="ma004" onKeyPress="keyFunction()" name="ma004" value="" style="background-color:#EBEBE4" /></td>
		<td class="normal14z" >存提日期：</td>
		<td class="normal14" ><input tabIndex="12" id="tf003" onKeyPress="keyFunction()" name="tf003" value="<?php echo $tf003; ?>" onclick="scwShow(this,event);" style="background-color:#EBEBE4"  /></td>
        
		<td class="normal14" ><input type="checkbox" onKeyPress="keyFunction()" id="tf016" name="tf016" onchange="check_enable();" <?php if($tf016) {echo "checked";} ?> style="background-color:#EBEBE4"  />產生分錄碼</td>
	    <td class="normal14" ></td>
	  </tr>
	  <tr>
		<td class="normal14z" ><span>幣　　別：</span></td>
		<td class="normal14" ><input tabIndex="13" id="tf005" onKeyPress="keyFunction()" name="tf005" value="<?php echo $tf005; ?>" />
		<a href="javascript:;"><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
		<span id="Showcmsq06a_str"></span></td>
		<td class="normal14z" >匯　　率：</td>
		<td class="normal14" ><input tabIndex="14" id="tf006" onKeyPress="keyFunction()" name="tf006" value="<?php echo $tf006; ?>" /></td>
		<td class="normal14z" >確  認  者：</td>
		<td class="normal14" ><input tabIndex="15" id="tf012" onKeyPress="keyFunction()" name="tf012" value="<?php echo $tf012; ?>" style="background-color:#EBEBE4"  /></td>
	  </tr>
	  <tr>
		<td class="normal14z" >備　　註：</td>
		<td class="normal14" colspan="3"><input tabIndex="16" id="tf007" onKeyPress="keyFunction()" name="tf007" value="<?php echo $tf007; ?>" size="80px" /></td>
		<td class="normal14z">簽核狀態：</td>
		<td class="normal14" ><input tabIndex="17" id="tf017" onKeyPress="keyFunction()" name="tf017" value="<?php echo $tf017; ?>" style="background-color:#EBEBE4"  /></td>
        
	  </tr>
	</table>
	
	<div>
        <table id="order_product" class="list1">
        <thead>
            <tr>
              <td width="5%"></td>			
		      <td width="10%" class="left">序號</td>
              <td width="10%" class="left">類別碼</td>
              <td width="10%" class="left">金額</td>
			  <td width="15%" class="left">轉帳對象</td>
			  <td width="10%" class="left">對象代號</td>
			  <td width="15%" class="left">對象簡稱</td>
			  <td width="15%" class="left">銀行行號</td>
			  <td width="15%" class="left">銀行帳號</td>
			  <td width="15%" class="left">對方科目</td>
			  <td width="15%" class="left">手續費</td>
			  <td width="15%" class="left">手續費負擔</td>
			  <td width="15%" class="left">備註</td>		
            </tr>
        </thead>
          <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="12"></td>
            </tr>
          </tfoot>
       </table>
    </div>
	<!-- 合計     -->
		 <tr>
			<td class="center" valign="top"></td>
			<td colspan="2" class="right"><span></span></td>
			
			<td class="right" valign="top"><b style="color: #003A88;">　原幣合計：</b></td>
			<td ><input type='text' readonly="value" name='tf013' id="tf013" size="8" value="<?php echo $tf013; ?>"  style="background-color:#EBEBE4" /></td>
			<td class="right" valign="top"><b style="color: #003A88;">　　本國幣合計：</b></td>
			<td ><input type='text' readonly="value" name='tf014' id="tf014" size="8" value="<?php echo $tf014; ?>"  style="background-color:#EBEBE4" /></td>
			<td class="left" valign="top"></td>
		  </tr>
	<!-- 合計     -->	  
	<input id="select_rows" style="display:none;"/>
	<!-- <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div>-->

    </form>
	
	
  </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
  
   </div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
 <?php include("./application/views/fun/noti02_funjs_v.php"); ?>
 <script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#tf001').focus();
	}); 	   
</script> 	 