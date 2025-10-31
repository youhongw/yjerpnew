<div class="box2" style="height:95%">  <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 應付憑單建立作業 - 瀏覽</h1>
	  <a onclick="location = '<?php echo base_url()?>index.php/acp/acpi02/clearall_sql'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>
    </div>
<?php 
/* title欄位設定區域 */
	$title_array = array(
		'chkbx' => array('sort_name'=>"ta001",'name'=>"選擇",'width'=>"",'align'=>"left",'use'=>"disable"),
		'rowid' => array('sort_name'=>"ta001",'name'=>"序號",'width'=>"",'align'=>"left",'use'=>"disable"),
		'ta001' => array('sort_name'=>"ta001",'name'=>"應付單別",'width'=>"",'align'=>"left"),
		'mq002' => array('sort_name'=>"mq002",'name'=>"單別名稱",'width'=>"",'align'=>"left"),
		'ta002' => array('sort_name'=>"ta002",'name'=>"應付單號",'width'=>"",'align'=>"left"),
		'ta034' => array('sort_name'=>"ta034",'name'=>"單據日期",'width'=>"",'align'=>"left"),
		'ta004' => array('sort_name'=>"ta004",'name'=>"廠商代號",'width'=>"",'align'=>"left"),
		'ma002' => array('sort_name'=>"ma002",'name'=>"廠商名稱",'width'=>"",'align'=>"left"),
		'ta2829' => array('sort_name'=>"ta2829",'name'=>"應付金額",'width'=>"",'align'=>"left"),
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
				echo anchor("acp/acpi02/display_child/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." asc",$str);
				
				$str = "<img src='".base_url()."assets/image/desc.png' />";
				echo anchor("acp/acpi02/display_child/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." desc",$str);
				
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
		'ta001' => array('filter_name'=>"ta001",'name'=>"應付單別",'size'=>"8",'align'=>"left"),
		'mq002' => array('filter_name'=>"mq002",'name'=>"單別名稱",'size'=>"12",'align'=>"left"),
		'ta002' => array('filter_name'=>"ta002",'name'=>"應付單號",'size'=>"12",'align'=>"left"),
		'ta034' => array('filter_name'=>"ta034",'name'=>"單據日期",'size'=>"8",'align'=>"left"),
		'ta004' => array('filter_name'=>"ta004",'name'=>"廠商代號",'size'=>"8",'align'=>"left"),
		'ma002' => array('filter_name'=>"ma002",'name'=>"廠商名稱",'size'=>"8",'align'=>"left"),
		'ta2829' => array('filter_name'=>"ta2829",'name'=>"應付金額",'size'=>"8",'align'=>"left")
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
      <!--  <tr class="row_<?php  echo $chkval; ?>" onclick="send_back_acpi02d('<?php echo $row->ta001;?>','<?php echo $row->ta002;?>','<?php echo addslashes($row->ta003);?>','<?php echo addslashes($row->ta004);?>','<?php echo $row->ta017;?>','<?php echo addslashes($row->ta017disp);?>');"> -->
		  <tr class="row_<?php  echo $chkval; ?>" onclick='send_back_acpi02d("<?php echo $row->ta001;?>","<?php echo $row->ta002;?>","<?php echo addslashes($row->ta014);?>","<?php echo addslashes($row->ta2829);?>","<?php echo $row->ta028;?>","<?php echo $row->ta019;?>","<?php echo $row->ta031;?>","<?php echo addslashes($row->ta032);?>");'>
		  <td class="left"><input id="chk_<?php echo $chkval; ?>" type="checkbox" class="row_chkbx" /></td>
		   <td class="left"><?php echo $chkval;?></td>
		  <td class="left ta001"><?php echo $row->ta001;?></td>
		  <input id='ta001_<?php echo $chkval?>' value='<?php echo $row->ta001;?>' style='display:none;' />
		  <td class="left mq002"><?php echo $row->mq002;?></td>
		  <input id='mq002_<?php echo $chkval?>' value='<?php echo $row->mq002;?>' style='display:none;' />
		  
		  <td class="left ta002"><?php echo $row->ta002;?></td>
		  <input id='ta002_<?php echo $chkval?>' value='<?php echo $row->ta002;?>' style='display:none;' />
		  
		  <td class="left ta034"><?php echo $row->ta034;?></td>
		  <input id='ta034_<?php echo $chkval?>' value='<?php echo $row->ta034;?>' style='display:none;' />
		  <td class="left ta004"><?php echo $row->ta004;?></td>
		  <input id='ta004_<?php echo $chkval?>' value='<?php echo $row->ta004;?>' style='display:none;' />
		  <td class="left ma002"><?php echo $row->ma002;?></td>
		  <input id='ma002_<?php echo $chkval?>' value='<?php echo $row->ma002;?>' style='display:none;' />
		  
		  <td class="left ta2829"><?php echo $row->ta2829;?></td>
		  <input id='ta2829_<?php echo $chkval?>' value='<?php echo $row->ta2829;?>' style='display:none;' />
		  <td class="center"><a href='javascript:send_back_acpi02d("<?php echo $row->ta001;?>","<?php echo $row->ta002;?>","<?php echo addslashes($row->ta034);?>","<?php echo addslashes($row->ta2829);?>","<?php echo $row->ta028;?>","<?php echo $row->ta029;?>","<?php echo $row->ta030;?>");'>[ 選擇 </a><img src="<?php echo base_url()?>assets/image/png/ok.png" />]</td>
		</tr>
		<?php $chkval += 1; ?>
		<?php endforeach;?>
        </tbody>
        </table>
		<div class="mult_add"><input id="btn_mult_add" type="button" style="float:right;" value="多筆加入" onclick="send_mult_back_acpi02d();" /></div>
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

function send_back_acpi02d(ta001, ta002, ta034, ta2829, ta028, ta029, ta030){
	window.parent.$.unblockUI();
	if(window.parent.addacpi02ddisp){	//以此判斷各呼叫此網頁的方法是否存在藉以給予相對應的需求
		window.parent.addacpi02ddisp(ta001, ta002, ta034, ta2829, ta028, ta029, ta030);
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/acp/acpi02/clear_sql"
		});
	}
}
function send_mult_back_acpi02d(){
	//window.parent.$.unblockUI();
	$('.row_chkbx:checked').each(function(){
		temp = this.id.split("_");
		var row_num = temp[1];
		var ta001 = $('.row_'+row_num+' .ta001').text();
		var ta002 = $('.row_'+row_num+' .ta002').text();
		var ta034 = $('.row_'+row_num+' .ta034').text();
		var ta2829 = $('.row_'+row_num+' .ta2829').text();
		var ta028 = $('.row_'+row_num+' .ta028').text();
		var ta029 = $('.row_'+row_num+' .ta029').text();
		var ta030 = $('.row_'+row_num+' .ta030').text();
		 console.log(ta002);
		if(window.parent.mult_addacpi02ddisp){	//以此判斷各呼叫此網頁的方法是否存在藉以給予相對應的需求
			window.parent.mult_addacpi02ddisp(ta001, ta002, ta034, ta2829, ta028, ta029, ta030);			
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
	url = '<?php echo base_url() ?>index.php/acp/acpi02/display_child/0/and_where?key=' + encodeURIComponent(key) + 
	'&val=' + encodeURIComponent(val);
	location = url;
}
</script>