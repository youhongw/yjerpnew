<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>連接資料庫</title>
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
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/jquery.validate.js"></script>

</head>
<body>
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
			document.location='http://ci.dercaster.com/index.php/test2';
		}
	});
});
//--></script>
<script language="javascript">
	function Msg(){
		alert("閒置超時，系統強制登出!");
		location="http://ci.dercaster.com/";
	}
	window.setInterval("Msg()",1800000);
	function CheckForm()

{

  if(confirm("確認要刪除此筆資料嗎？")==true)   

    return true;

  else  

    return false;

}   

</script>
<?php $this -> load -> library( 'form_validation' ); ?>
<form id='form' method='post'>
        <table>
                <tr>  
           				<td>id</td>
                        <td>name</td>
                        <td>hobby</td>
                        <td>操作</td>

                </tr>
            
                <?php foreach ($result as $row):?>

                <tr>
                        <td><?=$row->id?></td>
                        <td><?=$row->name?></td>
                        <td><?=$row->hobby?></td>
                        
                        <td><a href="<?php echo site_url('test2/edit1/'.$row->id); ?>">编辑</a></td>
						<td><a onclick="return CheckForm();" href="<?php echo site_url('test2/del/'.$row->id); ?>">刪除9</a></td>
						
                </tr>

                <?php endforeach;?>
				
				

        </table>
         <a onclick="return CheckForm();" class="button"><span>刪除1</span></a>

        <button type='submit' name='insert' id='insert' value='insert'>新增</button>
        <input type='hidden' name='act' id='act'/>
        <input type='hidden' name='id' id='id'/>

</form>
    <?php echo $pager; ?>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('.button-search').bind('click', function() {
		filter();
	});
});

function filter() {
	url = 'index.php?route=materials/material&token=1eecbed79ac4975031be74451ab37c3f';
	
	var filter_name = $('input[name=\'filter_name\']').attr('value');
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
	var filter_code = $('input[name=\'filter_code\']').attr('value');
	if (filter_code) {
		url += '&filter_code=' + encodeURIComponent(filter_code);
	}
	
	var filter_group = $('select[name=\'filter_group\']').attr('value');
	if (filter_group != '*') {
		url += '&filter_group=' + encodeURIComponent(filter_group);
	}
		
	var filter_status = $('select[name=\'filter_status\']').attr('value');
	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status); 
	}

	location = url;
}
//--></script>

</body>
</html>
