  <div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 勞保計費表建立作業 - 瀏覽</h1>
      <!--  <div class="buttons"> -->
	   <div style="float:right; "> 
	    <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali02/clear_sql_term'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali02/addform'"  style="float:left"  accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali02/copyform'"  style="float:left"  accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali02/findform'"  style="float:left"  accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left"  accesskey="-" class="button"><span>選取刪除</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali02/printdetail'"    accesskey="p"  style="float:left" class="button">列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali02/exceldetail'"   accesskey="l"  style="float:left"  class="button">轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/pal/pali02/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali02/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/111'"  style="float:left"  accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/pal/pali02/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
        <thead>
         <tr>                          <!-- 表格表頭 -->
          <td width="1%" style="text-align: center;">
		   <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		   <?php echo anchor("pal/pali02/display/mp001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?> 
	      </td>
	      <td width="5%" class="left">
	        <?php echo anchor("pal/pali02/display/mp001/" . (($sort_order == 'asc' && $sort_by == 'mp001') ? 'desc' : 'asc') ,'勞保等級'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		   <?php echo anchor("pal/pali02/display/mp002/" . (($sort_order == 'asc' && $sort_by == 'mp002') ? 'desc' : 'asc') ,'投保金額'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="16%" class="left"> 
		   <?php echo anchor("pal/pali02/display/mp003/" . (($sort_order == 'asc' && $sort_by == 'mp003') ? 'desc' : 'asc') ,'保費'.$rates->mr001.'%'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
          </td>
	      <td width="8%" class="left">
	        <?php echo anchor("pal/pali02/display/mp004/" .(($sort_order == 'asc' && $sort_by == 'mp004') ? 'desc' : 'asc') ,'就業保費'.$rates->mr002.'%'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("pal/pali02/display/mp008/" . (($sort_order == 'asc' && $sort_by == 'mp008') ? 'desc' : 'asc') ,'顧主'.$rates->mr005.'%'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("pal/pali02/display/mp009/" . (($sort_order == 'asc' && $sort_by == 'mp009') ? 'desc' : 'asc') ,'勞工'.$rates->mr006.'%'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		   <?php echo anchor("pal/pali02/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="18%" class="center">&nbsp查看管理&nbsp </td>
          <td width="18%" class="center">&nbsp修改管理&nbsp </td>
        </tr>
        </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_mp001='*';$filter_mp002='';$filter_mp003='';$filter_mp004='';$filter_mp005='';$filter_mp006='';$filter_create=''; ?>
	    <tr class="filter">
	     <td class="left"></td>
	     <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
         <td align="left">
		   <div class="button-search"></div>
		    <input type="text" id="filter_mp001" name="filter_mp001" value=""  size="12" />
		   </div>
	     </td>
			  
	      <td class="left">
		  <div  class="button-search"></div>
			<input type="text" id="filter_mp002" name="filter_mp002" value="" />
		  </td>
			  
	      <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_mp003" value=""  size="12" />
		   </div>			  
	      </td>
			  
	      <td align="left">
		  <div class="button-search"></div>
		     <input type="text" name="filter_mp004" value=""  size="12" />
		  </td>
          <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_mp008" value=""  size="12" />
		  </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_mp009" value=""  size="12" />
		  </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_create" value="" />
		  </td>
	      <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td>  
	      <!-- <button type='submit'  name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
        </tr>
		
		<!--session 變數取消 	  
		<?php $this->session->unset_userdata('mp002'); ?> -->
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->mp001?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo $chkval;?></td>		
		  <td class="left"><?php echo $row->mp001;?></td>			  
		  <td class="left"><?php echo $row->mp002;?></td>
		  <td class="left"><?php echo round($row->mp002*$rates->mr001/100,0);?></td>
		  <td class="left"><?php echo round($row->mp002*$rates->mr002/100,0);?></td>
		  <td class="left"><?php echo round($row->mp002*($rates->mr001+$rates->mr002)/100*$rates->mr005/100);?></td>
		  <td class="left"><?php echo round($row->mp002*($rates->mr001+$rates->mr002)/100*$rates->mr006/100);?></td>
		  <td class="center"><?php echo substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>		                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pal/pali02/del/'.$row->mp001."/".trim($row->mp002))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><a href="<?php echo site_url('pal/pali02/see/'.$row->mp002)?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>                 
		  <td class="center"><a href="<?php echo site_url('pal/pali02/updform/'.$row->mp002)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
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
   // window.open('/index.php/pal/pali02/printdetail')
	window.location="<?php echo base_url()?>index.php/pal/pali02/printdetail";
  }

function open_winexcel()
  {
   //  window.open('/index.php/pal/pali02/exceldetail')
	window.location="<?php echo base_url()?>index.php/pal/pali02/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_mp001 = $('input[name=\'filter_mp001\']').attr('value');
	if (filter_mp001) {
		url = '<?php echo base_url() ?>index.php/pal/pali02/filter1/mp001/desc/' + encodeURIComponent(filter_mp001);
	}
	
	var filter_mp002 = $('input[name=\'filter_mp002\']').attr('value');
	if (filter_mp002) {
		url = '<?php echo base_url() ?>index.php/pal/pali02/filter1/mp002/desc/' + encodeURIComponent(filter_mp002);
	} 
	
	var filter_mp003 = $('input[name=\'filter_mp003\']').attr('value');
	if (filter_mp003) {
		url = '<?php echo base_url() ?>index.php/pal/pali02/filter1/mp003/desc/' + encodeURIComponent(filter_mp003);
	}
		
	var filter_mp004 = $('input[name=\'filter_mp004\']').attr('value');
	if (filter_mp004) {
		url = '<?php echo base_url() ?>index.php/pal/pali02/filter1/mp004/desc/' + encodeURIComponent(filter_mp004); 
	}
	
	var filter_mp008 = $('input[name=\'filter_mp008\']').attr('value');
	if (filter_mp008) {
		url = '<?php echo base_url() ?>index.php/pal/pali02/filter1/mp008/desc/' + encodeURIComponent(filter_mp008); 
	}
	
	var filter_mp009 = $('input[name=\'filter_mp009\']').attr('value');
	if (filter_mp009) {
		url = '<?php echo base_url() ?>index.php/pal/pali02/filter1/mp009/desc/' + encodeURIComponent(filter_mp009); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/pal/pali02/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_mp001 && !filter_mp002  && !filter_mp003 && !filter_mp004  && !filter_mp008 && !filter_mp009 && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali02/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_mp001 = $('input[name=\'filter_mp001\']').attr('value');
	if (filter_mp001) {
		url = '<?php echo base_url() ?>index.php/pal/pali02/filter1/mp001/asc/' + encodeURIComponent(filter_mp001);
	}
	
	var filter_mp002 = $('input[name=\'filter_mp002\']').attr('value');
	if (filter_mp002) {
		url = '<?php echo base_url() ?>index.php/pal/pali02/filter1/mp002/asc/' + encodeURIComponent(filter_mp002);
	} 
	
	var filter_mp003 = $('input[name=\'filter_mp003\']').attr('value');
	if (filter_mp003) {
		url = '<?php echo base_url() ?>index.php/pal/pali02/filter1/mp003/asc/' + encodeURIComponent(filter_mp003);
	}
		
	var filter_mp004 = $('input[name=\'filter_mp004\']').attr('value');
	if (filter_mp004) {
		url = '<?php echo base_url() ?>index.php/pal/pali02/filter1/mp004/asc/' + encodeURIComponent(filter_mp004); 
	}
	
	var filter_mp008 = $('input[name=\'filter_mp008\']').attr('value');
	if (filter_mp008) {
		url = '<?php echo base_url() ?>index.php/pal/pali02/filter1/mp008/asc/' + encodeURIComponent(filter_mp008); 
	}
	
	var filter_mp009 = $('input[name=\'filter_mp009\']').attr('value');
	if (filter_mp009) {
		url = '<?php echo base_url() ?>index.php/pal/pali02/filter1/mp009/asc/' + encodeURIComponent(filter_mp009); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/pal/pali02/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_mp001 && !filter_mp002  && !filter_mp003 && !filter_mp004  && !filter_mp008 && !filter_mp009 && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali02/display';location = url;
	   
	   }
	   
	location = url;
}
</script>