<script type="text/javascript"> 	
//查詢訂單性質開視窗epsi01 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showepsi01disp").click(function() {
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
		message: $('#divFepsi01'),
		onOverlayClick: clear_epsi01disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#epsi01').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#epsi01').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/eps/epsi01/lookup1_epsi01/'+encodeURIComponent(smb001), 
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
				$('#epsi01').val(ui.item.value1);
				$('#epsi01disp').text(ui.item.value2);
				//console.log($('#epsi01').val(ui.item.value1));
				return false;
			}else{
				$('#epsi01disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addepsi01disp(smb001,smb002){
	console.log(smb001);
	$('#epsi01').val(smb001);
	$('#epsi01disp').text(smb002);
	$('#epsi01').focus();
	//check_epsi01(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/eps/epsi01/clear_sql"
	}); 
}
function clear_epsi01disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/eps/epsi01/clear_sql"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_epsi01(row_obj){
	var smb001= $('#epsi01').val();
	if(!smb001){$('#epsi01disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/eps/epsi01/lookup2_epsi01/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#epsi01').val("");
					$('#epsi01disp').text("查無資料");
				}
				$('#epsi01').val(smb001);
				$('#epsi01disp').text(data.message[0].value2);
			}else{
				$('#epsi01').val(smb001);
				$('#epsi01disp').text("查無資料");
			}
		}
	});
}
 //ondblclick 按2下開視窗
function search_epsi01_window() {
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
		message: $('#divFepsi01'),
		onOverlayClick: clear_epsi01disp_sql
	});
	  $('.close').click($.unblockUI);
}  
</script>	   
<div id="divFepsi01" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/eps/epsi01/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

