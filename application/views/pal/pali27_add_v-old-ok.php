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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 員工加保建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pal/pali27/addsave" >	
	<div id="tab-general">  <!-- div-6 -->
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  
      $ti001=$this->input->post('ti001');
	  $ti002=$this->input->post('ti002');
	   $palq01a=$this->input->post('palq01a');
	  if(@$this->uri->segment(4)){ $palq01a=$this->uri->segment(4);}
	  $palq01adisp=$this->input->post('ti001');
	
	   $cmsq05a=$this->input->post('cmsq05a');
	   $cmsq05adisp=$this->input->post('cmsq05a');
	  $ti003=$this->input->post('ti003');
	  $ti004=$this->input->post('ti004');
	  $ti005=$this->input->post('ti005');
	  $ti006=$this->input->post('ti006');
	  $ti007=$this->input->post('ti007');
	  $ti008=$this->input->post('ti008');
	  $ti009=$this->input->post('ti009');
	  $ti010=$this->input->post('ti010');
	  $ti011=$this->input->post('ti011');
	  $ti012=$this->input->post('ti012');
	  $ti013=$this->input->post('ti013');
	//  if(!isset($ti013)) { $ti013=date("Y/m/d"); }
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a" width="12%" ><span class="required">員工代號：</span> </td>
        <td class="normal14a" width="20%" ><input   tabIndex="1" id="ti001" onKeyPress="keyFunction(event)" name="palq01a" value="<?php echo $palq01a; ?>"  type="text" required /><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="palq01adisp"> <?php    echo $palq01adisp; ?> </span></td>
		<td class="normal14a" width="12%" >部門代號：</td>
        <td class="normal14a" width="22%" ><input type="text" tabIndex="2" onKeyPress="keyFunction(event)" id="ti002"  name="cmsq05a" onchange="startcmsq05a(this)" value="<?php echo  $cmsq05a; ?>" /><a href="javascript:;"><img id="Showcmsq05a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
	   <span id="cmsq05adisp" > <?php    echo $cmsq05adisp; ?> </span></td>
		<td class="normal14a" width="12%" >本人減免註記：</td>
        <td class="normal14a" width="22%" ><select  tabIndex="3" id="ti003" onKeyPress="keyFunction(event)"  name="ti003" >
             <option <?php if($ti003 == '1') echo 'selected="selected"';?> value='1'>1:標準</option>
		     <option <?php if($ti003 == '2') echo 'selected="selected"';?> value='2'>2:輕度(25%)</option>
		     <option <?php if($ti003 == '3') echo 'selected="selected"';?> value='3'>3:中度(50%)</option>
			 <option <?php if($ti003 == '4') echo 'selected="selected"';?> value='4'>4:重度(100%)</option>
		  </select></td>
	  </tr>
	 
	 <tr>
	    <td class="normal14" >健保等級： </td>
        <td class="normal14" ><input type="text" tabIndex="4"  onKeyPress="keyFunction(event)"   id="ti004" name="ti004" value="<?php echo $ti004; ?>" size="3" />投保金額：<input type="text" tabIndex="5"  onKeyPress="keyFunction()" id="ti005" name="ti005" value="" size="8" />　<span id="ti005_true_insure"></span></td>
		<td class="normal14">健保加保日期：</td>
        <td class="normal14"><input type="text" tabIndex="6"  onKeyPress="keyFunction(event)"  ondblclick="scwShow(this,event);" onChange="dateformat_ymd(this)"  id="ti006" name="ti006" value="<?php echo $ti006; ?>" style="background-color:#E7EFEF"  /><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td>
		<td class="normal14" >健保退保日期： </td>
        <td class="normal14" ><input type="text" tabIndex="7"  onKeyPress="keyFunction(event)"  ondblclick="scwShow(this,event);" onChange="dateformat_ymd(this)"  id="ti007" name="ti007" value="<?php echo $ti007; ?>" style="background-color:#E7EFEF"  /><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td>
	  </tr>
	  <tr>
		<td class="normal14">勞保等級：</td>
        <td class="normal14"><input type="text" tabIndex="8"  onKeyPress="keyFunction(event)"   id="ti008" name="ti008" value="<?php echo $ti008; ?>" size="3" />投保金額：<input type="text" tabIndex="9"  onKeyPress="keyFunction()" id="ti009" name="ti009" value="<?php echo $ti009; ?>" size="8" />　<span id="ti009_true_insure"></span></td>
	    <td class="normal14" >勞保加保日期： </td>
        <td class="normal14" ><input type="text" tabIndex="10"  onKeyPress="keyFunction(event)"  ondblclick="scwShow(this,event);" onChange="dateformat_ymd(this)"  id="ti010" name="ti010" value="<?php echo $ti010; ?>" style="background-color:#E7EFEF"  /><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td>
		<td class="normal14">勞保退保日期：</td>
        <td class="normal14"><input type="text" tabIndex="11"  onKeyPress="keyFunction(event)"   ondblclick="scwShow(this,event);" onChange="dateformat_ymd(this)"  id="ti011" name="ti011" value="<?php echo $ti011; ?>"  style="background-color:#E7EFEF" /><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td>
		
	  </tr>
      <tr>
		<td class="normal14">投保公司：</td>
        <td class="normal14"><select type="text"  tabIndex="12" id="ti012" onKeyPress="keyFunction()" name="ti012" >
				<option value="1" >1.得貹</option>
				<option value="2" >2.祐得</option>
				<option value="3" >3.高盛</option>
				<option value="4" >4.祐貹</option>
				<option value="5" >5.承德</option>
				<option value="6" >6.皇興</option></select>
		<!--<input type="text" tabIndex="12"  onKeyPress="keyFunction(event)"   id="ti012" name="ti012" value="<?php echo $ti012; ?>"/>--></td>
		<td class="normal14">異動別：</td>
        <td class="normal14"><select type="text"  tabIndex="13" id="ml013" onKeyPress="keyFunction()" name="ml013" >
			<option value="1" >1.加保</option>
			<option value="2" >2.退保</option>
			<option value="3" >3.薪調</option></select></td>
	  </tr>
	  <tr>
	    <td  class="normal14" >備註：</td>
        <td  class="normal14" colspan="4"  ><input type="text" tabIndex="14"  onKeyPress="keyFunction(event)" size="60"  id="ti013" name="ti013" value="<?php echo $ti013; ?>"   /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
		
	  </tr>
	  
		
	</table>
	
	<div>
        <table id="order_product" class="list1">
        <thead>
            <tr>
              <td width="5%"></td>			
		      <td width="5%" class="left">關係</td>
              <td width="10%" class="left">眷屬姓名</td>
			  <td width="5%" class="left">證別</td>
			  <td width="10%" class="left">證號</td>
			  <td width="5%" class="left">性別</td>
			  <td width="10%" class="left">出生日期</td>
			  <td width="5%" class="left">異動別</td>
			  <td width="5%" class="left">減免註記</td>
			  <td width="10%" class="left">異動日期</td>
			  <td width="15%" class="left">備註</td>
			  <td width="20%" class="left">戶籍地址</td>
			  		
            </tr>
        </thead>
          <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction(event)" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="12"></td>
            </tr>
          </tfoot>
       </table>
    </div>
	<!-- 合計     -->
		     <tr>
				<!-- enter 鍵不會跳下一列       -->
				<td ><input type='text' readonly="value" name='ta999'   value=""  style="display:none" /></td>	
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	
	
	 <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a accesskey="x" tabIndex="97" onKeyPress="keyFunction(event)" id='cancel' name='cancel' href="<?php echo site_url('pal/pali27/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div>
	  <a accesskey="a" onclick="addItem();" />
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
 <?php include_once("./application/views/fun/pali27_funjs_v.php"); ?>
 <script>
$('#ti004').change(function(){
	get_insure("jianbau",$(this).val(),"ti005");
});
$('#ti005').change(function(){
	get_insure_level("jianbau",$(this).val(),"ti004");
});
$('#ti008').change(function(){
	get_insure("laubau",$(this).val(),"ti009");
});
$('#ti009').change(function(){
	get_insure_level("laubau",$(this).val(),"ti008");
});

function get_insure(type,level,col){
	$.ajax({
	  method: "POST",
	  dataType:"json",
	  url: "<?php echo base_url()?>index.php/pal/pali27/get_insure_ajax",
	  data: {
		  type : type,
		  level : level
	  }
	})
	.done(function( msg ) {
		if(typeof(msg) === "object"){
			$('#'+col).val(msg[1]);
			$('#'+col).next().text("基礎保費:"+msg[2]);
		}else{
			$('#'+col).prev().val("");
			$('#'+col).val("");
			$('#'+col).next().text(msg);
			$('#'+col).prev().select();
		}
	});
}

function get_insure_level(type,insure,col){
	$.ajax({
	  method: "POST",
	  dataType:"json",
	  url: "<?php echo base_url()?>index.php/pal/pali27/get_insure_level_ajax",
	  data: {
		  type : type,
		  insure : insure
	  }
	})
	.done(function( msg ) {
		if(typeof(msg) === "object"){
			$('#'+col).val(msg[0]);
			$('#'+col).next().val(msg[1]);
			$('#'+col).next().next().text("基礎保費:"+msg[2]);
		}else{
			$('#'+col).val("");
			$('#'+col).next().val("");
			$('#'+col).next().next().text(msg);
			$('#'+col).next().select();
		}
	});
}

function get_ti002(){
	$.ajax({
	  method: "POST",
	  dataType:"json",
	  url: "<?php echo base_url()?>index.php/pal/pali27/get_ti002",
	  data: {
		  ti001 : $('#ti001').val()
	  }
	})
	.done(function( msg ) {
		console.log(msg);
		$('#ti002').val(msg);
	});
}
function get_mv002(){
	$.ajax({
	  method: "POST",
	  dataType:"json",
	  url: "<?php echo base_url()?>index.php/pal/pali27/get_mv002",
	  data: {
		  ti001 : $('#ti001').val()
	  }
	})
	.done(function( msg ) {
		console.log(msg);
		$('#palq01adisp').text(msg);
	});
}

$('#ti001').change(function(){
	get_mv002();get_ti002();
});
</script>