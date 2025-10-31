  <div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 員工基本資料建立作業 - 瀏覽</h1>
     <!--  <div class="buttons"> -->
	   <div style="float:right; ">
	    <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali01/display_leave'"  style="float:left" accesskey="w" class="button"><span>顯示離職員工 w </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	    <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali01/clear_sql_term'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	   <a onclick="location = '<?php echo base_url()?>index.php/pal/pali01/addform'"  style="float:left"  accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
       <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>	
	   <a onclick="location = '<?php echo base_url()?>index.php/pal/pali01/copyform'"  style="float:left"  accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
       <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	   <a onclick="location = '<?php echo base_url()?>index.php/pal/pali01/findform'"  style="float:left"  accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
       <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>        
	   <a onclick="$('form').submit();"  style="float:left"  accesskey="-" class="button"><span>選取刪除</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	   <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	   <a onclick="location = '<?php echo base_url()?>index.php/pal/pali01/printdetail'"   style="float:left"   accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>   
	   <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	   <a onclick="location = '<?php echo base_url()?>index.php/pal/pali01/exceldetail'"   style="float:left"    accesskey="l" class="button"><span>轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a>
       <?PHP } ?>	
	<!-- <a onclick="location = '<?php echo base_url()?>index.php/pal/pali01/printdetail'"  class="button"><span>列印</span></a>
	 <a onclick="location = '<?php echo base_url()?>index.php/pal/pali01/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	   <a onclick="location = '<?php echo base_url()?>index.php/main/index/111'" style="float:left"  accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
     </div>
	</div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/pal/pali01/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
        <thead>
        <tr>                          <!-- 表格表頭 -->
          <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("pal/pali01/display/mv001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?>
	      </td>
	      <td width="5%" class="left">
	          <?php echo anchor("pal/pali01/display/mv001/" . (($sort_order == 'asc' && $sort_by == 'mv001') ? 'desc' : 'asc') ,'員工代號'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("pal/pali01/display/mv002/" . (($sort_order == 'asc' && $sort_by == 'mv002') ? 'desc' : 'asc') ,'員工姓名'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		  <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="16%" class="left"> 
		  <?php echo anchor("pal/pali01/display/mv211/" . (($sort_order == 'asc' && $sort_by == 'mv211') ? 'desc' : 'asc') ,'評語考績'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		  <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
          </td>
	      <td width="8%" class="left">
	      <?php echo anchor("pal/pali01/display/mv021/" .(($sort_order == 'asc' && $sort_by == 'mv021') ? 'desc' : 'asc') ,'到職日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		  <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	  
	      <td width="8%" class="left">
		  <?php echo anchor("pal/pali01/display/mv015/" . (($sort_order == 'asc' && $sort_by == 'mv015') ? 'desc' : 'asc') ,'電話'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		  <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		  <?php echo anchor("pal/pali01/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		  <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="18%" class="center">&nbsp查看管理&nbsp </td>
          <td width="18%" class="center">&nbsp修改管理&nbsp </td>
          </tr>
          </thead>
		  
        <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	      <?php $filter_mv001='';$filter_mv002='';$filter_mv006='';$filter_mv008='';$filter_mv009='';$filter_mv005='';$filter_create=''; ?>
	      <tr class="filter">
	      <td class="left"></td>
	      <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
          <td align="left">
		   <div class="button-search"></div>
		   <input type="text" id="filter_mv001" name="filter_mv001" value="" size="10" />
	      </td>
			  
	      <td class="left">
		   <div  class="button-search"></div>
		   <input type="text"  name="filter_mv002" value="" size='10' />
		  </td>
			  
	      <td class="left">
		    <div class="button-search"></div>
			<input type="text" name="filter_mv008" value=""  />
	      </td>
			  
	      <td align="left">
		    <div class="button-search"></div>
		    <input type="text" name="filter_mv012" value="" size='10'  />
		  </td>
        <!--  <td align="left">
		    <div class="button-search"></div>
		    <input type="text" name="filter_mv009" value="" size="10" />
		  </td>  -->
	      <td align="left">
		    <div class="button-search"></div>
		    <input type="text" name="filter_mv015" value="" size='10' />
		  </td>
	      <td align="left">
		    <div class="button-search"></div>
		    <input type="text" name="filter_create" value="" size="10" />
		  </td>
	      <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
        </tr>
			
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->mv001."/".trim($row->mv001)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>
		  <td class="left"><?php echo  $row->mv001;?></td>			  
		  <td class="left"><?php echo  $row->mv002;?></td>
		   <td class="left" ><div style="overflow:auto;max-height:90px;max-width:200px"><?php echo  $row->mv211; ?></div></td>
		  <td class="left"><?php echo  substr($row->mv021,0,4).'/'.substr($row->mv021,4,2).'/'.substr($row->mv021,6,2);?></td>	
	  <!--	 <td class="left"><?php echo  $row->mv015;?></td> -->
		  <td class="left"><?php echo  $row->mv015;?></td>
		  <td class="center"><?php echo  substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>		                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pal/pali01/del/'.$row->mv001."/".trim($row->mv002))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><a href="<?php echo site_url('pal/pali01/see/'.$row->mv001) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>                 
		  <td class="center"><a href="<?php echo site_url('pal/pali01/updform/'.$row->mv001)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
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
  //  window.open('/index.php/pal/pali01/printdetail')
	window.location="<?php echo base_url()?>index.php/pal/pali01/printdetail";
  }

function open_winexcel()
  {
   // window.open('/index.php/pal/pali01/exceldetail')
	window.location="<?php echo base_url()?>index.php/pal/pali01/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_mv001 = $('input[name=\'filter_mv001\']').val();
	if (filter_mv001) {
		url ='<?php echo base_url() ?>index.php/pal/pali01/filter1/mv001/desc/' + encodeURIComponent(filter_mv001);
		
	} 
	
	var filter_mv002 = $('input[name=\'filter_mv002\']').val();
	if (filter_mv002) {
		url = '<?php echo base_url() ?>index.php/pal/pali01/filter1/mv002/desc/' + encodeURIComponent(filter_mv002);
	}
	
	var filter_mv008 = $('input[name=\'filter_mv008\']').val();
	if (filter_mv008) {
		url = '<?php echo base_url() ?>index.php/pal/pali01/filter1/mv008/desc/' + (filter_mv008);
	}
	
		
 	var filter_mv012 = $('input[name=\'filter_mv012\']').val();
	if (filter_mv012) {
		url = '<?php echo base_url() ?>index.php/pal/pali01/filter1/mv021/desc/' + encodeURIComponent(filter_mv012); 
	} 
	
	var filter_mv015 = $('input[name=\'filter_mv015\']').val();
	if (filter_mv015) {
		url = '<?php echo base_url() ?>index.php/pal/pali01/filter1/mv015/desc/' + encodeURIComponent(filter_mv015); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/pal/pali01/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if ( !filter_mv001  && !filter_mv002 && !filter_mv008 && !filter_mv012 && !filter_mv015 && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali01/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_mv001 = $('input[name=\'filter_mv001\']').val();
	if (filter_mv001) {
		url = '<?php echo base_url() ?>index.php/pal/pali01/filter1/mv001/asc/' + encodeURIComponent(filter_mv001);
	} 
	
	var filter_mv002 = $('input[name=\'filter_mv002\']').val();
	if (filter_mv002) {
		url = '<?php echo base_url() ?>index.php/pal/pali01/filter1/mv002/asc/' + encodeURIComponent(filter_mv002);
	} 
	
	
	var filter_mv008 = $('input[name=\'filter_mv008\']').val();
	if (filter_mv008) {
		url = '<?php echo base_url() ?>index.php/pal/pali01/filter1/mv008/asc/' + encodeURIComponent(filter_mv008);
	}
	
		
	var filter_mv012 = $('input[name=\'filter_mv012\']').val();
	if (filter_mv012) {
		url = '<?php echo base_url() ?>index.php/pal/pali01/filter1/mv021/asc/' + encodeURIComponent(filter_mv012); 
	}  
	
	var filter_mv015 = $('input[name=\'filter_mv015\']').val();
	if (filter_mv015) {
		url = '<?php echo base_url() ?>index.php/pal/pali01/filter1/mv015/asc/' + encodeURIComponent(filter_mv015); 
	}
	
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/pal/pali01/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_mv001  && !filter_mv002 && !filter_mv008 && !filter_mv012 &&  !filter_mv015 && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali01/display';location = url;
	   
	   }
	   
	location = url;
}
</script>