  <div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 國定假日建立作業 - 瀏覽</h1>
     <!--  <div class="buttons"> -->
	   <div style="float:right; "> 
	   <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	   <a onclick="location = '<?php echo base_url()?>index.php/pal/pali03/addform'"  style="float:left"  accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
       <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>	
	   <a onclick="location = '<?php echo base_url()?>index.php/pal/pali03/copyform'"  style="float:left"  accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
       <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>        
	   <a onclick="$('form').submit();"  style="float:left"  accesskey="-" class="button"><span>選取刪除</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	   <?PHP } ?>
	<!-- <a onclick="location = '<?php echo base_url()?>index.php/pal/pali03/printdetail'"  class="button"><span>列印</span></a>
	 <a onclick="location = '<?php echo base_url()?>index.php/pal/pali03/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	   <a onclick="location = '<?php echo base_url()?>index.php/main/index/111'" style="float:left"  accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
     </div>
	</div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/pal/pali03/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
        <thead>
        <tr>                          <!-- 表格表頭 -->
          <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="8%" class="left">
		  <?php echo anchor("pal/pali03/display/ms001/" . (($sort_order == 'asc' && $sort_by == 'ms001') ? 'desc' : 'asc') ,'年份'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		  <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="8%" class="left">
		  <?php echo anchor("pal/pali03/display/count_count/" . (($sort_order == 'asc' && $sort_by == 'count_count') ? 'desc' : 'asc') ,'放假日數'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		  <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="8%" class="left">
		  <?php echo anchor("pal/pali03/display/creator/" . (($sort_order == 'asc' && $sort_by == 'creator') ? 'desc' : 'asc') ,'建立者'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		  <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		  <?php echo anchor("pal/pali03/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		  <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="18%" class="center">&nbsp查看管理&nbsp </td>
          <td width="18%" class="center">&nbsp修改管理&nbsp </td>
          </tr>
          </thead>
		  
        <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	      <?php $filter_ms001='';$filter_creator='';$filter_create=''; ?>
	      <tr class="filter">
	      <td class="left"></td>
	      <td align="left">
		    <div class="button-search"></div>
			<!--<div style="height:22px;"></div>-->
		    <input type="text" name="filter_ms001" value=""  size="10" />
		  </td>
	      <td align="left">
		    <div class="button-search"></div>
		    <input type="text" name="filter_count_count" value=""  size="10" />
		  </td>
	      <td align="left">
		    <div class="button-search"></div>
		    <input type="text" name="filter_creator" value="" />
		  </td>
	      <td align="left">
		    <div class="button-search"></div>
		    <input type="text" name="filter_create" value=""/>
		  </td>
	      <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
        </tr>
			
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->ms001."/".trim($row->ms001)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
		  <td class="left"><?php echo $row->ms001;?></td>
		  <td class="left"><?php echo $row->count_count;?></td>
		  <td class="left"><?php echo $row->creator;?></td>
		  <td class="left"><?php echo substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>		                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pal/pali03/del/'.$row->ms001."/".trim($row->ms002))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><a href="<?php echo site_url('pal/pali03/see/'.$row->ms001) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>                 
		  <td class="center"><a href="<?php echo site_url('pal/pali03/updform/'.$row->ms001)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
          <?PHP } ?>	   
	   </tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
        </tbody>		 
        </table>
		     
	           <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		       <?php  $this->session->set_userdata('search1',"display/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
			 
				<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] '.' 　　總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      </form>
    
   </div> <!-- div-2 -->
  </div>  <!-- div-1 -->
</div>  <!-- div-0 -->
<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
  //  window.open('/index.php/pal/pali03/printdetail')
	window.location="<?php echo base_url()?>index.php/pal/pali03/printdetail";
  }

function open_winexcel()
  {
   // window.open('/index.php/pal/pali03/exceldetail')
	window.location="<?php echo base_url()?>index.php/pal/pali03/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_ms001 = $('input[name=\'filter_ms001\']').val();
	if (filter_ms001) {
		url ='<?php echo base_url() ?>index.php/pal/pali03/filter1/ms001/desc/' + encodeURIComponent(filter_ms001);
		
	} 
	
	var filter_ms002 = $('input[name=\'filter_ms002\']').val();
	if (filter_ms002) {
		url = '<?php echo base_url() ?>index.php/pal/pali03/filter1/ms002/desc/' + encodeURIComponent(filter_ms002);
	}
	
	var filter_count_count = $('input[name=\'filter_count_count\']').val();
	if (filter_count_count) {
		url = '<?php echo base_url() ?>index.php/pal/pali03/filter1/count_count/desc/' + (filter_count_count);
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/pal/pali03/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if ( !filter_ms001  && !filter_ms002 && !filter_count_count && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali03/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_ms001 = $('input[name=\'filter_ms001\']').val();
	if (filter_ms001) {
		url = '<?php echo base_url() ?>index.php/pal/pali03/filter1/ms001/asc/' + encodeURIComponent(filter_ms001);
	} 
	
	var filter_ms002 = $('input[name=\'filter_ms002\']').val();
	if (filter_ms002) {
		url = '<?php echo base_url() ?>index.php/pal/pali03/filter1/ms002/asc/' + encodeURIComponent(filter_ms002);
	} 
	
	
	var filter_count_count = $('input[name=\'filter_count_count\']').val();
	if (filter_count_count) {
		url = '<?php echo base_url() ?>index.php/pal/pali03/filter1/count_count/asc/' + encodeURIComponent(filter_count_count);
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/pal/pali03/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_ms001  && !filter_ms002 && !filter_count_count && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali03/display';location = url;
	   
	   }
	   
	location = url;
}
</script>