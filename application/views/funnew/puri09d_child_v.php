<div class="box2" style="height:95%">  <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 進貨資料建立作業 - 瀏覽</h1>
	  <a onclick="location = '<?php echo base_url()?>index.php/pur/puri09/clearall_sql'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>
    </div>
<?php 
/* title欄位設定區域 */
	$title_array = array(
		'chkbx' => array('sort_name'=>"tg001",'name'=>"選擇",'width'=>"",'align'=>"left",'use'=>"disable"),
		'rowid' => array('sort_name'=>"tg001",'name'=>"序號",'width'=>"",'align'=>"left",'use'=>"disable"),
		'tg001' => array('sort_name'=>"tg001",'name'=>"進貨單別",'width'=>"",'align'=>"left"),
		'mq002' => array('sort_name'=>"mq002",'name'=>"單別名稱",'width'=>"",'align'=>"left"),
		'tg002' => array('sort_name'=>"tg002",'name'=>"進貨單號",'width'=>"",'align'=>"left"),
		'tg014' => array('sort_name'=>"tg014",'name'=>"單據日期",'width'=>"",'align'=>"left"),
		'tg005' => array('sort_name'=>"tg005",'name'=>"廠商代號",'width'=>"",'align'=>"left"),
		'ma002' => array('sort_name'=>"ma002",'name'=>"廠商名稱",'width'=>"",'align'=>"left"),
		'tg1928' => array('sort_name'=>"tg1928",'name'=>"進貨金額",'width'=>"",'align'=>"left"),
		'select' => array('sort_name'=>"",'name'=>"",'width'=>"",'align'=>"center")
	);
?>
	
  <div class="content"> <!-- div-2 -->
    <form method="post" enctype="multipart/form-data" id="form">
      <table class="list">      <!-- 表格開始 -->
        <thead>
          <tr>                          <!-- 表格表頭 -->
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
				echo anchor("pur/puri09/display_child/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." asc",$str);
				
				$str = "<img src='".base_url()."assets/image/desc.png' />";
				echo anchor("pur/puri09/display_child/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." desc",$str);
				
				echo "</td>";
			}
		  ?>
          </tr>
        </thead>
<?php 

/* filter欄位設定區域 */
	$filter_array = array(
		'chkbx' => array('filter_name'=>"chkbx",'name'=>"多選",'align'=>"left",'use'=>"disable"),
		'rowid' => array('filter_name'=>"",'name'=>"序號",'size'=>"12",'align'=>"left",'use'=>"disable"),
		'tg001' => array('filter_name'=>"tg001",'name'=>"進貨單別",'size'=>"8",'align'=>"left"),
		'mq002' => array('filter_name'=>"mq002",'name'=>"單別名稱",'size'=>"12",'align'=>"left"),
		'tg002' => array('filter_name'=>"tg002",'name'=>"進貨單號",'size'=>"12",'align'=>"left"),
		'tg014' => array('filter_name'=>"tg014",'name'=>"單據日期",'size'=>"8",'align'=>"left"),
		'tg005' => array('filter_name'=>"tg005",'name'=>"廠商代號",'size'=>"8",'align'=>"left"),
		'ma002' => array('filter_name'=>"ma002",'name'=>"廠商名稱",'size'=>"8",'align'=>"left"),
		'tg1928' => array('filter_name'=>"tg1928",'name'=>"進貨金額",'size'=>"8",'align'=>"left")
	);
?>
        <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <tr class="filter">
			<?php
			foreach($filter_array as $key => $val){
				if($key=="chkbx"){
					echo "<td class='".$val['align']."'>";					
					echo "<div class='button-search'></div>";
					$ipt_str = "";
					$ipt_str .= "<input type='checkbox' id='".$val['filter_name']."' name='".$val['filter_name']."' class='filter_ipt' ";
					if(isset($val['size'])){$ipt_str .= "size='".$val['size']."' ";}
					if(isset($val['value'])){$ipt_str .= "value='".$val['value']."' ";}
					if(isset($val['color'])){$ipt_str .= "style='background-color:".$val['color'].";' ";}
					$ipt_str .= "/>";
					echo $ipt_str;
					echo "</td>";
				}else{
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
			}
			?>
	      <td  align="center"><a onclick="filter();" class="button">篩選</a></td>
        </tr>
			
	    <?php $chkval=1; ?>
	    <?php foreach($results as $row ) : ?>
      <!--  <tr class="row_<?php  echo $chkval; ?>" onclick="send_back_puri09d('<?php echo $row->tg001;?>','<?php echo $row->tg002;?>','<?php echo addslashes($row->tg003);?>','<?php echo addslashes($row->tg004);?>','<?php echo $row->tg017;?>','<?php echo addslashes($row->tg017disp);?>');"> -->
		  <tr class="row_<?php  echo $chkval; ?>" onclick='send_back_puri09d("<?php echo $row->tg001;?>","<?php echo $row->tg002;?>","<?php echo addslashes($row->tg014);?>","<?php echo addslashes($row->tg1928);?>","<?php echo $row->tg028;?>","<?php echo $row->tg019;?>","<?php echo $row->tg031;?>","<?php echo addslashes($row->tg032);?>");'>
		  <td class="left"><input id="chk_<?php echo $chkval; ?>" type="checkbox" class="row_chkbx" /></td>
		   <td class="left"><?php echo $chkval;?></td>
		  <td class="left tg001"><?php echo $row->tg001;?></td>
		  <input id='tg001_<?php echo $chkval?>' value='<?php echo $row->tg001;?>' style='display:none;' />
		  <td class="left mq002"><?php echo $row->mq002;?></td>
		  <input id='mq002_<?php echo $chkval?>' value='<?php echo $row->mq002;?>' style='display:none;' />
		  
		  <td class="left tg002"><?php echo $row->tg002;?></td>
		  <input id='tg002_<?php echo $chkval?>' value='<?php echo $row->tg002;?>' style='display:none;' />
		  
		  <td class="left tg014"><?php echo $row->tg014;?></td>
		  <input id='tg014_<?php echo $chkval?>' value='<?php echo $row->tg014;?>' style='display:none;' />
		  <td class="left tg005"><?php echo $row->tg005;?></td>
		  <input id='tg005_<?php echo $chkval?>' value='<?php echo $row->tg005;?>' style='display:none;' />
		  <td class="left ma002"><?php echo $row->ma002;?></td>
		  <input id='ma002_<?php echo $chkval?>' value='<?php echo $row->ma002;?>' style='display:none;' />
		  
		  <td class="left tg1928"><?php echo $row->tg1928;?></td>
		  <input id='tg1928_<?php echo $chkval?>' value='<?php echo $row->tg1928;?>' style='display:none;' />
		  <td class="center"><a href='javascript:send_back_puri09d("<?php echo $row->tg001;?>","<?php echo $row->tg002;?>","<?php echo addslashes($row->tg014);?>","<?php echo addslashes($row->tg1928);?>","<?php echo $row->tg028;?>","<?php echo $row->tg019;?>","<?php echo $row->tg031;?>","<?php echo $row->tg032;?>");'>[ 選擇 </a><img src="<?php echo base_url()?>assets/image/png/ok.png" />]</td>
		</tr>
		<?php $chkval += 1; ?>
		<?php endforeach;?>
        </tbody>
        </table>
		<div class="mult_add"><input id="btn_mult_add" type="button" style="float:right;" value="多筆加入" onclick="send_mult_back_puri09d();" /></div>
		<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
		<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 選欄位名稱自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 選取列項出現打勾可多筆刪除, 列印可自設網址列不印, 快速鍵Alt+.. ] '.'　　總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      </form>
     </div> <!-- div-2 -->
    </div> <!-- div-1 -->
</div> <!-- div-0 -->

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
	$('#footer').hide();
});

function send_back_puri09d(tg001, tg002, tg014, tg1928, tg028, tg019, tg031, tg032){
	window.parent.$.unblockUI();
	if(window.parent.addpuri09ddisp){	//以此判斷各呼叫此網頁的方法是否存在藉以給予相對應的需求
		window.parent.addpuri09ddisp(tg001, tg002, tg014, tg1928, tg028, tg019, tg031, tg032);
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/pur/puri09/clear_sql"
		});
	}
}
function send_mult_back_puri09d(){
	//window.parent.$.unblockUI();
	$('.row_chkbx:checked').each(function(){
		temp = this.id.split("_");
		var row_num = temp[1];
		var tg001 = $('.row_'+row_num+' .tg001').text();
		var tg002 = $('.row_'+row_num+' .tg002').text();
		var tg014 = $('.row_'+row_num+' .tg014').text();
		var tg1928 = $('.row_'+row_num+' .tg1928').text();
		var tg028 = $('.row_'+row_num+' .tg028').text();
		var tg019 = $('.row_'+row_num+' .tg019').text();
		var tg031 = $('.row_'+row_num+' .tg031').text();
		var tg032 = $('.row_'+row_num+' .tg032').text();
		 console.log(tg002);
		if(window.parent.mult_addpuri09ddisp){	//以此判斷各呼叫此網頁的方法是否存在藉以給予相對應的需求
			window.parent.mult_addpuri09ddisp(tg001, tg002, tg014, tg1928, tg028, tg019, tg031, tg032);			
		}
	});
}
//多筆選擇
$("#chkbx").click(function() {
	check_check_all();
});
function check_check_all(){
   if($("#chkbx").prop("checked")) {
     $(".row_chkbx").each(function() {
         $(this).prop("checked", true);
     });
   } else {
     $(".row_chkbx").each(function() {
         $(this).prop("checked", false);
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
	url = '<?php echo base_url() ?>index.php/pur/puri09/display_child/0/and_where?key=' + encodeURIComponent(key) + 
	'&val=' + encodeURIComponent(val);
	location = url;
}
</script>