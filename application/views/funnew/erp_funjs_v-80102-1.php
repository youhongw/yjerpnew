<!-- 不更新網頁 自動提示方框資料google 提示前置小工具 --> 
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
<script>
var no_col = "<?php echo $no_col; ?>";	//序號欄位
var col_array = <?php echo json_encode($col_array); ?>;
var usecol_array = <?php echo json_encode($usecol_array); ?>;
var current_count = <?php echo $current_product_count; ?>;
var selected_row = 0;
$(document).ready(function(){
	for(var i=1;i<=current_count;i++){
		set_catcomplete(i);
		set_catcomplete2(i);
		//set_catcomplete3(i);
	}
});
function get_max_no(){
	var max_no = 1000;
	$('.product_row .order_product_'+no_col).each(function(){
		if($( this ).val() > max_no){
			max_no = $( this ).val();
		}
	});
	return max_no;
}
//取最近匯率
function check_rate(){
	$('#exchange_rate').val("1");
	var cmsi06 = $('#cmsi06').val();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi06/check_rate",
		data: {
			cmsi06: cmsi06
		}
	})
	.done(function( msg ) {
		$('#exchange_rate').val("1");
		$('#exchange_rate').val(msg);
		console.log(msg);
	});
}
//課稅別稅率taxrate sysma004 共用變數0.05
function seltaxes(){
	  var selval = document.getElementById('taxes').selectedIndex;
	  if (selval==0) {  $('#taxrate').val(<?php echo $this->session->userdata('sysma004') ?>);}	    
      else if (selval==1){  $('#taxrate').val(<?php echo $this->session->userdata('sysma004') ?>);}
	  else {  $('#taxrate').val("0");}
}
//確認碼
 function selverify(){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	  var selval = document.getElementById('verify').selectedIndex;
	 //  alert(selval);
	   var oSpan = document.getElementById("approved");
	  if (selval==0) {
	     oSpan.innerHTML = "<span style='color:red'> 核准</span>";}
        else
		{ oSpan.innerHTML = "<span style='color:red'> 未核</span>";}
	 if (selval==2) {
	     oSpan.innerHTML = "<span style='color:red'> 作廢</span>";}
}
</script>
<script>
//新增一筆明細
function addItem(){
	//current_count = 0;
	var max_no = get_max_no();
	//$(".total_qty").each(function(index, element) {    //欄位要有一欄data_class 是 total_qty 才可以相加
	//	current_count +=1;
    //});
	current_count++;
	
	console.log(current_count);
	
	var append_str = "";
	var type = "";
	append_str += "<tbody id='product_row_"+current_count+"' class='product_row' >";
	append_str += "<tr>";
	append_str += "<td class='center'><img src='<?php echo base_url()?>assets/image/delete.png' title='刪除資料' onclick='$(\"#product_row_"+current_count+"\").remove();totalSum();' /></td>";
	for(var key in usecol_array){
		var val = usecol_array[key];
		if(val['type']){type = val['type'];}else{type = "text";}
			append_str += "<td nowrap='value'";  //1060728  加nowrap 圖示在同一行
		if(val['data_class']){append_str += "class='"+val['data_class']+"' ";}
		if(val['align']){append_str += "align='"+val['align']+"' ";}
			append_str += ">";
		if(type == "text"){
			append_str += "<input type='"+type+"' id='order_product["+current_count+"]["+key+"]' name='order_product["+current_count+"]["+key+"]' class='order_product_"+key+"'  onKeyPress='keyFunction()' ";
			if(key == no_col){append_str += "value='"+(max_no*1+10)+"'"}
			if(val['size']){append_str += "size='"+val['size']+"' ";}
			if(val['id']){append_str += "id='"+val['id']+"' ";}
			if(val['class']){append_str += "class='"+val['class']+"' ";}
			if(val['onclick']){append_str += "onclick='"+val['onclick']+"' ";}
			if(val['onfocus']){append_str += "onfocus='"+val['onfocus']+"' ";}
			if(val['onfocusout']){append_str += "onfocusout='"+val['onfocusout']+"' ";}
			if(val['ondblclick']){append_str += "ondblclick='"+val['ondblclick']+"' ";}
			if(val['onchange']){append_str += "onchange='"+val['onchange']+"' ";}
			if(val['style']){append_str += "style='"+val['style']+"' ";}
			if(val['readonly']){append_str += "readonly='"+val['readonly']+"' ";}
			if(val['disable']){append_str += "disable='"+val['disable']+"' ";}
			if(val['value']){append_str += "value='"+val['value']+"' ";}
			if(val['required']){append_str += "required='"+val['required']+"' ";}
			append_str += " />";
		}
		
		if(type == "select" && val['option']){
			append_str += "<select id='order_product["+current_count+"]["+key+"]' name='order_product["+current_count+"]["+key+"]' class='order_product_"+key+"' onKeyPress='keyFunction()' ";
			if(val['size']){append_str += "size='"+val['size']+"' ";}
			if(val['onclick']){append_str += "onclick='"+val['onclick']+"' ";}
			if(val['ondblclick']){append_str += "ondblclick='"+val['ondblclick']+"' ";}
			if(val['onchange']){append_str += "onchange='"+val['onchange']+"' ";}
			if(val['style']){append_str += "style='"+val['style']+"' ";}
			if(val['readonly']){append_str += "readonly='"+val['readonly']+"' ";}
			if(val['disable']){append_str += "disable='"+val['disable']+"' ";}
			append_str += ">";
			for(var k in val['option']){
				var v = val['option'][k];
				append_str += "<option ";
				append_str += "value='"+k+"'>";
				append_str += k+"."+v;
				append_str += "</option>";
			}
			append_str += "</select>";
		}
		
		if(type == "checkbox"){
			append_str += "<input type='"+type+"' id='order_product["+current_count+"]["+key+"]' name='order_product["+current_count+"]["+key+"]' class='order_product_"+key+"' onKeyPress='keyFunction()' ";
			append_str += " />";
		}
		if(val['name'] == '品號圖示1'){append_str += "<a href='javascript:;'><img name='order"+current_count+"' id='order"+current_count+"' src='<?php echo base_url()?>assets/image/png/seek.png' alt='' align='top'/>" };
		if(val['name'] == '品號圖示'){append_str += "<a href='javascript:;'><img name='ordera"+current_count+"' id='ordera"+current_count+"' src='<?php echo base_url()?>assets/image/png/seek.png' alt='' align='top'/>" };
		if(val['name'] == '折扣率%'){ append_str +=  "<span name='orderd"+current_count+"' id='orderd"+current_count+"'  align='top' >%</span>" };			
		if(val['name'] == '品號圖示2'){append_str += "<a href='javascript:;'><img name='order"+current_count+"' id='order"+current_count+"' src='<?php echo base_url()?>assets/image/png/seek.png' alt='' align='top'/>" };
		if(val['name'] == '品號圖示2'){append_str += "<a href='javascript:;'><img name='ordera"+current_count+"' id='ordera"+current_count+"' src='<?php echo base_url()?>assets/image/png/seek1.png' alt='' align='top'/>" };
		if(val['name'] == '科目代號'){append_str += "<a href='javascript:;'><img name='order"+current_count+"' id='order"+current_count+"' src='<?php echo base_url()?>assets/image/png/seek1.png' alt='' align='top'/>" };
		
		append_str += "</td>";
	}
	
	append_str += "</tr>";
	append_str += "</tbody>";
	$('#order_product tfoot').before(append_str);
	
	//以下為需要各表各自設定部分(即為快速查詢功能設定)//
	//品號查詢品名規格, 庫別2
	set_catcomplete(current_count);
	set_catcomplete2(current_count);
	//set_catcomplete3(current_count);
}

</script>
<!-- 預覽圖片 --> 
<script type="text/javascript">
function pre_pic(obj){ //預覽圖片
  if(obj.files && obj.files[0]){
	  var reader = new FileReader();
	  reader.onload = function(e){
		  $('#ad').attr('src',e.target.result);
	  }
	  reader.readAsDataURL(obj.files[0]);
  }
}
</script>