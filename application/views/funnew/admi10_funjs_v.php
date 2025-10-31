<!-- 不更新網頁  --> 
<script type="text/javascript"><!--       
//檢查資料重複
function check_key(oInput){
	var mf001 = $('#mf001').val();
	console.log(mf001);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/adm/admi10/check_key",
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

