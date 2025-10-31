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
	<th><?php if(@$_SESSION["copi02a_tc004"]) echo $_SESSION["copi02a_tc004"]." ── ";?>客戶商品計價查詢</th><tr><td>
      <form action="<?php echo base_url()?>" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
	          <td width="7%" class="left"> 
		        <?php echo anchor("fun/copi02a/display/a.mb002/" . (($sort_order == 'asc' && $sort_by == 'a.mb002') ? 'desc' : 'asc') . "/0/".$_SESSION["copi02a_tc004"] ,'品號'); ?>
	             <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/asc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/desc.png" />  <?php }  ?>
			  </td>
	          <td width="16%" class="left"> 
		        <?php echo anchor("fun/copi02a/display/b.mb002/" . (($sort_order == 'asc' && $sort_by == 'b.mb002') ? 'desc' : 'asc') . "/0/".$_SESSION["copi02a_tc004"] ,'品名'); ?>
                 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/asc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/desc.png" />  <?php }  ?>
			  </td>
			   <td width="16%" class="left"> 
		        <?php echo anchor("fun/copi02a/display/b.mb003/" . (($sort_order == 'asc' && $sort_by == 'b.mb003') ? 'desc' : 'asc') . "/0/".$_SESSION["copi02a_tc004"] ,'規格'); ?>
                <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/asc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/desc.png" />  <?php }  ?>
			  </td>
			   <td width="7%" class="left"> 
		        <?php echo anchor("fun/copi02a/display/a.mb003/" . (($sort_order == 'asc' && $sort_by == 'a.mb003') ? 'desc' : 'asc') . "/0/".$_SESSION["copi02a_tc004"] ,'計價單位'); ?>
                 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/asc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/desc.png" />  <?php }  ?>
			  </td>
			  <td width="7%" class="left"> 
		        <?php echo anchor("fun/copi02a/display/a.mb004/" . (($sort_order == 'asc' && $sort_by == 'a.mb004') ? 'desc' : 'asc') . "/0/".$_SESSION["copi02a_tc004"] ,'幣別'); ?>
                 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/asc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/desc.png" />  <?php }  ?>
			  </td>
			  <td width="7%" class="left"> 
		        <?php echo anchor("fun/copi02a/display/a.mb008/" . (($sort_order == 'asc' && $sort_by == 'a.mb008') ? 'desc' : 'asc') . "/0/".$_SESSION["copi02a_tc004"] ,'單價'); ?>
                 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/asc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/desc.png" />  <?php }  ?>
			  </td>
			  <td width="7%" class="left"> 
		        <?php echo anchor("fun/copi02a/display/a.mb010/" . (($sort_order == 'asc' && $sort_by == 'a.mb010') ? 'desc' : 'asc') . "/0/".$_SESSION["copi02a_tc004"] ,'上次銷貨日'); ?>
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
			       <input type="text" id="filter_a_mb002" name="filter_a_mb002" size="10" value="" onblur="filter()" /><span></span>
		        </td>
				
	          <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_b_mb002" name="filter_b_mb002" size="12" value="" onblur="filter()" /><span></span>
		        </div>			  
	          </td>	
			  
              <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_b_mb003" name="filter_b_mb003"  size="12" value="" onblur="filter()" /><span></span>
		        </div>			  
	          </td>	
			  
              <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_a_mb003" name="filter_a_mb003"  size="12" value="" onblur="filter()" /><span></span>
		        </div>			  
	          </td>
			  <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_a_mb004" name="filter_a_mb004"  size="12" value="" onblur="filter()" /><span></span>
		        </div>			  
	          </td>
			  <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_a_mb008" name="filter_a_mb008"  size="12" value="" onblur="filter()" /><span></span>
		        </div>			  
	          </td>
			  <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_a_mb010" name="filter_a_mb010"  size="12" value="" onblur="filter()" /><span></span>
		        </div>			  
	          </td>
            </tr>
			
	        <?php $chkval=1;?>               
	        <?php foreach($results as $row ) : ?>
			<?//品號a_mb002,品名b_mb002,規格b_mb003,單位a_mb003,幣別a_mb004,單價a_mb008?>
            <tr onclick="parent.select_data(<?php echo "'".$row->a_mb002 ."','".$row->b_mb002 ."','".$row->b_mb003 ."','".$row->a_mb003 ."','".$row->a_mb008 ."','".$row_count."'";?>);">
		      <td class="left" ><?php echo  $row->a_mb002;?></td>
		      <td class="left" ><?php echo  $row->b_mb002;?></td>
			  <td class="left" ><?php echo  $row->b_mb003;?></td>
			  <td class="left" ><?php echo  $row->a_mb003;?></td>
			  <td class="left" ><?php echo  $row->a_mb004;?></td>
			  <td class="left" ><?php echo  $row->a_mb008;?></td>
			  <td class="left" ><?php echo  $row->a_mb010;?></td>
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
			window.parent.addcopi02a1(std001,std002);
		});
    });
</script>

<script type="text/javascript"><!--
  function filter() {
	var filter_a_mb002 = $('input[name=\'filter_a_mb002\']').val();
	if (filter_a_mb002) {
	   url = '<?php echo base_url()?>index.php/fun/copi02a/filter/a.mb002/asc/0/<?=$_SESSION["copi02a_tc004"]?>/'+encodeURIComponent(filter_a_mb002);
	} 
	
	var filter_b_mb002 = $('input[name=\'filter_b_mb002\']').val();
	if (filter_b_mb002) {
		url = '<?php echo base_url()?>index.php/fun/copi02a/filter/b.mb002/asc/0/<?=$_SESSION["copi02a_tc004"]?>/' + encodeURIComponent(filter_b_mb002);
	}
	
	var filter_b_mb003 = $('input[name=\'filter_b_mb003\']').val();
	if (filter_b_mb003) {
		url = '<?php echo base_url()?>index.php/fun/copi02a/filter/b.mb003/asc/0/<?=$_SESSION["copi02a_tc004"]?>/' + encodeURIComponent(filter_b_mb003);
	}
	var filter_a_mb003 = $('input[name=\'filter_a_mb003\']').val();
	if (filter_a_mb003) {
		url = '<?php echo base_url()?>index.php/fun/copi02a/filter/a.mb003/asc/0/<?=$_SESSION["copi02a_tc004"]?>/' + encodeURIComponent(filter_a_mb003);
	}
	var filter_a_mb004 = $('input[name=\'filter_a_mb004\']').val();
	if (filter_a_mb004) {
		url = '<?php echo base_url()?>index.php/fun/copi02a/filter/a.mb004/asc/0/<?=$_SESSION["copi02a_tc004"]?>/' + encodeURIComponent(filter_a_mb004);
	}
	var filter_a_mb008 = $('input[name=\'filter_a_mb008\']').val();
	if (filter_a_mb008) {
		url = '<?php echo base_url()?>index.php/fun/copi02a/filter/a.mb008/asc/0/<?=$_SESSION["copi02a_tc004"]?>/' + encodeURIComponent(filter_a_mb008);
	}
	
	var filter_a_mb010 = $('input[name=\'filter_a_mb010\']').val();
	if (filter_a_mb010) {
		url = '<?php echo base_url()?>index.php/fun/copi02a/filter/a.mb010/asc/0/<?=$_SESSION["copi02a_tc004"]?>/' + encodeURIComponent(filter_a_mb010);
	}
	
    if ( !filter_a_mb002 && !filter_b_mb002 && !filter_b_mb003 && !filter_a_mb003 && !filter_a_mb004 &&!filter_a_mb008  && !filter_a_mb010 ) {         
	   url = '<?php echo base_url()?>index.php/fun/copi02a/display/a.mb001/desc/0/<?=$_SESSION["copi02a_tc004"]?>';location = url;
	   }
	   
	location = url;
   }
//--></script>
</body>
</html>