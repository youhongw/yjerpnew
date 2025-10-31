<div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 分錄底稿維護作業 - 瀏覽　　　</h1>
     <!--  <div class="buttons"> -->
	   <div style="float:left; "> 
	     <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/ajs/ajsi20/clear_sql_term'"  style="float:left" accesskey="a" class="button"><span>重整 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),09999,1)=='Y') { ?>
	<!--  <a onclick="location = '<?=base_url()?>index.php/ajs/ajsi20/addform'"  style="float:left" accesskey="+" class="button"><span>新增</span><img src="<?=base_url()?>assets/image/png/add.png" /></a> -->
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),99999,1)=='Y') { ?>
	  <a onclick="location = '<?=base_url()?>index.php/ajs/ajsi20/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?=base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?=base_url()?>index.php/ajs/ajsi20/findform'"  style="float:left" accesskey="k" class="button"><span>查詢 k </span><img src="<?=base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),399999,1)=='Y') { ?>
	  <a onclick="$('form').submit();" style="float:left"  accesskey="-" class="button"><span>刪除 - </span><img src="<?=base_url()?>assets/image/png/del.png" /></a>
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),69999,1)=='Y') { ?>
      <!-- <a onclick="$('form').submitb();"   class="button">印收款單</a>   -->
	  <a onclick="location = '<?=base_url()?>index.php/ajs/ajsi20/printdetail'"   style="float:left"  accesskey="p" class="button"><span>列印 p </span><img src="<?=base_url()?>assets/image/png/print.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),699999,1)=='Y') { ?>
	  <a onclick="location = '<?=base_url()?>index.php/ajs/ajsi20/printdetailc'"  style="float:left"  accesskey="o"  class="button"><span>印傳票 o </span><img src="<?=base_url()?>assets/image/png/print1.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),109999,1)=='Y') { ?>
	  <a onclick="location = '<?=base_url()?>index.php/ajs/ajsi20/exceldetail'"  style="float:left"  accesskey="l" class="button"><span>excel檔 l </span><img src="<?=base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?=base_url()?>index.php/ajs/ajsi20/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?=base_url()?>index.php/ajs/ajsi20/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?=base_url()?>index.php/main/index/161'"  style="float:left"  accesskey="x" class="button"><span>關閉 x </span><img src="<?=base_url()?>assets/image/png/close.png" /></a> 
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?=base_url()?>index.php/ajs/ajsi20/delete" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("ajs/ajsi20/display/ta001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?>
           		  
	      </td>
	      <td width="7%" class="left">
	          <?php echo anchor("ajs/ajsi20/display/ta001/" . (($sort_order == 'asc' && $sort_by == 'ta001') ? 'desc' : 'asc') ,'底稿批號'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("ajs/ajsi20/display/ta002/" . (($sort_order == 'asc' && $sort_by == 'ta002') ? 'desc' : 'asc') ,'底稿序號'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("ajs/ajsi20/display/ta004/" . (($sort_order == 'asc' && $sort_by == 'ta004') ? 'desc' : 'asc') ,'傳票單別'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
	      <td width="5%" class="left">
	          <?php echo anchor("ajs/ajsi20/display/ta005/" .(($sort_order == 'asc' && $sort_by == 'ta005') ? 'desc' : 'asc') ,'傳票單號'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("ajs/ajsi20/display/ta006/".(($sort_order == 'asc' && $sort_by == 'ta006') ? 'desc' : 'asc') ,'傳票日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("ajs/ajsi20/display/ta007/" . (($sort_order == 'asc' && $sort_by == 'ta007') ? 'desc' : 'asc') ,'傳票金額'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		  <td width="5%" class="left">
		  <?php echo anchor("ajs/ajsi20/display/ta011/" . (($sort_order == 'asc' && $sort_by == 'ta011') ? 'desc' : 'asc') ,'拋轉人員'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		  <?php echo anchor("ajs/ajsi20/display/ta012/" . (($sort_order == 'asc' && $sort_by == 'ta012') ? 'desc' : 'asc') ,'建立日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="12%" class="center">&nbsp查看管理&nbsp </td>
         <!--    <td width="12%" class="center">&nbsp修改管理&nbsp </td>
		   <!--   <td width="12%" class="center">&nbsp列印傳票&nbsp </td> -->
            </tr>
          </thead>
		  
         <!-- <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_ta001='';$filter_ta002='';$filter_ta003='';$filter_ta004='';$filter_ta004disp='';$filter_ta028='';$filter_ta029='';$filter_create=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	      <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
          <td width="10px" align="left">
		   <div class="button-search"></div>
		   <input type="text" id="filter_ta001" name="filter_ta001"  value="" size="12" />
		   </div>	
	      </td>
			  
	      <td width="5%" class="left">
		   <div  class="button-search"></div>
		   <input type="text" id="filter_ta002" name="filter_ta002"  value="" size="12" />
		   </div>	
		  </td>
			  
	      <td width="5%" class="left">
		    <div class="button-search"></div>
			<input type="text" name="filter_ta004" size="12" value=""  />
		    </div>			  
	      </td>
			  
	      <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text" name="filter_ta005" size="12" value="" />
		  </td>
          <td  width="5%" align="left">
		  <div class="button-search"></div>
		   <input type="text"   name="filter_ta006" size="12" value=""  />
		  </td>
	      
		  <td  width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_ta007" size="12" value="" />
		  </td>
		  
		  <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_ta011" size="12" value="" />
		  </td>
		  
	      <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_create" size="12" value="" />
		  </td>
	      <td width="10%" align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	     <!-- <td width="10%" align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
		 <!-- <td width="10%" align="center"></td>  -->
        </tr>
		<tbody>	
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?=$row->ta001."/".trim($row->ta002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><? echo $chkval;?></td>
		  <td class="left"><? echo $row->ta001;?></td>			  
		  <td class="left"><? echo $row->ta002;?></td> 
		  <td class="left"><? echo $row->ta004;?></td>
		  <td class="left"><? echo $row->ta005;?></td>
		  <td class="left"><? echo substr($row->ta006,0,4).'/'.substr($row->ta006,4,2).'/'.substr($row->ta006,6,2);?></td>
		  <td class="right"><? echo $row->ta007;?></td>
		  <td class="right"><? echo $row->ta011;?></td>
		  <td class="center"><? echo substr($row->ta012,0,4).'/'.substr($row->ta012,4,2).'/'.substr($row->ta012,6,2);?></td>		                 			
		
		  <td class="center"><a href="<?php echo site_url('ajs/ajsi20/see/'.$row->ta001.'/'.$row->ta002) ?>">[ 查看 </a><img src="<?=base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
		<!--  <td class="center"><a href="<?php echo site_url('ajs/ajsi20/updform/'.$row->ta001.'/'.$row->ta002)?>">[ 修改 </a><img src="<?=base_url()?>assets/image/png/modi.png" />]</td> -->
		  <?PHP } ?>
		  
	      <?PHP if (substr($this->session->userdata('sysmg006'),6999,1)=='Y') { ?>
		<!--  <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('ajs/ajsi20/printbb/'.$row->ta001."/".trim($row->ta002))?>" id="print1"  >[ 印單據 </a><img src="<?=base_url()?>assets/image/png/Print1.png" />]</td> -->
	      <?PHP } ?>
	      <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('ajs/ajsi20/del/'.$row->ta001."/".trim($row->ta002))?>" id="delete1"  >[ 刪除 ]</a></td>   -->
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
</div>	<!-- div-0 -->

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
		
	var filter_ta001 = $('input[name=\'filter_ta001\']').val();
	if (filter_ta001) {
		url = '<?=base_url() ?>index.php/ajs/ajsi20/filter1/ta001/desc/' + encodeURIComponent(filter_ta001);
	} 
	
	var filter_ta002 = $('input[name=\'filter_ta002\']').val();
	if (filter_ta002) {
		url = '<?=base_url() ?>index.php/ajs/ajsi20/filter1/ta002/desc/' + encodeURIComponent(filter_ta002);
	} 
	
	var filter_ta004 = $('input[name=\'filter_ta004\']').val();
	if (filter_ta004) {
		url = '<?=base_url() ?>index.php/ajs/ajsi20/filter1/ta004/desc/' + encodeURIComponent(filter_ta004);
	}
		
	var filter_ta005 = $('input[name=\'filter_ta005\']').val();
	if (filter_ta005) {
		url = '<?=base_url() ?>index.php/ajs/ajsi20/filter1/ta005/desc/' + encodeURIComponent(filter_ta005); 
	}
	
	var filter_ta006 = $('input[name=\'filter_ta006\']').val();
	if (filter_ta006) {
		url = '<?=base_url() ?>index.php/ajs/ajsi20/filter1/ta006/desc/' + encodeURIComponent(filter_ta006); 
	}
	
	var filter_ta007 = $('input[name=\'filter_ta007\']').val();
	if (filter_ta007) {
		url = '<?=base_url() ?>index.php/ajs/ajsi20/filter1/ta007/desc/' + encodeURIComponent(filter_ta007); 
	}
		var filter_ta011 = $('input[name=\'filter_ta011\']').val();
	if (filter_ta011) {
		url = '<?=base_url() ?>index.php/ajs/ajsi20/filter1/ta011/desc/' + encodeURIComponent(filter_ta011); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?=base_url() ?>index.php/ajs/ajsi20/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if ( !filter_ta001  && !filter_ta002 && !filter_ta003 && !filter_ta004 && !filter_ta005 && !filter_ta006 && !filter_ta007 && !filter_ta011 && !filter_create) {         
	   url = '<?=base_url() ?>index.php/ajs/ajsi20/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_ta001 = $('input[name=\'filter_ta001\']').val();
	if (filter_ta001) {
		url = '<?=base_url() ?>index.php/ajs/ajsi20/filter1/ta001/asc/' + encodeURIComponent(filter_ta001);
	} 
		
	var filter_ta002 = $('input[name=\'filter_ta002\']').val();
	if (filter_ta002) {
		url = '<?=base_url() ?>index.php/ajs/ajsi20/filter1/ta002/asc/' + encodeURIComponent(filter_ta002);
	} 
	
	
	var filter_ta004 = $('input[name=\'filter_ta004\']').val();
	if (filter_ta004) {
		url = '<?=base_url() ?>index.php/ajs/ajsi20/filter1/ta004/asc/' + encodeURIComponent(filter_ta004);
	}
		
	var filter_ta005 = $('input[name=\'filter_ta005\']').val();
	if (filter_ta005) {
		url = '<?=base_url() ?>index.php/ajs/ajsi20/filter1/ta005/asc/' + encodeURIComponent(filter_ta005);
		
	}
	var filter_ta006 = $('input[name=\'filter_ta006\']').val();
	if (filter_ta006) {
		url = '<?=base_url() ?>index.php/ajs/ajsi20/filter1/ta006/asc/' + encodeURIComponent(filter_ta006);
		
	}
	var filter_ta007 = $('input[name=\'filter_ta007\']').val();
	if (filter_ta007) {
		url = '<?=base_url() ?>index.php/ajs/ajsi20/filter1/ta007/asc/' + encodeURIComponent(filter_ta007); 
	}
	var filter_ta011 = $('input[name=\'filter_ta011\']').val();
	if (filter_ta011) {
		url = '<?=base_url() ?>index.php/ajs/ajsi20/filter1/ta011/asc/' + encodeURIComponent(filter_ta011); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?=base_url() ?>index.php/ajs/ajsi20/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_ta001  && !filter_ta002 && !filter_ta003 && !filter_ta004 && !filter_ta005 && !filter_ta006  && !filter_ta007 && !filter_ta011 && !filter_create) {         
	   url = '<?=base_url() ?>index.php/ajs/ajsi20/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 