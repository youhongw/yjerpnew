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
			 
			  smb001= $('#th004'+vtj0 ).val();
			  
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri09/lookup/'+encodeURIComponent(smb001), 
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
			     $('input[name=\'order_product[' + n + '][th008]\']').val(ui.item.value4);
				 $('input[name=\'order_product[' + n + '][th009]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][th009disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  th009  交貨庫別輸入
	
    $('input[name=\'order_product['+vrow+'][th009]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			      smb001= $('#th009'+vtj0).val(); 
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri09/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][th009]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][th009disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
      //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + vrow + '][th016]\'],input[name=\'order_product[' + vrow + '][th018]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	//	var n = vproduct_row;
		var input_1=$('input[name=\'order_product[' + n + '][th016]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][th018]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][th045]\']').val(get_total); 
	 var taxp=0;amt1=0;
	    var taxp=$('input[name=\'tg030\']').val();  //稅率
		var amt1=$('input[name=\'order_product[' + n + '][th045]\']').val();
		var taxamt1=Math.round(amt1*taxp);
		$('input[name=\'order_product[' + n + '][th046]\']').val(taxamt1);
		
	    if ($('select[name=\'tg010\']').val()=='1') {$('input[name=\'order_product[' + n + '][th045]\']').val()=Math.round(amt1-taxamt1);}
	    var taxp=$('input[name=\'tg030\']').val();  //稅率
	    var rate=$('input[name=\'tg008\']').val();  //匯率
		var amt1=$('input[name=\'order_product[' + n + '][th045]\']').val();
		var rateamt1=Math.round(amt1*rate);     //本幣金額
		$('input[name=\'order_product[' + n + '][th047]\']').val(rateamt1);
		var taxamt1=Math.round(rateamt1*taxp);  //本幣稅額
		$('input[name=\'order_product[' + n + '][th048]\']').val(taxamt1);
		
	    if ($('select[name=\'tg010\']').val()=='1') {$('input[name=\'order_product[' + n + '][th047]\']').val()=Math.round(rateamt1-taxamt1);}

		
		totalSum1();
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][th003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][th003]\']').val(num_2); 
		
	});
		   //驗收日期
	$('input[name=\'order_product[' + vrow + '][th014]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		//var n=vproduct_row;
		var date1=date("Y/m/d");
	//	alert(date1);
		$('input[name=\'order_product[' + n + '][th014]\']').val(date1);
		 $(".date").html(date1.toFixed(1));
	});
	
	//進貨數量
	$('input[name=\'order_product[' + vrow + '][th007]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
	  	if ($(this).val()==real_value)
		     $(this).val(real_value);
			//$(this).val('');
	});
	//進貨數量
	$('input[name=\'order_product[' + product_row + '][th007]\']').focusout(function(){
		var real_value = $(this)[0].defaultValue;
	  	if ($(this).val()==real_value)
		     $(this).val(real_value);
			 if ($(this).val()=='')
		   	  $(this).val('0');
	});
	
	//進貨數量copy 驗收數量
	$('input[name=\'order_product[' + vrow + '][th015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		//var n = vproduct_row;
		var input_1=$('input[name=\'order_product[' + n + '][th007]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][th015]\']').val(input_1); 
	});
	   //計價數量
	$('input[name=\'order_product[' + vrow + '][th016]\']').focus(function(){
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	//	var n = vproduct_row;
		var input_3=$('input[name=\'order_product[' + n + '][th015]\']').val()*1;  
		var input_4=$('input[name=\'order_product[' + n + '][th017]\']').val()*1;  
		var get_total1=input_3-input_4;  
		$('input[name=\'order_product[' + n + '][th016]\']').val(get_total1); 		
	});  
	
	   //單價  
	$('input[name=\'order_product[' + vrow + '][th018]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		//	$(this).val('');
	});
	 //單價  
	$('input[name=\'order_product[' + product_row + '][th018]\']').focusout(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
			 if ($(this).val()=='')
		   	  $(this).val('0');
	});
	
	 //原幣稅額  
	$('input[name=\'order_product[' + vrow + '][th046]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  //  var n = vproduct_row;
		var taxp=0;amt1=0;
	    var taxp=$('input[name=\'tg030\']').val();  //稅率
		var amt1=$('input[name=\'order_product[' + n + '][th045]\']').val();
		var taxamt1=Math.round(amt1*taxp);
		$('input[name=\'order_product[' + n + '][th046]\']').val(taxamt1);
		
	    if ($('select[name=\'tg010\']').val()=='1') {$('input[name=\'order_product[' + n + '][th045]\']').val()=Math.round(amt1-taxamt1);}
		
	});
	//本幣貨幣, 稅額  
	$('input[name=\'order_product[' + vrow + '][th047]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
    //   var n = vproduct_row;	   
	   var rate=0;amt1=0;
	    var taxp=$('input[name=\'tg030\']').val();  //稅率
	    var rate=$('input[name=\'tg008\']').val();  //匯率
		var amt1=$('input[name=\'order_product[' + n + '][th045]\']').val();
		var rateamt1=Math.round(amt1*rate);     //本幣金額
		$('input[name=\'order_product[' + n + '][th047]\']').val(rateamt1);
		var taxamt1=Math.round(rateamt1*taxp);  //本幣稅額
		$('input[name=\'order_product[' + n + '][th048]\']').val(taxamt1);
		
	    if ($('select[name=\'tg010\']').val()=='1') {$('input[name=\'order_product[' + n + '][th047]\']').val()=Math.round(rateamt1-taxamt1);}
		totalSum1();
	});
	//採購單號
	$('input[name=\'order_product[' + vrow + '][th012]\']').focus(function(){
		totalSum1();
	});
	//備註,品號
 	$('input[name=\'order_product[' + vrow + '][th033]\']').blur(function(){
		var vrow=vrow+1;
 		$('input[name=\'order_product[' + vrow + '][th004]\']').focus();
	});
  
		$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
		Enterkey();
	}
//--></script>
 
