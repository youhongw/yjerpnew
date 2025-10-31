 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       請假
        <small>請假申請</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">~</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>序號</th>
                  <th>使用者代號</th>
                  <th>使用者名稱</th>
                  <th>使用者密碼</th>
				  <th>群組代號</th>
                  <th>超級使用者</th>
				  <th>部門代號</th>
				  <th>建立日期</th>
				  <th>編輯</th>
                </tr>
                </thead>
                <tbody>
				<?php $chkval=1; ?> 
				<?php foreach($results as $row ) : ?>
                <tr>
                  <td><?php echo  $chkval;?></td>
                  <td><?php echo  $row->mf001;?></td>
                  <td><?php echo  $row->mf002;?></td>
                  <td><?php echo  "******";?></td>
				  <td><?php echo  $row->mf004.':'.$row->mf004disp;?></td>
                  <td><?php echo  $row->mf005;?></td>
				  <td><?php echo  $row->mf007.':'.$row->mf007disp;?></td>
				  <td><?php echo  substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>
                  <td class="center"><a href="<?php echo site_url('eip/admi10/updform/'.$row->mf001)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
				</tr>
				<?php $chkval += 1; ?>
               <?php endforeach;?>
                </tbody>
                <tfoot>
          
              </table>
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