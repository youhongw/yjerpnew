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
		        <?php echo anchor("fun/copq82a/display/mm001/" . (($sort_order == 'asc' && $sort_by == 'mm001') ? 'desc' : 'asc') ,'訪問日期'); ?>
	          </td>
	          <td width="16%" class="left"> 
		        <?php echo anchor("fun/copq82a/display/mm003/" . (($sort_order == 'asc' && $sort_by == 'mm003') ? 'desc' : 'asc') ,'客戶代號'); ?>
              </td>
			  <td width="16%" class="left"> 
		        <?php echo anchor("fun/copq82a/display/mm004/" . (($sort_order == 'asc' && $sort_by == 'mm004') ? 'desc' : 'asc') ,'客戶級別'); ?>
              </td>
			  <td width="16%" class="left"> 
		        <?php echo anchor("fun/copq82a/display/mm002/" . (($sort_order == 'asc' && $sort_by == 'mm002') ? 'desc' : 'asc') ,'業 務 員'); ?>
              </td>
			  <td width="16%" class="left"> 
		        <?php echo anchor("fun/copq82a/display/mm005/" . (($sort_order == 'asc' && $sort_by == 'mm005') ? 'desc' : 'asc') ,'內容敍述'); ?>
              </td>
	      <td width="18%" class="center">&nbsp關閉&nbsp </td>
            </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 清除輸入欄位空白 -->
	        <?php $filter_mm001='';$filter_mm002=''; ?>
	        <tr class="filter">
	          <td class="left">
			  <div id="search"  >
		        <div  class="button-search"></div>
			       <input type="text" id="filter_mm001" name="filter_mm001" value="" onblur="filter1()" size="10" /><span></span>
		        </td>
	          <td class="left">
		       <div id="search"  >
		        <div class="button-search"></div>
			      <input type="text" id="filter_mm003" name="filter_mm003" value="" onblur="filter1()"  size="10"/><span></span>		      	  
	          </td>	 
			  <td class="left">
		       <div id="search"  >
		        <div class="button-search"></div>
			      <input type="text" id="filter_mm004" name="filter_mm004" value="" onblur="filter1()"  size="10"/><span></span>		      	  
	          </td>	 
			  <td class="left">
		       <div id="search"  >
		        <div class="button-search"></div>
			      <input type="text" id="filter_mm002" name="filter_mm002" value="" onblur="filter1()" size="10" /><span></span>		      	  
	          </td>	 
			  <td class="left">
		       <div id="search"  >
		        <div class="button-search"></div>
			      <input type="text" id="filter_mm005" name="filter_mm005" value="" onblur="filter1()" size="10" /><span></span>		      	  
	          </td>	 
		    <!-- <td  align="center">&nbsp;&nbsp;</td> -->
			 <td  align="center"><input type="button" class="button" value="關閉" /></td>
            </tr>
			
	        <?php $chkval=1; ?>               
	        <?php foreach($results as $row ) : ?>
            <tr>
		      <td class="left"><?php echo  $row->mm001;?></td>
		      <td class="left"><?php echo  $row->mm003;?></td>
			  <td class="left"><?php echo  $row->mm004;?></td>
			  <td class="left"><?php echo  $row->mm002;?></td>
			  <td class="left"><textarea style="border: none; width: 100%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><?php echo  $row->mm005;?></textarea></td> 
		      <td class="center">
			   <input type="hidden" class="sma001" name="sma001" value=<?php echo  $row->mm001;?> />
			   <input type="hidden" class="sma002" name="sma002" value=<?php echo  urldecode(urldecode($row->mm002));?> />
		       
				<input type="button" class="button" value="關閉" />
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
<script type="text/javascript">    //傳回客戶類別名稱
    $(document).ready(function(){
		$('.button').click(function() {
			history.go(-1);　
		    var sma001 = $(this).parent().find('.sma001').val();
			var sma002 = $(this).parent().find('.sma002').val();			
			window.parent.$.unblockUI();
			if(window.parent.addcopq82a){
				window.parent.addcopq82a(sma001,sma002);
			}
			if(parent.select_copq82a){
				parent.select_copq82a(sma001,sma002);
			}
		});
    });
</script>

<script type="text/javascript"><!--
  function filter1() {
	var filter_mm001 = $('input[name=\'filter_mm001\']').val();
	if (filter_mm001) {
	   url = '<?php echo base_url()?>index.php/fun/copq82a/filter1/mm001/asc/' + filter_mm001 ;
	} 
	
	var filter_mm002 = $('input[name=\'filter_mm002\']').val();
	if (filter_mm002) {
		url = '<?php echo base_url()?>index.php/fun/copq82a/filter1/mm002/asc/' + encodeURIComponent(filter_mm002);
	}
	
    if ( !filter_mm001  && !filter_mm002 ) {         
	   url = '<?php echo base_url()?>index.php/fun/copq82a/display/';location = url;
	   }
	 
	location = url;
   }
//--></script>
</body>
</html>