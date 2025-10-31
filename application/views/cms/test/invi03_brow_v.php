<div id="container">
  <div id="header">
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
		<img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	    <img src="<?=base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">回主目錄</a>　
		<img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>　
	    </div>
    </div>
	
  <div class="box">
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 品號類別資料建立作業</h1>
      <div class="buttons">
		<a onclick="location = '<?=base_url()?>index.php/inv/invi03/addform'" class="button"><span>新增</span></a>
		<a onclick="location = '<?=base_url()?>index.php/inv/invi03/copyform'" class="button"><span>複製</span></a>	
        <a onclick="location = '<?=base_url()?>index.php/inv/invi03/findform'" class="button"><span>進階查詢</span></a>	
        <a onclick="$('form').submit();" class="button"><span>選取刪除</span></a>
		<a onclick="open_winprint();"   class="button">列印</a>  
	    <a onclick="open_winexcel();"   class="button">轉EXCEL檔</a>  
	   <!-- <a onclick="location = '<?=base_url()?>index.php/inv/invi03/printdetail'"  class="button"><span>列印</span></a>
	    <a onclick="location = '<?=base_url()?>index.php/inv/invi03/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
		<a onclick="location = '<?=base_url()?>index.php/main'" class="button"><span>關閉</span></a>
	  </div>
    </div>
	
  <div class="content">
    <form action="<?=base_url()?>index.php/inv/invi03/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
          <thead>
            <tr>
              <td width="1" style="text-align: center;">
			      <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
			  </td>
			  <td width="40" class="left">
			      <?php echo anchor("inv/invi03/display/ma001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?> 
			  </td>
			  <td  width="40" class="left">
			      <?php echo anchor("inv/invi03/display/ma001/" . (($sort_order == 'asc' && $sort_by == 'ma001') ? 'desc' : 'asc') ,'分類'); ?>
			  </td>
			  <td width="80" class="left"> 
			      <?php echo anchor("inv/invi03/display/ma002/" . (($sort_order == 'asc' && $sort_by == 'ma002') ? 'desc' : 'asc') ,'品號類別代號'); ?>
			  </td>
			  <td width="110" class="left"> 
			      <?php echo anchor("inv/invi03/display/ma003/" . (($sort_order == 'asc' && $sort_by == 'ma003') ? 'desc' : 'asc') ,'品號類別名稱'); ?>
              </td>
			  <td width="80" class="left"><?php echo anchor("inv/invi03/display/ma004/" .
					(($sort_order == 'asc' && $sort_by == 'ma004') ? 'desc' : 'asc') ,
					'存貨會計科目'); ?> 
			  </td>
			  <td width="80" class="left">
			      <?php echo anchor("inv/invi03/display/ma005/" . (($sort_order == 'asc' && $sort_by == 'ma005') ? 'desc' : 'asc') ,'銷貨收入科目'); ?>
			  </td>
			  <td width="80" class="left">
			      <?php echo anchor("inv/invi03/display/ma006/" . (($sort_order == 'asc' && $sort_by == 'ma006') ? 'desc' : 'asc') ,'銷貨退回科目'); ?>
			  </td>
			  <td width="70" class="center">
			      <?php echo anchor("inv/invi03/display/create_date/" . (($sort_order == 'asc' && $sort_by == 'create_date') ? 'desc' : 'asc') ,'建立日期'); ?>
			  </td>
			  <td width="120" class="center">&nbsp查看管理&nbsp</td>
              <td width="120" class="center">&nbsp修改管理&nbsp</td>
            </tr>
          </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
		    <?php $filter_ma001='*';$filter_ma002='';$filter_ma003='';$filter_ma004='';$filter_ma005='';$filter_ma006='';$filter_create=''; ?>
		    <tr class="filter">
			  <td class="left"></td>
			  <td class="left"></td>
			  
              <td align="left">
			    <div id="search">
				<div class="button-search"></div>
				<select name="filter_ma001" >
                  <option value="*"></option>
                  <option  value="1">會計</option>
                  <option  value="2">商品</option>
                  <option  value="3">類別</option>
                  <option  value="4">生管</option>                                                                
                </select>
				</div>
			  </td>
			  
			  <td class="left">
			    <div  class="button-search"></div>
				<input type="text" id="filter_ma002" name="filter_ma002" value="" />
			  </td>
			  
			  <td class="left">
			    <div id="search">
				<div class="button-search"></div>
				<input type="text" name="filter_ma003" value="" />
			    </div>			  
			  </td>
			  
			  <td align="left">
			  <div class="button-search"></div>
				<input type="text" name="filter_ma004" value="" />
			  </td>
              <td align="left">
			  <div class="button-search"></div>
				<input type="text" name="filter_ma005" value="" />
			  </td>
			  <td align="left">
			  <div class="button-search"></div>
				<input type="text" name="filter_ma006" value="" />
			  </td>
			  <td align="left">
			  <div class="button-search"></div>
				<input type="text" name="filter_create" value="" />
			  </td>
	 		  <td width="120" align="center"><a onclick="filter();" class="button">篩選↑</a></td>		
			  <td width="120" align="center"><a onclick="filtera();" class="button">篩選↓</a></td>  
			 <!--    <button type='submit'  name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
				  
            </tr>
			
		    <?php $chkval=1; ?>               
		    <?php foreach($results as $row ) : ?>
            <tr>
              <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?=$row->ma001."/".trim($row->ma002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left"><? echo $chkval;?></td>		
			  <td class="left"><? echo $row->ma001;?></td>			  
			  <td class="left"><? echo $row->ma002;?></td>
			  <td class="left"><? echo $row->ma003;?></td>
			  <td class="left"><? echo $row->ma004;?></td>
			  <td class="left"><? echo $row->ma005;?></td>
			  <td class="left"><? echo $row->ma006;?></td>
			  <td class="center"><? echo $row->create_date;?></td>		                 			
		 <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('inv/invi03/del/'.$row->ma001."/".trim($row->ma002))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		      <td class="center"><a href="<?php echo site_url('inv/invi03/see/'.$row->ma001."/".trim($row->ma002))?>">[ 查看 ]</a></td>
              <td class="center"><a href="<?php echo site_url('inv/invi03/updform/'.$row->ma001."/".trim($row->ma002))?>">[ 修改 ]</a></td>
			</tr>
		    <?php $chkval += 1; ?>
		    <?php endforeach;?>
			
          </tbody>
					 
        </table>
		    <!--    <?php echo $this->pagination->create_links();?>	-->
				<div class="pagination"><div class="results"><?php echo $this->pagination->create_links(); ?></div></div>
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選可查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列等資訊不印. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      </form>
	   
      <!-- <div class="pagination"><div class="results"><?php echo $this->pagination->create_links(); ?></div></div>   
	  <div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選可查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列等資訊不印. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div> -->
 </div>
 </div> 
</div>	

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
    window.open('/index.php/inv/invi03/printdetail')
  }

function open_winexcel()
  {
    window.open('/index.php/inv/invi03/exceldetail')
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_ma001 = $('select[name=\'filter_ma001\']').attr('value');
	if (filter_ma001 != '*') {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma001/desc/' + encodeURIComponent(filter_ma001);
	}
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').attr('value');
	if (filter_ma002) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma002/desc/' + encodeURIComponent(filter_ma002);
	} 
	
	var filter_ma003 = $('input[name=\'filter_ma003\']').attr('value');
	if (filter_ma003) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma003/desc/' + encodeURIComponent(filter_ma003);
	}
		
	var filter_ma004 = $('input[name=\'filter_ma004\']').attr('value');
	if (filter_ma004) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma004/desc/' + encodeURIComponent(filter_ma004); 
	}
	
	var filter_ma005 = $('input[name=\'filter_ma005\']').attr('value');
	if (filter_ma005) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma005/desc/' + encodeURIComponent(filter_ma005); 
	}
	
	var filter_ma006 = $('input[name=\'filter_ma006\']').attr('value');
	if (filter_ma006) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma006/desc/' + encodeURIComponent(filter_ma006); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/create_date/desc/' + encodeURIComponent(filter_create); 
	}
	
    if (filter_ma001 == '*' && !filter_ma002  && !filter_ma003 && !filter_ma004  && !filter_ma005 && !filter_ma006 && !filter_create) {         
	   url = 'http://ci.dercaster.com/index.php/inv/invi03/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_ma001 = $('select[name=\'filter_ma001\']').attr('value');
	if (filter_ma001 != '*') {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma001/asc/' + encodeURIComponent(filter_ma001);
	}
	
	var filter_ma002 = $('input[name=\'filter_ma002\']').attr('value');
	if (filter_ma002) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma002/asc/' + encodeURIComponent(filter_ma002);
	} 
	
	var filter_ma003 = $('input[name=\'filter_ma003\']').attr('value');
	if (filter_ma003) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma003/asc/' + encodeURIComponent(filter_ma003);
	}
		
	var filter_ma004 = $('input[name=\'filter_ma004\']').attr('value');
	if (filter_ma004) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma004/asc/' + encodeURIComponent(filter_ma004); 
	}
	
	var filter_ma005 = $('input[name=\'filter_ma005\']').attr('value');
	if (filter_ma005) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma005/asc/' + encodeURIComponent(filter_ma005); 
	}
	
	var filter_ma006 = $('input[name=\'filter_ma006\']').attr('value');
	if (filter_ma006) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/ma006/asc/' + encodeURIComponent(filter_ma006); 
	}
	
	var filter_create = $('input[name=\'filter_create\']').attr('value');
	if (filter_create) {
		url = 'http://ci.dercaster.com/index.php/inv/invi03/filter1/create_date/asc/' + encodeURIComponent(filter_create); 
	}
	
    if (filter_ma001 == '*' && !filter_ma002  && !filter_ma003 && !filter_ma004  && !filter_ma005 && !filter_ma006 && !filter_create) {         
	   url = 'http://ci.dercaster.com/index.php/inv/invi03/display';location = url;
	   
	   }
	   
	location = url;
}
</script> 
 
    </div>
  </div>
</div>