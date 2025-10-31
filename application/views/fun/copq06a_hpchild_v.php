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
	<th><?php if(@$_SESSION["hp_tc004"]) echo $_SESSION["hp_tc004"]." 購買 "; if(@$_SESSION["hp_td004"])echo $_SESSION["hp_td004"]." ── ";?>歷史價格</th><tr><td>
      <form action="<?php echo base_url()?>" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
	          <td width="7%" class="left"> 
		        <?php echo anchor("fun/copq06a/display_hp/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') . "/0/".$_SESSION["hp_tc004"] . "/" . $_SESSION["hp_td004"] ,'單據日期'); ?>
	             <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/asc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/desc.png" />  <?php }  ?>
			  </td>
	          <td width="16%" class="left"> 
		        <?php echo anchor("fun/copq06a/display_hp/td002/" . (($sort_order == 'asc' && $sort_by == 'td002') ? 'desc' : 'asc') . "/0/".$_SESSION["hp_tc004"] . "/" . $_SESSION["hp_td004"] ,'訂單單號'); ?>
                 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/asc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/desc.png" />  <?php }  ?>
			  </td>
			   <td width="16%" class="left"> 
		        <?php echo anchor("fun/copq06a/display_hp/td003/" . (($sort_order == 'asc' && $sort_by == 'td003') ? 'desc' : 'asc') . "/0/".$_SESSION["hp_tc004"] . "/" . $_SESSION["hp_td004"] ,'訂單序號'); ?>
                <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/asc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/desc.png" />  <?php }  ?>
			  </td>
			   <td width="7%" class="left"> 
		        <?php echo anchor("fun/copq06a/display_hp/td011/" . (($sort_order == 'asc' && $sort_by == 'td011') ? 'desc' : 'asc') . "/0/".$_SESSION["hp_tc004"] . "/" . $_SESSION["hp_td004"] ,'訂單單價'); ?>
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
			       <input type="text" id="filter_create_date" name="filter_create_date" size="10" value="" onblur="filter_hp()" /><span></span>
		        </td>
				
	          <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_td002" name="filter_td002" size="12" value="" onblur="filter_hp()" /><span></span>
		        </div>			  
	          </td>	
			  
              <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_td003" name="filter_td003"  size="12" value="" onblur="filter_hp()" /><span></span>
		        </div>			  
	          </td>	
			  
              <td class="left">
		        <div id="search">
		        <div class="button-search"></div>
			      <input type="text" id="filter_td011" name="filter_td011"  size="12" value="" onblur="filter_hp()" /><span></span>
		        </div>			  
	          </td>
            </tr>
			
	        <?php $chkval=1;?>               
	        <?php foreach($results as $row ) : ?>
            <tr onclick="parent.select_price(<?php echo  $row->td011;echo ",";echo $row_count;?>);">
		      <td class="left"><?php echo  substr($row->create_date,0,4)."/".substr($row->create_date,4,2)."/".substr($row->create_date,6,2);?></td>
		      <td class="left"><?php echo  $row->td002;?></td>
			  <td class="left"><?php echo  $row->td003;?></td>
			  <td class="left"><?php echo  $row->td011;?></td>
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
			window.parent.addcopq06a1(std001,std002);
		});
    });
</script>

<script type="text/javascript"><!--
  function filter_hp() {
	var filter_create_date = $('input[name=\'filter_create_date\']').val();
	if (filter_create_date) {
	   url = '<?php echo base_url()?>index.php/fun/copq06a/filter_hp/create_date/asc/0/<?=$_SESSION["hp_tc004"] . "/" . $_SESSION["hp_td004"] ?>/'+encodeURIComponent(filter_create_date);
	} 
	
	var filter_td002 = $('input[name=\'filter_td002\']').val();
	if (filter_td002) {
		url = '<?php echo base_url()?>index.php/fun/copq06a/filter_hp/td002/asc/0/<?=$_SESSION["hp_tc004"] . "/" . $_SESSION["hp_td004"] ?>/' + encodeURIComponent(filter_td002);
	}
	
	var filter_td003 = $('input[name=\'filter_td003\']').val();
	if (filter_td003) {
		url = '<?php echo base_url()?>index.php/fun/copq06a/filter_hp/td003/asc/0/<?=$_SESSION["hp_tc004"] . "/" . $_SESSION["hp_td004"] ?>/' + encodeURIComponent(filter_td003);
	}
	
	var filter_td011 = $('input[name=\'filter_td011\']').val();
	if (filter_td011) {
		url = '<?php echo base_url()?>index.php/fun/copq06a/filter_hp/td011/asc/0/<?=$_SESSION["hp_tc004"] . "/" . $_SESSION["hp_td004"] ?>/' + encodeURIComponent(filter_td011);
	}
	
    if ( !filter_create_date  && !filter_td002  && !filter_td003  && !filter_td011 ) {         
	   url = '<?php echo base_url()?>index.php/fun/copq06a/display_hp/td001/desc/0/<?=$_SESSION["hp_tc004"] . "/" . $_SESSION["hp_td004"] ?>';location = url;
	   }
	   
	location = url;
   }
//--></script>
</body>
</html>