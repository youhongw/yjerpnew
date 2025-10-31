<div class="box2">  <!-- div-1 -->
  <div class="heading">
    <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 分錄性質設定(結帳單) - 瀏覽　　　</h1>
	<div style="float:left; "> 
	   <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/ajs/ajsi07/clear_sql_term'"  style="float:left" accesskey="a" class="button"><span>重整 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	    <a onclick="location = '<?php echo base_url()?>index.php/ajs/ajsi07/addform'"  style="float:left" accesskey="i" class="button"><span>新增 i </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	   <!-- <a onclick="location = '<?php echo base_url()?>index.php/ajs/ajsi07/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	-->
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	    <a onclick="location = '<?php echo base_url()?>index.php/ajs/ajsi07/findform'"  style="float:left" accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	    <a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>刪除 - </span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	 <!--   <a onclick="location = '<?php echo base_url()?>index.php/ajs/ajsi07/printdetail'"  style="float:left"   accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  -->
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	 <!--   <a onclick="location = '<?php echo base_url()?>index.php/ajs/ajsi07/exceldetail'"  style="float:left"   accesskey="l" class="button"><span>轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a>  -->
	  <?PHP } ?>
	<a onclick="location = '<?php echo base_url()?>index.php/main/index/161'"  style="float:left" accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
    </div>
  </div>
	
  <div class="content">  <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/ajs/ajsi07/delete" method="post" enctype="multipart/form-data" id="form">
      <table class="list">      <!-- 表格開始 -->
        <thead>
          <tr>                          <!-- 表格表頭 -->
            <td width="1%" style="text-align: center;">
		      <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	        </td>
	        <td width="6%" class="center">
		      <?php echo anchor("ajs/ajsi07/display/mb001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?> 
	        </td>
	        <td width="5%" class="center">
	          <?php echo anchor("ajs/ajsi07/display/mb001/" . (($sort_order == 'asc' && $sort_by == 'mb001') ? 'desc' : 'asc') ,'結帳單性質61'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="5%" class="center"> 
		      <?php echo anchor("ajs/ajsi07/display/mb002/" . (($sort_order == 'asc' && $sort_by == 'mb002') ? 'desc' : 'asc') ,'結帳單別'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="5%" class="center"> 
		      <?php echo anchor("ajs/ajsi07/display/mb003/" . (($sort_order == 'asc' && $sort_by == 'mb003') ? 'desc' : 'asc') ,'傳票單別'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
            </td>
			<td width="5%" class="center"> 
		      <?php echo anchor("ajs/ajsi07/display/mb004/" . (($sort_order == 'asc' && $sort_by == 'mb004') ? 'desc' : 'asc') ,'底稿開立方式'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
            </td>
			<td width="5%" class="center"> 
		      <?php echo anchor("ajs/ajsi07/display/mb018/" . (($sort_order == 'asc' && $sort_by == 'mb018') ? 'desc' : 'asc') ,'借方摘要來源'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
            </td>
	        <td width="3%" class="center">
		      <?php echo anchor("ajs/ajsi07/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="25%" class="center">&nbsp查看&nbsp</td>
            <td width="25%" class="center">&nbsp修改&nbsp</td>
          </tr>
        </thead>
		  
        <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	      <?php $filter_mb001='';$filter_mb002='';$filter_mb003='';$filter_create=''; ?>
	      <tr class="filter">
	        <td class="left"></td>
	        <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
            <td align="left">
		      <div class="button-search"></div>
		      <input type="text" id="filter_mb001" name="filter_mb001" value="" size="12" />
		     </div>  
	        </td>
			  
	        <td class="left">
		     <div  class="button-search"></div>
			 <input type="text" id="filter_mb002" name="filter_mb002" value="" size="12"/>
			 </div>  
		    </td>
			  
	        <td class="left">
		     <div class="button-search"></div>
			 <input type="text" name="filter_mb003" value="" size="12"/>
		       </div>  			  
	        </td>
			<td class="left">
		     <div class="button-search"></div>
			 <input type="text" name="filter_mb004" value="" size="12"/>
		       </div>  			  
	        </td>
			<td class="left">
		     <div class="button-search"></div>
			 <input type="text" name="filter_mb018" value="" size="12"/>
		       </div>  			  
	        </td>
	      
	        <td align="left">
		      <div class="button-search"></div>
		      <input type="text" name="filter_create" value="" size="12" />
			  </div>  
		    </td>
	        <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	        <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
          </tr>
		  <tbody>
		<!--session 變數取消 	  -->
		<?php $this->session->unset_userdata('mb002'); ?> 
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->mb001."/".trim($row->mb002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>		
		  <td class="left"><?php echo  $row->mb001;?></td>			  
		  <td class="left"><?php echo  $row->mb002;?></td>
		  <td class="left"><?php echo  $row->mb003;?></td>	
          <td class="left"><?php echo  $row->mb004;?></td>
          <td class="left"><?php echo  $row->mb018;?></td>		  
		  <td class="center"><?php echo  substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>		                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('ajs/ajsi07/del/'.$row->mb001)?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><a href="<?php echo site_url('ajs/ajsi07/see/'.$row->mb001)?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
            <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?> 
		  <td class="center"><a href="<?php echo site_url('ajs/ajsi07/updform/'.$row->mb001)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
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

<!-- 篩選  -->
<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_mb001 = $('input[name=\'filter_mb001\']').val();
	if (filter_mb001) {
		url = '<?php echo base_url() ?>index.php/ajs/ajsi07/filter1/mb001/desc/' + encodeURIComponent(filter_mb001);
	}
	
	var filter_mb002 = $('input[name=\'filter_mb002\']').val();
	if (filter_mb002) {
		url = '<?php echo base_url() ?>index.php/ajs/ajsi07/filter1/mb002/desc/' + encodeURIComponent(filter_mb002);
	} 
	
	var filter_mb003 = $('input[name=\'filter_mb003\']').val();
	if (filter_mb003) {
		url = '<?php echo base_url() ?>index.php/ajs/ajsi07/filter1/mb003/desc/' + encodeURIComponent(filter_mb003);
	}
	var filter_mb004 = $('input[name=\'filter_mb004\']').val();
	if (filter_mb004) {
		url = '<?php echo base_url() ?>index.php/ajs/ajsi07/filter1/mb004/desc/' + encodeURIComponent(filter_mb004);
	}
	var filter_mb018 = $('input[name=\'filter_mb018\']').val();
	if (filter_mb018) {
		url = '<?php echo base_url() ?>index.php/ajs/ajsi07/filter1/mb018/desc/' + encodeURIComponent(filter_mb018);
	}
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/ajs/ajsi07/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_mb001 && !filter_mb002  && !filter_mb003  && !filter_mb004 && !filter_mb018 &&  !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/ajs/ajsi07/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_mb001 = $('input[name=\'filter_mb001\']').val();
	if (filter_mb001) {
		url = '<?php echo base_url() ?>index.php/ajs/ajsi07/filter1/mb001/asc/' + encodeURIComponent(filter_mb001);
	}
	
	var filter_mb002 = $('input[name=\'filter_mb002\']').val();
	if (filter_mb002) {
		url = '<?php echo base_url() ?>index.php/ajs/ajsi07/filter1/mb002/asc/' + encodeURIComponent(filter_mb002);
	} 
	
	var filter_mb003 = $('input[name=\'filter_mb003\']').val();
	if (filter_mb003) {
		url = '<?php echo base_url() ?>index.php/ajs/ajsi07/filter1/mb003/asc/' + encodeURIComponent(filter_mb003);
	}
	var filter_mb004 = $('input[name=\'filter_mb004\']').val();
	if (filter_mb004) {
		url = '<?php echo base_url() ?>index.php/ajs/ajsi07/filter1/mb004/asc/' + encodeURIComponent(filter_mb004);
	}
	var filter_mb018 = $('input[name=\'filter_mb018\']').val();
	if (filter_mb018) {
		url = '<?php echo base_url() ?>index.php/ajs/ajsi07/filter1/mb018/asc/' + encodeURIComponent(filter_mb018);
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/ajs/ajsi07/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_mb001 && !filter_mb002  && !filter_mb003  && !filter_mb004  && !filter_mb018 && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/ajs/ajsi07/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 
 
