<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>單據別視窗查詢</title>
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
		          echo anchor("fun/invq04a/display1/mq001/" . (($sort_order == 'asc' && $sort_by == 'mq001') ? 'desc' : 'asc') ,'一般異動單別');} ?>
	     
		 <?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") {
		          echo anchor("fun/invq04a/display2/mq001/" . (($sort_order == 'asc' && $sort_by == 'mq001') ? 'desc' : 'asc') ,'庫存轉撥單別');} ?>  
				  
	     <?php  if($this->uri->segment(3)=="display3" || $this->uri->segment(3)=="filter3") {
		          echo anchor("fun/invq04a/display3/mq001/" . (($sort_order == 'asc' && $sort_by == 'mq001') ? 'desc' : 'asc') ,'借出轉撥單別');} ?>
				  
		<?php  if($this->uri->segment(3)=="display4" || $this->uri->segment(3)=="filter4") {
		          echo anchor("fun/invq04a/display4/mq001/" . (($sort_order == 'asc' && $sort_by == 'mq001') ? 'desc' : 'asc') ,'借入暫收單別');} ?> 
	    <?php  if($this->uri->segment(3)=="display5" || $this->uri->segment(3)=="filter5") {
		          echo anchor("fun/invq04a/display5/mq001/" . (($sort_order == 'asc' && $sort_by == 'mq001') ? 'desc' : 'asc') ,'借出歸還單別');} ?> 
	    <?php  if($this->uri->segment(3)=="display6" || $this->uri->segment(3)=="filter6") {
		          echo anchor("fun/invq04a/display6/mq001/" . (($sort_order == 'asc' && $sort_by == 'mq001') ? 'desc' : 'asc') ,'借入歸還單別');} ?>
        <?php  if($this->uri->segment(3)=="display7" || $this->uri->segment(3)=="filter7") {
		          echo anchor("fun/invq04a/display7/mq001/" . (($sort_order == 'asc' && $sort_by == 'mq001') ? 'desc' : 'asc') ,'開帳調整單別');} ?> 				  
		  </td>
	      <td width="16%" class="left"> 
		   <?php  if($this->uri->segment(3)=="display1" || $this->uri->segment(3)=="filter1") {
		         echo anchor("fun/invq04a/display1/mq002/" . (($sort_order == 'asc' && $sort_by == 'mq002') ? 'desc' : 'asc') ,'一般異動名稱');} ?>
           
		   <?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") {
		         echo anchor("fun/invq04a/display2/mq002/" . (($sort_order == 'asc' && $sort_by == 'mq002') ? 'desc' : 'asc') ,'庫存轉撥名稱');} ?> 
				 
			<?php  if($this->uri->segment(3)=="display3" || $this->uri->segment(3)=="filter3") {
		         echo anchor("fun/invq04a/display3/mq002/" . (($sort_order == 'asc' && $sort_by == 'mq002') ? 'desc' : 'asc') ,'借出轉撥名稱');} ?>  
				 
            <?php  if($this->uri->segment(3)=="display4" || $this->uri->segment(3)=="filter4") {
		         echo anchor("fun/invq04a/display4/mq002/" . (($sort_order == 'asc' && $sort_by == 'mq002') ? 'desc' : 'asc') ,'借入暫收名稱');} ?>  
            <?php  if($this->uri->segment(3)=="display5" || $this->uri->segment(3)=="filter5") {
		         echo anchor("fun/invq04a/display5/mq002/" . (($sort_order == 'asc' && $sort_by == 'mq002') ? 'desc' : 'asc') ,'借出歸還名稱');} ?> 
            <?php  if($this->uri->segment(3)=="display6" || $this->uri->segment(3)=="filter6") {
		         echo anchor("fun/invq04a/display6/mq002/" . (($sort_order == 'asc' && $sort_by == 'mq002') ? 'desc' : 'asc') ,'借入歸還名稱');} ?> 
            <?php  if($this->uri->segment(3)=="display7" || $this->uri->segment(3)=="filter7") {
		         echo anchor("fun/invq04a/display7/mq002/" . (($sort_order == 'asc' && $sort_by == 'mq002') ? 'desc' : 'asc') ,'開帳調整名稱');} ?> 				 
			 </td>
	    
	      <td width="18%" class="center">&nbsp選擇&nbsp </td>
           
            </tr>
          </thead>
           <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_mq001='*';$filter_mq002='';$filter_mq003='';$filter_mq004='';$filter_mq005='';$filter_mq006='';$filter_create=''; ?>
	     <tr class="filter">
	    	      
	      <td class="left">
		   <div id="search">
		  <div  class="button-search"></div>
		    <?php  if($this->uri->segment(3)=="display1" || $this->uri->segment(3)=="filter1") { ?>
			<input type="text" id="filter_mq002" name="filter_mq002" value="" onblur="filter1()" /><span></span>  <?php } ?>
			
             <?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") { ?>			 
			<input type="text" id="filter_mq002" name="filter_mq002" value="" onblur="filter2()" /><span></span> <?php } ?>	
			
             <?php  if($this->uri->segment(3)=="display3" || $this->uri->segment(3)=="filter3") { ?>			 
			<input type="text" id="filter_mq002" name="filter_mq002" value="" onblur="filter3()" /><span></span> <?php } ?>	
			
              <?php  if($this->uri->segment(3)=="display4" || $this->uri->segment(3)=="filter4") { ?>			  
			<input type="text" id="filter_mq002" name="filter_mq002" value="" onblur="filter4()" /><span></span> <?php } ?>	
			
			            <?php  if($this->uri->segment(3)=="display5" || $this->uri->segment(3)=="filter5") { ?>			  
			<input type="text" id="filter_mq002" name="filter_mq002" value="" onblur="filter5()" /><span></span> <?php } ?>	
			            <?php  if($this->uri->segment(3)=="display6" || $this->uri->segment(3)=="filter6") { ?>			  
			<input type="text" id="filter_mq002" name="filter_mq002" value="" onblur="filter6()" /><span></span> <?php } ?>	
			
			            <?php  if($this->uri->segment(3)=="display7" || $this->uri->segment(3)=="filter7") { ?>			  
			<input type="text" id="filter_mq002" name="filter_mq002" value="" onblur="filter7()" /><span></span> <?php } ?>	
			  </div>    
		  </td>   
			  
	      <td class="left">
		  <div id="search">
		   <div class="button-search"></div>
		    <?php  if($this->uri->segment(3)=="display1" || $this->uri->segment(3)=="filter1") { ?>
			<input type="text" id="filter_mq003" name="filter_mq003" value="" onblur="filter1()" /><span></span> <?php } ?>	
			
			<?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") { ?>
			<input type="text" id="filter_mq003" name="filter_mq003" value="" onblur="filter2()" /><span></span> <?php } ?>	
			
			<?php  if($this->uri->segment(3)=="display3" || $this->uri->segment(3)=="filter3") { ?>
			<input type="text" id="filter_mq003" name="filter_mq003" value="" onblur="filter3()" /><span></span> <?php } ?>	
			
           <?php  if($this->uri->segment(3)=="display4" || $this->uri->segment(3)=="filter4") { ?>
			<input type="text" id="filter_mq003" name="filter_mq003" value="" onblur="filter4()" /><span></span> <?php } ?>	
			
          <?php  if($this->uri->segment(3)=="display5" || $this->uri->segment(3)=="filter5") { ?>
			<input type="text" id="filter_mq003" name="filter_mq003" value="" onblur="filter5()" /><span></span> <?php } ?>	
          <?php  if($this->uri->segment(3)=="display6" || $this->uri->segment(3)=="filter6") { ?>
			<input type="text" id="filter_mq003" name="filter_mq003" value="" onblur="filter6()" /><span></span> <?php } ?>	
          <?php  if($this->uri->segment(3)=="display7" || $this->uri->segment(3)=="filter7") { ?>
			<input type="text" id="filter_mq003" name="filter_mq003" value="" onblur="filter7()" /><span></span> <?php } ?>				
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
		  
		   <?php  if($this->uri->segment(3)=="display1" || $this->uri->segment(3)=="filter1") { ?>
			  <input type="hidden" class="smq001" name="smq001" value=<?php echo  $row->mq001;?> />
		      <input type="hidden" class="smq002" name="smq002" value=<?php echo  urldecode(urldecode($row->mq002));?> />
		      <input type="button" class="button1" value="選擇" /><?php } ?>
		  
		    <?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") { ?>
			  <input type="hidden" class="smq001" name="smq001" value=<?php echo  $row->mq001;?> />
		      <input type="hidden" class="smq002" name="smq002" value=<?php echo  urldecode(urldecode($row->mq002));?> />
		  <input type="button" class="button2" value="選擇" /> <?php } ?>
		  
		  <?php  if($this->uri->segment(3)=="display3" || $this->uri->segment(3)=="filter3") { ?>
			  <input type="hidden" class="smq001" name="smq001" value=<?php echo  $row->mq001;?> />
		      <input type="hidden" class="smq002" name="smq002" value=<?php echo  urldecode(urldecode($row->mq002));?> />
		  <input type="button" class="button3" value="選擇" /> <?php } ?>
		  <?php  if($this->uri->segment(3)=="display4" || $this->uri->segment(3)=="filter4") { ?>
			  <input type="hidden" class="smq001" name="smq001" value=<?php echo  $row->mq001;?> />
		      <input type="hidden" class="smq002" name="smq002" value=<?php echo  urldecode(urldecode($row->mq002));?> />
		  <input type="button" class="button4" value="選擇" /> <?php } ?>
		  
		  <?php  if($this->uri->segment(3)=="display5" || $this->uri->segment(3)=="filter5") { ?>
			  <input type="hidden" class="smq001" name="smq001" value=<?php echo  $row->mq001;?> />
		      <input type="hidden" class="smq002" name="smq002" value=<?php echo  urldecode(urldecode($row->mq002));?> />
		  <input type="button" class="button5" value="選擇" /> <?php } ?>
		  
		  <?php  if($this->uri->segment(3)=="display6" || $this->uri->segment(3)=="filter6") { ?>
			  <input type="hidden" class="smq001" name="smq001" value=<?php echo  $row->mq001;?> />
		      <input type="hidden" class="smq002" name="smq002" value=<?php echo  urldecode(urldecode($row->mq002));?> />
		  <input type="button" class="button6" value="選擇" /> <?php } ?>
		  
		  <?php  if($this->uri->segment(3)=="display7" || $this->uri->segment(3)=="filter7") { ?>
			  <input type="hidden" class="smq001" name="smq001" value=<?php echo  $row->mq001;?> />
		      <input type="hidden" class="smq002" name="smq002" value=<?php echo  urldecode(urldecode($row->mq002));?> />
		  <input type="button" class="button7" value="選擇" /> <?php } ?>
		  
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
			window.parent.addinvq04a11(smq001,smq002);
		});
		
		$('.button2').click(function() {
		  //  var smq001 = encodeURIComponent($(this).parent().find('.smq001').val());
			var smq001 = $(this).parent().find('.smq001').val();
			var smq002 = $(this).parent().find('.smq002').val() ;			
			window.parent.$.unblockUI();
			window.parent.addinvq04a12(smq001,smq002);
		});
		$('.button3').click(function() {
		  //  var smq001 = encodeURIComponent($(this).parent().find('.smq001').val());
			var smq001 = $(this).parent().find('.smq001').val();
			var smq002 = $(this).parent().find('.smq002').val() ;			
			window.parent.$.unblockUI();
			window.parent.addinvq04a13(smq001,smq002);
		});
		$('.button4').click(function() {
		  //  var smq001 = encodeURIComponent($(this).parent().find('.smq001').val());
			var smq001 = $(this).parent().find('.smq001').val();
			var smq002 = $(this).parent().find('.smq002').val() ;			
			window.parent.$.unblockUI();
			window.parent.addinvq04a14(smq001,smq002);
		});
		
				$('.button5').click(function() {
		  //  var smq001 = encodeURIComponent($(this).parent().find('.smq001').val());
			var smq001 = $(this).parent().find('.smq001').val();
			var smq002 = $(this).parent().find('.smq002').val() ;			
			window.parent.$.unblockUI();
			window.parent.addinvq04a15(smq001,smq002);
		});
		
				$('.button6').click(function() {
		  //  var smq001 = encodeURIComponent($(this).parent().find('.smq001').val());
			var smq001 = $(this).parent().find('.smq001').val();
			var smq002 = $(this).parent().find('.smq002').val() ;			
			window.parent.$.unblockUI();
			window.parent.addinvq04a16(smq001,smq002);
		});
		
				$('.button7').click(function() {
		  //  var smq001 = encodeURIComponent($(this).parent().find('.smq001').val());
			var smq001 = $(this).parent().find('.smq001').val();
			var smq002 = $(this).parent().find('.smq002').val() ;			
			window.parent.$.unblockUI();
			window.parent.addinvq04a17(smq001,smq002);
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
	var filter_mq002 = $('input[name=\'filter_mq002\']').val();
	if (filter_mq002) {
	   
		url = '<?php echo base_url()?>index.php/fun/invq04a/filter1/mq001/asc/' + filter_mq002 ;
	} 
	
	var filter_mq003 = $('input[name=\'filter_mq003\']').val();
	if (filter_mq003) {
		url = '<?php echo base_url()?>index.php/fun/invq04a/filter1/mq002/asc/' + encodeURIComponent(filter_mq003);
	}
	
    if ( !filter_mq002  && !filter_mq003 ) {         
	   url = '<?php echo base_url()?>index.php/fun/invq04a/display1/';location = url;
	   
	   }
	   
	location = url;
}

function filter2() {
	var filter_mq002 = $('input[name=\'filter_mq002\']').val();
	if (filter_mq002) {
	   
		url = '<?php echo base_url()?>index.php/fun/invq04a/filter2/mq001/asc/' + filter_mq002 ;
	} 
	
	var filter_mq003 = $('input[name=\'filter_mq003\']').val();
	if (filter_mq003) {
		url = '<?php echo base_url()?>index.php/fun/invq04a/filter2/mq002/asc/' + encodeURIComponent(filter_mq003);
	}
	
    if ( !filter_mq002  && !filter_mq003 ) {         
	   url = '<?php echo base_url()?>index.php/fun/invq04a/display2/';location = url;
	   
	   }
	   
	location = url;
}

function filter3() {
	var filter_mq002 = $('input[name=\'filter_mq002\']').val();
	if (filter_mq002) {
	   
		url = '<?php echo base_url()?>index.php/fun/invq04a/filter3/mq001/asc/' + filter_mq002 ;
	} 
	
	var filter_mq003 = $('input[name=\'filter_mq003\']').val();
	if (filter_mq003) {
		url = '<?php echo base_url()?>index.php/fun/invq04a/filter3/mq002/asc/' + encodeURIComponent(filter_mq003);
	}
	
    if ( !filter_mq002  && !filter_mq003 ) {         
	   url = '<?php echo base_url()?>index.php/fun/invq04a/display3/';location = url;
	   
	   }
	   
	location = url;
}
function filter4() {
	var filter_mq002 = $('input[name=\'filter_mq002\']').val();
	if (filter_mq002) {
	   
		url = '<?php echo base_url()?>index.php/fun/invq04a/filter4/mq001/asc/' + filter_mq002 ;
	} 
	
	var filter_mq003 = $('input[name=\'filter_mq003\']').val();
	if (filter_mq003) {
		url = '<?php echo base_url()?>index.php/fun/invq04a/filter4/mq002/asc/' + encodeURIComponent(filter_mq003);
	}
	
    if ( !filter_mq002  && !filter_mq003 ) {         
	   url = '<?php echo base_url()?>index.php/fun/invq04a/display4/';location = url;
	   
	   }
	   
	location = url;
}

function filter5() {
	var filter_mq002 = $('input[name=\'filter_mq002\']').val();
	if (filter_mq002) {
	   
		url = '<?php echo base_url()?>index.php/fun/invq04a/filter5/mq001/asc/' + filter_mq002 ;
	} 
	
	var filter_mq003 = $('input[name=\'filter_mq003\']').val();
	if (filter_mq003) {
		url = '<?php echo base_url()?>index.php/fun/invq04a/filter5/mq002/asc/' + encodeURIComponent(filter_mq003);
	}
	
    if ( !filter_mq002  && !filter_mq003 ) {         
	   url = '<?php echo base_url()?>index.php/fun/invq04a/display5/';location = url;
	   
	   }
	   
	location = url;
}
function filter6() {
	var filter_mq002 = $('input[name=\'filter_mq002\']').val();
	if (filter_mq002) {
	   
		url = '<?php echo base_url()?>index.php/fun/invq04a/filter6/mq001/asc/' + filter_mq002 ;
	} 
	
	var filter_mq003 = $('input[name=\'filter_mq003\']').val();
	if (filter_mq003) {
		url = '<?php echo base_url()?>index.php/fun/invq04a/filter6/mq002/asc/' + encodeURIComponent(filter_mq003);
	}
	
    if ( !filter_mq002  && !filter_mq003 ) {         
	   url = '<?php echo base_url()?>index.php/fun/invq04a/display6/';location = url;
	   
	   }
	   
	location = url;
}
function filter7() {
	var filter_mq002 = $('input[name=\'filter_mq002\']').val();
	if (filter_mq002) {
	   
		url = '<?php echo base_url()?>index.php/fun/invq04a/filter7/mq001/asc/' + filter_mq002 ;
	} 
	
	var filter_mq003 = $('input[name=\'filter_mq003\']').val();
	if (filter_mq003) {
		url = '<?php echo base_url()?>index.php/fun/invq04a/filter7/mq002/asc/' + encodeURIComponent(filter_mq003);
	}
	
    if ( !filter_mq002  && !filter_mq003 ) {         
	   url = '<?php echo base_url()?>index.php/fun/invq04a/display7/';location = url;
	   
	   }
	   
	location = url;
}
//--></script>
</body>
</html>