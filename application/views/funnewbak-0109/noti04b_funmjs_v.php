<script type="text/javascript"> 	
//查詢銀行代號開視窗noti04 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Shownoti04bdisp").click(function() {
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '80%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFnoti04b'),
		onOverlayClick: clear_noti04bdisp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    /*$('#noti04').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#noti04').val();
			$('#noti04').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/not/noti04/lookup1_noti04/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,
                success:      
				function(data){  
					if(data.response =="true"){
						add(data.message);
					}
				}
			});
		},  
		select: function(event, ui) {
			if(ui.item.value!="查無資料"){
				$('#noti04').val(ui.item.value1);
				$('#noti04disp').text(ui.item.value2);
				//console.log($('#noti04').val());
				return false;
			}else{
				$('#noti04disp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#noti04').attr('onchange','check_noti04(this)');
			check_noti04($('#noti04').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});*/
});
function addnoti04bdisp(smb001,smb002,smb003,smb004){
	//alert('test2');
	addItem2(smb001,smb002,smb003,smb004);
	$('#noti04').focus();
	/*$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti04/clear_sql"
	});*/
}
function clear_noti04bdisp_sql(){
	$.unblockUI();
	
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri01/clear_sql"   //刪除(轉付廠商)小視窗的搜尋條件
	});

	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi06/clear_sql2"  //刪除(匯率)小視窗的搜尋條件
	});
}
//不更新網頁 輸入直接跳出中文
/*function check_noti04(row_obj){
	var smb001= $('#noti04').val();
	if(!smb001){$('#noti04disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/not/noti04/lookup2_noti04/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#noti04').val("");
					$('#noti04disp').text("查無資料");
				}
				$('#noti04').val(smb001);
				$('#noti04disp').text(data.message[0].value2);
			}else{
				$('#noti04').val(smb001);
				$('#noti04disp').text("查無資料");
			}
		}
	});
}*/
</script>	   
<div id="divFnoti04b" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/not/noti04/display_childb" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

