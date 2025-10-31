<div class="box2" style="height:95%"> <!-- div-1 -->
    <div class="heading"> 
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /><?php echo $this->session->userdata('vmb001').' = ' ?> 廠商計價查詢作業 - 瀏覽</h1>
      <a onclick="location = '<?php echo base_url()?>index.php/pur/puri02/clear_sql'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>
	</div>
<?php 
/* title欄位設定區域 */
	$title_array = array(
		'rowid' => array('sort_name'=>"a.mb002",'name'=>"序號",'width'=>"",'align'=>"left",'use'=>"disable"),
		'a.mb001' => array('sort_name'=>"a.mb001",'name'=>"品號",'width'=>"",'align'=>"left"),
		'b.mb002' => array('sort_name'=>"b.mb002",'name'=>"品名",'width'=>"",'align'=>"left"),
		'b.mb003' => array('sort_name'=>"b.mb003",'name'=>"規格",'width'=>"",'align'=>"left"),
		'a.mb004' => array('sort_name'=>"a.mb004",'name'=>"計價單位",'width'=>"",'align'=>"left"),
		'a.mb003' => array('sort_name'=>"a.mb003",'name'=>"幣別",'width'=>"",'align'=>"left"),
		'a.mb011' => array('sort_name'=>"a.mb011",'name'=>"單價",'width'=>"",'align'=>"left"),
		'a.mb009' => array('sort_name'=>"a.mb009",'name'=>"上次進貨日",'width'=>"",'align'=>"left"),
		'select' => array('sort_name'=>"",'name'=>"",'width'=>"",'align'=>"center")
	);
	//echo "<pre>";var_dump('test');exit;
?>
	
  <div class="content"> <!-- div-2 -->
    <form method="post" enctype="multipart/form-data" id="form">
        <table class="list"> <!-- 表格開始 -->
        <thead>
          <tr>
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
				
				$str = "<img src='".base_url()."assets/image/asc.png' />";      //抬頭排序
				echo anchor("pur/puri02/display_child/0"."/order?val=".$val['sort_name']." asc",$str);
				
				$str = "<img src='".base_url()."assets/image/desc.png' />";
				echo anchor("pur/puri02/display_child/0/".$this->uri->segment(5)."/order?val=".$val['sort_name']." desc",$str);
				
				echo "</td>";
			}
		  ?>
        </tr>
        </thead>
<?php 

	$filter_array = array(
		'rowid' => array('filter_name'=>"",'name'=>"序號",'size'=>"12",'align'=>"left",'use'=>"disable"),
		'a.mb001' => array('filter_name'=>"a.mb001",'name'=>"品號",'size'=>"8",'align'=>"left"),
		'b.mb002' => array('filter_name'=>"b.mb002",'name'=>"品名",'size'=>"12",'align'=>"left"),
		'b.mb003' => array('filter_name'=>"b.mb003",'name'=>"規格",'size'=>"12",'align'=>"left"),
		'a.mb004' => array('filter_name'=>"a.mb004",'name'=>"計價單位",'size'=>"12",'align'=>"left"),
		'a.mb003' => array('filter_name'=>"a.mb003",'name'=>"幣別",'size'=>"12",'align'=>"left"),
		'a.mb011' => array('filter_name'=>"a.mb011",'name'=>"單價",'size'=>"12",'align'=>"left"),
		'a.mb009' => array('filter_name'=>"a.mb009",'name'=>"上次進貨日",'size'=>"12",'align'=>"left")
	);
?>
		  
        <tbody> <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <tr class="filter">
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
			<td  align="center"><a onclick="filter();" class="button">篩選</a></td>
	    <!-- <button type='submit' name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
      </tr>
		<?//品號a_mb002,品名b_mb002,規格b_mb003,單位a_mb003,幣別a_mb004,單價a_mb008 b_mb017 庫別 b_mb017disp 庫名稱?>
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr onclick="parent.addpuri02disp('<?php echo $row->a_mb001;?>','<?php echo $row->b_mb002;?>','<?php echo str_replace('"','!',$row->b_mb003);?>','<?php echo $row->a_mb004;?>','<?php echo $row->a_mb011;?>','<?php echo $row->b_mb017;?>','<?php echo $row->b_mb017disp;?>');parent.$.unblockUI();" >
          <td class="left"><?php echo $chkval;?></td>
		  <td class="left"><?php echo $row->a_mb001;?></td>
		  <input id='amb001_<?php echo $chkval?>' value='<?php echo $row->a_mb001;?>' style='display:none;' />
		  
		  <td class="left"><?php echo $row->b_mb002;?></td>
		  <input id='bmb002_<?php echo $chkval?>' value='<?php echo $row->b_mb002;?>' style='display:none;' />
		  
		  <td class="left"><?php echo $row->b_mb003;?></td>
		  <input id='bmb003_<?php echo $chkval?>' value='<?php echo $row->b_mb003;?>' style='display:none;' />
		
     		<td class="left"><?php echo $row->a_mb004;?></td>
		  <input id='amb004_<?php echo $chkval?>' value='<?php echo $row->a_mb004;?>' style='display:none;' />
		   
		   <td class="left"><?php echo $row->a_mb003;?></td>
		  <input id='amb003_<?php echo $chkval?>' value='<?php echo $row->a_mb003;?>' style='display:none;' />
		  
		  <td class="left"><?php echo $row->a_mb011;?></td>
		  <input id='amb011_<?php echo $chkval?>' value='<?php echo $row->a_mb011;?>' style='display:none;' />
		  
		  <td class="left"><?php echo $row->a_mb009;?></td>
		  <input id='amb009_<?php echo $chkval?>' value='<?php echo $row->a_mb009;?>' style='display:none;' />
		  <td class="center"><a href="javascript:send_back_puri02('<?php echo $row->a_mb001;?>','<?php echo $row->b_mb002;?>','<?php echo str_replace('"','!',$row->b_mb003);?>','<?php echo $row->a_mb004;?>','<?php echo $row->a_mb011;?>','<?php echo $row->b_mb017;?>','<?php echo $row->b_mb017disp;?>');">[ 選擇</a><img src="<?php echo base_url()?>assets/image/png/ok.png" />]</td>
		</tr>
		<?php $chkval += 1; ?>
		<?php endforeach;?>
        </tbody>		 
        </table>
		<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
		<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 選欄位名稱自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆'.'&nbsp&nbsp&nbsp&nbsp&nbsp　　　　　' ?> </div>	
	
	</form>
	
  </div> <!-- div-2 -->
</div> <!-- div-1 -->

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});
function send_back_puri02(me001, me002, me003, me004, me005,me006,me007){
	//alert('test1');
	window.parent.$.unblockUI();
	if(window.parent.addpuri02disp){	//以此判斷各呼叫此網頁的方法是否存在藉以給予相對應的需求
		window.parent.addpuri02disp(me001,me002, me003, me004, me005,me006,me007);
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/pur/puri02/clear_sql"
		});
	}
}

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
	// url = '<?php echo base_url() ?>index.php/pur/puri02/display_child/' + encodeURIComponent(val); 1060803
	url = '<?php echo base_url() ?>index.php/pur/puri02/display_child/0/cn00000/and_where?key=' + encodeURIComponent(key) + 
	'&val=' + encodeURIComponent(val);
	location = url;
}
</script>