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
		 $('input[name=\'order_product['+vrow+'][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
		        smb001= $('#tb004'+vtj0 ).val();
			
			//  smb001= $('#tb004'+vtj0).val();
		//	 alert(smb001);			
		//	 alert(vrow);
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/inv/invi05/lookup/'+encodeURIComponent(smb001), 
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
			     $('input[name=\'order_product[' + n + '][tb008]\']').val(ui.item.value4);
				 $('input[name=\'order_product[' + n + '][tb012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][tb012disp]\']').val(ui.item.value6);
			     
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		
		//下拉視窗 網頁不更新  tb012  交貨庫別輸入
	
    $('input[name=\'order_product[0][tb012]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			    smb001= $('#tb012'+vtj0).val(); 
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/inv/invi05/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb012]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb012disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
         //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][tb009]\'],input[name=\'order_product['  + vrow +  '][tb010]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb010]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb011]\']').val(get_total);
		
		//totalSum1();
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tb003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tb003]\']').val(num_2); 
	});
	
	
	 // 數量游標停在 0 之後 
	$('input[name=\'order_product[' + vrow +  '][tb009]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
	   
	});
	 //金額 數量游標停在 0 之後 
	$('input[name=\'order_product['  + vrow +  '][tb010]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
	   
	});
	//庫別 
	$('input[name=\'order_product['  + vrow +  '][tb012]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		
	    totalSum1();
	});
	
	//專案
	$('input[name=\'order_product['  + vrow +  '][tb020]\']').focus(function(){
		totalSum1();
	});
	//備註,品號
  	$('input[name=\'order_product[' + vrow + '][tb017]\']').blur(function(){
		$('input[name=\'order_product['  + vrow +  '][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	}
//--></script>
 
