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
	  
	   $('input[name=\'order_product['+vrow+'][mk002]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			 
			 smb001= $('#mk002'+vtj0 ).val();
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup/'+encodeURIComponent(smb001), 
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
                  $('input[name=\'order_product[' + n + '][mk002]\']').val(ui.item.value2);
                  $('input[name=\'order_product[' + n + '][mk004]\']').val(ui.item.value1);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
		
	$('input[name=\'order_product[0][mk005]\']').blur(function(){
		$('input[name=\'order_product[1][mk002]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
//--></script>
