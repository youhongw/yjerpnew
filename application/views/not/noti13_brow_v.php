<div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 融資種類建立作業 - 瀏覽　　　</h1>
     <!--  <div class="buttons"> -->
	   <div style="float:left; "> 
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/not/noti13/addform'"  style="float:left"  accesskey="+" class="button"><span>新增 i </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/not/noti13/copyform'"  style="float:left"  accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/not/noti13/findform'"  style="float:left"  accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left"  accesskey="-" class="button"><span>刪除 - </span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
      <!-- <a onclick="$('form').submitb();"   class="button">印幣別匯率</a>   -->
	  <a onclick="location = '<?php echo base_url()?>index.php/not/noti13/printdetail'"    style="float:left"  accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a> 
	  <?PHP } ?>
	<!--
   	<?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/not/noti13/printdetailc'"   class="button"><span>印幣別匯率&nbsp</span><img src="<?php echo base_url()?>assets/image/png/print1.png" /></a> 
	  <?PHP } ?>
     -->
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/not/noti13/exceldetail'"   style="float:left"  accesskey="l" class="button"><span>excel檔 l</span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/not/noti13/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/not/noti13/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/110'"  style="float:left"  accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/not/noti13/delete" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("not/noti13/display/mc001/".(($sort_order == 'asc' && $sort_by == 'mc001') ? 'desc' : 'asc') ,'融資種類'); ?>
           		  
	      </td>
	      <td width="10px" class="left">
	          <?php echo anchor("not/noti13/display/mc002/" . (($sort_order == 'asc' && $sort_by == 'mc002') ? 'desc' : 'asc') ,'融資名稱'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("not/noti13/display/mc003/" . (($sort_order == 'asc' && $sort_by == 'mc003') ? 'desc' : 'asc') ,'融資性質'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="12%" class="center">&nbsp查看管理&nbsp </td>
             <td width="12%" class="center">&nbsp修改管理&nbsp </td>
		   
            </tr>
          </thead>
		  
        <!--  <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_mc001='';$filter_mc002='';$filter_mc003=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	      <!--<td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>-->
			  
          <td width="10px" align="left">
		   <div class="button-search"></div>
		   <input type="text" id="filter_mc001" name="filter_mc001"  value="" size="10" />
		    </div>	
	      </td>
			  
	      <td width="5%" class="left">
		   <div  class="button-search"></div>
		   <input type="text" id="filter_mc002" name="filter_mc002"  value="" size="10"/>
		    </div>	
		  </td>
			  
	      <td width="5%" class="left">
		    <div class="button-search"></div>
			<input type="text" name="filter_mc003" value="" size="12" />
		    </div>			  
	      </td>
	     
	      <td width="10%" align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td width="10%" align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
		 
        </tr>
		<tbody>	
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->mc001?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <!--<td class="left"><?php echo $chkval;?></td>-->
		  <td class="left"><?php echo $row->mc001;?></td>			  
		  <td class="left"><?php echo $row->mc002;?></td>
		  <td class="left"><?php echo $row->mc003;?></td>
		  <?php $subject_ary= array( 1=>'1:L/C',2=>'2:INVOICE',3=>'3:應付商業本票/承兌匯票',4=>'4:應收票據',5=>'5:資產抵押',9=>'9:其它');?>
		
		  <td class="center"><a href="<?php echo site_url('not/noti13/see/'.$row->mc001.'/'.$row->mc001) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
		  <td class="center"><a href="<?php echo site_url('not/noti13/updform/'.$row->mc001.'/'.$row->mc001)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
		  <?PHP } ?>
	  
	<!--      <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('not/noti13/del/'.$row->mc001."/".trim($row->ma006))?>" id="delete1"  >[ 刪除 </a><img src="<?php echo base_url()?>assets/image/png/del.png" />]</td>  --> 
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
   // window.open('/index.php/not/noti13/printdetail')
	window.location="<?php echo base_url()?>index.php/not/noti13/printdetail";
  }
  function open_winprint1()
  {
 //   window.open('/index.php/not/noti13/printdetailc')
	window.location="<?php echo base_url()?>index.php/not/noti13/printdetailc";
  }

function open_winexcel()
  {
  //  window.open('/index.php/not/noti13/exceldetail')
	window.location="<?php echo base_url()?>index.php/not/noti13/exceldetail";
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
		url = '<?php echo base_url() ?>index.php/not/noti13/filter1/mc001/desc/' + encodeURIComponent(filter_mc001);
	} 
	
	var filter_ma006 = $('input[name=\'filter_ma006\']').val();
	if (filter_ma006) {
		url = '<?php echo base_url() ?>index.php/not/noti13/filter1/ma006/desc/' + encodeURIComponent(filter_ma006);
	} 
	
	var filter_ma004 = $('input[name=\'filter_ma004\']').val();
	if (filter_ma004) {
		url = '<?php echo base_url() ?>index.php/not/noti13/filter1/ma004/desc/' + encodeURIComponent(filter_ma004);
	}
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').val();
	if (filter_ma002) {
		url = '<?php echo base_url() ?>index.php/not/noti13/filter1/ma002/desc/' + encodeURIComponent(filter_ma002);
	}
		
	var filter_ma005 = $('input[name=\'filter_ma005\']').val();
	if (filter_ma005) {
		url = '<?php echo base_url() ?>index.php/not/noti13/filter1/ma005/desc/' + encodeURIComponent(filter_ma005); 
	}
	
	var filter_ma007 = $('input[name=\'filter_ma007\']').val();
	if (filter_ma007) {
		url = '<?php echo base_url() ?>index.php/not/noti13/filter1/ma007/desc/' + encodeURIComponent(filter_ma007); 
	}
	
	
	var filter_ma012 = $('input[name=\'filter_ma012\']').val();
	if (filter_ma012) {
		url = '<?php echo base_url() ?>index.php/not/noti13/filter1/create_date/desc/' + encodeURIComponent(filter_ma012); 
	}
	
    if ( !filter_mc001  && !filter_ma006 && !filter_ma004 && !filter_ma002 && !filter_ma005 && !filter_ma007  && !filter_ma012) {         
	   url = '<?php echo base_url() ?>index.php/not/noti13/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_mc001 = $('input[name=\'filter_mc001\']').val();
	if (filter_mc001) {
		url = '<?php echo base_url() ?>index.php/not/noti13/filter1/mc001/asc/' + encodeURIComponent(filter_mc001);
	} 
		
	var filter_ma006 = $('input[name=\'filter_ma006\']').val();
	if (filter_ma006) {
		url = '<?php echo base_url() ?>index.php/not/noti13/filter1/ma006/asc/' + encodeURIComponent(filter_ma006);
	} 
	
	var filter_ma004 = $('input[name=\'filter_ma004\']').val();
	if (filter_ma004) {
		url = '<?php echo base_url() ?>index.php/not/noti13/filter1/ma004/asc/' + encodeURIComponent(filter_ma004);
	}
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').val();
	if (filter_ma002) {
		url = '<?php echo base_url() ?>index.php/not/noti13/filter1/ma002/asc/' + encodeURIComponent(filter_ma002);
	}
		
	var filter_ma005 = $('input[name=\'filter_ma005\']').val();
	if (filter_ma005) {
		url = '<?php echo base_url() ?>index.php/not/noti13/filter1/ma005/asc/' + encodeURIComponent(filter_ma005);
		
	}
	
	var filter_ma007 = $('input[name=\'filter_ma007\']').val();
	if (filter_ma007) {
		url = '<?php echo base_url() ?>index.php/not/noti13/filter1/ma007/asc/' + encodeURIComponent(filter_ma007); 
	}
	
	var filter_ma008 = $('input[name=\'filter_ma008\']').val();
	if (filter_ma008) {
		url = '<?php echo base_url() ?>index.php/not/noti13/filter1/ma008/asc/' + encodeURIComponent(filter_ma008); 
	}
	var filter_ma012 = $('input[name=\'filter_ma012\']').val();
	if (filter_ma012) {
		url = '<?php echo base_url() ?>index.php/not/noti13/filter1/ma012/asc/' + encodeURIComponent(filter_ma012); 
	}
	
    if (!filter_mc001  && !filter_ma006 && !filter_ma004 && !filter_ma002 && !filter_ma005 && !filter_ma007 && !filter_ma008 && !filter_ma012) {         
	   url = '<?php echo base_url() ?>index.php/not/noti13/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 