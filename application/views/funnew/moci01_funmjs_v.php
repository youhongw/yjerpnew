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
	if(!smb001){$('#moci01disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/moc/moci01/lookup_check/'+encodeURIComponent(smb001), 
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
				$('#moci01disp').text(data.message[0].value2);
			}else{
				$('#moci01').val(smb001);
				$('#moci01disp').text("查無資料");
			}
		}
	});
}
   
</script>	   
<div id="divFmoci01" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/moc/moci01/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>


<script type="text/javascript"> 	
//查詢製令性質開視窗moci01 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showmoci01_moci04disp").click(function() {
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
		message: $('#divFmoci01_moci04'),
		onOverlayClick: clear_moci01_moci04disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#moci01_moci04').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#moci01_moci04').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/moc/moci01/lookup_catcomplete_moci04/'+encodeURIComponent(smb001), 
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
				$('#moci01_moci04').val(ui.item.value1);
				$('#moci01_moci04disp').text(ui.item.value2);
				//console.log($('#moci01_moci04').val(ui.item.value1));
				return false;
			}else{
				$('#moci01_moci04disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addmoci01_moci04disp(smb001,smb002){
	$('#moci01_moci04').val(smb001);
	$('#moci01_moci04disp').text(smb002);
	$('#moci01_moci04').focus();
	//check_moci01_moci04(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci01/clear_sql_moci04"
	}); 
}
function clear_moci01_moci04disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci01/clear_sql_moci04"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_moci01_moci04(row_obj){
	var smb001= $('#moci01_moci04').val();
	if(!smb001){$('#moci01_moci04disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/moc/moci01/lookup_check_moci04/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#moci01_moci04').val("");
					$('#moci01_moci04disp').text("查無資料");
				}
				$('#moci01_moci04').val(smb001);
				$('#moci01_moci04disp').text(data.message[0].value2);
			}else{
				$('#moci01_moci04').val(smb001);
				$('#moci01_moci04disp').text("查無資料");
			}
		}
	});
}
   
</script>	   
<div id="divFmoci01_moci04" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/moc/moci01/display_child_moci04" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script type="text/javascript"> 	
//查詢製令性質開視窗moci01 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showmoci01_moci05disp").click(function() {
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
		message: $('#divFmoci01_moci05'),
		onOverlayClick: clear_moci01_moci05disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#moci01_moci05').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#moci01_moci05').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/moc/moci01/lookup_catcomplete_moci05/'+encodeURIComponent(smb001), 
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
				$('#moci01_moci05').val(ui.item.value1);
				$('#moci01_moci05disp').text(ui.item.value2);
				//console.log($('#moci01_moci05').val(ui.item.value1));
				return false;
			}else{
				$('#moci01_moci05disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addmoci01_moci05disp(smb001,smb002){
	$('#moci01_moci05').val(smb001);
	$('#moci01_moci05disp').text(smb002);
	$('#moci01_moci05').focus();
	//check_moci01_moci05(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci01/clear_sql_moci05"
	}); 
}
function clear_moci01_moci05disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci01/clear_sql_moci05"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_moci01_moci05(row_obj){
	var smb001= $('#moci01_moci05').val();
	if(!smb001){$('#moci01_moci05disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/moc/moci01/lookup_check_moci05/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#moci01_moci05').val("");
					$('#moci01_moci05disp').text("查無資料");
				}
				$('#moci01_moci05').val(smb001);
				$('#moci01_moci05disp').text(data.message[0].value2);
			}else{
				$('#moci01_moci05').val(smb001);
				$('#moci01_moci05disp').text("查無資料");
			}
		}
	});
}
   
</script>	   
<div id="divFmoci01_moci05" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/moc/moci01/display_child_moci05" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>


