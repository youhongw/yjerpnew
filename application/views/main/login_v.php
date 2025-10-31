
<div id="container">      <!-- div-1 -->
  <div id="header">
    <div class="div1">
      <div class="div2"><img src="<?=base_url()?>assets/image/logo.png" title="管理介面(Administration)" onclick="location = '<?=base_url()?>index.php/login'" /></div>
    </div>
  </div>
  
<div id="content">       <!-- div-2 -->
  <div class="box" style="width: 400px; min-height: 300px; margin-top: 40px;margin-bottom:-25px; margin-left: auto; margin-right: auto;">  <!-- div-3 -->
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/lockscreen.png" alt="" /> 雲端ERP企業資源管理系統</h1>
    </div>
	
    <div class="content" style="min-height: 150px; overflow: hidden;">    <!-- div-4 -->
	<?php
	  $username=$this->input->post('username');
	  $password=$this->input->post('password');
	  $message=' ';
	?>
	<form method="post" action="<?php echo site_url('login/check_login'); ?>" enctype="multipart/form-data" id="form">
        <table style="width: 100%;background: #FFFFFF;">
          <tr>
            <td style="text-align: center;" rowspan="4"><img src="<?=base_url()?>assets/image/login.png" alt="雲端ERP企業資源管理系統" /></td>
          </tr>
		  <!--　空白使用全形　-->  
          <tr>
            <td>使 用 者:<input type="text" name="username" value="<?php echo set_value('username'); ?>" size="15px" style="margin-top: 4px;margin-left: 4px;" />
              <br /><br /><span>密   　碼:</span>
              <input type="password" name="password" value="<?php echo set_value('password');  ?>"  size="15px" style="margin-top: 4px;margin-right: 4px;" />
			  <br /><br />驗 證 碼:<input type="text" name="captcha" value="<?php echo set_value('captcha');  ?>" size="15px" style="margin-top: 0px;margin-left: 4px;margin-right: 2px;" /><span style="border:2px solid;background-color:#A1CBD7;;color:red;font-size:16px;text-align:center; ">&nbsp;<?php echo $this->session->userdata('captchaWord'); ?>
			  <a href="<?=base_url()?>" target="_self"><img src="<?=base_url()?>assets/image/reload.gif" /></a></span>
              <br /><br />
		  <!-- 檢查是否裝置是pc  -->
		  <?php
		  $win=0;
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
{$win=1;}

?>		
          
           <?php if (strtoupper(substr(PHP_OS, 0, 3)) != 'WIN'){ ?>    
			    	  <div class="clr"></div>
					   <?php if ($win != 1){   echo '<div class="QapTcha"></div>' ; }  ?>					 
					   
					  <noscript><span style='color:red;'>錯誤：驗證碼與圖片驗證號碼不符!</span></noscript>
			  <?php }  ?>  
			
		<!--	  
	 	  <?php if (strtoupper(substr(PHP_OS, 0, 3)) != 'WIN'){ ?>    
			    	  <div class="clr"></div>
					  <div class="QapTcha"></div>
					  <noscript><span style='color:red;'>錯誤：驗證碼與圖片驗證號碼不符!</span></noscript>
			  <?php }  ?>   -->
            </td>
          </tr>
		  
          <tr>
            <td>&nbsp;<input type='hidden' name='act' id='act'/></td>
          </tr>
		  <!-- 檢查是否裝置是pc  -->
		  <?php
		  $win=0;
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
{$win=1;}

?>
     
		  
		  <?php if ($win == 1){ ?>    <!--pc 登入不出現其他 手機-->
          <tr>
            <td style="text-align: right;"><a onclick="$('#form').submit();" class="button">登入&nbsp<img src="<?=base_url()?>assets/image/png/login.png" /></a></td>  
          </tr>  
		  <?php }else{ ?>
		  <tr>
            <td style="text-align: right;">
				<input id="submit" style="display:none;" type="submit" onclick="$('#form').submit();" value="登入&nbsp" class="button" /><img src="<?=base_url()?>assets/image/png/login.png" />
			</td>
          </tr>
		 <?php }  ?>  

        </table>
	</form>
	<!-- <?php echo $this->session->userdata('sysml003'); ?>  -->
       
	   <?php
          if ($query != 1) {$message =' 帳號: '.$this->input->post('username').$err.' 或密碼輸入錯誤!';} else {echo '驗證碼輸入錯誤!';}
	      if ((!$this->input->post('username')) and (!$this->input->post('password'))) { $message =' ' ; }
       ?>
          <br/>
       <?php if ($message!=' ') { ?>
	     <div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>
	</div>   <!-- div-4 -->
  </div>     <!-- div-3 -->
</div>       <!-- div-2 -->
  
 <!-- <p class="footer">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;網頁本次下載 :  <strong>{elapsed_time}</strong> 秒</p> -->
	<div ><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span>　　　　　　　　　　　　　　　　　　</span>
      <img src="<?=base_url()?>assets/image/logonew1.png" align="middle" alt="" /><br/><p></p>
	  <img src="<?=base_url()?>assets/image/logonew.png" align="middle" alt="" /> <br/><p></p><span>　　推薦流覽器使用順序:　</span>
       <img src="<?=base_url()?>assets/image/png/browse-1.png" align="middle" alt="" /><span>　</span>  
	   <img src="<?=base_url()?>assets/image/png/browse-3.png" align="middle" alt="" /><span>　</span>
	   <img src="<?=base_url()?>assets/image/png/browse-2.png" align="middle" alt="" /><span>　</span>
	   <img src="<?=base_url()?>assets/image/png/browse-4.png" align="middle" alt="" /><span>　</span>
	   <img src="<?=base_url()?>assets/image/png/browse-5.png" align="middle" alt="" /><span>　</span>
	<!--	<img src="<?=base_url()?>assets/image/logonew2.png" align="middle" alt="" /> -->
    </div>
</div>      <!-- div-1 -->

<script type="text/javascript"><!--
	  $(document).ready(function(){
		  $('.QapTcha').QapTcha({
			  txtLock : '滑動解鎖防機器人程式,才能出現登入按鈕!',
			  txtUnlock : '',
			  PHPfile : '<?=base_url()?>assets/javascript/jquery/qaptcha/php/Qaptcha.jquery.php',
			  disabledSubmit:true,
			  idsubmit: 'submit'
		  });
	  });
//--></script>
	
<script type="text/javascript"><!-- 	// enterkey =tabkey 功能   
	$(document).ready(function(){ 	   
//	$('#mb001').focus(); 	   
	Enterkey(); 	   
	}); 	   
//--></script> 	   
		   
<script type="text/javascript"><!-- 	// enterkey 功能    
	function Enterkey() { 	   
	$("input").not( $(":button") ).keypress(function (evt) { 	   
	if (evt.keyCode == 13) { 	   
	if ($(this).attr("type") !== 'submit'){ 	   
	var fields = $(this).parents('form:eq(0),body').find('input, textarea, checkbox'); 	   
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
//--></script> 	 
