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
	          <td width="4%" class="left"> 
		        <?php echo anchor("fun/palq04a/display/mq001/" . (($sort_order == 'asc' && $sort_by == 'mq001') ? 'desc' : 'asc') ,'健保等級'); ?>
	             <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
	          <td width="8%" class="left"> 
		        <?php echo anchor("fun/palq04a/display/mq002/" . (($sort_order == 'asc' && $sort_by == 'mq002') ? 'desc' : 'asc') ,'投保金額'); ?>
                 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
			  <td width="8%" class="left"> 
		        <?php echo anchor("fun/palq04a/display/mq003/" . (($sort_order == 'asc' && $sort_by == 'mq003') ? 'desc' : 'asc') ,'本人健保費'); ?>
                 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
			  <td width="8%" class="left"> 
		        <?php echo anchor("fun/palq04a/display/mq004/" . (($sort_order == 'asc' && $sort_by == 'mq004') ? 'desc' : 'asc') ,'眷口+1保費'); ?>
                 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
			  <td width="8%" class="left"> 
		        <?php echo anchor("fun/palq04a/display/mq005/" . (($sort_order == 'asc' && $sort_by == 'mq005') ? 'desc' : 'asc') ,'眷口+2保費'); ?>
                 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
			   <td width="8%" class="left"> 
		        <?php echo anchor("fun/palq04a/display/mq006/" . (($sort_order == 'asc' && $sort_by == 'mq006') ? 'desc' : 'asc') ,'眷口+3保費'); ?>
                 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
	      <td width="18%" class="center">&nbsp選擇&nbsp </td>
            </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 清除輸入欄位空白 -->
	        <?php $filter_mq001='';$filter_mq002='';$filter_mq009=''; ?>
	        <tr class="filter">
	          <td class="left">
			  <div id="search">
		        <div  class="button-search"></div>
			       <input type="text" id="filter_mq001" name="filter_mq001" value="" onblur="filter1()" size="4" /><span></span>
		        </td>
	          <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_mq002" name="filter_mq002" value="" onblur="filter1()"  size="8"  /><span></span>
		        </div>			  
	          </td>	 
			  <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_mq003" name="filter_mq003" value="" onblur="filter1()"  size="8"  /><span></span>
		        </div>			  
	          </td>	
              <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_mq004" name="filter_mq004" value="" onblur="filter1()"  size="8"  /><span></span>
		        </div>			  
	          </td>	 
              <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_mq005" name="filter_mq005" value="" onblur="filter1()"  size="8"  /><span></span>
		        </div>			  
	          </td>	 
              <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_mq006" name="filter_mq006" value="" onblur="filter1()"  size="8"  /><span></span>
		        </div>			  
	          </td>	 			  
		     <td  align="center">&nbsp;&nbsp;</td>
            </tr>
			
	        <?php $chkval=1; ?>               
	        <?php foreach($results as $row ) : ?>
            <tr>
		      <td class="left"><?php echo  $row->mq001;?></td>
		      <td class="left"><?php echo  $row->mq002;?></td>
			  <td class="left"><?php echo  $row->mq003;?></td>
			  <td class="left"><?php echo  $row->mq004;?></td>
			  <td class="left"><?php echo  $row->mq005;?></td>
			  <td class="left"><?php echo  $row->mq006;?></td>
		      <td class="center">
			   <input type="hidden" class="sma001" name="sma001" value=<?php echo  $row->mq001;?> />
			   <input type="hidden" class="sma002" name="sma002" value=<?php echo  urldecode(urldecode($row->mq002));?> />
		       <input type="hidden" class="sma003" name="sma003" value=<?php echo  urldecode(urldecode($row->mq003));?> />
			   <input type="hidden" class="sma004" name="sma004" value=<?php echo  urldecode(urldecode($row->mq004));?> />
			   <input type="hidden" class="sma005" name="sma005" value=<?php echo  urldecode(urldecode($row->mq005));?> />
			   <input type="hidden" class="sma006" name="sma006" value=<?php echo  urldecode(urldecode($row->mq006));?> />
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
<script type="text/javascript">    //傳回交易員工
    $(document).ready(function(){
		$('.button').click(function() {
		    var sma001 = $(this).parent().find('.sma001').val();
			var sma002 = $(this).parent().find('.sma002').val();
            var sma003 = $(this).parent().find('.sma003').val();
            var sma004 = $(this).parent().find('.sma004').val();
            var sma005 = $(this).parent().find('.sma005').val();
            var sma006 = $(this).parent().find('.sma006').val();			
			window.parent.$.unblockUI();
			window.parent.addpalq04a(sma001,sma002,sma003,sma004,sma005,sma006);
		});
    });
</script>

<script type="text/javascript"><!--
  function filter1() {
	var filter_mq001 = $('input[name=\'filter_mq001\']').val();
	if (filter_mq001) {
	   url = '<?php echo base_url()?>index.php/fun/palq04a/filter1/mq001/asc/' + filter_mq001 ;
	} 
	
	var filter_mq002 = $('input[name=\'filter_mq002\']').val();
	if (filter_mq002) {
		url = '<?php echo base_url()?>index.php/fun/palq04a/filter1/mq002/asc/' + encodeURIComponent(filter_mq002);
	}
	var filter_mq003 = $('input[name=\'filter_mq003\']').val();
	if (filter_mq003) {
		url = '<?php echo base_url()?>index.php/fun/palq04a/filter1/mq003/asc/' + encodeURIComponent(filter_mq003);
	}
	var filter_mq004 = $('input[name=\'filter_mq004\']').val();
	if (filter_mq004) {
		url = '<?php echo base_url()?>index.php/fun/palq04a/filter1/mq004/asc/' + encodeURIComponent(filter_mq004);
	}
	var filter_mq005 = $('input[name=\'filter_mq005\']').val();
	if (filter_mq005) {
		url = '<?php echo base_url()?>index.php/fun/palq04a/filter1/mq005/asc/' + encodeURIComponent(filter_mq005);
	}
	var filter_mq006 = $('input[name=\'filter_mq006\']').val();
	if (filter_mq006) {
		url = '<?php echo base_url()?>index.php/fun/palq04a/filter1/mq006/asc/' + encodeURIComponent(filter_mq006);
	}
	
    if ( !filter_mq001  && !filter_mq002 && !filter_mq003 && !filter_mq004 && !filter_mq005 && !filter_mq006 ) {         
	   url = '<?php echo base_url()?>index.php/fun/palq04a/display/';location = url;
	   }
	   
	location = url;
   }
//--></script>
</body>
</html>