  <div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 客戶基本資料建立作業 - 瀏覽　　　</h1>
      <!--  <div class="buttons"> -->
	   <div style="float:left; "> 
	      <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi01/clear_sql_term'"  style="float:left" accesskey="a" class="button"><span>重整 a </span><img  src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	   <a onclick="location = '<?php echo base_url()?>index.php/cop/copi01/addform'" style="float:left" accesskey="i" class="button"><span>新增 i </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
       <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>	
	   <a onclick="location = '<?php echo base_url()?>index.php/cop/copi01/copyform'" style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
       <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	   <a onclick="location = '<?php echo base_url()?>index.php/cop/copi01/findform'" style="float:left" accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
       <?PHP } ?>
	   
	   <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>        
	   <a onclick="$('form').submit();" style="float:left" accesskey="-" class="button"><span>刪除 - </span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	   <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	   <a onclick="location = '<?php echo base_url()?>index.php/cop/copi01/printdetail'" style="float:left" accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>   
	   <?PHP } ?>
	 
	   <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	   <a onclick="location = '<?php echo base_url()?>index.php/cop/copi01/exceldetail'"  style="float:left"  accesskey="l" class="button"><span>EXCEL l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a>
       <?PHP } ?>	
	<!-- <a onclick="location = '<?php echo base_url()?>index.php/cop/copi01/printdetail'"  class="button"><span>列印</span></a>
	 <a onclick="location = '<?php echo base_url()?>index.php/cop/copi01/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	   <a onclick="location = '<?php echo base_url()?>index.php/main/index/104'" style="float:left" accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
     </div>
	</div>
	
  <div class="content"> <!-- div-2   summit -->
    <form action="<?php echo base_url()?>index.php/cop/copi01/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
        <thead>
        <tr>                          <!-- 表格表頭 -->
          <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="6%" class="left">
		  <?php echo anchor("cop/copi01/display/ma001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?>
	      </td>
	      <td width="7%" class="left">
	          <?php echo anchor("cop/copi01/display/ma001/" . (($sort_order == 'asc' && $sort_by == 'ma001') ? 'desc' : 'asc') ,'客戶代號'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="8%" class="left"> 
		  <?php echo anchor("cop/copi01/display/ma002/" . (($sort_order == 'asc' && $sort_by == 'ma002') ? 'desc' : 'asc') ,'客戶簡稱'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		  <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="8%" class="left"> 
		  <?php echo anchor("cop/copi01/display/ma006/" . (($sort_order == 'asc' && $sort_by == 'ma006') ? 'desc' : 'asc') ,'TEL(一)'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		  <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
          </td>
	      <td width="8%" class="left">
	      <?php echo anchor("cop/copi01/display/ma008/" .(($sort_order == 'asc' && $sort_by == 'ma008') ? 'desc' : 'asc') ,'傳真'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		  <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	  
	      <td width="8%" class="left">
		  <?php echo anchor("cop/copi01/display/ma005/" . (($sort_order == 'asc' && $sort_by == 'ma005') ? 'desc' : 'asc') ,'聯絡人(一)'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		  <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		  
		<!--   <td width="8%" class="left">
		  <?php echo anchor("cop/copi01/display/ma201/" . (($sort_order == 'asc' && $sort_by == 'ma201') ? 'desc' : 'asc') ,'客戶級別'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		  <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		    <td width="6%" class="left">
		  <?php  echo anchor("cop/copi01/display/ma202/" . (($sort_order == 'asc' && $sort_by == 'ma202') ? 'desc' : 'asc') ,'客戶類別'); ?>
		  <?php if ($sort_order == 'asc'  ) {  ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php  } else { ?>
		  <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php  }  ?>
	      </td> -->
		  
	      <td width="7%" class="center">
		  <?php echo anchor("cop/copi01/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		  <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		  <td width="11%" class="center">訪問</td>
	   <!--   <td width="18%" class="center">&nbsp查看管理&nbsp </td> -->
          <td width="11%" class="center">修改 </td>
		  <td width="11%" class="center">刪除</td>
          </tr>
          </thead>
		  
      <!--  <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	      <?php $filter_ma001='';$filter_ma002='';$filter_ma006='';$filter_ma008='';$filter_ma009='';$filter_ma005='';$filter_create=''; ?>
	      <tr class="filter">
	      <td class="left"></td>
	      <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
          <td align="left">
		   <div class="button-search"></div>
		   <input type="text" id="filter_ma001" name="filter_ma001" value="" size="10" />
	      </td>
			  
	      <td class="left">
		   <div  class="button-search"></div>
		   <input type="text"  name="filter_ma002" value="" size="10"/>
		  </td>
			  
	      <td class="left">
		    <div class="button-search"></div>
			<input type="text" name="filter_ma006" value="" size="10" />
	      </td>
			  
	      <td align="left">
		    <div class="button-search"></div>
		    <input type="text" name="filter_ma008" value="" size="10" />
		  </td>
        <!--  <td align="left">
		    <div class="button-search"></div>
		    <input type="text" name="filter_ma009" value="" size="10" />
		  </td>  -->
	      <td align="left">
		    <div class="button-search"></div>
		    <input type="text" name="filter_ma005" value="" size="10" />
		  </td>
	<!--	  <td align="left">
		    <div class="button-search"></div>
		    <input type="text" name="filter_ma201" value="" size="10"/>
		  </td>
		  <td align="left">
		    <div class="button-search"></div>
		    <input type="text" name="filter_ma202" value="" size="10"/>
		  </td> -->
		  
	      <td align="left">
		    <div class="button-search"></div>
		    <input type="text" name="filter_create" value="" size="10" />
		  </td>
	      <td  align="center"><a onclick="filter();" class="button">篩選q▲</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選w▼</a></td> 
		 	<td  align="center"><a  ></a>&nbsp;</td> 
        </tr>
		<tbody> 	
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->ma001."/".trim($row->ma001)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>
		  <td class="left"><?php echo  $row->ma001;?></td>			  
		  <td class="left"><?php echo  $row->ma002;?></td>
		  <td class="left"><?php echo  $row->ma006;?></td>
		  <td class="left"><?php echo  $row->ma008;?></td>
	  <!--	 <td class="left"><?php //echo  $row->ma009;?></td> -->
		  <td class="left"><?php echo  $row->ma005;?></td>
		<!--   <td class="left"><?php //echo  $row->ma201;?></td> -->
		<!--    <td class="left"><?php // echo  $row->ma202;?></td> -->
		  <td class="center"><?php echo  substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>		                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('cop/copi01/del/'.$row->ma001."/".trim($row->ma002))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
	 <!--	  <td class="center"><a href="<?php echo site_url('cop/copi01/see/'.$row->ma001) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <td class="center"><a href="<?php echo site_url('cop/copi01/see/'.$row->ma001) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td> -->
	       <td class="center"><a href="<?php echo site_url('fun/copq82a/display/'.$row->ma001) ?>">[ 訪問<img id="Showcopq82a" src="<?php echo base_url()?>assets/image/png/eye.png" alt="" align="top"/>]</td>	 
       <!--    <td class="center"><a href="<?php echo site_url('cop/copi01/see/'.$row->ma001) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td> -->
		 <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>                 
		  <td class="center"><a href="<?php echo site_url('cop/copi01/updform/'.$row->ma001)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
          <?PHP } ?>	 
          <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
		  <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('cop/copi01/del/'.$row->ma001)?>" id="delete1"  >[ 刪除 ]</a></td> 
	      <?PHP } ?>		  
	   </tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
        </tbody>		 
        </table>
		     
	           <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		       <?php  $this->session->set_userdata('search1',"display/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
			 
				<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      </form>
    
   </div> <!-- div-2 -->
  </div>  <!-- div-1 -->
</div>  <!-- div-0 -->
<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
  //  window.open('/index.php/cop/copi01/printdetail')
	window.location="<?php echo base_url()?>index.php/cop/copi01/printdetail";
  }

function open_winexcel()
  {
   // window.open('/index.php/cop/copi01/exceldetail')
	window.location="<?php echo base_url()?>index.php/cop/copi01/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_ma001 = $('input[name=\'filter_ma001\']').val();
	if (filter_ma001) {
		url ='<?php echo base_url() ?>index.php/cop/copi01/filter1/ma001/desc/' + encodeURIComponent(filter_ma001);
		
	} 
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').val();
	if (filter_ma002) {
		url = '<?php echo base_url() ?>index.php/cop/copi01/filter1/ma002/desc/' + encodeURIComponent(filter_ma002);
	} 
	
	var filter_ma006 = $('input[name=\'filter_ma006\']').val();
	if (filter_ma006) {
		url = '<?php echo base_url() ?>index.php/cop/copi01/filter1/ma006/desc/' + encodeURIComponent(filter_ma006);
	}
	
	var filter_ma008 = $('input[name=\'filter_ma008\']').val();
	if (filter_ma008) {
		url = '<?php echo base_url() ?>index.php/cop/copi01/filter1/ma008/desc/' + (filter_ma008);
	}
	
		
 /*	var filter_ma009 = $('input[name=\'filter_ma009\']').val();
	if (filter_ma009) {
		url = '<?php echo base_url() ?>index.php/cop/copi01/filter1/ma009/desc/' + encodeURIComponent(filter_ma009); 
	} */
	
	var filter_ma005 = $('input[name=\'filter_ma005\']').val();
	if (filter_ma005) {
		url = '<?php echo base_url() ?>index.php/cop/copi01/filter1/ma005/desc/' + encodeURIComponent(filter_ma005); 
	}
	
	var filter_ma201 = $('input[name=\'filter_ma201\']').val();
	if (filter_ma201) {
		url = '<?php echo base_url() ?>index.php/cop/copi01/filter1/ma201/desc/' + encodeURIComponent(filter_ma201); 
	}
	var filter_ma202 = $('input[name=\'filter_ma202\']').val();
	if (filter_ma202) {
		url = '<?php echo base_url() ?>index.php/cop/copi01/filter1/ma202/desc/' + encodeURIComponent(filter_ma202); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/cop/copi01/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if ( !filter_ma001  && !filter_ma002 && !filter_ma006 && !filter_ma008 && !filter_ma005  && !filter_ma201  && !filter_ma202 && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/cop/copi01/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_ma001 = $('input[name=\'filter_ma001\']').val();
	if (filter_ma001) {
		url = '<?php echo base_url() ?>index.php/cop/copi01/filter1/ma001/asc/' + encodeURIComponent(filter_ma001);
	} 
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').val();
	if (filter_ma002) {
		url = '<?php echo base_url() ?>index.php/cop/copi01/filter1/ma002/asc/' + encodeURIComponent(filter_ma002);
	} 
	
	var filter_ma006 = $('input[name=\'filter_ma006\']').val();
	if (filter_ma006) {
		url = '<?php echo base_url() ?>index.php/cop/copi01/filter1/ma006/asc/' + encodeURIComponent(filter_ma006);
	}
	
	var filter_ma008 = $('input[name=\'filter_ma008\']').val();
	if (filter_ma008) {
		url = '<?php echo base_url() ?>index.php/cop/copi01/filter1/ma008/asc/' + encodeURIComponent(filter_ma008);
	}
	
		
/*	var filter_ma009 = $('input[name=\'filter_ma009\']').val();
	if (filter_ma009) {
		url = '<?php echo base_url() ?>index.php/cop/copi01/filter1/ma009/asc/' + encodeURIComponent(filter_ma009); 
	}  */
	
	var filter_ma005 = $('input[name=\'filter_ma005\']').val();
	if (filter_ma005) {
		url = '<?php echo base_url() ?>index.php/cop/copi01/filter1/ma005/asc/' + encodeURIComponent(filter_ma005); 
	}
	
	var filter_ma201 = $('input[name=\'filter_ma201\']').val();
	if (filter_ma201) {
		url = '<?php echo base_url() ?>index.php/cop/copi01/filter1/ma201/asc/' + encodeURIComponent(filter_ma201); 
	}
	var filter_ma202 = $('input[name=\'filter_ma202\']').val();
	if (filter_ma202) {
		url = '<?php echo base_url() ?>index.php/cop/copi01/filter1/ma202/asc/' + encodeURIComponent(filter_ma202); 
	}
	
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/cop/copi01/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_ma001  && !filter_ma002 && !filter_ma006 && !filter_ma008 &&  !filter_ma005 && !filter_ma201 && !filter_ma202 && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/cop/copi01/display';location = url;
	   
	   }
	   
	location = url;
}
</script>