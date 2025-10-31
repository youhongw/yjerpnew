<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<meta charset="utf-8">
	
	<title>雲端ERP企業資源管理系統</title>
	<?php $this->load->helper('url');?>
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
    <div class="content" style="min-height: 150px; overflow: hidden;">

	  <div id="htabs" ><a href="#tab-general">編輯項目</a><a href="#tab-contact">通訊錄</a></div>            
	              
		<div id="tab-general">	
                  <form id='form1' method='post'>
        <table>
            <tr>
                        <td>id</td>
                        <td>uid</td>
                        <td>pwd</td>
                        <td>操作</td>
                </tr>
				
				
				 
				 
                <?php foreach($results as $test) { ?>
                <tr>
                        <td><?php echo $test['id'];?></td>
                        <td><? echo $test['name'];?></td>
                        <td><? echo $test['hobby'];?></td>
                        <td>
                                <input type='button' class='update' id='<?=$row->id?>' value='修改'/>
                                <input type='button' class='delete' id='<?=$row->id?>' value='刪除'/>
                        </td>
                </tr>
                <?php  } ?>
              <?php echo $this->pagination->create_links();?>
        </table>
		
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
		
        </div>
        <button type='button' onclick='<?=base_url()?>index.php/test1'  value='insert'>新增</button>
        <input type='hidden' name='act' id='act'/>
        <input type='hidden' name='id' id='id'/>
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