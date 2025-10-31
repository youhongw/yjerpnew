<div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> BOM用料建立作業 - 瀏覽　　　</h1>
       <!--  <div class="buttons"> -->
	   <div style="float:left; "> 
	    <?PHP if ((substr($this->session->userdata('sysmg006'),1,1)=='Y') || ($this->session->userdata('syssuper')=='Y')) { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi02/clear_sql_term'"  style="float:left" accesskey="a" class="button"><span>重新整理 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi02/addform'"  style="float:left" accesskey="i" class="button"><span>新增 i </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi02/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi02/findform'"  style="float:left" accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>刪除</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
      <!-- <a onclick="$('form').submitb();"   class="button">印核價單</a>   -->
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi02/printdetail'"   style="float:left"  accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),69999,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi02/printdetailc'"   style="float:left"  accesskey="o" class="button"><span>印核價單 o </span><img src="<?php echo base_url()?>assets/image/png/print1.png" /></a> 
	  <?PHP } ?> 
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi02/exceldetail'"  style="float:left"  accesskey="l" class="button"><span>EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi02/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi02/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/107'"  style="float:left"  accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/bom/bomi02/delete" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("bom/bomi02/display/mc001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?>
           		  
	      </td>
	      <td width="10px" class="left">
	          <?php echo anchor("bom/bomi02/display/mc001/" . (($sort_order == 'asc' && $sort_by == 'mc001') ? 'desc' : 'asc') ,'主件品號'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("bom/bomi02/display/b.mb002/" . (($sort_order == 'asc' && $sort_by == 'b.mb002') ? 'desc' : 'asc') ,'品名'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("bom/bomi02/display/b.mb003/" . (($sort_order == 'asc' && $sort_by == 'b.mb003') ? 'desc' : 'asc') ,'規格'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
	      <td width="5%" class="left">
	          <?php echo anchor("bom/bomi02/display/b.mb004/" .(($sort_order == 'asc' && $sort_by == 'b.mb004') ? 'desc' : 'asc') ,'單位'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("bom/bomi02/display/mc004/".(($sort_order == 'asc' && $sort_by == 'mc004') ? 'desc' : 'asc') ,'標準批量'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		 
	      <td width="7%" class="center">
		  <?php echo anchor("bom/bomi02/display/mc010/" . (($sort_order == 'asc' && $sort_by == 'mc010') ? 'desc' : 'asc') ,'備註'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="12%" class="center">&nbsp查看管理&nbsp </td>
             <td width="12%" class="center">&nbsp修改管理&nbsp </td>
		   <!--   <td width="12%" class="center">&nbsp印核價單&nbsp </td> -->
            </tr>
          </thead>
		  
        <!--  <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_mc001='';$filter_mc001disp='';$filter_mc001disp1='';$filter_mc001disp2='';$filter_mc004='';$filter_create=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	      <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
          <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text" id="filter_mc001" name="filter_mc001"  value="" size="10" />
	      </td>
			  
	      <td width="5%" class="left">
		   <div  class="button-search"></div>
		   <input type="text" id="filter_mc001disp"   name="filter_mc001disp"  value="" size="10" />
		  </td>
			  
	      <td width="5%" class="left">
		    <div class="button-search"></div>
			<input type="text"  name="filter_mc001disp1" size="16" value="" size="10" />
		    </div>			  
	      </td>
			  
	      <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text"  name="filter_mc001disp2"  value="" size="10" />
		  </td>
          <td  width="5%" align="left">
		  <div class="button-search"></div>
		   <input type="text"  name="filter_mc004"  size="10"  />
		  </td>
		  
	      <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_create"  value=""  size="10"/>
		  </td>
	      <td width="10%" align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td width="10%" align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
		 <!--  <td width="10%" align="center"></td> -->
        </tr>
		<tbody>	
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->mc001?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>
		  <td class="left"><?php echo  $row->mc001;?></td>			  
		  <td class="left"><?php echo  $row->mc001disp;?></td>
		  <td class="left"><?php echo  $row->mc001disp1;?></td>
		  <td class="left"><?php echo  $row->mc001disp2;?></td>
		  <td class="left"><?php echo  $row->mc004;?></td>
		 
		  <td class="center"><?php echo  $row->mc010;?></td>		                 			
		
		  <td class="center"><a href="<?php echo site_url('bom/bomi02/see/'.$row->mc001) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
		  <td class="center"><a href="<?php echo site_url('bom/bomi02/updform/'.$row->mc001)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
		  <?PHP } ?>
	  <!--    <?PHP // if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
		 <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('bom/bomi02/printbb/'.$row->mc001)?>" id="print1"  >[ 印單據 </a><img src="<?php echo base_url()?>assets/image/png/Print1.png" />]</td>
	      <?PHP // } ?>
	       <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('bom/bomi02/del/'.$row->mc001."/".trim($row->mc002))?>" id="delete1"  >[ 刪除 ]</a></td>   -->
	    </tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
          </tbody>		 
        </table>
		     
	      <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		  <?php  $this->session->set_userdata('search1',"display/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
			  
			
		</form>
    <div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
     
    </div> <!-- div-2 -->
   </div>  <!-- div-1 -->
</div>	<!-- div-0 -->

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
   // window.open('/index.php/bom/bomi02/printdetail')
	window.location="<?php echo base_url()?>index.php/bom/bomi02/printdetail";
  }
  function open_winprint1()
  {
 //   window.open('/index.php/bom/bomi02/printdetailc')
	window.location="<?php echo base_url()?>index.php/bom/bomi02/printdetailc";
  }

function open_winexcel()
  {
  //  window.open('/index.php/bom/bomi02/exceldetail')
	window.location="<?php echo base_url()?>index.php/bom/bomi02/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
		
	var filter_mc001 = $('input[name=\'filter_mc001\']').val();
	if (filter_mc001) {
		url = '<?php echo base_url() ?>index.php/bom/bomi02/filter1/mc001/desc/' + encodeURIComponent(filter_mc001);
	} 
	
	var filter_mc001disp = $('input[name=\'filter_mc001disp\']').val();
	if (filter_mc001disp) {
		url = '<?php echo base_url() ?>index.php/bom/bomi02/filter1/b.mb002/desc/' + encodeURIComponent(filter_mc001disp);
	} 
	
	var filter_mc001disp1 = $('input[name=\'filter_mc001disp1\']').val();
	if (filter_mc001disp1) {
		url = '<?php echo base_url() ?>index.php/bom/bomi02/filter1/b.mb003/desc/' + encodeURIComponent(filter_mc001disp1);
	}
	
	var filter_mc001disp2 = $('input[name=\'filter_mc001disp2\']').val();
	if (filter_mc001disp2) {
		url = '<?php echo base_url() ?>index.php/bom/bomi02/filter1/b.mb004/desc/' + encodeURIComponent(filter_mc001disp2);
	}
		
	var filter_mc004 = $('input[name=\'filter_mc004\']').val();
	if (filter_mc004) {
		url = '<?php echo base_url() ?>index.php/bom/bomi02/filter1/mc004/desc/' + encodeURIComponent(filter_mc004); 
	}
	
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/bom/bomi02/filter1/mc010/desc/' + encodeURIComponent(filter_create); 
	}
	
    if ( !filter_mc001  && !filter_mc001disp && !filter_mc001disp1 && !filter_mc001disp2 && !filter_mc004  && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/bom/bomi02/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_mc001 = $('input[name=\'filter_mc001\']').val();
	if (filter_mc001) {
		url = '<?php echo base_url() ?>index.php/bom/bomi02/filter1/mc001/asc/' + encodeURIComponent(filter_mc001);
	} 
		
	var filter_mc001disp = $('input[name=\'filter_mc001disp\']').val();
	if (filter_mc001disp) {
		url = '<?php echo base_url() ?>index.php/bom/bomi02/filter1/b.mb002/asc/' + encodeURIComponent(filter_mc001disp);
	} 
	
	var filter_mc001disp1 = $('input[name=\'filter_mc001disp1\']').val();
	if (filter_mc001disp1) {
		url = '<?php echo base_url() ?>index.php/bom/bomi02/filter1/b.mb003/asc/' + encodeURIComponent(filter_mc001disp1);
	}
	
	var filter_mc001disp2 = $('input[name=\'filter_mc001disp2\']').val();
	if (filter_mc001disp2) {
		url = '<?php echo base_url() ?>index.php/bom/bomi02/filter1/b.mb004/asc/' + encodeURIComponent(filter_mc001disp2);
	}
		
	var filter_mc004 = $('input[name=\'filter_mc004\']').val();
	if (filter_mc004) {
		url = '<?php echo base_url() ?>index.php/bom/bomi02/filter1/mc004/asc/' + encodeURIComponent(filter_mc004);
		
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/bom/bomi02/filter1/mc010/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_mc001  && !filter_mc001disp && !filter_mc001disp1 && !filter_mc001disp2 && !filter_mc004  && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/bom/bomi02/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 