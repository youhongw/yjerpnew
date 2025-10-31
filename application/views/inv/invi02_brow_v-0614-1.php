<div class="box2">  <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 品號基本資料建立作業 - 瀏覽</h1>
    <!--  <div class="buttons"> -->
	   <div style="float:right; "> 
	    <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/inv/invi02/clear_sql_term'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/inv/invi02/addform'" style="float:left" accesskey="+" class="button"><span>新增&nbsp</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/inv/invi02/copyform'" style="float:left" accesskey="c"  class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/inv/invi02/findform'" style="float:left" accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();" style="float:left" accesskey="-" class="button"><span>選取刪除&nbsp</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/inv/invi02/printdetail'" style="float:left" accesskey="p"  class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/inv/invi02/exceldetail'"  style="float:left" accesskey="l"  class="button"><span>轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/inv/invi02/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/inv/invi02/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/102'" style="float:left" accesskey="x" class="button"><span>關閉&nbsp</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/inv/invi02/delete" method="post" enctype="multipart/form-data" id="form">
      <table class="list">      <!-- 表格開始 -->
        <thead>
          <tr>                          <!-- 表格表頭 -->
            <td width="1%" style="text-align: center;">
		    <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	        </td>
	        <td width="5%" class="left">
		    <?php echo anchor("inv/invi02/display/mb025/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?>
	        </td>
			
	       
	        <td width="7%" class="left"> 
		    <?php echo anchor("inv/invi02/display/mb025/" . (($sort_order == 'asc' && $sort_by == 'mb025') ? 'desc' : 'asc') ,'品號'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
			<td width="5%" class="left">
	        <?php echo anchor("inv/invi02/display/mb001/" . (($sort_order == 'asc' && $sort_by == 'mb001') ? 'desc' : 'asc') ,'屬性'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="16%" class="left"> 
		    <?php echo anchor("inv/invi02/display/mb002/" . (($sort_order == 'asc' && $sort_by == 'mb002') ? 'desc' : 'asc') ,'品名'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
            </td>
	        <td width="8%" class="left">
	        <?php echo anchor("inv/invi02/display/mb003/" .(($sort_order == 'asc' && $sort_by == 'mb003') ? 'desc' : 'asc') ,'規格'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	        </td>
	        <td width="8%" class="left">
		    <?php echo anchor("inv/invi02/display/mb004/" . (($sort_order == 'asc' && $sort_by == 'mb004') ? 'desc' : 'asc') ,'單位'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="8%" class="left">
		    <?php echo anchor("inv/invi02/display/mb017/" . (($sort_order == 'asc' && $sort_by == 'mb017') ? 'desc' : 'asc') ,'主要庫別'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="7%" class="center">
		    <?php echo anchor("inv/invi02/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'產品圖'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="18%" class="center">&nbsp查看管理&nbsp </td>
            <td width="18%" class="center">&nbsp修改管理&nbsp </td>
          </tr>
        </thead>
		  
        <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	    <?php $filter_mb025='*';$filter_mb001='';$filter_mb002='';$filter_mb003='';$filter_mb004='';$filter_mb005='';$filter_mb006='';$filter_mb017='';$filter_create=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	      <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
	      <td class="left">
		  <div  class="button-search"></div>
			<input type="text" id="filter_mb001" name="filter_mb001" value="" />
		  </td>
			<td align="left">
		  <div class="button-search"></div>
		      <select name="filter_mb025" >
                    <option value="*"></option>
                    <option  value="P">P:採購件</option>
                    <option  value="M">M:自製件</option>
                    <option  value="S">S:託外加工件</option>
                    <option  value="Y">Y:虛設件</option>                                                                
               </select>
		  </div>
	      </td>  
	      <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_mb002" value="" />
	      </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_mb003" value="" />
		  </td>
          <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_mb004" value="" size="8" />
		  </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_mb017" value="" size="8" />
		  </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_create" value="" size="12" />
		  </td>
	      <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td>  
	      <!-- <button type='submit'  name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
        </tr>
			
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->mb001."/".trim($row->mb001)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>
          <td class="left"><?php echo  $row->mb001;?></td>				  
		  <td class="left"><?php echo  $row->mb025;?></td>			  
		  <td class="left"><?php echo  $row->mb002;?></td>
		  <td class="left"><?php echo  $row->mb003;?></td>
		  <td class="left"><?php echo  $row->mb004;?></td>
		  <td class="left"><?php echo  $row->mb017;?></td>
		<!--  <td class="center"> <?php echo  substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>	-->	              			
		  <td class="center"><img src="<?php echo base_url();?>assets/image/jpg/<?php echo $row->mb200;?>" style="padding-top:5px"  id="ad" width="90" height="90" border="0" style="padding:5px"/>
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('inv/invi02/del/'.$row->mb001."/".trim($row->mb002))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><a href="<?php echo site_url('inv/invi02/see/'.$row->mb001) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>                 
		  <td class="center"><a href="<?php echo site_url('inv/invi02/updform/'.$row->mb001)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
	      <?PHP } ?>  
		</tr>
		<?php $chkval += 1; ?>
		<?php endforeach;?>
        </tbody>		 
        </table>
		     
	    <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		<?php  $this->session->set_userdata('search1',"display/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
			  
			<!--    <?php echo $this->session->userdata('find05');$find05; ?><?php echo $this->session->userdata('find07');$find07;  ?> -->
				<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 選欄位名稱自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 選取列項出現打勾可多筆刪除, 列印可自設網址列不印, 快速鍵Alt+.. ] '.'　　總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      </form>
     </div> <!-- div-2 -->
    </div> <!-- div-1 --> 
</div> <!-- div-0 -->	

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
   // window.open('/index.php/inv/invi02/printdetail')
	window.location="<?php echo base_url()?>index.php/inv/invi02/printdetail";
  }

function open_winexcel()
  {
  //  window.open('/index.php/inv/invi02/exceldetail')
	window.location="<?php echo base_url()?>index.php/inv/invi02/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_mb025 = $('select[name=\'filter_mb025\']').attr('value');
	if (filter_mb025 != '*') {
		url = '<?php echo base_url() ?>index.php/inv/invi02/filter1/mb025/desc/' + encodeURIComponent(filter_mb025);
	}
	
	
	var filter_mb001 = $('input[name=\'filter_mb001\']').attr('value');
	if (filter_mb001) {
		url = '<?php echo base_url() ?>index.php/inv/invi02/filter1/mb001/desc/' + encodeURIComponent(filter_mb001);
	} 
	
	var filter_mb002 = $('input[name=\'filter_mb002\']').attr('value');
	if (filter_mb002) {
		url = '<?php echo base_url() ?>index.php/inv/invi02/filter1/mb002/desc/' + encodeURIComponent(filter_mb002);
	} 
	
	var filter_mb003 = $('input[name=\'filter_mb003\']').attr('value');
	if (filter_mb003) {
		url = '<?php echo base_url() ?>index.php/inv/invi02/filter1/mb003/desc/' + encodeURIComponent(filter_mb003);
	}
		
	var filter_mb004 = $('input[name=\'filter_mb004\']').attr('value');
	if (filter_mb004) {
		url = '<?php echo base_url() ?>index.php/inv/invi02/filter1/mb004/desc/' + encodeURIComponent(filter_mb004); 
	}
	
	var filter_mb017 = $('input[name=\'filter_mb017\']').attr('value');
	if (filter_mb017) {
		url = '<?php echo base_url() ?>index.php/inv/invi02/filter1/mb017/desc/' + encodeURIComponent(filter_mb017); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/inv/invi02/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if (filter_mb025 == '*' && !filter_mb001  && !filter_mb002 && !filter_mb003  && !filter_mb004 && !filter_mb017 && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/inv/invi02/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_mb025 = $('select[name=\'filter_mb025\']').attr('value');
	if (filter_mb025 != '*') {
		url = '<?php echo base_url() ?>index.php/inv/invi02/filter1/mb025/asc/' + encodeURIComponent(filter_mb025);
	}
	
	var filter_mb001 = $('input[name=\'filter_mb001\']').attr('value');
	if (filter_mb001) {
		url = '<?php echo base_url() ?>index.php/inv/invi02/filter1/mb001/asc/' + encodeURIComponent(filter_mb001);
	} 
		
	var filter_mb002 = $('input[name=\'filter_mb002\']').attr('value');
	if (filter_mb002) {
		url = '<?php echo base_url() ?>index.php/inv/invi02/filter1/mb002/asc/' + encodeURIComponent(filter_mb002);
	} 
	
	var filter_mb003 = $('input[name=\'filter_mb003\']').attr('value');
	if (filter_mb003) {
		url = '<?php echo base_url() ?>index.php/inv/invi02/filter1/mb003/asc/' + encodeURIComponent(filter_mb003);
	}
		
	var filter_mb004 = $('input[name=\'filter_mb004\']').attr('value');
	if (filter_mb004) {
		url = '<?php echo base_url() ?>index.php/inv/invi02/filter1/mb004/asc/' + encodeURIComponent(filter_mb004); 
	}
	
	var filter_mb017 = $('input[name=\'filter_mb017\']').attr('value');
	if (filter_mb017) {
		url = '<?php echo base_url() ?>index.php/inv/invi02/filter1/mb017/asc/' + encodeURIComponent(filter_mb017); 
	}
	
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/inv/invi02/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (filter_mb025 == '*' && !filter_mb001  && !filter_mb002 && !filter_mb003  && !filter_mb004 && !filter_mb017 && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/inv/invi02/display';location = url;
	   
	   }
	   
	location = url;
}
</script>