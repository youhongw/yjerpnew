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
	  var product_row = 1; vproduct_row = 0;
		 $('input[name=\'order_product[0][tg004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#tg0040').val();
			
			// alert(smb001);
		//	   alert('test0');
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookup/'+encodeURIComponent(smb001), 
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
			//	 var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg004disp]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tg004disp1]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tg005]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  tg007  交貨庫別輸入
	
    $('input[name=\'order_product[0][tg007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tg003').value;
			   
			  smb001= $('#tg0070').val(); 
			 
			//   smb001=$("#tg003"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookupa/'+encodeURIComponent(smb001), 
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
				// var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
     //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tg008]\'],input[name=\'order_product[' + product_row + '][tg011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	    var n = vproduct_row;
		var input_1=$('input[name=\'order_product[' + n + '][tg008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tg011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tg012]\']').val(get_total); 
   
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tg003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tg003]\']').val(num_2); 
	
		
	});
	
	//元件用量
	$('input[name=\'order_product[' + product_row + '][tg008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
	  	if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
	
	   
	
	
	//備註,品號
//	$('input[name=\'order_product[' + product_row + '][tg017]\']').blur(function(){
//		$('input[name=\'order_product[' + product_row + '][tg003]\']').focus();
//	});
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
 
	<!-- javascrit 明細1 -->	  	 
     <script type="text/javascript"><!--
         var product_row = 2; vproduct_row = 1;	 
     
		 $('input[name=\'order_product[1][tg004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#tg0041').val();
			
			// alert(smb001);
		//	   alert('test0');
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookup/'+encodeURIComponent(smb001), 
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
			//	 var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg004disp]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tg004disp1]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tg005]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  tg007  交貨庫別輸入
	
    $('input[name=\'order_product[1][tg007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tg003').value;
			   
			  smb001= $('#tg0071').val(); 
			 
			//   smb001=$("#tg003"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookupa/'+encodeURIComponent(smb001), 
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
				// var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
     //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tg008]\'],input[name=\'order_product[' + product_row + '][tg011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	//    var n = vproduct_row;
		var input_1=$('input[name=\'order_product[' + n + '][tg008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tg011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tg012]\']').val(get_total); 
   
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tg003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tg003]\']').val(num_2); 
	
		
	});
	
	//元件用量
	$('input[name=\'order_product[' + product_row + '][tg008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
	  	if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
	
	  
	
	
	//備註,品號
//	$('input[name=\'order_product[' + product_row + '][tg017]\']').blur(function(){
//		$('input[name=\'order_product[' + product_row + '][tg003]\']').focus();
//	});
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = 3; vproduct_row = 2;	 
       
		 $('input[name=\'order_product[2][tg004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#tg0042').val();
			
			// alert(smb001);
		//	   alert('test0');
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookup/'+encodeURIComponent(smb001), 
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
			//	 var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg004disp]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tg004disp1]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tg005]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  tg007  交貨庫別輸入
	
    $('input[name=\'order_product[2][tg007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tg003').value;
			   
			  smb001= $('#tg0072').val(); 
			 
			//   smb001=$("#tg003"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookupa/'+encodeURIComponent(smb001), 
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
				// var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
     //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tg008]\'],input[name=\'order_product[' + product_row + '][tg011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tg008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tg011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tg012]\']').val(get_total); 
   
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tg003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tg003]\']').val(num_2); 
	
		
	});
	
	//元件用量
	$('input[name=\'order_product[' + product_row + '][tg008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
	  	if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
	
	
	
	
	//備註,品號
//	$('input[name=\'order_product[' + product_row + '][tg017]\']').blur(function(){
//		$('input[name=\'order_product[' + product_row + '][tg003]\']').focus();
//	});
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
 



     <script type="text/javascript"><!--
           var product_row = 4; vproduct_row = 3;	 
       
		 $('input[name=\'order_product[3][tg004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#tg0043').val();
			
			// alert(smb001);
		//	   alert('test0');
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookup/'+encodeURIComponent(smb001), 
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
			//	 var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg004disp]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tg004disp1]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tg005]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  tg007  交貨庫別輸入
	
    $('input[name=\'order_product[3][tg007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tg003').value;
			   
			  smb001= $('#tg0073').val(); 
			 
			//   smb001=$("#tg003"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookupa/'+encodeURIComponent(smb001), 
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
				// var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
     //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tg008]\'],input[name=\'order_product[' + product_row + '][tg011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	//    var n = vproduct_row;
		var input_1=$('input[name=\'order_product[' + n + '][tg008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tg011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tg012]\']').val(get_total); 
   
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tg003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tg008]\']').val(num_2); 
	
		
	});
	
	//元件用量
	$('input[name=\'order_product[' + product_row + '][tg008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
	  	if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
	
	
	
	//備註,品號
//	$('input[name=\'order_product[' + product_row + '][tg017]\']').blur(function(){
//		$('input[name=\'order_product[' + product_row + '][tg003]\']').focus();
//	});
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
            var product_row = 5; vproduct_row = 4;	 
       
		 $('input[name=\'order_product[4][tg004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#tg0044').val();
			
			// alert(smb001);
		//	   alert('test0');
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookup/'+encodeURIComponent(smb001), 
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
			//	 var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg004disp]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tg004disp1]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tg005]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  tg007  交貨庫別輸入
	
    $('input[name=\'order_product[4][tg007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tg003').value;
			   
			  smb001= $('#tg0074').val(); 
			 
			//   smb001=$("#tg003"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookupa/'+encodeURIComponent(smb001), 
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
				// var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
     //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tg008]\'],input[name=\'order_product[' + product_row + '][tg011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	//    var n = vproduct_row;
		var input_1=$('input[name=\'order_product[' + n + '][tg008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tg011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tg012]\']').val(get_total); 
   
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tg003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tg008]\']').val(num_2); 
	
		
	});
	
	//元件用量
	$('input[name=\'order_product[' + product_row + '][tg008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
	  	if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
	
	//備註,品號
//	$('input[name=\'order_product[' + product_row + '][tg017]\']').blur(function(){
//		$('input[name=\'order_product[' + product_row + '][tg003]\']').focus();
//	});
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
   <script type="text/javascript"><!--
            var product_row = 6; vproduct_row = 5;	 
       
		 $('input[name=\'order_product[5][tg004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#tg0045').val();
			
			// alert(smb001);
		//	   alert('test0');
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookup/'+encodeURIComponent(smb001), 
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
			//	 var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg004disp]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tg004disp1]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tg005]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  tg007  交貨庫別輸入
	
    $('input[name=\'order_product[5][tg007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tg003').value;
			   
			  smb001= $('#tg0075').val(); 
			 
			//   smb001=$("#tg003"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookupa/'+encodeURIComponent(smb001), 
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
				// var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
     //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tg008]\'],input[name=\'order_product[' + product_row + '][tg011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	//    var n = vproduct_row;
		var input_1=$('input[name=\'order_product[' + n + '][tg008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tg011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tg012]\']').val(get_total); 
   
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tg003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tg008]\']').val(num_2); 
	
		
	});
	
	//元件用量
	$('input[name=\'order_product[' + product_row + '][tg008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
	  	if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
	
	
	
	//備註,品號
//	$('input[name=\'order_product[' + product_row + '][tg017]\']').blur(function(){
//		$('input[name=\'order_product[' + product_row + '][tg003]\']').focus();
//	});
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
     <script type="text/javascript"><!--
            var product_row = 7; vproduct_row = 6;	 
       
		 $('input[name=\'order_product[6][tg004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#tg0046').val();
			
			// alert(smb001);
		//	   alert('test0');
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookup/'+encodeURIComponent(smb001), 
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
			//	 var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg004disp]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tg004disp1]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tg005]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  tg007  交貨庫別輸入
	
    $('input[name=\'order_product[6][tg007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tg003').value;
			   
			  smb001= $('#tg0076').val(); 
			 
			//   smb001=$("#tg003"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookupa/'+encodeURIComponent(smb001), 
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
				// var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
     //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tg008]\'],input[name=\'order_product[' + product_row + '][tg011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	//    var n = vproduct_row;
		var input_1=$('input[name=\'order_product[' + n + '][tg008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tg011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tg012]\']').val(get_total); 
   
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tg003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tg008]\']').val(num_2); 
	
		
	});
	
	//元件用量
	$('input[name=\'order_product[' + product_row + '][tg008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
	  	if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
	
	
	
	//備註,品號
//	$('input[name=\'order_product[' + product_row + '][tg017]\']').blur(function(){
//		$('input[name=\'order_product[' + product_row + '][tg003]\']').focus();
//	});
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
           var product_row = 8; vproduct_row = 7;	 
       
		 $('input[name=\'order_product[7][tg004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#tg0047').val();
			
			// alert(smb001);
		//	   alert('test0');
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookup/'+encodeURIComponent(smb001), 
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
			//	 var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg004disp]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tg004disp1]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tg005]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  tg007  交貨庫別輸入
	
    $('input[name=\'order_product[7][tg007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tg003').value;
			   
			  smb001= $('#tg0077').val(); 
			 
			//   smb001=$("#tg003"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookupa/'+encodeURIComponent(smb001), 
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
				// var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
     //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tg008]\'],input[name=\'order_product[' + product_row + '][tg011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	//    var n = vproduct_row;
		var input_1=$('input[name=\'order_product[' + n + '][tg008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tg011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tg012]\']').val(get_total); 
   
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tg003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tg008]\']').val(num_2); 
	
		
	});
	
	//元件用量
	$('input[name=\'order_product[' + product_row + '][tg008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
	  	if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
	
	
	
	//備註,品號
//	$('input[name=\'order_product[' + product_row + '][tg017]\']').blur(function(){
//		$('input[name=\'order_product[' + product_row + '][tg003]\']').focus();
//	});
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
            var product_row = 9; vproduct_row = 8;	 
       
		 $('input[name=\'order_product[8][tg004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#tg0048').val();
			
			// alert(smb001);
		//	   alert('test0');
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookup/'+encodeURIComponent(smb001), 
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
			//	 var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg004disp]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tg004disp1]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tg005]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  tg007  交貨庫別輸入
	
    $('input[name=\'order_product[8][tg007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tg003').value;
			   
			  smb001= $('#tg0078').val(); 
			 
			//   smb001=$("#tg003"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookupa/'+encodeURIComponent(smb001), 
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
				// var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
     //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tg008]\'],input[name=\'order_product[' + product_row + '][tg011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	//    var n = vproduct_row;
		var input_1=$('input[name=\'order_product[' + n + '][tg008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tg011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tg012]\']').val(get_total); 
   
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tg003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tg008]\']').val(num_2); 
	
		
	});
	
	//元件用量
	$('input[name=\'order_product[' + product_row + '][tg008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
	  	if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
	
	
	//備註,品號
//	$('input[name=\'order_product[' + product_row + '][tg017]\']').blur(function(){
//		$('input[name=\'order_product[' + product_row + '][tg003]\']').focus();
//	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
            var product_row = 10; vproduct_row = 9;	 
       
		 $('input[name=\'order_product[9][tg004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#tg0049').val();
			
			// alert(smb001);
		//	   alert('test0');
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookup/'+encodeURIComponent(smb001), 
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
			//	 var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg004disp]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tg004disp1]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tg005]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  tg007  交貨庫別輸入
	
    $('input[name=\'order_product[9][tg007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tg003').value;
			   
			  smb001= $('#tg0079').val(); 
			 
			//   smb001=$("#tg003"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookupa/'+encodeURIComponent(smb001), 
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
				// var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
     //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tg008]\'],input[name=\'order_product[' + product_row + '][tg011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	//    var n = vproduct_row;
		var input_1=$('input[name=\'order_product[' + n + '][tg008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tg011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tg012]\']').val(get_total); 
   
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tg003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tg008]\']').val(num_2); 
	
		
	});
	
	//元件用量
	$('input[name=\'order_product[' + product_row + '][tg008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
	  	if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
	
	
	
	//備註,品號
//	$('input[name=\'order_product[' + product_row + '][tg017]\']').blur(function(){
//		$('input[name=\'order_product[' + product_row + '][tg003]\']').focus();
//	});
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
    <script type="text/javascript"><!--
          var product_row = 11; vproduct_row = 10;	 
       
		 $('input[name=\'order_product[10][tg004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#tg00410').val();
			
			// alert(smb001);
		//	   alert('test0');
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookup/'+encodeURIComponent(smb001), 
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
			//	 var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg004disp]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tg004disp1]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tg005]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  tg007  交貨庫別輸入
	
    $('input[name=\'order_product[10][tg007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tg003').value;
			   
			  smb001= $('#tg00710').val(); 
			 
			//   smb001=$("#tg003"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookupa/'+encodeURIComponent(smb001), 
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
				// var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
     //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tg008]\'],input[name=\'order_product[' + product_row + '][tg011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	//    var n = vproduct_row;
		var input_1=$('input[name=\'order_product[' + n + '][tg008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tg011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tg012]\']').val(get_total); 
   
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tg003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tg008]\']').val(num_2); 
	
		
	});
	
	//元件用量
	$('input[name=\'order_product[' + product_row + '][tg008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
	  	if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});

	
	//備註,品號
//	$('input[name=\'order_product[' + product_row + '][tg017]\']').blur(function(){
//		$('input[name=\'order_product[' + product_row + '][tg003]\']').focus();
//	});
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
            var product_row = 12; vproduct_row = 11;	 
       
		 $('input[name=\'order_product[12][tg004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#tg00412').val();
			
			// alert(smb001);
		//	   alert('test0');
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookup/'+encodeURIComponent(smb001), 
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
			//	 var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg004disp]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tg004disp1]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tg005]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  tg007  交貨庫別輸入
	
    $('input[name=\'order_product[12][tg007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tg003').value;
			   
			  smb001= $('#tg00712').val(); 
			 
			//   smb001=$("#tg003"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookupa/'+encodeURIComponent(smb001), 
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
				// var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
     //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tg008]\'],input[name=\'order_product[' + product_row + '][tg011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	//    var n = vproduct_row;
		var input_1=$('input[name=\'order_product[' + n + '][tg008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tg011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tg012]\']').val(get_total); 
   
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tg003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tg008]\']').val(num_2); 
	
		
	});
	
	//元件用量
	$('input[name=\'order_product[' + product_row + '][tg008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
	  	if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
	

	
	//備註,品號
//	$('input[name=\'order_product[' + product_row + '][tg017]\']').blur(function(){
//		$('input[name=\'order_product[' + product_row + '][tg003]\']').focus();
//	});
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
          var product_row = 13; vproduct_row = 12;	 
       
		 $('input[name=\'order_product[12][tg004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#tg00412').val();
			
			// alert(smb001);
		//	   alert('test0');
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookup/'+encodeURIComponent(smb001), 
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
			//	 var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg004disp]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tg004disp1]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tg005]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  tg007  交貨庫別輸入
	
    $('input[name=\'order_product[12][tg007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tg003').value;
			   
			  smb001= $('#tg00712').val(); 
			 
			//   smb001=$("#tg003"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookupa/'+encodeURIComponent(smb001), 
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
				// var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
     //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tg008]\'],input[name=\'order_product[' + product_row + '][tg011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	//    var n = vproduct_row;
		var input_1=$('input[name=\'order_product[' + n + '][tg008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tg011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tg012]\']').val(get_total); 
   
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tg003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tg008]\']').val(num_2); 
	
		
	});
	
	//元件用量
	$('input[name=\'order_product[' + product_row + '][tg008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
	  	if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
	

	
	//備註,品號
//	$('input[name=\'order_product[' + product_row + '][tg017]\']').blur(function(){
//		$('input[name=\'order_product[' + product_row + '][tg003]\']').focus();
//	});
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
            var product_row = 14; vproduct_row = 13;	 
       
		 $('input[name=\'order_product[13][tg004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#tg00413').val();
			
			// alert(smb001);
		//	   alert('test0');
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookup/'+encodeURIComponent(smb001), 
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
			//	 var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg004disp]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tg004disp1]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tg005]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  tg007  交貨庫別輸入
	
    $('input[name=\'order_product[13][tg007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tg003').value;
			   
			  smb001= $('#tg00713').val(); 
			 
			//   smb001=$("#tg003"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookupa/'+encodeURIComponent(smb001), 
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
				// var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
     //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tg008]\'],input[name=\'order_product[' + product_row + '][tg011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	//    var n = vproduct_row;
		var input_1=$('input[name=\'order_product[' + n + '][tg008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tg011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tg012]\']').val(get_total); 
   
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tg003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tg008]\']').val(num_2); 
	
		
	});
	
	//元件用量
	$('input[name=\'order_product[' + product_row + '][tg008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
	  	if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
	
	//備註,品號
//	$('input[name=\'order_product[' + product_row + '][tg017]\']').blur(function(){
//		$('input[name=\'order_product[' + product_row + '][tg003]\']').focus();
//	});
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
          var product_row = 15; vproduct_row = 14;	 
       
		 $('input[name=\'order_product[14][tg004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#tg00414').val();
			
			// alert(smb001);
		//	   alert('test0');
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookup/'+encodeURIComponent(smb001), 
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
			//	 var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg004disp]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tg004disp1]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tg005]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  tg007  交貨庫別輸入
	
    $('input[name=\'order_product[14][tg007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tg003').value;
			   
			  smb001= $('#tg00714').val(); 
			 
			//   smb001=$("#tg003"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi06/lookupa/'+encodeURIComponent(smb001), 
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
				// var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][tg007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tg007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
     //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tg008]\'],input[name=\'order_product[' + product_row + '][tg011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	//    var n = vproduct_row;
		var input_1=$('input[name=\'order_product[' + n + '][tg008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tg011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tg012]\']').val(get_total); 
   
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tg003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tg008]\']').val(num_2); 
	
		
	});
	
	//元件用量
	$('input[name=\'order_product[' + product_row + '][tg008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
	  	if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});

	
	
	//備註,品號
//	$('input[name=\'order_product[' + product_row + '][tg017]\']').blur(function(){
//		$('input[name=\'order_product[' + product_row + '][tg003]\']').focus();
//	});
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--  //合計金額

function totalSum() {

 
    var sumTotal = 0;
	var sumTotal1 = 0;
	var sumQty = 0;
	var product_row = 0; 
	var sumTax =0; 
	var sumTax1 =0; 
	var tax =0;
	var rate =0;
    $(".total_price").each(function() {
		if(!isNaN(this.value) && this.value.length!=0) {
			sumTotal += parseFloat(this.value);			
		}
    });
	 $(".total_price1").each(function() {
		if(!isNaN(this.value) && this.value.length!=0) {
			sumTotal1 += parseFloat(this.value);			
		}
    });
	
	$(".total_qty").each(function() {
		if(!isNaN(this.value) && this.value.length!=0) {
			sumQty += parseFloat(this.value);			
		}
    });
    
    $("#sum_total").html(sumTotal.toFixed(1));

  	form.tg028.value=Math.round(sumTotal);	  //原幣貨款
	 var tax=$('input[name=\'tg030\']').val();  //稅率
	 var rate=$('input[name=\'tg008\']').val();  //匯率
	form.tg019.value=Math.round(sumTotal*tax);  //原幣稅額
	form.tg031.value=Math.round(sumTotal1*rate);	  //本幣貨款
	form.tg032.value=Math.round(sumTotal1*rate*tax);  //本幣稅額
	var sumTax =Math.round(sumTotal*tax);
	var sumTax1 =Math.round(sumTotal1*rate*tax);
	//課稅別
	if ($('select[name=\'tg010\']').val()=='1') {form.tg028.value=Math.round(sumTotal-sumTax);sumTotal=Math.round(sumTotal-sumTax);}
	if ($('select[name=\'tg010\']').val()=='1') {form.tg031.value=Math.round(sumTotal1-sumTax1);sumTotal1=Math.round(sumTotal1-sumTax1);}
	
	var sumTot =Math.round(sumTotal+sumTax);
  //  $("#sum_tax").html(sumTax.toFixed(1));	
	$("#sum_tot").html(sumTot.toFixed(1));	
	var sumTot1 =Math.round(sumTotal1+sumTax1);
  //  $("#sum_tax1").html(sumTax1.toFixed(1));	
	$("#sum_tot1").html(sumTot1.toFixed(1));	
	form.tg026.value=Math.round(sumQty);	
}
//--></script>