<script type="text/javascript"> 	
//查詢銀行代號開視窗noti03 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Shownoti03bdisp").click(function() {
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
		message: $('#divFnoti03b'),
		onOverlayClick: clear_noti03bdisp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    /*$('#noti03').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#noti03').val();
			$('#noti03').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/not/noti03/lookup1_noti03/'+encodeURIComponent(smb001), 
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
				$('#noti03').val(ui.item.value1);
				$('#noti03bisp').text(ui.item.value2);
				//console.log($('#noti03').val());
				return false;
			}else{
				$('#noti03bisp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#noti03').attr('onchange','check_noti03(this)');
			check_noti03($('#noti03').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});*/
});
function addnoti03bdisp(smb001,smb002){
	//alert('test2')e;
	addItem3(smb001,smb002);
	$('#noti03').focus();
	/*$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti03/clear_sql"
	});*/
}
function clear_noti03bdisp_sql(){
	$.unblockUI();
	/*$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti03/clear_sql"
	});*/
}
//不更新網頁 輸入直接跳出中文
/*function check_noti03c(row_obj){
	var smb001= $('#noti03').val();
	if(!smb001){$('#noti03bisp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/not/noti03/lookup2_noti03/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#noti03').val("");
					$('#noti03bisp').text("查無資料");
				}
				$('#noti03').val(smb001);
				$('#noti03bisp').text(data.message[0].value2);
			}else{
				$('#noti03').val(smb001);
				$('#noti03bisp').text("查無資料");
			}
		}
	});
}*/
</script>	   
<div id="divFnoti03b" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/not/noti03/display_childb" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

