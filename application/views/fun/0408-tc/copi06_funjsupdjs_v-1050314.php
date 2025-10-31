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
		 $('input[name=\'order_product[0][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td0040').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[0][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td0070').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
 
	<!-- javascrit 明細1 -->	  	 
     <script type="text/javascript"><!--
         var product_row = 2, vrow = 1, vtj0='1'; 	 
     
		 $('input[name=\'order_product[1][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td0041').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[1][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td0071').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = 3, vrow = 2, vtj0='2'; 
       
	 $('input[name=\'order_product['  + vrow +  '][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td004'+vtj0).val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product['  + vrow +  '][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td007'+vtj0).val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
 

     <script type="text/javascript"><!--
         var product_row = 4, vrow = 3, vtj0='3';  
     $('input[name=\'order_product[3][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td0043').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[3][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td0073').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>


     <script type="text/javascript"><!--
         var product_row = 5, vrow = 4, vtj0='4'; 
	 
	 $('input[name=\'order_product[4][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td0044').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[4][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td0074').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = 6, vrow = 5, vtj0='5'; 
	 
	 $('input[name=\'order_product[5][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td0045').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[5][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td0075').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = 7, vrow = 6, vtj0='6'; 
	 
		 $('input[name=\'order_product[6][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td0046').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[6][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td0076').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = 8, vrow = 7, vtj0='7'; 
	 
	 $('input[name=\'order_product[7][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td0047).val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[7][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td0077').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = 9, vrow = 8, vtj0='8'; 
	 
	 $('input[name=\'order_product[8][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td0048').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[8][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td0078').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = 10, vrow = 9, vtj0='9'; 
	 
	 $('input[name=\'order_product[9][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td0049').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[9][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td0079').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
    <script type="text/javascript"><!--
         var product_row = 11, vrow = 10, vtj0='10'; 
	 
	 $('input[name=\'order_product[10][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td00410').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[10][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td00710').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = 12, vrow = 11, vtj0='11'; 
	 
	 $('input[name=\'order_product[11][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td00411').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[11][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td00711').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = 13, vrow = 12, vtj0='12'; 
	 
	 $('input[name=\'order_product[12][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td00412').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product['  + vrow +  '][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td007'+vtj0).val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = 14, vrow = 13, vtj0='13'; 
	 
		 $('input[name=\'order_product[13][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td00413').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[13][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td00713').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = 15, vrow = 14, vtj0='14'; 
	 
	 $('input[name=\'order_product[14][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td00414').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[14][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td00714').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = 16, vrow = 15, vtj0='15'; 
	 
	 $('input[name=\'order_product[15][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td00415').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[15][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td00715').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = 17, vrow = 16, vtj0='16'; 
	 
	 $('input[name=\'order_product[16][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td00416').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[16][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td00716').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = 18, vrow = 17, vtj0='17'; 
	 
	 $('input[name=\'order_product[17][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td00417').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[17][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td00717').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = 19, vrow = 18, vtj0='18'; 
	 
	 $('input[name=\'order_product[18][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td00418').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[18][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td00718').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = 20, vrow = 19, vtj0='19'; 
	 
	 $('input[name=\'order_product[19][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td00419').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[19][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td00719').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = 21, vrow = 20, vtj0='20'; 
	 
	 $('input[name=\'order_product[20][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td00420').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[20][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td00720').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = 22, vrow = 21, vtj0='21'; 
	 
	 $('input[name=\'order_product[21][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td00421').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[21][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td00721').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = 23, vrow = 22, vtj0='22'; 
	 
	 $('input[name=\'order_product[22][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td00422').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[22][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td00722').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = 24, vrow = 23, vtj0='23'; 
	 
	 $('input[name=\'order_product[23][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td00423').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[23][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td00723').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = 25, vrow = 24, vtj0='24'; 
	 
	 $('input[name=\'order_product[24][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td00424').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[24][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td00724').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = 26, vrow = 25, vtj0='25'; 
	 
	 $('input[name=\'order_product[25][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td00425').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[25][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td00725').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = 27, vrow = 26, vtj0='26'; 
	 
	 $('input[name=\'order_product[26][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td00426').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[26][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td00726').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = 28, vrow = 27, vtj0='27'; 
	 
	 $('input[name=\'order_product[27][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td00427').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[27][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td00727').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = 29, vrow = 28, vtj0='28'; 
	 
	 $('input[name=\'order_product[28][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td00428').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[28][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td00728').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
<script type="text/javascript"><!--
         var product_row = 30, vrow = 29, vtj0='29'; 
	 
	 $('input[name=\'order_product[29][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td00429').val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[29][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			  smb001= $('#td00729').val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空0
	$('input[name=\'order_product['  + vrow +  '][td008]\'],input[name=\'order_product['  + vrow +  '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //數量
	
	$('input[name=\'order_product['  + vrow +  '][td008]\']').blur(function(){
	totalSum();
			
			
	});
	   //材積 
	$('input[name=\'order_product['  + vrow +  '][td031]\']').blur(function(){
		 totalSum();
	});
	
	$('input[name=\'order_product['  + vrow +  '][td020]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product['  + product_row +  '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

<script type="text/javascript"><!--  //合計金額

function totalSum11() {

    var sumTotal =0;
	var sumQty = 0;
	var product_row = 0; 
	var sumTax =0; 
	var tax =0;
    $(".total_price").each(function() {
		if(!isNaN(this.value) && this.value.length!=0) {
			sumTotal += parseFloat(this.value);			
		}
    });
	
	$(".total_qty").each(function() {
		if(!isNaN(this.value) && this.value.length!=0) {
			sumQty += parseFloat(this.value);			
		}
    });
    
    $("#sum_total").html(sumTotal.toFixed(1));
  	form.tc019.value=Math.round(sumTotal);	
	  tax=$('input[name=\'tc026\']').val();
	form.tc020.value=Math.round(sumTotal*tax);
	var sumTax =Math.round(sumTotal*tax);
	
	if ($('select[name=\'tc018\']').val()=='1') {form.tc019.value=Math.round(sumTotal-sumTax);sumTotal=Math.round(sumTotal-sumTax);}
	var sumTot =Math.round(sumTotal+sumTax);
    $("#sum_tax").html(sumTax.toFixed(1));	
	$("#sum_tot").html(sumTot.toFixed(1));	
	form.tc023.value=Math.round(sumQty);	
}
//--></script>