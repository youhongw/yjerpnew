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
	  
	   $('input[name=\'order_product[0][mh002]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#mh0020').val();
			
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/act/acti07/lookup/'+encodeURIComponent(smb001), 
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
                  $('input[name=\'order_product[' + n + '][mh002]\']').val(ui.item.value1);
                  $('input[name=\'order_product[' + n + '][mh003]\']').val(ui.item.value2);
			       $('input[name=\'order_product[' + n + '][mh004]\']').val(ui.item.value3);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
		
	$('input[name=\'order_product[0][mh004]\']').blur(function(){
		$('input[name=\'order_product[1][mh002]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
 
	<!-- javascrit 明細1 -->	  	 
     <script type="text/javascript"><!--
         var product_row = "2"; 	 
        $('input[name=\'order_product[1][mh002]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#mh0021').val();
			
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/act/acti07/lookup/'+encodeURIComponent(smb001), 
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
                  $('input[name=\'order_product[' + n + '][mh002]\']').val(ui.item.value1);
                  $('input[name=\'order_product[' + n + '][mh003]\']').val(ui.item.value2);
			       $('input[name=\'order_product[' + n + '][mh004]\']').val(ui.item.value3);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
		
		$('input[name=\'order_product[1][mh004]\']').blur(function(){
		$('input[name=\'order_product[2][mh002]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "3"; 	 
        $('input[name=\'order_product[2][mh002]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#mh0022').val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/act/acti07/lookup/'+encodeURIComponent(smb001), 
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
                   $('input[name=\'order_product[' + n + '][mh002]\']').val(ui.item.value1);
                  $('input[name=\'order_product[' + n + '][mh003]\']').val(ui.item.value2);
			       $('input[name=\'order_product[' + n + '][mh004]\']').val(ui.item.value3);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
		
		$('input[name=\'order_product[2][mh004]\']').blur(function(){
		$('input[name=\'order_product[3][mh002]\']').focus();
	});
  
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>
 

     <script type="text/javascript"><!--
         var product_row = "4"; 
	    $('input[name=\'order_product[3][mh002]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#mh0023').val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/act/acti07/lookup/'+encodeURIComponent(smb001), 
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
                   $('input[name=\'order_product[' + n + '][mh002]\']').val(ui.item.value1);
                  $('input[name=\'order_product[' + n + '][mh003]\']').val(ui.item.value2);
			       $('input[name=\'order_product[' + n + '][mh004]\']').val(ui.item.value3);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
	$('input[name=\'order_product[3][mh004]\']').blur(function(){
		$('input[name=\'order_product[4][mh002]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>


     <script type="text/javascript"><!--
         var product_row = "5"; 
	    $('input[name=\'order_product[4][mh002]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#mh0024').val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/act/acti07/lookup/'+encodeURIComponent(smb001), 
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
                  $('input[name=\'order_product[' + n + '][mh002]\']').val(ui.item.value1);
                  $('input[name=\'order_product[' + n + '][mh003]\']').val(ui.item.value2);
			       $('input[name=\'order_product[' + n + '][mh004]\']').val(ui.item.value3);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
	$('input[name=\'order_product[4][mh004]\']').blur(function(){
		$('input[name=\'order_product[5][mh002]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

 <script type="text/javascript"><!--
         var product_row = "6"; 
	    $('input[name=\'order_product[5][mh002]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#mh0025').val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/act/acti07/lookup/'+encodeURIComponent(smb001), 
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
                   $('input[name=\'order_product[' + n + '][mh002]\']').val(ui.item.value1);
                  $('input[name=\'order_product[' + n + '][mh003]\']').val(ui.item.value2);
			       $('input[name=\'order_product[' + n + '][mh004]\']').val(ui.item.value3);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
	$('input[name=\'order_product[5][mh004]\']').blur(function(){
		$('input[name=\'order_product[6][mh002]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "7";
	    $('input[name=\'order_product[6][mh002]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#mh0026').val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/act/acti07/lookup/'+encodeURIComponent(smb001), 
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
                   $('input[name=\'order_product[' + n + '][mh002]\']').val(ui.item.value1);
                  $('input[name=\'order_product[' + n + '][mh003]\']').val(ui.item.value2);
			       $('input[name=\'order_product[' + n + '][mh004]\']').val(ui.item.value3);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
	$('input[name=\'order_product[6][mh004]\']').blur(function(){
		$('input[name=\'order_product[7][mh002]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "8"; 
	    $('input[name=\'order_product[7][mh002]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#mh0027').val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/act/acti07/lookup/'+encodeURIComponent(smb001), 
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
                  $('input[name=\'order_product[' + n + '][mh002]\']').val(ui.item.value1);
                  $('input[name=\'order_product[' + n + '][mh003]\']').val(ui.item.value2);
			       $('input[name=\'order_product[' + n + '][mh004]\']').val(ui.item.value3);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
	$('input[name=\'order_product[7][mh004]\']').blur(function(){
		$('input[name=\'order_product[8][mh002]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "9";
	     $('input[name=\'order_product[8][mh002]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#mh0028').val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/act/acti07/lookup/'+encodeURIComponent(smb001), 
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
                  $('input[name=\'order_product[' + n + '][mh002]\']').val(ui.item.value1);
                  $('input[name=\'order_product[' + n + '][mh003]\']').val(ui.item.value2);
			       $('input[name=\'order_product[' + n + '][mh004]\']').val(ui.item.value3);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
	$('input[name=\'order_product[8][mh004]\']').blur(function(){
		$('input[name=\'order_product[9][mh002]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>

     <script type="text/javascript"><!--
         var product_row = "10"; 
	    $('input[name=\'order_product[9][mh002]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#mh0029').val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/act/acti07/lookup/'+encodeURIComponent(smb001), 
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
                   $('input[name=\'order_product[' + n + '][mh002]\']').val(ui.item.value1);
                  $('input[name=\'order_product[' + n + '][mh003]\']').val(ui.item.value2);
			       $('input[name=\'order_product[' + n + '][mh004]\']').val(ui.item.value3);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
	$('input[name=\'order_product[9][mh004]\']').blur(function(){
		$('input[name=\'order_product[10][mh002]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
//--></script>