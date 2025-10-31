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
	          <td width="5%" class="left"> 
		        <?php echo anchor("fun/copc08a/display/tc001/" . (($sort_order == 'asc' && $sort_by == 'tc001') ? 'desc' : 'asc') ,'訂單單別'); ?>
	           <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
	          <td width="6%" class="left"> 
		        <?php echo anchor("fun/copc08a/display/tc002/" . (($sort_order == 'asc' && $sort_by == 'tc002') ? 'desc' : 'asc') ,'訂單單號'); ?>
               <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
			    <td width="6%" class="left"> 
		        <?php echo anchor("fun/copc08a/display/tc003/" . (($sort_order == 'asc' && $sort_by == 'tc003') ? 'desc' : 'asc') ,'訂單日期'); ?>
                 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
			    <td width="6%" class="left"> 
		        <?php echo anchor("fun/copc08a/display/tc004/" . (($sort_order == 'asc' && $sort_by == 'tc004') ? 'desc' : 'asc') ,'客戶代號'); ?>
                 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
			    <td width="6%" class="left"> 
		        <?php echo anchor("fun/copc08a/display/tc004disp/" . (($sort_order == 'asc' && $sort_by == 'tc004disp') ? 'desc' : 'asc') ,'客戶名稱'); ?>
                 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
			
	      <td width="10%" class="center">&nbsp選擇&nbsp </td>
            </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 清除輸入欄位空白 -->
	        <?php $filter_tc001='';$filter_tc002=''; ?>
	        <tr class="filter">
	          <td class="left">
			  <div id="search">
		        <div  class="button-search"></div>
			       <input type="text" id="filter_tc001" name="filter_tc001" value="" onblur="filter1()" size="6" /><span></span>
		        </td>
	          <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_tc002" name="filter_tc002" value="" onblur="filter1()"  size="12"  /><span></span>
		        </div>			  
	          </td>	 
			  <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_tc003" name="filter_tc003" value="" onblur="filter1()"  size="10"  /><span></span>
		        </div>			  
	          </td>	 
			  <td class="left">
		        <div id="search"> 
		        <div class="button-search"></div>
			      <input type="text" id="filter_tc004" name="filter_tc004" value="" onblur="filter1()"  size="12"  /><span></span>
		        </div>			  
	          </td>	 
			  <td class="left">
		      <!--    <div id="search">  -->
		        <div class="button-search"></div>
			      <input type="text" id="filter_tc004disp" name="filter_tc004disp" value="" onblur="filter1()"  size="12" disabled="disabled"  /><span></span>
		        </div>			  
	          </td>	 
			  
		     <td  align="center">&nbsp;&nbsp;</td>
            </tr>
			
	        <?php $chkval=1; ?>               
	        <?php foreach($results as $row ) : ?>
            <tr>
		      <td class="left"><?php echo  $row->tc001;?></td>
		      <td class="left"><?php echo  $row->tc002;?></td>
			  <td class="left"><?php echo  $row->tc003;?></td>
			  <td class="left"><?php echo  $row->tc004;?></td>
			  <td class="left"><?php echo  $row->tc004disp;?></td>
		      <td class="center">
			   <input type="hidden" class="sma001" name="sma001" value=<?php echo  $row->tc001;?> />
			   <input type="hidden" class="sma002" name="sma002" value=<?php echo  urldecode(urldecode($row->tc002));?> />
		       <input type="hidden" class="sma003" name="sma003" value=<?php echo  $row->otg001;?> />
			   <input type="hidden" class="sma004" name="sma004" value=<?php echo  $row->otg002;?> />
			   <input type="hidden" class="sma005" name="sma005" value=<?php echo  $row->otg004;?> />
			   <input type="hidden" class="sma006" name="sma006" value=<?php echo  $row->otg042;?> />
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
			var otg001 = $(this).parent().find('.sma003').val();
			var otg002 = $(this).parent().find('.sma004').val();
			var otg004 = $(this).parent().find('.sma005').val();
			var otg042 = $(this).parent().find('.sma006').val();
		//	var otg001=window.parent.$('#tg001').val();
		//	var otg002=window.parent.$('#tg002').val();
            		
		//	var otg042=window.parent.$('#tg042').val();  //日期
			window.parent.$.unblockUI();
			window.parent.addcopc08a(sma001,sma002,otg001,otg002,otg004,otg042);
		});
    });
</script>

<script type="text/javascript"><!--
  function filter1() {
	var filter_tc001 = $('input[name=\'filter_tc001\']').val();
	if (filter_tc001) {
	   url = '<?php echo base_url()?>index.php/fun/copc08a/filter1/tc001/asc/' + filter_tc001 ;
	} 
	
	var filter_tc002 = $('input[name=\'filter_tc002\']').val();
	if (filter_tc002) {
		url = '<?php echo base_url()?>index.php/fun/copc08a/filter1/tc002/asc/' + encodeURIComponent(filter_tc002);
	}
	var filter_tc003 = $('input[name=\'filter_tc003\']').val();
	if (filter_tc003) {
		url = '<?php echo base_url()?>index.php/fun/copc08a/filter1/tc003/asc/' + encodeURIComponent(filter_tc003);
	}
	var filter_tc004 = $('input[name=\'filter_tc004\']').val();
	if (filter_tc004) {
		url = '<?php echo base_url()?>index.php/fun/copc08a/filter1/tc004/asc/' + encodeURIComponent(filter_tc004);
	}
	var filter_tc004disp = $('input[name=\'filter_tc004disp\']').val();
	if (filter_tc004disp) {
		url = '<?php echo base_url()?>index.php/fun/copc08a/filter1/tc004disp/asc/' + encodeURIComponent(filter_tc004disp);
	}
	
	
    if ( !filter_tc001  && !filter_tc002 && !filter_tc003 && !filter_tc004 && !filter_tc004disp ) {         
	   url = '<?php echo base_url()?>index.php/fun/copc08a/display/';location = url;
	   }
	   
	location = url;
   }
//--></script>

</body>
</html>