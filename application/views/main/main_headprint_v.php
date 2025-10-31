<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title> </title>
  <?php $this->load->helper('url');?>
  <?php $this->load->library("session"); ?>
<link href="<?=base_url()?>assets/image/icon.png" rel="icon" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/stylesheet/stocktake_sheet.css" />
<!-- <script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/jquery-1.7.1.min.js"></script>  -->
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/jquery-1.9.1.js"></script>


</head>
<body onLoad="window.print()">
<style>
body {
	background: #FFFFFF;
	margin: 0;
	padding: 0;
}
body, td, th {
	font-family: 細明體, Verdana, Arial, Helvetica, sans-serif;
	-webkit-text-size-adjust:none;
	color: #000000;
}
p {
	margin:0cm;
}
.store {
	width: 100%;
	margin-bottom: 0px;
	border-collapse:collapse;
	border: 0px;
	font-size: 12pt;
	font-family: 細明體, Verdana, Arial, Helvetica, sans-serif;
}
.thead {
	border-collapse: collapse;
	width: 100%;
	font-size: 10pt;
}
.thead td {
	border-left: 1px solid #000000;
	border-right: 1px solid #000000;
	border-top: 1px solid #000000;
	border-bottom: 1px solid #000000;
}
.list {
	border-collapse: collapse;
	width: 100%;
	font-size: 10pt;
}
.list td {
	border-left: 1px solid #000000;
	border-right: 1px solid #000000;
	border-top: 0px solid #000000;
	border-bottom: 1px solid #000000;
}
.store {
	width: 100%;
	margin-bottom: 0px;
	border-collapse:collapse;
	border: 0px;
}
.logo {
	color: #000000;
	text-align: center;
	font-size: 9pt;
}
.title {
	color: #000000;
	text-align: center;
	font-size: 18pt;
	font-weight: bold;
	padding-bottom: 5px;
	margin-top: 0px;
	margin-bottom: 15px;
	border-bottom: 1px solid #000000;
	font-family: 細明體, Verdana, Arial, Helvetica, sans-serif;
}

.heading td {
	background: #E7EFEF;
	padding: 5px;
}
.company {
	width: 100%;
	border-collapse: collapse;
	font-size: 10pt;
	margin-bottom: 0px;
	border: 0px;
}
.product {
	width: 100%;
	font-size: 10pt;
	margin-bottom: 0px;
	border-collapse: collapse;
}
.product td {
	padding: 5px;
}
</style>
<?php $this->load->view($content_v);?>
</body>
</html>
