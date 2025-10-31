<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#薪資條
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>人事薪資系統</title>
</head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main.css" />

<style type="text/css">
body
{
	font-size:14pt;
}

#fr
{
	height:1cm;
}

#fr2
{
	height:0.3cm;
}

#fr3
{
	height:0.1cm;
}
 
#ep
{
	height:0.6cm;
}

#ep3
{
	height:1.5cm;
}

.ti
{
	border-right:1px #000 double;
	border-bottom:1px #000 double;
}

.ti2
{
	border-bottom:1px #000 double;
}

.ti3
{
	border-right:1px #000 double;
}

.ti31
{
	border-right:1px #000 double;
	background:#EEE;
}

.ti1
{
	border-right:1px #000 double;
	border-bottom:1px #000 double;
	background:#EEE;
}

.ti21
{
	border-bottom:1px #000 double;
	background:#EEE;
}
</style>

<body>
<?php
$i=0;
echo '<div style="text-align:center;font-weight:bold" id="fr">'.$user_copna.'</div>';
echo '<div style="text-align:left;width:100%;float:left" id="fr">列印日期 : '.date('Y/m/d').'</div>';
echo '<table cellpadding="0" cellspacing="0" style="width:100%;border:1px #000 double; text-align:center">';
echo '<tr>';
echo '<td width="10%" id="fr2" class="ti1">項次</td>';
echo '<td width="30%" class="ti1">部門代號</td>';
echo '<td width="60%" class="ti1">部門名稱</td>';
echo '</tr>';
foreach($data2 as $row)
{
	$i++;
	echo '<tr>';
	echo '<td class="ti" id="fr">'.$i.'</td>';
	echo '<td class="ti">'.$row['MA001'].'</td>';
	echo '<td class="ti">'.$row['MA002'].'</td>';
	echo '</tr>';
}
echo '</table>';
?>

