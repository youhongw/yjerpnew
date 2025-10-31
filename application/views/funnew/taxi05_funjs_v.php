<!-- 不更新網頁  --> 
<script type="text/javascript"><!--  
//檢查最新編號
function check_title_no(){
	//$('#mf006').val("");
	var cmsi11 = $('#cmsi11').val();
	var mf002 = $('#mf002').val();
	//alert(copi03);
	console.log(cmsi11);
	console.log(mf002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/tax/taxi05/check_title_no",
		data: {
			cmsi11: cmsi11, 
			mf002: mf002
		}
	})
	.done(function( msg ) {
		if($('#cmsi11disp').text()!=""&&$('#cmsi11disp').text()!="查無資料")
		$('#mf005').val(msg);
	});
}
//檢查最新編號
function check_vformat(){
var vform=$('select[name=\'mf003\']').attr('value');
    console.log(vform);
	mf007=$('#mf007').val();mf008=$('#mf008').val();
  if ((vform>=21 && vform <=28) && $('#mf008').val()!='') {$('#mf007').val(mf008);$('#mf008').val("");} 
  if ((vform>=31 && vform <=36) && $('#mf007').val()!='') {$('#mf008').val(mf007);$('#mf007').val("");}
}

function check_length(vinput){
	mf009=$('#mf009').val();
	console.log(mf009);
	if ( mf009.length!=10 ) {alert('發票號碼須輸入10碼');}
	$('#mf009').focus;
}     
function check_tax(vinput){
//稅金mc013 課稅別 mc012 稅率:mc226
	mf011=$('select[name=\'mf011\']').val();
	if (mf011<=1) {tax=0.05} else {tax=0}
	sumamt=$('input[name=\'mf010\']').val();
	$('#mf012').val(Math.round(sumamt*tax));
}
//檢查資料重複
function check_key(oInput){
	var mf001 = $('#mf001').val();
	console.log(mf001);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/tax/taxi05/check_key",
		data: {
			mf001: mf001
		}
	})
	.done(function( msg ) {
		$('#keydisp').text(msg);
		if (msg!='') {$('#mf001').focus();} 
		console.log(msg);
	});
}
//首先判斷是否有輸入提示
function checkspace(oInput){   
	if(!oInput.value){		
		$("#keydisp").text("不可空白.");
	}
	 
}
</script>

