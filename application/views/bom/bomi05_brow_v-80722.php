<div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 組合單資料建立作業 - 瀏覽　　　</h1>
      <!--  <div class="buttons"> -->
	   <div style="float:left; "> 
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi05/addform'"  style="float:left" accesskey="i" class="button"><span>新增 i </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi05/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi05/findform'"  style="float:left" accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>刪除 - </span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
      <!-- <a onclick="$('form').submitb();"   class="button">印製造命令</a>   -->
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi05/printdetail'"   style="float:left"  accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi05/printdetailc'"   style="float:left"  accesskey="o" class="button"><span>印製造命令 o </span><img src="<?php echo base_url()?>assets/image/png/print1.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi05/exceldetail'"  style="float:left"  accesskey="l" class="button"><span>excel檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi05/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi05/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	 
	 <a onclick="location = '<?php echo base_url()?>index.php/main/index/107'"  style="float:left"  accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
       
	  </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/bom/bomi05/delete" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("bom/bomi05/display/td001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?>
           		  
	      </td>
	      <td width="10px" class="left">
	          <?php echo anchor("bom/bomi05/display/td001/" . (($sort_order == 'asc' && $sort_by == 'td001') ? 'desc' : 'asc') ,'組合單別'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("bom/bomi05/display/td002/" . (($sort_order == 'asc' && $sort_by == 'td002') ? 'desc' : 'asc') ,'組合單號'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("bom/bomi05/display/td014/" . (($sort_order == 'asc' && $sort_by == 'td014') ? 'desc' : 'asc') ,'單據日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
	      <td width="5%" class="left">
	          <?php echo anchor("bom/bomi05/display/td004/" .(($sort_order == 'asc' && $sort_by == 'td004') ? 'desc' : 'asc') ,'品號'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("bom/bomi05/display/td004disp/".(($sort_order == 'asc' && $sort_by == 'td004disp') ? 'desc' : 'asc') ,'品名'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("bom/bomi05/display/td004disp1/" . (($sort_order == 'asc' && $sort_by == 'td004disp1') ? 'desc' : 'asc') ,'規格'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		  <td width="5%" class="left">
		  <?php echo anchor("bom/bomi05/display/td005/" . (($sort_order == 'asc' && $sort_by == 'td005') ? 'desc' : 'asc') ,'單位'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		  <?php echo anchor("bom/bomi05/display/td007/" . (($sort_order == 'asc' && $sort_by == 'td007') ? 'desc' : 'asc') ,'成品數量'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="12%" class="center">&nbsp查看管理&nbsp </td>
             <td width="12%" class="center">&nbsp修改管理&nbsp </td>
		      <td width="12%" class="center">&nbsp印製造命令&nbsp </td>
            </tr>
          </thead>
		  
         <!-- <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_td001='';$filter_td002='';$filter_td014='';$filter_td004='';$filter_td004disp='';$filter_td004disp1='';$filter_td005='';$filter_td007=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	      <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
          <td width="10px" align="left">
		   <div class="button-search"></div>
		   <input type="text" id="filter_td001" name="filter_td001"  value="" size="12" />
		   </div>	
	      </td>
			  
	      <td width="5%" class="left">
		   <div  class="button-search"></div>
		   <input type="text" id="filter_td002" name="filter_td002"  value="" size="12" />
		   </div>	
		  </td>
			  
	      <td width="5%" class="left">
		    <div class="button-search"></div>
			<input type="text" name="filter_td014"  value="" size="12" />
		    </div>			  
	      </td>
			  
	      <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text" name="filter_td004" size="12" value="" />
		  </td>
          <td  width="5%" align="left">
		  <div class="button-search"></div>
		   <input type="text" name="filter_td004disp" size="16" value="" disabled />
		  </td>
	      
		  <td  width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_td004disp1" size="12" value="" />
		  </td>
		  
		  <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_td005" size="8" value="" />
		  </td>
		  
	      <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_td007" size="12" value="" />
		  </td>
	      <td width="10%" align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td width="10%" align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
		  <td width="10%" align="center"></td> 
        </tr>
		<tbody>	
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->td001."/".trim($row->td002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>
		  <td class="left"><?php echo  $row->td001;?></td>			  
		  <td class="left"><?php echo  $row->td002;?></td>
		  <td class="left"><?php echo  substr($row->td014,0,4).'/'.substr($row->td014,4,2).'/'.substr($row->td014,6,2);?></td>
		  <td class="left"><?php echo  $row->td004;?></td>
		  <td class="left"><?php echo  $row->td004disp;?></td>
		  <td class="left"><?php echo  $row->td004disp1;?></td>
		  <td class="left"><?php echo  $row->td005;?></td>
		  <td class="center"><?php echo  $row->td007;?></td>	                 			
		
		  <td class="center"><a href="<?php echo site_url('bom/bomi05/see/'.$row->td001.'/'.$row->td002) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
		  <td class="center"><a href="<?php echo site_url('bom/bomi05/updform/'.$row->td001.'/'.$row->td002)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
		  <?PHP } ?>
	      <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
		  <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('bom/bomi05/printbb/'.$row->td001."/".trim($row->td002))?>" id="print1"  >[ 印單據 </a><img src="<?php echo base_url()?>assets/image/png/Print1.png" />]</td>
	      <?PHP } ?>
	      <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('bom/bomi05/del/'.$row->td001."/".trim($row->td002))?>" id="delete1"  >[ 刪除 ]</a></td>   -->
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
   // window.open('/index.php/bom/bomi05/printdetail')
	window.location="<?php echo base_url()?>index.php/bom/bomi05/printdetail";
  }
  function open_winprint1()
  {
 //   window.open('/index.php/bom/bomi05/printdetailc')
	window.location="<?php echo base_url()?>index.php/bom/bomi05/printdetailc";
  }

function open_winexcel()
  {
  //  window.open('/index.php/bom/bomi05/exceldetail')
	window.location="<?php echo base_url()?>index.php/bom/bomi05/exceldetail";
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
		url = '<?php echo base_url() ?>index.php/bom/bomi05/filter1/td001/desc/' + encodeURIComponent(filter_td001);
	} 
	
	var filter_td002 = $('input[name=\'filter_td002\']').val();
	if (filter_td002) {
		url = '<?php echo base_url() ?>index.php/bom/bomi05/filter1/td002/desc/' + encodeURIComponent(filter_td002);
	} 
	
	var filter_td014 = $('input[name=\'filter_td014\']').val();
	if (filter_td014) {
		url = '<?php echo base_url() ?>index.php/bom/bomi05/filter1/td014/desc/' + encodeURIComponent(filter_td014);
	}
	
	var filter_td004 = $('input[name=\'filter_td004\']').val();
	if (filter_td004) {
		url = '<?php echo base_url() ?>index.php/bom/bomi05/filter1/td004/desc/' + encodeURIComponent(filter_td004);
	}
		
	var filter_td004disp = $('input[name=\'filter_td004disp\']').val();
	if (filter_td004disp) {
		url = '<?php echo base_url() ?>index.php/bom/bomi05/filter1/td004disp/desc/' + encodeURIComponent(filter_td004disp); 
	}
	
	var filter_td004disp1 = $('input[name=\'filter_td004disp1\']').val();
	if (filter_td004disp1) {
		url = '<?php echo base_url() ?>index.php/bom/bomi05/filter1/td004disp1/desc/' + encodeURIComponent(filter_td004disp1); 
	}
		var filter_td005 = $('input[name=\'filter_td005\']').val();
	if (filter_td005) {
		url = '<?php echo base_url() ?>index.php/bom/bomi05/filter1/td005/desc/' + encodeURIComponent(filter_td005); 
	}
	
	var filter_td007 = $('input[name=\'filter_td007\']').val();
	if (filter_td007) {
		url = '<?php echo base_url() ?>index.php/bom/bomi05/filter1/td007/desc/' + encodeURIComponent(filter_td007); 
	}
	
    if ( !filter_td001  && !filter_td002 && !filter_td014 && !filter_td004 && !filter_td004disp && !filter_td004disp1  && !filter_td005 && !filter_td007) {         
	   url = '<?php echo base_url() ?>index.php/bom/bomi05/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_td001 = $('input[name=\'filter_td001\']').val();
	if (filter_td001) {
		url = '<?php echo base_url() ?>index.php/bom/bomi05/filter1/td001/asc/' + encodeURIComponent(filter_td001);
	} 
		
	var filter_td002 = $('input[name=\'filter_td002\']').val();
	if (filter_td002) {
		url = '<?php echo base_url() ?>index.php/bom/bomi05/filter1/td002/asc/' + encodeURIComponent(filter_td002);
	} 
	
	var filter_td003 = $('input[name=\'filter_td003\']').val();
	if (filter_td003) {
		url = '<?php echo base_url() ?>index.php/bom/bomi05/filter1/td003/asc/' + encodeURIComponent(filter_td003);
	}
	
	var filter_td006 = $('input[name=\'filter_td006\']').val();
	if (filter_td006) {
		url = '<?php echo base_url() ?>index.php/bom/bomi05/filter1/td006/asc/' + encodeURIComponent(filter_td006);
	}
		
	var filter_td006disp = $('input[name=\'filter_td006disp\']').val();
	if (filter_td006disp) {
		url = '<?php echo base_url() ?>index.php/bom/bomi05/filter1/td006disp/asc/' + encodeURIComponent(filter_td006disp);
		
	}
	
	var filter_td006disp1 = $('input[name=\'filter_td006disp1\']').val();
	if (filter_td006disp1) {
		url = '<?php echo base_url() ?>index.php/bom/bomi05/filter1/td006disp1/asc/' + encodeURIComponent(filter_td006disp1); 
	}
	var filter_td015 = $('input[name=\'filter_td015\']').val();
	if (filter_td01) {
		url = '<?php echo base_url() ?>index.php/bom/bomi05/filter1/td015/asc/' + encodeURIComponent(filter_td015); 
	}
	
	var filter_td011 = $('input[name=\'filter_td011\']').val();
	if (filter_td011) {
		url = '<?php echo base_url() ?>index.php/bom/bomi05/filter1/td011/asc/' + encodeURIComponent(filter_td011); 
	}
	
    if (!filter_td001  && !filter_td002 && !filter_td003 && !filter_td006 && !filter_td006disp && !filter_td006disp && !filter_td015 && !filter_td011) {         
	   url = '<?php echo base_url() ?>index.php/bom/bomi05/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 