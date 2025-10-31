<script type="text/javascript"> 	
//查詢訂單性質開視窗ipsi02 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showipsi02disp").click(function() {
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
		message: $('#divFipsi02'),
		onOverlayClick: clear_ipsi02disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#ipsi02').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#ipsi02').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/ips/ipsi02/lookup1_ipsi02/'+encodeURIComponent(smb001), 
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
				$('#ipsi02').val(ui.item.value1);
				$('#ipsi02disp').text(ui.item.value2);
				//console.log($('#ipsi02').val(ui.item.value1));
				return false;
			}else{
				$('#ipsi02disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addipsi02disp(smb001,smb002){
	console.log(smb001);
	$('#ipsi02').val(smb001);
	//$('#ipsi02disp').text(smb002);
	$('#tc002').val(smb002);
	$('#ipsi02').focus();
	//check_ipsi02(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ips/ipsi02/clear_sql"
	}); 
}
function clear_ipsi02disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ips/ipsi02/clear_sql"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_ipsi02(row_obj){
	var smb001= $('#ipsi02').val();
	if(!smb001){$('#ipsi02disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ips/ipsi02/lookup2_ipsi02/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#ipsi02').val("");
					$('#ipsi02disp').text("查無資料");
				}
				$('#ipsi02').val(smb001);
				$('#ipsi02disp').text(data.message[0].value2);
			}else{
				$('#ipsi02').val(smb001);
				$('#ipsi02disp').text("查無資料");
			}
		}
	});
}
 //ondblclick 按2下開視窗
function search_ipsi02_window() {
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
		message: $('#divFipsi02'),
		onOverlayClick: clear_ipsi02disp_sql
	});
	  $('.close').click($.unblockUI);
}  
</script>	   
<div id="divFipsi02" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/ips/ipsi02/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

