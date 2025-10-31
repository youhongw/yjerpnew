<div class="box2">  <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 使用者資料建立作業 - 瀏覽</h1>
       <!--  <div class="buttons"> -->
	   <div style="float:right; "> 
	    <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/adm/admi10/clear_sql_term'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	   <a onclick="location = '<?php echo base_url()?>index.php/adm/admi10/addform'"  style="float:left" accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	   <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),9999,1)=='Y') { ?>
	   <a onclick="location = '<?php echo base_url()?>index.php/adm/admi10/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
       <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	   <a onclick="location = '<?php echo base_url()?>index.php/adm/admi10/findform'"  style="float:left" accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>	
       <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	   <a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>選取刪除</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	   <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	   <a onclick="location = '<?php echo base_url()?>index.php/adm/admi10/printdetail'"   style="float:left" accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  
	   <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),10999,1)=='Y') { ?>
	   <a onclick="location = '<?php echo base_url()?>index.php/adm/admi10/exceldetail'"  style="float:left"  accesskey="l" class="button"><span>轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a>  
	   <?PHP } ?>
	   <!-- <a onclick="location = '<?php echo base_url()?>index.php/adm/admi10/printdetail'"  class="button"><span>列印</span></a>
	   <a onclick="location = '<?php echo base_url()?>index.php/adm/admi10/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	   <a onclick="location = '<?php echo base_url()?>index.php/main/index/10'"  style="float:left" accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content">  <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/adm/admi10/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 The [attribute*=value] selector selects each element with a specific attribute, with a value containing a string.-->
          <thead>
            <tr>                          <!-- 表格表頭 attribute和property都可以翻译为属性，为了以示区别，通常把这两个单词翻译为属性与特性-->
              <td width="1%" style="text-align: center;">
		      <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	          </td>
	          <td width="6%" class="center">
		      <?php echo anchor("adm/admi10/display/mf001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?> 
	          </td>
	          <td width="5%" class="center">
	          <?php echo anchor("adm/admi10/display/mf001/" . (($sort_order == 'asc' && $sort_by == 'mf001') ? 'desc' : 'asc') ,'使用者代號'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	          </td>
	          <td width="5%" class="center"> 
		      <?php echo anchor("adm/admi10/display/mf002/" . (($sort_order == 'asc' && $sort_by == 'mf002') ? 'desc' : 'asc') ,'使用者名稱'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	          </td>
	          <td width="5%" class="center"> 
		      <?php echo anchor("adm/admi10/display/mf003/" . (($sort_order == 'asc' && $sort_by == 'mf003') ? 'desc' : 'asc') ,'使用者密碼'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
		      <td width="5%" class="center"> 
		      <?php echo anchor("adm/admi10/display/mf004/" . (($sort_order == 'asc' && $sort_by == 'mf004') ? 'desc' : 'asc') ,'群組代號'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
		      <td width="5%" class="center"> 
		      <?php echo anchor("adm/admi10/display/mf005/" . (($sort_order == 'asc' && $sort_by == 'mf005') ? 'desc' : 'asc') ,'超級使用者'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
	     
	          <td width="3%" class="center">
		      <?php echo anchor("adm/admi10/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	          </td>
	          <td width="25%" class="center">&nbsp查看&nbsp</td>
              <td width="25%" class="center">&nbsp修改&nbsp</td>
            </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	      <?php $filter_mf001='';$filter_mf002='';$filter_mf003='';$filter_mf004='';$filter_mf005='';$filter_create=''; ?>
	     <tr class="filter">
	       <td class="left"></td>
	       <td class="left">&nbsp&nbsp&nbsp&nbsp</td>
			  
           <td align="left">
		   <div class="button-search"></div>
		   <input type="text" id="filter_mf001" name="filter_mf001" value="" />
	       </td>
			  
	       <td class="left">
		   <div  class="button-search"></div>
		   <input type="text" id="filter_mf002" name="filter_mf002" value="" />
		   </td>
	       <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_mf003" value="" />
	       </td>
		   <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_mf004" value="" />
	       </td>
		   <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_mf005" value="" />
	       </td>
	      
	       <td align="left">
		   <div class="button-search"></div>
		    <input type="text" name="filter_create" value="" size="15" />
		   </td>
	       <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	       <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td>
         </tr>
		 
		<!--session 變數取消 	  -->
		<?php $this->session->unset_userdata('mf002'); ?> 
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->mf001?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>		
		  <td class="left"><?php echo  $row->mf001;?></td>			  
		  <td class="left"><?php echo  $row->mf002;?></td>
		  <td class="left"><?php echo  "******";?></td>	
          <td class="left"><?php echo  $row->mf004;?></td>		
          <td class="left"><?php echo  $row->mf005;?></td>				   
		  <td class="center"><?php echo  substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>		                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('adm/admi10/del/'.$row->mf001)?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><a href="<?php echo site_url('adm/admi10/see/'.$row->mf001)?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
		  <td class="center"><a href="<?php echo site_url('adm/admi10/updform/'.$row->mf001)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
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
</div>	

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
    window.open('/index.php/adm/admi10/printdetail')
  }

function open_winexcel()
  {
    window.open('/index.php/adm/admi10/exceldetail')
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_mf001 = $('input[name=\'filter_mf001\']').val();
	if (filter_mf001) {
		url = '<?php echo base_url() ?>index.php/adm/admi10/filter1/mf001/desc/' + encodeURIComponent(filter_mf001);
		
	}
	
	var filter_mf002 = $('input[name=\'filter_mf002\']').val();
	if (filter_mf002) {
		url = '<?php echo base_url() ?>index.php/adm/admi10/filter1/mf002/desc/' + encodeURIComponent(filter_mf002);
	} 
	
	var filter_mf003 = $('input[name=\'filter_mf003\']').val();
	if (filter_mf003) {
		url = '<?php echo base_url() ?>index.php/adm/admi10/filter1/mf003/desc/' + encodeURIComponent(filter_mf003);
	}
		
	var filter_mf004 = $('input[name=\'filter_mf004\']').val();
	if (filter_mf004) {
		url = '<?php echo base_url() ?>index.php/adm/admi10/filter1/mf004/desc/' + encodeURIComponent(filter_mf004);
	}
	
	var filter_mf005 = $('input[name=\'filter_mf005\']').val();
	if (filter_mf005) {
		url = '<?php echo base_url() ?>index.php/adm/admi10/filter1/mf005/desc/' + encodeURIComponent(filter_mf005);
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/adm/admi10/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_mf001  && !filter_mf002  && !filter_mf003 && !filter_mf004 && !filter_mf005 &&  !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/adm/admi10/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_mf001 = $('input[name=\'filter_mf001\']').val();
	if (filter_mf001) {
		url = '<?php echo base_url() ?>index.php/adm/admi10/filter1/mf001/asc/' + encodeURIComponent(filter_mf001);
	}
	
	var filter_mf002 = $('input[name=\'filter_mf002\']').val();
	if (filter_mf002) {
		url = '<?php echo base_url() ?>index.php/adm/admi10/filter1/mf002/asc/' + encodeURIComponent(filter_mf002);
	} 
	
	var filter_mf003 = $('input[name=\'filter_mf003\']').val();
	if (filter_mf003) {
		url = '<?php echo base_url() ?>index.php/adm/admi10/filter1/mf003/asc/' + encodeURIComponent(filter_mf003);
	}
	
	var filter_mf004 = $('input[name=\'filter_mf004\']').val();
	if (filter_mf004) {
		url = '<?php echo base_url() ?>index.php/adm/admi10/filter1/mf004/asc/' + encodeURIComponent(filter_mf004);
	}
	
	var filter_mf005 = $('input[name=\'filter_mf005\']').val();
	if (filter_mf005) {
		url = '<?php echo base_url() ?>index.php/adm/admi10/filter1/mf005/asc/' + encodeURIComponent(filter_mf005);
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/adm/admi10/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
	
	
    if (!filter_mf001 && !filter_mf002  && !filter_mf003  && !filter_mf004  && !filter_mf005  &&!filter_create) {         
	   url = '<?php echo base_url() ?>index.php/adm/admi10/display';location = url;
	   
	   }
	   
	location = url;
}
</script>