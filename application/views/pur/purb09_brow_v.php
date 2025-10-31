<div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 進貨單取消作廢作業 - 瀏覽　　　</h1>
      <!--  <div class="buttons"> -->
	   <div style="float:left; "> 
	     <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/purb09/clear_sql_term'"  style="float:left" accesskey="a" class="button"><span>重整 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	<!--  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/purb09/addform'" class="button"><span>新增&nbsp</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/purb09/copyform'" class="button"><span>複製&nbsp</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?> -->
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/purb09/findform'"  style="float:left"  accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('#form').submit();"  style="float:left"  accesskey="y" class="button"><span>選取確認 Y </span><img src="<?php echo base_url()?>assets/image/png/ok.png" /></a>
      <?PHP } ?>
	<!--   <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
     
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/purb09/printdetail'"   class="button"><span>列印&nbsp</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/purb09/printdetailc'"   class="button"><span>印進貨單據&nbsp</span><img src="<?php echo base_url()?>assets/image/png/print1.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/purb09/exceldetail'"  class="button"><span>轉EXCEL檔&nbsp</span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?> -->
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/pur/purb09/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/purb09/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/103'"  style="float:left"  accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a> 
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/pur/purb09/delete1" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="3%" class="left">
		  <?php echo anchor("pur/purb09/display/tg001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?>
           		  
	      </td>
	      <td width="3%" class="left">
	          <?php echo anchor("pur/purb09/display/tg001/" . (($sort_order == 'asc' && $sort_by == 'tg001') ? 'desc' : 'asc') ,'進貨單別'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left"> 
		  <?php echo anchor("pur/purb09/display/tg002/" . (($sort_order == 'asc' && $sort_by == 'tg002') ? 'desc' : 'asc') ,'進貨單號'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="3%" class="left"> 
		  <?php echo anchor("pur/purb09/display/tg003/" . (($sort_order == 'asc' && $sort_by == 'tg003') ? 'desc' : 'asc') ,'進貨日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
	      <td width="5%" class="left">
	          <?php echo anchor("pur/purb09/display/tg005/" .(($sort_order == 'asc' && $sort_by == 'tg005') ? 'desc' : 'asc') ,'廠商代號'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	  <!--    <td width="5%" class="left">
		  <?php echo anchor("pur/purb09/display/tg007/".(($sort_order == 'asc' && $sort_by == 'tg007') ? 'desc' : 'asc') ,'幣別'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("pur/purb09/display/tg008/" . (($sort_order == 'asc' && $sort_by == 'tg008') ? 'desc' : 'asc') ,'匯率'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td> -->
		  
		  <td width="3%" class="left">
		  <?php echo anchor("pur/purb09/display/tg021/" . (($sort_order == 'asc' && $sort_by == 'tg021') ? 'desc' : 'asc') ,'廠商名稱'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		  <td width="3%" class="left">
		  <?php echo anchor("pur/purb09/display/tg010/" . (($sort_order == 'asc' && $sort_by == 'tg010') ? 'desc' : 'asc') ,'課稅別'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		  <td width="3%" class="left">
		  <?php echo anchor("pur/purb09/display/tg013/" . (($sort_order == 'asc' && $sort_by == 'tg013') ? 'desc' : 'asc') ,'確認碼'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		   
	      <td width="5%" class="center">
		  <?php echo anchor("pur/purb09/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">取消管理</td>
		  <td width="7%" class="center">作廢管理</td>
         <!--      <td width="12%" class="center">&nbsp修改管理&nbsp </td>
		      <td width="12%" class="center">&nbsp印進貨單據&nbsp </td> -->
            </tr>
          </thead>
		  
        <!--  <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_tg001='';$filter_tg002='';$filter_tg003='';$filter_tg005='';$filter_tg007='';$filter_tg008='';$filter_tg021='';$filter_tg010='';$filter_tg013='';$filter_create=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	      <td class="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
			  
          <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text" id="filter_tg001" name="filter_tg001" size="6" value=""   />
		   </div>	
	      </td>
			  
	      <td width="5%" class="left">
		   <div  class="button-search"></div>
		   <input type="text" id="filter_tg002" name="filter_tg002" size="10" value=""  />
		   </div>	
		  </td>
			  
	      <td width="5%" class="left">
		    <div class="button-search"></div>
			<input type="text" name="filter_tg003" size="10" value="" />
		    </div>			  
	      </td>
			  
	      <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text" name="filter_tg005" size="10" value="" />
		  </td>
      <!--    <td  width="5%" align="left">
		  <div class="button-search"></div>
		   <input type="text" name="filter_tg007" size="10" value=""  />
		  </td>
	      
		  <td  width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_tg008" size="10" value="" />
		  </td> -->
		  
		   <td  width="3%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_tg021" size="8" value="" />
		  </td>
		   <td  width="3%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_tg010" size="8" value="" />
		  </td>
		  
		  <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_tg013" size="6"  value="" />
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
	    <?php $chkval=1;$vtg013=''; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->tg001."/".trim($row->tg002)."/".trim($row->tg003)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>
		  <td class="left"><?php echo  $row->tg001;?></td>			  
		  <td class="left"><?php echo  $row->tg002;?></td>
		  <td class="left"><?php echo  $row->tg003;?></td>
		  <td class="left"><?php echo  $row->tg005;?></td>
		<!--  <td class="left"><?php echo  $row->tg007;?></td>
		  <td class="left"><?php echo  $row->tg008;?></td> -->
		  <td class="left"><?php echo  $row->tg021;?></td>
		  <td class="left"><?php echo  $row->tg010;?></td>
		    <?php  if ($row->tg013=='Y') {$vtg013='Y:核准';} ?>
		  <?php  if ($row->tg013=='N') {$vtg013='N:未核';} ?>
		  <?php  if ($row->tg013=='V') {$vtg013='V:作廢';} ?>
		  <td class="left"><?php echo  $vtg013;?></td>
		 
		  <td class="center"><?php echo  substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>		                 			
		
	 <!--	  <td class="center"><a href="<?php echo site_url('pur/purb09/see/'.$row->tg001.'/'.$row->tg002) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
		  <td class="center"><a href="<?php echo site_url('pur/purb09/updform/'.$row->tg001.'/'.$row->tg002)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
		  <?PHP } ?>
	      <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
		  <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pur/purb09/printbb/'.$row->tg001."/".trim($row->tg002))?>" id="print1"  >[ 印單據 </a><img src="<?php echo base_url()?>assets/image/png/Print1.png" />]</td>
	      <?PHP } ?>  -->
	       <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pur/purb09/del1/'.$row->tg001."/".trim($row->tg002))?>" id="delete1"  >[ 取消確認 ]</a></td>   
		     <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pur/purb09/del2/'.$row->tg001."/".trim($row->tg002))?>" id="delete2"  >[ 單據作廢 ]</a></td>   
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
   // window.open('/index.php/pur/purb09/printdetail')
	window.location="<?php echo base_url()?>index.php/pur/purb09/printdetail";
  }
  function open_winprint1()
  {
 //   window.open('/index.php/pur/purb09/printdetailc')
	window.location="<?php echo base_url()?>index.php/pur/purb09/printdetailc";
  }

function open_winexcel()
  {
  //  window.open('/index.php/pur/purb09/exceldetail')
	window.location="<?php echo base_url()?>index.php/pur/purb09/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
		
	var filter_tg001 = $('input[name=\'filter_tg001\']').val();
	if (filter_tg001) {
		url = '<?php echo base_url() ?>index.php/pur/purb09/filter1/tg001/desc/' + encodeURIComponent(filter_tg001);
	} 
	
	var filter_tg002 = $('input[name=\'filter_tg002\']').val();
	if (filter_tg002) {
		url = '<?php echo base_url() ?>index.php/pur/purb09/filter1/tg002/desc/' + encodeURIComponent(filter_tg002);
	} 
	
	var filter_tg003 = $('input[name=\'filter_tg003\']').val();
	if (filter_tg003) {
		url = '<?php echo base_url() ?>index.php/pur/purb09/filter1/tg003/desc/' + encodeURIComponent(filter_tg003);
	}
	
	var filter_tg005 = $('input[name=\'filter_tg005\']').val();
	if (filter_tg005) {
		url = '<?php echo base_url() ?>index.php/pur/purb09/filter1/tg005/desc/' + encodeURIComponent(filter_tg005);
	}
		
	/* var filter_tg007 = $('input[name=\'filter_tg007\']').val();
	if (filter_tg007) {
		url = '<?php echo base_url() ?>index.php/pur/purb09/filter1/tg007/desc/' + encodeURIComponent(filter_tg007); 
	}
	
	var filter_tg008 = $('input[name=\'filter_tg008\']').val();
	if (filter_tg008) {
		url = '<?php echo base_url() ?>index.php/pur/purb09/filter1/tg008/desc/' + encodeURIComponent(filter_tg008); 
	} */
		var filter_tg021 = $('input[name=\'filter_tg021\']').val();
	if (filter_tg021) {
		url = '<?php echo base_url() ?>index.php/pur/purb09/filter1/tg021/desc/' + encodeURIComponent(filter_tg021); 
	}
		var filter_tg010 = $('input[name=\'filter_tg010\']').val();
	if (filter_tg010) {
		url = '<?php echo base_url() ?>index.php/pur/purb09/filter1/tg010/desc/' + encodeURIComponent(filter_tg010); 
	}
		var filter_tg013 = $('input[name=\'filter_tg013\']').val();
	if (filter_tg013) {
		url = '<?php echo base_url() ?>index.php/pur/purb09/filter1/tg013/desc/' + encodeURIComponent(filter_tg013); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/pur/purb09/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if ( !filter_tg001  && !filter_tg002 && !filter_tg003 && !filter_tg005   && !filter_tg021  && !filter_tg010  && !filter_tg013 && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/pur/purb09/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_tg001 = $('input[name=\'filter_tg001\']').val();
	if (filter_tg001) {
		url = '<?php echo base_url() ?>index.php/pur/purb09/filter1/tg001/asc/' + encodeURIComponent(filter_tg001);
	} 
		
	var filter_tg002 = $('input[name=\'filter_tg002\']').val();
	if (filter_tg002) {
		url = '<?php echo base_url() ?>index.php/pur/purb09/filter1/tg002/asc/' + encodeURIComponent(filter_tg002);
	} 
	
	var filter_tg003 = $('input[name=\'filter_tg003\']').val();
	if (filter_tg003) {
		url = '<?php echo base_url() ?>index.php/pur/purb09/filter1/tg003/asc/' + encodeURIComponent(filter_tg003);
	}
	
	var filter_tg005 = $('input[name=\'filter_tg005\']').val();
	if (filter_tg005) {
		url = '<?php echo base_url() ?>index.php/pur/purb09/filter1/tg005/asc/' + encodeURIComponent(filter_tg005);
	}
		
/*	var filter_tg007 = $('input[name=\'filter_tg007\']').val();
	if (filter_tg007) {
		url = '<?php echo base_url() ?>index.php/pur/purb09/filter1/tg007/asc/' + encodeURIComponent(filter_tg007);
		
	}
	
	var filter_tg008 = $('input[name=\'filter_tg008\']').val();
	if (filter_tg008) {
		url = '<?php echo base_url() ?>index.php/pur/purb09/filter1/tg008/asc/' + encodeURIComponent(filter_tg008); 
	} */
	var filter_tg021 = $('input[name=\'filter_tg021\']').val();
	if (filter_tg021) {
		url = '<?php echo base_url() ?>index.php/pur/purb09/filter1/tg021/asc/' + encodeURIComponent(filter_tg021); 
	}
	var filter_tg010 = $('input[name=\'filter_tg010\']').val();
	if (filter_tg010) {
		url = '<?php echo base_url() ?>index.php/pur/purb09/filter1/tg010/asc/' + encodeURIComponent(filter_tg010); 
	}
	var filter_tg013 = $('input[name=\'filter_tg013\']').val();
	if (filter_tg013) {
		url = '<?php echo base_url() ?>index.php/pur/purb09/filter1/tg013/asc/' + encodeURIComponent(filter_tg013); 
	}
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/pur/purb09/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_tg001  && !filter_tg002 && !filter_tg003 && !filter_tg005  && !filter_tg021 && !filter_tg010 && !filter_tg013 && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/pur/purb09/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 