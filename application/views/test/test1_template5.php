<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
  <?php $this->load->helper('url');?>
  	<?php $this->load->library("session"); ?>
<link href="<?=base_url()?>assets/image/icon.png" rel="icon" />
 <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/stylesheet/stylesheet14.css" /> 
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link type="text/css" href="<?=base_url()?>assets/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/superfish/js/superfish.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/common.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery.maskedinput.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery.blockUI.js"></script>

       <script  src="<?=base_url()?>assets/validate/lib/jquery.js"></script> 
      <script  src="<?=base_url()?>assets/validate/jquery.validate.js"></script> 
	  <script  src="<?=base_url()?>assets/validate/localization/messages_zh_TW.js"></script>
	
	
	<!-- <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/validation/css/screen.css" />
<!--  <script  src="http://ci.dercaster.com/assets/validate/localization/messages_zh_TW.js"></script>  	
       <script  src="http://jquery.bassistance.de/validate/lib/jquery.js"></script> 
      <script  src="http://jquery.bassistance.de/validate/jquery.validate.js"></script>  -->  
<script>
//$.validator.setDefaults({
//	submitHandler: function() { alert("submitted!"); }
//});

$().ready(function() {
	// validate the comment form when it is submitted
	$("#commentForm").validate();	
	//code to hide topic selection, disable for demo
	var newsletter = $("#newsletter");
	// newsletter topics are optional, hide at first
	var inital = newsletter.is(":checked");
	var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
	var topicInputs = topics.find("input").attr("disabled", !inital);
	// show when newsletter is checked
	newsletter.click(function() {
		topics[this.checked ? "removeClass" : "addClass"]("gray");
		topicInputs.attr("disabled", !this.checked);
	});  
});
</script>
<style type="text/css">
#commentForm { width: 1190px; }
#commentForm label { width: 220px; }
#commentForm label.error, #commentForm input.submit { margin-left: 1px; }
#newsletter_topics label.error {
	display: none;
	margin-left: 13px;
}
</style>	
<style> input:focus {background-color: yellow;} </style>  
<style>label { display:block;}</style>

<script language="javascript">   

	   
	function Msg(){
		alert("閒置超時，系統強制登出!");
		location="<?=base_url()?>";
	}
	window.setInterval("Msg()",7200000);
</script>
<script type="text/javascript">
$('.htabs a').tabs();
$('.vtabs a').tabs();
</script>
</head>
<body>
<?php $this->load->view($include);?>
</body>
</html>
