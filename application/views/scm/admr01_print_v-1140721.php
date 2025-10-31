  <?php include_once './application/views/head_v.php';?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small><small><?php echo $systitle; ?></small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url()?>index.php/main"><i class="fa fa-dashboard"></i> 首頁</a></li>
      <!--  <li><a href="<?php echo base_url()?>assets/admin/groups">進貨入庫單</a></li> -->
        <li class="active"><?php echo $systitle; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
          <!-- /.box -->
          <?php
	  $date=date("Ymd");
	  if(!isset($dateo)) { $dateo=date("Y/m/d"); }
	  if(!isset($datec)) { $datec=date("Y/m/d"); }
	  if(!isset($dateo1)) { $dateo1=date("Y/m/d"); }
	  if(!isset($datec1)) { $datec1=date("Y/m/d"); }
	  $tg009p='1';
	  $vdate=date("Ymd");
	?>
          <div class="box">
            <div class="box-header">
             <!-- <h3 class="box-title">使用者 - 修改</h3>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <form action="<?php echo base_url()?>index.php/scm/admr01/printa" class="form-horizontal"  id="form-edit_group" method="post" accept-charset="utf-8">
  
 	  
 <div class="form-group form-inline"><label for="dateo" class="col-sm-1 control-label">起銷貨日期</label>
 <div class="col-sm-11"><input type="text" style="width: 250px" onKeyPress="keyFunction()" name="dateo" placeholder="" value="<?php echo $dateo; ?>"  id="dateo"  
    ondblclick="scwShow(this,event);" onchange="dateformat_ymd(this);" class="form-control"  />
 <a href="javascript:;">
          <img  onclick="scwShow(dateo,event);" src="" class="btn btn-primary glyphicon glyphicon-search" /> 
        </a>
 </div></div>
 <div class="form-group form-inline"><label for="datec" class="col-sm-1 control-label">迄銷貨日期</label>
 <div class="col-sm-11"><input type="text" style="width: 250px" onKeyPress="keyFunction()" name="datec" placeholder="" value="<?php echo $datec; ?>"  id="datec"  
    ondblclick="scwShow(this,event);" onchange="dateformat_ymd(this);" class="form-control"  />
 <a href="javascript:;">
          <img  onclick="scwShow(datec,event);" src="" class="btn btn-primary glyphicon glyphicon-search" /> 
        </a>
 </div></div>


<!-- test -->
  
 <div class="form-group"><div class="col-sm-offset-2 col-sm-11"><div class="btn-group">
 
 <button type="submit" class="btn btn-primary btn-flat" >查詢</button>
 <!-- <button  class="btn btn-warning btn-flat" onclick="javascript:location.href='../scm/admr01/display'>瀏覽</button> -->
 
 <a href="<?php echo base_url()?>index.php/main" class="btn btn-default btn-flat">返回</a>
 
 
            </div>
			
			<div class="success"><?php echo  '  提示訊息：'.$message ?> </div> 
   
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>  

    <?php include_once("./application/views/scm/admr01_foot_v.php");?>
   <?php // include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 共用函數 -->
   <!-- 不更新網頁 自動提示方框資料google 提示前置小工具 --> 
<script type="text/javascript"><!--       
$.widget('custom.catcomplete', $.ui.autocomplete, {
	_renderMenu: function(ul, items) {
		var self = this, currentCategory = '';
						
		$.each(items, function(index, item) {
			if (item.category != currentCategory) {
				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');
								
				currentCategory = item.category;
			}
							
			self._renderItem(ul, item);
		});
	}
});	
//--></script>
  <?php // include_once("./application/views/funnew/invi02e_funmjs_v.php"); ?>  <!-- 品號 -->
  <script type="text/javascript"> 	
  $(document).ready(function(){ 	   
	$('#dateo').focus();
	});


</script>
  </body>
</html>
 