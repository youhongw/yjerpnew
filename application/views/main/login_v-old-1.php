
<div id="container">      <!-- div-1 -->
  <div id="header">
    <div class="div1">
      <div class="div2"><img src="<?=base_url()?>assets/image/logo.png" title="管理介面(Administration)" onclick="location = '<?=base_url()?>index.php/login'" /></div>
    </div>
  </div>
  
<div id="content">       <!-- div-2 -->
  <div class="box" style="width: 400px; min-height: 300px; margin-top: 40px;margin-bottom:-25px; margin-left: auto; margin-right: auto;">  <!-- div-3 -->
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/lockscreen.png" alt="" /> 雲端ERP企業資源管理系統</h1>
    </div>
	
    <div class="content" style="min-height: 150px; overflow: hidden;">    <!-- div-4 -->
	<?php
	  $username=$this->input->post('username');
	  $password=$this->input->post('password');
	  $message=' ';
	?>
	<form method="post" action="<?php echo site_url('login/check_login'); ?>" enctype="multipart/form-data" id="form">
        <table style="width: 100%;background: #FFFAF0;">
          <tr>
            <td style="text-align: center;" rowspan="4"><img src="<?=base_url()?>assets/image/login.png" alt="雲端ERP企業資源管理系統" /></td>
          </tr>
		  
          <tr>
            <td>使 用 者:<input type="text" name="username" value="<?php echo set_value('username'); ?>" style="margin-top: 4px;" />
              </td>
              <td>密&nbsp;&nbsp;&nbsp;&nbsp;碼:<input type="password" name="password" value="<?php echo set_value('password');  ?>" style="margin-top: 4px;" />
			  <br /><br />驗&nbsp;證&nbsp;碼:<input type="text" name="captcha" value="<?php echo set_value('captcha');  ?>" style="margin-top: 0px;" /><span style="border:2px solid;background-color:#A1CBD7;;color:red;font-size:16px;text-align:center; ">&nbsp;<?php echo $this->session->userdata('captchaWord'); ?>
			  <a href="<?=base_url()?>" target="_self"><img src="<?=base_url()?>assets/image/reload.gif" /></a></span>
              <br /><br />
			  <?php if (strtoupper(substr(PHP_OS, 0, 3)) != 'WIN'){ ?>       
			    	  <div class="clr"></div>
					  <div class="QapTcha"></div>
					  <noscript><span style='color:red;'>錯誤：驗證碼與圖片驗證號碼不符!</span></noscript>
			  <?php }  ?>
            </td>
          </tr>
		  
          <tr>
            <td>&nbsp;<input type='hidden' name='act' id='act'/></td>
          </tr>
		  
		  <?php if (strtoupper(substr(PHP_OS, 0, 3)) != 'WIN'){ ?>
          <tr>
            <td style="text-align: right;"><a onclick="$('#form').submit();" class="button">登入&nbsp<img src="<?=base_url()?>assets/image/png/login.png" /></a></td>  
          </tr>  
		  <?php }else{ ?>
		  <tr>
            <td style="text-align: right;">
				<input id="submit" style="display:none;" type="submit" onclick="$('#form').submit();" value="登入&nbsp" class="button" /><img src="<?=base_url()?>assets/image/png/login.png" />
			</td>
          </tr>
		 <?php }  ?>

        </table>
	</form>
	<!-- <?php echo $this->session->userdata('sysml003'); ?>  -->
       
	   <?php
          if ($query != 1) {$message =' 帳號: '.$this->input->post('username').$err.' 或密碼輸入錯誤!';} else {echo '驗證碼輸入錯誤!';}
	      if ((!$this->input->post('username')) and (!$this->input->post('password'))) { $message =' ' ; }
       ?>
          <br/>
       <?php if ($message!=' ') { ?>
	     <div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>
	</div>   <!-- div-4 -->
  </div>     <!-- div-3 -->
</div>       <!-- div-2 -->
  
 <!-- <p class="footer">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;網頁本次下載 :  <strong>{elapsed_time}</strong> 秒</p> -->
	<div ><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
      <img src="<?=base_url()?>assets/image/logonew1.png" align="middle" alt="" /><br/><p></p>
	  <img src="<?=base_url()?>assets/image/logonew.png" align="middle" alt="" />
    </div>
</div>      <!-- div-1 -->

<script type="text/javascript"><!--
	  $(document).ready(function(){
		  $('.QapTcha').QapTcha({
			  txtLock : '滑動解鎖防機器人程式,提升資安等級!',
			  txtUnlock : '',
			  PHPfile : '<?=base_url()?>assets/javascript/jquery/qaptcha/php/Qaptcha.jquery.php',
			  disabledSubmit:true,
			  idsubmit: 'submit'
		  });
	  });
//--></script>
	
<script type="text/javascript"><!-- 	// enterkey =tabkey 功能   
	$(document).ready(function(){ 	   
//	$('#mb001').focus(); 	   
	Enterkey(); 	   
	}); 	   
//--></script> 	   
		   
<script type="text/javascript"><!-- 	// enterkey 功能    
	function Enterkey() { 	   
	$("input").not( $(":button") ).keypress(function (evt) { 	   
	if (evt.keyCode == 13) { 	   
	if ($(this).attr("type") !== 'submit'){ 	   
	var fields = $(this).parents('form:eq(0),body').find('input, textarea, checkbox'); 	   
	var index = fields.index( this ); 	   
	if ( index > -1 && ( index + 1 ) < fields.length ) { 	   
	fields.eq( index + 1 ).focus(); 	   
	} 	   
	$(this).blur(); 	   
	return false; 	   
	} 	   
	} 	   
	}); 	   
	} 	   
//--></script> 	 
