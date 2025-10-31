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
                 <a class="btn btn-primary" href="<?php echo base_url() ?>index.php/scm/admi00/addform" role="button"><i class="fa fa-plus"></i>新增</a>
               </div>
               <div class="btn-group mr-2" role="group" aria-label="First group">
                 <a class="btn btn-primary" onclick="$('form').submit();" role="button"><i class="fa fa-minus"></i>刪除</a>
               </div>

               <div class="btn-group" role="group" aria-label="Five group">
                 <a class="btn btn-primary" href="<?php echo base_url() ?>index.php/scm/admi00/clear_sql_term" role="button"><i class="fa fa-refresh"></i> 重整</a>
               </div>

             </div>
           </div>

           <div class="box-body">
             <form action="<?php echo base_url() ?>index.php/scm/admi00/delete" method="post" enctype="multipart/form-data" id="form">
               <div class="table-responsive">
                 <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                   <thead>
                     <tr style="background-color: #3C8DBC;cursor:pointer;color:#FFFFFF;">
                       <td style="text-align: center;vertical-align: middle;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
                       <th style="text-align: center;vertical-align: middle;">編輯</th>
                       <th style="text-align: center;vertical-align: middle;">序號</th>
                       <th style="text-align: center;vertical-align: middle;">使用者代號</th>
                       <th style="text-align: center;vertical-align: middle;">使用者名稱</th>
                       <th style="text-align: center;vertical-align: middle;">使用者密碼</th>
                       <th style="text-align: center;vertical-align: middle;">群組代號</th>
                       <th style="text-align: center;vertical-align: middle;">超級使用者</th>
                       <th style="text-align: center;vertical-align: middle;">權限管理</th>
                       <th style="text-align: center;vertical-align: middle;">部門</th>
                       <th style="text-align: center;vertical-align: middle;">建立日期</th>

                     </tr>
                   </thead>
                   <tbody>
                     <?php $chkval = 1; ?>
                     <?php foreach ($results as $row) : ?>
                       <tr>
                         <td style="text-align: center;vertical-align: middle;"> <input type="checkbox" name="selected[]" id="cbbox" value="<?php echo trim($row->mf001) . "/" . trim($row->mf003) ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>

                         <div class="btn-group btn-group-sm" role="group" aria-label="First group">
                           <td style="text-align: center;vertical-align: middle;"><a class="btn btn-primary btn-sm" href="<?php echo site_url('scm/admi00/updform/' . trim($row->mf001) . '/') ?>" </a>修改</td>
                         </div>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  $chkval . '　'; ?></td>

                         <td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->mf001); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding(trim($row->mf002), "utf-8", "big-5"); ?></td>
                         <!-- <td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->mf003); ?></td> -->
                         <td style="text-align: center;vertical-align: middle;"><?php echo  '************'; ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->mf004) . ":" . mb_convert_encoding(trim($row->mf004disp), "utf-8", "big-5"); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->mf005); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->mf006); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->mf007) . ":" . mb_convert_encoding(trim($row->mf007disp), "utf-8", "big-5"); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  substr($row->create_date, 0, 4) . '/' . substr($row->create_date, 4, 2) . '/' . substr($row->create_date, 6, 2) . ''; ?></td>

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