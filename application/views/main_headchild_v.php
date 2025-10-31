<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="zh-TW" lang="zh-TW">
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
<?php $this->load->view($content_v);?>
<?php // $this->load->view($foot_v);?>
</body>
</html>
<?php 
	//字串轉時間格式
	/***
	*	stringtodate function		2017.04.11	Talence Editor
	*
	*		stringtodate("Y/m/d",string1)	return string2;
	*
	*		string1 => need format time time 	ex.'20170329'
	*		string2 => return string 			ex.'2017/03/29'
	*/	
	function stringtodate($format,$string){
		$time = strtotime($string);
		$newformat = date($format,$time);
		
		return $newformat;
	}
	/***	
	*	end of stringtodate function	2017.04.11	Talence Editor
	*/
	//時間轉字串格式
	/***
	*	datetostring function		2017.05.23	Talence Editor
	*
	*		datetostring(string1)	return string2;
	*
	*		string1 => need format time time 	ex.'20170329'
	*		string2 => return string 			ex.'2017/03/29'
	*/	
	function datetostring($date){
		preg_match_all('/\d/S',$date, $matches);  //處理日期字串
		$newdate = implode('',$matches[0]);
		return $newdate;
	}
	/***	
	*	end of datetostring function	2017.04.11	Talence Editor
	*/
?>