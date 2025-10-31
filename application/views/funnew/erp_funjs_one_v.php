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
<!-- find_v --> 
<script language="javascript">
   function trim(strvalue) {
     ptntrim = /(^\s*)|(\s*$)/g;
     return strvalue.replace(ptntrim,"");
    }

    function OnBlur() {
	  var str1 = '(',  str2 = ')', str3 = '"', str4 = '"',str22='';
	  if (trim(find002.value) == 'like') {str22='%'; } 
	  if ( trim(find005.value) != '') {
          find005.value = trim(find005.value) + find004.value + str1 + find001.value + find002.value + str3 + find003.value +str22 + str4  + str2  ;
	  }
	  else
	  {
	     find005.value = str1  + find001.value + find002.value + str3 + find003.value + str22 + str4  + str2  ;
	  }
    }
      
    function OnBlur1() {
      find005.value = '';
    }
	
   function OnBlur2()  {
      var str5 = ','; 
      if ( trim(find007.value) != '') {
        find007.value = trim(find007.value) + str5 + find006.value + find008.value   ;
	  }
	  else
	  {
	    find007.value = trim(find007.value) + find006.value + find008.value   ;
	  }
    }
     
    function OnBlur3()  {
       find007.value = '';
     }
	
</script>

<?php 	
//取中文字CuttingStr($val->eb001disp,8)	 
function CuttingStr($str, $strlen) 
	    { 
         //把'&nbsp;'先轉成空白
         $str = str_replace('&nbsp;', ' ', $str);
         $output_str_len = 0; //累計要輸出的擷取字串長度
         $output_str = ''; //要輸出的擷取字串
 
         //逐一讀出原始字串每一個字元
         for($i=0; $i<strlen($str); $i++)  {
            //擷取字數已達到要擷取的字串長度，跳出回圈
            if($output_str_len >= $strlen){
                  break;
              }
  
            //取得目前字元的ASCII碼
            $str_bit = ord(substr($str, $i, 1));
  
            if($str_bit  <  128)  {
                  //ASCII碼小於 128 為英文或數字字符
                  $output_str_len += 1; //累計要輸出的擷取字串長度，英文字母算一個字數
                  $output_str .= substr($str, $i, 1); //要輸出的擷取字串
   
            }elseif($str_bit  >  191  &&  $str_bit  <  224)  {
                  //第一字節為落於192~223的utf8的中文字(表示該中文為由2個字節所組成utf8中文字)
                  $output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
                  $output_str .= substr($str, $i, 2); //要輸出的擷取字串
                  $i++;
   
            }elseif($str_bit  >  223  &&  $str_bit  <  240)  {
                  //第一字節為落於223~239的utf8的中文字(表示該中文為由3個字節所組成的utf8中文字)
                  $output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
                  $output_str .= substr($str, $i, 3); //要輸出的擷取字串
                  $i+=2;
   
            }elseif($str_bit  >  239  &&  $str_bit  <  248)  {
                  //第一字節為落於240~247的utf8的中文字(表示該中文為由4個字節所組成的utf8中文字)
                  $output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
                  $output_str .= substr($str, $i, 4); //要輸出的擷取字串
                  $i+=3;
            }
          }
 
          //要輸出的擷取字串為空白時，輸出原始字串
          return ($output_str == '') ? $str : $output_str; 
        }
?>	