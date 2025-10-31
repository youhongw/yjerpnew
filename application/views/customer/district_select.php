<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">

<head>
 <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 

<!-- <title>雲端ERP企業資源管理系統</title> -->
<title><?php echo $systitle; ?></title>
  <?php $this->load->helper('url');?>
  <?php $this->load->library("session"); ?>
<link href="<?=base_url()?>assets/image/icon.png" rel="icon" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/stylesheet/stylesheet.css" />
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/jquery-1.7.1.min.js"  ></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link type="text/css" href="<?=base_url()?>assets/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/superfish/js/superfish.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/common.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery.maskedinput.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery.blockUI.js"></script>
<?php
$CI = get_instance();
$CI->load->model('region_model', 'region');
$provinces   = $CI->region->provinces();   //此處代碼的作用是取出所有的省份。下面的省份的下拉清單取值就是用次來迴圈的
$citys = $CI->region->children_of($province_selected);
?>
<script  language="JavaScript">
<!--
//判斷$province_selected，$city_selected，$district_selected等這些值是否為空，為空的話，說明該用戶還沒有添加自己的所屬地區，不為空的話就賦給相應的JS變數,它是從資料庫中取出來的值，以便在下拉清單中該選擇哪個省份的時候與迴圈出來的結果集進行比較，從而來決定哪一個值該選中
<?php if(isset($province_selected)):?>
var province_selected = <?php echo (int)$province_selected?>;
<?php else:?>
var province_selected = 0;
<?php endif?>
<?php if(isset($city_selected)):?>
var city_selected = <?php echo (int)$city_selected?>;
<?php else:?>
var city_selected = 0;
<?php endif?>
<?php if(isset($district_selected)):?>
var district_selected = <?php echo (int)$district_selected?>;
<?php else:?>
var district_selected = 0;
<?php endif?>
$(document).ready(function() {
  var change_city = function(){
$.ajax({
   url: '<?php echo site_url('region_change/select_children/parent_id')?>'+'/'+$('#province_id').val(),//也就是發送給控制器region_change.php()的select_children()方法
   type: 'GET',
   dataType: 'html',
   success: function(data){
  city_json = eval('('+data+')');//轉化為物件
  var city = document.getElementById('city_id');
  city.options.length = 0;
  city.options[0] = new Option('城市', ''); //創建新的option
  for(var i=0; i<city_json.length; i++){    //對json物件進行迴圈
            var len = city.length;
   city.options[len] = new Option(city_json.region_name, city_json.region_id); //分別取出json資料返回的name和region_id，並賦給下拉清單
   if (city.options[len].value == city_selected){
    city.options[len].selected = true;
   }
  }
  change_district();//重置地區
   }
});
  }
  change_city();//初始化城市
  $('#province_id').change(function(){
     change_city();
  });

  var change_district = function(){
$.ajax({
   url: '<?php echo site_url('region_change/select_children/parent_id')?>'+'/'+$('#city_id').val(),
   type: 'GET',
   dataType: 'html',
   success: function(data){
        district_json = eval('('+data+')');
  var district = document.getElementById('district_id');
  district.options.length = 0;
  district.options[0] = new Option('縣/區', '');
  for(var i=0; i<district_json.length; i++){
            var len = district.length;
   district.options[len] = new Option(district_json.region_name, district_json.region_id); 
   if (district.options[len].value == district_selected){
    district.options[len].selected = true;
   }
  }
   }
});
  }
  $('#city_id').change(function(){
     change_district();
  });
  

});
//-->
</script>
</head>
<body>

<select name="province_id" id="province_id"  style="width:100px;">
    <option value="" >省份</option>
<?php foreach($provinces as $key => $province): ?>
<option value="<?php echo $province['region_id']; ?>" <?php if($province['region_id']==$province_selected){echo 'selected';}?> ><?php echo $province['region_name']; ?></option>
<?php endforeach; ?>
</select>
<select name="city_id" id="city_id"  style="width:100px;">
    <?php foreach($citys as $key => $city): ?>
<option value="<?php echo $city['region_id']; ?>" <?php if($city['region_id']==$city_selected){echo 'selected';}?> ><?php echo $city['region_name']; ?></option>
<?php endforeach; ?>
</select>
<select name="district_id" id="district_id" style="width:100px;">
    <option value=""></option>
</select>

</body>
</html>