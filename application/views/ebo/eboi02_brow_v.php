  <div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 工程品號建立作業 - 瀏覽　　　</h1>
       <!--  <div class="buttons"> -->
	   <div style="float:left; "> 
	       <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/ebo/eboi02/clear_sql_term'"  style="float:left" accesskey="a" class="button"><span>重整 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/ebo/eboi02/addform'" style="float:left" accesskey="i" class="button"><span>新增 i </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9999,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/ebo/eboi02/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/ebo/eboi02/findform'"  style="float:left" accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>刪除 - </span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),69999,1)=='Y') { ?>
	  <a onclick="open_winprint();"    style="float:left" accesskey="p" class="button">列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),109999,1)=='Y') { ?>
	  <a onclick="open_winexcel();"    style="float:left" accesskey="l" class="button">excel檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/ebo/eboi02/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/ebo/eboi02/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/129'"  style="float:left" accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/ebo/eboi02/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
        <thead>
         <tr>                          <!-- 表格表頭 -->
          <td width="1%" style="text-align: center;">
		   <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		   <?php echo anchor("ebo/eboi02/display/mi001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?> 
	      </td>
	      <td width="5%" class="left">
	        <?php echo anchor("ebo/eboi02/display/a.mi001/" . (($sort_order == 'asc' && $sort_by == 'a.mi001') ? 'desc' : 'asc') ,'工程品號'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		   <?php echo anchor("ebo/eboi02/display/b.mi002/" . (($sort_order == 'asc' && $sort_by == 'b.mi002') ? 'desc' : 'asc') ,'品名'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="16%" class="left"> 
		   <?php echo anchor("ebo/eboi02/display/b.mi003/" . (($sort_order == 'asc' && $sort_by == 'b.mi003') ? 'desc' : 'asc') ,'規格'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
          </td>
	      <td width="8%" class="left">
	        <?php echo anchor("ebo/eboi02/display/a.mi004/" .(($sort_order == 'asc' && $sort_by == 'a.mi004') ? 'desc' : 'asc') ,'單位'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("ebo/eboi02/display/c.ma009/" . (($sort_order == 'asc' && $sort_by == 'c.ma009') ? 'desc' : 'asc') ,'品號屬性'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("ebo/eboi02/display/a.mi010/" . (($sort_order == 'asc' && $sort_by == 'a.mi010') ? 'desc' : 'asc') ,'標準進價'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		   <?php echo anchor("ebo/eboi02/display/a.mi007/" . (($sort_order == 'asc' && $sort_by == 'a.mi007') ? 'desc' : 'asc') ,'途程品號'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="18%" class="center">&nbsp查看管理&nbsp </td>
          <td width="18%" class="center">&nbsp修改管理&nbsp </td>
        </tr>
        </thead>
		  
         <!-- <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_mi001='';$filter_mi001disp='';$filter_mi001disp1='';$filter_mi002='';$filter_mi002disp='';$filter_mi011='';$filter_mi014=''; ?>
	    <tr class="filter">
	     <td class="left"></td>
	     <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
         <td align="left">
		   <div class="button-search"></div>
		    <input type="text" id="filter_mi001" name="filter_mi001" value=""  size="12" />
		  
	     </td>
			  
	      <td class="left">
		  <div  class="button-search"></div>
			<input type="text"   name="filter_mi002" value=""  size="12" />
		  </td>
		  
		    <td class="left">
		  <div  class="button-search"></div>
			<input type="text"   name="filter_mi003" value="" size="12"  />
		  </td>
		  
		   <td class="left">
		  <div  class="button-search"></div>
			<input type="text"   name="filter_mi004" value=""  size="12" />
		  </td>
		  
	      <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_mi009" value=""  size="12" />
		  		  
	      </td>
		  <td class="left">
		   <div class="button-search"></div>
			<input type="text"  name="filter_mi010" value=""  size="12"  />
		  		  
	      </td>
			 <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_mi007" value=""  size="12" />
		  		  
	      </td>
		  
	      
	      <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td>  
	      <!-- <button type='submit'  name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
        </tr>
		<tbody>
		<!--session 變數取消 	  
		<?php $this->session->unset_userdata('mi002'); ?> -->
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->mi001."/".trim($row->mi002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>		
		  <td class="left"><?php echo  $row->mi001;?></td>			  
		  <td class="left"><?php echo  $row->mb001disp;?></td>
		  <td class="left"><?php echo  $row->mb001disp1;?></td>
		  <td class="left"><?php echo  $row->mb001disp2;?></td>
		  <td class="left"><?php echo  $row->mi009;?></td>
		  <td class="left"><?php echo  $row->mi010;?></td>
		  <td class="left"><?php echo  $row->mi007;?></td>
		 	                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('ebo/eboi02/del/'.$row->mi001."/".trim($row->mi002))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><a href="<?php echo site_url('ebo/eboi02/see/'.$row->mi001)?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>                 
		  <td class="center"><a href="<?php echo site_url('ebo/eboi02/updform/'.$row->mi001)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
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
   // window.open('/index.php/ebo/eboi02/printdetail')
	window.location="<?php echo base_url()?>index.php/ebo/eboi02/printdetail";
  }

function open_winexcel()
  {
   //  window.open('/index.php/ebo/eboi02/exceldetail')
	window.location="<?php echo base_url()?>index.php/ebo/eboi02/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_mi001 = $('input[name=\'filter_mi001\']').val();
	if (filter_mi001) {
		url = '<?php echo base_url() ?>index.php/ebo/eboi02/filter1/a.mi001/desc/' + encodeURIComponent(filter_mi001);
	}
	
	var filter_mi002 = $('input[name=\'filter_mi002\']').val();
	if (filter_mi002) {
		url = '<?php echo base_url() ?>index.php/ebo/eboi02/filter1/a.mi002/desc/' + encodeURIComponent(filter_mi002);
	} 
	
	var filter_mi003 = $('input[name=\'filter_mi003\']').val();
	if (filter_mi003) {
		url = '<?php echo base_url() ?>index.php/ebo/eboi02/filter1/a.mi003/desc/' + encodeURIComponent(filter_mi003);
	}
	var filter_mi004 = $('input[name=\'filter_mi004\']').val();
	if (filter_mi004) {
		url = '<?php echo base_url() ?>index.php/ebo/eboi02/filter1/a.mi004/desc/' + encodeURIComponent(filter_mi004);
	}
    var filter_mi009 = $('input[name=\'filter_mi009\']').val();
	if (filter_mi009) {
		url = '<?php echo base_url() ?>index.php/ebo/eboi02/filter1/c.mi009/desc/' + encodeURIComponent(filter_mi009);
	}	
	var filter_mi010 = $('input[name=\'filter_mi010\']').val();
	if (filter_mi010) {
		url = '<?php echo base_url() ?>index.php/ebo/eboi02/filter1/a.mi010/desc/' + encodeURIComponent(filter_mi010);
	}
	
	var filter_mi007 = $('input[name=\'filter_mi007\']').val();
	if (filter_mi007) {
		url = '<?php echo base_url() ?>index.php/ebo/eboi02/filter1/a.mi007/desc/' + encodeURIComponent(filter_mi007); 
	}
	
    if (!filter_mi001 && !filter_mi002  && !filter_mi003 && !filter_mi004 && !filter_mi009 && !filter_mi010 && !filter_mi007) {         
	   url = '<?php echo base_url() ?>index.php/ebo/eboi02/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_mi001 = $('input[name=\'filter_mi001\']').val();
	if (filter_mi001) {
		url = '<?php echo base_url() ?>index.php/ebo/eboi02/filter1/a.mi001/asc/' + encodeURIComponent(filter_mi001);
	}
	
	var filter_mi002 = $('input[name=\'filter_mi002\']').val();
	if (filter_mi002) {
		url = '<?php echo base_url() ?>index.php/ebo/eboi02/filter1/a.mi002/asc/' + encodeURIComponent(filter_mi002);
	} 
	var filter_mi003 = $('input[name=\'filter_mi003\']').val();
	if (filter_mi003) {
		url = '<?php echo base_url() ?>index.php/ebo/eboi02/filter1/a.mi003/asc/' + encodeURIComponent(filter_mi003);
	} 
	
	var filter_mi004 = $('input[name=\'filter_mi004\']').val();
	if (filter_mi004) {
		url = '<?php echo base_url() ?>index.php/ebo/eboi02/filter1/a.mi004/asc/' + encodeURIComponent(filter_mi004);
	}
	var filter_mi009 = $('input[name=\'filter_mi009\']').val();
	if (filter_mi009) {
		url = '<?php echo base_url() ?>index.php/ebo/eboi02/filter1/a.mi009/asc/' + encodeURIComponent(filter_mi009);
	}
	var filter_mi010 = $('input[name=\'filter_mi010\']').val();
	if (filter_mi010) {
		url = '<?php echo base_url() ?>index.php/ebo/eboi02/filter1/a.mi010/asc/' + encodeURIComponent(filter_mi010);
	}	
	
	
	var filter_mi007 = $('input[name=\'filter_mi007\']').val();
	if (filter_mi007) {
		url = '<?php echo base_url() ?>index.php/ebo/eboi02/filter1/a.mi007/asc/' + encodeURIComponent(filter_mi007); 
	}
	
    if (!filter_mi001 && !filter_mi002  && !filter_mi003 && !filter_mi004  && !filter_mi009 && !filter_mi010 && !filter_mi007) {         
	   url = '<?php echo base_url() ?>index.php/ebo/eboi02/display';location = url;
	   
	   }
	   
	location = url;
}
</script>