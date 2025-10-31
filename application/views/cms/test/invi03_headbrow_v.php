<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>雲端ERP企業資源管理系統</title>
<?php $this->load->helper('url');?>
<?php $this->load->library("session"); ?>
<link href="<?=base_url()?>assets/image/icon.png" rel="icon" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/stylesheet/stylesheet.css" /> 
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link type="text/css" href="<?=base_url()?>assets/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/superfish/js/superfish.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/common.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery.maskedinput.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery.blockUI.js"></script>

<style> input:focus {background-color: yellow;} </style>  <!--欄位游標停留變黃色  -->
<style>label { display:block;}</style>   <!--欄位標題顯示方框 -->

</style>
<script type="text/javascript">
//-----------------------------------------
// Confirm Actions (delete, uninstall)
//-----------------------------------------
$(document).ready(function(){
    // Confirm Delete
    $('#form').submit(function(){
        if ($(this).attr('action').indexOf('delete',1) != -1) {
            if (!confirm('刪除資料後您將不能恢復，確定要刪除嗎?')) {
                return false;
            } 
        }
    });
 
	// Confirm Uninstall
    $('a').click(function(){
        if ($(this).attr('href') != null && $(this).attr('href').indexOf('uninstall', 1) != -1) {
            if (!confirm('刪除或卸載後您將不能恢復，請確定要這麼做嗎?')) {
                return false;
            }
        }
    });
	
});

$(function()
   {
	 $(document).keydown(function(e)
       {
		if (e.keyCode == 113) {
	    	document.location='<?=base_url()?>index.php/inv/invi03';
	   }
	});
});
</script>

<script language="javascript">    <!-- 閒置超時，系統強制登出  1000毫秒=1秒, 7200000=2小時 -->
	function Msg(){
		alert("閒置超時，系統強制登出!");
		location="<?=base_url()?>";
	}
	window.setInterval("Msg()",7200000);
	
	function CheckForm()
      {
        if(confirm("確認要刪除此筆嗎？")==true)
           return true;
        else
           return false;
      }
</script>

<script language="JavaScript" type="text/javascript">   
    function setFocus()                              <!--自動檢查輸入欄位游標停留變黃色  -->
	  {
　       for(var i=0; i<document.forms[0].elements.length; i++) 
           {
　      　   var e = document.forms[0].elements[i];
　      　   if (e.type=="text") 
               {
　　　           e.focus();
　　　           break;
　　           }
　         }
     } 

   function keyFunction()           //功能鍵設定
     {                
 // alert("Alt + "+event.keyCode); 
     if (event.keyCode==119) 
	   { 
        document.form.submit.focus();
　　    document.form.submit.click();
       }
 
     if (event.keyCode==120) 
	   {
       document.getElementById("cancel").focus();
	   document.getElementById("cancel").click();
       }

    }
    document.onkeydown=keyFunction;
</script>

<script type="text/javascript">   //標簽欄位切換
$('.htabs a').tabs();
$('.vtabs a').tabs();
</script>

</head>
<body onload="setFocus()" >
<style>
#page .pagination {padding: 10px; text-align: left;}
.pagination a {margin: 0; padding: 3px 6px; border: 1px solid #777;text-decoration:none;}
.pagination a:hover,.pagination a.current {border-color: #000 !important;background:#ddd;}

#form :focus{ 

　　-webkit-box-shadow: 0px 0px 4px #aaa; 

　　-moz-box-shadow: 0px 0px 4px #aaa; 

　　box-shadow: 0px 0px 4px #aaa; 

　　} 
</style>
<?php $this->load->view($content_v);?>
<?php $this->load->view($foot_v);?>
</body>
</html>
