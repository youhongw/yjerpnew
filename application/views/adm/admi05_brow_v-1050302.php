 <div class="box2">  <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 使用者權限建立作業 - 瀏覽</h1>
       <!--  <div class="buttons"> -->
	   <div style="float:right; "> 
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/adm/admi05/addform'"  style="float:left" accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/adm/admi05/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/adm/admi05/findform'"  style="float:left" accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>選取刪除</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/adm/admi05/printdetail'"   style="float:left"  accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/adm/admi05/exceldetail'"  style="float:left"   accesskey="l" class="button"><span>轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a>  
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/adm/admi05/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/adm/admi05/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/10'" style="float:left"  accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content">  <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/adm/admi05/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="6%" class="center">
		    <?php echo anchor("adm/admi05/display/mg001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?> 
	      </td>
	      <td width="5%" class="center">
	        <?php echo anchor("adm/admi05/display/mg001/" . (($sort_order == 'asc' && $sort_by == 'mg001') ? 'desc' : 'asc') ,'使用者代號'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="center"> 
		    <?php echo anchor("adm/admi05/display/mg002/" . (($sort_order == 'asc' && $sort_by == 'mg002') ? 'desc' : 'asc') ,'程式代碼'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="center"> 
		    <?php echo anchor("adm/admi05/display/mg004/" . (($sort_order == 'asc' && $sort_by == 'mg004') ? 'desc' : 'asc') ,'執行權限'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
          </td>
		  <td width="5%" class="center"> 
		    <?php echo anchor("adm/admi05/display/mg006/" . (($sort_order == 'asc' && $sort_by == 'mg006') ? 'desc' : 'asc') ,'基本權限'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
          </td>
		  <td width="5%" class="center"> 
		    <?php echo anchor("adm/admi05/display/mg007/" . (($sort_order == 'asc' && $sort_by == 'mg007') ? 'desc' : 'asc') ,'群組權限'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
          </td>
		  <td width="5%" class="center"> 
		    <?php echo anchor("adm/admi05/display/mg008/" . (($sort_order == 'asc' && $sort_by == 'mg008') ? 'desc' : 'asc') ,'他組權限'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
          </td>
	      
	      <td width="25%" class="center">&nbsp查看&nbsp</td>
          <td width="25%" class="center">&nbsp修改&nbsp</td>
        </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_mg001='';$filter_mg002='';$filter_mg004='';$filter_mg006='';$filter_mg007='';$filter_mg008='';$filter_create=''; ?>
	    <tr class="filter">
	      <td class="left"></td>
	      <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
          <td align="left">
		  <div class="button-search"></div>
		  <input type="text" id="filter_mg001" name="filter_mg001" value="" />
	      </td>
			  
	      <td class="left">
		  <div  class="button-search"></div>
		  <input type="text" id="filter_mg002" name="filter_mg002" value="" />
		  </td>
			  
	      <td class="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_mg004" value="" />
	      </td>
		  
		  <td class="left">
		  <div class="button-search"></div>
			<input type="text" name="filter_mg006" value="" />
	      </div>
		  </td>
		  
		  <td class="left">
		  <div class="button-search"></div>
			<input type="text" name="filter_mg007" value="" />
	      </div>
		  </td>
		  
		  <td class="left">
		  <div class="button-search"></div>
			<input type="text" name="filter_mg008" value="" />
	      </div>
		  </td>	
	      
	      <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td>  
	    
        </tr>
		
		<!--session 變數取消 	  -->
		<?php $this->session->unset_userdata('mg002'); ?> 
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->mg001."/".trim($row->mg002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>		
		  <td class="left"><?php echo  $row->mg001;?></td>			  
		  <td class="left"><?php echo  $row->mg002;?></td>
		  <td class="left"><?php echo  $row->mg004;?></td>
          <td class="left"><?php echo  $row->mg006;?></td>		
          <td class="left"><?php echo  $row->mg007;?></td>	
          <td class="left"><?php echo  $row->mg008;?></td>			   
	      <!-- <td class="center"><?php echo  substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>	-->	                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('adm/admi05/del/'.$row->mg001)?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><a href="<?php echo site_url('adm/admi05/see/'.$row->mg001)?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?> 
          <td class="center"><a href="<?php echo site_url('adm/admi05/updform/'.$row->mg001.'/'.$row->mg002)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
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
 </div> <!-- div-1 -->
</div>	<!-- div-0 -->

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
    window.open('/index.php/adm/admi05/printdetail')
  }

function open_winexcel()
  {
    window.open('/index.php/adm/admi05/exceldetail')
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_mg001 = $('input[name=\'filter_mg001\']').val();
	if (filter_mg001) {
		url = '<?php echo base_url() ?>index.php/adm/admi05/filter1/mg001/desc/' + encodeURIComponent(filter_mg001);
		
	}
	
	var filter_mg002 = $('input[name=\'filter_mg002\']').val();
	if (filter_mg002) {
		url = '<?php echo base_url() ?>index.php/adm/admi05/filter1/mg002/desc/' + encodeURIComponent(filter_mg002);
	} 
	
	var filter_mg004 = $('input[name=\'filter_mg004\']').val();
	if (filter_mg004) {
		url = '<?php echo base_url() ?>index.php/adm/admi05/filter1/mg004/desc/' + encodeURIComponent(filter_mg004);
	}
	
	var filter_mg006 = $('input[name=\'filter_mg006\']').val();
	if (filter_mg006) {
		url = '<?php echo base_url() ?>index.php/adm/admi06/filter1/mg006/desc/' + encodeURIComponent(filter_mg006);
	}
	var filter_mg007 = $('input[name=\'filter_mg007\']').val();
	if (filter_mg007) {
		url = '<?php echo base_url() ?>index.php/adm/admi05/filter1/mg007/desc/' + encodeURIComponent(filter_mg007);
	}
	var filter_mg008 = $('input[name=\'filter_mg008\']').val();
	if (filter_mg008) {
		url = '<?php echo base_url() ?>index.php/adm/admi05/filter1/mg008/desc/' + encodeURIComponent(filter_mg008);
	}
	
    if (!filter_mg001  && !filter_mg002  && !filter_mg004 && !filter_mg006 && !filter_mg007 && !filter_mg008) {         
	   url = '<?php echo base_url() ?>index.php/adm/admi05/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_mg001 = $('input[name=\'filter_mg001\']').val();
	if (filter_mg001) {
		url = '<?php echo base_url() ?>index.php/adm/admi05/filter1/mg001/asc/' + encodeURIComponent(filter_mg001);
	}
	
	var filter_mg002 = $('input[name=\'filter_mg002\']').val();
	if (filter_mg002) {
		url = '<?php echo base_url() ?>index.php/adm/admi05/filter1/mg002/asc/' + encodeURIComponent(filter_mg002);
	} 
	
	var filter_mg004 = $('input[name=\'filter_mg004\']').val();
	if (filter_mg004) {
		url = '<?php echo base_url() ?>index.php/adm/admi05/filter1/mg004/asc/' + encodeURIComponent(filter_mg004);
	}
	
	var filter_mg006 = $('input[name=\'filter_mg006\']').val();
	if (filter_mg006) {
		url = '<?php echo base_url() ?>index.php/adm/admi05/filter1/mg006/asc/' + encodeURIComponent(filter_mg006);
	}
	var filter_mg007 = $('input[name=\'filter_mg007\']').val();
	if (filter_mg007) {
		url = '<?php echo base_url() ?>index.php/adm/admi05/filter1/mg007/asc/' + encodeURIComponent(filter_mg007);
	}
	var filter_mg008 = $('input[name=\'filter_mg008\']').val();
	if (filter_mg008) {
		url = '<?php echo base_url() ?>index.php/adm/admi05/filter1/mg008/asc/' + encodeURIComponent(filter_mg008);
	}
	
    if (!filter_mg001 && !filter_mg002  && !filter_mg004  && !filter_mg006  && !filter_mg007  && !filter_mg008) {         
	   url = '<?php echo base_url() ?>index.php/adm/admi05/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 