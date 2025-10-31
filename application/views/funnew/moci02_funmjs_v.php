<script type="text/javascript"> 	
//查詢製令性質開視窗moci02 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showmoci02disp").click(function() {
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
		message: $('#divFmoci02'),
		onOverlayClick: clear_moci02disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#moci02').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#moci02').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/moc/moci02/lookup_catcomplete/'+encodeURIComponent(smb001), 
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
				$('#moci02').val(ui.item.value1);
				$('#moci02disp').text(ui.item.value2);
			//	$('#mf004').val(ui.item.value2);
				$('#mf006').val(ui.item.value3);
				$('#mf007').val(ui.item.value4);
				$('#mf008').text(ui.item.value5);
				//console.log($('#moci02').val(ui.item.value1));
				return false;
			}else{
				$('#moci02disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addmoci02disp(sta002,sta006,sta034,sta035,sta007){
	//console.log('test1');
	//alert('test2');
	$('#moci02').val(sta006);
	$('#mf006').val(sta034);
	$('#mf007').val(sta035);  //sfci05
	$('#mf008').val(sta007);  //sfci05
	$('#mf009').val(sta002);  //sfci05
	$('#mf004').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci02/clear_sql"
	}); 
}
function addmoci02disptest(smb001,smb002){
	$('#moci02').val(smb001);
	$('#moci02disp').text(smb002);
	$('#moci02').focus();
	//check_moci02(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci02/clear_sql"
	}); 
}
function clear_moci02disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci02/clear_sql"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_moci02(row_obj){
	var smb001= $('#moci02').val();
	console.log('test1');
	console.log(smb001);
	//if(!smb001){$('#moci02disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/moc/moci02/lookup_check/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {ta006:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				console.log('test-ok');
				$('#moci02').val(smb001);
				if(data.message[0].value=="查無資料"){
					$('#moci02').val("查無資料");
					//$('#moci02').val("");
					//$('#moci02disp').text("查無資料");
				}
				console.log(data.message[0].value);
				console.log(data.message[0].value3);
				smb006=data.message[0].value3;
				smb007=data.message[0].value4;
				smb008=data.message[0].value5;
				smb009=data.message[0].value1;
				//$('#moci02').val(smb001);
				$('#moci02disp').text(data.message[0].value2);
				$('#mf006').val(smb006);
				$('#mf007').val(smb007);
				$('#mf008').val(smb008);
				$('#mf009').val(smb009);
			}else{
				$('#moci02').val("查無資料");
				//$('#moci02').val(smb001);
				$('#moci02disp').text("查無資料");
			}
		}
	});
}
   
</script>	   
<div id="divFmoci02" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/moc/moci02/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script>
$(document).ready(function(){
	$("#Showmoci02disp1").click(function() {
		//var moci02=$("#moci02").val();
		//var moci02 =moci02.replace(/(^\s*)|(\s*$)/g, "");
		  var moci02='510';
	$('#hpa_ifmain').attr('src',"<?php echo base_url()?>index.php/moc/moci02/display_child1/"+moci02 );
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
		message: $('#divFmoci021'),
		onOverlayClick: clear_moci02disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#moci02').catcomplete({
        autoFocus: true,
		delay: 100,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#mf009').val();
			//var moci02=$("#moci02").val();
		   var smb001 =smb001.replace(/(^\s*)|(\s*$)/g, "");
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/moc/moci02/lookup_catcomplete/'+encodeURIComponent(smb001), 
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
				$('#moci02').val(ui.item.value1);
				$('#moci02disp').text(ui.item.value2);
			//	$('#mf004').val(ui.item.value2);
				$('#mf006').val(ui.item.value3);
				$('#mf007').val(ui.item.value4);
				$('#mf008').text(ui.item.value5);
				//console.log($('#moci02').val(ui.item.value1));
				return false;
			}else{
				$('#moci02disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
</script>	   
<div id="divFmoci021" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div>
<iframe  allowTransparency="flase" id="hpa_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>  
<!--<iframe src="<?php echo base_url()?>index.php/moc/moci02/display_child1" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>--> 	   
</div>

<script type="text/javascript"> 	
//查詢製令性質開視窗moci02 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showmoci02_moci04disp").click(function() {
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
		message: $('#divFmoci02_moci04'),
		onOverlayClick: clear_moci02_moci04disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#moci02_moci04').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#moci02_moci04').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/moc/moci02/lookup_catcomplete_moci04/'+encodeURIComponent(smb001), 
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
				$('#moci02_moci04').val(ui.item.value1);
				$('#moci02_moci04disp').text(ui.item.value2);
				//console.log($('#moci02_moci04').val(ui.item.value1));
				return false;
			}else{
				$('#moci02_moci04disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addmoci02_moci04disp(smb001,smb002){
	$('#moci02_moci04').val(smb001);
	$('#moci02_moci04disp').text(smb002);
	$('#moci02_moci04').focus();
	//check_moci02_moci04(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci02/clear_sql_moci04"
	}); 
}
function clear_moci02_moci04disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci02/clear_sql_moci04"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_moci02_moci04(row_obj){
	var smb001= $('#moci02_moci04').val();
	if(!smb001){$('#moci02_moci04disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/moc/moci02/lookup_check_moci04/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#moci02_moci04').val("");
					$('#moci02_moci04disp').text("查無資料");
				}
				$('#moci02_moci04').val(smb001);
				$('#moci02_moci04disp').text(data.message[0].value2);
			}else{
				$('#moci02_moci04').val(smb001);
				$('#moci02_moci04disp').text("查無資料");
			}
		}
	});
}
   
</script>	   
<div id="divFmoci02_moci04" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/moc/moci02/display_child_moci04" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script type="text/javascript"> 	
//查詢製令性質開視窗moci02 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showmoci02_moci05disp").click(function() {
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
		message: $('#divFmoci02_moci05'),
		onOverlayClick: clear_moci02_moci05disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#moci02_moci05').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#moci02_moci05').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/moc/moci02/lookup_catcomplete_moci05/'+encodeURIComponent(smb001), 
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
				$('#moci02_moci05').val(ui.item.value1);
				$('#moci02_moci05disp').text(ui.item.value2);
				//console.log($('#moci02_moci05').val(ui.item.value1));
				return false;
			}else{
				$('#moci02_moci05disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addmoci02_moci05disp(smb001,smb002){
	$('#moci02_moci05').val(smb001);
	$('#moci02_moci05disp').text(smb002);
	$('#moci02_moci05').focus();
	//check_moci02_moci05(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci02/clear_sql_moci05"
	}); 
}
function clear_moci02_moci05disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci02/clear_sql_moci05"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_moci02_moci05(row_obj){
	var smb001= $('#moci02_moci05').val();
	if(!smb001){$('#moci02_moci05disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/moc/moci02/lookup_check_moci05/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#moci02_moci05').val("");
					$('#moci02_moci05disp').text("查無資料");
				}
				$('#moci02_moci05').val(smb001);
				$('#moci02_moci05disp').text(data.message[0].value2);
			}else{
				$('#moci02_moci05').val(smb001);
				$('#moci02_moci05disp').text("查無資料");
			}
		}
	});
}
   
</script>	   
<div id="divFmoci02_moci05" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/moc/moci02/display_child_moci05" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>


