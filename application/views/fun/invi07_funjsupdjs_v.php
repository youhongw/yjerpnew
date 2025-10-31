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
		 $('input[name=\'order_product['+vrow+'][tk004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
		
			
			smb001= $('#tk004'+vtj0 ).val();
			
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/inv/invi07/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tk004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tk005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tk006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tk006disp]\']').val(ui.item.value4);
				 $('input[name=\'order_product[' + n + '][tk017]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][tk017disp]\']').val(ui.item.value6);
			     
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		
		//下拉視窗 網頁不更新  tk017  交貨庫別輸入
	
    $('input[name=\'order_product['+vrow+'][tk017]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			 smb001= $('#tk017'+vtj0).val(); 
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/inv/invi07/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tk017]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tk017disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
         //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][tk007]\'],input[name=\'order_product['  + vrow +  '][tk016]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tk007]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tk016]\']').val()*1;  
	//	var get_total=input_1*input_2;  
	//	$('input[name=\'order_product[' + n + '][tk010]\']').val(get_total);
		
		//totalSum1();
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tk003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tk003]\']').val(num_2); 
	});
	
	
	 // 數量游標停在 0 之後 
	$('input[name=\'order_product[' + vrow +  '][tk007]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
	   
	});
	 //金額 數量游標停在 0 之後 
	$('input[name=\'order_product['  + vrow +  '][tk016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
	   
	});
	//庫別 
	$('input[name=\'order_product['  + vrow +  '][tk017]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		
	    totalSum1();
	});
	
	//專案
	$('input[name=\'order_product['  + vrow +  '][tk021]\']').focus(function(){
		totalSum1();
	});
	//備註,品號
  	$('input[name=\'order_product[' + vrow + '][tk022]\']').blur(function(){
		$('input[name=\'order_product['  + vrow +  '][tk004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	}
//--></script>