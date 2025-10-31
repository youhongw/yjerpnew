  <div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 遲到次數審核作業 - 瀏覽</h1>
      <!--  <div class="buttons"> -->
	   <div style="float:right; "> 
	     <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali57/clear_sql_term'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	<!--  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali57/addform'"  style="float:left"  accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali57/copyform'"  style="float:left"  accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?> -->
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali57/findform'"  style="float:left"  accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),333333,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left"  accesskey="y" class="button"><span>選取審核 Y </span><img src="<?php echo base_url()?>assets/image/png/ok.png" /></a>
	  <?PHP } ?>
	<!--  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali57/printdetail'"    accesskey="p"  style="float:left" class="button">列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali57/exceldetail'"   accesskey="l"  style="float:left"  class="button">轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?> -->
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/pal/pali57/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali57/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/104'"  style="float:left"  accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/pal/pali57/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
        <thead>
         <tr>                          <!-- 表格表頭 -->
          <td width="1%" style="text-align: center;">
		   <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="4%" class="left">
		   <?php echo anchor("pal/pali57/display/te001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?> 
	      </td>
	      <td width="8%" class="left">
	        <?php echo anchor("pal/pali57/display/mv004/" . (($sort_order == 'asc' && $sort_by == 'mv004') ? 'desc' : 'asc') ,'部門代號'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="6%" class="left"> 
		   <?php echo anchor("pal/pali57/display/me002/" . (($sort_order == 'asc' && $sort_by == 'me002') ? 'desc' : 'asc') ,'部門名稱'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="8%" class="left"> 
		   <?php echo anchor("pal/pali57/display/te002/" . (($sort_order == 'asc' && $sort_by == 'te002') ? 'desc' : 'asc') ,'刷卡日期'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
          </td>
	      <td width="8%" class="left">
	        <?php echo anchor("pal/pali57/display/te001/" .(($sort_order == 'asc' && $sort_by == 'te001') ? 'desc' : 'asc') ,'員工代號'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("pal/pali57/display/mv002/" . (($sort_order == 'asc' && $sort_by == 'mv002') ? 'desc' : 'asc') ,'員工姓名'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("pal/pali57/display/te003/" . (($sort_order == 'asc' && $sort_by == 'te003') ? 'desc' : 'asc') ,'刷卡時間'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="15%" class="center">
		   <?php echo anchor("pal/pali57/display/te001/" . (($sort_order == 'asc' && $sort_by == 'te001') ? 'desc' : 'asc') ,'狀態'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		    <td width="5%" class="center">
		   <?php echo anchor("pal/pali57/display/te008/" . (($sort_order == 'asc' && $sort_by == 'te008') ? 'desc' : 'asc') ,'計遲到YN'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		         
	      <td width="8%" class="center">&nbsp查看管理&nbsp </td>
          <td width="8%" class="center">&nbsp審核管理&nbsp </td> 
        </tr>
        </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_te001='';$filter_te002='';$filter_te003='';$filter_te004='';$filter_te002disp='';$filter_te003disp='';$filter_create=''; ?>
	    <tr class="filter">
	     <td class="left"></td>
	     <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
         <td align="left">
		   <div class="button-search"></div>
		    <input type="text" id="filter_mv004" name="filter_mv004" value=""  size="12" />
		   </div>
	     </td>
			  
	      <td class="left">
		  <div  class="button-search"></div>
			<input type="text" id="filter_me002" name="filter_me002" value="" size="12"/>
		  </td>
			  
	      <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_te002" value=""  size="12" />
		   </div>			  
	      </td>
		  
		   <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_te001" value=""  size="12" />
		   </div>			  
	      </td>
		  
		   <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_mv002" value=""   />
		   </div>			  
	      </td>
		  
			<td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_te003" value=""  size="12"  />
		   </div>	  
	      
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_te006" value="" size="6" disabled />
		  </td>
		  <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_te007" value="" size="6" disabled />
		  </td>
	      <td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td>  
	      <!-- <button type='submit'  name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
        </tr>
		
		<!--session 變數取消 	  
		<?php $this->session->unset_userdata('te002'); ?> -->
	    <?php $chkval=1; ?>               
	    <?php // foreach($results as $row ) : ?>
		 <?php if(count(@$results)!=0&&is_array(@$results)){
				foreach($results as $day_data ){
					foreach($day_data as $row){ ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo  $row->te002."/".$row->te001 ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>	
         <!-- <td class="left"><?php echo  $row->mv004;?></td>
          <td class="left"><?php echo  $row->me002;?></td>		  
		  <td class="left"><?php echo  substr($row->te002,0,4).'/'.substr($row->te002,4,2).'/'.substr($row->te002,6,2);?></td>		  
		  <td class="left"><?php echo  $row->te001;?></td>
		  <td class="left"><?php echo  $row->mv002;?></td>  -->
		  
		  <td class="left"><?php echo $row->me002;?></td>
		  <td class="left"><?php echo substr($row->te002,0,4).'/'.substr($row->te002,4,2).'/'.substr($row->te002,6,2);?></td>
		  <td class="left"><?php if($row->te001){echo $row->te001;}else{echo $row->te004;}?></td>
		  <td class="left"><?php echo $row->mv002;?></td>
		  <td class="left" id="td_<?php echo $row->te002."_".$row->te001; ?>" >
		   <td class="left" id="td_<?php echo $row->te002."_".$row->te001; ?>" >
			<?php if(@$row->te003){
					foreach($row->te003 as $k => $v){
						$div_str = "<div ";					//Start
						$div_str .= "class='time_".$row->te002."_".$row->te001."' ";//加入前墜
						$div_str .= "style='float:left;margin:2px; '";
						$div_str .= "id='div_".$row->te002."_".$row->te001."_".$v."' ";
						$div_str .= " >";
						$div_str .= "<span ";				//Start
						$div_str .= "class='span_".$row->te002."_".$row->te001."_".$v."'";//加入前墜
						$div_str .= "style='float:left;' ";
						$div_str .= "id='disp_".$row->te002."_".$row->te001."_".$v."'";
						if (substr($this->session->userdata('sysmg006'),2,1)=='Y') {$div_str .= "ondblclick='edit_time(\"".$row->te002."\",\"".$row->te001."\",\"".$v."\")'";}
						$div_str .= " >";
						$div_str .= $v;
						$div_str .= "</span>";				//結尾
						$div_str .= "<span ";				//Start
						$div_str .= "class='span_".$row->te002."_".$row->te001."_".$v."' ";//加入前墜
						$div_str .= "style='float:left;' ";
						$div_str .= "id='form_".$row->te002."_".$row->te001."_".$v."' ";
						$div_str .= " >";
						$div_str .= "<input ";				//Start
						$div_str .= "class='ipt_".$row->te002."_".$row->te001."' ";//加入前墜
						$div_str .= "id='ipt_".$row->te002."_".$row->te001."_".$v."' ";
						$div_str .= "style='float:left;height:8px;text-align:center;display:none;' ";
						$div_str .= "size='4' value='".$v."' maxlength='10'";
						$div_str .= " />";					//結尾
						$div_str .= "<input ";				//Start
						$div_str .= "id='del_".$row->te002."_".$row->te001."_".$v."' ";
						$div_str .= "style='float:left;width:15px;height:15px;text-align:center;display:none;margin:0px;padding:0px;' ";
						$div_str .= "type='button' size='4' value='x' ";
						if (substr($this->session->userdata('sysmg006'),3,1)=='Y') {$div_str .= "onclick='del_time(\"".$row->te002."\",\"".$row->te001."\",\"".$v."\")'";}
						$div_str .= " />";					//結尾
						
						
						$div_str .= "</span>";				//結尾
						
						$div_str .= "</div>";				//結尾
						echo $div_str;
					}
				}?>
		  <td class="left"><?php echo  $row->te003;?></td>
		  <td class="center"><?php echo  '遲到';?></td>
		  <td class="center"><?php echo  $row->te008;?></td>
	<!--	  <td class="center"><?php // echo  substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>	-->	                 			
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pal/pali57/del/'.$row->te001."/".trim($row->te002)."/".trim($row->te003))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		<!--  <td class="center"><a href="<?php echo site_url('pal/pali57/see/'.$row->te001."/".trim($row->te002)."/".trim($row->te003))?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>-->
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>                 
	<!--		  <td class="center"><a href="<?php // echo site_url('pal/pali57/updform/'.$row->te001."/".trim($row->te002)."/".trim($row->te003))?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
	      <?PHP } ?> -->
		    <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>       
		   <td class="center"> <a  href="<?php echo site_url('pal/pali57/selyn/'.$row->te001."/".trim($row->te002)."/".trim($row->te003)."/".trim($row->mv004))?>" id="delete2"  >[ 審核 ]</a></td> 
		   <?PHP } ?>
		  <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>       
		   <td class="center"> <a onclick="return CheckForm2();" href="<?php echo site_url('pal/pali57/del1/'.$row->te001."/".trim($row->te002)."/".trim($row->te003))?>" id="delete1"  >[ 取消審核 ]</a></td> 
		   <?PHP } ?>
		</tr>
		  <?php $chkval += 1; ?>
		  <?php  }}};?>
          </tbody>		 
        </table>
		       <!-- 修改時 留在原來那一筆資料使用 -->
	          <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		    <!--    <?php echo $this->pagination->create_links();?>	
			    <?php echo $this->session->userdata('find05');$find05; ?><?php echo $this->session->userdata('find07');$find07;  ?> -->
				<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 選欄位名稱自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 選取列項出現打勾可多筆審核, 列印可自設網址列不印, 快速鍵Alt+.. ] '.'　　　總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      </form>
    
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
	var filter_mv004 = $('input[name=\'filter_mv004\']').attr('value');
	if (filter_mv004) {
		url = '<?php echo base_url() ?>index.php/pal/pali57/filter1/mv004/desc/' + encodeURIComponent(filter_mv004);
	}
	
	var filter_me002 = $('input[name=\'filter_me002\']').attr('value');
	if (filter_me002) {
		url = '<?php echo base_url() ?>index.php/pal/pali57/filter1/me002/desc/' + encodeURIComponent(filter_me002);
	} 
	
	var filter_te002 = $('input[name=\'filter_te002\']').attr('value');
	if (filter_te002) {
		url = '<?php echo base_url() ?>index.php/pal/pali57/filter1/te002/desc/' + encodeURIComponent(filter_te002);
	}
	var filter_te001 = $('input[name=\'filter_te001\']').attr('value');
	if (filter_te001) {
		url = '<?php echo base_url() ?>index.php/pal/pali57/filter1/te001/desc/' + encodeURIComponent(filter_te001);
	}
	
	var filter_mv002 = $('input[name=\'filter_mv002\']').attr('value');
	if (filter_mv002) {
		url = '<?php echo base_url() ?>index.php/pal/pali57/filter1/mv002/desc/' + encodeURIComponent(filter_mv002);
	}
	var filter_te003 = $('input[name=\'filter_te003\']').attr('value');
	if (filter_te003) {
		url = '<?php echo base_url() ?>index.php/pal/pali57/filter1/te003/desc/' + encodeURIComponent(filter_te003);
	}
	
	var filter_te008 = $('input[name=\'filter_te008\']').attr('value');
	if (filter_te008) {
		url = '<?php echo base_url() ?>index.php/pal/pali57/filter1/te008/desc/' + encodeURIComponent(filter_te008); 
	}

	
    if (!filter_mv004 && !filter_me002  && !filter_te002 && !filter_te001 && !filter_mv002 && !filter_te003 && !filter_te008 ) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali57/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_mv004 = $('input[name=\'filter_mv004\']').attr('value');
	if (filter_mv004) {
		url = '<?php echo base_url() ?>index.php/pal/pali57/filter1/mv004/asc/' + encodeURIComponent(filter_mv004);
	}
	
	var filter_me002 = $('input[name=\'filter_me002\']').attr('value');
	if (filter_me002) {
		url = '<?php echo base_url() ?>index.php/pal/pali57/filter1/me002/asc/' + encodeURIComponent(filter_me002);
	} 
	
	var filter_te002 = $('input[name=\'filter_te002\']').attr('value');
	if (filter_te002) {
		url = '<?php echo base_url() ?>index.php/pal/pali57/filter1/te002/asc/' + encodeURIComponent(filter_te002);
	}
	var filter_te001 = $('input[name=\'filter_te001\']').attr('value');
	if (filter_te001) {
		url = '<?php echo base_url() ?>index.php/pal/pali57/filter1/te001/asc/' + encodeURIComponent(filter_te001);
	}
	
	var filter_mv002 = $('input[name=\'filter_mv002\']').attr('value');
	if (filter_mv002) {
		url = '<?php echo base_url() ?>index.php/pal/pali57/filter1/mv002/asc/' + encodeURIComponent(filter_mv002);
	}
	var filter_te003 = $('input[name=\'filter_te003\']').attr('value');
	if (filter_te003) {
		url = '<?php echo base_url() ?>index.php/pal/pali57/filter1/te003/asc/' + encodeURIComponent(filter_te003);
	}
	
	var filter_te008 = $('input[name=\'filter_te008\']').attr('value');
	if (filter_te008) {
		url = '<?php echo base_url() ?>index.php/pal/pali57/filter1/te008/asc/' + encodeURIComponent(filter_te008); 
	}

	
    if (!filter_mv004 && !filter_me002  && !filter_te002 && !filter_te001 && !filter_mv002 && !filter_te003 && !filter_te008 ) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali57/display';location = url;
	   
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
   	var sUrl = "<?php echo base_url()?>index.php/pal/pali57/dataupdate/" + encodeURIComponent(oInput.value)+ "/" +mtc9+ "/" +new Date().getTime();   
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
	
	function CheckForm2()
      {
        if(confirm("確認要取消審核此筆嗎？")==true)
           return true;
        else
           return false;
      } 
	  
</script>