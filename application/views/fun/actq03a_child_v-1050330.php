<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>科目視窗查詢</title>
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

<style>
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
      <form action="" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
       
		  
	      <td width="7%" class="left"> 
		 <?php  if($this->uri->segment(3)=="display" || $this->uri->segment(3)=="filter") {
		          echo anchor("fun/actq03a/display/ma001/" . (($sort_order == 'asc' && $sort_by == 'ma001') ? 'desc' : 'asc') ,'科目代號');} ?>
				  
	      <?php  if($this->uri->segment(3)=="display1" || $this->uri->segment(3)=="filter1") {
		          echo anchor("fun/actq03a/display1/ma001/" . (($sort_order == 'asc' && $sort_by == 'ma001') ? 'desc' : 'asc') ,'科目代號');} ?>
		 <?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") {
		          echo anchor("fun/actq03a/display2/ma001/" . (($sort_order == 'asc' && $sort_by == 'ma001') ? 'desc' : 'asc') ,'科目代號');} ?>	  
	      
		  <?php  if($this->uri->segment(3)=="display3" || $this->uri->segment(3)=="filter3") {
		          echo anchor("fun/actq03a/display3/ma001/" . (($sort_order == 'asc' && $sort_by == 'ma001') ? 'desc' : 'asc') ,'科目代號');} ?>
		  
		  <?php  if($this->uri->segment(3)=="display4" || $this->uri->segment(3)=="filter4") {
		          echo anchor("fun/actq03a/display4/ma001/" . (($sort_order == 'asc' && $sort_by == 'ma001') ? 'desc' : 'asc') ,'科目代號');} ?>
          <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>		 
		 </td>
	      <td width="16%" class="left"> 
		   <?php  if($this->uri->segment(3)=="display" || $this->uri->segment(3)=="filter") {
		         echo anchor("fun/actq03a/display/ma003/" . (($sort_order == 'asc' && $sort_by == 'ma003') ? 'desc' : 'asc') ,'科目名稱');} ?>
           
		    <?php  if($this->uri->segment(3)=="display1" || $this->uri->segment(3)=="filter1") {
		         echo anchor("fun/actq03a/display1/ma003/" . (($sort_order == 'asc' && $sort_by == 'ma003') ? 'desc' : 'asc') ,'科目名稱');} ?>
		   <?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") {
		         echo anchor("fun/actq03a/display2/ma003/" . (($sort_order == 'asc' && $sort_by == 'ma003') ? 'desc' : 'asc') ,'科目名稱');} ?>   
			
			<?php  if($this->uri->segment(3)=="display3" || $this->uri->segment(3)=="filter3") {
		         echo anchor("fun/actq03a/display3/ma003/" . (($sort_order == 'asc' && $sort_by == 'ma003') ? 'desc' : 'asc') ,'科目名稱');} ?>  
           
		   <?php  if($this->uri->segment(3)=="display4" || $this->uri->segment(3)=="filter4") {
		         echo anchor("fun/actq03a/display4/ma003/" . (($sort_order == 'asc' && $sort_by == 'ma003') ? 'desc' : 'asc') ,'科目名稱');} ?>			 
            <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>			
			</td>
	    
	      <td width="18%" class="center">&nbsp選擇&nbsp </td>
           
            </tr>
          </thead>
           <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_ma001='*';$filter_ma002='';$filter_ma003='';$filter_ma004='';$filter_ma005='';$filter_ma006='';$filter_create=''; ?>
	     <tr class="filter">
	      <td class="left">
		  <div id="search">
		  <div  class="button-search"></div>
		    <?php  if($this->uri->segment(3)=="display" || $this->uri->segment(3)=="filter") { ?>
			<input type="text" id="filter_ma001" name="filter_ma001" value="" onblur="filter()" /><span></span>  <?php } ?>

            <?php  if($this->uri->segment(3)=="display1" || $this->uri->segment(3)=="filter1") { ?>
			<input type="text" id="filter_ma001" name="filter_ma001" value="" onblur="filter1()" /><span></span>  <?php } ?>			
             <?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") { ?>
			<input type="text" id="filter_ma001" name="filter_ma001" value="" onblur="filter2()" /><span></span> <?php } ?>	
              <?php  if($this->uri->segment(3)=="display3" || $this->uri->segment(3)=="filter3") { ?>
			<input type="text" id="filter_ma001" name="filter_ma001" value="" onblur="filter3()" /><span></span> <?php } ?>				
	         <?php  if($this->uri->segment(3)=="display4" || $this->uri->segment(3)=="filter4") { ?>
			<input type="text" id="filter_ma001" name="filter_ma001" value="" onblur="filter4()" /><span></span> <?php } ?>	
         		 
		 </td>   
			  
	      <td class="left">
		  <div id="search">
		   <div class="button-search"></div>
		    <?php  if($this->uri->segment(3)=="display" || $this->uri->segment(3)=="filter") { ?>
			<input type="text" id="filter_ma003" name="filter_ma003" value="" onblur="filter()" /><span></span> <?php } ?>	
		   
		    <?php  if($this->uri->segment(3)=="display1" || $this->uri->segment(3)=="filter1") { ?>
			<input type="text" id="filter_ma003" name="filter_ma003" value="" onblur="filter1()" /><span></span> <?php } ?>	
			<?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") { ?>
			<input type="text" id="filter_ma003" name="filter_ma003" value="" onblur="filter2()" /><span></span> <?php } ?>	
			<?php  if($this->uri->segment(3)=="display3" || $this->uri->segment(3)=="filter3") { ?>
			<input type="text" id="filter_ma003" name="filter_ma003" value="" onblur="filter3()" /><span></span> <?php } ?>	
			<?php  if($this->uri->segment(3)=="display4" || $this->uri->segment(3)=="filter4") { ?>
			<input type="text" id="filter_ma003" name="filter_ma003" value="" onblur="filter4()" /><span></span> <?php } ?>	
		  </div>			  
	      </td>	 
		   <td  align="center">&nbsp;&nbsp;</td>
	    <!--  <td  align="center"><a onclick="filter2();" class="button">篩選</a></td>	-->	
            </tr>
			
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
            <tr>
		  <td class="left"><?php echo  $row->ma001;?></td>
		  <td class="left"><?php echo  $row->ma003;?></td>
		  <td class="center">
	<!--	  <input type="hidden" class="dmb005" name="dmb005" value=<?php echo  $row->ma002;?> />
		  <input type="hidden" class="vmb005" name="vmb005" value=<?php echo  urldecode(urldecode($row->ma003));?> />
		  <input type="hidden" class="sma001" name="sma001" value=<?php echo  $row->ma002."/".urldecode(urldecode($row->ma003))."/1";?> />  -->
		  
		   <?php  if($this->uri->segment(3)=="display" || $this->uri->segment(3)=="filter") { ?>
			  <input type="hidden" class="sma001" name="sma001" value=<?php echo  $row->ma001;?> />
		      <input type="hidden" class="sma002" name="sma002" value=<?php echo  urldecode(urldecode($row->ma003));?> />
		      <input type="button" class="button" value="選擇" /><?php } ?>
            
			<?php  if($this->uri->segment(3)=="display1" || $this->uri->segment(3)=="filter1") { ?>
			  <input type="hidden" class="sma001" name="sma001" value=<?php echo  $row->ma001;?> />
		      <input type="hidden" class="sma002" name="sma002" value=<?php echo  urldecode(urldecode($row->ma003));?> />
		      <input type="button" class="button1" value="選擇" /><?php } ?>
	
		  
		    <?php  if($this->uri->segment(3)=="display2" || $this->uri->segment(3)=="filter2") { ?>
			  <input type="hidden" class="sma001" name="sma001" value=<?php echo  $row->ma001;?> />
		      <input type="hidden" class="sma002" name="sma002" value=<?php echo  urldecode(urldecode($row->ma003));?> />
		  <input type="button" class="button2" value="選擇" /> <?php } ?>
		  
             <?php  if($this->uri->segment(3)=="display3" || $this->uri->segment(3)=="filter3") { ?>
			 <input type="hidden" class="sma001" name="sma001" value=<?php echo  $row->ma001;?> />
		      <input type="hidden" class="sma002" name="sma002" value=<?php echo  urldecode(urldecode($row->ma003));?> />
		  <input type="button" class="button3" value="選擇" /> <?php } ?>
		  
		    <?php  if($this->uri->segment(3)=="display4" || $this->uri->segment(3)=="filter4") { ?>
			 <input type="hidden" class="sma001" name="sma001" value=<?php echo  $row->ma001;?> />
		  <input type="hidden" class="sma002" name="sma002" value=<?php echo  urldecode(urldecode($row->ma003));?> />			
		  <input type="button" class="button4" value="選擇" /> <?php } ?>	
		  
	    </tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
          </tbody>		 
        </table>
	      <!--     <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		       <?php echo $this->pagination->create_links();?>	
			    <?php echo $this->session->userdata('find05');$find05; ?><?php echo $this->session->userdata('find07');$find07;  ?> -->
				<div class="pagination"><div class="results"><?php echo $pagination.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?></div></div>
			
		  <tfoot>
		  <tr>           
          </tr>
		  </tfoot>
       
      </form>
    </td></tr></table>
<script type="text/javascript">
    $(document).ready(function(){
		$('.button').click(function() {
		  //  var sma001 = encodeURIComponent($(this).parent().find('.sma001').val());
		//	var sma001 = $(this).parent().find('.sma001').val();
            var sma001 = $(this).parent().find('.sma001').val();
			var sma002 = $(this).parent().find('.sma002').val() ;			
			window.parent.$.unblockUI();
			window.parent.addactq03a(sma001,sma002);
		});
		
		$('.button1').click(function() {
		  //  var sma001 = encodeURIComponent($(this).parent().find('.sma001').val());
		//	var sma001 = $(this).parent().find('.sma001').val();
            var sma001 = $(this).parent().find('.sma001').val();
			var sma002 = $(this).parent().find('.sma002').val() ;			
			window.parent.$.unblockUI();
			window.parent.addactq03a1(sma001,sma002);
		});
		
		$('.button2').click(function() {
		  //  var sma001 = encodeURIComponent($(this).parent().find('.sma001').val());
			var sma001 = $(this).parent().find('.sma001').val();
			var sma002 = $(this).parent().find('.sma002').val() ;			
			window.parent.$.unblockUI();
			window.parent.addactq03a2(sma001,sma002);
		});
		
		$('.button3').click(function() {
		  //  var sma001 = encodeURIComponent($(this).parent().find('.sma001').val());
			var sma001 = $(this).parent().find('.sma001').val();
			var sma002 = $(this).parent().find('.sma002').val();			
			window.parent.$.unblockUI();
			window.parent.addactq03a3(sma001,sma002);
		});
		
		$('.button4').click(function() {
		  //  var sma001 = encodeURIComponent($(this).parent().find('.sma001').val());
			var sma001 = $(this).parent().find('.sma001').val();
			var sma002 = $(this).parent().find('.sma002').val();
		
			window.parent.$.unblockUI();
			window.parent.addactq03a4(sma001,sma002);
		});
    });
</script>

<script type="text/javascript"><!--
$(document).ready(function() {
//	$('.button-search').bind('click', function() {
//		filter1();
//	});
});

function filter() {
	var filter_ma001 = $('input[name=\'filter_ma001\']').val();
	if (filter_ma001) {
	   
		url = '<?php echo base_url()?>index.php/fun/actq03a/filter/ma001/asc/' + filter_ma001 ;
	} 
	
	var filter_ma003 = $('input[name=\'filter_ma003\']').val();
	if (filter_ma003) {
		url = '<?php echo base_url()?>index.php/fun/actq03a/filter/ma003/asc/' + encodeURIComponent(filter_ma003);
	}
	
    if ( !filter_ma001  && !filter_ma003 ) {         
	   url = '<?php echo base_url()?>index.php/fun/actq03a/display1/';location = url;
	   
	   }
	   
	location = url;
}

function filter1() {
	var filter_ma001 = $('input[name=\'filter_ma001\']').val();
	if (filter_ma001) {
	   
		url = '<?php echo base_url()?>index.php/fun/actq03a/filter1/ma001/asc/' + filter_ma001 ;
	} 
	
	var filter_ma003 = $('input[name=\'filter_ma003\']').val();
	if (filter_ma003) {
		url = '<?php echo base_url()?>index.php/fun/actq03a/filter1/ma003/asc/' + encodeURIComponent(filter_ma003);
	}
	
    if ( !filter_ma001  && !filter_ma003 ) {         
	   url = '<?php echo base_url()?>index.php/fun/actq03a/display1/';location = url;
	   
	   }
	   
	location = url;
}
function filter2() {
	var filter_ma001 = $('input[name=\'filter_ma001\']').val();
	if (filter_ma001) {
	   
		url = '<?php echo base_url()?>index.php/fun/actq03a/filter2/ma001/asc/' + filter_ma001 ;
	} 
	
	var filter_ma003 = $('input[name=\'filter_ma003\']').val();
	if (filter_ma003) {
		url = '<?php echo base_url()?>index.php/fun/actq03a/filter2/ma003/asc/' + encodeURIComponent(filter_ma003);
	}
	
    if ( !filter_ma001  && !filter_ma003 ) {         
	   url = '<?php echo base_url()?>index.php/fun/actq03a/display2/';location = url;
	   
	   }
	   
	location = url;
}

function filter3() {
	var filter_ma001 = $('input[name=\'filter_ma001\']').val();
	if (filter_ma001) {
	   
		url = '<?php echo base_url()?>index.php/fun/actq03a/filter3/ma001/asc/' + filter_ma001 ;
	} 
	
	var filter_ma003 = $('input[name=\'filter_ma003\']').val();
	if (filter_ma003) {
		url = '<?php echo base_url()?>index.php/fun/actq03a/filter3/ma003/asc/' + encodeURIComponent(filter_ma003);
	}
	
    if ( !filter_ma001  && !filter_ma003 ) {         
	   url = '<?php echo base_url()?>index.php/fun/actq03a/display3/';location = url;
	   
	   }
	   
	location = url;
}

function filter4() {
	var filter_ma001 = $('input[name=\'filter_ma001\']').val();
	if (filter_ma001) {
	   
		url = '<?php echo base_url()?>index.php/fun/actq03a/filter4/ma001/asc/' + filter_ma001 ;
	} 
	
	var filter_ma003 = $('input[name=\'filter_ma003\']').val();
	if (filter_ma003) {
		url = '<?php echo base_url()?>index.php/fun/actq03a/filter4/ma003/asc/' + encodeURIComponent(filter_ma003);
	}
	
    if ( !filter_ma001  && !filter_ma003 ) {         
	   url = '<?php echo base_url()?>index.php/fun/actq03a/display4/';location = url;
	   
	   }
	   
	location = url;
}
//--></script>
</body>
</html>