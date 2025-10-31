<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
<title>單別視窗查詢</title>
<?php $this->load->helper('url');?>
<?php $this->load->library("session"); ?>
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
		 <?php  if($this->uri->segment(3)=="display51" || $this->uri->segment(3)=="filter51") {
		          echo anchor("fun/mocq01a/display51/mq001/" . (($sort_order == 'asc' && $sort_by == 'mq001') ? 'desc' : 'asc') ,'製令單別');} ?>
				 
	     
		 <?php  if($this->uri->segment(3)=="display52" || $this->uri->segment(3)=="filter52") {
		          echo anchor("fun/mocq01a/display52/mq001/" . (($sort_order == 'asc' && $sort_by == 'mq001') ? 'desc' : 'asc') ,'重工單別');} ?>
		  
		  <?php  if($this->uri->segment(3)=="display54" || $this->uri->segment(3)=="filter54") {
		          echo anchor("fun/mocq01a/display54/mq001/" . (($sort_order == 'asc' && $sort_by == 'mq001') ? 'desc' : 'asc') ,'廠內領料單別');} ?>
		   <?php  if($this->uri->segment(3)=="display55" || $this->uri->segment(3)=="filter55") {
		          echo anchor("fun/mocq01a/display55/mq001/" . (($sort_order == 'asc' && $sort_by == 'mq001') ? 'desc' : 'asc') ,'託外領料單別');} ?>
		  <?php  if($this->uri->segment(3)=="display56" || $this->uri->segment(3)=="filter56") {
		          echo anchor("fun/mocq01a/display56/mq001/" . (($sort_order == 'asc' && $sort_by == 'mq001') ? 'desc' : 'asc') ,'廠內退料單別');} ?>
				  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
		  </td>
	      <td width="10%" class="left"> 
		   <?php  if($this->uri->segment(3)=="display51" || $this->uri->segment(3)=="filter51") {
		         echo anchor("fun/mocq01a/display51/mq002/" . (($sort_order == 'asc' && $sort_by == 'mq002') ? 'desc' : 'asc') ,'製令單名稱');} ?>
		   <?php  if($this->uri->segment(3)=="display52" || $this->uri->segment(3)=="filter52") {
		         echo anchor("fun/mocq01a/display52/mq002/" . (($sort_order == 'asc' && $sort_by == 'mq002') ? 'desc' : 'asc') ,'重工單名稱');} ?>
		   <?php  if($this->uri->segment(3)=="display54" || $this->uri->segment(3)=="filter54") {
		         echo anchor("fun/mocq01a/display54/mq002/" . (($sort_order == 'asc' && $sort_by == 'mq002') ? 'desc' : 'asc') ,'廠內領料單名稱');} ?>	
				 
           <?php  if($this->uri->segment(3)=="display55" || $this->uri->segment(3)=="filter55") {
		         echo anchor("fun/mocq01a/display55/mq002/" . (($sort_order == 'asc' && $sort_by == 'mq002') ? 'desc' : 'asc') ,'託外領料單名稱');} ?>	
           <?php  if($this->uri->segment(3)=="display56" || $this->uri->segment(3)=="filter56") {
		         echo anchor("fun/mocq01a/display56/mq002/" . (($sort_order == 'asc' && $sort_by == 'mq002') ? 'desc' : 'asc') ,'廠內退料單名稱');} ?> 				 
			    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			 </td>
	    
	      <td width="7%" class="center">&nbsp選擇&nbsp </td>
           
            </tr>
          </thead>
           <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_mq001='';$filter_mq002='';$filter_mq003='';$filter_mq004='';$filter_mq005='';$filter_mq006='';$filter_create=''; ?>
	     <tr class="filter">
	     
	      
	      <td class="left">
		  <div id="search">
		  <div  class="button-search"></div>
		    <?php  if($this->uri->segment(3)=="display51" || $this->uri->segment(3)=="filter51") { ?>
			<input type="text" id="filter_mq001" name="filter_mq001" value="" onblur="filter51()" size="12" /><span></span>  <?php } ?>	
             <?php  if($this->uri->segment(3)=="display52" || $this->uri->segment(3)=="filter52") { ?>
			<input type="text" id="filter_mq001" name="filter_mq001" value="" onblur="filter52()"  size="12"  /><span></span> <?php } ?>	
              <?php  if($this->uri->segment(3)=="display56" || $this->uri->segment(3)=="filter56") { ?>
			<input type="text" id="filter_mq001" name="filter_mq001" value="" onblur="filter56()"  size="12"  /><span></span> <?php } ?>				
	         <?php  if($this->uri->segment(3)=="display54" || $this->uri->segment(3)=="filter54") { ?>
			<input type="text" id="filter_mq001" name="filter_mq001" value="" onblur="filter54()"  size="12" /><span></span> <?php } ?>	
			 <?php  if($this->uri->segment(3)=="display55" || $this->uri->segment(3)=="filter55") { ?>
			<input type="text" id="filter_mq001" name="filter_mq001" value="" onblur="filter55()"  size="12" /><span></span> <?php } ?>	
		  </td>   
			  
	      <td class="left">
		  <div id="search">
		   <div class="button-search"></div>
		    <?php  if($this->uri->segment(3)=="display51" || $this->uri->segment(3)=="filter51") { ?>
			<input type="text" id="filter_mq002" name="filter_mq002" value="" onblur="filter51()"  size="12"  /><span></span> <?php } ?>	
			<?php  if($this->uri->segment(3)=="display52" || $this->uri->segment(3)=="filter52") { ?>
			<input type="text" id="filter_mq002" name="filter_mq002" value="" onblur="filter52()"  size="12" /><span></span> <?php } ?>	
			
			<?php  if($this->uri->segment(3)=="display54" || $this->uri->segment(3)=="filter54") { ?>
			<input type="text" id="filter_mq002" name="filter_mq002" value="" onblur="filter54()"  size="12" /><span></span> <?php } ?>	
			<?php  if($this->uri->segment(3)=="display55" || $this->uri->segment(3)=="filter55") { ?>
			<input type="text" id="filter_mq002" name="filter_mq002" value="" onblur="filter55()"  size="12" /><span></span> <?php } ?>	
			<?php  if($this->uri->segment(3)=="display56" || $this->uri->segment(3)=="filter56") { ?>
			<input type="text" id="filter_mq002" name="filter_mq002" value="" onblur="filter56()"  size="12" /><span></span> <?php } ?>	
		  </div>			  
	      </td>	 
		   <td  align="center">&nbsp;&nbsp;</td>
	   
            </tr>
			
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
            <tr>
		  <td class="left"><?php echo  $row->mq001;?></td>
		  <td class="left"><?php echo  $row->mq002;?></td>
		  <td class="center">
	
		  
		   <?php  if($this->uri->segment(3)=="display51" || $this->uri->segment(3)=="filter51") { ?>
			  <input type="hidden" class="smq001" name="smq001" value=<?php echo  $row->mq001;?> />
		      <input type="hidden" class="smq002" name="smq002" value=<?php echo  urldecode(urldecode($row->mq002));?> />
		      <input type="button" class="button1" value="選擇" /><?php } ?>

	
		  
		    <?php  if($this->uri->segment(3)=="display52" || $this->uri->segment(3)=="filter52") { ?>
			  <input type="hidden" class="smq001" name="smq001" value=<?php echo  $row->mq001;?> />
		      <input type="hidden" class="smq002" name="smq002" value=<?php echo  urldecode(urldecode($row->mq002));?> />
		  <input type="button" class="button2" value="選擇" /> <?php } ?>
		  
		    <?php  if($this->uri->segment(3)=="display54" || $this->uri->segment(3)=="filter54") { ?>
			 <input type="hidden" class="smq001" name="smq001" value=<?php echo  $row->mq001;?> />
		  <input type="hidden" class="smq002" name="smq002" value=<?php echo  urldecode(urldecode($row->mq002));?> />			
		  <input type="button" class="button4" value="選擇" /> <?php } ?>	
		  
		   <?php  if($this->uri->segment(3)=="display55" || $this->uri->segment(3)=="filter55") { ?>
			 <input type="hidden" class="smq001" name="smq001" value=<?php echo  $row->mq001;?> />
		  <input type="hidden" class="smq002" name="smq002" value=<?php echo  urldecode(urldecode($row->mq002));?> />			
		  <input type="button" class="button5" value="選擇" /> <?php } ?>
          <?php  if($this->uri->segment(3)=="display56" || $this->uri->segment(3)=="filter56") { ?>
			 <input type="hidden" class="smq001" name="smq001" value=<?php echo  $row->mq001;?> />
		      <input type="hidden" class="smq002" name="smq002" value=<?php echo  urldecode(urldecode($row->mq002));?> />
		  <input type="button" class="button3" value="選擇" /> <?php } ?>
		  
		  
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
			window.parent.addmocq01a51(smq001,smq002);
		});
		
		$('.button2').click(function() {
		  //  var smq001 = encodeURIComponent($(this).parent().find('.smq001').val());
			var smq001 = $(this).parent().find('.smq001').val();
			var smq002 = $(this).parent().find('.smq002').val() ;			
			window.parent.$.unblockUI();
			window.parent.addmocq01a52(smq001,smq002);
		});
		
		$('.button3').click(function() {
		  //  var smq001 = encodeURIComponent($(this).parent().find('.smq001').val());
			var smq001 = $(this).parent().find('.smq001').val();
			var smq002 = $(this).parent().find('.smq002').val();			
			window.parent.$.unblockUI();
			window.parent.addmocq01a56(smq001,smq002);
		});
		
		$('.button4').click(function() {
		  //  var smq001 = encodeURIComponent($(this).parent().find('.smq001').val());
			var smq001 = $(this).parent().find('.smq001').val();
			var smq002 = $(this).parent().find('.smq002').val();
		
			window.parent.$.unblockUI();
			window.parent.addmocq01a54(smq001,smq002);
		});
		$('.button5').click(function() {
		  //  var smq001 = encodeURIComponent($(this).parent().find('.smq001').val());
			var smq001 = $(this).parent().find('.smq001').val();
			var smq002 = $(this).parent().find('.smq002').val();
		
			window.parent.$.unblockUI();
			window.parent.addmocq01a55(smq001,smq002);
		});
    });
</script>

<script type="text/javascript"><!--
$(document).ready(function() {
//	$('.button-search').bind('click', function() {
//		filter1();
//	});
});

function filter51() {
	var filter_mq001 = $('input[name=\'filter_mq001\']').val();
	if (filter_mq001) {
	   
		url = '<?php echo base_url()?>index.php/fun/mocq01a/filter51/mq001/asc/' + filter_mq001 ;
	} 
	
	var filter_mq002 = $('input[name=\'filter_mq002\']').val();
	if (filter_mq002) {
		url = '<?php echo base_url()?>index.php/fun/mocq01a/filter51/mq002/asc/' + encodeURIComponent(filter_mq002);
	}
	
    if ( !filter_mq001  && !filter_mq002 ) {         
	   url = '<?php echo base_url()?>index.php/fun/mocq01a/display51/';location = url;
	   
	   }
	   
	location = url;
}
function filter52() {
	var filter_mq001 = $('input[name=\'filter_mq001\']').val();
	if (filter_mq001) {
	   
		url = '<?php echo base_url()?>index.php/fun/mocq01a/filter52/mq001/asc/' + filter_mq001 ;
	} 
	
	var filter_mq002 = $('input[name=\'filter_mq002\']').val();
	if (filter_mq002) {
		url = '<?php echo base_url()?>index.php/fun/mocq01a/filter52/mq002/asc/' + encodeURIComponent(filter_mq002);
	}
	
    if ( !filter_mq001  && !filter_mq002 ) {         
	   url = '<?php echo base_url()?>index.php/fun/mocq01a/display52/';location = url;
	   
	   }
	   
	location = url;
}

function filter56() {
	var filter_mq001 = $('input[name=\'filter_mq001\']').val();
	if (filter_mq001) {
	   
		url = '<?php echo base_url()?>index.php/fun/mocq01a/filter56/mq001/asc/' + filter_mq001 ;
	} 
	
	var filter_mq002 = $('input[name=\'filter_mq002\']').val();
	if (filter_mq002) {
		url = '<?php echo base_url()?>index.php/fun/mocq01a/filter56/mq002/asc/' + encodeURIComponent(filter_mq002);
	}
	
    if ( !filter_mq001  && !filter_mq002 ) {         
	   url = '<?php echo base_url()?>index.php/fun/mocq01a/display56/';location = url;
	   
	   }
	   
	location = url;
}

function filter54() {
	var filter_mq001 = $('input[name=\'filter_mq001\']').val();
	if (filter_mq001) {
	   
		url = '<?php echo base_url()?>index.php/fun/mocq01a/filter54/mq001/asc/' + filter_mq001 ;
	} 
	
	var filter_mq002 = $('input[name=\'filter_mq002\']').val();
	if (filter_mq002) {
		url = '<?php echo base_url()?>index.php/fun/mocq01a/filter54/mq002/asc/' + encodeURIComponent(filter_mq002);
	}
	
    if ( !filter_mq001  && !filter_mq002 ) {         
	   url = '<?php echo base_url()?>index.php/fun/mocq01a/display54/';location = url;
	   
	   }
	   
	location = url;
}

function filter55() {
	var filter_mq001 = $('input[name=\'filter_mq001\']').val();
	if (filter_mq001) {
	   
		url = '<?php echo base_url()?>index.php/fun/mocq01a/filter55/mq001/asc/' + filter_mq001 ;
	} 
	
	var filter_mq002 = $('input[name=\'filter_mq002\']').val();
	if (filter_mq002) {
		url = '<?php echo base_url()?>index.php/fun/mocq01a/filter55/mq002/asc/' + encodeURIComponent(filter_mq002);
	}
	
    if ( !filter_mq001  && !filter_mq002 ) {         
	   url = '<?php echo base_url()?>index.php/fun/mocq01a/display55/';location = url;
	   
	   }
	   
	location = url;
}

//--></script>
</body>
</html>