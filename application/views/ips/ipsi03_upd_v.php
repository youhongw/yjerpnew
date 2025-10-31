 <?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'ta003' || $key == 'ta070'){
		$$key = stringtodate("Y/m/d",$val);   //自訂函數 main_head_v
	}
	
}
$body_data = $result['body_data'];
$data_count = count($body_data);
/*echo "<pre>";
//var_dump($col_array);
//var_dump($body_data);
var_dump($usecol_array);
echo "</pre>";*/
  //預設稅率,廠別
  $stax_rate = $this->session->userdata('sysma004');
  $sysma200 = $this->session->userdata('sysma200');
?>
 <div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div> -->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?> 
    </div>

<div id="content"> <!-- div-3 --> 
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 預付購料變更建立作業 - 修改</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ips/ipsi03/updsave" method="post" enctype="multipart/form-data" >
	<div id="tab-general"> <!-- div-6 -->
	
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="10%"><span class="required">單別：</span></td>   <!--onchange="startipsi02(this);check_title_no();"    -->
        <td class="normal14a"  width="24%"><input tabIndex="1" id="ipsi02"  ondblclick=""  onKeyPress="keyFunction()"   name="tc001" onfocus="selverify();" onchange=""  value="<?php echo $tc001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="#Showipsi02disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="ipsi02disp"> <?php    echo $tc001disp; ?> </span></td>
	    <td class="normal14a" width="8%" >單據日期： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tc025" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tc025"  value="<?php echo $tc025; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tc025,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	    <td class="start14a" width="10%"><span class="required">單號/版次：</span></td>
        <td class="normal14a" width="23%"><input tabIndex="3" id="tc002" onKeyPress="keyFunction()"  name="tc002" onfocus="" value="<?php echo $tc002; ?>" size="12" type="text" required />
		<input tabIndex="3" id="tc003" onKeyPress="keyFunction()"  name="tc003" onfocus="" value="<?php echo $tc003; ?>" size="6" type="text" style="text-align:right;"  /></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a">廠商代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="puri01" onKeyPress="keyFunction()" ondblclick="search_puri01_window()"  onchange="check_puri01(this)" name="tc029" value="<?php echo $tc029; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showpuri01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="puri01disp"> <?php   echo $tc029disp; ?> </span></td>
	    <td class="normal14">L/C單號：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5"   onKeyPress="keyFunction()" id="tc006" name="tc006"   value="<?php echo $tc006; ?>"  size="12" /></td>
	    <td class="normal14">變更日期：</td>
        <td  class="normal14"  ><input type="text" tabIndex="6" readonly="value"  onKeyPress="keyFunction()" id="tc004" name="tc004"   value="<?php echo $tc004; ?>" size="12"  style="background-color:#F0F0F0"/></td>
	    
	  </tr>
	  
	  <tr>
	    <td class="normal14">簽核狀態：</td>
        <td class="normal14"  ><select id="tc027" tabIndex="7" readonly="value" onKeyPress="keyFunction()" name="tc027"   style="background-color:#F0F0F0" >
            <option <?php if($tc027 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($tc027 == '0') echo 'selected="selected"';?> value='0'>0.待處理</option>
            <option <?php if($tc027 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($tc027 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($tc027 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($tc027 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($tc027 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($tc027 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
        <td class="normal14">確認碼：</td>
        <td  class="normal14"  ><select id="verify" onKeyPress="keyFunction()" name="tc010" onChange="selverify(this)" tabIndex="8">
            <option <?php if($tc010 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tc010 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tc010 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>
	     <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="9" readonly="value"  onKeyPress="keyFunction()" id="tc026" name="tc026"   value="<?php echo $tc026; ?>" style="background-color:#F0F0F0" size="12" /></td>
	    
	</table>
	
	<div class="abgne_tab"> <!-- div-6 頁標籤 -->
		<ul class="tabs">
		  <li><a href="#tab1"  accesskey="a">變更資料a</a></li>
		  <li><a href="#tab2"  accesskey="b">原資料b</a></li>
		  <li><a href="#tab3"  accesskey="i">銀行資料i</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  交易資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	  
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a" width="9%" >開狀幣別：</td>
        <td class="normal14a" width="41%" ><input tabIndex="10" id="cmsi06" ondblclick="search_cmsi06_window()" onKeyPress="keyFunction()" name="tc028" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $tc028; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $tc028disp; ?> </span></td>
	    <td class="normal14a" width="9%">開狀匯率：</td>		
        <td class="normal14a" width="41%" ><input type="text" id="exchange_rate"   tabIndex="11"   onKeyPress="keyFunction()"    name="tc011" value="<?php echo $tc011; ?>"  size="12" /></td>
	      </tr>
	  <tr>
	    <td class="normal14">修改金額：</td>						
        <td class="normal14" ><input type="text" tabIndex="12"   onKeyPress="keyFunction()" id="tc012" name="tc012"     value="<?php echo $tc012; ?>"    />
           </td>
		<td class="normal14" >自籌比率：</td>						
        <td class="normal14" ><input type="text" tabIndex="13"   onKeyPress="keyFunction()" id="tc013" name="tc013"     value="<?php echo $tc013; ?>"    /></td>
	  </tr>	
	  <tr>
	    <td class="normal14">原幣自籌額：</td>						
        <td class="normal14" ><input type="text" tabIndex="14"   onKeyPress="keyFunction()" id="tc014" name="tc014"     value="<?php echo $tc014; ?>"  style="background-color:#F0F0F0"  />
           </td>
		<td class="normal14" >自籌金額：</td>						
        <td class="normal14" ><input type="text" tabIndex="15"   onKeyPress="keyFunction()" id="tc01819" name="tc015"     value="<?php echo $tc015; ?>"    /></td>
	  </tr>	
	   <tr>
	    <td class="normal14">變更原因：</td>						
        <td class="normal14" ><input type="text" tabIndex="16"   onKeyPress="keyFunction()" id="tc007" name="tc007"     value="<?php echo $tc007; ?>"   />
           </td>
		<td class="normal14" >備註：</td>						
        <td class="normal14" ><input type="text" tabIndex="17"   onKeyPress="keyFunction()" id="tc008" name="tc008"     value="<?php echo $tc008; ?>"    /></td>
	  </tr>	
	    <tr>
	    <td class="normal14">手續費：</td>						
        <td class="normal14" ><input type="text" tabIndex="18"   onKeyPress="keyFunction()" id="tc016" name="tc016"     value="<?php echo $tc016; ?>"    />
           </td>
		<td class="normal14" >保險費：</td>						
        <td class="normal14" ><input type="text" tabIndex="19"   onKeyPress="keyFunction()" id="tc017" name="tc017"     value="<?php echo $tc017; ?>"    /></td>
	  </tr>	
	   <tr>
	    <td class="normal14">簽證費：</td>						
        <td class="normal14" ><input type="text" tabIndex="20"   onKeyPress="keyFunction()" id="tc018" name="tc018"     value="<?php echo $tc018; ?>"   />
           </td>
		<td class="normal14" >郵電費：</td>						
        <td class="normal14" ><input type="text" tabIndex="21"   onKeyPress="keyFunction()" id="tc019" name="tc019"     value="<?php echo $tc019; ?>"    /></td>
	  </tr>	
	   <tr>
	    <td class="normal14">雜項費用：</td>						
        <td class="normal14" ><input type="text" tabIndex="22"   onKeyPress="keyFunction()" id="tc020" name="tc020"     value="<?php echo $tc020; ?>"   />
           </td>
		<td class="normal14" >其他費用：</td>						
        <td class="normal14" ><input type="text" tabIndex="23"   onKeyPress="keyFunction()" id="tc021" name="tc021"     value="<?php echo $tc021; ?>"    /></td>
	  </tr>	
	   <tr>
	    <td class="normal14">費用合計：</td>						
        <td class="normal14" ><input type="text" tabIndex="24"   onKeyPress="keyFunction()" id="tc01621" name="tc01621"     value="<?php echo $tc016+$tc017+$tc018+$tc019+$tc020+$tc021; ?>"  style="background-color:#F0F0F0"  />
           </td>
		<td class="normal14" ></td>						
        <td class="normal14" ></td>
	  </tr>	
	</table>
	</div>
	
	<!--  發票 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	    
	 <tr>
	    <td class="normal14a" width="9%" >開狀銀行：</td>
        <td class="normal14a" width="41%" ><input tabIndex="25" id="noti01" ondblclick="search_noti01_window()" onKeyPress="keyFunction()" name="tc127" onblur="check_noti01(this);check_rate(this);"  value="<?php echo $tc127; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Shownoti01disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="noti01disp"> <?php    echo $tc127disp; ?> </span></td>
	    <td class="normal14a" width="9%">開狀日期：</td>		
        <td class="normal14a" width="41%" ><input type="text"    tabIndex="26"   onKeyPress="keyFunction()"    name="tc126" value="<?php echo $tc126; ?>"  size="12" /></td>
	      </tr>
	  <tr>
	    <td class="normal14">額度別：</td>						
        <td class="normal14" ><input type="text" tabIndex="27"   onKeyPress="keyFunction()" id="tc128" name="tc128"     value="<?php echo $tc128; ?>"    />
           </td>
		<td class="normal14" >遠期天數：</td>						
        <td class="normal14" ><input type="text" tabIndex="28"   onKeyPress="keyFunction()" id="tc129" name="tc129"     value="<?php echo $tc129; ?>"    /></td>
	  </tr>	
	  <tr>
	    <td class="normal14">有效日期：</td>						
        <td class="normal14" ><input type="text" tabIndex="29" readonly="readonly"  onKeyPress="keyFunction()" id="tc130" name="tc130"     value="<?php echo $tc130; ?>"  style="background-color:#F0F0F0"  />
           </td>
		<td class="normal14" >許可證號：</td>						
        <td class="normal14" ><input type="text" tabIndex="30" readonly="readonly"  onKeyPress="keyFunction()" id="tc131" name="tc131"     value="<?php echo $tc131; ?>"  style="background-color:#F0F0F0"  /></td>
	  </tr>	
	   <tr>
	    <td class="normal14">廠別：</td>						
        <td class="normal14" ><input type="text" tabIndex="31" readonly="readonly"  onKeyPress="keyFunction()" id="tc132" name="tc132"     value="<?php echo $tc132; ?>"  style="background-color:#F0F0F0"  />
           </td>
		<td class="normal14" >裝船期限：</td>						
        <td class="normal14" ><input type="text" tabIndex="32" readonly="readonly"  onKeyPress="keyFunction()" id="tc133" name="tc133"     value="<?php echo $tc133; ?>"  style="background-color:#F0F0F0"  /></td>
	  </tr>	
	    <tr>
	    <td class="normal14">運送方式：</td>						
        <td class="normal14" ><input type="text" tabIndex="33" readonly="readonly"  onKeyPress="keyFunction()" id="tc134" name="tc134"     value="<?php echo $tc134; ?>"  style="background-color:#F0F0F0"  />
           </td>
		<td class="normal14" >結案碼：</td>						
        <td class="normal14" ><input type="text" tabIndex="34" readonly="readonly"  onKeyPress="keyFunction()" id="tc138" name="tc138"     value="<?php echo $tc138; ?>"  style="background-color:#F0F0F0"  /></td>
	  </tr>	
	   <tr>
	    <td class="normal14">E.T.D：</td>						
        <td class="normal14" ><input type="text" tabIndex="35" readonly="readonly"  onKeyPress="keyFunction()" id="tc135" name="tc135"     value="<?php echo $tc135; ?>"  style="background-color:#F0F0F0"  />
           </td>
		<td class="normal14" >E.T.A：</td>						
        <td class="normal14" ><input type="text" tabIndex="36" readonly="readonly"  onKeyPress="keyFunction()" id="tc136" name="tc136"     value="<?php echo $tc136; ?>"  style="background-color:#F0F0F0"  /></td>
	  </tr>	
	  <tr>
	    <td class="normal14">列印次數：</td>						
        <td class="normal14" ><input type="text" tabIndex="37" readonly="readonly"  onKeyPress="keyFunction()" id="tc137" name="tc137"     value="<?php echo $tc137; ?>"  style="background-color:#F0F0F0"  />
           </td>
		<td class="normal14" ></td>						
        <td class="normal14" ></td>
	  </tr>	
	</table>
 
	</div> 	
	<!--  費用 -->
	<div id="tab3" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="10%">原開狀匯率：</td>
        <td class="normal14a"  width="40%" ><input type="text" tabIndex="30" readonly="readonly"  onKeyPress="keyFunction()" id="tc111" name="tc111"   value="<?php echo $tc111; ?>" style="background-color:#F0F0F0"  />
	    <td class="normal14a"  width="10%" >原修改金額：</td>
        <td class="normal14a"  width="40%" ><input type="text" tabIndex="31" readonly="readonly"  onKeyPress="keyFunction()" id="tc112" name="tc112"     value="<?php echo $tc112; ?>"   style="background-color:#F0F0F0" /></td>
	  </tr>			  
	 <tr>
	    <td class="normal14">原自籌比率：</td>						
        <td class="normal14" ><input type="text" tabIndex="32" readonly="readonly"  onKeyPress="keyFunction()" id="tc113" name="tc113"     value="<?php echo $tc113; ?>"   style="background-color:#F0F0F0" />
           </td>
		<td class="normal14" >原幣自籌額：</td>						
        <td class="normal14" ><input type="text" tabIndex="33" readonly="readonly"  onKeyPress="keyFunction()" id="tc114" name="tc114"     value="<?php echo $tc114; ?>"  style="background-color:#F0F0F0"  /></td>
	  </tr>	
	   <tr>
	    <td class="normal14">原自籌額：</td>						
        <td class="normal14" ><input type="text" tabIndex="32" readonly="readonly"  onKeyPress="keyFunction()" id="tc115" name="tc115"     value="<?php echo $tc115; ?>"   style="background-color:#F0F0F0" />
           </td>
		<td class="normal14" >原手續費：</td>						
        <td class="normal14" ><input type="text" tabIndex="33" readonly="readonly"  onKeyPress="keyFunction()" id="tc116" name="tc116"     value="<?php echo $tc116; ?>"  style="background-color:#F0F0F0"  /></td>
	  </tr>	
	   <tr>
	    <td class="normal14">原保險費：</td>						
        <td class="normal14" ><input type="text" tabIndex="32" readonly="readonly"  onKeyPress="keyFunction()" id="tc117" name="tc117"     value="<?php echo $tc117; ?>"   style="background-color:#F0F0F0" />
           </td>
		<td class="normal14" >原簽證費：</td>						
        <td class="normal14" ><input type="text" tabIndex="33" readonly="readonly"  onKeyPress="keyFunction()" id="tc118" name="tc118"     value="<?php echo $tc118; ?>"  style="background-color:#F0F0F0"  /></td>
	  </tr>	
	   <tr>
	    <td class="normal14">原郵電費：</td>						
        <td class="normal14" ><input type="text" tabIndex="32" readonly="readonly"  onKeyPress="keyFunction()" id="tc119" name="tc119"     value="<?php echo $tc119; ?>"   style="background-color:#F0F0F0" />
           </td>
		<td class="normal14" >原雜項費：</td>						
        <td class="normal14" ><input type="text" tabIndex="33" readonly="readonly"  onKeyPress="keyFunction()" id="tc120" name="tc120"     value="<?php echo $tc120; ?>"  style="background-color:#F0F0F0"  /></td>
	  </tr>	
	  <tr>
	    <td class="normal14">原其他費：</td>						
        <td class="normal14" ><input type="text" tabIndex="34" readonly="readonly"  onKeyPress="keyFunction()" id="tc121" name="tc121"     value="<?php echo $tc121; ?>"  style="background-color:#F0F0F0"  />
           </td>
		<td class="normal14" >原費用合計：</td>						
        <td class="normal14" ><input type="text" tabIndex="35" readonly="readonly"  onKeyPress="keyFunction()" id="tc117121" name="tc117121"     value="<?php echo $tc117+$tc118+$tc119+$tc120+$tc121; ?>"  style="background-color:#F0F0F0"  /></td>
	  </tr>	
	 
	</table>
	</div> 	
	
	</div> <!-- </div>div-8 -->
	 </div> <!--</div>  div-7 -->
	 
	<!-- 合計     -->
		     
		<!-- 合計     -->	
	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();totalSum();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ips/ipsi03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
	  ?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('ips/ipsi03/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
	  <?php } ?>
	  <?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
	  ?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('ips/ipsi03/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
	  <?php } ?>	
	  </div> 
	  </div> <!-- div-加 -->
    </form>  <!-- end 表單 -->
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,欄位淡黃色按2下開視窗查詢,圖示1客戶商品計價查詢,Alt+y跳到明細資料, Alt+w新增一筆明細. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

 
    </div> <!-- div-3 --> 
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
<form action="<?php echo base_url()?>index.php/ips/ipsi03/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
			<input id="del_md001" name="del_md001" />
			<input id="del_md002" name="del_md002" />
			<input id="del_md003" name="del_md003" />
		</form>
		
<?php  include_once("./application/views/funnew/ipsi02_funmjs_v.php"); ?> <!-- 單別 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/puri01_funmjs_v.php"); ?>  <!-- 廠商 -->
<?php  include_once("./application/views/funnew/noti01_funmjs_v.php"); ?>  <!-- 銀行 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->

<?php  include_once("./application/views/funnew/erp_funjs_one_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/ipsi03_fundjs_v.php"); ?>  <!-- 流水號明細開視窗 --> 