<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php $systitle; ?></title>
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

<style>   <!--  頁次顯示方框  -->
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
	          <td width="7%" class="left"> 
			  <?php  if($this->uri->segment(3)=="display" || $this->uri->segment(3)=="filter1" ) {
		          echo anchor("pur/purq01a/display/ma001/" . (($sort_order == 'asc' && $sort_by == 'ma001') ? 'desc' : 'asc') ,'廠商代號'); } ?>
				  
	          <?php  if($this->uri->segment(3)=="displaya" || $this->uri->segment(3)=="filtera" ) {
		          echo anchor("pur/purq01a/display1/ma001/" . (($sort_order == 'asc' && $sort_by == 'ma001') ? 'desc' : 'asc') ,'廠商代號'); } ?>
				  
			  <?php  if($this->uri->segment(3)=="displayb" || $this->uri->segment(3)=="filterb" ) {
		          echo anchor("pur/purq01a/displayb/ma001/" . (($sort_order == 'asc' && $sort_by == 'ma001') ? 'desc' : 'asc') ,'廠商代號'); } ?>
				  
			  <?php  if($this->uri->segment(3)=="displayc" || $this->uri->segment(3)=="filterc" ) {
		          echo anchor("pur/purq01a/displayc/ma001/" . (($sort_order == 'asc' && $sort_by == 'ma001') ? 'desc' : 'asc') ,'廠商代號'); } ?>
				  
              <?php  if($this->uri->segment(3)=="displayd" || $this->uri->segment(3)=="filterd" ) {
		          echo anchor("pur/purq01a/displayd/ma001/" . (($sort_order == 'asc' && $sort_by == 'ma001') ? 'desc' : 'asc') ,'廠商代號'); } ?>				  
				  
			  </td>
	          <td width="16%" class="left"> 
			  <?php  if($this->uri->segment(3)=="display" || $this->uri->segment(3)=="filter1" ) {
		          echo anchor("pur/purq01a/display/ma002/" . (($sort_order == 'asc' && $sort_by == 'ma002') ? 'desc' : 'asc') ,'廠商簡稱'); } ?>
			   
			   <?php  if($this->uri->segment(3)=="displaya" || $this->uri->segment(3)=="filtera" ) {
		          echo anchor("pur/purq01a/displaya/ma002/" . (($sort_order == 'asc' && $sort_by == 'ma002') ? 'desc' : 'asc') ,'廠商簡稱'); } ?>
				  
				<?php  if($this->uri->segment(3)=="displayb" || $this->uri->segment(3)=="filterb" ) {
		          echo anchor("pur/purq01a/displayb/ma002/" . (($sort_order == 'asc' && $sort_by == 'ma002') ? 'desc' : 'asc') ,'廠商簡稱'); } ?>
				<?php  if($this->uri->segment(3)=="displayc" || $this->uri->segment(3)=="filterc" ) {
		          echo anchor("pur/purq01a/displayc/ma002/" . (($sort_order == 'asc' && $sort_by == 'ma002') ? 'desc' : 'asc') ,'廠商簡稱'); } ?>
				<?php  if($this->uri->segment(3)=="displayd" || $this->uri->segment(3)=="filterd" ) {
		          echo anchor("pur/purq01a/displayd/ma002/" . (($sort_order == 'asc' && $sort_by == 'ma002') ? 'desc' : 'asc') ,'廠商簡稱'); } ?>
              
			  </td>
			   <td width="16%" class="left"> 
			   <?php  if($this->uri->segment(3)=="display" || $this->uri->segment(3)=="filter1" ) {
		            echo anchor("pur/purq01a/display/ma008/" . (($sort_order == 'asc' && $sort_by == 'ma008') ? 'desc' : 'asc') ,'電話(一)'); } ?>
             
                <?php  if($this->uri->segment(3)=="displaya" || $this->uri->segment(3)=="filtera" ) {
		            echo anchor("pur/purq01a/displaya/ma008/" . (($sort_order == 'asc' && $sort_by == 'ma008') ? 'desc' : 'asc') ,'電話(一)'); } ?>
				<?php  if($this->uri->segment(3)=="displayb" || $this->uri->segment(3)=="filterb" ) {
		            echo anchor("pur/purq01a/displayb/ma008/" . (($sort_order == 'asc' && $sort_by == 'ma008') ? 'desc' : 'asc') ,'電話(一)'); } ?>
				<?php  if($this->uri->segment(3)=="displayc" || $this->uri->segment(3)=="filterc" ) {
		            echo anchor("pur/purq01a/displayc/ma008/" . (($sort_order == 'asc' && $sort_by == 'ma008') ? 'desc' : 'asc') ,'電話(一)'); } ?>
				<?php  if($this->uri->segment(3)=="displayd" || $this->uri->segment(3)=="filterd" ) {
		            echo anchor("pur/purq01a/displayd/ma008/" . (($sort_order == 'asc' && $sort_by == 'ma008') ? 'desc' : 'asc') ,'電話(一)'); } ?>

			 </td>
			   <td width="7%" class="left"> 
			    <?php  if($this->uri->segment(3)=="display" || $this->uri->segment(3)=="filter1" ) {
		            echo anchor("pur/purq01a/display/ma013/" . (($sort_order == 'asc' && $sort_by == 'ma013') ? 'desc' : 'asc') ,'連絡人');} ?>
					
			    <?php  if($this->uri->segment(3)=="displaya" || $this->uri->segment(3)=="filtera" ) {
		            echo anchor("pur/purq01a/displaya/ma013/" . (($sort_order == 'asc' && $sort_by == 'ma013') ? 'desc' : 'asc') ,'連絡人');} ?>			    <?php  if($this->uri->segment(3)=="display" || $this->uri->segment(3)=="filter" ) {
			    <?php  if($this->uri->segment(3)=="displayb" || $this->uri->segment(3)=="filterb" ) {
		            echo anchor("pur/purq01a/displayb/ma013/" . (($sort_order == 'asc' && $sort_by == 'ma013') ? 'desc' : 'asc') ,'連絡人');} ?>
			    <?php  if($this->uri->segment(3)=="displayc" || $this->uri->segment(3)=="filterc" ) {
		            echo anchor("pur/purq01a/displayc/ma013/" . (($sort_order == 'asc' && $sort_by == 'ma013') ? 'desc' : 'asc') ,'連絡人');} ?>
			    <?php  if($this->uri->segment(3)=="displayd" || $this->uri->segment(3)=="filterd" ) {
		            echo anchor("pur/purq01a/displayd/ma013/" . (($sort_order == 'asc' && $sort_by == 'ma013') ? 'desc' : 'asc') ,'連絡人');} ?>
			  
			  </td>
	      <td width="18%" class="center">&nbsp選擇&nbsp </td>
            </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 清除輸入欄位空白 -->
	        <?php $filter_ma001='';$filter_ma002='';$filter_ma008='';$filter_ma013=''; ?>
	        <tr class="filter">
	          <td class="left">
		        <div  class="button-search"></div>
				   <?php  if($this->uri->segment(3)=="display" || $this->uri->segment(3)=="filter1") { ?>
			       <input type="text" id="filter_ma001" name="filter_ma001" value="" onblur="filter1()" /><span>篩選</span> <?php } ?>
				   
		           <?php  if($this->uri->segment(3)=="displaya" || $this->uri->segment(3)=="filtera") { ?>
			       <input type="text" id="filter_ma001" name="filter_ma001" value="" onblur="filtera()" /><span>篩選</span> <?php } ?>
				   <?php  if($this->uri->segment(3)=="displayb" || $this->uri->segment(3)=="filterb") { ?>
			       <input type="text" id="filter_ma001" name="filter_ma001" value="" onblur="filterb()" /><span>篩選</span> <?php } ?>
				   <?php  if($this->uri->segment(3)=="displayc" || $this->uri->segment(3)=="filterc") { ?>
			       <input type="text" id="filter_ma001" name="filter_ma001" value="" onblur="filterc()" /><span>篩選</span> <?php } ?>
				   <?php  if($this->uri->segment(3)=="displayd" || $this->uri->segment(3)=="filterd") { ?>
			       <input type="text" id="filter_ma001" name="filter_ma001" value="" onblur="filterd()" /><span>篩選</span> <?php } ?>
				
				</td>
				
	          <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
				  <?php  if($this->uri->segment(3)=="display" || $this->uri->segment(3)=="filter1") { ?>
			      <input type="text" id="filter_ma002" name="filter_ma002" value="" onblur="filter1()" /><span>篩選</span> <?php } ?>
				  
				  <?php  if($this->uri->segment(3)=="displaya" || $this->uri->segment(3)=="filtera") { ?>
			      <input type="text" id="filter_ma002" name="filter_ma002" value="" onblur="filtera()" /><span>篩選</span> <?php } ?> 
				  <?php  if($this->uri->segment(3)=="displayb" || $this->uri->segment(3)=="filterb") { ?>
			      <input type="text" id="filter_ma002" name="filter_ma002" value="" onblur="filterb()" /><span>篩選</span> <?php } ?> 
				 <?php  if($this->uri->segment(3)=="displayc" || $this->uri->segment(3)=="filterc") { ?>
			      <input type="text" id="filter_ma002" name="filter_ma002" value="" onblur="filterc()" /><span>篩選</span> <?php } ?>  
				  <?php  if($this->uri->segment(3)=="displayd" || $this->uri->segment(3)=="filterd") { ?>
			      <input type="text" id="filter_ma002" name="filter_ma002" value="" onblur="filterd()" /><span>篩選</span> <?php } ?> 
				  
		       	</div>	  
	          </td>	
			  
              <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
				<?php  if($this->uri->segment(3)=="display" || $this->uri->segment(3)=="filter1") { ?>
			      <input type="text" id="filter_ma008" name="filter_ma008" value="" onblur="filter1()" /><span>篩選</span>  } ?>
				  
		        <?php  if($this->uri->segment(3)=="displaya" || $this->uri->segment(3)=="filtera") { ?>
			      <input type="text" id="filter_ma008" name="filter_ma008" value="" onblur="filtera()" /><span>篩選</span>  } ?>
				<?php  if($this->uri->segment(3)=="displayb" || $this->uri->segment(3)=="filterb") { ?>
			      <input type="text" id="filter_ma008" name="filter_ma008" value="" onblur="filterb()" /><span>篩選</span>  } ?>
				<?php  if($this->uri->segment(3)=="displayc" || $this->uri->segment(3)=="filterc") { ?>
			      <input type="text" id="filter_ma008" name="filter_ma008" value="" onblur="filterc()" /><span>篩選</span>  } ?>
				<?php  if($this->uri->segment(3)=="displayd" || $this->uri->segment(3)=="filterd") { ?>
			      <input type="text" id="filter_ma008" name="filter_ma008" value="" onblur="filterd()" /><span>篩選</span>  } ?>
				
				</div>			  
	          </td>	
			  
              <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
				<?php  if($this->uri->segment(3)=="display" || $this->uri->segment(3)=="filter1") { ?>
			      <input type="text" id="filter_ma013" name="filter_ma013" value="" onblur="filter1()" /><span>篩選</span> } ?>
				  
				<?php  if($this->uri->segment(3)=="displaya" || $this->uri->segment(3)=="filtera") { ?>
			      <input type="text" id="filter_ma013" name="filter_ma013" value="" onblur="filtera()" /><span>篩選</span> } ?>  
				<?php  if($this->uri->segment(3)=="displayb" || $this->uri->segment(3)=="filterb") { ?>
			      <input type="text" id="filter_ma013" name="filter_ma013" value="" onblur="filterb()" /><span>篩選</span> } ?>  
		        <?php  if($this->uri->segment(3)=="displayc" || $this->uri->segment(3)=="filterc") { ?>
			      <input type="text" id="filter_ma013" name="filter_ma013" value="" onblur="filterc()" /><span>篩選</span> } ?>
				 <?php  if($this->uri->segment(3)=="displayd" || $this->uri->segment(3)=="filterd") { ?>
			      <input type="text" id="filter_ma013" name="filter_ma013" value="" onblur="filterd()" /><span>篩選</span> } ?>
			   
			   </div>			  
	          </td>	 
			  
		     <td  align="center">&nbsp;&nbsp;</td>
            </tr>
			
	        <?php $chkval=1; ?>               
	        <?php foreach($results as $row ) : ?>
            <tr>
		      <td class="left"><? echo $row->ma001;?></td>
		      <td class="left"><? echo $row->ma002;?></td>
			  <td class="left"><? echo $row->ma008;?></td>
			  <td class="left"><? echo $row->ma013;?></td>
		      <td class="center">
			   <input type="hidden" class="sma001" name="sma001" value=<? echo $row->ma001;?> />
			   <input type="hidden" class="sma002" name="sma002" value=<? echo urldecode(urldecode($row->ma002));?> />
		       <input type="hidden" class="sma003" name="sma003" value=<? echo urldecode(urldecode($row->ma008));?> />
			   <input type="hidden" class="sma004" name="sma004" value=<? echo urldecode(urldecode($row->ma013));?> />
			   
			   <?php  if($this->uri->segment(3)=="display" || $this->uri->segment(3)=="filter1") { ?>
				<input type="button" class="button" value="選擇" />  <?php } ?>	
				
				<?php  if($this->uri->segment(3)=="displaya" || $this->uri->segment(3)=="filtera") { ?>
				<input type="button" class="buttona" value="選擇" />  <?php } ?>	
				<?php  if($this->uri->segment(3)=="displayb" || $this->uri->segment(3)=="filterb") { ?>
				<input type="button" class="buttonb" value="選擇" />  <?php } ?>	
				<?php  if($this->uri->segment(3)=="displayc" || $this->uri->segment(3)=="filterc") { ?>
				<input type="button" class="buttonc" value="選擇" />  <?php } ?>	
				<?php  if($this->uri->segment(3)=="displayd" || $this->uri->segment(3)=="filterd") { ?>
				<input type="button" class="buttond" value="選擇" />  <?php } ?>	
				
			  </td>
	        </tr>
		    <?php $chkval += 1; ?>
		    <?php endforeach;?>
          </tbody>		 
        </table>
	         <!-- 分頁顯示 -->
			<div class="pagination"><div class="results"><?php echo $pagination.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?></div></div>
			
		  <tfoot>
		  <tr>           
          </tr>
		  </tfoot>
       
      </form>
        </td></tr>
	</table>
<script type="text/javascript">    //傳回庫別名稱
    $(document).ready(function(){
		$('.button').click(function() {
		    var sma001 = $(this).parent().find('.sma001').val();
			var sma002 = $(this).parent().find('.sma002').val() ;
            var sma003 = $(this).parent().find('.sma003').val() ;	
            var sma004 = $(this).parent().find('.sma004').val() ;				
			window.parent.$.unblockUI();
			window.parent.addpurq01a(sma001,sma002,sma003,sma004);
		});
	   	
	    $('.buttona').click(function() {
		    var sma001 = $(this).parent().find('.sma001').val();
			var sma002 = $(this).parent().find('.sma002').val() ;
            var sma003 = $(this).parent().find('.sma003').val() ;	
            var sma004 = $(this).parent().find('.sma004').val() ;				
			window.parent.$.unblockUI();
			window.parent.addpurq01a1(sma001,sma002,sma003,sma004);
		});
       $('.buttonb').click(function() {
		    var sma001 = $(this).parent().find('.sma001').val();
			var sma002 = $(this).parent().find('.sma002').val() ;
            var sma003 = $(this).parent().find('.sma003').val() ;	
            var sma004 = $(this).parent().find('.sma004').val() ;				
			window.parent.$.unblockUI();
			window.parent.addpurq01a2(sma001,sma002,sma003,sma004);
		});
       $('.buttonc').click(function() {
		    var sma001 = $(this).parent().find('.sma001').val();
			var sma002 = $(this).parent().find('.sma002').val() ;
            var sma003 = $(this).parent().find('.sma003').val() ;	
            var sma004 = $(this).parent().find('.sma004').val() ;				
			window.parent.$.unblockUI();
			window.parent.addpurq01a3(sma001,sma002,sma003,sma004);
		});
      $('.buttond').click(function() {
		    var sma001 = $(this).parent().find('.sma001').val();
			var sma002 = $(this).parent().find('.sma002').val() ;
            var sma003 = $(this).parent().find('.sma003').val() ;	
            var sma004 = $(this).parent().find('.sma004').val() ;				
			window.parent.$.unblockUI();
			window.parent.addpurq01a4(sma001,sma002,sma003,sma004);
		});		
	
    });
</script>

<script type="text/javascript"><!--
  function filter1() {
	var filter_ma001 = $('input[name=\'filter_ma001\']').attr('value');
	if (filter_ma001) {
	   url = '<?php echo base_url()?>index.php/pur/purq01a/filter1/ma001/asc/' + filter_ma001 ;
	} 
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').attr('value');
	if (filter_ma002) {
		url = '<?php echo base_url()?>index.php/pur/purq01a/filter1/ma002/asc/' + encodeURIComponent(filter_ma002);
	}
	
	var filter_ma008 = $('input[name=\'filter_ma008\']').attr('value');
	if (filter_ma008) {
		url = '<?php echo base_url()?>index.php/pur/purq01a/filter1/ma008/asc/' + encodeURIComponent(filter_ma008);
	}
	
	var filter_ma013 = $('input[name=\'filter_ma013\']').attr('value');
	if (filter_ma013) {
		url = '<?php echo base_url()?>index.php/pur/purq01a/filter1/ma013/asc/' + encodeURIComponent(filter_ma013);
	}
	
    if ( !filter_ma001  && !filter_ma002  && !filter_ma008  && !filter_ma013 ) {         
	   url = '<?php echo base_url()?>index.php/pur/purq01a/display/';location = url;
	   }
	   
	location = url;
   }
   
   function filtera() {
	var filter_ma001 = $('input[name=\'filter_ma001\']').attr('value');
	if (filter_ma001) {
	   url = '<?php echo base_url()?>index.php/pur/purq01a/filtera/ma001/asc/' + filter_ma001 ;
	} 
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').attr('value');
	if (filter_ma002) {
		url = '<?php echo base_url()?>index.php/pur/purq01a/filtera/ma002/asc/' + encodeURIComponent(filter_ma002);
	}
	
	var filter_ma008 = $('input[name=\'filter_ma008\']').attr('value');
	if (filter_ma008) {
		url = '<?php echo base_url()?>index.php/pur/purq01a/filtera/ma008/asc/' + encodeURIComponent(filter_ma008);
	}
	
	var filter_ma013 = $('input[name=\'filter_ma013\']').attr('value');
	if (filter_ma013) {
		url = '<?php echo base_url()?>index.php/pur/purq01a/filtera/ma013/asc/' + encodeURIComponent(filter_ma013);
	}
	
    if ( !filter_ma001  && !filter_ma002  && !filter_ma008  && !filter_ma013 ) {         
	   url = '<?php echo base_url()?>index.php/pur/purq01a/display/';location = url;
	   }
	   
	location = url;
   }
   
   function filterb() {
	var filter_ma001 = $('input[name=\'filter_ma001\']').attr('value');
	if (filter_ma001) {
	   url = '<?php echo base_url()?>index.php/pur/purq01a/filterb/ma001/asc/' + filter_ma001 ;
	} 
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').attr('value');
	if (filter_ma002) {
		url = '<?php echo base_url()?>index.php/pur/purq01a/filterb/ma002/asc/' + encodeURIComponent(filter_ma002);
	}
	
	var filter_ma008 = $('input[name=\'filter_ma008\']').attr('value');
	if (filter_ma008) {
		url = '<?php echo base_url()?>index.php/pur/purq01a/filterb/ma008/asc/' + encodeURIComponent(filter_ma008);
	}
	
	var filter_ma013 = $('input[name=\'filter_ma013\']').attr('value');
	if (filter_ma013) {
		url = '<?php echo base_url()?>index.php/pur/purq01a/filterb/ma013/asc/' + encodeURIComponent(filter_ma013);
	}
	
    if ( !filter_ma001  && !filter_ma002  && !filter_ma008  && !filter_ma013 ) {         
	   url = '<?php echo base_url()?>index.php/pur/purq01a/display/';location = url;
	   }
	   
	location = url;
   }
   
   function filterc() {
	var filter_ma001 = $('input[name=\'filter_ma001\']').attr('value');
	if (filter_ma001) {
	   url = '<?php echo base_url()?>index.php/pur/purq01a/filterc/ma001/asc/' + filter_ma001 ;
	} 
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').attr('value');
	if (filter_ma002) {
		url = '<?php echo base_url()?>index.php/pur/purq01a/filterc/ma002/asc/' + encodeURIComponent(filter_ma002);
	}
	
	var filter_ma008 = $('input[name=\'filter_ma008\']').attr('value');
	if (filter_ma008) {
		url = '<?php echo base_url()?>index.php/pur/purq01a/filterc/ma008/asc/' + encodeURIComponent(filter_ma008);
	}
	
	var filter_ma013 = $('input[name=\'filter_ma013\']').attr('value');
	if (filter_ma013) {
		url = '<?php echo base_url()?>index.php/pur/purq01a/filterc/ma013/asc/' + encodeURIComponent(filter_ma013);
	}
	
    if ( !filter_ma001  && !filter_ma002  && !filter_ma008  && !filter_ma013 ) {         
	   url = '<?php echo base_url()?>index.php/pur/purq01a/display/';location = url;
	   }
	   
	location = url;
   }
   
   function filterd() {
	var filter_ma001 = $('input[name=\'filter_ma001\']').attr('value');
	if (filter_ma001) {
	   url = '<?php echo base_url()?>index.php/pur/purq01a/filterd/ma001/asc/' + filter_ma001 ;
	} 
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').attr('value');
	if (filter_ma002) {
		url = '<?php echo base_url()?>index.php/pur/purq01a/filterd/ma002/asc/' + encodeURIComponent(filter_ma002);
	}
	
	var filter_ma008 = $('input[name=\'filter_ma008\']').attr('value');
	if (filter_ma008) {
		url = '<?php echo base_url()?>index.php/pur/purq01a/filterd/ma008/asc/' + encodeURIComponent(filter_ma008);
	}
	
	var filter_ma013 = $('input[name=\'filter_ma013\']').attr('value');
	if (filter_ma013) {
		url = '<?php echo base_url()?>index.php/pur/purq01a/filterd/ma013/asc/' + encodeURIComponent(filter_ma013);
	}
	
    if ( !filter_ma001  && !filter_ma002  && !filter_ma008  && !filter_ma013 ) {         
	   url = '<?php echo base_url()?>index.php/pur/purq01a/display/';location = url;
	   }
	   
	location = url;
   }
   
   
//--></script>
</body>
</html>