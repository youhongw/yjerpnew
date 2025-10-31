<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div> -->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?> 
    </div>

<div id="content"> <!-- div-3 --> 
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 會計傳票建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#acti02').focus();" type='submit' onclick="return checkbalance();" tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('act/acti10/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/act/acti10/addsave" >	
	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  if(!isset($ta001)) { $ta001=$this->input->post('ta001'); }
	  if(!isset($ta001disp)) { $ta001disp=$this->input->post('ta001'); }
      $ta002=$this->input->post('ta002');
	  if(!isset($ta003)) { $ta003=date("Y/m/d"); } else {$ta003=$this->input->post('ta003');}
	  $actq03a=$this->input->post('ta004'); 
	  $actq03adisp=$this->input->post('ta004'); 
      IF (!isset($cmsq06a)) { $cmsq06a=$this->session->userdata('sysma003');}
	  $cmsq06adisp=$this->input->post('ta005');
	  $ta005=$this->input->post('ta005');
	  $ta006=$this->input->post('ta006');
	  //借貸歸零
	  $ta007=0;
	  $ta008=0;
	  
	  $ta009=$this->input->post('ta009');
	  $ta010=$this->input->post('ta010');
	  $ta011=$this->input->post('ta011');
	  $ta013=$this->input->post('ta013');
	 // $ta014=$this->input->post('ta014');
	 // $ta015=$this->input->post('ta015');
	 
	  if(!isset($ta010)) { $ta010='Y'; }
	  if(!isset($ta011)) { $ta011='N'; }	
	  if(!isset($ta012)) { $ta012=0; }
	  if(!isset($ta016)) { $ta016='N'; }	
	  if(!isset($ta015)) { $ta015=$username; }
	  if(!isset($creator)) { $creator=$username; }
	  if(!isset($ta014)) { $ta014=date("Y/m/d"); }
	  if(!isset($create_date)) { $create_date=date("Y/m/d"); }
	  
	   $ta201=$this->input->post('ta201');            //印章
	   if(!isset($userfile)) { $userfile=$this->input->post('userfile'); }
	  $imgdisp='';
	  if(!isset($userfile)) { $userfile='image.jpg'; }
	  $uploadfile='image.jpg';
	?>
   
	<table class="form14"  >     <!-- 頭部表格 onDblClick onChange="chkno1(this)" -->
	  <tr>
	    <td class="normal14y"  width="10%"><span class="required">傳票單別：</span> </td>
        <td class="normal14a"  width="22%"><input tabIndex="1" id="acti02"    onKeyPress="keyFunction()" ondblclick="search_acti02_window()"  name="ta001" onfocus="check_title_no();" onchange="check_acti02(this);check_title_no();"  value="<?php echo $ta001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showacti02disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="acti02disp"> <?php    echo $ta001disp; ?> </span></td>
	    <td class="normal14y" width="10%" >單據日期：</td>
        <td class="normal14a"  width="24%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"  onfocus="this.select();"  id="ta003" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="ta003"  value="<?php echo $ta003; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(ta003,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		<td class="normal14y" width="10%" ><span class="required">傳票單號：</span> </td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="ta002" onKeyPress="keyFunction()" readonly="value" name="ta002" onfocus="check_title_no();" value="<?php echo $ta002; ?>" size="12" type="text" required /></td>
	  </tr>	
	  
	<!--  <tr>
		 <td class="normal14">收支科目：</td>
         <td  class="normal14"  ><input tabIndex="4" id="ta004" readonly="value" onKeyPress="keyFunction()" onfocus="chkno1(this)" onchange="startactq03a(this)" name="actq03a" value="<?php echo $actq03a; ?>" size="10" type="text"  style="background-color:#EBEBE4" /><a href="javascript:;"><img id="Showactq03a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="actq03adisp"> <?php // echo $actq03adisp; ?> </span></td>
	     <td class="normal14" >總號：</td>
        <td class="normal14a" ><input tabIndex="5" id="ta005"   onKeyPress="keyFunction()"  name="ta005" value="<?php echo $ta005; ?>" size="10" type="text"    /></td>
		 <td class="normal14" >複製分類：</td>
        <td class="normal14a" ><input tabIndex="6" id="ta013"   onKeyPress="keyFunction()"  name="ta013" value="<?php echo $ta013; ?>" size="10" type="text"   /></td>
		
	  </tr> -->
	  <tr>
		 <td class="normal14z">備註：</td>
        <td  class="normal14"  ><input tabIndex="7" id="ta009"  onfocus="check_title_no();" onKeyPress="keyFunction()"  name="ta009" value="<?php echo $ta009; ?>" size="20" type="text"   /></td>
	     <td class="normal14z" >登入人員：</td>
        <td class="normal14a" ><input tabIndex="8" id="creator"  readonly="value" onKeyPress="keyFunction()"  name="creator" value="<?php echo $creator; ?>" size="10" type="text"   style="background-color:#EBEBE4" /></td>
		 <td class="normal14z" >登入日期：</td>
        <td class="normal14a" ><input tabIndex="9" id="create_date"  readonly="value" onKeyPress="keyFunction()"  name="create_date" value="<?php echo $create_date; ?>" size="10" type="text"   style="background-color:#EBEBE4" /></td>
		
	  </tr>
	   <tr>
		 <td class="normal14z">來源碼：</td>
        <td  class="normal14"  ><select id="ta006" onKeyPress="keyFunction()" name="ta006"  tabIndex="10">
            <option <?php if($ta006 == '1') echo 'selected="selected"';?> value='1'>1:一般傳票輸入</option>                                                                        
		    <option <?php if($ta006 == '2') echo 'selected="selected"';?> value='2'>2:應計傳票輸入</option>
			<option <?php if($ta006 == '3') echo 'selected="selected"';?> value='3'>3:應計回轉</option>
			<option <?php if($ta006 == '4') echo 'selected="selected"';?> value='4'>4:常用傳票複製</option>
			<option <?php if($ta006 == '5') echo 'selected="selected"';?> value='5'>5:比率分攤</option>
			<option <?php if($ta006 == '6') echo 'selected="selected"';?> value='6'>6:迴轉傳票</option>
			<option <?php if($ta006 == '7') echo 'selected="selected"';?> value='7'>7:紅字沖銷傳票</option>
			<option <?php if($ta006 == '8') echo 'selected="selected"';?> value='8'>8:其他轉入</option>
			<option <?php if($ta006 == 'A') echo 'selected="selected"';?> value='A'>A:票據系統產生</option>
			<option <?php if($ta006 == 'B') echo 'selected="selected"';?> value='B'>B:固定資產產生</option>
			<option <?php if($ta006 == 'C') echo 'selected="selected"';?> value='C'>C:應收系統產生</option>
			<option <?php if($ta006 == 'D') echo 'selected="selected"';?> value='D'>D:應付系統產生</option>
			<option <?php if($ta006 == 'E') echo 'selected="selected"';?> value='E'>E:庫存系統產生</option>
			<option <?php if($ta006 == 'F') echo 'selected="selected"';?> value='F'>F:訂單系統產生</option>
			<option <?php if($ta006 == 'G') echo 'selected="selected"';?> value='G'>G:採購系統產生</option>
			<option <?php if($ta006 == 'H') echo 'selected="selected"';?> value='H'>H:製令系統產生</option>
			<option <?php if($ta006 == 'J') echo 'selected="selected"';?> value='J'>J:專櫃系統產生</option>
		  </select></td>
		 <td class="normal14z" >過帳碼：</td>
        <td class="normal14a" ><input type="hidden" name="ta011" value="N" />
		<input type='checkbox' tabIndex="11" id="ta011"  readonly="value" onKeyPress="keyFunction()" name="ta011" <?php if($ta011 == 'Y' ) echo 'checked'; ?>  <?php if($ta011 !== 'Y' ) echo 'check'; ?> value="Y" size="1" style="background-color:#EBEBE4" /></td> 
		 <td class="normal14z" >列印次數：</td>
        <td class="normal14a" ><input tabIndex="12" id="ta012"  readonly="value" onKeyPress="keyFunction()"  name="ta012" value="<?php echo $ta012; ?>" size="10" type="text"   style="background-color:#EBEBE4" /></td>
		
	  </tr>
		
	  <tr>
	     <td class="normal14z">確認碼：</td>
        <td  class="normal14"  ><select id="ta010" onKeyPress="keyFunction()" name="ta010" onChange="selappr(this)" tabIndex="13">
            <option <?php if($ta010 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($ta010 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($ta010 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>
	     <td class="normal14z">確認者：</td>
        <td  class="normal14"  ><input tabIndex="14" id="ta015" readonly="value" onKeyPress="keyFunction()"  name="ta015" value="<?php echo $ta015; ?>" size="10" type="text" style="background-color:#EBEBE4"  /></td>
  
		 <td class="normal14z">簽核狀態：</td>
        <td  class="normal14"  ><select id="ta016" tabIndex="15" readonly="value" onKeyPress="keyFunction()" name="ta016"   style="background-color:#EBEBE4" >
            <option <?php if($ta016 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($ta016 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($ta016 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($ta016 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($ta016 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($ta016 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($ta016 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($ta016 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
	  </tr>	
	 <tr>
	    <td class="normal14z" >確認日期：</td>
        <td class="normal14" ><input tabIndex="16" id="ta014" readonly="value"  onKeyPress="keyFunction()"  name="ta014" value="<?php echo $ta014; ?>" size="12" type="text" style="background-color:#EBEBE4"  /></td>
		<td class="normal14" ></td>						
        <td  class="normal14"  ></td> 
	    <td class="normal14" ></td>						
        <td  class="normal14"  ></td>
	  </tr>
	</table>
	
	<div>
	<!--<div class="abgne_tab"> <!-- div-6 -->
	
	
	<!--  憑單資料 -->
	 
	 
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
		 
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" AccessKey="z" onclick="addItem();" /></td>
			  <td class="left" colspan="14"></td>
            </tr>
          </tfoot>
       </table>
	</div> 	
	<!-- 合計     -->
		     <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span>
				</span></td>
			<!--	<td class="right" valign="top"><b style="color: #003A88;">　　　　　總經理：</b></td>
				<td ><input type='text' readonly="value" name='ta015' id="ta015" size="12" value="<?php echo $ta015; ?>"   /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　　　主管：</b></td>
				<td ><input type='text' readonly="value" name='ta015' id="ta015" size="12" value="<?php echo $ta015; ?>"   /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　　　製表：</b></td>
				<td ><input type='text' readonly="value" name='ta015' id="ta015" size="12" value="<?php echo $ta015; ?>"   /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　　　請款人：</b></td>
				<td ><img src="<?php echo base_url();?>assets/image/jpg/<?php echo $uploadfile;?>" style="padding-top:5px"  id="ad" width="60" height="60" border="0" style="padding:5px"/></td>
				<td class="normal14">選擇印章：</td>
                <td class="normal14"><input type="file" name="userfile"  tabIndex="26" id="ta201"  onKeyPress="keyFunction()"  value="<?php echo $userfile; ?>"  size="30" onchange="pre_pic(this);" /></td>
		        <td class="normal14"><input type="hidden" name="MAX_FILE_SIZE" value="2000000"></td>
                <td class="normal14"></td>
				<br><br> -->
				
				<td class="right" valign="top"><b style="color: #003A88;">　　　　　本幣借方金額：</b></td>
				<td ><input type='text' readonly="value" name='ta007' id="ta007" size="8" value="<?php echo $ta007; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　　　　本幣貸方金額：</b></td>
				<td ><input type='text' readonly="value" name='ta008' id="ta008" size="8" value="<?php echo $ta008; ?>"  style="background-color:#EBEBE4" /></td>
				<input id="select_rows" style="display:none;"/>
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	  
	<!-- <div class="buttons">
	 <button type='submit' onclick="return checkbalance();" tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('act/acti10/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	 </div> -->
		</div>
		
    </form>
	   <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 有底色欄位,快按2下,可開視窗,Alt+y 跳至明細, Alt+w或Alt+↓ 新增明細,借方輸入1按Enter鍵,借方輸入-按Enter鍵,按Enter鍵或Tab鍵跳下一個欄位. ] ' ?> </div>  <?php } ?>
	
    </div> <!-- div-6 -->
	
  </div> <!-- div-5 -->
 
</div> <!-- div-4 -->

 
   
	</div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
     <?php // include_once("./application/views/fun/acti10_funjs_v.php"); ?> 
<?php  include_once("./application/views/funnew/acti02_funmjs_v.php"); ?> <!-- 會計單別 -->
	 
<?php  include_once("./application/views/funnew/erpacc_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/acti10_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
	