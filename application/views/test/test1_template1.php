<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
  <?php $this->load->helper('url');?>  
   
	 <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/validation/css/screen.css" />
	
       <script  src="http://jquery.bassistance.de/validate/lib/jquery.js"></script> 
      <script  src="http://jquery.bassistance.de/validate/jquery.validate.js"></script>   
<script>
$.validator.setDefaults({
	submitHandler: function() { alert("submitted!"); }
});

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
#commentForm { width: 500px; }
#commentForm label { width: 250px; }
#commentForm label.error, #commentForm input.submit { margin-left: 253px; }
#newsletter_topics label.error {
	display: none;
	margin-left: 103px;
}
</style>	  
       
	   


<style>label { display:block;}</style>


</head>
<body>
<h1><?php echo $headline;?></h1>
<?php $this->load->view($include);?>
</body>
</html>
