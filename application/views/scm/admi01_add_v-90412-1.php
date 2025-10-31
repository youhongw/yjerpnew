  <?php include_once './application/views/head_v.php';?>
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
          <?php
	  $date=date("Ymd");
	  if(!isset($mf001)) {$mf001=$this->input->post('mf001');} else { $mf001=''; }
	  $mf002=$this->input->post('mf002');
	  $mf003=$this->input->post('mf003');
	  $mf004=$this->input->post('mf004');	 
	  $mf004disp=$this->input->post('mf004disp');
	  $invi02disp=$this->input->post('invi02disp');
	  if(!isset($mf005)) {$mf005=0;} else { $mf005=0; }
	  $mf006=$this->input->post('mf006');
	  $mf007=$this->input->post('mf007');
	  $mf008=$this->input->post('mf008');
	  $mf007disp=$this->input->post('mf007disp');
	  if(!isset($admq04adisp)) {$admq04adisp=$this->input->post('mf004');} else { $admq04adisp=''; }
	  if(!isset($cmsq05adisp)) {$cmsq05adisp=$this->input->post('mf007');} else { $cmsq05adisp=''; }
	  $vdate=date("Ymd");
	?>
          <div class="box">
            <div class="box-header">
             <!-- <h3 class="box-title">使用者 - 修改</h3>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <form action="<?php echo base_url()?>index.php/scm/admi01/addsave" class="form-horizontal"  id="form-edit_group" method="post" accept-charset="utf-8">
  
 <div class="form-group form-inline"><label for="mf002" class="col-sm-1 control-label">儲位編號</label>
 <div class="col-sm-11"><input type="text" style="width: 300px" onKeyPress="keyFunction()" name="mf002" value="<?php echo $mf002; ?>" id="mf002" onfocus="check_title_no();" class="form-control"   /></div></div>
 
 <div class="form-group form-inline"><label for="mf003"   class="col-sm-1 control-label">容器編號</label>
 <div class="col-sm-11"><input type="text" style="width: 300px" onKeyPress="keyFunction()"name="mf003" value="<?php echo $mf003; ?>" id="mf003" class="form-control"  /></div></div>
		  
 <div class="form-group form-inline"><label for="mf004" class="col-sm-1 control-label">品號</label>
 <div class="col-sm-11"><input type="text" style="width: 200px" onKeyPress="keyFunction()" name="mf004" placeholder="請輸入欲查詢品號或品名下拉選取" value="<?php echo $mf004; ?>"  id="mf004" onfocus="check_title_no();" 
 ondblclick="search_invi02_window()"  onchange="check_invi02(this)" class="form-control"  />
<span class="input-group"> <a href="javascript:;">
          <span id="Showinvi02disp" class="btn btn-primary glyphicon glyphicon-search"></span>
        </a></span>
 <span > <?php   echo $mf004disp; ?> </span></div></div> 
 
 <!--
  <div class="row chart-row">
            <div class="form-inline input-group">
                <label for="dtp_input1" style="padding-top:2px" class="control-label">　品　　號　</label>
                <div  class="input-group date form_date" >
                    <input type="text" style="width: 270px;" onKeyPress="keyFunction()" name="mf004" placeholder="請輸入欲查詢品號或品名下拉選取" value="<?php echo $mf004; ?>"  id="mf004" onfocus="check_title_no();" 
 ondblclick="search_invi02_window()"  onchange="check_invi02(this)" class="form-control"  /> 
 <span class="input-group-addon">
 <a href="javascript:;"><span id="Showinvi02disp"
                        class="glyphicon glyphicon-search"></span><a></span> 
</div>				
  </div>    
 </div> -->
 
 <div class="form-group form-inline"><label for="mf005" style="color:black;" class="col-sm-1 control-label">數量</label>
 <div class="col-sm-11"><input type="text" style="width: 300px" onfocus="this.select()" name="mf005" value="<?php echo $mf005; ?>" id="mf005" class="form-control"  /></div></div>
 <div class="form-group form-inline"><label for="mf006" class="col-sm-1 control-label">品名</label>
 <div class="col-sm-11"><input type="text" style="width: 300px" readonly="value" name="mf006"  value="<?php echo $mf006; ?>" id="mf006" class="form-control"  /></div></div>
 <div class="form-group form-inline"><label for="mf007" class="col-sm-1 control-label">規格</label>
 <div class="col-sm-11"><input type="text" style="width: 300px" readonly="value" name="mf007" value="<?php echo $mf007; ?>" id="mf007" class="form-control"  /></div></div>
 <div class="form-group form-inline"><label for="mf008"  class="col-sm-1 control-label">單  位</label>
 <div class="col-sm-11"><input type="text" style="width: 300px" name="mf008" value="<?php echo $mf008; ?>" id="mf008" class="form-control"  /></div></div>
 <div class="form-group form-inline"><label for="mf001" class="col-sm-1 control-label">單據號碼</label>
 <div class="col-sm-11"><input type="text" style="width: 300px" readonly="value" name="mf001" value="<?php echo $mf001; ?>" id="mf001" class="form-control"  />
 <input type='hidden' name='vdate' id='vdate' value="<?php echo $vdate; ?>" /></div></div>
<!-- test -->
<!-- <div class="form-group form-inline"><label for="mf004" class="col-sm-1 control-label">品號測試</label>
<div  class="col-sm-11"><input type="text"   class="form-control" name="mf004test"   >

<a href="javascript:;">
<span  id="Showinvi02disp" 
class="btn btn-primary glyphicon glyphicon-search"></span>
</a>
</div></div> -->
<!--
 <div class="form-group has-feedback"><label for="mf004" class="col-sm-1 control-label">品號測試</label>
<div  class="col-sm-11"><input type="text"   class="form-control" name="mf004test"   >
<a href="javascript:void(1);">
<span  id="Showinvi02disp" onclick="search_invi02_window()"
class="btn btn-primary glyphicon glyphicon-search form-control-feedback"></span>
</a>
<span > <?php   echo $mf004disp; ?> </span>
</div></div>
<span class="input-group-btn">
<a href="javascript:;">
<span onclick="search_invi02_window()"  class="btn btn-primary">檢索</span></a>
</span>-->

<!-- test -->
  
 <div class="form-group"><div class="col-sm-offset-2 col-sm-11"><div class="btn-group">
 
 <button type="submit" class="btn btn-primary btn-flat" >存檔</button>
 <!-- <button  class="btn btn-warning btn-flat" onclick="javascript:location.href='../scm/admi01/display'>瀏覽</button> -->
 <a href="<?php echo base_url()?>index.php/scm/admi01/display" class="btn btn-warning btn-flat">瀏覽</a>
 <a href="<?php echo base_url()?>index.php/main" class="btn btn-default btn-flat">返回</a>
 <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" class="btn btn-primary btn-flat" id='prev' name='prev' href="<?php echo site_url('scm/admi01/updform/'.$prev_str); ?>"  ><span>上一筆</span> </a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next'class="btn btn-primary btn-flat" name='next' href="<?php echo site_url('scm/admi01/updform/'.$next_str); ?>"  ><span>下一筆</span> </a>
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

    <?php include_once("./application/views/scm/admi01_foot_v.php");?>
   <?php // include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 共用函數 -->
   <!-- 不更新網頁 自動提示方框資料google 提示前置小工具 --> 
<script type="text/javascript"><!--       
$.widget('custom.catcomplete', $.ui.autocomplete, {
	_renderMenu: function(ul, items) {
		var self = this, currentCategory = '';
						
		$.each(items, function(index, item) {
			if (item.category != currentCategory) {
				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');
								
				currentCategory = item.category;
			}
							
			self._renderItem(ul, item);
		});
	}
});	
//--></script>
  <?php  include_once("./application/views/funnew/invi02e_funmjs_v.php"); ?>  <!-- 品號 -->
  <script type="text/javascript"> 	
  $(document).ready(function(){ 	   
	$('#mf004').focus();
	});
	

  function filter1() {
	 console.log('testtest');
	}
	
//檢查最新編號
function check_title_no(){
	$('#mf001').val("");
	var vdate = $('#vdate').val();
	//alert(vdate);
	console.log(vdate);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/scm/admi01/check_title_no/"+encodeURIComponent(vdate),
		data: {
			mf001: vdate,
		}
	})
	.done(function( msg ) {
		console.log(msg);
		$('#mf001').val(msg);
	});
}
</script>
  </body>
</html>
 