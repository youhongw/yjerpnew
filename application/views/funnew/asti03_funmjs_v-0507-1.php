<script type="text/javascript"> 	
//查詢訂單性質開視窗asti03 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showasti03_asti06disp").click(function() {
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
		message: $('#divFasti03_asti06'),
		onOverlayClick: clear_asti03_asti06disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#asti03_asti06').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#asti03_asti06').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/ast/asti03/lookup_catcomplete_asti06/'+encodeURIComponent(smb001), 
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
				$('#asti03_asti06').val(ui.item.value1);
				$('#asti03_asti06disp').text(ui.item.value2);
				//console.log($('#asti03').val(ui.item.value1));
				return false;
			}else{
				$('#asti03_asti06').val("");
				$('#asti03_asti06disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addasti03disp(smb001,smb002){
	$('#asti03_asti06').val(smb001);
	$('#asti03_asti06disp').text(smb002);
	$('#asti03_asti06').focus();
	//check_asti03(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti03/clear_sql_asti06"
	}); 
}
function clear_asti03_asti06disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti03/clear_sql_asti06"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_asti03_asti06(row_obj){
	var smb001= $('#asti03_asti06').val();
	if(!smb001){$('#asti03_asti06disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti03/lookup_check_asti06/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#asti03_asti06').val("");
					$('#asti03_asti06disp').text("查無資料");
				}else{
					$('#asti03_asti06').val(smb001);
					$('#asti03_asti06disp').text(data.message[0].value2);
				}
			}else{
				$('#asti03_asti06').val("");
				$('#asti03_asti06disp').text("查無資料");
			}
		}
	});
}
   
</script>	   
<div id="divFasti03_asti06" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/ast/asti03/display_child_asti06" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>


<script type="text/javascript"> 	
//查詢訂單性質開視窗asti03 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showasti03_asti07disp").click(function() {
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
		message: $('#divFasti03_asti07'),
		onOverlayClick: clear_asti03_asti07disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#asti03_asti07').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#asti03_asti07').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/ast/asti03/lookup_catcomplete_asti07/'+encodeURIComponent(smb001), 
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
				$('#asti03_asti07').val(ui.item.value1);
				$('#asti03_asti07disp').text(ui.item.value2);
				//console.log($('#asti03').val(ui.item.value1));
				return false;
			}else{
				$('#asti03_asti07').val("");
				$('#asti03_asti07disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addasti03_asti07disp(smb001,smb002){
	$('#asti03_asti07').val(smb001);
	$('#asti03_asti07disp').text(smb002);
	$('#asti03_asti07').focus();
	//check_asti03(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti03/clear_sql_asti07"
	}); 
}
function clear_asti03_asti07disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti03/clear_sql_asti07"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_asti03_asti07(row_obj){
	var smb001= $('#asti03_asti07').val();
	if(!smb001){$('#asti03_asti07disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti03/lookup_check_asti07/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#asti03_asti07').val("");
					$('#asti03_asti07disp').text("查無資料");
				}else{
					$('#asti03_asti07').val(smb001);
					$('#asti03_asti07disp').text(data.message[0].value2);
				}
			}else{
				$('#asti03_asti07').val("");
				$('#asti03_asti07disp').text("查無資料");
			}
		}
	});
}
   
</script>	   
<div id="divFasti03_asti07" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/ast/asti03/display_child_asti07" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script type="text/javascript"> 	
//查詢訂單性質開視窗asti03 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showasti03_asti08disp").click(function() {
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
		message: $('#divFasti03_asti08'),
		onOverlayClick: clear_asti03_asti08disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#asti03_asti08').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#asti03_asti08').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/ast/asti03/lookup_catcomplete_asti08/'+encodeURIComponent(smb001), 
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
				$('#asti03_asti08').val(ui.item.value1);
				$('#asti03_asti08disp').text(ui.item.value2);
				//console.log($('#asti03').val(ui.item.value1));
				return false;
			}else{
				$('#asti03_asti08').val("");
				$('#asti03_asti08disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addasti03_asti08disp(smb001,smb002){
	$('#asti03_asti08').val(smb001);
	$('#asti03_asti08disp').text(smb002);
	$('#asti03_asti08').focus();
	//check_asti03(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti03/clear_sql_asti08"
	}); 
}
function clear_asti03_asti08disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti03/clear_sql_asti08"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_asti03_asti08(row_obj){
	var smb001= $('#asti03_asti08').val();
	if(!smb001){$('#asti03_asti08disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti03/lookup_check_asti08/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#asti03_asti08').val("");
					$('#asti03_asti08disp').text("查無資料");
				}else{
					$('#asti03_asti08').val(smb001);
					$('#asti03_asti08disp').text(data.message[0].value2);
				}
			}else{
				$('#asti03_asti08').val("");
				$('#asti03_asti08disp').text("查無資料");
			}
		}
	});
}
   
</script>	   
<div id="divFasti03_asti08" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/ast/asti03/display_child_asti08" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script type="text/javascript"> 	
//查詢訂單性質開視窗asti03 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showasti03_asti09disp").click(function() {
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
		message: $('#divFasti03_asti09'),
		onOverlayClick: clear_asti03_asti09disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#asti03_asti09').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#asti03_asti09').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/ast/asti03/lookup_catcomplete_asti09/'+encodeURIComponent(smb001), 
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
				$('#asti03_asti09').val(ui.item.value1);
				$('#asti03_asti09disp').text(ui.item.value2);
				//console.log($('#asti03').val(ui.item.value1));
				return false;
			}else{
				$('#asti03_asti09').val("");
				$('#asti03_asti09disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addasti03_asti09disp(smb001,smb002){
	$('#asti03_asti09').val(smb001);
	$('#asti03_asti09disp').text(smb002);
	$('#asti03_asti09').focus();
	//check_asti03(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti03/clear_sql_asti09"
	}); 
}
function clear_asti03_asti09disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti03/clear_sql_asti09"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_asti03_asti09(row_obj){
	var smb001= $('#asti03_asti09').val();
	if(!smb001){$('#asti03_asti09disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti03/lookup_check_asti09/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#asti03_asti09').val("");
					$('#asti03_asti09disp').text("查無資料");
				}else{
					$('#asti03_asti09').val(smb001);
					$('#asti03_asti09disp').text(data.message[0].value2);
				}
			}else{
				$('#asti03_asti09').val("");
				$('#asti03_asti09disp').text("查無資料");
			}
		}
	});
}
   
</script>	   
<div id="divFasti03_asti09" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/ast/asti03/display_child_asti09" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>


<script type="text/javascript"> 	
//查詢訂單性質開視窗asti03 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showasti03_asti10disp").click(function() {
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
		message: $('#divFasti03_asti10'),
		onOverlayClick: clear_asti03_asti10disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#asti03_asti10').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#asti03_asti10').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/ast/asti03/lookup_catcomplete_asti10/'+encodeURIComponent(smb001), 
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
				$('#asti03_asti10').val(ui.item.value1);
				$('#asti03_asti10disp').text(ui.item.value2);
				//console.log($('#asti03').val(ui.item.value1));
				return false;
			}else{
				$('#asti03_asti10').val("");
				$('#asti03_asti10disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addasti03_asti10disp(smb001,smb002){
	$('#asti03_asti10').val(smb001);
	$('#asti03_asti10disp').text(smb002);
	$('#asti03_asti10').focus();
	//check_asti03(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti03/clear_sql_asti10"
	}); 
}
function clear_asti03_asti10disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti03/clear_sql_asti10"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_asti03_asti10(row_obj){
	var smb001= $('#asti03_asti10').val();
	if(!smb001){$('#asti03_asti10disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti03/lookup_check_asti10/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#asti03_asti10').val("");
					$('#asti03_asti10disp').text("查無資料");
				}else{
					$('#asti03_asti10').val(smb001);
					$('#asti03_asti10disp').text(data.message[0].value2);
				}
			}else{
				$('#asti03_asti10').val("");
				$('#asti03_asti10disp').text("查無資料");
			}
		}
	});
}
   
</script>	   
<div id="divFasti03_asti10" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/ast/asti03/display_child_asti10" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>


<script type="text/javascript"> 	
//查詢訂單性質開視窗asti03 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showasti03_asti13disp").click(function() {
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
		message: $('#divFasti03_asti13'),
		onOverlayClick: clear_asti03_asti13disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#asti03_asti13').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#asti03_asti13').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/ast/asti03/lookup_catcomplete_asti13/'+encodeURIComponent(smb001), 
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
				$('#asti03_asti13').val(ui.item.value1);
				$('#asti03_asti13disp').text(ui.item.value2);
				//console.log($('#asti03').val(ui.item.value1));
				return false;
			}else{
				$('#asti03_asti13').val("");
				$('#asti03_asti13disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addasti03_asti13disp(smb001,smb002){
	$('#asti03_asti13').val(smb001);
	$('#asti03_asti13disp').text(smb002);
	$('#asti03_asti13').focus();
	//check_asti03(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti03/clear_sql_asti13"
	}); 
}
function clear_asti03_asti13disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti03/clear_sql_asti13"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_asti03_asti13(row_obj){
	var smb001= $('#asti03_asti13').val();
	if(!smb001){$('#asti03_asti13disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti03/lookup_check_asti13/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#asti03_asti13').val("");
					$('#asti03_asti13disp').text("查無資料");
				}else{
					$('#asti03_asti13').val(smb001);
					$('#asti03_asti13disp').text(data.message[0].value2);
				}
			}else{
				$('#asti03_asti13').val("");
				$('#asti03_asti13disp').text("查無資料");
			}
		}
	});
}
   
</script>	   
<div id="divFasti03_asti13" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/ast/asti03/display_child_asti10/asti13" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script type="text/javascript"> 	
//查詢訂單性質開視窗asti03 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showasti03_asti14disp").click(function() {
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
		message: $('#divFasti03_asti14'),
		onOverlayClick: clear_asti03_asti14disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#asti03_asti14').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#asti03_asti14').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/ast/asti03/lookup_catcomplete_asti14/'+encodeURIComponent(smb001), 
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
				$('#asti03_asti14').val(ui.item.value1);
				$('#asti03_asti14disp').text(ui.item.value2);
				//console.log($('#asti03').val(ui.item.value1));
				return false;
			}else{
				$('#asti03_asti14').val("");
				$('#asti03_asti14disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addasti03_asti14disp(smb001,smb002){
	$('#asti03_asti14').val(smb001);
	$('#asti03_asti14disp').text(smb002);
	$('#asti03_asti14').focus();
	//check_asti03(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti03/clear_sql_asti14"
	}); 
}
function clear_asti03_asti14disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti03/clear_sql_asti14"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_asti03_asti14(row_obj){
	var smb001= $('#asti03_asti14').val();
	if(!smb001){$('#asti03_asti14disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti03/lookup_check_asti14/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#asti03_asti14').val("");
					$('#asti03_asti14disp').text("查無資料");
				}else{
					$('#asti03_asti14').val(smb001);
					$('#asti03_asti14disp').text(data.message[0].value2);
				}
			}else{
				$('#asti03_asti14').val("");
				$('#asti03_asti14disp').text("查無資料");
			}
		}
	});
}
   
</script>	   
<div id="divFasti03_asti14" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/ast/asti03/display_child_asti14" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script type="text/javascript"> 	
//查詢訂單性質開視窗asti03 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showasti03_asti15disp").click(function() {
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
		message: $('#divFasti03_asti15'),
		onOverlayClick: clear_asti03_asti15disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#asti03_asti15').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#asti03_asti15').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/ast/asti03/lookup_catcomplete_asti15/'+encodeURIComponent(smb001), 
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
				$('#asti03_asti15').val(ui.item.value1);
				$('#asti03_asti15disp').text(ui.item.value2);
				//console.log($('#asti03').val(ui.item.value1));
				return false;
			}else{
				$('#asti03_asti15').val("");
				$('#asti03_asti15disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addasti03_asti15disp(smb001,smb002){
	$('#asti03_asti15').val(smb001);
	$('#asti03_asti15disp').text(smb002);
	$('#asti03_asti15').focus();
	//check_asti03(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti03/clear_sql_asti15"
	}); 
}
function clear_asti03_asti15disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti03/clear_sql_asti15"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_asti03_asti15(row_obj){
	var smb001= $('#asti03_asti15').val();
	if(!smb001){$('#asti03_asti15disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti03/lookup_check_asti15/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#asti03_asti15').val("");
					$('#asti03_asti15disp').text("查無資料");
				}else{
					$('#asti03_asti15').val(smb001);
					$('#asti03_asti15disp').text(data.message[0].value2);
				}
			}else{
				$('#asti03_asti15').val("");
				$('#asti03_asti15disp').text("查無資料");
			}
		}
	});
}
   
</script>	   
<div id="divFasti03_asti15" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/ast/asti03/display_child_asti15" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>


<script type="text/javascript"> 	
//查詢訂單性質開視窗asti03 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showasti03_asti15bdisp").click(function() {
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
		message: $('#divFasti03_asti15b'),
		onOverlayClick: clear_asti03_asti15bdisp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#asti03_asti15b').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#asti03_asti15b').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/ast/asti03/lookup_catcomplete_asti15b/'+encodeURIComponent(smb001), 
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
				$('#asti03_asti15b').val(ui.item.value1);
				$('#asti03_asti15bdisp').text(ui.item.value2);
				//console.log($('#asti03').val(ui.item.value1));
				return false;
			}else{
				$('#asti03_asti15b').val("");
				$('#asti03_asti15bdisp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addasti03_asti15bdisp(smb001,smb002){
	$('#asti03_asti15b').val(smb001);
	$('#asti03_asti15bdisp').text(smb002);
	$('#asti03_asti15b').focus();
	//check_asti03(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti03/clear_sql_asti15b"
	}); 
}
function clear_asti03_asti15bdisp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti03/clear_sql_asti15b"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_asti03_asti15b(row_obj){
	var smb001= $('#asti03_asti15b').val();
	if(!smb001){$('#asti03_asti15bdisp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti03/lookup_check_asti15b/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#asti03_asti15b').val("");
					$('#asti03_asti15bdisp').text("查無資料");
				}else{
					$('#asti03_asti15b').val(smb001);
					$('#asti03_asti15bdisp').text(data.message[0].value2);
				}
			}else{
				$('#asti03_asti15b').val("");
				$('#asti03_asti15bdisp').text("查無資料");
			}
		}
	});
}
   
</script>	   
<div id="divFasti03_asti15b" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/ast/asti03/display_child_asti15b" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>
