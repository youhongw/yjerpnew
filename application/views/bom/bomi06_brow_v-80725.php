<div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 拆解單資料建立作業 - 瀏覽　　　</h1>
      <!--  <div class="buttons"> -->
	   <div style="float:left; "> 
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi06/addform'"  style="float:left" accesskey="i" class="button"><span>新增 i </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi06/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi06/findform'"  style="float:left" accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>刪除 - </span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
      <!-- <a onclick="$('form').submitb();"   class="button">印製造命令</a>   -->
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi06/printdetail'"   style="float:left"  accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi06/printdetailc'"   style="float:left"  accesskey="o" class="button"><span>印拆解單 o </span><img src="<?php echo base_url()?>assets/image/png/print1.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi06/exceldetail'"  style="float:left"  accesskey="l" class="button"><span>excel檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi06/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi06/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	 
	 <a onclick="location = '<?php echo base_url()?>index.php/main/index/107'"  style="float:left"  accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
       
	  </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/bom/bomi06/delete" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("bom/bomi06/display/tf001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?>
           		  
	      </td>
	      <td width="10px" class="left">
	          <?php echo anchor("bom/bomi06/display/tf001/" . (($sort_order == 'asc' && $sort_by == 'tf001') ? 'desc' : 'asc') ,'拆解單別'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("bom/bomi06/display/tf002/" . (($sort_order == 'asc' && $sort_by == 'tf002') ? 'desc' : 'asc') ,'拆解單號'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("bom/bomi06/display/tf012/" . (($sort_order == 'asc' && $sort_by == 'tf012') ? 'desc' : 'asc') ,'單據日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
	      <td width="5%" class="left">
	          <?php echo anchor("bom/bomi06/display/tf004/" .(($sort_order == 'asc' && $sort_by == 'tf004') ? 'desc' : 'asc') ,'品號'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("bom/bomi06/display/tf004disp/".(($sort_order == 'asc' && $sort_by == 'tf004disp') ? 'desc' : 'asc') ,'品名'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("bom/bomi06/display/tf004disp1/" . (($sort_order == 'asc' && $sort_by == 'tf004disp1') ? 'desc' : 'asc') ,'規格'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		  <td width="5%" class="left">
		  <?php echo anchor("bom/bomi06/display/tf005/" . (($sort_order == 'asc' && $sort_by == 'tf005') ? 'desc' : 'asc') ,'單位'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		  <?php echo anchor("bom/bomi06/display/tf007/" . (($sort_order == 'asc' && $sort_by == 'tf007') ? 'desc' : 'asc') ,'成品數量'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="12%" class="center">&nbsp查看管理&nbsp </td>
             <td width="12%" class="center">&nbsp修改管理&nbsp </td>
		      <td width="12%" class="center">&nbsp印製造命令&nbsp </td>
            </tr>
          </thead>
		  
         <!-- <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_tf001='';$filter_tf002='';$filter_tf014='';$filter_tf004='';$filter_tf004disp='';$filter_tf004disp1='';$filter_tf005='';$filter_tf007=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	      <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
          <td width="10px" align="left">
		   <div class="button-search"></div>
		   <input type="text" id="filter_tf001" name="filter_tf001"  value="" size="12" />
		   </div>	
	      </td>
			  
	      <td width="5%" class="left">
		   <div  class="button-search"></div>
		   <input type="text" id="filter_tf002" name="filter_tf002"  value="" size="12" />
		   </div>	
		  </td>
			  
	      <td width="5%" class="left">
		    <div class="button-search"></div>
			<input type="text" name="filter_tf012"  value="" size="12" />
		    </div>			  
	      </td>
			  
	      <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text" name="filter_tf004" size="12" value="" />
		  </td>
          <td  width="5%" align="left">
		  <div class="button-search"></div>
		   <input type="text" name="filter_tf004disp" size="16" value="" disabled />
		  </td>
	      
		  <td  width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_tf004disp1" size="12" value="" disabled />
		  </td>
		  
		  <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_tf005" size="8" value="" />
		  </td>
		  
	      <td width="5%" align="left">
		  <div class="button-search"></div>
		  <input type="text" name="filter_tf007" size="12" value="" />
		  </td>
	      <td width="10%" align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td width="10%" align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
		  <td width="10%" align="center"></td> 
        </tr>
		<tbody>	
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->tf001."/".trim($row->tf002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>
		  <td class="left"><?php echo  $row->tf001;?></td>			  
		  <td class="left"><?php echo  $row->tf002;?></td>
		  <td class="left"><?php echo  substr($row->tf012,0,4).'/'.substr($row->tf012,4,2).'/'.substr($row->tf012,6,2);?></td>
		  <td class="left"><?php echo  $row->tf004;?></td>
		  <td class="left"><?php echo  $row->tf004disp;?></td>
		  <td class="left"><?php echo  $row->tf004disp1;?></td>
		  <td class="left"><?php echo  $row->tf005;?></td>
		  <td class="center"><?php echo  $row->tf007;?></td>	                 			
		
		  <td class="center"><a href="<?php echo site_url('bom/bomi06/see/'.$row->tf001.'/'.$row->tf002) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
		  <td class="center"><a href="<?php echo site_url('bom/bomi06/updform/'.$row->tf001.'/'.$row->tf002)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
		  <?PHP } ?>
	      <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
		  <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('bom/bomi06/printbb/'.$row->tf001."/".trim($row->tf002))?>" id="print1"  >[ 印單據 </a><img src="<?php echo base_url()?>assets/image/png/Print1.png" />]</td>
	      <?PHP } ?>
	      <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('bom/bomi06/del/'.$row->tf001."/".trim($row->tf002))?>" id="delete1"  >[ 刪除 ]</a></td>   -->
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
   // window.open('/index.php/bom/bomi06/printdetail')
	window.location="<?php echo base_url()?>index.php/bom/bomi06/printdetail";
  }
  function open_winprint1()
  {
 //   window.open('/index.php/bom/bomi06/printdetailc')
	window.location="<?php echo base_url()?>index.php/bom/bomi06/printdetailc";
  }

function open_winexcel()
  {
  //  window.open('/index.php/bom/bomi06/exceldetail')
	window.location="<?php echo base_url()?>index.php/bom/bomi06/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
		
	var filter_tf001 = $('input[name=\'filter_tf001\']').val();
	if (filter_tf001) {
		url = '<?php echo base_url() ?>index.php/bom/bomi06/filter1/tf001/desc/' + encodeURIComponent(filter_tf001);
	} 
	
	var filter_tf002 = $('input[name=\'filter_tf002\']').val();
	if (filter_tf002) {
		url = '<?php echo base_url() ?>index.php/bom/bomi06/filter1/tf002/desc/' + encodeURIComponent(filter_tf002);
	} 
	
	var filter_tf014 = $('input[name=\'filter_tf014\']').val();
	if (filter_tf014) {
		url = '<?php echo base_url() ?>index.php/bom/bomi06/filter1/tf014/desc/' + encodeURIComponent(filter_tf014);
	}
	
	var filter_tf004 = $('input[name=\'filter_tf004\']').val();
	if (filter_tf004) {
		url = '<?php echo base_url() ?>index.php/bom/bomi06/filter1/tf004/desc/' + encodeURIComponent(filter_tf004);
	}
		
	var filter_tf004disp = $('input[name=\'filter_tf004disp\']').val();
	if (filter_tf004disp) {
		url = '<?php echo base_url() ?>index.php/bom/bomi06/filter1/tf004disp/desc/' + encodeURIComponent(filter_tf004disp); 
	}
	
	var filter_tf004disp1 = $('input[name=\'filter_tf004disp1\']').val();
	if (filter_tf004disp1) {
		url = '<?php echo base_url() ?>index.php/bom/bomi06/filter1/tf004disp1/desc/' + encodeURIComponent(filter_tf004disp1); 
	}
		var filter_tf005 = $('input[name=\'filter_tf005\']').val();
	if (filter_tf005) {
		url = '<?php echo base_url() ?>index.php/bom/bomi06/filter1/tf005/desc/' + encodeURIComponent(filter_tf005); 
	}
	
	var filter_tf007 = $('input[name=\'filter_tf007\']').val();
	if (filter_tf007) {
		url = '<?php echo base_url() ?>index.php/bom/bomi06/filter1/tf007/desc/' + encodeURIComponent(filter_tf007); 
	}
	
    if ( !filter_tf001  && !filter_tf002 && !filter_tf014 && !filter_tf004 && !filter_tf004disp && !filter_tf004disp1  && !filter_tf005 && !filter_tf007) {         
	   url = '<?php echo base_url() ?>index.php/bom/bomi06/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_tf001 = $('input[name=\'filter_tf001\']').val();
	if (filter_tf001) {
		url = '<?php echo base_url() ?>index.php/bom/bomi06/filter1/tf001/asc/' + encodeURIComponent(filter_tf001);
	} 
		
	var filter_tf002 = $('input[name=\'filter_tf002\']').val();
	if (filter_tf002) {
		url = '<?php echo base_url() ?>index.php/bom/bomi06/filter1/tf002/asc/' + encodeURIComponent(filter_tf002);
	} 
	
	var filter_tf003 = $('input[name=\'filter_tf003\']').val();
	if (filter_tf003) {
		url = '<?php echo base_url() ?>index.php/bom/bomi06/filter1/tf003/asc/' + encodeURIComponent(filter_tf003);
	}
	
	var filter_tf006 = $('input[name=\'filter_tf006\']').val();
	if (filter_tf006) {
		url = '<?php echo base_url() ?>index.php/bom/bomi06/filter1/tf006/asc/' + encodeURIComponent(filter_tf006);
	}
		
	var filter_tf006disp = $('input[name=\'filter_tf006disp\']').val();
	if (filter_tf006disp) {
		url = '<?php echo base_url() ?>index.php/bom/bomi06/filter1/tf006disp/asc/' + encodeURIComponent(filter_tf006disp);
		
	}
	
	var filter_tf006disp1 = $('input[name=\'filter_tf006disp1\']').val();
	if (filter_tf006disp1) {
		url = '<?php echo base_url() ?>index.php/bom/bomi06/filter1/tf006disp1/asc/' + encodeURIComponent(filter_tf006disp1); 
	}
	var filter_tf015 = $('input[name=\'filter_tf015\']').val();
	if (filter_tf01) {
		url = '<?php echo base_url() ?>index.php/bom/bomi06/filter1/tf015/asc/' + encodeURIComponent(filter_tf015); 
	}
	
	var filter_tf011 = $('input[name=\'filter_tf011\']').val();
	if (filter_tf011) {
		url = '<?php echo base_url() ?>index.php/bom/bomi06/filter1/tf011/asc/' + encodeURIComponent(filter_tf011); 
	}
	
    if (!filter_tf001  && !filter_tf002 && !filter_tf003 && !filter_tf006 && !filter_tf006disp && !filter_tf006disp && !filter_tf015 && !filter_tf011) {         
	   url = '<?php echo base_url() ?>index.php/bom/bomi06/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 