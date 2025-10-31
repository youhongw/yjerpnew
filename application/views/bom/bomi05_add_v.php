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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 組合單資料建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#td001').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('bom/bomi05/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 <a  href="javascript:;"><span class="button"  >BOM展開方式</span><img id="Showbomc02a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="BOM展開方式" title="BOM展開方式"  align="top"/></a>
	</div>
	 </div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/bom/bomi05/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  $td001=$this->input->post('td001'); 
	  $td001disp=$this->input->post('td001'); 
      $td002=$this->input->post('td002');
	
	  if(!isset($td003)) { $td003=date("Y/m/d"); }
	  $td004=$this->input->post('td004');
	  $td004disp=$this->input->post('td004');
	  $td004disp1=$this->input->post('td004');
	  $td005=$this->input->post('td005');
	  $td006=$this->input->post('td006');
	  $td007=$this->input->post('td007');
	  $td008=$this->input->post('td008');
	  $td009=$this->input->post('td009');
	  $td200=$this->input->post('td200');
	  $td201=$this->input->post('td201');
	  $td010=$this->input->post('td010');
	  $td010disp=$this->input->post('td010');
	  $td011=$this->input->post('td011');
	  if(!isset($td012)) { $td012='Y'; }
	  if(!isset($td013)) { $td013=0; }
	   if(!isset($td014)) { $td014=date("Y/m/d"); }
	   if(!isset($td015)) { $td015=$this->session->userdata('manager'); }
	    if(!isset($td016)) { $td016='N'; } 
	   $td017=$this->input->post('td017');
	   if(!isset($td018)) { $td018=date("Y/m/d"); }
	  $td019=$this->input->post('td019');
	   $td200=0;
	   $td201=0;
	   
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="10%"><span class="required">組合單別：</span> </td>
        <td class="normal14a"  width="22%"><input tabIndex="1" id="bomi03"    onKeyPress="keyFunction()" ondblclick="search_bomi03_window()"  name="td001"  onchange="check_bomi03(this);check_title_no();"  value="<?php echo $td001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showbomi03disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="bomi03disp"> <?php    echo $td001disp; ?> </span></td>
	    <td class="normal14y" width="10%" >單據日期： </td>
        <td class="normal14a"  width="24%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="td014" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="td014"  value="<?php echo $td014; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(td014,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		 <td class="normal14y" width="10%" ><span class="required">組合單號：</span> </td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="td002" onKeyPress="keyFunction()" onfocus="check_title_no();" name="td002" value="<?php echo $td002; ?>" size="20" type="text" required /></td>
	  </tr>		
		  
	  <tr>
		 <td class="normal14z">成品品號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="invi02" onKeyPress="keyFunction()" onfocus="check_title_no();" ondblclick="search_invi02_window();" name="td004" value="<?php echo $td004; ?>" size="20" type="text" required />
		<a href="javascript:;"><img id="Showinvi02disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="invi02disp"><?php    echo $td004disp; ?> </span></td>
        <td class="normal14z" >品名：</td>
        <td class="normal14a" ><input tabIndex="5" id="td004disp" onKeyPress="keyFunction()"  name="td004disp" value="<?php echo $td004disp; ?>" size="30" type="text" style="background-color:#EBEBE4" /></td>	 
         <td class="normal14z" >規格：</td>
        <td class="normal14a" ><input tabIndex="6" id="td004disp1" onKeyPress="keyFunction()"  name="td004disp1" value="<?php echo $td004disp1; ?>" size="30" type="text" style="background-color:#EBEBE4" /></td>	 	
	</tr>
		<tr>
	    <td class="normal14z" >單位：</td>
        <td class="normal14a" ><input tabIndex="7" id="td005" onKeyPress="keyFunction()"  name="td005" value="<?php echo $td005; ?>" size="10" type="text"  /></td>
	    <td class="normal14z">成品數量：</td>
       <td class="normal14a" ><input tabIndex="8" id="td007" onKeyPress="keyFunction()"  name="td007" value="<?php echo $td007; ?>" size="10" type="text"  /></td>
	    <td class="normal14z">入庫庫別：</td>
       <td class="normal14a" ><input tabIndex="1" id="cmsi03"    onKeyPress="keyFunction()" ondblclick="search_cmsi03_window()"  name="td010"  onchange="check_cmsi03(this);"  value="<?php echo $td010; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcmsi03disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="cmsi03disp"> <?php    echo $td010disp; ?> </span></td>
	  
	  </tr>
	    <tr>
	     <td class="normal14z">備註：</td>
       <td class="normal14a" ><input tabIndex="10" id="td011" onKeyPress="keyFunction()"  name="td011" value="<?php echo $td011; ?>" type="text"  /></td>
	   <td class="normal14z">確認碼：</td>
          <td  class="normal14"  ><select id="td012" onKeyPress="keyFunction()" name="td012" onChange="selappr(this)" tabIndex="11">
            <option <?php if($td012 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($td012 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($td012 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td> 
		<td class="normal14z" >列印：</td>
        <td class="normal14a" ><input tabIndex="12" id="td013" onKeyPress="keyFunction()"  name="td013" value="<?php echo $td013; ?>" size="10" type="text" style="background-color:#EBEBE4" /></td>
		<!--  <td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php // echo  $sysma200; ?>" /></td>
         <td  class="normal14"  ><input type='hidden' name='sysma201' id='sysma201' value="<?php  // echo $sysma201; ?>" /></td>
		   <td class="start14"><input type='hidden' name='td200' id='td200' value="<?php // echo $td200; ?>" /></td>
         <td  class="normal14"  ><input type='hidden' name='td201' id='td201' value="<?php // echo $td201; ?>" /></td>-->
	  </tr>
	</table>
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
		<li><a href="#tab1">組合成本</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  組合成本 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	 
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="normal14y"  width="11%" > 計成本人工：</td>
       <td class="normal14a"  width="21%" ><input type="text" tabIndex="13" id="td008"    onKeyPress="keyFunction()"    name="td008" value="<?php echo $td008; ?>"  /></td>
	   <td class="normal14y"  width="12%" > 不計成本人工：</td>
       <td class="normal14a"  width="21%" ><input type="text" tabIndex="14" id="td009"      onKeyPress="keyFunction()"    name="td009" value="<?php echo $td009; ?>"  /></td>
	   <td class="normal14y"  width="9%" > 簽核狀態：</td>
       <td class="normal14a"  width="25" ><select id="td016" tabIndex="15" readonly="value" onKeyPress="keyFunction()" name="td016"   style="background-color:#EBEBE4" >
            <option <?php if($td016 == 'N') echo 'selected="selected"';?> value='N'>N.不執行電子簽核</option>                                                                        
		    <option <?php if($td016 == '0') echo 'selected="selected"';?> value='0'> 0.待處理</option>
            <option <?php if($td016 == '1') echo 'selected="selected"';?> value='1'>1.簽核中</option>
		    <option <?php if($td016 == '2') echo 'selected="selected"';?> value='2'>2.退件</option>
            <option <?php if($td016 == '3') echo 'selected="selected"';?> value='3'>3.已核准</option>	
            <option <?php if($td016 == '4') echo 'selected="selected"';?> value='4'>4.取消確認中</option>	
            <option <?php if($td016 == '5') echo 'selected="selected"';?> value='5'>5.作廢中</option>	
            <option <?php if($td016 == '6') echo 'selected="selected"';?> value='6'>6.取消作廢中</option>				
		  </select></td>
	 </tr>	
	 <tr>
	   <td class="normal14z"  > 組合成本：</td>
       <td class="normal14a"  ><input type="text" tabIndex="16" id="td201"    onKeyPress="keyFunction()"    name="td201" value="<?php echo $td201; ?>" style="background-color:#EBEBE4" /></td>
	   <td class="normal14z"  > 單位成本：</td>
       <td class="normal14a"  ><input type="text" tabIndex="17" id="td200"     onKeyPress="keyFunction()"    name="td200" value="<?php echo $td200; ?>"  style="background-color:#EBEBE4"/></td>
	   <td class="normal14z"  > 組合日期：</td>
       <td class="normal14a"  ><input type="text" tabIndex="18" id="td003"   onKeyPress="keyFunction()"  onclick="scwShow(this,event);"  name="td003" value="<?php echo $td003; ?>" style="background-color:#EBEBE4"  /></td>
	 </tr>
	  <tr>
	   <td class="normal14z"  > 批號：</td>
       <td class="normal14a"  ><input type="text" tabIndex="19" id="td017"    onKeyPress="keyFunction()"    name="td017" value="<?php echo $td017; ?>" style="background-color:#EBEBE4"  /></td>
	   <td class="normal14z"  > 有效日期：</td>
       <td class="normal14a"  ><input type="text" tabIndex="20" id="td018"   onclick="scwShow(this,event);"   onKeyPress="keyFunction()"    name="td018" value="<?php echo $td018; ?>" style="background-color:#EBEBE4" /></td>
	   <td class="normal14z"  > 確認者：</td>
       <td class="normal14a"  ><input type="text" tabIndex="21" id="td015"   onKeyPress="keyFunction()"    name="td015" value="<?php echo $td015; ?>" style="background-color:#EBEBE4"  /></td>
	 </tr>
	<tr>
	   <td class="normal14z"  > 小單位：</td>
       <td class="normal14a"  ><input type="text" tabIndex="22" id="td006"    onKeyPress="keyFunction()"    name="td006" value="<?php echo $td006; ?>" style="background-color:#EBEBE4" /></td>
	   <td class="normal14z"  > 複檢日期：</td>
       <td class="normal14a"  ><input type="text" tabIndex="23" id="td019"   onclick="scwShow(this,event);"   onKeyPress="keyFunction()"    name="td019" value="<?php echo $td019; ?>" style="background-color:#EBEBE4" /></td>
	    <td  class="normal14" ></td>
        <td class="normal14"></td>
	 </tr> 
	</table>
	</div>
	
	</div> <!-- </div>div-8 -->
	 </div> <!--</div>  div-7 -->	

	<!-- 明細表頭  -->
	 <div style="width:100%; overflow-x: auto;  ">
        <table style="width:100%;" id="order_product" class="list1">
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
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
            </tr>
          </tfoot>
       </table>
    </div>
	
	
	 <!--<div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('bom/bomi05/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div> -->
	 <br> 
    </form>
	  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
	
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

 
    </div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->

<?php  include_once("./application/views/funnew/bomi03_funmjs_v.php"); ?> <!-- 組合單別42 -->
 <?php  include_once("./application/views/funnew/invi02e_funmjs_v.php"); ?> <!-- 成品品號 -->
<?php  include_once("./application/views/funnew/cmsi03_funmjs_v.php"); ?>  <!-- 庫別 -->
<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/bomi05_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#bomi03').focus();
	}); 	   
</script> 

	  