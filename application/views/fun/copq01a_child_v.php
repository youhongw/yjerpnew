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
		        <?php echo anchor("fun/copq01a/display/ma001/" . (($sort_order == 'asc' && $sort_by == 'ma001') ? 'desc' : 'asc') ,'客戶代號'); ?>
	             <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
	          <td width="16%" class="left"> 
		        <?php echo anchor("fun/copq01a/display/ma002/" . (($sort_order == 'asc' && $sort_by == 'ma002') ? 'desc' : 'asc') ,'客戶簡稱'); ?>
                 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
			   <td width="16%" class="left"> 
		        <?php echo anchor("fun/copq01a/display/ma006/" . (($sort_order == 'asc' && $sort_by == 'ma006') ? 'desc' : 'asc') ,'電話(一)'); ?>
                <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
			   <td width="7%" class="left"> 
		        <?php echo anchor("fun/copq01a/display/ma005/" . (($sort_order == 'asc' && $sort_by == 'ma005') ? 'desc' : 'asc') ,'連絡人'); ?>
                 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
			  </td>
			
	      <td width="18%" class="center">&nbsp選擇&nbsp </td>
            </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 清除輸入欄位空白 -->
	        <?php $filter_ma001='';$filter_ma002='';$filter_ma006='';$filter_ma005=''; ?>
	        <tr class="filter">
	          <td class="left">
			   <div id="search">
		        <div  class="button-search"></div>
			       <input type="text" id="filter_ma001" name="filter_ma001" size="10" value="" onblur="filter1()" /><span></span>
				    </div>		
		        </td>
				
	          <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_ma002" name="filter_ma002" size="12" value="" onblur="filter1()" /><span></span>
		        </div>			  
	          </td>	
			  
              <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_ma006" name="filter_ma006"  size="12" value="" onblur="filter1()" /><span></span>
		        </div>			  
	          </td>	
			  
              <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_ma005" name="filter_ma005"  size="12" value="" onblur="filter1()" /><span></span>
		        </div>			  
	          </td>	 
			  
		     <td  align="center">&nbsp;&nbsp;</td>
            </tr>
			
	        <?php $chkval=1; ?>               
	        <?php foreach($results as $row ) : ?>
            <tr>
		      <td class="left"><?php echo  $row->ma001;?></td>
		      <td class="left"><?php echo  $row->ma002;?></td>
			  <td class="left"><?php echo  $row->ma006;?></td>
			  <td class="left"><?php echo  $row->ma005;?></td>
		      <td class="center">
			   <input type="hidden" class="sma001" name="sma001" value=<?php echo  $row->ma001;?> />
			   <input type="hidden" class="sma002" name="sma002" value=<?php echo  urldecode(urldecode($row->ma002));?> />
		       <input type="hidden" class="sma003" name="sma003" value=<?php echo  urldecode(urldecode($row->ma006));?> />
			   <input type="hidden" class="sma004" name="sma004" value=<?php echo  urldecode(urldecode($row->ma005));?> />
			   
			    <input type="hidden" class="sma005" name="sma005" value=<?php echo  urldecode(urldecode($row->ma014));?> />
				 <input type="hidden" class="sma006" name="sma006" value=<?php echo  urldecode(urldecode($row->ma031));?> />
				  <input type="hidden" class="sma007" name="sma007" value=<?php echo  urldecode(urldecode($row->ma038));?> />
				  <input type="hidden" class="sma008" name="sma008" value=<?php echo  urldecode(urldecode($row->ma027));?> />
				   <input type="hidden" class="sma009" name="sma009" value=<?php echo  urldecode(urldecode($row->ma016));?> />
				    <input type="hidden" class="sma00a" name="sma00a" value=<?php echo  urldecode(urldecode($row->ma085));?> />
					<input type="hidden" class="sma00b" name="sma00b" value=<?php echo  urldecode(urldecode($row->ma064));?> />
					<input type="hidden" class="sma00c" name="sma00c" value=<?php echo  urldecode(urldecode($row->ma015));?> />
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
<script type="text/javascript">    //傳回2客戶名稱,ma005連絡人,6電話,14幣別, 31付款條件,38課稅別,27送貨地1,16業務員,85收款業務,64送貨地址,15部門
    $(document).ready(function(){
		$('.button').click(function() {
		    var sma001 = $(this).parent().find('.sma001').val();
			var sma002 = $(this).parent().find('.sma002').val();
			
			var sma005 = $(this).parent().find('.sma005').val();
			var sma006 = $(this).parent().find('.sma006').val();
			var sma007 = $(this).parent().find('.sma007').val();
			var sma008 = $(this).parent().find('.sma008').val();
         	var sma009 = $(this).parent().find('.sma009').val();
            var sma00a = $(this).parent().find('.sma00a').val();
            var sma00b = $(this).parent().find('.sma00b').val();
            var sma00c = $(this).parent().find('.sma00c').val();			
			window.parent.$.unblockUI();
			window.parent.addcopq01a(sma001,sma002,sma005,sma006,sma007,sma008,sma009,sma00a,sma00b,sma00c);
		});
		
		$('.button1').click(function() {
		    var sma001 = $(this).parent().find('.sma001').val();
			var sma002 = $(this).parent().find('.sma002').val() ;
         		
			window.parent.$.unblockUI();
			window.parent.addcopq01a1(sma001,sma002);
		});
    });
</script>

<script type="text/javascript"><!--
  function filter1() {
	var filter_ma001 = $('input[name=\'filter_ma001\']').val();
	if (filter_ma001) {
	   url = '<?php echo base_url()?>index.php/fun/copq01a/filter1/ma001/asc/' + filter_ma001 ;
	} 
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').val();
	if (filter_ma002) {
		url = '<?php echo base_url()?>index.php/fun/copq01a/filter1/ma002/asc/' + encodeURIComponent(filter_ma002);
	}
	
	var filter_ma006 = $('input[name=\'filter_ma006\']').val();
	if (filter_ma006) {
		url = '<?php echo base_url()?>index.php/fun/copq01a/filter1/ma006/asc/' + encodeURIComponent(filter_ma006);
	}
	
	var filter_ma005 = $('input[name=\'filter_ma005\']').val();
	if (filter_ma005) {
		url = '<?php echo base_url()?>index.php/fun/copq01a/filter1/ma005/asc/' + encodeURIComponent(filter_ma005);
	}
	
    if ( !filter_ma001  && !filter_ma002  && !filter_ma006  && !filter_ma005 ) {         
	   url = '<?php echo base_url()?>index.php/fun/copq01a/display/';location = url;
	   }
	   
	location = url;
   }
//--></script>
</body>
</html>