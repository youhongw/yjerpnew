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
	  //product_row = temp_row+1, vrow = temp_row, vtj0=String(temp_row);
	 // alert('input[name=\'order_product['+vrow+'][td004]\']');
	 // alert($('input[name=\'order_product['+vrow+'][td004]\']').val());
		 $('input[name=\'order_product['+vrow+'][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#td004'+vtj0 ).val();
			 
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
	 //數量游標停在 0 之後 欄位全選(MODI)
	$('input[name=\'order_product[' + vrow + '][td008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
	//	document.getElementById('td008').select();
	});
	//單價游標停在 0 之後 欄位全選(MODI)
	$('input[name=\'order_product[' + vrow + '][td011]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		// document.getElementById('td011').select();
	});
	   //金額  
	$('input[name=\'order_product['+ vrow + '][td012]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
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
	}
//--></script>

