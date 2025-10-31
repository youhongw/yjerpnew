<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!-- <title>雲端ERP企業資源管理系統</title> -->
<title><?php echo $systitle ?></title>
<?php $this->load->helper('url');?>
<?php $this->load->library("session"); ?>
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/stylesheet.css" /> 
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/jquery-1.7.1.min.js"></script> 
<!-- <script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/jquery-1.9.1.js"  ></script> -->
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link type="text/css" href="<?php echo base_url()?>assets/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<!-- 網頁頁簽及下拉選單  -->
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/superfish/js/superfish.js"></script>
<!-- 確保每個模塊在其自己的命名空間中執行，定義了一個模塊格式來解決JavaScript範圍問題 -->
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/common.js"></script>
<!-- input 輸入格式插件  -->
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery.maskedinput.js"></script>
<!--     jQuery 套件能在網頁上增加一個遮罩的圖層，阻擋使用者在操作別的步驟 -->
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery.blockUI.js"></script>
<!-- 按enter鍵  -->
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/js/entertab.js"></script>
<!-- 行事曆NEW  -->
 <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css"  /> 
 <script type="text/javascript" src="<?php echo base_url()?>assets/jquery/jquery.mCustomScrollbar.concat.min.js"></script> 
<style> input:focus {background-color: yellow;outline:none;border: 1px solid;} </style>  <!-- white  yellow欄位游標停留變黃色  -->
<style>label { display:block;}</style>   <!--欄位標題顯示方框, 如廠商多標簽選項 -->
<!-- rwd  -->
<style>
@media (max-width: 480px) {
	#header{
		min-width:100%;
	}
	
	.div1{
		width:1370px !important;
	}
	
	.box2 > .heading{
		width:1384px !important;
	}
	
	table{
		width:1400px !important;
	}
	
	#content{
		width:1370px !important;
	}
	
	#footer{
		min-width:1400px !important;
	}
}
</style>
<!-- 分頁美化  -->
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
    $('#form3').submit(function(){
        if ($(this).attr('action').indexOf('delete',1) != -1) {
            if (!confirm('確定要選取結案嗎?')) {
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
</script>

<!-- 閒置超時，系統強制登出  1000毫秒=1秒, 7200000=2小時 ,32800000 8小時 -->
<script language="javascript">    
//	function Msg(){
//		alert("閒置超時，系統強制登出!");
//		location="<?php echo base_url()?>";
//	}
//	window.setInterval("Msg()",32800000);
	
	function CheckForm1()
      {
        if(confirm("確定要取消確認此筆嗎？")==true)
           return true;
        else
           return false;
      }
	  function CheckForm2()
      {
        if(confirm("確定要單據作廢此筆嗎？")==true)
           return true;
        else
           return false;
      }
	  function CheckForm3()
      {
        if(confirm("確定要取消結案此筆嗎？")==true)
           return true;
        else
           return false;
      }
	  function CheckForm()
      {
        if(confirm("確認要列印此筆嗎？")==true)
           return true;
        else
           return false;
      }
	  function Checkdel()
      {
        if(confirm("確認要刪除此已上傳資料嗎？")==true)
           return true;
        else
           return false;
      }
	  
	  function setFocus()                              
	  {
　       for(var i=0; i<document.forms[0].elements.length; i++) 
           {
　      　   var e = document.forms[0].elements[i];
　      　   if (e.type=="text" ) 
               {
　　　           e.focus();
　　　           break;
　　           }
　         }
     } 
	  
</script>

</head>
<body onload="setFocus()" >
<?php $this->load->view($menu_v);?>
<?php $this->load->view($content_v);?>
<?php $this->load->view($foot_v);?>
</body>
</html>
