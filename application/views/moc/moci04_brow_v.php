<div class="box2"> <!-- div-1 -->
    <div class="heading">
		<h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 退料單建立作業 - 瀏覽　　　</h1>
		<!--  <div class="buttons"> -->
		<div style="float:left; "> 
			<?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
				<a onclick="location = '<?php echo base_url()?>index.php/moc/moci04/clear_sql_term'"  style="float:left" accesskey="a" class="button"><span>重整 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
				<?PHP } ?>
			<?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
				<a onclick="location = '<?php echo base_url()?>index.php/moc/moci04/addform'"  style="float:left" accesskey="i" class="button"><span>新增 i </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
				<?PHP } ?>
			<?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
				<a onclick="location = '<?php echo base_url()?>index.php/moc/moci04/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
				<?PHP } ?>
			<?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
				<a onclick="location = '<?php echo base_url()?>index.php/moc/moci04/findform'"  style="float:left" accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
				<?PHP } ?>
			<?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
				<a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>刪除 - </span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
				<?PHP } ?>
			<?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
				<!-- <a onclick="$('form').submitb();"   class="button">印核價單</a>   -->
				<a onclick="location = '<?php echo base_url()?>index.php/moc/moci04/printdetail'"   style="float:left"  accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a> 
				<?PHP } ?>
			<?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
				<a onclick="location = '<?php echo base_url()?>index.php/moc/moci04/printdetailc'"   style="float:left"  accesskey="o" class="button"><span>印退料單 o </span><img src="<?php echo base_url()?>assets/image/png/print1.png" /></a> 
				<?PHP } ?>
			<?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
				<a onclick="location = '<?php echo base_url()?>index.php/moc/moci04/exceldetail'"  style="float:left"  accesskey="l" class="button"><span>excel檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
				<?PHP } ?>
				<!-- <a onclick="location = '<?php echo base_url()?>index.php/moc/moci04/printdetail'"  class="button"><span>列印</span></a>
				<a onclick="location = '<?php echo base_url()?>index.php/moc/moci04/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
				<a onclick="location = '<?php echo base_url()?>index.php/main/index/108'"  style="float:left"  accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
		</div>
    </div>
	
<?php
/* title欄位設定區域*/
	$title_array = array(
		'rowid' => array('sort_name'=>"tc001",'name'=>"序號",'width'=>"5%",'align'=>"left",'use'=>"disable"),
		'tc001' => array('sort_name'=>"tc001",'name'=>"退料單別",'width'=>"7%",'align'=>"left"),
		'tc001disp' => array('sort_name'=>"tc001disp",'name'=>"單別名稱",'width'=>"7%",'align'=>"left"),
		'tc002' => array('sort_name'=>"tc002",'name'=>"退料單號",'width'=>"7%",'align'=>"left"),
		'tc003' => array('sort_name'=>"tc003",'name'=>"退料日期",'width'=>"7%",'align'=>"left"),
		'tc004' => array('sort_name'=>"tc004",'name'=>"廠商代號",'width'=>"7%",'align'=>"left"),
		'tc006' => array('sort_name'=>"tc006",'name'=>"加工廠商",'width'=>"7%",'align'=>"left"),
		'tc005' => array('sort_name'=>"tc006",'name'=>"生產線別",'width'=>"7%",'align'=>"left"),
		'tc008' => array('sort_name'=>"tc008",'name'=>"單據性質",'width'=>"7%",'align'=>"left"),
		//'tc009' => array('sort_name'=>"tc009",'name'=>"確認碼",'width'=>"8%",'align'=>"left"),
		//'tc013' => array('sort_name'=>"tc013",'name'=>"庫存不足照領",'width'=>"8%",'align'=>"left"),
		'see'   => array('sort_name'=>"",'name'=>"查看管理",'width'=>"8%",'align'=>"center" ),
		'edit'  => array('sort_name'=>"",'name'=>"修改管理",'width'=>"8%",'align'=>"center"),
		'printa'=> array('sort_name'=>"",'name'=>"印退料單",'width'=>"8%",'align'=>"center")
	);
	
	$tc008_ary = array('54'=>"廠內領料",'55'=>"託外領料",'56'=>"廠內退料",'57'=>"託外退料");
?>
	
<div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/moc/moci04/delete" method="post" enctype="multipart/form-data" id="form">
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
						echo anchor("moc/moci04/display_search/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." asc",$str);
						
						$str = "<img src='".base_url()."assets/image/desc.png' />";
						echo anchor("moc/moci04/display_search/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." desc",$str);
						
						echo "</td>";
					}
				  ?>
				</tr>
			</thead>
<?php
/* filter欄位設定區域 */

	$filter_array = array(
		'rowid' => array('filter_name'=>"",'name'=>"序號",'size'=>"4",'align'=>"left",'use'=>"disable"),
		'tcoo1' => array('filter_name'=>"tc001",'name'=>"退料單別",'size'=>"8",'align'=>"left"),
		'tcoo1disp' => array('filter_name'=>"tc001disp",'name'=>"單別名稱",'size'=>"8",'align'=>"left"),
		'tc002' => array('filter_name'=>"tc002",'name'=>"退料單號",'size'=>"12",'align'=>"left",'color'=>"#F5F5F5"),
		'tc003' => array('filter_name'=>"tc003",'name'=>"退料日期",'size'=>"9",'align'=>"left"),
		'tc004' => array('filter_name'=>"tc004",'name'=>"廠別代號",'size'=>"11",'align'=>"left"),
		'tc006' => array('filter_name'=>"tc006",'name'=>"加工廠商",'size'=>"9",'align'=>"left"),
		'tc005' => array('filter_name'=>"tc005",'name'=>"生產線別",'size'=>"9",'align'=>"left"),
		'tc008' => array('filter_name'=>"tc008",'name'=>"單據性質",'size'=>"9",'align'=>"left"),
	//	'tc009' => array('filter_name'=>"tc009",'name'=>"確認碼",'size'=>"6",'align'=>"center"),
	//	'tc013' => array('filter_name'=>"tc013",'name'=>"庫存不足照領",'size'=>"6",'align'=>"center")
	);
?>
			<!--<tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
				<tr class="filter">
					<td class="left"></td>
				  <?php
					foreach($filter_array as $key => $val){
						echo "<td class'".$val['align']."'>";
						if($val['filter_name']==""){
							echo "</td>";continue;
						}
						echo "<div class='button-search'></div>";
						$ipt_str="";
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
					<td align="center"></td>
				</tr>
				
				<tbody>
			<?php $chkval=1; ?>               
			<?php foreach($results as $row ) : ?>
				<tr>
					<td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->tc001."/".trim($row->tc002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
					<td class="left"><?php echo  $chkval;?></td>
					<td class="left"><?php echo  $row->tc001;?></td>
					<td class="left"><?php echo  $row->tc001disp.$row->tc009;?></td>
					<td class="left"><?php echo  $row->tc002;?></td>
					<td class="left"><?php echo  substr($row->tc003,0,4).'/'.substr($row->tc003,4,2).'/'.substr($row->tc003,6,2);?></td>
					<td class="left"><?php echo  $row->tc004.":".$row->tc004disp;?></td>
					<td class="left"><?php echo  $row->tc006.":".$row->tc006disp;?></td>
					<td class="left"><?php echo  $row->tc005.":".$row->tc005disp;?></td>
					<td class="left"><?php echo  $row->tc008.":".$tc008_ary[$row->tc008];?></td>
				<!--	<td class="center"><?php echo  $row->tc009;?></td>
					<td class="center"><?php echo  $row->tc013;?></td>	-->                 			
					<td class="center"><a href="<?php echo site_url('moc/moci04/see/'.$row->tc001.'/'.$row->tc002) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
					<?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>
					<td class="center"><a href="<?php echo site_url('moc/moci04/updform/'.$row->tc001.'/'.$row->tc002)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
					<?PHP } ?>
					<?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
					<td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('moc/moci04/printbb/'.$row->tc001."/".trim($row->tc002))?>" id="print1"  >[ 印單據 </a><img src="<?php echo base_url()?>assets/image/png/Print1.png" />]</td>
					<?PHP } ?>
					<!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('moc/moci04/del/'.$row->tc001."/".trim($row->tc002))?>" id="delete1"  >[ 刪除 ]</a></td>   -->
				</tr>
				<?php $chkval += 1; ?>
				<?php endforeach;?>
			</tbody>		 
        </table>
		 <!-- 修改時 留在原來那一筆資料使用 -->
		<?php  $this->session->set_userdata('moci04_search',$this->uri->segment(3)."/".$this->uri->segment(4,0));
		if($this->uri->segment(3)=="display"){
			$this->session->set_userdata('moci04_search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));
		}
		 ?>
		<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
		<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
			'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] '.' 　　總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
    </form>
    </div> <!-- div-2 -->
</div>  <!-- div-1 -->
</div>


<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
   // window.open('/index.php/moc/moci04/printdetail')
	window.location="<?php echo base_url()?>index.php/moc/moci04/printdetail";
  }
  function open_winprint1()
  {
 //   window.open('/index.php/moc/moci04/printdetailc')
	window.location="<?php echo base_url()?>index.php/moc/moci04/printdetailc";
  }

function open_winexcel()
  {
  //  window.open('/index.php/moc/moci04/exceldetail')
	window.location="<?php echo base_url()?>index.php/moc/moci04/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var where_str = "";
	var key = "";
	var val = "";
	$('.filter_ipt').each(function(){
		//$(this).id()
		if($(this).val()){
			if(key != ""){
				key += ",";
			}
			key += this.id;
			if(val != ""){
				val += ",";
			}
			val += $(this).val();
		}
	});
	url = '<?php echo base_url() ?>index.php/moc/moci04/display_search/0/and_where?key=' + encodeURIComponent(key) +
	'&val=' + encodeURIComponent(val);
	location = url;
}

function filtera() {
	var where_str = "";
	var key = "";
	var val = "";
	$('filter_ipt').each(function(){
		//$(this).id()
		if($(this).val()){
			if(key != ""){
				key += ",";
			}
			key += this.id;
			if(val != ""){
				val += ",";
			}
			val += $(this).val();
		}
	});
	url = '<?php echo base_url() ?>index.php/moc/moci04/display_search/0/or_where?key=' + encodeURIComponent(key) +
	'&val=' + encodeURIComponent(val);
	location = url;
}
</script> 