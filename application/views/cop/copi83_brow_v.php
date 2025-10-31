  <div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 業務訪問審核作業 - 瀏覽　　　</h1>
     
	   <div style="float:left; "> 
	     <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi83/clear_sql_term'"  style="float:left" accesskey="a" class="button"><span>重新整理 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	<!--  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi83/addform'"  style="float:left"  accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi83/copyform'"  style="float:left"  accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?> -->
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi83/findform'"  style="float:left"  accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
         <a onclick="$('form').submit();"  style="float:left"  accesskey="y" class="button"><span>選取審核 Y </span><img src="<?php echo base_url()?>assets/image/png/ok.png" /></a>  
  <!--    <a onclick=" return CheckForm1();"  href="<?php // echo site_url('cop/copi83/del2' ?>" id="delete2"  ><span>選取審核 Y </span></a> -->
	 <?PHP } ?>
	<!--  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi83/printdetail'"    accesskey="p"  style="float:left" class="button">列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi83/exceldetail'"   accesskey="l"  style="float:left"  class="button">轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?> -->
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/cop/copi83/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/cop/copi83/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/104'"  style="float:left"  accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/cop/copi83/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
        <thead>
         <tr>                          <!-- 表格表頭 -->
          <td width="1%" style="text-align: center;">
		   <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="4%" class="left">
		   <?php echo anchor("cop/copi83/display/mm001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?> 
	      </td>
	      <td width="8%" class="left">
	        <?php echo anchor("cop/copi83/display/mm001/" . (($sort_order == 'asc' && $sort_by == 'mm001') ? 'desc' : 'asc') ,'訪問日期'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="6%" class="left"> 
		   <?php echo anchor("cop/copi83/display/mm002/" . (($sort_order == 'asc' && $sort_by == 'mm002') ? 'desc' : 'asc') ,'業務員'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="8%" class="left"> 
		   <?php echo anchor("cop/copi83/display/mm003/" . (($sort_order == 'asc' && $sort_by == 'mm003') ? 'desc' : 'asc') ,'客戶代號'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
          </td>
	      <td width="8%" class="left">
	        <?php echo anchor("cop/copi83/display/c.ma002/" .(($sort_order == 'asc' && $sort_by == 'c.ma002') ? 'desc' : 'asc') ,'客戶簡稱'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="20%" class="left">
		   <?php echo anchor("cop/copi83/display/mm005/" . (($sort_order == 'asc' && $sort_by == 'mm005') ? 'desc' : 'asc') ,'描述內容'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("cop/copi83/display/mm009/" . (($sort_order == 'asc' && $sort_by == 'mm009') ? 'desc' : 'asc') ,'審核批示'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="5%" class="center">
		   <?php echo anchor("cop/copi83/display/mm006/" . (($sort_order == 'asc' && $sort_by == 'mm006') ? 'desc' : 'asc') ,'審核'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		    <td width="5%" class="center">
		   <?php echo anchor("cop/copi83/display/mm007/" . (($sort_order == 'asc' && $sort_by == 'mm007') ? 'desc' : 'asc') ,'核准'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		         
	      <td width="13%" class="center">查看管理</td>
          <td width="13%" class="center">審核管理</td> 
        </tr>
        </thead>
		  
       <!--   <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_mm001='';$filter_mm002='';$filter_mm003='';$filter_mm003disp='';$filter_mm005='';$filter_mm009='';$filter_mm006='';$filter_mm007='';$filter_create=''; ?>
	    <tr class="filter">
	     <td class="left"></td>
	     <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
         <td align="left">
		   <div class="button-search"></div>
		    <input type="text"name="filter_mm001" value=""  size="12" />
		
	     </td>
			  
	      <td class="left">
		  <div  class="button-search"></div>
			<input type="text"  name="filter_mm002" value="" size="12" />
		  </td>
			  
	      <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_mm003" value=""  size="12" />
		     
	      </td>
		  
		   <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_mm003disp" value=""  size="12" />
		  		  
	      </td>
		  
		   <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_mm005" value="" size="12"  />
	      </td>
		  
			<td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_mm009" value=""  size="12" />
	       </td>
		   
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_mm006" value="" size="6" />
		  </td>
		  
		  <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_mm007" value="" size="6" />
		  </td>
		  
	      <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td>  
	      <!-- <button type='submit'  name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
        </tr>
		<tbody> 
		<!--session 變數取消 	  
		<?php $this->session->unset_userdata('mm002'); ?> -->
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->mm001."/".trim($row->mm002)."/".trim($row->mm003)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?><?php $vtc1=$row->mm001; $vtc2=$row->mm002; $vtc3=trim($row->mm003);  ?></td>			
		  <td class="left"><?php echo  substr($row->mm001,0,4).'/'.substr($row->mm001,4,2).'/'.substr($row->mm001,6,2);?></td>		  
		  <td class="left"><?php echo  $row->mm002;?></td>
		  <td class="left"><?php echo  $row->mm003;?><?php $vtc9="'".$vtc1.$vtc2.$vtc3."'"; ?></td>
		  <td class="left"><?php echo  $row->mm003disp;?></td>
		   <td class="left"><textarea style="border: none; width: 100%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><?php echo  $row->mm005;?></textarea></td> 
	
		  <td class="left"><?php echo ' <input type="text" onchange="chgit(this,'.$vtc9.')" name="mm009'.$chkval.'" id="mm009'.$chkval.'" value="'.$row->mm009.'"  />' ;?></td>
		   <td class="center"><?php echo  $row->mm006;?></td>
		    <td class="center"><?php echo  $row->mm007;?></td>
	
		  <td class="center"><a href="<?php echo site_url('cop/copi83/see/'.$row->mm001."/".trim($row->mm002)."/".trim($row->mm003))?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
                       

		  <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>       
		   <td class="center"> <a onclick="return CheckForm2();" href="<?php echo site_url('cop/copi83/del1/'.$row->mm001."/".trim($row->mm002)."/".trim($row->mm003))?>" id="delete1"  >[ 取消審核 ]</a></td> 
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
	 </form>
    <div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 選欄位名稱自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 選取列項出現打勾可多筆審核, 列印可自設網址列不印, 快速鍵Alt+.. ] '.'　　　總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
     
    </div> <!-- div-2 -->
   </div>  <!-- div-1 -->
</div>	<!-- div-0 -->

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_mm001 = $('input[name=\'filter_mm001\']').attr('value');
	if (filter_mm001) {
		url = '<?php echo base_url() ?>index.php/cop/copi83/filter1/mm001/desc/' + encodeURIComponent(filter_mm001);
	}
	
	var filter_mm002 = $('input[name=\'filter_mm002\']').attr('value');
	if (filter_mm002) {
		url = '<?php echo base_url() ?>index.php/cop/copi83/filter1/mm002/desc/' + encodeURIComponent(filter_mm002);
	} 
	
	var filter_mm003 = $('input[name=\'filter_mm003\']').attr('value');
	if (filter_mm003) {
		url = '<?php echo base_url() ?>index.php/cop/copi83/filter1/mm003/desc/' + encodeURIComponent(filter_mm003);
	}
	var filter_mm003disp = $('input[name=\'filter_mm003disp\']').attr('value');
	if (filter_mm003disp) {
		url = '<?php echo base_url() ?>index.php/cop/copi83/filter1/c.ma002/desc/' + encodeURIComponent(filter_mm003disp);
	}
	
	var filter_mm005 = $('input[name=\'filter_mm005\']').attr('value');
	if (filter_mm005) {
		url = '<?php echo base_url() ?>index.php/cop/copi83/filter1/mm005/desc/' + encodeURIComponent(filter_mm005);
	}
	var filter_mm009 = $('input[name=\'filter_mm009\']').attr('value');
	if (filter_mm009) {
		url = '<?php echo base_url() ?>index.php/cop/copi83/filter1/mm009/desc/' + encodeURIComponent(filter_mm009);
	}
	
	var filter_mm006 = $('input[name=\'filter_mm006\']').attr('value');
	if (filter_mm006) {
		url = '<?php echo base_url() ?>index.php/cop/copi83/filter1/mm006/desc/' + encodeURIComponent(filter_mm006); 
	}
	var filter_mm007 = $('input[name=\'filter_mm007\']').attr('value');
	if (filter_mm007) {
		url = '<?php echo base_url() ?>index.php/cop/copi83/filter1/mm007/desc/' + encodeURIComponent(filter_mm007); 
	}
	
    if (!filter_mm001 && !filter_mm002  && !filter_mm003 && !filter_mm003disp && !filter_mm005 && !filter_mm009 && !filter_mm006 && !filter_mm007) {         
	   url = '<?php echo base_url() ?>index.php/cop/copi83/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	var filter_mm001 = $('input[name=\'filter_mm001\']').attr('value');
	if (filter_mm001) {
		url = '<?php echo base_url() ?>index.php/cop/copi83/filter1/mm001/asc/' + encodeURIComponent(filter_mm001);
	}
	
	var filter_mm002 = $('input[name=\'filter_mm002\']').attr('value');
	if (filter_mm002) {
		url = '<?php echo base_url() ?>index.php/cop/copi83/filter1/mm002/asc/' + encodeURIComponent(filter_mm002);
	} 
	
	var filter_mm003 = $('input[name=\'filter_mm003\']').attr('value');
	if (filter_mm003) {
		url = '<?php echo base_url() ?>index.php/cop/copi83/filter1/mm003/asc/' + encodeURIComponent(filter_mm003);
	}
	var filter_mm003disp = $('input[name=\'filter_mm003disp\']').attr('value');
	if (filter_mm003disp) {
		url = '<?php echo base_url() ?>index.php/cop/copi83/filter1/c.ma002/asc/' + encodeURIComponent(filter_mm003disp);
	}
	
	var filter_mm005 = $('input[name=\'filter_mm005\']').attr('value');
	if (filter_mm005) {
		url = '<?php echo base_url() ?>index.php/cop/copi83/filter1/mm005/asc/' + encodeURIComponent(filter_mm005);
	}
	var filter_mm009 = $('input[name=\'filter_mm009\']').attr('value');
	if (filter_mm009) {
		url = '<?php echo base_url() ?>index.php/cop/copi83/filter1/mm009/asc/' + encodeURIComponent(filter_mm009);
	}
	
	var filter_mm006 = $('input[name=\'filter_mm006\']').attr('value');
	if (filter_mm006) {
		url = '<?php echo base_url() ?>index.php/cop/copi83/filter1/mm006/asc/' + encodeURIComponent(filter_mm006); 
	}
	var filter_mm007 = $('input[name=\'filter_mm007\']').attr('value');
	if (filter_mm007) {
		url = '<?php echo base_url() ?>index.php/cop/copi83/filter1/mm007/asc/' + encodeURIComponent(filter_mm007); 
	}
	
    if (!filter_mm001 && !filter_mm002  && !filter_mm003 && !filter_mm003disp && !filter_mm005 && !filter_mm009 && !filter_mm006 && !filter_mm007) {         
	   url = '<?php echo base_url() ?>index.php/cop/copi83/display';location = url;
	   
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
     // alert(sText);	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}
<!-- 不更新網頁,業務人員 -->
function chgit(oInput,mtc9){ 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	 //alert(oInput.value);
   //  alert(mtc9);
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/cop/copi83/dataupdate/" + encodeURIComponent(oInput.value)+ "/" +mtc9+ "/" +new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	//alert(sUrl);
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
<script language="javascript">     //閒置超時，系統強制登出  1000毫秒=1秒, 7200000=2小時 8小時 328
	
	function CheckForm1()
      {
        if(confirm("確認要審核此筆嗎？")==true)
           return true;
        else
           return false;
      } 
	  
</script>
<script language="javascript">     //閒置超時，系統強制登出  1000毫秒=1秒, 7200000=2小時 8小時 328
	
	function CheckForm2()
      {
        if(confirm("確認要取消審核此筆嗎？")==true)
           return true;
        else
           return false;
      } 
	  
</script>