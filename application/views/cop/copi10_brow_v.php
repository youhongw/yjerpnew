<div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> pos客戶銷貨單建立作業 - 瀏覽　　　</h1>
      <!--  <div class="buttons"> -->
	   <div style="float:left; "> 
	   <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi10/clear_sql_term'"  style="float:left" accesskey="d" class="button"><span>重新整理 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi10/addform'"  style="float:left" accesskey="i" class="button"><span>新增 i </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi10/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi10/findform'"  style="float:left" accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();" style="float:left" accesskey="-" class="button"><span>刪除 - </span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
      <!-- <a onclick="$('form').submitb();"   class="button">印客戶銷貨單</a>   -->
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi10/printdetail'"   style="float:left"  accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi10/printdetailc'"   style="float:left"  accesskey="o" class="button"><span>印銷貨單 o </span><img src="<?php echo base_url()?>assets/image/png/print1.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi10/exceldetail'"  style="float:left"  accesskey="l" class="button"><span>EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/cop/copi10/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi10/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/104'"  style="float:left"  accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/cop/copi10/delete" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("cop/copi10/display/tg001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?>
           		  
	      </td>
	      <td width="10px" class="left">
	          <?php echo anchor("cop/copi10/display/tg001/" . (($sort_order == 'asc' && $sort_by == 'tg001') ? 'desc' : 'asc') ,'銷貨單別'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("cop/copi10/display/tg002/" . (($sort_order == 'asc' && $sort_by == 'tg002') ? 'desc' : 'asc') ,'銷貨單號'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("cop/copi10/display/tg042/" . (($sort_order == 'asc' && $sort_by == 'tg042') ? 'desc' : 'asc') ,'單據日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
	      <td width="5%" class="left">
	          <?php echo anchor("cop/copi10/display/tg004/" .(($sort_order == 'asc' && $sort_by == 'tg004') ? 'desc' : 'asc') ,'客戶代號'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("cop/copi10/display/b.ma002/".(($sort_order == 'asc' && $sort_by == 'b.ma002') ? 'desc' : 'asc') ,'客戶名稱'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("cop/copi10/display/tg013/" . (($sort_order == 'asc' && $sort_by == 'tg013') ? 'desc' : 'asc') ,'銷貨金額'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		  <td width="5%" class="left">
		  <?php echo anchor("cop/copi10/display/tg025/" . (($sort_order == 'asc' && $sort_by == 'tg025') ? 'desc' : 'asc') ,'稅額'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	     <!--  <td width="7%" class="center">
		  <?php echo anchor("cop/copi10/display/tg024/" . (($sort_order == 'asc' && $sort_by == 'tg024') ? 'desc' : 'asc') ,'已結帳'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td> -->
	      <td width="12%" class="center">&nbsp查看管理&nbsp </td>
             <td width="12%" class="center">&nbsp修改管理&nbsp </td>
		      <td width="12%" class="center">&nbsp印客戶銷貨單&nbsp </td>
            </tr>
          </thead>
		  
         <!-- <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_tg001='';$filter_tg002='';$filter_tg003='';$filter_tg005='';$filter_tg021='';$filter_tg031='';$filter_tg019='';$filter_tg024=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	      <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
          <td width="10px" align="left">
		   <div class="button-search"></div>
		   <input type="text" id="filter_tg001" name="filter_tg001"  value="" size="12" />
		   </div>	
	      </td>
			  
	      <td width="5%" class="left">
		   <div  class="button-search"></div>
		   <input type="text" id="filter_tg002" name="filter_tg002"  value="" size="12" />
		   
		  </td>
			  
	      <td width="5%" class="left">
		    <div class="button-search"></div>
			<input type="text" name="filter_tg042"  value="" size="12" />
		    </div>			  
	      </td>
			  
	      <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text" name="filter_tg004" size="10" value="" />
		  </td>
		  
          <td  width="5%" align="left">
		  <div class="button-search"></div>
		   <input type="text" name="filter_ma002" size="18" value="" />
		  </td>
	      
		  <td  width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_tg013" size="12" value="" />
		  </td>
		  
		  <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_tg025" size="8" value="" />
		  </td>
		  
	    <!--  <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_tg024" size="12" value="" />
		  </div>	
		  </td> -->
	      <td width="10%" align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td width="10%" align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
		  <td width="10%" align="center"></td> 
        </tr>
		<tbody>	
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->tg001."/".trim($row->tg002)."/".trim($row->tg024)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo $chkval;?></td>
		  <td class="left"><?php echo $row->tg001.' '.$row->tg024;?></td>			  
		  <td class="left"><?php echo $row->tg002;?></td>
		  <td class="left"><?php echo $row->tg042;?></td>
		  <td class="left"><?php echo $row->tg004;?></td>
		  <td class="left"><?php echo $row->ma002;?></td>
		  <td class="left"><?php echo $row->tg013;?></td>
		  <td class="left"><?php echo $row->tg025;?></td>
		<!--  <td class="left"><?php echo $row->tg024;?></td>	-->	                 			
		
		  <td class="center"><a href="<?php echo site_url('cop/copi10/see/'.$row->tg001.'/'.$row->tg002) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
		  <td class="center"><a href="<?php echo site_url('cop/copi10/updform/'.$row->tg001.'/'.$row->tg002)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
		  <?PHP } ?>
	      <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
		  <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('cop/copi10/printbb/'.$row->tg001."/".trim($row->tg002))?>" id="print1"  >[ 印單據 </a><img src="<?php echo base_url()?>assets/image/png/Print1.png" />]</td>
	      <?PHP } ?>
	      <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('cop/copi10/del/'.$row->tg001."/".trim($row->tg002))?>" id="delete1"  >[ 刪除 ]</a></td>   -->
	    </tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
          </tbody>		 
        </table>
		     
	      <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		  <?php  $this->session->set_userdata('search1',"display/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
			  
			 </form>
				<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$this->session->userdata('msg1').$message.'<span>'.'</span>'.
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      <?php  $this->session->unset_userdata('msg1'); ?>  
	
    
    </div> <!-- div-2 -->
   </div>  <!-- div-1 -->
</div>	<!-- div-0 -->

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
   // window.open('/index.php/cop/copi10/printdetail')
	window.location="<?php echo base_url()?>index.php/cop/copi10/printdetail";
  }
  function open_winprint1()
  {
 //   window.open('/index.php/cop/copi10/printdetailc')
	window.location="<?php echo base_url()?>index.php/cop/copi10/printdetailc";
  }

function open_winexcel()
  {
  //  window.open('/index.php/cop/copi10/exceldetail')
	window.location="<?php echo base_url()?>index.php/cop/copi10/exceldetail";
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
		url = '<?php echo base_url() ?>index.php/cop/copi10/filter1/a.tg001/desc/' + encodeURIComponent(filter_tg001);
	} 
	
	var filter_tg002 = $('input[name=\'filter_tg002\']').val();
	if (filter_tg002) {
		url = '<?php echo base_url() ?>index.php/cop/copi10/filter1/a.tg002/desc/' + encodeURIComponent(filter_tg002);
	} 
	
	var filter_tg042 = $('input[name=\'filter_tg042\']').val();
	if (filter_tg042) {
		url = '<?php echo base_url() ?>index.php/cop/copi10/filter1/a.tg042/desc/' + encodeURIComponent(filter_tg042);
	}
	
	var filter_tg004 = $('input[name=\'filter_tg004\']').val();
	if (filter_tg004) {
		url = '<?php echo base_url() ?>index.php/cop/copi10/filter1/a.tg004/desc/' + encodeURIComponent(filter_tg004);
	}
		
	var filter_ma002 = $('input[name=\'filter_ma002\']').val();
	if (filter_ma002) {
		url = '<?php echo base_url() ?>index.php/cop/copi10/filter1/b.ma002/desc/' + encodeURIComponent(filter_ma002); 
	}
	
	var filter_tg013 = $('input[name=\'filter_tg013\']').val();
	if (filter_tg013) {
		url = '<?php echo base_url() ?>index.php/cop/copi10/filter1/a.tg013/desc/' + encodeURIComponent(filter_tg013); 
	}
		var filter_tg025 = $('input[name=\'filter_tg025\']').val();
	if (filter_tg025) {
		url = '<?php echo base_url() ?>index.php/cop/copi10/filter1/a.tg025/desc/' + encodeURIComponent(filter_tg025); 
	}
	
	/*var filter_tg024 = $('input[name=\'filter_tg024\']').val();
	if (filter_tg024) {
		url = '<?php echo base_url() ?>index.php/cop/copi10/filter1/a.tg024/desc/' + encodeURIComponent(filter_tg024); 
	} */
	
    if ( !filter_tg001  && !filter_tg002 && !filter_tg042 && !filter_tg004 && !filter_ma002 && !filter_tg013  && !filter_tg025 ) {         
	   url = '<?php echo base_url() ?>index.php/cop/copi10/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_tg001 = $('input[name=\'filter_tg001\']').val();
	if (filter_tg001) {
		url = '<?php echo base_url() ?>index.php/cop/copi10/filter1/a.tg001/asc/' + encodeURIComponent(filter_tg001);
	} 
		
	var filter_tg002 = $('input[name=\'filter_tg002\']').val();
	if (filter_tg002) {
		url = '<?php echo base_url() ?>index.php/cop/copi10/filter1/a.tg002/asc/' + encodeURIComponent(filter_tg002);
	} 
	
	var filter_tg042 = $('input[name=\'filter_tg042\']').val();
	if (filter_tg042) {
		url = '<?php echo base_url() ?>index.php/cop/copi10/filter1/a.tg042/asc/' + encodeURIComponent(filter_tg042);
	}
	
	var filter_tg004 = $('input[name=\'filter_tg004\']').val();
	if (filter_tg004) {
		url = '<?php echo base_url() ?>index.php/cop/copi10/filter1/a.tg004/asc/' + encodeURIComponent(filter_tg004);
	}
	
	var filter_ma002= $('input[name=\'filter_ma002\']').val();
	if (filter_ma002) {
		url = '<?php echo base_url() ?>index.php/cop/copi10/filter1/b.ma002/asc/' + encodeURIComponent(filter_ma002);
		
	}
	var filter_tg013 = $('input[name=\'filter_tg013\']').val();
	if (filter_tg013) {
		url = '<?php echo base_url() ?>index.php/cop/copi10/filter1/a.tg013/asc/' + encodeURIComponent(filter_tg013);
		
	}
	
	var filter_tg025 = $('input[name=\'filter_tg025\']').val();
	if (filter_tg025) {
		url = '<?php echo base_url() ?>index.php/cop/copi10/filter1/a.tg025/asc/' + encodeURIComponent(filter_tg025); 
	}
	
	
	/* var filter_tg024 = $('input[name=\'filter_tg024\']').val();
	if (filter_tg024) {
		url = '<?php echo base_url() ?>index.php/cop/copi10/filter1/a.tg024/asc/' + encodeURIComponent(filter_tg024); 
	} */
	
    if (!filter_tg001  && !filter_tg002 && !filter_tg042 && !filter_tg004 && !filter_ma002 && !filter_tg013 && !filter_tg025 ) {         
	   url = '<?php echo base_url() ?>index.php/cop/copi10/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 