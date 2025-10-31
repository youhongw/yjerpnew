<div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 會計傳票建立作業 - 瀏覽</h1>
     <!--  <div class="buttons"> -->
	   <div style="float:right; "> 
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/act/acti10/addform'"  style="float:left" accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/act/acti10/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/act/acti10/findform'"  style="float:left" accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();" style="float:left"  accesskey="-" class="button"><span>選取刪除</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
      <!-- <a onclick="$('form').submitb();"   class="button">印收款單</a>   -->
	  <a onclick="location = '<?php echo base_url()?>index.php/act/acti10/printdetail'"   style="float:left"  accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/act/acti10/printdetailc'"  style="float:left"  accesskey="o"  class="button"><span>印傳票 o </span><img src="<?php echo base_url()?>assets/image/png/print1.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/act/acti10/exceldetail'"  style="float:left"  accesskey="l" class="button"><span>轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/act/acti10/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/act/acti10/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/109'"  style="float:left"  accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a> 
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/act/acti10/delete" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("act/acti10/display/ta001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?>
           		  
	      </td>
	      <td width="10px" class="left">
	          <?php echo anchor("act/acti10/display/ta001/" . (($sort_order == 'asc' && $sort_by == 'ta001') ? 'desc' : 'asc') ,'傳票單別'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("act/acti10/display/ta002/" . (($sort_order == 'asc' && $sort_by == 'ta002') ? 'desc' : 'asc') ,'傳票單號'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("act/acti10/display/ta003/" . (($sort_order == 'asc' && $sort_by == 'ta003') ? 'desc' : 'asc') ,'傳票日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
	      <td width="5%" class="left">
	          <?php echo anchor("act/acti10/display/ta004/" .(($sort_order == 'asc' && $sort_by == 'ta004') ? 'desc' : 'asc') ,'收支科目'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("act/acti10/display/ta004disp/".(($sort_order == 'asc' && $sort_by == 'ta004disp') ? 'desc' : 'asc') ,'科目名稱'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("act/acti10/display/ta007/" . (($sort_order == 'asc' && $sort_by == 'ta007') ? 'desc' : 'asc') ,'借方總額'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		  <td width="5%" class="left">
		  <?php echo anchor("act/acti10/display/ta008/" . (($sort_order == 'asc' && $sort_by == 'ta008') ? 'desc' : 'asc') ,'貸方總額'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		  <?php echo anchor("act/acti10/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="12%" class="center">&nbsp查看管理&nbsp </td>
             <td width="12%" class="center">&nbsp修改管理&nbsp </td>
		      <td width="12%" class="center">&nbsp列印傳票&nbsp </td>
            </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_ta001='';$filter_ta002='';$filter_ta003='';$filter_ta004='';$filter_ta004disp='';$filter_ta028='';$filter_ta029='';$filter_create=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	      <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
          <td width="10px" align="left">
		   <div class="button-search"></div>
		   <input type="text" id="filter_ta001" name="filter_ta001"  value="" size="12" />
		   </div>	
	      </td>
			  
	      <td width="5%" class="left">
		   <div  class="button-search"></div>
		   <input type="text" id="filter_ta002" name="filter_ta002"  value="" size="12" />
		   </div>	
		  </td>
			  
	      <td width="5%" class="left">
		    <div class="button-search"></div>
			<input type="text" name="filter_ta003" size="12" value=""  />
		    </div>			  
	      </td>
			  
	      <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text" name="filter_ta004" size="12" value="" />
		  </td>
          <td  width="5%" align="left">
		  <div class="button-search"></div>
		   <input type="text" readonly="value"  name="filter_ta004disp" size="12" value="" style="background-color:#EBEBE4;" />
		  </td>
	      
		  <td  width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_ta007" size="12" value="" />
		  </td>
		  
		  <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_ta008" size="12" value="" />
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
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php $row->ta001."/".trim($row->ta002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo $chkval;?></td>
		  <td class="left"><?php echo $row->ta001;?></td>			  
		  <td class="left"><?php echo $row->ta002;?></td>
		  <td class="left"><?php echo substr($row->ta003,0,4).'/'.substr($row->ta003,4,2).'/'.substr($row->ta003,6,2);?></td>
		  <td class="left"><?php echo $row->ta004;?></td>
		  <td class="left"><?php echo $row->ta004disp;?></td>
		  <td class="left"><?php echo $row->ta007;?></td>
		  <td class="left"><?php echo $row->ta008;?></td>
		  <td class="center"><?php echo substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>		                 			
		
		  <td class="center"><a href="<?php echo site_url('act/acti10/see/'.$row->ta001.'/'.$row->ta002) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
		  <td class="center"><a href="<?php echo site_url('act/acti10/updform/'.$row->ta001.'/'.$row->ta002)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
		  <?PHP } ?>
		  
	      <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
		  <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('act/acti10/printbb/'.$row->ta001."/".trim($row->ta002))?>" id="print1"  >[ 印單據 </a><img src="<?php echo base_url()?>assets/image/png/Print1.png" />]</td>
	      <?PHP } ?>
	      <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('act/acti10/del/'.$row->ta001."/".trim($row->ta002))?>" id="delete1"  >[ 刪除 ]</a></td>   -->
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

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
		
	var filter_ta001 = $('input[name=\'filter_ta001\']').val();
	if (filter_ta001) {
		url = '<?php base_url() ?>index.php/act/acti10/filter1/ta001/desc/' + encodeURIComponent(filter_ta001);
	} 
	
	var filter_ta002 = $('input[name=\'filter_ta002\']').val();
	if (filter_ta002) {
		url = '<?php base_url() ?>index.php/act/acti10/filter1/ta002/desc/' + encodeURIComponent(filter_ta002);
	} 
	
	var filter_ta003 = $('input[name=\'filter_ta003\']').val();
	if (filter_ta003) {
		url = '<?php base_url() ?>index.php/act/acti10/filter1/ta003/desc/' + encodeURIComponent(filter_ta003);
	}
	
	var filter_ta004 = $('input[name=\'filter_ta004\']').val();
	if (filter_ta004) {
		url = '<?php base_url() ?>index.php/act/acti10/filter1/ta004/desc/' + encodeURIComponent(filter_ta004);
	}
		
	var filter_ta004disp = $('input[name=\'filter_ta004disp\']').val();
	if (filter_ta004disp) {
		url = '<?php base_url() ?>index.php/act/acti10/filter1/ta004disp/desc/' + encodeURIComponent(filter_ta004disp); 
	}
	
	var filter_ta007 = $('input[name=\'filter_ta007\']').val();
	if (filter_ta007) {
		url = '<?php base_url() ?>index.php/act/acti10/filter1/ta007/desc/' + encodeURIComponent(filter_ta007); 
	}
		var filter_ta008 = $('input[name=\'filter_ta008\']').val();
	if (filter_ta008) {
		url = '<?php base_url() ?>index.php/act/acti10/filter1/ta008/desc/' + encodeURIComponent(filter_ta008); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php base_url() ?>index.php/act/acti10/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if ( !filter_ta001  && !filter_ta002 && !filter_ta003 && !filter_ta004 && !filter_ta004disp && !filter_ta007  && !filter_ta008 && !filter_create) {         
	   url = '<?php base_url() ?>index.php/act/acti10/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_ta001 = $('input[name=\'filter_ta001\']').val();
	if (filter_ta001) {
		url = '<?php base_url() ?>index.php/act/acti10/filter1/ta001/asc/' + encodeURIComponent(filter_ta001);
	} 
		
	var filter_ta002 = $('input[name=\'filter_ta002\']').val();
	if (filter_ta002) {
		url = '<?php base_url() ?>index.php/act/acti10/filter1/ta002/asc/' + encodeURIComponent(filter_ta002);
	} 
	
	var filter_ta003 = $('input[name=\'filter_ta003\']').val();
	if (filter_ta003) {
		url = '<?php base_url() ?>index.php/act/acti10/filter1/ta003/asc/' + encodeURIComponent(filter_ta003);
	}
	
	var filter_ta004 = $('input[name=\'filter_ta004\']').val();
	if (filter_ta004) {
		url = '<?php base_url() ?>index.php/act/acti10/filter1/ta004/asc/' + encodeURIComponent(filter_ta004);
	}
		
	var filter_ta004disp = $('input[name=\'filter_ta004disp\']').val();
	if (filter_ta004disp) {
		url = '<?php base_url() ?>index.php/act/acti10/filter1/ta004disp/asc/' + encodeURIComponent(filter_ta004disp);
		
	}
	
	var filter_ta007 = $('input[name=\'filter_ta007\']').val();
	if (filter_ta007) {
		url = '<?php base_url() ?>index.php/act/acti10/filter1/ta007/asc/' + encodeURIComponent(filter_ta007); 
	}
	var filter_ta008 = $('input[name=\'filter_ta008\']').val();
	if (filter_ta008) {
		url = '<?php base_url() ?>index.php/act/acti10/filter1/ta008/asc/' + encodeURIComponent(filter_ta008); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php base_url() ?>index.php/act/acti10/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_ta001  && !filter_ta002 && !filter_ta003 && !filter_ta004 && !filter_ta004disp && !filter_ta007 && !filter_ta008 && !filter_create) {         
	   url = '<?php base_url() ?>index.php/act/acti10/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 