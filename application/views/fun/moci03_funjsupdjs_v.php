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
	var totle_row = $('#row_count').val();
	var temp_row = 0;
	var product_row = 0;
	for(temp_row=0;temp_row<totle_row;temp_row++){
		look_up_show(temp_row+1,temp_row,temp_row);
	}
	function look_up_show(product_row,vrow,vtj0){
		 $('input[name=\'order_product['+vrow+'][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			  smb001= $('#td004'+vtj0 ).val();
			
			// alert(smb001);
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri07/lookup/'+encodeURIComponent(smb001), 
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
			     $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value4);
				  $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value5);
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product['+vrow+'][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			   smb001= $('#td007'+vtj0).val(); 
			 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri07/lookupa/'+encodeURIComponent(smb001), 
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
	$('input[name=\'order_product[' + vrow + '][td008]\'],input[name=\'order_product[' + vrow + '][td010]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td010]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td011]\']').val(get_total); 		
		totalSum();
		//流水號
	//	var num_1 = 1000;
	//	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
	//	var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
	 //   $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
		//alert(num_2);
		
	});
	   //數量
	$('input[name=\'order_product[' + vrow + '][td008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
            
	$('input[name=\'order_product[' + vrow + '][td008]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
			
			
	});
	   //單價  
	$('input[name=\'order_product[' + vrow + '][td010]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		   $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[' + vrow + '][td010]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	$('input[name=\'order_product[' + vrow + '][td014]\']').blur(function(){
		var vrow=vrow+1;
		$('input[name=\'order_product[1][td004]\']').focus();
	});
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	}
//--></script>
 