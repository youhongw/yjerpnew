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
       
		 $('input[name=\'order_product['  + vrow +  '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('tc004').value;
		      smb001= $('#td006'+vtj0).val();
			 var utd005=$('select[name=\'order_product[' + vtj0 + '][td005]\']').val();
			 			
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/acp/acpi03/"+'lookup'+utd005+'/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001), 
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
	}
//--></script>
