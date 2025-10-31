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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> BOM自動請購產生作業 - 產生　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#td001c').focus();" type='submit' onclick="return doit();"  tabIndex="98" accesskey="c" name='submit'  class="button"   target="_new" value='&nbsp;產 生F8&nbsp;'><span>產 生Alt+c</span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></button>&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/107'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
	    
	</div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/bom/bomb07/batcha"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-應付憑單自動結帳</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $td001c=$this->input->post('td001c');
	  $td001cn=$this->input->post('td001cn');
	  $td0021c=$this->input->post('td0021c');
	  $td002c=$this->input->post('td002c');
	  $td003c=$this->input->post('td003c');
	  if(!isset($td004c)) { $td004c=date("Y/m/d"); } else {$td004c=$this->input->post('td004c');}
	  if(!isset($td005c)) { $td005c=date("Y/m/d"); } else {$td005c=$this->input->post('td005c');}
	  $td006c=$this->input->post('td006c');
	  $td007c=$this->input->post('td007c');
	  $td008c=$this->input->post('td008c');
	  $td009c=$this->input->post('td009c');
	  
	  
	?>
       
	<table class="form14">   <!-- 表格 -->
	   <tr>
	    <td class="normal14y"  width="10%">品號：</td>
        <td class="normal14a" width="40%"><input tabIndex="3" id="td001c"    onKeyPress="keyFunction()" name="td001c" value="<?php echo $td001c; ?>"  type="text" /> 
			<input type="button" id="copy" value="加入">&nbsp;<input type="button" id="clear" value="清除"></td>
		<td class="normal14y"  width="10%" >需求數量：</td>
		<td class="normal14a" width="20%"><input tabIndex="3" id="td0021c"    onKeyPress="keyFunction()" name="td002c" value="<?php echo $td0021c; ?>"  type="text" /> 
			<input type="button" id="copy1" value="加入">&nbsp;<input type="button" id="clear1" value="清除"></td>
		
	  </tr> 
	  <tr>
	    <td class="normal14y"  width="10%"></td>
        <td> <textarea cols="30" rows="5" name="td001cn" id="td001cn" readonly required></textarea></td>
		<td class="normal14y"  width="10%"></td>
        <td> <textarea cols="30" rows="5" name="td002c" id="td002c" readonly required></textarea></td>
	  </tr> 
	  <tr>
	    <td class="normal14z"  >請購單別：</td>
        <td class="normal14a" ><input tabIndex="1" id="td003c"   onKeyPress="keyFunction()" name="td003c" value="<?php echo $td003c; ?>"  type="text" required /> </td>
	  </tr> 
	   <tr>
	    <td class="normal14z"  >請購日期：</td>
        <td class="normal14a" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="td004c" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="td004c"  value="<?php echo $td004c; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(td004c,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>  
	   <tr>
	    <td class="normal14z"  >需求日期：</td>
        <td class="normal14a" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="td005c" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="td005c"  value="<?php echo $td005c; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(td005c,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr> 	  
	    <tr>
	    <td class="normal14z" >庫別：</td>
        <td class="normal14a" ><input tabIndex="3" id="td006c"    onKeyPress="keyFunction()" name="td006c" value="<?php echo $td006c; ?>"  type="text" />  </td>
	  </tr>  
	    <tr>
	    <td class="normal14z"  >請購部門：</td>
        <td class="normal14a" ><input type="text" tabIndex="4" onKeyPress="keyFunction()"  id="td007c" name="td007c" value="<?php echo $td007c; ?>"  type="text" /> </td>
	  </tr> 
	    <tr>
	    <td class="normal14z"  >材料類型：</td>
        <td class="normal14a"   >
		  <select tabIndex="27" id="td008c" onKeyPress="keyFunction()" name="td008c" >
            <option <?php if($td008c == '0') echo 'selected="selected"';?> value='0'>全部 </option>                                                                        
		    <option <?php if($td008c == '1') echo 'selected="selected"';?> value='1'>直接材料 </option>
            <option <?php if($td008c == '2') echo 'selected="selected"';?> value='2'>間接材料 </option>
            <option <?php if($td008c == '3') echo 'selected="selected"';?> value='3'>廠商供料</option>
			<option <?php if($td008c == '4') echo 'selected="selected"';?> value='4'>不發料</option>
			<option <?php if($td008c == '5') echo 'selected="selected"';?> value='5'>客戶供料</option>
		  </select>
		</td>
	  </tr> 
	   <tr>
	    <td class="normal14z"  >用料展開方式：</td>
        <td class="normal14a"   >
		  <select tabIndex="27" id="td009c" onKeyPress="keyFunction()" name="td009c" >
		    <option <?php if($td009c == '1') echo 'selected="selected"';?> value='1'>尾階 </option>
            <option <?php if($td009c == '2') echo 'selected="selected"';?> value='2'>單階 </option>
		  </select>
		</td>
	  </tr> 
    </table>
	 <!--   <span style="color:#006600;font-weight:bold;">預估計算進度條</span> <br/>
		<div id="progressbar" style="width:420px;height:25px;border:1px solid #0000FF;"></div><br>-->
		
	<!--	<a onclick="return doit();" class="button"><span>計算&nbsp</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a> -->
	    
		<!--<div class="buttons">
	      <button type='submit' onclick="return doit();"  tabIndex="98" accesskey="c" name='submit'  class="button"   target="_new" value='&nbsp;計 算F8&nbsp;'><span>計 算Alt+c</span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/107'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
	    </div>-->
        </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php include("./application/views/fun/bomb07_funjs_v.php"); ?>
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

<script>
$(function () {
        $('#copy').click(function(){
            $('#td001cn').text($('#td001cn').val()+$('#td001c').val()+"\n");
        });
    });
</script>

<script>
$(function () {
        $('#copy1').click(function(){
            $('#td002c').text($('#td002c').val()+$('#td0021c').val()+"\n");
        });
    });
</script>


<script>
$(function () {
        $('#clear').click(function(){
            $('#td001cn').text("");
        });
    });
</script>

<script>
$(function () {
        $('#clear1').click(function(){
            $('#td002c').text("");
        });
    });
</script>