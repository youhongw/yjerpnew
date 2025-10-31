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
	
<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 產生分錄底稿 - 轉入　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#mq401').focus();" type='submit' onclick="return doit();"  tabIndex="98" accesskey="c" name='submit'  class="button"   target="_new" value='&nbsp;計 算F8&nbsp;'><span>轉入Alt+c </span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></button>&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/161'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
	    
	</div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ajs/ajsb01/batcha"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-應付憑單自動結帳</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  
	  if (!isset($mq300)) { $mq300=$this->input->post('mq300');}
	  if (!isset($mq301)) { $mq301=$this->input->post('mq301');}
	  if (!isset($mq302)) { $mq302=$this->input->post('mq302');}
	  if (!isset($mq303)) { $mq303=$this->input->post('mq303');}
	  if (!isset($mq304)) { $mq304=$this->input->post('mq304');}
	  if (!isset($mq305)) { $mq305=$this->input->post('mq305');}
	  if (!isset($mq306)) { $mq306=$this->input->post('mq306');}
	  if (!isset($mq307)) { $mq307=$this->input->post('mq307');}
	  if (!isset($mq308)) { $mq308=$this->input->post('mq308');}
	  if (!isset($mq309)) { $mq309=$this->input->post('mq309');}
	  if (!isset($mq310)) { $mq310=$this->input->post('mq310');}
	  if (!isset($mq311)) { $mq311=$this->input->post('mq311');}
	  if (!isset($mq312)) { $mq312=$this->input->post('mq312');}
	  if (!isset($mq313)) { $mq313=$this->input->post('mq313');}
	  if (!isset($mq314)) { $mq314=$this->input->post('mq314');}
	  if (!isset($mq315)) { $mq315=$this->input->post('mq315');}
	  if (!isset($mq316)) { $mq316=$this->input->post('mq316');}
	  if (!isset($mq317)) { $mq317=$this->input->post('mq317');}
	  if (!isset($mq318)) { $mq318=$this->input->post('mq318');}
	  if (!isset($mq319)) { $mq319=$this->input->post('mq319');}
	  if (!isset($mq320)) { $mq320=$this->input->post('mq320');}
	  if (!isset($mq321)) { $mq321=$this->input->post('mq321');}
	  
	  if (!isset($mq401)) { $mq401=$this->input->post('mq401');}
	  if (!isset($acpq01a73)) { $acpq01a73=$this->input->post('acpq01a73');}
	  if (!isset($acpq01a73disp)) { $acpq01a73disp=$this->input->post('acpq01a73');}
	  
	  if (!isset($mq402)) { $mq402='2';} else { $mq402=$this->input->post('mq402');}
	  if (!isset($mq403)) { $mq403=$this->input->post('mq403');}
	  if (!isset($mq404)) { $mq404=$this->input->post('mq404');}
	  if (!isset($mq405)) { $mq405=$this->input->post('mq405');}
	  if (!isset($mq406)) { $mq406='1';} else { $mq406=$this->input->post('mq406');}
	  if (!isset($mq407)) { $mq407=$this->input->post('mq407');}
	  if (!isset($mq408)) { $mq408=$this->input->post('mq408');}
	  if (!isset($mq409)) { $mq409=$this->input->post('mq409');}
	  if (!isset($mq410)) { $mq410=$this->input->post('mq410');}
	//  if (!isset($mq411)) { $mq411=$this->input->post('mq411');}
	  if (!isset($mq411)) { $mq411='1';}
	  if (!isset($dateyymm)) { $dateyymm=date("Y/m");}
	
	  if (!isset($date1o)) { $date1o=date("Y/m/").'01';}
	  if (!isset($date1c)) { $date1c=date("Y/m/").'31';}
	  if (!isset($date2o)) { $date2o=date("Y/m/").'01';}
	  if (!isset($date2c)) { $date2c=date("Y/m/").'31';}
	   
	// if (!$this->input->post('dateyy')) {$dateyy=date("Y");}	
   //  if (!$this->input->post('datemm'))  {$datemm=date("m");}	
	// $dateyy=date("Y");
	// $datemm=date("m");
	
	?>
       
	<table class="form14">   <!-- 表格 -->
	 
	  <td  class="normal14" width="10%" >單據來源：</td>
        <td colspan="10"  class="normal14" width="100% >
                 <input type="hidden" name="mq300" class="mq300"  value="N" />
				<input type="checkbox" name="mq300" class="mq300"  <?php if($mq300 == 'Y' ) echo 'checked'; ?>  <?php if($mq300 !== 'Y' ) echo 'check'; ?> value="Y"   />
				庫存異動單
			    <input type="hidden" name="mq301" class="mq301"  value="N" />
                <input type="checkbox" name="mq301" class="mq301"  <?php if($mq301 == 'Y' ) echo 'checked'; ?>  <?php if($mq301 !== 'Y' ) echo 'check'; ?> value="Y"   /> 
				銷退成本
				
				<input type="hidden" name="mq302" class="mq302"  value="N" />
                <input type="checkbox" name="mq302" <?php if($mq302 == 'Y' ) echo 'checked'; ?>  <?php if($mq302 !== 'Y' ) echo 'check'; ?> value="Y"  /> 
				　退貨單
				<input type="hidden" name="mq303" value="N" />				
                <input type="checkbox" name="mq303" <?php if($mq303 == 'Y' ) echo 'checked'; ?>  <?php if($mq303 !== 'Y' ) echo 'check'; ?> value="Y"  /> 
				　退料單
				<input type="hidden" name="mq304" value="N" />
                <input type="checkbox" name="mq304" <?php if($mq304 == 'Y' ) echo 'checked'; ?>  <?php if($mq304 !== 'Y' ) echo 'check'; ?> value="Y"  /> 
                　託外進成本
				<input type="hidden" name="mq305" value="N" />
                <input type="checkbox" name="mq305" <?php if($mq305 == 'Y' ) echo 'checked'; ?>  <?php if($mq305 !== 'Y' ) echo 'check'; ?> value="Y"  /> 
                　成本開帳/調整單
				<input type="hidden" name="mq306" value="N" />				
                <input type="checkbox" name="mq306" <?php if($mq306 == 'Y' ) echo 'checked'; ?>  <?php if($mq306 !== 'Y' ) echo 'check'; ?> value="Y"  /> 
                　結帳單
				<input type="hidden" name="mq307" value="N" />				
                <input type="checkbox" name="mq307" <?php if($mq307 == 'Y' ) echo 'checked'; ?>  <?php if($mq307 !== 'Y' ) echo 'check'; ?> value="Y"  /> 
                　應付憑單 <br/>
				<input type="hidden" name="mq308" value="N" />
			    <input type="checkbox" name="mq308" <?php if($mq308 == 'Y' ) echo 'checked'; ?>  <?php if($mq308 !== 'Y' ) echo 'check'; ?> value="Y"  /> 
                　生產入庫單
				<input type="hidden" name="mq309" value="N" />
                <input type="checkbox" name="mq309" <?php if($mq309 == 'Y' ) echo 'checked'; ?>  <?php if($mq309 !== 'Y' ) echo 'check'; ?> value="Y"  /> 
                　託外退成本
				<input type="hidden" name="mq310" value="N" />
                <input type="checkbox" name="mq310" <?php if($mq310 == 'Y' ) echo 'checked'; ?>  <?php if($mq310 !== 'Y' ) echo 'check'; ?> value="Y"  /> 				
                　銷貨單
				
				<input type="hidden" name="mq311" value="N" />
                <input type="checkbox" onclick="checkbox311(this);" id="mq311" name="mq311" <?php if($mq311 == 'Y' ) echo 'checked'; ?>  <?php if($mq311 !== 'Y' ) echo 'check'; ?> value="Y"  /> 				
                　收款單	
				
                <input type="hidden" name="mq312" value="N" />
				<input type="checkbox" onclick="checkbox312(this);" id="mq312" name="mq312" <?php if($mq312 == 'Y' ) echo 'checked'; ?>  <?php if($mq312 !== 'Y' ) echo 'check'; ?> value="Y"  /> 				
                　付款單
				<input type="hidden" name="mq313" value="N" />
				<input type="checkbox" name="mq313" <?php if($mq313 == 'Y' ) echo 'checked'; ?>  <?php if($mq313 !== 'Y' ) echo 'check'; ?> value="Y"  /> 				
                　託外進費用 
                <input type="hidden" name="mq314" value="N" />
				<input type="checkbox" name="mq314" <?php if($mq314 == 'Y' ) echo 'checked'; ?>  <?php if($mq314 !== 'Y' ) echo 'check'; ?> value="Y"  /> 				
                　營業日報表	
	            <input type="hidden" name="mq315" value="N" />
                <input type="checkbox" name="mq315" <?php if($mq315 == 'Y' ) echo 'checked'; ?>  <?php if($mq315 !== 'Y' ) echo 'check'; ?> value="Y"  /> 				
                　銷退單 <br/>
				<input type="hidden" name="mq316" value="N" />
                <input type="checkbox" name="mq316" <?php if($mq316 == 'Y' ) echo 'checked'; ?>  <?php if($mq316 !== 'Y' ) echo 'check'; ?> value="Y"  /> 				
                　進貨單	
                <input type="hidden" name="mq317" value="N" />
				<input type="checkbox" name="mq317" <?php if($mq317 == 'Y' ) echo 'checked'; ?>  <?php if($mq317 !== 'Y' ) echo 'check'; ?> value="Y"  /> 				
                　領料單
				<input type="hidden" name="mq318" value="N" />
				<input type="checkbox" name="mq318" <?php if($mq318 == 'Y' ) echo 'checked'; ?>  <?php if($mq318 !== 'Y' ) echo 'check'; ?> value="Y"  /> 				
                　託外退費用 
                <input type="hidden" name="mq319" value="N" />
				<input type="checkbox" name="mq319" <?php if($mq319 == 'Y' ) echo 'checked'; ?>  <?php if($mq319 !== 'Y' ) echo 'check'; ?> value="Y"  /> 				
                　營業日報成本
				<input type="hidden" name="mq320" value="N" />
				<input type="checkbox" name="mq320" <?php if($mq320 == 'Y' ) echo 'checked'; ?>  <?php if($mq320 !== 'Y' ) echo 'check'; ?> value="Y"  /> 				
                　銷貨成本 
                <input type="hidden" name="mq321" value="N" />
				<input type="checkbox" name="mq321" <?php if($mq321 == 'Y' ) echo 'checked'; ?>  <?php if($mq321 !== 'Y' ) echo 'check'; ?> value="Y"  /> 				
                　POS訂單
	   </td>
		<td  class="normal14"  ></td>		
        <td  class="normal14"  ></td>
	  </tr>
	  <tr>
	  <!--   <input tabIndex="1" id="mq401"   onKeyPress="keyFunction()"      type="text" name="mq401"  value="<?php echo $mq401; ?>"  size="12"   /></td> -->
		<td class="normal14" width="10%" >選擇單別：</td>
        <td class="normal14" width="38%" >
	                                      <input type="text" tabIndex="1" id="mq401"    onKeyPress="keyFunction()"  onChange="startacpq01a73(this)"  name="acpq01a73" value="<?php echo $acpq01a73; ?>"  type="text" required />
										  <a href="javascript:;"><img id="Showacpq01a73" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="acpq01a73disp"> <?php    echo $acpq01a73disp; ?> </span></td>
		<td  class="normal14" width="10%" >拋轉方式：</td>		
        <td  class="normal14" width="38%"><input type="radio" tabIndex="17" name="mq402" <?php if (isset($mq402) && $mq402=="1") echo "checked";?> value="1" />分錄底稿　&nbsp;
               <input type="radio" tabIndex="18" name="mq402" <?php if (isset($mq402) && $mq402=="2") echo "checked";?> value="2" />分錄底稿及會計傳票
        </td>
	  </tr>
	   <tr>
	    <td class="normal14"  >起始單號：</td>
        <td class="normal14"  ><input tabIndex="1" id="mq403"  onchange="copya(this);" onKeyPress="keyFunction()"      type="text" name="mq403"  value="<?php echo $mq403; ?>"  size="12"   /></td>
	    <td  class="normal14"  >結束單號：</td>		
        <td  class="normal14" ><input tabIndex="1" id="mq404"   onKeyPress="keyFunction()"      type="text" name="mq404"  value="<?php echo $mq404; ?>"  size="12"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14"  >底稿科目彚總：</td>
        <td class="normal14"  ><input type="hidden" name="mq405" value="N" />
		<input tabIndex="12" type="checkbox"  id="mq405" onKeyPress="keyFunction()"   name="mq405" <?php if($mq405 == 'Y' ) echo 'checked'; ?>  <?php if($mq405 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	    <td  class="normal14"  >逐張開立日期：</td>		
        <td  class="normal14" ><input type="radio" tabIndex="17" name="mq406" <?php if (isset($mq406) && $mq406=="1") echo "checked";?> value="1" />依原單據日期　&nbsp;
               <input type="radio" tabIndex="18" name="mq406" <?php if (isset($mq406) && $mq406=="2") echo "checked";?> value="2" />依傳票日期
        </td>
	  </tr>
	   <tr>
	    <td class="normal14"  >起始日期：</td>
        <td class="normal14"  ><input tabIndex="1" id="mq407"  onfocus="this.select();" onKeyPress="keyFunction()"  onChange="dataym4(this)"    type="text" name="mq407"  value="<?php echo $mq407; ?>"  size="10" style="background-color:#E7EFEF"  />
	    <img  onclick="scwShow(mq407,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		<td  class="normal14"  >截止日期：</td>		
        <td  class="normal14" ><input tabIndex="1" id="mq408"  onfocus="this.select();" onKeyPress="keyFunction()"  onChange="dataym4(this)"    type="text" name="mq408"  value="<?php echo $mq408; ?>"  size="10" style="background-color:#E7EFEF"  />
	     <img  onclick="scwShow(mq408,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
	  <tr>
	    <td class="normal14"  >底稿批號：</td>
        <td class="normal14"  ><input tabIndex="1" id="mq409"   onKeyPress="keyFunction()"      type="text" name="mq409"  value="<?php echo $mq409; ?>"  size="12"   /></td>
	    <td  class="normal14"  >傳票日期：</td>		
        <td  class="normal14" ><input tabIndex="1" id="mq410"  onfocus="this.select();" onKeyPress="keyFunction()"  ondblclick="scwShow(this,event);"    type="text" name="mq410"  value="<?php echo $mq410; ?>"  size="10" style="background-color:#E7EFEF"  />
	     <img  onclick="scwShow(mq410,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
	  <tr>
	    <td class="normal14"  >複製分類碼：</td>
        <td class="normal14"  ><input tabIndex="1" id="mq411"   onKeyPress="keyFunction()"      type="text" name="mq411"  value="<?php echo $mq411; ?>"  size="12"   /></td>
	    <td  class="normal14"  ></td>		
        <td  class="normal14" ></td>
	  </tr>
    </table>
	    <span style="color:#006600;font-weight:bold;">預估計算進度條</span> <br/>
		<div id="progressbar" style="width:420px;height:25px;border:1px solid #0000FF;"></div><br>
		
	<!--	<a onclick="return doit();" class="button"><span>計算&nbsp</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a> -->
	    
		<!--<div class="buttons">
	      <button type='submit' onclick="return doit();"  tabIndex="98" accesskey="c" name='submit'  class="button"   target="_new" value='&nbsp;計 算F8&nbsp;'><span>轉 入Alt+c</span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/161'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
	    </div>-->
        </form>
		 <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php include_once("./application/views/funnew/erp_funjs_one_v.php"); ?> 
<?php include_once("./application/views/fun/ajsb01_funjs_v.php"); ?> 
<script>
  $(function() {
    $( "#progressbar" ).progressbar({
      value: 1
    });
  });
  </script>
<script language="javascript">
var i=0,t=50;  // 时长
function doit(){
   i = i + 0.01;
   document.getElementById('progressbar').firstChild.style.width = (parseInt(document.getElementById('progressbar').style.width) * i).toFixed(0) + 'px';
   if(i<1) setTimeout(doit, t);
}
doit();
</script>
<script type="text/javascript" >
   function copya(oInput) {
	   form.mq403.value=oInput.value;
   }
   function copyb(oInput) {
	   $("#mq404").val(oInput.value);
   }
</script>