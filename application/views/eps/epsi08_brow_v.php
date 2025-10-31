<div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 信用狀資料建立作業 - 瀏覽</h1>
	   <div style="float:right; "> 
	     <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	       <a onclick="location = '<?php echo base_url()?>index.php/eps/epsi08/clear_sql_term'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
         <?PHP } ?>
	     <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	       <a onclick="location = '<?php echo base_url()?>index.php/eps/epsi08/addform'"  style="float:left" accesskey="+" class="button"><span>新增 </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	     <?PHP } ?>
	     <?PHP if (substr($this->session->userdata('sysmg006'),999,1)=='Y') { ?>
	       <a onclick="location = '<?php echo base_url()?>index.php/eps/epsi08/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
         <?PHP } ?>
	     <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	       <a onclick="location = '<?php echo base_url()?>index.php/eps/epsi08/findform'"  style="float:left" accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
         <?PHP } ?>
	     <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	       <a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>選取刪除 </span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
         <?PHP } ?>
	     <?PHP if (substr($this->session->userdata('sysmg006'),69999,1)=='Y') { ?>
	       <a onclick="location = '<?php echo base_url()?>index.php/eps/epsi08/printdetail'"   style="float:left"  accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a> 
	     <?PHP } ?>
	     <?PHP if (substr($this->session->userdata('sysmg006'),69999,1)=='Y') { ?>
	       <a onclick="location = '<?php echo base_url()?>index.php/eps/epsi08/printdetailc'"   style="float:left"  accesskey="o" class="button"><span>印客戶訂單 o </span><img src="<?php echo base_url()?>assets/image/png/print1.png" /></a> 
	     <?PHP } ?>
	  
	      <a onclick="location = '<?php echo base_url()?>index.php/main/index/151'"  style="float:left" accesskey="x" class="button"><span>關閉 </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a> 
      </div>
    </div>  <!--end heading -->
	<?php 
	  $title_array = array(
		'rowid' => array('sort_name'=>"tf001",'name'=>"序號",'width'=>"5%",'align'=>"left",'use'=>"disable"),
		'tf001' => array('sort_name'=>"tf001",'name'=>"信用狀號",'width'=>"7%",'align'=>"left"),
		'tf002' => array('sort_name'=>"tf002",'name'=>"類別",'width'=>"7%",'align'=>"left"),
		'tf003' => array('sort_name'=>"tf003",'name'=>"客戶代號",'width'=>"7%",'align'=>"left"),
		'tf003disp' => array('sort_name'=>"tf003disp",'name'=>"客戶名稱",'width'=>"7%",'align'=>"left"),
		'tf013' => array('sort_name'=>"tf013",'name'=>"可否分批",'width'=>"5%",'align'=>"left"),
		'tf014' => array('sort_name'=>"tf014",'name'=>"可否轉運",'width'=>"5%",'align'=>"left"),
		'tf015' => array('sort_name'=>"tf015",'name'=>"許可証號",'width'=>"6%",'align'=>"left"),
		'tf005' => array('sort_name'=>"tf005",'name'=>"開狀銀行",'width'=>"5%",'align'=>"left"),
		'tf006' => array('sort_name'=>"tf006",'name'=>"通知銀行",'width'=>"5%",'align'=>"left"),
		'create_date' => array('sort_name'=>"create_date",'name'=>"建立日期",'width'=>"5%",'align'=>"left"),
		'see' => array('sort_name'=>"",'name'=>"查看管理",'width'=>"12%",'align'=>"center"),
		'edit' => array('sort_name'=>"",'name'=>"修改管理",'width'=>"12%",'align'=>"center")
	  );
    ?>
    <div class="content"> <!-- div-2 -->
      <form action="<?php echo base_url()?>index.php/eps/epsi08/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
          <thead>                <!-- 群組表頭 -->
            <tr>                          
              <td width="1%" style="text-align: center;">
		      <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	          </td>
		  <?php
		    //  範例: <td width="7%" class="left" >客戶訂單別 
			// anchor("eps/epsi08/display_search/".$this->uri->segment(4,0)."/order?val="tf001" asc ,
			//  <img src="http://localhost/assets/image/asc.png" /> ); </td> 因無區段4,取0, 排序 tf001
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
			  echo anchor("eps/epsi08/display_search/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." asc",$str);
			  $str = "<img src='".base_url()."assets/image/desc.png' />";
			  echo anchor("eps/epsi08/display_search/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." desc",$str);
				
			  echo "</td>";
			}
		  ?>
		    </tr>
          </thead>   <!-- 結束 群組表頭 -->
		 <!-- 一般師選表頭 -->
		 
	<?php 
	  $filter_array = array(
		'rowid' => array('filter_name'=>"",'name'=>"序號",'size'=>"12",'align'=>"left",'use'=>"disable"),
		'tf001' => array('filter_name'=>"tf001",'name'=>"信用狀號",'size'=>"10",'align'=>"left"),
		'tf002' => array('filter_name'=>"tf002",'name'=>"類別",'size'=>"10",'align'=>"left"),
		'tf003' => array('filter_name'=>"tf003",'name'=>"客戶代號",'size'=>"10",'align'=>"left"),
		'tf003disp' => array('filter_name'=>"tf003disp",'name'=>"客戶名稱",'size'=>"10",'align'=>"left"),
		'tf013' => array('filter_name'=>"tf013",'name'=>"可否分批",'size'=>"10",'align'=>"left"),
		'tf014' => array('filter_name'=>"tf014",'name'=>"可否轉運",'size'=>"10",'align'=>"left"),
		'tf015' => array('filter_name'=>"tf015",'name'=>"許可証號",'size'=>"10",'align'=>"left"),
		'tf005' => array('filter_name'=>"tf005",'name'=>"開狀銀行",'size'=>"10",'align'=>"left"),
		'tf006' => array('filter_name'=>"tf006",'name'=>"通知銀行",'size'=>"10",'align'=>"left"),
		'create_date' => array('filter_name'=>"create_date",'name'=>"建立日期",'size'=>"10",'align'=>"left"),
	  );
    ?>  
          <tbody>     <!--群組表身  表格內容輸入篩選查詢  -->
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
		<!--  <td width="12%" align="center"></td>  -->
          </tr>
			
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->tf001."/".trim($row->tf002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo $chkval;?></td>
		  <td class="left"><?php echo $row->tf001;?></td>
          <td class="left"><?php echo $row->tf002;?></td>		  
		  <td class="left"><?php echo $row->tf003;?></td>
		  <td class="left"><?php echo $row->tf003disp;?></td>
		  <td class="left"><?php echo $row->tf013;?></td>
		  <td class="left"><?php echo $row->tf014;?></td>
		  <td class="left"><?php echo $row->tf015;?></td>
		  <td class="left"><?php echo $row->tf005;?></td>
		  <td class="left"><?php echo $row->tf006;?></td>
		  <td class="center"><?php echo substr($row->create_date,0,4).'/'.substr($row->create_date,4,2).'/'.substr($row->create_date,6,2);?></td>		                 			
		
		    <td class="center"><a href="<?php echo site_url('eps/epsi08/see/'.$row->tf001.'/'.$row->tf002) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
		    <td class="center"><a href="<?php echo site_url('eps/epsi08/updform/'.$row->tf001.'/'.$row->tf002)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
		  <?PHP } ?>
	      <?PHP if (substr($this->session->userdata('sysmg006'),6999,1)=='Y') { ?>
		    <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('eps/epsi08/printbb/'.$row->tf001."/".trim($row->tf002))?>" id="print1"  >[ 印單據 </a><img src="<?php echo base_url()?>assets/image/png/Print1.png" />]</td>
	      <?PHP } ?>
	      
	    </tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
          </tbody>		<!--結束群組表身  --> 
        </table>        <!-- 結束表格 -->
		<!-- 修改時 留在原來那一筆資料使用 -->
		  <?php $this->session->set_userdata('epsi08_search',$this->uri->segment(3)."/".$this->uri->segment(4,0));
		    if($this->uri->segment(3)=="display" || $this->uri->segment(3)=="display_leave"){
			  $this->session->set_userdata('epsi08_search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));
			} ?>  
		<!-- 顯示頁次 -->	
		  <div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
		  <div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$this->session->userdata('msg1').$message.'<span>'.'</span>'.
          '◎操作說明:[ 點選欄位名稱箭頭即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
          <?php  $this->session->unset_userdata('msg1'); ?> 
	 </form>
    
    </div> <!-- div-2 menu內容-->
   </div>  <!-- div-1 menu內容導航-->
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
	url = '<?php echo base_url() ?>index.php/eps/epsi08/display_search/0/and_where?key=' + encodeURIComponent(key) + 
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
	url = '<?php echo base_url() ?>index.php/eps/epsi08/display_search/0/or_where?key=' + encodeURIComponent(key) + 
	'&val=' + encodeURIComponent(val);
	location = url;
}
</script>