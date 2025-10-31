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
<script type="text/javascript">
//-----------------------------------------
// Confirm Actions (delete, uninstall)
//-----------------------------------------
$(document).ready(function(){
    $('#button1').click(function(){
	  $('#find003').val()='test';
      $('#find003').trigger('focus');
	  $('#find003').val()='test';
      $('#find005').val()='test1111';
      $("#find005").attr("value")='select * from kk';	  
      });	
$('#find003').val()='test';
var inputValue = $("#find003").val();
    alert($inputValue);
    alert(inputValue);
	
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
	window.setInterval("Msg()",9900000);
	
	function CheckForm()
     {
  if(confirm("確認要刪除此筆嗎？")==true)
     document.form.find005.value='select';
	 document.form.find003.value='222';
    return true;
  else
    return false;
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
   $date=date("Ymd");
	$find001=$this->input->post('find001');
	$find002=$this->input->post('find002');
	$find003=$this->input->post('find003');
	$find004=$this->input->post('find004');
	$find005=$this->input->post('find005');
	$find006=$this->input->post('find006');
	$find007=$this->input->post('find007');
	$find008=$this->input->post('find008');
	$find009=$this->input->post('find009');
	?>
 <div class="box">
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 品號類別資料建立作業</h1>
	  <form action="<?=base_url()?>index.php/inv/invi01/findsql" method="post" enctype="multipart/form-data" id="form">
    <!--    <div class="buttons">
	    <button type='submit'  name='buttonfind' class="button" value='確定'><span>確定</span></button>
	    <a href="<?php echo site_url('inv/invi01/display'); ?>" class="button" ><span>取消</span></a>
	    <a onclick="$('#form').submit();" class="button"><span>儲存</span></a>  -->
		  
	  </div>
    </div>
    <div class="content">
	<div id="htabs" class="htabs"><a href="#tab-general">進階資料-條件查詢</a></div>
	    
        <div id="tab-general">
		<table class="form">
		 <tr>
		<td width="14">&nbsp;&nbsp;設定查詢條件：</td>
		<td width="04">&nbsp;&nbsp;</td>
		</tr>
		
          <tr>
			    <td width="18">
				<select name="find001" id="find001"  >
                	<option <?php if($find001 == '1') echo 'selected="selected"';?> value='MA001'> MA001 分類方式 </option>                                                                        
					<option <?php if($find001 == '2') echo 'selected="selected"';?> value='MA002'> MA002 品號類別代號 </option>
                    <option <?php if($find001 == '3') echo 'selected="selected"';?> value='MA003'> MA003 品號類別名稱 </option>
                    <option <?php if($find001 == '4') echo 'selected="selected"';?> value='MA004'> MA004 存貨會計科目 </option>
					<option <?php if($find001 == '5') echo 'selected="selected"';?> value='MA005'> MA005 銷貨收入科目 </option>
					<option <?php if($find001 == '6') echo 'selected="selected"';?> value='MA006'> MA006 銷貨退回科目 </option>
					<option <?php if($find001 == '7') echo 'selected="selected"';?> value='CREATE_DATE'> CREATE_DATE 建立日期 </option>
			   </select>
			   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			   
			   <select name="find002" id="find002" >
                	<option <?php if($find002 == '1') echo 'selected="selected"';?> value=' = '> = </option>                                                                        
					<option <?php if($find002 == '2') echo 'selected="selected"';?> value=' >= '> >= </option>
                    <option <?php if($find002 == '3') echo 'selected="selected"';?> value=' <= '> <= </option>
                    <option <?php if($find002 == '4') echo 'selected="selected"';?> value=' > '> > </option>
					<option <?php if($find002 == '5') echo 'selected="selected"';?> value=' < '> < </option>
					<option <?php if($find002 == '6') echo 'selected="selected"';?> value=' != '> != </option>
					<option <?php if($find002 == '7') echo 'selected="selected"';?> value=' like '> like </option>
			   </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                		   
			     <input type="text" name="find003" id="find003" value=""  size="20"  />

              </td>
			</tr>
			
			<tr>
			   <td width="06">&nbsp;&nbsp;條件關係：
			   
			   <select name="find004" id="find004">
                                <option value=" AND " selected="selected">AND</option>
                       <option value="OR">OR</option>				
                              </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							  <a onclick="OnBlur1();" onblur="OnBlur()"  class="button">清除</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                               <a onclick="OnBlur();" onblur="OnBlur()"  class="button" >加入</a></td>							  
		  </tr>
		  <tr>
		         <td><textarea rows="6" cols="40" name="find005" id="find005"  Wrap="Physical"  >
                 </textarea></td>
			
			
		  </tr>
		  <tr>
			    <td  width="04">&nbsp;&nbsp;排序欄位：
				<select name="find006" id="find006" " >
                	<option <?php if($find006 == '1') echo 'selected="selected"';?> value='MA001'> MA001 分類方式 </option>                                                                        
					<option <?php if($find006 == '2') echo 'selected="selected"';?> value='MA002'> MA002 品號類別代號 </option>
                    <option <?php if($find006 == '3') echo 'selected="selected"';?> value='MA003'> MA003 品號類別名稱 </option>
                    <option <?php if($find006 == '4') echo 'selected="selected"';?> value='MA004'> MA004 存貨會計科目 </option>
					<option <?php if($find006 == '5') echo 'selected="selected"';?> value='MA005'> MA005 銷貨收入科目 </option>
					<option <?php if($find006 == '7') echo 'selected="selected"';?> value='CREATE_DATE'> CREATE_DATE 建立日期 </option>
			   </select>&nbsp;&nbsp;&nbsp;&nbsp;
			            
						<select name="find008" id="find008" " >
                	<option <?php if($find008 == 'asc') echo 'selected="selected"';?> value=' asc'> 由小到大 </option>                                                                        
					<option <?php if($find008 == 'desc') echo 'selected="selected"';?> value=' desc'> 由大到小 </option>
                   
			   </select>
			   <a onclick="OnBlur3();" onblur="OnBlur()"  class="button">清除</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                               <a onclick="OnBlur2();" onblur="OnBlur()"  class="button" >加入</a></td>	
						
           
		  </tr>
		  <tr>
			  <td><textarea rows="6" cols="40" name="find007" id="find007" Wrap="Physical" >
                 </textarea></td>
				</td>
			
		  </tr>
		  <tr>
			 
           
		  </tr>
        </table>
		<input type='hidden' name='company' id='company' value='DERSHENG' />
		<input type='hidden' name='creator' id='creator' value='89044' />
		<input type='hidden' name='usr_group' id='usr_group' value='test' />
		<input type='hidden' name='create_date' id='create_date' value="<?php $date; ?>" />
		<input type='hidden' name='modifier' id='modifier' value='' />
		<input type='hidden' name='modi_date' id='modi_date' value='' />
		<input type='hidden' name='flag' id='flag' value=0 />
		
		<div class="buttons">
	    <button type='submit'  name='buttonfind' class="button" value='確定'><span>確定</span></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <a href="<?php echo site_url('inv/invi01/display'); ?>" class="button" ><span>取消</span></a>
	    		  
	  </div>
      </form>
		
            <br/>
			<table width="100%" align="center">
			<tr>
			<td width="98%" valign="top">
			  <table class="list">
				<thead>
				  <tr>
					<td class="center" width="110">&nbsp;</td>
				<!--	<td class="left"></td>
					<td class="center" width="100">&nbsp;</td>
					<td class="right" width="110">&nbsp;</td>
					<td class="right" width="110">&nbsp;</td> -->
				  </tr>
				</thead>
												<tr>
				<!--	<td class="left" colspan="5"></td> -->
				</tr>
			  </table>
			</td>
			<td> </td>
		<!--	<td width="49%" valign="top">
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
			</td>    -->
			</tr>
			</table>
	  </div> 
  </div>
</div>

</div>
<script language="javascript">
   function trim(strvalue) {
    ptntrim = /(^\s*)|(\s*$)/g;
    return strvalue.replace(ptntrim,"");
    }

    function OnBlur()
    {
	    var str1 = '(',  str2 = ')', str3 = '"', str4 = '"',str22='';
	   if (trim(find002.value) == 'like') {str22='%'; } 
	   if ( trim(find005.value) != '') {
       find005.value = trim(find005.value) + find004.value + str1 + find001.value + find002.value + str3 + find003.value +str22 + str4  + str2  ;
	   }
	   else
	   {
	   find005.value = str1  + find001.value + find002.value + str3 + find003.value + str22 + str4  + str2  ;
	   }
    }
	 function OnBlur1()
    {
       find005.value = '';
    }
	
	 function OnBlur2()
    {
	    var str5 = ','; 
		
	   if ( trim(find007.value) != '') {
       find007.value = trim(find007.value) + str5 + find006.value + find008.value   ;
	   }
	   else
	   {
	   find007.value = trim(find007.value) + find006.value + find008.value   ;
	   }
    }
	 function OnBlur3()
    {
       find007.value = '';
    }
	
  </script>
  
<script type="text/javascript"><!--

	function change_event(){
        var source = window.event.srcElement;
        if(source.name=="find006"){
                var num1 = source.value;
                var num2_obj=document.getElementById("find008");
                find007.value = num1;
        }else if(name=="find008"){
                var num1 = source.value;
                var num2_obj=document.getElementById("find008");
                find007.value = num1;
        }
       }

function data_a() {
	document.form.find003.value='11111'; 
	var find001 = $('select[name=\'find001\']').attr('value');
	var find002 = $('select[name=\'find002\']').attr('value');
	var find003 = document.getElementsByName('find003').value;
	var find004 = $('select[name=\'find004\']').attr('value');
	var document.getElementById("find005id").value= find001 + find002 + find003 + find004 ; 
    var document.getElementsByName('find003').value='kkkk';	
    return document.getElementById("find005id").value;		  
}

//--></script>
<script type="text/javascript"><!--
$('.htabs a').tabs();
$('.vtabs a').tabs();
//--></script>
</div>
<div id="footer"><br />Design by <a href="http://www.youhongwang.com" target="_blank">個人電腦,筆電,平板,手機四合一雲端ERP</a> &copy; 2013-2014 Project </div>
</body></html> 