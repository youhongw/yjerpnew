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
<body >
	<table width="95%" align="center"><tr><td>
      <form action="<?php echo base_url()?>" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
	          <td width="12%" class="left"> 
		        <?php echo anchor("fun/invq81a/display/md001/" . (($sort_order == 'asc' && $sort_by == 'md001') ? 'desc' : 'asc') ,'品號'); ?>
                <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>	         
			 </td>
	          <td width="14%" class="left"> 
		        <?php echo anchor("fun/invq81a/display/md002/" . (($sort_order == 'asc' && $sort_by == 'md002') ? 'desc' : 'asc') ,'單位'); ?>
               <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
			  </td>
	          <td width="14%" class="left"> 
		        <?php echo anchor("fun/invq81a/display/md003/" . (($sort_order == 'asc' && $sort_by == 'md003') ? 'desc' : 'asc') ,'換算分子'); ?>
               <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
	      <td width="10%" class="center">&nbsp選擇&nbsp </td>
            </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 清除輸入欄位空白 -->
	        <?php $filter_md001='';$filter_md002='';$filter_md003=''; ?>
	        <tr class="filter">
	          <td class="left">
			   <div id="search">
		        <div  class="button-search"></div>
			       <input type="text" id="filter_md001" name="filter_md001" value="" onblur="filter1()" size="12" /><span></span>
		        </td>
	          <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_md002" name="filter_md002" value="" onblur="filter1()" size="12"  /><span></span>
		        </div>			  
	          </td>	 
			  <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_md003" name="filter_md003" value="" onblur="filter1()" size="12"  /><span></span>
		        </div>			  
	          </td>	 
		     <td  align="center">&nbsp;&nbsp;</td>
            </tr>
			
	        <?php $chkval=1; ?>               
	        <?php foreach($results as $row ) : ?>
            <tr>
		      <td class="left"><?php echo  $row->md001;?></td>
		      <td class="left"><?php echo  $row->md002;?></td>
			  <td class="left"><?php echo  $row->md003;?></td>
		      <td class="center">
			   <input type="hidden" class="smd001" name="smd001" value=<?php echo  $row->md001;?> />
			   <input type="hidden" class="smd002" name="smd002" value=<?php echo  urldecode(urldecode($row->md002));?> />
		        <input type="hidden" class="smd003" name="smd003" value=<?php echo  $row->md003;?> />
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
<script type="text/javascript">    //傳回交易公司
    $(document).ready(function(){
		$('.button').click(function() {
		    var smd001 = $(this).parent().find('.smd001').val();
			var smd002 = $(this).parent().find('.smd002').val();
           	var smd003 = $(this).parent().find('.smd003').val();	
			window.parent.$.unblockUI();
			window.parent.addinvq81a(smd001,smd002,smd003);
		});
    });
</script>

<script type="text/javascript"><!--
  function filter1() {
	var filter_md001 = $('input[name=\'filter_md001\']').val();
	if (filter_md001) {
	   url = '<?php echo base_url()?>index.php/fun/invq81a/filter1/md001/asc/' + filter_md001 ;
	} 
	
	var filter_md002 = $('input[name=\'filter_md002\']').val();
	if (filter_md002) {
		url = '<?php echo base_url()?>index.php/fun/invq81a/filter1/md002/asc/' + encodeURIComponent(filter_md002);
	}
	var filter_md003 = $('input[name=\'filter_md003\']').val();
	if (filter_md003) {
		url = '<?php echo base_url()?>index.php/fun/invq81a/filter1/md003/asc/' + encodeURIComponent(filter_md003);
	}
	
    if ( !filter_md001  && !filter_md002  && !filter_md003) {         
	   url = '<?php echo base_url()?>index.php/fun/invq81a/display/';location = url;
	   }
	   
	location = url;
   }
//--></script>
</body>
</html>