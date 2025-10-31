<div class="box2" style="height:95%">  <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 借款批號資料建立作業 - 瀏覽</h1>
	  <a onclick="location = '<?php echo base_url()?>index.php/inv/invi02/clearall_sql'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>
    </div>
<?php 
/* title欄位設定區域 */
	$title_array = array(
		'chkbx' => array('sort_name'=>"tj001",'name'=>"選擇",'width'=>"",'align'=>"left",'use'=>"disable"),
		'rowid' => array('sort_name'=>"tj001",'name'=>"序號",'width'=>"",'align'=>"left",'use'=>"disable"),
		'tj001' => array('sort_name'=>"tj001",'name'=>"借款批號",'width'=>"",'align'=>"left"),
		'tj002' => array('sort_name'=>"tj002",'name'=>"合約期",'width'=>"",'align'=>"left"),
		'tj003' => array('sort_name'=>"tj003",'name'=>"借款銀行",'width'=>"",'align'=>"left"),
		'tj003disp' => array('sort_name'=>"tj003disp",'name'=>"銀行名稱",'width'=>"",'align'=>"left"),
		'tj014' => array('sort_name'=>"tj014",'name'=>"借款金額",'width'=>"",'align'=>"left"),
		'tj015' => array('sort_name'=>"tj015",'name'=>"已還款金額",'width'=>"",'align'=>"left"),
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
				echo anchor("inv/invi02/display_child/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." asc",$str);
				
				$str = "<img src='".base_url()."assets/image/desc.png' />";
				echo anchor("inv/invi02/display_child/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." desc",$str);
				
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
		'tj001' => array('filter_name'=>"tj001",'name'=>"借款批號",'size'=>"8",'align'=>"left"),
		'tj002' => array('filter_name'=>"tj002",'name'=>"合約日期",'size'=>"12",'align'=>"left"),
		'tj003' => array('filter_name'=>"tj003",'name'=>"借款銀行",'size'=>"12",'align'=>"left"),
		'tj003disp' => array('filter_name'=>"tj003disp",'name'=>"銀行名稱",'size'=>"8",'align'=>"left"),
		'tj014' => array('filter_name'=>"tj014",'name'=>"借款金額",'size'=>"8",'align'=>"left"),
		'tj015' => array('filter_name'=>"tj015",'name'=>"已還款金額",'size'=>"8",'align'=>"left")
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
		
		<?php
			$tl011 = 0; $tl012=0;
			
			$tl011 = (int)($row->tj014) - (int)($row->tj015);
			$tl012 = ((int)($row->tj011) * (float)($row->tj007)) /12;
		?>
		
        <tr onclick="parent.addnoti09ddisp('<?php echo $row->tj001;?>','<?php echo $tl011;?>','<?php echo $tl012;?>');parent.$.unblockUI();" class="row_<?php  echo $chkval; ?>"  > 
		  <td class="left"><input id="chk_<?php echo $chkval; ?>" type="checkbox" class="row_chkbx" /></td>
		   <td class="left"><?php echo $chkval;?></td>
		  <td class="left tj001"><?php echo $row->tj001;?></td>
		  <input id='tj001_<?php echo $chkval?>' value='<?php echo $row->tj001;?>' style='display:none;' />
		  <td class="left tj002"><?php echo $row->tj002;?></td>
		  <input id='tj002_<?php echo $chkval?>' value='<?php echo $row->tj002;?>' style='display:none;' />
		  <td class="left tj003"><?php echo $row->tj003;?></td>
		  <input id='tj003_<?php echo $chkval?>' value='<?php echo $row->tj003;?>' style='display:none;' />
		  <td class="left tj003disp"><?php echo $row->tj003disp;?></td>
		  <input id='tj003disp_<?php echo $chkval?>' value='<?php echo $row->tj003disp;?>' style='display:none;' />
		  <td class="left tj014"><?php echo $row->tj014;?></td>
		  <input id='tj014_<?php echo $chkval?>' value='<?php echo $row->tj014;?>' style='display:none;' />
		  <td class="left tj015"><?php echo $row->tj015;?></td>
		  <input id='tj015_<?php echo $chkval?>' value='<?php echo $row->tj015;?>' style='display:none;' />
		  
		  
		  <td class="center"><a href='javascript:send_back_noti09d("<?php echo $row->tj001;?>","<?php echo $tl011;?>","<?php echo $tl012;?>");'>[ 選擇 </a><img src="<?php echo base_url()?>assets/image/png/ok.png" />]</td>
		</tr>
		<?php $chkval += 1; ?>
		<?php endforeach;?>
        </tbody>
        </table>
		<div class="mult_add"><input id="btn_mult_add" type="button" style="float:right;" value="多筆加入" onclick="send_mult_back_noti09d();" /></div>
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

function send_back_noti09d(tj001, tl011, tl012){
	window.parent.$.unblockUI();
	if(window.parent.addnoti09ddisp){	//以此判斷各呼叫此網頁的方法是否存在藉以給予相對應的需求
		window.parent.addnoti09ddisp(tj001, tl011, tl012);
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/not/noti09/clear_sql2"
		});
	}
}
function send_mult_back_invi02d(){
	//window.parent.$.unblockUI();
	$('.row_chkbx:checked').each(function(){
		temp = this.id.split("_");
		var row_num = temp[1];
		var mb001 = $('.row_'+row_num+' .mb001').text();
		var mb002 = $('.row_'+row_num+' .mb002').text();
		var mb003 = $('.row_'+row_num+' .mb003').text();
		var mb004 = $('.row_'+row_num+' .mb004').text();
		var mb005 = $('.row_'+row_num+' .mb017').text();
		var mb006 = $('.row_'+row_num+' .mb017disp').text();
		 console.log(mb002);
		if(window.parent.mult_addinvi02ddisp){	//以此判斷各呼叫此網頁的方法是否存在藉以給予相對應的需求
			window.parent.mult_addinvi02ddisp(mb001,mb002,mb003,mb004,mb005,mb006);			
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
	url = '<?php echo base_url() ?>index.php/inv/invi02/display_child/0/and_where?key=' + encodeURIComponent(key) + 
	'&val=' + encodeURIComponent(val);
	location = url;
}
</script>