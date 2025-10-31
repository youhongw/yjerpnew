  <div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 銷售日報表 - 瀏覽</h1>
      <!--  <div class="buttons"> -->
	   <div style="float:right; "> 
		<div style="float:left;"><a onclick="location = '<?php echo base_url()?>index.php/fun/posr01a/set_date/<?php echo $current_type?>/<?php echo date("Y-m-d",strtotime($current_date." -1 day"))?>'"  style="float:left" class="button"><span>上一天</span></a></span></div>
		<div style="float:left;" class="button">日期：<input id="sch_date" name="sch_date" style="height:9px;" onchange="location = '<?php echo base_url()?>index.php/fun/posr01a/set_date/display/'+this.value;" value="<?php echo $current_date;?>" size="9" onclick="scwShow(this,event);" /></div>
		<div style="float:left;"><a onclick="location = '<?php echo base_url()?>index.php/fun/posr01a/set_date/<?php echo $current_type?>/<?php echo date("Y-m-d",strtotime($current_date." +1 day"))?>'"  style="float:left" class="button"><span>下一天</span></a></span></div>
	    <?PHP if (substr($this->session->userdata('sysmg006'),1,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/fun/posr01a/clear_sql_term'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>	
      <?PHP } ?>
	 	
		<div style="float:left;" class="button">
			<span style="float:right;width:13%;height:2px;"></span><span style="float:right;">總計：<?php echo $count_totle;?>元</span>
		</div>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/fun/posr01a/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/fun/posr01a/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <!--<a onclick="location = '<?php echo base_url()?>index.php/main/index/126'"  style="float:left"  accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>-->
      </div>
	   <div style="float:right;width:360px;">
	   </div>
    </div>
	
  <div class="content"> <!-- div-2 -->
    <form action="<?php echo base_url()?>index.php/fun/posr01a/delete" method="post" enctype="multipart/form-data" id="form">
        <table class="list">      <!-- 表格開始 -->
        <thead>
         <tr>                          <!-- 表格表頭 -->
          <td width="1%" style="text-align: center;">
		   <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
	      </td>
	      <td width="1%" class="left">
		   <?php echo anchor("fun/posr01a/display/tb001/".(($sort_order == 'asc' && $sort_by == 'tb001') ? 'desc' : 'asc')."/0/".$current_date ,'單別'); ?> 
	      </td>
	      <td class="center">
	        <?php echo anchor("fun/posr01a/display/tb002/" . (($sort_order == 'asc' && $sort_by == 'tb002') ? 'desc' : 'asc')."/0/".$current_date ,'銷貨單號'); ?>
			<?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td class="center"> 
		   <?php echo anchor("fun/posr01a/display/tb003/" . (($sort_order == 'asc' && $sort_by == 'tb003') ? 'desc' : 'asc')."/0/".$current_date ,'項次'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td class="center"> 
		   <?php echo anchor("fun/posr01a/display/tb004/" . (($sort_order == 'asc' && $sort_by == 'tb004') ? 'desc' : 'asc')."/0/".$current_date ,'條碼'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
          </td>
	      <td class="center">
	        <?php echo anchor("fun/posr01a/display/tb005/" .(($sort_order == 'asc' && $sort_by == 'tb005') ? 'desc' : 'asc')."/0/".$current_date ,'品號'); ?>
		    <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		    <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
   	      </td>
	      <td class="center">
		   <?php echo anchor("fun/posr01a/display/tb006/" . (($sort_order == 'asc' && $sort_by == 'tb006') ? 'desc' : 'asc')."/0/".$current_date ,'品名'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	   
	      <td class="center">
		   <?php echo anchor("fun/posr01a/display/tb008/" . (($sort_order == 'asc' && $sort_by == 'tb008') ? 'desc' : 'asc')."/0/".$current_date ,'顏色'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td class="center">
		   <?php echo anchor("fun/posr01a/display/tb007/" . (($sort_order == 'asc' && $sort_by == 'tb007') ? 'desc' : 'asc')."/0/".$current_date ,'規格'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td class="center">
		   <?php echo anchor("fun/posr01a/display/tb009/" . (($sort_order == 'asc' && $sort_by == 'tb009') ? 'desc' : 'asc')."/0/".$current_date ,'單位'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td class="center">
		   <?php echo anchor("fun/posr01a/display/tb010/" . (($sort_order == 'asc' && $sort_by == 'tb010') ? 'desc' : 'asc')."/0/".$current_date ,'數量'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td class="center">
		   <?php echo anchor("fun/posr01a/display/tb011/" . (($sort_order == 'asc' && $sort_by == 'tb011') ? 'desc' : 'asc')."/0/".$current_date ,'贈送數量'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td class="center">
		   <?php echo anchor("fun/posr01a/display/tb013/" . (($sort_order == 'asc' && $sort_by == 'tb013') ? 'desc' : 'asc')."/0/".$current_date ,'促銷單號'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td class="center">
		   <?php echo anchor("fun/posr01a/display/tb012/" . (($sort_order == 'asc' && $sort_by == 'tb012') ? 'desc' : 'asc')."/0/".$current_date ,'折扣%'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td class="center">
		   <?php echo anchor("fun/posr01a/display/tb015/" . (($sort_order == 'asc' && $sort_by == 'tb015') ? 'desc' : 'asc')."/0/".$current_date ,'單價'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
	      <td class="center">
		   <?php echo anchor("fun/posr01a/display/tb016/" . (($sort_order == 'asc' && $sort_by == 'tb016') ? 'desc' : 'asc')."/0/".$current_date ,'小計'); ?>
		   <?php if ($sort_order == 'asc'  ) { ?>  <img src="<?php echo base_url()?>assets/image/desc.png" /> <?php } else { ?>
		   <img src="<?php echo base_url()?>assets/image/asc.png" />  <?php }  ?>
	      </td>
		  
	      <td class="center">&nbsp查看管理&nbsp </td>
         
        </tr>
        </thead>
		  
          <tbody>     <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <?php $filter_tb001='*';$filter_tb002='';$filter_tb003='';$filter_tb004='';$filter_tb005='';$filter_create=''; ?>
	    <tr class="filter">
	     <td class="left"></td>			  
         <td align="left">
		   <div class="button-search"></div>
		    <input type="text" id="filter_tb001" name="filter_tb001" value=""  size="3" />
		   </div>
	     </td>
			  
	      <td class="left">
		  <div  class="button-search"></div>
			<input type="text" id="filter_tb002" name="filter_tb002" value="" size="12"/>
		  </td>
			  
	      <td class="left">
		   <div class="button-search"></div>
			<input type="text" id="filter_tb003" name="filter_tb003" value="" size="5"  />
		   </div>			  
	      </td>
			  
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" id="filter_tb004" name="filter_tb004" value="" size="12" />
		  </td>
          <td align="left">
		  <div class="button-search"></div>
			<input type="text" id="filter_tb005" name="filter_tb005" value="" size="12"  />
		  </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" id="filter_tb006" name="filter_tb006" value="" size="12" />
		  </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" id="filter_tb008" name="filter_tb008" value="" size="5" />
		  </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" id="filter_tb007" name="filter_tb007" value="" size="12" />
		  </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" id="filter_tb009" name="filter_tb009" value="" size="6" />
		  </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" id="filter_tb010" name="filter_tb010" value="" size="5" />
		  </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" id="filter_tb011" name="filter_tb011" value="" size="9" />
		  </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" id="filter_tb013" name="filter_tb013" value="" size="10" />
		  </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" id="filter_tb012" name="filter_tb012" value="" size="7" />
		  </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" id="filter_tb015" name="filter_tb015" value="" size="5" />
		  </td>
	      <td align="left">
		  <div class="button-search"></div>
		    <input type="text" id="filter_tb016" name="filter_tb016" value="" size="5" />
		  </td>
	      <td  align="center"><span><a onclick="filter();" class="button">篩選▲</a><a onclick="filtera();" class="button">篩選▼</a></span></td>		
	      <!--<td  align="center"></td>-->
	      <!--<button type='submit'  name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
        </tr>
		
		<!--session 變數取消 	  
		<?php $this->session->unset_userdata('tb002'); ?> -->
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td style="text-align: center;"> <input type="checkbox" name="selected[]"   id="cbbox"  value="<?php echo  $row->tb001."/".trim($row->tb002)?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
          <!--<td class="left"><?php echo  $chkval;?></td>-->
		  <td class="left"><?php echo  $row->tb001;?></td>			  
		  <td class="left"><?php echo  $row->tb002;?></td>
		  <td class="left"><?php echo  $row->tb003;?></td>
		  <td class="left"><?php echo  $row->tb004;?></td>
		  <td class="left"><?php echo  $row->tb005;?></td>
		  <td class="left"><?php echo  $row->tb006;?></td>
		  <td class="left"><?php echo  $row->tb008;?></td>
		  <td class="left"><?php echo  $row->tb007;?></td>
		  <td class="left"><?php echo  $row->tb009;?></td>
		  <td class="left"><?php echo  $row->tb010;?></td>
		  <td class="left"><?php echo  $row->tb011;?></td>
		  <td class="left"><?php echo  $row->tb013;?></td>
		  <td class="left"><?php echo  $row->tb012;?></td>
		  <td class="left"><?php echo  $row->tb015;?></td>
		  <td class="left"><?php echo  $row->tb016;?></td>
		  <!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('fun/posr01a/del/'.$row->tb001."/".trim($row->tb002))?>" id="delete1"  >[ 刪除 ]</a></td>  -->
		  <td class="center"><!--<a href="<?php echo site_url('fun/posr01a/see/'.$row->tb001."/".$row->tb002."/".$row->tb003)?>">[ 查看 </a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]--></td>
		</tr>
		  <?php $chkval += 1; ?>
		  <?php endforeach;?>
          </tbody>		 
        </table>
		<br><br><br>
		       <!-- 修改時 留在原來那一筆資料使用 -->
	          <?php  $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		    <!--    <?php echo $this->pagination->create_links();?>	
			    <?php echo $this->session->userdata('find05');$find05; ?><?php echo $this->session->userdata('find07');$find07;  ?> -->
				<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
			<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 選欄位名稱自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 選取列項出現打勾可多筆刪除, 列印可自設網址列不印, 快速鍵Alt+.. ] '.'　　　總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
      </form>
    
    </div> <!-- div-2 -->
   </div>  <!-- div-1 -->
</div>	<!-- div-0 -->
<script>
<?php if(@$sch_col){?>
$(document).ready(function(){
		$('input[name=\'filter_<?php echo $sch_col;?>\']').val('<?php echo $sch_val?>');
});
<?php }?>
</script>
<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
   // window.open('/index.php/fun/posr01a/printdetail')
	window.location="<?php echo base_url()?>index.php/fun/posr01a/printdetail";
  }

function open_winexcel()
  {
   //  window.open('/index.php/fun/posr01a/exceldetail')
	window.location="<?php echo base_url()?>index.php/fun/posr01a/exceldetail";
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function filter() {
	var filter_tb001 = $('input[name=\'filter_tb001\']').attr('value');
	if (filter_tb001) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb001/desc/' + encodeURIComponent(filter_tb001)+"/"+'<?php echo $current_date ?>';
	}	
	var filter_tb002 = $('input[name=\'filter_tb002\']').attr('value');
	if (filter_tb002) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb002/desc/' + encodeURIComponent(filter_tb002)+"/"+'<?php echo $current_date ?>';
	} 
	var filter_tb003 = $('input[name=\'filter_tb003\']').attr('value');
	if (filter_tb003) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb003/desc/' + encodeURIComponent(filter_tb003)+"/"+'<?php echo $current_date ?>';
	}	
	var filter_tb004 = $('input[name=\'filter_tb004\']').attr('value');
	if (filter_tb004) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb004/desc/' + encodeURIComponent(filter_tb004)+"/"+'<?php echo $current_date ?>';
	}
	var filter_tb005 = $('input[name=\'filter_tb005\']').attr('value');
	if (filter_tb005) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb005/desc/' + encodeURIComponent(filter_tb005)+"/"+'<?php echo $current_date ?>';
	}	
    var filter_tb006 = $('input[name=\'filter_tb006\']').attr('value');
	if (filter_tb006) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb006/desc/' + encodeURIComponent(filter_tb006)+"/"+'<?php echo $current_date ?>';
	}	
    var filter_tb007 = $('input[name=\'filter_tb007\']').attr('value');
	if (filter_tb007) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb007/desc/' + encodeURIComponent(filter_tb007)+"/"+'<?php echo $current_date ?>';
	}	
    var filter_tb008 = $('input[name=\'filter_tb008\']').attr('value');
	if (filter_tb008) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb008/desc/' + encodeURIComponent(filter_tb008)+"/"+'<?php echo $current_date ?>';
	}	
    var filter_tb009 = $('input[name=\'filter_tb009\']').attr('value');
	if (filter_tb009) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb009/desc/' + encodeURIComponent(filter_tb009)+"/"+'<?php echo $current_date ?>';
	}	
    var filter_tb010 = $('input[name=\'filter_tb010\']').attr('value');
	if (filter_tb010) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb010/desc/' + encodeURIComponent(filter_tb010)+"/"+'<?php echo $current_date ?>';
	}
    var filter_tb011 = $('input[name=\'filter_tb011\']').attr('value');
	if (filter_tb011) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb011/desc/' + encodeURIComponent(filter_tb011)+"/"+'<?php echo $current_date ?>';
	}
    var filter_tb012 = $('input[name=\'filter_tb012\']').attr('value');
	if (filter_tb012) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb012/desc/' + encodeURIComponent(filter_tb012)+"/"+'<?php echo $current_date ?>';
	}
    var filter_tb013 = $('input[name=\'filter_tb013\']').attr('value');
	if (filter_tb013) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb013/desc/' + encodeURIComponent(filter_tb013)+"/"+'<?php echo $current_date ?>';
	}
    var filter_tb014 = $('input[name=\'filter_tb014\']').attr('value');
	if (filter_tb014) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb014/desc/' + encodeURIComponent(filter_tb014)+"/"+'<?php echo $current_date ?>';
	}
    var filter_tb015 = $('input[name=\'filter_tb015\']').attr('value');
	if (filter_tb015) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb015/desc/' + encodeURIComponent(filter_tb015)+"/"+'<?php echo $current_date ?>';
	}
    var filter_tb016 = $('input[name=\'filter_tb016\']').attr('value');
	if (filter_tb016) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb016/desc/' + encodeURIComponent(filter_tb016)+"/"+'<?php echo $current_date ?>';
	}
    if (!filter_tb001 && !filter_tb002  && !filter_tb003  && !filter_tb004  && !filter_tb005  && !filter_tb006 && !filter_tb007 && !filter_tb008 && !filter_tb009 && !filter_tb010 && !filter_tb011 && !filter_tb012 && !filter_tb013 && !filter_tb014 && !filter_tb015 && !filter_tb016) {
	   url = '<?php echo base_url() ?>index.php/fun/posr01a/display';location = url;
	}
	   
	location = url;
}

function filtera() {
	
	var filter_tb001 = $('input[name=\'filter_tb001\']').attr('value');
	if (filter_tb001) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb001/asc/' + encodeURIComponent(filter_tb001)+"/"+'<?php echo $current_date ?>';
	}
	
	var filter_tb002 = $('input[name=\'filter_tb002\']').attr('value');
	if (filter_tb002) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb002/asc/' + encodeURIComponent(filter_tb002)+"/"+'<?php echo $current_date ?>';
	} 
	
	var filter_tb003 = $('input[name=\'filter_tb003\']').attr('value');
	if (filter_tb003) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb003/asc/' + encodeURIComponent(filter_tb003)+"/"+'<?php echo $current_date ?>';
	}
	var filter_tb004 = $('input[name=\'filter_tb004\']').attr('value');
	if (filter_tb004) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb004/asc/' + encodeURIComponent(filter_tb004)+"/"+'<?php echo $current_date ?>';
	}
	var filter_tb005 = $('input[name=\'filter_tb005\']').attr('value');
	if (filter_tb005) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb005/asc/' + encodeURIComponent(filter_tb005)+"/"+'<?php echo $current_date ?>';
	}
	var filter_tb006 = $('input[name=\'filter_tb006\']').attr('value');
	if (filter_tb006) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb006/asc/' + encodeURIComponent(filter_tb006)+"/"+'<?php echo $current_date ?>';
	}
	var filter_tb007 = $('input[name=\'filter_tb007\']').attr('value');
	if (filter_tb007) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb007/asc/' + encodeURIComponent(filter_tb007)+"/"+'<?php echo $current_date ?>';
	}
	var filter_tb008 = $('input[name=\'filter_tb008\']').attr('value');
	if (filter_tb008) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb008/asc/' + encodeURIComponent(filter_tb008)+"/"+'<?php echo $current_date ?>';
	}
	var filter_tb009 = $('input[name=\'filter_tb009\']').attr('value');
	if (filter_tb009) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb009/asc/' + encodeURIComponent(filter_tb009)+"/"+'<?php echo $current_date ?>';
	}
	var filter_tb010 = $('input[name=\'filter_tb010\']').attr('value');
	if (filter_tb010) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb010/asc/' + encodeURIComponent(filter_tb010)+"/"+'<?php echo $current_date ?>';
	}
	var filter_tb011 = $('input[name=\'filter_tb011\']').attr('value');
	if (filter_tb011) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb011/asc/' + encodeURIComponent(filter_tb011)+"/"+'<?php echo $current_date ?>';
	}
	var filter_tb012 = $('input[name=\'filter_tb012\']').attr('value');
	if (filter_tb012) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb012/asc/' + encodeURIComponent(filter_tb012)+"/"+'<?php echo $current_date ?>';
	}
	var filter_tb013 = $('input[name=\'filter_tb013\']').attr('value');
	if (filter_tb013) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb013/asc/' + encodeURIComponent(filter_tb013)+"/"+'<?php echo $current_date ?>';
	}
	var filter_tb014 = $('input[name=\'filter_tb014\']').attr('value');
	if (filter_tb014) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb014/asc/' + encodeURIComponent(filter_tb014)+"/"+'<?php echo $current_date ?>';
	}
	var filter_tb015 = $('input[name=\'filter_tb015\']').attr('value');
	if (filter_tb015) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb015/asc/' + encodeURIComponent(filter_tb015)+"/"+'<?php echo $current_date ?>';
	}
	var filter_tb016 = $('input[name=\'filter_tb016\']').attr('value');
	if (filter_tb016) {
		url = '<?php echo base_url() ?>index.php/fun/posr01a/filter1/tb016/asc/' + encodeURIComponent(filter_tb016)+"/"+'<?php echo $current_date ?>';
	}
	
    if (!filter_tb001 && !filter_tb002  && !filter_tb003 && !filter_tb004 && !filter_tb005 && !filter_tb006 && !filter_tb007 && !filter_tb008 && !filter_tb009 && !filter_tb010 && !filter_tb011 && !filter_tb012 && !filter_tb013 && !filter_tb014 && !filter_tb015 && !filter_tb016) {         
	   url = '<?php echo base_url() ?>index.php/fun/posr01a/display';location = url;
	   
	   }
	   
	location = url;
}
</script>
<script language="javascript">     //閒置超時，系統強制登出  1000毫秒=1秒, 7200000=2小時 8小時 328
	function Msg(){
		//alert("每隔30秒,30000 重新整理 5分!");
		//location="<?php echo base_url()?>";
		//location=
		<?php header('refresh: 150;url="'.base_url().'index.php/fun/posr01a/display"') ?>
	}
	window.setInterval("Msg()",300000);
	$('#sch_date').keydown(function(event){
	var keycode = (event.keyCode ? event.keyCode :event.which);
	if(keycode == '13'){
		$('#sch_date').change();
	}
});
</script>