<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
 <title>雲端ERP企業資源管理系統</title> 

<?=form_open_multipart('mym/mymi01/upload')?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
      <td>&nbsp;
      
      </td>
     </tr>
     <tr>
      <td align="left">
       上傳excel檔案 (附檔名.xlsx)：
       <input type="hidden" name="site_url" value="<?=site_url()?>">
       <input type="file" name="inputExcel" size="20" />
       <input type="submit" name="sub_up" value="提 交" />
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main'); ?>" class="button" >返 回&nbsp;&nbsp;</span><img src="<?=base_url()?>assets/image/png/back.png" /></a>
      </td>
     </tr>
    </table>
    <?=form_close()?>
     <div class="success"><?php echo '  提示訊息：'.$message.$message1 ?></div>
</body>
</html>
