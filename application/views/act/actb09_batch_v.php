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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 年底結轉作業 - 結轉　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#dateyy1').focus();"  type='submit' onclick="return doit();"  tabIndex="98" accesskey="c" name='submit'  class="button"   target="_new" value='&nbsp;計 算F8&nbsp;'><span>計 算Alt+c</span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></button>&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/109'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
	    
	</div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/act/actb09/batcha"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-應付憑單自動結帳</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $dateyy1=$this->input->post('dateyy1');
	  $datemm1=$this->input->post('datemm1');
	  $datemm1='12';
	// if (!$this->input->post('dateyy')) {$dateyy=date("Y");}	
   //  if (!$this->input->post('datemm'))  {$datemm=date("m");}	
	// $dateyy=date("Y");
	// $datemm=date("m");
	
	?>
       
	<table class="form14">   <!-- 表格 -->
	  <tr>
	    <td class="normal14y"  width="12%">選擇結轉年度：</td>
        <td class="normal14a" width="88%"><input tabIndex="1" id="dateyy1"   onKeyPress="keyFunction()"    type="text" name="dateyy1"  value="<?php echo $dateyy1; ?>"  size="10"  /></td>
	  </tr>
	   <tr>
	    <td class="normal14z"  width="12%">選擇結轉期別：</td>
        <td class="normal14a" width="88%"><input tabIndex="2" id="datemm1"  readonly="readonly" onKeyPress="keyFunction()"    type="text" name="datemm1"  value="<?php echo $datemm1; ?>"  size="10"  /></td>
	  </tr>  
    </table>
	    <span style="color:#006600;font-weight:bold;">預估計算進度條</span> <br/>
		<div id="progressbar" style="width:420px;height:25px;border:1px solid #0000FF;"></div><br>
		
	<!--	<a onclick="return doit();" class="button"><span>計算&nbsp</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a> -->
	    
		<!--<div class="buttons">
	      <button type='submit' onclick="return doit();"  tabIndex="98" accesskey="c" name='submit'  class="button"   target="_new" value='&nbsp;計 算F8&nbsp;'><span>計 算Alt+c</span><img src="<?php echo base_url()?>assets/image/png/cal.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/109'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
	    </div>-->
        </form>
		 <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 範例說明:年底月結201712月,傳票過帳201800 再月結201800月,傳票過帳201801,再查試算表201801, 即可看到所有報表皆平衡. ] ' ?> </div>  <?php } ?>
  
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php include("./application/views/fun/actb09_funjs_v.php"); ?>
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
