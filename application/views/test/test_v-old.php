<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<meta charset="utf-8">
	
	<title>雲端ERP企業資源管理系統</title>
	<?php $this->load->helper('url');?>
<link href="<?=base_url()?>assets/image/icon.png" rel="icon" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/stylesheet/test.css" />
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link type="text/css" href="<?=base_url()?>assets/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/superfish/js/superfish.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/common.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery.maskedinput.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery.blockUI.js"></script>
<script type="text/javascript">
//-----------------------------------------
// Confirm Actions (delete, uninstall)
//-----------------------------------------
$(document).ready(function(){

        $('.update').click(function(){

                $('#act').val('update');

                $('#id').val($(this).attr('id'));

                $('#form1').submit();

        });

        $('.delete').click(function(){

                $('#act').val('delete');

                $('#id').val($(this).attr('id'));

                $('#form1').submit();

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

    <div class="left"></div>
    <div class="right"></div>

	 <div class="content">
	  <div id="htabs" class="htabs"><a href="#tab-general">編輯項目</a><a href="#tab-contact">通訊錄</a></div>
      <form action="http://mypos.tw/index.php?route=customers/customer/insert&amp;token=d92d840c417402283d0bfbc4f34048ce&amp;command=list" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
            <table class="form">
			  <tr>
                <td width="15%">&nbsp;&nbsp;&nbsp;客戶分類：<br>&nbsp;&nbsp;&nbsp;<a href="http://mypos.tw/index.php?route=customers/customer_group/insert&amp;token=d92d840c417402283d0bfbc4f34048ce&amp;command=addTrue&amp;command=list">新增類別</a></td>
                <td width="35%"><select name="customer_group_id">
                                                            <option value="1">SR 門市零售2</option>
                                                                                <option value="2">SD 批發經銷</option>
                                                                                <option value="3">CP 中小企業</option>
                                                                                <option value="4">GV 政府機關</option>
                                                          </select></td>
                <td width="15%">&nbsp;&nbsp;&nbsp;客戶編號：</td>
                <td width="35%">
								</td>
              </tr>
			  <tr>
                <td><span class="required">*</span> 客戶名稱：</td>
                <td><input type="text" name="company" value="" size="40"/>
                  </td>
                <td>&nbsp;&nbsp;&nbsp;統一編號：</td>
                <td><input type="text" name="trading_code" value="" /></td>
              </tr>
			  
              <tr>
                <td>&nbsp;&nbsp;&nbsp;聯 絡 人：</td>
                <td><input type="text" name="person_name" value="" />
					  				</td>
				<td>&nbsp;&nbsp;&nbsp;行動電話：</td>
                <td><input type="text" name="mobile" value="" /></td>
              </tr>
			  <tr>
                <td>&nbsp;&nbsp;&nbsp;電子信箱：</td>
                <td><input type="text" name="email" value="" size="40"/></td>
				<td>&nbsp;&nbsp;&nbsp;聯絡電話：</td>
                <td><input type="text" name="telephone" value="" /></td>
              </tr>
			  <tr>
                <td></td>
                <td></td>
				<td>&nbsp;&nbsp;&nbsp;傳真電話：</td>
                <td><input type="text" name="fax" value="" /></td>
              </tr>
			  <tr>
                <td>&nbsp;&nbsp;&nbsp;收款截止日：</td>
                <td><input type="text" name="collect_date" value=""/></td>
                <td>&nbsp;&nbsp;&nbsp;收款方式：</td>
                <td><input type="text" name="collect_type" value=""/></td>
              </tr>
			  <tr>
                <td>&nbsp;&nbsp;&nbsp;地　　址：<img src="view/image/add.png" title="增加地址" style="cursor: pointer;" onclick="addAddress();" /></td>
                <td colspan="3">
					<table id="address">
																		<tfoot></tfoot>
					  </table>
				</td>
              </tr>
			  <tr>
                <td>&nbsp;&nbsp;&nbsp;附註說明：</td>
                <td colspan="3"><textarea name="description" id="description"></textarea></td>
              </tr>
            </table>
          </div>

		<div id="tab-contact">
          <table id="contact" class="list">
            <thead>
              <tr>
                <td class="center" width="120">聯絡人姓名</td>
                <td class="center" width="100">職務名稱</td>
                <td class="center">電子信箱</td>
                <td class="center">聯絡電話</td>
				<td class="center">傳真電話</td>
                <td width="130"></td>
              </tr>
            </thead>
                                    <tfoot>
              <tr>
                <td colspan="5"></td>
                <td class="right"><a onclick="addContact();" class="button">新增聯絡人</a></td>
              </tr>
            </tfoot>
          </table>
		  <div class="pagination"></div>
        </div>
</form>
			 
	
    <?php  
	  
	     echo '總筆數:'.$this->db->count_all_results('test');
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