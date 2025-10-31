<script type="text/javascript"> 
$.widget('custom.catcomplete', $.ui.autocomplete, {
	_renderMenu: function(ul, items) {
		var self = this, currentCategory = '';
						
		$.each(items, function(index, item) {
			if (item.category != currentCategory) {
				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');
								
				currentCategory = item.category;
			}
							
			self._renderItem(ul, item);
		});
	}
});	
</script>
<script type="text/javascript"> 	
//查詢庫別開視窗 cmsi03 
$(document).ready(function(){
	$("#Showcmsi03disp").click(function() {
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '70%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFcmsi03'),
		onOverlayClick: clear_cmsi03disp_sql
	});
	  $('.close').click($.unblockUI);
	});

//下拉提示選單	
</script>

<script type="text/javascript"> 
    $('#cmsi03').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#cmsi03').val();
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookup_cmsi03/'+encodeURIComponent(smb001), 
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
				$('#cmsi03').val(ui.item.value1);
				$('#cmsi03disp').text(ui.item.value2);
				console.log($('#cmsi03').val());
				return false;
			}else{
				$('#cmsi03disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});

function addcmsi03disp(mb001,mb002){
	$('#cmsi03').val(mb001);
	$('#cmsi03disp').text(mb002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi03/clear_sql"
	});
}
function clear_cmsi03disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi03/clear_sql"
	});
}
//輸入編號按enter 自動找到名稱
function check_cmsi03(row_obj){
	var smb001= $('#cmsi03').val();
	if(!smb001){$('#cmsi03disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookup_cmsi03/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#cmsi03').val("");
					$('#cmsi03disp').text("查無資料");
				}
				$('#cmsi03').val(data.message[0].value1);
				$('#cmsi03disp').text(data.message[0].value2);
			}else{
				$('#cmsi03').val("");
				$('#cmsi03disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFcmsi03" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi03/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

