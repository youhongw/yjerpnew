  <div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 加班單建立作業 - 查詢瀏覽</h1>
       <!--  <div class="buttons"> -->
	   <div style="float:right; "> 
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
	  <a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>選取刪除</span><img src="<?php echo base_url()?>assets/image/png/del.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="open_winprint();"    style="float:left" accesskey="p" class="button">列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="open_winexcel();"    style="float:left" accesskey="l" class="button">轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/pal/pali53/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali53/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/111'"  style="float:left" accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/pal/pali53/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
        <thead>
         <tr>                          <!-- 表格表頭 -->
          <td width="1%" style="text-align: center;">
		   <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="5%" class="left">
		   <?php echo anchor("pal/pali53/display/tf001/".(($sort_order == 'asc' && $sort_by == 'rowid') ? 'desc' : 'asc') ,'序號'); ?> 
	      </td>
	      <td width="5%" class="left">
	        <?php echo anchor("pal/pali53/display/tf001/" . (($sort_order == 'asc' && $sort_by == 'tf001') ? 'desc' : 'asc') ,'員工代號'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		   <?php echo anchor("pal/pali53/display/tf001disp/" . (($sort_order == 'asc' && $sort_by == 'tf001disp') ? 'desc' : 'asc') ,'員工姓名'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="left"> 
		   <?php echo anchor("pal/pali53/display/tf002/" . (($sort_order == 'asc' && $sort_by == 'tf002') ? 'desc' : 'asc') ,'加班日期'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
          </td>
	      <td width="4%" class="left">
	        <?php echo anchor("pal/pali53/display/tf003/" .(($sort_order == 'asc' && $sort_by == 'tf003') ? 'desc' : 'asc') ,'星期'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("pal/pali53/display/tf010/" . (($sort_order == 'asc' && $sort_by == 'tf010') ? 'desc' : 'asc') ,'加班時段一'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("pal/pali53/display/tf011/" . (($sort_order == 'asc' && $sort_by == 'tf011') ? 'desc' : 'asc') ,'加班時段二'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="8%" class="left">
		   <?php echo anchor("pal/pali53/display/tf011/" . (($sort_order == 'asc' && $sort_by == 'tf011') ? 'desc' : 'asc') ,'加班時段三'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		   <?php echo anchor("pal/pali53/display/tf016/" . (($sort_order == 'asc' && $sort_by == 'tf016') ? 'desc' : 'asc') ,'備註'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="7%" class="center">
		   <?php echo anchor("pal/pali53/display/tf017/" . (($sort_order == 'asc' && $sort_by == 'tf017') ? 'desc' : 'asc') ,'確認'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td width="18%" class="center">&nbsp查看管理&nbsp </td>
          <td width="18%" class="center">&nbsp修改管理&nbsp </td>
        </tr>
        </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_tf001='';$filter_tf001disp='';$filter_tf002='';$filter_tf003='';$filter_tf004='';$filter_tf005='';$filter_tf007=''; ?>
	    <tr class="filter">
	     <td class="left"></td>
	     <td class="left">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
			  
         <td align="left">
		   <div class="button-search"></div>
		    <input type="text" id="filter_tf001" name="filter_tf001" value=""  size="12" />
		   </div>
	     </td>
			  
	      <td class="left">
		  <div  class="button-search"></div>
			<input type="text" id="filter_tf001disp" name="filter_tf001disp" value="" size="9" style="background-color:#F5F5F5" />
		  </td>
		  
		    <td class="left">
		  <div  class="button-search"></div>
			<input type="text"  id="filter_tf002" name="filter_tf002" value="" size="9" />
		  </td>
		  
	      <td class="left">
		   <div class="button-search"></div>
			<input type="text" readonly="value" name="filter_tf003" value="" size="6" style="background-color:#F5F5F5" />
		   </div>			  
	      </td>
		  <td class="left">
		   <div class="button-search"></div>
			<input type="text"  name="filter_tf010" value=""   />
		   </div>			  
	      </td>
		  <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_tf011" value=""   />
		   </div>			  
	      </td>
		  <td class="left">
		   <div class="button-search"></div>
			<input type="text" name="filter_tf011" value=""   />
		   </div>			  
	      </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_tf016" value="" />
		  </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" name="filter_tf017" value="" size="6"  />
		  </td>
	      <td  align="center"><a onclick="filter();" accesskey="q" class="button">篩選▲ q</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td>  
	      <!-- <button type='submit'  name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
        </tr>
		
		<!--session 變數取消 	  
		<?php $this->session->unset_userdata('tf002'); ?> -->
	    <?php $chkval=1;?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo $row->tf001."/".$row->tf002 ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <td class="left"><?php echo  $chkval;?></td>		
		  <td class="left"><?php echo  $row->tf001;?></td>			  
		  <td class="left"><?php echo  $row->tf001disp;?></td>
		  <td class="left"><?php echo  substr($row->tf002,0,4).'/'.substr($row->tf002,4,2).'/'.substr($row->tf002,6,2);?></td>
		  <td class="left"><?php echo  $row->tf003;?></td>
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
	          <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
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

function filter() {
	var filter_tf001 = $('input[name=\'filter_tf001\']').attr('value');
	if (filter_tf001) {
		url = '<?php echo base_url() ?>index.php/pal/pali53/filter1/tf001/desc/' + encodeURIComponent(filter_tf001);
	}
	
	var filter_tf001disp = $('input[name=\'filter_tf001disp\']').attr('value');
	if (filter_tf001disp) {
		url = '<?php echo base_url() ?>index.php/pal/pali53/filter1/tf001disp/desc/' + encodeURIComponent(filter_tf001disp);
	} 
	
	var filter_tf002 = $('input[name=\'filter_tf002\']').attr('value');
	if (filter_tf002) {
		url = '<?php echo base_url() ?>index.php/pal/pali53/filter1/tf002/desc/' + encodeURIComponent(filter_tf002);
	}
	var filter_tf003 = $('input[name=\'filter_tf003\']').attr('value');
	if (filter_tf003) {
		url = '<?php echo base_url() ?>index.php/pal/pali53/filter1/tf003/desc/' + encodeURIComponent(filter_tf003);
	}
    var filter_tf010 = $('input[name=\'filter_tf010\']').attr('value');
	if (filter_tf010) {
		url = '<?php echo base_url() ?>index.php/pal/pali53/filter1/tf010/desc/' + encodeURIComponent(filter_tf010);
	}	
	var filter_tf011 = $('input[name=\'filter_tf011\']').attr('value');
	if (filter_tf011) {
		url = '<?php echo base_url() ?>index.php/pal/pali53/filter1/tf011/desc/' + encodeURIComponent(filter_tf011);
	}
	
	var filter_tf007 = $('input[name=\'filter_tf007\']').attr('value');
	if (filter_tf007) {
		url = '<?php echo base_url() ?>index.php/pal/pali53/filter1/tf007/desc/' + encodeURIComponent(filter_tf007); 
	}
	
    if (!filter_tf001 && !filter_tf001disp   && !filter_tf002 && !filter_tf003 && !filter_tf010 && !filter_tf011 && !filter_tf007) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali53/display';location = url;
	   
	   }
	   
	location = url;
}

function filtera() {
	
	var filter_tf001 = $('input[name=\'filter_tf001\']').attr('value');
	if (filter_tf001) {
		url = '<?php echo base_url() ?>index.php/pal/pali53/filter1/tf001/asc/' + encodeURIComponent(filter_tf001);
	}
	
	var filter_tf001disp = $('input[name=\'filter_tf001disp\']').attr('value');
	if (filter_tf001disp) {
		url = '<?php echo base_url() ?>index.php/pal/pali53/filter1/tf001disp/asc/' + encodeURIComponent(filter_tf001disp);
	} 
		
	var filter_tf002 = $('input[name=\'filter_tf002\']').attr('value');
	if (filter_tf002) {
		url = '<?php echo base_url() ?>index.php/pal/pali53/filter1/tf002/asc/' + encodeURIComponent(filter_tf002);
	}
	var filter_tf003 = $('input[name=\'filter_tf003\']').attr('value');
	if (filter_tf003) {
		url = '<?php echo base_url() ?>index.php/pal/pali53/filter1/tf003/asc/' + encodeURIComponent(filter_tf003);
	}
	var filter_tf010 = $('input[name=\'filter_tf010\']').attr('value');
	if (filter_tf010) {
		url = '<?php echo base_url() ?>index.php/pal/pali53/filter1/tf010/asc/' + encodeURIComponent(filter_tf010);
	}	
	var filter_tf011 = $('input[name=\'filter_tf011\']').attr('value');
	if (filter_tf011) {
		url = '<?php echo base_url() ?>index.php/pal/pali53/filter1/tf011/asc/' + encodeURIComponent(filter_tf011);
	}	
	
	var filter_tf016 = $('input[name=\'filter_tf016\']').attr('value');
	if (filter_tf016) {
		url = '<?php echo base_url() ?>index.php/pal/pali53/filter1/tf016/asc/' + encodeURIComponent(filter_tf016); 
	}
	
    if (!filter_tf001 && !filter_tf001disp   && !filter_tf002  && !filter_tf003 && !filter_tf010 && !filter_tf011 && !filter_tf016) {         
	   url = '<?php echo base_url() ?>index.php/pal/pali53/display';location = url;
	   
	   }
	   
	location = url;
}
</script>