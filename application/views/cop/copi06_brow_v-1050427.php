<div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 客戶訂單資料建立作業 - 瀏覽</h1>
     <!--  <div class="buttons"> -->
	   <div style="float:right; "> 
	   <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi06/clear_sql_term'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi06/addform'"  style="float:left" accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi06/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi06/findform'"  style="float:left" accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>選取刪除</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
      <!-- <a onclick="$('form').submitb();"   class="button">印客戶訂單</a>   -->
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi06/printdetail'"   style="float:left"  accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi06/printdetailc'"   style="float:left"  accesskey="o" class="button"><span>印客戶訂單 o </span><img src="<?php echo base_url()?>assets/image/png/print1.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi06/exceldetail'"  style="float:left"  accesskey="l" class="button"><span>轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/cop/copi06/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi06/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/104'"  style="float:left" accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a> 
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/cop/copi06/delete" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("cop/copi06/display/tc001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?>
           		  
	      </td>
	      <td width="10px" class="left">
	          <?php echo anchor("cop/copi06/display/tc001/" . (($sort_order == 'asc' && $sort_by == 'tc001') ? 'desc' : 'asc') ,'客戶訂單別'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("cop/copi06/display/tc002/" . (($sort_order == 'asc' && $sort_by == 'tc002') ? 'desc' : 'asc') ,'客戶訂單號'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("cop/copi06/display/tc003/" . (($sort_order == 'asc' && $sort_by == 'tc003') ? 'desc' : 'asc') ,'單據日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
	      <td width="5%" class="left">
	          <?php echo anchor("cop/copi06/display/tc004/" .(($sort_order == 'asc' && $sort_by == 'tc004') ? 'desc' : 'asc') ,'客戶代號'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("cop/copi06/display/b.ma002/".(($sort_order == 'asc' && $sort_by == 'b.ma002') ? 'desc' : 'asc') ,'客戶名稱'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("cop/copi06/display/tc029/" . (($sort_order == 'asc' && $sort_by == 'tc029') ? 'desc' : 'asc') ,'訂單金額'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		  <td width="5%" class="left">
		  <?php echo anchor("cop/copi06/display/tc030/" . (($sort_order == 'asc' && $sort_by == 'tc030') ? 'desc' : 'asc') ,'稅額'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		  <?php echo anchor("cop/copi06/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="12%" class="center">&nbsp查看管理&nbsp </td>
             <td width="12%" class="center">&nbsp修改管理&nbsp </td>
		      <td width="12%" class="center">&nbsp印客戶訂單&nbsp </td>
            </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_tc001='';$filter_tc002='';$filter_tc003='';$filter_tc004='';$filter_ma002='';$filter_tc029='';$filter_tc030='';$filter_create=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	      <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
          <td width="10px" align="left">
		   <div class="button-search"></div>
		   <input type="text" id="filter_tc001" name="filter_tc001"  value="" size="12" />
		   
	      </td>
			  
	      <td width="5%" class="left">
		   <div  class="button-search"></div>
		   <input type="text" id="filter_tc002" name="filter_tc002"  value="" size="12" />
		   
		  </td>
			  
	      <td width="5%" class="left">
		    <div class="button-search"></div>
			<input type="text" name="filter_tc003" size="16" value="" size="12" />
		    </div>			  
	      </td>
			  
	      <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text"  name="filter_tc004" size="12" value="" />
		   
		  </td>
		  
          <td  width="5%" align="left">
		  <div class="button-search"></div>
		   <input type="text" id="filter_ma002" name="filter_ma002" value="" size="12"  />
		  
		  </td>
	      
		  <td  width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_tc029" size="12" value="" />
		  
		  </td>
		  
		  <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_tc030" size="8" value="" />
		 
		  </td>
		  
	      <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_create" size="12" value="" />
		  
		  </td>		 
	      <td width="10%" align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td width="10%" align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
		  <td width="10%" align="center"></td> 
        </tr>
			
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->tc001."/".trim($row->tc002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo $chkval;?></td>
		  <td class="left"><?php echo $row->tc001;?></td>			  
		  <td class="left"><?php echo $row->tc002;?></td>
		  <td class="left"><?php echo substr($row->tc003,0,4).'/'.substr($row->tc003,4,2).'/'.substr($row->tc003,6,2);?></td>
		  <td class="left"><?php echo $row->tc004;?></td>
		  <td class="left"><?php echo $row->ma002;?></td>
		  <td class="left"><?php echo $row->tc029;?></td>
		  <td class="left"><?php echo $row->tc030;?></td>
		  <td class="center"><?php echo substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>		                 			
		
		  <td class="center"><a href="<?php echo site_url('cop/copi06/see/'.$row->tc001.'/'.$row->tc002) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
		  <td class="center"><a href="<?php echo site_url('cop/copi06/updform/'.$row->tc001.'/'.$row->tc002)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
		  <?PHP } ?>
	      <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
		  <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('cop/copi06/printbb/'.$row->tc001."/".trim($row->tc002))?>" id="print1"  >[ 印單據 </a><img src="<?php echo base_url()?>assets/image/png/Print1.png" />]</td>
	      <?PHP } ?>
	      <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('cop/copi06/del/'.$row->tc001."/".trim($row->tc002))?>" id="delete1"  >[ 刪除 ]</a></td>   -->
	    </tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
          </tbody>		 
        </table>
		     
	      <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		  <?php  $this->session->set_userdata('search1',"display/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
			  
			
				<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$this->session->userdata('msg1').$message.'<span>'.'</span>'.
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      <?php  $this->session->unset_userdata('msg1'); ?> 
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
		
	var filter_tc001 = $('input[name=\'filter_tc001\']').val();
	if (filter_tc001) {
		url = '<?php echo base_url() ?>index.php/cop/copi06/filter1/tc001/desc/' + encodeURIComponent(filter_tc001);
	} 
	
	var filter_tc002 = $('input[name=\'filter_tc002\']').val();
	if (filter_tc002) {
		url = '<?php echo base_url() ?>index.php/cop/copi06/filter1/tc002/desc/' + encodeURIComponent(filter_tc002);
	} 
	
	var filter_tc003 = $('input[name=\'filter_tc003\']').val();
	if (filter_tc003) {
		url = '<?php echo base_url() ?>index.php/cop/copi06/filter1/tc003/desc/' + encodeURIComponent(filter_tc003);
	}
	
	var filter_tc004 = $('input[name=\'filter_tc004\']').val();
	if (filter_tc004) {
		url = '<?php echo base_url() ?>index.php/cop/copi06/filter1/tc004/desc/' + encodeURIComponent(filter_tc004);
	}
		
	var filter_ma002 = $('input[name=\'filter_ma002\']').val();
	if (filter_ma002) {
		url = '<?php echo base_url() ?>index.php/cop/copi06/filter1/b.ma002/desc/' + encodeURIComponent(filter_ma002); 
	}
	
	var filter_tc029 = $('input[name=\'filter_tc029\']').val();
	if (filter_tc029) {
		url = '<?php echo base_url() ?>index.php/cop/copi06/filter1/tc029/desc/' + encodeURIComponent(filter_tc029); 
	}
		var filter_tc030 = $('input[name=\'filter_tc030\']').val();
	if (filter_tc030) {
		url = '<?php echo base_url() ?>index.php/cop/copi06/filter1/tc030/desc/' + encodeURIComponent(filter_tc030); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/cop/copi06/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if ( !filter_tc001  && !filter_tc002 && !filter_tc003 && !filter_tc004 && !filter_ma002 && !filter_tc029  && !filter_tc030 && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/cop/copi06/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_tc001 = $('input[name=\'filter_tc001\']').val();
	if (filter_tc001) {
		url = '<?php echo base_url() ?>index.php/cop/copi06/filter1/tc001/asc/' + encodeURIComponent(filter_tc001);
	} 
		
	var filter_tc002 = $('input[name=\'filter_tc002\']').val();
	if (filter_tc002) {
		url = '<?php echo base_url() ?>index.php/cop/copi06/filter1/tc002/asc/' + encodeURIComponent(filter_tc002);
	} 
	
	var filter_tc003 = $('input[name=\'filter_tc003\']').val();
	if (filter_tc003) {
		url = '<?php echo base_url() ?>index.php/cop/copi06/filter1/tc003/asc/' + encodeURIComponent(filter_tc003);
	}
	
	var filter_tc004 = $('input[name=\'filter_tc004\']').val();
	if (filter_tc004) {
		url = '<?php echo base_url() ?>index.php/cop/copi06/filter1/tc004/asc/' + encodeURIComponent(filter_tc004);
	}
		
	var filter_ma002 = $('input[name=\'filter_ma002\']').val();
	if (filter_ma002) {
		url = '<?php echo base_url() ?>index.php/cop/copi06/filter1/b.ma002/asc/' + encodeURIComponent(filter_ma002);
		
	}
	
	var filter_tc029 = $('input[name=\'filter_tc029\']').val();
	if (filter_tc029) {
		url = '<?php echo base_url() ?>index.php/cop/copi06/filter1/tc029/asc/' + encodeURIComponent(filter_tc029); 
	}
	var filter_tc030 = $('input[name=\'filter_tc030\']').val();
	if (filter_tc030) {
		url = '<?php echo base_url() ?>index.php/cop/copi06/filter1/tc030/asc/' + encodeURIComponent(filter_tc030); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/cop/copi06/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_tc001  && !filter_tc002 && !filter_tc003 && !filter_tc004 && !filter_ma002 && !filter_tc029 && !filter_tc030 && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/cop/copi06/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 