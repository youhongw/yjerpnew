<script type="text/javascript"> 	
//以下為單頭function 資產編號1
$(document).ready(function(){
	$("#Showasti02disp").click(function() {
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
		message: $('#divFasti02'),
		onOverlayClick: clear_asti02disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#asti02').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#asti02').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/ast/asti02/lookup_catcomplete/'+encodeURIComponent(smb001), 
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
				$('#asti02').val(ui.item.value1);
				$('#asti02disp').text(ui.item.value2);
				$('#asti02disp').val(ui.item.value2);
				$('#asti02disp2').val(ui.item.value3);
				$('#asti02disp3').val(ui.item.value11);
				
				$('#asti02temp12').val(ui.item.value12);
				$('#asti02temp20').val(ui.item.value20);
				$('#asti02temp21').val(ui.item.value21);
				$('#asti02temp29').val(ui.item.value29);
				
				
				if(change_asti08_tc005()){
						change_asti08_tc005();
				}
				//console.log($('#asti02').val(ui.item.value1));
				return false;
			}else{
				$('#asti02').val(ui.item.value1);
				$('#asti02disp2').val(ui.item.value3);
				$('#asti02disp').text("查無資料");
				
				$('#asti02temp12').val("0");
				$('#asti02temp20').val("0");
				$('#asti02temp21').val("0");
				$('#asti02temp29').val("0");
				
				if(change_asti08_tc005()){
						change_asti08_tc005();
				}
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addasti02disp(smb001,smb002,smb003,smb011,smb012,smb020,smb021,smb029){
	$('#asti02').val(smb001);
	$('#asti02disp').text(smb002);
	$('#asti02disp').val(smb002);
	$('#asti02disp2').val(smb003);
	$('#asti02disp3').val(smb011);
	
	$('#asti02temp12').val(smb012);
	$('#asti02temp20').val(smb020);
	$('#asti02temp21').val(smb021);
	$('#asti02temp29').val(smb029);
	
	$('#asti02').focus();
	//check_asti02(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti02/clear_sql"
	}); 
}
function clear_asti02disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti02/clear_sql"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_asti02(row_obj){
	var smb001= $('#asti02').val();
	if(!smb001){$('#asti02disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti02/lookup_check/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#asti02').val("");
					$('#asti02disp2').val("");
					$('#asti02disp').text("查無資料");
					
					$('#asti02temp12').val("0");
					$('#asti02temp20').val("0");
					$('#asti02temp21').val("0");
					$('#asti02temp29').val("0");
				}else{
					$('#asti02').val(smb001);
					$('#asti02disp2').val(data.message[0].value3);
					$('#asti02disp').text(data.message[0].value2);
					$('#asti02disp').val(data.message[0].value2);
					$('#asti02disp3').val(data.message[0].value11);
					
					$('#asti02temp12').val(data.message[0].value12);
					$('#asti02temp20').val(data.message[0].value20);
					$('#asti02temp21').val(data.message[0].value21);
					$('#asti02temp29').val(data.message[0].value29);
					
					if(typeof change_asti08_tc005 === "function"){
						change_asti08_tc005();
					}else if(typeof change_asti09_tc005 === "function"){
						change_asti09_tc005();
					}
				}
			}else{
				$('#asti02').val("");
				$('#asti02disp2').val("");
				
				$('#asti02temp12').val("0");
				$('#asti02temp20').val("0");
				$('#asti02temp21').val("0");
				$('#asti02temp29').val("0");
				$('#asti02disp').text("查無資料");
				
				if(change_asti08_tc005()){
						change_asti08_tc005();
				}
			}
		}
	});
}
   
</script>	   
<div id="divFasti02" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/ast/asti02/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script type="text/javascript"> 
//以下為單頭function 資產編號2
$(document).ready(function(){
	$("#Showasti02adisp").click(function() {
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
		message: $('#divFasti02a'),
		onOverlayClick: clear_asti02disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#asti02a').catcomplete({    //下拉視窗
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#asti02').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/ast/asti02/lookupa_catcomplete/'+encodeURIComponent(smb001), 
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
				$('#asti02a').val(ui.item.value1);
				$('#asti02adisp').text(ui.item.value2);
				$('#asti02adisp').val(ui.item.value2);
				$('#asti02adisp2').val(ui.item.value3);
				$('#asti02adisp3').val(ui.item.value11);
				
				$('#asti02temp12').val(ui.item.value12);
				$('#asti02temp20').val(ui.item.value20);
				$('#asti02temp21').val(ui.item.value21);
				$('#asti02temp29').val(ui.item.value29);
				
				
				if(change_asti08_tc005()){
						change_asti08_tc005();
				}
				//console.log($('#asti02').val(ui.item.value1));
				return false;
			}else{
				$('#asti02a').val(ui.item.value1);
				$('#asti02adisp2').val(ui.item.value3);
				$('#asti02adisp').text("查無資料");
				
				$('#asti02temp12').val("0");
				$('#asti02temp20').val("0");
				$('#asti02temp21').val("0");
				$('#asti02temp29').val("0");
				
				if(change_asti08_tc005()){
						change_asti08_tc005();
				}
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addasti02adisp(smb001,smb002,smb003,smb011,smb012,smb020,smb021,smb029){
	$('#asti02a').val(smb001);
	$('#asti02adisp').text(smb002);
	$('#asti02adisp').val(smb002);
	$('#asti02adisp2').val(smb003);
	$('#asti02adisp3').val(smb011);
	
	$('#asti02temp12').val(smb012);
	$('#asti02temp20').val(smb020);
	$('#asti02temp21').val(smb021);
	$('#asti02temp29').val(smb029);
	
	$('#asti02a').focus();
	//check_asti02(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti02/clear_sql"
	}); 
}
function clear_asti02disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti02/clear_sql"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_asti02a(row_obj){
	var smb001= $('#asti02a').val();
	if(!smb001){$('#asti02adisp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti02/lookupa_check/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#asti02a').val("");
					$('#asti02adisp2').val("");
					$('#asti02adisp').text("查無資料");
					
					$('#asti02temp12').val("0");
					$('#asti02temp20').val("0");
					$('#asti02temp21').val("0");
					$('#asti02temp29').val("0");
				}else{
					$('#asti02a').val(smb001);
					$('#asti02adisp2').val(data.message[0].value3);
					$('#asti02adisp').text(data.message[0].value2);
					$('#asti02adisp').val(data.message[0].value2);
					$('#asti02adisp3').val(data.message[0].value11);
					
					$('#asti02temp12').val(data.message[0].value12);
					$('#asti02temp20').val(data.message[0].value20);
					$('#asti02temp21').val(data.message[0].value21);
					$('#asti02temp29').val(data.message[0].value29);
					
					if(typeof change_asti08_tc005 === "function"){
						change_asti08_tc005();
					}else if(typeof change_asti09_tc005 === "function"){
						change_asti09_tc005();
					}
				}
			}else{
				$('#asti02a').val("");
				$('#asti02adisp2').val("");
				
				$('#asti02temp12').val("0");
				$('#asti02temp20').val("0");
				$('#asti02temp21').val("0");
				$('#asti02temp29').val("0");
				$('#asti02disp').text("查無資料");
				
				if(change_asti08_tc005()){
						change_asti08_tc005();
				}
			}
		}
	});
}
   
</script>	   
<div id="divFasti02a" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/ast/asti02/display_child1" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script>
function set_catcomplete(row){
    $('#order_product\\['+row+'\\]\\[asti02\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#order_product\\['+row+'\\]\\[asti02\\]').val();
			$('#order_product\\['+row+'\\]\\[asti02\\]').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/ast/asti02/lookup_body_catcomplete/'+encodeURIComponent(smb001), 
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
			clear_row(row);
			console.log(ui.item.value);
			if(ui.item.value!="查無資料"){
				$('#order_product\\['+row+'\\]\\[asti02\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[asti02_mb002\\]').val(ui.item.value2);
				$('#order_product\\['+row+'\\]\\[asti02_mb003\\]').val(ui.item.value3);
				$('#order_product\\['+row+'\\]\\[asti02_mb012\\]').val(ui.item.value12);
				$('#order_product\\['+row+'\\]\\[asti02_mb011\\]').val(ui.item.value11);
				$('#order_product\\['+row+'\\]\\[asti02_mb016\\]').val(ui.item.value16);
				$('#order_product\\['+row+'\\]\\[asti02_mb020\\]').val(ui.item.value20);
			}
			return false;
		},
		
		change: function(event, ui) {
			$('#order_product\\['+row+'\\]\\[asti02\\]').attr('onchange','check_asti02_body(this)');
			check_asti02_body(row);  //1060713 新增
			//check_invi02d($('#order_product\\['+row+'\\]\\[td004\\]').val());
			return false;
		},
		focus: function(event, ui) {
			return false;
		}
	});
	
}
function set_catcomplete2(row){
$('#order_product\\['+row+'\\]\\[asti02_asti08\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#order_product\\['+row+'\\]\\[asti02_asti08\\]').val();
			var smb002= $('#asti02').val();
			$('#order_product\\['+row+'\\]\\[asti02_asti08\\]').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/ast/asti02/lookup_body_catcomplete_asti08/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(smb002), 
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
			clear_row(row);
			console.log(ui.item.value);
			if(ui.item.value!="查無資料"){
				$('#order_product\\['+row+'\\]\\[asti02_asti08\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[asti02_asti08_mc002disp\\]').val(ui.item.value2);
				$('#order_product\\['+row+'\\]\\[asti02_asti08_mc003\\]').val(ui.item.value3);
				$('#order_product\\['+row+'\\]\\[asti02_asti08_mc003disp\\]').val(ui.item.value4);
			}
			return false;
		},
		
		change: function(event, ui) {
			$('#order_product\\['+row+'\\]\\[asti02_asti08\\]').attr('onchange',''); //因為呼叫astmc為單身 複數選項不檢查check
			//check_asti02_asti08_body(row);  //因為呼叫astmc為單身 複數選項不檢查check
			//check_invi02d($('#order_product\\['+row+'\\]\\[td004\\]').val());
			return false;
		},
		focus: function(event, ui) {
			return false;
		}
	});
}
</script>


<script>
//以下為單身function
//查詢資產編號視窗  (應收票據)
function search_asti02_body_window(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	console.log(row);
	selected_row = row;

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
		message: $('#divFasti02_body'),
		onOverlayClick: clear_asti02_body_sql
	});
	  $('.close').click($.unblockUI);
}
function addasti02_body(mb001, mb002, mb003, mb012, mb011, mb016, mb020){
	clear_row(selected_row);
	
	var date_mb016 = mb016.substr(0,4) + '/' + mb016.substr(4,2) + '/' +mb016.substr(6,2);
	console.log(mb002);
	$('#order_product\\['+selected_row+'\\]\\[asti02\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[asti02_mb002\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[asti02_mb003\\]').val(mb003);
	$('#order_product\\['+selected_row+'\\]\\[asti02_mb012\\]').val(mb012);
	$('#order_product\\['+selected_row+'\\]\\[asti02_mb011\\]').val(mb011);
	$('#order_product\\['+selected_row+'\\]\\[asti02_mb016\\]').val(date_mb016);
	$('#order_product\\['+selected_row+'\\]\\[asti02_mb020\\]').val(mb020);
	$('#order_product\\['+selected_row+'\\]\\[asti02\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti02/clear_body_sql"
	});
}
function clear_asti02_body_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti02/clear_body_sql"
	});
}
//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
function check_asti02_body(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[asti02\\]').val();
	
	if(!smb001){
		$('#order_product\\['+row+'\\]\\[asti02\\]').val('');
		$('#order_product\\['+row+'\\]\\[asti02_mb002\\]').val('');
		$('#order_product\\['+row+'\\]\\[asti02_mb003\\]').val('');
		$('#order_product\\['+row+'\\]\\[asti02_mb012\\]').val('');
		$('#order_product\\['+row+'\\]\\[asti02_mb011\\]').val('');
		$('#order_product\\['+row+'\\]\\[asti02_mb016\\]').val('');
		$('#order_product\\['+row+'\\]\\[asti02_mb020\\]').val('');
		clear_row(row);return;
		}
	
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti02/lookup_body_check/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[asti02\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[asti02_mb002\\]').val(data.message[0].value2);
				$('#order_product\\['+row+'\\]\\[asti02_mb003\\]').val(data.message[0].value3);
				$('#order_product\\['+row+'\\]\\[asti02_mb012\\]').val(data.message[0].value12);
				$('#order_product\\['+row+'\\]\\[asti02_mb011\\]').val(data.message[0].value11);
				$('#order_product\\['+row+'\\]\\[asti02_mb016\\]').val(data.message[0].value16);
				$('#order_product\\['+row+'\\]\\[asti02_mb020\\]').val(data.message[0].value20);
				$('#order_product\\['+row+'\\]\\[asti02\\]').focus();
			}else{
				$('#order_product\\['+row+'\\]\\[asti02\\]').val("查無資料");
				$('#order_product\\['+row+'\\]\\[asti02\\]').focus();
			}
		}
	});
}
</script>
<div id="divFasti02_body" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/ast/asti02/display_child_body" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>


<script>
//以下為單身function (asti08使用:部門會因資產影響)
//查詢因資產影響的部門代號視窗
function search_asti02_asti08_body_window(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	console.log(row);
	selected_row = row;
	
	
	//order_product[1][cmsi05]
	
	var temp = $('#asti02').val();
	
	if(!temp){
		temp = "null";
	}
		
	$("#iframe_asti02_asti08").attr('src','<?php echo base_url()?>index.php/ast/asti02/display_child_body_asti08/'+temp);

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
		message: $('#divFasti02_asti08_body'),
		onOverlayClick: clear_asti02_asti08_body_sql
	});
	  $('.close').click($.unblockUI);
}
function addasti02_asti08_body(mc002, mc002disp, mc003, mc003disp){
	clear_row(selected_row);
	
	$('#order_product\\['+selected_row+'\\]\\[asti02_asti08\\]').val(mc002);
	$('#order_product\\['+selected_row+'\\]\\[asti02_asti08_mc002disp\\]').val(mc002disp);
	$('#order_product\\['+selected_row+'\\]\\[asti02_asti08_mc003\\]').val(mc003);
	$('#order_product\\['+selected_row+'\\]\\[asti02_asti08_mc003disp\\]').val(mc003disp);
	
	$('#order_product\\['+selected_row+'\\]\\[asti02_asti08\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti02/clear_body_sql_asti08"
	});
}
function clear_asti02_asti08_body_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti02/clear_body_sql_asti08"
	});
}
//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
function check_asti02_asti08_body(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[asti02_asti08\\]').val();
	var smb002 = $('#asti02').val();
	
	if(!smb001){
		$('#order_product\\['+row+'\\]\\[asti02_asti08\\]').val('');
		$('#order_product\\['+row+'\\]\\[asti02_asti08_mc002\\]').val('');
		clear_row(row);return;
		}
	
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti02/lookup_body_check_asti08/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(smb002), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {me001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[asti02_asti08\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[asti02_asti08_mc002\\]').val(data.message[0].value2);

				$('#order_product\\['+row+'\\]\\[asti02_asti08\\]').focus();
			}else{
				$('#order_product\\['+row+'\\]\\[asti02_asti08\\]').val("查無資料");
				$('#order_product\\['+row+'\\]\\[asti02_asti08\\]').focus();
			}
		}
	});
}
</script>
<div id="divFasti02_asti08_body" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe id="iframe_asti02_asti08" src="" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script>
//以下為單身function (asti09使用:部門會因資產影響)
//查詢因資產影響的部門代號視窗
function search_asti02_asti09_body_window(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	console.log(row);
	selected_row = row;
	
	
	//order_product[1][cmsi05]
	
	var temp = $('#asti02').val();
	
	if(!temp){
		temp = "null";
	}
		
	$("#iframe_asti02_asti09").attr('src','<?php echo base_url()?>index.php/ast/asti02/display_child_body_asti09/'+temp);

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
		message: $('#divFasti02_asti09_body'),
		onOverlayClick: clear_asti02_asti09_body_sql
	});
	  $('.close').click($.unblockUI);
}
function addasti02_asti09_body(mc002, mc002disp, mc003, mc003disp){
	clear_row(selected_row);
	
	$('#order_product\\['+selected_row+'\\]\\[asti02_asti09\\]').val(mc002);
	$('#order_product\\['+selected_row+'\\]\\[asti02_asti09_mc002disp\\]').val(mc002disp);
	$('#order_product\\['+selected_row+'\\]\\[asti02_asti09_mc003\\]').val(mc003);
	$('#order_product\\['+selected_row+'\\]\\[asti02_asti09_mc003disp\\]').val(mc003disp);
	
	$('#order_product\\['+selected_row+'\\]\\[asti02_asti09\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti02/clear_body_sql_asti09"
	});
}
function clear_asti02_asti09_body_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti02/clear_body_sql_asti09"
	});
}
//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
function check_asti02_asti09_body(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[asti02_asti09\\]').val();
	var smb002 = $('#asti02').val();
	
	if(!smb001){
		$('#order_product\\['+row+'\\]\\[asti02_asti09\\]').val('');
		$('#order_product\\['+row+'\\]\\[asti02_asti09_mc002\\]').val('');
		clear_row(row);return;
		}
	
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti02/lookup_body_check_asti09/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(smb002), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {me001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[asti02_asti09\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[asti02_asti09_mc002\\]').val(data.message[0].value2);

				$('#order_product\\['+row+'\\]\\[asti02_asti09\\]').focus();
			}else{
				$('#order_product\\['+row+'\\]\\[asti02_asti09\\]').val("查無資料");
				$('#order_product\\['+row+'\\]\\[asti02_asti09\\]').focus();
			}
		}
	});
}
</script>
<div id="divFasti02_asti09_body" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe id="iframe_asti02_asti09" src="" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script>
//以下為單身function (asti10使用:部門會因資產影響)
//查詢因資產影響的部門代號視窗
function search_asti02_asti10_body_window(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	console.log(row);
	selected_row = row;
	
	
	//order_product[1][cmsi05]
	
	var temp = $('#asti02').val();
	
	if(!temp){
		temp = "null";
	}
		
	$("#iframe_asti02_asti10").attr('src','<?php echo base_url()?>index.php/ast/asti02/display_child_body_asti10/'+temp);

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
		message: $('#divFasti02_asti10_body'),
		onOverlayClick: clear_asti02_asti10_body_sql
	});
	  $('.close').click($.unblockUI);
}
function addasti02_asti10_body(mc002, mc002disp, mc003, mc003disp){
	clear_row(selected_row);
	
	$('#order_product\\['+selected_row+'\\]\\[asti02_asti10\\]').val(mc002);
	$('#order_product\\['+selected_row+'\\]\\[asti02_asti10_mc002disp\\]').val(mc002disp);
	$('#order_product\\['+selected_row+'\\]\\[asti02_asti10_mc003\\]').val(mc003);
	$('#order_product\\['+selected_row+'\\]\\[asti02_asti10_mc003disp\\]').val(mc003disp);
	
	$('#order_product\\['+selected_row+'\\]\\[asti02_asti10\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti02/clear_body_sql_asti10"
	});
}
function clear_asti02_asti10_body_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti02/clear_body_sql_asti10"
	});
}
//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
function check_asti02_asti10_body(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[asti02_asti10\\]').val();
	var smb002 = $('#asti02').val();
	
	if(!smb001){
		$('#order_product\\['+row+'\\]\\[asti02_asti10\\]').val('');
		$('#order_product\\['+row+'\\]\\[asti02_asti10_mc002\\]').val('');
		clear_row(row);return;
		}
	
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti02/lookup_body_check_asti10/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(smb002), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {me001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[asti02_asti10\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[asti02_asti10_mc002\\]').val(data.message[0].value2);

				$('#order_product\\['+row+'\\]\\[asti02_asti10\\]').focus();
			}else{
				$('#order_product\\['+row+'\\]\\[asti02_asti10\\]').val("查無資料");
				$('#order_product\\['+row+'\\]\\[asti02_asti10\\]').focus();
			}
		}
	});
}
</script>
<div id="divFasti02_asti10_body" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe id="iframe_asti02_asti10" src="" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>


<script>
//以下為單身function (asti08使用:部門會因資產影響)
//查詢因資產影響的部門代號視窗 asti12
function search_asti02_asti12_body_window(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	console.log(row);
	selected_row = row;
	
	var temp = $('#order_product\\['+row+'\\]\\[asti02\\]').val();
	
	if(!temp){
		temp = "null";
	}
		
	$("#iframe_asti02_asti12").attr('src','<?php echo base_url()?>index.php/ast/asti02/display_child_body_asti12/'+temp);

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
		message: $('#divFasti02_asti12_body'),
		onOverlayClick: clear_asti02_asti12_body_sql
	});
	  $('.close').click($.unblockUI);
}
function addasti02_asti12_body(mc002, mc002disp, mc003, mc003disp, mc004){
  	console.log(selected_row);
	console.log(mc002disp);
	clear_row(selected_row);
	
	console.log('test');
	console.log($('#order_product\\['+selected_row+'\\]\\[asti02_asti12_mc003disp\\]').val(mc003disp));
	
	$('#order_product\\['+selected_row+'\\]\\[asti02_asti12\\]').val(mc002);
	$('#order_product\\['+selected_row+'\\]\\[asti02_asti12_mc002disp\\]').val(mc002disp);
	$('#order_product\\['+selected_row+'\\]\\[asti02_asti12_mc003\\]').val(mc003);
	$('#order_product\\['+selected_row+'\\]\\[asti02_asti12_mc003disp\\]').val(mc003disp);
	$('#order_product\\['+selected_row+'\\]\\[tg006\\]').val(mc004);
	
	
	$('#order_product\\['+selected_row+'\\]\\[asti02_asti12\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti02/clear_body_sql_asti12"
	});
}
function clear_asti02_asti12_body_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti02/clear_body_sql_asti12"
	});
}
//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
function check_asti02_asti12_body(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[asti02_asti12\\]').val();
	var smb002 = $('#order_product\\['+row+'\\]\\[asti02\\]').val();

	if(!smb001){
		$('#order_product\\['+row+'\\]\\[asti02_asti12\\]').val('');
		$('#order_product\\['+row+'\\]\\[asti02_asti12_mc002disp\\]').val('');
		$('#order_product\\['+row+'\\]\\[asti02_asti12_mc003\\]').val('');
		$('#order_product\\['+row+'\\]\\[asti02_asti12_mc003disp\\]').val('');
		$('#order_product\\['+row+'\\]\\[tg006\\]').val('');
		clear_row(row);return;
		}
	
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti02/lookup_body_check_asti12/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(smb002), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {me001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[asti02_asti12\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[asti02_asti12_mc002disp\\]').val(data.message[0].value2);
				$('#order_product\\['+row+'\\]\\[asti02_asti12_mc003\\]').val(data.message[0].value3);
				$('#order_product\\['+row+'\\]\\[asti02_asti12_mc003disp\\]').val(data.message[0].value4);
				$('#order_product\\['+row+'\\]\\[tg006\\]').val(data.message[0].value5);
				$('#order_product\\['+row+'\\]\\[asti02_asti12\\]').focus();
			}else{
				$('#order_product\\['+row+'\\]\\[asti02_asti12\\]').val("查無資料");
				$('#order_product\\['+row+'\\]\\[asti02_asti12\\]').focus();
			}
		}
	});
}
</script>
<div id="divFasti02_asti12_body" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe id="iframe_asti02_asti12" src="" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script>
//以下為單身function (asti08使用:部門會因資產影響)
//查詢因資產影響的部門代號視窗
function search_asti02_asti14_body_window(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	console.log(row);
	selected_row = row;

	var temp = $('#order_product\\['+row+'\\]\\[th003\\]').val();
	var temp2 = $('#order_product\\['+row+'\\]\\[th004\\]').val();
	
	if(!temp){
		temp = "null";
	}
	if(!temp2){
		temp2 = "null";
	}
	
	
	$("#iframe_asti02_asti14").attr('src','<?php echo base_url()?>index.php/ast/asti02/display_child_body_asti14/'+temp+'/'+temp2);

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
		message: $('#divFasti02_asti14_body'),
		onOverlayClick: clear_asti02_asti14_body_sql
	});
	  $('.close').click($.unblockUI);
}
function addasti02_asti14_body(tg003, mb002, mb003, tg004, me002, tg005, mv002, tg006, tg008){
	clear_row(selected_row);
	
	$('#order_product\\['+selected_row+'\\]\\[th005\\]').val(tg003);
	$('#order_product\\['+selected_row+'\\]\\[th005_mb002\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[th005_mb003\\]').val(mb003);
	$('#order_product\\['+selected_row+'\\]\\[th006\\]').val(tg004);
	$('#order_product\\['+selected_row+'\\]\\[th006disp\\]').val(me002);
	$('#order_product\\['+selected_row+'\\]\\[th007\\]').val(tg005);
	$('#order_product\\['+selected_row+'\\]\\[th007_mv002\\]').val(mv002);
	$('#order_product\\['+selected_row+'\\]\\[th008\\]').val(tg006);
	$('#order_product\\['+selected_row+'\\]\\[th009\\]').val(tg008);
	
	
	$('#order_product\\['+selected_row+'\\]\\[th005\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti02/clear_body_sql_asti14"
	});
}
function clear_asti02_asti14_body_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti02/clear_body_sql_asti14"
	});
}
//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
function check_asti02_asti14_body(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[th005\\]').val();
	
	console.log(smb001);
	if(!smb001){
		$('#order_product\\['+row+'\\]\\[th005\\]').val('');
		$('#order_product\\['+row+'\\]\\[th005_mb002\\]').val('');
		$('#order_product\\['+row+'\\]\\[th005_mb003\\]').val('');
		$('#order_product\\['+row+'\\]\\[th006\\]').val('');
		$('#order_product\\['+row+'\\]\\[th006disp\\]').val('');
		$('#order_product\\['+row+'\\]\\[th007\\]').val('');
		$('#order_product\\['+row+'\\]\\[th007_mv002\\]').val('');
		$('#order_product\\['+row+'\\]\\[th008\\]').val('');
		$('#order_product\\['+row+'\\]\\[th009\\]').val('');
		clear_row(row);return;
		}
	
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti02/lookup_body_check_asti14/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {me001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[th005\\]').val('tg003');
				$('#order_product\\['+row+'\\]\\[th005_mb002\\]').val('');
				$('#order_product\\['+row+'\\]\\[th005_mb003\\]').val('');
				$('#order_product\\['+row+'\\]\\[th006\\]').val('');
				$('#order_product\\['+row+'\\]\\[th006disp\\]').val('');
				$('#order_product\\['+row+'\\]\\[th007\\]').val('');
				$('#order_product\\['+row+'\\]\\[th007_mv002\\]').val('');
				$('#order_product\\['+row+'\\]\\[th008\\]').val('');
				$('#order_product\\['+row+'\\]\\[th009\\]').val('');
				$('#order_product\\['+row+'\\]\\[th005\\]').focus();
			}else{
				$('#order_product\\['+row+'\\]\\[th005\\]').val("查無資料");
				$('#order_product\\['+row+'\\]\\[th005\\]').focus();
			}
		}
	});
}
</script>
<div id="divFasti02_asti14_body" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe id="iframe_asti02_asti14" src="" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>