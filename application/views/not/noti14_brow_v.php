<div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 信貸融資建立作業 - 瀏覽　　　</h1>
     <!--  <div class="buttons"> -->
	   <div style="float:left; "> 
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/not/noti14/addform'"  style="float:left"  accesskey="i" class="button"><span>新增 i </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/not/noti14/copyform'"  style="float:left"  accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/not/noti14/findform'"  style="float:left"  accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left"  accesskey="-" class="button"><span>刪除 - </span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
      <!-- <a onclick="$('form').submitb();"   class="button">印幣別匯率</a>   -->
	  <a onclick="location = '<?php echo base_url()?>index.php/not/noti14/printdetail'"    style="float:left"  accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a> 
	  <?PHP } ?>
	<!--
   	<?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/not/noti14/printdetailc'"   class="button"><span>印幣別匯率&nbsp</span><img src="<?php echo base_url()?>assets/image/png/print1.png" /></a> 
	  <?PHP } ?>
     -->
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/not/noti14/exceldetail'"   style="float:left"  accesskey="l" class="button"><span>excel檔 l</span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/not/noti14/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/not/noti14/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/110'"  style="float:left"  accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/not/noti14/delete" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="4%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="9%" class="left">
		  <?php echo anchor("not/noti14/display/a.me001/".(($sort_order == 'asc' && $sort_by == 'a.me001') ? 'desc' : 'asc') ,'信貸銀行'); ?>
           		  
	      </td>
	      <td width="9%" class="left">
	          <?php echo anchor("not/noti14/display/b.ma002/" . (($sort_order == 'asc' && $sort_by == 'b.ma002') ? 'desc' : 'asc') ,'銀行名稱'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="9%" class="left"> 
		  <?php echo anchor("not/noti14/display/a.me002/" . (($sort_order == 'asc' && $sort_by == 'a.me002') ? 'desc' : 'asc') ,'幣別'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="9%" class="left"> 
		  <?php echo anchor("not/noti14/display/a.me003/" . (($sort_order == 'asc' && $sort_by == 'a.me003') ? 'desc' : 'asc') ,'匯率'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
	      <td width="9%" class="left">
	          <?php echo anchor("not/noti14/display/a.me004/" .(($sort_order == 'asc' && $sort_by == 'a.me004') ? 'desc' : 'asc') ,'授信生效日'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="9%" class="left">
		  <?php echo anchor("not/noti14/display/a.me005/".(($sort_order == 'asc' && $sort_by == 'a.me005') ? 'desc' : 'asc') ,'授信到期日'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("not/noti14/display/a.me006/" . (($sort_order == 'asc' && $sort_by == 'a.me006') ? 'desc' : 'asc') ,'綜合額度'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		 
	      <td width="5%" class="center">
		  <?php echo anchor("not/noti14/display/a.me007/" . (($sort_order == 'asc' && $sort_by == 'a.me007') ? 'desc' : 'asc') ,'額度'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="16%" class="center">&nbsp查看管理&nbsp </td>
             <td width="16%" class="center">&nbsp修改管理&nbsp </td>
		   
            </tr>
          </thead>
		  
         <!-- <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_me001='';$filter_ma002='';$filter_me002='';$filter_me003='';$filter_me004='';$filter_me005='';$filter_me006='';$filter_me007=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	      <!--<td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>-->
			  
          <td  align="left">
		   <div class="button-search"></div>
		   <input type="text" id="filter_me001" name="filter_me001"  value="" size="10" />
		    </div>	
	      </td>
			  
	      <td  class="left">
		   <div  class="button-search"></div>
		   <input type="text" id="filter_ma002" name="filter_ma002"  value=""  size="12" />
		    </div>	
		  </td>
			  
	      <td  class="left">
		    <div class="button-search"></div>
			<input type="text" name="filter_me002" value="" size="12" />
		    </div>			  
	      </td>
			  
	      <td  align="left">
		   <div class="button-search"></div>
		   <input type="text" name="filter_me003" value=""  size="12"/>
		   </div>
		  </td>
          <td   align="left">
		  <div class="button-search"></div>
		   <input type="text" name="filter_me004" value=""  size="12" />
		   </div>
		  </td>
	      <td   align="left">
		  <div class="button-search"></div>
		   <input type="text" name="filter_me005" value=""  size="12" />
		   </div>
		  </td>
		  <td   align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_me006" value=""  size="12" />
		  </div>
		  </td>
		  
		  <td  align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_me007"  value=""  size="12" />
		  </div>
		  </td>
	     
	      <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
		 
        </tr>
		<tbody> 	
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->me001?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <!--<td class="left"><?php echo $chkval;?></td>-->
		  <td class="left"><?php echo $row->me001;?></td>			  
		  <td class="left"><?php echo $row->ma002;?></td>
		  <td class="left"><?php echo $row->me002;?></td>
		  <td class="right"><?php echo $row->me003;?></td>
		  <td class="left"><?php echo $row->me004;?></td>
		  <td class="left"><?php echo $row->me005;?></td>
		  <td class="right"><?php echo $row->me006;?></td>
		  <td class="right"><?php echo $row->me007;?></td>
		
		  <td class="center"><a href="<?php echo site_url('not/noti14/see/'.$row->me001) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
		  <td class="center"><a href="<?php echo site_url('not/noti14/updform/'.$row->me001)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
		  <?PHP } ?>
	  
	<!--      <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('not/noti14/del/'.$row->me001)?>" id="delete1"  >[ 刪除 </a><img src="<?php echo base_url()?>assets/image/png/del.png" />]</td>  --> 
	    </tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
          </tbody>		 
        </table>
		     
	      <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		  <?php  $this->session->set_userdata('search1',"display/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
			  
			
				<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 選欄位名稱自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 選取列項出現打勾可多筆刪除, 列印可自設網址列不印, 快速鍵Alt+.. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      </form>
    
    </div> <!-- div-2 -->
   </div>  <!-- div-1 -->
</div>	<!-- div-0 -->

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
   // window.open('/index.php/not/noti14/printdetail')
	window.location="<?php echo base_url()?>index.php/not/noti14/printdetail";
  }
  function open_winprint1()
  {
 //   window.open('/index.php/not/noti14/printdetailc')
	window.location="<?php echo base_url()?>index.php/not/noti14/printdetailc";
  }

function open_winexcel()
  {
  //  window.open('/index.php/not/noti14/exceldetail')
	window.location="<?php echo base_url()?>index.php/not/noti14/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
		
	var filter_me001 = $('input[name=\'filter_me001\']').val();
	if (filter_me001) {
		url = '<?php echo base_url() ?>index.php/not/noti14/filter1/a.me001/desc/' + encodeURIComponent(filter_me001);
	} 
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').val();
	if (filter_ma002) {
		url = '<?php echo base_url() ?>index.php/not/noti14/filter1/b.ma002/desc/' + encodeURIComponent(filter_ma002);
	} 
	
	var filter_me002 = $('input[name=\'filter_me002\']').val();
	if (filter_me002) {
		url = '<?php echo base_url() ?>index.php/not/noti14/filter1/a.me002/desc/' + encodeURIComponent(filter_me002);
	}
	
	var filter_me003 = $('input[name=\'filter_me003\']').val();
	if (filter_me003) {
		url = '<?php echo base_url() ?>index.php/not/noti14/filter1/a.me003/desc/' + encodeURIComponent(filter_me003);
	}
		
	var filter_me004 = $('input[name=\'filter_me004\']').val();
	if (filter_me004) {
		url = '<?php echo base_url() ?>index.php/not/noti14/filter1/a.me004/desc/' + encodeURIComponent(filter_me004); 
	}
	    
	var filter_me005 = $('input[name=\'filter_me005\']').val();
	if (filter_me005) {
		url = '<?php echo base_url() ?>index.php/not/noti14/filter1/a.me005/desc/' + encodeURIComponent(filter_me005); 
	}
	
	var filter_me006 = $('input[name=\'filter_me006\']').val();
	if (filter_me006) {
		url = '<?php echo base_url() ?>index.php/not/noti14/filter1/a.me006/desc/' + encodeURIComponent(filter_me006); 
	}
	
	var filter_me007 = $('input[name=\'filter_me007\']').val();
	if (filter_me007) {
		url = '<?php echo base_url() ?>index.php/not/noti14/filter1/a.me007/desc/' + encodeURIComponent(filter_me007); 
	}
	
    if ( !filter_me001  && !filter_ma002 && !filter_me002 && !filter_me003 && !filter_me004 && !filter_me005  && !filter_me007) {         
	   url = '<?php echo base_url() ?>index.php/not/noti14/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_me001 = $('input[name=\'filter_me001\']').val();
	if (filter_me001) {
		url = '<?php echo base_url() ?>index.php/not/noti14/filter1/a.me001/asc/' + encodeURIComponent(filter_me001);
	} 
		
	var filter_ma002 = $('input[name=\'filter_ma002\']').val();
	if (filter_ma002) {
		url = '<?php echo base_url() ?>index.php/not/noti14/filter1/b.ma002/asc/' + encodeURIComponent(filter_ma002);
	} 
	
	var filter_me002 = $('input[name=\'filter_me002\']').val();
	if (filter_me002) {
		url = '<?php echo base_url() ?>index.php/not/noti14/filter1/a.me002/asc/' + encodeURIComponent(filter_me002);
	}
	
	var filter_me003 = $('input[name=\'filter_me003\']').val();
	if (filter_me003) {
		url = '<?php echo base_url() ?>index.php/not/noti14/filter1/a.me003/asc/' + encodeURIComponent(filter_me003);
	}
		
	var filter_me004 = $('input[name=\'filter_me004\']').val();
	if (filter_me004) {
		url = '<?php echo base_url() ?>index.php/not/noti14/filter1/a.me004/asc/' + encodeURIComponent(filter_me004);
		
	}
	
	var filter_me005 = $('input[name=\'filter_me005\']').val();
	if (filter_me005) {
		url = '<?php echo base_url() ?>index.php/not/noti14/filter1/a.me005/asc/' + encodeURIComponent(filter_me005); 
	}
	
	var filter_me006 = $('input[name=\'filter_me006\']').val();
	if (filter_me006) {
		url = '<?php echo base_url() ?>index.php/not/noti14/filter1/a.me006/asc/' + encodeURIComponent(filter_me006); 
	}
	var filter_me007 = $('input[name=\'filter_me007\']').val();
	if (filter_me007) {
		url = '<?php echo base_url() ?>index.php/not/noti14/filter1/a.me007/asc/' + encodeURIComponent(filter_me007); 
	}
	
    if (!filter_me001  && !filter_ma002 && !filter_me002 && !filter_me003 && !filter_me004 && !filter_me005 && !filter_me006 && !filter_me007) {         
	   url = '<?php echo base_url() ?>index.php/not/noti14/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 