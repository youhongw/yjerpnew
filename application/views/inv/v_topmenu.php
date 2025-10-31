<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#上方置頂選單列
$this->benchmark->mark('code_start');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>人事薪資系統</title>
</head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/datepicker.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery/jquery-min.js"></script>

<script type="text/javascript"> 
 $('.loading2').animate({'width':'10%'},200);  //第1個進度節點 
</script> 

<body>
<!--資料載入..loaging
<div class="loading" id="loading"><img src="<?php echo base_url();?>assets/images/ajax-loader.gif" /><br/>資料載入中...<br/>請稍後</div>

<div class="mainmenu" onmouseover="showmenu()" onmouseout="hidemenu()" onclick="showmenu()" id="mainmenu"> -->
<table width="100%" cellpadding="0" cellspacing="0" style="background:#000; text-align:center; border-bottom:1px #666 double; color:#FFF">
<tr>
<td width="5%">&nbsp;</td>
<td width="5%"><a href="<?php echo base_url().'main/action';?>"><img src="<?php echo base_url();?>assets/images/home.png" border="0" title="回首頁"/></a></td>
<?php
$doc = new DOMDocument();
$doc->load('menu.xml');

$totlength = 0; //名稱總字數-->計算欄位寬度
$dom = $doc->getElementsByTagName('class');
foreach ($dom as $book) 
{
	$mid = $book->getAttribute('id'); //主順序ID
	$mna[$mid] = $book->getAttribute('title'); //主名稱
	$totlength += mb_strlen($mna[$mid],'UTF-8');
}

$dom = $doc->getElementsByTagName('ad');
foreach ($dom as $book) 
{
	$mid = $book->getAttribute('id'); //主ID
	$pos = $book->getAttribute('pos'); //子順序
	$yid = $book->getAttribute('sid');
	$sid[$mid][$pos] = $yid; //子ID
	$sna[$mid][$pos] = $book->getAttribute('title'); //子名稱
	$sac[$yid] = $this->session->userdata($yid);
}

$wd = round(80/$totlength); //每個字佔幾%

for ($i=1; $i<=count($mna); $i++)
{
	if (!empty($mna[$i]))
	{
		$wid = $wd*mb_strlen($mna[$i],'UTF-8');
		echo '<td height="40" width="'.$wid.'%">';
		echo $mna[$i];
		echo '</td>';
	}
}
?>
<td width="5%"><a href="<?php echo base_url();?>main/logout" style="color:#0FF"><img src="<?php echo base_url();?>assets/images/logout.png" border="0" title="登出系統"/></a></td>
<td width="5%">&nbsp;</td>
</tr>
</table>
<div class="bgw"></div>

<div class="submenu" id="menu">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#000; text-align:center" class="menu">
<tr><td>&nbsp;</td></tr>
<tr>
<td width="10%">&nbsp;</td>
<?php
for ($i=1; $i<=count($mna); $i++)
{
	if (!empty($mna[$i]))
	{
		$wid = $wd*mb_strlen($mna[$i],'UTF-8');
		echo '<td width="'.$wid.'%" valign="top">';
		echo '<table style="text-align:left" width="100%">';
		$k = 0;
		for ($j=1; $j<=count($sna[$i]); $j++)
        {
			if (!empty($sna[$i][$j]))
			{
			   $k++;
			   $son_id = $sid[$i][$j];
			   $src = "'".base_url().'main'.$i.'/'.$sid[$i][$j]."'"; //功能頁連結
			   $src2 = base_url().'main'.$i.'/'.$sid[$i][$j];
			   $self = "'_self'";
			   
			   //判斷有無查詢權限
			   if ($sac[$son_id] == 'Y')
			   echo '<tr><td height="25" onmouseover="showbg('.$i.','.$j.')" onmouseout="hidebg('.$i.','.$j.')" id="sme'.$i.'_'.$j.'" 
			   onclick="window.open('.$src.','.$self.')">
			   <a href="'.$src2.'" id="sma'.$i.'_'.$j.'">'.$k.'.&nbsp;'.$sna[$i][$j].'</a></td></tr>';
			   else
			   echo '<tr><td height="25"><span style="color:#999">'.$k.'.&nbsp;'.$sna[$i][$j].'</span></td></tr>';
			}
		}
		echo '</table>';
		echo '</td>';
	}
}
?>
<td width="10%">&nbsp;</td>
</tr>
</table>
<div class="bgw"></div>
</div>
</div>

<!--訊息提示-->
<div class="toptip" id="toptip">
<table width="100%" id="tip_tab">
<tr>
<td align="center" id="tip_text">&nbsp;</td>
</tr>
</table>
</div>

<script type="text/javascript"> 
 $('.loading2').animate({'width':'33%'},500);  //第2個進度節點 
</script> 


