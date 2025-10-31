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
          <?php   $mf001=$row->mf001;?>
          <?php   $mf002=$row->mf002;?>
          <?php   $mf003=$row->mf003;?>
		  <?php   $mf004=$row->mf004;?>
		  <?php   $mf004disp=$row->mf004disp;?>
		  <?php   $mf005=$row->mf005;?>
		  <?php   $mf006=$row->mf006;?>
		  <?php   $mf007=$row->mf007;?>
		  <?php   $mf008=$row->mf008;?>
		  <?php   $mf007disp=$row->mf007disp;?>
          <?php   $flag=$row->flag;?>	

          <?php   $admq04adisp=$row->mf004disp;?>    <!-- 群組代號  -->
          <?php   $cmsq05adisp=$row->mf007disp;?>	<!-- 部門代號  -->		
	      <?php  }?>
          <div class="box">
            <div class="box-header">
             <!-- <h3 class="box-title">使用者 - 修改</h3>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <form action="<?php echo base_url()?>index.php/scm/admi05/updsave/<?php echo $results[0]->mf001;?>" class="form-horizontal" id="form-edit_group" method="post" accept-charset="utf-8">
 <div class="form-group"><label for="mf002" class="col-sm-2 control-label">儲位編號</label>
 <div class="col-sm-10"><input type="text" name="mf002" value="<?php echo $mf002; ?>" id="mf002"  class="form-control"   /></div></div>
 
 <div class="form-group"><label for="mf003" class="col-sm-2 control-label">容器編號</label>
 <div class="col-sm-10"><input type="text" name="mf003" value="<?php echo $mf003; ?>" id="mf003" class="form-control"  /></div></div>
 
 <div class="form-group"><label for="mf004" class="col-sm-2 control-label">品號</label>
 <div class="col-sm-10"><input type="text" name="mf004" value="<?php echo $mf004; ?>" id="mf004" class="form-control"  /></div></div>
 <div class="form-group"><label for="mf005" class="col-sm-2 control-label">數量</label>
 <div class="col-sm-10"><input type="text" name="mf005" value="<?php echo $mf005; ?>" id="mf005" class="form-control"  /></div></div>
 <div class="form-group"><label for="mf006" class="col-sm-2 control-label">品名</label>
 <div class="col-sm-10"><input type="text"  readonly="value" name="mf006" value="<?php echo $mf006; ?>" id="mf006" class="form-control"  /></div></div>
 <div class="form-group"><label for="mf007" class="col-sm-2 control-label">規格</label>
 <div class="col-sm-10"><input type="text"  readonly="value" name="mf007" value="<?php echo $mf007; ?>" id="mf007" class="form-control"  /></div></div>
 <div class="form-group"><label for="mf008" class="col-sm-2 control-label">單  位</label>
 <div class="col-sm-10"><input type="text"   name="mf008" value="<?php echo $mf008; ?>" id="mf008" class="form-control"  /></div></div>
 <div class="form-group"><label for="mf001" class="col-sm-2 control-label">單據號碼</label>
 <div class="col-sm-10"><input type="text"  readonly="value" name="mf001" value="<?php echo $mf001; ?>" id="mf001" class="form-control"  /></div></div>
 
  
 <div class="form-group"><div class="col-sm-offset-2 col-sm-10"><div class="btn-group">
 
 <button type="submit" class="btn btn-primary btn-flat" >存檔</button>
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