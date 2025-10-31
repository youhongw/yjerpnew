<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
<?if(!@$_SESSION) session_start();?>
<body >
	<table width="95%" align="center">
	<th>融資種類查詢</th><tr><td>
      <form action="<?php echo base_url()?>" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
	          <td width="7%" class="left"> 
		        <?php echo anchor("fun/noti13a/display/mc001/" . (($sort_order == 'asc' && $sort_by == 'mc001') ? 'desc' : 'asc') ,'融資種類'); ?>
	             <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/asc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/desc.png" />  <?php }  ?>
			  </td>
	          <td width="16%" class="left"> 
		        <?php echo anchor("fun/noti13a/display/mc002/" . (($sort_order == 'asc' && $sort_by == 'mc002') ? 'desc' : 'asc') ,'融資名稱'); ?>
                 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/asc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/desc.png" />  <?php }  ?>
			  </td>
            </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 清除輸入欄位空白 -->
	        <?php $filter_create_date='';$filter_td002='';$filter_td003='';$filter_td004=''; ?>
	        <tr class="filter">
	          <td class="left">
			   <div id="search">
		        <div  class="button-search"></div>
			       <input type="text" id="filter_mc001" name="filter_mc001" size="10" value="" onblur="filter()" /><span></span>
		        </td>
				
	          <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_b_mb002" name="filter_mc002" size="12" value="" onblur="filter()" /><span></span>
		        </div>			  
	          </td>	
			  
            </tr>
			
	        <?php $chkval=1;?>               
	        <?php foreach($results as $row ) : ?>
			<?//品號mc001,品名mc002,規格b_mb003,單位a_mb003,幣別a_mb004,單價a_mb008?>
            <tr onclick="parent.select_data(<?php echo "'".$row->mc001 ."','".$row->mc002."','".$row_count."'";?>);">
		      <td class="left" ><?php echo  $row->mc001;?></td>
		      <td class="left" ><?php echo  $row->mc002;?></td>
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
<script type="text/javascript">    //傳回訂單品號
    $(document).ready(function(){
		$('.button1').click(function() {
		    var std001 = $(this).parent().find('.std001').val();
			var std002 = $(this).parent().find('.std002').val() ;
         		
			window.parent.$.unblockUI();
			window.parent.addnoti13a1(std001,std002);
		});
    });
</script>

<script type="text/javascript"><!--
  function filter() {
	var filter_mc001 = $('input[name=\'filter_mc001\']').val();
	if (filter_mc001) {
	   url = '<?php echo base_url()?>index.php/fun/noti13a/filter/mc001/asc/'+encodeURIComponent(filter_mc001);
	} 
	
	var filter_mc002 = $('input[name=\'filter_mc002\']').val();
	if (filter_mc002) {
		url = '<?php echo base_url()?>index.php/fun/noti13a/filter/mc002/asc/' + encodeURIComponent(filter_mc002);
	}
	
    if ( !filter_mc001 && !filter_mc002) {         
	   url = '<?php echo base_url()?>index.php/fun/noti13a/display/mc001/desc/';location = url;
	   }
	   
	location = url;
   }
//--></script>
</body>
</html>