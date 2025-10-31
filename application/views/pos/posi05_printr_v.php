<?php 
extract($result);
$current_item = 0;
$totle_item = 0;
$items = Array();
foreach($cont as $key=>$val){
	$items[$key] = $val;
	$totle_item ++;
}

$page = ceil($totle_item/8);

for($i=1;$i<=$page;$i++){
?>
<div style="width:150px;height:701px;" >
<div style="width:150px;height:200px;">
</div>
<div style="width:150px;height:55px;">
&nbsp;&nbsp;&nbsp;&nbsp;<font size="1"><?php echo date('Y/m/d');?>&nbsp; <?php echo date('H:i');?>&nbsp; 頁#<?php echo $i;?></font><br>
&nbsp;&nbsp;&nbsp;&nbsp;<font size="1">0475 KS#081 編號#564</font><br>
</div>
<div>
<?php 
for($k=($i-1)*8;$k<=$i*8;$k++){
	if(!@$items[$k]){break;}?>
<div style="height:13px;">
	&nbsp;&nbsp;&nbsp;&nbsp;<span style="width:65px;height:11px;max-width:65px;display:inline-block;"><font size="1"><?php echo $items[$k]->tb005?></font></span>
	<span style="width:25px;height:11px;display: inline-block;"><font size="1"><?php echo $items[$k]->tb010?></font></span>
	<font size="1" style="width:30px;"><?php echo '$'.$items[$k]->tb016?></font><br>
</div>
<?php }?>
</div>
<br><br><br>
<div>
	&nbsp;&nbsp;&nbsp;&nbsp;<span style="width:90px;height:11px;max-width:90px;display:inline-block;">
	<font size="1">應收金額</font></span><font size="1"><?php echo $title->ta012;?></font><br>
	&nbsp;&nbsp;&nbsp;&nbsp;<span style="width:90px;height:11px;max-width:90px;display:inline-block;">
	<font size="1">支付金額</font></span><font size="1"><?php echo $title->ta015+$title->ta016;?></font><br>
	&nbsp;&nbsp;&nbsp;&nbsp;<span style="width:90px;height:11px;max-width:90px;display:inline-block;">
	<font size="1">找零金額</font></span><font size="1"><?php echo $title->ta019;?></font><br>
</div>
</div>
<?php 
}
?>
<script>
$(document).ready(function(){
	window.print()
});

</script>