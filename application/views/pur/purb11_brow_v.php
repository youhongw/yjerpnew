<div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 退貨單取消作廢作業 - 瀏覽　　　</h1>
      <!--  <div class="buttons"> -->
	   <div style="float:left; "> 
	    <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/purb11/clear_sql_term'"  style="float:left" accesskey="a" class="button"><span>重整 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	<!--  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/purb11/addform'" class="button"><span>新增&nbsp</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/purb11/copyform'" class="button"><span>複製&nbsp</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?> -->
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/purb11/findform'"  style="float:left"  accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('#form').submit();"  style="float:left"  accesskey="y" class="button"><span>選取確認 Y </span><img src="<?php echo base_url()?>assets/image/png/ok.png" /></a>
      <?PHP } ?>
	<!--   <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
     
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/purb11/printdetail'"   class="button"><span>列印&nbsp</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/purb11/printdetailc'"   class="button"><span>印退貨單據&nbsp</span><img src="<?php echo base_url()?>assets/image/png/print1.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/purb11/exceldetail'"  class="button"><span>轉EXCEL檔&nbsp</span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?> -->
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/pur/purb11/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/purb11/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/103'"  style="float:left"  accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a> 
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/pur/purb11/delete1" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="3%" class="left">
		  <?php echo anchor("pur/purb11/display/ti001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?>
           		  
	      </td>
	      <td width="3%" class="left">
	          <?php echo anchor("pur/purb11/display/ti001/" . (($sort_order == 'asc' && $sort_by == 'ti001') ? 'desc' : 'asc') ,'退貨單別'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left"> 
		  <?php echo anchor("pur/purb11/display/ti002/" . (($sort_order == 'asc' && $sort_by == 'ti002') ? 'desc' : 'asc') ,'退貨單號'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="3%" class="left"> 
		  <?php echo anchor("pur/purb11/display/ti003/" . (($sort_order == 'asc' && $sort_by == 'ti003') ? 'desc' : 'asc') ,'退貨日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
	      <td width="5%" class="left">
	          <?php echo anchor("pur/purb11/display/ti004/" .(($sort_order == 'asc' && $sort_by == 'ti004') ? 'desc' : 'asc') ,'廠商代號'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("pur/purb11/display/ti006/".(($sort_order == 'asc' && $sort_by == 'ti006') ? 'desc' : 'asc') ,'幣別'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	   <!--   <td width="5%" class="left">
		  <?php echo anchor("pur/purb11/display/ti007/" . (($sort_order == 'asc' && $sort_by == 'ti007') ? 'desc' : 'asc') ,'匯率'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td> -->
		  
		  <td width="3%" class="left">
		  <?php echo anchor("pur/purb11/display/ti016/" . (($sort_order == 'asc' && $sort_by == 'ti016') ? 'desc' : 'asc') ,'廠商名稱'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		  <td width="3%" class="left">
		  <?php echo anchor("pur/purb11/display/ti009/" . (($sort_order == 'asc' && $sort_by == 'ti009') ? 'desc' : 'asc') ,'課稅別'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		  <td width="3%" class="left">
		  <?php echo anchor("pur/purb11/display/ti013/" . (($sort_order == 'asc' && $sort_by == 'ti013') ? 'desc' : 'asc') ,'確認碼'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		   
	      <td width="5%" class="center">
		  <?php echo anchor("pur/purb11/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">取消管理</td>
		  <td width="7%" class="center">作廢管理</td>
         <!--      <td width="12%" class="center">&nbsp修改管理&nbsp </td>
		      <td width="12%" class="center">&nbsp印退貨單據&nbsp </td> -->
            </tr>
          </thead>
		  
         <!-- <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_ti001='';$filter_ti002='';$filter_ti003='';$filter_ti005='';$filter_ti007='';$filter_ti008='';$filter_ti021='';$filter_ti010='';$filter_ti013='';$filter_create=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	      <td class="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
			  
          <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text" id="filter_ti001" name="filter_ti001" size="6" value=""   />
		  
	      </td>
			  
	      <td width="5%" class="left">
		   <div  class="button-search"></div>
		   <input type="text" id="filter_ti002" name="filter_ti002" size="10" value=""  />
		  
		  </td>
			  
	      <td width="5%" class="left">
		    <div class="button-search"></div>
			<input type="text" name="filter_ti003" size="10" value="" />
		   		  
	      </td>
			  
	      <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text" name="filter_ti004" size="10" value="" />
		  </td>
		  
          <td  width="5%" align="left">
		  <div class="button-search"></div>
		   <input type="text" name="filter_ti006" size="10" value=""  />
		  </td>
	      
		<!--  <td  width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_ti007" size="10" value="" />
		  </td> -->
		  
		   <td  width="3%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_ti016" size="8" value="" />
		  </td>
		  
		   <td  width="3%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_ti009" size="8" value="" />
		  </td>
		  
		  <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_ti013" size="6"  value="" />
		  </td>
		  
	    <!--  <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_create"value="" size="10"/>
		  </td>  -->
	      <td width="5%" align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td width="5%" align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
		   <td width="7%" align="center"></td>  
        </tr>
		<tbody> 	
	    <?php $chkval=1;$vti013=''; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->ti001."/".trim($row->ti002)."/".trim($row->ti003)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>
		  <td class="left"><?php echo  $row->ti001;?></td>			  
		  <td class="left"><?php echo  $row->ti002;?></td>
		  <td class="left"><?php echo  $row->ti003;?></td>
		  <td class="left"><?php echo  $row->ti004;?></td>
		  <td class="left"><?php echo  $row->ti006;?></td>
		<!--  <td class="left"><?php echo  $row->ti007;?></td> -->
		  <td class="left"><?php echo  $row->ti016;?></td>
		  <td class="left"><?php echo  $row->ti009;?></td>
		  <?php  if ($row->ti013=='Y') {$vti013='Y:核准';} ?>
		  <?php  if ($row->ti013=='N') {$vti013='N:未核';} ?>
		  <?php  if ($row->ti013=='V') {$vti013='V:作廢';} ?>
		  <td class="left"><?php echo  $vti013;?></td>
		 
		  <td class="center"><?php echo  substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>		                 			
		
	 <!--	  <td class="center"><a href="<?php echo site_url('pur/purb11/see/'.$row->ti001.'/'.$row->ti002) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
		  <td class="center"><a href="<?php echo site_url('pur/purb11/updform/'.$row->ti001.'/'.$row->ti002)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
		  <?PHP } ?>
	      <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
		  <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pur/purb11/printbb/'.$row->ti001."/".trim($row->ti002))?>" id="print1"  >[ 印單據 </a><img src="<?php echo base_url()?>assets/image/png/Print1.png" />]</td>
	      <?PHP } ?>  -->
	       <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pur/purb11/del1/'.$row->ti001."/".trim($row->ti002))?>" id="delete1"  >[ 取消確認 ]</a></td>   
		     <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pur/purb11/del2/'.$row->ti001."/".trim($row->ti002))?>" id="delete2"  >[ 單據作廢 ]</a></td>   
	    </tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
          </tbody>		 
        </table>
		     
	      <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		  <?php  $this->session->set_userdata('search1',"display/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
			  
			
				<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      </form>
    
    </div> <!-- div-2 -->
   </div>  <!-- div-1 -->
</div>	<!-- div-0 -->

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
   // window.open('/index.php/pur/purb11/printdetail')
	window.location="<?php echo base_url()?>index.php/pur/purb11/printdetail";
  }
  function open_winprint1()
  {
 //   window.open('/index.php/pur/purb11/printdetailc')
	window.location="<?php echo base_url()?>index.php/pur/purb11/printdetailc";
  }

function open_winexcel()
  {
  //  window.open('/index.php/pur/purb11/exceldetail')
	window.location="<?php echo base_url()?>index.php/pur/purb11/exceldetail";
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
		url = '<?php echo base_url() ?>index.php/pur/purb11/filter1/ti001/desc/' + encodeURIComponent(filter_ti001);
	} 
	
	var filter_ti002 = $('input[name=\'filter_ti002\']').val();
	if (filter_ti002) {
		url = '<?php echo base_url() ?>index.php/pur/purb11/filter1/ti002/desc/' + encodeURIComponent(filter_ti002);
	} 
	
	var filter_ti003 = $('input[name=\'filter_ti003\']').val();
	if (filter_ti003) {
		url = '<?php echo base_url() ?>index.php/pur/purb11/filter1/ti003/desc/' + encodeURIComponent(filter_ti003);
	}
	
	var filter_ti004 = $('input[name=\'filter_ti004\']').val();
	if (filter_ti004) {
		url = '<?php echo base_url() ?>index.php/pur/purb11/filter1/ti004/desc/' + encodeURIComponent(filter_ti004);
	}
		
	var filter_ti006 = $('input[name=\'filter_ti006\']').val();
	if (filter_ti006) {
		url = '<?php echo base_url() ?>index.php/pur/purb11/filter1/ti006/desc/' + encodeURIComponent(filter_ti006); 
	}
	
/*	var filter_ti007 = $('input[name=\'filter_ti007\']').val();
	if (filter_ti007) {
		url = '<?php echo base_url() ?>index.php/pur/purb11/filter1/ti007/desc/' + encodeURIComponent(filter_ti007); 
	} */
		var filter_ti016 = $('input[name=\'filter_ti016\']').val();
	if (filter_ti016) {
		url = '<?php echo base_url() ?>index.php/pur/purb11/filter1/ti016/desc/' + encodeURIComponent(filter_ti016); 
	}
		
		var filter_ti009 = $('input[name=\'filter_ti009\']').val();
	if (filter_ti009) {
		url = '<?php echo base_url() ?>index.php/pur/purb11/filter1/ti009/desc/' + encodeURIComponent(filter_ti009); 
	}
	
		var filter_ti013 = $('input[name=\'filter_ti013\']').val();
	if (filter_ti013) {
		url = '<?php echo base_url() ?>index.php/pur/purb11/filter1/ti013/desc/' + encodeURIComponent(filter_ti013); 
	}
	
	
	
    if ( !filter_ti001  && !filter_ti002 && !filter_ti003 && !filter_ti004 && !filter_ti006   && !filter_ti016  && !filter_ti009  && !filter_ti013 ) {         
	   url = '<?php echo base_url() ?>index.php/pur/purb11/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_ti001 = $('input[name=\'filter_ti001\']').val();
	if (filter_ti001) {
		url = '<?php echo base_url() ?>index.php/pur/purb11/filter1/ti001/asc/' + encodeURIComponent(filter_ti001);
	} 
		
	var filter_ti002 = $('input[name=\'filter_ti002\']').val();
	if (filter_ti002) {
		url = '<?php echo base_url() ?>index.php/pur/purb11/filter1/ti002/asc/' + encodeURIComponent(filter_ti002);
	} 
	
	var filter_ti003 = $('input[name=\'filter_ti003\']').val();
	if (filter_ti003) {
		url = '<?php echo base_url() ?>index.php/pur/purb11/filter1/ti003/asc/' + encodeURIComponent(filter_ti003);
	}
	
	var filter_ti004 = $('input[name=\'filter_ti004\']').val();
	if (filter_ti004) {
		url = '<?php echo base_url() ?>index.php/pur/purb11/filter1/ti004/asc/' + encodeURIComponent(filter_ti004);
	}
		
	var filter_ti006 = $('input[name=\'filter_ti006\']').val();
	if (filter_ti006) {
		url = '<?php echo base_url() ?>index.php/pur/purb11/filter1/ti006/asc/' + encodeURIComponent(filter_ti006);
		
	}
	
	/*var filter_ti007 = $('input[name=\'filter_ti007\']').val();
	if (filter_ti007) {
		url = '<?php echo base_url() ?>index.php/pur/purb11/filter1/ti007/asc/' + encodeURIComponent(filter_ti007); 
	} */
	var filter_ti016 = $('input[name=\'filter_ti016\']').val();
	if (filter_ti016) {
		url = '<?php echo base_url() ?>index.php/pur/purb11/filter1/ti021/asc/' + encodeURIComponent(filter_ti016); 
	}
	var filter_ti009 = $('input[name=\'filter_ti009\']').val();
	if (filter_ti009) {
		url = '<?php echo base_url() ?>index.php/pur/purb11/filter1/ti009/asc/' + encodeURIComponent(filter_ti009); 
	}
	var filter_ti013 = $('input[name=\'filter_ti013\']').val();
	if (filter_ti013) {
		url = '<?php echo base_url() ?>index.php/pur/purb11/filter1/ti013/asc/' + encodeURIComponent(filter_ti013); 
	}
	
	
    if (!filter_ti001  && !filter_ti002 && !filter_ti003 && !filter_ti004 && !filter_ti006  && !filter_ti016 && !filter_ti009 && !filter_ti013 ) {         
	   url = '<?php echo base_url() ?>index.php/pur/purb11/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 