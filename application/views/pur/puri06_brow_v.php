  <div class="box2">  <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 請購資料維護作業 - 瀏覽　　　</h1>
      <!--  <div class="buttons"> -->
	   <div style="float:left; "> 
	       <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/puri06/clear_sql_term'"  style="float:left" accesskey="a" class="button"><span>重整 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),990,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/puri06/addform'"  style="float:left" accesskey="i" class="button"><span>新增 i </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),999,1)=='Y') { ?>
	   <a onclick="location = '<?php echo base_url()?>index.php/pur/puri06/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>    
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/puri06/findform'"  style="float:left" accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>   
      <?PHP if (substr($this->session->userdata('sysmg006'),993,1)=='Y') { ?>	  
	  <a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>刪除 - </span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	  <?PHP } ?>   
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/puri06/printdetailc'"   style="float:left"  accesskey="p" class="button"><span>印單據多筆 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  
	  <?PHP } ?> 
      <?PHP if (substr($this->session->userdata('sysmg006'),9910,1)=='Y') { ?>	 
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/puri06/exceldetail'"   style="float:left"  accesskey="l" class="button"><span>EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a>  
	  <?PHP } ?> 
	  <!-- <a onclick="open_winprint();"  onclick="location = '<?php echo base_url()?>index.php/pur/puri06/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/puri06/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/103'"  style="float:left" accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/pur/puri06/delete" method="post" enctype="multipart/form-data" id="form">
      <table class="list">      <!-- 表格開始 -->
        <thead>
		  
          <tr>                          <!-- 表格表頭 -->
            <td width="1%" style="text-align: center;">
		     <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	        </td>
	        <td width="6%" class="center">
		     <?php echo anchor("pur/puri06/display/tb001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?> 
	        </td>
	        <td width="5%" class="center">
	         <?php echo anchor("pur/puri06/display/tb001/" . (($sort_order == 'asc' && $sort_by == 'tb001') ? 'desc' : 'asc') ,'單別'); ?>
			 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		     <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="5%" class="center"> 
		    <?php echo anchor("pur/puri06/display/tb002/" . (($sort_order == 'asc' && $sort_by == 'tb002') ? 'desc' : 'asc') ,'單號'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="5%" class="center"> 
		    <?php echo anchor("pur/puri06/display/tb003/" . (($sort_order == 'asc' && $sort_by == 'tb003') ? 'desc' : 'asc') ,'序號'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
            </td>
	        <td width="5%" class="center">
	        <?php echo anchor("pur/puri06/display/tb004/" .(($sort_order == 'asc' && $sort_by == 'tb004') ? 'desc' : 'asc') ,'品號'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	        </td>
	        <td width="5%" class="center">
		    <?php echo anchor("pur/puri06/display/tb005/" . (($sort_order == 'asc' && $sort_by == 'tb005') ? 'desc' : 'asc') ,'品名'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="5%" class="center">
		    <?php echo anchor("pur/puri06/display/tb006/" . (($sort_order == 'asc' && $sort_by == 'tb006') ? 'desc' : 'asc') ,'規格'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="3%" class="center">
		    <?php echo anchor("pur/puri06/display/tb010/" . (($sort_order == 'asc' && $sort_by == 'tb010') ? 'desc' : 'asc') ,'供應商'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="15%" class="center">&nbsp查看&nbsp</td>
          <td width="15%" class="center">&nbsp修改&nbsp</td>
          <td width="20%" class="center">&nbsp印請購明細&nbsp</td>
         </tr>
        </thead>
		  
       <!-- <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	    <?php $filter_tb001='*';$filter_tb002='';$filter_tb003='';$filter_tb004='';$filter_tb005='';$filter_tb006='';$filter_create=''; ?>
	    <tr class="filter">
	      <td class="left"></td>
	      <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
          <td align="left">
		   <div class="button-search"></div>
		    <div  class="button-search"></div>
		   <input type="text" id="filter_tb001" name="filter_tb001" value="" size="10" />
		   </div>
	      </td>
			  
	      <td class="left">
		   <div  class="button-search"></div>
		   <input type="text" id="filter_tb002" name="filter_tb002" value="" size="10"/>
		   </div>
		  </td>
			  
	      <td class="left">
		    <div class="button-search"></div>
			<input type="text" name="filter_tb003" value="" size="10" />
	      </td>
			  
	      <td align="left">
		    <div class="button-search"></div>
		    <input type="text" name="filter_tb004" value="" size="15"  />
		  </td>
          <td align="left">
		    <div class="button-search"></div>
		    <input type="text" name="filter_tb005" value="" size="15"  />
		  </td>
	      <td align="left">
		    <div class="button-search"></div>
		    <input type="text" name="filter_tb006" value="" size="15"  />
		  </td>
	      <td align="left">
		    <div class="button-search"></div>
		    <input type="text" name="filter_create" value="" size="15" />
		  </td>
		  
	      <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td>
		  <td></td>
	      <!-- <button type='submit'  name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
        </tr>
		<tbody>
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->tb001."/".trim($row->tb002)."/".trim($row->tb003)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>		
		  <td class="left"><?php echo  $row->tb001;?></td>			  
		  <td class="left"><?php echo  $row->tb002;?></td>
		  <td class="left"><?php echo  $row->tb003;?></td>
		  <td class="left"><?php echo  $row->tb004;?></td>
		  <td class="left"><?php echo  $row->tb005;?></td>
		  <td class="left"><?php echo  $row->tb006;?></td>
		  <td class="left"><?php echo  $row->tb010;?></td>	                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pur/puri06/del/'.$row->tb001."/".trim($row->tb002))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
	  	 
		  <td class="center"><a href="<?php echo site_url('pur/puri06/see/'.$row->tb001."/".trim($row->tb002)."/".trim($row->tb003))?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
      
		 <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>	 
          	  
		  <td class="center"><a href="<?php echo site_url('pur/puri06/updform/'.$row->tb001."/".trim($row->tb002)."/".trim($row->tb003))?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
	      <?PHP } ?>
		  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
		  <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pur/puri06/printa/a.tb001/desc/0/'.$row->tb002."/".$row->tb003)?>" id="print1"  >[ 印單據 </a><img src="<?php echo base_url()?>assets/image/png/Print1.png" />]</td>
	      <?PHP } ?>
		</tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
          </tbody>		 
        </table>
		     <!-- 修改時 留在原來那一筆資料使用 -->
	     <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>
		 <?php  $this->session->set_userdata('search1',"display/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>    
			<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      </form>
    </div> <!-- div-2 -->
   </div> <!-- div-1 -->
</div>	 <!-- div-0 -->

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
  //  window.open('/index.php/pur/puri06/printdetail')
	window.location="<?php echo base_url()?>index.php/pur/puri06/printdetail";
  }

function open_winexcel()
  {
  //  window.open('/index.php/pur/puri06/exceldetail')
	window.location="<?php echo base_url()?>index.php/pur/puri06/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_tb001 = $('input[name=\'filter_tb001\']').attr('value');
	if (filter_tb001) {
		url = '<?php echo base_url() ?>index.php/pur/puri06/filter1/tb001/desc/' + encodeURIComponent(filter_tb001);
	}
	
	var filter_tb002 = $('input[name=\'filter_tb002\']').attr('value');
	if (filter_tb002) {
		url = '<?php echo base_url() ?>index.php/pur/puri06/filter1/tb002/desc/' + encodeURIComponent(filter_tb002);
	} 
	
	var filter_tb003 = $('input[name=\'filter_tb003\']').attr('value');
	if (filter_tb003) {
		url = '<?php echo base_url() ?>index.php/pur/puri06/filter1/tb003/desc/' + encodeURIComponent(filter_tb003);
	}
		
	var filter_tb004 = $('input[name=\'filter_tb004\']').attr('value');
	if (filter_tb004) {
		url = '<?php echo base_url() ?>index.php/pur/puri06/filter1/tb004/desc/' + encodeURIComponent(filter_tb004); 
	}
	
	var filter_tb005 = $('input[name=\'filter_tb005\']').attr('value');
	if (filter_tb005) {
		url = '<?php echo base_url() ?>index.php/pur/puri06/filter1/tb005/desc/' + encodeURIComponent(filter_tb005); 
	}
	
	var filter_tb006 = $('input[name=\'filter_tb006\']').attr('value');
	if (filter_tb006) {
		url = '<?php echo base_url() ?>index.php/pur/puri06/filter1/tb006/desc/' + encodeURIComponent(filter_tb006); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/pur/puri06/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_tb001 && !filter_tb002  && !filter_tb003 && !filter_tb004  && !filter_tb005 && !filter_tb006 && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/pur/puri06/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_tb001 = $('input[name=\'filter_tb001\']').attr('value');
	if (filter_tb001) {
		url = '<?php echo base_url() ?>index.php/pur/puri06/filter1/tb001/asc/' + encodeURIComponent(filter_tb001);
	}
	
	var filter_tb002 = $('input[name=\'filter_tb002\']').attr('value');
	if (filter_tb002) {
		url = '<?php echo base_url() ?>index.php/pur/puri06/filter1/tb002/asc/' + encodeURIComponent(filter_tb002);
	} 
	
	var filter_tb003 = $('input[name=\'filter_tb003\']').attr('value');
	if (filter_tb003) {
		url = '<?php echo base_url() ?>index.php/pur/puri06/filter1/tb003/asc/' + encodeURIComponent(filter_tb003);
	}
		
	var filter_tb004 = $('input[name=\'filter_tb004\']').attr('value');
	if (filter_tb004) {
		url = '<?php echo base_url() ?>index.php/pur/puri06/filter1/tb004/asc/' + encodeURIComponent(filter_tb004); 
	}
	
	var filter_tb005 = $('input[name=\'filter_tb005\']').attr('value');
	if (filter_tb005) {
		url = '<?php echo base_url() ?>index.php/pur/puri06/filter1/tb005/asc/' + encodeURIComponent(filter_tb005); 
	}
	
	var filter_tb006 = $('input[name=\'filter_tb006\']').attr('value');
	if (filter_tb006) {
		url = '<?php echo base_url() ?>index.php/pur/puri06/filter1/tb006/asc/' + encodeURIComponent(filter_tb006); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/pur/puri06/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_tb001 && !filter_tb002  && !filter_tb003 && !filter_tb004  && !filter_tb005 && !filter_tb006 && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/pur/puri06/display';location = url;
	   
	   }
	   
	location = url;
}
</script>