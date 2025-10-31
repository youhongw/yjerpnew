<?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];

foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'tc003' || $key == 'tc027'){
		$$key = stringtodate("Y/m/d",$val);
	}
	
}
$body_data = $result['body_data'];
$data_count = count($body_data);
/*echo "<pre>";
//var_dump($col_array);
//var_dump($body_data);
var_dump($usecol_array);
echo "</pre>";*/
?>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 單據性質建立作業 - 查看</h1>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ast/asti03/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="tab-general"> <!-- div-6 -->
      
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="start14a" width="12%"><span class="required">單別代號：</span></td>
        <td class="normal14a" width="20%" >
         <input  tabIndex="1" id="mq001" onKeyPress="keyFunction()" onchange="" name="mq001"   value="<?php echo  $mq001; ?>"    type="text" required style="background-color:#F0F0F0" readonly="value" />
		<span id="keydisp" ></span></td>
	    
		<td class="normal14a" width="8%" >單據名稱： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%"> <input  tabIndex="2" id="mq002" onKeyPress="keyFunction()"  name="mq002"   value="<?php echo  $mq002; ?>"    type="text" style="background-color:#F0F0F0" readonly="value" /></td>
	    
		<td class="normal14a" width="8%">單據全名：</td>
        <td class="normal14a"  width="25%"><input  tabIndex="3" id="mq034" onKeyPress="keyFunction()"  name="mq034"   value="<?php echo  $mq034; ?>"    type="text" style="background-color:#F0F0F0" readonly="value" /></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a">單據性質：</td>
        <td class="normal14" > <select tabIndex="4" id="mq003" onKeyPress="keyFunction()" name="mq003" style="background-color:#F0F0F0" disabled="disabled">
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
        <td class="normal14" > <select tabIndex="5" id="mq004" onKeyPress="keyFunction()" name="mq004" style="background-color:#F0F0F0" disabled='disabled'>
            <option <?php if($mq004 == '1') echo 'selected="selected"';?> value='1'>1.日編號</option>                                                                        
		    <option <?php if($mq004 == '2') echo 'selected="selected"';?> value='2'>2.月編號 </option>
            <option <?php if($mq004 == '3') echo 'selected="selected"';?> value='3'>3.流水號 </option>
            <option <?php if($mq004 == '4') echo 'selected="selected"';?> value='4'>4.手動編號</option>
		</select></td>
	  </tr>
	  
	  <tr>
	   	<td class="normal14">註記代號：</td>
        <td class="normal14" ><input   tabIndex="15" id="mq025" onKeyPress="keyFunction()" onchange="" name="cmsq17a1" value="<?php echo $mq025; ?>"  type="text" style="background-color:#F0F0F0" readonly="value" /><img id="Showcmsq17a1" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="cmsq17a1disp"> <?php    echo $cmsq17a1disp; ?> </span></td>
		 
		<td class="normal14a"></td><td class="normal14a"></td>
		 
        <td class="normal14">簽核代號：</td>
        <td class="normal14" ><input   tabIndex="17" id="mq027" onKeyPress="keyFunction()" onchange="" name="cmsq17a2" value="<?php echo $mq027; ?>"  type="text" style="background-color:#F0F0F0" readonly="value" /><img id="Showcmsq17a2" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="cmsq17a2disp"> <?php    echo $cmsq17a2disp; ?> </span></td>
	  </tr>
	  
	  <tr>
	   	<td class="normal14">年碼數：</td>
        <td class="normal14a" ><input  tabIndex="6" id="mq005" onKeyPress="keyFunction()"  name="mq005"   value="<?php echo  $mq005; ?>" type="text" style="background-color:#F0F0F0" readonly="value" /></td>
        
		<td class="normal14a"></td><td class="normal14a"></td>
		
		<td class="normal14">流水號碼數：</td>
        <td class="normal14" ><input  tabIndex="7" id="mq006" onKeyPress="keyFunction()"  name="mq006"   value="<?php echo  $mq006; ?>" type="text" style="background-color:#F0F0F0" readonly="value"/></td>
	  </tr>
	  
	  <tr>
	   	<td class="normal14">憑證格式：</td>
		<td class="normal14" ><input type="text" tabIndex="25" id="mq032" onKeyPress="keyFunction()"  name="mq032"   value="<?php echo  $mq032; ?>" style="background-color:#F0F0F0" readonly="value"/></td>
		
		
		<td class="normal14a"></td><td class="normal14a"></td>
		
        <td class="normal14">備註：</td>
        <td class="normal14" ><input type="text" tabIndex="25" id="mq022" onKeyPress="keyFunction()"  name="mq022"   value="<?php echo  $mq022; ?>" style="background-color:#F0F0F0" readonly="value"/></td>
	  </tr>
	  
	  <tr>
		<td class="normal14">每頁列印合計：</td>
        <td  class="normal14"  ><input type="hidden" name="mq035" value="N" />	
		  <input  type='checkbox' tabIndex="13" id="mq035" onKeyPress="keyFunction()" name="mq035" <?php if($mq035 == 'Y' ) echo 'checked'; ?>  <?php if($mq035 != 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled"/>
        </td>
		
		<td class="normal14">每頁列印註記：</td>
        <td  class="normal14"  ><input type="hidden" name="mq030" value="N" />	
		  <input  type='checkbox' tabIndex="13" id="mq030" onKeyPress="keyFunction()" name="mq030" <?php if($mq030 == 'Y' ) echo 'checked'; ?>  <?php if($mq030 != 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled"/>
        </td>
		
		<td class="normal14">每頁列印簽核：</td>
        <td  class="normal14"  ><input type="hidden" name="mq031" value="N" />	
		  <input  type='checkbox' tabIndex="13" id="mq031" onKeyPress="keyFunction()" name="mq031" <?php if($mq031 == 'Y' ) echo 'checked'; ?>  <?php if($mq031 != 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled"/>
        </td>
	  </tr>
	  
	  <tr>
		<td class="normal14">列印時修改註記：</td>
        <td  class="normal14"  ><input type="hidden" name="mq026" value="N" />	
		  <input  type='checkbox' tabIndex="13" id="mq026" onKeyPress="keyFunction()" name="mq026" <?php if($mq026 == 'Y' ) echo 'checked'; ?>  <?php if($mq026 != 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled"/>
        </td>

	  
		<td class="normal14">列印時修改簽核：</td>
        <td  class="normal14"  ><input type="hidden" name="mq028" value="N" />	
		  <input  type='checkbox' tabIndex="13" id="mq028" onKeyPress="keyFunction()" name="mq028" <?php if($mq028 == 'Y' ) echo 'checked'; ?>  <?php if($mq028 != 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled"/>
        </td>

		<td class="normal14">列印時選擇憑證格式：</td>
        <td  class="normal14"  ><input type="hidden" name="mq033" value="N" />	
		  <input  type='checkbox' tabIndex="13" id="mq033" onKeyPress="keyFunction()" name="mq033" <?php if($mq033 == 'Y' ) echo 'checked'; ?>  <?php if($mq033 != 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled"/>
        </td>
	  </tr>
	  
	  <tr>
		<td class="normal14">自動列印：</td>
        <td  class="normal14"  ><input type="hidden" name="mq016" value="N" />	
		  <input  type='checkbox' tabIndex="13" id="mq016" onKeyPress="keyFunction()" name="mq016" <?php if($mq016 == 'Y' ) echo 'checked'; ?>  <?php if($mq016 != 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled"/>
        </td>
	  
		<td class="normal14">自動確認：</td>
        <td  class="normal14"  ><input type="hidden" name="mq015" value="N" />	
		  <input  type='checkbox' tabIndex="13" id="mq015" onKeyPress="keyFunction()" name="mq015" <?php if($mq015 == 'Y' ) echo 'checked'; ?>  <?php if($mq015 != 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled"/>
        </td>
		
		<td class="normal14">單別限定輸入使用者：</td>
        <td  class="normal14"  ><input type="hidden" name="mq029" value="N" />	
		  <input  type='checkbox' tabIndex="13" id="mq029" onKeyPress="keyFunction()" name="mq029" <?php if($mq029 == 'Y' ) echo 'checked'; ?>  <?php if($mq029 != 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled"/>
        </td>
	  </tr>
	</table>

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
				<td style="display:none;">
				<td class="left" valign="top"></td>
				
              </tr>-->
		<!-- 合計     -->	
	<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ast/asti03/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	
	    <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('ast/asti03/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('ast/asti03/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>	
		</div> 
      </form>
     </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  <!--  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>  -->
  </div> <!-- div-3 -->
 </div> <!-- div-2 -->
</div> <!-- div-1 -->
