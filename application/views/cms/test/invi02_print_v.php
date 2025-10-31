<!DOCTYPE html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" xml:lang="zh-TW" lang="zh-TW">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
<style> input:focus {background-color: yellow;} </style>
<script>
function open_win()
{
window.open("/index.php/inv/invi01/printa")
}
function open_winexcel()
{
window.open("/index.php/inv/invi01/write")
}
</script>


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
		
		document.location='<?=base_url()?>index.php/inv/invi01/editorm';
    });
    	
    // Confirm Uninstall
    $('a').click(function(){
        if ($(this).attr('href') != null && $(this).attr('href').indexOf('uninstall', 1) != -1) {
            if (!confirm('刪除或卸載後您將不能恢復，請確定要這麼做嗎?')) {
                return false;
            }
        }
	
		document.location='<?=base_url()?>index.php/inv/invi01/editform';
    });
});

$(function()
{
	$(document).keydown(function(e)
    {
		if (e.keyCode == 113) {
			document.location='<?=base_url()?>';
		}
	});
});
//--></script>
<script language="javascript">
    
	function Msg(){
		alert("閒置超時，系統強制登出!");
		location="<?=base_url()?>";
	}
	window.setInterval("Msg()",7200000);
</script>
</head>
<body>

<			<div id="container">
<div id="header">
  <div class="div1">
    <div class="div2"><a href="<?=base_url()?>index.php/main">雲端ERP企業資源管理系統</a></div>
        <div class="div3">
		<img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
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
  
  <?php
    //date_default_timezone_set("Asia/Taipei");
	
	$ma001c=$this->input->post('ma001c');
	$ma002c=$this->input->post('ma002c');
	$ma003c=$this->input->post('ma003c');
	$ma004c=$this->input->post('ma004c');
	echo date("Ymd");
	$this->load->helper('url');	
	?>
 <div class="box">
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 品號類別資料建立作業</h1>
	   <form action="<?=base_url()?>index.php/inv/invi01/printa"  method="post"  enctype="multipart/form-data" id="form"> 
	<!--    <form action=""  method="post"  enctype="multipart/form-data" id="form"> -->
      <div class="buttons">
	   <!--     <a onclick="open_win();"   class="button">列印</a>    -->
        
	    <button type='submit'  name='buttoncopy' class="button"  target="_new" value='列印'><span>列印</span></button> 
	 <!--   	 <a onclick="open_winexcel();"   class="button">轉EXCEL檔</a>   -->
		 <a href="<?php echo site_url('inv/invi01/display'); ?>" class="button" ><span>取消</span></a>
	   <!--   <a onclick="$('#form').submit();" class="button"><span>儲存</span></a>  -->
		  
	  </div>
    </div>
    <div class="content">
	<div id="htabs" class="htabs"><a href="#tab-general">列印項目-明細</a></div>
	
	

<?php 

// $this->load->helper('url');	
	?>
    <!--  <form action="<?=base_url()?>index.php/inv/invi01/updsave/$this->input->post('ma001')/$this->input->post('ma002')/$this->input->post('ma003')/$this->input->post('ma004')" method="post" enctype="multipart/form-data" id="form">  -->
        <div id="tab-general">
		<table class="form">
          <tr>
			<td width="20%">&nbsp;&nbsp;起始分類方式：</td>
            <td width="30%">
				<select name="ma001c">
                											<option <?php if($ma001c == '1') echo 'selected="selected"';?> value='1'>會計</option>                                                                        
																		<option <?php if($ma001c == '2') echo 'selected="selected"';?> value='2'>商品</option>
                                                                        <option <?php if($ma001c == '3') echo 'selected="selected"';?> value='3'>類別</option>
                                                                        <option <?php if($ma001c == '4') echo 'selected="selected"';?> value='4'>生管</option>
					                				</select>
			</td>
			<td width="20%">&nbsp;&nbsp;結束分類方式：</td>
            <td width="30%">
				<select name="ma002c">
                											<option <?php if($ma002c == '1') echo 'selected="selected"';?> value='1'>會計</option>                                                                        
																		<option <?php if($ma002c == '2') echo 'selected="selected"';?> value='2'>商品</option>
                                                                        <option <?php if($ma002c == '3') echo 'selected="selected"';?> value='3'>類別</option>
                                                                        <option <?php if($ma002c == '4') echo 'selected="selected"';?> value='4'>生管</option>
					                				</select>
			</td>
			
		<!-- 	<td width="20%"><span class="required">*</span> 原始品號類別代號：</td>
            <td width="30%">
			    <input type="text" name="ma002c"  value="<?php echo $ma002c; ?>"  size="06" />
              </td>  -->
		  </tr>
		  <tr>
			<td ><span class="required"></span> </td>
            <td >
			    <input type="hidden" name="test1"  value=" "  size="06" />
              </td>
			<td>				&nbsp;&nbsp;							</td>
            <td>
											<input type="hidden" name="test2"   value=" "  size="12" />
						</td>
		  </tr>
		  <tr>
			<td width="20%"><span class="required">*</span> 起始品號類別代號：</td>
            <td width="30%">
			    <input type="text" name="ma003c"  value="<?php echo $ma003c; ?>"  size="06" />
              </td>
			<td width="20%"><span class="required">*</span> 結束品號類別代號：</td>
            <td width="30%">
			    <input type="text" name="ma004c"  value="<?php echo $ma004c; ?>"  size="06" />
              </td>
					  </tr>
		  <tr>
			<td><span class="required"></span></td>
            <td><input type="hidden" name="test3"  value=" " size="20"/>
				</td>
			<td>&nbsp;&nbsp;</td>
            <td></td>
		  </tr>
		 
        </table>
		<input type='hidden' name='company' id='company' value='DERSHENG' />
		<input type='hidden' name='creator' id='creator' value='89044' />
		<input type='hidden' name='usr_group' id='usr_group' value='test' />
		<input type='hidden' name='create_date' id='create_date' value="<?php $date; ?>" />
		<input type='hidden' name='modifier' id='modifier' value='' />
		<input type='hidden' name='modi_date' id='modi_date' value='' />
		<input type='hidden' name='flag' id='flag' value=0 />
		
      </form>
			

		<!--	<table width="100%" align="center">
			<tr>
			<td width="49%" valign="top">
			  <table class="list">
				<thead>
				  <tr>
					<td class="center" width="110"></td>
					<td class="left"></td>
					<td class="center" width="100"></td>
					<td class="right" width="110"></td>
					<td class="right" width="110"></td>
				  </tr>
				</thead>
												<tr>
					<td class="left" colspan="5"></td>
				</tr>
			  </table>
			</td>
			<td> </td>
			<td width="49%" valign="top">
			  <table class="list">
				<thead>
				  <tr>
					<td class="center" width="110"></td>
					<td class="left"></td>
					<td class="center" width="100"></td>
				  </tr>
				</thead>
												<tr>
					<td class="left" colspan="3"></td>
				</tr>
			  </table>
			</td>
			</tr>
			</table>  -->
	  </div> 
  </div>
</div>
<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
' ' ?> </div>  <?php } ?>
</div>
<script type="text/javascript"><!--
function filter() {
	url = 'index.php?route=materials/stocktake/getPrint&token=dbac5972434339b9049f55cda3ace35e';
	
	var filter_stock = $('select[name=\'filter_stock\']').attr('value');
	if (filter_stock != '*') {
		url += '&filter_stock=' + encodeURIComponent(filter_stock);
	}
	
	var filter_status = $('select[name=\'filter_status\']').attr('value');
	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}
	
	var sort = $('select[name=\'sort\']').attr('value');
	if (sort != '') {
		url += '&sort=' + encodeURIComponent(sort);
	}
	
	var order = $('input[name=\'order\']').attr('value');
	if (order) {
		url += '&order=' + encodeURIComponent(order);
	}

	var limit = $('input[name=\'limit\']').attr('value');
	if (limit) {
		url += '&limit=' + encodeURIComponent(limit);
	}
	
	window.open(url);
	
	
	url = 'http://ci.dercaster.com/index.php/inv/invi01/print';
	
	var filter_ma001 = $('select[name=\'filter_ma001\']').attr('value');
	if (filter_ma001 != '*') {
		url += '/' + encodeURIComponent(filter_ma001);
	}
	if (filter_ma001 == '*') {
		url += '/';
	}
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').attr('value');
	if (filter_ma002) {
		url += '/' + encodeURIComponent(filter_ma002);
	} 
	if (!filter_ma002) {
		 url += '/';
	} 
	
	var filter_ma003 = $('input[name=\'filter_ma003\']').attr('value');
	if (filter_ma003) {
		url += '/' + encodeURIComponent(filter_ma003);
	}
	if (!filter_ma003) {
		 url += '/';
	} 
		
	var filter_ma004 = $('input[name=\'filter_ma004\']').attr('value');
	if (filter_ma004) {
		url += '/' + encodeURIComponent(filter_status); 
	}
	if (!filter_ma004) {
		 url += '/';
	} 
	var filter_ma005 = $('input[name=\'filter_ma005\']').attr('value');
	if (filter_ma005) {
		url += '/' + encodeURIComponent(filter_status); 
	}
	if (!filter_ma005) {
		 url += '/';
	} 
	var filter_ma006 = $('input[name=\'filter_ma006\']').attr('value');
	if (filter_ma006) {
		url += '/' + encodeURIComponent(filter_status); 
	}
	if (!filter_ma006) {
		 url += '/';
	} 
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url += '/' + encodeURIComponent(filter_status); 
	}
	if (!filter_create) {
		 url += '/';
	} 
    if (filter_ma001 == '*' && !filter_ma002  && !filter_ma003 && !filter_ma004  && !filter_ma005 && !filter_ma006 && !filter_create) {         
	   url = 'http://ci.dercaster.com/index.php/inv/invi01/display';location = url;
	   
	   }
	   
	window.open(url);
	
	
}
//--></script>

<script type="text/javascript"><!--
$('.htabs a').tabs();
$('.vtabs a').tabs();
//--></script>
</div>
<div id="footer"><br />Design by <a href="http://www.youhongwang.com" target="_blank">個人電腦,筆電,平板,手機四合一雲端ERP</a> &copy; 2013-2014 Project </div>
</body></html> 