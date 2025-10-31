<div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 庫存異動單據建立 - 瀏覽　　　</h1>
      <!--  <div class="buttons"> -->
	   <div style="float:left; "> 
	    <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/inv/invi05/clear_sql_term'"  style="float:left" accesskey="a" class="button"><span>重整 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/inv/invi05/addform'"  style="float:left" accesskey="i" class="button"><span>新增 i </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/inv/invi05/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/inv/invi05/findform'"  style="float:left" accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>刪除 - </span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
      <!-- <a onclick="$('form').submitb();"   class="button">印異動單</a>   -->
	  <a onclick="location = '<?php echo base_url()?>index.php/inv/invi05/printdetail'"    style="float:left" accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/inv/invi05/printdetailc'"    style="float:left" accesskey="o" class="button"><span>印異動單 o </span><img src="<?php echo base_url()?>assets/image/png/print1.png" /></a> 
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	<!--  <a onclick="location = '<?php echo base_url()?>index.php/inv/invi05/exceldetail'"   style="float:left" accesskey="l" class="button"><span>轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> -->
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/inv/invi05/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/inv/invi05/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/102'" style="float:left" accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	<?php 
	  $title_array = array(
		'rowid' => array('sort_name'=>"ta001",'name'=>"序號",'width'=>"4%",'align'=>"left",'use'=>"disable"),
		'ta001' => array('sort_name'=>"ta001",'name'=>"異動單別",'width'=>"5%",'align'=>"left"),
		'mq002' => array('sort_name'=>"mq002",'name'=>"單別名稱",'width'=>"5%",'align'=>"left"),
		'ta002' => array('sort_name'=>"ta002",'name'=>"異動單號",'width'=>"5%",'align'=>"left"),
		'ta014' => array('sort_name'=>"ta014",'name'=>"單據日期",'width'=>"5%",'align'=>"left"),
		'ta005' => array('sort_name'=>"ta005",'name'=>"備註",'width'=>"5%",'align'=>"left"),
		'ta011' => array('sort_name'=>"ta011",'name'=>"總數量",'width'=>"5%",'align'=>"left"),
		'ta012' => array('sort_name'=>"ta012",'name'=>"總金額",'width'=>"5%",'align'=>"left"),
		//'ta006' => array('sort_name'=>"ta006",'name'=>"確認碼",'width'=>"5%",'align'=>"left"),
		//'create_date' => array('sort_name'=>"create_date",'name'=>"建立日期",'width'=>"5%",'align'=>"left"),
		'see' => array('sort_name'=>"",'name'=>"查看管理",'width'=>"12%",'align'=>"center"),
		'edit' => array('sort_name'=>"",'name'=>"修改管理",'width'=>"12%",'align'=>"center"),
		'print' => array('sort_name'=>"",'name'=>"印異動單",'width'=>"12%",'align'=>"center")
	  );
    ?>
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/inv/invi05/delete" method="post" enctype="multipart/form-data" id="form">
       <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>                          <!-- 表格表頭 -->
              <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <?php
		   foreach($title_array as $key => $val){
			  echo "<td width=".$val['width']." class='".$val['align']."'>";
			  echo $val['name'];
				if(isset($val['use'])){
				  if($val['use'] == "disable"){
					echo "</td>";continue;
				  }
				}
				if($val['sort_name'] == ""){
				  echo "</td>";continue;
				}
				
			  $str = "<img src='".base_url()."assets/image/asc.png' />";
			  echo anchor("inv/invi05/display_search/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." asc",$str);
			  $str = "<img src='".base_url()."assets/image/desc.png' />";
			  echo anchor("inv/invi05/display_search/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." desc",$str);
				
			  echo "</td>";
			}
		  ?>
            </tr>
          </thead>
		 	  	 <!-- 一般師選表頭 --> 
	<?php 
	
	  $filter_array = array(
		'rowid' => array('filter_name'=>"",'name'=>"序號",'size'=>"8",'align'=>"left",'use'=>"disable"),
		'ta001' => array('filter_name'=>"ta001",'name'=>"異動單別",'size'=>"10",'align'=>"left"),
		'mq002' => array('filter_name'=>"mq002",'name'=>"單別名稱",'size'=>"10",'align'=>"left"),
		'ta002' => array('filter_name'=>"ta002",'name'=>"異動單號",'size'=>"10",'align'=>"left"),
		'ta014' => array('filter_name'=>"ta014",'name'=>"單據日期",'size'=>"10",'align'=>"left"),
		'ta005' => array('filter_name'=>"ta005",'name'=>"備註",'size'=>"10",'align'=>"left"),
		'ta011' => array('filter_name'=>"ta011",'name'=>"總數量",'size'=>"10",'align'=>"left"),
		'ta012' => array('filter_name'=>"ta012",'name'=>"總金額",'size'=>"10",'align'=>"left"),
		//'ta006' => array('filter_name'=>"ta006",'name'=>"確認碼",'size'=>"10",'align'=>"left"),
		//'create_date' => array('filter_name'=>"create_date",'name'=>"建立日期",'size'=>"10",'align'=>"left"),
	  );
    ?>  
         <!-- <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php //$filter_ta001='';$filter_ta002='';$filter_ta003='';$filter_ta005='';$filter_ta011='';$filter_ta012='';$filter_ta006='';$filter_create=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	      <?php
			  foreach($filter_array as $key => $val){
				echo "<td class='".$val['align']."'>";
				  if($val['filter_name']==""){echo "</td>";continue;}  //filter_name = "" 沒有使用
				echo "<div class='button-search'></div>";
					
				  $ipt_str = "";
				  $ipt_str .= "<input type='text' id='".$val['filter_name']."' name='".$val['filter_name']."' class='filter_ipt' ";
				  if(isset($val['size'])){$ipt_str .= "size='".$val['size']."' ";}
				  if(isset($val['value'])){$ipt_str .= "value='".$val['value']."' ";}
				  if(isset($val['color'])){$ipt_str .= "style='background-color:".$val['color'].";' ";}
				  $ipt_str .= "/>";					
				  echo $ipt_str;
				  echo "</td>"; 
			  }
			?>
	   
	      <td align="center"><a onclick="filter();" accesskey="q" class="button">篩選 AND q</a></td>		
		  <td align="center"><a onclick="filtera();" accesskey="w" class="button">篩選 OR w</a></td>  
		  <td width="12%" align="center"></td> 
        </tr>
		<tbody>	
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->ta001."/".trim($row->ta002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>
		  <td class="left"><?php echo  $row->ta001;?></td>
          <td class="left"><?php echo  $row->mq002;?></td>		  
		  <td class="left"><?php echo  $row->ta002;?></td>
		  <td class="left"><?php echo  substr($row->ta014,0,4).'/'.substr($row->ta014,4,2).'/'.substr($row->ta014,6,2);?></td>
		  <td class="left"><?php echo  $row->ta005;?></td>
		  <td class="left"><?php echo  $row->ta011;?></td>
		  <td class="left"><?php echo  $row->ta012;?></td>
		<!--  <td class="left"><?php echo  $row->ta006;?></td>
		  <td class="center"><?php echo  substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>	-->	                 			
		
		  <td class="center"><a href="<?php echo site_url('inv/invi05/see/'.$row->ta001.'/'.$row->ta002) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
		  <td class="center"><a href="<?php echo site_url('inv/invi05/updform/'.$row->ta001.'/'.$row->ta002)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
		  <?PHP } ?>
	      <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
		  <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('inv/invi05/printbb/'.$row->ta001."/".trim($row->ta002))?>" id="print1"  >[ 印單據 </a><img src="<?php echo base_url()?>assets/image/png/Print1.png" />]</td>
	      <?PHP } ?>
	      <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('inv/invi05/del/'.$row->ta001."/".trim($row->ta002))?>" id="delete1"  >[ 刪除 ]</a></td>   -->
	    </tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
          </tbody>		 
        </table>
		  <!-- 修改時 留在原來那一筆資料使用 -->
		  <?php $this->session->set_userdata('invi05_search',$this->uri->segment(3)."/".$this->uri->segment(4,0));
		    if($this->uri->segment(3)=="display" || $this->uri->segment(3)=="display_leave"){
			  $this->session->set_userdata('invi05_search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));
			} ?>  
		<!-- 顯示頁次 -->
			
				<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
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

//改寫function filter 為and搜尋
function filter() {
	var where_str = "";
	var key = "";
	var val = "";
	$('.filter_ipt').each(function(){
		if($( this ).val()){
			if(key != ""){
				key += ",";
			}
			key += this.id;
			if(val != ""){
				val += ",";
			}
			val += $( this ).val();
		}
	});
	url = '<?php echo base_url() ?>index.php/inv/invi05/display_search/0/and_where?key=' + encodeURIComponent(key) + 
	'&val=' + encodeURIComponent(val);
	location = url;
}

//改寫function filter 為or搜尋
function filtera() {
	var where_str = "";
	var key = "";
	var val = "";
	$('.filter_ipt').each(function(){
		if($( this ).val()){
			if(key != ""){
				key += ",";
			}
			key += this.id;
			if(val != ""){
				val += ",";
			}
			val += $( this ).val();
			
		}
	});
	url = '<?php echo base_url() ?>index.php/inv/invi05/display_search/0/or_where?key=' + encodeURIComponent(key) + 
	'&val=' + encodeURIComponent(val);
	location = url;
}
</script>