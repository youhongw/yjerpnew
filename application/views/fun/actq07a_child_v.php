<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
<title><?php $systitle; ?></title>
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
	      <!--    <td width="5%" class="left"> 
		        <?php echo anchor("fun/actq07a/display/dt001/" . (($sort_order == 'asc' && $sort_by == 'dt001') ? 'desc' : 'asc') ,'期別'); ?>
	          <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>  -->
	          <td width="10%" class="left"> 
		        <?php echo anchor("fun/actq07a/display/dt002/" . (($sort_order == 'asc' && $sort_by == 'dt002') ? 'desc' : 'asc') ,'期別'); ?>
               <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
			   <td width="10%" class="left"> 
		        <?php echo anchor("fun/actq07a/display/dt003/" . (($sort_order == 'asc' && $sort_by == 'dt003') ? 'desc' : 'asc') ,'起始日期'); ?>
                <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
			   <td width="5%" class="left"> 
		        <?php echo anchor("fun/actq07a/display/dt004/" . (($sort_order == 'asc' && $sort_by == 'dt004') ? 'desc' : 'asc') ,'截止日期'); ?>
                <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
	         <td width="5%" class="center">&nbsp選擇&nbsp </td>
            </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 清除輸入欄位空白 -->
	        <?php $filter_dt001='';$filter_dt002='';$filter_dt003='';$filter_dt004=''; ?>
	        <tr class="filter">
			
	    <!--      <td class="left">
			    <div id="search">
		        <div  class="button-search"></div>
			       <input type="text" id="filter_dt001" name="filter_dt001" value="" size="12" onblur="filter1()" /><span></span>
				    </div>		
		        </td>  -->
				
	          <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_dt002" name="filter_dt002" value="" size="12"  onblur="filter1()" /><span></span>
		        </div>			  
	          </td>	
			  
              <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_dt003" name="filter_dt003" value="" size="12"  onblur="filter1()" /><span></span>
		        </div>			  
	          </td>	
			  
              <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_dt004" name="filter_dt004" value="" size="10" onblur="filter1()" /><span></span>
		        </div>			  
	          </td>	 
			  
		     <td  align="center">&nbsp;&nbsp;</td>
            </tr>
			
	        <?php $chkval=1; ?>               
	        <?php foreach($results as $row ) : ?>
            <tr>
		     
		      <td class="left"><?php echo  $row->dt002;?></td>
			  <td class="left"><?php echo  $row->dt003;?></td>
			  <td class="left"><?php echo  $row->dt004;?></td>
		      <td class="center">
			   <input type="hidden" class="sma001" name="sma001" value=<?php echo  $row->dt002;?> />
			   <input type="hidden" class="sma002" name="sma002" value=<?php echo  urldecode(urldecode($row->dt003));?> />
		       <input type="hidden" class="sma003" name="sma003" value=<?php echo  urldecode(urldecode($row->dt004));?> />
			
			   
			    <?php  if($this->uri->segment(3)=="display" || $this->uri->segment(3)=="filter1") { ?> 
				<input type="button" class="button" value="選擇" />  <?php } ?>	
				
				 <?php  if($this->uri->segment(3)=="display1" || $this->uri->segment(3)=="filter2") { ?> 
				<input type="button" class="button1" value="選擇" />  <?php } ?>	
				
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
           		
			window.parent.$.unblockUI();
			window.parent.addactq07a(sma001,sma002,sma003);
			
		});
		$('.button1').click(function() {
		    var sma001 = $(this).parent().find('.sma001').val();
			var sma002 = $(this).parent().find('.sma002').val() ;
            var sma003 = $(this).parent().find('.sma003').val() ;	
            var sma004 = $(this).parent().find('.sma004').val() ;				
			window.parent.$.unblockUI();
			window.parent.addactq07a1(sma001,sma002,sma003,sma004);
			
		});
    });
</script>

<script type="text/javascript"><!--
  function filter1() {
	var filter_dt001 = $('input[name=\'filter_dt001\']').val();
	if (filter_dt001) {
	   url = '<?php echo base_url()?>index.php/fun/actq07a/filter1/dt001/asc/' + filter_dt001 ;
	}  
	
	var filter_dt002 = $('input[name=\'filter_dt002\']').val();
	if (filter_dt002) {
		url = '<?php echo base_url()?>index.php/fun/actq07a/filter1/dt002/asc/' + encodeURIComponent(filter_dt002);
	}
	
	var filter_dt003 = $('input[name=\'filter_dt003\']').val();
	if (filter_dt003) {
		url = '<?php echo base_url()?>index.php/fun/actq07a/filter1/dt003/asc/' + encodeURIComponent(filter_dt003);
	}
	
	var filter_dt004 = $('input[name=\'filter_dt004\']').val();
	if (filter_dt004) {
		url = '<?php echo base_url()?>index.php/fun/actq07a/filter1/dt004/asc/' + encodeURIComponent(filter_dt004);
	}
	
    if ( !filter_dt001  && !filter_dt002  && !filter_dt003  && !filter_dt004 ) {         
	   url = '<?php echo base_url()?>index.php/fun/actq07a/display/';location = url;
	   }
	   
	location = url;
   }
   
    function filter2() {
	var filter_dt001 = $('input[name=\'filter_dt001\']').val();
	if (filter_dt001) {
	   url = '<?php echo base_url()?>index.php/fun/actq07a/filter1/dt001/asc/' + filter_dt001 ;
	} 
	
	var filter_dt002 = $('input[name=\'filter_dt002\']').val();
	if (filter_dt002) {
		url = '<?php echo base_url()?>index.php/fun/actq07a/filter1/dt002/asc/' + encodeURIComponent(filter_dt002);
	}
	
	var filter_dt003 = $('input[name=\'filter_dt003\']').val();
	if (filter_dt003) {
		url = '<?php echo base_url()?>index.php/fun/actq07a/filter1/dt003/asc/' + encodeURIComponent(filter_dt003);
	}
	
	var filter_dt004 = $('input[name=\'filter_dt004\']').val();
	if (filter_dt004) {
		url = '<?php echo base_url()?>index.php/fun/actq07a/filter1/dt004/asc/' + encodeURIComponent(filter_dt004);
	}
	
    if ( !filter_dt001  && !filter_dt002  && !filter_dt003  && !filter_dt004 ) {         
	   url = '<?php echo base_url()?>index.php/fun/actq07a/display1/';location = url;
	   }
	   
	location = url;
   }
//--></script>
</body>
</html>