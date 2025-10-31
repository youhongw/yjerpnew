
  <div class="box">
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 廠商基本資料建立作業</h1>
      <div class="buttons">
	 <a onclick="location = '<?=base_url()?>index.php/pur/puri01/addform'" class="button"><span>新增</span></a>
	 <a onclick="location = '<?=base_url()?>index.php/pur/puri01/copyform'" class="button"><span>複製</span></a>	
         <a onclick="location = '<?=base_url()?>index.php/pur/puri01/findform'" class="button"><span>進階查詢</span></a>	
         <a onclick="$('form').submit();" class="button"><span>選取刪除</span></a>
	 <a onclick="open_winprint();"   class="button">列印</a>  
	 <a onclick="open_winexcel();"   class="button">轉EXCEL檔</a>  
	 <!-- <a onclick="location = '<?=base_url()?>index.php/pur/puri01/printdetail'"  class="button"><span>列印</span></a>
	 <a onclick="location = '<?=base_url()?>index.php/pur/puri01/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	 <a onclick="location = '<?=base_url()?>index.php/main'" class="button"><span>關閉</span></a>
      </div>
    </div>
	
  <div class="content">
    <form action="<?=base_url()?>index.php/pur/puri01/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("pur/puri01/display/ma001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?>
           		  
	      </td>
	      <td width="5%" class="left">
	          <?php echo anchor("pur/puri01/display/ma001/" . (($sort_order == 'asc' && $sort_by == 'ma001') ? 'desc' : 'asc') ,'廠商代號'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("pur/puri01/display/ma002/" . (($sort_order == 'asc' && $sort_by == 'ma002') ? 'desc' : 'asc') ,'廠商簡稱'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="16%" class="left"> 
		  <?php echo anchor("pur/puri01/display/ma008/" . (($sort_order == 'asc' && $sort_by == 'ma008') ? 'desc' : 'asc') ,'TEL(一)'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
	      <td width="8%" class="left">
	          <?php echo anchor("pur/puri01/display/ma010/" .(($sort_order == 'asc' && $sort_by == 'ma010') ? 'desc' : 'asc') ,'傳真'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="8%" class="left">
		  <?php echo anchor("pur/puri01/display/ma011/" . (($sort_order == 'asc' && $sort_by == 'ma011') ? 'desc' : 'asc') ,'E-MAIL'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="8%" class="left">
		  <?php echo anchor("pur/puri01/display/ma013/" . (($sort_order == 'asc' && $sort_by == 'ma013') ? 'desc' : 'asc') ,'聯絡人(一)'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		  <?php echo anchor("pur/puri01/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="18%" class="center">&nbsp查看管理&nbsp </td>
              <td width="18%" class="center">&nbsp修改管理&nbsp </td>
            </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_ma001='';$filter_ma002='';$filter_ma008='';$filter_ma010='';$filter_ma011='';$filter_ma013='';$filter_create=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	      <td class="left"></td>
			  
              <td align="left">
		  <div id="search">
		   <div class="button-search"></div>
		      <input type="text" id="filter_ma001" name="filter_ma001" value="" />
		  </div>
	      </td>
			  
	      <td class="left">
		  <div  class="button-search"></div>
			<input type="text" id="filter_ma002" name="filter_ma002" value="" />
		  </td>
			  
	      <td class="left">
		  <div id="search">
		   <div class="button-search"></div>
			<input type="text" name="filter_ma008" value="" />
		  </div>			  
	      </td>
			  
	      <td align="left">
		  <div class="button-search"></div>
		       <input type="text" name="filter_ma010" value="" />
		  </td>
              <td align="left">
		  <div class="button-search"></div>
		       <input type="text" name="filter_ma011" value="" />
		  </td>
	      <td align="left">
		  <div class="button-search"></div>
		       <input type="text" name="filter_ma013" value="" />
		  </td>
	      <td align="left">
		  <div class="button-search"></div>
		       <input type="text" name="filter_create" value="" />
		  </td>
	      <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
            </tr>
			
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
            <tr>
              <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?=$row->ma001."/".trim($row->ma001)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left"><? echo $chkval;?></td>
          			  
		  <td class="left"><? echo $row->ma001;?></td>			  
		  <td class="left"><? echo $row->ma002;?></td>
		  <td class="left"><? echo $row->ma008;?></td>
		  <td class="left"><? echo $row->ma010;?></td>
		  <td class="left"><? echo $row->ma011;?></td>
		  <td class="left"><? echo $row->ma013;?></td>
		  <td class="center"><? echo $row->create_date;?></td>		                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pur/puri01/del/'.$row->ma001."/".trim($row->ma002))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><a href="<?php echo site_url('pur/puri01/see/'.$row->ma001) ?>">[ 查看 ]</a></td>
                  <td class="center"><a href="<?php echo site_url('pur/puri01/updform/'.$row->ma001)?>">[ 修改 ]</a></td>
	    </tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
          </tbody>		 
        </table>
		     
	          <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		       <?php  $this->session->set_userdata('search1',"display/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
			  
			<!--    <?php echo $this->session->userdata('find05');$find05; ?><?php echo $this->session->userdata('find07');$find07;  ?> -->
				<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      </form>
    
 </div>
 </div> 
</div>	

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
    window.open('/index.php/pur/puri01/printdetail')
  }

function open_winexcel()
  {
    window.open('/index.php/pur/puri01/exceldetail')
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
		
	var filter_ma001 = $('input[name=\'filter_ma001\']').attr('value');
	if (filter_ma001) {
		url = '<?=base_url() ?>index.php/pur/puri01/filter1/ma001/desc/' + encodeURIComponent(filter_ma001);
	} 
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').attr('value');
	if (filter_ma002) {
		url = '<?=base_url() ?>index.php/pur/puri01/filter1/ma002/desc/' + encodeURIComponent(filter_ma002);
	} 
	
	var filter_ma008 = $('input[name=\'filter_ma008\']').attr('value');
	if (filter_ma008) {
		url = '<?=base_url() ?>index.php/pur/puri01/filter1/ma008/desc/' + encodeURIComponent(filter_ma008);
	}
	
	var filter_ma010 = $('input[name=\'filter_ma010\']').attr('value');
	if (filter_ma010) {
		url = '<?=base_url() ?>index.php/pur/puri01/filter1/ma010/desc/' + encodeURIComponent(filter_ma010);
	}
		
	var filter_ma011 = $('input[name=\'filter_ma011\']').attr('value');
	if (filter_ma011) {
		url = '<?=base_url() ?>index.php/pur/puri01/filter1/ma011/desc/' + encodeURIComponent(filter_ma011); 
	}
	
	var filter_ma013 = $('input[name=\'filter_ma013\']').attr('value');
	if (filter_ma013) {
		url = '<?=base_url() ?>index.php/pur/puri01/filter1/ma013/desc/' + encodeURIComponent(filter_ma013); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = '<?=base_url() ?>index.php/pur/puri01/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if ( !filter_ma001  && !filter_ma002 && !filter_ma008 && !filter_ma010 && !filter_ma011 && !filter_ma013 && !filter_create) {         
	   url = '<?=base_url() ?>index.php/pur/puri01/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_ma001 = $('input[name=\'filter_ma001\']').attr('value');
	if (filter_ma001) {
		url = '<?=base_url() ?>index.php/pur/puri01/filter1/ma001/asc/' + encodeURIComponent(filter_ma001);
	} 
		
	var filter_ma002 = $('input[name=\'filter_ma002\']').attr('value');
	if (filter_ma002) {
		url = '<?=base_url() ?>index.php/pur/puri01/filter1/ma002/asc/' + encodeURIComponent(filter_ma002);
	} 
	
	var filter_ma008 = $('input[name=\'filter_ma008\']').attr('value');
	if (filter_ma008) {
		url = '<?=base_url() ?>index.php/pur/puri01/filter1/ma008/asc/' + encodeURIComponent(filter_ma008);
	}
	
	var filter_ma010 = $('input[name=\'filter_ma010\']').attr('value');
	if (filter_ma010) {
		url = '<?=base_url() ?>index.php/pur/puri01/filter1/ma010/asc/' + encodeURIComponent(filter_ma010);
	}
		
	var filter_ma011 = $('input[name=\'filter_ma011\']').attr('value');
	if (filter_ma011) {
		url = '<?=base_url() ?>index.php/pur/puri01/filter1/ma011/asc/' + encodeURIComponent(filter_ma011); 
	}
	
	var filter_ma013 = $('input[name=\'filter_ma013\']').attr('value');
	if (filter_ma013) {
		url = '<?=base_url() ?>index.php/pur/puri01/filter1/ma013/asc/' + encodeURIComponent(filter_ma013); 
	}
	
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = '<?=base_url() ?>index.php/pur/puri01/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_ma001  && !filter_ma002 && !filter_ma008 && !filter_ma010 && !filter_ma011 && !filter_ma013 && !filter_create) {         
	   url = '<?=base_url() ?>index.php/pur/puri01/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 
 
    </div>
