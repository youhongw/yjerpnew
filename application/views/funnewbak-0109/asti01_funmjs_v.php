<script type="text/javascript"> 	
//以下為單頭function
$(document).ready(function(){
	$("#Showasti01disp").click(function() {
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
		message: $('#divFasti01'),
		onOverlayClick: clear_asti01disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#asti01').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#asti01').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/ast/asti01/lookup_catcomplete/'+encodeURIComponent(smb001), 
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
				$('#asti01').val(ui.item.value1);
				$('#asti01disp').text(ui.item.value2);
				$('#asti01disp2').val(ui.item.value3);
				//console.log($('#asti01').val(ui.item.value1));
				return false;
			}else{
				$('#asti01').val(ui.item.value1);
				$('#asti01disp2').val(ui.item.value3);
				$('#asti01disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addasti01disp(sma001,sma002){
	$('#asti01').val(sma001);
	$('#asti01disp').text(sma002);
	$('#asti01disp').val(sma002);
	$('#asti01').focus();
	//check_asti01(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti01/clear_sql"
	}); 
}
function clear_asti01disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti01/clear_sql"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_asti01(row_obj){
	var smb001= $('#asti01').val();
	if(!smb001){$('#asti01disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti01/lookup_check/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#asti01').val("");
					$('#asti01disp2').val("");
					$('#asti01disp').text("查無資料");
				}else{
					$('#asti01').val(smb001);
					$('#asti01disp2').val(data.message[0].value3);
					$('#asti01disp').text(data.message[0].value2);
				}
			}else{
				$('#asti01').val("");
				$('#asti01disp2').val("");
				$('#asti01disp').text("查無資料");
			}
		}
	});
}
   
</script>	   
<div id="divFasti01" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/ast/asti01/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>
