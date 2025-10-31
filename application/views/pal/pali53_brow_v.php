  <div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 加班單建立作業 - 瀏覽</h1>
       <!--  <div class="buttons"> -->
	   <div style="float:right; ">
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali53/display'" style="float:left" accesskey="-" class="button"><span>清除查詢條件</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali53/addform'" style="float:left" accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali53/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali53/findform'"  style="float:left" accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	  <a onclick="$('form').submit();" style="float:left" accesskey="-" class="button"><span>選取刪除</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="open_winprint();" style="float:left" accesskey="p" class="button">列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="open_winexcel();" style="float:left" accesskey="l" class="button">轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/pal/pali53/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali53/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/111'"  style="float:left" accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
<?php 
	$title_array = array(
		'rowid' => array('sort_name'=>"tf001",'name'=>"序號",'width'=>"3%",'align'=>"left",'use'=>"disable"),
		'tf001' => array('sort_name'=>"tf001",'name'=>"員工代號",'width'=>"5%",'align'=>"left"),
		'tf001disp' => array('sort_name'=>"tf001disp",'name'=>"員工姓名",'width'=>"7%",'align'=>"left"),
		'tf002' => array('sort_name'=>"tf002",'name'=>"加班日期",'width'=>"7%",'align'=>"left"),
		'tf003' => array('sort_name'=>"tf003",'name'=>"星期",'width'=>"4%",'align'=>"left"),
		'tf010' => array('sort_name'=>"tf010",'name'=>"加班時段一",'width'=>"8%",'align'=>"left"),
		'tf011' => array('sort_name'=>"tf011",'name'=>"加班時段二",'width'=>"8%",'align'=>"left"),
		'tf018' => array('sort_name'=>"tf018",'name'=>"加班時段三",'width'=>"8%",'align'=>"left"),
		'tf016' => array('sort_name'=>"tf016",'name'=>"備註",'width'=>"8%",'align'=>"left"),
		'tf017' => array('sort_name'=>"tf017",'name'=>"確認",'width'=>"5%",'align'=>"left"),
		'see' => array('sort_name'=>"",'name'=>"查看管理",'width'=>"18%",'align'=>"center"),
		'edit' => array('sort_name'=>"",'name'=>"修改管理",'width'=>"18%",'align'=>"center")
	);
?>
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/pal/pali53/delete" method="post" enctype="multipart/form-data" id="form">
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
				echo anchor("pal/pali53/display_search/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." asc",$str);
				
				$str = "<img src='".base_url()."assets/image/desc.png' />";
				echo anchor("pal/pali53/display_search/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." desc",$str);
				
				echo "</td>";
			}
		  ?>
        </tr>
        </thead>
<?php 
	$filter_array = array(
		'rowid' => array('filter_name'=>"",'name'=>"序號",'size'=>"12",'align'=>"left",'use'=>"disable"),
		'tf001' => array('filter_name'=>"tf001",'name'=>"員工代號",'size'=>"12",'align'=>"left"),
		'mv002' => array('filter_name'=>"mv002",'name'=>"員工姓名",'size'=>"9",'align'=>"left",'color'=>"#F5F5F5"),
		'tf002' => array('filter_name'=>"tf002",'name'=>"加班日期",'size'=>"9",'align'=>"left"),
		'tf003' => array('filter_name'=>"tf003",'name'=>"星期",'size'=>"9",'align'=>"left"),
		'tf010' => array('filter_name'=>"tf010",'name'=>"加班時段一",'size'=>"8",'align'=>"left"),
		'tf011' => array('filter_name'=>"tf011",'name'=>"加班時段二",'size'=>"8",'align'=>"left"),
		'tf018' => array('filter_name'=>"tf018",'name'=>"加班時段三",'size'=>"8",'align'=>"left"),
		'tf016' => array('filter_name'=>"tf016",'name'=>"備註",'size'=>"15",'align'=>"left"),
		'tf017' => array('filter_name'=>"tf017",'name'=>"確認",'size'=>"6",'align'=>"left")
	);
?>
        <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
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
			<!--
			<td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			<td align="left">
			<div class="button-search"></div>
				<input type="text" id="filter_tf001" name="filter_tf001" value=""  size="12" />
			</td>
			-->
			<td align="center"><a onclick="filter();" accesskey="q" class="button">篩選 AND q</a></td>		
			<td align="center"><a onclick="filtera();" accesskey="w" class="button">篩選 OR w</a></td>  
			<!-- <button type='submit'  name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
        </tr>
		
		<!--session 變數取消 	  
		<?php $this->session->unset_userdata('tf002'); ?> -->
	    <?php $chkval=1;?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
			<td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->tf001."/".$row->tf002 ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
			<td class="left"><?php echo $chkval;?></td>		
			<td class="left"><?php echo $row->tf001;?></td>			  
			<td class="left"><?php echo $row->tf001disp;?></td>
			<td class="left"><?php echo substr($row->tf002,0,4).'/'.substr($row->tf002,4,2).'/'.substr($row->tf002,6,2);?></td>
			<td class="left"><?php echo $row->tf003;?></td>
			<td class="left">
			<?php if($row->tf003!=6&&$row->tf003!=0&&$row->holiday!=1)
					{echo "平時2內: ".$row->tf010."小時";}
				else if($row->tf003==6)
					{echo "六加2內: ".$row->tf012."小時";}
				else if($row->tf003==0||$row->holiday==1)
					{echo "日加8內: ".$row->tf014."小時";}?>
			</td>	
			<td class="left">
			<?php if($row->tf003!=6&&$row->tf003!=0&&$row->holiday!=1)
					{echo "平時2外: ".$row->tf011."小時";} 
				else if($row->tf003==6)
					{echo "六3至8: ".$row->tf013."小時";}
				else if($row->tf003==0||$row->holiday==1)
					{echo "日8外2內: ".$row->tf015."小時";}?>
			</td>	
			<td class="left">
			<?php if($row->tf003!=6&&$row->tf003!=0&&$row->holiday!=1)
					{echo "";}
				else if($row->tf003==6)
					{echo "六加8外: ".$row->tf018."小時";}
				else if($row->tf003==0||$row->holiday==1)
					{echo "日8外2外: ".$row->tf019."小時";}?>
			</td>
			<td class="center"><?php echo $row->tf016;?></td>
			<td class="center"><?php echo $row->tf017; ?></td>
			<!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pal/pali53/del/'.$row->tf001."/".trim($row->tf003))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
			<td class="center"><a href="<?php echo site_url('pal/pali53/see/'.$row->tf001."/".$row->tf002)?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
			<?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>                 
			<td class="center"><a href="<?php echo site_url('pal/pali53/updform/'.$row->tf001."/".$row->tf002)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
			<?PHP } ?>
		</tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
          </tbody>		 
        </table>
		       <!-- 修改時 留在原來那一筆資料使用 -->
	          <?php  $this->session->set_userdata('pali53_search',$this->uri->segment(3)."/".$this->uri->segment(4,0));
				if($this->uri->segment(3)=="display"){
					$this->session->set_userdata('pali53_search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));
				}
			  ?>  
		    <!--    <?php echo $this->pagination->create_links();?>	
			    <?php echo $this->session->userdata('find05');$find05; ?><?php echo $this->session->userdata('find07');$find07;  ?> -->
				<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      </form>
    
    </div> <!-- div-2 -->
   </div>  <!-- div-1 -->
</div>	<!-- div-0 -->

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
   // window.open('/index.php/pal/pali53/printdetail')
	window.location="<?php echo base_url()?>index.php/pal/pali53/printdetail";
  }

function open_winexcel()
  {
   //  window.open('/index.php/pal/pali53/exceldetail')
	window.location="<?php echo base_url()?>index.php/pal/pali53/exceldetail";
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
	url = '<?php echo base_url() ?>index.php/pal/pali53/display_search/0/and_where?key=' + encodeURIComponent(key) + 
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
	url = '<?php echo base_url() ?>index.php/pal/pali53/display_search/0/or_where?key=' + encodeURIComponent(key) + 
	'&val=' + encodeURIComponent(val);
	location = url;
}
</script>