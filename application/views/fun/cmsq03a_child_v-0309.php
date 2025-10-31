<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
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
	          <td width="7%" class="left"> 
		        <?php echo anchor("fun/cmsq03a/display/mc001/" . (($sort_order == 'asc' && $sort_by == 'mc001') ? 'desc' : 'asc') ,'庫別代號'); ?>
	          </td>
	          <td width="16%" class="left"> 
		        <?php echo anchor("fun/cmsq03a/display/mc002/" . (($sort_order == 'asc' && $sort_by == 'mc002') ? 'desc' : 'asc') ,'庫別名稱'); ?>
              </td>
	      <td width="18%" class="center">&nbsp選擇&nbsp </td>
            </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 清除輸入欄位空白 -->
	        <?php $filter_mc001='';$filter_mc002=''; ?>
	        <tr class="filter">
	          <td class="left">
			  <div id="search"  >
		        <div  class="button-search"></div>
			       <input type="text" id="filter_mc001" name="filter_mc001" value="" onblur="filter1()" size="10" /><span></span>
		        </td>
	          <td class="left">
		       <div id="search"  >
		        <div class="button-search"></div>
			      <input type="text" id="filter_mc002" name="filter_mc002" value="" onblur="filter1()" size="10" /><span></span>
		        </div>			  
	          </td>	 
		     <td  align="center">&nbsp;&nbsp;</td>
            </tr>
			
	        <?php $chkval=1; ?>               
	        <?php foreach($results as $row ) : ?>
            <tr>
		      <td class="left"><?php echo  $row->mc001;?></td>
		      <td class="left"><?php echo  $row->mc002;?></td>
		      <td class="center">
			   <input type="hidden" class="sma001" name="sma001" value=<?php echo  $row->mc001;?> />
			   <input type="hidden" class="sma002" name="sma002" value=<?php echo  urldecode(urldecode($row->mc002));?> />
		       
				<input type="button" class="button" value="選擇" />
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
			var sma002 = $(this).parent().find('.sma002').val();			
			window.parent.$.unblockUI();			
			window.parent.addcmsq03a(sma001,sma002);
		});
    });
</script>

<script type="text/javascript"><!--
  function filter1() {
	var filter_mc001 = $('input[name=\'filter_mc001\']').val();
	if (filter_mc001) {
	   url = '<?php echo base_url()?>index.php/fun/cmsq03a/filter1/mc001/asc/' + filter_mc001 ;
	} 
	
	var filter_mc002 = $('input[name=\'filter_mc002\']').val();
	if (filter_mc002) {
		url = '<?php echo base_url()?>index.php/fun/cmsq03a/filter1/mc002/asc/' + encodeURIComponent(filter_mc002);
	}
	
    if ( !filter_mc001  && !filter_mc002 ) {         
	   url = '<?php echo base_url()?>index.php/fun/cmsq03a/display/';location = url;
	   }
	 
	location = url;
   }
//--></script>
</body>
</html>