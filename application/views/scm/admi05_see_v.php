  <?php include_once '/../head_v.php';?>
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
          <?php foreach($results as $row) { ?>
          <?php   $MA001=$row->MA001;?>
          <?php   $MA002=$row->MA002;?>
          <?php   $MA003=$row->MA003;?>
		  <?php   $MA005=$row->MA005;?>
		  <?php   $MA006=$row->MA006;?>
		  <?php   $MA008=$row->MA008;?>
		  <?php   $MA027=$row->MA027;?>
	      <?php   $CREATE_DATE=$row->CREATE_DATE;?>
	      <?php  }?>
          <div class="box">
            <div class="box-header">
             <!-- <h3 class="box-title">使用者 - 修改</h3>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <form action="<?php echo base_url()?>index.php/scm/admi05/updsave/<?php echo $results[0]->MA001;?>" class="form-horizontal" id="form-edit_group" method="post" accept-charset="utf-8">
 <div class="form-group"><label for="MA001" class="col-sm-2 control-label">客戶代號</label>
 <div class="col-sm-10"><input type="text" name="MA001" value="<?php echo $MA001; ?>" id="MA001"  class="form-control"   /></div></div>
 
 <div class="form-group"><label for="MA002" class="col-sm-2 control-label">客戶名稱</label>
 <div class="col-sm-10"><input type="text" name="MA002" value="<?php echo iconv("big-5","utf-8//IGNORE", $MA002); ?>" id="MA002" class="form-control"  /></div></div>
 
 <div class="form-group"><label for="MA005" class="col-sm-2 control-label">聯絡人</label>
 <div class="col-sm-10"><input type="text" name="MA005" value="<?php echo iconv("big-5","utf-8//IGNORE", $MA005); ?>" id="MA005" class="form-control"  /></div></div>
 <div class="form-group"><label for="MA006" class="col-sm-2 control-label">電話</label>
 <div class="col-sm-10"><input type="text" name="MA006" value="<?php echo $MA006; ?>" id="MA006" class="form-control"  /></div></div>
 <div class="form-group"><label for="MA008" class="col-sm-2 control-label">傳真</label>
 <div class="col-sm-10"><input type="text"  readonly="value" name="MA008" value="<?php echo $MA008; ?>" id="MA008" class="form-control"  /></div></div>
 <div class="form-group"><label for="MA027" class="col-sm-2 control-label">地址</label>
 <div class="col-sm-10"><input type="text"  readonly="value" name="MA027" value="<?php echo iconv("big-5","utf-8//IGNORE", $MA027); ?>" id="MA027" class="form-control"  /></div></div>
 <div class="form-group"><label for="CREATE_DATE" class="col-sm-2 control-label">建立日期</label>
 <div class="col-sm-10"><input type="text"  readonly="value" name="CREATE_DATE" value="<?php echo $CREATE_DATE; ?>" id="CREATE_DATE" class="form-control"  /></div></div>
 
  
 <div class="form-group"><div class="col-sm-offset-2 col-sm-10"><div class="btn-group">
 
<!-- <button type="submit" class="btn btn-primary btn-flat" >存檔</button>
<!-- <button type="reset" class="btn btn-warning btn-flat" >取消</button>-->
 <a href="<?php echo base_url()?>index.php/scm/admi05/display" class="btn btn-warning btn-flat">瀏覽</a>
 <a href="<?php echo base_url()?>index.php/main" class="btn btn-default btn-flat">返回</a>
 <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" class="btn btn-primary btn-flat" id='prev' name='prev' href="<?php echo site_url('scm/admi05/updform/'.$prev_str); ?>"  ><span>上一筆</span> </a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next'class="btn btn-primary btn-flat" name='next' href="<?php echo site_url('scm/admi05/updform/'.$next_str); ?>"  ><span>下一筆</span> </a>
		<?php } ?>
 
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
    <?php include_once '/../foot_v.php';?>