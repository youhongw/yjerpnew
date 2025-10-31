  <div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 加班單多筆建立作業 - 瀏覽</h1>
       <!--  <div class="buttons"> -->
	   <div style="float:right; "> 
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali55/beforeadd'" style="float:left" accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <!--<a onclick="location = '<?php echo base_url()?>index.php/pal/pali55/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>-->
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <!--<a onclick="location = '<?php echo base_url()?>index.php/pal/pali55/findform'"  style="float:left" accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>-->
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>選取刪除</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <!--<a onclick="open_winprint();"    style="float:left" accesskey="p" class="button">列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  -->
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <!--<a onclick="open_winexcel();"    style="float:left" accesskey="l" class="button">轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> -->
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/pal/pali55/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali55/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/111'"  style="float:left" accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	<style>
	.list tbody td {
		background-color : inherit;
	}
	</style>
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/pal/pali55/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
        <thead>
         <tr>                          <!-- 表格表頭 -->
          <td width="1%" style="text-align: center;">
		   <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="8%" class="left">
	        <?php echo anchor("pal/pali55/display/tf002/" . (($sort_order == 'asc' && $sort_by == 'tf002') ? 'desc' : 'asc') ,'加班日期'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="8%" class="left"> 
		   <?php echo anchor("pal/pali55/display/c.me002/" . (($sort_order == 'asc' && $sort_by == 'c.me002') ? 'desc' : 'asc') ,'加班單位'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left"> 
		   <?php echo anchor("pal/pali55/display/count_count/" . (($sort_order == 'asc' && $sort_by == 'count_count') ? 'desc' : 'asc') ,'加班筆數'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
          </td>
	      <td width="8%" class="left">
	        <?php echo anchor("pal/pali55/display/creator/" .(($sort_order == 'asc' && $sort_by == 'creator') ? 'desc' : 'asc') ,'建立者'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("pal/pali55/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立時間'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("pal/pali55/display/modi_date/" . (($sort_order == 'asc' && $sort_by == 'modi_date') ? 'desc' : 'asc') ,'修改時間'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		   <?php echo anchor("pal/pali55/display/c_count/" . (($sort_order == 'asc' && $sort_by == 'c_count') ? 'desc' : 'asc') ,'全單審核與否'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="18%" class="center">&nbsp查看管理&nbsp </td>
          <td width="18%" class="center">&nbsp修改管理&nbsp </td>
        </tr>
        </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_tf002='';$filter_me002='';$filter_tf002='';$filter_tf003='';$filter_tf004='';$filter_tf005='';$filter_tf007=''; ?>
	    <tr class="filter">
	     <td class="left"></td>
         <td align="left">
		   <div class="button-search"></div>
		    <input type="text" id="filter_tf002" name="filter_tf002" value=""  size="15" />
		   </div>
	     </td>
			  
	      <td class="left">
		  <div  class="button-search"></div>
			<input type="text" id="filter_me002" name="filter_me002" value=""  size="15" />
		  </td>
		  
		    <td class="left">
		  <div  class="button-search"></div>
			<input type="text" id="filter_count_count" name="filter_count_count" value="" size="8" disabled="disabled" />
		  </td>
		  
	      <td class="left">
		   <div class="button-search"></div>
			<input type="text" id="filter_creator" name="filter_creator" value=""  size="12" />
		   </div>			  
	      </td>
		  <td class="left">
		   <div class="button-search"></div>
			<input type="text"  name="filter_create_date" value=""   size="12" />
		   </div>			  
	      </td>
			 <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_modi_date" value=""   size="12" />
		   </div>			  
	      </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_c_count" value="" size="8" disabled="disabled" />
		  </td>
	      <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td>  
	      <!-- <button type='submit'  name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
        </tr>
		
		<!--session 變數取消 	  
		<?php $this->session->unset_userdata('tf002'); ?> -->
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr <?php if($row->count_count!=$row->c_count) echo "style='background-color:red'";?>>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->tf002."/".$row->me001 ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
		  <td class="left"><?php echo substr($row->tf002,0,4).'/'.substr($row->tf002,4,2).'/'.substr($row->tf002,6,2);?></td>			  
		  <td class="left"><?php echo $row->me002;?></td>
		  <td class="left"><?php echo $row->count_count;?></td>
		  <td class="left"><?php echo $row->creator;?></td>
		  <td class="left"><?php echo substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>	
		  <td class="left"><?php echo substr($row->modi_date,0,4).'/'.substr($row->modi_date,4,2).'/'.substr($row->modi_date,6,2);?></td>	
		  <td class="center"><?php if($row->count_count!=$row->c_count) echo "N";else echo "Y";?></td>			                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pal/pali55/del/'.$row->tf001."/".trim($row->tf003))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><a href="<?php echo site_url('pal/pali55/see/'.$row->tf002."/".$row->me001)?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>                 
		  <td class="center"><a href="<?php echo site_url('pal/pali55/updform/'.$row->tf002."/".$row->me001)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
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
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      </form>
    
    </div> <!-- div-2 -->
   </div>  <!-- div-1 -->
</div>	<!-- div-0 -->

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
   // window.open('/index.php/pal/pali55/printdetail')
	window.location="<?php echo base_url()?>index.php/pal/pali55/printdetail";
  }

function open_winexcel()
  {
   //  window.open('/index.php/pal/pali55/exceldetail')
	window.location="<?php echo base_url()?>index.php/pal/pali55/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_tf002 = $('input[name=\'filter_tf002\']').attr('value');
	if (filter_tf002) {
		url = '<?php echo base_url() ?>index.php/pal/pali55/filter1/a.tf002/desc/' + encodeURIComponent(filter_tf002);
	}
	
	var filter_me002 = $('input[name=\'filter_me002\']').attr('value');
	if (filter_me002) {
		url = '<?php echo base_url() ?>index.php/pal/pali55/filter1/c.me002/desc/' + encodeURIComponent(filter_me002);
	} 
	
	var filter_count_count = $('input[name=\'filter_count_count\']').attr('value');
	if (filter_count_count) {
		url = '<?php echo base_url() ?>index.php/pal/pali55/filter1/count_count/desc/' + encodeURIComponent(filter_count_count);
	}
	var filter_creator = $('input[name=\'filter_creator\']').attr('value');
	if (filter_creator) {
		url = '<?php echo base_url() ?>index.php/pal/pali55/filter1/a.creator/desc/' + encodeURIComponent(filter_creator);
	}
    var filter_create_date = $('input[name=\'filter_create_date\']').attr('value');
	if (filter_create_date) {
		url = '<?php echo base_url() ?>index.php/pal/pali55/filter1/a.create_date/desc/' + encodeURIComponent(filter_create_date);
	}	
	var filter_modi_date = $('input[name=\'filter_modi_date\']').attr('value');
	if (filter_modi_date) {
		url = '<?php echo base_url() ?>index.php/pal/pali55/filter1/a.modi_date/desc/' + encodeURIComponent(filter_modi_date);
	}
	
	var filter_c_count = $('input[name=\'filter_c_count\']').attr('value');
	if (filter_c_count) {
		url = '<?php echo base_url() ?>index.php/pal/pali55/filter1/c_count/desc/' + encodeURIComponent(filter_c_count); 
	}
	
    if (!filter_tf002 && !filter_me002   && !filter_count_count && !filter_creator && !filter_create_date && !filter_modi_date && !filter_c_count) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali55/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_tf002 = $('input[name=\'filter_tf002\']').attr('value');
	if (filter_tf002) {
		url = '<?php echo base_url() ?>index.php/pal/pali55/filter1/a.tf002/asc/' + encodeURIComponent(filter_tf002);
	}
	
	var filter_me002 = $('input[name=\'filter_me002\']').attr('value');
	if (filter_me002) {
		url = '<?php echo base_url() ?>index.php/pal/pali55/filter1/c.me002/asc/' + encodeURIComponent(filter_me002);
	} 
		
	var filter_count_count = $('input[name=\'filter_count_count\']').attr('value');
	if (filter_count_count) {
		url = '<?php echo base_url() ?>index.php/pal/pali55/filter1/count_count/asc/' + encodeURIComponent(filter_count_count);
	}
	var filter_creator = $('input[name=\'filter_creator\']').attr('value');
	if (filter_creator) {
		url = '<?php echo base_url() ?>index.php/pal/pali55/filter1/a.creator/asc/' + encodeURIComponent(filter_creator);
	}
	var filter_create_date = $('input[name=\'filter_create_date\']').attr('value');
	if (filter_create_date) {
		url = '<?php echo base_url() ?>index.php/pal/pali55/filter1/a.create_date/asc/' + encodeURIComponent(filter_create_date);
	}	
	var filter_modi_date = $('input[name=\'filter_modi_date\']').attr('value');
	if (filter_modi_date) {
		url = '<?php echo base_url() ?>index.php/pal/pali55/filter1/a.modi_date/asc/' + encodeURIComponent(filter_modi_date);
	}
	var filter_c_count = $('input[name=\'filter_c_count\']').attr('value');
	if (filter_c_count) {
		url = '<?php echo base_url() ?>index.php/pal/pali55/filter1/c_count/asc/' + encodeURIComponent(filter_c_count); 
	}
	
    if (!filter_tf002 && !filter_me002   && !filter_count_count  && !filter_creator && !filter_create_date && !filter_modi_date && !filter_c_count) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali55/display';location = url;
	   
	   }
	   
	location = url;
}
</script>