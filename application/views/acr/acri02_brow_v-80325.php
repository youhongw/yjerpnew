<div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 結帳單資料建立作業 - 瀏覽</h1>
      <!--  <div class="buttons"> -->
	   <div style="float:right; "> 
	   <?PHP if ((substr($this->session->userdata('sysmg006'),1,1)=='Y') || ($this->session->userdata('syssuper')=='Y')) { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/acr/acri02/clear_sql_term'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/acr/acri02/addform'"  style="float:left" accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/acr/acri02/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/acr/acri02/findform'"  style="float:left" accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>選取刪除</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
      <!-- <a onclick="$('form').submitb();"   class="button">印結帳單</a>   -->
	  <a onclick="location = '<?php echo base_url()?>index.php/acr/acri02/printdetail'"    style="float:left" accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/acr/acri02/printdetailc'"   style="float:left"  accesskey="o" class="button"><span>印結帳單 o </span><img src="<?php echo base_url()?>assets/image/png/print1.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/acr/acri02/exceldetail'"  style="float:left" accesskey="l"  class="button"><span>轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/acr/acri02/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/acr/acri02/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/106'" style="float:left" accesskey="x"  class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a> 
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/acr/acri02/delete" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("acr/acri02/display/ta001/".(($sort_order == 'asc' && $sort_by == 'ta001') ? 'desc' : 'asc') ,'序號'); ?>
           		  
	      </td>
	      <td width="10px" class="left">
	          <?php echo anchor("acr/acri02/display/ta001/" . (($sort_order == 'asc' && $sort_by == 'ta001') ? 'desc' : 'asc') ,'結帳單別'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("acr/acri02/display/ta002/" . (($sort_order == 'asc' && $sort_by == 'ta002') ? 'desc' : 'asc') ,'結帳單號'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("acr/acri02/display/ta003/" . (($sort_order == 'asc' && $sort_by == 'ta003') ? 'desc' : 'asc') ,'單據日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
	      <td width="5%" class="left">
	          <?php echo anchor("acr/acri02/display/ta004/" .(($sort_order == 'asc' && $sort_by == 'ta004') ? 'desc' : 'asc') ,'客戶代號'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("acr/acri02/display/b.ma002/".(($sort_order == 'asc' && $sort_by == 'b.ma002') ? 'desc' : 'asc') ,'客戶名稱'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("acr/acri02/display/ta029/" . (($sort_order == 'asc' && $sort_by == 'ta029') ? 'desc' : 'asc') ,'應收金額'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		  <td width="5%" class="left">
		  <?php echo anchor("acr/acri02/display/ta030/" . (($sort_order == 'asc' && $sort_by == 'ta030') ? 'desc' : 'asc') ,'稅額'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		  <?php echo anchor("acr/acri02/display/ta027/" . (($sort_order == 'asc' && $sort_by == 'ta027') ? 'desc' : 'asc') ,'已收款'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="12%" class="center">&nbsp查看管理&nbsp </td>
             <td width="12%" class="center">&nbsp修改管理&nbsp </td>
		      <td width="12%" class="center">&nbsp印結帳單&nbsp </td>
            </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_ta001='';$filter_ta002='';$filter_ta003='';$filter_ta004='';$filter_ta004disp='';$filter_ta029='';$filter_ta030='';$filter_ta027=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	      <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
          <td width="10px" align="left">
		   <div class="button-search"></div>
		   <input type="text" id="filter_ta001" name="filter_ta001"  value="" size="12" />
		   
	      </td>
			  
	      <td width="5%" class="left">
		   <div  class="button-search"></div>
		   <input type="text" id="filter_ta002" name="filter_ta002"  value="" size="12" />
		  
		  </td>
			  
	      <td width="5%" class="left">
		    <div class="button-search"></div>
			<input type="text" name="filter_ta003" size="16" value="" size="12" />
		  		  
	      </td>
			  
	      <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text" name="filter_ta004" size="12" value="" />
		  </td>
		  
          <td  width="5%" align="left">
		  <div class="button-search"></div>
		   <input type="text"   name="filter_ta004disp" size="12" value=""  />
		  </td>
	      
		  <td  width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_ta029" size="12" value="" />
		  </td>
		  
		  <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_ta030" size="8" value="" />
		  </td>
		  
	      <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_ta027" size="12" value="" />
		  </td>
		  
	      <td width="10%" align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td width="10%" align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
		  <td width="10%" align="center"></td> 
        </tr>
			
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo$row->ta001."/".trim($row->ta002)."/".trim($row->ta027)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo $chkval;?></td>
		  <td class="left"><?php echo $row->ta001;?></td>			  
		  <td class="left"><?php echo $row->ta002;?></td>
		  <td class="left"><?php echo substr($row->ta003,0,4).'/'.substr($row->ta003,4,2).'/'.substr($row->ta003,6,2);?></td>
		  <td class="left"><?php echo $row->ta004;?></td>
		  <td class="left"><?php echo $row->ma002;?></td>
		  <td class="left"><?php echo $row->ta029;?></td>
		  <td class="left"><?php echo $row->ta030;?></td>
		  <td class="center"><?php echo $row->ta027;?></td>	                 			
		
		  <td class="center"><a href="<?php echo site_url('acr/acri02/see/'.$row->ta001.'/'.$row->ta002) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
		  <td class="center"><a href="<?php echo site_url('acr/acri02/updform/'.$row->ta001.'/'.$row->ta002)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
		  <?PHP } ?>
	      <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
		  <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('acr/acri02/printbb/'.$row->ta001."/".trim($row->ta002))?>" id="print1"  >[ 印單據 </a><img src="<?php echo base_url()?>assets/image/png/Print1.png" />]</td>
	      <?PHP } ?>
	      <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('acr/acri02/del/'.$row->ta001."/".trim($row->ta002))?>" id="delete1"  >[ 刪除 ]</a></td>   -->
	    </tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
          </tbody>		 
        </table>
		     
	      <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		  <?php  $this->session->set_userdata('search1',"display/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
			  
			
				<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$this->session->userdata('msg1').$message.'<span>'.'</span>'.
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      <?php  $this->session->unset_userdata('msg1'); ?>  
	  </form>
    
    </div> <!-- div-2 -->
   </div>  <!-- div-1 -->
</div>	<!-- div-0 -->

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
   // window.open('/index.php/acr/acri01/printdetail')
	window.location="<?php echo base_url()?>index.php/acr/acri01/printdetail";
  }

function open_winexcel()
  {
   //  window.open('/index.php/acr/acri01/exceldetail')
	window.location="<?php echo base_url()?>index.php/acr/acri01/exceldetail";
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
		url = '<?php echo base_url() ?>index.php/acr/acri02/filter1/ta001/desc/' + encodeURIComponent(filter_ta001);
	} 
	
	var filter_ta002 = $('input[name=\'filter_ta002\']').val();
	if (filter_ta002) {
		url = '<?php echo base_url() ?>index.php/acr/acri02/filter1/ta002/desc/' + encodeURIComponent(filter_ta002);
	} 
	
	var filter_ta003 = $('input[name=\'filter_ta003\']').val();
	if (filter_ta003) {
		url = '<?php echo base_url() ?>index.php/acr/acri02/filter1/ta003/desc/' + encodeURIComponent(filter_ta003);
	}
	
	var filter_ta004 = $('input[name=\'filter_ta004\']').val();
	if (filter_ta004) {
		url = '<?php echo base_url() ?>index.php/acr/acri02/filter1/ta004/desc/' + encodeURIComponent(filter_ta004);
	}
		
	var filter_ta004disp = $('input[name=\'filter_ta004disp\']').val();
	if (filter_ta004disp) {
		url = '<?php echo base_url() ?>index.php/acr/acri02/filter1/b.ma002/desc/' + encodeURIComponent(filter_ta004disp); 
	}
	
	var filter_ta029 = $('input[name=\'filter_ta029\']').val();
	if (filter_ta029) {
		url = '<?php echo base_url() ?>index.php/acr/acri02/filter1/ta029/desc/' + encodeURIComponent(filter_ta029); 
	}
		var filter_ta030 = $('input[name=\'filter_ta030\']').val();
	if (filter_ta030) {
		url = '<?php echo base_url() ?>index.php/acr/acri02/filter1/ta030/desc/' + encodeURIComponent(filter_ta030); 
	}
	
	var filter_ta027 = $('input[name=\'filter_ta027\']').val();
	if (filter_ta027) {
		url = '<?php echo base_url() ?>index.php/acr/acri02/filter1/ta027/desc/' + encodeURIComponent(filter_ta027); 
	}
	
    if ( !filter_ta001  && !filter_ta002 && !filter_ta003 && !filter_ta004 && !filter_ta004disp && !filter_ta030  && !filter_ta029 && !filter_ta027) {         
	   url = '<?php echo base_url() ?>index.php/acr/acri02/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_ta001 = $('input[name=\'filter_ta001\']').val();
	if (filter_ta001) {
		url = '<?php echo base_url() ?>index.php/acr/acri02/filter1/ta001/asc/' + encodeURIComponent(filter_ta001);
	} 
		
	var filter_ta002 = $('input[name=\'filter_ta002\']').val();
	if (filter_ta002) {
		url = '<?php echo base_url() ?>index.php/acr/acri02/filter1/ta002/asc/' + encodeURIComponent(filter_ta002);
	} 
	
	var filter_ta003 = $('input[name=\'filter_ta003\']').val();
	if (filter_ta003) {
		url = '<?php echo base_url() ?>index.php/acr/acri02/filter1/ta003/asc/' + encodeURIComponent(filter_ta003);
	}
	
	var filter_ta004 = $('input[name=\'filter_ta004\']').val();
	if (filter_ta004) {
		url = '<?php echo base_url() ?>index.php/acr/acri02/filter1/ta004/asc/' + encodeURIComponent(filter_ta004);
	}
		
	var filter_ta004disp = $('input[name=\'filter_ta004disp\']').val();
	if (filter_ta004disp) {
		url = '<?php echo base_url() ?>index.php/acr/acri02/filter1/b.ma002/asc/' + encodeURIComponent(filter_ta004disp);
		
	}
	
	var filter_ta029 = $('input[name=\'filter_ta029\']').val();
	if (filter_ta029) {
		url = '<?php echo base_url() ?>index.php/acr/acri02/filter1/ta029/asc/' + encodeURIComponent(filter_ta029); 
	}
	var filter_ta030 = $('input[name=\'filter_ta030\']').val();
	if (filter_ta030) {
		url = '<?php echo base_url() ?>index.php/acr/acri02/filter1/ta030/asc/' + encodeURIComponent(filter_ta030); 
	}
	
	var filter_ta027 = $('input[name=\'filter_ta027\']').val();
	if (filter_ta027) {
		url = '<?php echo base_url() ?>index.php/acr/acri02/filter1/ta027/asc/' + encodeURIComponent(filter_ta027); 
	}
	
    if (!filter_ta001  && !filter_ta002 && !filter_ta003 && !filter_ta004 && !filter_ta004disp && !filter_ta030 && !filter_ta029 && !filter_ta027) {         
	   url = '<?php echo base_url() ?>index.php/acr/acri02/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 