<html>
<head>
<title>Excel上傳</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
請把要上傳文件先關閉,然後在上傳.xlsx

<?php echo form_open_multipart('mym/mymb01/do_upload');?>
 <input type="hidden" name="site_url" value="<?=site_url()?>">
 <input type="file" name="userfile" size="20" />
 <input type="submit" value="導入" />
 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main'); ?>" class="button" >返 回&nbsp;&nbsp;</span><img src="<?=base_url()?>assets/image/png/back.png" /></a>
</form>
  <div class="success"><?php echo '  提示訊息：'.$message.$message1 ?></div>
</body>
</html>