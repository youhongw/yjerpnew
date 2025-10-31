  <div class="box2" > <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php  echo base_url()?>assets/image/order.png" alt="" /> 科目資料建立作業 - 瀏覽　　　</h1>
     
	   <div style="float:left;" > 
	    <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/act/acti03/clear_sql_term'"  style="float:left" accesskey="a" class="button"><span>重整 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?php  if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php  echo base_url()?>index.php/act/acti03/addform'"  style="float:left"  accesskey="i" class="button"><span>新增 i </span><img src="<?php  echo base_url()?>assets/image/png/add.png" /></a>
	  <?php  } ?>
	  <?php  if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php  echo base_url()?>index.php/act/acti03/copyform'"  style="float:left"  accesskey="c" class="button"><span>複製 c </span><img src="<?php  echo base_url()?>assets/image/png/copy.png" /></a>	
      <?php  } ?>
	  <?php  if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php  echo base_url()?>index.php/act/acti03/findform'"  style="float:left"  accesskey="k" class="button"><span>查詢 k </span><img src="<?php  echo base_url()?>assets/image/png/find.png" /></a>		
      <?php  } ?>
	  <?php  if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left"  accesskey="-" class="button"><span>刪除</span><img src="<?php  echo base_url()?>assets/image/png/del.png" /></a>
	  <?php  } ?>
	  <?php  if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php  echo base_url()?>index.php/act/acti03/printdetail'"   style="float:left"   accesskey="p" class="button">列印 p </span><img src="<?php  echo base_url()?>assets/image/png/print.png" /></a>  
	  <?php  } ?>
	  <?php  if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php  echo base_url()?>index.php/act/acti03/exceldetail'"   style="float:left"   accesskey="l" class="button">excel檔 l </span><img src="<?php  echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?php  } ?>
	  <a onclick="location = '<?php  echo base_url()?>index.php/main/index/109'"  style="float:left"  accesskey="x" class="button"><span>關閉 x </span><img src="<?php  echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php  echo base_url()?>index.php/act/acti03/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
        <thead>
         <tr>                          <!-- 表格表頭 -->
          <td width="1%" style="text-align: center;">
		   <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		   <?php  echo anchor("act/acti03/display/ma001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?> 
	      </td>
	      <td width="5%" class="left">
	        <?php  echo anchor("act/acti03/display/ma001/" . (($sort_order == 'asc' && $sort_by == 'ma001') ? 'desc' : 'asc') ,'科目代號'); ?>
			<?php  if ($sort_order == 'asc'  ) { ?>  <img src="<?php  echo base_url()?>assets/image/desc.png" /> <?php  } else { ?>
		    <img src="<?php  echo base_url()?>assets/image/asc.png" />  <?php  }  ?>
	      </td>
	      <td width="7%" class="left"> 
		   <?php  echo anchor("act/acti03/display/ma003/" . (($sort_order == 'asc' && $sort_by == 'ma003') ? 'desc' : 'asc') ,'科目名稱'); ?>
		   <?php  if ($sort_order == 'asc'  ) { ?>  <img src="<?php  echo base_url()?>assets/image/desc.png" /> <?php  } else { ?>
		   <img src="<?php  echo base_url()?>assets/image/asc.png" />  <?php  }  ?>
	      </td>
		   <td width="7%" class="left"> 
		   <?php  echo anchor("act/acti03/display/ma002/" . (($sort_order == 'asc' && $sort_by == 'ma002') ? 'desc' : 'asc') ,'上層科目'); ?>
		   <?php  if ($sort_order == 'asc'  ) { ?>  <img src="<?php  echo base_url()?>assets/image/desc.png" /> <?php  } else { ?>
		   <img src="<?php  echo base_url()?>assets/image/asc.png" />  <?php  }  ?>
	      </td>
	      <td width="7%" class="left"> 
		   <?php  echo anchor("act/acti03/display/ma007/" . (($sort_order == 'asc' && $sort_by == 'ma007') ? 'desc' : 'asc') ,'借貸型態'); ?>
		   <?php  if ($sort_order == 'asc'  ) { ?>  <img src="<?php  echo base_url()?>assets/image/desc.png" /> <?php  } else { ?>
		   <img src="<?php  echo base_url()?>assets/image/asc.png" />  <?php  }  ?>
          </td>
	      <td width="8%" class="left">
	        <?php  echo anchor("act/acti03/display/ma008/" .(($sort_order == 'asc' && $sort_by == 'ma008') ? 'desc' : 'asc') ,'科目類別'); ?>
		    <?php  if ($sort_order == 'asc'  ) { ?>  <img src="<?php  echo base_url()?>assets/image/desc.png" /> <?php  } else { ?>
		    <img src="<?php  echo base_url()?>assets/image/asc.png" />  <?php  }  ?>
   	      </td>
	      <td width="8%" class="left">
		   <?php  echo anchor("act/acti03/display/ma009/" . (($sort_order == 'asc' && $sort_by == 'ma009') ? 'desc' : 'asc') ,'部門管理'); ?>
		   <?php  if ($sort_order == 'asc'  ) { ?>  <img src="<?php  echo base_url()?>assets/image/desc.png" /> <?php  } else { ?>
		   <img src="<?php  echo base_url()?>assets/image/asc.png" />  <?php  }  ?>
	      </td>
	    <!--  <td width="8%" class="left">
		   <?php  echo anchor("act/acti03/display/ma011/" . (($sort_order == 'asc' && $sort_by == 'ma011') ? 'desc' : 'asc') ,'財務類別'); ?>
		   <?php  if ($sort_order == 'asc'  ) { ?>  <img src="<?php  echo base_url()?>assets/image/desc.png" /> <?php  } else { ?>
		   <img src="<?php  echo base_url()?>assets/image/asc.png" />  <?php  }  ?>
	      </td> -->
	      <td width="7%" class="center">
		   <?php  echo anchor("act/acti03/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		   <?php  if ($sort_order == 'asc'  ) { ?>  <img src="<?php  echo base_url()?>assets/image/desc.png" /> <?php  } else { ?>
		   <img src="<?php  echo base_url()?>assets/image/asc.png" />  <?php  }  ?>
	      </td>
	      <td width="18%" class="center">&nbsp查看管理&nbsp </td>
          <td width="18%" class="center">&nbsp修改管理&nbsp </td>
        </tr>
        </thead>
		  
        <!--  <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php  $filter_ma001='';$filter_ma003='';$filter_ma007='';$filter_ma008='';$filter_ma009='';$filter_ma011='';$filter_create=''; ?>
	    <tr class="filter">
	     <td class="left"></td>
	     <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
         <td align="left">
		   <div class="button-search"></div>
		    <input type="text" id="filter_ma001" name="filter_ma001" value=""  size="12" />
	     </td>
		<td align="left">
		   <div class="button-search"></div>
		    <input type="text" id="filter_ma002" name="filter_ma002" value=""  size="12" />
	     </td>	  
	      <td class="left">
		  <div  class="button-search"></div>
			<input type="text" id="filter_ma003" name="filter_ma003" value="" size="12"/>
		  </td>
			  
	      <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_ma007" value=""  size="12" />
	      </td>
			  
	      <td align="left">
		  <div class="button-search"></div>
			<input type="text" name="filter_ma008" value=""  size="12" />
		  </td>
		  
          <td align="left">
		  <div class="button-search"></div>
			<input type="text" name="filter_ma009" value=""  size="12" />
		  </td>
		  
	    <!--  <td align="left">
		  <div class="button-search"></div>
				      <select name="filter_ma011" >
                      <option value="*"></option>
                      <option  value="01">01:流動資產-現金</option>
                      <option  value="02">02:流動資產-短期投資</option> 
                      <option  value="03">03:流動資產-應收帳款</option>
                      <option  value="04">04:流動資產-存貨</option>
                      <option  value="05">05:流動資產-預付款項</option>
                      <option  value="06">06:流動資產-其他</option>   
                       <option  value="07">07:基金及長期投資-基金</option>
                      <option  value="08">08:基金及長期投資-長期投資</option> 
                      <option  value="09">09:基金及長期投資-長期應收</option>
                      <option  value="10">10:固定資產</option>
                      <option  value="11">11:其他資產</option>
                      <option  value="12">12:流動負債-短期借款</option>  
                       <option  value="13">13:流動負債-應付帳款</option>
                      <option  value="14">14:流動負債-預收款項</option> 
                      <option  value="28">28:流動負債-其他</option>
                      <option  value="15">15:長期負倩</option>
                      <option  value="16">16:其他負債</option>
                      <option  value="17">17:投入股本</option>  
                       <option  value="18">18:保留盈餘</option>
                      <option  value="19">19:資產增值公積</option> 
                      <option  value="20">20:銷貨收入</option>
                      <option  value="21">21:其他收入</option>
                      <option  value="29">29:銷貨折讓</option>
                      <option  value="30">30:銷貨退回</option> 
                      <option  value="22">22:銷貨成本</option>
                      <option  value="23">23:其他成本</option>
                      <option  value="24">24:營業費用</option>
                      <option  value="25">25:營業外收益</option>   
                       <option  value="31">31:營業外費用</option>
                      <option  value="26">26:所得稅</option>
                      <option  value="27">27:其他</option>  					  
              </select>
		  </td> -->
		  
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_create" value=""size="12" />
		  </td>
		  
	      <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td>  
        </tr>
		<tbody>
		<!--session 變數取消 	  
		<?php  $this->session->unset_userdata('ma002'); ?> -->
	    <?php  $chkval=1; ?>               
	    <?php  foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->ma001; ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php  echo $chkval;?></td>		
		  <td class="left"><?php  echo $row->ma001;?></td>			  
		  <td class="left"><?php  echo $row->ma003;?></td>
		  <td class="left"><?php  echo $row->ma002;?></td>
		  <?php if ($row->ma007==1) {$vma007='借';} else {$vma007='貸';} ?>
		  <td class="left"><?php  echo $row->ma007.':'.$vma007;?></td>
		  <td class="left"><?php  echo $row->ma008;?></td>
		  <td class="left"><?php  echo $row->ma009;?></td>
		<!--  <td class="left"><?php  echo $row->ma011;?></td> -->
		  <td class="center"><?php  echo $row->create_date;?></td>		                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php  echo site_url('act/acti03/del/'.$row->ma001."/".trim($row->ma002))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><a href="<?php  echo site_url('act/acti03/see/'.$row->ma001)?>">[ 查看 </a><img src="<?php  echo base_url()?>assets/image/png/eye.png" />]</td>
          <?php  if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>                 
		  <td class="center"><a href="<?php  echo site_url('act/acti03/updform/'.$row->ma001)?>">[ 修改 </a><img src="<?php  echo base_url()?>assets/image/png/modi.png" />]</td>
	      <?php  } ?>
		</tr>
		  <?php  $chkval += 1; ?>
		  <?php  endforeach;?>
          </tbody>		 
        </table>
		       <!-- 修改時 留在原來那一筆資料使用 -->
	          <?php   $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		   
				<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
			<div class="success"><?php  echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      </form>
    </div> <!-- div-2 -->
   </div>  <!-- div-1 -->
 </div>	<!-- div-0 -->

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
   // window.open('/index.php/act/acti03/printdetail')
	window.location="<?php  echo base_url()?>index.php/act/acti03/printdetail";
  }

function open_winexcel()
  {
   //  window.open('/index.php/act/acti03/exceldetail')
	window.location="<?php  echo base_url()?>index.php/act/acti03/exceldetail";
  }
</script>

<script type="text/javascript">

$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	
	var filter_ma001 = $('input[name=\'filter_ma001\']').val();
	if (filter_ma001) {
		url = '<?php echo base_url() ?>index.php/act/acti03/filter1/ma001/desc/' + encodeURIComponent(filter_ma001);
	}
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').val();
	if (filter_ma002) {
		url = '<?php echo base_url() ?>index.php/act/acti03/filter1/ma002/desc/' + encodeURIComponent(filter_ma002);
	} 
	var filter_ma003 = $('input[name=\'filter_ma003\']').val();
	if (filter_ma003) {
		url = '<?php echo base_url() ?>index.php/act/acti03/filter1/ma003/desc/' + encodeURIComponent(filter_ma003);
	} 
	var filter_ma007 = $('input[name=\'filter_ma007\']').val();
	if (filter_ma007) {
		url = '<?php echo base_url() ?>index.php/act/acti03/filter1/ma007/desc/' + encodeURIComponent(filter_ma007);
	}
		
	var filter_ma008 = $('input[name=\'filter_ma008\']').val();
	if (filter_ma008) {
		url = '<?php echo base_url() ?>index.php/act/acti03/filter1/ma008/desc/' + encodeURIComponent(filter_ma008); 
	}
	
	var filter_ma009 = $('input[name=\'filter_ma009\']').val();
	if (filter_ma009)  {
		url = '<?php echo base_url() ?>index.php/act/acti03/filter1/ma009/desc/' + encodeURIComponent(filter_ma009); 
	}
	
//	var filter_ma011 = $('select[name=\'filter_ma011\']').val();
//	if (filter_ma011 != '*') {
//		url = '<?php echo base_url() ?>index.php/act/acti03/filter1/ma011/desc/' + encodeURIComponent(filter_ma011); 
	//}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/act/acti03/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_ma001 && !filter_ma003  && !filter_ma007 && !filter_ma008  && !filter_ma009 &&  !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/act/acti03/display';location = url;
	   
	   }
	location = url;
}

function filtera() {
	
	var filter_ma001 = $('input[name=\'filter_ma001\']').val();
	if (filter_ma001) {
		url = '<?php echo base_url() ?>index.php/act/acti03/filter1/ma001/asc/' + encodeURIComponent(filter_ma001);
	}
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').val();
	if (filter_ma002) {
		url = '<?php echo base_url() ?>index.php/act/acti03/filter1/ma002/asc/' + encodeURIComponent(filter_ma002);
	} 
	var filter_ma003 = $('input[name=\'filter_ma003\']').val();
	if (filter_ma003) {
		url = '<?php echo base_url() ?>index.php/act/acti03/filter1/ma003/asc/' + encodeURIComponent(filter_ma003);
	} 
	var filter_ma007 = $('input[name=\'filter_ma007\']').val();
	if (filter_ma007) {
		url = '<?php echo base_url() ?>index.php/act/acti07/filter1/ma007/asc/' + encodeURIComponent(filter_ma007);
	}
		
	var filter_ma008 = $('input[name=\'filter_ma008\']').val();
	if (filter_ma008 ) {
		url = '<?php echo base_url() ?>index.php/act/acti03/filter1/ma008/asc/' + encodeURIComponent(filter_ma008); 
	}
	
	var filter_ma009 = $('input[name=\'filter_ma009\']').val();
	if (filter_ma009) {
		url = '<?php echo base_url() ?>index.php/act/acti03/filter1/ma009/asc/' + encodeURIComponent(filter_ma009); 
	}
	
	//var filter_ma011 = $('select[name=\'filter_ma011\']').val();
	//if (filter_ma011 != '*') {
	//	url = '<?php echo base_url() ?>index.php/act/acti11/filter1/ma011/asc/' + encodeURIComponent(filter_ma011); 
	//}
	
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/act/acti03/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_ma001 && !filter_ma003  && !filter_ma007 && !filter_ma008  && !filter_ma009 &&  !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/act/acti03/display';location = url;
	   }
	   
	location = url;
}
</script>