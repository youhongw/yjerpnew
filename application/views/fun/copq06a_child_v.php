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
	          <td width="7%" class="left"> 
		        <?php echo anchor("fun/copq06a/display/td001/" . (($sort_order == 'asc' && $sort_by == 'td001') ? 'desc' : 'asc') ,'訂單單別'); ?>
	             <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
	          <td width="16%" class="left"> 
		        <?php echo anchor("fun/copq06a/display/td002/" . (($sort_order == 'asc' && $sort_by == 'td002') ? 'desc' : 'asc') ,'訂單單號'); ?>
                 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
			   <td width="16%" class="left"> 
		        <?php echo anchor("fun/copq06a/display/td003/" . (($sort_order == 'asc' && $sort_by == 'td003') ? 'desc' : 'asc') ,'訂單序號'); ?>
                <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
			   <td width="7%" class="left"> 
		        <?php echo anchor("fun/copq06a/display/td004/" . (($sort_order == 'asc' && $sort_by == 'td004') ? 'desc' : 'asc') ,'產品品號'); ?>
                 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
			
	      <td width="18%" class="center">&nbsp選擇&nbsp </td>
            </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 清除輸入欄位空白 -->
	        <?php $filter_td001='';$filter_td002='';$filter_td003='';$filter_td004=''; ?>
	        <tr class="filter">
	          <td class="left">
			   <div id="search">
		        <div  class="button-search"></div>
			       <input type="text" id="filter_td001" name="filter_td001" size="10" value="" onblur="filter1()" /><span></span>
		        </td>
				
	          <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_td002" name="filter_td002" size="12" value="" onblur="filter1()" /><span></span>
		        </div>			  
	          </td>	
			  
              <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_td006" name="filter_td003"  size="12" value="" onblur="filter1()" /><span></span>
		        </div>			  
	          </td>	
			  
              <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_td005" name="filter_td004"  size="12" value="" onblur="filter1()" /><span></span>
		        </div>			  
	          </td>	 
			  
		     <td  align="center">&nbsp;&nbsp;</td>
            </tr>
			
	        <?php $chkval=1; ?>               
	        <?php foreach($results as $row ) : ?>
            <tr>
		      <td class="left"><?php echo  $row->td001;?></td>
		      <td class="left"><?php echo  $row->td002;?></td>
			  <td class="left"><?php echo  $row->td003;?></td>
			  <td class="left"><?php echo  $row->td004;?></td>
		      <td class="center">
			   <input type="hidden" class="std001" name="std001" value=<?php echo  $row->td001;?> />
			   <input type="hidden" class="std002" name="std002" value=<?php echo  urldecode(urldecode($row->td002));?> />
		       <input type="hidden" class="std003" name="std003" value=<?php echo  urldecode(urldecode($row->td003));?> />
			   <input type="hidden" class="std004" name="std004" value=<?php echo  urldecode(urldecode($row->td004));?> />
			   
		<!--	    <input type="hidden" class="std005" name="std005" value=<?php echo  urldecode(urldecode($row->td014));?> />
				 <input type="hidden" class="std006" name="std006" value=<?php echo  urldecode(urldecode($row->td031));?> />
				  <input type="hidden" class="std007" name="std007" value=<?php echo  urldecode(urldecode($row->td038));?> />
				  <input type="hidden" class="std008" name="std008" value=<?php echo  urldecode(urldecode($row->td027));?> />
				   <input type="hidden" class="std009" name="std009" value=<?php echo  urldecode(urldecode($row->td016));?> />
				    <input type="hidden" class="std00a" name="std00a" value=<?php echo  urldecode(urldecode($row->td085));?> /> -->
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
<script type="text/javascript">    //傳回訂單品號
    $(document).ready(function(){
		$('.button').click(function() {
		    var std001 = $(this).parent().find('.std001').val();
			var std002 = $(this).parent().find('.std002').val();
			var std003 = $(this).parent().find('.std003').val();
			var std004 = $(this).parent().find('.std004').val();
				
			window.parent.$.unblockUI();
			window.parent.addcopq06a(std001,std002,std003,std004);
		});
		
		$('.button1').click(function() {
		    var std001 = $(this).parent().find('.std001').val();
			var std002 = $(this).parent().find('.std002').val() ;
         		
			window.parent.$.unblockUI();
			window.parent.addcopq06a1(std001,std002);
		});
    });
</script>

<script type="text/javascript"><!--
  function filter1() {
	var filter_td001 = $('input[name=\'filter_td001\']').val();
	if (filter_td001) {
	   url = '<?php echo base_url()?>index.php/fun/copq06a/filter1/td001/asc/' + filter_td001 ;
	} 
	
	var filter_td002 = $('input[name=\'filter_td002\']').val();
	if (filter_td002) {
		url = '<?php echo base_url()?>index.php/fun/copq06a/filter1/td002/asc/' + encodeURIComponent(filter_td002);
	}
	
	var filter_td006 = $('input[name=\'filter_td006\']').val();
	if (filter_td006) {
		url = '<?php echo base_url()?>index.php/fun/copq06a/filter1/td006/asc/' + encodeURIComponent(filter_td006);
	}
	
	var filter_td005 = $('input[name=\'filter_td005\']').val();
	if (filter_td005) {
		url = '<?php echo base_url()?>index.php/fun/copq06a/filter1/td005/asc/' + encodeURIComponent(filter_td005);
	}
	
    if ( !filter_td001  && !filter_td002  && !filter_td006  && !filter_td005 ) {         
	   url = '<?php echo base_url()?>index.php/fun/copq06a/display/';location = url;
	   }
	   
	location = url;
   }
//--></script>
</body>
</html>