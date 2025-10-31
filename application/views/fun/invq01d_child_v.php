<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>品號類別視窗查詢</title>
<?php $this->load->helper('url');?>
<?php $this->load->library("session"); ?>
<link href="view/image/icon.png" rel="icon" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/stylesheet.css" /> 
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link type="text/css" href="<?php echo base_url()?>assets/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/superfish/js/superfish.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/common.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery.maskedinput.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/jquery-1.7.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/divForm.css" />

<style> input:focus {background-color: yellow;} </style>  <!--欄位游標停留變黃色  -->
<style>label { display:block;}</style>   <!--欄位標題顯示方框 -->



</head>

<style>
#page .pagination {padding: 10px; text-align: left;}
.pagination a {margin: 0; padding: 3px 6px; border: 1px solid #777;text-decoration:none;}
.pagination a:hover,.pagination a.current {border-color: #000 !important;background:#ddd;}

#form :focus{ 

　　-webkit-box-shadow: 0px 0px 4px #aaa; 

　　-moz-box-shadow: 0px 0px 4px #aaa; 

　　box-shadow: 0px 0px 4px #aaa; 

　　} 
</style>
<body >
	<table width="95%" align="center"><tr><td>
      <form action="<?php echo base_url()?>" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
         <!--     <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
		  
	     <td width="5%" class="left">
	          <?php echo anchor("fun/invq01d/display/ma001/" . (($sort_order == 'asc' && $sort_by == 'ma001') ? 'desc' : 'asc') ,'序號'); ?>
	      </td>
		   <td width="5%" class="left">
	          <?php echo anchor("fun/invq01d/display/ma001/" . (($sort_order == 'asc' && $sort_by == 'ma001') ? 'desc' : 'asc') ,'分類'); ?>
	      </td>  -->
		  
	      <td width="7%" class="left"> 
		  <?php echo anchor("fun/invq01d/display/ma002/" . (($sort_order == 'asc' && $sort_by == 'ma002') ? 'desc' : 'asc') ,'品號類別代號'); ?>
	      </td>
	      <td width="16%" class="left"> 
		  <?php echo anchor("fun/invq01d/display/ma003/" . (($sort_order == 'asc' && $sort_by == 'ma003') ? 'desc' : 'asc') ,'品號類別名稱'); ?>
              </td>
	    
	      <td width="18%" class="center">&nbsp選擇&nbsp </td>
           
            </tr>
          </thead>
           <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_ma001='*';$filter_ma002='';$filter_ma003='';$filter_ma004='';$filter_ma005='';$filter_ma006='';$filter_create=''; ?>
	     <tr class="filter">
	     <!--  <td class="left"></td>
	      <td class="left"></td>
			  
            <td align="left">
		  <div id="search">
		   <div class="button-search"></div>
		       <select name="filter_ma001" >
                               <option value="*"></option>
                               <option  value="1">會計</option>
                               <option  value="2">商品</option>
                               <option  value="3">類別</option>
                               <option  value="4">生管</option>                                                                
                       </select>
		  </div>
	      </td>  -->
	      
	      <td class="left">
		  <div  class="button-search"></div>
		    
			<input type="text" id="filter_ma002" name="filter_ma002" value="" onblur="filter1()" /><span>篩選</span>		
	       
		  </td>   
			  
	      <td class="left">
		  <div id="search">
		   <div class="button-search"></div>
			<input type="text" id="filter_ma003" name="filter_ma003" value="" onblur="filter1()" /><span>篩選</span>
		  </div>			  
	      </td>	 
		   <td  align="center">&nbsp;&nbsp;</td>
	    <!--  <td  align="center"><a onclick="filter2();" class="button">篩選</a></td>	-->	
            </tr>
			
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
            <tr>
           <!--   <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?=$row->ma001."/".trim($row->ma002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left"><?php echo  $chkval;?></td>		
		  <td class="left"><?php echo  $row->ma001;?></td>	-->		  
		  <td class="left"><?php echo  $row->ma002;?></td>
		  <td class="left"><?php echo  $row->ma003;?></td>
		  <td class="center">
	
		  <input type="hidden" class="sma001" name="sma001" value=<?php echo  $row->ma002;?> />
		  <input type="hidden" class="sma002" name="sma002" value=<?php echo  urldecode(urldecode($row->ma003));?> />
				  <input type="button" class="button" value="選擇" />
		<!--  <a href="<?php echo site_url('fun/invq01d/getdata/'.$row->ma001."/".trim($row->ma002))?>">[ 選擇 ]</a></td> -->
           
	    </tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
          </tbody>		 
        </table>
	      <!--      <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		      <?php echo $this->pagination->create_links();?>	
			    <?php echo $this->session->userdata('find05');$find05; ?><?php echo $this->session->userdata('find07');$find07;  ?> -->
				<div class="pagination"><div class="results"><?php echo $pagination.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?></div></div>
			
		  <tfoot>
		  <tr>           
          </tr>
		  </tfoot>
       
      </form>
    </td></tr></table>
<script type="text/javascript">
    $(document).ready(function(){
		$('.button').click(function() {
		//   var sma001 = encodeURIComponent($(this).parent().find('.sma001').val());
		 //   alert($(this).parent().find('.sma001').val());
			var sma001 = $(this).parent().find('.sma001').val() ;
			var sma002 = $(this).parent().find('.sma002').val() ;
		//	alert(sma002);
			window.parent.$.unblockUI();
			window.parent.addOrder4(sma001,sma002);
		});
    });
</script>

<script type="text/javascript"><!--
$(document).ready(function() {
//	$('.button-search').bind('click', function() {
//		filter1();
//	});
});

function filter1() {
	
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').val();
	if (filter_ma002) {
	   
		url = '<?php echo base_url()?>index.php/fun/invq01d/filter1/ma002/asc/' + filter_ma002 ;
	} 
	
	var filter_ma003 = $('input[name=\'filter_ma003\']').val();
	if (filter_ma003) {
		url = '<?php echo base_url()?>index.php/fun/invq01d/filter1/ma003/asc/' + encodeURIComponent(filter_ma003);
	}
	
	
    if ( !filter_ma002  && !filter_ma003 ) {         
	   url = '<?php echo base_url()?>index.php/fun/invq01d/display/';location = url;
	   
	   }
	   
	location = url;
}


//--></script>
</body>
</html>