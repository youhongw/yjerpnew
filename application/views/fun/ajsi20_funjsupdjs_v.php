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
       //科目
       $('input[name=\'order_product['+vrow+'][tb005]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  
		   //   smb001= $('#tb0050').val();
			  smb001= $('#tb005'+vtj0 ).val();
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/act/acti10/lookupa/'+encodeURIComponent(smb001),
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
			 $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb005disp]\']').val(ui.item.value2);
			   //   $('input[name=\'order_product[' + n + '][tb013]\']').val(ui.item.value3);
				//   $('input[name=\'order_product[' + n + '][tb014]\']').val(ui.item.value4);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 		
		
		 $('input[name=\'order_product[['+vrow+'][tb006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			//  var vmb001=document.getElementById('tc004').value;
			smb001= $('#tb006'+vtj0 ).val();
		    //  smb001= $('#tb0060').val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/act/acti10/lookup/'+encodeURIComponent(smb001),
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
			  $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb006disp]\']').val(ui.item.value2);
			     
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
			
		
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][tb014]\'],input[name=\'order_product['  + vrow +  '][tb015]\']').focusout(function() { 
	 var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2);
		
	});
	
	// 原幣金額
	$('input[name=\'order_product[' + vrow + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td015]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
		//原幣copy 本幣test
	$('input[name=\'order_product[' + vrow + '][tb007]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb015]\']').val()*1*$('input[name=\'order_product[' + n + '][tb014]\']').val(); 
	  		
		if ($('select[name=\'order_product[' + n + '][tb004]\']').val()=='1') {
		$('input[name=\'order_product[' + n + '][tb0071]\']').val(input_1);$('input[name=\'order_product[' + n + '][tb0072]\']').val(0);} else {
		$('input[name=\'order_product[' + n + '][tb0072]\']').val(input_1);$('input[name=\'order_product[' + n + '][tb0071]\']').val(0);} 
	});	
	//原幣copy 本幣
	$('input[name=\'order_product[' + vrow +'][tb007]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb015]\']').val()*1*$('input[name=\'order_product[' + n + '][tb014]\']').val(); 		
	     $('input[name=\'order_product[' + n + '][tb007]\']').val(input_1); 
		
		totalSum1(vrow);
	});	
	
    //摘要
    $('input[name=\'order_product[' + vrow + '][tb010]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	// 	totalSum9();
	});
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	//product_row++;
    }
//--></script>

 