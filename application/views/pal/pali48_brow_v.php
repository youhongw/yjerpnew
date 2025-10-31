<div class="box2">  <!-- div-1 -->
  <div class="heading">
    <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 核定金額流覽輸入作業 - 瀏覽</h1>
     <!--  <div class="buttons"> -->
	   <div style="float:right; "> 
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali48/clear_sql_term'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	<?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	<a onclick="location = '<?php echo base_url()?>index.php/pal/pali48/addform'"  style="float:left" accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	<?PHP } ?>
	<?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	<a onclick="location = '<?php echo base_url()?>index.php/pal/pali48/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
    <?PHP } ?>
	<?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	<a onclick="location = '<?php echo base_url()?>index.php/pal/pali48/findform'"  style="float:left" accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>	
    <?PHP } ?>
	<?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	<a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>選取刪除</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	<?PHP } ?>
	<?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	<a onclick="location = '<?php echo base_url()?>index.php/pal/pali48/printdetail'"  style="float:left"   accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  
	<?PHP } ?>
	<?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	<a onclick="location = '<?php echo base_url()?>index.php/pal/pali48/exceldetail'"  style="float:left"   accesskey="l" class="button"><span>轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a>  
	<?PHP } ?>
	<!-- <a onclick="location = '<?php echo base_url()?>index.php/pal/pali48/printdetail'"  class="button"><span>列印</span></a>
	<a onclick="location = '<?php echo base_url()?>index.php/pal/pali48/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	<a onclick="location = '<?php echo base_url()?>index.php/main/index/111'"  style="float:left" accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
    </div>
  </div>
	
  <div class="content">  <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/pal/pali48/delete" method="post" enctype="multipart/form-data" id="form">
      <table class="list">      <!-- 表格開始 -->
        <thead>
          <tr>                          <!-- 表格表頭 -->
            <td width="1%" style="text-align: center;">
		      <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	        </td>
	        <td width="6%" class="center">
		      <?php echo anchor("pal/pali48/display/yh001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?> 
	        </td>
	        <td width="5%" class="center">
	          <?php echo anchor("pal/pali48/display/yh001/" . (($sort_order == 'asc' && $sort_by == 'yh001') ? 'desc' : 'asc') ,'試算年度'); ?>
			  <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="5%" class="center"> 
		      <?php echo anchor("pal/pali48/display/yh002/" . (($sort_order == 'asc' && $sort_by == 'yh002') ? 'desc' : 'asc') ,'員工代號'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
			<td width="5%" class="center"> 
		      <?php echo anchor("pal/pali48/display/yh005/" . (($sort_order == 'asc' && $sort_by == 'yh005') ? 'desc' : 'asc') ,'員工姓名'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="5%" class="center"> 
		      <?php echo anchor("pal/pali48/display/yh006/" . (($sort_order == 'asc' && $sort_by == 'yh006') ? 'desc' : 'asc') ,'部門名稱'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
            </td>
			<td width="5%" class="center"> 
		      <?php echo anchor("pal/pali48/display/yh008/" . (($sort_order == 'asc' && $sort_by == 'yh008') ? 'desc' : 'asc') ,'年資'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
            </td>
			<td width="5%" class="center"> 
		      <?php echo anchor("pal/pali48/display/yh009/" . (($sort_order == 'asc' && $sort_by == 'yh009') ? 'desc' : 'asc') ,'基數'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
            </td>
			<td width="5%" class="center"> 
		      <?php echo anchor("pal/pali48/display/yh010/" . (($sort_order == 'asc' && $sort_by == 'yh010') ? 'desc' : 'asc') ,'可發天數'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
            </td>
			<td width="5%" class="center"> 
		      <?php echo anchor("pal/pali48/display/yh020/" . (($sort_order == 'asc' && $sort_by == 'yh020') ? 'desc' : 'asc') ,'可發金額'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
            </td>
			<td width="5%" class="center"> 
		      <?php echo anchor("pal/pali48/display/yh036/" . (($sort_order == 'asc' && $sort_by == 'yh036') ? 'desc' : 'asc') ,'核發金額'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
            </td>
	        <td width="3%" class="center">
		      <?php echo anchor("pal/pali48/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
		      <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		      <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	        </td>
	        <td width="25%" class="center">&nbsp查看&nbsp</td>
            <td width="25%" class="center">&nbsp修改&nbsp</td>
          </tr>
        </thead>
		  
        <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	      <?php $filter_yh001='';$filter_yh002='';$filter_yh003='';$filter_yh007='';$filter_yh011='';$filter_yh012='';$filter_create=''; ?>
	      <tr class="filter">
	        <td class="left"></td>
	        <td class="left">&nbsp&nbsp&nbsp</td>
			  
            <td align="left">
		      <div class="button-search"></div>
		      <input type="text"  name="filter_yh001" value="" size="10" />
		    <!--  </div>  -->
	        </td>
			  
	        <td class="left">
		     <div  class="button-search"></div>
			 <input type="text"  name="filter_yh002" value="" size="10" />
		    </td>
			 <td class="left">
		     <div  class="button-search"></div>
			 <input type="text"  name="filter_yh005" value="" size="10"/>
		    </td> 
	        <td class="left">
		     <div class="button-search"></div>
			 <input type="text" name="filter_yh006" value="" size="10"/>
	        </td>
			<td class="left">
		     <div class="button-search"></div>
			 <input type="text" name="filter_yh008" value="" size="10"/>
	        </td>
			<td class="left">
		     <div class="button-search"></div>
			 <input type="text" name="filter_yh009" value="" size="10"/>
	        </td>
	        <td class="left">
		     <div class="button-search"></div>
			 <input type="text" name="filter_yh010" value="" size="10"/>
	        </td>
			  <td class="left">
		     <div class="button-search"></div>
			 <input type="text" name="filter_yh020" value="" size="10"/>
	        </td>
			  <td class="left">
		     <div class="button-search"></div>
			 <input type="text" name="filter_yh036" value="" size="10"/>
	        </td>
	        <td align="left">
		      <div class="button-search"></div>
		      <input type="text" name="filter_create" value="" size="12" />
		    </td>
	        <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	        <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td> 
          </tr>
		  
		<!--session 變數取消 	  -->
		<?php $this->session->unset_userdata('yh002'); ?> 
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->yh001."/".trim($row->yh002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?><?php $vth1=$row->yh001; $vth2=$row->yh002;  ?></td>		
		  <td class="left"><?php echo  $row->yh001;?></td>			  
		  <td class="left"><?php echo  $row->yh002;?><?php $vth9=$vth1.$vth2; ?></td>
		  <td class="left"><?php echo  $row->yh005;?></td>
		  <td class="left"><?php echo  $row->yh006;?></td>	
          <td class="left"><?php echo  $row->yh008;?></td>	
          <td class="left"><?php echo  $row->yh009;?></td>
         
          <td class="left"><?php echo  $row->yh020;?><br><?php echo  $row->yh021;?><br><?php echo  $row->yh022;?><br>
		                   <?php echo  $row->yh023;?><br><?php echo  $row->yh024;?><br></td>
          <td class="left"><?php echo  $row->yh026;?><br><?php echo  $row->yh027;?><br><?php echo  $row->yh028;?><br>
		                   <?php echo  $row->yh029;?><br><?php echo  $row->yh030;?><br></td>							   
		  <td class="left"><?php echo ' <input type="text" onchange="chgit(this,'.$vth9.')" name="yh036'.$chkval.'" id="yh036'.$chkval.'" value="'.$row->yh036.'"  ' ;?></td>
		  <td class="center"><?php echo  substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>		                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pal/pali48/del/'.$row->yh001)?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><a href="<?php echo site_url('pal/pali48/see/'.$row->yh001."/".$row->yh002)?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
            <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?> 
		  <td class="center"><a href="<?php echo site_url('pal/pali48/updform/'.$row->yh001."/".$row->yh002)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
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
    
   </div>  <!-- div-2 -->
 </div>    <!-- div-1 --> 
</div>	

<!--列印及轉excel 開新視窗  -->
<script>                    
function open_winprint()
  {
    window.open('/index.php/pal/pali48/printdetail')
  }

function open_winexcel()
  {
    window.open('/index.php/pal/pali48/exceldetail')
  }
</script>

<!-- 篩選  -->
<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_yh001 = $('input[name=\'filter_yh001\']').val();
	if (filter_yh001) {
		url = '<?php echo base_url() ?>index.php/pal/pali48/filter1/yh001/desc/' + encodeURIComponent(filter_yh001);
	}
	
	var filter_yh002 = $('input[name=\'filter_yh002\']').val();
	if (filter_yh002) {
		url = '<?php echo base_url() ?>index.php/pal/pali48/filter1/yh002/desc/' + encodeURIComponent(filter_yh002);
	} 
	
	var filter_yh005 = $('input[name=\'filter_yh005\']').val();
	if (filter_yh005) {
		url = '<?php echo base_url() ?>index.php/pal/pali48/filter1/yh005/desc/' + encodeURIComponent(filter_yh005);
	}
	var filter_yh006 = $('input[name=\'filter_yh006\']').val();
	if (filter_yh006) {
		url = '<?php echo base_url() ?>index.php/pal/pali48/filter1/yh006/desc/' + encodeURIComponent(filter_yh006);
	}
	var filter_yh008 = $('input[name=\'filter_yh008\']').val();
	if (filter_yh008) {
		url = '<?php echo base_url() ?>index.php/pal/pali48/filter1/yh008/desc/' + encodeURIComponent(filter_yh008);
		
	}var filter_yh009 = $('input[name=\'filter_yh009\']').val();
	if (filter_yh009) {
		url = '<?php echo base_url() ?>index.php/pal/pali48/filter1/yh009/desc/' + encodeURIComponent(filter_yh009);
	}
	var filter_yh010 = $('input[name=\'filter_yh010\']').val();
	if (filter_yh010) {
		url = '<?php echo base_url() ?>index.php/pal/pali48/filter1/yh010/desc/' + encodeURIComponent(filter_yh010);
	}
	var filter_yh020 = $('input[name=\'filter_yh020\']').val();
	if (filter_yh020) {
		url = '<?php echo base_url() ?>index.php/pal/pali48/filter1/yh020/desc/' + encodeURIComponent(filter_yh020);
	}
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/pal/pali48/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_yh001 && !filter_yh002  && !filter_yh005 && !filter_yh006 && !filter_yh008  && !filter_yh009 && !filter_yh010 && !filter_yh020 && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali48/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_yh001 = $('input[name=\'filter_yh001\']').val();
	if (filter_yh001) {
		url = '<?php echo base_url() ?>index.php/pal/pali48/filter1/yh001/asc/' + encodeURIComponent(filter_yh001);
	}
	
	var filter_yh002 = $('input[name=\'filter_yh002\']').val();
	if (filter_yh002) {
		url = '<?php echo base_url() ?>index.php/pal/pali48/filter1/yh002/asc/' + encodeURIComponent(filter_yh002);
	} 
	
	var filter_yh005 = $('input[name=\'filter_yh005\']').val();
	if (filter_yh005) {
		url = '<?php echo base_url() ?>index.php/pal/pali48/filter1/yh005/asc/' + encodeURIComponent(filter_yh005);
	}
	var filter_yh006 = $('input[name=\'filter_yh006\']').val();
	if (filter_yh006) {
		url = '<?php echo base_url() ?>index.php/pal/pali48/filter1/yh006/asc/' + encodeURIComponent(filter_yh006);
	}
	var filter_yh008 = $('input[name=\'filter_yh008\']').val();
	if (filter_yh008) {
		url = '<?php echo base_url() ?>index.php/pal/pali48/filter1/yh008/asc/' + encodeURIComponent(filter_yh008);
	}
	var filter_yh009 = $('input[name=\'filter_yh009\']').val();
	if (filter_yh009) {
		url = '<?php echo base_url() ?>index.php/pal/pali48/filter1/yh009/asc/' + encodeURIComponent(filter_yh009);
	}
	
	var filter_yh007 = $('input[name=\'filter_yh007\']').val();
	if (filter_yh007) {
		url = '<?php echo base_url() ?>index.php/pal/pali48/filter1/yh007/asc/' + encodeURIComponent(filter_yh007);
	}
	var filter_yh011 = $('input[name=\'filter_yh011\']').val();
	if (filter_yh011) {
		url = '<?php echo base_url() ?>index.php/pal/pali48/filter1/yh011/asc/' + encodeURIComponent(filter_yh011);
	}
	var filter_yh010 = $('input[name=\'filter_yh010\']').val();
	if (filter_yh010) {
		url = '<?php echo base_url() ?>index.php/pal/pali48/filter1/yh010/asc/' + encodeURIComponent(filter_yh010);
	}
	var filter_yh020 = $('input[name=\'filter_yh020\']').val();
	if (filter_yh020) {
		url = '<?php echo base_url() ?>index.php/pal/pali48/filter1/yh020/asc/' + encodeURIComponent(filter_yh020);
	}
	var filter_create = $('input[name=\'filter_create\']').val();
	if (filter_create) {
		url = '<?php echo base_url() ?>index.php/pal/pali48/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (!filter_yh001 && !filter_yh002  && !filter_yh005 && !filter_yh006 && !filter_yh008 && !filter_yh009 && !filter_yh010 && !filter_yh020   && !filter_create) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali48/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 
 <!-- 不更新網頁帶出資料  -->
<script language="javascript"  >   
 
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁 判斷適用各種流覽器 共用 (全域)
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
}
<!-- 不更新網頁,更新儲位 -->
function showupdate(sText){   //不更新網頁 4  更新儲位
//	var oSpan = document.getElementById("tc0041");
//	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 
   //   alert(sText);	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}
<!-- 不更新網頁,業務人員 -->
function chgit(oInput,mtc9){ 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
   
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/pal/pali48/dataupdate/" + encodeURIComponent(oInput.value)+ "/" +mtc9+ "/" +new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
		  showupdate(xmlHttp.responseText);	//顯示服務器結果		
	}
	xmlHttp.send(null);
}
//--></script>


<!-- </div>	-->  