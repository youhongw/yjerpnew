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

<div id="content"> <!-- div-3 --> 
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 單據性質建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/ast/asti03/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值
	  $date=date("Ymd");
	  $mq001=$this->input->post('mq001');
	  $mq002=$this->input->post('mq002');
	  $mq003=$this->input->post('mq003');
	  $mq004=$this->input->post('mq004');
	  $mq005=$this->input->post('mq005');
	  $mq006=$this->input->post('mq006');
	  $mq015=$this->input->post('mq015');
	  $mq016=$this->input->post('mq016');
	  $mq018=$this->input->post('mq018');
	  $mq022=$this->input->post('mq022');
	  $mq024=$this->input->post('mq024');
	  $mq025=$this->input->post('mq025');
	  $mq026=$this->input->post('mq026');
      $mq027=$this->input->post('mq027');
      $mq028=$this->input->post('mq028');
	  $mq029=$this->input->post('mq029');
	  $mq030=$this->input->post('mq030');
	  $mq031=$this->input->post('mq031');
	  $mq032=$this->input->post('mq032');
	  $mq033=$this->input->post('mq033');
	  $mq034=$this->input->post('mq034');
	  $mq035=$this->input->post('mq035');
	   $acrq01a61='';
		$acrq01a61disp='';
	  $copq03a61=$this->input->post('mq021');
	  $copq03a61disp='';
	  $cmsq17a1=$this->input->post('mq025');
	  $cmsq17a1disp=$this->input->post('mq025');
	  $cmsq17a2=$this->input->post('mq027');
	  $cmsq17a2disp=$this->input->post('mq027');
	  $taxq02a=$this->input->post('mq023');
	  $taxq02adisp=$this->input->post('mq023');	  
	  
	  if (($mq024!="1") && ($mq024!="2") ) { $mq024="1" ;}
	  if (($mq015!="Y") && ($mq015!="N") ) { $mq015="Y" ;}
	  if (($mq016!="Y") && ($mq016!="N") ) { $mq016="N" ;}
	  if (($mq029!="Y") && ($mq029!="N") ) { $mq029="N" ;}
	  if (($mq018!="Y") && ($mq018!="N") ) { $mq018="N" ;}
	  //$this->session->unset_userdata('docno');
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a" width="12%"><span class="required">單別代號：</span></td>
        <td class="normal14a" width="20%" >
         <input  tabIndex="1" id="mq001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mq001"   value="<?php echo  $mq001; ?>"    type="text" required />
		<span id="keydisp" ></span></td>
	    
		<td class="normal14a" width="8%" >單據名稱： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%"> <input  tabIndex="2" id="mq002" onKeyPress="keyFunction()"  name="mq002"   value="<?php echo  $mq002; ?>"    type="text"  /></td>
	    
		<td class="normal14a" width="8%">單據全名：</td>
        <td class="normal14a"  width="25%"><input  tabIndex="3" id="mq034" onKeyPress="keyFunction()"  name="mq034"   value="<?php echo  $mq034; ?>"    type="text"  /></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a">單據性質：</td>
        <td class="normal14" > <select tabIndex="4" id="mq003" onKeyPress="keyFunction()" name="mq003" >
            <option <?php if($mq003 == 'C0') echo 'selected="selected"';?> value='C0'>C0:取得</option>                                                                        
		    <option <?php if($mq003 == 'C1') echo 'selected="selected"';?> value='C1'>C1:改良 </option>
            <option <?php if($mq003 == 'C2') echo 'selected="selected"';?> value='C2'>C2:重估 </option>
            <option <?php if($mq003 == 'C3') echo 'selected="selected"';?> value='C3'>C3:報廢 </option>
            <option <?php if($mq003 == 'C4') echo 'selected="selected"';?> value='C4'>C4:出售 </option>
            <option <?php if($mq003 == 'C5') echo 'selected="selected"';?> value='C5'>C5:調整 </option>
            <option <?php if($mq003 == 'C6') echo 'selected="selected"';?> value='C6'>C6:折舊 </option>
            <option <?php if($mq003 == 'C7') echo 'selected="selected"';?> value='C7'>C7:移轉 </option>
            <option <?php if($mq003 == 'C8') echo 'selected="selected"';?> value='C8'>C8:外送 </option>
            <option <?php if($mq003 == 'C9') echo 'selected="selected"';?> value='C9'>C9:收回 </option>
		</select></td>
		
		<td class="normal14a"></td><td class="normal14a"></td>
		
	    <td class="normal14">編碼方式：</td>
        <td class="normal14" > <select tabIndex="5" id="mq004" onKeyPress="keyFunction()" name="mq004" >
            <option <?php if($mq004 == '1') echo 'selected="selected"';?> value='1'>1.日編號</option>                                                                        
		    <option <?php if($mq004 == '2') echo 'selected="selected"';?> value='2'>2.月編號 </option>
            <option <?php if($mq004 == '3') echo 'selected="selected"';?> value='3'>3.流水號 </option>
            <option <?php if($mq004 == '4') echo 'selected="selected"';?> value='4'>4.手動編號</option>
		</select></td>
	  </tr>
	  
	  <tr>
	   	<td class="normal14">註記代號：</td>
        <td class="normal14" ><input   tabIndex="6" id="mq025" onKeyPress="keyFunction()" onchange="startcmsq17a1(this)" name="cmsq17a1" value="<?php echo $cmsq17a1; ?>"  type="text"  /><img id="Showcmsq17a1" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="cmsq17a1disp"> <?php    echo $cmsq17a1disp; ?> </span></td>

		<td class="normal14a"></td><td class="normal14a"></td>
		 
        <td class="normal14">簽核代號：</td>
        <td class="normal14" ><input   tabIndex="7" id="mq027" onKeyPress="keyFunction()" onchange="startcmsq17a2(this)" name="cmsq17a2" value="<?php echo $cmsq17a2; ?>"  type="text"  /><img id="Showcmsq17a2" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="cmsq17a2disp"> <?php    echo $cmsq17a2disp; ?> </span></td>
	  </tr>
	  
	  <tr>
	   	<td class="normal14">年碼數：</td>
        <td class="normal14a" ><input  tabIndex="8" id="mq005" onKeyPress="keyFunction()"  name="mq005"   value="<?php echo  $mq005; ?>"    type="text"  /></td>
        
		<td class="normal14a"></td><td class="normal14a"></td>
		
		<td class="normal14">流水號碼數：</td>
        <td class="normal14" ><input  tabIndex="9" id="mq006" onKeyPress="keyFunction()"  name="mq006"   value="<?php echo  $mq006; ?>"    type="text"  /></td>
	  </tr>
	  
	  <tr>
	   	<td class="normal14">憑證格式：</td>
        <td class="normal14" ><input type="text" tabIndex="10" id="mq032" onKeyPress="keyFunction()"  name="mq032"   value="<?php echo  $mq032; ?>" /></td>
		
		<td class="normal14a"></td><td class="normal14a"></td>
		
        <td class="normal14">備註：</td>
        <td class="normal14" ><input type="text" tabIndex="11" id="mq022" onKeyPress="keyFunction()"  name="mq022"   value="<?php echo  $mq022; ?>" /></td>
	  </tr>
	  
	  <tr>
		<td class="normal14">每頁列印合計：</td>
        <td class="normal14a">
			<input tabIndex="12" id="mq035" name="mq035" value="Y" onKeyPress="keyFunction()" type="checkbox" />
		</td>
		
		<td class="normal14">每頁列印註記：</td>
        <td class="normal14a">
			<input tabIndex="13" id="mq030" name="mq030" value="Y" onKeyPress="keyFunction()" type="checkbox" />
		</td>
		
		<td class="normal14">每頁列印簽核：</td>
        <td class="normal14a">
			<input tabIndex="14" id="mq031" name="mq031" value="Y" onKeyPress="keyFunction()" type="checkbox" />
		</td>
	  </tr>
	  
	  <tr>
		<td class="normal14">列印時修改註記：</td>
        <td class="normal14a">
			<input tabIndex="15" id="mq026" name="mq026" value="Y" onKeyPress="keyFunction()" type="checkbox" />
		</td>

	  
		<td class="normal14">列印時修改簽核：</td>
        <td class="normal14a">
			<input tabIndex="16" id="mq028" name="mq028" value="Y" onKeyPress="keyFunction()" type="checkbox" />
		</td>

		<td class="normal14">列印時選擇憑證格式：</td>
        <td class="normal14a">
			<input tabIndex="17" id="mq033" name="mq033" value="Y" onKeyPress="keyFunction()" type="checkbox" />
		</td>
	  </tr>
	  
	  <tr>
		<td class="normal14">自動列印：</td>
        <td class="normal14a">
			<input tabIndex="18" id="mq016" name="mq016" value="Y" onKeyPress="keyFunction()" type="checkbox" />
		</td>
	  
		<td class="normal14">自動確認：</td>
        <td class="normal14a">
			<input tabIndex="19" id="mq015" name="mqa015" value="Y" onKeyPress="keyFunction()" type="checkbox" />
		</td>
		
		<td class="normal14">單別限定輸入使用者：</td>
        <td class="normal14a">
			<input tabIndex="20" id="mq029" name="mq029" value="Y" onKeyPress="keyFunction()" type="checkbox" />
		</td>
	  </tr>
	</table>
	 
	 <!-- 明細表頭  -->
	 <!--<div style="width:100%; overflow-x: auto;  ">
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
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
            </tr>
          </tfoot>
       </table>
	</div> -->
	<!-- 合計     -->
		     <!--<tr>
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
              </tr>-->
		<!-- 合計     -->	  
	 <div class="buttons">
	   <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ast/asti03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div> 
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


<?php include_once("./application/views/fun/asti03_funjs_v.php");?>  <!-- 舊版的單據視窗 -->
<?php // include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php //  include_once("./application/views/funnew/asti03_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#mq001').focus();
	}); 	   
</script> 	    	