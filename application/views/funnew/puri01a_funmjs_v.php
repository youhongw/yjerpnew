<script type="text/javascript"> 	
//查詢供應商開視窗puri01a //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showpuri01adisp").click(function() {
	$.blockUI({
		css: {
			top: '15%',
			left: '15%',
			height: '75%',
			width: '70%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFpuri01a'),
		onOverlayClick: clear_puri01adisp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#puri01a').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#puri01a').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/pur/puri01/lookup_catcomplete/'+encodeURIComponent(smb001), 
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
				$('#puri01a').val(ui.item.value1);
				$('#puri01adisp').text(ui.item.value2);
				$('#puri01adisp').val(ui.item.value2);
				//console.log($('#puri01a').val());
				return false;
			}else{
				$('#puri01adisp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addpuri01adisp(smb001,smb002){
	
	$('#puri01a').val(smb001);
	$('#puri01adisp').text(smb002);
	$('#puri01adisp').val(smb002);
	$('#puri01a').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri01/clear_sql"
	});
}
function clear_puri01adisp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri01/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_puri01a(row_obj){
	var sme001= $('#puri01a').val();
	if(!sme001){$('#puri01adisp').val("");return;}
	console.log('abc');
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/pur/puri01/lookup_check/'+encodeURIComponent(sme001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {ma001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#puri01a').val("");
					$('#puri01adisp').val("查無資料");
				}
				$('#puri01a').val(sme001);
				$('#puri01adisp').val(data.message[0].value2);
			}else{
				$('#puri01a').val(sme001);
				$('#puri01adisp').val("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFpuri01a" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/pur/puri01/display_childa" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

