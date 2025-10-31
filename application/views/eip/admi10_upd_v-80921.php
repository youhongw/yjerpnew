<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>企業資訊入口 | EIP</title>
<!--[if IE 8]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1" name="viewport">
<meta name="google" content="notranslate">
<meta name="robots" content="noindex, nofollow">
<link rel="icon" href="data:image/x-icon;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAqElEQVRYR+2WYQ6AIAiF8W7cq7oXd6v5I2eYAw2nbfivYq+vtwcUgB1EPPNbRBR4Tby2qivErYRvaEnPAdyB5AAi7gCwvSUeAA4iis/TkcKl1csBHu3HQXg7KgBUegVA7UW9AJKeA6znQKULoDcDkt46bahdHtZ1Por/54B2xmuz0uwA3wFfd0Y3gDTjhzvgANMdkGb8yAyY/ro1d4H2y7R1DuAOTHfgAn2CtjCe07uwAAAAAElFTkSuQmCC">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,700italic">
<link rel="stylesheet" href="<?php echo base_url()?>assets/frameworks/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/frameworks/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/frameworks/ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/frameworks/adminlte/css/adminlte.min.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/frameworks/adminlte/css/skins/skin-blue.min.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/colorpickersliders/colorpickersliders.min.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/frameworks/domprojects/css/dp.min.css">
<!--[if lt IE 9]><script src="<?php echo base_url()?>assets/plugins/html5shiv/html5shiv.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/respond/respond.min.js"></script><![endif]-->
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">
<header class="main-header">
<a href="<?php echo base_url()?>assets/admin/dashboard" class="logo"><span class="logo-mini"><b>A</b>LT</span>
<span class="logo-lg"><b>企業資訊入口</b></span></a>
<nav class="navbar navbar-static-top" role="navigation">
<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span></a>
<div class="navbar-custom-menu">
<ul class="nav navbar-nav">
<!-- User Account -->
<li class="dropdown user user-menu">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<img src="<?php echo base_url()?>assets/upload/avatar/m_001.png" class="user-image" alt="User Image">
<span class="hidden-xs">administrator</span></a>

<ul class="dropdown-menu">
<li class="user-header">
<img src="<?php echo base_url()?>assets/upload/avatar/m_001.png" class="img-circle" alt="User Image">
<p>Admin istrator<small>Member since 18-03-2010</small></p>
</li>
<li class="user-body"><div class="row"><div class="col-xs-4 text-center"><a href="#">Followers</a></div>
<div class="col-xs-4 text-center"><a href="#">Sales</a></div><div class="col-xs-4 text-center">
<a href="#">Friends</a></div></div></li>
<li class="user-footer"><div class="pull-left">
<a href="<?php echo base_url()?>assets/admin/users/profile/1" class="btn btn-default btn-flat">Profile</a></div>
<div class="pull-right"><a href="<?php echo base_url()?>assets/auth/logout/admin" class="btn btn-default btn-flat">Sign out</a></div></li></ul></li></ul>
</div>
</nav>
</header>
<aside class="main-sidebar">
<section class="sidebar">
<!-- Sidebar menu -->
<ul class="sidebar-menu">
<li><a href="<?php echo base_url()?>assets/">
<i class="fa fa-home text-primary"></i> <span>Access to the Web site</span></a></li>
<li class="header text-uppercase">Main Navigation</li>
<li class=""><a href="<?php echo base_url()?>assets/admin/dashboard">
<i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
<li class="header text-uppercase">Administration</li><li class="">
<a href="<?php echo base_url()?>assets/admin/users"><i class="fa fa-user"></i> <span>Users</span></a></li>
<li class="active"><a href="<?php echo base_url()?>assets/admin/groups"><i class="fa fa-shield"></i> 
<span>Security groups</span></a></li><li class="treeview "><a href="#"><i class="fa fa-cogs"></i>
<span>Preferences</span><i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">
<li class=""><a href="<?php echo base_url()?>assets/admin/prefs/interfaces/admin">Interfaces</a></li>
</ul>
</li>
<li class=""><a href="<?php echo base_url()?>assets/admin/files"><i class="fa fa-file"></i>
 <span>Files</span></a></li><li class=""><a href="<?php echo base_url()?>assets/admin/database"><i class="fa fa-database"></i>
 <span>Database utility</span></a></li><li class="header text-uppercase">AdminLTE</li>
 <li class=""><a href="<?php echo base_url()?>assets/admin/license"><i class="fa fa-legal"></i>
 <span>License</span></a></li><li class=""><a href="<?php echo base_url()?>assets/admin/resources"><i class="fa fa-cubes"></i> 
 <span>Resources</span></a></li>
 </ul>
 </section>
 </aside>
 
 <div class="content-wrapper">
 <section class="content-header"><h1>Security groups</h1><ol class="breadcrumb">
 <li><a href="<?php echo base_url()?>assets/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a> </li>
 <li><a href="<?php echo base_url()?>assets/admin/groups">Security groups</a> </li>
 <li class="active">Edit</li></ol></section><section class="content">
 <div class="row"><div class="col-md-12"><div class="box">
 <div class="box-header with-border"><h3 class="box-title">Edit group</h3></div>
 <div class="box-body">
 
 <form action="<?php echo base_url()?>assets/admin/groups/edit/1" class="form-horizontal" id="form-edit_group" method="post" accept-charset="utf-8">
 <div class="form-group"><label for="group_name" class="col-sm-2 control-label">Name</label>
 <div class="col-sm-10"><input type="text" name="group_name" value="admin" id="group_name" class="form-control" readonly="readonly"/></div></div>
 
 <div class="form-group"><label for="description" class="col-sm-2 control-label">Description</label>
 <div class="col-sm-10"><input type="text" name="group_description" value="Administrator" id="group_description" class="form-control"/></div></div>
 
 <div class="form-group"><label for="bgcolor" class="col-sm-2 control-label">Color</label>
 
 <div class="col-sm-3"><input type="text" name="group_bgcolor" value="#F44336" id="group_bgcolor" data-src="#F44336" class="form-control"/></div></div>
 
 <div class="form-group"><div class="col-sm-offset-2 col-sm-10"><div class="btn-group">
 
 <button type="submit" class="btn btn-primary btn-flat" >Submit</button>
 <button type="reset" class="btn btn-warning btn-flat" >Reset</button>
 <a href="<?php echo base_url()?>assets/admin/groups" class="btn btn-default btn-flat">Cancel</a>
 
 </div></div></div></form>
 </div></div></div></div></section></div>
 
 <footer class="main-footer"><div class="pull-right hidden-xs"><b>version</b> Development</div>
 <strong>Copyright &copy; 2014-2019 <a href="http://almsaeedstudio.com" target="_blank">Almsaeed Studio</a> &amp; 
 <a href="https://domprojects.com" target="_blank">domProjects</a>.</strong> All rights reserved.</footer></div>
 <script src="<?php echo base_url()?>assets/frameworks/jquery/jquery.min.js"></script>
 <script src="<?php echo base_url()?>assets/frameworks/bootstrap/js/bootstrap.min.js"></script>
 <script src="<?php echo base_url()?>assets/plugins/slimscroll/slimscroll.min.js"></script>
 <script src="<?php echo base_url()?>assets/plugins/tinycolor/tinycolor.min.js"></script>
 <script src="<?php echo base_url()?>assets/plugins/colorpickersliders/colorpickersliders.min.js"></script>
 <script src="<?php echo base_url()?>assets/frameworks/adminlte/js/adminlte.min.js"></script>
 <script src="<?php echo base_url()?>assets/frameworks/domprojects/js/dp.min.js"></script>
 </body>
 </html>