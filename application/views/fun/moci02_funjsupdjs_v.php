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
	 // var product_row = 1; vproduct_row = 0;
	  var totle_row = $('#row_count').val();
	var temp_row = 0;
	var product_row = 0;
	for(temp_row=0;temp_row<totle_row;temp_row++){
		look_up_show(temp_row+1,temp_row,temp_row);
	}
	function look_up_show(product_row,vrow,vtj0){
		 $('input[name=\'order_product['+vrow+'][tb003]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#tb0030').val();
			
			// alert(smb001);
		//	   alert('test0');
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/moc/moci02/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb003]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb012]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb013]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb007]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][tb009]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][tb009disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		//下拉視窗 網頁不更新  tb009  交貨庫別輸入
	
    $('input[name=\'order_product['+vrow+'][tb009]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tb003').value;
			  
			  smb001= $('#tb009'+vtj0).val();
			//   smb001=$("#tb003"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/moc/moci02/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb009]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb009disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
		  
     //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + vrow + '][tb004]\'],input[name=\'order_product[' + product_row + '][tb005]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	//    var n = vproduct_row;
		var input_1=$('input[name=\'order_product[' + n + '][tb004]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb005]\']').val()*1;  
		var get_total=input_1-input_2;  
		$('input[name=\'order_product[' + n + '][tb016]\']').val(get_total); 
   
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tb008]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tb008]\']').val(num_2); 
	
		
	});
	
	//需領用量
	$('input[name=\'order_product[' + vrow + '][tb004]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
	  	if ($(this).val()==real_value)
		     $(this).val(real_value);
		
			//$(this).val('');
	});
	//零領用量copy 未領用量
	$('input[name=\'order_product[' + vrow + '][tb016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb004]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][tb016]\']').val(input_1); 
	});
	   //未領用量
	$('input[name=\'order_product[' + vrow + '][tb016]\']').focus(function(){
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_3=$('input[name=\'order_product[' + n + '][tb004]\']').val()*1;  
		var input_4=$('input[name=\'order_product[' + n + '][tb005]\']').val()*1;  
		var get_total1=input_3-input_4;  
		$('input[name=\'order_product[' + n + '][tb016]\']').val(get_total1); 		
	}); 
	
	//材料型態
	$('input[name=\'order_product[' + vrow + '][tb011]\']').focus(function(){
	//	totalSum1();
	});
	
	   //預計領料日期
	$('input[name=\'order_product[' + vrow + '][tb015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var date1=date("Y/m/d");
		$('input[name=\'order_product[' + n + '][tb015]\']').val(date1);
		 $(".date").html(date1.toFixed(1));
		 var vrow=vrow+1;
	});
	//備註,品號
//	$('input[name=\'order_product[' + product_row + '][tb017]\']').blur(function(){
//		$('input[name=\'order_product[' + product_row + '][tb003]\']').focus();
//	});
	
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	}
	//product_row++;
//--></script>