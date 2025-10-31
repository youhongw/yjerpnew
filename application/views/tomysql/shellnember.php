<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
 <title>雲端ERP企業資源管理系統</title> 

<?=form_open_multipart('tomysql/shellnember/upload')?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
      <td>&nbsp;
      
      </td>
     </tr>
     <tr>
      <td align="left">
       上傳excel檔案：
       <input type="hidden" name="site_url" value="<?=site_url()?>">
       <input type="file" name="inputExcel" size="20" />
       <input type="submit" name="sub_up" value="提 交" />
      </td>
     </tr>
    </table>
    <?=form_close()?>

</body>
</html>
