<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>單別視窗查詢</title>
<?php $this->load->helper('url');?>
<?php $this->load->library("session"); ?>
<link href="view/image/icon.png" rel="icon" />
<link href="<?=base_url()?>assets/image/icon.png" rel="icon" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/stylesheet/stylesheet.css" /> 
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link type="text/css" href="<?=base_url()?>assets/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/superfish/js/superfish.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/common.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery.maskedinput.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/jquery-1.7.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/stylesheet/divForm.css" />

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
		 <?php  if($this->uri->segment(3)=="display31" || $this->uri->segment(3)=="filter31") {
		          echo anchor("pur/purq04a/display31/mq001/" . (($sort_order == 'asc' && $sort_by == 'mq001') ? 'desc' : 'asc') ,'單別代號');} ?>
	     
		 <?php  if($this->uri->segment(3)=="display32" || $this->uri->segment(3)=="filter32") {
		          echo anchor("pur/purq04a/display32/mq001/" . (($sort_order == 'asc' && $sort_by == 'mq001') ? 'desc' : 'asc') ,'單別代號');} ?>	  
	      
		  <?php  if($this->uri->segment(3)=="display33" || $this->uri->segment(3)=="filter33") {
		          echo anchor("pur/purq04a/display33/mq001/" . (($sort_order == 'asc' && $sort_by == 'mq001') ? 'desc' : 'asc') ,'單別代號');} ?>
		  
		  <?php  if($this->uri->segment(3)=="display34" || $this->uri->segment(3)=="filter34") {
		          echo anchor("pur/purq04a/display34/mq001/" . (($sort_order == 'asc' && $sort_by == 'mq001') ? 'desc' : 'asc') ,'單別代號');} ?>
		   <?php  if($this->uri->segment(3)=="display35" || $this->uri->segment(3)=="filter35") {
		          echo anchor("pur/purq04a/display35/mq001/" . (($sort_order == 'asc' && $sort_by == 'mq001') ? 'desc' : 'asc') ,'單別代號');} ?>
		  </td>
	      <td width="16%" class="left"> 
		   <?php  if($this->uri->segment(3)=="display31" || $this->uri->segment(3)=="filter31") {
		         echo anchor("pur/purq04a/display31/mq002/" . (($sort_order == 'asc' && $sort_by == 'mq002') ? 'desc' : 'asc') ,'單別名稱');} ?>
           
		   <?php  if($this->uri->segment(3)=="display32" || $this->uri->segment(3)=="filter32") {
		         echo anchor("pur/purq04a/display32/mq002/" . (($sort_order == 'asc' && $sort_by == 'mq002') ? 'desc' : 'asc') ,'單別名稱');} ?>   
			
			<?php  if($this->uri->segment(3)=="display33" || $this->uri->segment(3)=="filter33") {
		         echo anchor("pur/purq04a/display33/mq002/" . (($sort_order == 'asc' && $sort_by == 'mq002') ? 'desc' : 'asc') ,'單別名稱');} ?>  
           
		   <?php  if($this->uri->segment(3)=="display34" || $this->uri->segment(3)=="filter34") {
		         echo anchor("pur/purq04a/display34/mq002/" . (($sort_order == 'asc' && $sort_by == 'mq002') ? 'desc' : 'asc') ,'單別名稱');} ?>	
				 
           <?php  if($this->uri->segment(3)=="display35" || $this->uri->segment(3)=="filter35") {
		         echo anchor("pur/purq04a/display35/mq002/" . (($sort_order == 'asc' && $sort_by == 'mq002') ? 'desc' : 'asc') ,'單別名稱');} ?>					 
			 </td>
	    
	      <td width="18%" class="center">&nbsp選擇&nbsp </td>
           
            </tr>
          </thead>
           <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_mq001='';$filter_mq002='';$filter_mq003='';$filter_mq004='';$filter_mq005='';$filter_mq006='';$filter_create=''; ?>
	     <tr class="filter">
	     
	      
	      <td class="left">
		  <div  class="button-search"></div>
		    <?php  if($this->uri->segment(3)=="display31" || $this->uri->segment(3)=="filter31") { ?>
			<input type="text" id="filter_mq001" name="filter_mq001" value="" onblur="filter31()" /><span>篩選</span>  <?php } ?>	
             <?php  if($this->uri->segment(3)=="display32" || $this->uri->segment(3)=="filter32") { ?>
			<input type="text" id="filter_mq001" name="filter_mq001" value="" onblur="filter32()" /><span>篩選</span> <?php } ?>	
              <?php  if($this->uri->segment(3)=="display33" || $this->uri->segment(3)=="filter33") { ?>
			<input type="text" id="filter_mq001" name="filter_mq001" value="" onblur="filter33()" /><span>篩選</span> <?php } ?>				
	         <?php  if($this->uri->segment(3)=="display34" || $this->uri->segment(3)=="filter34") { ?>
			<input type="text" id="filter_mq001" name="filter_mq001" value="" onblur="filter34()" /><span>篩選</span> <?php } ?>	
			 <?php  if($this->uri->segment(3)=="display35" || $this->uri->segment(3)=="filter35") { ?>
			<input type="text" id="filter_mq001" name="filter_mq001" value="" onblur="filter35()" /><span>篩選</span> <?php } ?>	
		  </td>   
			  
	      <td class="left">
		  <div id="search">
		   <div class="button-search"></div>
		    <?php  if($this->uri->segment(3)=="display31" || $this->uri->segment(3)=="filter31") { ?>
			<input type="text" id="filter_mq002" name="filter_mq002" value="" onblur="filter31()" /><span>篩選</span> <?php } ?>	
			<?php  if($this->uri->segment(3)=="display32" || $this->uri->segment(3)=="filter32") { ?>
			<input type="text" id="filter_mq002" name="filter_mq002" value="" onblur="filter32()" /><span>篩選</span> <?php } ?>	
			<?php  if($this->uri->segment(3)=="display33" || $this->uri->segment(3)=="filter33") { ?>
			<input type="text" id="filter_mq002" name="filter_mq002" value="" onblur="filter33()" /><span>篩選</span> <?php } ?>	
			<?php  if($this->uri->segment(3)=="display34" || $this->uri->segment(3)=="filter34") { ?>
			<input type="text" id="filter_mq002" name="filter_mq002" value="" onblur="filter34()" /><span>篩選</span> <?php } ?>	
			<?php  if($this->uri->segment(3)=="display35" || $this->uri->segment(3)=="filter35") { ?>
			<input type="text" id="filter_mq002" name="filter_mq002" value="" onblur="filter35()" /><span>篩選</span> <?php } ?>	
		  </div>			  
	      </td>	 
		   <td  align="center">&nbsp;&nbsp;</td>
	   
            </tr>
			
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
            <tr>
		  <td class="left"><? echo $row->mq001;?></td>
		  <td class="left"><? echo $row->mq002;?></td>
		  <td class="center">
	
		  
		   <?php  if($this->uri->segment(3)=="display31" || $this->uri->segment(3)=="filter31") { ?>
			  <input type="hidden" class="smq001" name="smq001" value=<? echo $row->mq001;?> />
		      <input type="hidden" class="smq002" name="smq002" value=<? echo urldecode(urldecode($row->mq002));?> />
		      <input type="button" class="button1" value="選擇" /><?php } ?>

	
		  
		    <?php  if($this->uri->segment(3)=="display32" || $this->uri->segment(3)=="filter32") { ?>
			  <input type="hidden" class="smq001" name="smq001" value=<? echo $row->mq001;?> />
		      <input type="hidden" class="smq002" name="smq002" value=<? echo urldecode(urldecode($row->mq002));?> />
		  <input type="button" class="button2" value="選擇" /> <?php } ?>
		  
             <?php  if($this->uri->segment(3)=="display33" || $this->uri->segment(3)=="filter33") { ?>
			 <input type="hidden" class="smq001" name="smq001" value=<? echo $row->mq001;?> />
		      <input type="hidden" class="smq002" name="smq002" value=<? echo urldecode(urldecode($row->mq002));?> />
		  <input type="button" class="button3" value="選擇" /> <?php } ?>
		  
		    <?php  if($this->uri->segment(3)=="display34" || $this->uri->segment(3)=="filter34") { ?>
			 <input type="hidden" class="smq001" name="smq001" value=<? echo $row->mq001;?> />
		  <input type="hidden" class="smq002" name="smq002" value=<? echo urldecode(urldecode($row->mq002));?> />			
		  <input type="button" class="button4" value="選擇" /> <?php } ?>	
		  
		   <?php  if($this->uri->segment(3)=="display35" || $this->uri->segment(3)=="filter35") { ?>
			 <input type="hidden" class="smq001" name="smq001" value=<? echo $row->mq001;?> />
		  <input type="hidden" class="smq002" name="smq002" value=<? echo urldecode(urldecode($row->mq002));?> />			
		  <input type="button" class="button5" value="選擇" /> <?php } ?>	
		  
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
		  //  var smq001 = encodeURIComponent($(this).parent().find('.smq001').val());
		//	var smq001 = $(this).parent().find('.smq001').val();
            var smq001 = $(this).parent().find('.smq001').val();
			var smq002 = $(this).parent().find('.smq002').val() ;			
			window.parent.$.unblockUI();
			window.parent.addpurq04a31(smq001,smq002);
		});
		
		$('.button2').click(function() {
		  //  var smq001 = encodeURIComponent($(this).parent().find('.smq001').val());
			var smq001 = $(this).parent().find('.smq001').val();
			var smq002 = $(this).parent().find('.smq002').val() ;			
			window.parent.$.unblockUI();
			window.parent.addpurq04a32(smq001,smq002);
		});
		
		$('.button3').click(function() {
		  //  var smq001 = encodeURIComponent($(this).parent().find('.smq001').val());
			var smq001 = $(this).parent().find('.smq001').val();
			var smq002 = $(this).parent().find('.smq002').val();			
			window.parent.$.unblockUI();
			window.parent.addpurq04a33(smq001,smq002);
		});
		
		$('.button4').click(function() {
		  //  var smq001 = encodeURIComponent($(this).parent().find('.smq001').val());
			var smq001 = $(this).parent().find('.smq001').val();
			var smq002 = $(this).parent().find('.smq002').val();
		
			window.parent.$.unblockUI();
			window.parent.addpurq04a34(smq001,smq002);
		});
		$('.button5').click(function() {
		  //  var smq001 = encodeURIComponent($(this).parent().find('.smq001').val());
			var smq001 = $(this).parent().find('.smq001').val();
			var smq002 = $(this).parent().find('.smq002').val();
		
			window.parent.$.unblockUI();
			window.parent.addpurq04a35(smq001,smq002);
		});
    });
</script>

<script type="text/javascript"><!--
$(document).ready(function() {
//	$('.button-search').bind('click', function() {
//		filter1();
//	});
});

function filter31() {
	var filter_mq001 = $('input[name=\'filter_mq001\']').attr('value');
	if (filter_mq001) {
	   
		url = '<?=base_url()?>index.php/pur/purq04a/filter31/mq001/asc/' + filter_mq001 ;
	} 
	
	var filter_mq002 = $('input[name=\'filter_mq002\']').attr('value');
	if (filter_mq002) {
		url = '<?=base_url()?>index.php/pur/purq04a/filter31/mq002/asc/' + encodeURIComponent(filter_mq002);
	}
	
    if ( !filter_mq001  && !filter_mq002 ) {         
	   url = '<?=base_url()?>index.php/pur/purq04a/display31/';location = url;
	   
	   }
	   
	location = url;
}
function filter32() {
	var filter_mq001 = $('input[name=\'filter_mq001\']').attr('value');
	if (filter_mq001) {
	   
		url = '<?=base_url()?>index.php/pur/purq04a/filter32/mq001/asc/' + filter_mq001 ;
	} 
	
	var filter_mq002 = $('input[name=\'filter_mq002\']').attr('value');
	if (filter_mq002) {
		url = '<?=base_url()?>index.php/pur/purq04a/filter32/mq002/asc/' + encodeURIComponent(filter_mq002);
	}
	
    if ( !filter_mq001  && !filter_mq002 ) {         
	   url = '<?=base_url()?>index.php/pur/purq04a/display32/';location = url;
	   
	   }
	   
	location = url;
}

function filter33() {
	var filter_mq001 = $('input[name=\'filter_mq001\']').attr('value');
	if (filter_mq001) {
	   
		url = '<?=base_url()?>index.php/pur/purq04a/filter33/mq001/asc/' + filter_mq001 ;
	} 
	
	var filter_mq002 = $('input[name=\'filter_mq002\']').attr('value');
	if (filter_mq002) {
		url = '<?=base_url()?>index.php/pur/purq04a/filter33/mq002/asc/' + encodeURIComponent(filter_mq002);
	}
	
    if ( !filter_mq001  && !filter_mq002 ) {         
	   url = '<?=base_url()?>index.php/pur/purq04a/display33/';location = url;
	   
	   }
	   
	location = url;
}

function filter34() {
	var filter_mq001 = $('input[name=\'filter_mq001\']').attr('value');
	if (filter_mq001) {
	   
		url = '<?=base_url()?>index.php/pur/purq04a/filter34/mq001/asc/' + filter_mq001 ;
	} 
	
	var filter_mq002 = $('input[name=\'filter_mq002\']').attr('value');
	if (filter_mq002) {
		url = '<?=base_url()?>index.php/pur/purq04a/filter34/mq002/asc/' + encodeURIComponent(filter_mq002);
	}
	
    if ( !filter_mq001  && !filter_mq002 ) {         
	   url = '<?=base_url()?>index.php/pur/purq04a/display34/';location = url;
	   
	   }
	   
	location = url;
}

function filter35() {
	var filter_mq001 = $('input[name=\'filter_mq001\']').attr('value');
	if (filter_mq001) {
	   
		url = '<?=base_url()?>index.php/pur/purq04a/filter35/mq001/asc/' + filter_mq001 ;
	} 
	
	var filter_mq002 = $('input[name=\'filter_mq002\']').attr('value');
	if (filter_mq002) {
		url = '<?=base_url()?>index.php/pur/purq04a/filter35/mq002/asc/' + encodeURIComponent(filter_mq002);
	}
	
    if ( !filter_mq001  && !filter_mq002 ) {         
	   url = '<?=base_url()?>index.php/pur/purq04a/display35/';location = url;
	   
	   }
	   
	location = url;
}

//--></script>
</body>
</html>