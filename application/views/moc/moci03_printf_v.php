<?php if (!$results)  { ?>
	<script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/moc/moci03/printdetail';location = url; </script> 
<?php exit;} ?>
<style>
.page{
	width: 850px;
	height: 550px;
	//中一刀
}
.print_item{
	display: inline-block;
	position: absolute;
	float: left;
}
</style>
<?php 
$page_data = array();
$invoice_data = array();
$total_page = 0;
$perpage_count = array();

foreach($results as $val){
	$invoice_data[$val->mocta_ta001."_".$val->mocta_ta002][] = $val;
}
foreach($invoice_data as $key => $val){
	$temp_count = 1;
	$total_page++;
	foreach($val as $k => $v){
		if(($k+1)%$detail_perpage==0){
			$total_page++;$temp_count++;
		}
		$page_data[$total_page][] = $v;
	}
	$perinvoice_count[$val[0]->mocta_ta001."_".$val[0]->mocta_ta002] = $temp_count;
}
$all_total_page = $total_page;
$current_page = 1;
/* echo "<pre>";var_dump($page_data);echo "</pre>";exit; */
?>
<?php 
foreach($page_data as $pg_key =>$pg_val){
	$total_page = $perinvoice_count[$pg_val[0]->mocta_ta001."_".$pg_val[0]->mocta_ta002];
?>
<div id="page_<?php echo $pg_key;?>" class='page' style="background-image:url('<?php echo base_url()?>assets/image/seti02/moci03.png');
			background-size: 100%;background-repeat: no-repeat;" >
<img src="<?php echo base_url()?>assets/image/seti02/moci03.png" style="visibility: hidden;width:100%;height:100%" />
<?php 
if(isset($page_data[$pg_key-1])){
	if($page_data[$pg_key-1][0]->mocta_ta001."_".$page_data[$pg_key-1][0]->mocta_ta002!=$page_data[$pg_key][0]->mocta_ta001."_".$page_data[$pg_key][0]->mocta_ta002){
		$current_page = 1;
	}
}
	foreach($col_data as $key=>$val){
		/* echo "<pre>";var_dump($pg_val);echo "</pre>";exit; */
		echo "<div id='".$val->tc004."_".$val->tc005."' class='print_item' >";
		if($val->tc004 == "OTHER"){echo $val->tc007;}
		else if($val->tc004 == "FUNC"){
			eval("\$content = \"$val->tc008\";");
			if(substr($content,0,4)=="date"){
				echo call_user_func("date","Y/m/d");}
			else{echo $content;}
		}
		else{
			$temp_str = $val->tc004."_".$val->tc005;
			if(isset($pg_val[0]->$temp_str)){
				echo $pg_val[0]->$temp_str;
			}
		}
		echo "</div>";
	}
	foreach($pg_val as $de_key => $de_val){
		if($de_key==0){continue;}
		foreach($de_val as $row_key => $row_val){
			if(substr($row_key,0,5) == $detail_table){
				echo "<div id='".$row_key."_".$de_key."' class='print_item sub_item' >";
				echo $row_val;
				echo "</div>";
			}
		}
	}
$current_page++;
?>
</div>
<div style="page-break-before: always;"></div>
<?php }?>
<script>
var total_page = <?php echo $all_total_page;?>;
var detail_gap = <?php echo $detail_gap;?>;
var col_data = <?php echo json_encode($col_data); ?>;
$(document).ready(function(){
	set_position(1);set_detail_position(1);
	set_position(2);set_detail_position(2);
	console.log(col_data);
});
function set_position(page){
	for(var key in col_data){
		var val = col_data[key];
		var posi = val['tc006'].split(',');
		var x = posi[0]*1+$('#page_'+page).position().left;
		var y = posi[1]*1+$('#page_'+page).position().top;
		$('#page_'+page+' #'+val['tc004']+"_"+val['tc005']).offset({top:y,left:x});
	}
}
function set_detail_position(page){
	$('#page_'+page+' .sub_item').each(function(){
		var temp = this.id.split('_');
		var table = temp[0];var col = temp[1];var no = temp[2];
		var x = $('#page_'+page+' #'+table+"_"+col).position().left;
		var y = $('#page_'+page+' #'+table+"_"+col).position().top+detail_gap*no;
		$('#page_'+page+' #'+table+"_"+col+"_"+no).offset({top:y,left:x});
	});
	for(var key in col_data){
		var val = col_data[key];
		var posi = val['tc006'].split(',');
		var x = posi[0]*1+$('#page_'+page).position().left;
		var y = posi[1]*1+$('#page_'+page).position().top;
		$('#page_'+page+' #'+val['tc004']+"_"+val['tc005']).offset({top:y,left:x});
	}
}
//"<div id='"+table+"_"+id+"' class='print_item "+table+"_items' ></div>";
</script>