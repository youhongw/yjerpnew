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
                 <a class="btn btn-primary" href="<?php echo base_url() ?>index.php/sfc/sfcp03g/addform" role="button"><i class="fa fa-plus"></i>新增</a>
               </div>
               <div class="btn-group mr-2" role="group" aria-label="First group">
                 <a class="btn btn-primary" onclick="$('form').submit();" role="button"><i class="fa fa-minus"></i>刪除</a>
               </div>

               <div class="btn-group" role="group" aria-label="Five group">
                 <a class="btn btn-primary" href="<?php echo base_url() ?>index.php/sfc/sfcp03g/clear_sql_term" role="button"><i class="fa fa-refresh"></i> 重整</a>
               </div>
               <div class="btn-group" role="group" aria-label="Five group">
                 <a class="btn btn-primary" href="<?php echo base_url() ?>index.php/sfc/sfcp03g/bupdform" role="button"><i class="fa fa-copy"></i>依系列-整批更新</a>
               </div>
             </div>
           </div>



           <div class="box-body">
             <form action="<?php echo base_url() ?>index.php/sfc/sfcp03g/delete" method="post" enctype="multipart/form-data" id="form">
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
                       <th style="text-align: center;vertical-align: middle;">機台樣式</th>
                       <th style="text-align: center;vertical-align: middle;">系列別</th>
                       <!-- <th style="text-align: center;vertical-align: middle;">專用機</th> -->
                       <th style="text-align: center;vertical-align: middle;">工價小計</th>
                       <th style="text-align: center;vertical-align: middle;">上珠碗/底板波盤</th>
                       <th style="text-align: center;vertical-align: middle;">下珠碗/齒碗</th>
                       <th style="text-align: center;vertical-align: middle;">剎車踏板彈片</th>
                       <th style="text-align: center;vertical-align: middle;">剎車鉚合</th>
                       <th style="text-align: center;vertical-align: middle;">鉚固定座</th>
                       <th style="text-align: center;vertical-align: middle;">支架鉚合</th>
                       <th style="text-align: center;vertical-align: middle;">敲銅環</th>
                       <th style="text-align: center;vertical-align: middle;">其他</th>
                       <th style="text-align: center;vertical-align: middle;">備註</th>

                     </tr>
                   </thead>
                   <tbody>
                     <?php $chkval = 1; ?>
                     <?php foreach ($results as $row) : ?>
                       <tr>
                         <td style="text-align: center;vertical-align: middle;"><input type="checkbox" name="selected[]" id="cbbox" value="<?php echo trim($row->pg001) . '/' . trim($row->pg002) . '/' . trim($row->pg003) . '/'; ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>

                         <div class="btn-group btn-group-sm" role="group" aria-label="First group">
                           <td style="text-align: center;vertical-align: middle;"><a class="btn btn-primary btn-sm" href="<?php echo site_url('sfc/sfcp03g/updform/' . trim($row->pg001) . '/' . trim($row->pg002) . '/' . trim($row->pg003) . '/'. $price . '/') ?>">修改</td>
                         </div>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  $chkval . '　'; ?></td>

                         <td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->pg001); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding(trim($row->MB002), "utf-8", "big-5"); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding(trim($row->MB003), "utf-8", "big-5"); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding(trim($row->MB004), "utf-8", "big-5"); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->pg002); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->pg003); ?></td>
                         <!-- <td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->pg004); ?></td> -->
						 <td style="text-align: center;vertical-align: middle;"><?php echo  round($row->pg019, 3); ?></td>
						 
                         <!--td style="text-align: center;vertical-align: middle;"><?php// echo  round($row->pg005 + $row->pg006 + $row->pg007 + $row->pg008
                                                                                 // + $row->pg009 + $row->pg010 + $row->pg011 + $row->pg012, 3); ?></td>-->
                         <td style="text-align: center;vertical-align: middle;"><?php echo  round(trim($row->pg005), 3); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  round(trim($row->pg006), 3); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  round(trim($row->pg007), 3); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  round(trim($row->pg008), 3); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  round(trim($row->pg009), 3); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  round(trim($row->pg010), 3); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  round(trim($row->pg011), 3); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  round(trim($row->pg012), 3); ?></td>
                         <td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding(trim($row->pg013), "utf-8", "big-5"); ?></td>


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