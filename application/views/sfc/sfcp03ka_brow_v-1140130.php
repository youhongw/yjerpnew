 <?php include_once './application/views/head_v.php'; ?>
 <div class="content-wrapper">
   <section class="content-header">
     <h1>
       <small><?php echo $systitle; ?></small>
     </h1>
     <ol class="breadcrumb">
       <li><a href="<?php echo base_url() ?>index.php/main"><i class="fa fa-dashboard"></i> 首頁</a></li>
       <li class="active"><?php echo $systitle; ?></li>
     </ol>
   </section>

   <section class="content">
     <div class="row ">
       <div class="col-12 col-xs-12 col-sm-12">

         <div class="box">
           <div class="box-header">

             <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
               <div class="btn-group mr-2" role="group" aria-label="First group">
                 <a class="btn btn-primary" href="<?php echo base_url() ?>index.php/sfc/sfcp03ka/addform" role="button"><i class="fa fa-plus"></i>新增</a>
               </div>
               <div class="btn-group mr-2" role="group" aria-label="First group">
                 <a class="btn btn-primary" onclick="$('form').submit();" role="button"><i class="fa fa-minus"></i>刪除</a>
               </div>

               <div class="btn-group" role="group" aria-label="Five group">
                 <a class="btn btn-primary" href="<?php echo base_url() ?>index.php/sfc/sfcp03ka/clear_sql_term" role="button"><i class="fa fa-refresh"></i> 重整</a>
               </div>
			   <div class="btn-group" role="group" aria-label="Five group">
                 <a class="btn btn-primary" href="<?php echo base_url() ?>index.php/sfc/sfcp03ka/clear_sql_term" role="button"><i class="fa fa-refresh"></i> 計算基準</a>
               </div>
               <div class="btn-group" role="group" aria-label="Five group">
                 <!-- <?php echo $this->session->userdata('mes1') ?> -->
               </div>
             </div>
           </div>



           <div class="box-body">
             <form action="<?php echo base_url() ?>index.php/sfc/sfcp03ka/delete" method="post" enctype="multipart/form-data" id="form">
               <div class="table-responsive">
                 <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                   <thead>
                     <tr style="background-color: #3C8DBC;cursor:pointer;color:#FFFFFF;">
                       <td style="text-align: center;vertical-align: middle;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
                       <th style="text-align: center;vertical-align: middle;">編輯</th>
                       <th style="text-align: center;vertical-align: middle;">序號</th>
                       <th style="text-align: center;vertical-align: middle;">品號</th>
                       <th style="text-align: center;vertical-align: middle;">品名</th>
                       <th style="text-align: center;vertical-align: middle;">規格</th>
                       <th style="text-align: center;vertical-align: middle;">單位</th>
                       <th style="text-align: center;vertical-align: middle;">工價</th>
                       <th style="text-align: center;vertical-align: middle;">模具穴數</th>
                       <th style="text-align: center;vertical-align: middle;">生產週期(秒)</th>
                       <th style="text-align: center;vertical-align: middle;">備註</th>
					   <th style="text-align: center;vertical-align: middle;">生效日期</th>

                     </tr>
                   </thead>
                   <tbody>
                     <?php $chkval = 1; ?>
                     <?php foreach ($results as $row) : ?>
                       <tr>
                         <td style="text-align: center;vertical-align: middle;"><input type="checkbox" name="selected[]" id="cbbox" value="<?php echo trim($row->pk001); ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>

                         <div class="btn-group btn-group-sm" role="group" aria-label="First group">
                           <td style="text-align: center;vertical-align: middle;"><a class="btn btn-primary btn-sm" href="<?php echo site_url('sfc/sfcp03ka/updform/' . trim($row->pk001) . '/') ?>">修改</td>
                         </div>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  $chkval . '　'; ?></td>

                         <td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->pk001); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding(trim($row->MB002), "utf-8", "big-5"); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding(trim($row->MB003), "utf-8", "big-5"); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding(trim($row->MB004), "utf-8", "big-5"); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  round(trim($row->pk006), 3); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  round(trim($row->pk002), 2); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  round(trim($row->pk003), 2); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding(trim($row->pk007), "utf-8", "big-5"); ?></td>
						 <td style="text-align: center;vertical-align: middle;"><?php echo  $row->pk008; ?></td>


                       </tr>
                       <?php $chkval += 1; ?>
                     <?php endforeach; ?>
                   </tbody>
                   <tfoot>

                 </table>
               </div>
             </form>
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
 <?php include_once './application/views/foot_brow_new_v.php'; ?>