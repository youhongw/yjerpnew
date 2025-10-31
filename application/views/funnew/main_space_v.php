<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
 <meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"> 
 <!--<title>雲端ERP企業資源管理系統</title> -->
<title><?php echo $systitle; ?></title> 
  <?php $this->load->helper('url');?>
  <?php $this->load->library("session"); ?>
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/stylesheet.css" />
<!-- <script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/jquery-1.9.1.js"  ></script>  1040605 test-->
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link type="text/css" href="<?php echo base_url()?>assets/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/superfish/js/superfish.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/common.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery.maskedinput.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery.blockUI.js"></script>
<!-- 進度條  -->
<script type="text/javascript" src="<?php echo base_url()?>assets/jquery/circle-progress.js"></script>
<!-- ckedit  -->
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/ckeditor/ckeditor.js"></script>
<!-- 日期開視窗NEW  -->
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/show_ads.js"></script>

<!-- 下拉視窗 test 年月 1070331 -->
<!-- <script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/Calendar_ym.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/placeholder.js"></script> -->

<!-- 日期開視窗  -->
<!-- <link rel="stylesheet"  href="<?php echo base_url()?>assets/javascript/jquery/ui/themes/base/jquery.ui.datepicker.css" /> -->
<!-- <script  src="<?php echo base_url()?>assets/javascript/jquery/ui/i18n/jquery.ui.datepicker-zh-TW.js"></script>  -->

<!-- 驗證各欄位  -->
<script  src="<?php echo base_url()?>assets/validate/jquery.validate.js"></script> 
<script  src="<?php echo base_url()?>assets/validate/localization/messages_zh_TW.js"></script>

<!-- Ajax 批次光棒  -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/javascript/jquery/ui/jquery-ui.css">
<!-- 開視年月 -->

</head>
<body >
<!-- rwd  -->
  <!--  <a id="btn1" class="btn1">測試封鎖</a> -->
    <br />
   <!-- <a id="btn2" class="btn2" >測試不封鎖</a> -->
	<div id="btn1">
<a onclick="btn1()">Onload Autoclick me !!</a>
</div>
	
   <script type="text/javascript">

   function myFunction() {
    console.log("Hello World");
}

   
 //setInterval( "btn2()", 5000 );  // run
 // window.setInterval("btn2()",1);
  
        function newwin() {
            window.open('https://www.google.com.tw/', '_blank');
        }

function btn1() {
        $('#btn1').click(function () {
			window.open('https://www.google.com.tw/', '_blank');
			console.log('test-ok');
            $.ajax({
                url: '/G01_a25_1/ci3110/assets/javascript/data.js',
                dataType: 'json',
                success: function (data) {
                    newwin();
                }
            });
        });
}
	
      //  $('#btn2').click(function () {
            //一定要放在呼叫ajax 之前
			function btn21() {
			console.log("Hello World");
            var w = window.open('');
            $.ajax({
                url: '/G01_a25_1/ci3110/assets/javascript/data.js',
                dataType: 'json',
                success: function (data) {
                   
                    $.ajax({
                        url: '/G01_a25_1/ci3110/assets/javascript/newsite.js',
                        dataType: 'text',
                        success: function (data) {
                            w.location = data;
                        }
                    });
                }
            });
            }
     //   });
 $(document).ready(function () {
    $('#btn1 a').get(0).click();
});
    </script>
</body>
</html>