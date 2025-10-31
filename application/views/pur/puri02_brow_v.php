  <div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 品號廠商建立作業 - 瀏覽　　　</h1>
       <!--  <div class="buttons"> -->
	   <div style="float:left; "> 
	       <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/puri02/clear_sql_term'"  style="float:left" accesskey="a" class="button"><span>重整 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/puri02/addform'" style="float:left" accesskey="i" class="button"><span>新增 i </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/puri02/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/puri02/findform'"  style="float:left" accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>刪除</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="open_winprint();"    style="float:left" accesskey="p" class="button">列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="open_winexcel();"    style="float:left" accesskey="l" class="button">EXCEL l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/pur/puri02/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/puri02/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/103'"  style="float:left" accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/pur/puri02/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
        <thead>
         <tr>                          <!-- 表格表頭 -->
          <td width="1%" style="text-align: center;">
		   <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		   <?php echo anchor("pur/puri02/display/mb001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?> 
	      </td>
	      <td width="5%" class="left">
	        <?php echo anchor("pur/puri02/display/a.mb001/" . (($sort_order == 'asc' && $sort_by == 'a.mb001') ? 'desc' : 'asc') ,'品號'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		   <?php echo anchor("pur/puri02/display/b.mb002/" . (($sort_order == 'asc' && $sort_by == 'b.mb002') ? 'desc' : 'asc') ,'品名'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="16%" class="left"> 
		   <?php echo anchor("pur/puri02/display/b.mb003/" . (($sort_order == 'asc' && $sort_by == 'b.mb003') ? 'desc' : 'asc') ,'規格'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
          </td>
	      <td width="8%" class="left">
	        <?php echo anchor("pur/puri02/display/a.mb002/" .(($sort_order == 'asc' && $sort_by == 'a.mb002') ? 'desc' : 'asc') ,'廠商代號'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("pur/puri02/display/c.ma002/" . (($sort_order == 'asc' && $sort_by == 'c.ma002') ? 'desc' : 'asc') ,'廠商名稱'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("pur/puri02/display/a.mb011/" . (($sort_order == 'asc' && $sort_by == 'a.mb011') ? 'desc' : 'asc') ,'採購單價'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		   <?php echo anchor("pur/puri02/display/a.mb014/" . (($sort_order == 'asc' && $sort_by == 'a.mb014') ? 'desc' : 'asc') ,'生效日期'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="18%" class="center">&nbsp查看管理&nbsp </td>
          <td width="18%" class="center">&nbsp修改管理&nbsp </td>
        </tr>
        </thead>
		  
         <!-- <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_mb001='';$filter_mb001disp='';$filter_mb001disp1='';$filter_mb002='';$filter_mb002disp='';$filter_mb011='';$filter_mb014=''; ?>
	    <tr class="filter">
	     <td class="left"></td>
	     <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
         <td align="left">
		   <div class="button-search"></div>
		    <input type="text" id="filter_mb001" name="filter_mb001" value=""  size="12" />
		  
	     </td>
			  
	      <td class="left">
		  <div  class="button-search"></div>
			<input type="text"   name="filter_mb001disp" value=""  size="12" />
		  </td>
		  
		    <td class="left">
		  <div  class="button-search"></div>
			<input type="text"   name="filter_mb001disp1" value=""  size="12" />
		  </td>
		  
	      <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_mb002" value=""  size="12" />
		  		  
	      </td>
		  <td class="left">
		   <div class="button-search"></div>
			<input type="text"  name="filter_mb002disp" value=""  size="12"  />
		  		  
	      </td>
			 <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_mb011" value=""  size="12" />
		  		  
	      </td>
		  
	      
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_mb014" value="" size="12"/>
		  </td>
	      <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td>  
	      <!-- <button type='submit'  name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
        </tr>
		<tbody>
		<!--session 變數取消 	  
		<?php $this->session->unset_userdata('mb002'); ?> -->
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->mb001."/".trim($row->mb002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>		
		  <td class="left"><?php echo  $row->mb001;?></td>			  
		  <td class="left"><?php echo  $row->mb001disp;?></td>
		  <td class="left"><?php echo  $row->mb001disp1;?></td>
		  <td class="left"><?php echo  $row->mb002;?></td>
		  <td class="left"><?php echo  $row->mb002disp;?></td>
		  <td class="left"><?php echo  round($row->mb011,2);?></td>
		  <td class="center"><?php echo  substr($row->mb014,0,4).'/'.substr($row->mb014,4,2).'/'.substr($row->mb014,6,2);?></td>		                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pur/puri02/del/'.$row->mb001."/".trim($row->mb002))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><a href="<?php echo site_url('pur/puri02/see/'.$row->mb001.'/'.$row->mb002.'/'.$row->mb003)?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>                 
		  <td class="center"><a href="<?php echo site_url('pur/puri02/updform/'.$row->mb001.'/'.$row->mb002.'/'.$row->mb003)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
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
			 </form>
    <div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
    
    </div> <!-- div-2 -->
   </div>  <!-- div-1 -->
</div>	<!-- div-0 -->

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
   // window.open('/index.php/pur/puri02/printdetail')
	window.location="<?php echo base_url()?>index.php/pur/puri02/printdetail";
  }

function open_winexcel()
  {
   //  window.open('/index.php/pur/puri02/exceldetail')
	window.location="<?php echo base_url()?>index.php/pur/puri02/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_mb001 = $('input[name=\'filter_mb001\']').val();
	if (filter_mb001) {
		url = '<?php echo base_url() ?>index.php/pur/puri02/filter1/a.mb001/desc/' + encodeURIComponent(filter_mb001);
	}
	
	var filter_mb001disp = $('input[name=\'filter_mb001disp\']').val();
	if (filter_mb001disp) {
		url = '<?php echo base_url() ?>index.php/pur/puri02/filter1/b.mb002/desc/' + encodeURIComponent(filter_mb001disp);
	} 
	
	var filter_mb001disp1 = $('input[name=\'filter_mb001disp1\']').val();
	if (filter_mb001disp1) {
		url = '<?php echo base_url() ?>index.php/pur/puri02/filter1/b.mb003/desc/' + encodeURIComponent(filter_mb001disp1);
	}
	var filter_mb002 = $('input[name=\'filter_mb002\']').val();
	if (filter_mb002) {
		url = '<?php echo base_url() ?>index.php/pur/puri02/filter1/a.mb002/desc/' + encodeURIComponent(filter_mb002);
	}
    var filter_mb002disp = $('input[name=\'filter_mb002disp\']').val();
	if (filter_mb002disp) {
		url = '<?php echo base_url() ?>index.php/pur/puri02/filter1/c.ma002/desc/' + encodeURIComponent(filter_mb002disp);
	}	
	var filter_mb011 = $('input[name=\'filter_mb011\']').val();
	if (filter_mb011) {
		url = '<?php echo base_url() ?>index.php/pur/puri02/filter1/a.mb011/desc/' + encodeURIComponent(filter_mb011);
	}
	
	var filter_mb014 = $('input[name=\'filter_mb014\']').val();
	if (filter_mb014) {
		url = '<?php echo base_url() ?>index.php/pur/puri02/filter1/a.mb014/desc/' + encodeURIComponent(filter_mb014); 
	}
	
    if (!filter_mb001 && !filter_mb001disp  && !filter_mb001disp1 && !filter_mb002 && !filter_mb002disp && !filter_mb011 && !filter_mb014) {         
	   url = '<?php echo base_url() ?>index.php/pur/puri02/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_mb001 = $('input[name=\'filter_mb001\']').val();
	if (filter_mb001) {
		url = '<?php echo base_url() ?>index.php/pur/puri02/filter1/a.mb001/asc/' + encodeURIComponent(filter_mb001);
	}
	
	var filter_mb001disp = $('input[name=\'filter_mb001disp\']').val();
	if (filter_mb001disp) {
		url = '<?php echo base_url() ?>index.php/pur/puri02/filter1/b.mb002/asc/' + encodeURIComponent(filter_mb001disp);
	} 
	var filter_mb001disp1 = $('input[name=\'filter_mb001disp1\']').val();
	if (filter_mb001disp1) {
		url = '<?php echo base_url() ?>index.php/pur/puri02/filter1/b.mb003/asc/' + encodeURIComponent(filter_mb001disp1);
	} 
	
	var filter_mb002 = $('input[name=\'filter_mb002\']').val();
	if (filter_mb002) {
		url = '<?php echo base_url() ?>index.php/pur/puri02/filter1/a.mb002/asc/' + encodeURIComponent(filter_mb002);
	}
	var filter_mb002disp = $('input[name=\'filter_mb002disp\']').val();
	if (filter_mb002disp) {
		url = '<?php echo base_url() ?>index.php/pur/puri02/filter1/c.ma002/asc/' + encodeURIComponent(filter_mb002disp);
	}
	var filter_mb011 = $('input[name=\'filter_mb011\']').val();
	if (filter_mb011) {
		url = '<?php echo base_url() ?>index.php/pur/puri02/filter1/a.mb011/asc/' + encodeURIComponent(filter_mb011);
	}	
	
	
	var filter_mb014 = $('input[name=\'filter_mb014\']').val();
	if (filter_mb014) {
		url = '<?php echo base_url() ?>index.php/pur/puri02/filter1/a.mb014/asc/' + encodeURIComponent(filter_mb014); 
	}
	
    if (!filter_mb001 && !filter_mb001disp  && !filter_mb001disp && !filter_mb002  && !filter_mb002disp && !filter_mb011 && !filter_mb014) {         
	   url = '<?php echo base_url() ?>index.php/pur/puri02/display';location = url;
	   
	   }
	   
	location = url;
}
</script>