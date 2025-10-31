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
		 $('input[name=\'order_product['+vrow+'][tj004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
		     smb001= $('#tj004'+vtj0 ).val();
		//	 alert(smb001);			
		//	 alert(vrow);
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi02/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tj004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tj003disp]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tj003disp1]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tj003disp2]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		  
       //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][tj008]\'],input[name=\'order_product['  + vrow +  '][tj011]\']').focusout(function() { 
	  //	var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tj003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tj003]\']').val(num_2); 
	
		
	});
	
	   //單價  
	$('input[name=\'order_product['+ vrow + '][tj008\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		//	$(this).val('');
	});
            
	$('input[name=\'order_product[' + vrow + '][tj008]\']').blur(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	$('input[name=\'order_product['  + vrow + '][tj010]\']').blur(function(){
		$('input[name=\'order_product['  + vrow + '][tj004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
Enterkey();
	}
//--></script>
 
