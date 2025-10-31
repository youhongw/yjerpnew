<div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 退貨單資料建立作業 - 瀏覽</h1>
      <!--  <div class="buttons"> -->
	   <div style="float:right; "> 
	     <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/puri11/clear_sql_term'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/puri11/addform'"  style="float:left" accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/puri11/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/puri11/findform'"  style="float:left" accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>選取刪除</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
      <!-- <a onclick="$('form').submitb();"   class="button">印退貨單</a>   -->
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/puri11/printdetail'"    style="float:left" accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/puri11/printdetailc'"    style="float:left" accesskey="o" class="button"><span>印退貨單 o </span><img src="<?php echo base_url()?>assets/image/png/print1.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/puri11/exceldetail'"   style="float:left" accesskey="l" class="button"><span>轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/pur/puri11/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/puri11/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/103'"  style="float:left" accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a> 
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/pur/puri11/delete" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("pur/puri11/display/ti001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?>
           		  
	      </td>
	      <td width="10px" class="left">
	          <?php echo anchor("pur/puri11/display/ti001/" . (($sort_order == 'asc' && $sort_by == 'ti001') ? 'desc' : 'asc') ,'退貨單別'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("pur/puri11/display/ti002/" . (($sort_order == 'asc' && $sort_by == 'ti002') ? 'desc' : 'asc') ,'退貨單號'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("pur/puri11/display/ti003/" . (($sort_order == 'asc' && $sort_by == 'ti003') ? 'desc' : 'asc') ,'單據日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
	      <td width="5%" class="left">
	          <?php echo anchor("pur/puri11/display/ti004/" .(($sort_order == 'asc' && $sort_by == 'ti004') ? 'desc' : 'asc') ,'供應廠商'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("pur/puri11/display/b.ma002/".(($sort_order == 'asc' && $sort_by == 'b.ma002') ? 'desc' : 'asc') ,'廠商名稱'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("pur/puri11/display/ti011/" . (($sort_order == 'asc' && $sort_by == 'ti011') ? 'desc' : 'asc') ,'退貨金額'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		  <td width="5%" class="left">
		  <?php echo anchor("pur/puri11/display/ti007/" . (($sort_order == 'asc' && $sort_by == 'ti007') ? 'desc' : 'asc') ,'稅額'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		  <?php echo anchor("pur/puri11/display/ti020/" . (($sort_order == 'asc' && $sort_by == 'ti020') ? 'desc' : 'asc') ,'已結帳'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="12%" class="center">&nbsp查看管理&nbsp </td>
             <td width="12%" class="center">&nbsp修改管理&nbsp </td>
		      <td width="12%" class="center">&nbsp印退貨單&nbsp </td>
            </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_ti001='';$filter_ti002='';$filter_ti003='';$filter_ti005='';$filter_ti021='';$filter_ti031='';$filter_ti019='';$filter_ti020=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	      <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
          <td width="10px" align="left">
		   <div class="button-search"></div>
		   <input type="text" id="filter_ti001" name="filter_ti001"  value="" size="12" />
		   </div>	
	      </td>
			  
	      <td width="5%" class="left">
		   <div  class="button-search"></div>
		   <input type="text" id="filter_ti002" name="filter_ti002"  value="" size="12" />
		   </div>	
		  </td>
			  
	      <td width="5%" class="left">
		    <div class="button-search"></div>
			<input type="text" name="filter_ti003" size="16" value="" size="12" />
		    </div>			  
	      </td>
			  
	      <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text" name="filter_ti004" size="12" value="" />
		  </td>
          <td  width="5%" align="left">
		  <div class="button-search"></div>
		   <input type="text" name="filter_ti004disp" size="12" value=""  />
		  </td>
	      
		  <td  width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_ti011" size="12" value="" />
		  </td>
		  
		  <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_ti015" size="8" value="" />
		  </td>
		  
	      <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_ti020" size="12" value="" />
		  </td>
	      <td width="10%" align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td width="10%" align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
		  <td width="10%" align="center"></td> 
        </tr>
			
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->ti001."/".trim($row->ti002)."/".trim($row->ti020)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>
		  <td class="left"><?php echo  $row->ti001;?></td>			  
		  <td class="left"><?php echo  $row->ti002;?></td>
		  <td class="left"><?php echo  substr($row->ti003,0,4).'/'.substr($row->ti003,4,2).'/'.substr($row->ti003,6,2);?></td>
		  <td class="left"><?php echo  $row->ti004;?></td>
		  <td class="left"><?php echo  $row->ti004disp;?></td>
		  <td class="left"><?php echo  $row->ti011;?></td>
		  <td class="left"><?php echo  $row->ti015;?></td>
		  <td class="center"><?php echo  $row->ti020;?></td>		                 			
		
		  <td class="center"><a href="<?php echo site_url('pur/puri11/see/'.$row->ti001.'/'.$row->ti002) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
		  <td class="center"><a href="<?php echo site_url('pur/puri11/updform/'.$row->ti001.'/'.$row->ti002)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
		  <?PHP } ?>
	      <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
		  <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pur/puri11/printbb/'.$row->ti001."/".trim($row->ti002))?>" id="print1"  >[ 印單據 </a><img src="<?php echo base_url()?>assets/image/png/Print1.png" />]</td>
	      <?PHP } ?>
	      <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pur/puri11/del/'.$row->ti001."/".trim($row->ti002))?>" id="delete1"  >[ 刪除 ]</a></td>   -->
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

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
   // window.open('/index.php/pur/puri11/printdetail')
	window.location="<?php echo base_url()?>index.php/pur/puri11/printdetail";
  }
  function open_winprint1()
  {
 //   window.open('/index.php/pur/puri11/printdetailc')
	window.location="<?php echo base_url()?>index.php/pur/puri11/printdetailc";
  }

function open_winexcel()
  {
  //  window.open('/index.php/pur/puri11/exceldetail')
	window.location="<?php echo base_url()?>index.php/pur/puri11/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
		
	var filter_ti001 = $('input[name=\'filter_ti001\']').val();
	if (filter_ti001) {
		url = '<?php echo base_url() ?>index.php/pur/puri11/filter1/ti001/desc/' + encodeURIComponent(filter_ti001);
	} 
	
	var filter_ti002 = $('input[name=\'filter_ti002\']').val();
	if (filter_ti002) {
		url = '<?php echo base_url() ?>index.php/pur/puri11/filter1/ti002/desc/' + encodeURIComponent(filter_ti002);
	} 
	
	var filter_ti003 = $('input[name=\'filter_ti003\']').val();
	if (filter_ti003) {
		url = '<?php echo base_url() ?>index.php/pur/puri11/filter1/ti003/desc/' + encodeURIComponent(filter_ti003);
	}
	
	var filter_ti004 = $('input[name=\'filter_ti004\']').val();
	if (filter_ti004) {
		url = '<?php echo base_url() ?>index.php/pur/puri11/filter1/ti004/desc/' + encodeURIComponent(filter_ti004);
	}
		
	var filter_ti004disp = $('input[name=\'filter_ti004disp\']').val();
	if (filter_ti004disp) {
		url = '<?php echo base_url() ?>index.php/pur/puri11/filter1/b.ma002/desc/' + encodeURIComponent(filter_ti004disp); 
	}
	
	var filter_ti011 = $('input[name=\'filter_ti011\']').val();
	if (filter_ti011) {
		url = '<?php echo base_url() ?>index.php/pur/puri11/filter1/ti011/desc/' + encodeURIComponent(filter_ti011); 
	}
		var filter_ti015 = $('input[name=\'filter_ti015\']').val();
	if (filter_ti015) {
		url = '<?php echo base_url() ?>index.php/pur/puri11/filter1/ti015/desc/' + encodeURIComponent(filter_ti015); 
	}
	
	var filter_ti020 = $('input[name=\'filter_ti020\']').val();
	if (filter_ti020) {
		url = '<?php echo base_url() ?>index.php/pur/puri11/filter1/ti020/desc/' + encodeURIComponent(filter_ti020); 
	}
	
    if ( !filter_ti001  && !filter_ti002 && !filter_ti003 && !filter_ti004 && !filter_ti004disp && !filter_ti011  && !filter_ti015 && !filter_ti020) {         
	   url = '<?php echo base_url() ?>index.php/pur/puri11/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_ti001 = $('input[name=\'filter_ti001\']').val();
	if (filter_ti001) {
		url = '<?php echo base_url() ?>index.php/pur/puri11/filter1/ti001/asc/' + encodeURIComponent(filter_ti001);
	} 
		
	var filter_ti002 = $('input[name=\'filter_ti002\']').val();
	if (filter_ti002) {
		url = '<?php echo base_url() ?>index.php/pur/puri11/filter1/ti002/asc/' + encodeURIComponent(filter_ti002);
	} 
	
	var filter_ti003 = $('input[name=\'filter_ti003\']').val();
	if (filter_ti003) {
		url = '<?php echo base_url() ?>index.php/pur/puri11/filter1/ti003/asc/' + encodeURIComponent(filter_ti003);
	}
	
	var filter_ti004 = $('input[name=\'filter_ti004\']').val();
	if (filter_ti004) {
		url = '<?php echo base_url() ?>index.php/pur/puri11/filter1/ti004/asc/' + encodeURIComponent(filter_ti004);
	}
		
	var filter_ti004disp = $('input[name=\'filter_ti004disp\']').val();
	if (filter_ti004disp) {
		url = '<?php echo base_url() ?>index.php/pur/puri11/filter1/b.ma002/asc/' + encodeURIComponent(filter_ti004disp);
		
	}
	
	var filter_ti011 = $('input[name=\'filter_ti011\']').val();
	if (filter_ti011) {
		url = '<?php echo base_url() ?>index.php/pur/puri11/filter1/ti011/asc/' + encodeURIComponent(filter_ti011); 
	}
	var filter_ti015 = $('input[name=\'filter_ti015\']').val();
	if (filter_ti015) {
		url = '<?php echo base_url() ?>index.php/pur/puri11/filter1/ti015/asc/' + encodeURIComponent(filter_ti015); 
	}
	
	var filter_ti020 = $('input[name=\'filter_ti020\']').val();
	if (filter_ti020) {
		url = '<?php echo base_url() ?>index.php/pur/puri11/filter1/ti020/asc/' + encodeURIComponent(filter_ti020); 
	}
	  if ( !filter_ti001  && !filter_ti002 && !filter_ti003 && !filter_ti004 && !filter_ti004disp && !filter_ti011  && !filter_ti015 && !filter_ti020) {         
	   url = '<?php echo base_url() ?>index.php/pur/puri11/display';location = url;  
	   }
	   
	location = url;
}
</script> 