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
	  
		 $('input[name=\'order_product['+vrow+'][tj004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
					
			 // smb001= $('#tj0040').val();
		      smb001= $('#tj004'+vtj0).val();
			  //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri11/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tj004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tj005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tj006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tj007]\']').val(ui.item.value4);
				 $('input[name=\'order_product[' + n + '][tj011]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][tj011disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  tj011  交貨庫別輸入
	
    $('input[name=\'order_product['  + vrow +  '][tj011]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tj004').value;
			   
			//  smb001= $('#tj0111').val(); 
			   smb001= $('#tj011'+vtj0).val();
			//   smb001=$("#tj004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri11/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tj011]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tj011disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
		  
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][tj009]\'],input[name=\'order_product['  + vrow +  '][tj008]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	//    var n = vproduct_row;
		var input_1=$('input[name=\'order_product[' + n + '][tj009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tj008]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tj010]\']').val(get_total); 
     //稅額
		 var taxp=0;amt1=0;
	    var taxp=$('input[name=\'ti027\']').val();  //稅率
		var amt1=get_total;
		var taxamt1=Math.round(amt1*taxp);
		$('input[name=\'order_product[' + n + '][tj030]\']').val(amt1);
		$('input[name=\'order_product[' + n + '][tj031]\']').val(taxamt1);
		
		
		var taxamt11=Math.round(amt1/(1+parseFloat(taxp))); //內含稅
		if ($('select[name=\'ti009\']').val()=='1') {$('input[name=\'order_product[' + n + '][tj030]\']').val(taxamt11);}
		var amt2=amt1-taxamt11;   //內含稅
		//本幣金額稅額
	   if ($('select[name=\'ti009\']').val()=='1') {$('input[name=\'order_product[' + n + '][tj031]\']').val(amt2);}
	   
	     var rate=$('input[name=\'ti007\']').val();  //匯率		
		var rateamt1=Math.round(amt1*rate);     //本幣金額
		$('input[name=\'order_product[' + n + '][tj032]\']').val(rateamt1);
		var ratetaxamt1=Math.round(rateamt1*taxp);  //本幣稅額
		$('input[name=\'order_product[' + n + '][tj033]\']').val(ratetaxamt1);	
		
		var ratetaxamt11=Math.round(rateamt1/(1+parseFloat(taxp)));  //本幣稅額內含稅
		$('input[name=\'order_product[' + n + '][tj033]\']').val(ratetaxamt1);	
		if ($('select[name=\'ti009\']').val()=='1') {$('input[name=\'order_product[' + n + '][tj032]\']').val(ratetaxamt11);}
		
		var amt3=rateamt1-ratetaxamt11;   //內含稅
	   if ($('select[name=\'ti009\']').val()=='1') {$('input[name=\'order_product[' + n + '][tj033]\']').val(amt3);}
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][tj003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tj003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tj003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][tj003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][tj003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	   //數量
	$('input[name=\'order_product['  + vrow +  '][tj009]\']').blur(function(){	    
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()=='')
			$(this).val(real_value);
	});
	
	
	   //單價  
	$('input[name=\'order_product['  + vrow +  '][tj008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		//	$(this).val('');
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product['  + vrow +  '][tj010]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tj010]\']').val()*1; 
	  //   $('input[name=\'order_product[' + n + '][tj030]\']').val(input_1); 
	});
	
	
	//採購單號
	$('input[name=\'order_product['  + vrow +  '][tj013]\']').focus(function(){
		totalSum1();
	});
	//備註,品號
//	$('input[name=\'order_product[' + product_row + '][tj033]\']').blur(function(){
//		$('input[name=\'order_product[' + product_row + '][tj004]\']').focus();
//	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
		}
//--></script>
 
