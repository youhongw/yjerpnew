<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
  <?php $this->load->helper('url');?>
    <script src="base_url()?>assets/validation/lib/jquery-1.9.0.min.js" mce_src="base_url()?>assets/validation/lib/jquery-1.3.2.min.js" ></script>  
    <script type="text/javascript" src="base_url()?>assets/validation/jquery.validate.js" mce_src="base_url()?>assets/validation/jquery.validate.js"> </script>   
       <script type="text/javascript" src="base_url()?>assets/validation/localization/messages_zh_TW.js"></script>  
       <script type="text/javascript" src="base_url()?>assets/validation/lib/jquery.form.js"></script>  
	   <script type="text/javascript" src="base_url()?>assets/validation/lib/formValidatorClass.js"></script> 
<script type="text/javascript" src="base_url()?>assets/validation/lib/jquery.metadata.js"></script> 	   
	   <script type="text/javascript"  src="base_url()?>assets/validation/dist/additional-methods.js"></script>
	   
	     <script type="text/javascript"  src="base_url()?>assets/validation/dist/additional-methods.js"></script>
		 <script type="text/javascript"  src="base_url()?>assets/validation/dist/additional-methods.js"></script>
       <style type="text/css">

       * {}{    
           font-family: Verdana;    
           font-size: 96%;    
       }   
       label {}{    
           width: 10em;    
           float: left;    
       }   
       label.error {}{    
           float: none;    
           color: red;    
           padding-left: .5em;    
           vertical-align: top;    
       }   
       p {}{    
           clear: both;    
       }   
       .submit {}{    
           margin-left: 12em;    
       }   
       em {}{    
           font-weight: bold;    
           padding-right: 1em;    
           vertical-align: top;    
       }   
</style>


<style>label { display:block;}</style>


</head>
<body>
<h1><?php echo $headline;?></h1>
<?php $this->load->view($include);?>
</body>
</html>
