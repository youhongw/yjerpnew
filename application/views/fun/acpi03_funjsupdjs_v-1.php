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
	  var product_row = 1, vrow = 0, vtj0='0';
       
		 $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj0).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj0).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	    	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>

 
	<!-- javascrit 明細1 -->	  	 
     <script type="text/javascript"><!--
	  var product_row = 2, vrow = 1, vtj1='1';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj1).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj1).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>

<!-- javascrit 明細2 -->
      <script type="text/javascript"><!--
	  var product_row = 3, vrow = 2, vtj2='2';
	 $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj2).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj2).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>
 
<!-- javascrit 明細3 -->
      <script type="text/javascript"><!--
	  var product_row = 4, vrow = 3, vtj3='3';
	 $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj3).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj3).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>

<!-- javascrit 明細4 -->
      <script type="text/javascript"><!--
	  var product_row = 5, vrow = 4, vtj4='4';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj4).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj4).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	    	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>

<!-- javascrit 明細5 -->
     <script type="text/javascript"><!--
	  var product_row = 6, vrow = 5, vtj5='5';
	 $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj5).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj5).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>

<!-- javascrit 明細6 -->
       <script type="text/javascript"><!--
	  var product_row = 7, vrow = 6, vtj6='6';
		 $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj6).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj6).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>

<!-- javascrit 明細7 -->
       <script type="text/javascript"><!--
	  var product_row = 8, vrow = 7, vtj7='7';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj7).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj7).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>

<!-- javascrit 明細8 -->
       <script type="text/javascript"><!--
	  var product_row = 9, vrow = 8, vtj8='8';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj8).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj8).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>

<!-- javascrit 明細9 -->
      <script type="text/javascript"><!--
	  var product_row = 10, vrow = 9, vtj9='9';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj9).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj9).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>

<!-- javascrit 明細10 -->
     <script type="text/javascript"><!--
	  var product_row = 11, vrow = 10, vtj10='10';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj10).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj10).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>

<!-- javascrit 明細11 -->
  <script type="text/javascript"><!--
	  var product_row = 12, vrow = 11, vtj11='11';
	 $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj11).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj11).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>

<!-- javascrit 明細12 -->
  <script type="text/javascript"><!--
	  var product_row = 13, vrow = 12, vtj12='12';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj12).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj12).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>

<!-- javascrit 明細13 -->
  <script type="text/javascript"><!--
	  var product_row = 14, vrow = 13, vtj13='13';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj13).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj13).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>

<!-- javascrit 明細14-->
  <script type="text/javascript"><!--
	  var product_row = 15, vrow = 14, vtj14='14';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj14).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj14).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>
<!-- javascrit 明細15-->
  <script type="text/javascript"><!--
	  var product_row = 16, vrow = 15, vtj15='15';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj15).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj15).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>
<!-- javascrit 明細16-->
  <script type="text/javascript"><!--
	  var product_row = 17, vrow = 16, vtj16='16';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj16).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj16).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>
<!-- javascrit 明細17-->
  <script type="text/javascript"><!--
	  var product_row = 18, vrow = 17, vtj17='17';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj17).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj17).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>
<!-- javascrit 明細18-->
  <script type="text/javascript"><!--
	  var product_row = 19, vrow = 18, vtj18='18';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj18).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj18).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>
<!-- javascrit 明細19-->
  <script type="text/javascript"><!--
	  var product_row = 20, vrow = 19, vtj19='19';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj19).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj19).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>
<!-- javascrit 明細20-->
  <script type="text/javascript"><!--
	  var product_row = 21, vrow = 20, vtj20='20';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj20).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj20).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>
<!-- javascrit 明細21-->
  <script type="text/javascript"><!--
	  var product_row = 22, vrow = 21, vtj21='21';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj21).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj21).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>
<!-- javascrit 明細22-->
  <script type="text/javascript"><!--
	  var product_row = 23, vrow = 22, vtj22='22';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj22).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj22).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>
<!-- javascrit 明細23-->
  <script type="text/javascript"><!--
	  var product_row = 24, vrow = 23, vtj23='23';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj23).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj23).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>
<!-- javascrit 明細24-->
  <script type="text/javascript"><!--
	  var product_row = 25, vrow = 24, vtj24='24';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj24).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj24).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>
<!-- javascrit 明細25-->
  <script type="text/javascript"><!--
	  var product_row = 26, vrow = 25, vtj25='25';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj25).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj25).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>
<!-- javascrit 明細26-->
  <script type="text/javascript"><!--
	  var product_row = 27, vrow = 26, vtj26='26';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj26).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj26).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>
<!-- javascrit 明細27-->
  <script type="text/javascript"><!--
	  var product_row = 28, vrow = 27, vtj27='27';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj27).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj27).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>
<!-- javascrit 明細28-->
  <script type="text/javascript"><!--
	  var product_row = 29, vrow = 28, vtj28='28';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj28).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj28).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>
<!-- javascrit 明細29-->
  <script type="text/javascript"><!--
	  var product_row = 30, vrow = 29, vtj29='29';
	  $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj29).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//科目
       $('input[name=\'order_product['  + vrow +  '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		      smb001= $('#td008'+vtj29).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001),
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][td007]\'],input[name=\'order_product['  + vrow +  '][td015]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][td014]\']').focus(function(){
	       var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
	
	//本幣貨幣  
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//本幣貨幣
    $('input[name=\'order_product[' + vrow + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;

//--></script>
<script type="text/javascript"><!--  //合計金額

function totalSum() {
   var sumTotal = 0;
	var sumTotal1 = 0;
	var sumTotal2 = 0;
	var sumTotal3 = 0;
	var sumQty = 0;
	var product_row1 = 0; 
	var sumTax =0; 
	var sumTax1 =0; 
	var tax =0;
	var rate =0;
	
	$(".total_dc").each(function() {
		if(!isNaN(this.value) && this.value=='1') {		    
			sumTotal += parseFloat($('input[name=\'order_product[' + product_row1 + '][td014]\']').val());			
		}
		product_row1++;
    });
	var product_row1 = 0; 
    $(".total_dc").each(function() {
		if(!isNaN(this.value) && this.value!='1') {		    
			sumTotal1 += parseFloat($('input[name=\'order_product[' + product_row1 + '][td014]\']').val());			
		}
		product_row1++;
    });
	var product_row1 = 0; 
	$(".total_dc").each(function() {
		if(!isNaN(this.value) && this.value=='1') {		    
			sumTotal2 += parseFloat($('input[name=\'order_product[' + product_row1 + '][td015]\']').val());			
		}
		product_row1++;
    });
	var product_row1 = 0; 
    $(".total_dc").each(function() {
		if(!isNaN(this.value) && this.value!='1') {		    
			sumTotal3 += parseFloat($('input[name=\'order_product[' + product_row1 + '][td015]\']').val());			
		}
		product_row1++;
    });
   
    form.tc011.value=Math.round(sumTotal);	  //原幣借方金額
  	form.tc012.value=Math.round(sumTotal1);	  //本幣貸方金額
    form.tc013.value=Math.round(sumTotal2);	  //原幣借方金額
  	form.tc014.value=Math.round(sumTotal3);	  //本幣貸方金額
	var sumTot =Math.round(sumTotal-sumTotal1);
  	$("#sum_tot").html(sumTot.toFixed(1));	
	var sumTot1 =Math.round(sumTotal2-sumTotal3);
 	$("#sum_tot1").html(sumTot1.toFixed(1));	
}
//--></script>