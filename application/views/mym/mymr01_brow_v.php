<div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> mymy訂單列印&導出 - 瀏覽</h1>
     <!--  <div class="buttons"> -->
	   <div style="float:right; "> 
	  <?PHP if (substr($this->session->userdata('sysmg006'),99099,1)=='Y') { ?>
	  <a onclick="location = '<?=base_url()?>index.php/mym/mymr01/addform'" style="float:left" class="button"><span>新增&nbsp</span><img src="<?=base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),99,1)=='Y') { ?>
	  <a onclick="location = '<?=base_url()?>index.php/mym/mymr01/copyform'" style="float:left" class="button"><span>複製&nbsp</span><img src="<?=base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?=base_url()?>index.php/mym/mymr01/findform'" style="float:left" accesskey="k" class="button"><span>進階查詢 k </span><img src="<?=base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),399,1)=='Y') { ?>
	  <a onclick="$('form').submit();" style="float:left" class="button"><span>選取刪除&nbsp</span><img src="<?=base_url()?>assets/image/png/del.png" /></a>
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),69,1)=='Y') { ?>
      <!-- <a onclick="$('form').submitb();"   class="button">印付款單</a>   -->
	  <a onclick="location = '<?=base_url()?>index.php/mym/mymr01/printdetail'"   style="float:left" class="button"><span>列印&nbsp</span><img src="<?=base_url()?>assets/image/png/print.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?=base_url()?>index.php/mym/mymr01/printdetailc'"   style="float:left" accesskey="p" class="button"><span>印銷貨單 p </span><img src="<?=base_url()?>assets/image/png/print1.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?=base_url()?>index.php/mym/mymr01/exceldetail'"  style="float:left" accesskey="+" class="button"><span>轉EXCEL檔 l </span><img src="<?=base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?=base_url()?>index.php/mym/mymr01/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?=base_url()?>index.php/mym/mymr01/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?=base_url()?>index.php/main'" style="float:left" accesskey="x" class="button"><span>關閉</span><img src="<?=base_url()?>assets/image/png/close.png" /></a> 
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?=base_url()?>index.php/mym/mymr01/delete" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("mym/mymr01/display/ta001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?>
           		  
	      </td>
	      <td width="10px" class="left">
	          <?php echo anchor("mym/mymr01/display/ta001/" . (($sort_order == 'asc' && $sort_by == 'ta001') ? 'desc' : 'asc') ,'訌單時間'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("mym/mymr01/display/ta002/" . (($sort_order == 'asc' && $sort_by == 'ta002') ? 'desc' : 'asc') ,'訂單編號'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("mym/mymr01/display/ta003/" . (($sort_order == 'asc' && $sort_by == 'ta003') ? 'desc' : 'asc') ,'購買人'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
	      <td width="5%" class="left">
	          <?php echo anchor("mym/mymr01/display/ta026/" .(($sort_order == 'asc' && $sort_by == 'ta026') ? 'desc' : 'asc') ,'貨運單號'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("mym/mymr01/display/ta031/".(($sort_order == 'asc' && $sort_by == 'ta031') ? 'desc' : 'asc') ,'商品編號'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("mym/mymr01/display/ta033/" . (($sort_order == 'asc' && $sort_by == 'ta033') ? 'desc' : 'asc') ,'商品數量'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		  <td width="5%" class="left">
		  <?php echo anchor("mym/mymr01/display/ta034/" . (($sort_order == 'asc' && $sort_by == 'ta034') ? 'desc' : 'asc') ,'商品單價'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		  <?php echo anchor("mym/mymr01/display/ta035/" . (($sort_order == 'asc' && $sort_by == 'ta035') ? 'desc' : 'asc') ,'商品小計'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?=base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?=base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	         <td width="12%" class="center">&nbsp查看管理&nbsp </td>
         <!--    <td width="12%" class="center">&nbsp修改管理&nbsp </td>  -->
		      <td width="12%" class="center">&nbsp印銷貨單&nbsp </td>
            </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_ta001='';$filter_ta002='';$filter_ta003='';$filter_ta026='';$filter_ta031='';$filter_ta033='';$filter_ta034='';$filter_ta035=''; ?>
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
			<input type="text" name="filter_ta003" size="16" value="" size="12" />
		    </div>			  
	      </td>
			  
	      <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text" name="filter_ta026" size="12" value="" />
		  </td>
          <td  width="5%" align="left">
		  <div class="button-search"></div>
		   <input type="text"   name="filter_ta031" size="12" value=""  />
		  </td>
	      
		  <td  width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_ta033" size="12" value="" />
		  </td>
		  
		  <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_ta034" size="8" value="" />
		  </td>
		  
	      <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_ta035" size="12" value="" />
		  </td>
	      <td width="10%" align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td width="10%" align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
	<!--	  <td width="10%" align="center"></td>  -->
        </tr>
			
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?=$row->ta001."/".trim($row->ta002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo $chkval;?></td>
		  <td class="left"><?php echo $row->ta001;?></td>			  
		  <td class="left"><?php echo $row->ta002;?></td>
		  <td class="left"><?php echo $row->ta003;?></td>
		  <td class="left"><?php echo $row->ta026;?></td>
		  <td class="left"><?php echo $row->ta031;?></td>
		  <td class="left"><?php echo $row->ta033;?></td>
		  <td class="left"><?php echo $row->ta034;?></td>
		  <td class="center"><?php echo $row->ta035;?></td>	                 			
		
		  <td class="center"><a href="<?php echo site_url('mym/mymr01/see/'.$row->ta001.'/'.$row->ta002) ?>">[ 查看 </a><img src="<?=base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
	<!--		  <td class="center"><a href="<?php echo site_url('mym/mymr01/updform/'.$row->ta001.'/'.$row->ta002)?>">[ 修改 </a><img src="<?=base_url()?>assets/image/png/modi.png" />]</td>
		  <?PHP } ?>  -->
	      <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
		  <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('mym/mymr01/printbb/'.trim($row->ta002))?>" id="print1"  >[ 印單據 </a><img src="<?=base_url()?>assets/image/png/print1.png" />]</td>
	      <?PHP } ?>
	      <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('mym/mymr01/del/'.$row->ta001."/".trim($row->ta002))?>" id="delete1"  >[ 刪除 ]</a></td>   -->
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
   // window.open('/index.php/mym/mymr01/printdetail')
	window.location="<?=base_url()?>index.php/mym/mymr01/printdetail";
  }
  function open_winprint1()
  {
 //   window.open('/index.php/mym/mymr01/printdetailc')
	window.location="<?=base_url()?>index.php/mym/mymr01/printdetailc";
  }

function open_winexcel()
  {
  //  window.open('/index.php/mym/mymr01/exceldetail')
	window.location="<?=base_url()?>index.php/mym/mymr01/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
		
	var filter_ta001 = $('input[name=\'filter_ta001\']').val();
	if (filter_ta001) {
		url = '<?=base_url() ?>index.php/mym/mymr01/filter1/ta001/desc/' + encodeURIComponent(filter_ta001);
	} 
	
	var filter_ta002 = $('input[name=\'filter_ta002\']').val();
	if (filter_ta002) {
		url = '<?=base_url() ?>index.php/mym/mymr01/filter1/ta002/desc/' + encodeURIComponent(filter_ta002);
	} 
	
	var filter_ta003 = $('input[name=\'filter_ta003\']').val();
	if (filter_ta003) {
		url = '<?=base_url() ?>index.php/mym/mymr01/filter1/ta003/desc/' + encodeURIComponent(filter_ta003);
	}
	
	var filter_ta026 = $('input[name=\'filter_ta026\']').val();
	if (filter_ta026) {
		url = '<?=base_url() ?>index.php/mym/mymr01/filter1/ta026/desc/' + encodeURIComponent(filter_ta026);
	}
		
	var filter_ta031 = $('input[name=\'filter_ta031\']').val();
	if (filter_ta031) {
		url = '<?=base_url() ?>index.php/mym/mymr01/filter1/ta031/desc/' + encodeURIComponent(filter_ta031); 
	}
	
	var filter_ta033 = $('input[name=\'filter_ta033\']').val();
	if (filter_ta033) {
		url = '<?=base_url() ?>index.php/mym/mymr01/filter1/ta033/desc/' + encodeURIComponent(filter_ta033); 
	}
		var filter_ta034 = $('input[name=\'filter_ta034\']').val();
	if (filter_ta034) {
		url = '<?=base_url() ?>index.php/mym/mymr01/filter1/ta034/desc/' + encodeURIComponent(filter_ta034); 
	}
	
	var filter_ta035 = $('input[name=\'filter_ta035\']').val();
	if (filter_ta035) {
		url = '<?=base_url() ?>index.php/mym/mymr01/filter1/ta035/desc/' + encodeURIComponent(filter_ta035); 
	}
	
    if ( !filter_ta001  && !filter_ta002 && !filter_ta003 && !filter_ta026 && !filter_ta031 && !filter_ta033  && !filter_ta034 && !filter_ta035) {         
	   url = '<?=base_url() ?>index.php/mym/mymr01/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_ta001 = $('input[name=\'filter_ta001\']').val();
	if (filter_ta001) {
		url = '<?=base_url() ?>index.php/mym/mymr01/filter1/ta001/asc/' + encodeURIComponent(filter_ta001);
	} 
		
	var filter_ta002 = $('input[name=\'filter_ta002\']').val();
	if (filter_ta002) {
		url = '<?=base_url() ?>index.php/mym/mymr01/filter1/ta002/asc/' + encodeURIComponent(filter_ta002);
	} 
	
	var filter_ta003 = $('input[name=\'filter_ta003\']').val();
	if (filter_ta003) {
		url = '<?=base_url() ?>index.php/mym/mymr01/filter1/ta003/asc/' + encodeURIComponent(filter_ta003);
	}
	
	var filter_ta026 = $('input[name=\'filter_ta026\']').val();
	if (filter_ta026) {
		url = '<?=base_url() ?>index.php/mym/mymr01/filter1/ta026/asc/' + encodeURIComponent(filter_ta026);
	}
		
	var filter_ta031 = $('input[name=\'filter_ta031\']').val();
	if (filter_ta031) {
		url = '<?=base_url() ?>index.php/mym/mymr01/filter1/ta031/asc/' + encodeURIComponent(filter_ta031);
		
	}
	
	var filter_ta033 = $('input[name=\'filter_ta033\']').val();
	if (filter_ta033) {
		url = '<?=base_url() ?>index.php/mym/mymr01/filter1/ta033/asc/' + encodeURIComponent(filter_ta033); 
	}
	var filter_ta034 = $('input[name=\'filter_ta034\']').val();
	if (filter_ta034) {
		url = '<?=base_url() ?>index.php/mym/mymr01/filter1/ta034/asc/' + encodeURIComponent(filter_ta034); 
	}
	
	var filter_ta035 = $('input[name=\'filter_ta035\']').val();
	if (filter_ta035) {
		url = '<?=base_url() ?>index.php/mym/mymr01/filter1/ta035/asc/' + encodeURIComponent(filter_ta035); 
	}
	
    if (!filter_ta001  && !filter_ta002 && !filter_ta003 && !filter_ta026 && !filter_ta031 && !filter_ta033 && !filter_ta034 && !filter_ta035) {         
	   url = '<?=base_url() ?>index.php/mym/mymr01/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 