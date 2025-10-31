<script type="text/javascript"> 	   //開視窗 單位換算 invi02
	$(document).ready(function(){ 	   
	$("#Showinvi81a").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '680px', 	   
	width: '60%', 	   
	overflow:'hidden', 	 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divFinvi81a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFinvi81a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/inv/invi81/display" allowTransparency="flase" name="ifmain" width="95%" height="660px" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 