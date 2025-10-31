<script type="text/javascript"> 	
//查詢庫別開視窗admi01 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showadmi01disp").click(function() {
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '75%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFadmi01'),
		onOverlayClick: clear_admi01disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#admi01').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#admi01').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/adm/admi01/lookup1_admi01/'+encodeURIComponent(smb001), 
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
				$('#admi01').val(ui.item.value1);
				$('#admi01disp').text(ui.item.value2);
				//console.log($('#admi01').val());
				return false;
			}else{
				$('#admi01disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addadmi01disp(smb001,smb002){
	$('#admi01').val(smb001);
	$('#admi01disp').text(smb002);
	$('#admi01').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/adm/admi01/clear_sql"
	});
}
function clear_admi01disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/adm/admi01/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_admi01(row_obj){
	var sme001= $('#admi01').val();
	if(!sme001){$('#admi01disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/adm/admi01/lookup2_admi01/'+encodeURIComponent(sme001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {me001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#admi01').val("");
					$('#admi01disp').text("查無資料");
				}
				$('#admi01').val(sme001);
				$('#admi01disp').text(data.message[0].value2);
			}else{
				$('#admi01').val(sme001);
				$('#admi01disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFadmi01" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/adm/admi01/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

