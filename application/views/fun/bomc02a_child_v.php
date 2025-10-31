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
     <!--  <table class="list">      <!-- 表格開始 -->
	   <table class="form14"  > 
          <thead>
            <tr>                          <!-- 表格表頭 -->
	          
			    <td width="50%" class="center"> 
		        <?php echo anchor("fun/bomc02a/display/md004disp/" . (($sort_order == 'asc' && $sort_by == 'md004disp') ? 'desc' : 'asc') ,'用料展開方式'); ?>
              </td>
			
	      <td width="50%" class="center">&nbsp內容&nbsp </td>
            </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 清除輸入欄位空白 庫別 -->
	        <?php $filter_md001='1';$filter_md002=$this->session->userdata('sysma203'); ?>
			
	        <tr >
	        
			<!--  <div id="search">
		        <div  class="button-search"></div> -->
				 <td  class="normal14a" >展開方式：</td>
			      <td class="normal14a" > <select id="filter_md001" onKeyPress="keyFunction()" name="filter_md001"  tabIndex="6">
            <option <?php if($filter_md001 == '1') echo 'selected="selected"';?> value='1'>1單階</option>                                                                        
		    <option <?php if($filter_md001 == '2') echo 'selected="selected"';?> value='2'>2尾階</option>
		  </select>
		        </td>
	          </tr>
			   <tr >
		    <!--    <div id="search">
		        <div class="button-search"></div>-->
				<td  class="normal14a" >輸入庫別：</td>
			     <td class="normal14a" > <input type="text" id="filter_md002" class="sma003" name="filter_md002" value="<?php echo $filter_md002; ?>"  onblur="filter1()"  size="12"  /></td>
	          
			  </tr>
			<!--     <tr >
			  <td class="left">
		       		<input type="button" class="button" value="確定" />	  
	          </td>	
		       <td  align="center">&nbsp;&nbsp;</td>
            </tr> -->
			
	        <?php $chkval=1; ?>               
	        <?php foreach($results as $row ) : ?>
       <!--     <tr>-->
		<!--      <td class="left"><?php echo  '品號:'.$row->md001;?></td>-->
			   <td class="left"><?php echo  ' ';?></td>
		    <!--  <td class="left"><?php echo  $row->md002;?></td>
			  <td class="left"><?php echo  $row->md003;?></td>
			  <td class="left"><?php echo  $row->md004;?></td>
			  <td class="left"><?php echo  $row->md004disp;?></td> -->
		      <td class="center">
			   <input type="hidden" class="sma001" name="sma001" value=<?php echo  $row->md001;?> />
			   <input type="hidden" class="sma002" name="sma002" value=<?php echo  urldecode(urldecode($row->md006));?> />
		        <input type="hidden" class="sma003" name="sma003" value=<?php echo  urldecode(urldecode($filter_md002));?> />
		 <!-- 		<input type="button" class="button" value="確定" /> -->
			  </td>
	    <!--    </tr> -->
		      
		    <?php $chkval += 1; ?>
		    <?php endforeach;?>
			
			<input type="button" class="button" value="確定" />
          </tbody>		 
        </table>
	         <!-- 分頁顯示 -->
	         <!-- 	<div class="pagination"><div class="results"><?php echo $pagination.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?></div></div> -->
			
		  <tfoot>
		  <tr>           
          </tr>
		  </tfoot>
       
      </form>
        </td></tr>
	</table>
<script type="text/javascript">    //傳回主件品號, 庫別名稱
    $(document).ready(function(){
		$('.button').click(function() {
		    var sma001 = $(this).parent().find('.sma001').val();
			var sma002 = $(this).parent().find('.sma002').val();
			var sma003 = $(this).parent().find('.sma003').val();
			window.parent.$.unblockUI();
			window.parent.addbomc02a(sma001,sma002,sma003);
		});
    });
</script>

<script type="text/javascript"><!--
  function filter1() {
	var filter_md001 = $('input[name=\'filter_md001\']').val();
	if (filter_md001) {
	   url = '<?php echo base_url()?>index.php/fun/bomc02a/filter1/md001/asc/' + filter_md001 ;
	} 
	
	var filter_md002 = $('input[name=\'filter_md002\']').val();
	if (filter_md002) {
		url = '<?php echo base_url()?>index.php/fun/bomc02a/filter1/md002/asc/' + encodeURIComponent(filter_md002);
	}
	var filter_md003 = $('input[name=\'filter_md003\']').val();
	if (filter_md003) {
		url = '<?php echo base_url()?>index.php/fun/bomc02a/filter1/md003/asc/' + encodeURIComponent(filter_md003);
	}
	var filter_md004 = $('input[name=\'filter_md004\']').val();
	if (filter_md004) {
		url = '<?php echo base_url()?>index.php/fun/bomc02a/filter1/md004/asc/' + encodeURIComponent(filter_md004);
	}
	var filter_md004disp = $('input[name=\'filter_md004disp\']').val();
	if (filter_md004disp) {
		url = '<?php echo base_url()?>index.php/fun/bomc02a/filter1/md004disp/asc/' + encodeURIComponent(filter_md004disp);
	}
	
	
    if ( !filter_md001  && !filter_md002 && !filter_md003 && !filter_md004 && !filter_md004disp ) {         
	   url = '<?php echo base_url()?>index.php/fun/bomc02a/display/';location = url;
	   }
	   
	location = url;
   }
//--></script>

</body>
</html>