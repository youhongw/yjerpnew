  <div class="box2">  <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 交易對象資料建立作業 - 瀏覽　　　</h1>
      <!--  <div class="buttons"> -->
	   <div style="float:left; "> 
	    <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi15/clear_sql_term'"  style="float:left" accesskey="a" class="button"><span>重整 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi15/addform'"  style="float:left" accesskey="i"class="button"><span>新增 i </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	   <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi15/copyform'"  style="float:left" accesskey="c"class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>    
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi15/findform'"  style="float:left" accesskey="k"class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>   
      <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>	  
	  <a onclick="$('form').submit();"  style="float:left" accesskey="-"class="button"><span>刪除</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	  <?PHP } ?>   
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi15/printdetail'"   style="float:left"  accesskey="p"class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  
	  <?PHP } ?> 
      <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>	 
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi15/exceldetail'"   style="float:left"  accesskey="l"class="button"><span>EXCEL l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a>  
	  <?PHP } ?> 
	  <!-- <a onclick="open_winprint();"  onclick="location = '<?php echo base_url()?>index.php/cms/cmsi15/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi15/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/101'"  style="float:left"  accesskey="x"class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/cms/cmsi15/delete" method="post" enctype="multipart/form-data" id="form">
      <table class="list">      <!-- 表格開始 -->
        <thead>
		  
          <tr>                          <!-- 表格表頭 -->
            <td width="1%" style="text-align: center;">
		     <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	        </td>
	        <td width="6%" class="center">
		     <?php echo anchor("cms/cmsi15/display/mr001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?> 
	        </td>
	        <td width="5%" class="center">
	         <?php echo anchor("cms/cmsi15/display/mr001/" . (($sort_order == 'asc' && $sort_by == 'mr001') ? 'desc' : 'asc') ,'分類'); ?>
			 <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		     <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="5%" class="center"> 
		    <?php echo anchor("cms/cmsi15/display/mr002/" . (($sort_order == 'asc' && $sort_by == 'mr002') ? 'desc' : 'asc') ,'分類代號'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="5%" class="center"> 
		    <?php echo anchor("cms/cmsi15/display/mr003/" . (($sort_order == 'asc' && $sort_by == 'mr003') ? 'desc' : 'asc') ,'分類簡稱'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
            </td>
	        <td width="5%" class="center">
	        <?php echo anchor("cms/cmsi15/display/mr004/" .(($sort_order == 'asc' && $sort_by == 'mr004') ? 'desc' : 'asc') ,'分類全名'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	        </td>
	        <td width="5%" class="center">
		    <?php echo anchor("cms/cmsi15/display/mr005/" . (($sort_order == 'asc' && $sort_by == 'mr005') ? 'desc' : 'asc') ,'備註'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	      
	        <td width="3%" class="center">
		    <?php echo anchor("cms/cmsi15/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="25%" class="center">&nbsp查看&nbsp</td>
          <td width="25%" class="center">&nbsp修改&nbsp</td>
         </tr>
        </thead>
		  
        <!--<tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	    <?php $filter_mr001='*';$filter_mr002='';$filter_mr003='';$filter_mr004='';$filter_mr005='';$filter_mr006='';$filter_create=''; ?>
	    <tr class="filter">
	      <td class="left"></td>
	      <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
          <td align="left">
		   <div class="button-search"></div>
		     <select name="filter_mr001" >
                     <option value="*"></option>
                     <option  value="1">1:通路</option>
                     <option  value="2">2:型態</option>
                     <option  value="3">3:地區</option>
                     <option  value="4">4:國家</option>
                     <option  value="5">5:路線</option>
                     <option  value="6">6:其他</option>
                     <option  value="7">7:抽成</option>
                     <option  value="8">8:活動</option> 
                     <option  value="9">9:廠商分類</option>  					 
             </select>
	      </td>
			  
	      <td class="left">
		   <div  class="button-search"></div>
		   <input type="text" id="filter_mr002" name="filter_mr002" value="" size="12"/>
		  </td>
			  
	      <td class="left">
		    <div class="button-search"></div>
			<input type="text" name="filter_mr003" value="" size="12"/>
	      </td>
			  
	      <td align="left">
		    <div class="button-search"></div>
		    <input type="text" name="filter_mr004" value="" size="15"  />
		  </td>
          <td align="left">
		    <div class="button-search"></div>
		    <input type="text" name="filter_mr005" value="" size="15"  />
		  </td>
	      
	      <td align="left">
		    <div class="button-search"></div>
		    <input type="text" name="filter_create" value="" size="15" />
		  </td>
		  
	      <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td>  
	      <!-- <button type='submit'  name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
        </tr>
		<tbody>
		<!--session 變數取消 	  -->
		<?php $this->session->unset_userdata('mr002'); ?> 
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->mr001."/".trim($row->mr002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>		
		  <?php if ($row->mr001=='1') {$vmr001='通路';} else {$vmr001='';}   ?>
          <?php if ($row->mr001=='2') {$vmr001='型態';}  ?>	
		  <?php if ($row->mr001=='3') {$vmr001='地區';}  ?>
		  <?php if ($row->mr001=='4') {$vmr001='國家';}  ?>
		  <?php if ($row->mr001=='5') {$vmr001='路線';}  ?>
		  <?php if ($row->mr001=='6') {$vmr001='其他';}  ?>
		  <?php if ($row->mr001=='7') {$vmr001='抽成';}  ?>
		  <?php if ($row->mr001=='8') {$vmr001='活動';}  ?>
		  <?php if ($row->mr001=='9') {$vmr001='廠商分類';}  ?>
         
		  <td class="left"><?php echo  $row->mr001.$vmr001;?></td>			  
		  <td class="left"><?php echo  $row->mr002;?></td>
		  <td class="left"><?php echo  $row->mr003;?></td>
		  <td class="left"><?php echo  $row->mr004;?></td>
		  <td class="left"><?php echo  $row->mr005;?></td>
		
		  <td class="center"><?php echo  substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>		                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('cms/cmsi15/del/'.$row->mr001."/".trim($row->mr002))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		
		  <td class="center"><a href="<?php echo site_url('cms/cmsi15/see/'.$row->mr001."/".trim($row->mr002))?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>	    
		  <td class="center"><a href="<?php echo site_url('cms/cmsi15/updform/'.$row->mr001."/".trim($row->mr002))?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
	      <?PHP } ?>   
		</tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
          </tbody>		 
        </table>
		     <!-- 修改時 留在原來那一筆資料使用 -->
	         <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		    
			<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      </form>
    </div> <!-- div-2 -->
   </div> <!-- div-1 -->
</div>	 <!-- div-0 -->

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
  //  window.open('/index.php/cms/cmsi15/printdetail')
	window.location="<?php echo base_url()?>index.php/cms/cmsi15/printdetail";
  }

function open_winexcel()
  {
  //  window.open('/index.php/cms/cmsi15/exceldetail')
	window.location="<?php echo base_url()?>index.php/cms/cmsi15/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_mr001 = $('select[name=\'filter_mr001\']').attr('value');
	if (filter_mr001 != '*') {
		url = '<?php echo base_url() ?>index.php/cms/cmsi15/filter1/mr001/desc/' + encodeURIComponent(filter_mr001);
	}
	
	var filter_mr002 = $('input[name=\'filter_mr002\']').attr('value');
	if (filter_mr002) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi15/filter1/mr002/desc/' + encodeURIComponent(filter_mr002);
	} 
	
	var filter_mr003 = $('input[name=\'filter_mr003\']').attr('value');
	if (filter_mr003) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi15/filter1/mr003/desc/' + encodeURIComponent(filter_mr003);
	}
		
	var filter_mr004 = $('input[name=\'filter_mr004\']').attr('value');
	if (filter_mr004) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi15/filter1/mr004/desc/' + encodeURIComponent(filter_mr004); 
	}
	
	var filter_mr005 = $('input[name=\'filter_mr005\']').attr('value');
	if (filter_mr005) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi15/filter1/mr005/desc/' + encodeURIComponent(filter_mr005); 
	}
	
	
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi15/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if (filter_mr001 == '*' && !filter_mr002  && !filter_mr003 && !filter_mr004  && !filter_mr005  && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/cms/cmsi15/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_mr001 = $('select[name=\'filter_mr001\']').attr('value');
	if (filter_mr001 != '*') {
		url = '<?php echo base_url() ?>index.php/cms/cmsi15/filter1/mr001/asc/' + encodeURIComponent(filter_mr001);
	}
	
	var filter_mr002 = $('input[name=\'filter_mr002\']').attr('value');
	if (filter_mr002) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi15/filter1/mr002/asc/' + encodeURIComponent(filter_mr002);
	} 
	
	var filter_mr003 = $('input[name=\'filter_mr003\']').attr('value');
	if (filter_mr003) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi15/filter1/mr003/asc/' + encodeURIComponent(filter_mr003);
	}
		
	var filter_mr004 = $('input[name=\'filter_mr004\']').attr('value');
	if (filter_mr004) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi15/filter1/mr004/asc/' + encodeURIComponent(filter_mr004); 
	}
	
	var filter_mr005 = $('input[name=\'filter_mr005\']').attr('value');
	if (filter_mr005) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi15/filter1/mr005/asc/' + encodeURIComponent(filter_mr005); 
	}
	
	
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi15/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (filter_mr001 == '*' && !filter_mr002  && !filter_mr003 && !filter_mr004  && !filter_mr005 &&  !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/cms/cmsi15/display';location = url;
	   
	   }
	   
	location = url;
}
</script>