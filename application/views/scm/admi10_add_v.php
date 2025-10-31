  <?php include_once '/../head_v.php';?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small><small><?php echo $systitle; ?></small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url()?>assets/admin/dashboard"><i class="fa fa-dashboard"></i> 首頁</a></li>
        <li><a href="<?php echo base_url()?>assets/admin/groups">基本設定</a></li>
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
	  if(!isset($mf001)) {$mf001=$this->input->post('mf001');} else { $mf001=''; }
	  $mf002=$this->input->post('mf002');
	  $mf003=$this->input->post('mf003');
	  $mf004=$this->input->post('mf004');	 
	  $mf004disp=$this->input->post('mf004disp');
	  if(!isset($mf005)) {$mf005='N';} else { $mf005='Y'; }
	  $mf006=$this->input->post('mf006');
	  $mf007=$this->input->post('mf007');
	  $mf007disp=$this->input->post('mf007disp');
	  if(!isset($admq04adisp)) {$admq04adisp=$this->input->post('mf004');} else { $admq04adisp=''; }
	  if(!isset($cmsq05adisp)) {$cmsq05adisp=$this->input->post('mf007');} else { $cmsq05adisp=''; }
	?>
          <div class="box">
            <div class="box-header">
             <!-- <h3 class="box-title">使用者 - 修改</h3>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <form action="<?php echo base_url()?>index.php/scm/admi10/addsave" class="form-horizontal" id="form-edit_group" method="post" accept-charset="utf-8">
 <div class="form-group"><label for="mf001" class="col-sm-2 control-label">使用者代號</label>
 <div class="col-sm-10"><input type="text" name="mf001" value="<?php echo $mf001; ?>" id="mf001"  class="form-control"   /></div></div>
 
 <div class="form-group"><label for="mf002" class="col-sm-2 control-label">使用者名稱</label>
 <div class="col-sm-10"><input type="text" name="mf002" value="<?php echo $mf002; ?>" id="mf002" class="form-control"  /></div></div>
 
 <div class="form-group"><label for="mf003" class="col-sm-2 control-label">使用者密碼</label>
 <div class="col-sm-10"><input type="text" name="mf003" value="<?php echo $mf003; ?>" id="mf003" class="form-control"  /></div></div>
 <div class="form-group"><label for="mf004" class="col-sm-2 control-label">群組代號</label>
 <div class="col-sm-10"><input type="text" name="mf004" value="<?php echo $mf004; ?>" id="mf004" class="form-control"  /></div></div>
 <div class="form-group"><label for="mf005" class="col-sm-2 control-label">超級使用者</label>
 <div class="col-sm-10"><input type="text" name="mf005" value="<?php echo $mf005; ?>" id="mf005" class="form-control"  /></div></div>
 <div class="form-group"><label for="mf007" class="col-sm-2 control-label">部門代號</label>
 <div class="col-sm-10"><input type="text" name="mf007" value="<?php echo $mf007; ?>" id="mf007" class="form-control"  /></div></div>
 <div class="form-group"><label for="mf006" class="col-sm-2 control-label">備  註</label>
 <div class="col-sm-10"><input type="text" name="mf006" value="<?php echo $mf006; ?>" id="mf006" class="form-control"  /></div></div>
 
  
 <div class="form-group"><div class="col-sm-offset-2 col-sm-10"><div class="btn-group">
 
 <button type="submit" class="btn btn-primary btn-flat" >存檔</button>
 <button type="reset" class="btn btn-warning btn-flat" >取消</button>
 <a href="<?php echo base_url()?>index.php/scm/admi10/display" class="btn btn-default btn-flat">返回</a>
 <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" class="btn btn-primary btn-flat" id='prev' name='prev' href="<?php echo site_url('scm/admi10/updform/'.$prev_str); ?>"  ><span>上一筆</span> </a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next'class="btn btn-primary btn-flat" name='next' href="<?php echo site_url('scm/admi10/updform/'.$next_str); ?>"  ><span>下一筆</span> </a>
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