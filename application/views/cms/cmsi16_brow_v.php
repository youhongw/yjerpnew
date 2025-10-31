<div class="box2"> <!-- div-1 -->
    <div class="heading"> 
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 金融機構建立作業 - 瀏覽　　　</h1>
     <!--  <div class="buttons"> -->
	   <div style="float:left; "> 
	    <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi16/clear_sql_term'"  style="float:left" accesskey="a" class="button"><span>重整 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi16/addform'"  style="float:left"  accesskey="i" class="button"><span>新增 i </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi16/copyform'"  style="float:left"  accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>        
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi16/findform'"  style="float:left"  accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>        
	  <a onclick="$('form').submit();"  style="float:left"   accesskey="-" class="button"><span>刪除 - </span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi16/printdetail'"  style="float:left"    accesskey="p" class="button">列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi16/exceldetail'"  style="float:left"    accesskey="l" class="button">EXCEL l </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi16/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi16/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/101'"  style="float:left"  accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/cms/cmsi16/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
        <thead>
          <tr>                          <!-- 表格表頭 -->
            <td width="1%" style="text-align: center;">
		    <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	        </td>
	        <td width="5%" class="left">
		    <?php echo anchor("cms/cmsi16/display/mo001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?> 
	        </td>
	        <td width="7%" class="left">
	        <?php echo anchor("cms/cmsi16/display/mo001/" . (($sort_order == 'asc' && $sort_by == 'mo001') ? 'desc' : 'asc') ,'金融機構代號'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="7%" class="left"> 
		    <?php echo anchor("cms/cmsi16/display/mo002/" . (($sort_order == 'asc' && $sort_by == 'mo002') ? 'desc' : 'asc') ,'金融機構種類'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="7%" class="left"> 
		    <?php echo anchor("cms/cmsi16/display/mo003/" . (($sort_order == 'asc' && $sort_by == 'mo003') ? 'desc' : 'asc') ,'金融機構總行'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
            </td>
	        <td width="8%" class="left">
	        <?php echo anchor("cms/cmsi16/display/mo004/" .(($sort_order == 'asc' && $sort_by == 'mo004') ? 'desc' : 'asc') ,'金融機構地區'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	        </td>
	        <td width="8%" class="left">
		    <?php echo anchor("cms/cmsi16/display/mo005/" . (($sort_order == 'asc' && $sort_by == 'mo005') ? 'desc' : 'asc') ,'金融機構分行'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="16%" class="left">
		    <?php echo anchor("cms/cmsi16/display/mo006/" . (($sort_order == 'asc' && $sort_by == 'mo006') ? 'desc' : 'asc') ,'金融機構名稱'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="7%" class="center">
		    <?php echo anchor("cms/cmsi16/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	      <td width="18%" class="center">&nbsp查看管理&nbsp </td>
          <td width="18%" class="center">&nbsp修改管理&nbsp </td>
        </tr>
        </thead>
		  
      <!--  <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	    <?php $filter_mo001='*';$filter_mo002='';$filter_mo003='';$filter_mo004='';$filter_mo005='';$filter_mo006='';$filter_create=''; ?>
	     <tr class="filter">
	       <td class="left"></td>
	       <td class="left">&nbsp&nbsp&nbsp&nbsp</td>
			  
           <td align="left">
		   <div class="button-search"></div>
		     <input type="text" id="filter_mo001" name="filter_mo001" value="" size='14'  />
	       </td>
			  
	       <td align="left">
		  <div class="button-search"></div>	  
		      <select name="filter_mo002" >
                    <option value="*"></option>
                    <option  value="1">1:本國銀行</option>
                    <option  value="2">2:外國銀行</option>
                    <option  value="3">3:信託投資</option>
                    <option  value="4">4:票券金融</option>
                    <option  value="5">5:信用合作社</option>
                    <option  value="6">6:產物保險</option>
                    <option  value="7">7:漁會信用</option>
                    <option  value="8">8:農會信用</option>  	
                    <option  value="9">9:郵局</option>  						
                 </select>
		  </div>
	      </td>
			  
	      <td class="left">
		  <!--  <div id="search">  -->
		  <div class="button-search"></div>
			<input type="text" name="filter_mo003" value="" size='14'  />
		  <!-- </div>	-->		  
	      </td>
			  
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_mo004" value="" size='14'   />
		  </td>
          <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_mo005" value="" size='14'   />
		  </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_mo006" value="" size='14'  />
		  </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_create" value="" size='14'   />
		  </td>
	    <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	    <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td>  
	    <!-- <button type='submit'  name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
      </tr>
	  <tbody>
		<!--session 變數取消 	  
		<?php $this->session->unset_userdata('mo002'); ?> -->
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->mo001?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>		
		  <td class="left"><?php echo  $row->mo001;?></td>			  
		  <td class="left"><?php echo  $row->mo002;?></td>
		  <td class="left"><?php echo  $row->mo003;?></td>
		  <td class="left"><?php echo  $row->mo004;?></td>
		  <td class="left"><?php echo  $row->mo005;?></td>
		  <td class="left"><?php echo  $row->mo006;?></td>
		  <td class="center"><?php echo  substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>		                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('cms/cmsi16/del/'.$row->mo001."/".trim($row->mo002))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><a href="<?php echo site_url('cms/cmsi16/see/'.$row->mo001)?>">[ 查看</a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>            
		  <td class="center"><a href="<?php echo site_url('cms/cmsi16/updform/'.$row->mo001)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
	      <?PHP } ?>
		</tr>
		<?php $chkval += 1; ?>
		<?php endforeach;?>
        </tbody>		 
        </table>
		
		       <!-- 修改時 留在原來那一筆資料使用 -->
	          <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		    <!--    <?php echo $this->pagination->create_links();?>	
			    <?php echo $this->session->userdata('find05');$find05; ?><?php echo $this->session->userdata('find07');$find07;  ?> -->
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
  //  window.open('/index.php/cms/cmsi16/printdetail')
	window.location="<?php echo base_url()?>index.php/cms/cmsi16/printdetail";
  }

function open_winexcel()
  {
  //  window.open('/index.php/cms/cmsi16/exceldetail')
	window.location="<?php echo base_url()?>index.php/cms/cmsi16/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_mo001 = $('input[name=\'filter_mo001\']').attr('value');
	if (filter_mo001) {
		url = '<?php echo base_url()?>index.php/cms/cmsi16/filter1/mo001/desc/' + encodeURIComponent(filter_mo001);
	}
	
	var filter_mo002 = $('select[name=\'filter_mo002\']').attr('value');
	if (filter_mo002 != '*') {
		url = '<?php echo base_url() ?>index.php/cms/cmsi16/filter1/mo002/desc/' + encodeURIComponent(filter_mo002);
	}

	
	var filter_mo003 = $('input[name=\'filter_mo003\']').attr('value');
	if (filter_mo003) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi16/filter1/mo003/desc/' + encodeURIComponent(filter_mo003);
	}
		
	var filter_mo004 = $('input[name=\'filter_mo004\']').attr('value');
	if (filter_mo004) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi16/filter1/mo004/desc/' + encodeURIComponent(filter_mo004); 
	}
	
	var filter_mo005 = $('input[name=\'filter_mo005\']').attr('value');
	if (filter_mo005) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi16/filter1/mo005/desc/' + encodeURIComponent(filter_mo005); 
	}
	
	var filter_mo006 = $('input[name=\'filter_mo006\']').attr('value');
	if (filter_mo006) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi16/filter1/mo006/desc/' + encodeURIComponent(filter_mo006); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi16/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if  (!filter_mo001 && filter_mo002 == '*'  && !filter_mo003 && !filter_mo004  && !filter_mo005 && !filter_mo006 && !filter_create) {            
	   url = '<?php echo base_url() ?>index.php/cms/cmsi16/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_mo001 = $('input[name=\'filter_mo001\']').val();
	if (filter_mo001) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi16/filter1/mo001/asc/' + encodeURIComponent(filter_mo001);
	}
	
	var filter_mo002 = $('select[name=\'filter_mo002\']').attr('value');
	if (filter_mo002 != '*') {
		url = '<?php echo base_url() ?>index.php/cms/cmsi16/filter1/mo002/asc/' + encodeURIComponent(filter_mo002);
	} 
	
	var filter_mo003 = $('input[name=\'filter_mo003\']').attr('value');
	if (filter_mo003) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi16/filter1/mo003/asc/' + encodeURIComponent(filter_mo003);
	}
		
	var filter_mo004 = $('input[name=\'filter_mo004\']').attr('value');
	if (filter_mo004) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi16/filter1/mo004/asc/' + encodeURIComponent(filter_mo004); 
	}
	
	var filter_mo005 = $('input[name=\'filter_mo005\']').attr('value');
	if (filter_mo005) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi16/filter1/mo005/asc/' + encodeURIComponent(filter_mo005); 
	}
	
	var filter_mo006 = $('input[name=\'filter_mo006\']').attr('value');
	if (filter_mo006) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi16/filter1/mo006/asc/' + encodeURIComponent(filter_mo006); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi16/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_mo001 && filter_mo002 == '*'  && !filter_mo003 && !filter_mo004  && !filter_mo005 && !filter_mo006 && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/cms/cmsi16/display';location = url;
	   
	   }
	   
	location = url;
}
</script>