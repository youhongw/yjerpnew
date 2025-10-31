<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<meta charset="utf-8">
	
	<title>雲端ERP企業資源管理系統-jQuery驗証</title>
	<?php $this->load->helper('url');?>
<link href="<?=base_url()?>assets/image/icon.png" rel="icon" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/stylesheet/stylesheet.css" />
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link type="text/css" href="<?=base_url()?>assets/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/superfish/js/superfish.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/common.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery-1.8.3.min.js"></script>


 
       <script type="text/javascript" src="base_url()?>assets/validation/jquery.validate.js" mce_src="base_url()?>assets/validation/jquery.validate.js"></script>  
       <script type="text/javascript" src="base_url()?>assets/validation/localization/messages_zh_TW.js"></script>  
       <script type="text/javascript" src="base_url()?>assets/validation/lib/jquery.form.js"></script>  
       <style type="text/css">

       * {}{    
           font-family: Verdana;    
           font-size: 96%;    
       }   
       label {}{    
           width: 10em;    
           float: left;    
       }   
       label.error {}{    
           float: none;    
           color: red;    
           padding-left: .5em;    
           vertical-align: top;    
       }   
       p {}{    
           clear: both;    
       }   
       .submit {}{    
           margin-left: 12em;    
       }   
       em {}{    
           font-weight: bold;    
           padding-right: 1em;    
           vertical-align: top;    
       }   
</style>


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
     <?php
	      //  if( stripos($this-&gt;_agent, &#039;windows&#039;) !== false ) {
			    $this-&gt;_platform = self::PLATFORM_WINDOWS;
				echo _platform;
				echo 'win'; 
				echo self::PLATFORM_WINDOWS;
		  
		    
   
			?>     
<div id="content">
  <div class="box" style="width: 400px; min-height: 300px; margin-top: 40px; margin-left: auto; margin-right: auto;">
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/lockscreen.png" alt="" /> 雲端ERP企業資源管理系統</h1>
    </div>
    <div class="content" style="min-height: 150px; overflow: hidden;">
	      
	              
			
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
        <button type='submit' name='insert' id='insert' value='insert'>insert</button>
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