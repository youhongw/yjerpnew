  <div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 刷卡資料維護作業 - 瀏覽</h1>
       <!--  <div class="buttons"> -->
	   <div style="float:right; "> 
	    <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali52/clear_sql_term'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali52/addform'" style="float:left" accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali52/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali52/findform'"  style="float:left" accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
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
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/pal/pali52/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali52/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/111'"  style="float:left" accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/pal/pali52/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
        <thead>
         <tr>                          <!-- 表格表頭 -->
          <td width="1%" style="text-align: center;">
		   <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		   <?php echo anchor("pal/pali52/display/te001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?> 
	      </td>
	      <td width="5%" class="left">
	        <?php echo anchor("pal/pali52/display/te001/" . (($sort_order == 'asc' && $sort_by == 'te001') ? 'desc' : 'asc') ,'員工代號'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		   <?php echo anchor("pal/pali52/display/te001disp/" . (($sort_order == 'asc' && $sort_by == 'te001disp') ? 'desc' : 'asc') ,'員工姓名'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="16%" class="left"> 
		   <?php echo anchor("pal/pali52/display/te002/" . (($sort_order == 'asc' && $sort_by == 'te002') ? 'desc' : 'asc') ,'刷卡日期'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
          </td>
	      <td width="8%" class="left">
	        <?php echo anchor("pal/pali52/display/te003/" .(($sort_order == 'asc' && $sort_by == 'te003') ? 'desc' : 'asc') ,'刷卡時間'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("pal/pali52/display/te004/" . (($sort_order == 'asc' && $sort_by == 'te004') ? 'desc' : 'asc') ,'刷卡卡號'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("pal/pali52/display/te005/" . (($sort_order == 'asc' && $sort_by == 'te005') ? 'desc' : 'asc') ,'產生明細'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		   <?php echo anchor("pal/pali52/display/te007/" . (($sort_order == 'asc' && $sort_by == 'te007') ? 'desc' : 'asc') ,'功能碼'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		  <td width="7%" class="center">
		   <?php echo anchor("pal/pali52/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="18%" class="center">&nbsp查看管理&nbsp </td>
          <td width="18%" class="center">&nbsp修改管理&nbsp </td>
        </tr>
        </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_te001='';$filter_te001disp='';$filter_te002='';$filter_te003='';$filter_te004='';$filter_te005='';$filter_te007=''; ?>
	    <tr class="filter">
	     <td class="left"></td>
	     <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
         <td align="left">
		   <div class="button-search"></div>
		    <input type="text" id="filter_te001" name="filter_te001" value=""  size="12" />
		   </div>
	     </td>
			  
	      <td class="left">
		  <div  class="button-search"></div>
			<input type="text" readonly="value" id="filter_te001disp" name="filter_te001disp" value=""  style="background-color:#F5F5F5" />
		  </td>
		  
		    <td class="left">
		  <div  class="button-search"></div>
			<input type="text"  id="filter_te002" name="filter_te002" value=""    />
		  </td>
		  
	      <td class="left">
		   <div class="button-search"></div>
			<input type="text" readonly="value" name="filter_te003" value=""  size="12" style="background-color:#F5F5F5" />
		   </div>			  
	      </td>
		  <td class="left">
		   <div class="button-search"></div>
			<input type="text"  name="filter_te004" value=""   />
		   </div>			  
	      </td>
			 <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_te005" value=""   />
		   </div>			  
	      </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_te007" value="" />
		  </td>
		  <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_create_date" value="" />
		  </td>
	      <td  align="center"><a onclick="filter();" accesskey="q" class="button">篩選▲ q</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td>  
	      <!-- <button type='submit'  name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
        </tr>
		
		<!--session 變數取消 	  
		<?php $this->session->unset_userdata('te002'); ?> -->
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->te001."/".$row->te002."/".$row->te003 ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>		
		  <td class="left"><?php echo  $row->te001;?></td>			  
		  <td class="left"><?php echo  $row->te001disp;?></td>
		  <td class="left"><?php echo  substr($row->te002,0,4).'/'.substr($row->te002,4,2).'/'.substr($row->te002,6,2);?></td>
		  <td class="left"><?php echo  substr($row->te003,0,2).':'.substr($row->te003,2,2);?></td>
		  <td class="left"><?php echo  $row->te004;?></td>	
		  <td class="left"><?php echo  $row->te005;?></td>	
		  <td class="center"><?php echo   $row->te007;?></td>	
          <td class="center"><?php echo   $row->create_date;?></td>		  
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pal/pali52/del/'.$row->te001."/".trim($row->te003))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><a href="<?php echo site_url('pal/pali52/see/'.$row->te001."/".$row->te002."/".$row->te003)?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>                 
		  <td class="center"><a href="<?php echo site_url('pal/pali52/updform/'.$row->te001."/".$row->te002."/".$row->te003)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
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
   // window.open('/index.php/pal/pali52/printdetail')
	window.location="<?php echo base_url()?>index.php/pal/pali52/printdetail";
  }

function open_winexcel()
  {
   //  window.open('/index.php/pal/pali52/exceldetail')
	window.location="<?php echo base_url()?>index.php/pal/pali52/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_te001 = $('input[name=\'filter_te001\']').attr('value');
	if (filter_te001) {
		url = '<?php echo base_url() ?>index.php/pal/pali52/filter1/te001/desc/' + encodeURIComponent(filter_te001);
	}
	
	var filter_te001disp = $('input[name=\'filter_te001disp\']').attr('value');
	if (filter_te001disp) {
		url = '<?php echo base_url() ?>index.php/pal/pali52/filter1/te001disp/desc/' + encodeURIComponent(filter_te001disp);
	} 
	
	var filter_te002 = $('input[name=\'filter_te002\']').attr('value');
	if (filter_te002) {
		url = '<?php echo base_url() ?>index.php/pal/pali52/filter1/te002/desc/' + encodeURIComponent(filter_te002);
	}
	var filter_te003 = $('input[name=\'filter_te003\']').attr('value');
	if (filter_te003) {
		url = '<?php echo base_url() ?>index.php/pal/pali52/filter1/te003/desc/' + encodeURIComponent(filter_te003);
	}
    var filter_te004 = $('input[name=\'filter_te004\']').attr('value');
	if (filter_te004) {
		url = '<?php echo base_url() ?>index.php/pal/pali52/filter1/te004/desc/' + encodeURIComponent(filter_te004);
	}	
	var filter_te005 = $('input[name=\'filter_te005\']').attr('value');
	if (filter_te005) {
		url = '<?php echo base_url() ?>index.php/pal/pali52/filter1/te005/desc/' + encodeURIComponent(filter_te005);
	}
	
	var filter_te007 = $('input[name=\'filter_te007\']').attr('value');
	if (filter_te007) {
		url = '<?php echo base_url() ?>index.php/pal/pali52/filter1/te007/desc/' + encodeURIComponent(filter_te007); 
	}
	
    if (!filter_te001 && !filter_te001disp && !filter_te002 && !filter_te003 && !filter_te004 && !filter_te005 && !filter_te007) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali52/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_te001 = $('input[name=\'filter_te001\']').attr('value');
	if (filter_te001) {
		url = '<?php echo base_url() ?>index.php/pal/pali52/filter1/te001/asc/' + encodeURIComponent(filter_te001);
	}
	
	var filter_te001disp = $('input[name=\'filter_te001disp\']').attr('value');
	if (filter_te001disp) {
		url = '<?php echo base_url() ?>index.php/pal/pali52/filter1/te001disp/asc/' + encodeURIComponent(filter_te001disp);
	} 
		
	var filter_te002 = $('input[name=\'filter_te002\']').attr('value');
	if (filter_te002) {
		url = '<?php echo base_url() ?>index.php/pal/pali52/filter1/te002/asc/' + encodeURIComponent(filter_te002);
	}
	var filter_te003 = $('input[name=\'filter_te003\']').attr('value');
	if (filter_te003) {
		url = '<?php echo base_url() ?>index.php/pal/pali52/filter1/te003/asc/' + encodeURIComponent(filter_te003);
	}
	var filter_te004 = $('input[name=\'filter_te004\']').attr('value');
	if (filter_te004) {
		url = '<?php echo base_url() ?>index.php/pal/pali52/filter1/te004/asc/' + encodeURIComponent(filter_te004);
	}	
	var filter_te005 = $('input[name=\'filter_te005\']').attr('value');
	if (filter_te005) {
		url = '<?php echo base_url() ?>index.php/pal/pali52/filter1/te005/asc/' + encodeURIComponent(filter_te005);
	}	
	
	var filter_te007 = $('input[name=\'filter_te007\']').attr('value');
	if (filter_te007) {
		url = '<?php echo base_url() ?>index.php/pal/pali52/filter1/te007/asc/' + encodeURIComponent(filter_te007); 
	}
	
    if (!filter_te001 && !filter_te001disp   && !filter_te002  && !filter_te003 && !filter_te004 && !filter_te005 && !filter_te007) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali52/display';location = url;
	   
	   }
	   
	location = url;
}
</script>