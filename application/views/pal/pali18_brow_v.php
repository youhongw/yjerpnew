  <div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 勞退級距表建立作業 - 瀏覽</h1>
      <!--  <div class="buttons"> -->
	   <div style="float:right; "> 
	    <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali18/clear_sql_term'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali18/addform'"  style="float:left"  accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali18/copyform'"  style="float:left"  accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali18/findform'"  style="float:left"  accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left"  accesskey="-" class="button"><span>選取刪除</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali18/printdetail'"    accesskey="p"  style="float:left" class="button">列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali18/exceldetail'"   accesskey="l"  style="float:left"  class="button">轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/pal/pali18/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali18/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/111'"  style="float:left"  accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/pal/pali18/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
        <thead>
         <tr>                          <!-- 表格表頭 -->
          <td width="1%" style="text-align: center;">
		   <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		   <?php echo anchor("pal/pali18/display/mw001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?> 
	      </td>
	      <td width="5%" class="left">
	        <?php echo anchor("pal/pali18/display/mw001/" . (($sort_order == 'asc' && $sort_by == 'mw001') ? 'desc' : 'asc') ,'勞退等級'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		   <?php echo anchor("pal/pali18/display/mw002/" . (($sort_order == 'asc' && $sort_by == 'mw002') ? 'desc' : 'asc') ,'月提繳工資'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="16%" class="left"> 
		   <?php echo anchor("pal/pali18/display/mw003/" . (($sort_order == 'asc' && $sort_by == 'mw003') ? 'desc' : 'asc') ,'保留1'.'%'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
          </td>
	      <td width="8%" class="left">
	        <?php echo anchor("pal/pali18/display/mw004/" .(($sort_order == 'asc' && $sort_by == 'mw004') ? 'desc' : 'asc') ,'保留2'.'%'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("pal/pali18/display/mw008/" . (($sort_order == 'asc' && $sort_by == 'mw008') ? 'desc' : 'asc') ,'保留3'.'%'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("pal/pali18/display/mw009/" . (($sort_order == 'asc' && $sort_by == 'mw009') ? 'desc' : 'asc') ,'保留4'.'%'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		   <?php echo anchor("pal/pali18/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="18%" class="center">&nbsp查看管理&nbsp </td>
          <td width="18%" class="center">&nbsp修改管理&nbsp </td>
        </tr>
        </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_mw001='*';$filter_mw002='';$filter_mw003='';$filter_mw004='';$filter_mw005='';$filter_mw006='';$filter_create=''; ?>
	    <tr class="filter">
	     <td class="left"></td>
	     <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
         <td align="left">
		   <div class="button-search"></div>
		    <input type="text" id="filter_mw001" name="filter_mw001" value=""  size="12" />
		   </div>
	     </td>
			  
	      <td class="left">
		  <div  class="button-search"></div>
			<input type="text" id="filter_mw002" name="filter_mw002" value="" />
		  </td>
			  
	      <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_mw003" value=""  size="12" />
		   </div>			  
	      </td>
			  
	      <td align="left">
		  <div class="button-search"></div>
		     <input type="text" name="filter_mw004" value=""  size="12" />
		  </td>
          <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_mw008" value=""  size="12" />
		  </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_mw009" value=""  size="12" />
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
		<?php $this->session->unset_userdata('mw002'); ?> -->
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->mw001?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo $chkval;?></td>		
		  <td class="left"><?php echo $row->mw001;?></td>			  
		  <td class="left"><?php echo $row->mw002;?></td>
		  <td class="left"><?php echo round($row->mw003,0);?></td>
		  <td class="left"><?php echo round($row->mw004,0);?></td>
		  <td class="left"><?php echo round($row->mw005);?></td>
		  <td class="left"><?php echo round($row->mw006);?></td>
		  <td class="center"><?php echo substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>		                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pal/pali18/del/'.$row->mw001."/".trim($row->mw002))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><a href="<?php echo site_url('pal/pali18/see/'.$row->mw001)?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>                 
		  <td class="center"><a href="<?php echo site_url('pal/pali18/updform/'.$row->mw001)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
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
   // window.open('/index.php/pal/pali18/printdetail')
	window.location="<?php echo base_url()?>index.php/pal/pali18/printdetail";
  }

function open_winexcel()
  {
   //  window.open('/index.php/pal/pali18/exceldetail')
	window.location="<?php echo base_url()?>index.php/pal/pali18/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_mw001 = $('input[name=\'filter_mw001\']').attr('value');
	if (filter_mw001) {
		url = '<?php echo base_url() ?>index.php/pal/pali18/filter1/mw001/desc/' + encodeURIComponent(filter_mw001);
	}
	
	var filter_mw002 = $('input[name=\'filter_mw002\']').attr('value');
	if (filter_mw002) {
		url = '<?php echo base_url() ?>index.php/pal/pali18/filter1/mw002/desc/' + encodeURIComponent(filter_mw002);
	} 
	
	var filter_mw003 = $('input[name=\'filter_mw003\']').attr('value');
	if (filter_mw003) {
		url = '<?php echo base_url() ?>index.php/pal/pali18/filter1/mw003/desc/' + encodeURIComponent(filter_mw003);
	}
		
	var filter_mw004 = $('input[name=\'filter_mw004\']').attr('value');
	if (filter_mw004) {
		url = '<?php echo base_url() ?>index.php/pal/pali18/filter1/mw004/desc/' + encodeURIComponent(filter_mw004); 
	}
	
	var filter_mw008 = $('input[name=\'filter_mw008\']').attr('value');
	if (filter_mw008) {
		url = '<?php echo base_url() ?>index.php/pal/pali18/filter1/mw008/desc/' + encodeURIComponent(filter_mw008); 
	}
	
	var filter_mw009 = $('input[name=\'filter_mw009\']').attr('value');
	if (filter_mw009) {
		url = '<?php echo base_url() ?>index.php/pal/pali18/filter1/mw009/desc/' + encodeURIComponent(filter_mw009); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/pal/pali18/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_mw001 && !filter_mw002  && !filter_mw003 && !filter_mw004  && !filter_mw008 && !filter_mw009 && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali18/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_mw001 = $('input[name=\'filter_mw001\']').attr('value');
	if (filter_mw001) {
		url = '<?php echo base_url() ?>index.php/pal/pali18/filter1/mw001/asc/' + encodeURIComponent(filter_mw001);
	}
	
	var filter_mw002 = $('input[name=\'filter_mw002\']').attr('value');
	if (filter_mw002) {
		url = '<?php echo base_url() ?>index.php/pal/pali18/filter1/mw002/asc/' + encodeURIComponent(filter_mw002);
	} 
	
	var filter_mw003 = $('input[name=\'filter_mw003\']').attr('value');
	if (filter_mw003) {
		url = '<?php echo base_url() ?>index.php/pal/pali18/filter1/mw003/asc/' + encodeURIComponent(filter_mw003);
	}
		
	var filter_mw004 = $('input[name=\'filter_mw004\']').attr('value');
	if (filter_mw004) {
		url = '<?php echo base_url() ?>index.php/pal/pali18/filter1/mw004/asc/' + encodeURIComponent(filter_mw004); 
	}
	
	var filter_mw008 = $('input[name=\'filter_mw008\']').attr('value');
	if (filter_mw008) {
		url = '<?php echo base_url() ?>index.php/pal/pali18/filter1/mw008/asc/' + encodeURIComponent(filter_mw008); 
	}
	
	var filter_mw009 = $('input[name=\'filter_mw009\']').attr('value');
	if (filter_mw009) {
		url = '<?php echo base_url() ?>index.php/pal/pali18/filter1/mw009/asc/' + encodeURIComponent(filter_mw009); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/pal/pali18/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_mw001 && !filter_mw002  && !filter_mw003 && !filter_mw004  && !filter_mw008 && !filter_mw009 && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali18/display';location = url;
	   
	   }
	   
	location = url;
}
</script>