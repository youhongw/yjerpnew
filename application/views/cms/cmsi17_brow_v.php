<div class="box2">  <!-- div-1 -->
  <div class="heading">
    <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 註記簽核資料建立作業 - 瀏覽　　　</h1>
    <!--  <div class="buttons"> -->
	   <div style="float:left; "> 
	    <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi17/clear_sql_term'"  style="float:left" accesskey="a" class="button"><span>重整 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	<?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	<a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi17/addform'"  style="float:left"  accesskey="i" class="button"><span>新增 i </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	<?PHP } ?>
	<?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	<a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi17/copyform'"  style="float:left"  accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
    <?PHP } ?>
	<?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	<a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi17/findform'"  style="float:left"  accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>	
    <?PHP } ?>
	<?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	<a onclick="$('form').submit();"  style="float:left"   accesskey="-" class="button"><span>刪除 - </span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	<?PHP } ?>
	<?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	<a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi17/printdetail'"    style="float:left"  accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  
	<?PHP } ?>
	<?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	<a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi17/exceldetail'"    style="float:left"  accesskey="l" class="button"><span>EXCEL l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a>  
	<?PHP } ?>
	<!-- <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi17/printdetail'"  class="button"><span>列印</span></a>
	<a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi17/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	<a onclick="location = '<?php echo base_url()?>index.php/main/index/101'"  style="float:left"  accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
    </div>
  </div>
	
  <div class="content">  <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/cms/cmsi17/delete" method="post" enctype="multipart/form-data" id="form">
      <table class="list">      <!-- 表格開始 -->
        <thead>
          <tr>                          <!-- 表格表頭 -->
            <td width="1%" style="text-align: center;">
		      <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	        </td>
	        <td width="6%" class="center">
		      <?php echo anchor("cms/cmsi17/display/ms001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?> 
	        </td>
	        <td width="7%" class="center">
	          <?php echo anchor("cms/cmsi17/display/ms001/" . (($sort_order == 'asc' && $sort_by == 'ms001') ? 'desc' : 'asc') ,'註檢代號'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="5%" class="center"> 
		      <?php echo anchor("cms/cmsi17/display/ms002/" . (($sort_order == 'asc' && $sort_by == 'ms002') ? 'desc' : 'asc') ,'代號'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="5%" class="center"> 
		      <?php echo anchor("cms/cmsi17/display/ms003/" . (($sort_order == 'asc' && $sort_by == 'ms003') ? 'desc' : 'asc') ,'名稱'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
            </td>
			<td width="5%" class="center"> 
		      <?php echo anchor("cms/cmsi17/display/ms004/" . (($sort_order == 'asc' && $sort_by == 'ms004') ? 'desc' : 'asc') ,'註記檢核1'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
            </td>
			<td width="5%" class="center"> 
		      <?php echo anchor("cms/cmsi17/display/ms005/" . (($sort_order == 'asc' && $sort_by == 'ms005') ? 'desc' : 'asc') ,'註記檢核2'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
            </td>
			<td width="5%" class="center"> 
		      <?php echo anchor("cms/cmsi17/display/ms006/" . (($sort_order == 'asc' && $sort_by == 'ms006') ? 'desc' : 'asc') ,'註記檢核3'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
            </td>
	        <td width="5%" class="center">
		      <?php echo anchor("cms/cmsi17/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="23%" class="center">&nbsp查看&nbsp</td>
            <td width="23%" class="center">&nbsp修改&nbsp</td>
          </tr>
        </thead>
		  
       <!-- <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	      <?php $filter_ms001='*';$filter_ms002='';$filter_ms003='';$filter_ms004='';$filter_ms005='';$filter_ms006='';$filter_create=''; ?>
	      <tr class="filter">
	        <td class="left"></td>
	        <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
            <td align="left">
		      <div class="button-search"></div>
		       <select name="filter_ms001" >
                     <option value="*"></option>
                     <option  value="1">1.註記</option>
                     <option  value="2">2.簽核</option>                                                            
               </select>
			   
	        </td>
			  
	        <td class="left">
		     <div  class="button-search"></div>
			 <input type="text" id="filter_ms002" name="filter_ms002" value="" size="14" />
			 
		    </td>
			  
	        <td class="left">
		     <div class="button-search"></div>
			 <input type="text" name="filter_ms003" value="" size="14"/>
		       			  
	        </td>
			<td class="left">
		     <div class="button-search"></div>
			 <input type="text" name="filter_ms004" value="" size="14"/>
		        			  
	        </td>
			<td class="left">
		     <div class="button-search"></div>
			 <input type="text" name="filter_ms005" value="" size="14"/>
		      			  
	        </td>
			<td class="left">
		     <div class="button-search"></div>
			 <input type="text" name="filter_ms006" value="" size="14"/>
		         			  
	        </td>
	      
	        <td align="left">
		      <div class="button-search"></div>
		      <input type="text" name="filter_create" value="" size="14" />
		    </td>
	        <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	        <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
          </tr>
		  <tbody>
		<!--session 變數取消 	  -->
		<?php $this->session->unset_userdata('ms002'); ?> 
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->ms001."/".trim($row->ms002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>		
		  <td class="left"><?php echo  $row->ms001;?></td>			  
		  <td class="left"><?php echo  $row->ms002;?></td>
		  <td class="left"><?php echo  $row->ms003;?></td>
          <td class="left"><?php echo  $row->ms004;?></td>	
          <td class="left"><?php echo  $row->ms005;?></td>	
          <td class="left"><?php echo  $row->ms006;?></td>			  
		  <td class="center"><?php echo  substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>		                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('cms/cmsi17/del/'.$row->ms001)?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><a href="<?php echo site_url('cms/cmsi17/see/'.$row->ms001.'/'.$row->ms002)?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
            <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?> 
		  <td class="center"><a href="<?php echo site_url('cms/cmsi17/updform/'.$row->ms001.'/'.$row->ms002)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
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
    
   </div>  <!-- div-2 -->
 </div>    <!-- div-1 --> 
</div>	

<!--列印及轉excel 開新視窗  -->
<script>                    
function open_winprint()
  {
    window.open('/index.php/cms/cmsi17/printdetail')
  }

function open_winexcel()
  {
    window.open('/index.php/cms/cmsi17/exceldetail')
  }
</script>

<!-- 篩選  -->
<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_ms001 = $('select[name=\'filter_ms001\']').val();
	if (filter_ms001 != '*') {
		url = '<?php echo base_url() ?>index.php/cms/cmsi17/filter1/ms001/desc/' + encodeURIComponent(filter_ms001);
	}
	
	var filter_ms002 = $('input[name=\'filter_ms002\']').val();
	if (filter_ms002) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi17/filter1/ms002/desc/' + encodeURIComponent(filter_ms002);
	} 
	
	var filter_ms003 = $('input[name=\'filter_ms003\']').val();
	if (filter_ms003) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi17/filter1/ms003/desc/' + encodeURIComponent(filter_ms003);
	}
	var filter_ms004 = $('input[name=\'filter_ms004\']').val();
	if (filter_ms004) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi17/filter1/ms004/desc/' + encodeURIComponent(filter_ms004);
	}
	var filter_ms005 = $('input[name=\'filter_ms005\']').val();
	if (filter_ms005) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi17/filter1/ms005/desc/' + encodeURIComponent(filter_ms005);
	}
	var filter_ms006 = $('input[name=\'filter_ms006\']').val();
	if (filter_ms006) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi17/filter1/ms006/desc/' + encodeURIComponent(filter_ms006);
	}
		
	
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi17/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if (filter_ms001 == '*' && !filter_ms002  && !filter_ms003 && !filter_ms004 && !filter_ms005 && !filter_ms006 &&  !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/cms/cmsi17/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_ms001 = $('select[name=\'filter_ms001\']').val();
	if (filter_ms001 != '*') {
		url = '<?php echo base_url() ?>index.php/cms/cmsi17/filter1/ms001/asc/' + encodeURIComponent(filter_ms001);
	}
	
	var filter_ms002 = $('input[name=\'filter_ms002\']').val();
	if (filter_ms002) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi17/filter1/ms002/asc/' + encodeURIComponent(filter_ms002);
	} 
	
	var filter_ms003 = $('input[name=\'filter_ms003\']').val();
	if (filter_ms003) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi17/filter1/ms003/asc/' + encodeURIComponent(filter_ms003);
	}
	var filter_ms004 = $('input[name=\'filter_ms004\']').val();
	if (filter_ms004) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi17/filter1/ms004/asc/' + encodeURIComponent(filter_ms004);
	}
	var filter_ms005 = $('input[name=\'filter_ms005\']').val();
	if (filter_ms005) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi17/filter1/ms005/asc/' + encodeURIComponent(filter_ms005);
	}
	var filter_ms006 = $('input[name=\'filter_ms006\']').val();
	if (filter_ms006) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi17/filter1/ms006/asc/' + encodeURIComponent(filter_ms006);
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi17/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (filter_ms001 == '*' && !filter_ms002  && !filter_ms003 && !filter_ms004 && !filter_ms005 && !filter_ms006  && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/cms/cmsi17/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 
 
<!-- </div>	-->  