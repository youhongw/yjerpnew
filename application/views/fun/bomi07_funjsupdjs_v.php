<!-- 不更新網頁 自動提示方框資料前置小工具 --> 
 <script type="text/javascript"><!--
	   
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
//--></script>
	<!-- javascrit 明細0 -->	  	
	<script type="text/javascript"><!--
	  var product_row = "1", vrow = 0, vtj0='0';
	  
	   $('input[name=\'order_product[0][mf004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#mf0040').val();
			
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi07/lookup/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,  
                success:      
                   function(data){  
                      if(data.response =="true"){
						   add(data.message);	  
                        }
                        							
                    }, 
                      				
                 });  
              },  
            select:   
               function(event, ui) { 
			     var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
                 $('input[name=\'order_product[' + n + '][mf004]\']').val(ui.item.value1);
                 $('input[name=\'order_product[' + n + '][mf004disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][mf008]\']').val(ui.item.value3);
				 $('input[name=\'order_product[' + n + '][mf005]\']').val(ui.item.value4);
				 $('input[name=\'order_product[' + n + '][mf006]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][mf007]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
		
	 //      n 將輸入值為非數位的字元替換為空 輸入不分含稅未稅
	$('input[name=\'order_product['+ vrow + '][mf019]\'],input[name=\'order_product[' + vrow + '][mf009]\']').focusout(function() { 
		//var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 		
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][mf003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][mf003]\']').val(num_2); 
		
	}); 
	//數量游標停在 0 之後 
	$('input[name=\'order_product[' + vrow + '][mf010]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		//	$(this).val('');
	});
	
	$('input[name=\'order_product[' + vrow + '][mf023]\']').blur(function(){
		$('input[name=\'order_product[' + vrow + '][mf004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
 
	<!-- javascrit 明細1 -->	  	 
     <script type="text/javascript"><!--
         var product_row = "2", vrow = 1, vtj0='1';	 
       $('input[name=\'order_product[1][mf004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#mf0041').val();
			
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi07/lookup/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,  
                success:      
                   function(data){  
                      if(data.response =="true"){
						   add(data.message);	  
                        }
                        							
                    }, 
                      				
                 });  
              },  
            select:   
               function(event, ui) { 
			     var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
                 $('input[name=\'order_product[' + n + '][mf004]\']').val(ui.item.value1);
                 $('input[name=\'order_product[' + n + '][mf004disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][mf008]\']').val(ui.item.value3);
				 $('input[name=\'order_product[' + n + '][mf005]\']').val(ui.item.value4);
				 $('input[name=\'order_product[' + n + '][mf006]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][mf007]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
		
	 //      n 將輸入值為非數位的字元替換為空 輸入不分含稅未稅
	$('input[name=\'order_product['+ vrow + '][mf019]\'],input[name=\'order_product[' + vrow + '][mf009]\']').focusout(function() { 
		//var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 		
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][mf003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][mf003]\']').val(num_2); 
		
	}); 
	//數量游標停在 0 之後 
	$('input[name=\'order_product[' + vrow + '][mf010]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		//	$(this).val('');
	});
	
	$('input[name=\'order_product[' + vrow + '][mf023]\']').blur(function(){
		$('input[name=\'order_product[' + vrow + '][mf004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "3", vrow = 2, vtj0='2';	 
       $('input[name=\'order_product[2][mf004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#mf0042').val();
			
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi07/lookup/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,  
                success:      
                   function(data){  
                      if(data.response =="true"){
						   add(data.message);	  
                        }
                        							
                    }, 
                      				
                 });  
              },  
            select:   
               function(event, ui) { 
			     var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
                 $('input[name=\'order_product[' + n + '][mf004]\']').val(ui.item.value1);
                 $('input[name=\'order_product[' + n + '][mf004disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][mf008]\']').val(ui.item.value3);
				 $('input[name=\'order_product[' + n + '][mf005]\']').val(ui.item.value4);
				 $('input[name=\'order_product[' + n + '][mf006]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][mf007]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
		
	 //      n 將輸入值為非數位的字元替換為空 輸入不分含稅未稅
	$('input[name=\'order_product['+ vrow + '][mf019]\'],input[name=\'order_product[' + vrow + '][mf009]\']').focusout(function() { 
		//var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 		
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][mf003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][mf003]\']').val(num_2); 
		
	}); 
	//數量游標停在 0 之後 
	$('input[name=\'order_product[' + vrow + '][mf010]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		//	$(this).val('');
	});
	
	$('input[name=\'order_product[' + vrow + '][mf023]\']').blur(function(){
		$('input[name=\'order_product[' + vrow + '][mf004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
 

     <script type="text/javascript"><!--
         var product_row = "4", vrow = 3, vtj0='3';
	   $('input[name=\'order_product[3][mf004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#mf0043').val();
			
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi07/lookup/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,  
                success:      
                   function(data){  
                      if(data.response =="true"){
						   add(data.message);	  
                        }
                        							
                    }, 
                      				
                 });  
              },  
            select:   
               function(event, ui) { 
			     var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
                 $('input[name=\'order_product[' + n + '][mf004]\']').val(ui.item.value1);
                 $('input[name=\'order_product[' + n + '][mf004disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][mf008]\']').val(ui.item.value3);
				 $('input[name=\'order_product[' + n + '][mf005]\']').val(ui.item.value4);
				 $('input[name=\'order_product[' + n + '][mf006]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][mf007]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
		
	 //      n 將輸入值為非數位的字元替換為空 輸入不分含稅未稅
	$('input[name=\'order_product['+ vrow + '][mf019]\'],input[name=\'order_product[' + vrow + '][mf009]\']').focusout(function() { 
		//var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 		
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][mf003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][mf003]\']').val(num_2); 
		
	}); 
	//數量游標停在 0 之後 
	$('input[name=\'order_product[' + vrow + '][mf010]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		//	$(this).val('');
	});
	
	$('input[name=\'order_product[' + vrow + '][mf023]\']').blur(function(){
		$('input[name=\'order_product[' + vrow + '][mf004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>


     <script type="text/javascript"><!--
         var product_row = "5", vrow = 4, vtj0='4';
	   $('input[name=\'order_product[4][mf004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#mf0044').val();
			
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi07/lookup/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,  
                success:      
                   function(data){  
                      if(data.response =="true"){
						   add(data.message);	  
                        }
                        							
                    }, 
                      				
                 });  
              },  
            select:   
               function(event, ui) { 
			     var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
                 $('input[name=\'order_product[' + n + '][mf004]\']').val(ui.item.value1);
                 $('input[name=\'order_product[' + n + '][mf004disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][mf008]\']').val(ui.item.value3);
				 $('input[name=\'order_product[' + n + '][mf005]\']').val(ui.item.value4);
				 $('input[name=\'order_product[' + n + '][mf006]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][mf007]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
		
	 //      n 將輸入值為非數位的字元替換為空 輸入不分含稅未稅
	$('input[name=\'order_product['+ vrow + '][mf019]\'],input[name=\'order_product[' + vrow + '][mf009]\']').focusout(function() { 
		//var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 		
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][mf003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][mf003]\']').val(num_2); 
		
	}); 
	//數量游標停在 0 之後 
	$('input[name=\'order_product[' + vrow + '][mf010]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		//	$(this).val('');
	});
	
	$('input[name=\'order_product[' + vrow + '][mf023]\']').blur(function(){
		$('input[name=\'order_product[' + vrow + '][mf004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

 <script type="text/javascript"><!--
         var product_row = "6", vrow = 5, vtj0='5';
	   $('input[name=\'order_product[5][mf004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#mf0045').val();
			
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi07/lookup/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,  
                success:      
                   function(data){  
                      if(data.response =="true"){
						   add(data.message);	  
                        }
                        							
                    }, 
                      				
                 });  
              },  
            select:   
               function(event, ui) { 
			     var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
                 $('input[name=\'order_product[' + n + '][mf004]\']').val(ui.item.value1);
                 $('input[name=\'order_product[' + n + '][mf004disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][mf008]\']').val(ui.item.value3);
				 $('input[name=\'order_product[' + n + '][mf005]\']').val(ui.item.value4);
				 $('input[name=\'order_product[' + n + '][mf006]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][mf007]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
		
	 //      n 將輸入值為非數位的字元替換為空 輸入不分含稅未稅
	$('input[name=\'order_product['+ vrow + '][mf019]\'],input[name=\'order_product[' + vrow + '][mf009]\']').focusout(function() { 
		//var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 		
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][mf003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][mf003]\']').val(num_2); 
		
	}); 
	//數量游標停在 0 之後 
	$('input[name=\'order_product[' + vrow + '][mf010]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		//	$(this).val('');
	});
	
	$('input[name=\'order_product[' + vrow + '][mf023]\']').blur(function(){
		$('input[name=\'order_product[' + vrow + '][mf004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "7", vrow = 6, vtj0='6';
	   $('input[name=\'order_product[6][mf004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#mf0046').val();
			
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi07/lookup/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,  
                success:      
                   function(data){  
                      if(data.response =="true"){
						   add(data.message);	  
                        }
                        							
                    }, 
                      				
                 });  
              },  
            select:   
               function(event, ui) { 
			     var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
                 $('input[name=\'order_product[' + n + '][mf004]\']').val(ui.item.value1);
                 $('input[name=\'order_product[' + n + '][mf004disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][mf008]\']').val(ui.item.value3);
				 $('input[name=\'order_product[' + n + '][mf005]\']').val(ui.item.value4);
				 $('input[name=\'order_product[' + n + '][mf006]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][mf007]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
		
	 //      n 將輸入值為非數位的字元替換為空 輸入不分含稅未稅
	$('input[name=\'order_product['+ vrow + '][mf019]\'],input[name=\'order_product[' + vrow + '][mf009]\']').focusout(function() { 
		//var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 		
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][mf003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][mf003]\']').val(num_2); 
		
	}); 
	//數量游標停在 0 之後 
	$('input[name=\'order_product[' + vrow + '][mf010]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		//	$(this).val('');
	});
	
	$('input[name=\'order_product[' + vrow + '][mf023]\']').blur(function(){
		$('input[name=\'order_product[' + vrow + '][mf004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "8", vrow = 7, vtj0='7'; 
	    $('input[name=\'order_product[7][mf004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#mf0047').val();
			
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi07/lookup/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,  
                success:      
                   function(data){  
                      if(data.response =="true"){
						   add(data.message);	  
                        }
                        							
                    }, 
                      				
                 });  
              },  
            select:   
               function(event, ui) { 
			     var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
                 $('input[name=\'order_product[' + n + '][mf004]\']').val(ui.item.value1);
                 $('input[name=\'order_product[' + n + '][mf004disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][mf008]\']').val(ui.item.value3);
				 $('input[name=\'order_product[' + n + '][mf005]\']').val(ui.item.value4);
				 $('input[name=\'order_product[' + n + '][mf006]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][mf007]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
		
	 //      n 將輸入值為非數位的字元替換為空 輸入不分含稅未稅
	$('input[name=\'order_product['+ vrow + '][mf019]\'],input[name=\'order_product[' + vrow + '][mf009]\']').focusout(function() { 
		//var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 		
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][mf003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][mf003]\']').val(num_2); 
		
	}); 
	//數量游標停在 0 之後 
	$('input[name=\'order_product[' + vrow + '][mf010]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		//	$(this).val('');
	});
	
	$('input[name=\'order_product[' + vrow + '][mf023]\']').blur(function(){
		$('input[name=\'order_product[' + vrow + '][mf004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "9", vrow = 8, vtj0='8';
	    $('input[name=\'order_product[8][mf004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#mf0048').val();
			
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi07/lookup/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,  
                success:      
                   function(data){  
                      if(data.response =="true"){
						   add(data.message);	  
                        }
                        							
                    }, 
                      				
                 });  
              },  
            select:   
               function(event, ui) { 
			     var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
                 $('input[name=\'order_product[' + n + '][mf004]\']').val(ui.item.value1);
                 $('input[name=\'order_product[' + n + '][mf004disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][mf008]\']').val(ui.item.value3);
				 $('input[name=\'order_product[' + n + '][mf005]\']').val(ui.item.value4);
				 $('input[name=\'order_product[' + n + '][mf006]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][mf007]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
		
	 //      n 將輸入值為非數位的字元替換為空 輸入不分含稅未稅
	$('input[name=\'order_product['+ vrow + '][mf019]\'],input[name=\'order_product[' + vrow + '][mf009]\']').focusout(function() { 
		//var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 		
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][mf003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][mf003]\']').val(num_2); 
		
	}); 
	//數量游標停在 0 之後 
	$('input[name=\'order_product[' + vrow + '][mf010]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		//	$(this).val('');
	});
	
	$('input[name=\'order_product[' + vrow + '][mf023]\']').blur(function(){
		$('input[name=\'order_product[' + vrow + '][mf004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "10", vrow = 9, vtj0='9'; 
	  $('input[name=\'order_product[9][mf004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#mf0049').val();
			
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi07/lookup/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,  
                success:      
                   function(data){  
                      if(data.response =="true"){
						   add(data.message);	  
                        }
                        							
                    }, 
                      				
                 });  
              },  
            select:   
               function(event, ui) { 
			     var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
                 $('input[name=\'order_product[' + n + '][mf004]\']').val(ui.item.value1);
                 $('input[name=\'order_product[' + n + '][mf004disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][mf008]\']').val(ui.item.value3);
				 $('input[name=\'order_product[' + n + '][mf005]\']').val(ui.item.value4);
				 $('input[name=\'order_product[' + n + '][mf006]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][mf007]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
		
	 //      n 將輸入值為非數位的字元替換為空 輸入不分含稅未稅
	$('input[name=\'order_product['+ vrow + '][mf019]\'],input[name=\'order_product[' + vrow + '][mf009]\']').focusout(function() { 
		//var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 		
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][mf003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][mf003]\']').val(num_2); 
		
	}); 
	//數量游標停在 0 之後 
	$('input[name=\'order_product[' + vrow + '][mf010]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		//	$(this).val('');
	});
	
	$('input[name=\'order_product[' + vrow + '][mf023]\']').blur(function(){
		$('input[name=\'order_product[' + vrow + '][mf004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>