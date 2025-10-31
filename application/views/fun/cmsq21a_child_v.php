<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>付款條件視窗查詢</title>
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
		          echo anchor("fun/cmsq21a/display1/na002/" . (($sort_order == 'asc' && $sort_by == 'na002') ? 'desc' : 'asc') ,'付款條件代號');} ?>
	     
		 <?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") {
		          echo anchor("fun/cmsq21a/display2/na002/" . (($sort_order == 'asc' && $sort_by == 'na002') ? 'desc' : 'asc') ,'付款條件代號');} ?>  
	 
		  </td>
	      <td width="16%" class="left"> 
		   <?php  if($this->uri->segment(3)=="display1" || $this->uri->segment(3)=="filter1") {
		         echo anchor("fun/cmsq21a/display1/na003/" . (($sort_order == 'asc' && $sort_by == 'na003') ? 'desc' : 'asc') ,'付款條件名稱');} ?>
           
		   <?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") {
		         echo anchor("fun/cmsq21a/display2/na003/" . (($sort_order == 'asc' && $sort_by == 'na003') ? 'desc' : 'asc') ,'付款條件名稱');} ?>   
				 
			 </td>
	    
	      <td width="18%" class="center">&nbsp選擇&nbsp </td>
           
            </tr>
          </thead>
           <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_na001='*';$filter_na002='';$filter_na003='';$filter_na004='';$filter_na005='';$filter_na006='';$filter_create=''; ?>
	     <tr class="filter">
	    	      
	      <td class="left">
		  <div id="search">
		  <div  class="button-search"></div>
		    <?php  if($this->uri->segment(3)=="display1" || $this->uri->segment(3)=="filter1") { ?>
			<input type="text" id="filter_na002" name="filter_na002" value="" onblur="filter1()" /><span></span>  <?php } ?>	
             <?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") { ?>
			<input type="text" id="filter_na002" name="filter_na002" value="" onblur="filter2()" /><span></span> <?php } ?>	
              </div>
		  </td>   
			  
	      <td class="left">
		  <div id="search">
		   <div class="button-search"></div>
		    <?php  if($this->uri->segment(3)=="display1" || $this->uri->segment(3)=="filter1") { ?>
			<input type="text" id="filter_na003" name="filter_na003" value="" onblur="filter1()" /><span></span> <?php } ?>	
			<?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") { ?>
			<input type="text" id="filter_na003" name="filter_na003" value="" onblur="filter2()" /><span></span> <?php } ?>	
				
		  </div>			  
	      </td>	 
		   <td  align="center">&nbsp;&nbsp;</td>
        </tr>
			
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
            <tr>
		  <td class="left"><?php echo  $row->na002;?></td>
		  <td class="left"><?php echo  $row->na003;?></td>
		  <td class="center">
		  
		   <?php  if($this->uri->segment(3)=="display1" || $this->uri->segment(3)=="filter1") { ?>
			  <input type="hidden" class="sna001" name="sna001" value=<?php echo  $row->na002;?> />
		      <input type="hidden" class="sna002" name="sna002" value=<?php echo  urldecode(urldecode($row->na003));?> />
		      <input type="button" class="button1" value="選擇" /><?php } ?>
		  
		    <?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") { ?>
			  <input type="hidden" class="sna001" name="sna001" value=<?php echo  $row->na002;?> />
		      <input type="hidden" class="sna002" name="sna002" value=<?php echo  urldecode(urldecode($row->na003));?> />
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
		  //  var sna001 = encodeURIComponent($(this).parent().find('.sna001').val());
		//	var sna001 = $(this).parent().find('.sna001').val();
            var sna001 = $(this).parent().find('.sna001').val();
			var sna002 = $(this).parent().find('.sna002').val() ;			
			window.parent.$.unblockUI();
			window.parent.addcmsq21a1(sna001,sna002);
		});
		
		$('.button2').click(function() {
		  //  var sna001 = encodeURIComponent($(this).parent().find('.sna001').val());
			var sna001 = $(this).parent().find('.sna001').val();
			var sna002 = $(this).parent().find('.sna002').val() ;			
			window.parent.$.unblockUI();
			window.parent.addcmsq21a2(sna001,sna002);
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
	var filter_na002 = $('input[name=\'filter_na002\']').val();
	if (filter_na002) {
	   
		url = '<?php echo base_url()?>index.php/fun/cmsq21a/filter1/na002/asc/' + filter_na002 ;
	} 
	
	var filter_na003 = $('input[name=\'filter_na003\']').val();
	if (filter_na003) {
		url = '<?php echo base_url()?>index.php/fun/cmsq21a/filter1/na003/asc/' + encodeURIComponent(filter_na003);
	}
	
    if ( !filter_na002  && !filter_na003 ) {         
	   url = '<?php echo base_url()?>index.php/fun/cmsq21a/display1/';location = url;
	   
	   }
	   
	location = url;
}

function filter2() {
	var filter_na002 = $('input[name=\'filter_na002\']').val();
	if (filter_na002) {
	   
		url = '<?php echo base_url()?>index.php/fun/cmsq21a/filter2/na002/asc/' + filter_na002 ;
	} 
	
	var filter_na003 = $('input[name=\'filter_na003\']').val();
	if (filter_na003) {
		url = '<?php echo base_url()?>index.php/fun/cmsq21a/filter2/na003/asc/' + encodeURIComponent(filter_na003);
	}
	
    if ( !filter_na002  && !filter_na003 ) {         
	   url = '<?php echo base_url()?>index.php/fun/cmsq21a/display2/';location = url;
	   
	   }
	   
	location = url;
}


//--></script>
</body>
</html>