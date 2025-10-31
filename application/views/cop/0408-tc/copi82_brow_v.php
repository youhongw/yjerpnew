  <div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 業務訪問建立作業 - 瀏覽</h1>
      <!--  <div class="buttons"> -->
	   <div style="float:right; "> 
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?=base_url()?>index.php/cop/copi82/addform'"  style="float:left"  accesskey="+" class="button"><span>新增</span><img src="<?=base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?=base_url()?>index.php/cop/copi82/copyform'"  style="float:left"  accesskey="c" class="button"><span>複製 c </span><img src="<?=base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?=base_url()?>index.php/cop/copi82/findform'"  style="float:left"  accesskey="k" class="button"><span>進階查詢 k </span><img src="<?=base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left"  accesskey="-" class="button"><span>選取刪除</span><img src="<?=base_url()?>assets/image/png/del.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?=base_url()?>index.php/cop/copi82/printdetail'"    accesskey="p"  style="float:left" class="button">列印 p </span><img src="<?=base_url()?>assets/image/png/print.png" /></a>  
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?=base_url()?>index.php/cop/copi82/exceldetail'"   accesskey="l"  style="float:left"  class="button">轉EXCEL檔 l </span><img src="<?=base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?=base_url()?>index.php/cop/copi82/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?=base_url()?>index.php/cop/copi82/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?=base_url()?>index.php/main/index/104'"  style="float:left"  accesskey="x" class="button"><span>關閉</span><img src="<?=base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?=base_url()?>index.php/cop/copi82/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
        <thead>
         <tr>                          <!-- 表格表頭 -->
          <td width="1%" style="text-align: center;">
		   <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		   <?php echo anchor("cop/copi82/display/mm001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?> 
	      </td>
	      <td width="5%" class="left">
	        <?php echo anchor("cop/copi82/display/mm001/" . (($sort_order == 'asc' && $sort_by == 'mm001') ? 'desc' : 'asc') ,'訪問日期'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		   <?php echo anchor("cop/copi82/display/mm002/" . (($sort_order == 'asc' && $sort_by == 'mm002') ? 'desc' : 'asc') ,'業務代號'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="16%" class="left"> 
		   <?php echo anchor("cop/copi82/display/mm003/" . (($sort_order == 'asc' && $sort_by == 'mm003') ? 'desc' : 'asc') ,'客戶代號'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
          </td>
	      <td width="8%" class="left">
	        <?php echo anchor("cop/copi82/display/mm003disp/" .(($sort_order == 'asc' && $sort_by == 'mm003disp') ? 'desc' : 'asc') ,'客戶簡稱'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("cop/copi82/display/mm004/" . (($sort_order == 'asc' && $sort_by == 'mm004') ? 'desc' : 'asc') ,'級別區分'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("cop/copi82/display/mm002disp/" . (($sort_order == 'asc' && $sort_by == 'mm002disp') ? 'desc' : 'asc') ,'業務員'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		   <?php echo anchor("cop/copi82/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="18%" class="center">&nbsp查看管理&nbsp </td>
          <td width="18%" class="center">&nbsp修改管理&nbsp </td>
        </tr>
        </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_mm001='';$filter_mm002='';$filter_mm003='';$filter_mm004='';$filter_mm002disp='';$filter_mm003disp='';$filter_create=''; ?>
	    <tr class="filter">
	     <td class="left"></td>
	     <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
         <td align="left">
		   <div class="button-search"></div>
		    <input type="text" id="filter_mm001" name="filter_mm001" value=""  size="12" />
		   </div>
	     </td>
			  
	      <td class="left">
		  <div  class="button-search"></div>
			<input type="text" id="filter_mm002" name="filter_mm002" value="" />
		  </td>
			  
	      <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_mm003" value=""  size="12" />
		   </div>			  
	      </td>
		  
		   <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_mm003disp" value=""  size="12" />
		   </div>			  
	      </td>
		  
		   <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_mm004" value=""  size="12" />
		   </div>			  
	      </td>
		  
			<td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_mm002disp" value=""  size="12" />
		   </div>	  
	      
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_create" value="" />
		  </td>
	      <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td>  
	      <!-- <button type='submit'  name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
        </tr>
		
		<!--session 變數取消 	  
		<?php $this->session->unset_userdata('mm002'); ?> -->
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?=$row->mm001."/".trim($row->mm002)."/".trim($row->mm003)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><? echo $chkval;?></td>		
		  <td class="left"><? echo substr($row->mm001,0,4).'/'.substr($row->mm001,4,2).'/'.substr($row->mm001,6,2);?></td>		  
		  <td class="left"><? echo $row->mm002;?></td>
		  <td class="left"><? echo $row->mm003;?></td>
		  <td class="left"><? echo $row->mm003disp;?></td>
		  <td class="left"><? echo $row->mm004;?></td>
		  <td class="left"><? echo $row->mm002disp;?></td>
		  <td class="center"><? echo substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>		                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('cop/copi82/del/'.$row->mm001."/".trim($row->mm002)."/".trim($row->mm003))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><a href="<?php echo site_url('cop/copi82/see/'.$row->mm001."/".trim($row->mm002)."/".trim($row->mm003))?>">[ 查看 </a><img src="<?=base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>                 
		  <td class="center"><a href="<?php echo site_url('cop/copi82/updform/'.$row->mm001."/".trim($row->mm002)."/".trim($row->mm003))?>">[ 修改 </a><img src="<?=base_url()?>assets/image/png/modi.png" />]</td>
	      <?PHP } ?>
		</tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
          </tbody>		 
        </table>
		       <!-- 修改時 留在原來那一筆資料使用 -->
	          <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		    <!--    <?php echo $this->pagination->create_links();?>	
			    <?php echo $this->session->userdata('find05');$find05; ?><?php echo $this->session->userdata('find07');$find07;  ?> -->
				<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 選欄位名稱自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 選取列項出現打勾可多筆刪除, 列印可自設網址列不印, 快速鍵Alt+.. ] '.'　　　總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      </form>
    
    </div> <!-- div-2 -->
   </div>  <!-- div-1 -->
</div>	<!-- div-0 -->

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
   // window.open('/index.php/cop/copi82/printdetail')
	window.location="<?=base_url()?>index.php/cop/copi82/printdetail";
  }

function open_winexcel()
  {
   //  window.open('/index.php/cop/copi82/exceldetail')
	window.location="<?=base_url()?>index.php/cop/copi82/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_mm001 = $('input[name=\'filter_mm001\']').attr('value');
	if (filter_mm001) {
		url = '<?=base_url() ?>index.php/cop/copi82/filter1/mm001/desc/' + encodeURIComponent(filter_mm001);
	}
	
	var filter_mm002 = $('input[name=\'filter_mm002\']').attr('value');
	if (filter_mm002) {
		url = '<?=base_url() ?>index.php/cop/copi82/filter1/mm002/desc/' + encodeURIComponent(filter_mm002);
	} 
	
	var filter_mm003 = $('input[name=\'filter_mm003\']').attr('value');
	if (filter_mm003) {
		url = '<?=base_url() ?>index.php/cop/copi82/filter1/mm003/desc/' + encodeURIComponent(filter_mm003);
	}
	
	var filter_mm004 = $('input[name=\'filter_mm004\']').attr('value');
	if (filter_mm004) {
		url = '<?=base_url() ?>index.php/cop/copi82/filter1/mm004/desc/' + encodeURIComponent(filter_mm004);
	}
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = '<?=base_url() ?>index.php/cop/copi82/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_mm001 && !filter_mm002  && !filter_mm003 && !filter_mm004  && !filter_create) {         
	   url = '<?=base_url() ?>index.php/cop/copi82/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_mm001 = $('input[name=\'filter_mm001\']').attr('value');
	if (filter_mm001) {
		url = '<?=base_url() ?>index.php/cop/copi82/filter1/mm001/asc/' + encodeURIComponent(filter_mm001);
	}
	
	var filter_mm002 = $('input[name=\'filter_mm002\']').attr('value');
	if (filter_mm002) {
		url = '<?=base_url() ?>index.php/cop/copi82/filter1/mm002/asc/' + encodeURIComponent(filter_mm002);
	} 
	
	var filter_mm003 = $('input[name=\'filter_mm003\']').attr('value');
	if (filter_mm003) {
		url = '<?=base_url() ?>index.php/cop/copi82/filter1/mm003/asc/' + encodeURIComponent(filter_mm003);
	}
	
	var filter_mm004 = $('input[name=\'filter_mm004\']').attr('value');
	if (filter_mm004) {
		url = '<?=base_url() ?>index.php/cop/copi82/filter1/mm004/asc/' + encodeURIComponent(filter_mm004);
	}	
	
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = '<?=base_url() ?>index.php/cop/copi82/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_mm001 && !filter_mm002  && !filter_mm003 && !filter_mm004  && !filter_create) {         
	   url = '<?=base_url() ?>index.php/cop/copi82/display';location = url;
	   
	   }
	   
	location = url;
}
</script>