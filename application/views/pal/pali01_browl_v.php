  <div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 員工基本資料建立作業 - 瀏覽　　　</h1>
     <!--  <div class="buttons"> -->
	   <div style="float:left; ">
		<?php if($this->uri->segment(3)=="display"){ ?>
			<?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
			<a onclick="location = '<?php echo base_url()?>index.php/pal/pali01/display_leave'"  style="float:left" accesskey="w" class="button"><span>顯示離職 w </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
			<?PHP } } ?>
		<?php if($this->uri->segment(3)=="display_leave"){ ?>
			<?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
			<a onclick="location = '<?php echo base_url()?>index.php/pal/pali01/display'"  style="float:left" accesskey="w" class="button"><span>隱藏離職 w </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
			<?PHP } } ?>
	    <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali01/display'"  style="float:left" accesskey="a" class="button"><span>重整 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	   <a onclick="location = '<?php echo base_url()?>index.php/pal/pali01/addform'"  style="float:left"  accesskey="i" class="button"><span>新增 i </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
       <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>	
	   <a onclick="location = '<?php echo base_url()?>index.php/pal/pali01/copyform'"  style="float:left"  accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
       <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	   <a onclick="location = '<?php echo base_url()?>index.php/pal/pali01/findform'"  style="float:left"  accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
       <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>        
	   <a onclick="$('form').submit();" style="float:left"  accesskey="-" class="button"><span>刪除</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	   <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	   <a onclick="location = '<?php echo base_url()?>index.php/pal/pali01/printdetail'"   style="float:left"   accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>   
	   <?PHP } ?>
	   <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	   <a onclick="location = '<?php echo base_url()?>index.php/pal/pali01/exceldetail'"   style="float:left"    accesskey="l" class="button"><span>EXCEL l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a>
       <?PHP } ?>	
	<!-- <a onclick="location = '<?php echo base_url()?>index.php/pal/pali01/printdetail'"  class="button"><span>列印</span></a>
	 <a onclick="location = '<?php echo base_url()?>index.php/pal/pali01/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	   <a onclick="location = '<?php echo base_url()?>index.php/main/index/111'" style="float:left"  accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
     </div>
	</div>
<?php 
	$title_array = array(
		'rowid' => array('sort_name'=>"mv001",'name'=>"序號",'width'=>"4%",'align'=>"left",'use'=>"disable"),
		'mv001' => array('sort_name'=>"mv001",'name'=>"員工代號",'width'=>"10%",'align'=>"left"),
		'mv002' => array('sort_name'=>"mv002",'name'=>"員工姓名",'width'=>"10%",'align'=>"left"),
		'mv004' => array('sort_name'=>"mv004",'name'=>"部門別",'width'=>"10%",'align'=>"left"),
		'mv006' => array('sort_name'=>"mv006",'name'=>"職務",'width'=>"10%",'align'=>"left"),
		'mv021' => array('sort_name'=>"mv021",'name'=>"到職日",'width'=>"10%",'align'=>"left"),
		'mv022' => array('sort_name'=>"mv022",'name'=>"離職日",'width'=>"10%",'align'=>"left"),
		'mv015' => array('sort_name'=>"mv015",'name'=>"電話",'width'=>"10%",'align'=>"left"),
		'see' => array('sort_name'=>"",'name'=>"查看管理",'width'=>"13%",'align'=>"center"),
		'edit' => array('sort_name'=>"",'name'=>"修改管理",'width'=>"13%",'align'=>"center")
	);
?>
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/pal/pali01/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
        <thead>
        <tr>                          <!-- 表格表頭 -->
          <td width="1%" style="text-align: center;">
		  <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
		  <?php
			foreach($title_array as $key => $val){
				echo "<td width='".$val['width']."' class='".$val['align']."'>";
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
				echo anchor("pal/pali01/display_leave/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." asc",$str);
				
				$str = "<img src='".base_url()."assets/image/desc.png' />";
				echo anchor("pal/pali01/display_leave/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." desc",$str);
				
				echo "</td>";
			}
		  ?>
          </tr>
          </thead>
<?php 
	$filter_array = array(
		'rowid' => array('filter_name'=>"",'name'=>"序號",'size'=>"12",'align'=>"left",'use'=>"disable"),
		'mv001' => array('filter_name'=>"mv001",'name'=>"員工代號",'size'=>"8",'align'=>"left"),
		'mv002' => array('filter_name'=>"mv002",'name'=>"員工姓名",'size'=>"12",'align'=>"left",'color'=>"#F5F5F5"),
		'mv004' => array('filter_name'=>"mv004",'name'=>"部門別",'size'=>"9",'align'=>"left"),
		'mv006' => array('filter_name'=>"mv006",'name'=>"職務",'size'=>"9",'align'=>"left"),
		'mv021' => array('filter_name'=>"mv021",'name'=>"到職日",'size'=>"9",'align'=>"left"),
		'mv022' => array('filter_name'=>"mv022",'name'=>"離職日",'size'=>"9",'align'=>"left"),
		'mv015' => array('filter_name'=>"mv015",'name'=>"電話",'size'=>"15",'align'=>"left")
	);
?>
		  
       <!-- <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	      <?php $filter_mv001='';$filter_mv002='';$filter_mv006='';$filter_mv008='';$filter_mv009='';$filter_mv005='';$filter_create=''; ?>
	      <tr class="filter">
	      <td class="left"></td>
			<?php
				foreach($filter_array as $key => $val){
					echo "<td class='".$val['align']."'>";
					if($val['filter_name']==""){echo "</td>";continue;}//filter_name = "" 為沒有使用
					
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
	      <td  align="center"><a onclick="filter();" accesskey="q" class="button">篩選 AND q</a></td>		
	      <td  align="center"><a onclick="filtera();" accesskey="w" class="button">篩選 OR w</a></td> 
        </tr>
		<tbody>	
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->mv001."/".trim($row->mv001)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>
		  <td class="left"><?php echo  $row->mv001;?></td>			  
		  <td class="left"><?php echo  $row->mv002;?></td>
		  <td class="left"><?php echo  $row->mv004.":".$row->me002;?></td>
		  <td class="left"><?php echo  $row->mv006.":".$row->mj003;?></td>
		  <td class="left"><?php echo  substr($row->mv021,0,4).'/'.substr($row->mv021,4,2).'/'.substr($row->mv021,6,2);?></td>
		  <td class="left"><?php echo  substr($row->mv022,0,4).'/'.substr($row->mv022,4,2).'/'.substr($row->mv022,6,2);?></td>
		  <td class="left"><?php echo  $row->mv015." , ".$row->mv016; ?></td>
		  <td class="center"><a href="<?php echo site_url('pal/pali01/see/'.$row->mv001) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>                 
		  <td class="center"><a href="<?php echo site_url('pal/pali01/updform/'.$row->mv001)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
          <?PHP } ?>	   
	   </tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
        </tbody>
        </table>
		     
				<!-- 修改時 留在原來那一筆資料使用 -->
				<?php $this->session->set_userdata('pali01_search',$this->uri->segment(3)."/".$this->uri->segment(4,0));
				if($this->uri->segment(3)=="display" || $this->uri->segment(3)=="display_leave"){
					$this->session->set_userdata('pali01_search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));
				} ?>
		       <?php  //$this->session->set_userdata('pali01_search1',"display/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
			 
				<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] '.' 　　總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      </form>
    
   </div> <!-- div-2 -->
  </div>  <!-- div-1 -->
</div>  <!-- div-0 -->
<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
  //  window.open('/index.php/pal/pali01/printdetail')
	window.location="<?php echo base_url()?>index.php/pal/pali01/printdetail";
  }

function open_winexcel()
  {
   // window.open('/index.php/pal/pali01/exceldetail')
	window.location="<?php echo base_url()?>index.php/pal/pali01/exceldetail";
  }
</script>

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
		//$( this ).id()
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
	url = '<?php echo base_url() ?>index.php/pal/pali01/display_leave/0/and_where?key=' + encodeURIComponent(key) + 
	'&val=' + encodeURIComponent(val);
	location = url;
}

function filtera() {
	var where_str = "";
	var key = "";
	var val = "";
	$('.filter_ipt').each(function(){
		//$( this ).id()
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
	url = '<?php echo base_url() ?>index.php/pal/pali01/display_leave/0/or_where?key=' + encodeURIComponent(key) + 
	'&val=' + encodeURIComponent(val);
	location = url;
}
</script>