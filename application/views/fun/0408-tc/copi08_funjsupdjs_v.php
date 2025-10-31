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
	//  var product_row = 1 , vrow = 0, vtj0='0'; 
	  var temp_row = 0;
	var product_row = 0;
	for(temp_row=0;temp_row<totle_row;temp_row++){
		look_up_show(temp_row+1,temp_row,temp_row);
	}
	function look_up_show(product_row,vrow,vtj0){
		 $('input[name=\'order_product['+vrow+'][th004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			// smb001= $('#th0040').val();
			 smb001= $('#th004'+vtj0 ).val();
			
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi08/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][th004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][th005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][th006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][th009]\']').val(ui.item.value4);
				 $('input[name=\'order_product[' + n + '][th007]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][th007disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  th009  交貨庫別輸入
	
    $('input[name=\'order_product[0][th007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('th004').value;
			    smb001= $('#th007'+vtj0).val(); 
			//  smb001= $('#th0070').val(); 
			 
			//   smb001=$("#th004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi08/lookupa/'+encodeURIComponent(smb001), 
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
				// var n = vproduct_row;
                 $('input[name=\'order_product[' + n + '][th007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][th007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空 輸入不分含稅未稅
	$('input[name=\'order_product[' + vrow + '][th008]\'],input[name=\'order_product[' + vrow + '][th012]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		var input_1=$('input[name=\'order_product[' + n + '][th008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][th012]\']').val()*1;  
		var get_total=input_1*input_2; 	
		$('input[name=\'order_product[' + n + '][th013]\']').val(get_total); 
       // $('input[name=\'order_product[' + n + '][th035]\']').val(get_total); 
		//稅額
		 var taxp=0;amt1=0;
	    var taxp=$('input[name=\'tg044\']').val();  //稅率
		var amt1=get_total;
		var taxamt1=Math.round(amt1*taxp);
		$('input[name=\'order_product[' + n + '][th035]\']').val(amt1);
		$('input[name=\'order_product[' + n + '][th036]\']').val(taxamt1);
		
		var taxamt11=Math.round(amt1/(1+parseFloat(taxp))); //內含稅
		if ($('select[name=\'tg017\']').val()=='1') {$('input[name=\'order_product[' + n + '][th035]\']').val(taxamt11);}
		var amt2=amt1-taxamt11;   //內含稅
		
		//本幣金額稅額
	   if ($('select[name=\'tg017\']').val()=='1') {$('input[name=\'order_product[' + n + '][th036]\']').val(amt2);}
	   
	    var rate=$('input[name=\'tg012\']').val();  //匯率		
		var rateamt1=Math.round(amt1*rate);     //本幣金額 內含稅
		$('input[name=\'order_product[' + n + '][th037]\']').val(rateamt1);
		var ratetaxamt1=Math.round(rateamt1*taxp);  //本幣稅額
		
		var ratetaxamt11=Math.round(rateamt1/(1+parseFloat(taxp)));  //本幣稅額內含稅
		$('input[name=\'order_product[' + n + '][th038]\']').val(ratetaxamt1);	
		if ($('select[name=\'tg017\']').val()=='1') {$('input[name=\'order_product[' + n + '][th037]\']').val(ratetaxamt11);}
		
		var amt3=rateamt1-ratetaxamt11;   //內含稅
	   if ($('select[name=\'tg017\']').val()=='1') {$('input[name=\'order_product[' + n + '][th038]\']').val(amt3);}
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][th003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][th003]\']').val(num_2); 
		
	}); 
	
	
	//金額數量copy 銷售額
	$('input[name=\'order_product[' + vrow + '][th013]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][th013]\']').val()*1; 
	   //  $('input[name=\'order_product[' + n + '][th035]\']').val(input_1); 
	});
	
	   //數量游標停在 0 之後 
	$('input[name=\'order_product[' + vrow + '][th008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		//	$(this).val('');
	});
	  //單價  游標停在 0 之後
	$('input[name=\'order_product[' + vrow + '][th012]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		//	$(this).val('');
	});  
	 
	//訂單單號
	$('input[name=\'order_product[' + vrow + '][th014]\']').focus(function(){
		totalSum1();
	});
	//備註,品號
 	$('input[name=\'order_product[' + vrow + '][th018]\']').blur(function(){
		var vrow=vrow+1;
 		$('input[name=\'order_product[' + vrow + '][th004]\']').focus();
	});
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
		Enterkey();
	}
//--></script>
 
	