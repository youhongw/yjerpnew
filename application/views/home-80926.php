<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<link href="<?php echo base_url()?>assets/home/icon.png" rel="icon" />
		<title><?php echo $systitle ?></title>
		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/home/index.css"/>
		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/home/main.css" />  
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/home/basic.css" />
		<script type="text/javascript" src="<?php echo base_url()?>assets/home/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/home/jquery.blockUI.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/home/webset.js"></script> 
		<script>
			//var base_url='{base_url}';
		//	var base_urfun='{base_urfun}';
			//var changeid='right';
		</script>

		<!-- <p id="demo"></p>
        <script>
        document.getElementById("demo").innerHTML = 
        window.location.href;
        </script> -->

<style type="text/css">
<!--
input {border:0px solid #c00;}
input {star : expression(
onmouseover=function(){this.style.borderColor="#060"},
onmouseout=function(){this.style.borderColor="#c00"})}
select {border:0px solid #c00;}
select {star : expression(
onmouseover=function(){this.style.borderColor="#060"},
onmouseout=function(){this.style.borderColor="#c00"})}
-->@font-face {	font-family: 'Noto Sans TC';	src: url('NotoSansCJKtc-Medium.otf') format('OpenType');}  	body {  font-family: 'Noto Sans TC';}
</style>
	</head>
	<body>
		<div>
			<div><?php $this->load->view($content_v);?></div>
			<div><?php $this->load->view($foot_v);?></div>
			<div><?php $this->load->view($menu_v);?></div>
		</div>
	</body>
</html>