<div class="box2">  <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 發票號碼設定作業 - 瀏覽　　　</h1>
	   <div style="float:left; "> 
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	    <a onclick="location = '<?php echo base_url()?>index.php/tax/taxi02/display'"  style="float:left" accesskey="a" class="button"><span>重整 a </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	    <a onclick="location = '<?php echo base_url()?>index.php/tax/taxi02/addform'" style="float:left" accesskey="i" class="button"><span>新增 i </span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,99991)=='Y') { ?>
	    <a onclick="location = '<?php echo base_url()?>index.php/tax/taxi02/copyform'" style="float:left" accesskey="c"  class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>		
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	    <a onclick="location = '<?php echo base_url()?>index.php/tax/taxi02/findform'" style="float:left" accesskey="k" class="button"><span>查詢 k </span><img src="<?php echo base_url()?>assets/image/png/find.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),3,1)=='Y') { ?>
	    <a onclick="$('form').submit();" style="float:left" accesskey="-" class="button"><span>刪除 - </span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	    <a onclick="location = '<?php echo base_url()?>index.php/tax/taxi02/printdetail'" style="float:left" accesskey="p"  class="button"><span>列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a> 
	  <?PHP } ?>
	  
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/146'" style="float:left" accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	<?php 
	$title_array = array(
		'rowid' => array('sort_name'=>"mb001",'name'=>"序號",'width'=>"5%",'align'=>"left",'use'=>"disable"),
		'mb001' => array('sort_name'=>"mb001",'name'=>"申報公司",'width'=>"7%",'align'=>"left"),
		'mb200' => array('sort_name'=>"mb200",'name'=>"申報年月",'width'=>"5%",'align'=>"left"),
		'mb204' => array('sort_name'=>"mb204",'name'=>"發票起日",'width'=>"10%",'align'=>"left"),
		'mb205' => array('sort_name'=>"mb205",'name'=>"發票迄日",'width'=>"8%",'align'=>"left"),
		'mb206' => array('sort_name'=>"mb206",'name'=>"發票字軌",'width'=>"8%",'align'=>"left"),
		'mb207' => array('sort_name'=>"mb207",'name'=>"發票號碼起",'width'=>"11%",'align'=>"left"),
		'mb208' => array('sort_name'=>"mb208",'name'=>"發票號碼迄",'width'=>"10%",'align'=>"left"),
		'see' => array('sort_name'=>"",'name'=>"查看管理",'width'=>"18%",'align'=>"center"),
		'edit' => array('sort_name'=>"",'name'=>"修改管理",'width'=>"18%",'align'=>"center")
	);
?>
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/tax/taxi02/delete" method="post" enctype="multipart/form-data" id="form">
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
				echo anchor("tax/taxi02/display_search/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." asc",$str);
				
				$str = "<img src='".base_url()."assets/image/desc.png' />";
				echo anchor("tax/taxi02/display_search/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." desc",$str);
				
				echo "</td>";
			}
		  ?>
          </tr>
        </thead>
		<?php 
	$filter_array = array(
		'rowid' => array('filter_name'=>"",'name'=>"序號",'size'=>"12",'align'=>"left",'use'=>"disable"),
		'mb001' => array('filter_name'=>"mb001",'name'=>"申報公司",'size'=>"10",'align'=>"left"),
		'mb200' => array('filter_name'=>"mb200",'name'=>"申報年月",'size'=>"10",'align'=>"left"),
		'mb204' => array('filter_name'=>"mb204",'name'=>"發票起日",'size'=>"10",'align'=>"left"),
		'mb205' => array('filter_name'=>"mb205",'name'=>"發票迄日",'size'=>"10",'align'=>"left"),
		'mb206' => array('filter_name'=>"mb206",'name'=>"發票字軌",'size'=>"10",'align'=>"left"),
		'mb207' => array('filter_name'=>"mb207",'name'=>"發票號碼起",'size'=>"10",'align'=>"left"),
		'mb208' => array('filter_name'=>"mb208",'name'=>"發票號碼迄",'size'=>"10",'align'=>"left",'use'=>"disable"),
	);
?>  
       <!-- <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	    <?php $filter_mb025='*';$filter_mb001='';$filter_mb002='';$filter_mb003='';$filter_mb004='';$filter_mb005='';$filter_mb006='';$filter_mb017='';$filter_create=''; ?>
	     <tr class="filter">
	      <td class="left"></td>
	     <?php
				foreach($filter_array as $key => $val){
					echo "<td class='".$val['align']."'>";
					if($val['filter_name']==""){echo "</td>";continue;} //filter_name = "" 為沒有使用
					
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
        </tr>
		<tbody>
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->mb001."/".$row->mb200."/".$row->mb206."/".$row->mb207?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>
          <td class="left"><?php echo  $row->mb001;?></td>
		  <td class="left"><?php echo  $row->mb200;?></td>			  
		  <td class="left"><?php echo  substr($row->mb204,0,4).'/'.substr($row->mb204,4,2).'/'.substr($row->mb204,6,2);?></td>
		  <td class="left"><?php echo  substr($row->mb205,0,4).'/'.substr($row->mb205,4,2).'/'.substr($row->mb205,6,2);?></td>
		  <td class="left"><?php echo  $row->mb206;?></td>
		  <td class="left"><?php echo  $row->mb207;?></td>
		  <td class="left"><?php echo  $row->mb208;?></td>
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('tax/taxi02/del/'.$row->mb001."/".$row->mb200."/".$row->mb206."/".$row->mb207)?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><a href="<?php echo site_url('tax/taxi02/see/'.$row->mb001."/".$row->mb200."/".$row->mb206."/".$row->mb207) ?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
          
		  <?PHP if (substr($this->session->userdata('sysmg006'),2,1)=='Y') { ?>                 
		    <td class="center"><a href="<?php echo site_url('tax/taxi02/updform/'.$row->mb001."/".$row->mb200."/".$row->mb206."/".$row->mb207)?>">[ 修改 </a><img src="<?php echo base_url()?>assets/image/png/modi.png" />]</td>
	      <?PHP } ?>  
		</tr>
		<?php $chkval += 1; ?>
		<?php endforeach;?>
        </tbody>		 
        </table>
		      <!-- 修改時 留在原來那一筆資料使用 -->
				<?php $this->session->set_userdata('taxi02_search',$this->uri->segment(3)."/".$this->uri->segment(4,0));
				if($this->uri->segment(3)=="display" || $this->uri->segment(3)=="display_leave"){
					$this->session->set_userdata('taxi02_search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));
				} ?>
			
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
	url = '<?php echo base_url() ?>index.php/tax/taxi02/display_search/0/and_where?key=' + encodeURIComponent(key) + 
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
	url = '<?php echo base_url() ?>index.php/tax/taxi02/display_search/0/or_where?key=' + encodeURIComponent(key) + 
	'&val=' + encodeURIComponent(val);
	location = url;
}
</script>