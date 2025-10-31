<!DOCTYPE html>
<html dir="ltr" lang="zh-TW">
<head>
<meta charset="utf-8">
	
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
function open_winprint()
  {
    window.open('/index.php/inv/invi03/printdetail')
  }

function open_winexcel()
  {
    window.open('/index.php/inv/invi03/exceldetail')
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
		if (e.keyCode == 113) { document.location='<?=base_url()?>index.php/inv/invi03'; }
	  });
  });
//--></script> 
 
<script language="javascript">     <!-- 1000毫秒=1秒, 7200000=2小時  -->
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

<style>   <!-- 分頁頁次美化  -->
#page .pagination {padding: 10px; text-align: left;}
.pagination a {margin: 0; padding: 3px 6px; border: 1px solid #777;text-decoration:none;}
.pagination a:hover,.pagination a.current {border-color: #000 !important;background:#ddd;}
</style>

</head>
<body>

<div id="container">
<div id="header">
  <div class="div1">
    <div class="div2"><a href="<?=base_url()?>index.php/main">雲端ERP企業資源管理系統</a></div>
        <div class="div3">
		<img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
		<img src="<?=base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">回主目錄</a>　
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
	  
	  <li id="materials1"><a class="top">自動傳票管理</a>
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
    date_default_timezone_set("Asia/Taipei");
	//echo date("Y/m/d");
	 // echo $date;
	?>
	<!--  <div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message; ?> </div> -->
	<?php  // $message = ' '; ?>  
 <div class="box">
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 品號類別資料建立作業</h1>
      <div class="buttons">
		<a onclick="location = '<?=base_url()?>index.php/inv/invi03/addform'" class="button"><span>新增</span></a>
		<a onclick="location = '<?=base_url()?>index.php/inv/invi03/copyform'" class="button"><span>複製</span></a>	
        <a onclick="location = '<?=base_url()?>index.php/inv/invi03/findform'" class="button"><span>進階查詢</span></a>				
		
	<!--	<a onclick="$('#form').attr('action', 'http://ci.dercaster.com/index.php/inv/invi03/copyform'); $('#form').submit();" class="button">刪除選取</a> -->
        <a onclick="$('form').submit();" class="button"><span>選取刪除</span></a>    
		
	<!--	<a onclick="$('form').submit();" class="button" id="delete1"><span>刪除多筆</span></a>		-->
	
	  <!--      <a onclick="open_winprint();"   class="button">列印</a>  --> 
	  <!-- 	    <a onclick="open_winexcel();"   class="button">轉EXCEL檔</a>  -->
	  
	        <a onclick="location = '<?=base_url()?>index.php/inv/invi03/printdetail'"  class="button"><span>列印</span></a>
		    <a onclick="location = '<?=base_url()?>index.php/inv/invi03/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>
	<!--  <a onclick="location = '<?=base_url()?>index.php/inv/table_export/index/invma'" class="button"><span>轉EXCEL檔</span></a>	-->
			
	<!--	<a onclick="location = '<?=base_url()?>index.php/inv/invi03/printdetail'" target="_new" class="button"><span>列印</span></a>  -->
		<a onclick="location = '<?=base_url()?>index.php/main'" class="button"><span>關閉</span></a>
	  </div>
    </div>
    <div class="content">
      
      <form action="<?=base_url()?>index.php/inv/invi03/delete" method="post" enctype="multipart/form-data" id="form">
	
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
			  <td width="40" class="left"><?php echo anchor("inv/invi03/display/ma001/" .
					(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,
					'序號'); ?> 
			  </td>
			  <td class="left"><?php echo anchor("inv/invi03/display/ma001/" .
					(($sort_order == 'asc' && $sort_by == 'ma001') ? 'desc' : 'asc') ,
					'分類'); ?> 
			  </td>
			  <td width="80" class="left"> <?php echo anchor("inv/invi03/display/ma002/" .
					(($sort_order == 'asc' && $sort_by == 'ma002') ? 'desc' : 'asc') ,
					'品號類別代號'); ?> 
			  </td>
			  <td width="110"  class="left"> <?php echo anchor("inv/invi03/display/ma003/" .
					(($sort_order == 'asc' && $sort_by == 'ma003') ? 'desc' : 'asc') ,
					'品號類別名稱'); ?> 
            <!--  <a href="<?=base_url()?>index.php/inv/invi03/display/ma002">品號類別名稱</a> -->
                </td>
			  <td width="80" class="left"><?php echo anchor("inv/invi03/display/ma004/" .
					(($sort_order == 'asc' && $sort_by == 'ma004') ? 'desc' : 'asc') ,
					'存貨會計科目'); ?> 
			  </td>
			  
			  <td width="80" class="center">
			  <?php echo anchor("inv/invi03/display/ma005/" .
					(($sort_order == 'asc' && $sort_by == 'ma005') ? 'desc' : 'asc') ,
					'銷貨收入科目'); ?> 
			   </td>
			  <td width="80" class="right"><?php echo anchor("inv/invi03/display/ma006/" .
					(($sort_order == 'asc' && $sort_by == 'ma006') ? 'desc' : 'asc') ,
					'銷貨退回科目'); ?> 
			  </td>
			  <td width="70" class="center"><?php echo anchor("inv/invi03/display/create_date/" .
					(($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,
					'建立日期'); ?> 
			  </td>
			  <td width="120" class="center">&nbsp查看管理&nbsp</td>
              <td width="120" class="center">&nbsp修改管理&nbsp</td>
            </tr>
          </thead>
          <tbody>
		  <?php  $filter_ma001='*';$filter_ma002='';$filter_ma003='';$filter_ma004='';$filter_ma005='';$filter_ma006='';$filter_create=''; ?>
		 
		  <tr class="filter">
			  <td class="left"></td>
			  <td class="left"></td>
              <td align="left">
			    <div id="search">
				<div class="button-search"></div>
				<select name="filter_ma001"  >
                  <option value="*"></option>
                  <option  value="1">會計</option>
                  <option  value="2">商品</option>
                  <option  value="3">類別</option>
                  <option  value="4">生管</option>                                                                
                 </select>
				</div>
			  </td>
			  <td class="left">
			    <div class="button-search"></div>
				<input type="text" name="filter_ma002" value=""  />
			  </td>
			  <td class="left">
			  <div id="search">
				<div class="button-search"></div>
				<input type="text" name="filter_ma003" value="" />
			  </div>
			  </td>
			  <td align="left">
			  <div class="button-search"></div>
				<input type="text" name="filter_ma004" value="" />
			  </td>
              <td align="left">
			  <div class="button-search"></div>
				<input type="text" name="filter_ma005" value="" />
			  </td>
			  <td align="left">
			  <div class="button-search"></div>
				<input type="text" name="filter_ma006" value="" />
			  </td>
			  <td align="left">
			  <div class="button-search"></div>
				<input type="text" name="filter_create" value="" />
			  </td>
			  <td width="120" align="center"><a onclick="filter();" class="button">篩選↑</a></td>			  
			  <td width="120" align="center"><a onclick="filtera();" class="button">篩選↓</a></td>  
			 <!--    <button type='submit'  name='buttonfilter' class="button" value='篩選1'><span>篩選1</span></button>  -->
				  
            </tr>
			
		    <?php $chkval=1; ?>               
		    <?php foreach($results as $row ) : ?>
            <tr>
              <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?=$row->ma001."/".trim($row->ma002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left"><? echo $chkval;?></td>		
			  <td class="left"><? echo $row->ma001;?></td>			  
			  <td class="left"><? echo $row->ma002;?></td>
			  <td class="left"><? echo $row->ma003;?></td>
			  <td class="left"><? echo $row->ma004;?></td>
			  <td align="center"><? echo $row->ma005;?></td>
			  <td align="right"><? echo $row->ma006;?></td>
			  <td class="center"><? echo $row->create_date;?></td>		                 			
		 <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('inv/invi03/del/'.$row->ma001."/".trim($row->ma002))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		      <td class="center"><a href="<?php echo site_url('inv/invi03/see/'.$row->ma001."/".trim($row->ma002))?>">[ 查看 ]</a></td>
              <td class="center"><a href="<?php echo site_url('inv/invi03/editform/'.$row->ma001."/".trim($row->ma002))?>">[ 修改 ]</a></td>
			</tr>
		    <?php $chkval += 1; ?>
		    <?php endforeach;?>
			
          </tbody>
								 
        </table>
      </form>
	       
	  <!--   <div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>  -->
	      
      <div class="pagination"><div class="results"><?php echo $this->pagination->create_links(); ?></div></div>  
	  <div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選可查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列等資訊不印. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>
	 <!-- <div align="center"> <?php echo '操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選可查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列等資訊不印. ] '.' 總數:'.ceil($page).' 頁, '.$numrow.' 筆' ?></div> -->
	</div>
  </div>
</div>

<script type="text/javascript"><!--
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});



function filter() {
	
	var filter_ma001 = $('select[name=\'filter_ma001\']').attr('value');
	if (filter_ma001 != '*') {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma001/desc/' + encodeURIComponent(filter_ma001);
	}
	
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').attr('value');
	if (filter_ma002) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma002/desc/' + encodeURIComponent(filter_ma002);
	} 
	
	var filter_ma003 = $('input[name=\'filter_ma003\']').attr('value');
	if (filter_ma003) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma003/desc/' + encodeURIComponent(filter_ma003);
	}
		
	var filter_ma004 = $('input[name=\'filter_ma004\']').attr('value');
	if (filter_ma004) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma004/desc/' + encodeURIComponent(filter_ma004); 
	}
	
	var filter_ma005 = $('input[name=\'filter_ma005\']').attr('value');
	if (filter_ma005) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma005/desc/' + encodeURIComponent(filter_ma005); 
	}
	
	var filter_ma006 = $('input[name=\'filter_ma006\']').attr('value');
	if (filter_ma006) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma006/desc/' + encodeURIComponent(filter_ma006); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if (filter_ma001 == '*' && !filter_ma002  && !filter_ma003 && !filter_ma004  && !filter_ma005 && !filter_ma006 && !filter_create) {         
	   url = 'http://ci.dercaster.com/index.php/inv/invi03/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_ma001 = $('select[name=\'filter_ma001\']').attr('value');
	if (filter_ma001 != '*') {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma001/asc/' + encodeURIComponent(filter_ma001);
	}
	
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').attr('value');
	if (filter_ma002) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma002/asc/' + encodeURIComponent(filter_ma002);
	} 
	
	var filter_ma003 = $('input[name=\'filter_ma003\']').attr('value');
	if (filter_ma003) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma003/asc/' + encodeURIComponent(filter_ma003);
	}
		
	var filter_ma004 = $('input[name=\'filter_ma004\']').attr('value');
	if (filter_ma004) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma004/asc/' + encodeURIComponent(filter_ma004); 
	}
	
	var filter_ma005 = $('input[name=\'filter_ma005\']').attr('value');
	if (filter_ma005) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma005/asc/' + encodeURIComponent(filter_ma005); 
	}
	
	var filter_ma006 = $('input[name=\'filter_ma006\']').attr('value');
	if (filter_ma006) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma006/asc/' + encodeURIComponent(filter_ma006); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (filter_ma001 == '*' && !filter_ma002  && !filter_ma003 && !filter_ma004  && !filter_ma005 && !filter_ma006 && !filter_create) {         
	   url = 'http://ci.dercaster.com/index.php/inv/invi03/display';location = url;
	   
	   }
	   
	location = url;
}
//--></script>
</div>
<div id="footer"><br />Design by <a href="http://ci.youhongwang.com" target="_blank">個人電腦,筆電,平板,手機四合一雲端ERP</a> &copy; 2013-2014 Project </div>
</body></html> 