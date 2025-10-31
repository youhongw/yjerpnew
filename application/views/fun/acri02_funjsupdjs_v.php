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
       
		 $('input[name=\'order_product['  + vrow +  '][tb005]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			
			  var vmb001=document.getElementById('ta004').value;
		      smb001= $('#tb005'+vtj0).val();
			    //  alert(smb001);
	
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acr/acri02/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001),
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
                  $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb008]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb009]\']').val(ui.item.value5);
			     $('input[name=\'order_product[' + n + '][tb017]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][tb018]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][tb019]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][tb020]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][tb021]\']').val(ui.item.value9);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		  
		 //下拉視窗 網頁不更新  tb013 科目代號輸入
	
    $('input[name=\'order_product['  + vrow +  '][tb013]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			   
			  smb001= $('#tb013'+vtj0).val();
			//   smb001=$("#th004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acr/acri02/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb013]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb013disp]\']').val(ui.item.value2);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		
		 //下拉視窗 網頁不更新  tb021 部門代號輸入
	
    $('input[name=\'order_product['  + vrow +  '][tb021]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			   
			  smb001= $('#tb021'+vtj0).val();
			//   smb001=$("#th004"+(product_row-1)).val();
			  //   alert(smb001);
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acr/acri02/lookupb/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb021]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb021disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
    //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product['  + vrow +  '][tb009]\'],input[name=\'order_product['  + vrow +  '][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	//    var n = vproduct_row;
			var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		
		var get_total=input_1*1;  
		$('input[name=\'order_product[' + n + '][tb017]\']').val(get_total); 
     
	    var taxp=0;amt1=0;
	    var taxp=$('input[name=\'ta040\']').val();  //稅率
		var amt1=$('input[name=\'order_product[' + n + '][tb009]\']').val();
		var taxamt1=Math.round(amt1*taxp);
		$('input[name=\'order_product[' + n + '][tb018]\']').val(taxamt1);
		$('input[name=\'order_product[' + n + '][tb017]\']').val(amt1);
		
	//	totalSum1();
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tb003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tb003]\']').val(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product[' + vrow + '][tb009]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][tb017]\']').val(input_1); 
	});
	
	 //原幣稅額  
	$('input[name=\'order_product[' + vrow +  '][tb018]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	    var taxp=0;amt1=0;
	    var taxp=$('input[name=\'ta040\']').val();  //稅率
		var amt1=$('input[name=\'order_product[' + n + '][tb017]\']').val();
		var taxamt1=Math.round(amt1*taxp);
		$('input[name=\'order_product[' + n + '][tb018]\']').val(taxamt1);
		$('input[name=\'order_product[' + n + '][tb017]\']').val(amt1);
	    if ($('select[name=\'ta012\']').val()=='1') {$('input[name=\'order_product[' + n + '][tb017]\']').val()=Math.round(amt1-taxamt1);}
		
	});
	//本幣貨幣, 稅額  
	$('input[name=\'order_product[' + vrow +  '][tb019]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	    var rate=0;amt1=0;
	    var taxp=$('input[name=\'ta040\']').val();  //稅率
	    var rate=$('input[name=\'ta010\']').val();  //匯率
		var amt1=$('input[name=\'order_product[' + n + '][tb017]\']').val();
		var rateamt1=Math.round(amt1*rate);     //本幣金額
		$('input[name=\'order_product[' + n + '][tb019]\']').val(rateamt1);
		var taxamt1=Math.round(rateamt1*taxp);  //本幣稅額
		$('input[name=\'order_product[' + n + '][tb020]\']').val(taxamt1);
		
	    if ($('select[name=\'ta012\']').val()=='1') {$('input[name=\'order_product[' + n + '][tb019]\']').val()=Math.round(rateamt1-taxamt1);}
		totalSum1();
	});
    //備註  
	$('input[name=\'order_product[' + vrow +  '][tb011]\']').focus(function(){
		totalSum1();
     });
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	}
//--></script>
