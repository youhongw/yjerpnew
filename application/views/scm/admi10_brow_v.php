 
   <?php  include_once '/../head_brow_v.php';?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	      <small><?php echo $systitle; ?></small>
       <!-- <small>請假單 - 申請</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url()?>assets/admin/dashboard"><i class="fa fa-dashboard"></i> 首頁</a></li>
        <li><a href="<?php echo base_url()?>assets/admin/groups">基本設定</a></li>
        <li class="active"><?php echo $systitle; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row ">
        <div class="col-xs-12 col-sm-12">
        
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
            <!--  <h3 class="box-title"></h3>-->
			<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
  <div class="btn-group mr-2" role="group" aria-label="First group">
    <a class="btn btn-primary" href="<?php echo base_url()?>index.php/scm/admi10/addform" role="button"><i class="fa fa-plus"></i> 新增</a>
  </div>
  
  <div class="btn-group" role="group" aria-label="Third group">
    <a class="btn btn-primary" href="<?php echo base_url()?>index.php/scm/admi10/printdetail" role="button"><i class="fa fa-print"></i> 列印</a>
  </div>
  <div class="btn-group" role="group" aria-label="Four group">
    <a class="btn btn-primary" href="<?php echo base_url()?>index.php/scm/admi10/printdetail" role="button"><i class="fa fa-file"></i> 複製</a>
  </div>
  <div class="btn-group" role="group" aria-label="Five group">
    <a class="btn btn-primary" href="<?php echo base_url()?>index.php/scm/admi10/clear_sql_term" role="button"><i class="fa fa-refresh"></i> 重整</a>
  </div>
</div>
            </div>
            <!-- /.box-header -->
			
            <div class="box-body">
           <!--   <table  id="example1" class="table table-bordered table-striped"> style="overflow-x: auto;overflow-scrolling:touch;"-->
		    
		 	  <div class="table-responsive " > 
			  <table  id="example1" class="table table-bordered table-striped">
  <!--  <table style="overflow-x: auto;width:100%;overflow-scrolling:touch;" id="example1" class="table table-bordered table-striped">-->
                <thead>
                <tr style="background-color: #3C8DBC;cursor:pointer;color:#FFFFFF;" >
				  
				   <th>編輯</th>
				    <th>序號</th>
                  <th>使用者代號</th>
                  <th>使用者名稱</th>
                  <th>使用者密碼</th>
				  <th>群組代號</th>
                  <th>超級使用者</th>
				  <th>部門代號</th>
				  <th>建立日期</th>
				  <th>刪除</th>
                </tr>
                </thead>
                <tbody>
				<?php $chkval=1; ?> 
				<?php foreach($results as $row ) : ?>
                <tr>
				<!--  <td > <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->mf001?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td> -->
                 
				   <div class="btn-group btn-group-sm" role="group" aria-label="First group">
				  <td ><a class="btn btn-primary btn-sm" href="<?php echo site_url('scm/admi10/updform/'.$row->mf001)?>"   </a>修改</td>
				  </div>
				  <td><?php echo  $chkval;?></td>
                  <td><?php echo  $row->mf001;?></td>
                  <td><?php echo  $row->mf002;?></td>
                  <td><?php echo  "******";?></td>
				  <td><?php echo  $row->mf004.':'.$row->mf004disp;?></td>
                  <td><?php echo  $row->mf005;?></td>
				  <td><?php echo  $row->mf007.':'.$row->mf007disp;?></td>
				  <td><?php echo  substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>
               <!--   <div class="btn-group btn-group-sm" role="group" aria-label="First group">
				  <td ><a class="btn btn-primary btn-sm" href="<?php echo site_url('scm/admi10/updform/'.$row->mf001)?>"   </a>修改</td>
				  </div> -->
				  <div class="btn-group btn-group-sm" role="group" aria-label="Third group">
				  <td ><a class="btn btn-danger btn-sm" href="<?php echo site_url('scm/admi10/del/'.$row->mf001)?>"  role="button" </a>刪除</td>
				  </div>
				<!--  <td class="center"><a href="<?php echo site_url('scm/admi10/del/'.$row->mf001)?>">[ 刪除 </a><img src="<?php echo base_url()?>assets/image/png/dele.png" />]</td> -->
				</tr>
				<?php $chkval += 1; ?>
               <?php endforeach;?>
                </tbody>
                <tfoot>
          
              </table>
            </div>
			</div> 
			
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