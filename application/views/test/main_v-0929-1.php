<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<meta charset="utf-8">
	
	<title>雲端ERP企業資源管理系統</title>
	<?php $this->load->helper('url');?>
<link href="<?=base_url()?>assets/image/icon.png" rel="icon" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/stylesheet/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/stylesheet/login.css" />
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link type="text/css" href="<?=base_url()?>assets/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/superfish/js/superfish.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/common.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery.maskedinput.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery.blockUI.js"></script>
<!--[if IE 7]> 
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/stylesheet/ie7.css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/ie6.css" />
<script type="text/javascript" src="h<?=base_url()?>assets/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('#logo img');
</script>
<![endif]-->

<script type="text/javascript">
//-----------------------------------------
// Confirm Actions (delete, uninstall)
//-----------------------------------------
$(document).ready(function(){
    // Confirm Delete
    $('#form').submit(function(){
        if ($(this).attr('action').indexOf('delete',1) != -1) {
            if (!confirm('刪除或卸載後您將不能恢復，請確定要這麼做嗎?')) {
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
			<script language="javascript">
	function Msg(){
		alert("閒置超時，系統強制登出!");
		location="<?=base_url()?>index.php/login";
	}
	window.setInterval("Msg()",7200000);
//--></script>


</head>
<body>
			<div id="container">
<div id="header">
  <div class="div1">
    <div class="div2"><a href="<?=base_url()?>index.php/main">雲端ERP企業資源管理系統</a></div>
        <div class="div3">
		<img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span>89044</span> 已登錄 　
		<img src="<?=base_url()?>assets/image/lock.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">帳戶管理</a>　
		<img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>
	</div>
      </div>
    <div id="menu">
    <ul class="left" style="display: none;">
      <li id="dashboard"><a href="<?=base_url()?>index.php/main" class="top">管理首頁 F2</a></li>
	  
	  <li id="customers"><a class="top">票據管理</a>
		<ul>
		  <li><a class="parent">基本資料</a>
            <ul>
              <li><a href="<?=base_url()?>index.php/welcome">銀行帳號建立</a></li>
			  <li><a href="<?=base_url()?>index.php/welcome">票據科目建立</a></li>
			  <li><a href="<?=base_url()?>index.php/welcome">單據性質設定</a></li>
            </ul>
          </li>
		  <li><a href="<?=base_url()?>index.php/welcome">應付票據建立</a></li>
		  <li><a href="<?=base_url()?>index.php/welcome">應收票據建立</a></li>
		  <li><a href="<?=base_url()?>index.php/welcome">票據底稿產生作業</a></li>
        </ul>
	  </li>
	  
	  <li id="supplies"><a class="top">資金管理</a>
		<ul>
		  <li><a class="parent">基本資料</a>
            <ul>
              <li><a href="<?=base_url()?>index.php/welcome">融資種類建立</a></li>
			  <li><a href="<?=base_url()?>index.php/welcome">預計收支建立</a></li>
			  <li><a href="<?=base_url()?>index.php/welcome">銀行存款存提建立作業</a></li>
            </ul>
          </li>
		  <li><a href="<?=base_url()?>index.php/welcome">掋押資料建立</a></li>
		  <li><a href="<?=base_url()?>index.php/welcome">借&還款資料建立</a></li>
		  <li><a href="<?=base_url()?>index.php/welcome">融資&撤票建立作業</a></li>
        </ul>
	  </li>
	  
	  <li id="materials"><a class="top">自動分錄管理</a>
        <ul>
            <li><a href="<?=base_url()?>index.php/welcome">自動分錄參數設定</a></li>
			<li><a href="<?=base_url()?>index.php/welcome">自動分錄性質設定</a></li>
			<li><a href="<?=base_url()?>index.php/welcome">還原分錄底稿作業</a></li>
			<li><a href="<?=base_url()?>index.php/welcome">產生分錄底稿作業</a></li>
			<li><a href="<?=base_url()?>index.php/welcome">分錄底稿維護作業</a></li>
        </ul>
      </li>
	  
	  <li id="materials"><a class="top">自動傳票管理</a>
        <ul>
            <li><a href="<?=base_url()?>index.php/welcome">還原會計傳票作業</a></li>
			<li><a href="<?=base_url()?>index.php/welcome">拋轉會計傳票作業</a></li>
        </ul>
      </li>
	  
	  <li id="ledger"><a class="top">會計總帳管理</a>
		<ul>
		  <li><a class="parent">基本參數設定</a>
			<ul>
				<li><a href="<?=base_url()?>index.php/welcome">會計參數設定</a></li>
				<li><a href="<?=base_url()?>index.php/welcome">會計期間設定</a></li>
				<li><a href="<?=base_url()?>index.php/welcome">部門層級建立</a></li>
				<li><a href="<?=base_url()?>index.php/welcome">報表格式建立</a></li>
				
			</ul>
		  </li>
		  <li><a class="parent">科目管理</a>
			<ul>
				<li><a href="<?=base_url()?>index.php/welcome">科目部門建立</a></li>
				<li><a href="<?=base_url()?>index.php/welcome">科目資料建立作業</a></li>
				<li><a href="<?=base_url()?>index.php/welcome">單據性質設定</a></li>
				<li><a href="<?=base_url()?>index.php/welcome">常用傳票建立作業</a></li>
				<li><a href="<?=base_url()?>index.php/welcome">常用傳票複製作業</a></li>
			</ul>
		  </li>
		  <li><a class="parent">傳票管理</a>
			<ul>
				<li><a href="<?=base_url()?>index.php/welcome">會計傳票建立作業</a></li>
				<li><a href="<?=base_url()?>index.php/welcome">傳票整批過帳作業</a></li>
				<li><a href="<?=base_url()?>index.php/welcome">月底結轉作業</a></li>
				<li><a href="<?=base_url()?>index.php/welcome">指定關帳作業</a></li>
			</ul>
		  </li>
		  <li><a href="<?=base_url()?>index.php/welcome">報表管理</a></li>
		  <li><a class="parent">統計報表</a>
			<ul>
				<li><a href="<?=base_url()?>index.php/welcome">試算表</a></li>
				<li><a href="<?=base_url()?>index.php/welcome">損益表</a></li>
				<li><a href="<?=base_url()?>index.php/welcome">資產負債表</a></li>
			</ul>
		  </li>
		  <li><a class="parent">明細報表</a>
			<ul>
				<li><a href="<?=base_url()?>index.php/welcome">日計表表</a></li>
				<li><a href="<?=base_url()?>index.php/welcome">日記帳</a></li>
				<li><a href="<?=base_url()?>index.php/welcome">明細分類帳</a></li>
			</ul>
		  </li>
        </ul>
	  </li>

    </ul>
	
    <ul class="right" style="display: none;">
	  <li id="detail"><a class="top">細節設置</a>
        <ul>
		  <li><a class="parent">區域設置</a>
            <ul>
              <li><a href="<?=base_url()?>index.php/welcome">國家設置</a></li>
              <li><a href="<?=base_url()?>index.php/welcome">縣市設置</a></li>
			  <li><a href="<?=base_url()?>index.php/welcome">地區設置</a></li>
            </ul>
          </li>
		  <li><a href="<?=base_url()?>index.php/welcome">貨幣設置</a></li>
		  <li><a href="<?=base_url()?>index.php/welcome">訂單狀態</a></li>
		  <li><a href="<?=base_url()?>index.php/welcome">運送設置</a></li>
        </ul>
      </li>
	  <li id="tax"><a class="top">稅率設置</a>
                <ul>
                  <li><a href="<?=base_url()?>index.php/welcome">稅率類別</a></li>
                  <li><a href="<?=base_url()?>index.php/welcome">商品稅率</a></li>
                </ul>
      </li>
	  <li id="system"><a class="top">系統管理</a>
        <ul>
		  <li><a href="<?=base_url()?>index.php/welcome">系統設置</a></li>
          <li><a href="<?=base_url()?>index.php/welcome">使用者</a></li>
          <li><a href="<?=base_url()?>index.php/welcome">使用者群組</a></li>
          <li><a href="<?=base_url()?>index.php/welcome">錯誤日誌</a></li>
          <li><a href="<?=base_url()?>index.php/welcome">數據維護</a></li>
        </ul>
      </li>
    </ul>
  </div>
  </div>
<div id="content">
  <div class="breadcrumb">

  </div>
    <div class="box">
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/home.png" alt="" /> 系統首頁</h1>
    </div>
	
    <div class="content">
	  
	    <div class="home1" style="margin-left: 10px; margin-right: 10px;">
		  <div class="home-heading">
		  
			<li><h2><img src="<?=base_url()?>assets/image/products.png"/>基本資料管理</h2></li>
		  </div>
		  
		  <div class="home-content">
			<a onclick="location = '<?=base_url()?>index.php/inv/invi01/index'" class="button">品號類別建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/inv/invi01/display'" class="button">品號基本資料建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">客戶基本資料建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">訂單管理單據性質建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">廠別資料建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">庫別資料建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">員工姓名建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br><br>
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">部門資料建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">廠商資料建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">常用摘要建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">幣別匯率建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">職務類別建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">簽核建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">客戶基本資料建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br><br>
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">採購管理單據性質建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">庫存管理單據性質建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  </div>
		</div>
	<br><br>
		<div class="home2" style="margin-left: 10px; margin-right: 10px;">
		  <div class="home-heading">
			<li><h2><img src="<?=base_url()?>assets/image/suppliers.png"/>日常異動管理</h2></li>
		  </div>
		    <div class="home-content">
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">客戶報價單建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">客戶訂單建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">銷貨單建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">銷退單建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">訂單變更建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">客戶商品計價建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">外銷客戶品號建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br><br>
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">廠商核價資料建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">請購單建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">請購單資料維護作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">採購單建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">進貨單建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">退貨單建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">加工計價資料建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br><br>
		    <a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">製造命令建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">領料單建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">退料單建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">託外進貨單建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">託外退貨單建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">生產入庫單建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">調撥單建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						
		  </div>
		</div>
		<br><br>
		<div class="home3" style="margin-left: 10px; margin-right: 10px;">
		  <div class="home-heading">
			<li><h2><img src="<?=base_url()?>assets/image/customer.png"/>報表列印管理</h2></li>
		  </div>
		 
		  <div class="home-content">
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">客戶明細表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">報價單明細表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">客戶訂單明細表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">訂單變更明細表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">銷貨單明細表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">銷退單明細表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">應收帳款對帳單</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br><br>
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">廠商明細表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">請款單明細表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">進貨單明細表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">退貨單明細表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">應付帳款明細表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">庫存明細表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">進銷存明細表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  </div>
		</div>
		<br><br>
		<div class="home4" style="margin-left: 10px; margin-right: 10px;">
		  <div class="home-heading">
			<li><h2><img src="<?=base_url()?>assets/image/payroll.png"/>其他資料管理</h2></li>
		  </div>
		  
		  <div class="home-content">
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">使用者建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">群組資料建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">使用者權限建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">公司資料建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">付款條件建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">收款條件建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">應付單據性質建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br><br>
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">應付憑單自動結帳</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">應付憑單建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">付款單建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">應收單據性質建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">應收憑單自動結帳</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">應收憑單建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="location = '<?=base_url()?>index.php/welcome'" class="button">收款單建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  </div>
		</div>
		<br><br>
       </div>
  </div>
</div>
<!--[if IE]>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/flot/excanvas.js"></script>
<![endif]--> 
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/flot/jquery.flot.js"></script>

<script type="text/javascript"><!--
	$(document).ready(function(){
		if (1 == '3') {
			$('.home4 .home-content').slideDown('slow');
		} else if (1 == '2') {
			$('.home3 .home-content').slideDown('slow');
		} else if (1 == '1') {
			$('.home2 .home-content').slideDown('slow');
		} else {
			$('.home1 .home-content').slideDown('slow');
		}
	});
	
	$('.home-heading li').live('click', function() {
		
		$('.home-content').slideUp('slow');
		
		$(this).parent().parent().find('.home-content').slideDown('slow');
		
	});
//--></script> 
</div>
<div id="footer"><br />Design by <a href="http://www.youhongwang.com" target="_blank">個人電腦,筆電,平板,手機四合一雲端ERP</a> &copy; 2013-2014 Project </div>
</body></html>