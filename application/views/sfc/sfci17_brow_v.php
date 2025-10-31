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
                 <a class="btn btn-primary" href="<?php echo base_url() ?>index.php/sfc/sfci17/addform" role="button"><i class="fa fa-plus"></i>新增</a>
               </div>
               <div class="btn-group mr-2" role="group" aria-label="First group">
                 <a class="btn btn-primary" onclick="$('form').submit();" role="button"><i class="fa fa-minus"></i>刪除</a>
               </div>

               <div class="btn-group" role="group" aria-label="Five group">
                 <a class="btn btn-primary" href="<?php echo base_url() ?>index.php/sfc/sfci17/clear_sql_term" role="button"><i class="fa fa-refresh"></i> 重整</a>
               </div>
               <div class="btn-group" role="group" aria-label="Five group">
                 <!-- <?php echo $this->session->userdata('mes1') ?> -->
               </div>
             </div>
           </div>


           <div class="box-body">
             <form action="<?php echo base_url() ?>index.php/sfc/sfci17/delete" method="post" enctype="multipart/form-data" id="form">
               <div class="table-responsive">
                 <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                   <thead>
                     <tr style="background-color: #3C8DBC;cursor:pointer;color:#FFFFFF;">
                       <td style="text-align: center;vertical-align: middle;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
                       <th style="text-align: center;vertical-align: middle;">編輯</th>
                       <th style="text-align: center;vertical-align: middle;">序號</th>
                       <th style="text-align: center;vertical-align: middle;">產品品號</th>
                       <th style="text-align: center;vertical-align: middle;">模具名稱</th>
                       <th style="text-align: center;vertical-align: middle;">製程資訊</th>
                       <th style="text-align: center;vertical-align: middle;">機台樣式</th>
                       <th style="text-align: center;vertical-align: middle;">規格</th>
                       <th style="text-align: center;vertical-align: middle;">衝次(產能)</th>
                       <th style="text-align: center;vertical-align: middle;">穴數</th>
                       <th style="text-align: center;vertical-align: middle;">每模毛重(g)</th>
                       <th style="text-align: center;vertical-align: middle;">每模淨重(g)</th>
                       <th style="text-align: center;vertical-align: middle;">單毛重(g)</th>
                       <th style="text-align: center;vertical-align: middle;">單淨重(g)</th>
                       <th style="text-align: center;vertical-align: middle;">作業人數</th>
                       <th style="text-align: center;vertical-align: middle;">生產週期</th>
                       <th style="text-align: center;vertical-align: middle;">報廢日期</th>
                       <th style="text-align: center;vertical-align: middle;">配料品號</th>
                       <th style="text-align: center;vertical-align: middle;">備註</th>

                     </tr>
                   </thead>
                   <tbody>
                     <?php $chkval = 1; ?>
                     <?php foreach ($results as $row) : ?>
                       <tr>
                         <td style="text-align: center;vertical-align: middle;"> <input type="checkbox" name="selected[]" id="cbbox" value="<?php echo trim($row->da001) . "/" . trim($row->da013) . "/" . trim($row->da014); ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>

                         <div class="btn-group btn-group-sm" role="group" aria-label="First group">
                           <td style="text-align: center;vertical-align: middle;"><a class="btn btn-primary btn-sm" href="<?php echo site_url('sfc/sfci17/updform/' . trim($row->da001) . "/" . trim($row->da013) . "/" . trim($row->da014) . '/') ?>" </a>修改</td>
                         </div>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  $chkval . '　'; ?></td>

                         <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da001; ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding($row->da002, "utf-8", "big-5"); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo $row->da013 . ':' . mb_convert_encoding($row->da013dis, "utf-8", "big-5"); ?></td>
                         <td style="text-align: center;vertical-align: middle;">
                           <?php
                            if ($row->da014 == '1') {
                              echo "1.單衝(手動)";
                            } else if ($row->da014 == '2') {
                              echo "2.連續";
                            }
                            ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding($row->da003, "utf-8", "big-5"); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da004; ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da005; ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da006; ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da007; ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da008; ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da009; ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da015; ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da010; ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da011; ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da016; ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding($row->da012, "utf-8", "big-5"); ?></td>

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