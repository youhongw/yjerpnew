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
	
	<div id="divFacri03" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 
	<iframe id="acri03frame" src="" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>

<div id="content"> <!-- div-3 --> 
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 應收票據建立作業 - 新增　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#copi01').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti04/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	  </div>
	  <!--<div style="float:right; "> 
	       <a id="Shownoti04adisp" onclick=""  style="float:left"  class="button"><span>託收</span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
	       <a id="Shownoti04bdisp" onclick=""  style="float:left"  class="button"><span>轉付</span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
	       <a id="Shownoti04cdisp" onclick=""  style="float:left"  class="button"><span>退票</span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
	       <a id="Shownoti04ddisp" onclick=""  style="float:left"  class="button"><span>還票</span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      </div>-->
	</div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/not/noti04/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值
	  //預設稅率,廠別,幣別
		$stax_rate = $this->session->userdata('sysma004');
		$sysma200 = $this->session->userdata('sysma200');
		if(!isset($tc013)) {$tc013 = $this->input->post('copi01'); }
		if(!isset($tc013disp)) {$tc013disp = $this->input->post('tc013disp'); }
		if(!isset($tc004)) { $tc004=date("Y/m/d"); }
		if(!isset($tc008)) {$tc008 = $this->input->post('tc008'); }
	    if(!isset($noti01adisp)) {$noti01adisp = $this->input->post('tc008disp'); }
		if(!isset($tc008disp)) {$tc008disp = $this->input->post('tc008disp'); }
		//if(!isset($tc001)) { $tc001=$this->input->post('copi03'); }
		//if(!isset($tc001disp)) { $tc001disp=$this->input->post('tc001disp'); }
		//if(!isset($tc002)) { $tc002=$this->input->post('tc002'); } 
		//if(!isset($tc003)) { $tc003=date("Y/m/d"); }
		
		//if(!isset($tc004disp)) { $tc004disp=$this->input->post('tc004disp'); }
		//if(!isset($tc025)) { $tc025=$this->input->post('tc025'); }
		//if(!isset($tc049)) { $tc049=$this->input->post('tc049'); }
		//  $tc025=$this->input->post('tc025');  一筆存檔清空白
		//if(!isset($tc039)) { $tc039=date("Y/m/d"); }
		//if(!isset($tc040)) { $tc040=$username; }
		//if(!isset($tc050)) { $tc050="N"; }
		//if(!isset($tc027)) { $tc027="Y"; }
		//$tc029=0;$tc030=0;$tc031=0;$tc043=0;$tc044=0; 
		//$this->session->unset_userdata('docno');
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
		<td class="normal14y" width="8%">客戶代號：</td>
        <td  class="normal14a" width="25%" >
			<input tabIndex="1" id="copi01" onKeyPress="keyFunction()"  onchange="check_copi01(this);clean_noti01a();" name="copi01" value="<?php echo $tc013; ?>" size="12" type="text"  />
			<a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
			<span id="copi01disp"> <?php   echo $tc013disp; ?> </span>
		</td>
		
	    <td class="normal14y" width="8%" >收票日： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" >
			<input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tc004" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="tc004"  value="<?php echo $tc004; ?>"  size="12" type="text" style="background-color:#FFFFE4"  />
		<img  onclick="scwShow(tc004,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		
	  </tr>

	  <tr>	    
		<td class="normal14z">付款銀行：</td>
        <td class="normal14">
			<input tabIndex="3" id="noti01a" onKeyPress="keyFunction()"  onchange="check_noti01a(this)" name="noti01a" value="<?php echo $tc008; ?>" size="12" type="text"  />
			<a href="javascript:;"><img id="Shownoti01adisp" src="<?php echo base_url()?>assets/image/png/bank.png" alt="" align="top"/></a>
		    <span id="noti01adisp1"> <?php   echo $tc008disp; ?> </span>
		</td>
		
	    <td class="normal14"></td>
	  </tr>
	  
	</table>
	
	<div class="abgne_tab"> <!-- div-6 頁標籤 -->
		<ul class="tabs">
		  <li><a href="#tab1"  accesskey="a">票據資料a</a></li>
		  <li><a href="#tab2"  accesskey="b">收款資料b</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  交易資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	  <?php
		if(!isset($tc001)){$tc001 = $this->input->post('tc001');}
		if(!isset($tc006)){$tc006 = $this->input->post('tc006');}
		if(!isset($tc002)){$tc002 = $this->input->post('cmsi06');}
		if(!isset($tc002disp)){$tc002disp = $this->input->post('cmsi06disp');}
		if(!isset($tc007)) { $tc007=date("Y/m/d"); }
		if(!isset($tc027)){$tc027 = $this->input->post('tc027');}
		if(!isset($tc010)){$tc010 = $this->input->post('tc010');}
		if(!isset($tc003)){$tc003 = $this->input->post('tc003');}
		if(!isset($tc012)){$tc012 = $this->input->post('tc012');}
		if(!isset($tc009)){$tc009 = $this->input->post('tc009');}
		if(!isset($noti01adisp)){$noti01adisp = $this->input->post('noti01adisp');}
		if(!isset($tc005)) { $tc005=date("Y/m/d"); }
		
	  ?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y"  width="12%"><span class="required">票號：</span></td>
        <td class="normal14a"  width="36%" >
			<input type="text" tabIndex="4" onKeyPress="keyFunction()" id="tc001"  name="tc001"  onblur=""  value="<?php echo  $tc001; ?>"   size="20" required="requierd"  />
		</td>
		
	    <td class="normal14y"  width="12%">入帳日數：</td>  <!-- onchange="startcmsi09(this)"     -->
        <td class="normal14a"  width="36%" >
			<input tabIndex="5" id="tc006" onKeyPress="keyFunction()" name="tc006" onblur=""  value="<?php echo $tc006; ?>"  type="text"  size="20"  />
		</td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14z"  >幣別：</td>
        <td class="normal14" >
			<input tabIndex="6" id="cmsi06" onKeyPress="keyFunction()" name="cmsi06" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $tc002; ?>"  type="text"   size="20" />
			<a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
			<span id="cmsi06disp"> <?php    echo $tc002disp; ?> </span>
		</td>
		
	    <td class="normal14z" >預兌日：</td>		
        <td class="normal14"  >
			<input type="text" id="tc007"   tabIndex="7" ondblclick="scwShow(this,event);" onchange="dateformat_ymd(this);"  onKeyPress="keyFunction()"    name="tc007" value="<?php echo $tc007; ?>"  size="20" style="background-color:#FFFFE4" />
		<img  onclick="scwShow(tc007,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
	  
	  <tr>
		<td class="normal14z" >匯率：</td>		
        <td class="normal14"  >
			<input type="text" id="exchange_rate"   tabIndex="8"   onKeyPress="keyFunction()"    name="tc027" value="1"  size="20" />
		</td>
	    
		<td  class="normal14z" >票據種類：</td>
        <td  class="normal14"  >
			<input tabIndex="9" id="cmsi16disp2" onKeyPress="keyFunction()" name="cmsi16disp2" onblur=""   value="<?php echo  $tc010; ?>"   size="20"   type="text"  />
		</td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >票面金額：</td>		
        <td class="normal14"  >
			<input type="text" id="tc003"   tabIndex="10"   onKeyPress="keyFunction()"    name="tc003" value="<?php echo $tc003; ?>"  size="20" />
		</td>

	    <td class="normal14z" >客票：</td>
        <td class="normal14"  >
			<input tabIndex="11" id="tc011" name="tc011" value="Y" onKeyPress="keyFunction()" type="checkbox" />
		</td>
	  </tr>
		
	  <tr>
	    <td class="normal14z" >到期日：</td>		
        <td class="normal14"  >
			<input type="text" id="tc005" ondblclick="scwShow(this,event);" onchange="dateformat_ymd(this);"  tabIndex="12"   onKeyPress="keyFunction()"    name="tc005" value="<?php echo $tc005; ?>"  size="20" style="background-color:#FFFFE4" />
		<img  onclick="scwShow(tc005,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>

	    <td class="normal14z" >目前票況：</td>
        <td class="normal14"  >
			<input type="text"  readonly="value" tabIndex="13"   onKeyPress="keyFunction()" id="tc012" name="tc012" value="<?php echo $tc012; ?>" style="background-color:#E7EFEF"  size="20" />
		</td>
		<script>
			$(document).ready(function(){
				$('#tc012').val('1:收票');
			});
		</script>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >付款帳號：</td>		
        <td class="normal14"  >
			<input type="text" id="noti01adisp2" readonly="value"  tabIndex="14"   onKeyPress="keyFunction()"    name="noti01adisp2" value="<?php echo $tc009 ?>"  size="20" style="background-color:#F0F0F0"/>
		</td>

	    <td class="normal14z" >託收碼：</td>
        <td class="normal14"  >
			<input tabIndex="15" id="tc021" name="tc021" value="Y" onKeyPress="keyFunction()" type="checkbox" />
		</td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >銀行名稱：</td>		
        <td class="normal14"  >
			<input type="text" id="noti01adisp"  readonly="value"  tabIndex="16"   onKeyPress="keyFunction()"    name="noti01adisp" value="<?php echo $noti01adisp; ?>"  size="20" style="background-color:#F0F0F0"/>
		</td>
	  </tr>
	</table>
	</div>
	
	<!--  地址 標籤 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	  <?php
	   $tc015=$this->input->post('tc015');
	   $tc015disp=$this->input->post('tc015disp');
	   $tc016=$this->input->post('tc016');
	   $tc016disp=$this->input->post('tc016disp');
	   $tc017=$this->input->post('tc017');
	   $tc018=$this->input->post('tc018');
	   $tc019=$this->input->post('tc019');
	   $tc020=$this->input->post('tc020');
	   $tc020disp=$this->input->post('tc020disp');
	   $tc022=$this->input->post('tc022');
	   $tc022disp=$this->input->post('tc022disp');
	   $tc024=$this->input->post('tc024');	
	   $tc025=$this->input->post('tc025');
	   $tc025disp=$this->input->post('tc025disp');
	   $tc025disp2=$this->input->post('tc025disp2');
	   $tc026=$this->input->post('tc026');
	   $tc026disp=$this->input->post('tc026disp');
	   $tc026disp2=$this->input->post('tc026disp2');	   
	  ?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="12%" >部門代號：</td>		
        <td class="normal14" width="44%" >
			<input type="text" id="cmsi05"   tabIndex="17"   onKeyPress="keyFunction()" onblur="check_cmsi05(this)" name="cmsi05" value="<?php echo $tc015; ?>"  size="12" />
			<a href="javascript:;"><img id="Showcmsi05disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
			<span id="cmsi05disp" > <?php    echo $tc015disp; ?> </span></td>
		</td>
		  
		  
	    <td class="normal14y" width="14%"  >業務員代號：</td>
        <td class="normal14" width="28%" >
			<input type="text" tabIndex="18"   onKeyPress="keyFunction()" id="cmsi09"  onblur="check_cmsi09(this)" name="cmsi09" value="<?php echo $tc016; ?>"  size="12" />
			<a href="javascript:;"><img id="Showcmsi09disp" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
			<span id="cmsi09disp"> <?php    echo $tc016disp; ?> </span></td>
		</td>
	  </tr>			  		  
		  
	  <tr>
	    <td class="normal14z" >收款單號：</td>		
        <td class="normal14"  >
			<input type="text" id="acri03" name="acri03"  tabIndex="19"   onKeyPress="keyFunction()"  onblur="check_acri03(this)"  name="tc017" value="<?php echo $tc017; ?>"  size="12" />
			<a href="javascript:;"><img id="Showacri03disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
			<input type="text" id="acri03disp"   tabIndex="20"   onKeyPress="keyFunction()"    name="acri03disp" value="<?php echo $tc018; ?>"  size="12" />
			<input type="text" id="acri03disp2"   tabIndex="21"   onKeyPress="keyFunction()"    name="acri03disp2" value="<?php echo $tc019; ?>"  size="12" />
		</td>
		<td class="normal14"></td>
		<td class="normal14"></td>
		<td></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14z" >票據科目：</td>		
        <td class="normal14"  >
			<input tabIndex="22" id="acti03" onKeyPress="keyFunction()" name="acti03" onblur="check_acti03(this);"  value="<?php echo $tc020; ?>"  type="text"   size="12" />
			<a href="javascript:;"><img id="Showacti03disp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
			<span id="acti03disp"> <?php echo $tc020disp; ?> </span>
		</td>
		
		<td class="normal14"></td>
		<td class="normal14"></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >對方科目：</td>
        <td class="normal14"  >
			<input tabIndex="23" id="acti03a" onKeyPress="keyFunction()" name="acti03a" onblur="check_acti03a(this);"  value="<?php echo $tc022; ?>"  type="text"   size="12" />
			<a href="javascript:;"><img id="Showacti03adisp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
			<span id="acti03adisp"> <?php echo $tc022disp; ?> </span>
		</td>
	  
		<td class="normal14"></td>
		<td class="normal14"></td>
	  </tr>	
	  
	  <tr>
		<td class="normal14z" >備註：</td>		
        <td class="normal14"  >
			<input type="text" id="tc024"   tabIndex="24"   onKeyPress="keyFunction()"    name="tc024" value="<?php echo $tc024; ?>"  size="12" />
		</td>
	  
		<td class="normal14"></td>
		<td class="normal14"></td>
	  </tr>
	  
	  <tr>
		<td class="normal14z" >託收銀行：</td>		
        <td class="normal14"  >
			<input type="text" id="tc025"   tabIndex="17"   onKeyPress="keyFunction()" readonly="value"   name="tc025" value="<?php echo $tc025; ?>"  size="12" style="background-color:#F0F0F0" />
			<input type="text" id="tc025disp"   tabIndex="17"   onKeyPress="keyFunction()"  readonly="value"  name="tc025disp" value="<?php echo $tc025disp; ?>"  size="12" style="background-color:#F0F0F0" />
			<input type="text" id="tc025disp2"   tabIndex="17"   onKeyPress="keyFunction()"  readonly="value"  name="tc025disp2" value="<?php echo $tc025disp2; ?>"  size="12" style="background-color:#F0F0F0" />
		</td>
      
		<td class="normal14"></td>
		<td class="normal14"></td>
	  </tr>
	  
	  <tr>
		<td class="normal14z" >轉付廠商：</td>		
		<td class="normal14"  >
			<input type="text" id="tc026"   tabIndex="17"   onKeyPress="keyFunction()" readonly="value"   name="tc026" value="<?php echo $tc026; ?>"  size="12" style="background-color:#F0F0F0" />
			<input type="text" id="tc026disp"   tabIndex="17"   onKeyPress="keyFunction()"  readonly="value"  name="tc026disp" value="<?php echo $tc026disp; ?>"  size="12" style="background-color:#F0F0F0" />
		</td>
	  
		<td class="normal14"></td>
		<td class="normal14"></td>
	  </tr>
	</table>
 
	</div> 	
	
	</div> <!-- </div>div-8 -->
	 </div> <!--</div>  div-7 -->
	 
	 <!-- 明細表頭  -->
	 <div style="width:100%; overflow-x: auto;  ">
        <table style="width:100%;"  id="order_product" class="list1">
        <thead>
           <tr>
              <td width="3%"></td>			
		      <?php foreach($usecol_array as $key => $val){
					echo "<td ";
					if(isset($val['width'])){
						echo "width='".$val['width']."' ";}
					if(isset($val['title_class'])){
						echo "class='".$val['title_class']."' ";}
					echo " >";
					echo $val['name'];
					echo "</td>";
				}?>
            </tr>
        </thead>
		     <?php $current_product_count = 0;//依照資料庫紀錄的明細先列一遍 新增只給初值 ?>
          <tfoot>
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="" /></td>
			  <td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
            </tr>
          </tfoot>
       </table>
	</div> 	
	<!-- 合計     -->
	<!--	     <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span></span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　訂單金額：</b></td>
				<td ><input type='text' readonly="value" name='tc029' id="tc029" size="8" value="<?php echo $tc029; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　稅額：</b></td>
				<td ><input type='text' readonly="value" name='tc030' id="tc030" size="8" value="<?php echo $tc030; ?>"  style="background-color:#F0F0F0" /></td>
			
				<td class="right" valign="top"><b style="color: #003A88;">　　合計金額：</b></td>
				<td ><input type='text' readonly="value" name="tc2930" id="tc2930" size="8" value="<?php echo $tc029+$tc030; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總數量：</b></td>
				<td ><input type='text' readonly="value" name='tc031' id="tc031" size="8" value="<?php echo $tc031; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總毛重：</b></td>
				<td ><input type='text' readonly="value" name='tc043' id="tc043" size="8" value="<?php echo $tc043; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總材積：</b></td>
				<td ><input type='text' readonly="value" name='tc044' id="tc044" size="8" value="<?php echo $tc044; ?>"  style="background-color:#F0F0F0" /></td>
			
					<input id="select_rows" style="display:none;"/>
				<td class="left" valign="top"></td>
              </tr>
	-->
		<!-- 合計     -->	  
	 <!--<div class="buttons">
	   <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti04/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div> --> 
   </div> 	<!-- end 頁標籤 -->   
   </form>
	   <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位,交貨庫別,可輸入部份品號或品名下拉視窗選擇,圖示1客戶商品計價查詢,欄位淡黃色按2下開視窗查詢,按Enter鍵或Tab鍵跳下一個欄位,Alt+y跳到明細資料, Alt+w新增一筆明細. ] ' ?> </div>  <?php } ?>
	
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
   
	</div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->

<?php  include_once("./application/views/funnew/copi01a_funmjs_v.php"); ?>  <!-- 客戶回傳多欄 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->
<?php  include_once("./application/views/funnew/noti01a_funmjs_v.php"); ?>  <!-- 銀行帳戶 -->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?>  <!-- 部門 -->
<?php  include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?>  <!-- 人員 -->
<?php  include_once("./application/views/funnew/acri03_funmjs_v.php"); ?>  <!-- 收款單 -->
<?php  include_once("./application/views/funnew/acti03_funmjs_v.php"); ?>  <!-- 票據科目 -->
<?php  include_once("./application/views/funnew/acti03a_funmjs_v.php"); ?>  <!-- 票據科目 -->

<?php  include_once("./application/views/funnew/noti04a_funmjs_v.php"); ?>  <!-- 託收 -->
<?php  include_once("./application/views/funnew/noti04b_funmjs_v.php"); ?>  <!-- 轉付 -->
<?php  include_once("./application/views/funnew/noti04c_funmjs_v.php"); ?>  <!-- 退票 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/noti04_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	//$(document).ready(function(){ 	   
	//$('#copi03').focus();
	//}); 
	
function clean_noti01a(){
	$('#noti01a').val('');
	$('#noti01adisp').val('');
	$('#noti01adisp2').val('');
}
</script> 	 
	
