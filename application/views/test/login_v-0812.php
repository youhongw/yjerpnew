<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<meta charset="utf-8">
	
	<title>雲端ERP企業資源管理系統</title>
	<?php $this->load->helper('url');?>
<link href="<?=base_url()?>assets/image/icon.png" rel="icon" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/stylesheet/stylesheet.css" />
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link type="text/css" href="<?=base_url()?>assets/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/superfish/js/superfish.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/common.js"></script>
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
</head>
<body>

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
	 
                  <form action="" method="post" enctype="multipart/form-data" id="form">
        <table style="width: 100%;">
          <tr>
            <td style="text-align: center;" rowspan="4"><img src="<?=base_url()?>assets/image/login.png" alt="雲端ERP企業資源管理系統" /></td>
          </tr>
          <tr>
            <td>使用者代號<br />
              <input type="text" name="username" value="<?php $username  ?>" style="margin-top: 4px;" />
              <br />
              <br />
              密碼<br />
              <input type="password" name="password" value="<?php $password  ?>" style="margin-top: 4px;" />
                            <br />
              <a href="http://dercaster.com/ci/index.php/forgotten">忘記密碼</a>
                            </td>
          </tr>
          <tr>
            <td>&nbsp;<input type='hidden' name='act' id='act'/></td>
          </tr>
          <tr>
            <td style="text-align: right;"><a onclick="$('#form').submit();" class="button">登入</a></td>
          </tr>
        </table>
              </form>
			 
			  <?php
			
if ( $query->num_rows() > 0)  {

foreach($query->result() as $row)
    {
        $mf001=$row->mf001; // 讀出mf001欄位的資料
        $mf003=$row->mf003; // 讀出mf003欄位的資料
        if ($mf001==$this->input->post('username') and $mf003==$this->input->post('password')) {echo  header( 'Location: index.php/main' ) ; } 
            	
    }
}
      if ($this->input->post('password')!='') {echo '帳號'.$this->input->post('username').' 或密碼輸入錯誤!, 請重輸入';$username=$this->input->post('username');$password=$this->input->post('password');} else {echo '   ';}
	  
?>

    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#form').submit();
	}
});
//--></script> 
	<p class="footer">網頁本次下載 :  <strong>{elapsed_time}</strong> 秒</p>
	<div >
      <img src="<?=base_url()?>assets/image/logo.jpg" align="middle" alt="" />
    </div>
</div>
<div id="footer"><br />Design by <a href="http://www.youhongwang.com" target="_blank">個人電腦,筆電,平板,手機四合一雲端ERP</a> &copy; 2013-2014 Project </div>

</body>
</html>