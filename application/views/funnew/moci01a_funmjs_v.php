<script type="text/javascript"> 	
//查詢製令性質開視窗moci01 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showmoci01disp").click(function() {
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
		message: $('#divFmoci01'),
		onOverlayClick: clear_moci01disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#moci01').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#moci01').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/moc/moci01/lookup_catcomplete/'+encodeURIComponent(smb001), 
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
				$('#moci01').val(ui.item.value1);
				$('#moci01disp').text(ui.item.value2);
				//console.log($('#moci01').val(ui.item.value1));
				return false;
			}else{
				$('#moci01disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addmoci01disp(smb001,smb002){
	$('#moci01').val(smb001);
	$('#moci01disp').text(smb002);
	$('#moci01').focus();
	//check_moci01(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci01/clear_sql"
	}); 
}
function clear_moci01disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci01/clear_sql"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_moci01(row_obj){
	var smb001= $('#moci01').val();
	console.log('test3');
	if(!smb001){$('#moci01disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/moc/moci01/lookup2_check/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#moci01').val("");
					$('#moci01disp').text("查無資料");
				}
				$('#moci01').val(smb001);
				console.log('test');
				$('#moci01disp').text(data.message[0].value2);
			}else{
				console.log('test1');
				$('#moci01').val(smb001);
				$('#moci01disp').text("查無資料");
			}
		}
	});
}
   
</script>	   
<div id="divFmoci01" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/moc/moci01/display_child_moci02" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>
