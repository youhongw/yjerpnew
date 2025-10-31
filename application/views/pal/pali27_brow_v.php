<div class="box2"> <!-- div-1 -->
    <div class="heading">
	

      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 員工加保建立作業 - 瀏覽</h1>
     <!--  <div class="buttons"> -->
	   <div style="float:right; "> 
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali27/addform'"  style="float:left"  accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali27/copyform'"  style="float:left"  accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali27/findform'"  style="float:left"  accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left"  accesskey="-" class="button"><span>選取刪除</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
      <!-- <a onclick="$('form').submitb();"   class="button">印幣別匯率</a>   -->
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali27/printdetail'"    style="float:left"  accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a> 
	  <?PHP } ?>
	<!--
   	<?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali27/printdetailc'"   class="button"><span>印幣別匯率&nbsp</span><img src="<?php echo base_url()?>assets/image/png/print1.png" /></a> 
	  <?PHP } ?>
     -->
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali27/exceldetail'"   style="float:left"  accesskey="l" class="button"><span>轉EXCEL檔 l</span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/pal/pali27/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali27/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/111'"  style="float:left"  accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/pal/pali27/delete" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="3%" class="left">
		  <?php echo anchor("pal/pali27/display/ti001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?>
           		  
	      </td>
	      <td width="5%" class="left">
	          <?php echo anchor("pal/pali27/display/ti001/" . (($sort_order == 'asc' && $sort_by == 'ti001') ? 'desc' : 'asc') ,'員工代號'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("pal/pali27/display/ti001disp/" . (($sort_order == 'asc' && $sort_by == 'ti001disp') ? 'desc' : 'asc') ,'員工姓名'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left"> 
		  <?php echo anchor("pal/pali27/display/ti005/" . (($sort_order == 'asc' && $sort_by == 'ti005') ? 'desc' : 'asc') ,'健保金額'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
	      <td width="5%" class="left"> 
		  <?php echo anchor("pal/pali27/display/ti009/" . (($sort_order == 'asc' && $sort_by == 'ti009') ? 'desc' : 'asc') ,'勞保金額'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
	      <td width="5%" class="left">
	          <?php echo anchor("pal/pali27/display/ti010/" .(($sort_order == 'asc' && $sort_by == 'ti010') ? 'desc' : 'asc') ,'勞保加保日'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("pal/pali27/display/ti011/".(($sort_order == 'asc' && $sort_by == 'ti011') ? 'desc' : 'asc') ,'勞保退保日'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("pal/pali27/display/ti012/" . (($sort_order == 'asc' && $sort_by == 'ti012') ? 'desc' : 'asc') ,'投保公司別'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("pal/pali27/display/count/" . (($sort_order == 'asc' && $sort_by == 'count') ? 'desc' : 'asc') ,'眷口數'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("pal/pali27/display/a.modi_date/" . (($sort_order == 'asc' && $sort_by == 'a.modi_date') ? 'desc' : 'asc') ,'修改日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="12%" class="center">&nbsp查看管理&nbsp </td>
             <td width="12%" class="center">&nbsp修改管理&nbsp </td>
		   
            </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_ti001='';$filter_ti002='';$filter_ti003='';$filter_ti004='';$filter_ti005='';$filter_ti006='';$filter_ti016='';$filter_create=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	      <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
          <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text" id="filter_ti001" name="filter_ti001"  value="" size="10" />
		    </div>	
	      </td>
	      <td width="5%" class="left">
		   <div  class="button-search"></div>
		   <input type="text" id="filter_mv002" name="filter_mv002"  value="" size="10" />
		    </div>	
		  </td>
	      <td width="5%" class="left">
		    <div class="button-search"></div>
			<input type="text" name="filter_ti005" value="" size="10" />
		    </div>			  
	      </td>
	      <td width="5%" class="left">
		    <div class="button-search"></div>
			<input type="text" name="filter_ti009" value="" size="10" />
		    </div>			  
	      </td>
	      <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text" name="filter_ti010" value="" size="10" />
		   </div>
		  </td>
          <td  width="5%" align="left">
		  <div class="button-search"></div>
		   <input type="text" name="filter_ti011" value="" size="10" />
		   </div>
		  </td>
	      
		  <td  width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_ti012" value="" size="10" />
		  </div>
		  </td>
		  
		  <td  width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_count" value="" size="10" />
		  </div>
		  </td>
		  
		  <td  width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_modi_date" value="" size="10" />
		  </div>
		  </td>
	     
	      <td width="10%" align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td width="10%" align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
		 
        </tr>
			
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->ti001?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>
		  <td class="left"><?php echo  $row->ti001;?></td>			  
		  <td class="left"><?php echo  $row->ti001disp;?></td>
		  <td class="left"><?php echo  $row->ti005;?></td>
		  <td class="left"><?php echo  $row->ti009;?></td>
		  <td class="left"><?php if(strlen($row->ti010)>=8){echo  substr($row->ti010,0,4)."/".substr($row->ti010,4,2)."/".substr($row->ti010,6,2);} ?></td>
		  <td class="left"><?php if(strlen($row->ti011)>=8){echo  substr($row->ti011,0,4)."/".substr($row->ti011,4,2)."/".substr($row->ti011,6,2);} ?></td>
		  <td class="left"><?php echo  $row->ti012;?></td>
		  <td class="left"><?php echo  $row->count;?></td>
		  <td class="left"><?php if(strlen($row->modi_date)>=8){echo  substr($row->modi_date,0,4)."/".substr($row->modi_date,4,2)."/".substr($row->modi_date,6,2);} ?></td>
		
		  <td class="center"><a href="<?php echo site_url('pal/pali27/see/'.$row->ti001.'/'.$row->ti002) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
		  <td class="center"><a href="<?php echo site_url('pal/pali27/updform/'.$row->ti001.'/'.$row->ti002)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
		  <?PHP } ?>
	  
	<!--      <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pal/pali27/del/'.$row->ti001."/".trim($row->ti002))?>" id="delete1"  >[ 刪除 </a><img src="<?php echo base_url()?>assets/image/png/del.png" />]</td>  --> 
	    </tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
          </tbody>		 
        </table>
		     
	      <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		  <?php  $this->session->set_userdata('search1',"display/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
			  
			
				<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 選欄位名稱自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 選取列項出現打勾可多筆刪除, 列印可自設網址列不印, 快速鍵Alt+.. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      </form>
    
    </div> <!-- div-2 -->
   </div>  <!-- div-1 -->
</div>	<!-- div-0 -->

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
		
	var filter_ti001 = $('input[name=\'filter_ti001\']').val();
	if (filter_ti001) {
		url = '<?php echo base_url() ?>index.php/pal/pali27/filter1/ti001/desc/' + encodeURIComponent(filter_ti001);
	} 
	
	var filter_mv002 = $('input[name=\'filter_mv002\']').val();
	if (filter_mv002) {
		url = '<?php echo base_url() ?>index.php/pal/pali27/filter1/b.mv002/desc/' + encodeURIComponent(filter_mv002);
	} 
	
	var filter_ti009 = $('input[name=\'filter_ti009\']').val();
	if (filter_ti009) {
		url = '<?php echo base_url() ?>index.php/pal/pali27/filter1/ti009/desc/' + encodeURIComponent(filter_ti009);
	}
	
	var filter_ti010 = $('input[name=\'filter_ti010\']').val();
	if (filter_ti010) {
		url = '<?php echo base_url() ?>index.php/pal/pali27/filter1/ti010/desc/' + encodeURIComponent(filter_ti010);
	}
		
	var filter_ti011 = $('input[name=\'filter_ti011\']').val();
	if (filter_ti011) {
		url = '<?php echo base_url() ?>index.php/pal/pali27/filter1/ti011/desc/' + encodeURIComponent(filter_ti011); 
	}
	
	var filter_ti012 = $('input[name=\'filter_ti012\']').val();
	if (filter_ti012) {
		url = '<?php echo base_url() ?>index.php/pal/pali27/filter1/ti012/desc/' + encodeURIComponent(filter_ti012); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/pal/pali27/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
	var filter_create = $('input[name=\'filter_modi_date\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/pal/pali27/filter1/b.modi_date/desc/' + encodeURIComponent(filter_modi_date); 
	}
	
    if ( !filter_ti001  && !filter_mv002 && !filter_ti009 && !filter_ti010 && !filter_ti011 && !filter_ti012  && !filter_create && !filter_modi_date) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali27/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_ti001 = $('input[name=\'filter_ti001\']').val();
	if (filter_ti001) {
		url = '<?php echo base_url() ?>index.php/pal/pali27/filter1/ti001/asc/' + encodeURIComponent(filter_ti001);
	} 
		
	var filter_mv002 = $('input[name=\'filter_mv002\']').val();
	if (filter_mv002) {
		url = '<?php echo base_url() ?>index.php/pal/pali27/filter1/b.mv002/asc/' + encodeURIComponent(filter_mv002);
	} 
	
	var filter_ti009 = $('input[name=\'filter_ti009\']').val();
	if (filter_ti009) {
		url = '<?php echo base_url() ?>index.php/pal/pali27/filter1/ti009/asc/' + encodeURIComponent(filter_ti009);
	}
	
	var filter_ti010 = $('input[name=\'filter_ti010\']').val();
	if (filter_ti010) {
		url = '<?php echo base_url() ?>index.php/pal/pali27/filter1/ti010/asc/' + encodeURIComponent(filter_ti010);
	}
		
	var filter_ti011 = $('input[name=\'filter_ti011\']').val();
	if (filter_ti011) {
		url = '<?php echo base_url() ?>index.php/pal/pali27/filter1/ti011/asc/' + encodeURIComponent(filter_ti011);
		
	}
	
	var filter_ti012 = $('input[name=\'filter_ti012\']').val();
	if (filter_ti012) {
		url = '<?php echo base_url() ?>index.php/pal/pali27/filter1/ti012/asc/' + encodeURIComponent(filter_ti012); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/pal/pali27/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
	var filter_create = $('input[name=\'filter_modi_date\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/pal/pali27/filter1/b.modi_date/asc/' + encodeURIComponent(filter_modi_date); 
	}
	
    if (!filter_ti001  && !filter_mv002 && !filter_ti009 && !filter_ti010 && !filter_ti011 && !filter_ti012 && !filter_create && !filter_create && !filter_modi_date) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali27/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 