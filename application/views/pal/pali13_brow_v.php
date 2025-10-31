  <div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 獎懲紀錄維護作業 - 瀏覽</h1>
       <!--  <div class="buttons"> -->
	   <div style="float:right; "> 
	    <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali13/clear_sql_term'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali13/addform'" style="float:left" accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9999,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali13/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali13/findform'"  style="float:left" accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>選取刪除</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="open_winprint();"    style="float:left" accesskey="p" class="button">列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="open_winexcel();"    style="float:left" accesskey="l" class="button">轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/pal/pali13/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali13/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/111'"  style="float:left" accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/pal/pali13/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
        <thead>
         <tr>                          <!-- 表格表頭 -->
          <td width="1%" style="text-align: center;">
		   <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		   <?php echo anchor("pal/pali13/display/mv001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?> 
	      </td>
	      <td width="5%" class="left">
	        <?php echo anchor("pal/pali13/display/mv001/" . (($sort_order == 'asc' && $sort_by == 'mv001') ? 'desc' : 'asc') ,'員工代號'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		   <?php echo anchor("pal/pali13/display/mv001disp/" . (($sort_order == 'asc' && $sort_by == 'mv001disp') ? 'desc' : 'asc') ,'員工姓名'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="16%" class="left"> 
		   <?php echo anchor("pal/pali13/display/mv002/" . (($sort_order == 'asc' && $sort_by == 'mv002') ? 'desc' : 'asc') ,'部門代號'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
          </td>
	      <td width="8%" class="left">
	        <?php echo anchor("pal/pali13/display/mv002disp/" .(($sort_order == 'asc' && $sort_by == 'mv002disp') ? 'desc' : 'asc') ,'部門名稱'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("pal/pali13/display/mv003/" . (($sort_order == 'asc' && $sort_by == 'mv003') ? 'desc' : 'asc') ,'異動日期'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("pal/pali13/display/mv004/" . (($sort_order == 'asc' && $sort_by == 'mv004') ? 'desc' : 'asc') ,'獎懲'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		   <?php echo anchor("pal/pali13/display/mv005/" . (($sort_order == 'asc' && $sort_by == 'mv005') ? 'desc' : 'asc') ,'次數'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="18%" class="center">&nbsp查看管理&nbsp </td>
          <td width="18%" class="center">&nbsp修改管理&nbsp </td>
        </tr>
        </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_mv001='';$filter_mv001disp='';$filter_mv002='';$filter_mv002disp='';$filter_mv003='';$filter_mv014='';$filter_mv013=''; ?>
	    <tr class="filter">
	     <td class="left"></td>
	     <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
         <td align="left">
		   <div class="button-search"></div>
		    <input type="text" id="filter_mv001" name="filter_mv001" value=""  size="12" />
		   </div>
	     </td>
			  
	      <td class="left">
		  <div  class="button-search"></div>
			<input type="text" readonly="value" id="filter_mv001disp" name="filter_mv001disp" value=""  style="background-color:#F5F5F5" />
		  </td>
		  
		    <td class="left">
		  <div  class="button-search"></div>
			<input type="text"  id="filter_mv002" name="filter_mv002" value=""    />
		  </td>
		  
	      <td class="left">
		   <div class="button-search"></div>
			<input type="text" readonly="value" name="filter_mv002disp" value=""  size="12" style="background-color:#F5F5F5" />
		   </div>			  
	      </td>
		  <td class="left">
		   <div class="button-search"></div>
			<input type="text"  name="filter_mv003" value=""   />
		   </div>			  
	      </td>
			 <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_mv004" value=""   />
		   </div>			  
	      </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_mv005" value="" />
		  </td>
	      <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td>  
	      <!-- <button type='submit'  name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
        </tr>
		
		<!--session 變數取消 	  
		<?php $this->session->unset_userdata('mv002'); ?> -->
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->mv001 ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>		
		  <td class="left"><?php echo  $row->mv001;?></td>			  
		  <td class="left"><?php echo  $row->mv001disp;?></td>
		  <td class="left"><?php echo  $row->mv002;?></td>
		  <td class="left"><?php echo  $row->mv002disp;?></td>
		  <td class="left"><?php echo  substr($row->mv003,0,4).'/'.substr($row->mv003,4,2).'/'.substr($row->mv003,6,2);?></td>
		  <td class="left"><?php echo  $row->mv004.$row->mv004disp;?></td>
		  <td class="center"><?php echo  $row->mv005;?></td>		                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pal/pali13/del/'.$row->mv001."/".trim($row->mv003))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><a href="<?php echo site_url('pal/pali13/see/'.$row->mv001.'/'.$row->mv003)?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>                 
		  <td class="center"><a href="<?php echo site_url('pal/pali13/updform/'.$row->mv001.'/'.$row->mv003)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
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
   // window.open('/index.php/pal/pali13/printdetail')
	window.location="<?php echo base_url()?>index.php/pal/pali13/printdetail";
  }

function open_winexcel()
  {
   //  window.open('/index.php/pal/pali13/exceldetail')
	window.location="<?php echo base_url()?>index.php/pal/pali13/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_mv001 = $('input[name=\'filter_mv001\']').attr('value');
	if (filter_mv001) {
		url = '<?php echo base_url() ?>index.php/pal/pali13/filter1/mv001/desc/' + encodeURIComponent(filter_mv001);
	}
	
	var filter_mv001disp = $('input[name=\'filter_mv001disp\']').attr('value');
	if (filter_mv001disp) {
		url = '<?php echo base_url() ?>index.php/pal/pali13/filter1/mv001disp/desc/' + encodeURIComponent(filter_mv001disp);
	} 
	
	var filter_mv002 = $('input[name=\'filter_mv002\']').attr('value');
	if (filter_mv002) {
		url = '<?php echo base_url() ?>index.php/pal/pali13/filter1/mv002/desc/' + encodeURIComponent(filter_mv002);
	}
	var filter_mv002disp = $('input[name=\'filter_mv002disp\']').attr('value');
	if (filter_mv002disp) {
		url = '<?php echo base_url() ?>index.php/pal/pali13/filter1/mv002disp/desc/' + encodeURIComponent(filter_mv002disp);
	}
    
	var filter_mv003 = $('input[name=\'filter_mv003\']').attr('value');
	if (filter_mv003) {
		url = '<?php echo base_url() ?>index.php/pal/pali13/filter1/mv003/desc/' + encodeURIComponent(filter_mv003);
	}
	
	var filter_mv004 = $('input[name=\'filter_mv004\']').attr('value');
	if (filter_mv004) {
		url = '<?php echo base_url() ?>index.php/pal/pali13/filter1/mv004/desc/' + encodeURIComponent(filter_mv004); 
	}
	var filter_mv005 = $('input[name=\'filter_mv005\']').attr('value');
	if (filter_mv005) {
		url = '<?php echo base_url() ?>index.php/pal/pali13/filter1/mv005/desc/' + encodeURIComponent(filter_mv005); 
	}
	
    if (!filter_mv001 && !filter_mv001disp   && !filter_mv002 && !filter_mv002disp && !filter_mv003 && !filter_mv004 && !filter_mv005) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali13/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_mv001 = $('input[name=\'filter_mv001\']').attr('value');
	if (filter_mv001) {
		url = '<?php echo base_url() ?>index.php/pal/pali13/filter1/mv001/asc/' + encodeURIComponent(filter_mv001);
	}
	
	var filter_mv001disp = $('input[name=\'filter_mv001disp\']').attr('value');
	if (filter_mv001disp) {
		url = '<?php echo base_url() ?>index.php/pal/pali13/filter1/mv001disp/asc/' + encodeURIComponent(filter_mv001disp);
	} 
		
	var filter_mv002 = $('input[name=\'filter_mv002\']').attr('value');
	if (filter_mv002) {
		url = '<?php echo base_url() ?>index.php/pal/pali13/filter1/mv002/asc/' + encodeURIComponent(filter_mv002);
	}
	var filter_mv002disp = $('input[name=\'filter_mv002disp\']').attr('value');
	if (filter_mv002disp) {
		url = '<?php echo base_url() ?>index.php/pal/pali13/filter1/mv002disp/asc/' + encodeURIComponent(filter_mv002disp);
	}
	
	var filter_mv003 = $('input[name=\'filter_mv003\']').attr('value');
	if (filter_mv003) {
		url = '<?php echo base_url() ?>index.php/pal/pali13/filter1/mv003/asc/' + encodeURIComponent(filter_mv003);
	}	
	
	var filter_mv004 = $('input[name=\'filter_mv004\']').attr('value');
	if (filter_mv004) {
		url = '<?php echo base_url() ?>index.php/pal/pali13/filter1/mv004/asc/' + encodeURIComponent(filter_mv004); 
	}
	var filter_mv005 = $('input[name=\'filter_mv005\']').attr('value');
	if (filter_mv005) {
		url = '<?php echo base_url() ?>index.php/pal/pali13/filter1/mv005/asc/' + encodeURIComponent(filter_mv005); 
	}
	
    if (!filter_mv001 && !filter_mv001disp   && !filter_mv002  && !filter_mv002disp && !filter_mv003 && !filter_mv004 && !filter_mv005) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali13/display';location = url;
	   
	   }
	   
	location = url;
}
</script>