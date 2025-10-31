<div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 加工核價單建立作業 - 瀏覽　　　</h1>
       <!--  <div class="buttons"> -->
	   <div style="float:left; "> 
	        <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/moc/moci10/clear_sql_term'"  style="float:left" accesskey="a" class="button"><span>重整 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/moc/moci10/addform'"  style="float:left" accesskey="i" class="button"><span>新增 i </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/moc/moci10/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/moc/moci10/findform'"  style="float:left" accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>刪除 - </span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
      <!-- <a onclick="$('form').submitb();"   class="button">印核價單</a>   -->
	  <a onclick="location = '<?php echo base_url()?>index.php/moc/moci10/printdetail'"   style="float:left"  accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/moc/moci10/printdetailc'"   style="float:left"  accesskey="o" class="button"><span>印核價單 o </span><img src="<?php echo base_url()?>assets/image/png/print1.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/moc/moci10/exceldetail'"  style="float:left"  accesskey="l" class="button"><span>excel檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/moc/moci10/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/moc/moci10/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/103'"  style="float:left"  accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/moc/moci10/delete" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("moc/moci10/display/a.tm001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?>
           		  
	      </td>
	      <td width="7%" class="left">
	          <?php echo anchor("moc/moci10/display/a.tm001/" . (($sort_order == 'asc' && $sort_by == 'a.tm001') ? 'desc' : 'asc') ,'核價單別'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("moc/moci10/display/a.tm002/" . (($sort_order == 'asc' && $sort_by == 'a.tm002') ? 'desc' : 'asc') ,'核價單號'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("moc/moci10/display/a.tm003/" . (($sort_order == 'asc' && $sort_by == 'a.tm003') ? 'desc' : 'asc') ,'核價日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
	      <td width="5%" class="left">
	          <?php echo anchor("moc/moci10/display/a.tm004/" .(($sort_order == 'asc' && $sort_by == 'a.tm004') ? 'desc' : 'asc') ,'廠商代號'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("moc/moci10/display/b.ma002/".(($sort_order == 'asc' && $sort_by == 'b.ma002') ? 'desc' : 'asc') ,'廠商名稱'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("moc/moci10/display/a.tm005/" . (($sort_order == 'asc' && $sort_by == 'a.tm005') ? 'desc' : 'asc') ,'幣別'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		<!--  <td width="5%" class="left">
		  <?php echo anchor("moc/moci10/display/a.tm007/" . (($sort_order == 'asc' && $sort_by == 'a.tm007') ? 'desc' : 'asc') ,'備註'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		  <?php echo anchor("moc/moci10/display/a.create_date/" . (($sort_order == 'asc' && $sort_by == 'a.create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td> -->
	      <td width="12%" class="center">&nbsp查看管理&nbsp </td>
             <td width="12%" class="center">&nbsp修改管理&nbsp </td>
		      <td width="12%" class="center">&nbsp印核價單&nbsp </td>
            </tr>
          </thead>
		  
        <!--  <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_tm001='';$filter_tm002='';$filter_tm003='';$filter_tm004='';$filter_tm004disp='';$filter_tm005='';$filter_tm007='';$filter_create=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	      <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
          <td width="10px" align="left">
		   <div class="button-search"></div>
		   <input type="text" id="filter_tm001" name="filter_tm001"  value="" size="12" />
	      </td>
			  
	      <td width="5%" class="left">
		   <div  class="button-search"></div>
		   <input type="text" id="filter_tm002" name="filter_tm002"  value="" size="12" />
		  </td>
			  
	      <td width="5%" class="left">
		    <div class="button-search"></div>
			<input type="text" name="filter_tm003" size="16" value="" size="12" />
		    </div>			  
	      </td>
			  
	      <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text" name="filter_tm004" size="12" value="" />
		  </td>
          <td  width="5%" align="left">
		  <div class="button-search"></div>
		   <input type="text"  name="filter_tm004disp" size="12"    />
		  </td>
	      
		  <td  width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_tm005" size="12" value="" />
		  </td>
		  
		 <!--  <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_tm007" size="30" value="" />
		  </td>
		  
	     <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_create" size="12" value="" />
		  </td> -->
	      <td width="10%" align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td width="10%" align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
		  <td width="10%" align="center"></td> 
        </tr>
		 <tbody>	
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->tm001."/".trim($row->tm002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>
		  <td class="left"><?php echo  $row->tm001;?></td>			  
		  <td class="left"><?php echo  $row->tm002;?></td>
		  <td class="left"><?php echo  substr($row->tm003,0,4).'/'.substr($row->tm003,4,2).'/'.substr($row->tm003,6,2);?></td>
		  <td class="left"><?php echo  $row->tm004;?></td>
		  <td class="left"><?php echo  $row->tm004disp;?></td>
		  <td class="left"><?php echo  $row->tm005;?></td>
		  <td class="left"><?php echo  $row->tm007;?></td>
	<!--	  <td class="center"><?php echo  substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>	-->	                 			
		
		  <td class="center"><a href="<?php echo site_url('moc/moci10/see/'.$row->tm001.'/'.$row->tm002) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
		  <td class="center"><a href="<?php echo site_url('moc/moci10/updform/'.$row->tm001.'/'.$row->tm002)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
		  <?PHP } ?>
	      <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
		  <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('moc/moci10/printbb/'.$row->tm001."/".trim($row->tm002))?>" id="print1"  >[ 印單據 </a><img src="<?php echo base_url()?>assets/image/png/Print1.png" />]</td>
	      <?PHP } ?>
	      <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('moc/moci10/del/'.$row->tm001."/".trim($row->tm002))?>" id="delete1"  >[ 刪除 ]</a></td>   -->
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

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
   // window.open('/index.php/moc/moci10/printdetail')
	window.location="<?php echo base_url()?>index.php/moc/moci10/printdetail";
  }
  function open_winprint1()
  {
 //   window.open('/index.php/moc/moci10/printdetailc')
	window.location="<?php echo base_url()?>index.php/moc/moci10/printdetailc";
  }

function open_winexcel()
  {
  //  window.open('/index.php/moc/moci10/exceldetail')
	window.location="<?php echo base_url()?>index.php/moc/moci10/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
		
	var filter_tm001 = $('input[name=\'filter_tm001\']').val();
	if (filter_tm001) {
		url = '<?php echo base_url() ?>index.php/moc/moci10/filter1/tm001/desc/' + encodeURIComponent(filter_tm001);
	} 
	
	var filter_tm002 = $('input[name=\'filter_tm002\']').val();
	if (filter_tm002) {
		url = '<?php echo base_url() ?>index.php/moc/moci10/filter1/tm002/desc/' + encodeURIComponent(filter_tm002);
	} 
	
	var filter_tm003 = $('input[name=\'filter_tm003\']').val();
	if (filter_tm003) {
		url = '<?php echo base_url() ?>index.php/moc/moci10/filter1/tm003/desc/' + encodeURIComponent(filter_tm003);
	}
	
	var filter_tm004 = $('input[name=\'filter_tm004\']').val();
	if (filter_tm004) {
		url = '<?php echo base_url() ?>index.php/moc/moci10/filter1/tm004/desc/' + encodeURIComponent(filter_tm004);
	}
	
	var filter_tm004disp = $('input[name=\'filter_tm004disp\']').val();
	if (filter_tm004disp) {
		url = '<?php echo base_url() ?>index.php/moc/moci10/filter1/b.ma002/desc/' + encodeURIComponent(filter_tm004disp); 
	}
		var filter_tm005 = $('input[name=\'filter_tm005\']').val();
	if (filter_tm005) {
		url = '<?php echo base_url() ?>index.php/moc/moci10/filter1/tm005/desc/' + encodeURIComponent(filter_tm005); 
	}
/*	var filter_tm007 = $('input[name=\'filter_tm007\']').val();
	if (filter_tm007) {
		url = '<?php echo base_url() ?>index.php/moc/moci10/filter1/tm007/desc/' + encodeURIComponent(filter_tm007); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/moc/moci10/filter1/a.create_date/desc/' + encodeURIComponent(filter_create); 
	}*/
	
    if ( !filter_tm001  && !filter_tm002 && !filter_tm003 && !filter_tm004 && !filter_tm004disp && !filter_tm005   ) {         
	   url = '<?php echo base_url() ?>index.php/moc/moci10/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_tm001 = $('input[name=\'filter_tm001\']').val();
	if (filter_tm001) {
		url = '<?php echo base_url() ?>index.php/moc/moci10/filter1/tm001/asc/' + encodeURIComponent(filter_tm001);
	} 
		
	var filter_tm002 = $('input[name=\'filter_tm002\']').val();
	if (filter_tm002) {
		url = '<?php echo base_url() ?>index.php/moc/moci10/filter1/tm002/asc/' + encodeURIComponent(filter_tm002);
	} 
	
	var filter_tm003 = $('input[name=\'filter_tm003\']').val();
	if (filter_tm003) {
		url = '<?php echo base_url() ?>index.php/moc/moci10/filter1/tm003/asc/' + encodeURIComponent(filter_tm003);
	}
	
	var filter_tm004 = $('input[name=\'filter_tm004\']').val();
	if (filter_tm004) {
		url = '<?php echo base_url() ?>index.php/moc/moci10/filter1/tm004/asc/' + encodeURIComponent(filter_tm004);
	}
	
	var filter_tm004disp = $('input[name=\'filter_tm004disp\']').val();
	if (filter_tm004disp) {
		url = '<?php echo base_url() ?>index.php/moc/moci10/filter1/b.ma002/asc/' + encodeURIComponent(filter_tm004disp); 
	}
	
	var filter_tm005 = $('input[name=\'filter_tm005\']').val();
	if (filter_tm005) {
		url = '<?php echo base_url() ?>index.php/moc/moci10/filter1/tm005/asc/' + encodeURIComponent(filter_tm005); 
	}
	/*var filter_tm007 = $('input[name=\'filter_tm007\']').val();
	if (filter_tm007) {
		url = '<?php echo base_url() ?>index.php/moc/moci10/filter1/tm007/asc/' + encodeURIComponent(filter_tm007); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/moc/moci10/filter1/a.create_date/asc/' + encodeURIComponent(filter_create); 
	} */
	
    if (!filter_tm001  && !filter_tm002 && !filter_tm003 && !filter_tm004 && !filter_tm004disp && !filter_tm005  ) {         
	   url = '<?php echo base_url() ?>index.php/moc/moci10/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 