 
   <?php  include_once './application/views/head_brow_v.php';?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	      <small><?php echo $systitle; ?></small>
       <!-- <small>請假單 - 申請</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url()?>index.php/main"><i class="fa fa-dashboard"></i> 首頁</a></li>
      <!--  <li><a href="<?php echo base_url()?>assets/admin/groups">基本設定</a></li> -->
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
  <!--<div class="btn-group mr-2" role="group" aria-label="First group">
    <a class="btn btn-primary" href="<?php echo base_url()?>index.php/scm/admi05/addform" role="button"><i class="fa fa-plus"></i> 新增</a>
  </div>-->
  
  <!--<div class="btn-group" role="group" aria-label="Third group">
    <a class="btn btn-primary" href="<?php echo base_url()?>index.php/scm/admi05/printdetail" role="button"><i class="fa fa-print"></i> 列印</a>
  </div>
  <div class="btn-group" role="group" aria-label="Four group">
    <a class="btn btn-primary" href="<?php echo base_url()?>index.php/scm/admi05/printdetail" role="button"><i class="fa fa-file"></i> 複製</a>
  </div> -->
  <div class="btn-group" role="group" aria-label="Five group">
    <a class="btn btn-primary" href="<?php echo base_url()?>index.php/scm/admi05/clear_sql_term" role="button"><i class="fa fa-refresh"></i> 重整</a>
  </div>
  <div class="btn-group" role="group" aria-label="Five group">
    <a class="btn btn-primary" href="<?php echo base_url()?>index.php/main" role="button"><i class="fa fa-genderless"></i> 返回</a>
  </div>
</div>
            </div>
            <!-- /.box-header -->
			
            <div class="box-body">
           <!--   <table  id="example1" class="table table-bordered table-striped"> style="overflow-x: auto;overflow-scrolling:touch;"-->
		    
		 	  <div class="table-responsive " > 
			  <table  id="example3" class="table table-bordered table-striped">
  <!--  <table style="overflow-x: auto;width:100%;overflow-scrolling:touch;" id="example1" class="table table-bordered table-striped">-->
                <thead>
				<?php 
	  $title_array = array(
	//	'rowid' => array('sort_name'=>"TA001",'name'=>"序號",'width'=>"5%",'align'=>"left",'use'=>"disable"),
		'ROWID' => array('sort_name'=>"ROWID",'name'=>"編輯",'width'=>"3%",'align'=>"left"),
		'rowid' => array('sort_name'=>"TA001",'name'=>"序號",'width'=>"3%",'align'=>"left",'use'=>"disable"),
		'MA001' => array('sort_name'=>"MA001",'name'=>"客戶代號",'width'=>"5%",'align'=>"left"),
		'MA002' => array('sort_name'=>"MA002",'name'=>"客戶名稱",'width'=>"5%",'align'=>"left"),
		'MA005' => array('sort_name'=>"MA005",'name'=>"聯絡人",'width'=>"5%",'align'=>"left"),
		'MA006' => array('sort_name'=>"MA006",'name'=>"電話",'width'=>"5%",'align'=>"left"),
		'MA008' => array('sort_name'=>"MA008",'name'=>"傳真",'width'=>"5%",'align'=>"left"),
		'MA027' => array('sort_name'=>"MA027",'name'=>"地址",'width'=>"10%",'align'=>"left"),
		'CREATE_DATE' => array('sort_name'=>"CREATE_DATE",'name'=>"建立日期",'width'=>"5%",'align'=>"left"),
	//	'see' => array('sort_name'=>"",'name'=>"查看",'width'=>"12%",'align'=>"center"),
	//	'edit' => array('sort_name'=>"",'name'=>"查看",'width'=>"12%",'align'=>"center"),
	//	'print' => array('sort_name'=>"",'name'=>"印製令單",'width'=>"12%",'align'=>"center")
	  );
    ?>
				<tr style="background-color: #3C8DBC;cursor:pointer;color:#FFFFFF;">   <!-- 表格表頭 -->
             <!-- <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>-->
	      <?php
		   foreach($title_array as $key => $val){
			  echo "<td width=".$val['width']." class='".$val['align']."'>";
			  echo $val['name'];
				if(isset($val['use'])){
				  if($val['use'] == "disable"){
					echo "</td>";continue;
				  }
				}
				if($val['sort_name'] == ""){
				  echo "</td>";continue;
				}
			  $str = "<img src='".base_url()."assets/image/asc.png' />";
			  echo anchor("scm/admi05/display_search/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." asc",$str);
			  $str = "<img src='".base_url()."assets/image/desc.png' />";
			  echo anchor("scm/admi05/display_search/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." desc",$str);
				
			  echo "</td>";
			}
		  ?>
            </tr>
          </thead>
		  <?php 
		 
	  $filter_array = array(
		//'rowid' => array('filter_name'=>"",'name'=>"序號",'size'=>"6",'align'=>"left",'use'=>"disable"),
		//'ROWID' => array('filter_name'=>"ROWID",'name'=>"編輯",'size'=>"4",'align'=>"left"),
		'rowid' => array('filter_name'=>"",'name'=>"序號",'size'=>"6",'align'=>"left",'use'=>"disable"),
		'MA001' => array('filter_name'=>"MA001",'name'=>"客戶代號",'size'=>"8",'align'=>"left"),
		'MA002' => array('filter_name'=>"MA002",'name'=>"客戶名稱",'size'=>"8",'align'=>"left"),
		'MA005' => array('filter_name'=>"MA005",'name'=>"聯絡人",'size'=>"8",'align'=>"left"),
		'MA006' => array('filter_name'=>"MA006",'name'=>"電話",'size'=>"10",'align'=>"left"),
		'MA008' => array('filter_name'=>"MA008",'name'=>"傳真",'size'=>"8",'align'=>"left"),
		'MA027' => array('filter_name'=>"MA027",'name'=>"地址",'size'=>"8",'align'=>"left"),
		'CREATE_DATE' => array('filter_name'=>"CREATE_DATE",'name'=>"建立日期",'size'=>"8",'align'=>"left"),
	  );
    ?> 
	     <tr class="filter">
	   <!--   <td class="left"></td> -->
		  <td align="center"><a onclick="filter();" style="cursor:pointer" accesskey="q" class="button">篩選</a></td>
	      <?php
			  foreach($filter_array as $key => $val){
				echo "<td class='".$val['align']."'>";
				  if($val['filter_name']==""){echo "</td>";continue;}  //filter_name = "" 沒有使用
				echo "<div class='button-search'></div>";
				  $ipt_str = "";
				  $ipt_str .= "<input type='text' id='".$val['filter_name']."' name='".$val['filter_name']."' class='filter_ipt' ";
				  if(isset($val['size'])){$ipt_str .= "size='".$val['size']."' ";}
				  if(isset($val['value'])){$ipt_str .= "value='".$val['value']."' ";}
				  if(isset($val['color'])){$ipt_str .= "style='background-color:".$val['color'].";' ";}
				  $ipt_str .= "/>";					
				  echo $ipt_str;
				  echo "</td>"; 
			  }
			?>
	    <!--  <td align="center"><a onclick="filter();" accesskey="q" class="button">篩選 AND q</a></td>		
		  <td align="center"><a onclick="filtera();" accesskey="w" class="button">篩選 OR w</a></td> -->
        </tr>
           <!--     <tr style="background-color: #3C8DBC;cursor:pointer;color:#FFFFFF;" >
				   <th>編輯</th>
				    <th>序號</th>
                  <th>客戶代號</th>
                  <th>客戶名稱</th>
				  <th>聯絡人</th>
                  <th>電話</th>
				  <th>傳真</th>
                  <th>地址</th>
				  <th>建立日期</th>
				  <th>查看</th>
				  <th>查看</th>
                </tr> -->
                </thead>
                <tbody>
				<?php $chkval=1; ?> 
				<?php foreach($results as $row ) : ?>
                <tr>
				<!--  <td > <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->MA001?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td> -->
                 
				   <div class="btn-group btn-group-sm" role="group" aria-label="First group">
				  <td ><a class="btn btn-primary btn-sm" href="<?php echo site_url('scm/admi05/see/'.trim($row->MA001))?>"   </a>看明細</td>
				  </div>
				  
				  <td><?php echo  $chkval.'　';?></td>
                  <td><?php echo  iconv("big-5","utf-8//IGNORE", $row->MA001);?></td>
                  <td><?php echo  iconv("big-5","utf-8//IGNORE", $row->MA002);?></td>
                  <td><?php echo  iconv("big-5","utf-8//IGNORE", $row->MA005);?></td>
				  <td><?php echo  iconv("big-5","utf-8//IGNORE", $row->MA006);?></td>
                  <td><?php echo  iconv("big-5","utf-8//IGNORE", $row->MA008);?></td>
				  <td><?php echo  iconv("big-5","utf-8//IGNORE", $row->MA027);?></td>
				  <td><?php echo  substr($row->CREATE_DATE,0,4).'/'.substr($row->CREATE_DATE,4,2).'/'.substr($row->CREATE_DATE,6,2);?></td>
                 
			   <!--   <div class="btn-group btn-group-sm" role="group" aria-label="First group">
				  <td ><a class="btn btn-primary btn-sm" href="<?php echo site_url('scm/admi05/updform/'.$row->MA001)?>"   </a>修改</td>
				  </div> -->
				<!--  <div class="btn-group btn-group-sm" role="group" aria-label="Third group">
				  <td ><a class="btn btn-danger btn-sm" href="<?php echo site_url('scm/admi05/del/'.$row->MA001)?>"  role="button" </a>刪除</td>
				  </div>-->
				<!--  <td class="center"><a href="<?php echo site_url('scm/admi05/del/'.$row->MA001)?>">[ 刪除 </a><img src="<?php echo base_url()?>assets/image/png/dele.png" />]</td> -->
				</tr>
				<?php $chkval += 1; ?>
               <?php endforeach;?>
                </tbody>
                <tfoot>
          
              </table>
			  <!-- 顯示頁次 -->
			
				<div class="pagination"><div class="results" style="font-size:18px"><?php echo $pagination; ?></div></div>
				<div class="success" style="font-size:18px"><?php echo date("Y/m/d").'  提示訊息：'.$this->session->userdata('msg1').$message.'<span>'.'</span>'.
               ' '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
              <?php  $this->session->unset_userdata('msg1'); ?> 
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
    <?php include_once './application/views/scm/admi05_foot_v.php';?>