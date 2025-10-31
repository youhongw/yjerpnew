
  <div class="box">
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 請購單資料建立作業</h1>
      <div class="buttons">
	 <a onclick="location = '<?=base_url()?>index.php/pur/puri05/addform'" class="button"><span>新增</span></a>
	 <a onclick="location = '<?=base_url()?>index.php/pur/puri05/copyform'" class="button"><span>複製</span></a>	
         <a onclick="location = '<?=base_url()?>index.php/pur/puri05/findform'" class="button"><span>進階查詢</span></a>	
         <a onclick="$('form').submit();" class="button"><span>選取刪除</span></a>
  <!--	 <a onclick="$('form').submitb();"   class="button">印請購單</a>   -->
	 <a onclick="open_winprint();"   class="button">列印</a>  
	 <a onclick="open_winexcel();"   class="button">轉EXCEL檔</a>  
	 <!-- <a onclick="location = '<?=base_url()?>index.php/pur/puri05/printdetail'"  class="button"><span>列印</span></a>
	 <a onclick="location = '<?=base_url()?>index.php/pur/puri05/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	 <a onclick="location = '<?=base_url()?>index.php/main'" class="button"><span>關閉</span></a>
      </div>
    </div>
	
  <div class="content">
    <form action="<?=base_url()?>index.php/pur/puri05/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("pur/puri05/display/ta001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?>
           		  
	      </td>
	      <td width="10px" class="left">
	          <?php echo anchor("pur/puri05/display/ta001/" . (($sort_order == 'asc' && $sort_by == 'ta001') ? 'desc' : 'asc') ,'請購單別'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("pur/puri05/display/ta002/" . (($sort_order == 'asc' && $sort_by == 'ta002') ? 'desc' : 'asc') ,'請購單號'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("pur/puri05/display/ta003/" . (($sort_order == 'asc' && $sort_by == 'ta003') ? 'desc' : 'asc') ,'請購日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
	      <td width="5%" class="left">
	          <?php echo anchor("pur/puri05/display/ta004/" .(($sort_order == 'asc' && $sort_by == 'ta004') ? 'desc' : 'asc') ,'請購部門'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("pur/puri05/display/ta012/" . (($sort_order == 'asc' && $sort_by == 'ta012') ? 'desc' : 'asc') ,'請購人員'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("pur/puri05/display/ta013/" . (($sort_order == 'asc' && $sort_by == 'ta013') ? 'desc' : 'asc') ,'單據日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		  <td width="5%" class="left">
		  <?php echo anchor("pur/puri05/display/ta016/" . (($sort_order == 'asc' && $sort_by == 'ta016') ? 'desc' : 'asc') ,'狀態碼'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		  <?php echo anchor("pur/puri05/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="12%" class="center">&nbsp查看管理&nbsp </td>
             <td width="12%" class="center">&nbsp修改管理&nbsp </td>
		
            </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_ta001='';$filter_ta002='';$filter_ta003='';$filter_ta004='';$filter_ta012='';$filter_ta013='';$filter_ta016='';$filter_create=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	      <td class="left"></td>
			  
              <td width="10px" align="left">
		  <div id="search">
		   <div class="button-search"></div>
		      <input type="text" id="filter_ta001" name="filter_ta001" size="8" value="" />
		  </div>
	      </td>
			  
	      <td width="5%" class="left">
		  <div  class="button-search"></div>
			<input type="text" id="filter_ta002" name="filter_ta002" size="12" value="" />
		  </td>
			  
	      <td width="5%" class="left">
		  <div id="search">
		   <div class="button-search"></div>
			<input type="text" name="filter_ta003" size="16" value="" />
		  </div>			  
	      </td>
			  
	      <td width="5%" align="left">
		  <div class="button-search"></div>
		       <input type="text" name="filter_ta004" size="12" value="" />
		  </td>
              <td  width="5%" align="left">
		  <div class="button-search"></div>
		       <input type="text" name="filter_ta012" size="12" value="" />
		  </td>
	      <td  width="5%" align="left">
		  <div class="button-search"></div>
		       <input type="text" name="filter_ta013" size="12" value="" />
		  </td>
		  <td width="5%" align="left">
		  <div class="button-search"></div>
		       <input type="text" name="filter_ta016" size="8" value="" />
		  </td>
	      <td width="5%" align="left">
		  <div class="button-search"></div>
		       <input type="text" name="filter_create" size="12" value="" />
		  </td>
	      <td width="10%" align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td width="10%" align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
		
            </tr>
			
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
            <tr>
              <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?=$row->ta001."/".trim($row->ta002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left"><? echo $chkval;?></td>
          			  
		  <td class="left"><? echo $row->ta001;?></td>			  
		  <td class="left"><? echo $row->ta002;?></td>
		  <td class="left"><? echo substr($row->ta003,0,4).'/'.substr($row->ta003,4,2).'/'.substr($row->ta003,6,2);?></td>
		  <td class="left"><? echo $row->ta004;?></td>
		  <td class="left"><? echo $row->ta012;?></td>
		  <td class="left"><? echo substr($row->ta013,0,4).'/'.substr($row->ta013,4,2).'/'.substr($row->ta013,6,2);?></td>
		  <td class="left"><? echo $row->ta016;?></td>
		  <td class="center"><? echo substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>		                 			
		
		  <td class="center"><a href="<?php echo site_url('pur/puri05/see/'.$row->ta001.'/'.$row->ta002) ?>">[ 查看 ]</a></td>
          <td class="center"><a href="<?php echo site_url('pur/puri05/updform/'.$row->ta001.'/'.$row->ta002)?>">[ 修改 ]</a></td>
		
		<!--  <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pur/puri05/del/'.$row->ta001."/".trim($row->ta002))?>" id="delete1"  >[ 刪除 ]</a></td>   --> 
	    </tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
          </tbody>		 
        </table>
		     
	          <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		       <?php  $this->session->set_userdata('search1',"display/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
			  
			
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
    window.open('/index.php/pur/puri05/printdetail')
  }

function open_winexcel()
  {
    window.open('/index.php/pur/puri05/exceldetail')
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
		
	var filter_ta001 = $('input[name=\'filter_ta001\']').attr('value');
	if (filter_ta001) {
		url = '<?=base_url() ?>index.php/pur/puri05/filter1/ta001/desc/' + encodeURIComponent(filter_ta001);
	} 
	
	var filter_ta002 = $('input[name=\'filter_ta002\']').attr('value');
	if (filter_ta002) {
		url = '<?=base_url() ?>index.php/pur/puri05/filter1/ta002/desc/' + encodeURIComponent(filter_ta002);
	} 
	
	var filter_ta003 = $('input[name=\'filter_ta003\']').attr('value');
	if (filter_ta003) {
		url = '<?=base_url() ?>index.php/pur/puri05/filter1/ta003/desc/' + encodeURIComponent(filter_ta003);
	}
	
	var filter_ta004 = $('input[name=\'filter_ta004\']').attr('value');
	if (filter_ta004) {
		url = '<?=base_url() ?>index.php/pur/puri05/filter1/ta004/desc/' + encodeURIComponent(filter_ta004);
	}
		
	var filter_ta012 = $('input[name=\'filter_ta012\']').attr('value');
	if (filter_ta012) {
		url = '<?=base_url() ?>index.php/pur/puri05/filter1/ta012/desc/' + encodeURIComponent(filter_ta012); 
	}
	
	var filter_ta013 = $('input[name=\'filter_ta013\']').attr('value');
	if (filter_ta013) {
		url = '<?=base_url() ?>index.php/pur/puri05/filter1/ta013/desc/' + encodeURIComponent(filter_ta013); 
	}
		var filter_ta016 = $('input[name=\'filter_ta016\']').attr('value');
	if (filter_ta016) {
		url = '<?=base_url() ?>index.php/pur/puri05/filter1/ta016/desc/' + encodeURIComponent(filter_ta016); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = '<?=base_url() ?>index.php/pur/puri05/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if ( !filter_ta001  && !filter_ta002 && !filter_ta003 && !filter_ta004 && !filter_ta012 && !filter_ta013  && !filter_ta016 && !filter_create) {         
	   url = '<?=base_url() ?>index.php/pur/puri05/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_ta001 = $('input[name=\'filter_ta001\']').attr('value');
	if (filter_ta001) {
		url = '<?=base_url() ?>index.php/pur/puri05/filter1/ta001/asc/' + encodeURIComponent(filter_ta001);
	} 
		
	var filter_ta002 = $('input[name=\'filter_ta002\']').attr('value');
	if (filter_ta002) {
		url = '<?=base_url() ?>index.php/pur/puri05/filter1/ta002/asc/' + encodeURIComponent(filter_ta002);
	} 
	
	var filter_ta003 = $('input[name=\'filter_ta003\']').attr('value');
	if (filter_ta003) {
		url = '<?=base_url() ?>index.php/pur/puri05/filter1/ta003/asc/' + encodeURIComponent(filter_ta003);
	}
	
	var filter_ta004 = $('input[name=\'filter_ta004\']').attr('value');
	if (filter_ta004) {
		url = '<?=base_url() ?>index.php/pur/puri05/filter1/ta004/asc/' + encodeURIComponent(filter_ta004);
	}
		
	var filter_ta012 = $('input[name=\'filter_ta012\']').attr('value');
	if (filter_ta012) {
		url = '<?=base_url() ?>index.php/pur/puri05/filter1/ta012/asc/' + encodeURIComponent(filter_ta012); 
	}
	
	var filter_ta013 = $('input[name=\'filter_ta013\']').attr('value');
	if (filter_ta013) {
		url = '<?=base_url() ?>index.php/pur/puri05/filter1/ta013/asc/' + encodeURIComponent(filter_ta013); 
	}
	var filter_ta016 = $('input[name=\'filter_ta016\']').attr('value');
	if (filter_ta016) {
		url = '<?=base_url() ?>index.php/pur/puri05/filter1/ta016/asc/' + encodeURIComponent(filter_ta016); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = '<?=base_url() ?>index.php/pur/puri05/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_ta001  && !filter_ta002 && !filter_ta003 && !filter_ta004 && !filter_ta012 && !filter_ta013 && !filter_ta016 && !filter_create) {         
	   url = '<?=base_url() ?>index.php/pur/puri05/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 
 
    </div>
