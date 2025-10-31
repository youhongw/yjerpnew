<script type="text/javascript"> 	
//檢查最新編號
function check_title_no1(){
	$('#tc003').val("");
	var ipsi02 = $('#ipsi02').val();
	var tc002 = $('#tc002').val();
	//alert(ipsi02);
	console.log(ipsi02);
	console.log(tc002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ips/ipsi03/check_title_no1",
		data: {
			ipsi02: ipsi02, 
			tc002: tc002
		}
	})
	.done(function( msg ) {
		if($('#ipsi02disp').text()!=""&&$('#ipsi02disp').text()!="查無資料")
		$('#tc003').val(msg);
	});
}
</script>
<script type="text/javascript"> 
/***Talence 更新自動focus***/
$(document).keydown(function(event){
	var keycode = (event.keyCode ? event.keyCode :event.which);
	if(event.altKey && (keycode == '65')){  //tab1 a
		setTimeout(function() {
			$('input[name="cmsi05"]').focus();
		}, 100);
	}
	if(event.altKey && (keycode == '66')){  //tab2 b
		setTimeout(function() {
			$('#tb010').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '67')){  //tab3 c
		setTimeout(function() {
			$('#mv032').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '71')){  //tab4 g
		setTimeout(function() {
			$('#mv048').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '72')){  //tab5 h
		setTimeout(function() {
			$('#mv048').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '73')){  //tab6 i
		setTimeout(function() {
			$('#mv049').focus();
		}, 100);	
	}
	//跳明細
	if(event.altKey && (keycode == '89')){  //tab6 y
		setTimeout(function() {
			$('input[name=\'order_product[1][tc004]\']').focus();
		}, 100);	
	}
	//新增一筆明細 alt+w 
	if(event.altKey && (keycode == '87' || keycode == '119')){
		addItem();
	}
});
//--></script>
