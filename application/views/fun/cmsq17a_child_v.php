<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>註記簽核視窗查詢</title>
<?php $this->load->helper('url');?>
<?php $this->load->library("session"); ?>
<link href="view/image/icon.png" rel="icon" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/stylesheet.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/jquery-1.9.1.js"  ></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link type="text/css" href="<?php echo base_url()?>assets/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/superfish/js/superfish.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/common.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery.maskedinput.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery.blockUI.js"></script>

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
      <form action="" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
       
		  
	      <td width="7%" class="left"> 
		 <?php  if($this->uri->segment(3)=="display1" || $this->uri->segment(3)=="filter1") {
		          echo anchor("fun/cmsq17a/display1/ms002/" . (($sort_order == 'asc' && $sort_by == 'ms002') ? 'desc' : 'asc') ,'註記簽核代號');} ?>
	     
		 <?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") {
		          echo anchor("fun/cmsq17a/display2/ms002/" . (($sort_order == 'asc' && $sort_by == 'ms002') ? 'desc' : 'asc') ,'註記簽核代號');} ?>  
	       <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>	
		  </td>
	      <td width="16%" class="left"> 
		   <?php  if($this->uri->segment(3)=="display1" || $this->uri->segment(3)=="filter1") {
		         echo anchor("fun/cmsq17a/display1/ms003/" . (($sort_order == 'asc' && $sort_by == 'ms003') ? 'desc' : 'asc') ,'註記簽核名稱');} ?>
           
		   <?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") {
		         echo anchor("fun/cmsq17a/display2/ms003/" . (($sort_order == 'asc' && $sort_by == 'ms003') ? 'desc' : 'asc') ,'註記簽核名稱');} ?>   
			 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>		 
			 </td>
		  <td width="16%" class="left"> 
		   <?php  if($this->uri->segment(3)=="display1" || $this->uri->segment(3)=="filter1") {
		         echo anchor("fun/cmsq17a/display1/ms004/" . (($sort_order == 'asc' && $sort_by == 'ms004') ? 'desc' : 'asc') ,'備註');} ?>
           
		   <?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") {
		         echo anchor("fun/cmsq17a/display2/ms004/" . (($sort_order == 'asc' && $sort_by == 'ms004') ? 'desc' : 'asc') ,'備註');} ?>   
			 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>		 
			 </td>
	    
	      <td width="18%" class="center">&nbsp選擇&nbsp </td>
           
            </tr>
          </thead>
           <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_ms001='*';$filter_ms002='';$filter_ms003='';$filter_ms004='';$filter_ms005='';$filter_ms006='';$filter_create=''; ?>
	     <tr class="filter">
	    	      
	      <td class="left">
		  <div id="search">
		  <div  class="button-search"></div>
		    <?php  if($this->uri->segment(3)=="display1" || $this->uri->segment(3)=="filter1") { ?>  <!--篩選  -->
			<input type="text" id="filter_ms002" name="filter_ms002" value="" onblur="filter1()" /><span></span>  <?php } ?>	
             <?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") { ?>
			<input type="text" id="filter_ms002" name="filter_ms002" value="" onblur="filter2()" /><span></span> <?php } ?>	
		    </div>	
		  </td>   
			  
	      <td class="left">
		  <div id="search">
		   <div class="button-search"></div>
		    <?php  if($this->uri->segment(3)=="display1" || $this->uri->segment(3)=="filter1") { ?>
			<input type="text" id="filter_ms003" name="filter_ms003" value="" onblur="filter1()" /><span></span> <?php } ?>	
			<?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") { ?>
			<input type="text" id="filter_ms003" name="filter_ms003" value="" onblur="filter2()" /><span></span> <?php } ?>	
		  </div>			  
	      </td>	 
		  <td class="left">
		  <div id="search">
		   <div class="button-search"></div>
		    <?php  if($this->uri->segment(3)=="display1" || $this->uri->segment(3)=="filter1") { ?>
			<input type="text" size="10"  id="filter_ms004" name="filter_ms003" value="" onblur="filter1()" /><span></span> <?php } ?>	
			<?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") { ?>
			<input type="text" size="10" id="filter_ms004" name="filter_ms003" value="" onblur="filter2()" /><span></span> <?php } ?>	
		  </div>			  
	      </td>	 
		  
		   <td  align="center">&nbsp;&nbsp;</td>
        </tr>
			
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
            <tr>
		  <td class="left"><?php echo  $row->ms002;?></td>
		  <td class="left"><?php echo  $row->ms003;?></td>
		  <td class="left"><?php echo  $row->ms004;?></td>
		  <td class="center">
		  
		   <?php  if($this->uri->segment(3)=="display1" || $this->uri->segment(3)=="filter1") { ?>
			  <input type="hidden" class="sms001" name="sms001" value=<?php echo  $row->ms002;?> />
		      <input type="hidden" class="sms002" name="sms002" value=<?php echo  urldecode(urldecode($row->ms003));?> />
		      <input type="button" class="button1" value="選擇" /><?php } ?>
		  
		    <?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") { ?>
			  <input type="hidden" class="sms001" name="sms001" value=<?php echo  $row->ms002;?> />
		      <input type="hidden" class="sms002" name="sms002" value=<?php echo  urldecode(urldecode($row->ms003));?> />
		  <input type="button" class="button2" value="選擇" /> <?php } ?>
		  
	    </tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
          </tbody>		 
        </table>
	     
				<div class="pagination"><div class="results"><?php echo $pagination.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?></div></div>
			
		  <tfoot>
		  <tr>           
          </tr>
		  </tfoot>
       
      </form>
    </td></tr></table>
<script type="text/javascript">
    $(document).ready(function(){
		$('.button1').click(function() {
		  //  var sms001 = encodeURIComponent($(this).parent().find('.sms001').val());
		//	var sms001 = $(this).parent().find('.sms001').val();
            var sms001 = $(this).parent().find('.sms001').val();
			var sms002 = $(this).parent().find('.sms002').val() ;			
			window.parent.$.unblockUI();
			window.parent.addcmsq17a1(sms001,sms002);
		});
		
		$('.button2').click(function() {
		  //  var sms001 = encodeURIComponent($(this).parent().find('.sms001').val());
			var sms001 = $(this).parent().find('.sms001').val();
			var sms002 = $(this).parent().find('.sms002').val() ;			
			window.parent.$.unblockUI();
			window.parent.addcmsq17a2(sms001,sms002);
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
	var filter_ms002 = $('input[name=\'filter_ms002\']').val();
	if (filter_ms002) {
	   
		url = '<?php echo base_url()?>index.php/fun/cmsq17a/filter1/ms002/asc/' + filter_ms002 ;
	} 
	
	var filter_ms003 = $('input[name=\'filter_ms003\']').val();
	if (filter_ms003) {
		url = '<?php echo base_url()?>index.php/fun/cmsq17a/filter1/ms003/asc/' + encodeURIComponent(filter_ms003);
	}
	
	var filter_ms004 = $('input[name=\'filter_ms004\']').val();
	if (filter_ms004) {
		url = '<?php echo base_url()?>index.php/fun/cmsq17a/filter1/ms004/asc/' + encodeURIComponent(filter_ms004);
	}
	
    if ( !filter_ms002  && !filter_ms003 && !filter_ms004) {         
	   url = '<?php echo base_url()?>index.php/fun/cmsq17a/display1/';location = url;
	   
	   }
	   
	location = url;
}

function filter2() {
	var filter_ms002 = $('input[name=\'filter_ms002\']').val();
	if (filter_ms002) {
	   
		url = '<?php echo base_url()?>index.php/fun/cmsq17a/filter2/ms002/asc/' + filter_ms002 ;
	} 
	
	var filter_ms003 = $('input[name=\'filter_ms003\']').val();
	if (filter_ms003) {
		url = '<?php echo base_url()?>index.php/fun/cmsq17a/filter2/ms003/asc/' + encodeURIComponent(filter_ms003);
	}
	
	var filter_ms004 = $('input[name=\'filter_ms004\']').val();
	if (filter_ms004) {
		url = '<?php echo base_url()?>index.php/fun/cmsq17a/filter2/ms004/asc/' + encodeURIComponent(filter_ms004);
	}
	
    if ( !filter_ms002  && !filter_ms003 && !filter_ms004) {         
	   url = '<?php echo base_url()?>index.php/fun/cmsq17a/display2/';location = url;
	   
	   }
	   
	location = url;
}


//--></script>
</body>
</html>