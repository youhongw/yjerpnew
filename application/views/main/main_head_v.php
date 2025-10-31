<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">

<head>
 <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 

<!-- <title>雲端ERP企業資源管理系統</title> -->
<title><?php echo $systitle; ?></title>
  <?php $this->load->helper('url');?>
  <?php $this->load->library("session"); ?>
<link href="<?=base_url()?>assets/image/icon.png" rel="icon" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/stylesheet/stylesheet.css" />
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/jquery-1.9.1.js"  ></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link type="text/css" href="<?=base_url()?>assets/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/superfish/js/superfish.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/common.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery.maskedinput.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery.blockUI.js"></script>

<!-- 日期開視窗NEW  -->
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/show_ads.js"></script>

<!-- <script type="text/javascript" src="<?=base_url()?>assets/javascript/js/jquery.js"></script> -->
<!-- <script type="text/javascript" src="<?=base_url()?>assets/javascript/js/jquery-ui.min.js"></script> -->

<!-- 下拉視窗 test 年月 1129 -->
<!-- <script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/placeholder.js"></script> -->

 <!--  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script> -->
<!--   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>   -->
 <!--  <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css"> <!--
<!-- 日期開視窗  -->
<!-- <link rel="stylesheet"  href="<?=base_url()?>assets/javascript/jquery/ui/themes/base/jquery.ui.datepicker.css" /> -->
<!-- <script  src="<?=base_url()?>assets/javascript/jquery/ui/i18n/jquery.ui.datepicker-zh-TW.js"></script>  -->

<!-- 驗證各欄位  -->
<!-- <script  src="<?=base_url()?>assets/validate/lib/jquery.js"></script>  -->
<script  src="<?=base_url()?>assets/validate/jquery.validate.js"></script> 
<script  src="<?=base_url()?>assets/validate/localization/messages_zh_TW.js"></script>

<!-- Ajax 批次光棒  -->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">


<!-- <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/stylesheet/screen.css" />  -->
<!--  <link type="text/javascript"   src="<?=base_url()?>assets/javascript/js/global.js" /> -->



<script type="text/javascript"><!--  
$(document).ready(function(){
$(function() {
    $("input[id^='datepicker']").datepicker({
        showButtonPanel: true,dateFormat: 'yymmdd'
    });
});
});
//--></script> 	

<!-- 年月視窗 1031130  -->
<script type="text/javascript">

 function dateym() {
 $(function() {
    $('.date-picker').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy/MM',
        onClose: function(dateText, inst) { 
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        }
    });
	  });
};

</script>
<style>
.ui-datepicker-calendar {
    display: none;
    }
</style>
	
<!--[if IE 7]> 
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/stylesheet/ie7.css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/stylesheet/ie6.css" />
<script type="text/javascript" src="<?=base_url()?>assets/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('#logo img');
</script>
<![endif]-->

<script>    //檢查欄位輸入錯誤
//$.validator.setDefaults({
//	submitHandler: function() { alert("submitted!"); }
//});

$().ready(function() {
	// validate the comment form when it is submitted
	$("#commentForm").validate();	
	//code to hide topic selection, disable for demo
	var newsletter = $("#newsletter");
	// newsletter topics are optional, hide at first
	var inital = newsletter.is(":checked");
	var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
	var topicInputs = topics.find("input").attr("disabled", !inital);
	// show when newsletter is checked
	newsletter.click(function() {
		topics[this.checked ? "removeClass" : "addClass"]("gray");
		topicInputs.attr("disabled", !this.checked);
	});  
});
</script>

<style type="text/css">   <!--欄位輸入錯誤提示   -->
#commentForm { width: 1190px; }
#commentForm label { width: 220px; }
#commentForm label.error, #commentForm input.submit { margin-left: 1px; }
#newsletter_topics label.error {
	display: none;
	margin-left: 13px;
}
</style>	
<style> input:focus {background-color: yellow;} </style>  <!--欄位游標停留變黃色  -->
<style>label { display:block;}</style>   <!--欄位標題顯示方框 -->

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
{
window.open('/index.php/inv/invi04/printdetail')
}

function open_winexcel()
{
window.open('/index.php/inv/invi04/exceldetail')
}
</script>

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
	    	document.location='<?=base_url()?>index.php/main';
	   }
	});
});
</script>
<script language="javascript">     //閒置超時，系統強制登出  1000毫秒=1秒, 7200000=2小時 8小時 328
//	function Msg(){
//		alert("閒置超時，系統強制登出!");
//		location="<?=base_url()?>";
//	}
//	window.setInterval("Msg()",32800000);
	
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
　      　   if (e.type=="text" || e.type ) 
               {
　　　           e.focus();
　　　           break;
　　           }
　         }
     } 
	 
   function keyFunction()           //功能鍵設定 f8 存檔  f9 返回 insert 新增明細
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
	  if (event.keyCode==45) 
	   {
       document.getElementById("insert").focus();
	   document.getElementById("insert").click();
       }

    }
    document.onkeydown=keyFunction;
</script>
  
  
<script type="text/javascript">   //標簽欄位切換
$(function(){
	// 預設顯示第一個 Tab
	var _showTab = 0;
	$('.abgne_tab').each(function(){
		// 目前的頁籤區塊
		var $tab = $(this);
 
		var $defaultLi = $('ul.tabs li', $tab).eq(_showTab).addClass('active');
		$($defaultLi.find('a').attr('href')).siblings().hide();
 
		// 當 li 頁籤被點擊時...
		// 若要改成滑鼠移到 li 頁籤就切換時, 把 click 改成 mouseover
		$('ul.tabs li', $tab).click(function() {
			// 找出 li 中的超連結 href(#id)
			var $this = $(this),
				_clickTab = $this.find('a').attr('href');
			// 把目前點擊到的 li 頁籤加上 .active
			// 並把兄弟元素中有 .active 的都移除 class
			$this.addClass('active').siblings('.active').removeClass('active');
			// 淡入相對應的內容並隱藏兄弟元素
			$(_clickTab).stop(false, true).fadeIn().siblings().hide();
 
			return false;
		}).find('a').focus(function(){
			this.blur();
		});
	});
});

</script>

<script type="text/javascript"><!--
$(document).ready(function() {
   	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
});
//--></script> 

<script type="text/javascript"><!-- 	// enterkey 測試   
	$(document).ready(function(){ 	   
//	$('#mb001').focus(); 	   
	Enterkey(); 	   
	}); 	   
</script> 	   
		   
<script type="text/javascript"><!-- 	// enterkey 測試    
	function Enterkey() { 	   
	$("input").not( $(":button") ).keypress(function (evt) { 	   
	if (evt.keyCode == 13) { 	   
	if ($(this).attr("type") !== 'submit'){ 	   
	var fields = $(this).parents('form:eq(0),body').find('input, textarea, checkbox, radio'); 	   
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
</script>
 
<script type="text/javascript">
				document.observe('dom:loaded', function() {

					// first manuale progressbar : different bar (width, height, images) and no animation
					manualPB = new JS_BRAMUS.jsProgressBar(
								$('element5'),
								75,
								{
									showText	: false,
									animate		: false,
									width		: 354,
									height		: 21,
									boxImage	: 'custom1_box.gif',
									barImage	: 'custom1_bar.gif'
								}
							);
				}, false);
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
<?php $this->load->view($menu_v);?>
<?php $this->load->view($content_v);?>
<?php $this->load->view($foot_v);?>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/js/entertab.js"></script>
 <script type="text/javascript"> 
   $(document).ready(function() {
	  addItem(); 
	  //一進入程式就執行新增一筆明細
});
//--></script>
</body>
</html>
