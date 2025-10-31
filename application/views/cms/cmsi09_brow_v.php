<div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 職務類別資料建立作業 - 瀏覽　　　</h1>
      <!--  <div class="buttons"> -->
	   <div style="float:left; "> 
	    <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi09/clear_sql_term'"  style="float:left" accesskey="a" class="button"><span>重整 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi09/addform'"  style="float:left"  accesskey="i" class="button"><span>新增 i </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi09/copyform'"  style="float:left"  accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi09/findform'"  style="float:left"  accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left"  accesskey="-" class="button"><span>刪除 - </span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
      <!-- <a onclick="$('form').submitb();"   class="button">印幣別匯率</a>   -->
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi09/printdetail'"    style="float:left"  accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a> 
	  <?PHP } ?>
	<!--
   	<?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi09/printdetailc'"   class="button"><span>印幣別匯率&nbsp</span><img src="<?php echo base_url()?>assets/image/png/print1.png" /></a> 
	  <?PHP } ?>
     -->
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi09/exceldetail'"   style="float:left"  accesskey="l" class="button"><span>EXCEL l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi09/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/cms/cmsi09/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/101'"  style="float:left"  accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/cms/cmsi09/delete" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		  <?php echo anchor("cms/cmsi09/display/mj001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?>
           		  
	      </td>
	      <td width="10px" class="left">
	          <?php echo anchor("cms/cmsi09/display/mj001/" . (($sort_order == 'asc' && $sort_by == 'mj001') ? 'desc' : 'asc') ,'職務代號'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("cms/cmsi09/display/mj002/" . (($sort_order == 'asc' && $sort_by == 'mj002') ? 'desc' : 'asc') ,'職務分類'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		  <?php echo anchor("cms/cmsi09/display/mj003/" . (($sort_order == 'asc' && $sort_by == 'mj003') ? 'desc' : 'asc') ,'職務名稱'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
              </td>
	      <td width="5%" class="left">
	          <?php echo anchor("cms/cmsi09/display/mj004/" .(($sort_order == 'asc' && $sort_by == 'mj004') ? 'desc' : 'asc') ,'備註'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      
		 
	      <td width="7%" class="center">
		  <?php echo anchor("cms/cmsi09/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		          <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="12%" class="center">&nbsp查看管理&nbsp </td>
             <td width="12%" class="center">&nbsp修改管理&nbsp </td>
		   
            </tr>
          </thead>
		  
        <!--  <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_mj001='';$filter_mj002='';$filter_mj003='';$filter_mj004='';$filter_mj005='';$filter_mj006='';$filter_mj016='';$filter_create=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	      <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
          <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text" id="filter_mj001" name="filter_mj001"  value="" size="12" />
		    </div>	
	      </td>
			  
	      <td width="5%" class="left">
		   <div  class="button-search"></div>
		    <select name="filter_mj002" >
                     <option value="*"></option>
                     <option  value="1">1:物管</option>
                     <option  value="2">2:生管</option>
                     <option  value="3">3:業務</option>
                     <option  value="4">4:採購</option>
                     <option  value="5">5:會計</option>
                     <option  value="6">6:出納</option>
                     <option  value="7">7:倉庫</option>
                     <option  value="8">8:研發</option> 
                     <option  value="9">9:製造</option>
                     <option  value="A">A:品管</option>
                     <option  value="B">B:管理</option>
                     <option  value="C">C:工程</option>
                     <option  value="D">D:生技</option>	
                     <option  value="E">E:船務</option>
                     <option  value="F">F:廠務</option>	
                     <option  value="G">G:貿易</option>
                     <option  value="H">H:總務</option>	
                     <option  value="I">I:人事</option>
                     <option  value="Z">Z:其他</option>						 
             </select>
		    </div>	
		  </td>
			  
	      <td width="5%" class="left">
		    <div class="button-search"></div>
			<input type="text" name="filter_mj003" value="" size="12" />
		    </div>			  
	      </td>
			  
	      <td width="5%" align="left">
		   <div class="button-search"></div>
		   <input type="text" name="filter_mj004" size="12" value="" />
		   </div>
		  </td>
          
		  
		  <td width="5%" align="center">
		  <div class="button-search"></div>
		  <input type="text" name="filter_create" size="12" value="" />
		  </div>
		  </td>
	     
	      <td width="10%" align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td width="10%" align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
		 
        </tr>
		<tbody>	
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->mj001?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>
		  <td class="left"><?php echo  $row->mj001;?></td>	
          <?php if ($row->mj002=='2') {$vmj002='生管';} else {$vmj002='';}   ?>
          <?php if ($row->mj002=='3') {$vmj002='業務';}  ?>	
          <?php if ($row->mj002=='4') {$vmj002='採購';}  ?>	
          <?php if ($row->mj002=='5') {$vmj002='會計';}  ?>	
          <?php if ($row->mj002=='I') {$vmj002='人事';}  ?>			  
		  <td class="left"><?php echo  $row->mj002.$vmj002;?></td>
		  <td class="left"><?php echo  $row->mj003;?></td>
		  <td class="left"><?php echo  $row->mj004;?></td>
		  <td class="center"><?php echo  substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>		                 			
		
		  <td class="center"><a href="<?php echo site_url('cms/cmsi09/see/'.$row->mj001.'/'.$row->mj002) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
		  <td class="center"><a href="<?php echo site_url('cms/cmsi09/updform/'.$row->mj001.'/'.$row->mj002)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
		  <?PHP } ?>
	  
	<!--      <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('cms/cmsi09/del/'.$row->mj001."/".trim($row->mj002))?>" id="delete1"  >[ 刪除 </a><img src="<?php echo base_url()?>assets/image/png/del.png" />]</td>  --> 
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
   // window.open('/index.php/cms/cmsi09/printdetail')
	window.location="<?php echo base_url()?>index.php/cms/cmsi09/printdetail";
  }
  function open_winprint1()
  {
 //   window.open('/index.php/cms/cmsi09/printdetailc')
	window.location="<?php echo base_url()?>index.php/cms/cmsi09/printdetailc";
  }

function open_winexcel()
  {
  //  window.open('/index.php/cms/cmsi09/exceldetail')
	window.location="<?php echo base_url()?>index.php/cms/cmsi09/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
		
	var filter_mj001 = $('input[name=\'filter_mj001\']').val();
	if (filter_mj001) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi09/filter1/mj001/desc/' + encodeURIComponent(filter_mj001);
	} 
	
	var filter_mj002 = $('select[name=\'filter_mj002\']').val();
	if (filter_mj002 != '*') {
		url = '<?php echo base_url() ?>index.php/cms/cmsi09/filter1/mj002/desc/' + encodeURIComponent(filter_mj002);
	} 
	
	var filter_mj003 = $('input[name=\'filter_mj003\']').val();
	if (filter_mj003) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi09/filter1/mj003/desc/' + encodeURIComponent(filter_mj003);
	}
	
	var filter_mj004 = $('input[name=\'filter_mj004\']').val();
	if (filter_mj004) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi09/filter1/mj004/desc/' + encodeURIComponent(filter_mj004);
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi09/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if ( !filter_mj001  && filter_mj002 == '*' && !filter_mj003 && !filter_mj004   && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/cms/cmsi09/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_mj001 = $('input[name=\'filter_mj001\']').val();
	if (filter_mj001) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi09/filter1/mj001/asc/' + encodeURIComponent(filter_mj001);
	} 
		
	var filter_mj002 = $('select[name=\'filter_mj002\']').val();
	if (filter_mj002 != '*') {
		url = '<?php echo base_url() ?>index.php/cms/cmsi09/filter1/mj002/asc/' + encodeURIComponent(filter_mj002);
	} 
	
	var filter_mj003 = $('input[name=\'filter_mj003\']').val();
	if (filter_mj003) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi09/filter1/mj003/asc/' + encodeURIComponent(filter_mj003);
	}
	
	var filter_mj004 = $('input[name=\'filter_mj004\']').val();
	if (filter_mj004) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi09/filter1/mj004/asc/' + encodeURIComponent(filter_mj004);
	}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/cms/cmsi09/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_mj001  && filter_mj002 == '*' && !filter_mj003 && !filter_mj004  && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/cms/cmsi09/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 