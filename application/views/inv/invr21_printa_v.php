<?php 
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
$barcode_ary = Array();$i = 0;
foreach($barcode as $key => $val){
	if($val){
		$barcode_ary[$i]['barcode'] = $val;
		$barcode_ary[$i]['start'] = $start[$key];
		$barcode_ary[$i]['end'] = $end[$key];
		$i ++;
	}
}
$str_ary = Array();$end_ary = Array();
foreach($barcode_ary as $key => $val){
	$str_ary[] = $val['start'];
	$end_ary[] = $val['end'];
}

if(isset($_POST["tc009p"])) $barcode_type=$_POST["tc009p"];
if($barcode_type<1 || $barcode_type>2)
	$barcode_type=1;

if($barcode_type==1){
	if($start<1)
		$start=1;
	if($end<1)
		$end=75;
	if(!@$width) {$width=205;}
	if(!@$height) {$height=75;}
}
if($barcode_type==2){
	if($start<1)
		$start=1;
	if($end<1)
		$end=75;
	if(!@$width) {$width=275;}
	if(!@$height) {$height=100;}
}
?>
<?php if($barcode_type==1){//9碼?>
<br>
<div style="margin:8px 33px;overflow:auto;">
<?php for($i=0;$i<75;$i++){//最最多一張就印75張?>
<div style="float:left;width:134px;height:61px;padding: 5px 5px 5px 5px;text-align:center">
<?php 	foreach($str_ary as $key => $val){
		if(($i+1)>=$val && ($i+1)<=$end_ary[$key]){?>
			<img src="<?php  echo base_url()?>assets/javascript/ext/barcode_128/code_128.php?code=<?php $barcode_ary[$key]['barcode'] ?>&width=<?php $width?>&height=<?php $height?>" style="width:100px;height:<?php $height?>"> 
		
			<div style="text-align:center"><?php $barcode_ary[$key]['barcode']?></div>
<?php 		}
	}
?>
</div>
<?php }
}?>
</div>

<?php if($barcode_type==2){//13碼?>
<br>
<div style="margin:6px 27px;overflow:auto;">
<?php for($i=0;$i<75;$i++){//最最多一張就印75張?>
<div style="float:left;width:133px;height:62px;padding: 5px 5px 5px 5px;text-align:center">
<?php  foreach($str_ary as $key => $val){
		if(($i+1)>=$val && ($i+1)<=$end_ary[$key]){?>
			<img src="<?php  echo base_url()?>assets/javascript/ext/barcode_ean13/barcode.php?code=<?php $barcode_ary[$key]['barcode'] ?>" style="width:100px;height:<?php $height?>">
<?php 		}
		
	}?>
</div>
<?php }
}?>
</div>
