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
          
	   <script  src="http://ci.dercaster.com/assets/validate/lib/jquery.js"></script> 
      <script  src="http://ci.dercaster.com/assets/validate/jquery.validate.js"></script> 
	  <script  src="http://ci.dercaster.com/assets/validate/localization/messages_zh_TW.js"></script>
	  
	
     <!--  <script  src="http://jquery.bassistance.de/validate/lib/jquery.js"></script> 
      <script  src="http://jquery.bassistance.de/validate/jquery.validate.js"></script>     -->
<script>
$.validator.setDefaults({
	submitHandler: function() { alert("submitted!"); }
});

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

<style type="text/css">
#commentForm { width: 500px; }
#commentForm label { width: 250px; }
#commentForm label.error, #commentForm input.submit { margin-left: 253px; }
#newsletter_topics label.error {
	display: none;
	margin-left: 103px;
}
</style>       

<style> input:focus {background-color: yellow;} </style>

<script language="javascript">   

	   
	function Msg(){
		alert("閒置超時，系統強制登出!");
		location="<?=base_url()?>";
	}
	window.setInterval("Msg()",7200000);
</script>
</head>
<body>

<div id="container">
<div id="header">
  <div class="div1">
    <div class="div2"><a href="<?=base_url()?>index.php/main">雲端ERP企業資源管理系統</a></div>
        <div class="div3">
		<img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $this->session->userdata('manager'); ?></span> 已登錄 　
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
	echo date("Ymd");
	?>
 <div class="box">
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 品號類別資料建立作業</h1>
	<!--   <form class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?=base_url()?>index.php/inv/invi01/addsave" > -->
	  <div class="buttons">
	    <button type='submit'  name='submit' class="button" value='儲存'><span>儲存</span></button>
	    <a href="<?php echo site_url('inv/invi01/display'); ?>" class="button" ><span>取消</span></a>
	   <!--   <a onclick="$('#form').submit();" class="button"><span>儲存</span></a>  -->
		  
	  </div>
    </div>
    <div class="content">
	<div id="htabs" class="htabs"><a href="#tab-general">編輯項目-新增</a></div>
	<?php
	$date=date("Ymd");
	$ma001=$this->input->post('ma001');
	$ma002=$this->input->post('ma002');
	$ma003=$this->input->post('ma003');
	$ma004=$this->input->post('ma004');
	$ma005=$this->input->post('ma005');
	$ma006=$this->input->post('ma006');
	
		
	?>
    <!--  <form action="<?=base_url()?>index.php/inv/invi01/addsave" method="post" enctype="multipart/form-data" id="form">  -->
	  <form class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?=base_url()?>index.php/inv/invi01/addsave" >
        <div id="tab-general">
		<table class="form">
          <tr>
			<td width="20%">&nbsp;&nbsp;分類方式：</td>
            <td width="30%">
				<select id="ma001" name="ma001" ">
                											<option <?php if($ma001 == '1') echo 'selected="selected"';?> value='1'>會計</option>                                                                        
																		<option <?php if($ma001 == '2') echo 'selected="selected"';?> value='2'>商品</option>
                                                                        <option <?php if($ma001 == '3') echo 'selected="selected"';?> value='3'>類別</option>
                                                                        <option <?php if($ma001 == '4') echo 'selected="selected"';?> value='4'>生管</option>
					                				</select>
			</td>
			<td width="20%">&nbsp;&nbsp;狀　　態：</td>
            <td width="30%"><select id="status" name="status">
                                <option value="1" selected="selected">確認</option>
                <option value="0">待處理</option>
				<option value="2">作廢</option>
                              </select></td>
		  </tr>		  
		  <tr>
			<td><span class="required">*</span> 品號類別代號：</td>
            <td><input  id="ma002" name="ma002"  value="<?php echo $ma002; ?>"   size="10" type="text" required /></td>
			
			<td>&nbsp;&nbsp;品號類別名稱：</td>
            <td><input  id="ma003" name="ma003"   value="<?php echo $ma003; ?>"    size="5" type="text" required /></td>
		  </tr>
		  <tr>
			<td>&nbsp;&nbsp;存貨會計科目：</td>
            <td><input  id="ma004" name="ma004"  value="<?php echo $ma004; ?>"  size="20"  minlength="2" type="text" required /></td>
			
						<td>&nbsp;&nbsp;銷貨收入科目：</td>						
            <td><input id="ma005" name="ma005"   value="<?php echo $ma005; ?>"  minlength="2" type="text" required /></td>
					  </tr>
		  <tr>
			<td><span class="required">*</span> 銷貨退回科目：</td>
            <td><input  id="ma006" name="ma006"  value="<?php echo $ma006; ?>" size="20" type="text" required  />
			  
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
    
		
	  </div> 
  </div>
</div>
<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位. ] '  ?> </div>  <?php } ?>



<div id="footer"><br />Design by <a href="http://www.youhongwang.com" target="_blank">個人電腦,筆電,平板,手機四合一雲端ERP</a> &copy; 2013-2014 Project </div>
 

</body></html> 