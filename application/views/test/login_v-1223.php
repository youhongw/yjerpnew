<!DOCTYPE html>
<html lang="zh-TW">
<head>
<meta charset="utf-8">
<title>雲端ERP企業資源管理系統</title>
<?php $this->load->helper('url');?>
<link href="<?=base_url()?>assets/image/icon.png" rel="icon" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/stylesheet/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/stylesheet/login.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/javascript/jquery/qaptcha/QapTcha.jquery.css" />
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link type="text/css" href="<?=base_url()?>assets/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/superfish/js/superfish.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/common.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery.maskedinput.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/qaptcha/QapTcha.jquery.js"></script>

<style> input:focus {background-color: yellow;} </style>

<script type="text/javascript">
//-----------------------------------------
// Confirm Actions (delete, uninstall)
//-----------------------------------------
$(document).ready(function(){
    // Confirm Delete
    $('#form').submit(function(){
        if ($(this).attr('action').indexOf('delete',1) != -1) {
            if (!confirm('確認?(Confirm?)')) {
                return false;
            }
        }
    });
    	
    // Confirm Uninstall
    $('a').click(function(){
        if ($(this).attr('href') != null && $(this).attr('href').indexOf('uninstall', 1) != -1) {
            if (!confirm('確認?(Confirm?)')) {
                return false;
            }
        }
    });
});
</script>

<script language="JavaScript" type="text/javascript"> <!--
function setFocus(){
　for(var i=0; i<document.forms[0].elements.length; i++) {
　　var e = document.forms[0].elements[i];
　　if (e.type=="text") {
　　　e.focus();
　　　break;
　　}
　}
} 
//--> </script>

</head>
<body onload="setFocus()">

<div id="container">
  <div id="header">
    <div class="div1">
      <div class="div2"><img src="<?=base_url()?>assets/image/logo.png" title="管理介面(Administration)" onclick="location = '<?=base_url()?>index.php/login'" /></div>
    </div>
  </div>
  
<div id="content">
  <div class="box" style="width: 400px; min-height: 300px; margin-top: 40px; margin-left: auto; margin-right: auto;">
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/lockscreen.png" alt="" /> 雲端ERP企業資源管理系統</h1>
    </div>
	
    <div class="content" style="min-height: 150px; overflow: hidden;">
	<?php
	  $username=$this->input->post('username');
	  $password=$this->input->post('password');
	  $message=' ';
	?>
	<form method="post" action="<?php echo site_url('login/check_login'); ?>" enctype="multipart/form-data" id="form">
        <table style="width: 100%;">
          <tr>
            <td style="text-align: center;" rowspan="4"><img src="<?=base_url()?>assets/image/login.png" alt="雲端ERP企業資源管理系統" /></td>
          </tr>
		  
          <tr>
            <td>使用者代號<br /><input type="text" name="username" value="<?php echo set_value('username'); ?>" style="margin-top: 4px;" />
              <br /><br />密碼<br />
              <br /><input type="password" name="password" value="<?php echo set_value('password');  ?>" style="margin-top: 4px;" />
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
            <td style="text-align: right;"><a onclick="$('#form').submit();" class="button">登入</a></td>  
          </tr>  
		   <?php }else{ ?>
		  <tr>
            <td style="text-align: right;">
				<input id="submit" style="display:none;" type="submit" onclick="$('#form').submit();" value="登入" class="button" />
			</td>
          </tr>
		 <?php }  ?>

        </table>
		</form>
			 
		<?php
           if ( $query > 0)  
		     {
               foreach($query->result() as $row)
                {
                  $mf001=$row->mf001; // 讀出mf001欄位的資料
                  $mf003=$row->mf003; // 讀出mf003欄位的資料
                  if ($mf001==$this->input->post('username') and $mf003==$this->input->post('password')) {echo  header( 'Location: index.php/main' ) ; } 
                }
             }
      
        if ($query != 1) {$message =' 帳號: '.$this->input->post('username').' 或密碼輸入錯誤!, 請重輸入';} else {echo '   ';}
	    if ((!$this->input->post('username')) and (!$this->input->post('password'))) { $message =' ' ; }
        ?>
       <br/>
       <?php if ($message!=' ') { ?>
	       <div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>
	</div>
  </div>
</div>
  
 <!-- <p class="footer">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;網頁本次下載 :  <strong>{elapsed_time}</strong> 秒</p> -->
	<div ><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
      <img src="<?=base_url()?>assets/image/logonew.png" align="middle" alt="" />
    </div>
</div>

<script type="text/javascript"><!--
	  $(document).ready(function(){
		  $('.QapTcha').QapTcha({
			  txtLock : '滑動解鎖防械器人程式,提升資安等級!',
			  txtUnlock : '',
			  PHPfile : 'assets/javascript/jquery/qaptcha/php/Qaptcha.jquery.php',
			  disabledSubmit:true,
			  idsubmit: 'submit'
		  });
	  });
//--></script>

<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#form').submit();
	}
});
//--></script> 
	
</div>
<div id="footer"><br />Design by <a tabIndex="-1" href="<?=base_url()?>" target="_blank">個人電腦,筆電,平板,手機四合一雲端ERP</a> &copy; 2013-2014 Project </div>
</body>
</html>