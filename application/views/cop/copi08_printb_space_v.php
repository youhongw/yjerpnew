<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta http-equiv="content-language" content="zh-tw" /> 
<title>測試AJAX後開新視窗</title> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> 
</head> 
<body> 
<input type="button" id="btnOK" value="執行" />

<?php // echo $jsss;?>
<?php // echo $jsss1;?>
<script type="text/javascript"> 
//url = 'about:blank';
//location = url;
//document.body.innerHTML = '';
//document.clear();
 document.body.addEventListener('click', function() {
            window.open('about:blank', '_blank');
        });


  
  $(document).ready(function () {
    $('#btnOK').get(0).click();
});
//--> 
</script> 
</body> 
</html> 
