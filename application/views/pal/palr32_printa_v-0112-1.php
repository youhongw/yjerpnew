<?
//echo "<pre>";var_dump($results);exit;
$start=1;
$end=75;
if(isset($_POST["text"])) $text=$_POST["text"];
if(isset($_POST["format"])) $format=$_POST["format"];
if(isset($_POST["quality"])) $quality=$_POST["quality"];
if(isset($_POST["width"])) $width=$_POST["width"];
if(isset($_POST["height"])) $height=$_POST["height"];
if(isset($_POST["type"])) $type=$_POST["type"];
if(isset($_POST["barcode"])) $barcode=$_POST["barcode"];
if(isset($_POST["start"])) $start=$_POST["start"];
if(isset($_POST["end"])) $end=$_POST["end"];

if(isset($_POST["tc009p"])) $barcode_type=$_POST["tc009p"];
$page = ceil($num_results/75);
$last_num = $num_results%75;
//echo "<pre>";var_dump($page);exit;
?>
<?for($i=1;$i<=$page;$i++){?>
<br>
<div style="margin:8px 33px;overflow:auto;">
<?for($j=$i*75-75;$j<$i*75;$j++){//最最多一張就印75張?>
<?if($i==$page && $j%75>=$last_num){
	continue; ?>
<?}?>
<div style="float:left;width:134px;height:61px;padding: 5px 5px 5px 5px;text-align:center">
<div style="text-align:center"><?=$dateo ?> <?=$results[$j]->yh005 ?></div>
</div>
<?}?>
</div>

<div style="page-break-before: always;"></div>

<?
}
?>