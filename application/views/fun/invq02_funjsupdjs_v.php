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
	  var product_row = "1"; 
		 $('input[name=\'order_product[0][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#tb0040').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri05/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb007]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product[0][tb009]\'],input[name=\'order_product[0][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb017]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb018]\']').val(get_total); 
		
		//流水號
	//	var num_1 = 1000;
	//	if ($('input[name=\'order_product[' + n + '][tb003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
	//	var num_2=(parseInt($('input[name=\'order_product[' + n + '][tb003]\']').val())*1)+(n*2)+num_1; 
	 //   $('input[name=\'order_product[' + n + '][tb003]\']').val(num_2); 
		
		//alert(num_2);
		
	});
	   //數量
	$('input[name=\'order_product[0][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
            
	$('input[name=\'order_product[0][tb009]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
			
			
	});
	   //單價  
	$('input[name=\'order_product[0][tb017]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		   $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[0][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	$('input[name=\'order_product[0][tb012]\']').blur(function(){
		$('input[name=\'order_product[1][tb004]\']').focus();
	});
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
 
	<!-- javascrit 明細1 -->	  	 
     <script type="text/javascript"><!--
         var product_row = "2"; 	 
     
		 $('input[name=\'order_product[1][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb0041').val();
			
		//	alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri05/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb007]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product[1][tb009]\'],input[name=\'order_product[1][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb017]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb018]\']').val(get_total); 
		
		//流水號
	//	var num_1 = 1000;
	//	if ($('input[name=\'order_product[' + n + '][tb003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
	//	var num_2=(parseInt($('input[name=\'order_product[' + n + '][tb003]\']').val())*1)+(n*10)+num_1; 
	//    $('input[name=\'order_product[' + n + '][tb003]\']').val(num_2); 
		
		//alert(num_2);
		
	});
	   //數量
	$('input[name=\'order_product[1][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
            
	$('input[name=\'order_product[1][tb009]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
			
			
	});
	   //單價  
	$('input[name=\'order_product[1][tb017]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[1][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	$('input[name=\'order_product[1][tb012]\']').blur(function(){
		$('input[name=\'order_product[2][tb004]\']').focus();
	});
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "3"; 	 
       
		 $('input[name=\'order_product[2][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb0042').val();
			
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri05/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb007]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product[2][tb009]\'],input[name=\'order_product[2][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb017]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb018]\']').val(get_total); 
		
		
		
	});
	   //數量
	$('input[name=\'order_product[2][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
            
	$('input[name=\'order_product[2][tb009]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
			
			
	});
	   //單價  
	$('input[name=\'order_product[2][tb017]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[2][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[2][tb012]\']').blur(function(){
		$('input[name=\'order_product[3][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
 

     <script type="text/javascript"><!--
         var product_row = "4"; 	 
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
	 
		 $('input[name=\'order_product[3][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb0043').val();
			if (product_row == "4" ) { smb001= $('#tb0043').val(); }
		//	alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri05/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb007]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product[3][tb009]\'],input[name=\'order_product[3][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb017]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb018]\']').val(get_total); 
		
		
		
	});
	   //數量
	$('input[name=\'order_product[3][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
            
	$('input[name=\'order_product[3][tb009]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
			
			
	});
	   //單價  
	$('input[name=\'order_product[3][tb017]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[3][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[3][tb012]\']').blur(function(){
		$('input[name=\'order_product[4][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>


     <script type="text/javascript"><!--
         var product_row = "5"; 
	 
		 $('input[name=\'order_product[4][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb0044').val();
			if (product_row == "5" ) { smb001= $('#tb0044').val(); }
		//	alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri05/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb007]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product[4][tb009]\'],input[name=\'order_product[4][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb017]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb018]\']').val(get_total); 
		
	});
	   //數量
	$('input[name=\'order_product[4][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
            
	$('input[name=\'order_product[4][tb009]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
			
			
	});
	   //單價  
	$('input[name=\'order_product[4][tb017]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[4][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[4][tb012]\']').blur(function(){
		$('input[name=\'order_product[5][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "6"; 
	 
		 $('input[name=\'order_product[5][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb0045').val();
			if (product_row == "6" ) { smb001= $('#tb0045').val(); }
		//	alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri05/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb007]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product[5][tb009]\'],input[name=\'order_product[5][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb017]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb018]\']').val(get_total); 
			
		
	});
	   //數量
	$('input[name=\'order_product[5][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
            
	$('input[name=\'order_product[5][tb009]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
			
			
	});
	   //單價  
	$('input[name=\'order_product[5][tb017]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[5][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[5][tb012]\']').blur(function(){
		$('input[name=\'order_product[6][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "7"; 
	 
		 $('input[name=\'order_product[6][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb0046').val();
			if (product_row == "7" ) { smb001= $('#tb0046').val(); }
		//	alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri05/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb007]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product[6][tb009]\'],input[name=\'order_product[1][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb017]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb018]\']').val(get_total); 
				
		
	});
	   //數量
	$('input[name=\'order_product[6][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
            
	$('input[name=\'order_product[6][tb009]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
			
			
	});
	   //單價  
	$('input[name=\'order_product[6][tb017]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[6][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[6][tb012]\']').blur(function(){
		$('input[name=\'order_product[7][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "8"; 
	 
		 $('input[name=\'order_product[7][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb0047').val();
			if (product_row == "8" ) { smb001= $('#tb0047').val(); }
		//	alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri05/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb007]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product[7][tb009]\'],input[name=\'order_product[7][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb017]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb018]\']').val(get_total); 
		
		
		
	});
	   //數量
	$('input[name=\'order_product[7][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
            
	$('input[name=\'order_product[7][tb009]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
			
			
	});
	   //單價  
	$('input[name=\'order_product[7][tb017]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[7][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[7][tb012]\']').blur(function(){
		$('input[name=\'order_product[8][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "9";
	 
		 $('input[name=\'order_product[8][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb0048').val();
			if (product_row == "9" ) { smb001= $('#tb0048').val(); }
		//	alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri05/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb007]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product[8][tb009]\'],input[name=\'order_product[8][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb017]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb018]\']').val(get_total); 
		
		//流水號
	//	var num_1 = 1000;
	//	if ($('input[name=\'order_product[' + n + '][tb003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
	//	var num_2=(parseInt($('input[name=\'order_product[' + n + '][tb003]\']').val())*1)+(n*10)+num_1; 
	//    $('input[name=\'order_product[' + n + '][tb003]\']').val(num_2); 
		
		//alert(num_2);
		
	});
	   //數量
	$('input[name=\'order_product[8][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
            
	$('input[name=\'order_product[8][tb009]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
			
			
	});
	   //單價  
	$('input[name=\'order_product[8][tb017]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[8][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[8][tb012]\']').blur(function(){
		$('input[name=\'order_product[9][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "10"; 
	 
		 $('input[name=\'order_product[9][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb0049').val();
			if (product_row == "10" ) { smb001= $('#tb0049').val(); }
		//	alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri05/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb007]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product[9][tb009]\'],input[name=\'order_product[9][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb017]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb018]\']').val(get_total);
		
	});
	   //數量
	$('input[name=\'order_product[9][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
            
	$('input[name=\'order_product[9][tb009]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
			
			
	});
	   //單價  
	$('input[name=\'order_product[9][tb017]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[9][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[9][tb012]\']').blur(function(){
		$('input[name=\'order_product[10][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
    <script type="text/javascript"><!--
         var product_row = "11"; 
	 
		 $('input[name=\'order_product[10][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb00410').val();
			if (product_row == "11" ) { smb001= $('#tb00410').val(); }
		//	alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri05/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb007]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product[10][tb009]\'],input[name=\'order_product[10][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb017]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb018]\']').val(get_total);
		
	});
	   //數量
	$('input[name=\'order_product[10][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
            
	$('input[name=\'order_product[10][tb009]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
			
			
	});
	   //單價  
	$('input[name=\'order_product[10][tb017]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[10][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[10][tb012]\']').blur(function(){
		$('input[name=\'order_product[11][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = "12"; 
	 
		 $('input[name=\'order_product[11][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb00411').val();
			if (product_row == "12" ) { smb001= $('#tb00411').val(); }
		//	alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri05/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb007]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product[11][tb009]\'],input[name=\'order_product[11][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb017]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb018]\']').val(get_total);
		
	});
	   //數量
	$('input[name=\'order_product[11][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
            
	$('input[name=\'order_product[11][tb009]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
			
			
	});
	   //單價  
	$('input[name=\'order_product[11][tb017]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[11][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[11][tb012]\']').blur(function(){
		$('input[name=\'order_product[12][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = "13"; 
	 
		 $('input[name=\'order_product[12][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb00412').val();
			if (product_row == "13" ) { smb001= $('#tb00412').val(); }
		//	alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri05/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb007]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product[12][tb009]\'],input[name=\'order_product[12][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb017]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb018]\']').val(get_total);
		
	});
	   //數量
	$('input[name=\'order_product[12][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
            
	$('input[name=\'order_product[12][tb009]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
			
			
	});
	   //單價  
	$('input[name=\'order_product[12][tb017]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[12][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[12][tb012]\']').blur(function(){
		$('input[name=\'order_product[13][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = "14"; 
	 
		 $('input[name=\'order_product[13][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb00413').val();
			if (product_row == "14" ) { smb001= $('#tb00413').val(); }
		//	alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri05/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb007]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product[13][tb009]\'],input[name=\'order_product[13][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb017]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb018]\']').val(get_total);
		
	});
	   //數量
	$('input[name=\'order_product[13][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
            
	$('input[name=\'order_product[13[tb009]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
			
			
	});
	   //單價  
	$('input[name=\'order_product[13][tb017]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[13][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[13][tb012]\']').blur(function(){
		$('input[name=\'order_product[14][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = "15"; 
	 
		 $('input[name=\'order_product[14][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
        
			smb001= $('#tb00414').val();
			if (product_row == "15" ) { smb001= $('#tb00414').val(); }
		//	alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri05/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb007]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product[14][tb009]\'],input[name=\'order_product[14][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb017]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb018]\']').val(get_total);
		
	});
	   //數量
	$('input[name=\'order_product[14][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
            
	$('input[name=\'order_product[14[tb009]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
			
			
	});
	   //單價  
	$('input[name=\'order_product[14][tb017]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[14][tb017]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product[14][tb012]\']').blur(function(){
		$('input[name=\'order_product[15][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>