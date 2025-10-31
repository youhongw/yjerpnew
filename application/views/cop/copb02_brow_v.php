<div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 客戶訂單指定結案作業 - 瀏覽　　　</h1>
      <!--  <div class="buttons"> -->
	   <div style="float:left; "> 
	     <?PHP // } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copb02/clear_sql_term'"  style="float:left" accesskey="a" class="button"><span>重新整理 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copb02/findform'"  style="float:left" accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('#form').submit();"  style="float:left" accesskey="y" class="button"><span>選取結案 y </span><img src="<?php echo base_url()?>assets/image/png/ok.png" /></a>
      <?PHP } ?>
	<!--   <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
     
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copb02/printdetail'"   class="button"><span>列印&nbsp</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copb02/printdetailc'"   class="button"><span>印客戶訂單&nbsp</span><img src="<?php echo base_url()?>assets/image/png/print1.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copb02/exceldetail'"  class="button"><span>轉EXCEL檔&nbsp</span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?> -->
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/cop/copb02/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copb02/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/104'"  style="float:left"  accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a> 
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/cop/copb02/delete1" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="4%" class="left">
		  <?php echo anchor("cop/copb02/display/td001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?>
           		  
	      </td>
	      <td width="3%" class="left">
	          <?php echo anchor("cop/copb02/display/td001/" . (($sort_order == 'asc' && $sort_by == 'td001') ? 'desc' : 'asc') ,'訂單別'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left"> 
		  <?php echo anchor("cop/copb02/display/td002/" . (($sort_order == 'asc' && $sort_by == 'td002') ? 'desc' : 'asc') ,'客戶訂單號'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="2%" class="left"> 
		  <?php echo anchor("cop/copb02/display/td003/" . (($sort_order == 'asc' && $sort_by == 'td003') ? 'desc' : 'asc') ,'序號'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
	      <td width="5%" class="left">
	          <?php echo anchor("cop/copb02/display/td004/" .(($sort_order == 'asc' && $sort_by == 'td004') ? 'desc' : 'asc') ,'品號'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("cop/copb02/display/td005/".(($sort_order == 'asc' && $sort_by == 'td005') ? 'desc' : 'asc') ,'品名'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("cop/copb02/display/td006/" . (($sort_order == 'asc' && $sort_by == 'td006') ? 'desc' : 'asc') ,'規格'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		  
		  <td width="3%" class="left">
		  <?php echo anchor("cop/copb02/display/td008/" . (($sort_order == 'asc' && $sort_by == 'td008') ? 'desc' : 'asc') ,'訂單數量'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		  <td width="3%" class="left">
		  <?php echo anchor("cop/copb02/display/td009/" . (($sort_order == 'asc' && $sort_by == 'td009') ? 'desc' : 'asc') ,'未交數量'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		  <td width="3%" class="left">
		  <?php echo anchor("cop/copb02/display/td016/" . (($sort_order == 'asc' && $sort_by == 'td016') ? 'desc' : 'asc') ,'結案碼'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		   <td width="5%" class="left">
		  <?php echo anchor("cop/copb02/display/td013/" . (($sort_order == 'asc' && $sort_by == 'td013') ? 'desc' : 'asc') ,'預交日'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="center">
		  <?php echo anchor("cop/copb02/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">結案管理</td>
         <!--      <td width="12%" class="center">&nbsp修改管理&nbsp </td>
		      <td width="12%" class="center">&nbsp印客戶訂單&nbsp </td> -->
            </tr>
          </thead>
		  
         <!-- <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_td001='';$filter_td002='';$filter_td003='';$filter_td004='';$filter_td011='';$filter_td019='';$filter_td020='';$filter_create=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	      <td class="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
			  
          <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text" id="filter_td001" name="filter_td001" size="6" value=""   />
		   </div>	
	      </td>
			  
	      <td width="5%" class="left">
		   <div  class="button-search"></div>
		   <input type="text" id="filter_td002" name="filter_td002" size="10" value=""  />
		   </div>	
		  </td>
			  
	      <td width="3%" class="left">
		    <div class="button-search"></div>
			<input type="text" name="filter_td003" size="4" value="" />
		    </div>			  
	      </td>
			  
	      <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text" name="filter_td004" size="10" value="" />
		  </td>
          <td  width="5%" align="left">
		  <div class="button-search"></div>
		   <input type="text" name="filter_td005" size="10" value=""  />
		  </td>
	      
		  <td  width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_td006" size="10" value="" />
		  </td>
		  
		   <td  width="3%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_td008" size="8" value="" />
		  </td>
		   <td  width="3%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_td009" size="8" value="" />
		  </td>
		  
		  <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_td016" size="6"  value="" />
		  </td>
		  
	    <!--  <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_create"value="" size="10"/>
		  </td>  -->
	      <td width="5%" align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td width="5%" align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
		   <td width="7%" align="center"></td>  
        </tr>
		<tbody>	
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->td001."/".trim($row->td002)."/".trim($row->td003)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>
		  <td class="left"><?php echo  $row->td001;?></td>			  
		  <td class="left"><?php echo  $row->td002;?></td>
		  <td class="left"><?php echo  $row->td003;?></td>
		  <td class="left"><?php echo  $row->td004;?></td>
		  <td class="left"><?php echo  $row->td005;?></td>
		  <td class="left"><?php echo  $row->td006;?></td>
		  <td class="left"><?php echo  $row->td008;?></td>
		  <td class="left"><?php echo  $row->td008-$row->td009;?></td>
		  <td class="left"><?php echo  $row->td016;?></td>
		  <td class="center"><?php echo  substr($row->td013,0,4).'/'.substr($row->td013,4,2).'/'.substr($row->td013,6,2);?></td>
		  <td class="center"><?php echo  substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>		                 			
		
	 <!--	  <td class="center"><a href="<?php echo site_url('cop/copb02/see/'.$row->td001.'/'.$row->td002) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
		  <td class="center"><a href="<?php echo site_url('cop/copb02/updform/'.$row->td001.'/'.$row->td002)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
		  <?PHP } ?>
	      <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
		  <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('cop/copb02/printbb/'.$row->td001."/".trim($row->td002))?>" id="print1"  >[ 印單據 </a><img src="<?php echo base_url()?>assets/image/png/Print1.png" />]</td>
	      <?PHP } ?>  -->
	       <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('cop/copb02/del1/'.$row->td001."/".trim($row->td002)."/".trim($row->td003))?>" id="delete1"  >[ 取消結案 ]</a></td>   
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
   // window.open('/index.php/cop/copb02/printdetail')
	window.location="<?php echo base_url()?>index.php/cop/copb02/printdetail";
  }
  function open_winprint1()
  {
 //   window.open('/index.php/cop/copb02/printdetailc')
	window.location="<?php echo base_url()?>index.php/cop/copb02/printdetailc";
  }

function open_winexcel()
  {
  //  window.open('/index.php/cop/copb02/exceldetail')
	window.location="<?php echo base_url()?>index.php/cop/copb02/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
		
	var filter_td001 = $('input[name=\'filter_td001\']').val();
	if (filter_td001) {
		url = '<?php echo base_url() ?>index.php/cop/copb02/filter1/td001/desc/' + encodeURIComponent(filter_td001);
	} 
	
	var filter_td002 = $('input[name=\'filter_td002\']').val();
	if (filter_td002) {
		url = '<?php echo base_url() ?>index.php/cop/copb02/filter1/td002/desc/' + encodeURIComponent(filter_td002);
	} 
	
	var filter_td003 = $('input[name=\'filter_td003\']').val();
	if (filter_td003) {
		url = '<?php echo base_url() ?>index.php/cop/copb02/filter1/td003/desc/' + encodeURIComponent(filter_td003);
	}
	
	var filter_td004 = $('input[name=\'filter_td004\']').val();
	if (filter_td004) {
		url = '<?php echo base_url() ?>index.php/cop/copb02/filter1/td004/desc/' + encodeURIComponent(filter_td004);
	}
		
	var filter_td005 = $('input[name=\'filter_td005\']').val();
	if (filter_td005) {
		url = '<?php echo base_url() ?>index.php/cop/copb02/filter1/td005/desc/' + encodeURIComponent(filter_td005); 
	}
	
	var filter_td006 = $('input[name=\'filter_td006\']').val();
	if (filter_td006) {
		url = '<?php echo base_url() ?>index.php/cop/copb02/filter1/td006/desc/' + encodeURIComponent(filter_td006); 
	}
		var filter_td008 = $('input[name=\'filter_td008\']').val();
	if (filter_td008) {
		url = '<?php echo base_url() ?>index.php/cop/copb02/filter1/td008/desc/' + encodeURIComponent(filter_td008); 
	}
		var filter_td009 = $('input[name=\'filter_td009\']').val();
	if (filter_td009) {
		url = '<?php echo base_url() ?>index.php/cop/copb02/filter1/td009/desc/' + encodeURIComponent(filter_td009); 
	}
		var filter_td016 = $('input[name=\'filter_td016\']').val();
	if (filter_td016) {
		url = '<?php echo base_url() ?>index.php/cop/copb02/filter1/td016/desc/' + encodeURIComponent(filter_td016); 
	}
	
    if ( !filter_td001  && !filter_td002 && !filter_td003 && !filter_td004 && !filter_td005 && !filter_td006  && !filter_td008 && !filter_td009 && !filter_td016 ) {         
	   url = '<?php echo base_url() ?>index.php/cop/copb02/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_td001 = $('input[name=\'filter_td001\']').val();
	if (filter_td001) {
		url = '<?php echo base_url() ?>index.php/cop/copb02/filter1/td001/asc/' + encodeURIComponent(filter_td001);
	} 
		
	var filter_td002 = $('input[name=\'filter_td002\']').val();
	if (filter_td002) {
		url = '<?php echo base_url() ?>index.php/cop/copb02/filter1/td002/asc/' + encodeURIComponent(filter_td002);
	} 
	
	var filter_td003 = $('input[name=\'filter_td003\']').val();
	if (filter_td003) {
		url = '<?php echo base_url() ?>index.php/cop/copb02/filter1/td003/asc/' + encodeURIComponent(filter_td003);
	}
	
	var filter_td004 = $('input[name=\'filter_td004\']').val();
	if (filter_td004) {
		url = '<?php echo base_url() ?>index.php/cop/copb02/filter1/td004/asc/' + encodeURIComponent(filter_td004);
	}
		
	var filter_td005 = $('input[name=\'filter_td005\']').val();
	if (filter_td005) {
		url = '<?php echo base_url() ?>index.php/cop/copb02/filter1/td005/asc/' + encodeURIComponent(filter_td005);
		
	}
	
	var filter_td006 = $('input[name=\'filter_td006\']').val();
	if (filter_td006) {
		url = '<?php echo base_url() ?>index.php/cop/copb02/filter1/td006/asc/' + encodeURIComponent(filter_td006); 
	}
	var filter_td008 = $('input[name=\'filter_td008\']').val();
	if (filter_td008) {
		url = '<?php echo base_url() ?>index.php/cop/copb02/filter1/td008/asc/' + encodeURIComponent(filter_td008); 
	}
	var filter_td009 = $('input[name=\'filter_td009\']').val();
	if (filter_td009) {
		url = '<?php echo base_url() ?>index.php/cop/copb02/filter1/td009/asc/' + encodeURIComponent(filter_td009); 
	}
	var filter_td016 = $('input[name=\'filter_td016\']').val();
	if (filter_td016) {
		url = '<?php echo base_url() ?>index.php/cop/copb02/filter1/td016/asc/' + encodeURIComponent(filter_td016); 
	}
	
    if (!filter_td001  && !filter_td002 && !filter_td003 && !filter_td004 && !filter_td005 && !filter_td006 && !filter_td008  && !filter_td009 && !filter_td016) {         
	   url = '<?php echo base_url() ?>index.php/cop/copb02/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 