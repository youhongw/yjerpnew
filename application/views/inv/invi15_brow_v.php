  <div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 盤點流覽建立作業 - 瀏覽　　　</h1>
      <!--  <div class="buttons"> -->
	   <div style="float:left; "> 
	    <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/inv/invi15/clear_sql_term'"  style="float:left" accesskey="a" class="button"><span>重整 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/inv/invi15/addform'"  style="float:left"  accesskey="i"  class="button"><span>新增 i </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/inv/invi15/copyform'"  style="float:left"  accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/inv/invi15/findform'"  style="float:left"  accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left"  accesskey="-" class="button"><span>刪除 - </span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="open_winprint();"    style="float:left"  accesskey="p" class="button">列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="open_winexcel();"   style="float:left"   accesskey="l" class="button">excel檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/inv/invi15/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/inv/invi15/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/102'"  style="float:left"  accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/inv/invi15/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
        <thead>
         <tr>                          <!-- 表格表頭 -->
          <td width="1%" style="text-align: center;">
		   <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		   <?php echo anchor("inv/invi15/display/tc001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?> 
	      </td>
	      <td width="3%" class="left">
	        <?php echo anchor("inv/invi15/display/tc001/" . (($sort_order == 'asc' && $sort_by == 'tc001') ? 'desc' : 'asc') ,'盤點底稿編號'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		   <?php echo anchor("inv/invi15/display/tc003/" . (($sort_order == 'asc' && $sort_by == 'tc003') ? 'desc' : 'asc') ,'品號'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="3%" class="left"> 
		   <?php echo anchor("inv/invi15/display/tc004/" . (($sort_order == 'asc' && $sort_by == 'tc004') ? 'desc' : 'asc') ,'庫別'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
          </td>
	      <td width="5%" class="left">
	        <?php echo anchor("inv/invi15/display/tc008/" .(($sort_order == 'asc' && $sort_by == 'tc008') ? 'desc' : 'asc') ,'實盤數量'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
		   <td width="7%" class="left">
	        <?php echo anchor("inv/invi15/display/tc005/" .(($sort_order == 'asc' && $sort_by == 'tc005') ? 'desc' : 'asc') ,'儲位'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="5%" class="left">
	        <?php echo anchor("inv/invi15/display/tc002/" .(($sort_order == 'asc' && $sort_by == 'tc002') ? 'desc' : 'asc') ,'流水號'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="5%" class="center">
		   <?php echo anchor("inv/invi15/display/tc009/" . (($sort_order == 'asc' && $sort_by == 'tc009') ? 'desc' : 'asc') ,'盤點日期'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="12%" class="center">&nbsp查看管理&nbsp </td>
          <td width="12%" class="center">&nbsp修改管理&nbsp </td>
        </tr>
        </thead>
		  
        <!--  <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_tc001='*';$filter_tc002='';$filter_tc003='';$filter_tc004='';$filter_tc005='';$filter_tc006='';$filter_tc009=''; ?>
	    <tr class="filter">
	     <td class="left"></td>
	     <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
         <td align="left">
		   <div class="button-search"></div>
		    <input type="text" id="filter_tc001" name="filter_tc001" value="" size="15"  />
		   </div>
	     </td>
			  
	      <td class="left">
		  <div  class="button-search"></div>
			<input type="text" id="filter_tc003" name="filter_tc003" value="" size="20" />
		  </td>
			  
	      <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_tc004" value=""  size="10"  />
		   </div>			  
	      </td>
		  <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_tc008" value="" size="10"  />
		   </div>			  
	      </td>	  
		  <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_tc005" value="" size="16"  />
		   </div>			  
	      </td>	  
	      <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_tc002" value=""  size="10" />
		   </div>			  
	      </td>	  
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_tc009" value="" size="10" />
		  </td>
	      <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td>  
	      <!-- <button type='submit'  name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
        </tr>
		<tbody>
		<!--session 變數取消 	  
		<?php $this->session->unset_userdata('tc002'); ?> -->
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
		  <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->tc001."/".trim($row->tc002)."/".trim($row->tc003)."/".trim($row->tc004)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?><?php $vtc1=$row->tc001; $vtc2=$row->tc002; $vtc3=$row->tc003; $vtc4=$row->tc004; ?></td>		
		  <td class="left"><?php echo  $row->tc001;?></td>		  
		  <td class="left"><?php echo   $row->tc003;?><?php $vtc9=$vtc1.$vtc2.$vtc4; ?></td>	
		  <td class="left"><?php echo  $row->tc004;?></td>                
		  <td class="left"><?php echo ' <input type="text" onchange="chgit(this,'.$vtc9.')" name="tc008'.$chkval.'" id="tc008'.$chkval.'" value="'.$row->tc008.'"  ' ;?></td>
		  <td class="left"><?php echo $row->tc005;?></td>
          <td class="left"><?php echo $row->tc002;?></td>
		  <td class="center"><?php echo  substr($row->tc009,0,4).'/'.substr($row->tc009,4,2).'/'.substr($row->tc009,6,2);?></td>		                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('inv/invi15/del/'.$row->tc001."/".trim($row->tc002))?>" id="deletc"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><a href="<?php echo site_url('inv/invi15/see/'.$row->tc001)?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>                 
		  <td class="center"><a href="<?php echo site_url('inv/invi15/updform/'.$row->tc001)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
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
'◎操作說明:[ 選欄位名稱自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 選取列項出現打勾可多筆刪除, 列印可自設網址列不印, 快速鍵Alt+.. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      </form>
    
    </div> <!-- div-2 -->
   </div>  <!-- div-1 -->
</div>	<!-- div-0 -->

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
   // window.open('/index.php/inv/invi15/printdetail')
	window.location="<?php echo base_url()?>index.php/inv/invi15/printdetail";
  }

function open_winexcel()
  {
   //  window.open('/index.php/inv/invi15/exceldetail')
	window.location="<?php echo base_url()?>index.php/inv/invi15/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_tc001 = $('input[name=\'filter_tc001\']').val();
	if (filter_tc001) {
		url = '<?php echo base_url() ?>index.php/inv/invi15/filter1/tc001/desc/' + encodeURIComponent(filter_tc001);
	}
	
	 var filter_tc003 = $('input[name=\'filter_tc003\']').val();
	if (filter_tc003) {
		url = '<?php echo base_url() ?>index.php/inv/invi15/filter1/tc003/desc/' + encodeURIComponent(filter_tc003);
	} 
	
	 var filter_tc004 = $('input[name=\'filter_tc004\']').val();
	if (filter_tc004) {
		url = '<?php echo base_url() ?>index.php/inv/invi15/filter1/tc004/desc/' + encodeURIComponent(filter_tc004);
	} 
	
	var filter_tc008 = $('input[name=\'filter_tc008\']').val();
	if (filter_tc008) {
		url = '<?php echo base_url() ?>index.php/inv/invi15/filter1/tc008/desc/' + encodeURIComponent(filter_tc008);
	} 
	
	var filter_tc005 = $('input[name=\'filter_tc005\']').val();
	if (filter_tc005) {
		url = '<?php echo base_url() ?>index.php/inv/invi15/filter1/tc005/desc/' + encodeURIComponent(filter_tc005);
	} 
 
	 var filter_tc002 = $('input[name=\'filter_tc002\']').val();
	if (filter_tc002) {
		url = '<?php echo base_url() ?>index.php/inv/invi15/filter1/tc002/desc/' + encodeURIComponent(filter_tc002);
	} 
	
	var filter_tc009 = $('input[name=\'filter_tc009\']').val();
	if (filter_tc009) {
		url = '<?php echo base_url() ?>index.php/inv/invi15/filter1/tc009/desc/' + encodeURIComponent(filter_tc009); 
	}
	
    if (!filter_tc001 && !filter_tc003  && !filter_tc004  && !filter_tc008  && !filter_tc005 && !filter_tc002 && !filter_tc009) {         
	   url = '<?php echo base_url() ?>index.php/inv/invi15/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_tc001 = $('input[name=\'filter_tc001\']').val();
	if (filter_tc001) {
		url = '<?php echo base_url() ?>index.php/inv/invi15/filter1/tc001/asc/' + encodeURIComponent(filter_tc001);
	}
	
	var filter_tc005 = $('input[name=\'filter_tc005\']').val();
	if (filter_tc005) {
		url = '<?php echo base_url() ?>index.php/inv/invi15/filter1/tc005/asc/' + encodeURIComponent(filter_tc005);
	} 
	var filter_tc004 = $('input[name=\'filter_tc004\']').val();
	if (filter_tc004) {
		url = '<?php echo base_url() ?>index.php/inv/invi15/filter1/tc004/asc/' + encodeURIComponent(filter_tc004);
	} 
	var filter_tc008 = $('input[name=\'filter_tc008\']').val();
	if (filter_tc008) {
		url = '<?php echo base_url() ?>index.php/inv/invi15/filter1/tc008/asc/' + encodeURIComponent(filter_tc008);
	} 
	var filter_tc003 = $('input[name=\'filter_tc003\']').val();
	if (filter_tc003) {
		url = '<?php echo base_url() ?>index.php/inv/invi15/filter1/tc003/asc/' + encodeURIComponent(filter_tc003);
	} 
	
		var filter_tc002 = $('input[name=\'filter_tc002\']').val();
	if (filter_tc002) {
		url = '<?php echo base_url() ?>index.php/inv/invi15/filter1/tc002/asc/' + encodeURIComponent(filter_tc002);
	} 
	
	var filter_tc009 = $('input[name=\'filter_tc009\']').val();
	if (filter_tc009) {
		url = '<?php echo base_url() ?>index.php/inv/invi15/filter1/tc009/asc/' + encodeURIComponent(filter_tc009); 
	}
	
    if (!filter_tc001 && !filter_tc005  && !filter_tc004 && !filter_tc008 && !filter_tc003 && !filter_tc002 && !filter_tc009) {         
	   url = '<?php echo base_url() ?>index.php/inv/invi15/display';location = url;
	   
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
   	var sUrl = "<?php echo base_url()?>index.php/inv/invi15/dataupdate/" + encodeURIComponent(oInput.value)+ "/" +mtc9+ "/" +new Date().getTime();   
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

